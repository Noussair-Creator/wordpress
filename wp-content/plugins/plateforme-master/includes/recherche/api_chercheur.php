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

// Déclaration de la route
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/pays', [
    'methods'  => 'GET',
    'callback' => 'svc_pays_list',
    'permission_callback' => function(){ return is_user_logged_in(); }, // adapte si public
    'args' => [
      'lang'  => ['validate_callback'=>function($v){ return in_array(strtolower($v),['fr','ar','en'],true); }],
      'q'     => [],
      'actif' => ['validate_callback'=>function($v){ return in_array((string)$v,['0','1',''],true); }],
      'limit' => ['validate_callback'=>function($v){ return is_numeric($v); }]
    ]
  ]);
});




// etablissement 

add_action('rest_api_init', function(){
  register_rest_route('plateforme-recherche/v1', '/etablissements', array(
    'methods'  => 'GET',
    'callback' => 'svc_etablissements_list',
    'permission_callback' => function(){ return is_user_logged_in(); },
  ));
});


add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Route GET pour source de financement
  register_rest_route($ns, '/source-financement', array(
    array(
      'methods' => 'GET',
      'callback' => 'svc_source_financement_list',
      'permission_callback' => function(){ return is_user_logged_in(); }
    )
  ));
});

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Route GET pour type de projet
  register_rest_route($ns, '/type-projet', array(
    array(
      'methods' => 'GET',
      'callback' => 'svc_type_projet_list',
      'permission_callback' => function(){ return is_user_logged_in(); }
    )
  ));
});
//  Enregistrement de la route
add_action('rest_api_init', function () {
    register_rest_route('plateforme-recherche/v1', '/financement/source', [
        'methods'  => 'GET',
        'callback' => 'svc_financement_source',
        'permission_callback' => '__return_true'
    ]);
});

/* ===============================
 *  ROUTES REST: /membre
 * =============================== */



// Normalise un rôle saisi (accepte "chercheur", "um_chercheur", etc.)
if (!function_exists('svc_roles_normalize')) {
  function svc_roles_normalize($role){
    $r = strtolower(trim((string)$role));
    $r = str_replace(array(' ', '-'), '_', $r);
    if (in_array($r, array('chercheur','doctorant','student_master'), true)) {
      $r = 'um_' . $r;
    }
    return $r;
  }
}

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  register_rest_route($ns, '/users', array(
    array(
      'methods'  => WP_REST_Server::READABLE, // GET
      'callback' => 'svc_users_list',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array(
        'page'             => array('type'=>'integer'),
        'per_page'         => array('type'=>'integer'),
        'search'           => array('type'=>'string'),
        // Rôles: roles[]=um_chercheur&roles[]=um_doctorant  (ou CSV "chercheur,doctorant")
        'roles'            => array('type'=>'array', 'items'=>array('type'=>'string')),
        // Filtre établissement via usermeta 'institut_id'
        'etablissement_id' => array('type'=>'integer'),
        'institut_id'      => array('type'=>'integer'),
        // Exclure les comptes déjà membres de ce laboratoire
        'exclude_lab'      => array('type'=>'integer'),
        // Tri
        'orderby'          => array('type'=>'string', 'description'=>'id|display_name|email|registered|etablissement'),
        'order'            => array('type'=>'string', 'description'=>'ASC|DESC'),
        // Ajouter id + nom d’établissement dans la réponse
        'with_etablissement' => array('type'=>'boolean'),
      ),
    ),
  ));
});


add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // /membre  (liste + création)
  register_rest_route($ns, '/membre', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_membre_list',
          'permission_callback' => '__return_true',
      'args' => array(
        'page'           => array('type'=>'integer'),
        'per_page'       => array('type'=>'integer'),
        'search'         => array('type'=>'string', 'description'=>'Recherche sur nom utilisateur, email, grade, spécialité'),
        'grade'          => array('type'=>'string'),
        'laboratoire_id' => array('type'=>'integer'),
        'user_id'        => array('type'=>'integer'),
        'orderby'        => array('type'=>'string', 'description'=>"id|created_at|updated_at|grade|specialite|user"),
        'order'          => array('type'=>'string', 'description'=>"ASC|DESC"),
        'me'             => array('type'=>'boolean', 'required'=>false, 'description'=>'Limiter aux lignes du user connecté'),
        'with_user'      => array('type'=>'boolean', 'required'=>false, 'description'=>'Joindre les infos de l’utilisateur'),
      'with_projects' => array('type'=>'boolean', 'required'=>false),
      'orderby'       => array('type'=>'string', 'description'=>"id|created_at|updated_at|grade|specialite|user|etablissement|last_activity"),
      ),
    ),
    array(
      'methods'  => 'POST',
      'callback' => 'svc_membre_create',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => svc_membre_args_create(),
    ),
  ));

  // /membre/{id}  (lecture + MAJ + suppression)
  register_rest_route($ns, '/membre/(?P<id>\d+)', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_membre_get',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array(
        'id'        => array('required'=>true, 'validate_callback' => function($p){ return is_numeric($p); }),
        'with_user' => array('type'=>'boolean', 'required'=>false),
      ),
    ),
    array(
      'methods'  => 'PATCH',
      'callback' => 'svc_membre_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_membre_args_update()
      ),
    ),
    array(
      'methods'  => 'PUT',
      'callback' => 'svc_membre_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_membre_args_update()
      ),
    ),
    // ✅ Accepter POST sur /membre/{id} (ex: multipart + _method=PUT)
    array(
      'methods'  => 'POST',
      'callback' => 'svc_membre_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_membre_args_update()
      ),
    ),
    array(
      'methods'  => 'DELETE',
      'callback' => 'svc_membre_delete',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
  ));

  // Raccourci: /membre/mine  (les lignes du user courant, filtrables par laboratoire_id)
  register_rest_route($ns, '/membre/mine', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_membre_mine',
      'permission_callback' => '__return_true',

      'args' => array(
        'laboratoire_id' => array('type'=>'integer', 'required'=>false),
        'with_user'      => array('type'=>'boolean', 'required'=>false),
      ),
    ),
  ));
});


/* ===============================
 *  ARGS DEFINITIONS
 * =============================== */

function svc_membre_common_field_defs($for_update = false){
  $req = !$for_update; // requis à la création, optionnel en update
  return array(
    'user_id' => array(
      'type' => 'integer','required' => $req,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($v){ return empty($v) || is_numeric($v); }
    ),
    'laboratoire_id' => array(
      'type' => 'integer','required' => $req,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($v){ return empty($v) || is_numeric($v); }
    ),
    'grade' => array(
      'type' => 'string','required' => $req,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'specialite' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'api' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'service' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
  );
}
function svc_membre_args_create(){ return svc_membre_common_field_defs(false); }
function svc_membre_args_update(){ return svc_membre_common_field_defs(true); }


add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  register_rest_route($ns, '/membre', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_membre_list',
          'permission_callback' => '__return_true',
      'args' => array(
        'page'             => array('type'=>'integer'),
        'per_page'         => array('type'=>'integer'),
        'search'           => array('type'=>'string', 'description'=>'Recherche sur nom, email, grade, spécialité'),
        'grade'            => array('type'=>'string'),
        'laboratoire_id'   => array('type'=>'integer'),
        'user_id'          => array('type'=>'integer'),
        'orderby'          => array('type'=>'string', 'description'=>"id|created_at|updated_at|grade|specialite|user|role|etablissement"),
        'order'            => array('type'=>'string', 'description'=>"ASC|DESC"),
        'me'               => array('type'=>'boolean', 'required'=>false),
        'with_user'        => array('type'=>'boolean', 'required'=>false),
        // 🔹 NOUVEAU : filtres rôles (accepte roles[]=… ou roles=…,...)
        'roles'            => array(
          'type' => 'array', 'required' => false,
          'items' => array('type' => 'string'),
          'description' => 'Ex: um_chercheur, um_doctorant, um_student_master (ou chercheur, doctorant, student_master)'
        ),
        // 🔹 NOUVEAU : filtre établissement via meta user "institut_id"
        'etablissement_id' => array('type'=>'integer', 'required'=>false, 'description'=>'Filtre par institut_id (meta user)'),
        // alias possible (au cas où côté front)
        'institut_id'      => array('type'=>'integer', 'required'=>false),
        // 🔹 pour renvoyer id + nom de l’établissement
        'with_etablissement' => array('type'=>'boolean', 'required'=>false),
      ),
    ),

    // … (les autres méthodes POST/PATCH/PUT/DELETE inchangées)
  ));
});


// ###################################### 

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
function svc_document_args_create(){ 
  return array(
    'fichier_path' => array(
        'required' => false,   // <- changer ici
        'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 
        'sanitize_callback' => 'sanitize_text_field'
    ),
    'titre' => array(
        'required' => true, 
        'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 
        'sanitize_callback' => 'sanitize_text_field'
    ),
    'chercheur_id' => array(
        'required' => false, 
        'validate_callback' => function($param){ return is_numeric($param); }, 
        'sanitize_callback' => 'absint'
    ),
    'date_upload' => array(
        'required' => false, 
        'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 
        'sanitize_callback' => 'sanitize_text_field'
    ),
    'type' => array(
        'required' => false, 
        'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 
        'sanitize_callback' => 'sanitize_text_field'
    ),
    'visibility' => array(
        'required' => false, 
        'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 
        'sanitize_callback' => 'sanitize_text_field'
    )
  ); 
}

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

/*
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
    array('methods'=>'POST','callback'=>'svc_laboratoire_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>fn($p)=>is_numeric($p))), svc_laboratoire_args_update()))

  ));
});
*/
add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // /laboratoire (liste + création)
  register_rest_route($ns, '/laboratoire', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_laboratoire_list',
      //'permission_callback' => function(){ return is_user_logged_in(); },
          'permission_callback' => '__return_true',


    ),
    array(
      'methods'  => 'POST',
      'callback' => 'svc_laboratoire_create',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => svc_laboratoire_args_create(),
    ),
  ));

  // /laboratoire/{id} (lecture + maj + suppression)
  register_rest_route($ns, '/laboratoire/(?P<id>\d+)', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_laboratoire_get',
       'permission_callback' => '__return_true',
    ),
    array(
      'methods'  => 'PATCH',
      'callback' => 'svc_laboratoire_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_laboratoire_args_update()
      ),
    ),
    array(
      'methods'  => 'PUT',
      'callback' => 'svc_laboratoire_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_laboratoire_args_update()
      ),
    ),
    // ✅ Accepter aussi POST sur /laboratoire/{id} (multipart + _method=PUT)
    array(
      'methods'  => 'POST',
      'callback' => 'svc_laboratoire_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array_merge(
        array('id' => array(
          'required' => true,
          'validate_callback' => function($p){ return is_numeric($p); }
        )),
        svc_laboratoire_args_update()
      ),
    ),
    array(
      'methods'  => 'DELETE',
      'callback' => 'svc_laboratoire_delete',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
  ));
});


function svc_labo_common_field_defs($for_update = false){
  $req = !$for_update;
  return array(
    'logo_id' => array(
      'type' => 'integer','required' => false,
      'sanitize_callback' => 'absint'
    ),
    'logo_url' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'esc_url_raw',
      'validate_callback' => function($v){ return empty($v) || filter_var($v, FILTER_VALIDATE_URL); }
    ),
    // 🔹 nouveau champ si tu veux passer un fichier direct (multipart)
    'logo_file' => array(
      'required' => false,
      'description' => 'Fichier logo à uploader',
    ),
    'denomination' => array(
      'type' => 'string','required' => $req,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'code_lr' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'etablissement_label' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'date_creation' => array(
      'type' => 'string','required' => false,
      'validate_callback' => function($v){ return empty($v) || preg_match('/^\d{4}-\d{2}-\d{2}$/',$v); }
    ),
    'directeur_nom' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'directeur_email' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_email',
      'validate_callback' => function($v){ return empty($v) || is_email($v); }
    ),
    'directeur_user_id' => array(
      'type' => 'integer','required' => false,
      'sanitize_callback' => 'absint'
    ),
    'statut' => array(
      'type' => 'string','required' => false,
      'enum' => array('Actif','Inactif','Suspendu'),
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'objectif_general' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => function($v){ return wp_kses_post($v); }
    ),
    'axes_recherche' => array(
          'type' => 'array',
          'required' => false,
          'items' => array('type' => 'string'),
          'validate_callback' => function($v){
            // Accepter array OU string (JSON / séparée par \n ,)
            return is_array($v) || is_string($v) || $v === null;
          },
          'sanitize_callback' => function($v){
            if (is_array($v)) {
              return array_values(array_filter(array_map('trim', $v), fn($s)=>$s!==''));
            }
            if (is_string($v)) {
              $s = trim($v);
              if ($s === '') return array();
              // tenter JSON
              $decoded = json_decode($s, true);
              if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded), fn($s)=>$s!==''));
              }
              // fallback split par \n ou virgule
              $parts = preg_split('/\r?\n|,/', $s);
              return array_values(array_filter(array_map('trim', $parts), fn($s)=>$s!==''));
            }
            return array();
          }
        ),

    'site_web' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'esc_url_raw',
      'validate_callback' => function($v){ return empty($v) || filter_var($v, FILTER_VALIDATE_URL); }
    ),
    'telephone' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'email_contact' => array(
      'type' => 'string','required' => false,
      'sanitize_callback' => 'sanitize_email',
      'validate_callback' => function($v){ return empty($v) || is_email($v); }
    ),
    'meta_json' => array(
      'type' => 'object','required' => false
    ),
  );
}


function svc_laboratoire_args_update(){
  return [
    'id' => [
      'description' => 'ID labo',
      'type'        => 'integer',
      'required'    => true,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($param/*, $request, $key*/){
        return is_numeric($param) && (int)$param > 0;
      },
    ],
    'etablissement_id' => [
      'type' => 'integer',
      'required' => false,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($param/*, $request, $key*/){
        if ($param === null || $param === '') return true;
        return is_numeric($param) && (int)$param > 0;
      },
    ],
    'denomination' => [
      'type' => 'string',
      'required' => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    'nom' => [
      'type' => 'string',
      'required' => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    'domaine' => [
      'type' => 'string',
      'required' => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    'directeur_user_id' => [
      'type' => 'integer',
      'required' => false,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($param/*, $request, $key*/){
        if ($param === null || $param === '') return true;
        return is_numeric($param) && (int)$param >= 1;
      },
    ],
  ];
}

function svc_laboratoire_args_create(){
  return [
    'etablissement_id' => [
      'description'       => 'ID de l’établissement',
      'type'              => 'integer',
      'required'          => true,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($param, $request, $key){
        return is_numeric($param) && (int)$param > 0;
      },
    ],
    // Tolérance: on ne met pas "required" ici; validation finale dans le callback
    'denomination' => [
      'description'       => 'Nom / Dénomination du laboratoire',
      'type'              => 'string',
      'required'          => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    // Compat si le front envoie encore "nom"
    'nom' => [
      'description'       => 'Alias de "denomination" (compatibilité front)',
      'type'              => 'string',
      'required'          => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    'domaine' => [
      'description'       => 'Domaine scientifique',
      'type'              => 'string',
      'required'          => false,
      'sanitize_callback' => 'sanitize_text_field',
    ],
    'directeur_user_id' => [
      'description'       => 'ID user du directeur du labo',
      'type'              => 'integer',
      'required'          => false,
      'sanitize_callback' => 'absint',
      'validate_callback' => function($param, $request, $key){
        // autorise vide/null; si fourni => numérique >= 1
        if ($param === null || $param === '') return true;
        return is_numeric($param) && (int)$param >= 1;
      },
    ],
  ];
}


add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Filtre sur la liste : .../laboratoire?me=1  (retourne les labos du user connecté)
  register_rest_route($ns, '/laboratoire', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_laboratoire_list',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array(
        'page' => array('type'=>'integer'),
        'per_page' => array('type'=>'integer'),
        'search' => array('type'=>'string'),
        'statut' => array('type'=>'string'),
        'etablissement_id' => array('type'=>'integer'),
        'orderby' => array('type'=>'string'),
        'order' => array('type'=>'string'),
        // 👇 nouveau
        'me' => array('type'=>'boolean', 'required'=>false),
      ),
    ),
  ));

  // Endpoint dédié: .../laboratoire/mine  (raccourci)
  register_rest_route($ns, '/laboratoire/mine', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_laboratoire_mine',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
  ));
});

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Projets d’un laboratoire
  register_rest_route($ns, '/laboratoire/(?P<id>\d+)/projets', array(
    'methods'  => 'GET',
    'callback' => 'svc_labo_projets',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ));

  // Effectifs d’un laboratoire
   register_rest_route($ns, '/laboratoire/(?P<id>\d+)/effectifs', array(
    'methods'  => 'GET',
    'callback' => 'svc_labo_effectifs',
    'permission_callback' => function(){ return is_user_logged_in(); }
  ));
});





// Paramètres/validation pour manifestation
function svc_manifestation_args_create(){ return array(
    'date' => array('required' => true, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'intitule' => array('required' => true, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'chercheur_id' => array('required' => false, 'validate_callback' => function($param){ return is_numeric($param); }, 'sanitize_callback' => 'absint'),
    'lieu' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'preuve_url' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'role' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field')
); }
function svc_manifestation_args_update(){ return array(
    'date' => array('required' => false, 'validate_callback' => function($param){ return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param); }, 'sanitize_callback' => 'sanitize_text_field'),
    'intitule' => array('required' => false, 'validate_callback' => function($param){ return is_scalar($param) || is_array($param); }, 'sanitize_callback' => 'sanitize_text_field'),
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
    array('methods'=>'GET','callback'=>'svc_manifestation_get',        'permission_callback' => '__return_true'
 ),
    array('methods'=>'PATCH','callback'=>'svc_manifestation_update', 'permission_callback' => '__return_true', 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_manifestation_args_update())),
    array('methods'=>'PUT','callback'=>'svc_manifestation_update', 'permission_callback' => '__return_true', 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_manifestation_args_update())),
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
function svc_projet_args_create() {
    return array(
        'date_debut' => array(
            'required' => false,
            'validate_callback' => function($param){
                return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param);
            },
            'sanitize_callback' => function($param){ return sanitize_text_field($param); }
        ),
        'titre' => array(
            'required' => true,
            'validate_callback' => function($param){
                return is_scalar($param) || is_array($param);
            },
            'sanitize_callback' => function($param){ return sanitize_text_field($param); }
        ),
        'budget' => array(
            'required' => false,
            'validate_callback' => function($param){ return is_numeric($param); },
            'sanitize_callback' => function($param){ return floatval($param); }
        ),
        'chercheur_id' => array(
            'required' => false,
            'validate_callback' => function($param){ return is_numeric($param); },
            'sanitize_callback' => function($param){ return absint($param); }
        ),
        'date_fin' => array(
            'required' => false,
            'validate_callback' => function($param){
                return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param);
            },
            'sanitize_callback' => function($param){ return sanitize_text_field($param); }
        ),
        'email' => array(
            'required' => false,
            'validate_callback' => function($param){ return is_email($param); },
            'sanitize_callback' => function($param){ return sanitize_email($param); }
        ),
    );
}

function svc_projet_args_update() {
  return array(
    'date_debut' => array(
      'required' => false,
      'validate_callback' => function($param){
        return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'titre' => array(
      'required' => false,
      'validate_callback' => function($param){
        return is_scalar($param) || is_array($param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'budget' => array(
      'required' => false,
      'validate_callback' => function($param){
        return is_numeric(is_array($param) ? reset($param) : $param);
      },
      'sanitize_callback' => function($param){
        if (is_array($param)) $param = reset($param);
        return floatval($param);
      }
    ),
    'chercheur_id' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_numeric($param); },
      'sanitize_callback' => 'absint'
    ),
    'date_fin' => array(
      'required' => false,
      'validate_callback' => function($param){
        return is_string($param) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$param);
      },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'resume' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_scalar($param) || is_array($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'statut' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_scalar($param) || is_array($param); },
      'sanitize_callback' => 'sanitize_text_field'
    ),
    'type_financement' => array(
      'required' => false,
      'validate_callback' => function($param){ return is_scalar($param) || is_array($param); },
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
}


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
       array('methods'=>'POST','callback'=>'svc_projet_update','permission_callback'=>function(){ return is_user_logged_in(); }, 'args'=>array_merge(array('id'=>array('required'=>true,'validate_callback'=>function($p){return is_numeric($p);})), svc_projet_args_update())),

    array('methods'=>'DELETE','callback'=>'svc_projet_delete','permission_callback'=>function(){ return is_user_logged_in(); })
  ));
  register_rest_route($ns, '/projet/stats', array(
    array(
      'methods' => 'GET',
      'callback' => 'svc_projet_stats',
      'permission_callback' => function(){ return is_user_logged_in(); }
    )
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

// Reseaux de recherche 

add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Liste & création
  register_rest_route($ns, '/reseaux', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_list',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
    array(
      'methods'  => 'POST',
      'callback' => 'svc_reseaux_create',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => svc_reseaux_args_create()
    ),
  ));

  // Détails / update / delete
  register_rest_route($ns, '/reseaux/(?P<id>\d+)', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_get',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
    array(
      'methods'  => 'PUT',
      'callback' => 'svc_reseaux_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => svc_reseaux_args_update()
    ),
    array(
      'methods'  => 'PATCH',
      'callback' => 'svc_reseaux_update',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
    array(
      'methods'  => 'DELETE',
      'callback' => 'svc_reseaux_delete',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));

  // Stats / Meta / Projets
  register_rest_route($ns, '/reseaux/stats', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_stats',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));
  register_rest_route($ns, '/reseaux/meta', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_meta',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));
  register_rest_route($ns, '/reseaux/projets', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_projets',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));
});

// === Route REST ===
add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';
  register_rest_route($ns, '/reseaux/visible', array(
    array(
      'methods'  => 'GET',
      'callback' => 'svc_reseaux_list_visible',
      'permission_callback' => function(){ return is_user_logged_in(); }
    ),
  ));
});
// --- ROUTE REST ------------------------------------------------------
add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/directeurs', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_directeurs_list',
    'permission_callback' => function(){
      return is_user_logged_in();
    },
    'args' => array(
      'q' => array(
        'description' => 'Recherche (nom, email)',
        'type' => 'string',
        'required' => false,
      ),
      'etablissement_id' => array(
        'description' => 'Filtrer par établissement (id)',
        'type' => 'integer',
        'required' => false,
      ),
      'all' => array(
        'description' => 'Si =1, ne restreint pas par contexte utilisateur',
        'type' => 'integer',
        'required' => false,
        'default' => 0,
      ),
      'page' => array(
        'type' => 'integer',
        'required' => false,
        'default' => 1,
      ),
      'per_page' => array(
        'type' => 'integer',
        'required' => false,
        'default' => 50,
      ),
    )
  ));
});


add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/laboratoire', [
    [
      'methods'  => WP_REST_Server::CREATABLE, // POST /laboratoire
      'callback' => 'svc_laboratoire_create_endpoint',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => [
        'etablissement_id'  => ['type'=>'integer','required'=>true],
        'nom'               => ['type'=>'string','required'=>true],
        'domaine'           => ['type'=>'string','required'=>false],
        'directeur_user_id' => ['type'=>'integer','required'=>false],
      ]
    ],
  ]);
});


add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/laboratoire/(?P<id>\d+)/directeur', [
    'methods'  => 'PUT,PATCH',
    'callback' => 'svc_laboratoire_update_directeur',
    'permission_callback' => function(){ return is_user_logged_in(); },
    'args' => [
      'id' => [
        'required' => true,
        'sanitize_callback' => 'absint',
        'validate_callback' => function($param){ return is_numeric($param) && (int)$param>0; },
      ],
      'directeur_user_id' => [
        'required' => true,
        'sanitize_callback' => 'absint',
        'validate_callback' => function($param){ return is_numeric($param) && (int)$param>0; },
      ],
    ],
  ]);
});


add_action('rest_api_init', function() {
    register_rest_route('plateforme-recherche/v1', '/projet/(?P<id>\d+)/full', [
        'methods' => 'GET',
        'callback' => 'svc_projet_full',
        'permission_callback' => '__return_true'
    ]);
});

// Enregistrer la route
add_action('rest_api_init', function () {
    register_rest_route('plateforme-recherche/v1', '/projet/(?P<projet_id>\d+)/depense', [
        'methods' => 'POST',
        'callback' => 'svc_depense_create',
        'permission_callback' => function () {
            return current_user_can('read'); // à adapter si besoin
        }
    ]);
});

add_action('rest_api_init', function () {

    // 1. Liste des sources de financement
    register_rest_route('plateforme-recherche/v1', '/financement/sources', [
        'methods'  => 'GET',
        'callback' => 'svc_sources_list',
        'permission_callback' => '__return_true'
    ]);

    // 2. Suivi budgétaire par source
    register_rest_route('plateforme-recherche/v1', '/financement/suivi-sources', [
        'methods'  => 'GET',
        'callback' => 'svc_suivi_sources',
        'permission_callback' => '__return_true'
    ]);

    // 3. Suivi budgétaire par projet
    register_rest_route('plateforme-recherche/v1', '/financement/suivi-projets', [
        'methods'  => 'GET',
        'callback' => 'svc_suivi_projets',
        'permission_callback' => '__return_true'
    ]);

    // 4. Statistiques globales
    register_rest_route('plateforme-recherche/v1', '/financement/stats', [
        'methods'  => 'GET',
        'callback' => 'svc_financement_stats',
        'permission_callback' => '__return_true'
    ]);
});



add_action('rest_api_init', function () {
  $ns = 'plateforme-recherche/v1';

  // Catégories (liste simple)
  register_rest_route($ns, '/manifestation/categories', [
    'methods'  => 'GET',
    'callback' => 'svc_manifestation_categories',
        'permission_callback' => '__return_true'
  ]);

  // Images d'une manifestation
  register_rest_route($ns, '/manifestation/(?P<id>\d+)/images', [
    [
      'methods'  => 'GET',
      'callback' => 'svc_manifestation_images_list',
       'permission_callback' => '__return_true'
    ],
    [
      'methods'  => 'POST', // multipart (files[])
      'callback' => 'svc_manifestation_images_add',
       'permission_callback' => '__return_true'
    ],
    [
      'methods'  => 'DELETE',
      'callback' => 'svc_manifestation_images_delete', // ?image_id=...
       'permission_callback' => '__return_true'
    ],
  ]);

  // Stats (dernier publié, nb ce mois, donut par catégorie, années proposées)
  register_rest_route($ns, '/manifestation/stats', [
    'methods'  => 'GET',
    'callback' => 'svc_manifestation_stats',
    'permission_callback' => '__return_true',
    'args' => [
      'year' => ['type'=>'string'] // "2024-2025" ou "2025"
    ]
  ]);

  // Bloc média d’accueil (carousel actu + grille photos)
  register_rest_route($ns, '/manifestation/media', [
    'methods'  => 'GET',
    'callback' => 'svc_manifestation_media',
    'permission_callback' => '__return_true'
  ]);
});


add_action('rest_api_init', function () {
    register_rest_route('plateforme-recherche/v1', '/financement/top-sources', [
        'methods'  => 'GET',
        'callback' => 'svc_financement_top_sources',
        'permission_callback' => '__return_true'
    ]);
});


/**
 * Services Publications — Namespace: plateforme-recherche/v1
 * GET /publications?laboratoire_id=11&scope=all|director|members&statut=Validée&type=Article&search=mot&page=1&per_page=20
 * Aliases:
 *   - GET /publications/by-lab?laboratoire_id=11
 *   - GET /publications/by-director?laboratoire_id=11
 *   - GET /publications/by-members?laboratoire_id=11
 */


add_action('rest_api_init', function() {

  register_rest_route('plateforme-recherche/v1', '/publications', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_publications_list_route',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer', 'required'=>false],
      'scope'          => ['type'=>'string',  'required'=>false, 'enum'=>['all','director','members']],
      'statut'         => ['type'=>'string',  'required'=>false],
      'type'           => ['type'=>'string',  'required'=>false],
      'search'         => ['type'=>'string',  'required'=>false],
      'page'           => ['type'=>'integer', 'required'=>false],
      'per_page'       => ['type'=>'integer', 'required'=>false],
    ],
  ]);



  // Alias conviviaux
  register_rest_route('plateforme-recherche/v1', '/publications/by-lab', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope','all');
      return svc_publications_list_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

  register_rest_route('plateforme-recherche/v1', '/publications/by-director', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope','director');
      return svc_publications_list_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

  register_rest_route('plateforme-recherche/v1', '/publications/by-members', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope','members');
      return svc_publications_list_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

});



/**
 * Routes "nommées" et explicites pour les réseaux
 * Namespace: plateforme-recherche/v1
 *
 * Exemples:
 *  - GET /wp-json/plateforme-recherche/v1/reseaux/lab/11
 *  - GET /wp-json/plateforme-recherche/v1/reseaux/lab/11/type/Cotutelle%20Doctorale
 *  - GET /wp-json/plateforme-recherche/v1/reseaux/lab/11/country/France
 *  - GET /wp-json/plateforme-recherche/v1/reseaux/lab/11/status/Actif
 *    (page, per_page, order, orderby restent possibles en query)
 */

add_action('rest_api_init', function () {

  // /reseaux/lab/{laboratoire_id}
  register_rest_route('plateforme-recherche/v1', '/reseaux/lab/(?P<laboratoire_id>\d+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_reseaux_by_lab',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer','required'=>true],
      'page'     => ['type'=>'integer','required'=>false],
      'per_page' => ['type'=>'integer','required'=>false],
      'order'    => ['type'=>'string','required'=>false],
      'orderby'  => ['type'=>'string','required'=>false],
    ],
  ]);

  // /reseaux/lab/{laboratoire_id}/type/{type_collab}
  register_rest_route('plateforme-recherche/v1', '/reseaux/lab/(?P<laboratoire_id>\d+)/type/(?P<type_collab>[^/]+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_reseaux_by_lab_type',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer','required'=>true],
      'type_collab'    => ['type'=>'string','required'=>true],
      'page'     => ['type'=>'integer','required'=>false],
      'per_page' => ['type'=>'integer','required'=>false],
      'order'    => ['type'=>'string','required'=>false],
      'orderby'  => ['type'=>'string','required'=>false],
    ],
  ]);

  // /reseaux/lab/{laboratoire_id}/country/{pays}
  register_rest_route('plateforme-recherche/v1', '/reseaux/lab/(?P<laboratoire_id>\d+)/country/(?P<pays>[^/]+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_reseaux_by_lab_country',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer','required'=>true],
      'pays'           => ['type'=>'string','required'=>true],
      'page'     => ['type'=>'integer','required'=>false],
      'per_page' => ['type'=>'integer','required'=>false],
      'order'    => ['type'=>'string','required'=>false],
      'orderby'  => ['type'=>'string','required'=>false],
    ],
  ]);

  // /reseaux/lab/{laboratoire_id}/status/{statut}
  register_rest_route('plateforme-recherche/v1', '/reseaux/lab/(?P<laboratoire_id>\d+)/status/(?P<statut>[^/]+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_reseaux_by_lab_status',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer','required'=>true],
      'statut'         => ['type'=>'string','required'=>true], // Actif | En cours | Clos ...
      'page'     => ['type'=>'integer','required'=>false],
      'per_page' => ['type'=>'integer','required'=>false],
      'order'    => ['type'=>'string','required'=>false],
      'orderby'  => ['type'=>'string','required'=>false],
    ],
  ]);
});


/** ===== Endpoints ===== */
add_action('rest_api_init', function () {

  // Générique: /projet/by-lab?laboratoire_id=11&... (scope par défaut = director_or_members)
  register_rest_route('plateforme-recherche/v1', '/projet/by-lab', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_projet_list_by_lab_route',
    'permission_callback' => '__return_true',
    'args' => [
      'laboratoire_id' => ['type'=>'integer','required'=>true],
      'scope'          => ['type'=>'string', 'required'=>false, 'enum'=>['director','members','director_or_members'], 'default'=>'director_or_members'],
      'statut'         => ['type'=>'string',  'required'=>false],
      'type_financement'=>['type'=>'string',  'required'=>false],
      'type_projet_id' => ['type'=>'integer','required'=>false],
      'search'         => ['type'=>'string',  'required'=>false],
      'page'           => ['type'=>'integer','required'=>false, 'default'=>1],
      'per_page'       => ['type'=>'integer','required'=>false, 'default'=>20],
      'orderby'        => ['type'=>'string', 'required'=>false, 'enum'=>['date_debut','date_fin','created_at','id'], 'default'=>'date_debut'],
      'order'          => ['type'=>'string', 'required'=>false, 'enum'=>['ASC','DESC'], 'default'=>'DESC'],
    ],
  ]);

  // Nom lisible: /projet/lab/{laboratoire_id}
  register_rest_route('plateforme-recherche/v1', '/projet/lab/(?P<laboratoire_id>\d+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope', 'director_or_members');
      return svc_projet_list_by_lab_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

  // Variantes lisibles (facultatif) : type, statut, financement
  register_rest_route('plateforme-recherche/v1', '/projet/lab/(?P<laboratoire_id>\d+)/status/(?P<statut>[^/]+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope', 'director_or_members');
      $req->set_param('statut', sanitize_text_field(rawurldecode($req['statut'])));
      return svc_projet_list_by_lab_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

  register_rest_route('plateforme-recherche/v1', '/projet/lab/(?P<laboratoire_id>\d+)/funding/(?P<type_financement>[^/]+)', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => function(WP_REST_Request $req){
      $req->set_param('scope', 'director_or_members');
      $req->set_param('type_financement', sanitize_text_field(rawurldecode($req['type_financement'])));
      return svc_projet_list_by_lab_route($req);
    },
    'permission_callback' => '__return_true',
  ]);

});
/*
add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/notifications', [
    'methods'  => WP_REST_Server::READABLE, // GET
    'callback' => 'svc_notification_list',
    'permission_callback' => function () { return is_user_logged_in(); },
    'args' => [
      'per_page' => ['type'=>'integer','required'=>false],
      'page'     => ['type'=>'integer','required'=>false],
    ]
  ]);

  register_rest_route('plateforme-recherche/v1', '/notifications/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::EDITABLE, // PATCH
    'callback' => 'svc_notification_update',
    'permission_callback' => function () { return is_user_logged_in(); },
  ]);
});
*/

add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/notifications', [
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'svc_notification_list',
    'permission_callback' => function () { return is_user_logged_in(); },
    'args' => [
      'per_page' => ['type'=>'integer','required'=>false],
      'page'     => ['type'=>'integer','required'=>false],
    ]
  ]);

  register_rest_route('plateforme-recherch/v1', '/notifications/(?P<id>\d+)', [
    'methods'  => WP_REST_Server::EDITABLE, // PATCH
    'callback' => 'svc_notification_update',
    'permission_callback' => function () { return is_user_logged_in(); },
  ]);
});
