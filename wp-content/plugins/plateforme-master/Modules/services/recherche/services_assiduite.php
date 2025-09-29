<?php
if (!defined('ABSPATH')) exit;

/** Tables */
function svc_assiduite_tables(){
  global $wpdb;
  return [
    'ass'   => $wpdb->prefix . 'recherche_assiduite',
    'mem'   => $wpdb->prefix . 'recherche_membre',
    'lab'   => $wpdb->prefix . 'recherche_laboratoire',
    'grade' => $wpdb->prefix . 'grade',          // <— utm_grade
    'users' => $wpdb->users,
    'um'    => $wpdb->usermeta,
  ];
}

/** Labo du directeur */
function svc_assiduite_lab_of_director($director_uid){
  global $wpdb; $t = svc_assiduite_tables();
  return (int) $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$t['lab']} WHERE directeur_user_id=%d", $director_uid
  ));
}

/** Appartenance labo */
function svc_assiduite_is_member_of_lab($user_id, $lab_id){
  global $wpdb; $t = svc_assiduite_tables();
  $x = $wpdb->get_var($wpdb->prepare(
    "SELECT 1 FROM {$t['mem']} WHERE user_id=%d AND laboratoire_id=%d LIMIT 1", $user_id, $lab_id
  ));
  return (bool)$x;
}

/**
 * Récupération robuste du grade utilisateur (texte lisible)
 * Priorité :
 *  1) usermeta 'grade'
 *  2) recherche_membre.grade (texte)
 *  3) si recherche_membre.grade est un id numérique => utm_grade.intitule
 */
function svc_assiduite_user_grade($user_id, $lab_id = null){
  global $wpdb; $t = svc_assiduite_tables();

  // 1) usermeta
  $g = get_user_meta($user_id, 'grade', true);
  if ($g) return (string)$g;

  // 2/3) depuis la table membre (optionnellement filtrée par labo)
  if ($lab_id) {
    $val = $wpdb->get_var($wpdb->prepare(
      "SELECT grade FROM {$t['mem']} WHERE user_id=%d AND laboratoire_id=%d ORDER BY id DESC LIMIT 1",
      $user_id, $lab_id
    ));
  } else {
    $val = $wpdb->get_var($wpdb->prepare(
      "SELECT grade FROM {$t['mem']} WHERE user_id=%d ORDER BY id DESC LIMIT 1",
      $user_id
    ));
  }
  if ($val === null || $val === '') return null;

  // si numérique -> chercher l'intitulé dans utm_grade
  if (ctype_digit((string)$val)) {
    $label = $wpdb->get_var($wpdb->prepare(
      "SELECT intitule FROM {$t['grade']} WHERE id=%d", (int)$val
    ));
    return $label ? (string)$label : (string)$val;
  }
  // sinon c'est déjà un texte exploitable
  return (string)$val;
}

/** Normaliser statut (retourne WP_Error si invalide) */
function svc_assiduite_norm_statut($statut){
  $map = [
    'present'   => 'Présent',
    'présent'   => 'Présent',
    'presence'  => 'Présent',
    'présence'  => 'Présent',
    'mission'   => 'Mission',
    'stage'     => 'Stage',
    'absent'    => 'Absent',
  ];
  $k = strtolower(trim((string)$statut));
  $norm = $map[$k] ?? $statut;
  if (!in_array($norm, ['Présent','Mission','Stage','Absent'], true)) {
    return new WP_Error('bad_statut', 'Statut invalide.');
  }
  return $norm;
}

/** LISTE : selon rôle */
function svc_assiduite_list_for_user($uid){
  global $wpdb; $t = svc_assiduite_tables();
  $u = wp_get_current_user();
  $roles = (array) $u->roles;

  // CHERCHEUR → ses lignes
  if (in_array('um_chercheur', $roles, true)) {
    $sql = "SELECT a.id, a.user_id, a.laboratoire_id,
                   /* grade tel qu'enregistré */
                   a.grade,
                   a.date_jour AS date_presence,
                   a.statut,
                   a.justification_text AS justification,
                   a.justification_path,
                   0 AS piece_jointe_id
            FROM {$t['ass']} a
            WHERE a.user_id=%d
            ORDER BY a.date_jour DESC, a.id DESC";
    return $wpdb->get_results($wpdb->prepare($sql, $uid), ARRAY_A) ?: [];
  }

  // DIRECTEUR → membres de SON labo
  if (in_array('um_directeur_laboratoire', $roles, true)) {
    $lab_id = svc_assiduite_lab_of_director($uid);
    if (!$lab_id) return [];

    // On enrichit l’affichage du grade si a.grade est NULL :
    // - usermeta('grade')
    // - recherche_membre.grade (texte OU id -> jointure utm_grade)
    $sql = "SELECT a.id, a.user_id, u.display_name AS chercheur_nom,
                   COALESCE(
                     a.grade,
                     umg.meta_value,
                     /* si m.grade est numérique on prend g.intitule, sinon le texte de m.grade */
                     CASE
                       WHEN m.grade REGEXP '^[0-9]+$' THEN g.intitule
                       ELSE m.grade
                     END
                   ) AS grade,
                   a.date_jour AS date_presence,
                   a.statut,
                   a.justification_text AS justification,
                   a.justification_path,
                   0 AS piece_jointe_id
            FROM {$t['ass']} a
            JOIN {$t['users']} u ON u.ID = a.user_id
            LEFT JOIN {$t['um']} umg ON umg.user_id=a.user_id AND umg.meta_key='grade'
            LEFT JOIN {$t['mem']} m ON m.user_id=a.user_id AND m.laboratoire_id=a.laboratoire_id
            LEFT JOIN {$t['grade']} g ON g.id = CASE WHEN m.grade REGEXP '^[0-9]+$' THEN m.grade ELSE NULL END
            WHERE a.laboratoire_id=%d
            ORDER BY a.date_jour DESC, a.id DESC";
    return $wpdb->get_results($wpdb->prepare($sql, $lab_id), ARRAY_A) ?: [];
  }

  // autres rôles -> vide pour l’instant
  return [];
}

/** CREATE (directeur) */
function svc_assiduite_create($director_uid, $payload){
  global $wpdb; $t = svc_assiduite_tables();

  $lab_id = svc_assiduite_lab_of_director($director_uid);
  if (!$lab_id) return new WP_Error('no_lab', 'Aucun laboratoire rattaché.');

  $email = sanitize_email($payload['chercheur_email'] ?? '');
  $date  = trim((string)($payload['date_presence'] ?? ''));
  $stat  = $payload['statut'] ?? '';
  $just  = wp_kses_post($payload['justification'] ?? '');

  if (!$email || !$date || !$stat) return new WP_Error('missing', 'Champs requis manquants.');

  // date: accepte Y-m-d ou d/m/Y
  if (preg_match('#^\d{2}/\d{2}/\d{4}$#', $date)) {
    [$d,$m,$y] = explode('/', $date);
    $date = sprintf('%04d-%02d-%02d', (int)$y, (int)$m, (int)$d);
  }
  if (!preg_match('#^\d{4}-\d{2}-\d{2}$#', $date)) return new WP_Error('bad_date', 'Date invalide (Y-m-d).');

  $stat = svc_assiduite_norm_statut($stat);
  if (is_wp_error($stat)) return $stat;

  $user_id = (int) $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$t['users']} WHERE user_email=%s", $email));
  if (!$user_id) return new WP_Error('user_nf', 'Utilisateur introuvable pour cet e-mail.');
  if (!svc_assiduite_is_member_of_lab($user_id, $lab_id)) return new WP_Error('not_member', 'Le chercheur n’appartient pas à votre labo.');

  // <<<----- ICI : on va chercher le grade de façon robuste
  $grade = svc_assiduite_user_grade($user_id, $lab_id);

  // upsert unique (lab,user,date)
  $exists = (int)$wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$t['ass']} WHERE laboratoire_id=%d AND user_id=%d AND date_jour=%s",
    $lab_id, $user_id, $date
  ));
  $data = [
    'laboratoire_id'     => $lab_id,
    'user_id'            => $user_id,
    'grade'              => $grade,   // <— plus NULL :)
    'date_jour'          => $date,
    'statut'             => $stat,
    'justification_text' => $just ?: null,
    'updated_by'         => $director_uid,
    'updated_at'         => current_time('mysql'),
  ];
  if ($exists){
    $ok = $wpdb->update($t['ass'], $data, ['id'=>$exists]);
    if ($ok === false) return new WP_Error('dbu', $wpdb->last_error);
    return ['id'=>$exists, 'updated'=>true];
  } else {
    $data['created_by'] = $director_uid;
    $data['created_at'] = current_time('mysql');
    $ok = $wpdb->insert($t['ass'], $data);
    if ($ok === false) return new WP_Error('dbi', $wpdb->last_error);
    return ['id'=>$wpdb->insert_id, 'created'=>true];
  }
}

/** UPDATE (directeur ou chercheur) */
function svc_assiduite_update($uid, $id, $payload){
  global $wpdb; $t = svc_assiduite_tables();
  $u = wp_get_current_user(); $roles = (array)$u->roles;

  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t['ass']} WHERE id=%d", (int)$id), ARRAY_A);
  if (!$row) return new WP_Error('nf', 'Ligne introuvable.');

  // --- Directeur : autorisé à modifier le statut et/ou la pièce jointe
  if (in_array('um_directeur_laboratoire', $roles, true)) {
    $lab_id = svc_assiduite_lab_of_director($uid);
    if (!$lab_id || (int)$row['laboratoire_id'] !== (int)$lab_id) {
      return new WP_Error('forbidden', 'Hors de votre labo.');
    }

    $fields = [];
    if (isset($payload['statut'])) {
      $norm = svc_assiduite_norm_statut($payload['statut']);
      if (is_wp_error($norm)) return $norm;
      $fields['statut'] = $norm;
    }
    if (array_key_exists('piece_jointe_id', $payload)) {
      $url = $payload['piece_jointe_id'] ? wp_get_attachment_url((int)$payload['piece_jointe_id']) : null;
      $fields['justification_path'] = $url;
      $fields['justification_text'] = null;
    }

    if (!$fields) return ['ok'=>true];
    $fields['updated_by'] = $uid;
    $fields['updated_at'] = current_time('mysql');

    $ok = $wpdb->update($t['ass'], $fields, ['id'=>$row['id']]);
    if ($ok === false) return new WP_Error('dbu', $wpdb->last_error);
    return ['ok'=>true];
  }

  // --- Chercheur : peut déposer/retirer sa pièce jointe
  if (in_array('um_chercheur', $roles, true)) {
    if ((int)$row['user_id'] !== (int)$uid) return new WP_Error('forbidden', 'Vous ne pouvez modifier que vos lignes.');
    $fields = [];
    if (array_key_exists('piece_jointe_id', $payload)) {
      $url = $payload['piece_jointe_id'] ? wp_get_attachment_url((int)$payload['piece_jointe_id']) : null;
      $fields['justification_path'] = $url;
      $fields['justification_text'] = null;
    }

    if (!$fields) return ['ok'=>true];
    $fields['updated_by'] = $uid;
    $fields['updated_at'] = current_time('mysql');

    $ok = $wpdb->update($t['ass'], $fields, ['id'=>$row['id']]);
    if ($ok === false) return new WP_Error('dbu', $wpdb->last_error);
    return ['ok'=>true];
  }

  return new WP_Error('forbidden', 'Accès refusé.');
}

/** ====== Parse CSV + Import ====== */
function svc_assiduite_parse_csv($filepath){
  if (!file_exists($filepath)) return new WP_Error('file_missing', 'Fichier introuvable.');
  $h = fopen($filepath, 'r'); if (!$h) return new WP_Error('file_open', 'Ouverture impossible.');
  $header = fgetcsv($h, 0, ','); if (!$header) { fclose($h); return new WP_Error('csv_header', 'En-tête manquant.'); }
  $map = array_change_key_case(array_flip($header), CASE_LOWER);
  foreach (['email','grade','date','statut','justification'] as $col)
    if (!isset($map[$col])) { fclose($h); return new WP_Error('csv_cols', "Colonne '$col' absente."); }

  $rows = [];
  while (($r = fgetcsv($h, 0, ',')) !== false){
    $email = trim($r[$map['email']] ?? '');
    $grade = trim($r[$map['grade']] ?? '');
    $date  = trim($r[$map['date']] ?? '');
    $stat  = trim($r[$map['statut']] ?? '');
    $just  = trim($r[$map['justification']] ?? '');
    if (!$email || !$date || !$stat) continue;

    if (preg_match('#^\d{2}/\d{2}/\d{4}$#', $date)) {
      [$d,$m,$y]=explode('/',$date); $date=sprintf('%04d-%02d-%02d', (int)$y,(int)$m,(int)$d);
    }
    if (!preg_match('#^\d{4}-\d{2}-\d{2}$#', $date)) continue;

    $rows[] = (object)[ 'email'=>$email, 'grade'=>$grade, 'date'=>$date, 'statut'=>$stat, 'justification'=>$just ];
  }
  fclose($h);
  if (!$rows) return new WP_Error('csv_empty','Aucune ligne valide.');
  return $rows;
}

function svc_assiduite_import_rows($rows, $director_uid){
  global $wpdb; $t = svc_assiduite_tables();
  $lab_id = svc_assiduite_lab_of_director($director_uid);
  if (!$lab_id) return new WP_Error('no_lab', 'Aucun laboratoire rattaché.');

  $imported=0; $skipped=0;
  foreach ($rows as $r){
    $user_id = (int)$wpdb->get_var($wpdb->prepare("SELECT ID FROM {$t['users']} WHERE user_email=%s", $r->email));
    if (!$user_id) { $skipped++; continue; }
    if (!svc_assiduite_is_member_of_lab($user_id, $lab_id)) { $skipped++; continue; }

    $stat = svc_assiduite_norm_statut($r->statut);
    if (is_wp_error($stat)) { $skipped++; continue; }

    // grade depuis le CSV en priorité, sinon déduction base
    $grade = $r->grade ?: svc_assiduite_user_grade($user_id, $lab_id);

    $exists = (int)$wpdb->get_var($wpdb->prepare(
      "SELECT id FROM {$t['ass']} WHERE laboratoire_id=%d AND user_id=%d AND date_jour=%s",
      $lab_id, $user_id, $r->date
    ));
    $data = [
      'laboratoire_id'     => $lab_id,
      'user_id'            => $user_id,
      'grade'              => $grade, // <— plus NULL :)
      'date_jour'          => $r->date,
      'statut'             => $stat,
      'justification_text' => $r->justification ?: null,
      'updated_by'         => $director_uid,
      'updated_at'         => current_time('mysql'),
    ];
    if ($exists){
      $ok=$wpdb->update($t['ass'],$data,['id'=>$exists]); if($ok===false){ $skipped++; continue; }
      $imported++;
    } else {
      $data['created_by']=$director_uid; $data['created_at']=current_time('mysql');
      $ok=$wpdb->insert($t['ass'],$data); if($ok===false){ $skipped++; continue; }
      $imported++;
    }
  }
  return ['imported'=>$imported,'skipped'=>$skipped];
}
