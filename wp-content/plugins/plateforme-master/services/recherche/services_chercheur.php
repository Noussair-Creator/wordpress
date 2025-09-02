<?php
if (!defined('ABSPATH')) { exit; }

/* ---------- Helpers génériques ---------- */
function svc_now(){ return current_time('mysql'); }
function svc_table_exists($table){
  global $wpdb;
  $like = $wpdb->esc_like($table);
  $exists = $wpdb->get_var( $wpdb->prepare("SHOW TABLES LIKE %s", $like) );
  return strtolower($exists) === strtolower($table);
}
function svc_pub_table(){ global $wpdb; return $wpdb->prefix . 'recherche_publication'; }
function svc_pub_allowed(){
  return array('date_publication','titre','type','fichier_url','resume','commentaire','chercheur_id');
}
function svc_pick($src, $keys){
  $out=array();
  foreach($keys as $k){ if(array_key_exists($k,$src)) $out[$k]=$src[$k]; }
  return $out;
}
function svc_current_user_id(){ return get_current_user_id(); }
function svc_is_admin(){ return current_user_can('manage_options'); }

/* ---------- LIST ---------- */
function svc_publication_list(WP_REST_Request $req){
  global $wpdb;
  $table = svc_pub_table();
  if(!svc_table_exists($table)){
    return new WP_Error('missing_table','Table publication manquante: '.$table, array('status'=>500));
  }
  $me    = svc_current_user_id();
  $per   = max(1, min(100, intval($req->get_param('per_page')?:50)));
  $paged = max(1, intval($req->get_param('paged')?:1));
  $offset= ($paged-1)*$per;

  $where = "WHERE (deleted_at IS NULL OR deleted_at='0000-00-00 00:00:00')";
  $params = array();
  if(!svc_is_admin()){
    $where  .= " AND chercheur_id=%d";
    $params[] = $me;
  }

  $items = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$table} {$where} ORDER BY date_publication DESC, id DESC LIMIT %d OFFSET %d", array_merge($params, array($per, $offset))),
    ARRAY_A
  );
  $total = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM {$table} {$where}", $params) );

  return array(
    'items'    => $items ?: array(),
    'total'    => intval($total),
    'per_page' => $per,
    'paged'    => $paged
  );
}

/* ---------- GET ---------- */
function svc_publication_get(WP_REST_Request $req){
  global $wpdb;
  $table = svc_pub_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A );
  if(!$row) return new WP_Error('not_found','Publication introuvable', array('status'=>404));
  if(!svc_is_admin() && intval($row['chercheur_id']) !== svc_current_user_id()){
    return new WP_Error('forbidden','Accès refusé', array('status'=>403));
  }
  return $row;
}

/* ---------- CREATE ---------- */
function svc_publication_create(WP_REST_Request $req){
  global $wpdb;
  $table = svc_pub_table();
  if(!svc_table_exists($table)){
    return new WP_Error('missing_table','Table publication manquante: '.$table, array('status'=>500));
  }
  $d = $req->get_json_params();
  $date  = sanitize_text_field($d['date_publication'] ?? '');
  $titre = sanitize_text_field($d['titre'] ?? '');
  $type  = sanitize_text_field($d['type'] ?? '');
  if(!$date || !$titre || !$type){
    return new WP_Error('bad_request','date_publication, titre, type requis', array('status'=>400));
  }

  $data = array(
    'chercheur_id'   => isset($d['chercheur_id']) ? intval($d['chercheur_id']) : svc_current_user_id(),
    'date_publication'=> $date,
    'titre'          => $titre,
    'type'           => $type,
    'fichier_url'    => sanitize_text_field($d['fichier_url'] ?? ''),
    'resume'         => sanitize_text_field($d['resume'] ?? ''),
    'commentaire'    => sanitize_textarea_field($d['commentaire'] ?? ''),
    'created_at'     => svc_now(),
    'updated_at'     => svc_now(),
  );
  $ok = $wpdb->insert($table, $data);
  if(!$ok){
    error_log('[publication.create] '.$wpdb->last_error);
    return new WP_Error('sql_error','Échec insertion', array('status'=>500));
  }
  return array('id'=>intval($wpdb->insert_id));
}

/* ---------- UPDATE (PUT/PATCH) ---------- */
function svc_publication_update(WP_REST_Request $req){
  global $wpdb;
  $table = svc_pub_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A );
  if(!$row) return new WP_Error('not_found','Publication introuvable', array('status'=>404));
  if(!svc_is_admin() && intval($row['chercheur_id']) !== svc_current_user_id()){
    return new WP_Error('forbidden','Accès refusé', array('status'=>403));
  }

  $d = $req->get_json_params();
  $allowed = svc_pub_allowed();
  $update = array();
  foreach($allowed as $k){
    if(array_key_exists($k,$d)){
      $update[$k] = ($k==='commentaire')
        ? sanitize_textarea_field($d[$k])
        : sanitize_text_field($d[$k]);
    }
  }
  if(!$update) return array('ok'=>true);
  $update['updated_at'] = svc_now();

  $ok = $wpdb->update($table, $update, array('id'=>$id));
  if($ok===false){
    error_log('[publication.update] '.$wpdb->last_error);
    return new WP_Error('sql_error','Échec mise à jour', array('status'=>500));
  }
  return array('ok'=>true);
}

/* ---------- DELETE (soft) ---------- */
function svc_publication_delete(WP_REST_Request $req){
  global $wpdb;
  $table = svc_pub_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A );
  if(!$row) return new WP_Error('not_found','Publication introuvable', array('status'=>404));
  if(!svc_is_admin() && intval($row['chercheur_id']) !== svc_current_user_id()){
    return new WP_Error('forbidden','Accès refusé', array('status'=>403));
  }
  // soft-delete si la colonne existe
  $has_deleted = $wpdb->get_var( $wpdb->prepare(
    "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=%s AND COLUMN_NAME='deleted_at'",
    $table
  ));
  if($has_deleted){
    $ok = $wpdb->update($table, array('deleted_at'=>svc_now()), array('id'=>$id));
    if($ok===false) return new WP_Error('sql_error','Échec suppression', array('status'=>500));
    return array('deleted'=>true,'soft'=>true);
  }
  // sinon hard delete
  $ok = $wpdb->delete($table, array('id'=>$id));
  return array('deleted'=> (bool)$ok, 'soft'=>false);
}
