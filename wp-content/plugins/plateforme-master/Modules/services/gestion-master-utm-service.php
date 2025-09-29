<?php
function gm_get_masters_all() {
    global $wpdb;

    $masters = $wpdb->get_results("
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
        LEFT JOIN {$wpdb->prefix}master_session_universitaire s2 ON f.fin_annee_habilitation = s2.id
    ", ARRAY_A);

    foreach ($masters as &$master) {
        // Coordinateur
        $coordinateur = $wpdb->get_row($wpdb->prepare("
            SELECT coordinateur_id FROM {$wpdb->prefix}master_coordinateurs
            WHERE master_id = %d ORDER BY date_affectation DESC LIMIT 1
        ", $master['id']), ARRAY_A);

        if ($coordinateur && isset($coordinateur['coordinateur_id'])) {
            $user = get_userdata($coordinateur['coordinateur_id']);
            if ($user) {
                $master['coordinateur'] = [
                    'id'            => $user->ID,
                    'display_name'  => $user->display_name,
                    'email'         => $user->user_email,
                    'avatar'        => get_avatar_url($user->ID),
                    'grade'         => get_user_meta($user->ID, 'grade', true),
                    'specialite'    => get_user_meta($user->ID, 'specialite', true),
                    'tel'           => get_user_meta($user->ID, 'telephone', true),
                ];
            }
        } else {
            $master['coordinateur'] = null;
        }

        // Objectifs
        $master['objectifs_generaux'] = $wpdb->get_col($wpdb->prepare("
            SELECT contenu FROM {$wpdb->prefix}master_objectifs
            WHERE master_id = %d AND type = 'general'
        ", $master['id']));

        $master['objectifs_specifiques'] = $wpdb->get_col($wpdb->prepare("
            SELECT contenu FROM {$wpdb->prefix}master_objectifs
            WHERE master_id = %d AND type = 'specifique'
        ", $master['id']));

        // Conditions d’admission
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

        // Statut coordinateur
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

        // Scores
        $scores = $wpdb->get_results($wpdb->prepare("
            SELECT niveau, formule 
            FROM {$wpdb->prefix}master_score
            WHERE master_id = %d
        ", $master['id']), ARRAY_A);

        $master['formule_score_M1'] = null;
        $master['formule_score_M2'] = null;

        foreach ($scores as $row) {
            if (strtoupper($row['niveau']) === 'M1') {
                $master['formule_score_M1'] = $row['formule'];
            } elseif (strtoupper($row['niveau']) === 'M2') {
                $master['formule_score_M2'] = $row['formule'];
            }
        }
    }

    return $masters;
}

?>