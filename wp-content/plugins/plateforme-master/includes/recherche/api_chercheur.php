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


// etablissement 

add_action('rest_api_init', function(){
  register_rest_route('plateforme-recherche/v1', '/etablissements', array(
    'methods'  => 'GET',
    'callback' => 'svc_etablissements_list',
    'permission_callback' => function(){ return is_user_logged_in(); },
  ));
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
      'permission_callback' => function(){ return is_user_logged_in(); },
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
      'permission_callback' => function(){ return is_user_logged_in(); },
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
      'permission_callback' => function(){ return is_user_logged_in(); },
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
      'permission_callback' => function(){ return is_user_logged_in(); },
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
      'permission_callback' => function(){ return is_user_logged_in(); },
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


function svc_laboratoire_args_create(){ return svc_labo_common_field_defs(false); }
function svc_laboratoire_args_update(){ return svc_labo_common_field_defs(true); }

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

