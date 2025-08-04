<?php
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/universites', [
    'methods' => 'GET',
    'callback' => 'pm_get_universites',
    'permission_callback' => '__return_true' // ou rest_authorization_required_callback si besoin
  ]);
});

function pm_get_universites(WP_REST_Request $request) {
  global $wpdb;

  $table = $wpdb->prefix . 'universites';
  $results = $wpdb->get_results("SELECT id, nom_universite AS nom FROM $table ORDER BY nom_universite ASC");

  if (!$results) {
    return new WP_REST_Response([], 200);
  }

  return new WP_REST_Response($results, 200);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/etablissements-par-universite/(?P<universite_id>\d+)', [
    'methods' => 'GET',
    'callback' => 'pm_get_etablissements_by_universite',
    'permission_callback' => '__return_true',
  ]);
});

function pm_get_etablissements_by_universite(WP_REST_Request $request) {
  global $wpdb;

  $universite_id = intval($request['universite_id']);
  $table = 'utm_etablissements';

  $results = $wpdb->get_results($wpdb->prepare("
    SELECT id, nom FROM $table
    WHERE universite_id = %d
    ORDER BY nom ASC
  ", $universite_id));

  return new WP_REST_Response($results ?: [], 200);
}


?>
