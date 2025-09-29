<?php
/**
 * Script: createPMO.php
 * - Crée les pages PMO (slug => titre) si absentes via wp_insert_post()
 * - Ajoute les metas (_wp_page_template, um_content_restriction) si absentes
 * - Génère un fichier PHP par page dans Modules/PMO/ si absent
 */

if (php_sapi_name() === 'cli') {
    // Neutraliser les sessions pour l'exécution en CLI
    if (function_exists('session_start')) {
        ini_set('session.use_cookies', '0');
        ini_set('session.use_only_cookies', '0');
        ini_set('session.cache_limiter', '');
    }
}

/* ---------- Localisation automatique de wp-load.php ---------- */
function locate_wp_load(): ?string {
    // 1) Variable d'environnement optionnelle
    $env = getenv('WP_LOAD_PATH');
    if ($env && file_exists($env)) return $env;

    // 2) Parcours en remontant depuis le dossier courant (…/plugins/plateforme-master/scripts)
    $dir = __DIR__;
    for ($i = 0; $i < 8; $i++) {
        $candidate = $dir . '/wp-load.php';
        if (file_exists($candidate)) return $candidate;
        $dir = dirname($dir);
    }

    // 3) Chemins connus en fallback (à adapter si besoin)
    $fallbacks = [
        '/home/utmresearchplatform/public_html/wp-load.php', // prod
        '/var/www/html/wp-load.php',                         // générique
    ];
    foreach ($fallbacks as $f) {
        if (file_exists($f)) return $f;
    }
    return null;
}

$wp_load = locate_wp_load();
if ($wp_load) {
    require_once $wp_load;
} else {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin ou définissez WP_LOAD_PATH.\n");
}

global $wpdb;

/* ---------- Pages à créer (slug => titre) ---------- */
$pages_USCR = [
    
    'Plateformes'                               => 'Plateformes',
    'equipements'                               => 'equipements',
    'reservation-et-planning'                   => 'reservation et planning',
    'maintenance-et-incidents'                  => 'maintenance et incidents',
    'utilisateurs'                              => 'Utilisateurs',
    'statistiques-et-historique'                => 'Statistiques et Historique',
];

/* ---------- Répertoire de génération des fichiers ----------
   scripts/ -> plugin root = dirname(__DIR__)
   Modules/PMO/ = $plugin_root . '/Modules/PMO/'
---------------------------------------------------------------- */
$plugin_root = dirname(__DIR__); // …/wp-content/plugins/plateforme-master
$base_dir    = $plugin_root . '/Modules/Unités_Service_Communs/';

if (!is_dir($base_dir)) {
    exit("❌ Dossier cible introuvable : $base_dir\n");
}

foreach ($pages_USCR as $slug => $title) {

    // Vérifier si la page existe déjà
    $post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if (!$post_id) {
        // Créer la page via l'API WP
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
            if (is_wp_error($post_id)) {
                echo $post_id->get_error_message() . "\n";
            }
            echo "--------------------------------------------\n";
            continue;
        }
    } else {
        echo "ℹ️ Page '$slug' déjà existante (ID: $post_id).\n";
    }

    // Métadonnées : n'ajouter que si absentes
    if (!get_post_meta($post_id, '_wp_page_template', true)) {
        add_post_meta($post_id, '_wp_page_template', 'espace');
        echo "➕ Meta '_wp_page_template' ajoutée.\n";
    }

    if (!get_post_meta($post_id, 'um_content_restriction', true)) {
        $restriction = [
            "_um_custom_access_settings" => false,
            "_um_accessible"             => 0
        ];
        add_post_meta($post_id, 'um_content_restriction', maybe_serialize($restriction));
        echo "➕ Meta 'um_content_restriction' ajoutée.\n";
    }

    // Générer le fichier PHP associé (si absent)
    $filepath = $base_dir . $slug . '.php';
    if (!file_exists($filepath)) {
        $php_content = <<<PHP
<?php
/**
 * Page: {$title}
 */
get_header();
?>
<h1>{$title}</h1>
<?php
get_footer();
PHP;
        file_put_contents($filepath, $php_content);
        echo "📄 Fichier '{$slug}.php' généré dans {$base_dir}.\n";
    } else {
        echo "📁 Fichier '{$slug}.php' déjà existant.\n";
    }

    echo "--------------------------------------------\n";
}

echo "✅ Script terminé.\n";
