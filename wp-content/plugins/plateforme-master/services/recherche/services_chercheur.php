<?php
/** Services chercheur — tables $wpdb->prefix . 'recherche_<entite>' */
if (!defined('ABSPATH')) { exit; }

function svc_read_input(WP_REST_Request $req){
  $data = $req->get_json_params();
  if (empty($data) || !is_array($data)) { $data = $req->get_body_params(); }
  if (empty($data) || !is_array($data)) { $data = $req->get_params(); }
  return is_array($data) ? $data : array();
}

// === chercheur ===
function svc_chercheur_table(){ global $wpdb; return $wpdb->prefix . 'recherche_chercheur'; }
function svc_chercheur_allowed(){ return array('email', 'nom', 'prenom', 'grade', 'laboratoire_id', 'orcid', 'photo_url', 'site_web', 'specialite'); }

function svc_chercheur_list(WP_REST_Request $req){
  global $wpdb; $table = svc_chercheur_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_chercheur_get(WP_REST_Request $req){
  global $wpdb; $table = svc_chercheur_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_chercheur_create(WP_REST_Request $req){
  global $wpdb; $table = svc_chercheur_table(); $allowed = svc_chercheur_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_chercheur_update(WP_REST_Request $req){
  global $wpdb; $table = svc_chercheur_table(); $allowed = svc_chercheur_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_chercheur_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_chercheur_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === document ===
function svc_document_table(){ global $wpdb; return $wpdb->prefix . 'recherche_document'; }
function svc_document_allowed(){ return array('fichier_path', 'titre', 'chercheur_id', 'date_upload', 'type', 'visibility'); }

function svc_document_list(WP_REST_Request $req){
  global $wpdb; $table = svc_document_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_document_get(WP_REST_Request $req){
  global $wpdb; $table = svc_document_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_document_create(WP_REST_Request $req){
  global $wpdb; $table = svc_document_table(); $allowed = svc_document_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_document_update(WP_REST_Request $req){
  global $wpdb; $table = svc_document_table(); $allowed = svc_document_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_document_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_document_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === enseignement ===
function svc_enseignement_table(){ global $wpdb; return $wpdb->prefix . 'recherche_enseignement'; }
function svc_enseignement_allowed(){ return array('annee_universitaire', 'ue', 'volume_horaire', 'chercheur_id', 'niveau', 'semestre', 'type'); }

function svc_enseignement_list(WP_REST_Request $req){
  global $wpdb; $table = svc_enseignement_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_enseignement_get(WP_REST_Request $req){
  global $wpdb; $table = svc_enseignement_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_enseignement_create(WP_REST_Request $req){
  global $wpdb; $table = svc_enseignement_table(); $allowed = svc_enseignement_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_enseignement_update(WP_REST_Request $req){
  global $wpdb; $table = svc_enseignement_table(); $allowed = svc_enseignement_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_enseignement_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_enseignement_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === laboratoire ===
function svc_laboratoire_table(){ global $wpdb; return $wpdb->prefix . 'recherche_laboratoire'; }
function svc_laboratoire_allowed(){ return array(); }

function svc_laboratoire_list(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_laboratoire_get(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_laboratoire_create(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $allowed = svc_laboratoire_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_laboratoire_update(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $allowed = svc_laboratoire_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_laboratoire_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === manifestation ===
function svc_manifestation_table(){ global $wpdb; return $wpdb->prefix . 'recherche_manifestation'; }
function svc_manifestation_allowed(){ return array('date', 'intitule', 'type', 'chercheur_id', 'lieu', 'preuve_url', 'role'); }

function svc_manifestation_list(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_manifestation_get(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_manifestation_create(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $allowed = svc_manifestation_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_manifestation_update(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $allowed = svc_manifestation_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_manifestation_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === notification ===
function svc_notification_table(){ global $wpdb; return $wpdb->prefix . 'recherche_notification'; }
function svc_notification_allowed(){ return array('lu', 'chercheur_id'); }

function svc_notification_list(WP_REST_Request $req){
  global $wpdb; $table = svc_notification_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_notification_get(WP_REST_Request $req){
  global $wpdb; $table = svc_notification_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_notification_create(WP_REST_Request $req){
  global $wpdb; $table = svc_notification_table(); $allowed = svc_notification_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_notification_update(WP_REST_Request $req){
  global $wpdb; $table = svc_notification_table(); $allowed = svc_notification_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_notification_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_notification_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === projet ===
function svc_projet_table(){ global $wpdb; return $wpdb->prefix . 'recherche_projet'; }
function svc_projet_allowed(){ return array('date_debut', 'titre', 'budget', 'chercheur_id', 'date_fin', 'resume', 'statut', 'type_financement'); }

function svc_projet_list(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_projet_get(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_projet_create(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_table(); $allowed = svc_projet_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_projet_update(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_table(); $allowed = svc_projet_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_projet_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === projet_membre ===
function svc_projet_membre_table(){ global $wpdb; return $wpdb->prefix . 'recherche_projet_membre'; }
function svc_projet_membre_allowed(){ return array('chercheur_id', 'projet_id', 'role_projet'); }

function svc_projet_membre_list(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_membre_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_projet_membre_get(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_membre_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_projet_membre_create(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_membre_table(); $allowed = svc_projet_membre_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_projet_membre_update(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_membre_table(); $allowed = svc_projet_membre_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_projet_membre_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_projet_membre_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === publication ===
function svc_publication_table(){ global $wpdb; return $wpdb->prefix . 'recherche_publication'; }
function svc_publication_allowed(){
  return array('date_publication','titre','type'  ,'fichier_url',
               // nouveaux champs :
               'resume','commentaire');
}

function svc_publication_list(WP_REST_Request $req){
  global $wpdb; $table = svc_publication_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_publication_get(WP_REST_Request $req){
  global $wpdb; $table = svc_publication_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_publication_create(WP_REST_Request $req){
  global $wpdb; $table = svc_publication_table(); $allowed = svc_publication_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_publication_update(WP_REST_Request $req){
  global $wpdb; $table = svc_publication_table(); $allowed = svc_publication_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_publication_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_publication_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === reunion ===
function svc_reunion_table(){ global $wpdb; return $wpdb->prefix . 'recherche_reunion'; }
function svc_reunion_allowed(){ return array('date', 'sujet', 'chercheur_id', 'compte_rendu_url', 'lien_visio', 'type'); }

function svc_reunion_list(WP_REST_Request $req){
  global $wpdb; $table = svc_reunion_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_reunion_get(WP_REST_Request $req){
  global $wpdb; $table = svc_reunion_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_reunion_create(WP_REST_Request $req){
  global $wpdb; $table = svc_reunion_table(); $allowed = svc_reunion_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_reunion_update(WP_REST_Request $req){
  global $wpdb; $table = svc_reunion_table(); $allowed = svc_reunion_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_reunion_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_reunion_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === these ===
function svc_these_table(){ global $wpdb; return $wpdb->prefix . 'recherche_these'; }
function svc_these_allowed(){ return array('date_debut', 'doctorant_nom', 'sujet', 'date_soutenance', 'encadrant_id', 'statut'); }

function svc_these_list(WP_REST_Request $req){
  global $wpdb; $table = svc_these_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_these_get(WP_REST_Request $req){
  global $wpdb; $table = svc_these_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_these_create(WP_REST_Request $req){
  global $wpdb; $table = svc_these_table(); $allowed = svc_these_allowed();
  $data = svc_read_input($req); $ins = array();
  foreach ($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $ins[$k]=$v;
    }
  }
  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins); if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id; return array('id'=>$id) + $ins;
}

function svc_these_update(WP_REST_Request $req){
  global $wpdb; $table = svc_these_table(); $allowed = svc_these_allowed();
  $id = intval($req['id']); $data = svc_read_input($req); $upd = array();
  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      if ($k === 'email') { $v = sanitize_email($data[$k]); }
      else { $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]); }
      $upd[$k]=$v;
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->update($table, $upd, array('id'=>$id)); if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

function svc_these_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_these_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

