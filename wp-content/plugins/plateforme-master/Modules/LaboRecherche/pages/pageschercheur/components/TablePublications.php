<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Publications</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <!-- Flatpickr CSS for Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Segoe+UI:wght@400;700&display=swap">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- User-provided styles combined into one block -->
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
    }

    .dashboard-sub-title {
        font-weight: bold;
    }

    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-bottom: 20px;
        position: relative;
        flex-wrap: wrap;
    }

    .filter-inputs {
        display: flex;
        align-items: center;
        gap: 0.75rem;
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
        background-color: #fdfdfd;
        /* Ensure background is consistent */
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
        margin-left: auto;
    }

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

    .add-project-btn {
        background-color: #c60000;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
        text-decoration: none;
    }

    .add-project-btn:hover {
        background-color: #a50000;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 16px 0;
    }

    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        box-shadow: 0 0 0 1px #ddd;
        background: #fff;
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

    .styled-table tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 20px;
        text-transform: capitalize;
        border: 2px solid transparent;
        font-family: 'Segoe UI', sans-serif;
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

    .badge-danger {
        color: #d71920;
        background-color: #fff0f0;
        border-color: #d71920;
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

    /* DataTables Pagination */
    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 8px 14px;
        border-radius: 8px;
        border: 2px solid #c60000;
        background-color: #fff;
        color: #c60000;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #c60000;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: none;
        color: #000000ff !important;
        font-weight: 700;
        border-color: #c60000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {}

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #c60000;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        display: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #666 !important;
        border: 2px solid #c60000 !important;
        background: none !important;
        box-shadow: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        background-color: #fff;
        color: #c60000;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: inherit !important;
        border: 1px solid rgba(0, 0, 0, 0);
        background-color: rgba(230, 230, 230, 0.1);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(230, 230, 230, 0)), color-stop(100%, rgba(0, 0, 0, 0.1)));
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 0) 0%, rgba(0, 0, 0, 0) 100%);
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 0) 0%, rgba(0, 0, 0, 0) 100%);
        background: -ms-linear-gradient(top, rgba(230, 230, 230, 0) 0%, rgba(0, 0, 0, 0) 100%);
        background: -o-linear-gradient(top, rgba(230, 230, 230, 0) 0%, rgba(0, 0, 0, 0) 100%);
        background: linear-gradient(top, rgba(230, 230, 230, 0) 0%, rgba(0, 0, 0, 0) 100%);
    }
    </style>
</head>

<body>

    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                Mes Publications
            </h2>
            <a href="/ajouter-une-publication-chercheur" class="add-project-btn">Ajouter une publication</a>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" id="searchInput" type="text" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon search-field"></i>
                </div>

                <!-- Status Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="statusFilter">
                        <option value="">Tous les statuts</option>
                        <option value="Validée">Validée</option>
                        <option value="Regetée">Regetée</option>
                        <option value="En cours">En cours</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>

                <!-- Date Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input" id="dateFilter" type="text"
                        placeholder="Filtrer par date...">
                    <img width="20px" class="icon right-icon"
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Icon-calendar">


                    <!-- <i class="fas fa-calendar-alt icon right-icon"></i> -->
                </div>
            </div>

            <div class="filter-actions">
                <button class="icon-btn" title="Filter">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                        alt="Icon-funnel">

                    <!-- <i class="fa fa-filter"></i> -->
                </button>
                <button class="icon-btn" title="Download">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                        alt="upload-red.png">

                    <!-- <i class="fa fa-download"></i> -->
                </button>
            </div>
        </div>


        <table id="candidaturesTable" class="styled-table display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Type</th>
                    <th>Date soumission</th>
                    <th>Titre de la publication</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="row-checkbox"></td>
                    <td>Article IEEE</td>
                    <td>20/06/2025</td>
                    <td>Deep Learning For BCI Systems</td>
                    <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"></i> Validée</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#">Voir</a>
                                <a href="#">Modifier</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><input type="checkbox" class="row-checkbox"></td>
                    <td>Conférence</td>
                    <td>15/07/2025</td>
                    <td>Signal Processing In Robotics</td>
                    <td><span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i> Regetée</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#">Voir</a>
                                <a href="#">Modifier</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><input type="checkbox" class="row-checkbox"></td>
                    <td>Article Elsevier</td>
                    <td>01/05/2025</td>
                    <td>Interfaces Cerveau-Machine</td>
                    <td><span class="badge badge-warning"><i class="fa-regular fa-clock"></i> En cours</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#">Voir</a>
                                <a href="#">Modifier</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <!-- Flatpickr JS for Date Picker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script> <!-- French locale for flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Main script with added functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- Custom Date Filter Logic ---
        // This function will be called for every row on every draw to determine visibility
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                const dateFilterInput = document.getElementById('dateFilter');
                const selectedDateStr = dateFilterInput.value;

                // If no date is selected in the filter, show all rows
                if (!selectedDateStr) {
                    return true;
                }

                // Get the date from the "Date soumission" column (index 2)
                const tableDateStr = data[2];
                if (!tableDateStr) {
                    return false; // Hide rows that don't have a date if a filter is active
                }

                // The flatpickr input's actual value is "YYYY-MM-DD"
                // The table displays "DD/MM/YYYY". We need to convert the table's date to match the filter's format for comparison.
                try {
                    const parts = tableDateStr.split('/');
                    const day = parts[0];
                    const month = parts[1];
                    const year = parts[2];
                    const formattedTableDate = `${year}-${month}-${day}`;

                    // Compare the formatted table date with the selected date from the filter
                    return formattedTableDate === selectedDateStr;
                } catch (e) {
                    console.error("Error parsing date:", tableDateStr);
                    return false; // Don't show rows with invalid date formats
                }
            }
        );

        // Initialize DataTable
        const table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: true, // Enabled for filtering via API
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'Brtip', // 'B' for buttons, 'r' for processing, 't' for table, 'i' for info, 'p' for pagination
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé",
            },
            columnDefs: [{
                    "searchable": false,
                    "targets": [0, 5]
                },
                {
                    "orderable": false,
                    "targets": [0, 5]
                }
            ]
        });

        // Initialize Flatpickr Date Picker
        const datePicker = flatpickr("#dateFilter", {
            dateFormat: "Y-m-d", // Internal format for the input's value
            altInput: true, // Show a user-friendly format in a separate input
            altFormat: "d/m/Y", // The user-friendly format
            locale: "fr", // Use French language pack
            onChange: function(selectedDates, dateStr, instance) {
                // When the date changes, redraw the table to apply the custom filter
                table.draw();
            }
        });

        // --- Custom Search and Filter Event Listeners ---
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            table.search(this.value).draw();
        });

        const statusFilter = document.getElementById('statusFilter');
        statusFilter.addEventListener('change', function() {
            const selectedStatus = this.value;
            // Column 4 is the "Statut" column (0-indexed)
            table.column(4).search(selectedStatus ? '^' + selectedStatus + '$' : '', true, false)
                .draw();
        });

        // --- Check All Functionality ---
        const checkAll = document.getElementById('checkAll');
        checkAll.addEventListener('change', function() {
            const rows = table.rows({
                'search': 'applied'
            }).nodes();
            const checkboxes = $('input.row-checkbox', rows);
            checkboxes.prop('checked', this.checked);
        });

        $('#candidaturesTable tbody').on('change', 'input.row-checkbox', function() {
            if (!this.checked) {
                const el = $('#checkAll').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        // --- Action Menu Dropdown Logic ---
        document.addEventListener('click', function(e) {
            const isActionButton = e.target.classList.contains('action-btn');

            // Close all open dropdowns unless we are clicking an action button
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!isActionButton || menu.previousElementSibling !== e.target) {
                    menu.style.display = 'none';
                }
            });

            // If the click was on an action button, toggle its specific menu
            if (isActionButton) {
                const menu = e.target.nextElementSibling;
                if (menu) {
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                }
            }
        });
    });
    </script>

</body>

</html>