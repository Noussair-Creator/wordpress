<?php
/*
Plugin Name: Plateforme Mastère
Description: Plugin modulaire pour la gestion des espaces Mastère (Coordinateur, Service).
Version: 1.0
Author: Clickerp
*/

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/api.php';
require_once plugin_dir_path(__FILE__) . 'includes/api_utm.php';

require_once plugin_dir_path(__FILE__) . 'includes/apicandidats.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-universites.php';



/**
 * Redirige l'utilisateur connecté selon son rôle (Ultimate Member).
 *
 * @param string  $redirect_to URL par défaut.
 * @param string  $request      URL demandée.
 * @param WP_User $user         Utilisateur connecté.
 * @return string               URL de redirection.
 */
/*function pm_login_redirect_by_role($redirect_to, $request, $user)
{
    if (isset($user->roles) && is_array($user->roles)) {

        if (in_array('um_coordonnateur-master', $user->roles)) {
            return site_url('/espace-coordinateur');

        } elseif (in_array('um_service-master', $user->roles)) {
            return site_url('/espace-service');
        }
    }

    // Redirection par défaut (accueil ou $redirect_to initial)
    return $redirect_to;
}*/
//add_filter('login_redirect', 'pm_login_redirect_by_role', 10, 3);

/**
 * Crée automatiquement les pages "Espace Coordinateur" et "Espace Service".
 */
function pm_create_default_pages()
{
    $pages = [
        'espace-coordinateur' => 'Espace Coordinateur',
        'espace-service' => 'Espace Service',
    ];

    foreach ($pages as $slug => $title) {
        $existing_page = get_page_by_path($slug, OBJECT, 'page');

        if (!$existing_page) {
            wp_insert_post([
                'post_title' => $title,
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => "<!-- page générée par Plateforme Mastère -->",
            ]);
        }
    }
}
register_activation_hook(__FILE__, 'pm_create_default_pages');


add_filter('the_content', 'plateforme_content');
function plateforme_content($content)
{

    if (is_page('espace-service')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/DashboardService.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('dashboard-utm-master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/dashboard-utm-master.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('espace-ecoledoctorale')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-etablissement', $current_user->roles) || in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardED.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('espace-master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-etablissement', $current_user->roles) || in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/DashboardServiceMASTER.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('espace-labo')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-etablissement', $current_user->roles) || in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardLABO.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('gestion-master-utm')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/Gestion-master-utm.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('candidature-service-utm')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-utm', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/candidature-service-utm.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('depot-candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_candidat', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/Candidature/depot-condidature/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('reclamation')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_candidat', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/Candidature/reclamation/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('historique-de-candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_candidat', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/Candidature/historique-condidature/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('entretien-candidat')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_candidat', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/Candidature/entretien/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }

        if (is_page('resultats-candidat')) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (in_array('um_candidat', $current_user->roles)) {
                    ob_start();

                }
                include plugin_dir_path(__FILE__) . 'pages/Candidature/resultat-condidature/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }

        if (is_page('calendrier')) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (in_array('um_candidat', $current_user->roles)) {
                    ob_start();

                }
                include plugin_dir_path(__FILE__) . 'pages/Candidature/calendrier/index.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('gestion-des-master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/GESTIONMASTER.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('profil')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/profil.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('fiche-master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/FicheMaster.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('list-master-coordinateur')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/GESTIONMASTERCoordinateur.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/candidature.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('fiche-candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/fiche-candidature.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('formule-de-calcul-du-score')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/formulescore.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('appel-a-candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/appel-a-candidature.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('creation-appel-a-candidature')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/creation-appel-a-candidature.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } elseif (is_page('entretien')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/entretien.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    // ED
    else if (is_page('espace_ecole_doctorale')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_ecole_doctorale', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/Dashboard.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } else if (is_page('espace_directeurthese')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_directeur_these', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardDirecteurThese.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } else if (is_page('espace-comissioned')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_commission_ed', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/Dashboardcomissioned.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } else if (is_page('espace-doctorant')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_doctorant', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardDoctorant.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    // Labo
    else if (is_page('espace-directeur-de-recherche')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_directeur_these', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardDirecteurLabo.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    } else if (is_page('espace-chercheur')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_chercheur', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardChercheur.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    // Espace Etudiant Master
    if (is_page('espace_etudiant_master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'pages/DashboardStudent.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    //PMO
    if (is_page('pmo')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'pages/PMO.php';

        } else {
            plateforme_redirect_home();
        }
    }


    if (is_page('presentation-de-la-plateforme')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/USCR/presentation-de-la-plateforme.php';

        } else {
            plateforme_redirect_home();
        }
    }


    // 🔁 Chargement automatique des pages ED dynamiques
    $pages_ed = [
        'inscription-et-reinscription',
        'dossier-inscription',
        'theses',
        'theses-add',
        'doctorants',
        'membres',
        'demande',
        'demande-affichage',
        'formations',
        'formations-add',
        'contrats-post-doctoraux',
        'conventions-de-cotutelle',
        'conventions-de-cotutelle-commentaire',
        'admissions-doctorants-etrangers',
        'admissions-doctorants-etrangers-dossier',
        'admissions-doctorants-etrangers-1'
    ];

    foreach ($pages_ed as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesED/' . $page_slug . '.php';
                    echo ob_get_clean();
                    exit;
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }
    if (is_page('unite-genomique')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/USCR/unite-genomique.php';

        } else {
            plateforme_redirect_home();
        }
    } else {
        return $content;
    }

}




/**
 * Exit and redirect to home
 */

function plateforme_redirect_home()
{
    wp_redirect(home_url());
    exit();
}



add_action('template_redirect', 'pm_template_override');
function pm_template_override()
{
    // 🔁 Page 100% personnalisée pour espace-service
    if (is_page('espace-service')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/DashboardService.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }

    if (is_page('dashboard-utm-master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/dashboard-utm-master.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('espace-ecoledoctorale')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-etablissement', $user->roles) || in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardED.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('depot-candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/depot-condidature/index.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('reclamation')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/reclamation/index.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('historique-de-candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/historique-condidature/index.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('calendrier')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/calendrier/index.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('entretien-candidat')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/entretien/index.php';

                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('resultats-candidat')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_candidat', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Candidature/resultat-condidature/index.php';

                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('gestion-des-master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/GESTIONMASTER.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }


    if (is_page('gestion-master-utm')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/Gestion-master-utm.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }

    if (is_page('candidature-service-utm')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/candidature-service-utm.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    }
    if (is_page('profil')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/profil.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    } elseif (is_page('fiche-master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/FicheMaster.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    } elseif (is_page('list-master-coordinateur')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/GESTIONMASTERCoordinateur.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    } elseif (is_page('candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/candidature.php';
                exit;
            }
        }

        // Rediriger les non autorisés
        wp_redirect(home_url());
        exit;
    } elseif (is_page('fiche-candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/fiche-candidature.php';
                exit;
            }
        }
    } elseif (is_page('entretien')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/entretien.php';
                exit;
            }
        }
    }

    // Même chose pour espace-coordinateur (optionnel)
    if (is_page('espace-coordinateur')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_coordonnateur-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/DashboardCorrdinateur.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('formule-de-calcul-du-score')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles) || in_array('um_coordonnateur-master', $user->roles)) {

                include plugin_dir_path(__FILE__) . 'pages/formulescore.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('appel-a-candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/appel-a-candidature.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('creation-appel-a-candidature')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/creation-appel-a-candidature.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    }

    // Espace Etudiant Master
    elseif (is_page('espace_etudiant_master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/DashboardStudent.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    }


    // ED
    elseif (is_page('espace_ecole_doctorale')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_ecole_doctorale', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/Dashboard.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace_directeurthese')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_directeur_these', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardDirecteurThese.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-comissioned')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_commission_ed', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/Dashboardcomissioned.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-doctorant')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_doctorant', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/ED/pages/DashboardDoctorant.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-directeur-de-recherche')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_directeur_laboratoire', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardDirecteurLabo.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-chercheur')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_chercheur', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardChercheur.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-etablissement', $user->roles) || in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'pages/DashboardServiceMASTER.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('espace-labo')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_service-etablissement', $user->roles) || in_array('um_service-utm', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/DashboardLABO.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('pmo')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'pages/PMO.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    if (is_page('presentation-de-la-plateforme')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/USCR/presentation-de-la-plateforme.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    if (is_page('unite-genomique')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/USCR/unite-genomique.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    if (is_page('programmes-projects-de-recherches')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/ProgrammesProjectsDeRecherches.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('activites-scientifiques')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/ActivitesScientifiques.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('reseaux-de-la-recherche')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/ReseauxDeLaRecherche.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('activites-quotidiennes')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/ActivitesQuotidiennes.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('etat-davancement-des-projets')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/EtatDavancementDesProjets.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('financement')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/Financement.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('membres-de-laboratoire')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/Financement.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('actualites-de-lutm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/ActualitesDeLUTM.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('membres-de-laboratoire-2')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/MembresDeLaboratoire2.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    if (is_page('comment-proteger-ma-recherche')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/CommentProtegerMaRecherche.php';
            exit;
        }
        wp_redirect(home_url());
        exit;
    }
    // 🔁 Chargement automatique des pages ED dynamiques
    $pages_ed = [
        'inscription-et-reinscription',
        'dossier-inscription',
        'theses',
        'theses-add',
        'doctorants',
        'membres',
        'demande',
        'demande-affichage',
        'formations',
        'formations-add',
        'contrats-post-doctoraux',
        'conventions-de-cotutelle',
        'conventions-de-cotutelle-commentaire',
        'admissions-doctorants-etrangers',
        'admissions-doctorants-etrangers-dossier',
        'admissions-doctorants-etrangers-1'
    ];

    foreach ($pages_ed as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesED/' . $page_slug . '.php';

                    if (file_exists($file)) {
                        include $file;
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$page_slug.php</code> est introuvable dans <code>pagesED</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }






}


add_action('wp_enqueue_scripts', 'pm_enqueue_frontend_assets');

function pm_enqueue_frontend_assets()
{
    $plugin_dir = plugin_dir_path(__FILE__);
    $plugin_url = plugin_dir_url(__FILE__);

    $css_file = 'assets/css/style.css';
    $js_file = 'assets/js/master.js';

    $css_path = $plugin_dir . $css_file;
    $css_url = $plugin_url . $css_file;

    $js_path = $plugin_dir . $js_file;
    $js_url = $plugin_url . $js_file;

    // ✅ Enqueue le CSS si le fichier existe
    if (file_exists($css_path)) {
        wp_enqueue_style(
            'plateforme-master-style',
            $css_url,
            [],
            filemtime($css_path)
        );
    }

    // ✅ Enqueue le JS si le fichier existe
    if (file_exists($js_path)) {
        wp_enqueue_script(
            'plateforme-master-script',
            $js_url,
            [],
            filemtime($js_path),
            true
        );

        // ✅ Injecter les paramètres REST dans JavaScript
        /*  wp_localize_script('plateforme-master-script', 'PMSettings', [
              'apiUrl' => rest_url('plateforme-master/v1/masters-by-user'),
              'nonce'  => wp_create_nonce('wp_rest')
          ]);*/
    }
}