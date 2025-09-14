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
function svc_laboratoire_table(){ global $wpdb; return $wpdb->prefix.'recherche_laboratoire'; }

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

  function svc_laboratoire_createOLD(WP_REST_Request $req){
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
/*
    // --- Associer automatiquement le directeur & l’établissement courant ---
    $current_uid = get_current_user_id();
    if ($current_uid) {
      $upd['directeur_user_id'] = $current_uid;   $formats[] = '%d';
      $inst = get_user_meta($current_uid, 'institut_id', true);
      if ($inst !== '' && $inst !== null) {
        $upd['etablissement_id'] = (int)$inst;    $formats[] = '%d';
      }
    }
*/
    // --- Audit ---
   // $upd['updated_by'] = $current_uid;            $formats[] = '%d';

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


function svc_laboratoire_update_directeur(WP_REST_Request $req){
  global $wpdb;
  $table = svc_laboratoire_table();

  // --- sécurité de base
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Utilisateur non connecté',['status'=>403]);

  $id = absint($req['id'] ?? 0);
  if ($id <= 0) return new WP_Error('bad_request','ID laboratoire invalide',['status'=>400]);

  // --- params
  $directeur_user_id = $req->get_param('directeur_user_id');
  if ($directeur_user_id === null || $directeur_user_id === '') {
    return new WP_Error('bad_request','Paramètre directeur_user_id manquant',['status'=>400]);
  }
  $directeur_user_id = absint($directeur_user_id);
  if ($directeur_user_id <= 0) {
    return new WP_Error('bad_request','directeur_user_id invalide',['status'=>400]);
  }

  // --- vérifier existence labo (on récupère directeur actuel)
  $lab = $wpdb->get_row(
    $wpdb->prepare("SELECT id, etablissement_id, directeur_user_id, denomination FROM $table WHERE id=%d",$id),
    ARRAY_A
  );
  if (!$lab) return new WP_Error('not_found','Laboratoire introuvable',['status'=>404]);

  // --- si le même directeur est déjà affecté à ce labo -> rien à faire
  if ((int)$lab['directeur_user_id'] === $directeur_user_id){
    // renvoie l’état actuel enrichi
    $u_now = $lab['directeur_user_id'] ? get_user_by('id', (int)$lab['directeur_user_id']) : null;
    $lab['directeur_nom']    = $u_now ? $u_now->display_name : null;
    $lab['directeur_email']  = $u_now ? $u_now->user_email   : null;
    $lab['directeur_avatar'] = $u_now ? get_avatar_url($u_now->ID) : null;
    return new WP_REST_Response($lab, 200);
  }

  // --- vérifier existence user
  $u = get_user_by('id', $directeur_user_id);
  if (!$u) return new WP_Error('not_found','Utilisateur (directeur) introuvable',['status'=>404]);

  // (optionnel) vérifier le rôle
  $roles = (array)($u->roles ?? []);
  if (!in_array('um_directeur_laboratoire', $roles, true)) {
    return new WP_Error('role_mismatch',"L'utilisateur sélectionné n'a pas le rôle 'um_directeur_laboratoire'.",['status'=>400]);
  }

  // (optionnel) vérifier même établissement (usermeta 'institut_id')
  $user_institut = get_user_meta($directeur_user_id, 'institut_id', true);
  if ($user_institut !== '' && $user_institut !== null) {
    if ((int)$user_institut !== (int)$lab['etablissement_id']) {
      return new WP_Error('institut_mismatch',"Le directeur choisi n'appartient pas au même établissement que le labo.",['status'=>400]);
    }
  }

  // === CONTRAINTE : directeur déjà affecté à un autre labo ? ===
  $conflict = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT id, denomination FROM $table WHERE directeur_user_id = %d AND id <> %d LIMIT 1",
      $directeur_user_id, $id
    ),
    ARRAY_A
  );
  if ($conflict){
    $msg = sprintf(
      "Impossible d'affecter ce directeur : il est déjà rattaché au laboratoire #%d%s.",
      (int)$conflict['id'],
      !empty($conflict['denomination']) ? " (« {$conflict['denomination']} »)" : ''
    );
    return new WP_Error('director_already_assigned', $msg, ['status'=>409, 'conflict_lab'=>$conflict]);
  }

  // --- mise à jour minimale
  $data = [
    'directeur_user_id' => $directeur_user_id,
    'updated_by'        => $uid,
    'updated_at'        => current_time('mysql'),
  ];
  $fmt  = ['%d','%d','%s'];

  $ok = $wpdb->update($table, $data, ['id'=>$id], $fmt, ['%d']);
  if ($ok === false) {
    return new WP_Error('db_error','Échec mise à jour directeur',['status'=>500,'mysql_error'=>$wpdb->last_error]);
  }

  // --- retour enrichi
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d",$id), ARRAY_A);
  if ($row) {
    $row['directeur_nom']    = $u->display_name;
    $row['directeur_email']  = $u->user_email;
    $row['directeur_avatar'] = get_avatar_url($u->ID);
  }
  return new WP_REST_Response($row ?: ['id'=>$id,'directeur_user_id'=>$directeur_user_id], 200);
}





  function svc_laboratoire_delete(WP_REST_Request $req){
    global $wpdb; $table = svc_laboratoire_table(); $id = intval($req['id']);
    $ok = $wpdb->delete($table, array('id'=>$id), array('%d'));
    if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
    return new WP_REST_Response(null, 204);
  }


function svc_laboratoire_list(WP_REST_Request $req){
  global $wpdb;
  $table_labo   = svc_laboratoire_table(); // ex: "{$wpdb->prefix}utm_recherche_laboratoire"
  $table_inst   = "{$wpdb->prefix}master_instituts";
  $table_users  = $wpdb->users;
  $table_umeta  = $wpdb->usermeta;

  // === Contexte utilisateur / rôles
  $current_user = wp_get_current_user();
  $uid   = get_current_user_id();
  $roles = (array) ($current_user->roles ?? []);
  $is_service_etab = in_array('um_service_etablissement', $roles, true) || in_array('um_service-etablissement', $roles, true);

  // === Paramètres de pagination
  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  // === Filtres
  $where  = array();
  $params = array();

  // statut
  if ($statut = $req->get_param('statut')){
    $where[] = "l.statut = %s";
    $params[] = $statut;
  }

  // établissement (id numérique) — filtre explicite
  if ($eid = $req->get_param('etablissement_id')){
    $where[] = "l.etablissement_id = %d";
    $params[] = intval($eid);
  }

  // recherche fulltext simple
  if ($q = trim((string)$req->get_param('search'))){
    $qLike = '%' . $wpdb->esc_like($q) . '%';
    $where[] = "(l.denomination LIKE %s OR l.code_lr LIKE %s OR i.nom LIKE %s OR COALESCE(CONCAT(um1.meta_value,' ',um2.meta_value), u.display_name) LIKE %s)";
    array_push($params, $qLike, $qLike, $qLike, $qLike);
  }

  // me=1 => restreint aux labos du user connecté (directeur)
  if (filter_var($req->get_param('me'), FILTER_VALIDATE_BOOLEAN)) {
    $where[] = "l.directeur_user_id = %d";
    $params[] = $uid;
  }

  // 🔒 Contrainte rôle "um_service_etablissement" : forcer l'établissement du user (usermeta: institut_id)
  if ($is_service_etab) {
    $inst_id = get_user_meta($uid, 'institut_id', true);
    if ($inst_id === '' || $inst_id === null) {
      return new WP_Error('no_institut_id', "Aucun 'institut_id' n'est associé à votre compte.", ['status'=>403]);
    }
    // On impose l'établissement du user connecté
    $where[]  = "l.etablissement_id = %d";
    $params[] = (int) $inst_id;
  }

  $wsql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

  // === Tri
  $orderby = $req->get_param('orderby') ?: 'id';
  $order   = strtoupper($req->get_param('order') ?: 'DESC');

  $allowedOrderBy = array('id','denomination','code_lr','domaine','date_creation','created_at','updated_at','etablissement_nom','directeur_nom');
  if (!in_array($orderby, $allowedOrderBy, true)) $orderby = 'id';
  if (!in_array($order, array('ASC','DESC'), true)) $order = 'DESC';

  // === Meta key pour l'avatar
  $AVATAR_META_KEY = 'avatar_url';

  // === Requête principale
  $sql = "
    SELECT
      l.*,
      l.domaine AS domaine,
      i.nom AS etablissement_nom,
      u.ID            AS directeur_wp_id,
      u.user_email    AS directeur_email,
      u.display_name  AS directeur_display_name,
      um1.meta_value  AS first_name,
      um2.meta_value  AS last_name,
      um3.meta_value  AS avatar_url,
      TRIM(
        COALESCE(
          NULLIF(CONCAT(um1.meta_value,' ',um2.meta_value), ' '),
          u.display_name
        )
      ) AS directeur_nom
    FROM $table_labo l
    LEFT JOIN $table_inst  i   ON i.id = l.etablissement_id
    LEFT JOIN $table_users u   ON u.ID = l.directeur_user_id
    LEFT JOIN $table_umeta um1 ON (um1.user_id = u.ID AND um1.meta_key = 'first_name')
    LEFT JOIN $table_umeta um2 ON (um2.user_id = u.ID AND um2.meta_key = 'last_name')
    LEFT JOIN $table_umeta um3 ON (um3.user_id = u.ID AND um3.meta_key = %s)
    $wsql
    ORDER BY $orderby $order
    LIMIT %d OFFSET %d
  ";

  // Params: meta_key avatar, filtres, pagination
  array_unshift($params, $AVATAR_META_KEY);
  $params[] = $per;
  $params[] = $off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();

  // Post-traitement (avatar fallback + décodage éventuel)
  foreach ($rows as &$r){
    if (empty($r['avatar_url']) && !empty($r['directeur_wp_id'])) {
      $r['avatar_url'] = get_avatar_url((int)$r['directeur_wp_id']);
    }
  }
  unset($r);

  $rows = array_map('svc_labo_decode_out', $rows);

  return $rows;
}




/*
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
*/
function svc_labo_projets(WP_REST_Request $req){
  global $wpdb; 
  $labo_id = intval($req['id']);
  $table   = $wpdb->prefix . 'recherche_projet';
  $table_labo = $wpdb->prefix . 'recherche_laboratoire';

  $sql = $wpdb->prepare("
    SELECT p.id, p.titre, p.statut, p.type_financement, p.budget, p.date_debut, p.date_fin
    FROM $table p
    LEFT JOIN $table_labo l ON p.chercheur_id = l.directeur_user_id
    WHERE l.id  = %d
    ORDER BY p.id DESC
  ", $labo_id);



  $rows = $wpdb->get_results($sql, ARRAY_A);
  return $rows ?: [];
}

function svc_laboratoire_mine(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_laboratoire_table();
  $uid   = get_current_user_id();
  $user  = wp_get_current_user();
  $roles = (array) $user->roles;

  // Helper SELECT commun (on réutilise le même SELECT partout)
  $select_sql = "
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
  ";

  // ---- Cas 1 : Directeur de labo (comme avant)
  if (in_array('um_directeur_laboratoire', $roles, true)) {
    $sql = $select_sql . " WHERE l.directeur_user_id = %d ORDER BY l.id DESC LIMIT 1";
    $row = $wpdb->get_row($wpdb->prepare($sql, $uid), ARRAY_A);
  }
  // ---- Cas 2 : Chercheur (comme avant)
  elseif (in_array('um_chercheur', $roles, true)) {
    $membre_table = svc_membre_table();
    $sql = "
      $select_sql
      INNER JOIN $membre_table m ON l.id = m.laboratoire_id
      WHERE m.user_id = %d
      ORDER BY l.id DESC
      LIMIT 1
    ";
    $row = $wpdb->get_row($wpdb->prepare($sql, $uid), ARRAY_A);
  }
  // ---- Cas 3 : Service UTM / Service Établissement => lire ?id=... depuis la requête
  elseif (in_array('um_service_utm', $roles, true) || in_array('um_service-utm', $roles, true)
       || in_array('um_service_etablissement', $roles, true) || in_array('um_service-etablissement', $roles, true)) {

    $lab_id = absint($req->get_param('id'));
    if (!$lab_id) {
      return new WP_Error('missing_id', "Paramètre 'id' manquant dans l'URL (ex: /fiche-de-details-de-laboratoire/?id=18).", ['status'=>400]);
    }

    // Si service établissement -> restreindre à son institut
    if (in_array('um_service_etablissement', $roles, true) || in_array('um_service-etablissement', $roles, true)) {
      $inst_id = get_user_meta($uid, 'institut_id', true);
      if ($inst_id === '' || $inst_id === null) {
        return new WP_Error('no_institut_id', "Aucun 'institut_id' associé à votre compte.", ['status'=>403]);
      }
      $sql = $select_sql . " WHERE l.id = %d AND l.etablissement_id = %d LIMIT 1";
      $row = $wpdb->get_row($wpdb->prepare($sql, $lab_id, (int)$inst_id), ARRAY_A);
    } else {
      // Service UTM : accès global
      $sql = $select_sql . " WHERE l.id = %d LIMIT 1";
      $row = $wpdb->get_row($wpdb->prepare($sql, $lab_id), ARRAY_A);
    }
  }
  // ---- Autres rôles : rien
  else {
    return [];
  }

  if (!$row) return [];

  // Décodage / enrichissement
  $row = svc_labo_decode_out($row);
  $row['directeur_nom_complet'] = trim(($row['first_name'] ?? '').' '.($row['last_name'] ?? ''));

  return $row;
}

function svc_labo_effectifs(WP_REST_Request $req){
    global $wpdb;
    $labo_id = intval($req['id']);

    $table_membre = $wpdb->prefix . 'recherche_membre';   // utm_recherche_membre
    $table_umeta  = $wpdb->prefix . 'usermeta';           // wp_usermeta
    $table_grade  = $wpdb->prefix . 'grade';              // utm_grade

    // --- Requête : lier membre → usermeta(grade_id) → grade ---
    $sql = $wpdb->prepare("
        SELECT g.intitule AS grade, COUNT(*) AS total
        FROM $table_membre m
        INNER JOIN $table_umeta um ON um.user_id = m.user_id AND um.meta_key = 'grade_id'
        INNER JOIN $table_grade g ON g.id = um.meta_value
        WHERE m.laboratoire_id = %d
        GROUP BY g.id, g.intitule
    ", $labo_id);

    $rows = $wpdb->get_results($sql, ARRAY_A);

    // Structurer la réponse
    $effectifs = [];
    foreach($rows as $r){
        $effectifs[$r['grade']] = intval($r['total']);
    }

    return $effectifs;
}




  /* ===============================
  *  HELPERS (DB + sanitize + decode)
  * =============================== */

  function svc_membre_table(){
    global $wpdb;
    return $wpdb->prefix . 'recherche_membre';
  }
if (!function_exists('svc_membre_common_field_defs')) {
  function svc_membre_common_field_defs($for_update = false){
    return array(
      'user_id'        => array('type'=>'integer', 'required'=>!$for_update),
      'laboratoire_id' => array('type'=>'integer', 'required'=>!$for_update),
      'grade'          => array('type'=>'string'),
      'specialite'     => array('type'=>'string'),
    );
  }
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

  /*
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
*/

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
        if ($val !== null && $val !== '') { 
            $row[$k] = $val; 
            $formats[] = svc_membre_format($def); 
        }
    }

    // Contrainte d’unicité (user_id, laboratoire_id)
    $uid = isset($row['user_id']) ? (int)$row['user_id'] : 0;
    $lid = isset($row['laboratoire_id']) ? (int)$row['laboratoire_id'] : 0;

    if ($uid && $lid && svc_membre_exists($uid, $lid)){
        return new WP_Error('duplicate_member', '⚠️ Ce membre est déjà rattaché à ce laboratoire.', array('status'=>409));
    }

    // 🚫 Bloquer si l’utilisateur est directeur de labo
    if ($uid){
        $user = get_userdata($uid);
        if ($user && in_array('um_directeur_laboratoire', (array)$user->roles)){
            return new WP_Error(
                'forbidden_director',
                '⚠️ Un directeur de laboratoire ne peut pas être affecté comme membre.',
                array('status'=>403)
            );
        }
    }

    // Vérification si user déjà affecté à un autre labo
    if ($uid && $lid){
        $exists_other = $wpdb->get_var(
            $wpdb->prepare("SELECT laboratoire_id FROM $table WHERE user_id=%d AND laboratoire_id != %d", $uid, $lid)
        );
        if ($exists_other){
            return new WP_Error(
                'already_in_other_labo',
                '⚠️ Cet utilisateur est déjà affecté au laboratoire ID: '.$exists_other.'. Impossible de l’affecter à plusieurs laboratoires.',
                array('status'=>409)
            );
        }
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
  function svc_roles_normalize($role){
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

  $select = "m.*";
  $join   = "";

  if ($with_user){
    $select .= ", u.display_name AS user_display_name, u.user_email";
    $join   .= " LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID ";
  }

  // Grade & Spécialité
  $join .= "
    LEFT JOIN {$wpdb->usermeta} um_grade 
      ON (m.user_id = um_grade.user_id AND um_grade.meta_key = 'grade_id')
    LEFT JOIN {$wpdb->prefix}grade g 
      ON (CAST(um_grade.meta_value AS UNSIGNED) = g.id)
    LEFT JOIN {$wpdb->usermeta} um_spec 
      ON (m.user_id = um_spec.user_id AND um_spec.meta_key = 'specialite_id')
    LEFT JOIN {$wpdb->prefix}specialites s 
      ON (CAST(um_spec.meta_value AS UNSIGNED) = s.id)
  ";
  $select .= ", g.intitule AS grade, s.intitule AS specialite";

  // CV & état & photo & téléphone
  $join .= "
    LEFT JOIN {$wpdb->usermeta} um_cv 
      ON (m.user_id = um_cv.user_id AND um_cv.meta_key = 'cv_url')
    LEFT JOIN {$wpdb->usermeta} um_status 
      ON (m.user_id = um_status.user_id AND um_status.meta_key = 'account_status')
    LEFT JOIN {$wpdb->usermeta} um_photo
      ON (m.user_id = um_photo.user_id AND um_photo.meta_key = 'profile_photo')
    LEFT JOIN {$wpdb->usermeta} um_tel
      ON (m.user_id = um_tel.user_id AND um_tel.meta_key = 'tel')
  ";
  $select .= ",
    um_cv.meta_value AS cv_url,
    um_status.meta_value AS account_status,
    um_photo.meta_value AS profile_photo,
    um_tel.meta_value AS tel
  ";

  $sql = "SELECT $select FROM $table m $join WHERE m.id=%d LIMIT 1";
  $row = $wpdb->get_row($wpdb->prepare($sql, $id), ARRAY_A);

  if (!$row) {
    return new WP_Error('not_found','Membre introuvable', array('status'=>404));
  }

  // Fallback si profile_photo vide → Gravatar par défaut
/* if (empty($row['profile_photo']) && !empty($row['user_email'])) {
    $row['profile_photo'] = get_avatar_url($row['user_email']);
  }*/

  $row['profile_photo'] = get_user_meta($row['user_id'], 'avatar_url', true);

  return svc_membre_decode_out($row);
}


/*
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
    $pm_tab = $wpdb->prefix . 'recherche_projet_membre'; // (id, membre_id, projet_id, role_projet, created_at, updated_at)
    $p_tab  = $wpdb->prefix . 'recherche_projet';        // (id, titre, ...?)  <-- si différente, adaptez ici
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
      $instTable = $wpdb->prefix . 'master_instituts';
      $join     .= " LEFT JOIN {$wpdb->usermeta} um_inst ON (m.user_id = um_inst.user_id AND um_inst.meta_key = 'institut_id')
                    LEFT JOIN {$instTable} inst ON (CAST(um_inst.meta_value AS UNSIGNED) = inst.id) ";
      $select   .= ", CAST(um_inst.meta_value AS UNSIGNED) AS etablissement_id, inst.nom AS etablissement_nom";
    }

      // ---- Grade et Spécialité via usermeta ----
      $grade_table = $wpdb->prefix . 'grade';
      $spec_table  = $wpdb->prefix . 'specialites';

      $join .= "
        LEFT JOIN {$wpdb->usermeta} um_grade ON (m.user_id = um_grade.user_id AND um_grade.meta_key = 'grade_id')
        LEFT JOIN {$grade_table} g ON (CAST(um_grade.meta_value AS UNSIGNED) = g.id)
        LEFT JOIN {$wpdb->usermeta} um_spec ON (m.user_id = um_spec.user_id AND um_spec.meta_key = 'specialite_id')
        LEFT JOIN {$spec_table} s ON (CAST(um_spec.meta_value AS UNSIGNED) = s.id)
        LEFT JOIN {$wpdb->usermeta} um_status 
         ON (m.user_id = um_status.user_id AND um_status.meta_key = 'account_status')
      ";

      $select .= ",
        CAST(um_grade.meta_value AS UNSIGNED) AS grade_id, g.intitule AS grade,
        CAST(um_spec.meta_value AS UNSIGNED) AS specialite_id, s.intitule AS specialite,
        um_status.meta_value AS account_status

      ";

      // ---- Last activity = dernière connexion ----
      // suppose meta_key = 'last_login'
      $join .= "
        LEFT JOIN {$wpdb->usermeta} um_lastlogin ON (m.user_id = um_lastlogin.user_id AND um_lastlogin.meta_key = 'last_login')
      ";
      $select .= ", um_lastlogin.meta_value AS last_activity";


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
    //$rows = array_map('svc_membre_decode_out', $rows);

      // --- Répartition par spécialité ---
      $spec_table  = $wpdb->prefix . 'specialites';
      $sql_rep = "
        SELECT s.intitule AS specialite, COUNT(*) AS total
        FROM {$table} m
        LEFT JOIN {$wpdb->usermeta} um_spec 
          ON (m.user_id = um_spec.user_id AND um_spec.meta_key = 'specialite_id')
        LEFT JOIN {$spec_table} s 
          ON (CAST(um_spec.meta_value AS UNSIGNED) = s.id)
        WHERE 1=1
      ";

      $params_rep = [];
      if ($lid = $req->get_param('laboratoire_id')){
        $sql_rep .= " AND m.laboratoire_id = %d";
        $params_rep[] = intval($lid);
      }

      $sql_rep .= " GROUP BY s.intitule";

      $repartition = $wpdb->get_results($wpdb->prepare($sql_rep, ...$params_rep), ARRAY_A) ?: [];

      return [
        'data' => array_map('svc_membre_decode_out', $rows),
        'repartition_specialite' => $repartition
      ];
}
*/

function svc_membre_list(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_membre_table();

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $with_user = filter_var($req->get_param('with_user'), FILTER_VALIDATE_BOOLEAN);
  $with_etab = filter_var($req->get_param('with_etablissement'), FILTER_VALIDATE_BOOLEAN);
  $with_proj = filter_var($req->get_param('with_projects'), FILTER_VALIDATE_BOOLEAN);

  $need_user = $with_user || $req->get_param('search') || (($req->get_param('orderby') ?: '') === 'user');

  $pm_tab = $wpdb->prefix . 'recherche_projet_membre'; 
  $p_tab  = $wpdb->prefix . 'recherche_projet';        
  $has_pm = svc_table_exists($pm_tab);
  $has_p  = svc_table_exists($p_tab);

  $p_label = 'titre';
  if ($has_p && !svc_column_exists($p_tab, $p_label)) {
    $p_label = svc_column_exists($p_tab,'title') ? 'title' : (svc_column_exists($p_tab,'nom') ? 'nom' : null);
  }

  $select = "m.*";
  $join   = "";
  $where  = array();
  $params = array();

  if ($need_user){
    $select .= ", u.display_name AS user_display_name, u.user_email, u.ID as user_id";
    $join   .= " LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID ";
  }

  if ($with_etab){
    $instTable = $wpdb->prefix . 'master_instituts';
    $join     .= " LEFT JOIN {$wpdb->usermeta} um_inst ON (m.user_id = um_inst.user_id AND um_inst.meta_key = 'institut_id')
                  LEFT JOIN {$instTable} inst ON (CAST(um_inst.meta_value AS UNSIGNED) = inst.id) ";
    $select   .= ", CAST(um_inst.meta_value AS UNSIGNED) AS etablissement_id, inst.nom AS etablissement_nom";
  }

  // ---- Grade et Spécialité via usermeta ----
  $grade_table = $wpdb->prefix . 'grade';
  $spec_table  = $wpdb->prefix . 'specialites';

  $join .= "
    LEFT JOIN {$wpdb->usermeta} um_grade ON (m.user_id = um_grade.user_id AND um_grade.meta_key = 'grade_id')
    LEFT JOIN {$grade_table} g ON (CAST(um_grade.meta_value AS UNSIGNED) = g.id)
    LEFT JOIN {$wpdb->usermeta} um_spec ON (m.user_id = um_spec.user_id AND um_spec.meta_key = 'specialite_id')
    LEFT JOIN {$spec_table} s ON (CAST(um_spec.meta_value AS UNSIGNED) = s.id)
    LEFT JOIN {$wpdb->usermeta} um_status 
      ON (m.user_id = um_status.user_id AND um_status.meta_key = 'account_status')
  ";

  $select .= ",
    CAST(um_grade.meta_value AS UNSIGNED) AS grade_id, g.intitule AS grade,
    CAST(um_spec.meta_value AS UNSIGNED) AS specialite_id, s.intitule AS specialite,
    um_status.meta_value AS account_status
  ";

  $join .= "
    LEFT JOIN {$wpdb->usermeta} um_lastlogin ON (m.user_id = um_lastlogin.user_id AND um_lastlogin.meta_key = 'last_login')
  ";
  $select .= ", um_lastlogin.meta_value AS last_activity";

  // ------- Projets liés -------
  if ($with_proj && $has_pm){
    if ($has_p && $p_label){
      $agg = "SELECT pm.membre_id,
                    GROUP_CONCAT(DISTINCT p.`{$p_label}` ORDER BY p.`{$p_label}` SEPARATOR ', ') AS projets_lies,
                    MAX(pm.updated_at) AS last_proj_update
              FROM {$pm_tab} pm
              LEFT JOIN {$p_tab} p ON p.id = pm.projet_id
              GROUP BY pm.membre_id";
    } else {
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
    $select .= ", m.updated_at AS last_activity";
  }

  // ------- Filtres -------
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
    'last_activity' => 'last_activity',
  );
  $orderby = isset($obMap[$obParam]) ? $obMap[$obParam] : 'm.id';

  $sql = "SELECT {$select} FROM {$table} m {$join} {$wsql} ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d";
  $params[] = $per; $params[] = $off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: array();

  // 🔹 Ajout de l’avatar pour chaque user
  foreach ($rows as &$row){
    if (!empty($row['user_id'])){
      $row['avatar_url'] = get_user_meta($row['user_id'], 'avatar_url', true);
    } else {
      $row['avatar_url'] = null;
    }
  }

  // --- Répartition par spécialité ---
  $spec_table  = $wpdb->prefix . 'specialites';
  $sql_rep = "
    SELECT s.intitule AS specialite, COUNT(*) AS total
    FROM {$table} m
    LEFT JOIN {$wpdb->usermeta} um_spec 
      ON (m.user_id = um_spec.user_id AND um_spec.meta_key = 'specialite_id')
    LEFT JOIN {$spec_table} s 
      ON (CAST(um_spec.meta_value AS UNSIGNED) = s.id)
    WHERE 1=1
  ";

  $params_rep = [];
  if ($lid = $req->get_param('laboratoire_id')){
    $sql_rep .= " AND m.laboratoire_id = %d";
    $params_rep[] = intval($lid);
  }

  $sql_rep .= " GROUP BY s.intitule";

  $repartition = $wpdb->get_results($wpdb->prepare($sql_rep, ...$params_rep), ARRAY_A) ?: [];

  return [
    'data' => array_map('svc_membre_decode_out', $rows),
    'repartition_specialite' => $repartition
  ];
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
    global $wpdb; 
    $table = svc_document_table();

    $page  = max(1, intval($req->get_param('page') ?: 1));
    $per   = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
    $off   = ($page - 1) * $per;

    $user   = wp_get_current_user();
    $roles  = $user->roles;
    $user_id = get_current_user_id();

    // Cas 1 : Admin ou Service UTM → tous les documents
    if (in_array('administrator', $roles) || in_array('um_service_utm', $roles)) {
        $sql = $wpdb->prepare(
            "SELECT d.*, u.display_name AS chercheur_nom
             FROM $table d
             LEFT JOIN {$wpdb->users} u ON d.chercheur_id = u.ID
             ORDER BY d.id DESC
             LIMIT %d OFFSET %d",
            $per, $off
        );
    }

    // Cas 2 : Directeur de labo → documents des membres + lui-même
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id = %d",
            $user_id
        ));
        
        if ($lab_id) {
            $sql = $wpdb->prepare(
                "SELECT DISTINCT d.*, u.display_name AS chercheur_nom
                 FROM $table d
                 LEFT JOIN {$wpdb->users} u ON d.chercheur_id = u.ID

                 -- Jointure via directeur
                 LEFT JOIN {$wpdb->prefix}recherche_laboratoire l1 
                    ON d.chercheur_id = l1.directeur_user_id
                 
                 -- Jointure via membre
                 LEFT JOIN {$wpdb->prefix}recherche_membre m 
                    ON d.chercheur_id = m.user_id
                 LEFT JOIN {$wpdb->prefix}recherche_laboratoire l2 
                    ON l2.id = m.laboratoire_id

                 WHERE (l1.id = %d OR l2.id = %d OR d.chercheur_id = %d)
                 ORDER BY d.id DESC
                 LIMIT %d OFFSET %d",
                $lab_id, $lab_id, $user_id, $per, $off
            );
        }
    }

    // Cas 3 : Chercheur → ses documents + ceux de son labo (directeur inclus)
    elseif (in_array('um_chercheur', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $sql = $wpdb->prepare(
                "SELECT d.*, u.display_name AS chercheur_nom
                 FROM $table d
                 LEFT JOIN {$wpdb->users} u ON d.chercheur_id = u.ID
                 WHERE d.chercheur_id = %d
                    OR d.chercheur_id IN (
                        SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                    )
                    OR d.chercheur_id IN (
                        SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d
                    )
                 ORDER BY d.id DESC
                 LIMIT %d OFFSET %d",
                $user_id, $lab_id, $lab_id, $per, $off
            );
        } else {
            // fallback = seulement ses documents
            $sql = $wpdb->prepare(
                "SELECT d.*, u.display_name AS chercheur_nom
                 FROM $table d
                 LEFT JOIN {$wpdb->users} u ON d.chercheur_id = u.ID
                 WHERE d.chercheur_id = %d
                 ORDER BY d.id DESC
                 LIMIT %d OFFSET %d",
                $user_id, $per, $off
            );
        }
    }

    // Cas 4 : Autres → seulement leurs documents
    else {
        $sql = $wpdb->prepare(
            "SELECT d.*, u.display_name AS chercheur_nom
             FROM $table d
             LEFT JOIN {$wpdb->users} u ON d.chercheur_id = u.ID
             WHERE d.chercheur_id = %d
             ORDER BY d.id DESC
             LIMIT %d OFFSET %d",
            $user_id, $per, $off
        );
    }

    return isset($sql) ? $wpdb->get_results($sql, ARRAY_A) : [];
}



/*
  function svc_document_get(WP_REST_Request $req){
    global $wpdb; $table = svc_document_table(); $id = intval($req['id']);
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
    if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
    return $row;
  }
    */

  
/*
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
*/


function svc_document_create(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_document_table(); 
  $allowed = svc_document_allowed();

  $data = $req->get_params();
  $ins = [];

  foreach ($allowed as $k){
    if(isset($data[$k])){
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }

  // Upload fichier s'il existe
  if (!empty($_FILES['fichier']['name'])) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attach_id = media_handle_upload('fichier', 0);
    if (is_wp_error($attach_id)) {
      return new WP_Error('upload_error', 'Échec upload fichier', ['status'=>500]);
    }
    $ins['fichier_path'] = wp_get_attachment_url($attach_id);
  }

  if (empty($ins['chercheur_id'])) {
    $ins['chercheur_id'] = get_current_user_id();
  }

  $ok = $wpdb->insert($table, $ins);
  if (!$ok) return new WP_Error('db_error','Insert failed',['status'=>500]);

  $id = $wpdb->insert_id;
  return ['id'=>$id] + $ins;
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

function svc_is_directeur(){
  $u = wp_get_current_user(); return in_array('um_directeur_laboratoire', (array)$u->roles, true);
}
function svc_is_chercheur(){
  $u = wp_get_current_user(); return in_array('um_chercheur', (array)$u->roles, true);
}
function svc_directeur_lab_id($user_id){
  global $wpdb;
  $t_lab = $wpdb->prefix . 'recherche_laboratoire';
  return (int) $wpdb->get_var( $wpdb->prepare("SELECT id FROM {$t_lab} WHERE directeur_user_id=%d", $user_id) );
}
function svc_user_lab_id($user_id){
  global $wpdb;
  $t_mem = $wpdb->prefix . 'recherche_membre';
  return (int) $wpdb->get_var( $wpdb->prepare("SELECT laboratoire_id FROM {$t_mem} WHERE user_id=%d", $user_id) );
}


  // === manifestation ===
  function svc_manifestation_table(){ global $wpdb; return $wpdb->prefix . 'recherche_manifestation'; }

  function svc_manifestation_list(WP_REST_Request $req){
    global $wpdb; 
    $table = svc_manifestation_table(); // utm_recherche_manifestation
    $tc    = svc_manifestation_categorie_table(); // utm_recherche_manifestation_categorie

    $page = max(1, intval($req->get_param('page') ?: 1));
    $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
    $off  = ($page - 1) * $per;

    $sql  = $wpdb->prepare("
        SELECT m.*,
               c.nom AS categorie
        FROM $table m
        LEFT JOIN $tc c ON m.categorie_id = c.id
        ORDER BY m.id DESC
        LIMIT %d OFFSET %d
    ", $per, $off);

    return $wpdb->get_results($sql, ARRAY_A);
}


  function svc_manifestation_get(WP_REST_Request $req){
    global $wpdb; $table = svc_manifestation_table(); $id = intval($req['id']);
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
    if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
    return $row;
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
  function svc_projet_allowed(){ return array('date_debut', 'titre', 'type_projet_id', 'budget', 'chercheur_id', 'date_fin', 'resume', 'statut', 'type_financement','objectifs'); }

function svc_projet_list(WP_REST_Request $req){
    global $wpdb; 
    $table = svc_projet_table();
    $page  = max(1, intval($req->get_param('page') ?: 1));
    $per   = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
    $off   = ($page - 1) * $per;

    $user   = wp_get_current_user();
    $roles  = $user->roles;
    $user_id = get_current_user_id();

    // Cas 1 : Admin ou Service UTM → tous les projets
    if (in_array('administrator', $roles) || in_array('um_service_utm', $roles)) {
        $sql = $wpdb->prepare(
            "SELECT p.*, u.display_name AS chercheur_nom
             FROM $table p
             LEFT JOIN {$wpdb->users} u ON p.chercheur_id = u.ID
             ORDER BY p.id DESC
             LIMIT %d OFFSET %d",
            $per, $off
        );
    }

    // Cas 2 : Directeur de thèse → projets des membres de son labo
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id = %d",
            $user_id
        ));
        
       if ($lab_id) {
          $sql = $wpdb->prepare(
              "SELECT DISTINCT p.*, u.display_name AS chercheur_nom
              FROM $table p
              LEFT JOIN {$wpdb->users} u ON p.chercheur_id = u.ID
              
              -- Jointure via directeur
              LEFT JOIN {$wpdb->prefix}recherche_laboratoire l1 
                  ON p.chercheur_id = l1.directeur_user_id
              
              -- Jointure via membre
              LEFT JOIN {$wpdb->prefix}recherche_membre m 
                  ON p.chercheur_id = m.user_id
              LEFT JOIN {$wpdb->prefix}recherche_laboratoire l2 
                  ON l2.id = m.laboratoire_id
              
              WHERE (l1.id = %d OR l2.id = %d OR p.chercheur_id = %d)
              ORDER BY p.id DESC
              LIMIT %d OFFSET %d",
              $lab_id, $lab_id, $user_id, $per, $off
          );
      }


      
    }

    // Cas 3 : Chercheur → ses projets + ceux de son labo
    elseif (in_array('um_chercheur', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $sql = $wpdb->prepare(
                "SELECT p.*, u.display_name AS chercheur_nom
                 FROM $table p
                 LEFT JOIN {$wpdb->users} u ON p.chercheur_id = u.ID
                 WHERE p.chercheur_id = %d
                    OR p.chercheur_id IN (
                        SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                    )
                    OR p.chercheur_id IN (
                        SELECT directeur_user_id  FROM utm_recherche_laboratoire WHERE id = %d
                    )
                 ORDER BY p.id DESC
                 LIMIT %d OFFSET %d",
                $user_id, $lab_id,$lab_id, $per, $off
            );

          
        } else {
            // fallback = seulement ses projets
            $sql = $wpdb->prepare(
                "SELECT p.*, u.display_name AS chercheur_nom
                 FROM $table p
                 LEFT JOIN {$wpdb->users} u ON p.chercheur_id = u.ID
                 WHERE p.chercheur_id = %d
                 ORDER BY p.id DESC
                 LIMIT %d OFFSET %d",
                $user_id, $per, $off
            );
        }
    }

    // Cas 4 : Autres → ses propres projets
    else {
        $sql = $wpdb->prepare(
            "SELECT p.*, u.display_name AS chercheur_nom
             FROM $table p
             LEFT JOIN {$wpdb->users} u ON p.chercheur_id = u.ID
             WHERE p.chercheur_id = %d
             ORDER BY p.id DESC
             LIMIT %d OFFSET %d",
            $user_id, $per, $off
        );
    }



    return isset($sql) ? $wpdb->get_results($sql, ARRAY_A) : [];
}


  function svc_projet_get(WP_REST_Request $req){
    global $wpdb; $table = svc_projet_table(); $id = intval($req['id']);
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
    if(!$row) return new WP_Error('not_found','Not found',array('status'=>404));
    return $row;
  }

  /*
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
  */

function svc_projet_handle_file($file, $prefix = '') {
    if (empty($file['name'])) return null;

    $upload_dir = WP_CONTENT_DIR . '/recherche/projet/';
    if (!file_exists($upload_dir)) {
        wp_mkdir_p($upload_dir);
    }

    // sécuriser le nom
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safe_name = sanitize_file_name(($prefix ?: 'file') . '-' . time() . '.' . $ext);

    $target = $upload_dir . $safe_name;
    if (move_uploaded_file($file['tmp_name'], $target)) {
        // Retourne chemin relatif (ou URL complète)
        return '/wp-content/recherche/projet/' . $safe_name;
    }
    return null;
}
/*
function svc_projet_create(WP_REST_Request $req) {
    global $wpdb; 
    $table   = svc_projet_table(); 
    $allowed = svc_projet_allowed();
    $data    = svc_read_input($req);
    $ins     = [];

    foreach ($allowed as $k){
        if(isset($data[$k])){
            $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
            $ins[$k] = $v;
        }
    }

    // --- gestion upload fichiers ---
    if (!empty($_FILES['budget_piece'])) {
        $path = svc_projet_handle_file($_FILES['budget_piece'], 'budget');
        if ($path) $ins['budget_piece'] = $path;
    }
    if (!empty($_FILES['convention_piece'])) {
        $path = svc_projet_handle_file($_FILES['convention_piece'], 'convention');
        if ($path) $ins['convention_piece'] = $path;
    }

    if (empty($ins)) 
        return new WP_Error('bad_request','No valid fields',['status'=>400]);

    $ok = $wpdb->insert($table, $ins);
    if (!$ok) return new WP_Error('db_error','Insert failed',['status'=>500]);

    $id = $wpdb->insert_id;
    return ['id'=>$id] + $ins;
}
    */
function svc_projet_create(WP_REST_Request $req) {
    global $wpdb; 
    $table   = svc_projet_table(); 
    $allowed = svc_projet_allowed();
    $data    = svc_read_input($req);
    $ins     = [];

    foreach ($allowed as $k) {
        if (isset($data[$k])) {
            $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
            $ins[$k] = $v;
        }
    }

    // 🔹 Ajout automatique du chercheur connecté
    $user_id = get_current_user_id();
    if ($user_id) {
        $ins['chercheur_id'] = intval($user_id);
    }

    // --- gestion upload fichiers ---
    if (!empty($_FILES['budget_piece'])) {
        $path = svc_projet_handle_file($_FILES['budget_piece'], 'budget');
        if ($path) $ins['budget_piece'] = $path;
    }
    if (!empty($_FILES['convention_piece'])) {
        $path = svc_projet_handle_file($_FILES['convention_piece'], 'convention');
        if ($path) $ins['convention_piece'] = $path;
    }

    if (empty($ins)) {
        return new WP_Error('bad_request','No valid fields',['status'=>400]);
    }

    $ok = $wpdb->insert($table, $ins);
    if (!$ok) {
        return new WP_Error('db_error','Insert failed',['status'=>500]);
    }

    $id = $wpdb->insert_id;
    return ['id'=>$id] + $ins;
}


function svc_projet_update(WP_REST_Request $req){
    global $wpdb; 
    $table   = svc_projet_table(); 
    $allowed = svc_projet_allowed();
    $id      = intval($req['id']); 
    $data    = svc_read_input($req);
    $upd     = [];

    foreach ($allowed as $k){
        if(array_key_exists($k,$data)){
            $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
            $upd[$k] = $v;
        }
    }

    // --- upload fichiers ---
    if (!empty($_FILES['budget_piece'])) {
        $path = svc_projet_handle_file($_FILES['budget_piece'], 'budget');
        if ($path) $upd['budget_piece'] = $path;
    }
    if (!empty($_FILES['convention_piece'])) {
        $path = svc_projet_handle_file($_FILES['convention_piece'], 'convention');
        if ($path) $upd['convention_piece'] = $path;
    }

    if (empty($upd)) 
        return new WP_Error('bad_request','No valid fields',['status'=>400]);

    $ok = $wpdb->update($table, $upd, ['id'=>$id]);
    if ($ok === false) return new WP_Error('db_error','Update failed',['status'=>500]);

    return ['id'=>$id] + $upd;
}

  function svc_projet_delete(WP_REST_Request $req){
    global $wpdb; $table = svc_projet_table(); $id = intval($req['id']);
    $ok = $wpdb->delete($table, array('id'=>$id)); if(!$ok) return new WP_Error('db_error','Delete failed',array('status'=>500));
    return new WP_REST_Response(null, 204);
  }

function svc_projet_stats(WP_REST_Request $req){
    global $wpdb; 
    $table = svc_projet_table();
    $user   = wp_get_current_user();
    $roles  = $user->roles;
    $user_id = get_current_user_id();

    $total = 0;
    $financement = 0;
    $repartition = [];

    // Cas 1 : Admin ou Service UTM → toutes les stats
    if (in_array('administrator', $roles) || in_array('um_service_utm', $roles)) {
        $total       = $wpdb->get_var("SELECT COUNT(*) FROM $table");
        $financement = $wpdb->get_var("SELECT SUM(budget) FROM $table");
        $repartition = $wpdb->get_results("SELECT statut, COUNT(*) as nb FROM $table GROUP BY statut", ARRAY_A);
    }

    // Cas 2 : Directeur de laboratoire → stats des projets des membres de son labo
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $total = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) 
                 FROM $table p
                 LEFT JOIN {$wpdb->prefix}recherche_membre m ON p.chercheur_id = m.user_id
                 WHERE m.laboratoire_id = %d OR p.chercheur_id = %d",
                $lab_id, $user_id
            ));
            $financement = $wpdb->get_var($wpdb->prepare(
                "SELECT SUM(budget) 
                 FROM $table p
                 LEFT JOIN {$wpdb->prefix}recherche_membre m ON p.chercheur_id = m.user_id
                 WHERE m.laboratoire_id = %d OR p.chercheur_id = %d",
                $lab_id, $user_id
            ));
            $repartition = $wpdb->get_results($wpdb->prepare(
                "SELECT p.statut, COUNT(*) as nb 
                 FROM $table p
                 LEFT JOIN {$wpdb->prefix}recherche_membre m ON p.chercheur_id = m.user_id
                 WHERE m.laboratoire_id = %d OR p.chercheur_id = %d
                 GROUP BY p.statut",
                $lab_id, $user_id
            ), ARRAY_A);
        }
    }

    // Cas 3 : Chercheur → ses projets + ceux de son labo + ceux de son directeur
    elseif (in_array('um_chercheur', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $total = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) 
                 FROM $table p
                 WHERE p.chercheur_id = %d
                    OR p.chercheur_id IN (SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d)
                    OR p.chercheur_id IN (SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d)",
                $user_id, $lab_id, $lab_id
            ));
            $financement = $wpdb->get_var($wpdb->prepare(
                "SELECT SUM(budget) 
                 FROM $table p
                 WHERE p.chercheur_id = %d
                    OR p.chercheur_id IN (SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d)
                    OR p.chercheur_id IN (SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d)",
                $user_id, $lab_id, $lab_id
            ));
            $repartition = $wpdb->get_results($wpdb->prepare(
                "SELECT p.statut, COUNT(*) as nb 
                 FROM $table p
                 WHERE p.chercheur_id = %d
                    OR p.chercheur_id IN (SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d)
                    OR p.chercheur_id IN (SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d)
                 GROUP BY p.statut",
                $user_id, $lab_id, $lab_id
            ), ARRAY_A);
        } else {
            // fallback = seulement ses projets
            $total = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM $table WHERE chercheur_id = %d", $user_id
            ));
            $financement = $wpdb->get_var($wpdb->prepare(
                "SELECT SUM(budget) FROM $table WHERE chercheur_id = %d", $user_id
            ));
            $repartition = $wpdb->get_results($wpdb->prepare(
                "SELECT statut, COUNT(*) as nb FROM $table WHERE chercheur_id = %d GROUP BY statut",
                $user_id
            ), ARRAY_A);
        }
    }

    // Cas 4 : Autres → seulement ses projets
    else {
        $total = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE chercheur_id = %d", $user_id
        ));
        $financement = $wpdb->get_var($wpdb->prepare(
            "SELECT SUM(budget) FROM $table WHERE chercheur_id = %d", $user_id
        ));
        $repartition = $wpdb->get_results($wpdb->prepare(
            "SELECT statut, COUNT(*) as nb FROM $table WHERE chercheur_id = %d GROUP BY statut",
            $user_id
        ), ARRAY_A);
    }

    return array(
        'total'       => intval($total),
        'financement' => floatval($financement),
        'repartition' => $repartition
    );
}



// === source_financement ===
function svc_source_financement_table(){ 
    global $wpdb; 
    return $wpdb->prefix . 'recherche_source_financement'; 
}

/**
 * Liste des sources de financement actives
 */
function svc_source_financement_list(WP_REST_Request $req){
    global $wpdb; 
    $table = svc_source_financement_table();

    $sql = "SELECT id, code, intitule, intitule_ar, type 
            FROM $table 
            WHERE actif=1 
            ORDER BY intitule ASC";
    return $wpdb->get_results($sql, ARRAY_A);
}

// === type_projet ===
function svc_type_projet_table(){ 
    global $wpdb; 
    return $wpdb->prefix . 'recherche_type_projet'; // table : utm_recherche_type_projet
}

/**
 * Liste des types de projets actifs
 */
function svc_type_projet_list(WP_REST_Request $req){
    global $wpdb; 
    $table = svc_type_projet_table();

    $sql = "SELECT id, code, intitule, intitule_ar 
            FROM $table 
            WHERE actif=1 
            ORDER BY intitule ASC";
    return $wpdb->get_results($sql, ARRAY_A);
}




// ======= projet_membre ===
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

  // ---------- Helpers schéma DB (si déjà définis, laisser tels quels) ----------
  if (!function_exists('svc_table_exists')) {
    function svc_table_exists($table){ global $wpdb;
      return (bool)$wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table));
    }
  }
  if (!function_exists('svc_column_exists')) {
    function svc_column_exists($table, $col){ global $wpdb;
      $c = $wpdb->get_var($wpdb->prepare("SHOW COLUMNS FROM {$table} LIKE %s", $col));
      return !empty($c);
    }
  }
  if (!function_exists('svc_table_columns')) {
    function svc_table_columns($table){ global $wpdb; static $cache = array();
      if (isset($cache[$table])) return $cache[$table];
      $rows = $wpdb->get_results("SHOW COLUMNS FROM {$table}", ARRAY_A) ?: array();
      $cache[$table] = array_map(fn($r)=>$r['Field'], $rows);
      return $cache[$table];
    }
  }

  // Trouver la table référencée par chercheur_id (ancienne ou nouvelle)
  if ( ! function_exists('svc_find_chercheur_table') ) {
    function svc_find_chercheur_table(){
      global $wpdb;
      foreach (array($wpdb->prefix.'rechercheold_chercheur', $wpdb->prefix.'recherche_chercheur') as $t){
        $ok = $wpdb->get_var( $wpdb->prepare("SHOW TABLES LIKE %s",$t) );
        if ($ok && $wpdb->get_var("SHOW COLUMNS FROM {$t} LIKE 'id'")) return $t;
      }
      return null;
    }
  }
function svc_find_chercheur_table() {
    global $wpdb;
    return $wpdb->prefix . 'recherche_membre';
}
function svc_map_current_user_to_chercheur_id() {
    $uid = get_current_user_id();
    if (!$uid) {
        error_log('[svc_map_current_user_to_chercheur_id] Aucun utilisateur connecté');
        return null;
    }
    global $wpdb;

    $t = svc_find_chercheur_table();
    if (!$t) {
        error_log('[svc_map_current_user_to_chercheur_id] Table des chercheurs introuvable');
        return null;
    }
    error_log('[svc_map_current_user_to_chercheur_id] Table utilisée : ' . $t);

    $cid = (int)$wpdb->get_var($wpdb->prepare("SELECT id FROM {$t} WHERE user_id=%d LIMIT 1", $uid));
    if ($cid) {
        error_log('[svc_map_current_user_to_chercheur_id] Chercheur ID trouvé via user_id: ' . $cid);
        return $cid;
    }

    error_log('[svc_map_current_user_to_chercheur_id] Aucun chercheur_id trouvé pour user_id: ' . $uid);
    return null;
}












  // === reunion ===
  function svc_reunion_table(){ global $wpdb; return $wpdb->prefix . 'recherche_reunion'; }
if (!defined('ABSPATH')) exit;

/** Helpers existants supposés:
 * - svc_reseaux_table()
 * - svc_reseaux_projets_table()
 * - svc_laboratoire_table()
 * - svc_current_labo_id()
 * - svc_reseaux_args_create() / svc_reseaux_args_update()
 * - svc_column_exists($table, $col)   // déjà utilisé côté publications
 */

// === (A) Champs autorisés & formats ===
function svc_reseaux_allowed(){
  // clef => [format, required?]   formats: int|date|bool|text|email|url
  return [
    'institution'       => ['text', true],
    'pays'              => ['text', true],
    'type_collab'       => ['text', true],     // tu l’utilises comme “Domaine” dans le front
    'contact_nom'       => ['text', true],
    'contact_email'     => ['email', true],
    'contact_tel'       => ['text', false],
    'site_web'          => ['url',  false],
    'adresse_org'       => ['text', false],

    'date_debut'        => ['date', true],     // YYYY-MM-DD
    'date_fin'          => ['date', false],
    'convention_signee' => ['bool', false],
    'statut'            => ['text', false],    // optionnel

    // médias (URLs) si tes colonnes existent
    'logo_url'          => ['url',  false],
    'avatar_url'        => ['url',  false],

    // méta éventuelle
    'notes'             => ['text', false],
  ];
}
function svc_reseaux_fmt($fmt){
  switch($fmt){
    case 'int':  return '%d';
    case 'bool': return '%d';
    default:     return '%s';
  }
}
function svc_reseaux_sanitize($fmt, $val){
  if ($val === null) return null;
  switch ($fmt){
    case 'int':  return is_numeric($val) ? intval($val) : null;
    case 'bool': return $val ? 1 : 0;
    case 'date': return (is_string($val) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$val)) ? $val : null;
    case 'email':return is_email($val) ? sanitize_email($val) : null;
    case 'url':  return is_string($val) ? esc_url_raw($val) : null;
    default:     return is_scalar($val) ? sanitize_text_field($val) : wp_json_encode($val, JSON_UNESCAPED_UNICODE);
  }
}

// === (B) Portée labo (membre/directeur) ===
function svc_my_lab_ids(){
  global $wpdb;
  $uid = get_current_user_id();
  if (!$uid) return [];
  $lab_ids = [];
  if (class_exists('UTM_Publication_Service')) {
    $you = UTM_Publication_Service::get_current_memberships(); // ['member_ids'=>[], 'lab_ids'=>[]]
    $lab_ids = $you['lab_ids'] ?: [];
  } else {
    // fallback: labos dirigés + labos où je suis membre
    $lt = svc_laboratoire_table();
    $mt = $wpdb->prefix.'recherche_membre';
    $dir = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lt} WHERE directeur_user_id=%d",$uid)) ?: [];
    $mem = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$mt} WHERE user_id=%d",$uid)) ?: [];
    $lab_ids = array_values(array_unique(array_merge($dir,$mem)));
  }
  return array_map('intval',$lab_ids);
}
function svc_is_director(){
  if (class_exists('UTM_Publication_Service')) return UTM_Publication_Service::is_director();
  $u = wp_get_current_user();
  return in_array('um_directeur_laboratoire', (array)$u->roles, true);
}

// === (C) Fetch-guard: vérifie l’appartenance labo d’une ligne ===
function svc_reseaux_fetch_owned($id){
  global $wpdb;
  $t  = svc_reseaux_table();
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d",$id), ARRAY_A);
  if (!$row) return [null, null];

  $myLabs = svc_my_lab_ids();

  // Cas 1: colonne laboratoire_id présente
  if (svc_column_exists($t,'laboratoire_id') && isset($row['laboratoire_id'])){
    return in_array((int)$row['laboratoire_id'], $myLabs, true) ? [$row, (int)$row['laboratoire_id']] : [null,null];
  }

  // Cas 2: pas de colonne labo -> on autorise si je suis directeur (plus permissif) OU si je suis l’auteur
  if (svc_column_exists($t,'created_by') && (int)$row['created_by'] === get_current_user_id()) return [$row, null];
  if (svc_is_director()) return [$row, null];

  return [null,null];
}

// === (D) Routes REST ===
add_action('rest_api_init', function(){
  register_rest_route('plateforme-recherche/v1','/reseaux',[
    [
      'methods'  => 'GET',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'callback' => 'svc_reseaux_list',
    ],
    [
      'methods'  => 'POST',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'callback' => 'svc_reseaux_create',
    ],
  ]);
  register_rest_route('plateforme-recherche/v1','/reseaux/(?P<id>\d+)',[
    [
      'methods'  => 'GET',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'callback' => 'svc_reseaux_get',
    ],
    [
      'methods'  => 'PUT, PATCH',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'callback' => 'svc_reseaux_update',
    ],
    [
      'methods'  => 'DELETE',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'callback' => 'svc_reseaux_delete',
    ],
  ]);
});

// === (E) Handlers ===
function svc_reseaux_get(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_reseaux_table();
  $id = absint($req['id']);

  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
  if (!$row) return new WP_Error('not_found','Réseau introuvable', ['status'=>404]);

  // Decode IDs
  $ids = $row['projets_associes'] ? json_decode($row['projets_associes'], true) : [];

  if (!empty($ids)) {
    $in = implode(',', array_map('absint', $ids));
    $tableProj = $wpdb->prefix.'recherche_projet';
    $row['projets_associes'] = $wpdb->get_results("SELECT id, titre FROM $tableProj WHERE id IN ($in)", ARRAY_A);
  } else {
    $row['projets_associes'] = [];
  }

  $row['convention_signee'] = (int)$row['convention_signee'];
  return $row;
}



function svc_reseaux_list(WP_REST_Request $req){
  global $wpdb; $t = svc_reseaux_table();

  $page = max(1, (int)($req->get_param('page') ?: 1));
  $per  = max(1, min(200, (int)($req->get_param('per_page') ?: 50)));
  $off  = ($page - 1) * $per;

  $q    = trim((string)$req->get_param('search'));

  $where=[]; $params=[];

  // Restreindre au périmètre labo (chercheurs & directeurs du/ des labos)
  $myLabs = svc_my_lab_ids();
  if (svc_column_exists($t,'laboratoire_id') && !empty($myLabs)){
    $where[] = "laboratoire_id IN (" . implode(',', array_map('intval',$myLabs)) . ")";
  } else {
    // fallback si pas de colonne: laisser tout le monde voir ses propres entrées
    if (svc_column_exists($t,'created_by')) { $where[] = "created_by = %d"; $params[] = get_current_user_id(); }
  }

  // Recherche texte
  if ($q!==''){
    $like = '%'.$wpdb->esc_like($q).'%';
    $where[]="(institution LIKE %s OR type_collab LIKE %s OR contact_nom LIKE %s OR contact_email LIKE %s)";
    array_push($params,$like,$like,$like,$like);
  }

  $wsql = $where ? 'WHERE '.implode(' AND ',$where) : '';

  $sql = "SELECT * FROM {$t} {$wsql} ORDER BY id DESC LIMIT %d OFFSET %d";
  $params[]=$per; $params[]=$off;

  $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: [];
  return $rows;
}

function svc_reseaux_create(WP_REST_Request $req){
  global $wpdb;
  $table = svc_reseaux_table();

  $labo_id = (int) ($req['laboratoire_id'] ?: svc_current_labo_id());
  if (!$labo_id) return new WP_Error('no_labo', 'Laboratoire introuvable', array('status'=>403));

  // Upload si présent
  $upload_info = reseaux_store_file_from_upload('piece_jointe');
  if (is_wp_error($upload_info)) return $upload_info; // erreur upload

  $ins = array(
    'laboratoire_id'    => $labo_id,
    'institution'       => sanitize_text_field($req['institution']),
    'pays'              => sanitize_text_field($req['pays']),
    'type_collab'       => sanitize_text_field($req['type_collab']),
    'contact_nom'       => sanitize_text_field($req['contact_nom']),
    'contact_email'     => sanitize_email($req['contact_email']),
    'date_debut'        => sanitize_text_field($req['date_debut']),
    'date_fin'          => $req['date_fin'] ? sanitize_text_field($req['date_fin']) : null,
    'convention_signee' => absint($req['convention_signee']),
    'statut'            => $req['statut'] ? sanitize_text_field($req['statut']) : 'Actif',
    'piece_jointe_id'   => $req['piece_jointe_id'] ? absint($req['piece_jointe_id']) : null,
    'projets_associes'  => !empty($req['projets_associes']) ? wp_json_encode(array_map('absint',(array)$req['projets_associes'])) : null,
    'created_by'        => get_current_user_id(),
    'created_at'        => current_time('mysql'),
    // 🔹 Ajouts
    'site_web'          => $req['site_web'] ? esc_url_raw($req['site_web']) : null,
    'adresse_org'       => $req['adresse_org'] ? sanitize_text_field($req['adresse_org']) : null,
  );
  if ($upload_info && is_array($upload_info)) {
    // si tu as ajouté la colonne
    $ins['piece_jointe_path'] = sanitize_text_field($upload_info['path']);
  }

  $ok = $wpdb->insert($table, $ins);
  if (!$ok) return new WP_Error('db_error','Insert failed',array('status'=>500));
  $id = (int) $wpdb->insert_id;

  $r  = new WP_REST_Request('GET', "/");
  $r->set_url_params(['id'=>$id]);
  return svc_reseaux_get($r);
}


function svc_reseaux_update(WP_REST_Request $req){
  global $wpdb; $table = svc_reseaux_table();
  $id = absint($req['id']);
  if (!$id) return new WP_Error('bad_id','ID manquant', ['status'=>400]);

  // Support override (si tu envoies POST + X-HTTP-Method-Override: PATCH)
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method === 'POST') {
    $override = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) : '';
    if (!in_array($override, array('PATCH','PUT',''), true)) {
      return new WP_Error('bad_method','Méthode invalide', ['status'=>405]);
    }
  }

  $data = array();
  foreach (['institution','pays','type_collab','contact_nom','contact_email','date_debut','date_fin','statut'] as $k) {
    if (isset($req[$k])) $data[$k] = ($k==='contact_email')? sanitize_email($req[$k]) : sanitize_text_field($req[$k]);
  }

  if (isset($req['site_web']))    $data['site_web']    = esc_url_raw($req['site_web']);
if (isset($req['adresse_org'])) $data['adresse_org'] = sanitize_text_field($req['adresse_org']);

  if (isset($req['convention_signee'])) $data['convention_signee'] = absint($req['convention_signee']);
  if (isset($req['projets_associes']))  $data['projets_associes'] = wp_json_encode(array_map('absint',(array)$req['projets_associes']));

  // Upload si présent
  if (!empty($_FILES['piece_jointe']) && is_uploaded_file($_FILES['piece_jointe']['tmp_name'])) {
    $upload_info = reseaux_store_file_from_upload('piece_jointe');
    if (is_wp_error($upload_info)) return $upload_info;
    // stocke le chemin
    $data['piece_jointe_path'] = sanitize_text_field($upload_info['path']);
  }

  if (!$data) return new WP_Error('no_fields','Aucun champ', ['status'=>400]);
  $data['updated_at'] = current_time('mysql');

  $ok = $wpdb->update($table, $data, ['id'=>$id]);
  if ($ok===false) return new WP_Error('db_error','Update failed', ['status'=>500]);

  $r = new WP_REST_Request('GET', "/");
  $r->set_url_params(['id'=>$id]);
  return svc_reseaux_get($r);
}


function svc_reseaux_delete(WP_REST_Request $req){
  global $wpdb; $t=svc_reseaux_table(); $id=(int)$req['id'];
  [$row,$lab] = svc_reseaux_fetch_owned($id);
  if (!$row) return new WP_Error('forbidden','Accès refusé',['status'=>403]);
  $ok = $wpdb->delete($t,['id'=>$id],['%d']);
  if (!$ok) return new WP_Error('db_error','Delete failed',['status'=>500]);
  return new WP_REST_Response(null,204);
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

// Reseaux

function svc_reseaux_table()            { global $wpdb; return $wpdb->prefix . 'recherche_reseaux'; }
function svc_reseaux_projets_table()    { global $wpdb; return $wpdb->prefix . 'recherche_reseaux_projets'; }

/** Retourne l'ID du labo du directeur connecté */
function svc_current_labo_id() {
  $uid = get_current_user_id();
  if (!$uid) return 0;
  global $wpdb;
  $table = svc_laboratoire_table();
  return (int) $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE directeur_user_id=%d LIMIT 1", $uid));
}


/** === Args validators === */
function svc_reseaux_args_create() {
  return array(
    'institution'       => array('required'=>true,  'sanitize_callback'=>'sanitize_text_field'),
    'pays'              => array('required'=>true,  'sanitize_callback'=>'sanitize_text_field'),
    'type_collab'       => array('required'=>true,  'sanitize_callback'=>'sanitize_text_field'),
    'contact_nom'       => array('required'=>true,  'sanitize_callback'=>'sanitize_text_field'),
    'contact_email'     => array('required'=>true,  'validate_callback'=>function($v){return is_email($v);}, 'sanitize_callback'=>'sanitize_email'),
    'date_debut'        => array('required'=>true,  'validate_callback'=>fn($v)=>preg_match('/^\d{4}-\d{2}-\d{2}$/',$v),'sanitize_callback'=>'sanitize_text_field'),
    'date_fin'          => array('required'=>false, 'validate_callback'=>fn($v)=>!$v||preg_match('/^\d{4}-\d{2}-\d{2}$/',$v),'sanitize_callback'=>'sanitize_text_field'),
    'convention_signee' => array('required'=>false, 'sanitize_callback'=>'absint'),
    'statut'            => array('required'=>false, 'sanitize_callback'=>'sanitize_text_field'),
    'projets_associes'  => array('required'=>false), // array<int>
    'piece_jointe_id'   => array('required'=>false, 'sanitize_callback'=>'absint'),
    // en plus des champs déjà présents
    'contact_tel'      => array('required'=>false, 'sanitize_callback'=>'sanitize_text_field'),
    'site_web'         => array('required'=>false, 'sanitize_callback'=>'esc_url_raw'),
    'adresse_org'      => array('required'=>false, 'sanitize_callback'=>'sanitize_text_field'),
    'logo_url'         => array('required'=>false, 'sanitize_callback'=>'esc_url_raw'),
    'avatar_url'       => array('required'=>false, 'sanitize_callback'=>'esc_url_raw'),
    'contact_fonction' => array('required'=>false, 'sanitize_callback'=>'sanitize_text_field'),

  );
}
function svc_reseaux_args_update(){ return svc_reseaux_args_create(); }



/** === STATS === */
function svc_reseaux_stats(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_reseaux_table();
  $uid   = get_current_user_id();

  // Récupérer rôle(s)
  $user  = wp_get_current_user();
  $roles = (array) $user->roles;

  // --- Cas 1 : paramètre explicite (admin/service UTM)
  $labo_id = (int) $req->get_param('laboratoire_id');

  // --- Cas 2 : directeur de labo
  if (!$labo_id && in_array('um_directeur_laboratoire', $roles, true)) {
    $labo_id = svc_current_labo_id();
  }

  // --- Cas 3 : chercheur => on lit son laboratoire_id depuis la table membre
  if (!$labo_id && in_array('um_chercheur', $roles, true)) {
    $labo_id = (int) $wpdb->get_var($wpdb->prepare(
      "SELECT laboratoire_id 
       FROM {$wpdb->prefix}recherche_membre 
       WHERE user_id = %d 
       LIMIT 1",
      $uid
    ));
  }

  if (!$labo_id) {
    return new WP_Error('no_labo', 'Laboratoire introuvable', ['status'=>403]);
  }

  // --- Filtrage par année scolaire ou année civile ---
  $scope = $req['scope'] ?: 'cards';
  $year  = sanitize_text_field($req['year']); // "2024-2025" ou "2025"

  if ($year && preg_match('/^\d{4}-\d{4}$/',$year)) {
    list($y1,$y2) = explode('-', $year);
    $d1="$y1-09-01"; $d2="$y2-08-31";
  } else if ($year && preg_match('/^\d{4}$/',$year)) {
    $d1="$year-01-01"; $d2="$year-12-31";
  } else {
    $d1='2000-01-01'; $d2='2999-12-31';
  }

  // --- Stats "cards" ---
  if ($scope==='cards') {
    $nationaux = (int) $wpdb->get_var($wpdb->prepare("
      SELECT COUNT(*) FROM $table
      WHERE laboratoire_id=%d
        AND pays IN ('Tunisie','Tunis','TN','Tunisia')
        AND date_debut >= %s 
        AND COALESCE(date_fin,'2999-12-31')<=%s
    ", $labo_id, $d1, $d2));

    $internationaux = (int) $wpdb->get_var($wpdb->prepare("
      SELECT COUNT(*) FROM $table
      WHERE laboratoire_id=%d
        AND NOT (pays IN ('Tunisie','Tunis','TN','Tunisia'))
        AND date_debut >= %s 
        AND COALESCE(date_fin,'2999-12-31')<=%s
    ", $labo_id, $d1, $d2));

    return compact('nationaux','internationaux');
  }

  // --- Stats "pie" ---
  if ($scope==='pie') {
    return $wpdb->get_results($wpdb->prepare("
      SELECT pays, COUNT(*) AS n 
      FROM $table
      WHERE laboratoire_id=%d
        AND date_debut >= %s 
        AND COALESCE(date_fin,'2999-12-31')<=%s
      GROUP BY pays 
      ORDER BY n DESC 
      LIMIT 6
    ", $labo_id, $d1, $d2), ARRAY_A);
  }

  return new WP_Error('bad_scope','Scope invalide', ['status'=>400]);
}


/** === META === */
function svc_reseaux_meta(){
  return array(
    'types'  => ['Projet De Recherche H2020','Cotutelle Doctorale','Article Scientifique','Échange & Co-Pub','Projet Bilatéral'],
    'pays'   => ['France','Tunisie','Maroc','Belgique','Canada','Italie','Espagne'],
    'statuts'=> ['Actif','Occasionnel','En cours','Clos']
  );
}

/** === PROJETS du labo === */
function svc_reseaux_projets(WP_REST_Request $req){
  global $wpdb;
  $labo_id = (int) ($req['laboratoire_id'] ?: svc_current_labo_id());
  if (!$labo_id) return [];
  $table_p = $wpdb->prefix.'utm_recherche_projet';
  return $wpdb->get_results($wpdb->prepare("
    SELECT id, titre FROM $table_p WHERE laboratoire_id=%d ORDER BY titre ASC
  ", $labo_id), ARRAY_A);
}

// === Helpers supplémentaires ===
function svc_user_institut_id($user_id=null){
  $uid = $user_id ?: get_current_user_id();
  if (!$uid) return 0;
  return (int) get_user_meta($uid, 'institut_id', true);
}

/**
 * Liste "visible" : (created_by = user) OR (reseaux.laboratoire_id IN labs de l'institut de l'user)
 * Paramètres supportés (optionnels): q, pays, statut, has_convention, date_from, date_to, page, per_page
 * Retourne aussi piece_jointe_url et duration_human
 */
function svc_reseaux_list_visible(WP_REST_Request $req){
  global $wpdb;

  $table_r = svc_reseaux_table();               // wp_utm_recherche_reseaux
  $table_l = svc_laboratoire_table();           // wp_utm_recherche_laboratoire

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Utilisateur non connecté', ['status'=>403]);

  $institut_id = svc_user_institut_id($uid);

  // === Base WHERE : visibilité
  $where  = ["(r.created_by = %d)"];
  $params = [$uid];

  if ($institut_id) {
    // Ajoute la condition de visibilité par institut (labs de l'institut)
    $where[] = "OR (r.laboratoire_id IN (SELECT id FROM $table_l WHERE etablissement_id = %d))";
    $params[] = $institut_id;
  }

  // === Filtres
  if ($q = trim((string)$req['q'])) {
    $like = '%'.$wpdb->esc_like($q).'%';
    $where[] = "AND (r.institution LIKE %s OR r.contact_nom LIKE %s OR r.type_collab LIKE %s)";
    array_push($params, $like, $like, $like);
  }
  if ($pays = trim((string)$req['pays']))     { $where[] = "AND r.pays = %s"; $params[] = $pays; }
  if ($statut = trim((string)$req['statut'])) { $where[] = "AND r.statut = %s"; $params[] = $statut; }
  if ($hc = $req['has_convention'])           { $where[] = "AND r.convention_signee = %d"; $params[] = absint($hc); }
  if ($df = $req['date_from'])                { $where[] = "AND r.date_debut >= %s"; $params[] = $df; }
  if ($dt = $req['date_to'])                  { $where[] = "AND COALESCE(r.date_fin,'2999-12-31') <= %s"; $params[] = $dt; }

  $page = max(1, (int)$req['page']);
  $per  = min(100, max(5, (int)($req['per_page'] ?: 10)));
  $off  = ($page-1)*$per;

  // On ordonne pour privilégier "mes créations" en premier, puis plus récents
  $sqlW = "WHERE " . implode(' ', $where);
  $sql  = "
    SELECT r.* 
    FROM $table_r r
    $sqlW
    ORDER BY (r.created_by = %d) DESC, r.id DESC
    LIMIT %d OFFSET %d
  ";
  $items = $wpdb->get_results( $wpdb->prepare($sql, array_merge($params, [$uid, $per, $off]) ), ARRAY_A );

  // total
  $total = (int) $wpdb->get_var( $wpdb->prepare("
    SELECT COUNT(*) FROM $table_r r $sqlW
  ", $params) );

  // Enrichissement: piece_jointe_url + duration_human
  foreach ($items as &$it) {
    $it['projets_associes']   = $it['projets_associes'] ? json_decode($it['projets_associes'], true) : [];
    $it['convention_signee']  = (int)$it['convention_signee'];
    $it['piece_jointe_url']   = !empty($it['piece_jointe_id']) ? wp_get_attachment_url( (int)$it['piece_jointe_id'] ) : null;
    $it['duration_human']     = svc_duration_human($it['date_debut'], $it['date_fin']);
  }

  return array('items'=>$items, 'total'=>$total, 'page'=>$page, 'per_page'=>$per);
}
function reseaux_store_file_from_upload($file_field = 'piece_jointe') {
  if (empty($_FILES[$file_field]) || !is_uploaded_file($_FILES[$file_field]['tmp_name'])) {
    return null; // pas de fichier
  }
  $file = $_FILES[$file_field];

  // Dossier cible
  $base_dir = WP_CONTENT_DIR . '/recherche/reseaux';
  if (!file_exists($base_dir) && !wp_mkdir_p($base_dir)) {
    return new WP_Error('mkdir_failed', 'Impossible de créer le dossier /wp-content/recherche/reseaux');
  }

  // Validation type
  $ft = wp_check_filetype_and_ext($file['tmp_name'], $file['name']);
  if (empty($ft['ext']) || empty($ft['type'])) {
    return new WP_Error('bad_type', 'Type de fichier non autorisé');
  }

  // Nom unique
  $filename = wp_unique_filename($base_dir, sanitize_file_name($file['name']));
  $dest     = trailingslashit($base_dir) . $filename;

  if (!@move_uploaded_file($file['tmp_name'], $dest)) {
    return new WP_Error('move_failed', 'Échec du déplacement du fichier');
  }
  @chmod($dest, 0640);

  // URL publique + chemin relatif
  $url  = content_url('recherche/reseaux/' . $filename);
  $path_rel = str_replace(ABSPATH, '/', $dest);

  return array(
    'path'     => $path_rel,   // à stocker en base: piece_jointe_path
    'url'      => $url,
    'filename' => $filename,
    'mime'     => $ft['type'],
    'size'     => @filesize($dest),
  );
}

/** Durée lisible entre deux dates (YYYY-MM-DD) */
function svc_duration_human($d1, $d2){
  if (empty($d1)) return '-';
  if (empty($d2)) return '—'; // durée ouverte
  try {
    $a = new DateTime($d1); $b = new DateTime($d2);
    if ($b < $a) return '—';
    $diff = $a->diff($b);
    // priorise années/mois/jours
    if ($diff->y > 0) return sprintf('%dan %dmois', $diff->y, $diff->m);
    if ($diff->m > 0) return sprintf('%dmois %dj',  $diff->m, $diff->d);
    return sprintf('%dj', $diff->d);
  } catch (\Throwable $e) { return '-'; }
}



// Nom de table helper
function svc_pays_table(){ 
  global $wpdb; 
  return $wpdb->prefix . 'pays'; // => wp_pays ; si ta table s'appelle utm_pays, remplace par: return 'utm_pays';
}

/**
 * GET /plateforme-recherche/v1/pays
 * Params:
 *  - lang = fr|ar|en (default fr)
 *  - q    = filtre texte (optionnel)
 *  - actif = 0|1 (default 1)
 *  - limit = nombre max (default 500)
 */
function svc_pays_list( WP_REST_Request $req ){
  global $wpdb;
  $table = svc_pays_table();

  $lang = strtolower($req->get_param('lang') ?: 'fr');
  $q    = trim((string)$req->get_param('q'));
  $actif = ($req->get_param('actif') === '0') ? 0 : 1;
  $limit = intval($req->get_param('limit') ?: 500);
  if ($limit < 1 || $limit > 2000) $limit = 500;

  // Colonne d'intitulé selon la langue
  $col_map = ['fr' => 'intitule', 'ar' => 'intitule_ar', 'en' => 'intitule_en'];
  $col = isset($col_map[$lang]) ? $col_map[$lang] : 'intitule';

  // Base SQL
  $where = ["actif = %d"];
  $params = [$actif];

  // Filtre texte (sur intitule fr/ar/en + code)
  if ($q !== '') {
    $where[] = "(intitule LIKE %s OR intitule_ar LIKE %s OR intitule_en LIKE %s OR code_iso2 LIKE %s OR code_iso3 LIKE %s)";
    $like = '%' . $wpdb->esc_like($q) . '%';
    array_push($params, $like, $like, $like, $like, $like);
  }

  $sql = "
    SELECT id, code_iso2, code_iso3, $col AS libelle
    FROM $table
    WHERE " . implode(' AND ', $where) . "
    ORDER BY libelle ASC
    LIMIT %d
  ";
  $params[] = $limit;

  $rows = $wpdb->get_results($wpdb->prepare($sql, $params), ARRAY_A);

  return new WP_REST_Response([
    'count' => count($rows),
    'items' => array_map(function($r){
      return [
        'id'       => (int)$r['id'],
        'code_iso2'=> $r['code_iso2'],
        'code_iso3'=> $r['code_iso3'],
        'libelle'  => $r['libelle'],
      ];
    }, $rows)
  ], 200);
}


function svc_directeurs_list(WP_REST_Request $req){
  global $wpdb;

  if (!is_user_logged_in()){
    return new WP_Error('forbidden','Utilisateur non connecté', ['status'=>403]);
  }

  $q       = trim((string)$req['q']);
  $etabId  = $req->get_param('etablissement_id'); // correspond au usermeta 'institut_id'
  $page    = max(1, (int)$req->get_param('page') ?: 1);
  $per     = min(200, max(1, (int)$req->get_param('per_page') ?: 50));
  $off     = ($page - 1) * $per;

  // ---- Construction WP_User_Query
  $args = array(
    'role'    => 'um_directeur_laboratoire',
    'orderby' => 'display_name',
    'order'   => 'ASC',
    'number'  => $per,
    'offset'  => $off,
    'fields'  => array('ID','display_name','user_email'),
  );

  // Filtre établissement via usermeta 'institut_id'
  $meta_query = array();
  if (!empty($etabId)) {
    $meta_query[] = array(
      'key'     => 'institut_id',
      'value'   => (string)absint($etabId),
      'compare' => '='
    );
  }
  if (!empty($meta_query)) {
    $args['meta_query'] = $meta_query;
  }

  // Recherche q (LIKE) : utilise le moteur de WP_User_Query
  if ($q !== '') {
    $args['search'] = '*' . esc_attr($q) . '*';
    $args['search_columns'] = array('user_login','user_nicename','display_name','user_email');
  }

  $uq    = new WP_User_Query($args);
  $users = $uq->get_results();
  $total = (int)$uq->get_total();

  // Build items + récupération du usermeta 'institut_id'
  $items = array();
  foreach ($users as $u) {
    $uId = (int)$u->ID;
    $institut_id_user = get_user_meta($uId, 'institut_id', true);
    $items[] = array(
      'id'             => $uId,
      'display_name'   => $u->display_name,
      'email'          => $u->user_email,
      'avatar_url'     => get_avatar_url($uId),
      'institut_id'    => $institut_id_user !== '' ? (int)$institut_id_user : null,
      'label'          => (trim($u->display_name) !== '' ? $u->display_name : ('#'.$uId)),
    );
  }

  return array(
    'items'    => $items,
    'total'    => $total,
    'page'     => $page,
    'per_page' => $per,
  );
}

function svc_laboratoire_create(WP_REST_Request $req){
  global $wpdb;
  $table = svc_laboratoire_table();

  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Utilisateur non connecté',['status'=>403]);

  $etablissement_id  = absint($req->get_param('etablissement_id'));
  $denomination      = $req->get_param('denomination') ?: $req->get_param('nom'); // compat
  $domaine           = (string)$req->get_param('domaine');
  $directeur_user_id = $req->get_param('directeur_user_id');
  $directeur_user_id = ($directeur_user_id === null || $directeur_user_id==='') ? null : absint($directeur_user_id);

  if (!$etablissement_id || !$denomination){
    return new WP_Error('invalid_params','Champs requis: etablissement_id, denomination',['status'=>400]);
  }

  // === Si un directeur est fourni, valider + CONTRAINTE "déjà affecté"
  if (!empty($directeur_user_id)) {
    // 1) user existe
    $u = get_user_by('id', $directeur_user_id);
    if (!$u) return new WP_Error('not_found','Utilisateur (directeur) introuvable',['status'=>404]);

    // 2) rôle (optionnel mais recommandé)
    if (!in_array('um_directeur_laboratoire', (array)$u->roles, true)) {
      return new WP_Error('role_mismatch',"L'utilisateur sélectionné n'a pas le rôle 'um_directeur_laboratoire'.",['status'=>400]);
    }

    // 3) même établissement via usermeta 'institut_id' (optionnel)
    $user_institut = get_user_meta($directeur_user_id, 'institut_id', true);
    if ($user_institut !== '' && $user_institut !== null) {
      if ((int)$user_institut !== (int)$etablissement_id) {
        return new WP_Error('institut_mismatch',"Le directeur choisi n'appartient pas au même établissement que le labo.",['status'=>400]);
      }
    }

    // 4) CONTRAINTE : directeur déjà affecté à un autre labo ?
    //   -> si tu veux restreindre au même établissement uniquement, ajoute "AND etablissement_id = %d"
    $conflict = $wpdb->get_row(
      $wpdb->prepare(
        "SELECT id, denomination FROM $table WHERE directeur_user_id = %d LIMIT 1",
        $directeur_user_id
      ),
      ARRAY_A
    );
    if ($conflict){
      $msg = sprintf(
        "Impossible d'affecter ce directeur : il est déjà rattaché au laboratoire #%d%s.",
        (int)$conflict['id'],
        !empty($conflict['denomination']) ? " (« {$conflict['denomination']} »)" : ''
      );
      return new WP_Error('director_already_assigned', $msg, ['status'=>409, 'conflict_lab'=>$conflict]);
    }
  }

  // === Insertion
  $ins = [
    'etablissement_id' => $etablissement_id,
    'denomination'     => sanitize_text_field($denomination),
    'domaine'          => sanitize_text_field($domaine),
    'created_by'       => $uid,
    'created_at'       => current_time('mysql'),
    'updated_at'       => current_time('mysql'),
  ];
  if (!empty($directeur_user_id)) {
    $ins['directeur_user_id'] = $directeur_user_id; // seulement si fourni, pour éviter d'insérer 0/''.
  }

  $ok = $wpdb->insert($table, $ins);
  if (!$ok){
    return new WP_Error('db_error','Insertion échouée',['status'=>500,'mysql_error'=>$wpdb->last_error]);
  }

  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d",(int)$wpdb->insert_id), ARRAY_A);
  if (!empty($row['directeur_user_id'])) {
    $u = get_userdata((int)$row['directeur_user_id']);
    if ($u){
      $row['directeur_nom']    = $u->display_name;
      $row['directeur_email']  = $u->user_email;
      $row['directeur_avatar'] = get_avatar_url($u->ID);
    }
  }
  return new WP_REST_Response($row, 201);
}



function svc_laboratoire_create_endpoint(WP_REST_Request $req){
  $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Utilisateur non connecté', ['status'=>403]);

  $payload = [
    'etablissement_id'  => $req->get_param('etablissement_id'),
    'nom'               => $req->get_param('nom'),
    'domaine'           => $req->get_param('domaine'),
    'directeur_user_id' => $req->get_param('directeur_user_id'),
  ];

  $created = svc_laboratoire_create($uid, $payload);
  if (is_wp_error($created)) return $created;

  return new WP_REST_Response($created, 201);
}


function svc_projet_full(WP_REST_Request $req) {
    global $wpdb;
    $id    = intval($req['id']);
    $table = svc_projet_table();

    // --- Projet principal + chercheur + financement ---
    $projet = $wpdb->get_row($wpdb->prepare(
        "SELECT p.*, 
                u.display_name AS chercheur_nom, 
                sf.intitule AS financement_intitule
         FROM $table p
         LEFT JOIN {$wpdb->users} u 
                ON p.chercheur_id = u.ID
         LEFT JOIN {$wpdb->prefix}recherche_source_financement sf 
                ON p.type_financement = sf.code
         WHERE p.id = %d",
        $id
    ), ARRAY_A);

    if (!$projet) {
        return new WP_Error('not_found', 'Projet introuvable', ['status' => 404]);
    }

    // --- Objectifs ---
  /*  $projet['objectifs'] = $wpdb->get_results($wpdb->prepare(
        "SELECT id, projet_id, type, objectif 
         FROM {$wpdb->prefix}recherche_projet_objectifs 
         WHERE projet_id = %d 
         ORDER BY id ASC",
        $id
    ), ARRAY_A);*/

    // --- Membres ---
    $projet['membres'] = $wpdb->get_results($wpdb->prepare(
        "SELECT m.*, u.display_name, u.user_email 
         FROM {$wpdb->prefix}recherche_projet_membres m
         LEFT JOIN {$wpdb->users} u 
                ON m.user_id = u.ID
         WHERE m.projet_id = %d
         ORDER BY m.id ASC",
        $id
    ), ARRAY_A);

    // --- Livrables ---
    $projet['livrables'] = $wpdb->get_results($wpdb->prepare(
        "SELECT * 
         FROM {$wpdb->prefix}recherche_projet_livrables 
         WHERE projet_id = %d
         ORDER BY id ASC",
        $id
    ), ARRAY_A);

    // --- Pièces jointes ---
    $projet['pieces'] = $wpdb->get_results($wpdb->prepare(
        "SELECT * 
         FROM {$wpdb->prefix}recherche_projet_pieces 
         WHERE projet_id = %d
         ORDER BY id ASC",
        $id
    ), ARRAY_A);

    // --- Dépenses ---
    $projet['depenses'] = $wpdb->get_results($wpdb->prepare(
        "SELECT * 
         FROM {$wpdb->prefix}recherche_projet_depenses 
         WHERE projet_id = %d
         ORDER BY id ASC",
        $id
    ), ARRAY_A);

    return $projet;
}


// GET /plateforme-recherche/v1/financement/sources
function svc_sources_list(WP_REST_Request $req){
    global $wpdb;
    $table = $wpdb->prefix . "recherche_source_financement";

    $results = $wpdb->get_results("SELECT id, code, intitule, type, actif FROM $table ORDER BY intitule ASC", ARRAY_A);
    return $results;
}


// Création d’une dépense
function svc_depense_create(WP_REST_Request $req) {
    global $wpdb;
    $table = "{$wpdb->prefix}recherche_projet_depenses";
    $table_projet = svc_projet_table();

    $data = svc_read_input($req);
    $projet_id = intval($req['projet_id']);
    if (!$projet_id) {
        return new WP_Error('bad_request', 'Projet manquant', ['status' => 400]);
    }

    // --- Budget du projet ---
    $budget = $wpdb->get_var($wpdb->prepare(
        "SELECT budget FROM $table_projet WHERE id = %d",
        $projet_id
    ));
    if ($budget === null) {
        return new WP_Error('not_found', 'Projet introuvable', ['status' => 404]);
    }

    // --- Somme des dépenses existantes ---
    $total_depenses = $wpdb->get_var($wpdb->prepare(
        "SELECT SUM(montant) FROM $table WHERE projet_id = %d",
        $projet_id
    ));
    $total_depenses = floatval($total_depenses ?: 0);

    // --- Nouveau montant ---
    $montant = floatval(str_replace(' ', '', $data['montant'] ?? 0));

    // --- Vérification du plafond ---
    if (($total_depenses + $montant) > floatval($budget)) {
        return new WP_Error(
            'budget_exceeded',
            sprintf(
                "Impossible d'ajouter la dépense (budget: %.2f TND, déjà dépensé: %.2f TND, nouvelle dépense: %.2f TND).",
                $budget, $total_depenses, $montant
            ),
            ['status' => 400]
        );
    }

    // --- Insertion ---
    $ins = [
        'projet_id'   => $projet_id,
        'ref'         => sanitize_text_field($data['ref'] ?? ''),
        'designation' => sanitize_text_field($data['designation'] ?? ''),
        'montant'     => $montant,
        'date_depense'=> sanitize_text_field($data['date_depense'] ?? null),
        'created_at'  => current_time('mysql')
    ];

    $ok = $wpdb->insert($table, $ins);
    if (!$ok) {
        return new WP_Error('db_error', 'Insert failed', ['status' => 500]);
    }

    $ins['id'] = $wpdb->insert_id;
    return $ins;
}

/*
// GET /plateforme-recherche/v1/financement/suivi-sources
function svc_suivi_sources(WP_REST_Request $req) {
    global $wpdb;
    $table_projet   = $wpdb->prefix . "recherche_projet";
    $table_source   = $wpdb->prefix . "recherche_source_financement";
    $table_depenses = $wpdb->prefix . "recherche_projet_depenses";

    $sql = "SELECT s.id as idsource,
                  p.type_financement as code,
                   s.intitule as source_intitule,
                   s.type as source_type,
                   SUM(p.budget) as montant,
                   COALESCE(SUM(d.total_depenses),0) as consomme
            FROM $table_projet p
            LEFT JOIN $table_source s ON p.type_financement = s.code
            LEFT JOIN (
                SELECT projet_id, SUM(montant) as total_depenses
                FROM $table_depenses
                GROUP BY projet_id
            ) d ON p.id = d.projet_id
            WHERE p.type_financement IS NOT NULL
            GROUP BY p.type_financement, s.intitule, s.type
            ORDER BY s.intitule ASC";

    $rows = $wpdb->get_results($sql, ARRAY_A);

    foreach ($rows as &$r) {
        $r['montant']  = floatval($r['montant']);
        $r['consomme'] = floatval($r['consomme']);
        $r['solde']    = $r['montant'] - $r['consomme'];
        $r['statut']   = ($r['solde'] > 0) ? 'Actif' : 'En cours';
    }

    return $rows;
}


// GET /plateforme-recherche/v1/financement/suivi-projets
function svc_suivi_projets(WP_REST_Request $req){
    global $wpdb;
    $table_projet   = $wpdb->prefix . "recherche_projet";
    $table_depenses = $wpdb->prefix . "recherche_projet_depenses";

    // On ramène le projet avec son budget et son statut
    $sql = "SELECT p.id, p.titre, p.budget, p.statut, p.updated_at,
                   COALESCE(SUM(d.montant),0) as total_depenses
            FROM $table_projet p
            LEFT JOIN $table_depenses d ON p.id = d.projet_id
            GROUP BY p.id, p.titre, p.budget, p.statut, p.updated_at
            ORDER BY p.updated_at DESC";

    $rows = $wpdb->get_results($sql, ARRAY_A);

    foreach($rows as &$r){
        $r['budget']   = floatval($r['budget']);
        $r['depense']  = floatval($r['total_depenses']);
        $r['reste']    = $r['budget'] - $r['depense'];
        $r['statut']   = $r['statut'] ?: (($r['reste'] > 0) ? 'En cours' : 'Terminé');
    }

    return $rows;
}
*/


// GET /plateforme-recherche/v1/financement/suivi-sources
function svc_suivi_sources(WP_REST_Request $req) {
    global $wpdb;
    $table_projet   = $wpdb->prefix . "recherche_projet";
    $table_source   = $wpdb->prefix . "recherche_source_financement";
    $table_depenses = $wpdb->prefix . "recherche_projet_depenses";

    $user   = wp_get_current_user();
    $roles  = $user->roles;
    $user_id = get_current_user_id();

    $where = "WHERE p.type_financement IS NOT NULL";

    // Cas 1 : Admin ou Service UTM → tous les projets
    if (in_array('administrator', $roles) || in_array('um_service_utm', $roles)) {
        // pas de filtre
    }
    // Cas 2 : Directeur de labo
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $where .= $wpdb->prepare(
                " AND (p.chercheur_id = %d OR p.chercheur_id IN (
                    SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                ))",
                $user_id, $lab_id
            );
        }
    }
    // Cas 3 : Chercheur
    elseif (in_array('um_chercheur', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $where .= $wpdb->prepare(
                " AND (p.chercheur_id = %d
                    OR p.chercheur_id IN (
                        SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                    )
                    OR p.chercheur_id IN (
                        SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d
                    )
                )",
                $user_id, $lab_id, $lab_id
            );
        } else {
            $where .= $wpdb->prepare(" AND p.chercheur_id = %d", $user_id);
        }
    }
    // Cas 4 : Autres → seulement ses projets
    else {
        $where .= $wpdb->prepare(" AND p.chercheur_id = %d", $user_id);
    }

    $sql = "SELECT s.id as idsource,
                   p.type_financement as code,
                   s.intitule as source_intitule,
                   s.type as source_type,
                   SUM(p.budget) as montant,
                   COALESCE(SUM(d.total_depenses),0) as consomme
            FROM $table_projet p
            LEFT JOIN $table_source s ON p.type_financement = s.code
            LEFT JOIN (
                SELECT projet_id, SUM(montant) as total_depenses
                FROM $table_depenses
                GROUP BY projet_id
            ) d ON p.id = d.projet_id
            $where
            GROUP BY p.type_financement, s.intitule, s.type, s.id
            ORDER BY s.intitule ASC";

    $rows = $wpdb->get_results($sql, ARRAY_A);

    foreach ($rows as &$r) {
        $r['montant']  = floatval($r['montant']);
        $r['consomme'] = floatval($r['consomme']);
        $r['solde']    = $r['montant'] - $r['consomme'];
        $r['statut']   = ($r['solde'] > 0) ? 'Actif' : 'En cours';
    }

    return $rows;
}


// GET /plateforme-recherche/v1/financement/suivi-projets
function svc_suivi_projets(WP_REST_Request $req){
    global $wpdb;
    $table_projet   = $wpdb->prefix . "recherche_projet";
    $table_depenses = $wpdb->prefix . "recherche_projet_depenses";

    $user   = wp_get_current_user();
    $roles  = $user->roles;
    $user_id = get_current_user_id();

    $where = "1=1";

    // Cas 1 : Admin ou Service UTM → tous les projets
    if (in_array('administrator', $roles) || in_array('um_service_utm', $roles)) {
        // pas de filtre
    }
    // Cas 2 : Directeur de labo
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $where = $wpdb->prepare(
                " (p.chercheur_id = %d OR p.chercheur_id IN (
                    SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                ))",
                $user_id, $lab_id
            );
        }
    }
    // Cas 3 : Chercheur
    elseif (in_array('um_chercheur', $roles)) {
        $lab_id = $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id = %d",
            $user_id
        ));
        if ($lab_id) {
            $where = $wpdb->prepare(
                " (p.chercheur_id = %d
                    OR p.chercheur_id IN (
                        SELECT user_id FROM {$wpdb->prefix}recherche_membre WHERE laboratoire_id = %d
                    )
                    OR p.chercheur_id IN (
                        SELECT directeur_user_id FROM {$wpdb->prefix}recherche_laboratoire WHERE id = %d
                    )
                )",
                $user_id, $lab_id, $lab_id
            );
        } else {
            $where = $wpdb->prepare(" p.chercheur_id = %d", $user_id);
        }
    }
    // Cas 4 : Autres
    else {
        $where = $wpdb->prepare(" p.chercheur_id = %d", $user_id);
    }

    $sql = "SELECT p.id, p.titre, p.budget, p.statut, p.updated_at,
                   COALESCE(SUM(d.montant),0) as total_depenses
            FROM $table_projet p
            LEFT JOIN $table_depenses d ON p.id = d.projet_id
            WHERE $where
            GROUP BY p.id, p.titre, p.budget, p.statut, p.updated_at
            ORDER BY p.updated_at DESC";

    $rows = $wpdb->get_results($sql, ARRAY_A);

    foreach($rows as &$r){
        $r['budget']   = floatval($r['budget']);
        $r['depense']  = floatval($r['total_depenses']);
        $r['reste']    = $r['budget'] - $r['depense'];
        $r['statut']   = $r['statut'] ?: (($r['reste'] > 0) ? 'En cours' : 'Terminé');
    }

    return $rows;
}

// GET /plateforme-recherche/v1/financement/stats
function svc_financement_stats(WP_REST_Request $req){
    global $wpdb;
    $table = $wpdb->prefix . "recherche_projet";

    $total = $wpdb->get_var("SELECT SUM(budget) FROM $table");
    $sources = $wpdb->get_var("SELECT COUNT(DISTINCT type_financement) FROM $table");

    return [
        'budget_total' => $total ?: 0,
        'sources_actives' => $sources ?: 0
    ];
}


function svc_manifestation_categorie_table(){ global $wpdb; return $wpdb->prefix.'recherche_manifestation_categorie'; }
function svc_manifestation_images_table(){ global $wpdb; return $wpdb->prefix.'recherche_manifestation_images'; }


// élargir la whitelist
function svc_manifestation_allowed(){
  // anciens + nouveaux
  return [
    'date','intitule','type','user_id','lieu','preuve_url','role',
    // nouveaux
    'categorie_id','texte','image_url','statut','auteur_id','annee_academique',
    'date_debut','date_fin','slug'
  ];
}

// CREATE (remplace ton actuel svc_manifestation_create)
function svc_manifestation_create(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $allowed = svc_manifestation_allowed();
  $data = svc_read_input($req); $ins = [];

  var_dump($_FILES);
  
  

  foreach($allowed as $k){
    if(isset($data[$k])){
      if ($k === 'texte') {
        $v = wp_kses_post($data[$k]); // ✅ garder HTML de Quill
      } else {
        $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      }
      $ins[$k] = $v;
    }
  }


  // défauts utiles
  if (empty($ins['user_id'])) { $ins['user_id'] = get_current_user_id();} 
  if (empty($ins['statut'])) $ins['statut'] = 'publie';
  if (empty($ins['date']))      $ins['date'] = current_time('Y-m-d');

  $ok = $wpdb->insert($table, $ins);
  if(!$ok) return new WP_Error('db_error','Insert failed',['status'=>500]);
  $id = (int)$wpdb->insert_id;

  // upload d’images optionnel (files[] dans le même POST)
  if (!empty($_FILES['files'])) {
    $_FILES['manifestation_files'] = $_FILES['files']; // alias pour éviter conflit
    svc_manifestation_images_add(new WP_REST_Request('POST', "/?id=$id"));
  }

  return ['id'=>$id] + $ins;
}

// UPDATE (remplace ton actuel svc_manifestation_update)
function svc_manifestation_update(WP_REST_Request $req){
  global $wpdb; $table = svc_manifestation_table(); $allowed = svc_manifestation_allowed();
  $id = absint($req['id']); if(!$id) return new WP_Error('bad_id','ID manquant',['status'=>400]);
  $data = svc_read_input($req); $upd = [];
  
  
foreach($allowed as $k){
  if(isset($data[$k])){
    if ($k === 'texte') {
      $v = wp_kses_post($data[$k]); // ✅ garder HTML de Quill
    } else {
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
    }
    $ins[$k] = $v;
  }
}


  if(empty($upd)) return new WP_Error('bad_request','No valid fields',['status'=>400]);
  $ok = $wpdb->update($table, $upd, ['id'=>$id]);
  if($ok===false) return new WP_Error('db_error','Update failed',['status'=>500]);

  // ajout images si envoyées
  if (!empty($_FILES['files'])) {
    $_REQUEST['id'] = $id;
    svc_manifestation_images_add($req);
  }
  return ['id'=>$id] + $upd;
}
// Catégories
function svc_manifestation_categories(WP_REST_Request $req){
  global $wpdb; $t = svc_manifestation_categorie_table();
  $rows = $wpdb->get_results("SELECT id, nom, description FROM $t ORDER BY nom ASC", ARRAY_A) ?: [];
  return $rows;
}

// Upload multiples
function svc_manifestation_images_add(WP_REST_Request $req){
  global $wpdb; $t = svc_manifestation_images_table();
  $mid = absint($req['id'] ?? $_REQUEST['id'] ?? 0); // ✅ fallback

  if(!$mid) return new WP_Error('bad_id','manifestation_id manquant',['status'=>400]);
  if (empty($_FILES['files']) && empty($_FILES['manifestation_files'])) return [];

  $files = $_FILES['files'] ?? $_FILES['manifestation_files'];
  $upload_dir = WP_CONTENT_DIR.'/uploads/manifestations';
  if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);

  $created = [];
  foreach($files['name'] as $i=>$name){
    if (!is_uploaded_file($files['tmp_name'][$i])) continue;
    $safe = wp_unique_filename($upload_dir, sanitize_file_name($name));
    $dest = trailingslashit($upload_dir).$safe;
    if (!@move_uploaded_file($files['tmp_name'][$i], $dest)) continue;

    $url = content_url('uploads/manifestations/'.$safe);
    $alt = sanitize_text_field(pathinfo($safe, PATHINFO_FILENAME));

    $wpdb->insert($t, [
      'manifestation_id'=>$mid,
      'image_url'=>$url,
      'alt_text'=>$alt,
      'ordre'=> (int)$i
    ], ['%d','%s','%s','%d']);

    $created[] = ['id'=>$wpdb->insert_id,'image_url'=>$url,'alt_text'=>$alt,'ordre'=>$i];
  }
  return $created;
}


function svc_manifestation_images_list(WP_REST_Request $req){
  global $wpdb; $t = svc_manifestation_images_table();
  $mid = absint($req['id']);
  return $wpdb->get_results($wpdb->prepare(
    "SELECT id, image_url, alt_text, ordre FROM $t WHERE manifestation_id=%d ORDER BY ordre ASC, id ASC", $mid
  ), ARRAY_A) ?: [];
}

function svc_manifestation_images_delete(WP_REST_Request $req){
  global $wpdb; $t = svc_manifestation_images_table();
  $mid = absint($req['id']); $img = absint($req->get_param('image_id'));
  if(!$img) return new WP_Error('bad_id','image_id manquant',['status'=>400]);
  $wpdb->delete($t, ['id'=>$img,'manifestation_id'=>$mid], ['%d','%d']);
  return new WP_REST_Response(null,204);
}
function svc_manifestation_stats(WP_REST_Request $req){
  global $wpdb; 
  $t = svc_manifestation_table();
  $tc = svc_manifestation_categorie_table();

  // Plage année
  $year = trim((string)$req->get_param('year'));
  if ($year && preg_match('/^\d{4}-\d{4}$/',$year)){
    [$y1,$y2] = explode('-', $year);
    $d1="$y1-09-01"; $d2="$y2-08-31";
  } elseif ($year && preg_match('/^\d{4}$/',$year)) {
    $d1="$year-01-01"; $d2="$year-12-31";
  } else {
    $d1="2000-01-01"; $d2="2999-12-31";
  }

  // Dernière actu publiée
  $sql = $wpdb->prepare(
    "SELECT DATE_FORMAT(MAX(date_debut),'%%d/%%m/%%Y')
    FROM $t 
    WHERE statut='publie' 
      AND date_debut IS NOT NULL
      AND date_debut BETWEEN %s AND %s",
    $d1, $d2
  );

  error_log("SQL Manifestation Last: $sql");

  $last = $wpdb->get_var($sql);

  


  // Nombre ce mois
  $firstDay = date('Y-m-01'); $lastDay = date('Y-m-t');
  $nbMonth = (int)$wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM $t WHERE statut='publie' AND date BETWEEN %s AND %s", $firstDay,$lastDay
  ));

  // Donut catégories
  $rows = $wpdb->get_results($wpdb->prepare(
    "SELECT c.nom AS categorie, COUNT(*) AS n
     FROM $t m LEFT JOIN $tc c ON m.categorie_id=c.id
     WHERE m.statut='publie' AND m.date BETWEEN %s AND %s
     GROUP BY c.nom ORDER BY n DESC", $d1,$d2
  ), ARRAY_A) ?: [];

  $total = array_sum(array_map(fn($r)=> (int)$r['n'], $rows)) ?: 1;
  $donut = array_map(function($r) use($total){
    return ['label'=>$r['categorie'] ?: 'Non catégorisé', 'value'=> round(100*(int)$r['n']/$total)];
  }, $rows);

  // Liste des années dispo (distinct annee_academique non NULL)
  $years = $wpdb->get_col("SELECT DISTINCT annee_academique FROM $t WHERE annee_academique IS NOT NULL ORDER BY annee_academique DESC");

  return [
    'last_published' => $last,
    'count_this_month' => $nbMonth,
    'donut' => $donut,
    'years' => $years,
  ];
}
function svc_manifestation_media(WP_REST_Request $req){
  global $wpdb; 
  $t  = svc_manifestation_table();
  $ti = svc_manifestation_images_table();

  // 3 actus récentes pour le carrousel
  $actus = $wpdb->get_results(
    "SELECT id, intitule AS title, COALESCE(image_url,'') AS cover, DATE_FORMAT(date,'%d-%m-%Y') AS date
     FROM $t WHERE statut='publie' ORDER BY date DESC, id DESC LIMIT 3", ARRAY_A
  ) ?: [];

  // 3 photos récentes pour la grille (toutes manifestations confondues)
  $photos = $wpdb->get_results(
    "SELECT image_url, alt_text
     FROM $ti ORDER BY id DESC LIMIT 3", ARRAY_A
  ) ?: [];

  return compact('actus','photos');
}
