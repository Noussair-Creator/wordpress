<!-- External CSS Libraries -->
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<!-- Flatpickr CSS for Date Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Internal CSS Styles -->
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f4f9;
    }

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
        border-color: #c60000;
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
        margin-bottom: 10px;
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



    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        box-shadow: 0 0 0 1px #ddd;
        background: #fff;
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

    .styled-table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 20px;
        text-transform: capitalize;
        border: 2px solid transparent;
    }

    .badge-success {
        color: #198754;
        background-color: #e6f7ee;
        border-color: #198754;
    }

    .badge-warning {
        color: #d89e00;
        background-color: #fff9e6;
        border-color: #d89e00;
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

    /* --- MODIFIED SECTION START --- */
    /* DataTables Pagination */
    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px;
        border: 2px solid #c60000 !important;
        background: #fff !important;
        /* Force background to white */
        color: #c60000 !important;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 10px 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        /* background: #c60000 !important; */
        /* Force background to red for current */
        /* color: #fff !important; */
        border-color: #c60000;
        border: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #fde0e0 !important;
        /* Light red for hover */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #a50000 !important;
        /* Darker red for current page hover */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: default;
        background: #fff !important;
        /* Ensure disabled is also white */
        padding: 10px 16px;
    }

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        display: none;
    }

    /* --- MODIFIED SECTION END --- */

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: flex-end;
        z-index: 9999;
        display: none;
        /* Hidden by default */
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

    .popup-form .form-group input:focus,
    .popup-form .form-group select:focus,
    .popup-form .form-group textarea:focus {
        outline: none;
        border-color: #c60000;
        box-shadow: 0 0 0 2px rgba(198, 0, 0, 0.2);
    }

    .popup-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
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
        background-color: #f9f9f9;
        color: #888;
        cursor: default;
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
        border-left: 1px solid #b5af8e;
        white-space: nowrap;
    }

    .popup-form .form-row {
        display: flex;
        gap: 15px;
    }

    .popup-form .form-row .form-group {
        flex: 1;
    }

    /* Custom Flatpickr Theme */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background: #C60000;
        border-color: #C60000;
    }

    .flatpickr-day.inRange,
    .flatpickr-day.prevMonthDay.inRange,
    .flatpickr-day.nextMonthDay.inRange {
        background: #fde0e0;
        border-color: #fde0e0;
        box-shadow: -5px 0 0 #fde0e0, 5px 0 0 #fde0e0;
    }

    .flatpickr-months .flatpickr-month {
        color: #C60000;
    }

    .flatpickr-weekdays {
        background: #c600001a;
    }

    .flatpickr-months .flatpickr-prev-month:hover svg,
    .flatpickr-months .flatpickr-next-month:hover svg {
        fill: #C60000;
    }



    #candidaturesTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
    }

    #candidaturesTable th {
        border: 0px solid #EBE9D7;
    }

    #candidaturesTable td {
        border: 1px solid #EBE9D7;
    }

    #candidaturesTable thead {
        border: none !important;
        position: static;
        transform: translateY(-15px);
    }

    #candidaturesTable tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important;
    }

    #candidaturesTable {
        border-collapse: separate;
        border-spacing: 0;
    }

    #candidaturesTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;

    }

    #candidaturesTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 10px 0;
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
</style>


<!-- Main Content Block -->
<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Project Icon"
                style="width: 38px; margin-right: 8px; vertical-align: middle;">
            Liste Des Projets
        </h2>

        <button class="add-project-btn">Ajouter un projet</button>

    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" id="generalSearch" type="text" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon"></i>
            </div>

            <!-- Status Select -->
            <div class="input-with-icon">
                <select class="filter-select" id="statusFilter">
                    <option value="">État (Tous)</option>
                    <option value="Terminé">Terminé</option>
                    <option value="En cours">En cours</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>

            <!-- Date Input -->
            <div class="input-with-icon">
                <input class="filter-input date-input" id="dateRangeFilter" type="text" placeholder="Date Deb-Fin">
                <img class="icon right-icon" width="20px"
                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Calendar Icon"
                    onerror="this.style.display='none'">
            </div>
        </div>
        <div class="filter-actions">

            <button class="icon-btn" title="Filter">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                    alt="Funnel Icon" onerror="this.style.display='none'">
            </button>

            <button class="icon-btn" title="Download">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                    alt="Upload Icon" onerror="this.style.display='none'">
            </button>

        </div>
    </div>

    <!-- Data Table -->
    <table id="candidaturesTable" class="styled-table display">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Intitulé du projet</th>
                <th>État</th>
                <th>Porteur</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Financement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td>Détection IA Dans L'agriculture</td>
                <td><span class="badge badge-success">Terminé</span></td>
                <td>Dr. A. Mejri</td>
                <td>01/02/2025</td>
                <td>29/11/2025</td>
                <td>80 000 TND</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="btn-modifier">Modifier</a>
                            <a href="/programmes-et-projets-de-recherches-details-projet">Voir</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Stockage Cloud De Données Santé</td>
                <td><span class="badge badge-success">Terminé</span></td>
                <td>Y. Ben Salem</td>
                <td>01/01/2023</td>
                <td>31/12/2023</td>
                <td>120 000 TND</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="btn-modifier">Modifier</a>
                            <a href="/programmes-et-projets-de-recherches-details-projet">Voir</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Interfaces Adaptatives AR/VR</td>
                <td><span class="badge badge-warning">En cours</span></td>
                <td>Dr. Leila Romdhane</td>
                <td>15/09/2023</td>
                <td>15/09/2025</td>
                <td>85 000 TND</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="btn-modifier">Modifier</a>
                            <a href="/programmes-et-projets-de-recherches-details-projet">Voir</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal for Adding/Modifying a Project -->
<div class="modal-overlay" id="projectModal">
    <div class="popup-container">
        <div class="popup-header">
            <h2 id="modalTitle">Ajouter un projet</h2>
            <button class="btn-enregistrer" id="saveProjectBtn">Enregistrer</button>
        </div>
        <form class="popup-form">
            <input type="hidden" id="projectRowIndex">
            <div class="form-group">
                <label for="titreProjet">Titre du projet</label>
                <input type="text" id="titreProjet">
            </div>
            <div class="form-group">
                <label for="acronyme">Acronyme</label>
                <input type="text" id="acronyme">
            </div>
            <div class="form-group">
                <label for="typeProjet">Type</label>
                <div class="input-with-icon">
                    <select id="typeProjet">
                        <option>Sélection..</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="porteur">Porteur</label>
                <div class="input-with-icon">
                    <select id="porteur">
                        <option>Sélection..</option>
                        <option value="Dr. A. Mejri">Dr. A. Mejri</option>
                        <option value="Y. Ben Salem">Y. Ben Salem</option>
                        <option value="Dr. Leila Romdhane">Dr. Leila Romdhane</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="financement">Financement prévisionnel</label>
                    <input type="text" id="financement">
                </div>
                <div class="form-group">
                    <label for="sourceFinancement">Source Financement</label>
                    <div class="input-with-icon">
                        <select id="sourceFinancement">
                            <option>Sélection..</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="datesDebutFin">Dates Début / Fin</label>
                <div class="input-with-icon">
                    <input type="text" id="datesDebutFin" placeholder="jj/mm/aaaa - jj/mm/aaaa">
                    <img class="icon right-icon" width="20px"
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Calendar Icon" onerror="this.style.display='none'">
                </div>
            </div>
            <div class="form-group">
                <label for="objectifs">Objectifs</label>
                <textarea id="objectifs" placeholder="Objectif"></textarea>
            </div>
            <div class="form-group">
                <label for="budget">Budget</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" value="Aucun fichier choisi" readonly>
                    <label for="budgetUpload" class="btn-importer">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                            alt="Upload Icon" onerror="this.style.display='none'">
                        Importer
                    </label>
                    <input type="file" id="budgetUpload" style="display:none;">
                </div>
            </div>
            <div class="form-group">
                <label for="convention">Convention</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" value="Aucun fichier choisi" readonly>
                    <label for="conventionUpload" class="btn-importer">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                            alt="Upload Icon" onerror="this.style.display='none'">
                        Importer
                    </label>
                    <input type="file" id="conventionUpload" style="display:none;">
                </div>
            </div>
        </form>
    </div>
</div>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- French Locale for Flatpickr -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // --- Custom Date Range Filter Logic for DataTables ---
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                const dateRange = $('#dateRangeFilter').val();
                if (!dateRange) {
                    return true;
                } // No filter applied

                const [startDateStr, endDateStr] = dateRange.split(' au '); // Updated separator for French
                const itemDateStr = data[4]; // 'Date début' is in column index 4

                // Helper to parse DD/MM/YYYY into a Date object
                const parseDate = (str) => {
                    if (!str || !/^\d{2}\/\d{2}\/\d{4}$/.test(str)) return null;
                    const [day, month, year] = str.split('/');
                    return new Date(year, month - 1, day);
                };

                const itemDate = parseDate(itemDateStr);
                const startDate = parseDate(startDateStr);
                const endDate = endDateStr ? parseDate(endDateStr) : startDate;

                if (!itemDate) return false; // Don't show rows with invalid dates

                // Check if the item date falls within the selected range
                if (
                    (startDate && itemDate < startDate) ||
                    (endDate && itemDate > endDate)
                ) {
                    return false;
                }

                return true;
            }
        );

        // --- Initialize DataTables ---
        const table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'rtip',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                    next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>"
                },
                emptyTable: "Aucune donnée disponible dans le tableau",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            }
        });

        // --- Initialize Flatpickr Date Range Picker ---
        const datePicker = flatpickr("#dateRangeFilter", {
            mode: "range",
            dateFormat: "d/m/Y",
            locale: "fr", // Set locale to French
            onChange: function (selectedDates, dateStr, instance) {
                table.draw(); // Redraw the table when the date changes
            }
        });

        // --- General Search Functionality ---
        document.getElementById('generalSearch').addEventListener('keyup', function () {
            table.search(this.value).draw();
        });

        // --- Status Filter Functionality ---
        document.getElementById('statusFilter').addEventListener('change', function () {
            const selectedStatus = this.value;
            table.column(2).search(selectedStatus ? '^' + selectedStatus + '$' : '', true, false)
                .draw();
        });

        // --- Action Menu (Dropdown) Logic ---
        $('#candidaturesTable tbody').on('click', '.action-btn', function (e) {
            e.stopPropagation();
            const menu = $(this).next('.dropdown-menu');
            $('.dropdown-menu').not(menu).hide();
            menu.toggle();
        });

        // --- Close Dropdowns on Outside Click ---
        $(document).on('click', function () {
            $('.dropdown-menu').hide();
        });

        // --- Check All Functionality ---
        document.getElementById('checkAll').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll(
                '#candidaturesTable tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // --- Modal Logic ---
        const modal = document.getElementById("projectModal");
        const modalTitle = document.getElementById("modalTitle");
        const form = modal.querySelector('.popup-form');

        function openModal() {
            modal.style.display = "flex";
        }

        function closeModal() {
            modal.style.display = "none";
            form.reset();
        }

        document.querySelector('.add-project-btn').addEventListener('click', function () {
            modalTitle.textContent = "Ajouter un projet";
            form.reset();
            openModal();
        });

        $('#candidaturesTable tbody').on('click', '.btn-modifier', function (e) {
            e.preventDefault();
            modalTitle.textContent = "Modifier le projet";
            const row = $(this).closest('tr');
            document.getElementById('titreProjet').value = row.find('td:eq(1)').text();
            document.getElementById('porteur').value = row.find('td:eq(3)').text();
            document.getElementById('financement').value = row.find('td:eq(6)').text().replace(' TND',
                '');
            const dateDebut = row.find('td:eq(4)').text();
            const dateFin = row.find('td:eq(5)').text();
            document.getElementById('datesDebutFin').value = `${dateDebut} - ${dateFin}`;
            openModal();
        });

        document.getElementById('saveProjectBtn').addEventListener('click', function () {
            console.log("Saving project data...");
            closeModal();
            Swal.fire({
                title: 'Succès!',
                text: 'Le projet a été enregistré.',
                icon: 'success',
                confirmButtonColor: '#c62828'
            });
        });

        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // --- Custom File Input Logic ---
        function setupFileInput(uploadId) {
            const fileUpload = document.getElementById(uploadId);
            if (!fileUpload) return;
            const fileText = document.querySelector(`label[for='${uploadId}']`).previousElementSibling;
            fileUpload.addEventListener('change', function () {
                fileText.value = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
            });
        }
        setupFileInput('budgetUpload');
        setupFileInput('conventionUpload');
    });
</script>




<!-- APPEL API -->
<script type="module">
(() => {
  const PM = window.PMSettings || {};
  const API_BASE = (PM.restUrl || '/wp-json/') + 'plateforme-recherche/v1';

  // ---------- Helpers REST ----------
  const wpFetch = async (path, { method='GET', body=null, headers={}, raw=false } = {}) => {
    const url = API_BASE + path;
    const opts = {
      method,
      credentials: 'include',
      headers: {
        'X-WP-Nonce': PM.nonce || '',
        ...headers
      }
    };
    if (body && !raw) {
      opts.headers['Content-Type'] = 'application/json';
      opts.body = JSON.stringify(body);
    } else if (body && raw) {
      // p.ex. upload fichier en binaire : body = File / Blob
      opts.body = body;
    }
    const res = await fetch(url, opts);
    if (!res.ok) {
      let errMsg = `HTTP ${res.status}`;
      try { const j = await res.json(); if (j?.message) errMsg = j.message; } catch {}
      throw new Error(errMsg);
    }
    if (res.status === 204) return null;
    const ct = res.headers.get('content-type') || '';
    return ct.includes('application/json') ? res.json() : res.text();
  };

  // Upload média vers /wp/v2/media, retourne {id, source_url, ...}
  const uploadMedia = async (file) => {
    if (!file) return null;
    const endpoint = (PM.restUrl || '/wp-json/') + 'wp/v2/media';
    const res = await fetch(endpoint, {
      method: 'POST',
      credentials: 'include',
      headers: {
        'X-WP-Nonce': PM.nonce || '',
        'Content-Disposition': `attachment; filename="${encodeURIComponent(file.name)}"`,
        'Content-Type': file.type || 'application/octet-stream'
      },
      body: file
    });
    if (!res.ok) {
      let t = ''; try { t = await res.text(); } catch {}
      throw new Error('Upload échoué: ' + (t || res.status));
    }
    return res.json();
  };

  // ---------- Helpers UI ----------
  const $ = (sel, ctx=document) => ctx.querySelector(sel);
  const $$ = (sel, ctx=document) => Array.from(ctx.querySelectorAll(sel));

  const escapeHtml = s => String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));
  const toISO = fr => { // 'jj/mm/aaaa' -> 'aaaa-mm-jj'
    if (!fr) return '';
    const parts = fr.split(/[\/\-\.]/).map(s=>s.trim());
    if (parts.length !== 3) return '';
    const [d,m,y] = parts;
    if (!d || !m || !y) return '';
    return `${y.padStart(4,'0')}-${m.padStart(2,'0')}-${d.padStart(2,'0')}`;
  };
  const toFR = iso => {
    if (!iso) return '';
    const [y,m,d] = iso.split('T')[0].split('-');
    if (!y || !m || !d) return '';
    return `${d}/${m}/${y}`;
  };
  const parseMoney = val => {
    if (val == null) return 0;
    return Number(String(val).replace(/\s+/g,'').replace(/[^\d.,]/g,'').replace(',', '.')) || 0;
  };
  const fmtMoney = n => new Intl.NumberFormat('fr-TN', { maximumFractionDigits: 0 }).format(n) + ' TND';

  const badgeClass = (status) => {
    switch ((status || '').toLowerCase()) {
      case 'terminé':
      case 'termine': return 'badge badge-success';
      case 'en cours': return 'badge badge-warning';
      default: return 'badge badge-secondary';
    }
  };
  const parseResume = (resume) => {
    if (!resume) return {};
    if (typeof resume === 'object') return resume;
    try { return JSON.parse(resume); } catch { return { texte: String(resume) }; }
  };

  const notify = (msg, type='info') => {
    const el = document.createElement('div');
    el.className = `toast ${type}`;
    Object.assign(el.style, {
      position:'fixed', right:'24px', bottom:'24px', zIndex: 9999,
      padding:'10px 14px', color:'#fff', borderRadius:'6px',
      background: type==='error' ? '#c0392b' : type==='warn' ? '#e67e22' : '#2ecc71',
      boxShadow:'0 8px 18px rgba(0,0,0,.2)', fontSize:'14px'
    });
    el.textContent = msg;
    document.body.appendChild(el);
    setTimeout(() => el.remove(), 3000);
  };

  const debounce = (fn, ms=300) => { let t; return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), ms); }; };

  // ---------- State & DOM refs ----------
  let projects = [];     // Liste brute depuis l’API
  let filtered = [];     // Liste filtrée (UI)
  let editingId = null;  // id projet en cours d’édition

  const tbody = $('#candidaturesTable tbody');
  const addBtn = $('.add-project-btn');
  const modal = $('#projectModal');
  const modalTitle = $('#modalTitle');
  const saveBtn = $('#saveProjectBtn');

  const inputs = {
    titre:        $('#titreProjet'),
    acronyme:     $('#acronyme'),
    type_projet:  $('#typeProjet'),
    porteur_nom:  $('#porteur'),
    budget:       $('#financement'),
    source_fin:   $('#sourceFinancement'),
    dates:        $('#datesDebutFin'),
    objectifs:    $('#objectifs'),
    budgetFile:   $('#budgetUpload'),
    conventionFile: $('#conventionUpload')
  };

  const filters = {
    q:        $('#generalSearch'),
    status:   $('#statusFilter'),
    dateRng:  $('#dateRangeFilter'),
    checkAll: $('#checkAll'),
    btnFilter:  $('.filter-actions .icon-btn[title="Filter"]'),
    btnExport:  $('.filter-actions .icon-btn[title="Download"]')
  };

  // ---------- Rendering ----------
  const buildRow = (p) => {
    const r = parseResume(p.resume);
    const porteurNom = r.porteur_nom || '—';
    const typeProj = r.type_projet || '—';
    const financement = (p.budget != null) ? fmtMoney(p.budget) : (r.financement_text || '—');
    const statut = p.statut || r.statut || 'En cours';
    const tr = document.createElement('tr');
    tr.dataset.id = p.id;
    tr.innerHTML = `
      <td><input type="checkbox" class="row-check"></td>
      <td>
        <div class="title-cell">
          <div class="project-title">${escapeHtml(p.titre || '')}</div>
          ${r.acronyme ? `<div class="project-acronym">${escapeHtml(r.acronyme)}</div>` : ''}
          ${typeProj !== '—' ? `<div class="project-type small text-muted">${escapeHtml(typeProj)}</div>` : ''}
        </div>
      </td>
      <td><span class="${badgeClass(statut)}">${escapeHtml(statut)}</span></td>
      <td>${escapeHtml(porteurNom)}</td>
      <td>${p.date_debut ? escapeHtml(toFR(p.date_debut)) : '—'}</td>
      <td>${p.date_fin ? escapeHtml(toFR(p.date_fin)) : '—'}</td>
      <td>${financement}</td>
      <td>
        <div class="actions">
          <button class="action-btn" aria-haspopup="true" aria-expanded="false">⋯</button>
          <div class="dropdown-menu">
            <a href="#" class="btn-modifier">Modifier</a>
            <a href="#" class="btn-statut">${(statut || '').toLowerCase().startsWith('termin') ? 'Marquer en cours' : 'Marquer terminé'}</a>
            <a class="btn-voir" href="/programmes-et-projets-de-recherches-details-projet?id=${encodeURIComponent(p.id)}">Voir</a>
            <a href="#" class="btn-supprimer">Supprimer</a>
          </div>
        </div>
      </td>
    `;
    return tr;
  };

  const render = () => {
    tbody.innerHTML = '';
    (filtered.length ? filtered : projects).forEach(p => tbody.appendChild(buildRow(p)));
  };

  // ---------- Load ----------
  const loadProjects = async () => {
    try {
      const data = await wpFetch('/projet?page=1&per_page=200');
      projects = Array.isArray(data) ? data : [];
      filtered = [];
      render();
    } catch (e) {
      notify('Erreur lors du chargement des projets : ' + e.message, 'error');
    }
  };

  // ---------- Modal ----------
  const openModal = (edit=false, project=null) => {
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
    modalTitle.textContent = edit ? 'Modifier le projet' : 'Ajouter un projet';
    editingId = edit && project ? project.id : null;

    // reset
    Object.values(inputs).forEach(el => {
      if (!el) return;
      if (el instanceof HTMLInputElement || el instanceof HTMLTextAreaElement) el.value = '';
      if (el instanceof HTMLSelectElement) el.selectedIndex = 0;
    });

    if (project) {
      const r = parseResume(project.resume);
      inputs.titre.value = project.titre || '';
      inputs.acronyme.value = r.acronyme || '';
      setSelectValue(inputs.type_projet, r.type_projet || '');
      setSelectValue(inputs.porteur_nom, r.porteur_nom || '');
      inputs.budget.value = (project.budget != null ? String(project.budget) : (r.financement_text || ''));
      setSelectValue(inputs.source_fin, project.type_financement || r.source_financement || '');
      inputs.dates.value = `${project.date_debut ? toFR(project.date_debut) : ''} - ${project.date_fin ? toFR(project.date_fin) : ''}`.trim();
      inputs.objectifs.value = r.objectifs || r.texte || '';
    }
  };

  const closeModal = () => {
    modal.classList.remove('open');
    document.body.style.overflow = '';
    editingId = null;
  };

  const setSelectValue = (sel, value) => {
    const v = String(value || '').toLowerCase();
    const found = Array.from(sel.options).find(o => (o.value || o.textContent).toLowerCase() === v);
    if (found) sel.value = found.value;
  };

  const collectPayload = () => {
    const titre = inputs.titre.value.trim();
    const datePair = (inputs.dates.value || '').trim();
    const [debFR, finFR] = datePair.split('-').map(s => (s || '').trim());

    const resumeObj = {
      objectifs: inputs.objectifs.value.trim(),
      acronyme: inputs.acronyme.value.trim(),
      type_projet: inputs.type_projet.value.trim(),
      source_financement: inputs.source_fin.value.trim(),
      porteur_nom: inputs.porteur_nom.value.trim(),
      financement_text: inputs.budget.value.trim()
    };

    const payload = {
      titre,
      date_debut: toISO(debFR || ''),
      date_fin: toISO(finFR || ''),
      budget: parseMoney(inputs.budget.value),
      type_financement: inputs.source_fin.value.trim(),
      statut: 'En cours',
      chercheur_id: Number(PM.userId || 0) || undefined,
      // On envoie une string JSON pour contourner tout sanitize côté WP si nécessaire
      resume: JSON.stringify(resumeObj)
    };

    // Nettoyage
    Object.keys(payload).forEach(k => {
      const v = payload[k];
      if (v === '' || v == null || (k === 'budget' && Number.isNaN(v))) delete payload[k];
    });

    return payload;
  };

  const saveProject = async () => {
    try {
      const body = collectPayload();
      if (!body.titre)      return notify('Le titre est obligatoire.', 'warn');
      if (!body.date_debut) return notify('La date de début est obligatoire (jj/mm/aaaa - jj/mm/aaaa).', 'warn');

      // Upload pièces si sélectionnées
      const pieces = {};
      if (inputs.budgetFile?.files?.[0]) {
        const m1 = await uploadMedia(inputs.budgetFile.files[0]);
        if (m1) pieces.budget_piece = { id: m1.id, url: m1.source_url };
      }
      if (inputs.conventionFile?.files?.[0]) {
        const m2 = await uploadMedia(inputs.conventionFile.files[0]);
        if (m2) pieces.convention_piece = { id: m2.id, url: m2.source_url };
      }
      if (Object.keys(pieces).length) {
        const r = JSON.parse(body.resume);
        r.pieces = pieces;
        body.resume = JSON.stringify(r);
      }

      if (editingId) {
        const upd = await wpFetch(`/projet/${editingId}`, { method:'PATCH', body });
        const idx = projects.findIndex(p => p.id == editingId);
        if (idx > -1) projects[idx] = { ...projects[idx], ...upd };
        notify('Projet mis à jour.');
      } else {
        const created = await wpFetch('/projet', { method:'POST', body });
        projects.unshift(created);
        notify('Projet ajouté.');
      }
      closeModal();
      render();
    } catch (e) {
      notify('Échec de l’enregistrement : ' + e.message, 'error');
    }
  };

  const deleteProject = async (id) => {
    if (!confirm('Supprimer ce projet ?')) return;
    try {
      await wpFetch(`/projet/${id}`, { method: 'DELETE' });
      projects = projects.filter(p => p.id != id);
      render();
      notify('Projet supprimé.');
    } catch (e) {
      notify('Suppression échouée : ' + e.message, 'error');
    }
  };

  const toggleStatut = async (id) => {
    const p = projects.find(x => x.id == id);
    if (!p) return;
    const current = (p.statut || '').toLowerCase();
    const next = current.startsWith('termin') ? 'En cours' : 'Terminé';
    try {
      const upd = await wpFetch(`/projet/${id}`, { method:'PATCH', body:{ statut: next }});
      Object.assign(p, upd);
      render();
    } catch (e) {
      notify('Changement de statut échoué : ' + e.message, 'error');
    }
  };

  // ---------- Filtrage ----------
  const applyFilters = () => {
    const q = (filters.q.value || '').toLowerCase();
    const st = (filters.status.value || '').toLowerCase();
    const dr = (filters.dateRng.value || '').trim();
    let deb = null, fin = null;
    if (dr.includes('-')) {
      const [a, b] = dr.split('-').map(s => (s || '').trim());
      deb = toISO(a || '');
      fin = toISO(b || '');
    }
    filtered = projects.filter(p => {
      const r = parseResume(p.resume);
      const hay = [
        p.titre, p.statut, p.type_financement,
        r.porteur_nom, r.acronyme, r.type_projet, r.objectifs
      ].filter(Boolean).join(' ').toLowerCase();

      if (q && !hay.includes(q)) return false;
      if (st && (String(p.statut || '').toLowerCase() !== st)) return false;
      if (deb && p.date_debut && p.date_debut < deb) return false;
      if (fin && p.date_fin && p.date_fin > fin) return false;
      return true;
    });
    render();
  };

  const exportCsv = () => {
    const rows = filtered.length ? filtered : projects;
    const headers = [
      'ID','Intitulé','Statut','Porteur','Date début','Date fin','Financement','Acronyme','Type','Source'
    ];
    const lines = [headers.join(';')];
    rows.forEach(p => {
      const r = parseResume(p.resume);
      lines.push([
        p.id,
        (p.titre || '').replace(/;/g, ','),
        p.statut || '',
        r.porteur_nom || '',
        p.date_debut ? toFR(p.date_debut) : '',
        p.date_fin ? toFR(p.date_fin) : '',
        (p.budget != null) ? String(p.budget) : (r.financement_text || ''),
        r.acronyme || '',
        r.type_projet || '',
        p.type_financement || r.source_financement || ''
      ].map(v => `"${String(v).replace(/"/g,'""')}"`).join(';'));
    });
    const blob = new Blob([lines.join('\n')], { type:'text/csv;charset=utf-8;' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'projets.csv';
    document.body.appendChild(a);
    a.click();
    a.remove();
  };

  // ---------- Events ----------
  const onBodyClick = (e) => {
    // Toggle dropdown menu
    const btn = e.target.closest('.action-btn');
    if (btn) {
      const wrap = btn.closest('.actions');
      const menu = $('.dropdown-menu', wrap);
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      $$('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
      $$('.action-btn[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded','false'));
      menu.classList.toggle('show', !expanded);
      btn.setAttribute('aria-expanded', String(!expanded));
      e.preventDefault();
      return;
    }
    // Close menus if click outside
    if (!e.target.closest('.actions')) {
      $$('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
      $$('.action-btn[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded','false'));
    }

    // Dropdown actions
    const a = e.target.closest('.dropdown-menu a');
    if (a) {
      e.preventDefault();
      const tr = a.closest('tr');
      const id = Number(tr?.dataset?.id);
      if (!id) return;
      if (a.classList.contains('btn-modifier')) {
        const p = projects.find(x => x.id == id);
        return openModal(true, p);
      }
      if (a.classList.contains('btn-supprimer')) {
        return deleteProject(id);
      }
      if (a.classList.contains('btn-statut')) {
        return toggleStatut(id);
      }
    }
  };

  const bindEvents = () => {
    addBtn?.addEventListener('click', () => openModal(false, null));
    saveBtn?.addEventListener('click', saveProject);
    modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

    document.body.addEventListener('click', onBodyClick);

    if (filters.q)      filters.q.addEventListener('input', debounce(applyFilters, 200));
    if (filters.status) filters.status.addEventListener('change', applyFilters);
    if (filters.dateRng) filters.dateRng.addEventListener('change', applyFilters);

    if (filters.checkAll) {
      filters.checkAll.addEventListener('change', (e) => {
        $$('.row-check').forEach(ch => ch.checked = e.target.checked);
      });
      tbody.addEventListener('change', (e) => {
        if (e.target.classList.contains('row-check') && !e.target.checked) {
          filters.checkAll.checked = false;
        }
      });
    }

    filters.btnExport?.addEventListener('click', exportCsv);
    // Le bouton "Filter" peut, si besoin, servir à ouvrir un panneau avancé
  };

  // ---------- Init ----------
  // Optionnel : masquer le bouton "Ajouter" si rôle non autorisé côté UI
  const allowedRoles = ['administrator','um_directeur_laboratoire','um_chercheur','um_directeur','um_doyen'];
  if (addBtn && PM.role && !allowedRoles.includes(PM.role)) addBtn.style.display = 'none';

  bindEvents();
  loadProjects();
})();
</script>
