<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';
if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable.\n");
}

global $wpdb;

// Liste des pages (slug => fichier PHP)
$chercheur_pages = [
    'programmes-projects-de-recherches' => 'ProgrammesProjectsDeRecherches.php',
    'activites-scientifiques' => 'ActivitesScientifiques.php',
    'reseaux-de-la-recherche' => 'ReseauxDeLaRecherche.php',
    'activites-quotidiennes' => 'ActivitesQuotidiennes.php',
    'etat-davancement-des-projets' => 'EtatDavancementDesProjets.php',
    'financement' => 'Financement.php',
    'actualites-de-lutm' => 'ActualitesDeLutm.php',
    'membres-de-laboratoire' => 'MembresDeLaboratoire.php',
    'comment-proteger-ma-recherche' => 'CommentProtegerMaRecherche.php',
    'details-programmes-projets-de-recherches' => 'DetailsProgrammesProjetsDeRecherches.php',
    'reseaux-de-la-recherche-fiche-partenaire' => 'ReseauxDeLaRechercheFichePartenaire.php',
    'financement-fiche-de-financement' => 'FinancementFicheDeFinancement.php',
    'membres-de-laboratoire-fiche-dun-membre' => 'MembresDeLaboratoireFicheDunMembre.php',
    'fiche-details-du-laboratoire-lsama' => 'FicheDetailsDuLaboratoireLsama.php',
    'etat-davancement-des-projets-fiche-projet' => 'EtatDavancementDesProjetsFicheProjet.php',
];

foreach ($chercheur_pages as $slug => $php_filename) {
    $title = ucwords(str_replace("-", " ", $slug));

    // Vérifier si la page existe
    $post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if (!$post_id) {
        // Création de la page
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
        echo "✅ Page '$slug' créée (ID: $post_id).\n";
    } else {
        echo "⏩ Page '$slug' déjà existante (ID: $post_id).\n";
    }

    // Vérifier et ajouter les métadonnées si elles n'existent pas
    $template_meta_exists = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_id FROM {$wpdb->prefix}postmeta WHERE post_id = %d AND meta_key = '_wp_page_template'",
        $post_id
    ));
    if (!$template_meta_exists) {
        add_post_meta($post_id, '_wp_page_template', 'espace');
        echo "🆕 Meta '_wp_page_template' ajoutée.\n";
    }

    $restriction_meta_exists = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_id FROM {$wpdb->prefix}postmeta WHERE post_id = %d AND meta_key = 'um_content_restriction'",
        $post_id
    ));
    if (!$restriction_meta_exists) {
        add_post_meta($post_id, 'um_content_restriction', serialize([
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ]));
        echo "🆕 Meta 'um_content_restriction' ajoutée.\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé.\n";
