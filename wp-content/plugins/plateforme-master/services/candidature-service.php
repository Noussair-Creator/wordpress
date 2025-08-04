<?php
function gm_get_candidats_by_userOld() {
    wp_get_current_user(); // Assure l'utilisateur courant
    $user_id = get_current_user_id();




    if (!$user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

    global $wpdb;

    

    // 🔍 Récupérer le candidat_id depuis la table usermeta
    $candidat_id = get_user_meta($user_id, 'candidat_id', true);



    if (!$candidat_id) {
        return new WP_Error('no_candidat', 'Aucun candidat lié à cet utilisateur', ['status' => 404]);
    }

    
    // 🔍 Récupérer les infos du candidat et ses candidatures
    $result = $wpdb->get_row($wpdb->prepare("
    SELECT 
        c.id AS candidat_id,
        c.nom,
        c.nom_ar,
        c.prenom,
        c.prenom_ar,
        c.date_naissance,
        c.lieu_naissance,
        c.lieu_naissance_ar,
        c.nationalite,
        c.nationalite_ar,
        n.intitule AS nationalite_fr_label,
        n.intitule_ar AS nationalite_ar_label,
        c.cin,
        c.passport,
        c.IdentifiantUnique,
        c.email1,
        c.email2,
        c.telephone,
        c.sexe,
        c.statut_etudiant,
        c.photo_path,
        c.created_at AS candidat_created_at,
        a.type_adresse,
        a.adresse_fr,
        a.adresse_ar,
        a.gouvernorat_fr,
        a.gouvernorat_ar,
        a.delegation_fr,
        a.delegation_ar,
        a.code_postal,
        a.created_at AS adresse_created_at

    FROM {$wpdb->prefix}master_candidats c
    LEFT JOIN {$wpdb->prefix}master_candidats_adresses a ON c.id = a.candidat_id
    LEFT JOIN {$wpdb->prefix}master_nationalites n ON c.nationalite = n.id
    WHERE c.id = %d
    ", $candidat_id), ARRAY_A);





    if (!$result) {
        return new WP_Error('not_found', 'Candidat introuvable', ['status' => 404]);
    }




    // Préparer la requête sans exécution immédiate
    $sql = $wpdb->prepare("
        SELECT 
            cand.id AS candidature_id,
            cand.master_id,
            cand.date_soumission,
            cand.etat,
            f.intitule_master,
            f.code_interne,
            f.annee_universitaire,
            f.institut_id


        FROM {$wpdb->prefix}master_candidatures cand

            INNER JOIN {$wpdb->prefix}master_fichemaster f ON cand.master_id = f.id

            WHERE cand.candidat_id = %d
            ORDER BY cand.date_soumission DESC
            Limit 1
        ", $candidat_id);


      


    // 🔁 Exécution
    $candidatures = $wpdb->get_results($sql, ARRAY_A);

    // Regroupement de l'adresse
        $result['adresse'] = [
            'adresse'         => $result['adresse'],
            'adresse_ar'      => $result['adresse_ar'],
            'gouvernorat'     => $result['gouvernorat'],
            'gouvernorat_ar'  => $result['gouvernorat_ar'],
            'delegation'      => $result['delegation'],
            'delegation_ar'   => $result['delegation_ar'],
            'code_postal'     => $result['code_postal'],
        ];

        // Regroupement des candidatures (enrichies)
        $result['candidatures'] = [];
        $i=0;
        foreach ($candidatures as $cand) {
            $id = $cand['candidature_id'];

            

            // Organisation des données liées
            $result['candidatures'][$i]['infos'] = [
                'candidature_id'      => $cand['candidature_id'],
                'master_id'           => $cand['master_id'],
                'date_soumission'     => $cand['date_soumission'],
                'etat'                => $cand['etat'],
                'intitule_master'     => $cand['intitule_master'],
                'code_interne'        => $cand['code_interne'],
                'annee_universitaire' => $cand['annee_universitaire'],
                'institut_id'         => $cand['institut_id'],
            ];

            // Situation académique
            if (!empty($cand['diplome_obtenu']) || !empty($cand['etablissement']) || !empty($cand['dernier_niveau'])) {
                $result['candidatures'][$id]['situation_academique'] = [
                    'diplome_obtenu'  => $cand['diplome_obtenu'],
                    'etablissement'   => $cand['etablissement'],
                    'dernier_niveau'  => $cand['dernier_niveau'],
                ];
            }

            // Années de parcours
            if (!empty($cand['annee_parcours'])) {
                $result['candidatures'][$id]['parcours'][] = [
                    'annee_universitaire' => $cand['annee_parcours'],
                    'cycle'               => $cand['cycle'],
                    'mention'             => $cand['mention'],
                    'credit'              => $cand['credit'],
                    'moyenne'             => $cand['moyenne'],
                ];
            }

            // Années blanches
            if (!empty($cand['annee_blanche_ref'])) {
                $result['candidatures'][$id]['annees_blanches'][] = [
                    'annee_ref' => $cand['annee_blanche_ref'],
                    'motif'     => $cand['motif_annee_blanche'],
                ];
            }

            // Critères de score
            if (!empty($cand['critere_id'])) {
                $result['candidatures'][$id]['criteres'][] = [
                    'critere_id' => $cand['critere_id'],
                    'champ'      => $cand['champ'],
                    'valeur'     => $cand['valeur'],
                    'created_at' => $cand['score_created_at'],
                ];
            }
        }
  

    return $result;
}
function gm_get_candidats_by_user() {
    wp_get_current_user();
    $user_id = get_current_user_id();

    if (!$user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

    global $wpdb;

    $candidat_id = get_user_meta($user_id, 'candidat_id', true);
    if (!$candidat_id) {
        return new WP_Error('no_candidat', 'Aucun candidat lié à cet utilisateur', ['status' => 404]);
    }

    // 📌 Récupération des informations du candidat
    $result = $wpdb->get_row($wpdb->prepare("
        SELECT 
            c.id AS candidat_id,
            c.nom, c.nom_ar, c.prenom, c.prenom_ar,
            c.date_naissance, c.lieu_naissance, c.lieu_naissance_ar,
            c.nationalite, c.nationalite_ar,
            n.intitule AS nationalite_fr_label, n.intitule_ar AS nationalite_ar_label,
            c.cin, c.passport, c.IdentifiantUnique,
            c.email1, c.email2, c.telephone,
            c.sexe, c.statut_etudiant,
            c.photo_path, c.created_at AS candidat_created_at,
            a.type_adresse, a.adresse_fr, a.adresse_ar,
            a.gouvernorat_fr, a.gouvernorat_ar,
            a.delegation_fr, a.delegation_ar,
            a.code_postal, a.created_at AS adresse_created_at
        FROM {$wpdb->prefix}master_candidats c
        LEFT JOIN {$wpdb->prefix}master_candidats_adresses a ON c.id = a.candidat_id
        LEFT JOIN {$wpdb->prefix}master_nationalites n ON c.nationalite = n.id
        WHERE c.id = %d
    ", $candidat_id), ARRAY_A);

    if (!$result) {
        return new WP_Error('not_found', 'Candidat introuvable', ['status' => 404]);
    }

    // 📌 Adresse regroupée
    $result['adresse'] = [
        'adresse'         => $result['adresse_fr'],
        'adresse_ar'      => $result['adresse_ar'],
        'gouvernorat'     => $result['gouvernorat_fr'],
        'gouvernorat_ar'  => $result['gouvernorat_ar'],
        'delegation'      => $result['delegation_fr'],
        'delegation_ar'   => $result['delegation_ar'],
        'code_postal'     => $result['code_postal'],
    ];

    // 📌 Candidature la plus récente
   $candidatures = $wpdb->get_results($wpdb->prepare("
    SELECT 
        cand.id AS candidature_id,
        cand.master_id,
        f.intitule_master,
        cand.date_soumission,
        cand.etat,
        f.code_interne,
        f.annee_universitaire,
        f.institut_id,
        i.nom AS institut_nom
    FROM {$wpdb->prefix}master_candidatures cand
    INNER JOIN {$wpdb->prefix}master_fichemaster f ON cand.master_id = f.id
    INNER JOIN {$wpdb->prefix}master_instituts i ON f.institut_id = i.id
    WHERE cand.candidat_id = %d
    ORDER BY cand.date_soumission DESC
   
", $candidat_id), ARRAY_A);



    $result['candidatures'] = [];

    foreach ($candidatures as $i => $cand) {
        $candidature_id = $cand['candidature_id'];

        // Infos de base
        $result['candidatures'][$i]['infos'] = $cand;

        // Situation académique
        $sit = $wpdb->get_row($wpdb->prepare("
            SELECT * FROM {$wpdb->prefix}candidats_situation_academique
            WHERE candidat_id = %d 
        ", $candidat_id), ARRAY_A);

        if ($sit) {
            $result['candidatures'][$i]['situation_academique'] = $sit;
        }

        // Parcours académiques
        $parcours = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM {$wpdb->prefix}candidats_parcours_annees
            WHERE candidat_id = %d
            ORDER BY niveau ASC
        ", $candidat_id), ARRAY_A);

        if ($parcours) {
            $result['candidatures'][$i]['parcours'] = $parcours;
        }

        // Années blanches
        $blanches = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM {$wpdb->prefix}candidats_annees_blanches
            WHERE candidat_id = %d
        ", $candidat_id), ARRAY_A);

        if ($blanches) {
            $result['candidatures'][$i]['annees_blanches'] = $blanches;
        }

        // Critères de score
        $criteres = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM {$wpdb->prefix}candidats_score_values
            WHERE candidature_id = %d
        ", $candidature_id), ARRAY_A);

        if ($criteres) {
            $result['candidatures'][$i]['criteres'] = $criteres;
        }
    }
    return $result;
}



