<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';

if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}

global $wpdb;

// Slugs => Titres professionnels (student master)
$student_master_pages = [
    'examens'                   => 'Examens',
    'absences'                  => 'Absences',
    'emplois'                   => 'Emplois du Temps',
    'stages'                    => 'Stages',
    'profile'                   => 'Mon Profil',
    'messages'                  => 'Messages',
    'details-master'            => 'Détails Master',
    'bibliotheque'              => 'Bibliothèque',
    'support-pedagogiques'      => 'Supports Pédagogiques',
    'soutenance'                => 'Soutenance',
    'formulaires-administratifs'=> 'Formulaires Administratifs',
    'notes-et-resultat'         => 'Notes et Résultats',
    'reclamations'              => 'Réclamations',
    'suivi-reclamation'         => 'Suivi des Réclamations',
    'ged'                       => 'GED',
];

// Parcours et création des pages
foreach ($student_master_pages as $slug => $title) {

    // Vérifier si la page existe déjà
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if ($exists) {
        echo "Page '$title' déjà existante (slug: $slug, ID: $exists).\n";
    } else {
        // Créer la page
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

        // Ajouter le template personnalisé si besoin
        add_post_meta($post_id, '_wp_page_template', 'um_student_master');
        add_post_meta($post_id, 'um_content_restriction', serialize([
            "_um_custom_access_settings" => false,
            "_um_accessible" => 0
        ]));

        echo "Page '$title' créée (slug: $slug, ID: $post_id).\n";
    }

    echo "--------------------------------------------\n";
}

echo "Script terminé (Student Master).\n";
