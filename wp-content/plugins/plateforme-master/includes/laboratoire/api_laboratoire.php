<?php
/**
 * API Routes for Laboratoires
 * Namespace: plateforme-labo/v1
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load the corresponding services file
require_once __DIR__ . '/services_laboratoire.php';

// --- Register All Laboratoire Routes ---
add_action('rest_api_init', function () {
    $ns = 'plateforme-labo/v1'; // Clean, consistent namespace

    // GET all laboratoires
    register_rest_route($ns, '/laboratoires', [
        'methods' => 'GET',
        'callback' => 'api_get_all_laboratoires_callback',
        'permission_callback' => 'is_user_logged_in'
    ]);

    // POST to create a laboratoire
    register_rest_route($ns, '/laboratoires', [
        'methods' => 'POST',
        'callback' => 'api_create_laboratoire_callback',
        'permission_callback' => 'is_user_logged_in',
    ]);
});