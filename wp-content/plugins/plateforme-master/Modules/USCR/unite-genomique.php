<?php
$role = $role ?? "service";

require_once 'wp-content/plugins/plateforme-master/pages/config/roles.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Unité Génomique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --red: #b60303;
      --gray: #f3f3f3;
      --dark: #333;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: var(--white);
      min-height: 100vh; 
    }

    </style>
</head>


<body>
  <!-- Header -->
  <?php include 'components/header.php'; ?>

  <?php include 'components/Nav-Pages.php'; ?>

  <?php include 'components/unite.php'; ?>

  <?php include 'components/testimonial.php'; ?>

  <?php include 'components/equipements.php'; ?>

  <?php include 'components/map-contact.php'; ?>
  <?php include 'components/footer.php'; ?>
  <?php include 'components/modal.php'; ?>


  <!-- Scripts -->
</body>
</html>
