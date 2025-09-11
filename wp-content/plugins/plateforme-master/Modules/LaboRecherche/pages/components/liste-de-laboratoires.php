<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- User-provided styles combined into one block -->
<style>
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

    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
    }

    .filter-input,
    .filter-select {
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        background-color: #fff;
    }

    .filter-input {
        width: 220px;
    }

    .filter-select {
        min-width: 180px;
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

    .icon-btn {
        width: 40px;
        height: 40px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c60000;
        font-size: 16px;
    }

    .icon-btn:hover {
        background-color: #f9f9f9;
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

    .add-master-btn {
        background-color: #c60000;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .add-master-btn:hover {
        background-color: #a50000;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 16px 0;
    }

    .filter-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        position: relative;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 220px;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 8-0px;
        background: #f9f9f9;
    }

    .search-btn,
    .icon-btn {
        padding: 8px 12px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        cursor: pointer;
    }

    .masters-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        box-shadow: 0 0 0 1px #ddd;
    }

    .masters-table thead tr {
        background-color: #f3f1e9;
    }

    .masters-table th,
    .masters-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .masters-table tbody tr:last-child td {
        border-bottom: none;
    }

    .pdf-icon {
        width: 24px;
    }

    .coord-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
    }

    .coord-placeholder {
        font-size: 20px;
        color: #666;
    }

    .action-menu {
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
    }

    .custom-colvis-btn {
        background-color: #c60000;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 42px;
        right: 0;
        min-width: 160px;
        background-color: #ffffff;
        border: 1px solid #d8d4b7;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
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

    .dropdown-menu i {
        font-size: 15px;
        color: #2d2a12;
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 16px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 8px 12px;
        border-radius: 8px;
        border: 2px solid #c60000;
        background-color: #fff;
        color: #c60000;
        font-weight: 600;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #c60000;
        color: white !important;
        font-weight: 700;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #c60000;
        color: #fff !important;
        font-weight: 700;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        border: none;
    }


    button.dt-button.buttons-collection.buttons-colvis.custom-colvis-btn {
        position: relative;
        top: -44px;
    }

    .filter-selectgb {
        width: max-content;
        margin-bottom: 0px;
    }

    .btn-close-x {
        background: transparent;
        border: none;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        padding: 4px 10px;
        line-height: 1;
        transition: color 0.2s ease;
        margin-left: auto;
    }

    .btn-close-x:hover {
        color: #c40000;
    }

    .modal-overlay {
        position: fixed;
        top: 0px;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: flex-end;
        z-index: 999999;
    }

    .popup-container {
        background-color: white;
        width: 400px;
        height: 100%;
        padding: 20px 0px;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        padding-top: 0px;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        margin-bottom: 20px;
        padding-left: 25px;
        padding-right: 25px;
        box-shadow: 0px 5px 16px #00000029;
        padding-top: 20px;
    }

    form.popup-form {
        padding-left: 25px;
        padding-right: 25px;
    }

    .popup-header h2,
    .popup-form h2 {
        font-size: 16px;
        margin: 0;
        color: #2A2916;
    }

    .btn-enregistrer {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    /* Styles for the new form inside the modal */
    .popup-form .form-group {
        margin-bottom: 15px;
    }

    .popup-form .form-group label {
        display: flex;
        font-weight: 600;
        color: #333;
        /* margin-bottom: 5px; */
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
        /* To include padding and border in the element's total width and height */
    }

    .popup-form .form-group input[type="radio"] {
        width: 10%;
    }


    /* .popup-form .form-group input[type="file"] {
border: none;
} */
    .popup-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    /* Re-using input-with-icon for the new form */
    .popup-form .input-with-icon {
        position: relative;
    }

    .popup-form .input-with-icon .icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .popup-form .input-with-icon .right-icon {
        right: 12px;
    }

    .popup-form .input-with-icon select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding-right: 30px;
        /* Make space for the icon */
        background-color: #fff;
    }

    /* Specific styles for file input */
    .popup-form .input-file-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #b5af8e;
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
    }

    .popup-form .input-file-text:focus {
        outline: none;
    }

    .popup-form .btn-importer {
        background-color: #A6A485;
        color: #fff;
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

    .popup-form .btn-importer i {
        font-size: 14px;
    }

    .ql-toolbar.ql-snow {
        border-radius: 6px 6px 0 0;
        background-color: #ecebe3;
    }

    .ql-container.ql-snow {
        border-radius: 0 0 6px 6px;
        font-size: 14px;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid #DBD9C3;
        box-sizing: border-box;
        font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
        padding: 8px;
    }

    .ql-editor.ql-blank {
        border: 1px solid #DBD9C3;
    }

    .dataTables_wrapper .dataTables_filter {
        display: none;
    }

    /* Styles for the new "Modifier le directeur" modal content */
    .director-option {
        display: flex;
        align-items: center;
        padding: 10px;
        /* border: 1px solid #ddd; */
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .director-option input[type="radio"] {
        margin-right: 15px;
    }

    .director-option img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .director-info {
        display: flex;
        flex-direction: column;
    }

    .director-info .name {
        font-weight: bold;
    }

    .director-info .title {
        color: #666;
        font-size: 0.9em;
    }

    .action-btn {
        border: none;
        background-color: #ffffff00;
        font-size: 20px;
        font-weight: bolder;
        letter-spacing: 2px;
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
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
        background: #c60000 !important;
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
        background-color: #EBE9D7;
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

    .assign-director-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
    }

    .assign-director-btn {
        background-color: #e0e0e0;
        color: #555;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .actions {
        position: relative;
    }
</style>


<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Icon"          
                style="width: 38px; margin-right: 8px; vertical-align: middle; font-weight: blod;">
            Liste des laboratoires
        </h2>
        <!-- This button will open the modal -->
        <button class="add-project-btn">Ajouter un laboratoire</button>
    </div>



    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" type="text" placeholder="Recherchez..." id="searchInput">
                <i class="fas fa-search icon right-icon search-field"></i>
            </div>

            <!-- Type Select -->
            <div class="input-with-icon">
                <select id="directeurFilter" class="filter-select">
                    <option value="" selected>Directeur</option>
                    <option>Mourad Ben Amor</option>
                    <option>Houssem Lahmar</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>

            <!-- Statut Select -->
            <div class="input-with-icon">
                <select id="domaineFilter" class="filter-select">
                    <option value="" selected>Domaine</option>
                    <option>Informatique</option>
                    <option>Chimie</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
            <!-- etablissement Select -->
            <div class="input-with-icon">
                <select id="etablissementFilter" class="filter-select">
                    <option value="" selected>etablissement</option>
                    <option>test</option>
                    <option>autre</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
        </div>

        <div class="filter-actions">
            <!-- Updated Icons -->
            <button class="icon-btn" title="Download">
                <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png" alt="upload-red.png">
            </button>
        </div>
    </div>


    <table id="candidaturesTable" class="styled-table display">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Intitulé</th>
                <th>Domaine</th>
                <th>Etablissement</th>
                <th>Date de création</th>
                <th>Directeur du labo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
           <!-- <tr data-has-director="false">
                <td><input type="checkbox"></td>
                <td>Labo 1</td>
                <td>Informatique</td>
                <td>test</td>
                <td>12/01/2025</td>
                <td>
                    <div class="assign-director-container">
                        <button class="assign-director-btn">+</button>
                    </div>
                </td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="/fiche-de-details-de-laboratoire">Modifier</a>
                        </div>
                    </div>
                </td>
            </tr>

            <tr data-has-director="true">
                <td><input type="checkbox"></td>
                <td>Labo 2</td>
                <td>Chimie</td>
                <td>autre</td>
                <td>12/01/2025</td>
                <td>
                    <div class="assign-director-container">
                        <img width="40px"
                            src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                            alt="Avatar" style="border-radius: 50%;">
                    </div>
                </td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="/fiche-de-details-de-laboratoire">Modifier</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr data-has-director="false">
                <td><input type="checkbox"></td>
                <td>Labo 3</td>
                <td>Informatique</td>
                <td>test</td>
                <td>12/01/2025</td>
                <td>
                    <div class="assign-director-container">
                        <button class="assign-director-btn">+</button>
                    </div>
                </td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="/fiche-de-details-de-laboratoire">Modifier</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr data-has-director="true">
                <td><input type="checkbox"></td>
                <td>Labo 4</td>
                <td>Informatique</td>
                <td>test</td>
                <td>12/01/2025</td>
                <td>
                    <div class="assign-director-container">
                        <img width="40px"
                            src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                            alt="Avatar" style="border-radius: 50%;">
                    </div>
                </td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="/fiche-de-details-de-laboratoire">Modifier</a>
                        </div>
                    </div>
                </td>
            </tr>-->
        </tbody>
    </table>
</div>

<!-- Modal for adding a new laboratory -->
<div class="modal-overlay" id="modalObjectifs" style="display: none;">
    <div class="popup-container" id="popupContainerObjectifs">
        <div class="popup-header">
            <h2>Ajouter un laboratoire</h2>
            <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label for="etablissementLabo">Etablissement</label>
                <div class="input-with-icon">
                    <select id="etablissementLabo">
                        <option value="">Etablissement</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="nomLabo">Nom Du Laboratoire</label>
                <input type="text" id="nomLabo" placeholder="">
            </div>

              <div class="form-group">
                <label for="Domaine">Domaine</label>
                <input type="text" id="Domaine" placeholder="">
            </div>

            <div class="form-group">
                <label for="directeurLabo">Directeur Du Labo</label>
                <div class="input-with-icon">
                    <select id="directeurLabo">
                        <option value="">Sélectionnez...</option>
                        <option value="Mr. Salah Ben Hsin">Mr. Salah Ben Hsin</option>
                        <option value="Mr. Mourad Hammami">Mr. Mourad Hammami</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for assigning a director -->
<div class="modal-overlay" id="modalAffecter" style="display: none;">
    <div class="popup-container" id="popupContainerAffecter">
        <div class="popup-header">
            <h2>Affecter un directeur</h2>
            <button class="btn-enregistrer" id="btnSaveAffecter">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <div class="director-option" data-name="Mr. Salah Ben Hsin" data-initials="PS"
                    onclick="$('#affecterDirector1').prop('checked', true);">
                    <input type="radio" name="directorAffect" value="Mr. Salah Ben Hsin" id="affecterDirector1">
                    <img width="30px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                        alt="Profile Picture">
                    <div class="director-info">
                        <span class="name">Mr. Salah Ben Hsin</span>
                        <span class="title">Maître Assistant, ENIT</span>
                    </div>
                </div>
                <div class="director-option" data-name="Mr. Mourad Hammami" data-initials="PM"
                    onclick="$('#affecterDirector2').prop('checked', true);">
                    <input type="radio" name="directorAffect" value="Mr. Mourad Hammami" id="affecterDirector2">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                        alt="Profile Picture">
                    <div class="director-info">
                        <span class="name">Mr. Mourad Hammami</span>
                        <span class="title">Professeur, ENIT</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for modifying an existing director -->
<div class="modal-overlay" id="modalModifier" style="display: none;">
    <div class="popup-container" id="popupContainerModifier">
        <div class="popup-header">
            <h2>Modifier le directeur</h2>
            <button class="btn-enregistrer" id="btnSaveModifier">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <div class="director-option" data-name="Mr. Salah Ben Hsin" data-initials="PS"
                    onclick="$('#modifierDirector1').prop('checked', true);">
                    <input type="radio" name="directorModifier" value="Mr. Salah Ben Hsin" id="modifierDirector1">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                        alt="Profile Picture">
                    <div class="director-info">
                        <span class="name">Mr. Salah Ben Hsin</span>
                        <span class="title">Maître Assistant, ENIT</span>
                    </div>
                </div>
                <div class="director-option" data-name="Mr. Mourad Hammami" data-initials="PM"
                    onclick="$('#modifierDirector2').prop('checked', true);">
                    <input type="radio" name="directorModifier" value="Mr. Mourad Hammami" id="modifierDirector2">
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                        alt="Profile Picture">
                    <div class="director-info">
                        <span class="name">Mr. Mourad Hammami</span>
                        <span class="title">Professeur, ENIT</span>
                    </div>
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

<!-- Updated and combined scripts -->
<script>

    /*
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable
       

        // --- Action Buttons (Dropdown Menu) ---
        // Use event delegation on the table body for dynamically added rows
      

        // --- Filter Functionality ---
        const directeurFilterSelect = document.getElementById('directeurFilter');
        const domaineFilterSelect = document.getElementById('domaineFilter');
        const etablissementFilterSelect = document.getElementById('etablissementFilter'); // Added this line
        const searchInput = document.getElementById('searchInput');

        function applyFilters() {
            const directeurValue = directeurFilterSelect.value;
            const domaineValue = domaineFilterSelect.value;
            const etablissementValue = etablissementFilterSelect.value; // Added this line
            const searchTerm = searchInput.value;

            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    const intitule = data[1] || '';
                    const domaine = data[2] || '';
                    const etablissement = data[3] || ''; // Added this line
                    const directeur = data[4] || '';

                    // Strip HTML from director for accurate matching
                    const directeurText = $('<div>').html(directeur).text().trim();

                    const intituleMatch = intitule.toLowerCase().includes(searchTerm.toLowerCase());
                    const directeurMatch = directeurValue === "" || directeurText.includes(directeurValue);
                    const domaineMatch = domaineValue === "" || domaine.trim() === domaineValue;
                    const etablissementMatch = etablissementValue === "" || etablissement.trim() ===
                        etablissementValue; // Added this line

                    // Updated return statement to include the new filter
                    return intituleMatch && directeurMatch && domaineMatch && etablissementMatch;
                }
            );

            // Apply filters and draw the table
            table.draw();

            // Remove the custom filter function after drawing so it doesn't interfere with other searches
            $.fn.dataTable.ext.search.pop();
        }

        // Event listeners for the filter elements
        directeurFilterSelect.addEventListener('change', applyFilters);
        domaineFilterSelect.addEventListener('change', applyFilters);
        etablissementFilterSelect.addEventListener('change', applyFilters); // Added this line
        searchInput.addEventListener('keyup', applyFilters);


        // --- Check All Checkbox Functionality ---
        $('#checkAll').on('change', function () {
            const isChecked = this.checked;
            $('#candidaturesTable tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        // Uncheck "Check All" if any individual checkbox is unchecked
        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function () {
            if (!this.checked) {
                $('#checkAll').prop('checked', false);
            }
        });

        // --- ADD MODAL Logic ---
        const modalObjectifs = document.getElementById("modalObjectifs");
        const popupObjectifs = document.getElementById("popupContainerObjectifs");

        function openmodalObjectifs() {
            if (modalObjectifs) modalObjectifs.style.display = "flex";
        }

        function closeModalObjectifs() {
            if (modalObjectifs) modalObjectifs.style.display = "none";
        }

        $('.add-project-btn').on('click', openmodalObjectifs);

        $('#btnSaveObjectifs').on('click', function (event) {
            event.preventDefault();
            // Simple validation
            if (!$('#etablissementLabo').val() || !$('#nomLabo').val() || !$('#directeurLabo').val()) {
                Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires.', 'error');
                return;
            }

            const newRowData = [
                '<input type="checkbox">',
                $('#nomLabo').val(),
                'Informatique',
                (new Date()).toLocaleDateString('fr-FR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                }).split('/').join('/'),
                `<div class="assign-director-container">
                 <img src="https://placehold.co/40x40/c80000/ffffff?text=AV" alt="Avatar" style="border-radius: 50%;">
             </div>`,
                `<div class="actions">
                <button class="action-btn">...</button>
                <div class="dropdown-menu">
                    <a href="/fiche-de-details-de-laboratoire">Modifier</a>
                </div>
            </div>`
            ];

            const newRow = table.row.add(newRowData).draw().node();
            $(newRow).attr('data-has-director', 'true');

            closeModalObjectifs();
            $('form.popup-form')[0].reset(); // Reset the form
        });

        // Close modal if clicking outside the popup
        if (modalObjectifs && popupObjectifs) {
            modalObjectifs.addEventListener("click", function (e) {
                if (!popupObjectifs.contains(e.target)) {
                    closeModalObjectifs();
                }
            });
        }

        // --- AFFECTER MODAL Logic ---
        const modalAffecter = document.getElementById("modalAffecter");
        const popupAffecter = document.getElementById("popupContainerAffecter");
        let currentRowAffecter = null;

        function openAffecterModal(row) {
            currentRowAffecter = row;
            $('input[name="directorAffect"]').prop('checked', false);
            modalAffecter.style.display = "flex";
        }

        function closeModalAffecter() {
            modalAffecter.style.display = "none";
            currentRowAffecter = null;
        }

        $('#btnSaveAffecter').on('click', function (event) {
            event.preventDefault();
            if (currentRowAffecter) {
                const selectedDirector = $('input[name="directorAffect"]:checked').val();
                let newDirectorHtml = `<button class="assign-director-btn">+</button>`;
                let hasDirector = false;

                if (selectedDirector) {
                    const directorInitials = $(`div.director-option[data-name="${selectedDirector}"]`).data(
                        'initials');
                    newDirectorHtml = `
                    <div class="assign-director-container">
                        <img src="https://placehold.co/40x40/c80000/ffffff?text=${directorInitials}" alt="Avatar" style="border-radius: 50%;">
                    </div>`;
                    hasDirector = true;
                }

                const updatedData = [
                    table.cell(currentRowAffecter, 0).data(),
                    table.cell(currentRowAffecter, 1).data(),
                    table.cell(currentRowAffecter, 2).data(),
                    table.cell(currentRowAffecter, 3).data(),
                    table.cell(currentRowAffecter, 4)
                        .data(), // Correctly get the 'Date de création' data
                    newDirectorHtml,
                    table.cell(currentRowAffecter, 6).data() // Correctly get the 'Actions' data
                ];

                const updatedRow = table.row(currentRowAffecter).data(updatedData).draw().node();
                $(updatedRow).attr('data-has-director', hasDirector);
            }
            closeModalAffecter();
        });

        if (modalAffecter && popupAffecter) {
            modalAffecter.addEventListener("click", function (e) {
                if (!popupAffecter.contains(e.target)) {
                    closeModalAffecter();
                }
            });
        }

        // --- MODIFIER MODAL Logic ---
        const modalModifier = document.getElementById("modalModifier");
        const popupModifier = document.getElementById("popupContainerModifier");
        let currentRowModifier = null;

        function openModifierModal(row) {
            currentRowModifier = row;
            $('input[name="directorModifier"]').prop('checked', false);
            modalModifier.style.display = "flex";
        }

        function closeModalModifier() {
            modalModifier.style.display = "none";
            currentRowModifier = null;
        }

        $('#btnSaveModifier').on('click', function (event) {
            event.preventDefault();
            if (currentRowModifier) {
                const selectedDirector = $('input[name="directorModifier"]:checked').val();
                let newDirectorHtml = `<button class="assign-director-btn">+</button>`;
                let hasDirector = false;

                if (selectedDirector) {
                    const directorInitials = $(`div.director-option[data-name="${selectedDirector}"]`).data(
                        'initials');
                    newDirectorHtml = `
                    <div class="assign-director-container">
                        <img src="https://placehold.co/40x40/c80000/ffffff?text=${directorInitials}" alt="Avatar" style="border-radius: 50%;">
                    </div>`;
                    hasDirector = true;
                }

                const updatedData = [
                    table.cell(currentRowModifier, 0).data(),
                    table.cell(currentRowModifier, 1).data(),
                    table.cell(currentRowModifier, 2).data(),
                    table.cell(currentRowModifier, 3).data(),
                    table.cell(currentRowModifier, 4)
                        .data(), // Correctly get the 'Date de création' data
                    newDirectorHtml,
                    table.cell(currentRowModifier, 6).data() // Correctly get the 'Actions' data
                ];

                const updatedRow = table.row(currentRowModifier).data(updatedData).draw().node();
                $(updatedRow).attr('data-has-director', hasDirector);
            }
            closeModalModifier();
        });

        if (modalModifier && popupModifier) {
            modalModifier.addEventListener("click", function (e) {
                if (!popupModifier.contains(e.target)) {
                    closeModalModifier();
                }
            });
        }
    });

    */
</script>


<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? '';
$user_id = get_current_user_id();

?>
<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js( $role ) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>

<script>
(() => {
  // ================== CONFIG ==================
  const API_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const LABO_API_URL = `${API_BASE}/plateforme-recherche/v1/laboratoire`;
  const DIRECTEURS_API_URL = `${API_BASE}/plateforme-recherche/v1/directeurs`;
  const ETABS_API_URL = `${API_BASE}/plateforme-master/v1/etablissements`;

  // Rends le directeur obligatoire (true) ou optionnel (false)
  const DIRECTEUR_REQUIRED = true;

  // ================== HELPERS ==================
  const get = (obj, paths, def='')=>{
    for (const p of (Array.isArray(paths)?paths:[paths])) {
      const v = p.split('.').reduce((o,k)=> (o && o[k]!=null)?o[k]:undefined, obj);
      if (v!==undefined && v!==null) return v;
    }
    return def;
  };

  function formatDate(d) {
    try {
      if (!d) return '';
      const date = isNaN(d) ? new Date(d) : new Date(Number(d));
      return date.toLocaleDateString('fr-FR', {year:'numeric', month:'2-digit', day:'2-digit'});
    } catch { return d || ''; }
  }

  function populateSelect(selectEl, items, placeholder = 'Sélectionnez...', valueKey = 'id', labelKey = 'nom') {
    if (!selectEl) return;
    selectEl.innerHTML = '';
    const opt0 = document.createElement('option');
    opt0.value = '';
    opt0.textContent = placeholder;
    selectEl.appendChild(opt0);
    items.forEach(it => {
      const opt = document.createElement('option');
      opt.value = it[valueKey];
      opt.textContent = it[labelKey];
      selectEl.appendChild(opt);
    });
  }

  function setSelectLoading(sel, isLoading){
    if (!sel) return;
    sel.disabled = !!isLoading;
    if (isLoading){
      sel.innerHTML = '<option value="">Chargement...</option>';
    } else if (!sel.options.length){
      const o = document.createElement('option');
      o.value = '';
      o.textContent = 'Sélectionnez...';
      sel.appendChild(o);
    }
  }

  function renderDirectorCell(lab) {
    const dirName   = get(lab, ['directeur_nom','directeur.name','directeur.display_name','directeur']);
    const dirAvatar = get(lab, ['directeur_avatar','directeur.avatar_url','directeur.photo','avatar_url']);
    if (dirName) {
      const initials = dirName.split(' ').filter(Boolean).map(s=>s[0]).join('').substring(0,2).toUpperCase();
      const imgSrc   = dirAvatar || `https://placehold.co/40x40/c80000/ffffff?text=${encodeURIComponent(initials)}`;
      return `
        <div class="assign-director-container" title="${dirName}">
          <img width="40" height="40" src="${imgSrc}" alt="Avatar" style="border-radius:50%;">
        </div>`;
    }
    return `<div class="assign-director-container"><button class="assign-director-btn">+</button></div>`;
  }

  function renderActionsCell(lab) {
    const id   = get(lab, ['id','lab_id']);
    const href = get(lab, ['detail_url'], `/fiche-de-details-de-laboratoire?id=${encodeURIComponent(id)}`);
    return `
      <div class="actions">
        <button class="action-btn">...</button>
        <div class="dropdown-menu">
          <a href="${href}">Modifier</a>
        </div>
      </div>`;
  }


  // ===== Helpers pour les modals "Affecter/Modifier le directeur" =====
function initialsFromName(name=''){
  return name.split(' ').filter(Boolean).map(s=>s[0]).join('').substring(0,2).toUpperCase();
}
function directorOptionHTML(u, selectedId, groupName){
  const id     = u.id;
  const name   = u.label || u.display_name || ('#'+id);
  const mail   = u.email || '';
  const avatar = u.avatar_url || `https://placehold.co/50x50/c80000/ffffff?text=${encodeURIComponent(initialsFromName(name))}`;
  const checked= String(selectedId) === String(id) ? 'checked' : '';
  const inputId= `${groupName}_${id}`;
  return `
  <label class="director-option" for="${inputId}">
    <input type="radio" name="${groupName}" id="${inputId}" value="${id}" ${checked} />
    <img src="${avatar}" alt="${name}" width="50" height="50" style="border-radius:50%;">
    <div class="director-info">
      <span class="name">${name}</span>
      ${mail ? `<span class="title" style="color:#666;font-size:.9em;">${mail}</span>` : ``}
    </div>
  </label>`;
}
async function fetchDirecteursByEtablissement(etablissement_id){
  const url = `${DIRECTEURS_API_URL}?etablissement_id=${encodeURIComponent(etablissement_id)}`;
  const res = await fetch(url, {
    headers: { 'Accept':'application/json', ...(window.PMSettings?.nonce ? {'X-WP-Nonce': PMSettings.nonce} : {}) },
    credentials: 'include'
  });
  if (!res.ok) throw new Error(`API Directeurs ${res.status}`);
  const data = await res.json();
  return data.items || [];
}
async function updateLaboratoireDirector(labId, directeur_user_id){
  const API_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url = `${API_BASE}/plateforme-recherche/v1/laboratoire/${encodeURIComponent(labId)}/directeur`;

  const res = await fetch(url, {
    method: 'PUT', // ou 'PATCH'
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      ...(window.PMSettings?.nonce ? {'X-WP-Nonce': PMSettings.nonce} : {})
    },
    credentials: 'include',
    body: JSON.stringify({ directeur_user_id })
  });

  if (!res.ok){
    let msg = `Erreur API (${res.status})`;
    try { const j = await res.json(); if (j?.message) msg = j.message; } catch {}
    throw new Error(msg);
  }
  return await res.json();
}

// ===== Ouvre un picker (affecter/modifier) et peuple la liste =====
async function openDirectorPicker(row, {mode='modifier'}={}){
  const isModifier = mode === 'modifier';
  const modalId    = isModifier ? 'modalModifier' : 'modalAffecter';
  const groupName  = isModifier ? 'directorModifier' : 'directorAffect';

  const modal   = document.getElementById(modalId);
  const wrapper = document.querySelector(`#${modalId} .popup-form .form-group`);
  if (!modal || !wrapper) return;

  const lab = $(row).data('lab') || {};
  const labId  = lab.id || lab.lab_id;
  const etabId = lab.etablissement_id || lab.etablissementId || lab.etablissementID;
  const currentDirectorId =
    (isModifier ? (lab.directeur_user_id ?? (lab.directeur && lab.directeur.id)) : null);

  if (!etabId){
    console.error('[openDirectorPicker] etablissement_id manquant sur le labo', lab);
    if (window.Swal) Swal.fire('Erreur', "Impossible d'identifier l'établissement du laboratoire.", 'error');
    return;
  }

  wrapper.innerHTML = `<div style="padding:8px;color:#666;">Chargement des directeurs...</div>`;
  modal.dataset.labId = labId || '';

  try {
    const users = await fetchDirecteursByEtablissement(etabId);
    if (!users.length){
      wrapper.innerHTML = `<div style="padding:8px;color:#666;">Aucun directeur trouvé pour cet établissement.</div>`;
    } else {
      wrapper.innerHTML = users.map(u => directorOptionHTML(u, currentDirectorId, groupName)).join('');
    }
    modal.style.display = 'flex';
  } catch (e){
    console.error('[fetchDirecteursByEtablissement]', e);
    wrapper.innerHTML = `<div style="padding:8px;color:#c00;">Erreur de chargement.</div>`;
    modal.style.display = 'flex';
  }
}
function openAffecterModal(row){ return openDirectorPicker(row, {mode:'affecter'}); }
function openModifierModal(row){ return openDirectorPicker(row, {mode:'modifier'}); }

// ===== Boutons Enregistrer des deux modals =====
(function bindSaveForPickers(){
  const bind = (btnId, modalId, groupName) => {
    const btn = document.getElementById(btnId);
    if (!btn) return;
    $(`#${btnId}`).off('click').on('click', async (e)=>{
      e.preventDefault();
      const modal = document.getElementById(modalId);
      const labId = modal?.dataset?.labId;
      const chosen = document.querySelector(`input[name="${groupName}"]:checked`);
      const directeur_user_id = chosen ? parseInt(chosen.value,10) : null;

      if (!labId || !directeur_user_id){
        return Swal.fire('Erreur', 'Veuillez sélectionner un directeur.', 'error');
      }
      const old = btn.textContent; btn.disabled = true; btn.textContent = 'Enregistrement...';
      try{
        await updateLaboratoireDirector(labId, directeur_user_id);
        modal.style.display = 'none';
        const dt = $('#candidaturesTable').DataTable();
        await reloadLaboratoires(dt);
        Swal.fire('Succès', 'Directeur mis à jour.', 'success');
      }catch(err){
        console.error('[updateLaboratoireDirector]', err);
        Swal.fire('Erreur', String(err.message || err), 'error');
      }finally{
        btn.disabled = false; btn.textContent = old;
      }
    });
  };
  bind('btnSaveAffecter', 'modalAffecter', 'directorAffect');
  bind('btnSaveModifier', 'modalModifier', 'directorModifier');
})();

// ===== Fermer les modals en cliquant en dehors =====
(function bindCloseBackdrop(){
  const link = (modalId, boxId) => {
    const modal = document.getElementById(modalId);
    const box   = document.getElementById(boxId);
    if (!modal || !box) return;
    modal.addEventListener('click', (e)=>{ if (!box.contains(e.target)) modal.style.display='none'; });
  };
  link('modalAffecter','popupContainerAffecter');
  link('modalModifier','popupContainerModifier');
})();

  // ================== API CALLS ==================
  async function fetchLaboratoires() {
    const res = await fetch(LABO_API_URL, {
      headers: {
        'Accept': 'application/json',
        ...(window.PMSettings?.nonce ? {'X-WP-Nonce': PMSettings.nonce} : {})
      },
      credentials: 'include'
    });
    if (!res.ok) throw new Error(`API Laboratoires ${res.status}`);
    const payload = await res.json();
    return Array.isArray(payload) ? payload : (payload.items || []);
  }

  async function loadEtablissementsIntoSelect(selectId = 'etablissementLabo', { q = '', universite_id = null, actif = 1 } = {}) {
    const params = new URLSearchParams();
    if (q) params.set('q', q);
    if (universite_id != null) params.set('universite_id', universite_id);
    if (typeof actif !== 'undefined' && actif !== null) params.set('actif', String(actif));

    const url = ETABS_API_URL + (params.toString() ? `?${params}` : '');
    const res = await fetch(url, {
      headers: {
        'Accept': 'application/json',
        ...(window.PMSettings?.nonce ? { 'X-WP-Nonce': PMSettings.nonce } : {})
      },
      credentials: 'include'
    });
    if (!res.ok) throw new Error(`API Etablissements ${res.status}`);
    const data = await res.json();
    const raw = Array.isArray(data) ? data : (data.items || []);
    const items = raw.map(r => ({
      id:  r.id ?? r.etablissement_id ?? r.ID,
      nom: r.nom ?? r.label ?? r.name ?? '—'
    })).sort((a,b)=> a.nom.localeCompare(b.nom, 'fr', {sensitivity:'base'}));

    const sel = document.getElementById(selectId);
    populateSelect(sel, items, 'Etablissement', 'id', 'nom');
  }

  async function loadDirecteursIntoSelect(
    selectId = 'directeurLabo',
    { q = '', etablissement_id = null, all = 0 } = {}
  ) {
    const params = new URLSearchParams();
    if (q) params.set('q', q);
    if (etablissement_id != null) params.set('etablissement_id', etablissement_id);
    if (all) params.set('all', '1');

    const url = DIRECTEURS_API_URL + (params.toString() ? `?${params}` : '');
    const res = await fetch(url, {
      headers: {
        'Accept': 'application/json',
        ...(window.PMSettings?.nonce ? {'X-WP-Nonce': PMSettings.nonce} : {})
      },
      credentials: 'include'
    });
    if (!res.ok) throw new Error(`API Directeurs ${res.status}`);
    const data = await res.json();

    const sel = document.getElementById(selectId);
    if (!sel) return;
    populateSelect(sel, (data.items || []).map(u => ({
      id: u.id,
      nom: u.label || u.display_name || ('#'+u.id)
    })), 'Sélectionnez...', 'id', 'nom');
  }

  async function createLaboratoire({ etablissement_id, nom, domaine, directeur_user_id = null }){
    const body = {
        etablissement_id,
        denomination: nom,        // <-- IMPORTANT
        domaine,
        directeur_user_id
    };
    console.log('POST /laboratoire', body); // debug
    const res = await fetch(LABO_API_URL, {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...(window.PMSettings?.nonce ? {'X-WP-Nonce': PMSettings.nonce} : {})
        },
        credentials: 'include',
        body: JSON.stringify(body)
    });
    if (!res.ok){
        let msg = `Erreur API (${res.status})`;
        try { const j = await res.json(); if (j?.message) msg = j.message; } catch{}
        throw new Error(msg);
    }
    return await res.json();
}



  async function reloadLaboratoires(dt){
  const labs = await fetchLaboratoires();
  dt.clear();
  labs.forEach(l=>{
    const id         = l.id || l.lab_id;
    const intitule   = l.intitule || l.denomination || l.nom || `Labo ${id||''}`;
    const domaine    = l.domaine || '';
    const etabNom    = l.etablissement_nom || l.etablissement || '';
    const dateCrea   = formatDate(l.date_creation || l.created_at);
    const directorTd = renderDirectorCell(l);
    const actionsTd  = renderActionsCell(l);

    const rowNode = dt.row.add([
      '<input type="checkbox">',
      intitule,
      domaine,
      etabNom,
      dateCrea,
      directorTd,
      actionsTd
    ]).draw(false).node();

    rowNode.setAttribute('data-has-director', /assign-director-btn/.test(directorTd) ? 'false' : 'true');
    rowNode.setAttribute('data-lab-id', id ?? '');
    // >>> IMPORTANT : on mémorise l’objet labo sur la ligne (utilisé par le modal)
    $(rowNode).data('lab', l);
  });
}


  function bindDirecteursToEtablissement({
    etabSelectId = 'etablissementLabo',
    dirSelectId  = 'directeurLabo'
  } = {}){
    const etabSel = document.getElementById(etabSelectId);
    const dirSel  = document.getElementById(dirSelectId);
    if (!etabSel || !dirSel) return;

    const refresh = async () => {
      const etablissement_id = etabSel.value ? parseInt(etabSel.value, 10) : null;
      if (!etablissement_id){
        populateSelect(dirSel, [], 'Sélectionnez...');
        dirSel.disabled = true;
        return;
      }
      try {
        setSelectLoading(dirSel, true);
        await loadDirecteursIntoSelect(dirSelectId, { etablissement_id });
        dirSel.disabled = false;
      } catch (e){
        console.error('[directeurs] load error', e);
        populateSelect(dirSel, [], 'Erreur de chargement');
        dirSel.disabled = true;
        if (window.toast) window.toast('Erreur lors du chargement des directeurs', true);
      } finally {
        setSelectLoading(dirSel, false);
      }
    };

    etabSel.addEventListener('change', refresh);
    if (etabSel.value) refresh(); else { dirSel.disabled = true; }
  }

  // ================== APP ==================
  document.addEventListener('DOMContentLoaded', async () => {
    // DataTable
    const table = $('#candidaturesTable').DataTable({
      paging: true,
      searching: true,
      ordering: false,
      info: false,
      pageLength: 5,
      dom: 'Bfrtip',
      buttons: [],
      language: {
        paginate: { previous: "<i class='fa fa-chevron-left'></i>", next: "<i class='fa fa-chevron-right'></i>" },
        emptyTable: "Aucune donnée disponible",
        zeroRecords: "Aucun enregistrement correspondant trouvé"
      }
    });
    table.clear().draw();

    // Charger Etablissements + brancher Directeurs
    try {
      await loadEtablissementsIntoSelect('etablissementLabo');
    } catch(e){
      console.error('[loadEtablissementsIntoSelect]', e);
      if (window.Swal) Swal.fire('Erreur', 'Chargement des établissements impossible.', 'error');
    }
    bindDirecteursToEtablissement({ etabSelectId: 'etablissementLabo', dirSelectId: 'directeurLabo' });

    // Charger la liste des labos
    try {
      await reloadLaboratoires(table);
      // Après chargement, construire les filtres (directeur/domaine/étab) depuis les données visibles
      // (option simple : laisse tes options statiques ; sinon on peut analyser les lignes pour auto-peupler)
    } catch (e) {
      console.error('[laboratoires.load]', e);
      if (window.Swal) Swal.fire('Erreur', 'Impossible de charger les laboratoires.', 'error');
    }

    // Dropdown des actions (délégation)
    $('#candidaturesTable tbody').on('click', '.action-btn', function (e) {
      e.stopPropagation();
      $('.dropdown-menu').not($(this).next('.dropdown-menu')).hide();
      $(this).next('.dropdown-menu').toggle();
    });
    $('#candidaturesTable tbody').on('click', '.dropdown-menu a', function (e) {
      e.stopPropagation();
      $(this).closest('.dropdown-menu').hide();
    });
    document.addEventListener('click', function () { $('.dropdown-menu').hide(); });

    // Ouvrir/Affecter/Modifier directeur
    const modalAffecter = document.getElementById("modalAffecter");
    const modalModifier = document.getElementById("modalModifier");
    //function openAffecterModal(row){ if (modalAffecter) { $('input[name="directorAffect"]').prop('checked', false); modalAffecter.style.display="flex"; modalAffecter.dataset.rowIndex = table.row(row).index(); } }

    $('#candidaturesTable tbody').on('click', '.assign-director-btn', function (e) {
      e.stopPropagation();
      const row = $(this).closest('tr');
      openAffecterModal(row);
    });
    $('#candidaturesTable tbody').on('click', '.assign-director-container', function (e) {
      if ($(e.target).closest('.assign-director-btn').length) return;
      e.stopPropagation();
      const row = $(this).closest('tr');
      (row.attr('data-has-director') === 'true') ? openModifierModal(row) : openAffecterModal(row);
    });

    // Filtres
    const directeurFilterSelect    = document.getElementById('directeurFilter');
    const domaineFilterSelect      = document.getElementById('domaineFilter');
    const etablissementFilterSelect= document.getElementById('etablissementFilter');
    const searchInput              = document.getElementById('searchInput');

    function applyFilters() {
      const directeurValue   = directeurFilterSelect?.value.trim() ?? '';
      const domaineValue     = domaineFilterSelect?.value.trim() ?? '';
      const etablissementVal = etablissementFilterSelect?.value.trim() ?? '';
      const searchTerm       = searchInput?.value.trim().toLowerCase() ?? '';

      $.fn.dataTable.ext.search.push(function (settings, data) {
        const intitule     = (data[1] || '');
        const domaine      = (data[2] || '');
        const etablissement= (data[3] || '');
        const directeurTd  = (data[5] || '');
        const directeurTxt = $('<div>').html(directeurTd).text().trim();

        const m1 = !searchTerm || intitule.toLowerCase().includes(searchTerm);
        const m2 = !directeurValue || directeurTxt.includes(directeurValue);
        const m3 = !domaineValue || domaine.trim() === domaineValue;
        const m4 = !etablissementVal || etablissement.trim() === etablissementVal;
        return m1 && m2 && m3 && m4;
      });
      table.draw();
      $.fn.dataTable.ext.search.pop();
    }

    directeurFilterSelect?.addEventListener('change', applyFilters);
    domaineFilterSelect?.addEventListener('change', applyFilters);
    etablissementFilterSelect?.addEventListener('change', applyFilters);
    searchInput?.addEventListener('keyup', applyFilters);

    // Check-all
    $('#checkAll').on('change', function () {
      const isChecked = this.checked;
      $('#candidaturesTable tbody input[type="checkbox"]').prop('checked', isChecked);
    });
    $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function () {
      if (!this.checked) $('#checkAll').prop('checked', false);
    });

    // Modal "Ajouter un laboratoire"
    const modalObjectifs = document.getElementById("modalObjectifs");
    const openmodalObjectifs = () => { if (modalObjectifs) modalObjectifs.style.display = "flex"; };
    const closeModalObjectifs = () => { if (modalObjectifs) modalObjectifs.style.display = "none"; };
    $('.add-project-btn').off('click').on('click', openmodalObjectifs);

    // Bouton Enregistrer (UN SEUL handler)
    const btnSave = document.getElementById('btnSaveObjectifs');
    if (btnSave){
      $(btnSave).off('click').on('click', async (e)=>{
        e.preventDefault();

        const etablissement_id  = parseInt(document.getElementById('etablissementLabo')?.value || '', 10);
        const nom               = (document.getElementById('nomLabo')?.value || '').trim();
        const domaine           = (document.getElementById('Domaine')?.value || '').trim();
        const dirSelect         = document.getElementById('directeurLabo');
        const directeur_user_id = dirSelect && dirSelect.value ? parseInt(dirSelect.value,10) : null;

        if (!etablissement_id || !nom || (DIRECTEUR_REQUIRED && !directeur_user_id)){
          Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires.', 'error');
          return;
        }

        const oldLabel = btnSave.textContent;
        btnSave.disabled = true; btnSave.textContent = 'Enregistrement...';

        try{
          await createLaboratoire({ etablissement_id, nom, domaine, directeur_user_id });
          closeModalObjectifs();
          const form = modalObjectifs?.querySelector('form.popup-form');
          if (form) form.reset();
          await reloadLaboratoires(table);
          Swal.fire('Succès', 'Laboratoire ajouté avec succès.', 'success');
        }catch(err){
          console.error('[createLaboratoire]', err);
          Swal.fire('Erreur', String(err.message || err), 'error');
        }finally{
          btnSave.disabled = false; btnSave.textContent = oldLabel;
        }
      });
    }

    // Fermer modals en cliquant hors du contenu
    const popupObjectifs = document.getElementById("popupContainerObjectifs");
    const popupAffecter  = document.getElementById("popupContainerAffecter");
    const popupModifier  = document.getElementById("popupContainerModifier");

    if (modalObjectifs && popupObjectifs) {
      modalObjectifs.addEventListener("click", (e) => {
        if (!popupObjectifs.contains(e.target)) closeModalObjectifs();
      });
    }
    if (document.getElementById("modalAffecter") && popupAffecter) {
      document.getElementById("modalAffecter").addEventListener("click", (e) => {
        if (!popupAffecter.contains(e.target)) document.getElementById("modalAffecter").style.display="none";
      });
    }
    if (document.getElementById("modalModifier") && popupModifier) {
      document.getElementById("modalModifier").addEventListener("click", (e) => {
        if (!popupModifier.contains(e.target)) document.getElementById("modalModifier").style.display="none";
      });
    }
  });
})();




</script>

