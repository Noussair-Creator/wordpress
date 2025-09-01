<?php
/** API chercheur — Namespace plateforme-recherche/v1 — généré automatiquement */
$__svc_candidates = array(
  __DIR__ . '/services_chercheur.php',
  dirname(__DIR__, 1) . '/services_chercheur.php',
  dirname(__DIR__, 1) . '/services/services_chercheur.php',
  dirname(__DIR__, 2) . '/services/recherche/services_chercheur.php'
);
foreach ($__svc_candidates as $__p) { if (file_exists($__p)) { require_once $__p; break; } }
unset($__p, $__svc_candidates);

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/test', array(
    'methods' => 'GET', 'callback' => function(){ return array('message'=>'ok'); }, 'permission_callback' => '__return_true' ));
});

// Paramètres/validation pour chercheur
function svc_chercheur_args_create(){ return array(
    'email' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'prenom' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'grade' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'laboratoire_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'orcid' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'photo_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'site_web' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'specialite' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_chercheur_args_update(){ return array(
    'email' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'prenom' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'grade' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'laboratoire_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'orcid' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'photo_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'site_web' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'specialite' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/chercheur', array(
    array('methods'=>'GET','callback'=>'svc_chercheur_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_chercheur_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_chercheur_args_create())
  ));
  register_rest_route($ns, '/chercheur/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_chercheur_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_chercheur_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_chercheur_args_update())),
    array('methods'=>'PUT','callback'=>'svc_chercheur_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_chercheur_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_chercheur_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour document
function svc_document_args_create(){ return array(
    'fichier_path' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'date_upload' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'visibility' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_document_args_update(){ return array(
    'fichier_path' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'date_upload' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'visibility' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/document', array(
    array('methods'=>'GET','callback'=>'svc_document_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_document_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_document_args_create())
  ));
  register_rest_route($ns, '/document/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_document_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_document_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_args_update())),
    array('methods'=>'PUT','callback'=>'svc_document_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_document_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour enseignement
function svc_enseignement_args_create(){ return array(
    'annee_universitaire' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'ue' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'volume_horaire' => array('required' => true, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'niveau' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'semestre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_enseignement_args_update(){ return array(
    'annee_universitaire' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'ue' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'volume_horaire' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'niveau' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'semestre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/enseignement', array(
    array('methods'=>'GET','callback'=>'svc_enseignement_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_enseignement_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_enseignement_args_create())
  ));
  register_rest_route($ns, '/enseignement/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_enseignement_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_enseignement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_enseignement_args_update())),
    array('methods'=>'PUT','callback'=>'svc_enseignement_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_enseignement_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_enseignement_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour laboratoire
function svc_laboratoire_args_create(){ return array(); }
function svc_laboratoire_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/laboratoire', array(
    array('methods'=>'GET','callback'=>'svc_laboratoire_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_laboratoire_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_laboratoire_args_create())
  ));
  register_rest_route($ns, '/laboratoire/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_laboratoire_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_laboratoire_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_laboratoire_args_update())),
    array('methods'=>'PUT','callback'=>'svc_laboratoire_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_laboratoire_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_laboratoire_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour manifestation
function svc_manifestation_args_create(){ return array(
    'date' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'intitule' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'lieu' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'preuve_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'role' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_manifestation_args_update(){ return array(
    'date' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'intitule' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'lieu' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'preuve_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'role' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/manifestation', array(
    array('methods'=>'GET','callback'=>'svc_manifestation_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_manifestation_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_manifestation_args_create())
  ));
  register_rest_route($ns, '/manifestation/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_manifestation_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_manifestation_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_manifestation_args_update())),
    array('methods'=>'PUT','callback'=>'svc_manifestation_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_manifestation_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_manifestation_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour notification
function svc_notification_args_create(){ return array(
    'lu' => array('required' => true, 'validate_callback' => function($param){ return in_array($param, array(0,1,'0','1',true,false,'true','false'), true); }, 'sanitize_callback' => 'rest_sanitize_boolean'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint')
); }
function svc_notification_args_update(){ return array(
    'lu' => array('required' => false, 'validate_callback' => function($param){ return in_array($param, array(0,1,'0','1',true,false,'true','false'), true); }, 'sanitize_callback' => 'rest_sanitize_boolean'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/notification', array(
    array('methods'=>'GET','callback'=>'svc_notification_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_notification_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_notification_args_create())
  ));
  register_rest_route($ns, '/notification/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_notification_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_notification_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_notification_args_update())),
    array('methods'=>'PUT','callback'=>'svc_notification_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_notification_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_notification_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour projet
function svc_projet_args_create(){ return array(
    'date_debut' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'budget' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'floatval'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'date_fin' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resume' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type_financement' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_projet_args_update(){ return array(
    'date_debut' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'budget' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'floatval'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'date_fin' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resume' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type_financement' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/projet', array(
    array('methods'=>'GET','callback'=>'svc_projet_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_projet_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_projet_args_create())
  ));
  register_rest_route($ns, '/projet/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_projet_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_projet_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_projet_args_update())),
    array('methods'=>'PUT','callback'=>'svc_projet_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_projet_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_projet_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour projet_membre
function svc_projet_membre_args_create(){ return array(
    'chercheur_id' => array('required' => true, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'projet_id' => array('required' => true, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'role_projet' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_projet_membre_args_update(){ return array(
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'projet_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'role_projet' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/projet_membre', array(
    array('methods'=>'GET','callback'=>'svc_projet_membre_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_projet_membre_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_projet_membre_args_create())
  ));
  register_rest_route($ns, '/projet_membre/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_projet_membre_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_projet_membre_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_projet_membre_args_update())),
    array('methods'=>'PUT','callback'=>'svc_projet_membre_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_projet_membre_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_projet_membre_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour publication
function svc_publication_args_create(){ return array(
    'date_publication' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'doi' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'isbn' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'revue' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resume'           => array('required' => false, 'validate_callback' => function($p){ return is_scalar($p)||is_array($p); }, 'sanitize_callback' => 'sanitize_textarea_field'),
    'commentaire'      => array('required' => false, 'validate_callback' => function($p){ return is_scalar($p)||is_array($p); }, 'sanitize_callback' => 'sanitize_textarea_field'),
    
); }
function svc_publication_args_update(){ return array(
    'date_publication' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'doi' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'fichier_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'isbn' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    // 'revue' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'resume'           => array('required' => false, 'validate_callback' => function($p){ return is_scalar($p)||is_array($p); }, 'sanitize_callback' => 'sanitize_textarea_field'),
    'commentaire'      => array('required' => false, 'validate_callback' => function($p){ return is_scalar($p)||is_array($p); }, 'sanitize_callback' => 'sanitize_textarea_field'),
    
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/publication', array(
    array('methods'=>'GET','callback'=>'svc_publication_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_publication_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_publication_args_create())
  ));
  register_rest_route($ns, '/publication/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_publication_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_publication_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_publication_args_update())),
    array('methods'=>'PUT','callback'=>'svc_publication_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_publication_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_publication_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour reunion
function svc_reunion_args_create(){ return array(
    'date' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && (bool)strtotime($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'sujet' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'compte_rendu_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'lien_visio' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_reunion_args_update(){ return array(
    'date' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && (bool)strtotime($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'sujet' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'compte_rendu_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'lien_visio' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/reunion', array(
    array('methods'=>'GET','callback'=>'svc_reunion_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_reunion_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_reunion_args_create())
  ));
  register_rest_route($ns, '/reunion/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_reunion_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_reunion_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_reunion_args_update())),
    array('methods'=>'PUT','callback'=>'svc_reunion_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_reunion_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_reunion_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour these
function svc_these_args_create(){ return array(
    'date_debut' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'doctorant_nom' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'sujet' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_soutenance' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'encadrant_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_these_args_update(){ return array(
    'date_debut' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'doctorant_nom' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'sujet' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'date_soutenance' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'encadrant_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/these', array(
    array('methods'=>'GET','callback'=>'svc_these_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_these_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_these_args_create())
  ));
  register_rest_route($ns, '/these/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_these_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_these_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_these_args_update())),
    array('methods'=>'PUT','callback'=>'svc_these_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_these_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_these_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

