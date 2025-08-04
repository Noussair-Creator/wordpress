<div class="sl-left-side">
  <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/Groupe de masques 471.png' ?>" alt="Image Réinitialisation">
</div>

<div class="sl-right-side">
  <div class="sl-help-link">
    <span>Besoin d'aide ? Consultez notre guide d'inscription</span>
    <a href="<?= plugin_dir_url(__FILE__) . '../assets/img/candidature_master_guide.pdf' ?>" download class="sl-pdf-link">
      <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/pdf-svgrepo-com (2).png' ?>" alt="PDF" class="sl-icon">
    </a>
    <span>ou</span>
    <a href="#" class="sl-video-link">
      <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/play-svgrepo-com.png' ?>" alt="Vidéo" class="sl-icon">
    </a>
  </div>

  <div class="sl-login-box">
    <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/logo-removebg-preview.png' ?>" alt="UTM Logo" class="sl-logo">
    <h2>NOUVEAU MOT DE PASSE</h2>
    <h3 class="sl-subtitle">Réinitialisation sécurisée</h3>
    <h3 class="sl-subtitle">Plateforme de la Recherche UTM</h3>

    <?php if (!empty($_SESSION['sl_reset_error'])): ?>
      <div class="sl-error"><?= esc_html($_SESSION['sl_reset_error']); unset($_SESSION['sl_reset_error']); ?></div>
    <?php endif; ?>

    <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>

    <button type="submit" name="sl_set_new_password" class="sl-btn">Enregistrer le nouveau mot de passe</button>

    <div class="sl-options">
      <div class="sl-left"></div>
      <div class="sl-right">
        <a href="<?= home_url('/connexion') ?>" class="sl-forgot">← Retour à la connexion</a>
      </div>
    </div>
  </div>
</div>
