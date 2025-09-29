<?php
/** API directeurderecherche — Namespace plateforme-directeurderecherche/v1 — généré automatiquement */
$__svc_candidates = array(
  __DIR__ . '/services_directeurderecherche.php',
  dirname(__DIR__, 1) . '/services_directeurderecherche.php',
  dirname(__DIR__, 1) . '/services/services_directeurderecherche.php',
  dirname(__DIR__, 2) . '/services/recherche/services_directeurderecherche.php'
);
foreach ($__svc_candidates as $__p) { if (file_exists($__p)) { require_once $__p; break; } }
unset($__p, $__svc_candidates);

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/test', array(
    'methods' => 'GET', 'callback' => function(){ return array('message'=>'ok'); }, 'permission_callback' => '__return_true' ));
});



add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';

  register_rest_route($ns, '/categories-equipements', array(
    'methods'  => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function() {
      global $wpdb;
      $t = $wpdb->prefix . 'recherche_categorie_equipement';
      // id, code, intitule existent dans la table. :contentReference[oaicite:2]{index=2}
      return $wpdb->get_results("SELECT id, code, intitule FROM $t WHERE actif=1 ORDER BY intitule ASC", ARRAY_A);
    }
  ));

  register_rest_route($ns, '/disponibilites-equipements', array(
    'methods'  => 'GET',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'callback' => function() {
      global $wpdb;
      $t = $wpdb->prefix . 'recherche_disponibilite_equipement';
      // id, code, intitule existent dans la table. :contentReference[oaicite:3]{index=3}
      return $wpdb->get_results("SELECT id, code, intitule FROM $t WHERE actif=1 ORDER BY id ASC", ARRAY_A);
    }
  ));
});


// Paramètres/validation pour equipement
// === EQUIPAMENT API ===

function svc_equipement_args_create() { 
  return array(
    'categorie_id' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_numeric($v); },
      'sanitize_callback' => 'absint'
    ),
    'disponibilite_id' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_numeric($v); },
      'sanitize_callback' => 'absint'
    ),
    'modele' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_string($v) && $v !== ''; },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'nom_appareil' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_string($v) && $v !== ''; },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'statut' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_string($v) && $v !== ''; },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    // NB: le champ en BD s'appelle 'spcification_technique' (orthographe d'origine)
    'spcification_technique' => array(
      'required' => false,
      'validate_callback' => function($v){ return is_scalar($v); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
  );
}

function svc_equipement_args_update() {
  $base = svc_equipement_args_create();
  // Tous facultatifs en PATCH/PUT
  foreach ($base as &$def) { $def['required'] = false; }
  return $base;
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/equipement', array(
    array('methods'=>'GET','callback'=>'svc_equipement_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_equipement_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_equipement_args_create())
  ));
  register_rest_route($ns, '/equipement/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_equipement_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_equipement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(
      array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})),
      svc_equipement_args_update()
    )),
    array('methods'=>'PUT','callback'=>'svc_equipement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(
      array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})),
      svc_equipement_args_update()
    )),
    array('methods'=>'DELETE','callback'=>'svc_equipement_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});
// === CONDITIONS D’ENTRETIEN — ROUTES REST ===
add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';

  // Liste + création
  register_rest_route($ns, '/conditions_entretien', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_conditions_entretien_list',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
    array(
      'methods'  => 'POST',
      'callback' => 'svc_conditions_entretien_create',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => svc_conditions_entretien_args_create()
    ),
  ));

  // Lecture / MAJ / suppression par id
  register_rest_route($ns, '/conditions_entretien/(?P<id>\d+)', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_conditions_entretien_get',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
    array(
      'methods'  => 'PATCH',
      'callback' => 'svc_conditions_entretien_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})),
        svc_conditions_entretien_args_update()
      )
    ),
    array(
      'methods'  => 'DELETE',
      'callback' => 'svc_conditions_entretien_delete',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));
});



// Paramètres/validation pour activite_doc
function svc_activite_doc_args_create(){ return array(
    'activite_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_doc_args_update(){ return array(
    'activite_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_doc', array(
    array('methods'=>'GET','callback'=>'svc_activite_doc_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_doc_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_doc_args_create())
  ));
  register_rest_route($ns, '/activite_doc/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_doc_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_activite_doc_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_doc_args_update())),
    array('methods'=>'PUT','callback'=>'svc_activite_doc_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_doc_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_doc_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour activite_indicateur
function svc_activite_indicateur_args_create(){ return array(
    'activite_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resultat_obtenu' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_indicateur_args_update(){ return array(
    'activite_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resultat_obtenu' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_indicateur', array(
    array('methods'=>'GET','callback'=>'svc_activite_indicateur_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_indicateur_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_indicateur_args_create())
  ));
  register_rest_route($ns, '/activite_indicateur/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_indicateur_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_activite_indicateur_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_indicateur_args_update())),
    array('methods'=>'PUT','callback'=>'svc_activite_indicateur_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_indicateur_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_indicateur_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour activite_quotidienne
function svc_activite_quotidienne_args_create(){ return array(
    'date' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_debut' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_fin' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type_activite' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_quotidienne_args_update(){ return array(
    'date' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_debut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_fin' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type_activite' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_quotidienne', array(
    array('methods'=>'GET','callback'=>'svc_activite_quotidienne_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_quotidienne_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_quotidienne_args_create())
  ));
  register_rest_route($ns, '/activite_quotidienne/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_quotidienne_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PUT','callback'=>'svc_activite_quotidienne_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_quotidienne_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_quotidienne_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
  register_rest_route('plateforme-directeurderecherche/v1', '/activite_quotidienne/(?P<id>\d+)', [
  [
    'methods'  => ['PATCH','POST'],
    'callback' => 'svc_activite_quotidienne_update',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'args' => array_merge(
      [
        'id' => [
          'required' => true,
          'validate_callback' => function($param) {
            return is_numeric($param);
          }
        ]
      ],
      svc_activite_quotidienne_args_update()
    )
  ]
]);

});



add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/stats-activites-quotidiennes', [
    'methods'  => 'GET',
    'callback' => 'svc_stats_activite_quotidienne',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ]);
});
add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';

  register_rest_route($ns, '/types-activite-quotidienne', [
    'methods'  => 'GET',
    'callback' => 'svc_type_activite_quotidienne_list',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ]);
});


/*
// Paramètres/validation pour activite_scientifique
function svc_activite_scientifique_args_create(){ return array(
    'annee' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'auteur_principal' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre_reference' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_scientifique_args_update(){ return array(
    'annee' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'auteur_principal' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre_reference' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
*/

// Paramètres/validation pour activite_scientifique
function svc_activite_scientifique_args_create(){ 
  return array(
    'annee' => array(
      'required' => true,
      'validate_callback' => function($param){ return is_scalar($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'user_id' => array(
      'required' => true,
      'validate_callback' => function($param){ return is_numeric($param); },
      'sanitize_callback' => 'absint'
    ),
    'titre_reference' => array(
      'required' => true,
      'validate_callback' => function($param){ return is_scalar($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'type_id' => array(
      'required' => true,
      'validate_callback' => function($param){ return is_scalar($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'Source' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_scalar($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'piece_jointe_path' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_scalar($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
  );
}

function svc_activite_scientifique_args_update(){ 
  $args = svc_activite_scientifique_args_create();
  // tous facultatifs en update
  foreach ($args as &$def){ $def['required'] = false; }
  return $args;
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_scientifique', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_scientifique_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_scientifique_args_create())
  ));
  register_rest_route($ns, '/activite_scientifique/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array(
      'methods'  => ['PATCH','POST'], // accepte PATCH et POST
      'callback' => 'svc_activite_scientifique_update',
      'permission_callback' => function(){ return is_user_logged_in(); }
    
      
    ),
    array('methods'=>'PUT','callback'=>'svc_activite_scientifique_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_scientifique_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_scientifique_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour activite_scientifique_doc
function svc_activite_scientifique_doc_args_create(){ return array(
    'activite_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_scientifique_doc_args_update(){ return array(
    'activite_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_scientifique_doc', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_doc_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_scientifique_doc_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_scientifique_doc_args_create())
  ));
  register_rest_route($ns, '/activite_scientifique_doc/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_doc_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_activite_scientifique_doc_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_scientifique_doc_args_update())),
    array('methods'=>'PUT','callback'=>'svc_activite_scientifique_doc_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_scientifique_doc_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_scientifique_doc_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour actualite
function svc_actualite_args_create(){ return array(); }
function svc_actualite_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/actualite', array(
    array('methods'=>'GET','callback'=>'svc_actualite_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_actualite_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_actualite_args_create())
  ));
  register_rest_route($ns, '/actualite/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_actualite_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_actualite_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_actualite_args_update())),
    array('methods'=>'PUT','callback'=>'svc_actualite_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_actualite_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_actualite_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour actualite_labo
function svc_actualite_labo_args_create(){ return array(
    'categorie' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_publication' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_actualite_labo_args_update(){ return array(
    'categorie' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_publication' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/actualite_labo', array(
    array('methods'=>'GET','callback'=>'svc_actualite_labo_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_actualite_labo_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_actualite_labo_args_create())
  ));
  register_rest_route($ns, '/actualite_labo/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_actualite_labo_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_actualite_labo_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_actualite_labo_args_update())),
    array('methods'=>'PUT','callback'=>'svc_actualite_labo_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_actualite_labo_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_actualite_labo_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour equipement_contrat
function svc_equipement_contrat_args_create(){ return array(
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_equipement_contrat_args_update(){ return array(
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/equipement_contrat', array(
    array('methods'=>'GET','callback'=>'svc_equipement_contrat_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_equipement_contrat_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_equipement_contrat_args_create())
  ));
  register_rest_route($ns, '/equipement_contrat/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_equipement_contrat_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_equipement_contrat_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_contrat_args_update())),
    array('methods'=>'PUT','callback'=>'svc_equipement_contrat_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_contrat_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_equipement_contrat_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour equipement_protocole
function svc_equipement_protocole_args_create(){ return array(
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_equipement_protocole_args_update(){ return array(
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/equipement_protocole', array(
    array('methods'=>'GET','callback'=>'svc_equipement_protocole_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_equipement_protocole_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_equipement_protocole_args_create())
  ));
  register_rest_route($ns, '/equipement_protocole/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_equipement_protocole_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_equipement_protocole_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_protocole_args_update())),
    array('methods'=>'PUT','callback'=>'svc_equipement_protocole_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_protocole_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_equipement_protocole_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour maintenance
function svc_maintenance_args_create(){ 
  return array(
    'date_debut' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_string($v) && $v !== ''; },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'date_fin' => array(
      'required' => false,
      'validate_callback' => function($v){ return is_string($v); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'equipement_id' => array(
      'required' => true,
      'validate_callback' => function($v){ return is_scalar($v); }, // varchar dans ton schéma
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'type_maintenance' => array(                // NEW
      'required' => false,
      'validate_callback' => function($v){
        return in_array(strtolower($v), array('preventive','corrective','curative','inspection','autre'), true);
      },
      'sanitize_callback' => function($v){ return strtolower(sanitize_text_field($v)); }
    ),
    'motif' => array(                           // NEW
      'required' => false,
      'validate_callback' => function($v){ return is_scalar($v); },
      'sanitize_callback' => 'sanitize_textarea_field'
    ),
    'fichier_rapport' => array(                 // NEW
      'required' => false,
      'validate_callback' => function($v){ return is_scalar($v); },
      'sanitize_callback' => 'esc_url_raw'
    ),
    'photo_equipement' => array(                // NEW
      'required' => false,
      'validate_callback' => function($v){ return is_scalar($v); },
      'sanitize_callback' => 'esc_url_raw'
    )
  );
}

function svc_maintenance_args_update(){ 
  $a = svc_maintenance_args_create();
  // tout facultatif en PATCH
  foreach ($a as &$def) { $def['required'] = false; }
  return $a;
}



add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/maintenance', array(
    array('methods'=>'GET','callback'=>'svc_maintenance_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_maintenance_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_maintenance_args_create())
  ));
  register_rest_route($ns, '/maintenance/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_maintenance_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_maintenance_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_maintenance_args_update())),
    array('methods'=>'PUT','callback'=>'svc_maintenance_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_maintenance_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_maintenance_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour participation_request
function svc_participation_request_args_create(){ return array(
    'decision' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_participation_request_args_update(){ return array(
    'decision' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/participation_request', array(
    array('methods'=>'GET','callback'=>'svc_participation_request_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_participation_request_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_participation_request_args_create())
  ));
  register_rest_route($ns, '/participation_request/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_participation_request_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_participation_request_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_participation_request_args_update())),
    array('methods'=>'PUT','callback'=>'svc_participation_request_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_participation_request_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_participation_request_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour rapport_aq
function svc_rapport_aq_args_create(){ return array(); }
function svc_rapport_aq_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/rapport_aq', array(
    array('methods'=>'GET','callback'=>'svc_rapport_aq_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_rapport_aq_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_rapport_aq_args_create())
  ));
  register_rest_route($ns, '/rapport_aq/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_rapport_aq_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_rapport_aq_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_aq_args_update())),
    array('methods'=>'PUT','callback'=>'svc_rapport_aq_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_aq_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_rapport_aq_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour rapport_reservations
function svc_rapport_reservations_args_create(){ return array(); }
function svc_rapport_reservations_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/rapport_reservations', array(
    array('methods'=>'GET','callback'=>'svc_rapport_reservations_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_rapport_reservations_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_rapport_reservations_args_create())
  ));
  register_rest_route($ns, '/rapport_reservations/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_rapport_reservations_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_rapport_reservations_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_reservations_args_update())),
    array('methods'=>'PUT','callback'=>'svc_rapport_reservations_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_reservations_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_rapport_reservations_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour rapport_scientifique
function svc_rapport_scientifique_args_create(){ return array(); }
function svc_rapport_scientifique_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/rapport_scientifique', array(
    array('methods'=>'GET','callback'=>'svc_rapport_scientifique_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_rapport_scientifique_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_rapport_scientifique_args_create())
  ));
  register_rest_route($ns, '/rapport_scientifique/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_rapport_scientifique_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_rapport_scientifique_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_scientifique_args_update())),
    array('methods'=>'PUT','callback'=>'svc_rapport_scientifique_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_rapport_scientifique_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_rapport_scientifique_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour reservation

if (!defined('ABSPATH')) exit;

function svc_reservation_table(){ global $wpdb; return $wpdb->prefix.'recherche_reservation'; }
function svc_equipement_table(){ global $wpdb; return $wpdb->prefix.'recherche_equipement'; }

function svc_reservation_allowed(){
  return array(
    'resource_id',        // BIGINT (id equipement/salle)
    'resource_label',     // texte affiché
    'date_reservation',   // YYYY-MM-DD
    'heure_debut',        // HH:MM[:SS]
    'heure_fin',          // HH:MM[:SS]
    'objectif',           // texte
    'statut'              // en_attente|validee|refusee|annulee...
  );
}

function svc_reservation_args_create(){
  return array(

    'resource_id' => array('required'=>true,'validate_callback'=>function($v){ return is_numeric($v); }, 'sanitize_callback'=>'absint'),
    'resource_label' => array('required'=>false,'validate_callback'=>function($v){ return is_scalar($v);}, 'sanitize_callback'=>'sanitize_text_field'),
    'date_reservation' => array('required'=>true,'validate_callback'=>function($v){ return is_string($v) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$v);}, 'sanitize_callback'=>'sanitize_text_field'),
    'heure_debut' => array('required'=>true,'validate_callback'=>function($v){ return is_string($v) && preg_match('/^\d{2}:\d{2}(:\d{2})?$/',$v);}, 'sanitize_callback'=>'sanitize_text_field'),
    'heure_fin' => array('required'=>true,'validate_callback'=>function($v){ return is_string($v) && preg_match('/^\d{2}:\d{2}(:\d{2})?$/',$v);}, 'sanitize_callback'=>'sanitize_text_field'),
    'objectif' => array('required'=>false,'validate_callback'=>function($v){ return is_scalar($v);}, 'sanitize_callback'=>'sanitize_textarea_field'),
    // 'statut' non requis en création → par défaut "en_attente"
  );
}
function svc_reservation_args_update(){
  $a = svc_reservation_args_create();
  foreach ($a as &$d) $d['required'] = false; // PATCH
  // statut autorisé en update
  $a['statut'] = array('required'=>false,'validate_callback'=>function($v){ return is_scalar($v);}, 'sanitize_callback'=>'sanitize_text_field');
  return $a;
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';

  // LIST + CREATE
  register_rest_route($ns, '/reservation', array(
    array('methods'=>'GET',  'callback'=>'svc_reservation_list',  'permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST', 'callback'=>'svc_reservation_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_reservation_args_create()),
  ));

  // GET / PATCH / DELETE (optionnel) / CANCEL
  register_rest_route($ns, '/reservation/(?P<id>\d+)', array(
    array('methods'=>'GET',    'callback'=>'svc_reservation_get',   'permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH',  'callback'=>'svc_reservation_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_reservation_args_update()),
    array('methods'=>'DELETE', 'callback'=>'svc_reservation_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
  register_rest_route($ns, '/reservation/(?P<id>\d+)/cancel', array(
    array('methods'=>'POST', 'callback'=>'svc_reservation_cancel','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});


// ====== ROUTES ======
add_action('rest_api_init', function () {
  register_rest_route('plateforme-directeurderecherche/v1', '/stats', [
    'methods'  => 'GET',
    'callback' => 'svc_stats_global',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ]);

  register_rest_route('plateforme-directeurderecherche/v1', '/top-ressources', [
    'methods'  => 'GET',
    'callback' => 'svc_top_ressources',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ]);
});



// === Callback REST ===
function api_types_activites_list_cb(WP_REST_Request $req){
    $args = [
        'lang'  => $req->get_param('lang') ?: 'fr',
        'q'     => $req->get_param('q') ?: '',
        'actif' => is_null($req->get_param('actif')) ? 1 : intval($req->get_param('actif')),
    ];
    return new WP_REST_Response(svc_types_activites_list($args), 200);
}

// === Déclaration de la route REST ===
add_action('rest_api_init', function(){
    $ns = 'plateforme-directeurderecherche/v1';

    register_rest_route($ns, '/types-activites', [
        [
            'methods'  => 'GET',
            'callback' => 'api_types_activites_list_cb',
            'permission_callback' => function(){ return is_user_logged_in(); },
            'args' => [
                'lang'  => ['required'=>false],
                'q'     => ['required'=>false],
                'actif' => ['required'=>false],
            ]
        ]
    ]);
});


add_action('rest_api_init', function () {
    register_rest_route('plateforme-rapport/v1', '/list', [
        'methods'  => 'GET',
        'callback' => function () {
            return svc_rapport_list();
        },
        'permission_callback' => '__return_true'
    ]);

    register_rest_route('plateforme-rapport/v1', '/create', [
        'methods'  => 'POST',
        'callback' => function ($req) {
            $id = svc_rapport_create($req->get_json_params());
            return ['id' => $id];
        },
        'permission_callback' => function () {
            return current_user_can('read');
        }
    ]);

    register_rest_route('plateforme-rapport/v1', '/delete/(?P<id>\d+)', [
        'methods'  => 'DELETE',
        'callback' => function ($req) {
            $id = intval($req['id']);
            return svc_rapport_delete($id);
        },
        'permission_callback' => function () {
            return current_user_can('read');
        }
    ]);
});

