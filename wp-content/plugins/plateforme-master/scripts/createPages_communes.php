<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';
if (!file_exists($wp_load)) {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}
require_once $wp_load;

global $wpdb;

// ---- Paramètres ----
$pages_DL = [
    'reservation-des-equipements-et-salles',
    'programmes-et-projets-de-recherches',
    'programmes-et-projets-de-recherches-details-projet',
    'reseaux-de-la-recherches',
    'reseaux-de-la-recherche-details',
    'activites-quotidiennes_',
    'activites-quotidiennes-details',
    'activites-scientifiques_',
    'activites-scientifiques-details',
    'financements',
    'financement-fiche-de-financements',
    'actualites-de-l-utm',
    'article',
    'membre-de-labo',
    'membre-de-labo-fiche-membres',
    'publication',
    'ajouter-une-publication',
    'modifier-une-publication',
    'details-publication',
    'contacts',
    'etat-d-avancement-des-projets',
    'etat-d-avancement-des-projets-fiche-projet',
    'rapports',
    'reclamations_',
    'reunions',
    'profile_',
    'ged_',
    'bibliotheques',
    'fiche-details-du-labo_',
];

// Dossier de sortie pour les fichiers PHP
$php_base_dir = __DIR__ . '/Modules/LaboRecherche/pages/pagesDirecteurlabo/';

// Créer le dossier s'il n'existe pas
if (!is_dir($php_base_dir)) {
    if (!mkdir($php_base_dir, 0755, true)) {
        exit("❌ Impossible de créer le dossier: $php_base_dir\n");
    }
    // index.php de sécurité
    file_put_contents($php_base_dir . 'index.php', "<?php // Silence is golden.\n");
}

echo "📂 Dossier des pages PHP: $php_base_dir\n\n";

// ---- Utilitaires ----
function ensure_post_meta($post_id, $key, $value)
{
    global $wpdb;
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_id FROM {$wpdb->prefix}postmeta WHERE post_id = %d AND meta_key = %s",
        $post_id,
        $key
    ));
    if (!$exists) {
        add_post_meta($post_id, $key, $value);
        echo "   ➕ Meta '$key' ajoutée.\n";
    } else {
        echo "   ⏩ Meta '$key' déjà présente.\n";
    }
}

// ---- Boucle de création ----
foreach ($pages_DL as $slug) {
    // Titre lisible
    $title = ucwords(str_replace(['-', '  '], [' ', ' '], $slug));

    // 1) Créer/assurer la page WordPress
    $post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page' LIMIT 1",
        $slug
    ));

    if (!$post_id) {
        // Créer la page
        $inserted = $wpdb->insert("{$wpdb->prefix}posts", [
            'post_author' => 1,
            'post_date' => current_time('mysql'),
            'post_date_gmt' => current_time('mysql', 1),
            'post_content' => '',
            'post_title' => $title,
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_name' => $slug,
            'post_type' => 'page'
        ]);

        if ($inserted === false) {
            echo "❌ Erreur lors de la création de la page '$slug'.\n--------------------------------------------\n";
            continue;
        }

        $post_id = $wpdb->insert_id;
        echo "✅ Page créée: '$slug' (ID: $post_id)\n";
    } else {
        echo "⏩ Page déjà existante: '$slug' (ID: $post_id)\n";
    }

    // Métas requises
    ensure_post_meta($post_id, '_wp_page_template', 'espace');
    ensure_post_meta($post_id, 'um_content_restriction', serialize([
        "_um_custom_access_settings" => false,
        "_um_accessible" => 0
    ]));

    // 2) Créer/assurer le fichier PHP (nom = slug.php)
    $php_file = $php_base_dir . $slug . '.php';
    if (!file_exists($php_file)) {
        $boilerplate = <<<PHP
<?php
/**
 * Fichier: {$slug}.php
 * Dossier: Modules/LaboRecherche/pages/pagesDirecteurlabo/
 * Objet: Contenu de la page "{$title}"
 * Sécu: Accès direct interdit
 */
if (!defined('ABSPATH')) { exit; }

// 👉 Votre contenu HTML/PHP ici
?>
<div class="content-block">
    <div class="header-bar">
        <h2><?php echo esc_html(get_the_title()); ?></h2>
    </div>
    <hr class="section-divider">
    <p>Page: <strong>{$slug}</strong> — Dossier: <em>pagesDirecteurlabo</em></p>
</div>

PHP;
        file_put_contents($php_file, $boilerplate);
        echo "🆕 Fichier PHP créé: $php_file\n";
    } else {
        echo "⏩ Fichier PHP déjà présent: $php_file\n";
    }

    echo "--------------------------------------------\n";
}

echo "🎉 Terminé.\n";