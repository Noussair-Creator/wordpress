<?php
defined('ABSPATH') || exit;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function secure_login_send_mail($to, $subject, $html_message) {
    global $wpdb;

    // Récupération de la configuration SMTP active
    $config = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}email_notifications_config WHERE is_active = 1 LIMIT 1");
    if (!$config) {
        error_log('secure-login: Aucune configuration SMTP active trouvée.');
        return false;
    }

    // Inclusion de PHPMailer natif de WordPress
    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    require_once ABSPATH . WPINC . '/class-smtp.php';

    $mail = new PHPMailer(true);

    try {
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
        $mail->Subject = $subject;
        $mail->Body    = $html_message;

        $success = $mail->send();

        $wpdb->insert("{$wpdb->prefix}email_notifications_log", [
            'user_id'       => get_current_user_id() ?: 0,
            'email_to'      => $to,
            'subject'       => $subject,
            'body'          => $html_message,
            'status'        => $success ? 'sent' : 'error',
            'error_message' => $success ? null : $mail->ErrorInfo,
            'sent_at'       => current_time('mysql')
        ]);

        return $success;
    } catch (Exception $e) {
        // Log en cas d'échec
        $wpdb->insert("{$wpdb->prefix}email_notifications_log", [
            'user_id'       => get_current_user_id() ?: 0,
            'email_to'      => $to,
            'subject'       => $subject,
            'body'          => $html_message,
            'status'        => 'error',
            'error_message' => $mail->ErrorInfo,
            'sent_at'       => current_time('mysql')
        ]);

        error_log('secure-login: Erreur lors de l\'envoi d\'email : ' . $mail->ErrorInfo);
        return false;
    }
}
