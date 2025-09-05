<?php
$role = $role ?? "service";
require_once plugin_dir_path(__FILE__) . '../config/roles.php';

require_once plugin_dir_path(__FILE__) . '../requireApi.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Financement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLES - Load these only once -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <!-- Your Custom Styles -->
    <style>
    /* All your custom CSS rules go here */
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
                    <?php include 'components/statFinancementDirecteurLabo.php'; ?>
                    <?php include 'components/TableFinancementDirecteurLabo.php'; ?>
                    <?php include 'components/TableFinancementDirecteurLabo2.php'; ?>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- SCRIPTS - Load these only once at the end of the body -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <!-- Your other scripts from 'components/scripts.php' can go here -->
    <?php include 'components/scripts.php'; ?>

    <script>
    $(document).ready(function() {
        // Initialize the first table (#candidaturesTable)
        $('#candidaturesTable').DataTable({
            paging: true,
            searching: false,
            ordering: false,
            info: false,
            pageLength: 4,
            dom: 't<"dataTables_wrapper"p>',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible"
            }
        });

        // Initialize the second table (#candidaturesTable2)
        $('#candidaturesTable2').DataTable({
            paging: true,
            searching: false,
            ordering: false,
            info: false,
            pageLength: 3,
            dom: 't<"dataTables_wrapper"p>',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible"
            }
        });

        // --- Unified Dropdown Menu Logic for ALL tables ---

        // Use event delegation on the body to handle clicks for any action button.
        // This single handler will work for both tables.
        $('body').on('click', '.action-btn', function(e) {
            e.stopPropagation(); // Prevent the click from bubbling up to the document

            let dropdown = $(this).next('.dropdown-menu');

            // Hide all other open dropdowns on the page
            $('.dropdown-menu').not(dropdown).hide();

            // Toggle the dropdown related to the clicked button
            dropdown.toggle();
        });

        // Close all dropdowns when clicking anywhere else on the page
        $(document).on('click', function() {
            $('.dropdown-menu').hide();
        });
    });
    </script>

</body>

</html>