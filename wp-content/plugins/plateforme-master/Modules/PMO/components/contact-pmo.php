<?php if (!defined('ABSPATH'))
    exit; ?>
<?php
// Expose WP REST root + nonce côté JS (fallback si wpApiSettings n’est pas là)
if (is_user_logged_in()): ?>
    <script>
        window.pmsettings = {
            rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
            nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
        };
    </script>
<?php endif; ?>

<!-- Fonts / Icons / DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f9fafb
    }

    .content-block {
        background: #fff;
        border-radius: 10px;
        padding: 24px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .05)
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px
    }

    .dashboard-sub-title {
        font-weight: 700;
        font-size: 1.5rem;
        display: flex;
        align-items: center
    }

    .add-contact-btn {
        background: #c60000;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px
    }

    .add-contact-btn:hover {
        background: #a50000
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 10px 0
    }

    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-bottom: 30px
    }

    .search-input-wrapper {
        position: relative
    }

    .search-input {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: .6rem 2.5rem .6rem .75rem;
        background: #fdfdfd;
        font-size: 14px;
        height: 42px;
        width: 250px
    }

    .search-input-wrapper .fa-search {
        position: absolute;
        top: 50%;
        right: .85rem;
        transform: translateY(-50%);
        color: #6b7280
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: center
    }

    .icon-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background: #fdfdfd;
        color: #BF0404;
        cursor: pointer;
        font-size: 16px
    }

    .icon-btn:hover {
        background: #f5f5f5
    }

    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e0e0e0;
        border-radius: 12px
    }

    .styled-table th ead {
        background: #f3f1e9
    }

    .styled-table th,
    .styled-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0
    }

    .styled-table tbody tr:last-child td {
        border-bottom: none
    }

    .styled-table th {
        font-weight: 600
    }

    .styled-table td {
        vertical-align: middle
    }

    .org-name,
    .contact-person {
        display: flex;
        align-items: center;
        gap: 10px
    }

    .org-logo,
    .contact-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover
    }

    .org-logo {
        border: 1px solid #ddd
    }

    .actions {
        position: relative;
        display: inline-block
    }

    .action-btn {
        background: none;
        border: none;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer
    }

    /* DataTables footer / pagination */
    .datatable-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px
    }

    .dataTables_paginate {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #a50000
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
        color: #c60000 !important;
        border: 2px solid #c60000;
        border-radius: 8px;
        background: transparent
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        cursor: default;
        color: #aaa !important;
        border-color: #ddd;
        background: transparent;
        box-shadow: none
    }

    .pagination-page-info {
        order: 2;
        font-weight: 700;
        font-size: 16px;
        color: #333
    }

    /* Dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background: #fff;
        min-width: 160px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, .2);
        z-index: 10;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 6px 0
    }

    .dropdown-menu a {
        color: #222;
        padding: 10px 14px;
        display: block;
        font-size: 14px;
        text-decoration: none
    }

    .dropdown-menu a:hover {
        background: #f1f1f1
    }

    /* Modals */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .3);
        display: none;
        justify-content: flex-end;
        z-index: 999999
    }

    .popup-container {
        background: #fff;
        width: 480px;
        height: 100%;
        box-shadow: -4px 0 10px rgba(0, 0, 0, .1);
        overflow-y: auto
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        box-shadow: 0 5px 16px rgba(0, 0, 0, .16);
        margin-bottom: 20px
    }

    .popup-header h2 {
        font-size: 18px;
        color: #2A2916;
        font-weight: bold;
        margin: 0;
    }

    .popup-form {
        padding: 0 25px
    }

    .popup-form h3 {
        font-size: 15px;
        font-weight: 700;
        margin: 8px 0 12px;
    }

    .popup-form .form-group {
        margin-bottom: 14px
    }

    .popup-form label {
        display: block;
        font-weight: 500;
        color: #A6A59F;
        margin-bottom: 8px;
        font-size: 14px
    }

    .popup-form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box
    }

    .popup-form .row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px
    }

    .btn-enregistrer {
        background: #c62828;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 700
    }

    .logo-upload-placeholder {
        width: 100px;
        height: 100px;
        border: 2px dashed #ccc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-bottom: 10px;
        position: relative;
        overflow: hidden
    }

    .logo-upload-placeholder i {
        font-size: 2rem;
        color: #ccc
    }

    .logo-upload-placeholder .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    /* Detail modal */
    #detailContactModal .popup-header {
        display: none
    }

    #detailContactModal .popup-details {
        padding: 25px
    }

    .detail-header {
        text-align: center;
        margin-bottom: 18px
    }

    .detail-logo,
    .detail-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 10px;
        border: 1px solid #eee;
        display: block
    }

    .detail-name {
        font-weight: 700;
        font-size: 1.15rem;
        margin: 0;
        color: #333
    }

    .detail-info-item {
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ebeae4
    }

    .detail-info-item:last-child {
        border-bottom: none;
        margin-bottom: 0
    }

    .detail-info-item .label {
        display: block;
        font-weight: 500;
        color: #605E3E;
        font-size: 14px;
        margin-bottom: 3px
    }

    .detail-info-item .value {
        display: block;
        color: #333;
        font-size: 15px
    }

    /* ---------- Table ---------- */
    .styled-table {
        width: 100%;
        border-collapse: collapse
    }

    .styled-table thead {
        background: #f3f1e9
    }

    .styled-table th,
    .styled-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #eee
    }

    .styled-table tbody tr:hover {
        background: #fafafa
    }


    #contactsTable {
        border: none !important;
        box-shadow: none !important;
        border-collapse: separate;
        border-spacing: 0
    }


    #contactsTable th {
        border: 0
    }


    #contactsTable td {
        border: 1px solid var(--line)
    }


    #contactsTable thead {
        position: static;
        transform: translateY(-15px)
    }


    #contactsTable tbody tr:first-child td {
        border-top: 1px solid var(--line) !important
    }

    /* arrondis */

    #contactsTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px
    }


    #contactsTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px
    }


    #contactsTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px
    }


    #contactsTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px
    }


    #contactsTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px
    }


    #contactsTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px
    }
</style>

<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img style="width:38px;height:38px;margin-right:8px;border-radius:4px"
                src="/wp-content/plugins/plateforme-master/images/newimages/building.png" alt="Building"
                onerror="this.onerror=null;this.src='https://placehold.co/38x38/c60000/FFFFFF?text=B';">
            Entreprises / Partenaires
        </h2>
        <button class="add-contact-btn" onclick="openAddContactModal()"><i class="fas fa-plus"></i> Ajouter
            contact</button>
    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="search-input-wrapper">
            <input class="search-input" id="searchInput" type="text" placeholder="Recherche...">
            <i class="fas fa-search"></i>
        </div>
        <div class="filter-actions">
            <button class="icon-btn" title="Vue card"><i class="fa fa-th-large"></i></button>
            <button class="icon-btn" title="Vue tableau"><i class="fa fa-list"></i></button>
            <button class="icon-btn" title="Export"><i class="fa fa-download"></i></button>
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
        <tbody id="contactsTableBody"></tbody>
    </table>

    <!-- Include Reusable Pagination Component -->
    <?php include 'pagination.php'; ?>
</div>

<!-- Modal: Ajouter -->
<div class="modal-overlay" id="addContactModal">
    <div class="popup-container" id="popupContainerAddContact">
        <div class="popup-header">
            <h2>Ajouter Contact</h2>
            <button class="btn-enregistrer" id="btnSaveContact">Enregistrer</button>
        </div>
        <form class="popup-form" onsubmit="return false;">
            <h3>Détails de l'organisation</h3>

            <label>Logo organisation</label>
            <div class="logo-upload-placeholder" id="orgLogoPlaceholder">
                <i class="fas fa-camera"></i>
                <img class="image-preview" id="orgLogoPreview" src="" alt="" style="display:none">
            </div>
            <input type="file" id="orgLogoInput" accept="image/*" style="display:none">

            <div class="form-group"><label>Nom Organisation</label>
                <input type="text" id="orgNameInput" placeholder="Nom Organisation">
            </div>
            <div class="row-2">
                <div class="form-group"><label>Domaine</label>
                    <input type="text" id="orgDomainInput" placeholder="Ex: IA Industrielle">
                </div>
                <div class="form-group"><label>Pays</label>
                    <input type="text" id="orgCountryInput" placeholder="Ex: Tunisie">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>E-mail organisation</label>
                    <input type="email" id="orgEmailInput" placeholder="ex: contact@org.tn">
                </div>
                <div class="form-group"><label>Téléphone</label>
                    <input type="text" id="orgPhoneInput" placeholder="+216 XX XX XX XX">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>Adresse</label>
                    <input type="text" id="orgAddressInput" placeholder="Adresse de l'organisation">
                </div>
                <div class="form-group"><label>Site web</label>
                    <input type="text" id="orgWebsiteInput" placeholder="https://...">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>Date début</label>
                    <input type="date" id="orgDateDebutInput">
                </div>
                <div class="form-group"><label>Date fin (optionnel)</label>
                    <input type="date" id="orgDateFinInput">
                </div>
            </div>

            <h3 style="font-weight:700;margin:8px 0 12px">Contact principal</h3>

            <label>Avatar</label>
            <div class="logo-upload-placeholder" id="contactAvatarPlaceholder">
                <i class="fas fa-camera"></i>
                <img class="image-preview" id="contactAvatarPreview" src="" alt="" style="display:none">
            </div>
            <input type="file" id="contactAvatarInput" accept="image/*" style="display:none">

            <div class="row-2">
                <div class="form-group"><label>Nom & prénom</label>
                    <input type="text" id="contactNameInput" placeholder="Nom & prénom">
                </div>
                <div class="form-group"><label>Fonction</label>
                    <input type="text" id="contactRoleInput" placeholder="Fonction">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>E-mail</label>
                    <input type="email" id="contactEmailInput" placeholder="email@exemple.com">
                </div>
                <div class="form-group"><label>Téléphone</label>
                    <input type="text" id="contactPhoneInput" placeholder="+216 XX XX XX XX">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Editer -->
<div class="modal-overlay" id="editContactModal">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier Contact</h2>
            <button class="btn-enregistrer" id="btnSaveEditContact">Enregistrer</button>
        </div>
        <form class="popup-form" onsubmit="return false;">
            <h3 style="font-weight:700;margin:8px 0 12px">Détails de l'organisation</h3>

            <label>Logo organisation</label>
            <div class="logo-upload-placeholder" id="editOrgLogoPlaceholder">
                <i class="fas fa-camera"></i>
                <img class="image-preview" id="editOrgLogoPreview" src="" alt="" style="display:none">
            </div>
            <input type="file" id="editOrgLogoInput" accept="image/*" style="display:none">

            <div class="form-group"><label>Nom Organisation</label>
                <input type="text" id="editOrgName" placeholder="Nom Organisation">
            </div>
            <div class="row-2">
                <div class="form-group"><label>Domaine</label>
                    <input type="text" id="editOrgDomain" placeholder="Domaine">
                </div>
                <div class="form-group"><label>Pays</label>
                    <input type="text" id="editOrgCountry" placeholder="Pays">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>E-mail organisation</label>
                    <input type="email" id="editOrgEmail" placeholder="E-mail organisation">
                </div>
                <div class="form-group"><label>Téléphone</label>
                    <input type="text" id="editOrgPhone" placeholder="+216 XX XX XX XX">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>Adresse</label>
                    <input type="text" id="editOrgAddress" placeholder="Adresse de l'organisation">
                </div>
                <div class="form-group"><label>Site web</label>
                    <input type="text" id="editOrgWebsite" placeholder="https://...">
                </div>
            </div>

            <h3 style="font-weight:700;margin:8px 0 12px">Contact principal</h3>

            <label>Avatar</label>
            <div class="logo-upload-placeholder" id="editContactAvatarPlaceholder">
                <i class="fas fa-camera"></i>
                <img class="image-preview" id="editContactAvatarPreview" src="" alt="" style="display:none">
            </div>
            <input type="file" id="editContactAvatarInput" accept="image/*" style="display:none">

            <div class="row-2">
                <div class="form-group"><label>Nom & prénom</label>
                    <input type="text" id="editContactName" placeholder="Nom & prénom">
                </div>
                <div class="form-group"><label>Fonction</label>
                    <input type="text" id="editContactRole" placeholder="Fonction">
                </div>
            </div>
            <div class="row-2">
                <div class="form-group"><label>E-mail</label>
                    <input type="email" id="editContactEmail" placeholder="E-mail">
                </div>
                <div class="form-group"><label>Téléphone</label>
                    <input type="text" id="editContactPhone" placeholder="+216 XX XX XX XX">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Détail -->
<div class="modal-overlay" id="detailContactModal">
    <div class="popup-container">
        <div class="popup-details">
            <div class="detail-header">
                <img src="" alt="Organization Logo" class="detail-logo" id="detailOrgLogo">
                <h3 class="detail-name" id="detailOrgName"></h3>
            </div>
            <div class="detail-info-item"><span class="label">Domaine :</span><span class="value"
                    id="detailOrgDomain"></span>
            </div>
            <div class="detail-info-item"><span class="label">Pays :</span><span class="value"
                    id="detailOrgCountry"></span>
            </div>
            <div class="detail-info-item"><span class="label">Email Organisation :</span><span class="value"
                    id="detailOrgEmail"></span></div>
            <div class="detail-info-item"><span class="label">Adresse :</span><span class="value"
                    id="detailOrgAddress"></span></div>
            <div class="detail-info-item"><span class="label">Téléphone :</span><span class="value"
                    id="detailOrgPhone"></span></div>
            <div class="detail-info-item"><span class="label">Site Web :</span><span class="value"><a href="#"
                        id="detailOrgWebsite" target="_blank"></a></span></div>

            <hr style="margin:14px 0;border:none;border-top:1px solid #eee">

            <div class="detail-header">
                <img src="" alt="Contact Avatar" class="detail-avatar" id="detailContactAvatar">
                <h3 class="detail-name" id="detailContactName"></h3>
            </div>
            <div class="detail-info-item"><span class="label">Fonction :</span><span class="value"
                    id="detailContactRole"></span></div>
            <div class="detail-info-item"><span class="label">Email :</span><span class="value"
                    id="detailContactEmail"></span></div>
            <div class="detail-info-item"><span class="label">Téléphone :</span><span class="value"
                    id="detailContactPhone"></span></div>
        </div>
    </div>
</div>

<!-- JS libs -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    (function () {
        // ========= REST config =========
        const REST_ROOT =
            (window.pmsettings && pmsettings.rest_root) ||
            (window.wpApiSettings && wpApiSettings.root) ||
            '/wp-json/';
        const NONCE =
            (window.pmsettings && pmsettings.nonce) ||
            (window.wpApiSettings && wpApiSettings.nonce) ||
            '';
        const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

        // ========= DOM refs =========
        const tbody = document.getElementById('contactsTableBody');
        const addModal = document.getElementById('addContactModal');
        const editModal = document.getElementById('editContactModal');
        const detailModal = document.getElementById('detailContactModal');

        // ========= Helpers =========
        function openAddContactModal() {
            addModal.style.display = 'flex';
        }
        window.openAddContactModal = openAddContactModal; // usable from button onclick

        // Close modal when clicking overlay
        document.querySelectorAll('.modal-overlay').forEach(m => {
            m.addEventListener('click', (e) => {
                if (e.target === m) m.style.display = 'none';
            });
        });

        // Upload to WP media
        async function uploadToMedia(file) {
            if (!file) return null;

            console.log('Uploading file:', file.name, 'Size:', file.size);

            // Convert file to base64 for alternative upload method
            const base64 = await new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = () => resolve(reader.result);
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });

            // Try WordPress REST API first
            try {
                const fd = new FormData();
                fd.append('file', file, file.name || 'upload.jpg');

                const resp = await fetch(REST_ROOT.replace(/\/$/, '') + '/wp/v2/media', {
                    method: 'POST',
                    headers: {
                        'X-WP-Nonce': NONCE
                    },
                    body: fd,
                    credentials: 'same-origin'
                });

                if (resp.ok) {
                    const media = await resp.json();
                    console.log('Upload successful via REST API:', media);
                    return media?.source_url || null;
                } else {
                    console.warn('REST API upload failed, trying alternative method...');
                }
            } catch (e) {
                console.warn('REST API upload error, trying alternative method:', e);
            }

            // Alternative: Use custom endpoint or direct file handling
            try {
                const resp = await fetch(`${API}/upload-media`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': NONCE
                    },
                    body: JSON.stringify({
                        file_name: file.name,
                        file_data: base64,
                        file_type: file.type
                    }),
                    credentials: 'same-origin'
                });

                if (resp.ok) {
                    const result = await resp.json();
                    console.log('Upload successful via custom endpoint:', result);
                    return result.url || null;
                } else {
                    throw new Error('Custom upload failed: ' + resp.status);
                }
            } catch (e) {
                console.error('All upload methods failed:', e);
                // Fallback: return a placeholder or handle gracefully
                alert(
                    'Impossible d\'uploader l\'image. Veuillez vérifier vos permissions ou contacter l\'administrateur.'
                );
                return null;
            }
        }

        // Format row
        function renderRow(r) {
            console.log('Rendering row for contact ID:', r.id, 'Institution:', r.institution, 'Logo URL:', r.logo_url,
                'Avatar URL:', r.avatar_url);
            const logo = r.logo_url || 'https://placehold.co/32x32/cccccc/FFFFFF?text=LOGO';
            const avatar = r.avatar_url || 'https://placehold.co/32x32/f3f1e9/000?text=C';
            const tel = r.contact_tel || '';
            const email = r.contact_email || '';
            const inst = r.institution || '';
            const dom = r.type_collab || '';
            const cn = r.contact_nom || '';

            return `
      <tr data-id="${r.id}">
        <td><input type="checkbox"></td>
        <td>
          <div class="org-name">
            <img src="${logo}" class="org-logo" onerror="this.onerror=null;this.src='https://placehold.co/32x32/cccccc/FFFFFF?text=LOGO';">
            <span>${inst}</span>
          </div>
        </td>
        <td>${dom}</td>
        <td>
          <div class="contact-person">
            <img src="${avatar}" class="contact-avatar" onerror="this.onerror=null;this.src='https://placehold.co/32x32/f3f1e9/000?text=C';">
            <span>${cn}</span>
          </div>
        </td>
        <td>${tel}</td>
        <td>${email}</td>
        <td>
          <div class="actions">
            <button class="action-btn" title="Actions">...</button>
            <div class="dropdown-menu">
              <a href="#" class="js-edit">Modifier</a>
              <a href="#" class="js-detail">Détail</a>
              <a href="#" class="js-delete" style="color:#c00">Supprimer</a>
            </div>
          </div>
        </td>
      </tr>
    `;
        }

        let dt = null;

        async function loadContacts() {
            console.log('Loading contacts from:', `${API}/reseaux`);
            console.log('Using nonce:', NONCE);

            const resp = await fetch(`${API}/reseaux`, {
                headers: {
                    'X-WP-Nonce': NONCE,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            console.log('API Response status:', resp.status);

            if (!resp.ok) {
                const errorText = await resp.text();
                console.error('API /reseaux failed:', resp.status, errorText);
                alert('Erreur lors du chargement des contacts: ' + resp.status + ' - ' + errorText);
                return;
            }

            const rows = await resp.json();
            console.log('Loaded contacts data:', rows);
            console.log('Number of contacts:', rows.length);

            // Debug: Check if any contacts have image URLs
            rows.forEach((contact, index) => {
                console.log(`Contact ${index}:`, {
                    institution: contact.institution,
                    logo_url: contact.logo_url,
                    avatar_url: contact.avatar_url,
                    has_logo: !!contact.logo_url,
                    has_avatar: !!contact.avatar_url
                });
            });

            // 1) détruire l'instance existante
            if (dt) {
                dt.destroy(); // retire la structure DataTables
                dt = null;
            }

            // 2) réécrire le tbody
            const html = rows.map(renderRow).join('');
            document.getElementById('contactsTableBody').innerHTML = html;

            // 3) ré-initialiser DataTables
            dt = $('#contactsTable').DataTable({
                paging: true,
                pagingType: 'simple',
                ordering: false,
                info: false,
                pageLength: 5,
                dom: '<"top">rt<"clear">', // Hide default search (f) and length (l) controls
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    },
                    emptyTable: "Aucune donnée disponible",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                }
            });

            // Initialize reusable pagination component
            PMOPagination.init(dt);

            // 4) relier la recherche externe (évite les doublons de listeners)
            $('#searchInput').off('keyup').on('keyup', function () {
                dt.search(this.value).draw();
            });
        }
        // Easy Pagination Customization Function 
        window.customizePagination = function (options) {
            PMOPagination.customize(options);
        };

        // ========= Dropdown actions =========
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.action-btn');
            if (btn) {
                e.stopPropagation();
                const menu = btn.nextElementSibling;
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.style.display = 'none';
                });
                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
            } else {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
            }
        });

        // ========= Check-all =========
        document.getElementById('checkAll').addEventListener('change', function () {
            const rows = dt.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // ========= Image previews (Add) =========
        const orgLogoPlaceholder = document.getElementById('orgLogoPlaceholder');
        const orgLogoInput = document.getElementById('orgLogoInput');
        const orgLogoPreview = document.getElementById('orgLogoPreview');
        orgLogoPlaceholder.addEventListener('click', () => orgLogoInput.click());
        orgLogoInput.addEventListener('change', (ev) => {
            const f = ev.target.files[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = (e) => {
                orgLogoPreview.src = e.target.result;
                orgLogoPreview.style.display = 'block';
                orgLogoPlaceholder.querySelector('i').style.display = 'none';
            };
            r.readAsDataURL(f);
        });

        const contactAvatarPlaceholder = document.getElementById('contactAvatarPlaceholder');
        const contactAvatarInput = document.getElementById('contactAvatarInput');
        const contactAvatarPreview = document.getElementById('contactAvatarPreview');
        contactAvatarPlaceholder.addEventListener('click', () => contactAvatarInput.click());
        contactAvatarInput.addEventListener('change', (ev) => {
            const f = ev.target.files[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = (e) => {
                contactAvatarPreview.src = e.target.result;
                contactAvatarPreview.style.display = 'block';
                contactAvatarPlaceholder.querySelector('i').style.display = 'none';
            };
            r.readAsDataURL(f);
        });

        // ========= Image previews (Edit) =========
        const editOrgLogoPlaceholder = document.getElementById('editOrgLogoPlaceholder');
        const editOrgLogoInput = document.getElementById('editOrgLogoInput');
        const editOrgLogoPreview = document.getElementById('editOrgLogoPreview');
        editOrgLogoPlaceholder.addEventListener('click', () => editOrgLogoInput.click());
        editOrgLogoInput.addEventListener('change', (ev) => {
            const f = ev.target.files[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = (e) => {
                editOrgLogoPreview.src = e.target.result;
                editOrgLogoPreview.style.display = 'block';
                editOrgLogoPlaceholder.querySelector('i').style.display = 'none';
            };
            r.readAsDataURL(f);
        });

        const editContactAvatarPlaceholder = document.getElementById('editContactAvatarPlaceholder');
        const editContactAvatarInput = document.getElementById('editContactAvatarInput');
        const editContactAvatarPreview = document.getElementById('editContactAvatarPreview');
        editContactAvatarPlaceholder.addEventListener('click', () => editContactAvatarInput.click());
        editContactAvatarInput.addEventListener('change', (ev) => {
            const f = ev.target.files[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = (e) => {
                editContactAvatarPreview.src = e.target.result;
                editContactAvatarPreview.style.display = 'block';
                editContactAvatarPlaceholder.querySelector('i').style.display = 'none';
            };
            r.readAsDataURL(f);
        });

        // ========= ADD =========
        document.getElementById('btnSaveContact').addEventListener('click', async function () {
            try {
                // Required fields (API)
                const payload = {
                    institution: document.getElementById('orgNameInput').value.trim(),
                    pays: document.getElementById('orgCountryInput').value.trim() || '—',
                    type_collab: document.getElementById('orgDomainInput').value.trim(),
                    contact_nom: document.getElementById('contactNameInput').value.trim(),
                    contact_email: document.getElementById('contactEmailInput').value.trim(),
                    date_debut: document.getElementById('orgDateDebutInput').value || new Date()
                        .toISOString().slice(0, 10),

                    // Optionnels / + colonnes si présentes
                    date_fin: document.getElementById('orgDateFinInput').value || undefined,
                };

                // Validation minimale
                const req = ['institution', 'pays', 'type_collab', 'contact_nom', 'contact_email',
                    'date_debut'
                ];
                for (const k of req) {
                    if (!payload[k]) {
                        alert('Veuillez renseigner tous les champs requis.');
                        return;
                    }
                }

                // Uploads
                let logoUrl = null,
                    avatarUrl = null;

                // Upload logo if provided
                const logoFile = document.getElementById('orgLogoInput').files[0];
                if (logoFile) {
                    try {
                        logoUrl = await uploadToMedia(logoFile);
                        console.log('Logo uploaded successfully:', logoUrl);
                    } catch (e) {
                        console.error('Logo upload failed:', e);
                        alert('Erreur lors de l\'upload du logo: ' + e.message);
                        return;
                    }
                }

                // Upload avatar if provided
                const avatarFile = document.getElementById('contactAvatarInput').files[0];
                if (avatarFile) {
                    try {
                        avatarUrl = await uploadToMedia(avatarFile);
                        console.log('Avatar uploaded successfully:', avatarUrl);
                    } catch (e) {
                        console.error('Avatar upload failed:', e);
                        alert('Erreur lors de l\'upload de l\'avatar: ' + e.message);
                        return;
                    }
                }

                if (logoUrl) payload.logo_url = logoUrl;
                if (avatarUrl) payload.avatar_url = avatarUrl;

                const resp = await fetch(`${API}/reseaux`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': NONCE
                    },
                    body: JSON.stringify(payload),
                    credentials: 'same-origin'
                });
                if (!resp.ok) throw new Error('HTTP ' + resp.status + ': ' + await resp.text());

                addModal.style.display = 'none';
                // Reset simple
                document.getElementById('popupContainerAddContact').querySelector('form').reset();
                orgLogoPreview.style.display = 'none';
                contactAvatarPreview.style.display = 'none';
                orgLogoPlaceholder.querySelector('i').style.display = 'block';
                contactAvatarPlaceholder.querySelector('i').style.display = 'block';
                await loadContacts();
            } catch (e) {
                console.error(e);
                alert('Création impossible: ' + e.message);
            }
        });

        // ========= Row delegated actions (Edit / Detail / Delete) =========
        tbody.addEventListener('click', async (ev) => {
            const a = ev.target.closest('a');
            if (!a) return;
            ev.preventDefault();
            const tr = ev.target.closest('tr');
            const id = tr?.dataset?.id;
            console.log('Action clicked - tr:', tr, 'id:', id);

            if (!id || id === '0' || id === 0) {
                console.error('Invalid ID from table row:', id);
                return;
            }

            // ---- DETAIL ----
            if (a.classList.contains('js-detail')) {
                try {
                    const r = await (await fetch(`${API}/reseaux/${id}`, {
                        headers: {
                            'X-WP-Nonce': NONCE
                        }
                    })).json();
                    // Remplit le modal
                    document.getElementById('detailOrgLogo').src = r.logo_url ||
                        'https://placehold.co/100x100/cccccc/FFFFFF?text=LOGO';
                    document.getElementById('detailOrgName').textContent = r.institution || '';
                    document.getElementById('detailOrgDomain').textContent = r.type_collab || '';
                    document.getElementById('detailOrgCountry').textContent = r.pays || '';
                    document.getElementById('detailOrgEmail').textContent = r.contact_email || '';
                    document.getElementById('detailOrgAddress').textContent = r.adresse_org || '';
                    document.getElementById('detailOrgPhone').textContent = r.contact_tel || '';
                    const w = r.site_web || '';
                    const aW = document.getElementById('detailOrgWebsite');
                    aW.href = w ? (w.startsWith('http') ? w : 'https://' + w) : '#';
                    aW.textContent = w || '';

                    document.getElementById('detailContactAvatar').src = r.avatar_url ||
                        'https://placehold.co/100x100/f3f1e9/000?text=C';
                    document.getElementById('detailContactName').textContent = r.contact_nom || '';
                    document.getElementById('detailContactRole').textContent = r.contact_fonction || (
                        typeof r.fonction !== 'undefined' ? r.fonction : '');
                    document.getElementById('detailContactEmail').textContent = r.contact_email || '';
                    document.getElementById('detailContactPhone').textContent = r.contact_tel || '';

                    detailModal.style.display = 'flex';
                } catch (e) {
                    console.error(e);
                    alert('Impossible de charger le détail.');
                }
                return;
            }

            // ---- EDIT (ouvrir & pré-remplir) ----
            if (a.classList.contains('js-edit')) {
                console.log('Edit button clicked for ID:', id);
                if (!id || id === '0' || id === 0) {
                    console.error('Cannot edit: invalid ID:', id);
                    alert('Erreur: ID de contact invalide');
                    return;
                }
                try {
                    const r = await (await fetch(`${API}/reseaux/${id}`, {
                        headers: {
                            'X-WP-Nonce': NONCE
                        }
                    })).json();
                    editModal.dataset.editingId = id;
                    console.log('Edit modal opened for ID:', id);

                    // ORG
                    if (r.logo_url) {
                        editOrgLogoPreview.src = r.logo_url;
                        editOrgLogoPreview.style.display = 'block';
                        editOrgLogoPlaceholder.querySelector('i').style.display = 'none';
                    } else {
                        editOrgLogoPreview.style.display = 'none';
                        editOrgLogoPlaceholder.querySelector('i').style.display = 'block';
                    }
                    document.getElementById('editOrgName').value = r.institution || '';
                    document.getElementById('editOrgDomain').value = r.type_collab || '';
                    document.getElementById('editOrgCountry').value = r.pays || '';
                    document.getElementById('editOrgEmail').value = r.contact_email || '';
                    document.getElementById('editOrgPhone').value = r.contact_tel || '';
                    document.getElementById('editOrgAddress').value = r.adresse_org || '';
                    document.getElementById('editOrgWebsite').value = r.site_web || '';

                    // CONTACT
                    if (r.avatar_url) {
                        editContactAvatarPreview.src = r.avatar_url;
                        editContactAvatarPreview.style.display = 'block';
                        editContactAvatarPlaceholder.querySelector('i').style.display = 'none';
                    } else {
                        editContactAvatarPreview.style.display = 'none';
                        editContactAvatarPlaceholder.querySelector('i').style.display = 'block';
                    }
                    document.getElementById('editContactName').value = r.contact_nom || '';
                    document.getElementById('editContactRole').value = r.contact_fonction || (typeof r
                        .fonction !== 'undefined' ? r.fonction : '');
                    document.getElementById('editContactEmail').value = r.contact_email || '';
                    document.getElementById('editContactPhone').value = r.contact_tel || '';

                    editModal.style.display = 'flex';
                } catch (e) {
                    console.error(e);
                    alert('Impossible de charger la fiche à modifier.');
                }
                return;
            }

            // ---- DELETE ----
            if (a.classList.contains('js-delete')) {
                if (!confirm('Supprimer ce contact ?')) return;
                try {
                    const resp = await fetch(`${API}/reseaux/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-WP-Nonce': NONCE
                        },
                        credentials: 'same-origin'
                    });
                    if (!resp.ok) throw new Error('HTTP ' + resp.status + ': ' + await resp.text());
                    await loadContacts();
                } catch (err) {
                    console.error(err);
                    alert('Suppression impossible: ' + err.message);
                }
                return;
            }
        });

        // ========= SAVE EDIT =========
        document.getElementById('btnSaveEditContact').addEventListener('click', async function () {
            const id = editModal.dataset.editingId;
            console.log('Edit save - ID:', id);

            if (!id || id === '0' || id === 0) {
                console.error('Invalid edit ID:', id);
                editModal.style.display = 'none';
                return;
            }
            try {
                let logoUrl = null,
                    avatarUrl = null;

                // Upload logo if provided
                const editLogoFile = document.getElementById('editOrgLogoInput').files[0];
                if (editLogoFile) {
                    try {
                        logoUrl = await uploadToMedia(editLogoFile);
                        console.log('Edit logo uploaded successfully:', logoUrl);
                    } catch (e) {
                        console.error('Edit logo upload failed:', e);
                        alert('Erreur lors de l\'upload du logo: ' + e.message);
                        return;
                    }
                }

                // Upload avatar if provided
                const editAvatarFile = document.getElementById('editContactAvatarInput').files[0];
                if (editAvatarFile) {
                    try {
                        avatarUrl = await uploadToMedia(editAvatarFile);
                        console.log('Edit avatar uploaded successfully:', avatarUrl);
                    } catch (e) {
                        console.error('Edit avatar upload failed:', e);
                        alert('Erreur lors de l\'upload de l\'avatar: ' + e.message);
                        return;
                    }
                }

                const payload = {
                    institution: document.getElementById('editOrgName').value.trim(),
                    type_collab: document.getElementById('editOrgDomain').value.trim(),
                    pays: document.getElementById('editOrgCountry').value.trim(),
                    contact_nom: document.getElementById('editContactName').value.trim(),
                    contact_email: document.getElementById('editContactEmail').value.trim(),
                    contact_tel: document.getElementById('editContactPhone').value.trim(),
                    adresse_org: document.getElementById('editOrgAddress').value.trim(),
                    site_web: document.getElementById('editOrgWebsite').value.trim(),
                };
                if (logoUrl) payload.logo_url = logoUrl;
                if (avatarUrl) payload.avatar_url = avatarUrl;

                const resp = await fetch(`${API}/reseaux/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': NONCE
                    },
                    body: JSON.stringify(payload),
                    credentials: 'same-origin'
                });
                if (!resp.ok) throw new Error('HTTP ' + resp.status + ': ' + await resp.text());

                editModal.style.display = 'none';
                await loadContacts();
            } catch (e) {
                console.error(e);
                alert('Mise à jour impossible: ' + e.message);
            }
        });

        // ========= Boot =========
        // Pré-remplir date début à aujourd'hui pour le formulaire "Ajouter"
        const today = new Date().toISOString().slice(0, 10);
        const dd = document.getElementById('orgDateDebutInput');
        if (dd) dd.value = today;

        // Debug: Check current user and permissions
        console.log('REST API URL:', API);
        console.log('Nonce:', NONCE);
        console.log('Current page:', window.location.href);


        // Test upload permissions
        window.testUploadPermissions = async function () {
            console.log('Testing upload permissions...');
            try {
                const resp = await fetch(REST_ROOT.replace(/\/$/, '') + '/wp/v2/media', {
                    method: 'GET',
                    headers: {
                        'X-WP-Nonce': NONCE
                    },
                    credentials: 'same-origin'
                });
                console.log('Media API response:', resp.status, resp.ok);
                if (resp.ok) {
                    const data = await resp.json();
                    console.log('Media API data:', data);
                } else {
                    const error = await resp.text();
                    console.error('Media API error:', error);
                }
            } catch (e) {
                console.error('Media API test failed:', e);
            }
        };

        // Test authentication and permissions
        window.testAuthentication = async function () {
            console.log('Testing authentication...');
            try {
                const resp = await fetch('/wp-json/wp/v2/users/me', {
                    method: 'GET',
                    headers: {
                        'X-WP-Nonce': NONCE
                    },
                    credentials: 'same-origin'
                });
                console.log('User API response:', resp.status, resp.ok);
                if (resp.ok) {
                    const userData = await resp.json();
                    console.log('Current user:', userData.name, userData.roles);
                } else {
                    const error = await resp.text();
                    console.error('Authentication error:', error);
                }
            } catch (e) {
                console.error('Authentication test failed:', e);
            }
        };

        // Test database columns
        window.testDatabaseColumns = async function () {
            console.log('Testing database columns...');
            try {
                const resp = await fetch(API + '/reseaux', {
                    method: 'GET',
                    headers: {
                        'X-WP-Nonce': NONCE
                    },
                    credentials: 'same-origin'
                });
                console.log('Reseaux API response:', resp.status, resp.ok);
                if (resp.ok) {
                    const data = await resp.json();
                    console.log('Reseaux API data sample:', data[0]);
                    console.log('Total contacts:', data.length);
                    if (data[0]) {
                        console.log('Available columns:', Object.keys(data[0]));
                        console.log('Has logo_url:', 'logo_url' in data[0]);
                        console.log('Has avatar_url:', 'avatar_url' in data[0]);
                    } else {
                        console.log('No contacts found in database');
                    }
                } else {
                    const error = await resp.text();
                    console.error('Reseaux API error:', error);
                }
            } catch (e) {
                console.error('Reseaux API test failed:', e);
            }
        };

        // charger la liste
        if (document.readyState !== 'loading') loadContacts();
        else document.addEventListener('DOMContentLoaded', loadContacts);
    })();
</script>