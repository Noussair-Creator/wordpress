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
    <title>Calendrier Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Poppins Font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

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

                    <?php include 'components/calendrier-detais.php'; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php include 'components/scripts.php'; ?>
    <!-- jQuery and Bootstrap JS -->


</body>

</html>