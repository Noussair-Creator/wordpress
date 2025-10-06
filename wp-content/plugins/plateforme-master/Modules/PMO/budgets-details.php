<?php
$role = $role ?? "service";
// require_once plugin_dir_path(__FILE__) . '../config/roles.php';
require_once plugin_dir_path(__FILE__) . '../../config/roles.php';
require_once plugin_dir_path(__FILE__) . '/requireApi.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Budgets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLES - Load these only once -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="/wp-content/plugins/plateforme-master/assets/js/recherche/financements.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    <?php include plugin_dir_path(__FILE__) . '/components/header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0 sidbarcol">
                <?php include plugin_dir_path(__FILE__) . '/components/sidebar.php'; ?>
            </div>

            <div class="col-md-9 col-lg-10 p-0">
                <!-- Nav pages -->
                <?php include plugin_dir_path(__FILE__) . '/components/Nav-Pages.php'; ?>

                <!-- Dashboard Top Bar -->
                <?php include 'wp-content/plugins/plateforme-master/pages/components/Dashboard-Bar.php'; ?>

                <div class="content p-4">
                    <?php include 'components/budgets-details.php' ?>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS - Load these only once at the end of the body -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- Scripts -->
    <?php include 'components/scripts.php'; ?>
</body>

</html>