<?php
// Services – Profil utilisateur (usermeta + refs grade/spécialité)
if (!defined('ABSPATH')) exit;

global $wpdb;
$tbl_grade = $wpdb->prefix . 'grade';         // ex: utm_grade
$tbl_spec  = $wpdb->prefix . 'specialites';   // ex: utm_specialites
$tbl_exp   = $wpdb->prefix . 'profile_expertises';
$tbl_dom   = $wpdb->prefix . 'profile_domaines';

/* ---------------- Utils & helpers ---------------- */
if (!function_exists('profile_emit_event')) {
  function profile_emit_event($topic, $payload) { error_log('[PROFILE-EVENT] '.$topic.' '.wp_json_encode($payload)); }
}
function profile_is_student_role() {
  $u = wp_get_current_user();
  $roles = array_map('strtolower', (array)$u->roles);
  foreach (['um_student_master','student_master','um_doctorant','doctorant'] as $r) if (in_array($r,$roles,true)) return true;
  return false;
}
function profile_list_user_expertises($uid){
  global $wpdb, $tbl_exp;
  $rows = $wpdb->get_col($wpdb->prepare(
    "SELECT label FROM {$tbl_exp} WHERE user_id=%d ORDER BY id ASC", $uid
  ));
  return $rows ?: [];
}
function profile_list_user_domaines($uid){
  global $wpdb, $tbl_dom;
  $rows = $wpdb->get_col($wpdb->prepare(
    "SELECT label FROM {$tbl_dom} WHERE user_id=%d ORDER BY id ASC", $uid
  ));
  return $rows ?: [];
}

function profile_replace_user_expertises($uid, $labels){
  global $wpdb, $tbl_exp;
  $labels = array_values(array_unique(array_filter(array_map('trim', (array)$labels))));
  $wpdb->query('START TRANSACTION');
  try{
    $wpdb->delete($tbl_exp, ['user_id'=>$uid], ['%d']);
    foreach($labels as $lab){
      $wpdb->insert($tbl_exp, ['user_id'=>$uid, 'label'=>$lab], ['%d','%s']);
    }
    $wpdb->query('COMMIT');
    return true;
  } catch(Throwable $e){
    $wpdb->query('ROLLBACK');
    return false;
  }
}
function profile_replace_user_domaines($uid, $labels){
  global $wpdb, $tbl_dom;
  $labels = array_values(array_unique(array_filter(array_map('trim', (array)$labels))));
  $wpdb->query('START TRANSACTION');
  try{
    $wpdb->delete($tbl_dom, ['user_id'=>$uid], ['%d']);
    foreach($labels as $lab){
      $wpdb->insert($tbl_dom, ['user_id'=>$uid, 'label'=>$lab], ['%d','%s']);
    }
    $wpdb->query('COMMIT');
    return true;
  } catch(Throwable $e){
    $wpdb->query('ROLLBACK');
    return false;
  }
}

function profile__uploads_dir() {
  $u = wp_upload_dir();
  $dir = trailingslashit($u['basedir']).'profiles';
  if (!file_exists($dir)) wp_mkdir_p($dir);
  return [$dir, trailingslashit($u['baseurl']).'profiles'];
}
function _meta($uid,$key,$def=''){ $v=get_user_meta($uid,$key,true); return ($v===''||$v===null)?$def:$v; }

/* ---------------- Refs: grade / spécialité ---------------- */
function profile_list_grades() {
  global $wpdb, $tbl_grade;
  // on récupère l’essentiel pour un <select>
  $sql = "SELECT id, code, intitule FROM {$tbl_grade} ORDER BY id ASC";
  return $wpdb->get_results($sql, ARRAY_A) ?: [];
}
function profile_list_specialites() {
  global $wpdb, $tbl_spec;
  $sql = "SELECT id, code, intitule FROM {$tbl_spec} ORDER BY intitule ASC";
  return $wpdb->get_results($sql, ARRAY_A) ?: [];
}
function profile_refs() {
  return [
    'grades'       => profile_list_grades(),
    'specialites'  => profile_list_specialites(),
  ];
}
function profile__grade_exists($id) {
  if (!$id) return false;
  global $wpdb, $tbl_grade;
  return (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$tbl_grade} WHERE id=%d",$id)) > 0;
}
function profile__spec_exists($id) {
  if (!$id) return false;
  global $wpdb, $tbl_spec;
  return (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$tbl_spec} WHERE id=%d",$id)) > 0;
}
function profile__grade_row($id) {
  if (!$id) return null;
  global $wpdb, $tbl_grade;
  return $wpdb->get_row($wpdb->prepare("SELECT id, code, intitule FROM {$tbl_grade} WHERE id=%d",$id), ARRAY_A);
}
function profile__spec_row($id) {
  if (!$id) return null;
  global $wpdb, $tbl_spec;
  return $wpdb->get_row($wpdb->prepare("SELECT id, code, intitule FROM {$tbl_spec} WHERE id=%d",$id), ARRAY_A);
}

/* ---------------- GET profile ---------------- */
function profile_get($current_user_id) {
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $user = get_userdata($current_user_id);
  if (!$user) return new WP_Error('not_found','Utilisateur introuvable',['status'=>404]);

  $is_student = profile_is_student_role();

  // --- CV (inchangé)
  $cv_url  = _meta($current_user_id,'cv_url','');
  $cv_name = _meta($current_user_id,'cv_original_name','');
  if (!$cv_name && $cv_url) {
    $path = wp_parse_url($cv_url, PHP_URL_PATH);
    $cv_name = $path ? basename($path) : '';
  }

  // --- Avatar (inchangé)
  $avatar_url = _meta($current_user_id,'avatar_url','');
  if (!$avatar_url) $avatar_url = get_avatar_url($current_user_id);
  $avatar_version = _meta($current_user_id,'avatar_updated_at','');

  $profil = [
    'nom'         => $user->last_name,
    'prenom'      => $user->first_name,
    'nationalite' => _meta($current_user_id,'nationalite',''),
    'tel_country' => _meta($current_user_id,'tel_country','tn'),
    'tel'         => _meta($current_user_id,'tel',''),
    'email1'      => $user->user_email,
    'email2'      => _meta($current_user_id,'email2',''),
    'cin'         => _meta($current_user_id,'cin',''),
    // ▲ Nouveau : ORCID
    'orcid'       => _meta($current_user_id, 'orcid', ''),

    // ▲ champs CV (inchangé)
    'cv'                => $cv_url,
    'cv_original_name'  => $cv_name,

    // ▲ champs avatar (inchangé)
    'avatar'            => $avatar_url,
    'avatar_version'    => $avatar_version,
    
  ];
// Listes Expertises / Domaines
$profil['expertises'] = profile_list_user_expertises($current_user_id);
$profil['domaines']   = profile_list_user_domaines($current_user_id);

  // ... (le reste inchangé : grade/spécialité + infos étudiant / académique) ...
  if ($grade_id = (int)_meta($current_user_id,'grade_id',0)) { $profil['grade'] = profile__grade_row($grade_id); }
  if ($spec_id  = (int)_meta($current_user_id,'specialite_id',0)) { $profil['specialite'] = profile__spec_row($spec_id); }

  if ($is_student) {
    $profil['adr_etud']    = _meta($current_user_id,'adr_etud','');
    $profil['gov_etud']    = _meta($current_user_id,'gov_etud','');
    $profil['cp_etud']     = _meta($current_user_id,'cp_etud','');
    $profil['adr_parents'] = _meta($current_user_id,'adr_parents','');
    $profil['gov_parents'] = _meta($current_user_id,'gov_parents','');
    $profil['cp_parents']  = _meta($current_user_id,'cp_parents','');
    $profil['tel_parents'] = _meta($current_user_id,'tel_parents','');
  } else {
    $profil['academic_info'] = _meta($current_user_id,'academic_info','');
  }

  return $profil;
}

/* ---------------- UPDATE profile ---------------- */
function profile_update($current_user_id, $patch) {
  if (!$current_user_id) return new WP_Error('not_logged_in', 'Non connecté', ['status' => 401]);
  if (!is_array($patch)) $patch = [];

  $is_student = profile_is_student_role();

  // Prepare user data for wp_update_user (inchangé)
  $user_data = ['ID' => $current_user_id];

  // Update nom and prenom if provided and not locked (non-student) (inchangé)
  if (!$is_student) {
    if (isset($patch['nom'])) {
      $user_data['last_name'] = sanitize_text_field($patch['nom']);
    }
    if (isset($patch['prenom'])) {
      $user_data['first_name'] = sanitize_text_field($patch['prenom']);
    }
  }

  // Update email1 if provided (inchangé)
  if (isset($patch['email1'])) {
    $user_data['user_email'] = sanitize_email($patch['email1']);
  }

  // Update user data if any fields are set (inchangé)
  if (count($user_data) > 1) { // More than just ID
    $res = wp_update_user($user_data);
    if (is_wp_error($res)) return $res;
  }
// Expertises & Domaines
if (isset($patch['expertises'])) {
  $ok = profile_replace_user_expertises($current_user_id, $patch['expertises']);
  if (!$ok) return new WP_Error('server_error','Échec mise à jour expertises',['status'=>500]);
}
if (isset($patch['domaines'])) {
  $ok = profile_replace_user_domaines($current_user_id, $patch['domaines']);
  if (!$ok) return new WP_Error('server_error','Échec mise à jour domaines',['status'=>500]);
}

  // Update user meta fields (inchangé pour les autres)
  if (isset($patch['nationalite'])) update_user_meta($current_user_id, 'nationalite', sanitize_text_field($patch['nationalite']));
  if (isset($patch['cin'])) update_user_meta($current_user_id, 'cin', sanitize_text_field($patch['cin']));
  if (isset($patch['email2'])) update_user_meta($current_user_id, 'email2', sanitize_email($patch['email2']));
  if (isset($patch['tel_country'])) update_user_meta($current_user_id, 'tel_country', sanitize_text_field($patch['tel_country']));
  if (isset($patch['tel'])) update_user_meta($current_user_id, 'tel', sanitize_text_field($patch['tel']));

  // ▲ Nouveau : Contrôles ORCID
  if (isset($patch['orcid'])) {
    $orcid = trim($patch['orcid']);
    if ($orcid === '') {
      // Autoriser la suppression (vider le champ)
      update_user_meta($current_user_id, 'orcid', '');
    } else {
      // Validation format
      if (!preg_match('/^\d{4}-\d{4}-\d{4}-\d{4}$/', $orcid)) {
        return new WP_Error('bad_request', 'Format ORCID invalide (xxxx-xxxx-xxxx-xxxx)', ['status' => 400]);
      }
      // Vérification unicité (autre utilisateur)
      global $wpdb;
      $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='orcid' AND meta_value=%s AND user_id != %d",
        $orcid, $current_user_id
      ));
      if ($existing) {
        return new WP_Error('bad_request', 'ORCID déjà utilisé par un autre utilisateur', ['status' => 400]);
      }
      // OK : sauvegarde
      update_user_meta($current_user_id, 'orcid', $orcid);
    }
  }

  // Grade / Spécialité (inchangé)
  if (isset($patch['grade_id'])) {
    $gid = (int)$patch['grade_id'];
    if ($gid === 0 || profile__grade_exists($gid)) {
      update_user_meta($current_user_id, 'grade_id', $gid);
    } else {
      return new WP_Error('bad_request', 'grade_id invalide', ['status' => 400]);
    }
  }
  if (isset($patch['specialite_id'])) {
    $sid = (int)$patch['specialite_id'];
    if ($sid === 0 || profile__spec_exists($sid)) {
      update_user_meta($current_user_id, 'specialite_id', $sid);
    } else {
      return new WP_Error('bad_request', 'specialite_id invalide', ['status' => 400]);
    }
  }

  if ($is_student) {
    foreach (['adr_etud', 'gov_etud', 'cp_etud', 'adr_parents', 'gov_parents', 'cp_parents', 'tel_parents'] as $k) {
      if (isset($patch[$k])) {
        update_user_meta($current_user_id, $k, sanitize_text_field($patch[$k]));
      }
    }
  } else {
    if (isset($patch['academic_info'])) {
      $academic_info = is_array($patch['academic_info']) ? $patch['academic_info'] : [];
      // Sanitize academic_info fields (inchangé)
      $sanitized_info = [
        'email_acad' => isset($academic_info['email_acad']) ? sanitize_email($academic_info['email_acad']) : '',
        'tel_pro' => isset($academic_info['tel_pro']) ? sanitize_text_field($academic_info['tel_pro']) : '',
        'adresse_pro' => isset($academic_info['adresse_pro']) ? sanitize_text_field($academic_info['adresse_pro']) : '',
        'fonctions' => isset($academic_info['fonctions']) ? sanitize_text_field($academic_info['fonctions']) : ''
      ];
      update_user_meta($current_user_id, 'academic_info', wp_json_encode($sanitized_info));
    }
  }

  profile_emit_event('profile.updated', ['user_id' => $current_user_id, 'updated_at' => gmdate('c')]);
  return ['ok' => true];
}
/* ---------------- PASSWORD ---------------- */
function profile_change_password($current_user_id, $payload) {
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $old = (string)($payload['old_password'] ?? '');
  $new = (string)($payload['new_password'] ?? '');
  $cfm = (string)($payload['confirm_password'] ?? '');
  if ($old===''||$new===''||$cfm==='') return new WP_Error('bad_request','Tous les champs sont requis',['status'=>400]);
  if ($new !== $cfm) return new WP_Error('bad_request','Les mots de passe ne correspondent pas',['status'=>400]);
  if (strlen($new) < 6) return new WP_Error('bad_request','Mot de passe trop court (min 6 caractères)',['status'=>400]);

  $user = get_user_by('id',$current_user_id);
  if (!$user || !wp_check_password($old,$user->user_pass,$current_user_id)) {
    return new WP_Error('invalid_old','Ancien mot de passe incorrect',['status'=>403]);
  }
  wp_set_password($new,$current_user_id);

  profile_emit_event('profile.password_changed',['user_id'=>$current_user_id,'changed_at'=>gmdate('c')]);
  return ['ok'=>true];
}

/* ---------------- UPLOAD AVATAR ---------------- */
function profile_upload_avatar($current_user_id, $payload) {
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);
  $mime = sanitize_mime_type($payload['mime_type'] ?? 'image/jpeg');
  $content = (string)($payload['content'] ?? '');
  if ($content==='') return new WP_Error('bad_request','content requis',['status'=>400]);

  $data = preg_replace('#^data:[^;]+;base64,#','',$content);
  $bin  = base64_decode($data);
  if ($bin===false) return new WP_Error('bad_request','base64 invalide',['status'=>400]);

  list($dir,$baseurl) = profile__uploads_dir();
  $ext  = (strpos($mime,'png')!==false) ? 'png' : 'jpg';
  $path = trailingslashit($dir).'user_'.$current_user_id.'_avatar_'.uniqid().'.'.$ext;
  if (file_put_contents($path,$bin)===false) return new WP_Error('server_error',"Impossible d'écrire le fichier",['status'=>500]);

  $url = trailingslashit($baseurl).basename($path);

  // ▲ AVATAR: URL + version pour cache-busting
  update_user_meta($current_user_id,'avatar_url',$url);
  $version = time();
  update_user_meta($current_user_id,'avatar_updated_at',$version);

  profile_emit_event('profile.avatar_uploaded',['user_id'=>$current_user_id,'url'=>$url,'uploaded_at'=>gmdate('c')]);

  // on renvoie aussi la version si tu veux rafraîchir instantanément côté front
  return ['url'=>$url, 'version'=>$version];
}

/* ---------------- UPLOAD CV ---------------- */
function profile_upload_cv($current_user_id, $payload) {
  if (!$current_user_id) return new WP_Error('not_logged_in','Non connecté',['status'=>401]);

  $mime     = sanitize_mime_type($payload['mime_type'] ?? 'application/pdf');
  $fileName = sanitize_file_name($payload['file_name'] ?? 'document.pdf'); // ▲ nom original
  $content  = (string)($payload['content'] ?? '');
  if ($content==='') return new WP_Error('bad_request','content requis',['status'=>400]);

  $data = preg_replace('#^data:[^;]+;base64,#','',$content);
  $bin  = base64_decode($data);
  if ($bin===false) return new WP_Error('bad_request','base64 invalide',['status'=>400]);

  list($dir,$baseurl) = profile__uploads_dir();
  $ext  = (strpos($mime,'pdf')!==false) ? 'pdf' :
          ((strpos($mime,'wordprocessingml')!==false) ? 'docx' :
          ((strpos($mime,'msword')!==false) ? 'doc' : 'bin'));
  $path = trailingslashit($dir).'user_'.$current_user_id.'_cv_'.uniqid().'.'.$ext;
  if (file_put_contents($path,$bin)===false) return new WP_Error('server_error',"Impossible d'écrire le fichier",['status'=>500]);

  $url = trailingslashit($baseurl).basename($path);

  // ▲ CV: URL + NOM ORIGINAL
  update_user_meta($current_user_id,'cv_url',$url);
  update_user_meta($current_user_id,'cv_original_name',$fileName);

  profile_emit_event('profile.cv_uploaded',['user_id'=>$current_user_id,'url'=>$url,'uploaded_at'=>gmdate('c')]);
  return ['url'=>$url, 'original_name'=>$fileName];
}

