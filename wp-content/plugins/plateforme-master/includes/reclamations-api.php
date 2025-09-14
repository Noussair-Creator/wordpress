<?php
if (!defined('ABSPATH'))
  exit;

// import du service
require_once dirname(__FILE__, 2) . '/services/ReclamationService.php';

/* -----------------------------------------------------------
 * POST /wp-json/plateforme/v1/reclamations   (créer)
 * ---------------------------------------------------------*/
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/reclamations', [
    'methods' => 'POST',
    'permission_callback' => function () {
      return is_user_logged_in();
    }, // durci: user connecté + nonce REST
    'callback' => 'pm_rest_create_reclamation',
  ]);
});

function pm_rest_create_reclamation(WP_REST_Request $request)
{

  $payload = [
    'type' => sanitize_text_field($request->get_param('type')),
    'subject' => sanitize_text_field($request->get_param('subject')),
    'message' => wp_kses_post($request->get_param('message')),
    'anonymous' => ($request->get_param('anonymous') === '1' || $request->get_param('anonymous') === true) ? 1 : 0,
  ];

  // Upload optionnel (clé form-data: "attachment")
  $attachment_id = 0;
  $attachment_url = '';

  if (!empty($_FILES['attachment']) && is_array($_FILES['attachment'])) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment_id = media_handle_upload('attachment', 0);
    if (is_wp_error($attachment_id)) {
      return new WP_REST_Response([
        'ok' => false,
        'message' => 'Échec de l’upload : ' . $attachment_id->get_error_message(),
      ], 400);
    }
    $attachment_url = (string) wp_get_attachment_url($attachment_id);
  }

  $save = ReclamationService::create($payload, [
    'id' => $attachment_id,
    'url' => $attachment_url,
  ]);

  if (is_wp_error($save)) {
    return new WP_REST_Response([
      'ok' => false,
      'message' => $save->get_error_message(),
    ], 400);
  }

  return new WP_REST_Response([
    'ok' => true,
    'message' => 'Réclamation enregistrée.',
    'data' => [
      'id' => (int) $save['insert_id'],
      'owner_user_id' => (int) get_current_user_id(),
      'type' => $payload['type'],
      'subject' => $payload['subject'],
      'message' => $payload['message'],
      'is_anonymous' => (bool) $payload['anonymous'],
      // champs réponse (vides à la création)
      'statut_reponse' => 'En attente',
      'message_reponse' => '',
      'reponse_user_id' => null,
      'reponse_date' => null,
    ],
    'file' => ['id' => $attachment_id, 'url' => $attachment_url],
    'insert' => $save,
  ], 201);
}

/* -----------------------------------------------------------
 * PUT /wp-json/plateforme/v1/reclamations/{id}/reponse  (répondre)
 * ---------------------------------------------------------*/
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/reclamations/(?P<id>\d+)/reponse', [
    'methods' => 'PUT',
    'permission_callback' => function () {
      return is_user_logged_in();
    },
    'callback' => 'pm_rest_add_reclamation_response',
  ]);
});

function pm_rest_add_reclamation_response(WP_REST_Request $req)
{
  $id = (int) $req['id'];
  $statut = sanitize_text_field($req->get_param('statut_reponse') ?: 'En attente');
  $message = (string) $req->get_param('message_reponse');

  $updated = ReclamationService::add_response($id, $statut, $message);
  if (is_wp_error($updated)) {
    $code = (int) ($updated->get_error_data()['status'] ?? 400);
    return new WP_REST_Response(['ok' => false, 'message' => $updated->get_error_message()], $code);
  }
  return new WP_REST_Response(['ok' => true, 'data' => $updated], 200);
}

/* -----------------------------------------------------------
 * GET /wp-json/plateforme/v1/reclamations   (liste filtrée par rôle)
 * ---------------------------------------------------------*/
add_action('rest_api_init', function () {
  register_rest_route('plateforme/v1', '/reclamations', [
    'methods' => 'GET',
    'permission_callback' => function () {
      return is_user_logged_in();
    },
    'callback' => 'pm_rest_list_reclamations',
    'args' => [
      'page' => ['type' => 'integer', 'default' => 1],
      'per_page' => ['type' => 'integer', 'default' => 5],
      'search' => ['type' => 'string', 'required' => false],
    ],
  ]);
});

function pm_rest_list_reclamations(WP_REST_Request $req)
{
  global $wpdb;

  // Tables
  $t_rec = $wpdb->prefix . 'reclamations';
  $t_mem = $wpdb->prefix . 'recherche_membre';      // adapte si besoin
  $t_lab = $wpdb->prefix . 'recherche_laboratoire'; // OK avec tes captures
  $t_um = $wpdb->usermeta;

  $uid = get_current_user_id();
  if (!$uid) {
    return new WP_REST_Response(['data' => [], 'pagination' => ['total' => 0, 'page' => 1, 'per_page' => 5, 'pages' => 0]], 200);
  }

  $page = max(1, (int) ($req->get_param('page') ?: 1));
  $per = min(50, max(1, (int) ($req->get_param('per_page') ?: 5)));
  $q = trim((string) $req->get_param('search'));

  $u = wp_get_current_user();
  $roles = (array) $u->roles;
  $role = $roles[0] ?? '';

  $joins = [];
  $where = [];
  $params = [];

  switch ($role) {
    case 'um_service-utm':
      // voit tout (et donc voit aussi ses propres réclamations)
      // pas de WHERE additionnel
      break;

    case 'um_service-etablissement': {
      $my_etab = (int) get_user_meta($uid, 'etablissement_id', true);
      if (!$my_etab) {
        // on n'affiche que ses propres réclamations si l'admin n'a pas d'établissement rattaché
        $where[] = 'r.owner_user_id = %d';
        $params[] = $uid;
        break;
      }
      // jointure sur usermeta pour l’établissement
      $joins[] = "LEFT JOIN {$t_um} um_etab 
                      ON um_etab.user_id = r.owner_user_id 
                     AND um_etab.meta_key = 'etablissement_id'";

      // INCLUSION des propres réclamations : (meta = my_etab) OR (owner = moi)
      $where[] = '(CAST(um_etab.meta_value AS UNSIGNED) = %d OR r.owner_user_id = %d)';
      $params[] = $my_etab;
      $params[] = $uid;
      break;
    }

    case 'um_directeur_laboratoire': {
      // labo dirigé
      $my_lab = (int) $wpdb->get_var(
        $wpdb->prepare("SELECT id FROM {$t_lab} WHERE directeur_user_id = %d", $uid)
      );

      if (!$my_lab) {
        // si aucun labo dirigé, on montre au moins ses propres réclamations
        $where[] = 'r.owner_user_id = %d';
        $params[] = $uid;
        break;
      }

      // IMPORTANT : LEFT JOIN (et plus JOIN) pour permettre le OR r.owner_user_id = %d
      $joins[] = "LEFT JOIN {$t_mem} lm 
                           ON lm.user_id = r.owner_user_id 
                          AND lm.laboratoire_id = {$my_lab}";

      // INCLUSION des propres réclamations :
      // soit le owner est membre du labo dirigé, soit c'est le user lui-même
      $where[] = '(lm.user_id IS NOT NULL OR r.owner_user_id = %d)';
      $params[] = $uid;
      break;
    }

    case 'um_coordonnateur-master': {
      $my_master = (int) get_user_meta($uid, 'master_id', true);
      if (!$my_master) {
        $where[] = 'r.owner_user_id = %d';
        $params[] = $uid;
        break;
      }

      $joins[] = "LEFT JOIN {$t_um} um_master 
                      ON um_master.user_id = r.owner_user_id 
                     AND um_master.meta_key = 'master_id'";

      // INCLUSION des propres réclamations :
      $where[] = '(CAST(um_master.meta_value AS UNSIGNED) = %d OR r.owner_user_id = %d)';
      $params[] = $my_master;
      $params[] = $uid;
      break;
    }

    // chercheur / étudiant : seulement mes réclamations (comportement inchangé)
    default:
      $where[] = 'r.owner_user_id = %d';
      $params[] = $uid;
      break;
  }

  // Recherche plein-texte
  $search_sql = '';
  if ($q !== '') {
    $like = '%' . $wpdb->esc_like($q) . '%';
    $search_sql = ' AND (r.type LIKE %s OR r.sujet LIKE %s OR r.message LIKE %s) ';
    array_push($params, $like, $like, $like);
  }


  // WHERE final
  $where_sql = 'WHERE 1=1 ';
  if (!empty($where)) {
    $where_sql .= ' AND ' . implode(' AND ', $where);
  }
  $where_sql .= $search_sql;

  // COUNT
  $sql_count = "SELECT COUNT(*)
                  FROM {$t_rec} r
                  " . implode("\n", $joins) . "
                 {$where_sql}";
  $total = (int) $wpdb->get_var($wpdb->prepare($sql_count, ...$params));

  // DATA
  $offset = ($page - 1) * $per;
  $sql = "SELECT 
            r.id, r.owner_user_id, r.etudiant_id, r.type, r.sujet, r.message,
            r.piece_jointe_path, r.piece_jointe_id, r.is_anonymous, r.created_at,
            r.statut_reponse, r.message_reponse, r.reponse_user_id, r.reponse_date
          FROM {$t_rec} r
          " . implode("\n", $joins) . "
          {$where_sql}
          ORDER BY r.created_at DESC
          LIMIT %d OFFSET %d";

  $rows = $wpdb->get_results(
    $wpdb->prepare($sql, ...array_merge($params, [$per, $offset])),
    ARRAY_A
  ) ?: [];

  $data = array_map(function ($r) {
    $ts = $r['created_at'] ? strtotime($r['created_at']) : time();
    return [
      'id' => (int) $r['id'],
      'owner_user_id' => (int) $r['owner_user_id'],   // --> pour ton menu conditionnel
      'ref' => sprintf('#REC-%s-%03d', date('Y', $ts), (int) $r['id']),
      'type' => $r['type'],
      'sujet' => $r['sujet'],
      'date' => date_i18n('d-m-Y', $ts),
      'pj' => [
        'name' => $r['piece_jointe_path'] ? basename($r['piece_jointe_path']) : '—',
        'url' => (string) $r['piece_jointe_path'],
      ],
      'is_anonymous' => (int) $r['is_anonymous'],

      // Champs de réponse (pour afficher badge/puce + off-canvas de “Voir la réponse”)
      'statut_reponse' => $r['statut_reponse'] ?: 'En attente',
      'message_reponse' => (string) $r['message_reponse'],
      'reponse_user_id' => $r['reponse_user_id'] ? (int) $r['reponse_user_id'] : null,
      'reponse_date' => $r['reponse_date'] ? date_i18n('d-m-Y H:i', strtotime($r['reponse_date'])) : null,
    ];
  }, $rows);

  return new WP_REST_Response([
    'data' => $data,
    'pagination' => [
      'total' => $total,
      'page' => $page,
      'per_page' => $per,
      'pages' => (int) ceil($total / $per),
    ],
  ], 200);
}