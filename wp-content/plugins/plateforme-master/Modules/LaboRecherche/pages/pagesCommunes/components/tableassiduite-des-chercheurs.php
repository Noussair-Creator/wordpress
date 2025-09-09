<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Assiduité</title>

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
            right: 0.85rem;
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
            /* padding-left: 2.5rem; */
        }

        .filter-bar .filter-input:focus,
        .filter-bar .filter-select:focus {
            outline: none;
            border-color: #d8d4b7;
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

        /* --- DataTables Pagination --- */
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
            background: #c60000 !important;
            color: #fff !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #a50000 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #fde0e0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: default;
            background: #fff !important;
            padding: 10px 16px;
        }

        .dataTables_wrapper .dataTables_paginate .ellipsis {
            display: none;
        }

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
            display: flex;
            font-weight: 600;
            color: #6E6D55;
            font-size: 14px;
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

        .popup-form .form-group input[readonly],
        .popup-form .form-group input[readonly]:focus {
            background-color: #f0f0f0;
            cursor: not-allowed;
            border-color: #e0e0e0;
            box-shadow: none;
        }

        .popup-form .input-with-icon select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 30px;
            background-color: #fff;
        }


        .custom-file-input-container {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
            background-color: #fdfdfd;
            height: 42px;
        }

        .file-name-display {
            flex-grow: 1;
            padding: 0.6rem 0.75rem;
            font-size: 14px;
            color: #6b7280;
            background-color: #fdfdfd;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .hidden-file-input {
            display: none;
        }

        .custom-upload-btn {
            background-color: #d8d4b7;
            color: #2d2a12;
            border: none;
            padding: 0 15px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-width: 120px;
            text-align: center;
            transition: background-color 0.2s;
        }

        .custom-upload-btn:hover {
            background-color: #c2be9f;
        }

        .custom-upload-btn i {
            margin-right: 8px;
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

        #attendanceTable {
            border: none !important;
            border-collapse: collapse;
            box-shadow: none !important;
        }

        #attendanceTable th {
            border: 0px solid #EBE9D7;
            text-align: center;
        }

        #attendanceTable td {
            border: 1px solid #EBE9D7;
            text-align: center;
        }

        #attendanceTable thead {

            border: none !important;
            position: static;
            transform: translateY(-15px);
        }

        #attendanceTable tbody tr:first-child td {
            border-top: 1px solid #EBE9D7 !important;
        }

        #attendanceTable tbody tr:last-child td {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;

        }

        #attendanceTable tbody tr:first-child td:first-child {
            border-top-left-radius: 8px;
        }

        #attendanceTable tbody tr:first-child td:last-child {
            border-top-right-radius: 8px;
        }

        #attendanceTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 8px;
        }

        #attendanceTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Main Content Block -->
    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img width="40px" style="margin:0 5px 10px;"
                    src="/wp-content/plugins/plateforme-master/images/icons/5038546.png" alt="5038546">
                <!-- <i class="fas fa-user-tie" style="color:#BF0404; font-size: 28px; margin-right: 8px;"></i> -->
                Assiduité des chercheurs
            </h2>
            <!-- The 'import attendance' button is included here and will be hidden by JavaScript based on user role. -->
            <button class="add-project-btn" id="importAttendanceBtn">Importer fiche présence</button>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" id="generalSearch" type="text" placeholder="Recherche...">
                    <img class="icon left-icon" width="20px"
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-search.png" alt="Icon-search">
                    <!-- <i class="fas fa-search icon"></i> -->
                </div>

                <!-- Date Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input" id="dateRangeFilter" type="text" placeholder="Période">
                    <!-- The 'icon' class has been added to the image tag to apply positioning styles. -->
                    <img class="icon right-icon" width="20px"
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Icon-calendar">
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <table id="attendanceTable" class="styled-table display">
            <thead>
                <tr>
                    <th>Chercheur</th>
                    <th>Grade</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Justification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example data rows -->
                <tr>
                    <td>Dr. Karim Ben Amor</td>
                    <td>Chercheur HDR</td>
                    <td>05/09/2025</td>
                    <td>Présent</td>
                    <td>-</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="btn-modifier">Modifier</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Imène Heniat</td>
                    <td>Doctorante</td>
                    <td>05/09/2025</td>
                    <td>Présent</td>
                    <td>-</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="btn-modifier">Modifier</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Yassine Trabelsi</td>
                    <td>Post-Doc</td>
                    <td>05/09/2025</td>
                    <td>Présent</td>
                    <td>-</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="btn-modifier">Modifier</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Sarah Gharbi</td>
                    <td>Ing. Recherche</td>
                    <td>05/09/2025</td>
                    <td>Absent</td>
                    <td>
                        <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png"
                            alt="Icon-attach">
                        <!-- <i class="fas fa-paperclip"></i> -->

                    </td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="btn-modifier">Modifier</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Mohamed Ali Mansour</td>
                    <td>Doctorant</td>
                    <td>05/09/2025</td>
                    <td>Absent</td>
                    <td>-</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="btn-modifier">Modifier</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal for Modifying Attendance -->
    <div class="modal-overlay" id="attendanceModal">
        <div class="popup-container">
            <div class="popup-header">
                <h2 id="modalTitle">Modifier l'assiduité</h2>
                <button class="btn-enregistrer" id="saveAttendanceBtn">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="attendanceStatus">Statut</label>
                    <div class="input-with-icon">
                        <select id="attendanceStatus">
                            <option value="Présent">Présent</option>
                            <option value="Absent">Absent</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Importing Attendance -->
    <div class="modal-overlay" id="importModal">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Importer une feuille de présence</h2>
                <button class="btn-enregistrer" id="uploadFileBtn">Importer</button>
            </div>
            <div class="popup-form">
                <div class="form-group">
                    <label for="fileInput">Sélectionnez un fichier</label>
                    <div class="custom-file-input-container">
                        <span id="fileInputDisplay" class="file-name-display">Sélectionnez un fichier...</span>
                        <input type="file" id="fileInput" accept=".csv, .xlsx, .xls" class="hidden-file-input">
                        <label for="fileInput" class="custom-upload-btn">
                            <img class="me-2" width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite">
                            <!-- <i class="fas fa-upload"></i> -->
                            Importer
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- French Locale for Flatpickr -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Simulate user role to enable or disable features ---

            // --- Custom Date Range Filter Logic for DataTables ---
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    const dateRange = $('#dateRangeFilter').val();
                    if (!dateRange) {
                        return true;
                    } // No filter applied

                    const [startDateStr, endDateStr] = dateRange.split(' au ');
                    const itemDateStr = data[2]; // 'Date' is in column index 2

                    const parseDate = (str) => {
                        if (!str || !/^\d{2}\/\d{2}\/\d{4}$/.test(str)) return null;
                        const [day, month, year] = str.split('/');
                        return new Date(year, month - 1, day);
                    };

                    const itemDate = parseDate(itemDateStr);
                    const startDate = parseDate(startDateStr);
                    const endDate = endDateStr ? parseDate(endDateStr) : startDate;

                    if (!itemDate) return false;

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
            const table = $('#attendanceTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 'rtip',
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                }
            });

            // --- Initialize Flatpickr Date Range Picker ---
            flatpickr("#dateRangeFilter", {
                dateFormat: "d/m/Y",
                locale: "fr",
                onChange: function (selectedDates, dateStr, instance) {
                    table.draw();
                }
            });

            // --- General Search Functionality ---
            document.getElementById('generalSearch').addEventListener('keyup', function () {
                table.search(this.value).draw();
            });

            // --- Modal Logic ---
            const editModal = document.getElementById("attendanceModal");
            const importModal = document.getElementById("importModal");

            function openModal(modal) {
                modal.style.display = "flex";
            }

            function closeModal(modal) {
                modal.style.display = "none";
            }

            // --- Open "Modifier" Modal ---
            $('#attendanceTable tbody').on('click', '.btn-modifier', function (e) {
                e.preventDefault();
                const row = $(this).closest('tr');
                const rowData = table.row(row).data();

                // Populate modal with row data
                document.getElementById('attendanceStatus').value = $(rowData[3]).text();

                openModal(editModal);
            });

            // --- Open "Import" Modal ---
            if (importButton) {
                importButton.addEventListener('click', function () {
                    openModal(importModal);
                });
            }


            // --- Close Modals on Overlay Click ---
            editModal.addEventListener("click", function (e) {
                if (e.target === editModal) {
                    closeModal(editModal);
                }
            });

            importModal.addEventListener("click", function (e) {
                if (e.target === importModal) {
                    closeModal(importModal);
                }
            });

            // --- Update visible file name when a file is selected ---
            const fileInput = document.getElementById('fileInput');
            const fileInputDisplay = document.getElementById('fileInputDisplay');
            if (fileInput && fileInputDisplay) {
                fileInput.addEventListener('change', function () {
                    if (this.files.length > 0) {
                        fileInputDisplay.textContent = this.files[0].name;
                    } else {
                        fileInputDisplay.textContent = 'Sélectionnez un fichier...';
                    }
                });
            }


            // --- Save Attendance (Placeholder) ---
            document.getElementById('saveAttendanceBtn').addEventListener('click', function () {
                // Here you would implement logic to save the updated data
                closeModal(editModal);
            });

            // --- Upload File (Placeholder) ---
            document.getElementById('uploadFileBtn').addEventListener('click', function () {
                if (fileInput.files.length === 0) {
                    // This check is left in, but without a message, it will just stop the upload
                    // process if no file is selected.
                    return;
                }

                closeModal(importModal);
                fileInput.value = ''; // Reset the file input
                fileInputDisplay.textContent = 'Sélectionnez un fichier...'; // Reset display text
            });

            // --- Action Menu (Dropdown) Logic ---
            $('#attendanceTable tbody').on('click', '.action-btn', function (e) {
                e.stopPropagation();
                const menu = $(this).next('.dropdown-menu');
                $('.dropdown-menu').not(menu).hide();
                menu.toggle();
            });

            // --- Close Dropdowns on Outside Click ---
            $(document).on('click', function () {
                $('.dropdown-menu').hide();
            });
        });
    </script>
</body>

</html>