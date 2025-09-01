<style>
.content-block {
    background: #fff;
    border-radius: 10px;
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
    padding: 8px 16px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
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
    border-radius: 8px;
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
    /* overflow: hidden;*/
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
    color: #555;
    font-size: 20px;
}

.action-menu {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

.dropdown-menu {
    background: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    padding: 8px;
    border-radius: 6px;
    display: none;
    position: absolute;
}

.pagination-bar {
    margin-top: 16px;
    display: flex;
    justify-content: center;
    gap: 6px;
}

.pagination-bar button {
    padding: 6px 10px;
    border: 1px solid #ccc;
    background: #fff;
    border-radius: 6px;
    cursor: pointer;
}

.search-box {
    display: flex;
    align-items: center;
    border: 2px solid #dcdac2;
    /* couleur beige clair */
    border-radius: 16px;
    padding: 1px 16px;
    width: 300px;
    background-color: #fff;
}

.search-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 18px;
    color: #666;
    background: transparent;
    font-family: 'Segoe UI', sans-serif;
}

.search-input::placeholder {
    color: #aaa;
}

.search-icon {
    color: #1c1c1c;
    font-size: 20px;
    margin-left: 12px;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 12px;
}

.custom-select {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 220px;
    padding: 10px 14px;
    border: 2px solid #dcdac2;
    border-radius: 12px;
    background: #fff;
    font-size: 16px;
    color: #aaa;
    font-family: 'Segoe UI', sans-serif;
    position: relative;
}

.custom-select::after {
    content: '';
    position: absolute;
    right: 38px;
    top: 50%;
    transform: translateY(-50%);
    height: 24px;
    border-left: 1px solid #dcdac2;
}

.select-icon {
    color: #2a2a2a;
    font-size: 16px;
    padding-left: 10px;
}


.filter-actions {
    display: flex;
    gap: 10px;
    margin-left: auto;
}

.icon-button {
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 12px;
    border: none;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.icon-button i {
    color: #b30000;
    font-size: 20px;
}

.action-wrapper {
    position: relative;
    display: inline-block;
}

.action-menu {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    padding: 5px;
}

.action-dropdown {
    position: absolute;
    top: 28px;
    right: 0;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 999;
    min-width: 140px;
}

.action-dropdown button {
    width: 100%;
    background: none;
    border: none;
    padding: 10px;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
}

.action-dropdown button:hover {
    background-color: #f0f0f0;
}

.btn-statut {
    background-color: #BF0404;
    color: white;
    border: none;
    padding: 7px 31px;
    font-size: 14px;
    border-radius: 6px;
    font-weight: 500;
    border-color: #BF0404;
}

.btn-ajouter-colonnes {
    background: #fff;
    color: #333;
    border: 1px solid #ccc;
    padding: 9px 14px;
    font-size: 14px;
    border-radius: 6px;
    margin-left: 8px;
    font-weight: 500;
}

.doc-count {
    font-weight: bold;
    margin-left: 4px;
    font-size: 13px;
}

.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 25px;
    padding: 0 4px;
}

.filter-selectgb {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.filter-input {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #d8d4b7;
    font-size: 14px;
    background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23888' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E") no-repeat right 10px center;
    background-size: 16px;
    padding-right: 35px;
    width: 220px;
}

.filter-select {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #d8d4b7;
    font-size: 14px;
    background: #fff;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-position: right 10px center;
    background-repeat: no-repeat;
    background-size: 12px;
    padding-right: 30px;
    width: 150px;
}

.filter-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.icon-btn {
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #d8d4b7;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #d71920;
    font-size: 18px;
    transition: background 0.2s;
}

.icon-btn:hover {
    background-color: #f8f8f8;
}

.btn-primary {
    background-color: #c60000;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 12px 20px;
    font-weight: bold;
    cursor: pointer;
}

.styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-family: 'Segoe UI', sans-serif;
}

.styled-table thead {
    background-color: #f3f1e9;
}

.styled-table th,
.styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #EBE9D7;
    text-align: center
}

.styled-table th {
    font-weight: 600;
}

.styled-table tbody tr:last-child td {
    border-bottom: none;
}

.styled-table .validation-icon {
    font-size: 1.2em;
}

.styled-table .validation-icon.success {
    color: #28a745;
}

.styled-table .validation-icon.pending {
    color: #ffc107;
}

.styled-table .validation-icon.rejected {
    color: #dc3545;
}

.styled-table .action-icon {
    font-size: 1.2em;
    color: #555;
    cursor: pointer;
    width: 20px;
}

.pagination-controls {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 20px;
    gap: 5px;
}

.pagination-controls button {
    border: 2px solid #BF0404;
    background-color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    color: #BF0404;
    font-weight: bold;
}

.pagination-controls button.active {
    background-color: #c60000;
    color: white;
    border-color: #c60000;
}

.pagination-controls span {
    padding: 5px 10px;
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
    display: flex;
    align-items: center;
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

a {
    color: inherit;
    text-decoration: none;
}

tbody tr td .cardX {
    border: 1px solid #0000001F;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #FFFFFF;
    text-align: center;
    width: fit-content;
    margin: auto;
    border-radius: 5px;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px;
    text-transform: capitalize;
    border: 2px solid transparent;
    font-family: 'Segoe UI', sans-serif;
}

.badge-success {
    color: #198754;
    background-color: #e6f7ee;
    border-color: #198754;
}

.badge-warning {
    color: #d89e00;
    background-color: #fff9e6;
    border-color: #d89e00;
}

.badge-danger {
    color: #d71920;
    background-color: #fff0f0;
    border-color: #d71920;
}

.validation-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 15px;
    background-color: #e9f5e9;
    color: #28a745;
    font-weight: 500;
    font-size: 0.9em;
}

.actions {
    position: relative;
    display: inline-block;
}

.action-btn {
    background-color: transparent;
    color: #2d2a12;
    border: 1px solid transparent;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s, box-shadow 0.2s;
    line-height: 1;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
    background-color: #e6e6de;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.accordion-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    border-top: 0px;
}

.accordion-tabs {
    display: flex;
    background: #f3f3f3;
    border-radius: 10px 10px 0 0;
    overflow: hidden;
}

.tab-btn {
    flex: 1;
    padding: 12px 20px;
    font-weight: 600;
    border: none;
    background: #A6A485;
    cursor: pointer;
    font-size: 21px;
    transition: 0.3s;
    letter-spacing: 0px;
    color: #fff;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

/* .tab-btn:first-child,
.tab-btn:nth-child(2),
.tab-btn:nth-child(3) {
    margin-right: 4px;
} */
.tab-btn:first-child {
    margin-right: 15px;
}

.tab-btn.active {
    background-color: #fff;
    color: #2A2916;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    box-shadow: inset 0 -3px 0 0 #fff;
}

.accordion-content {
    padding: 25px;
    padding-top: 35px;
    background: #fff;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
}

.btn-close-x {
    background: transparent;
    border: none;
    font-size: 24px;
    font-weight: bold;
    color: #d71920;
    cursor: pointer;
    padding: 4px 10px;
    line-height: 1;
    transition: color 0.2s ease;
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
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
}

.popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    box-shadow: 0px 5px 16px #00000029;
}

form.popup-form,
.popup-body {
    padding: 25px;
}

.popup-header h2 {
    font-size: 18px;
    margin: 0;
    color: #2A2916;
    font-weight: 600;
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

.popup-form .form-group {
    margin-bottom: 15px;
}

.popup-form .form-group .input-group {
    display: flex;
    gap: 10px;
}

.popup-form .form-group .input-wrapper {
    position: relative;
    flex: 1;
}

.popup-form input,
.popup-form select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 7px;
    font-size: 14px;
    box-sizing: border-box;
}

.popup-form .input-wrapper i {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    color: #888;
}

.jury-section {
    margin-bottom: 20px;
}

.jury-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    margin-bottom: 10px;
}

.jury-section-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.jury-section-subtitle {
    font-size: 14px;
    color: #888;
    margin: 5px 0 15px;
}

.jury-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.jury-member {
    display: flex;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #f0f0f0;
}

.jury-member:last-child {
    border-bottom: none;
}

.jury-member label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    width: 100%;
}

.jury-member img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.jury-member .member-info {
    display: flex;
    flex-direction: column;
}

.jury-member .member-info strong {
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.jury-member .member-info span {
    font-size: 13px;
    color: #777;
}

.jury-member input[type="checkbox"],
.jury-member input[type="radio"] {
    margin-right: 10px;
}

.jury-divider {
    border: none;
    border-top: 1px solid #eee;
    margin: 25px 0;
}

.validation-group {
    margin-top: 20px;
}

.validation-group strong {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
}

.validation-group label {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.validation-group input[type="radio"] {
    width: 20px !important;
}


/* Styles for the new status dropdown */
.status-header-container {
    position: relative;
}

.filter-icon {
    cursor: pointer;
    margin-left: 0px;
    color: #555;
    width: 20px;
}

.status-dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 100;
    padding: 10px;
    min-width: 160px;
}

.status-dropdown-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.status-dropdown-menu li {
    padding: 4px 0;
}

.status-dropdown-menu label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 400;
    /* Headers are bold, make this normal */
    cursor: pointer;
    color: #333;
}

tbody tr:first-child td {
    border-top: 1px solid #EBE9D7 !important;
}

th {
    border: 0px solid #EBE9D7;
}

td {
    border: 1px solid #EBE9D7;
}

thead {
    border: none !important;
    position: static;
    transform: translateY(-15px);
}

tbody tr:first-child td {
    border-top: 1px solid #EBE9D7 !important;
}

thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;

}

tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

tbody tr:first-child td:first-child {
    border-top-left-radius: 12px;
}

tbody tr:first-child td:last-child {
    border-top-right-radius: 12px;
}

tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

.ql-toolbar.ql-snow {
    border-radius: 6px 6px 0 0;
    background-color: #ecebe3;
    border: 1px solid #DBD9C3;
    box-sizing: border-box;
    font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
    padding: 8px;
}

.ql-container.ql-snow {
    border-radius: 0 0 6px 6px;
    font-size: 14px;
    border: 1px solid #DBD9C3;
}

.popup-body h3 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.member-view {
    margin-top: 20px;
}

.member-view h4 {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.member-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.member-item:last-child {
    border-bottom: none;
}

.member-item span {
    font-size: 14px;
}

.member-item .delete-icon {
    color: #c60000;
    cursor: pointer;
}
</style>
<div class="content-block">
    <div class="accordion-container">
        <!-- Tabs -->
        <div class="accordion-tabs">
            <button class="tab-btn active" data-tab="tab1">Liste des Commissions doctoral</button>
            <button class="tab-btn" data-tab="tab2">Historique des réunions</button>
        </div>

        <div class="accordion-content">

            <!-- Onglet 1 : Liste des Commissions doctoral -->
            <div class="tab-panel active" id="tab1">
                <div class="table-controls">
                    <div class="filter-selectgb">
                        <input type="text" class="filter-input" placeholder="Recherche...">
                        <select class="filter-select">
                            <option>President</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button class="icon-btn"><img
                                src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png" alt="Filter"
                                class="filter-icon" id="statusFilterIcon">
                        </button>
                        <button class="btn-primary" id="openCommissionModal">Créer une commission</button>
                    </div>
                </div>

                <table class="styled-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Identifiant</th>
                            <th>Président</th>
                            <th>Nbr. des membres</th>
                            <th>Période</th>
                            <th>Détails</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>56-00L</td>
                            <td>Mourad Ben hsin</td>
                            <td>6</td>
                            <td>12/04/2025 à 12/0124/2025</td>
                            <td><a href="#" class="open-details-modal cardX"><img class="action-icon"
                                        style="width: 20px;"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-eye.png"
                                        alt="Icon-eye.png"></a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-edit-2.png"
                                                alt="Icon-edit-2.png" class="action-icon"> Modifier</a>
                                        <a style="color: #BF0404;" href="#"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                                alt="Icon-trash-2.pn" class="delete-icon"> supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>56-00D</td>
                            <td>Ahlem Ben Aisa</td>
                            <td>3</td>
                            <td>12/04/2025 à 12/0124/2025</td>
                            <td><a href="#" class="open-details-modal cardX"><img class="action-icon"
                                        style="width: 20px;"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-eye.png"
                                        alt="Icon-eye.png"></a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-edit-2.png"
                                                alt="Icon-edit-2.png" class="action-icon"> Modifier</a>
                                        <a href="#" style="#BF0404"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                                alt="Icon-trash-2.pn" class="delete-icon"> supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>56-00A</td>
                            <td>Salim Mzehi</td>
                            <td>6</td>
                            <td>12/04/2025 à 12/0124/2025</td>
                            <td><a href="#" class="open-details-modal cardX"><img class="action-icon"
                                        style="width: 20px;"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-eye.png"
                                        alt="Icon-eye.png"></a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-edit-2.png"
                                                alt="Icon-edit-2.png" class="action-icon"> Modifier</a>
                                        <a href="#" style="#BF0404"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                                alt="Icon-trash-2.pn" class="delete-icon"> supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>56-00F</td>
                            <td>Salim Mzoughi</td>
                            <td>8</td>
                            <td>12/04/2025 à 12/0124/2025</td>
                            <td><a href="#" class="open-details-modal cardX"><img class="action-icon"
                                        style="width: 20px;"
                                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-eye.png"
                                        alt="Icon-eye.png"></a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-edit-2.png"
                                                alt="Icon-edit-2.png" class="action-icon"> Modifier</a>
                                        <a href="#" style="#BF0404"><img style="width: 20px;"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                                alt="Icon-trash-2.pn" class="delete-icon"> supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="pagination-controls">
                    <button><i class="fas fa-angle-double-left" style="color: #BF0404;"></i></button>
                    <button><i class="fas fa-angle-left" style="color: #BF0404;"></i></button>
                    <span>2</span>
                    <button><i class="fas fa-angle-right" style="color: #BF0404;"></i></button>
                    <button><i class="fas fa-angle-double-right" style="color: #BF0404;"></i></button>
                </div>
            </div>

            <!-- Onglet 2 : Historique des réunions -->
            <div class="tab-panel" id="tab2">
                <div class="table-controls">
                    <div class="filter-selectgb">
                        <input type="text" class="filter-input" placeholder="Recherche...">
                        <select class="filter-select">
                            <option>President</option>
                        </select>
                        <select class="filter-select">
                            <option>Date</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button class="icon-btn"><img
                                src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png" alt="Filter"
                                class="filter-icon" id="statusFilterIcon"></button>
                    </div>
                </div>

                <table class="styled-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Date & Heure</th>
                            <th>Président</th>
                            <th>Lieu / Visio</th>
                            <th>Sujet</th>
                            <th>PV</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>27/08/2025 - 14h00</td>
                            <td>Mourad Ben hsin</td>
                            <td>Salle A / Zoom</td>
                            <td>Évaluation des dossiers d'inscription et de réinscription en doctorat</td>
                            <td><a href="#"><img
                                        src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                        alt="Filter" class="action-icon" id="statusFilterIcon">
                                </a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#">Voir détails</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>15/07/2025 - 09H30</td>
                            <td>Ahlem Ben Aisa</td>
                            <td>Salle Conseil</td>
                            <td>Examen des demandes de cotutelle internationale et conventions de mobilité</td>
                            <td><a href="#"><img
                                        src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                        alt="Filter" class="filter-icon" id="statusFilterIcon">
                                </a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#">Voir détails</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>20/06/2025 - 10H00</td>
                            <td>Salim Mzehi</td>
                            <td>MS Teams</td>
                            <td>Validation des propositions de jury et des autorisations de soutenance</td>
                            <td><a href="#"><img
                                        src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                        alt="Filter" class="action-icon" id="statusFilterIcon">

                                </a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#">Voir détails</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>20/06/2025 - 10H00</td>
                            <td>Salim Mzoughi</td>
                            <td>MS Teams</td>
                            <td>Suivi des parcours doctoraux et examen des demandes administratives</td>
                            <td><a href="#"><img
                                        src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                        alt="Filter" class="action-icon" id="statusFilterIcon">
                                </a>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn">...</button>
                                    <div class="dropdown-menu">
                                        <a href="#">Voir détails</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination-controls">
                    <button><i class="fas fa-angle-double-left" style="color: #BF0404;"></i></button>
                    <button><i class="fas fa-angle-left" style="color: #BF0404;"></i></button>
                    <span>2</span>
                    <button><i class="fas fa-angle-right" style="color: #BF0404;"></i></button>
                    <button><i class="fas fa-angle-double-right" style="color: #BF0404;"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalObjectifs" style="display: none;">
    <div class="popup-container" id="popupContainerObjectifs">
        <div class="popup-header">
            <h2>Details membres de commission</h2>
            <button class="btn-close-x" onclick="closeModal('modalObjectifs')">&times;</button>
        </div>
        <div class="popup-body">
            <h3>Liste des membres</h3>
            <div class="jury-list">
                <div class="jury-member">
                    <img src="https://i.pravatar.cc/40?u=salah" alt="Avatar">
                    <div class="member-info">
                        <strong>Mr. Salah Ben Hsin</strong>
                        <span>Maitre Assistant, ENIT</span>
                    </div>
                </div>
                <div class="jury-member">
                    <img src="https://i.pravatar.cc/40?u=mourad" alt="Avatar">
                    <div class="member-info">
                        <strong>Mr. Mourad Hammami</strong>
                        <span>Professeur, ENIT</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalCommission" style="display: none;">
    <div class="popup-container" id="popupContainerCommission">
        <div class="popup-header">
            <h2>Créer commission</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <input type="text" placeholder="Identifiant De La Commission">
            </div>
            <div class="form-group">
                <div class="input-wrapper">
                    <input type="text" placeholder="Periode" onfocus="(this.type='date')">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="form-group">
                <select>
                    <option>President</option>
                </select>
            </div>
            <div class="form-group">
                <select>
                    <option>Sélectionner Les Membres</option>
                </select>
            </div>
            <div class="member-view">
                <h4>Vue En Liste Des Membres</h4>
                <div class="member-item">
                    <span>Ahmed Ben Ahmed</span>
                    <i class="fas fa-trash-alt delete-icon"></i>
                </div>
                <div class="member-item">
                    <span>Asala Saied</span>
                    <i class="fas fa-trash-alt delete-icon"></i>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modalJury" style="display: none;">
    <div class="popup-container" id="popupContainerJury">
        <div class="popup-header">
            <h2>Affecter jurys</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <div class="popup-body">
            <div class="jury-section">
                <div class="jury-section-header">
                    <h3>Sélectionner jurys</h3>
                    <i class="fas fa-chevron-up"></i>
                </div>
                <p class="jury-section-subtitle">2 Maximum</p>
                <div class="jury-list">
                    <div class="jury-member">
                        <label>
                            <input type="checkbox">
                            <img src="https://i.pravatar.cc/40?u=a" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Mourad Hammami</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                    <div class="jury-member">
                        <label>
                            <input type="checkbox">
                            <img src="https://i.pravatar.cc/40?u=b" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Salah Ben Hsin</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                    <div class="jury-member">
                        <label>
                            <input type="checkbox">
                            <img src="https://i.pravatar.cc/40?u=c" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Mourad Hammami</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                    <div class="jury-member">
                        <label>
                            <input type="checkbox">
                            <img src="https://i.pravatar.cc/40?u=d" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Mourad Hammami</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <hr class="jury-divider">
            <div class="jury-section">
                <div class="jury-section-header">
                    <h3>Sélectionner un President</h3>
                    <i class="fas fa-chevron-up"></i>
                </div>
                <div class="jury-list">
                    <div class="jury-member">
                        <label>
                            <input type="radio" name="president">
                            <img src="https://i.pravatar.cc/40?u=e" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Salah Ben Hsin</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                    <div class="jury-member">
                        <label>
                            <input type="radio" name="president">
                            <img src="https://i.pravatar.cc/40?u=f" alt="Avatar">
                            <div class="member-info">
                                <strong>Mr. Mourad Hammami</strong>
                                <span>Maitre Assistant, ENIT</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalEditJury" style="display: none;">
    <div class="popup-container" id="popupContainerEditJury">
        <div class="popup-header">
            <h2>Modifier</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <input type="text" placeholder="Etudiant">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Salle">
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-wrapper">
                        <input type="text" placeholder="Date" onfocus="(this.type='date')">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Temps" onfocus="(this.type='time')">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <select>
                    <option>Encadrant</option>
                </select>
            </div>
            <div class="form-group">
                <select>
                    <option>Jury 1</option>
                </select>
            </div>
            <div class="form-group">
                <select>
                    <option>Jury 2</option>
                </select>
            </div>
            <div class="validation-group">
                <strong>Etat de validation</strong>
                <label>
                    <input type="radio" name="validation-status" value="en-attente" checked> En attente
                </label>
                <label>
                    <input type="radio" name="validation-status" value="validee"> Validée
                </label>
                <label>
                    <input type="radio" name="validation-status" value="ajournee"> Ajournée
                </label>
            </div>
        </form>
    </div>
</div>


<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

// Tab switching logic
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');

        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));

        button.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    });
});

// Action dropdown menu logic
document.addEventListener('DOMContentLoaded', function() {
    // Use event delegation on a parent element
    document.querySelector('.accordion-content').addEventListener('click', function(e) {
        const actionBtn = e.target.closest('.action-btn');

        // Close all open dropdowns first, unless we're clicking the same button
        let clickedMenu;
        if (actionBtn) {
            clickedMenu = actionBtn.nextElementSibling;
        }

        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu !== clickedMenu) {
                menu.style.display = 'none';
            }
        });

        // If an action button was clicked, toggle its dropdown
        if (actionBtn) {
            const menu = actionBtn.nextElementSibling;
            if (menu && menu.classList.contains('dropdown-menu')) {
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
        }
    });

    // NEW: Logic for the status filter dropdown
    const statusHeader = document.querySelector('#tab3 .status-header-container');
    if (statusHeader) {
        const dropdown = statusHeader.querySelector('.status-dropdown-menu');
        const icon = statusHeader.querySelector('.filter-icon');

        icon.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent document click listener from closing it immediately
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    }


    // Close dropdowns if clicking outside
    document.addEventListener('click', function(e) {
        // For the action menus
        if (!e.target.closest('.actions')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
        // For the new status filter menu
        if (!e.target.closest('.status-header-container')) {
            document.querySelectorAll('.status-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
});

// Modal Logic
document.addEventListener("DOMContentLoaded", function() {
    // --- Modal for Details ---
    const detailsModal = document.getElementById("modalObjectifs");
    const openDetailsBtns = document.querySelectorAll(".open-details-modal");
    const detailsPopup = document.getElementById("popupContainerObjectifs");

    openDetailsBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            if (detailsModal) {
                detailsModal.style.display = "flex";
            }
        });
    });

    if (detailsModal && detailsPopup) {
        detailsModal.addEventListener("click", function(e) {
            if (!detailsPopup.contains(e.target)) {
                detailsModal.style.display = "none";
            }
        });
    }

    // --- Modal for Commission ---
    const commissionModal = document.getElementById("modalCommission");
    const openCommissionBtn = document.getElementById("openCommissionModal");
    const commissionPopup = document.getElementById("popupContainerCommission");

    if (openCommissionBtn && commissionModal) {
        openCommissionBtn.addEventListener("click", function() {
            commissionModal.style.display = "flex";
        });
    }

    if (commissionModal && commissionPopup) {
        commissionModal.addEventListener("click", function(e) {
            if (!commissionPopup.contains(e.target)) {
                commissionModal.style.display = "none";
            }
        });
        const closeBtn = commissionModal.querySelector('.btn-close-x');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => closeModal('modalCommission'));
        }
    }


    // --- Modal 2: Affecter Jury ---
    const juryModal = document.getElementById("modalJury");
    const openJuryBtns = document.querySelectorAll(".open-jury-modal");
    const juryPopup = document.getElementById("popupContainerJury");

    openJuryBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            if (juryModal) {
                juryModal.style.display = "flex";
            }
        });
    });

    if (juryModal && juryPopup) {
        juryModal.addEventListener("click", function(e) {
            if (!juryPopup.contains(e.target)) {
                juryModal.style.display = "none";
            }
        });
    }

    // --- Modal 3: Edit Soutenance ---
    const editSoutenanceModal = document.getElementById("modalEditJury");
    const openEditSoutenanceBtns = document.querySelectorAll(".open-edit-soutenance-modal");
    const editSoutenancePopup = document.getElementById("popupContainerEditJury");

    openEditSoutenanceBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            if (editSoutenanceModal) {
                editSoutenanceModal.style.display = "flex";
            }
        });
    });

    if (editSoutenanceModal && editSoutenancePopup) {
        editSoutenanceModal.addEventListener("click", function(e) {
            if (!editSoutenancePopup.contains(e.target)) {
                editSoutenanceModal.style.display = "none";
            }
        });
    }

    // --- Jury Modal Accordion ---
    const jurySectionHeaders = document.querySelectorAll(".jury-section-header");
    jurySectionHeaders.forEach(header => {
        header.addEventListener("click", () => {
            const section = header.parentElement;
            const list = section.querySelector(".jury-list");
            const subtitle = section.querySelector(".jury-section-subtitle");
            const icon = header.querySelector("i");

            const isHidden = list.style.display === "none";

            list.style.display = isHidden ? "flex" : "none";
            if (subtitle) {
                subtitle.style.display = isHidden ? "block" : "none";
            }

            icon.classList.toggle("fa-chevron-up", isHidden);
            icon.classList.toggle("fa-chevron-down", !isHidden);
        });
    });

    // --- Quill Editor ---
    let quillSpecifique;
    if (document.querySelector('#objectifSpecifique')) {
        quillSpecifique = new Quill('#objectifSpecifique', {
            theme: 'snow',
            placeholder: '......',
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
    }
});
</script>