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


require_once plugin_dir_path(__FILE__) . 'includes/reclamations-api.php';
require_once plugin_dir_path(__FILE__) . 'includes//doctorants/api_doctorants.php';
require_once plugin_dir_path(__FILE__) . 'includes//recherche/api_chercheur.php';
require_once plugin_dir_path(__FILE__) . 'includes/recherche/api_directeurderecherche.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-publication-controller.php';

require_once plugin_dir_path(__FILE__) . 'includes/api-contact.php';

// CORRECT PATH
// require_once plugin_dir_path(__FILE__) . 'includes/directeur_de_labo/api_directeurderecherche.php';

require_once plugin_dir_path(__FILE__) . 'includes/pmo/api_pmo.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-messages.php';

require_once plugin_dir_path(__FILE__) . 'includes/api-profile.php';

require_once plugin_dir_path(__FILE__) . 'includes/api_reunion.php';




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

    if (is_page('examens')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/examens.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('absences')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/absences.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('emplois')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/emplois.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('stages')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/stages.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('profile2')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();

            include plugin_dir_path(__FILE__) . 'Modules/profile/profile.php';

        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('messages')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();

            include plugin_dir_path(__FILE__) . 'Modules/Messages/messages.php';

        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('contacts')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();

            include plugin_dir_path(__FILE__) . 'Modules/contact/contact.php';

        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('details-master')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/details-master.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('bibliotheque')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/bibliotheque.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    if (is_page('support-pedagogiques')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/support-pedagogiques.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('soutenance')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/soutenance.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('formulaires-administratifs')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/formulaires-administratifs.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }


    if (is_page('notes-et-resultat')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/notes-et-resultat.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('reclamations')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/reclamations.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('suivi-reclamation')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/SuiviReclamations.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }

    if (is_page('ged')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_student_master', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/GED.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }
    //Page Profile directeur Du labo  'um_directeur_laboratoire'

    //   if (is_page('mon-profile')) {
    //     if (is_user_logged_in()) {
    //         $current_user = wp_get_current_user();

    //         include plugin_dir_path(__FILE__) . 'Modules/profile/profile.php';

    //     } else {
    //         plateforme_redirect_home();
    //     }
    // }
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




    if (is_page('dashboardpmo')) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (in_array('um_pmo', $current_user->roles)) {
                ob_start();

                include plugin_dir_path(__FILE__) . '/Modules/PMO/DashboardPMO.php';

            } else {
                plateforme_redirect_home();
            }
        } else {
            plateforme_redirect_home();
        }
    }



    // create page UTM
    // if (is_page('UTM')) {
    //     if (is_user_logged_in()) {

    //         include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/utm.php';

    //     } else {
    //         plateforme_redirect_home();
    //     }
    // }
    // create page presentation-utm
    if (is_page('presentation-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/presentation-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page presentation-utm
    if (is_page('coordonnees')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/coordonnees.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page publications-utm
    if (is_page('publications-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/publications-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page publications-utm-details
    if (is_page('publications-utm-details')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/publications-utm-details';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page projets-de-cooperation-utm
    if (is_page('projets-de-cooperation-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/projets-de-cooperation-utm';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page annonces-de-soutenances-utm
    if (is_page('annonces-de-soutenances-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/annonces-de-soutenances-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page ouverture-sur-lenvironnement-utm
    if (is_page('ouverture-sur-lenvironnement-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/ouverture-sur-lenvironnement-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page etablissements UTM Details
    if (is_page('etablissements-utm-details')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/etablissements-utm-details.php';

        } else {
            plateforme_redirect_home();
        }
    }
    // create page etablissements UTM
    if (is_page('etablissements-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/etablissements-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }


    // create page Structures de recherche UTM
    if (is_page('structures-de-recherche-utm')) {
        if (is_user_logged_in()) {

            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/structures-de-recherche-utm.php';

        } else {
            plateforme_redirect_home();
        }
    }




    // 🔁 Chargement automatique des pages ED dynamiques
    $pages_DL = [
        // 'reservation-des-equipements-et-salles',
        //'programmes-et-projets-de-recherches',
        //'programmes-et-projets-de-recherches-details-projet',
        // 'activites-scientifiques-directeur-labo',
        //'reseaux-de-la-recherche-directeur-labo',
        //'reseaux-de-la-recherche-details',
        //'activites-quotidiennes-directeur-labo',
        //'etat-d-avancement-des-projets',
        //'etat-d-avancement-des-projets-fiche-projet',
        //'financement-directeur-labo',
        //'financement-fiche-de-financement-directeur-labo',
        //'actualites-de-l-utm',
        //'article',
        //'membre-de-labo',
        //'membre-de-labo-fiche-membre',
        'fiche-labo',
        // Ajout des pages pour Directeur de Labo
        // 'publication-directeur-du-labo',
        // 'ajouter-une-publication-directeur-du-labo',
        // 'modifier-une-publication-directeur-du-labo',
        // 'details-publication-directeur-du-labo',
        // 'contacts-directeur-du-labo',
        // Ajout des pages pour Directeur de Labo 08/26/2025
        //'reclamations-directeur-du-labo',
        //'reunions-directeur-du-labo',
        //'rapports-directeur-du-labo',
        // 'activites-scientifiques-details',
        //'activites-quotidiennes-details',
        // 'profile-directeur-du-labo',
        //'ged-directeur-du-labo',
    ];
    foreach ($pages_DL as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_directeur_laboratoire', 'um_service-etablissement', 'um_service-utm'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pagesDirecteurlabo/' . $page_slug . '.php';
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

    // 🔁 Chargement automatique des pages pour Directeur et chercher.
    $Pages_communes = [
        'reservation-des-equipements-et-salles',
        'programmes-et-projets-de-recherches',
        'programmes-et-projets-de-recherches-details-projet_',
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
        'etat-d-avancement-des-projets',
        'etat-d-avancement-des-projets-fiche-projet',
        'rapports',
        'reclamations_',
        'reunions',
        'profile_',
        'ged_',
        'bibliotheques',
        'fiche-details-du-labo_',
        // add page Assiduité des chercheurs
        'assiduite-des-chercheurs',
    ];

    foreach ($Pages_communes as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_chercheur', 'um_directeur_laboratoire', 'um_service-etablissement', 'um_service-utm'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pagesCommunes/' . $page_slug . '.php';
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
        'admissions-doctorants-etrangers-1',
        'fiche-dun-candidat-post-doc',
        'fiche-dune-candidature',
        // Ajouter d'auteres pages ici
        'soutenances-ecole-doctorale',
        'commission-doctorale-ecole-doctorale',
        'contacts-ecole-doctorale',
        'inscription-reinscription-ecole-doctorale',
        'dossier-inscription-ecole-doctorale',

    ];

    /*foreach ($pages_ed as $page_slug) {
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
    }*/


    foreach ($pages_ed as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();

                // Rôles autorisés
                if (in_array($page_slug, ['inscription-et-reinscription', 'dossier-inscription'], true)) {
                    $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm', 'um_commission_ed'];
                } else {
                    $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm'];
                }

                if (array_intersect($allowed_roles, (array) $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesED/' . $page_slug . '.php';

                    if (file_exists($file)) {
                        ob_start();
                        include $file;
                        echo ob_get_clean();
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>{$page_slug}.php</code> est introuvable dans <code>pagesED</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }


    $pages_doctorant = [
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

    foreach ($pages_doctorant as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_doctorant'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesDoctorant/' . $page_slug . '.php';
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
    // Chargement automatique des pages LaboRecherche pour le rôle um_chercheur
    $chercheur_pages = [
        // 'programmes-projects-de-recherches' => 'ProgrammesProjectsDeRecherches.php',
        // 'activites-scientifiques' => 'ActivitesScientifiques.php',
        // 'reseaux-de-la-recherche' => 'ReseauxDeLaRecherche.php',
        // 'activites-quotidiennes' => 'ActivitesQuotidiennes.php',
        // 'etat-davancement-des-projets' => 'EtatDavancementDesProjets.php',
        // 'financement' => 'Financement.php',
        // 'actualites-de-lutm' => 'ActualitesDeLutm.php',
        // 'membres-de-laboratoire' => 'MembresDeLaboratoire.php',
        'comment-proteger-ma-recherche' => 'CommentProtegerMaRecherche.php',
        // 'details-programmes-projets-de-recherches' => 'DetailsProgrammesProjetsDeRecherches.php',
        // 'reseaux-de-la-recherche-fiche-partenaire' => 'ReseauxDeLaRechercheFichePartenaire.php',
        // 'financement-fiche-de-financement' => 'FinancementFicheDeFinancement.php',
        // 'membres-de-laboratoire-fiche-dun-membre' => 'MembresDeLaboratoireFicheDunMembre.php',
        // 'fiche-details-du-laboratoire-lsama' => 'FicheDetailsDuLaboratoireLsama.php',
        // 'etat-davancement-des-projets-fiche-projet' => 'EtatDavancementDesProjetsFicheProjet.php',
        // Ajoutez 2 pages publications & ajouter-une-publication
        // 'publications-chercheur' => 'Publications.php',
        // 'ajouter-une-publication-chercheur' => 'AjouterUnePublication.php',
    ];

    foreach ($chercheur_pages as $page_slug => $php_file) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (in_array('um_chercheur', $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pageschercheur' . $php_file;

                    if (file_exists($file)) {
                        ob_start();
                        include $file;
                        echo ob_get_clean();
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$php_file</code> est introuvable dans <code>pageschercheur</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }

    // Correspondance slug => nom réel du fichier (Commission ED)
    $commission_ed_pages = [
        'formation-doctorale_comissioned' => 'formation-doctorale_comissionedEd.php',
        'formation-doctorale-fiche-d-une-formation-doctorale_comissioned' => 'formation-doctorale-fiche-d-une-formation-doctorale_comissionEd.php',
        'candidatures-ed_comissioned' => 'candidatures-ed_comissionEd.php',
        'fiche-candidatures-ed_comissioned' => 'fiche-candidatures-ed_comissionEd.php',
        'comissions-doctorale_comissioned' => 'comissions-doctorale_comissionEd.php',
        'fiche-reunion-comission_comissioned' => 'fiche-reunion-comission_comissionEd.php',
        'soutenances_comissioned' => 'soutenances_comissionEd.php',
        'planifier-soutenance_comissioned' => 'planifier-soutenance_comissionEd.php',
        'financements-et-conformite_comissioned' => 'financements-et-conformite_comissionEd.php',
        'fiche-de-financement_comissioned' => 'fiche-de-financement_comissionEd.php',
        'comites-de-suivi_comissioned' => 'comites-de-suivi_comissionEd.php',
        'fiche-de-comite-de-suivi_comissioned' => 'fiche-de-comite-de-suivi_comissionEd.php',
        'jurys-rapporteurs_comissioned' => 'jurys-rapporteurs_comissionEd.php',
        'fiche-de-composition-d-un-jury_comissioned' => 'fiche-de-composition-d-un-jury_comissionEd.php',
    ];
    foreach ($commission_ed_pages as $page_slug => $php_file) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (in_array('um_commission_ed', $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagescommission_ed' . $php_file;

                    if (file_exists($file)) {
                        ob_start();
                        include $file;
                        echo ob_get_clean();
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$php_file</code> est introuvable dans <code>pageschercheur</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }

    // 🔁 Chargement automatique des pages pour Directeur de Thèse (DT)
    $pages_DT = [
        'mes-doctorants_directeurth',
        'fiche-individuelle-du-doctorant_directeurth',
        'planning-des-r-eunions_directeurth',
        'fiche-candidatures-ed_directeurth',
        'evaluations-et-rapports_directeurth',
        'fiche-d-evaluation-annuelle_directeurth',
        'suivi-des-d-ep-ots_directeurth',
        'fiche-de-d-ep-ot_directeurth',
        'progression_directeurth',
        'planification-des-soutenances_directeurth',
        'publications-et-communications_directeurth',

        'manifestations-scientifiques-ed',
        'declarer-une-participation-ed',
        'reunions-ed',
    ];

    foreach ($pages_DT as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                // You might want to adjust these roles as needed
                $allowed_roles = ['um_directeur_these', 'um_service-etablissement', 'um_service-utm'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    // The filename should match the slug exactly
                    $file_path = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesDT/' . $page_slug . '.php';

                    if (file_exists($file_path)) {
                        include $file_path;
                        exit; // Important to stop further execution
                    } else {
                        wp_die("❌ Le fichier <code>{$page_slug}.php</code> est introuvable.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }

    $pages_coord = [
        'encadrement_coordonnateur',
        'conventions',
        'sujetsmemoire',
        'soutenances_coord',
        'reclamation_coord',
        'rapport',
        'cours-planification-coord',


    ];

    foreach ($pages_coord as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm', 'um_coordonnateur-master'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/Master/CoordinateurMaster/' . $page_slug . '.php';
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


    $pages_PMO = [
        'alimentation-et-saisie-des-donnees',
        'depot-et-telechargement-des-donnees',
        'details-plateforme',
        'gestion-requetes',
        'presentation-ceip',



    ];

    foreach ($pages_PMO as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm', 'um_pmo	'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/PMO' . $page_slug . '.php';
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

    $pages_UTM = [
        'liste-de-laboratoires',
        'fiche-de-details-de-laboratoire'
    ];

    /* foreach ($pages_UTM as $page_slug) {
         if (is_page($page_slug)) {
             if (is_user_logged_in()) {
                 $current_user = wp_get_current_user();
                 $allowed_roles = ['um_service-etablissement', 'um_service-utm'];
                 if (array_intersect($allowed_roles, $current_user->roles)) {
                     ob_start();
                     include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages' . $page_slug . '.php';
                     echo ob_get_clean();
                     exit;
                 } else {
                     plateforme_redirect_home();
                 }
             } else {
                 plateforme_redirect_home();
             }
         }
     }*/

    foreach ($pages_UTM as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/' . $page_slug . '.php';
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
    } elseif (is_page('dashboardpmo')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_pmo', $user->roles)) {
                include plugin_dir_path(__FILE__) . '/Modules/PMO/DashboardPMO.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
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
    } elseif (is_page('examens')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/examens.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('absences')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/absences.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('emplois')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/emplois.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('stages')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/stages.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('profile2')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            include plugin_dir_path(__FILE__) . 'Modules/profile/profile.php';
            exit;

        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('messages')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            include plugin_dir_path(__FILE__) . 'Modules/Messages/messages.php';
            exit;

        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('contacts')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            include plugin_dir_path(__FILE__) . 'Modules/contact/contact.php';
            exit;

        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('details-master')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/details-master.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('bibliotheque')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/bibliotheque.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('support-pedagogiques')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/support-pedagogiques.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('soutenance')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/soutenance.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('formulaires-administratifs')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/formulaires-administratifs.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('notes-et-resultat')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/notes-et-resultat.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('reclamations')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/reclamations.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('suivi-reclamation')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/SuiviReclamations.php';
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    } elseif (is_page('ged')) {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('um_student_master', $user->roles)) {
                include plugin_dir_path(__FILE__) . 'Modules/Master/pagesstudentmaster/GED.php';
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
    // page profile 
    // if (is_page('mon-profile')) {
    //     if (is_user_logged_in()) {
    //         include plugin_dir_path(__FILE__) . 'Modules/profile/profile.php';
    //         exit;
    //     }

    //     wp_redirect(home_url());
    //     exit;
    // }



    // UTM
    // if (is_page('UTM')) {
    //     if (is_user_logged_in()) {
    //         include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/utm.php';
    //         exit;
    //     }

    //     wp_redirect(home_url());
    //     exit;
    // }
    // presentation-utm
    if (is_page('presentation-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/presentation-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    // coordonnees
    if (is_page('coordonnees')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/coordonnees.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }

    // publications-utm
    if (is_page('publications-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/publications-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    // publications-utm-details
    if (is_page('publications-utm-details')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/publications-utm-details.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    // projets-de-cooperation-utm
    if (is_page('projets-de-cooperation-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/projets-de-cooperation-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    // annonces-de-soutenances-utm
    if (is_page('annonces-de-soutenances-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/annonces-de-soutenances-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    //ouverture-sur-lenvironnement-utm
    if (is_page('ouverture-sur-lenvironnement-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/ouverture-sur-lenvironnement-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }

    //etablissements-utm-details
    if (is_page('etablissements-utm-details')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/etablissements-utm-details.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    //etablissements-utm
    if (is_page('etablissements-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/etablissements-utm.php';
            exit;
        }

        wp_redirect(home_url());
        exit;
    }
    //ouverture-sur-lenvironnement-utm
    if (is_page('structures-de-recherche-utm')) {
        if (is_user_logged_in()) {
            include plugin_dir_path(__FILE__) . 'Modules/SiteRecherche/structures-de-recherche-utm.php';
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
        'admissions-doctorants-etrangers-1',
        'fiche-dun-candidat-post-doc',
        'fiche-dune-candidature',
        // Ajouter d'auteres pages ici
        'soutenances-ecole-doctorale',
        'commission-doctorale-ecole-doctorale',
        'contacts-ecole-doctorale',
        'inscription-reinscription-ecole-doctorale',
        'dossier-inscription-ecole-doctorale',
    ];
    /*
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
            }*/
    foreach ($pages_ed as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();

                // Définir les rôles autorisés
                if (in_array($page_slug, ['inscription-et-reinscription', 'dossier-inscription'])) {
                    $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm', 'um_commission_ed'];
                } else {
                    $allowed_roles = ['um_ecole_doctorale', 'um_service-etablissement', 'um_service-utm'];
                }

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

    $pages_doctorant = [
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

    foreach ($pages_doctorant as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_doctorant'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesDoctorant/' . $page_slug . '.php';

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


    // Chargement automatique des pages LaboRecherche pour le rôle um_chercheur
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
        // Ajoutez 2 pages publications & ajouter-une-publication
        'publications-chercheur' => 'Publications.php',
        'ajouter-une-publication-chercheur' => 'AjouterUnePublication.php',
    ];

    foreach ($chercheur_pages as $page_slug => $filename) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_chercheur'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pageschercheur/' . $filename;

                    if (file_exists($file)) {
                        ob_start();
                        include $file;
                        echo ob_get_clean();
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$filename</code> est introuvable dans <code>pageschercheur</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }


    // Correspondance slug => nom réel du fichier (Commission ED)
    $commission_ed_pages = [
        'formation-doctorale_comissioned' => 'formation-doctorale_comissionEd.php',
        'formation-doctorale-fiche-d-une-formation-doctorale_comissioned' => 'formation-doctorale-fiche-d-une-formation-doctorale_comissionEd.php',
        'candidatures-ed_comissioned' => 'candidatures-ed_comissionEd.php',
        'fiche-candidatures-ed_comissioned' => 'fiche-candidatures-ed_comissionEd.php',
        'comissions-doctorale_comissioned' => 'comissions-doctorale_comissionEd.php',
        'fiche-reunion-comission_comissioned' => 'fiche-reunion-comission_comissionEd.php',
        'soutenances_comissioned' => 'soutenances_comissionEd.php',
        'planifier-soutenance_comissioned' => 'planifier-soutenance_comissionEd.php',
        'financements-et-conformite_comissioned' => 'financements-et-conformite_comissionEd.php',
        'fiche-de-financement_comissioned' => 'fiche-de-financement_comissionEd.php',
        'comites-de-suivi_comissioned' => 'comites-de-suivi_comissionEd.php',
        'fiche-de-comite-de-suivi_comissioned' => 'fiche-de-comite-de-suivi_comissionEd.php',
        'jurys-rapporteurs_comissioned' => 'jurys-rapporteurs_comissionEd.php',
        'fiche-de-composition-d-un-jury_comissioned' => 'fiche-de-composition-d-un-jury_comissionEd.php',
    ];
    foreach ($commission_ed_pages as $page_slug => $filename) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_commission_ed'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagescommission_ed/' . $filename;

                    if (file_exists($file)) {
                        ob_start();
                        include $file;
                        echo ob_get_clean();
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$filename</code> est introuvable dans <code>pageschercheur</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }

    // 🔁 Chargement automatique des pages ED dynamiques
    $pages_DL = [
        // 'reservation-des-equipements-et-salles',
        //'programmes-et-projets-de-recherches',
        //'programmes-et-projets-de-recherches-details-projet',
        // 'activites-scientifiques-directeur-labo',
        //'reseaux-de-la-recherche-directeur-labo',
        //'reseaux-de-la-recherche-details',
        //'activites-quotidiennes-directeur-labo',
        //'etat-d-avancement-des-projets',
        //'etat-d-avancement-des-projets-fiche-projet',
        //'financement-directeur-labo',
        //'financement-fiche-de-financement-directeur-labo',
        //'actualites-de-l-utm',
        //'article',
        //'membre-de-labo',
        //'membre-de-labo-fiche-membre',
        'fiche-labo',
        // Ajout des pages pour Directeur de Labo
        // 'publication-directeur-du-labo',
        // 'ajouter-une-publication-directeur-du-labo',
        // 'modifier-une-publication-directeur-du-labo',
        // 'details-publication-directeur-du-labo',
        // 'contacts-directeur-du-labo',
        // Ajout des pages pour Directeur de Labo 08/26/2025
        //'reclamations-directeur-du-labo',
        //'reunions-directeur-du-labo',
        //'rapports-directeur-du-labo',
        // 'activites-scientifiques-details',
        //'activites-quotidiennes-details',
        // 'profile-directeur-du-labo',
        //'ged-directeur-du-labo',
    ];

    foreach ($pages_DL as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_directeur_laboratoire', 'um_service-etablissement', 'um_service-utm'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pagesDirecteurlabo/' . $page_slug . '.php';

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

    // 🔁 Chargement automatique des pages pour Directeur et chercher.
    $Pages_communes = [
        'reservation-des-equipements-et-salles',
        'programmes-et-projets-de-recherches',
        'programmes-et-projets-de-recherches-details-projet_',
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
        'etat-d-avancement-des-projets',
        'etat-d-avancement-des-projets-fiche-projet',
        'rapports',
        'reclamations_',
        'reunions',
        'profile_',
        'ged_',
        'bibliotheques',
        'fiche-details-du-labo_',
        // add page Assiduité des chercheurs
        'assiduite-des-chercheurs',
    ];

    foreach ($Pages_communes as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_chercheur', 'um_directeur_laboratoire', 'um_service-etablissement', 'um_service-utm'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    $file = plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/pagesCommunes/' . $page_slug . '.php';

                    if (file_exists($file)) {
                        include $file;
                        exit;
                    } else {
                        wp_die("❌ Le fichier <code>$page_slug.php</code> est introuvable dans <code>pages_communes</code>.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }

    // 🔁 Chargement automatique des pages pour Directeur de Thèse (DT)
    $pages_DT = [
        'mes-doctorants_directeurth',
        'fiche-individuelle-du-doctorant_directeurth',
        'planning-des-r-eunions_directeurth',
        'fiche-candidatures-ed_directeurth',
        'evaluations-et-rapports_directeurth',
        'fiche-d-evaluation-annuelle_directeurth',
        'suivi-des-d-ep-ots_directeurth',
        'fiche-de-d-ep-ot_directeurth',
        'progression_directeurth',
        'planification-des-soutenances_directeurth',
        'publications-et-communications_directeurth',

        'manifestations-scientifiques-ed',
        'declarer-une-participation-ed',
        'reunions-ed',
    ];

    foreach ($pages_DT as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                // You might want to adjust these roles as needed
                $allowed_roles = ['um_directeur_these', 'um_service-etablissement', 'um_service-utm'];

                if (array_intersect($allowed_roles, $current_user->roles)) {
                    // The filename should match the slug exactly
                    $file_path = plugin_dir_path(__FILE__) . 'Modules/ED/pages/pagesDT/' . $page_slug . '.php';

                    if (file_exists($file_path)) {
                        include $file_path;
                        exit; // Important to stop further execution
                    } else {
                        wp_die("❌ Le fichier <code>{$page_slug}.php</code> est introuvable.");
                    }
                } else {
                    plateforme_redirect_home();
                }
            } else {
                plateforme_redirect_home();
            }
        }
    }


    $pages_coord = [
        'encadrement_coordonnateur',
        'conventions',
        'sujetsmemoire',
        'soutenances_coord',
        'reclamation_coord',
        'rapport',
        'cours-planification-coord',


    ];

    foreach ($pages_coord as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm', 'um_coordonnateur-master'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/Master/CoordinateurMaster/' . $page_slug . '.php';
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




    $pages_PMO = [
        'alimentation-et-saisie-des-donnees',
        'depot-et-telechargement-des-donnees',
        'details-plateforme',
        'gestion-requetes',
        'presentation-ceip',


    ];

    foreach ($pages_PMO as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm', 'um_pmo'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . '/Modules/PMO/' . $page_slug . '.php';
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

    $pages_UTM = [
        'liste-de-laboratoires',
        'fiche-de-details-de-laboratoire'
    ];
    /*
        foreach ($pages_UTM as $page_slug) {
            if (is_page($page_slug)) {
                if (is_user_logged_in()) {
                    $current_user = wp_get_current_user();
                    $allowed_roles = ['um_service-etablissement', 'um_service-utm'];
                    if (array_intersect($allowed_roles, $current_user->roles)) {
                        ob_start();
                        include plugin_dir_path(__FILE__) . '/Modules/LaboRecherche/pages' . $page_slug . '.php';
                        echo ob_get_clean();
                        exit;
                    } else {
                        plateforme_redirect_home();
                    }
                } else {
                    plateforme_redirect_home();
                }
            }
        }*/

    foreach ($pages_UTM as $page_slug) {
        if (is_page($page_slug)) {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $allowed_roles = ['um_service-etablissement', 'um_service-utm'];
                if (array_intersect($allowed_roles, $current_user->roles)) {
                    ob_start();
                    include plugin_dir_path(__FILE__) . 'Modules/LaboRecherche/pages/' . $page_slug . '.php';
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

// Injecte window.PMSettings et window.userId pour le JS
add_action('wp_enqueue_scripts', function () {
    // Charge un "handle" pour attacher l'inline (peut être ton bundle JS si tu en as un)
    wp_enqueue_script('messages-runtime', false, [], null, true);

    // restUrl = rest_url(), nonce = wp_create_nonce('wp_rest'), userId = ID courant
    wp_add_inline_script('messages-runtime', sprintf(
        'window.PMSettings=%s; window.userId=%d;',
        wp_json_encode([
            'restUrl' => rest_url(),                 // ex: https://site.tld/wp-json/
            'nonce' => wp_create_nonce('wp_rest'), // Nonce REST
        ]),
        get_current_user_id()
    ), 'before');
});

// Donner la capacité d'upload aux rôles front qui en ont besoin
add_action('init', function () {
    foreach (['administrator', 'editor', 'author', 'um_service-utm', 'um_directeur_laboratoire'] as $role_name) {
        if ($role = get_role($role_name)) {
            $role->add_cap('upload_files');
        }
    }
});