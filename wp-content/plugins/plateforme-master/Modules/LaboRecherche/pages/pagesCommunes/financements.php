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
    // $(document).ready(function() {
    //     // --- TABLE 1 SCRIPT ---
    //     var table1 = $('#candidaturesTable').DataTable({
    //         destroy: true,
    //         paging: true,
    //         searching: true, // Enable searching for filtering
    //         ordering: false,
    //         info: false,
    //         pageLength: 5,
    //         dom: 'rt<"bottom"p><"clear">',
    //         language: {
    //             paginate: {
    //                 previous: "<i class='fa fa-chevron-left' style='color:red'></i>",
    //                 next: "<i class='fa fa-chevron-right' style='color:red'></i>"
    //             },
    //             emptyTable: "Aucune donnée disponible"
    //         }
    //     });

    //     // Search functionality for the first table
    //     $('#searchInput').on('keyup', function() {
    //         table1.search(this.value).draw();
    //     });

    //     // Filter for Source dropdown
    //     $('#sourceFilter').on('change', function() {
    //         table1.column(1).search(this.value).draw();
    //     });

    //     // Filter for Status dropdown
    //     $('#statusFilter').on('change', function() {
    //         // Search in the 6th column (Status)
    //         table1.column(6).search(this.value).draw();
    //     });

    //     // Checkbox functionality for the first table
    //     $("#checkAll").on("click", function() {
    //         var rows = table1.rows({
    //             'search': 'applied'
    //         }).nodes();
    //         $('input[type="checkbox"]', rows).prop('checked', this.checked);
    //     });

    //     $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
    //         if (!this.checked) {
    //             var el = $('#checkAll').get(0);
    //             if (el && el.checked && ('indeterminate' in el)) {
    //                 el.indeterminate = true;
    //             }
    //         }
    //     });

    // --- GENERIC DROPDOWN MENU LOGIC ---
    // $(document).on('click', '.action-btn', function(event) {
    //     event.stopPropagation();
    //     var dropdown = $(this).next('.dropdown-menu');
    //     $('.dropdown-menu').not(dropdown).removeClass('show');
    //     dropdown.toggleClass('show');
    // });

    // $(document).on('click', function() {
    //     $('.dropdown-menu').removeClass('show');
    // });
    // });
    </script>
    <script>
    // $(document).ready(function() {
    //     // --- TABLE 2 SCRIPT ---
    //     var table2 = $('#candidaturesTable2').DataTable({
    //         destroy: true,
    //         paging: true,
    //         // searching: false, // This line was disabling the search functionality
    //         ordering: false,
    //         info: false,
    //         pageLength: 5,
    //         dom: 'rt<"bottom"p><"clear">',
    //         language: {
    //             paginate: {
    //                 previous: "<i class='fa fa-chevron-left' style='color:red'></i>",
    //                 next: "<i class='fa fa-chevron-right' style='color:red'></i>"
    //             },
    //             emptyTable: "Aucune donnée disponible"
    //         }
    //     });

    //     $('#searchInput2').on('keyup', function() {
    //         table2.search(this.value).draw();
    //     });

    //     $("#checkAll2").on("click", function() {
    //         var rows = table2.rows({
    //             'search': 'applied'
    //         }).nodes();
    //         $('input[type="checkbox"]', rows).prop('checked', this.checked);
    //     });

    //     $('#candidaturesTable2 tbody').on('change', 'input[type="checkbox"]', function() {
    //         if (!this.checked) {
    //             var el = $('#checkAll2').get(0);
    //             if (el && el.checked && ('indeterminate' in el)) {
    //                 el.indeterminate = true;
    //             }
    //         }
    //     });

    // --- DROPDOWN MENU LOGIC ---
    // $(document).on('click', '.action-btn', function(event) {
    //     event.stopPropagation();
    //     var dropdown = $(this).next('.dropdown-menu');
    //     $('.dropdown-menu').not(dropdown).removeClass('show');
    //     dropdown.toggleClass('show');
    // });

    // $(document).on('click', function() {
    //     $('.dropdown-menu').removeClass('show');
    // });
    // });
    </script>
</body>

</html>