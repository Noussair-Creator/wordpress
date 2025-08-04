<?php
/*
Plugin Name: Email Inscription
Description: Envoi automatique d’un email avec identifiants à l’inscription + configuration SMTP et modèles.
Version: 1.1
Author: Clickerp
*/

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'install.php';
register_activation_hook(__FILE__, 'email_inscription_create_tables');

add_action('user_register', 'email_inscription_envoyer_email_automatique', 10, 1);

// MENU ADMIN
add_action('admin_menu', 'email_inscription_register_admin_menu');
function email_inscription_register_admin_menu() {
    add_menu_page('Configuration Email', 'Email SMTP', 'manage_options', 'email-inscription-config', 'email_inscription_config_page', 'dashicons-email', 60);
    add_submenu_page('email-inscription-config', 'Modèles d’e-mails', 'Modèles', 'manage_options', 'email-templates', 'email_inscription_template_list_page');
}

// PAGE CONFIGURATION SMTP
function email_inscription_config_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'email_notifications_config';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && current_user_can('manage_options')) {
        $data = [
            'smtp_host'       => sanitize_text_field($_POST['smtp_host']),
            'smtp_port'       => intval($_POST['smtp_port']),
            'smtp_username'   => sanitize_text_field($_POST['smtp_username']),
            'smtp_password'   => sanitize_text_field($_POST['smtp_password']),
            'smtp_secure'     => sanitize_text_field($_POST['smtp_secure']),
            'smtp_from'       => sanitize_email($_POST['smtp_from']),
            'smtp_from_name'  => sanitize_text_field($_POST['smtp_from_name']),
        ];
        $wpdb->update($table, $data, ['is_active' => 1]);
        echo '<div class="updated"><p>Configuration mise à jour avec succès.</p></div>';
    }

    $config = $wpdb->get_row("SELECT * FROM $table WHERE is_active = 1 LIMIT 1");

    echo '<div class="wrap"><h1>Configuration SMTP</h1><form method="post"><table class="form-table">';
    echo '<tr><th>Hôte SMTP</th><td><input type="text" name="smtp_host" value="' . esc_attr($config->smtp_host) . '" required></td></tr>';
    echo '<tr><th>Port</th><td><input type="number" name="smtp_port" value="' . esc_attr($config->smtp_port) . '" required></td></tr>';
    echo '<tr><th>Nom utilisateur</th><td><input type="text" name="smtp_username" value="' . esc_attr($config->smtp_username) . '"></td></tr>';
    echo '<tr><th>Mot de passe</th><td><input type="password" name="smtp_password" value="' . esc_attr($config->smtp_password) . '"></td></tr>';
    echo '<tr><th>Sécurité</th><td><select name="smtp_secure"><option value="tls"' . selected($config->smtp_secure, 'tls', false) . '>TLS</option><option value="ssl"' . selected($config->smtp_secure, 'ssl', false) . '>SSL</option></select></td></tr>';
    echo '<tr><th>Email expéditeur</th><td><input type="email" name="smtp_from" value="' . esc_attr($config->smtp_from) . '" required></td></tr>';
    echo '<tr><th>Nom expéditeur</th><td><input type="text" name="smtp_from_name" value="' . esc_attr($config->smtp_from_name) . '" required></td></tr>';
    echo '</table><p><input type="submit" class="button button-primary" value="Enregistrer"></p></form></div>';
}

// PAGE GESTION MODÈLES EMAIL
function email_inscription_template_list_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'email_notification_templates';

    if (isset($_POST['save_template'])) {
        $data = [
            'nom_modele' => sanitize_text_field($_POST['nom_modele']),
            'sujet'      => sanitize_text_field($_POST['sujet']),
            'corps'      => wp_kses_post($_POST['corps']),
            'actif'      => isset($_POST['actif']) ? 1 : 0
        ];
        if (!empty($_POST['template_id'])) {
            $wpdb->update($table, $data, ['id' => intval($_POST['template_id'])]);
        } else {
            $wpdb->insert($table, $data);
        }
    }

    $edit_template = null;
    if (isset($_GET['edit'])) {
        $edit_template = $wpdb->get_row("SELECT * FROM $table WHERE id = " . intval($_GET['edit']));
    }

    echo '<div class="wrap"><h1>Modèles d’e-mails</h1>';
    echo '<form method="post">';
    if ($edit_template) {
        echo '<input type="hidden" name="template_id" value="' . intval($edit_template->id) . '">';
    }
    echo '<table class="form-table">';
    echo '<tr><th>Nom du modèle</th><td><input type="text" name="nom_modele" value="' . esc_attr($edit_template->nom_modele ?? '') . '" required></td></tr>';
    echo '<tr><th>Sujet</th><td><input type="text" name="sujet" value="' . esc_attr($edit_template->sujet ?? '') . '" required></td></tr>';
    echo '<tr><th>Contenu</th><td>';
    wp_editor($edit_template->corps ?? '', 'corps');
    echo '</td></tr>';
    echo '<tr><th>Actif</th><td><input type="checkbox" name="actif" value="1" ' . checked($edit_template->actif ?? true, 1, false) . '></td></tr>';
    echo '</table><p><input type="submit" name="save_template" class="button-primary" value="' . ($edit_template ? 'Mettre à jour' : 'Ajouter') . '"></p></form>';

    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");

    echo '<h2>Modèles existants</h2>';
    echo '<table class="widefat striped"><thead><tr><th>ID</th><th>Nom</th><th>Sujet</th><th>Actif</th><th>Actions</th></tr></thead><tbody>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . esc_html($row->id) . '</td>';
        echo '<td>' . esc_html($row->nom_modele) . '</td>';
        echo '<td>' . esc_html($row->sujet) . '</td>';
        echo '<td>' . ($row->actif ? '✔️' : '❌') . '</td>';
        echo '<td><a href="?page=email-templates&edit=' . $row->id . '" class="button">✏️ Modifier</a></td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}



function email_inscription_envoyer_email_automatique($user_id) {
    global $wpdb;
    $user = get_userdata($user_id);
    if (!$user) return;

    $to      = $user->user_email;
    $login   = $user->user_login;

    $email = $user->user_email;

    $password = get_user_meta($user_id, 'raw_password', true);

    $password = get_user_meta($user_id, 'raw_password', true);

    // Vérifier si le mot de passe est absent ou trop court
    if (empty($password) || strlen($password) < 8) {
        // Générer un mot de passe fort (longueur 10, lettres/chiffres/symboles)
        $password = wp_generate_password(10, true, true);

        // Appliquer le mot de passe à l'utilisateur
        wp_set_password($password, $user_id);

        // Sauvegarder une copie brute uniquement si tu en as besoin (à usage temporaire)
        update_user_meta($user_id, 'raw_password', $password);
    }



    // Config SMTP
    $config = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}email_notifications_config WHERE is_active = 1 LIMIT 1");
    if (!$config) return;

    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    require_once ABSPATH . WPINC . '/class-smtp.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->Host       = $config->smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $config->smtp_username;
    $mail->Password   = $config->smtp_password;
    $mail->SMTPSecure = $config->smtp_secure;
    $mail->Port       = $config->smtp_port;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($config->smtp_from, $config->smtp_from_name);
    $mail->addAddress($to);
    $mail->isHTML(true);

    $source = get_user_meta($user_id, 'registration_source', true);

    // 🎓 Email pour les candidats
    if ($source === 'candidature') {
        $mail->Subject = '🎓 Accès à votre espace candidat – Plateforme Mastère';
        $mail->Body = "
            <p>Bonjour {$user->display_name},</p>

            <p>Votre compte candidat vient d’être activé sur la plateforme des mastères.</p>

            <p><strong>Identifiant :</strong> {$email}<br>
            <strong>Mot de passe :</strong> {$password}</p>

            <p>Accédez à votre espace ici :<br>
            <a href='" . site_url('/') . "' target='_blank'>" . site_url('/') . "</a></p>

            <p style='color:gray;font-size:12px'>Ce mot de passe est généré automatiquement. Pensez à le modifier après connexion.</p>
            <p>Cordialement,<br>L’équipe administrative</p>
        ";
    } else {
        // 💼 Autres rôles : admin => wp-admin, sinon accueil
        // $redirect_url = in_array('administrator', $user->roles) ? admin_url() : site_url('/');
        $admin_roles = ['administrator', 'um_admin_utm', 'um_admin_etablissement'];

        $redirect_url = array_intersect($user->roles, $admin_roles) ? admin_url() : site_url('/');

        $mail->Subject = 'Votre inscription est confirmée';
        $mail->Body = "
            <p>Bonjour,</p>
            <p>Votre compte a été créé avec succès.</p>
            <p><strong>Login :</strong> {$email}</p>
            <p><strong>Mot de passe :</strong> {$password}</p>
            <p><a href='" . esc_url($redirect_url) . "'>Se connecter à la plateforme</a></p>
        ";
    }

    // Envoi et log
    $status = 'sent';
    $error  = null;

    if (!$mail->send()) {
        $status = 'error';
        $error  = $mail->ErrorInfo;
    }

    $wpdb->insert("{$wpdb->prefix}email_notifications_log", [
        'user_id'       => $user_id,
        'email_to'      => $to,
        'subject'       => $mail->Subject,
        'body'          => $mail->Body,
        'status'        => $status,
        'error_message' => $error,
        'sent_at'       => current_time('mysql')
    ]);
}


function email_inscription_envoyer_resultat_candidat($user_id, $libelle_resultat) {
  global $wpdb;

  $user = get_userdata($user_id);
  if (!$user) return;

  $to = $user->user_email;
  $prenom = $user->first_name;
  $nom = $user->last_name;


  // Charger modèle "Résultat" actif
  $template = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}email_notification_templates WHERE actif = 1 AND nom_modele = 'resultat_candidat' LIMIT 1");
  if (!$template) return;

  // Remplacer les variables dynamiques dans le corps
  $sujet = str_replace(['{{prenom}}', '{{nom}}', '{{resultat}}'], [$prenom, $nom, $libelle_resultat], $template->sujet);
  $corps = str_replace(['{{prenom}}', '{{nom}}', '{{resultat}}'], [$prenom, $nom, $libelle_resultat], $template->corps);

  // Config SMTP
  $config = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}email_notifications_config WHERE is_active = 1 LIMIT 1");
  if (!$config) return;

  require_once ABSPATH . WPINC . '/class-phpmailer.php';
  require_once ABSPATH . WPINC . '/class-smtp.php';

  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->isSMTP();
  $mail->Host       = $config->smtp_host;
  $mail->SMTPAuth   = true;
  $mail->Username   = $config->smtp_username;
  $mail->Password   = $config->smtp_password;
  $mail->SMTPSecure = $config->smtp_secure;
  $mail->Port       = $config->smtp_port;
  $mail->CharSet    = 'UTF-8';

  $mail->setFrom($config->smtp_from, $config->smtp_from_name);
  $mail->addAddress($to);
  $mail->isHTML(true);
  $mail->Subject = $sujet;
  $mail->Body    = $corps;

  $status = 'sent';
  $error = null;

  if (!$mail->send()) {
    $status = 'error';
    $error = $mail->ErrorInfo;
  }

  $wpdb->insert("{$wpdb->prefix}email_notifications_log", [
    'user_id'       => $user_id,
    'email_to'      => $to,
    'subject'       => $mail->Subject,
    'body'          => $mail->Body,
    'status'        => $status,
    'error_message' => $error,
    'sent_at'       => current_time('mysql')
  ]);
}
