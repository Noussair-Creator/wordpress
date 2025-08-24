<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des inscriptions</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <style>
    /* General Page Styles */
    .content-block {
        background: #fff;
        border-radius: 10px;
        padding: 24px;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 16px 0;
    }

    /* New: Red color for checked checkboxes */
    input[type="checkbox"]:checked {
        accent-color: #c60000;
    }

    /* Filter Bar Layout */
    .filter-bar {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .filter-bottom-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-selectgb {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-buttons {
        display: flex;
        border: 1px solid #d8d4b7;
        border-radius: 5px;
        overflow: hidden;
        width: max-content;
    }

    .filter-btn {
        padding: 8px 14px;
        border: none;
        background: transparent;
        color: #2d2a12;
        font-weight: 500;
        cursor: pointer;
    }

    .filter-btn.active {
        background-color: #b2ae90;
        color: #fff;
        font-weight: bold;
    }

    .filter-select {
        border: 1px solid #d8d4b7;
        border-radius: 5px;
        padding: 10px 12px;
        background-color: #fff;
        color: #999;
        font-size: 15px;
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        padding-right: 30px;
        width: 200px;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .icon-btn {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        width: 40px;
        height: 40px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        color: #d71920;
        font-size: 18px;
        transition: background 0.2s;
    }

    .icon-btn:hover {
        background-color: #f8f8f8;
    }

    .btn-statut {
        background-color: #c80000;
        color: white;
        border: none;
        padding: 10px 24px;
        font-size: 14px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-ajouter-colonnes {
        background: #fff;
        color: #333;
        border: 1px solid #ccc;
        padding: 9px 14px;
        font-size: 14px;
        border-radius: 6px;
        font-weight: 500;
    }

    /* New: Statut Dropdown Styles */
    .statut-dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .statut-dropdown-menu {
        display: none;
        position: absolute;
        top: 110%;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        min-width: 180px;
        border-radius: 6px;
        padding: 5px 0;
        overflow: hidden;
    }

    .statut-dropdown-option {
        padding: 10px 15px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
        display: block;
        text-decoration: none;
        white-space: nowrap;
    }

    .statut-dropdown-option:hover {
        background-color: #f5f5f5;
    }

    /* Table Styles */
    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    #candidaturesTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
        overflow: visible;
    }

    #candidaturesTable thead {
        border: none !important;
        position: static;
        transform: translateY(-15px);
        background-color: #f3f1e9;
    }

    #candidaturesTable th {
        border: 0px solid #EBE9D7;
        padding: 26px 10px 17px !important;
    }

    #candidaturesTable td {
        border: 1px solid #EBE9D7;
        padding: 14px;
        text-align: left;
        box-shadow: none !important;
    }

    #candidaturesTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important;
    }

    .doc-info {
        text-align: center !important;
        position: relative;
        vertical-align: middle;
    }

    .doc-count {
        background-color: #f0f0f0;
        color: #555;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        position: relative;
        top: -13px;
        left: -5px;
    }

    /* Badges for Status */
    .badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 20px;
        border: 2px solid transparent;
    }

    .badge-danger {
        color: #d71920;
        background-color: #fff0f0;
        border-color: #d71920;
    }

    .badge-warning {
        color: #d89e00;
        background-color: #fff9e6;
        border-color: #d89e00;
    }

    .badge-success {
        color: #198754;
        background-color: #e6f7ee;
        border-color: #198754;
    }

    .badge-secondary {
        color: #555;
        background-color: #f0f0f0;
        border-color: #ccc;
    }

    .badge-info {
        background-color: #808066;
    }

    /* Actions Menu */
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
        font-size: 31px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s;
        line-height: 1;
        padding: 0;
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
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 6px 0;
        z-index: 1000;
        width: 160px;
        right: 0;
    }

    .dropdown-menu a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        text-decoration: none;
        font-size: 14px;
        color: #2d2a12;
        transition: background-color 0.2s;
    }

    .dropdown-menu a:hover {
        background-color: #f4f4f4;
    }

    .dropdown-menu i {
        font-size: 15px;
        color: #2d2a12;
    }

    /* DataTables Customization */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        margin-bottom: 15px;
    }

    div#candidaturesTable_wrapper div.dt-buttons {
        float: right !important;
    }

    div#candidaturesTable_wrapper span.dt-down-arrow {
        display: none;
    }

    .dt-button.buttons-colvis {
        background-color: #fff !important;
        padding: 7px 14px;
        position: relative;
        top: -71px;
        right: 93px;
        border: 2px solid #d71920;
        border-radius: 5px;
        font-weight: 700;
        color: #d71920;
        cursor: pointer;
    }

    .dt-button-collection {
        border-radius: 16px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    }

    div.dt-button-background {
        background: rgba(0, 0, 0, 0.5);
    }

    /* Pagination */
    #candidaturesTable_paginate {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 6px;
        font-family: 'Poppins', sans-serif;
    }

    #candidaturesTable_paginate .paginate_button {
        background-color: #fff;
        border: 2px solid #c40000;
        color: #c40000;
        font-weight: 500;
        padding: 6px 10px;
        min-width: 36px;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #candidaturesTable_paginate .paginate_button.current,
    #candidaturesTable_paginate .paginate_button:hover {
        background-color: #c40000;
        color: #fff !important;
        border-color: #c40000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none;
    }

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        display: none;
    }

    button.swal2-confirm.swal2-styled {
        background-color: #c80000;
    }

    /* START: Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        /* Ensure modal is on top */
    }

    .modal-content {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 550px;
        font-family: 'Segoe UI', sans-serif;
        position: fixed;
        /* Changed from absolute to fixed */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .close-modal-btn {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #888;
        padding: 0;
        line-height: 1;
    }

    .modal-body {
        margin-bottom: 24px;
    }

    .column-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
    }

    .column-btn {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .column-btn:hover {
        background-color: #f0f0f0;
    }

    .column-btn.selected {
        border-color: #c60000;
        color: #c60000;
        font-weight: 500;
        background-color: #fff0f0;
        /* Light red background for selected */
    }

    .modal-footer {
        text-align: right;
    }

    .btn-enregistrer {
        background-color: #c80000;
        color: white;
        border: none;
        padding: 12px 28px;
        font-size: 16px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }

    /* END: Modal Styles */
    </style>
</head>

<body>

    <div class="content-block">
        <div class="header-bar">
            <h2>
                <img src="/wp-content/plugins/plateforme-master/images/ed/16406436.png" alt="Icon"
                    style="width: 40px; margin-right: 8px; vertical-align: middle;">
                Tableau des inscriptions
            </h2>
        </div>

        <hr class="section-divider">

        <!-- Updated Filter Bar Structure -->
        <div class="filter-bar">
            <div class="filter-buttons">
                <button class="filter-btn active">Tous</button>
                <button class="filter-btn">Externes</button>
                <button class="filter-btn">Internes</button>
            </div>
            <div class="filter-bottom-row">
                <div class="filter-selectgb">
                    <select id="ecoleFilter" class="filter-select">
                        <option value="">École Doctorale</option>
                        <option value="Sciences Et Technologies">Sciences Et Technologies</option>
                        <option value="Santé & Biotechnologies">Santé & Biotechnologies</option>
                        <option value="Lettres, Langues & Sciences Humaines">Lettres, Langues & Sciences Humaines
                        </option>
                    </select>
                    <select id="typeFilter" class="filter-select">
                        <option value="">Type</option>
                        <option value="Réinscription 2A">Réinscription 2A</option>
                        <option value="Inscription">Inscription</option>
                        <option value="Réinscription 3A">Réinscription 3A</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <!-- New Statut Dropdown -->
                    <div class="statut-dropdown-wrapper">
                        <button class="btn-statut">Statut <i class="fa fa-caret-down"></i></button>
                        <div class="statut-dropdown-menu">
                            <a href="#" class="statut-dropdown-option">validé</a>
                            <a href="#" class="statut-dropdown-option">Dossier Incomplet</a>
                            <a href="#" class="statut-dropdown-option">Refusé</a>
                        </div>
                    </div>
                    <button class="btn-ajouter-colonnes">Ajouter Des Colonnes</button>
                    <button class="icon-btn"><i class="fa fa-filter"></i></button>
                    <button class="icon-btn"><i class="fa fa-download"></i></button>
                </div>
            </div>
        </div>


        <table id="candidaturesTable" class="styled-table display" style="width:100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>N° Matricule</th>
                    <th>Nom et prénom</th>
                    <th>Doctorats</th>
                    <th>Date de dépôt</th>
                    <th>Statut dossier</th>
                    <th>Type</th>
                    <th>Documents</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Content updated from screenshot -->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>6780014</td>
                    <td>Ahmed Ben Salem</td>
                    <td>Sciences Et Technologies</td>
                    <td>03/06/2025</td>
                    <td><span class="badge badge-danger">Incomplet</span></td>
                    <td>Réinscription 2A</td>
                    <td class="doc-info"><i class="fa fa-paperclip"></i> <span class="doc-count">3</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">⋮</button>
                            <div class="dropdown-menu">
                                <a href="/dossier-inscription-ecole-doctorale   "><i class="fa fa-eye"></i> Voir
                                    dossier</a>
                                <a href="#"><i class="fa fa-envelope"></i> E-mail</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>0799A02</td>
                    <td>Ahmed Ben Salem</td>
                    <td>Santé & Biotechnologies</td>
                    <td>03/06/2025</td>
                    <td><span class="badge badge-warning">En attente</span></td>
                    <td>Inscription</td>
                    <td class="doc-info"><i class="fa fa-paperclip"></i> <span class="doc-count">3</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">⋮</button>
                            <div class="dropdown-menu">
                                <a href="/dossier-inscription-ecole-doctorale"><i class="fa fa-eye"></i> Voir
                                    dossier</a>
                                <a href="#"><i class="fa fa-envelope"></i> E-mail</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" checked></td>
                    <td>0799A02</td>
                    <td>Ahmed Ben Salem</td>
                    <td>Lettres, Langues & Sciences Humaines</td>
                    <td>02/06/2025</td>
                    <td><span class="badge badge-success">Validé</span></td>
                    <td>Inscription</td>
                    <td class="doc-info"><i class="fa fa-paperclip"></i> <span class="doc-count">6</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">⋮</button>
                            <div class="dropdown-menu">
                                <a href="/dossier-inscription-ecole-doctorale"><i class="fa fa-eye"></i> Voir
                                    dossier</a>
                                <a href="#"><i class="fa fa-envelope"></i> E-mail</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" checked></td>
                    <td>0799A02</td>
                    <td>Ahmed Ben Salem</td>
                    <td>Santé & Biotechnologies</td>
                    <td>02/06/2025</td>
                    <td><span class="badge badge-success">Validé</span></td>
                    <td>Réinscription 3A</td>
                    <td class="doc-info"><i class="fa fa-paperclip"></i> <span class="doc-count">6</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">⋮</button>
                            <div class="dropdown-menu">
                                <a href="/dossier-inscription-ecole-doctorale"><i class="fa fa-eye"></i> Voir
                                    dossier</a>
                                <a href="#"><i class="fa fa-envelope"></i> E-mail</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- End of updated content -->
            </tbody>
        </table>
    </div>

    <!-- START: Modal HTML -->
    <div id="addColumnModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ajouter des colonnes</h2>
                <button class="close-modal-btn">&times;</button>
            </div>
            <div class="modal-body">
                <div class="column-grid">
                    <button class="column-btn">Etablissement</button>
                    <button class="column-btn">Statut universitaire</button>
                    <button class="column-btn">Master</button>
                    <button class="column-btn selected">Score</button>
                    <button class="column-btn selected">Matricule</button>
                    <button class="column-btn">Etudiant</button>
                    <button class="column-btn">Diplome</button>
                    <button class="column-btn">Statut etudiant</button>
                    <button class="column-btn selected">Date</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-enregistrer">Enregistrer</button>
            </div>
        </div>
    </div>
    <!-- END: Modal HTML -->

    <!-- jQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        // DataTable initialization
        var table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: false,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'Bfrtip',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible"
            },
            // Disable ordering for the first column (checkboxes)
            columnDefs: [{
                orderable: false,
                targets: 0
            }]
        });

        // Handle click on "Select all" checkbox
        $('#checkAll').on('click', function() {
            // Get all rows, even across pages
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox in table body to deselect "Select all"
        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
            // If a checkbox is unchecked
            if (!this.checked) {
                var el = $('#checkAll').get(0);
                // If "Select all" is checked, uncheck it
                if (el && el.checked) {
                    el.checked = false;
                }
            }
        });


        // Custom filtering function for dropdowns
        $('#ecoleFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(3).search(selectedValue).draw(); // Column 3 is "Doctorats"
        });

        $('#typeFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(6).search(selectedValue).draw(); // Column 6 is "Type"
        });

        // Filter buttons logic 
        const filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Generic dropdown toggle function 
        const setupDropdown = (buttonSelector, menuSelector) => {
            const button = document.querySelector(buttonSelector);
            if (!button) return;

            const menu = button.nextElementSibling;
            if (!menu || !menu.matches(menuSelector)) return;

            button.addEventListener('click', function(e) {
                e.stopPropagation();
                // Close all other dropdowns 
                document.querySelectorAll('.dropdown-menu, .statut-dropdown-menu').forEach(
                    otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.style.display = 'none';
                        }
                    });
                // Toggle the current menu 
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
        };

        // Setup for multiple action buttons 
        document.querySelectorAll('.action-btn').forEach(button => {
            const menu = button.nextElementSibling;
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.dropdown-menu, .statut-dropdown-menu').forEach(
                    m => {
                        if (m !== menu) m.style.display = 'none';
                    });
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Setup for the new statut dropdown 
        setupDropdown('.btn-statut', '.statut-dropdown-menu');

        // Global click listener to close all menus 
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu, .statut-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        });

        // START: Modal Logic
        const openModalBtn = document.querySelector('.btn-ajouter-colonnes');
        const modal = document.getElementById('addColumnModal');
        const closeModalBtn = modal.querySelector('.close-modal-btn');
        const saveModalBtn = modal.querySelector('.btn-enregistrer');

        const openModal = () => {
            modal.style.display = 'block';
        };

        const closeModal = () => {
            modal.style.display = 'none';
        };

        openModalBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        saveModalBtn.addEventListener('click', closeModal);

        // Close modal if the overlay (background) is clicked
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Add toggle functionality to column buttons inside the modal
        const columnButtons = modal.querySelectorAll('.column-btn');
        columnButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });
        // END: Modal Logic
    });
    </script>

</body>

</html>