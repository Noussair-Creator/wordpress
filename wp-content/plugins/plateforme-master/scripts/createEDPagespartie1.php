<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';
if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable.\n");
}

global $wpdb;

// Liste des pages (slug => titre)
$DL_pages = [
    'soutenances-ecole-doctorale'          => 'Soutenances École Doctorale',
    'commission-doctorale-ecole-doctorale' => 'Commission Doctorale École Doctorale',
    'contacts-ecole-doctorale'             => 'Contacts École Doctorale',
    'inscription-reinscription-ecole-doctorale' => 'Inscription / Réinscription École Doctorale',
    'dossier-inscription-ecole-doctorale'  => 'Dossier Inscription École Doctorale',
];

foreach ($DL_pages as $slug => $title) {

    // Vérifier si la page existe déjà
    $post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if (!$post_id) {
        // Créer la page via API WP
        $post_id = wp_insert_post([
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

        if ($post_id && !is_wp_error($post_id)) {
            echo "✅ Page '$slug' créée (ID: $post_id).\n";
        } else {
            echo "❌ Erreur lors de la création de la page '$slug'.\n";
            continue;
        }
    } else {
        echo "ℹ️ Page '$slug' déjà existante (ID: $post_id).\n";
    }

    // Vérifier et ajouter les métadonnées si elles n'existent pas
    if (!get_post_meta($post_id, '_wp_page_template', true)) {
        add_post_meta($post_id, '_wp_page_template', 'espace');
        echo "➕ Meta '_wp_page_template' ajoutée.\n";
    }

    if (!get_post_meta($post_id, 'um_content_restriction', true)) {
        $restriction = [
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ];
        add_post_meta($post_id, 'um_content_restriction', maybe_serialize($restriction));
        echo "➕ Meta 'um_content_restriction' ajoutée.\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé.\n";
