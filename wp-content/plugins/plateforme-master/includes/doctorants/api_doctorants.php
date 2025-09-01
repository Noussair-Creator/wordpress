<?php

add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/test', [
        'methods' => 'GET',
        'callback' => 'gm_api_test_jwt',
        'permission_callback' => function () {
            // Vérification JWT automatique via plugin JWT Auth
            return is_user_logged_in();
        }
    ]);
});

function gm_api_test_jwt() {
    return [
        'message' => 'API test réussie, JWT valide !'
    ];
}

// GET spécialités
add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/specialites', [
        'methods' => 'GET',
        'callback' => 'api_get_specialites',
        'permission_callback' => '__return_true', // sécuriser si nécessaire
    ]);
});


add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/directeurs-these-by-institut', [
        'methods' => 'GET',
        'callback' => 'api_get_directeurs_by_institut',
        //'permission_callback' => '__return_true', // sécuriser si nécessaire
        

    ]);
});

// Déclaration API REST pour inscriptions doctorants
add_action('rest_api_init', function () {
    // Récupérer une fiche d'inscription par ID
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese/(?P<doctorant_id>\d+)', [
        'methods' => 'GET',
        'callback' => 'api_get_inscription',
        'permission_callback' => '__return_true',
    ]);

    // Toutes les inscriptions
        register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese-all', [
            'methods' => 'GET',
            'callback' => 'api_get_all_inscriptions',
            'permission_callback' => '__return_true',
    ]);
     // Inscriptions par institut
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese-by-institut/(?P<institut_id>\d+)', [
        'methods' => 'GET',
        'callback' => 'api_get_inscriptions_by_institut',
        'permission_callback' => '__return_true',
        'args' => [
            'institut_id' => [
                'required' => true,
                'validate_callback' => fn($p) => is_numeric($p),
            ]
        ]
    ]);

   /*
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese', [
        'methods'  => 'POST',
        'callback' => 'create_inscription',
        'permission_callback' => '__return_true',
    ]);
    */


    // Mettre à jour une inscription
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese/(?P<id>\d+)', [
        'methods' => 'PUT',
        'callback' => 'api_update_inscription',
        'permission_callback' => '__return_true',

    ]);
});




add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese', [
        'methods'  => 'POST',
        'callback' => 'api_create_inscription',
        'permission_callback' => '__return_true',
        'args' => [
            'doctorant_id' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ],
            'sujet' => [
                'required' => true,
            ],
            'specialite' => [
                'required' => true,
            ],
            'date_debut' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $param);
                }
            ],
            'directeur_id' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ],
            'laboratoire' => [
                'required' => false,
            ],
            'type_these' => [
                'required' => false,
                'default' => 'Nationale',
                'validate_callback' => function($param) {
                    return in_array($param, ['Nationale', 'Internationale']);
                }
            ],
            'cotutelle' => [
                'required' => false,
                'default' => 'Non',
                'validate_callback' => function($param) {
                    return in_array($param, ['Oui', 'Non']);
                }
            ]
        ]
    ]);
});

add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/inscriptionsthese/(?P<id>\d+)', [
        'methods'  => 'PUT',
        'callback' => 'api_update_inscription',
        'permission_callback' => '__return_true', // ou sécuriser avec wp_verify_nonce
        'args' => [
            'id' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ],
            'sujet' => ['required' => true],
            'specialite' => ['required' => true],
            'date_debut' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $param);
                }
            ],
            'directeur_id' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ],
            'laboratoire' => ['required' => false],
            'type_these' => [
                'required' => false,
                'default' => 'Nationale',
                'validate_callback' => function($param) {
                    return in_array($param, ['Nationale', 'Internationale']);
                }
            ],
            'cotutelle' => [
                'required' => false,
                'default' => 'Non',
                'validate_callback' => function($param) {
                    return in_array($param, ['Oui', 'Non']);
                }
            ],
            'statut' => ['required' => false, 'default' => 'En cours']
        ]
    ]);
});


// REST API pour récupérer les laboratoires
add_action('rest_api_init', function () {
    register_rest_route('plateforme-doctorants/v1', '/laboratoires', [
        'methods' => 'GET',
        'callback' => 'api_get_laboratoires',
        'permission_callback' => '__return_true', // sécuriser si nécessaire
    ]);
});

// Callback API
function api_get_laboratoires(WP_REST_Request $request) {
    return get_all_laboratoires(); // Appelle la fonction service
}

// Callback
function api_update_inscription(WP_REST_Request $request) {

    $id = intval($request->get_param('id'));
    $data = [
        'sujet'        => $request->get_param('sujet'),
        'specialite'   => $request->get_param('specialite'),
        'date_debut'   => $request->get_param('date_debut'),
        'directeur_id' => $request->get_param('directeur_id'),
        'laboratoire'  => $request->get_param('laboratoire'),
        'type_these'   => $request->get_param('type_these'),
        'cotutelle'    => $request->get_param('cotutelle'),
        'statut'       => $request->get_param('statut'),
    ];

    return update_inscription($id, $request);
}

add_action('rest_api_init', function () {

    // GET all
    register_rest_route('plateforme-doctorants/v1', '/demande-stage-all', [
        'methods' => 'GET',
        'callback' => 'api_get_all_demande_stage',
        'permission_callback' => '__return_true',
    ]);

    // GET by ID
    register_rest_route('plateforme-doctorants/v1', '/demande-stage/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'api_get_demande_stage',
        'permission_callback' => '__return_true',
    ]);

    // POST create
    register_rest_route('plateforme-doctorants/v1', '/demande-stage', [
        'methods' => 'POST',
        'callback' => 'api_create_demande_stage',
        'permission_callback' => '__return_true',
        'args' => [
            'type_demande'    => ['required' => true],
            'objet_mission'   => ['required' => true],
            'date_depart'     => ['required' => true, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'date_retour'     => ['required' => true, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'pays'            => ['required' => true],
            'structure_type'  => ['required' => false],
            'structure_nom'   => ['required' => true],
            'autorisation'    => ['required' => false, 'default' => 'Oui', 'validate_callback' => fn($p) => in_array($p, ['Oui','Non'])],
            'type_financement'=> ['required' => false, 'default' => 'Personnel', 'validate_callback' => fn($p) => in_array($p, ['Personnel','Subvention'])],
            'assurance'       => ['required' => false, 'default' => 'Fourni', 'validate_callback' => fn($p) => in_array($p, ['Fourni','À souscrire'])],
            'commentaire'     => ['required' => false],
            'statut'          => ['required' => false, 'default' => 'Brouillon']
        ]
    ]);

    // PUT update
    register_rest_route('plateforme-doctorants/v1', '/demande-stage/(?P<id>\d+)', [
        'methods' => 'PUT',
        'callback' => 'api_update_demande_stage',
        'permission_callback' => '__return_true',
        'args' => [
            'id'              => ['required' => true, 'validate_callback' => fn($p) => is_numeric($p)],
            'type_demande'    => ['required' => false],
            'objet_mission'   => ['required' => false],
            'date_depart'     => ['required' => false, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'date_retour'     => ['required' => false, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'pays'            => ['required' => false],
            'structure_type'  => ['required' => false],
            'structure_nom'   => ['required' => false],
            'autorisation'    => ['required' => false, 'default' => 'Oui', 'validate_callback' => fn($p) => in_array($p, ['Oui','Non'])],
            'type_financement'=> ['required' => false, 'default' => 'Personnel', 'validate_callback' => fn($p) => in_array($p, ['Personnel','Subvention'])],
            'assurance'       => ['required' => false, 'default' => 'Fourni', 'validate_callback' => fn($p) => in_array($p, ['Fourni','À souscrire'])],
            'commentaire'     => ['required' => false],
            'statut'          => ['required' => false, 'default' => 'Brouillon']
        ]
    ]);

    // GET by institut
    register_rest_route('plateforme-doctorants/v1', '/demande-stage/by-institut', [
        'methods' => 'GET',
        'callback' => 'api_get_demande_stage_by_institut',
        'permission_callback' => '__return_true',
        'args' => [
            'institut_id' => [
                'required' => true,
                'validate_callback' => fn($p) => is_numeric($p),
            ]
        ]
    ]);
});

// Api Bpurse
add_action('rest_api_init', function () {

    register_rest_route('plateforme-doctorants/v1', '/demande-bourse', [
        'methods' => 'POST',
        'callback' => 'api_create_demande_bourse',
        'permission_callback' => '__return_true',
        'args' => [
            'objet_demande' => ['required' => true],
            'intitule_mission' => ['required' => true],
            'structure_type' => ['required' => false],
            'structure_nom' => ['required' => true],
            'pays' => ['required' => true],
            'date_depart' => [
                'required' => true,
                'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)
            ],
            'date_retour' => [
                'required' => true,
                'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)
            ],
            'encadrant' => ['required' => false],
            'modalite_presence' => ['required' => false, 'default' => 'Présentiel'],
            'montant_estime' => ['required' => false],
            'financement_compl' => ['required' => false, 'default' => 'Oui'],
            'assurance' => ['required' => false, 'default' => 'Fourni'],
            'commentaire' => ['required' => false],
            'statut' => ['required' => false, 'default' => 'Brouillon']
        ]
    ]);

    // GET all demandes de bourse
    register_rest_route('plateforme-doctorants/v1', '/demande-bourse', [
        'methods' => 'GET',
        'callback' => 'api_get_all_demande_bourse',
        'permission_callback' => '__return_true',
    ]);

    // GET by ID
    register_rest_route('plateforme-doctorants/v1', '/demande-bourse/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'api_get_demande_bourse',
        'permission_callback' => '__return_true',
    ]);

    // GET by institut
    register_rest_route('plateforme-doctorants/v1', '/demande-bourse/by-institut', [
        'methods' => 'GET',
        'callback' => 'api_get_demande_bourse_by_institut',
        'permission_callback' => '__return_true',
        'args' => [
            'institut' => [
                'required' => true,
                'validate_callback' => fn($p) => is_string($p) && !empty($p),
                'sanitize_callback' => 'sanitize_text_field'
            ]
        ]
    ]);

   // PUT update
    register_rest_route('plateforme-doctorants/v1', '/demande-bourse/(?P<id>\d+)', [
        'methods' => 'PUT',
        'callback' => 'api_update_demande_bourse',
        'permission_callback' => '__return_true',
        'args' => [
            'id'               => ['required' => true, 'validate_callback' => fn($p) => is_numeric($p)],
            'type_demande'     => ['required' => true],
            'objet_mission'    => ['required' => true],
            'date_depart'      => ['required' => true, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'date_retour'      => ['required' => true, 'validate_callback' => fn($p) => preg_match('/^\d{4}-\d{2}-\d{2}$/', $p)],
            'pays'             => ['required' => true],
            'structure_type'   => ['required' => false],
            'structure_nom'    => ['required' => true],
            'autorisation'     => ['required' => false, 'default' => 'Oui', 'validate_callback' => fn($p) => in_array($p, ['Oui','Non'])],
            'type_financement' => ['required' => false, 'default' => 'Personnel', 'validate_callback' => fn($p) => in_array($p, ['Personnel','Subvention'])],
            'assurance'        => ['required' => false, 'default' => 'Fourni', 'validate_callback' => fn($p) => in_array($p, ['Fourni','À souscrire'])],
            'commentaire'      => ['required' => false],
            'statut'           => ['required' => false, 'default' => 'Brouillon']
        ]
    ]);


});



//////////////////////////////////////////////////////////////
//////////// Appel service //////////////////////////////////
////////////////////////////////////////////////////////////

require_once dirname(__DIR__, 2) . '/services/doctorants/services_doctorants.php';

function api_get_specialites(WP_REST_Request $request) {
    return get_all_specialites(); // appelle le service séparé
}


function api_get_directeurs_by_institut($request) {
    // Récupérer l'ID du doctorant connecté

  
    $current_user_id = get_current_user_id();

    if (!$current_user_id) {
        return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status' => 401]);
    }

    // Récupérer l'institut_id du doctorant connecté
    $institut_id = get_user_meta($current_user_id, 'institut_id', true);
    if (!$institut_id) {
        return new WP_Error('no_institut', 'Institut non défini pour ce doctorant', ['status' => 400]);
    }

    // Appel au service
   return get_directeurs_by_institut($institut_id);
}

function api_get_all_inscriptions() {
    return get_all_inscriptions(); // Service
}

function api_get_inscriptions_by_institut(WP_REST_Request $request) {
    $institut_id = intval($request->get_param('institut_id'));
    return get_inscriptions_by_institut($institut_id); // Service
}

function api_get_inscription($request) {
    $id = $request['doctorant_id'];
    return get_inscription($id);
}

function api_create_inscription($request) {
    $params = $request->get_json_params();
    return create_inscription($params);
}
/*
function api_update_inscription($request) {
    $id = $request['id'];
    $params = $request->get_json_params();
    return update_inscription($id, $params);
}

*/


function api_get_all_demande_stage() {
    return get_all_demande_stage(); // Service
}

function api_get_demande_stage(WP_REST_Request $request) {
    $id = intval($request->get_param('id'));
    return get_demande_stage($id); // Service
}

function api_get_demande_stage_by_institut(WP_REST_Request $request) {
    $institut_id = intval($request->get_param('institut_id'));
    $current_user_id = get_current_user_id();


    if (!$current_user_id) {
        return new WP_Error('not_logged_in', 'Utilisateur non connecté', ['status'=>401]);
    }

    if (!$institut_id) {
        return new WP_Error('no_institut', 'Institut non défini pour ce doctorant', ['status'=>400]);
    }

    return get_demande_stage_by_institut($institut_id); // Service
}

function api_create_demande_stage(WP_REST_Request $request) {
    $params = $request->get_params();
    $files  = $request->get_file_params();
    return create_demande_stage($params, $files);
}

function api_update_demande_stage(WP_REST_Request $request) {
    $id     = intval($request->get_param('id'));
    $params = $request->get_json_params();
    $files  = $request->get_file_params();
    return update_demande_stage($id, $params, $files); // Service
}


// bourse
function api_create_demande_bourse(WP_REST_Request $request) {
    $params = $request->get_params(); // form-data ou JSON
    $files  = $request->get_file_params();
    return create_demande_bourse($params, $files);
}


function api_update_demande_bourse(WP_REST_Request $request) {
    $id     = intval($request->get_param('id'));
    $params = $request->get_json_params();
    $files  = $request->get_file_params();
    return update_demande_bourse($id, $params, $files);
}

function api_get_all_demande_bourse(WP_REST_Request $request) {
    return get_all_demande_bourse(); // service séparé
}

function api_get_demande_bourse(WP_REST_Request $request) {
    $id = intval($request->get_param('id'));
    return get_demande_bourse($id); // service séparé
}

function api_get_demande_bourse_by_institut(WP_REST_Request $request) {
    $institut = $request->get_param('institut');
    return get_demande_bourse_by_institut($institut); // service séparé
}

