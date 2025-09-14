<?php
if (!defined('ABSPATH')) exit;

class PubService {

  public static function t_publications() { global $wpdb; return $wpdb->prefix . 'recherche_publication'; }
  public static function t_membres()      { global $wpdb; return $wpdb->prefix . 'recherche_membre'; }
  public static function t_labs()         { global $wpdb; return $wpdb->prefix . 'recherche_laboratoire'; }

  public static $ROLE_DIR  = ['um_directeur_laboratoire','directeur_laboratoire','directeur-laboratoire'];
  public static $ROLE_UTM  = ['um_service-utm','service_utm','service-utm'];
  public static $ROLE_ETAB = ['um_service-etablissement','service_etablissement','service-etablissement'];

  public static function user_has_any_role(array $choices): bool {
    $u = wp_get_current_user(); if (!$u || empty($u->roles)) return false;
    $roles = array_map('strtolower', (array)$u->roles);
    foreach ($choices as $r) if (in_array(strtolower($r), $roles, true)) return true;
    return false;
  }
  public static function is_directeur()    { return self::user_has_any_role(self::$ROLE_DIR); }
  public static function is_service_utm()  { return self::user_has_any_role(self::$ROLE_UTM); }
  public static function is_service_etab() { return self::user_has_any_role(self::$ROLE_ETAB); }

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

  public static function user_etab_id(int $user_id): int {
    return (int) get_user_meta($user_id, 'etablissement_id', true) ?: 0;
  }

  public static function create(array $payload) {
    global $wpdb; $t = self::t_publications();
    $uid = get_current_user_id(); if (!$uid) return new WP_Error('forbidden','Non connecté', ['status'=>401]);

    $labs = self::my_lab_ids(); if (empty($labs))
      return new WP_Error('forbidden','Aucun laboratoire rattaché', ['status'=>403]);

    $lab_id = (int)($payload['laboratoire_id'] ?? 0);
    if ($lab_id && !in_array($lab_id, $labs, true))
      return new WP_Error('forbidden','Labo invalide pour cet utilisateur', ['status'=>403]);
    if (!$lab_id) $lab_id = (int)$labs[0];

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
      'fichier_url'      => esc_url_raw($payload['fichier_url'] ?? ''),
      'laboratoire_id'   => $lab_id,
      'chercheur_id'     => $uid,
      'created_by'       => $uid,
      'updated_by'       => $uid,
      'created_at'       => current_time('mysql'),
      'updated_at'       => current_time('mysql'),
      'statut'           => $statut,
    ];
    if ($is_dir_for_lab) {
      $data['validated_by'] = $uid;
      $data['validated_at'] = current_time('mysql');
    }

    $ok = $wpdb->insert($t, $data, [
      '%s','%s','%s','%s','%s','%s','%d','%d','%d','%s','%s','%s','%s'
    ]);
    if (!$ok) return new WP_Error('db_error','Insert failed: '.$wpdb->last_error, ['status'=>500]);

    return self::get((int)$wpdb->insert_id);
  }

  public static function get(int $id) {
    global $wpdb; $t = self::t_publications();
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $id), ARRAY_A);
    if (!$row) return null;
    $row['auteur_display_name'] = get_the_author_meta('display_name', (int)$row['chercheur_id']) ?: '';
    return $row;
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

  public static function list(array $opts = []) {
    global $wpdb; $t = self::t_publications(); $uid = get_current_user_id();
    if (!$uid) return [];

    $with_auteur = !empty($opts['with_auteur']);
    $me          = !empty($opts['me']);
    $search      = trim((string)($opts['search'] ?? ''));

    $where = []; $params = [];

    if ($search !== '') {
      $like = '%'.$wpdb->esc_like($search).'%';
      $where[] = "(p.titre LIKE %s OR p.type LIKE %s OR p.resume LIKE %s)";
      array_push($params, $like,$like,$like);
    }

    if ($me) {
      $where[] = "p.created_by=%d"; $params[] = $uid;
    } else if ($with_auteur) {
      if (self::is_service_utm()) {
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
        $labs = self::my_lab_ids();
        if (empty($labs)) $where[]='1=0';
        else $where[] = "p.laboratoire_id IN (".implode(',', array_map('intval',$labs)).")";
      } else {
        $labs = self::my_lab_ids();
        if (empty($labs)) $where[]='1=0';
        else {
          $where[] = "p.laboratoire_id IN (".implode(',', array_map('intval',$labs)).")";
          $where[] = "p.statut = 'Validée'";
        }
      }
    } else {
      $where[] = '1=0';
    }

    $where_sql = empty($where) ? '' : 'WHERE '.implode(' AND ', $where);
    $sql = "SELECT p.* FROM {$t} p {$where_sql} ORDER BY p.created_at DESC";
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

  /**
   * ===== STATS corrigées =====
   * - dref = COALESCE(date_publication, DATE(created_at))
   * - normalisation des statuts
   * - périmètre par rôle
   */
  public static function stats(array $args = []) {
    global $wpdb;

    $tp   = $wpdb->prefix . 'recherche_publication';
    $tlab = $wpdb->prefix . 'recherche_laboratoire';
    $tmem = $wpdb->prefix . 'recherche_membre';

    $uid   = get_current_user_id();
    $roles = wp_get_current_user() ? (array) wp_get_current_user()->roles : [];

    // 1) Fenêtre année universitaire (par défaut : illimitée si year vide)
    $yearLabel = trim((string)($args['year'] ?? ''));
    $dateFrom = null; $dateTo = null;
    if ($yearLabel && preg_match('/(\d{4}).*?(\d{4})/', $yearLabel, $m)) {
    $y1 = (int)$m[1]; $y2 = (int)$m[2];
    // année universitaire: 01/09/y1 -> 31/08/y2
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
      $labIds = $wpdb->get_col($wpdb->prepare("SELECT id FROM {$tlab} WHERE directeur_user_id=%d", $uid)) ?: [];
      $labIds = array_map('intval',$labIds);
      if (empty($labIds)) $where[]='1=0';
      else $where[] = 'p.laboratoire_id IN ('.implode(',', $labIds).')';
    } else {
      // chercheur : labos dont je suis membre
      $labIds = $wpdb->get_col($wpdb->prepare("SELECT laboratoire_id FROM {$tmem} WHERE user_id=%d", $uid)) ?: [];
      $labIds = array_map('intval',$labIds);
      if (empty($labIds)) $where[]='1=0';
      else $where[] = 'p.laboratoire_id IN ('.implode(',', $labIds).')';
    }

    $scopeJoin = implode("\n", $joins);
    $scopeWhere = empty($where) ? '1=1' : implode(' AND ', $where);

    // 4) On calcule, puis on filtre la période sur x.dref
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
