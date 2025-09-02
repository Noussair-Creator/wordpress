<?php
/**
 * API Messagerie – Plateforme messagerie
 * Namespace: /wp-json/plateforme-messagerie/v1/...
 *
 * Endpoints couverts :
 * - GET  /messages/threads                     (liste des fils)
 * - POST /messages/threads                     (créer un fil + 1er message optionnel)
 * - GET  /messages/threads/{id}                (détail du fil + participants)
 * - PATCH /messages/threads/{id}               (maj sujet, archiver)
 * - POST /messages/threads/{id}/participants   (ajouter/retirer des participants)
 * - GET  /messages/threads/{id}/messages       (liste des messages)
 * - POST /messages/threads/{id}/messages       (poster un message, mentions, PJ)
 * - POST /messages/{id}/read                   (marquer lu)
 * - GET  /messages/search                      (rechercher fils/messages)
 * - GET  /messages/drafts                      (lister mes brouillons)
 * - POST /messages/drafts                      (enregistrer un brouillon)
 * - DELETE /messages/drafts/{id}               (supprimer un brouillon)
 * - POST /messages/attachments                 (upload base64 simple)
 */

if (!defined('ABSPATH')) exit;

/* ===========================
   Déclaration des routes
   =========================== */

add_action('rest_api_init', function () {

    /* ------- THREADS ------- */
    register_rest_route('plateforme-messagerie/v1', '/messages/threads', [
        [
            'methods'  => 'GET',
            'callback' => 'api_msg_get_threads',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'query'       => ['required'=>false, 'type'=>'string', 'sanitize_callback'=>'sanitize_text_field'],
                'only_unread' => ['required'=>false, 'type'=>'boolean', 'default'=>false],
                'limit'       => ['required'=>false, 'type'=>'integer', 'default'=>20],
                'offset'      => ['required'=>false, 'type'=>'integer', 'default'=>0],
            ]
        ],
        [
            'methods'  => 'POST',
            'callback' => 'api_msg_create_thread',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    register_rest_route('plateforme-messagerie/v1', '/messages/threads/(?P<id>\d+)', [
        [
            'methods'  => 'GET',
            'callback' => 'api_msg_get_thread',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
        [
            'methods'  => 'PATCH',
            'callback' => 'api_msg_update_thread',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    register_rest_route('plateforme-messagerie/v1', '/messages/threads/(?P<id>\d+)/participants', [
        'methods'  => 'POST',
        'callback' => 'api_msg_update_participants',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);

    /* ------- MESSAGES ------- */
    register_rest_route('plateforme-messagerie/v1', '/messages/threads/(?P<id>\d+)/messages', [
        [
            'methods'  => 'GET',
            'callback' => 'api_msg_get_messages',
            'permission_callback' => function () { return is_user_logged_in(); },
            'args' => [
                'before' => ['required'=>false, 'type'=>'string'],
                'after'  => ['required'=>false, 'type'=>'string'],
                'limit'  => ['required'=>false, 'type'=>'integer', 'default'=>50],
            ]
        ],
        [
            'methods'  => 'POST',
            'callback' => 'api_msg_post_message',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    register_rest_route('plateforme-messagerie/v1', '/messages/(?P<id>\d+)/read', [
        'methods'  => 'POST',
        'callback' => 'api_msg_mark_read',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);

    /* ------- RECHERCHE ------- */
    register_rest_route('plateforme-messagerie/v1', '/messages/search', [
        'methods'  => 'GET',
        'callback' => 'api_msg_search',
        'permission_callback' => function () { return is_user_logged_in(); },
        'args' => [
            'scope' => ['required'=>false, 'type'=>'string', 'default'=>'messages', 'enum'=>['threads','messages']],
            'query' => ['required'=>true,  'type'=>'string', 'sanitize_callback'=>'sanitize_text_field'],
            'limit' => ['required'=>false, 'type'=>'integer', 'default'=>20],
        ]
    ]);

    /* ------- BROUILLONS ------- */
    register_rest_route('plateforme-messagerie/v1', '/messages/drafts', [
        [
            'methods'  => 'GET',
            'callback' => 'api_msg_get_drafts',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
        [
            'methods'  => 'POST',
            'callback' => 'api_msg_save_draft',
            'permission_callback' => function () { return is_user_logged_in(); },
        ],
    ]);

    register_rest_route('plateforme-messagerie/v1', '/messages/drafts/(?P<id>\d+)', [
        'methods'  => 'DELETE',
        'callback' => 'api_msg_delete_draft',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);

    /* ------- PIECES JOINTES (base64 simple) ------- */
    register_rest_route('plateforme-messagerie/v1', '/messages/attachments', [
        'methods'  => 'POST',
        'callback' => 'api_msg_upload_attachment',
        'permission_callback' => function () { return is_user_logged_in(); },
    ]);
});


/* ===========================================
   Implémentations (appellent le layer service)
   =========================================== */

require_once dirname(__DIR__, 1) . '/services/services_messages.php';

// Dans ce fichier, implémentez :
// - msg_get_threads($current_user_id, $filters)
// - msg_create_thread($current_user_id, $payload)
// - msg_get_thread($current_user_id, $thread_id)
// - msg_update_thread($current_user_id, $thread_id, $patch)
// - msg_update_participants($current_user_id, $thread_id, $ops)
// - msg_get_messages($current_user_id, $thread_id, $filters)
// - msg_post_message($current_user_id, $thread_id, $payload)
// - msg_mark_read($current_user_id, $message_id)
// - msg_search($current_user_id, $scope, $query, $limit)
// - msg_get_drafts($current_user_id)
// - msg_save_draft($current_user_id, $payload)
// - msg_delete_draft($current_user_id, $draft_id)
// - msg_upload_attachment($current_user_id, $payload)

/* ------- THREADS ------- */

function api_msg_get_threads(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $filters = [
        'query'       => $req->get_param('query'),
        'only_unread' => (bool) $req->get_param('only_unread'),
        'limit'       => max(1, intval($req->get_param('limit'))),
        'offset'      => max(0, intval($req->get_param('offset'))),
    ];
    return msg_get_threads($uid, $filters);
}

function api_msg_create_thread(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $payload = $req->get_json_params(); // {subject, participant_ids[], first_message{body,mentions[],attachments[]}}
    return msg_create_thread($uid, $payload);
}

function api_msg_get_thread(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $thread_id = intval($req['id']);
    return msg_get_thread($uid, $thread_id);
}

function api_msg_update_thread(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $thread_id = intval($req['id']);
    $patch = $req->get_json_params(); // {subject?, archived_at?}
    return msg_update_thread($uid, $thread_id, $patch);
}

function api_msg_update_participants(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $thread_id = intval($req['id']);
    $ops = $req->get_json_params(); // {add:[uid], remove:[uid]}
    return msg_update_participants($uid, $thread_id, $ops);
}

/* ------- MESSAGES ------- */

function api_msg_get_messages(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $thread_id = intval($req['id']);
    $filters = [
        'before' => $req->get_param('before'),
        'after'  => $req->get_param('after'),
        'limit'  => max(1, intval($req->get_param('limit'))),
    ];
    return msg_get_messages($uid, $thread_id, $filters);
}

function api_msg_post_message(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $thread_id = intval($req['id']);
    $payload = $req->get_json_params(); // {body, reply_to_id?, mentions[], attachments[]}
    return msg_post_message($uid, $thread_id, $payload);
}

function api_msg_mark_read(WP_REST_Request $req) {
    $uid = get_current_user_id();
    $message_id = intval($req['id']);
    return msg_mark_read($uid, $message_id);
}

/* ------- RECHERCHE ------- */

function api_msg_search(WP_REST_Request $req) {
    $uid   = get_current_user_id();
    $scope = $req->get_param('scope') ?: 'messages';
    $query = trim((string)$req->get_param('query'));
    $limit = max(1, intval($req->get_param('limit')));
    if ($query === '') {
        return new WP_Error('bad_request', 'Paramètre "query" requis', ['status'=>400]);
    }
    return msg_search($uid, $scope, $query, $limit);
}

/* ------- BROUILLONS ------- */

function api_msg_get_drafts(WP_REST_Request $req) {
    return msg_get_drafts(get_current_user_id());
}
function api_msg_save_draft(WP_REST_Request $req) {
    return msg_save_draft(get_current_user_id(), $req->get_json_params());
}
function api_msg_delete_draft(WP_REST_Request $req) {
    return msg_delete_draft(get_current_user_id(), intval($req['id']));
}

/* ------- PIECES JOINTES ------- */

function api_msg_upload_attachment(WP_REST_Request $req) {
    $uid = get_current_user_id();
    // body: {message_id, file_name, mime_type, content(base64)}
    $payload = $req->get_json_params();
    return msg_upload_attachment($uid, $payload);
}


/* Route: /wp-json/plateforme-messagerie/v1/users-by-role */
add_action('rest_api_init', function () {
  register_rest_route('plateforme-messagerie/v1', '/users-by-role', [
    'methods'  => 'GET',
    'callback' => function($req){ return pm_users_by_role($req); },
    'permission_callback' => function(){ return pm_users_by_role_can(); },
    'args' => [
      'role'     => ['type'=>'string','required'=>true,'sanitize_callback'=>'sanitize_text_field'],
      'search'   => ['type'=>'string','required'=>false,'sanitize_callback'=>'sanitize_text_field'],
      'per_page' => ['type'=>'integer','required'=>false,'default'=>100],
      'paged'    => ['type'=>'integer','required'=>false,'default'=>1],
    ]
  ]);
});

/* Autorisation minimale : connecté.
   -> Passe à current_user_can('list_users') si tu veux restreindre. */
if (!function_exists('pm_users_by_role_can')) {
  function pm_users_by_role_can() {
    return is_user_logged_in();
  }
}

if (!function_exists('pm_users_by_role')) {
  function pm_users_by_role($req) {
    try {
      $role   = $req->get_param('role');
      $search = $req->get_param('search');
      $per    = max(1, min(200, intval($req->get_param('per_page'))));
      $paged  = max(1, intval($req->get_param('paged')));

      if (empty($role)) {
        return new WP_Error('bad_request','Paramètre "role" requis',['status'=>400]);
      }

      // Construit la requête utilisateurs
      $args = [
        'role'    => $role,
        'number'  => $per,
        'paged'   => $paged,
        'fields'  => ['ID','display_name'],
        'orderby' => 'display_name',
        'order'   => 'ASC',
      ];
      if (!empty($search)) {
        $args['search']         = '*'.esc_attr($search).'*';
        $args['search_columns'] = ['user_login','user_nicename','user_email','display_name'];
      }

      $q = new WP_User_Query($args);
      if (is_wp_error($q)) {
        error_log('[users-by-role] WP_User_Query error: '.print_r($q,true));
        return new WP_Error('internal','Erreur requête utilisateur',['status'=>500]);
      }

      $items = [];
      foreach ((array)$q->get_results() as $u) {
        $items[] = [
          'id'   => (int)$u->ID,
          'name' => get_the_author_meta('display_name', $u->ID),
        ];
      }

      return rest_ensure_response([
        'items'    => $items,
        'total'    => (int)$q->get_total(),
        'per_page' => $per,
        'paged'    => $paged,
        'role'     => $role,
      ]);
    } catch (Throwable $e) {
      error_log('[users-by-role] fatal: '.$e->getMessage().' @'.$e->getFile().':'.$e->getLine());
      return new WP_Error('internal_server_error','Erreur interne',['status'=>500]);
    }
  }
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-messagerie/v1', '/unread-count', [
    'methods'  => 'GET',
    'callback' => function() {
      global $wpdb;
      $uid = get_current_user_id();
      if (!$uid) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

      $sql = $wpdb->prepare("
        SELECT COUNT(m.id)
        FROM msg_messages m
        JOIN msg_thread_participants p ON p.thread_id = m.thread_id AND p.user_id=%d AND p.left_at IS NULL
        LEFT JOIN msg_read_receipts r ON r.message_id = m.id AND r.user_id=%d
        WHERE m.deleted_at IS NULL AND m.sender_id <> %d AND r.message_id IS NULL
      ", $uid, $uid, $uid);

      $count = (int) $wpdb->get_var($sql);
      return ['unread_messages'=>$count];
    },
    'permission_callback' => function(){ return is_user_logged_in(); },
  ]);
});
