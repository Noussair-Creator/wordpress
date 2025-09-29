<?php

function get_all_specialites() {
    global $wpdb;
    $table = $wpdb->prefix . 'specialites'; // utm_specialites

    $results = $wpdb->get_results("SELECT id, code, intitule, domaine FROM $table ORDER BY intitule ASC", ARRAY_A);


    return $results;
}


function get_directeurs_by_institut($institut_id) {
    // Récupérer tous les utilisateurs avec rôle 'um_directeur_these' et institut_id correspondant
    $args = [
        'role' => 'um_directeur_these',
        'meta_query' => [
            [
                'key' => 'institut_id',
                'value' => $institut_id,
                'compare' => '='
            ]
        ]
    ];

    $users = get_users($args);

    $result = [];
    foreach ($users as $user) {
        $result[] = [
            'id'       => $user->ID,
            'nom'      => $user->display_name,
            'email'    => $user->user_email,
            'institut' => get_user_meta($user->ID, 'institut_id', true)
        ];
    }

    return $result;
}


function get_all_inscriptions() {
    global $wpdb;
    $table = $wpdb->prefix . 'ED_theses_doctorants';
    return $wpdb->get_results("SELECT * FROM $table ORDER BY date_update DESC", ARRAY_A);
}

function get_inscriptions_by_institut($institut_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'ED_theses_doctorants';
    $users_table = $wpdb->prefix . 'users';
    $usermeta_table = $wpdb->prefix . 'usermeta';

    $query = $wpdb->prepare("
        SELECT t.*
        FROM $table t
        INNER JOIN $users_table u ON t.doctorant_id = u.ID
        INNER JOIN $usermeta_table um ON um.user_id = u.ID
        WHERE um.meta_key = 'institut_id' AND um.meta_value = %d
        ORDER BY t.date_update DESC
    ", $institut_id);

    return $wpdb->get_results($query, ARRAY_A);
}

function get_inscription($id) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_theses_doctorants";

    return $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table WHERE doctorant_id  = %d", $id
    ));
}

// Fonction callback
function create_inscription(WP_REST_Request $request) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_theses_doctorants"; // ou "utm_ED_theses_doctorants"

    // Champs classiques
    $doctorant_id = intval($request->get_param('doctorant_id'));
    $sujet        = sanitize_text_field($request->get_param('sujet'));
    $specialite   = sanitize_text_field($request->get_param('specialite'));
    $date_debut   = sanitize_text_field($request->get_param('date_debut'));
    $directeur_id = intval($request->get_param('directeur_id'));
    $laboratoire  = sanitize_text_field($request->get_param('laboratoire'));
    $type_these   = sanitize_text_field($request->get_param('type_these'));
    $cotutelle    = sanitize_text_field($request->get_param('cotutelle'));

    // Insertion de base
    $wpdb->insert($table, [
        'doctorant_id' => $doctorant_id,
        'sujet'        => $sujet,
        'specialite'   => $specialite,
        'date_debut'   => $date_debut,
        'directeur_id' => $directeur_id,
        'laboratoire'  => $laboratoire,
        'type_these'   => $type_these,
        'cotutelle'    => $cotutelle,
        'statut'       => 'En cours',
        'date_update'  => current_time('mysql')
    ]);
//    $id = $wpdb->insert_id;



    // Gestion du dossier custom
    $upload_dir = wp_upload_dir();
    $custom_dir = $upload_dir['basedir'] . '/theses_files';
    if (!file_exists($custom_dir)) {
        wp_mkdir_p($custom_dir);
    }

    // Upload fichiers
    $files = $request->get_file_params();
    

    $uploaded_files = [];
    foreach ($files as $key => $file) {
        // Déplacement du fichier vers le dossier dédié
        $filename = sanitize_file_name($file['name']);
        $target = $custom_dir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            $url = $upload_dir['baseurl'] . '/theses_files/' . $filename;
            $uploaded_files[$key] = $url;

            // Mettre à jour la table pour ce fichier
            $column_name = 'fichier_' . strtolower($key); // ex: diplome => fichier_diplome
            $wpdb->update($table, [$column_name => $url], ['id' => $id]);
        } else {
            $uploaded_files[$key] = 'Erreur lors de l\'upload';
        }
    }

    return [
        'success' => true,
        'id'      => $id,
        'files'   => $uploaded_files,
        'message' => 'Inscription créée avec succès et fichiers uploadés'
    ];
}


// Fonction update 
function update_inscription($id, WP_REST_Request $request) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_theses_doctorants";

    // Récupération des champs classiques
    $data = [
        'sujet'        => sanitize_text_field($request->get_param('sujet')),
        'specialite'   => sanitize_text_field($request->get_param('specialite')),
        'date_debut'   => sanitize_text_field($request->get_param('date_debut')),
        'directeur_id' => intval($request->get_param('directeur_id')),
        'laboratoire'  => sanitize_text_field($request->get_param('laboratoire')),
        'type_these'   => sanitize_text_field($request->get_param('type_these')),
        'cotutelle'    => sanitize_text_field($request->get_param('cotutelle')),
        'statut'       => sanitize_text_field($request->get_param('statut')),
        'date_update'  => current_time('mysql')
    ];

    // Mise à jour des champs classiques
    $wpdb->update($table, $data, ['id' => $id]);

    // Gestion des fichiers uploadés
    $upload_dir = wp_upload_dir();
    $custom_dir = $upload_dir['basedir'] . '/theses_files';
    if (!file_exists($custom_dir)) wp_mkdir_p($custom_dir);

    $files = $request->get_file_params();
    $uploaded_files = [];

    foreach ($files as $key => $file) {
        $filename = sanitize_file_name($file['name']);
        $target = $custom_dir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            $url = $upload_dir['baseurl'] . '/theses_files/' . $filename;
            $uploaded_files[$key] = $url;

            // Mettre à jour la colonne correspondante dans la table
            $column_name = 'fichier_' . strtolower($key); // ex: diplome => fichier_diplome
            $wpdb->update($table, [$column_name => $url], ['id' => $id]);
        } else {
            $uploaded_files[$key] = 'Erreur lors de l\'upload';
        }
    }

    return [
        'success' => true,
        'id'      => $id,
        'files'   => $uploaded_files,
        'message' => 'Inscription mise à jour avec succès'
    ];
}




// Récupérer toutes les demandes
function get_all_demande_stage() {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_stage";

    return $wpdb->get_results("SELECT * FROM {$table} ORDER BY date_update DESC", ARRAY_A);
}

// Récupérer une demande par ID
function get_demande_stage($id) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_stage";

    return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id = %d", $id), ARRAY_A);
}

// Récupérer demandes par institut
function get_demande_stage_by_institut($institut_id) {
    
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_stage";

    $query = "
        SELECT s.*
        FROM {$table} s
        INNER JOIN {$wpdb->prefix}usermeta um ON um.user_id = s.doctorant_id
        WHERE um.meta_key = 'institut_id' AND um.meta_value = %d
        ORDER BY s.date_update DESC
    ";
    return $wpdb->get_results($wpdb->prepare($query, $institut_id), ARRAY_A);
}

// Créer une demande
function create_demande_stage($data, $files = []) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_stage";

    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status' => 401]);
    }

    $data['doctorant_id'] = $current_user_id;

    // Calcul durée totale
    $duree_totale = null;
    if (!empty($data['date_depart']) && !empty($data['date_retour'])) {
        $start = new DateTime($data['date_depart']);
        $end = new DateTime($data['date_retour']);
        $diff = $start->diff($end);
        $duree_totale = $diff->days . ' jours';
    }


    $wpdb->insert($table, [
        'doctorant_id'     => intval($data['doctorant_id']),
        'type_demande'     => sanitize_text_field($data['type_demande'] ?? 'Stage'),
        'objet_mission'    => sanitize_text_field($data['objet_mission']),
        'date_depart'      => sanitize_text_field($data['date_depart']),
        'date_retour'      => sanitize_text_field($data['date_retour']),
        'duree_totale'     => $duree_totale,
        'pays'             => sanitize_text_field($data['pays']),
        'structure_type'   => sanitize_text_field($data['structure_type'] ?? 'Entreprise'),
        'structure_nom'    => sanitize_text_field($data['structure_nom']),
        'autorisation'     => sanitize_text_field($data['autorisation'] ?? 'Oui'),
        'type_financement' => sanitize_text_field($data['type_financement'] ?? 'Personnel'),
        'assurance'        => sanitize_text_field($data['assurance'] ?? 'Fourni'),
        'commentaire'      => sanitize_textarea_field($data['commentaire'] ?? ''),
        'statut'           => sanitize_text_field($data['statut'] ?? 'Brouillon'),
        'date_update'      => current_time('mysql')
    ]);

    $id = $wpdb->insert_id;

    // Upload fichiers
    if (!empty($files)) {
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/demande_stage';
        if(!file_exists($custom_dir)) wp_mkdir_p($custom_dir);

        foreach($files as $key => $file) {
            $filename = sanitize_file_name($file['name']);
            $target = $custom_dir . '/' . $filename;
            if(move_uploaded_file($file['tmp_name'], $target)) {
                $url = $upload_dir['baseurl'] . '/demande_stage/' . $filename;
                $column = 'fichier_' . strtolower($key);
                $wpdb->update($table, [$column => $url], ['id' => $id]);
            }
        }
    }

    return get_demande_stage($id);
}

// Mettre à jour une demande
function update_demande_stage($id, $data, $files = []) {
    
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_stage";


    $update_data = [
        'type_demande'    => sanitize_text_field($data['type_demande'] ?? 'Stage'),
        'objet_mission'   => sanitize_text_field($data['objet_mission']),
        'date_depart'     => sanitize_text_field($data['date_depart']),
        'date_retour'     => sanitize_text_field($data['date_retour']),
        'pays'            => sanitize_text_field($data['pays']),
        'structure_type'  => sanitize_text_field($data['structure_type'] ?? 'Entreprise'),
        'structure_nom'   => sanitize_text_field($data['structure_nom']),
        'autorisation'    => sanitize_text_field($data['autorisation'] ?? 'Oui'),
        'type_financement'=> sanitize_text_field($data['type_financement'] ?? 'Personnel'),
        'assurance'       => sanitize_text_field($data['assurance'] ?? 'Fourni'),
        'commentaire'     => sanitize_textarea_field($data['commentaire'] ?? ''),
        'statut'          => sanitize_text_field($data['statut'] ?? 'Brouillon'),
        'date_update'     => current_time('mysql')
    ];

    $wpdb->update($table, $update_data, ['id' => $id]);

    // Upload fichiers
    if (!empty($files)) {
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/demande_stage';
        if(!file_exists($custom_dir)) wp_mkdir_p($custom_dir);

        foreach($files as $key => $file) {
            $filename = sanitize_file_name($file['name']);
            $target = $custom_dir . '/' . $filename;
            if(move_uploaded_file($file['tmp_name'], $target)) {
                $url = $upload_dir['baseurl'] . '/demande_stage/' . $filename;
                $column = 'fichier_' . strtolower($key);
                $wpdb->update($table, [$column => $url], ['id' => $id]);
            }
        }
    }

    return get_demande_stage($id);
}



// Bourse

function create_demande_bourse(array $data, array $files = []) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_bourse";

    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status' => 401]);
    }

    $data['doctorant_id'] = $current_user_id;

    // Calcul durée totale
    $duree_totale = null;
    if (!empty($data['date_depart']) && !empty($data['date_retour'])) {
        $start = new DateTime($data['date_depart']);
        $end = new DateTime($data['date_retour']);
        $diff = $start->diff($end);
        $duree_totale = $diff->days . ' jours';
    }

    $wpdb->insert($table, [
        'doctorant_id' => intval($data['doctorant_id']),
        'objet_demande' => sanitize_text_field($data['objet_demande']),
        'intitule_mission' => sanitize_text_field($data['intitule_mission']),
        'structure_type' => sanitize_text_field($data['structure_type'] ?? 'Entreprise'),
        'structure_nom' => sanitize_text_field($data['structure_nom']),
        'pays' => sanitize_text_field($data['pays']),
        'date_depart' => sanitize_text_field($data['date_depart']),
        'date_retour' => sanitize_text_field($data['date_retour']),
        'duree_totale' => $duree_totale,
        'encadrant' => sanitize_text_field($data['encadrant'] ?? ''),
        'modalite_presence' => sanitize_text_field($data['modalite_presence'] ?? 'Présentiel'),
        'montant_estime' => sanitize_text_field($data['montant_estime'] ?? ''),
        'financement_compl' => sanitize_text_field($data['financement_compl'] ?? 'Oui'),
        'assurance' => sanitize_text_field($data['assurance'] ?? 'Fourni'),
        'commentaire' => sanitize_textarea_field($data['commentaire'] ?? ''),
        'statut' => sanitize_text_field($data['statut'] ?? 'Brouillon'),
        'date_update' => current_time('mysql')
    ]);

    $id = $wpdb->insert_id;

    // Upload fichiers
    if (!empty($files)) {
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/demande_bourse';
        if(!file_exists($custom_dir)) wp_mkdir_p($custom_dir);

        foreach($files as $key => $file) {
            $filename = sanitize_file_name($file['name']);
            $target = $custom_dir . '/' . $filename;
            if(move_uploaded_file($file['tmp_name'], $target)) {
                $url = $upload_dir['baseurl'] . '/demande_bourse/' . $filename;
                $column = 'fichier_' . strtolower($key);
                $wpdb->update($table, [$column => $url], ['id' => $id]);
            }
        }
    }

    return $wpdb->get_row("SELECT * FROM $table WHERE id = $id", ARRAY_A);
}


function get_all_demande_bourse() {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_bourse";
    return $wpdb->get_results("SELECT * FROM $table ORDER BY date_update DESC", ARRAY_A);
}

function get_demande_bourse($id) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_bourse";
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id), ARRAY_A);
}

function get_demande_bourse_by_institut($institut) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_bourse";
    return $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table WHERE structure_nom = %s ORDER BY date_update DESC", $institut),
        ARRAY_A
    );
}


function update_demande_bourse($id, $data, $files = []) {
    global $wpdb;
    $table = $wpdb->prefix . "ED_demande_bourse";

    // Vérifier que l'utilisateur est connecté
    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status' => 401]);
    }

    // Récupérer l'enregistrement existant
    $existing = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id), ARRAY_A);
    if (!$existing) {
        return new WP_Error('not_found', 'Demande introuvable', ['status' => 404]);
    }

    // Calcul de la durée totale si dates fournies
    $duree_totale = null;
    if (!empty($data['date_depart']) && !empty($data['date_retour'])) {
        $start = new DateTime($data['date_depart']);
        $end = new DateTime($data['date_retour']);
        $diff = $start->diff($end);
        $duree_totale = $diff->days . ' jours';
    }

    // Préparer les données à mettre à jour
    $update_data = [
        'doctorant_id'     => intval($current_user_id),
        'type_demande'     => sanitize_text_field($data['type_demande'] ?? $existing['type_demande']),
        'objet_mission'    => sanitize_text_field($data['objet_mission'] ?? $existing['objet_mission']),
        'date_depart'      => sanitize_text_field($data['date_depart'] ?? $existing['date_depart']),
        'date_retour'      => sanitize_text_field($data['date_retour'] ?? $existing['date_retour']),
        'duree_totale'     => $duree_totale ?? $existing['duree_totale'],
        'pays'             => sanitize_text_field($data['pays'] ?? $existing['pays']),
        'structure_type'   => sanitize_text_field($data['structure_type'] ?? $existing['structure_type']),
        'structure_nom'    => sanitize_text_field($data['structure_nom'] ?? $existing['structure_nom']),
        'autorisation'     => sanitize_text_field($data['autorisation'] ?? $existing['autorisation']),
        'type_financement' => sanitize_text_field($data['type_financement'] ?? $existing['type_financement']),
        'assurance'        => sanitize_text_field($data['assurance'] ?? $existing['assurance']),
        'commentaire'      => sanitize_textarea_field($data['commentaire'] ?? $existing['commentaire']),
        'statut'           => sanitize_text_field($data['statut'] ?? $existing['statut']),
        'date_update'      => current_time('mysql')
    ];

    // Mettre à jour l'enregistrement
    $wpdb->update($table, $update_data, ['id' => $id]);

    // Upload fichiers
    if (!empty($files)) {
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/demande_bourse';
        if (!file_exists($custom_dir)) wp_mkdir_p($custom_dir);

        foreach ($files as $key => $file) {
            $filename = sanitize_file_name($file['name']);
            $target = $custom_dir . '/' . $filename;
            if (move_uploaded_file($file['tmp_name'], $target)) {
                $url = $upload_dir['baseurl'] . '/demande_bourse/' . $filename;
                $column = 'fichier_' . strtolower($key);
                $wpdb->update($table, [$column => $url], ['id' => $id]);
            }
        }
    }

    // Retourner l'enregistrement mis à jour
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id), ARRAY_A);
}


function get_all_laboratoires() {
    global $wpdb;
    $table = $wpdb->prefix . 'Labo_laboratoire'; // utm_Labo_laboratoire si $wpdb->prefix = 'utm_'

    $results = $wpdb->get_results("SELECT id, logo, denomination, code, etablissement_id, date_creation, directeur_id, etat FROM $table ORDER BY denomination ASC");

    return $results;
}
