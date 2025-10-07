<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Dépenses</title>
    <!-- External CSS Libraries -->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Flatpickr CSS for Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    <!-- Internal CSS Styles (from your original code) -->
    <style>
        .dashboard-sub-title {
            font-weight: bold;
            font-size: 1.25rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            /* Full width styling */
            margin: -24px -24px 24px -24px;
            /* top | right & left | bottom */
            padding: 15px 24px;
            /* vertical | horizontal */
            border-radius: 10px 10px 0 0;
            /* Match parent's top corners */
            margin-bottom: 35px !important;
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

        .content-block {
            background: #fff;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        /* ---------- Table Styles (Refactored) ---------- */
        .styled-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        .styled-table thead {
            background: #f3f1e9;
        }

        .styled-table th,
        .styled-table td {
            padding: 14px;
            text-align: left;
        }

        .styled-table tbody tr:hover {
            background: #fafafa;
        }

        .styled-table th {
            border: 0;
            font-weight: 600;
        }

        /* Borders */
        .styled-table td {
            border-right: 1px solid #A6A4853D;
            border-bottom: 1px solid #A6A4853D;
        }

        .styled-table tbody td:first-child {
            border-left: 1px solid #A6A4853D;
        }

        .styled-table tbody tr:first-child td {
            border-top: 1px solid #A6A4853D;
        }

        /* Border Radius */
        .styled-table thead th:first-child {
            border-radius: 12px 0 0 12px;
        }

        .styled-table thead th:last-child {
            border-radius: 0 12px 12px 0;
        }

        .styled-table tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
        }

        .styled-table tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
        }

        .styled-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        .styled-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        .filter-bar {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;
            padding-bottom: 30px;
            position: relative;
            flex-wrap: wrap;
        }

        th {
            border-bottom: 1px solid #EBE9D7 !important;
            border-top: 1px solid #EBE9D7 !important;
            padding: 10px 10px 10px !important;
        }

        td {
            box-shadow: none !important;
        }

        thead {
            position: relative;
            top: -17px;
        }

        #depensesTable {
            border: none !important;
            border-collapse: collapse;
            box-shadow: none !important;
        }

        #depensesTable th {
            border: 0px solid #EBE9D7;
            text-align: center;
        }

        #depensesTable td {
            border: 1px solid #EBE9D7;
            text-align: center;
        }

        #depensesTable thead {
            border: none !important;
            position: static;
            transform: translateY(-15px);
        }

        #depensesTable tbody tr:first-child td:first-child {
            border-top: 1px solid #EBE9D7 !important;
        }

        #depensesTable {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 50x 50px 0 0;
            /* overflow: hidden; */
        }


        #depensesTable thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        #depensesTable thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        #depensesTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #depensesTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        #depensesTable tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
        }

        #depensesTable tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
        }

        #depensesTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #depensesTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        /* --- New styles based on the design images --- */
        .top-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .info-card-content {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-row {
            display: flex;
            gap: 5rem;
            align-items: flex-start;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 0.75rem;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            width: 150px;
            color: #6E6D55;
            font-weight: 500;
            white-space: nowrap;
        }

        .info-value {
            font-weight: 600;
        }

        div.info-value {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .info-value.source-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .info-value .fa-play {
            color: #C60000;
            font-size: 10px;
        }

        .attachment-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #555;
            cursor: pointer;
        }

        .attachment-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #6E6D55;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-cell {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-cell .fa-check {
            color: #28a745;
        }

        .status-cell .fa-hourglass-half {
            color: #ffc107;
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-controls .page-btn,
        .pagination-controls .page-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 6px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: #fff;
            color: #333;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }

        .pagination-controls .page-btn:hover {
            background-color: #f3f1e9;
        }

        .pagination-controls .page-num.active {
            background-color: #c60000;
            color: #fff;
            border-color: #c60000;
            font-weight: bold;
        }

        .pagination-controls .page-btn.disabled {
            color: #aaa;
            cursor: not-allowed;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <!-- Top section with two info cards -->
    <div class="top-info-grid">
        <div class="content-block">
            <h2 class="dashboard-sub-title">Nom plateforme</h2>
            <div class="info-card-content">
                <div class="info-row">
                    <span class="info-label">Nom du projet / plateforme :</span>
                    <span class="info-value">Plateforme Biotechnologie</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Etablissement :</span>
                    <span class="info-value">Faculté des Sciences de Tunis (FDST)</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Responsable financier :</span>
                    <span class="info-value">Dr. Hatem Kallel</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Période :</span>
                    <span class="info-value">Janvier 2025 – Décembre 2025</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Source(s) de financement :</span>
                    <div class="info-value">
                        <div class="source-item"><i class="fas fa-play"></i> Budget UTM : 500 000 DT</div>
                        <div class="source-item"><i class="fas fa-play"></i> Horizon Europe : 300 000 DT</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-block">
            <h2 class="dashboard-sub-title">Budget global</h2>
            <div class="info-card-content">
                <div class="info-row">
                    <span class="info-label">Budget alloué :</span>
                    <span class="info-value">850 000 DT</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Dépenses engagées :</span>
                    <span class="info-value">590 000 DT</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Dépenses payées :</span>
                    <span class="info-value">540 000 DT</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Reste disponible :</span>
                    <span class="info-value">260 000 DT</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Taux de consommation :</span>
                    <span class="info-value">69 %</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle section: Breakdown by expense type -->
    <div class="content-block">
        <h2 class="dashboard-sub-title">Répartition par type de dépense</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Type de dépense</th>
                    <th>Montant</th>
                    <th>Justificatifs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Investissement</td>
                    <td>380 000 DT</td>
                    <td>
                        <div class="attachment-icon"><i class="fas fa-paperclip"></i><span
                                class="attachment-badge">3</span></div>
                    </td>
                </tr>
                <tr>
                    <td>Maintenance</td>
                    <td>110 000 DT</td>
                    <td>
                        <div class="attachment-icon"><i class="fas fa-paperclip"></i><span
                                class="attachment-badge">2</span></div>
                    </td>
                </tr>
                <tr>
                    <td>Fonctionnement</td>
                    <td>80 000 DT</td>
                    <td>
                        <div class="attachment-icon"><i class="fas fa-paperclip"></i><span
                                class="attachment-badge">4</span></div>
                    </td>
                </tr>
                <tr>
                    <td>Formation</td>
                    <td>15 000 DT</td>
                    <td>
                        <div class="attachment-icon"><i class="fas fa-paperclip"></i><span
                                class="attachment-badge">4</span></div>
                    </td>
                </tr>
                <tr>
                    <td>Autres</td>
                    <td>5 000 DT</td>
                    <td>
                        <div class="attachment-icon"><i class="fas fa-paperclip"></i><span
                                class="attachment-badge">1</span></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Main Content Block for recent expenses table -->
    <div class="content-block">
        <h2 class="dashboard-sub-title">Suivi des dépenses récentes</h2>

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" id="generalSearch" type="text" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon"></i>
                </div>
                <!-- Responsible Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="responsableFilter">
                        <option value="">Responsable (Tous)</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
                <!-- Date Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input" id="dateFilter" type="text" placeholder="Date">
                    <i class="fas fa-calendar-alt icon right-icon"></i>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <table id="depensesTable" class="styled-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nature de dépense</th>
                    <th>Montant</th>
                    <th>Responsable</th>
                    <th>Statut</th>
                    <th>Justificatifs</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be inserted here by JavaScript -->
            </tbody>
        </table>

        <div class="pagination-container">
            <div class="pagination-controls" id="paginationControls">
                <!-- Pagination controls will be inserted here by JavaScript -->
            </div>
        </div>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- French Locale for Flatpickr -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Static Data ---
            const depensesData = [{
                id: 1,
                date: "22/05/2025",
                nature: "Achat centrifuge",
                montant: "120 000 DT",
                responsable: "Dr. Kallel",
                statut: "Payée",
                justificatifs: 3
            },
            {
                id: 2,
                date: "10/06/2025",
                nature: "Contrat maintenance RMN",
                montant: "35 000 DT",
                responsable: "Mme Salem",
                statut: "Payée",
                justificatifs: 2
            },
            {
                id: 3,
                date: "28/06/2025",
                nature: "Consommables labo",
                montant: "18 500 DT",
                responsable: "Y. Mejri",
                statut: "Payée",
                justificatifs: 4
            },
            {
                id: 4,
                date: "05/07/2025",
                nature: "Extension baie serveurs",
                montant: "90 000 DT",
                responsable: "Ing. Zouari",
                statut: "En attente",
                justificatifs: 4
            },
            {
                id: 5,
                date: "29/07/2025",
                nature: "Réparation détecteur EDS",
                montant: "22 000 DT",
                responsable: "Mme Salem",
                statut: "Payée",
                justificatifs: 1
            },
            // Add more data for pagination testing
            {
                id: 6,
                date: "01/08/2025",
                nature: "Abonnement logiciel",
                montant: "5 000 DT",
                responsable: "Dr. Kallel",
                statut: "Payée",
                justificatifs: 1
            },
            {
                id: 7,
                date: "15/08/2025",
                nature: "Achat matériel bureau",
                montant: "2 500 DT",
                responsable: "Y. Mejri",
                statut: "En attente",
                justificatifs: 2
            },
            ];

            let table;

            // --- Helper Functions ---
            const parseDate = (dateStr) => { // "dd/mm/yyyy" -> Date object
                if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return null;
                const [day, month, year] = dateStr.split('/');
                return new Date(year, month - 1, day);
            };

            const populateSelect = (selectEl, options) => {
                // Clear existing options except the first one
                while (selectEl.options.length > 1) {
                    selectEl.remove(1);
                }
                options.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt;
                    option.textContent = opt;
                    selectEl.appendChild(option);
                });
            };

            // --- Rendering ---
            const renderTable = () => {
                if (!table) {
                    table = $('#depensesTable').DataTable({
                        data: depensesData,
                        columns: [{
                            data: 'date'
                        },
                        {
                            data: 'nature'
                        },
                        {
                            data: 'montant'
                        },
                        {
                            data: 'responsable'
                        },
                        {
                            data: 'statut',
                            render: function (data, type, row) {
                                const icon = data === 'Payée' ?
                                    '<i class="fas fa-check"></i>' :
                                    '<i class="fas fa-hourglass-half"></i>';
                                return `<div class="status-cell">${data} ${icon}</div>`;
                            }
                        },
                        {
                            data: 'justificatifs',
                            render: function (data, type, row) {
                                if (data > 0) {
                                    return `<div class="attachment-icon"><i class="fas fa-paperclip"></i><span class="attachment-badge">${data}</span></div>`
                                }
                                return '';
                            },
                            className: 'text-center'
                        }
                        ],
                        paging: true,
                        searching: true,
                        ordering: false,
                        info: false,
                        pageLength: 5,
                        dom: 't', // Only show the table part
                        language: {
                            emptyTable: "Aucune dépense trouvée",
                            zeroRecords: "Aucun enregistrement correspondant trouvé"
                        },
                        drawCallback: function (settings) {
                            renderPagination(this.api());
                        }
                    });
                }
            };

            // --- Pagination Rendering ---
            const renderPagination = (api) => {
                const paginationControls = document.getElementById('paginationControls');
                paginationControls.innerHTML = '';

                const pageInfo = api.page.info();
                const currentPage = pageInfo.page;
                const totalPages = pageInfo.pages;

                // First & Previous Buttons
                paginationControls.insertAdjacentHTML('beforeend',
                    `<button class="page-btn" data-page="first" ${currentPage === 0 ? 'disabled' : ''}>&laquo;</button>`
                );
                paginationControls.insertAdjacentHTML('beforeend',
                    `<button class="page-btn" data-page="previous" ${currentPage === 0 ? 'disabled' : ''}>&lsaquo;</button>`
                );

                // Page Numbers
                for (let i = 0; i < totalPages; i++) {
                    paginationControls.insertAdjacentHTML('beforeend',
                        `<button class="page-num ${i === currentPage ? 'active' : ''}" data-page="${i}">${i + 1}</button>`
                    );
                }

                // Next & Last Buttons
                paginationControls.insertAdjacentHTML('beforeend',
                    `<button class="page-btn" data-page="next" ${currentPage === totalPages - 1 ? 'disabled' : ''}>&rsaquo;</button>`
                );
                paginationControls.insertAdjacentHTML('beforeend',
                    `<button class="page-btn" data-page="last" ${currentPage === totalPages - 1 ? 'disabled' : ''}>&raquo;</button>`
                );
            }

            // --- Event Listeners and Initialization ---
            const init = () => {
                renderTable();

                const responsables = [...new Set(depensesData.map(p => p.responsable))];
                populateSelect(document.getElementById('responsableFilter'), responsables);

                flatpickr("#dateFilter", {
                    mode: "single",
                    dateFormat: "d/m/Y",
                    locale: "fr"
                });

                // Custom search
                $('#generalSearch').on('keyup', function () {
                    table.search(this.value).draw();
                });

                // Custom selects filtering
                $('#responsableFilter').on('change', function () {
                    const val = $.fn.dataTable.util.escapeRegex($(this).val());
                    table.column(3).search(val ? '^' + val + '$' : '', true, false).draw();
                });

                $('#dateFilter').on('change', function () {
                    table.column(0).search(this.value).draw();
                });

                // Pagination Clicks
                $('#paginationControls').on('click', 'button', function () {
                    const action = $(this).data('page');
                    if (action === undefined || $(this).is(':disabled')) return;

                    switch (action) {
                        case 'first':
                            table.page('first').draw('page');
                            break;
                        case 'previous':
                            table.page('previous').draw('page');
                            break;
                        case 'next':
                            table.page('next').draw('page');
                            break;
                        case 'last':
                            table.page('last').draw('page');
                            break;
                        default:
                            table.page(parseInt(action)).draw('page');
                            break;
                    }
                });

            };

            init();
        });
    </script>
</body>

</html>