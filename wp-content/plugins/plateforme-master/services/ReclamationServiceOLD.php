<?php
if (!defined('ABSPATH')) exit;

class ReclamationService {

    /** Nom de la table */
    public static function table(){
        global $wpdb;
        return $wpdb->prefix . 'reclamations';
    }

    /**
     * Création d'une réclamation
     * $payload keys: type, subject, message, anonymous(0/1)
     * $file     keys: id, url  (pièce jointe)
     */
    public static function create(array $payload, array $file = []) {
        global $wpdb;

        $table   = self::table();

        $ownerId = (int) get_current_user_id();   // toujours requis côté API
        if (!$ownerId) {
            return new WP_Error('auth', 'Utilisateur non connecté');
        }

        $isAnon  = !empty($payload['anonymous']) && (string)$payload['anonymous'] !== '0';
        $etuId   = $isAnon ? null : $ownerId;     // NULL si anonyme
        $created = current_time('mysql');

        $type    = sanitize_text_field($payload['type']    ?? '');
        $sujet   = sanitize_text_field($payload['subject'] ?? '');
        $msg     = wp_kses_post($payload['message']        ?? '');

        $pPath   = (string) ($file['url'] ?? '');
        $pId     = (int)    ($file['id']  ?? 0);
        $anon    = $isAnon ? 1 : 0;

        if ($sujet === '' || $msg === '') {
            return new WP_Error('bad_request', 'Sujet et message sont obligatoires.');
        }

        // On laisse la BDD mettre la valeur par défaut de statut_reponse si ta colonne a un DEFAULT.
        // Sinon tu peux forcer ici: $statut_reponse = 'En attente';

        if ($isAnon) {
            $sql = "
                INSERT INTO `{$table}`
                (`owner_user_id`,`etudiant_id`,`type`,`sujet`,`message`,
                 `piece_jointe_path`,`piece_jointe_id`,`is_anonymous`,`created_at`)
                VALUES (%d, NULL, %s, %s, %s, %s, %d, %d, %s)
            ";
            $prepared = $wpdb->prepare($sql,
                $ownerId, $type, $sujet, $msg, $pPath, $pId, $anon, $created
            );
        } else {
            $sql = "
                INSERT INTO `{$table}`
                (`owner_user_id`,`etudiant_id`,`type`,`sujet`,`message`,
                 `piece_jointe_path`,`piece_jointe_id`,`is_anonymous`,`created_at`)
                VALUES (%d, %d, %s, %s, %s, %s, %d, %d, %s)
            ";
            $prepared = $wpdb->prepare($sql,
                $ownerId, $etuId, $type, $sujet, $msg, $pPath, $pId, $anon, $created
            );
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

    /**
     * Ajout / mise à jour de la réponse à une réclamation
     * (remplit: statut_reponse, message_reponse, reponse_user_id, reponse_date)
     */
    public static function add_response(int $id, string $statut, string $message) {
        global $wpdb;

        $table = self::table();
        $row   = $wpdb->get_row($wpdb->prepare("SELECT owner_user_id FROM {$table} WHERE id=%d", $id), ARRAY_A);
        if (!$row) return new WP_Error('not_found', 'Réclamation introuvable', ['status'=>404]);

        $current = (int) get_current_user_id();
        if (!$current) return new WP_Error('auth', 'Utilisateur non connecté');

        // Si tu veux empêcher l’auteur de se répondre lui-même, décommente :
        // if ((int)$row['owner_user_id'] === $current) {
        //     return new WP_Error('forbidden','Vous êtes l’auteur de cette réclamation',['status'=>403]);
        // }

        $allowed = ['En attente','Accepté','Refusé'];
        if (!in_array($statut, $allowed, true)) {
            return new WP_Error('bad_request','Statut invalide');
        }

        $ok = $wpdb->update($table, [
                'statut_reponse'  => $statut,
                'message_reponse' => wp_kses_post($message),
                'reponse_user_id' => $current,
                'reponse_date'    => current_time('mysql'),
            ],
            ['id'=>$id],
            ['%s','%s','%d','%s'],
            ['%d']
        );
        if ($ok === false) {
            return new WP_Error('db_update_error', 'Mise à jour échouée: ' . $wpdb->last_error);
        }

        return (array) $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id=%d", $id), ARRAY_A);
    }
}
