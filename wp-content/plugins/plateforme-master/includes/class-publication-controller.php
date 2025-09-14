<?php
/**
 * REST Controller — Publications
 */
if (!defined('ABSPATH')) exit;
function pm_pub_stats_handler( WP_REST_Request $req ){
  $year = (string) $req->get_param('year'); // ex: "2024 - 2025"
  $res  = PubService::stats(['year' => $year]);
  return new WP_REST_Response($res, 200);
}
/**
 * On calcule la racine du plugin à partir du dossier "includes"
 * puis on require le service depuis /services/class-publication-service.php
 */
$plugin_root = dirname(__DIR__); // …/plateforme-master
$service_file = $plugin_root . '/services/class-publication-service.php';

if (file_exists($service_file)) {
  require_once $service_file;
} else {
  // En prod on log juste, mais on évite le fatal si possible
  error_log('[plateforme-master] Service file not found: ' . $service_file);
  return;
}

add_action('rest_api_init', function () {
$ns = 'plateforme-recherche/v1';
  // GET liste (suivi ou mes publications)
  register_rest_route('plateforme-recherche/v1', '/publication', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $rows = PubService::list([
        'with_auteur' => (bool) $req->get_param('with_auteur'),
        'me'          => (bool) $req->get_param('me'),
        'search'      => (string) $req->get_param('search'),
      ]);
      return new WP_REST_Response($rows, 200);
    },
  ]);

  // POST création
  register_rest_route('plateforme-recherche/v1', '/publication', [
    'methods'  => WP_REST_Server::CREATABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $p = $req->get_json_params() ?: $req->get_params();
      $res = PubService::create($p);
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 201);
    },
  ]);

  // POST validation
  register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)/validate', [
    'methods'  => WP_REST_Server::EDITABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id = (int)$req['id'];
      $res = PubService::set_status($id, 'Validée');
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 200);
    },
  ]);

  // POST rejet
  register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)/reject', [
    'methods'  => WP_REST_Server::EDITABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id = (int)$req['id'];
      $res = PubService::set_status($id, 'Rejetée');
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 200);
    },
  ]);

  // DELETE suppression
  register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::DELETABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id = (int)$req['id'];
      $ok = PubService::delete($id);
      if (is_wp_error($ok)) {
        $st = (int) ($ok->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$ok->get_error_message()], $st);
      }
      return new WP_REST_Response(null, 204);
    },
  ]);


  register_rest_route($ns, '/publication/stats', [
    'methods'  => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => 'pm_pub_stats_handler',
    'args'     => [
      'year' => ['type'=>'string','required'=>false], // "2024 - 2025"
    ],
  ]);

  // GET one
register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
  'methods'  => WP_REST_Server::READABLE,
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $row = PubService::get( (int)$req['id'] );
    if (!$row) return new WP_REST_Response(['message'=>'Introuvable'], 404);
    return new WP_REST_Response($row, 200);
  },
]);

// PUT update
register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
  'methods'  => WP_REST_Server::EDITABLE,
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id  = (int)$req['id'];
    $p   = $req->get_json_params() ?: $req->get_params();
    $res = PubService::update($id, is_array($p)?$p:[]);
    if (is_wp_error($res)) {
      $st = (int) ($res->get_error_data()['status'] ?? 400);
      return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
    }
    return new WP_REST_Response($res, 200);
  },
]);
// GET /publication/{id}  (récupérer une publication)
register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
  'methods'  => WP_REST_Server::READABLE,
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id = (int)$req['id'];
    $row = PubService::get($id);
    if (!$row) return new WP_REST_Response(['message'=>'Introuvable'], 404);
    return new WP_REST_Response($row, 200);
  },
]);

// PUT /publication/{id}  (modifier les champs)
register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
  'methods'  => WP_REST_Server::EDITABLE,
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id = (int)$req['id'];
    $p  = $req->get_json_params() ?: $req->get_params();
    $res = PubService::update($id, $p);
    if (is_wp_error($res)) {
      $st = (int) ($res->get_error_data()['status'] ?? 500);
      return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
    }
    return new WP_REST_Response($res, 200);
  },
]);

});
