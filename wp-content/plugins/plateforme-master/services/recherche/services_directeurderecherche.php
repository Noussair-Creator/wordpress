<?php
/** Services directeurderecherche — tables $wpdb->prefix . 'recherche_<entite>' */
if (!defined('ABSPATH')) { exit; }



// === activite_doc ===
function svc_activite_doc_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_doc'; }
function svc_activite_doc_allowed(){ return array('activite_id', 'fichier'); }

function svc_activite_doc_list(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_doc_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_activite_doc_get(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_doc_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_activite_doc_create(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_doc_table(); $allowed = svc_activite_doc_allowed();
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

function svc_activite_doc_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_doc_table(); $allowed = svc_activite_doc_allowed();
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

function svc_activite_doc_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_doc_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === activite_indicateur ===
function svc_activite_indicateur_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_indicateur'; }
function svc_activite_indicateur_allowed(){ return array('activite_id', 'resultat_obtenu'); }

function svc_activite_indicateur_list(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_indicateur_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_activite_indicateur_get(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_indicateur_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_activite_indicateur_create(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_indicateur_table(); $allowed = svc_activite_indicateur_allowed();
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

function svc_activite_indicateur_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_indicateur_table(); $allowed = svc_activite_indicateur_allowed();
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

function svc_activite_indicateur_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_indicateur_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === activite_quotidienne ===
function svc_activite_quotidienne_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_quotidienne'; }
function svc_activite_quotidienne_allowed(){ return array('date', 'heure_debut', 'heure_fin', 'membre_id', 'titre', 'type_activite'); }

function svc_activite_quotidienne_list(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_activite_quotidienne_get(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_activite_quotidienne_create(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table(); $allowed = svc_activite_quotidienne_allowed();
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

function svc_activite_quotidienne_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table(); $allowed = svc_activite_quotidienne_allowed();
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

function svc_activite_quotidienne_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === activite_scientifique ===
function svc_activite_scientifique_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_scientifique'; }
function svc_activite_scientifique_allowed(){ return array('annee', 'auteur_principal', 'titre_reference', 'type'); }

function svc_activite_scientifique_list(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_activite_scientifique_get(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_activite_scientifique_create(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_table(); $allowed = svc_activite_scientifique_allowed();
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

function svc_activite_scientifique_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_table(); $allowed = svc_activite_scientifique_allowed();
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

function svc_activite_scientifique_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === activite_scientifique_doc ===
function svc_activite_scientifique_doc_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_scientifique_doc'; }
function svc_activite_scientifique_doc_allowed(){ return array('activite_id', 'fichier'); }

function svc_activite_scientifique_doc_list(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_doc_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_activite_scientifique_doc_get(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_doc_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_activite_scientifique_doc_create(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_doc_table(); $allowed = svc_activite_scientifique_doc_allowed();
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

function svc_activite_scientifique_doc_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_doc_table(); $allowed = svc_activite_scientifique_doc_allowed();
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

function svc_activite_scientifique_doc_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_scientifique_doc_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === actualite ===
function svc_actualite_table(){ global $wpdb; return $wpdb->prefix . 'recherche_actualite'; }
function svc_actualite_allowed(){ return array(); }

function svc_actualite_list(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_actualite_get(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_actualite_create(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_table(); $allowed = svc_actualite_allowed();
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

function svc_actualite_update(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_table(); $allowed = svc_actualite_allowed();
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

function svc_actualite_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === actualite_labo ===
function svc_actualite_labo_table(){ global $wpdb; return $wpdb->prefix . 'recherche_actualite_labo'; }
function svc_actualite_labo_allowed(){ return array('categorie', 'date_publication', 'titre'); }

function svc_actualite_labo_list(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_labo_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_actualite_labo_get(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_labo_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_actualite_labo_create(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_labo_table(); $allowed = svc_actualite_labo_allowed();
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

function svc_actualite_labo_update(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_labo_table(); $allowed = svc_actualite_labo_allowed();
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

function svc_actualite_labo_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_actualite_labo_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === equipement ===
function svc_equipement_table(){ global $wpdb; return $wpdb->prefix . 'recherche_equipement'; }
function svc_equipement_allowed(){ return array('categorie', 'disponibilite', 'modele', 'nom_appareil', 'statut'); }

function svc_equipement_list(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_equipement_get(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_equipement_create(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_table(); $allowed = svc_equipement_allowed();
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

function svc_equipement_update(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_table(); $allowed = svc_equipement_allowed();
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

function svc_equipement_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === equipement_contrat ===
function svc_equipement_contrat_table(){ global $wpdb; return $wpdb->prefix . 'recherche_equipement_contrat'; }
function svc_equipement_contrat_allowed(){ return array('fichier'); }

function svc_equipement_contrat_list(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_contrat_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_equipement_contrat_get(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_contrat_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_equipement_contrat_create(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_contrat_table(); $allowed = svc_equipement_contrat_allowed();
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

function svc_equipement_contrat_update(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_contrat_table(); $allowed = svc_equipement_contrat_allowed();
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

function svc_equipement_contrat_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_contrat_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === equipement_protocole ===
function svc_equipement_protocole_table(){ global $wpdb; return $wpdb->prefix . 'recherche_equipement_protocole'; }
function svc_equipement_protocole_allowed(){ return array('fichier'); }

function svc_equipement_protocole_list(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_protocole_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_equipement_protocole_get(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_protocole_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_equipement_protocole_create(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_protocole_table(); $allowed = svc_equipement_protocole_allowed();
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

function svc_equipement_protocole_update(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_protocole_table(); $allowed = svc_equipement_protocole_allowed();
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

function svc_equipement_protocole_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_equipement_protocole_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === maintenance ===
function svc_maintenance_table(){ global $wpdb; return $wpdb->prefix . 'recherche_maintenance'; }
function svc_maintenance_allowed(){ return array('date_debut', 'date_fin', 'equipement_id'); }

function svc_maintenance_list(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_maintenance_get(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_maintenance_create(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $allowed = svc_maintenance_allowed();
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

function svc_maintenance_update(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $allowed = svc_maintenance_allowed();
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

function svc_maintenance_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === participation_request ===
function svc_participation_request_table(){ global $wpdb; return $wpdb->prefix . 'recherche_participation_request'; }
function svc_participation_request_allowed(){ return array('decision'); }

function svc_participation_request_list(WP_REST_Request $req){
  global $wpdb; $table = svc_participation_request_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_participation_request_get(WP_REST_Request $req){
  global $wpdb; $table = svc_participation_request_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_participation_request_create(WP_REST_Request $req){
  global $wpdb; $table = svc_participation_request_table(); $allowed = svc_participation_request_allowed();
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

function svc_participation_request_update(WP_REST_Request $req){
  global $wpdb; $table = svc_participation_request_table(); $allowed = svc_participation_request_allowed();
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

function svc_participation_request_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_participation_request_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === rapport_aq ===
function svc_rapport_aq_table(){ global $wpdb; return $wpdb->prefix . 'recherche_rapport_aq'; }
function svc_rapport_aq_allowed(){ return array(); }

function svc_rapport_aq_list(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_aq_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_rapport_aq_get(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_aq_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_rapport_aq_create(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_aq_table(); $allowed = svc_rapport_aq_allowed();
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

function svc_rapport_aq_update(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_aq_table(); $allowed = svc_rapport_aq_allowed();
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

function svc_rapport_aq_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_aq_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === rapport_reservations ===
function svc_rapport_reservations_table(){ global $wpdb; return $wpdb->prefix . 'recherche_rapport_reservations'; }
function svc_rapport_reservations_allowed(){ return array(); }

function svc_rapport_reservations_list(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_reservations_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_rapport_reservations_get(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_reservations_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_rapport_reservations_create(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_reservations_table(); $allowed = svc_rapport_reservations_allowed();
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

function svc_rapport_reservations_update(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_reservations_table(); $allowed = svc_rapport_reservations_allowed();
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

function svc_rapport_reservations_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_reservations_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === rapport_scientifique ===
function svc_rapport_scientifique_table(){ global $wpdb; return $wpdb->prefix . 'recherche_rapport_scientifique'; }
function svc_rapport_scientifique_allowed(){ return array(); }

function svc_rapport_scientifique_list(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_scientifique_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_rapport_scientifique_get(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_scientifique_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_rapport_scientifique_create(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_scientifique_table(); $allowed = svc_rapport_scientifique_allowed();
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

function svc_rapport_scientifique_update(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_scientifique_table(); $allowed = svc_rapport_scientifique_allowed();
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

function svc_rapport_scientifique_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_rapport_scientifique_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

// === reservation ===
function svc_reservation_table(){ global $wpdb; return $wpdb->prefix . 'recherche_reservation'; }
function svc_reservation_allowed(){ return array('statut'); }

function svc_reservation_list(WP_REST_Request $req){
  global $wpdb; $table = svc_reservation_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;
  $sql  = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_reservation_get(WP_REST_Request $req){
  global $wpdb; $table = svc_reservation_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

function svc_reservation_create(WP_REST_Request $req){
  global $wpdb; $table = svc_reservation_table(); $allowed = svc_reservation_allowed();
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

function svc_reservation_update(WP_REST_Request $req){
  global $wpdb; $table = svc_reservation_table(); $allowed = svc_reservation_allowed();
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

function svc_reservation_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_reservation_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}

