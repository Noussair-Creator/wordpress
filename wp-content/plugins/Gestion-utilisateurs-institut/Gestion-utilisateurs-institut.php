<?php
/*
Plugin Name: UTM - Utilisateurs par établissement
Description: Ajoute un champ établissement lors de la création d’un utilisateur et le lie via user_meta.
*/

defined('ABSPATH') || exit;

add_action('user_new_form', 'utm_add_institut_field_user_form');
add_action('show_user_profile', 'utm_add_institut_field_user_form');
add_action('edit_user_profile', 'utm_add_institut_field_user_form');

function utm_add_institut_field_user_form($user = null) {
    global $wpdb;
    $table = $wpdb->prefix . 'master_instituts';
    $instituts = $wpdb->get_results("SELECT id, nom FROM $table");
    $selected = $user ? get_user_meta($user->ID, 'institut_id', true) : '';
    ?>
    <h3>Établissement</h3>
    <table class="form-table">
        <tr>
            <th><label for="institut_id">Établissement</label></th>
            <td>
                <select name="institut_id" id="institut_id">
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($instituts as $i): ?>
                        <option value="<?= esc_attr($i->id); ?>" <?= selected($selected, $i->id); ?>>
                            <?= esc_html($i->nom); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="description">Associer l’utilisateur à un établissement.</p>
            </td>
        </tr>
    </table>
    <?php
}

add_action('user_register', 'utm_save_institut_meta');
add_action('personal_options_update', 'utm_save_institut_meta');
add_action('edit_user_profile_update', 'utm_save_institut_meta');

function utm_save_institut_meta($user_id) {
    if (current_user_can('edit_user', $user_id) && isset($_POST['institut_id'])) {
        update_user_meta($user_id, 'institut_id', intval($_POST['institut_id']));
    }
}
