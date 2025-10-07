<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Activité</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* All the CSS you provided is included here, with shadow modifications */
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .header-section {
            margin-bottom: 20px;
        }

        .header-section h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            padding: 16px;
            border-radius: 8px;
            /* MODIFIED: Lighter shadow */
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            position: relative;
            /* Needed for positioning the actions button */
        }

        .card h3 {
            font-size: 21px;
            margin-bottom: 14px;
            font-weight: bold;
            border-bottom: 1px solid #eee;
            padding-bottom: 6px;
            margin-left: -15px;
            margin-right: -15px;
            margin-top: -19px;
            padding: 20px 25px;
            /* MODIFIED: Lighter shadow */
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            color: #2A2916;
        }

        .card-header-actions {
            position: absolute;
            top: 20px;
            right: 25px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .enabled {
            background: #9EB08F;
            color: #fff;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 13px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .parcours-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .parcours-table th,
        .parcours-table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 13px;
            text-align: center;
        }

        .parcours-table th {
            background-color: #f5f5f5;
            font-weight: 600;
        }

        .pdf-icon {
            width: 16px;
            vertical-align: middle;
            margin-right: 8px;
            color: #c60000;
        }

        .parcours-table a {
            color: #000000ff;
            font-weight: 300;
            text-align: left;
        }

        .parcours-table a:hover {
            text-decoration: underline;
        }

        #candidaturesTable,
        #participationTable {
            border: none !important;
            border-collapse: collapse;
            box-shadow: none !important;
        }

        #candidaturesTable th,
        #participationTable th {
            border: 0px solid #EBE9D7;
            font-size: 14px;
        }

        #candidaturesTable th:nth-child(2) {
            text-align: left;
        }

        #candidaturesTable td:nth-child(2) {
            text-align: left;
        }

        #candidaturesTable td,
        #participationTable td {
            border: 1px solid #EBE9D7;
            font-size: 14px;
        }

        #candidaturesTable thead,
        #participationTable thead {
            border: none !important;
            position: static;
            transform: translateY(-15px);
        }

        #candidaturesTable tbody tr:first-child td,
        #participationTable tbody tr:first-child td {
            border-top: 1px solid #EBE9D7 !important;
        }

        #candidaturesTable tbody tr:last-child td:first-child,
        #participationTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #candidaturesTable tbody tr:last-child td:last-child,
        #participationTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        #candidaturesTable tbody tr:first-child td:first-child,
        #participationTable tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
        }

        #candidaturesTable tbody tr:first-child td:last-child,
        #participationTable tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
        }

        #candidaturesTable,
        #participationTable {
            overflow: visible;
        }

        .status-bar-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 16px 24px;
            margin-bottom: 24px;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.07);
        }

        .status-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-header h2 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .card.full-width {
            border: 0px;
            margin-bottom: 20px;
        }

        .styled-list {
            list-style: none;
            padding: 0;
            margin: 0;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .styled-list li {
            padding: 16px 16px;
            border-bottom: 1px solid #dedcc9;
            display: flex;
            color: #333;
            gap: 200px;
        }

        .styled-list li:last-child {
            border-bottom: none;
        }

        .styled-list strong {
            font-weight: 600;
            color: #6E6D55;
            min-width: 240px;
            display: inline-block;
        }

        .parcours-table thead th {
            background-color: #ECEBE3;
            color: #333;
            font-weight: 600;
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .parcours-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            color: #444;
            vertical-align: middle;
            text-align: center;
        }

        .parcours-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-ordered-list {
            list-style: none;
            padding-left: 0;
            counter-reset: item-counter;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .custom-ordered-list li {
            counter-increment: item-counter;
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .custom-ordered-list li::before {
            content: counter(item-counter) ".";
            font-weight: bold;
            color: #c60000;
            margin-right: 10px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .add-doc-button {
            background-color: #fff;
            color: #c60000;
            border: 1px solid #c60000;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-doc-button:hover {
            background-color: #c60000;
            color: #fff;
        }

        #info-container,
        #docs-container,
        #participation-container {
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            margin: -19px -15px 14px -15px;
            border-bottom: 1px solid #eee;
            box-shadow: 0px 3px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header h3 {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
        }

        .search-bar {
            position: relative;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 8px 10px 8px 35px;
            /* Added padding for icon */
            border-radius: 5px;
            border: 1px solid #EBE9D7;
            width: 220px;
        }

        .search-bar .fa-search {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Modal Styles */
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

        .modal-overlay label {
            min-width: 100px;
            font-weight: 600;
            color: #6E6D55;
            flex-shrink: 0;
        }


        .popup-container {
            background-color: white;
            width: 400px;
            height: 100%;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }


        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-bottom: 20px;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 20px;
            box-shadow: 1px 1px 5px 0px #0000002d;
        }

        .popup-header h2 {
            font-size: 16px;
            margin: 0;
            color: #2A2916;
        }

        .popup-header-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-enregistrer {
            background-color: #BF0404;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-enregistrer:hover {
            background-color: #a00303;
        }

        .popup-form .btn-importer {
            background-color: #DBD9C3;
            color: #ffffffff !important;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            border-left: 1px solid #b5af8e;
            white-space: nowrap;
            border-radius: 0 7px 7px 0;
        }

        .popup-form .btn-importer i {
            font-size: 14px;
        }

        .popup-form .input-file-text {
            flex-grow: 1;
            border: none;
            padding: 10px 12px;
            background-color: transparent;
            color: #888;
            border-radius: 7px 0 0 7px !important;
        }

        .popup-form .input-file-text:focus {
            outline: none;
        }

        .popup-form .input-file-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            background-color: white;
            overflow: hidden;
            padding: 0;
        }

        .form-group-flex {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group-row {
            display: flex;
            gap: 15px;
        }

        .popup-form {
            padding-left: 25px;
            padding-right: 25px;
        }

        .popup-form input,
        .popup-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px;
        }

        .popup-form textarea {
            width: 100%;
            border: 1px solid #b5af8e;
            border-radius: 6px;
            padding: 12px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .date-input-container,
        .time-input-container {
            position: relative;
            width: 100%;
        }

        .date-input-container input,
        .time-input-container input {
            padding-right: 2.5rem;
        }

        .date-input-container .date-icon,
        .time-input-container .time-icon {
            position: absolute;
            right: 1rem;
            top: 68%;
            transform: translateY(-50%);
            color: #8c8c8c;
        }

        /* --- Custom Pagination Styles from pagination.php --- */
        :root {
            --pagination-border-color: #b60303;
            --pagination-text-color: #b60303;
            --pagination-border-radius: 12px;
            --pagination-border-width: 2px;
            --pagination-button-size: 40px;
            --pagination-active-bg: #b60303;
            --pagination-active-text: #ffffff;
            --pagination-hover-bg: #f8f8f8;
            --pagination-spacing: 8px;
        }

        .custom-pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: var(--pagination-spacing);
            margin: 20px 0;
            font-family: 'Inter', sans-serif;
        }

        .pagination-btn {
            width: var(--pagination-button-size);
            height: var(--pagination-button-size);
            border: var(--pagination-border-width) solid var(--pagination-border-color);
            background-color: white;
            color: var(--pagination-text-color);
            border-radius: var(--pagination-border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            user-select: none;
        }

        .pagination-btn:hover {
            background-color: var(--pagination-hover-bg);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(182, 3, 3, 0.2);
        }

        .pagination-btn:active {
            transform: translateY(0);
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-btn.active {
            background-color: var(--pagination-active-bg);
            color: var(--pagination-active-text);
            border-color: var(--pagination-active-bg);
        }

        .pagination-btn.active:hover {
            background-color: var(--pagination-active-bg);
            transform: none;
            box-shadow: none;
        }

        .pagination-page-number {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            padding: 0 4px;
            min-width: 30px;
            text-align: center;
        }

        /* Hide default DataTables pagination */
        .dataTables_paginate {
            display: none !important;
        }

        .paginate_button {
            display: none !important;
        }

        @media (max-width: 768px) {
            :root {
                --pagination-button-size: 35px;
                --pagination-spacing: 6px;
            }

            .pagination-btn {
                font-size: 14px;
            }

            .pagination-page-number {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="content-wrapper">

            <!-- Container 1: General Information and Description -->
            <div id="info-container">
                <div class="card full-width">
                    <h3>Informations générales</h3>
                    <div class="card-header-actions">
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" id="openModalModifier">Modifier</a></li>
                                <li><a class="dropdown-item" href="#">Publié</a></li>
                                <li><a class="dropdown-item" href="#">Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                    <ul class="styled-list">
                        <li><strong>Titre de l'activité :</strong> Interface cerveau-machine et apprentissage</li>
                        <li><strong>Type :</strong> Article</li>
                        <li><strong>Année :</strong> 2024</li>
                        <li><strong>Auteur principal :</strong> Dr. Sarra Messaoudi</li>
                        <li><strong>Statut :</strong> Publié</li>
                    </ul>

                    <h4 class="section-title">Description / Contenu</h4>
                    <ol class="custom-ordered-list">
                        <li>Analyser les signaux EEG en utilisant le Deep Learning pour détecter des anomalies.</li>
                        <li>Pré-traitement des signaux, modélisation CNN, validation croisée.</li>
                        <li>Identification précise de patterns EEG associés à certaines conditions.</li>
                    </ol>
                </div>
            </div>

            <!-- Container 2: Attached Documents -->
            <div id="docs-container">
                <div class="card full-width">
                    <div class="card-header">
                        <h3>Pièces jointes / Documents</h3>
                        <button class="add-doc-button">Ajouter un document</button>
                    </div>
                    <table class="parcours-table" id="candidaturesTable">
                        <thead>
                            <tr>
                                <th>Ref_Doc</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>
                                    <a href="#">
                                        <img width="20px" class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                            alt="pdf icon">
                                        article_act_sc.pdf
                                    </a>
                                </td>
                                <td>01/02/2024</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                            <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>
                                    <a href="#">
                                        <img width="20px" class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                            alt="pdf icon">
                                        Code_source_modèle
                                    </a>
                                </td>
                                <td>20/01/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                            <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>
                                    <a href="#">
                                        <img width="20px" class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                            alt="pdf icon">
                                        Présentation_slides
                                    </a>
                                </td>
                                <td>15/12/2024</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                            <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Container 3: Participation Requests -->
            <div id="participation-container">
                <div class="card full-width">
                    <div class="card-header">
                        <h3>Demandes de participation</h3>
                    </div>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Recherche" id="customSearchInput">
                    </div>
                    <table id="participationTable" class="parcours-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Nom et prenom</th>
                                <th>Domaine</th>
                                <th>Contact principal</th>
                                <th>Telephone</th>
                                <th>E-mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mr. Karim J.</td>
                                <td>IA Industrielle</td>
                                <td>+216 25 37 45 90</td>
                                <td>contact@ai-tech.com</td>
                                <td>contact@tech.com</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mr. Mourad J.</td>
                                <td>IA Industrielle</td>
                                <td>+216 25 37 45 90</td>
                                <td>contact@ai-tech.com</td>
                                <td>contact@tech.com</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Add more rows for testing pagination -->
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mme. Salma K.</td>
                                <td>Data Science</td>
                                <td>+216 98 12 34 56</td>
                                <td>salma@analytics.com</td>
                                <td>salma@analytics.com</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mr. Ahmed B.</td>
                                <td>Cybersecurity</td>
                                <td>+216 55 98 76 54</td>
                                <td>ahmed@secure.net</td>
                                <td>ahmed@secure.net</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mlle. Fatma Z.</td>
                                <td>Cloud Computing</td>
                                <td>+216 22 33 44 55</td>
                                <td>fatma@cloud.org</td>
                                <td>fatma@cloud.org</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                        alt="User Avatar" class="user-avatar"> Mr. Hichem G.</td>
                                <td>FinTech</td>
                                <td>+216 50 11 22 33</td>
                                <td>hichem@fin.tech</td>
                                <td>hichem@fin.tech</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">accepter</a></li>
                                            <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Custom Pagination HTML from pagination.php -->
                    <div class="custom-pagination" id="customPagination">
                        <button class="pagination-btn" id="firstPageBtn" title="Première page">
                            <i class="fa fa-angle-double-left"></i>
                        </button>
                        <button class="pagination-btn" id="prevPageBtn" title="Page précédente">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <span class="pagination-page-number" id="currentPageNumber">1</span>
                        <button class="pagination-btn" id="nextPageBtn" title="Page suivante">
                            <i class="fa fa-angle-right"></i>
                        </button>
                        <button class="pagination-btn" id="lastPageBtn" title="Dernière page">
                            <i class="fa fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals remain here -->
    <div class="modal-overlay" id="modalAjouterDoc" style="display: none;">
        <!-- ... modal content ... -->
    </div>
    <div class="modal-overlay" id="editActivityModal" style="display: none;">
        <!-- ... modal content ... -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <script>
        // --- Reusable Pagination Functions from pagination.php ---
        window.PMOPagination = {
            instances: [],
            init: function (dataTable, container) {
                const containerEl = typeof container === 'string' ? document.querySelector(container) : (
                    container || document.querySelector('.custom-pagination'));
                if (!dataTable || !containerEl) return;

                const instance = {
                    dt: dataTable,
                    container: containerEl
                };
                this.instances.push(instance);

                if (typeof dataTable.on === 'function') {
                    dataTable.off('draw.PMOPagination');
                    dataTable.on('draw.PMOPagination', () => {
                        PMOPagination.update(instance);
                    });
                }

                this.bindEvents(instance);
                this.update(instance);
            },
            bindEvents: function (instance) {
                const {
                    container,
                    dt
                } = instance;
                const firstBtn = container.querySelector('#firstPageBtn');
                const prevBtn = container.querySelector('#prevPageBtn');
                const nextBtn = container.querySelector('#nextPageBtn');
                const lastBtn = container.querySelector('#lastPageBtn');

                if (firstBtn) firstBtn.onclick = (e) => {
                    e.preventDefault();
                    if (dt && !firstBtn.disabled) dt.page('first').draw('page');
                };
                if (prevBtn) prevBtn.onclick = (e) => {
                    e.preventDefault();
                    if (dt && !prevBtn.disabled) dt.page('previous').draw('page');
                };
                if (nextBtn) nextBtn.onclick = (e) => {
                    e.preventDefault();
                    if (dt && !nextBtn.disabled) dt.page('next').draw('page');
                };
                if (lastBtn) lastBtn.onclick = (e) => {
                    e.preventDefault();
                    if (dt && !lastBtn.disabled) dt.page('last').draw('page');
                };
            },
            update: function (instance) {
                if (!instance || !instance.dt || !instance.container) return;
                try {
                    const {
                        container,
                        dt
                    } = instance;
                    const info = dt.page.info();
                    const firstBtn = container.querySelector('#firstPageBtn');
                    const prevBtn = container.querySelector('#prevPageBtn');
                    const nextBtn = container.querySelector('#nextPageBtn');
                    const lastBtn = container.querySelector('#lastPageBtn');
                    const currentPage = container.querySelector('#currentPageNumber');

                    if (!firstBtn || !prevBtn || !nextBtn || !lastBtn || !currentPage) return;

                    currentPage.textContent = info.page + 1;

                    const isFirstPage = info.pages <= 1 || info.page === 0;
                    const isLastPage = info.pages <= 1 || info.page >= info.pages - 1;

                    firstBtn.disabled = isFirstPage;
                    prevBtn.disabled = isFirstPage;
                    nextBtn.disabled = isLastPage;
                    lastBtn.disabled = isLastPage;

                    firstBtn.classList.toggle('disabled', isFirstPage);
                    prevBtn.classList.toggle('disabled', isFirstPage);
                    nextBtn.classList.toggle('disabled', isLastPage);
                    lastBtn.classList.toggle('disabled', isLastPage);

                    container.style.display = info.pages > 1 ? 'flex' : 'none';

                } catch (error) {
                    console.error('Error updating pagination:', error);
                }
            },
        };

        $(document).ready(function () {
            // Initialize the DataTable for the participation table
            const table = $('#participationTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                // THIS IS IMPORTANT: it removes the default datatables pagination controls
                dom: 'rt',
                language: {
                    emptyTable: "Aucune donnée disponible",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                },
                initComplete: function () {
                    $('.dataTables_filter').hide();
                }
            });

            // --- CONNECT PAGINATION TO DATATABLE ---
            // Initialize our custom pagination for the 'participationTable' instance
            PMOPagination.init(table, '#participation-container .custom-pagination');

            // Custom search functionality
            $('#customSearchInput').on('keyup', function () {
                table.search(this.value).draw();
            });

            // "Check all" functionality
            $('#checkAll').on('click', function () {
                const rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // The rest of your modal and form JavaScript remains unchanged...
        });
    </script>
</body>

</html>