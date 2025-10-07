<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Des Appels À Projet</title>
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
        /* margin-bottom: 20px; */
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #DBD9C3;
    }

    .header-bar .dashboard-sub-title {
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
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

    #projectsTable td.consulter-cell {
        text-align: center;
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

    .consulter-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #555;
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
                <img width="30px" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Icon">
                Liste Des Appels À Projet
            </h2>
            <button class="add-project-btn"><a href="/cree-un-appel-a-projet">Créer un appel à projet</a></button>
        </div>
        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" id="generalSearch" type="text" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon"></i>
                </div>
                <!-- Statut Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="statutFilter">
                        <option value="">Projet</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
                <!-- Date Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input" id="dateRangeFilter" type="text" placeholder="Date Deb-Fin">
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
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Soumission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be inserted here by JavaScript -->
            </tbody>
        </table>
        <?php include 'pagination.php'; ?>
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
        const appelsData = [{
                id: 1,
                titre: "Apl 1",
                statut: "En Cours",
                date_debut: "01/02/2025",
                date_fin: "29/11/2025",
                soumission: 102,
                description: "Description pour Apl 1"
            },
            {
                id: 2,
                titre: "Apl 2",
                statut: "Clôturé",
                date_debut: "01/01/2023",
                date_fin: "31/12/2023",
                soumission: 95,
                description: "Description pour Apl 2"
            },
            {
                id: 3,
                titre: "Apl 3",
                statut: "Clôturé",
                date_debut: "15/09/2023",
                date_fin: "15/09/2025",
                soumission: 97,
                description: "Description pour Apl 3"
            }
        ];

        let allAppels = [...appelsData];
        let filteredAppels = [...allAppels];
        let table;

        // --- DOM Elements ---
        const tbody = document.querySelector('#projectsTable tbody');
        // const addProjectBtn = document.querySelector('.add-project-btn');

        // Filters
        const filterSearch = document.getElementById('generalSearch');
        const filterStatut = document.getElementById('statutFilter');
        const filterDate = document.getElementById('dateRangeFilter');

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

        // --- Rendering ---
        const renderTable = () => {
            tbody.innerHTML = '';

            if (filteredAppels.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="8" style="text-align:center; padding: 20px;">Aucun appel à projet trouvé.</td></tr>`;
            } else {
                filteredAppels.forEach(p => {
                    const tr = document.createElement('tr');
                    tr.dataset.id = p.id;
                    tr.innerHTML = `
                                <td><input type="checkbox" class="row-check"></td>
                                <td>${p.titre}</td>
                                <td>${p.statut}</td>
                                <td>${p.date_debut}</td>
                                <td>${p.date_fin}</td>
                                <td>${p.soumission}</td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn" aria-haspopup="true" aria-expanded="false">⋯</button>
                                        <div class="dropdown-menu">
                                            <a href="/modifier-un-appel-a-projet?id=${p.id}" class="btn-modifier">Modifier</a>
                                            <a href="/appels-a-projets-pmo-details?id=${p.id}" class="btn-voir">Voir</a>
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
                    pageLength: 5,
                    dom: '<"top">rt<"clear">', // Hide default search (f) and length (l) controls
                    language: {
                        emptyTable: "Aucun appel à projet trouvé",
                        zeroRecords: "Aucun enregistrement correspondant trouvé"
                    }
                });

                // Initialize unified pagination
                if (typeof PMOPagination !== 'undefined') {
                    const container = document.querySelector('.custom-pagination');
                    PMOPagination.init(table, container);
                }
            } else {
                table.clear().rows.add($('#projectsTable tbody tr')).draw();
            }
        };

        // --- Filtering Logic ---
        const applyFilters = () => {
            const searchTerm = filterSearch.value.toLowerCase();
            const statutTerm = filterStatut.value;
            const selectedDateStr = filterDate.value;

            let selectedDate = null;
            if (selectedDateStr) {
                selectedDate = parseDate(selectedDateStr);
            }

            filteredAppels = allAppels.filter(p => {
                const projectStartDate = parseDate(p.date_debut);
                const projectEndDate = parseDate(p.date_fin);

                const matchesSearch = searchTerm === '' || p.titre.toLowerCase().includes(
                    searchTerm) || p.statut.toLowerCase().includes(searchTerm);
                const matchesStatut = statutTerm === '' || p.statut === statutTerm;

                const matchesDate = !selectedDate || (projectStartDate && projectEndDate &&
                    selectedDate >= projectStartDate && selectedDate <= projectEndDate);

                return matchesSearch && matchesStatut && matchesDate;
            });

            renderTable();
        };

        // --- Event Listeners and Initialization ---
        const init = () => {
            const statuts = [...new Set(allAppels.map(p => p.statut))];

            const populateSelect = (selectEl, options, defaultOptionText = 'Sélection..') => {
                selectEl.innerHTML = `<option value="">${defaultOptionText}</option>`;
                options.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt;
                    option.textContent = opt;
                    selectEl.appendChild(option);
                });
            };

            populateSelect(filterStatut, statuts, 'Projet');

            flatpickr(filterDate, {
                mode: "single",
                dateFormat: "d/m/Y",
                locale: "fr",
                onClose: function() {
                    applyFilters();
                }
            });

            filterSearch.addEventListener('input', applyFilters);
            filterStatut.addEventListener('change', applyFilters);

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
            });

            renderTable();
        };

        init();
    });
    </script>
</body>

</html>