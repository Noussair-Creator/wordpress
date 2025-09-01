<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';

if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}

global $wpdb;

// Liste des slugs => noms de fichiers associés (référence seulement)
$directeurth_pages = [
    'mes-doctorants_directeurth'             => 'MesDoctorants.php',
    'fiche-individuelle-du-doctorant_directeurth' => 'FicheIndividuelleDoctorant.php',
    'planning-des-r-eunions_directeurth'     => 'PlanningReunions.php',
    'fiche-candidatures-ed_directeurth'      => 'FicheCandidaturesED.php',
    'evaluations-et-rapports_directeurth'    => 'EvaluationsRapports.php',
    'fiche-d-evaluation-annuelle_directeurth'=> 'FicheEvaluationAnnuelle.php',
    'suivi-des-d-ep-ots_directeurth'         => 'SuiviDepots.php',
    'fiche-de-d-ep-ot_directeurth'           => 'FicheDepot.php',
    'progression_directeurth'                => 'Progression.php',
    'planification-des-soutenances_directeurth' => 'PlanificationSoutenances.php',
    'publications-et-communications_directeurth'=> 'PublicationsCommunications.php',
];

// Parcours et création des pages
foreach ($directeurth_pages as $slug => $php_filename) {
    $title = ucwords(str_replace("-", " ", $slug));

    // Vérifier si la page existe déjà
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if ($exists) {
        echo "⏩ Page '$slug' déjà existante (ID: $exists).\n";
    } else {
        // Créer la page dans la BDD
        $wpdb->insert("{$wpdb->prefix}posts", [
            'post_author'    => 1,
            'post_date'      => current_time('mysql'),
            'post_date_gmt'  => current_time('mysql', 1),
            'post_content'   => '',
            'post_title'     => $title,
            'post_status'    => 'publish',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_name'      => $slug,
            'post_type'      => 'page'
        ]);

        $post_id = $wpdb->insert_id;

        // Ajouter les métadonnées
        add_post_meta($post_id, '_wp_page_template', 'um_directeur_these');
        add_post_meta($post_id, 'um_content_restriction', serialize([
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ]));

        echo "✅ Page '$slug' créée (ID: $post_id).\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé (Directeur Thèse).\n";
