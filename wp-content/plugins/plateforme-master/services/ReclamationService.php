<?php
if (!defined('ABSPATH')) exit;

class ReclamationService
{
    public static function create(array $payload, array $file = [])
    {
        global $wpdb;

        $table = $wpdb->prefix . 'student_reclamations';

        $isAnon   = !empty($payload['anonymous']) && (string)$payload['anonymous'] !== '0';
        $ownerId  = (int) get_current_user_id();            // toujours
        $etuId    = $isAnon ? null : $ownerId;              // NULL si anonyme
        $created  = current_time('mysql');

        $type  = sanitize_text_field($payload['type']    ?? '');
        $sujet = sanitize_text_field($payload['subject'] ?? '');
        $msg   = wp_kses_post($payload['message']        ?? '');
        $pPath = (string) ($file['url'] ?? '');
        $pId   = (int)    ($file['id']  ?? 0);
        $anon  = $isAnon ? 1 : 0;

        if ($isAnon) {
            $sql = "
              INSERT INTO `{$table}`
              (`owner_user_id`,`etudiant_id`,`type`,`sujet`,`message`,`piece_jointe_path`,`piece_jointe_id`,`is_anonymous`,`created_at`)
              VALUES (%d, NULL, %s, %s, %s, %s, %d, %d, %s)
            ";
            $prepared = $wpdb->prepare($sql, $ownerId, $type, $sujet, $msg, $pPath, $pId, $anon, $created);
        } else {
            $sql = "
              INSERT INTO `{$table}`
              (`owner_user_id`,`etudiant_id`,`type`,`sujet`,`message`,`piece_jointe_path`,`piece_jointe_id`,`is_anonymous`,`created_at`)
              VALUES (%d, %d, %s, %s, %s, %s, %d, %d, %s)
            ";
            $prepared = $wpdb->prepare($sql, $ownerId, $etuId, $type, $sujet, $msg, $pPath, $pId, $anon, $created);
        }

        $ok = $wpdb->query($prepared);
        if ($ok === false) {
            return new WP_Error('db_insert_error', 'Insertion DB échouée: ' . $wpdb->last_error);
        }

        return [
            'insert_id' => (int) $wpdb->insert_id,
            'stored' => [
                'owner_user_id'     => $ownerId,
                'etudiant_id'       => $etuId,
                'type'              => $type,
                'sujet'             => $sujet,
                'message'           => $msg,
                'piece_jointe_path' => $pPath,
                'piece_jointe_id'   => $pId,
                'is_anonymous'      => $anon,
                'created_at'        => $created,
            ],
        ];
    }
}
