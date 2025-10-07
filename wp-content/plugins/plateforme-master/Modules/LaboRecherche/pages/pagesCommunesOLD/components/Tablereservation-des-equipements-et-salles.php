<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            /* font-family: 'Segoe UI', sans-serif; */
            /* padding: 20px; */
        }

        .accordion-container {
            border-radius: 12px;
            /* overflow: hidden; */
            /* This line was causing the issue */
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #ddd;
        }


        .accordion-tabs {
            display: flex;
            background: #f3f3f3;
        }

        .tab-btn {
            flex: 1;
            padding: 15px 20px;
            font-weight: 600;
            border: none;
            background: #A6A485;
            cursor: pointer;
            font-size: 18px;
            color: #fff;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .tab-btn:not(:last-child) {
            border-right: 1px solid #ddd;
            margin-right: 10px;
        }

        .tab-btn.active {
            background-color: #fff;
            color: #2A2916;
        }

        .tab-btn img {
            width: 28px;
            height: 28px;
        }

        .accordion-content {
            padding: 25px;
            background: #fff;
        }


        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 25px;
        }

        .filter-selectgb {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            display: flex;
            align-items: center;
            border: 1px solid #d8d4b7;
            border-radius: 6px;
            padding: 0 10px;
            background-color: #fff;
        }

        .search-box i {
            color: #666;
        }

        .filter-input {
            padding: 10px 5px;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 14px;
            background: #fff;
            width: 200px;
        }

        .date-input-container {
            display: flex;
            align-items: center;
            border: 1px solid #d8d4b7;
            border-radius: 6px;
            padding: 0 10px;
            background-color: #fff;
        }

        .date-input {
            padding: 10px 5px;
            border: none;
            outline: none;
            font-size: 14px;
            border-radius: 6px;
        }

        .filter-select {
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #d8d4b7;
            font-size: 14px;
            background: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 12px;
            padding-right: 30px;
            width: 200px;
        }

        .filter-buttons {
            display: flex;
            border: 1px solid #d8d4b7;
            border-radius: 5px;
            overflow: hidden;
            padding: 3px 5px;
        }

        .filter-btn {
            padding: 5px 25px;
            border: none;
            background: transparent;
            color: #2d2a12;
            font-weight: 500;
            cursor: pointer;
            /* border-right: 1px solid #d8d4b7; */
        }

        .filter-btn:last-child {
            border-right: none;
        }

        .filter-btn.active {
            background-color: #b2ae90;
            color: #fff;
            border-radius: 3px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-statut {
            background-color: #BF0404;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
        }

        .icon-btn {
            width: 44px;
            height: 44px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #BF0404;
            font-size: 18px;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', sans-serif;
        }

        .styled-table thead {
            background-color: #f3f1e9;
        }



        .styled-table th,
        .styled-table td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .styled-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .styled-table th {
            font-weight: 600;
            color: #333;

        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
        }

        .badge-success {
            color: #198754;
            background-color: #e6f7ee;
        }

        .badge-danger {
            color: #d71920;
            background-color: #fff0f0;
        }

        .badge-warning {
            color: #d89e00;
            background-color: #fff9e6;
        }

        .status-icon {
            font-size: 20px;
            text-align: center;
        }

        .status-icon.fa-exclamation-triangle {
            color: #d89e00;
        }

        .status-icon.fa-check-circle {
            color: #198754;
        }

        .status-icon.fa-times-circle {
            color: #d71920;
        }

        .details-icon {
            font-size: 20px;
            color: #555;
            cursor: pointer;
        }

        .actions {
            position: relative;
            display: inline-block;
        }

        .action-btn {
            background-color: transparent;
            border: none;
            /* font-size: 20px; */
            cursor: pointer;
            padding: 5px;
            width: 36px;
            height: 36px;
            font-size: 24px;
            font-weight: bolder;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 200px;
            background-color: #ffffff;
            border: 1px solid #d8d4b7;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 5px 0;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            text-decoration: none;
            font-size: 14px;
            color: #2d2a12;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        .dropdown-menu i {
            width: 16px;
            text-align: center;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 2px solid #c60000;
            color: #c60000 !important;
            padding: 8px 14px;
            border-radius: 8px;
            background: white !important;
            font-weight: bold;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            border: 2px solid #c60000;
            color: #c60000 !important;
            padding: 8px 14px;
            border-radius: 8px;
            background: white !important;
            font-weight: bold;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: black !important;
            border: none;
        }

        /* ------------------------ */
        .btn-close-x {
            background: transparent;
            border: none;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            background-color: #c62828;
            border-radius: 5px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-close-x:hover {
            background-color: #a02020;
        }

        .modal-overlay {
            position: fixed;
            top: 0px;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: flex-end;
            z-index: 999999;
        }

        .popup-container {
            background-color: white;
            width: 400px;
            height: 100%;
            padding: 20px 0px;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            padding-top: 0px;
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-bottom: 20px;
            padding-left: 25px;
            padding-right: 25px;
            box-shadow: 0px 5px 16px #00000029;
            padding-top: 20px;
        }

        form.popup-form {
            padding-left: 25px;
            padding-right: 25px;
        }

        .popup-header h2,
        .popup-form h2 {
            font-size: 16px;
            margin: 0;
            color: #2A2916;

        }

        .btn-enregistrer {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-form .form-group {
            margin-bottom: 15px;
        }



        .popup-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            /* color: #A6A485; */
        }

        .popup-form input,
        .popup-form select,
        .popup-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .popup-form .date-time-group {
            display: flex;
            gap: 10px;
        }

        .popup-form .date-time-group .form-group {
            flex: 1;
        }

        .popup-form .input-with-icon {
            position: relative;
        }

        .popup-form .input-with-icon input {
            padding-right: 30px;
        }

        .popup-form .input-with-icon img {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        .popup-form .input-with-icon i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #666;
        }

        .popup-form textarea {
            resize: vertical;
            min-height: 80px;
        }

        .details-modal-content {
            padding: 25px;
        }

        .details-modal-content .detail-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #6e6d5533;
        }

        .details-modal-content .detail-item label {
            font-weight: 600;
            color: #A6A485;
            display: block;
            font-size: 14px;
        }

        .details-modal-content .detail-item p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #2A2916;
            font-weight: 500;
        }

        .details-modal-content .file-download-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 6px;
        }

        .details-modal-content .file-download-link span {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .details-modal-content .file-download-link i {
            color: #c62828;
        }

        .details-modal-content .download-icon {
            color: #c62828;
            border: 1px solid #00000030;
            padding: 5px 8px;
            border-radius: 5px;
            cursor: pointer;
        }

        .details-modal-footer {
            text-align: center;
            padding: 20px 25px 5px;
            box-shadow: 0px -8px 16px #00000029;
        }

        .btn-history {
            background-color: #fff;
            color: #c62828;
            border: 1px solid #c62828;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }

        .maintenance-history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .maintenance-history-item:last-child {
            border-bottom: none;
        }

        .maintenance-history-item .btn-download-report {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .input-file-wrapper {

            position: relative;
        }

        .btn-importer {
            border-radius: 0px 7px 7px 0px;
            position: absolute;
            right: 15px;
            bottom: 0px;
            transform: translate(15px, 5px);
            background-color: #A6A485;
            padding: 9px;
            color: white;
        }



        #equipementsTable,
        #reservationsTable {
            border: none !important;
            border-collapse: collapse;
            box-shadow: none !important;
        }

        #equipementsTable th,
        #reservationsTable th {
            border: 0px solid #EBE9D7;
        }

        #equipementsTable td,
        #reservationsTable td {
            border: 1px solid #EBE9D7;
        }

        #equipementsTable thead,
        #reservationsTable thead {
            border: none !important;
            position: static;
            transform: translateY(-15px);
        }

        #equipementsTable tbody tr:first-child td,
        #reservationsTable tbody tr:first-child td {
            border-top: 1px solid #EBE9D7 !important;
        }

        #equipementsTable,
        #reservationsTable {
            border-collapse: separate;
            border-spacing: 0;
        }

        #equipementsTable thead tr:first-child th:first-child,
        #reservationsTable thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        #equipementsTable thead tr:first-child th:last-child,
        #reservationsTable thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;

        }

        #equipementsTable tbody tr:last-child td:first-child,
        #reservationsTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #equipementsTable tbody tr:last-child td:last-child,
        #reservationsTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        #equipementsTable tbody tr:first-child td:first-child,
        #reservationsTable tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
        }

        #equipementsTable tbody tr:first-child td:last-child,
        #reservationsTable tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
        }
        button.btn-view-photo {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<?php
  // URL de la page "mon-labo" (adapter le slug si besoin)
  $mon_labo_url = esc_url( site_url('/mon-labo') );
?>

<div class="content-block">
  <div class="accordion-container">
    <!-- Tabs -->
    <div class="accordion-tabs">
      <button class="tab-btn active" data-tab="tab1">
        <img src="/wp-content/plugins/plateforme-master/imagesED/7050930.png" alt="Icon">
        <?php if (!in_array('um_chercheur', $roles)) { ?>
          Tableau Des Réservations  
        <?php } else { ?>
          Mes Réservations
        <?php } ?>
      </button>
      <?php if (!in_array('um_chercheur', $roles)) { ?>
        <button class="tab-btn" data-tab="tab2">
          <img src="/wp-content/plugins/plateforme-master/imagesED/10550857.png" alt="Icon">
          Mes Equipements
        </button>
      <?php } ?>
    </div>

    <div class="accordion-content">
      <!-- Tab 1: Reservations -->
      <div class="tab-panel active" id="tab1">
        <div class="table-controls">
          <div class="filter-selectgb">
            <div class="search-box">
              <i class="fa fa-search"></i>
              <input type="text" class="filter-input" id="reservationsSearch" placeholder="Recherchez...">
            </div>
            <select class="filter-select" id="statusFilter">
              <option value="">Statut</option>
              <option value="Validée">Validée</option>
              <option value="Refusée">Refusée</option>
              <option value="En attente">En attente</option>
            </select>
            <div class="date-input-container">
              <input type="text" id="dateFilter" class="date-input" placeholder="Filter by date...">
              <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">
            </div>
          </div>
          <div class="filter-actions">
            <button class="btn-statut" id="openReservationModal">Nouvelle réservation</button>
            <button class="icon-btn">
              <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png" alt="Icon-funnel">
            </button>
            <button class="icon-btn">
              <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="upload-red.png">
            </button>
          </div>
        </div>

        <table class="styled-table" id="reservationsTable">
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAllReservations"></th>
              <th>Catégorie</th>
              <th>Nom</th>
              <th>Réservé par</th>
              <th>Date</th>
              <th>Heure</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td>Salle</td>
              <td>Salle Réunion 1</td>
              <td>Dr. A. Mejri</td>
              <td>20/06/2025</td>
              <td>10:00 - 12:00</td>
              <td><span class="badge badge-success"><i class="fa-regular fa-circle-check" style="color: #198754;"></i>Validée</span></td>
              <td>
                <div class="actions">
                  <button class="action-btn">...</button>
                  <div class="dropdown-menu">
                    <a href="#" class="openModifierModal">Modifier</a>
                    <a href="#">Voir</a>
                    <a href="#">Annuler</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Équipement</td>
              <td>Microscope Électronique</td>
              <td>Y. Ben Salem</td>
              <td>15/07/2025</td>
              <td>13:30 - 14:00</td>
              <td><span class="badge badge-danger"><i class="fa-regular fa-circle-stop" style="color: #d71920;"></i>Refusée</span></td>
              <td>
                <div class="actions">
                  <button class="action-btn">...</button>
                  <div class="dropdown-menu">
                    <a href="#" class="openModifierModal">Modifier</a>
                    <a href="#">Voir</a>
                    <a href="#">Annuler</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Équipement</td>
              <td>Spectrophotomètre UV</td>
              <td>Dr. Leila Romdhane</td>
              <td>01/05/2025</td>
              <td>13:30 - 14:00</td>
              <td><span class="badge badge-warning"><i class="fa-regular fa-clock" style="color: #d89e00;"></i>En attente</span></td>
              <td>
                <div class="actions">
                  <button class="action-btn">...</button>
                  <div class="dropdown-menu">
                    <a href="#" class="openModifierModal">Modifier</a>
                    <a href="#">Voir</a>
                    <a href="#">Annuler</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Tab 2: Equipments -->
      <div class="tab-panel" id="tab2">
        <div class="table-controls">
          <div class="filter-selectgb">
            <select class="filter-select" id="categoryFilter"></select>
            <div class="filter-buttons">
              <button class="filter-btn active">Tous</button>
              <button class="filter-btn">Disponible</button>
              <button class="filter-btn">Non Disponible</button>
            </div>
          </div>
          <div class="filter-actions">
            <?php if (!in_array('um_chercheur', $roles)) { ?>
              <button class="btn-statut" id="openEquipementModal">Ajouter équipement</button>
            <?php } ?>
            <button class="icon-btn">
              <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png" alt="Icon-funnel">
            </button>
            <button class="icon-btn">
              <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="upload-red.png">
            </button>
          </div>
        </div>

        <!--
          NOTE IMPORTANTE :
          On ajoute l'attribut data-details-url pour donner au JS l'URL de base de redirection.
          Le JS remplacera l'ancienne icône (qui ouvrait une modale) par un lien <a> vers mon-labo.
        -->
        <table
          class="styled-table"
          id="equipementsTable"
          data-details-url="<?= $mon_labo_url ?>">
          <thead>
            <tr>
              <th><input type="checkbox" id="checkAllEquipements"></th>
              <th>Nom</th>
              <th>Catégorie</th>
              <th>Statut</th>
              <th>Disponibilité</th>
              <th>Dernier entretien</th>
              <th>Details</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!--
              Le rendu attendu pour la colonne "Details" d'une ligne avec ID = 42 :

              <a class="details-icon" href="<?= $mon_labo_url ?>?equipement_id=42" title="Voir les détails">
                <i class="fa fa-eye"></i>
              </a>

              (Le JS se chargera d'insérer ce <a> dynamiquement pour chaque ligne.)
            -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Nouvelle Reservation -->
<div class="modal-overlay" id="modalObjectifs" style="display: none;">
  <div class="popup-container" id="popupContainerObjectifs">
    <div class="popup-header">
      <h2>Nouvelle réservation</h2>
      <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="form-group">
        <label for="nom-equipement">Nom De L'équipement/Salle</label>
        <select id="nom-equipement">
          <option>Spectrophotomètre UV</option>
          <option>Microscope X</option>
          <option>Salle Réunion 1</option>
        </select>
      </div>
      <div class="date-time-group">
        <div class="form-group">
          <label for="date-reservation">Date</label>
          <div class="input-with-icon">
            <input type="text" id="date-reservation" value="" placeholder="11/01/2025">
            <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">
          </div>
        </div>
        <div class="form-group">
          <label for="heure-reservation">Heure De Début / Fin</label>
          <div class="input-with-icon">
            <input type="text" id="heure-reservation" placeholder="10:00 - 11:00">
            <i class="fa fa-clock"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="objectif-reservation">Objectif / motif de la réservation</label>
        <textarea id="objectif-reservation" placeholder="Objectif"></textarea>
      </div>
    </form>
  </div>
</div>

<!-- MODAL FOR MODIFIER (EDIT) RESERVATION -->
<div class="modal-overlay" id="modalModifierReservation" style="display: none;">
  <div class="popup-container">
    <div class="popup-header">
      <h2>Modifier la Réservation</h2>
      <button id="btnSaveReservationEdit" type="button" class="btn-enregistrer">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="form-group">
        <label for="modifier-nom-equipement">Nom De L'équipement/Salle</label>
        <input type="text" id="modifier-nom-equipement" readonly style="background-color: #f0f0f0;">
      </div>
      <div class="date-time-group">
        <div class="form-group">
          <label for="modifier-date-reservation">Date</label>
          <div class="input-with-icon">
            <input type="text" id="modifier-date-reservation" placeholder="jj/mm/aaaa">
            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">
          </div>
        </div>
        <div class="form-group">
          <label for="modifier-heure-reservation">Heure De Début / Fin</label>
          <div class="input-with-icon">
            <input type="text" id="modifier-heure-reservation" placeholder="10:00 - 11:00">
            <i class="fa fa-clock"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="modifier-objectif-reservation">Objectif / motif de la réservation</label>
        <textarea id="modifier-objectif-reservation" placeholder="Objectif"></textarea>
      </div>
    </form>
  </div>
</div>

<!-- MODAL FOR AJOUTER EQUIPEMENT -->
<div class="modal-overlay" id="modalAjouterEquipement" style="display: none;">
  <div class="popup-container" id="popupContainerEquipement">
    <div class="popup-header">
      <h2>Ajouter appareil</h2>
      <button class="btn-enregistrer" id="AddAppareil">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="form-group">
        <label>Catégorie Des Equipements</label>
        <select id="categorie_id" name="categorie_id">
          <option value="">Catégorie Des Equipements</option>
        </select>
      </div>
      <div class="form-group">
        <label>Nom de l'appareil</label>
        <input type="text" placeholder="Nom de l'appareil">
      </div>
      <div class="form-group">
        <label>Lieu</label>
        <input type="text" id="lieu" name="lieu" placeholder="Lieu de l'appareil">
      </div>
      <div class="form-group">
        <label>Images</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Importer des images..." readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" multiple accept="image/*" style="display: none;"></label>
        </div>
      </div>
      <div class="form-group">
        <label>Modèle</label>
        <input type="text" placeholder="Modèle">
      </div>
      <div class="form-group">
        <label>Spécification technique</label>
        <textarea></textarea>
      </div>
      <div class="form-group">
        <label>Statut</label>
        <select id="statut" name="statut">
          <option value="">Statut</option>
          <option value="fonctionnel">Fonctionnel</option>
          <option value="en_panne">En panne</option>
          <option value="en_maintenance">En maintenance</option>
          <option value="hors_service">Hors service</option>
        </select>
      </div>
      <div class="form-group">
        <label>Disponibilité</label>
        <select id="disponibilite_id" name="disponibilite_id">
          <option value="">Disponibilité</option>
        </select>
      </div>
      <div class="form-group">
        <label>Protocole d'utilisation</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Protocole d'utilisation" readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
      <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
      <div class="form-group">
        <label style="font-weight: bold; color: #333;">Conditions d'entretien :</label>
      </div>
      <div class="form-group">
        <label>Contrat</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Contrat" readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
      <div class="form-group">
        <label>Périodicité</label>
        <select id="periodicite" name="periodicite">
          <option value="">Périodicité</option>
          <option value="mensuelle">Mensuelle</option>
          <option value="trimestrielle">Trimestrielle</option>
          <option value="semestrielle">Semestrielle</option>
          <option value="annuelle">Annuelle</option>
          <option value="a_la_demande">À la demande</option>
        </select>
      </div>
      <div class="form-group">
        <label>Consignes</label>
        <input type="text" placeholder="Consignes">
      </div>
    </form>
  </div>
</div>

<!-- MODAL FOR MODIFIER (EDIT) EQUIPEMENT -->
<div class="modal-overlay" id="modalModifierEquipement" style="display: none;">
  <div class="popup-container" id="popupContainerModifierEquipement">
    <div class="popup-header">
      <h2>Modifier l'équipement</h2>
      <button class="btn-enregistrer">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="form-group">
        <label for="modifier-categorie-equipement">Catégorie Des Equipements</label>
        <select id="modifier-categorie-equipement"></select>
      </div>
      <div class="form-group">
        <label for="modifier-nom-appareil">Nom de l'appareil</label>
        <input type="text" id="modifier-nom-appareil" placeholder="Nom de l'appareil">
      </div>
      <div class="form-group">
        <label for="modifier-lieu">Lieu</label>
        <input type="text" id="modifier-lieu" placeholder="Lieu de l'appareil">
      </div>
      <div class="form-group">
        <label>Images</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Importer des images..." readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" multiple accept="image/*" style="display: none;"></label>
        </div>
        <div class="existing-images" style="margin-top: 10px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
      </div>
      <div class="form-group">
        <label for="modifier-modele-appareil">Modèle</label>
        <input type="text" id="modifier-modele-appareil" placeholder="Modèle">
      </div>
      <div class="form-group">
        <label for="modifier-spec-tech">Spécification technique</label>
        <textarea id="modifier-spec-tech"></textarea>
      </div>
      <div class="form-group">
        <label for="modifier-statut-appareil">Statut</label>
        <select id="modifier-statut-appareil">
          <option value="">Statut</option>
          <option value="fonctionnel">Fonctionnel</option>
          <option value="en_panne">En panne</option>
          <option value="en_maintenance">En maintenance</option>
          <option value="hors_service">Hors service</option>
        </select>
      </div>
      <div class="form-group">
        <label for="modifier-disponibilite-appareil">Disponibilité</label>
        <select id="modifier-disponibilite-appareil"></select>
      </div>
      <div class="form-group">
        <label>Protocole d'utilisation</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Protocole d'utilisation" readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
      <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
      <div class="form-group">
        <label style="font-weight: bold; color: #333;">Conditions d'entretien :</label>
      </div>
      <div class="form-group">
        <label>Contrat</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Contrat" readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="modifier-periodicite">Périodicité</label>
        <select id="modifier-periodicite">
          <option value="">Périodicité</option>
          <option value="mensuelle">Mensuelle</option>
          <option value="trimestrielle">Trimestrielle</option>
          <option value="semestrielle">Semestrielle</option>
          <option value="annuelle">Annuelle</option>
          <option value="a_la_demande">À la demande</option>
        </select>
      </div>
      <div class="form-group">
        <label for="modifier-consignes">Consignes</label>
        <input type="text" id="modifier-consignes" placeholder="Consignes">
      </div>
    </form>
  </div>
</div>

<!-- MODAL FOR MAINTENANCE -->
<div class="modal-overlay" id="modalMaintenance" style="display: none;">
  <div class="popup-container" id="popupContainerMaintenance">
    <div class="popup-header">
      <h2>Demande de maintenance</h2>
      <button class="btn-enregistrer">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="form-group">
        <label>Équipement</label>
        <input type="text" placeholder="Spectrophotomètre UV" readonly style="background-color: #f0f0f0;">
      </div>
      <div class="form-group">
        <label>Type De Maintenance</label>
        <select>
          <option>Type</option>
        </select>
      </div>
      <div class="form-group">
        <label>Motif</label>
        <textarea></textarea>
      </div>
      <div class="form-group">
        <label>Motif</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Fiche attaché" readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
      <div class="form-group">
        <label>Photo de l'équipement</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" placeholder="Importer les photos..." readonly>
          <label class="btn-importer"><i class="fa fa-upload"></i> Importer <input type="file" style="display: none;"></label>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- MODAL FOR DETAILS APPAREIL -->
<div class="modal-overlay" id="modalDetailsAppareil" style="display: none;">
  <div class="popup-container" id="popupContainerDetailsAppareil">
    <div class="popup-header">
      <h2>Details appareil</h2>
      <button class="btn-close-x">X</button>
    </div>
    <div class="details-modal-content">
      <div class="detail-item">
        <label>Categorie :</label>
      </div>
      <div class="detail-item">
        <label>Nom de l'appareil :</label>
      </div>
      <div class="detail-item">
        <label>Modèle :</label>
      </div>
      <div class="detail-item">
        <label>Spécification technique :</label>
      </div>
      <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
      <div class="detail-item">
        <label>Conditions d'entretien :</label>
      </div>
      <div class="detail-item">
        <label>Statut :</label>
      </div>
      <div class="detail-item">
        <label>Disponibilité :</label>
      </div>
      <div class="detail-item">
        <label>Protocole d'utilisation :</label>
        <div class="file-download-link">
          <span><i class="fa fa-file-pdf"></i> Protocole.Pdf</span>
          <img width="20px" class="download-icon" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="upload-red.png">
        </div>
      </div>
      <div class="detail-item">
        <label>Contrat :</label>
        <div class="file-download-link">
          <span><i class="fa fa-file-pdf"></i> Contrat.Pdf</span>
          <img width="20px" class="download-icon" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="upload-red.png">
        </div>
      </div>
      <div class="detail-item">
        <label>Périodicité :</label>
      </div>
      <div class="detail-item">
        <label>Consignes :</label>
      </div>
    </div>
    <div class="details-modal-footer">
      <button class="btn-history openHistoryModal"><i class="fa fa-wrench"></i> Historique des maintenances</button>
    </div>
  </div>
</div>

<!-- MODAL FOR HISTORIQUE -->
<div class="modal-overlay" id="modalHistorique" style="display: none;">
  <div class="popup-container" id="popupContainerHistorique">
    <div class="popup-header">
      <h2><i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 15px;"></i>Historique des maintenances</h2>
      <button class="btn-close-x">X</button>
    </div>
    <div class="details-modal-content">
      <!-- Maintenance history items to be populated dynamically -->
    </div>
  </div>
</div>



    <!-- jQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable for the reservations table
            var reservationsTable = $('#reservationsTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 't<"bottom"p>',
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    },
                    emptyTable: "Aucune donnée disponible",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                },
                columnDefs: [{
                    "orderable": false,
                    "targets": [0, 7]
                }]
            });

            // Custom search for reservations table
            $('#reservationsSearch').on('keyup', function () {
                reservationsTable.search(this.value).draw();
            });

            /*************** CHARGEMENT PAR DÉFAUT — reservationsTable ***************/
function _inferTypeFromLabel(label='') {
  const s = String(label).toLowerCase();
  // heuristique simple : "salle", "amphi", "auditorium" => Salle, sinon Équipement
  return (s.startsWith('salle') || s.includes('amphi') || s.includes('auditorium')) ? 'Salle' : 'Équipement';
}
function _statusBadge(statut='') {
  const s = String(statut).toLowerCase();
  if (s === 'validee')  return `<span class="badge badge-success"><i class="fa-regular fa-circle-check"></i> Validée</span>`;
  if (s === 'refusee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> Refusée</span>`;
  if (s === 'annulee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> Annulée</span>`;
  return `<span class="badge badge-warning"><i class="fa-regular fa-clock"></i> En attente</span>`;
}
function _fmtDateFR(yyyy_mm_dd='') {
  if (!yyyy_mm_dd) return '—';
  const [y,m,d] = yyyy_mm_dd.split('-'); return `${d}/${m}/${y}`;
}
function _fmtRange(h1='', h2='') {
  const a = (h1||'').slice(0,5), b = (h2||'').slice(0,5);
  return (a && b) ? `${a} - ${b}` : '—';
}
async function _fetchReservationsDefault() {
  const url = `${REST_BASE}/plateforme-directeurderecherche/v1/reservation?mine=1&per_page=200`;
  return getJSON(url); // tu as déjà getJSON au-dessus
}

/* ====== Helpers d'affichage (réservations) ====== */
function frType(categorie) {
  return String(categorie);
}
function frStatut(s) {
  const v = String(s || '').toLowerCase();
  if (v === 'validee')  return 'Validée';
  if (v === 'refusee')  return 'Refusée';
  if (v === 'annulee')  return 'Annulée';
  return 'En attente';
}
function statusBadgeFR(s) {
  const lbl = frStatut(s);
  const v = String(s || '').toLowerCase();
  if (v === 'validee')  return `<span class="badge badge-success"><i class="fa-regular fa-circle-check"></i> ${lbl}</span>`;
  if (v === 'refusee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> ${lbl}</span>`;
  if (v === 'annulee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> ${lbl}</span>`;
  return `<span class="badge badge-warning"><i class="fa-regular fa-clock"></i> ${lbl}</span>`;
}
function fmtFRdate(d){ if(!d) return '—'; const [y,m,dd]=(d||'').split('-'); return `${dd}/${m}/${y}`; }
function fmtRange(h1,h2){ const a=(h1||'').slice(0,5), b=(h2||'').slice(0,5); return (a&&b)?`${a} - ${b}`:'—'; }
function isOwnerReservation(r){
  return Number(r.equip_owner_id) === Number(window.PMSettings?.userId || 0);
}
function isPendingReservation(r){
  return String(r.statut || '').toLowerCase() === 'en_attente';
}
function renderReservationActions(r){
  const id = escAttr(r.id);
  const ownerId = r.equip_owner_id;
  const isOwner = isOwnerReservation(r);
  const isPending = isPendingReservation(r);

  // Lien "Modifier" disponible pour tous (tu peux le restreindre si besoin)
  const items = [
    `<a href="#" class="openModifierModal" data-id="${id}"><i class="fa fa-edit"></i> Modifier</a>`
  ];

  // Menu owner-only
  if (isOwner) {
    // Valider/Refuser uniquement si "en_attente"
    const disAttr = isPending ? '' : ' data-disabled="1"';
    items.unshift(
      `<a href="#" class="res-approve" data-id="${id}" data-owner="${ownerId}"${disAttr}><i class="fa fa-check"></i> Valider</a>`,
      `<a href="#" class="res-reject"  data-id="${id}" data-owner="${ownerId}"${disAttr}><i class="fa fa-ban"></i> Refuser</a>`
    );
    // Annuler : autorisé pour owner (même si validée), adapte si besoin
    items.push(
      `<a href="#" class="res-cancel"  data-id="${id}" data-owner="${ownerId}" style="color:#BF0404;"><i class="fa fa-times"></i> Annuler</a>`
    );
  }

  return `
    <div class="actions">
      <button class="action-btn" type="button" aria-haspopup="true" aria-expanded="false">...</button>
      <div class="dropdown-menu">
        ${items.join('')}
      </div>
    </div>
  `;
}

/* ====== CHARGEMENT PAR DÉFAUT — reservationsTable ====== */
async function reloadReservations() {
  try {
    // Mes réservations (créées par l'utilisateur connecté)
    const rows = await fetchReservations({ mine: 1, per_page: 200 });

    const dt = $('#reservationsTable').DataTable();
    dt.clear();

    (rows || []).forEach(r => {
      // Type : à partir de r.categorie (équipement/salle)
      const typeTxt = frType(r.equip_categorie_label);

      // Nom : utiliser les colonnes jointes (equip_nom / equip_modele), sinon fallback resource_label / id
      const nomTxt =
        (r.equip_nom ? `${r.equip_nom}${r.equip_modele ? ' – ' + r.equip_modele : ''}` :
         (r.resource_label && r.resource_label !== '0' ? r.resource_label : `#${r.resource_id}`));

      // Réservé par : first_name + last_name > display_name > #created_by
      const whoTxt =
        (r.reserver_first_name || r.reserver_last_name)
          ? `${r.reserver_first_name || ''} ${r.reserver_last_name || ''}`.trim()
          : (r.reserver_display_name || `#${r.created_by}`);

      // Date / Heure / Statut
      const dateTxt  = fmtFRdate(r.date_reservation);
      const heureTxt = fmtRange(r.heure_debut, r.heure_fin);
      const statutTd = statusBadgeFR(r.statut);

      dt.row.add([
        `<input type="checkbox" class="row-check" data-id="${r.id}">`,
        typeTxt,
        esc(nomTxt),
        esc(whoTxt),
        dateTxt,
        heureTxt,
        statutTd,
       renderReservationActions(r) // ← ICI le menu conditionnel
      ]);
    });

    dt.draw(false);

  } catch (e) {
    console.error('[reloadReservations]', e);
    window.toast?.('Erreur chargement des réservations', true) || alert('Erreur chargement des réservations');
  }
}


/* Bind “Annuler” (statut → annulee) */
$(document)
  .off('click.res.cancelRow','a.res-cancel')
  .on('click.res.cancelRow','a.res-cancel', async function(e){
    e.preventDefault();
    const id = $(this).data('id');
    if (!id) return;
    if (!confirm('Annuler cette réservation ?')) return;
    try {
      await fetch(`${REST_BASE}/plateforme-directeurderecherche/v1/reservation/${id}`,{
        method:'PATCH',
        headers: HEADERS_JSON,
        credentials:'include',
        body: JSON.stringify({ statut:'annulee' })
      }).then(r=>{ if(!r.ok) throw new Error('PATCH '+r.status); });
      window.toast?.('Réservation annulée') || alert('Réservation annulée');
      reloadReservations();
    } catch(err) {
      console.error(err);
      window.toast?.('Échec annulation', true) || alert('Échec annulation');
    }
  });

    /* Charger par défaut au démarrage */
    reloadReservations();


            // Status filter for reservations table
            $('#statusFilter').on('change', function () {
                var status = $(this).val();
                if (status) {
                    // The search will look for the text inside the span
                    reservationsTable.column(6).search(status).draw();
                } else {
                    reservationsTable.column(6).search('').draw();
                }
            });

            // Date filter for reservations table (more flexible search)
            $('#dateFilter').on('keyup', function () {
                reservationsTable.column(4).search(this.value).draw();
            });


            // "Check all" functionality for reservations table
            $("#checkAllReservations").on("click", function () {
                var rows = reservationsTable.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle individual checkbox clicks to uncheck "check all"
            $('#reservationsTable tbody').on('change', 'input[type="checkbox"]', function () {
                if (!this.checked) {
                    var el = $('#checkAllReservations').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });


            // Initialize DataTable for the equipments table
            var equipementsTable = $('#equipementsTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 't<"bottom"p>',
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    },
                    emptyTable: "Aucune donnée disponible",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                },
                columnDefs: [{
                    "orderable": false,
                    "targets": [0, 6, 7]
                }]
            });

            // Category filter for equipments table
            $('#categoryFilter').on('change', function () {
                var category = $(this).val();
                equipementsTable.column(2).search(category).draw();
            });

            // Filter button logic for Equipments table
            $('.filter-buttons .filter-btn').on('click', function () {
                $('.filter-buttons .filter-btn').removeClass('active');
                $(this).addClass('active');

                var filterValue = $(this).text().trim(); // "Tous", "Disponibles", "Réservés"

                if (filterValue === "Tous") {
                    equipementsTable.column(4).search('').draw();
                } else if (filterValue === "Disponible") {
                    equipementsTable.column(4).search("Disponible").draw();
                } else if (filterValue === "Non Disponible") {
                    equipementsTable.column(4).search("Non Disponible").draw();

                }
            });

            // "Check all" functionality for equipments table
            $("#checkAllEquipements").on("click", function () {
                var rows = equipementsTable.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle individual checkbox clicks to uncheck "check all" for equipments
            $('#equipementsTable tbody').on('change', 'input[type="checkbox"]', function () {
                if (!this.checked) {
                    var el = $('#checkAllEquipements').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });


            // Tab switching logic
            $('.tab-btn').on('click', function () {
                const tabId = $(this).data('tab');
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');
                $('.tab-panel').removeClass('active');
                $('#' + tabId).addClass('active');
            });

            // Dropdown menu logic for both tables
            $(document).on('click', '.action-btn', function (e) {
                e.stopPropagation();
                let dropdown = $(this).closest('.actions').find('.dropdown-menu');
                $('.dropdown-menu').not(dropdown).hide(); // Hide other menus
                dropdown.toggle(); // Toggle current menu
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function () {
                $('.dropdown-menu').hide();
            });

            // Open reservation modal
            $('#openReservationModal').on('click', function () {
                openmodalObjectifs();
            });

            // Open and populate Modifier Reservation modal
            $(document).on('click', '.openModifierModal', function (e) {
                e.preventDefault();

                // Get data from the table row
                var row = $(this).closest('tr');
                var type = row.find('td:eq(1)').text();
                var nom = row.find('td:eq(2)').text();
                var date = row.find('td:eq(4)').text();
                var heure = row.find('td:eq(5)').text();

                // Populate the modal fields
             
                $('#modifier-nom-equipement').val(nom);
                $('#modifier-date-reservation').val(date);
                $('#modifier-heure-reservation').val(heure);

                // Open the modal
                openModalModifierReservation();
            });


            // Open equipement modal
            $('#openEquipementModal').on('click', function () {
                openModalAjouterEquipement();
            });

            // --- NEW --- Open and populate Modifier Equipement modal
            $(document)
            .off('click.openEditEquip')
            .on('click.openEditEquip', '.openModifierEquipementModal', async function (e) {
                e.preventDefault();

                // 1) Récupérer l'ID de l'équipement depuis le bouton ou la ligne
                const id =
                $(this).data('id') ||
                $(this).closest('tr').find('.row-check').data('id') ||
                $(this).closest('tr').find('.openDetailsModal').data('id');

                if (!id) {
                console.error('[openModifierEquipementModal] id manquant');
                window.toast?.("ID d'équipement introuvable", true) || alert("ID d'équipement introuvable");
                return;
                }

                try {
                // 2) Ouvrir la modale d'édition AVEC préréglage de TOUS les champs
                await openModifierEquipementModal(id);
                } catch (err) {
                console.error(err);
                window.toast?.('Impossible de charger les données', true) || alert('Impossible de charger les données');
                }
            });

       async function openModifierEquipementModal(id){
    // 1) Assurer les listes (catégories + disponibilités) puis injecter dans les selects de la modale
    await loadEquipementLookups();

    // 2) Charger toutes les données de l'équipement
    const equip = await fetchEquipementById(id);
    const [protoUrl, entretien] = await Promise.all([
        fetchProtocoleByEquip(id).catch(()=>''),     // URL dernier protocole
        fetchEntretienByEquip(id).catch(()=>null)    // { periodicite, consignes, fichier_contrat }
    ]);

    const $m = $('#modalModifierEquipement').data('equip-id', id);

    // 3) Préremplir TOUS les champs (par ID, pas par texte)
    $('#modifier-categorie-equipement').val(String(equip.categorie_id || ''));
    $('#modifier-nom-appareil').val(equip.nom_appareil || '');
    $('#modifier-modele-appareil').val(equip.modele || '');
    $('#modifier-spec-tech').val(equip.spcification_technique || '');
    $('#modifier-statut-appareil').val(equip.statut || '');
    $('#modifier-disponibilite-appareil').val(String(equip.disponibilite_id || ''));

    // 4) Miroirs des fichiers existants (afficher le nom)
    const basename = (url)=>{ try{ return decodeURIComponent(new URL(url, location.origin).pathname.split('/').pop()||''); }catch{return (url||'').split('/').pop()||'';} };
    const $protoText = $m.find('.input-file-text[placeholder="Protocole d\'utilisation"]');
    const $contrText = $m.find('.input-file-text[placeholder="Contrat"]');
    $protoText.val(protoUrl ? basename(protoUrl) : '');
    $contrText.val(entretien?.fichier_contrat ? basename(entretien.fichier_contrat) : '');

    // Préremplir lieu
    $('#modifier-lieu').val(equip.lieu || ''); // Si lieu existe dans equip (après ajout backend)

    // Images existantes (commenté car pas de table images encore ; assume equip.images = ["url1", "url2"])
    /*
    const $existing = $('#modalModifierEquipement .existing-images');
    $existing.empty();
    (equip.images || []).forEach(url => {
        const img = `<img src="${escAttr(url)}" alt="Image existante" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" onclick="window.open('${escAttr(url)}', '_blank')">`;
        $existing.append(img);
    });
    */

    // 5) Miroir en cas de nouveau fichier choisi
    $m.find('.input-file-wrapper input[type="file"]').off('change.mirror').on('change.mirror', function(){
        const name = this.files?.[0]?.name || '';
        $(this).closest('.input-file-wrapper').find('.input-file-text').val(name);
    });

    // 6) Ouvrir la modale
    $m.css('display','flex');
}



            // Open maintenance modal
            $(document).on('click', '.openMaintenanceModal', function (e) {
                e.preventDefault();
                openModalMaintenance();
            });

            // Open details modal
            $(document).on('click', '.openDetailsModal', function () {
                openModalDetailsAppareil();
            });

            // Open history modal from details modal
            $(document).on('click', '.openHistoryModal', function () {
                $('#modalDetailsAppareil').hide();
                openModalHistorique();
            });

            // Back arrow in history modal to return to details modal
            $('#modalHistorique .fa-arrow-left').on('click', function () {
                $('#modalHistorique').hide();
                openModalDetailsAppareil();
            });

            // Generic modal close logic
            $('.modal-overlay').on('click', function (e) {
                if ($(e.target).is('.modal-overlay')) {
                    $(this).hide();
                }
            });
            $('.btn-close-x').on('click', function () {
                $(this).closest('.modal-overlay').hide();
            });

        });

        function openmodalObjectifs() {
            $('#modalObjectifs').css('display', 'flex');
        }

        function openModalModifierReservation() {
            $('#modalModifierReservation').css('display', 'flex');
        }

        function openModalAjouterEquipement() {
            $('#modalAjouterEquipement').css('display', 'flex');
        }

        // --- NEW --- Function to open the modifier equipement modal
        function openModalModifierEquipement() {
            $('#modalModifierEquipement').css('display', 'flex');
        }

        function openModalMaintenance() {
            $('#modalMaintenance').css('display', 'flex');
        }

        function openModalDetailsAppareil() {
            $('#modalDetailsAppareil').css('display', 'flex');
        }

        function openModalHistorique() {
            $('#modalHistorique').css('display', 'flex');
        }
    </script>






<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? '';
$user_id = get_current_user_id();

?>
<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js( $role ) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>

<script>
    // Helpers
 async function wpFetchJson(url) {
  const res = await fetch(url, {
    headers: {
      'X-WP-Nonce': PMSettings?.nonce || '',
      'Accept': 'application/json'
    },
    credentials: 'include'
  });
  if (!res.ok) throw new Error('API ' + url + ' → ' + res.status);
  return await res.json();
}

function fillSelect(sel, items, placeholder) {
  if (!sel) return;
  sel.innerHTML = ''; // reset
  const opt0 = document.createElement('option');
  opt0.value = '';
  opt0.textContent = placeholder || '—';
  sel.appendChild(opt0);
  (items || []).forEach(it => {
    const opt = document.createElement('option');
    opt.value = it.id;                // on stocke l'id
    opt.dataset.code = it.code || ''; // utile si besoin du code
    opt.textContent = it.intitule || it.code || ('#' + it.id);
    sel.appendChild(opt);
  });
}

// Helper: conserve la sélection courante si possible
function fillSelectWithPreserve(sel, items, placeholder, preserve = true) {
  if (!sel) return;
  const current = preserve ? sel.value : '';
  fillSelect(sel, items, placeholder);
  if (preserve && current) {
    const has = Array.from(sel.options).some(o => String(o.value) === String(current));
    if (has) sel.value = current;
  }
}


// Helper pour le select de filtre (valeur = libellé, pratique pour la recherche DataTables)
function fillCategoryFilterWithPreserve(sel, items, placeholder = 'Catégorie', preserve = true) {
  if (!sel) return;
  const current = preserve ? sel.value : '';
  sel.innerHTML = '';
  sel.append(new Option(placeholder, ''));
  (items || []).forEach(it => {
    // value = intitule (pour que ton code de filtre existant continue à marcher)
    sel.append(new Option(it.intitule || it.code || ('#' + it.id), it.intitule || ''));
  });
  if (preserve && current) {
    const has = Array.from(sel.options).some(o => String(o.value) === String(current));
    if (has) sel.value = current;
  }
}

// Charge Catégories & Disponibilités (add + edit + filtre)
async function loadEquipementLookups() {
  try {
    const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
    const [cats, dispos] = await Promise.all([
      wpFetchJson(`${base}/plateforme-directeurderecherche/v1/categories-equipements`),
      wpFetchJson(`${base}/plateforme-directeurderecherche/v1/disponibilites-equipements`)
    ]);

    // cache global
    window._EQUIP_CATS = cats;
    window._EQUIP_DISPOS = dispos;

    // --- Formulaire d'ajout ---
    fillSelect(document.getElementById('categorie_id'), cats, 'Catégorie Des Equipements');
    fillSelect(document.getElementById('disponibilite_id'), dispos, 'Disponibilité');

    // --- Formulaire d'édition (préserver la sélection si déjà posée) ---
    fillSelectWithPreserve(document.getElementById('modifier-categorie-equipement'), cats, 'Catégorie Des Equipements', true);
    fillSelectWithPreserve(document.getElementById('modifier-disponibilite-appareil'), dispos, 'Disponibilité', true);

    // --- Select de filtre (sidebar au-dessus du tableau) ---
    fillCategoryFilterWithPreserve(document.getElementById('categoryFilter'), cats, 'Catégorie', true);

  } catch (e) {
    console.error('[loadEquipementLookups]', e);
    window.toast?.('Erreur chargement listes: ' + e.message, true);
  }
}


// Lance au moment d’ouvrir la modale
document.addEventListener('DOMContentLoaded', () => {
  // si la modale est déjà dans le DOM :
  loadEquipementLookups();
});



// ---------------------- CONFIG REST ----------------------
const REST_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/, ''); // ex: "/wp-json"
const HEADERS_JSON = {
  'X-WP-Nonce': window.PMSettings?.nonce || '',
  'Accept': 'application/json',
  'Content-Type': 'application/json'
};
const HEADERS_UPLOAD = {
  'X-WP-Nonce': window.PMSettings?.nonce || '',
  'Accept': 'application/json'
};

// ---------------------- HELPERS ----------------------
async function postJSON(endpoint, data) {
  const res = await fetch(`${REST_BASE}${endpoint}`, {
    method: 'POST',
    headers: HEADERS_JSON,
    credentials: 'include',
    body: JSON.stringify(data)
  });
  if (!res.ok) {
    const msg = await res.text().catch(()=>res.statusText);
    throw new Error(`POST ${endpoint} → ${res.status} ${msg}`);
  }
  return res.json();
}
// ---- helpers spécifiques edit ----
function basenameFromUrl(url=''){
  try { return decodeURIComponent(new URL(url, location.origin).pathname.split('/').pop() || ''); }
  catch { return (url || '').split('/').pop() || ''; }
}
function $modalEdit(){ return $('#modalModifierEquipement'); }
function $wrapEdit(){ return $('#modalModifierEquipement .popup-form'); }

// API liées (si routes actives côté PHP)
async function postEquipementProtocole(equipementId, fichierUrl){
  return postJSON('/plateforme-directeurderecherche/v1/equipement_protocole', {
    id_recherche_equipement: parseInt(equipementId,10),
    fichier: String(fichierUrl||'')
  });
}
async function postConditionsEntretien(equipementId, {periodicite, consignes, fichier_contrat}){
  return postJSON('/plateforme-directeurderecherche/v1/conditions_entretien', {
    id_recherche_equipement: parseInt(equipementId,10),
    periodicite: String(periodicite||''),
    consignes: String(consignes||''),
    fichier_contrat: String(fichier_contrat||'')
  });
}
// Upload d'un fichier vers /wp/v2/media, renvoie l'URL (source_url)
async function uploadMedia(file, title = '') {
  if (!file) return '';
  const url = `${REST_BASE}/wp/v2/media?title=${encodeURIComponent(title || file.name)}`;
  const res = await fetch(url, {
    method: 'POST',
    headers: {
      ...HEADERS_UPLOAD,
      'Content-Disposition': `attachment; filename="${file.name}"`,
      'Content-Type': file.type || 'application/octet-stream'
    },
    credentials: 'include',
    body: file
  });
  if (!res.ok) {
    const msg = await res.text().catch(()=>res.statusText);
    throw new Error(`UPLOAD ${file.name} → ${res.status} ${msg}`);
  }
  const j = await res.json();
  return j?.source_url || '';
}

// ------- NEW: reset + close helpers -------
function resetEquipementForm() {
  const form = document.querySelector('#modalAjouterEquipement .popup-form');
  if (!form) return;
  // Reset standard
  form.reset();
  // Vider les champs miroirs pour les fichiers
  form.querySelectorAll('.input-file-text').forEach(el => { el.value = ''; });
  // Par sécurité, vider explicitement les <input type="file">
  form.querySelectorAll('input[type="file"]').forEach(f => { try { f.value = ''; } catch(_){} });
  // Remettre les selects sur la première option
  ['categorie_id','disponibilite_id','statut','periodicite'].forEach(id=>{
    const sel = form.querySelector(`#${id}`);
    if (sel) sel.selectedIndex = 0;
  });
}

function closeModalAjouterEquipement() {
  const modal = document.getElementById('modalAjouterEquipement');
  if (modal) modal.style.display = 'none';
  // Optionnel: enlever une éventuelle classe d’ouverture sur <body>
  document.body.classList.remove('modal-open');
}

// Récupération des valeurs du formulaire (par placeholders/id)
function getEquipementFormValues() {
    const form = document.querySelector('#modalAjouterEquipement .popup-form');
    if (!form) throw new Error('Formulaire introuvable');

    const categorie_id     = parseInt(document.getElementById('categorie_id')?.value || '', 10) || 0;
    const disponibilite_id = parseInt(document.getElementById('disponibilite_id')?.value || '', 10) || 0;
    const statut           = document.getElementById('statut')?.value || '';

    const nom_appareil = form.querySelector('input[placeholder="Nom de l\'appareil"]')?.value?.trim() || '';
    const modele       = form.querySelector('input[placeholder="Modèle"]')?.value?.trim() || '';
    const spcification_technique = form.querySelector('textarea')?.value?.trim() || '';

    // Files (depuis le champ texte miroir)
    const protoText = form.querySelector('.input-file-text[placeholder="Protocole d\'utilisation"]');
    const protocoleFile = protoText
        ? protoText.closest('.input-file-wrapper')?.querySelector('label input[type="file"]')?.files?.[0] || null
        : null;

    const contratText = form.querySelector('.input-file-text[placeholder="Contrat"]');
    const contratFile = contratText
        ? contratText.closest('.input-file-wrapper')?.querySelector('label input[type="file"]')?.files?.[0] || null
        : null;

    const periodicite = document.getElementById('periodicite')?.value || '';
    const consignes   = form.querySelector('input[placeholder="Consignes"]')?.value?.trim() || '';

    const lieu = form.querySelector('input[placeholder="Lieu de l\'appareil"]')?.value?.trim() || '';

    // Images multiples
    const imagesText = form.querySelector('.input-file-text[placeholder="Importer des images..."]');
    const imagesFiles = imagesText
        ? imagesText.closest('.input-file-wrapper')?.querySelector('label input[type="file"][multiple]')?.files || []
        : [];

    return {
        categorie_id, disponibilite_id, statut,
        nom_appareil, modele, spcification_technique,
        protocoleFile, contratFile,
        periodicite, consignes,
        lieu,
        imagesFiles: Array.from(imagesFiles) // Convertir en array pour boucle
    };
}
function validateEquipement(v) {
  const errors = [];
  if (!v.categorie_id) errors.push('Catégorie');
  if (!v.nom_appareil) errors.push('Nom de l’appareil');
  if (!v.modele) errors.push('Modèle');
  if (!v.statut) errors.push('Statut');
  if (!v.disponibilite_id) errors.push('Disponibilité');
  return errors;
}

// ---------------------- CREATE FLOW ----------------------
async function createEquipement() {
    const btn = document.querySelector('#popupContainerEquipement .btn-enregistrer');
    const loaderOn  = () => { if (btn) { btn.disabled = true; btn.dataset._txt = btn.textContent; btn.textContent = 'Enregistrement…'; } };
    const loaderOff = () => { if (btn) { btn.disabled = false; btn.textContent = btn.dataset._txt || 'Enregistrer'; } };

    try {
        const v = getEquipementFormValues();
        const errors = validateEquipement(v);
        if (errors.length) throw new Error('Champs requis : ' + errors.join(', '));

        loaderOn();

        // 1) Upload des fichiers si fournis
        const protocole_url = await uploadMedia(v.protocoleFile, `Protocole - ${v.nom_appareil}`).catch(e => {
            console.error('Upload protocole échoué:', e); return '';
        });
        const contrat_url   = await uploadMedia(v.contratFile, `Contrat - ${v.nom_appareil}`).catch(e => {
            console.error('Upload contrat échoué:', e); return '';
        });

        // Upload des images multiples
        const imagesUrls = [];
        for (const file of v.imagesFiles) {
            const url = await uploadMedia(file, `Image - ${v.nom_appareil || 'Equipement'}`).catch(e => {
                console.error('Upload image échoué:', e); return '';
            });
            if (url) imagesUrls.push(url);
        }

        // 2) Création de l’équipement + champs liés
        const payload = {
            categorie_id: v.categorie_id,
            disponibilite_id: v.disponibilite_id,
            modele: v.modele,
            nom_appareil: v.nom_appareil,
            statut: v.statut,
            spcification_technique: v.spcification_technique,
            protocole_fichier: protocole_url,
            contrat_fichier:   contrat_url,
            periodicite:       v.periodicite,
            consignes:         v.consignes,
            lieu: v.lieu,
            images: imagesUrls
        };

        const created = await postJSON('/plateforme-directeurderecherche/v1/equipement', payload);

        // ✅ Succès : toast + reset + fermeture + refresh liste si dispo
        window.toast?.('Appareil créé avec succès', false) || alert('Appareil créé');
        resetEquipementForm();
        closeModalAjouterEquipement();
        if (typeof window.reloadEquipements === 'function') window.reloadEquipements();

        return created;
    } catch (e) {
        console.error('[createEquipement]', e);
        window.toast?.(e.message || 'Échec création', true) || alert(e.message || 'Échec création');
        throw e;
    } finally {
        loaderOff();
    }
}
// ---------------------- UI BINDINGS ----------------------
document.addEventListener('DOMContentLoaded', () => {
  // Bouton Enregistrer
  const btn = document.querySelector('#popupContainerEquipement .btn-enregistrer');
  if (btn) btn.addEventListener('click', (e) => { e.preventDefault(); createEquipement(); });

  // Affichage du nom des fichiers choisis
  document.querySelectorAll('#modalAjouterEquipement .input-file-wrapper').forEach(w => {
    const file = w.querySelector('label input[type="file"]');
    const text = w.querySelector('.input-file-text');
    if (file && text) {
      file.addEventListener('change', () => { text.value = file.files?.[0]?.name || ''; });
    }
  });
});
// Miroir pour le champ Images (multiple) dans AJOUT et ÉDITION
$(document).on('change', '.input-file-wrapper input[type="file"][multiple]', function() {
    const files = this.files;
    const $text = $(this).closest('.input-file-wrapper').find('.input-file-text');
    if (files && files.length > 0) {
        if (files.length === 1) {
            $text.val(files[0].name); // Nom du fichier si un seul
        } else {
            $text.val(`${files.length} images sélectionnées`); // Compteur si multiple
        }
    } else {
        $text.val('');
    }
});

// ========== CONFIG ==========
const AUTH_HEADERS = {                         // <- manquant chez toi
  'X-WP-Nonce': window.PMSettings?.nonce || '',
  'Accept': 'application/json'
};

// ========== HELPERS ==========
async function getJSON(url) {
  const res = await fetch(url, { headers: AUTH_HEADERS, credentials:'include' });
  if (!res.ok) throw new Error(`${url} → ${res.status}`);
  return res.json();
}
function esc(s=''){ return String(s).replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;', "'":'&#39;' }[m])); }
function fmtDate(d) {
  if(!d) return '—';
  const dt = new Date(String(d).replace(' ', 'T'));
  if (isNaN(dt)) return d;
  const dd = String(dt.getDate()).padStart(2,'0');
  const mm = String(dt.getMonth()+1).padStart(2,'0');
  const yy = dt.getFullYear();
  return `${dd}-${mm}-${yy}`;
}
function statutIconHTML(statut) {
  switch(String(statut||'').toLowerCase()){
    case 'fonctionnel':     return '<i class="fa fa-check-circle" style="color:#A6A485;"></i>';
    case 'en_panne':        return '<i class="fa-solid fa-triangle-exclamation" style="color:#BF0404;"></i>';
    case 'en_maintenance':  return '<i class="fa-solid fa-screwdriver-wrench" style="color:#DDACA7;"></i>';
    case 'hors_service':    return '<i class="fa fa-times-circle" style="color:#888;"></i>';
    default:                return '<i class="fa fa-minus-circle" style="color:#ccc;"></i>';
  }
}
function actionMenuHtml(id, protoUrl='') {
  const direct = !!protoUrl;
  const linkAttrs = direct
    ? `href="${escAttr(protoUrl)}" target="_blank" rel="noopener"`
    : `href="#"`;
  return `
    <div class="actions">
      <button class="action-btn" type="button" aria-haspopup="true" aria-expanded="false">...</button>
      <div class="dropdown-menu">
        <a ${linkAttrs}
           class="action-protocole${direct ? ' direct' : ''}"
           data-id="${id}"
           data-url="${escAttr(protoUrl)}">
          <i class="fa fa-file-alt"></i> Protocole d'utilisation
        </a>
        <a href="#" class="openModifierEquipementModal" data-id="${id}"><i class="fa fa-edit"></i> Modifier</a>
        <a href="#" class="openMaintenanceModal" data-id="${id}"><i class="fa fa-wrench"></i> Demande de maintenance</a>
        <a href="#" class="action-supprimer" data-id="${id}" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
      </div>
    </div>
  `;
}


// ========= API EQUIP/MAINT =========
async function fetchEquipements({ q='', categorie_id='', disponibilite_id='', page=1, per_page=100 } = {}){
  const params = new URLSearchParams();
  if (q) params.set('q', q);
  if (categorie_id) params.set('categorie_id', categorie_id);
  if (disponibilite_id) params.set('disponibilite_id', disponibilite_id);
  params.set('page', page);
  params.set('per_page', per_page);
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/equipement?${params.toString()}`);
}
async function fetchLastMaintenance(equipementId){
  // idéalement renvoyé directement côté backend (JOIN MAX(date)), sinon:
  const url = `${REST_BASE}/plateforme-directeurderecherche/v1/maintenance?equipement_id=${encodeURIComponent(equipementId)}&per_page=1`;
  const rows = await getJSON(url);
  const m = Array.isArray(rows) ? rows[0] : null;
  return m?.date_fin || m?.date_debut || '';
}
async function getProtocoleURL(equipementId){
  const url = `${REST_BASE}/plateforme-directeurderecherche/v1/equipement_protocole?equipement_id=${encodeURIComponent(equipementId)}&per_page=1`;
  const rows = await getJSON(url);
  const p = Array.isArray(rows) ? rows[0] : null;
  return p?.fichier || '';
}
async function deleteEquipement(id){
  const res = await fetch(`${REST_BASE}/plateforme-directeurderecherche/v1/equipement/${id}`, {
    method: 'DELETE', headers: AUTH_HEADERS, credentials: 'include'
  });
  if (!res.ok) throw new Error('Delete failed');
}

// ========= DATATABLES =========
function escAttr(s=''){ return String(s).replace(/"/g,'&quot;'); }

let dtEquip = null;
let dtEventsBound = false;
function actionMenuHtml(id, protoUrl='') {
  const direct = !!protoUrl;
  const linkAttrs = direct
    ? `href="${escAttr(protoUrl)}" target="_blank" rel="noopener"`
    : `href="#"`;

  return `
    <div class="actions">
      <button class="action-btn" type="button" aria-haspopup="true" aria-expanded="false">...</button>
      <div class="dropdown-menu">
        <a ${linkAttrs}
           class="action-protocole${direct ? ' direct' : ''}"
           data-id="${id}"
           data-url="${escAttr(protoUrl)}">
          <i class="fa fa-file-alt"></i> Protocole d'utilisation
        </a>
        <a href="#" class="openModifierEquipementModal" data-id="${id}"><i class="fa fa-edit"></i> Modifier</a>
        <a href="#" class="openMaintenanceModal" data-id="${id}"><i class="fa fa-wrench"></i> Demande de maintenance</a>
        <a href="#" class="action-supprimer" data-id="${id}" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
      </div>
    </div>
  `;
}
// URL de redirection "mon-labo" (vient de l'attribut data-details-url du <table>)
const DETAILS_BASE_URL = ($('#equipementsTable').data('details-url') || '/mon-labo').toString();

function buildRows(items){
  return (items || []).map(e => ([
    `<input type="checkbox" class="row-check" data-id="${e.id}">`,
    esc(e.nom_appareil || ''),
    esc(e.categorie_label || ''),
    `<span class="status-icon">${statutIconHTML(e.statut)}</span>`,
    esc(e.disponibilite_label || e.disponibilite || '—'),
    `<span class="last-maint">—</span>`,
`<a class="details-icon" href="${escAttr(DETAILS_BASE_URL)}?equipement_id=${escAttr(e.id)}" title="Voir les détails">
       <i class="fa fa-eye"></i>
     </a>`,    actionMenuHtml(e.id, e.protocole_fichier || '')   // ← ICI
  ]));
}

async function reloadEquipements(){
  const $tbl = $('#equipementsTable');
  if (!$tbl.length) { console.warn('[reloadEquipements] Table absente'); return; }

  try {
    const items = await fetchEquipements();
    const rows  = buildRows(items);

    if ($.fn.dataTable.isDataTable($tbl)) {
      // ✅ table déjà initialisée ailleurs ou précédemment → récupère l’instance
      dtEquip = $tbl.DataTable();
      dtEquip.clear().rows.add(rows).draw(false);
    } else {
      // ✅ 1ère init (tbody vide pour éviter "Incorrect column count")
      $tbl.find('tbody').empty();
      dtEquip = $tbl.DataTable({
        data: rows,
        deferRender: true,
        autoWidth: false,
        paging: true,
        searching: true,
        info: false,
        language: { emptyTable: 'Aucun équipement' },
        columnDefs: [
          { orderable: false, targets: [0,6,7] },
          { className: 'dt-center', targets: [0,3,4,6,7] }
        ]
      });

      // Bindings délégués (éviter multiple binding)
      if (!dtEventsBound) {
        $('#equipementsTable tbody')
          .on('click', '.action-btn', function(e){
            e.stopPropagation();
            const menu = $(this).siblings('.dropdown-menu');
            $('#equipementsTable .dropdown-menu').not(menu).removeClass('open');
            menu.toggleClass('open');
          })
          // Protocole : si un lien direct existe, on le laisse s'ouvrir ; sinon fallback AJAX
            $('#equipementsTable tbody')
            .off('click.actionProto')
            .on('click.actionProto', '.action-protocole', async function(e){
                const url = $(this).data('url') || $(this).attr('href');
                if (url && url !== '#') {
                // Lien direct → ne pas empêcher le comportement par défaut
                return;
                }
                e.preventDefault();
                const id = $(this).data('id');
                try {
                const fetched = await getProtocoleURL(id);
                if (fetched) window.open(fetched, '_blank');
                else window.toast?.('Aucun protocole', true) || alert('Aucun protocole');
                } catch(err){
                console.error(err);
                window.toast?.('Erreur protocole', true) || alert('Erreur protocole');
                }
            })

          .on('click', '.openModifierEquipementModal', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            if (typeof window.openModifierEquipementModal === 'function') window.openModifierEquipementModal(id);
          })
          .on('click', '.openMaintenanceModal', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            if (typeof window.openMaintenanceModal === 'function') window.openMaintenanceModal(id);
          })
          .on('click', '.action-supprimer', async function(e){
            e.preventDefault();
            const id = $(this).data('id');
            if (!confirm('Supprimer cet équipement ?')) return;
            try { await deleteEquipement(id); window.toast?.('Équipement supprimé') || alert('Supprimé'); reloadEquipements(); }
            catch(err){ console.error(err); window.toast?.('Erreur suppression', true) || alert('Erreur suppression'); }
          });

        $('#checkAllEquipements').off('change.equip').on('change.equip', function(){
          $('#equipementsTable tbody .row-check').prop('checked', this.checked);
        });

        $(document).off('click.equipMenu').on('click.equipMenu', function(){
          $('#equipementsTable .dropdown-menu').removeClass('open');
        });

        dtEventsBound = true;
      }
    }

    // Hydrater "Dernier entretien" (colonne 5) sans recréer le DOM
    if (dtEquip) {
      const promises = (items || []).map(async (e, i) => {
        const date = await fetchLastMaintenance(e.id).catch(()=> '');
        dtEquip.cell(i, 5).data(date ? fmtDate(date) : '—');
      });
      await Promise.all(promises);
      dtEquip.draw(false);
    }

  } catch (e) {
    console.error('[reloadEquipements]', e);
    // ⚠️ ne pas mettre de <td colspan="8"> dans TBODY avec DataTables
    if ($.fn.dataTable.isDataTable('#equipementsTable')) {
      const api = $('#equipementsTable').DataTable();
      api.clear().draw();
    } else {
      $('#equipementsTable tbody').empty();
    }
    window.toast?.('Erreur de chargement', true) || alert('Erreur de chargement');
  }
}


// ========== INIT ==========
document.addEventListener('DOMContentLoaded', () => {
  reloadEquipements();
});

/**** CACHES LOOKUPS (catégories, disponibilités) ****/
window._EQUIP_CATS = window._EQUIP_CATS || [];
window._EQUIP_DISPOS = window._EQUIP_DISPOS || [];

// -> Ajoute ces 2 lignes dans loadEquipementLookups() après avoir reçu cats, dispos :
/*
window._EQUIP_CATS = cats;
window._EQUIP_DISPOS = dispos;
*/

function findCatLabel(id){
  id = parseInt(id,10)||0;
  const it = (window._EQUIP_CATS||[]).find(x=>+x.id===id);
  return it?.intitule || '';
}
function findDispoLabel(id){
  id = parseInt(id,10)||0;
  const it = (window._EQUIP_DISPOS||[]).find(x=>+x.id===id);
  return it?.intitule || '';
}
function statutLabel(s){
  const m = {fonctionnel:'Fonctionnel', en_panne:'En panne', en_maintenance:'En maintenance', hors_service:'Hors service'};
  return m[(s||'').toLowerCase()] || s || '-';
}

/**** API helpers ****/
async function fetchEquipementById(id){
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/equipement/${encodeURIComponent(id)}`);
}
async function fetchEntretienByEquip(id){
  // si tu as exposé l’endpoint /conditions_entretien
  try{
    const rows = await getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/conditions_entretien?equipement_id=${encodeURIComponent(id)}&per_page=1`);
    return Array.isArray(rows) ? rows[0] : null;
  }catch(e){ return null; }
}
async function fetchProtocoleByEquip(id){
  try{
    return await getProtocoleURL(id); // déjà défini dans ton code
  }catch(e){ return ''; }
}
async function patchJSON(endpoint, data){
  const res = await fetch(`${REST_BASE}${endpoint}`, {
    method: 'PATCH',
    headers: HEADERS_JSON,
    credentials: 'include',
    body: JSON.stringify(data)
  });
  if(!res.ok){
    const msg = await res.text().catch(()=>res.statusText);
    throw new Error(`PATCH ${endpoint} → ${res.status} ${msg}`);
  }
  return res.json();
}

/**** DETAILS: rendu HTML ****/
function renderDetailsContent(equip, options={}){
  const {
    catLabel='',
    dispoLabel='',
    lastMaintenance='',
    protocoleUrl='',
    contratUrl='',
    periodicite='',
    consignes=''
  } = options;

  const specHtml = (equip.spcification_technique||'').replace(/\n/g,'<br>');

  return `
    <div class="detail-item"><label>Categorie :</label><p>${esc(catLabel||'-')}</p></div>
    <div class="detail-item"><label>Nom de l'appareil :</label><p>${esc(equip.nom_appareil||'-')}</p></div>
    <div class="detail-item"><label>Modèle :</label><p>${esc(equip.modele||'-')}</p></div>
    <div class="detail-item"><label>Spécification technique :</label><p>${specHtml||'-'}</p></div>
    <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
    <div class="detail-item"><label>Dernier entretien :</label><p>${esc(lastMaintenance||'—')}</p></div>
    <div class="detail-item"><label>Statut :</label><p>${esc(statutLabel(equip.statut))}</p></div>
    <div class="detail-item"><label>Disponibilité :</label><p>${esc(dispoLabel||'-')}</p></div>
    <div class="detail-item"><label>Protocole d'utilisation :</label>
      <div class="file-download-link">
        <span><i class="fa fa-file-pdf"></i> ${protocoleUrl ? 'Protocole.pdf' : '-'}</span>
        ${protocoleUrl ? `<a href="${escAttr(protocoleUrl)}" target="_blank" rel="noopener">
          <img width="20" class="download-icon" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="download"></a>` : ''}
      </div>
    </div>
    <div class="detail-item"><label>Contrat :</label>
      <div class="file-download-link">
        <span><i class="fa fa-file-pdf"></i> ${contratUrl ? 'Contrat.pdf' : '-'}</span>
        ${contratUrl ? `<a href="${escAttr(contratUrl)}" target="_blank" rel="noopener">
          <img width="20" class="download-icon" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="download"></a>` : ''}
      </div>
    </div>
    <div class="detail-item"><label>Périodicité :</label><p>${esc(periodicite||'-')}</p></div>
    <div class="detail-item"><label>Consignes :</label><p>${esc(consignes||'-')}</p></div>
  `;
}

/**** OUVRIR LA MODALE DE DÉTAIL ****/
window.openEquipementDetailsModal = async function(id){
  try{
    const equip = await fetchEquipementById(id);
    // labels
    const catLabel   = findCatLabel(equip.categorie_id);
    const dispoLabel = findDispoLabel(equip.disponibilite_id);
    // autres infos
    const [lastMaint, protoUrl, entretien] = await Promise.all([
      fetchLastMaintenance(id).catch(()=>''),   // déjà dans ton code
      fetchProtocoleByEquip(id).catch(()=>''),  // getProtocoleURL
      fetchEntretienByEquip(id)                 // si endpoint dispo
    ]);
    const contratUrl  = entretien?.fichier_contrat || '';
    const periodicite = entretien?.periodicite || '';
    const consignes   = entretien?.consignes || '';

    // injecter contenu
    const wrap = document.querySelector('#modalDetailsAppareil .details-modal-content');
    if (wrap) wrap.innerHTML = renderDetailsContent(equip, {
      catLabel, dispoLabel,
      lastMaintenance: lastMaint ? fmtDate(lastMaint) : '—',
      protocoleUrl: protoUrl || '',
      contratUrl,
      periodicite,
      consignes
    });
     $('#modalDetailsAppareil').data('equip-id', id);             // sur la modale
      $('#modalDetailsAppareil .openHistoryModal').data('id', id); // sur le bouton Historique
      $(document).data('last-equip-id', id);                       // fallback global
      // (optionnel) log
      console.debug('[openEquipementDetailsModal] equip-id set =', id);

    // ouvrir
    document.getElementById('modalDetailsAppareil').style.display = 'flex';
  }catch(err){
    console.error('[openEquipementDetailsModal]', err);
    window.toast?.('Impossible de charger les détails', true) || alert('Impossible de charger les détails');
  }
};

// remplace ton ancien binding simple :
$(document).off('click.openDetailsModal').on('click.openDetailsModal', '.openDetailsModal', function(e){
  e.preventDefault();
  const id = $(this).data('id');
  if (id) window.openEquipementDetailsModal(id);
});


/**** MODIFIER L’ÉQUIPEMENT (préremplir + PATCH) ****/
function fillEditSelect($sel, items, placeholder){
  $sel.empty();
  $sel.append(new Option(placeholder||'—',''));
  (items||[]).forEach(it => $sel.append(new Option(it.intitule || it.code || ('#'+it.id), it.id)));
}

// ---- OUVERTURE MODALE EDIT + PREFILL COMPLET ----
window.openModifierEquipementModal = async function(id){
  try{
    // 1) Assurer les listes (et injecter les options dans la modale)
    await loadEquipementLookups();

    // 2) Charger toutes les données de l'équipement
    const equip = await fetchEquipementById(id);
    const [protoUrl, entretien] = await Promise.all([
      fetchProtocoleByEquip(id).catch(()=>''),         // URL dernier protocole
      fetchEntretienByEquip(id).catch(()=>null)        // {periodicite, consignes, fichier_contrat}
    ]);

    const $m = $modalEdit().data('equip-id', id);

    // 3) Pré-remplir TOUS les champs
    $('#modifier-categorie-equipement').val(String(equip.categorie_id || ''));   // ← catégorie sélectionnée
    $('#modifier-nom-appareil').val(equip.nom_appareil || '');
    $('#modifier-modele-appareil').val(equip.modele || '');
    $('#modifier-spec-tech').val(equip.spcification_technique || '');
    $('#modifier-statut-appareil').val(equip.statut || '');
    $('#modifier-disponibilite-appareil').val(String(equip.disponibilite_id || ''));

    $('#modifier-periodicite').val(entretien?.periodicite || '');
    $('#modifier-consignes').val(entretien?.consignes || '');

    // 4) Miroirs fichiers existants
    const $protoText = $m.find('.input-file-text[placeholder="Protocole d\'utilisation"]');
    const $contrText = $m.find('.input-file-text[placeholder="Contrat"]');
    $protoText.val(protoUrl ? basenameFromUrl(protoUrl) : '');
    $contrText.val(entretien?.fichier_contrat ? basenameFromUrl(entretien.fichier_contrat) : '');

    // MAJ miroirs quand l'utilisateur choisit un nouveau fichier
    $m.find('.input-file-wrapper input[type="file"]').off('change.mirror').on('change.mirror', function(){
      const name = this.files?.[0]?.name || '';
      $(this).closest('.input-file-wrapper').find('.input-file-text').val(name);
    });

    // 5) Ouvrir la modale
    $m.css('display','flex');

  } catch (e){
    console.error('[openModifierEquipementModal]', e);
    window.toast?.('Impossible de charger l’équipement', true) || alert('Impossible de charger l’équipement');
  }
};

// SAVE (PATCH)
// ---- SAUVEGARDE EDIT (PATCH + liens protocole/entretien) ----
async function updateEquipementFromEditModal(){
    const $m = $modalEdit();
    const id = $m.data('equip-id');
    if (!id) return;

    // payload PATCH
    const payload = {
        categorie_id: parseInt($('#modifier-categorie-equipement').val()||0,10) || undefined,
        nom_appareil: ($('#modifier-nom-appareil').val()||'').trim(),
        modele: ($('#modifier-modele-appareil').val()||'').trim(),
        spcification_technique: ($('#modifier-spec-tech').val()||'').trim(),
        statut: ($('#modifier-statut-appareil').val()||'').trim(),
        disponibilite_id: parseInt($('#modifier-disponibilite-appareil').val()||0,10) || undefined
    };
    Object.keys(payload).forEach(k => (payload[k]===undefined) && delete payload[k]);

    // entretien
    const periodicite = ($('#modifier-periodicite').val()||'').trim();
    const consignes   = ($('#modifier-consignes').val()||'').trim();

    // fichiers choisis
    const protoFile = $m.find('.input-file-text[placeholder="Protocole d\'utilisation"]').closest('.input-file-wrapper').find('input[type="file"]')[0]?.files?.[0] || null;
    const contrFile = $m.find('.input-file-text[placeholder="Contrat"]').closest('.input-file-wrapper').find('input[type="file"]')[0]?.files?.[0] || null;

    const lieu = ($('#modifier-lieu').val()||'').trim();

    // Images NOUVELLES (ajoutées)
    const $imagesWrap = $('#modalModifierEquipement .input-file-wrapper:has(input[placeholder="Importer des images..."])');
    const newImagesFiles = $imagesWrap.find('input[type="file"][multiple]')[0]?.files || [];
    const newImagesUrls = [];
    for (const file of Array.from(newImagesFiles)) {
        const url = await uploadMedia(file, `Image - ${payload.nom_appareil || 'Equipement'}`).catch(e => {
            console.error('Upload image échoué:', e); return '';
        });
        if (url) newImagesUrls.push(url);
    }

    if (!payload.nom_appareil || !payload.modele){
        window.toast?.('Nom et Modèle sont requis', true) || alert('Nom et Modèle sont requis');
        return;
    }

    const $btn = $m.find('.btn-enregistrer'); const txt = $btn.text();
    $btn.prop('disabled', true).text('Enregistrement…');

    try{
        // PATCH équipement
        await patchJSON(`/plateforme-directeurderecherche/v1/equipement/${encodeURIComponent(id)}`, payload);

        // Uploads + liaisons si fournis
        if (protoFile) {
            const protoUrl = await uploadMedia(protoFile, `Protocole - ${payload.nom_appareil || 'Equipement'}`);
            if (protoUrl) await postEquipementProtocole(id, protoUrl);
        }
        let contrUrl = '';
        if (contrFile) contrUrl = await uploadMedia(contrFile, `Contrat - ${payload.nom_appareil || 'Equipement'}`);

        // Upsert entretien si données présentes
        if (periodicite || consignes || contrUrl) {
            await postConditionsEntretien(id, {
                periodicite,
                consignes,
                fichier_contrat: contrUrl || undefined
            });
        }

        // Ajoute au payload (commenté car backend non prêt)
        // payload.lieu = lieu;
        // payload.new_images = newImagesUrls; // Array d'URLs nouvelles à ajouter au backend

        window.toast?.('Équipement mis à jour', false) || alert('Équipement mis à jour');
        $m.hide();
        window.reloadEquipements?.();

    } catch(e){
        console.error('[updateEquipementFromEditModal]', e);
        window.toast?.('Échec mise à jour', true) || alert('Échec mise à jour');
    } finally {
        $btn.prop('disabled', false).text(txt);
    }
}
// bouton Enregistrer (modale edit)
$('#modalModifierEquipement .btn-enregistrer')
  .off('click.saveEdit')
  .on('click.saveEdit', function(e){ e.preventDefault(); updateEquipementFromEditModal(); });





// ====== helpers spécifiques maintenance ======
function fmtNowMySQL() {
  const d = new Date();
  const pad = n => String(n).padStart(2,'0');
  return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())} ${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())}`;
}

function $modalMaint(){ return $('#modalMaintenance'); }
function $formMaint(){ return $('#modalMaintenance .popup-form'); }

function ensureMaintenanceSelectOptions() {
  const $sel = $formMaint().find('select').first(); // "Type De Maintenance"
  if (!$sel.find('option[value="preventive"]').length) {
    $sel.empty().append(`
      <option value="">Type</option>
      <option value="preventive">Préventive</option>
      <option value="corrective">Corrective</option>
      <option value="curative">Curative</option>
      <option value="inspection">Inspection</option>
      <option value="autre">Autre</option>
    `);
  }
}

// Ouvre la modale maintenance pour un equipement_id
window.openMaintenanceModal = async function(equipementId){
  try {
    ensureMaintenanceSelectOptions();

    // reset propre du formulaire
    const $f = $formMaint();
    $f[0]?.reset();
    $f.find('.input-file-text').val('');
    $f.find('input[type="file"]').val('');

    // garder l'id pour la sauvegarde
    $modalMaint().data('equip-id', equipementId);

    // afficher nom équipement (readonly)
    const equip = await fetchEquipementById(equipementId);
    $f.find('input[placeholder="Spectrophotomètre UV"]')   // ton input "Équipement" readonly
      .val(equip?.nom_appareil || `#${equipementId}`);

    // ouvrir
    $modalMaint().css('display','flex');
  } catch (e) {
    console.error('[openMaintenanceModal]', e);
    window.toast?.('Impossible d’ouvrir la maintenance', true) || alert('Impossible d’ouvrir la maintenance');
  }
};

// Upload fichier → URL (utilise ta fonction uploadMedia déjà définie)
async function uploadIfAny($wrapper) {
  const file = $wrapper.find('input[type="file"]')[0]?.files?.[0] || null;
  if (!file) return '';
  const title = $wrapper.find('.input-file-text').attr('placeholder') || file.name;
  return uploadMedia(file, title).catch(e => { console.error('Upload fail:', e); return ''; });
}

// Sauvegarder maintenance
async function saveMaintenanceFromModal(){
  const $m = $modalMaint();
  const equipId = $m.data('equip-id');
  if (!equipId) { window.toast?.('Équipement manquant', true) || alert('Équipement manquant'); return; }

  const $f = $formMaint();
  const typeMaintenance = $f.find('select').first().val() || '';   // preventive/corrective/…
  const motif           = ($f.find('textarea').first().val() || '').trim();

  // fichiers
  const $rapWrap  = $f.find('.input-file-wrapper').eq(0); // "Fiche attaché" (rapport)
  const $photoWrap= $f.find('.input-file-wrapper').eq(1); // "Photo de l'équipement"

  const $btn = $('#popupContainerMaintenance .btn-enregistrer');
  const txt  = $btn.text(); $btn.prop('disabled', true).text('Enregistrement…');

  try {
    const [rapportUrl, photoUrl] = await Promise.all([
      uploadIfAny($rapWrap),
      uploadIfAny($photoWrap)
    ]);

    // date_debut: maintenant (schéma NOT NULL). Ajuste si tu as un champ date/heure.
    const payload = {
      equipement_id: String(equipId),
      date_debut: fmtNowMySQL(),
      date_fin: '',                 // optionnel
      type_maintenance: typeMaintenance,
      motif: motif,
      fichier_rapport: rapportUrl || '',
      photo_equipement: photoUrl || ''
    };

    // POST maintenance
    const created = await postJSON('/plateforme-directeurderecherche/v1/maintenance', payload);

    window.toast?.('Demande de maintenance enregistrée', false) || alert('Demande de maintenance enregistrée');
    // Fermer + reset + éventuel refresh
    $m.hide();
    $f[0]?.reset();
    $f.find('.input-file-text').val('');
    if (typeof window.reloadEquipements === 'function') window.reloadEquipements();

    return created;
  } catch (e) {
    console.error('[saveMaintenanceFromModal]', e);
    window.toast?.('Échec enregistrement maintenance', true) || alert('Échec enregistrement maintenance');
    throw e;
  } finally {
    $btn.prop('disabled', false).text(txt);
  }
}

// ====== Bindings UI ======
$(document)
  // bouton "Demande de maintenance" dans le menu Actions (existe déjà avec data-id)
  .off('click.openMaint')
  .on('click.openMaint', '.openMaintenanceModal', function(e){
    e.preventDefault();
    const id = $(this).data('id') ||
               $(this).closest('tr').find('.row-check').data('id') ||
               $(this).closest('tr').find('.openDetailsModal').data('id');
    if (id) openMaintenanceModal(id);
  });

// bouton Enregistrer dans la modale
$('#popupContainerMaintenance .btn-enregistrer')
  .off('click.saveMaint')
  .on('click.saveMaint', function(e){ e.preventDefault(); saveMaintenanceFromModal(); });

// miroirs de nom de fichier
$('#modalMaintenance .input-file-wrapper input[type="file"]').off('change.mirror')
  .on('change.mirror', function(){
    const name = this.files?.[0]?.name || '';
    $(this).closest('.input-file-wrapper').find('.input-file-text').val(name);
  });



/************ HISTORIQUE MAINTENANCE ************/

// map types DB -> libellés FR
function typeMaintLabel(t){
  const m = {
    preventive: 'Préventive',
    corrective: 'Corrective',
    curative: 'Curative',
    inspection: 'Inspection',
    autre: 'Autre'
  };
  return m[(t||'').toLowerCase()] || (t||'-');
}

// Récup liste des maintenances d’un équipement
async function fetchMaintenancesByEquip(equipementId, per=200){
  const url = `${REST_BASE}/plateforme-directeurderecherche/v1/maintenance?equipement_id=${encodeURIComponent(equipementId)}&per_page=${per}`;
  return getJSON(url);
}

// Rendu des lignes dans #modalHistorique
function renderMaintenanceHistory(items){
  const $wrap = $('#modalHistorique .details-modal-content');
  if (!$wrap.length) return;

  if (!items || !items.length) {
    $wrap.html(`<div style="padding:12px;color:#666;">Aucune maintenance enregistrée.</div>`);
    return;
  }

  const rows = items.map(m=>{
    const debut = m.date_debut ? fmtDate(m.date_debut) : '—';
    const fin   = m.date_fin   ? fmtDate(m.date_fin)   : '—';
    const type  = typeMaintLabel(m.type_maintenance);
    const motif = (m.motif || '').replace(/\n/g,'<br>') || '—';

    const hasRap  = !!m.fichier_rapport;
    const hasPhoto= !!m.photo_equipement;

    return `
      <div class="maintenance-history-item" data-id="${m.id}">
        <span>
          <strong>${debut}</strong>${fin && fin !== '—' ? ` → <strong>${fin}</strong>` : ''}<br>
          <small>${type}</small>
        </span>
        <span style="flex:1; margin:0 12px; color:#2A2916;">${motif}</span>
        <span style="display:flex; gap:8px;">
          <button class="btn-download-report" ${hasRap?`data-url="${escAttr(m.fichier_rapport)}"`:'disabled'}>Rapport</button>
          <button class="btn-view-photo" ${hasPhoto?`data-url="${escAttr(m.photo_equipement)}"`:'disabled'}>Photo</button>
        </span>
      </div>
    `;
  }).join('');

  $wrap.html(rows);
}

// Ouvrir la modale Historique + charger depuis API
async function openMaintenanceHistoryModal(equipementId){
  try{
    const items = await fetchMaintenancesByEquip(equipementId);
    renderMaintenanceHistory(items);

    // ouvrir l’historique
    $('#modalHistorique').css('display','flex');
  }catch(e){
    console.error('[openMaintenanceHistoryModal]', e);
    window.toast?.('Impossible de charger l’historique', true) || alert('Impossible de charger l’historique');
  }
}

/* ====== BINDINGS ====== */

// Quand on ouvre la modale Détails, penser à mémoriser l’équipement courant
// (Si ce n’est pas déjà fait dans ton code, ajoute cette ligne dans openEquipementDetailsModal(id) :)
//
//   $('#modalDetailsAppareil').data('equip-id', id);
//

// Bouton "Historique des maintenances" depuis la modale Détails
$(document).off('click.openHistoryModal').on('click.openHistoryModal', '.openHistoryModal', function(e){
  e.preventDefault();
  const equipId = $('#modalDetailsAppareil').data('equip-id');
  if (!equipId) { window.toast?.('Équipement introuvable', true) || alert('Équipement introuvable'); return; }
  $('#modalDetailsAppareil').hide();
  openMaintenanceHistoryModal(equipId);
});

// Flèche retour dans Historique → revenir aux détails
$('#modalHistorique .fa-arrow-left').off('click.backToDetails').on('click.backToDetails', function(){
  $('#modalHistorique').hide();
  $('#modalDetailsAppareil').css('display','flex');
});

// Boutons Rapport / Photo (ouverture dans un nouvel onglet)
$('#modalHistorique')
  .off('click.openRapport')
  .on('click.openRapport', '.btn-download-report', function(){
    const url = $(this).data('url');
    url ? window.open(url, '_blank') : (window.toast?.('Aucun rapport', true) || alert('Aucun rapport'));
  })
  .off('click.openPhoto')
  .on('click.openPhoto', '.btn-view-photo', function(){
    const url = $(this).data('url');
    url ? window.open(url, '_blank') : (window.toast?.('Aucune photo', true) || alert('Aucune photo'));
  });

/* ====== util escapement simple pour attributs ====== */
function escAttr(s=''){ return String(s).replace(/"/g,'&quot;'); }




/********************** SUPPRESSION ÉQUIPEMENT **********************/

/* Appel API DELETE */
async function apiDeleteEquipement(id) {
  const res = await fetch(
    `${REST_BASE}/plateforme-directeurderecherche/v1/equipement/${encodeURIComponent(id)}`,
    { method: 'DELETE', headers: AUTH_HEADERS, credentials: 'include' }
  );
  if (!res.ok && res.status !== 204) {
    const msg = await res.text().catch(()=>res.statusText);
    throw new Error(`DELETE equipement/${id} → ${res.status} ${msg}`);
  }
}

/* Fermer tous les menus des actions (petit confort UI) */
function closeEquipDropdowns() {
  $('#equipementsTable .dropdown-menu').removeClass('open').hide();
}

/* Binding click sur “Supprimer” (menu Actions) */
$(document)
  .off('click.actionSupprimerEquip')
  .on('click.actionSupprimerEquip', '.action-supprimer', async function (e) {
    e.preventDefault();

    // Récupérer l’ID de l’équipement depuis le bouton ou la ligne
    const id =
      $(this).data('id') ||
      $(this).closest('tr').find('.row-check').data('id') ||
      $(this).closest('tr').find('.openDetailsModal').data('id');

    if (!id) {
      console.warn('[delete] id introuvable');
      window.toast?.('Équipement introuvable', true) || alert('Équipement introuvable');
      return;
    }

    // Confirmation
    if (!confirm('Supprimer cet équipement et toutes ses correspondances (protocoles, entretiens, maintenances) ?')) {
      return;
    }

    // UI: marquer la ligne en suppression
    const $row = $(this).closest('tr');
    $row.addClass('is-deleting').css('opacity', .5);
    closeEquipDropdowns();

    try {
      await apiDeleteEquipement(id);
      window.toast?.('Équipement supprimé', false) || alert('Équipement supprimé');
      // Rafraîchir la table proprement
      if (typeof window.reloadEquipements === 'function') {
        await window.reloadEquipements();
      } else {
        // fallback : retirer la ligne du DOM si pas de reload
        $row.remove();
      }
    } catch (err) {
      console.error('[delete equipement]', err);
      window.toast?.('Erreur de suppression', true) || alert('Erreur de suppression');
      $row.removeClass('is-deleting').css('opacity', 1);
    }
  });

/********************** (OPTIONNEL) SUPPRESSION EN LOT **********************/
/* Appelle cette fonction depuis un bouton “Supprimer la sélection” si tu en ajoutes un */
window.deleteSelectedEquipements = async function () {
  const $rows = $('#equipementsTable tbody .row-check:checked').closest('tr');
  if (!$rows.length) {
    window.toast?.('Aucun équipement sélectionné', true) || alert('Aucun équipement sélectionné');
    return;
  }
  if (!confirm(`Supprimer ${$rows.length} équipement(s) sélectionné(s) ?`)) return;

  // UI
  $rows.addClass('is-deleting').css('opacity', .5);
  closeEquipDropdowns();

  try {
    // Supprimer en série (plus sûr pour voir les erreurs)
    for (const el of $rows.toArray()) {
      const id =
        $(el).find('.row-check').data('id') ||
        $(el).find('.openDetailsModal').data('id');
      if (id) await apiDeleteEquipement(id);
    }
    window.toast?.('Équipements supprimés', false) || alert('Équipements supprimés');
  } catch (err) {
    console.error('[bulk delete equipements]', err);
    window.toast?.('Erreur lors de la suppression en lot', true) || alert('Erreur suppression en lot');
  } finally {
    if (typeof window.reloadEquipements === 'function') {
      await window.reloadEquipements();
    } else {
      $rows.remove();
    }
  }
};

/********************** (OPTIONNEL) STYLE VISUEL DE “SUPPRESSION” **********************/
/* Ajoute si tu veux un style adouci pendant la suppression
.is-deleting { pointer-events: none; filter: grayscale(0.6); }
*/
/************* HELPERS RÉSERVATIONS *************/
function parseHoraireRange(str){
  // "10:00 - 11:00" -> {start:"10:00:00", end:"11:00:00"}
  if (!str) return { start:'', end:'' };
  const m = str.split('-').map(s=>s.trim());
  const hhmm = s => (s.length===5 ? s+':00' : s);
  return { start: hhmm(m[0]||''), end: hhmm(m[1]||'') };
}

/************* API *************/
async function createReservation(payload){
  return postJSON('/plateforme-directeurderecherche/v1/reservation', payload);
}
async function updateReservationStatus(id, statut){
  return fetch(`${REST_BASE}/plateforme-directeurderecherche/v1/reservation/${id}`,{
    method:'PATCH', headers: HEADERS_JSON, credentials:'include',
    body: JSON.stringify({ statut })
  }).then(r=>{ if(!r.ok) throw new Error('PATCH status '+r.status); return r.json(); });
}
async function cancelReservation(id){
  // soit endpoint cancel, soit PATCH statut
  return updateReservationStatus(id, 'annulee');
}
async function fetchReservations(params = {}){
  const q = new URLSearchParams(params).toString();
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/reservation?${q}`);
}

/************* UI — MODALE “Nouvelle réservation” *************/
async function saveReservationFromModal(){
  const $modal = $('#modalObjectifs');
  // IMPORTANT : la valeur du select "nom-equipement" doit contenir l'ID en value
  const rid    = parseInt($('#nom-equipement').val() || 0, 10);
  const rlabel = $('#nom-equipement option:selected').text().trim();
  const date   = ($('#date-reservation').val()||'').split('/').reverse().join('-'); // 11/01/2025 -> 2025-01-11
  const h      = parseHoraireRange($('#heure-reservation').val());
  const obj    = ($('#objectif-reservation').val()||'').trim();

  if (!rid || !date || !h.start || !h.end) {
    window.toast?.('Veuillez remplir tous les champs obligatoires', true) || alert('Champs manquants');
    return;
  }

  const payload = {
    resource_id: rid,
    resource_label: rlabel,
    date_reservation: date,
    heure_debut: h.start,
    heure_fin: h.end,
    objectif: obj
  };

  const $btn = $('#btnSaveObjectifs'); const txt = $btn.text();
  $btn.prop('disabled', true).text('Enregistrement…');

  try {
    await createReservation(payload);
    window.toast?.('Réservation enregistrée', false) || alert('Réservation enregistrée');
    $modal.hide();
    // rafraîchis ta table des réservations si tu as une fonction
    if (typeof window.reloadReservations === 'function') reloadReservations();
  } catch(e){
    console.error('[createReservation]', e);
    if (String(e).includes('409')) {
      window.toast?.('Créneau non disponible', true) || alert('Créneau non disponible');
    } else {
      window.toast?.('Échec enregistrement', true) || alert('Échec enregistrement');
    }
  } finally {
    $btn.prop('disabled', false).text(txt);
  }
}

// bind bouton Enregistrer de la modale
$('#btnSaveObjectifs').off('click.resv').on('click.resv', function(e){
  e.preventDefault(); saveReservationFromModal();
});
function fmtFRdate(d){ if(!d) return '—'; const [y,m,dd]=(d||'').split('-'); return `${dd}/${m}/${y}`; }
function fmtRange(h1,h2){ const a=(h1||'').slice(0,5), b=(h2||'').slice(0,5); return (a&&b)?`${a} - ${b}`:'—'; }

function isOwnerReservation(r){
  return Number(r.equip_owner_id) === Number(window.PMSettings?.userId || 0);
}
function isPendingReservation(r){
  return String(r.statut || '').toLowerCase() === 'en_attente';
}
function renderReservationActions(r){
  const id = escAttr(r.id);
  const ownerId = r.equip_owner_id;
  const isOwner = isOwnerReservation(r);
  const isPending = isPendingReservation(r);

  // Lien "Modifier" disponible pour tous (tu peux le restreindre si besoin)
  const items = [
    `<a href="#" class="openModifierModal" data-id="${id}"><i class="fa fa-edit"></i> Modifier</a>`
  ];

  // Menu owner-only
  if (isOwner) {
    // Valider/Refuser uniquement si "en_attente"
    const disAttr = isPending ? '' : ' data-disabled="1"';
    items.unshift(
      `<a href="#" class="res-approve" data-id="${id}" data-owner="${ownerId}"${disAttr}><i class="fa fa-check"></i> Valider</a>`,
      `<a href="#" class="res-reject"  data-id="${id}" data-owner="${ownerId}"${disAttr}><i class="fa fa-ban"></i> Refuser</a>`
    );
    // Annuler : autorisé pour owner (même si validée), adapte si besoin
    items.push(
      `<a href="#" class="res-cancel"  data-id="${id}" data-owner="${ownerId}" style="color:#BF0404;"><i class="fa fa-times"></i> Annuler</a>`
    );
  }

  return `
    <div class="actions">
      <button class="action-btn" type="button" aria-haspopup="true" aria-expanded="false">...</button>
      <div class="dropdown-menu">
        ${items.join('')}
      </div>
    </div>
  `;
}
function frStatut(s) {
  const v = String(s || '').toLowerCase();
  if (v === 'validee')  return 'Validée';
  if (v === 'refusee')  return 'Refusée';
  if (v === 'annulee')  return 'Annulée';
  return 'En attente';
}
function statusBadgeFR(s) {
  const lbl = frStatut(s);
  const v = String(s || '').toLowerCase();
  if (v === 'validee')  return `<span class="badge badge-success"><i class="fa-regular fa-circle-check"></i> ${lbl}</span>`;
  if (v === 'refusee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> ${lbl}</span>`;
  if (v === 'annulee')  return `<span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> ${lbl}</span>`;
  return `<span class="badge badge-warning"><i class="fa-regular fa-clock"></i> ${lbl}</span>`;
}
/************* RENDER LIST (ex: #reservationsTable déjà DataTables) *************/
window.reloadReservations = async function(){
  try{
    // deux vues utiles :
    // 1) Mes réservations
    const mine = await fetchReservations({ mine:1, per_page:200 });
    // 2) Réservations sur MES équipements
    const owner = await fetchReservations({ owner:1, per_page:200 });

    // Ici, choisis ce que tu veux afficher dans #reservationsTable (mine, owner, ou fusion)
    const rows = mine; // ou [...owner, ...mine] avec déduplication sur id

    // Si tu utilises DataTables (comme dans ton code) :
    const dt = $('#reservationsTable').DataTable();
    dt.clear();
    /*rows.forEach(r=>{
      dt.row.add([
        `<input type="checkbox" class="row-check" data-id="${r.id}">`,
        r.equip_categorie_label,
        esc(r.resource_label || `#${r.resource_id}`),
        esc((window.PMSettings?.userName)||'—'), // à remplacer par le vrai nom si tu l’as
        r.date_reservation.split('-').reverse().join('/'),
        `${r.heure_debut?.slice(0,5) || ''} - ${r.heure_fin?.slice(0,5) || ''}`,
        `<span class="badge ${r.statut==='validee'?'badge-success':r.statut==='refusee'?'badge-danger':'badge-warning'}">${esc(r.statut)}</span>`,
        `
          <div class="actions">
            <button class="action-btn">...</button>
            <div class="dropdown-menu">
              <a href="#" class="res-approve" data-id="${r.id}">Valider</a>
              <a href="#" class="res-reject"  data-id="${r.id}">Refuser</a>
              <a href="#" class="res-cancel"  data-id="${r.id}" style="color:#BF0404;">Annuler</a>
            </div>
          </div>
        `
      ]);
    });*/

    (rows || []).forEach(r => {
      // Type : à partir de r.categorie (équipement/salle)

      // Nom : utiliser les colonnes jointes (equip_nom / equip_modele), sinon fallback resource_label / id
      const nomTxt =
        (r.equip_nom ? `${r.equip_nom}${r.equip_modele ? ' – ' + r.equip_modele : ''}` :
         (r.resource_label && r.resource_label !== '0' ? r.resource_label : `#${r.resource_id}`));

      // Réservé par : first_name + last_name > display_name > #created_by
      const whoTxt =
        (r.reserver_first_name || r.reserver_last_name)
          ? `${r.reserver_first_name || ''} ${r.reserver_last_name || ''}`.trim()
          : (r.reserver_display_name || `#${r.created_by}`);

      // Date / Heure / Statut
      const dateTxt  = fmtFRdate(r.date_reservation);
      const heureTxt = fmtRange(r.heure_debut, r.heure_fin);
      const statutTd = statusBadgeFR(r.statut);

      dt.row.add([
        `<input type="checkbox" class="row-check" data-id="${r.id}">`,
        r.equip_categorie_label,
        esc(nomTxt),
        esc(whoTxt),
        dateTxt,
        heureTxt,
        statutTd,

         renderReservationActions(r) // ← ICI le menu conditionnel

      ]);
    });
    dt.draw(false);

  }catch(e){
    console.error('[reloadReservations]', e);
    window.toast?.('Erreur chargement réservations', true) || alert('Erreur chargement réservations');
  }
};

// Bind actions statut dans le menu
$(document)
  .off('click.res.appr','a.res-approve')
  .on('click.res.appr','a.res-approve', async function(e){ e.preventDefault();
    const id = $(this).data('id'); try { await updateReservationStatus(id,'validee'); reloadReservations?.(); } catch(err){ alert('Échec validation'); }
  })
  .off('click.res.rej','a.res-reject')
  .on('click.res.rej','a.res-reject', async function(e){ e.preventDefault();
    const id = $(this).data('id'); try { await updateReservationStatus(id,'refusee'); reloadReservations?.(); } catch(err){ alert('Échec refus'); }
  })
  .off('click.res.can','a.res-cancel')
  .on('click.res.can','a.res-cancel', async function(e){ e.preventDefault();
    const id = $(this).data('id'); if(!confirm('Annuler cette réservation ?')) return;
    try { await cancelReservation(id); reloadReservations?.(); } catch(err){ alert('Échec annulation'); }
  });

// Ouvrir / fermer le menu "..."
$(document)
  .off('click.res.menu', '.actions .action-btn')
  .on('click.res.menu', '.actions .action-btn', function(e){
    e.stopPropagation();
    const $menu = $(this).siblings('.dropdown-menu');
    $('.dropdown-menu').not($menu).hide();
    $menu.toggle();
  });
$(document).off('click.res.closemenus').on('click.res.closemenus', function(){ $('.dropdown-menu').hide(); });

// Garde-fou owner + désactivation visuelle
function guardOwner($a){
  const ownerId = Number($a.data('owner') || 0);
  const me      = Number(window.PMSettings?.userId || 0);
  if (ownerId !== me) {
    window.toast?.("Action réservée au propriétaire de l'équipement", true) || alert("Action non autorisée");
    return false;
  }
  if ($a.is('[data-disabled]')) {
  //window.toast?.("Action indisponible pour ce statut", true) || alert("Action indisponible");
  //return false;
  }
  return true;
}

// Valider
$(document)
  .off('click.res.approve', 'a.res-approve')
  .on('click.res.approve', 'a.res-approve', async function(e){
    e.preventDefault();
    const $a = $(this);
    if (!guardOwner($a)) return;
    const id = $a.data('id');
    try {
      await updateReservationStatus(id, 'validee');
      window.reloadReservations?.();
    } catch(err) {
      console.error(err);
      alert('Échec validation');
    }
  });

// Refuser
$(document)
  .off('click.res.reject', 'a.res-reject')
  .on('click.res.reject', 'a.res-reject', async function(e){
    e.preventDefault();
    const $a = $(this);
    if (!guardOwner($a)) return;
    const id = $a.data('id');
    try {
      await updateReservationStatus(id, 'refusee');
      window.reloadReservations?.();
    } catch(err) {
      console.error(err);
      alert('Échec refus');
    }
  });

// Annuler
$(document)
  .off('click.res.cancel', 'a.res-cancel')
  .on('click.res.cancel', 'a.res-cancel', async function(e){
    e.preventDefault();
    const $a = $(this);
    if (!guardOwner($a)) return;
    const id = $a.data('id');
    if (!confirm('Annuler cette réservation ?')) return;
    try {
      await cancelReservation(id); // utilise ta fonction existante
      window.reloadReservations?.();
    } catch(err) {
      console.error(err);
      alert('Échec annulation');
    }
  });

// Remplit le <select id="nom-equipement"> avec tous les équipements
function fillNomEquipementSelect(sel, items) {
  if (!sel) return;
  sel.innerHTML = '';
  sel.append(new Option('Sélectionnez un équipement', ''));
  (items || []).forEach(e => {
    const label = `${e.nom_appareil || '—'}${e.modele ? ' – ' + e.modele : ''}`;
    const opt = new Option(label, e.id);
    sel.append(opt);
  });
}

// Charge TOUS les équipements (sans filtre user)
async function loadAllEquipementsIntoSelect() {
  const base = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/equipement?all=1&per_page=1000`;
  const sel  = document.getElementById('nom-equipement');

  try {
    // si tu as déjà wpFetchJson(); sinon remplace par fetch(...).then(r=>r.json())
    const items = await wpFetchJson(url);
    fillNomEquipementSelect(sel, items);
  } catch (e) {
    console.error('[loadAllEquipementsIntoSelect]', e);
    if (sel) {
      sel.innerHTML = '';
      sel.append(new Option('Erreur de chargement', ''));
    }
    window.toast?.('Erreur de chargement des équipements', true);
  }
}

// Juste charger la liste au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
  loadAllEquipementsIntoSelect();
});

function frToApiDate(s){ // "dd/mm/yyyy" -> "yyyy-mm-dd"
  if(!s) return '';
  const [dd,mm,yyyy] = s.split('/'); 
  return (yyyy && mm && dd) ? `${yyyy}-${mm}-${dd}` : '';
}
function apiToFrDate(s){ // "yyyy-mm-dd" -> "dd/mm/yyyy"
  if(!s) return '';
  const [yyyy,mm,dd] = s.split('-'); 
  return (yyyy && mm && dd) ? `${dd}/${mm}/${yyyy}` : s;
}
// Déjà dans ton code ? alors ne le duplique pas :
function parseHoraireRange(str){
  if (!str) return { start:'', end:'' };
  const m = str.split('-').map(s=>s.trim());
  const hhmm = s => (s && s.length===5 ? s+':00' : s);
  return { start: hhmm(m[0]||''), end: hhmm(m[1]||'') };
}


/* ---------- API helper: GET reservation by id ---------- */
async function fetchReservationById(id){
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/reservation/${encodeURIComponent(id)}`);
}

/* ---------- Conversions de date/heure (tu les as déjà, inclus ici pour contexte) ----------
function frToApiDate(s){ if(!s) return ''; const [dd,mm,yyyy]=s.split('/'); return (yyyy&&mm&&dd)?`${yyyy}-${mm}-${dd}`:''; }
function apiToFrDate(s){ if(!s) return ''; const [yyyy,mm,dd]=s.split('-'); return (yyyy&&mm&&dd)?`${dd}/${mm}/${yyyy}`:s; }
function parseHoraireRange(str){ if(!str) return {start:'',end:''}; const m=str.split('-').map(s=>s.trim()); const hhmm=s=>(s&&s.length===5?s+':00':s); return {start:hhmm(m[0]||''), end:hhmm(m[1]||'')}; }
------------------------------------------------------------------------------------------ */

/* ---------- Ouvrir + préremplir la modale d’édition ---------- */
async function openReservationEditModal(id){
  try{
    const r  = await fetchReservationById(id);
    const $m = $('#modalModifierReservation').data('res-id', id);

    // Nom affiché (joint ou fallback)
    const nom = r.equip_nom
      ? `${r.equip_nom}${r.equip_modele ? ' – ' + r.equip_modele : ''}`
      : (r.resource_label && r.resource_label !== '0' ? r.resource_label : `#${r.resource_id}`);

    $('#modifier-nom-equipement').val(nom);
    $('#modifier-date-reservation').val(apiToFrDate(r.date_reservation));
    $('#modifier-heure-reservation').val(`${(r.heure_debut||'').slice(0,5)} - ${(r.heure_fin||'').slice(0,5)}`);
    $('#modifier-objectif-reservation').val(r.objectif || '');

    // Ouvre avec ta fonction existante (cohérence UI)
    openModalModifierReservation();
  }catch(e){
    console.error('[openReservationEditModal]', e);
    window.toast?.('Impossible de charger la réservation', true) || alert('Impossible de charger la réservation');
  }
}

/* ---------- Binding propre pour le lien "Modifier" du tableau ---------- */
$(document)
  .off('click.resOpenEdit', '.openModifierModal')
  .on('click.resOpenEdit', '.openModifierModal', function(e){
    e.preventDefault();
    e.stopImmediatePropagation();      // évite les anciens handlers
    const id = $(this).data('id');
    if (id) openReservationEditModal(id);
  });

/* ---------- Sauvegarde (PATCH) ---------- */
async function updateReservationFromEditModal(){
  const $m   = $('#modalModifierReservation');
  const id   = $m.data('res-id');
  if (!id) return;

  const dateFR = ($('#modifier-date-reservation').val()||'').trim();
  const heures = ($('#modifier-heure-reservation').val()||'').trim();
  const obj    = ($('#modifier-objectif-reservation').val()||'').trim();

  const dateAPI      = frToApiDate(dateFR);
  const {start, end} = parseHoraireRange(heures);

  if (!dateAPI || !start || !end) {
    window.toast?.('Date et heures sont obligatoires', true) || alert('Date et heures sont obligatoires');
    return;
  }

  const $btn = $('#btnSaveReservationEdit');
  const txt  = $btn.text();
  $btn.prop('disabled', true).text('Enregistrement…');

  try{
    const res = await fetch(`${REST_BASE}/plateforme-directeurderecherche/v1/reservation/${encodeURIComponent(id)}`, {
      method: 'PATCH',
      headers: HEADERS_JSON,
      credentials: 'include',
      body: JSON.stringify({
        date_reservation: dateAPI,
        heure_debut:      start,
        heure_fin:        end,
        objectif:         obj
      })
    });

    if (!res.ok) {
      const msg = await res.text().catch(()=>res.statusText);
      if (res.status === 409) throw new Error('CONFLICT');   // slot déjà pris
      throw new Error(msg || ('HTTP '+res.status));
    }

    window.toast?.('Réservation mise à jour') || alert('Réservation mise à jour');
    $m.hide();
    window.reloadReservations?.();
  }catch(e){
    if (String(e.message).includes('CONFLICT')) {
      window.toast?.('Créneau non disponible pour cet équipement', true) || alert('Créneau non disponible');
    } else {
      console.error('[updateReservationFromEditModal]', e);
      window.toast?.('Échec mise à jour', true) || alert('Échec mise à jour');
    }
  }finally{
    $btn.prop('disabled', false).text(txt);
  }
}

/* ---------- Bouton Enregistrer (modale edit) ---------- */
$(document)
  .off('click.resSaveEdit', '#btnSaveReservationEdit')
  .on('click.resSaveEdit', '#btnSaveReservationEdit', function(e){
    e.preventDefault(); e.stopPropagation();
    updateReservationFromEditModal();
  });

// Dropdown menu logic for both tables
            $(document).on('click', '.action-btn', function (e) {
                e.stopPropagation();
                let dropdown = $(this).closest('.actions').find('.dropdown-menu');
                $('.dropdown-menu').not(dropdown).hide(); // Hide other menus
                dropdown.toggle(); // Toggle current menu
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function () {
                $('.dropdown-menu').hide();
            });

   
</script>




<script>
  // ===== CONFIG REST (réutilise ta config globale si déjà présente) =====
const HEADERS   = { 'X-WP-Nonce': window.PMSettings?.nonce || '', 'Accept': 'application/json' };

async function getJSON(url){
  const res = await fetch(url, { headers: HEADERS, credentials:'include' });
  if(!res.ok) throw new Error(url+' → '+res.status);
  return res.json();
}

// ===== SERVICES =====
function parseYearRangeLabel(lbl){
  // "2025 - 2026" -> yearParam "2025-2026"
  const s = String(lbl || '').trim().replace(/\s+/g,'');
  if (/^\d{4}-\d{4}$/.test(s)) return s;
  if (/^\d{4}$/.test(s)) return s;
  // fallback: année courante
  return new Date().getFullYear().toString();
}

async function apiFetchStats(yearLabel){
  const year = encodeURIComponent(parseYearRangeLabel(yearLabel));
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/stats?year=${year}`);
}

async function apiFetchTopRessources(yearLabel, limit=8){
  const year = encodeURIComponent(parseYearRangeLabel(yearLabel));
  return getJSON(`${REST_BASE}/plateforme-directeurderecherche/v1/top-ressources?year=${year}&limit=${limit}`);
}

// ===== UI / RENDU =====
const $statsBox = {
  reservations: document.querySelectorAll('.left-stats .stat-box .value')[0],
  disponibles:  document.querySelectorAll('.left-stats .stat-box .value')[1]
};

let barChart = null;

function setStat(el, value){
  if (!el) return;
  el.textContent = value;
}

function showLoading(el){
  if (!el) return;
  el.innerHTML = '<span class="loading"></span>';
}

async function loadStatsAndChart(){
  const yearSel = document.querySelector('.graph-select');
  const yearLabel = yearSel ? yearSel.value : (new Date().getFullYear().toString());

  // 1) KPIs
  showLoading($statsBox.reservations);
  showLoading($statsBox.disponibles);
  try {
    const s = await apiFetchStats(yearLabel);
    setStat($statsBox.reservations, s.reservations_en_cours ?? 0);
    setStat($statsBox.disponibles,  s.equipements_disponibles ?? 0);
  } catch(e){
    console.error(e);
    setStat($statsBox.reservations, '—');
    setStat($statsBox.disponibles,  '—');
    window.toast?.('Erreur chargement statistiques', true);
  }

  // 2) TOP bar chart
  try {
    const data = await apiFetchTopRessources(yearLabel, 8);
    renderBarChart(data);
  } catch(e){
    console.error(e);
    renderBarChart([]); // vide
    window.toast?.('Erreur chargement du graphique', true);
  }
}

function renderBarChart(rows){
  const ctx = document.getElementById('barChart');
  if (!ctx) return;

  if (barChart) { barChart.destroy(); }

  const labels = rows.map(r => r.label);
  const values = rows.map(r => Number(r.total||0));

  // palette douce si tu n’as pas de couleurs spécifiques
  const colors = values.map((_,i)=>['#A6A485','#DDACA7','#FFD54F','#A6C7FF','#BF0404','#808066','#b1342f','#dabebe'][i % 8]);

  barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        data: values,
        backgroundColor: colors,
        borderRadius: 6,
        borderSkipped: false
      }]
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          beginAtZero: true,
          ticks: { precision:0 }, // entiers
          grid: { color: 'rgba(0,0,0,0.05)' }
        },
        y: {
          grid: { display:false },
          ticks: { font: { size: 12 } }
        }
      },
      plugins: {
        legend: { display:false },
        tooltip: {
          callbacks: {
            label: ctx => `${ctx.label}: ${ctx.parsed.x} réservations`
          }
        }
      }
    },
    plugins: [{
      // petites étiquettes de valeur à droite des barres
      id:'valueLabels',
      afterDatasetsDraw(chart){
        const {ctx, data} = chart;
        chart.getDatasetMeta(0).data.forEach((bar, i)=>{
          const v = data.datasets[0].data[i];
          ctx.save();
          ctx.fillStyle = '#2A2916';
          ctx.font = 'bold 11px sans-serif';
          ctx.textAlign = 'left';
          ctx.textBaseline = 'middle';
          ctx.fillText(String(v), bar.x + 8, bar.y);
          ctx.restore();
        });
      }
    }]
  });
}

// ===== Init & events =====
document.addEventListener('DOMContentLoaded', ()=>{
  // première charge
  loadStatsAndChart();

  // changement d’année
  const yearSel = document.querySelector('.graph-select');
  if (yearSel) {
    yearSel.addEventListener('change', ()=>{
      loadStatsAndChart();
    });
  }

  // bouton Rapport (si tu veux un export plus tard)
  const btnReport = document.querySelector('.btn-report');
  if (btnReport){
    btnReport.addEventListener('click', ()=>{
      // ici tu peux appeler un endpoint d’export; pour l’instant un simple print
      window.print();
    });
  }
});

</script>

</body>

</html>