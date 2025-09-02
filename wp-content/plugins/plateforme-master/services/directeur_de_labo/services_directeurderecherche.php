<?php
/**
 * Service functions for Directeur de Laboratoire, refactored for consistency.
 * Handles database interactions for laboratoires, chercheurs, and related entities.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**************************************************************
 * HELPER FUNCTION (Kept from original)
 **************************************************************/

/**
 * Handles the upload of a file and returns its URL.
 *
 * @param array  $file      The file array from a request.
 * @param string $subfolder The subfolder within wp-content/uploads.
 * @return string|WP_Error The URL of the uploaded file or a WP_Error on failure.
 */
function handle_lab_file_upload($file, $subfolder = 'lab_files')
{
    if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return new WP_Error('upload_error', 'File upload error.', ['status' => 400]);
    }

    // Use WordPress functions for handling uploads
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    $upload_overrides = ['test_form' => false];

    // Create the custom directory if it doesn't exist
    $upload_dir = wp_upload_dir();
    $custom_dir_info = [
        'path' => $upload_dir['basedir'] . '/' . $subfolder,
        'url' => $upload_dir['baseurl'] . '/' . $subfolder,
    ];

    if (!file_exists($custom_dir_info['path'])) {
        wp_mkdir_p($custom_dir_info['path']);
    }

    // Temporarily filter the upload directory
    add_filter('upload_dir', function ($dirs) use ($custom_dir_info) {
        return array_merge($dirs, $custom_dir_info);
    });

    $moved_file = wp_handle_upload($file, $upload_overrides);

    // Remove the filter so it doesn't affect other uploads
    remove_filter('upload_dir', 'wp_upload_dir');

    if ($moved_file && !isset($moved_file['error'])) {
        return $moved_file['url'];
    }

    return new WP_Error('move_file_error', $moved_file['error'], ['status' => 500]);
}


/**************************************************************
 * LABORATOIRE SERVICES
 **************************************************************/

/**
 * Get a specific laboratoire by its ID.
 */
function get_laboratoire($id)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_laboratoire';
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id), ARRAY_A);

    if (!$row) {
        return new WP_Error('not_found', 'Laboratoire not found', ['status' => 404]);
    }
    return $row;
}

/**
 * Get a list of all laboratoires.
 */
function get_all_laboratoires()
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_laboratoire';
    return $wpdb->get_results("SELECT * FROM $table ORDER BY nom ASC", ARRAY_A);
}


/**
 * Create a new laboratoire.
 */
function create_laboratoire(WP_REST_Request $request)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_laboratoire';

    $current_user_id = get_current_user_id();
    if ($current_user_id === 0) {
        return new WP_Error('unauthorized', 'You must be logged in.', ['status' => 401]);
    }

    $etablissement_id = get_user_meta($current_user_id, 'institut_id', true);
    if (empty($etablissement_id)) {
        return new WP_Error('etablissement_missing', 'Director does not have an establishment set.', ['status' => 400]);
    }

    // Get data from the JSON body of the request
    $params = $request->get_json_params();

    // Prepare data for insertion
    $data = [
        'nom' => sanitize_text_field($params['nom'] ?? ''),
        'date_de_creation' => sanitize_text_field($params['date_de_creation'] ?? null),
        'etat' => sanitize_text_field($params['etat'] ?? 'actif'),
        'objectif_general' => sanitize_textarea_field($params['objectif_general'] ?? ''),
        'axes_de_recherche' => sanitize_textarea_field($params['axes_de_recherche'] ?? ''),
        'directeur_du_laboratoire_id' => $current_user_id,
        'etablissement' => $etablissement_id,
        // Use the logo URL from JSON, or null if it's not provided
        'logo_laboratoire' => isset($params['logo_laboratoire']) ? esc_url_raw($params['logo_laboratoire']) : null,
    ];

    // Insert all data in a single operation
    if ($wpdb->insert($table, $data) === false) {
        return new WP_Error('db_error', 'Insert failed: ' . $wpdb->last_error, ['status' => 500]);
    }
    $id = $wpdb->insert_id;

    return get_laboratoire($id);
}

/**
 * Update an existing laboratoire.
 */
function update_laboratoire($id, WP_REST_Request $request)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_laboratoire';

    // Prepare data for update
    $data = [
        'nom' => sanitize_text_field($request->get_param('nom')),
        'date_de_creation' => sanitize_text_field($request->get_param('date_de_creation')),
        'etat' => sanitize_text_field($request->get_param('etat')),
        'objectif_general' => sanitize_textarea_field($request->get_param('objectif_general')),
        'axes_de_recherche' => sanitize_textarea_field($request->get_param('axes_de_recherche')),
    ];

    // Remove null values so they don't overwrite existing data
    $data = array_filter($data, function ($value) {
        return $value !== null; });

    // Handle file upload
    $files = $request->get_file_params();
    if (!empty($files['logo_laboratoire'])) {
        $logo_url = handle_lab_file_upload($files['logo_laboratoire'], 'lab_logos');
        if (is_wp_error($logo_url)) {
            return $logo_url;
        }
        $data['logo_laboratoire'] = $logo_url;
    }

    if (empty($data)) {
        return new WP_Error('bad_request', 'No fields provided for update.', ['status' => 400]);
    }

    if ($wpdb->update($table, $data, ['id' => $id]) === false) {
        return new WP_Error('db_error', 'Update failed', ['status' => 500]);
    }

    return get_laboratoire($id);
}

/**************************************************************
 * CHERCHEUR SERVICES
 **************************************************************/

/**
 * Get a specific chercheur by ID.
 */
function get_chercheur($id)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_chercheur';
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d", $id), ARRAY_A);
    if (!$row) {
        return new WP_Error('not_found', 'Chercheur not found', ['status' => 404]);
    }
    return $row;
}

/**
 * Get all chercheurs.
 */
function get_all_chercheurs()
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_chercheur';
    return $wpdb->get_results("SELECT * FROM $table ORDER BY nom ASC", ARRAY_A);
}

/**
 * Create a new chercheur.
 */
function create_chercheur(WP_REST_Request $request)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_chercheur';

    $data = [
        'nom' => sanitize_text_field($request->get_param('nom')),
        'email' => sanitize_email($request->get_param('email')),
    ];

    if ($wpdb->insert($table, $data) === false) {
        return new WP_Error('db_error', 'Insert failed', ['status' => 500]);
    }
    $id = $wpdb->insert_id;
    return get_chercheur($id);
}

/**
 * Update a chercheur.
 */
function update_chercheur($id, WP_REST_Request $request)
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_chercheur';

    $data = [
        'nom' => sanitize_text_field($request->get_param('nom')),
        'email' => sanitize_email($request->get_param('email')),
    ];
    $data = array_filter($data, function ($value) {
        return $value !== null; });

    if (empty($data)) {
        return new WP_Error('bad_request', 'No fields to update', ['status' => 400]);
    }

    if ($wpdb->update($table, $data, ['id' => $id]) === false) {
        return new WP_Error('db_error', 'Update failed', ['status' => 500]);
    }
    return get_chercheur($id);
}

// NOTE: The pattern can be repeated for `laboratoire_membre`, `activite_doc`, etc.