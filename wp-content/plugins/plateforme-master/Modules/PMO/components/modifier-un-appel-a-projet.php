<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Appel à Projet</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">


    <style>
    /* General Body Styles */



    /* Main container for the entire component */
    .bloc-creation-appel {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    /* Header Bar */
    .header-bar {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #DBD9C3;
    }

    .header-bar h3 {
        font-size: 20px;
        font-weight: bold;
        color: #2A2916;
        margin: 0;
    }

    /* Form Group for labels and inputs */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #6E6D55;
    }

    /* Input fields styling */
    .input-field,
    .titre-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #DBD9C3;
        border-radius: 8px;
        font-size: 15px;
        background-color: #FFFFFF;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-sizing: border-box;
        /* Important for padding */
    }

    .input-field:focus,
    .titre-input:focus {
        outline: none;
    }

    /* Date fields container */
    .date-fields-container {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .date-fields-container .form-group {
        flex: 1;
    }

    .date-input-wrapper {
        position: relative;
    }

    .date-input-wrapper .fa-calendar-alt {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    /* Quill Editor */
    .description-editor {
        margin-bottom: 20px;
    }

    #quill-editor {
        border: 1px solid #ccc;
        border-radius: 0 0 8px 8px;
        min-height: 150px;
        font-size: 15px;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid #DBD9C3;
        border-bottom: 0;
        border-radius: 8px 8px 0 0;
        background-color: #ECEBE3;
    }

    /* File Upload Group */
    .file-upload-group {
        display: flex;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        height: 48px;
        background-color: #fafafa;
    }

    #file-display {
        flex: 1;
        padding: 12px 14px;
        font-size: 14px;
        color: #888;
        line-height: 24px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #pj {
        display: none;
        /* Hide the actual file input */
    }

    .btn-upload {
        background-color: #A6A485;
        color: #fff;
        border: none;
        padding: 0 20px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-upload:hover {
        background-color: #777;
    }

    /* Project List Section */
    .project-list-container {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #DBD9C3;
    }

    .list-header h4 {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-controls {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        align-items: center;
    }

    .search-bar input {
        border: none;
        outline: none;
        padding: 10px 15px;
        font-size: 15px;
        flex-grow: 1;
    }

    .search-bar button {
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 0 12px;
        color: #888;
    }

    #typeFilter {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 15px;
        background-color: #fff;
    }



    div.bottom {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3em 0.8em;
        margin-left: 2px;
        border-radius: 6px;
        border: 1px solid #BF0404;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #c52026;
        color: white !important;
        border-color: #c52026;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f1f1f1;
        border-color: #ddd;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        cursor: not-allowed;
        opacity: 0.5;
        border: 1px solid #BF0404;
    }

    .dataTables_empty {
        padding: 0 !important;
        text-align: center;
    }

    .empty-table-message {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 80px 0;
        font-size: 16px;
        font-weight: 500;
        color: #b0b0b0;
    }

    .empty-table-message .fas {
        font-size: 50px;
        margin-bottom: 15px;
        color: #e0e0e0;
    }

    .consulter-icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;

        border-radius: 5px;
        color: #555;
        font-size: 14px;
        box-shadow: 0px 0px 6px #0000001F;
    }

    /* Launch Button */
    #btnLancerAppel {
        background-color: #c52026;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s, opacity 0.3s;
    }

    #btnLancerAppel:hover:not(:disabled) {
        background-color: #a91c21;
        transform: translateY(-2px);
    }

    #btnLancerAppel:disabled {
        background-color: #D5D5D5;
        cursor: not-allowed;
        /* opacity: 0.6; */
        color: #7D7D7D;
    }

    #projetsTable {
        text-align: center;
        border: none !important;
        box-shadow: none !important;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 30px;
    }

    #projetsTable th {
        border: 0
    }

    #projetsTable td {
        border: 1px solid #EBE9D7 !important;
    }

    #projetsTable thead {
        position: static;
        transform: translateY(-15px);
        background-color: #ECEBE3;
    }

    #projetsTable tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important
    }

    /* arrondis */
    #projetsTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px
    }

    #projetsTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px
    }

    #projetsTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px
    }

    #projetsTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px
    }

    #projetsTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px
    }

    #projetsTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px
    }
    </style>
</head>

<body>
    <div class="bloc-creation-appel">
        <div class="header-bar">
            <h3>Modifier un appel à projet</h3>
        </div>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" placeholder="" class="titre-input" name="titre" />
        </div>

        <!-- Description with Quill -->
        <div class="form-group">
            <label>Description</label>
            <div class="description-editor">
                <div id="quill-toolbar"></div>
                <div id="quill-editor"></div>
            </div>
        </div>

        <!-- Pièce jointe -->
        <div class="form-group">
            <label for="pj">Pièce jointe</label>
            <div class="file-upload-group">
                <input type="file" id="pj" name="file" />
                <span id="file-display"></span>
                <button type="button" class="btn-upload" id="btnTriggerUpload">
                    <!-- <i class="fa fa-upload"></i> -->

                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                        alt="Icon-uploadwhite.png">

                    Importer
                </button>
            </div>
        </div>

        <!-- Dates -->
        <div class="date-fields-container">
            <div class="form-group">
                <label for="date_ouverture">Date d'ouverture</label>
                <div class="date-input-wrapper">
                    <input type="text" id="date_ouverture" name="date_ouverture" class="input-field"
                        placeholder="Sélectionnez une date...">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="date_cloture">Date clôture</label>
                <div class="date-input-wrapper">
                    <input type="text" id="date_cloture" name="date_cloture" class="input-field"
                        placeholder="Sélectionnez une date...">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Project List Section -->
    <div class="project-list-container">
        <div class="list-header">
            <h4>
                <img width="30px" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png"
                    alt="10550857.png">
                <!-- <i class="fas fa-list-alt"></i>  -->
                Liste Des Projets
            </h4>
            <button id="btnLancerAppel" type="button" disabled>Lancer l'appel à projet</button>
        </div>
        <div class="search-controls">
            <div class="search-bar">
                <input type="text" id="searchInput" class="input-field" placeholder="Recherchez...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <select id="typeFilter">
                <option value="">Type Du Projet</option>
                <option value="National">National</option>
                <option value="Européen">Européen</option>
                <option value="Bilatéral">Bilatéral</option>
            </select>
        </div>

        <table id="projetsTable" class="display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Projets</th>
                    <th>Type</th>
                    <th>Consulter</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Rows -->
                <tr data-project-id="1">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Détection IA Dans L'agriculture</td>
                    <td>National</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="2">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Stockage Cloud De Données Santé</td>
                    <td>Européen</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="3">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Interfaces Adaptatives AR/VR</td>
                    <td>Bilatéral</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="4">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Projet Alpha</td>
                    <td>National</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="5">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Projet Beta</td>
                    <td>Européen</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="6">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Projet Gamma</td>
                    <td>National</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
                <tr data-project-id="7">
                    <td><input type="checkbox" class="project-checkbox"></td>
                    <td>Projet Delta</td>
                    <td>Bilatéral</td>
                    <td><a href="/gestion-des-projets-details-projets"><span class="consulter-icon-wrapper"><i
                                    class="fas fa-eye"></i></span></a></td>
                </tr>
            </tbody>
        </table>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script> <!-- French Locale for Flatpickr -->


    <script>
    $(document).ready(function() {
        // --- DataTables Initialization ---
        const baseDT = {
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            pagingType: 'full_numbers',
            dom: 't<"bottom"p>',
            language: {
                paginate: {
                    first: "<i class='fa fa-angles-left' style='color:#C60000;'></i>",
                    previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                    next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>",
                    last: "<i class='fa fa-angles-right' style='color:#C60000;'></i>"
                },
                emptyTable: "<div class='empty-table-message'><i class='fas fa-clipboard-list'></i><span>Aucune donnée disponible dans le tableau</span></div>",
                zeroRecords: "<div class='empty-table-message'><i class='fas fa-clipboard-list'></i><span>Aucun enregistrement correspondant trouvé</span></div>"
            }
        };

        var table = $('#projetsTable').DataTable({
            ...baseDT,
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 3] // Disable sorting for checkbox and consult columns
            }]
        });

        // Custom search
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Custom filter
        $('#typeFilter').on('change', function() {
            table.column(2).search(this.value).draw();
        });

        // Re-bind checkbox events on table draw
        $('#projetsTable').on('draw.dt', function() {
            updateCheckboxListeners();
            updateLaunchButtonState();
        });


        // --- Mock PMSettings for demonstration ---
        const PMSettings = {
            user_id: '123',
            nonce: 'a1b2c3d4e5'
        };

        // --- Flatpickr Initialization ---
        flatpickr("#date_ouverture", {
            dateFormat: "Y-m-d",
            locale: "fr",
        });
        flatpickr("#date_cloture", {
            dateFormat: "Y-m-d",
            locale: "fr",
        });

        // --- Quill Editor Initialization ---
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Description...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                ]
            }
        });

        // --- File Upload UI Logic ---
        document.getElementById('btnTriggerUpload').addEventListener('click', () => {
            document.getElementById('pj').click();
        });

        document.getElementById('pj').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : '';
            document.getElementById('file-display').textContent = fileName;
        });

        // --- Table Checkbox and Button State Logic ---
        const launchButton = document.getElementById('btnLancerAppel');

        function updateLaunchButtonState() {
            const anyChecked = $('#projetsTable .project-checkbox:checked').length > 0;
            launchButton.disabled = !anyChecked;
        }

        function updateCheckboxListeners() {
            $('#selectAll').off('change').on('change', function() {
                $('#projetsTable .project-checkbox').prop('checked', this.checked);
                updateLaunchButtonState();
            });

            $('#projetsTable .project-checkbox').off('change').on('change', function() {
                if (!this.checked) {
                    $('#selectAll').prop('checked', false);
                }
                updateLaunchButtonState();
            });
        }

        updateCheckboxListeners();
        updateLaunchButtonState(); // Initial check


        // --- Data Collection and Submission Logic ---

        function getAppelProjetData() {
            const titre = document.querySelector('input[name="titre"]').value.trim();
            const description = document.querySelector('#quill-editor .ql-editor').innerHTML.trim();
            const fichierInput = document.querySelector('input[type="file"]');
            const fichier_joint = fichierInput.files.length > 0 ? fichierInput.files[0] : null;
            const date_ouverture = document.querySelector('input[name="date_ouverture"]').value;
            const date_cloture = document.querySelector('input[name="date_cloture"]').value;
            const user_id = PMSettings.user_id || null;
            const date_creation = new Date().toISOString().slice(0, 19).replace("T", " ");

            const projet_ids = [];
            $('#projetsTable .project-checkbox:checked').each(function() {
                const row = $(this).closest('tr');
                if (row && row.data('projectId')) {
                    projet_ids.push(row.data('projectId'));
                }
            });

            return {
                titre,
                description,
                fichier_joint,
                date_ouverture,
                date_cloture,
                date_creation,
                user_id,
                projet_ids
            };
        }

        function validateAppelForm(data) {
            console.log("Validating data:", data);
            if (!data.titre) {
                alert("❌ Le titre est obligatoire.");
                return false;
            }
            if (!data.description || data.description === "<p><br></p>") {
                alert("❌ La description est obligatoire.");
                return false;
            }
            if (!data.date_ouverture) {
                alert("❌ La date d'ouverture est obligatoire.");
                return false;
            }
            if (!data.date_cloture) {
                alert("❌ La date de clôture est obligatoire.");
                return false;
            }
            if (data.projet_ids.length === 0) {
                alert("❌ Veuillez sélectionner au moins un projet.");
                return false;
            }
            return true;
        }

        document.querySelector('#btnLancerAppel').addEventListener('click', async () => {
            const data = getAppelProjetData();

            if (!validateAppelForm(data)) return;

            const formData = new FormData();
            formData.append('titre', data.titre);
            formData.append('description', data.description);
            formData.append('date_creation', data.date_creation);
            formData.append('date_ouverture', data.date_ouverture);
            formData.append('date_cloture', data.date_cloture);
            formData.append('user_id', data.user_id);
            if (data.fichier_joint) {
                formData.append('fichier_joint', data.fichier_joint);
            }
            formData.append('projet_ids', JSON.stringify(data.projet_ids));

            // --- Mocking API call for demonstration ---
            console.log('--- Submitting Data ---');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}:`, value);
            }
            alert('✅ Appel à projet prêt à être envoyé ! (Voir console pour les données)');


            /*
                            // --- REAL API CALL ---
                            try {
                                const response = await fetch('/wp-json/plateforme-master/v1/creer-appel-projet', { // Note: endpoint might need change
                                    method: 'POST',
                                    headers: {
                                        'X-WP-Nonce': PMSettings.nonce
                                    },
                                    body: formData
                                });
            
                                const result = await response.json();
            
                                if (response.ok && result.success) {
                                    alert('✅ Appel à projet créé avec succès !');
                                    // window.location.href = '/nouveau-lien-succes/'; // Redirect on success
                                } else {
                                    console.error("Erreur serveur :", result);
                                    alert('❌ Échec de la création : ' + (result.message || 'erreur inconnue.'));
                                }
                            } catch (error) {
                                console.error("Erreur réseau :", error);
                                alert('❌ Problème de connexion ou erreur serveur.');
                            }
                            */
        });
    });
    </script>
</body>

</html>