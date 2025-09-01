<?php
date_default_timezone_set('Africa/Tunis');

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/candidats', [
        'methods' => 'GET',
        'callback' => 'gm_api_get_candidat_by_user',
                'permission_callback' => '__return_true',

    ]);
});

function gm_api_get_candidat_by_user() {
    require_once dirname(__DIR__) . '/services/candidature-service.php';
    return gm_get_candidats_by_user(); // Doit retourner 1 seul candidat connecté
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/etablissements', [
    'methods' => 'GET',
    'callback' => 'gm_api_get_etablissements',
    'permission_callback' => '__return_true',
  ]);
});

function gm_api_get_etablissements() {
  global $wpdb;
  $table = "{$wpdb->prefix}master_instituts";

  $results = $wpdb->get_results("
    SELECT id, nom, code_institut 
    FROM $table 
    ORDER BY nom ASC
  ", ARRAY_A);

  return rest_ensure_response($results);
}



add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/masters-by-institut/(?P<institut_id>\d+)', [
    'methods' => 'GET',
    'callback' => 'gm_api_get_masters_by_institut',
    'permission_callback' => '__return_true',
  ]);
});

function gm_api_get_masters_by_institut($request) {
  global $wpdb;
  $institut_id = (int) $request['institut_id'];
  $table = "{$wpdb->prefix}master_fichemaster";


  $current_date = date('Y-m-d'); // Format adapté aux colonnes de type DATE



  $sql = $wpdb->prepare("
      SELECT m.id, m.intitule_master
      FROM $table AS m
      INNER JOIN utm_master_sessions AS s1 ON s1.master_id = m.id
      INNER JOIN utm_master_appels_masters AS am ON am.master_id = m.id
      INNER JOIN utm_master_appels_sessions AS s ON s.appel_id = am.appel_id
      WHERE m.institut_id = %d
        AND s.date_debut <= %s
        AND s.date_fin >= %s
        AND s1.etat = 'publié web'
      GROUP BY m.id
      ORDER BY m.intitule_master ASC
  ", $institut_id, $current_date, $current_date);

  $results = $wpdb->get_results($sql, ARRAY_A);




  // 🐞 Debug : Affiche la requête SQL générée
  error_log("REQUÊTE SQL DEBUG : $sql");

  // Exécution
  $results = $wpdb->get_results($sql, ARRAY_A);


  return rest_ensure_response($results);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/candidature/situation-academique', [
    'methods' => 'POST',
    'callback' => 'gm_api_save_situation_academique',
    'permission_callback' => function () {
      return is_user_logged_in();
    }
  ]);
});



// version 09 06

function gm_api_save_situation_academiqueOld(WP_REST_Request $request) {


  global $wpdb;

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();
  $personal = $data['personal'] ?? [];
  $situation = $data['situation'] ?? [];
  $parcours = $data['parcours_academiques'] ?? [];
  $blanches = $data['annees_blanches'] ?? [];
  $criteres = $data['criteres_score'] ?? [];

  $upload_base = wp_upload_dir()['basedir'] . '/candidats/';
  wp_mkdir_p($upload_base);

  function save_file_path($file) {
    return $file && !empty($file) ? 'uploads/candidats/' . basename($file) : '';
  }

  // 🔁 1. Enregistrer la situation académique principale
  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
      'parcours'          => sanitize_text_field($situation['parcours'] ?? ''),
      'cycle'             => sanitize_text_field($situation['cycle'] ?? ''),
      'annee_academique'  => sanitize_text_field($situation['annee'] ?? ''),
      'baccalaureat'      => sanitize_text_field($situation['baccalaureat'] ?? ''),
      'etablissement'     => sanitize_text_field($situation['etablissement'] ?? ''),
      'session'           => sanitize_text_field($situation['session'] ?? ''),
      'mention'           => sanitize_text_field($situation['mention'] ?? ''),
      'moyenne'           => sanitize_text_field($situation['moyenne'] ?? ''),
      'piece_jointe_path' => save_file_path($situation['fichier_principal'] ?? ''),
      'ajouter_annee_blanche' => !empty($blanches),
      'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
      'piece_jointe_blanche_path' => save_file_path($situation['fichier_blanche'] ?? ''),
      'cause_blanche'     => sanitize_text_field($situation['cause'] ?? ''),
     //'niveau_master'     => sanitize_text_field($situation['niveau'] ?? 'M1'),
      'created_at'        => date('Y-m-d H:i:s')
  ]);




    // 🔁 Enregistrer ou mettre à jour dans la table utm_candidatures
  $master_id = intval($situation['master_id'] ?? 0);
  $niveau    = sanitize_text_field($situation['niveau'] ?? 'M1');

  // Vérifier si une ligne existe déjà pour ce candidat + master
  $existing = $wpdb->get_var($wpdb->prepare("
    SELECT id FROM {$wpdb->prefix}candidatures
    WHERE candidat_id = %d AND master_id = %d
    LIMIT 1
  ", $candidat_id, $master_id));

  if ($existing) {
    // Mise à jour
    $wpdb->update("{$wpdb->prefix}master_candidatures", [
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ], ['id' => $existing]);
    $candidature_id = $existing; // pour lier aux critères de score
  } else {
    // Insertion
    $wpdb->insert("{$wpdb->prefix}master_candidatures", [
      'candidat_id'      => $candidat_id,
      'master_id'        => $master_id,
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  }


  // 🔁 2. Enregistrer les parcours académiques avec niveau (1, 2, 3...)
  $niveau = 1;
  foreach ($parcours as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'        => $candidat_id,
      'annee_academique'   => sanitize_text_field($row['annee'] ?? ''),
      'universite'         => sanitize_text_field($row['universite'] ?? ''),
      'etablissement'      => sanitize_text_field($row['etablissement'] ?? ''),
      'session'            => sanitize_text_field($row['session'] ?? ''),
      'mention'            => sanitize_text_field($row['mention'] ?? ''),
      'moyenne'            => sanitize_text_field($row['moyenne'] ?? ''),
      'credit'             => sanitize_text_field($row['credit'] ?? ''),
      'niveau'             => $niveau, // ➕ Ajout du niveau
      'piece_jointe_path'  => save_file_path($row['fichier'] ?? ''),
      'created_at'         => date('Y-m-d H:i:s')
    ]);

    $niveau++; // Incrémentation à chaque boucle
  }


  // 🔁 3. Enregistrer les années blanches
  foreach ($blanches as $row) {


    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id'       => $candidat_id,
      'nbannee'           => intval($row['nbannee'] ?? 0),
      'cause'             => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref'         => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => save_file_path($row['fichier'] ?? ''),
      'created_at'        => date('Y-m-d H:i:s')
    ]);
  }


  // 🔁 2. Enregistrer les années du parcours académique
  foreach ($parcours as $annee) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'        => $candidat_id,
      'annee_academique'   => sanitize_text_field($annee['annee'] ?? ''),
      'universite'         => sanitize_text_field($annee['universite'] ?? ''),
      'etablissement'      => sanitize_text_field($annee['etablissement'] ?? ''),
      'session'            => sanitize_text_field($annee['session'] ?? ''),
      'mention'            => sanitize_text_field($annee['mention'] ?? ''),
      'moyenne'            => sanitize_text_field($annee['moyenne'] ?? ''),
      'piece_jointe_path'  => save_file_path($annee['fichier'] ?? ''),
      'created_at'         => date('Y-m-d H:i:s'),
    ]);
  }

  

  /*
    // 🔁 4. Critères de score
    foreach ($criteres as $critere) {
      $wpdb->insert("{$wpdb->prefix}candidatures_score_criteres", [
        'candidature_id' => $candidature_id,
        'critere_id'     => intval($critere['critere_id']),
        'valeur'         => sanitize_text_field($critere['valeur']),
        'created_at'     => date('Y-m-d H:i:s')
      ]);
    }
    */

  foreach ($criteres as $critere) {
  $critere_id = null;

  // 🧩 Cas 1 — Critère standard avec ID direct
  if ($critere['type'] === 'critere' && !empty($critere['critere_id'])) {
    $critere_id = intval($critere['critere_id']);
  }

  // 🧩 Cas 2 ou 3 — Besoin de retrouver le critère via champ
  if (!$critere_id) {
    $champ = '';
    
    switch ($critere['type']) {
      case 'matiere':
        $champ = 'matieres';
        break;
      case 'malus':
        $champ = 'malus_' . sanitize_title($critere['condition']);
        break;
      case 'interruption':
        $champ = 'interruption_diplome';
        break;
      case 'pfe':
        $champ = 'note_pfe';
        break;
      default :
      $champ = $critere['type'];
    }

    if (!empty($champ)) {
      $critere_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}master_score_criteres WHERE master_id = %d AND champ = %s LIMIT 1",
        $master_id,
        $champ
      ));
    }
  }


  // 🔁 Insertion finale si on a trouvé un critere_id
  if ($critere_id) {
    $wpdb->insert("{$wpdb->prefix}candidatures_score_criteres", [
      'candidature_id' => $candidature_id,
      'critere_id'     => $critere_id,
      'valeur'         => sanitize_text_field($critere['valeur']),
      'created_at'     => date('Y-m-d H:i:s')
    ]);
  }
  }

  


  // 🔁 5. Enrichir table candidats si besoin (état spécifique, cycle)
  $wpdb->update("{$wpdb->prefix}candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin'     => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle'           => sanitize_text_field($situation['cycle'] ?? '')
  ], [
    'id' => $candidat_id
  ]);

  // ✅ 6. Mettre à jour l'état de la table master_candidats_adresses
  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], [
    'candidat_id' => $candidat_id
  ]);

  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}


/*
function gm_api_save_situation_academique(WP_REST_Request $request) {
  global $wpdb;

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();
  $personal = $data['personal'] ?? [];
  $situation = $data['situation'] ?? [];
  $parcours = $data['parcours_academiques'] ?? [];
  $blanches = $data['annees_blanches'] ?? [];
  $criteres = $data['criteres_score'] ?? [];

  $upload_base = wp_upload_dir()['basedir'] . '/candidats/';
  wp_mkdir_p($upload_base);

  function save_file_path($file) {
    return $file && !empty($file) ? 'uploads/candidats/' . basename($file) : '';
  }

  // 🔁 1. Enregistrer la situation académique principale
  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
      'parcours'          => sanitize_text_field($situation['parcours'] ?? ''),
      'cycle'             => sanitize_text_field($situation['cycle'] ?? ''),
      'annee_academique'  => sanitize_text_field($situation['annee'] ?? ''),
      'baccalaureat'      => sanitize_text_field($situation['baccalaureat'] ?? ''),
      'etablissement'     => sanitize_text_field($situation['etablissement'] ?? ''),
      'session'           => sanitize_text_field($situation['session'] ?? ''),
      'mention'           => sanitize_text_field($situation['mention'] ?? ''),
      'moyenne'           => sanitize_text_field($situation['moyenne'] ?? ''),
      'piece_jointe_path' => save_file_path($situation['fichier_principal'] ?? ''),
      'ajouter_annee_blanche' => !empty($blanches),
      'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
      'piece_jointe_blanche_path' => save_file_path($situation['fichier_blanche'] ?? ''),
      'cause_blanche'     => sanitize_text_field($situation['cause'] ?? ''),
     //'niveau_master'     => sanitize_text_field($situation['niveau'] ?? 'M1'),
      'created_at'        => date('Y-m-d H:i:s')
  ]);




    // 🔁 Enregistrer ou mettre à jour dans la table utm_candidatures
  $master_id = intval($situation['master_id'] ?? 0);
  $niveau    = sanitize_text_field($situation['niveau'] ?? 'M1');

  // Vérifier si une ligne existe déjà pour ce candidat + master
  $existing = $wpdb->get_var($wpdb->prepare("
    SELECT id FROM {$wpdb->prefix}candidatures
    WHERE candidat_id = %d AND master_id = %d
    LIMIT 1
  ", $candidat_id, $master_id));

  if ($existing) {
    // Mise à jour
    $wpdb->update("{$wpdb->prefix}master_candidatures", [
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ], ['id' => $existing]);
    $candidature_id = $existing; // pour lier aux critères de score
  } else {
    // Insertion
    $wpdb->insert("{$wpdb->prefix}master_candidatures", [
      'candidat_id'      => $candidat_id,
      'master_id'        => $master_id,
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  }


  // 🔁 2. Enregistrer les parcours académiques
  foreach ($parcours as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'     => $candidat_id,
      'annee_academique'=> sanitize_text_field($row['annee'] ?? ''),
      'universite'      => sanitize_text_field($row['universite'] ?? ''),
      'etablissement'   => sanitize_text_field($row['etablissement'] ?? ''),
      'session'         => sanitize_text_field($row['session'] ?? ''),
      'mention'         => sanitize_text_field($row['mention'] ?? ''),
      'moyenne'         => sanitize_text_field($row['moyenne'] ?? ''),
      'credit'          => sanitize_text_field($row['credit'] ?? ''),
      'piece_jointe_path' => save_file_path($row['fichier'] ?? ''),
      'created_at'      => date('Y-m-d H:i:s')
    ]);
  }

  // 🔁 3. Enregistrer les années blanches
  foreach ($blanches as $row) {


    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id'       => $candidat_id,
      'nbannee'           => intval($row['nbannee'] ?? 0),
      'cause'             => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref'         => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => save_file_path($row['fichier'] ?? ''),
      'created_at'        => date('Y-m-d H:i:s')
    ]);
  }


  // 🔁 2. Enregistrer les années du parcours académique
  foreach ($parcours as $annee) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'        => $candidat_id,
      'annee_academique'   => sanitize_text_field($annee['annee'] ?? ''),
      'universite'         => sanitize_text_field($annee['universite'] ?? ''),
      'etablissement'      => sanitize_text_field($annee['etablissement'] ?? ''),
      'session'            => sanitize_text_field($annee['session'] ?? ''),
      'mention'            => sanitize_text_field($annee['mention'] ?? ''),
      'moyenne'            => sanitize_text_field($annee['moyenne'] ?? ''),
      'piece_jointe_path'  => save_file_path($annee['fichier'] ?? ''),
      'created_at'         => date('Y-m-d H:i:s'),
    ]);
  }

  

 

 
   // 🔁 Récupérer le score_id global une seule fois
  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$wpdb->prefix}master_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id,
    $niveau
  ));



  // 🔁 Insérer tous les critères sans lookup
  foreach ($criteres as $item) {
    $type = $item['type'] ?? '';
    $valeur = sanitize_text_field($item['valeur'] ?? '');
    $champ = '';
    $critere_id = null;

    switch ($type) {
      case 'critere':
        $critere_id = intval($item['critere_id']);
        $champ = 'critere';
        break;

      case 'matiere':
        $champ = 'matiere_id_' . intval($item['matiere_id'] ?? 0);
        break;

      case 'malus':
        $champ = 'malus_' . sanitize_title($item['condition'] ?? '');
        break;

      case 'interruption':
        $champ = 'interruption';
        break;

      default:
        $champ = sanitize_title($type);
    }

    // ✅ Insérer la ligne (critere_id peut être null, c’est volontaire)
    $wpdb->insert("{$wpdb->prefix}candidatures_score_criteres", [
      'candidature_id' => $candidature_id,
      'critere_id'     => $critere_id ?: null,
      'score_id'       => $score_id,
      'champ'          => $champ,
      'valeur'         => $valeur,
      'created_at'     => date('Y-m-d H:i:s')
    ]);
  }





  // 🔁 5. Enrichir table candidats si besoin (état spécifique, cycle)
  $wpdb->update("{$wpdb->prefix}candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin'     => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle'           => sanitize_text_field($situation['cycle'] ?? '')
  ], [
    'id' => $candidat_id
  ]);

  // ✅ 6. Mettre à jour l'état de la table master_candidats_adresses
  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], [
    'candidat_id' => $candidat_id
  ]);

  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}  

*/
/*
function gm_api_save_situation_academique(WP_REST_Request $request) {
  global $wpdb;

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();
  $personal = $data['personal'] ?? [];
  $situation = $data['situation'] ?? [];
  $parcours = $data['parcours_academiques'] ?? [];
  $blanches = $data['annees_blanches'] ?? [];
  $criteres = $data['criteres_score'] ?? [];

  $upload_base = wp_upload_dir()['basedir'] . '/candidats/';
  wp_mkdir_p($upload_base);

  function save_file_path($file) {
    return $file && !empty($file) ? 'uploads/candidats/' . basename($file) : '';
  }

  // 🔁 1. Enregistrer la situation académique principale
  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
    'parcours'          => sanitize_text_field($situation['parcours'] ?? ''),
    'cycle'             => sanitize_text_field($situation['cycle'] ?? ''),
    'annee_academique'  => sanitize_text_field($situation['annee'] ?? ''),
    'baccalaureat'      => sanitize_text_field($situation['baccalaureat'] ?? ''),
    'etablissement'     => sanitize_text_field($situation['etablissement'] ?? ''),
    'session'           => sanitize_text_field($situation['session'] ?? ''),
    'mention'           => sanitize_text_field($situation['mention'] ?? ''),
    'moyenne'           => sanitize_text_field($situation['moyenne'] ?? ''),
    'piece_jointe_path' => save_file_path($situation['fichier_principal'] ?? ''),
    'ajouter_annee_blanche' => !empty($blanches),
    'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
    'piece_jointe_blanche_path' => save_file_path($situation['fichier_blanche'] ?? ''),
    'cause_blanche'     => sanitize_text_field($situation['cause'] ?? ''),
    'created_at'        => date('Y-m-d H:i:s')
  ]);

  // 🔁 2. Insérer ou mettre à jour dans master_candidatures
  $master_id = intval($situation['master_id'] ?? 0);
  $niveau    = sanitize_text_field($situation['niveau'] ?? 'M1');

  $existing = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$wpdb->prefix}master_candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1",
    $candidat_id, $master_id
  ));

  if ($existing) {
    $wpdb->update("{$wpdb->prefix}master_candidatures", [
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ], ['id' => $existing]);
    $candidature_id = $existing;
  } else {
    $wpdb->insert("{$wpdb->prefix}master_candidatures", [
      'candidat_id'      => $candidat_id,
      'master_id'        => $master_id,
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  }

  // 🔁 3. Enregistrer les parcours académiques
  $niv = 1;
  foreach ($parcours as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'        => $candidat_id,
      'annee_academique'   => sanitize_text_field($row['annee'] ?? ''),
      'universite'         => sanitize_text_field($row['universite'] ?? ''),
      'etablissement'      => sanitize_text_field($row['etablissement'] ?? ''),
      'session'            => sanitize_text_field($row['session'] ?? ''),
      'mention'            => sanitize_text_field($row['mention'] ?? ''),
      'moyenne'            => sanitize_text_field($row['moyenne'] ?? ''),
      'credit'             => sanitize_text_field($row['credit'] ?? ''),
      'niveau'             => $niv++,
      'piece_jointe_path'  => save_file_path($row['fichier'] ?? ''),
      'created_at'         => date('Y-m-d H:i:s')
    ]);
  }

  // 🔁 4. Enregistrer les années blanches
  foreach ($blanches as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id'       => $candidat_id,
      'nbannee'           => intval($row['nbannee'] ?? 0),
      'cause'             => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref'         => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => save_file_path($row['fichier'] ?? ''),
      'created_at'        => date('Y-m-d H:i:s')
    ]);
  }

  // 🔁 5. Récupérer le score_id
  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$wpdb->prefix}master_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id, $niveau
  ));

  // 🔁 6. Enregistrer les valeurs des critères dans utm_candidats_score_values
  foreach ($criteres as $critere) {
    $template_id = intval($critere['template_id'] ?? 0);
    $valeur_json = !empty($critere['valeur_json']) ? wp_json_encode($critere['valeur_json']) : null;

    if ($template_id && $valeur_json && $score_id && $candidature_id) {
      $wpdb->insert("{$wpdb->prefix}candidats_score_values", [
        'candidature_id'  => $candidature_id,
        'score_id'        => $score_id,
        'template_id'     => $template_id,
        'valeur_json'     => $valeur_json,
        'date_soumission' => date('Y-m-d H:i:s')
      ]);
    }
  }

  // 🔁 7. Mise à jour du profil candidat
  $wpdb->update("{$wpdb->prefix}master_candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin'     => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle'           => sanitize_text_field($situation['cycle'] ?? '')
  ], ['id' => $candidat_id]);

  // 🔁 8. Valider l’adresse du candidat
  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], ['candidat_id' => $candidat_id]);


    $score = calculate_candidate_score($candidature_id,$score_id); 

   


    if (!is_null($score)) {
        $wpdb->update("{$wpdb->prefix}master_candidatures", [
          'score' => $score
        ], [
          'id' => $candidature_id
        ]);
      }


  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}
*/

function gm_api_save_situation_academiqueBackUp(WP_REST_Request $request) {
  global $wpdb;

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();
  $personal = $data['personal'] ?? [];
  $situation = $data['situation'] ?? [];
  $parcours = $data['parcours_academiques'] ?? [];
  $blanches = $data['annees_blanches'] ?? [];
  $criteres = $data['criteres_score'] ?? [];

  $upload_base = wp_upload_dir()['basedir'] . '/candidats/';
  wp_mkdir_p($upload_base);

  function save_file_path($file) {
    return $file && !empty($file) ? 'uploads/candidats/' . basename($file) : '';
  }

  // 🔁 1. Déduire master_id et niveau pour retrouver ou créer candidature
  $master_id = intval($situation['master_id'] ?? 0);
  $niveau    = sanitize_text_field($situation['niveau'] ?? 'M1');

  // 🔁 2. Vérifier candidature existante
  // $existing = $wpdb->get_var($wpdb->prepare(
  //   "SELECT id FROM {$wpdb->prefix}master_candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1",
  //   $candidat_id, $master_id
  // ));

  // if ($existing) {
  //   $wpdb->update("{$wpdb->prefix}master_candidatures", [
  //     'niveau'           => $niveau,
  //     'etat'             => 'soumis',
  //     'date_soumission'  => date('Y-m-d H:i:s')
  //   ], ['id' => $existing]);
  //   $candidature_id = $existing;
  // } 
  // else {
    $wpdb->insert("{$wpdb->prefix}master_candidatures", [
      'candidat_id'      => $candidat_id,
      'master_id'        => $master_id,
      'niveau'           => $niveau,
      'etat'             => 'soumis',
      'date_soumission'  => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  // }

  // 🔁 3. Récupérer score_id
  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM {$wpdb->prefix}master_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id, $niveau
  ));

  // 🧹 Supprimer anciens enregistrements liés à cette candidature
  $wpdb->delete("{$wpdb->prefix}candidats_situation_academique", ['candidat_id' => $candidat_id]);
  $wpdb->delete("{$wpdb->prefix}candidats_parcours_annees", ['candidat_id' => $candidat_id]);
  $wpdb->delete("{$wpdb->prefix}candidats_annees_blanches", ['candidat_id' => $candidat_id]);

  if ($score_id && $candidature_id) {
    $wpdb->delete("{$wpdb->prefix}candidats_score_values", [
      'candidature_id' => $candidature_id,
      'score_id'       => $score_id
    ]);
  }

  // 🔁 4. Réinsérer situation académique
  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
    'parcours'          => sanitize_text_field($situation['parcours'] ?? ''),
    'cycle'             => sanitize_text_field($situation['cycle'] ?? ''),
    'annee_academique'  => sanitize_text_field($situation['annee'] ?? ''),
    'baccalaureat'      => sanitize_text_field($situation['baccalaureat'] ?? ''),
    'etablissement'     => sanitize_text_field($situation['etablissement'] ?? ''),
    'session'           => sanitize_text_field($situation['session'] ?? ''),
    'mention'           => sanitize_text_field($situation['mention'] ?? ''),
    'moyenne'           => sanitize_text_field($situation['moyenne'] ?? ''),
    'piece_jointe_path' => save_file_path($situation['fichier_principal'] ?? ''),
    'ajouter_annee_blanche' => !empty($blanches),
    'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
    'piece_jointe_blanche_path' => save_file_path($situation['fichier_blanche'] ?? ''),
    'cause_blanche'     => sanitize_text_field($situation['cause'] ?? ''),
    'created_at'        => date('Y-m-d H:i:s')
  ]);

  // 🔁 5. Réinsérer parcours
  $niv = 1;
  foreach ($parcours as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id'        => $candidat_id,
      'annee_academique'   => sanitize_text_field($row['annee'] ?? ''),
      'cursus_title'       => sanitize_text_field($row['cursus_title'] ?? ''),
      'universite'         => sanitize_text_field($row['universite'] ?? ''),
      'etablissement'      => sanitize_text_field($row['etablissement'] ?? ''),
      'session'            => sanitize_text_field($row['session'] ?? ''),
      'mention'            => sanitize_text_field($row['mention'] ?? ''),
      'moyenne'            => sanitize_text_field($row['moyenne'] ?? ''),
      'credit'             => sanitize_text_field($row['credit'] ?? ''),
      'niveau'             => $niv++,
      'piece_jointe_path'  => save_file_path($row['fichier'] ?? ''),
      'created_at'         => date('Y-m-d H:i:s')
    ]);
  }

  // 🔁 6. Réinsérer années blanches
  foreach ($blanches as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id'       => $candidat_id,
      'nbannee'           => intval($row['nbannee'] ?? 0),
      'cause'             => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref'         => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => save_file_path($row['fichier'] ?? ''),
      'created_at'        => date('Y-m-d H:i:s')
    ]);
  }

  // 🔁 7. Réinsérer critères de score
  foreach ($criteres as $critere) {


    $template_id = intval($critere['template_id'] ?? 0);
  //$valeur_json = !empty($critere['valeur_json']) ? wp_json_encode($critere['valeur_json']) : null;

    $valeur_json = !empty($critere['valeur_json'])
    ? wp_json_encode($critere['valeur_json'], JSON_UNESCAPED_UNICODE)
    : null;



    if ($template_id && $valeur_json && $score_id && $candidature_id) {
      $wpdb->insert("{$wpdb->prefix}candidats_score_values", [
        'candidature_id'  => $candidature_id,
        'score_id'        => $score_id,
        'template_id'     => $template_id,
        'valeur_json'     => $valeur_json,
        'date_soumission' => date('Y-m-d H:i:s')
      ]);
    }
  }

  // 🔁 8. Mise à jour candidat
  $wpdb->update("{$wpdb->prefix}master_candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin'     => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle'           => sanitize_text_field($situation['cycle'] ?? '')
  ], ['id' => $candidat_id]);

  // 🔁 9. Valider adresse
  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], ['candidat_id' => $candidat_id]);

  // 🔁 10. Calculer et enregistrer score
  $score = calculate_candidate_score($candidature_id, $score_id);
  if (!is_null($score)) {
    $wpdb->update("{$wpdb->prefix}master_candidatures", [
      'score' => $score
    ], [
      'id' => $candidature_id
    ]);
  }

  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}

function restructure_files_array($files) {
    $result = [];
    foreach ($files['name'] as $key => $name) {
        $result[$key] = [
            'name' => $name,
            'type' => $files['type'][$key],
            'tmp_name' => $files['tmp_name'][$key],
            'error' => $files['error'][$key],
            'size' => $files['size'][$key],
        ];
    }
    return $result;
}

function save_uploaded_file($file, $upload_base) {
    if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
        error_log("❌ Fichier vide ou erreur d'upload");
        return '';
    }

    $allowed_types = ['application/pdf'];
    if ($file['size'] > 5 * 1024 * 1024) {
        error_log("❌ Fichier trop volumineux : " . $file['size']);
        return '';
    }

    $filename = sanitize_file_name($file['name']);
    $filename = wp_unique_filename($upload_base, $filename);
    $filepath = $upload_base . $filename;

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        error_log("❌ move_uploaded_file échoué : {$file['tmp_name']} => {$filepath}");
        return '';
    }

    return 'uploads/candidats/' . $filename;
}

function gm_api_save_situation_academique(WP_REST_Request $request) {

    global $wpdb;
    
    $user_id = get_current_user_id();
    $candidat_id = get_user_meta($user_id, 'candidat_id', true);

    if (!$candidat_id) {
        return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
    }

    // Récupération des données JSON
    $post_params = $request->get_body_params();
    $personal = json_decode($post_params['personal'] ?? '{}', true);
    $situation = json_decode($post_params['situation'] ?? '{}', true);
    $parcours = json_decode($post_params['parcours_academiques'] ?? '[]', true);
    $blanches = json_decode($post_params['annees_blanches'] ?? '[]', true);
    $criteres = json_decode($post_params['criteres_score'] ?? '[]', true);

    // Récupération des fichiers
    $files = $request->get_file_params();

 


    
    
    // Répertoire d'upload
    $upload_dir = wp_upload_dir();
    $upload_base = $upload_dir['basedir'] . '/candidats/';
    wp_mkdir_p($upload_base);

    // Traitement des fichiers
    $uploaded_files = [];
    if (isset($files['files']) && is_array($files['files'])) {
        $files_restructured = restructure_files_array($files['files']);

        // Nouveau: stockage temporaire pour les fichiers multiples
        $cursusFiles = [];
        $blancheFiles = [];
        
        foreach ($files_restructured as $key => $file) {
            // Handle Bac file
            if (stripos($key, 'Bac') !== false || stripos($key, 'bac') !== false) {

   
                if (is_uploaded_file_valid($file)) {
                      $situation['fichier_principal'] = save_uploaded_file($file, $upload_base);
                     $uploaded_files['Bac'] = $situation['fichier_principal'];
                }
               

              //  die();
              
            }
            
            // Handle Cursus_Licence files with new pattern: Cursus_Licence_{cursusIndex}_{fileIndex}
            elseif (preg_match('/Cursus_Licence_(\d+)_(\d+)/', $key, $matches)) {
                $cursusIndex = $matches[1];
                $fileIndex = $matches[2];
                
                if (!isset($cursusFiles[$cursusIndex])) {
                    $cursusFiles[$cursusIndex] = [];
                }
                
                $file_path = save_uploaded_file($file, $upload_base);
                if ($file_path) {
                    $cursusFiles[$cursusIndex][$fileIndex] = $file_path;
                }
            }
            
            // Handle Annee_Blanche files with new pattern: Annee_Blanche_{blancheIndex}_{fileIndex}
            elseif (preg_match('/Annee_Blanche_(\d+)_(\d+)/', $key, $matches)) {
                $blancheIndex = $matches[1];
                $fileIndex = $matches[2];
                
                if (!isset($blancheFiles[$blancheIndex])) {
                    $blancheFiles[$blancheIndex] = [];
                }
                
                $file_path = save_uploaded_file($file, $upload_base);
                if ($file_path) {
                    $blancheFiles[$blancheIndex][$fileIndex] = $file_path;
                }
            }
        }
        
        // Assign collected files to parcours and blanches
        foreach ($cursusFiles as $index => $files) {
            if (isset($parcours[$index])) {
                $parcours[$index]['fichiers'] = array_values($files); // Convert to sequential array
            }
        }
        
        foreach ($blancheFiles as $index => $files) {
            if (isset($blanches[$index])) {
                $blanches[$index]['fichiers'] = array_values($files); // Convert to sequential array
            }
        }
    }

    // 🔁 1. Get master_id and niveau
    $master_id = intval($situation['master_id'] ?? 0);
    $niveau = sanitize_text_field($situation['niveau'] ?? 'M1');

    // 🔁 2. Check existing candidature
    /*
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}master_candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1",
        $candidat_id, $master_id
    ));

    if ($existing) {
        $wpdb->update("{$wpdb->prefix}master_candidatures", [
            'niveau' => $niveau,
            'etat' => 'soumis',
            'date_soumission' => date('Y-m-d H:i:s')
        ], ['id' => $existing]);
        $candidature_id = $existing;
    } else {
        $wpdb->insert("{$wpdb->prefix}master_candidatures", [
            'candidat_id' => $candidat_id,
            'master_id' => $master_id,
            'niveau' => $niveau,
            'etat' => 'soumis',
            'date_soumission' => date('Y-m-d H:i:s')
        ]);
        $candidature_id = $wpdb->insert_id;
    }

    */
    
    // 🔁 2. Insertion ou MAJ de la candidature
if ($institut_id === 8) {
    // ➕ Cas FDST : master_id est null, classement multiple dans utm_candidature_choix
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}master_candidatures 
         WHERE candidat_id = %d AND institut_id = 8 AND master_id IS NULL LIMIT 1",
        $candidat_id
    ));

    if ($existing) {
        // 🔁 Mise à jour existante
        $wpdb->update("{$wpdb->prefix}master_candidatures", [
            'niveau' => $niveau,
            'etat' => 'soumis',
            'date_soumission' => current_time('mysql')
        ], ['id' => $existing]);
        $candidature_id = $existing;

        // Supprimer les anciens choix pour réinsertion
        $wpdb->delete("{$wpdb->prefix}candidature_choix", [
            'candidature_id' => $candidature_id
        ]);
    } else {
        // ➕ Nouvelle insertion FDST
        $wpdb->insert("{$wpdb->prefix}master_candidatures", [
            'candidat_id' => $candidat_id,
            'master_id' => null,
            'institut_id' => $institut_id,
            'niveau' => $niveau,
            'etat' => 'soumis',
            'type_candidature' => 'fdst',
            'date_soumission' => current_time('mysql')
        ]);
        $candidature_id = $wpdb->insert_id;
    }

    // ➕ Insertion des choix multiples
    if (is_array($classements)) {
        foreach ($classements as $choix) {
            if (!empty($choix['master_id']) && !empty($choix['ordre'])) {
                $wpdb->insert("{$wpdb->prefix}candidature_choix", [
                    'candidature_id' => $candidature_id,
                    'master_id' => intval($choix['master_id']),
                    'choix' => intval($choix['ordre'])
                ]);
            }
        }
    }
} else {
    // 🔁 Cas normal (1 master)
    $master_id = intval($situation['master_id'] ?? 0);
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}master_candidatures 
         WHERE candidat_id = %d AND master_id = %d LIMIT 1",
        $candidat_id, $master_id
    ));

    if ($existing) {
        $wpdb->update("{$wpdb->prefix}master_candidatures", [
            'niveau' => $niveau,
            'etat' => 'soumis',
            'date_soumission' => current_time('mysql')
        ], ['id' => $existing]);
        $candidature_id = $existing;
    } else {
        $wpdb->insert("{$wpdb->prefix}master_candidatures", [
            'candidat_id' => $candidat_id,
            'master_id' => $master_id,
            'niveau' => $niveau,
            'etat' => 'soumis',
            'type_candidature' => 'unique',
            'date_soumission' => current_time('mysql')
        ]);
        $candidature_id = $wpdb->insert_id;
    }
}

    // 🔁 3. Get score_id
    /*$score_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}master_score WHERE master_id = %d AND niveau = %s LIMIT 1",
        $master_id, $niveau
    ));*/

    $score_id = null;

    // Cas normal : récupération via master_id
    if ($master_id && $niveau && $institut_id !== 8) {
        $score_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}master_score 
            WHERE master_id = %d AND niveau = %s LIMIT 1",
            $master_id, $niveau
        ));
    }

    // Cas spécial FDST : récupérer score via institut_id + niveau + cycle (diplome)
    elseif ($institut_id === 8 && $niveau && !empty($situation['cycle'])) {
        $cycle = sanitize_text_field($situation['cycle']);

        $score_id = $wpdb->get_var($wpdb->prepare("
            SELECT m.id
            FROM {$wpdb->prefix}master_score m
            INNER JOIN {$wpdb->prefix}master_fichemaster fm ON fm.id = m.master_id
            INNER JOIN {$wpdb->prefix}master_instituts et ON et.id = fm.institut_id
            WHERE fm.institut_id = %d AND m.niveau = %s AND m.diplome = %s
            LIMIT 1
        ", $institut_id, $niveau, $cycle));
    }


    // 🧹 Clean old records
    $wpdb->delete("{$wpdb->prefix}candidats_situation_academique", ['candidat_id' => $candidat_id]);
    $wpdb->delete("{$wpdb->prefix}candidats_parcours_annees", ['candidat_id' => $candidat_id]);
    $wpdb->delete("{$wpdb->prefix}candidats_annees_blanches", ['candidat_id' => $candidat_id]);

    if ($score_id && $candidature_id) {
        $wpdb->delete("{$wpdb->prefix}candidats_score_values", [
            'candidature_id' => $candidature_id,
            'score_id' => $score_id
        ]);
    }


    // 🔁 4. Save academic situation
    $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
        'candidat_id' => $candidat_id,
        'parcours' => sanitize_text_field($situation['parcours'] ?? ''),
        'cycle' => sanitize_text_field($situation['cycle'] ?? ''),
        'annee_academique' => sanitize_text_field($situation['annee'] ?? ''),
        'baccalaureat' => sanitize_text_field($situation['baccalaureat'] ?? ''),
        'etablissement' => sanitize_text_field($situation['etablissement'] ?? ''),
        'session' => sanitize_text_field($situation['session'] ?? ''),
        'mention' => sanitize_text_field($situation['mention'] ?? ''),
        'moyenne' => sanitize_text_field($situation['moyenne'] ?? ''),
        'piece_jointe_path' => $situation['fichier_principal'] ?? '',
        'ajouter_annee_blanche' => !empty($blanches),
        'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
        'cause_blanche' => sanitize_text_field($situation['cause'] ?? ''),
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 🔁 5. Save academic path with file paths
    $niv = 1;
    foreach ($parcours as $index => $row) {
     

        $fichiers = $row['fichiers'] ?? [];
   


        $niveauKey = $niv - 1; // ou juste $niv si $niv commence à 0
        $path_attestation = $fichiers[0] ?? '';
        $path_releve      = $fichiers[1] ?? '';
  

        $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
            'candidat_id' => $candidat_id,
            'annee_academique' => sanitize_text_field($row['annee'] ?? ''),
            'universite' => sanitize_text_field($row['universite'] ?? ''),
            'etablissement' => sanitize_text_field($row['etablissement'] ?? ''),
            'session' => sanitize_text_field($row['session'] ?? ''),
            'mention' => sanitize_text_field($row['mention'] ?? ''),
            'moyenne' => sanitize_text_field($row['moyenne'] ?? ''),
            'credit' => sanitize_text_field($row['credit'] ?? ''),
            'niveau' => $niv++,
            'piece_jointe_path' => json_encode($fichiers),
            'piece_jointe_path_attestation' => $path_attestation,
            'piece_jointe_path_releve'      => $path_releve,
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }


    // 🔁 6. Save blank years with file paths
    foreach ($blanches as $index => $row) {
        $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
            'candidat_id' => $candidat_id,
            'nbannee' => intval($row['nbannee'] ?? 0),
            'cause' => sanitize_text_field($row['cause'] ?? ''),
            'annee_ref' => sanitize_text_field($row['annee_ref'] ?? ''),
            'piece_jointe_path' => isset($row['fichiers']) ? json_encode($row['fichiers']) : '',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // 🔁 7. Save score criteria
    $grouped = [];
    foreach ($criteres as $critere) {
        $name = $critere['name'] ?? '';
        $value = $critere['value'] ?? '';
        $etudiee = $critere['etudiee'] ?? null;
        $label = $critere['label'] ?? null;
        $matiere = $critere['matiere'] ?? null;
        $annee = $critere['annee'] ?? null;

        preg_match('/critere\[[^\]]+\]_(\d+)/', $name, $matches);
        $template_id = isset($matches[1]) ? intval($matches[1]) : 0;
        if (!$template_id || !$score_id || !$candidature_id) continue;

        if (!isset($grouped[$template_id])) {
            $grouped[$template_id] = [];
        }

        if (!is_null($etudiee) && $matiere && $annee) {
            $grouped[$template_id][] = [
                'matiere' => $matiere,
                'annee' => $annee,
                'note' => $value
            ];
        } elseif (!is_null($label)) {
            $key = preg_replace('/^critere\[[^\]]+\]_\d+_/', '', $name);
            $grouped[$template_id][$key] = [
                'valeur' => $value,
                'label' => $label
            ];
        } else {
            $key = preg_replace('/^critere\[[^\]]+\]_\d+_/', '', $name);
            $grouped[$template_id][$key] = [
                'valeur' => $value
            ];
        }
    }

    foreach ($grouped as $template_id => $valeur) {
        $valeur_finale = [];

        if (isset($valeur[0]) && is_array($valeur[0]) && isset($valeur[0]['matiere'])) {
            $valeur_finale = ['matieres' => $valeur];
        } else {
            $valeur_finale = $valeur;
        }

        $wpdb->insert("{$wpdb->prefix}candidats_score_values", [
            'candidature_id' => $candidature_id,
            'score_id' => $score_id,
            'template_id' => $template_id,
            'valeur_json' => wp_json_encode($valeur_finale, JSON_UNESCAPED_UNICODE),
            'date_soumission' => date('Y-m-d H:i:s')
        ]);
    }

    // 🔁 8. Update candidate
    $wpdb->update("{$wpdb->prefix}master_candidats", [
        'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
        'type_besoin' => sanitize_text_field($personal['type_besoin'] ?? ''),
        'cycle' => sanitize_text_field($situation['cycle'] ?? '')
    ], ['id' => $candidat_id]);

    // 🔁 9. Validate address
    $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
        'etat' => 'validé'
    ], ['candidat_id' => $candidat_id]);

    // 🔁 10. Calculate and save score
    $score = calculate_candidate_score($candidature_id, $score_id);
    if (!is_null($score)) {
        $wpdb->update("{$wpdb->prefix}master_candidatures", [
            'score' => $score
        ], ['id' => $candidature_id]);
    }

    return rest_ensure_response([
        'success' => true,
        'message' => '📌 Situation académique et score enregistrés avec succès.',
        'candidature_id' => $candidature_id,
        'uploaded_files' => $uploaded_files
    ]);
}


function is_uploaded_file_valid($file, $max_size_mb = 5) {
    if (
        empty($file) ||
        !isset($file['tmp_name']) ||
        $file['error'] !== UPLOAD_ERR_OK ||
        !is_uploaded_file($file['tmp_name'])
    ) {
        return false;
    }

    // Vérifie que le fichier n'est pas vide et a une taille raisonnable
    if ($file['size'] <= 0 || $file['size'] > $max_size_mb * 1024 * 1024) {
        return false;
    }

    // Vérifie que le fichier est lisible
    $handle = @fopen($file['tmp_name'], 'rb');
    if ($handle === false) {
        return false;
    }
    // Essaye de lire une petite portion du fichier
    $chunk = fread($handle, 1024);
    fclose($handle);

    // Si la lecture échoue ou que le contenu est vide
    if ($chunk === false || strlen(trim($chunk)) === 0) {
        return false;
    }

    return true;
}


// function restructure_files_array($files) {
//     $result = [];
//     foreach ($files['name'] as $key => $name) {
//         $result[$key] = [
//             'name' => $name,
//             'type' => $files['type'][$key],
//             'tmp_name' => $files['tmp_name'][$key],
//             'error' => $files['error'][$key],
//             'size' => $files['size'][$key],
//         ];
//     }
//     return $result;
// }
// function save_uploaded_file($file, $upload_base) {
//   //  var_dump("📎 Fichier reçu : " . print_r($file, true));

//     if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
//         error_log("❌ Fichier vide ou erreur d'upload");
//         return '';
//     }

//     $allowed_types = ['application/pdf'];
//     // if (!in_array($file['type'], $allowed_types)) {
//     //     error_log("❌ Type non autorisé : " . $file['type']);
//     //     return '';
//     // }

//     if ($file['size'] > 5 * 1024 * 1024) {
//         error_log("❌ Fichier trop volumineux : " . $file['size']);
//         return '';
//     }

//     $filename = sanitize_file_name($file['name']);
//     $filename = wp_unique_filename($upload_base, $filename);
//     $filepath = $upload_base . $filename;

//     if (!move_uploaded_file($file['tmp_name'], $filepath)) {
//         error_log("❌ move_uploaded_file échoué : {$file['tmp_name']} => {$filepath}");
//         return '';
//     }

//     // error_log("✅ Fichier enregistré : " . $filepath , $filename);
//     return 'uploads/candidats/' . $filename;
// }


// function gm_api_save_situation_academique(WP_REST_Request $request) {

//     global $wpdb;
    
//     $user_id = get_current_user_id();
//     $candidat_id = get_user_meta($user_id, 'candidat_id', true);

//     if (!$candidat_id) 
//     {
//       return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
//     }

//     // Récupération des données JSON
//     $post_params = $request->get_body_params();
//     $personal = json_decode($post_params['personal'] ?? '{}', true);
//     $situation = json_decode($post_params['situation'] ?? '{}', true);
//     $parcours = json_decode($post_params['parcours_academiques'] ?? '[]', true);
//     $blanches = json_decode($post_params['annees_blanches'] ?? '[]', true);
//     $criteres = json_decode($post_params['criteres_score'] ?? '[]', true);

//     // Récupération des fichiers
//     $files = $request->get_file_params();
    
//     // Répertoire d'upload
//     $upload_dir = wp_upload_dir();
//     $upload_base = $upload_dir['basedir'] . '/candidats/';
//     wp_mkdir_p($upload_base);

//     // Traitement des fichiers
//     $uploaded_files = [];
//     if (isset($files['files']) && is_array($files['files'])) {
//         $files_restructured = restructure_files_array($files['files']);

//         foreach ($files_restructured as $key => $file) {
//             // Handle Bac file
//             if (stripos($key, 'Bac') !== false || stripos($key, 'bac') !== false) {
//                 $situation['fichier_principal'] = save_uploaded_file($file, $upload_base);
//                 $uploaded_files['Bac'] = $situation['fichier_principal'];
//             }

//             // Handle Annee Blanche file
//             if (stripos($key, 'Annee_Blanche') !== false) {
//                 $situation['fichier_blanche'] = save_uploaded_file($file, $upload_base);
//                 $uploaded_files['blanche'] = $situation['fichier_blanche'];
//             }

//             // Handle Cursus Licence files
//             if (stripos($key, 'Cursus_Licence') !== false) {
//                 $index = intval(preg_replace('/[^0-9]/', '', $key));
//                 if (isset($parcours[$index])) {
//                     $parcours[$index]['fichier'] = save_uploaded_file($file, $upload_base);
//                     $uploaded_files['cursus_'.$index] = $parcours[$index]['fichier'];
//                 }
//             }

//             // Handle Annee Blanche files (for the array)
//             if (stripos($key, 'Annee_Blanche_Array') !== false) {
//                 $index = intval(preg_replace('/[^0-9]/', '', $key));
//                 if (isset($blanches[$index])) {
//                     $blanches[$index]['fichier'] = save_uploaded_file($file, $upload_base);
//                     $uploaded_files['blanche_array_'.$index] = $blanches[$index]['fichier'];
//                 }
//             }
//         }
//     }

//     // 🔁 1. Get master_id and niveau
//     $master_id = intval($situation['master_id'] ?? 0);
//     $niveau = sanitize_text_field($situation['niveau'] ?? 'M1');

//     // 🔁 2. Check existing candidature
//     $existing = $wpdb->get_var($wpdb->prepare(
//         "SELECT id FROM {$wpdb->prefix}master_candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1",
//         $candidat_id, $master_id
//     ));

//     if ($existing) {
//         $wpdb->update("{$wpdb->prefix}master_candidatures", [
//             'niveau' => $niveau,
//             'etat' => 'soumis',
//             'date_soumission' => date('Y-m-d H:i:s')
//         ], ['id' => $existing]);
//         $candidature_id = $existing;
//     } else {
//         $wpdb->insert("{$wpdb->prefix}master_candidatures", [
//             'candidat_id' => $candidat_id,
//             'master_id' => $master_id,
//             'niveau' => $niveau,
//             'etat' => 'soumis',
//             'date_soumission' => date('Y-m-d H:i:s')
//         ]);
//         $candidature_id = $wpdb->insert_id;
//     }

//     // 🔁 3. Get score_id
//     $score_id = $wpdb->get_var($wpdb->prepare(
//         "SELECT id FROM {$wpdb->prefix}master_score WHERE master_id = %d AND niveau = %s LIMIT 1",
//         $master_id, $niveau
//     ));

//     // 🧹 Clean old records
//     $wpdb->delete("{$wpdb->prefix}candidats_situation_academique", ['candidat_id' => $candidat_id]);
//     $wpdb->delete("{$wpdb->prefix}candidats_parcours_annees", ['candidat_id' => $candidat_id]);
//     $wpdb->delete("{$wpdb->prefix}candidats_annees_blanches", ['candidat_id' => $candidat_id]);

//     if ($score_id && $candidature_id) {
//         $wpdb->delete("{$wpdb->prefix}candidats_score_values", [
//             'candidature_id' => $candidature_id,
//             'score_id' => $score_id
//         ]);
//     }

//     // 🔁 4. Save academic situation with file paths
//     $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
//         'candidat_id' => $candidat_id,
//         'parcours' => sanitize_text_field($situation['parcours'] ?? ''),
//         'cycle' => sanitize_text_field($situation['cycle'] ?? ''),
//         'annee_academique' => sanitize_text_field($situation['annee'] ?? ''),
//         'baccalaureat' => sanitize_text_field($situation['baccalaureat'] ?? ''),
//         'etablissement' => sanitize_text_field($situation['etablissement'] ?? ''),
//         'session' => sanitize_text_field($situation['session'] ?? ''),
//         'mention' => sanitize_text_field($situation['mention'] ?? ''),
//         'moyenne' => sanitize_text_field($situation['moyenne'] ?? ''),
//         'piece_jointe_path' => $situation['fichier_principal'] ?? '',
//         'ajouter_annee_blanche' => !empty($blanches),
//         'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
//         'piece_jointe_blanche_path' => $situation['fichier_blanche'] ?? '',
//         'cause_blanche' => sanitize_text_field($situation['cause'] ?? ''),
//         'created_at' => date('Y-m-d H:i:s')
//     ]);

//     // 🔁 5. Save academic path with file paths
//     $niv = 1;
//     foreach ($parcours as $row) {
//         $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
//             'candidat_id' => $candidat_id,
//             'annee_academique' => sanitize_text_field($row['annee'] ?? ''),
//             'universite' => sanitize_text_field($row['universite'] ?? ''),
//             'etablissement' => sanitize_text_field($row['etablissement'] ?? ''),
//             'session' => sanitize_text_field($row['session'] ?? ''),
//             'mention' => sanitize_text_field($row['mention'] ?? ''),
//             'moyenne' => sanitize_text_field($row['moyenne'] ?? ''),
//             'credit' => sanitize_text_field($row['credit'] ?? ''),
//             'niveau' => $niv++,
//             'piece_jointe_path' => $row['fichier'] ?? '',
//             'created_at' => date('Y-m-d H:i:s')
//         ]);
//     }

//     // 🔁 6. Save blank years with file paths
//     foreach ($blanches as $row) {
//         $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
//             'candidat_id' => $candidat_id,
//             'nbannee' => intval($row['nbannee'] ?? 0),
//             'cause' => sanitize_text_field($row['cause'] ?? ''),
//             'annee_ref' => sanitize_text_field($row['annee_ref'] ?? ''),
//             'piece_jointe_path' => $row['fichier'] ?? '',
//             'created_at' => date('Y-m-d H:i:s')
//         ]);
//     }



//     //  7. Save score criteria
//    /* foreach ($criteres as $critere) {
//         $template_id = intval($critere['template_id'] ?? 0);
//         $valeur_json = !empty($critere['valeur_json'])
//             ? wp_json_encode($critere['valeur_json'], JSON_UNESCAPED_UNICODE)
//             : null;

//         if ($template_id && $valeur_json && $score_id && $candidature_id) {
//             $wpdb->insert("{$wpdb->prefix}candidats_score_values", [
//                 'candidature_id' => $candidature_id,
//                 'score_id' => $score_id,
//                 'template_id' => $template_id,
//                 'valeur_json' => $valeur_json,
//                 'date_soumission' => date('Y-m-d H:i:s')
//             ]);
//         }
//     }*/


//     //  7. Save score criteria
 
//     $grouped = [];

//     foreach ($criteres as $critere) {
//         $name = $critere['name'] ?? '';
//         $value = $critere['value'] ?? '';
//         $etudiee = $critere['etudiee'] ?? null;
//         $label = $critere['label'] ?? null;
//         $matiere = $critere['matiere'] ?? null;
//         $annee = $critere['annee'] ?? null;

//         // 🎯 Extraire le template_id
//         preg_match('/critere\[[^\]]+\]_(\d+)/', $name, $matches);
//         $template_id = isset($matches[1]) ? intval($matches[1]) : 0;
//         if (!$template_id || !$score_id || !$candidature_id) continue;

//         // ✅ Init group par template_id
//         if (!isset($grouped[$template_id])) {
//             $grouped[$template_id] = [];
//         }

//         // ✅ Traitement spécifique pour les matières
//         if (!is_null($etudiee) && $matiere && $annee) {
//             $grouped[$template_id][] = [
//                 'matiere' => $matiere,
//                 'annee' => $annee,
//                 'note' => $value
//             ];
//         }

//         // ✅ Traitement malus avec label
//         elseif (!is_null($label)) {
//             // ex: Redoublement => ['valeur' => 0.6, 'label' => '2 fois']
//             $key = preg_replace('/^critere\[[^\]]+\]_\d+_/', '', $name);
//             $grouped[$template_id][$key] = [
//                 'valeur' => $value,
//                 'label' => $label
//             ];
//         }

//         // ✅ Traitement simple (ex: interruption, pfe...)
//         else {
//             $key = preg_replace('/^critere\[[^\]]+\]_\d+_/', '', $name);
//             $grouped[$template_id][$key] = [
//                 'valeur' => $value
//             ];
//         }
//     }

//     // ✅ Enregistrement en BDD
//     foreach ($grouped as $template_id => $valeur) {
//         $valeur_finale = [];

//         if (isset($valeur[0]) && is_array($valeur[0]) && isset($valeur[0]['matiere'])) {
//             $valeur_finale = ['matieres' => $valeur];
//         } else {
//             $valeur_finale = $valeur;
//         }

//         $wpdb->insert("{$wpdb->prefix}candidats_score_values", [
//             'candidature_id' => $candidature_id,
//             'score_id' => $score_id,
//             'template_id' => $template_id,
//             'valeur_json' => wp_json_encode($valeur_finale, JSON_UNESCAPED_UNICODE),
//             'date_soumission' => date('Y-m-d H:i:s')
//         ]);
//     }





//     // 🔁 8. Update candidate
//     $wpdb->update("{$wpdb->prefix}master_candidats", [
//         'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
//         'type_besoin' => sanitize_text_field($personal['type_besoin'] ?? ''),
//         'cycle' => sanitize_text_field($situation['cycle'] ?? '')
//     ], ['id' => $candidat_id]);

//     // 🔁 9. Validate address
//     $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
//         'etat' => 'validé'
//     ], ['candidat_id' => $candidat_id]);

//     // 🔁 10. Calculate and save score
//     $score = calculate_candidate_score($candidature_id, $score_id);


//     if (!is_null($score)) {
//         $wpdb->update("{$wpdb->prefix}master_candidatures", [
//             'score' => $score
//         ], [
//             'id' => $candidature_id
//         ]);
//     }

//     return rest_ensure_response([
//         'success' => true,
//         'message' => '📌 Situation académique et score enregistrés avec succès.',
//         'candidature_id' => $candidature_id,
//         'uploaded_files' => $uploaded_files // Optionally return uploaded files info
//     ]);
// }
/*
function calculate_candidate_score($candidature_id, $score_id) {
  global $wpdb;




  // 1. Récupération de la formule
  $formule_json = $wpdb->get_var($wpdb->prepare(
    "SELECT formule_json FROM {$wpdb->prefix}master_score WHERE id = %d LIMIT 1",
    $score_id
  ));



  if (!$formule_json) return null;
  $formule = json_decode($formule_json, true);
  if (!is_array($formule)) return null;

  // 2. Candidat lié
  $candidat_id = $wpdb->get_var($wpdb->prepare(
    "SELECT candidat_id FROM {$wpdb->prefix}master_candidatures WHERE id = %d LIMIT 1",
    $candidature_id
  ));
  if (!$candidat_id) return null;

  $valeurs = [];

  // 3. Valeurs saisies (utm_candidats_score_values)
  $valeurs_raw = $wpdb->get_results($wpdb->prepare(
    "SELECT valeur_json , template_id
    FROM {$wpdb->prefix}candidats_score_values
     WHERE candidature_id = %d AND score_id = %d",
    $candidature_id, $score_id
  ));

  foreach ($valeurs_raw as $row) {
    $v = json_decode($row->valeur_json, true);
    if (!is_array($v)) continue;
    foreach ($v as $k => $val) {
      if (is_numeric($val)) {
        $valeurs[$k] = floatval($val);
      } elseif (is_array($val)) {
        foreach ($val as $k2 => $val2) {
          if (is_numeric($val2)) {
            $valeurs[$k2] = floatval($val2);
          }
        }
      }
    }
  }

  // 4. Parcours académique
  $parcours = $wpdb->get_results($wpdb->prepare(
    "SELECT annee_academique, moyenne, credit, mention , niveau , session
     FROM {$wpdb->prefix}candidats_parcours_annees
     WHERE candidat_id = %d", $candidat_id
  ));

  $niveauLabels2 = [ '1' => 'L1', '2' => 'L2', '3' => 'L3' ];
  $niveauLabels = [ '1' => 'Première année', '2' => 'Deuxième année', '3' => 'Troisième année' ];

  foreach ($parcours as $p) {
    $niveau = trim((string) $p->niveau);
    $labelCourt = $niveauLabels2[$niveau] ?? $niveau;
    $labelLong  = $niveauLabels[$niveau] ?? $niveau;

    if ($p->moyenne)  $valeurs["Moyenne $labelCourt"] = floatval($p->moyenne);
    if ($p->credit)   $valeurs["CR$niveau $labelCourt"] = floatval($p->credit);
    if ($p->mention)  $valeurs["Mention $niveau"] = $p->mention;
    if ($p->session)  $valeurs["Session $niveau"] = $p->session;

  }

  // 5. Traitement des critères
  $criteres = $wpdb->get_results($wpdb->prepare(
    "SELECT c.config_json, c.template_id, t.nom_template, t.titre_affiche, t.type
     FROM {$wpdb->prefix}master_score_criteres c
     INNER JOIN {$wpdb->prefix}master_score_templates t ON c.template_id = t.id
     WHERE c.score_id = %d", $score_id
  ));

  var_dump("citeres");
  var_dump($criteres);

  foreach ($criteres as $crit) {
    $cfg = json_decode($crit->config_json, true);
    if (!is_array($cfg)) continue;

    $templateType  = $crit->type;
    $titreAffiche  = trim($crit->titre_affiche);

    // ✅ Bonus mention par année
    if (!empty($cfg['bonus_mention'])) {
      $bonus = 0;
      foreach ($cfg['bonus_mention'] as $bm) {
        $label_cfg = strtolower(trim($bm['annee']));
        foreach ($niveauLabels as $niveau_num => $libelle_config) {
          if (strtolower($libelle_config) === $label_cfg) {
            $mention_candidat = $valeurs["Mention $niveau_num"] ?? null;
            if ($mention_candidat) {
              $mention_candidat = strtolower(trim($mention_candidat));
              foreach ($bm['mentions'] as $mention_cfg) {
                if (strtolower($mention_cfg['condition']) === $mention_candidat) {
                  $bonus += floatval($mention_cfg['valeur']);
                  break;
                }
              }
            }
          }
        }
      }
      $valeurs['Bonus Mention (B.M)'] = $bonus;
    }



    if ($titreAffiche === 'Bonus Session (B.S)' && !empty($cfg['conditions'])) {
        $bonus_session_total = 0;

        foreach ($niveauLabels as $niveau_num => $libelle_config) {
          $session_candidat = $valeurs["Session $niveau_num"] ?? null;

          if ($session_candidat) {
            $session_candidat = strtolower(trim($session_candidat));

            // 🛠️ Normalisation : rattrapage et contrôle → contrôle
            if (in_array($session_candidat, ['rattrapage', 'rattrapage session', 'session de rattrapage'])) {
              $session_candidat = 'contrôle';
            }

            foreach ($cfg['conditions'] as $session_cfg) {
              $condition_cfg = strtolower(trim($session_cfg['condition']));

              if ($condition_cfg === $session_candidat) {
                $bonus_session_total += floatval($session_cfg['valeur']);
                break;
              }
            }
          }
        }

        $valeurs['Bonus Session (B.S)'] = $bonus_session_total;
      }



    // 🎯 Agrégation : Malus = somme des pénalités selon les conditions si applicables
      if ($crit->titre_affiche === 'Malus' && !isset($valeurs['Malus'])) {
          $malus_total = 0;

          foreach ($cfg['conditions'] ?? [] as $c) {
              $label = $c['condition'];
              $penalite = floatval($c['valeur'] ?? 0);

              // Si la saisie est présente et > 0 → appliquer pénalité
              if (!empty($valeurs[$label]) && floatval($valeurs[$label]) > 0) {
                  $malus_total += $penalite;
              }
          }

          $valeurs['Malus'] = $malus_total;
      }

    // ✅ Conditions (bonus session, malus...)
    if (!empty($cfg['conditions'])) {
      foreach ($cfg['conditions'] as $c) {
        $label = $c['condition'];
        if (!isset($valeurs[$label])) {
          $valeurs[$label] = floatval($c['valeur']);
        }
      }
    }




    // ✅ Critère simple : injecter la valeur directe
    if ($templateType === 'critere' && isset($cfg['valeur'])) {
      $valeurs[$titreAffiche] = floatval($cfg['valeur']);
    }

    


    if (!empty($cfg['intervalle']) && in_array($crit->type, ['critere_condition', 'interruption', 'pfe'])) {
        $saisie = null;

        // 🔁 Parcours toutes les valeurs saisies du candidat
        foreach ($valeurs_raw as $row) {
            $json = json_decode($row->valeur_json, true);
            $temp_id = $row->template_id;

            // Vérifie correspondance exacte avec le critère traité
            $is_matched_template = $wpdb->get_var($wpdb->prepare(
                "SELECT id FROM {$wpdb->prefix}master_score_templates 
                WHERE id = %d AND type = %s LIMIT 1",
                $temp_id, $crit->type
            ));

            if ($is_matched_template) {
                // 🔍 Cas général : la valeur est dans la clé 'valeur'
                if (isset($json['valeur']) && is_numeric($json['valeur'])) {
                    $saisie = floatval($json['valeur']);
                    break;
                }

                // 🔍 Cas alternatif : la valeur a pour clé le titre affiché
                if (isset($json[$crit->titre_affiche]) && is_numeric($json[$crit->titre_affiche])) {
                    $saisie = floatval($json[$crit->titre_affiche]);
                    break;
                }
            }
        }

        // Si une valeur a été trouvée, appliquer les règles d’intervalle
        $matched = false;
        foreach ($cfg['intervalle'] as $intv) {
            $min = floatval($intv['min'] ?? 0);
            $max = floatval($intv['max'] ?? 999);
            $score_val = floatval($intv['valeur'] ?? 0);


           

            if ($saisie !== null && $saisie >= $min && $saisie <= $max) {
                $valeurs[$crit->titre_affiche] = $score_val;
                $matched = true;
                break;
            }
            
        }

    }





    // ✅ Matières spécifiques : condition sur note minimale
    if (!empty($cfg['matieres'])) {
        foreach ($cfg['matieres'] as $m) {
          $nom = $m['matiere'];


          $note_saisie = $valeurs[$nom] ?? null;




          if ($note_saisie !== null && isset($m['note'])) {
            $min = floatval($m['note']);

          


              if($note_saisie >= $min) {
                $valeurs[$nom] = 1;
              }else {
                $valeurs[$nom] =0;
              }
          }

        }
      }

  }



  


  // Calcule la somme des matières spécifiques si présentes
  if (!isset($valeurs['Matières spécifiques'])) {
    $somme_matieres = 0;
    foreach ($criteres as $crit) {
      if ($crit->type === 'matieres' && !empty($crit->config_json)) {
        $cfg = json_decode($crit->config_json, true);
        if (!empty($cfg['matieres'])) {
          foreach ($cfg['matieres'] as $m) {
            $nom = $m['matiere'];
            if (isset($valeurs[$nom])) {
              $somme_matieres += floatval($valeurs[$nom]);
            }
          }
        }
      }
    }
    $valeurs['Matières spécifiques'] = $somme_matieres;
  }

  // 6. Construction de l'expression
  $expr = '';
  foreach ($formule as $token) {
    if (in_array($token, ['+', '-', '*', '/', '(', ')'])) {
      $expr .= " $token ";
    } elseif (preg_match('/^\d+%$/', $token)) {
      $expr .= ' ' . (floatval($token) / 100) . ' ';
    } elseif (is_numeric($token)) {
      $expr .= " $token ";
    } else {
      $val = $valeurs[$token] ?? 0;
      $expr .= " $val ";
    }
  }


  
  // 7. Debug
  echo "🧮 formule de score  :";  


  var_dump($formule_json);

  echo "<pre>";
  echo "🧮 Expression mathématique générée :\n\n$expr\n\n";
  echo "📊 Valeurs utilisées dans le calcul :\n\n";
  var_dump($valeurs);
  echo "</pre>";
  

  // 8. Calcul du score
  try {
    eval("\$score = round($expr, 2);");
    return $score;
  } catch (Throwable $e) {
    return null;
  }
}

*/


function calculate_candidate_score($candidature_id, $score_id) {
  global $wpdb;




  // 1. Récupération de la formule
  $formule_json = $wpdb->get_var($wpdb->prepare(
    "SELECT formule_json FROM {$wpdb->prefix}master_score WHERE id = %d LIMIT 1",
    $score_id
  ));



  if (!$formule_json) return null;
  $formule = json_decode($formule_json, true);
  if (!is_array($formule)) return null;

  // 2. Candidat lié
  $candidat_id = $wpdb->get_var($wpdb->prepare(
    "SELECT candidat_id FROM {$wpdb->prefix}master_candidatures WHERE id = %d LIMIT 1",
    $candidature_id
  ));
  if (!$candidat_id) return null;

  $valeurs = [];

  // 3. Valeurs saisies (utm_candidats_score_values)
  $valeurs_raw = $wpdb->get_results($wpdb->prepare(
    "SELECT valeur_json , template_id
    FROM {$wpdb->prefix}candidats_score_values
     WHERE candidature_id = %d AND score_id = %d",
    $candidature_id, $score_id
  ));

  foreach ($valeurs_raw as $row) {
    $v = json_decode($row->valeur_json, true);
    if (!is_array($v)) continue;
    foreach ($v as $k => $val) {
      if (is_numeric($val)) {
        $valeurs[$k] = floatval($val);
      } elseif (is_array($val)) {
        foreach ($val as $k2 => $val2) {
          if (is_numeric($val2)) {
            $valeurs[$k2] = floatval($val2);
          }
        }
      }
    }
  }

  // 4. Parcours académique
  $parcours = $wpdb->get_results($wpdb->prepare(
    "SELECT annee_academique, moyenne, credit, mention , niveau , session
     FROM {$wpdb->prefix}candidats_parcours_annees
     WHERE candidat_id = %d", $candidat_id
  ));

  $niveauLabels2 = [ '1' => '"Première année', '2' => 'Deuxième année', '3' => 'Troisième année"' ];
  $niveauLabels = [ '1' => 'Première année', '2' => 'Deuxième année', '3' => 'Troisième année' ];


  foreach ($parcours as $p) {
      $niveau = trim((string) $p->niveau);

      // correspondance propre
      if ($niveau === "1") {
          $label = "1ère année";
      } elseif ($niveau === "2") {
          $label = "2ème année";
      } elseif ($niveau === "3") {
          $label = "3ème année";
      } else {
          $label = "{$niveau}ème année";
      }

      if ($p->moyenne)  $valeurs["Moyenne $label"] = floatval($p->moyenne);
      if ($p->credit)   $valeurs["CR{$niveau}"] = floatval($p->credit);
      if ($p->mention)  $valeurs["Mention $niveau"] = $p->mention;
      if ($p->session)  $valeurs["Session $niveau"] = $p->session;
  }


  // 5. Traitement des critères
  $criteres = $wpdb->get_results($wpdb->prepare(
    "SELECT c.config_json, c.template_id, t.nom_template, t.titre_affiche, t.type
     FROM {$wpdb->prefix}master_score_criteres c
     INNER JOIN {$wpdb->prefix}master_score_templates t ON c.template_id = t.id
     WHERE c.score_id = %d", $score_id
  ));


  foreach ($criteres as $crit) {
    $cfg = json_decode($crit->config_json, true);
    if (!is_array($cfg)) continue;

    $templateType  = $crit->type;
    $titreAffiche  = trim($crit->titre_affiche);

    // ✅ Bonus mention par année
    if (!empty($cfg['bonus_mention'])) {
      $bonus = 0;
      foreach ($cfg['bonus_mention'] as $bm) {
        $label_cfg = strtolower(trim($bm['annee']));
        foreach ($niveauLabels as $niveau_num => $libelle_config) {
          if (strtolower($libelle_config) === $label_cfg) {
            $mention_candidat = $valeurs["Mention $niveau_num"] ?? null;
            if ($mention_candidat) {
              $mention_candidat = strtolower(trim($mention_candidat));
              foreach ($bm['mentions'] as $mention_cfg) {
                if (strtolower($mention_cfg['condition']) === $mention_candidat) {
                  $bonus += floatval($mention_cfg['valeur']);
                  break;
                }
              }
            }
          }
        }
      }
      $valeurs['Bonus Mention (B.M)'] = $bonus;
    }



   if ($titreAffiche === 'Bonus Session (B.S)' && !empty($cfg['conditions'])) {
        $bonus_session_total = 0;
        $count_principale = 0;

        foreach ($niveauLabels as $niveau_num => $libelle_config) {
            $session_candidat = $valeurs["Session $niveau_num"] ?? null;

            if ($session_candidat) {
                $session_candidat = strtolower(trim($session_candidat));

                // 🛠️ Normalisation
                if (in_array($session_candidat, ['rattrapage', 'rattrapage session', 'session de rattrapage', 'contrôle'])) {
                    $session_candidat = 'contrôle';
                }

                if ($session_candidat === 'principale') {
                    $count_principale++;
                }
            }
        }

        // Rechercher la valeur correspondante au nombre de sessions principales
        foreach ($cfg['conditions'] as $cond) {
            $cond_type = strtolower(trim($cond['condition']));
            $nombre = intval($cond['nombre'] ?? -1);
            $valeur = floatval($cond['valeur'] ?? 0);

            if ($cond_type === 'session principale' && $count_principale === $nombre) {
                $bonus_session_total = $valeur;
                break;
            }
        }

        // Injection dans la formule
        $valeurs['Bonus Session (B.S)'] = $bonus_session_total;

        // Optionnel : injecter aussi sous un nom plus simple si utilisé dans tokens
        if (!isset($valeurs['Session principale'])) {
            $valeurs['Session principale'] = $bonus_session_total;
        }
    }




    // Agrégation : Malus = somme des pénalités selon les conditions si applicables

    if ($crit->titre_affiche === 'Malus' && !isset($valeurs['Malus'])) {
    $malus_total = 0;

    foreach ($cfg['conditions'] ?? [] as $c) {
        $condition = $c['condition'];  // ex: "Redoublement"
        $penalite  = floatval($c['valeur'] ?? 0);
        $nb_attendu = intval($c['nombre'] ?? -1);

        foreach ($valeurs_raw as $row) {
            $json = json_decode($row->valeur_json, true);
            if (!is_array($json)) continue;

            if (
                isset($json[$condition]) &&
                is_array($json[$condition]) &&
                isset($json[$condition]['label'])
            ) {
                $label = $json[$condition]['label']; // ex: "2 fois"

                if (preg_match('/(\d+)/', $label, $matches)) {
                    $nb_fait = intval($matches[1]);

                    if ($nb_fait === $nb_attendu) {
                        $malus_total += $penalite;
                        break 2; // Sortir des 2 boucles dès que trouvé
                    }
                }
            }
        }
    }

    $valeurs['Malus'] = $malus_total;
  }



    // ✅ Matières spécifiques : condition sur note minimale
    if (!empty($cfg['matieres'])) {
        foreach ($cfg['matieres'] as $m) {
          $nom = $m['matiere'];


          $note_saisie = $valeurs[$nom] ?? null;


         // update

        if (isset($valeurs_raw)) {
            foreach ($valeurs_raw as $row) {
                if ($row->template_id == $crit->template_id) {
                    $json = json_decode($row->valeur_json, true);
                    if (isset($json['matieres']) && is_array($json['matieres'])) {
                        foreach ($cfg['matieres'] as $m) {
                            $nom = $m['matiere'];
                            $note_attendue = floatval($m['note'] ?? 0);
                            $etudie = 0;
                            $note_obtenue = null;

                            foreach ($json['matieres'] as $saisie) {
                                if (trim($saisie['matiere']) === trim($nom)) {
                                    $etudie = 1;
                                    $note_obtenue = floatval($saisie['note'] ?? 0);
                                    break;
                                }
                            }

                            if ($etudie === 0) {
                                $valeurs[$nom] = 0; // Non étudiée = 0
                            } elseif ($note_obtenue >= $note_attendue) {
                                $valeurs[$nom] = 1;
                            } else {
                                $valeurs[$nom] = 0;
                            }
                        }
                    }
                }
            }
        }


        }
      }

  }




  // Calcule la somme des matières spécifiques si présentes
  if (!isset($valeurs['Matières spécifiques'])) {
    $somme_matieres = 0;
    foreach ($criteres as $crit) {
      if ($crit->type === 'matieres' && !empty($crit->config_json)) {
        $cfg = json_decode($crit->config_json, true);
        if (!empty($cfg['matieres'])) {
          foreach ($cfg['matieres'] as $m) {
            $nom = $m['matiere'];
            if (isset($valeurs[$nom])) {
              $somme_matieres += floatval($valeurs[$nom]);
            }
          }
        }
      }
    }
    $valeurs['Matières spécifiques'] = $somme_matieres;
  }

  

  foreach ($criteres as $crit) {
      $cfg = json_decode($crit->config_json, true);
      if (!is_array($cfg)) continue;

      $templateType  = $crit->type;
      $titreAffiche  = trim($crit->titre_affiche);

      if ($templateType === 'ponderation' && !empty($cfg['formule_json'])) {
          $formule_pond = $cfg['formule_json'];
          $valeur_calculee = '';

          foreach ($formule_pond as $tok) {
              if (in_array($tok, ['+', '-', '*', '/', '(', ')'])) {
                  $valeur_calculee .= " $tok ";
              } elseif (is_numeric($tok)) {
                  $valeur_calculee .= " $tok ";
              } else {
                  // Remplacer token par valeur ou 1 par défaut
                  $v = $valeurs[$tok] ?? 1;
                  $valeur_calculee .= " $v ";
              }
          }

          // 💡 Résultat de la pondération locale
          try {
              eval("\$res = round($valeur_calculee, 2);");
              $valeurs[$titreAffiche] = $res;
          } catch (Throwable $e) {
              $res = 0;
              $valeurs[$titreAffiche] = 0;
          }

          // ✅ Appliquer les coefficients dynamiques après que $res est défini
          if (!empty($cfg['coefficients'])) {
              foreach ($cfg['coefficients'] as $coeff) {
                  $nomCoeff = $coeff['nom'];
                  $valCoeff = 1;

                  foreach ($coeff['conditions'] as $cond) {
                      $min = floatval($cond['min']);
                      $max = floatval($cond['max']);
                      $valeur_cond = floatval($cond['valeur']);

                      if ($res >= $min && $res <= $max) {
                          $valCoeff = $valeur_cond;
                          break;
                      }
                  }

                  $valeurs[$nomCoeff] = $valCoeff;
              }
          }

          // 🔍 Debug optionnel
        /*  echo "<pre>";
          echo "🧮 Formule pondération : $titreAffiche\n";
          echo "Expression : $valeur_calculee\n";
          echo "Résultat (res) : $res\n";
          echo "Valeurs actuelles : \n";
          print_r($valeurs);
          echo "</pre>";*/
      }

  }



  // 6. Construction de l'expression
  $expr = '';
  foreach ($formule as $token) {
    if (in_array($token, ['+', '-', '*', '/', '(', ')'])) {
      $expr .= " $token ";
    } elseif (preg_match('/^\d+%$/', $token)) {
      $expr .= ' ' . (floatval($token) / 100) . ' ';
    } elseif (is_numeric($token)) {
      $expr .= " $token ";
    } else {

      /*
      $val = $valeurs[$token] ?? 0;
      $expr .= " $val ";
      */

      // update 

        $val = array_key_exists($token, $valeurs) ? $valeurs[$token] : 1;
        $expr .= " $val ";

      // update


    }
  }


/*
  // 7. Debug
  echo "🧮 formule de score  :";  


  var_dump($formule_json);

  echo "<pre>";
  echo "🧮 Expression mathématique générée :\n\n$expr\n\n";
  echo "📊 Valeurs utilisées dans le calcul :\n\n";
  var_dump($valeurs);
  echo "</pre>";
*/

  // 8. Calcul du score
  try {
    eval("\$score = round($expr, 2);");
    return $score;
  } catch (Throwable $e) {
    return null;
  }
}


/*

function move_uploaded_file_to_candidats($file_tmp_path) {
  if (!$file_tmp_path || !file_exists($file_tmp_path)) return '';

  $upload_dir = wp_upload_dir();
  $target_dir = trailingslashit($upload_dir['basedir']) . 'candidats/';
  wp_mkdir_p($target_dir);

  // Génère un nom de fichier unique
  $extension = pathinfo($file_tmp_path, PATHINFO_EXTENSION);
  $basename = pathinfo($file_tmp_path, PATHINFO_FILENAME);
  $unique_name = $basename . '_' . uniqid() . '.' . $extension;

  $target_path = $target_dir . $unique_name;

  if (!file_exists($target_path)) {
    copy($file_tmp_path, $target_path);
  }

  return 'uploads/candidats/' . $unique_name;
}
*/

/*

function move_uploaded_file_to_candidats($file_name) {
  if (!$file_name) return '';

  $upload_dir = wp_upload_dir();
  $target_dir = trailingslashit($upload_dir['basedir']) . 'candidats/';
  wp_mkdir_p($target_dir);

  // Génère un nom de fichier unique basé sur l'original
  $extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $basename = pathinfo($file_name, PATHINFO_FILENAME);
  $unique_name = $basename . '_' . uniqid() . '.' . $extension;

  // Si le fichier existe déjà dans /uploads/candidats/ sans déplacement, on suppose qu'il est déjà là
  return 'uploads/candidats/' . $unique_name;
}

function gm_api_save_situation_academique(WP_REST_Request $request) {
  global $wpdb;

  var_dump($_Files);

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();
  $personal = $data['personal'] ?? [];
  $situation = $data['situation'] ?? [];
  $parcours = $data['parcours_academiques'] ?? [];
  $blanches = $data['annees_blanches'] ?? [];
  $criteres = $data['criteres_score'] ?? [];

  $upload_base = wp_upload_dir()['basedir'] . '/candidats/';
  wp_mkdir_p($upload_base);

  // 1. Enregistrer la situation académique principale
  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
    'parcours'          => sanitize_text_field($situation['parcours'] ?? ''),
    'cycle'             => sanitize_text_field($situation['cycle'] ?? ''),
    'annee_academique'  => sanitize_text_field($situation['annee'] ?? ''),
    'baccalaureat'      => sanitize_text_field($situation['baccalaureat'] ?? ''),
    'etablissement'     => sanitize_text_field($situation['etablissement'] ?? ''),
    'session'           => sanitize_text_field($situation['session'] ?? ''),
    'mention'           => sanitize_text_field($situation['mention'] ?? ''),
    'moyenne'           => sanitize_text_field($situation['moyenne'] ?? ''),
    'piece_jointe_path' => move_uploaded_file_to_candidats($situation['fichier_principal'] ?? ''),
    'ajouter_annee_blanche' => !empty($blanches),
    'nb_annees_blanche' => intval($situation['nbannee'] ?? 0),
    'piece_jointe_blanche_path' => move_uploaded_file_to_candidats($situation['fichier_blanche'] ?? ''),
    'cause_blanche'     => sanitize_text_field($situation['cause'] ?? ''),
    'created_at'        => date('Y-m-d H:i:s')
  ]);

  // 2. Table candidatures
  $master_id = intval($situation['master_id'] ?? 0);
  $niveau = sanitize_text_field($situation['niveau'] ?? 'M1');

  $existing = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1", $candidat_id, $master_id));

  if ($existing) {
    $wpdb->update("{$wpdb->prefix}candidatures", [
      'niveau' => $niveau,
      'etat' => 'soumis',
      'date_soumission' => date('Y-m-d H:i:s')
    ], ['id' => $existing]);
    $candidature_id = $existing;
  } else {
    $wpdb->insert("{$wpdb->prefix}candidatures", [
      'candidat_id' => $candidat_id,
      'master_id' => $master_id,
      'niveau' => $niveau,
      'etat' => 'soumis',
      'date_soumission' => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  }

  // 3. Parcours académiques
  foreach ($parcours as $row) {

     var_dump($row['fichier']);
    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id' => $candidat_id,
      'annee_academique' => sanitize_text_field($row['annee'] ?? ''),
      'universite' => sanitize_text_field($row['universite'] ?? ''),
      'etablissement' => sanitize_text_field($row['etablissement'] ?? ''),
      'session' => sanitize_text_field($row['session'] ?? ''),
      'mention' => sanitize_text_field($row['mention'] ?? ''),
      'moyenne' => sanitize_text_field($row['moyenne'] ?? ''),
      'credit' => sanitize_text_field($row['credit'] ?? ''),
      'piece_jointe_path' => move_uploaded_file_to_candidats($row['fichier'] ?? ''),
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

 

  // 4. Années blanches
  foreach ($blanches as $row) {
    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id' => $candidat_id,
      'nbannee' => intval($row['nbannee'] ?? 0),
      'cause' => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref' => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => move_uploaded_file_to_candidats($row['fichier'] ?? ''),
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  // 5. Critères de score
  foreach ($criteres as $critere) {
    $wpdb->insert("{$wpdb->prefix}candidatures_score_criteres", [
      'candidature_id' => $candidature_id,
      'critere_id' => intval($critere['critere_id']),
      'valeur' => sanitize_text_field($critere['valeur']),
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  // 6. Mise à jour table candidats
  $wpdb->update("{$wpdb->prefix}candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin' => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle' => sanitize_text_field($situation['cycle'] ?? '')
  ], ['id' => $candidat_id]);

  // 7. Mise à jour état master_candidats_adresses
  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], ['candidat_id' => $candidat_id]);

  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}

*/




function move_uploaded_file_to_candidats($file_key) {
  if (
    !isset($_FILES[$file_key]) ||
    $_FILES[$file_key]['error'] !== UPLOAD_ERR_OK ||
    !is_uploaded_file($_FILES[$file_key]['tmp_name'])
  ) {
    return '';
  }

  $upload_dir = wp_upload_dir();
  $target_dir = trailingslashit($upload_dir['basedir']) . 'candidats/';
  $public_url = trailingslashit($upload_dir['baseurl']) . 'candidats/';
  wp_mkdir_p($target_dir);

  $original_name = $_FILES[$file_key]['name'];
  $extension = pathinfo($original_name, PATHINFO_EXTENSION);
  $basename = pathinfo($original_name, PATHINFO_FILENAME);
  $unique_name = $basename . '_' . uniqid() . '.' . $extension;

  $target_path = $target_dir . $unique_name;

  if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $target_path)) {
    return $public_url . $unique_name;
  }

  return '';
}

function extract_field($json, $key) {
      $pattern = sprintf('/"%s"\s*:\s*"([^"]*?)"/u', preg_quote($key, '/'));
      if (preg_match($pattern, $json, $matches)) {
        return trim($matches[1]);
      }
      return '';
    }
/*
function gm_api_save_situation_academique(WP_REST_Request $request) {
      global $wpdb;

      
      $payload = json_decode($_POST['payload'] ?? '', true);
      $personal = $payload['personal'] ?? [];
      $situation = $payload['situation'] ?? [];
      $parcours = $payload['parcours_academiques'] ?? [];
      $blanches = $payload['annees_blanches'] ?? [];
      $criteres = $payload['criteres_score'] ?? [];

    $raw = stripslashes($_POST['payload'] ?? ''); // supprime les \"
    $payload = json_decode($raw, true);

    if (substr($raw, 0, 3) === "\xEF\xBB\xBF") {
      $raw = substr($raw, 3);
    }
    $raw = preg_replace('/[[:^print:]]/', '', $raw);
    $raw = stripslashes($raw);
    $payload = json_decode($raw, true);

    if (!is_array($payload)) {
      return new WP_Error('decode_error', 'json_decode a échoué : ' . json_last_error_msg(), ['status' => 400]);
    }


    $raw = $_POST['payload'] ?? '';

    // Supprimer BOM
    if (substr($raw, 0, 3) === "\xEF\xBB\xBF") {
      $raw = substr($raw, 3);
    }

    // Nettoyer caractères invisibles
    $cleaned = preg_replace('/[[:^print:]]/', '', $raw);

    // Forcer l'encodage
    $cleaned = mb_convert_encoding($cleaned, 'UTF-8', 'UTF-8');

    // Essayer de décoder
    $payload = json_decode($cleaned, true);

    if (!is_array($payload)) {
      return new WP_Error('decode_error', 'Échec json_decode : ' . json_last_error_msg(), ['status' => 400]);
    }


  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }



  $situation_raw = $_POST['situation'] ?? '';
  $situation = json_decode($situation_raw, true);

  $cycle = $situation['cycle'] ?? '';
  $annee = $situation['annee'] ?? '';
  $baccalaureat = $situation['baccalaureat'] ?? '';
  $etablissement = $situation['etablissement'] ?? '';
  $session = $situation['session'] ?? '';
  $mention = $situation['mention'] ?? '';
  $moyenne = $situation['moyenne'] ?? '';
  $nbannee = $situation['nbannee'] ?? 0;
  $cause = $situation['cause'] ?? '';
  $master_id = $situation['master_id'] ?? 0;
  $niveau = $situation['niveau'] ?? 'M1';



  $personal = json_decode($_POST['personal'] ?? '{}', true);
  $parcours = json_decode($_POST['parcours_academiques'] ?? '[]', true);
  $blanches = json_decode($_POST['annees_blanches'] ?? '[]', true);
  $criteres = json_decode($_POST['criteres_score'] ?? '[]', true);


  $fichier_principal_path = move_uploaded_file_to_candidats('fichier_principal');
  $fichier_blanche_path = move_uploaded_file_to_candidats('fichier_blanche');

  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id' => $candidat_id,
    'cycle' => sanitize_text_field($cycle),
    'annee_academique' => sanitize_text_field($annee),
    'baccalaureat' => sanitize_text_field($baccalaureat),
    'etablissement' => sanitize_text_field($etablissement),
    'session' => sanitize_text_field($session),
    'mention' => sanitize_text_field($mention),
    'moyenne' => sanitize_text_field($moyenne),
    'piece_jointe_path' => $fichier_principal_path,
    'ajouter_annee_blanche' => !empty($blanches),
    'nb_annees_blanche' => intval($nbannee),
    'piece_jointe_blanche_path' => $fichier_blanche_path,
    'cause_blanche' => sanitize_text_field($cause),
    'created_at' => date('Y-m-d H:i:s')
  ]);

  $existing = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}candidatures WHERE candidat_id = %d AND master_id = %d LIMIT 1", $candidat_id, $master_id));

  if ($existing) {
    $wpdb->update("{$wpdb->prefix}candidatures", [
      'niveau' => $niveau,
      'etat' => 'soumis',
      'date_soumission' => date('Y-m-d H:i:s')
    ], ['id' => $existing]);
    $candidature_id = $existing;
  } else {
    $wpdb->insert("{$wpdb->prefix}candidatures", [
      'candidat_id' => $candidat_id,
      'master_id' => $master_id,
      'niveau' => $niveau,
      'etat' => 'soumis',
      'date_soumission' => date('Y-m-d H:i:s')
    ]);
    $candidature_id = $wpdb->insert_id;
  }

  foreach ($parcours as $index => $row) {
    $file_key = "parcours_fichier_{$index}";
    $file_path = move_uploaded_file_to_candidats($file_key);

    $wpdb->insert("{$wpdb->prefix}candidats_parcours_annees", [
      'candidat_id' => $candidat_id,
      'annee_academique' => sanitize_text_field($row['annee'] ?? ''),
      'universite' => sanitize_text_field($row['universite'] ?? ''),
      'etablissement' => sanitize_text_field($row['etablissement'] ?? ''),
      'session' => sanitize_text_field($row['session'] ?? ''),
      'mention' => sanitize_text_field($row['mention'] ?? ''),
      'moyenne' => sanitize_text_field($row['moyenne'] ?? ''),
      'credit' => sanitize_text_field($row['credit'] ?? ''),
      'piece_jointe_path' => $file_path,
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  foreach ($blanches as $index => $row) {
    $file_key = "blanche_fichier_{$index}";
    $file_path = move_uploaded_file_to_candidats($file_key);

    $wpdb->insert("{$wpdb->prefix}candidats_annees_blanches", [
      'candidat_id' => $candidat_id,
      'nbannee' => intval($row['nbannee'] ?? 0),
      'cause' => sanitize_text_field($row['cause'] ?? ''),
      'annee_ref' => sanitize_text_field($row['annee_ref'] ?? ''),
      'piece_jointe_path' => $file_path,
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  foreach ($criteres as $critere) {
    $wpdb->insert("{$wpdb->prefix}candidatures_score_criteres", [
      'candidature_id' => $candidature_id,
      'critere_id' => intval($critere['critere_id']),
      'valeur' => sanitize_text_field($critere['valeur']),
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  $wpdb->update("{$wpdb->prefix}candidats", [
    'etat_specifique' => !empty($personal['besoins_specifiques']) ? 1 : 0,
    'type_besoin' => sanitize_text_field($personal['type_besoin'] ?? ''),
    'cycle' => sanitize_text_field($cycle)
  ], ['id' => $candidat_id]);

  $wpdb->update("{$wpdb->prefix}master_candidats_adresses", [
    'etat' => 'validé'
  ], ['candidat_id' => $candidat_id]);

  return [
    'success' => true,
    'message' => '📌 Situation académique et score enregistrés avec succès.',
    'candidature_id' => $candidature_id
  ];
}
*/


/*
function gm_api_save_situation_academique(WP_REST_Request $request) {
  global $wpdb;

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_Error('no_candidat', 'Candidat introuvable', ['status' => 404]);
  }

  $data = $request->get_json_params();

  $wpdb->insert("{$wpdb->prefix}candidats_situation_academique", [
    'candidat_id'       => $candidat_id,
    'parcours'          => sanitize_text_field($data['parcours']),
    'annee_academique'  => sanitize_text_field($data['annee']),
    'baccalaureat'      => sanitize_text_field($data['specialite']),
    'etablissement'     => sanitize_text_field($data['etablissement']),
    'session'           => sanitize_text_field($data['session']),
    'mention'           => sanitize_text_field($data['mention']),
    'moyenne'           => sanitize_text_field($data['moyenne']),
    'nb_annees_blanche' => intval($data['nbannee']),
    'cause_blanche'     => sanitize_textarea_field($data['cause']),
    'created_at'        => date('Y-m-d H:i:s'),
  ]);

  return ['success' => true, 'message' => 'Situation académique enregistrée'];
}

*/

/*
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/masters-par-institut/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'gm_api_get_masters_by_institut',
    'permission_callback' => '__return_true',
  ]);
});

function gm_api_get_masters_by_institut($request) {
  global $wpdb;
  $institut_id = intval($request['id']);

  $results = $wpdb->get_results($wpdb->prepare("
    SELECT 
      m.id AS master_id,
      m.intitule_master,
      m.langue,
      m.code_interne,
      m.parcours,
      CASE 
        WHEN s.id IS NOT NULL THEN 1
        ELSE 0
      END AS est_publie
    FROM {$wpdb->prefix}master_fichemaster m
    LEFT JOIN {$wpdb->prefix}master_sessions s 
      ON s.master_id = m.id AND s.etat = 'publié web'
    WHERE m.institut_id = %d
    GROUP BY m.id
  ", $institut_id), ARRAY_A);

  return rest_ensure_response($results);
}
*/
/*
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/score-par-master/(?P<master_id>\d+)/(?P<niveau>[a-zA-Z0-9_-]+)', [
    'methods' => 'GET',
    'callback' => 'get_score_par_master_et_niveau',
    'permission_callback' => '__return_true',
  ]);
});
*/

/*
function get_score_par_master_et_niveau($request) {
  global $wpdb;
  $master_id = intval($request['master_id']);
  $niveau = sanitize_text_field($request['niveau']);

  $score = $wpdb->get_row($wpdb->prepare("
    SELECT *
    FROM {$wpdb->prefix}master_score
    WHERE master_id = %d AND niveau = %s
    LIMIT 1
  ", $master_id, $niveau), ARRAY_A);

  $criteres = $wpdb->get_results($wpdb->prepare("
    SELECT id, champ
    FROM {$wpdb->prefix}master_score_criteres
    WHERE master_id = %d
    Group BY champ
    ORDER BY date_creation ASC
  ", $master_id), ARRAY_A);

  return rest_ensure_response([
    'score' => $score,
    'criteres' => $criteres
  ]);
}
*/

/*
function get_score_par_master_et_niveau($request) {
  global $wpdb;
  $master_id = intval($request['master_id']);
  $niveau = sanitize_text_field($request['niveau']);

  // 1. Charger le score
  $score = $wpdb->get_row($wpdb->prepare("
    SELECT *
    FROM {$wpdb->prefix}master_score
    WHERE master_id = %d AND niveau = %s
    LIMIT 1
  ", $master_id, $niveau), ARRAY_A);

  $score_id = $score['id'] ?? 0;

  // 2. Critères principaux
  $criteres = $wpdb->get_results($wpdb->prepare("
    SELECT id, champ
    FROM {$wpdb->prefix}master_score_criteres
    WHERE master_id = %d
    GROUP BY champ
    ORDER BY date_creation ASC
  ", $master_id), ARRAY_A);

  // 3. Malus liés au score
  $malus = $wpdb->get_results($wpdb->prepare("
    SELECT condition_texte
    FROM {$wpdb->prefix}master_score_malus
    WHERE score_id = %d
  ", $score_id), ARRAY_A);

  // 4. Interruptions liées au score
  $interruptions = $wpdb->get_results($wpdb->prepare("
    SELECT condition_texte
    FROM {$wpdb->prefix}master_score_interruption
    WHERE score_id = %d
  ", $score_id), ARRAY_A);

  // 5. Matières liées au score
  $matieres = $wpdb->get_results($wpdb->prepare("
    SELECT id, matiere, annee
    FROM {$wpdb->prefix}master_score_matieres
    WHERE score_id = %d
  ", $score_id), ARRAY_A);

  return rest_ensure_response([
    'score' => $score,
    'criteres' => $criteres,
    'malus' => $malus,
    'interruptions' => $interruptions,
    'matieres' => $matieres
  ]);
}
  **/


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/score-par-master/(?P<master_id>\d+)/(?P<niveau>[a-zA-Z0-9_-]+)', [
    'methods'  => 'GET',
    'callback' => 'get_score_par_master_et_niveau',
    'permission_callback' => '__return_true'
  ]);
});

/*
function get_score_par_master_et_niveau($data) {
  global $wpdb;

  $master_id = intval($data['master_id']);
  $niveau = sanitize_text_field($data['niveau']);

  // Vérifier l’existence du score
  $score = $wpdb->get_row($wpdb->prepare("
    SELECT id, formule FROM utm_master_score
    WHERE master_id = %d AND niveau = %s
  ", $master_id, $niveau));

  if (!$score) {
    return new WP_Error('not_found', 'Score introuvable.', ['status' => 404]);
  }

  // Récupérer les critères liés
  $criteres = $wpdb->get_results($wpdb->prepare("
    SELECT 
      c.id AS critere_id,
      c.template_id,
      t.nom_template,
      t.titre_affiche,
      t.type,
      t.config_json,
      c.ordre
    FROM utm_master_score_criteres c
    INNER JOIN utm_master_score_templates t ON t.id = c.template_id
    WHERE c.score_id = %d
    ORDER BY c.ordre ASC
  ", $score->id));

  return rest_ensure_response([
    'score_id' => $score->id,
    'formule' => $score->formule,
    'criteres' => $criteres
  ]);
}
***/

function get_score_par_master_et_niveau($data) {
  global $wpdb;

  $master_id = intval($data['master_id']);
  $niveau = sanitize_text_field($data['niveau']);

  // Vérifier l’existence du score
  $score = $wpdb->get_row($wpdb->prepare("
    SELECT id, formule FROM utm_master_score
    WHERE master_id = %d AND niveau = %s
  ", $master_id, $niveau));

  if (!$score) {
    return new WP_Error('not_found', 'Score introuvable.', ['status' => 404]);
  }

  // Récupérer les critères avec leur config_json spécifique
  $criteres = $wpdb->get_results($wpdb->prepare("
    SELECT 
      c.id AS critere_id,
      c.template_id,
      t.nom_template,
      t.titre_affiche,
      t.type,
      c.config_json,    -- Prend depuis utm_master_score_criteres
      c.ordre
    FROM utm_master_score_criteres c
    INNER JOIN utm_master_score_templates t ON t.id = c.template_id
    WHERE c.score_id = %d and t.display = 1 and t.type NOT LIKE 'ponderation'
    ORDER BY c.ordre ASC
  ", $score->id));

  return rest_ensure_response([
    'score_id' => $score->id,
    'formule' => $score->formule,
    'criteres' => $criteres
  ]);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/entretiens-par-candidat/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'api_get_entretiens_par_candidat',
    'permission_callback' => '__return_true'
  ]);
});

function api_get_entretiens_par_candidat(WP_REST_Request $request) {
  global $wpdb;
  //$candidat_id = intval($request['id']);

  $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_REST_Response(['success' => false, 'message' => 'ID candidat invalide.'], 400);
  }

  $query = "
    SELECT
      e.id,
      e.date_entretien,
      e.heure_entretien,
      e.contenu,
      e.etat,
      m.intitule_master,
      et.nom
    FROM {$wpdb->prefix}candidature_entretiens e
    JOIN {$wpdb->prefix}master_candidatures c ON c.id = e.candidature_id
    JOIN {$wpdb->prefix}master_fichemaster m ON m.id = c.master_id
    JOIN {$wpdb->prefix}master_instituts et ON et.id = m.institut_id
    WHERE c.candidat_id = %d
    ORDER BY e.date_entretien DESC, e.heure_entretien DESC
  ";


  $entretiens = $wpdb->get_results($wpdb->prepare($query, $candidat_id), ARRAY_A);

  return new WP_REST_Response($entretiens, 200);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/resultats-candidatures/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'api_get_resultats_candidatures',
    'permission_callback' => '__return_true'
  ]);
});

function api_get_resultats_candidatures($request) {
  global $wpdb;
   $user_id = get_current_user_id();
  $candidat_id = get_user_meta($user_id, 'candidat_id', true);

  if (!$candidat_id) {
    return new WP_REST_Response(['success' => false, 'message' => 'ID candidat invalide.'], 400);
  }

  $query = "
    SELECT
      c.score,
      c.statut_decision_finale AS code_resultat,
      c.libelle_resultat AS libelle,
        m.intitule_master,
      et.nom
    FROM {$wpdb->prefix}master_candidatures c
    JOIN {$wpdb->prefix}master_fichemaster m ON m.id = c.master_id
    JOIN {$wpdb->prefix}master_instituts et ON et.id = m.institut_id
    WHERE c.candidat_id = %d and c.statut_decision_finale is not null
    ORDER BY intitule_master
  ";



  $resultats = $wpdb->get_results($wpdb->prepare($query, $candidat_id), ARRAY_A);

  return new WP_REST_Response($resultats, 200);
}

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/nationalites', [
        'methods'  => 'GET',
        'callback' => 'gm_api_get_nationalites',
        'permission_callback' => '__return_true', // à restreindre si nécessaire
    ]);
});


function gm_api_get_nationalites() {
    global $wpdb;
    
    $results = $wpdb->get_results("
        SELECT id, intitule, intitule_ar 
        FROM utm_master_nationalites 
        ORDER BY intitule
    ", ARRAY_A);

    return rest_ensure_response($results);
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme/v1', '/gouvernorats', [
        'methods' => 'GET',
        'callback' => 'get_gouvernorats',
        'permission_callback' => '__return_true',
    ]);
});

function get_gouvernorats(WP_REST_Request $request) {
    global $wpdb;

    $table = $wpdb->prefix . 'gouvernorats'; // table utm_gouvernorats
    $results = $wpdb->get_results("SELECT id, nom_fr, nom_ar FROM $table ORDER BY nom_fr ASC", ARRAY_A);

    if (empty($results)) {
        return new WP_REST_Response(['message' => 'Aucun gouvernorat trouvé'], 404);
    }

    return new WP_REST_Response($results, 200);
}

add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/masters-by-institutFDST/(?P<institut_id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_masters_by_institutFDST',
    'permission_callback' => '__return_true',
  ));
});

function get_masters_by_institutFDST($request) {
    global $wpdb;

    $institut_id = (int) $request['institut_id'];
    $diplome_id = isset($_GET['diplome_id']) ? (int) $_GET['diplome_id'] : 0;
    $annee = isset($_GET['annee']) ? sanitize_text_field($_GET['annee']) : '';

    $table_master = $wpdb->prefix . 'master_fichemaster';
    $table_diplome_master = $wpdb->prefix . 'diplome_master'; // adapte selon ton préfixe et nom exact

    $date_now = current_time('mysql');

    $sql = "
        SELECT DISTINCT m.id, m.intitule_master
        FROM $table_master AS m
        INNER JOIN $table_diplome_master AS dm ON dm.master_id = m.id
        INNER JOIN {$wpdb->prefix}master_sessions AS s1 ON s1.master_id = m.id
        INNER JOIN {$wpdb->prefix}master_appels_masters AS am ON am.master_id = m.id
        INNER JOIN {$wpdb->prefix}master_appels_sessions AS s ON s.appel_id = am.appel_id
        WHERE m.institut_id = %d
          AND s.date_debut <= %s
          AND s.date_fin >= %s
          AND s1.etat = 'publié web'
    ";

    $params = [$institut_id, $date_now, $date_now];

    if ($diplome_id) {
        $sql .= " AND dm.utm_diplome_id = %d ";
        $params[] = $diplome_id;
    }

    if ($annee === '' || $annee === "null") {
    // Si annee vide ou null => condition IS NULL
    $sql .= " AND dm.annee IS NULL ";
    } else {
        // Sinon condition = valeur
        $sql .= " AND dm.annee = %s ";
        $params[] = $annee;
    }


    $sql .= " ORDER BY m.intitule_master ASC";

    // Préparer la requête SQL
    $prepared_sql = $wpdb->prepare($sql, ...$params);

   

    // Exécuter la requête
    $results = $wpdb->get_results($prepared_sql, ARRAY_A);

  

    return rest_ensure_response($results);
}





add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/diplomes-by-institutFDST/(?P<institut_id>\d+)', [
    'methods' => 'GET',
    'callback' => 'gm_api_get_diplomes_by_institut_FDST',
    'permission_callback' => '__return_true',
  ]);
});


function gm_api_get_diplomes_by_institut_FDST($request) {
    global $wpdb;
    $institut_id = (int) $request['institut_id'];

    // Table des diplômes normalisée (utm_diplomes)
    $table_diplomes = "{$wpdb->prefix}diplomes";

    // Requête pour récupérer les diplômes correspondant à l'institut demandé
    $sql = $wpdb->prepare("
        SELECT id, diplome, annee, id_institut
        FROM $table_diplomes
        WHERE id_institut = %d
        ORDER BY diplome ASC

        ", $institut_id);

    $results = $wpdb->get_results($sql, ARRAY_A);

    return rest_ensure_response($results);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/score-par-cycle-et-institut/(?P<institut_id>\d+)/(?P<niveau>[a-zA-Z0-9_-]+)/(?P<cycle>[a-zA-Z0-9_-]+)', [
    'methods' => 'GET',
    'callback' => 'get_score_par_cycle_et_institut',
    'permission_callback' => '__return_true'
  ]);
});


function get_score_par_cycle_et_institut($data) {
  global $wpdb;

  $institut_id = intval($data['institut_id']);
  $niveau = sanitize_text_field($data['niveau']);
  $cycle = sanitize_text_field($data['cycle']); // ex : licence, master, ingenieur...

  // Requête vers utm_master_score sans master_id
  $score = $wpdb->get_row($wpdb->prepare("
    SELECT m.id AS score_id, m.formule, fm.intitule_master, 
    et.nom AS nom_institut FROM utm_master_score m
    INNER JOIN utm_master_fichemaster fm ON fm.id = m.master_id INNER JOIN utm_master_instituts et ON et.id = fm.institut_id
    WHERE fm.institut_id = %d AND m.niveau = %s AND m.diplome = %s
    LIMIT 1
  ", $institut_id, $niveau, $cycle));



  if (!$score) {
    return new WP_Error('not_found', 'Formule non trouvée pour cet institut et cycle.', ['status' => 404]);
  }

  return rest_ensure_response([
    'score_id' => $score->id,
    'formule' => $score->formule
  ]);
}
