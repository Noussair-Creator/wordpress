<?php

function pm_api_update_profile(WP_REST_Request $request) {
    $user_id = get_current_user_id();
    $params = $request->get_params();

    update_user_meta($user_id, 'first_name', sanitize_text_field($params['first_name']));
    update_user_meta($user_id, 'last_name', sanitize_text_field($params['last_name']));
    update_user_meta($user_id, 'grade', sanitize_text_field($params['grade']));
    update_user_meta($user_id, 'specialite', sanitize_text_field($params['specialite']));
    update_user_meta($user_id, 'telephone', sanitize_text_field($params['telephone']));

    if (!empty($params['email'])) {
        wp_update_user([
            'ID' => $user_id,
            'user_email' => sanitize_email($params['email']),
        ]);
    }

    // Avatar
    if (!empty($_FILES['avatar']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attachment_id = media_handle_upload('avatar', 0);
        if (!is_wp_error($attachment_id)) {
            update_user_meta($user_id, 'user_avatar_id', $attachment_id);
            $avatar_url = wp_get_attachment_url($attachment_id);
        }
    }

    return rest_ensure_response([
        'success' => true,
        'avatar_url' => $avatar_url ?? ''
    ]);
}