<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables CSS for styling the tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f9f9f9;
}

.accordion-container {
    border-radius: 12px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #ddd;
    overflow: hidden;
    max-width: 1200px;
    margin: auto;
}

.accordion-tabs {
    display: flex;
    background: #f3f3f3;
}

.tab-btn {
    flex: 1;
    padding: 15px 20px;
    font-weight: 600;
    border: none;
    background: #A6A485;
    cursor: pointer;
    font-size: 18px;
    color: #fff;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

}

.tab-btn:first-child {
    border-top-left-radius: 11px;
    margin-right: 10px;
}

.tab-btn:last-child {
    border-top-right-radius: 11px;
}

.tab-btn.active {
    background-color: #fff;
    color: #2A2916;
}

.accordion-content {
    padding: 25px;
    background: #fff;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
}

/* --- STYLES FOR TABLES & CONTROLS --- */
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 25px;
}

.filter-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.search-box {
    display: flex;
    align-items: center;
    border: 1px solid #d8d4b7;
    border-radius: 6px;
    padding: 0 10px;
    background-color: #fff;
}

.search-box i {
    color: #666;
}

.filter-input {
    padding: 10px 5px;
    border-radius: 6px;
    border: none;
    outline: none;
    font-size: 14px;
    background: #fff;
    width: 200px;
}

.date-input-container {
    display: flex;
    align-items: center;
    border: 1px solid #d8d4b7;
    border-radius: 6px;
    padding: 0 10px;
    background-color: #fff;
}

.date-input {
    padding: 10px 5px;
    border: none;
    outline: none;
    font-size: 14px;
    border-radius: 6px;
}

.filter-select {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #d8d4b7;
    font-size: 14px;
    background: #fff;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-position: right 10px center;
    background-repeat: no-repeat;
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
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #BF0404;
    font-size: 18px;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
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

.styled-table tbody tr:hover {
    background-color: #f9f9f9;
}

.styled-table th {
    font-weight: 600;
    color: #333;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px;
}

.badge-success {
    color: #198754;
    background-color: #e6f7ee;
}

.badge-danger {
    color: #d71920;
    background-color: #fff0f0;
}

.badge-warning {
    color: #d89e00;
    background-color: #fff9e6;
}

#candidaturesTable,
#mesPublicationsTable {
    border: none !important;
    border-collapse: collapse;
    box-shadow: none !important;
}

#candidaturesTable th,
#mesPublicationsTable th {
    border: 0px solid #EBE9D7;
}

#candidaturesTable td,
#mesPublicationsTable td {
    border: 1px solid #EBE9D7;
}

#candidaturesTable thead,
#mesPublicationsTable thead {
    border: none !important;
    position: static;
    transform: translateY(-15px);
}

#candidaturesTable tbody tr:first-child td,
#mesPublicationsTable tbody tr:first-child td {
    border-top: 1px solid #EBE9D7 !important;
}

#candidaturesTable,
#mesPublicationsTable {
    border-collapse: separate;
    border-spacing: 0;
}

#candidaturesTable thead tr:first-child th:first-child,
#mesPublicationsTable thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

#candidaturesTable thead tr:first-child th:last-child,
#mesPublicationsTable thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;

}

#candidaturesTable tbody tr:last-child td:first-child,
#mesPublicationsTable tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

#candidaturesTable tbody tr:last-child td:last-child,
#mesPublicationsTable tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

#candidaturesTable tbody tr:first-child td:first-child,
#mesPublicationsTable tbody tr:first-child td:first-child {
    border-top-left-radius: 12px;
}

#candidaturesTable tbody tr:first-child td:last-child,
#mesPublicationsTable tbody tr:first-child td:last-child {
    border-top-right-radius: 12px;
}

.badge-info {
    background-color: #808066;
}

.actions {
    position: relative;
    display: inline-block;
}

.action-btn {
    background-color: transparent;
    border: none;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
    width: 36px;
    height: 36px;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 200px;
    background-color: #ffffff;
    border: 1px solid #d8d4b7;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 5px 0;
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    text-decoration: none;
    font-size: 14px;
    color: #2d2a12;
}

.dropdown-menu a:hover {
    background-color: #f5f5f5;
}

.dropdown-menu i {
    width: 16px;
    text-align: center;
}

.dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: end;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: 2px solid #c60000;
    color: #c60000 !important;
    padding: 8px 14px;
    border-radius: 8px;
    background: white !important;
    font-weight: bold;
    cursor: pointer;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    border: 2px solid #c60000;
    color: #c60000 !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    /* color: white !important; */
    /* background: #c60000 !important; */
    border: none;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover {
    background: #fdf0f0 !important;
}


/* --- STYLES FOR TAB 2: MES PUBLICATIONS --- */
#tab2 .header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

#tab2 .dashboard-sub-title {
    font-size: 24px;
    font-weight: 600;
    color: #2A2916;
    margin: 0;
}

#tab2 .add-project-btn {
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

#tab2 .add-project-btn:hover {
    background-color: #a50000;
}

#tab2 .section-divider {
    border: none;
    height: 1px;
    background-color: #eee;
    margin-bottom: 25px;
}
</style>


<div class="accordion-container">
    <!-- Tabs -->
    <div class="accordion-tabs">
        <button class="tab-btn active" data-tab="tab1">
            Suivi Des Publications
        </button>
        <button class="tab-btn" data-tab="tab2">
            Mes Publications
        </button>
    </div>

    <div class="accordion-content">

        <!-- Tab 1: Suivi Des Publications -->
        <div class="tab-panel active" id="tab1">
            <div class="table-controls">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" class="filter-input" id="candidaturesSearch" placeholder="Recherchez...">
                    </div>
                    <select class="filter-select">
                        <option value="">Statut</option>
                        <option value="Validée">Validée</option>
                        <option value="Rejetée">Rejetée</option>
                        <option value="En attente">En attente</option>
                    </select>
                    <div class="date-input-container">
                        <input type="text" class="date-input" placeholder="Date" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="filter-actions">
                    <button class="icon-btn" title="Filter"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                            alt="Icon-funnel.png"></button>
                    <button class="icon-btn" title="Download"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                            alt="upload-red.png"></button>
                </div>
            </div>

            <table class="styled-table" id="candidaturesTable">
                <thead>
                    <tr>
                        <!-- FIX: Added ID for check-all functionality -->
                        <th><input type="checkbox" id="checkAllSuivi"></th>
                        <th>Auteur(s)</th>
                        <th>Type</th>
                        <th>Date soumission</th>
                        <th>Titre de la publication</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Dr. S. Messaoudi</td>
                        <td>Article IEEE</td>
                        <td>20/06/2025</td>
                        <td>Deep Learning For BCI Systems</td>
                        <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"></i>Validée</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="#"><i class="fa-regular fa-circle-check"></i>Valider</a>
                                    <a href="#"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>H. Lahmar</td>
                        <td>Conférence</td>
                        <td>15/07/2025</td>
                        <td>Signal Processing In Robotics</td>
                        <td><span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i>Rejetée</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="#"><i class="fa-regular fa-circle-check"></i>Valider</a>
                                    <a href="#"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>M. Trabelsi</td>
                        <td>Article Elsevier</td>
                        <td>01/05/2025</td>
                        <td>Interfaces Cerveau-Machine</td>
                        <td><span class="badge badge-warning"><i class="fa-regular fa-clock"></i>En attente</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="#"><i class="fa-regular fa-circle-check"></i>Valider</a>
                                    <a href="#"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tab 2: Mes Publications -->
        <div class="tab-panel" id="tab2">

            <hr class="section-divider">

            <div class="table-controls">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" class="filter-input" id="mesPublicationsSearch" placeholder="Recherchez...">
                    </div>
                    <select class="filter-select">
                        <option value="">Statut</option>
                        <option value="Validée">Validée</option>
                        <option value="Rejetée">Rejetée</option>
                        <option value="En attente">En attente</option>
                    </select>
                    <div class="date-input-container">
                        <input type="text" class="date-input" placeholder="Date" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="filter-actions">
                    <a href="/ajouter-une-publication-directeur-du-labo" class="add-project-btn">Ajouter une
                        publication</a>
                    <button class="icon-btn" title="Filter">
                        <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                            alt="Icon-funnel.png"></button>
                    <button class="icon-btn" title="Download"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                            alt="upload-red.png"></button>
                </div>
            </div>

            <table id="mesPublicationsTable" class="styled-table display">
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
                        <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"></i>Validée</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="/modifier-une-publication-directeur-du-labo"><i
                                            class="fa-regular fa-pen-to-square"></i>Modifier</a>
                                    <a href="#"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox"></td>
                        <td>Conférence</td>
                        <td>15/07/2025</td>
                        <td>Signal Processing In Robotics</td>
                        <td><span class="badge badge-danger"><i class="fa-regular fa-circle-stop"></i>Rejetée</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="/modifier-une-publication-directeur-du-labo"><i
                                            class="fa-regular fa-pen-to-square"></i>Modifier</a>
                                    <a href="#"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox"></td>
                        <td>Article Elsevier</td>
                        <td>01/05/2025</td>
                        <td>Interfaces Cerveau-Machine</td>
                        <td><span class="badge badge-warning"><i class="fa-regular fa-clock"></i>En attente</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="/details-publication-directeur-du-labo"><i
                                            class="fa-regular fa-eye"></i>Voir</a>
                                    <a href="/modifier-une-publication-directeur-du-labo"><i
                                            class="fa-regular fa-pen-to-square"></i>Modifier</a>
                                    <a href="#"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // --- DATATABLE INITIALIZATION ---

    // Base DataTable options, shared between tables
    const baseDataTableOptions = {
        paging: true,
        searching: true,
        ordering: false,
        info: false,
        pageLength: 5,
        dom: 't<"bottom"p>', // 't' is table, 'p' is pagination
        language: {
            paginate: {
                previous: "<i class='fa fa-chevron-left'></i>",
                next: "<i class='fa fa-chevron-right'></i>"
            },
            emptyTable: "Aucune donnée disponible"
        }
    };

    // --- FIX: Initialize each table with its own specific options to prevent errors ---

    // Options for the first table (Suivi)
    var suiviTableOptions = $.extend(true, {}, baseDataTableOptions, {
        columnDefs: [{
            orderable: false,
            targets: [0, 6] // Correct targets for checkbox and actions columns
        }]
    });
    var suiviTable = $('#candidaturesTable').DataTable(suiviTableOptions);

    // Options for the second table (Mes Publications)
    var mesPublicationsTableOptions = $.extend(true, {}, baseDataTableOptions, {
        columnDefs: [{
            orderable: false,
            targets: [0, 5] // Correct targets for checkbox and actions columns
        }]
    });
    var mesPublicationsTable = $('#mesPublicationsTable').DataTable(mesPublicationsTableOptions);


    // --- CUSTOM SEARCH ---

    // Connect each search input to its corresponding table
    $('#candidaturesSearch').on('keyup', function() {
        suiviTable.search(this.value).draw();
    });

    $('#mesPublicationsSearch').on('keyup', function() {
        mesPublicationsTable.search(this.value).draw();
    });


    // --- CHECK ALL FUNCTIONALITY ---

    // NEW: "Check All" for "Suivi Des Publications" table
    $('#checkAllSuivi').on('click', function() {
        var rows = suiviTable.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // NEW: Uncheck "Check All" in first table if an individual checkbox is unchecked
    $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
        if (!this.checked) {
            var el = $('#checkAllSuivi').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

    // "Check All" for "Mes Publications" table
    $('#checkAll').on('click', function() {
        var rows = mesPublicationsTable.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Uncheck "Check All" in second table if an individual checkbox is unchecked
    $('#mesPublicationsTable tbody').on('change', 'input[type="checkbox"]', function() {
        if (!this.checked) {
            var el = $('#checkAll').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });


    // --- UI INTERACTIONS ---

    // Tab switching logic
    $('.tab-btn').on('click', function() {
        const tabId = $(this).data('tab');
        $('.tab-btn').removeClass('active');
        $(this).addClass('active');
        $('.tab-panel').removeClass('active');
        $('#' + tabId).addClass('active');
        // Redraw tables on tab switch to fix any layout issues
        suiviTable.draw();
        mesPublicationsTable.draw();
    });

    // Dropdown menu logic for both tables
    $(document).on('click', '.action-btn', function(e) {
        e.stopPropagation();
        let dropdown = $(this).closest('.actions').find('.dropdown-menu');
        $('.dropdown-menu').not(dropdown).hide();
        dropdown.toggle();
    });

    // Close dropdowns when clicking anywhere else
    $(document).on('click', function() {
        $('.dropdown-menu').hide();
    });
});
</script>