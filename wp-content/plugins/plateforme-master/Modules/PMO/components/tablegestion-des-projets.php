<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Des Projets</title>
    <!-- External CSS Libraries -->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Flatpickr CSS for Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- SweetAlert2 for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Internal CSS Styles -->
    <style>
        .dashboard-sub-title {
            font-weight: bold;
        }

        .filter-inputs {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon .icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
            font-size: 14px;
        }

        .input-with-icon .left-icon {
            left: 0.85rem;
        }

        .input-with-icon .right-icon {
            right: 0.85rem;
        }

        .filter-bar .filter-input,
        .filter-bar .filter-select {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 0.6rem 0.75rem;
            background-color: #fdfdfd;
            font-size: 14px;
            height: 42px;
            box-sizing: border-box;
            transition: border-color 0.2s;
            min-width: 180px;
        }

        .filter-bar .filter-input {
            width: 220px;
        }

        .filter-bar .filter-input:focus,
        .filter-bar .filter-select:focus {
            outline: none;
            /* border-color: #c60000; */
        }

        .input-with-icon .date-input {
            padding-left: 0.75rem;
            padding-right: 2.5rem;
        }

        .filter-bar .filter-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .filter-bar .icon-btn {
            width: 42px;
            height: 42px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: #fdfdfd;
            color: #BF0404;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 16px;
        }

        .filter-bar .icon-btn:hover {
            background-color: #f5f5f5;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .content-block {
            background: #fff;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-project-btn {
            background-color: #c60000;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .add-project-btn:hover {
            background-color: #a50000;
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

        #projectsTable {
            border: none !important;
            box-shadow: none !important;
            border-collapse: separate;
            border-spacing: 0
        }

        #projectsTable th {
            border: 0
        }

        #projectsTable td {
            border: 1px solid #A6A4853D;
        }

        #projectsTable thead {
            position: static;
            transform: translateY(-15px)
        }

        #projectsTable tbody tr:first-child td {
            border-top: 1px solid #A6A4853D !important;
        }

        /* arrondis */
        #projectsTable thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px
        }

        #projectsTable thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px
        }

        #projectsTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px
        }

        #projectsTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px
        }

        #projectsTable tbody tr:first-child td:first-child {
            border-top-left-radius: 12px
        }

        #projectsTable tbody tr:first-child td:last-child {
            border-top-right-radius: 12px
        }

        .actions {
            position: relative;
            display: inline-block;
        }

        .action-btn {
            background-color: transparent;
            color: #2d2a12;
            border: 1px solid transparent;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            font-size: 24px;
            font-weight: bolder;
            cursor: pointer;
            transition: background-color 0.2s, box-shadow 0.2s;
            line-height: 1;
            padding: 0;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background-color: #e6e6de;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 160px;
            background-color: #ffffff;
            border: 1px solid #d8d4b7;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 6px 0;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px 14px;
            text-decoration: none;
            font-size: 14px;
            color: #2d2a12;
            transition: background-color 0.2s;
        }

        .dropdown-menu a:hover {
            background-color: #f4f4f4;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            /* Flex by default now handled by JS */
            justify-content: flex-end;
            z-index: 9999;
        }

        .popup-container {
            background-color: white;
            width: 450px;
            height: 100%;
            padding: 0;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            box-shadow: 0px 5px 16px #0000001a;
            flex-shrink: 0;
        }

        .popup-header h2 {
            font-size: 18px;
            margin: 0;
            color: #2A2916;
        }

        .btn-enregistrer {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .popup-form {
            padding: 25px;
            overflow-y: auto;
            flex-grow: 1;
        }

        .popup-form .form-group {
            margin-bottom: 15px;
        }

        .popup-form .form-group label {
            display: block;
            font-weight: 600;
            color: #6E6D55;
            font-size: 14px;
            /* margin-bottom: 5px; */
        }

        .popup-form .form-group input,
        .popup-form .form-group select,
        .popup-form .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .popup-form .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .popup-form .form-group input:focus,
        .popup-form .form-group select:focus,
        .popup-form .form-group textarea:focus {
            outline: none;
            /* border-color: #c60000; */
            /* box-shadow: 0 0 0 2px rgba(198, 0, 0, 0.2); */
        }

        .popup-form .input-with-icon select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 30px;
            background-color: #fff;
        }

        .popup-form .input-file-wrapper {
            display: flex;
            align-items: center;
            /* border: 1px solid #b5af8e; */
            border-radius: 7px;
            background-color: white;
            overflow: hidden;
        }

        .popup-form .input-file-text {
            flex-grow: 1;
            border: none;
            padding: 10px 12px;
            background-color: transparent;
            color: #888;
            cursor: default;
            border-radius: 7px 0 0 7px !important;
        }

        .popup-form .input-file-text:focus {
            outline: none;
        }

        .popup-form .btn-importer {
            background-color: #A6A485;
            color: #fff !important;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #b5af8e;
            white-space: nowrap;
        }

        .popup-form .form-row {
            display: flex;
            gap: 15px;
        }

        .popup-form .form-row .form-group {
            flex: 1;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: #C60000;
            border-color: #C60000;
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding-bottom: 30px;
            position: relative;
            flex-wrap: wrap;
        }

        /* Hide default DataTables pagination */
        .dataTables_paginate {
            display: none !important;
        }

        .paginate_button {
            display: none !important;
        }
    </style>
</head>

<body>

    <!-- Main Content Block -->
    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Project Icon"
                    style="margin-right: 8px; vertical-align: middle; width: 32px;">
                Liste Des Projets
            </h2>
            <button class="add-project-btn">Ajouter un projet</button>
        </div>

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" id="generalSearch" type="text" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon"></i>
                </div>
                <!-- Type Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="typeFilter">
                        <option value="">Type (Tous)</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
                <!-- Date Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input" id="dateRangeFilter" type="text"
                        placeholder="Sélectionner une date">
                    <i class="fas fa-calendar-alt icon right-icon"></i>
                </div>
            </div>
            <div class="filter-actions">
                <button class="icon-btn" title="Filter">
                    <i class="fas fa-filter"></i>
                </button>
                <button class="icon-btn" title="Download">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>

        <!-- Data Table -->
        <table id="projectsTable" class="styled-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Intitulé du projet</th>
                    <th>Type</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Financement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be inserted here by JavaScript -->
            </tbody>
        </table>
        <?php include 'pagination.php'; ?>
    </div>

    <!-- Modal for Adding a Project -->
    <div class="modal-overlay" id="addProjectModal">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Ajouter un projet</h2>
                <button type="button" class="btn-enregistrer" id="saveProjectBtn">Enregistrer</button>
            </div>
            <form class="popup-form" id="addProjectForm">
                <div class="form-group">
                    <label for="titreProjet">Titre du projet</label>
                    <input type="text" id="titreProjet" required>
                </div>
                <div class="form-group">
                    <label for="typeProjet">Type</label>
                    <div class="input-with-icon">
                        <select id="typeProjet" required>
                            <!-- Options will be populated by JS -->
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-group" id="autreTypeWrapper" style="display: none;">
                    <label for="autreType">Si autre</label>
                    <input type="text" id="autreType">
                </div>
                <div class="form-group">
                    <label for="responsable">Responsable</label>
                    <div class="input-with-icon">
                        <select id="responsable" required>
                            <!-- Options will be populated by JS -->
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="financement">Financement prévisionnel</label>
                        <input type="text" id="financement" placeholder="ex: 80 000 TND" required>
                    </div>
                    <div class="form-group">
                        <label for="sourceFinancement">Source Financement</label>
                        <div class="input-with-icon">
                            <select id="sourceFinancement" required>
                                <!-- Options will be populated by JS -->
                            </select>
                            <i class="fas fa-chevron-down icon right-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="siteWebSource">Site web du source</label>
                    <input type="url" id="siteWebSource" placeholder="https://example.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dateDebut">Date Début</label>
                        <input type="date" id="dateDebut" required>
                    </div>
                    <div class="form-group">
                        <label for="dateFin">Date Fin</label>
                        <input type="date" id="dateFin" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objectifs">Objectifs et description</label>
                    <textarea id="objectifs" placeholder="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="budgetUpload">Budget</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi" readonly>
                        <label for="budgetUpload" class="btn-importer">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> Importer
                        </label>
                        <input type="file" id="budgetUpload" style="display:none;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="conventionUpload">Convention</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi" readonly>
                        <label for="conventionUpload" class="btn-importer">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> Importer
                        </label>
                        <input type="file" id="conventionUpload" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Modifying a Project -->
    <div class="modal-overlay" id="editProjectModal">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Modifier le projet</h2>
                <button type="button" class="btn-enregistrer" id="updateProjectBtn">Enregistrer</button>
            </div>
            <form class="popup-form" id="editProjectForm">
                <input type="hidden" id="editProjectId">
                <div class="form-group">
                    <label for="editTitreProjet">Titre du projet</label>
                    <input type="text" id="editTitreProjet" required>
                </div>
                <div class="form-group">
                    <label for="editTypeProjet">Type</label>
                    <div class="input-with-icon">
                        <select id="editTypeProjet" required>
                            <!-- Options will be populated by JS -->
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-group" id="editAutreTypeWrapper" style="display: none;">
                    <label for="editAutreType">Si autre</label>
                    <input type="text" id="editAutreType">
                </div>
                <div class="form-group">
                    <label for="editResponsable">Responsable</label>
                    <div class="input-with-icon">
                        <select id="editResponsable" required>
                            <!-- Options will be populated by JS -->
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="editFinancement">Financement prévisionnel</label>
                        <input type="text" id="editFinancement" placeholder="ex: 80 000 TND" required>
                    </div>
                    <div class="form-group">
                        <label for="editSourceFinancement">Source Financement</label>
                        <div class="input-with-icon">
                            <select id="editSourceFinancement" required>
                                <!-- Options will be populated by JS -->
                            </select>
                            <i class="fas fa-chevron-down icon right-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editSiteWebSource">Site web du source</label>
                    <input type="url" id="editSiteWebSource" placeholder="https://example.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="editDateDebut">Date Début</label>
                        <input type="date" id="editDateDebut" required>
                    </div>
                    <div class="form-group">
                        <label for="editDateFin">Date Fin</label>
                        <input type="date" id="editDateFin" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editObjectifs">Objectifs et description</label>
                    <textarea id="editObjectifs" placeholder="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="editBudgetUpload">Budget</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi" readonly>
                        <label for="editBudgetUpload" class="btn-importer">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> Importer
                        </label>
                        <input type="file" id="editBudgetUpload" style="display:none;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="editConventionUpload">Convention</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi" readonly>
                        <label for="editConventionUpload" class="btn-importer">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> Importer
                        </label>
                        <input type="file" id="editConventionUpload" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- French Locale for Flatpickr -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Static Data ---
            const projectsData = [{
                    id: 1,
                    intitule: "Détection IA Dans L'agriculture",
                    type: "National",
                    date_debut: "01/02/2025",
                    date_fin: "29/11/2025",
                    financement: "80 000 TND",
                    responsable: "Dr. Jean Dupont",
                    source_financement: "Gouvernement",
                    site_web_source: "https://gov.tn",
                    objectifs: "Améliorer les rendements agricoles.",
                    budget_file: "Budget_Agri.pdf",
                    convention_file: "Convention_Agri.pdf"
                },
                {
                    id: 2,
                    intitule: "Stockage Cloud De Données Santé",
                    type: "Bilatéral",
                    date_debut: "01/01/2023",
                    date_fin: "31/12/2023",
                    financement: "120 000 TND",
                    responsable: "Prof. Marie Curie",
                    source_financement: "Fondation Médicale",
                    site_web_source: "https://medfund.org",
                    objectifs: "Sécuriser les données des patients.",
                    budget_file: "Budget_Sante.pdf",
                    convention_file: "Convention_Sante.pdf"
                },
                {
                    id: 3,
                    intitule: "Interfaces Adaptatives AR/VR",
                    type: "Européen",
                    date_debut: "15/09/2023",
                    date_fin: "15/09/2025",
                    financement: "85 000 TND",
                    responsable: "Dr. Alan Turing",
                    source_financement: "Union Européenne",
                    site_web_source: "https://europa.eu",
                    objectifs: "Créer des expériences immersives.",
                    budget_file: "Budget_ARVR.pdf",
                    convention_file: "Convention_ARVR.pdf"
                },
                {
                    id: 4,
                    intitule: "Blockchain pour la traçabilité",
                    type: "National",
                    date_debut: "10/03/2024",
                    date_fin: "10/09/2026",
                    financement: "95 000 TND",
                    responsable: "Dr. Jean Dupont",
                    source_financement: "Gouvernement",
                    site_web_source: "https://gov.tn",
                    objectifs: "Assurer la traçabilité des produits.",
                    budget_file: "Budget_Block.pdf",
                    convention_file: "Convention_Block.pdf"
                },
                {
                    id: 5,
                    intitule: "Analyse prédictive en finance",
                    type: "Bilatéral",
                    date_debut: "20/05/2022",
                    date_fin: "20/05/2024",
                    financement: "150 000 TND",
                    responsable: "Prof. Marie Curie",
                    source_financement: "Banque Centrale",
                    site_web_source: "https://bct.tn",
                    objectifs: "Prédire les tendances du marché.",
                    budget_file: "Budget_Finance.pdf",
                    convention_file: "Convention_Finance.pdf"
                }
            ];

            let allProjects = [...projectsData];
            let filteredProjects = [...allProjects];
            let table;

            // --- DOM Elements ---
            const tbody = document.querySelector('#projectsTable tbody');
            const addProjectBtn = document.querySelector('.add-project-btn');

            // Filters
            const filterSearch = document.getElementById('generalSearch');
            const filterType = document.getElementById('typeFilter');
            const filterDate = document.getElementById('dateRangeFilter');

            // Add Modal Elements
            const addModal = document.getElementById('addProjectModal');
            const addModalForm = document.getElementById('addProjectForm');
            const saveProjectBtn = document.getElementById('saveProjectBtn');
            const addTitre = document.getElementById('titreProjet');
            const addType = document.getElementById('typeProjet');
            const addAutreWrapper = document.getElementById('autreTypeWrapper');
            const addAutre = document.getElementById('autreType');
            const addResponsable = document.getElementById('responsable');
            const addFinancement = document.getElementById('financement');
            const addSource = document.getElementById('sourceFinancement');
            const addSiteWeb = document.getElementById('siteWebSource');
            const addDateDebut = document.getElementById('dateDebut');
            const addDateFin = document.getElementById('dateFin');
            const addObjectifs = document.getElementById('objectifs');
            const addBudgetFile = document.getElementById('budgetUpload');
            const addConventionFile = document.getElementById('conventionUpload');

            // Edit Modal Elements
            const editModal = document.getElementById('editProjectModal');
            const editModalForm = document.getElementById('editProjectForm');
            const updateProjectBtn = document.getElementById('updateProjectBtn');
            const editProjectId = document.getElementById('editProjectId');
            const editTitre = document.getElementById('editTitreProjet');
            const editType = document.getElementById('editTypeProjet');
            const editAutreWrapper = document.getElementById('editAutreTypeWrapper');
            const editAutre = document.getElementById('editAutreType');
            const editResponsable = document.getElementById('editResponsable');
            const editFinancement = document.getElementById('editFinancement');
            const editSource = document.getElementById('editSourceFinancement');
            const editSiteWeb = document.getElementById('editSiteWebSource');
            const editDateDebut = document.getElementById('editDateDebut');
            const editDateFin = document.getElementById('editDateFin');
            const editObjectifs = document.getElementById('editObjectifs');
            const editBudgetFile = document.getElementById('editBudgetUpload');
            const editConventionFile = document.getElementById('editConventionUpload');


            // --- Helper Functions ---
            const notify = (msg, type = 'success') => {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: type,
                    title: msg
                });
            };

            const parseDate = (dateStr) => { // "dd/mm/yyyy" -> Date object
                if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return null;
                const [day, month, year] = dateStr.split('/');
                return new Date(year, month - 1, day);
            };

            const formatDateToYYYYMMDD = (dmyDate) => {
                if (!dmyDate || !/^\d{2}\/\d{2}\/\d{4}$/.test(dmyDate)) return '';
                const [day, month, year] = dmyDate.split('/');
                return `${year}-${month}-${day}`;
            };

            const formatDateToDDMMYYYY = (isoDate) => {
                if (!isoDate) return '';
                const [year, month, day] = isoDate.split('-');
                return `${day}/${month}/${year}`;
            };


            // --- Modal Logic ---
            const openAddModal = () => {
                addModalForm.reset();
                addAutreWrapper.style.display = 'none';
                const today = new Date().toISOString().split('T')[0];
                addDateDebut.value = today;
                addDateFin.value = today;
                addModal.style.display = 'flex';
            };

            const closeAddModal = () => {
                addModal.style.display = 'none';
            };

            const openEditModal = (project) => {
                editModalForm.reset();
                editAutreWrapper.style.display = 'none';

                // Populate data
                editProjectId.value = project.id;
                editTitre.value = project.intitule;
                editFinancement.value = project.financement;
                editResponsable.value = project.responsable;
                editSource.value = project.source_financement;
                editSiteWeb.value = project.site_web_source;
                editObjectifs.value = project.objectifs;
                editDateDebut.value = formatDateToYYYYMMDD(project.date_debut);
                editDateFin.value = formatDateToYYYYMMDD(project.date_fin);

                // Handle file input placeholder text
                editBudgetFile.previousElementSibling.previousElementSibling.value = project.budget_file || '';
                editConventionFile.previousElementSibling.previousElementSibling.value = project
                    .convention_file || '';

                // Handle 'Type' dropdown, including 'Autre'
                const standardTypes = [...editType.options].map(o => o.value);
                if (standardTypes.includes(project.type)) {
                    editType.value = project.type;
                } else {
                    editType.value = 'Autre';
                    editAutreWrapper.style.display = 'block';
                    editAutre.value = project.type;
                }

                editModal.style.display = 'flex';
            };

            const closeEditModal = () => {
                editModal.style.display = 'none';
            };

            const handleSaveProject = (e) => {
                e.preventDefault();
                let typeValue = addType.value;
                if (typeValue === 'Autre') {
                    typeValue = addAutre.value.trim();
                }

                if (!addTitre.value.trim() || !typeValue) {
                    notify('Veuillez remplir les champs obligatoires.', 'error');
                    return;
                }

                const newId = allProjects.length > 0 ? Math.max(...allProjects.map(p => p.id)) + 1 : 1;
                const newProject = {
                    id: newId,
                    intitule: addTitre.value.trim(),
                    type: typeValue,
                    responsable: addResponsable.value,
                    date_debut: formatDateToDDMMYYYY(addDateDebut.value),
                    date_fin: formatDateToDDMMYYYY(addDateFin.value),
                    financement: addFinancement.value.trim(),
                    source_financement: addSource.value,
                    site_web_source: addSiteWeb.value.trim(),
                    objectifs: addObjectifs.value.trim(),
                    budget_file: addBudgetFile.files[0]?.name || 'Aucun fichier choisi',
                    convention_file: addConventionFile.files[0]?.name || 'Aucun fichier choisi',
                };

                allProjects.push(newProject);
                applyFilters();
                closeAddModal();
                notify('Projet ajouté!');
            };

            const handleUpdateProject = (e) => {
                e.preventDefault();
                const id = parseInt(editProjectId.value, 10);

                let typeValue = editType.value;
                if (typeValue === 'Autre') {
                    typeValue = editAutre.value.trim();
                }

                if (!editTitre.value.trim() || !typeValue) {
                    notify('Veuillez remplir les champs obligatoires.', 'error');
                    return;
                }

                const projectData = {
                    intitule: editTitre.value.trim(),
                    type: typeValue,
                    responsable: editResponsable.value,
                    date_debut: formatDateToDDMMYYYY(editDateDebut.value),
                    date_fin: formatDateToDDMMYYYY(editDateFin.value),
                    financement: editFinancement.value.trim(),
                    source_financement: editSource.value,
                    site_web_source: editSiteWeb.value.trim(),
                    objectifs: editObjectifs.value.trim(),
                    budget_file: editBudgetFile.files[0]?.name || allProjects.find(p => p.id === id)
                        .budget_file,
                    convention_file: editConventionFile.files[0]?.name || allProjects.find(p => p.id === id)
                        .convention_file,
                };

                const index = allProjects.findIndex(p => p.id === id);
                if (index !== -1) {
                    allProjects[index] = {
                        ...allProjects[index],
                        ...projectData
                    };
                }

                applyFilters();
                closeEditModal();
                notify('Projet mis à jour!');
            };


            // --- Rendering ---
            const renderTable = () => {
                tbody.innerHTML = '';

                if (filteredProjects.length === 0) {
                    tbody.innerHTML =
                        `<tr><td colspan="7" style="text-align:center; padding: 20px;">Aucun projet trouvé.</td></tr>`;
                } else {
                    filteredProjects.forEach(p => {
                        const tr = document.createElement('tr');
                        tr.dataset.id = p.id;
                        tr.innerHTML = `
                                <td><input type="checkbox" class="row-check"></td>
                                <td>${p.intitule}</td>
                                <td>${p.type}</td>
                                <td>${p.date_debut}</td>
                                <td>${p.date_fin}</td>
                                <td>${p.financement}</td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn" aria-haspopup="true" aria-expanded="false">⋯</button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="btn-modifier">Modifier</a>
                                            <a href="/gestion-des-projets-details-projets" class="btn-voir">Voir</a>
                                        </div>
                                    </div>
                                </td>
                            `;
                        tbody.appendChild(tr);
                    });
                }

                // Initialize DataTables if not already done
                if (!table) {
                    table = $('#projectsTable').DataTable({
                        paging: true,
                        searching: true,
                        ordering: false,
                        info: false,
                        pageLength: 3,
                        dom: '<"top">rt<"clear">', // Hide default search (f) and length (l) controls
                        language: {
                            emptyTable: "Aucun projet trouvé",
                            zeroRecords: "Aucun enregistrement correspondant trouvé"
                        }
                    });

                    // Initialize unified pagination
                    if (typeof PMOPagination !== 'undefined') {
                        PMOPagination.init(table);
                    }
                } else {
                    table.clear().rows.add($('#projectsTable tbody tr')).draw();
                }
            };

            // --- Filtering Logic ---
            const applyFilters = () => {
                const searchTerm = filterSearch.value.toLowerCase();
                const typeTerm = filterType.value;
                const selectedDateStr = filterDate.value;

                let selectedDate = null;
                if (selectedDateStr) {
                    selectedDate = parseDate(selectedDateStr);
                }

                filteredProjects = allProjects.filter(p => {
                    const projectStartDate = parseDate(p.date_debut);
                    const projectEndDate = parseDate(p.date_fin);

                    const matchesSearch = searchTerm === '' || p.intitule.toLowerCase().includes(
                        searchTerm) || p.type.toLowerCase().includes(searchTerm);
                    const matchesType = typeTerm === '' || p.type === typeTerm;

                    const matchesDate = !selectedDate || (projectStartDate && projectEndDate &&
                        selectedDate >= projectStartDate && selectedDate <= projectEndDate);

                    return matchesSearch && matchesType && matchesDate;
                });

                renderTable();
            };

            // --- Event Listeners and Initialization ---
            const init = () => {
                const types = [...new Set(allProjects.map(p => p.type))];
                const responsables = [...new Set(allProjects.map(p => p.responsable))];
                const sources = [...new Set(allProjects.map(p => p.source_financement))];

                const populateSelect = (selectEl, options, addOtherOption = false) => {
                    selectEl.innerHTML = `<option value="">Sélection..</option>`;
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.textContent = opt;
                        selectEl.appendChild(option);
                    });
                    if (addOtherOption) {
                        const otherOption = document.createElement('option');
                        otherOption.value = 'Autre';
                        otherOption.textContent = 'Autre';
                        selectEl.appendChild(otherOption);
                    }
                };

                populateSelect(filterType, types);
                populateSelect(addType, types, true);
                populateSelect(editType, types, true);
                populateSelect(addResponsable, responsables);
                populateSelect(editResponsable, responsables);
                populateSelect(addSource, sources);
                populateSelect(editSource, sources);

                flatpickr(filterDate, {
                    mode: "single",
                    dateFormat: "d/m/Y",
                    locale: "fr",
                    onClose: function() {
                        applyFilters();
                    }
                });

                const setupFileInput = (inputId) => {
                    const fileInput = document.getElementById(inputId);
                    const textInput = fileInput.previousElementSibling.previousElementSibling;
                    fileInput.addEventListener('change', () => {
                        if (fileInput.files.length > 0) textInput.value = fileInput.files[0].name;
                        else textInput.value = '';
                    });
                };
                setupFileInput('budgetUpload');
                setupFileInput('conventionUpload');
                setupFileInput('editBudgetUpload');
                setupFileInput('editConventionUpload');

                // Bind events
                addProjectBtn.addEventListener('click', openAddModal);
                saveProjectBtn.addEventListener('click', handleSaveProject);
                updateProjectBtn.addEventListener('click', handleUpdateProject);

                addModal.addEventListener('click', (e) => {
                    if (e.target === addModal) closeAddModal();
                });
                editModal.addEventListener('click', (e) => {
                    if (e.target === editModal) closeEditModal();
                });

                addType.addEventListener('change', () => {
                    addAutreWrapper.style.display = addType.value === 'Autre' ? 'block' : 'none';
                });
                editType.addEventListener('change', () => {
                    editAutreWrapper.style.display = editType.value === 'Autre' ? 'block' : 'none';
                });

                filterSearch.addEventListener('input', applyFilters);
                filterType.addEventListener('change', applyFilters);

                document.body.addEventListener('click', (e) => {
                    // Dropdown menu logic
                    const actionBtn = e.target.closest('.action-btn');
                    if (actionBtn) {
                        const dropdown = actionBtn.nextElementSibling;
                        const isExpanded = actionBtn.getAttribute('aria-expanded') === 'true';
                        document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList
                            .remove('show'));
                        if (!isExpanded) {
                            dropdown.classList.add('show');
                            actionBtn.setAttribute('aria-expanded', 'true');
                        } else {
                            actionBtn.setAttribute('aria-expanded', 'false');
                        }
                    } else if (!e.target.closest('.actions')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList
                            .remove('show'));
                        document.querySelectorAll('.action-btn[aria-expanded="true"]').forEach(btn =>
                            btn.setAttribute('aria-expanded', 'false'));
                    }

                    // Modifier button click
                    if (e.target.classList.contains('btn-modifier')) {
                        e.preventDefault();
                        const projectId = parseInt(e.target.closest('tr').dataset.id, 10);
                        const project = allProjects.find(p => p.id === projectId);
                        if (project) openEditModal(project);
                    }

                });

                renderTable();
            };

            init();
        });
    </script>
</body>

</html>