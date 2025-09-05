<?php
if (!defined('ABSPATH')) exit;

class PublicationService
{
    /**
     * Crée une publication dans la table personnalisée {prefix}_recherche_publication
     * $payload: [
     *   'type','title','summary','comment','submission_date','status'
     * ]
     * $file: ['id'=>int, 'url'=>string] (upload WP Media déjà fait en amont)
     */
    public static function create(array $payload, array $file = [])
    {
        global $wpdb;

        // Table "à la réclamation" : même style de write direct en SQL
        $table = $wpdb->prefix . 'recherche_publication';

        $ownerId = (int) get_current_user_id(); // toujours
        $created = current_time('mysql');

        $type   = sanitize_text_field($payload['type'] ?? '');
        $title  = sanitize_text_field($payload['title'] ?? '');
        $sum    = wp_kses_post($payload['summary'] ?? '');
        $comm   = wp_kses_post($payload['comment'] ?? '');
        $subDt  = sanitize_text_field($payload['submission_date'] ?? '');
        $status = sanitize_text_field($payload['status'] ?? 'draft'); // 'draft' | 'pending'

        // Pièce jointe (optionnelle) – même pattern que réclamation
        $pPath = (string) ($file['url'] ?? '');
        $pId   = (int)    ($file['id']  ?? 0);

        if ($title === '') {
            return new WP_Error('bad_request', 'Le titre est obligatoire.');
        }

        // Insertion SQL directe (comme ReclamationService)
        $sql = "
          INSERT INTO `{$table}`
          (`owner_user_id`,`type`,`submission_date`,`title`,`summary`,`comment`,`piece_jointe_path`,`piece_jointe_id`,`status`,`created_at`,`updated_at`)
          VALUES (%d, %s, %s, %s, %s, %s, %s, %d, %s, %s, %s)
        ";
        $prepared = $wpdb->prepare($sql,
            $ownerId, $type, $subDt, $title, $sum, $comm, $pPath, $pId, $status, $created, $created
        );

        $ok = $wpdb->query($prepared);
        if ($ok === false) {
            return new WP_Error('db_insert_error', 'Insertion DB échouée: ' . $wpdb->last_error);
        }

        return [
            'insert_id' => (int) $wpdb->insert_id,
            'stored' => [
                'owner_user_id'     => $ownerId,
                'type'              => $type,
                'submission_date'   => $subDt,
                'title'             => $title,
                'summary'           => $sum,
                'comment'           => $comm,
                'piece_jointe_path' => $pPath,
                'piece_jointe_id'   => $pId,
                'status'            => $status,
                'created_at'        => $created,
            ],
        ];
    }
}
