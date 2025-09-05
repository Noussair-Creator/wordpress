<?php
$role = $role ?? "student";
require_once plugin_dir_path(__FILE__).'../config/roles.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails master</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- (facultatif) Bootstrap + Fontawesome si tu en as besoin ailleurs -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    :root{
      --ink:#2A2916; --muted:#6E6D55; --line:#ECEBE3; --card:#FFFFFF;
      --shadow:0 9px 16px #0000001A; --red:#BF0404; --bg:#F3F2EF;
      --chip:#ECEBE3; --accent:#A6A485;
    }
    html,body{height:100%}
    body{
      margin:0; font-family:Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
      color:var(--ink); background:var(--bg);
    }

    /* Contenu principal */
    .content{ padding:16px; }

    /* ====== Grille 2 colonnes pour les blocs 2 & 3 ====== */
    .details-2col{
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); /* 2 → 1 colonnes fluide */
      gap:20px; align-items:stretch;
      margin-top:14px;
    }
    /* Garantit que chaque section occupe toute la hauteur de la cellule */
    .details-2col > section{ display:flex; }
    .details-2col > section .card{ display:flex; flex-direction:column; height:100%; }

    /* Carte générique (utile si tu veux l’appliquer ailleurs) */
    .card-clean{
      background:#fff; border-radius:10px; box-shadow:var(--shadow);
      border:1px solid #EDEBE7;
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

        <div class="content">
          <!-- Bloc 1 : Objectifs -->
          <?php include 'components/comp-objectifs.php'; ?>

          <!-- Bloc 2 & 3 en grille -->
          <div class="details-2col">
            <?php include 'components/comp-infos-detaillees.php'; ?>
            <?php include 'components/comp-plan-etude.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'components/scripts.php'; ?>
</body>
</html>
