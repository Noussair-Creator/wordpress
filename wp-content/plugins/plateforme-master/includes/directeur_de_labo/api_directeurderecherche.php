<?php
/** API directeurderecherche — Namespace plateforme-directeur-de-labo/v2 — généré automatiquement */
$__svc_candidates = array(
  __DIR__ . '/services_directeurderecherche.php',
  dirname(__DIR__, 1) . '/services_directeurderecherche.php',
  dirname(__DIR__, 1) . '/services/services_directeurderecherche.php',
  dirname(__DIR__, 2) . '/services/directeur_de_labo/services_directeurderecherche.php'
);
foreach ($__svc_candidates as $__p) {
  if (file_exists($__p)) {
    require_once $__p;
    break;
  }
}
unset($__p, $__svc_candidates);

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/test', array(
    'methods' => 'GET',
    'callback' => function () {
      return array('message' => 'ok');
    },
    'permission_callback' => '__return_true'
  ));
});

// Paramètres/validation pour activite_doc
function pm_svc_activite_doc_args_create()
{
  return array(
    'activite_id' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'fichier' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}
function pm_svc_activite_doc_args_update()
{
  return array(
    'activite_id' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'fichier' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/activite_doc', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_activite_doc_list',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'POST',
      'callback' => 'pm_svc_activite_doc_create',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => pm_svc_activite_doc_args_create()
    )
  ));
  register_rest_route($ns, '/activite_doc/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_activite_doc_get',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'PATCH',
      'callback' => 'pm_svc_activite_doc_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_activite_doc_args_update())
    ),
    array(
      'methods' => 'PUT',
      'callback' => 'pm_svc_activite_doc_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_activite_doc_args_update())
    ),
    array(
      'methods' => 'DELETE',
      'callback' => 'pm_svc_activite_doc_delete',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    )
  ));
});

// Paramètres/validation pour activite_indicateur
function pm_svc_activite_indicateur_args_create()
{
  return array(
    'activite_id' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'resultat_obtenu' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}
function pm_svc_activite_indicateur_args_update()
{
  return array(
    'activite_id' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'resultat_obtenu' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/activite_indicateur', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_activite_indicateur_list',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'POST',
      'callback' => 'pm_svc_activite_indicateur_create',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => pm_svc_activite_indicateur_args_create()
    )
  ));
  register_rest_route($ns, '/activite_indicateur/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_activite_indicateur_get',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'PATCH',
      'callback' => 'pm_svc_activite_indicateur_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_activite_indicateur_args_update())
    ),
    array(
      'methods' => 'PUT',
      'callback' => 'pm_svc_activite_indicateur_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_activite_indicateur_args_update())
    ),
    array(
      'methods' => 'DELETE',
      'callback' => 'pm_svc_activite_indicateur_delete',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    )
  ));
});


// Paramètres/validation pour chercheur
function pm_svc_chercheur_args_create()
{
  return array(
    'email' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'nom' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}
function pm_svc_chercheur_args_update()
{
  return array(
    'email' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'nom' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/chercheur', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_chercheur_list',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'POST',
      'callback' => 'pm_svc_chercheur_create',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => pm_svc_chercheur_args_create()
    )
  ));
  register_rest_route($ns, '/chercheur/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_chercheur_get',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'PATCH',
      'callback' => 'pm_svc_chercheur_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_chercheur_args_update())
    ),
    array(
      'methods' => 'PUT',
      'callback' => 'pm_svc_chercheur_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_chercheur_args_update())
    ),
    array(
      'methods' => 'DELETE',
      'callback' => 'pm_svc_chercheur_delete',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    )
  ));
});

// Paramètres/validation pour laboratoire_membre
function pm_svc_laboratoire_membre_args_create()
{
  return array(
    'chercheur_id' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_numeric($param);
      },
      'sanitize_callback' => 'absint'
    ),
    'laboratoire_id' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_numeric($param);
      },
      'sanitize_callback' => 'absint'
    ),
    'role' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'equipe_recherche' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'statut' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}
function pm_svc_laboratoire_membre_args_update()
{
  return array(
    'chercheur_id' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_numeric($param);
      },
      'sanitize_callback' => 'absint'
    ),
    'laboratoire_id' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_numeric($param);
      },
      'sanitize_callback' => 'absint'
    ),
    'role' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'equipe_recherche' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'statut' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/laboratoire_membre', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_laboratoire_membre_list',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'POST',
      'callback' => 'pm_svc_laboratoire_membre_create',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => pm_svc_laboratoire_membre_args_create()
    )
  ));
  register_rest_route($ns, '/laboratoire_membre/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => 'pm_svc_laboratoire_membre_get',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'PATCH',
      'callback' => 'pm_svc_laboratoire_membre_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_laboratoire_membre_args_update())
    ),
    array(
      'methods' => 'PUT',
      'callback' => 'pm_svc_laboratoire_membre_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), pm_svc_laboratoire_membre_args_update())
    ),
    array(
      'methods' => 'DELETE',
      'callback' => 'pm_svc_laboratoire_membre_delete',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    )
  ));
});

// Paramètres/validation pour laboratoire
function svc_directeur_de_labo_laboratoire_args_create()
{
  return array(
    'logo_laboratoire' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'nom' => array(
      'required' => true,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    // The 'etablissement' field is no longer passed by the client.
    'date_de_creation' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_string($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'etat' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return in_array($param, array('actif', 'inactif'));
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'objectif_general' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_textarea_field'
    ),
    'axes_de_recherche' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_textarea_field'
    ),
  );
}
function svc_directeur_de_labo_laboratoire_args_update()
{
  return array(
    'logo_laboratoire' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'nom' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    // The 'etablissement' field is not updatable via this endpoint.
    'date_de_creation' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_string($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'etat' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return in_array($param, array('actif', 'inactif'));
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'objectif_general' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_textarea_field'
    ),
    'axes_de_recherche' => array(
      'required' => false,
      'validate_callback' => function ($param) {
        return is_scalar($param);
      },
      'sanitize_callback' => 'sanitize_textarea_field'
    ),
  );
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';
  register_rest_route($ns, '/laboratoire', array(
    array(
      'methods' => 'GET',
      'callback' => 'svc_directeur_de_labo_laboratoire_list',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'POST',
      'callback' => 'svc_directeur_de_labo_laboratoire_create',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => svc_directeur_de_labo_laboratoire_args_create()
    )
  ));
  register_rest_route($ns, '/laboratoire/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => 'svc_directeur_de_labo_laboratoire_get',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ),
    array(
      'methods' => 'PATCH',
      'callback' => 'svc_directeur_de_labo_laboratoire_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), svc_directeur_de_labo_laboratoire_args_update())
    ),
    array(
      'methods' => 'PUT',
      'callback' => 'svc_directeur_de_labo_laboratoire_update',
      'permission_callback' => function () {
        return is_user_logged_in();
      },
      'args' => array_merge(array(
        'id' => array(
          'required' => true,
          'validate_callback' => function ($p) {
            return is_numeric($p);
          }
        )
      ), svc_directeur_de_labo_laboratoire_args_update())
    ),
    array(
      'methods' => 'DELETE',
      'callback' => 'svc_directeur_de_labo_laboratoire_delete',
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    )
  ));
});