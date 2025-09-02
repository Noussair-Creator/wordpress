<?php
/**
 * Service functions for Laboratoires.
 */

if (!defined('ABSPATH')) {
    exit;
}

// --- LABORATOIRE SERVICE FUNCTIONS ---

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

function get_all_laboratoires()
{
    global $wpdb;
    $table = $wpdb->prefix . 'directeur_de_labo_laboratoire';
    return $wpdb->get_results("SELECT * FROM $table ORDER BY nom ASC", ARRAY_A);
}

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

    $params = $request->get_json_params();

    $data = [
        'nom' => sanitize_text_field($params['nom'] ?? ''),
        'date_de_creation' => sanitize_text_field($params['date_de_creation'] ?? null),
        'etat' => sanitize_text_field($params['etat'] ?? 'actif'),
        'objectif_general' => sanitize_textarea_field($params['objectif_general'] ?? ''),
        'axes_de_recherche' => sanitize_textarea_field($params['axes_de_recherche'] ?? ''),
        'directeur_du_laboratoire_id' => $current_user_id,
        'etablissement' => $etablissement_id,
        'logo_laboratoire' => isset($params['logo_laboratoire']) ? esc_url_raw($params['logo_laboratoire']) : null,
    ];

    if ($wpdb->insert($table, $data) === false) {
        return new WP_Error('db_error', 'Database insert failed: ' . $wpdb->last_error, ['status' => 500]);
    }
    $id = $wpdb->insert_id;

    return get_laboratoire($id);
}