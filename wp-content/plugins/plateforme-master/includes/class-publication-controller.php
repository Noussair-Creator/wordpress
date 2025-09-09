<?php
if (!defined('ABSPATH')) { exit; }

require_once __DIR__ . '/../services/class-publication-service.php';

class UTM_Publication_Controller {
    public static function register() {
        add_action('rest_api_init', [__CLASS__, 'routes']);
    }

    public static function routes() {
        $ns = 'plateforme-recherche/v1';

        // GET /publication?with_auteur=1&me=1
        register_rest_route($ns, '/publication', [
            [
                'methods'  => WP_REST_Server::READABLE,
                'callback' => [__CLASS__, 'list'],
                'permission_callback' => function () {
                    return is_user_logged_in();
                },
                'args' => [
                    'with_auteur' => ['type' => 'boolean', 'required' => false],
                    'me'          => ['type' => 'boolean', 'required' => false],
                ],
            ],
        ]);

        // DELETE /publication/{id}  (supprime MA publication)
        register_rest_route($ns, '/publication/(?P<id>\d+)', [
            [
                'methods'  => WP_REST_Server::DELETABLE,
                'callback' => [__CLASS__, 'delete_my_pub'],
                'permission_callback' => function () { return is_user_logged_in(); },
            ],
        ]);

        // POST /publication/{id}/validate  (directeur → valide)
        register_rest_route($ns, '/publication/(?P<id>\d+)/validate', [
            [
                'methods'  => WP_REST_Server::CREATABLE,
                'callback' => [__CLASS__, 'validate'],
                'permission_callback' => function () { return is_user_logged_in(); },
            ],
        ]);

        // POST /publication/{id}/reject  (directeur → rejette = supprime)
        register_rest_route($ns, '/publication/(?P<id>\d+)/reject', [
            [
                'methods'  => WP_REST_Server::CREATABLE,
                'callback' => [__CLASS__, 'reject'],
                'permission_callback' => function () { return is_user_logged_in(); },
            ],
        ]);
    }

    /** GET /publication */
    public static function list(WP_REST_Request $req) {
        $rows = UTM_Publication_Service::list([
            'with_auteur' => (bool)$req->get_param('with_auteur'),
            'me'          => (bool)$req->get_param('me'),
        ]);
        return new WP_REST_Response($rows, 200);
    }

    /** DELETE /publication/{id}  → “Mes publications” */
    public static function delete_my_pub(WP_REST_Request $req) {
        $id = (int)$req['id'];
        $ok = UTM_Publication_Service::delete_my_pub($id);
        if (!$ok) return new WP_Error('forbidden', 'Suppression impossible', ['status'=>403]);
        return new WP_REST_Response(['deleted'=>true], 200);
    }

    /** POST /publication/{id}/validate */
    public static function validate(WP_REST_Request $req) {
        $id = (int)$req['id'];
        $ok = UTM_Publication_Service::validate_pub($id);
        if (!$ok) return new WP_Error('forbidden', 'Validation refusée', ['status'=>403]);
        return new WP_REST_Response(['validated'=>true], 200);
    }

    /** POST /publication/{id}/reject */
    public static function reject(WP_REST_Request $req) {
        $id = (int)$req['id'];
        $ok = UTM_Publication_Service::reject_pub($id);
        if (!$ok) return new WP_Error('forbidden', 'Rejet refusé', ['status'=>403]);
        return new WP_REST_Response(['rejected'=>true], 200);
    }
}

UTM_Publication_Controller::register();
