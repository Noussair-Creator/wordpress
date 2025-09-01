<?php
/** Services chercheur — tables $wpdb->prefix . 'pmo_<entite>' */
if (!defined('ABSPATH')) { exit; }

function svc_read_input(WP_REST_Request $req){
  $data = $req->get_json_params();
  if (empty($data) || !is_array($data)) { $data = $req->get_body_params(); }
  if (empty($data) || !is_array($data)) { $data = $req->get_params(); }
  return is_array($data) ? $data : array();
}

// === document ===
function svc_document_table(){ global $wpdb; return $wpdb->prefix . 'pmo_document'; }
function svc_document_allowed(){ return array('categorie', 'piece_jointe', 'titre', 'visibilite'); }

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

// === document_download ===
function svc_document_download_table(){ global $wpdb; return $wpdb->prefix . 'pmo_document_download'; }
function svc_document_download_allowed(){ return array(); }

function svc_document_download_list(WP_REST_Request $req){
  global $wpdb; $table = svc_document_download_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_document_download_get(WP_REST_Request $req){
  global $wpdb; $table = svc_document_download_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_document_download_create(WP_REST_Request $req){
  global $wpdb; $table = svc_document_download_table(); $allowed = svc_document_download_allowed();
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

function svc_document_download_update(WP_REST_Request $req){
  global $wpdb; $table = svc_document_download_table(); $allowed = svc_document_download_allowed();
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

function svc_document_download_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_document_download_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === document_export ===
function svc_document_export_table(){ global $wpdb; return $wpdb->prefix . 'pmo_document_export'; }
function svc_document_export_allowed(){ return array(); }

function svc_document_export_list(WP_REST_Request $req){
  global $wpdb; $table = svc_document_export_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_document_export_get(WP_REST_Request $req){
  global $wpdb; $table = svc_document_export_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_document_export_create(WP_REST_Request $req){
  global $wpdb; $table = svc_document_export_table(); $allowed = svc_document_export_allowed();
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

function svc_document_export_update(WP_REST_Request $req){
  global $wpdb; $table = svc_document_export_table(); $allowed = svc_document_export_allowed();
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

function svc_document_export_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_document_export_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === organisation_membre ===
function svc_organisation_membre_table(){ global $wpdb; return $wpdb->prefix . 'pmo_organisation_membre'; }
function svc_organisation_membre_allowed(){ return array('email', 'nom_complet', 'role'); }

function svc_organisation_membre_list(WP_REST_Request $req){
  global $wpdb; $table = svc_organisation_membre_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_organisation_membre_get(WP_REST_Request $req){
  global $wpdb; $table = svc_organisation_membre_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_organisation_membre_create(WP_REST_Request $req){
  global $wpdb; $table = svc_organisation_membre_table(); $allowed = svc_organisation_membre_allowed();
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

function svc_organisation_membre_update(WP_REST_Request $req){
  global $wpdb; $table = svc_organisation_membre_table(); $allowed = svc_organisation_membre_allowed();
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

function svc_organisation_membre_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_organisation_membre_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === plateforme ===
function svc_plateforme_table(){ global $wpdb; return $wpdb->prefix . 'pmo_plateforme'; }
function svc_plateforme_allowed(){ return array('domaine', 'nom', 'responsable_id'); }

function svc_plateforme_list(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_plateforme_get(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_plateforme_create(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_table(); $allowed = svc_plateforme_allowed();
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

function svc_plateforme_update(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_table(); $allowed = svc_plateforme_allowed();
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

function svc_plateforme_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === plateforme_document ===
function svc_plateforme_document_table(){ global $wpdb; return $wpdb->prefix . 'pmo_plateforme_document'; }
function svc_plateforme_document_allowed(){ return array('fichier'); }

function svc_plateforme_document_list(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_document_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_plateforme_document_get(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_document_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_plateforme_document_create(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_document_table(); $allowed = svc_plateforme_document_allowed();
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

function svc_plateforme_document_update(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_document_table(); $allowed = svc_plateforme_document_allowed();
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

function svc_plateforme_document_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_document_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === plateforme_export ===
function svc_plateforme_export_table(){ global $wpdb; return $wpdb->prefix . 'pmo_plateforme_export'; }
function svc_plateforme_export_allowed(){ return array(); }

function svc_plateforme_export_list(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_export_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_plateforme_export_get(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_export_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_plateforme_export_create(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_export_table(); $allowed = svc_plateforme_export_allowed();
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

function svc_plateforme_export_update(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_export_table(); $allowed = svc_plateforme_export_allowed();
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

function svc_plateforme_export_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_plateforme_export_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === pmo_dashboard ===
function svc_pmo_dashboard_table(){ global $wpdb; return $wpdb->prefix . 'pmo_pmo_dashboard'; }
function svc_pmo_dashboard_allowed(){ return array(); }

function svc_pmo_dashboard_list(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_dashboard_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_pmo_dashboard_get(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_dashboard_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_pmo_dashboard_create(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_dashboard_table(); $allowed = svc_pmo_dashboard_allowed();
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

function svc_pmo_dashboard_update(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_dashboard_table(); $allowed = svc_pmo_dashboard_allowed();
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

function svc_pmo_dashboard_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_dashboard_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === pmo_report ===
function svc_pmo_report_table(){ global $wpdb; return $wpdb->prefix . 'pmo_pmo_report'; }
function svc_pmo_report_allowed(){ return array(); }

function svc_pmo_report_list(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_report_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_pmo_report_get(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_report_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_pmo_report_create(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_report_table(); $allowed = svc_pmo_report_allowed();
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

function svc_pmo_report_update(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_report_table(); $allowed = svc_pmo_report_allowed();
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

function svc_pmo_report_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_pmo_report_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === presentation_ceip ===
function svc_presentation_ceip_table(){ global $wpdb; return $wpdb->prefix . 'pmo_presentation_ceip'; }
function svc_presentation_ceip_allowed(){ return array(); }

function svc_presentation_ceip_list(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_presentation_ceip_get(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_presentation_ceip_create(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_table(); $allowed = svc_presentation_ceip_allowed();
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

function svc_presentation_ceip_update(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_table(); $allowed = svc_presentation_ceip_allowed();
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

function svc_presentation_ceip_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === presentation_ceip_publish ===
function svc_presentation_ceip_publish_table(){ global $wpdb; return $wpdb->prefix . 'pmo_presentation_ceip_publish'; }
function svc_presentation_ceip_publish_allowed(){ return array(); }

function svc_presentation_ceip_publish_list(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_publish_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_presentation_ceip_publish_get(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_publish_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_presentation_ceip_publish_create(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_publish_table(); $allowed = svc_presentation_ceip_publish_allowed();
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

function svc_presentation_ceip_publish_update(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_publish_table(); $allowed = svc_presentation_ceip_publish_allowed();
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

function svc_presentation_ceip_publish_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_presentation_ceip_publish_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === requete ===
function svc_requete_table(){ global $wpdb; return $wpdb->prefix . 'pmo_requete'; }
function svc_requete_allowed(){ return array('priorite', 'statut', 'titre', 'type'); }

function svc_requete_list(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_requete_get(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_requete_create(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_table(); $allowed = svc_requete_allowed();
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

function svc_requete_update(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_table(); $allowed = svc_requete_allowed();
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

function svc_requete_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === requete_export ===
function svc_requete_export_table(){ global $wpdb; return $wpdb->prefix . 'pmo_requete_export'; }
function svc_requete_export_allowed(){ return array(); }

function svc_requete_export_list(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_export_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_requete_export_get(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_export_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_requete_export_create(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_export_table(); $allowed = svc_requete_export_allowed();
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

function svc_requete_export_update(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_export_table(); $allowed = svc_requete_export_allowed();
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

function svc_requete_export_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_export_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === requete_piece_jointe ===
function svc_requete_piece_jointe_table(){ global $wpdb; return $wpdb->prefix . 'pmo_requete_piece_jointe'; }
function svc_requete_piece_jointe_allowed(){ return array('fichier'); }

function svc_requete_piece_jointe_list(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_piece_jointe_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_requete_piece_jointe_get(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_piece_jointe_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_requete_piece_jointe_create(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_piece_jointe_table(); $allowed = svc_requete_piece_jointe_allowed();
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

function svc_requete_piece_jointe_update(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_piece_jointe_table(); $allowed = svc_requete_piece_jointe_allowed();
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

function svc_requete_piece_jointe_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_requete_piece_jointe_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

