<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Master</title>

    <!-- External CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            /* padding: 20px; */
        }

        .content-block {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
            height: auto;
            /* max-width: 1200px; */
            /* margin: auto; */
        }

        /* Accordion and Tabs */
        .accordion-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0, 0, 0, .05);
        }

        .accordion-tabs {
            display: flex;
            background: #f3f3f3;
            border-radius: 10px 10px 0 0;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            font-weight: 600;
            border: none;
            background: #A6A485;
            cursor: pointer;
            font-size: 20px;
            transition: .3s;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .tab-btn:first-child {
            border-top-left-radius: 10px;
            margin-right: 10px;
        }

        .tab-btn {
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }

        .tab-btn:last-child {
            border-top-right-radius: 10px;
        }

        .tab-btn.active {
            background: #fff;
            color: #2A2916;
        }

        .accordion-content {
            padding: 25px 25px 35px;
            background: #fff;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /* Table Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 30px;
        }

        .filters-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
        }

        .ctl {
            --ctl-h: 38px;
            --ctl-br: 8px;
            --ctl-border: #ddd;
            --ctl-text: #333;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            height: var(--ctl-h);
            padding: 0 12px;
            border: 1px solid var(--ctl-border);
            border-radius: var(--ctl-br);
            background: #fff;
        }

        .ctl input,
        .ctl select {
            height: calc(var(--ctl-h) - 2px);
            border: 0;
            outline: 0;
            background: transparent;
            font-size: 14px;
            color: var(--ctl-text);
        }

        .ctl i {
            color: #888;
        }

        .ctl-search {
            min-width: 200px;
        }

        .ctl-select {
            min-width: 180px;
        }

        .ctl-select select {
            appearance: none;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-title-text {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-title img {
            width: 24px;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons button {
            background: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .upload-btn {
            background-color: #c60000;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Table Styling */
        .styled-table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        .styled-table thead {
            background: #EBE9D7;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px;
            border: 1px solid #eee;
            text-align: left;
            vertical-align: middle;
        }

        .styled-table th {
            font-weight: 600;
        }

        .styled-table td img {
            width: 18px;
            display: block;
        }

        /* DataTables Pagination Styling */
        .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 5px;
            margin-top: 20px;
        }

        .dataTables_paginate .paginate_button {
            border: 1px solid #ddd;
            background: #fff;
            padding: 5px 12px;
            cursor: pointer;
            border-radius: 4px;
            user-select: none;
        }

        .dataTables_paginate .paginate_button.disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #A6A485;
            color: white;
            border-color: #A6A485;
        }

        /* History Section */
        .history-section {
            margin-top: 40px;
        }

        .history-header {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .history-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .history-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }

        .history-item {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .history-item a {
            text-decoration: underline;
            color: #337ab7;
        }

        /* --- Action Dropdown Menu Styles --- */
        .action-menu-container {
            position: relative;
            display: inline-block;
        }

        .action-menu-trigger {
            cursor: pointer;
        }

        .action-menu {
            display: none;
            /* Hidden by default */
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 5px;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
            z-index: 10;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .action-menu a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .action-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Red color for delete option */
        .action-menu a:last-child {
            color: #c60000;
        }

        .action-menu.show {
            display: block;
            /* Class to show the menu */
        }

        /* --- Modal Styles --- */
        .btn-close-x {
            background: transparent;
            border: none;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            padding: 4px 10px;
            line-height: 1;
            transition: color 0.2s ease;
            margin-left: auto;
        }

        .btn-close-x:hover {
            color: #c40000;
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
            width: 450px;
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
            display: flex;
            flex-direction: column;
            gap: 15px;
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

        .popup-form input,
        .popup-form select,
        .popup-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px;
            box-sizing: border-box;
            /* Added for consistent sizing */
        }

        .popup-form input:last-child {
            border-radius: 7px;
        }

        .popup-form textarea {
            min-height: 80px;
            resize: vertical;
        }

        .input-file-wrapper {
            display: flex;
            align-items: center;
            /* border: 1px solid #b5af8e; */
            border: none;
            border-radius: 7px;
            overflow: hidden;
            width: 100%;
            background-color: white;
        }

        .input-file-text {
            flex-grow: 1;
            padding: 10px;
            border: none;
            font-size: 14px;
            color: #555;
            background-color: transparent;
            outline: none;
        }

        .modal-overlay label:last-child {
            color: #fff !important;
        }

        .btn-importer {
            background-color: #b5af8e;
            color: white;
            padding: 11px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-importer i {
            font-size: 14px;
        }



        .modal-overlay label {
            font-weight: 600;
            color: #6E6D55;
            /* margin-bottom: 5px; */
            display: block;
        }

        .ql-toolbar.ql-snow {
            border-radius: 6px 6px 0 0;
            background-color: #ecebe3;
            border: 1px solid #DBD9C3;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            padding: 8px;
        }

        .ql-container.ql-snow {
            border-radius: 0 0 6px 6px;
            font-size: 14px;
        }

        .ql-editor.ql-blank {
            border: 1px solid #DBD9C3;
        }


        #table1,
        #table2 {
            border: none !important;
            border-collapse: collapse;
            box-shadow: none !important;
        }

        #table1 th,
        #table2 th {
            border: 0px solid #EBE9D7;
        }

        #table1 td,
        #table2 td {
            border: 1px solid #EBE9D7;
        }

        #table1 thead,
        #table2 thead {
            border: none !important;
            position: static;
            transform: translateY(-15px);
        }

        #table1 tbody tr:first-child td,
        #table2 tbody tr:first-child td {
            border-top: 1px solid #EBE9D7 !important;
        }

        #table1,
        #table2 {
            border-collapse: separate;
            border-spacing: 0;
        }

        #table1 thead tr:first-child th:first-child,
        #table2 thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        #table1 thead tr:first-child th:last-child,
        #table2 thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;

        }

        #table1 tbody tr:last-child td:first-child,
        #table2 tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #table1 tbody tr:last-child td:last-child,
        #table2 tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        #table1 tbody tr:first-child td:first-child,
        #table2 tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
        }

        #table1 tbody tr:first-child td:last-child,
        #table2 tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="content-block">
        <div class="accordion-container">

            <!-- Tabs -->
            <div class="accordion-tabs">
                <button class="tab-btn active" data-tab="tab1">Tous les documents</button>
                <button class="tab-btn" data-tab="tab2">Mes Documents</button>
            </div>

            <div class="accordion-content">

                <!-- ========= TAB 1: All Documents ========= -->
                <div id="tab1" class="tab-panel active">
                    <div class="header-title">
                        <div class="header-title-text">
                            <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png"
                                alt="10550857">
                            <span>Liste des documents électroniques</span>
                        </div>
                    </div>
                    <div class="table-controls">
                        <div class="filters-row">
                            <label class="ctl ctl-search">
                                <input type="text" id="searchInput1" placeholder="Recherchez...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                            <label class="ctl ctl-select">
                                <select id="categoryFilter1">
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </label>
                        </div>
                        <div class="action-icons">
                            <button>
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                                    alt="Icon-funnel">
                                <!-- <i class="fa-solid fa-filter"></i> -->
                            </button>
                            <button>
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                    alt="Icon-upload-">
                                <!-- <i class="fa-solid fa-download"></i> -->
                            </button>
                        </div>
                    </div>

                    <!-- Table 1 -->
                    <table id="table1" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll1"></th>
                                <th>Référence</th>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Date d'ajout</th>
                                <th>Dernière modification</th>
                                <th>Fichier</th>
                                <th>Ajouté par</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0001</td>
                                <td>Convention de Partenariat</td>
                                <td>Administratif</td>
                                <td>12-03-2025</td>
                                <td>12-03-2025</td>
                                <td><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="PDF"></td>
                                <td>UTM</td>
                                <td>
                                    <img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-undo.png"
                                        alt="27) Icon-undo">
                                    <!-- <i class="fa-solid fa-eye"></i> -->


                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0002</td>
                                <td>Rapport Financier</td>
                                <td>Financier</td>
                                <td>12-12-2024</td>
                                <td>12-12-2024</td>
                                <td>
                                    <img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="PDF">
                                </td>
                                <td>Coordinateur</td>
                                <td>

                                    <img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-undo.png"
                                        alt="27) Icon-undo">
                                    <!-- <i class="fa-solid fa-eye"></i> -->
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0003</td>
                                <td>Plan Stratégique</td>
                                <td>Stratégique</td>
                                <td>01-02-2025</td>
                                <td>01-02-2025</td>
                                <td><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/excel-document.png"
                                        alt="excel"></td>
                                <td>Service Master</td>
                                <td>
                                    <img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-undo.png"
                                        alt="27) Icon-undo">
                                    <!-- <i class="fa-solid fa-eye"></i> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="history-section">
                        <!-- History content remains the same -->
                    </div>
                </div>


                <!-- ========= TAB 2: My Documents ========= -->
                <div id="tab2" class="tab-panel">
                    <div class="header-title">
                        <div class="header-title-text">
                            <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png"
                                alt="10550857">
                            <span>Liste des documents électroniques</span>
                        </div>
                        <button class="upload-btn" onclick="openmodalObjectifs()"><i class="fa-solid fa-plus"></i>
                            Téléverser un document</button>
                    </div>
                    <div class="table-controls">
                        <div class="filters-row">
                            <label class="ctl ctl-search">
                                <input type="text" id="searchInput2" placeholder="Recherchez...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                            <label class="ctl ctl-select">
                                <select id="categoryFilter2">
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </label>
                        </div>
                        <div class="action-icons">
                            <button>
                                <!-- <i class="fa-solid fa-filter"></i> -->
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                                    alt="Icon-funnel">
                            </button>
                            <button>
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                    alt="Icon-upload-">
                                <!-- <i class="fa-solid fa-download"></i> -->
                            </button>
                        </div>
                    </div>

                    <!-- Table 2 -->
                    <table id="table2" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll2"></th>
                                <th>Référence</th>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Date d'ajout</th>
                                <th>Dernière modification</th>
                                <th>Fichier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0001</td>
                                <td>Convention de Partenariat</td>
                                <td>Administratif</td>
                                <td>12-03-2025</td>
                                <td>12-03-2025</td>
                                <td><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="PDF"></td>
                                <td>
                                    <div class="action-menu-container">
                                        <i class="fa-solid fa-ellipsis action-menu-trigger"></i>
                                        <div class="action-menu">
                                            <a href="#" class="edit-doc-btn"><i class="fa-solid fa-pencil"></i>
                                                Modifier</a>
                                            <a href="#"><i class="fa-solid fa-share-nodes"></i> Partager</a>
                                            <a href="#"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0002</td>
                                <td>Rapport Financier</td>
                                <td>Financier</td>
                                <td>12-12-2024</td>
                                <td>12-12-2024</td>
                                <td><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="PDF"></td>
                                <td>
                                    <div class="action-menu-container">
                                        <i class="fa-solid fa-ellipsis action-menu-trigger"></i>
                                        <div class="action-menu">
                                            <a href="#" class="edit-doc-btn"><i class="fa-solid fa-pencil"></i>
                                                Modifier</a>
                                            <a href="#"><i class="fa-solid fa-share-nodes"></i> Partager</a>
                                            <a href="#"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>0003</td>
                                <td>Plan Stratégique</td>
                                <td>Stratégique</td>
                                <td>01-02-2025</td>
                                <td>01-02-2025</td>
                                <td><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/excel-document.png"
                                        alt="Excel"></td>
                                <td>
                                    <div class="action-menu-container">
                                        <i class="fa-solid fa-ellipsis action-menu-trigger"></i>
                                        <div class="action-menu">
                                            <a href="#" class="edit-doc-btn"><i class="fa-solid fa-pencil"></i>
                                                Modifier</a>
                                            <a href="#"><i class="fa-solid fa-share-nodes"></i> Partager</a>
                                            <a href="#"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="history-section">
                        <!-- History content remains the same -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Document Modal -->
    <div class="modal-overlay" id="modalObjectifs" style="display: none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Ajouter un document</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div>
                    <label for="doc-categorie">Catégorie</label>
                    <select id="doc-categorie" name="doc-categorie">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Financier">Financier</option>
                        <option value="Stratégique">Stratégique</option>
                    </select>
                </div>
                <div>
                    <label for="doc-titre">Titre</label>
                    <input type="text" id="doc-titre" name="doc-titre" placeholder="Titre">
                </div>
                <div>
                    <label for="doc-description">Description</label>
                    <textarea id="doc-description" name="doc-description" placeholder="Description"></textarea>
                </div>
                <div>
                    <label for="doc-file">Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Pièce jointe" readonly>
                        <label for="file-upload-input" class="btn-importer">
                            <!-- <i class="fa-solid fa-upload"></i> -->
                            Importer
                        </label>
                        <input type="file" id="file-upload-input" style="display: none;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Document Modal -->
    <div class="modal-overlay" id="modalModifier" style="display: none;">
        <div class="popup-container" id="popupContainerModifier">
            <div class="popup-header">
                <h2>Modifier le document</h2>
                <button class="btn-enregistrer" id="btnUpdateDoc">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div>
                    <label for="edit-doc-categorie">Catégorie</label>
                    <select id="edit-doc-categorie" name="edit-doc-categorie">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Financier">Financier</option>
                        <option value="Stratégique">Stratégique</option>
                    </select>
                </div>
                <div>
                    <label for="edit-doc-titre">Titre</label>
                    <input type="text" id="edit-doc-titre" name="edit-doc-titre" placeholder="Titre">
                </div>
                <div>
                    <label for="edit-doc-description">Description</label>
                    <textarea id="edit-doc-description" name="edit-doc-description"
                        placeholder="Description"></textarea>
                </div>
                <div>
                    <label for="edit-doc-file">Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Pièce jointe" readonly>
                        <label for="edit-file-upload-input" class="btn-importer">
                            <!-- <i class="fa-solid fa-upload"></i>  -->
                            Importer
                        </label>
                        <input type="file" id="edit-file-upload-input" style="display: none;">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // --- Tab Switching Logic ---
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
                button.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // --- DataTables and Checkbox Logic ---
        $(document).ready(function () {
            // DataTables configuration object
            const dataTableOptions = {
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 'rtp',
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                        next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                }
            };

            // Initialize DataTables for both tables
            const table1 = $('#table1').DataTable(dataTableOptions);
            const table2 = $('#table2').DataTable(dataTableOptions);

            // Link custom search inputs to DataTables search functionality
            $('#searchInput1').on('keyup', function () {
                table1.search(this.value).draw();
            });

            $('#searchInput2').on('keyup', function () {
                table2.search(this.value).draw();
            });

            // --- Category Filter Functionality ---
            function setupCategoryFilter(tableInstance, filterSelectId) {
                const filterSelect = $(`#${filterSelectId}`);
                filterSelect.html('<option value="">Toutes les catégories</option>');
                tableInstance.column(3).data().unique().sort().each(function (d, j) {
                    filterSelect.append(`<option value="${d}">${d}</option>`);
                });
                filterSelect.on('change', function () {
                    const val = $.fn.dataTable.util.escapeRegex($(this).val());
                    tableInstance.column(3)
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
            }

            setupCategoryFilter(table1, 'categoryFilter1');
            setupCategoryFilter(table2, 'categoryFilter2');


            // --- Check All Functionality ---
            function setupCheckAll(checkAllId, tableInstance) {
                $(`#${checkAllId}`).on('click', function () {
                    const isChecked = $(this).is(':checked');
                    tableInstance.rows({
                        search: 'applied'
                    }).nodes().to$().find('.row-checkbox').prop('checked', isChecked);
                });

                tableInstance.on('draw', function () {
                    updateCheckAllState();
                });

                function updateCheckAllState() {
                    const allCheckboxes = tableInstance.rows({
                        search: 'applied'
                    }).nodes().to$().find('.row-checkbox');
                    const checkedCheckboxes = tableInstance.rows({
                        search: 'applied'
                    }).nodes().to$().find('.row-checkbox:checked');

                    if (allCheckboxes.length > 0 && allCheckboxes.length === checkedCheckboxes.length) {
                        $(`#${checkAllId}`).prop('checked', true);
                    } else {
                        $(`#${checkAllId}`).prop('checked', false);
                    }
                }

                tableInstance.rows().nodes().to$().find('.row-checkbox').on('change', function () {
                    updateCheckAllState();
                });
            }

            setupCheckAll('checkAll1', table1);
            setupCheckAll('checkAll2', table2);

            // --- Action Dropdown Menu Logic ---
            $('#table2 tbody').on('click', '.action-menu-trigger', function (e) {
                e.stopPropagation();
                const currentMenu = $(this).next('.action-menu');
                $('.action-menu').not(currentMenu).removeClass('show');
                currentMenu.toggleClass('show');
            });

            $(window).on('click', function () {
                if ($('.action-menu').hasClass('show')) {
                    $('.action-menu').removeClass('show');
                }
            });

            // --- File Input Logic ---
            $('#file-upload-input').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $('.input-file-text').first().val(fileName);
            });

            $('#edit-file-upload-input').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $('#modalModifier .input-file-text').val(fileName);
            });

            // --- Edit Modal Trigger ---
            $('#table2 tbody').on('click', '.edit-doc-btn', function (e) {
                e.preventDefault();

                // Get data from the table row
                const row = $(this).closest('tr');
                const title = row.find('td:eq(2)').text();
                const category = row.find('td:eq(3)').text();

                // Populate the edit modal
                $('#edit-doc-titre').val(title);
                $('#edit-doc-categorie').val(category);
                $('#edit-doc-description').val("Description for " + title); // Placeholder description

                openModalModifier();
            });

        });

        // --- Modal Logic ---
        function openmodalObjectifs() {
            const modal = document.getElementById("modalObjectifs");
            if (modal) {
                modal.style.display = "flex";
            } else {
                console.error("Modal not found: #modalObjectifs");
            }
        }

        function closeModalObjectifs() {
            const modal = document.getElementById("modalObjectifs");
            if (modal) {
                modal.style.display = "none";
            }
        }

        function openModalModifier() {
            const modal = document.getElementById("modalModifier");
            if (modal) {
                modal.style.display = "flex";
            } else {
                console.error("Modal not found: #modalModifier");
            }
        }

        function closeModalModifier() {
            const modal = document.getElementById("modalModifier");
            if (modal) {
                modal.style.display = "none";
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            // Close Add modal if clicking outside
            const modalAdd = document.getElementById("modalObjectifs");
            const popupAdd = document.getElementById("popupContainerObjectifs");
            if (modalAdd && popupAdd) {
                modalAdd.addEventListener("click", function (e) {
                    if (!popupAdd.contains(e.target)) {
                        closeModalObjectifs();
                    }
                });
            }

            // Close Edit modal if clicking outside
            const modalEdit = document.getElementById("modalModifier");
            const popupEdit = document.getElementById("popupContainerModifier");
            if (modalEdit && popupEdit) {
                modalEdit.addEventListener("click", function (e) {
                    if (!popupEdit.contains(e.target)) {
                        closeModalModifier();
                    }
                });
            }
        });
    </script>
</body>

</html>