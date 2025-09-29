<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$table_reunion     = $wpdb->prefix . "reunion";
$table_participant = $wpdb->prefix . "reunion_participants";
$table_users       = $wpdb->prefix . "users"; // table des utilisateurs internes

/* ============================
   Services Réunion
   ============================ */

function reunion_list($uid, $filters) {
    global $wpdb, $table_reunion, $table_participant;

    $user  = get_userdata($uid);
    $roles = (array) $user->roles;

    $where = "1=1";
    $args  = [];

    // --- Cas service UTM => tout voir
    if (in_array('um_service-utm', $roles)) {
        // aucun filtre
    }
    // --- Cas établissement => filtrer par institut_id
    elseif (in_array('um_service-etablissement', $roles)) {
        $etab_id = intval(get_user_meta($uid, 'institut_id', true));
        if ($etab_id) {
            $where .= " AND r.etablissement_id = %d";
            $args[] = $etab_id;
        } else {
            return [];
        }
    }
    // --- Cas normal => réunions créées par l’utilisateur OU où il est participant
    else {
        $where .= " AND (r.created_by = %d OR EXISTS (
            SELECT 1 FROM $table_participant p 
            WHERE p.reunion_id = r.id AND p.user_id = %d
        ))";
        $args[] = $uid;
        $args[] = $uid;
    }

    $sql = $wpdb->prepare("
        SELECT r.*,
               COUNT(p.id) AS nb_participants
        FROM $table_reunion r
        LEFT JOIN $table_participant p ON p.reunion_id = r.id
        WHERE $where
        GROUP BY r.id
        ORDER BY r.date_reunion DESC
        LIMIT %d OFFSET %d
    ", array_merge($args, [$filters['limit'], $filters['offset']]));



    $results = $wpdb->get_results($sql, ARRAY_A);

    // ✅ Formatage de la date en jj/mm/yyyy
    foreach ($results as &$row) {
        if (!empty($row['date_reunion']) && $row['date_reunion'] != '0000-00-00') {
            $row['date_reunion'] = date("d/m/Y", strtotime($row['date_reunion']));
        }
    }

    return $results;
}



function reunion_create($uid, $payload) {
    global $wpdb, $table_reunion, $table_participant, $table_users;

    // --- récupérer automatiquement l'établissement de l'utilisateur connecté
    $etab_id = intval(get_user_meta($uid, 'institut_id', true));
    if (!$etab_id) {
        return new WP_Error('no_institut', "Aucun institut associé à cet utilisateur", ['status' => 400]);
    }

    $sujet = sanitize_text_field($payload['sujet'] ?? '');
    $date  = sanitize_text_field($payload['date_reunion'] ?? '');
    $duree = intval($payload['duree'] ?? 0);

    // --- gérer fichier upload
    $fichier = null;
    if (!empty($_FILES['fichier']['name'])) {
        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . '/reunion';
        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir);
        }
        $filename    = sanitize_file_name($_FILES['fichier']['name']);
        $target_file = $target_dir . '/' . time() . '-' . $filename;

        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file)) {
            $fichier = $upload_dir['baseurl'] . '/reunion/' . basename($target_file);
        }
    }

    // --- vérifier les participants AVANT d'insérer la réunion
    $emails = [];
    if (!empty($payload['emails'])) {
        if (is_string($payload['emails'])) {
            $emails = json_decode($payload['emails'], true);
        } elseif (is_array($payload['emails'])) {
            $emails = $payload['emails'];
        }
    }

    foreach ($emails as $email) {
        $email = sanitize_email($email);
        if (!is_email($email)) {
            return new WP_Error('invalid_email', "Email invalide: $email", ['status'=>400]);
        }
        $user_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_users WHERE user_email=%s", $email));
        if (!$user_id) {
            return new WP_Error('user_not_found', "Le compte avec l’email $email n’existe pas", ['status'=>404]);
        }
    }

    // --- insertion réunion
    $inserted = $wpdb->insert($table_reunion, [
        'sujet'            => $sujet,
        'date_reunion'     => $date,
        'duree'            => $duree,
        'fichier'          => $fichier,
        'etablissement_id' => $etab_id,
        'created_by'       => $uid,
        'created_at'       => current_time('mysql'),
        'updated_at'       => current_time('mysql'),
    ]);

    if (!$inserted) {
        return new WP_Error('db_error','Échec création réunion',['status'=>500]);
    }

    $reunion_id = $wpdb->insert_id;

    // --- insertion participants
    $reunion = reunion_get($uid, $reunion_id);
    foreach ($emails as $email) {
        $email   = sanitize_email($email);
        $user_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_users WHERE user_email=%s", $email));

        if ($user_id) {
            $wpdb->insert($table_participant, [
                'reunion_id'       => $reunion_id,
                'user_id'          => intval($user_id),
                'email'            => $email,
                'statut'           => 'invité',
                'etablissement_id' => $etab_id,
                'created_by'       => $uid,
                'created_at'       => current_time('mysql'),
                'updated_at'       => current_time('mysql'),
            ]);

            // --- envoi invitation
            reunion_send_invitation($email, $reunion);
        }
    }

    return ['status'=>'success','id'=>$reunion_id];
}

function reunion_get($uid, $id) {
    global $wpdb, $table_reunion, $table_participant;

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_reunion WHERE id=%d", $id), ARRAY_A);
    if (!$row) {
        return new WP_Error('not_found','Réunion introuvable',['status'=>404]);
    }

    // Récupérer participants
    $participants = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table_participant WHERE reunion_id=%d", $id),
        ARRAY_A
    );

    // Ajouter photo de profil pour chaque participant
    foreach ($participants as &$p) {
        if (!empty($p['user_id'])) {
            $p['avatar_url'] = get_avatar_url($p['user_id'], ['size' => 64]);
        } else {
            // fallback si pas de user_id (on peut générer un avatar par email)
            $p['avatar_url'] = get_avatar_url($p['email'], ['size' => 64]);
        }
    }

    $row['participants'] = $participants;

    return $row;
}


function reunion_update($uid, $id, $patch) {
    global $wpdb, $table_reunion, $table_participant, $table_users;

    // --- maj réunion ---
    $data = [];
    if (!empty($patch['sujet'])) $data['sujet'] = sanitize_text_field($patch['sujet']);
    if (!empty($patch['date_reunion'])) $data['date_reunion'] = sanitize_text_field($patch['date_reunion']);
    if (isset($patch['duree'])) $data['duree'] = intval($patch['duree']);
    if (!empty($patch['etablissement_id'])) $data['etablissement_id'] = intval($patch['etablissement_id']);

    if (!empty($data)) {
        $data['updated_at'] = current_time('mysql');
        $wpdb->update($table_reunion, $data, ['id'=>$id]);
    }

    // --- synchronisation des participants ---
    if (!empty($patch['emails'])) {
        $emails = [];
        if (is_string($patch['emails'])) {
            $emails = json_decode($patch['emails'], true);
        } elseif (is_array($patch['emails'])) {
            $emails = $patch['emails'];
        }

        // supprimer les participants existants
        $wpdb->delete($table_participant, ['reunion_id' => $id]);
        // récupérer infos de la réunion (pour l’email)
            $reunion = reunion_get($uid, $id);

        foreach ($emails as $email) {
            $email = sanitize_email($email);
            if (!is_email($email)) continue;

            //  bien utiliser user_email (comme dans reunion_create)
            $user = $wpdb->get_row(
                $wpdb->prepare("SELECT id FROM $table_users WHERE user_email=%s", $email),
                ARRAY_A
            );

            if (!$user) continue; // ignorer si pas trouvé

            $wpdb->insert($table_participant, [
                'reunion_id'       => $id,
                'user_id'          => intval($user['id']),
                'email'            => $email,
                'statut'           => 'invité',
                'etablissement_id' => intval($patch['etablissement_id'] ?? 0),
                'created_by'       => $uid,
                'created_at'       => current_time('mysql'),
                'updated_at'       => current_time('mysql'),
            ]);
            reunion_send_invitation($email, $reunion);
        }
    }

    return reunion_get($uid, $id);
}



function reunion_delete($uid, $id) {
    global $wpdb, $table_reunion;
    $wpdb->delete($table_reunion, ['id'=>$id]);
    return ['status'=>'deleted','id'=>$id];
}
function reunion_remove_participants($uid, $reunion_id, $payload) {
    global $wpdb, $table_participant;

    if (empty($payload['emails']) || !is_array($payload['emails'])) {
        return new WP_Error('bad_request', 'emails[] requis', ['status' => 400]);
    }

    foreach ($payload['emails'] as $email) {
        $wpdb->delete(
            $table_participant,
            [
                'reunion_id' => intval($reunion_id),
                'email'      => sanitize_email($email),
            ],
            ['%d','%s']
        );
    }

    // On retourne la réunion mise à jour
    return reunion_get($uid, $reunion_id);
}
function reunion_add_participants($uid, $reunion_id, $payload) {
    global $wpdb, $table_participant, $table_users;

    if (empty($payload['emails']) || !is_array($payload['emails'])) {
        return new WP_Error('bad_request', 'emails[] requis', ['status' => 400]);
    }

    // Charger la réunion pour avoir les infos (sujet, date, etc.)
    $reunion = reunion_get($uid, $reunion_id);
    if (is_wp_error($reunion)) {
        return $reunion;
    }

    foreach ($payload['emails'] as $email) {
        $email = sanitize_email($email);

        // 1. Vérifier validité de l’email
        if (!is_email($email)) {
            return new WP_Error('invalid_email', "Email invalide: $email", ['status' => 400]);
        }

        // 2. Vérifier existence dans la table utm_users
        $user = $wpdb->get_row(
            $wpdb->prepare("SELECT id, email, prenom, nom FROM $table_users WHERE email = %s", $email),
            ARRAY_A
        );

        if (!$user) {
            return new WP_Error('user_not_found', "Le compte avec l’email $email n’existe pas", ['status' => 404]);
        }

        // 3. Vérifier si déjà ajouté
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_participant WHERE reunion_id=%d AND user_id=%d",
            $reunion_id, $user['id']
        ));
        if ($exists) {
            continue; // éviter les doublons
        }

        // 4. Insertion
        $wpdb->insert($table_participant, [
            'reunion_id'      => intval($reunion_id),
            'user_id'         => intval($user['id']),
            'email'           => $user['email'],
            'statut'          => 'invité',
            'etablissement_id'=> intval($reunion['etablissement_id'] ?? 0),
            'created_by'      => $uid,
            'created_at'      => current_time('mysql'),
            'updated_at'      => current_time('mysql'),
        ]);

    }

    // Retourner la réunion avec liste actualisée
    return reunion_get($uid, $reunion_id);
}

/* ============================
   Fonction d’envoi de mail
   ============================ */

function reunion_send_invitation($email, $reunion) {
    global $wpdb;

    // Récup utilisateur WP destinataire
    $user = get_user_by('email', $email);
    $destinataire = $email;
    if ($user) {
        $prenom = get_user_meta($user->ID, 'first_name', true);
        $nom    = get_user_meta($user->ID, 'last_name', true);
        $fullname = trim($prenom . ' ' . $nom);
        $destinataire = !empty($fullname) ? $fullname : $user->display_name;
    }

    // Récup l’émetteur (celui qui a créé la réunion)
    $emetteur = "L'équipe UTM";
    if (!empty($reunion['created_by'])) {
        $creator = get_userdata($reunion['created_by']);
        if ($creator) {
            $prenomC = get_user_meta($creator->ID, 'first_name', true);
            $nomC    = get_user_meta($creator->ID, 'last_name', true);
            $fullnameC = trim($prenomC . ' ' . $nomC);
            $emetteur = !empty($fullnameC) ? $fullnameC : $creator->display_name;
        }
    }

    // Format date jj/mm/yyyy
    $date_fmt = !empty($reunion['date_reunion']) && $reunion['date_reunion'] != '0000-00-00'
        ? date("d/m/Y", strtotime($reunion['date_reunion']))
        : "Non spécifiée";

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
    $mail->addAddress($email, $destinataire);
    $mail->isHTML(true);

    // Sujet et corps
    $mail->Subject = "Invitation à la réunion : " . $reunion['sujet'];
    $mail->Body = "
        <p>Bonjour {$destinataire},</p>
        <p>Vous êtes invité(e) par <strong>{$emetteur}</strong> à participer à la réunion suivante :</p>
        <p><strong>Sujet :</strong> {$reunion['sujet']}<br>
        <strong>Date :</strong> {$date_fmt}<br>
        <strong>Durée :</strong> " . ($reunion['duree'] ? $reunion['duree']." minutes" : "Non spécifiée") . "</p>
        <p>Merci de confirmer votre présence.</p>
        <p>Cordialement,<br>{$emetteur}</p>
    ";

    $status = 'sent';
    $error  = null;
    if (!$mail->send()) {
        $status = 'error';
        $error  = $mail->ErrorInfo;
    }

    $wpdb->insert("{$wpdb->prefix}email_notifications_log", [
        'user_id'       => $user ? $user->ID : 0,
        'email_to'      => $email,
        'subject'       => $mail->Subject,
        'body'          => $mail->Body,
        'status'        => $status,
        'error_message' => $error,
        'sent_at'       => current_time('mysql')
    ]);
}

