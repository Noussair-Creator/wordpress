<?php
/**
 * Services – Messagerie interne
 * Emplacement suggéré : /wp-content/plugins/TON-PLUGIN/services/services_messages.php
 */
if (!defined('ABSPATH')) exit;

/* =============================
 * Event bus (fallback: log)
 * ============================= */
if (!function_exists('msg_emit_event')) {
  function msg_emit_event($topic, $payload) {
    // Exemple HTTP si tu as un bus :
    // wp_remote_post('https://your-bus.local/events', [
    //   'headers' => ['Content-Type'=>'application/json'],
    //   'body'    => wp_json_encode(['topic'=>$topic, 'payload'=>$payload]),
    //   'timeout' => 2,
    // ]);
    error_log('[MSG-EVENT] '.$topic.' '.wp_json_encode($payload));
  }
}

/* =============================
 * Helpers sécurité & utilitaires
 * ============================= */
function msg__is_participant($user_id, $thread_id) {
  global $wpdb;
  $sql = $wpdb->prepare(
    "SELECT 1 FROM msg_thread_participants
     WHERE thread_id=%d AND user_id=%d AND (left_at IS NULL)", $thread_id, $user_id
  );
  return (bool) $wpdb->get_var($sql);
}

function msg__require_participant($user_id, $thread_id) {
  if (!msg__is_participant($user_id, $thread_id)) {
    return new WP_Error('forbidden', 'Accès refusé à ce fil', ['status'=>403]);
  }
  return true;
}

function msg__wpdb_ok_or_error($context='') {
  global $wpdb;
  if ($wpdb->last_error) {
    error_log('[MSG][SQL]['.$context.'] '.$wpdb->last_error);
    return new WP_Error('sql_error', 'Erreur SQL', ['status'=>500]);
  }
  return true;
}

function msg__uploads_dir_messages() {
  $u = wp_upload_dir();
  $dir = trailingslashit($u['basedir']).'messages';
  if (!file_exists($dir)) wp_mkdir_p($dir);
  return [$dir, trailingslashit($u['baseurl']).'messages'];
}

/* Unread count per thread for a user */
function msg__unread_count_for_thread($user_id, $thread_id) {
  global $wpdb;
  $sql = $wpdb->prepare("
    SELECT COUNT(m.id) FROM msg_messages m
    LEFT JOIN msg_read_receipts r
      ON r.message_id=m.id AND r.user_id=%d
    WHERE m.thread_id=%d
      AND m.deleted_at IS NULL
      AND m.sender_id <> %d
      AND r.message_id IS NULL
  ", $user_id, $thread_id, $user_id);
  return (int) $wpdb->get_var($sql);
}

/* =============================
 * THREADS
 * ============================= */
function msg_get_threads($current_user_id, $filters) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $query       = trim((string)($filters['query'] ?? ''));
  $only_unread = !empty($filters['only_unread']);
  $limit       = max(1, intval($filters['limit'] ?? 20));
  $offset      = max(0, intval($filters['offset'] ?? 0));

  // Sous-select pour dernier message par thread
  $lastMessageJoin = "
    LEFT JOIN (
      SELECT m1.*
      FROM msg_messages m1
      JOIN (
        SELECT thread_id, MAX(created_at) AS last_created
        FROM msg_messages
        WHERE deleted_at IS NULL
        GROUP BY thread_id
      ) lm ON lm.thread_id = m1.thread_id AND lm.last_created = m1.created_at
    ) lastm ON lastm.thread_id = t.id
  ";

  $where = $wpdb->prepare("p.user_id=%d AND p.left_at IS NULL", $current_user_id);
  $params = [];

  if ($query !== '') {
    $like = '%'.$wpdb->esc_like($query).'%';
    $where .= $wpdb->prepare(" AND (t.subject LIKE %s OR lastm.body_plain LIKE %s)", $like, $like);
  }

  $sql = "
    SELECT
      t.id, t.subject, t.is_group, t.updated_at,
      lastm.sender_id AS last_sender_id,
      lastm.created_at AS last_message_at,
      SUBSTRING(TRIM(REPLACE(REPLACE(REPLACE(COALESCE(lastm.body_plain,''), '\r',' '), '\n',' '), '\t',' ')),1,160) AS last_excerpt
    FROM msg_threads t
    JOIN msg_thread_participants p ON p.thread_id = t.id
    $lastMessageJoin
    WHERE $where
    ORDER BY t.updated_at DESC
    LIMIT %d OFFSET %d
  ";
  $rows = $wpdb->get_results($wpdb->prepare($sql, $limit, $offset), ARRAY_A);
  $ok = msg__wpdb_ok_or_error('get_threads'); if (is_wp_error($ok)) return $ok;

  // Calcul unread_count (optimisation possible via vue/materialized view si besoin)
  foreach ($rows as &$r) {
    $r['unread_count'] = msg__unread_count_for_thread($current_user_id, intval($r['id']));
  }
  if ($only_unread) {
    $rows = array_values(array_filter($rows, fn($r)=> (int)$r['unread_count'] > 0));
  }
  return $rows;
}

function msg_create_thread($current_user_id, $payload) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $subject      = sanitize_text_field($payload['subject'] ?? '');
  $participants = array_unique(array_map('intval', (array)($payload['participant_ids'] ?? [])));
  $first        = $payload['first_message'] ?? null;

  if (empty($participants)) {
    return new WP_Error('bad_request','participants requis',['status'=>400]);
  }

  $wpdb->query('START TRANSACTION');
  $ok = $wpdb->insert('msg_threads', [
    'subject'    => $subject,
    'is_group'   => count($participants) > 1 ? 1 : 0,
    'created_by' => $current_user_id,
  ]);
  if (!$ok) { $wpdb->query('ROLLBACK'); return msg__wpdb_ok_or_error('create_thread'); }
  $thread_id = intval($wpdb->insert_id);

  $all = array_unique(array_merge($participants, [$current_user_id]));
  foreach ($all as $pid) {
    $wpdb->insert('msg_thread_participants', [
      'thread_id'=>$thread_id, 'user_id'=>intval($pid), 'role'=>($pid===$current_user_id?'owner':'member')
    ]);
    if ($wpdb->last_error) { $wpdb->query('ROLLBACK'); return msg__wpdb_ok_or_error('insert_participant'); }
  }

  if ($first && !empty($first['body'])) {
    $ok = $wpdb->insert('msg_messages', [
      'thread_id' => $thread_id,
      'sender_id' => $current_user_id,
      'body'      => wp_kses_post($first['body']),
      'body_plain'=> wp_strip_all_tags($first['body']),
      'has_attachments'=> !empty($first['attachments']) ? 1 : 0
    ]);
    if (!$ok) { $wpdb->query('ROLLBACK'); return msg__wpdb_ok_or_error('insert_first_message'); }
    $msg_id = intval($wpdb->insert_id);

    // Mentions
    foreach ((array)($first['mentions'] ?? []) as $mid) {
      $wpdb->insert('msg_message_mentions', ['message_id'=>$msg_id, 'mentioned_user_id'=>intval($mid)]);
      if ($wpdb->last_error) { $wpdb->query('ROLLBACK'); return msg__wpdb_ok_or_error('insert_mentions'); }
    }
    // Pièces jointes (base64 ou presigned)
    foreach ((array)($first['attachments'] ?? []) as $att) {
      $res = msg__save_attachment_row($msg_id, $att);
      if (is_wp_error($res)) { $wpdb->query('ROLLBACK'); return $res; }
    }
    // Lu immédiat pour l’expéditeur
    $wpdb->replace('msg_read_receipts', [
      'message_id'=>$msg_id, 'user_id'=>$current_user_id, 'read_at'=>gmdate('Y-m-d H:i:s')
    ]);
  }

  $wpdb->query('COMMIT');

  // Event
  msg_emit_event('messaging.thread.created', [
    'thread_id'=>$thread_id,
    'subject'=>$subject,
    'created_by'=>$current_user_id,
    'participants'=>$all,
    'is_group'=> count($participants) > 1,
    'created_at'=>gmdate('c')
  ]);

  return ['thread_id'=>$thread_id];
}

function msg_get_thread($current_user_id, $thread_id) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $auth = msg__require_participant($current_user_id, $thread_id);
  if (is_wp_error($auth)) return $auth;

  $t = $wpdb->get_row($wpdb->prepare("SELECT * FROM msg_threads WHERE id=%d", $thread_id), ARRAY_A);
  $ok = msg__wpdb_ok_or_error('get_thread'); if (is_wp_error($ok)) return $ok;

  $parts = $wpdb->get_results($wpdb->prepare(
    "SELECT user_id, role, notif_pref FROM msg_thread_participants
     WHERE thread_id=%d AND left_at IS NULL", $thread_id
  ), ARRAY_A);
  $ok = msg__wpdb_ok_or_error('get_thread_parts'); if (is_wp_error($ok)) return $ok;

  return ['thread'=>$t,'participants'=>$parts];
}

function msg_update_thread($current_user_id, $thread_id, $patch) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $auth = msg__require_participant($current_user_id, $thread_id);
  if (is_wp_error($auth)) return $auth;

  $data = [];
  if (isset($patch['subject']))      $data['subject']    = sanitize_text_field($patch['subject']);
  if (!empty($patch['archived_at'])) $data['archived_at']= gmdate('Y-m-d H:i:s');

  if (!$data) return ['ok'=>true];
  $ok = $wpdb->update('msg_threads', $data, ['id'=>$thread_id]);
  if ($ok===false) return msg__wpdb_ok_or_error('update_thread');

  return ['ok'=>true];
}

function msg_update_participants($current_user_id, $thread_id, $ops) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $auth = msg__require_participant($current_user_id, $thread_id);
  if (is_wp_error($auth)) return $auth;

  foreach ((array)($ops['add'] ?? []) as $uid) {
    $wpdb->replace('msg_thread_participants', [
      'thread_id'=>$thread_id, 'user_id'=>intval($uid), 'role'=>'member'
    ]);
    if ($wpdb->last_error) return msg__wpdb_ok_or_error('add_participant');
  }
  foreach ((array)($ops['remove'] ?? []) as $uid) {
    $wpdb->update('msg_thread_participants', ['left_at'=>gmdate('Y-m-d H:i:s')],
      ['thread_id'=>$thread_id, 'user_id'=>intval($uid)]
    );
    if ($wpdb->last_error) return msg__wpdb_ok_or_error('remove_participant');
  }
  return ['ok'=>true];
}

/* =============================
 * MESSAGES
 * ============================= */
function msg_get_messages($current_user_id, $thread_id, $filters) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $auth = msg__require_participant($current_user_id, $thread_id);
  if (is_wp_error($auth)) return $auth;

  $limit = max(1, intval($filters['limit'] ?? 50));
  $before= $filters['before'] ?? null;
  $after = $filters['after']  ?? null;

  $where = $wpdb->prepare("thread_id=%d AND deleted_at IS NULL", $thread_id);
  $params = [];
  if ($after)  { $where .= $wpdb->prepare(" AND created_at > %s",  $after); }
  if ($before) { $where .= $wpdb->prepare(" AND created_at < %s",  $before); }

  $sql = "
    SELECT id, thread_id, sender_id, body, body_plain, reply_to_id,
           has_attachments, created_at, edited_at
    FROM msg_messages
    WHERE $where
    ORDER BY created_at ASC
    LIMIT %d
  ";
  $rows = $wpdb->get_results($wpdb->prepare($sql, $limit), ARRAY_A);
  $ok = msg__wpdb_ok_or_error('get_messages'); if (is_wp_error($ok)) return $ok;

  if ($rows) {
    $ids = implode(',', array_map('intval', wp_list_pluck($rows, 'id')));
    $atts = $wpdb->get_results("SELECT * FROM msg_attachments WHERE message_id IN ($ids)", ARRAY_A);
    $by = [];
    foreach ($atts as $a) { $by[$a['message_id']][] = $a; }
    foreach ($rows as &$r) { $r['attachments'] = $by[$r['id']] ?? []; }
  }

  return $rows;
}

function msg_post_message($current_user_id, $thread_id, $payload) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $auth = msg__require_participant($current_user_id, $thread_id);
  if (is_wp_error($auth)) return $auth;

  $body = (string)($payload['body'] ?? '');
  if ($body==='') return new WP_Error('bad_request','body requis',['status'=>400]);

  $ok = $wpdb->insert('msg_messages', [
    'thread_id'      => $thread_id,
    'sender_id'      => $current_user_id,
    'body'           => wp_kses_post($body),
    'body_plain'     => wp_strip_all_tags($body),
    'reply_to_id'    => !empty($payload['reply_to_id']) ? intval($payload['reply_to_id']) : null,
    'has_attachments'=> !empty($payload['attachments']) ? 1 : 0
  ]);
  if (!$ok) return msg__wpdb_ok_or_error('post_message');
  $msg_id = intval($wpdb->insert_id);

  foreach ((array)($payload['mentions'] ?? []) as $mid) {
    $wpdb->insert('msg_message_mentions', ['message_id'=>$msg_id, 'mentioned_user_id'=>intval($mid)]);
    if ($wpdb->last_error) return msg__wpdb_ok_or_error('post_message_mentions');
  }
  foreach ((array)($payload['attachments'] ?? []) as $att) {
    $res = msg__save_attachment_row($msg_id, $att);
    if (is_wp_error($res)) return $res;
  }

  // read receipt pour l'expéditeur
  $wpdb->replace('msg_read_receipts', [
    'message_id'=>$msg_id, 'user_id'=>$current_user_id, 'read_at'=>gmdate('Y-m-d H:i:s')
  ]);

  // Event
  msg_emit_event('messaging.message.created', [
    'message_id'=>$msg_id,
    'thread_id'=>$thread_id,
    'sender_id'=>$current_user_id,
    'has_attachments'=> !empty($payload['attachments']),
    'body_excerpt'=> mb_substr(wp_strip_all_tags($body), 0, 160),
    'mentions'=> (array)($payload['mentions'] ?? []),
    'created_at'=>gmdate('c')
  ]);

  return ['message_id'=>$msg_id];
}

function msg_mark_read($current_user_id, $message_id) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $row = $wpdb->get_row($wpdb->prepare("SELECT thread_id FROM msg_messages WHERE id=%d", $message_id), ARRAY_A);
  if (!$row) return new WP_Error('not_found','message introuvable',['status'=>404]);

  $auth = msg__require_participant($current_user_id, intval($row['thread_id']));
  if (is_wp_error($auth)) return $auth;

  $wpdb->replace('msg_read_receipts', [
    'message_id'=>$message_id, 'user_id'=>$current_user_id, 'read_at'=>gmdate('Y-m-d H:i:s')
  ]);
  if ($wpdb->last_error) return msg__wpdb_ok_or_error('mark_read');

  msg_emit_event('messaging.message.read', [
    'message_id'=>$message_id,
    'thread_id'=>intval($row['thread_id']),
    'reader_id'=>$current_user_id,
    'read_at'=>gmdate('c')
  ]);

  return ['ok'=>true];
}

/* =============================
 * RECHERCHE
 * ============================= */
function msg_search($current_user_id, $scope, $query, $limit) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $limit = max(1, intval($limit));
  $like  = '%'.$wpdb->esc_like($query).'%';

  if ($scope === 'threads') {
    $sql = $wpdb->prepare("
      SELECT t.id, t.subject, t.updated_at,
             (SELECT COUNT(m.id)
              FROM msg_messages m
              LEFT JOIN msg_read_receipts r ON r.message_id=m.id AND r.user_id=%d
              WHERE m.thread_id=t.id AND m.deleted_at IS NULL AND m.sender_id<>%d AND r.message_id IS NULL
             ) AS unread_count
      FROM msg_threads t
      JOIN msg_thread_participants p ON p.thread_id=t.id AND p.user_id=%d AND p.left_at IS NULL
      LEFT JOIN (
        SELECT thread_id, MAX(created_at) AS last_created
        FROM msg_messages WHERE deleted_at IS NULL GROUP BY thread_id
      ) lm ON lm.thread_id=t.id
      LEFT JOIN msg_messages lastm ON lastm.thread_id=t.id AND lastm.created_at=lm.last_created
      WHERE (t.subject LIKE %s OR lastm.body_plain LIKE %s)
      ORDER BY t.updated_at DESC
      LIMIT %d
    ", $current_user_id, $current_user_id, $current_user_id, $like, $like, $limit);
    $rows = $wpdb->get_results($sql, ARRAY_A);
    return $rows ?: [];
  }

  // scope=messages
  $sql = $wpdb->prepare("
    SELECT m.id, m.thread_id, m.sender_id, m.created_at, m.body_plain, t.subject
    FROM msg_messages m
    JOIN msg_threads t ON t.id=m.thread_id
    JOIN msg_thread_participants p ON p.thread_id=m.thread_id AND p.user_id=%d AND p.left_at IS NULL
    WHERE (m.body_plain LIKE %s OR t.subject LIKE %s) AND m.deleted_at IS NULL
    ORDER BY m.created_at DESC
    LIMIT %d
  ", $current_user_id, $like, $like, $limit);
  $rows = $wpdb->get_results($sql, ARRAY_A);
  return $rows ?: [];
}

/* =============================
 * BROUILLONS
 * ============================= */
function msg_get_drafts($current_user_id) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $rows = $wpdb->get_results($wpdb->prepare(
    "SELECT * FROM msg_drafts WHERE author_id=%d ORDER BY updated_at DESC", $current_user_id
  ), ARRAY_A);
  return $rows ?: [];
}

function msg_save_draft($current_user_id, $payload) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $data = [
    'author_id' => $current_user_id,
    'body'      => wp_kses_post((string)($payload['body'] ?? '')),
  ];
  if (!empty($payload['thread_id'])) $data['thread_id'] = intval($payload['thread_id']);
  $ok = $wpdb->insert('msg_drafts', $data);
  if (!$ok) return msg__wpdb_ok_or_error('save_draft');
  return ['draft_id'=>intval($wpdb->insert_id)];
}

function msg_delete_draft($current_user_id, $draft_id) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $ok = $wpdb->query($wpdb->prepare(
    "DELETE FROM msg_drafts WHERE id=%d AND author_id=%d", $draft_id, $current_user_id
  ));
  return ['deleted'=> (bool)$ok];
}

/* =============================
 * PIECES JOINTES
 * ============================= */
function msg_upload_attachment($current_user_id, $payload) {
  global $wpdb;
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $msg_id   = intval($payload['message_id'] ?? 0);
  $fileName = sanitize_file_name($payload['file_name'] ?? 'file.bin');
  $mime     = sanitize_mime_type($payload['mime_type'] ?? 'application/octet-stream');
  $content  = (string)($payload['content'] ?? '');

  if (!$msg_id || !$content) return new WP_Error('bad_request','message_id et content requis',['status'=>400]);

  $row = $wpdb->get_row($wpdb->prepare("SELECT thread_id FROM msg_messages WHERE id=%d", $msg_id), ARRAY_A);
  if (!$row) return new WP_Error('not_found','message introuvable',['status'=>404]);

  $auth = msg__require_participant($current_user_id, intval($row['thread_id']));
  if (is_wp_error($auth)) return $auth;

  // Base64 → binaire
  $data = preg_replace('#^data:[^;]+;base64,#','',$content);
  $bin  = base64_decode($data);
  if ($bin===false) return new WP_Error('bad_request','base64 invalide',['status'=>400]);

  list($dir,$baseurl) = msg__uploads_dir_messages();
  $path = trailingslashit($dir).uniqid('att_').'-'.$fileName;
  file_put_contents($path, $bin);
  $url  = trailingslashit($baseurl).basename($path);

  $wpdb->insert('msg_attachments', [
    'message_id'=>$msg_id,
    'file_name' =>$fileName,
    'mime_type' =>$mime,
    'file_size' =>strlen($bin),
    'storage_url'=>$url,
    'sha256'    =>hash('sha256',$bin),
  ]);
  if ($wpdb->last_error) return msg__wpdb_ok_or_error('upload_attachment');

  return ['attachment_id'=>intval($wpdb->insert_id), 'url'=>$url];
}

/* Sauvegarde d’une pièce jointe depuis payload message (base64 ou storage_url) */
function msg__save_attachment_row($msg_id, $att) {
  global $wpdb;
  // Si déjà uploadé/pré-signé
  if (!empty($att['storage_url'])) {
    $wpdb->insert('msg_attachments', [
      'message_id'=>$msg_id,
      'file_name' => sanitize_file_name($att['name'] ?? 'file.bin'),
      'mime_type' => sanitize_mime_type($att['mime'] ?? 'application/octet-stream'),
      'file_size' => intval($att['size'] ?? 0),
      'storage_url'=> esc_url_raw($att['storage_url']),
      'sha256'    => sanitize_text_field($att['sha256'] ?? str_repeat('0',64)),
    ]);
    if ($wpdb->last_error) return msg__wpdb_ok_or_error('save_attachment_presigned');
    return true;
  }

  // Sinon base64
  if (!empty($att['content'])) {
    return msg_upload_attachment(get_current_user_id(), [
      'message_id'=>$msg_id,
      'file_name' => $att['name'] ?? 'file.bin',
      'mime_type' => $att['mime'] ?? 'application/octet-stream',
      'content'   => $att['content'],
    ]);
  }
  return true;
}
