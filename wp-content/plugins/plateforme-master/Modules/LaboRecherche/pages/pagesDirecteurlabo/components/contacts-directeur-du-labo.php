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
    margin: 16px 0;
}

.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding-bottom: 20px;
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

/* --- Final DataTables Pagination Styles --- */
.datatable-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 20px;
}

.dataTables_paginate {
    display: flex;
    align-items: center;
    gap: 16px;
    color: #a50000;
}

.dataTables_paginate .paginate_button {
    order: 2;
    /* Default order for buttons */
    width: 40px;
    height: 40px;
    border: 1px solid #ef8585;
    border-radius: 12px;
    background-color: #ff0000ff;
    color: #ef8585 !important;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: background-color 0.2s;
}

.dataTables_paginate .paginate_button#contactsTable_previous {
    order: 1;
    /* Previous button first */
}

.dataTables_paginate .paginate_button#contactsTable_next {
    order: 3;
    /* Next button last */
}

.dataTables_paginate .paginate_button:hover {
    background-color: #fef2f2;
}

.dataTables_paginate .paginate_button.disabled,
.dataTables_paginate .paginate_button.disabled:hover {
    border-color: #e0e0e0;
    color: #bdbdbd !important;
    cursor: default;
    background-color: #f5f5f5;
}

.pagination-page-info {
    order: 2;
    /* Page number in the middle */
    font-weight: bold;
    font-size: 16px;
    color: #333;
}

.dataTables_wrapper .dataTables_paginate .paginate_button,
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: .5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: red !important;
    border: 2px solid red;
    border-radius: 2px;
    background: transparent;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #ff0000ff !important;
    border: 2px solid red;
    background: transparent;
    box-shadow: none;
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

/* --- NEW: Styles for Detail Modal --- */
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
}

.detail-info-grid {
    display: grid;
    grid-template-columns: max-content 1fr;
    gap: 10px 15px;
    margin-bottom: 15px;
}

.detail-info-grid .label {
    font-weight: 500;
    color: #555;
}

.detail-info-grid .value {
    color: #333;
}
</style>

<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <span>
                <img style="width: 38px; height: 38px; margin-right: 8px;  display: inline-block; border-radius: 4px;"
                    src="/wp-content/plugins/plateforme-master/images/newimages/building.png" alt="Building Icon"
                    onerror="this.onerror=null;this.src='https://placehold.co/38x38/c60000/FFFFFF?text=B';"></span>
            Entreprises / Partenaires
        </h2>
    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="search-input-wrapper">
            <!-- Added ID for easier selection in JS -->
            <input class="search-input" id="searchInput" type="text" placeholder="Recherche...">
            <i class="fas fa-search"></i>
        </div>

        <div class="filter-actions">
            <button class="add-contact-btn" onclick="openAddContactModal()"><i class="fas fa-plus"></i> Ajouter
                contact</button>
            <button class="icon-btn" title="Vue card" style="background-color:#A6A485;">
                <!-- <i class="fas fa-th-large"></i> -->
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Composant 286 – 1.png"
                    alt="Composant 286 – 1.png">
            </button>
            <button class="icon-btn" title="Vue tableau">
                <!-- <i class="fas fa-list"></i> -->
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Composant 300 – 1.png"
                    alt="Composant 300 – 1.png">
            </button>
            <button class="icon-btn" title="Download">
                <!-- <i class="fas fa-download"></i> -->
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                    alt="upload-red.png">
            </button>
        </div>
    </div>

    <table class="styled-table" id="contactsTable">
        <thead>
            <tr>
                <!-- Added ID for easier selection in JS -->
                <th><input type="checkbox" id="checkAll"></th>
                <th>Nom organisation</th>
                <th>Domaine</th>
                <th>Contact principal</th>
                <th>Telephone</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- Added ID for easier selection in JS -->
        <tbody id="contactsTableBody">
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="org-name">
                        <img src="/wp-content/plugins/plateforme-master/images/newimages/logo1.jpg"
                            alt="AI Tech Solutions Logo" class="org-logo"
                            onerror="this.onerror=null;this.src='https://placehold.co/32x32/cccccc/FFFFFF?text=AI';">
                        <span>AI Tech Solutions</span>
                    </div>
                </td>
                <td>IA Industrielle</td>
                <td>
                    <div class="contact-person">
                        <img src="/wp-content/plugins/plateforme-master/images/newimages/person1.jpg" alt="Mr. Karim J."
                            class="contact-avatar"
                            onerror="this.onerror=null;this.src='https://placehold.co/32x32/f3f1e9/000000?text=K';">
                        <span>Mr. Karim J.</span>
                    </div>
                </td>
                <td>+216 25 37 45 90</td>
                <td>contact@ai-tech.com</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" onclick="openEditContactModal(this)">Modifier</a>
                            <a href="#" onclick="openDetailContactModal(this)">Détail</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="org-name">
                        <img src="/wp-content/plugins/plateforme-master/images/newimages/logo2.png"
                            alt="Tech Solutions Logo" class="org-logo"
                            onerror="this.onerror=null;this.src='https://placehold.co/32x32/cccccc/FFFFFF?text=TS';">
                        <span>Tech Solutions</span>
                    </div>
                </td>
                <td>IA Industrielle</td>
                <td>
                    <div class="contact-person">
                        <img src="/wp-content/plugins/plateforme-master/images/newimages/person3.jpg"
                            alt="Mr. Mourad J." class="contact-avatar"
                            onerror="this.onerror=null;this.src='https://placehold.co/32x32/f3f1e9/000000?text=M';">
                        <span>Mr. Mourad J.</span>
                    </div>
                </td>
                <td>+216 25 37 45 90</td>
                <td>contact@tech.com</td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" onclick="openEditContactModal(this)">Modifier</a>
                            <a href="#" onclick="openDetailContactModal(this)">Détail</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal for Missing Documents -->
<div class="modal-overlay" id="modalObjectifs" style="display: none;">
    <div class="popup-container" id="popupContainerObjectifs">
        <div class="popup-header">
            <h2>Définir les documents manquants</h2>
            <button class="btn-enregistrer" id="btnSaveObjectifs">Envoyer</button>
        </div>
        <form class="popup-form">
            <div class="editor-wrapper">
                <div id="objectifSpecifique" style="height: 150px;"></div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Adding a Contact -->
<div class="modal-overlay" id="addContactModal" style="display: none;">
    <div class="popup-container" id="popupContainerAddContact">
        <div class="popup-header">
            <h2>Ajouter Contact</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <h3 class="form-section-title">Détails de l'organisation</h3>
            <div class="form-group">
                <label>Logo organisation</label>
                <div class="logo-upload-placeholder" id="orgLogoPlaceholder">
                    <i class="fas fa-camera"></i>
                    <img class="image-preview" id="orgLogoPreview" src="" alt="Logo Preview" style="display: none;">
                </div>
                <input type="file" id="orgLogoInput" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Nom Organisation">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Domaine">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Matricule">
            </div>
            <div class="form-group">
                <input type="email" placeholder="E-mail organisation">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Adresse de l'organisation">
            </div>
            <div class="form-group input-with-icon">
                <span class="icon"><img style="width: 30px; border-radius: 2px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="Flag Icon"
                        onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                <input type="text" placeholder="+216 XX XX XX XX">
            </div>
            <div class="form-group input-with-icon">
                <input type="text" class="website-input" placeholder="Site web">
                <span class="icon icon-right">🌐</span>
            </div>

            <h3 class="form-section-title">Détails du contact principal</h3>
            <div class="form-group">
                <label>Avatar</label>
                <div class="logo-upload-placeholder" id="contactAvatarPlaceholder">
                    <i class="fas fa-camera"></i>
                    <img class="image-preview" id="contactAvatarPreview" src="" alt="Avatar Preview"
                        style="display: none;">
                </div>
                <input type="file" id="contactAvatarInput" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Nom et prénom">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Fonction">
            </div>
            <div class="form-group">
                <input type="email" placeholder="E-mail">
            </div>
            <div class="form-group input-with-icon">
                <span class="icon"><img style="width: 30px; border-radius: 2px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="Flag Icon"
                        onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                <input type="text" placeholder="+216 XX XX XX XX">
            </div>
        </form>
    </div>
</div>

<!-- Modal for Editing a Contact -->
<div class="modal-overlay" id="editContactModal" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier Contact</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <h3 class="form-section-title">Détails de l'organisation</h3>
            <div class="form-group">
                <label>Logo organisation</label>
                <div class="logo-upload-placeholder" id="editOrgLogoPlaceholder">
                    <i class="fas fa-camera"></i>
                    <img class="image-preview" id="editOrgLogoPreview" src="" alt="Logo Preview" style="display: none;">
                </div>
                <input type="file" id="editOrgLogoInput" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
                <input type="text" id="editOrgName" placeholder="Nom Organisation">
            </div>
            <div class="form-group">
                <input type="text" id="editOrgDomain" placeholder="Domaine">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Matricule">
            </div>
            <div class="form-group">
                <input type="email" id="editOrgEmail" placeholder="E-mail organisation">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Adresse de l'organisation">
            </div>
            <div class="form-group input-with-icon">
                <span class="icon"><img style="width: 30px; border-radius: 2px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="Flag Icon"
                        onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                <input type="text" id="editOrgPhone" placeholder="+216 XX XX XX XX">
            </div>
            <div class="form-group input-with-icon">
                <input type="text" class="website-input" placeholder="Site web">
                <span class="icon icon-right">🌐</span>
            </div>

            <h3 class="form-section-title">Détails du contact principal</h3>
            <div class="form-group">
                <label>Avatar</label>
                <div class="logo-upload-placeholder" id="editContactAvatarPlaceholder">
                    <i class="fas fa-camera"></i>
                    <img class="image-preview" id="editContactAvatarPreview" src="" alt="Avatar Preview"
                        style="display: none;">
                </div>
                <input type="file" id="editContactAvatarInput" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
                <input type="text" id="editContactName" placeholder="Nom et prénom">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Fonction">
            </div>
            <div class="form-group">
                <input type="email" placeholder="E-mail">
            </div>
            <div class="form-group input-with-icon">
                <span class="icon"><img style="width: 30px; border-radius: 2px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt="Flag Icon"
                        onerror="this.onerror=null;this.src='https://placehold.co/30x20/c60000/FFFFFF?text=TN';"></span>
                <input type="text" placeholder="+216 XX XX XX XX">
            </div>
        </form>
    </div>
</div>

<!-- ======================================================= -->
<!-- ============= NEW: Modal for Details ================== -->
<!-- ======================================================= -->
<div class="modal-overlay" id="detailContactModal" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Details Contact</h2>
        </div>
        <div class="popup-details">
            <div class="detail-header">
                <img src="" alt="Organization Logo" class="detail-logo" id="detailOrgLogo">
                <h3 class="detail-name" id="detailOrgName"></h3>
            </div>
            <div class="detail-info-grid">
                <span class="label">Domaine :</span>
                <span class="value" id="detailOrgDomain"></span>
                <span class="label">Matricule :</span>
                <span class="value">A45RGHKS-20255</span> <!-- Example static value -->
                <span class="label">Email Organisation :</span>
                <span class="value" id="detailOrgEmail"></span>
                <span class="label">Adresse Organisation :</span>
                <span class="value">Cité Khadhra 1003</span> <!-- Example static value -->
                <span class="label">Téléphone :</span>
                <span class="value" id="detailOrgPhone"></span>
                <span class="label">Site Web :</span>
                <span class="value"><a href="#" id="detailOrgWebsite" target="_blank"></a></span>
            </div>

            <h3 class="details-section-title">Détails du contact principal</h3>

            <div class="detail-header">
                <img src="" alt="Contact Avatar" class="detail-avatar" id="detailContactAvatar">
                <h3 class="detail-name" id="detailContactName"></h3>
            </div>
            <div class="detail-info-grid">
                <span class="label">Fonction :</span>
                <span class="value">Directeur</span> <!-- Example static value -->
                <span class="label">Email :</span>
                <span class="value" id="detailContactEmail"></span>
                <span class="label">Téléphone :</span>
                <span class="value" id="detailContactPhone"></span>
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

<script>
// --- SCRIPT FOR MODALS AND QUILL EDITOR ---

// function openmodalObjectifs() {
//     document.getElementById("modalObjectifs").style.display = "flex";
// }

function openAddContactModal() {
    document.getElementById("addContactModal").style.display = "flex";
}

// --- SCRIPT FOR EDIT MODAL ---
function openEditContactModal(element) {
    // Find the table row (tr) that contains the clicked "Modifier" link
    const row = element.closest('tr');

    // Extract data from the row's cells
    const orgLogoSrc = row.querySelector('.org-logo').src;
    const orgName = row.querySelector('.org-name span').textContent;
    const orgDomain = row.cells[2].textContent;
    const contactAvatarSrc = row.querySelector('.contact-avatar').src;
    const contactName = row.querySelector('.contact-person span').textContent;
    const phone = row.cells[4].textContent;
    const email = row.cells[5].textContent;

    // Populate the edit modal with the extracted data
    document.getElementById('editOrgLogoPreview').src = orgLogoSrc;
    document.getElementById('editOrgLogoPreview').style.display = 'block';
    document.getElementById('editOrgLogoPlaceholder').querySelector('i').style.display = 'none';

    document.getElementById('editOrgName').value = orgName;
    document.getElementById('editOrgDomain').value = orgDomain;
    document.getElementById('editOrgEmail').value = email;
    document.getElementById('editOrgPhone').value = phone;

    document.getElementById('editContactAvatarPreview').src = contactAvatarSrc;
    document.getElementById('editContactAvatarPreview').style.display = 'block';
    document.getElementById('editContactAvatarPlaceholder').querySelector('i').style.display = 'none';
    document.getElementById('editContactName').value = contactName;

    // Display the edit modal
    document.getElementById("editContactModal").style.display = "flex";
}

// --- NEW SCRIPT FOR DETAIL MODAL ---
function openDetailContactModal(element) {
    // Find the table row (tr) that contains the clicked "Détail" link
    const row = element.closest('tr');

    // Extract data from the row's cells
    const orgLogoSrc = row.querySelector('.org-logo').src;
    const orgName = row.querySelector('.org-name span').textContent;
    const orgDomain = row.cells[2].textContent;
    const orgPhone = row.cells[4].textContent;
    const orgEmail = row.cells[5].textContent;
    const contactAvatarSrc = row.querySelector('.contact-avatar').src;
    const contactName = row.querySelector('.contact-person span').textContent;
    // Assuming contact email and phone are the same as org for this example
    const contactEmail = orgEmail;
    const contactPhone = orgPhone;

    // Populate the detail modal with the extracted data
    document.getElementById('detailOrgLogo').src = orgLogoSrc;
    document.getElementById('detailOrgName').textContent = orgName;
    document.getElementById('detailOrgDomain').textContent = orgDomain;
    document.getElementById('detailOrgEmail').textContent = orgEmail;
    document.getElementById('detailOrgPhone').textContent = orgPhone;

    // Example for website link
    const website = "www.ai-solution.tn"; // Example static value
    const websiteLink = document.getElementById('detailOrgWebsite');
    websiteLink.href = 'http://' + website;
    websiteLink.textContent = website;

    document.getElementById('detailContactAvatar').src = contactAvatarSrc;
    document.getElementById('detailContactName').textContent = contactName;
    document.getElementById('detailContactEmail').textContent = contactEmail;
    document.getElementById('detailContactPhone').textContent = contactPhone;

    // Display the detail modal
    document.getElementById("detailContactModal").style.display = "flex";
}


document.addEventListener("DOMContentLoaded", function() {
    // Initialize Quill Editor
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

    // Close modals on outside click
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });

    // --- SCRIPT FOR IMAGE UPLOAD (ADD MODAL) ---
    const orgLogoPlaceholder = document.getElementById('orgLogoPlaceholder');
    const orgLogoInput = document.getElementById('orgLogoInput');
    const orgLogoPreview = document.getElementById('orgLogoPreview');

    const contactAvatarPlaceholder = document.getElementById('contactAvatarPlaceholder');
    const contactAvatarInput = document.getElementById('contactAvatarInput');
    const contactAvatarPreview = document.getElementById('contactAvatarPreview');

    orgLogoPlaceholder.addEventListener('click', () => orgLogoInput.click());
    contactAvatarPlaceholder.addEventListener('click', () => contactAvatarInput.click());

    orgLogoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                orgLogoPreview.src = e.target.result;
                orgLogoPreview.style.display = 'block';
                orgLogoPlaceholder.querySelector('i').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    contactAvatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                contactAvatarPreview.src = e.target.result;
                contactAvatarPreview.style.display = 'block';
                contactAvatarPlaceholder.querySelector('i').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    // --- SCRIPT FOR IMAGE UPLOAD (EDIT MODAL) ---
    const editOrgLogoPlaceholder = document.getElementById('editOrgLogoPlaceholder');
    const editOrgLogoInput = document.getElementById('editOrgLogoInput');
    const editOrgLogoPreview = document.getElementById('editOrgLogoPreview');

    const editContactAvatarPlaceholder = document.getElementById('editContactAvatarPlaceholder');
    const editContactAvatarInput = document.getElementById('editContactAvatarInput');
    const editContactAvatarPreview = document.getElementById('editContactAvatarPreview');

    editOrgLogoPlaceholder.addEventListener('click', () => editOrgLogoInput.click());
    editContactAvatarPlaceholder.addEventListener('click', () => editContactAvatarInput.click());

    editOrgLogoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                editOrgLogoPreview.src = e.target.result;
                editOrgLogoPreview.style.display = 'block';
                editOrgLogoPlaceholder.querySelector('i').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    editContactAvatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                editContactAvatarPreview.src = e.target.result;
                editContactAvatarPreview.style.display = 'block';
                editContactAvatarPlaceholder.querySelector('i').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });


    // --- SCRIPT FOR ACTION DROPDOWN ---
    function toggleDropdown(button) {
        // Close all other dropdowns first
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu !== button.nextElementSibling) {
                menu.style.display = 'none';
            }
        });
        // Toggle the clicked dropdown
        const menu = button.nextElementSibling;
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    // Attach event listeners to all action buttons
    document.querySelectorAll('.action-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            // Stop the click from bubbling up to the window
            event.stopPropagation();
            toggleDropdown(this);
        });
    });

    // Close dropdowns if clicking outside
    window.addEventListener('click', function(event) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    });

    // =================================================================
    // ========= DATATABLES INITIALIZATION AND FUNCTIONALITY ===========
    // =================================================================

    const table = $('#contactsTable').DataTable({
        paging: true,
        pagingType: 'simple',
        searching: true,
        ordering: false,
        info: false, // Turn off the default info
        pageLength: 5,
        language: {
            paginate: {
                previous: "<i class='fa fa-chevron-left'></i>",
                next: "<i class='fa fa-chevron-right'></i>"
            },
            emptyTable: "Aucune donnée disponible",
            zeroRecords: "Aucun enregistrement correspondant trouvé",
        },
        // Custom layout for footer
        "dom": '<"top">rt<"bottom"<"datatable-footer"p>><"clear">'
    });

    // Custom function to create and manage the page number display
    const updatePaginationDisplay = () => {
        const pageInfo = table.page.info();
        const currentPage = pageInfo.page + 1;
        let pageInfoSpan = $('.pagination-page-info');

        // If the span doesn't exist, create it
        if (pageInfoSpan.length === 0) {
            pageInfoSpan = $('<span class="pagination-page-info"></span>').insertAfter(
                '#contactsTable_previous');
        }

        // Update the text
        pageInfoSpan.text(currentPage);
    };

    // Initial display and on every page change
    updatePaginationDisplay();
    table.on('draw', updatePaginationDisplay);


    // Link custom search input to DataTable's search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });


    // --- CHECK ALL FUNCTIONALITY ---
    const checkAll = document.getElementById('checkAll');

    // Event listener for the main "check all" checkbox in the header
    checkAll.addEventListener('change', function() {
        // Get all checkboxes in the current view
        const rows = table.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle clicks on individual checkboxes
    $('#contactsTableBody').on('change', 'input[type="checkbox"]', function() {
        // If this checkbox is unchecked
        if (!this.checked) {
            var el = $('#checkAll').get(0);
            // If "check all" box is checked, uncheck it
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

});
</script>