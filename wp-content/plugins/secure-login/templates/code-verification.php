<form method="post" class="sl-form-wrapper">
  <div class="sl-left-side">
    <img loading="lazy"src="<?= plugin_dir_url(__FILE__) . '../assets/img/Groupe de masques 471.png' ?>" alt="Image Vérification">
  </div>

  <div class="sl-right-side">
    <div class="sl-login-box">
      <img src="<?= plugin_dir_url(__FILE__) . '../assets/img/logo-removebg-preview.png' ?>" alt="UTM Logo" class="sl-logo">
      <h2>CODE DE VERIFICATION</h2>
      <p class="sl-subtitle-info">
        Nous avons envoyé un code à <strong><?= esc_html($_SESSION['sl_email'] ?? 'votre adresse') ?></strong>.
      </p>

      <div class="sl-code-inputs">
        <?php for ($i = 0; $i < 4; $i++): ?>
          <input type="text" name="code[]" maxlength="1" required>
        <?php endfor; ?>
      </div>

      <?php if (!empty($_SESSION['sl_code_error'])): ?>
        <div class="sl-error"><?= esc_html($_SESSION['sl_code_error']); unset($_SESSION['sl_code_error']); ?></div>
      <?php endif; ?>

      <button type="submit" name="sl_verify_code" class="sl-btn">ACCEPTER</button>

      <form method="post" class="sl-resend-form">
        <button type="submit" name="sl_resend_code" class="sl-btn-outline">RENVOYER LE CODE</button>
      </form>
    </div>
  </div>
</form>
