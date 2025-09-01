<?php

// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';

if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}

global $wpdb;

// Liste des slugs => noms de fichiers associés (pour référence uniquement ici)
$chercheur_pages = [
    'programmes-projects-de-recherches'        => 'ProgrammesProjectsDeRecherches.php',
    'activites-scientifiques'                  => 'ActivitesScientifiques.php',
    'reseaux-de-la-recherche'                  => 'ReseauxDeLaRecherche.php',
    'activites-quotidiennes'                   => 'ActivitesQuotidiennes.php',
    'etat-davancement-des-projets'             => 'EtatDavancementDesProjets.php',
    'financement'                              => 'Financement.php',
    'membres-de-laboratoire'                   => 'Financement.php', // doublon ?
    'actualites-de-lutm'                       => 'ActualitesDeLUTM.php',
    'membres-de-laboratoire-2'                 => 'MembresDeLaboratoire2.php',
    'comment-proteger-ma-recherche'            => 'CommentProtegerMaRecherche.php',
    'details-programmes-projets-de-recherches' => 'DetailsProgrammesProjetsDeRecherches.php',
    'reseaux-de-la-recherche-fiche-partenaire' => 'ReseauxDeLaRechercheFichePartenaire.php',
    'financement-fiche-de-financement'         => 'FinancementFicheDeFinancement.php',
];

foreach ($chercheur_pages as $slug => $php_filename) {
    $title = ucwords(str_replace("-", " ", $slug));

    // Vérifier si la page existe déjà
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if ($exists) {
        echo "⏩ Page '$slug' déjà existante (ID: $exists).\n";
    } else {
        // Créer la page dans utm_posts
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
        add_post_meta($post_id, '_wp_page_template', 'espace');
        add_post_meta($post_id, 'um_content_restriction', serialize([
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ]));

        echo "✅ Page '$slug' créée (ID: $post_id).\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé sans création de fichiers PHP.\n";
