<?php
/** Services chercheur — tables $wpdb->prefix . 'recherche_<entite>' */
if (!defined('ABSPATH')) { exit; }

function svc_read_input(WP_REST_Request $req){
  $data = $req->get_json_params();
  if (empty($data) || !is_array($data)) { $data = $req->get_body_params(); }
  if (empty($data) || !is_array($data)) { $data = $req->get_params(); }
  return is_array($data) ? $data : array();
}

function svc_etablissements_list(WP_REST_Request $req){
  global $wpdb;
  $table = $wpdb->prefix . 'master_instituts'; // (id, nom)
  $search = trim((string)$req->get_param('search'));
  if ($search !== '') {
    $like = '%' . $wpdb->esc_like($search) . '%';
    return $wpdb->get_results($wpdb->prepare("SELECT id, nom FROM $table WHERE nom LIKE %s ORDER BY nom ASC", $like), ARRAY_A) ?: array();
  }
  return $wpdb->get_results("SELECT id, nom FROM $table ORDER BY nom ASC", ARRAY_A) ?: array();
}



// === Laboratoire ===
function svc_laboratoire_table(){ global $wpdb; return $wpdb->prefix . 'recherche_laboratoire'; }

/**
 * Carte des champs autorisés + types (pour sanitation/format DB).
 * Types supportés: int, email, url, date, enum, text, json
 */
function svc_laboratoire_allowed(){
  return array(
    'logo_id'              => 'int',
    'logo_url'             => 'url',
    'denomination'         => 'text',
    'code_lr'              => 'text',
    'etablissement_id'     => 'int',
    'etablissement_label'  => 'text',
    'date_creation'        => 'date',
    'directeur_nom'        => 'text',
    'directeur_email'      => 'email',
    'directeur_user_id'    => 'int',
    'statut'               => array('enum', array('Actif','Inactif','Suspendu')),
    'objectif_general'     => 'text',   // HTML nettoyé côté args REST si besoin
    'axes_recherche'       => 'json',   // array<string> ⇄ JSON
    'site_web'             => 'url',
    'telephone'            => 'text',
    'email_contact'        => 'email',
    'meta_json'            => 'json',
    // audit (remplis automatiquement)
    'created_by'           => 'int',
    'updated_by'           => 'int',
  );
}

/** Sanitize un champ selon son type */
function svc_labo_sanitize($key, $val, $def){
  $type = is_array($def) ? $def[0] : $def;
  switch ($type){
    case 'int':   return absint($val);
    case 'email': return sanitize_email($val);
    case 'url':   return esc_url_raw($val);
    case 'date':  return (is_string($val) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $val)) ? $val : null;
    case 'enum':  return in_array($val, $def[1] ?? array(), true) ? $val : null;
    case 'json':  return is_string($val) ? $val : wp_json_encode($val, JSON_UNESCAPED_UNICODE);
    case 'text':
    default:      return is_scalar($val) ? sanitize_text_field($val) : wp_json_encode($val, JSON_UNESCAPED_UNICODE);
  }
}

/** Format SQL correspondant pour wpdb */
function svc_labo_format($def){
  $type = is_array($def) ? $def[0] : $def;
  switch ($type){
    case 'int':  return '%d';
    default:     return '%s';
  }
}

/** Décode les champs JSON à la sortie */
function svc_labo_decode_out(array $row){
  foreach (array('axes_recherche','meta_json') as $j){
    if (isset($row[$j]) && $row[$j] !== null && $row[$j] !== ''){
      $decoded = json_decode($row[$j], true);
      if (json_last_error() === JSON_ERROR_NONE) $row[$j] = $decoded;
    }
  }
  return $row;
}



// === laboratoire ===
function svc_laboratoire_get(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $id = intval($req['id']);
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
  return svc_labo_decode_out($row);
}

function svc_laboratoire_create(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_laboratoire_table();
  $allowed = svc_laboratoire_allowed();
  $data = svc_read_input($req);

  $ins = array(); $formats = array();

  foreach ($allowed as $k => $def){
    if (!isset($data[$k])) continue;
    $val = svc_labo_sanitize($k, $data[$k], $def);
    if ($val === null || $val === '') continue;
    $ins[$k] = $val;
    $formats[] = svc_labo_format($def);
  }

  // 🔹 Gestion fichier logo (clé "logo_file" côté formulaire <input type="file" name="logo_file">)
  $files = $req->get_file_params();
  if (!empty($files['logo_file']) && $files['logo_file']['error'] === UPLOAD_ERR_OK) {
      $upload_dir = wp_upload_dir();
      $target_dir = trailingslashit($upload_dir['basedir']).'logolabo/';

      if (!file_exists($target_dir)) {
          wp_mkdir_p($target_dir);
      }

      $filename = sanitize_file_name($files['logo_file']['name']);
      $target_path = $target_dir . $filename;

      if (move_uploaded_file($files['logo_file']['tmp_name'], $target_path)) {
          $file_url = trailingslashit($upload_dir['baseurl']).'logolabo/'.$filename;
          $ins['logo_url'] = esc_url_raw($file_url);   // URL publique
          $formats[] = '%s';
      }
  }
// 🔹 Associer automatiquement le directeur
  $ins['directeur_user_id'] = get_current_user_id(); $formats[] = '%d';
  // Audit
  $ins['created_by'] = get_current_user_id(); $formats[] = '%d';
  $ins['updated_by'] = get_current_user_id(); $formats[] = '%d';

  $ins['etablissement_id']= get_user_meta(get_current_user_id(), 'institut_id', true);


  if(empty($ins)) return new WP_Error('bad_request','No valid fields',array('status'=>400));
  $ok = $wpdb->insert($table, $ins, $formats);
  if(!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = $wpdb->insert_id;

  $out = array('id'=>$id) + $ins;
  return svc_labo_decode_out($out);
}


function svc_laboratoire_update(WP_REST_Request $req){
  global $wpdb;
  $table   = svc_laboratoire_table();
  $allowed = svc_laboratoire_allowed();

  $id = intval($req['id'] ?? 0);
  if ($id <= 0) return new WP_Error('bad_request','Invalid id', array('status'=>400));

  // Récupère TOUT (multipart/form-data ou JSON)
  $data  = $req->get_params();          // champs texte
  $files = $req->get_file_params();     // fichiers

  // --- Normaliser axes_recherche en array<string> ---
  if (array_key_exists('axes_recherche', $data)) {
    $axes = $data['axes_recherche'];
    if (is_array($axes)) {
      $axes = array_values(array_filter(array_map('trim',$axes), fn($s)=>$s!==''));
    } elseif (is_string($axes)) {
      $s = trim($axes);
      if ($s === '') {
        $axes = array();
      } else {
        $decoded = json_decode($s, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
          $axes = array_values(array_filter(array_map('trim',$decoded), fn($s)=>$s!==''));
        } else {
          $parts = preg_split('/\r?\n|,/', $s);
          $axes  = array_values(array_filter(array_map('trim',$parts), fn($s)=>$s!==''));
        }
      }
    } else {
      $axes = array();
    }
    $data['axes_recherche'] = $axes; // array propre
  }

  $upd     = array();
  $formats = array();

  // Sanitize + mapping formats pour tous les champs autorisés envoyés
  foreach ($allowed as $k => $def){
    if (!array_key_exists($k, $data)) continue;
    $val = svc_labo_sanitize($k, $data[$k], $def);
    if ($val === null) continue;         // pas de set à NULL par défaut

    // Encoder JSON pour ces colonnes si besoin
    if (($k === 'axes_recherche' || $k === 'meta_json') && !is_string($val)) {
      $val = wp_json_encode($val, JSON_UNESCAPED_UNICODE);
    }

    $upd[$k]   = $val;
    $formats[] = svc_labo_format($def);  // %d ou %s
  }

  // --- Upload fichier logo (clé: logo_file) ---
  if (!empty($files['logo_file']) && $files['logo_file']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = wp_upload_dir();
    $target_dir = trailingslashit($upload_dir['basedir']).'logolabo/';
    if (!file_exists($target_dir)) wp_mkdir_p($target_dir);

    $filename = sanitize_file_name($files['logo_file']['name']);
    $filename = wp_unique_filename($target_dir, $filename); // évite l’écrasement
    $target_path = $target_dir . $filename;

    if (!@move_uploaded_file($files['logo_file']['tmp_name'], $target_path)) {
      return new WP_Error('upload_failed','Échec déplacement du fichier uploadé', array('status'=>500));
    }
    $file_url = trailingslashit($upload_dir['baseurl']).'logolabo/'.$filename;
    $upd['logo_url'] = esc_url_raw($file_url);
    $formats[] = '%s';
  }

  // --- Associer automatiquement le directeur & l’établissement courant ---
  $current_uid = get_current_user_id();
  if ($current_uid) {
    $upd['directeur_user_id'] = $current_uid;   $formats[] = '%d';
    $inst = get_user_meta($current_uid, 'institut_id', true);
    if ($inst !== '' && $inst !== null) {
      $upd['etablissement_id'] = (int)$inst;    $formats[] = '%d';
    }
  }

  // --- Audit ---
  $upd['updated_by'] = $current_uid;            $formats[] = '%d';

  if (empty($upd)) return new WP_Error('bad_request','No valid fields', array('status'=>400));

  // --- UPDATE ---
  $ok = $wpdb->update($table, $upd, array('id'=>$id), $formats, array('%d'));
  if ($ok === false) {
    error_log('[svc_laboratoire_update] DB ERROR: '.$wpdb->last_error);
    return new WP_Error('db_error', 'Update failed: '.$wpdb->last_error, array('status'=>500));
  }

  // --- Retour enrichi (row complète décodée) ---
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if ($row) $row = svc_labo_decode_out($row);
  return $row ?: (array('id'=>$id) + $upd);
}



function svc_laboratoire_delete(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table(); $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id), array('%d'));
  if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}


function svc_laboratoire_list(WP_REST_Request $req){
  global $wpdb; $table = svc_laboratoire_table();

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $where = array(); $params = array();

  // --- filtres classiques (déjà présents chez toi, garde-les si tu les as) ---
  if ($statut = $req->get_param('statut')){ $where[] = "statut = %s"; $params[] = $statut; }
  if ($eid = $req->get_param('etablissement_id')){ $where[] = "etablissement_id = %d"; $params[] = intval($eid); }
  if ($q = trim((string)$req->get_param('search'))){
    $qLike = '%' . $wpdb->esc_like($q) . '%';
    $where[] = "(denomination LIKE %s OR code_lr LIKE %s OR etablissement_label LIKE %s OR directeur_nom LIKE %s)";
    array_push($params, $qLike, $qLike, $qLike, $qLike);
  }

  // --- nouveau: me=1 => restreint aux labos du user connecté ---
  if (filter_var($req->get_param('me'), FILTER_VALIDATE_BOOLEAN)) {
    $where[] = "directeur_user_id = %d";
    $params[] = get_current_user_id();
  }

  $wsql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

  $orderby = $req->get_param('orderby') ?: 'id';
  $order   = strtoupper($req->get_param('order') ?: 'DESC');
  $allowedOrderBy = array('id','denomination','code_lr','date_creation','created_at','updated_at');
  if (!in_array($orderby, $allowedOrderBy, true)) $orderby = 'id';
  if (!in_array($order, array('ASC','DESC'), true)) $order = 'DESC';

  $sql = "SELECT * FROM $table $wsql ORDER BY $orderby $order LIMIT %d OFFSET %d";
  $params[] = $per; $params[] = $off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
  // décoder JSON si besoin
  $rows = array_map('svc_labo_decode_out', $rows);
  return $rows;
}

function svc_laboratoire_mine(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_laboratoire_table();
  $uid   = get_current_user_id();

  $sql = "
    SELECT l.*,
           i.nom AS etablissement_nom,
           u.display_name,
           um1.meta_value AS first_name,
           um2.meta_value AS last_name
    FROM $table l
    LEFT JOIN {$wpdb->prefix}master_instituts i ON l.etablissement_id = i.id
    LEFT JOIN {$wpdb->users} u ON l.directeur_user_id = u.ID
    LEFT JOIN {$wpdb->usermeta} um1 ON (u.ID = um1.user_id AND um1.meta_key = 'first_name')
    LEFT JOIN {$wpdb->usermeta} um2 ON (u.ID = um2.user_id AND um2.meta_key = 'last_name')
    WHERE l.directeur_user_id = %d
    ORDER BY l.id DESC
    LIMIT 1
  ";


  $row = $wpdb->get_row($wpdb->prepare($sql, $uid), ARRAY_A);
  if(!$row) return [];

  $row = svc_labo_decode_out($row);
  $row['directeur_nom_complet'] = trim(($row['first_name'] ?? '').' '.($row['last_name'] ?? ''));
  return $row;
}



/* ===============================
 *  HELPERS (DB + sanitize + decode)
 * =============================== */

function svc_membre_table(){
  global $wpdb;
  return $wpdb->prefix . 'recherche_membre';
}

function svc_membre_allowed($for_update = false){
  // Même structure que les args (type + required)
  return svc_membre_common_field_defs($for_update);
}

function svc_membre_format($def){
  return (isset($def['type']) && $def['type'] === 'integer') ? '%d' : '%s';
}

function svc_membre_sanitize($key, $val, $def){
  if ($val === null) return null;
  $type = $def['type'] ?? 'string';
  if ($type === 'integer') return is_numeric($val) ? intval($val) : null;
  if ($type === 'boolean') return filter_var($val, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
  return sanitize_text_field($val);
}

function svc_membre_decode_out($row){
  if (!$row) return $row;
  foreach (array('id','user_id','laboratoire_id','user_created') as $k){
    if (isset($row[$k])) $row[$k] = intval($row[$k]);
  }
  return $row;
}

function svc_membre_exists($user_id, $laboratoire_id, $exclude_id = null){
  global $wpdb; $table = svc_membre_table();
  if ($exclude_id) {
    return (int)$wpdb->get_var($wpdb->prepare(
      "SELECT id FROM $table WHERE user_id=%d AND laboratoire_id=%d AND id<>%d LIMIT 1",
      $user_id, $laboratoire_id, $exclude_id
    ));
  }
  return (int)$wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table WHERE user_id=%d AND laboratoire_id=%d LIMIT 1",
    $user_id, $laboratoire_id
  ));
}


/* ===============================
 *  SERVICES (CRUD)
 * =============================== */

function svc_membre_create(WP_REST_Request $req){
  global $wpdb;
  $table   = svc_membre_table();
  $allowed = svc_membre_allowed(false);

  // Accepte JSON ou x-www-form-urlencoded
  $data = $req->get_json_params();
  if (!$data) $data = $req->get_params();

  $row     = array();
  $formats = array();

  // Champs autorisés (avec validation des requis)
  foreach ($allowed as $k => $def){
    $is_required = !empty($def['required']);
    if (!array_key_exists($k, $data)){
      if ($is_required) return new WP_Error('missing_param', "Paramètre requis: $k", array('status'=>400));
      continue;
    }
    $val = svc_membre_sanitize($k, $data[$k], $def);
    if (($val === null || $val === '') && $is_required){
      return new WP_Error('invalid_param', "Valeur invalide pour: $k", array('status'=>400));
    }
    if ($val !== null && $val !== '') { $row[$k] = $val; $formats[] = svc_membre_format($def); }
  }

  // Contrainte d’unicité (user_id, laboratoire_id)
  $uid = isset($row['user_id']) ? (int)$row['user_id'] : 0;
  $lid = isset($row['laboratoire_id']) ? (int)$row['laboratoire_id'] : 0;
  if ($uid && $lid && svc_membre_exists($uid, $lid)){
    return new WP_Error('duplicate_member', 'Ce membre est déjà rattaché à ce laboratoire.', array('status'=>409));
  }

  // Defaults + audit
  if (empty($row['api']))     { $row['api'] = 'plateforme-recherche/v1'; $formats[] = '%s'; }
  if (empty($row['service'])) { $row['service'] = 'Espace Labo';         $formats[] = '%s'; }
  $row['user_created'] = get_current_user_id() ?: null;                  $formats[] = '%d';

  $ok = $wpdb->insert($table, $row, $formats);
  if (!$ok) {
    error_log('[svc_membre_create] DB ERROR: '.$wpdb->last_error);
    return new WP_Error('db_insert_failed', 'Insertion impossible: '.$wpdb->last_error, array('status'=>500));
  }

  $id  = (int)$wpdb->insert_id;
  $out = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  return svc_membre_decode_out($out);
}

function svc_membre_update(WP_REST_Request $req){
  global $wpdb;
  $table   = svc_membre_table();
  $allowed = svc_membre_allowed(true);

  $id = intval($req['id'] ?? 0);
  if ($id <= 0) return new WP_Error('bad_request','Invalid id', array('status'=>400));

  // Récupération de la ligne courante (pour contrôle d’unicité si user_id/labo changent)
  $cur = $wpdb->get_row($wpdb->prepare("SELECT user_id,laboratoire_id FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$cur) return new WP_Error('not_found','Membre introuvable', array('status'=>404));

  $data = $req->get_params(); // JSON, form-data…
  $upd     = array();
  $formats = array();

  foreach ($allowed as $k => $def){
    if (!array_key_exists($k, $data)) continue;
    $val = svc_membre_sanitize($k, $data[$k], $def);
    if ($val === null) continue;
    $upd[$k]   = $val;
    $formats[] = svc_membre_format($def);
  }

  // Contrôle d’unicité si (user_id, laboratoire_id) changent
  $check_user = array_key_exists('user_id', $upd)        ? (int)$upd['user_id']        : (int)$cur['user_id'];
  $check_lab  = array_key_exists('laboratoire_id', $upd) ? (int)$upd['laboratoire_id'] : (int)$cur['laboratoire_id'];
  if ($check_user && $check_lab && svc_membre_exists($check_user, $check_lab, $id)){
    return new WP_Error('duplicate_member', 'Combinaison (user_id, laboratoire_id) déjà existante.', array('status'=>409));
  }

  if (empty($upd)) return new WP_Error('bad_request','Aucun champ valide à mettre à jour', array('status'=>400));

  $ok = $wpdb->update($table, $upd, array('id'=>$id), $formats, array('%d'));
  if ($ok === false) {
    error_log('[svc_membre_update] DB ERROR: '.$wpdb->last_error);
    return new WP_Error('db_error', 'Update failed: '.$wpdb->last_error, array('status'=>500));
  }

  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  return svc_membre_decode_out($row ?: (array('id'=>$id) + $upd));
}

function svc_membre_delete(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_membre_table(); 
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, array('id'=>$id), array('%d'));
  if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
  return new WP_REST_Response(null, 204);
}


function svc_membre_mine(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_membre_table();
  $uid   = get_current_user_id();
  $with_user = filter_var($req->get_param('with_user'), FILTER_VALIDATE_BOOLEAN);

  $select = "m.*";
  $join   = "";
  if ($with_user){
    $select .= ", u.display_name AS user_display_name, u.user_email, um1.meta_value AS first_name, um2.meta_value AS last_name";
    $join    = " LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID
                 LEFT JOIN {$wpdb->usermeta} um1 ON (u.ID = um1.user_id AND um1.meta_key = 'first_name')
                 LEFT JOIN {$wpdb->usermeta} um2 ON (u.ID = um2.user_id AND um2.meta_key = 'last_name')";
  }

  $where = "WHERE m.user_id = %d";
  $params = array($uid);

  if ($lid = $req->get_param('laboratoire_id')){
    $where .= " AND m.laboratoire_id = %d";
    $params[] = intval($lid);
  }

  $sql = "SELECT $select FROM $table m $join $where ORDER BY m.id DESC";
  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
  return array_map('svc_membre_decode_out', $rows);
}

/**
 * Normalise les rôles entrés par l’API :
 * - casse/bornage/espaces -> slug
 * - autorise "chercheur", "doctorant", "student_master" (prefixe um_ ajouté)
 * - retourne le nom de rôle final tel que stocké dans capabilities
 */
function svc_roles_normalize2($role){
  $r = strtolower(trim((string)$role));
  $r = str_replace(array(' ', '-'), '_', $r);
  // si l'utilisateur envoie sans préfixe
  if (in_array($r, array('chercheur','doctorant','student_master'), true)) {
    $r = 'um_' . $r;
  }
  return $r;
}

function svc_membre_get(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_membre_table();
  $id = intval($req['id']);

  $with_user = filter_var($req->get_param('with_user'), FILTER_VALIDATE_BOOLEAN);
  $with_etab = filter_var($req->get_param('with_etablissement'), FILTER_VALIDATE_BOOLEAN);

  $select = "m.*";
  $join   = "";

  if ($with_user){
    $select .= ", u.display_name AS user_display_name, u.user_email";
    $join   .= " LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID ";
  }

  if ($with_etab){
    $instTable = $wpdb->prefix . 'master_instituts'; // (id, nom)
    $join     .= " LEFT JOIN {$wpdb->usermeta} um_inst ON (m.user_id = um_inst.user_id AND um_inst.meta_key = 'institut_id') ";
    $join     .= " LEFT JOIN {$instTable} inst ON (CAST(um_inst.meta_value AS UNSIGNED) = inst.id) ";
    $select   .= ", CAST(um_inst.meta_value AS UNSIGNED) AS etablissement_id, inst.nom AS etablissement_nom";
  }

  $sql = "SELECT $select FROM $table m $join WHERE m.id=%d LIMIT 1";
  $row = $wpdb->get_row($wpdb->prepare($sql, $id), ARRAY_A);

  return $row ? svc_membre_decode_out($row) : new WP_Error('not_found','Membre introuvable', array('status'=>404));
}
function svc_membre_list(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_membre_table();

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $with_user = filter_var($req->get_param('with_user'), FILTER_VALIDATE_BOOLEAN);
  $with_etab = filter_var($req->get_param('with_etablissement'), FILTER_VALIDATE_BOOLEAN);
  $with_proj = filter_var($req->get_param('with_projects'), FILTER_VALIDATE_BOOLEAN);

  // Besoin user?
  $need_user = $with_user || $req->get_param('search') || (($req->get_param('orderby') ?: '') === 'user');

  // --- Tables projets ---
  $pm_tab = $wpdb->prefix . 'utm_recherche_projet_membre'; // (id, membre_id, projet_id, role_projet, created_at, updated_at)
  $p_tab  = $wpdb->prefix . 'utm_recherche_projet';        // (id, titre, ...?)  <-- si différente, adaptez ici
  $has_pm = svc_table_exists($pm_tab);
  $has_p  = svc_table_exists($p_tab);

  // Détecter colonne label projet
  $p_label = 'titre';
  if ($has_p && !svc_column_exists($p_tab, $p_label)) {
    $p_label = svc_column_exists($p_tab,'title') ? 'title' : (svc_column_exists($p_tab,'nom') ? 'nom' : null);
  }

  $select = "m.*";
  $join   = "";
  $where  = array();
  $params = array();

  if ($need_user){
    $select .= ", u.display_name AS user_display_name, u.user_email";
    $join   .= " LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID ";
  }

  if ($with_etab){
    $instTable = $wpdb->prefix . 'utm_master_instut';
    $join     .= " LEFT JOIN {$wpdb->usermeta} um_inst ON (m.user_id = um_inst.user_id AND um_inst.meta_key = 'institut_id')
                   LEFT JOIN {$instTable} inst ON (CAST(um_inst.meta_value AS UNSIGNED) = inst.id) ";
    $select   .= ", CAST(um_inst.meta_value AS UNSIGNED) AS etablissement_id, inst.nom AS etablissement_nom";
  }

  // ------- Projets liés (agrégés) + last_activity -------
  if ($with_proj && $has_pm){
    if ($has_p && $p_label){
      // AGG par membre_id avec noms de projets
      $agg = "SELECT pm.membre_id,
                     GROUP_CONCAT(DISTINCT p.`{$p_label}` ORDER BY p.`{$p_label}` SEPARATOR ', ') AS projets_lies,
                     MAX(pm.updated_at) AS last_proj_update
              FROM {$pm_tab} pm
              LEFT JOIN {$p_tab} p ON p.id = pm.projet_id
              GROUP BY pm.membre_id";
    } else {
      // fallback: concat d'IDs
      $agg = "SELECT pm.membre_id,
                     GROUP_CONCAT(DISTINCT pm.projet_id ORDER BY pm.projet_id SEPARATOR ', ') AS projets_lies,
                     MAX(pm.updated_at) AS last_proj_update
              FROM {$pm_tab} pm
              GROUP BY pm.membre_id";
    }
    $join   .= " LEFT JOIN ( {$agg} ) proj ON proj.membre_id = m.id ";
    $select .= ", proj.projets_lies,
                 CASE
                   WHEN proj.last_proj_update IS NULL THEN m.updated_at
                   WHEN proj.last_proj_update > m.updated_at THEN proj.last_proj_update
                   ELSE m.updated_at
                 END AS last_activity";
  } else {
    // Pas de table projets : last_activity = updated_at
    $select .= ", m.updated_at AS last_activity";
  }

  // ------- Filtres existants -------
  if ($lid = $req->get_param('laboratoire_id')){ $where[] = "m.laboratoire_id = %d"; $params[] = intval($lid); }
  if ($uid = $req->get_param('user_id'))       { $where[] = "m.user_id = %d";       $params[] = intval($uid); }
  if ($g = trim((string)$req->get_param('grade'))){
    $where[] = "m.grade LIKE %s"; $params[] = '%' . $wpdb->esc_like($g) . '%';
  }
  if ($q = trim((string)$req->get_param('search'))){
    $qLike = '%' . $wpdb->esc_like($q) . '%';
    if ($need_user){
      $where[] = "(m.specialite LIKE %s OR m.grade LIKE %s OR u.display_name LIKE %s OR u.user_email LIKE %s)";
      array_push($params, $qLike, $qLike, $qLike, $qLike);
    } else {
      $where[] = "(m.specialite LIKE %s OR m.grade LIKE %s)";
      array_push($params, $qLike, $qLike);
    }
  }
  if (filter_var($req->get_param('me'), FILTER_VALIDATE_BOOLEAN)) {
    $where[] = "m.user_id = %d";
    $params[] = get_current_user_id();
  }

  $wsql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

  // ------- TRI -------
  $orderParam  = strtoupper($req->get_param('order') ?: 'DESC');
  $order       = in_array($orderParam, array('ASC','DESC'), true) ? $orderParam : 'DESC';
  $obParam     = $req->get_param('orderby') ?: 'id';

  $obMap = array(
    'id'            => 'm.id',
    'created_at'    => 'm.created_at',
    'updated_at'    => 'm.updated_at',
    'grade'         => 'm.grade',
    'specialite'    => 'm.specialite',
    'user'          => $need_user ? 'u.display_name' : 'm.id',
    'etablissement' => $with_etab ? 'inst.nom' : 'm.id',
    'last_activity' => 'last_activity', // <-- nouveau
  );
  $orderby = isset($obMap[$obParam]) ? $obMap[$obParam] : 'm.id';

  $sql = "SELECT {$select} FROM {$table} m {$join} {$wsql} ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d";
  $params[] = $per; $params[] = $off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
  $rows = array_map('svc_membre_decode_out', $rows);
  return $rows;
}




// #########################################################

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


/**
 * Liste des comptes UTILISATEURS depuis utm_users + utm_user_meta
 * Filtres : roles[], etablissement_id (meta institut_id), search, exclude_lab
 * GET /wp-json/plateforme-recherche/v1/users
 */
function svc_users_list(WP_REST_Request $req){
  global $wpdb;

  // ===== Tables personnalisées =====
  $users_table = $wpdb->prefix . 'users';        // ⚠️ suppose colonnes: ID, user_login, user_email, display_name, user_registered
  $umeta_table = $wpdb->prefix . 'usermeta';    // colonnes: user_id, meta_key, meta_value
  $inst_table  = $wpdb->prefix . 'master_instituts';    // (id, nom)
  $membre_tab  = $wpdb->prefix . 'recherche_membre'; // (id, user_id, laboratoire_id, ...)

  $page = max(1, (int)($req->get_param('page') ?: 1));
  $per  = min(200, max(1, (int)($req->get_param('per_page') ?: 50)));
  $off  = ($page - 1) * $per;

  $search    = trim((string)$req->get_param('search'));
  $instId    = (int)($req->get_param('etablissement_id') ?: $req->get_param('institut_id') ?: 0);
  $withEtab  = filter_var($req->get_param('with_etablissement'), FILTER_VALIDATE_BOOLEAN);
  $excludeLab= (int)($req->get_param('exclude_lab') ?: 0);

  // Rôles: array ou CSV -> normalisés
  $rolesParam = $req->get_param('roles');
  if ($rolesParam && !is_array($rolesParam)) {
    $rolesParam = preg_split('/[,\s]+/', (string)$rolesParam);
  }
  $roles    = array_values(array_filter(array_unique(array_map('svc_roles_normalize', (array)$rolesParam))));
  $needRole = !empty($roles) || (($req->get_param('orderby') ?: '') === 'role');

  $needInst = $instId || $withEtab || (($req->get_param('orderby') ?: '') === 'etablissement');

  // Pour compatibilité si certains comptes utilisent encore le stockage WP des capacités
  $cap_key = $wpdb->get_blog_prefix() . 'capabilities';

  // ===== SELECT / JOIN =====
  // ⚠️ Si votre table utm_users n'a pas ces colonnes exactes :
  // - remplacez u.ID par u.id
  // - remplacez user_login / user_email / display_name / user_registered par vos colonnes
  $select = "u.ID as id, u.user_login, u.user_email, u.display_name, u.user_registered";
  $join   = "";

  if ($needRole) {
    // Cherche le rôle dans meta_key 'role' ou 'roles' (JSON/CSV) ou 'capabilities' (fallback WP)
    $join .= $wpdb->prepare(
      " LEFT JOIN {$umeta_table} um_role
          ON (u.ID = um_role.user_id AND (um_role.meta_key = 'role' OR um_role.meta_key = 'roles' OR um_role.meta_key = 'capabilities' OR um_role.meta_key = %s)) ",
      $cap_key
    );
  }

  if ($needInst) {
    $join .= " LEFT JOIN {$umeta_table} um_inst
                 ON (u.ID = um_inst.user_id AND um_inst.meta_key = 'institut_id')
               LEFT JOIN {$inst_table} inst
                 ON (CAST(um_inst.meta_value AS UNSIGNED) = inst.id) ";
    if ($withEtab) {
      $select .= ", CAST(um_inst.meta_value AS UNSIGNED) AS etablissement_id, inst.nom AS etablissement_nom";
    }
  }

  if ($excludeLab) {
    // Exclure les comptes déjà membres de ce laboratoire
    $join .= $wpdb->prepare(
      " LEFT JOIN {$membre_tab} m_ex ON (m_ex.user_id = u.ID AND m_ex.laboratoire_id = %d) ",
      $excludeLab
    );
  }

  // ===== WHERE =====
  $where  = array();
  $params = array();

  if ($search !== '') {
    $like = '%' . $wpdb->esc_like($search) . '%';
    $where[] = "(u.display_name LIKE %s OR u.user_email LIKE %s OR u.user_login LIKE %s)";
    array_push($params, $like, $like, $like);
  }

  if (!empty($roles)) {
    // meta_value peut être: une string ('um_chercheur'), une JSON array, ou la sérialisation WP
    // On reste sur LIKE par simplicité / compat.
    $roleClauses = array();
    foreach ($roles as $r) {
      $roleClauses[] = "um_role.meta_value LIKE %s";
      $params[] = '%'.$wpdb->esc_like($r).'%';
    }
    $where[] = '(' . implode(' OR ', $roleClauses) . ')';
  }

  if ($instId) {
    $where[] = "CAST(um_inst.meta_value AS UNSIGNED) = %d";
    $params[] = $instId;
  }

  if ($excludeLab) {
    $where[] = "m_ex.id IS NULL";
  }

  $wsql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

  // ===== ORDER BY =====
  $order   = strtoupper($req->get_param('order') ?: 'ASC');
  if (!in_array($order, array('ASC','DESC'), true)) $order = 'ASC';

  $obParam = $req->get_param('orderby') ?: 'display_name';
  $obMap = array(
    'id'            => 'u.ID',            // ⚠️ changez en 'u.id' si votre table utilise 'id'
    'display_name'  => 'u.display_name',
    'email'         => 'u.user_email',
    'registered'    => 'u.user_registered',
    'etablissement' => $needInst ? 'inst.nom' : 'u.display_name',
  );
  $orderby = isset($obMap[$obParam]) ? $obMap[$obParam] : 'u.display_name';

  // ===== SQL final =====
  $sql = "SELECT {$select}
          FROM {$users_table} u
          {$join}
          {$wsql}
          ORDER BY {$orderby} {$order}
          LIMIT %d OFFSET %d";



  $params[] = $per; $params[] = $off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();

  // Typage minimal de sortie
  foreach ($rows as &$r) {
    $r['id'] = (int)$r['id'];
    if (isset($r['etablissement_id'])) $r['etablissement_id'] = (int)$r['etablissement_id'];
  }

  return $rows;
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

