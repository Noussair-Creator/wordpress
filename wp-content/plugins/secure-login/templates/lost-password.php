<form method="post" class="sl-form-wrapper" id="mot_passe_oublie">
  <div class="sl-left-side">
    <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/Groupe de masques 471.png' ?>" alt="Image Mot de passe oublié">
  </div>

  <div class="sl-right-side">
    <div class="sl-help-link">
      <span>Besoin d'aide ? Consultez notre guide d'inscription</span>
      <a href="<?= plugin_dir_url(__FILE__) . '../assets/img/candidature_master_guide.pdf' ?>" download class="sl-pdf-link">
        <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/pdf-svgrepo-com (2).png' ?>" alt="PDF" class="sl-icon">
      </a>
      <span style="flex:none">ou</span>
      <a href="#" class="sl-video-link">
        <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/play-svgrepo-com.png' ?>" alt="Vidéo" class="sl-icon">
      </a>
    </div>
    <div class="sl-login-box">
      <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/logo-removebg-preview.png' ?>" alt="UTM Logo" class="sl-logo">
      <h2>MOT DE PASSE OUBLIÉ</h2>
      <h3 class="sl-subtitle">Plateforme Numérique dédiée à la recherche UTM</h3>
      <h3 class="sl-subtitle">Espace Master</h3>

      <?php if (!empty($_SESSION['sl_lostpass_msg'])): ?>
        <div class="sl-msg"><?= esc_html($_SESSION['sl_lostpass_msg']); unset($_SESSION['sl_lostpass_msg']); ?></div>
      <?php endif; ?>

      <input type="email" name="sl_reset_email" placeholder="Votre adresse email" required>

      <button type="submit" name="sl_request_reset" class="sl-btn">Recevoir un lien de réinitialisation</button>

      <div class="sl-options">
        <div class="sl-left"></div>
        <div class="sl-right">
          <a href="<?= home_url('/connexion') ?>" class="sl-forgot">← Retour à la connexion</a>
        </div>
      </div>
    </div>
  </div>
</form>

