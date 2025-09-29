<?php
/**
 * Service Publications
 * - CRUD + statuts + partage d'articles (chercheurs/directeurs de mes labos)
 */
if (!defined('ABSPATH')) exit;

class PubService {

  /* ======================== Tables ======================== */
  public static function t_publications()   { global $wpdb; return $wpdb->prefix . 'recherche_publication'; }
  public static function t_membres()        { global $wpdb; return $wpdb->prefix . 'recherche_membre'; }
  public static function t_labs()           { global $wpdb; return $wpdb->prefix . 'recherche_laboratoire'; }

  public static function t_pub_shares()     { global $wpdb; return $wpdb->prefix.'recherche_publication_share'; }
  public static function t_pub_files()      { global $wpdb; return $wpdb->prefix.'recherche_fichier_publication'; }
  public static function t_pub_keywords()   { global $wpdb; return $wpdb->prefix.'recherche_publication_keyword'; }

  /* ======================== Rôles ======================== */
  public static $ROLE_DIR        = ['um_directeur_laboratoire','directeur_laboratoire','directeur-laboratoire'];
  public static $ROLE_UTM        = ['um_service-utm','service_utm','service-utm'];
  public static $ROLE_ETAB       = ['um_service-etablissement','service_etablissement','service-etablissement'];
  public static $ROLE_CHERCHEUR  = ['um_chercheur','chercheur'];

  public static function user_has_any_role(array $choices): bool {
    $u = wp_get_current_user(); if (!$u || empty($u->roles)) return false;
    $roles = array_map('strtolower', (array)$u->roles);
    foreach ($choices as $r) if (in_array(strtolower($r), $roles, true)) return true;
    return false;
  }
  public static function is_directeur()    { return self::user_has_any_role(self::$ROLE_DIR); }
  public static function is_service_utm()  { return self::user_has_any_role(self::$ROLE_UTM); }
  public static function is_service_etab() { return self::user_has_any_role(self::$ROLE_ETAB); }

  /* ======================== Contexte utilisateur ======================== */
  /** Labos dont je suis membre OU directeur (mix) */
  public static function my_lab_ids(): array {
    global $wpdb;
    $uid = get_current_user_id(); if (!$uid) return [];
    $mT = self::t_membres(); $lT = self::t_labs();
    $ids = [];
    $rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$mT} WHERE user_id=%d", $uid)) ?: [];
    $ids = array_merge($ids, array_map('intval',$rows));
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lT} WHERE directeur_user_id=%d", $uid)) ?: [];
    $ids = array_merge($ids, array_map('intval',$rows));
    return array_values(array_unique(array_filter($ids)));
  }

  /** Labos que JE dirige (uniquement) */
  public static function labs_directed_by(int $user_id = 0): array {
    global $wpdb;
    $uid = $user_id ?: get_current_user_id(); if (!$uid) return [];
    $lT = self::t_labs();
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$lT} WHERE directeur_user_id=%d", $uid)) ?: [];
    return array_values(array_unique(array_map('intval', $rows)));
  }

  public static function user_etab_id(int $user_id): int {
    return (int) get_user_meta($user_id, 'etablissement_id', true) ?: 0;
  }

  /* ======================== Partage (helpers) ======================== */

  /** Liste des utilisateurs éligibles au partage (chercheurs + directeurs). Retour: [{id,label}] */
  public static function eligible_share_users(string $search = ''): array {
    $uid = get_current_user_id();
    if (!$uid) return [];

    $args = [
      'role__in'        => array_merge(self::$ROLE_CHERCHEUR, self::$ROLE_DIR),
      'orderby'         => 'display_name',
      'order'           => 'ASC',
      'fields'          => ['ID','display_name','user_email'],
      'number'          => 100,
      'exclude'         => [$uid],
    ];
    if ($search !== '') {
      $args['search'] = '*' . $search . '*';
      $args['search_columns'] = ['display_name','user_email'];
    }

    $users = get_users($args);
    return array_map(function($u){
      return [
        'id'    => (int) $u->ID,
        'label' => sprintf('%s <%s>', $u->display_name, $u->user_email),
      ];
    }, $users);
  }

  public static function lab_user_ids(array $labIds): array {
    global $wpdb;
    $labIds = array_values(array_unique(array_map('intval', $labIds)));
    if (empty($labIds)) return [];
    $mT = self::t_membres();
    $lT = self::t_labs();

    $u1 = $wpdb->get_col("SELECT DISTINCT user_id FROM {$mT} WHERE laboratoire_id IN (".implode(',', $labIds).")") ?: [];
    $u2 = $wpdb->get_col("SELECT DISTINCT directeur_user_id FROM {$lT} WHERE id IN (".implode(',', $labIds).") AND directeur_user_id IS NOT NULL") ?: [];

    $ids = array_values(array_unique(array_map('intval', array_merge($u1, $u2))));
    return array_filter($ids, fn($id)=> $id > 0);
  }

  public static function my_lab_user_ids(): array {
    global $wpdb;
    $uid  = get_current_user_id();
    if (!$uid) return [];

    $labs = self::my_lab_ids();
    if (empty($labs)) return [];

    $mT = self::t_membres();
    $lT = self::t_labs();

    $members = $wpdb->get_col("SELECT DISTINCT user_id FROM {$mT} WHERE laboratoire_id IN (".implode(',', array_map('intval',$labs)).")") ?: [];
    $dirs    = $wpdb->get_col("SELECT DISTINCT directeur_user_id FROM {$lT} WHERE id IN (".implode(',', array_map('intval',$labs)).") AND directeur_user_id IS NOT NULL") ?: [];

    $ids = array_map('intval', array_unique(array_merge($members, $dirs)));
    return array_values(array_filter($ids));
  }

  /** Remplace toutes les lignes de partage d'une publication par une nouvelle liste d'IDs (utilisé en création) */
  public static function replace_shares(int $pub_id, array $user_ids, int $added_by): void {
    global $wpdb; $sT = self::t_pub_shares();
    $user_ids = array_values(array_unique(array_map('intval', array_filter($user_ids))));
    $wpdb->query('START TRANSACTION');
    try{
      $wpdb->delete($sT, ['publication_id'=>$pub_id], ['%d']);
      foreach ($user_ids as $uid) {
        if ($uid <= 0) continue;
        $wpdb->insert($sT, [
          'publication_id' => $pub_id,
          'user_id'        => $uid,
          'added_by'       => $added_by,
          'created_at'     => current_time('mysql'),
        ], ['%d','%d','%d','%s']);
      }
      $wpdb->query('COMMIT');
    } catch (\Throwable $e) {
      $wpdb->query('ROLLBACK');
      throw $e;
    }
  }

  /** Synchronise les partages (update fin) : ajoute les nouveaux, supprime seulement ceux retirés. */
  public static function sync_shares(int $pub_id, array $user_ids, int $actor_id): array {
    global $wpdb;
    $sT = self::t_pub_shares();

    $desired = array_values(array_unique(array_map('intval', array_filter($user_ids))));
    $current = self::list_share_user_ids($pub_id);

    $to_add    = array_values(array_diff($desired, $current));
    $to_remove = array_values(array_diff($current, $desired));
    $kept      = array_values(array_intersect($current, $desired));

    if (empty($to_add) && empty($to_remove)) return ['added'=>[], 'removed'=>[], 'kept'=>$kept];

    $wpdb->query('START TRANSACTION');
    try {
      // Supprimer les parts enlevées (et leur méta)
      if (!empty($to_remove)) {
        $in = implode(',', array_fill(0, count($to_remove), '%d'));
        // share_id à supprimer
        $rows = $wpdb->get_col($wpdb->prepare(
          "SELECT id FROM {$sT} WHERE publication_id=%d AND user_id IN ($in)", $pub_id, ...$to_remove
        )) ?: [];
        if ($rows) {
          $kT = self::t_pub_keywords();
          $fT = self::t_pub_files();
          $idIn = implode(',', array_fill(0, count($rows), '%d'));
          $wpdb->query($wpdb->prepare("DELETE FROM {$kT} WHERE publication_share_id IN ($idIn)", ...$rows));
          $wpdb->query($wpdb->prepare("DELETE FROM {$fT} WHERE publication_share_id IN ($idIn)", ...$rows));
          $wpdb->query($wpdb->prepare("DELETE FROM {$sT} WHERE id IN ($idIn)", ...$rows));
        }
      }

      // Ajouter les nouvelles parts (sans toucher aux autres)
      foreach ($to_add as $uid) {
        $wpdb->insert($sT, [
          'publication_id' => $pub_id,
          'user_id'        => $uid,
          'added_by'       => $actor_id,
          'created_at'     => current_time('mysql'),
        ], ['%d','%d','%d','%s']);
      }

      $wpdb->query('COMMIT');
    } catch (\Throwable $e) {
      $wpdb->query('ROLLBACK');
      throw $e;
    }

    return ['added'=>$to_add, 'removed'=>$to_remove, 'kept'=>$kept];
  }

  /** Supprime précisément des fichiers (par IDs) rattachés à une publication */
  private static function delete_share_files_by_ids(int $pub_id, array $file_ids): void {
    global $wpdb;
    $fT = self::t_pub_files();
    $ids = array_values(array_unique(array_map('intval', array_filter($file_ids))));
    if (!$ids) return;
    $in = implode(',', array_fill(0, count($ids), '%d'));
    $wpdb->query($wpdb->prepare("DELETE FROM {$fT} WHERE publication_id=%d AND id IN ($in)", $pub_id, ...$ids));
  }

  /** Seed des mots-clés & fichiers pour chaque part fournie (remplace keywords si fournis, ajoute fichiers) */
  private static function seed_share_extras(int $pub_id, array $user_ids, array $keywords = [], array $files = [], int $added_by = 0): void {
    global $wpdb;
    $user_ids = array_values(array_unique(array_map('intval', array_filter($user_ids))));
    if (empty($user_ids)) return;

    $sT = self::t_pub_shares();
    $kT = self::t_pub_keywords();
    $fT = self::t_pub_files();

    $idsList = implode(',', $user_ids);
    $rows = $wpdb->get_results($wpdb->prepare(
      "SELECT id, user_id FROM {$sT} WHERE publication_id=%d AND user_id IN ({$idsList})", $pub_id
    ), ARRAY_A) ?: [];
    if (empty($rows)) return;

    $now = current_time('mysql');
    $creator = $added_by ?: get_current_user_id();

    $wpdb->query('START TRANSACTION');
    try {
      foreach ($rows as $r) {
        $share_id = (int)$r['id'];

        // Keywords (remplacement si fournis)
        if (!empty($keywords)) {
          $wpdb->delete($kT, ['publication_share_id'=>$share_id], ['%d']);
          foreach ($keywords as $kw) {
            $kw = trim((string)$kw); if ($kw==='') continue;
            $wpdb->insert($kT, [
              'contenu'              => mb_substr($kw,0,255),
              'publication_id'       => $pub_id,
              'publication_share_id' => $share_id,
              'created_by'           => $creator,
              'created_at'           => $now,
            ], ['%s','%d','%d','%d','%s']);
          }
        }

        // Fichiers (ajout si fournis)
        if (!empty($files) && is_array($files)) {
          foreach ($files as $f) {
            $name = trim((string)($f['original_name'] ?? ''));
            $path = trim((string)($f['storage_path'] ?? ''));
            if ($name==='' || $path==='') continue;
            $wpdb->insert($fT, [
              'publication_id'       => $pub_id,
              'publication_share_id' => $share_id,
              'original_name'        => mb_substr($name,0,255),
              'storage_path'         => mb_substr($path,0,255),
              'created_by'           => $creator,
              'created_at'           => $now,
              'updated_at'           => $now,
            ], ['%d','%d','%s','%s','%d','%s','%s']);
          }
        }
      }
      $wpdb->query('COMMIT');
    } catch (\Throwable $e) {
      $wpdb->query('ROLLBACK');
      error_log('[PubService] seed_share_extras failed: '.$e->getMessage());
    }
  }

  /* ======================== Droits édition ======================== */
  public static function can_edit_row(array $row, int $uid): bool {
    if (self::is_service_utm()) return true;

    // Directeur du labo de cette publication
    global $wpdb;
    $is_dir_for_lab = (bool)$wpdb->get_var(
      $wpdb->prepare("SELECT 1 FROM ".self::t_labs()." WHERE id=%d AND directeur_user_id=%d", (int)$row['laboratoire_id'], $uid)
    );
    if ($is_dir_for_lab) return true;

    // Auteur : peut modifier tant que non "Validée"
    if ((int)$row['created_by'] === $uid && strtolower(trim((string)$row['statut'])) !== 'validée') {
      return true;
    }
    return false;
  }

  /* ======================== CRUD ======================== */

  public static function create(array $payload) {
    global $wpdb; $t = self::t_publications();
    $uid = get_current_user_id(); if (!$uid) return new WP_Error('forbidden','Non connecté', ['status'=>401]);

    $labs = self::my_lab_ids(); if (empty($labs))
      return new WP_Error('forbidden','Aucun laboratoire rattaché', ['status'=>403]);

    $lab_id = (int)($payload['laboratoire_id'] ?? 0);
    if ($lab_id && !in_array($lab_id, $labs, true))
      return new WP_Error('forbidden','Labo invalide pour cet utilisateur', ['status'=>403]);
    if (!$lab_id) $lab_id = (int)$labs[0];

    // statut selon rôle directeur de ce labo
    $is_dir_for_lab = false;
    if (self::is_directeur()) {
      $is_dir_for_lab = (bool)$wpdb->get_var(
        $wpdb->prepare("SELECT 1 FROM ".self::t_labs()." WHERE id=%d AND directeur_user_id=%d", $lab_id, $uid)
      );
    }
    $statut = $is_dir_for_lab ? 'Validée' : 'En attente';

    $data = [
      'date_publication' => sanitize_text_field($payload['date_publication'] ?? ''),
      'type'             => sanitize_text_field($payload['type'] ?? ''),
      'titre'            => sanitize_text_field($payload['titre'] ?? ''),
      'resume'           => sanitize_textarea_field($payload['resume'] ?? ''),
      'commentaire'      => sanitize_textarea_field($payload['commentaire'] ?? ''),
      'laboratoire_id'   => $lab_id,
      'chercheur_id'     => $uid,
      'created_by'       => $uid,
      'updated_by'       => $uid,
      'created_at'       => current_time('mysql'),
      'updated_at'       => current_time('mysql'),
      'statut'           => $statut,
      'doi'              => sanitize_text_field($payload['doi'] ?? ''),
      'nb_pages'         => isset($payload['nb_pages']) ? (int)$payload['nb_pages'] : null,
      'maison_edition_scientifique' => sanitize_text_field($payload['maison_edition_scientifique'] ?? ''),
    ];
    if ($is_dir_for_lab) {
      $data['validated_by'] = $uid;
      $data['validated_at'] = current_time('mysql');
    }
if (!empty($payload['doi'])) {
  $doi = trim((string)$payload['doi']);
  if (!preg_match('/^10\.\d{4,9}\/[-._;()\/:A-Z0-9]+$/i', $doi)) {
    return new WP_Error('invalid_doi', 'DOI invalide', ['status'=>400]);
  }
  $data['doi'] = $doi;
}

    $ok = $wpdb->insert($t, $data);
    if (!$ok) return new WP_Error('db_error','Insert failed: '.$wpdb->last_error, ['status'=>500]);

    $pub_id = (int)$wpdb->insert_id;

    // Partage si type Article
    $isArticle = preg_match('/^\s*article\b/i', (string)$data['type']) === 1;
    if ($isArticle) {
      try {
        $share_ids = [];
        if (!empty($payload['share_with_user_ids']) && is_array($payload['share_with_user_ids'])) {
          $share_ids = array_map('intval', $payload['share_with_user_ids']);
        }
        if (!empty($share_ids)) {
          self::replace_shares($pub_id, $share_ids, $uid);

          // pré-remplissage optionnel (ici on ne préremplit rien de spécifique)
          self::prefill_share_meta($pub_id, $share_ids, null, null);

          // seed mots-clés / fichiers si fournis
          $share_keywords = !empty($payload['share_keywords'])
            ? array_values(array_filter(array_map('strval',$payload['share_keywords'])))
            : [];
          $share_files = (!empty($payload['share_files']) && is_array($payload['share_files']))
            ? $payload['share_files']
            : [];
          if ($share_keywords || $share_files) {
            self::seed_share_extras($pub_id, $share_ids, $share_keywords, $share_files, $uid);
          }
        }
      } catch (\Throwable $e) {
        error_log('[PubService] share insert failed: '.$e->getMessage());
      }
    }

    return self::get($pub_id);
  }

  public static function get(int $id) {
    global $wpdb; $t = self::t_publications();
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$row) return null;
    $row['auteur_display_name'] = get_the_author_meta('display_name', (int)$row['chercheur_id']) ?: '';
    return $row;
  }

  public static function update(int $id, array $payload) {
    global $wpdb; $t = self::t_publications();
    $uid = get_current_user_id(); if (!$uid) return new WP_Error('forbidden','Non connecté', ['status'=>401]);

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$row) return new WP_Error('not_found','Publication introuvable', ['status'=>404]);

    if (!self::can_edit_row($row, $uid)) {
      return new WP_Error('forbidden','Modification non autorisée', ['status'=>403]);
    }

    // --- publication
    $data = [];
    if (array_key_exists('type', $payload))             $data['type']             = sanitize_text_field($payload['type']);
    if (array_key_exists('date_publication',$payload))  $data['date_publication'] = sanitize_text_field($payload['date_publication']);
    if (array_key_exists('titre', $payload))            $data['titre']            = sanitize_text_field($payload['titre']);
    if (array_key_exists('resume', $payload))           $data['resume']           = sanitize_textarea_field($payload['resume']);
    if (array_key_exists('commentaire', $payload))      $data['commentaire']      = sanitize_textarea_field($payload['commentaire']);
    if (array_key_exists('fichier_url', $payload))      $data['fichier_url']      = esc_url_raw($payload['fichier_url']);
    if (array_key_exists('doi', $payload))              $data['doi']              = sanitize_text_field($payload['doi']);
    if (array_key_exists('nb_pages', $payload))         $data['nb_pages']         = (int)$payload['nb_pages'] ?: null;
    if (array_key_exists('maison_edition_scientifique', $payload))
      $data['maison_edition_scientifique'] = sanitize_text_field($payload['maison_edition_scientifique']);

    if (!empty($data)) {
      $data['updated_by'] = $uid;
      $data['updated_at'] = current_time('mysql');
      $ok = $wpdb->update($t, $data, ['id'=>$id], null, ['%d']);
      if ($ok === false) return new WP_Error('db_error','Update failed: '.$wpdb->last_error, ['status'=>500]);
    }

    // --- partages / keywords / fichiers si Article
    $curType  = $data['type'] ?? $row['type'];
    $isArticle = preg_match('/^\s*article\b/i', (string)$curType) === 1;

    if ($isArticle) {
      try {
        // 1) suppression ciblée de fichiers existants (si demandé)
        if (!empty($payload['share_file_ids_delete']) && is_array($payload['share_file_ids_delete'])) {
          self::delete_share_files_by_ids($id, $payload['share_file_ids_delete']);
        }

        // 2) synchronisation des destinataires si la liste est fournie
        $share_users_changed = false;
        if (array_key_exists('share_with_user_ids', $payload) && is_array($payload['share_with_user_ids'])) {
          self::sync_shares($id, $payload['share_with_user_ids'], $uid);
          $share_users_changed = true;
        }

        // 3) appliquer keywords/fichiers
        $target_user_ids = $share_users_changed
          ? array_map('intval', (array)$payload['share_with_user_ids'])
          : self::list_share_user_ids($id);

        $share_keywords = [];
        $share_files    = [];
        if (!empty($payload['share_keywords']) && is_array($payload['share_keywords'])) {
          $share_keywords = array_values(array_filter(array_map('strval', $payload['share_keywords'])));
        }
        if (!empty($payload['share_files']) && is_array($payload['share_files'])) {
          $share_files = $payload['share_files']; // [{original_name, storage_path}]
        }

        if (!empty($share_keywords) || !empty($share_files)) {
          self::seed_share_extras($id, $target_user_ids, $share_keywords, $share_files, $uid);
        }
      } catch (\Throwable $e) {
        error_log('[PubService] share update failed: '.$e->getMessage());
      }
    }

    return self::get($id);
  }

  public static function delete(int $id) {
    global $wpdb; $t = self::t_publications(); $uid = get_current_user_id();
    $cur = $wpdb->get_row($wpdb->prepare("SELECT created_by, statut FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Introuvable', ['status'=>404]);

    $can = false;
    if (self::is_service_utm()) $can = true;
    else if ((int)$cur['created_by'] === $uid && strtolower($cur['statut']) !== 'validée') $can = true;

    if (!$can) return new WP_Error('forbidden','Suppression non autorisée', ['status'=>403]);

    $ok = $wpdb->delete($t, ['id'=>$id], ['%d']);
    if (!$ok) return new WP_Error('db_error','Delete failed', ['status'=>500]);
    return true;
  }

  public static function set_status(int $id, string $status) {
    global $wpdb; $t = self::t_publications(); $uid = get_current_user_id();

    $cur = $wpdb->get_row($wpdb->prepare("SELECT laboratoire_id FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$cur) return new WP_Error('not_found','Introuvable', ['status'=>404]);

    $lab_id = (int)$cur['laboratoire_id'];
    $is_dir_for_lab = (bool)$wpdb->get_var(
      $wpdb->prepare("SELECT 1 FROM ".self::t_labs()." WHERE id=%d AND directeur_user_id=%d", $lab_id, $uid)
    );

    if (!self::is_service_utm() && !$is_dir_for_lab) {
      return new WP_Error('forbidden','Action réservée au directeur du labo', ['status'=>403]);
    }

    $status = in_array($status, ['Validée','Rejetée','En attente'], true) ? $status : 'En attente';

    $upd = [
      'statut'     => $status,
      'updated_by' => $uid,
      'updated_at' => current_time('mysql'),
    ];
    if ($status === 'Validée') {
      $upd['validated_by'] = $uid;
      $upd['validated_at'] = current_time('mysql');
    }

    $ok = $wpdb->update($t, $upd, ['id'=>$id], null, ['%d']);
    if ($ok === false) return new WP_Error('db_error','Update failed: '.$wpdb->last_error, ['status'=>500]);

    return self::get($id);
  }

  /* ======================== LIST ======================== */
  /**
   * Liste des publications
   * $opts:
   *  - with_auteur (liste "suivi")
   *  - me (mes publications)
   *  - include_shared (si me=1, inclure celles partagées avec moi => shared_for_me)
   *  - shared_scope ('lab' pour flag shared_for_lab)
   *  - scope ('director_labs' pour restreindre strictement aux labos que je dirige)
   *  - search
   */
  public static function list(array $opts = []) {
    global $wpdb;
    $t   = self::t_publications();
    $sT  = self::t_pub_shares();
    $uid = get_current_user_id();
    if (!$uid) return [];

    $with_auteur    = !empty($opts['with_auteur']);
    $me             = !empty($opts['me']);
    $include_shared = !empty($opts['include_shared']);
    $shared_scope   = strtolower(trim((string)($opts['shared_scope'] ?? ''))); // '' | 'lab'
    $scope          = strtolower(trim((string)($opts['scope'] ?? '')));        // '' | 'director_labs'
    $search         = trim((string)($opts['search'] ?? ''));

    $where   = [];
    $params  = [];
    $joins   = '';
    $selectX = '';

    // Recherche texte
    if ($search !== '') {
      $like = '%'.$wpdb->esc_like($search).'%';
      $where[] = "(p.titre LIKE %s OR p.type LIKE %s OR p.resume LIKE %s)";
      array_push($params, $like, $like, $like);
    }

    // Flag partagé pour moi
    if ($me && $include_shared) {
      $joins   .= " LEFT JOIN {$sT} s_me ON (s_me.publication_id=p.id AND s_me.user_id=%d) ";
      $params[] = $uid;
      $selectX .= " , CASE WHEN s_me.user_id IS NULL THEN 0 ELSE 1 END AS shared_for_me ";
    } else {
      $selectX .= " , 0 AS shared_for_me ";
    }

    /* ====== Scénario A : /publication?me=1... ====== */
    if ($me) {
      $cond_me  = "(p.created_by=%d";
      $params[] = $uid;
      if ($include_shared) {
        $cond_me .= " OR EXISTS(SELECT 1 FROM {$sT} s WHERE s.publication_id=p.id AND s.user_id=%d)";
        $params[] = $uid;
      }
      $cond_me .= ")";

      $cond_lab = '';
      if ($shared_scope === 'lab' && self::is_directeur()) {
        $myLabIds = self::my_lab_ids();
        if (!empty($myLabIds)) {
          $mT = self::t_membres();
          $lT = self::t_labs();

          $memberIds = $wpdb->get_col("SELECT DISTINCT user_id FROM {$mT} WHERE laboratoire_id IN (".implode(',', array_map('intval',$myLabIds)).")") ?: [];
          $dirIds    = $wpdb->get_col("SELECT DISTINCT directeur_user_id FROM {$lT} WHERE id IN (".implode(',', array_map('intval',$myLabIds)).") AND directeur_user_id IS NOT NULL") ?: [];
          $labUserIds = array_values(array_unique(array_map('intval', array_merge($memberIds, $dirIds))));

          if (!empty($labUserIds)) {
            $cond_a = "EXISTS(SELECT 1 FROM {$sT} s2 WHERE s2.publication_id=p.id AND s2.user_id IN (".implode(',', $labUserIds)."))";
            $cond_b = "(p.created_by IN (".implode(',', $labUserIds).") AND EXISTS(SELECT 1 FROM {$sT} s_any WHERE s_any.publication_id=p.id))";
            $cond_lab = "({$cond_a} OR {$cond_b})";

            $joins   .= " LEFT JOIN {$sT} s_lab ON (s_lab.publication_id=p.id AND s_lab.user_id IN (".implode(',', $labUserIds).")) ";
            $joins   .= " LEFT JOIN {$sT} s_any ON (s_any.publication_id=p.id) ";

            $selectX .= " , CASE WHEN (s_lab.user_id IS NOT NULL OR (s_any.publication_id IS NOT NULL AND p.created_by IN (".implode(',', $labUserIds).")))
                                  THEN 1 ELSE 0 END AS shared_for_lab ";
          } else {
            $selectX .= " , 0 AS shared_for_lab ";
          }
        } else {
          $selectX .= " , 0 AS shared_for_lab ";
        }
      } else {
        $selectX .= " , 0 AS shared_for_lab ";
      }

      if ($cond_lab !== '') {
        $where[] = "({$cond_me} OR {$cond_lab})";
      } else {
        $where[] = $cond_me;
      }

    /* ====== Scénario B : /publication?with_auteur=1 ... (Suivi) ====== */
    } else if ($with_auteur) {

      // Priorité au scope explicite "director_labs"
      if ($scope === 'director_labs' && self::is_directeur()) {
        $labIds = self::labs_directed_by(); // UNIQUEMENT les labos que je dirige
        if (empty($labIds)) $where[] = '1=0';
        else $where[] = "p.laboratoire_id IN (".implode(',', array_map('intval',$labIds)).")";

      } else if (self::is_service_utm()) {
        // tout voir

      } else if (self::is_service_etab()) {
        $my_etab = self::user_etab_id($uid);
        if (!$my_etab) $where[]='1=0';
        else {
          $um = $wpdb->usermeta;
          $where[] = "p.created_by IN (SELECT user_id FROM {$um} WHERE meta_key='etablissement_id' AND CAST(meta_value AS UNSIGNED)=%d)";
          $params[] = $my_etab;
        }

      } else if (self::is_directeur()) {
        // Directeur sans scope explicite : suivre UNIQUEMENT ses labos dirigés (pas les labos où il est simple membre)
        $labIds = self::labs_directed_by();
        if (empty($labIds)) $where[]='1=0';
        else $where[] = "p.laboratoire_id IN (".implode(',', array_map('intval',$labIds)).")";

      } else {
        // Chercheur : publications validées des labos auxquels il appartient (membre ou dirigés par lui)
        $labs = self::my_lab_ids();
        if (empty($labs)) $where[]='1=0';
        else {
          $where[] = "p.laboratoire_id IN (".implode(',', array_map('intval',$labs)).")";
          $where[] = "p.statut = 'Validée'";
        }
      }

      $selectX .= " , 0 AS shared_for_lab ";

    } else {
      // pas d'accès
      $where[] = '1=0';
      $selectX .= " , 0 AS shared_for_lab ";
    }

    $where_sql = empty($where) ? '' : 'WHERE '.implode(' AND ', $where);
    $sql = "SELECT p.* {$selectX} FROM {$t} p {$joins} {$where_sql} ORDER BY p.created_at DESC";
    $rows = $wpdb->get_results($wpdb->prepare($sql, ...$params), ARRAY_A) ?: [];

    foreach ($rows as &$r) {
      $r['auteur_display_name'] = get_the_author_meta('display_name', (int)$r['chercheur_id']) ?: '';
      $r['can_moderate'] = (self::is_service_utm() ? 1 : 0);
      if (!$r['can_moderate'] && self::is_directeur()) {
        $r['can_moderate'] = (int)$wpdb->get_var(
          $wpdb->prepare("SELECT 1 FROM ".self::t_labs()." WHERE id=%d AND directeur_user_id=%d", (int)$r['laboratoire_id'], $uid)
        );
      }
    }
    return $rows;
  }

  public static function eligible_share_users_all(string $search = ''): array {
    $roles = array_merge(self::$ROLE_CHERCHEUR, self::$ROLE_DIR);
    $args = [
      'role__in'        => $roles,
      'orderby'         => 'display_name',
      'order'           => 'ASC',
      'number'          => 50,
      'fields'          => ['ID','display_name','user_email'],
    ];
    if ($search !== '') {
      $args['search'] = '*' . $search . '*';
      $args['search_columns'] = ['display_name', 'user_email'];
    }
    $users = get_users($args);
    return array_map(function($u){
      return [
        'id'    => (int) $u->ID,
        'label' => sprintf('%s <%s>', $u->display_name, $u->user_email),
      ];
    }, $users);
  }

  /* ========= PARTAGE : lecture/édition par le destinataire ========= */

  /** Récupère la ligne de partage pour LA publication $pub_id destinée à l’utilisateur courant */
  public static function get_my_share_row(int $pub_id) : ?array {
    global $wpdb; $uid = get_current_user_id(); if(!$uid) return null;
    $sT = self::t_pub_shares();
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$sT} WHERE publication_id=%d AND user_id=%d", $pub_id, $uid), ARRAY_A);
    return $row ?: null;
  }

  /** Droits : le user peut-il modifier la “part” partagée ? */
  public static function can_edit_share(int $pub_id, int $uid): bool {
    global $wpdb;
    $sT = self::t_pub_shares();
    $ok = (bool) $wpdb->get_var($wpdb->prepare("SELECT 1 FROM {$sT} WHERE publication_id=%d AND user_id=%d", $pub_id, $uid));
    return $ok;
  }

  /** Retourne le détail “publication + ma part” (fichiers/keywords liés au partage) */
  public static function get_with_my_share(int $pub_id): ?array {
    $p = self::get($pub_id); if(!$p) return null;
    $share = self::get_my_share_row($pub_id);
    if($share){
      $share['files'] = self::list_share_files((int)$share['id']);
      $share['keywords'] = self::list_share_keywords((int)$share['id']);
    }
    return ['publication'=>$p, 'my_share'=>$share];
  }

  public static function list_share_files(int $share_id): array {
    global $wpdb; $t = self::t_pub_files();
    return $wpdb->get_results($wpdb->prepare("SELECT id, original_name, storage_path, created_at FROM {$t} WHERE publication_share_id=%d ORDER BY id ASC", $share_id), ARRAY_A) ?: [];
  }

  public static function list_share_keywords(int $share_id): array {
    global $wpdb; $t = self::t_pub_keywords();
    $rows = $wpdb->get_col($wpdb->prepare("SELECT contenu FROM {$t} WHERE publication_share_id=%d ORDER BY id ASC", $share_id)) ?: [];
    return array_values(array_filter(array_map('strval',$rows)));
  }

  /**
   * Upsert de MA part pour la publication (le destinataire renseigne ses infos)
   * Payload attendu (tous optionnels) :
   *  - resume (string)
   *  - nb_pages (int)
   *  - date_publication (Y-m-d)
   *  - fichier_url (string)
   *  - keywords (array<string>)
   *  - files (array<{original_name, storage_path}>)
   */
  public static function upsert_my_share(int $pub_id, array $payload){
    global $wpdb;
    $uid = get_current_user_id(); if(!$uid) return new WP_Error('forbidden','Non connecté',['status'=>401]);

    $sT = self::t_pub_shares();
    $row = self::get_my_share_row($pub_id); // peut être null

    $data = [];
    if(array_key_exists('resume',$payload))           $data['resume']           = sanitize_textarea_field($payload['resume']);
    if(array_key_exists('nb_pages',$payload))         $data['nb_pages']         = (int)$payload['nb_pages'] ?: null;
    if(array_key_exists('date_publication',$payload)) $data['date_publication'] = sanitize_text_field($payload['date_publication']);
    if(array_key_exists('fichier_url',$payload))      $data['fichier_url']      = esc_url_raw($payload['fichier_url']);

    $wpdb->query('START TRANSACTION');
    try{
      if($row){ // update
        if(!empty($data)){
          $wpdb->update($sT, $data, ['id'=>(int)$row['id']], null, ['%d']);
        }
        $share_id = (int)$row['id'];
      } else {  // insert automatique
        $wpdb->insert($sT, array_merge([
          'publication_id' => $pub_id,
          'user_id'        => $uid,
          'added_by'       => $uid,
          'created_at'     => current_time('mysql'),
        ], $data), ['%d','%d','%d','%s']);
        $share_id = (int)$wpdb->insert_id;
      }

      // (keywords & files du destinataire gérés ailleurs si besoin)
      $wpdb->query('COMMIT');
      return self::get_with_my_share($pub_id);
    } catch (\Throwable $e) {
      $wpdb->query('ROLLBACK');
      return new WP_Error('db_error', 'Share upsert failed: '.$e->getMessage(), ['status'=>500]);
    }
  }

  public static function list_shares(int $pub_id): array {
    global $wpdb;
    $sT = self::t_pub_shares();
    $wp_users = $wpdb->users;

    $rows = $wpdb->get_results(
      $wpdb->prepare("SELECT s.id AS share_id, s.user_id, s.created_at, u.display_name, u.user_email
                      FROM {$sT} s
                      JOIN {$wp_users} u ON u.ID = s.user_id
                      WHERE s.publication_id=%d
                      ORDER BY s.id ASC", $pub_id),
      ARRAY_A
    ) ?: [];

    foreach ($rows as &$r) {
      $sid = (int)$r['share_id'];
      $r['label']    = sprintf('%s <%s>', $r['display_name'] ?: ('User #'.$r['user_id']), $r['user_email'] ?: '');
      $r['keywords'] = self::list_share_keywords($sid);
      $r['files']    = self::list_share_files($sid);
    }
    return $rows;
  }

  /** IDs simples des utilisateurs avec qui c’est partagé */
  public static function list_share_user_ids(int $pub_id): array {
    global $wpdb; $sT = self::t_pub_shares();
    $ids = $wpdb->get_col($wpdb->prepare("SELECT user_id FROM {$sT} WHERE publication_id=%d", $pub_id)) ?: [];
    return array_values(array_unique(array_map('intval',$ids)));
  }

  private static function prefill_share_meta(int $pub_id, array $user_ids, ?string $resume, ?int $nb_pages) : void {
    if (empty($user_ids)) return;
    global $wpdb;
    $sT = self::t_pub_shares();
    $ids = implode(',', array_map('intval', $user_ids));

    $data = [];
    $fmt  = [];
    if ($resume !== null)   { $data['resume']   = sanitize_textarea_field($resume); $fmt[] = '%s'; }
    if ($nb_pages !== null) { $data['nb_pages'] = (int)$nb_pages;                   $fmt[] = '%d'; }
    if (empty($data)) return;

    $rows = $wpdb->get_col(
      $wpdb->prepare("SELECT id FROM {$sT} WHERE publication_id=%d AND user_id IN ($ids)", $pub_id)
    );

    foreach ($rows as $sid) {
      $wpdb->update($sT, $data, ['id'=>(int)$sid], $fmt, ['%d']);
    }
  }

  /* ======================== STATS ======================== */
  public static function stats(array $args = []) {
    global $wpdb;

    $tp   = $wpdb->prefix . 'recherche_publication';
    $tlab = $wpdb->prefix . 'recherche_laboratoire';
    $tmem = $wpdb->prefix . 'recherche_membre';

    $uid   = get_current_user_id();
    $roles = wp_get_current_user() ? (array) wp_get_current_user()->roles : [];

    // 1) Fenêtre année universitaire
    $yearLabel = trim((string)($args['year'] ?? ''));
    $dateFrom = null; $dateTo = null;
    if ($yearLabel && preg_match('/(\d{4}).*?(\d{4})/', $yearLabel, $m)) {
      $y1 = (int)$m[1]; $y2 = (int)$m[2];
      $dateFrom = sprintf('%04d-09-01', $y1);
      $dateTo   = sprintf('%04d-08-31', $y2);
    }

    // 2) Rôles
    $roleL = array_map('strtolower', $roles);
    $isServiceUTM  = in_array('um_service-utm', $roleL, true) || in_array('service-utm', $roleL, true);
    $isServiceEtab = in_array('um_service-etablissement', $roleL, true) || in_array('service-etablissement', $roleL, true);
    $isDirecteur   = in_array('um_directeur_laboratoire', $roleL, true) || in_array('directeur_laboratoire', $roleL, true);

    // 3) Sous-select avec dref + statut normalisé
    $joins  = [];
    $where  = [];
    $params = [];

    if ($isServiceUTM) {
      // rien
    } elseif ($isServiceEtab) {
      $myEtab = (int) get_user_meta($uid, 'etablissement_id', true);
      if (!$myEtab) $where[] = '1=0';
      else {
        $joins[]  = "JOIN {$tlab} lab ON lab.id = p.laboratoire_id";
        $where[]  = 'lab.etablissement_id = %d';
        $params[] = $myEtab;
      }
    } elseif ($isDirecteur) {
      $labIds = self::labs_directed_by($uid);
      if (empty($labIds)) $where[]='1=0';
      else $where[] = 'p.laboratoire_id IN ('.implode(',', array_map('intval',$labIds)).')';
    } else {
      $labIds = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$tmem} WHERE user_id=%d", $uid)) ?: [];
      $labIds = array_map('intval',$labIds);
      if (empty($labIds)) $where[]='1=0';
      else $where[] = 'p.laboratoire_id IN ('.implode(',', $labIds).')';
    }

    $scopeJoin = implode("\n", $joins);
    $scopeWhere = empty($where) ? '1=1' : implode(' AND ', $where);

    $sql = "
      SELECT
        COUNT(*)                                                     AS total,
        SUM(CASE WHEN x.st = 'publiees'   THEN 1 ELSE 0 END)         AS publiees,
        SUM(CASE WHEN x.st = 'en_attente' THEN 1 ELSE 0 END)         AS en_attente,
        SUM(CASE WHEN x.st = 'rejetees'   THEN 1 ELSE 0 END)         AS rejetees
      FROM (
        SELECT
          p.id,
          DATE(COALESCE(NULLIF(p.date_publication,'0000-00-00'), DATE(p.created_at))) AS dref,
          CASE
            WHEN LOWER(TRIM(p.statut)) IN ('validée','validee','valide','publiee','publiée','published') THEN 'publiees'
            WHEN LOWER(TRIM(p.statut)) IN ('rejete','rejetee','rejetée','rejected')                      THEN 'rejetees'
            ELSE 'en_attente'
          END AS st
        FROM {$tp} p
        {$scopeJoin}
        WHERE {$scopeWhere}
      ) x
      WHERE 1=1
    ";

    if ($dateFrom && $dateTo) {
      $sql    .= " AND x.dref BETWEEN %s AND %s ";
      $params[] = $dateFrom;
      $params[] = $dateTo;
    }

    $row = $wpdb->get_row($wpdb->prepare($sql, ...$params), ARRAY_A);

    return [
      'total'      => (int)($row['total'] ?? 0),
      'publiees'   => (int)($row['publiees'] ?? 0),
      'en_attente' => (int)($row['en_attente'] ?? 0),
      'rejetees'   => (int)($row['rejetees'] ?? 0),
      'from'       => $dateFrom ?: null,
      'to'         => $dateTo   ?: null,
    ];
  }
}
