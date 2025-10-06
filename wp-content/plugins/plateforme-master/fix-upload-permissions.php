<?php

/**
 * Fix upload permissions for custom roles
 * 
 * This file provides an alternative way to add upload capabilities to custom roles.
 * The main fix is already implemented in plateforme-master.php (lines 2819-2826),
 * but this file serves as a backup solution.
 * 
 * To use this file:
 * 1. Uncomment the add_action line at the bottom
 * 2. Or include this file in your theme's functions.php
 * 3. Or run the function manually: add_upload_capability_to_custom_roles();
 */

// Add upload_files capability to custom roles
function add_upload_capability_to_custom_roles()
{
    // Get the roles that need upload capability
    $roles_to_fix = [
        'um_pmo',
        'um_service-master',
        'um_coordonnateur-master',
        'um_student_master',
        'um_service-utm',
        'um_service-etablissement',
        'um_directeur_laboratoire',
        'um_chercheur'
    ];

    foreach ($roles_to_fix as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            // Add upload_files capability
            $role->add_cap('upload_files');
            $role->add_cap('edit_posts'); // Often needed for media
            $role->add_cap('edit_published_posts'); // For published content

            // Log the change for debugging
            error_log("Added upload_files capability to role: {$role_name}");
        } else {
            error_log("Role not found: {$role_name}");
        }
    }
}

// Alternative: Run this function when the plugin is activated or when needed
// Uncomment the line below if you want to use this file instead of the main fix
// add_action('init', 'add_upload_capability_to_custom_roles');

// Alternative: Run this once and then comment it out
// add_upload_capability_to_custom_roles();

/**
 * Manual function to check current role capabilities
 * Useful for debugging permission issues
 */
function check_role_capabilities($role_name)
{
    $role = get_role($role_name);
    if ($role) {
        $capabilities = $role->capabilities;
        error_log("Capabilities for role {$role_name}: " . print_r($capabilities, true));
        return $capabilities;
    }
    return false;
}

/**
 * Remove upload capabilities (if needed for testing)
 * Uncomment and run if you need to test the permission system
 */
function remove_upload_capabilities()
{
    $roles_to_fix = [
        'um_pmo',
        'um_service-master',
        'um_coordonnateur-master',
        'um_student_master',
        'um_service-utm',
        'um_service-etablissement',
        'um_directeur_laboratoire',
        'um_chercheur'
    ];

    foreach ($roles_to_fix as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            $role->remove_cap('upload_files');
            $role->remove_cap('edit_posts');
            $role->remove_cap('edit_published_posts');
            error_log("Removed upload capabilities from role: {$role_name}");
        }
    }
}

// Uncomment to remove capabilities (for testing only)
// add_action('init', 'remove_upload_capabilities');