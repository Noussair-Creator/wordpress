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
    'membre_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type_activite' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_activite_quotidienne_args_update(){ return array(
    'date' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_debut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'heure_fin' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'membre_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
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
    array('methods'=>'PATCH','callback'=>'svc_activite_quotidienne_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_quotidienne_args_update())),
    array('methods'=>'PUT','callback'=>'svc_activite_quotidienne_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_quotidienne_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_activite_quotidienne_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

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

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/activite_scientifique', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_activite_scientifique_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_activite_scientifique_args_create())
  ));
  register_rest_route($ns, '/activite_scientifique/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_activite_scientifique_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_activite_scientifique_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_activite_scientifique_args_update())),
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

// Paramètres/validation pour equipement
function svc_equipement_args_create(){ return array(
    'categorie' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'disponibilite' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'modele' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom_appareil' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_equipement_args_update(){ return array(
    'categorie' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'disponibilite' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'modele' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom_appareil' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/equipement', array(
    array('methods'=>'GET','callback'=>'svc_equipement_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_equipement_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_equipement_args_create())
  ));
  register_rest_route($ns, '/equipement/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_equipement_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_equipement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_args_update())),
    array('methods'=>'PUT','callback'=>'svc_equipement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_equipement_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_equipement_delete','permission_callback'=>function(){ return is_user_logged_in(); })
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
function svc_maintenance_args_create(){ return array(
    'date_debut' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_fin' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'equipement_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_maintenance_args_update(){ return array(
    'date_debut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_fin' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'equipement_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

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
function svc_reservation_args_create(){ return array(
    'statut' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_reservation_args_update(){ return array(
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-directeurderecherche/v1';
  register_rest_route($ns, '/reservation', array(
    array('methods'=>'GET','callback'=>'svc_reservation_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_reservation_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_reservation_args_create())
  ));
  register_rest_route($ns, '/reservation/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_reservation_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_reservation_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_reservation_args_update())),
    array('methods'=>'PUT','callback'=>'svc_reservation_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_reservation_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_reservation_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

