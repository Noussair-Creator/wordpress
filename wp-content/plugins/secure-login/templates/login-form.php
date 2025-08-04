
<?php $isResetPassword = isset($_SESSION['sl_reset_uid'], $_SESSION['sl_reset_token']); ?>



<?php
/*
$isResetPassword = isset($_SESSION['sl_step']) && $_SESSION['sl_step'] === 'verify'
    && !is_user_logged_in();

    */
?>



<form method="post" class="sl-form-wrapper">
  <div class="sl-left-side">
    <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/Groupe de masques 471.png' ?>" alt="Image Connexion">
  </div>

  <div class="sl-right-side">
    <div class="sl-help-link">
      <div>Besoin d'aide ? Consultez notre guide d'inscription</div>
      <div id="sl-pdf-btn" class="sl-pdf-link">
  <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/pdf-svgrepo-com (2).png' ?>" alt="PDF" class="sl-icon">
</div>

<div>ou</div>

<div id="sl-video-btn" class="sl-video-link">
  <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/play-svgrepo-com.png' ?>" alt="Vidéo" class="sl-icon">
</div>
    </div>

    <div id="sl-video-modal" class="sl-modal">
      <div class="sl-modal-content">
        <span class="sl-close-modal" onclick="closeVideo()">&times;</span>
        <video id="sl-video-player" controls style="object-fit: contain; width: 100vw;">
          <source src="<?= plugin_dir_url(__FILE__) . '../assets/img/preinscription.mp4' ?>" type="video/mp4">
        </video>
      </div>
    </div>

    <div class="sl-login-box">
      <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/logo-removebg-preview.png' ?>" alt="UTM Logo" class="sl-logo">

      <?php if ($isResetPassword): ?>
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

      <?php else: ?>
        <h2>CONNEXION</h2>
        <h3 class="sl-subtitle">Plateforme Numérique dédiée à la recherche UTM</h3>
        <h3 class="sl-subtitle">Espace Master</h3>

        <?php if (!empty($_SESSION['sl_error'])): ?>
          <div class="sl-error"><?= esc_html($_SESSION['sl_error']); unset($_SESSION['sl_error']); ?></div>
        <?php endif; ?>

        <input type="email" name="sl_email" placeholder="Votre adresse email" required>
        <div class="sl-password-field">
          <input type="password" name="sl_password" placeholder="Mot de passe" id="sl-password" required>
          <span class="sl-toggle" onclick="toggleSlPassword()">
            <img loading="lazy" src="<?= plugin_dir_url(__FILE__) . '../assets/img/27) Icon-eye.png' ?>" alt="Afficher" class="sl-icon">
          </span>
        </div>

        <button type="submit" name="sl_login_submit" class="sl-btn">SE CONNECTER</button>

        <div class="sl-options">
          <div class="sl-left">
            <label class="sl-remember">
              <input type="checkbox" checked>
              <span>Rester connecté</span>
            </label>
          </div>

          <div class="sl-right">
            <a href="<?= home_url('/mot-de-passe-oublie') ?>" class="sl-forgot">Mot de passe oublié ?</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const pdfBtn = document.getElementById('sl-pdf-btn');
    const videoBtn = document.getElementById('sl-video-btn');
    const modal = document.getElementById('sl-video-modal');
    const video = document.getElementById('sl-video-player');
    const closeBtn = document.querySelector('.sl-close-modal');
    if (pdfBtn) {
      pdfBtn.addEventListener('click', function () {
        const a = document.createElement('a');
        a.href = "<?= plugin_dir_url(__FILE__) . '../assets/img/candidature_master_guide.pdf' ?>";
        a.download = "candidature_master_guide.pdf";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      });
    }

    if (videoBtn && modal && video) {
      videoBtn.addEventListener('click', function () {
        modal.style.display = 'block';
        video.play();

        if (video.requestFullscreen) {
          video.requestFullscreen();
        } else if (video.webkitRequestFullscreen) {
          video.webkitRequestFullscreen();
        } else if (video.msRequestFullscreen) {
          video.msRequestFullscreen();
        }
      });
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
        video.pause();
        if (document.fullscreenElement) {
          document.exitFullscreen();
        }
      });
    }
  });
</script>


<style>
.sl-modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.8);
}

.sl-modal-content {
  position: relative;
  margin: 5% auto;
  padding: 20px;
  width: 80%;
  max-width: 800px;
  background: #fff;
  border-radius: 8px;
}

.sl-close-modal {
  position: absolute;
  right: 20px;
  top: 10px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

#sl-video-player {
  width: 100%;
  height: auto;
  display: block;
  margin: 0 auto;
}

.sl-pdf-link, .sl-video-link {
  cursor: pointer;
  text-decoration: none;
}
</style>
