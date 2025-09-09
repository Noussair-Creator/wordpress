<?php
/**
 * API Réunions – Plateforme Recherche
 * Namespace: /wp-json/plateforme-reunion/v1/...
 *
 * Endpoints couverts :
 * - GET  /reunions                         (liste des réunions)
 * - POST /reunions                         (créer une réunion)
 * - GET  /reunions/{id}                    (détail d’une réunion + participants)
 * - PATCH /reunions/{id}                   (mise à jour réunion)
 * - DELETE /reunions/{id}                  (supprimer réunion)
 * - POST /reunions/{id}/participants       (ajouter des participants)
 * - DELETE /reunions/{id}/participants     (retirer des participants)
 */

if (!defined('ABSPATH')) exit;

/* ===========================
   Déclaration des routes
   =========================== */

add_action('rest_api_init', function () {
    $ns = 'plateforme-reunion/v1';

    // ---- LISTE + CREATION ----
    register_rest_route($ns, '/reunions', [
        [
            'methods'  => 'GET',
            'callback' => 'api_reunion_list',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'etablissement_id' => ['required'=>false,'type'=>'integer'],
                'limit'            => ['required'=>false,'type'=>'integer','default'=>20],
                'offset'           => ['required'=>false,'type'=>'integer','default'=>0],
                'sujet'            => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
                'date'             => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
            ]
        ],
        [
            'methods'  => 'POST',
            'callback' => 'api_reunion_create',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'sujet'            => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
                'date_reunion'     => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
                'duree'            => ['required'=>false,'type'=>'integer'],
                'etablissement_id' => ['required'=>false,'type'=>'integer'],
            ]
        ],
    ]);

    // ---- DETAIL + UPDATE + DELETE ----
    register_rest_route($ns, '/reunions/(?P<id>\d+)', [
        [
            'methods'  => 'GET',
            'callback' => 'api_reunion_get',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
        [
            'methods'  => 'PATCH',
            'callback' => 'api_reunion_update',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'sujet'            => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
                'date_reunion'     => ['required'=>false,'type'=>'string','sanitize_callback'=>'sanitize_text_field'],
                'duree'            => ['required'=>false,'type'=>'integer'],
                'etablissement_id' => ['required'=>false,'type'=>'integer'],
            ]
        ],
        [
            'methods'  => 'DELETE',
            'callback' => 'api_reunion_delete',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    // ---- PARTICIPANTS ----
    register_rest_route($ns, '/reunions/(?P<id>\d+)/participants', [
        [
            'methods'  => 'POST',
            'callback' => 'api_reunion_add_participants',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'emails'           => ['required'=>false,'type'=>'array'],
                'etablissement_id' => ['required'=>false,'type'=>'integer'],
            ]
        ],
        [
            'methods'  => 'DELETE',
            'callback' => 'api_reunion_remove_participants',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'emails' => ['required'=>false,'type'=>'array'],
            ]
        ],
    ]);
});

/* ===========================================
   Implémentations (appellent layer services)
   =========================================== */

require_once dirname(__DIR__, 1) . '/services/services_reunion.php';

/* --- Réunions --- */
function api_reunion_list(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $filters = [
        'etablissement_id' => $req->get_param('etablissement_id') ? intval($req->get_param('etablissement_id')) : null,
        'limit'            => max(1, intval($req->get_param('limit'))),
        'offset'           => max(0, intval($req->get_param('offset'))),
        'sujet'            => $req->get_param('sujet'),
        'date'             => $req->get_param('date'),
    ];
    return reunion_list($uid, $filters);
}

function api_reunion_create(WP_REST_Request $req) {
    $uid = get_current_user_id();

    // On fusionne file_params et post_params
    $file_params = $req->get_file_params() ?: [];
    $form_params = $req->get_body_params() ?: [];  // récupère les champs du FormData
    $json_params = $req->get_json_params() ?: [];

    // Priorité : fichier + form-data + json
    $payload = array_merge($json_params, $form_params, $file_params);

    return reunion_create($uid, $payload);
}


function api_reunion_get(WP_REST_Request $req) {
    return reunion_get(get_current_user_id(), intval($req['id']));
}

function api_reunion_update(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $id  = intval($req['id']);
    $patch = $req->get_json_params() ?: [];
    return reunion_update($uid, $id, $patch);
}

function api_reunion_delete(WP_REST_Request $req) {
    return reunion_delete(get_current_user_id(), intval($req['id']));
}

/* --- Participants --- */
function api_reunion_add_participants(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $id  = intval($req['id']);
    $payload = $req->get_json_params() ?: []; // {emails:["a@b.com","c@d.com"]}
    return reunion_add_participants($uid, $id, $payload);
}

function api_reunion_remove_participants(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $id  = intval($req['id']);
    $payload = $req->get_json_params() ?: []; // {emails:["a@b.com"]}
    return reunion_remove_participants($uid, $id, $payload);
}
