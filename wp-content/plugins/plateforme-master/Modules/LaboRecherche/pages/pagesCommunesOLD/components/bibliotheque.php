<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Documents</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f9f9f9;
    }

    .dashboard-sub-title {
        text-align: center;
        font-size: 20px;
        font-weight: 700 !important;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-bottom: 30px;
        position: relative;
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
        width: 270px;
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
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .add-project-btn:hover {
        background-color: #a50000;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 16px 0;
    }

    /* --- Restored Original Table Styles --- */
    #candidaturesTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
    }

    #candidaturesTable th {
        border: 0px solid #EBE9D7;
        background-color: #ECEBE3;
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
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    #candidaturesTable thead tr:first-child th:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;

    }

    #candidaturesTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 8px;
    }

    #candidaturesTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 8px;
    }

    #candidaturesTable tbody tr:first-child td:first-child {
        border-top-left-radius: 8px;
    }

    #candidaturesTable tbody tr:first-child td:last-child {
        border-top-right-radius: 8px;
    }

    /* End of restored styles */

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        display: none;
        justify-content: flex-end;
        z-index: 999999;
    }

    .popup-container {
        background-color: white;
        width: 450px;
        height: 100%;
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
        box-shadow: 0px 5px 16px #0000001A;
        flex-shrink: 0;
    }

    .popup-header h2 {
        font-size: 18px;
        margin: 0;
        color: #2A2916;
    }

    .popup-header .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .popup-form,
    .popup-content {
        padding: 25px;
        flex-grow: 1;
        overflow-y: auto;
    }

    .btn-enregistrer {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-close-x {
        background: transparent;
        border: none;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        padding: 0 10px;
        line-height: 1;
        transition: color 0.2s ease;
    }

    .btn-close-x:hover {
        color: #c40000;
    }


    .popup-form .form-group {
        margin-bottom: 20px;
    }

    .popup-form .form-group label {
        display: block;
        font-weight: 600;
        color: #6E6D55;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .popup-form .form-group input,
    .popup-form .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    /* New styles for custom date icon */
    .popup-form .input-with-icon input[type="date"] {
        padding-right: 2.5rem;
        /* Make space for the icon */
    }

    /* Hide the default calendar icon in WebKit browsers */
    .popup-form .input-with-icon input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    .custom-file-input {
        display: flex;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        overflow: hidden;
        width: 100%;
        height: 42px;
        align-items: center;
        background-color: #fff;
    }

    .file-name-display {
        flex-grow: 1;
        padding: 10px 12px;
        font-size: 14px;
        color: #888;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-upload-btn {
        background-color: #c9c5a8;
        color: #ffffffff;
        border: none;
        padding: 0 18px;
        height: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: background-color 0.2s;
        border-left: 1px solid #b5af8e;
    }

    .file-upload-btn:hover {
        background-color: #b9b598;
    }

    /* --- New Pagination Styles --- */
    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        margin: 0 4px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        background-color: #fff;
        color: #b0b0b0;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border-color: #c60000;
        color: #c60000;
        background-color: #fef2f2;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #c60000;
        color: #fff !important;
        border-color: #c60000;
        font-weight: 700;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        color: #dcdcdc;
        border-color: #f0f0f0;
        background-color: #fafafa;
        cursor: not-allowed;
        box-shadow: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button i {
        font-size: 14px;
    }
    </style>
</head>

<body>

    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img src="/wp-content/plugins/plateforme-master/images/icons/2235812.png" alt="Icon" width="32px"
                    onerror="this.src='https://placehold.co/32x32/f8d7da/c60000?text=Doc'">
                Documents partagés
            </h2>
            <a href="#" id="openModalBtn" class="add-project-btn"><i class="fas fa-plus" style="margin-right: 6px;"></i>
                Ajouter Un document</a>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" type="text" id="customSearchInput" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon"></i>
            </div>

            <div class="filter-actions" style="position: static;">
                <!-- Download Icon -->
                <button class="icon-btn" title="Télécharger">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                        alt="Download Icon" onerror="this.src='https://placehold.co/20x20/f0f0f0/c60000?text=DL'">
                </button>
            </div>
        </div>

        <table id="candidaturesTable" class="styled-table display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Nom du fichier</th>
                    <th>Type</th>
                    <th>Année</th>
                    <th>Ajouté par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Add Document Modal -->
    <div class="modal-overlay" id="addMeetingModal">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Ajouter un Document</h2>
                <div class="header-actions">
                    <button class="btn-enregistrer" id="saveMeetingBtn">Enregistrer</button>
                    <button class="btn-close-x" id="closeModalBtn">×</button>
                </div>
            </div>
            <form id="docForm" class="popup-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fileType">Type Du Fichier</label>
                    <select id="fileType" name="type">
                        <option value="">Choisir le type</option>
                        <option value="reglements">Reglements</option>
                        <option value="rapports">Modèles De Rapport</option>
                        <option value="supports">Supports Administratifs</option>
                        <option value="guides">Guides Étudiants</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileName">Nom Du Fichier</label>
                    <input type="text" id="fileName" name="titre" placeholder="Nom Du Fichier">
                </div>
                <div class="form-group">
                    <label for="fileUpload">Fichier</label>
                    <div class="custom-file-input">
                        <input type="file" id="fileUpload" name="fichier" style="display: none;">
                        <span class="file-name-display">Aucun fichier choisi...</span>
                        <button type="button" class="file-upload-btn">
                            <!-- <i class="fas fa-upload"></i>  -->
                            <img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite">

                            Importer
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="addDate">Date D'ajout</label>
                    <div class="input-with-icon">
                        <input type="date" id="addDate" name="date_upload">
                        <img class="icon right-icon" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                            alt="Icon-calendar.png">
                        <!-- <i class="fas fa-calendar-alt "></i> -->
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script type="module">
    // Global variable to hold the DataTable instance
    let table;

    // Mock API settings for demonstration if not in a WP environment
    if (typeof window.PMSettings === 'undefined') {
        window.PMSettings = {
            restUrl: 'https://jsonplaceholder.typicode.com/',
            nonce: 'mock-nonce'
        };
    }

    const API_BASE = (window.PMSettings?.restUrl.includes('jsonplaceholder')) ?
        window.PMSettings.restUrl :
        (window.PMSettings?.restUrl || '/wp-json/') + 'plateforme-recherche/v1';


    // ---- Helper fetch ----
    async function wpFetch(path, opts = {}) {
        // Mock fetch for demonstration
        if (API_BASE.includes('jsonplaceholder')) {
            console.log("Using mock data for demonstration.");
            return new Promise(resolve => {
                setTimeout(() => {
                    resolve([{
                        id: 1,
                        titre: 'Reglements.pdf',
                        type: 'Reglements',
                        date_upload: '2023-10-26T10:00:00',
                        first_name: 'Directeur',
                        last_name: 'UTM',
                        fichier_path: '#'
                    }, {
                        id: 2,
                        titre: 'Modeles-de-rapport.pdf',
                        type: 'Modèles De Rapport',
                        date_upload: '2023-10-25T11:30:00',
                        first_name: 'Dr.',
                        last_name: 'Trabelsi',
                        fichier_path: '#'
                    }, {
                        id: 3,
                        titre: 'Convention-du-stage.pdf',
                        type: 'Supports Administratifs',
                        date_upload: '2023-10-24T09:00:00',
                        first_name: 'Directeur',
                        last_name: 'UTM',
                        fichier_path: '#'
                    }, {
                        id: 4,
                        titre: 'Guide-des-soutenances.pdf',
                        type: 'Guides Étudiants',
                        date_upload: '2023-10-23T15:00:00',
                        first_name: 'Mm. Soufia',
                        last_name: 'Ben Nejma',
                        fichier_path: '#'
                    }]);
                }, 500);
            });
        }

        const res = await fetch(API_BASE + path, {
            method: opts.method || 'GET',
            credentials: 'include',
            headers: {
                'X-WP-Nonce': window.PMSettings?.nonce || '',
                'Content-Type': 'application/json'
            },
            body: opts.body ? JSON.stringify(opts.body) : undefined
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);
        return res.json();
    }

    // ---- Build table row ----
    function buildRow(doc) {
        return `
                <tr data-id="${doc.id}">
                    <td><input type="checkbox"></td>
                    <td>${doc.titre || doc.fichier_path || 'N/A'}</td>
                    <td>${doc.type || '—'}</td>
                    <td>${doc.date_upload ? doc.date_upload.substring(0, 10) : '—'}</td>
                    <td>${doc.chercheur_nom || (doc.first_name ? doc.first_name + ' ' + (doc.last_name || '') : '—')}</td>
                    <td class="text-center">
                        ${doc.fichier_path ? `<a href="${doc.fichier_path}" target="_blank" title="Download">
                        <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-upload.png" alt="Icon-upload">
                        </a>` : '—'}
                    </td>
                </tr>
            `;
    }

    // ---- Load documents and initialize DataTable ----
    async function loadDocuments() {
        try {
            const docs = await wpFetch('/document?page=1&per_page=50'); // In mock, path is ignored
            const tbody = document.querySelector('#candidaturesTable tbody');
            tbody.innerHTML = '';
            docs.forEach(doc => {
                tbody.insertAdjacentHTML('beforeend', buildRow(doc));
            });

            // Destroy existing DataTable instance if it exists
            if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
                $('#candidaturesTable').DataTable().destroy();
            }

            // Initialize a new DataTable instance and assign it to the global variable
            table = $('#candidaturesTable').DataTable({
                paging: true,
                pagingType: 'full_numbers', // Use full pagination
                searching: true, // Enable internal searching for the custom input to work
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 't<"dataTables_wrapper"p>', // Show only table and paginator
                language: {
                    emptyTable: "Aucun document disponible",
                    zeroRecords: "Aucun résultat trouvé",
                    paginate: {
                        first: "<i class='fa fa-angles-left'></i>",
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>",
                        last: "<i class='fa fa-angles-right'></i>"
                    }
                },
                columnDefs: [{
                    targets: [0, 5], // Target checkbox and actions columns
                    orderable: false,
                    searchable: false // These columns shouldn't be searched
                }]
            });

        } catch (e) {
            console.error('Erreur chargement documents', e);
            const tbody = document.querySelector('#candidaturesTable tbody');
            tbody.innerHTML = `<tr><td colspan="6">Erreur de chargement des documents.</td></tr>`;
        }
    }

    // ---- Add a new document ----
    async function addDocument() {
        const form = document.getElementById('docForm');
        const formData = new FormData(form);

        // Mock response for demonstration
        if (API_BASE.includes('jsonplaceholder')) {
            console.log("Mocking document add:", Object.fromEntries(formData));
            Swal.fire({
                title: 'Succès!',
                text: 'Document ajouté (simulation).',
                icon: 'success',
                confirmButtonColor: '#c60000'
            });
            await loadDocuments();
            document.getElementById('addMeetingModal').style.display = 'none';
            form.reset();
            return;
        }

        try {
            const res = await fetch(API_BASE + '/document', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || ''
                },
                body: formData
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const json = await res.json();
            console.log("Document ajouté:", json);

            Swal.fire({
                title: 'Succès!',
                text: 'Le document a été ajouté.',
                icon: 'success',
                confirmButtonColor: '#c60000'
            });

            await loadDocuments();
            document.getElementById('addMeetingModal').style.display = 'none';
            form.reset();
        } catch (e) {
            Swal.fire({
                title: 'Erreur!',
                text: 'Impossible d\'ajouter le document: ' + e.message,
                icon: 'error',
                confirmButtonColor: '#c60000'
            });
        }
    }


    // ---- Main execution block ----
    document.addEventListener('DOMContentLoaded', () => {
        // Load initial data
        loadDocuments();

        // --- Custom Search Functionality ---
        $('#customSearchInput').on('keyup', function() {
            if (table) {
                table.search(this.value).draw();
            }
        });

        // --- "Check All" Functionality ---
        $('#checkAll').on('click', function() {
            const checkboxes = $('#candidaturesTable tbody input[type="checkbox"]');
            checkboxes.prop('checked', $(this).prop('checked'));
        });

        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                $('#checkAll').prop('checked', false);
            } else {
                const totalCheckboxes = $('#candidaturesTable tbody input[type="checkbox"]').length;
                const checkedCheckboxes = $('#candidaturesTable tbody input[type="checkbox"]:checked')
                    .length;
                if (totalCheckboxes === checkedCheckboxes) {
                    $('#checkAll').prop('checked', true);
                }
            }
        });

        // --- Add Modal Functionality ---
        const openBtn = document.getElementById('openModalBtn');
        const addModal = document.getElementById('addMeetingModal');
        const closeBtn = document.getElementById('closeModalBtn');
        const saveBtn = document.getElementById('saveMeetingBtn');
        const addPopupContainer = addModal.querySelector('.popup-container');

        const openAddModal = () => addModal.style.display = 'flex';
        const closeAddModal = () => addModal.style.display = 'none';

        openBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openAddModal();
        });
        closeBtn.addEventListener('click', closeAddModal);

        saveBtn.addEventListener('click', (e) => {
            e.preventDefault();
            addDocument();
        });

        addModal.addEventListener('click', (e) => {
            if (!addPopupContainer.contains(e.target)) {
                closeAddModal();
            }
        });

        // --- Custom File Input ---
        const fileInput = document.getElementById('fileUpload');
        const fileNameDisplay = document.querySelector('.file-name-display');
        const fileUploadBtn = document.querySelector('.file-upload-btn');

        fileUploadBtn.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
                fileNameDisplay.style.color = '#333';
            } else {
                fileNameDisplay.textContent = 'Aucun fichier choisi...';
                fileNameDisplay.style.color = '#888';
            }
        });
    });
    </script>
</body>

</html>