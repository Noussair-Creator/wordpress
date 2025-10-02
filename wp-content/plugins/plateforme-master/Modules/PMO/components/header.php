<!-- HEADER -->
<style>
  .logo-section {
    display: flex;
    align-items: center;
    /* Vertically align items */
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

  /* Simplified and combined image styles */
  #drapeau_tunisie {
    width: 40px;
    height: auto;
  }

  #text_tunis {
    font-size: 10px;
    line-height: 1.2;
    font-weight: 400;
  }

  #logo_utm {
    height: 55px;
    /* Adjust height for better alignment */
    width: auto;
  }

  #logo_fst {
    height: 35px;
    /* Adjust height for better alignment */
    width: auto;
  }

  .hr-div {
    width: 1px;
    height: 40px;
    background-color: #ddd;
    margin: 0 15px;
    /* Added more space */
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
</style>

<header class="main-header">
  <div class="logo-section">

    <!-- Corrected path using the WordPress plugin_dir_url() function. -->
    <!-- This assumes 'mesrs_300x200_0.png' is in the 'images' folder at your plugin's root. -->
    <img src="/wp-content/plugins/plateforme-master/images/pmo/mesrs_300x200_0.png" alt="Logo MESRS" />

    <!-- Corrected path for other images as well -->
    <img src="/wp-content/plugins/plateforme-master/images/pmo/Image 30.png" id="drapeau_tunisie" alt="Logo Tunisie" />

    <span id="text_tunis">
      République Tunisienne<br />
      Ministère de l’Enseignement Supérieur<br />
      et de la Recherche Scientifique
    </span>

    <span class="hr-div"></span>

    <img src="/wp-content/plugins/plateforme-master/images/pmo/logo-removebg-preview.png" id="logo_utm"
      alt="Logo UTM" />

    <span class="hr-div"></span>

    <!-- Uncomment and use this line if you need it -->
    <!--<img src="<?php echo $plugin_url; ?>../../../imagesMaster/Image 76.png" id="logo_fst" alt="Logo FST" />-->
  </div>

  <div class="header-actions">
    <a href="https://utm.rnu.tn/utm/fr/" class="link-utm">Portail web UTM</a>
    <a href="#" class="link-utils">Liens utiles</a>
    <button class="btn-help">Aide</button>
  </div>
</header>