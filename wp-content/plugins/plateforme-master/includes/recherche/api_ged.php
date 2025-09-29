  <?php
/**
 * API GED (Documents)
 */
if (!defined('ABSPATH')) { exit; }

require_once dirname(__DIR__, 2) . '/services/recherche/services_ged.php';

/** Helper : formate une ligne DB comme la liste pour le front */
function pm_ged_format_row(array $r){
  $tsC = !empty($r['created_at']) ? strtotime($r['created_at']) : time();
  $tsU = !empty($r['updated_at']) ? strtotime($r['updated_at']) : $tsC;

  $uid = (int)($r['owner_user_id'] ?? 0);
  $owner_name = '';
  if ($uid) {
    $first = get_user_meta($uid, 'first_name', true);
    $last  = get_user_meta($uid, 'last_name', true);
    $disp  = get_userdata($uid) ? get_userdata($uid)->display_name : '';
    if (!empty($first) || !empty($last)) {
      $owner_name = trim($first.' '.$last);
    } elseif (!empty($disp)) {
      $owner_name = $disp;
    } else {
      $owner_name = 'Utilisateur '.$uid;
    }
  }

  return [
    'id'         => (int)$r['id'],
    'ref'        => (string)$r['reference'],
    'titre'      => (string)$r['titre'],
    'categorie'  => (string)$r['categorie'],
    'description'=> (string)($r['description'] ?? ''),
    'date_ajout' => date_i18n('d-m-Y', $tsC),
    'date_modif' => date_i18n('d-m-Y', $tsU),
    'file'       => ['id'=>(int)($r['file_id']??0), 'url'=>(string)($r['file_url']??'')],
    'owner'      => (int)$uid,
    'owner_name' => $owner_name,
    'labo'       => (int)($r['laboratoire_id'] ?? 0),
  ];
}

add_action('rest_api_init', function(){

  $ns = 'plateforme-recherche/v1';

  /** LIST */
  register_rest_route($ns, '/documents', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'args' => [
      'mine'     => ['type'=>'boolean','required'=>false],
      'search'   => ['type'=>'string','required'=>false],
      'page'     => ['type'=>'integer','default'=>1],
      'per_page' => ['type'=>'integer','default'=>10],
    ],
    'callback' => function(WP_REST_Request $req){
      $res = PM_GED_Service::list([
        'mine'     => $req->get_param('mine') ? 1 : 0,
        'search'   => $req->get_param('search'),
        'page'     => (int)$req->get_param('page'),
        'per_page' => (int)$req->get_param('per_page'),
      ]);
      $data = array_map('pm_ged_format_row', $res['rows']);
      return new WP_REST_Response([
        'data' => $data,
        'pagination' => [
          'total'    => (int)$res['total'],
          'page'     => (int)$res['page'],
          'per_page' => (int)$res['per_page'],
          'pages'    => (int)ceil(($res['total'] ?: 0) / max(1,$res['per_page'])),
        ]
      ], 200);
    }
  ]);

  /** GET ONE */
  register_rest_route($ns, '/documents/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::READABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      $row = PM_GED_Service::get((int)$req['id']);
      if (is_wp_error($row)) return $row;
      return new WP_REST_Response( pm_ged_format_row($row), 200 );
    }
  ]);

  /** CREATE */
  register_rest_route($ns, '/documents', [
    'methods'  => WP_REST_Server::CREATABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){

      $fid = 0; $furl = '';
      if (!empty($_FILES['file']) && is_array($_FILES['file'])) {
        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/media.php';
        require_once ABSPATH.'wp-admin/includes/image.php';
        $fid = media_handle_upload('file', 0);
        if (!is_wp_error($fid)) { $furl = (string) wp_get_attachment_url($fid); }
      }

      $payload = [
        'titre'         => $req->get_param('titre'),
        'categorie'     => $req->get_param('categorie'),
        'description'   => $req->get_param('description'),
        'laboratoire_id'=> $req->get_param('laboratoire_id'),
      ];

      $save = PM_GED_Service::create($payload, ['id'=>$fid,'url'=>$furl]);
      if (is_wp_error($save)) return $save;

      return new WP_REST_Response(['ok'=>true,'data'=> pm_ged_format_row($save) ], 201);
    }
  ]);

  /** UPDATE */
  register_rest_route($ns, '/documents/(?P<id>\d+)', [
    'methods'  => 'PUT, PATCH',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){

      $fid = null; $furl = null;
      if (!empty($_FILES['file']) && is_array($_FILES['file'])) {
        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/media.php';
        require_once ABSPATH.'wp-admin/includes/image.php';
        $fid = media_handle_upload('file', 0);
        if (is_wp_error($fid)) return $fid;
        $furl = (string) wp_get_attachment_url($fid);
      }

      $data = [];
      foreach (['titre','categorie','description'] as $k) {
        if ($req->offsetExists($k)) $data[$k] = $req->get_param($k);
      }

      $res = PM_GED_Service::update((int)$req['id'], $data, ($fid !== null ? ['id'=>$fid,'url'=>$furl] : []));
      if (is_wp_error($res)) return $res;

      return new WP_REST_Response(['ok'=>true,'data'=> pm_ged_format_row($res) ], 200);
    }
  ]);

  /** DELETE */
  register_rest_route($ns, '/documents/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::DELETABLE,
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function(WP_REST_Request $req){
      return PM_GED_Service::delete((int)$req['id']);
    }
  ]);


  // ---- helper commun pour formater un enregistrement comme dans la LIST ----
function pm_user_label_from_usermeta( $uid ) {
  $uid = (int) $uid;
  if ( $uid <= 0 ) return '';
  $first = get_user_meta($uid, 'first_name', true);
  $last  = get_user_meta($uid, 'last_name', true);
  $label = trim(($first ?: '') . ' ' . ($last ?: ''));
  if ($label === '') {
    $u = get_user_by('id', $uid);
    if ($u) $label = $u->display_name ?: $u->user_login;
  }
  return $label;
}
function pm_api_format_doc(array $r) {
  $tsC = !empty($r['created_at']) ? strtotime($r['created_at']) : time();
  $tsU = !empty($r['updated_at']) ? strtotime($r['updated_at']) : $tsC;
  $owner_id = (int)$r['owner_user_id'];
  return [
    'id'         => (int)$r['id'],
    'ref'        => (string)$r['reference'],
    'titre'      => (string)$r['titre'],
    'categorie'  => (string)$r['categorie'],
    'date_ajout' => date_i18n('d-m-Y', $tsC),
    'date_modif' => date_i18n('d-m-Y', $tsU),
    'file'       => ['id'=>(int)($r['file_id'] ?? 0), 'url'=>(string)($r['file_url'] ?? '')],
    'owner'      => $owner_id,
    'owner_name' => pm_user_label_from_usermeta($owner_id),
    'labo'       => (int)$r['laboratoire_id'],
  ];
}

});
