<?php
function email_inscription_create_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $prefix = $wpdb->prefix;

    $sql_log = "CREATE TABLE {$prefix}email_notifications_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL,
        email_to VARCHAR(255) NOT NULL,
        subject VARCHAR(255),
        body LONGTEXT,
        status ENUM('sent','error') DEFAULT 'sent',
        error_message TEXT,
        sent_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    $sql_config = "CREATE TABLE {$prefix}email_notifications_config (
        id INT AUTO_INCREMENT PRIMARY KEY,
        smtp_host VARCHAR(255),
        smtp_port INT,
        smtp_username VARCHAR(255),
        smtp_password VARCHAR(255),
        smtp_secure ENUM('ssl','tls'),
        smtp_from VARCHAR(255),
        smtp_from_name VARCHAR(255),
        is_active BOOLEAN DEFAULT 1
    ) $charset_collate;";

    $sql_templates = "CREATE TABLE {$prefix}email_notification_templates (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom_modele VARCHAR(100),
        sujet VARCHAR(255),
        corps LONGTEXT,
        actif BOOLEAN DEFAULT TRUE
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql_log);
    dbDelta($sql_config);
    dbDelta($sql_templates);

    // Insert config par défaut
    $existing = $wpdb->get_var("SELECT COUNT(*) FROM {$prefix}email_notifications_config");
    if (!$existing) {
        $wpdb->insert("{$prefix}email_notifications_config", [
            'smtp_host'       => 'smtp.exemple.com',
            'smtp_port'       => 587,
            'smtp_username'   => 'noreply@exemple.com',
            'smtp_password'   => 'motdepasse',
            'smtp_secure'     => 'tls',
            'smtp_from'       => 'noreply@exemple.com',
            'smtp_from_name'  => 'Plateforme Étudiant',
            'is_active'       => 1
        ]);
    }
}
