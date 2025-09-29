<?php
/**
 * Service GED (Documents) — logique métier & sécurité par laboratoire
 */
if (!defined('ABSPATH')) { exit; }

class PM_GED_Service {

  /* ===== Tables ===== */
  public static function table_docs(){
    global $wpdb; return $wpdb->prefix . 'recherche_documents';
  }
  public static function table_membre(){
    global $wpdb; return $wpdb->prefix . 'recherche_membre';
  }
  public static function table_labo(){
    global $wpdb; return $wpdb->prefix . 'recherche_laboratoire';
  }

  /* ===== Create table (si absente) ===== */
  public static function maybe_create_table(){
    global $wpdb;
    $t = self::table_docs();
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS `{$t}` (
      `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
      `laboratoire_id` BIGINT UNSIGNED NOT NULL,
      `owner_user_id` BIGINT UNSIGNED NOT NULL,
      `reference` VARCHAR(32) NOT NULL,
      `titre` VARCHAR(255) NOT NULL,
      `categorie` VARCHAR(100) NOT NULL,
      `description` TEXT NULL,
      `file_id` BIGINT UNSIGNED NULL,
      `file_url` TEXT NULL,
      `created_at` DATETIME NOT NULL,
      `updated_at` DATETIME NOT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_labo` (`laboratoire_id`),
      KEY `idx_owner` (`owner_user_id`),
      KEY `idx_cat` (`categorie`)
    ) {$charset}";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
  }

  /* ===== Labos de l'utilisateur courant (membre + directeur) ===== */
  public static function current_user_lab_ids(): array {
    global $wpdb;
    $uid = get_current_user_id();
    if (!$uid) return [];

    $tm = self::table_membre();
    $tl = self::table_labo();

    $labs = [];

    // membre
    $rows = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$tm} WHERE user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));

    // directeur
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$tl} WHERE directeur_user_id=%d", $uid)) ?: [];
    $labs = array_merge($labs, array_map('intval',$rows));

    $labs = array_values(array_unique(array_filter($labs)));
    return $labs;
  }

  /* ===== Helpers ===== */
  public static function make_reference($id){
    return sprintf('DOC-%s-%04d', date('Y'), (int)$id);
  }
  public static function sanitize_text($s){ return is_scalar($s) ? sanitize_text_field($s) : ''; }
  public static function sanitize_desc($s){ return is_scalar($s) ? wp_kses_post($s) : ''; }

  /* ===== CREATE ===== */
  public static function create(array $data, array $file = []){
    global $wpdb; self::maybe_create_table();
    $t = self::table_docs();

    $uid = (int) get_current_user_id();
    if (!$uid) return new WP_Error('forbidden', 'Non connecté', ['status'=>403]);

    $labs = self::current_user_lab_ids();
    if (empty($labs)) return new WP_Error('forbidden', 'Aucun laboratoire associé', ['status'=>403]);

    $laboratoire_id = !empty($data['laboratoire_id']) ? (int)$data['laboratoire_id'] : (int)$labs[0];
    if (!in_array($laboratoire_id, $labs, true)) {
      return new WP_Error('forbidden', 'Labo non autorisé', ['status'=>403]);
    }

    $titre     = self::sanitize_text($data['titre'] ?? '');
    $categorie = self::sanitize_text($data['categorie'] ?? '');
    $desc      = self::sanitize_desc($data['description'] ?? '');

    if ($titre === '' || $categorie === '') {
      return new WP_Error('bad_request', 'Titre et catégorie sont requis', ['status'=>400]);
    }

    $fid  = !empty($file['id'])  ? (int)$file['id']  : 0;
    $furl = !empty($file['url']) ? esc_url_raw($file['url']) : '';

    $now = current_time('mysql');

    $ok = $wpdb->insert($t, [
      'laboratoire_id' => $laboratoire_id,
      'owner_user_id'  => $uid,
      'reference'      => '',
      'titre'          => $titre,
      'categorie'      => $categorie,
      'description'    => $desc,
      'file_id'        => $fid,
      'file_url'       => $furl,
      'created_at'     => $now,
      'updated_at'     => $now,
    ], ['%d','%d','%s','%s','%s','%s','%d','%s','%s','%s']);

    if (!$ok) return new WP_Error('db_error','Insert failed: '.$wpdb->last_error, ['status'=>500]);

    $id = (int)$wpdb->insert_id;
    $ref = self::make_reference($id);
    $wpdb->update($t, ['reference'=>$ref], ['id'=>$id], ['%s'], ['%d']);

    return self::get($id);
  }

  /* ===== GET ONE ===== */
  public static function get($id){
    global $wpdb; self::maybe_create_table();
    $t = self::table_docs();

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", (int)$id), ARRAY_A);
    if (!$row) return new WP_Error('not_found','Introuvable', ['status'=>404]);

    $labs = self::current_user_lab_ids();
    if (empty($labs) || !in_array((int)$row['laboratoire_id'], $labs, true)) {
      return new WP_Error('forbidden','Accès refusé', ['status'=>403]);
    }
    return $row;
  }

  /* ===== LIST ===== */
  public static function list(array $args = []){
    global $wpdb; self::maybe_create_table();
    $t = self::table_docs();

    $uid = (int) get_current_user_id();
    if (!$uid) return ['rows'=>[], 'total'=>0, 'page'=>1, 'per_page'=>10];

    $labs = self::current_user_lab_ids();
    if (empty($labs)) return ['rows'=>[], 'total'=>0, 'page'=>1, 'per_page'=>10];

    $page = max(1, (int)($args['page'] ?? 1));
    $per  = min(100, max(1, (int)($args['per_page'] ?? 10)));
    $off  = ($page - 1) * $per;

    $where  = ["laboratoire_id IN (".implode(',', array_map('intval',$labs)).")"];
    $params = [];

    if (!empty($args['mine'])) {
      $where[] = "owner_user_id = %d";
      $params[] = $uid;
    }

    if (!empty($args['search'])) {
      $q = '%'.$wpdb->esc_like(trim((string)$args['search'])).'%';
      $where[] = "(titre LIKE %s OR categorie LIKE %s)";
      array_push($params, $q, $q);
    }

    $where_sql = "WHERE ".implode(" AND ", $where);

    $total = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$t} {$where_sql}", ...$params));

    $sql = "SELECT * FROM {$t} {$where_sql} ORDER BY updated_at DESC LIMIT %d OFFSET %d";
    $rows = $wpdb->get_results($wpdb->prepare($sql, ...array_merge($params, [$per, $off])), ARRAY_A) ?: [];

    return ['rows'=>$rows, 'total'=>$total, 'page'=>$page, 'per_page'=>$per];
  }

  /* ===== UPDATE (owner uniquement) ===== */
  public static function update($id, array $data, array $file = []){
    global $wpdb; self::maybe_create_table();
    $t = self::table_docs();

    $cur = self::get($id);
    if (is_wp_error($cur)) return $cur;

    $uid = (int) get_current_user_id();
    if ($uid !== (int)$cur['owner_user_id']) {
      return new WP_Error('forbidden','Vous ne pouvez modifier que vos documents', ['status'=>403]);
    }

    $upd = [];
    $fmt = [];

    if (isset($data['titre']))       { $upd['titre'] = self::sanitize_text($data['titre']); $fmt[]='%s'; }
    if (isset($data['categorie']))   { $upd['categorie'] = self::sanitize_text($data['categorie']); $fmt[]='%s'; }
    if (isset($data['description'])) { $upd['description'] = self::sanitize_desc($data['description']); $fmt[]='%s'; }

    if (!empty($file)) {
      $upd['file_id']  = !empty($file['id']) ? (int)$file['id'] : 0;              $fmt[]='%d';
      $upd['file_url'] = !empty($file['url']) ? esc_url_raw($file['url']) : '';   $fmt[]='%s';
    }

    if (empty($upd)) return self::get($id);

    $upd['updated_at'] = current_time('mysql'); $fmt[]='%s';

    $ok = $wpdb->update($t, $upd, ['id'=>(int)$id], $fmt, ['%d']);
    if ($ok === false) return new WP_Error('db_error', 'Update failed: '.$wpdb->last_error, ['status'=>500]);

    return self::get($id);
  }

  /* ===== DELETE (owner uniquement) ===== */
  public static function delete($id){
    global $wpdb; self::maybe_create_table();
    $t = self::table_docs();

    $cur = self::get($id);
    if (is_wp_error($cur)) return $cur;

    $uid = (int) get_current_user_id();
    if ($uid !== (int)$cur['owner_user_id']) {
      return new WP_Error('forbidden','Vous ne pouvez supprimer que vos documents', ['status'=>403]);
    }

    $ok = $wpdb->delete($t, ['id'=>(int)$id], ['%d']);
    if (!$ok) return new WP_Error('db_error','Delete failed: '.$wpdb->last_error, ['status'=>500]);

    return new WP_REST_Response(null, 204);
  }

}

/* auto-création de la table */
add_action('init', ['PM_GED_Service','maybe_create_table']);
