<?php
/**
 * Logique métier Contacts (CRUD + sécurité par laboratoire)
 */
if (!defined('ABSPATH')) { exit; }

/* ====== Helpers tables ====== */
if (!function_exists('svc_contacts_table')) {
  function svc_contacts_table(){ global $wpdb; return $wpdb->prefix . 'contacts'; }
}
if (!function_exists('svc_contact_membre_table')) {
  function svc_contact_membre_table(){ global $wpdb; return $wpdb->prefix . 'recherche_membre'; }
}
if (!function_exists('svc_contact_laboratoire_table')) {
  function svc_contact_laboratoire_table(){ global $wpdb; return $wpdb->prefix . 'recherche_laboratoire'; }
}

/* ====== Helpers colonnes ====== */
if (!function_exists('svc_contact_col_exists')) {
  function svc_contact_col_exists($table, $col){
    global $wpdb;
    return (bool)$wpdb->get_var($wpdb->prepare("SHOW COLUMNS FROM {$table} LIKE %s", $col));
  }
}

/* ====== Mes laboratoires (membre + directeur) ====== */
if (!function_exists('svc_contact_current_user_lab_ids')) {
  function svc_contact_current_user_lab_ids(): array {
    global $wpdb;
    $uid = get_current_user_id();
    if (!$uid) return [];

    $mt = svc_contact_membre_table();
    $lt = svc_contact_laboratoire_table();

    $labs = [];

    // A) membre
    $rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$mt} WHERE user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));

    // B) directeur
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lt} WHERE directeur_user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));

    $labs = array_values(array_unique(array_filter($labs)));
    return $labs;
  }
}

/* ====== Validation & sanitisation ====== */
if (!function_exists('svc_contact_allowed_fields')) {
  function svc_contact_allowed_fields(): array {
    return array(
      'laboratoire_id'     => 'int',
      'institution'        => 'text',
      'domaine'            => 'text',
      'matricule'          => 'text',
      'org_address'        => 'text',
      'contact_nom'        => 'text',
      'contact_email'      => 'email',
      'contact_tel'        => 'text',
      'org_email'          => 'email',
      'org_tel'            => 'text',
      'website'            => 'text',
      'logo_url'           => 'text',
      'contact_avatar_url' => 'text',
    );
  }
}
if (!function_exists('svc_contact_fmt')) {
  function svc_contact_fmt($type){ return $type==='int' ? '%d' : '%s'; }
}
if (!function_exists('svc_contact_sanitize')) {
  function svc_contact_sanitize($key,$val,$type){
    switch ($type){
      case 'int':   return is_numeric($val) ? intval($val) : null;
      case 'email': return is_email($val) ? sanitize_email($val) : null;
      default:      return is_scalar($val) ? sanitize_text_field($val) : null;
    }
  }
}

/* ====== GET /contact (liste) ====== */
if (!function_exists('svc_contact_list')) {
  function svc_contact_list(WP_REST_Request $req){
    global $wpdb; $t = svc_contacts_table();
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return array(); // aucun labo => aucune donnée

    $page = max(1, intval($req->get_param('page') ?: 1));
    $per  = max(1, min(200, intval($req->get_param('per_page') ?: 50)));
    $off  = ($page - 1) * $per;

    $where = array("laboratoire_id IN (".implode(',', array_map('intval',$lab_ids)).")");
    $params = array();

    if ($q = trim((string)$req->get_param('search'))) {
      $like = '%'.$wpdb->esc_like($q).'%';
      $where[] = "(institution LIKE %s OR domaine LIKE %s OR contact_nom LIKE %s OR contact_email LIKE %s OR contact_tel LIKE %s)";
      array_push($params, $like, $like, $like, $like, $like);
    }

    $sql = "SELECT id,laboratoire_id,institution,domaine,contact_nom,contact_email,contact_tel,
                   org_email,org_tel,website,logo_url,contact_avatar_url,matricule,org_address,created_at,updated_at,created_by,updated_by
            FROM {$t}
            WHERE ".implode(' AND ', $where)."
            ORDER BY id DESC
            LIMIT %d OFFSET %d";
    $params[] = $per; $params[] = $off;

    $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();
    return $rows;
  }
}

/* ====== GET /contact/{id} ====== */
if (!function_exists('svc_contact_get')) {
  function svc_contact_get(WP_REST_Request $req){
    global $wpdb; $t = svc_contacts_table(); $id = intval($req['id']);
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Accès refusé',array('status'=>403));

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$row) return new WP_Error('not_found','Introuvable',array('status'=>404));
    if (!in_array((int)$row['laboratoire_id'], $lab_ids, true))
      return new WP_Error('forbidden','Hors de votre périmètre labo',array('status'=>403));

    return $row;
  }
}

/* ====== POST /contact (create) ====== */
if (!function_exists('svc_contact_create')) {
  function svc_contact_create(WP_REST_Request $req){
    global $wpdb; $t = svc_contacts_table();
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids))
      return new WP_Error('forbidden','Vous n’êtes rattaché à aucun laboratoire', array('status'=>403));

    $allowed = svc_contact_allowed_fields();
    $data = $req->get_json_params(); if (!$data) $data = $req->get_params();
    foreach (['logo_url','contact_avatar_url'] as $k) {
      if (!empty($data[$k]) && is_string($data[$k]) && stripos($data[$k], 'data:image')===0) {
        $url = svc_contact_store_dataurl_local($data[$k], $k==='logo_url'?'org-logo':'contact-avatar');
        if ($url) { $data[$k] = $url; } else { unset($data[$k]); }
      }
    }

    $ins = array(); $fmts = array();
    foreach($allowed as $k=>$type){
      if (!array_key_exists($k,$data)) continue;
      $v = svc_contact_sanitize($k,$data[$k],$type);
      if ($v === null || $v === '') continue;
      $ins[$k] = $v; $fmts[] = svc_contact_fmt($type);
    }

    // labo auto si absent, sinon vérifier l’autorisation
    if (empty($ins['laboratoire_id'])) {
      $ins['laboratoire_id'] = (int)$lab_ids[0];
      $fmts[] = '%d';
    } else {
      if (!in_array((int)$ins['laboratoire_id'], $lab_ids, true))
        return new WP_Error('forbidden','Vous ne pouvez créer que dans vos labos', array('status'=>403));
    }

    // champs requis minimaux
    if (empty($ins['institution']) || empty($ins['contact_nom'])) {
      return new WP_Error('bad_request','Les champs "institution" et "contact_nom" sont requis', array('status'=>400));
    }

    // audit (si colonnes présentes)
    $now = current_time('mysql'); $uid = get_current_user_id();
    if (svc_contact_col_exists($t,'created_by'))   { $ins['created_by'] = $uid; $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'updated_by'))   { $ins['updated_by'] = $uid; $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'created_at'))   { $ins['created_at'] = $now; $fmts[]='%s'; }
    if (svc_contact_col_exists($t,'updated_at'))   { $ins['updated_at'] = $now; $fmts[]='%s'; }

    $ok = $wpdb->insert($t, $ins, $fmts);
    if (!$ok) return new WP_Error('db_error','Insert failed: '.$wpdb->last_error, array('status'=>500));

    $id = (int)$wpdb->insert_id;
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    return $row;
  }
}

/* ====== PUT/PATCH /contact/{id} (update) ====== */
if (!function_exists('svc_contact_update')) {
  function svc_contact_update(WP_REST_Request $req){
    global $wpdb; $t = svc_contacts_table(); $id = intval($req['id']);
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Accès refusé',array('status'=>403));

    $cur = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Introuvable',array('status'=>404));
    if (!in_array((int)$cur['laboratoire_id'], $lab_ids, true))
      return new WP_Error('forbidden','Hors de votre périmètre labo',array('status'=>403));

    $allowed = svc_contact_allowed_fields();
    $data = $req->get_json_params(); if (!$data) $data = $req->get_params();
    foreach (['logo_url','contact_avatar_url'] as $k) {
      if (!empty($data[$k]) && is_string($data[$k]) && stripos($data[$k], 'data:image')===0) {
        $url = svc_contact_store_dataurl_local($data[$k], $k==='logo_url'?'org-logo':'contact-avatar');
        if ($url) { $data[$k] = $url; } else { unset($data[$k]); }
      }
    }

    $upd=array(); $fmts=array();
    foreach($allowed as $k=>$type){
      if (!array_key_exists($k,$data)) continue;

      if ($k==='laboratoire_id'){ // empêcher un déplacement non autorisé
        $newLab = intval($data[$k]);
        if (!in_array($newLab, $lab_ids, true))
          return new WP_Error('forbidden','Déplacement vers un labo non autorisé',array('status'=>403));
        $upd[$k]=$newLab; $fmts[]='%d'; continue;
      }

      $v = svc_contact_sanitize($k,$data[$k],$type);
      if ($v === null) continue;
      $upd[$k]=$v; $fmts[] = svc_contact_fmt($type);
    }

    if (empty($upd)) return new WP_Error('bad_request','Aucun champ valide',array('status'=>400));

    // audit
    if (svc_contact_col_exists($t,'updated_by')) { $upd['updated_by'] = get_current_user_id(); $fmts[]='%d'; }
    if (svc_contact_col_exists($t,'updated_at')) { $upd['updated_at'] = current_time('mysql'); $fmts[]='%s'; }

    $ok = $wpdb->update($t, $upd, array('id'=>$id), $fmts, array('%d'));
    if ($ok === false) return new WP_Error('db_error','Update failed: '.$wpdb->last_error, array('status'=>500));

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    return $row;
  }
}

/* ====== DELETE /contact/{id} ====== */
if (!function_exists('svc_contact_delete')) {
  function svc_contact_delete(WP_REST_Request $req){
    global $wpdb; $t = svc_contacts_table(); $id = intval($req['id']);
    $lab_ids = svc_contact_current_user_lab_ids();
    if (empty($lab_ids)) return new WP_Error('forbidden','Accès refusé',array('status'=>403));

    $cur = $wpdb->get_row($wpdb->prepare("SELECT laboratoire_id FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Introuvable',array('status'=>404));
    if (!in_array((int)$cur['laboratoire_id'], $lab_ids, true))
      return new WP_Error('forbidden','Hors de votre périmètre labo',array('status'=>403));

    $ok = $wpdb->delete($t, array('id'=>$id), array('%d'));
    if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));

    return new WP_REST_Response(null, 204);
  }
}
function contact__uploads_dir() {
  $u = wp_upload_dir();
  $dir = trailingslashit($u['basedir']).'contacts';
  if (!file_exists($dir)) wp_mkdir_p($dir);
  return [$dir, trailingslashit($u['baseurl']).'contacts'];
}
function svc_contact_store_dataurl_local($dataurl, $prefix='contact') {
  if (!is_string($dataurl) || stripos($dataurl, 'data:image') !== 0) return $dataurl;

  if (!preg_match('#^data:(image/[\w\+\-\.]+);base64,(.+)$#', $dataurl, $m)) return null;
  $mime = sanitize_mime_type($m[1]);
  $bin  = base64_decode($m[2]);
  if ($bin===false) return null;

  list($dir,$baseurl) = contact__uploads_dir();
  $ext  = (strpos($mime,'png')!==false) ? 'png' : ((strpos($mime,'webp')!==false)?'webp':'jpg');
  $name = $prefix.'_'.time().'_'.wp_generate_password(6,false).'.'.$ext;
  $path = trailingslashit($dir).$name;

  if (file_put_contents($path, $bin)===false) return null;
  return trailingslashit($baseurl).$name;
}
