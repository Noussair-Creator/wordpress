<?php
/*$role = $role ?? "coordinateur";*/


require_once 'config/roles.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - PMO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . '../assets/css/style.css'; ?>">
  <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/master.js'; ?>"></script>

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
  <?php include 'components/header.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 p-0 sidbarcol">
        <?php include 'components/sidebar.php'; ?>
      </div>

      <div class="col-md-9 col-lg-10 p-0">
        <!-- Nav pages -->
        <?php include 'components/Nav-Pages.php'; ?>

        <!-- Dashboard Top Bar -->
        <?php include 'wp-content/plugins/plateforme-master/pages/components/Dashboard-Bar.php'; ?>

        <div class="content p-4">
          <!-- Top Boxes (disponibilités, calendriers, carrousel) -->
          <?php include 'components/Liste-requêtes.php'; ?>

    
          <!-- Card Grid (modules) -->
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <?php include 'components/scripts.php'; ?>
</body>
</html>
