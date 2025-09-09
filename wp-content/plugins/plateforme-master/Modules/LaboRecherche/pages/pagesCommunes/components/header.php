
<?php
if (!defined('ABSPATH')) exit;

function pm_get_institut_logo_url_for_current_user() {
    global $wpdb;

    $uid = get_current_user_id();
    if (!$uid) return null;

    // institut_id stocké dans les métadonnées utilisateur (cf. ton contexte)
    $institut_id = (int) get_user_meta($uid, 'institut_id', true);
    if (!$institut_id) return null;

    // ⚠️ Utilise le nom EXACT de ta table
    $table = $wpdb->prefix .'master_instituts';

    // Récupération du champ 'logo' (peut être relatif ou absolu)
    $row = $wpdb->get_row(
        $wpdb->prepare("SELECT nom, logo FROM {$table} WHERE id = %d LIMIT 1", $institut_id),
        ARRAY_A
    );
    if (!$row) return null;

    $logo = trim((string)($row['logo'] ?? ''));
    if ($logo === '') return null;

    // Normaliser l’URL si on a un chemin relatif
    if (stripos($logo, 'http://') === 0 || stripos($logo, 'https://') === 0) {
        $logo_url = $logo;
    } else {
        // Exemple: /wp-content/uploads/instituts/fst.png  →  https://site/...
        $logo_url = home_url( '/' . ltrim($logo, '/') );
    }

    // Optionnel : valider que c’est bien une URL
    $logo_url = esc_url_raw($logo_url);
    return $logo_url ?: null;
}
?>

<!-- HEADER -->
<style>
  .logo-section {
    display: flex;
    padding-bottom: 7px;
  }

  .main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    padding: 10px 20px;
    z-index: 9999;
    padding-bottom: 0px;
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
  }


  .logo-section img {
    height: 45px;
    margin-right: 10px;
  }

  /* img#drapeau_tunisie {
    width: 5%;
    height: 6%;
    position: relative;
    top: 8px;
    margin-left: -19px;
} */

  span#text_tunis {
    font-size: 10px;
    line-height: 10px;
    position: relative;
    top: 7px;
    font-weight: 400;
  }

  img#logo_utm {
    /* width: 7%; */
    width: 10%;
    height: 8%;
    position: relative;
    /* top: -5px; */
    top: 0px;
    padding-left: 10px;
  }

  img#logo_fst {
    /* width: 10%; */
    width: 12%;
    height: 4%;
    position: relative;
    top: 5px;
    padding-left: 10px;
  }

  span.hr-div {
    width: 1px;
    height: 40px;
    background-color: #ddd;
    margin: 2px 9px;
  }

  .header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .header-actions a {
    font-size: 14px;
    color: #333;
    text-decoration: underline;
    font-weight: 500;
  }

  .btn-help {
    background: transparent;
    color: #000;
    border: 2px solid #000;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }

  img#drapeau_tunisie {
    /* 
    width: 5%;
    height: 6%;
    top: 8px; 
     */
    width: 10%;
    height: 14%;
    top: 5px;
    position: relative;
    /* margin-left: -19px; */
    margin-left: 10px;
  }

  span#text_tunis {
    font-size: 10px;
    line-height: 10px;
    position: relative;
    top: 7px;
    font-weight: 400;
  }

  /* img#logo_utm {
    width: 7%;
    height: 8%;
    top: -5px;
    position: relative;
    padding-left: 10px;
} */

  /* img#logo_fst {
    width: 7%;
    height: 4%;
    top: 5px;
    position: relative;
    padding-left: 10px;
} */

  span.hr-div {
    width: 1px;
    height: 40px;
    background-color: #ddd;
    margin: 2px;
    margin-left: 9px;
  }
</style>

<header class="main-header">
  <div class="logo-section">
    <!-- <img src="/imagesMaster/mesrs_300x200_0.png" alt="Logo MESRS" /> -->
    <img src="/wp-content/plugins/plateforme-master/images/newimages/mesrs_300x200_0.png" alt="Logo MESRS" />
    <img src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" id="drapeau_tunisie"
      alt="Logo Tunisie" />
    <span id="text_tunis">
      République Tunisienne<br />
      Ministère de l’Enseignement Supérieur<br />
      et de la Recherche Scientifique test
    </span>
    <span class="hr-div"></span>
    <img src="/wp-content/plugins/plateforme-master/images/newimages/logo-removebg-preview.png" id="logo_utm"
      alt="Logo UTM" />
    <span class="hr-div"></span>


    <?php
    $logo_url = pm_get_institut_logo_url_for_current_user();

    if ($logo_url) {
        // Si tu veux mettre le nom de l’institut dans l’alt, récupère-le aussi si besoin.
        echo '<img src="' . esc_url($logo_url) . '" id="logo_institut" alt="Logo institut" />';
    }
    // Sinon: n'affiche rien du tout.
    ?>


  </div>

  <div class="header-actions">
    <a href="https://utm.rnu.tn/utm/fr/" class="link-utm">Portail web UTM</a>
    <a href="#" class="link-utils">Liens utiles</a>
    <button class="btn-help">Aide</button>
  </div>
</header>