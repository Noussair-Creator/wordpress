<?php
/**
 * Script de création de pages WP + fichiers PHP pour Commission ED
 * Rôle UM ciblé : um_commission_ed
 * Dossier : /Modules/ED/pages/commission_ed
 * Suffixe appliqué aux slugs et fichiers : _comissionEd
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);

// 1) Charger WordPress
$wp_load = '/laragon/www/wordpress/wp-load.php';
if (!file_exists($wp_load)) {
    exit("❌ wp-load.php introuvable : $wp_load\n");
}
require_once $wp_load;

if (!function_exists('wp_insert_post')) {
    exit("❌ Environnement WP non chargé.\n");
}

global $wpdb;

// 2) Paramètres
$role_um = 'um_doctorant';
$base_dir = '/laragon/www/wordpress/wp-content/plugins/plateforme-master/Modules/ED/pages/pagesD/';
$suffix = '_Doctorant';

// 3) Créer le dossier cible si besoin
if (!is_dir($base_dir)) {
    if (!mkdir($base_dir, 0755, true)) {
        exit("❌ Impossible de créer le dossier : $base_dir\n");
    }
    echo "📂 Dossier créé : $base_dir\n";
}

// 4) Liste des titres exacts
$titles = [
    'Demandes De Comptabilisation Des Credits',
    'Demandes',
    'Soutenance',
    'Reunions_D',
    'Profile',
    'Planning Des Cours Et Activites',
];

// 5) Helpers
function slugify_strict($text)
{
    $text = str_replace(['–', '—', '/'], ['-', '-', '-'], $text);
    if (function_exists('iconv')) {
        $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        if ($t !== false)
            $text = $t;
    }
    $text = strtolower($text);
    $text = preg_replace('~[^a-z0-9]+~', '-', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return $text ?: 'page';
}

function ensure_unique_slug($base_slug)
{
    global $wpdb;
    $slug = $base_slug;
    $i = 2;
    while (true) {
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type = 'page' AND post_status != 'trash'",
            $slug
        ));
        if (!$exists)
            return $slug;
        $slug = $base_slug . '-' . $i;
        $i++;
    }
}

function apply_um_role_restriction($post_id, $role)
{
    $group = [
        "_um_custom_access_settings" => true,
        "_um_accessible" => 0,
        "_um_restrict_by" => 'role',
        "_um_roles" => [$role],
    ];
    update_post_meta($post_id, 'um_content_restriction', $group);
    update_post_meta($post_id, '_um_custom_access_settings', '1');
    update_post_meta($post_id, '_um_accessible', '0');
    update_post_meta($post_id, '_um_restrict_by', 'role');
    update_post_meta($post_id, '_um_roles', [$role]);
}

// 6) Boucle de création
foreach ($titles as $title) {
    $base_slug = slugify_strict($title) . $suffix;
    $slug = ensure_unique_slug($base_slug);

    // Vérifier si page avec ce titre existe déjà
    $existing_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = 'page' AND post_status != 'trash'",
        $title
    ));

    if ($existing_id) {
        echo "⏩ Page déjà existante (ID: $existing_id) pour « $title ».\n";
        $post_id = (int) $existing_id;
    } else {
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_name' => $slug,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        ], true);

        if (is_wp_error($post_id) || !$post_id) {
            echo "❌ Erreur création page « $title » : " . (is_wp_error($post_id) ? $post_id->get_error_message() : 'inconnue') . "\n";
            continue;
        }

        update_post_meta($post_id, '_wp_page_template', 'espace');
        apply_um_role_restriction($post_id, $role_um);

        echo "✅ Page créée (ID: $post_id) — Slug: $slug\n";
    }

    // Fichier PHP correspondant
    $php_filename = $slug . '.php';
    $filepath = $base_dir . $php_filename;

    if (!file_exists($filepath)) {
        $php_content = <<<PHP
<?php
/**
 * Page: {$title}
 * Slug: {$slug}
 * Rôle UM: {$role_um}
 */
get_header();
?>
<div class="wrap" style="padding:24px;">
    <h1>{$title}</h1>
    <p>Page réservée au rôle <strong>{$role_um}</strong>.</p>
</div>
<?php
get_footer();
PHP;
        file_put_contents($filepath, $php_content);
        echo "📄 Fichier créé : $php_filename\n";
    } else {
        echo "📁 Fichier déjà présent : $php_filename\n";
    }

    echo "--------------------------------------------\n";
}

echo "🏁 Script terminé.\n";