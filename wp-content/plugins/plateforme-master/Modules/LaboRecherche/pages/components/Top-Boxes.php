<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? '';
$user_id = get_current_user_id();
?>

<script>
  window.PMSettings = {
    restUrl: "<?= esc_url(rest_url()) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>
<?php
global $wpdb;

// ===== Contexte utilisateur =====
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? '';
$user_id = get_current_user_id();

// ===== Helpers =====
$table_labo = function_exists('svc_laboratoire_table')
  ? svc_laboratoire_table()
  : ($wpdb->prefix . 'utm_recherche_laboratoire');

$has_role = function (array $cands) use ($roles) {
  foreach ($cands as $r)
    if (in_array($r, $roles, true))
      return true;
  return false;
};

// ===== Données pour la box =====
$labo = null;
$fiche_labo = [];
//$labo_logo_url = plugins_url('imagesED/logo-lsama.png', __FILE__);
$labo_title = 'Laboratoire';
$labo_fiche_url = home_url("/fiche-details-du-labo_");
$box_override_html = ''; // si non vide → on remplace le rendu "fiche_labo"

// ===== Logique selon rôles =====
if ($user_id) {

  // 1) Directeur de labo : affiche son labo ; sinon message "pas encore affecté"
  if ($has_role(['um_directeur_laboratoire'])) {

    // via REST
    if (function_exists('rest_do_request')) {
      $req = new WP_REST_Request('GET', '/plateforme-recherche/v1/laboratoire/mine');
      $res = rest_do_request($req);
      if (!is_wp_error($res) && (int) $res->get_status() === 200) {
        $labo = $res->get_data();
      }
    }
    // fallback SQL
    if (!$labo) {
      $labo = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $table_labo WHERE directeur_user_id = %d ORDER BY id DESC LIMIT 1", $user_id),
        ARRAY_A
      );
    }

    if ($labo) {
      $fiche_labo = [
        'Code LR' => $labo['code_lr'] ?? '',
        'Établissement' => $labo['etablissement_nom'] ?? '',
        'Date de création' => $labo['date_creation'] ?? '',
        'Directeur du laboratoire' => $labo['directeur_nom_complet'] ?? ($labo['directeur_nom'] ?? $current_user->display_name),
      ];
      if (!empty($labo['logo_url']))
        $labo_logo_url = esc_url($labo['logo_url']);
      $labo_title = $labo['denomination'] ?? $labo_title;
      $labo_fiche_url = home_url("/fiche-details-du-labo_");

    } else {
      // PAS ENCORE AFFECTÉ → remplace la box
      ob_start(); ?>
      <div class="box-labo-info" id="box-fiche-labo" style="display: flex;align-items: center; /* centre verticalement */justify-content: center; /* centre horizontalement */">
        <div class="labo-info-left" style="text-align: center;">
          <h4 class="labo-info-title">Affectation en attente</h4>
          <div class="labo-info-list">
            <div class="labo-info-item" style="display: block;">
              <span class="labo-info-value">
                Aucun laboratoire ne vous est encore affecté. <br>
                Veuillez contacter le service de votre établissement.
              </span>
            </div>
          </div>
        </div>
        <div class="labo-info-logo">

          <?php if (!empty($labo_logo_url)): ?>
            <img src="<?php echo esc_url($labo_logo_url); ?>" alt="Logo Labo"
              style="width:30px;height:30px;border-radius:50%;margin-right:8px;vertical-align:middle;">
          <?php endif; ?>

        </div>
      </div>

      <!-- Overlay -->
    <div class="modal-overlay" id="unauthorizedModal">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Accès non autorisé</h2>
        </div>
        <div class="modal-body">
          <div class="modal-icon">
            <i class="fas fa-ban"></i>
          </div>
          <p>
            Vous n’avez pas encore été affecté à un laboratoire par le service UTM.<br><br>
            L’accès aux fonctionnalités de votre tableau de bord sera disponible dès que votre affectation sera validée.
          </p>
        </div>
        <div class="modal-footer">
          <a class="btn-disconnect" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Déconnecter</a>
        </div>
      </div>
    </div>

      <?php
      $box_override_html = ob_get_clean();
    }

    // 2) Service UTM : total des labos + lien liste
  }
  // 1bis) Chercheur sans labo
  elseif ($has_role(['um_chercheur'])) {

      // Vérifier si ce chercheur est membre d'un labo
      $labo = $wpdb->get_row(
          $wpdb->prepare("SELECT l.* 
                          FROM $table_labo l
                          INNER JOIN {$wpdb->prefix}recherche_membre m 
                              ON m.laboratoire_id = l.id
                          WHERE m.user_id = %d
                          ORDER BY l.id DESC
                          LIMIT 1", $user_id),
          ARRAY_A
      );

      if ($labo) {
          // ✅ Cas chercheur avec labo → on prépare la fiche labo
          $fiche_labo = [
              'Code LR' => $labo['code_lr'] ?? '',
              'Établissement' => $labo['etablissement_nom'] ?? '',
              'Date de création' => $labo['date_creation'] ?? '',
              'Directeur du laboratoire' => $labo['directeur_nom_complet'] ?? ($labo['directeur_nom'] ?? ''),
          ];
          if (!empty($labo['logo_url']))
              $labo_logo_url = esc_url($labo['logo_url']);
          $labo_title = $labo['denomination'] ?? $labo_title;
          $labo_fiche_url = home_url("/fiche-details-du-labo_");

      } else {
          // 🚫 Cas chercheur sans labo → afficher message d’attente
          ob_start(); ?>
          <div class="box-labo-info" id="box-fiche-labo" style="display:flex;align-items:center;justify-content:center;">
            <div class="labo-info-left" style="text-align:center;">
              <h4 class="labo-info-title">Affectation en attente</h4>
              <div class="labo-info-list">
                <div class="labo-info-item" style="display:block;">
                  <span class="labo-info-value">
                    Vous n’êtes actuellement rattaché à aucun laboratoire.<br>
                    Merci de contacter le directeur de votre établissement pour régulariser votre affectation.
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-overlay" id="unauthorizedModal">
            <div class="modal-content">
              <div class="modal-header">
                <h2>Accès non autorisé</h2>
              </div>
              <div class="modal-body">
                <div class="modal-icon">
                  <i class="fas fa-ban"></i>
                </div>
                <p>
                  Votre profil chercheur n’est pas encore rattaché à un laboratoire.<br><br>
                  L’accès complet au tableau de bord sera activé dès que votre affectation sera validée par l’administration.
                </p>
              </div>
              <div class="modal-footer">
                <a class="btn-disconnect" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Déconnecter</a>
              </div>
            </div>
          </div>
          <?php
          $box_override_html = ob_get_clean();
      }
  }
  elseif ($has_role(['um_service_utm', 'um_service-utm'])) {

    $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_labo");
    $liste_url = home_url('/liste-de-laboratoires/');
    ob_start(); ?>
    <div class="box-labo-info" id="box-fiche-labo">
      <div class="labo-info-left">
        <h4 class="labo-info-title">Laboratoires (UTM)</h4>
        <div class="labo-info-list">
          <div class="labo-info-item">
            <span class="labo-info-label">Nombre total</span>
            <span class="labo-info-value"><?php echo number_format_i18n($total); ?></span>
          </div>
        </div>
        <div style="margin-top:12px;">
          <a class="btn" href="<?php echo esc_url($liste_url); ?>"
            style="float:right;display:inline-block;background:#c60000;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none;">
            →
          </a>
        </div>
      </div>
      <div class="labo-info-logo">
        <!-- <img src="<?php echo esc_url($labo_logo_url); ?>" alt="Logo"> -->
      </div>
    </div>
    <?php
    $box_override_html = ob_get_clean();

    // 3) Service Établissement : nombre de labos de l’institut + lien liste
  } elseif ($has_role(['um_service_etablissement', 'um_service-etablissement'])) {

    $inst_id = get_user_meta($user_id, 'institut_id', true);

    if ($inst_id === '' || $inst_id === null) {
      ob_start(); ?>
      <div class="box-labo-info" id="box-fiche-labo">
        <div class="labo-info-left">
          <h4 class="labo-info-title">Laboratoires de l’établissement</h4>
          <div class="labo-info-list">
            <div class="labo-info-item">
              <span class="labo-info-label">Information</span>
              <span class="labo-info-value">Aucun <em>institut_id</em> n’est associé à votre compte.</span>
            </div>
          </div>
        </div>
        <div class="labo-info-logo">
          <!--<img src="<?php echo esc_url($labo_logo_url); ?>" alt="Logo"> -->
        </div>
      </div>
      <?php
      $box_override_html = ob_get_clean();

    } else {
      $total_etab = (int) $wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM $table_labo WHERE etablissement_id = %d", (int) $inst_id)
      );
      $liste_url = home_url('/liste-de-laboratoires/');
      ob_start(); ?>
      <div class="box-labo-info" id="box-fiche-labo">
        <div class="labo-info-left">
          <h4 class="labo-info-title">Laboratoires de l’établissement</h4>
          <div class="labo-info-list">
            <div class="labo-info-item">
              <span class="labo-info-label">Nombre</span>
              <span class="labo-info-value"><?php echo number_format_i18n($total_etab); ?></span>
            </div>
          </div>
          <div style="margin-top:12px;">
            <a class="btn" href="<?php echo esc_url($liste_url); ?>"
              style="float:right;display:inline-block;background:#c60000;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none;">
              →
            </a>
          </div>
        </div>
        <div class="labo-info-logo">
          <img src="<?php echo esc_url($labo_logo_url); ?>" alt="Logo">
        </div>
      </div>
      <?php
      $box_override_html = ob_get_clean();
    }
  }
}

// ===== Si pas de surcouche, préparer les valeurs standard (cas directeur avec labo trouvé)
if (!$box_override_html && $labo) {
  $fiche_labo = [
    'Code LR' => $labo['code_lr'] ?? '',
    'Établissement' => $labo['etablissement_nom'] ?? '',
    'Date de création' => $labo['date_creation'] ?? '',
    'Directeur du laboratoire' => $labo['directeur_nom_complet'] ?? ($labo['directeur_nom'] ?? ''),
  ];
  if (!empty($labo['logo_url']))
    $labo_logo_url = esc_url($labo['logo_url']);
  $labo_title = $labo['denomination'] ?? $labo_title;
  $slug = !empty($labo['slug']) ? sanitize_title($labo['slug']) : sanitize_title($labo_title);
  $labo_fiche_url = home_url("/fiche-details-du-labo_");
}

// ===== Fallback (si rien trouvé et pas de surcouche) : garder anciens contenus si dispo
if (!$box_override_html && !$labo) {
  $fiche_labo = $data['fiche_labo'] ?? $fiche_labo;
  $labo_logo_url = $labo_logo_url ?: plugins_url('imagesED/logo-lsama.png', __FILE__);
  $labo_title = $label ?? $labo_title;
  $labo_fiche_url = $labo_fiche_url ?: '/fiche-details-du-labo_';
}
?>

<style>
  /* Styles spécifiques au bloc .top-boxes */
  .top-boxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
  }


  .box {
    background-color: white;
    flex: 1 1 250px;
    display: flex;
    gap: 15px;
    padding: 0px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s;
    cursor: pointer;
  }

  .box:hover,
  .boxINFO:hover {
    transform: translateY(-4px);
  }

  .box-icon {
    background: transparent linear-gradient(180deg, #A6A485 0%, #6E6D55 100%) 0% 0% no-repeat padding-box;
    padding: 20px;
    border-radius: 12px 0 0 12px;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 200px;
  }

  .img-box {
    max-height: 80%;
    max-width: 100%;
    object-fit: contain;
  }

  .box-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    align-items: center;
    padding-top: 20px;
  }

  .box-content h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--dark);
    padding-bottom: 10px;
  }

  .list-box {
    margin: 0;
    padding-left: 20px;
    flex-grow: 0.5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
  }


  .boxINFO {
    background-color: white;
    flex: 1 1 50%;
    /* display: flex
;*/
    align-items: center;
    gap: 15px;
    padding: 0px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s;
    cursor: pointer;
    padding: 20px;

    /* background-image: url("/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg");*/
    background-size: cover;
    background-repeat: no-repeat;
    padding-bottom: 0px;
    max-width: 449px
  }

  .master-carousel-wrapper {
    width: 100%;
    margin: auto;
    text-align: center;
    margin-top: -36px;
  }

  .master-carousel-container {
    width: 100%;
    overflow: hidden;
    border-radius: 16px;
    position: relative;
  }

  .master-carousel {
    display: flex;
    transition: transform 0.6s ease;
  }

  .master-card {
    flex: 0 0 100%;
    padding: 0px;
    box-sizing: border-box;
    background: transparent;
    border-radius: 16px;
    text-align: left;
    padding-top: 35px;

  }

  .master-card h4 {
    margin-bottom: 10px;
    color: #222;
  }

  .info-flex {
    display: flex;
    gap: 20px;
  }

  .info-line {
    width: 40%;
    display: flex;
    flex-direction: column;
  }

  .info-value {
    width: 60%;
    display: flex;
    flex-direction: column;
  }

  .label,
  .value {
    font-size: 14px;
    margin-bottom: 4px;
  }

  .carousel-dots {
    float: right;
    position: relative;
    top: 28px;
    z-index: 9999;
  }

  .carousel-dots span {
    height: 10px;
    width: 10px;
    margin: 0 4px;
    background-color: #bbb;
    display: inline-block;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .carousel-dots .active {
    background-color: #333;
  }

  img.img-box {
    width: 50px;
  }

  .box-content.box-content-info {
    padding: 0px;
  }

  .info-flex .value {
    font-weight: 500;
  }

  .box li {
    line-height: 1.2em;
  }

  .doctorant-progress-box {
    background-color: #fff;
    border-radius: 12px;
    padding: 0px 0px 0px 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    position: relative;
    max-width: 680px;
    width: 100%;
    font-family: 'Arial', sans-serif;
  }

  .doctorant-header {
    position: relative;
    margin-bottom: 20px;
    font-size: 16px;
    color: #2A2916;
  }

  .credit-box {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #b00000;
    color: white;
    padding: 8px 20px;
    border-radius: 0 0 0 20px;
    font-size: 15px;
  }

  .credit-box .credit-value {
    font-size: 24px;
    font-weight: bold;
    margin-left: 8px;
  }

  .doctorant-legend {
    font-size: 13px;
    margin-top: 8px;
    display: grid;
    gap: 2px;
  }

  .doctorant-legend .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
  }

  .dot-filled {
    background-color: #b00000;
  }

  .dot-empty {
    border: 2px solid #b00000;
    background-color: transparent;
  }

  .progression-doctorat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    position: relative;
  }

  .step {
    text-align: center;
    flex: 1;
    z-index: 2;
  }

  .step span {
    font-size: 13px;
    color: #5a564a;
    position: absolute;
  }

  .step .dot {
    border-radius: 50%;
    margin: 0 auto 6px;
  }

  .completed-dot {
    background-color: #b00000;
  }

  .upcoming-dot {
    border: 2px solid #b00000;
    background-color: #fff;
  }

  .line {
    flex-grow: 1;
    height: 4px;
    background-color: #e6e6e6;
    margin: 0 -5px;
    z-index: 1;
  }

  .line-active {
    background-color: #b00000 !important;
  }

  .doctorant-header h6 {
    font-size: 16px;
    top: 23px;
    margin-bottom: 39px;
    position: relative;
    font-weight: 600;
  }

  .progression-doctorat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    position: relative;
    gap: 0;
    /* Important pour que les cercles collent aux lignes */
    width: 90%;
    padding-left: 10px;
  }


  .step {
    text-align: center;
    z-index: 2;
    display: inline-grid;
    position: relative;
    flex: 0 0 0px;
  }

  .step .dot {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    margin: 0 auto;
  }

  .step span {
    font-size: 13px;
    color: #5a564a;
    display: block;
    margin-top: 30px;
  }

  .line {
    flex-grow: 1;
    height: 4px;
    background-color: #e6e6e6;
    margin: 0 -5px;
    z-index: 1;
    transition: background-color 0.3s ease;
  }

  .line-active {
    background-color: #b00000;
  }

  .completed-dot {
    background-color: #b00000;
  }

  .upcoming-dot {
    background-color: #fff;
    border: 2px solid #b00000;
  }

  .box-standard {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    display: flex;
    gap: 15px;
    flex: 1 1 23%;
    transition: 0.2s ease;
    cursor: pointer;
  }

  .box-standard:hover {
    transform: translateY(-4px);
  }

  .box-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
  }

  .box-list {
    list-style: none;
    padding-left: 15px;
  }

  .box-list li {
    margin-bottom: 6px;
    font-size: 14px;
  }

  .box-labo-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    padding: 20px;
    gap: 30px;
    flex: 1 1 50%;
    background-image: url(/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg);
    background-size: cover;
    background-repeat: no-repeat;
  }

  .labo-info-left {
    flex: 1;
  }

  .labo-info-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .labo-info-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .labo-info-item {
    display: flex;
    justify-content: space-between;
    padding-bottom: 4px;
  }

  .labo-info-label {
    font-weight: 500;
    color: #555;
  }

  .labo-info-value {
    font-weight: 600;
    color: #000;
  }

  .labo-info-logo img {
    max-height: 100px;
    object-fit: contain;
  }


  /********************** */


  /* Overlay de fond */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.45);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

/* Boîte principale */
.modal-content {
  background: #fff;
  border-radius: 8px;
  width: 462px;
  max-width: 90%;
  box-shadow: 0 5px 25px rgba(0,0,0,0.2);
  overflow: hidden;
  animation: fadeIn 0.3s ease-in-out;
  text-align: center;
  font-family: 'Segoe UI', sans-serif;
}

/* En-tête */
.modal-header {
  background: #c62828; /* rouge foncé */
  color: white;
  padding: 15px;
  font-size: 18px;
  font-weight: bold;
}
.modal-header h2 {
    font-size: 16px;
}
/* Corps */
.modal-body {
  padding: 25px 20px;
  color: #333;
  font-size: 15px;
  line-height: 1.5;
}
.modal-body p {
    margin-top: 15px;
    letter-spacing: 0px;
    color: #2A2916;
    font-weight: 500;
}

.modal-icon {
  font-size: 48px;
  color: #c62828;
}

/* Pied */
.modal-footer {
  display: flex;
  padding: 15px 20px 20px;
}

.btn-disconnect {
  background: #c5bba5; 
  color: #333;
  border: none;
  padding: 10px 18px;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.btn-disconnect:hover {
  background: #b0a58d;
}

.btn-contact {
  background: #c62828;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.btn-contact:hover {
  background: #a71c1c;
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-20px); }
  to   { opacity: 1; transform: translateY(0); }
}
.btn-disconnect {
    color: #fff;
    float: right;
}
</style>


<div class="top-boxes">
  <?php
  $iconMap = [
    "presence" => "person-done",
    "calendriers" => "calendar",
    "fiche_labo" => "info"
  ];

  $labelMap = [
    "presence" => "Assiduité",
    "calendriers" => "Calendriers",
    "fiche_labo" => "Dénomination du laboratoire"
  ];

  $boxLinks = [
    "presence" => "/assiduite-des-chercheurs",
    "calendriers" => "/Calendrier_",
  ];

  foreach ($labelMap as $key => $label):
    if (empty($data[$key]))
      continue;

    // 🔷 Box spéciale fiche labo
    if ($key === 'fiche_labo'): ?>
      <?php if (!empty($box_override_html)): ?>
        <?= $box_override_html; ?>
      <?php else: ?>
        <div class="box-labo-info" id="box-fiche-labo">
          <div class="labo-info-left">
            <h4 class="labo-info-title"><?= esc_html($labo_title) ?></h4>
            <div class="labo-info-list">
              <?php foreach ($fiche_labo as $infoLabel => $val): ?>
                <div class="labo-info-item">
                  <span class="labo-info-label"><?= esc_html($infoLabel) ?> :</span>
                  <span class="labo-info-value"><?= esc_html($val) ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="labo-info-logo">
            <a href="<?= esc_url($labo_fiche_url) ?>">
              <img src="<?= esc_url($labo_logo_url) ?>" alt="<?= esc_attr($labo_title) ?>">
            </a>
          </div>
        </div>
      <?php endif; ?>
      <?php continue; endif; // fin fiche_labo
  

    // 🔷 Box standard
    $iconFile = "/wp-content/plugins/plateforme-master/imagesED/27) Icon-" . $iconMap[$key] . ".png";
    $boxUrl = esc_url($boxLinks[$key] ?? '#');
    ?>
    <div class="box-standard" data-href="<?= $boxUrl ?>">
      <div class="box-icon">
        <img src="<?= esc_url($iconFile) ?>" alt="<?= esc_attr($label) ?>" class="img-box">
      </div>
      <div class="box-content">
        <h4 class="box-title"><?= esc_html($label) ?></h4>
        <ul class="box-list">
          <?php foreach ($data[$key] as $sousLabel => $val): ?>
            <li>
              <?= is_string($sousLabel) ? "<strong>" . esc_html($sousLabel) . ":</strong> " : "" ?>
              <?= esc_html($val) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const boxes = document.querySelectorAll('.box-standard');
    boxes.forEach(box => {
      box.addEventListener('click', () => {
        const href = box.getAttribute('data-href');
        if (href && href !== '#') {
          window.location.href = href;
        }
      });
    });

    const box = document.getElementById('box-fiche-labo');
    if (!box) return;
    const items = box.querySelectorAll('.labo-info-item');
    items.forEach(item => {
      const label = item.querySelector('.labo-info-label')?.textContent.trim();
      if (label === 'Statut du financement') {
        const valEl = item.querySelector('.labo-info-value');
        const s = (valEl?.textContent || '').trim().toLowerCase();
        const dot = document.createElement('i');
        dot.className = 'fas fa-circle';
        dot.style.marginRight = '6px';
        dot.style.color = (s === 'actif') ? '#28a745' : '#dc3545';
        valEl.prepend(dot);
      }
    });
  });
</script>