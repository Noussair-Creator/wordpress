<?php
/*
Plugin Name: Secure Login CLICKERP
Description: Connexion sécurisée avec code de vérification par e-mail pour plateforme universitaire.
Version: 1.0.4
Author: Clickerp
*/

define('SL_PATH', plugin_dir_path(__FILE__));
define('SL_URL', plugin_dir_url(__FILE__));

add_action('init', function () {
    if (!session_id()) session_start();
});

require_once SL_PATH . 'includes/mailer.php';


require_once SL_PATH . 'includes/shortcodes.php';
require_once SL_PATH . 'includes/login-handler.php';

function sl_enqueue_assets() {
    wp_enqueue_style('sl-style', SL_URL . 'assets/css/style.css');
    wp_enqueue_script('sl-script', SL_URL . 'assets/js/script.js', [], false, true);
}

add_action('wp_enqueue_scripts', 'sl_enqueue_assets');

add_action('init', function () {
    if (!session_id()) session_start();

    // Si l'utilisateur est déconnecté et que sl_step existe : on le supprime
    /*
    if (!is_user_logged_in() && isset($_SESSION['sl_step'])) {
        unset($_SESSION['sl_step']);
        unset($_SESSION['sl_code']);
        unset($_SESSION['sl_user_id']);
    }
    */

    // Traitement demande de réinitialisation
    if (isset($_POST['sl_request_reset'])) {
        $email = sanitize_email($_POST['sl_reset_email']);
        $user = get_user_by('email', $email);

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires = time() + 3600;

            update_user_meta($user->ID, 'sl_reset_token', $token);
            update_user_meta($user->ID, 'sl_reset_expires', $expires);

            $reset_link = add_query_arg([
                'sl_reset' => 1,
                'uid' => $user->ID,
                'token' => $token
            ], home_url('/connexion'));

            $subject = "Réinitialisation du mot de passe - Plateforme UTM";
            $html_body = "
                <p>Bonjour,</p>
                <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>
                <p><a href='$reset_link'>Cliquez ici pour créer un nouveau mot de passe</a> (valable 1h)</p>
                <p>Si vous n'avez pas fait cette demande, ignorez cet e-mail.</p>
            ";

            secure_login_send_mail($email, $subject, $html_body);
            $_SESSION['sl_lostpass_msg'] = "Un lien de réinitialisation a été envoyé.";
        } else {
            $_SESSION['sl_lostpass_msg'] = "Adresse non trouvée.";
        }

        wp_redirect(home_url('/mot-de-passe-oublie'));
        exit;
    }


    // Affichage du formulaire nouveau mot de passe
    if (isset($_GET['sl_reset']) && $_GET['sl_reset'] == 1 && isset($_GET['uid'], $_GET['token'])) {
        $_SESSION['sl_reset_uid'] = intval($_GET['uid']);
        $_SESSION['sl_reset_token'] = sanitize_text_field($_GET['token']);
    }

    // Traitement soumission du nouveau mot de passe
    if (isset($_POST['sl_set_new_password'])) {
        $uid = $_SESSION['sl_reset_uid'] ?? null;
        $token = $_SESSION['sl_reset_token'] ?? null;
        $pass1 = sanitize_text_field($_POST['new_password'] ?? '');
        $pass2 = sanitize_text_field($_POST['confirm_password'] ?? '');

        if ($uid && $token && $pass1 && $pass2 && $pass1 === $pass2) {
            $stored_token = get_user_meta($uid, 'sl_reset_token', true);
            $expires = get_user_meta($uid, 'sl_reset_expires', true);

            if ($stored_token === $token && time() <= intval($expires)) {


                wp_set_password($pass1, $uid);
                delete_user_meta($uid, 'sl_reset_token');
                delete_user_meta($uid, 'sl_reset_expires');

                // ✅ Nettoyer la session
                unset($_SESSION['sl_reset_uid'], $_SESSION['sl_reset_token']);

                $_SESSION['sl_lostpass_msg'] = "Mot de passe modifié avec succès. Vous pouvez maintenant vous connecter.";
                wp_redirect(home_url('/connexion'));
                exit;


            } else {
                $_SESSION['sl_reset_error'] = "Lien expiré ou invalide.";
            }
        } else {
            $_SESSION['sl_reset_error'] = "Mot de passe invalide ou non confirmé.";
        }
    }


   if (isset($_POST['sl_verify_code'])) {
        $code = implode('', array_map('sanitize_text_field', $_POST['code'] ?? []));
        
        if ($code == ($_SESSION['sl_code'] ?? '')) {
            wp_set_auth_cookie($_SESSION['sl_user_id']);
            $user = get_userdata($_SESSION['sl_user_id']);

            // ✅ Nettoyer toutes les sessions liées à la vérification
            unset($_SESSION['sl_step'], $_SESSION['sl_code'], $_SESSION['sl_email'], $_SESSION['sl_user_id']);

            // ✅ Rediriger vers la page de connexion pour forcer un état propre
            wp_redirect(home_url('/connexion'));
            exit;
        } else {
            $_SESSION['sl_code_error'] = 'Code incorrect.';
        }
    }






});



/*
add_action('template_redirect', function () {
    // Si page d'accueil ET utilisateur non connecté
    if (is_front_page() && !is_user_logged_in()) {
        wp_redirect(home_url('/connexion')); // ou /connexion selon ta page
        exit;
    }
});
*/

add_action('template_redirect', function () {
    if (!is_user_logged_in()) {
        // Pages protégées : rediriger vers /login
        if (is_page('espace-service') || is_page('espace-coordinateur') || is_page('espace-admin')) {
            wp_redirect(home_url('/connexion'));
            exit;
        }
    }
});


add_shortcode('secure_lostpassword', function () {
    ob_start();
    include SL_PATH . 'templates/lost-password.php';
    return ob_get_clean();
});
