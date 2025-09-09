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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
if (!defined('ABSPATH')) { exit; }

// Tables helpers
function svc_categorie_table(){ global $wpdb; return $wpdb->prefix . 'recherche_categorie_equipement'; }
function svc_dispo_table(){ global $wpdb; return $wpdb->prefix . 'recherche_disponibilite_equipement'; }

// Champs autorisés (alignés BD)
function svc_equipement_allowed(){
  return array('categorie_id','disponibilite_id','modele','nom_appareil','statut','spcification_technique');
}

// Petite aide lecture (JSON body / form-data)
function svc_read_input2($req){
  $data = $req->get_json_params();
  if (!is_array($data) || !count($data)) { $data = $req->get_params(); }
  return is_array($data) ? $data : array();
}

// helper si non défini
if (!function_exists('svc_equipement_protocole_table')) {
  function svc_equipement_protocole_table(){ global $wpdb; return $wpdb->prefix . 'recherche_equipement_protocole'; }
}

function svc_equipement_list(WP_REST_Request $req){
  global $wpdb;
  $t  = svc_equipement_table();
  $tc = svc_categorie_table();
  $td = svc_dispo_table();
  $tp = svc_equipement_protocole_table();

  // --- user connecté obligatoire ---
  $uid = get_current_user_id();
  if (!$uid) {
    return new WP_Error('forbidden', 'Authentication required', array('status' => 401));
  }

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $where = array();
  $args  = array();

  // 🔓 all=1 => on n’applique PAS le filtre par user_id
  // Les administrateurs voient tout même sans all=1
  $all = intval($req->get_param('all'));
  if ( ! $all && ! current_user_can('manage_options') ) {
    $where[] = "e.user_id = %d";
    $args[]  = absint($uid);
  }

  if($all){
        $where[] = "e.disponibilite_id = 1";

  }

  // Recherche plein-texte simple
  if ($q = trim((string)$req->get_param('q'))) {
    $where[] = "(e.nom_appareil LIKE %s OR e.modele LIKE %s)";
    $args[] = '%'.$wpdb->esc_like($q).'%';
    $args[] = '%'.$wpdb->esc_like($q).'%';
  }

  // Filtres additionnels
  if ($cat = $req->get_param('categorie_id')) {
    $where[] = "e.categorie_id = %d";
    $args[] = absint($cat);
  }
  if ($dispo = $req->get_param('disponibilite_id')) {
    $where[] = "e.disponibilite_id = %d";
    $args[] = absint($dispo);
  }

  // Filtre protocole (optionnel)
  if (null !== ($hp = $req->get_param('has_protocole'))) {
    if (intval($hp))  { $where[] = "(p.fichier IS NOT NULL AND p.fichier <> '')"; }
    else              { $where[] = "(p.fichier IS NULL OR p.fichier = '')"; }
  }

  // Requête
  $sql = "
    SELECT e.*,
           c.intitule  AS categorie_label,
           d.intitule  AS disponibilite_label,
           p.fichier   AS protocole_fichier
    FROM $t e
    LEFT JOIN $tc c ON c.id = e.categorie_id
    LEFT JOIN $td d ON d.id = e.disponibilite_id
    /* dernier protocole par équipement (MAX(id)) */
    LEFT JOIN (
      SELECT ep1.id_recherche_equipement, ep1.fichier
      FROM $tp ep1
      INNER JOIN (
        SELECT id_recherche_equipement, MAX(id) AS last_id
        FROM $tp
        GROUP BY id_recherche_equipement
      ) pick
        ON pick.id_recherche_equipement = ep1.id_recherche_equipement
       AND pick.last_id = ep1.id
    ) p ON p.id_recherche_equipement = e.id
  ";
  if ($where) { $sql .= " WHERE ".implode(" AND ", $where); }
  $sql .= " ORDER BY e.id DESC LIMIT %d OFFSET %d";

  $args[] = $per; 
  $args[] = $off;

  $query  = $wpdb->prepare($sql, $args);
  return $wpdb->get_results($query, ARRAY_A);
}




// GET
function svc_equipement_get(WP_REST_Request $req){
  global $wpdb; $t = svc_equipement_table(); $id = absint($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}
function svc_conditions_entretien_table(){ global $wpdb; return $wpdb->prefix . 'recherche_conditions_entretien'; }

// CREATE
// Remplace ta fonction par celle-ci
function svc_equipement_create(WP_REST_Request $req){
  global $wpdb; 
  $t  = svc_equipement_table();
  $tp = svc_equipement_protocole_table();
  $te = svc_conditions_entretien_table();
  $allowed = svc_equipement_allowed();

  // --- user connecté obligatoire ---
  $uid = get_current_user_id();
  if (!$uid) {
    return new WP_Error('forbidden', 'Authentication required', array('status' => 401));
  }

  // Lis JSON body / form-data
  $data = function_exists('svc_read_input2') ? svc_read_input2($req) : ( $req->get_json_params() ?: $req->get_params() );
  if (!is_array($data)) $data = array();

  // 1) Prépare insert "équipement"
  $ins = array();
  foreach ($allowed as $k){
    if(array_key_exists($k, $data)){
      $v = $data[$k];
      if (in_array($k, array('categorie_id','disponibilite_id'))) { $ins[$k] = absint($v); }
      else { $ins[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v); }
    }
  }
  // Forcer le user_id côté serveur (ne pas le lire du payload)
  $ins['user_id'] = absint($uid);

  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));

  $fmt = array();
  foreach($ins as $k => $_){
    $fmt[] = in_array($k, array('categorie_id','disponibilite_id','user_id')) ? '%d' : '%s';
  }

  // 2) Champs "liés" (optionnels) reçus dans la même requête
  $protocole_fichier = isset($data['protocole_fichier']) ? sanitize_text_field($data['protocole_fichier']) : '';
  $contrat_fichier   = isset($data['contrat_fichier'])   ? sanitize_text_field($data['contrat_fichier'])   : '';
  $periodicite       = isset($data['periodicite'])       ? sanitize_text_field($data['periodicite'])       : '';
  $consignes         = isset($data['consignes'])         ? sanitize_text_field($data['consignes'])         : '';

  // 3) Transaction
  $wpdb->query('START TRANSACTION');

  // 3.1 Insert équipement
  $ok = $wpdb->insert($t, $ins, $fmt);
  if(!$ok){
    $wpdb->query('ROLLBACK');
    return new WP_Error('db_error','Insert equipement failed',array('status'=>500));
  }
  $equipement_id = intval($wpdb->insert_id);

  // 3.2 Insert protocole si fourni
  $protocole_id = null;
  if ($protocole_fichier !== ''){
    $okp = $wpdb->insert(
      $tp,
      array('id_recherche_equipement' => $equipement_id, 'fichier' => $protocole_fichier),
      array('%d','%s')
    );
    if(!$okp){
      $wpdb->query('ROLLBACK');
      return new WP_Error('db_error','Insert protocole failed',array('status'=>500));
    }
    $protocole_id = intval($wpdb->insert_id);
  }

  // 3.3 Insert conditions d’entretien si fourni
  $entretien_id = null;
  if ($periodicite !== '' || $consignes !== '' || $contrat_fichier !== ''){
    $oke = $wpdb->insert(
      $te,
      array(
        'id_recherche_equipement' => $equipement_id,
        'periodicite'             => $periodicite,
        'consignes'               => $consignes,
        'fichier_contrat'         => $contrat_fichier
      ),
      array('%d','%s','%s','%s')
    );
    if(!$oke){
      $wpdb->query('ROLLBACK');
      return new WP_Error('db_error','Insert conditions_entretien failed',array('status'=>500));
    }
    $entretien_id = intval($wpdb->insert_id);
  }

  // 3.4 Commit
  $wpdb->query('COMMIT');

  // 4) Réponse (user_id est déjà dans $ins)
  return array(
    'id' => $equipement_id
  ) + $ins + array(
    'protocole_id'  => $protocole_id,
    'entretien_id'  => $entretien_id
  );
}


// UPDATE
function svc_equipement_update(WP_REST_Request $req){
  global $wpdb; $t = svc_equipement_table(); $allowed = svc_equipement_allowed();
  $id = absint($req['id']); $data = svc_read_input2($req); $upd = array();

  foreach ($allowed as $k){
    if(array_key_exists($k, $data)){
      $v = $data[$k];
      if (in_array($k, array('categorie_id','disponibilite_id'))) { $upd[$k] = absint($v); }
      else { $upd[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v); }
    }
  }
  if(empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));

  $fmt = array(); foreach($upd as $k => $_){ $fmt[] = in_array($k, array('categorie_id','disponibilite_id')) ? '%d' : '%s'; }
  $ok = $wpdb->update($t, $upd, array('id'=>$id), $fmt, array('%d'));
  if($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

// DELETE
function svc_equipement_delete(WP_REST_Request $req){
  global $wpdb;

  // tables
  $t  = svc_equipement_table();                    // utm_recherche_equipement
  $tp = function_exists('svc_equipement_protocole_table') ? svc_equipement_protocole_table() : $wpdb->prefix.'recherche_equipement_protocole';
  $te = function_exists('svc_conditions_entretien_table') ? svc_conditions_entretien_table() : $wpdb->prefix.'recherche_conditions_entretien';
  $tm = function_exists('svc_maintenance_table') ? svc_maintenance_table() : $wpdb->prefix.'recherche_maintenance';

  $id  = absint($req['id']);
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  // Vérifier que l’équipement existe
  $exists = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d", $id));
  if (!$exists) return new WP_Error('not_found','Not found', ['status'=>404]);

  // Ownership: admin voit tout, sinon l’équipement doit appartenir au user courant
  if ( ! current_user_can('manage_options') ){
    $own = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d AND user_id=%d", $id, $uid));
    if (!$own) return new WP_Error('forbidden','Not your equipment', ['status'=>403]);
  }

  // Transaction
  $wpdb->query('START TRANSACTION');

  try {
    // 1) Supprimer conditions d’entretien
    //    (clé: id_recherche_equipement = id)
    $wpdb->delete($te, ['id_recherche_equipement' => $id], ['%d']);

    // 2) Supprimer protocoles d'utilisation
    //    (clé: id_recherche_equipement = id)
    $wpdb->delete($tp, ['id_recherche_equipement' => $id], ['%d']);

    // 3) Supprimer maintenances liées
    //    Dans ton schéma, equipement_id est VARCHAR → on matche en %s
    $wpdb->query($wpdb->prepare("DELETE FROM $tm WHERE equipement_id = %s", (string)$id));

    // 4) (Optionnel) si tu as une table contrat liée par id_recherche_equipement
    if (function_exists('svc_equipement_contrat_table')) {
      $tcontrat = svc_equipement_contrat_table();
      // Ne supprime que si la colonne existe (au cas où ce soit un simple dépôt de fichiers sans FK)
      // Ici on tente directement sur id_recherche_equipement; si la colonne n'existe pas, la requête échouera silencieusement si MySQL STRICT est off
      // Tu peux encapsuler avec un test de schéma si besoin.
      $wpdb->query($wpdb->prepare("DELETE FROM $tcontrat WHERE id_recherche_equipement = %d", $id));
    }

    // 5) Supprimer l’équipement
    $ok = $wpdb->delete($t, ['id' => $id], ['%d']);
    if (!$ok) {
      $wpdb->query('ROLLBACK');
      return new WP_Error('db_error','Delete equipment failed', ['status'=>500]);
    }

    // 6) Commit
    $wpdb->query('COMMIT');

    return new WP_REST_Response(null, 204);

  } catch (Throwable $e) {
    $wpdb->query('ROLLBACK');
    error_log('[svc_equipement_delete] '.$e->getMessage());
    return new WP_Error('db_error','Delete failed', ['status'=>500]);
  }
}

// === TABLES & HELPERS ===
if (!function_exists('svc_conditions_entretien_table')) {
  function svc_conditions_entretien_table(){ global $wpdb; return $wpdb->prefix . 'recherche_conditions_entretien'; }
}
if (!function_exists('svc_equipement_table')) {
  function svc_equipement_table(){ global $wpdb; return $wpdb->prefix . 'recherche_equipement'; }
}
function svc_conditions_entretien_allowed(){
  // colonnes de utm_recherche_conditions_entretien
  return array('id_recherche_equipement','periodicite','consignes','fichier_contrat');
}
function svc_conditions_entretien_args_create(){ return array(
  'id_recherche_equipement' => array('required'=>true,  'validate_callback'=>function($v){return is_numeric($v);}, 'sanitize_callback'=>'absint'),
  'periodicite'             => array('required'=>false, 'validate_callback'=>function($v){return is_scalar($v);}, 'sanitize_callback'=>'sanitize_text_field'),
  'consignes'               => array('required'=>false, 'validate_callback'=>function($v){return is_scalar($v);}, 'sanitize_callback'=>'sanitize_text_field'),
  'fichier_contrat'         => array('required'=>false, 'validate_callback'=>function($v){return is_scalar($v);}, 'sanitize_callback'=>'sanitize_text_field'),
); }
function svc_conditions_entretien_args_update(){ 
  $a = svc_conditions_entretien_args_create();
  $a['id_recherche_equipement']['required'] = false; // optionnel en PATCH
  return $a;
}

// Lecture JSON/form
function svc_read_input_generic(WP_REST_Request $req){
  $data = $req->get_json_params();
  if (!is_array($data) || !count($data)) $data = $req->get_params();
  return is_array($data) ? $data : array();
}

// === LIST ===
function svc_conditions_entretien_list(WP_REST_Request $req){
  global $wpdb;
  $te = svc_conditions_entretien_table();
  $t  = svc_equipement_table();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',array('status'=>401));

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $where = array("e.user_id = %d");
  $args  = array(absint($uid));

  if ($eid = $req->get_param('equipement_id')) {
    $where[] = "ce.id_recherche_equipement = %d";
    $args[]  = absint($eid);
  }

  $sql = "
    SELECT ce.*
    FROM $te ce
    INNER JOIN $t e ON e.id = ce.id_recherche_equipement
  ";
  if ($where) $sql .= " WHERE ".implode(" AND ", $where);
  $sql .= " ORDER BY ce.id DESC LIMIT %d OFFSET %d";
  
  $args[] = $per; $args[] = $off;

  $q = $wpdb->prepare($sql, $args);
  return $wpdb->get_results($q, ARRAY_A);
}

// === GET BY ID ===
function svc_conditions_entretien_get(WP_REST_Request $req){
  global $wpdb;
  $te = svc_conditions_entretien_table();
  $t  = svc_equipement_table();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',array('status'=>401));

  $id = absint($req['id']);
  $sql = $wpdb->prepare("
    SELECT ce.*
    FROM $te ce
    INNER JOIN $t e ON e.id = ce.id_recherche_equipement
    WHERE ce.id = %d AND e.user_id = %d
  ", $id, $uid);

  $row = $wpdb->get_row($sql, ARRAY_A);
  if (!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}

// === CREATE ===
function svc_conditions_entretien_create(WP_REST_Request $req){
  global $wpdb;
  $te = svc_conditions_entretien_table();
  $t  = svc_equipement_table();
  $allowed = svc_conditions_entretien_allowed();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',array('status'=>401));

  $data = svc_read_input_generic($req);
  // vérifier que l’équipement appartient à l’utilisateur
  $equip_id = absint($data['id_recherche_equipement'] ?? 0);
  if (!$equip_id) return new WP_Error('bad_request','id_recherche_equipement requis',array('status'=>400));

  $owner = $wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d AND user_id=%d", $equip_id, $uid));
  if (!$owner) return new WP_Error('forbidden','Not your equipment',array('status'=>403));

  $ins = array(); $fmt = array();
  foreach ($allowed as $k){
    if (array_key_exists($k,$data)){
      $v = $data[$k];
      $ins[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v);
      $fmt[]   = ($k==='id_recherche_equipement') ? '%d' : '%s';
    }
  }
  if (empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));

  $ok = $wpdb->insert($te, $ins, $fmt);
  if (!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id;
  return array('id'=>$id) + $ins;
}

// === UPDATE ===
function svc_conditions_entretien_update(WP_REST_Request $req){
  global $wpdb;
  $te = svc_conditions_entretien_table();
  $t  = svc_equipement_table();
  $allowed = svc_conditions_entretien_allowed();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',array('status'=>401));

  $id   = absint($req['id']);
  // vérifier ownership
  $own = $wpdb->get_var($wpdb->prepare("
    SELECT COUNT(1)
    FROM $te ce INNER JOIN $t e ON e.id = ce.id_recherche_equipement
    WHERE ce.id=%d AND e.user_id=%d
  ", $id, $uid));
  if (!$own) return new WP_Error('forbidden','Not your record',array('status'=>403));

  $data = svc_read_input_generic($req);
  $upd = array(); $fmt = array();
  foreach ($allowed as $k){
    if (array_key_exists($k,$data)){
      $v = $data[$k];
      $upd[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v);
      $fmt[]   = ($k==='id_recherche_equipement') ? '%d' : '%s';
    }
  }
  if (empty($upd)) return new WP_Error('bad_request','No valid fields',array('status'=>400));

  $ok = $wpdb->update($te, $upd, array('id'=>$id), $fmt, array('%d'));
  if ($ok===false) return new WP_Error('db_error','Update failed',array('status'=>500));
  return array('id'=>$id) + $upd;
}

// === DELETE ===
function svc_conditions_entretien_delete(WP_REST_Request $req){
  global $wpdb;
  $te = svc_conditions_entretien_table();
  $t  = svc_equipement_table();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',array('status'=>401));

  $id = absint($req['id']);
  // ownership
  $own = $wpdb->get_var($wpdb->prepare("
    SELECT COUNT(1)
    FROM $te ce INNER JOIN $t e ON e.id = ce.id_recherche_equipement
    WHERE ce.id=%d AND e.user_id=%d
  ", $id, $uid));
  if (!$own) return new WP_Error('forbidden','Not your record',array('status'=>403));

  $ok = $wpdb->delete($te, array('id'=>$id), array('%d'));
  if (!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
function svc_maintenance_allowed(){ 
  return array(
    'date_debut',
    'date_fin',
    'equipement_id',
    'type_maintenance',   // NEW
    'motif',              // NEW
    'fichier_rapport',    // NEW
    'photo_equipement'    // NEW
  );
}

function svc_maintenance_list(WP_REST_Request $req){
  global $wpdb; 
  $t = svc_maintenance_table(); // utm_recherche_maintenance

  // (optionnel) sécurité: exiger authentification
  if ( ! is_user_logged_in() ) {
    return new WP_Error('forbidden','Authentication required', array('status'=>401));
  }

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $where = array();
  $args  = array();

  // --- filtres ---
  // Filtre principal : equipement_id
  if (null !== ($eid = $req->get_param('equipement_id')) && $eid !== '') {
    // VARCHAR dans ton schéma -> %s
    $where[] = "equipement_id = %s";
    $args[]  = (string) $eid;
    // Si tu migres equipement_id en BIGINT:
    // $where[] = "equipement_id = %d"; $args[] = absint($eid);
  }

  // Type de maintenance (preventive/corrective/curative/inspection/autre)
  if ($type = $req->get_param('type_maintenance')) {
    $where[] = "type_maintenance = %s";
    $args[]  = strtolower(sanitize_text_field($type));
  }

  // Période (dates au format "YYYY-MM-DD" ou "YYYY-MM-DD HH:MM:SS")
  if ($from = $req->get_param('from')) { // début >= from
    $where[] = "date_debut >= %s";
    $args[]  = sanitize_text_field($from);
  }
  if ($to = $req->get_param('to')) { // fin <= to (ou si fin vide, on ignore)
    // si date_fin est parfois vide, on borne sur date_debut à défaut
    $where[] = "( (date_fin <> '' AND date_fin <= %s) OR (date_fin = '' AND date_debut <= %s) )";
    $args[]  = sanitize_text_field($to);
    $args[]  = sanitize_text_field($to);
  }

  // (optionnel) ne retourner que mes enregistrements
  if ( $req->get_param('mine') ) {
    $uid = get_current_user_id();
    $where[] = "created_by = %d";
    $args[]  = absint($uid);
  }

  // --- requête ---
  $sql = "SELECT * FROM $t";
  if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
  }
  $sql .= " ORDER BY id DESC LIMIT %d OFFSET %d";

  $args[] = $per;
  $args[] = $off;

  $query = $wpdb->prepare($sql, $args);
  return $wpdb->get_results($query, ARRAY_A);
}


function svc_maintenance_get(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}
function svc_maintenance_create(WP_REST_Request $req){
  global $wpdb; 
  $t = svc_maintenance_table(); // utm_recherche_maintenance
  $allowed = svc_maintenance_allowed(); // ['date_debut','date_fin','equipement_id', ...]
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  $data = svc_read_input($req);
  $ins  = [];

  foreach ($allowed as $k){
    if (array_key_exists($k, $data)){
      $v = $data[$k];
      if ($k === 'motif') {
        $ins[$k] = sanitize_textarea_field($v);
      } elseif (in_array($k, array('fichier_rapport','photo_equipement'), true)) {
        $ins[$k] = esc_url_raw($v);
      } elseif ($k === 'type_maintenance') {
        $ins[$k] = strtolower(sanitize_text_field($v));
      } else {
        $ins[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v);
      }
    }
  }

  //  forcer l’auteur
  $ins['created_by'] = absint($uid);

  if (empty($ins)) return new WP_Error('bad_request','No valid fields', ['status'=>400]);

  // formats : %s pour varchar/text, %d pour numériques
  $fmt = [];
  foreach ($ins as $k => $_){
    $fmt[] = ($k === 'created_by') ? '%d' : '%s';
  }

  $ok = $wpdb->insert($t, $ins, $fmt);
  if (!$ok) return new WP_Error('db_error','Insert failed', ['status'=>500]);

  return ['id'=>$wpdb->insert_id] + $ins;
}

function svc_maintenance_update(WP_REST_Request $req){
  global $wpdb; $table = svc_maintenance_table(); $allowed = svc_maintenance_allowed();
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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
  $data = svc_read_input2($req); $ins = array();
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
  $id = intval($req['id']); $data = svc_read_input2($req); $upd = array();
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




// Chevauchement sur la MÊME ressource + MÊME date.
// Overlap strict: NOT (new_end <= existing_start OR new_start >= existing_end)
// => autorise les créneaux juste côte-à-côte (11:00 fin == 11:00 début).
function svc_reservation_conflict($resource_id, $date, $hstart, $hend, $exclude_id = 0){
  global $wpdb; $t = svc_reservation_table();

  $sql = "
    SELECT COUNT(1)
    FROM $t
    WHERE resource_id = %d
      AND date_reservation = %s
      AND statut IN ('en_attente','validee')
      AND NOT (heure_fin <= %s OR heure_debut >= %s)
  ";
  $args = array(
    absint($resource_id),
    sanitize_text_field($date),
    sanitize_text_field($hstart),
    sanitize_text_field($hend),
  );

  if ($exclude_id) { $sql .= " AND id <> %d"; $args[] = absint($exclude_id); }

  return (int)$wpdb->get_var($wpdb->prepare($sql, $args));
}

function svc_reservation_list(WP_REST_Request $req){
  global $wpdb;

  $t   = svc_reservation_table();            // utm_recherche_reservation (alias r)
  $te  = svc_equipement_table();             // utm_recherche_equipement (alias e)
  $tc  = svc_categorie_table();              // utm_recherche_categorie_equipement (alias c)
  $wpU = $wpdb->users;                       // wp_users (alias u)
  $wpM = $wpdb->usermeta;                    // wp_usermeta (alias m1, m2)

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', array('status'=>401));

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $where = array();
  $args  = array();

  $join  = "
    LEFT JOIN $te e  ON e.id = r.resource_id
    LEFT JOIN $tc c  ON c.id = e.categorie_id
    LEFT JOIN $wpU u ON u.ID = r.created_by
    LEFT JOIN $wpM m1 ON (m1.user_id = u.ID AND m1.meta_key = 'first_name')
    LEFT JOIN $wpM m2 ON (m2.user_id = u.ID AND m2.meta_key = 'last_name')
  ";

  // ---------- Portée utilisateur ----------
  // Par défaut : ne remonter que
  //   - les réservations créées par moi (r.created_by = UID)
  //   - OU les réservations sur mes équipements (e.user_id = UID)
  // Désactivation si admin ou ?all=1
  $all = intval($req->get_param('all'));
  if ( ! $all && ! current_user_can('manage_options') ) {
    $where[] = "( r.created_by = %d OR e.user_id = %d )";
    $args[]  = absint($uid);
    $args[]  = absint($uid);
  }

  // ---------- Filtres optionnels ----------
  if ($statut = $req->get_param('statut')) {
    $where[] = " r.statut = %s ";
    $args[]  = sanitize_text_field($statut);
  }
  if ($rid = $req->get_param('resource_id')) {
    $where[] = " r.resource_id = %d ";
    $args[]  = absint($rid);
  }
  if ($date = $req->get_param('date')) {
    $where[] = " r.date_reservation = %s ";
    $args[]  = sanitize_text_field($date);
  }
  if ($from = $req->get_param('from')) {
    $where[] = " r.date_reservation >= %s ";
    $args[]  = sanitize_text_field($from);
  }
  if ($to = $req->get_param('to')) {
    $where[] = " r.date_reservation <= %s ";
    $args[]  = sanitize_text_field($to);
  }
  if ($q = trim((string)$req->get_param('q'))) {
    $like = '%'.$wpdb->esc_like($q).'%';
    // recherche sur libellé ressource + nom/modele équipement
    $where[] = " (r.resource_label LIKE %s OR e.nom_appareil LIKE %s OR e.modele LIKE %s) ";
    $args[]  = $like; $args[] = $like; $args[] = $like;
  }

  // ---------- Requête ----------
  $sql = "
    SELECT
      r.*,
      /* Infos équipement */
      e.nom_appareil     AS equip_nom,
      e.modele           AS equip_modele,
      e.user_id          AS equip_owner_id,
      c.intitule         AS equip_categorie_label,
      /* Infos réservant */
      u.display_name     AS reserver_display_name,
      m1.meta_value      AS reserver_first_name,
      m2.meta_value      AS reserver_last_name
    FROM $t r
    $join
  ";
  if ($where) $sql .= " WHERE ".implode(" AND ", $where);
  $sql .= " ORDER BY r.date_reservation DESC, r.heure_debut ASC LIMIT %d OFFSET %d";

  $args[] = $per;
  $args[] = $off;

  $q = $wpdb->prepare($sql, $args);
  return $wpdb->get_results($q, ARRAY_A);
}


function svc_reservation_get(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table(); $id = absint($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return $row;
}
/* Utilitaires */
function _svc_time_hhmmss($s){
  if (!is_string($s) || $s==='') return '';
  // "10:00" -> "10:00:00", "10:00:30" -> "10:00:30"
  if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $s)) return $s;
  if (preg_match('/^\d{2}:\d{2}$/', $s)) return $s . ':00';
  return '';
}
function _svc_is_valid_date($d){ return is_string($d) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $d); }
function _svc_is_valid_cat($c){ $c = strtolower($c); return in_array($c, ['equipement','salle'], true); }

/* CREATE */
/*
function svc_reservation_create(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table();
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  $d = $req->get_json_params() ?: $req->get_params();

  // ---- lecture + sanitation ----
  $rid   = isset($d['resource_id']) ? absint($d['resource_id']) : 0;
  $label = isset($d['resource_label']) ? sanitize_text_field($d['resource_label']) : '';
  $date  = isset($d['date_reservation']) ? sanitize_text_field($d['date_reservation']) : '';
  $h1    = _svc_time_hhmmss($d['heure_debut'] ?? '');
  $h2    = _svc_time_hhmmss($d['heure_fin']   ?? '');
  $obj   = isset($d['objectif']) ? sanitize_textarea_field($d['objectif']) : '';

  // ---- validations fortes ----
  $missing = [];
  if (!$rid) $missing[] = 'resource_id';
  if (!_svc_is_valid_date($date)) $missing[] = 'date_reservation';
  if (!$h1) $missing[] = 'heure_debut';
  if (!$h2) $missing[] = 'heure_fin';
  if ($missing) return new WP_Error('bad_request','Champs requis: '.implode(', ',$missing), ['status'=>400]);

  // h1 < h2 ?
  if (strtotime($h1) >= strtotime($h2)) {
    return new WP_Error('bad_request','Heure de fin doit être > heure de début', ['status'=>400]);
  }

  // ---- conflit de créneau (en_attente, validee) ----
  if (svc_reservation_conflict($cat, $rid, $date, $h1, $h2) > 0) {
    return new WP_Error('conflict','Créneau non disponible', ['status'=>409]);
  }

  // ---- insert ----
  $ins = array(
    'resource_id'      => $rid,
    'resource_label'   => $label,
    'date_reservation' => $date,
    'heure_debut'      => $h1,
    'heure_fin'        => $h2,
    'objectif'         => $obj,
    'statut'           => 'en_attente',
    'created_by'       => absint($uid),
  );
  $fmt = array('%s','%d','%s','%s','%s','%s','%s','%s','%d');

  $ok = $wpdb->insert($t, $ins, $fmt);
  if(!$ok) return new WP_Error('db_error','Insert failed', ['status'=>500]);

  return array('id'=>$wpdb->insert_id) + $ins;
}
*/

function svc_reservation_create(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table();
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  $d = $req->get_json_params() ?: $req->get_params();

  // lecture + sanitation
  $rid   = isset($d['resource_id']) ? absint($d['resource_id']) : 0;
  $label = isset($d['resource_label']) ? sanitize_text_field($d['resource_label']) : '';
  $date  = isset($d['date_reservation']) ? sanitize_text_field($d['date_reservation']) : '';
  $h1    = _svc_time_hhmmss($d['heure_debut'] ?? '');
  $h2    = _svc_time_hhmmss($d['heure_fin']   ?? '');
  $obj   = isset($d['objectif']) ? sanitize_textarea_field($d['objectif']) : '';

  // validations
  $missing = [];
  if (!$rid) $missing[] = 'resource_id';
  if (!is_string($date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/',$date)) $missing[] = 'date_reservation';
  if (!$h1) $missing[] = 'heure_debut';
  if (!$h2) $missing[] = 'heure_fin';
  if ($missing) return new WP_Error('bad_request','Champs requis: '.implode(', ',$missing), ['status'=>400]);

  if (strtotime($h1) >= strtotime($h2)) {
    return new WP_Error('bad_request','Heure de fin doit être > heure de début', ['status'=>400]);
  }

  // conflit (même ressource + même date + chevauchement)
  if (svc_reservation_conflict($rid, $date, $h1, $h2) > 0) {
    return new WP_Error('conflict','Créneau non disponible', ['status'=>409]);
  }

  // insert
  $ins = array(
    'resource_id'      => $rid,
    'resource_label'   => $label,
    'date_reservation' => $date,
    'heure_debut'      => $h1,
    'heure_fin'        => $h2,
    'objectif'         => $obj,
    'statut'           => 'en_attente',
    'created_by'       => absint($uid),
  );
  //            rid   label  date   h1    h2    obj    statut created_by
  $fmt = array( '%d', '%s',  '%s',  '%s', '%s', '%s',  '%s',  '%d' );

  $ok = $wpdb->insert($t, $ins, $fmt);
  if(!$ok) return new WP_Error('db_error','Insert failed', ['status'=>500]);

  return array('id'=>$wpdb->insert_id) + $ins;
}

/* UPDATE */
function svc_reservation_update(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table();
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  $id = absint($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found', ['status'=>404]);

  $d = $req->get_json_params() ?: $req->get_params();
  $allowed = svc_reservation_allowed();
  $upd = array();

  foreach ($allowed as $k){
    if(array_key_exists($k,$d)){
      $v = $d[$k];
      if ($k==='resource_id'){ $upd[$k]=absint($v); }
      elseif ($k==='objectif'){ $upd[$k]=sanitize_textarea_field($v); }
      elseif ($k==='date_reservation'){ $v=sanitize_text_field($v); if(!_svc_is_valid_date($v)) continue; $upd[$k]=$v; }
      elseif ($k==='heure_debut'){ $v=_svc_time_hhmmss($v); if(!$v) continue; $upd[$k]=$v; }
      elseif ($k==='heure_fin'){   $v=_svc_time_hhmmss($v); if(!$v) continue; $upd[$k]=$v; }
      else { $upd[$k]= is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v); }
    }
  }

  // Recalcul slot cible pour contrôle chevauchement
  $rid  = $upd['resource_id']      ?? $row['resource_id'];
  $date = $upd['date_reservation'] ?? $row['date_reservation'];
  $h1   = $upd['heure_debut']      ?? $row['heure_debut'];
  $h2   = $upd['heure_fin']        ?? $row['heure_fin'];

  if (isset($upd['resource_id']) || isset($upd['date_reservation']) || isset($upd['heure_debut']) || isset($upd['heure_fin'])) {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/',$date) || !$h1 || !$h2 || strtotime($h1) >= strtotime($h2)) {
      return new WP_Error('bad_request','Créneau invalide', ['status'=>400]);
    }
    if (svc_reservation_conflict($rid, $date, $h1, $h2, $id) > 0) {
      return new WP_Error('conflict','Créneau non disponible', ['status'=>409]);
    }
  }


  // Journal statut si changement
  if (array_key_exists('statut',$upd)) {
    if ($upd['statut'] !== $row['statut']) {
      $upd['status_updated_by'] = absint($uid);
      $upd['status_updated_at'] = current_time('mysql');
    } else {
      unset($upd['statut']); // pas de changement effectif
    }
  }

  if (empty($upd)) return array('id'=>$id); // rien à modifier

  $fmt = array();
  foreach ($upd as $k=>$_){
    $fmt[] = in_array($k, ['resource_id','status_updated_by'], true) ? '%d' : '%s';
  }

  $ok = $wpdb->update($t, $upd, array('id'=>$id), $fmt, array('%d'));
  if ($ok === false) return new WP_Error('db_error','Update failed', ['status'=>500]);

  return array('id'=>$id) + $upd;
}

/* CANCEL (statut → annulee) */
function svc_reservation_cancel(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table();
  $uid = get_current_user_id(); if (!$uid) return new WP_Error('forbidden','Authentication required', ['status'=>401]);

  $id = absint($req['id']);
  // (optionnel) vérifier existence
  $exists = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d", $id));
  if (!$exists) return new WP_Error('not_found','Not found', ['status'=>404]);

  $upd = array(
    'statut'            => 'annulee',
    'status_updated_by' => absint($uid),
    'status_updated_at' => current_time('mysql'),
  );
  $ok = $wpdb->update($t, $upd, array('id'=>$id), array('%s','%d','%s'), array('%d'));
  if ($ok === false) return new WP_Error('db_error','Cancel failed', ['status'=>500]); // ← fix: quote corrigée

  return array('id'=>$id) + $upd;
}

/* DELETE (optionnel) */
function svc_reservation_delete(WP_REST_Request $req){
  global $wpdb; $t = svc_reservation_table();
  $id = absint($req['id']);
  $ok = $wpdb->delete($t, array('id'=>$id), array('%d'));
  if(!$ok) return new WP_Error('db_error','Delete failed', ['status'=>500]);
  return new WP_REST_Response(null, 204);
}

// ====== UTILS TEMPS ======
function _svc_year_range_from_param($year_param){
  // Accepte "2025", "2025-2026" ou vide (→ année courante)
  $year_param = trim((string)$year_param);
  if (preg_match('/^\d{4}\s*-\s*(\d{4})$/', $year_param, $m)) {
    [$a,$b] = explode('-', $year_param);
    $a = (int)$a; $b = (int)$b;
    // année universitaire (1 sept A → 31 août B)
    return [ "$a-09-01", "$b-08-31" ];
  } elseif (preg_match('/^\d{4}$/', $year_param)) {
    $y = (int)$year_param;
    return [ "$y-01-01", "$y-12-31" ];
  }
  $y = (int) current_time('Y');
  return [ "$y-01-01", "$y-12-31" ];
}

// ====== STATS GLOBAL ======
// Renvoie { reservations_en_cours, equipements_disponibles }
function svc_stats_global(WP_REST_Request $req){
  global $wpdb;
  $tR = svc_reservation_table();     // utm_recherche_reservation (alias r)
  $tE = svc_equipement_table();      // utm_recherche_equipement (alias e)
  // (optionnel) si tu as la table de disponibilités :
  // $tD = $wpdb->prefix.'utm_recherche_disponibilite_equipement'; // alias d

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',['status'=>401]);

  [$from, $to] = _svc_year_range_from_param( $req->get_param('year') /* ex: "2025 - 2026" */,
                                           'calendar' /* ou 'academic' */ );
  $all = intval($req->get_param('all'));

  // portée utilisateur (comme tes autres endpoints)
  $whereScope = '';
  $argsScope  = [];
  /*if ( ! $all && ! current_user_can('manage_options') ) {
    $whereScope = " AND (r.created_by = %d OR e.user_id = %d) ";
    $argsScope  = [ absint($uid), absint($uid) ];
  }*/

   $whereScope .= " AND r.statut IN ('validee') ";


  // 1) Réservations "en cours"
  // Définition: aujourd’hui/à venir ET statut en_attente|validee
  $sqlRes = "
    SELECT COUNT(1)
    FROM $tR r
    LEFT JOIN $tE e ON e.id = r.resource_id
    WHERE r.statut IN ('en_attente','validee')
      AND (
            r.date_reservation >  CURRENT_DATE()
         OR (r.date_reservation = CURRENT_DATE() AND r.heure_fin >= CURRENT_TIME())
      )
      AND r.date_reservation BETWEEN %s AND %s
      $whereScope
  ";

  $argsRes = array_merge([$from,$to], $argsScope);
  $reservations_en_cours = (int) $wpdb->get_var($wpdb->prepare($sqlRes, $argsRes));

  // 2) Équipements disponibles
  // Si tu as un code "disponible" en table, joins-y; sinon: simple filtre sur colonne "disponibilite" ou id connu.
  $sqlEq = "
    SELECT COUNT(1)
    FROM $tE e
    WHERE 1=1
      AND ( e.disponibilite_id = 1 OR e.statut = 'fonctionnel')
  ";
/*
  // Limiter au propriétaire si scope user
  if ( ! $all && ! current_user_can('manage_options') ) {
    $sqlEq .= " AND e.user_id = %d";
    $equipements_disponibles = (int) $wpdb->get_var($wpdb->prepare($sqlEq, absint($uid)));
  } else {
    $equipements_disponibles = (int) $wpdb->get_var($sqlEq);
  }
  */
    $equipements_disponibles = (int) $wpdb->get_var($sqlEq);

  return [
    'reservations_en_cours'   => $reservations_en_cours,
    'equipements_disponibles' => $equipements_disponibles,
  ];
}

// ====== TOP RESSOURCES ======
// Renvoie [{id,label,total}...] trié décroissant
function svc_top_ressources(WP_REST_Request $req){
  global $wpdb;
  $tR = svc_reservation_table();     // r
  $tE = svc_equipement_table();      // e

  $uid   = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Authentication required',['status'=>401]);

  [$from,$to] = _svc_year_range_from_param($req->get_param('year'));
  $limit = max(1, min(20, intval($req->get_param('limit') ?: 8)));
  $all   = intval($req->get_param('all'));

//$where = " WHERE r.date_reservation BETWEEN %s AND %s ";
//$args  = [ $from, $to ];

  $where = " WHERE  ";

  /*
  if ( ! $all && ! current_user_can('manage_options') ) {
    $where .= " AND (r.created_by = %d OR e.user_id = %d) ";
    $args[] = absint($uid);
    $args[] = absint($uid);
  }
*/
  
  $where .= "  r.statut IN ('en_attente','validee','annulee','refusee') ";

  $sql = "
    SELECT
      r.resource_id AS id,
      COALESCE(NULLIF(e.nom_appareil,''), NULLIF(r.resource_label,''), CONCAT('#',r.resource_id)) AS label,
      COUNT(1) AS total
    FROM $tR r
    LEFT JOIN $tE e ON e.id = r.resource_id
    $where
    GROUP BY r.resource_id, label
    ORDER BY total DESC
    LIMIT %d
  ";

  $args[] = $limit;

  // Puis prépare les args :
//$args = array_merge([$from, $to], $args);

  $q = $wpdb->prepare($sql, $args);
  return $wpdb->get_results($q, ARRAY_A);
}


/**
 * Convertit un paramètre "year" en intervalle de dates [from, to] (YYYY-MM-DD).
 * Accepte : "2025"  → [2025-01-01, 2025-12-31]
 *           "2025-2026" ou "2025 - 2026" → (calendaire) [2025-01-01, 2026-12-31]
 * Mode académique (sept→août) si $mode === 'academic' → [Y1-09-01, Y2-08-31]
 * Si rien de valable, retourne les 12 derniers mois.
 */






// === Helper: nom de la table ===
function utm_types_activites_table(){
    global $wpdb;
    return $wpdb->prefix . 'recherche_type_activite_scientifique';
    // correspond à: utm_recherche_type_activite_scientifique
}

// === Service: liste des types (avec filtres simples) ===
function svc_types_activites_list($args = []) {
    global $wpdb;
    $table = utm_types_activites_table();

    $lang   = !empty($args['lang'])  ? sanitize_text_field($args['lang']) : 'fr';
    $q      = isset($args['q'])      ? trim(sanitize_text_field($args['q'])) : '';
    $actif  = isset($args['actif'])  ? intval($args['actif']) : 1;

    // libellé selon langue
    $label_col = ($lang === 'en') ? 'libelle_en' : 'libelle_fr';

    $where = "WHERE 1=1";
    $params = [];

    if ($actif === 0 || $actif === 1) {
        $where .= " AND actif = %d";
        $params[] = $actif;
    }

    if ($q !== '') {
        $where .= " AND (code LIKE %s OR {$label_col} LIKE %s)";
        $like = '%' . $wpdb->esc_like($q) . '%';
        $params[] = $like;
        $params[] = $like;
    }

    $sql = "
        SELECT id, code, {$label_col} AS libelle, description, actif, ordre_affichage
        FROM {$table}
        {$where}
        ORDER BY ordre_affichage ASC, libelle ASC
    ";

    if (!empty($params)) {
        $items = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A);
    } else {
        $items = $wpdb->get_results($sql, ARRAY_A);
    }

    return [
        'count' => count($items),
        'items' => array_map(function($r){
            return [
                'id'     => (int)$r['id'],
                'code'   => $r['code'],
                'libelle'=> $r['libelle'] ?: $r['code'],
                'actif'  => (int)$r['actif'],
            ];
        }, $items)
    ];
}
