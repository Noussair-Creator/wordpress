<?php
add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/ping', [
        'methods' => 'GET',
        'callback' => function () {
            return ['status' => 'ok'];
        },
        'permission_callback' => '__return_true',
    ]);
});

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/masters-by-user', [
        'methods' => 'GET',
        'callback' => 'gm_api_get_masters_by_user',
        'permission_callback' => function () {
            $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
            return wp_verify_nonce($nonce, 'wp_rest');
        }
    ]);
});

function gm_api_get_masters_by_user() {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return gm_get_masters_by_user();
}


add_action('rest_api_init', function () {
    
    register_rest_route('plateforme-master/v1', '/coordinateurs', [
        'methods' => 'GET',
        'callback' => 'pm_api_get_coordinateurs_by_institut', // ✅ celui qui appelle le service
        'permission_callback' => function () {
            return is_user_logged_in();
        }
      ]);

});


function pm_api_get_coordinateurs_by_institut() {
    require_once dirname(__DIR__) . '/services/coordinateur-service.php';
    return pm_get_coordinateurs_by_institut();
}


// Api affecter corrdinateur 

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/coordinateurs/affecter', [
        'methods' => 'POST',
        'callback' => 'pm_api_affecter_coordinateur',
        'permission_callback' => function () {
            return is_user_logged_in();
        }
    ]);
});

function pm_api_affecter_coordinateur(WP_REST_Request $request) {
    require_once dirname(__DIR__) . '/services/coordinateur-service.php';
    return pm_affecter_coordinateur($request);
}

// MAJ MASTER
add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/masters/(?P<id>\d+)', [
      'methods' => 'PUT',
      'callback' => 'api_pm_update_master',
      'permission_callback' => function () {
        return is_user_logged_in();
    }
    ]);

});

function api_pm_update_master($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return pm_update_master($request);
}

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/objectifs/(?P<master_id>\d+)', [
        'methods'  => ['POST', 'PUT'],
        'callback' => 'api_update_objectifs_master', // ✅ le bon nom ici
        'permission_callback' => function () {
            return is_user_logged_in();
        },
    ]);
});

// ✅ Ton nouveau callback avec un nom unique
function api_update_objectifs_master($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return pm_update_objectifs_master($request); // la fonction réelle dans ton service
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/conditions/(?P<id>\d+)', [
      'methods'  => ['POST', 'PUT'],
      'callback' => 'api_update_conditions_admission',
      'permission_callback' => function () {
        return is_user_logged_in();
    }
    ]);
  });


function api_update_conditions_admission($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return update_conditions_admission($request); // la fonction réelle dans ton service
}

/*
add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/score/(?P<master_id>\d+)', [
      'methods'  => 'POST',
      'callback' => 'api_save_score_criteres',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ]);
});
  
function api_save_score_criteres($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return save_score_critere($request); // la fonction réelle dans ton service
}
*/
add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/plan-etude/(?P<id>\d+)', [
      'methods'             => 'POST',
      'callback'            => 'api_update_plan_etude',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ]);
  });
  


  function api_update_plan_etude($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return update_plan_etude($request); // la fonction réelle dans ton service
}


add_action('rest_api_init', function () {
register_rest_route('plateforme-master/v1', '/masters', [
    'methods' => 'POST',
    'callback' => 'api_insert_master',
    'permission_callback' => function () {
        return is_user_logged_in();
    }
  ]);
});
  function api_insert_master($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return insert_master($request); // la fonction réelle dans ton service
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/natures', [
      'methods' => 'GET',
      'callback' => function () {
        global $wpdb;
        $rows = $wpdb->get_results("SELECT id, libelle FROM {$wpdb->prefix}master_nature", ARRAY_A);
        return $rows;
      },
      'permission_callback' => '__return_true'
    ]);
  });
  

  add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/publier/(?P<id>\d+)', [
      'methods' => 'POST',
      'callback' => 'api_publish_master_session',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ]);
  });
  
function api_publish_master_session($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return publish_master_session($request); // la fonction réelle dans ton service
}

 add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/publier2/(?P<id>\d+)', [  
      'methods' => 'POST', 
      'callback' => 'api_publish_master_session2', 
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ]);
  });
  
function api_publish_master_session2($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return publish_master_session2($request); // la fonction réelle dans ton service 
}
/*
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/sessions-universitaires', [
      'methods' => 'GET',
      'callback' => 'api_get_sessions_universitaires',
      'permission_callback' => function () {
          $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
          return is_user_logged_in();
        }
  ]);
});

function api_get_sessions_universitaires() {
  require_once dirname(__DIR__) . '/services/gestion-master-service.php';
  return gm_api_get_sessions_universitaires(); // la fonction réelle dans ton service
}
*/

add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/sessions-universitaires', [
      'methods' => 'GET',
      'callback' => 'api_get_sessions_universitaires',
      'permission_callback' => function () {
          // Vérifie si l'utilisateur est connecté et que le nonce est valide
          $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
          return is_user_logged_in() && wp_verify_nonce($nonce, 'wp_rest');
      }
  ]);
});

function api_get_sessions_universitaires() {
  require_once dirname(__DIR__) . '/services/gestion-master-service.php';

  if (function_exists('gm_api_get_sessions_universitaires')) {
      return gm_api_get_sessions_universitaires(); // Appelle le service métier
  } else {
      return new WP_Error('fonction_absente', 'La fonction gm_api_get_sessions_universitaires est introuvable.', ['status' => 500]);
  }
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/update-profile', [
      'methods' => 'POST',
      'callback' => 'api_update_profile',
      'permission_callback' => function () {
          return is_user_logged_in();
      }
  ]);
});

function api_update_profile($request) {
  require_once dirname(__DIR__) . '/services/update-profile.php';
  return pm_api_update_profile($request); // la fonction réelle dans ton service
}

add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/liste-candidatures', [
      'methods' => 'GET',
      'callback' => 'pm_api_liste_candidatures_par_coordinateur',
      'permission_callback' => '__return_true' // À restreindre si besoin
  ]);
});
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/liste-candidatures-etudiant', [
      'methods' => 'GET',
      'callback' => 'pm_api_liste_candidatures_par_etudiant',
      'permission_callback' => '__return_true' // À restreindre si besoin
  ]);
});
/*
function pm_api_liste_candidatures_par_coordinateur($request) {
  global $wpdb;

  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;

  $sql = "SELECT 
            c.id AS candidature_id,
            mc.cin AS matricule,
            CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
            m.intitule_master AS master,
            c.score,
            c.etat AS statut_dossier,
            mc.statut_etudiant,
            m.annee_universitaire,

        FROM utm_master_candidatures c
        JOIN utm_master_candidats mc ON c.candidat_id = mc.id
        JOIN utm_master_fichemaster m ON c.master_id = m.id
        JOIN utm_master_coordinateurs cm ON cm.master_id = c.master_id
        WHERE cm.user_id = %d  and c.etat = 'soumis'
        Group by c.candidat_id
        ORDER BY c.date_soumission DESC
  ";

  $results = $wpdb->get_results($wpdb->prepare($sql, $user_id));

  return rest_ensure_response([
      'status' => 'success',
      'data' => $results
  ]);
}
*/


/*
function pm_api_liste_candidatures_par_coordinateur($request) {

  global $wpdb;


  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;

   $sql = "
    SELECT 
        c.id AS candidature_id,
        c.candidat_id,
        mc.cin AS matricule,
        CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
        m.intitule_master AS master,
        c.score,
        c.statut_dossier AS statut_dossier,
        mc.statut_etudiant,
        m.annee_universitaire,

        -- Situation académique
       
        sa.cycle AS sa_cycle,

        -- Score critères
        sc.critere_id,
        sc.champ,
        sc.valeur AS valeur_critere

        FROM {$wpdb->prefix}master_candidatures c
        JOIN {$wpdb->prefix}master_candidats mc ON c.candidat_id = mc.id
        JOIN {$wpdb->prefix}master_fichemaster m ON c.master_id = m.id
        JOIN {$wpdb->prefix}master_coordinateurs cm ON cm.master_id = c.master_id
        LEFT JOIN {$wpdb->prefix}candidats_situation_academique sa ON sa.candidat_id = mc.id
        LEFT JOIN {$wpdb->prefix}candidatures_score_criteres sc ON sc.candidature_id = c.id

        WHERE cm.user_id = %d AND c.etat = 'soumis'
        GROUP BY c.candidat_id 
        ORDER BY c.id  DESC
      ";




     // Résultat brut
      $results = $wpdb->get_results($wpdb->prepare($sql, $user_id), ARRAY_A);


      // Retour API
      return rest_ensure_response([
          'status' => 'success',
          'data' => array_values($results),
      ]);

}
*/


// function pm_api_liste_candidatures_par_coordinateur($request) {
//     global $wpdb;

//     $current_user = wp_get_current_user();
//     $user_id = $current_user->ID;
//     $roles = $current_user->roles;

//     // Récupérer institut_id de l'utilisateur depuis user_meta
//     $institut_id = get_user_meta($user_id, 'institut_id', true);

//     // Début requête commune
//     $base_sql = "
//         SELECT 
//             c.id AS candidature_id,
//             c.candidat_id,
//             mc.cin AS matricule,
//             CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
//             m.intitule_master AS master,
//             c.score,
//             c.statut_dossier AS statut_dossier,
//             mc.statut_etudiant,
//             m.annee_universitaire,
//             sa.cycle AS sa_cycle,
//             sc.critere_id,
//             sc.champ,
//             sc.valeur AS valeur_critere

//         FROM {$wpdb->prefix}master_candidatures c
//         JOIN {$wpdb->prefix}master_candidats mc ON c.candidat_id = mc.id
//         JOIN {$wpdb->prefix}master_fichemaster m ON c.master_id = m.id
//         LEFT JOIN {$wpdb->prefix}master_coordinateurs cm ON cm.master_id = c.master_id
//         LEFT JOIN {$wpdb->prefix}candidats_situation_academique sa ON sa.candidat_id = mc.id
//         LEFT JOIN {$wpdb->prefix}candidatures_score_criteres sc ON sc.candidature_id = c.id
//         WHERE c.etat = 'soumis'
//     ";

//     // Conditions selon le rôle
//     if (in_array('um_service-utm', $roles)) {
//         $where_clause = ""; // Aucun filtre
//         $prepared_sql = $base_sql;
//     } elseif (in_array('um_service-master', $roles)) {
//         $where_clause = " AND m.institut_id = %d";
//         $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
//         $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $institut_id), ARRAY_A);
//     } else {
//         // par défaut : coordinateur
//         $where_clause = " AND cm.user_id = %d";
//         $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
//         $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $user_id), ARRAY_A);
//     }

//     // Pour admin : même exécution sans prepare
//     if (in_array('um_service-utm', $roles)) {
//         $prepared_sql .= " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
//         $results = $wpdb->get_results($prepared_sql, ARRAY_A);
//     }

//     return rest_ensure_response([
//         'status' => 'success',
//         'data' => array_values($results),
//     ]);
// }


function pm_api_liste_candidatures_par_coordinateur($request) {
    global $wpdb;

    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    $roles = $current_user->roles;

    // Récupérer institut_id de l'utilisateur depuis user_meta
    $institut_id = get_user_meta($user_id, 'institut_id', true);

    // Début requête commune
    $base_sql = "
        SELECT 
            c.id AS candidature_id,
            c.candidat_id,
            mc.cin AS matricule,
            CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
            m.intitule_master AS master,
            c.score,
            c.statut_dossier AS statut_dossier,
            mc.statut_etudiant,
            m.annee_universitaire,
            sa.cycle AS sa_cycle,
            sc.critere_id,
            sc.champ,
            sc.valeur AS valeur_critere,
            i.nom
        FROM {$wpdb->prefix}master_candidatures c
        JOIN {$wpdb->prefix}master_candidats mc ON c.candidat_id = mc.id
        JOIN {$wpdb->prefix}master_fichemaster m ON c.master_id = m.id
        LEFT JOIN {$wpdb->prefix}master_coordinateurs cm ON cm.master_id = c.master_id
        LEFT JOIN {$wpdb->prefix}candidats_situation_academique sa ON sa.candidat_id = mc.id
        LEFT JOIN {$wpdb->prefix}candidatures_score_criteres sc ON sc.candidature_id = c.id
        LEFT JOIN {$wpdb->prefix}master_instituts i ON m.institut_id = i.id

        WHERE c.etat = 'soumis'
    ";
    // var_dump('$role' ,$roles );
    // Conditions selon le rôle
    if (in_array('um_service-utm', $roles)) {
        $where_clause = ""; // Aucun filtre
        $prepared_sql = $base_sql;
    } 
    elseif (in_array('um_service-master', $roles)) {
        $where_clause = " AND m.institut_id = %d";
        $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
        $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $institut_id), ARRAY_A);
    } 
    
    else if(in_array('um_coordonnateur-master', $roles))
    {
       $where_clause = " AND cm.coordinateur_id = %d";
        $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
        $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $user_id), ARRAY_A);
    }
    else {
        // par défaut : coordinateur
        $where_clause = " AND cm.user_id = %d";
        $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
        $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $user_id), ARRAY_A);
    }

    // Pour admin : même exécution sans prepare
    if (in_array('um_service-utm', $roles)) {
        $prepared_sql .= " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
        $results = $wpdb->get_results($prepared_sql, ARRAY_A);
    }

    return rest_ensure_response([
        'status' => 'success',
        'data' => array_values($results),
    ]);
}

function pm_api_liste_candidatures_par_etudiant($request) {
    global $wpdb;

    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    $roles = $current_user->roles;

    // Récupérer institut_id de l'utilisateur depuis user_meta
    $institut_id = get_user_meta($user_id, 'institut_id', true);

    // Début requête commune
    $base_sql = "
        SELECT 
            c.id AS candidature_id,
            c.candidat_id,
            mc.cin AS matricule,
            CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
            m.intitule_master AS master,
            c.score,
            c.statut_dossier AS statut_dossier,
            mc.statut_etudiant,
            m.annee_universitaire,
            sa.cycle AS sa_cycle,
            sc.critere_id,
            sc.champ,
            sc.valeur AS valeur_critere,
            i.nom
        FROM {$wpdb->prefix}master_candidatures c
        JOIN {$wpdb->prefix}master_candidats mc ON c.candidat_id = mc.id
        JOIN {$wpdb->prefix}master_fichemaster m ON c.master_id = m.id
        LEFT JOIN {$wpdb->prefix}master_coordinateurs cm ON cm.master_id = c.master_id
        LEFT JOIN {$wpdb->prefix}candidats_situation_academique sa ON sa.candidat_id = mc.id
        LEFT JOIN {$wpdb->prefix}candidatures_score_criteres sc ON sc.candidature_id = c.id
        LEFT JOIN {$wpdb->prefix}master_instituts i ON m.institut_id = i.id

        WHERE c.etat = 'soumis'
    ";
    // Conditions selon le rôle
        $where_clause = " AND c.candidat_id, = %d";
        $prepared_sql = $base_sql . $where_clause . " GROUP BY c.candidat_id , c.master_id ORDER BY c.id DESC";
        $results = $wpdb->get_results($wpdb->prepare($prepared_sql, $user_id), ARRAY_A);
  
    return rest_ensure_response([
        'status' => 'success',
        'data' => array_values($results),
    ]);
}


add_action('rest_api_init', function () {
  register_rest_route('utm/v1', '/candidatures', [
    'methods' => 'GET',
    'callback' => 'get_candidatures_by_coordinateur',
    'permission_callback' => function () {
      return current_user_can('read'); // ajustable selon rôle
    },
  ]);
});

function get_candidatures_by_coordinateur(WP_REST_Request $request) {
  global $wpdb;
  $user_id = get_current_user_id();

  $query = "
    SELECT 
      c.id AS candidature_id,
      mc.cin AS matricule,
      CONCAT(mc.nom, ' ', mc.prenom) AS etudiant,
      m.intitule_master AS master,
      c.score,
      c.etat AS statut_dossier,
      mc.statut_etudiant,
      m.annee_universitaire,
      m.diplomes_requis
    FROM utm_master_candidatures c
    JOIN utm_master_candidats mc ON c.candidat_id = mc.id
    JOIN utm_master_fichemaster m ON c.master_id = m.id
    JOIN utm_master_coordinateurs cm ON cm.master_id = c.master_id
    WHERE cm.user_id = %d 
    ORDER BY c.date_soumission DESC
  ";

  $results = $wpdb->get_results($wpdb->prepare($query, $user_id), ARRAY_A);

  return rest_ensure_response([
    'status' => 'success',
    'data' => $results
  ]);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/statut-coordinateur/(?P<id>\d+)', [
    'methods'  => 'POST',
    'callback' => 'api_update_statut_coordinateur',
    'permission_callback' => function () {
      return is_user_logged_in();
    }
  ]);
});

function api_update_statut_coordinateur($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return update_statut_coordinateur($request); // la fonction réelle dans ton service
}

add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/score/(?P<master_id>\d+)', [
    'methods' => 'POST',
    'callback' => 'api_save_score_data',
    'permission_callback' => function () {
      return is_user_logged_in();
    }
  ]);
});
function api_save_score_data($request) {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return save_score_data($request); // la fonction réelle dans ton service
}

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/masters-formules-statut', [
        'methods' => 'GET',
        'callback' => 'gm_api_get_masters_with_formules_statut',
        'permission_callback' => function () {
             return is_user_logged_in();
        }
    ]);
});

function gm_api_get_masters_with_formules_statut() {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return gm_get_masters_with_formules_statut();
}
add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/valider-formule-score', [
    'methods' => 'POST',
    'callback' => function ($request) {
      require_once dirname(__DIR__) . '/services/gestion-master-service.php';
      return valider_formule_score($request); // ✅ passe $request correctement
    },
    'permission_callback' => function () {
      $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
      return wp_verify_nonce($nonce, 'wp_rest');
    }
  ]);
});

function api_valider_formule_score() {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return valider_formule_score($request);
}

add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/creer-appel', [
    'methods' => 'POST',
    'callback' => function ($request) {
      require_once dirname(__DIR__) . '/services/gestion-master-service.php';
      return creer_appel_candidature($request); // ✅ passe $request correctement
    },
    'permission_callback' => function () {
      $nonce = $_SERVER['HTTP_X_WP_NONCE'] ?? '';
      return wp_verify_nonce($nonce, 'wp_rest');
    }
  ]);
});


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/appels', [
    'methods' => 'GET',
    'callback' => 'api_get_appels_candidature',
    'permission_callback' => function () {   
            return is_user_logged_in();
        }
  ]);
});



function api_get_appels_candidature() {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php';
    return get_appels_candidature();
}




/**** fiche Candidature  *******/

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/statuts-dossier', [
        'methods'  => 'GET',
        'callback' => 'get_statuts_dossier',
        'permission_callback' => '__return_true'
    ]);
});

function get_statuts_dossier() {
    global $wpdb;

    $table = "{$wpdb->prefix}statuts_dossier";
    $results = $wpdb->get_results("SELECT code, libelle FROM $table WHERE actif = 1 ORDER BY ordre_affichage", ARRAY_A);

    return rest_ensure_response([
        'status' => 'success',
        'data' => $results
    ]);
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/fiche-candidature/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'pm_get_fiche_candidature',
        'permission_callback' => '__return_true'
    ]);
});


function pm_get_fiche_candidature($data) {
    global $wpdb;
    $id = (int) $data['id'];
 
    // Candidature principale
    $candidature = $wpdb->get_row($wpdb->prepare("
        SELECT c.*, 
               mc.nom, mc.prenom, mc.cin, mc.email1, mc.telephone, 
               m.intitule_master, m.annee_universitaire, mc.statut_etudiant, c.statut_dossier
        FROM {$wpdb->prefix}master_candidatures c
        JOIN {$wpdb->prefix}master_candidats mc ON c.candidat_id = mc.id
        JOIN {$wpdb->prefix}master_fichemaster m ON c.master_id = m.id
        WHERE c.id = %d
    ", $id), ARRAY_A);

    if (!$candidature) {
        return new WP_Error('not_found', 'Candidature introuvable.', ['status' => 404]);
    }

    // Situation académique
    $situation = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}candidats_situation_academique WHERE candidat_id = %d
    ", $candidature['candidat_id']), ARRAY_A);

    // Parcours
    /*$parcours = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}candidats_parcours_annees WHERE candidat_id = %d
    ", $candidature['candidat_id']), ARRAY_A);*/


      $parcours = $wpdb->get_results($wpdb->prepare("
        SELECT 
            cpa.*,
            ue.nom AS nom_etablissement,
            uu.nom_universite	AS nom_universite
        FROM {$wpdb->prefix}candidats_parcours_annees AS cpa
        LEFT JOIN {$wpdb->prefix}etablissements AS ue ON cpa.etablissement = ue.id
        LEFT JOIN {$wpdb->prefix}universites AS uu ON cpa.universite = uu.id
        WHERE cpa.candidat_id = %d
    ", $candidature['candidat_id']), ARRAY_A);

 


    // Années blanches
    $blanches = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}candidats_annees_blanches WHERE candidat_id = %d
    ", $candidature['candidat_id']), ARRAY_A);

    $criteres = $wpdb->get_results($wpdb->prepare("
      SELECT * FROM {$wpdb->prefix}candidatures_score_criteres WHERE candidature_id = %d
    ", $id), ARRAY_A);

    $formatted = [];

    foreach ($criteres as $row) {
      $critere_id = $row['critere_id'];
      $champ = $row['champ'];
      $valeur = $row['valeur'];
      $label = '';

      if ($critere_id) {
        // 🔎 Cas 1 : récupérer le champ depuis master_score_criteres
        $label = $wpdb->get_var($wpdb->prepare("
          SELECT champ FROM {$wpdb->prefix}master_score_criteres WHERE id = %d LIMIT 1
        ", $critere_id));
      } elseif (strpos($champ, 'matiere_id_') === 0) {
        // 🔎 Cas 2 : extraire l’ID et chercher dans utm_master_score_matieres
        $matiere_id = intval(str_replace('matiere_id_', '', $champ));
        $label = $wpdb->get_var($wpdb->prepare("
          SELECT matiere FROM {$wpdb->prefix}master_score_matieres WHERE id = %d LIMIT 1
        ", $matiere_id));

        $label = 'Matière '.$label;
      } else {
        // 🔎 Cas 3 : champ brut (malus_redoublement, interruption...)
        $label = ucwords(str_replace('_', ' ', $champ));
      }

        // ✅ Ajouter au tableau formaté
        $formatted[] = [
          'label'  => $label ?: $champ,
          'valeur' => $valeur
        ];
    }


    // Statut dossier
    $statut = $wpdb->get_row($wpdb->prepare("
        SELECT libelle FROM {$wpdb->prefix}statuts_dossier WHERE code = %s
    ", $candidature['statut_dossier']), ARRAY_A);


    // Adresse du candidat (type_adresse = 'principale' ou prendre la plus récente)
    $adresse = $wpdb->get_row($wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}master_candidats_adresses
        WHERE candidat_id = %d
        ORDER BY id DESC
        LIMIT 1
    ", $candidature['candidat_id']), ARRAY_A);

    return rest_ensure_response([
        'status' => 'success',
        'data' => [
            'candidature' => $candidature,
            'statut_libelle' => $statut['libelle'] ?? $candidature['statut_dossier'],
            'situation_academique' => $situation,
            'parcours' => $parcours,
            'annees_blanches' => $blanches,
            'criteres_score' => $formatted,
            'adresse'  => $adresse
        ]
    ]);
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/modifier-statut-dossier', [
        'methods'  => 'POST',
        'callback' => 'pm_modifier_statut_dossier_by_id',
        'permission_callback' => '__return_true' // 🔒 à sécuriser selon ton besoin
    ]);
});

function pm_modifier_statut_dossier_by_id($request) {
    global $wpdb;

    $params = $request->get_json_params();
    $candidature_id = isset($params['candidature_id']) ? (int) $params['candidature_id'] : 0;
    $statut_dossier = sanitize_text_field($params['statut_dossier']);

    if (!$candidature_id || empty($statut_dossier)) {
        return new WP_Error('invalid_data', 'ID ou statut manquant.', ['status' => 400]);
    }

    $updated = $wpdb->update(
        "{$wpdb->prefix}master_candidatures",
        ['statut_dossier' => $statut_dossier],
        ['id' => $candidature_id]
    );

    if ($updated !== false) {
        return rest_ensure_response(['success' => true]);
    }

    return new WP_Error('update_failed', 'Erreur lors de la mise à jour.', ['status' => 500]);
}

add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/entretiens-valides', [
        'methods' => 'GET',
        'callback' => 'get_candidats_entretiens_valides',
        'permission_callback' => '__return_true'
    ]);
});

function get_candidats_entretiens_valides(WP_REST_Request $request) {
    global $wpdb;

    $sql = "
        SELECT 
            mc.id AS candidature_id,
            c.nom,
            c.prenom,
            CONCAT(c.prenom, ' ', c.nom) AS etudiant,
            mc.statut_dossier,
            e.id AS entretien_id,
            e.date_entretien,
            e.heure_entretien,
            e.note,
            os.formule_json
        FROM {$wpdb->prefix}master_candidatures mc
        INNER JOIN {$wpdb->prefix}master_candidats c ON mc.candidat_id = c.id
        LEFT JOIN {$wpdb->prefix}candidature_entretiens e ON mc.id = e.candidature_id
        LEFT JOIN {$wpdb->prefix}master_score os ON mc.master_id = os.master_id 
        WHERE mc.statut_dossier = 'Validé'
        ORDER BY mc.id DESC
    ";



    $results = $wpdb->get_results($sql, ARRAY_A);

    foreach ($results as &$r) {
        $r['etat_entretien'] = $r['entretien_id'] ? 'Déjà envoyé' : '-';
    }

    return rest_ensure_response($results);
}



add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/ajouter-entretien', [
    'methods'  => 'POST',
    'callback' => 'api_ajouter_entretien',
    'permission_callback' => function () {
            return is_user_logged_in();
    }
  ]);
});


function api_ajouter_entretien(WP_REST_Request $request) {
  global $wpdb;

  $table = "{$wpdb->prefix}candidature_entretiens";
  $etat_valide = ['prévu', 'effectué', 'annulé'];
  $type = $request->get_param('type');
  $candidature_id = intval($request->get_param('candidature_id'));

  if (!$candidature_id) {
    return new WP_REST_Response(['success' => false, 'message' => 'ID candidature requis.'], 400);
  }

  // 🎯 Cas spécial : type = evaluation
  if ($type === 'evaluation') {
    $note = $request->get_param('note');
    $commentaire = $request->get_param('commentaire');
    $etat = $request->get_param('etat');

    $data = [
      'note'        => is_numeric($note) ? floatval($note) : null,
      'commentaire' => sanitize_textarea_field($commentaire),
      'etat'        => in_array($etat, $etat_valide) ? $etat : 'effectué',
      'updated_at'  => current_time('mysql'),
    ];

    $updated = $wpdb->update($table, $data, ['candidature_id' => $candidature_id]);

    if ($updated !== false) {
      return new WP_REST_Response([
        'success' => true,
        'id' => $candidature_id,
        'action' => 'evaluation_updated'
      ], 200);
    } else {
      return new WP_REST_Response([
        'success' => false,
        'message' => 'Échec de la mise à jour de l’évaluation.',
        'mysql_error' => $wpdb->last_error
      ], 500);
    }
  }

  // 🎯 Cas normal : invitation
  $data = [
    'candidature_id'  => $candidature_id,
    'titre'           => sanitize_text_field($request->get_param('titre')),
    'contenu'         => wp_kses_post($request->get_param('contenu')),
    'date_entretien'  => $request->get_param('date'),
    'heure_entretien' => $request->get_param('heure'),
    'etat'            => in_array($request->get_param('etat'), $etat_valide) ? $request->get_param('etat') : 'prévu',
    'updated_at'      => current_time('mysql'),
  ];

  $existing = $wpdb->get_var($wpdb->prepare(
    "SELECT id FROM $table WHERE candidature_id = %d",
    $candidature_id
  ));

  if ($existing) {
    $updated = $wpdb->update($table, $data, ['candidature_id' => $candidature_id]);

    if ($updated !== false) {
      return new WP_REST_Response(['success' => true, 'id' => $existing, 'action' => 'updated'], 200);
    }
  } else {
    $data['created_at'] = current_time('mysql');
    $inserted = $wpdb->insert($table, $data);

    if ($inserted) {
      return new WP_REST_Response([
        'success' => true,
        'id' => $wpdb->insert_id,
        'action' => 'inserted'
      ], 200);
    }
  }

  return new WP_REST_Response([
    'success' => false,
    'message' => 'Échec insertion ou mise à jour.',
    'mysql_error' => $wpdb->last_error
  ], 500);
}




add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/entretien/(?P<candidature_id>\d+)', [
    'methods'  => 'GET',
    'callback' => 'api_get_entretien_by_candidature',
    'permission_callback' => '__return_true'
  ]);
});

function api_get_entretien_by_candidature($request) {
  global $wpdb;
  $candidature_id = intval($request['candidature_id']);
  $table = $wpdb->prefix . 'candidature_entretiens';

  $entretien = $wpdb->get_row($wpdb->prepare("
    SELECT * FROM $table WHERE candidature_id = %d LIMIT 1
  ", $candidature_id), ARRAY_A);

  if ($entretien) {
    return new WP_REST_Response($entretien, 200);
  } else {
    return new WP_REST_Response(null, 204); // Pas trouvé
  }
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/statuts-resultats', [
    'methods' => 'GET',
    'callback' => 'api_get_statuts_resultats',
    'permission_callback' => '__return_true'
  ]);
});

function api_get_statuts_resultats(WP_REST_Request $request) {
  global $wpdb;

  $table = "{$wpdb->prefix}statuts_resultats";

  $resultats = $wpdb->get_results("
    SELECT code, libelle FROM $table
    WHERE actif = 1
    ORDER BY ordre ASC
  ", ARRAY_A);

  return new WP_REST_Response($resultats, 200);
}


add_action('rest_api_init', function () {
  register_rest_route('plateforme-master/v1', '/set-statut-resultat', [
    'methods' => 'POST',
    'callback' => 'api_set_statut_resultat',
    'permission_callback' => '__return_true'
  ]);
});

function api_set_statut_resultat(WP_REST_Request $request) {
  global $wpdb;

  $ids = $request->get_param('candidature_ids');
  $statut = sanitize_text_field($request->get_param('statut'));
  $libelle = sanitize_text_field($request->get_param('libelle'));

  if (!is_array($ids) || empty($ids) || !$statut || !$libelle) {
    return new WP_REST_Response(['success' => false, 'message' => 'Paramètres invalides.'], 400);
  }

  $table = "{$wpdb->prefix}master_candidatures";
  $errors = [];
  $now = current_time('mysql');

  /*foreach ($ids as $id) {
    $id = intval($id);
    $result = $wpdb->update(
      $table,
      [
        'statut_decision_finale' => $statut,
        'libelle_resultat'       => $libelle,
        'date_decision_finale'   => $now
      ],
      ['id' => $id]
    );

    if ($result === false) {
      $errors[] = "ID $id : " . $wpdb->last_error;
    }
  }*/

  foreach ($ids as $id) {
    $id = intval($id);
    $result = $wpdb->update(
      $table,
      [
        'statut_decision_finale' => $statut,
        'libelle_resultat'       => $libelle,
        'date_decision_finale'   => $now
      ],
      ['id' => $id]
    );

    if ($result === false) {
      $errors[] = "ID $id : " . $wpdb->last_error;
      continue;
    }

      // 🔔 Envoi email résultat
      $candidat = $wpdb->get_row("
          SELECT um.user_id
          FROM {$wpdb->prefix}master_candidatures mc
          JOIN {$wpdb->prefix}usermeta um ON um.meta_key = 'candidat_id' AND um.meta_value = mc.candidat_id
          WHERE mc.id = $id
          LIMIT 1
        ");

      if ($candidat && $candidat->user_id) {
        email_inscription_envoyer_resultat_candidat($candidat->user_id, $libelle);
      }

      
  }


  if (empty($errors)) {
    return new WP_REST_Response(['success' => true], 200);
  }

  return new WP_REST_Response([
    'success' => false,
    'message' => 'Une ou plusieurs mises à jour ont échoué.',
    'details' => $errors
  ], 500);
}


add_action('rest_api_init', function () {
    register_rest_route('plateforme-master/v1', '/score-templates', [
        'methods'  => 'GET',
        'callback' => 'pm_api_get_score_templates',
        'permission_callback' => '__return_true'
    ]);
});


function pm_api_get_score_templates() {
    require_once dirname(__DIR__) . '/services/gestion-master-service.php'; // 📂 chemin vers ton fichier service
    return pm_get_score_templates(); // ✅ fonction service propre
}
