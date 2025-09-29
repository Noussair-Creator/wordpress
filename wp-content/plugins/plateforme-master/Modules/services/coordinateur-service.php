<?php

function pm_get_coordinateurs_by_institut() {
    $current_user_id = get_current_user_id();
    if (!$current_user_id) {
        return new WP_Error('unauthorized', 'Utilisateur non connecté', ['status' => 401]);
    }

    $institut_id = get_user_meta($current_user_id, 'institut_id', true);
    if (!$institut_id) {
        return new WP_Error('no_institut', 'Institut non défini pour l’utilisateur.', ['status' => 403]);
    }

    $args = [
        'role' => 'um_coordonnateur-master',
        'meta_key' => 'institut_id',
        'meta_value' => $institut_id,
        'number' => -1
    ];

    $users = get_users($args);

    $result = [];

    foreach ($users as $user) {
        $result[] = [
            'id' => $user->ID,
            'nom' => $user->display_name,
            'email' => $user->user_email,
            'avatar' => get_avatar_url($user->ID),
            'grade' => get_user_meta($user->ID, 'grade', true) ?? '',
            'institut' => get_user_meta($user->ID, 'institut_nom', true) ?? '' // optionnel
        ];
    }

    return $result;
}


function pm_affecter_coordinateur($request) {
    global $wpdb;

    $master_id = intval($request->get_param('master_id'));
    $coord_id = intval($request->get_param('coordinateur_id'));
    $user_id = get_current_user_id();

    if (!$master_id || !$coord_id) {
        return new WP_Error('invalid_data', 'Master ID ou Coordinateur ID manquant.', ['status' => 400]);
    }

    $table = $wpdb->prefix . 'master_coordinateurs';

    // Vérifie s'il existe déjà une affectation
    $exists = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) FROM $table WHERE master_id = %d
    ", $master_id));

    if ($exists) {
        return new WP_Error('already_assigned', 'Ce master a déjà un coordinateur.', ['status' => 409]);
    }

    $inserted = $wpdb->insert($table, [
        'user_id'         => $user_id, // créateur
        'coordinateur_id' => $coord_id,
        'master_id'       => $master_id,
        'date_affectation'=> current_time('mysql'),
        'date_creation'   => current_time('mysql')
    ]);

    if ($inserted === false) {
        return new WP_Error('db_error', 'Erreur lors de l’insertion.', ['status' => 500]);
    }

    return ['success' => true, 'message' => 'Coordinateur affecté avec succès.'];
}
