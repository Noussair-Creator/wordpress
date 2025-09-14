<?php
if (!defined('ABSPATH')) exit;

require_once dirname(__DIR__, 2) . '/services/recherche/services_assiduite.php';
// helpers (mets-les en haut du fichier api_assiduite.php)
function pm_is_lab_director_or_admin(): bool {
  if ( ! is_user_logged_in() ) return false;
  $u = wp_get_current_user();
  $roles = (array) $u->roles;
  return in_array('um_directeur_laboratoire', $roles, true)
      || in_array('administrator', $roles, true);
}
/** ===== LIST/CREATE ===== */
add_action('rest_api_init', function () {

  // … dans register_rest_route:
register_rest_route('plateforme-recherche/v1', '/assiduite', [
  [
    'methods'  => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $uid  = get_current_user_id();
      $rows = svc_assiduite_list_for_user($uid);
      return new WP_REST_Response(array_map(function($r){
        return [
          'id'                 => (int)$r['id'],
          'chercheur_nom'      => $r['chercheur_nom'] ?? null,
          'grade'              => $r['grade'] ?? null,
          'date_presence'      => $r['date_presence'],
          'statut'             => $r['statut'],
          'justification'      => $r['justification'],
          'justification_path' => $r['justification_path'],
          'piece_jointe_id'    => isset($r['piece_jointe_id']) ? (int)$r['piece_jointe_id'] : 0,
        ];
      }, $rows), 200);
    }
  ],
  [
    'methods'  => 'POST',
    'permission_callback' => 'pm_is_lab_director_or_admin',
    'callback' => function(WP_REST_Request $req){
      $payload = $req->get_json_params();
      $res = svc_assiduite_create(get_current_user_id(), is_array($payload)?$payload:[]);
      if (is_wp_error($res)) {
        return new WP_REST_Response(['ok'=>false,'message'=>$res->get_error_message()], 400);
      }
      return new WP_REST_Response(['ok'=>true,'data'=>$res], 201);
    }
  ],
 
]);

  // PUT update (directeur & chercheur)
  register_rest_route('plateforme-recherche/v1', '/assiduite/(?P<id>\d+)', [
  'methods'  => 'PUT',
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id = (int)$req['id'];
    $payload = $req->get_json_params() ?: [];
    $res = svc_assiduite_update(get_current_user_id(), $id, $payload);
    if (is_wp_error($res)) {
      $code = in_array($res->get_error_code(), ['forbidden','nf']) ? 403 : 400;
      return new WP_REST_Response(['ok'=>false,'message'=>$res->get_error_message()], $code);
    }
    // <<< renvoyer les champs (statut / justification_path) pour MAJ live
    return new WP_REST_Response($res, 200);
  }
]);

  // POST import CSV (déjà fourni)
  register_rest_route('plateforme-recherche/v1', '/assiduite/import', [
    'methods'  => 'POST',
    'permission_callback' => function(){
      $u = wp_get_current_user(); return is_user_logged_in() && in_array('um_directeur_laboratoire', (array)$u->roles, true);
    },
    'callback' => function(WP_REST_Request $req){
      if (empty($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        return new WP_REST_Response(['ok'=>false,'message'=>'Fichier manquant.'], 400);
      }
      $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      if ($ext !== 'csv') return new WP_REST_Response(['ok'=>false,'message'=>'Utilisez CSV pour ce test.'], 415);

      $rows = svc_assiduite_parse_csv($_FILES['file']['tmp_name']);
      if (is_wp_error($rows)) return new WP_REST_Response(['ok'=>false,'message'=>$rows->get_error_message()], 400);

      $result = svc_assiduite_import_rows($rows, get_current_user_id());
      if (is_wp_error($result)) return new WP_REST_Response(['ok'=>false,'message'=>$result->get_error_message()], 400);

      return new WP_REST_Response(['ok'=>true] + $result, 200);
    }
  ]);
});
