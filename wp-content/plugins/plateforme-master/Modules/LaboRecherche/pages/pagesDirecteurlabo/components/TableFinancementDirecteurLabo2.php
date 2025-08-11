<style>
/* General Body Styles */
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f5f7;
    padding: 20px;
}

/* Main Content Block */
.content-block {
    background: #fff;
    border-radius: 10px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

/* Header */
.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.dashboard-sub-title {
    font-weight: bold;
    font-size: 22px;
    display: flex;
    align-items: center;
}

.section-divider {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 16px 0;
}

/* Filter Bar */
.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding-bottom: 20px;
    flex-wrap: wrap;
}

.filter-inputs {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
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

.input-with-icon .right-icon {
    right: 0.85rem;
}

.filter-input,
.filter-select {
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

.filter-input {
    padding-right: 2.5rem;
}

.filter-input:focus,
.filter-select:focus {
    outline: none;
    border-color: #c60000;
}

.filter-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5rem;
    cursor: pointer;
}

.filter-actions {
    display: flex;
    gap: 10px;
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
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-btn:hover {
    background-color: #f5f5f5;
}

/* Table Styles */
.styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.styled-table thead th {
    background-color: #f3f1e9;
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #EBE9D7;
    font-size: 14px;
}

.styled-table tbody td {
    padding: 14px;
    text-align: center;
    border: 1px solid #EBE9D7;
    border-top: none;
    font-size: 14px;
}

.styled-table th:first-child,
.styled-table td:first-child {
    border-left: 1px solid #EBE9D7;
}

.styled-table th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

.styled-table th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

.styled-table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.styled-table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

.styled-table .left {
    text-align: left;
}

/* Badge Styles */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px;
    border: 2px solid transparent;
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

/* Actions Dropdown */
.actions {
    position: relative;
    display: inline-block;
}

.action-btn {
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    font-size: 24px;
    font-weight: bolder;
    cursor: pointer;
    transition: background-color 0.2s;
    line-height: 1;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
    background-color: #e6e6de;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 180px;
    background-color: #ffffff;
    border: 1px solid #d8d4b7;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 5px;
}

.dropdown-menu a {
    display: block;
    padding: 9px;
    text-decoration: none;
    font-size: 14px;
    color: #2d2a12;
    transition: background-color 0.2s;
    border-radius: 4px;
}

.dropdown-menu a:hover {
    background-color: #f4f4f4;
}

/* DataTables Pagination */
.dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: 2px solid #c60000;
    color: #c60000 !important;
    padding: 8px 14px;
    border-radius: 8px;
    background: white !important;
    font-weight: bold;
    cursor: pointer;
    font-size: 13px;
    box-shadow: none !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f8eaea !important;
    color: #c60000 !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #c60000 !important;
    color: white !important;
    border-color: #c60000;
}

.dataTables_wrapper .dataTables_paginate .ellipsis {
    display: none;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    color: transparent;
}
</style>


<div class="content-block">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="https://placehold.co/38x38/c60000/ffffff?text=P" alt="Icon"
                style="width: 38px; margin-right: 8px; vertical-align: middle; border-radius: 5px;">
            Suivi Budgétaire Par Projet
        </h2>
    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" type="text" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon"></i>
            </div>

            <!-- Project Select -->
            <div class="input-with-icon">
                <select class="filter-select">
                    <option value="" disabled selected>Projet</option>
                    <option>BCI-Learn</option>
                    <option>ARUX</option>
                    <option>3Dcity</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>

            <!-- Status Select -->
            <div class="input-with-icon">
                <select class="filter-select">
                    <option value="" disabled selected>Statut</option>
                    <option>Actif</option>
                    <option>En cours</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
        </div>

        <div class="filter-actions">
            <button class="icon-btn" title="Filter">
                <i class="fa fa-filter"></i>
            </button>
            <button class="icon-btn" title="Download">
                <i class="fa fa-download"></i>
            </button>
        </div>
    </div>

    <table id="candidaturesTable2" class="styled-table display">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll2"></th>
                <th>Projet</th>
                <th>Budget alloué</th>
                <th>Dépensé</th>
                <th>Reste</th>
                <th>Dernière MAJ</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">BCI-Learn</td>
                <td class="left">150 000 TND</td>
                <td>95 000</td>
                <td>55 000</td>
                <td>05/07/2025</td>
                <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"
                            style="color: #0E962D; padding-right:5px;"></i>Actif</span></td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#">Télécharger justificatif</a>
                            <a href="/financement-fiche-de-financement-directeur-labo">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">ARUX</td>
                <td class="left">80 000 TND</td>
                <td>35 000</td>
                <td>45 000</td>
                <td>30/06/2025</td>
                <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"
                            style="color: #0E962D; padding-right:5px;"></i>Actif</span></td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#">Télécharger justificatif</a>
                            <a href="/financement-fiche-de-financement-directeur-labo">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td class="left">3Dcity</td>
                <td class="left">85 000 TND</td>
                <td>72 000</td>
                <td>13 000</td>
                <td>10/06/2025</td>
                <td><span class="badge badge-warning"><i class="fa-regular fa-clock"
                            style="color: #FFD43B; padding-right: 5px;"></i>En cours</span></td>
                <td>
                    <div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#">Télécharger justificatif</a>
                            <a href="/financement-fiche-de-financement-directeur-labo">Détail</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>