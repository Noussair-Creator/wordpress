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
        display: block;
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
        background-color: white;
        font-size: 20px;
        font-weight: bolder;
        letter-spacing: 5px;
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
            <tr data-has-director="false">
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
            </tr>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable
        const table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: true, // Enable search for the filter to work
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'Bfrtip',
            buttons: [], // Initially no buttons, can be added later if needed
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            }
        });

        // --- Action Buttons (Dropdown Menu) ---
        // Use event delegation on the table body for dynamically added rows
        $('#candidaturesTable tbody').on('click', '.action-btn', function (e) {
            e.stopPropagation();
            // Show the dropdown menu for the clicked button
            $('.dropdown-menu').not($(this).next('.dropdown-menu')).hide();
            $(this).next('.dropdown-menu').toggle();
        });

        // Handle clicks on the dropdown menu items
        // The previous code had a bug that prevented the link from working.
        // This corrected code allows the default link behavior to proceed.
        $('#candidaturesTable tbody').on('click', '.dropdown-menu a', function (e) {
            e.stopPropagation(); // Stop it from closing the menu immediately
            // The link will now navigate to the href URL by default.
            // The `e.preventDefault()` line was removed to fix the issue.
            $(this).closest('.dropdown-menu').hide();
        });

        // Handle clicks on the assign director button
        $('#candidaturesTable tbody').on('click', '.assign-director-btn', function (e) {
            e.stopPropagation();
            const row = $(this).closest('tr');
            openAffecterModal(row);
        });

        // Handle clicks on the director's container to open the modal
        $('#candidaturesTable tbody').on('click', '.assign-director-container', function (e) {
            e.stopPropagation();
            const row = $(this).closest('tr');
            openModifierModal(row);
        });

        // Close dropdowns when clicking anywhere else on the page
        document.addEventListener('click', function () {
            $('.dropdown-menu').hide();
        });

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
</script>