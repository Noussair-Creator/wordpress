<?php
add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/masters-all', [
        'methods' => 'GET',
        'callback' => 'gm_api_get_masters_all',
        'permission_callback' => function () {
            $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
            return wp_verify_nonce($nonce, 'wp_rest');
        }
    ]);
});

function gm_api_get_masters_all() {
    require_once dirname(__DIR__) . '/services/gestion-master-utm-service.php';
    return gm_get_masters_all();
}

?>




