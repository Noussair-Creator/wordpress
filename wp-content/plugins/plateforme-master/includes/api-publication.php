<?php
if (!defined('ABSPATH')) exit;

// import du service
require_once dirname(__FILE__, 2) . '/services/PublicationService.php';

// === Route POST : /wp-json/plateforme/v1/publications
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/publications', [
    'methods'             => 'POST',
    'permission_callback' => function(){ return is_user_logged_in(); }, // tu peux relâcher à __return_true si besoin
    'callback'            => 'pm_rest_create_publication',
  ]);
});

function pm_rest_create_publication( WP_REST_Request $request ) {

  // Payload → champs du formulaire
  $payload = [
    'type'            => sanitize_text_field( $request->get_param('type') ),
    'title'           => sanitize_text_field( $request->get_param('title') ),
    'summary'         => wp_kses_post(       $request->get_param('summary') ),
    'comment'         => wp_kses_post(       $request->get_param('comment') ),
    'submission_date' => sanitize_text_field( $request->get_param('submission_date') ),
    // on passe 'draft' ou 'pending' en clair dans le form (voir JS plus bas)
    'status'          => ( $request->get_param('status') === 'pending' ? 'pending' : 'draft' ),
  ];

  if ($payload['title'] === '') {
    return new WP_REST_Response([
      'ok'      => false,
      'message' => 'Le titre est obligatoire.'
    ], 400);
  }

  // Upload éventuel (clé form-data: "attachment") — identique à réclamation
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

  // INSERT via le service (style réclamation)
  $save = PublicationService::create($payload, [
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
    'message' => 'Publication enregistrée.',
    'data'    => [
      'type'            => $payload['type'],
      'title'           => $payload['title'],
      'summary'         => $payload['summary'],
      'comment'         => $payload['comment'],
      'submission_date' => $payload['submission_date'],
      'status'          => $payload['status'],
    ],
    'file'    => ['id' => $attachment_id, 'url' => $attachment_url],
    'insert'  => $save, // insert_id + stored
  ], 201);
}

// === Route GET : /wp-json/plateforme/v1/publications
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/publications', [
    'methods'             => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback'            => 'pm_rest_list_publications',
    'args' => [
      'page'     => ['type'=>'integer','default'=>1],
      'per_page' => ['type'=>'integer','default'=>10],
      'search'   => ['type'=>'string','required'=>false],
      'status'   => ['type'=>'string','required'=>false], // draft/pending/any
    ],
  ]);
});

function pm_rest_list_publications( WP_REST_Request $req ){
  global $wpdb;
  $table = $wpdb->prefix . 'recherche_publication';

  $uid  = get_current_user_id();
  $page = max(1, (int)($req->get_param('page') ?: 1));
  $per  = min(50, max(1, (int)($req->get_param('per_page') ?: 10)));
  $q    = trim((string)$req->get_param('search'));
  $st   = trim((string)$req->get_param('status')) ?: 'any';

  $where  = ['owner_user_id = %d'];
  $params = [$uid];

  if ($st !== 'any' && $st !== '') {
    $where[] = 'status = %s';
    $params[] = $st;
  }
  if ($q !== '') {
    $like = '%' . $wpdb->esc_like($q) . '%';
    $where[] = '(title LIKE %s OR summary LIKE %s OR comment LIKE %s)';
    array_push($params, $like, $like, $like);
  }

  $where_sql = 'WHERE ' . implode(' AND ', $where);
  $offset    = ($page - 1) * $per;

  $sql_count = "SELECT COUNT(*) FROM `$table` $where_sql";
  $total     = (int) $wpdb->get_var($wpdb->prepare($sql_count, ...$params));

  $sql = "SELECT id, type, submission_date, title, summary, comment, piece_jointe_path, piece_jointe_id, status, created_at, updated_at
          FROM `$table`
          $where_sql
          ORDER BY created_at DESC
          LIMIT %d OFFSET %d";

  $rows = $wpdb->get_results(
    $wpdb->prepare($sql, ...array_merge($params, [$per, $offset])),
    ARRAY_A
  ) ?: [];

  $data = array_map(function($r){
    return [
      'id'              => (int)$r['id'],
      'type'            => $r['type'],
      'submission_date' => $r['submission_date'],
      'title'           => $r['title'],
      'summary'         => $r['summary'],
      'comment'         => $r['comment'],
      'attachment'      => [
        'id'  => (int)$r['piece_jointe_id'],
        'url' => (string)$r['piece_jointe_path'],
      ],
      'status'     => $r['status'],
      'created_at' => $r['created_at'],
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
