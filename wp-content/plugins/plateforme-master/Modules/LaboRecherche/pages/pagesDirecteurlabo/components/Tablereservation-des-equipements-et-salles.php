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
        font-family: 'Segoe UI', sans-serif;
        padding: 20px;
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
    }

    .tab-btn:not(:last-child) {
        border-right: 1px solid #ddd;
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
        font-size: 20px;
        cursor: pointer;
        padding: 5px;
        width: 36px;
        height: 36px;
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
        color: #A6A485;
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

    #btn-importer {
        border-radius: 0px 7px 7px 0px;
        position: absolute;
        right: 15px;
        bottom: 0px;
        transform: translate(15px, 5px);
        background-color: #A6A485;
        padding: 9px;
        color: white;
    }
    </style>
</head>

<body>

    <div class="content-block">
        <div class="accordion-container">
            <!-- Tabs -->
            <div class="accordion-tabs">
                <button class="tab-btn active" data-tab="tab1">
                    <img src="/wp-content/plugins/plateforme-master/imagesED/7050930.png" alt="Icon">
                    Tableau Des Réservations
                </button>
                <button class="tab-btn" data-tab="tab2">
                    <img src="/wp-content/plugins/plateforme-master/imagesED/10550857.png" alt="Icon">
                    Mes Equipements
                </button>
            </div>

            <div class="accordion-content">

                <!-- Tab 1: Reservations -->
                <div class="tab-panel active" id="tab1">
                    <div class="table-controls">
                        <div class="filter-selectgb">
                            <div class="search-box">
                                <i class="fa fa-search"></i>
                                <input type="text" class="filter-input" id="reservationsSearch"
                                    placeholder="Recherchez...">
                            </div>
                            <select class="filter-select">
                                <option>Statut</option>
                                <option>Validée</option>
                                <option>Refusée</option>
                                <option>En attente</option>
                            </select>
                            <div class="date-input-container">
                                <input type="text" class="date-input" placeholder="Date" onfocus="(this.type='date')"
                                    onblur="(this.type='text')">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="filter-actions">
                            <button class="btn-statut" id="openReservationModal">Nouveau réservation</button>
                            <button class="icon-btn"><i class="fa fa-filter"></i></button>
                            <button class="icon-btn"><i class="fa fa-download"></i></button>
                        </div>
                    </div>

                    <table class="styled-table" id="reservationsTable">
                        <thead>
                            <tr style="margin:100px;">
                                <th><input type="checkbox"></th>
                                <th>Type</th>
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
                                <td><span class="badge badge-success"> <i class="fa-regular fa-circle-check"
                                            style="color: #198754;"></i>Validée</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#">Modifier</a>
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
                                <td><span class="badge badge-danger"> <i class="fa-regular fa-circle-stop"
                                            style="color: #d71920;"></i>Refusée</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#">Modifier</a>
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
                                <td><span class="badge badge-warning"> <i class="fa-regular fa-clock"
                                            style="color: #d89e00;"></i>En attente</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#">Modifier</a>
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
                            <select class="filter-select">
                                <option>Catégorie</option>
                                <option>Microscope</option>
                                <option>Centrifugeuse</option>
                            </select>
                            <div class="filter-buttons">
                                <button class="filter-btn active">Tous</button>
                                <button class="filter-btn">Disponibles</button>
                                <button class="filter-btn">Reservés</button>
                            </div>
                        </div>
                        <div class="filter-actions">
                            <button class="btn-statut" id="openEquipementModal">Ajouter équipement</button>
                            <button class="icon-btn"><i class="fa fa-filter"></i></button>
                            <button class="icon-btn"><i class="fa fa-download"></i></button>
                        </div>
                    </div>

                    <table class="styled-table" id="equipementsTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Nom</th>
                                <th>Modèle</th>
                                <th>Statut</th>
                                <th>Disponibilité</th>
                                <th>Dernier entretien</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Microscope X</td>
                                <td>MX2000</td>
                                <td class="status-icon"><i class="fa-solid fa-triangle-exclamation"
                                        style="color: #BF0404;"></i></td>
                                <td>-</td>
                                <td>12-09-2025</td>
                                <td class="details-icon openDetailsModal"><i class="fa fa-eye"></i></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#"><i class="fa fa-file-alt"></i> Protocole d'utilisation</a>
                                            <a href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="#" class="openMaintenanceModal"><i class="fa fa-wrench"></i>
                                                Demande de maintenance</a>
                                            <a href="#" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Centrifugeuse</td>
                                <td>Eppendorf 5702</td>
                                <td class="status-icon"><i class="fa fa-check-circle" style="color: #A6A485;"></i></td>
                                <td>Reservé</td>
                                <td>12-09-2025</td>
                                <td class="details-icon openDetailsModal"><i class="fa fa-eye"></i></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#"><i class="fa fa-file-alt"></i> Protocole d'utilisation</a>
                                            <a href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="#" class="openMaintenanceModal"><i class="fa fa-wrench"></i>
                                                Demande de maintenance</a>
                                            <a href="#" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Spectrophotomètre</td>
                                <td>UV-Vis Thermo Scientific</td>
                                <td class="status-icon"><i class="fa fa-check-circle" style="color: #A6A485;"></i></td>
                                <td>Disponible</td>
                                <td>12-09-2025</td>
                                <td class="details-icon openDetailsModal"><i class="fa fa-eye"></i></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#"><i class="fa fa-file-alt"></i> Protocole d'utilisation</a>
                                            <a href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="#" class="openMaintenanceModal"><i class="fa fa-wrench"></i>
                                                Demande de maintenance</a>
                                            <a href="#" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Bain-Marie</td>
                                <td>Julabo TW12</td>
                                <td class="status-icon"><i class="fa-solid fa-screwdriver-wrench"
                                        style="color: #DDACA7;"></i></td>
                                <td>-</td>
                                <td>12-09-2025</td>
                                <td class="details-icon openDetailsModal"><i class="fa fa-eye"></i></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#"><i class="fa fa-file-alt"></i> Protocole d'utilisation</a>
                                            <a href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="#" class="openMaintenanceModal"><i class="fa fa-wrench"></i>
                                                Demande de maintenance</a>
                                            <a href="#" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Four de Laboratoire</td>
                                <td>Memmert UF110</td>
                                <td class="status-icon"><i class="fa-solid fa-screwdriver-wrench"
                                        style="color: #DDACA7;"></i></td>
                                <td>-</td>
                                <td>12-09-2025</td>
                                <td class="details-icon openDetailsModal"><i class="fa fa-eye"></i></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn">⋮</button>
                                        <div class="dropdown-menu">
                                            <a href="#"><i class="fa fa-file-alt"></i> Protocole d'utilisation</a>
                                            <a href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="#" class="openMaintenanceModal"><i class="fa fa-wrench"></i>
                                                Demande de maintenance</a>
                                            <a href="#" style="color:#BF0404;"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modalObjectifs" style="display: none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Nouveau Réservation</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Envoyer la demande</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="type-reservation">Type</label>
                    <select id="type-reservation">
                        <option>Equipement</option>
                        <option>Salle</option>
                    </select>
                </div>
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
                            <i class="fa fa-calendar"></i>
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

    <div class="modal-overlay" id="modalAjouterEquipement" style="display: none;">
        <div class="popup-container" id="popupContainerEquipement">
            <div class="popup-header">
                <h2>Ajouter appareil</h2>
                <button class="btn-enregistrer">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label>Catégorie Des Equipements</label>
                    <select>
                        <option>Catégorie Des Equipements</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nom de l'appareil</label>
                    <input type="text" placeholder="Nom de l'appareil">
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
                    <select>
                        <option>Statut</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Disponibilité</label>
                    <select>
                        <option>Disponibilité</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Protocole d'utilisation</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Protocole d'utilisation" readonly>
                        <label class="btn-importer" id="btn-importer"><i class="fa fa-upload"></i> Importer <input
                                type="file" style="display: none;"></label>
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
                        <label class="btn-importer" id="btn-importer"><i class="fa fa-upload"></i> Importer <input
                                type="file" style="display: none;"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Périodicité</label>
                    <select>
                        <option>Périodicité</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Consignes</label>
                    <input type="text" placeholder="Consignes">
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalMaintenance" style="display: none;">
        <div class="popup-container" id="popupContainerMaintenance">
            <div class="popup-header">
                <h2>Demande de maintenance</h2>
                <button class="btn-enregistrer">Envoyer la demande</button>
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
                        <label class="btn-importer" id="btn-importer"><i class="fa fa-upload"></i> Importer <input
                                type="file" style="display: none;"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Photo de l'équipement</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="importer les photos..." readonly>
                        <label class="btn-importer" id="btn-importer"><i class="fa fa-upload"></i> Importer <input
                                type="file" style="display: none;"></label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalDetailsAppareil" style="display: none;">
        <div class="popup-container" id="popupContainerDetailsAppareil">
            <div class="popup-header">
                <h2>Details appareil</h2>
                <button class="btn-close-x">X</button>
            </div>
            <div class="details-modal-content">
                <div class="detail-item">
                    <label>Categorie :</label>
                    <p>Équipements De Laboratoire / Scientifique</p>
                </div>
                <div class="detail-item">
                    <label>Nom de l'appareil :</label>
                    <p>Spectrophotomètre</p>
                </div>
                <div class="detail-item">
                    <label>Modèle :</label>
                    <p>UV-Vis Thermo Scientific</p>
                </div>
                <div class="detail-item">
                    <label>Spécification technique :</label>
                    <p>Plage spectrale : 190 – 1100 nm<br>
                        Bande passante spectrale : 1,8 nm<br>
                        Source lumineuse :<br>
                        Lampe au deutérium (UV)<br>
                        Lampe au tungstène-halogène (visible)<br>
                        Détecteur : Photodiode en silicium double faisceau<br>
                        Exactitude de longueur d'onde : ±1 nm<br>
                        Précision photométrique : ±0.005 A à 1 A</p>
                </div>
                <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
                <div class="detail-item">
                    <label>Conditions d'entretien :</label>
                </div>
                <div class="detail-item">
                    <label>Statut :</label>
                    <p>En Service</p>
                </div>
                <div class="detail-item">
                    <label>Disponibilité :</label>
                    <p>Disponible</p>
                </div>
                <div class="detail-item">
                    <label>Protocole d'utilisation :</label>
                    <div class="file-download-link">
                        <span><i class="fa fa-file-pdf"></i> Protocole.Pdf</span>
                        <i class="fa fa-download download-icon"></i>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Contrat :</label>
                    <div class="file-download-link">
                        <span><i class="fa fa-file-pdf"></i> Contrat.Pdf</span>
                        <i class="fa fa-download download-icon"></i>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Périodicité :</label>
                    <p>Trimestriel</p>
                </div>
                <div class="detail-item">
                    <label>Consignes :</label>
                    <p>-</p>
                </div>
            </div>
            <div class="details-modal-footer">
                <button class="btn-history openHistoryModal"><i class="fa fa-wrench"></i> Historique des
                    maintenances</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modalHistorique" style="display: none;">
        <div class="popup-container" id="popupContainerHistorique">
            <div class="popup-header">
                <h2><i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 15px;"></i>Historique des
                    maintenances</h2>
                <button class="btn-close-x">X</button>
            </div>
            <div class="details-modal-content">
                <div class="maintenance-history-item">
                    <span>14/02/2023</span>
                    <button class="btn-download-report">Télécharger Le Rapport</button>
                </div>
                <div class="maintenance-history-item">
                    <span>19/03/2023</span>
                    <button class="btn-download-report">Télécharger Le Rapport</button>
                </div>
                <div class="maintenance-history-item">
                    <span>14/05/2023</span>
                    <button class="btn-download-report">Télécharger Le Rapport</button>
                </div>
                <div class="maintenance-history-item">
                    <span>04/08/2023</span>
                    <button class="btn-download-report">Télécharger Le Rapport</button>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    $(document).ready(function() {
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
                emptyTable: "Aucune donnée disponible"
            },
            columnDefs: [{
                "orderable": false,
                "targets": [0, 7]
            }]
        });

        // Custom search for reservations table
        $('#reservationsSearch').on('keyup', function() {
            reservationsTable.search(this.value).draw();
        });

        // Initialize DataTable for the equipments table
        $('#equipementsTable').DataTable({
            paging: true,
            searching: false, // We use custom filters, so disable default search
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 't<"bottom"p>',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible"
            },
            columnDefs: [{
                "orderable": false,
                "targets": [0, 6, 7]
            }]
        });

        // Tab switching logic
        $('.tab-btn').on('click', function() {
            const tabId = $(this).data('tab');
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
            $('.tab-panel').removeClass('active');
            $('#' + tabId).addClass('active');
        });

        // Filter button logic
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            // Add filtering logic here based on the button clicked
        });

        // Dropdown menu logic for both tables
        $(document).on('click', '.action-btn', function(e) {
            e.stopPropagation();
            let dropdown = $(this).closest('.actions').find('.dropdown-menu');
            $('.dropdown-menu').not(dropdown).hide(); // Hide other menus
            dropdown.toggle(); // Toggle current menu
        });

        // Close dropdowns when clicking outside
        $(document).on('click', function() {
            $('.dropdown-menu').hide();
        });

        // Open reservation modal
        $('#openReservationModal').on('click', function() {
            openmodalObjectifs();
        });

        // Open equipement modal
        $('#openEquipementModal').on('click', function() {
            openModalAjouterEquipement();
        });

        // Open maintenance modal
        $(document).on('click', '.openMaintenanceModal', function(e) {
            e.preventDefault();
            openModalMaintenance();
        });

        // Open details modal
        $(document).on('click', '.openDetailsModal', function() {
            openModalDetailsAppareil();
        });

        // Open history modal
        $(document).on('click', '.openHistoryModal', function() {
            openModalHistorique();
        });

        // Generic modal close logic
        $('.modal-overlay').on('click', function(e) {
            if ($(e.target).is('.modal-overlay')) {
                $(this).hide();
            }
        });
        $('.btn-close-x').on('click', function() {
            $(this).closest('.modal-overlay').hide();
        });

    });

    function openmodalObjectifs() {
        $('#modalObjectifs').css('display', 'flex');
    }

    function openModalAjouterEquipement() {
        $('#modalAjouterEquipement').css('display', 'flex');
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
</body>

</html>