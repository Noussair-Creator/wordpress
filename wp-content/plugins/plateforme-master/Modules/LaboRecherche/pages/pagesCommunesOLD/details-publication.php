<?php
$role = $role ?? "service";
// require_once plugin_dir_path(__FILE__) . '../config/roles.php';
require_once plugin_dir_path(__FILE__) . '../../../../config/roles.php';
require_once plugin_dir_path(__FILE__) . '../requireApi.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails Une Publication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        xintegrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8UoGIt0VOKvqz4XifbQpzsvvLVWQKSkncDONEsdQIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

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
    <?php include plugin_dir_path(__FILE__) . '/../components/header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0 sidbarcol">
                <?php include plugin_dir_path(__FILE__) . '/../components/sidebar.php'; ?>
            </div>

            <div class="col-md-9 col-lg-10 p-0">
                <!-- Nav pages -->
                <?php include plugin_dir_path(__FILE__) . '/../components/Nav-Pages.php'; ?>

                <!-- Dashboard Top Bar -->
                <?php include 'wp-content/plugins/plateforme-master/pages/components/Dashboard-Bar.php'; ?>

                <div class="content p-4">
                    <?php include 'components/InfoDetailsPublicationDirecteurDuLabo.php'; ?>
                    <?php include 'components/TableauDetailsPublicationDirecteurDuLabo.php'; ?>
                    <?php include 'components/CommentaireDetailsPublicationDirecteurDuLabo.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <?php include 'components/scripts.php'; ?>
</body>

</html>