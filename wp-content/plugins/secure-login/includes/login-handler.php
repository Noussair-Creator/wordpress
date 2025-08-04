<?php
add_action('init', function () {

    $_SESSION['sl_email'] = $email;

    // Étape 1 : Login
    if (isset($_POST['sl_login_submit'])) {
        $email = sanitize_email($_POST['sl_email']);
        $password = sanitize_text_field($_POST['sl_password']);

        $user = get_user_by('email', $email);
        if ($user && wp_check_password($password, $user->user_pass, $user->ID)) {
            $_SESSION['sl_user_id'] = $user->ID;
            $_SESSION['sl_code'] = rand(1000, 9999);
            $_SESSION['sl_step'] = 'verify';

           /* wp_mail($email, 'Votre code de vérification', 'Votre code est : ' . $_SESSION['sl_code']);*/

           $code = $_SESSION['sl_code'];
            $to = $email;
            $subject = "Code de vérification - Plateforme UTM";

            $html_body = "
                <p>Bonjour,</p>
                <p>Voici votre code de vérification :</p>
                <div style='
                    font-size: 28px;
                    font-weight: bold;
                    letter-spacing: 12px;
                    color: #b40000;
                '>$code</div>
                <p>Merci de le saisir pour finaliser votre connexion.</p>
                <p><em>Université de Tunis El Manar</em></p>
            ";

            secure_login_send_mail($to, $subject, $html_body);

        } else {
            $_SESSION['sl_error'] = 'Email ou mot de passe incorrect.';
        }
    }

    // Étape 2 : Vérification du code
    if (isset($_POST['sl_verify_code'])) {
        $code = implode('', array_map('sanitize_text_field', $_POST['code'] ?? []));
        if ($code == $_SESSION['sl_code']) {
            wp_set_auth_cookie($_SESSION['sl_user_id']);
            $user = get_userdata($_SESSION['sl_user_id']);


            
            // ✅ Nettoyage des sessions de vérification
            unset($_SESSION['sl_step'], $_SESSION['sl_code']);

            // Redirection personnalisée
            if (in_array('administrator', $user->roles)) {
                wp_redirect(admin_url());
            } 
            elseif (in_array('um_admin_utm', $user->roles)) {
                wp_redirect(admin_url());
                exit;
            }
            elseif (in_array('um_admin_etablissement', $user->roles)) {
                wp_redirect(admin_url());
                exit;
            }
            elseif (in_array('um_coordonnateur-master', $user->roles)) {
                wp_redirect(home_url('/espace-coordinateur'));
            } elseif (in_array('um_service-master', $user->roles)) {
                wp_redirect(home_url('/espace-service'));
            }
            elseif (in_array('um_candidat', $user->roles)) {
                wp_redirect(home_url('/depot-candidature/'));
            }
            elseif (in_array('um_service-utm', $user->roles)) {
                wp_redirect(home_url('/espace-ecoledoctorale/'));
            }
            elseif (in_array('um_ecole_doctorale', $user->roles)) {
                wp_redirect(home_url('/espace_ecole_doctorale/'));
            }
            elseif (in_array('um_directeur_these', $user->roles)) {
                wp_redirect(home_url('/espace_directeurthese/'));
            }
            elseif (in_array('um_commission_ed', $user->roles)) {
                wp_redirect(home_url('/espace-comissioned/'));
            }
             elseif (in_array('um_doctorant', $user->roles)) {
                wp_redirect(home_url('/espace-doctorant/'));
            }
            elseif (in_array('um_directeur_laboratoire', $user->roles)) {
                wp_redirect(home_url('/espace-directeur-de-recherche/'));
            }
            elseif (in_array('um_chercheur', $user->roles)) {
                wp_redirect(home_url('/espace-chercheur/'));
            }
            elseif (in_array('um_student_master', $user->roles)) {
                wp_redirect(home_url('/espace_etudiant_master/'));
            }
            elseif (in_array('um_service-etablissement', $user->roles)) {
                wp_redirect(home_url('/espace-ecoledoctorale/'));
            }
            exit;
        } else {
            $_SESSION['sl_code_error'] = 'Code incorrect.';
        }
    }

    // Renvoi du code
    if (isset($_POST['sl_resend_code'])) {
        $user = get_userdata($_SESSION['sl_user_id']);
        $_SESSION['sl_code'] = rand(1000, 9999);
        wp_mail($user->user_email, 'Nouveau code de vérification', 'Votre nouveau code est : ' . $_SESSION['sl_code']);
    }

    add_action('wp_logout', function () {
        wp_redirect(home_url('/connexion'));
        exit;
    });
        
});
