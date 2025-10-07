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
        <?php if ($role !== 'um_chercheur') { ?>
        <button class="add-project-btn" id="addMemberBtn">Ajouter membre</button>

        <?php } ?>
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

                <!-- <div class="radio-option" style="margin-top:18px;">
          <label class="radio-option-label">
            <input type="radio" name="addMemberType" value="invite">
            <span>Invitation par email (si membre externe)</span>
          </label>
        </div>-->

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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Custom Filter Functionality ---
    // This function adds a custom filter to DataTables
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
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

    // --- Event Listeners for Filters ---
    // When a dropdown value changes, get the current DataTable instance and redraw it.
    $('#gradeFilter, #projectFilter').on('change', function() {
        $('#candidaturesTable').DataTable().draw();
    });


    // Custom search functionality
    $('.filter-input').on('keyup', function() {
        $('#candidaturesTable').DataTable().search(this.value).draw();
    });

    // "Check All" functionality
    $('#checkAll').on('click', function() {
        const tableInstance = $('#candidaturesTable').DataTable();
        const rows = tableInstance.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
        if (!this.checked) {
            const el = $('#checkAll').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

    // Dropdown menu logic
    $('#candidaturesTable').on('click', '.action-btn', function(e) {
        e.stopPropagation();
        $('.dropdown-menu').not($(this).next()).hide();
        $(this).next('.dropdown-menu').toggle();
    });

    document.addEventListener('click', function() {
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

    if (addMemberBtn) {
        addMemberBtn.addEventListener('click', () => {
            addMemberModal.style.display = 'flex';
            updateFormContent();
        });
    }


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

    $('#candidaturesTable tbody').on('click', '.edit-btn', function(e) {
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
document.addEventListener('DOMContentLoaded', function() {

    /* =======================
     * CONFIG REST
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
     * HELPERS
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
        } catch (e) {}
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
     * RÉF. MODAL
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
     * MONTAGE ONGLET EXISTANT
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

            if (!selMember) return;

            selMember.disabled = true;
            selMember.innerHTML = `<option value="">Chargement…</option>`;

            try {
                await ensureLabId();

                const params = {
                    with_etablissement: 1,
                    orderby: 'display_name',
                    order: 'ASC',
                    per_page: 50,
                    search: (inputQ?.value || '').trim() || undefined,
                    etablissement_id: selEtab?.value || undefined,

                    // ✅ NE GARDER QUE LES UTILISATEURS NON AFFECTÉS À AUCUN LABO
                    only_free: 1
                    // (optionnel) exclude_lab: LAB_ID
                };

                const roles = Array.from(selRoles?.selectedOptions || []).map(o => o.value);
                if (roles.length) params.roles = roles;

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
     * OUVERTURE / TOGGLE MODAL
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

    if (btnOpen) {
        btnOpen.addEventListener('click', openModal);
    }

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
     * SAUVEGARDE
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

            // Rafraîchir table + stats + charts
            if (typeof window.refreshAll === 'function') {
                window.refreshAll();
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

// table :


document.addEventListener('DOMContentLoaded', async function() {

    /* =======================
     * CONFIG REST
     * ======================= */
    const API_ROOT = (window.PMSettings && PMSettings.restUrl) || '/wp-json';
    const API_NS = 'plateforme-recherche/v1';
    const API_BASE = `${API_ROOT.replace(/\/$/, '')}/${API_NS}`;
    const NONCE = window.PMSettings?.nonce || '';

    const BASE_HEADERS = {
        'X-WP-Nonce': NONCE,
        'Accept': 'application/json'
    };
    const FETCH_BASE = {
        credentials: 'same-origin',
        headers: BASE_HEADERS
    };
    const role = window.PMSettings?.role || '';

    /* =======================
     * HELPERS
     * ======================= */
    function serializeQuery(params) {
        const q = [];
        Object.entries(params || {}).forEach(([k, v]) => {
            if (v === undefined || v === null || v === '') return;
            if (Array.isArray(v)) v.forEach(val => q.push(`${k}[]=${encodeURIComponent(val)}`));
            else q.push(`${k}=${encodeURIComponent(v)}`);
        });
        return q.length ? '?' + q.join('&') : '';
    }

    async function apiGet(path, params = {}) {
        const res = await fetch(API_BASE + path + serializeQuery(params), FETCH_BASE);
        if (!res.ok) {
            let j = null;
            try {
                j = await res.json();
            } catch (e) {}
            throw new Error(j?.message || res.statusText || 'Erreur API');
        }
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
        if (!res.ok) {
            let j = null;
            try {
                j = await res.json();
            } catch (e) {}
            throw new Error(j?.message || res.statusText || 'Erreur API');
        }
        return res.json();
    }

    function escapeHtml(s) {
        return (s ?? '').toString()
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    function formatFRDate(dt) {
        if (!dt) return '';
        const iso = dt.replace(' ', 'T');
        const d = new Date(iso);
        return isNaN(d) ? dt : d.toLocaleDateString('fr-FR');
    }

    /* =======================
     * GLOBAL LAB ID
     * ======================= */
    window.LAB_ID = 0;

    function extractLabId(resp) {
        if (!resp) return 0;
        if (Array.isArray(resp) && resp.length && (resp[0].id || resp[0].laboratoire_id)) {
            return parseInt(resp[0].id || resp[0].laboratoire_id, 10);
        }
        if (resp.id) return parseInt(resp.id, 10);
        if (resp.laboratoire_id) return parseInt(resp.laboratoire_id, 10);
        return 0;
    }

    window.ensureLabId = async function() {
        if (window.LAB_ID > 0) return window.LAB_ID;
        try {
            let resp = await apiGet('/laboratoire/mine');
            let id = extractLabId(resp);
            if (!id) {
                resp = await apiGet('/laboratoire/mine');
                id = extractLabId(resp);
            }
            if (id > 0) {
                window.LAB_ID = id;
                document.getElementById('addMemberModal')?.setAttribute('data-laboratoire-id', id);
                console.log('[LAB_ID] résolu via API =', id);
                return id;
            }
        } catch (e) {
            console.warn('ensureLabId erreur', e);
        }
        return 0;
    }

    /* =======================
     * TABLE
     * ======================= */
    async function loadMembersTable(labId) {
        const tbody = document.querySelector('#candidaturesTable tbody');
        tbody.innerHTML = `<tr><td colspan="6">Chargement…</td></tr>`;

        if (!labId) labId = await window.ensureLabId();
        if (!labId) {
            tbody.innerHTML = `<tr><td colspan="7">Identifiant du labo introuvable.</td></tr>`;
            return;
        }

        try {
            const result = await apiGet('/membre', {
                laboratoire_id: labId,
                with_user: 1,
                with_projects: 1,
                with_etablissement: 1,
                orderby: 'last_activity',
                order: 'DESC',
                per_page: 200
            });

            const rows = result.data || [];

            // Détruire DataTable si déjà initialisé
            if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
                $('#candidaturesTable').DataTable().clear().destroy();
            }

            // Insérer lignes
            const tbodyHtml = rows.map(m => {
                const avatar = m.avatar_url && m.avatar_url.trim() !== '' ?
                    m.avatar_url :
                    '/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg';

                let actionsHtml =
                    `<a href="/membre-de-labo-fiche-membres/?id=${m.id}">Détail</a>`;
                if (role !== 'um_chercheur') {
                    actionsHtml = `
        <!--<a href="#" class="edit-btn" data-membre-id="${m.id}">Modifier</a>-->
        <a href="#" class="delete-btn" data-membre-id="${m.id}">Retirer</a>
        <a href="/membre-de-labo-fiche-membres/?id=${m.id}">Détail</a>`;
                }

                return `
      <tr>
        <td><input type="checkbox" class="row-checkbox" data-id="${m.id}"></td>
        <td class="left">
          <img src="${avatar}" class="coord-avatar">
          <span class="coord-placeholder">${escapeHtml(m.user_display_name || 'Utilisateur')}</span>
        </td>
        <td>${escapeHtml(m.grade || '—')}</td>
        <td>${escapeHtml(m.specialite || '—')}</td>
        <td>${escapeHtml(m.projets_lies || '—')}</td>
        <td>${formatFRDate(m.last_activity || m.updated_at || m.created_at || '') || '—'}</td>
        <td>
          <div class="actions">
            <button class="action-btn">...</button>
            <div class="dropdown-menu">${actionsHtml}</div>
          </div>
        </td>
      </tr>`;
            }).join('');

            if (tbodyHtml && tbodyHtml.trim() !== '') {
                tbody.innerHTML = tbodyHtml;
            } else {
                tbody.innerHTML = ''; // Laisse DataTables gérer le message vide
            }

            // Vérif après injection
            $('#candidaturesTable tbody tr').each(function() {
                if ($(this).find('td').length !== 7) {
                    console.warn('Row invalide:', this.innerHTML);
                }
            });

            // Réinitialiser DataTable
            $('#candidaturesTable').DataTable({
                paging: true,
                searching: true, // This was set to false, but needs to be true for our filter to work. The box is hidden via CSS/JS anyway.
                lengthChange: false,
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
                    emptyTable: "Aucun membre",
                    zeroRecords: "Aucun enregistrement trouvé"
                },
                initComplete: function() {
                    $('.dataTables_filter').hide();
                }
            });

        } catch (e) {
            console.error('[loadMembersTable] Erreur:', e);
            tbody.innerHTML = `<tr><td colspan="7">Erreur: ${escapeHtml(e.message || 'API')}</td></tr>`;
        }
    }

    // ⚡ expose en global
    window.loadMembersTable = loadMembersTable;

});
</script>

<script>
class VueGlobaleDashboard {
    constructor() {
        this.donutChart = null;
        this.barChart = null;
        this.currentYear = '2025-2026';
        this.data = {};
        this.init();
    }

    async init() {
        this.setupEventListeners();

        const labId = await window.ensureLabId();
        if (labId) {
            await this.loadDataFromApi(labId);
        }

        this.createCharts();
    }

    setupEventListeners() {
        const yearSelector = document.getElementById('yearSelector');
        if (yearSelector) {
            yearSelector.addEventListener('change', (e) => {
                this.currentYear = e.target.value;
                this.updateData();
            });
        }
    }

    // 🔹 Charger les données dynamiques depuis l’API
    async loadDataFromApi(labId) {
        try {
            const res = await fetch(
                `${window.PMSettings.restUrl}plateforme-recherche/v1/membre?laboratoire_id=${labId}&with_user=1&per_page=200`, {
                    headers: {
                        "X-WP-Nonce": window.PMSettings.nonce
                    }
                }
            );
            if (!res.ok) throw new Error("Erreur API");
            const result = await res.json();

            const repartition = result.repartition_specialite || [];

            const labels = repartition.map(r => r.specialite || 'Non défini');
            const values = repartition.map(r => parseInt(r.total, 10));

            const total = values.reduce((a, b) => a + b, 0);
            const percents = values.map(v => total > 0 ? Math.round((v / total) * 100) : 0);

            this.data[this.currentYear] = {
                donutData: {
                    labels,
                    values
                },
                barData: {
                    labels,
                    values: percents,
                    colors: ['#A6A485', '#DDACA7', '#FFD54F', '#A6C7FF', '#BF0404']
                },
                stats: {
                    inscription: total,
                    soutenance: 0,
                    habilitation: 0
                }
            };

            this.createDonutChart();
            this.createBarChart();

        } catch (e) {
            console.error("Erreur chargement répartition spécialité:", e);
        }
    }

    createCharts() {
        this.createDonutChart();
        this.createBarChart();
    }

    createDonutChart() {
        const ctx = document.getElementById('donutChart');
        if (!ctx) return;

        const currentData = this.data[this.currentYear];
        if (!currentData || !currentData.donutData) return;

        const labels = currentData.donutData.labels;
        const rawValues = currentData.donutData.values;

        const totalInscriptions = rawValues.reduce((a, b) => a + b, 0);

        const colors = ['#B00000', '#7CC7C9', '#FFD54F', '#E4B6B6'];

        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart) {
                const {
                    ctx,
                    chartArea
                } = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;

                ctx.save();
                ctx.font = 'bold 24px Roboto, sans-serif';
                ctx.fillStyle = '#2A2916';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(totalInscriptions.toString(), centerX, centerY - 10);

                ctx.font = '14px Roboto, sans-serif';
                ctx.fillStyle = '#2A2916';
                ctx.fillText('inscriptions', centerX, centerY + 14);
                ctx.restore();
            }
        };

        if (this.donutChart) {
            this.donutChart.destroy();
        }

        const baseRadius = 90;
        const thickness = 5;

        const datasets = rawValues.map((val, index) => {
            const radius = baseRadius - index * (thickness + 2);
            const cutout = radius - thickness;
            return {
                label: labels[index],
                data: [val, totalInscriptions - val],
                backgroundColor: [colors[index % colors.length], 'transparent'],
                radius: `${radius}%`,
                cutout: `${cutout}%`
            };
        });

        this.donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const val = context.raw;
                                const percent = ((val / totalInscriptions) * 100).toFixed(1);
                                return `${context.dataset.label} : ${val} (${percent}%)`;
                            }
                        }
                    }
                }
            },
            plugins: [centerTextPlugin]
        });

        this.createDonutLegend(colors, labels);
    }

    createDonutLegend(colors, labels) {
        const legendContainer = document.getElementById('donutLegend');
        if (!legendContainer) return;

        legendContainer.innerHTML = '';
        labels.forEach((label, index) => {
            const item = document.createElement('div');
            item.className = 'legend-item';
            item.innerHTML =
                `<span class="legend-dot" style="background:${colors[index % colors.length]}"></span> ${label}`;
            legendContainer.appendChild(item);
        });
    }

    createBarChart() {
        const ctx = document.getElementById('barChart');
        if (!ctx) return;

        const currentData = this.data[this.currentYear];
        if (!currentData || !currentData.barData) return;

        if (this.barChart) {
            this.barChart.destroy();
        }

        this.barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: currentData.barData.labels,
                datasets: [{
                    data: currentData.barData.values,
                    backgroundColor: currentData.barData.colors,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: (value) => value + '%'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.label}: ${context.parsed.x}%`
                        }
                    }
                }
            },
            plugins: [{
                id: 'customDataLabels',
                afterDatasetsDraw(chart) {
                    const {
                        ctx,
                        data
                    } = chart;
                    chart.getDatasetMeta(0).data.forEach((bar, index) => {
                        const value = data.datasets[0].data[index];
                        ctx.save();
                        ctx.fillStyle = '#2c3e50';
                        ctx.font = 'bold 11px sans-serif';
                        ctx.textAlign = 'left';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(value + '%', bar.x + 8, bar.y);
                        ctx.restore();
                    });
                }
            }]
        });
    }

    updateData() {
        const currentData = this.data[this.currentYear];
        if (!currentData) return;

        this.updateStatCards(currentData.stats);
        this.createDonutChart();
        this.createBarChart();
    }

    updateStatCards(stats) {
        const statElements = {
            'inscription-value': stats.inscription,
            'soutenance-value': stats.soutenance,
            'habilitation-value': stats.habilitation
        };

        Object.entries(statElements).forEach(([id, value]) => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = '<span class="loading"></span>';
                setTimeout(() => {
                    element.textContent = value;
                }, 500);
            }
        });
    }
}




// fonction global

window.refreshAll = async function() {
    const labId = await window.ensureLabId();
    if (!labId) return;



    // Rafraîchir la table
    if (typeof window.loadMembersTable === 'function') {
        window.loadMembersTable(labId);
    }

    // Rafraîchir les stats
    try {
        const res = await fetch(
            `${window.PMSettings.restUrl}plateforme-recherche/v1/membre?laboratoire_id=${labId}&with_user=1&with_projects=0&per_page=200`, {
                headers: {
                    "X-WP-Nonce": window.PMSettings.nonce
                }
            }
        );
        if (res.ok) {
            const result = await res.json();
            const rows = result.data || [];
            const total = rows.length;
            const actifs = rows.filter(m => m.account_status === "approved").length;

            const boxes = document.querySelectorAll(".left-stats .stat-box");
            if (boxes.length >= 2) {
                boxes[0].querySelector(".value").textContent = total;
                boxes[1].querySelector(".value").textContent = actifs;
            }

            // Rafraîchir les charts
            if (window.vueGlobaleDashboard instanceof VueGlobaleDashboard) {
                await window.vueGlobaleDashboard.loadDataFromApi(labId);
            }
        }
    } catch (e) {
        console.error("Erreur refresh stats :", e);
    }
};


document.addEventListener('DOMContentLoaded', async () => {
    window.vueGlobaleDashboard = new VueGlobaleDashboard();
    await window.refreshAll(); // charge table + stats + charts dès le départ
});

// Suppression d’un membre
$(document).on('click', '.delete-btn', async function(e) {
    e.preventDefault();
    const membreId = $(this).data('membre-id');

    if (!membreId) return;
    if (!confirm("Voulez-vous vraiment retirer ce membre du laboratoire ?")) return;

    try {
        const res = await fetch(
            `${window.PMSettings.restUrl}plateforme-recherche/v1/membre/${membreId}`, {
                method: 'DELETE',
                headers: {
                    'X-WP-Nonce': window.PMSettings.nonce,
                    'Accept': 'application/json'
                }
            }
        );

        if (!res.ok) {
            let j = null;
            try {
                j = await res.json();
            } catch (e) {}
            throw new Error(j?.message || res.statusText || "Échec suppression");
        }

        // ✅ Rafraîchir table + stats + charts
        if (typeof window.refreshAll === 'function') {
            await window.refreshAll();
        }

        alert("Membre retiré avec succès !");
    } catch (err) {
        console.error("Erreur suppression membre:", err);
        alert("Erreur: " + (err.message || "Impossible de supprimer"));
    }
});
</script>

<!-- ===================== LOGIQUE ===================== -->
 
<script>
(function(){
  'use strict';

  const WRAPPER   = document.getElementById('bloc-stats-grade');
  const API_BASE  = '/wp-json/plateforme-recherche/v1/membre';

  // Elements
  const elTotal   = document.getElementById('total-membres');
  const elActifs  = document.getElementById('membres-actifs');
  const elLoading = document.getElementById('grade-loading');
  const elEmpty   = document.getElementById('grade-empty');
  const elError   = document.getElementById('grade-error');
  const canvas    = document.getElementById('barChartGrade');

  // Palette couleurs
  const palette = ['#A6A485','#DDACA7','#FFD54F','#A6C7FF',
                   '#BF0404','#7CC7C9','#E4B6B6','#808066',
                   '#b1342f','#dabebe'];

  function showState({loading=false, empty=false, error=false}){
    if (elLoading) elLoading.style.display = loading ? 'flex' : 'none';
    if (elEmpty)   elEmpty.style.display   = empty   ? 'flex' : 'none';
    if (elError)   elError.style.display   = error   ? 'flex' : 'none';
  }

  function destroyChartIfAny(canvasEl){
    const inst = (Chart.getChart && Chart.getChart(canvasEl)) || null;
    if (inst) inst.destroy();
  }

  function normalizeGradeData(json){
    if (Array.isArray(json?.repartition_grade)) {
      return json.repartition_grade.map(x => ({
        grade: (x.grade ?? 'Non renseigné').trim(),
        total: Number(x.total) || 0
      }));
    }
    if (Array.isArray(json?.data)) {
      const map = new Map();
      for (const m of json.data) {
        const g = (m.grade || 'Non renseigné').trim();
        map.set(g, (map.get(g) || 0) + 1);
      }
      return [...map].map(([grade,total]) => ({ grade, total }));
    }
    return [];
  }

  function renderBarChartFromGrade(repartitionRaw){
    destroyChartIfAny(canvas);

    const rows = (repartitionRaw || [])
      .map(r => ({ grade: r.grade ?? 'Non renseigné', total: Number(r.total) || 0 }))
      .filter(r => r.total > 0)
      .sort((a,b) => b.total - a.total);

    showState({ loading:false, empty: rows.length === 0, error:false });
    if (rows.length === 0) return;

    const labels = rows.map(r => r.grade);
    const values = rows.map(r => r.total);
    const colors = labels.map((_, i) => palette[i % palette.length]);

    new Chart(canvas, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          data: values,
          backgroundColor: colors,
          borderRadius: 6,
          borderSkipped: false
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(0,0,0,0.05)' } },
          y: { grid: { display: false } }
        },
        plugins: {
          legend: { display: false },
          tooltip: { callbacks: { label: (ctx) => `${ctx.label}: ${ctx.parsed.x}` } }
        }
      },
      plugins: [{
        id: 'barDataLabels',
        afterDatasetsDraw(chart) {
          const { ctx, data } = chart;
          chart.getDatasetMeta(0).data.forEach((bar, i) => {
            const v = data.datasets[0].data[i];
            ctx.save();
            ctx.fillStyle = '#2c3e50';
            ctx.font = 'bold 11px sans-serif';
            ctx.textAlign = 'left';
            ctx.textBaseline = 'middle';
            ctx.fillText(v, bar.x + 8, bar.y);
            ctx.restore();
          });
        }
      }]
    });
  }

  async function loadGradeChart(){
    try {
      showState({loading:true, empty:false, error:false});

      // ⚡ Attendre le vrai LAB_ID via ensureLabId()
      const LAB_ID = await (window.ensureLabId ? window.ensureLabId() : 0);
      if (!LAB_ID) throw new Error("LAB_ID introuvable");

      const url = new URL(API_BASE, window.location.origin);
      url.searchParams.set('laboratoire_id', String(LAB_ID));
      url.searchParams.set('with_user', '1');
      url.searchParams.set('per_page', '200');

      const res  = await fetch(url.toString(), { credentials: 'same-origin' });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const json = await res.json();

      // Stats
      const total   = Array.isArray(json?.data) ? json.data.length : 0;
      const actifs  = Array.isArray(json?.data) 
                        ? json.data.filter(m => m.account_status === 'approved').length 
                        : 0;

      if (elTotal)  elTotal.textContent  = total;
      if (elActifs) elActifs.textContent = actifs;

      // Graphe
      const rep = normalizeGradeData(json);
      renderBarChartFromGrade(rep);

    } catch (err) {
      console.error('Erreur chargement répartition grade:', err);
      showState({loading:false, empty:false, error:true});
      destroyChartIfAny(canvas);
    }
  }

  // Expose global
  window.loadGradeChart = loadGradeChart;

  // Bouton rapport
  document.querySelector('.btn-report')?.addEventListener('click', function(){
    const btn = this;
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="loading" style="display:inline-block;width:16px;height:16px;border:2px solid rgba(0,0,0,.2);border-top-color:#c60000;border-radius:50%;animation:spin 1s linear infinite;margin-right:6px;"></span> Génération...';
    setTimeout(()=>{ alert('Rapport généré avec succès !'); btn.innerHTML = original; btn.disabled = false; }, 1500);
  });

  // Init au chargement DOM
  document.addEventListener('DOMContentLoaded', () => {
    showState({loading:true});
    loadGradeChart();
  });

})();
</script>

