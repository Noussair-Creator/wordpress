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

    public static function update(int $id, array $payload) {
  global $wpdb; $t = self::t_publications(); $uid = get_current_user_id();
  if (!$uid) return new WP_Error('forbidden','Non connecté', ['status'=>401]);

  $cur = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
  if (!$cur) return new WP_Error('not_found','Introuvable', ['status'=>404]);

  // Permissions :
  // - Service UTM : peut tout modifier
  // - Directeur du labo de la publication : peut modifier
  // - Auteur (created_by) : peut modifier si NON Validée
  $can = false;
  if (self::is_service_utm()) { $can = true; }
  else {
    $is_dir_for_lab = (bool)$wpdb->get_var(
      $wpdb->prepare("SELECT 1 FROM ".self::t_labs()." WHERE id=%d AND directeur_user_id=%d",
        (int)$cur['laboratoire_id'], $uid)
    );
    if ($is_dir_for_lab) $can = true;
    if ((int)$cur['created_by'] === $uid && strtolower($cur['statut']) !== 'validée') $can = true;
  }
  if (!$can) return new WP_Error('forbidden','Modification non autorisée', ['status'=>403]);

  // Champs modifiables
  $data = [];
  if (isset($payload['type']))             $data['type'] = sanitize_text_field($payload['type']);
  if (isset($payload['date_publication'])) $data['date_publication'] = sanitize_text_field($payload['date_publication']);
  if (isset($payload['titre']))            $data['titre'] = sanitize_text_field($payload['titre']);
  if (isset($payload['resume']))           $data['resume'] = sanitize_textarea_field($payload['resume']);
  if (isset($payload['commentaire']))      $data['commentaire'] = sanitize_textarea_field($payload['commentaire']);
  if (isset($payload['fichier_url']))      $data['fichier_url'] = esc_url_raw($payload['fichier_url']);

  if (!$data) return self::get($id);

  $data['updated_by'] = $uid;
  $data['updated_at'] = current_time('mysql');

  $ok = $wpdb->update($t, $data, ['id'=>$id], null, ['%d']);
  if ($ok === false) return new WP_Error('db_error','Update failed: '.$wpdb->last_error, ['status'=>500]);

  return self::get($id);
}

}


