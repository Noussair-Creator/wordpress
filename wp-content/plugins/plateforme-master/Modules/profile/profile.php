<?php
// Charger config rôles (si dispo)
$roles_config_file = dirname(__DIR__, 2) . '/config/roles.php';
if (file_exists($roles_config_file)) {
    require_once $roles_config_file; // peut définir $PM_ROLES et/ou $PM_ROLES_MAP
}

// User courant
$user_id     = get_current_user_id();
$current     = wp_get_current_user();
$wp_roles    = is_user_logged_in() ? (array) $current->roles : [];

// (Optionnel) mapping fin : WP/UM slug -> slug “messagerie”
// Si roles.php fournit déjà une table $PM_ROLES_MAP, on la garde.
// Sinon on met des défauts robustes couvrant tes captures.
if (!isset($PM_ROLES_MAP) || !is_array($PM_ROLES_MAP)) {
    $PM_ROLES_MAP = [
        'um_chercheur'             => 'um_chercheur',
        'chercheur'                => 'um_chercheur',

        'um_doctorant'             => 'um_doctorant',
        'doctorant'                => 'um_doctorant',

        'um_directeur_laboratoire' => 'um_directeur_laboratoire',
        'directeur_laboratoire'    => 'um_directeur_laboratoire',

        'service_master'           => 'service_master',
        'SERVICE MASTER'           => 'service_master',
        'Service MASTER'           => 'service_master',

        'coordonnateur_master'     => 'coordonnateur_master',
        'Coordonnateur Master'     => 'coordonnateur_master',

        'student_master'           => 'student_master',
        'student'                  => 'student_master',
        'candidat'                 => 'student_master',

        'pmo'                      => 'pmo',
        'PMO'                      => 'pmo',

        // …ajoute ici d’autres alias si besoin (admin_utm, service_etablissement, etc.)
    ];
}

// Sélectionne le premier rôle du user qui matche la table
$detected_role = null;
foreach ($wp_roles as $r) {
    if (isset($PM_ROLES_MAP[$r])) { $detected_role = $PM_ROLES_MAP[$r]; break; }
}

// Fallback si rien ne matche
// Fallback si rien ne matche : on ne force PAS "student_master"
if (!$detected_role) {
    // on garde le premier rôle WP brut, ou "other"
    $detected_role = $wp_roles[0] ?? 'other';
}
// Booléen simple à réutiliser côté PHP et JS
$is_student = !empty(array_intersect(
    array_map('strtolower', $wp_roles),
    ['um_student_master','student_master','um_doctorant','doctorant']
));


// Permettre d’écraser via ?role=... (si lien depuis la navbar)
if (isset($_GET['role']) && $_GET['role'] !== '') {
    $candidate = sanitize_text_field($_GET['role']);
    // on accepte si présent dans la map ou si c’est un slug connu de l’API
    if (isset($PM_ROLES_MAP[$candidate]) || preg_match('~^[a-z0-9_]+$~', $candidate)) {
        $detected_role = $candidate;
    }
}

// Valeur finale, utilisée partout (UI + appels API via PMSettings)
$role = $detected_role;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    :root {
      --red: #b60303;
      --gray: #f3f3f3;
      --dark: #333;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: var(--gray);
      min-height: 100vh; 
    }

    </style>
</head>


<body>
  <!-- Header -->
        <?php include 'wp-content/plugins/plateforme-master/pages/components/header.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
     <div class="col-md-3 col-lg-2 p-0 sidbarcol">

        <?php
            if ($role == 'um_service-etablissement' || $role == 'um_service-utm') {
                include 'components/sidebarUTM.php'; 
            }
            else {
              include 'wp-content/plugins/plateforme-master/pages/components/sidebar.php'; 
            }
       ?>


      </div>

      <div class="col-md-9 col-lg-10 p-0">
        <!-- Nav pages -->
        <?php include 'wp-content/plugins/plateforme-master/pages/components/Nav-Pages.php'; ?>

        <!-- Dashboard Top Bar -->
        <?php include 'wp-content/plugins/plateforme-master/pages/components/Dashboard-Bar.php'; ?>

        <!-- Place ce wrapper à l'endroit où tu inclus tes deux fichiers -->
        <div class="content p-4">
          <!-- Top Boxes (disponibilités, calendriers, carrousel) -->
         <?php require_once 'components/formulaireProfile.php'; ?>

        </div>

      </div>
    </div>
  </div>

  <!-- Scripts -->
</body>
</html>
<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    isStudent: <?= $is_student ? 'true' : 'false' ?>,
    userId: <?= (int) $user_id ?>
  };
</script>

