<?php
require_once 'requireApi.php'; // auth sécurisée si besoin
require_once 'config/roles.php';

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Fallback pour image personnalisée
$avatar_id = get_user_meta($user_id, 'user_avatar_id', true);
$avatar_url = $avatar_id ? wp_get_attachment_url($avatar_id) : get_avatar_url($user_id);

// Récupération
$first_name = get_user_meta($user_id, 'first_name', true);
$last_name  = get_user_meta($user_id, 'last_name', true);
$email      = $current_user->user_email;
$grade      = get_user_meta($user_id, 'grade', true);
$specialite = get_user_meta($user_id, 'specialite', true);
$tel        = get_user_meta($user_id, 'telephone', true);
$institut   = get_user_meta($user_id, 'institut_nom', true);


// Mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    update_user_meta($user_id, 'grade', sanitize_text_field($_POST['grade']));
    update_user_meta($user_id, 'specialite', sanitize_text_field($_POST['specialite']));
    update_user_meta($user_id, 'telephone', sanitize_text_field($_POST['telephone']));
    update_user_meta($user_id, 'institut_nom', sanitize_text_field($_POST['institut']));
    wp_update_user(['ID' => $user_id, 'user_email' => sanitize_email($_POST['email'])]);

    

    // Upload avatar
    if (!empty($_FILES['avatar']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attachment_id = media_handle_upload('avatar', 0);
        if (!is_wp_error($attachment_id)) {
            update_user_meta($user_id, 'user_avatar_id', $attachment_id);
            $avatar_url = wp_get_attachment_url($attachment_id);
        }
    }

    $success_message = "Profil mis à jour avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier mon profil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'components/header.php'; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2 p-0 sidbarcol">
      <?php include 'components/sidebar.php'; ?>
    </div>

    <div class="col-md-9 col-lg-10 p-0">
      <?php include 'components/Nav-Pages.php'; ?>
      <?php include 'components/Dashboard-Bar.php'; ?>

      <div class="content p-4">
        <div class="bg-white rounded p-4 shadow-sm">
          <h4 class="mb-4">Modifier mon profil</h4>

          <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data">
            <div class="col-md-12 text-center mb-3">
              <label class="form-label">Photo de profil</label><br>
              <img src="<?= esc_url($avatar_url) ?>" class="rounded-circle mb-2" width="90" height="90" alt="Avatar">
              <input type="file" name="avatar" class="form-control mt-2" accept="image/*">
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="last_name" class="form-control" value="<?= esc_attr($last_name) ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="first_name" class="form-control" value="<?= esc_attr($first_name) ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Grade</label>
                <input type="text" name="grade" class="form-control" value="<?= esc_attr($grade) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Spécialité</label>
                <input type="text" name="specialite" class="form-control" value="<?= esc_attr($specialite) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="<?= esc_attr($tel) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc_attr($email) ?>" required>
              </div>

            

              <div class="col-12 text-end mt-4">
                <button type="submit" name="update_profile" class="btn btn-danger">Enregistrer</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'components/scripts.php'; ?>
</body>
</html>
