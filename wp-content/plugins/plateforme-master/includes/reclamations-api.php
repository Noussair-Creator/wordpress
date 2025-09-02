<?php
if (!defined('ABSPATH')) exit;

// import du service
require_once dirname(__FILE__, 2) . '/services/ReclamationService.php';

// === Route POST : /wp-json/plateforme/v1/reclamations
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/reclamations', [
    'methods'             => 'POST',
    'permission_callback' => '__return_true', // à durcir ensuite (nonce + is_user_logged_in)
    'callback'            => 'pm_rest_create_reclamation',
  ]);
});

function pm_rest_create_reclamation(WP_REST_Request $request) {

  // Payload minimal (sans infos perso, sans 'due')
  $payload = [
    'type'      => sanitize_text_field( $request->get_param('type')    ),
    'subject'   => sanitize_text_field( $request->get_param('subject') ),
    'message'   => wp_kses_post(       $request->get_param('message')  ),
    'anonymous' => ($request->get_param('anonymous') === '1' || $request->get_param('anonymous') === true) ? 1 : 0,
  ];

  if ($payload['subject'] === '' || $payload['message'] === '') {
    return new WP_REST_Response([
      'ok'      => false,
      'message' => 'Sujet et message sont obligatoires.'
    ], 400);
  }

  // Upload éventuel (clé form-data: "attachment")
  $attachment_id  = 0;
  $attachment_url = '';

  if (!empty($_FILES['attachment']) && is_array($_FILES['attachment'])) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment_id = media_handle_upload('attachment', 0);
    if (is_wp_error($attachment_id)) {
      return new WP_REST_Response([
        'ok'      => false,
        'message' => 'Échec de l’upload : ' . $attachment_id->get_error_message(),
      ], 400);
    }
    $attachment_url = wp_get_attachment_url($attachment_id);
  }

  // INSERT dans {prefix}_student_reclamations via le service
  $save = ReclamationService::create($payload, [
    'id'  => $attachment_id,
    'url' => $attachment_url,
  ]);

  if (is_wp_error($save)) {
    return new WP_REST_Response([
      'ok'      => false,
      'message' => $save->get_error_message(),
    ], 500);
  }

  return new WP_REST_Response([
    'ok'      => true,
    'message' => 'Réclamation enregistrée.',
    'data'    => [
      'type'        => $payload['type'],
      'subject'     => $payload['subject'],
      'message'     => $payload['message'],
      'is_anonymous'=> (bool)$payload['anonymous'],
    ],
    'file'    => ['id' => $attachment_id, 'url' => $attachment_url],
    'insert'  => $save, // insert_id, table, stored
  ], 201);
}

// === Route GET : /wp-json/plateforme/v1/reclamations
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/reclamations', [
    'methods'             => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback'            => 'pm_rest_list_reclamations',
    'args' => [
      'page'     => ['type'=>'integer','default'=>1],
      'per_page' => ['type'=>'integer','default'=>10],
      'search'   => ['type'=>'string','required'=>false],
    ],
  ]);
});

function pm_rest_list_reclamations( WP_REST_Request $req ){
  global $wpdb;
  $table = $wpdb->prefix . 'student_reclamations'; // ta table

  $uid  = get_current_user_id();
  $page = max(1, (int)($req->get_param('page') ?: 1));
  $per  = min(50, max(1, (int)($req->get_param('per_page') ?: 10)));
  $q    = trim((string)$req->get_param('search'));

  // NB: les réclamations anonymes (etudiant_id = NULL) ne sont pas rattachables à l’étudiant,
  // donc elles n’apparaissent pas ici par conception.
  $where  = ['owner_user_id = %d'];
  $params = [$uid];

  if ($q !== '') {
    $like = '%' . $wpdb->esc_like($q) . '%';
    $where[] = '(type LIKE %s OR sujet LIKE %s OR message LIKE %s)';
    array_push($params, $like, $like, $like);
  }

  $where_sql = 'WHERE ' . implode(' AND ', $where);
  $offset    = ($page - 1) * $per;

  $sql_count = "SELECT COUNT(*) FROM `$table` $where_sql";
  $total     = (int) $wpdb->get_var($wpdb->prepare($sql_count, ...$params));

  $sql = "SELECT id, etudiant_id, type, sujet, message, piece_jointe_path, is_anonymous, created_at
          FROM `$table`
          $where_sql
          ORDER BY created_at DESC
          LIMIT %d OFFSET %d";

  $rows = $wpdb->get_results(
    $wpdb->prepare($sql, ...array_merge($params, [$per, $offset])),
    ARRAY_A
  ) ?: [];

  // Mise en forme pour ton UI
  $data = array_map(function($r){
    $ts = $r['created_at'] ? strtotime($r['created_at']) : time();
    return [
      'id'     => (int)$r['id'],
      'ref'    => sprintf('#REC-%s-%03d', date('Y',$ts), (int)$r['id']),
      'type'   => $r['type'],
      'sujet'  => $r['sujet'],
      'date'   => date_i18n('d-m-Y', $ts),
      'statut' => 'w', // 'w' = En cours (tu pourras ajouter un vrai champ plus tard)
      'pj'     => [
        'name' => $r['piece_jointe_path'] ? basename($r['piece_jointe_path']) : '—',
        'url'  => (string)$r['piece_jointe_path'],
      ],
      'reponse'   => '',
      'date_rep'  => '',
      'repondant' => '',
      'is_anonymous' => (int)$r['is_anonymous'],
    ];
  }, $rows);

  return new WP_REST_Response([
    'data' => $data,
    'pagination' => [
      'total'    => $total,
      'page'     => $page,
      'per_page' => $per,
      'pages'    => (int) ceil($total / $per),
    ],
  ], 200);
}
