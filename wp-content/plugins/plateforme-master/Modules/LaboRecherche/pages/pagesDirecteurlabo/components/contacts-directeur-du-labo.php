<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entreprises / Partenaires</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
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
        transition: background-color 0.2s;
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
        transition: background-color 0.2s;
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
        /* overflow: hidden; <-- This was causing the clipping issue */
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

    .pagination-bar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
        gap: 8px;
    }

    .pagination-bar .page-number {
        font-weight: bold;
    }

    .pagination-btn {
        width: 36px;
        height: 36px;
        border: 2px solid #c60000;
        border-radius: 8px;
        background-color: #fff;
        color: #c60000;
        cursor: pointer;
        font-weight: bold;
    }

    .pagination-btn.active {
        background-color: #c60000;
        color: #fff;
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
        /* Increased width for new form */
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

    .popup-form {
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

    .popup-form .form-section-title {
        font-weight: bold;
        font-size: 1rem;
        margin-top: 20px;
        margin-bottom: 15px;
        padding-bottom: 5px;
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
        /* Increased z-index */
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
    </style>
</head>

<body>
    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <span>
                    <img style="width: 38px; height: 38px; margin-right: 8px;  display: inline-block; border-radius: 4px;"
                        src="/wp-content/plugins/plateforme-master/images/newimages/building.png" alt=""></span>
                Entreprises / Partenaires
            </h2>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="search-input-wrapper">
                <input class="search-input" type="text" placeholder="Recherche...">
                <i class="fas fa-search"></i>
            </div>

            <div class="filter-actions">
                <button class="add-contact-btn" onclick="openAddContactModal()"><i class="fas fa-plus"></i> Ajouter
                    contact</button>
                <button class="icon-btn" title="Vue card">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="icon-btn" title="Vue tableau">
                    <i class="fas fa-list"></i>
                </button>
                <button class="icon-btn" title="Download">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Nom organisation</th>
                    <th>Domaine</th>
                    <th>Contact principal</th>
                    <th>Telephone</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="org-name">
                            <img src="/wp-content/plugins/plateforme-master/images/newimages/logo1.jpg"
                                alt="AI Tech Solutions Logo" class="org-logo">
                            <span>AI Tech Solutions</span>
                        </div>
                    </td>
                    <td>IA Industrielle</td>
                    <td>
                        <div class="contact-person">
                            <img src="/wp-content/plugins/plateforme-master/images/newimages/person1.jpg"
                                alt="Mr. Karim J." class="contact-avatar">
                            <span>Mr. Karim J.</span>
                        </div>
                    </td>
                    <td>+216 25 37 45 90</td>
                    <td>contact@ai-tech.com</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#">Modifier</a>
                                <a href="#">Détail</a>
                                <a href="#" onclick="openmodalObjectifs()">Documents manquants</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="org-name">
                            <img src="/wp-content/plugins/plateforme-master/images/newimages/logo2.png"
                                alt="Tech Solutions Logo" class="org-logo">
                            <span>Tech Solutions</span>
                        </div>
                    </td>
                    <td>IA Industrielle</td>
                    <td>
                        <div class="contact-person">
                            <img src="/wp-content/plugins/plateforme-master/images/newimages/person3.jpg"
                                alt="Mr. Mourad J." class="contact-avatar">
                            <span>Mr. Mourad J.</span>
                        </div>
                    </td>
                    <td>+216 25 37 45 90</td>
                    <td>contact@tech.com</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#">Modifier</a>
                                <a href="#">Détail</a>
                                <a href="#" onclick="openmodalObjectifs()">Documents manquants</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination-bar">
            <button class="pagination-btn"><i class="fas fa-chevron-left"></i><i
                    class="fas fa-chevron-left"></i></button>
            <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
            <span class="page-number">2</span>
            <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
            <button class="pagination-btn"><i class="fas fa-chevron-right"></i><i
                    class="fas fa-chevron-right"></i></button>
        </div>
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
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt=""></span>
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
                            src="/wp-content/plugins/plateforme-master/images/newimages/Image 30.png" alt=""></span>
                    <input type="text" placeholder="+216 XX XX XX XX">
                </div>
            </form>
        </div>
    </div>


    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
    // --- SCRIPT FOR MODALS AND QUILL EDITOR ---

    function openmodalObjectifs() {
        document.getElementById("modalObjectifs").style.display = "flex";
    }

    function openAddContactModal() {
        document.getElementById("addContactModal").style.display = "flex";
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

        // --- SCRIPT FOR IMAGE UPLOAD ---
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
    });
    </script>
</body>

</html>