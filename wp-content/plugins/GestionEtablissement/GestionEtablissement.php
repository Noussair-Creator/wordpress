<?php
/*
Plugin Name: Gestion des Établissements
Description: Plugin WordPress pour la gestion des établissements avec liaison à la table des universités.
Version: 1.0
Author: Imene HENIAT
*/

defined('ABSPATH') || exit;
define('GE_MODULE', 'master');

require_once plugin_dir_path(__FILE__) . 'includes/class-instituts-table.php';

register_activation_hook(__FILE__, 'ge_create_instituts_table');
function ge_create_instituts_table() {
    global $wpdb;
    $table = $wpdb->prefix . GE_MODULE . '_instituts';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table ( 
        id INT NOT NULL AUTO_INCREMENT,
        universite_id INT NOT NULL,
        nom VARCHAR(255) NOT NULL,
        code_institut VARCHAR(100) NOT NULL,
        adresse TEXT,
        email_contact VARCHAR(255),
        telephone_contact VARCHAR(50),
        responsable_nom VARCHAR(255),
        responsable_email VARCHAR(255),
        date_creation DATE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

add_action('admin_menu', 'ge_add_admin_menu');
function ge_add_admin_menu() {
    add_menu_page(
        'Établissements',
        'Établissements',
        'manage_options',
        'gestion-etablissements',
        'ge_etablissements_list_page',
        'dashicons-building',
        25
    );

    add_submenu_page(
        'gestion-etablissements',
        'Liste des Établissements',
        'Liste',
        'manage_options',
        'gestion-etablissements',
        'ge_etablissements_list_page'
    );

    add_submenu_page(
        'gestion-etablissements',
        'Ajouter un Établissement',
        'Ajouter',
        'manage_options',
        'ajouter-etablissement',
        'ge_etablissement_add_form'
    );

    add_submenu_page(
        null,
        'Modifier un Établissement',
        'Modifier',
        'manage_options',
        'modifier-etablissement',
        'ge_etablissement_edit_form'
    );
}
/*
function ge_etablissements_list_page() {
    echo '<div class="wrap"><h1 class="wp-heading-inline">Liste des Établissements</h1>';

    $table = new GE_Instituts_Table();
    $table->prepare_items();

    echo '<a href="?page=ajouter-etablissement" class="page-title-action">Ajouter un Établissement</a>';
    echo '<form method="post">';
    $table->display();
    echo '</form>';
    echo '</div>';
}
*/
function ge_etablissements_list_page() {
    $table = new GE_Instituts_Table();
    $table->prepare_items();

    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">Liste des Établissements</h1>';
    echo '<a href="?page=ajouter-etablissement" class="page-title-action">Ajouter un Établissement</a>';

    // Zone de recherche
    echo '<form method="get">';
    echo '<input type="hidden" name="page" value="gestion-etablissements">';
    $table->search_box('Rechercher', 'etablissement');
    echo '</form>';

    echo '<form method="post">';
    $table->display();
    echo '</form>';
    echo '</div>';
}

function ge_etablissement_add_form() {
    global $wpdb;
    $univ_table = $wpdb->prefix . GE_MODULE . '_universites';
    $table = $wpdb->prefix . GE_MODULE . '_instituts';

    $universites = $wpdb->get_results("SELECT id, nom FROM $univ_table");

    $last_id = $wpdb->get_var("SELECT MAX(id) FROM $table");
    $next_id = ($last_id !== null) ? $last_id + 1 : 1;
    $code_institut = 'Etablissement_' . str_pad($next_id, 4, '0', STR_PAD_LEFT);

    if (isset($_POST['submit'])) {
        $date_creation = isset($_POST['date_creation']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date_creation'])
            ? sanitize_text_field($_POST['date_creation'])
            : current_time('mysql');

        $data = [
            'universite_id'      => intval($_POST['universite_id']),
            'nom'                => sanitize_text_field($_POST['nom']),
            'code_institut'      => $code_institut,
            'adresse'            => sanitize_textarea_field($_POST['adresse']),
            'email_contact'      => sanitize_email($_POST['email_contact']),
            'telephone_contact'  => sanitize_text_field($_POST['telephone_contact']),
            'responsable_nom'    => sanitize_text_field($_POST['responsable_nom']),
            'responsable_email'  => sanitize_email($_POST['responsable_email']),
            'date_creation'      => $date_creation,
        ];

        $inserted = $wpdb->insert($table, $data);

        if ($inserted !== false) {
            echo '<div class="updated"><p>Établissement ajouté avec succès. Code : <strong>' . esc_html($code_institut) . '</strong></p></div>';
            echo '<a href="?page=gestion-etablissements" class="button">← Retour à la liste</a>';
        } else {
            echo '<div class="error"><p>Erreur lors de l\'ajout : ' . esc_html($wpdb->last_error) . '</p></div>';
        }

        return;
    }

    // Formulaire
    echo '<div class="wrap"><h1>Ajouter un Établissement</h1>';
    echo '<form method="post"><table class="form-table">';
    echo '<tr><th><label>Université</label></th><td><select name="universite_id" required>';
    foreach ($universites as $univ) {
        echo '<option value="' . esc_attr($univ->id) . '">' . esc_html($univ->nom) . '</option>';
    }
    echo '</select></td></tr>';
    echo '<tr><th><label>Nom</label></th><td><input type="text" name="nom" required></td></tr>';
    echo '<tr><th><label>Code généré</label></th><td><input type="text" value="' . esc_attr($code_institut) . '" readonly></td></tr>';
    echo '<tr><th><label>Adresse</label></th><td><textarea name="adresse"></textarea></td></tr>';
    echo '<tr><th><label>Email contact</label></th><td><input type="email" name="email_contact"></td></tr>';
    echo '<tr><th><label>Téléphone contact</label></th><td><input type="text" name="telephone_contact"></td></tr>';
    echo '<tr><th><label>Responsable</label></th><td><input type="text" name="responsable_nom"></td></tr>';
    echo '<tr><th><label>Email responsable</label></th><td><input type="email" name="responsable_email"></td></tr>';
    echo '<tr><th><label>Date création</label></th><td><input type="date" name="date_creation"></td></tr>';
    echo '</table><p><input type="submit" name="submit" class="button-primary" value="Ajouter"></p></form>';
}


function ge_etablissement_edit_form() {
    global $wpdb;

    $table = $wpdb->prefix . GE_MODULE . '_instituts';
    $univ_table = $wpdb->prefix . GE_MODULE . '_universites';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (!$id) {
        echo '<div class="error"><p>Identifiant d\'établissement invalide.</p></div>';
        return;
    }

    $etab = $wpdb->get_row("SELECT * FROM $table WHERE id = $id", ARRAY_A);
    if (!$etab) {
        echo '<div class="error"><p>Aucun établissement trouvé pour l’ID : ' . esc_html($id) . '</p></div>';
        return;
    }

    $universites = $wpdb->get_results("SELECT id, nom FROM $univ_table");

    if (isset($_POST['submit'])) {
        $data = [
            'universite_id'      => intval($_POST['universite_id']),
            'nom'                => sanitize_text_field($_POST['nom']),
            'adresse'            => sanitize_textarea_field($_POST['adresse']),
            'email_contact'      => sanitize_email($_POST['email_contact']),
            'telephone_contact'  => sanitize_text_field($_POST['telephone_contact']),
            'responsable_nom'    => sanitize_text_field($_POST['responsable_nom']),
            'responsable_email'  => sanitize_email($_POST['responsable_email']),
            'date_creation'      => sanitize_text_field($_POST['date_creation']),
        ];

        $updated = $wpdb->update($table, $data, ['id' => $id]);

        if ($updated !== false) {
            echo '<div class="updated"><p>Établissement mis à jour avec succès.</p></div>';
        } else {
            echo '<div class="error"><p>Erreur de mise à jour : ' . esc_html($wpdb->last_error) . '</p></div>';
        }

        $etab = $wpdb->get_row("SELECT * FROM $table WHERE id = $id", ARRAY_A);
    }

    echo '<div class="wrap"><h1>Modifier un Établissement</h1>';
    echo '<form method="post"><table class="form-table">';

    echo '<tr><th>Université</th><td><select name="universite_id">';
    foreach ($universites as $u) {
        $selected = ($etab['universite_id'] == $u->id) ? ' selected' : '';
        echo '<option value="' . esc_attr($u->id) . '"' . $selected . '>' . esc_html($u->nom) . '</option>';
    }
    echo '</select></td></tr>';

    echo '<tr><th>Nom</th><td><input type="text" name="nom" value="' . esc_attr($etab['nom']) . '" required></td></tr>';
    echo '<tr><th>Code</th><td><input type="text" value="' . esc_attr($etab['code_institut']) . '" readonly></td></tr>';
    echo '<tr><th>Adresse</th><td><textarea name="adresse">' . esc_textarea($etab['adresse']) . '</textarea></td></tr>';
    echo '<tr><th>Email contact</th><td><input type="email" name="email_contact" value="' . esc_attr($etab['email_contact']) . '"></td></tr>';
    echo '<tr><th>Téléphone</th><td><input type="text" name="telephone_contact" value="' . esc_attr($etab['telephone_contact']) . '"></td></tr>';
    echo '<tr><th>Responsable</th><td><input type="text" name="responsable_nom" value="' . esc_attr($etab['responsable_nom']) . '"></td></tr>';
    echo '<tr><th>Email responsable</th><td><input type="email" name="responsable_email" value="' . esc_attr($etab['responsable_email']) . '"></td></tr>';
    echo '<tr><th>Date création</th><td><input type="date" name="date_creation" value="' . esc_attr($etab['date_creation']) . '"></td></tr>';

    echo '</table><p><input type="submit" name="submit" class="button-primary" value="Mettre à jour">';
    echo ' <a href="?page=gestion-etablissements" class="button">← Retour</a></p></form></div>';
}
