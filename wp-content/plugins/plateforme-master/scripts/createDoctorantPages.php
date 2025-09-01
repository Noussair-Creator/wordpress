<?php

// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';

if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}

global $wpdb;

$pages = [
    'taches',
    'suivi-de-la-these-rapport-de-progression',
    'suivi-de-la-these-rapport-de-progression-depot',
    'suivi-de-la-these-rapport-de-progression-encadrants',
    'suivi-de-la-these-etat-de-these',
    'mes-publications',
    'mes-publications-stages-et-missions',
    'mes-publications-stages-et-missions-demande-de-stage',
    'mes-publications-bourse-dalternance-mobilite',
    'mes-publications-bourse-dalternance-mobilite-1',
    'manifestation-scientifiques',
    'manifestation-scientifiques-mes-participations',
    'manifestation-scientifiques-mes-participations-declarer-une-participation',
    'inscription-en-these',
    'doctorant',
    'demande-adm',
    'demande-adm-financement',
    'demande-adm-demande-de-reinscription',
    'demande-adm-changement-dencadrant',
    'appel-a-projets',
    'appel-a-projets-postuler'
];

// Répertoire des fichiers à générer
$base_dir = "/home/utmresearchplatform/public_html/wp-content/plugins/plateforme-master/Modules/ED/pages/pagesDoctorant/";

if (!is_dir($base_dir)) {
    exit("❌ Dossier cible introuvable : $base_dir\n");
}

foreach ($pages as $slug) {
    $title = ucwords(str_replace("-", " ", $slug));

    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if ($exists) {
        echo "⏩ Page '$slug' déjà existante (ID: $exists).\n";
    } else {
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

        add_post_meta($post_id, '_wp_page_template', 'espace');
        add_post_meta($post_id, 'um_content_restriction', serialize([
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ]));

        echo "✅ Page '$slug' créée (ID: $post_id).\n";
    }

    $filepath = $base_dir . $slug . ".php";

    if (!file_exists($filepath)) {
        $php_content = "<?php\n// Page $slug\nget_header();\necho '<h1>$title</h1>';\nget_footer();\n";
        file_put_contents($filepath, $php_content);
        echo "📄 Fichier '$slug.php' généré dans $base_dir.\n";
    } else {
        echo "📁 Fichier '$slug.php' déjà existant.\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé.\n";
