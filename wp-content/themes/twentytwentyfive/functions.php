<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;


add_filter('get_avatar_url', function ($url, $id_or_email) {
    $user = false;

    if (is_numeric($id_or_email)) {
        $user = get_userdata($id_or_email);
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    } elseif ($id_or_email instanceof WP_User) {
        $user = $id_or_email;
    } elseif ($id_or_email instanceof WP_Comment) {
        $user = get_userdata($id_or_email->user_id);
    }

    if (!$user) return $url;

    $custom_id = get_user_meta($user->ID, 'user_avatar_id', true);
    $custom_url = wp_get_attachment_url($custom_id);
    return $custom_url ?: $url;
}, 10, 2);



add_action('wp_logout', 'custom_cleanup_before_logout');

function custom_cleanup_before_logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['sl_step']) && $_SESSION['sl_step'] === 'verify') {
        error_log("L'utilisateur s'est déconnecté à l'étape de vérification.");
    }

    // Détruire la session complètement
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }

    session_destroy();
}

add_action('pre_get_users', function($query) {
    if (!is_admin() || !current_user_can('list_users')) return;

    $current_user = wp_get_current_user();

    // ✅ Admin UTM : voit tous les comptes (aucun filtre)
    if (in_array('um_admin_utm', $current_user->roles)) {
        return;
    }

    // 🔐 Admin établissement : filtrer par institut
    if (in_array('um_admin_etablissement', $current_user->roles)) {
        $institut_id = get_user_meta($current_user->ID, 'institut_id', true);
        if ($institut_id) {
            $query->set('meta_query', [
                [
                    'key' => 'institut_id',
                    'value' => $institut_id,
                    'compare' => '='
                ]
            ]);
        } else {
            // Aucun institut_id associé, ne rien montrer
            $query->set('meta_query', [
                [
                    'key' => 'ID',
                    'value' => 0,
                    'compare' => '='
                ]
            ]);
        }
    }
});

add_filter('views_users', function ($views) {
    $current_user = wp_get_current_user();

    // Filtrage uniquement pour um_admin_etablissement
    if (!in_array('um_admin_etablissement', $current_user->roles)) {
        return $views;
    }

    global $wpdb;

    $institut_id = get_user_meta($current_user->ID, 'institut_id', true);
    if (!$institut_id) return [];

    // Rôles autorisés à afficher
    $roles_autorises = [
        'um_candidat' => 'Candidat',
        'um_service-master' => 'SERVICE MASTER',
        'um_coordonnateur-master' => 'Coordonnateur Master',
    ];

    $base_url = admin_url('users.php');
    $current_role = $_GET['role'] ?? '';

    $new_views = [];

    // "Tous" : tous les utilisateurs filtrés par institut
    $total = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(u.ID)
        FROM {$wpdb->users} u
        INNER JOIN {$wpdb->usermeta} i ON i.user_id = u.ID AND i.meta_key = 'institut_id' AND i.meta_value = %d
    ", $institut_id));

    $class = $current_role === '' ? 'class="current"' : '';
    $new_views['all'] = "<a href='$base_url' $class>Tous <span class='count'>($total)</span></a>";

    // Rôles filtrés un par un
    foreach ($roles_autorises as $role_key => $label) {
        $count = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(u.ID)
            FROM {$wpdb->users} u
            INNER JOIN {$wpdb->usermeta} m1 ON m1.user_id = u.ID AND m1.meta_key = '{$wpdb->prefix}capabilities'
            INNER JOIN {$wpdb->usermeta} m2 ON m2.user_id = u.ID AND m2.meta_key = 'institut_id' AND m2.meta_value = %d
            WHERE m1.meta_value LIKE %s
        ", $institut_id, '%"'. $role_key .'"%'));

        $url = add_query_arg('role', $role_key, $base_url);
        $active = $current_role === $role_key ? 'class="current"' : '';
        $new_views[$role_key] = "<a href='" . esc_url($url) . "' $active>$label <span class='count'>($count)</span></a>";
    }

    return $new_views;
});


add_action('edit_user_profile_update', function($user_id) {
    $current_user = wp_get_current_user();
    if (in_array('um_admin_etablissement', $current_user->roles)) {
        $current_institut = get_user_meta($current_user->ID, 'institut_id', true);
        $target_institut = get_user_meta($user_id, 'institut_id', true);
        if ($current_institut !== $target_institut) {
            wp_die("⛔ Vous n'avez pas le droit de modifier cet utilisateur.");
        }
    }
});


add_filter('login_redirect', function($redirect_to, $request, $user) {
    if (!is_wp_error($user)) {
        if (in_array('um_admin_utm', $user->roles)) {
            return admin_url('users.php'); // Redirige vers la gestion des utilisateurs
        }

        if (in_array('adminetablissement', $user->roles)) {
            return admin_url('users.php'); // Idem, mais la liste est déjà filtrée par `institut_id`
        }
    }

    return $redirect_to; // Sinon, redirection normale
}, 10, 3);


add_action('admin_init', function () {
    if (!current_user_can('edit_users')) return;

    $screen = get_current_screen();
    if ($screen && $screen->id === 'user-edit') {
        $current_user = wp_get_current_user();
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

        if ($user_id && in_array('um_admin_etablissement', $current_user->roles)) {
            $my_institut = get_user_meta($current_user->ID, 'institut_id', true);
            $target_institut = get_user_meta($user_id, 'institut_id', true);

            if ($my_institut !== $target_institut) {
                wp_die("⛔ Accès refusé à cet utilisateur.");
            }
        }
    }
});

function ajouter_capacites_um_admin_etablissement() {
    $role = get_role('um_admin_etablissement'); // ou 'um_admin_etablissement' selon ton code

    if ($role) {
        $role->add_cap('read');
        $role->add_cap('list_users');
        $role->add_cap('edit_users');
        $role->add_cap('edit_user');
        $role->add_cap('create_users');
        $role->add_cap('promote_users');
        $role->add_cap('delete_users'); // si tu veux qu’il puisse supprimer
		$role->add_cap('manage_options'); // ✅ très important

    }
}
add_action('init', 'ajouter_capacites_um_admin_etablissement');

function ajouter_capacites_um_admin_utm() {
    $role = get_role('um_admin_utm');

    if ($role) {
        $role->add_cap('read');
        $role->add_cap('list_users');
        $role->add_cap('edit_users');
        $role->add_cap('edit_user');
        $role->add_cap('create_users');
        $role->add_cap('delete_users');
        $role->add_cap('promote_users');
        $role->add_cap('remove_users');
        $role->add_cap('manage_options'); // ⬅️ Important
    }
}

add_action('init', 'ajouter_capacites_um_admin_utm');

add_action('admin_menu', function () {
    $current_user = wp_get_current_user();
    $roles_autorises = ['um_admin_utm'];

    // Si ce n'est pas un rôle concerné, ne rien faire
    if (!array_intersect($roles_autorises, $current_user->roles)) return;

    global $menu;

    // Slugs réels à autoriser (extraits dynamiquement ou trouvés via debug)
    $slugs_autorises = [
        'index.php',                           // Tableau de bord
        'toplevel_page_gestion-etablissements',
        'gestion-etablissements',
        'ajouter-etablissement',
        'toplevel_page_gestion-fiches-master',
        'gestion-fiches-master',
        'ajouter-fiche-master',
        'users.php',
        'profile.php'
    ];

    foreach ($menu as $key => $item) {
        $slug = $item[2] ?? '';
        if (!in_array($slug, $slugs_autorises)) {
            remove_menu_page($slug);
        }
    }
});


add_action('admin_menu', function () {
    $current_user = wp_get_current_user();

    // Ne faire la restriction que pour le rôle um_admin_etablissement
    if (!in_array('um_admin_etablissement', $current_user->roles)) return;

    global $menu;

    $slugs_autorises = [
        'index.php',
        'toplevel_page_gestion-fiches-master',
        'gestion-fiches-master',
        'ajouter-fiche-master',
		'users.php',
        'profile.php'
    ];

    foreach ($menu as $key => $item) {
        $slug = $item[2] ?? '';
        if (!in_array($slug, $slugs_autorises)) {
            remove_menu_page($slug);
        }
    }
});


add_action('pre_get_posts', function($query) {
    if (is_admin() && $query->is_main_query() && $query->get('post_type') === 'fiche_master') {
        $current_user = wp_get_current_user();

        if (in_array('um_admin_etablissement', $current_user->roles)) {
            $institut_id = get_user_meta($current_user->ID, 'institut_id', true);
            if ($institut_id) {
                $meta_query = $query->get('meta_query') ?: [];
                $meta_query[] = [
                    'key' => 'institut_id',
                    'value' => $institut_id,
                    'compare' => '='
                ];
                $query->set('meta_query', $meta_query);
            }
        }
    }
});


add_action('admin_head', function () {
    $user = wp_get_current_user();

    if (in_array('um_admin_utm', $user->roles) || in_array('um_admin_etablissement', $user->roles)) {
        ?>
        <style>
            :root {
                --utm-primary: #BF0404;
       			 /*  --utm-secondary: #ECEBE3; */
                --utm-hover: #DBD9C3;
				--utm-secondary: #ECEBE3;
				--utm-gradient: linear-gradient(to bottom, #BF0404, #1F0808);

            }

			

            /* 🟫 Menu latéral */
			#adminmenuwrap,
            #adminmenu,
            #adminmenu .wp-submenu,
            #adminmenu .wp-has-current-submenu .wp-submenu {
     		/*      background-color: var(--utm-primary) !important;  */
			 background: transparent !important
            }
			 #adminmenu li.current a.menu-top{
				  background-color: var(--utm-hover) !important;
			 }
			 #adminmenu li.current a.menu-top .wp-menu-name {
				  color:#000 !important
			 }
			 /* 🟫 Menu latéral */
			#adminmenuback{
     		/*      background-color: var(--utm-primary) !important;  */
			 background: transparent linear-gradient(180deg, #BF0404 0%, #1F0808 100%) !important
            }


            #adminmenu a,
            #adminmenu .wp-menu-name,
            #adminmenu .wp-menu-image svg {
                color: #fff !important;
                fill: #fff !important;
            }

            /* 🎯 Hover et actifs dans le menu */
            #adminmenu li.menu-top:hover,
            #adminmenu li.menu-top.focus,
            #adminmenu .wp-submenu a:hover,
            #adminmenu .wp-has-current-submenu a.wp-has-current-submenu {
                background-color: var(--utm-hover) !important;
                color: #000 !important;
            }

            /* 🧭 Admin bar (barre du haut) */
            #wpadminbar {
                background-color: var(--utm-primary) !important;
            }

            /* 🔘 Bouton "Replier le menu" */
            #collapse-menu {
                background-color: var(--utm-primary) !important;
                border-color: var(--utm-hover) !important;
            }
            #collapse-menu:focus,
            #collapse-menu:hover {
                background-color: var(--utm-hover) !important;
            }

            /* 🧩 Zone principale (pages) */
            body.wp-admin {
                background-color: var(--utm-secondary);
            }

            .wrap h1,
            .wrap h2 {
                color: var(--utm-primary);
            }

            /* 🧾 Notices */
            .update-nag,
            .notice.notice-warning {
                background-color: #FFFDF2;
                border-left: 4px solid var(--utm-primary);
                color: #000;
            }

            /* ✅ Table */
            table.wp-list-table th,
            table.wp-list-table td {
                background-color: #fff;
                border-color: var(--utm-hover);
            }

            .tablenav .current-page,
            .tablenav .pagination-links a:hover {
                color: var(--utm-primary);
            }

        </style>
        <?php
    }
});


// 🧹 Supprimer le favicon WordPress (Site Icon par défaut)
add_action('init', function () {
    remove_action('wp_head', 'wp_site_icon', 99);
    remove_action('login_head', 'wp_site_icon');
    remove_action('admin_head', 'wp_site_icon');
});

// 🎯 Ajouter ton propre favicon (depuis uploads ou autre)
function ajouter_favicon_personnalise() {
    // Chemin vers ton favicon (.ico) dans le dossier uploads
    $favicon_url = content_url('/uploads/2025/06/images-_3_.ico');

    echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_url) . '" />';
    echo '<link rel="shortcut icon" href="' . esc_url($favicon_url) . '" />';
}

// Injection dans toutes les zones
add_action('wp_head', 'ajouter_favicon_personnalise');
add_action('admin_head', 'ajouter_favicon_personnalise');
add_action('login_head', 'ajouter_favicon_personnalise');

add_filter('editable_roles', function ($roles) {
    $current_user = wp_get_current_user();

    // Si c'est un admin établissement → filtrer
    if (in_array('um_admin_etablissement', $current_user->roles)) {
        $roles_autorises = ['um_service-master', 'um_coordonnateur-master'];

        // Ne garder que les rôles autorisés
        return array_filter($roles, function ($role_key) use ($roles_autorises) {
            return in_array($role_key, $roles_autorises);
        }, ARRAY_FILTER_USE_KEY);
    }

    // Pour les autres rôles → retour normal
    return $roles;
});


add_filter('pre_user_role', function ($role) {
    $current_user = wp_get_current_user();

    if (in_array('um_admin_etablissement', $current_user->roles)) {
        // Si le rôle soumis n'est pas autorisé, refuser
        $roles_autorises = ['um_service-master', 'um_coordonnateur-master'];

        if (!in_array($role, $roles_autorises)) {
            // Retourne le premier rôle autorisé par défaut (ou vide)
            return 'um_service-master';
        }
    }

    return $role;
});

add_action('admin_footer-user-new.php', function () {
    $user = wp_get_current_user();
    if (in_array('um_admin_etablissement', $user->roles)) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const roleSelect = document.querySelector("select#role");
                if (roleSelect) {
                    for (let i = roleSelect.options.length - 1; i >= 0; i--) {
                        const val = roleSelect.options[i].value;
                        if (val !== "um_service-master" && val !== "um_coordonnateur-master") {
                            roleSelect.remove(i);
                        }
                    }
                }
            });
        </script>';
    }
});


add_action('template_redirect', function() {
    if (is_404()) {
        wp_redirect(home_url(), 301); // Redirection permanente vers la page d'accueil
        exit;
    }
});
// Security headers

add_action('send_headers', function() {
    // Basic security headers
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    
    // Content Security Policy - adjust based on your needs
    // header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; img-src 'self' https: data:; style-src 'self' 'unsafe-inline' https:; font-src 'self' https: data:;");
    
    // Strict Transport Security - enable only if you have SSL
    // header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    
    // Referrer Policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Permissions Policy
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
header('Strict-Transport-Security: max-age=31536000;');
header('Referrer-Policy: same-origin');
header("Permissions-Policy: accelerometer 'none' ; ambient-light-sensor 'none' ; autoplay 'none' ; camera 'none' ; encrypted-media 'none' ; fullscreen 'none' ; geolocation 'none' ; gyroscope 'none' ; magnetometer 'none' ; microphone 'none' ; midi 'none' ; payment 'none' ; speaker 'none' ; sync-xhr 'none' ; usb 'none' ; notifications 'none' ; vibrate 'none' ; push 'none' ; vr 'none' ");


});
// Custom login error message
function wrong_login() {
    return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');

// Disable application passwords
add_filter('wp_is_application_passwords_available', '__return_false');


function remove_version() {
					return '';
				}
			add_filter('the_generator', 'remove_version');



add_action('admin_enqueue_scripts', 'enqueue_profil_select_script_for_chercheur');
function enqueue_profil_select_script_for_chercheur($hook) {
    if (!in_array($hook, ['user-edit.php', 'user-new.php'])) return;

    wp_enqueue_script('profil-select-js', get_stylesheet_directory_uri() . '/profil-select.js', ['jquery'], false, true);

    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    $profil_id = $user_id ? get_user_meta($user_id, 'profil_id', true) : '';

    wp_localize_script('profil-select-js', 'profil_ajax', [
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('get_profils_nonce'),
        'profil_id'  => (string) $profil_id
    ]);
}



add_action('wp_ajax_get_profils_list', 'get_profils_list_callback_fn');

function get_profils_list_callback_fn() {
    check_ajax_referer('get_profils_nonce');

    global $wpdb;
    $results = $wpdb->get_results("SELECT id, nom FROM utm_profils", ARRAY_A);
    wp_send_json_success($results);
}


add_action('user_register', 'save_profil_id_from_form', 10, 1);
add_action('profile_update', 'save_profil_id_from_form', 10, 1);

function save_profil_id_from_form($user_id) {
    $user = get_userdata($user_id);
    $roles = (array) $user->roles;

    if (in_array('um_chercheur', $roles)) {
        // On sauvegarde uniquement si un profil est sélectionné
        if (isset($_POST['profil_id']) && is_numeric($_POST['profil_id'])) {
            update_user_meta($user_id, 'profil_id', intval($_POST['profil_id']));
        }
    } else {
        // Si ce n'est plus un chercheur, on supprime le profil_id
        delete_user_meta($user_id, 'profil_id');
    }
}


