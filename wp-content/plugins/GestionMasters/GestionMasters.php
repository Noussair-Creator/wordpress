<?php
/*
Plugin Name: Gestion des Masters
Description: Plugin WordPress pour la gestion des fiches Master avec référentiels liés.
Version: 1.3
Author: VotreNom
*/

defined('ABSPATH') || exit;

define('GE_MODULE', 'master');

require_once plugin_dir_path(__FILE__) . 'includes/class-fichemaster-table.php';

register_activation_hook(__FILE__, 'ge_create_fichemaster_tables');

function ge_create_fichemaster_tables() {
    global $wpdb;
    $prefix = $wpdb->prefix . GE_MODULE . '_';
    $charset_collate = $wpdb->get_charset_collate();

    $tables_sql = [

        // Table principale des masters
        "CREATE TABLE {$prefix}fichemaster (
            id INT NOT NULL AUTO_INCREMENT,
            institut_id INT NOT NULL,
            intitule_master VARCHAR(255) NOT NULL,
            code_interne VARCHAR(100),
            parcours TEXT,
            domaine VARCHAR(255),
            debut_habilitation DATE,
            fin_habilitation DATE,
            nature_id INT,
            mention_id INT,
            departement_id INT,
            diplome_id INT,
            specialite_id INT,
            procedure_selection TEXT,
            nb_places INT,
            criteres_admission TEXT,
            public_vise TEXT,
            formule_score TEXT,
            plan_etude_pdf VARCHAR(255),
            annee_universitaire VARCHAR(20),
            date_creation DATE,
            PRIMARY KEY (id)
        ) $charset_collate;",

        // Référentiels liés
        "CREATE TABLE {$prefix}nature (
            id INT NOT NULL AUTO_INCREMENT,
            libelle VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;",

        "CREATE TABLE {$prefix}mention (
            id INT NOT NULL AUTO_INCREMENT,
            libelle VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;",

        "CREATE TABLE {$prefix}departement (
            id INT NOT NULL AUTO_INCREMENT,
            libelle VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;",

        "CREATE TABLE {$prefix}diplome (
            id INT NOT NULL AUTO_INCREMENT,
            libelle VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;",

        "CREATE TABLE {$prefix}specialite (
            id INT NOT NULL AUTO_INCREMENT,
            libelle VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;",

        // Documents liés aux masters
        "CREATE TABLE {$prefix}documentFicheMaster (
            id INT NOT NULL AUTO_INCREMENT,
            master_id INT NOT NULL,
            titre VARCHAR(255),
            fichier_url VARCHAR(255),
            date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;"
    ];

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    foreach ($tables_sql as $sql) {
        dbDelta($sql);
    }
}

add_action('admin_menu', 'ge_add_master_menu');

function ge_add_master_menu() {
    add_menu_page(
        'Fiches Master',
        'Fiches Master',
        'manage_options',
        'gestion-fiches-master',
        'ge_master_list_page',
        'dashicons-welcome-learn-more',
        26
    );

    add_submenu_page(
        'gestion-fiches-master',
        'Liste des Masters',
        'Liste',
        'manage_options',
        'gestion-fiches-master',
        'ge_master_list_page'
    );

    add_submenu_page(
        'gestion-fiches-master',
        'Ajouter un Master',
        'Ajouter',
        'manage_options',
        'ajouter-fiche-master',
        'ge_master_add_form'
    );
}
/*
function ge_master_list_page() {
  /*  echo '<div class="wrap"><h1>Liste des Fiches Master</h1>';

    $table = new GE_FicheMaster_Table();
    $table->prepare_items();
    echo '<form method="post">';
    $table->display();
    echo '</form>';

    echo '</div>';*/

  /*  $current_user = wp_get_current_user();
    $institut_id = get_user_meta($current_user->ID, 'institut_id', true);

    // Injecte un WHERE SQL personnalisé si l’utilisateur est admin établissement
    if (in_array('um_admin_etablissement', $current_user->roles) && $institut_id) {
        add_filter('ge_fichemaster_sql_filter', function($where) use ($institut_id) {
            return $where . " WHERE institut_id = " . intval($institut_id);
        });
    }
}

*/

function ge_master_list_page() {
    $current_user = wp_get_current_user();
    $institut_id = get_user_meta($current_user->ID, 'institut_id', true);

    if (in_array('um_admin_etablissement', $current_user->roles) && $institut_id) {
        add_filter('ge_fichemaster_sql_filter', function($where) use ($institut_id) {
            return $where . " WHERE f.institut_id = " . intval($institut_id);
        });
    }

    echo '<div class="wrap"><h1>Liste des Fiches Master</h1>';

    $table = new GE_FicheMaster_Table();
    $table->prepare_items();
    echo '<form method="post">';
    $table->display();
    echo '</form>';

    echo '</div>';
}


function ge_handle_pdf_upload($field_name) {
    if (!empty($_FILES[$field_name]['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $uploaded = wp_handle_upload($_FILES[$field_name], ['test_form' => false]);
        if (isset($uploaded['url'])) {
            return esc_url_raw($uploaded['url']);
        }
    }
    return '';
}

function ge_master_add_form() {
    global $wpdb;
    $table = $wpdb->prefix . GE_MODULE . '_fichemaster';
    $institut_table = $wpdb->prefix . GE_MODULE . '_instituts';

    // Récupération des référentiels
    $prefix = $wpdb->prefix . GE_MODULE . '_';
    $natures = $wpdb->get_results("SELECT id, libelle FROM {$prefix}nature");
    $mentions = $wpdb->get_results("SELECT id, libelle FROM {$prefix}mention");
    $departements = $wpdb->get_results("SELECT id, libelle FROM {$prefix}departement");
    $diplomes = $wpdb->get_results("SELECT id, libelle FROM {$prefix}diplome");
    $specialites = $wpdb->get_results("SELECT id, libelle FROM {$prefix}specialite");

    $instituts = $wpdb->get_results("SELECT id, nom FROM $institut_table");

    $edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
    $fiche = null;

    if ($edit_id > 0) {
        $fiche = $wpdb->get_row("SELECT * FROM $table WHERE id = $edit_id");
    }

    if (isset($_POST['submit'])) {
        $plan_pdf = ge_handle_pdf_upload('plan_etude_pdf');
        if (!$plan_pdf && $fiche) $plan_pdf = $fiche->plan_etude_pdf;

        $data = [
            'institut_id'         => intval($_POST['institut_id']),
            'intitule_master'     => sanitize_text_field($_POST['intitule_master']),
            'code_interne'        => sanitize_text_field($_POST['code_interne']),
            'parcours'            => sanitize_textarea_field($_POST['parcours']),
            'domaine'             => sanitize_text_field($_POST['domaine']),
            'debut_habilitation'  => sanitize_text_field($_POST['debut_habilitation']),
            'fin_habilitation'    => sanitize_text_field($_POST['fin_habilitation']),
            'nature_id'           => intval($_POST['nature_id']),
            'mention_id'          => intval($_POST['mention_id']),
            'departement_id'      => intval($_POST['departement_id']),
            'diplomes_requis'     => sanitize_textarea_field($_POST['diplomes_requis']),
            'procedure_selection' => sanitize_textarea_field($_POST['procedure_selection']),
            'nb_places'           => intval($_POST['nb_places']),
            'criteres_admission'  => sanitize_textarea_field($_POST['criteres_admission']),
            'public_vise'         => sanitize_textarea_field($_POST['public_vise']),
            'formule_score'       => sanitize_textarea_field($_POST['formule_score']),
            'plan_etude_pdf'      => $plan_pdf,
            'annee_universitaire' => sanitize_text_field($_POST['annee_universitaire']),
            'date_creation'       => sanitize_text_field($_POST['date_creation']),
            'nature_id'      => intval($_POST['nature_id']),
            'mention_id'     => intval($_POST['mention_id']),
            'departement_id' => intval($_POST['departement_id']),
            'diplome_id'     => intval($_POST['diplome_id']),
            'specialite_id'  => intval($_POST['specialite_id']),
        ];

        if ($edit_id > 0) {
            $wpdb->update($table, $data, ['id' => $edit_id]);
            echo '<div class="updated"><p>Fiche Master modifiée avec succès.</p></div>';
        } else {
            $wpdb->insert($table, $data);
            if ($wpdb->last_error) {
                echo '<div class="error"><p>Erreur MySQL : ' . esc_html($wpdb->last_error) . '</p></div>';
            }
            
            echo '<div class="updated"><p>Fiche Master ajoutée avec succès.</p></div>';
        }

        echo '<a href="?page=gestion-fiches-master" class="button"> Retour à la liste</a>';
        return;
    }

    echo '<div class="wrap"><h1>' . ($fiche ? 'Modifier' : 'Ajouter') . ' une Fiche Master</h1>';
    echo '<form method="post" enctype="multipart/form-data"><table class="form-table">';


    $current_user = wp_get_current_user();
    $user_institut_id = get_user_meta($current_user->ID, 'institut_id', true);



    // Si admin établissement → forcer l’institut par défaut
    if (in_array('um_admin_etablissement', $current_user->roles) && $user_institut_id) {
        echo '<input type="hidden" name="institut_id" value="' . esc_attr($user_institut_id) . '">';
        echo '<tr><th>Institut</th><td><strong>';
        foreach ($instituts as $ins) {
            if ($ins->id == $user_institut_id) {
                echo esc_html($ins->nom);
            }
        }
        echo '</strong></td></tr>';
    } else {
        echo '<tr><th>Institut</th><td><select name="institut_id" required>';
        echo '<option value="">-- Sélectionner un établissement --</option>';
        foreach ($instituts as $ins) {
            $selected = ($fiche && $fiche->institut_id == $ins->id) ? 'selected' : '';
            echo '<option value="' . esc_attr($ins->id) . '" ' . $selected . '>' . esc_html($ins->nom) . '</option>';
        }
        echo '</select></td></tr>';
    }

    function field($label, $name, $value, $type = 'text') {
        echo "<tr><th>$label</th><td><input type='$type' name='$name' value='" . esc_attr($value) . "'></td></tr>";
    }
    function textarea($label, $name, $value) {
        echo "<tr><th>$label</th><td><textarea name='$name'>" . esc_textarea($value) . "</textarea></td></tr>";
    }

    

    field('Intitulé', 'intitule_master', $fiche->intitule_master ?? '');
    field('Code interne', 'code_interne', $fiche->code_interne ?? '');
    textarea('Parcours', 'parcours', $fiche->parcours ?? '');
    field('Domaine', 'domaine', $fiche->domaine ?? '');
    field('Début habilitation', 'debut_habilitation', $fiche->debut_habilitation ?? '', 'date');
    field('Fin habilitation', 'fin_habilitation', $fiche->fin_habilitation ?? '', 'date');
    textarea('Diplômes requis', 'diplomes_requis', $fiche->diplomes_requis ?? '');
    textarea('Procédure de sélection', 'procedure_selection', $fiche->procedure_selection ?? '');
    field('Nombre de places', 'nb_places', $fiche->nb_places ?? '', 'number');
    textarea('Critères d’admission', 'criteres_admission', $fiche->criteres_admission ?? '');
    textarea('Public visé', 'public_vise', $fiche->public_vise ?? '');
    textarea('Formule de score', 'formule_score', $fiche->formule_score ?? '');
    echo '<tr><th>Plan d’étude (PDF)</th><td><input type="file" name="plan_etude_pdf">';
    if ($fiche && $fiche->plan_etude_pdf) {
        echo '<br><a href="' . esc_url($fiche->plan_etude_pdf) . '" target="_blank">Voir le PDF actuel</a>';
    }
    echo '</td></tr>';
    // Sélecteurs de référentiels
    echo '<tr><th>Nature</th><td><select name="nature_id" required><option value="">-- Sélectionner --</option>';
    foreach ($natures as $row) {
        $selected = ($fiche && $fiche->nature_id == $row->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($row->id) . '" ' . $selected . '>' . esc_html($row->libelle) . '</option>';
    }
    echo '</select></td></tr>';

    echo '<tr><th>Mention</th><td><select name="mention_id"><option value="">-- Sélectionner --</option>';
    foreach ($mentions as $row) {
        $selected = ($fiche && $fiche->mention_id == $row->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($row->id) . '" ' . $selected . '>' . esc_html($row->libelle) . '</option>';
    }
    echo '</select></td></tr>';

    echo '<tr><th>Département</th><td><select name="departement_id"><option value="">-- Sélectionner --</option>';
    foreach ($departements as $row) {
        $selected = ($fiche && $fiche->departement_id == $row->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($row->id) . '" ' . $selected . '>' . esc_html($row->libelle) . '</option>';
    }
    echo '</select></td></tr>';

    echo '<tr><th>Diplôme</th><td><select name="diplome_id"><option value="">-- Sélectionner --</option>';
    foreach ($diplomes as $row) {
        $selected = ($fiche && $fiche->diplome_id == $row->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($row->id) . '" ' . $selected . '>' . esc_html($row->libelle) . '</option>';
    }
    echo '</select></td></tr>';

    echo '<tr><th>Spécialité</th><td><select name="specialite_id"><option value="">-- Sélectionner --</option>';
    foreach ($specialites as $row) {
        $selected = ($fiche && $fiche->specialite_id == $row->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($row->id) . '" ' . $selected . '>' . esc_html($row->libelle) . '</option>';
    }
    echo '</select></td></tr>';

    field('Année universitaire', 'annee_universitaire', $fiche->annee_universitaire ?? '');
    field('Date de création', 'date_creation', $fiche->date_creation ?? '', 'date');

    echo '</table><p><input type="submit" name="submit" class="button-primary" value="' . ($fiche ? 'Mettre à jour' : 'Ajouter') . '"></p></form></div>';
}


add_action('user_new_form', function () {
    $current_user = wp_get_current_user();
    $user_institut_id = get_user_meta($current_user->ID, 'institut_id', true);

    if (in_array('um_admin_etablissement', $current_user->roles) && $user_institut_id) {
        // Injecter du JavaScript pour pré-sélectionner
        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.querySelector('select[name=\"institut_id\"]');
            if (select) {
                select.value = '" . esc_js($user_institut_id) . "';
                select.setAttribute('disabled', 'disabled'); // Facultatif : le rendre non modifiable
                // ajouter un input hidden pour forcer l'envoi de la valeur
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'institut_id';
                hidden.value = '" . esc_js($user_institut_id) . "';
                select.parentNode.appendChild(hidden);
            }
        });
        </script>
        ";
    }
});

add_action('edit_user_profile', 'ge_lock_institut_field_for_etablissement');
add_action('show_user_profile', 'ge_lock_institut_field_for_etablissement');

function ge_lock_institut_field_for_etablissement($user) {
    $current_user = wp_get_current_user();
    $my_institut_id = get_user_meta($current_user->ID, 'institut_id', true);

    if (in_array('um_admin_etablissement', $current_user->roles) && $my_institut_id) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.querySelector('select[name="institut_id"]');
            if (select) {
                select.value = "<?php echo esc_js($my_institut_id); ?>";
                select.setAttribute('disabled', 'disabled');

                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'institut_id';
                hidden.value = "<?php echo esc_js($my_institut_id); ?>";
                select.parentNode.appendChild(hidden);
            }
        });
        </script>
        <?php
    }
}



