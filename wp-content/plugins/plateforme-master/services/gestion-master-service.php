<?php
function gm_get_masters_by_user() {
    $user_id = get_current_user_id();
    $cu=wp_get_current_user();
    $roles = $cu->roles;
        if (!$user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

    $institut_id = get_user_meta($user_id, 'institut_id', true);


    // if (!$institut_id) {
    //     return new WP_Error('no_institut', 'Aucun institut associé à cet utilisateur', ['status' => 403]);
    // }

    global $wpdb;
    $sql= "
        SELECT 
            f.id,
            f.institut_id,
            f.intitule_master,
            f.code_interne,
            f.parcours,
            f.domaine,
            f.debut_habilitation,
            f.fin_habilitation,
            f.diplomes_requis,
            f.nature_id,
            f.mention_id,
            f.departement_id,
            f.diplome_id,
            f.specialite_id,
            f.procedure_selection,
            f.nb_places,
            f.criteres_admission,
            f.public_vise,
            f.formule_score,
            f.plan_etude_pdf,
            f.annee_universitaire,
            f.date_creation,
            s1.intitule as debut_annee_habilitation,
            s2.intitule as fin_annee_habilitation,
            s1.id as debut_annee_habilitation_id,
            s2.id as fin_annee_habilitation_id,  
            n.libelle AS nature,
            m.libelle AS mention,
            d.libelle AS departement,
            sp.libelle AS specialite,
            dip.libelle AS diplome,
            i.nom AS institut,
            u.nom AS universite

        FROM {$wpdb->prefix}master_fichemaster f
        LEFT JOIN {$wpdb->prefix}master_nature n ON f.nature_id = n.id
        LEFT JOIN {$wpdb->prefix}master_mention m ON f.mention_id = m.id
        LEFT JOIN {$wpdb->prefix}master_departement d ON f.departement_id = d.id
        LEFT JOIN {$wpdb->prefix}master_specialite sp ON f.specialite_id = sp.id
        LEFT JOIN {$wpdb->prefix}master_diplome dip ON f.diplome_id = dip.id
        LEFT JOIN {$wpdb->prefix}master_instituts i ON f.institut_id = i.id
        LEFT JOIN {$wpdb->prefix}master_universites u ON i.universite_id = u.id
        LEFT JOIN {$wpdb->prefix}master_session_universitaire s1 ON f.debut_annee_habilitation = s1.id
        LEFT JOIN {$wpdb->prefix}master_session_universitaire s2 ON f.fin_annee_habilitation= s2.id
    ";
    // $masters = $wpdb->get_results($wpdb->prepare(, $institut_id), ARRAY_A);
    if (in_array('um_service-utm', $roles)) {
        $where_clause = ""; // Aucun filtre
        $prepared_sql = $sql;
        $masters = $wpdb->get_results($prepared_sql, ARRAY_A);

    } 
    elseif (in_array('um_service-master', $roles) || in_array('um_coordonnateur-master', $roles) ) {
        $where_clause = " WHERE f.institut_id = %d";
        $prepared_sql = $sql . $where_clause;
        $masters = $wpdb->get_results($wpdb->prepare($prepared_sql, $institut_id), ARRAY_A);
    }

    foreach ($masters as &$master) {
        // 🔹 Coordinateur
        $coordinateur = $wpdb->get_row($wpdb->prepare("
            SELECT coordinateur_id FROM {$wpdb->prefix}master_coordinateurs
            WHERE master_id = %d ORDER BY date_affectation DESC LIMIT 1
        ", $master['id']), ARRAY_A);

        if ($coordinateur && isset($coordinateur['coordinateur_id'])) {
            $user = get_userdata($coordinateur['coordinateur_id']);
            if ($user) {
                $master['coordinateur'] = [
                    'id'          => $user->ID,
                    'display_name'=> $user->display_name,
                    'email'       => $user->user_email,
                    'avatar'      => get_avatar_url($user->ID),
                    'grade'       => get_user_meta($user->ID, 'grade', true),
                    'specialite'       => get_user_meta($user->ID, 'specialite', true),
                    'tel'         => get_user_meta($user->ID, 'telephone', true),
                ];
            }
        } else {
            $master['coordinateur'] = null;
        }

        // 🔹 Objectifs
        $master['objectifs_generaux'] = $wpdb->get_col($wpdb->prepare("
            SELECT contenu FROM {$wpdb->prefix}master_objectifs
            WHERE master_id = %d AND type = 'general'
        ", $master['id']));

        $master['objectifs_specifiques'] = $wpdb->get_col($wpdb->prepare("
            SELECT contenu FROM {$wpdb->prefix}master_objectifs
            WHERE master_id = %d AND type = 'specifique'
        ", $master['id']));

        // 🔹 Conditions d’admission (table dédiée)
        $master['admission'] = [];

        $admissions = $wpdb->get_results($wpdb->prepare("
            SELECT diplomes_requis, procedure_selection, nb_places, criteres_admission, public_vise, niveau
            FROM {$wpdb->prefix}master_admission
            WHERE master_id = %d
        ", $master['id']), ARRAY_A);

        if ($admissions) {
            foreach ($admissions as $admission) {
                $niveau = strtoupper($admission['niveau']);
                $master['admission'][$niveau] = $admission;
            }
        }
        // 🔹 Statut coordinateur (utm_statut_master)
        $statut = $wpdb->get_row($wpdb->prepare("
            SELECT statut_coordinateur, date_statut_coordinateur, user_statut_coordinateur
            FROM {$wpdb->prefix}statut_master
            WHERE master_id = %d
            LIMIT 1
        ", $master['id']), ARRAY_A);

        $master['statut_coordinateur'] = $statut ?: [
            'statut_coordinateur' => null,
            'date_statut_coordinateur' => null,
            'user_statut_coordinateur' => null
        ];
        // 🔹 Scores (M1 et M2)
      $scores = $wpdb->get_results($wpdb->prepare("
          SELECT niveau, formule 
          FROM {$wpdb->prefix}master_score
          WHERE master_id = %d
      ", $master['id']), ARRAY_A);

      // Initialiser les formules avec valeurs nulles
      // 🔹 Scores par niveau et par mention (diplome)
        $scores = $wpdb->get_results($wpdb->prepare("
            SELECT niveau, diplome, formule
            FROM {$wpdb->prefix}master_score
            WHERE master_id = %d
        ", $master['id']), ARRAY_A);

        // Initialiser la structure des scores
        $master['formule_score'] = [
            'M1' => [],
            'M2' => []
        ];

        // Organiser les scores par niveau et mention
        foreach ($scores as $row) {
            $niv = strtoupper($row['niveau']);
            $mention = $row['diplome'];

            if (!isset($master['formule_score'][$niv])) {
                $master['formule_score'][$niv] = [];
            }

            $master['formule_score'][$niv][$mention] = $row['formule'];
        }


    }

    return $masters;
}


function pm_update_master($request) {
    global $wpdb;
    $id = intval($request['id']);
    $data = $request->get_json_params();
  
    $updated = $wpdb->update(
      $wpdb->prefix . 'master_fichemaster',
      [
        'intitule_master'     => sanitize_text_field($data['intitule']),
        'code_interne'        => sanitize_text_field($data['code']),
        'parcours'            => sanitize_text_field($data['parcours']),
        'domaine'             => sanitize_text_field($data['domaine']),
        'debut_habilitation'  => sanitize_text_field($data['debut']),
        'fin_habilitation'    => sanitize_text_field($data['fin']),
        'nb_places'           => intval($data['capacite']),
        'langue'              => sanitize_text_field($data['langue']),
        'debut_annee_habilitation'=> sanitize_text_field($data['debut_annee_habilitation']),
        'fin_annee_habilitation'=> sanitize_text_field($data['fin_annee_habilitation']),
      ],
      ['id' => $id]
    );

  
    return $updated !== false
      ? ['success' => true]
      : new WP_Error('update_failed', 'Échec de mise à jour', ['status' => 500]);
  }
  
function pm_update_objectifs_master($request) {
    global $wpdb;
    $master_id = intval($request['master_id']);
    $params = $request->get_json_params();
  
    if (!$master_id || empty($params['specifique']) || !is_array($params['generaux'])) {
      return new WP_Error('invalid_data', 'Paramètres manquants ou invalides', ['status' => 400]);
    }
  
    $table = $wpdb->prefix . 'master_objectifs';
  
    // 🔁 Supprimer les anciens objectifs
    $wpdb->delete($table, ['master_id' => $master_id]);
  
    // 🔁 Insérer les objectifs spécifiques
    $wpdb->insert($table, [
      'master_id' => $master_id,
      'type'      => 'specifique',
      'contenu'   => wp_kses_post($params['specifique']),
    ]);
  
    // 🔁 Insérer les objectifs généraux (liste)
    foreach ($params['generaux'] as $item) {
      $wpdb->insert($table, [
        'master_id' => $master_id,
        'type'      => 'general',
        'contenu'   => sanitize_text_field($item),
      ]);
    }
  
    return ['success' => true];
  }

/*
  function update_conditions_admission($request) {
    global $wpdb;
  
    $master_id = intval($request['id']);
    $data = $request->get_json_params();
  
    // Vérifications
    if (!$master_id || empty($data)) {
      return new WP_Error('invalid_data', 'Paramètres invalides', ['status' => 400]);
    }
  
    $updated = $wpdb->update(
      $wpdb->prefix . 'master_fichemaster',
      [
        'diplomes_requis'     => sanitize_text_field($data['diplomes_requis'] ?? ''),
        'procedure_selection' => sanitize_text_field($data['procedure_selection'] ?? ''),
        'nb_places'           => intval($data['nb_places'] ?? 0),
        'criteres_admission'  => sanitize_text_field($data['criteres_admission'] ?? ''),
        'public_vise'         => sanitize_text_field($data['public_vise'] ?? '')
      ],
      ['id' => $master_id]
    );
  
    return $updated !== false
      ? ['success' => true, 'id' => $master_id]
      : new WP_Error('update_failed', 'Échec de la mise à jour', ['status' => 500]);
  }
  */

  function update_conditions_admission($request) {
    global $wpdb;

    $master_id = intval($request['id']); // depuis l'URL
    $params = $request->get_json_params();

    $diplomes_requis     = sanitize_text_field($params['diplomes_requis'] ?? '');
    $procedure_selection = sanitize_text_field($params['procedure_selection'] ?? '');
    $nb_places           = intval($params['nb_places'] ?? 0);
    $criteres_admission  = sanitize_textarea_field($params['criteres_admission'] ?? '');
    $public_vise         = sanitize_textarea_field($params['public_vise'] ?? '');
    $cycle               = strtoupper(sanitize_text_field($params['currentCycle'] ?? ''));

    if (!$master_id || !$cycle) {
        return new WP_Error('invalid_data', 'ID du master ou cycle manquant', ['status' => 400]);
    }

    // Nom de la table personnalisée
    $table = $wpdb->prefix . 'master_admission';

    // Vérifier si une ligne existe déjà pour ce master_id + cycle
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE master_id = %d AND cycle = %s",
        $master_id, $cycle
    ));

    if ($exists) {
        // 🔄 Mise à jour
        $result = $wpdb->update(
            $table,
            [
                'diplomes_requis'     => $diplomes_requis,
                'procedure_selection' => $procedure_selection,
                'nb_places'           => $nb_places,
                'criteres_admission'  => $criteres_admission,
                'public_vise'         => $public_vise
            ],
            [
                'master_id' => $master_id,
                'niveau'     => $cycle
            ],
            ['%s', '%s', '%d', '%s', '%s'],
            ['%d', '%s']
        );
    } else {
        // ➕ Insertion
        $result = $wpdb->insert(
            $table,
            [
                'master_id'           => $master_id,
                'niveau'               => $cycle,
                'diplomes_requis'     => $diplomes_requis,
                'procedure_selection' => $procedure_selection,
                'nb_places'           => $nb_places,
                'criteres_admission'  => $criteres_admission,
                'public_vise'         => $public_vise
            ],
            ['%d', '%s', '%s', '%s', '%d', '%s', '%s']
        );
    }

    if ($result === false) {
        return new WP_Error('db_error', 'Erreur lors de l’enregistrement', ['status' => 500]);
    }

    return rest_ensure_response(['success' => true, 'message' => 'Conditions enregistrées.']);
}


  function save_score_critere($request) {
    global $wpdb;
  
    $master_id = intval($request['master_id']);
    $data = $request->get_json_params();
  
    $criteres = $data['criteres'] ?? [];
    $formule = $data['formule'] ?? '';
  
    if (empty($criteres) || !$master_id) {
      return new WP_Error('missing_data', 'Critères ou master ID manquant', ['status' => 400]);
    }
  
    // 🔄 Supprimer les anciens critères liés à ce master
    $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['master_id' => $master_id]);
  
    // ✅ Insertion des nouveaux critères
    $order = 1;
    foreach ($criteres as $critere) {
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'master_id'     => $master_id,
        'champ'         => sanitize_text_field($critere['champ']),
        'ponderation'   => floatval($critere['ponderation']),
        'type_valeur'   => sanitize_text_field($critere['type_valeur']),
        'operation'     => sanitize_text_field($critere['operation']),
        'ordre'         => $order++,
        'date_creation' => current_time('mysql'),
        'date_modification' => current_time('mysql'),
      ]);
    }
  
    // 🔁 Enregistrer la formule finale dans la table principale
    $wpdb->update(
      "{$wpdb->prefix}master_fichemaster",
      ['formule_score' => sanitize_text_field($formule)],
      ['id' => $master_id]
    );
  
    return ['success' => true];
  }
  

  function update_plan_etude_OLD($request) {
    global $wpdb;

    $master_id = intval($request['id']);

    if (empty($_FILES['pdf'])) {
        return new WP_Error('no_file', 'Aucun fichier reçu.', ['status' => 400]);
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $upload = media_handle_upload('pdf', 0);

    if (is_wp_error($upload)) {
        return new WP_Error('upload_failed', 'Erreur de téléchargement.', ['status' => 500]);
    }

    $url = wp_get_attachment_url($upload);

    $updated = $wpdb->update(
        $wpdb->prefix . 'master_fichemaster',
        ['plan_etude_pdf' => esc_url_raw($url)],
        ['id' => $master_id]
    );

    if ($updated === false) {
        return new WP_Error('update_failed', 'Échec de mise à jour du plan.', ['status' => 500]);
    }

    return [
        'success' => true,
        'url'     => $url
    ];
}


function update_plan_etude($request) {
    global $wpdb;

    // 1. Verify nonce (security check)
    // if (!isset($request['_wpnonce']) || !wp_verify_nonce($request['_wpnonce'], 'update_plan_etude_nonce')) {
    //     error_log('Security check failed: Invalid nonce');
    //     return new WP_REST_Response([
    //         'success' => false,
    //         'message' => 'Security verification failed'
    //     ], 403);
    // }

    // 2. Validate master ID
    $master_id = intval($request['id']);
    $table_name = $wpdb->prefix . 'master_fichemaster';
    
    error_log("Starting PDF update for master ID: $master_id");

    // 3. Check if file was uploaded
    if (empty($_FILES['pdf'])) {
        error_log('No file received in upload');
        return new WP_REST_Response([
            'success' => false,
            'message' => 'No file received'
        ], 400);
    }

    // 4. Validate file upload
    if ($_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
        $error_msg = 'File upload error: ' . $_FILES['pdf']['error'];
        error_log($error_msg);
        return new WP_REST_Response([
            'success' => false,
            'message' => $error_msg
        ], 400);
    }

    // 5. Check file type and size
    $file_type = wp_check_filetype($_FILES['pdf']['name']);
    if ($file_type['ext'] !== 'pdf') {
        error_log('Invalid file type: ' . $file_type['ext']);
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Only PDF files are allowed'
        ], 400);
    }

    if ($_FILES['pdf']['size'] > 5 * 1024 * 1024) {
        error_log('File too large: ' . $_FILES['pdf']['size'] . ' bytes');
        return new WP_REST_Response([
            'success' => false,
            'message' => 'File size must be under 5MB'
        ], 400);
    }

    // 6. Process file upload
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $upload_overrides = ['test_form' => false];
    $upload = wp_handle_upload($_FILES['pdf'], $upload_overrides);

    if (isset($upload['error'])) {
        error_log('Upload failed: ' . $upload['error']);
        return new WP_REST_Response([
            'success' => false,
            'message' => $upload['error']
        ], 500);
    }

    // 7. Create attachment
    $attachment = [
        'post_mime_type' => $upload['type'],
        'post_title' => sanitize_file_name(pathinfo($upload['file'], PATHINFO_FILENAME)),
        'post_content' => '',
        'post_status' => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $upload['file']);
    
    if (is_wp_error($attach_id)) {
        @unlink($upload['file']);
        error_log('Attachment creation failed: ' . $attach_id->get_error_message());
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Failed to create attachment'
        ], 500);
    }

    // 8. Generate metadata
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    $url = wp_get_attachment_url($attach_id);

    // 9. Update database
    error_log("Attempting to update database for master ID: $master_id");
    
    // First verify table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        error_log('ERROR: Table does not exist');
        wp_delete_attachment($attach_id, true);
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Database table missing'
        ], 500);
    }

    // Perform update using direct query
    $query = $wpdb->prepare(
        "UPDATE $table_name SET plan_etude_pdf = %s WHERE id = %d",
        $url,
        $master_id
    );



    
    $success = $wpdb->query($query);
    $rows_affected = $wpdb->rows_affected;
    
    error_log("Database update - Success: " . ($success ? 'Yes' : 'No'));
    error_log("Rows affected: $rows_affected");
    error_log("Last error: " . $wpdb->last_error);

    if ($success === false || $rows_affected === 0) {
        wp_delete_attachment($attach_id, true);
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Database update failed',
            'debug' => [
                'error' => $wpdb->last_error,
                'query' => $query
            ]
        ], 500);
    }

    // 10. Verify update
    $updated_url = $wpdb->get_var($wpdb->prepare(
        "SELECT plan_etude_pdf FROM $table_name WHERE id = %d",
        $master_id
    ));

    if ($updated_url !== $url) {
        error_log('ERROR: Database verification failed');
        wp_delete_attachment($attach_id, true);
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Database verification failed'
        ], 500);
    }

    // 11. Clean up old file
    // $old_pdf = $wpdb->get_var($wpdb->prepare(
    //     "SELECT plan_etude_pdf FROM $table_name WHERE id = %d", 
    //     $master_id
    // ));
    
    // if ($old_pdf && $old_pdf !== $url) {
    //     $old_attach_id = attachment_url_to_postid($old_pdf);
    //     if ($old_attach_id) {
    //         wp_delete_attachment($old_attach_id, true);
    //     }
    // }

    error_log("PDF update completed successfully for master ID: $master_id");
    return new WP_REST_Response([
        'success' => true,
        'url' => $url,
        'message' => 'Study plan updated successfully',
        'file_path' => $upload['file'] // For debugging
    ], 200);
}
function insert_master($request) {
    global $wpdb;

    // Récupération manuelle des champs du formulaire multipart
    $data = $_POST;
    $file = $_FILES['plan_etude_pdf'] ?? null;
    $upload_url = '';

    // Traitement du fichier PDF s’il existe
    if ($file && $file['tmp_name']) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $uploaded = wp_handle_upload($file, ['test_form' => false]);
        if (!isset($uploaded['error'])) {
            $upload_url = $uploaded['url'];
        }
    }

    // Authentification utilisateur
    $user_id = get_current_user_id();
    if (!$user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

    // Récupérer l’institut de l’utilisateur
    $institut_id = get_user_meta($user_id, 'institut_id', true);
    if (!$institut_id) {
        return new WP_Error('no_institut', 'Aucun institut associé à cet utilisateur', ['status' => 403]);
    }

    // Insertion dans la table `master_fichemaster`
    $result = $wpdb->insert(
        $wpdb->prefix . 'master_fichemaster',
        [
            'institut_id'         => $institut_id,
            'intitule_master'     => sanitize_text_field($data['intitule'] ?? ''),
            'code_interne'        => sanitize_text_field($data['code'] ?? ''),
            'parcours'            => sanitize_text_field($data['parcours'] ?? ''),
            'domaine'             => sanitize_text_field($data['domaine'] ?? ''),
            'langue'              => sanitize_text_field($data['langue'] ?? ''),
            'nb_places'           => intval($data['capacite'] ?? 0),
            'nature_id'           => intval($data['nature_id'] ?? 0),
            'plan_etude_pdf'      => esc_url_raw($upload_url),
            'annee_universitaire' => date('Y') . '-' . (date('Y') + 1),
            'date_creation'       => current_time('mysql'),
        ]
    );

    if ($result === false) {
        return new WP_Error('db_insert_error', 'Erreur lors de l’ajout du master', ['status' => 500]);
    }

    return [
        'success' => true,
        'id' => $wpdb->insert_id,
    ];
}
/*
function publish_master_session($request) {
    global $wpdb;

    $master_id = intval($request['id']);
    if (!$master_id) {
        return new WP_Error('invalid_id', 'ID master invalide', ['status' => 400]);
    }

    $table = "{$wpdb->prefix}master_sessions";

    // Vérifier s’il existe déjà une session publiée pour ce master
    $existing = $wpdb->get_row($wpdb->prepare("
        SELECT * FROM $table
        WHERE master_id = %d AND etat = 'publié web'
        LIMIT 1
    ", $master_id), ARRAY_A);

    $data = [
        'master_id'        => $master_id,
        'intitule_session' => 'Session principale',
        'etat'             => 'publié web',
        'date_creation'    => current_time('mysql'),
    ];

    if ($existing) {
        // 🟠 Mise à jour si elle existe
        $updated = $wpdb->update(
            $table,
            $data,
            ['id' => $existing['id']]
        );

        if ($updated === false) {
            return new WP_Error('update_failed', 'Échec de la mise à jour de session.', ['status' => 500]);
        }

        return ['success' => true, 'id' => $existing['id'], 'action' => 'updated'];
    } else {
        // 🟢 Insertion sinon
        $inserted = $wpdb->insert($table, $data);

        if (!$inserted) {
            return new WP_Error('insert_failed', 'Erreur lors de l’insertion de la session.', ['status' => 500]);
        }

        return ['success' => true, 'id' => $wpdb->insert_id, 'action' => 'inserted'];
    }
}
*/

function publish_master_session($request) {
    global $wpdb;

    $master_id = intval($request['id']);
    if (!$master_id) {
        return new WP_Error('invalid_id', 'ID master invalide', ['status' => 200]);
    }

 
    $score_exists = $wpdb->get_var($wpdb->prepare("
    SELECT COUNT(*) FROM {$wpdb->prefix}master_score
    WHERE master_id = %d AND TRIM(formule) != ''
    ", $master_id));

    if (!$score_exists) {
        return new WP_Error('score_required', 'Aucun score défini pour ce master. Veuillez enregistrer une formule avant de publier.', ['status' => 403]);
    }
    
    $table = "{$wpdb->prefix}master_sessions";

    // Vérifier s’il existe déjà une session publiée
    $existing = $wpdb->get_row($wpdb->prepare("
        SELECT * FROM $table
        WHERE master_id = %d AND etat = 'publié web'
        LIMIT 1
    ", $master_id), ARRAY_A);

    $data = [
        'master_id'        => $master_id,
        'intitule_session' => 'Session principale',
        'etat'             => 'publié web',
        'date_creation'    => current_time('mysql'),
    ];

    if ($existing) {
        $updated = $wpdb->update($table, $data, ['id' => $existing['id']]);

        if ($updated === false) {
            return new WP_Error('update_failed', 'Échec de la mise à jour de session.', ['status' => 500]);
        }

        return ['success' => true, 'id' => $existing['id'], 'action' => 'updated'];
    } else {
        $inserted = $wpdb->insert($table, $data);

        if (!$inserted) {
            return new WP_Error('insert_failed', 'Erreur lors de l’insertion de la session.', ['status' => 500]);
        }

        return ['success' => true, 'id' => $wpdb->insert_id, 'action' => 'inserted'];
    }
}

function publish_master_session2($request) {
    global $wpdb;

    $master_id = intval($request['id']);
    $params = $request->get_json_params();
    $statut = sanitize_text_field($params['statut'] ?? '');
    $user_id = get_current_user_id();
    $date = current_time('mysql');

    if (!$master_id || !$statut) {
        return new WP_Error('invalid', 'ID ou statut manquant', ['status' => 400]);
    }

    // 🔸 1. Enregistrer ou mettre à jour dans utm_statut_master
    $table_statut = $wpdb->prefix . 'statut_master';

    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_statut WHERE master_id = %d",
        $master_id
    ));

    if ($exists > 0) {
        $result = $wpdb->update(
            $table_statut,
            [
                'statut_service_master'      => $statut,
                'date_statut_service_master' => $date,
                'user_statut_service_master' => $user_id
            ],
            ['master_id' => $master_id],
            ['%s', '%s', '%d'],
            ['%d']
        );
    } else {
        $result = $wpdb->insert(
            $table_statut,
            [
                'master_id'                  => $master_id,
                'statut_service_master'      => $statut,
                'date_statut_service_master' => $date,
                'user_statut_service_master' => $user_id
            ],
            ['%d', '%s', '%s', '%d']
        );
    }

    if ($result === false) {
        return new WP_Error('db_error', 'Erreur lors de l’enregistrement du statut.', ['status' => 500]);
    }

    // 🔸 2. Créer ou mettre à jour une session dans utm_master_sessions si statut = 'publié web'
    $session_action = null;

    if ($statut === 'publié') {
        $table_sessions = "{$wpdb->prefix}master_sessions";

        $existing = $wpdb->get_row($wpdb->prepare("
            SELECT * FROM $table_sessions
            WHERE master_id = %d AND etat = 'publié web'
            LIMIT 1
        ", $master_id), ARRAY_A);

        $data = [
            'master_id'        => $master_id,
            'intitule_session' => 'Session principale',
            'etat'             => 'publié web',
            'date_creation'    => current_time('mysql'),
        ];

        if ($existing) {
            $updated = $wpdb->update($table_sessions, $data, ['id' => $existing['id']]);

            if ($updated === false) {
                return new WP_Error('update_failed', 'Échec de la mise à jour de session.', ['status' => 500]);
            }

            $session_action = 'updated';
        } else {
            $inserted = $wpdb->insert($table_sessions, $data);

            if (!$inserted) {
                return new WP_Error('insert_failed', 'Erreur lors de l’insertion de la session.', ['status' => 500]);
            }

            $session_action = 'inserted';
        }
    }

    return rest_ensure_response([
        'success' => true,
        'action_statut' => $exists > 0 ? 'update' : 'insert',
        'session_action' => $session_action
    ]);
}




function gm_api_get_sessions_universitaires() {
    global $wpdb;
    $table = $wpdb->prefix . 'master_session_universitaire';

    return rest_ensure_response([
        'status' => 'success',
        'data' => $wpdb->get_results("SELECT id, intitule, annee_debut, annee_fin, est_active FROM $table ORDER BY annee_debut ASC")
    ]);
}


 
 function update_statut_coordinateur($request) {
    global $wpdb;

    $master_id = intval($request['id']);


    $score_exists = $wpdb->get_var($wpdb->prepare("
    SELECT COUNT(*) FROM {$wpdb->prefix}master_score
    WHERE master_id = %d AND TRIM(formule) != ''
    ", $master_id));

    if (!$score_exists) {
        return new WP_Error('score_required', 'Aucun score défini pour ce master. Veuillez enregistrer une formule avant de publier.', ['status' => 403]);
    }



    $params = $request->get_json_params();
    $statut = sanitize_text_field($params['statut'] ?? '');
    $user_id = get_current_user_id();
    $date = current_time('mysql');



    if (!$master_id || !$statut) {
        return new WP_Error('invalid', 'ID ou statut manquant', ['status' => 400]);
    }

    $table = $wpdb->prefix . 'statut_master';

    // Vérifie si une ligne existe déjà pour ce master
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE master_id = %d",
        $master_id
    ));

    if ($exists > 0) {
        // 🔄 UPDATE
        $result = $wpdb->update(
            $table,
            [
                'statut_coordinateur' => $statut,
                'date_statut_coordinateur' => $date,
                'user_statut_coordinateur' => $user_id
            ],
            ['master_id' => $master_id],
            ['%s', '%s', '%d'],
            ['%d']
        );
    } else {
        // ➕ INSERT
        $result = $wpdb->insert(
            $table,
            [
                'master_id' => $master_id,
                'statut_coordinateur' => $statut,
                'date_statut_coordinateur' => $date,
                'user_statut_coordinateur' => $user_id
            ],
            ['%d', '%s', '%s', '%d']
        );
    }

    if ($result === false) {
        return new WP_Error('db_error', 'Erreur lors de l’enregistrement', ['status' => 500]);
    }

    return rest_ensure_response(['success' => true, 'action' => $exists > 0 ? 'update' : 'insert']);
}
/*
function save_score_data($request) {



  global $wpdb;

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']); // "M1" ou "M2"




  // Insère ou récupère le score_id
  $table_score = $wpdb->prefix . 'master_score';
  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'formule' => $data['formule'] ?? ''
  ], ['%d', '%s', '%s']);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Échec lors de la création du score.', ['status' => 500]);
  }

  // Nettoyage des anciennes données (bonus, malus, matières, etc.)
  $wpdb->delete("{$wpdb->prefix}master_score_matieres", ['score_id' => $score_id]);
  $wpdb->delete("{$wpdb->prefix}master_score_bonus_mention", ['score_id' => $score_id]);
  $wpdb->delete("{$wpdb->prefix}master_score_bonus_session", ['score_id' => $score_id]);
  $wpdb->delete("{$wpdb->prefix}master_score_malus", ['score_id' => $score_id]);
  $wpdb->delete("{$wpdb->prefix}master_score_interruption", ['score_id' => $score_id]);

  // INSERT des matières
  foreach ($data['matieres'] as $matiere) {
    $wpdb->insert("{$wpdb->prefix}master_score_matieres", [
      'score_id' => $score_id,
      'matiere' => sanitize_text_field($matiere['matiere']),
      'annee' => sanitize_text_field($matiere['annee']),
      'note' => floatval($matiere['note'])
    ]);
  }

  // INSERT bonus mention
  foreach ($data['bonus_mention'] as $b) {
    $wpdb->insert("{$wpdb->prefix}master_score_bonus_mention", [
      'score_id' => $score_id,
      'condition_mention' => sanitize_text_field($b['condition']),
      'valeur' => floatval($b['valeur'])
    ]);
  }

  // INSERT bonus session
  foreach ($data['bonus_session'] as $s) {
    $wpdb->insert("{$wpdb->prefix}master_score_bonus_session", [
      'score_id' => $score_id,
      'session' => sanitize_text_field($s['condition']),
      'valeur' => floatval($s['valeur'])
    ]);
  }

  // INSERT malus
  foreach ($data['malus'] as $m) {
    $wpdb->insert("{$wpdb->prefix}master_score_malus", [
      'score_id' => $score_id,
      'condition_texte' => sanitize_text_field($m['condition']),
      'valeur' => floatval($m['valeur']),
      'exclu_cycle_preparatoire' => isset($data['exclu_cycle_preparatoire']) ? 1 : 0
    ]);
  }

  // INSERT interruption
  foreach ($data['interruption'] as $i) {
    $wpdb->insert("{$wpdb->prefix}master_score_interruption", [
      'score_id' => $score_id,
      'condition_texte' => sanitize_text_field($i['condition']),
      'valeur' => floatval($i['valeur'])
    ]);
  }

  return rest_ensure_response(['success' => true, 'message' => 'Score enregistré.']);
}
*/

/*
function save_score_data($request) {
  global $wpdb;

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']); // "M1" ou "M2"

  $table_score = $wpdb->prefix . 'master_score';
  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'formule' => $data['formule'] ?? ''
  ], ['%d', '%s', '%s']);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Échec lors de la création du score.', ['status' => 500]);
  }

  $old_score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
    ));


  if ($old_score_id && $old_score_id !== $score_id) {
    // Supprimer les anciennes lignes liées à l'ancien score
    $wpdb->delete("{$wpdb->prefix}master_score_matieres", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_bonus_mention", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_bonus_session", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_malus", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_interruption", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_entretien", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_moyenne", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_config", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_pfe", ['score_id' => $old_score_id]);
    $wpdb->delete("{$wpdb->prefix}master_score_criteres", [
      'master_id' => $master_id,
      'score_id' => $old_score_id
    ]);
  }


  // Nv
  if (!empty($request['criteres_personnalises']) && is_array($request['criteres_personnalises'])) {
    foreach ($request['criteres_personnalises'] as $index => $critere) {
      // Validation basique
      $nom_template = sanitize_title($critere['nom_template'] ?? '');
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json = !empty($critere['config_json']) ? wp_json_encode($critere['config_json']) : null;

      // Ne pas insérer si les champs de base sont absents
      if (!$nom_template || !$titre_affiche) continue;

      $wpdb->insert('utm_master_score_templates', [
        'nom_template'     => $nom_template,
        'titre_affiche'    => $titre_affiche,
        'type'             => $type,
        'config_json'      => $config_json,
        'ordre_affichage'  => 100 + $index,
        'actif'            => 1,
        'created_by'       => get_current_user_id(),
        'created_at'       => current_time('mysql'),
        'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
      ]);
    }
  }



  // Credits et criteres à compléter selon structure

  // INSERT matières
  foreach ($data['matieres'] as $matiere) {
    $wpdb->insert("{$wpdb->prefix}master_score_matieres", [
      'score_id' => $score_id,
      'matiere' => sanitize_text_field($matiere['matiere']),
      'annee' => sanitize_text_field($matiere['annee']),
      'note' => floatval($matiere['note'])
    ]);
  }

  // INSERT bonus mention
  foreach ($data['bonus_mention'] as $b) {
    $wpdb->insert("{$wpdb->prefix}master_score_bonus_mention", [
      'score_id' => $score_id,
      'condition_mention' => sanitize_text_field($b['condition']),
      'valeur' => floatval($b['valeur'])
    ]);
  }

  // INSERT bonus session
  foreach ($data['bonus_session'] as $s) {
    $wpdb->insert("{$wpdb->prefix}master_score_bonus_session", [
      'score_id' => $score_id,
      'session' => sanitize_text_field($s['condition']),
      'valeur' => floatval($s['valeur'])
    ]);
  }

  // INSERT malus
  foreach ($data['malus'] as $m) {
    $wpdb->insert("{$wpdb->prefix}master_score_malus", [
      'score_id' => $score_id,
      'condition_texte' => sanitize_text_field($m['condition']),
      'valeur' => floatval($m['valeur']),
      'exclu_cycle_preparatoire' => isset($data['exclu_cycle_preparatoire']) ? 1 : 0
    ]);
  }

  // INSERT interruption
  foreach ($data['interruption'] as $i) {
    $wpdb->insert("{$wpdb->prefix}master_score_interruption", [
      'score_id' => $score_id,
      'condition_texte' => sanitize_text_field($i['condition']),
      'valeur' => floatval($i['valeur'])
    ]);
  }

  // ✅ INSERT entretien (si défini)
  if (!empty($data['entretien_note'])) {
    $wpdb->insert("{$wpdb->prefix}master_score_entretien", [
      'score_id' => $score_id,
      'note' => floatval($data['entretien_note'])
    ]);
  }

  // ✅ INSERT moyenne générale (si défini)
  if (!empty($data['moyenne_levels']) && is_array($data['moyenne_levels'])) {
  foreach ($data['moyenne_levels'] as $niveau) {
    $wpdb->insert("{$wpdb->prefix}master_score_moyenne", [
      'score_id' => $score_id,
      'niveau_etude' => sanitize_text_field($niveau)
    ]);
  }
  }

  // ✅ INSERT configuration (flags d’activation)
  if (!empty($data['config_flags']) && is_array($data['config_flags'])) {
    foreach ($data['config_flags'] as $cle => $actif) {
      $wpdb->insert("{$wpdb->prefix}master_score_config", [
        'score_id' => $score_id,
        'cle' => sanitize_text_field($cle),
        'actif' => $actif ? 1 : 0
      ]);
    }
  }


    if (!empty($data['pfe']['condition']) && isset($data['pfe']['valeur'])) {
    $wpdb->insert("{$wpdb->prefix}master_score_pfe", [
        'score_id' => $score_id,
        'condition_texte' => sanitize_text_field($data['pfe']['condition']),
        'valeur' => floatval($data['pfe']['valeur'])
    ]);
    }





        // Insertion des nouveaux critères
        if (!empty($data['criteres']) && is_array($data['criteres'])) {
        foreach ($data['criteres'] as $critere) {
            $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
            'master_id' => $master_id,
            'score_id' => $score_id,
            'champ' => sanitize_text_field($critere),
            'date_creation' => current_time('mysql')
            ]);
        }
        }

  // ❗ INSERT credits / criteres si nécessaires (selon ta structure)

  return rest_ensure_response(['success' => true, 'message' => 'Score enregistré.']);
}
*/

// version 12/06/2025
/*
function save_score_data($request) {
  global $wpdb;

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']); // "M1" ou "M2"

  $table_score = $wpdb->prefix . 'master_score';

  // 🔁 REPLACE score
  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'titre' => 'Score ' . $niveau,
    'formule' => $data['formule'] ?? '',
    'user_service_master' => get_current_user_id()
  ], ['%d', '%s', '%s', '%s', '%d']);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Erreur lors de l’enregistrement du score.', ['status' => 500]);
  }

  // 🔁 Supprimer anciens critères liés
  $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['score_id' => $score_id]);

  // 🔁 Insertion des critères utilisés (issus de templates existants ou nouveaux)
  if (!empty($data['criteres_personnalises']) && is_array($data['criteres_personnalises'])) {
    foreach ($data['criteres_personnalises'] as $index => $critere) {
      // 1. Insérer dans utm_master_score_templates si non existant
      $nom_template = sanitize_title($critere['nom_template'] ?? '');
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json = !empty($critere['config_json']) ? wp_json_encode($critere['config_json']) : null;

      // Vérifier existence
      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");

      // Valeur à insérer
      $ordre_affichage = $last_ordre + 1 + $index;

      if (!$template_id) {
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'ordre_affichage'  => $ordre_affichage,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);

        $template_id = $wpdb->insert_id;
      }

      // 2. Lier à utm_master_score_criteres
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }
  }

  // ✅ Success
  return rest_ensure_response(['success' => true, 'score_id' => $score_id]);
}
*/
// version 12/06/2025 v2
/*
function save_score_data($request) {
  global $wpdb;

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']); // M1 / M2

  $table_score = $wpdb->prefix . 'master_score';

  // 🔁 REPLACE ou INSERT score principal
  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'titre' => 'Score ' . $niveau,
    'formule' => $data['formule'] ?? '',
    'formule_json' => isset($data['formule_json']) ? wp_json_encode($data['formule_json']) : null,
    'date_creation' => current_time('mysql'),
    'user_service_master' => get_current_user_id()
  ]);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Erreur lors de la sauvegarde du score.', ['status' => 500]);
  }

  // 🔁 Nettoyage des anciens critères liés à ce score
  $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['score_id' => $score_id]);

  // 🆕 Insertion des critères personnalisés (avec lien vers template)
  if (!empty($data['criteres_personnalises']) && is_array($data['criteres_personnalises'])) {
    foreach ($data['criteres_personnalises'] as $index => $critere) {
      $nom_template = sanitize_title($critere['nom_template'] ?? '');
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json = !empty($critere['config_json']) ? wp_json_encode($critere['config_json']) : null;

      if (!$nom_template || !$titre_affiche) continue;

      // Récupérer ou insérer dans templates
      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $ordre_affichage = $last_ordre + 1 + $index;

        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'ordre_affichage'  => $ordre_affichage,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);

        $template_id = $wpdb->insert_id;
      }

      // Insertion dans score_criteres
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }
  }



     // 🔁 Insérer les critères standards s'ils sont présents dans le payload
      if (!empty($data['criteres']) && is_array($data['criteres'])) {
        foreach ($data['criteres'] as $index => $code) {
          $template_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
            sanitize_title($code)
          ));

          if (!$template_id) continue;

          $config = null;

          switch ($code) {
            case 'moyenne':
              $config = [
                'mention_levels' => $data['moyenne_levels'] ?? []
              ];
              break;

            case 'matieres':
              $config = [
                'matieres' => $data['matieres'] ?? []
              ];
              break;

            case 'bonus_mention':
              $config = [
                'conditions' => $data['bonus_mention'] ?? []
              ];
              break;

            case 'bonus_session':
              $config = [
                'conditions' => $data['bonus_session'] ?? []
              ];
              break;

            case 'malus':
              $config = [
                'conditions' => $data['malus'] ?? [],
                'exclu_cycle_preparatoire' => !empty($data['exclu_cycle_preparatoire'])
              ];
              break;

            case 'interruption':
              $config = [
                'conditions' => $data['interruption'] ?? []
              ];
              break;

            case 'pfe':
              if (!empty($data['pfe'])) {
                $config = [
                  'condition' => $data['pfe']['condition'] ?? '',
                  'valeur'    => $data['pfe']['valeur'] ?? ''
                ];
              }
              break;

            default:
              $config = null;
          }

          $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
            'score_id'    => $score_id,
            'template_id' => $template_id,
            'config_json' => $config ? wp_json_encode($config) : null,
            'ordre'       => 100 + $index
          ]);
        }
      }


  return rest_ensure_response([
    'success' => true,
    'score_id' => $score_id,
    'message' => 'Critères personnalisés enregistrés avec succès.'
  ]);
}
*/
function tokenize_formule($formule) {
  // Expression régulière : mots (avec accents/espaces), nombres, %, et opérateurs
  $pattern = '/(\d+%|\d+(?:\.\d+)?|[\p{L}\s]+|[()+\-*\/%])/u';

  preg_match_all($pattern, $formule, $matches);
  $tokens = array_map('trim', array_filter($matches[0], fn($t) => $t !== ''));

  return $tokens;
}


/*
function save_score_data($request) {
  global $wpdb;


  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']);

  $table_score = $wpdb->prefix . 'master_score';


   // ❌ Vérifie si la formule est validée par le service master
  $is_locked = $wpdb->get_var($wpdb->prepare(
    "SELECT validation_service_master FROM $table_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id, $niveau
  ));

  if ($is_locked == 1) {
    return new WP_Error('formule_locked', 'Cette formule est déjà validée par le Service Master et ne peut plus être modifiée.', ['status' => 403]);
  }


  $formule_json2 = $data['formule_json'];
  $formule_json3 = !empty($formule_json2) ? wp_json_encode($formule_json2, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '[]';

  // Insertion ou mise à jour du score principal
  $wpdb->replace($table_score, [
      'master_id' => $master_id,
      'niveau' => $niveau,
      'titre' => 'Score ' . $niveau,
      'formule' => $data['formule'] ?? '',
      'formule_json' => $formule_json3,
      'date_creation' => current_time('mysql'),
      'created_by' => get_current_user_id()
  ]);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));
  


  if (!$score_id) {
    return new WP_Error('save_error', 'Erreur lors de la sauvegarde du score.', ['status' => 500]);
  }

  // Suppression des anciens critères
  $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['score_id' => $score_id]);



   // 🔁 Insertion des critères standards à partir de `criteres_configs`
  if (!empty($data['criteres_configs']) && is_array($data['criteres_configs'])) {
    $indexStd = 0;
    foreach ($data['criteres_configs'] as $code => $config) {
      $nom_template = sanitize_title($code);

      
      if (!$nom_template || !is_array($config)) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) continue;



      // encodage json correct
      $config_json = wp_json_encode($config, JSON_UNESCAPED_UNICODE);

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => 100 + $indexStd++
      ]);
    }
  }

  // 🔁 Insertion des critères personnalisés
  if (!empty($data['criteres_personnalises']) && is_array($data['criteres_personnalises'])) {
    foreach ($data['criteres_personnalises'] as $index => $critere) {
      if (!isset($critere['nom_template']) || !is_string($critere['nom_template'])) continue;

      $nom_template  = sanitize_title($critere['nom_template']);
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type          = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json   = !empty($critere['config_json']) && is_array($critere['config_json'])
                        ? wp_json_encode($critere['config_json'], JSON_UNESCAPED_UNICODE)
                        : null;

      if (!$titre_affiche) continue;

      // Vérifie si ce critère personnalisé existe déjà
      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'ordre_affichage'  => $last_ordre + 1 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }




      // Lier à la table des critères actifs
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }
  }






  return rest_ensure_response([
    'success' => true,
    'score_id' => $score_id,
    'message' => 'Score et critères enregistrés avec succès.'
  ]);
}
*/

/*
function save_score_data($request) {

  global $wpdb;
  var_dump($request);

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']);
  $table_score = $wpdb->prefix . 'master_score';

  // ❌ Vérifie si la formule est validée par le service master
  $is_locked = $wpdb->get_var($wpdb->prepare(
    "SELECT validation_service_master FROM $table_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id, $niveau
  ));

  if ($is_locked == 1) {
    return new WP_Error('formule_locked', 'Cette formule est déjà validée par le Service Master et ne peut plus être modifiée.', ['status' => 403]);
  }

  $formule_json2 = $data['formule_json'];
  $formule_json3 = !empty($formule_json2) ? wp_json_encode($formule_json2, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '[]';

  // Insertion ou mise à jour du score principal
  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'titre' => 'Score ' . $niveau,
    'formule' => $data['formule'] ?? '',
    'formule_json' => $formule_json3,
    'date_creation' => current_time('mysql'),
    'created_by' => get_current_user_id()
  ]);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Erreur lors de la sauvegarde du score.', ['status' => 500]);
  }

  // Suppression des anciens critères
  $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['score_id' => $score_id]);

  // 🔁 Insertion des critères standards à partir de `criteres_configs`
  if (!empty($data['criteres_configs']) && is_array($data['criteres_configs'])) {
    $indexStd = 0;
    foreach ($data['criteres_configs'] as $code => $config) {
      $nom_template = sanitize_title($code);
      if (!$nom_template || !is_array($config)) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      // 🧩 Si template inexistant, l'ajouter automatiquement (utile pour pondération)
      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => ucfirst(str_replace('_', ' ', $nom_template)),
          'type'             => 'pondération',
          'config_json'      => wp_json_encode($config, JSON_UNESCAPED_UNICODE),
          'ordre_affichage'  => $last_ordre + 1 + $indexStd,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      // ✅ Enregistrement critère lié au score
      $config_json = wp_json_encode($config, JSON_UNESCAPED_UNICODE);
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => 100 + $indexStd++
      ]);
    }
  }

  // 🔁 Insertion des critères personnalisés
  if (!empty($data['criteres_personnalises']) && is_array($data['criteres_personnalises'])) {
    foreach ($data['criteres_personnalises'] as $index => $critere) {
      if (!isset($critere['nom_template']) || !is_string($critere['nom_template'])) continue;

      $nom_template  = sanitize_title($critere['nom_template']);
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type          = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json   = !empty($critere['config_json']) && is_array($critere['config_json'])
                        ? wp_json_encode($critere['config_json'], JSON_UNESCAPED_UNICODE)
                        : null;

      if (!$titre_affiche) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'ordre_affichage'  => $last_ordre + 1 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }
  }

  return rest_ensure_response([
    'success' => true,
    'score_id' => $score_id,
    'message' => 'Score et critères enregistrés avec succès.'
  ]);
}

*/

/*
function save_score_data($request) {

  global $wpdb;


  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']);
  $table_score = $wpdb->prefix . 'master_score';

  $is_locked = $wpdb->get_var($wpdb->prepare(
    "SELECT validation_service_master FROM $table_score WHERE master_id = %d AND niveau = %s LIMIT 1",
    $master_id, $niveau
  ));

  if ($is_locked == 1) {
    return new WP_Error('formule_locked', 'Cette formule est déjà validée par le Service Master et ne peut plus être modifiée.', ['status' => 403]);
  }

  $formule_json2 = $data['formule_json'];
  $formule_json3 = !empty($formule_json2) ? wp_json_encode($formule_json2, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '[]';

  $wpdb->replace($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau,
    'titre' => 'Score ' . $niveau,
    'formule' => $data['formule'] ?? '',
    'formule_json' => $formule_json3,
    'date_creation' => current_time('mysql'),
    'created_by' => get_current_user_id()
  ]);

  $score_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$score_id) {
    return new WP_Error('save_error', 'Erreur lors de la sauvegarde du score.', ['status' => 500]);
  }

  $wpdb->delete("{$wpdb->prefix}master_score_criteres", ['score_id' => $score_id]);

  if (!empty($data['criteres_configs']) && is_array($data['criteres_configs'])) {
    $indexStd = 0;
    foreach ($data['criteres_configs'] as $code => $config) {
      $nom_template = sanitize_title($code);
      if (!$nom_template || !is_array($config)) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) continue; // ✅ ne pas insérer s'il est standard

      $config_json = wp_json_encode($config, JSON_UNESCAPED_UNICODE);
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => 100 + $indexStd++
      ]);
    }
  }

  if (!empty($data['criteres_personnalises']) && is_array($data['criteres_personnalises'])) {
    foreach ($data['criteres_personnalises'] as $index => $critere) {
      if (!isset($critere['nom_template']) || !is_string($critere['nom_template'])) continue;

      $nom_template  = sanitize_title($critere['nom_template']);
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type          = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json   = !empty($critere['config_json']) && is_array($critere['config_json'])
                        ? wp_json_encode($critere['config_json'], JSON_UNESCAPED_UNICODE)
                        : null;


       $display  = sanitize_title($critere['display']);

      if (!$titre_affiche) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'display'          => $display,
          'ordre_affichage'  => $last_ordre + 1 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }
  }

  // ✅ Insertion des pondérations si fournies
  if (!empty($data['ponderations']) && is_array($data['ponderations'])) {
    foreach ($data['ponderations'] as $index => $pond) {
      $nom_template = sanitize_title($pond['nom'] ?? '');
      if (!$nom_template) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => sanitize_text_field($pond['nom']),
          'type'             => 'ponderation',
          'config_json'      => wp_json_encode($pond, JSON_UNESCAPED_UNICODE),
          'ordre_affichage'  => 300 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => wp_json_encode($pond, JSON_UNESCAPED_UNICODE),
        'ordre'       => 300 + $index
      ]);
    }
  }

  return rest_ensure_response([
    'success' => true,
    'score_id' => $score_id,
    'message' => 'Score et critères enregistrés avec succès.'
  ]);
}
*/

function save_score_data($request) {
  global $wpdb;

  $master_id = intval($request['master_id']);
  $data = $request->get_json_params();
  $niveau = sanitize_text_field($data['niveau']);
  $formule_base = $data['formule'] ?? '';
  $formule_json_base = $data['formule_json'] ?? [];
  $config_flags = $data['config_flags'] ?? [];
  $criteres_configs = $data['criteres_configs'] ?? [];
  $criteres_personnalises = $data['criteres_personnalises'] ?? [];
  $ponderations = $data['ponderations'] ?? [];

  $mentions = $data['levels'] ?? ['pardefaut'];
  $table_score = $wpdb->prefix . 'master_score';

  // ✅ Supprimer toutes les anciennes lignes du niveau (toutes mentions)
  $wpdb->delete($table_score, [
    'master_id' => $master_id,
    'niveau' => $niveau
  ]);

  foreach ($mentions as $mention) {
    $mention = sanitize_title($mention);
    $formule_json_mention = [];

    if (!empty($formule_json_base[$mention]) && is_array($formule_json_base[$mention])) {
      $formule_json_mention = $formule_json_base[$mention];
    } elseif (!empty($formule_json_base['pardéfaut']) && is_array($formule_json_base['pardéfaut'])) {
      $formule_json_mention = $formule_json_base['pardéfaut'];
    }

    if (empty($formule_json_mention)) continue;

    $formule_str = implode(' ', $formule_json_mention);
    $formule_json_encoded = wp_json_encode($formule_json_mention, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    // 🔒 Vérifier si verrouillé (normalement inutile après suppression, mais par sécurité)
    $is_locked = $wpdb->get_var($wpdb->prepare(
      "SELECT validation_service_master FROM $table_score WHERE master_id = %d AND niveau = %s AND diplome = %s",
      $master_id, $niveau, $mention
    ));
    if ($is_locked == 1) continue;

    $wpdb->insert($table_score, [
      'master_id' => $master_id,
      'niveau' => $niveau,
      'diplome' => $mention,
      'titre' => 'Score ' . strtoupper($niveau) . ' - ' . ucfirst($mention),
      'formule' => $formule_str,
      'formule_json' => $formule_json_encoded,
      'date_creation' => current_time('mysql'),
      'created_by' => get_current_user_id(),
    ]);

    $score_id = $wpdb->insert_id;
    if (!$score_id) continue;

    // ▶️ Critères standards
    $indexStd = 0;
    foreach ($criteres_configs as $code => $config) {
      $nom_template = sanitize_title($code);
      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));
      if (!$template_id) continue;

      $config_json = wp_json_encode($config, JSON_UNESCAPED_UNICODE);
      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => 100 + $indexStd++
      ]);
    }

    // ▶️ Critères personnalisés
    foreach ($criteres_personnalises as $index => $critere) {
      $nom_template = sanitize_title($critere['nom_template']);
      $titre_affiche = sanitize_text_field($critere['titre_affiche'] ?? '');
      $type = sanitize_text_field($critere['type'] ?? 'critere');
      $config_json = wp_json_encode($critere['config_json'] ?? [], JSON_UNESCAPED_UNICODE);
      $display = intval($critere['display'] ?? 0);

      if (!$titre_affiche) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $last_ordre = (int) $wpdb->get_var("SELECT MAX(ordre_affichage) FROM utm_master_score_templates");
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => $titre_affiche,
          'type'             => $type,
          'config_json'      => $config_json,
          'display'          => $display,
          'ordre_affichage'  => $last_ordre + 1 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => $config_json,
        'ordre'       => $index
      ]);
    }

    // ▶️ Pondérations
    foreach ($ponderations as $index => $pond) {
      $nom_template = sanitize_title($pond['nom'] ?? '');
      if (!$nom_template) continue;

      $template_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM utm_master_score_templates WHERE nom_template = %s LIMIT 1",
        $nom_template
      ));

      if (!$template_id) {
        $wpdb->insert('utm_master_score_templates', [
          'nom_template'     => $nom_template,
          'titre_affiche'    => sanitize_text_field($pond['nom']),
          'type'             => 'ponderation',
          'config_json'      => wp_json_encode($pond, JSON_UNESCAPED_UNICODE),
          'ordre_affichage'  => 300 + $index,
          'actif'            => 1,
          'created_by'       => get_current_user_id(),
          'created_at'       => current_time('mysql'),
          'institut_id'      => (int) get_user_meta(get_current_user_id(), 'institut_id', true)
        ]);
        $template_id = $wpdb->insert_id;
      }

      $wpdb->insert("{$wpdb->prefix}master_score_criteres", [
        'score_id'    => $score_id,
        'template_id' => $template_id,
        'config_json' => wp_json_encode($pond, JSON_UNESCAPED_UNICODE),
        'ordre'       => 300 + $index
      ]);
    }
  }

  return rest_ensure_response([
    'success' => true,
    'message' => 'Scores par mention enregistrés avec succès.'
  ]);
}






function gm_get_masters_with_formules_statut() {
    global $wpdb;
     $user_id = get_current_user_id();

    if (!$user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

     $institut_id = get_user_meta($user_id, 'institut_id', true);


    // Récupérer toutes les formules M1 et M2 dans un seul tableau
   $formules = $wpdb->get_results("
        SELECT 
            s.master_id,
            s.niveau,
            s.titre,
            s.formule,
            s.date_creation
        FROM utm_master_score s
    ", ARRAY_A);
  
   

    

    // Organiser les formules par master_id et niveau
    $formules_par_master = [];
    foreach ($formules as $f) {
        $mid = $f['master_id'];
        $niveau = strtolower($f['niveau']); // 'm1' ou 'm2'
        $formules_par_master[$mid][$niveau] = $f;
    }

    // Récupérer tous les masters avec leur statut
  
    $masters = $wpdb->get_results($wpdb->prepare("
        SELECT 
            f.id AS master_id,
            f.intitule_master,
            f.code_interne,
            f.parcours,
            f.annee_universitaire,
            f.formule_score AS formule_base,

            sm.statut_coordinateur,
            sm.date_statut_coordinateur,
            sm.user_statut_coordinateur,
            sm.statut_service_master,
            sm.date_statut_service_master,
            sm.user_statut_service_master,
            sm.etat_publication,
            sm.date_etat_publication,
            sm.user_etat_publication

        FROM utm_master_fichemaster f
        LEFT JOIN utm_statut_master sm ON sm.master_id = f.id
      WHERE f.institut_id = %d
    ", $institut_id), ARRAY_A);

    // Ajouter formules M1 et M2 si présentes
    foreach ($masters as &$master) {
        $id = $master['master_id'];
        $master['formule_m1'] = isset($formules_par_master[$id]['m1']) ? $formules_par_master[$id]['m1']['formule'] : null;
        $master['titre_m1']   = isset($formules_par_master[$id]['m1']) ? $formules_par_master[$id]['m1']['titre']   : null;

        $master['formule_m2'] = isset($formules_par_master[$id]['m2']) ? $formules_par_master[$id]['m2']['formule'] : null;
        $master['titre_m2']   = isset($formules_par_master[$id]['m2']) ? $formules_par_master[$id]['m2']['titre']   : null;
    }

    return $masters;
}
function valider_formule_score($request) {
  global $wpdb;

  // 🔐 Récupération des données JSON avec fallback
  $params = $request->get_json_params();
  if (!is_array($params)) {
    return new WP_Error('invalid_request', 'Requête JSON invalide.', ['status' => 400]);
  }

  // 🔎 Extraction avec sécurité
  $master_id = isset($params['master_id']) ? intval($params['master_id']) : 0;
  $niveau = isset($params['niveau']) ? sanitize_text_field($params['niveau']) : '';
  $user_id = get_current_user_id();
  

  if (!$master_id || !$niveau || !$user_id) {
    return new WP_Error('invalid_data', 'Données manquantes ou invalides', ['status' => 400]);
  }

  // 🔹 Vérifie si la formule existe
  $exists = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM utm_master_score WHERE master_id = %d AND niveau = %s",
    $master_id, $niveau
  ));

  if (!$exists) {
    return new WP_Error('not_found', 'Aucune formule trouvée pour ce master/niveau.', ['status' => 404]);
  }

  // 🔹 Mise à jour des champs de validation
  $updated = $wpdb->update(
    'utm_master_score',
    [
      'validation_service_master' => 'validé',
      'date_validation' => current_time('mysql'),
      'user_service_master' => $user_id
    ],
    [
      'master_id' => $master_id,
      'niveau' => $niveau
    ],
    [ // formats pour les SET
      '%s', // validation_service_master
      '%s', // date_validation
      '%d'  // user_service_master
    ],
    [ // formats pour les WHERE
      '%d',
      '%s'
    ]
  );

  if ($updated === false) {
    return new WP_Error('db_error', 'Erreur lors de la mise à jour de la formule.', ['status' => 500]);
  }
  

  return [
    'success' => true,
    'updated_rows' => $updated
  ];
}

/*
function creer_appel_candidature($request) {
  global $wpdb;

  $titre = sanitize_text_field($request->get_param('titre'));
  $description = wp_kses_post($request->get_param('description'));
  $date_creation = sanitize_text_field($request->get_param('date_creation'));
  $user_id = get_current_user_id();


  $sessions = json_decode(stripslashes($request->get_param('sessions')), true);
  $master_ids = json_decode(stripslashes($request->get_param('master_ids')), true);

  // 📁 Upload fichier
  $fichier_joint = null;
  if (!empty($_FILES['fichier_joint']) && !empty($_FILES['fichier_joint']['tmp_name'])) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    $upload = wp_handle_upload($_FILES['fichier_joint'], ['test_form' => false]);
    if (!isset($upload['error'])) {
      $fichier_joint = esc_url_raw($upload['url']);
    }
  }

  // 📌 Insertion dans utm_master_appels_candidature
  $wpdb->insert("{$wpdb->prefix}master_appels_candidature", [
    'titre' => $titre,
    'description' => $description,
    'fichier_joint' => $fichier_joint,
    'date_creation' => $date_creation,
    'user_id' => $user_id
  ]);

  $appel_id = $wpdb->insert_id;

  // 📌 Insertion des sessions
  if ($appel_id && is_array($sessions)) {
    foreach ($sessions as $session) {
      $wpdb->insert("{$wpdb->prefix}master_appels_sessions", [
        'appel_id' => $appel_id,
        'nom_session' => sanitize_text_field($session['nom_session']),
        'date_debut' => sanitize_text_field($session['date_debut']),
        'date_fin' => sanitize_text_field($session['date_fin'])
      ]);
    }
  }

  // 📌 Liaison avec les masters (si une table pivot existe)
  // Sinon, à vous d’en créer une : ex. `utm_master_appels_masters(appel_id, master_ref)`
  if ($appel_id && is_array($master_ids)) {
      foreach ($master_ids as $mid) {
        $wpdb->insert("{$wpdb->prefix}master_appels_masters", [
          'appel_id' => $appel_id,
          'master_id' => sanitize_text_field($mid)
        ]);
      }
    }


  return [
    'success' => true,
    'message' => 'Appel à candidature créé',
    'appel_id' => $appel_id
  ];
}
*/

function creer_appel_candidature($request) {
  global $wpdb;

  $titre = sanitize_text_field($request->get_param('titre'));
  $description = wp_kses_post($request->get_param('description'));
  $date_creation = sanitize_text_field($request->get_param('date_creation'));
  $user_id = get_current_user_id();

  $sessions = json_decode(stripslashes($request->get_param('sessions')), true);
  $master_ids = json_decode(stripslashes($request->get_param('master_ids')), true);

  $table_appels = "{$wpdb->prefix}master_appels_candidature";
  $table_sessions = "{$wpdb->prefix}master_appels_sessions";
  $table_liaison = "{$wpdb->prefix}master_appels_masters";
  $table_statuts = "{$wpdb->prefix}statut_master";

  // 🔒 Vérifier doublon exact
  $existing_appels = $wpdb->get_results($wpdb->prepare(
    "SELECT id FROM $table_appels WHERE titre = %s AND description = %s",
    $titre, $description
  ));

  foreach ($existing_appels as $existing) {
    $existing_id = $existing->id;

    // Récupérer sessions liées à cet appel
    $db_sessions = $wpdb->get_results($wpdb->prepare(
      "SELECT nom_session, date_debut, date_fin FROM $table_sessions WHERE appel_id = %d",
      $existing_id
    ), ARRAY_A);

    // Récupérer masters liés
    $db_masters = $wpdb->get_col($wpdb->prepare(
      "SELECT master_id FROM $table_liaison WHERE appel_id = %d",
      $existing_id
    ));

    // Comparaison des sessions
    $sessions_match = count($db_sessions) === count($sessions);
    if ($sessions_match) {
      foreach ($sessions as $s) {
        $found = false;
        foreach ($db_sessions as $db_s) {
          if (
            $db_s['nom_session'] === $s['nom_session'] &&
            $db_s['date_debut'] === $s['date_debut'] &&
            $db_s['date_fin'] === $s['date_fin']
          ) {
            $found = true;
            break;
          }
        }
        if (!$found) {
          $sessions_match = false;
          break;
        }
      }
    }

    // Comparaison des masters
    $submitted_masters = array_map('sanitize_text_field', $master_ids);
    sort($submitted_masters);
    sort($db_masters);
    $masters_match = $submitted_masters === $db_masters;

    if ($sessions_match && $masters_match) {
      return [
        'success' => false,
        'message' => '⚠️ Un appel identique existe déjà (titre, description, sessions, masters).'
      ];
    }
  }

  // 📁 Upload fichier
  $fichier_joint = null;
  if (!empty($_FILES['fichier_joint']) && !empty($_FILES['fichier_joint']['tmp_name'])) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    $upload = wp_handle_upload($_FILES['fichier_joint'], ['test_form' => false]);
    if (!isset($upload['error'])) {
      $fichier_joint = esc_url_raw($upload['url']);
    }
  }

  // 📌 Insertion dans appels
  $wpdb->insert($table_appels, [
    'titre' => $titre,
    'description' => $description,
    'fichier_joint' => $fichier_joint,
    'date_creation' => $date_creation,
    'user_id' => $user_id
  ]);

  $appel_id = $wpdb->insert_id;

  // 📌 Insertion des sessions
  if ($appel_id && is_array($sessions)) {
    foreach ($sessions as $session) {
      $wpdb->insert($table_sessions, [
        'appel_id' => $appel_id,
        'nom_session' => sanitize_text_field($session['nom_session']),
        'date_debut' => sanitize_text_field($session['date_debut']),
        'date_fin' => sanitize_text_field($session['date_fin'])
      ]);
    }
  }

  // 📌 Liaison avec les masters + Mise à jour statut
  if ($appel_id && is_array($master_ids)) {
    foreach ($master_ids as $mid) {
      $mid = intval($mid);

      // Liaison appel/master
      $wpdb->insert($table_liaison, [
        'appel_id' => $appel_id,
        'master_id' => $mid
      ]);

      // Mise à jour statut master si existe
      $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_statuts WHERE master_id = %d",
        $mid
      ));
      if ($exists) {
        $wpdb->update(
          $table_statuts,
          [
            'statut_service_master' => 'validé',
            'date_statut_service_master' => current_time('mysql'),
            'user_statut_service_master' => $user_id
          ],
          ['master_id' => $mid],
          ['%s', '%s', '%d'],
          ['%d']
        );
      }
    }
  }

  return [
    'success' => true,
    'message' => '✅ Appel à candidature créé',
    'appel_id' => $appel_id
  ];
}


function get_appels_candidature() {
  global $wpdb;

  $user_id = get_current_user_id();
  $institut_id = get_user_meta($user_id, 'institut_id', true); // ID de l'institut lié à l'utilisateur
    $cu=wp_get_current_user();
    $roles = $cu->roles;

  $table_appels    = "{$wpdb->prefix}master_appels_candidature";
  $table_sessions  = "{$wpdb->prefix}master_appels_sessions";
  $table_masters   = "{$wpdb->prefix}master_appels_masters";
  $table_fichemaster = "{$wpdb->prefix}master_fichemaster";

  // $appels = $wpdb->get_results($wpdb->prepare("
  //   SELECT 
  //     a.id,
  //     a.titre,
  //     a.date_creation,
  //     MAX(s.date_fin) AS date_cloture,
  //     COUNT(DISTINCT m.master_id) AS masters_lies,
  //     CASE 
  //       WHEN MAX(s.date_fin) IS NULL THEN 'En Cours'
  //       WHEN MAX(s.date_fin) >= NOW() THEN 'En Cours'
  //       ELSE 'Clôturé'
  //     END AS statut
  //   FROM $table_appels a
  //   LEFT JOIN $table_sessions s ON s.appel_id = a.id
  //   LEFT JOIN $table_masters m ON m.appel_id = a.id
  //   LEFT JOIN $table_fichemaster f ON f.id = m.master_id
  //   WHERE f.institut_id = %d
  //   GROUP BY a.id, a.titre, a.date_creation
  //   ORDER BY a.date_creation DESC
  // ", $institut_id));

   $appels= "
      SELECT 
      a.id,
      a.titre,
      a.date_creation,
      MAX(s.date_fin) AS date_cloture,
      COUNT(DISTINCT m.master_id) AS masters_lies,
      CASE 
      WHEN MAX(s.date_fin) IS NULL THEN 'En Cours'
      WHEN MAX(s.date_fin) >= NOW() THEN 'En Cours'
      ELSE 'Clôturé'
      END AS statut
      FROM $table_appels a
      LEFT JOIN $table_sessions s ON s.appel_id = a.id
      LEFT JOIN $table_masters m ON m.appel_id = a.id
      LEFT JOIN $table_fichemaster f ON f.id = m.master_id
      
    ";
    // $masters = $wpdb->get_results($wpdb->prepare(, $institut_id), ARRAY_A);
    if (in_array('um_service-utm', $roles)) {
        $where_clause = ""; // Aucun filtre
        $prepared_sql = $appels;
        $masters = $wpdb->get_results($prepared_sql, ARRAY_A);

    } 
    elseif (in_array('um_service-master', $roles)) {
        $where_clause = " WHERE f.institut_id = %d GROUP BY a.id, a.titre, a.date_creation  ORDER BY a.date_creation DESC";
        $prepared_sql = $appels . $where_clause;
        $masters = $wpdb->get_results($wpdb->prepare($prepared_sql, $institut_id), ARRAY_A);
    }



  return rest_ensure_response([
    'success' => true,
    'data' =>  $masters
  ]);
}


function pm_get_score_templates() {
    global $wpdb;
    $results = $wpdb->get_results("
        SELECT id, nom_template, titre_affiche, type, config_json, ordre_affichage , display
        FROM utm_master_score_templates
        WHERE actif = 1
        ORDER BY ordre_affichage ASC
    ", ARRAY_A);

    return rest_ensure_response($results);
}


