<?php
/**
 * API Route Definitions for Directeur de Laboratoire
 * Namespace: plateforme-directeur-de-labo/v2
 * Refactored to match the style of the 'plateforme-doctorants' API.
 */

if (!defined('ABSPATH')) {
  exit;
}

// Load the corresponding services file
// require_once dirname(__DIR__, 2) . '/services/directeur_de_labo/services_directeurderecherche.php';


// --- Laboratoire Routes ---
add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';

  // GET all laboratoires
  register_rest_route($ns, '/laboratoires', [
    'methods' => 'GET',
    'callback' => 'api_get_all_laboratoires',
    'permission_callback' => 'is_user_logged_in'
  ]);

  // GET a single laboratoire by ID
  register_rest_route($ns, '/laboratoires/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'api_get_laboratoire',
    'permission_callback' => 'is_user_logged_in'
  ]);

  // POST to create a laboratoire
  register_rest_route($ns, '/laboratoires', [
    'methods' => 'POST',
    'callback' => 'api_create_laboratoire',
    'permission_callback' => 'is_user_logged_in',
    'args' => [
      'nom' => ['required' => true],
      'logo_laboratoire' => ['required' => false], // Files are handled separately
    ]
  ]);

  // PUT to update a laboratoire
  register_rest_route($ns, '/laboratoires/(?P<id>\d+)', [
    'methods' => 'PUT', // WordPress handles POST for multipart/form-data updates
    'callback' => 'api_update_laboratoire',
    'permission_callback' => 'is_user_logged_in',
    'args' => [
      'id' => [
        'required' => true,
        'validate_callback' => fn($p) => is_numeric($p)
      ],
    ]
  ]);
});


// --- Chercheur Routes ---
add_action('rest_api_init', function () {
  $ns = 'plateforme-directeur-de-labo/v2';

  // GET all chercheurs
  register_rest_route($ns, '/chercheurs', [
    'methods' => 'GET',
    'callback' => 'api_get_all_chercheurs',
    'permission_callback' => 'is_user_logged_in'
  ]);

  // POST to create a chercheur
  register_rest_route($ns, '/chercheurs', [
    'methods' => 'POST',
    'callback' => 'api_create_chercheur',
    'permission_callback' => 'is_user_logged_in',
    'args' => [
      'nom' => ['required' => true],
      'email' => ['required' => true, 'validate_callback' => fn($p) => is_email($p)],
    ]
  ]);

  // PUT to update a chercheur
  register_rest_route($ns, '/chercheurs/(?P<id>\d+)', [
    'methods' => 'PUT',
    'callback' => 'api_update_chercheur',
    'permission_callback' => 'is_user_logged_in',
    'args' => [
      'id' => ['required' => true, 'validate_callback' => fn($p) => is_numeric($p)],
    ]
  ]);
});

// Note: This pattern can be repeated for `laboratoire_membre`, `activite_doc`, etc.

/**************************************************************
 * API CALLBACK FUNCTIONS
 **************************************************************/

// --- Laboratoire Callbacks ---

function api_get_all_laboratoires(WP_REST_Request $request)
{
  // The refactored service function get_all_laboratoires doesn't take params
  return get_all_laboratoires();
}

function api_get_laboratoire(WP_REST_Request $request)
{
  $id = intval($request->get_param('id'));
  return get_laboratoire($id);
}

// CORRECTED CODE
function api_create_laboratoire(WP_REST_Request $request)
{
  // Make sure you are passing the $request object to the service function
  return create_laboratoire($request);
}

function api_update_laboratoire(WP_REST_Request $request)
{
  $id = intval($request->get_param('id'));
  // Pass the ID and the entire request object
  return update_laboratoire($id, $request);
}


// --- Chercheur Callbacks ---

function api_get_all_chercheurs(WP_REST_Request $request)
{
  return get_all_chercheurs();
}

function api_create_chercheur(WP_REST_Request $request)
{
  return create_chercheur($request);
}

function api_update_chercheur(WP_REST_Request $request)
{
  $id = intval($request->get_param('id'));
  return update_chercheur($id, $request);
}