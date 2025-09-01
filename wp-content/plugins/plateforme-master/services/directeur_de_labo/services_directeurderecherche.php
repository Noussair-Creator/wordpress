<?php
/** Services directeurderecherche — tables $wpdb->prefix . 'directeur_de_labo_<entite>' */
if (!defined('ABSPATH')) {
  exit;
}

function pm_svc_read_input(WP_REST_Request $req)
{
  $data = $req->get_json_params();
  if (empty($data) || !is_array($data)) {
    $data = $req->get_body_params();
  }
  if (empty($data) || !is_array($data)) {
    $data = $req->get_params();
  }
  return is_array($data) ? $data : array();
}

// === activite_doc ===
function pm_svc_activite_doc_table()
{
  global $wpdb;
  return $wpdb->prefix . 'directeur_de_labo_activite_doc';
}
function pm_svc_activite_doc_allowed()
{
  return array('activite_id', 'fichier');
}

function pm_svc_activite_doc_list(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_doc_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off = ($page - 1) * $per;
  $sql = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function pm_svc_activite_doc_get(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_doc_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row)
    return new WP_Error('not_found', 'Not found', array('status' => 404));
  return $row;
}

function pm_svc_activite_doc_create(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_doc_table();
  $allowed = pm_svc_activite_doc_allowed();
  $data = pm_svc_read_input($req);
  $ins = array();
  foreach ($allowed as $k) {
    if (isset($data[$k])) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }
  if (empty($ins))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->insert($table, $ins);
  if (!$ok)
    return new WP_Error('db_error', 'Insert failed', array('status' => 500));
  $id = $wpdb->insert_id;
  return array('id' => $id) + $ins;
}

function pm_svc_activite_doc_update(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_doc_table();
  $allowed = pm_svc_activite_doc_allowed();
  $id = intval($req['id']);
  $data = pm_svc_read_input($req);
  $upd = array();
  foreach ($allowed as $k) {
    if (array_key_exists($k, $data)) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $upd[$k] = $v;
    }
  }
  if (empty($upd))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->update($table, $upd, array('id' => $id));
  if ($ok === false)
    return new WP_Error('db_error', 'Update failed', array('status' => 500));
  return array('id' => $id) + $upd;
}

function pm_svc_activite_doc_delete(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_doc_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id' => $id));
  if (!$ok)
    return new WP_Error('db_error', 'Delete failed', array('status' => 500));
  return new WP_REST_Response(null, 204);
}

// === activite_indicateur ===
function pm_svc_activite_indicateur_table()
{
  global $wpdb;
  return $wpdb->prefix . 'directeur_de_labo_activite_indicateur';
}
function pm_svc_activite_indicateur_allowed()
{
  return array('activite_id', 'resultat_obtenu');
}

function pm_svc_activite_indicateur_list(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_indicateur_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off = ($page - 1) * $per;
  $sql = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function pm_svc_activite_indicateur_get(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_indicateur_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row)
    return new WP_Error('not_found', 'Not found', array('status' => 404));
  return $row;
}

function pm_svc_activite_indicateur_create(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_indicateur_table();
  $allowed = pm_svc_activite_indicateur_allowed();
  $data = pm_svc_read_input($req);
  $ins = array();
  foreach ($allowed as $k) {
    if (isset($data[$k])) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }
  if (empty($ins))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->insert($table, $ins);
  if (!$ok)
    return new WP_Error('db_error', 'Insert failed', array('status' => 500));
  $id = $wpdb->insert_id;
  return array('id' => $id) + $ins;
}

function pm_svc_activite_indicateur_update(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_indicateur_table();
  $allowed = pm_svc_activite_indicateur_allowed();
  $id = intval($req['id']);
  $data = pm_svc_read_input($req);
  $upd = array();
  foreach ($allowed as $k) {
    if (array_key_exists($k, $data)) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $upd[$k] = $v;
    }
  }
  if (empty($upd))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->update($table, $upd, array('id' => $id));
  if ($ok === false)
    return new WP_Error('db_error', 'Update failed', array('status' => 500));
  return array('id' => $id) + $upd;
}

function pm_svc_activite_indicateur_delete(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_activite_indicateur_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id' => $id));
  if (!$ok)
    return new WP_Error('db_error', 'Delete failed', array('status' => 500));
  return new WP_REST_Response(null, 204);
}


// === chercheur ===
function pm_svc_chercheur_table()
{
  global $wpdb;
  return $wpdb->prefix . 'directeur_de_labo_chercheur';
}
function pm_svc_chercheur_allowed()
{
  return array('email', 'nom');
}

function pm_svc_chercheur_list(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_chercheur_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off = ($page - 1) * $per;
  $sql = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function pm_svc_chercheur_get(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_chercheur_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row)
    return new WP_Error('not_found', 'Not found', array('status' => 404));
  return $row;
}

function pm_svc_chercheur_create(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_chercheur_table();
  $allowed = pm_svc_chercheur_allowed();
  $data = pm_svc_read_input($req);
  $ins = array();
  foreach ($allowed as $k) {
    if (isset($data[$k])) {
      if ($k === 'email') {
        $v = sanitize_email($data[$k]);
      } else {
        $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      }
      $ins[$k] = $v;
    }
  }
  if (empty($ins))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->insert($table, $ins);
  if (!$ok)
    return new WP_Error('db_error', 'Insert failed', array('status' => 500));
  $id = $wpdb->insert_id;
  return array('id' => $id) + $ins;
}

function pm_svc_chercheur_update(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_chercheur_table();
  $allowed = pm_svc_chercheur_allowed();
  $id = intval($req['id']);
  $data = pm_svc_read_input($req);
  $upd = array();
  foreach ($allowed as $k) {
    if (array_key_exists($k, $data)) {
      if ($k === 'email') {
        $v = sanitize_email($data[$k]);
      } else {
        $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      }
      $upd[$k] = $v;
    }
  }
  if (empty($upd))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->update($table, $upd, array('id' => $id));
  if ($ok === false)
    return new WP_Error('db_error', 'Update failed', array('status' => 500));
  return array('id' => $id) + $upd;
}

function pm_svc_chercheur_delete(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_chercheur_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id' => $id));
  if (!$ok)
    return new WP_Error('db_error', 'Delete failed', array('status' => 500));
  return new WP_REST_Response(null, 204);
}


// === laboratoire_membre ===
function pm_svc_laboratoire_membre_table()
{
  global $wpdb;
  return $wpdb->prefix . 'directeur_de_labo_laboratoire_membre';
}
function pm_svc_laboratoire_membre_allowed()
{
  return array('chercheur_id', 'laboratoire_id', 'role', 'equipe_recherche', 'statut');
}

function pm_svc_laboratoire_membre_list(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_laboratoire_membre_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off = ($page - 1) * $per;
  $sql = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function pm_svc_laboratoire_membre_get(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_laboratoire_membre_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row)
    return new WP_Error('not_found', 'Not found', array('status' => 404));
  return $row;
}

function pm_svc_laboratoire_membre_create(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_laboratoire_membre_table();
  $allowed = pm_svc_laboratoire_membre_allowed();
  $data = pm_svc_read_input($req);
  $ins = array();
  foreach ($allowed as $k) {
    if (isset($data[$k])) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }
  if (empty($ins))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->insert($table, $ins);
  if (!$ok)
    return new WP_Error('db_error', 'Insert failed', array('status' => 500));
  $id = $wpdb->insert_id;
  return array('id' => $id) + $ins;
}

function pm_svc_laboratoire_membre_update(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_laboratoire_membre_table();
  $allowed = pm_svc_laboratoire_membre_allowed();
  $id = intval($req['id']);
  $data = pm_svc_read_input($req);
  $upd = array();
  foreach ($allowed as $k) {
    if (array_key_exists($k, $data)) {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $upd[$k] = $v;
    }
  }
  if (empty($upd))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->update($table, $upd, array('id' => $id));
  if ($ok === false)
    return new WP_Error('db_error', 'Update failed', array('status' => 500));
  return array('id' => $id) + $upd;
}

function pm_svc_laboratoire_membre_delete(WP_REST_Request $req)
{
  global $wpdb;
  $table = pm_svc_laboratoire_membre_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id' => $id));
  if (!$ok)
    return new WP_Error('db_error', 'Delete failed', array('status' => 500));
  return new WP_REST_Response(null, 204);
}



// === laboratoire ===
function svc_directeur_de_labo_laboratoire_table()
{
  global $wpdb;
  return $wpdb->prefix . 'directeur_de_labo_laboratoire';
}
function svc_directeur_de_labo_laboratoire_allowed()
{
  // The 'etablissement' is now handled automatically and not passed by the client.
  return array('logo_laboratoire', 'nom', 'date_de_creation', 'etat', 'objectif_general', 'axes_de_recherche');
}

function svc_directeur_de_labo_laboratoire_list(WP_REST_Request $req)
{
  global $wpdb;
  $table = svc_directeur_de_labo_laboratoire_table();
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off = ($page - 1) * $per;
  $sql = $wpdb->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT %d OFFSET %d", $per, $off);
  return $wpdb->get_results($sql, ARRAY_A);
}

function svc_directeur_de_labo_laboratoire_get(WP_REST_Request $req)
{
  global $wpdb;
  $table = svc_directeur_de_labo_laboratoire_table();
  $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row)
    return new WP_Error('not_found', 'Not found', array('status' => 404));
  return $row;
}

function svc_directeur_de_labo_laboratoire_create(WP_REST_Request $req)
{
  global $wpdb;

  $current_user_id = get_current_user_id();
  if ($current_user_id === 0) {
    return new WP_Error('unauthorized', 'You must be logged in to create a laboratory.', array('status' => 401));
  }

  // Get the director's establishment from their user meta.
  // Assumes the meta_key is 'etablissement'.
  $etablissement = get_user_meta($current_user_id, 'institut_id', true);
  // var_dump($etablissement);
  if (empty($etablissement)) {
    return new WP_Error('etablissement_missing', 'The director does not have an establishment set in their profile.', array('status' => 400));
  }

  $table = svc_directeur_de_labo_laboratoire_table();
  $allowed = svc_directeur_de_labo_laboratoire_allowed();
  $data = pm_svc_read_input($req);
  $ins = array();

  // Automatically add the director's ID and their establishment.
  $ins['directeur_du_laboratoire_id'] = $current_user_id;
  $ins['etablissement'] = $etablissement;


  foreach ($allowed as $k) {
    if (isset($data[$k])) {
      if ($k === 'date_de_creation') {
        $date = DateTime::createFromFormat('d/m/Y', $data[$k]);
        $v = $date ? $date->format('Y-m-d') : null;
      } else {
        $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      }
      $ins[$k] = $v;
    }
  }

  if (count($ins) <= 2) // Should have more than just the two auto-added fields.
    return new WP_Error('bad_request', 'No valid fields provided.', array('status' => 400));

  $ok = $wpdb->insert($table, $ins);
  if (!$ok) {
    return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, array('status' => 500));
  }

  $id = $wpdb->insert_id;
  return array('id' => $id) + $ins;
}

function svc_directeur_de_labo_laboratoire_update(WP_REST_Request $req)
{
  global $wpdb;
  $table = svc_directeur_de_labo_laboratoire_table();
  // The director and their establishment cannot be changed via this endpoint.
  $allowed = svc_directeur_de_labo_laboratoire_allowed();
  $id = intval($req['id']);
  $data = pm_svc_read_input($req);
  $upd = array();
  foreach ($allowed as $k) {
    if (array_key_exists($k, $data)) {
      if ($k === 'date_de_creation') {
        $date = DateTime::createFromFormat('d/m/Y', $data[$k]);
        $v = $date ? $date->format('Y-m-d') : null;
      } else {
        $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      }
      $upd[$k] = $v;
    }
  }
  if (empty($upd))
    return new WP_Error('bad_request', 'No valid fields', array('status' => 400));
  $ok = $wpdb->update($table, $upd, array('id' => $id));
  if ($ok === false)
    return new WP_Error('db_error', 'Update failed', array('status' => 500));
  return array('id' => $id) + $upd;
}

function svc_directeur_de_labo_laboratoire_delete(WP_REST_Request $req)
{
  global $wpdb;
  $table = svc_directeur_de_labo_laboratoire_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id' => $id));
  if (!$ok)
    return new WP_Error('db_error', 'Delete failed', array('status' => 500));
  return new WP_REST_Response(null, 204);
}