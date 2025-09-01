<?php
/** API chercheur — Namespace plateforme-pmo/v1 — généré automatiquement */
$__svc_candidates = array(
  __DIR__ . '/services_chercheur.php',
  dirname(__DIR__, 1) . '/services_chercheur.php',
  dirname(__DIR__, 1) . '/services/services_chercheur.php',
  dirname(__DIR__, 2) . '/services/pmo/services_chercheur.php'
);
foreach ($__svc_candidates as $__p) { if (file_exists($__p)) { require_once $__p; break; } }
unset($__p, $__svc_candidates);

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/test', array(
    'methods' => 'GET', 'callback' => function(){ return array('message'=>'ok'); }, 'permission_callback' => '__return_true' ));
});



add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
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

// Paramètres/validation pour document_download
function svc_document_download_args_create(){ return array(); }
function svc_document_download_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/document_download', array(
    array('methods'=>'GET','callback'=>'svc_document_download_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_document_download_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_document_download_args_create())
  ));
  register_rest_route($ns, '/document_download/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_document_download_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_document_download_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_download_args_update())),
    array('methods'=>'PUT','callback'=>'svc_document_download_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_download_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_document_download_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour document_export
function svc_document_export_args_create(){ return array(); }
function svc_document_export_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/document_export', array(
    array('methods'=>'GET','callback'=>'svc_document_export_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_document_export_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_document_export_args_create())
  ));
  register_rest_route($ns, '/document_export/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_document_export_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_document_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_export_args_update())),
    array('methods'=>'PUT','callback'=>'svc_document_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_document_export_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_document_export_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour organisation_membre
function svc_organisation_membre_args_create(){ return array(
    'email' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom_complet' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'role' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_organisation_membre_args_update(){ return array(
    'email' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom_complet' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'role' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/organisation_membre', array(
    array('methods'=>'GET','callback'=>'svc_organisation_membre_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_organisation_membre_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_organisation_membre_args_create())
  ));
  register_rest_route($ns, '/organisation_membre/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_organisation_membre_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_organisation_membre_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_organisation_membre_args_update())),
    array('methods'=>'PUT','callback'=>'svc_organisation_membre_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_organisation_membre_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_organisation_membre_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour plateforme
function svc_plateforme_args_create(){ return array(
    'domaine' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'responsable_id' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_plateforme_args_update(){ return array(
    'domaine' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'nom' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'responsable_id' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/plateforme', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_plateforme_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_plateforme_args_create())
  ));
  register_rest_route($ns, '/plateforme/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_plateforme_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_args_update())),
    array('methods'=>'PUT','callback'=>'svc_plateforme_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_plateforme_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour plateforme_document
function svc_plateforme_document_args_create(){ return array(
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_plateforme_document_args_update(){ return array(
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/plateforme_document', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_document_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_plateforme_document_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_plateforme_document_args_create())
  ));
  register_rest_route($ns, '/plateforme_document/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_document_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_plateforme_document_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_document_args_update())),
    array('methods'=>'PUT','callback'=>'svc_plateforme_document_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_document_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_plateforme_document_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour plateforme_export
function svc_plateforme_export_args_create(){ return array(); }
function svc_plateforme_export_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/plateforme_export', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_export_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_plateforme_export_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_plateforme_export_args_create())
  ));
  register_rest_route($ns, '/plateforme_export/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_plateforme_export_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_plateforme_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_export_args_update())),
    array('methods'=>'PUT','callback'=>'svc_plateforme_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_plateforme_export_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_plateforme_export_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour pmo_dashboard
function svc_pmo_dashboard_args_create(){ return array(); }
function svc_pmo_dashboard_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/pmo_dashboard', array(
    array('methods'=>'GET','callback'=>'svc_pmo_dashboard_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_pmo_dashboard_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_pmo_dashboard_args_create())
  ));
  register_rest_route($ns, '/pmo_dashboard/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_pmo_dashboard_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_pmo_dashboard_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_pmo_dashboard_args_update())),
    array('methods'=>'PUT','callback'=>'svc_pmo_dashboard_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_pmo_dashboard_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_pmo_dashboard_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour pmo_report
function svc_pmo_report_args_create(){ return array(); }
function svc_pmo_report_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/pmo_report', array(
    array('methods'=>'GET','callback'=>'svc_pmo_report_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_pmo_report_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_pmo_report_args_create())
  ));
  register_rest_route($ns, '/pmo_report/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_pmo_report_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_pmo_report_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_pmo_report_args_update())),
    array('methods'=>'PUT','callback'=>'svc_pmo_report_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_pmo_report_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_pmo_report_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour presentation_ceip
function svc_presentation_ceip_args_create(){ return array(); }
function svc_presentation_ceip_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/presentation_ceip', array(
    array('methods'=>'GET','callback'=>'svc_presentation_ceip_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_presentation_ceip_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_presentation_ceip_args_create())
  ));
  register_rest_route($ns, '/presentation_ceip/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_presentation_ceip_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_presentation_ceip_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_presentation_ceip_args_update())),
    array('methods'=>'PUT','callback'=>'svc_presentation_ceip_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_presentation_ceip_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_presentation_ceip_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour presentation_ceip_publish
function svc_presentation_ceip_publish_args_create(){ return array(); }
function svc_presentation_ceip_publish_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/presentation_ceip_publish', array(
    array('methods'=>'GET','callback'=>'svc_presentation_ceip_publish_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_presentation_ceip_publish_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_presentation_ceip_publish_args_create())
  ));
  register_rest_route($ns, '/presentation_ceip_publish/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_presentation_ceip_publish_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_presentation_ceip_publish_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_presentation_ceip_publish_args_update())),
    array('methods'=>'PUT','callback'=>'svc_presentation_ceip_publish_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_presentation_ceip_publish_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_presentation_ceip_publish_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour requete
function svc_requete_args_create(){ return array(
    'priorite' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_requete_args_update(){ return array(
    'priorite' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'statut' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'titre' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'type' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/requete', array(
    array('methods'=>'GET','callback'=>'svc_requete_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_requete_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_requete_args_create())
  ));
  register_rest_route($ns, '/requete/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_requete_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_requete_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_args_update())),
    array('methods'=>'PUT','callback'=>'svc_requete_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_requete_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour requete_export
function svc_requete_export_args_create(){ return array(); }
function svc_requete_export_args_update(){ return array(); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/requete_export', array(
    array('methods'=>'GET','callback'=>'svc_requete_export_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_requete_export_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_requete_export_args_create())
  ));
  register_rest_route($ns, '/requete_export/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_requete_export_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_requete_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_export_args_update())),
    array('methods'=>'PUT','callback'=>'svc_requete_export_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_export_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_requete_export_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

// Paramètres/validation pour requete_piece_jointe
function svc_requete_piece_jointe_args_create(){ return array(
    'fichier' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_requete_piece_jointe_args_update(){ return array(
    'fichier' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }

add_action('rest_api_init', function () {
  $ns = 'plateforme-pmo/v1';
  register_rest_route($ns, '/requete_piece_jointe', array(
    array('methods'=>'GET','callback'=>'svc_requete_piece_jointe_list','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'POST','callback'=>'svc_requete_piece_jointe_create','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>svc_requete_piece_jointe_args_create())
  ));
  register_rest_route($ns, '/requete_piece_jointe/(?P<id>\d+)', array(
    array('methods'=>'GET','callback'=>'svc_requete_piece_jointe_get','permission_callback'=>function(){ return is_user_logged_in(); }),
    array('methods'=>'PATCH','callback'=>'svc_requete_piece_jointe_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_piece_jointe_args_update())),
    array('methods'=>'PUT','callback'=>'svc_requete_piece_jointe_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_requete_piece_jointe_args_update())),
    array('methods'=>'DELETE','callback'=>'svc_requete_piece_jointe_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
});

