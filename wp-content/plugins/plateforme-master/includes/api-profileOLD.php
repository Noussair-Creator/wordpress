<?php
// Fichier: /home/utmresearchplatform/public_html/wp-content/plugins/plateforme-master/includes/api-profile.php

/**
 * API Profile – Plateforme profile
 * Namespace: /wp-json/plateforme-profile/v1/...
 *
 * Endpoints couverts :
 * - GET  /profile                     (récupérer le profil utilisateur courant)
 * - PATCH /profile                    (mettre à jour les champs du profil)
 * - POST /profile/password            (changer le mot de passe)
 * - POST /profile/avatar              (uploader un avatar)
 * - POST /profile/cv                  (uploader un CV)
 */

if (!defined('ABSPATH')) exit;

/* ===========================
   Déclaration des routes
   =========================== */

add_action('rest_api_init', function () {
    register_rest_route('plateforme-profile/v1', '/profile/refs', [
    'methods'  => 'GET',
    'callback' => 'api_profile_refs',
    'permission_callback' => function () { return is_user_logged_in(); },
]);


    /* ------- PROFIL ------- */
    register_rest_route('plateforme-profile/v1', '/profile', [
        [
            'methods'  => 'GET',
            'callback' => 'api_profile_get',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
        [
            'methods'  => 'PATCH',
            'callback' => 'api_profile_update',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    register_rest_route('plateforme-profile/v1', '/profile/password', [
        'methods'  => 'POST',
        'callback' => 'api_profile_change_password',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);

    register_rest_route('plateforme-profile/v1', '/profile/avatar', [
        'methods'  => 'POST',
        'callback' => 'api_profile_upload_avatar',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);

    register_rest_route('plateforme-profile/v1', '/profile/cv', [
        'methods'  => 'POST',
        'callback' => 'api_profile_upload_cv',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);
});

/* ===========================================
   Implémentations (appellent le layer service)
   =========================================== */

require_once dirname(__DIR__) . '/services/services_profile.php';

// Dans ce fichier, implémentez :
// - profile_get($current_user_id)
// - profile_update($current_user_id, $patch)
// - profile_change_password($current_user_id, $payload)
// - profile_upload_avatar($current_user_id, $payload)
// - profile_upload_cv($current_user_id, $payload)

/* ------- PROFIL ------- */

function api_profile_get(WP_REST_Request $req) {
    $uid = get_current_user_id();
    return profile_get($uid);
}

function api_profile_update(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $patch = $req->get_json_params(); // {email1?, email2?, tel_country?, tel?, adr_etud?, gov_etud?, cp_etud?, adr_parents?, gov_parents?, cp_parents?, tel_parents?}
    return profile_update($uid, $patch);
}

function api_profile_change_password(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $payload = $req->get_json_params(); // {old_password, new_password, confirm_password}
    return profile_change_password($uid, $payload);
}

function api_profile_upload_avatar(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $payload = $req->get_json_params(); // {file_name, mime_type, content(base64)}
    return profile_upload_avatar($uid, $payload);
}

function api_profile_upload_cv(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $payload = $req->get_json_params(); // {file_name, mime_type, content(base64)}
    return profile_upload_cv($uid, $payload);
}
function api_profile_refs(WP_REST_Request $req) {
    return profile_refs(); // défini dans services_profile.php
}
