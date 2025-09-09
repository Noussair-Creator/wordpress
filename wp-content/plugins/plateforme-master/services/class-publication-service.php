<?php
if (!defined('ABSPATH')) { exit; }

class UTM_Publication_Service {
    /** Retourne [ 'member_ids' => [], 'lab_ids' => [] ] pour l’utilisateur courant */
// 1) Qui suis-je ? (membre + labos où je suis directeur)
public static function get_current_memberships(): array {
    global $wpdb;
    $uid = get_current_user_id();
    if (!$uid) return ['member_ids' => [], 'lab_ids' => []];

    // A) je suis membre (chercheur)
    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT id AS member_id, laboratoire_id 
             FROM utm_recherche_membre 
             WHERE user_id = %d",
            $uid
        ), ARRAY_A
    );
    $member_ids = array_map(fn($r)=>(int)$r['member_id'], $rows ?: []);
    $lab_ids    = array_map(fn($r)=>(int)$r['laboratoire_id'], $rows ?: []);

    // B) je suis directeur d’un ou plusieurs labos (via la colonne directeur_user_id)
    $director_labs = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT id 
             FROM utm_recherche_laboratoire 
             WHERE directeur_user_id = %d",
            $uid
        )
    ) ?: [];

    // union unique
    $lab_ids = array_values(array_unique(array_merge($lab_ids, array_map('intval',$director_labs))));

    return ['member_ids' => $member_ids, 'lab_ids' => $lab_ids];
}
// === Helpers DB (dans UTM_Publication_Service) ===
private static function t_pub(){ global $wpdb; return $wpdb->prefix.'recherche_publication'; }
private static function t_mem(){ global $wpdb; return $wpdb->prefix.'recherche_membre'; }
private static function t_lab(){ global $wpdb; return $wpdb->prefix.'recherche_laboratoire'; }

private static function col_exists($table, $col){
    global $wpdb;
    return (bool)$wpdb->get_var($wpdb->prepare("SHOW COLUMNS FROM {$table} LIKE %s", $col));
}

/** Auteur WP (user_id) d’une publication : created_by si dispo, sinon fallback */
public static function author_user_id(int $pub_id): int {
    global $wpdb;
    $pt = self::t_pub(); $mt = self::t_mem();

    // 1) created_by si la colonne existe
    if (self::col_exists($pt,'created_by')) {
        $uid = (int)$wpdb->get_var($wpdb->prepare("SELECT created_by FROM {$pt} WHERE id=%d", $pub_id));
        if ($uid) return $uid;
    }

    // 2) Fallback ancien schéma via chercheur_id → essai m.id puis m.user_id
    $cid = (int)$wpdb->get_var($wpdb->prepare("SELECT chercheur_id FROM {$pt} WHERE id=%d", $pub_id));
    if ($cid) {
        $uid = (int)$wpdb->get_var($wpdb->prepare("SELECT user_id FROM {$mt} WHERE id=%d LIMIT 1", $cid));
        if ($uid) return $uid;
        $uid = (int)$wpdb->get_var($wpdb->prepare("SELECT user_id FROM {$mt} WHERE user_id=%d LIMIT 1", $cid));
        if ($uid) return $uid;
    }
    return 0;
}

// 2) Suis-je directeur ?
public static function is_director(): bool {
    // On peut rester sur le rôle OU accepter "je suis listé comme directeur_user_id"
    $u = wp_get_current_user();
    if (in_array('um_directeur_laboratoire', (array)$u->roles, true)) return true;

    global $wpdb;
    $uid = get_current_user_id();
    $has = (int)$wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM utm_recherche_laboratoire WHERE directeur_user_id=%d", $uid)
    );
    return $has > 0;
}

    /** Normalise le statut en 3 états */
    public static function norm_statut(?string $s): string {
        $v = strtolower(trim((string)$s));
        if (str_starts_with($v, 'val')) return 'Validée';
        if (str_starts_with($v, 'rej')) return 'Rejetée';
        return 'En attente';
    }

    /** Liste des publications visible selon le rôle et filtres */
    public static function list(array $args = []): array {
        global $wpdb;

        $with_auteur = !empty($args['with_auteur']);
        $only_me     = !empty($args['me']);

        $you  = self::get_current_memberships();
        $mids = $you['member_ids'];
        $labs = $you['lab_ids'];
        $is_dir = self::is_director();

        if (empty($mids) && empty($labs)) return [];

        // jointure membre->labo pour inférer le labo d’une publication
        $select_cols = [
            "p.id", "p.type", "p.titre", "p.date_publication", "p.statut", 
            "p.chercheur_id", "m.laboratoire_id"
        ];

        $join = "JOIN utm_recherche_membre m ON m.id = p.chercheur_id";

        if ($with_auteur) {
            // auteur = wp_users.display_name via m.user_id
            $select_cols[] = "u.display_name AS auteur_display_name";
            $join .= " JOIN {$wpdb->users} u ON u.ID = m.user_id";
        }

        $where = [];
        $params = [];

        // visibilité :
        if ($only_me) {
            // Mes publications : par mes ids membre
            if (!empty($mids)) {
                $where[] = "p.chercheur_id IN (" . implode(',', array_map('intval',$mids)) . ")";
            } else {
                return [];
            }
        } else {
            // Espace labo : restreindre aux labos de l’utilisateur
            if (!empty($labs)) {
                $where[] = "m.laboratoire_id IN (" . implode(',', array_map('intval',$labs)) . ")";
            } else {
                return [];
            }
            // Si pas directeur → uniquement Validées
            if (!$is_dir) {
                $where[] = "(LOWER(p.statut) LIKE 'val%')";
            }
        }

        $sql = "SELECT " . implode(", ", $select_cols) . "
                FROM utm_recherche_publication p
                $join";

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }
        $sql .= " ORDER BY COALESCE(p.date_publication, '1970-01-01') DESC, p.id DESC";

        $rows = $wpdb->get_results($sql, ARRAY_A) ?: [];

        // post-traitement
        foreach ($rows as &$r) {
            $r['statut'] = self::norm_statut($r['statut'] ?? '');
            $r['can_moderate'] = $is_dir && in_array((int)$r['laboratoire_id'], $labs, true);
        }
        return $rows;
    }

    /** Vérifie que la publication appartient à un labo de l’utilisateur (retourne [row, lab_id]) */
    public static function fetch_owned_pub(int $pub_id): array {
        global $wpdb;
        $you  = self::get_current_memberships();
        $labs = $you['lab_ids'];
        if (empty($labs)) return [null, null];

        $row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT p.*, m.laboratoire_id 
                 FROM utm_recherche_publication p
                 JOIN utm_recherche_membre m ON m.id = p.chercheur_id
                 WHERE p.id = %d",
                $pub_id
            ), ARRAY_A
        );

        if (!$row) {
            $user  = wp_get_current_user();
            $roles = (array) $user->roles;
            if (in_array('um_directeur_laboratoire', (array)$roles, true)) {
            $row_directeur = $wpdb->get_row(
                $wpdb->prepare(
                        "SELECT created_by
                        FROM utm_recherche_publication
                        WHERE id = %d and created_by = " . $user->id,
                        $pub_id
                    ), ARRAY_A
                );
            
                if ($row_directeur) return [$row_directeur, (int)$row_directeur['laboratoire_id']]; 
            }
            return [null, null];
        }

        if (!in_array((int)$row['laboratoire_id'], $labs, true)) return [null, null];
        return [$row, (int)$row['laboratoire_id']];
    }

    /** Valide une publication (directeur uniquement dans ses labos) */
    public static function validate_pub(int $pub_id): bool {
        if (!self::is_director()) return false;
        global $wpdb;

        [$row, $lab_id] = self::fetch_owned_pub($pub_id);
        if (!$row) return false;

        $ok = $wpdb->update(
            'utm_recherche_publication',
            [
                'statut'       => 'Validée',
                'validated_by' => get_current_user_id(),
                'validated_at' => current_time('mysql'),
            ],
            [ 'id' => $pub_id ],
            [ '%s', '%d', '%s' ],
            [ '%d' ]
        );

        return $ok !== false;
    }

    /** Rejette (= supprime) une publication (directeur uniquement dans ses labos) */
    public static function reject_pub(int $pub_id): bool {
    if (!self::is_director()) return false;
    global $wpdb;

    [$row, $lab_id] = self::fetch_owned_pub($pub_id);
    if (!$row) return false;

    $pt = self::t_pub();
    $upd = []; $fmts = [];

    // statut
    $upd['statut'] = 'Rejetée'; $fmts[] = '%s';

    // métadonnées si dispo
    if (self::col_exists($pt,'rejected_by')) { $upd['rejected_by'] = get_current_user_id(); $fmts[] = '%d'; }
    if (self::col_exists($pt,'rejected_at')) { $upd['rejected_at'] = current_time('mysql'); $fmts[] = '%s'; }
    if (self::col_exists($pt,'updated_by'))  { $upd['updated_by']  = get_current_user_id(); $fmts[] = '%d'; }
    if (self::col_exists($pt,'updated_at'))  { $upd['updated_at']  = current_time('mysql'); $fmts[] = '%s'; }

    $ok = $wpdb->update($pt, $upd, ['id'=>$pub_id], $fmts, ['%d']);
    return $ok !== false;
}


    /** Supprimer “ma” publication (créateur) — pour ton onglet “Mes publications” */
    public static function delete_my_pub(int $pub_id): bool {
        global $wpdb;
        $you = self::get_current_memberships();
        if (empty($you['member_ids'])) return false;

        // sécurité : n’autoriser la suppression que si je suis l’auteur
        $owner_id = (int)$wpdb->get_var(
            $wpdb->prepare("SELECT chercheur_id FROM utm_recherche_publication WHERE id=%d", $pub_id)
        );
        if (!$owner_id || !in_array($owner_id, $you['member_ids'], true)) return false;

        $ok = $wpdb->delete('utm_recherche_publication', ['id' => $pub_id], ['%d']);
        return $ok !== false;
    }
}
