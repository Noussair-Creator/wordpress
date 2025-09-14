<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contacts</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
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

    .dashboard-sub-title {
        font-weight: bold;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
    }

    .add-contact-btn {
        background-color: #c60000;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color: 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .add-contact-btn:hover {
        background-color: #a50000;
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
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.6rem 2.5rem 0.6rem 0.75rem;
        background-color: #fdfdfd;
        font-size: 14px;
        height: 42px;
        width: 250px;
    }

    .search-input-wrapper .fa-search {
        position: absolute;
        top: 50%;
        right: 0.85rem;
        transform: translateY(-50%);
        color: #6b7280;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .icon-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background-color: #fdfdfd;
        color: #BF0404;
        cursor: pointer;
        transition: background-color: 0.2s;
        font-size: 16px;
    }

    .icon-btn:hover {
        background-color: #f5f5f5;
    }

    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
    }

    .styled-table thead {
        background-color: #f3f1e9;
    }

    .styled-table th,
    .styled-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .styled-table th:first-child {
        border-top-left-radius: 12px;
    }

    .styled-table th:last-child {
        border-top-right-radius: 12px;
    }

    .styled-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    .styled-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }


    .styled-table tbody tr:last-child td {
        border-bottom: none;
    }

    .styled-table th {
        font-weight: 600;
    }

    .styled-table td {
        vertical-align: middle;
    }

    .styled-table .org-name,
    .styled-table .contact-person {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .org-logo,
    .contact-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .org-logo {
        border: 1px solid #ddd;
    }

    .actions {
        position: relative;
        display: inline-block;
    }

    .action-btn {
        background: none;
        border: none;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }

    /* --- NEW PAGINATION STYLES (ADAPTED) --- */
    .datatable-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
    }

    .dataTables_paginate {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        cursor: pointer;
        min-width: 33px !important;
        height: 33px;
        padding: 0 4px;
        font-weight: 500;
        font-size: 14px;
        line-height: 1;
        transition: all 0.2s;
        border-radius: 4px;
        background: #fff !important;
        border: 1px solid #DBD9C3;
        color: #ffffffff !important;
    }

    /* Hover for number buttons */
    .dataTables_paginate .paginate_button:not(.disabled):hover {
        background: #f7f6f1;
        border-color: #A6A485;
    }

    /* Style for the CURRENT number button */
    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button.current:hover {
        background: #BF0404 !important;
        color: #fff !important;
        border-color: #BF0404 !important;
        font-weight: 700;
        cursor: default;
    }

    /* Style for arrow buttons (first, prev, next, last) */
    .dataTables_paginate .paginate_button.first,
    .dataTables_paginate .paginate_button.previous,
    .dataTables_paginate .paginate_button.next,
    .dataTables_paginate .paginate_button.last {
        border: 2px solid #BF0404 !important;
        color: #BF0404 !important;
        background: #fff;
        font-size: 16px;
        font-weight: 700;
        /* padding: 0; */
        border-radius: 3px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        /* box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em; */
        padding: 10px;
        border: 2px solid #DBD9C4;
        /* margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        color: inherit !important;
        border: 1px solid transparent;
        border-radius: 2px;
        background: transparent; */
    }

    /* Override for DISABLED buttons */
    .dataTables_paginate .paginate_button.disabled,
    .dataTables_paginate .paginate_button.disabled:hover {
        cursor: not-allowed;
        opacity: 0.5;
        border-color: #ccc !important;
        color: #ffffffff !important;
        background: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: white !important;
        border: 1px solid rgba(0, 0, 0, 0.3);
        background-color: rgba(0, 0, 0, 0.05);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(230, 230, 230, 0.05)), color-stop(100%, rgba(0, 0, 0, 0.05)));
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 0.05) 0%, rgba(0, 0, 0, 0.05) 100%);
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 0.05) 0%, rgba(0, 0, 0, 0.05) 100%);
        background: -ms-linear-gradient(top, rgba(230, 230, 230, 0.05) 0%, rgba(0, 0, 0, 0.05) 100%);
        background: -o-linear-gradient(top, rgba(230, 230, 230, 0.05) 0%, rgba(0, 0, 0, 0.05) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 0.05) 0%, rgba(0, 0, 0, 0.05) 100%);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #BF0404 !important;
        border: 2px solid #BF0404;
        background-color: #BF0404;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
        background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
        background: -moz-linear-gradient(top, #585858 0%, #111 100%);
        background: -ms-linear-gradient(top, #585858 0%, #111 100%);
        background: -o-linear-gradient(top, #585858 0%, #111 100%);
        background: linear-gradient(to bottom, #585858 0%, #111 100%);
    }



    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
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
        width: 450px;
        height: 100%;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        box-shadow: 0 5px 16px rgba(0, 0, 0, 0.16);
        margin-bottom: 20px;
    }

    .popup-form,
    .popup-details {
        padding: 0 25px;
    }

    .popup-form .form-group {
        margin-bottom: 15px;
    }

    .popup-form label {
        display: block;
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .popup-form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .popup-form .form-section-title,
    .popup-details .details-section-title {
        font-weight: bold;
        font-size: 1rem;
        margin-top: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .popup-header h2 {
        font-size: 16px;
        margin: 0;
        color: #2A2916;
    }

    .btn-enregistrer {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .ql-toolbar.ql-snow {
        border-radius: 6px 6px 0 0;
        background-color: #ecebe3;
        border: 1px solid #DBD9C3;
    }

    .ql-container.ql-snow {
        border-radius: 0 0 6px 6px;
        font-size: 14px;
        border: 1px solid #DBD9C3;
    }

    /* Action Dropdown Menu */
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 10;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px 0;
    }

    .dropdown-menu a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    /* New styles for Add Contact Modal */
    .logo-upload-placeholder {
        width: 100px;
        height: 100px;
        border: 2px dashed #ccc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-bottom: 15px;
        position: relative;
        overflow: hidden;
    }

    .logo-upload-placeholder i {
        font-size: 2rem;
        color: #ccc;
    }

    .logo-upload-placeholder .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon input {
        padding-left: 45px;
    }

    .input-with-icon .icon {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid #ccc;
    }

    .input-with-icon .icon-right {
        left: auto;
        right: 0;
        border-right: none;
        border-left: 1px solid #ccc;
    }

    .input-with-icon input.website-input {
        padding-left: 15px;
        padding-right: 45px;
    }

    /* --- UPDATED: Styles for Detail Modal --- */
    #detailContactModal .popup-header {
        display: none;
    }

    #detailContactModal .popup-details {
        padding: 25px;
    }

    .detail-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .detail-logo,
    .detail-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 10px auto;
        display: block;
    }

    .detail-logo {
        border: 1px solid #eee;
    }

    .detail-name {
        font-weight: bold;
        font-size: 1.2rem;
        margin: 0;
        color: #333;
    }

    .detail-info-item {
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid #ebeae4;
    }

    .detail-info-grid .detail-info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .detail-info-item .label {
        display: block;
        font-weight: 500;
        color: #605E3E;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .detail-info-item .value {
        display: block;
        color: #333;
        font-size: 16px;
    }

    .detail-info-item .value a {
        color: #007bff;
        text-decoration: none;
    }

    .detail-info-item .value a:hover {
        text-decoration: underline;
    }

    .popup-details .details-section-title {
        display: none;
    }


    #contactsTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
        /* overflow: visible; */
    }

    #contactsTable th {
        border: 0px solid #EBE9D7;
        text-align: center;
    }

    #contactsTable td {
        border: 1px solid #EBE9D7;
        text-align: center;
    }

    #contactsTable thead {
        border: none !important;
        position: static;
        transform: translateY(-15px);
    }

    #contactsTable tbody tr:first-child td:first-child {
        border-top: 1px solid #EBE9D7 !important;
    }

    #contactsTable {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 50x 50px 0 0;
        /* overflow: hidden; */
    }

    #contactsTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    #contactsTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    #contactsTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #contactsTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    #contactsTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    #contactsTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    #contactsTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #contactsTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }
    </style>
</head>

<body>
    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <span>
                    <img style="width:38px;height:38px;margin-right:8px;display:inline-block;border-radius:4px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/building.png" alt="Building Icon"
                        onerror="this.onerror=null;this.src='https://placehold.co/38x38/c60000/FFFFFF?text=B';">
                </span>
                Entreprises / Partenaires
            </h2>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="search-input-wrapper">
                <input class="search-input" id="searchInput" type="text" placeholder="Recherche...">
                <i class="fas fa-search"></i>
            </div>

            <div class="filter-actions">
                <button class="add-contact-btn" onclick="openAddContactModal()"><i class="fas fa-plus"></i> Ajouter
                    contact</button>
                <button class="icon-btn" title="Vue card" style="background-color:#A6A485;">

                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Composant 286 – 1.png"
                        alt="Composant 286">
                </button>
                <button class="icon-btn" title="Vue tableau">
                    <!-- <i class="fa-solid fa-list"></i> -->
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Composant 300 – 1.png"
                        alt="Composant 300">
                </button>
                <button class="icon-btn" title="Download">
                    <!-- <i class="fa-solid fa-download"></i> -->
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                        alt="upload-red">
                </button>
            </div>
        </div>

        <table class="styled-table" id="contactsTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Nom organisation</th>
                    <th>Domaine</th>
                    <th>Contact principal</th>
                    <th>Téléphone</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="contactsTableBody">
                <!-- rempli via JS -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Missing Documents (inchangé) -->
    <div class="modal-overlay" id="modalObjectifs" style="display:none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Définir les documents manquants</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Envoyer</button>
            </div>
            <form class="popup-form">
                <div class="editor-wrapper">
                    <div id="objectifSpecifique" style="height:150px;"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Ajouter Contact -->
    <div class="modal-overlay" id="addContactModal" style="display:none;">
        <div class="popup-container" id="popupContainerAddContact">
            <div class="popup-header">
                <h2>Ajouter Contact</h2>
                <button class="btn-enregistrer" id="btnAddSave">Enregistrer</button>
            </div>
            <form class="popup-form" id="addForm">
                <h3 class="form-section-title">Détails de l'organisation</h3>
                <div class="form-group">
                    <label>Logo organisation</label>
                    <div class="logo-upload-placeholder" id="orgLogoPlaceholder">
                        <i class="fas fa-camera"></i>
                        <img class="image-preview" id="orgLogoPreview" src="" alt="Logo Preview" style="display:none;">
                    </div>
                    <input type="file" id="orgLogoInput" accept="image/*" style="display:none;">
                </div>
                <div class="form-group"><input id="addOrgName" type="text" placeholder="Nom Organisation" required>
                </div>
                <div class="form-group"><input id="addOrgDomain" type="text" placeholder="Domaine"></div>
                <div class="form-group"><input id="addOrgMatricule" type="text" placeholder="Matricule"></div>
                <div class="form-group"><input id="addOrgEmail" type="email" placeholder="E-mail organisation"></div>
                <div class="form-group"><input id="addOrgAddress" type="text" placeholder="Adresse de l'organisation">
                </div>
                <div class="form-group input-with-icon">
                    <span class="icon"><img style="width:30px;border-radius:2px;"
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="TN Flag"
                            onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                    <input id="addOrgPhone" type="text" placeholder="+216 XX XX XX XX">
                </div>
                <div class="form-group input-with-icon">
                    <input id="addOrgWebsite" type="text" class="website-input" placeholder="Site web">
                    <span class="icon icon-right">🌐</span>
                </div>

                <h3 class="form-section-title">Détails du contact principal</h3>
                <div class="form-group">
                    <label>Avatar</label>
                    <div class="logo-upload-placeholder" id="contactAvatarPlaceholder">
                        <i class="fas fa-camera"></i>
                        <img class="image-preview" id="contactAvatarPreview" src="" alt="Avatar Preview"
                            style="display:none;">
                    </div>
                    <input type="file" id="contactAvatarInput" accept="image/*" style="display:none;">
                </div>
                <div class="form-group"><input id="addContactName" type="text" placeholder="Nom et prénom" required>
                </div>
                <div class="form-group"><input id="addContactFunction" type="text" placeholder="Fonction"></div>
                <div class="form-group"><input id="addContactEmail" type="email" placeholder="E-mail"></div>
                <div class="form-group input-with-icon">
                    <span class="icon"><img style="width:30px;border-radius:2px;"
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="TN Flag"
                            onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                    <input id="addContactPhone" type="text" placeholder="+216 XX XX XX XX">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Modifier Contact -->
    <div class="modal-overlay" id="editContactModal" style="display:none;">
        <div class="popup-container">
            <div class="popup-header">
                <h2>Modifier Contact</h2>
                <button class="btn-enregistrer" id="btnEditSave">Enregistrer</button>
            </div>
            <form class="popup-form" id="editForm">
                <h3 class="form-section-title">Détails de l'organisation</h3>
                <div class="form-group">
                    <label>Logo organisation</label>
                    <div class="logo-upload-placeholder" id="editOrgLogoPlaceholder">
                        <i class="fas fa-camera"></i>
                        <img class="image-preview" id="editOrgLogoPreview" src="" alt="Logo Preview"
                            style="display:none;">
                    </div>
                    <input type="file" id="editOrgLogoInput" accept="image/*" style="display:none;">
                </div>
                <div class="form-group"><input id="editOrgName" type="text" placeholder="Nom Organisation" required>
                </div>
                <div class="form-group"><input id="editOrgDomain" type="text" placeholder="Domaine"></div>
                <div class="form-group"><input id="editOrgMatricule" type="text" placeholder="Matricule"></div>
                <div class="form-group"><input id="editOrgEmail" type="email" placeholder="E-mail organisation"></div>
                <div class="form-group"><input id="editOrgAddress" type="text" placeholder="Adresse de l'organisation">
                </div>
                <div class="form-group input-with-icon">
                    <span class="icon"><img style="width:30px;border-radius:2px;"
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="TN Flag"
                            onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                    <input id="editOrgPhone" type="text" placeholder="+216 XX XX XX XX">
                </div>
                <div class="form-group input-with-icon">
                    <input type="text" id="editOrgWebsite" class="website-input" placeholder="Site web">
                    <span class="icon icon-right">🌐</span>
                </div>

                <h3 class="form-section-title">Détails du contact principal</h3>
                <div class="form-group">
                    <label>Avatar</label>
                    <div class="logo-upload-placeholder" id="editContactAvatarPlaceholder">
                        <i class="fas fa-camera"></i>
                        <img class="image-preview" id="editContactAvatarPreview" src="" alt="Avatar Preview"
                            style="display:none;">
                    </div>
                    <input type="file" id="editContactAvatarInput" accept="image/*" style="display:none;">
                </div>
                <div class="form-group"><input id="editContactName" type="text" placeholder="Nom et prénom" required>
                </div>
                <div class="form-group"><input id="editContactFunction" type="text" placeholder="Fonction"></div>
                <div class="form-group"><input id="editContactEmail" type="email" placeholder="E-mail"></div>
                <div class="form-group input-with-icon">
                    <span class="icon"><img style="width:30px;border-radius:2px;"
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="TN Flag"
                            onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                    <input id="editContactPhone" type="text" placeholder="+216 XX XX XX XX">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Détail -->
    <div class="modal-overlay" id="detailContactModal" style="display:none;">
        <div class="popup-container">
            <div class="popup-details">
                <div class="detail-header">
                    <img src="" alt="Organization Logo" class="detail-logo" id="detailOrgLogo">
                    <h3 class="detail-name" id="detailOrgName"></h3>
                </div>
                <div class="detail-info-grid">
                    <div class="detail-info-item"><span class="label">Domaine :</span><span class="value"
                            id="detailOrgDomain"></span></div>
                    <div class="detail-info-item"><span class="label">Matricule :</span><span class="value"
                            id="detailOrgMatricule">—</span></div>
                    <div class="detail-info-item"><span class="label">Email Organisation :</span><span class="value"
                            id="detailOrgEmail"></span></div>
                    <div class="detail-info-item"><span class="label">Adresse Organisation :</span><span class="value"
                            id="detailOrgAddress">—</span></div>
                    <div class="detail-info-item"><span class="label">Téléphone :</span><span class="value"
                            id="detailOrgPhone"></span></div>
                    <div class="detail-info-item"><span class="label">Site Web :</span><span class="value"><a href="#"
                                id="detailOrgWebsite" target="_blank"></a></span></div>
                </div>
                <hr style="margin-inline:-25px;color:#605E3E;box-shadow:-1px 1px 0px black;">
                <div class="detail-header">
                    <img src="" alt="Contact Avatar" class="detail-avatar" id="detailContactAvatar">
                    <h3 class="detail-name" id="detailContactName"></h3>
                </div>
                <div class="detail-info-grid">
                    <div class="detail-info-item"><span class="label">Fonction :</span><span class="value"
                            id="detailContactFunction">—</span></div>
                    <div class="detail-info-item"><span class="label">Email :</span><span class="value"
                            id="detailContactEmail"></span></div>
                    <div class="detail-info-item"><span class="label">Téléphone :</span><span class="value"
                            id="detailContactPhone"></span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <?php if (is_user_logged_in()): ?>
    <script>
    window.pmsettings = {
        rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
        nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
    };
    </script>
    <?php else: ?>
    <!-- This block can be styled or removed if not needed when not logged in -->
    <div
        style="padding: 20px; text-align: center; background: #fff1f1; border: 1px solid #ffc8c8; border-radius: 8px; margin: 20px;">
        <p style="margin: 0; font-size: 16px; color: #c60000;">Vous devez être connecté pour accéder aux contacts.</p>
    </div>
    <?php endif; ?>

    <script>
    (function($) {
        /* ===== REST config (WordPress) ===== */
        const REST_ROOT =
            (window.pmsettings && pmsettings.rest_root) ||
            (window.wpApiSettings && wpApiSettings.root) ||
            '/wp-json/';
        const NONCE =
            (window.pmsettings && pmsettings.nonce) ||
            (window.wpApiSettings && wpApiSettings.nonce) ||
            '';
        const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

        /* ===== Helpers ===== */
        const esc = (s) => ('' + (s ?? '')).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        } [m]));
        const placeholderLogo = "https://placehold.co/32x32/eeeeee/cccccc?text=B";
        const placeholderAvatar = "https://placehold.co/32x32/eeeeee/cccccc?text=P";

        /* ===== DataTable instance ===== */
        let dt = null;

        /* ===== Render une ligne ===== */
        function renderRow(c) {
            const id = c.id;
            const orgLogo = c.logo_url || placeholderLogo;
            const avatar = c.contact_avatar_url || placeholderAvatar;
            const tel = c.contact_tel || c.org_tel || '';
            const mail = c.contact_email || c.org_email || '';
            const domain = c.domaine || '';
            const org = c.institution || '';

            return `
          <tr data-id="${esc(id)}"
              data-website="${esc(c.website || '')}"
              data-orgemail="${esc(c.org_email || '')}"
              data-orgphone="${esc(c.org_tel || '')}"
              data-orgaddress="${esc(c.org_address || '')}"
              data-orgmatricule="${esc(c.matricule || '')}"
              data-logo="${esc(c.logo_url || '')}"
              data-contactemail="${esc(c.contact_email || '')}"
              data-contactphone="${esc(c.contact_tel || '')}"
              data-contactname="${esc(c.contact_nom || '')}"
              data-contactavatar="${esc(c.contact_avatar_url || '')}"
              data-contactfunction="${esc(c.contact_function || '')}"
              data-domaine="${esc(c.domaine || '')}">
            <td><input type="checkbox"></td>
            <td>
              <div class="org-name">
                <img src="${esc(orgLogo)}" class="org-logo" alt="logo"
                     onerror="this.onerror=null;this.src='${placeholderLogo}'">
                <span>${esc(org)}</span>
              </div>
            </td>
            <td>${esc(domain)}</td>
            <td>
              <div class="contact-person">
                <img src="${esc(avatar)}" class="contact-avatar" alt="avatar"
                     onerror="this.onerror=null;this.src='${placeholderAvatar}'">
                <span>${esc(c.contact_nom || '—')}</span>
              </div>
            </td>
            <td>${esc(tel || '—')}</td>
            <td>${esc(mail || '—')}</td>
            <td>
              <div class="actions">
                <button class="action-btn" title="Actions">...</button>
                <div class="dropdown-menu">
                  <a href="#" class="js-edit" data-id="${esc(id)}">Modifier</a>
                  <a href="#" class="js-detail" data-id="${esc(id)}">Détail</a>
                  <a href="#" class="js-delete" data-id="${esc(id)}">Supprimer</a>
                </div>
              </div>
            </td>
          </tr>
        `;
        }

        /* ===== Charger la liste ===== */
        async function loadContacts() {
            // Check if pmsettings is available, otherwise don't proceed with API call
            if (!window.pmsettings) {
                console.log("Configuration WordPress non disponible. Impossible de charger les contacts.");
                $('#contactsTableBody').html(
                    `<tr><td colspan="7" style="text-align:center; padding: 20px;">Configuration manquante. Impossible de charger les contacts.</td></tr>`
                );
                return;
            }

            try {
                const res = await fetch(`${API}/contact`, {
                    headers: {
                        'X-WP-Nonce': NONCE,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);
                const rows = await res.json();

                const $tb = $('#contactsTableBody').empty();
                rows.forEach(c => $tb.append(renderRow(c)));

                if (dt) {
                    dt.destroy();
                }
                dt = $('#contactsTable').DataTable({
                    paging: true,
                    pagingType: 'full_numbers',
                    searching: true,
                    ordering: false,
                    info: false,
                    pageLength: 5,
                    language: {
                        paginate: {
                            first: "<i class='fa-solid fa-angles-left'></i>",
                            previous: "<i class='fa-solid fa-angle-left'></i>",
                            next: "<i class='fa-solid fa-angle-right'></i>",
                            last: "<i class='fa-solid fa-angles-right'></i>"
                        },
                        emptyTable: "Aucune donnée disponible",
                        zeroRecords: "Aucun enregistrement correspondant trouvé"
                    },
                    dom: '<"top">rt<"bottom"<"datatable-footer"p>><"clear">'
                });

                $('#searchInput').off('keyup').on('keyup', function() {
                    dt.search(this.value).draw();
                });
            } catch (e) {
                console.error(e);
                $('#contactsTableBody').html(
                    `<tr><td colspan="7" style="text-align:center; padding: 20px;">Impossible de charger les contacts.</td></tr>`
                );
            }
        }

        /* ===== Modals open/close ===== */
        window.openAddContactModal = function() {
            $('#addContactModal').css('display', 'flex');
        };

        function closeModal(sel) {
            $(sel).hide();
        }

        $(document).on('click', '.modal-overlay', function(e) {
            if (e.target === this) {
                $(this).hide();
            }
        });

        /* ===== Image previews ===== */
        function setupImagePreview(placeholderId, inputId, previewId) {
            $(placeholderId).on('click', () => $(inputId).click());
            $(inputId).on('change', function(e) {
                const f = e.target.files[0];
                if (!f) return;
                const r = new FileReader();
                r.onload = ev => {
                    $(previewId).attr('src', ev.target.result).show();
                    $(`${placeholderId} i`).hide();
                };
                r.readAsDataURL(f);
            });
        }
        setupImagePreview('#orgLogoPlaceholder', '#orgLogoInput', '#orgLogoPreview');
        setupImagePreview('#contactAvatarPlaceholder', '#contactAvatarInput', '#contactAvatarPreview');
        setupImagePreview('#editOrgLogoPlaceholder', '#editOrgLogoInput', '#editOrgLogoPreview');
        setupImagePreview('#editContactAvatarPlaceholder', '#editContactAvatarInput', '#editContactAvatarPreview');

        /* ===== Dropdown actions ===== */
        $(document).on('click', '.action-btn', function(e) {
            e.stopPropagation();
            const $dd = $(this).closest('.actions').find('.dropdown-menu');
            $('.dropdown-menu').not($dd).hide();
            $dd.toggle();
        });
        $(document).on('click', function() {
            $('.dropdown-menu').hide();
        });

        /* ===== Détail ===== */
        $(document).on('click', '.js-detail', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const $tr = $(`tr[data-id="${id}"]`);

            const website = $tr.data('website') || '';

            $('#detailOrgLogo').attr('src', $tr.data('logo') || placeholderLogo);
            $('#detailOrgName').text($tr.find('.org-name span').text() || '—');
            $('#detailOrgDomain').text($tr.data('domaine') || '—');
            $('#detailOrgEmail').text($tr.data('orgemail') || '—');
            $('#detailOrgPhone').text($tr.data('orgphone') || '—');
            $('#detailOrgMatricule').text($tr.data('orgmatricule') || '—');
            $('#detailOrgAddress').text($tr.data('orgaddress') || '—');
            $('#detailOrgWebsite').attr('href', website ? (website.match(/^https?:\/\//) ? website :
                    'http://' + website) : '#')
                .text(website || '—');

            $('#detailContactAvatar').attr('src', $tr.data('contactavatar') || placeholderAvatar);
            $('#detailContactName').text($tr.data('contactname') || '—');
            $('#detailContactEmail').text($tr.data('contactemail') || '—');
            $('#detailContactPhone').text($tr.data('contactphone') || '—');
            $('#detailContactFunction').text($tr.data('contactfunction') || '—');

            $('#detailContactModal').css('display', 'flex');
        });

        /* ===== Edit ===== */
        let editingId = null;
        window.openEditContactModal = function(el) {
            const $tr = $(el).closest('tr');
            editingId = $tr.data('id');

            const orgLogo = $tr.data('logo');
            const contactAvatar = $tr.data('contactavatar');

            $('#editOrgLogoPreview').attr('src', orgLogo || '').toggle(!!orgLogo);
            $('#editOrgLogoPlaceholder i').toggle(!orgLogo);

            $('#editContactAvatarPreview').attr('src', contactAvatar || '').toggle(!!contactAvatar);
            $('#editContactAvatarPlaceholder i').toggle(!contactAvatar);

            $('#editOrgName').val($tr.find('.org-name span').text());
            $('#editOrgDomain').val($tr.data('domaine'));
            $('#editOrgEmail').val($tr.data('orgemail'));
            $('#editOrgPhone').val($tr.data('orgphone'));
            $('#editOrgWebsite').val($tr.data('website'));
            $('#editOrgAddress').val($tr.data('orgaddress'));
            $('#editOrgMatricule').val($tr.data('orgmatricule'));

            $('#editContactName').val($tr.data('contactname'));
            $('#editContactEmail').val($tr.data('contactemail'));
            $('#editContactPhone').val($tr.data('contactphone'));
            $('#editContactFunction').val($tr.data('contactfunction'));

            $('#editContactModal').css('display', 'flex');
        };

        $(document).on('click', '.js-edit', function(e) {
            e.preventDefault();
            openEditContactModal(this);
        });

        $('#btnEditSave').on('click', async function() {
            if (!editingId) return;

            const payload = {
                institution: $('#editOrgName').val().trim(),
                domaine: $('#editOrgDomain').val().trim(),
                org_email: $('#editOrgEmail').val().trim(),
                org_tel: $('#editOrgPhone').val().trim(),
                website: $('#editOrgWebsite').val().trim(),
                org_address: $('#editOrgAddress').val().trim(),
                matricule: $('#editOrgMatricule').val().trim(),
                contact_nom: $('#editContactName').val().trim(),
                contact_email: $('#editContactEmail').val().trim(),
                contact_tel: $('#editContactPhone').val().trim(),
                contact_function: $('#editContactFunction').val().trim(),
            };

            const logoSrc = $('#editOrgLogoPreview').attr('src') || '';
            const avatarSrc = $('#editContactAvatarPreview').attr('src') || '';

            if (logoSrc.startsWith('data:image')) payload.logo_url = logoSrc;
            if (avatarSrc.startsWith('data:image')) payload.contact_avatar_url = avatarSrc;

            if (!payload.institution) {
                return alert("Le nom de l'organisation est requis.");
            }

            try {
                const res = await fetch(`${API}/contact/${editingId}`, {
                    method: 'PUT',
                    headers: {
                        'X-WP-Nonce': NONCE,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
                });
                const body = res.ok ? await res.json() : await res.json().catch(() => ({
                    message: `HTTP ${res.status}`
                }));
                if (!res.ok) throw new Error(body.message || 'Erreur sauvegarde');

                const $tr = $(`tr[data-id="${editingId}"]`);
                const newHtml = $(renderRow(body));
                dt.row($tr).remove().draw(false);
                dt.row.add(newHtml).draw(false);
                closeModal('#editContactModal');
            } catch (e) {
                console.error(e);
                alert("Impossible d’enregistrer la modification.");
            }
        });

        /* ===== Add ===== */
        $('#btnAddSave').on('click', async function() {
            const payload = {
                institution: $('#addOrgName').val().trim(),
                domaine: $('#addOrgDomain').val().trim(),
                org_email: $('#addOrgEmail').val().trim(),
                org_tel: $('#addOrgPhone').val().trim(),
                website: $('#addOrgWebsite').val().trim(),
                matricule: $('#addOrgMatricule').val().trim(),
                org_address: $('#addOrgAddress').val().trim(),
                logo_url: $('#orgLogoPreview').attr('src') || '',
                contact_nom: $('#addContactName').val().trim(),
                contact_email: $('#addContactEmail').val().trim(),
                contact_tel: $('#addContactPhone').val().trim(),
                contact_function: $('#addContactFunction').val().trim(),
                contact_avatar_url: $('#contactAvatarPreview').attr('src') || ''
            };
            if (!payload.institution || !payload.contact_nom) {
                return alert(
                    'Veuillez renseigner au minimum "Nom Organisation" et "Nom et prénom" du contact.'
                );
            }

            try {
                const res = await fetch(`${API}/contact`, {
                    method: 'POST',
                    headers: {
                        'X-WP-Nonce': NONCE,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
                });
                const body = res.ok ? await res.json() : await res.json().catch(() => ({
                    message: `HTTP ${res.status}`
                }));
                if (!res.ok) throw new Error(body.message || 'Erreur création');

                const $row = $(renderRow(body));
                dt.row.add($row).draw();
                dt.page('last').draw(false);

                $('#addForm')[0].reset();
                $('#orgLogoPreview').hide();
                $('#orgLogoPlaceholder i').show();
                $('#contactAvatarPreview').hide();
                $('#contactAvatarPlaceholder i').show();
                closeModal('#addContactModal');
            } catch (e) {
                console.error(e);
                alert("Impossible d’ajouter le contact.");
            }
        });

        /* ===== Delete ===== */
        $(document).on('click', '.js-delete', async function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (!confirm('Supprimer ce contact ?')) return;

            try {
                const res = await fetch(`${API}/contact/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-WP-Nonce': NONCE,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                if (!res.ok && res.status !== 204) {
                    const body = await res.json().catch(() => ({
                        message: `HTTP ${res.status}`
                    }));
                    throw new Error(body.message || 'Erreur suppression');
                }
                const $tr = $(`tr[data-id="${id}"]`);
                dt.row($tr).remove().draw(false);
            } catch (e) {
                console.error(e);
                alert("Suppression impossible.");
            }
        });

        /* ===== Check-all ===== */
        $('#checkAll').on('change', function() {
            const rows = dt.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        $('#contactsTableBody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                const el = $('#checkAll').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        /* ===== Quill ===== */
        const quill = new Quill('#objectifSpecifique', {
            theme: 'snow',
            placeholder: 'Ajouter un commentaire...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    [{
                        'list': 'bullet'
                    }]
                ]
            }
        });

        /* ===== Boot ===== */
        loadContacts();

    })(jQuery);
    </script>
</body>

</html>