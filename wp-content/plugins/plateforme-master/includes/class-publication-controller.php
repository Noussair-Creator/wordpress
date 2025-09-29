<?php
/**
 * REST Controller — Publications
 */
if (!defined('ABSPATH')) exit;

/** Charge le service */
$plugin_root  = dirname(__DIR__); // …/plateforme-master
$service_file = $plugin_root . '/services/class-publication-service.php';
if (file_exists($service_file)) {
  require_once $service_file;
} else {
  error_log('[plateforme-master] Service file not found: ' . $service_file);
  return;
}

/** Stats handler */
function pm_pub_stats_handler( WP_REST_Request $req ){
  $year = (string) $req->get_param('year');
  $res  = PubService::stats(['year' => $year]);
  return new WP_REST_Response($res, 200);
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  error_log('[plateforme-master] rest_api_init fired. Registering routes for '.$ns);

  /* =========================
   * Routes MY-SHARE (AVANT la route générique)
   * ========================= */

  register_rest_route( $ns, '/publication/(?P<id>\d+)/my-share', [
    // GET: détail publication + ma part
    [
      'methods'  => WP_REST_Server::READABLE,
      'callback' => function(WP_REST_Request $req){
        $id = (int)$req['id'];
        if ($id<=0) return new WP_Error('bad_request','ID invalide',['status'=>400]);
        $res = PubService::get_with_my_share($id);
        return $res ? rest_ensure_response($res)
                    : new WP_Error('not_found','Introuvable',['status'=>404]);
      },
      'permission_callback' => fn()=> is_user_logged_in(),
    ],
    // PUT: mise à jour de MA part
    [
      'methods'  => WP_REST_Server::EDITABLE, // PUT/PATCH
      'callback' => function(WP_REST_Request $req){
        $id = (int)$req['id'];
        if ($id<=0) return new WP_Error('bad_request','ID invalide',['status'=>400]);
        $payload = $req->get_json_params() ?: [];
        $res = PubService::upsert_my_share($id, $payload);
        return is_wp_error($res) ? $res : rest_ensure_response($res);
      },
      'permission_callback' => fn()=> is_user_logged_in(),
      'args'=>['id'=>['validate_callback'=>fn($v)=>(int)$v>0]],
    ],
  ]);


  /* =========================
   * LISTE
   * ========================= */
  $ok = register_rest_route($ns, '/publication', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $rows = PubService::list([
        'with_auteur'    => (bool) $req->get_param('with_auteur'),
        'me'             => (bool) $req->get_param('me'),
        'include_shared' => (bool) $req->get_param('include_shared'),
        'shared_scope'   => (string) $req->get_param('shared_scope'),
        'search'         => (string) $req->get_param('search'),
        'scope'          => (string) $req->get_param('scope'),
      ]);
      return new WP_REST_Response($rows, 200);
    },
    'show_in_index' => true,
  ]);
  error_log('[plateforme-master] register GET /publication = '.($ok?'OK':'FAIL'));

  /* =========================
   * ONE (APRÈS my-share)
   * ========================= */
  register_rest_route('plateforme-recherche/v1', '/publication/(?P<id>\d+)', [
  'methods'  => 'GET',
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id  = (int) $req['id'];
    $row = PubService::get($id); // <= UNIQUEMENT la publication
    if (!$row) return new WP_Error('not_found','Introuvable',['status'=>404]);
    return new WP_REST_Response($row, 200);
  },
]);
  /* =========================
   * CREATE / UPDATE / DELETE
   * ========================= */
  $ok = register_rest_route($ns, '/publication', [
    'methods'  => WP_REST_Server::CREATABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $p = $req->get_json_params(); if (!is_array($p) || !$p) $p = $req->get_params();
      $res = PubService::create($p);
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 201);
    },
    'show_in_index' => true,
  ]);
  error_log('[plateforme-master] register POST /publication = '.($ok?'OK':'FAIL'));

  $ok = register_rest_route($ns, '/publication/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::EDITABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id = (int)$req['id'];
      $p  = $req->get_json_params(); if (!is_array($p) || !$p) $p = $req->get_params();
      $res = PubService::update($id, $p);
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 200);
    },
    'show_in_index' => true,
  ]);
  error_log('[plateforme-master] register PUT /publication/{id} = '.($ok?'OK':'FAIL'));

  $ok = register_rest_route($ns, '/publication/(?P<id>\d+)', [
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
    'show_in_index' => true,
  ]);
  error_log('[plateforme-master] register DELETE /publication/{id} = '.($ok?'OK':'FAIL'));

  /* =========================
   * VALIDATE / REJECT
   * ========================= */
  register_rest_route($ns, '/publication/(?P<id>\d+)/validate', [
    'methods'  => WP_REST_Server::EDITABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id  = (int)$req['id'];
      $res = PubService::set_status($id, 'Validée');
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 200);
    },
    'show_in_index' => true,
  ]);

  register_rest_route($ns, '/publication/(?P<id>\d+)/reject', [
    'methods'  => WP_REST_Server::EDITABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $id  = (int)$req['id'];
      $res = PubService::set_status($id, 'Rejetée');
      if (is_wp_error($res)) {
        $st = (int) ($res->get_error_data()['status'] ?? 500);
        return new WP_REST_Response(['message'=>$res->get_error_message()], $st);
      }
      return new WP_REST_Response($res, 200);
    },
    'show_in_index' => true,
  ]);

  /* =========================
   * STATS
   * ========================= */
  register_rest_route($ns, '/publication/stats', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => 'pm_pub_stats_handler',
    'args'     => ['year' => ['type'=>'string','required'=>false]],
    'show_in_index' => true,
  ]);

  /* =========================
   * ÉLIGIBLES
   * ========================= */
  register_rest_route($ns, '/publication/eligible-users', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $search = (string) $req->get_param('search');
      $rows   = PubService::eligible_share_users($search);
      return new WP_REST_Response($rows, 200);
    },
    'show_in_index' => true,
  ]);
register_rest_route($ns, '/publication/(?P<id>\d+)/shares', [
  'methods'  => WP_REST_Server::READABLE,
  'permission_callback' => function(){ return is_user_logged_in(); },
  'callback' => function(WP_REST_Request $req){
    $id = (int)$req['id'];
    if ($id<=0) return new WP_Error('bad_request','ID invalide',['status'=>400]);
    $rows = PubService::list_shares($id);
    return new WP_REST_Response($rows, 200);
  },
  'show_in_index' => true,
]);

  register_rest_route($ns, '/publication/eligible-users-all', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $search = (string) $req->get_param('search');
      if (!method_exists('PubService','eligible_share_users_all')) {
        return new WP_REST_Response(['message'=>'eligible_share_users_all() manquante dans PubService'], 500);
      }
      $rows = PubService::eligible_share_users_all($search);
      return new WP_REST_Response($rows, 200);
    },
    'show_in_index' => true,
  ]);
});
