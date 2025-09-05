<?php
$role = $role ?? "service";
/*require_once '../config/roles.php';

/*require_once '../requireApi.php';*/

require_once plugin_dir_path(__FILE__) . '../config/roles.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title> Postuler</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    <style>
        .master-list-container {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
}

.list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-add-master {
  background-color: #c60000;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 5px;
  font-weight: bold;
}

.filters-row {
  display: flex;
  gap: 10px;
  margin: 15px 0;
}

.filter-input, select {
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.master-table {
  width: 100%;
  border-collapse: collapse;
}

.master-table th, .master-table td {
  padding: 12px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

.pdf-icon {
  color: red;
  font-size: 18px;
}

.avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
}

.dots-btn {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  z-index: 1;
  border-radius: 4px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  padding: 8px 12px;
  display: block;
  color: #000;
  text-decoration: none;
}

.pagination {
  display: flex;
  justify-content: flex-end;
  gap: 5px;
  padding-top: 15px;
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

        <!-- start code body - page -->

        <!-- liste master -->

        <?php include 'components/addappel-a-projets-postuler.php'; ?>



        <!-- end code body - page -->

        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <?php include 'components/scripts.php'; ?>
</body>
</html>
