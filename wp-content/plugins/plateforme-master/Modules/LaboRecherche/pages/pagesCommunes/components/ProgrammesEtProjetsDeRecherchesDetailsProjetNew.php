<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCI-Learn Project Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Flatpickr (déjà utilisé par tes popups) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <style>
        :root {
            --olive: #A6A485;
            --olive-2: #9EB08F;
            --khaki: #ECEBE3;
            --border: #DEDCC9;
            --ink: #2A2916;
            --red: #C60000;
        }

        body {
            margin: 0;
            background: #F7F7F3;
            font-family: 'Poppins', sans-serif;
            color: #2A2916
        }

        /* ===== Cards / headers ===== */
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 16px #00000014;
            margin: 14px 0;
            /* overflow: hidden */
        }

        .card h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #2A2916
        }

        .card-header-with-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--khaki);
            background: #fff
        }

        .modifier-button {
            background: #fff;
            border: 2px solid var(--red);
            color: var(--red);
            padding: 8px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            height: 40px;
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .modifier-button:hover {
            background: var(--red);
            color: #fff
        }

        /* ===== Section: Informations générales ===== */
        .styled-list {
            list-style: none;
            margin: 0;
            padding: 0
        }

        .styled-list li {
            display: flex;
            gap: 24px;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 14px
        }

        .styled-list li:last-child {
            border-bottom: 0
        }

        .styled-list strong {
            min-width: 220px;
            color: #6E6D55
        }

        .custom-ordered-list {
            counter-reset: item;
            list-style: none;
            margin: 8px 0 18px 0;
            padding: 0 20px
        }

        .custom-ordered-list li {
            counter-increment: item;
            font-weight: 600;
            margin: 10px 0
        }

        .custom-ordered-list li::before {
            content: counter(item) ".";
            color: var(--red);
            margin-right: 8px
        }

        /* ===== Table (générique) ===== */
        table.table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0
        }

        .table thead th {
            background: var(--khaki);
            padding: 14px;
            border-bottom: 1px solid #ddd;
            font-weight: 700;
            color: #333;
            text-align: left
        }

        .table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            background: #fff;
            color: #444
        }

        .table tbody tr:nth-child(even) td {
            background: #ECEBE34D
        }

        .table .cell-center {
            text-align: center
        }

        /* ===== Equipe ===== */
        .team-table .email a {
            color: #0d6efd;
            text-decoration: none
        }

        .team-table .email a:hover {
            text-decoration: underline
        }

        /* ===== Phases ===== */
        .phases .prog {
            height: 8px;
            border-radius: 10px;
            background: #EEE;
            overflow: hidden
        }

        .phases .bar {
            height: 100%
        }

        .phases .bar.red {
            background: #BF0404
        }

        .phases .bar.olive {
            background: #A6A485
        }

        .phases .state {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 14px;
            font-size: 12px;
            font-weight: 600;
            background: #D6E6D3;
            color: #2B6629
        }

        .phases .state.pending {
            background: #FFF3CD;
            color: #856404
        }

        .phases .state.todo {
            background: #EAEAEA;
            color: #555
        }

        .menu {
            position: relative
        }

        .menu>.modifier-button {
            padding-right: 15px;
            padding-left: 15px;
            margin: -10px 0 10px;
        }

        .menu-list {
            position: absolute;
            right: 0;
            top: 110%;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .12);
            display: none;
            min-width: 180px;
            z-index: 10
        }

        .menu.open .menu-list {
            display: block
        }

        .menu-list button {
            display: block;
            width: 100%;
            text-align: left;
            background: transparent;
            border: 0;
            padding: 10px 12px;
            font-size: 14px;
            cursor: pointer
        }

        .menu-list button:hover {
            background: #f5f5f5
        }

        /* ===== Pièces jointes ===== */
        .file-link {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .file-link i {
            color: #BF0404
        }

        /* ===== Onglets Budget/Dépense ===== */
        .tabs {
            display: flex;
            gap: 6px;
            background: #F5F4EE;
            padding: 6px;
            border-radius: 10px;
            margin: 12px
        }

        .tab-btn {
            background: transparent;
            border: 0;
            padding: 10px 16px;
            /* border-radius: 8px; */
            font-weight: 600;
            color: #666;
            cursor: pointer
        }

        .tab-btn.active {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
            color: #2A2916
        }

        .tab-panels {
            padding: 10px 16px 18px
        }

        .toolbar {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            margin: 6px 0 12px
        }

        .search {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #DBD9C3;
            border-radius: 10px;
            background: #fff;
            padding: 6px 10px;
            min-width: 260px
        }

        .search input {
            border: 0;
            outline: none;
            background: transparent;
            font-size: 14px;
            width: 100%
        }

        .table-actions i {
            cursor: pointer
        }

        .download-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #DBD9C3;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 13px;
            background: #fff
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ECEBE3;
            font-size: 12px;
            margin-left: 4px
        }

        .pagination {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
            margin-top: 10px
        }

        .pagination button {
            background: #fff;
            border: 2px solid #c40000;
            color: #c40000;
            border-radius: 8px;
            min-width: 34px;
            padding: 6px 8px;
            cursor: pointer
        }

        .pagination button.active {
            background: #c40000;
            color: #fff
        }

        /* ===== Side panels (réutilise ton CSS existant) ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .3);
            display: none;
            justify-content: flex-end;
            z-index: 1000
        }

        .popup-container {
            background: #fff;
            width: 410px;
            height: 100%;
            overflow: auto;
            box-shadow: -4px 0 16px rgba(0, 0, 0, .12)
        }

        .popup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid #eee
        }

        /* NEW STYLE FOR CLOSE BUTTON */
        .popup-header .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            font-weight: 300;
            line-height: 1;
            cursor: pointer;
            color: #888;
            padding: 0;
            display: none;
        }

        .popup-form {
            padding: 16px 20px
        }

        .btn-enregistrer {
            background: #c62828;
            color: #fff;
            border: 0;
            border-radius: 6px;
            padding: 8px 14px;
            font-weight: 600;
            cursor: pointer
        }

        .form-group {
            margin-bottom: 16px
        }

        .popup-form input,
        .popup-form select,
        .popup-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px
        }

        .input-file-wrapper {
            display: flex;
            align-items: center;
            width: 100%
        }

        .input-file-text {
            flex: 1;
            border: 1px solid #b5af8e;
            border-right: 0;
            border-radius: 7px 0 0 7px !important;
            padding: 10px
        }

        .btn-importer {
            border: 0;
            background: #b5af8e;
            color: #fff;
            border-radius: 0 7px 7px 0;
            padding: 10px 14px;
            font-weight: 600
        }
    </style>
</head>

<body>
    <div class="content-wrapper">

        <!-- 1) Informations générales -->
        <div class="card">
            <div class="card-header-with-button">
                <h3>Informations générales</h3>
            </div>
            <ul class="styled-list" id="infos-generales">
                <li><strong>Intitulé complet :</strong> </li>
                <li><strong>Responsable :</strong> </li>
                <li><strong>Période :</strong> </li>
                <li><strong>Financement :</strong> </li>
            </ul>

            <div style="padding:12px 20px 2px">
                <h3 style="font-size:18px;margin:4px 0 8px">Objectifs du projet</h3>
            </div>
            <ol class="custom-ordered-list" id="objectifs-list"></ol>
        </div>

        <!-- 2) Équipe -->
        <div class="card">
            <div class="card-header-with-button">
                <h3>Équipe du projet BCI-Learn</h3>
                <button class="modifier-button" id="btnAddMember" onclick="openModal('modalEquipe')"><i
                        class="fa fa-plus"></i> Ajouter</button>
            </div>
            <div style="padding:12px 16px">
                <table class="table team-table" id="table-equipe">
                    <thead>
                        <tr>
                            <th style="width:160px">Onaid</th>
                            <th>Nom complet</th>
                            <th>Rôle dans le projet</th>
                            <th>Email</th>
                            <th class="cell-center" style="width:80px">Doc.</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- 3) Phases -->
        <div class="card phases">
            <div class="card-header-with-button">
                <h3>Liste des phases de projet</h3>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="modifier-button">Générer Gantt</button>
                    <div class="menu" id="menuPhases">
                        <button type="button" class="modifier-button">Actions <i class="fa fa-chevron-down"
                                style="font-size: 12px; margin-left: 5px;"></i></button>
                        <div class="menu-list">
                            <button id="ph-add">Ajouter les phases</button>
                            <button id="ph-edit">Modifier</button>
                            <button id="ph-details">Détails</button>
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding:12px 16px">
                <table class="table" id="table-phases">
                    <thead>
                        <tr>
                            <th style="width:60px">N°</th>
                            <th>Phases</th>
                            <th style="width:120px" class="cell-center">État</th>
                            <th style="width:220px" class="cell-center">Progression</th>
                            <th style="width:60px" class="cell-center"><i class="fa fa-ellipsis"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- 4) Pièces jointes -->
        <div class="card">
            <div class="card-header-with-button">
                <h3>Pièces jointes associées au projet</h3>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="modifier-button" id="btnDownloadAll" style="padding: 0 14px;"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                            alt="Groupe 152"></button>
                    <button class="modifier-button" onclick="openModal('modalPiecesJointes')">Modifier</button>
                </div>
            </div>
            <div style="padding:12px 16px">
                <table class="table" id="table-pieces">
                    <thead>
                        <tr>
                            <th style="width:90px">Ref_Doc</th>
                            <th>Type de document</th>
                            <th>Fichier</th>
                            <th>Version</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- 5) Onglets Budget / Dépense -->
        <?php
        /** =========================================================================
         * FRONT — Publications (Suivi + Mes publications)
         * - À coller dans une page/template WP (shortcode ou page builder via Template).
         * - Requiert un utilisateur connecté pour l’API protégée.
         * - Endpoints utilisés:
         * GET    /plateforme-recherche/v1/publication?with_auteur=1
         * GET    /plateforme-recherche/v1/publication?me=1&include_shared=1&shared_scope=lab
         * POST   /plateforme-recherche/v1/publication/{id}/validate
         * POST   /plateforme-recherche/v1/publication/{id}/reject
         * DELETE/plateforme-recherche/v1/publication/{id}
         * ====================================================================== */
        if (!defined('ABSPATH'))
            exit;

        // user roles pour le front
        $current_user = wp_get_current_user();
        $roles = is_user_logged_in() ? (array) $current_user->roles : array();
        ?>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <style>
            :root {
                --ink: #2A2916;
                --line: #EBE9D7;
                --muted: #6E6D55;
                --chip: #E9E7D7;
                --chip-active: #A6A485;
                --danger: #D71920;
                --success: #198754;
                --warning: #d89e00;
            }

            body {
                font-family: 'Segoe UI', sans-serif;
                background: #f9f9f9
            }

            /* ---------- Container & Tabs ---------- */
            .accordion-container {
                border-radius: 12px;
                box-shadow: 0 0 8px rgba(0, 0, 0, .05)
            }

            .accordion-tabs {
                display: flex;
                background: #f3f3f3
            }

            .tab-btn {
                flex: 1;
                padding: 15px 20px;
                font-weight: 700;
                border: none;
                background: #A6A485;
                color: #fff;
                cursor: pointer;
                font-size: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px
            }

            .tab-btn:first-child {
                border-top-left-radius: 11px;
                border-top-right-radius: 11px;
                margin-right: 10px
            }

            .tab-btn:last-child {
                border-top-right-radius: 11px;
                border-top-left-radius: 11px
            }

            .tab-btn.active {
                background: #fff;
                color: var(--ink)
            }

            .accordion-content {
                padding: 25px;
                background: #fff
            }

            .tab-panel {
                display: none
            }

            .tab-panel.active {
                display: block
            }

            /* ---------- Toolbars ---------- */
            .table-controls {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                margin-bottom: 33px
            }

            .filter-group {
                display: flex;
                gap: 7px;
                flex-wrap: wrap;
                align-items: center
            }

            .search-box {
                display: flex;
                align-items: center;
                border: 1px solid #d8d4b7;
                border-radius: 8px;
                padding: 0 10px;
                background: #fff;
                min-width: 240px
            }

            .search-box i {
                color: #666;
                margin-left: 6px
            }

            .filter-input {
                padding: 10px 6px;
                border: none;
                outline: none;
                font-size: 14px;
                background: #fff;
                width: 100%
            }

            .date-input-container {
                display: flex;
                align-items: center;
                border: 1px solid #d8d4b7;
                border-radius: 8px;
                padding: 0 10px;
                background: #fff
            }

            .date-input {
                padding: 10px 6px;
                border: none;
                outline: none;
                font-size: 14px;
                background: #fff
            }

            .date-input-container img {
                margin-left: 6px
            }

            .filter-select {
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid #d8d4b7;
                background: #fff;
                font-size: 14px;
                appearance: none;
                background-position: right 10px center;
                background-repeat: no-repeat;
                background-size: 12px
            }

            /* segmented control (onglet 2) */
            .seg {
                display: inline-flex;
                gap: 6px;
                background: #fff;
                border-radius: 10px;
                padding: 4px;
                border: 1px solid #d8d4b7
            }

            .seg button {
                border: none;
                border-radius: 8px;
                padding: 8px 14px;
                background: #fff;
                color: #333;
                font-weight: 700;
                cursor: pointer
            }

            .seg button.active {
                background: var(--chip-active);
                color: #fff
            }

            .filter-actions {
                display: flex;
                gap: 10px;
                align-items: center
            }

            .add-project-btn {
                background: var(--danger);
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 10px 16px;
                font-weight: 700;
                text-decoration: none
            }

            .add-project-btn:hover {
                background: #b8151a
            }

            .icon-btn {
                width: 40px;
                height: 40px;
                background: #fff;
                border-radius: 10px;
                border: 1px solid #ddd;
                box-shadow: 0 0 5px rgba(0, 0, 0, .06);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--danger)
            }

            /* ---------- Table ---------- */
            .styled-table {
                width: 100%;
                border-collapse: collapse
            }

            .styled-table thead {
                background: #f3f1e9
            }

            .styled-table th,
            .styled-table td {
                padding: 14px;
                text-align: left;
                border-bottom: 1px solid #eee
            }

            .styled-table tbody tr:hover {
                background: #fafafa
            }

            #candidaturesTable,
            #mesPublicationsTable {
                border: none !important;
                box-shadow: none !important;
                border-collapse: separate;
                border-spacing: 0
            }

            #candidaturesTable th,
            #mesPublicationsTable th {
                border: 0;
            }

            #candidaturesTable td,
            #mesPublicationsTable td {
                border: 1px solid var(--line)
            }

            #candidaturesTable thead,
            #mesPublicationsTable thead {
                position: static;
                transform: translateY(-15px)
            }

            #candidaturesTable tbody tr:first-child td,
            #mesPublicationsTable tbody tr:first-child td {
                border-top: 1px solid var(--line) !important
            }

            /* arrondis */
            #candidaturesTable thead tr:first-child th:first-child,
            #mesPublicationsTable thead tr:first-child th:first-child {
                border-top-left-radius: 12px;
                border-bottom-left-radius: 12px
            }

            #candidaturesTable thead tr:first-child th:last-child,
            #mesPublicationsTable thead tr:first-child th:last-child {
                border-top-right-radius: 12px;
                border-bottom-right-radius: 12px
            }

            #candidaturesTable tbody tr:last-child td:first-child,
            #mesPublicationsTable tbody tr:last-child td:first-child {
                border-bottom-left-radius: 12px
            }

            #candidaturesTable tbody tr:last-child td:last-child,
            #mesPublicationsTable tbody tr:last-child td:last-child {
                border-bottom-right-radius: 12px
            }

            #candidaturesTable tbody tr:first-child td:first-child,
            #mesPublicationsTable tbody tr:first-child td:first-child {
                border-top-left-radius: 12px
            }

            #candidaturesTable tbody tr:first-child td:last-child,
            #mesPublicationsTable tbody tr:first-child td:last-child {
                border-top-right-radius: 12px
            }

            /* badges statut */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 4px 12px;
                font-size: 13px;
                font-weight: 700;
                border-radius: 20px
            }

            .badge-success {
                color: var(--success);
                background: #e6f7ee
            }

            .badge-danger {
                color: var(--danger);
                background: #fff0f0
            }

            .badge-warning {
                color: var(--warning);
                background: #fff9e6
            }

            .badge-info {
                background: #808066;
                color: #fff
            }

            /* actions dropdown */
            .actions {
                position: relative;
                display: inline-block
            }

            .action-btn {
                background: transparent;
                border: none;
                font-size: 20px;
                cursor: pointer;
                padding: 5px;
                width: 36px;
                height: 36px
            }

            .dropdown-menu {
                display: none;
                position: absolute;
                top: 100%;
                right: 0;
                min-width: 220px;
                background: #fff;
                border: 1px solid #d8d4b7;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, .1);
                z-index: 1000;
                padding: 6px 0
            }

            .dropdown-menu a {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                text-decoration: none;
                font-size: 14px;
                color: var(--ink)
            }

            .dropdown-menu a:hover {
                background: #f5f5f5
            }

            .dropdown-menu i {
                width: 16px;
                text-align: center
            }

            /* DataTables pagination */
            .dataTables_wrapper .dataTables_paginate {
                display: flex;
                justify-content: end;
                align-items: center;
                gap: 10px;
                margin-top: 16px
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                border: 2px solid var(--danger);
                color: var(--danger) !important;
                padding: 8px 14px;
                border-radius: 8px;
                background: #fff !important;
                font-weight: 700;
                cursor: pointer
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                border: none
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover {
                background: #fdf0f0 !important
            }

            /* séparateur dans tab2 au-dessus du tableau */
            #tab2 .section-divider {
                border: none;
                height: 1px;
                background: #eee;
                margin-bottom: 18px
            }
        </style>

        <div class="accordion-container">
            <div class="accordion-tabs">
                <button class="tab-btn active" data-tab="tab1">Rubriques budgétaire</button>
                <button class="tab-btn" data-tab="tab2">Dépenses</button>
            </div>

            <div class="accordion-content">
                <!-- ================= TAB 1 : Rubriques budgétaire ================= -->
                <div class="tab-panel active" id="tab1">
                    <div class="table-controls">
                        <div class="filter-group">
                            <div class="search-box">
                                <input type="text" class="filter-input" id="candidaturesSearch"
                                    placeholder="Recherchez...">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>

                        <div class="filter-actions">
                            <button class="modifier-button" onclick="openModal('modalRubrique')">Ajouter
                                rubrique</button>
                            <button class="icon-btn" title="Exporter"><img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                                    alt="Groupe 152.png"></button>
                        </div>
                    </div>

                    <table class="styled-table" id="candidaturesTable">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Rubrique budgétaire</th>
                                <th>Pourcentage max</th>
                                <th>Montant Alloué</th>
                                <th>Pièces jointe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- ================= TAB 2 : Dépenses ================= -->
                <div class="tab-panel" id="tab2">
                    <div class="table-controls">
                        <div class="filter-group">
                            <div class="search-box">
                                <input type="text" class="filter-input" id="depensesSearch" placeholder="Recherchez...">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="filter-actions">
                            <button class="modifier-button" onclick="openModal('modalDepense')">Ajouter dépense</button>
                            <button class="icon-btn" title="Exporter"><img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                                    alt="Groupe 152.png"></button>
                        </div>
                    </div>
                    <table id="mesPublicationsTable" class="styled-table display">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Rebique budgétaire</th>
                                <th>Désignation</th>
                                <th>Montant</th>
                                <th>Pièces jointe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if (is_user_logged_in()): ?>
            <script>
                // REST & roles exposés au JS
                window.pmsettings = {
                    rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
                    nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
                };
                window.pmuser = {
                    id: <?php echo (int) get_current_user_id(); ?>,
                    roles: <?php echo json_encode($roles); ?>
                };
            </script>
        <?php endif; ?>

        <!-- jQuery + DataTables + Flatpickr -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

        <script>
            (function ($) {
                /* ====== Config REST ====== */
                const REST_ROOT = (window.pmsettings && pmsettings.rest_root) || (window.wpApiSettings && wpApiSettings
                    .root) || '/wp-json/';
                const NONCE = (window.pmsettings && pmsettings.nonce) || (window.wpApiSettings && wpApiSettings
                    .nonce) || '';
                const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

                /* ====== Role checks (UN SEUL BLOC) ====== */
                const USER_ROLES = (window.pmuser && Array.isArray(pmuser.roles)) ? pmuser.roles : [];
                const ROLES_LOWER = USER_ROLES.map(String).map(r => r.toLowerCase());
                const IS_DIRECTEUR = ROLES_LOWER.some(r =>
                    r === 'um_directeur_laboratoire' ||
                    r === 'directeur_laboratoire' ||
                    r === 'directeur-laboratoire' ||
                    r === 'um_directeur-laboratoire' ||
                    r === 'um-directeur-laboratoire'
                );
                const IS_SERVICE_UTM = ROLES_LOWER.some(r => r === 'um_service-utm' || r === 'service_utm' || r ===
                    'service-utm');

                // Masquer "Ajouter une publication" pour Service UTM
                if (IS_SERVICE_UTM) {
                    const addBtn = document.querySelector('#tab2 .add-project-btn');
                    if (addBtn) addBtn.style.display = 'none';
                }

                /* ====== Helpers ====== */
                const esc = s => ('' + (s ?? '')).replace(/[&<>"']/g, m => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[m]));
                const fmtDate = iso => {
                    if (!iso || typeof iso !== 'string') return '';
                    const m = iso.match(/^(\d{4})-(\d{2})-(\d{2})/);
                    return m ? `${m[3]}/${m[2]}/${m[1]}` : esc(iso);
                };
                const normStatut = s => {
                    const v = (s || '').toString().trim().toLowerCase();
                    if (v.startsWith('val')) return 'Validée';
                    if (v.startsWith('rej')) return 'Rejetée';
                    return 'En attente';
                };
                const badge = st => {
                    const cls = st === 'Validée' ? 'badge-success' : st === 'Rejetée' ? 'badge-danger' :
                        'badge-warning';
                    const icn = st === 'Validée' ? 'fa-circle-check' : st === 'Rejetée' ? 'fa-circle-stop' :
                        'fa-clock';
                    return `<span class="badge ${cls}"><i class="fa-regular ${icn}"></i>${st}</span>`;
                };

                /* ====== DataTables base ====== */
                const baseDT = {
                    paging: true,
                    searching: true,
                    ordering: false,
                    info: false,
                    pageLength: 5,
                    dom: 't<"bottom"p>',
                    language: {
                        paginate: {
                            previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                            next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>"
                        },
                        emptyTable: "Aucune donnée disponible dans le tableau",
                        zeroRecords: "Aucun enregistrement correspondant trouvé"
                    }
                };

                let dtSuivi = null,
                    dtMes = null;

                /* ================= TAB 1 : Suivi ================= */
                async function loadSuiviPublications() {
                    const $tb = $('#candidaturesTable tbody').empty();
                    const staticData = [{
                        ref: '001',
                        rubrique: 'Fournitures du bureau',
                        pourcentage: '45%',
                        montant: '54 000 TND'
                    },
                    {
                        ref: '002',
                        rubrique: 'Matériel informatique',
                        pourcentage: '25%',
                        montant: '100 000 TND'
                    },
                    {
                        ref: '003',
                        rubrique: 'frais généraux',
                        pourcentage: '10%',
                        montant: '67 000 TND'
                    }
                    ];

                    staticData.forEach(p => {
                        const actionsHtml = `
                            <div class="actions">
                                <button class="action-btn" title="Actions"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
                                    <a href="#"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
                                </div>
                            </div>
                        `;
                        $tb.append(`
                        <tr>
                            <td>${p.ref}</td>
                            <td>${p.rubrique}</td>
                            <td>${p.pourcentage}</td>
                            <td>${p.montant}</td>
                            <td style="text-align: center;"><button class="icon-btn" style="border:none; box-shadow:none; width:auto; height:auto;"><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="Groupe 152.png"></button></td>
                            <td style="text-align: center;">${actionsHtml}</td>
                        </tr>
                    `);
                    });


                    if (dtSuivi) dtSuivi.destroy();
                    dtSuivi = $('#candidaturesTable').DataTable({
                        ...baseDT,
                        columnDefs: [{
                            orderable: false,
                            targets: [4, 5]
                        }]
                    });

                    $('#candidaturesSearch').off('input').on('input', function () {
                        dtSuivi.search(this.value).draw();
                    });
                }

                /* ================= TAB 2 : Dépenses ================= */
                async function loadDepenses() {
                    const $tb = $('#mesPublicationsTable tbody').empty();
                    const staticData = [{
                        ref: '001',
                        rubrique: 'Achat matériel labo',
                        designation: 'Achat matériel labo',
                        montant: '54 000 TND'
                    },
                    {
                        ref: '002',
                        rubrique: 'Déplacement',
                        designation: '-',
                        montant: '200 TND'
                    },
                    {
                        ref: '003',
                        rubrique: 'Déplacement',
                        designation: '-',
                        montant: '670 TND'
                    }
                    ];

                    staticData.forEach(d => {
                        const actionsHtml = `
                            <div class="actions">
                                <button class="action-btn" title="Actions"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
                                    <a href="#"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
                                </div>
                            </div>
                        `;
                        $tb.append(`
                        <tr>
                            <td>${d.ref}</td>
                            <td>${d.rubrique}</td>
                            <td>${d.designation}</td>
                            <td>${d.montant}</td>
                            <td style="text-align: center;"><button class="icon-btn" style="border:none; box-shadow:none; width:auto; height:auto;"><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="Groupe 152.png"></button></td>
                            <td style="text-align: center;">${actionsHtml}</td>
                        </tr>
                    `);
                    });

                    if (dtMes) dtMes.destroy();
                    dtMes = $('#mesPublicationsTable').DataTable({
                        ...baseDT,
                        columnDefs: [{
                            orderable: false,
                            targets: [4, 5]
                        }]
                    });

                    $('#depensesSearch').off('input').on('input', function () {
                        dtMes.search(this.value).draw();
                    });
                }


                /* ================= Filtres globaux (status/date) ================= */
                $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                    const id = settings.sTableId;
                    if (id === 'candidaturesTable') {
                        const wanted = $('#statusFilterSuivi').val() || '';
                        const rowNode = settings.aoData[dataIndex].nTr;
                        const st = $(rowNode).find('td').eq(5).data('statut') || '';
                        if (wanted && st !== wanted) return false;

                        const dp = document.getElementById('dateFilterSuivi')._flatpickr;
                        if (dp && dp.selectedDates && dp.selectedDates.length === 2) {
                            const [from, to] = dp.selectedDates;
                            const dateIso = $(rowNode).find('td').eq(3).data('date') || '';
                            if (!dateIso) return false;
                            const d = new Date(dateIso + 'T00:00:00');
                            if (isNaN(d.getTime())) return false;
                            if (d < from || d > to) return false;
                        }
                        return true;
                    }
                    return true;
                });

                /* ================= Flatpickr ================= */
                function initDatePickers() {
                    const opts = {
                        mode: 'range',
                        dateFormat: 'Y-m-d',
                        locale: 'fr',
                        onChange: function () {
                            if (dtSuivi) dtSuivi.draw();
                        }
                    };
                    flatpickr('#dateFilterSuivi', opts);
                }

                /* ================= Dropdown actions ================= */
                $(document).on('click', '.action-btn', function (e) {
                    e.stopPropagation();
                    const dd = $(this).closest('.actions').find('.dropdown-menu');
                    $('.dropdown-menu').not(dd).hide();
                    dd.toggle();
                });
                $(document).on('click', function () {
                    $('.dropdown-menu').hide();
                });


                /* ================= Tabs ================= */
                $('.tab-btn').on('click', async function () {
                    const tabId = $(this).data('tab');
                    $('.tab-btn').removeClass('active');
                    $(this).addClass('active');
                    $('.tab-panel').removeClass('active');
                    $('#' + tabId).addClass('active');
                    if (tabId === 'tab2') {
                        await loadDepenses();
                    }
                });

                /* ================= Boot ================= */
                initDatePickers();
                loadSuiviPublications(); // tab1 par défaut
            })(jQuery);
        </script>

    </div>

    <!-- ======= PANNEAUX LATERAUX (réutilisent ton existant) ======= -->
    <div class="modal-overlay" id="modalPiecesJointes">
        <div class="popup-container" id="popupContainerPiecesJointes">
            <div class="popup-header">
                <h2>Pièces jointes associées au projet</h2>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="btn-enregistrer" id="btnSavePiecesJointes">Enregistrer</button>
                    <button type="button" class="close-btn" onclick="closeModal('modalPiecesJointes')">&times;</button>
                </div>
            </div>
            <form class="popup-form">
                <div class="form-group"><label for="type-document">Type de document</label><input id="type-document" />
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" id="piece-jointe" readonly placeholder="Aucun fichier…">
                        <input type="file" id="file-input-piece" style="display:none"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg">
                        <button type="button" class="btn-importer" id="btn-importer-piece"><i
                                class="fa fa-file-arrow-up"></i>
                            Importer</button>
                    </div>
                </div>
                <div class="form-group"><label for="version">Version</label><input id="version" /></div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalEquipe">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Définir l'équipe</h2>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="btn-enregistrer" id="btnSaveEquipe">Enregistrer</button>
                    <button type="button" class="close-btn" onclick="closeModal('modalEquipe')">&times;</button>
                </div>
            </div>
            <form class="popup-form">
                <div id="equipe-container">
                    <div class="equipe-item"
                        style="border: 1px solid #d8d4b7; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                        <div class="form-group">
                            <label>Membre</label>
                            <select>
                                <option selected>Monia Zeidi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rôle</label>
                            <select>
                                <option selected>Responsable Du Projet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pièce jointe</label>
                            <div class="input-file-wrapper">
                                <input class="input-file-text" readonly placeholder="importer">
                                <input type="file" style="display:none">
                                <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()"
                                    style="background-color: #A6A485;">Importer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="add-equipe-item"
                        style="background: transparent; border: none; color: var(--red); font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <i class="fa fa-plus-circle"></i> Ajouter Une Tache
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalDepense">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Dépense</h2>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="btn-enregistrer" id="btnSaveDepense">Enregistrer</button>
                    <button type="button" class="close-btn" onclick="closeModal('modalDepense')">&times;</button>
                </div>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="depense-rubrique-select">Rebrique Budgétaire</label>
                    <select id="depense-rubrique-select">
                        <option selected>Achat Matériels Du Labo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Montant Alloué :</label>
                    <div
                        style="background-color: #f3f1e9; padding: 10px; border-radius: 7px; text-align: right; font-weight: bold; border: 1px solid #b5af8e;">
                        234 000 TND</div>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <div style="position: relative;">
                        <input id="montant" type="text" placeholder="75 000" style="padding-right: 50px;">
                        <span
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #666;">TND</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="designation">Désignation</label>
                    <textarea id="designation" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" id="piece-jointe-depense" readonly placeholder="importer">
                        <input type="file" id="file-input-depense" style="display:none"
                            accept=".pdf,.doc,.docx,.png,.jpg">
                        <button type="button" class="btn-importer" id="btn-importer-depense"
                            style="background-color: #d8d4b7; color: var(--ink);"><i class="fa fa-upload"></i>
                            Importer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalRubrique">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Rubriques budgétaire</h2>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="btn-enregistrer" id="btnSaveRubrique">Enregistrer</button>
                    <button type="button" class="close-btn" onclick="closeModal('modalRubrique')">&times;</button>
                </div>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <div
                        style="background-color: #f3f1e9; padding: 10px; border-radius: 7px; text-align: right; font-weight: bold; border: 1px solid #b5af8e; display: flex; justify-content: space-between; align-items: center;">
                        <span>Montant Total :</span>
                        <span>520 000 TND</span>
                    </div>
                </div>
                <div id="rubriques-container">
                    <div class="rubrique-item"
                        style="border: 1px solid #d8d4b7; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                        <div class="form-group">
                            <label>Rebrique Budgétaire</label>
                            <input type="text" value="Achat Matériels Du Labo">
                        </div>
                        <div class="form-group">
                            <label>Pourcentage a ne pas dépassé :</label>
                            <input type="text" value="45%">
                        </div>
                        <div class="form-group">
                            <label>Pourcentage a ne pas dépassé :</label>
                            <input type="text" value="45%">
                        </div>
                        <div class="form-group">
                            <label>Pièce jointe</label>
                            <div class="input-file-wrapper">
                                <input class="input-file-text" readonly placeholder="importer">
                                <input type="file" style="display:none">
                                <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()"
                                    style="background-color: #d8d4b7; color: var(--ink);"><i class="fa fa-upload"></i>
                                    Importer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="add-rubrique-item"
                        style="background: transparent; border: none; color: var(--red); font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <i class="fa fa-plus-circle"></i> Ajouter Autre
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /* ===== Helpers REST ===== */
        const API_BASE = (window.PMSettings?.restUrl || "/wp-json/") + "plateforme-recherche/v1";
        async function wpFetch(path, opts = {}) {
            const res = await fetch(API_BASE + path, {
                credentials: 'include',
                method: opts.method || 'GET',
                body: opts.body || undefined,
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || '',
                    ...(opts.headers || {})
                }
            });
            if (!res.ok) {
                throw new Error(`HTTP ${res.status}`)
            }
            const ct = res.headers.get('content-type') || '';
            return ct.includes('application/json') ? res.json() : res.text();
        }

        function fmtMoney(v) {
            if (v === null || v === undefined || v === '') return '—';
            const n = Number(v);
            return isNaN(n) ? v : n.toLocaleString('fr-FR', {
                style: 'currency',
                currency: 'TND',
                maximumFractionDigits: 3
            });
        }

        function openModal(id) {
            document.getElementById(id).style.display = 'flex'
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none'
        }

        /* ===== Menu Phases ===== */
        document.getElementById('menuPhases').addEventListener('click', e => {
            const m = e.currentTarget;
            m.classList.toggle('open');
        });
        document.addEventListener('click', e => {
            const m = document.getElementById('menuPhases');
            if (m && !m.contains(e.target)) m.classList.remove('open');
        });

        /* ===== Upload buttons in side panels ===== */
        document.getElementById('btn-importer-depense').onclick = () => document.getElementById('file-input-depense')
            .click();
        document.getElementById('file-input-depense').onchange = function () {
            document.getElementById('piece-jointe-depense').value = this.files?.[0]?.name || ''
        }

        document.getElementById('btn-importer-piece').onclick = () => document.getElementById('file-input-piece').click();
        document.getElementById('file-input-piece').onchange = function () {
            document.getElementById('piece-jointe').value = this.files?.[0]?.name || ''
        }

        /* ===== Renderers ===== */
        function renderInfos(data) {
            const ul = document.getElementById('infos-generales');
            ul.innerHTML =
                `
    <li><strong>Intitulé complet :</strong> ${data.titre || ''}</li>
    <li><strong>Responsable :</strong> ${data.chercheur_nom || ''}</li>
    <li><strong>Période :</strong> ${data.date_debut || ''} – ${data.date_fin || ''}</li>
    <li><strong>Financement :</strong> ${(data.budget ? fmtMoney(data.budget) : '0 TND')} ${data.type_financement ? `(${data.type_financement})` : ''}</li>`;
            const ol = document.getElementById('objectifs-list');
            ol.innerHTML = '';
            if (data.objectifs) {
                const li = document.createElement('li');
                li.textContent = data.objectifs;
                ol.appendChild(li);
            }
            (data.objectifs_list || []).forEach(o => {
                const li = document.createElement('li');
                li.textContent = o.objectif;
                ol.appendChild(li);
            });
        }

        function renderEquipe(data) {
            const tb = document.querySelector('#table-equipe tbody');
            tb.innerHTML = '';
            (data.membres || []).forEach((m, i) => {
                const mail = m.email || m.user_email || '';
                tb.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${m.onaid || '0000-0001-XXXX-XXXX'}</td>
                <td>${m.display_name || '—'}</td>
                <td>${m.role_dans_projet || '—'}</td>
                <td class="email">${mail ? `<a href="mailto:${mail}">${mail}</a>` : '—'}</td>
                <td class="cell-center"><i class="fa fa-paperclip"></i></td>
            </tr>`);
            });
        }

        function renderPhases(data) {
            const tb = document.querySelector('#table-phases tbody');
            tb.innerHTML = '';
            (data.phases || []).forEach((p, idx) => {
                const pr = Math.max(0, Math.min(100, Number(p.progression || 0)));
                const state = (p.etat || '').toLowerCase();
                const stateCls = state.includes('cours') ? 'state' : (state.includes('prévu') || state.includes(
                    'prevu')) ? 'state todo' : 'state pending';
                const barCls = pr > 0 ? (pr < 50 ? 'bar red' : 'bar olive') : 'bar olive';
                tb.insertAdjacentHTML('beforeend', `
            <tr>
                <td class="cell-center">${idx + 1}</td>
                <td>${p.titre || '—'}</td>
                <td class="cell-center"><span class="${stateCls}">${p.etat || '—'}</span></td>
                <td>
                    <div class="prog"><div class="${barCls}" style="width:${pr}%"></div></div>
                    <div style="font-size:12px;margin-top:6px;text-align:right">${pr}%</div>
                </td>
                <td class="cell-center"><i class="fa fa-ellipsis-h"></i></td>
            </tr>`);
            });
        }

        function renderPieces(data) {
            const tb = document.querySelector('#table-pieces tbody');
            tb.innerHTML = `
                <tr>
                    <td>001</td>
                    <td>Convention projet</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> Convention_BCI_UTM.pdf
                        </a>
                    </td>
                    <td>1.0</td>
                    <td>01/02/2024</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Planning détaillé</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-excel" style="color: #198754;"></i> Planning_BCI_Q1Q2_2025.xlsx
                        </a>
                    </td>
                    <td>1.2</td>
                    <td>20/01/2025</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Rapport d'étape</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> Rapport_BCI_Progress2024.pdf
                        </a>
                    </td>
                    <td>1.0</td>
                    <td>15/12/2024</td>
                </tr>
            `;
        }


        /* Simple search & paginations for tables (client side) */
        function paginatedRenderer(rows, targetBody, pagerEl, pageSize = 5) {
            let page = 1,
                filter = '';

            function draw() {
                const body = document.querySelector(targetBody);
                body.innerHTML = '';
                const filtered = !filter ? rows : rows.filter(r => r.text.toLowerCase().includes(filter));
                const pages = Math.max(1, Math.ceil(filtered.length / pageSize));
                page = Math.max(1, Math.min(page, pages));
                const slice = filtered.slice((page - 1) * pageSize, page * pageSize);
                slice.forEach(r => body.insertAdjacentHTML('beforeend', r.html));
                const pag = document.getElementById(pagerEl);
                pag.innerHTML = '';
                for (let i = 1; i <= pages; i++) {
                    pag.insertAdjacentHTML('beforeend',
                        `<button class="${i === page ? 'active' : ''}" data-p="${i}">${i}</button>`);
                }
            }
            document.getElementById(pagerEl).addEventListener('click', e => {
                const b = e.target.closest('button');
                if (!b) return;
                page = Number(b.dataset.p || 1);
                draw();
            });
            return {
                searchBox(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', () => {
                            filter = el.value.trim().toLowerCase();
                            page = 1;
                            draw();
                        });
                    }
                    draw();
                },
                redraw() {
                    draw();
                }
            };
        }

        function renderRubriques(data) {
            const rows = (data.rubriques || []).map(r => {
                const pieces = Number(r.pieces_count || 0);
                return {
                    text: `${r.ref || ''} ${r.libelle || ''} ${r.pourcentage_max || ''} ${r.montant_alloue || ''}`,
                    html: `
                <tr>
                    <td>${r.ref || ''}</td>
                    <td>${r.libelle || ''}</td>
                    <td class="cell-center">${r.pourcentage_max ? r.pourcentage_max + '%' : '—'}</td>
                    <td class="cell-center">${fmtMoney(r.montant_alloue)}</td>
                    <td class="cell-center"><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="Groupe 152.png"><span class="count-badge">${pieces}</span></td>
                    <td class="cell-center">
                        <div class="table-actions">
                            <i class="fa fa-pen"></i>&nbsp;&nbsp;<i class="fa fa-trash"></i>
                        </div>
                    </td>
                </tr>`
                };
            });
            const pager = paginatedRenderer(rows, '#table-rubriques tbody', 'pag-rub', 5);
            pager.searchBox('search-rub');
        }

        function renderDepenses(data) {
            const rows = (data.depenses || []).map(d => {
                return {
                    text: `${d.id || d.ref || ''} ${d.rubrique_ref || ''} ${d.designation || ''} ${d.montant || ''}`,
                    html: `
                <tr>
                    <td>${d.ref || d.id || ''}</td>
                    <td>${d.rubrique_ref || '—'}</td>
                    <td>${d.designation || '—'}</td>
                    <td class="cell-center">${fmtMoney(d.montant || 0)}</td>
                    <td class="cell-center">${d.piece_jointe ? `<a href="${d.piece_jointe}" target="_blank"><i class="fa fa-paperclip"></i></a>` : '—'}</td>
                    <td class="cell-center"><i class="fa fa-pen"></i>&nbsp;&nbsp;<i class="fa fa-trash"></i></td>
                </tr>`
                };
            });
            const tb = document.querySelector('#table-depenses tbody');
            if (!rows.length) {
                tb.innerHTML = `<tr><td colspan="6" class="cell-center" style="color:#888">Aucune dépense</td></tr>`;
                document.getElementById('pag-dep').innerHTML = '';
                return;
            }
            const pager = paginatedRenderer(rows, '#table-depenses tbody', 'pag-dep', 6);
            pager.searchBox('search-dep');
        }

        /* ===== Load data ===== */
        document.addEventListener('DOMContentLoaded', async () => {
            const projetId = new URLSearchParams(window.location.search).get('id');
            if (!projetId) return;

            try {
                const data = await wpFetch(`/projet/${projetId}/full`);
                renderInfos(data);
                renderEquipe(data);
                renderPhases(data);
                renderPieces(data);
                renderRubriques(data);
                renderDepenses(data);
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Chargement du projet impossible.'
                });
            }
        });

        /* ====== Save dépense (branche ton endpoint POST si nécessaire) ====== */
        document.getElementById('btnSaveDepense').addEventListener('click', async () => {
            const projetId = new URLSearchParams(window.location.search).get('id');
            if (!projetId) return;

            const desig = document.getElementById('designation').value.trim();
            const montant = document.getElementById('montant').value.trim();
            const date = document.getElementById('date-depense').value;
            const file = document.getElementById('file-input-depense').files[0];

            if (!desig || !montant || !date) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Champs manquants'
                });
                return;
            }

            const fd = new FormData();
            fd.append('designation', desig);
            fd.append('montant', montant.replace(/\s+/g, '').replace(',', '.'));
            fd.append('date_depense', date);
            if (file) fd.append('piece_jointe', file);

            try {
                const res = await fetch(`${API_BASE}/projet/${projetId}/depense`, {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'X-WP-Nonce': window.PMSettings?.nonce || ''
                    },
                    body: fd
                });
                const payload = await res.json().catch(() => null);
                if (!res.ok) {
                    throw new Error(payload?.message || `HTTP ${res.status}`)
                }

                closeModal('modalDepense');
                Swal.fire({
                    icon: 'success',
                    title: 'Dépense ajoutée'
                });
                const data = await wpFetch(`/projet/${projetId}/full`);
                renderDepenses(data);
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: e.message
                });
            }
        });

        /* Fermer les panneaux si on clique sur le backdrop ou appuie sur Echap */
        ['modalDepense', 'modalPiecesJointes', 'modalRubrique', 'modalEquipe'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('click', (e) => {
                    // If the click is on the overlay background itself
                    if (e.target === el) {
                        closeModal(id);
                    }
                });
            }
        });

        // Close any open modal with the 'Escape' key
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape") {
                ['modalDepense', 'modalPiecesJointes', 'modalRubrique', 'modalEquipe'].forEach(id => {
                    const modal = document.getElementById(id);
                    if (modal && modal.style.display === 'flex') {
                        closeModal(id);
                    }
                });
            }
        });

        document.getElementById('add-rubrique-item').addEventListener('click', () => {
            const container = document.getElementById('rubriques-container');
            const newRubriqueItem = document.createElement('div');
            newRubriqueItem.className = 'rubrique-item';
            newRubriqueItem.style.border = '1px solid #d8d4b7';
            newRubriqueItem.style.borderRadius = '8px';
            newRubriqueItem.style.padding = '15px';
            newRubriqueItem.style.marginBottom = '15px';

            newRubriqueItem.innerHTML = `
                <div class="form-group">
                    <label>Rebrique Budgétaire</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pourcentage a ne pas dépassé :</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pourcentage a ne pas dépassé :</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" readonly placeholder="importer">
                        <input type="file" style="display:none">
                        <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()" style="background-color: #d8d4b7; color: var(--ink);"><i class="fa fa-upload"></i> Importer</button>
                    </div>
                </div>
            `;
            container.appendChild(newRubriqueItem);
        });

        document.getElementById('add-equipe-item').addEventListener('click', () => {
            const container = document.getElementById('equipe-container');
            const newEquipeItem = document.createElement('div');
            newEquipeItem.className = 'equipe-item';
            newEquipeItem.style.border = '1px solid #d8d4b7';
            newEquipeItem.style.borderRadius = '8px';
            newEquipeItem.style.padding = '15px';
            newEquipeItem.style.marginBottom = '15px';

            newEquipeItem.innerHTML = `
                <div class="form-group">
                    <label>Membre</label>
                    <select>
                        <option selected>Monia Zeidi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rôle</label>
                        <select>
                        <option selected>Responsable Du Projet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" readonly placeholder="importer">
                        <input type="file" style="display:none">
                        <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()"
                            style="background-color: #A6A485;">
                            Importer</button>
                    </div>
                </div>
            `;
            container.appendChild(newEquipeItem);
        });
    </script>
</body>

</html>