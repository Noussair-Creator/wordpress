<?php
$role = $role ?? "service";
require_once plugin_dir_path(__FILE__) . '../config/roles.php';

require_once plugin_dir_path(__FILE__) . '../requireApi.php';


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche Individuelle du Doctorant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Google Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"> -->




    <style>
    :root {
        --red: #b60303;
        --gray: #f3f3f3;
        --dark: #333;
    }

    body {
        margin: 0;
        font-family: 'Roboto', sans-serif;
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

                    <?php include 'components/Infofichedevaluationannuelle_directeurTh.php' ?>
                    <?php include 'components/Tableaufichedevaluationannuelle_directeurTh.php' ?>
                    <?php include 'components/Commentfichedevaluationannuelle_directeurTh.php' ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php include 'components/scripts.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>