<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f4f9;
    }

    .dashboard-sub-title {
        font-weight: bold;
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

    .filter-selectgb {
        display: contents;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        margin-left: auto;
    }

    .btn-ajouter-colonnes {
        background: #fff;
        border: 1px solid #ccc;
        padding: 10px 14px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }

    .content-block {
        background: #fff;
        border-radius: 10px;
        padding: 24px;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
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
        margin: 10px 0;
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

    .coord-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        vertical-align: middle;
    }

    .coord-placeholder {
        margin-left: 10px;
        vertical-align: middle;
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

    .actions {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 125px !important;
        background-color: #ffffff;
        border: 1px solid #d8d4b7;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .dropdown-menu a {
        display: block;
        padding: 9px;
        text-decoration: none;
        font-size: 14px;
        color: #2d2a12;
        transition: background-color 0.2s;
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
        color: #fff !important;
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

    /* Modal Styles */
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

    .popup-form {
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

    .popup-form .form-group input[type="text"],
    .popup-form .form-group input[type="email"],
    .popup-form .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .radio-option-label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        width: 100%;
    }

    .radio-option input[type="radio"] {
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #c60000;
        border-radius: 50%;
        position: relative;
        cursor: pointer;
    }

    .radio-option input[type="radio"]:checked::before {
        content: '';
        display: block;
        width: 10px;
        height: 10px;
        background-color: #c60000;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .form-content-wrapper {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        border: 1px solid transparent;
        border-radius: 8px;
        margin-top: 10px;
    }

    .form-content-wrapper.visible {
        max-height: 500px;
        /* Adjust as needed */
        border-color: #e0e0e0;
        padding: 15px;
    }
</style>


<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/icons/921354.png" alt="Icon"
                style="width: 38px; margin-right: 8px; vertical-align: middle; font-weight: blod;">
            Liste Des Membres
        </h2>
        <button class="add-project-btn" id="addMemberBtn">Ajouter membre</button>
    </div>


    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <div class="input-with-icon">
                <input class="filter-input" type="text" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon search-field"></i>
            </div>
            <div class="input-with-icon">
                <!-- Added ID 'gradeFilter' -->
                <select class="filter-select" id="gradeFilter">
                    <option value="">Grade (All)</option>
                    <option>Maître-Assistant</option>
                    <option>Doctorant</option>
                    <option>Doctorante</option>
                    <option>Professeur</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
            <div class="input-with-icon">
                <!-- Added ID 'projectFilter' -->
                <select class="filter-select" id="projectFilter">
                    <option value="">Projet Lié (All)</option>
                    <option>BCI-Learn, ARUX</option>
                    <option>BCI-Learn</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
        </div>
        <div class="filter-actions">
            <button class="icon-btn" title="Filter">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                    alt="Icon-funnel">
            </button>
            <button class="icon-btn" title="Download">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                    alt="upload-red.png">
            </button>
        </div>
    </div>

    <table id="candidaturesTable" class="styled-table display">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Nom & Prénom</th>
                <th>Grade / Statut</th>
                <th>Spécialité</th>
                <th>Projets liés</th>
                <th>Dernière activité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!--    
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 435.png"
                        alt="profile" class="coord-avatar">
                    <span class="coord-placeholder">Dr. Sarra Messaoudi</span>
                </td>
                <td class="left">Maître-Assistant</td>
                <td>Intelligence Artificielle</td>
                <td>BCI-Learn, ARUX</td>
                <td>10/07/2025</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="edit-btn">Modifier</a>
                            <a href="/membre-de-labo-fiche-membres/">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                        alt="profile" class="coord-avatar">
                    <span class="coord-placeholder">Houssem Lahmar</span>
                </td>
                <td class="left">Doctorant</td>
                <td>Traitement du signal</td>
                <td>BCI-Learn</td>
                <td>10/07/2025</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="edit-btn">Modifier</a>
                            <a href="/membre-de-labo-fiche-membres/">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 436.png"
                        alt="profile" class="coord-avatar">
                    <span class="coord-placeholder">Marwa Trabelsi</span>
                </td>
                <td class="left">Doctorante</td>
                <td>Neurosciences</td>
                <td>BCI-Learn</td>
                <td>10/07/2025</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="edit-btn">Modifier</a>
                            <a href="/membre-de-labo-fiche-membres/">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 437.png"
                        alt="profile" class="coord-avatar">
                    <span class="coord-placeholder">Pr. Rym Nasri</span>
                </td>
                <td class="left">Professeur</td>
                <td>Interfaces cerveau-machine</td>
                <td>BCI-Learn, ARUX</td>
                <td>10/07/2025</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" class="edit-btn">Modifier</a>
                            <a href="/membre-de-labo-fiche-membres/">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>-->
        </tbody>
    </table>

</div>

<!-- Add Member Modal -->
<div class="modal-overlay" id="addMemberModal" data-laboratoire-id="__LAB_ID__">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Ajouter un membre du laboratoire</h2>
            <div class="header-actions">
                <button class="btn-enregistrer" id="saveMemberBtn" type="button">Enregistrer</button>
            </div>
        </div>

        <form class="popup-form" id="addMemberForm">
            <div class="radio-group">
                <div class="radio-option">
                    <label class="radio-option-label">
                        <input type="radio" name="addMemberType" value="existing" checked>
                        <span>Sélection d'un membre existant</span>
                    </label>
                </div>

                <!-- ====== Contenu : Sélection d’un membre existant ====== -->
                <div id="existingMemberContent" class="form-content-wrapper">
                    <div class="filters-row" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                        <div class="form-group">
                            <label for="filterEtablissement">Établissement</label>
                            <select id="filterEtablissement" style="min-width:220px">
                                <option value="">Tous les établissements</option>
                                <!-- Rempli dynamiquement -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="filterRoles">Rôles</label>
                            <select id="filterRoles" multiple style="min-width:220px">
                                <option value="um_chercheur">Chercheur</option>
                                <option value="um_doctorant">Doctorant</option>
                                <option value="um_student_master">Étudiant Master</option>
                            </select>
                            <small>Ctrl/Cmd+clic pour multi‑sélection</small>
                        </div>

                        <div class="form-group" style="flex:1 1 260px;">
                            <label for="filterSearch">Recherche</label>
                            <input id="filterSearch" type="text" placeholder="Nom, email, spécialité…">
                        </div>

                        <div class="form-group">
                            <button class="btn" type="button" id="btnFindMembers">Rechercher</button>
                        </div>
                    </div>

                    <div class="results-box" style="margin-top:10px;">
                        <table id="membersResults" class="table-members" style="width:100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Utilisateur</th>
                                    <th>Établissement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rempli dynamiquement -->
                            </tbody>
                        </table>
                    </div>

                    <div class="form-row" style="display:flex; gap:12px; margin-top:14px;">
                        <div class="form-group" style="flex:1;">
                            <label for="newMemberGrade">Grade</label>
                            <input id="newMemberGrade" type="text" placeholder="Ex.: Doctorant, Maître-Assistant…">
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label for="newMemberSpecialite">Spécialité</label>
                            <input id="newMemberSpecialite" type="text" placeholder="Ex.: Neurosciences, IA…">
                        </div>
                    </div>
                </div>

                <div class="radio-option" style="margin-top:18px;">
                    <label class="radio-option-label">
                        <input type="radio" name="addMemberType" value="invite">
                        <span>Invitation par email (si membre externe)</span>
                    </label>
                </div>

                <!-- ====== Contenu : Invitation par email ====== -->
                <div id="inviteMemberContent" class="form-content-wrapper" style="display:none;">
                    <div class="form-row" style="display:flex; gap:12px; flex-wrap:wrap;">
                        <div class="form-group" style="flex:1;">
                            <label for="inviteEmail">Email</label>
                            <input id="inviteEmail" type="email" placeholder="prenom.nom@exemple.tld">
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label for="inviteGrade">Grade</label>
                            <input id="inviteGrade" type="text" placeholder="Ex.: Chercheur associé">
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label for="inviteSpecialite">Spécialité</label>
                            <input id="inviteSpecialite" type="text" placeholder="Ex.: Bio-informatique">
                        </div>
                    </div>
                    <p class="help-text">Une invitation sera envoyée pour créer un compte et finaliser l’ajout.</p>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Member Modal -->
<div class="modal-overlay" id="editMemberModal">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier le membre</h2>
            <div class="header-actions">
                <button class="btn-enregistrer" id="saveEditMemberBtn">Enregistrer</button>
            </div>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label>Nom & Prénom</label>
                <input type="text" value="Dr. Sarra Messaoudi">
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select>
                    <option>Post-Doc</option>
                    <option selected>Maître-Assistant</option>
                </select>
            </div>
            <div class="form-group">
                <label>Projet Liés</label>
                <select>
                    <option>Stockage Cloud Médical</option>
                    <option selected>BCI-Learn, ARUX</option>
                </select>
            </div>
            <div class="form-group">
                <label>Spécialité</label>
                <select>
                    <option>Interfaces Cerveau-Machine</option>
                    <option selected>Intelligence Artificielle</option>
                </select>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Custom Filter Functionality ---
        // This function adds a custom filter to DataTables
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                // Get the selected values from the dropdowns
                var selectedGrade = $('#gradeFilter').val();
                var selectedProject = $('#projectFilter').val();

                // Get the data from the current row for the relevant columns
                var rowGrade = data[2]; // Column 3: Grade / Statut
                var rowProject = data[4]; // Column 5: Projets liés

                // If the filter is empty or matches the row's data, show the row
                if (
                    (selectedGrade === "" || selectedGrade === rowGrade) &&
                    (selectedProject === "" || selectedProject === rowProject)
                ) {
                    return true;
                }

                // Otherwise, hide the row
                return false;
            }
        );

        const table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'Bfrtip',
            buttons: [],
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                    next: "<i class='fa fa-chevron-right'style='color:#C60000;'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            },
            initComplete: function () {
                $('.dataTables_filter').hide();
            }
        });

        // --- Event Listeners for Filters ---
        // When a dropdown value changes, redraw the table to apply the filter
        $('#gradeFilter, #projectFilter').on('change', function () {
            table.draw();
        });


        // Custom search functionality
        $('.filter-input').on('keyup', function () {
            table.search(this.value).draw();
        });

        // "Check All" functionality
        $('#checkAll').on('click', function () {
            const rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function () {
            if (!this.checked) {
                const el = $('#checkAll').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        // Dropdown menu logic
        $('#candidaturesTable').on('click', '.action-btn', function (e) {
            e.stopPropagation();
            $('.dropdown-menu').not($(this).next()).hide();
            $(this).next('.dropdown-menu').toggle();
        });

        document.addEventListener('click', function () {
            $('.dropdown-menu').hide();
        });



        // --- Add Member Modal Logic ---
        const addMemberModal = document.getElementById('addMemberModal');
        const addMemberBtn = document.getElementById('addMemberBtn');
        const addMemberTypeRadios = document.querySelectorAll('input[name="addMemberType"]');
        const existingMemberContent = document.getElementById('existingMemberContent');
        const inviteMemberContent = document.getElementById('inviteMemberContent');

        const existingMemberHTML = `
            <div class="filters-row" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                <div class="form-group">
                <label for="filterEtablissement">Établissement</label>
                <select id="filterEtablissement" style="min-width:220px">
                    <option value="">Tous les établissements</option>
                </select>
                </div>

                <div class="form-group">
                <label for="filterRoles">Rôles</label>
                <select id="filterRoles" multiple style="min-width:220px">
                    <option value="um_chercheur">Chercheur</option>
                    <option value="um_doctorant">Doctorant</option>
                    <option value="um_student_master">Étudiant Master</option>
                </select>
                <small>Ctrl/Cmd+clic pour multi‑sélection</small>
                </div>

                <div class="form-group" style="flex:1 1 260px;">
                <label for="filterSearch">Recherche</label>
                <input id="filterSearch" type="text" placeholder="Nom, email, spécialité…">
                </div>

                <div class="form-group">
                <button class="btn" type="button" id="btnFindMembers">Rechercher</button>
                </div>
            </div>

            <div class="results-box" style="margin-top:10px;">
                <table id="membersResults" class="table-members" style="width:100%;">
                <thead>
                    <tr><th></th><th>Utilisateur</th><th>Établissement</th></tr>
                </thead>
                <tbody></tbody>
                </table>
            </div>

            <div class="form-row" style="display:flex; gap:12px; margin-top:14px;">
                <div class="form-group" style="flex:1;">
                <label for="newMemberGrade">Grade</label>
                <input id="newMemberGrade" type="text" placeholder="Ex.: Doctorant, Maître-Assistant…">
                </div>
                <div class="form-group" style="flex:1;">
                <label for="newMemberSpecialite">Spécialité</label>
                <input id="newMemberSpecialite" type="text" placeholder="Ex.: Neurosciences, IA…">
                </div>
            </div>
            `;

        const inviteMemberHTML = `
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Rôle</label>
                    <select><option>Post-Doc</option></select>
                </div>
                <div class="form-group">
                    <label>Projet Liés</label>
                    <select><option>Stockage Cloud Médical</option></select>
                </div>
                <div class="form-group">
                    <label>Spécialité</label>
                    <select><option>Interfaces Cerveau-Machine</option></select>
                </div>`;

        const updateFormContent = () => {
            const selectedValue = document.querySelector('input[name="addMemberType"]:checked').value;

            if (selectedValue === 'existing') {
                existingMemberContent.innerHTML = existingMemberHTML;
                existingMemberContent.classList.add('visible');
                inviteMemberContent.classList.remove('visible');
                inviteMemberContent.innerHTML = '';
            } else {
                inviteMemberContent.innerHTML = inviteMemberHTML;
                inviteMemberContent.classList.add('visible');
                existingMemberContent.classList.remove('visible');
                existingMemberContent.innerHTML = '';
            }
        };

        addMemberBtn.addEventListener('click', () => {
            addMemberModal.style.display = 'flex';
            updateFormContent();
        });

        addMemberModal.addEventListener('click', (e) => {
            if (e.target === addMemberModal) {
                addMemberModal.style.display = 'none';
            }
        });

        addMemberTypeRadios.forEach(radio => {
            radio.addEventListener('change', updateFormContent);
        });

        // --- Edit Member Modal Logic ---
        const editMemberModal = document.getElementById('editMemberModal');

        $('#candidaturesTable tbody').on('click', '.edit-btn', function (e) {
            e.preventDefault();
            editMemberModal.style.display = 'flex';
        });

        editMemberModal.addEventListener('click', (e) => {
            if (e.target === editMemberModal) {
                editMemberModal.style.display = 'none';
            }
        });
    });
</script>




<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? '';
$user_id = get_current_user_id();
?>
<script>
    window.PMSettings = {
        restUrl: "<?= esc_url(rest_url()) ?>", // ex: https://utmresearchplatform.clickerp.tn/wp-json/
        nonce: "<?= wp_create_nonce('wp_rest') ?>", // nonce pour X-WP-Nonce
        role: "<?= esc_js($role) ?>", // rôle principal de l’utilisateur
        userId: <?= (int) $user_id ?> // ID WP de l’utilisateur
    };
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* =======================
         *   CONFIG REST
         * ======================= */
        const API_ROOT = (
            (window.PMSettings && PMSettings.restUrl) ||
            (window.wpApiSettings && window.wpApiSettings.root) ||
            '/wp-json'
        ).replace(/\/$/, '');
        const API_NS = 'plateforme-recherche/v1';
        const API_BASE = `${API_ROOT}/${API_NS}`;
        const NONCE = (window.PMSettings && PMSettings.nonce) ||
            (window.wpApiSettings && window.wpApiSettings.nonce) || '';

        const BASE_HEADERS = {
            'X-WP-Nonce': NONCE,
            'Accept': 'application/json'
        };
        const FETCH_BASE = {
            credentials: 'same-origin',
            headers: BASE_HEADERS
        };

        /* =======================
         *   HELPERS
         * ======================= */
        const $ = sel => document.querySelector(sel);

        function debounce(fn, delay = 350) {
            let t;
            return (...a) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...a), delay);
            };
        }

        function escapeHtml(s) {
            return (s ?? '').toString()
                .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
        }

        function serializeQuery(params) {
            const q = [];
            Object.entries(params || {}).forEach(([k, v]) => {
                if (v === undefined || v === null || v === '') return;
                if (Array.isArray(v)) v.forEach(val => q.push(encodeURIComponent(k) + '[]=' +
                    encodeURIComponent(val)));
                else q.push(encodeURIComponent(k) + '=' + encodeURIComponent(v));
            });
            return q.length ? '?' + q.join('&') : '';
        }
        async function parseError(res) {
            let json = null;
            try {
                json = await res.json();
            } catch (e) { }
            const msg = json?.message || `${res.status} ${res.statusText}`;
            const err = new Error(msg);
            err.status = res.status;
            err.details = json;
            return err;
        }
        async function apiGet(path, params = {}) {
            const url = API_BASE + path + serializeQuery(params);
            const res = await fetch(url, FETCH_BASE);
            if (!res.ok) throw await parseError(res);
            return res.json();
        }
        async function apiPost(path, body) {
            const res = await fetch(API_BASE + path, {
                ...FETCH_BASE,
                method: 'POST',
                headers: {
                    ...BASE_HEADERS,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body)
            });
            if (!res.ok) throw await parseError(res);
            return res.json();
        }


        function extractLabId(resp) {
            // Accepte objet {id:...} ou {laboratoire_id:...} ou {labo_id:...} ou tableau
            if (!resp) return 0;
            const tryOne = (row) => {
                if (!row || typeof row !== 'object') return 0;
                const id = parseInt(row.id ?? row.laboratoire_id ?? row.labo_id ?? row.lab_id ?? 0, 10);
                return Number.isFinite(id) && id > 0 ? id : 0;
            };
            if (Array.isArray(resp)) {
                for (const r of resp) {
                    const id = tryOne(r);
                    if (id) return id;
                }
                return 0;
            }
            return tryOne(resp);
        }

        async function ensureLabId() {
            // 1) déjà connu ?
            if (LAB_ID > 0) return LAB_ID;

            // 2) essayer ton endpoint existant
            try {
                // on suppose qu'il est sous le même namespace REST
                let resp = await apiGet('/laboratoire/mine');
                let id = extractLabId(resp);
                if (!id) {
                    // 3) fallback vers l'endpoint "mine" donné plus haut
                    resp = await apiGet('/laboratoire/mine');
                    id = extractLabId(resp);
                }
                if (id > 0) {
                    LAB_ID = id;
                    const modalEl = document.getElementById('addMemberModal');
                    if (modalEl) modalEl.dataset.laboratoireId = String(id);
                    console.log('[LAB_ID] Résolu via API =', id);
                    return LAB_ID;
                }
            } catch (err) {
                console.warn('[ensureLabId] échec résolution via API', err);
            }
            return 0;
        }


        /* =======================
         *   RÉF. MODAL
         * ======================= */
        const modalEl = document.getElementById('addMemberModal');
        if (!modalEl) return;
        let LAB_ID = parseInt(modalEl.dataset.laboratoireId || '0', 10) || 0;
        const btnOpen = document.getElementById('addMemberBtn'); // bouton “Ajouter membre” de ta page (si présent)
        const btnSave = document.getElementById('saveMemberBtn');

        const existingWrapper = document.getElementById('existingMemberContent');
        const inviteWrapper = document.getElementById('inviteMemberContent');

        // HTML injecté pour l’onglet “Membre existant”
        const existingMemberHTML = `
    <div class="form-group">

    <div class="filters-row" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
      <div class="form-group">
        <label for="filterEtablissement">Établissement</label>
        <select id="filterEtablissement" style="min-width:240px">
          <option value="">Tous les établissements</option>
        </select>
      </div>

      <div class="form-group">
        <label for="filterRoles">Rôles</label>
        <select id="filterRoles" multiple style="min-width:240px">
          <option value="um_chercheur">Chercheur</option>
          <option value="um_doctorant">Doctorant</option>
          <option value="um_student_master">Étudiant Master</option>
        </select>
        <small>Ctrl/Cmd+clic pour multi‑sélection</small>
      </div>

    <label for="memberSelect">Membre</label>
      <select id="memberSelect">
        <option value="">Sélectionner un membre...</option>
      </select>
    </div>


  `;

        const inviteMemberHTML = `
    <div class="form-row" style="display:flex; gap:12px; flex-wrap:wrap;">
      <div class="form-group" style="flex:1;">
        <label for="inviteEmail">Email</label>
        <input id="inviteEmail" type="email" placeholder="prenom.nom@exemple.tld">
      </div>
      <div class="form-group" style="flex:1;">
        <label for="inviteGrade">Grade</label>
        <input id="inviteGrade" type="text" placeholder="Ex.: Chercheur associé">
      </div>
      <div class="form-group" style="flex:1;">
        <label for="inviteSpecialite">Spécialité</label>
        <input id="inviteSpecialite" type="text" placeholder="Ex.: Bio-informatique">
      </div>
    </div>
    <p class="help-text">Une invitation sera envoyée pour créer un compte et finaliser l’ajout.</p>
  `;

        /* =======================
         *   MONTAGE ONGLET EXISTANT
         * ======================= */
        function mountExistingTab() {
            existingWrapper.innerHTML = existingMemberHTML;

            // Récupérer les refs **après** injection
            const selMember = document.getElementById('memberSelect');
            const selEtab = document.getElementById('filterEtablissement');
            const selRoles = document.getElementById('filterRoles');
            const inputQ = document.getElementById('filterSearch');
            const btnFind = document.getElementById('btnFindMembers');

            function getSelectedRoles() {
                return Array.from(selRoles.selectedOptions || []).map(o => o.value);
            }

            async function loadEtablissements() {
                try {
                    const rows = await apiGet('/etablissements');
                    selEtab.innerHTML = '<option value="">Tous les établissements</option>' +
                        rows.map(r => `<option value="${r.id}">${escapeHtml(r.nom)}</option>`).join('');
                } catch (e) {
                    console.error('etablissements:', e);
                    selEtab.innerHTML = '<option value="">(Erreur de chargement)</option>';
                }
            }

            async function loadMembersIntoSelect() {
                const selMember = document.getElementById('memberSelect');
                const selEtab = document.getElementById('filterEtablissement');
                const selRoles = document.getElementById('filterRoles');
                const inputQ = document.getElementById('filterSearch');

                if (!selMember) {
                    console.warn('#memberSelect introuvable');
                    return;
                }

                selMember.disabled = true;
                selMember.innerHTML = `<option value="">Chargement…</option>`;

                try {
                    // S’assurer d’avoir le LAB_ID si possible (pour exclude)
                    await ensureLabId();

                    const params = {
                        with_etablissement: 1,
                        orderby: 'display_name',
                        order: 'ASC',
                        per_page: 50,
                        search: (inputQ?.value || '').trim() || undefined,
                        etablissement_id: selEtab?.value || undefined
                    };
                    const roles = Array.from(selRoles?.selectedOptions || []).map(o => o.value);
                    if (roles.length) params.roles = roles;

                    if (LAB_ID > 0) params.exclude_lab = LAB_ID;

                    const rows = await apiGet('/users', params);

                    const options = (Array.isArray(rows) ? rows : []).map(r => {
                        const labelParts = [
                            r.display_name || 'Utilisateur',
                            r.user_email ? `<${r.user_email}>` : null,
                            r.etablissement_nom || null
                        ].filter(Boolean);
                        return `<option value="${r.id}">${escapeHtml(labelParts.join(' — '))}</option>`;
                    });

                    selMember.innerHTML =
                        `<option value="">Sélectionner un membre...</option>` +
                        (options.length ? options.join('') :
                            `<option value="" disabled>(Aucun résultat)</option>`);

                } catch (e) {
                    console.error('[loadMembersIntoSelect] Erreur:', e);
                    const msg = (e && e.message) ? e.message : 'Erreur de chargement';
                    selMember.innerHTML = `<option value="" disabled>(${escapeHtml(msg)})</option>`;
                } finally {
                    selMember.disabled = false;
                }
            }


            // Listeners filtres
            const debounced = debounce(loadMembersIntoSelect, 350);
            selEtab && selEtab.addEventListener('change', loadMembersIntoSelect);
            selRoles && selRoles.addEventListener('change', loadMembersIntoSelect);
            inputQ && inputQ.addEventListener('input', debounced);
            btnFind && btnFind.addEventListener('click', loadMembersIntoSelect);

            // Chargement initial
            loadEtablissements().then(loadMembersIntoSelect);
        }

        function mountInviteTab() {
            inviteWrapper.innerHTML = inviteMemberHTML;
        }

        /* =======================
         *   OUVERTURE / TOGGLE MODAL
         * ======================= */
        async function openModal() {
            modalEl.style.display = 'flex';

            // S'assurer d'avoir le LAB_ID d'abord
            const id = await ensureLabId();
            if (!id) {
                // on laisse quand même ouvrir pour sélectionner un membre,
                // mais on n'exclura pas les membres existants et on bloquera le POST
                console.warn('LAB_ID introuvable pour ce directeur (les membres ne seront pas exclus)');
            }

            // Par défaut: onglet "existant"
            document.querySelector('input[name="addMemberType"][value="existing"]').checked = true;
            existingWrapper.style.display = '';
            inviteWrapper.style.display = 'none';

            // Remonter l'onglet après résolution (pour que exclude_lab soit bien pris en compte)
            mountExistingTab();
            inviteWrapper.innerHTML = '';
        }

        btnOpen && btnOpen.addEventListener('click', openModal);

        modalEl.addEventListener('click', (e) => {
            if (e.target === modalEl) modalEl.style.display = 'none';
        });

        document.querySelectorAll('input[name="addMemberType"]').forEach(r => {
            r.addEventListener('change', () => {
                if (!r.checked) return;
                if (r.value === 'existing') {
                    inviteWrapper.style.display = 'none';
                    existingWrapper.style.display = '';
                    mountExistingTab(); // re-monter pour s'assurer que les refs existent
                } else {
                    existingWrapper.style.display = 'none';
                    inviteWrapper.style.display = '';
                    mountInviteTab();
                }
            });
        });

        /* =======================
         *   SAUVEGARDE
         * ======================= */
        async function saveExistingMember() {
            const selMember = document.getElementById('memberSelect');
            const gradeEl = document.getElementById('newMemberGrade');
            const specEl = document.getElementById('newMemberSpecialite');

            const uid = parseInt(selMember?.value || '0', 10);
            if (!uid) {
                alert('Veuillez sélectionner un membre.');
                return;
            }

            const currentLabId = await ensureLabId();
            if (!currentLabId) {
                alert('Identifiant du laboratoire manquant.');
                return;
            }

            const payload = {
                user_id: uid,
                laboratoire_id: currentLabId,
                grade: (gradeEl?.value || '').trim() || 'Membre',
                specialite: (specEl?.value || '').trim() || ''
            };

            try {
                await apiPost('/membre', payload);
                if (typeof window.refreshLaboratoryMembers === 'function') {
                    window.refreshLaboratoryMembers();
                }
                modalEl.style.display = 'none';
            } catch (e) {
                alert('Erreur: ' + (e?.message || 'échec de l’enregistrement'));
                console.error(e);
            }
        }

        async function saveInvite() {
            const email = document.getElementById('inviteEmail')?.value?.trim();
            const grade = document.getElementById('inviteGrade')?.value?.trim();
            const spec = document.getElementById('inviteSpecialite')?.value?.trim();
            if (!email) {
                alert("Email requis pour l'invitation.");
                return;
            }
            // À brancher avec ton plugin d'invitation:
            alert('Invitation envoyée à ' + email + ' (implémentation à brancher).');
            modalEl.style.display = 'none';
        }

        btnSave && btnSave.addEventListener('click', () => {
            const type = (document.querySelector('input[name="addMemberType"]:checked') || {}).value;
            if (type === 'invite') return saveInvite();
            return saveExistingMember();
        });

    });
</script>