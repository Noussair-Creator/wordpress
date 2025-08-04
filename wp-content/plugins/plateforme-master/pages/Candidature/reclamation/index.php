<?php include __DIR__ . '/../layout/header_side.php'; ?>

 <main class="main-content">
                <!-- Progress steps -->


                <!-- Form container -->
                <div class="form-container">
                    <form id="application-form">
                        <!-- Step 1: Personal Information -->
                        <div class="form-step active" id="step1">
                            <div class="section-title">
                                <h2 class="Quicksand-bold">Ajouter votre réclamation</h2>
                            </div>
                            <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="Topic">Topic<span class="required">*</span></label>
                                    <input type="text" id="Topic" name="Topic" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="Email"  >Email<span
                                            class="required">*</span></label>
                                    <input type="text" id="Email" name="Email" dir="rtl" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-field">
                                    <label for="prenom">Prénom <span class="required">*</span></label>
                                    <input type="text" id="prenom" name="prenom" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="nom"> Nom <span
                                            class="required">*</span></label>
                                    <input type="text" id="nom" name="nom" dir="rtl" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-field">
                                    <label for="sujet">Sujet<span class="required">*</span></label>
                                    <input type="text" id="sujet" name="sujet" dir="rtl" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="Message">Message<span class="required">*</span></label>
                                    <textarea   id="Message" name="Message" required style="width: 100%;min-width: 100%;"></textarea>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="tel">N° tél<span class="required">*</span></label>
                                    <input type="text" id="tel" name="tel" dir="rtl" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                           

                            <div class="form-actions">
                                <button type="button" id="next-btn" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>

                    </form>
                </div>
            </main>
        </div>
    </div>
 <?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
$user_id = $current_user->ID;
?>

<script>
  const PMSettings = {
    apiUrlCandidats: '<?= esc_url(rest_url("plateforme-master/v1/candidats")) ?>',
    nonce: '<?= wp_create_nonce("wp_rest") ?>',
    role: '<?= esc_js($role) ?>',
    userId: <?= (int) $user_id ?>
  };
</script>