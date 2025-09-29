<?php
/** Services directeurderecherche — tables $wpdb->prefix . 'recherche_<entite>' */
if (!defined('ABSPATH')) { exit; }



// === activite_doc ===
function svc_activite_doc_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_doc'; }
function svc_activite_doc_allowed(){ return array('activite_id', 'fichier'); }
function svc_equipement_allowed(){
  return array('categorie_id','disponibilite_id','modele','nom_appareil','statut','spcification_technique','lieu');
}
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
/*
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
*/


function svc_activite_quotidienne_get(WP_REST_Request $req){
  global $wpdb;
  $table       = svc_activite_quotidienne_table();
  $table_types = $wpdb->prefix . 'recherche_type_activite_quotidienne';

  $id = intval($req['id']);

  $sql = $wpdb->prepare("
    SELECT a.*, t.libelle_fr AS type_libelle
    FROM $table a
    LEFT JOIN $table_types t ON a.type_activite = t.id
    WHERE a.id = %d
  ", $id);

  $row = $wpdb->get_row($sql, ARRAY_A);

  if(!$row){
    return new WP_Error('not_found','Activité introuvable',['status'=>404]);
  }

  return $row;
}

function svc_activite_quotidienne_table(){ 
  global $wpdb; 
  return $wpdb->prefix . 'recherche_activite_quotidienne'; 
}
function svc_activite_quotidienne_allowed(){ 
  return array('date', 'heure_debut', 'heure_fin', 'membre_id', 'titre', 'type_activite', 'description', 'statut', 'piece_jointe_path'); 
}

function svc_activite_quotidienne_list(WP_REST_Request $req){
  global $wpdb; 
  $table       = svc_activite_quotidienne_table();
  $table_types = $wpdb->prefix . 'recherche_type_activite_quotidienne';

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  // Récupérer l'utilisateur connecté
  $user_id = get_current_user_id();

  $sql  = $wpdb->prepare("
    SELECT a.*,
           t.libelle_fr AS type_libelle
    FROM $table a
    LEFT JOIN $table_types t ON a.type_activite = t.id
    WHERE a.membre_id = %d
    ORDER BY a.date DESC, a.heure_debut ASC
    LIMIT %d OFFSET %d
  ", $user_id, $per, $off);

  return $wpdb->get_results($sql, ARRAY_A);
}


function svc_activite_quotidienne_create(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_activite_quotidienne_table();
  $data  = $req->get_params();
  $ins   = array();

  foreach (svc_activite_quotidienne_allowed() as $k) {
    if (isset($data[$k])) {
        $val = is_scalar($data[$k]) 
            ? sanitize_text_field($data[$k]) 
            : wp_json_encode($data[$k]);

        // 🔹 Statut par défaut si vide
        if ($k === 'Statut' && empty($val)) {
            $val = 'Prévu';
        }

        $ins[$k] = $val;
    }
}


  // 🔹 Forcer membre_id = user connecté
  $ins['membre_id'] = get_current_user_id();


  // 🔹 Upload fichier
  if (!empty($_FILES['piece_jointe']['name'])){
    $upload_dir = WP_CONTENT_DIR . '/recherche/activites/';
    $upload_url = content_url('recherche/activites/');
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = time() . '-' . sanitize_file_name($_FILES['piece_jointe']['name']);
    $target   = $upload_dir . $filename;
    if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $target)){
      $ins['piece_jointe_path'] = $upload_url . $filename;
    }
  }

  if(empty($ins)) {
    return new WP_Error('bad_request','No valid fields',['status'=>400]);
  }

  $ok = $wpdb->insert($table, $ins);

  if(!$ok) {
    return new WP_Error('db_error','Insert failed',['status'=>500]);
  }

  return ['id'=>$wpdb->insert_id] + $ins;
}



function svc_activite_quotidienne_update(WP_REST_Request $req){
  global $wpdb; $table = svc_activite_quotidienne_table();
  $id   = intval($req['id']); $data = $req->get_params(); $upd = array();

  foreach (svc_activite_quotidienne_allowed() as $k){
    if(array_key_exists($k,$data)){
      $upd[$k] = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
    }
  }

  // fichier
  if (!empty($_FILES['piece_jointe']['name'])){
    $upload_dir = WP_CONTENT_DIR . '/recherche/activites/';
    $upload_url = content_url('recherche/activites/');
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = time() . '-' . sanitize_file_name($_FILES['piece_jointe']['name']);
    $target   = $upload_dir . $filename;
    if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $target)){
      $upd['piece_jointe_path'] = $upload_url . $filename;
    }
  }

  if(empty($upd)) return new WP_Error('bad_request','No valid fields',['status'=>400]);
  $ok = $wpdb->update($table, $upd, ['id'=>$id]);
  if($ok===false) return new WP_Error('db_error','Update failed',['status'=>500]);
  return ['id'=>$id] + $upd;
}

function svc_activite_quotidienne_delete(WP_REST_Request $req){
  global $wpdb;
  $table = svc_activite_quotidienne_table();
  $id = intval($req['id']);
  $ok = $wpdb->delete($table, ['id'=>$id]);
  if(!$ok) return new WP_Error('db_error','Suppression échouée',['status'=>500]);
  return ['deleted'=>true,'id'=>$id];
}

function svc_stats_activite_quotidienne(WP_REST_Request $req){
  global $wpdb;
  $table       = $wpdb->prefix . 'recherche_activite_quotidienne';
  $table_types = $wpdb->prefix . 'recherche_type_activite_quotidienne';

  $user_id = get_current_user_id();
  if (!$user_id) {
    return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status' => 401]);
  }

  $today    = current_time('Y-m-d');
  $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));

  // Nombre d’activités aujourd’hui
  $nb_today = (int) $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) 
     FROM $table 
     WHERE date = %s AND membre_id = %d", 
    $today, $user_id
  ));

  // Nombre prévues demain
  $nb_tomorrow = (int) $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) 
     FROM $table 
     WHERE date = %s AND membre_id = %d", 
    $tomorrow, $user_id
  ));

  // Répartition par type avec jointure
  $rows = $wpdb->get_results($wpdb->prepare("
    SELECT a.type_activite,
           t.libelle_fr AS type_libelle,
           COUNT(*) as total
    FROM $table a
    LEFT JOIN $table_types t ON a.type_activite = t.id
    WHERE a.membre_id = %d
    GROUP BY a.type_activite, t.libelle_fr
    ORDER BY total DESC
  ", $user_id), ARRAY_A);

  return [
    'today'    => $nb_today,
    'tomorrow' => $nb_tomorrow,
    'types'    => $rows
  ];
}




function svc_type_activite_quotidienne_list(WP_REST_Request $req){
  global $wpdb;
  $table = $wpdb->prefix . 'recherche_type_activite_quotidienne';

  $rows = $wpdb->get_results("SELECT id, libelle_fr FROM $table WHERE actif=1 ORDER BY ordre_affichage, libelle_fr", ARRAY_A);

  return $rows ?: [];
}


// === activite_scientifique ===
function svc_activite_scientifique_table(){ global $wpdb; return $wpdb->prefix . 'recherche_activite_scientifique'; }
function svc_activite_scientifique_allowed(){ 
  return array('annee','user_id','titre_reference','type_id','Source','piece_jointe_path'); 
}

/*
function svc_activite_scientifique_list(WP_REST_Request $req){
  global $wpdb; 
  $table       = svc_activite_scientifique_table();
  $table_types = $wpdb->prefix . "recherche_type_activite_scientifique";
  $table_labo  = $wpdb->prefix . "recherche_laboratoire";
  $table_membre= $wpdb->prefix . "recherche_membre";
  $users       = $wpdb->users;
  $usermeta    = $wpdb->usermeta;

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $uid   = get_current_user_id();
  $roles = (array) wp_get_current_user()->roles;

  // Base SELECT enrichi
  $sql_base = "
    SELECT DISTINCT a.*,
           t.libelle_fr AS type_libelle,
           u.display_name,
           fn.meta_value AS first_name,
           ln.meta_value AS last_name,
           l.id AS laboratoire_id,
           l.directeur_user_id
    FROM $table a
    LEFT JOIN $table_types t ON t.id = a.type_id
    LEFT JOIN $users u       ON u.ID = a.user_id
    LEFT JOIN $usermeta fn   ON (u.ID = fn.user_id AND fn.meta_key = 'first_name')
    LEFT JOIN $usermeta ln   ON (u.ID = ln.user_id AND ln.meta_key = 'last_name')
    LEFT JOIN $table_membre m ON m.user_id = a.user_id
    LEFT JOIN $table_labo l   ON l.id = m.laboratoire_id
  ";

  if (in_array('um_service_utm', $roles) || in_array('um_service_etablissement', $roles)) {
    // Service → pas de restriction
    $sql = $wpdb->prepare($sql_base . " ORDER BY a.id DESC LIMIT %d OFFSET %d", $per, $off);
  } else {
    // Cas chercheur ou directeur
    // 1. Chercher le(s) labo(s) du user connecté
    $labo_ids = $wpdb->get_col($wpdb->prepare(
      "SELECT laboratoire_id FROM $table_membre WHERE user_id = %d", $uid
    ));

    // 2. Si user est directeur, ajouter aussi son labo
    $directeur_labo_ids = $wpdb->get_col($wpdb->prepare(
      "SELECT id FROM $table_labo WHERE directeur_user_id = %d", $uid
    ));
    $all_labo_ids = array_unique(array_merge($labo_ids, $directeur_labo_ids));

    if (!empty($all_labo_ids)) {
      $placeholders = implode(',', array_fill(0, count($all_labo_ids), '%d'));
      $sql = $wpdb->prepare(
        $sql_base . " WHERE (a.user_id = %d OR m.laboratoire_id IN ($placeholders) OR l.directeur_user_id = %d)
                      ORDER BY a.id DESC LIMIT %d OFFSET %d",
        array_merge([$uid], $all_labo_ids, [$uid, $per, $off])
      );
    } else {
      // Aucun labo → juste ses activités
      $sql = $wpdb->prepare(
        $sql_base . " WHERE a.user_id = %d ORDER BY a.id DESC LIMIT %d OFFSET %d",
        $uid, $per, $off
      );
    }
  }


  var_dump($sql);

  return $wpdb->get_results($sql, ARRAY_A);
}
*/


function svc_activite_scientifique_list(WP_REST_Request $req){
  global $wpdb; 
  $table       = svc_activite_scientifique_table();
  $table_types = $wpdb->prefix . "recherche_type_activite_scientifique";
  $table_labo  = $wpdb->prefix . "recherche_laboratoire";
  $table_membre= $wpdb->prefix . "recherche_membre";
  $users       = $wpdb->users;
  $usermeta    = $wpdb->usermeta;

  $page = max(1, intval($req->get_param('page') ?: 1));
  $per  = max(1, min(200, intval($req->get_param('per_page') ?: 20)));
  $off  = ($page - 1) * $per;

  $uid   = get_current_user_id();
  $roles = (array) wp_get_current_user()->roles;

  // Base SELECT enrichi
  $sql_base = "
    SELECT DISTINCT a.*,
           t.libelle_fr AS type_libelle,
           u.display_name,
           fn.meta_value AS first_name,
           ln.meta_value AS last_name,
           m.laboratoire_id,      
           l.id AS labo_id,
           l.directeur_user_id    
    FROM $table a
    LEFT JOIN $table_types t ON t.id = a.type_id
    LEFT JOIN $users u       ON u.ID = a.user_id
    LEFT JOIN $usermeta fn   ON (u.ID = fn.user_id AND fn.meta_key = 'first_name')
    LEFT JOIN $usermeta ln   ON (u.ID = ln.user_id AND ln.meta_key = 'last_name')
    LEFT JOIN $table_labo l ON l.directeur_user_id = a.user_id
    LEFT JOIN $table_membre m ON m.user_id = a.user_id

  ";



  if (in_array('um_service_utm', $roles) || in_array('um_service_etablissement', $roles)) {
    $sql = $wpdb->prepare($sql_base . " ORDER BY a.id DESC LIMIT %d OFFSET %d", $per, $off);
  } else {

    if (in_array('um_chercheur', $roles)){
  // Cas chercheur ou directeur
      $labo_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT laboratoire_id FROM $table_membre WHERE user_id = %d LIMIT  1", $uid
      ));
    }
    elseif (in_array('um_directeur_laboratoire', $roles)){
    // Cas chercheur ou directeur
        $labo_ids = $wpdb->get_col($wpdb->prepare(
          "SELECT id FROM $table_labo WHERE directeur_user_id= %d LIMIT  1", $uid
        ));
      }
   



  /*  $directeur_labo_ids = $wpdb->get_col($wpdb->prepare(
      "SELECT id FROM $table_labo WHERE directeur_user_id = %d", $uid
    ));*/

 //   $all_labo_ids = array_unique(array_merge($labo_ids, $directeur_labo_ids));

     $all_labo_id = $labo_ids[0];


    if (!empty($all_labo_id)) {
     // $placeholders = implode(',', array_fill(0, count($all_labo_ids), '%d'));

      // on répète la liste 2 fois car on l’utilise pour m.laboratoire_id et l.directeur_user_id
   //   $params = array_merge([$uid], $all_labo_ids, $all_labo_ids, [$per, $off]);

    
   $sql = $wpdb->prepare(
    $sql_base . " 
    WHERE (a.user_id = %d 
          OR m.laboratoire_id = %d
          OR l.directeur_user_id = %d
          OR l.id = %d)
    ORDER BY a.id DESC LIMIT %d OFFSET %d",
    $uid, $all_labo_id, $all_labo_id, $all_labo_id, $per, $off
  );





   


    } else {
      $sql = $wpdb->prepare(
        $sql_base . " WHERE a.user_id = %d ORDER BY a.id DESC LIMIT %d OFFSET %d",
        $uid, $per, $off
      );
    }
  }




  error_log("SQL activités = " . $sql);

  return $wpdb->get_results($sql, ARRAY_A);
}



function svc_activite_scientifique_get(WP_REST_Request $req){ 
  global $wpdb; 
  $table       = svc_activite_scientifique_table(); 
  $table_type  = $wpdb->prefix . 'recherche_type_activite_scientifique';
  $users       = $wpdb->users;
  $usermeta    = $wpdb->usermeta;

  $id = intval($req['id']);

  $sql = $wpdb->prepare("
      SELECT a.*,
             t.libelle_fr AS type_libelle,
             t.code       AS type_code,
             u.ID         AS auteur_id,
             u.user_email AS auteur_email,
             um1.meta_value AS first_name,
             um2.meta_value AS last_name,
             CONCAT(COALESCE(um1.meta_value,''),' ',COALESCE(um2.meta_value,'')) AS auteur_principal
      FROM $table a
      LEFT JOIN $table_type t ON a.type_id = t.id
      LEFT JOIN $users u      ON a.user_id = u.ID
      LEFT JOIN $usermeta um1 ON (u.ID = um1.user_id AND um1.meta_key = 'first_name')
      LEFT JOIN $usermeta um2 ON (u.ID = um2.user_id AND um2.meta_key = 'last_name')
      WHERE a.id = %d
  ", $id);

  $row = $wpdb->get_row($sql, ARRAY_A);

  if(!$row) {
    return new WP_Error('not_found','Activité scientifique introuvable',['status'=>404]);
  }

  return $row;
}



/*
function svc_activite_scientifique_create(WP_REST_Request $req){
  global $wpdb; 
  $table   = svc_activite_scientifique_table(); 
  $allowed = svc_activite_scientifique_allowed();

  $data = $req->get_params();
  $ins  = array();

  foreach ($allowed as $k){
    if(isset($data[$k])){
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }

  // 📂 Gestion du fichier upload
  if (!empty($_FILES['piece_jointe']['name'])) {
    $upload_dir = WP_CONTENT_DIR . '/recherche/activites/';
    $upload_url = content_url('recherche/activites/');

    if (!file_exists($upload_dir)) {
      wp_mkdir_p($upload_dir);
    }

    $filename   = sanitize_file_name($_FILES['piece_jointe']['name']);
    $targetPath = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $targetPath)) {
      $ins['piece_jointe_path'] = $upload_url . $filename;
    }
  }

  if(empty($ins)) return new WP_Error('bad_request','No valid fields',['status'=>400]);

  $ok = $wpdb->insert($table, $ins);
  if(!$ok) return new WP_Error('db_error','Insert failed',['status'=>500]);

  $id = $wpdb->insert_id; 
  return ['id'=>$id] + $ins;
}
*/


function svc_activite_scientifique_create(WP_REST_Request $req){
  global $wpdb; 
  $table   = svc_activite_scientifique_table(); 
  $allowed = svc_activite_scientifique_allowed();
  $table_membre= $wpdb->prefix . "recherche_membre";

  $data = $req->get_params();
  $ins  = array();

  foreach ($allowed as $k){
    if(isset($data[$k]) && $k !== 'user_id'){
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $ins[$k] = $v;
    }
  }

  // ✅ Forcer user_id = utilisateur connecté
  $ins['user_id'] = get_current_user_id();
  if (!$ins['user_id']) {
    return new WP_Error('not_logged_in', 'Vous devez être connecté pour créer une activité.', ['status'=>401]);
  }

  // 📂 Gestion du fichier upload
  if (!empty($_FILES['piece_jointe']['name'])) {
    $upload_dir = WP_CONTENT_DIR . '/recherche/activites/';
    $upload_url = content_url('recherche/activites/');

    if (!file_exists($upload_dir)) {
      wp_mkdir_p($upload_dir);
    }

    $filename   = time() . '-' . sanitize_file_name($_FILES['piece_jointe']['name']); // 🔥 unique
    $targetPath = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $targetPath)) {
      $ins['piece_jointe_path'] = $upload_url . $filename;
    } else {
      return new WP_Error('upload_error','Impossible de sauvegarder le fichier',['status'=>500]);
    }
  }

  if(empty($ins)) {
    return new WP_Error('bad_request','No valid fields',['status'=>400]);
  }

  $ok = $wpdb->insert($table, $ins);
  if(!$ok) return new WP_Error('db_error','Insert failed',['status'=>500]);

  $id = $wpdb->insert_id; 

   // ===============================
  // Notification directeur labo
  // ===============================
  $user_id = get_current_user_id();
    $user    = wp_get_current_user();
    $roles = (array) wp_get_current_user()->roles;

   if (in_array('um_chercheur', $roles)){
    // Cas chercheur ou directeur
      $labo_id = $wpdb->get_col($wpdb->prepare(
        "SELECT laboratoire_id FROM $table_membre WHERE user_id = %d LIMIT  1", $user_id
      ));
    }

    $labo_id=$labo_id[0];




  if (!empty($labo_id)){
      $labo_table = $wpdb->prefix . 'recherche_laboratoire';

      $directeur_id = $wpdb->get_var($wpdb->prepare(
          "SELECT directeur_user_id
           FROM $labo_table WHERE id=%d", $labo_id
      ));

      if ($directeur_id) {
          add_notification2(
              $directeur_id,
              "Une nouvelle activité scientifique a été créée dans votre laboratoire (ID activité : $id).",
              "activite_scientifique"
          );
      }
  }

  return ['id'=>$id] + $ins;
}

function add_notification2($user_id, $message, $type = 'info'){
  global $wpdb;
  $notif_table = $wpdb->prefix . 'recherche_notification';

  $data = [
    'user_id'    => intval($user_id),
    'message'    => sanitize_text_field($message),
    'type'       => sanitize_text_field($type),
    'lu'         => 0,
    'created_at' => current_time('mysql')
  ];

  $ok = $wpdb->insert($notif_table, $data);

  if ($ok === false) {
    error_log('[add_notification2] DB ERROR: '.$wpdb->last_error);
    error_log('[add_notification2] SQL: '.$wpdb->last_query);
  } else {
    error_log("[add_notification2] Notification ajoutée ID={$wpdb->insert_id} pour user {$user_id}");
  }

  return $ok ? $wpdb->insert_id : false;
}



/*
function svc_activite_scientifique_update(WP_REST_Request $req){
  global $wpdb; 
  $table   = svc_activite_scientifique_table(); 
  $allowed = svc_activite_scientifique_allowed();

  $id   = intval($req['id']); 
  $data = svc_read_input2($req); 
  $upd  = array();

  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $upd[$k]=$v;
    }
  }

  if(empty($upd)) return new WP_Error('bad_request','No valid fields',['status'=>400]);

  $ok = $wpdb->update($table, $upd, ['id'=>$id]);
  if($ok===false) return new WP_Error('db_error','Update failed',['status'=>500]);

  return ['id'=>$id] + $upd;
}
*/

function svc_activite_scientifique_update(WP_REST_Request $req){
  global $wpdb; 
  $table   = svc_activite_scientifique_table(); 
  $allowed = svc_activite_scientifique_allowed();

  $id   = intval($req['id']); 
  $data = $req->get_params(); 
  $upd  = array();

  foreach ($allowed as $k){
    if(array_key_exists($k,$data)){
      $v = is_scalar($data[$k]) ? sanitize_text_field($data[$k]) : wp_json_encode($data[$k]);
      $upd[$k] = $v;
    }
  }

  // 📂 Gestion du fichier upload (comme dans create)
  if (!empty($_FILES['piece_jointe']['name'])) {
    $upload_dir = WP_CONTENT_DIR . '/recherche/activites/';
    $upload_url = content_url('recherche/activites/');

    if (!file_exists($upload_dir)) {
      wp_mkdir_p($upload_dir);
    }

    $filename   = sanitize_file_name($_FILES['piece_jointe']['name']);
    $targetPath = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $targetPath)) {
      $upd['piece_jointe_path'] = $upload_url . $filename;
    }
  }

  if(empty($upd)) return new WP_Error('bad_request','No valid fields',['status'=>400]);

  $ok = $wpdb->update($table, $upd, ['id'=>$id]);
  if($ok===false) return new WP_Error('db_error','Update failed',['status'=>500]);

  return ['id'=>$id] + $upd;
}


function svc_activite_scientifique_delete(WP_REST_Request $req){
  global $wpdb; 
  $table = svc_activite_scientifique_table(); 
  $id = intval($req['id']);

  $ok = $wpdb->delete($table, ['id'=>$id]);
  if(!$ok) return new WP_Error('db_error','Delete failed',['status'=>500]);

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
if (!function_exists('svc_equipement_images_table')) {
    function svc_equipement_images_table() { global $wpdb; return $wpdb->prefix . 'recherche_equipement_images'; }
}
// Champs autorisés (alignés BD)


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

function svc_equipement_list(WP_REST_Request $req) {
    global $wpdb;
    $t  = svc_equipement_table();
    $tc = svc_categorie_table();
    $td = svc_dispo_table();
    $tp = svc_equipement_protocole_table();
    $ti = svc_equipement_images_table(); // New table

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
    if (!$all && !current_user_can('manage_options')) {
        $where[] = "e.user_id = %d";
        $args[]  = absint($uid);
    }

    if ($all) {
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
               p.fichier   AS protocole_fichier,
               GROUP_CONCAT(i.image_url) AS images
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
        LEFT JOIN $ti i ON i.id_recherche_equipement = e.id
    ";
    if ($where) { $sql .= " WHERE ".implode(" AND ", $where); }
    $sql .= " GROUP BY e.id ORDER BY e.id DESC LIMIT %d OFFSET %d";

    $args[] = $per; 
    $args[] = $off;

    $query  = $wpdb->prepare($sql, $args);
    $results = $wpdb->get_results($query, ARRAY_A);
    // Convert GROUP_CONCAT to array
    foreach ($results as &$row) {
        $row['images'] = $row['images'] ? explode(',', $row['images']) : [];
    }
    return $results;
}




// GET
function svc_equipement_get(WP_REST_Request $req) {
    global $wpdb;
    $t  = svc_equipement_table();
    $ti = svc_equipement_images_table(); // New table
    $id = absint($req['id']);
    $sql = "
        SELECT e.*, GROUP_CONCAT(i.image_url) AS images
        FROM $t e
        LEFT JOIN $ti i ON i.id_recherche_equipement = e.id
        WHERE e.id = %d
        GROUP BY e.id
    ";
    $row = $wpdb->get_row($wpdb->prepare($sql, $id), ARRAY_A);
    if (!$row) return new WP_Error('not_found', 'Not found', array('status' => 404));
    $row['images'] = $row['images'] ? explode(',', $row['images']) : [];
    return $row;
}
function svc_conditions_entretien_table(){ global $wpdb; return $wpdb->prefix . 'recherche_conditions_entretien'; }

// CREATE
// Remplace ta fonction par celle-ci
function svc_equipement_create(WP_REST_Request $req) {
    global $wpdb;
    $t  = svc_equipement_table();
    $tp = svc_equipement_protocole_table();
    $te = svc_conditions_entretien_table();
    $ti = svc_equipement_images_table(); // New table
    $allowed = svc_equipement_allowed();

    // --- user connecté obligatoire ---
    $uid = get_current_user_id();
    if (!$uid) {
        return new WP_Error('forbidden', 'Authentication required', array('status' => 401));
    }

    // Lis JSON body / form-data
    $data = function_exists('svc_read_input2') ? svc_read_input2($req) : ($req->get_json_params() ?: $req->get_params());
    if (!is_array($data)) $data = array();

    // 1) Prépare insert "équipement"
    $ins = array();
    foreach ($allowed as $k) {
        if (array_key_exists($k, $data)) {
            $v = $data[$k];
            if (in_array($k, array('categorie_id', 'disponibilite_id'))) { $ins[$k] = absint($v); }
            else { $ins[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v); }
        }
    }
    // Forcer le user_id côté serveur
    $ins['user_id'] = absint($uid);

    if (empty($ins)) return new WP_Error('bad_request', 'No valid fields', array('status' => 400));

    $fmt = array();
    foreach ($ins as $k => $_) {
        $fmt[] = in_array($k, array('categorie_id', 'disponibilite_id', 'user_id')) ? '%d' : '%s';
    }

    // 2) Champs "liés" (optionnels) reçus dans la même requête
    $protocole_fichier = isset($data['protocole_fichier']) ? sanitize_text_field($data['protocole_fichier']) : '';
    $contrat_fichier   = isset($data['contrat_fichier'])   ? sanitize_text_field($data['contrat_fichier'])   : '';
    $periodicite       = isset($data['periodicite'])       ? sanitize_text_field($data['periodicite'])       : '';
    $consignes         = isset($data['consignes'])         ? sanitize_text_field($data['consignes'])         : '';
    $images            = isset($data['images']) && is_array($data['images']) ? array_map('sanitize_text_field', $data['images']) : [];

    // 3) Transaction
    $wpdb->query('START TRANSACTION');

    // 3.1 Insert équipement
    $ok = $wpdb->insert($t, $ins, $fmt);
    if (!$ok) {
        $wpdb->query('ROLLBACK');
        return new WP_Error('db_error', 'Insert equipement failed', array('status' => 500));
    }
    $equipement_id = intval($wpdb->insert_id);

    // 3.2 Insert protocole si fourni
    $protocole_id = null;
    if ($protocole_fichier !== '') {
        $okp = $wpdb->insert(
            $tp,
            array('id_recherche_equipement' => $equipement_id, 'fichier' => $protocole_fichier),
            array('%d', '%s')
        );
        if (!$okp) {
            $wpdb->query('ROLLBACK');
            return new WP_Error('db_error', 'Insert protocole failed', array('status' => 500));
        }
        $protocole_id = intval($wpdb->insert_id);
    }

    // 3.3 Insert conditions d’entretien si fourni
    $entretien_id = null;
    if ($periodicite !== '' || $consignes !== '' || $contrat_fichier !== '') {
        $oke = $wpdb->insert(
            $te,
            array(
                'id_recherche_equipement' => $equipement_id,
                'periodicite'             => $periodicite,
                'consignes'               => $consignes,
                'fichier_contrat'         => $contrat_fichier
            ),
            array('%d', '%s', '%s', '%s')
        );
        if (!$oke) {
            $wpdb->query('ROLLBACK');
            return new WP_Error('db_error', 'Insert conditions_entretien failed', array('status' => 500));
        }
        $entretien_id = intval($wpdb->insert_id);
    }

    // 3.4 Insert images if provided
    if (!empty($images)) {
        foreach ($images as $image_url) {
            $oki = $wpdb->insert(
                $ti,
                array('id_recherche_equipement' => $equipement_id, 'image_url' => $image_url),
                array('%d', '%s')
            );
            if (!$oki) {
                $wpdb->query('ROLLBACK');
                return new WP_Error('db_error', 'Insert image failed', array('status' => 500));
            }
        }
    }

    // 3.5 Commit
    $wpdb->query('COMMIT');

    // 4) Réponse
    return array(
        'id' => $equipement_id
    ) + $ins + array(
        'protocole_id'  => $protocole_id,
        'entretien_id'  => $entretien_id
    );
}


// UPDATE
function svc_equipement_update(WP_REST_Request $req) {
    global $wpdb;
    $t  = svc_equipement_table();
    $ti = svc_equipement_images_table(); // New table
    $allowed = svc_equipement_allowed();
    $id = absint($req['id']);
    $data = svc_read_input2($req);
    $upd = array();

    foreach ($allowed as $k) {
        if (array_key_exists($k, $data)) {
            $v = $data[$k];
            if (in_array($k, array('categorie_id', 'disponibilite_id'))) { $upd[$k] = absint($v); }
            else { $upd[$k] = is_scalar($v) ? sanitize_text_field($v) : wp_json_encode($v); }
        }
    }
    if (empty($upd)) return new WP_Error('bad_request', 'No valid fields', array('status' => 400));

    $fmt = array();
    foreach ($upd as $k => $_) { $fmt[] = in_array($k, array('categorie_id', 'disponibilite_id')) ? '%d' : '%s'; }
    $ok = $wpdb->update($t, $upd, array('id' => $id), $fmt, array('%d'));
    if ($ok === false) return new WP_Error('db_error', 'Update failed', array('status' => 500));

    // Handle new images
    if (isset($data['new_images']) && is_array($data['new_images'])) {
        $wpdb->query('START TRANSACTION');
        try {
            foreach ($data['new_images'] as $image_url) {
                $oki = $wpdb->insert(
                    $ti,
                    array('id_recherche_equipement' => $id, 'image_url' => sanitize_text_field($image_url)),
                    array('%d', '%s')
                );
                if (!$oki) {
                    $wpdb->query('ROLLBACK');
                    return new WP_Error('db_error', 'Insert new image failed', array('status' => 500));
                }
            }
            $wpdb->query('COMMIT');
        } catch (Exception $e) {
            $wpdb->query('ROLLBACK');
            return new WP_Error('db_error', 'Transaction failed: ' . $e->getMessage(), array('status' => 500));
        }
    }

    return array('id' => $id) + $upd;
}

// DELETE
function svc_equipement_delete(WP_REST_Request $req) {
    global $wpdb;

    // tables
    $t  = svc_equipement_table();
    $tp = function_exists('svc_equipement_protocole_table') ? svc_equipement_protocole_table() : $wpdb->prefix . 'recherche_equipement_protocole';
    $te = function_exists('svc_conditions_entretien_table') ? svc_conditions_entretien_table() : $wpdb->prefix . 'recherche_conditions_entretien';
    $tm = function_exists('svc_maintenance_table') ? svc_maintenance_table() : $wpdb->prefix . 'recherche_maintenance';
    $ti = svc_equipement_images_table(); // New table

    $id  = absint($req['id']);
    $uid = get_current_user_id();
    if (!$uid) return new WP_Error('forbidden', 'Authentication required', ['status' => 401]);

    // Vérifier que l’équipement existe
    $exists = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d", $id));
    if (!$exists) return new WP_Error('not_found', 'Not found', ['status' => 404]);

    // Ownership: admin voit tout, sinon l’équipement doit appartenir au user courant
    if (!current_user_can('manage_options')) {
        $own = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(1) FROM $t WHERE id=%d AND user_id=%d", $id, $uid));
        if (!$own) return new WP_Error('forbidden', 'Not your equipment', ['status' => 403]);
    }

    // Transaction
    $wpdb->query('START TRANSACTION');

    try {
        // 1) Supprimer images
        $wpdb->delete($ti, ['id_recherche_equipement' => $id], ['%d']);

        // 2) Supprimer conditions d’entretien
        $wpdb->delete($te, ['id_recherche_equipement' => $id], ['%d']);

        // 3) Supprimer protocoles d'utilisation
        $wpdb->delete($tp, ['id_recherche_equipement' => $id], ['%d']);

        // 4) Supprimer maintenances liées
        $wpdb->query($wpdb->prepare("DELETE FROM $tm WHERE equipement_id = %s", (string)$id));

        // 5) (Optionnel) si tu as une table contrat liée
        if (function_exists('svc_equipement_contrat_table')) {
            $tcontrat = svc_equipement_contrat_table();
            $wpdb->query($wpdb->prepare("DELETE FROM $tcontrat WHERE id_recherche_equipement = %d", $id));
        }

        // 6) Supprimer l’équipement
        $ok = $wpdb->delete($t, ['id' => $id], ['%d']);
        if (!$ok) {
            $wpdb->query('ROLLBACK');
            return new WP_Error('db_error', 'Delete equipment failed', ['status' => 500]);
        }

        // 7) Commit
        $wpdb->query('COMMIT');

        return new WP_REST_Response(null, 204);
    } catch (Throwable $e) {
        $wpdb->query('ROLLBACK');
        error_log('[svc_equipement_delete] ' . $e->getMessage());
        return new WP_Error('db_error', 'Delete failed', ['status' => 500]);
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



// ========== TABLE HELPER ==========
function svc_rapport_table() {
    global $wpdb;
    return $wpdb->prefix . "recherche_rapport";
}

// ========== LIST ==========
function svc_rapport_list($args = []) {
    global $wpdb;
    $table = svc_rapport_table();

    $sql = "SELECT * FROM $table ORDER BY id DESC";
    return $wpdb->get_results($sql, ARRAY_A);
}

// ========== GET ==========
function svc_rapport_get($id) {
    global $wpdb;
    $table = svc_rapport_table();
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
}




// ========== DELETE ==========
function svc_rapport_delete($id) {
    global $wpdb;
    $table = svc_rapport_table();
    return $wpdb->delete($table, ['id' => intval($id)]);
}

// ========== CREATE ==========
function svc_rapport_create($data) {
    global $wpdb;
    $table = svc_rapport_table();
     $table_labo  = $wpdb->prefix . "recherche_laboratoire";
    $table_membre= $wpdb->prefix . "recherche_membre";

    $user_id = get_current_user_id();
    $user    = wp_get_current_user();
    $roles   = (array) $user->roles;

    if (in_array('um_chercheur', $roles)){
    // Cas chercheur ou directeur
      $labo_id = $wpdb->get_col($wpdb->prepare(
        "SELECT laboratoire_id FROM $table_membre WHERE user_id = %d LIMIT  1", $user_id
      ));
    }
    elseif (in_array('um_directeur_laboratoire', $roles)){
    // Cas chercheur ou directeur
        $labo_id = $wpdb->get_col($wpdb->prepare(
          "SELECT id FROM $table_labo WHERE directeur_user_id= %d LIMIT  1", $user_id
        ));
      }
   

    // Générer fichier PDF
    $fichier_url = svc_generate_labo_report_pdf($labo_id, $user_id);

    $wpdb->insert($table, [
        'code'            => sanitize_text_field($data['code']),
        'type_rapport'    => sanitize_text_field($data['type_rapport']),
        'frequence'       => sanitize_text_field($data['frequence']),
        'date_generation' => sanitize_text_field($data['date_generation']),
        'service'         => sanitize_text_field($data['service']),
        'laboratoire_id'  => $labo_id,
        'user_id'         => $user_id,
        'fichier_url'     => $fichier_url,
    ]);

    return $wpdb->insert_id;
}
/*
function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // === Infos labo ===
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name as directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON l.directeur_user_id = u.ID
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);

    if (!$labo) {
        return new WP_Error('not_found', 'Laboratoire introuvable', ['status'=>404]);
    }

    // === Stats ===
    $stats_publications = (int)$wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->prefix}recherche_publication WHERE laboratoire_id=%d", 
        $laboratoire_id
    ));

    $stats_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = a.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    $stats_manifestations = (int)$wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->prefix}recherche_manifestation WHERE laboratoire_id=%d", 
        $laboratoire_id
    ));

    $stats_reservations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_reservation r
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = r.created_by
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // === Dossier stockage ===
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);

    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/" . $filename;

    // === Génération PDF avec FPDF ===
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php"; 
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,"Rapport global du laboratoire {$labo['denomination']}",0,1,'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"Année universitaire : ".date("Y"),0,1);
    $pdf->Cell(0,10,"Directeur : {$labo['directeur_nom']}",0,1);
    $pdf->Cell(0,10,"Date de génération : ".date("d/m/Y"),0,1);
    $pdf->Ln(10);

    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,"Statistiques globales",0,1);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"- Publications : $stats_publications",0,1);
    $pdf->Cell(0,10,"- Activités scientifiques : $stats_activites",0,1);
    $pdf->Cell(0,10,"- Manifestations : $stats_manifestations",0,1);
    $pdf->Cell(0,10,"- Réservations équipements : $stats_reservations",0,1);

    $pdf->Output("F",$filepath);

    return $upload_url . "/" . $filename;
}



function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // === Infos labo + directeur ===
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name as directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON l.directeur_user_id = u.ID
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // === Dossier stockage ===
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);

    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/" . $filename;

    // === Génération PDF ===
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";

    class PDF extends FPDF {
        function RoundedRect($x, $y, $w, $h, $r, $style='') {
            $k = $this->k; $hp = $this->h;
            $op = ($style=='F') ? 'f' : (($style=='FD' || $style=='DF') ? 'B' : 'S');
            $MyArc = 4/3 * (sqrt(2) - 1);
            $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
            $xc = $x+$w-$r; $yc = $y+$r;
            $this->_out(sprintf('%.2F %.2F l', $xc*$k, ($hp-$y)*$k ));
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc );
            $xc = $x+$w-$r; $yc = $y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
            $xc = $x+$r; $yc = $y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l', $xc*$k, ($hp-($y+$h))*$k));
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
            $xc = $x+$r; $yc = $y+$r;
            $this->_out(sprintf('%.2F %.2F l', $x*$k, ($hp-$yc)*$k ));
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
            $this->_out($op);
        }
        function _Arc($x1,$y1,$x2,$y2,$x3,$y3){
            $h = $this->h;
            $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
                $x1*$this->k,($h-$y1)*$this->k,
                $x2*$this->k,($h-$y2)*$this->k,
                $x3*$this->k,($h-$y3)*$this->k));
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();

    // --- Cadre arrondi gris clair ---
    $pdf->SetDrawColor(166,164,133); // #A6A485
    $pdf->RoundedRect(10, 10, 190, 35, 5);

    // --- Logo ---
    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) {
      $pdf->Image($logo, 15, 15, 25, 20); // largeur = 25mm, hauteur = 20mm
    }

    // --- Titre au centre ---
    $pdf->SetXY(45, 18);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications - laboratoire de recherche"),0,'C');

    $pdf->SetXY(45, 33);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date("d/m/Y")),0,0,'C');

    // --- Infos à droite ---
    $pdf->SetXY(140, 18);
    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(102,102,102); // gris
    $pdf->Cell(35,6,utf8_decode("Année universitaire : "),0,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(25,6,date("Y")."-".(date("Y")+1),0,1);

    $pdf->SetX(140);
    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,utf8_decode("Laboratoire : "),0,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);

    $pdf->SetX(140);
    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,utf8_decode("Directeur de labo : "),0,0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);

    // Reset couleur texte pour le reste
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(50);

    // Exemple suite
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode("1 - Statistiques globales"),0,1);

    $pdf->Output("F",$filepath);

    return $upload_url . "/" . $filename;
}



function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // === Infos labo + directeur ===
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name as directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON l.directeur_user_id = u.ID
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // === Publications totales du labo ===
    $total_publications = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // === Publications du directeur ===
    $pub_directeur = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_publication p
        WHERE p.user_id = %d
    ", $labo['directeur_user_id']));

    $pub_chercheurs = $total_publications - $pub_directeur;

    // === Répartition par statut ===
    $stats_status = $wpdb->get_results($wpdb->prepare("
        SELECT p.statut, COUNT(*) as nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY p.statut
    ", $laboratoire_id), ARRAY_A);

    $status_counts = ['validées'=>0,'en_attente'=>0,'rejetées'=>0];
    foreach ($stats_status as $r) {
        $key = strtolower(trim($r['statut']));
        if (isset($status_counts[$key])) {
            $status_counts[$key] = (int)$r['nb'];
        }
    }

    // === Dossier de stockage PDF & images ===
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/" . $filename;

    // === Génération PDF ===
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";
    $pdf = new FPDF();
    $pdf->AddPage();

    // --- En-tête ---
    $pdf->SetDrawColor(166,164,133);
    $pdf->Rect(10, 10, 190, 35, 'D');

    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) $pdf->Image($logo, 15, 15, 25, 20);

    $pdf->SetXY(45, 18);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications - laboratoire de recherche"),0,'C');

    $pdf->SetXY(45, 33);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date("d/m/Y")),0,0,'C');

    $pdf->SetXY(140, 18);
    $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Année universitaire : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,date("Y")."-".(date("Y")+1),0,1);

    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Laboratoire : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);

    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Directeur de labo : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);

    $pdf->Ln(45);

    // === Section 1 : Statistiques globales ===
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode("1 - Statistiques globales"),0,1);

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,8,"Total publications enregistrees : ".$total_publications,0,1);
    $pdf->Cell(80,8,"Publications du Directeur : ".$pub_directeur,0,1);
    $pdf->Cell(80,8,"Publications des chercheurs : ".$pub_chercheurs,0,1);

    // === Génération Camembert avec GD ===
    $pie = imagecreatetruecolor(200,200);
    $white = imagecolorallocate($pie,255,255,255);
    imagefill($pie,0,0,$white);
    $colors = [
        imagecolorallocate($pie,166,164,133), // validées
        imagecolorallocate($pie,192,0,0),     // en attente
        imagecolorallocate($pie,100,100,100)  // rejetées
    ];
    $total = array_sum($status_counts) ?: 1;
    $start = 0; $i=0;
    foreach($status_counts as $count){
        $angle = ($count/$total)*360;
        imagefilledarc($pie,100,100,180,180,$start,$start+$angle,$colors[$i],IMG_ARC_PIE);
        $start += $angle; $i++;
    }
    $chartfile = $upload_dir."/chart-".time().".png";
    imagepng($pie,$chartfile);
    imagedestroy($pie);

    // --- Insertion du chart ---
    $pdf->Ln(10);
    if (file_exists($chartfile)) {
        $pdf->Image($chartfile, 100, $pdf->GetY(), 60,60);
    }

    $pdf->Output("F",$filepath);
    return $upload_url . "/" . $filename;
}

*/
/*
function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // === Infos labo + directeur ===
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name as directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON l.directeur_user_id = u.ID
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // === Publications totales ===
    $total_publications = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // === Publications directeur ===
    $pub_directeur = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_publication p
        WHERE p.user_id = %d
    ", $labo['directeur_user_id']));
    $pub_chercheurs = $total_publications - $pub_directeur;

    // === Répartition par statut ===
    $stats_status = $wpdb->get_results($wpdb->prepare("
        SELECT p.statut, COUNT(*) as nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY p.statut
    ", $laboratoire_id), ARRAY_A);

    $status_counts = ['Validées'=>0,'En attente'=>0,'Rejetées'=>0];
    foreach ($stats_status as $r) {
        $key = ucfirst(strtolower(trim($r['statut'])));
        if (isset($status_counts[$key])) {
            $status_counts[$key] = (int)$r['nb'];
        }
    }

    // === Répartition par type de publication ===
    $types_counts = $wpdb->get_results($wpdb->prepare("
        SELECT t.libelle_fr as type, COUNT(*) as nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_type_publication t ON t.id = p.type_id
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY t.libelle_fr
    ", $laboratoire_id), ARRAY_A);

    // === Evolution annuelle ===
    $years_counts = $wpdb->get_results($wpdb->prepare("
        SELECT YEAR(p.date_publication) as annee, COUNT(*) as nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON p.user_id = m.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY YEAR(p.date_publication)
        ORDER BY annee ASC
    ", $laboratoire_id), ARRAY_A);

    // Activités scientifiques
    $stats_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = a.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Manifestations
    $stats_manifestations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_manifestation 
        WHERE laboratoire_id = %d
    ", $laboratoire_id));

    // Réservations
    $stats_reservations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->prefix}recherche_reservation r
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = r.created_by
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));


    // === Stockage fichiers ===
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/" . $filename;

    // === QuickChart helper ===
    function qc_chart($config, $path) {
        $url = "https://quickchart.io/chart";
        $postdata = json_encode(['chart'=>$config, 'format'=>'png', 'width'=>600, 'height'=>400]);
        $opts = ['http'=>['method'=>'POST','header'=>"Content-Type: application/json\r\n",'content'=>$postdata]];
        $context = stream_context_create($opts);
        $img = file_get_contents($url, false, $context);
        if ($img) file_put_contents($path, $img);
        return file_exists($path) ? $path : null;
    }

    // --- Chart 1 : Répartition par statut
    $chart1_file = $upload_dir."/chart-status-".time().".png";
    qc_chart([
      'type'=>'pie',
      'data'=>[
        'labels'=>array_keys($status_counts),
        'datasets'=>[['data'=>array_values($status_counts),'backgroundColor'=>['#A6A485','#E74C3C','#7F8C8D']]]
      ]
    ], $chart1_file);

    // --- Chart 2 : Répartition par type
    $chart2_file = $upload_dir."/chart-types-".time().".png";
    qc_chart([
      'type'=>'bar',
      'data'=>[
        'labels'=>array_column($types_counts,'type'),
        'datasets'=>[['label'=>'Publications','data'=>array_column($types_counts,'nb'),'backgroundColor'=>'#3498DB']]
      ],
      'options'=>['plugins'=>['legend'=>['display'=>false]]]
    ], $chart2_file);

    // --- Chart 3 : Evolution annuelle
    $chart3_file = $upload_dir."/chart-years-".time().".png";
    qc_chart([
      'type'=>'line',
      'data'=>[
        'labels'=>array_column($years_counts,'annee'),
        'datasets'=>[['label'=>'Publications','data'=>array_column($years_counts,'nb'),'borderColor'=>'#E67E22','fill'=>false]]
      ]
    ], $chart3_file);

    // === Génération PDF ===
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";
    $pdf = new FPDF();
    $pdf->AddPage();

    // --- En-tête ---
    $pdf->SetDrawColor(166,164,133);
    $pdf->Rect(10, 10, 190, 35, 'D');
    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) $pdf->Image($logo, 15, 15, 25, 20);
    $pdf->SetXY(45, 18);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications - laboratoire de recherche"),0,'C');
    $pdf->SetXY(45, 33);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date("d/m/Y")),0,0,'C');
    $pdf->SetXY(140, 18);
    $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Année universitaire : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,date("Y")."-".(date("Y")+1),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Laboratoire : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(102,102,102);
    $pdf->Cell(35,6,"Directeur de labo : "); 
    $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);
    $pdf->Ln(45);

    // --- Section 1 ---
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode("1 - Statistiques globales"),0,1);
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(100,8,"Total publications : ",0,0); 
    $pdf->Cell(20,8,$total_publications,0,1);

    $pdf->Cell(100,8,"Publications Directeur : ",0,0); 
    $pdf->Cell(20,8,$pub_directeur,0,1);

    $pdf->Cell(100,8,"Publications Chercheurs : ",0,0); 
    $pdf->Cell(20,8,$pub_chercheurs,0,1);

    $pdf->Cell(100,8,"Activités scientifiques : ",0,0); 
    $pdf->Cell(20,8,$stats_activites,0,1);

    $pdf->Cell(100,8,"Manifestations : ",0,0); 
    $pdf->Cell(20,8,$stats_manifestations,0,1);

    $pdf->Cell(100,8,"Réservations équipements : ",0,0); 
    $pdf->Cell(20,8,$stats_reservations,0,1);

    // --- Insertion charts ---
    $pdf->Ln(10);
    if (file_exists($chart1_file)) $pdf->Image($chart1_file, 20, $pdf->GetY(), 80,60);
    if (file_exists($chart2_file)) $pdf->Image($chart2_file, 110, $pdf->GetY(), 80,60);
    $pdf->Ln(65);
    if (file_exists($chart3_file)) $pdf->Image($chart3_file, 20, $pdf->GetY(), 160,70);

    $pdf->Output("F",$filepath);
    return $upload_url . "/" . $filename;
}


function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // ========== 0) INFOS LABO ==========
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name AS directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON u.ID = l.directeur_user_id
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // ========== 1) QUERIES STATS (via membres du labo) ==========
    // Publications totales (labo)
    $total_publications = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Publications Directeur
    $pub_directeur = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}recherche_publication
        WHERE user_id = %d
    ", (int)$labo['directeur_user_id']));
    $pub_chercheurs = max(0, $total_publications - $pub_directeur);

    // Répartition par statut (Validées / En attente / Rejetées)
    $raw_status = $wpdb->get_results($wpdb->prepare("
        SELECT p.statut, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY p.statut
    ", $laboratoire_id), ARRAY_A);
    $status_counts = ['Validées'=>0,'En attente'=>0,'Rejetées'=>0];
    foreach($raw_status as $r){
        $k = ucfirst(strtolower(trim($r['statut'])));
        if (isset($status_counts[$k])) $status_counts[$k] = (int)$r['nb'];
    }

    // Répartition par type
    $types_counts = $wpdb->get_results($wpdb->prepare("
        SELECT COALESCE(t.libelle_fr, 'Autre') AS type, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        LEFT JOIN {$wpdb->prefix}recherche_type_publication t ON t.id = p.type_id
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY COALESCE(t.libelle_fr, 'Autre')
        ORDER BY nb DESC
        LIMIT 6
    ", $laboratoire_id), ARRAY_A);

    // Evolution annuelle
    $years_counts = $wpdb->get_results($wpdb->prepare("
        SELECT YEAR(COALESCE(p.date_publication, p.created_at)) AS annee, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY YEAR(COALESCE(p.date_publication, p.created_at))
        ORDER BY annee ASC
    ", $laboratoire_id), ARRAY_A);

    // Activités scientifiques
    $stats_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = a.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Manifestations
    $stats_manifestations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}recherche_manifestation
        WHERE laboratoire_id = %d
    ", $laboratoire_id));

    // Réservations d'équipements (proprio équipement ∈ labo)
    $stats_reservations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_reservation r
        INNER JOIN {$wpdb->prefix}recherche_equipement e ON e.id = r.resource_id
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = e.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // ========== 2) CHEMINS / HELPERS ==========
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/".$filename;

    // QuickChart helper
    $qc = function(array $config, string $path){
        $url = "https://quickchart.io/chart";
        $payload = json_encode(['chart'=>$config,'format'=>'png','width'=>800,'height'=>520]);
        $ctx = stream_context_create([
            'http'=>[
                'method'=>'POST',
                'header'=>"Content-Type: application/json\r\n",
                'content'=>$payload,
                'timeout'=>10
            ]
        ]);
        $img = @file_get_contents($url, false, $ctx);
        if ($img) file_put_contents($path, $img);
        return file_exists($path) ? $path : null;
    };

    // Palette proche du modèle
    $C_KAKI = '#A6A485'; $C_ROUGE = '#BF0404'; $C_GRIS = '#7F8C8D'; $C_BLEU = '#3498DB'; $C_ORANGE='#E67E22';

    // Chart 1: Pie Statut
    $chart_status_file = $upload_dir.'/chart-status-'.time().'.png';
    $qc([
        'type'=>'pie',
        'data'=>[
            'labels'=>array_keys($status_counts),
            'datasets'=>[[
                'data'=>array_values($status_counts),
                'backgroundColor'=>[$C_KAKI, $C_ROUGE, $C_GRIS]
            ]]
        ],
        'options'=>[
            'plugins'=>[
                'legend'=>['position'=>'right','labels'=>['boxWidth'=>14,'font'=>['size'=>12]]]
            ]
        ]
    ], $chart_status_file);

    // Chart 2: Bar Types
    $chart_types_file = $upload_dir.'/chart-types-'.time().'.png';
    $qc([
        'type'=>'bar',
        'data'=>[
            'labels'=>array_map(fn($r)=>$r['type'], $types_counts),
            'datasets'=>[[
                'label'=>'Publications',
                'data'=>array_map(fn($r)=> (int)$r['nb'], $types_counts),
                'backgroundColor'=>$C_ROUGE
            ]]
        ],
        'options'=>[
            'scales'=>['y'=>['beginAtZero'=>true]],
            'plugins'=>['legend'=>['display'=>false]]
        ]
    ], $chart_types_file);

    // Chart 3: Line Evolution
    $chart_years_file = $upload_dir.'/chart-years-'.time().'.png';
    $qc([
        'type'=>'line',
        'data'=>[
            'labels'=>array_map(fn($r)=> (string)$r['annee'], $years_counts),
            'datasets'=>[[
                'label'=>'Publications',
                'data'=>array_map(fn($r)=> (int)$r['nb'], $years_counts),
                'borderColor'=>$C_ORANGE,
                'backgroundColor'=>'rgba(230,126,34,0.12)',
                'fill'=>true,
                'tension'=>0.3,
                'pointRadius'=>3
            ]]
        ],
        'options'=>[
            'plugins'=>['legend'=>['display'=>false]],
            'scales'=>[
                'y'=>['beginAtZero'=>true]
            ]
        ]
    ], $chart_years_file);

    // ========== 3) PDF (FPDF) ==========
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";

    class R2PDF extends FPDF {
        function roundedRect($x,$y,$w,$h,$r,$style='S'){
            $k=$this->k; $hp=$this->h; $op=($style=='F')?'f':(($style=='FD'||$style=='DF')?'B':'S');
            $MyArc = 4/3*(sqrt(2)-1);
            $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k));
            $xc=$x+$w-$r; $yc=$y+$r;
            $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-$y)*$k));
            $this->_Arc($xc+$r*$MyArc,$yc-$r,$xc+$r,$yc-$r*$MyArc,$xc+$r,$yc);
            $xc=$x+$w-$r; $yc=$y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
            $this->_Arc($xc+$r,$yc+$r*$MyArc,$xc+$r*$MyArc,$yc+$r,$xc,$yc+$r);
            $xc=$x+$r; $yc=$y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
            $this->_Arc($xc-$r*$MyArc,$yc+$r,$xc-$r,$yc+$r*$MyArc,$xc-$r,$yc);
            $xc=$x+$r; $yc=$y+$r;
            $this->_out(sprintf('%.2F %.2F l',$x*$k,($hp-$yc)*$k));
            $this->_Arc($xc-$r,$yc-$r*$MyArc,$xc-$r*$MyArc,$yc-$r,$xc,$yc-$r);
            $this->_out($op);
        }
        function _Arc($x1,$y1,$x2,$y2,$x3,$y3){
            $h=$this->h;
            $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
                $x1*$this->k,($h-$y1)*$this->k,$x2*$this->k,($h-$y2)*$this->k,$x3*$this->k,($h-$y3)*$this->k));
        }
        function card($x,$y,$w,$h,$label,$value){
            // carte style "rapport 2"
            $this->SetDrawColor(230,228,216);
            $this->SetFillColor(247,244,236);
            $this->roundedRect($x,$y,$w,$h,5,'FD');
            $this->SetXY($x+8,$y+8);
            $this->SetFont('Arial','B',10);
            $this->Cell($w-16,6,utf8_decode($label),0,2);
            $this->SetFont('Arial','B',16);
            $this->SetTextColor(42,41,22); // #2A2916
            $this->SetXY($x+$w-32,$y+($h/2)-8);
            $this->Cell(24,10,$value,0,0,'C');
            $this->SetTextColor(0,0,0);
        }
    }

    $pdf = new R2PDF();
    $pdf->AddPage();

    // ---- Entête style Rapport 2 ----
    $pdf->SetDrawColor(166,164,133);           // #A6A485
    $pdf->roundedRect(10,10,190,35,6,'');
    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) $pdf->Image($logo, 15, 15, 28, 0);
    $pdf->SetXY(48, 18);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications - laboratoire de recherche"),0,'C');
    $pdf->SetXY(48, 33); $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date("d/m/Y")),0,0,'C');
    $pdf->SetXY(140,18);
    $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Année universitaire : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,date('Y').'-'.(date('Y')+1),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Laboratoire : "),0,0);        $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Directeur de labo : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(10);

    // ---- Bloc 1: Statistiques globales (cartes + camembert) ----
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode("1 - Statistiques globales"),0,1);

    // 3 cartes à gauche
    $pdf->card(15, 58, 70, 30, "Total publications enregistrées", $total_publications);
    $pdf->card(15, 93, 70, 30, "Publications du Directeur de labo", $pub_directeur);
    $pdf->card(15, 128,70, 30, "Publications des chercheurs", $pub_chercheurs);

    // camembert à droite + légende
    $pdf->SetXY(95, 60);
    if (file_exists($chart_status_file)) $pdf->Image($chart_status_file, 95, 60, 80, 0);
    $pdf->SetXY(95, 118);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(100,5,utf8_decode(
        "La majorité des publications sont validées ("
        .( $total_publications ? round($status_counts['Validées']*100/$total_publications) : 0)
        ."%), les demandes en attente représentent "
        .( $total_publications ? round($status_counts['En attente']*100/$total_publications) : 0)
        ."%, et les rejets "
        .( $total_publications ? round($status_counts['Rejetées']*100/$total_publications) : 0)
        ."%.")
    );

    // ---- Bloc 2 & 3: Types + Evolution ----
    $pdf->Ln(8);
    $yStart = $pdf->GetY();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(95,8,utf8_decode("2 - Répartition par type de publication"),0,0);
    $pdf->Cell(95,8,utf8_decode("3 - Évolution annuelle des publications"),0,1);

    if (file_exists($chart_types_file)) $pdf->Image($chart_types_file, 15, $yStart+10, 90, 0);
    if (file_exists($chart_years_file)) $pdf->Image($chart_years_file, 110, $yStart+10, 90, 0);

    $pdf->Ln(80);

    // ---- Complément: autres indicateurs ----
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,7,utf8_decode("Activités scientifiques : "),0,0); $pdf->Cell(20,7,$stats_activites,0,1);
    $pdf->Cell(80,7,utf8_decode("Manifestations : "),0,0);          $pdf->Cell(20,7,$stats_manifestations,0,1);
    $pdf->Cell(80,7,utf8_decode("Réservations équipements : "),0,0);$pdf->Cell(20,7,$stats_reservations,0,1);

    // ---- Générer le PDF ----
    $pdf->Output('F', $filepath);
    return $upload_url . "/".$filename;
}

function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    // ========== 0) INFOS LABO ==========
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name AS directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON u.ID = l.directeur_user_id
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // ========== 1) QUERIES STATS (via membres du labo) ==========
    // Publications totales (labo)
    $total_publications = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Publications Directeur
    $pub_directeur = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}recherche_publication
        WHERE user_id = %d
    ", (int)$labo['directeur_user_id']));
    $pub_chercheurs = max(0, $total_publications - $pub_directeur);

    // Répartition par statut (Validées / En attente / Rejetées)
    $raw_status = $wpdb->get_results($wpdb->prepare("
        SELECT p.statut, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY p.statut
    ", $laboratoire_id), ARRAY_A);
    $status_counts = ['Validées'=>0,'En attente'=>0,'Rejetées'=>0];
    foreach($raw_status as $r){
        $k = ucfirst(strtolower(trim($r['statut'])));
        if (isset($status_counts[$k])) $status_counts[$k] = (int)$r['nb'];
    }

    // Répartition par type
    $types_counts = $wpdb->get_results($wpdb->prepare("
        SELECT COALESCE(t.libelle_fr, 'Autre') AS type, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        LEFT JOIN {$wpdb->prefix}recherche_type_publication t ON t.id = p.type_id
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY COALESCE(t.libelle_fr, 'Autre')
        ORDER BY nb DESC
        LIMIT 6
    ", $laboratoire_id), ARRAY_A);

    // Evolution annuelle
    $years_counts = $wpdb->get_results($wpdb->prepare("
        SELECT YEAR(COALESCE(p.date_publication, p.created_at)) AS annee, COUNT(*) nb
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.user_id
        WHERE m.laboratoire_id = %d
        GROUP BY YEAR(COALESCE(p.date_publication, p.created_at))
        ORDER BY annee ASC
    ", $laboratoire_id), ARRAY_A);

    // Activités scientifiques
    $stats_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = a.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Manifestations
    $stats_manifestations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}recherche_manifestation
        WHERE laboratoire_id = %d
    ", $laboratoire_id));

    // Réservations d'équipements (proprio équipement ∈ labo)
    $stats_reservations = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_reservation r
        INNER JOIN {$wpdb->prefix}recherche_equipement e ON e.id = r.resource_id
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = e.user_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // ========== 2) CHEMINS / HELPERS ==========
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath = $upload_dir . "/".$filename;

    // QuickChart helper
    $qc = function(array $config, string $path){
        $url = "https://quickchart.io/chart";
        $payload = json_encode(['chart'=>$config,'format'=>'png','width'=>800,'height'=>520]);
        $ctx = stream_context_create([
            'http'=>[
                'method'=>'POST',
                'header'=>"Content-Type: application/json\r\n",
                'content'=>$payload,
                'timeout'=>10
            ]
        ]);
        $img = @file_get_contents($url, false, $ctx);
        if ($img) file_put_contents($path, $img);
        return file_exists($path) ? $path : null;
    };

    // Palette proche du modèle
    $C_KAKI = '#A6A485'; $C_ROUGE = '#BF0404'; $C_GRIS = '#7F8C8D'; $C_BLEU = '#3498DB'; $C_ORANGE='#E67E22';

    // Chart 1: Pie Statut
    $chart_status_file = $upload_dir.'/chart-status-'.time().'.png';
    $qc([
        'type'=>'pie',
        'data'=>[
            'labels'=>array_keys($status_counts),
            'datasets'=>[[
                'data'=>array_values($status_counts),
                'backgroundColor'=>[$C_KAKI, $C_ROUGE, $C_GRIS]
            ]]
        ],
        'options'=>[
            'plugins'=>[
                'legend'=>['position'=>'right','labels'=>['boxWidth'=>14,'font'=>['size'=>12]]]
            ]
        ]
    ], $chart_status_file);

    // Chart 2: Bar Types
    $chart_types_file = $upload_dir.'/chart-types-'.time().'.png';
    $qc([
        'type'=>'bar',
        'data'=>[
            'labels'=>array_map(fn($r)=>$r['type'], $types_counts),
            'datasets'=>[[
                'label'=>'Publications',
                'data'=>array_map(fn($r)=> (int)$r['nb'], $types_counts),
                'backgroundColor'=>$C_ROUGE
            ]]
        ],
        'options'=>[
            'scales'=>['y'=>['beginAtZero'=>true]],
            'plugins'=>['legend'=>['display'=>false]]
        ]
    ], $chart_types_file);

    // Chart 3: Line Evolution
    $chart_years_file = $upload_dir.'/chart-years-'.time().'.png';
    $qc([
        'type'=>'line',
        'data'=>[
            'labels'=>array_map(fn($r)=> (string)$r['annee'], $years_counts),
            'datasets'=>[[
                'label'=>'Publications',
                'data'=>array_map(fn($r)=> (int)$r['nb'], $years_counts),
                'borderColor'=>$C_ORANGE,
                'backgroundColor'=>'rgba(230,126,34,0.12)',
                'fill'=>true,
                'tension'=>0.3,
                'pointRadius'=>3
            ]]
        ],
        'options'=>[
            'plugins'=>['legend'=>['display'=>false]],
            'scales'=>[
                'y'=>['beginAtZero'=>true]
            ]
        ]
    ], $chart_years_file);

    // ========== 3) PDF (FPDF) ==========
    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";

    class R2PDF extends FPDF {
        function roundedRect($x,$y,$w,$h,$r,$style='S'){
            $k=$this->k; $hp=$this->h; $op=($style=='F')?'f':(($style=='FD'||$style=='DF')?'B':'S');
            $MyArc = 4/3*(sqrt(2)-1);
            $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k));
            $xc=$x+$w-$r; $yc=$y+$r;
            $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-$y)*$k));
            $this->_Arc($xc+$r*$MyArc,$yc-$r,$xc+$r,$yc-$r*$MyArc,$xc+$r,$yc);
            $xc=$x+$w-$r; $yc=$y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
            $this->_Arc($xc+$r,$yc+$r*$MyArc,$xc+$r*$MyArc,$yc+$r,$xc,$yc+$r);
            $xc=$x+$r; $yc=$y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
            $this->_Arc($xc-$r*$MyArc,$yc+$r,$xc-$r,$yc+$r*$MyArc,$xc-$r,$yc);
            $xc=$x+$r; $yc=$y+$r;
            $this->_out(sprintf('%.2F %.2F l',$x*$k,($hp-$yc)*$k));
            $this->_Arc($xc-$r,$yc-$r*$MyArc,$xc-$r*$MyArc,$yc-$r,$xc,$yc-$r);
            $this->_out($op);
        }
        function _Arc($x1,$y1,$x2,$y2,$x3,$y3){
            $h=$this->h;
            $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
                $x1*$this->k,($h-$y1)*$this->k,$x2*$this->k,($h-$y2)*$this->k,$x3*$this->k,($h-$y3)*$this->k));
        }
        function card($x,$y,$w,$h,$label,$value){
            // carte style "rapport 2"
            $this->SetDrawColor(230,228,216);
            $this->SetFillColor(247,244,236);
            $this->roundedRect($x,$y,$w,$h,5,'FD');
            $this->SetXY($x+8,$y+8);
            $this->SetFont('Arial','B',10);
            $this->Cell($w-16,6,utf8_decode($label),0,2);
            $this->SetFont('Arial','B',16);
            $this->SetTextColor(42,41,22); // #2A2916
            $this->SetXY($x+$w-32,$y+($h/2)-8);
            $this->Cell(24,10,$value,0,0,'C');
            $this->SetTextColor(0,0,0);
        }
    }

    $pdf = new R2PDF();
    $pdf->AddPage();

    // ---- Entête style Rapport 2 ----
    $pdf->SetDrawColor(166,164,133);           // #A6A485
    $pdf->roundedRect(10,10,190,35,6,'');
    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) $pdf->Image($logo, 15, 15, 28, 0);
    $pdf->SetXY(48, 18);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications - laboratoire de recherche"),0,'C');
    $pdf->SetXY(48, 33); $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date("d/m/Y")),0,0,'C');
    $pdf->SetXY(140,18);
    $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Année universitaire : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,date('Y').'-'.(date('Y')+1),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Laboratoire : "),0,0);        $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);
    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Directeur de labo : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(10);

    // ---- Bloc 1: Statistiques globales (cartes + camembert) ----
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode("1 - Statistiques globales"),0,1);

    // 3 cartes à gauche
    $pdf->card(15, 58, 70, 30, "Total publications enregistrées", $total_publications);
    $pdf->card(15, 93, 70, 30, "Publications du Directeur de labo", $pub_directeur);
    $pdf->card(15, 128,70, 30, "Publications des chercheurs", $pub_chercheurs);

    // camembert à droite + légende
    $pdf->SetXY(95, 60);
    if (file_exists($chart_status_file)) $pdf->Image($chart_status_file, 95, 60, 80, 0);
    $pdf->SetXY(95, 118);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(100,5,utf8_decode(
        "La majorité des publications sont validées ("
        .( $total_publications ? round($status_counts['Validées']*100/$total_publications) : 0)
        ."%), les demandes en attente représentent "
        .( $total_publications ? round($status_counts['En attente']*100/$total_publications) : 0)
        ."%, et les rejets "
        .( $total_publications ? round($status_counts['Rejetées']*100/$total_publications) : 0)
        ."%.")
    );

    // ---- Bloc 2 & 3: Types + Evolution ----
    $pdf->Ln(8);
    $yStart = $pdf->GetY();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(95,8,utf8_decode("2 - Répartition par type de publication"),0,0);
    $pdf->Cell(95,8,utf8_decode("3 - Évolution annuelle des publications"),0,1);

    if (file_exists($chart_types_file)) $pdf->Image($chart_types_file, 15, $yStart+10, 90, 0);
    if (file_exists($chart_years_file)) $pdf->Image($chart_years_file, 110, $yStart+10, 90, 0);

    $pdf->Ln(80);

    // ---- Complément: autres indicateurs ----
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,7,utf8_decode("Activités scientifiques : "),0,0); $pdf->Cell(20,7,$stats_activites,0,1);
    $pdf->Cell(80,7,utf8_decode("Manifestations : "),0,0);          $pdf->Cell(20,7,$stats_manifestations,0,1);
    $pdf->Cell(80,7,utf8_decode("Réservations équipements : "),0,0);$pdf->Cell(20,7,$stats_reservations,0,1);

    // ---- Générer le PDF ----
    $pdf->Output('F', $filepath);
    return $upload_url . "/".$filename;
}


*/
/*
function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name AS directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON u.ID = l.directeur_user_id
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    // Membres du labo
    $total_membres = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT m.user_id)
        FROM {$wpdb->prefix}recherche_membre m
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    // Publications du labo (via membres)
    $total_publications = (int)$wpdb->get_var($wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=p.user_id
        WHERE m.laboratoire_id=%d
    ", $laboratoire_id)));

    // Activités scientifiques (total)
    $total_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=a.user_id
        WHERE m.laboratoire_id=%d
    ", $laboratoire_id));

    // Activités scientifiques : répartition par type (TOP 6)
    $acts_types = $wpdb->get_results($wpdb->prepare("
        SELECT COALESCE(t.libelle_fr,'Autre') AS type, COUNT(*) AS nb
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=a.user_id
        LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
        WHERE m.laboratoire_id=%d
        GROUP BY COALESCE(t.libelle_fr,'Autre')
        ORDER BY nb DESC
        LIMIT 6
    ", $laboratoire_id), ARRAY_A);

    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename  = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath  = $upload_dir . "/".$filename;

    // helper QuickChart
    $qc = function(array $cfg, string $path){
        $ctx = stream_context_create(['http'=>[
            'method'=>'POST',
            'header'=>"Content-Type: application/json\r\n",
            'content'=>json_encode(['chart'=>$cfg,'format'=>'png','width'=>900,'height'=>520]),
            'timeout'=>12
        ]]);
        $png = @file_get_contents('https://quickchart.io/chart', false, $ctx);
        if ($png) file_put_contents($path, $png);
        return file_exists($path) ? $path : null;
    };

    // Palette proche du template (kaki / rouge / gris / bleu / orange / violet)
    $PALETTE = ['#A6A485','#BF0404','#7F8C8D','#3498DB','#E67E22','#8E44AD'];

    // Chart : répartition des activités par type (doughnut)
    $chart_acts_types_file = null;
    if (!empty($acts_types)) {
        $chart_acts_types_file = $upload_dir.'/chart-acts-types-'.time().'.png';
        $qc([
            'type'=>'doughnut',
            'data'=>[
               'labels'=>array_map(fn($r)=>$r['type'],$acts_types),
               'datasets'=>[[
                  'data'=>array_map(fn($r)=> (int)$r['nb'],$acts_types),
                  'backgroundColor'=>array_slice($PALETTE,0,max(3,count($acts_types)))
               ]]
            ],
            'options'=>[
               'plugins'=>[
                   'legend'=>['position'=>'right','labels'=>['boxWidth'=>14,'font'=>['size'=>12]]]
               ],
               'layout'=>['padding'=>18],
               'cutout'=>'55%'
            ]
        ], $chart_acts_types_file);
    }

    require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";

    // mini classe pour cadre arrondi + cartes
    class R2PDF extends FPDF {
        function roundedRect($x,$y,$w,$h,$r,$style='S'){
            $k=$this->k; $hp=$this->h; $op=($style=='F')?'f':(($style=='FD'||$style=='DF')?'B':'S');
            $MyArc=4/3*(sqrt(2)-1);
            $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k));
            $xc=$x+$w-$r; $yc=$y+$r; $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-$y)*$k));
            $this->_Arc($xc+$r*$MyArc,$yc-$r,$xc+$r,$yc-$r*$MyArc,$xc+$r,$yc);
            $xc=$x+$w-$r; $yc=$y+$h-$r; $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
            $this->_Arc($xc+$r,$yc+$r*$MyArc,$xc+$r*$MyArc,$yc+$r,$xc,$yc+$r);
            $xc=$x+$r; $yc=$y+$h-$r; $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
            $this->_Arc($xc-$r*$MyArc,$yc+$r,$xc-$r,$yc+$r*$MyArc,$xc-$r,$yc);
            $xc=$x+$r; $yc=$y+$r; $this->_out(sprintf('%.2F %.2F l',$x*$k,($hp-$yc)*$k));
            $this->_Arc($xc-$r,$yc-$r*$MyArc,$xc-$r*$MyArc,$yc-$r,$xc,$yc-$r); $this->_out($op);
        }
        function _Arc($x1,$y1,$x2,$y2,$x3,$y3){
            $h=$this->h;
            $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
                $x1*$this->k,($h-$y1)*$this->k,$x2*$this->k,($h-$y2)*$this->k,$x3*$this->k,($h-$y3)*$this->k));
        }
        function card($x,$y,$w,$h,$label,$value){
            // fond crème + pastille valeur à droite (style rapport 2)
            $this->SetDrawColor(230,228,216);
            $this->SetFillColor(247,244,236);
            $this->roundedRect($x,$y,$w,$h,6,'FD');
            $this->SetXY($x+10,$y+9); $this->SetFont('Arial','B',10);
            $this->SetTextColor(42,41,22); // #2A2916
            $this->Cell($w-20,6,utf8_decode($label),0,2);
            // pastille valeur
            $this->SetFillColor(255,255,255); $this->SetDrawColor(214,211,197);
            $this->roundedRect($x+$w-36,$y+($h/2)-10,26,20,5,'D');
            $this->SetXY($x+$w-36,$y+($h/2)-5); $this->SetFont('Arial','B',14); $this->SetTextColor(42,41,22);
            $this->Cell(26,10,(string)$value,0,0,'C'); $this->SetTextColor(0,0,0);
        }
    }

    $pdf = new R2PDF();
    $pdf->AddPage();

    $pdf->SetDrawColor(166,164,133); // #A6A485
    $pdf->roundedRect(10,10,190,35,6,'');
    $logo = WP_PLUGIN_DIR . "/plateforme-master/images/newimages/logo-removebg-preview.png";
    if (file_exists($logo)) $pdf->Image($logo, 15, 15, 28, 0);

    $pdf->SetXY(48,18); $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(90,7,utf8_decode("Rapport Global des publications -\nlaboratoire de recherche"),0,'C');
    $pdf->SetXY(48,33); $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,6,utf8_decode("Date de génération du rapport : ".date('d/m/Y')),0,0,'C');

    $pdf->SetXY(140,18);
    $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Année universitaire : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,date('Y').'-'.(date('Y')+1),0,1);

    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Laboratoire : "),0,0);        $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['denomination']),0,1);

    $pdf->SetX(140); $pdf->SetFont('Arial','',9); $pdf->SetTextColor(146,143,117);
    $pdf->Cell(35,6,utf8_decode("Directeur de labo : "),0,0); $pdf->SetFont('Arial','B',9); $pdf->SetTextColor(0);
    $pdf->Cell(25,6,utf8_decode($labo['directeur_nom']),0,1);
    $pdf->SetTextColor(0,0,0);

    $pdf->Ln(8);

   // ---- 1 - Statistiques globales ----
    $y = 50; // adapte si ton entête est plus haut/bas
    pdf_section_title($pdf, $y, "1 - Statistiques globales");
    $pdf->SetY($y + 18);



    // Suppose $ySection pointe après le bandeau "1 - Statistiques globales"
    pdf_stat_card($pdf, 15, $ySection+60,  80, 32, "Membres du laboratoire",  $total_membres);
    pdf_stat_card($pdf, 15, $ySection+120,  80, 32, "Total publications",      $total_publications);
    pdf_stat_card($pdf, 15, $ySection+180, 80, 32, "Activités scientifiques", $total_activites);


    // Colonne droite : chart "Activités scientifiques par type"
    $pdf->SetXY(105, $y+26);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(90,6,utf8_decode("Répartition des activités scientifiques par type"),0,2,'L');

    if ($chart_acts_types_file && file_exists($chart_acts_types_file)) {
        $pdf->Image($chart_acts_types_file, 105, 66, 85, 0);
    } else {
        $pdf->SetY(70); $pdf->SetFont('Arial','I',10);
        $pdf->MultiCell(90,6,utf8_decode("Aucune activité saisie permettant d'afficher le graphique."));
    }

    // Petite synthèse sous le graphe
    $pdf->SetXY(105, 120);
    $pdf->SetFont('Arial','',9);
    if (!empty($acts_types)){
        $top = $acts_types[0];
        $txt = "Type dominant : ".$top['type']." (".$top['nb'].") — "
             . "Total activités : ".$total_activites.".";
    } else {
        $txt = "Total activités : ".$total_activites.".";
    }
    $pdf->MultiCell(90,5,utf8_decode($txt));

    $pdf->Output('F', $filepath);
    return $upload_url . "/".$filename;
}

// Bandeau de titre style "rapport 2"
function pdf_section_title($pdf, $y, $text, $w=180, $h=14, $radius=null){
    $r = $radius ?? (3);              // capsule par défaut
    //$r = min($r, $h/2, $w/2);            // sécurité

    $pdf->SetDrawColor(226,224,214);     // #E2E0D6
    $pdf->SetFillColor(236,235,227);     // #ECEBE3
    $pdf->SetLineWidth(0.3);

    if (method_exists($pdf,'roundedRect')) {
        $pdf->roundedRect(15, $y, $w, $h, $r, 'FD');
    } else {
        $pdf->Rect(15, $y, $w, $h, 'FD');
    }

    $pdf->SetXY(23, $y + ($h-8)/2);      // centrage vertical du texte
    $pdf->SetFont('Arial','B',14);
    $pdf->SetTextColor(31,30,18);
    $pdf->Cell(0, 8, utf8_decode($text), 0, 1);
    $pdf->SetTextColor(0,0,0);
}

// Carte style "rapport 2" (barre rouge à gauche + pastille valeur à droite)
// Ne dépend d'aucune classe — fonctionne avec un FPDF "classique".
// Carte style "rapport 2" – barre rouge + pastille valeur à droite – sans classe
function pdf_stat_card($pdf, $x, $y, $w, $h, $label, $value){
    // --- paramètres de layout (ajuste si besoin) ---
    $padL = 14;          // marge interne gauche (texte)
    $padR = 10;          // marge interne droite
    $gap  = 8;           // espace label ↔ pastille
    $pillW = 22;         // largeur de la pastille (réduit vs 28)
    $pillH = 22;         // hauteur de la pastille

    // --- carte (fond blanc, bord crème) ---
    $pdf->SetDrawColor(230,228,216);
    $pdf->SetFillColor(255,255,255);
    if (method_exists($pdf,'roundedRect')) $pdf->roundedRect($x,$y,$w,$h,9,'FD');
    else                                   $pdf->Rect($x,$y,$w,$h,'FD');

    // --- barre rouge à gauche ---
    $pdf->SetFillColor(191,4,4);
    $barX=$x+7; $barY=$y+8; $barW=2; $barH=$h-16;
    if (method_exists($pdf,'roundedRect')) $pdf->roundedRect($barX,$barY,$barW,$barH,2,'F');
    else                                   $pdf->Rect($barX,$barY,$barW,$barH,'F');

    // --- pastille valeur (beige) à droite ---
    $pillX = $x + $w - ($pillW + $padR);
    $pillY = $y + ($h - $pillH)/2;
    $pdf->SetDrawColor(214,211,197);
    $pdf->SetFillColor(236,235,227);
    if (method_exists($pdf,'roundedRect')) $pdf->roundedRect($pillX,$pillY,$pillW,$pillH,5,'FD');
    else                                   $pdf->Rect($pillX,$pillY,$pillW,$pillH,'FD');

    // valeur (gros, centré)
    $pdf->SetXY($pillX, $pillY + ($pillH/2) - 6);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(42,41,22);
    $pdf->Cell($pillW,12,(string)$value,0,0,'C');

    // --- libellé (ajustement auto de la taille) ---
    $labelX = $x + $padL + 6;                          // +6 pour passer la barre rouge
    $labelW = $w - ($padL + 6) - $gap - $pillW - $padR;
    if ($labelW < 35) { // garde-fou minimum
        $labelW = 35;
        // si nécessaire, diminue la pastille à 20 pour libérer plus d’espace
    }

    // choisis une taille 13 → 12 → 11 → 10 selon la largeur
    $sizes = [13,12,11,10,9];
    foreach ($sizes as $sz){
        $pdf->SetFont('Arial','B',$sz);
        if ($pdf->GetStringWidth(utf8_decode($label)) <= ($labelW*1.2)) break;
    }

    // centre vertical approximatif sur 2 lignes max
    $pdf->SetTextColor(42,41,22);
    $pdf->SetXY($labelX, $y + ($h/2) - 7);
    $pdf->MultiCell($labelW, 7, utf8_decode($label), 0, 'L');

    // reset
    $pdf->SetTextColor(0,0,0);
}

*/


// Charger FPDF et FPDI en haut du fichier
require_once WP_PLUGIN_DIR . "/plateforme-master/includes/lib/fpdf.php";
require_once WP_PLUGIN_DIR . "/plateforme-master/vendor/autoload.php";

use setasign\Fpdi\Fpdi; // ⚡️ DOIT être en dehors de la fonction

function svc_generate_labo_report_pdf($laboratoire_id, $user_id) {
    global $wpdb;

    /* ===== 0) Infos labo ===== */
    $labo = $wpdb->get_row($wpdb->prepare(
        "SELECT l.*, u.display_name AS directeur_nom
         FROM {$wpdb->prefix}recherche_laboratoire l
         LEFT JOIN {$wpdb->users} u ON u.ID = l.directeur_user_id
         WHERE l.id=%d", $laboratoire_id
    ), ARRAY_A);
    if (!$labo) return new WP_Error('not_found','Labo introuvable',['status'=>404]);

    /* ===== 1) Stats ===== */
    $total_membres = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT m.user_id)
        FROM {$wpdb->prefix}recherche_membre m
        WHERE m.laboratoire_id=%d
    ", $laboratoire_id));

    $total_publications = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_publication p
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = p.chercheur_id
        WHERE m.laboratoire_id = %d
    ", $laboratoire_id));

    $total_activites = (int)$wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id = a.user_id
        WHERE m.laboratoire_id=%d
    ", $laboratoire_id));

    $acts_types = $wpdb->get_results($wpdb->prepare("
        SELECT COALESCE(t.libelle_fr,'Autre') AS type, COUNT(*) AS nb
        FROM {$wpdb->prefix}recherche_activite_scientifique a
        INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=a.user_id
        LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
        WHERE m.laboratoire_id=%d
        GROUP BY COALESCE(t.libelle_fr,'Autre')
        ORDER BY nb DESC
        LIMIT 6
    ", $laboratoire_id), ARRAY_A);


    // === Stats nationales/internationales ===
    $cards = $wpdb->get_row($wpdb->prepare("
        SELECT 
          SUM(CASE WHEN pays IN ('Tunisie','Tunis','TN','Tunisia') THEN 1 ELSE 0 END) AS nationaux,
          SUM(CASE WHEN NOT (pays IN ('Tunisie','Tunis','TN','Tunisia')) THEN 1 ELSE 0 END) AS internationaux
        FROM {$wpdb->prefix}recherche_reseaux
        WHERE laboratoire_id=%d
    ", $laboratoire_id), ARRAY_A);

    // === Stats par pays (top 6) ===
    $pie_rows = $wpdb->get_results($wpdb->prepare("
        SELECT pays, COUNT(*) AS n 
        FROM {$wpdb->prefix}recherche_reseaux
        WHERE laboratoire_id=%d
        GROUP BY pays 
        ORDER BY n DESC 
        LIMIT 6
    ", $laboratoire_id), ARRAY_A);

    $uid   = get_current_user_id();
    $roles = (array) wp_get_current_user()->roles;

    // Cas 1 : Service UTM / établissement → tout
    if (in_array('um_service_utm', $roles) || in_array('um_service_etablissement', $roles)) {
        $activites_stats = $wpdb->get_results("
            SELECT COALESCE(t.libelle_fr,'Autre') AS type_libelle, COUNT(*) AS total
            FROM {$wpdb->prefix}recherche_activite_scientifique a
            LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
            GROUP BY COALESCE(t.libelle_fr,'Autre')
            ORDER BY total DESC
        ", ARRAY_A);
    }
    // Cas 2 : Chercheur
    elseif (in_array('um_chercheur', $roles)) {
        $labo_id = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT laboratoire_id FROM {$wpdb->prefix}recherche_membre WHERE user_id=%d LIMIT 1", $uid
        ));
        if ($labo_id) {
            $activites_stats = $wpdb->get_results($wpdb->prepare("
                SELECT COALESCE(t.libelle_fr,'Autre') AS type_libelle, COUNT(*) AS total
                FROM {$wpdb->prefix}recherche_activite_scientifique a
                LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
                INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=a.user_id
                WHERE (a.user_id=%d OR m.laboratoire_id=%d)
                GROUP BY COALESCE(t.libelle_fr,'Autre')
                ORDER BY total DESC
            ", $uid, $labo_id), ARRAY_A);
        } else {
            $activites_stats = $wpdb->get_results($wpdb->prepare("
                SELECT COALESCE(t.libelle_fr,'Autre') AS type_libelle, COUNT(*) AS total
                FROM {$wpdb->prefix}recherche_activite_scientifique a
                LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
                WHERE a.user_id=%d
                GROUP BY COALESCE(t.libelle_fr,'Autre')
                ORDER BY total DESC
            ", $uid), ARRAY_A);
        }
    }
    // Cas 3 : Directeur de labo
    elseif (in_array('um_directeur_laboratoire', $roles)) {
        $labo_id = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id=%d LIMIT 1", $uid
        ));
        if ($labo_id) {
            $activites_stats = $wpdb->get_results($wpdb->prepare("
                SELECT COALESCE(t.libelle_fr,'Autre') AS type_libelle, COUNT(*) AS total
                FROM {$wpdb->prefix}recherche_activite_scientifique a
                LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
                INNER JOIN {$wpdb->prefix}recherche_membre m ON m.user_id=a.user_id
                WHERE (a.user_id=%d OR m.laboratoire_id=%d OR %d IN (
                    SELECT id FROM {$wpdb->prefix}recherche_laboratoire WHERE directeur_user_id=%d
                ))
                GROUP BY COALESCE(t.libelle_fr,'Autre')
                ORDER BY total DESC
            ", $uid, $labo_id, $labo_id, $uid), ARRAY_A);
        }
    }
    // Cas défaut : juste ses propres activités
    else {
        $activites_stats = $wpdb->get_results($wpdb->prepare("
            SELECT COALESCE(t.libelle_fr,'Autre') AS type_libelle, COUNT(*) AS total
            FROM {$wpdb->prefix}recherche_activite_scientifique a
            LEFT JOIN {$wpdb->prefix}recherche_type_activite_scientifique t ON t.id=a.type_id
            WHERE a.user_id=%d
            GROUP BY COALESCE(t.libelle_fr,'Autre')
            ORDER BY total DESC
        ", $uid), ARRAY_A);
    }




    /* ===== 2) Préparation fichiers ===== */
    $upload_dir = WP_CONTENT_DIR . "/recherche/rapports";
    $upload_url = content_url("recherche/rapports");
    if (!file_exists($upload_dir)) wp_mkdir_p($upload_dir);
    $filename  = "rapport-labo-{$laboratoire_id}-".time().".pdf";
    $filepath  = $upload_dir . "/".$filename;

    // Donut chart activités
    $chart_acts_types_file = null;
    if (!empty($acts_types)) {
        $chart_acts_types_file = $upload_dir.'/chart-acts-types-'.time().'.png';
        $ctx = stream_context_create(['http'=>[
            'method'=>'POST',
            'header'=>"Content-Type: application/json\r\n",
            'content'=>json_encode([
                'chart'=>[
                    'type'=>'doughnut',
                    'data'=>[
                        'labels'=>array_map(fn($r)=>$r['type'],$acts_types),
                        'datasets'=>[[ 'data'=>array_map(fn($r)=>(int)$r['nb'],$acts_types),
                            'backgroundColor'=>['#A6A485','#BF0404','#7F8C8D','#3498DB','#E67E22','#8E44AD']
                        ]]
                    ],
                    'options'=>['plugins'=>['legend'=>['position'=>'right']],'cutout'=>'55%']
                ],
                'format'=>'png','width'=>800,'height'=>500
            ]),
            'timeout'=>12
        ]]);
        $png = @file_get_contents('https://quickchart.io/chart', false, $ctx);
        if ($png) file_put_contents($chart_acts_types_file, $png);
    }

    // Bar chart publications (exemple statique, à remplacer par SQL dynamique)
    $chart_pub_types_file = $upload_dir.'/chart-pub-types-'.time().'.png';
    $ctx2 = stream_context_create(['http'=>[
        'method'=>'POST',
        'header'=>"Content-Type: application/json\r\n",
        'content'=>json_encode([
            'chart'=>[
                'type'=>'bar',
                'data'=>[
                    'labels'=>['Article','Chapitre','Livre','Conférence'],
                    'datasets'=>[[
                        'label'=>'Nombre de publications',
                        'data'=>[12,5,3,8],
                        'backgroundColor'=>'#BF0404'
                    ]]
                ],
                'options'=>[
                    'plugins'=>['legend'=>['display'=>false]],
                    'scales'=>['y'=>['beginAtZero'=>true]]
                ]
            ],
            'format'=>'png','width'=>900,'height'=>400
        ]),
        'timeout'=>12
    ]]);
    $png2 = @file_get_contents('https://quickchart.io/chart', false, $ctx2);
    if ($png2) file_put_contents($chart_pub_types_file, $png2);


    $chart_reseaux_file = $upload_dir.'/chart-reseaux-'.time().'.png';
    if (!empty($pie_rows)) {
        $labels = array_column($pie_rows, 'pays');
        $values = array_column($pie_rows, 'n');
        $ctx3 = stream_context_create(['http'=>[
            'method'=>'POST',
            'header'=>"Content-Type: application/json\r\n",
            'content'=>json_encode([
                'chart'=>[
                    'type'=>'pie',
                    'data'=>[
                        'labels'=>$labels,
                        'datasets'=>[[
                            'data'=>$values,
                            'backgroundColor'=>['#808066','#b1342f','#dabebe','#a6a485','#c9b037','#f28c28','#3b83bd']
                        ]]
                    ],
                    'options'=>['plugins'=>['legend'=>['display'=>false]]]
                ],
                'format'=>'png','width'=>800,'height'=>500
            ]),
            'timeout'=>12
        ]]);
        $png3 = @file_get_contents('https://quickchart.io/chart', false, $ctx3);
        if ($png3) file_put_contents($chart_reseaux_file, $png3);
    }



    $chart_activites_file = $upload_dir.'/chart-activites-'.time().'.png';
    if (!empty($activites_stats)) {
        $labels = array_column($activites_stats, 'type_libelle');
        $values = array_column($activites_stats, 'total');

        $ctx = stream_context_create(['http'=>[
          'method'=>'POST',
          'header'=>"Content-Type: application/json\r\n",
          'content'=>json_encode([
              'chart'=>[
                  'type'=>'pie',
                  'data'=>[
                      'labels'=>$labels,
                      'datasets'=>[[
                          'data'=>$values,
                          'backgroundColor'=>['#808066','#b1342f','#dabebe','#4CAF50']
                      ]]
                  ],
                  'options'=>[
                      'plugins'=>[
                          // Taille des labels de la légende
                          'legend'=>[
                              'display'=>true,
                              'position'=>'right',
                              'labels'=>[
                                  'font'=>['size'=>14] // ici tu changes la taille
                              ]
                          ],
                          // Taille des datalabels sur le camembert
                          'datalabels'=>[
                              'color'=>'#fff',
                              'font'=>['weight'=>'bold','size'=>25], // ici tu changes la taille
                              'formatter'=>'function(value){return value+" ("+Math.round((value/'.array_sum($values).')*100)+"%)";}'
                          ]
                      ]
                  ]
              ],
              'format'=>'png','width'=>800,'height'=>500
          ]),
          'timeout'=>12
      ]]);

        $png = @file_get_contents('https://quickchart.io/chart', false, $ctx);
        if ($png) file_put_contents($chart_activites_file, $png);
    }

    /* ===== 3) FPDI : Import du modèle ===== */
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile(WP_PLUGIN_DIR . "/plateforme-master/templates/diecteurdelaboderecherche.pdf");

    // === Page 1 du modèle ===
    $pdf->AddPage();
    $tplIdx1 = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx1, 0, 0, 210);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(145, 11); $pdf->Write(5, date('Y').'-'.(date('Y')+1));
    $pdf->SetXY(145, 17); $pdf->Write(5, utf8_decode($labo['denomination']));
    $pdf->SetXY(145, 22); $pdf->Write(5, utf8_decode($labo['directeur_nom']));

    $date=date("d/m/y");

    $pdf->SetXY(83, 21); $pdf->Write(5, $date);


    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(12, 38);  $pdf->Write(6, utf8_decode("1 - Statistiques globales"));

    $pdf->SetFont('Arial','B',11);
    $pdf->SetXY(90, 55); $pdf->Write(6, utf8_decode("Diagramme des activités scientifiques par type"));

    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(13, 57); $pdf->Write(5, utf8_decode("Nombre total"));    
    $pdf->SetXY(13, 61); $pdf->Write(5, utf8_decode("de membres : "));    

    $pdf->SetXY(63, 60); $pdf->Write(5, utf8_decode($total_membres));

    $pdf->SetXY(13, 81); $pdf->Write(5, utf8_decode("Nombre total"));
    $pdf->SetXY(13, 86); $pdf->Write(5, utf8_decode("de publications : "));
    $pdf->SetXY(63, 85); $pdf->Write(5, utf8_decode($total_publications));

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(13, 110); $pdf->Write(5, utf8_decode("Nombre total "));
    $pdf->SetXY(13, 115); $pdf->Write(5, utf8_decode("d'activités scientifiques : "));
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(63, 112); $pdf->Write(5, utf8_decode($total_activites));

/*
    if ($chart_acts_types_file && file_exists($chart_acts_types_file)) {
        $pdf->Image($chart_acts_types_file, 120, 60, 80);
    }

  */

    if ($chart_activites_file && file_exists($chart_activites_file)) {
        $pdf->Image($chart_activites_file, 100, 65, 80);
    }

    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(12, 135);
    $pdf->Write(6, utf8_decode("% de collaborations par continent ou pays"));

    // Camembert
    if ($chart_reseaux_file && file_exists($chart_reseaux_file)) {
        $pdf->Image($chart_reseaux_file, 20, 160, 100); // image camembert
    }

    // Légende à droite
    $pdf->SetFont('Arial','',10);
    $yLegend = 160;
    $colors = ['#808066','#b1342f','#dabebe','#a6a485','#c9b037','#f28c28','#3b83bd'];

    foreach ($pie_rows as $i=>$row) {
        $pdf->SetXY(130, $yLegend);
        // carré couleur
        $pdf->SetFillColor(hexdec(substr($colors[$i],1,2)),hexdec(substr($colors[$i],3,2)),hexdec(substr($colors[$i],5,2)));
        $pdf->Cell(5,5,'',0,0,'',true);
        $pdf->SetXY(137, $yLegend);
        $pdf->Cell(70,5,utf8_decode($row['pays'])." (".$row['n'].")",0,1);
        $yLegend += 8;
    }

    /*
    // Stats cartes (nationaux / internationaux)
    $pdf->SetXY(40, 220); 
    $pdf->SetFont('Arial','',11);

    $labelWidth = 80; // largeur pour le libellé
    $valueWidth = 20; // largeur pour la valeur

    // Ligne 1
    $pdf->Cell($labelWidth, 8, utf8_decode("Collaborations nationales :"), 0, 0, 'L');
    $pdf->Cell($valueWidth, 8, $cards['nationaux'], 0, 1, 'R');

    // Ligne 2
    $pdf->Cell($labelWidth, 8, utf8_decode("Collaborations internationales :"), 0, 0, 'L');
    $pdf->Cell($valueWidth, 8, $cards['internationaux'], 0, 1, 'R');

    */

    /*$pdf->SetFont('Arial','B',12);
    $pdf->SetXY(12, 38);  $pdf->Write(6, utf8_decode("2 - Top 4 Sources de financement"));*/

    


    // === Page 2 du modèle ===
   // $pdf->AddPage();
   // $tplIdx2 = $pdf->importPage(2);
  //  $pdf->useTemplate($tplIdx2, 0, 0, 210);

 //   $pdf->SetFont('Arial','B',12);
 //   $pdf->SetXY(20, 20);
 //   $pdf->Write(6, utf8_decode("Répartition par type des publications"));

 //   if ($chart_pub_types_file && file_exists($chart_pub_types_file)) {
   //     $pdf->Image($chart_pub_types_file, 20, 40, 170);
 //   }

    /* ===== Sauvegarde ===== */
    $pdf->Output('F', $filepath);
    return $upload_url . "/".$filename;
}
