<!--
/** =========================================================================
* FRONT — Project Details
* - This is a static representation based on the provided screenshots.
* - The original PHP logic and dynamic JavaScript have been removed as
* they were tied to the previous data structure.
* ====================================================================== */
-->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .custom-project-wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .custom-content-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .custom-box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        /* border-bottom: 1px solid #EBE9D7; */
        box-shadow: 0 0 22px #00000012;
    }

    .custom-box-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
    }

    .custom-body-title {
        padding: 15px 20px;
        box-shadow: 0 5px 16px #00000012;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
        margin-top: 30px;
        margin-bottom: 15px;
        margin-inline: -20px
    }

    .custom-box-body {
        padding: 40px 20px;
    }

    .custom-header-buttons {
        display: flex;
        gap: 10px;
    }

    .custom-header-buttons a {
        text-decoration: none;
    }

    .custom-button {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid transparent;
    }

    .custom-button.retire-btn {
        background-color: transparent;
        color: var(--danger);
        padding: 4px 12px;
        font-size: 13px;
    }

    .custom-button.retire-btn:hover {
        background-color: #fdf0f0;
    }

    .custom-button-main {
        background-color: #BF0404;
        color: #fff;
        border-color: #BF0404;
    }

    .custom-button-alt {
        background-color: #fff;
        color: #BF0404;
        border: 1px solid #BF0404;
    }

    .custom-icon-button {
        width: 36px;
        height: 36px;
        border: none;
        background-color: #fff;
        color: #6E6D55;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Info Section */
    .custom-details-list .custom-details-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #EBE9D7;
        align-items: center;
    }

    .custom-details-list .custom-details-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .custom-details-list .custom-details-item:first-child {
        padding-top: 0;
    }


    .custom-details-label {
        font-weight: 700;
        color: #2A2916;
        width: 200px;
        flex-shrink: 0;
    }

    .custom-details-value {
        color: #6E6D55;
    }

    .custom-details-value a {
        color: #3987DF;
        text-decoration: none;
    }

    .custom-details-value a:hover {
        text-decoration: underline;
    }

    /* Objectives Section */
    .custom-goals-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
        counter-reset: objective-counter;
    }

    .custom-goals-list li {
        counter-increment: objective-counter;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        color: #6E6D55;
    }

    .custom-goals-list li::before {
        content: counter(objective-counter) ".";
        font-weight: 700;
        color: #BF0404;
    }

    /* Tables */
    .custom-data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-data-table thead th {
        background: #f3f1e9;
        padding: 12px 15px;
        text-align: left;
        font-weight: 700;
        color: #2A2916;
        border-bottom: 1px solid #EBE9D7;
    }

    .custom-data-table th:first-child {
        border-top-left-radius: 8px;
    }

    .custom-data-table th:last-child {
        border-top-right-radius: 8px;
        text-align: center;
    }


    .custom-data-table tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #EBE9D7;
        color: #6E6D55;
        vertical-align: middle;
        justify-content: center;
        text-align: center;
    }

    .custom-data-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-data-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 8px;
    }

    .custom-data-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 8px;
    }

    .custom-empty-table-cell {
        text-align: center;
        padding: 40px !important;
        color: #aaa;

    }

    .custom-empty-table-cell i {
        font-size: 40px;
        margin-bottom: 10px;
        display: block;
        color: #ddd;
    }

    .custom-attachment-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .custom-attachment-link:hover {
        text-decoration: underline;
    }

    .custom-attachment-link i {
        font-size: 18px;
    }

    /* Status & Progress */
    .custom-tag {
        padding: 0;
        font-weight: normal;
        font-size: 14px;
        color: #2A2916;
        background-color: transparent;
    }

    .custom-tag-green,
    .custom-tag-yellow,
    .custom-tag-gray {
        background-color: transparent;
        color: #2A2916;
    }

    .progress-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .custom-progress-indicator {
        width: 100%;
        background-color: #EBE9D7;
        border-radius: 8px;
        overflow: hidden;
        height: 10px;
    }

    .custom-progress-indicator-fill {
        height: 100%;
        background: linear-gradient(to bottom, #BF0404, #b2141a);
        border-radius: 8px;
        width: 0%;
        /* Animation Added */
        transition: width 1.5s cubic-bezier(0.25, 0.1, 0.25, 1);
    }

    .progress-percentage {
        color: #6E6D55;
        font-size: 14px;
        font-weight: 600;
        min-width: 40px;
        text-align: right;
    }

    .custom-table-actions {
        display: flex;
        gap: 8px;
    }

    /* Modal Styles */

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
        width: 466px;
        height: 100%;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .popup-container-phases {
        padding-top: 0;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 20px 25px 10px 25px;
        box-shadow: 0px 5px 16px #00000029;
    }

    form.popup-form {
        padding: 0 25px 25px 25px;
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

    .popup-form input,
    .popup-form select,
    .popup-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
    }

    .input-file-wrapper {
        display: flex;
        align-items: center;
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
        background-color: white;
    }

    .input-file-text {
        flex: 1;
        border: 1px solid #b5af8e;
        padding: 10px 12px;
        font-size: 14px;
        color: #555;
        border-radius: 7px 0px 0px 7px !important;
        background-color: transparent;
    }

    .input-file-text:focus {
        outline: none;
    }

    .btn-importer {
        background-color: #b5af8e;
        color: white;
        padding: 11px 16px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        border: none;
    }

    .modal-overlay label {
        min-width: 180px;
        font-weight: 600;
        color: #6E6D55;
        flex-shrink: 0;
        margin-bottom: 7px;
    }

    .form-section-box {
        border: 1px solid #EBE9D7;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 10px;
        position: relative;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .add-task-button,
    .add-membre-button {
        color: #BF0404;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-size: 14px;
        margin-top: 10px;
    }

    .add-task-button i,
    .add-membre-button i {
        border: 2px solid #BF0404;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
    }

    /* STYLES FOR TEAM PROJECT TABLE */
    .team-table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .team-table thead th {
        text-align: center;
        border-bottom: none;
    }

    .team-table tbody .custom-empty-table-cell {
        border: 1px solid #EBE9D7;
        border-radius: 8px;
        padding: 50px 20px !important;
        border-bottom: 1px solid #EBE9D7;
    }

    .team-table .custom-empty-table-cell img {
        opacity: 0.6;
        margin-bottom: 15px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-pic {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: cover;
    }

    .member-name-cell {
        display: flex;
        align-items: center;
    }

    /* General Dropdown Menu Styles */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: #fff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border-radius: 8px;
        border: 1px solid #EBE9D7;
        overflow: hidden;
    }

    .dropdown-menu a,
    .dropdown-menu .dropdown-item {
        color: #2A2916;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
        border-bottom: 1px solid #EBE9D7;
    }

    .dropdown-menu a:last-child,
    .dropdown-menu .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-menu a:hover,
    .dropdown-menu .dropdown-item:hover {
        background-color: #f9f9f9;
    }

    .dropdown-menu .dropdown-item.disabled {
        color: #ccc;
        pointer-events: none;
        cursor: default;
        background-color: transparent;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-toggle::after {
        display: none;
    }

    /* STYLES FOR PHASES MODAL */
    .phase-section,
    .task-section {
        position: relative;
        padding: 20px;
        border: 1px solid #EBE9D7;
        border-radius: 8px;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .delete-item-btn {
        /* margin-top: 15px; */
        padding-top: 15px;
        text-align: right;
        background: none;
        border-top: 1px solid #EBE9D7;
        border-bottom: 0;
        border-left: 0;
        border-right: 0;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    .delete-item-btn.rubrique-btn {
        color: #aaa;
    }

    .delete-item-btn.rubrique-btn:hover {
        color: var(--danger);
    }


    .add-phase-button {
        color: #BF0404;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-size: 14px;
        margin-top: 20px;
    }

    .add-phase-button i {
        font-size: 22px;
    }

    /* STYLES FOR MODIFIER PHASES MODAL */
    .phase-accordion {
        margin-top: 20px;
    }

    .phase-accordion:last-child {
        border-bottom: none;
    }

    .phase-header {
        margin-inline: -25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 15px;
        box-shadow: 0px 5px 16px #00000029;
        /* border-radius: 8px; */
        background: #fff;
        position: relative;
        z-index: 2;
        top: -15px
    }

    .phase-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #2A2916;
    }

    .phase-body {
        padding: 25px 15px 15px 15px;
        border: 1px solid #EBE9D7;
        border-radius: 8px;
        margin-top: 0px;
        position: relative;
        z-index: 1;
    }

    .nb-text {
        font-size: 13px;
        color: #6E6D55;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .phase-progress {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .phase-progress .progress-container {
        flex-grow: 1;
    }

    .phase-status {
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        border: 1px solid;
    }

    .phase-status-encours {
        color: #d89e00;
        background-color: #fff8e6;
        border-color: #d89e00;
    }

    .phase-status-prevu {
        color: #6E6D55;
        background-color: #f1f1f1;
        border-color: #EBE9D7;
    }

    .sub-task-form {
        padding: 20px;
        border: 1px solid #EBE9D7;
        border-radius: 8px;
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .sub-task-form .form-group {
        gap: 0;
    }

    /* STYLES FOR AJOUTER TACHE MODAL */
    .phase-header-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #EBE9D7;
    }

    .phase-header-info h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }

    .date-fields-group {
        display: flex;
        gap: 15px;
    }

    .date-fields-group .form-group {
        flex: 1;
    }

    .date-input-container {
        position: relative;
    }


    /* STYLES FOR DÉPENSE (EXPENSE) SECTION */
    :root {
        --ink: #2A2916;
        --line: #EBE9D7;
        --muted: #6E6D55;
        --chip: #E9E7D7;
        --chip-active: #A6A485;
        --danger: #BF0404;
    }

    .expense-section {
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0, 0, 0, .05)
    }

    .expense-tabs {
        display: flex;
    }

    .expense-tab-btn {
        flex: 1;
        padding: 15px 20px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: var(--chip);
        color: var(--muted);
        border-top-left-radius: 11px;
        border-top-right-radius: 11px;
    }

    .expense-tab-btn:not(:last-child) {
        margin-right: 15px;
    }

    .expense-tab-btn.active {
        background: #fff;
        color: var(--ink);
        margin-bottom: -1px;
        /* border: 1px solid var(--line); */
        border-bottom: 1px solid #fff;
        z-index: 2;
    }

    .expense-content {
        padding: 25px;
        background: #fff;
        /* border: 1px solid var(--line); */
        border-radius: 0 0px 12px 12px;
        position: relative;
        z-index: 1;
    }

    .expense-tab-panel {
        display: none
    }

    .expense-tab-panel.active {
        display: block
    }

    .expense-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .expense-controls .expense-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .expense-search-box {
        display: flex;
        align-items: center;
        border: 1px solid #d8d4b7;
        border-radius: 8px;
        padding: 0 10px;
        background: #fff;
        min-width: 240px;
    }

    .expense-search-box i {
        color: #666;
        margin-right: 6px
    }

    .expense-filter-input {
        padding: 10px 6px;
        border: none;
        outline: none;
        font-size: 14px;
        background: #fff;
        width: 100%;
    }

    .expense-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .add-expense-btn {
        background: #fff;
        color: var(--danger);
        border: 1px solid var(--danger);
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .add-expense-btn:hover {
        background: #fdf0f0
    }

    .expense-icon-btn {
        width: 38px;
        height: 38px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--muted)
    }

    .expense-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .expense-table thead {
        text-align: center;
        background: #f3f1e9
    }

    .expense-table tbody {
        text-align: center;
    }

    .expense-table th {
        padding: 14px;
        text-align: left;
        border: none;
        border-bottom: 1px solid var(--line);
    }

    .expense-table th:first-child {
        border-top-left-radius: 12px;
    }

    .expense-table th:last-child {
        text-align: center;
        border-top-right-radius: 12px;
    }

    .expense-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid var(--line);
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 5px;
        margin-top: 20px;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid var(--line) !important;
        color: var(--muted) !important;
        padding: 8px 14px;
        border-radius: 8px;
        background: #fff !important;
        font-weight: 700;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--danger) !important;
        border-color: var(--danger) !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover {
        background: #f9f9f9 !important
    }

    #depenseTable_wrapper .bottom,
    #rebriquesTable_wrapper .bottom {
        padding-top: 20px;
    }

    /* STYLES FOR AJOUTER RUBRIQUE MODAL */
    .montant-total-box {
        background-color: #f3f1e9;
        border-radius: 8px;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .montant-total-box .label {
        font-weight: 700;
        color: #2A2916;
    }

    .montant-total-box .value {
        font-weight: 700;
        font-size: 18px;
        /* color: #BF0404; */
    }

    .add-rubrique-button {
        color: #BF0404;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-size: 14px;
        margin-top: 10px;
    }

    .add-rubrique-button i {
        border: 2px solid #BF0404;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
    }

    .rubrique-item-container {
        position: relative;
    }

    /* STYLES FOR AJOUTER DEPENSE MODAL */
    .montant-alloue-box {
        background-color: #f3f1e9;
        border-radius: 8px;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
    }

    .montant-alloue-box .label {
        font-weight: 700;
        color: #2A2916;
    }

    .montant-alloue-box .value {
        font-weight: 700;
        font-size: 18px;
        color: #2A2916;
    }

    .input-with-unit {
        position: relative;
    }

    .input-with-unit input {
        padding-right: 50px;
    }

    .input-with-unit span {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6E6D55;
        font-weight: 600;
    }

    #modalAjouterDepense textarea,
    #modalModifierDepense textarea {
        resize: vertical;
        min-height: 80px;
    }


    #teamTable,
    #equipeTable,
    #tasksTable,
    #tab-rb,
    #tab-depense {
        border: none !important;
        box-shadow: none !important;
        border-collapse: separate;
        border-spacing: 0
    }

    #teamTable th,
    #equipeTable th,
    #tasksTable th,
    #tab-rb th,
    #tab-depense th {
        border: 0
    }

    #teamTable td,
    #equipeTable td,
    #tasksTable td,
    #tab-rb td,
    #tab-depense td {
        border: 1px solid var(--line)
    }

    #teamTable thead,
    #equipeTable thead,
    #tasksTable thead,
    #tab-rb thead,
    #tab-depense thead {
        position: static;
        transform: translateY(-15px)
    }

    #teamTable tbody tr:first-child td,
    #equipeTable tbody tr:first-child td,
    #tasksTable tbody tr:first-child td,
    #tab-rb tbody tr:first-child td,
    #tab-depense tbody tr:first-child td {
        border-top: 1px solid var(--line) !important
    }

    /* arrondis */
    #teamTable thead tr:first-child th:first-child,
    #equipeTable thead tr:first-child th:first-child,
    #tasksTable thead tr:first-child th:first-child,
    #tab-rb thead tr:first-child th:first-child,
    #tab-depense thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px
    }

    #teamTable thead tr:first-child th:last-child,
    #equipeTable thead tr:first-child th:last-child,
    #tasksTable thead tr:first-child th:last-child,
    #tab-rb thead tr:first-child th:last-child,
    #tab-depense thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px
    }

    #teamTable tbody tr:last-child td:first-child,
    #equipeTable tbody tr:last-child td:first-child,
    #tasksTable tbody tr:last-child td:first-child,
    #tab-rb tbody tr:last-child td:first-child,
    #tab-depense tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px
    }

    #teamTable tbody tr:last-child td:last-child,
    #equipeTable tbody tr:last-child td:last-child,
    #tasksTable tbody tr:last-child td:last-child,
    #tab-rb tbody tr:last-child td:last-child,
    #tab-depense tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px
    }

    #teamTable tbody tr:first-child td:first-child,
    #equipeTable tbody tr:first-child td:first-child,
    #tasksTable tbody tr:first-child td:first-child,
    #tab-rb tbody tr:first-child td:first-child,
    #tab-depense tbody tr:first-child td:first-child {
        border-top-left-radius: 12px
    }

    #teamTable tbody tr:first-child td:last-child,
    #equipeTable tbody tr:first-child td:last-child,
    #tasksTable tbody tr:first-child td:last-child,
    #tab-rb tbody tr:first-child td:last-child,
    #tab-depense tbody tr:first-child td:last-child {
        border-top-right-radius: 12px
    }

/* Accordéon Tâches */
.tache-accordion {
  border: 1px solid #EBE9D7;
  margin-bottom: 12px;
  overflow: hidden;
}

.tache-header {
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 15px;
    box-shadow: 0px 5px 16px #00000029;
    border-radius: 0px;
    background: #fff;
    position: relative;
    z-index: 2;
}

.tache-header span {
  font-size: 15px;
  color: #000000ff;
}

.tache-header i {
  transition: transform 0.3s ease;
}

.tache-header.open i {
  transform: rotate(180deg);
}

.tache-body {
    display: none;
    padding: 15px;
    background: #fff;
    padding: 25px 15px 15px 15px;
    border: 1px solid #EBE9D7;
    border-radius: 8px;
    position: relative;
    z-index: 1;
    margin: 20px;
}
.tache-body strong {
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
    margin-bottom: 7px;
}
.tache-body p {
  margin: 6px 0;
  font-size: 14px;
  color: #444;
}

.tache-actions {
  margin-top: 10px;
  display: flex;
  gap: 10px;
}

.tache-actions button {
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    background-color: transparent;
}

.btn-edit {
  background-color: #007bff;
  color: white;
}

.btn-delete {
  background-color: #c62828;
  color: white;
}
button.btn-edit.js-edit-tache {
    background-color: #fff;
    color: #BF0404;
    border: 1px solid #BF0404;
}
.swal2-container.swal2-center.swal2-backdrop-show {
    z-index: 999999999999999;
}
</style>

<div class="custom-project-wrapper">



    <!-- Informations générales -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Informations générales</h2>
           <!-- <div class="custom-header-buttons">
                <a href="#" class="custom-button custom-button-main"><i class="fa-solid fa-lock"></i>
                    Publier espace</a>
            </div>-->
        </div>
        <div class="custom-box-body">
            <div class="custom-details-list" id="infos-generales">
                
            </div>
            <h2 class="custom-body-title">Objectifs du projet</h2>
            <ol class="custom-goals-list" id="objectifs-list">
              
            </ol>
        </div>
    </div>



    <!-- Équipe du projet -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Équipe du projet</h2>
            <div class="custom-header-buttons">
                <a href="#" id="ajouterMembreBtn" class="custom-button custom-button-alt openmodalObjectifs">Ajouter</a>
            </div>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table team-table" id="equipeTable">
                <thead>
                    <tr>
                        <th>Orcid</th>
                        <th>Nom complet</th>
                        <th>Rôle dans le projet</th>
                        <th>Email</th>
                        <th>Doc.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
    </div>



    <!-- Liste des tâches de projet -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Liste des phases de projet</h2>
            <div class="custom-header-buttons">
                <a href="#" class="custom-button custom-button-alt">Générer Gantt</a>
                <div class="dropdown">
                    <button class="custom-button custom-button-alt dropdown-toggle" id="tasksActionsBtn">
                        Actions <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="tasksActionsBtn">
                        <a class="dropdown-item" href="#" id="ajouterPhasesBtn">Ajouter les
                            phases</a>
                        <!-- <a class="dropdown-item" href="#" id="modifierPhasesBtn">Modifier</a>
                        <a class="dropdown-item" href="#">Details</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table team-table" id="tasksTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Phase</th>
                        <th>Etat</th>
                        <th>Progression</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <!--
                    <tr>
                        <td>1</td>
                        <td>Acquisition du matériel EEG</td>
                        <td><span class="custom-tag custom-tag-green">Terminé</span></td>
                        <td>
                            <div class="progress-container">
                                <div class="custom-progress-indicator">
                                    <div class="custom-progress-indicator-fill" data-target-width="100%"></div>
                                </div>
                                <span class="progress-percentage">100%</span>
                            </div>
                        </td>
                        <td class="custom-table-actions">
                            <div class="dropdown">
                                <button class="dropdown-toggle custom-icon-button" title="Actions"><i
                                        class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-add-task">Ajouter des tâches</a>
                                    <a href="#" class="dropdown-item js-modifier-tache">Modifier</a>
                                    <a href="#" class="dropdown-item">Marquer
                                        terminée</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Développement de l'application mobile</td>
                        <td><span class="custom-tag custom-tag-yellow">En cours</span></td>
                        <td>
                            <div class="progress-container">
                                <div class="custom-progress-indicator">
                                    <div class="custom-progress-indicator-fill" data-target-width="60%"></div>
                                </div>
                                <span class="progress-percentage">60%</span>
                            </div>
                        </td>
                        <td class="custom-table-actions">
                            <div class="dropdown">
                                <button class="dropdown-toggle custom-icon-button" title="Actions"><i
                                        class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-add-task">Ajouter des tâches</a>
                                    <a href="#" class="dropdown-item js-modifier-tache disabled">Modifier</a>
                                    <a href="#" class="dropdown-item">Marquer
                                        terminée</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Phase de tests cliniques</td>
                        <td><span class="custom-tag custom-tag-gray">À faire</span></td>
                        <td>
                            <div class="progress-container">
                                <div class="custom-progress-indicator">
                                    <div class="custom-progress-indicator-fill" data-target-width="0%"></div>
                                </div>
                                <span class="progress-percentage">0%</span>
                            </div>
                        </td>
                        <td class="custom-table-actions">
                            <div class="dropdown">
                                <button class="dropdown-toggle custom-icon-button" title="Actions"><i
                                        class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-add-task">Ajouter des tâches</a>
                                    <a href="#" class="dropdown-item js-modifier-tache">Modifier</a>
                                    <a href="#" class="dropdown-item">Marquer
                                        terminée</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                -->
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pièces jointes associées au projet -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Pièces jointes associées au projet</h2>
            <div class="custom-header-buttons">
                <a href="#" id="modifierPiecesJointesBtn" class="custom-button custom-button-alt">Modifier</a>
                <button class="expense-icon-btn" title="Télécharger"><img width="20px"
                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt=""></button>
            </div>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table team-table" id="table-pieces">
                <thead>
                    <tr>
                        <th>Ref_Doc</th>
                        <th>Type de document</th>
                        <th>Fichier</th>
                        <th>Version</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Convention projet</td>
                        <td><a href="#" class="custom-attachment-link"><img width="15px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="">
                                Convention_BCI_UTM.pdf</a></td>
                        <td>1.0</td>
                        <td>01/02/2024</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Planning détaillé</td>
                        <td><a href="#" class="custom-attachment-link"><img width="15px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/excel-document.png" alt="">
                                Planning_BCI_Q1Q2_2025.xlsx</a></td>
                        <td>1.2</td>
                        <td>20/01/2025</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Rapport d'étape</td>
                        <td><a href="#" class="custom-attachment-link"><img width="15px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="">
                                Rapport_BCI_Progress2024.pdf</a></td>
                        <td>1.0</td>
                        <td>15/12/2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Dépense Section -->
    <div class="expense-section">
        <div class="expense-tabs">
            <button class="expense-tab-btn active" data-tab="tab-rb">Rubriques budgétaire</button>
            <button class="expense-tab-btn" data-tab="tab-depense">Dépenses</button>
        </div>

        <div class="expense-content">
            <div class="expense-tab-panel active" id="tab-rb">
                <div class="expense-controls">
                    <div class="expense-search-box">
                        <input type="text" class="expense-filter-input" id="rebriquesSearch"
                            placeholder="Recherchez...">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="expense-actions">
                        <div class="expense-actions">
                            <a href="#" id="addRubriqueBtn" class="add-expense-btn">Ajouter
                                rubrique</a>
                        </div>
                        <button class="expense-icon-btn" title="Exporter"><img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt=""></button>
                    </div>
                </div>
                <table class="expense-table" id="rebriquesTable">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Rubrique budgétaire</th>
                             <th>Montant Alloué</th>
                            <th>Reste</th>
                            <th>Pièces jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <!--  <tr>
                            <td>001</td>
                            <td>Fournitures du bureau</td>
                            <td>10 000 TND</td>
                            <td>54 000 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-rubrique">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Matériel informatique</td>
                            <td>30 000 TND</td>
                            <td>100 000 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-rubrique">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>frais généraux</td>
                            <td>23 000 TND</td>
                            <td>67 000 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-rubrique">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
            <div class="expense-tab-panel" id="tab-depense">
                <div class="expense-controls">
                    <div class="expense-search-box">
                        <input type="text" class="expense-filter-input" id="depenseSearch" placeholder="Recherchez...">
                        <i class="fa fa-search"></i>
                    </div>

                    <div class="expense-actions">
                        <a href="#" id="addDepenseBtn" class="add-expense-btn">Ajouter
                            dépense</a>
                        <button class="expense-icon-btn" title="Exporter"><img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt=""></button>
                    </div>
                </div>

                <table class="expense-table" id="depenseTable">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Rubrique budgétaire</th>
                            <th>Désignation</th>
                            <th>Montant</th>
                            <th>Pièces jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <!-- <tr>
                            <td>001</td>
                            <td>Achat matériel labo</td>
                            <td>Achat matériel labo</td>
                            <td>54 000 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-depense">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Déplacement</td>
                            <td>-</td>
                            <td>200 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-depense">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>Déplacement</td>
                            <td>-</td>
                            <td>670 TND</td>
                            <td><a href="#" class="custom-icon-button" title="Télécharger"><img width="20px"
                                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                        alt=""></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="custom-icon-button dropdown-toggle" title="Actions"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-modifier-depense">Modifier</a>
                                        <a href="#" class="dropdown-item">Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Équipe du projet -->
<div class="modal-overlay" id="modalObjectifs" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Définir l'équipe</h2>
            <button class="btn-enregistrer" id="btnSaveEquipe">Enregistrer</button>

        </div>
        <form class="popup-form">
            <div id="membres-container">
                <div class="form-section-box">
                    <div class="form-group">
                        <label for="membre">Membre</label>
                        <select id="membre">
                            <option>Monia Zeidi</option>
                            <option>Autre Membre 1</option>
                            <option>Autre Membre 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <select id="role">
                            <option>Responsable Du Projet</option>
                            <option>Co-responsable</option>
                            <option>Membre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pièce jointe</label>
                        <div class="input-file-wrapper">
                            <input class="input-file-text" id="piece-jointe-text" readonly placeholder="importer">
                            <input type="file" id="file-input-piece-jointe" style="display:none">
                            <button type="button" class="btn-importer"
                                onclick="document.getElementById('file-input-piece-jointe').click();">
                                <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                    alt="Icon-uploadwhite.png" width="12px">
                                Importer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
           <!-- <button type="button" class="add-membre-button">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png">
                Ajouter Un Membre
            </button>-->
        </form>
    </div>
</div>

<!-- Modal for Pièces jointes -->
<div class="modal-overlay" id="modalPiecesJointes" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Pièces jointes associées au projet</h2>
            <button class="btn-enregistrer" id="btnSavePiecesJointes">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-section-box">
                <div class="form-group">
                    <label for="type-document">Type De Document</label>
                    <input type="text" id="type-document">
                </div>
                <div class="form-group">
                    <label>Piece jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" id="pj-text" readonly placeholder="importer">
                        <input type="file" id="file-input-pj" style="display:none">
                        <button type="button" class="btn-importer"
                            onclick="document.getElementById('file-input-pj').click();">

                            <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite.png" width="12px">
                            Importer
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" id="version">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Ajouter les Phases -->
<div class="modal-overlay" id="modalAjouterPhases" style="display: none;">
    <div class="popup-container popup-container-phases">
        <div class="popup-header">
            <h2>Ajouter les Phases</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div id="phases-container">

                <!-- Initial Phase Section -->
                <div class="phase-section">
                    <div class="form-group">
                        <label>Titre Du Phase</label>
                        <input type="text" value="Revue De Littérature">
                    </div>
                    <!--<div class="form-group">
                        <label>Membres Pour Cette Tache</label>
                        <select id="membres_phases">
                            <option>3 Membres</option>
                            <option>4 Membres</option>
                        </select>
                    </div>-->
                    <div class="form-group">
                        <label>Etat</label>
                        <select>
                            <option>Prévu</option>
                            <option>En cours</option>
                            <option>Terminé</option>
                        </select>
                    </div>
                </div>

            </div>
            <button type="button" class="add-phase-button">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png"> Ajouter Une Phase
            </button>
        </form>
    </div>
</div>


<!-- Modal for Modifier Phase -->
<div class="modal-overlay" id="modalModifierPhase" style="display: none;">
  <div class="popup-container popup-container-phases">
    <div class="popup-header">
      <h2 id="modifierPhaseTitle">Modifier la phase</h2>
      <button class="btn-enregistrer" id="btnSavePhase">Enregistrer</button>
    </div>
    <form class="popup-form">
      <!-- ID caché -->
      <input type="hidden" id="modifierPhaseId">

      <div class="form-group">
        <label for="modifierPhaseTitre">Titre de la phase</label>
        <input type="text" id="modifierPhaseTitre">
      </div>

      <div class="form-group">
        <label for="modifierPhaseEtat">État</label>
        <select id="modifierPhaseEtat">
          <option value="Prévu">Prévu</option>
          <option value="En cours">En cours</option>
          <option value="Terminé">Terminé</option>
        </select>
      </div>

      
    </form>
  </div>
</div>


<!-- Modal for Modifier Phases -->
<div class="modal-overlay" id="modalModifierPhases" style="display: none;">
    <div class="popup-container popup-container-phases">
        <div class="popup-header">
            <h2>Modifier phases</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div id="modifier-phases-container">

                <!-- Dynamic content will be injected here -->

            </div>
        </form>
    </div>
</div>

<!-- Modal for Ajouter Tâche -->
<div class="modal-overlay" id="modalAjouterTache" style="display: none;">
    <div class="popup-container popup-container-phases">
        <div class="popup-header">
            <h2>Ajouter tâche</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div id="add-task-phase-header" class="phase-header-info">

                <!-- Dynamically populated -->

            </div>
            <div id="taches-container">
                <div class="task-section">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text">
                    </div>
                    <div class="form-group">
                        <label>Etat</label>
                        <select>
                            <option>En Cours</option>
                            <option>Prévu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Membre</label>
                        <select class="membres_taches">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Debut</label>
                        <div class="date-input-container">
                            <input type="date" class="date-input-field">
                        </div>
                    </div>
                    <div class="date-fields-group">
                        <div class="form-group">
                            <label>Date Fin Prévu</label>
                            <div class="date-input-container">
                                <input type="date" class="date-input-field">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date Limite</label>
                            <div class="date-input-container">
                                <input type="date" class="date-input-field">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="add-phase-button add-task-button-inner">

                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png">
                Ajouter Une Tache
            </button>
        </form>
    </div>
</div>

<!-- Modal for Modifier Tâche -->
<div class="modal-overlay" id="modalModifierTache" style="display: none;">
  <div class="popup-container popup-container-phases">
    <div class="popup-header">
      <h2 id="modifierTacheTitle">Modifier Tâche</h2>
      <button class="btn-enregistrer">Enregistrer</button>
    </div>
    <form class="popup-form">
      <div class="task-section">
        <!-- ID de la tâche -->
        <input type="hidden" id="modifierTacheId">

        <div class="form-group">
          <label>Titre</label>
          <input type="text" id="modifierTacheInputTitre">
        </div>

        <div class="form-group">
          <label>Etat</label>
          <select id="modifierTacheInputEtat">
            <option value="Prévu">Prévu</option>
            <option value="En cours">En cours</option>
            <option value="Terminé">Terminé</option>
          </select>
        </div>

        <div class="form-group">
          <label>Membre</label>
          <select class="membres_taches" id="modifierTacheInputMembre">
          </select>
        </div>

        <div class="form-group">
          <label>Date Début</label>
          <div class="date-input-container">
            <input type="date" class="date-input-field" id="modifierTacheInputDebut">
          </div>
        </div>

        <div class="date-fields-group">
          <div class="form-group">
            <label>Date Fin Prévu</label>
            <div class="date-input-container">
              <input type="date" class="date-input-field" id="modifierTacheInputFinPrevu">
            </div>
          </div>
          <div class="form-group">
            <label>Date Limite</label>
            <div class="date-input-container">
              <input type="date" class="date-input-field" id="modifierTacheInputLimite">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>




<!-- Modal for Ajouter Rubrique -->
<div class="modal-overlay" id="modalAjouterRubrique" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Rubriques budgétaire</h2>
            <button class="btn-enregistrer" id="btnSaveRubrique">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="montant-total-box">
                <span class="label">Montant Total :</span>
                <span class="value" id="montanttotal"></span>
            </div>
            <div id="rubriques-container">
                <div class="rubrique-item-container">
                    <div class="form-section-box">
                        <div class="form-group">
                            <label>Rubrique Budgétaire</label>
                            <input type="text" id="rubriqueNom">
                        </div>
                        <div class="form-group">
                            <label>Montant a ne pas dépassé :</label>
                            <input type="number" id="rubriqueMontant">
                        </div>
                          <div class="form-group">
                            <label>Pièce jointe</label>
                            <div class="input-file-wrapper">
                                <input class="input-file-text" readonly placeholder="importer">
                                <input type="file" id="rubriqueFile" class="input-file-hidden" style="display:none">
                                <button type="button" class="btn-importer">
                                    <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                        alt="Icon-uploadwhite.png" width="12px">
                                    Importer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<button type="button" class="add-rubrique-button">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png">
                Ajouter Autre
            </button>-->
        </form>
    </div>
</div>


<!-- Modal for Ajouter Dépense -->
<div class="modal-overlay" id="modalAjouterDepense" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Dépense</h2>
            <button class="btn-enregistrer" id="btnSaveDepense">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label>Rubrique Budgétaire</label>
                <select id="rubriques-select"></select>
            </div>
            <div class="montant-alloue-box">
                <span class="label">Montant Alloué :</span>
                <span class="value"></span>
            </div>
            <div class="form-group">
                <label>Montant</label>
                <div class="input-with-unit">
                    <input type="number" id="depenseMontant" value="">
                    <span>TND</span>
                </div>
            </div>
            <div class="form-group">
                <label>Désignation</label>
                <textarea rows="4" id="depenseDesignation"></textarea>
            </div>
             <div class="form-group">
                <label>Pièce jointe</label>
                <div class="input-file-wrapper">
                    <input class="input-file-text" readonly placeholder="importer">
                    <input type="file" id="depenseFile" class="input-file-hidden" style="display:none">
                    <button type="button" class="btn-importer"><i class="fa-solid fa-filter"></i>
                        Importer</button>
                </div>
            </div>
            
        </form>
    </div>
</div>


<!-- Modal for Modifier Rubrique -->
<div class="modal-overlay" id="modalModifierRubrique" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier Rubrique</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="montant-total-box">
                <span class="label">Montant Total :</span>
                <span class="value" id="montanttotal2"></span>
            </div>
            <div class="form-section-box">
                <div class="form-group">
                    <label>Rubrique Budgétaire</label>
                    <input type="text" value="">
                </div>
                <div class="form-group">
                    <label>Montant a ne pas dépassé :</label>
                    <input type="number" value="">
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" readonly placeholder="importer">
                        <input type="file" class="input-file-hidden" style="display:none">
                        <button type="button" class="btn-importer">
                            <!-- <i class="fa fa-file-arrow-up"></i>  -->
                            <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite.png" width="12px">
                            Importer
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Modifier Dépense -->
<div class="modal-overlay" id="modalModifierDepense" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier Dépense</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label>Rubrique Budgétaire</label>
                <select id="rubriques-select2"></select>

            </div>
            <!--<div class="montant-alloue-box">
                <span class="label">Montant Alloué :</span>
                <span class="value"></span>
            </div>-->
            <div class="form-group">
                <label>Montant</label>
                <div class="input-with-unit">
                    <input type="text" value="">
                    <span>TND</span>
                </div>
            </div>
            <div class="form-group">
                <label>Désignation</label>
                <textarea rows="4"></textarea>
            </div>
            <div class="form-group">
                <label>Pièce jointe</label>
                <div class="input-file-wrapper">
                    <input class="input-file-text" readonly placeholder="importer">
                    <input type="file" class="input-file-hidden" style="display:none">
                    <button type="button" class="btn-importer"><i class="fa-solid fa-filter"></i>
                        Importer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Détails des Tâches -->
<div class="modal-overlay" id="modalDetailsTaches" style="display:none;">
  <div class="popup-container popup-container-phases">
    <div class="popup-header">
      <h2>Détails des tâches</h2>
      <button class="btn-enregistrer" onclick="closeModal('modalDetailsTaches')">Fermer</button>
    </div>
    <div class="popup-form" id="accordionTaches">
      <!-- Les tâches seront injectées ici dynamiquement -->
    </div>
  </div>
</div>



<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
        /* ===== Helpers REST ===== */
        const API_BASE = (window.PMSettings?.restUrl || "/wp-json/") + "plateforme-recherche/v1";
        async function wpFetch(path, opts = {}) {
            const res = await fetch(API_BASE + path, {
                credentials: 'include',
                method: opts.method || 'GET',
                body: opts.body || undefined,
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || '',
                    ...(opts.headers || {})
                }
            });
            if (!res.ok) {
                throw new Error(`HTTP ${res.status}`)
            }
            const ct = res.headers.get('content-type') || '';
            return ct.includes('application/json') ? res.json() : res.text();
        }

        function fmtMoney(v) {
            if (v === null || v === undefined || v === '') return '—';
            const n = Number(v);
            return isNaN(n) ? v : n.toLocaleString('fr-FR', {
                style: 'currency',
                currency: 'TND',
                maximumFractionDigits: 3
            });
        }

        function openModal(id) {
            document.getElementById(id).style.display = 'flex'
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none'
        }

        /* ===== Menu Phases test 01102025===== */
       /* document.getElementById('menuPhases').addEventListener('click', e => {
            const m = e.currentTarget;
            m.classList.toggle('open');
        });
        document.addEventListener('click', e => {
            const m = document.getElementById('menuPhases');
            if (m && !m.contains(e.target)) m.classList.remove('open');
        });
        */

        /* ===== Upload buttons in side panels ===== */
        /*document.getElementById('btn-importer-depense').onclick = () => document.getElementById('file-input-depense')
            .click();
        document.getElementById('file-input-depense').onchange = function () {
            document.getElementById('piece-jointe-depense').value = this.files?.[0]?.name || ''
        }
            */
        /*
        document.getElementById('btn-importer-piece').onclick = () => document.getElementById('file-input-piece').click();
        document.getElementById('file-input-piece').onchange = function () {
            document.getElementById('piece-jointe').value = this.files?.[0]?.name || ''
        }
            */

        /* ===== Renderers ===== */
        function renderInfos(data) {
            /*const ul = document.getElementById('infos-generales');
            ul.innerHTML =
                `
                <li><strong>Intitulé complet :</strong> ${data.titre || ''}</li>
                <li><strong>Responsable :</strong> ${data.chercheur_nom || ''}</li>
                <li><strong>Période :</strong> ${data.date_debut || ''} – ${data.date_fin || ''}</li>
                <li><strong>Financement :</strong> ${(data.budget ? fmtMoney(data.budget) : '0 TND')} ${data.type_financement ? `(${data.type_financement})` : ''}</li>`;*/

            const container = document.getElementById('infos-generales');
            container.innerHTML = `
                <div class="custom-details-item">
                <span class="custom-details-label">Intitulé complet :</span>
                <span class="custom-details-value">${data.titre || ''}</span>
                </div>
                <div class="custom-details-item">
                <span class="custom-details-label">Responsable :</span>
                <span class="custom-details-value">${data.chercheur_nom || ''}</span>
                </div>
                <div class="custom-details-item">
                <span class="custom-details-label">Période :</span>
                <span class="custom-details-value">${data.date_debut || ''} – ${data.date_fin || ''}</span>
                </div>
                <div class="custom-details-item">
                <span class="custom-details-label">Financement :</span>
                <span class="custom-details-value">${(data.budget ? fmtMoney(data.budget) : '0 TND')} ${data.type_financement ? `(${data.type_financement})` : ''}</span>
                </div>
            `;
            document.getElementById('montanttotal').innerHTML = `${( data.budget ? fmtMoney(data.budget)  : '0 TND')}`;
            document.getElementById('montanttotal2').innerHTML = `${( data.budget ? fmtMoney(data.budget)  : '0 TND')}`;
            const ol = document.getElementById('objectifs-list');
            ol.innerHTML = '';
            if (data.objectifs) {
                const li = document.createElement('li');
                li.textContent = data.objectifs;
                ol.appendChild(li);
            }
            (data.objectifs_list || []).forEach(o => {
                const li = document.createElement('li');
                li.textContent = o.objectif;
                ol.appendChild(li);
            });
        }

       function renderEquipe(data) {
                const tb = document.querySelector('#equipeTable tbody');
                tb.innerHTML = '';

                if (!data.membres || !data.membres.length) {
                    tb.innerHTML = `<tr><td colspan="6" style="text-align:center; color:#888;">Aucun membre trouvé</td></tr>`;
                    return;
                }

                const projetId = data.id;                // ID projet
                const ownerId  = Number(data.chercheur_id); // Propriétaire du projet
                const currentUserId = Number(window.PMSettings?.userId || 0);

                data.membres.forEach((m) => {
                    const mail = m.email || m.user_email || '';

                    // Avatar
                    const avatarHtml = m.avatar_url && m.avatar_url !== "null" && m.avatar_url !== ""
                        ? `<img src="${m.avatar_url}" alt="${m.display_name || ''}" class="profile-pic">`
                        : '';

                    // Pièce jointe
                    const docHtml = m.piece_jointe_path && m.piece_jointe_path !== "null" && m.piece_jointe_path !== ""
                        ? `<a href="${m.piece_jointe_path}" target="_blank" class="custom-icon-button" title="Voir document">
                            <i class="fa-solid fa-paperclip"></i>
                        </a>`
                        : '';

                    // Action Delete → affichée uniquement si user connecté = propriétaire
                    let actionHtml = '';
                    if (currentUserId === ownerId) {
                        actionHtml = `
                            <button class="custom-button retire-btn" data-id="${m.id}">
                                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png" alt="Supprimer">
                            </button>
                        `;
                    } else {
                        actionHtml = `<span style="color:#aaa;font-size:13px;">Aucune action</span>`;
                    }

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${m.orcid || '—'}</td>
                        <td>
                            <div class="member-name-cell">
                                ${avatarHtml}
                                ${m.display_name || '—'}
                            </div>
                        </td>
                        <td>${m.role_dans_projet || '—'}</td>
                        <td class="email">${mail ? `<a href="mailto:${mail}">${mail}</a>` : '—'}</td>
                        <td class="cell-center">${docHtml}</td>
                        <td class="cell-center">${actionHtml}</td>
                    `;

                    // ⚡ Attacher la logique suppression si le bouton existe
                    const deleteBtn = row.querySelector('.retire-btn');
                    if (deleteBtn) {
                        deleteBtn.addEventListener('click', async () => {
                            const confirm = await Swal.fire({
                                title: "Confirmer la suppression ?",
                                text: "Ce membre sera retiré du projet.",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#c60000",
                                cancelButtonColor: "#6c757d",
                                confirmButtonText: "Oui, supprimer",
                                cancelButtonText: "Annuler"
                            });

                            if (!confirm.isConfirmed) return;

                            row.remove(); // suppression visuelle
                            deleteMembre(projetId, m.id); // appel API
                        });
                    }

                    tb.appendChild(row);
                });
            }




        function renderPhases(data) {
            const tb = document.querySelector('#tasksTable tbody');
            tb.innerHTML = '';

            const currentUserId = Number(window.PMSettings?.userId || 0);
            const membresIds = (data.membres || []).map(m => Number(m.user_id)); // tous les membres de l’équipe
            const isInEquipe = membresIds.includes(currentUserId);

            (data.phases || []).forEach((p, idx) => {
                const pr = Math.max(0, Math.min(100, Number(p.progression || 0)));
                const state = (p.etat || '').toLowerCase();
                const stateCls = state.includes('cours')
                    ? 'state'
                    : (state.includes('prévu') || state.includes('prevu'))
                        ? 'state todo'
                        : 'state pending';

                // --- Boutons dynamiques
                let actionsHtml = `
                    <a href="#" class="dropdown-item js-view-taches" data-phase="${p.id}">Détails des tâches</a>
                `;

                // si l’utilisateur est le créateur de la phase
                if (Number(p.created_by) === currentUserId) {
                    actionsHtml = `
                        <a href="#" class="dropdown-item js-add-task" data-phase="${p.id}">Ajouter des tâches</a>
                        <a href="#" class="dropdown-item js-modifier-phase" data-phase="${p.id}">Modifier phase</a>
                        <a href="#" class="dropdown-item js-marquer-terminee" data-phase="${p.id}">Marquer terminée</a>
                        ${actionsHtml}
                    `;
                }
                // sinon si c’est un membre de l’équipe → peut voir les détails seulement
                else if (isInEquipe) {
                    actionsHtml = `
                        ${actionsHtml}
                    `;
                }
                // sinon pas d’action
                else {
                    actionsHtml = '';
                }

                tb.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="cell-center">${idx + 1}</td>
                        <td>${p.titre_phase || '—'}</td>
                        <td class="cell-center"><span class="${stateCls}">${p.etat || '—'}</span></td>
                        <td>
                            <div class="progress-container">
                                <div class="custom-progress-indicator">
                                    <div class="custom-progress-indicator-fill" style="width:${pr}%"></div>
                                </div>
                                <span class="progress-percentage">${pr}%</span>
                            </div>
                        </td>
                        <td class="custom-table-actions">
                            <div class="dropdown">
                                <button class="dropdown-toggle custom-icon-button" title="Actions">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    ${actionsHtml || '<span class="dropdown-item disabled">Aucune action</span>'}
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });
        }



        /*
        function renderPieces(data) {
            const tb = document.querySelector('#table-pieces tbody');
            tb.innerHTML = `
                <tr>
                    <td>001</td>
                    <td>Convention projet</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> Convention_BCI_UTM.pdf
                        </a>
                    </td>
                    <td>1.0</td>
                    <td>01/02/2024</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Planning détaillé</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-excel" style="color: #198754;"></i> Planning_BCI_Q1Q2_2025.xlsx
                        </a>
                    </td>
                    <td>1.2</td>
                    <td>20/01/2025</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Rapport d'étape</td>
                    <td>
                        <a class="file-link" href="#" target="_blank">
                            <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> Rapport_BCI_Progress2024.pdf
                        </a>
                    </td>
                    <td>1.0</td>
                    <td>15/12/2024</td>
                </tr>
            `;
        }
        */
       function renderPieces(data) {
            const tb = document.querySelector('#table-pieces tbody');
            tb.innerHTML = '';

            let rows = [];
            let idx = 1;

            // Convention
            if (data.convention_piece) {
                rows.push(`
                    <tr>
                        <td>${String(idx).padStart(3, '0')}</td>
                        <td>Convention projet</td>
                        <td>
                            <a class="file-link" href="${data.convention_piece}" target="_blank">
                                <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> ${data.convention_piece.split('/').pop()}
                            </a>
                        </td>
                        <td>1.0</td>
                        <td>${data.date_debut || ''}</td>
                    </tr>
                `);
                idx++;
            }

            // Budget
            if (data.budget_piece) {
                rows.push(`
                    <tr>
                        <td>${String(idx).padStart(3, '0')}</td>
                        <td>Budget prévisionnel</td>
                        <td>
                            <a class="file-link" href="${data.budget_piece}" target="_blank">
                                <i class="fa-solid fa-file-pdf" style="color: #d71920;"></i> ${data.budget_piece.split('/').pop()}
                            </a>
                        </td>
                        <td>1.0</td>
                        <td>${data.date_debut || ''}</td>
                    </tr>
                `);
                idx++;
            }

            // Si aucune pièce jointe
            if (rows.length === 0) {
                rows.push(`
                    <tr>
                        <td colspan="5" style="text-align:center; color:#888;">Aucune pièce jointe disponible</td>
                    </tr>
                `);
            }

            tb.innerHTML = rows.join('');
        }


        /* Simple search & paginations for tables (client side) */
        function paginatedRenderer(rows, targetBody, pagerEl, pageSize = 5) {
            let page = 1,
                filter = '';

            function draw() {
                const body = document.querySelector(targetBody);
                body.innerHTML = '';
                const filtered = !filter ? rows : rows.filter(r => r.text.toLowerCase().includes(filter));
                const pages = Math.max(1, Math.ceil(filtered.length / pageSize));
                page = Math.max(1, Math.min(page, pages));
                const slice = filtered.slice((page - 1) * pageSize, page * pageSize);
                slice.forEach(r => body.insertAdjacentHTML('beforeend', r.html));
                const pag = document.getElementById(pagerEl);
                pag.innerHTML = '';
                for (let i = 1; i <= pages; i++) {
                    pag.insertAdjacentHTML('beforeend',
                        `<button class="${i === page ? 'active' : ''}" data-p="${i}">${i}</button>`);
                }
            }
            document.getElementById(pagerEl).addEventListener('click', e => {
                const b = e.target.closest('button');
                if (!b) return;
                page = Number(b.dataset.p || 1);
                draw();
            });
            return {
                searchBox(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', () => {
                            filter = el.value.trim().toLowerCase();
                            page = 1;
                            draw();
                        });
                    }
                    draw();
                },
                redraw() {
                    draw();
                }
            };
        }

        function renderRubriques(data) {
            const tb = document.querySelector("#rebriquesTable tbody");
            tb.innerHTML = "";

            if (!data.rubriques || !data.rubriques.length) {
                tb.innerHTML = `<tr><td colspan="6" style="text-align:center;color:#888">Aucune rubrique trouvée</td></tr>`;
                return;
            }

            data.rubriques.forEach((r, idx) => {
                tb.insertAdjacentHTML("beforeend", `
                    <tr>
                        <td>${String(idx+1).padStart(3,'0')}</td>
                        <td>${r.rubrique || '—'}</td>
                        <td class="cell-center">${r.montant_max ? fmtMoney(r.montant_max) : '—'}</td>
                        <td class="cell-center">${r.montant_alloue ? fmtMoney(r.montant_alloue) : '—'}</td>
                        <td class="cell-center">
                            ${r.fichier_justificatif 
                                ? `<a href="${r.fichier_justificatif}" target="_blank" class="custom-icon-button" title="Télécharger">
                                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt="">
                                </a>` 
                                : '—'}
                        </td>
                        <td class="cell-center">
                            <div class="dropdown">
                                <button class="custom-icon-button dropdown-toggle"><i class="fa fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-modifier-rubrique" data-id="${r.id}">Modifier</a>
                                    <a href="#" class="dropdown-item js-delete-rubrique" data-id="${r.id}">Supprimer</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });
        }


        function renderDepenses(data) {
            const tb = document.querySelector('#depenseTable tbody');
            tb.innerHTML = "";

            const depenses = data.depenses || [];

            if (!depenses.length) {
                tb.innerHTML = `<tr><td colspan="6" class="cell-center" style="color:#888">Aucune dépense</td></tr>`;
                return;
            }

            depenses.forEach((d, idx) => {
                tb.insertAdjacentHTML("beforeend", `
                    <tr>
                        <td>${d.ref || String(idx+1).padStart(3,'0')}</td>
                        <td>${d.rubrique_ref || '—'}</td>
                        <td>${d.designation || '—'}</td>
                        <td>${fmtMoney(d.montant || 0)}</td>
                        <td class="cell-center">
                            ${d.piece_jointe 
                                ? `<a href="${d.piece_jointe}" target="_blank" class="custom-icon-button" title="Télécharger">
                                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt="">
                                </a>`
                                : '—'}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="custom-icon-button dropdown-toggle" title="Actions"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-modifier-depense" data-id="${d.id}">Modifier</a>
                                    <a href="#" class="dropdown-item js-delete-depense" data-id="${d.id}">Supprimer</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });
        }


        /* ===== Load data ===== */
        document.addEventListener('DOMContentLoaded', async () => {
            const projetId = new URLSearchParams(window.location.search).get('id');
            if (!projetId) return;

            try {
                const data = await wpFetch(`/projet/${projetId}/full`);
                renderInfos(data);
                renderEquipe(data);
                renderPhases(data);
                renderPieces(data);
                renderRubriques(data);
                renderDepenses(data);

                // Ajout pour remplir le select rubriques
                 await loadBudgets(projetId);

            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Chargement du projet impossible.'
                });
            }
        });

        /* ====== Save dépense (branche ton endpoint POST si nécessaire) ====== */
        document.getElementById("btnSaveDepense").addEventListener("click", async (e) => {
            e.preventDefault();
            const projetId = new URLSearchParams(window.location.search).get("id");
            if (!projetId) {
                Swal.fire({ icon: "error", text: "Projet ID manquant" });
                return;
            }

            const rubriqueSelect = document.getElementById("rubriques-select");
            const rubriqueId = rubriqueSelect.value;
            const selectedOption = rubriqueSelect.options[rubriqueSelect.selectedIndex];
            const montantMax = parseFloat(selectedOption?.dataset.max || 0);
            const montantAlloue = parseFloat(selectedOption?.dataset.alloue || 0);

            const designation = document.getElementById("depenseDesignation").value.trim();
            const montant = parseFloat(document.getElementById("depenseMontant").value.trim().replace(/\s+/g, "").replace(",", "."));
            const file = document.getElementById("depenseFile").files[0];

            if (!rubriqueId || !designation || isNaN(montant) || montant <= 0) {
                Swal.fire({ icon: "warning", text: "Tous les champs sont obligatoires et le montant doit être valide" });
                return;
            }

            // ⚡ Contrôle 1 : ne pas dépasser le montant max
            if (montant > montantMax) {
                Swal.fire({ icon: "error", text: `Le montant saisi (${montant.toLocaleString("fr-FR")} TND) dépasse le plafond de la rubrique (${montantMax.toLocaleString("fr-FR")} TND).` });
                return;
            }

            // ⚡ Contrôle 2 : ne pas dépasser le cumul autorisé
            if ((montantAlloue + montant) > montantMax) {
                Swal.fire({ icon: "error", text: `Impossible d'ajouter cette dépense : cumul (${(montantAlloue + montant).toLocaleString("fr-FR")} TND) dépasse le plafond de la rubrique (${montantMax.toLocaleString("fr-FR")} TND).` });
                return;
            }

            const fd = new FormData();
            fd.append("projet_id", projetId);
            fd.append("rubrique_id", rubriqueId);
            fd.append("designation", designation);
            fd.append("montant", montant);
            if (file) fd.append("piece_jointe", file);

            try {
                const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/depense`, {
                    method: "POST",
                    body: fd,
                    credentials: "include",
                    headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
                });

                const data = await res.json();
                if (!res.ok) throw new Error(data.message || "Erreur serveur");

                Swal.fire({ icon: "success", text: "Dépense ajoutée avec succès" });
                closeModal("modalAjouterDepense");

                // 🔄 recharger la liste des dépenses
                const projetData = await wpFetch(`/projet/${projetId}/full`);
                renderDepenses(projetData);

            } catch (err) {
                Swal.fire({ icon: "error", text: "Erreur : " + err.message });
            }
        });



        /* Fermer les panneaux si on clique sur le backdrop ou appuie sur Echap */
        ['modalDepense', 'modalPiecesJointes', 'modalRubrique', 'modalEquipe'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('click', (e) => {
                    // If the click is on the overlay background itself
                    if (e.target === el) {
                        closeModal(id);
                    }
                });
            }
        });

        // Close any open modal with the 'Escape' key
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape") {
                ['modalDepense', 'modalPiecesJointes', 'modalRubrique', 'modalEquipe'].forEach(id => {
                    const modal = document.getElementById(id);
                    if (modal && modal.style.display === 'flex') {
                        closeModal(id);
                    }
                });
            }
        });

        document.getElementById('add-rubrique-item').addEventListener('click', () => {
            const container = document.getElementById('rubriques-container');
            const newRubriqueItem = document.createElement('div');
            newRubriqueItem.className = 'rubrique-item';
            newRubriqueItem.style.border = '1px solid #d8d4b7';
            newRubriqueItem.style.borderRadius = '8px';
            newRubriqueItem.style.padding = '15px';
            newRubriqueItem.style.marginBottom = '15px';

            newRubriqueItem.innerHTML = `
                <div class="form-group">
                    <label>Rubrique Budgétaire</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pourcentage a ne pas dépassé :</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pourcentage a ne pas dépassé :</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" readonly placeholder="importer">
                        <input type="file" style="display:none">
                        <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()" style="background-color: #d8d4b7; color: var(--ink);"><i class="fa fa-upload"></i> Importer</button>
                    </div>
                </div>
            `;
            container.appendChild(newRubriqueItem);
        });

        document.getElementById('add-equipe-item').addEventListener('click', () => {
            const container = document.getElementById('equipe-container');
            const newEquipeItem = document.createElement('div');
            newEquipeItem.className = 'equipe-item';
            newEquipeItem.style.border = '1px solid #d8d4b7';
            newEquipeItem.style.borderRadius = '8px';
            newEquipeItem.style.padding = '15px';
            newEquipeItem.style.marginBottom = '15px';

            newEquipeItem.innerHTML = `
                <div class="form-group">
                    <label>Membre</label>
                    <select>
                        <option selected>Monia Zeidi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rôle</label>
                        <select>
                        <option selected>Responsable Du Projet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input class="input-file-text" readonly placeholder="importer">
                        <input type="file" style="display:none">
                        <button type="button" class="btn-importer" onclick="this.previousElementSibling.click()"
                            style="background-color: #A6A485;">
                            Importer</button>
                    </div>
                </div>
            `;
            container.appendChild(newEquipeItem);
        });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- Animate Progress Bars on Load ---
        document.querySelectorAll(".custom-progress-indicator-fill").forEach(bar => {
            // Use a small timeout to allow the browser to render the initial 0% width
            setTimeout(() => {
                const targetWidth = bar.dataset.targetWidth;
                if (targetWidth) {
                    bar.style.width = targetWidth;
                }
            }, 100);
        });

        // --- Modal for "Équipe du projet" ---
        const btnAjouterMembre = document.getElementById("ajouterMembreBtn");
        const modalEquipe = document.getElementById("modalObjectifs");
        const popupEquipe = modalEquipe.querySelector(".popup-container");

        if (btnAjouterMembre && modalEquipe) {
            btnAjouterMembre.addEventListener("click", function (e) {
                e.preventDefault();
                modalEquipe.style.display = "flex";
            });
        }

        if (modalEquipe && popupEquipe) {
            modalEquipe.addEventListener("click", function (e) {
                if (!popupEquipe.contains(e.target)) {
                    modalEquipe.style.display = "none";
                }
            });
        }

        const fileInputEquipe = document.getElementById('file-input-piece-jointe');
        const textInputEquipe = document.getElementById('piece-jointe-text');
        if (fileInputEquipe && textInputEquipe) {
            fileInputEquipe.addEventListener('change', () => {
                textInputEquipe.value = fileInputEquipe.files.length > 0 ? fileInputEquipe.files[0].name :
                    'importer';
            });
        }

        // --- Modal for "Équipe du projet" - Dynamic members ---
        const membresContainer = document.getElementById("membres-container");
        const addMembreBtn = modalEquipe.querySelector(".add-membre-button");

        if (membresContainer && addMembreBtn) {
            const membreTemplate = membresContainer.innerHTML;

            addMembreBtn.addEventListener("click", function () {
                const lastMembre = membresContainer.querySelector('.form-section-box:last-child');
                if (lastMembre && !lastMembre.querySelector('.delete-item-btn')) {
                    const deleteBtnHTML =
                        '<button type="button" class="delete-item-btn"> <img width="20px" src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"alt = "Icon-trash-2.png" > </button > ';
                    lastMembre.insertAdjacentHTML('beforeend', deleteBtnHTML);
                }
                membresContainer.insertAdjacentHTML('beforeend', membreTemplate);
            });

            membresContainer.addEventListener("click", function (e) {
                if (e.target.closest('.delete-item-btn')) {
                    e.stopPropagation(); // <-- FIX: Prevents the modal from closing
                    e.target.closest('.form-section-box').remove();
                }
            });
        }


        // --- Modal for "Pièces jointes" ---
        const btnModifierPJ = document.getElementById("modifierPiecesJointesBtn");
        const modalPJ = document.getElementById("modalPiecesJointes");
        const popupPJ = modalPJ.querySelector(".popup-container");

        if (btnModifierPJ && modalPJ) {
            btnModifierPJ.addEventListener("click", function (e) {
                e.preventDefault();
                modalPJ.style.display = "flex";
            });
        }

        if (modalPJ && popupPJ) {
            modalPJ.addEventListener("click", function (e) {
                if (!popupPJ.contains(e.target)) {
                    modalPJ.style.display = "none";
                }
            });
        }

        const fileInputPj = document.getElementById('file-input-pj');
        const textInputPj = document.getElementById('pj-text');
        if (fileInputPj && textInputPj) {
            fileInputPj.addEventListener('change', () => {
                textInputPj.value = fileInputPj.files.length > 0 ? fileInputPj.files[0].name : 'importer';
            });
        }

        // --- Modal for "Ajouter les Phases" ---
        const btnAjouterPhases = document.getElementById("ajouterPhasesBtn");
        const modalAjouterPhases = document.getElementById("modalAjouterPhases");
        const popupAjouterPhases = modalAjouterPhases.querySelector(".popup-container");
        const phasesContainer = document.getElementById("phases-container");
        const addPhaseBtn = document.querySelector(".add-phase-button");

        if (btnAjouterPhases) {
            btnAjouterPhases.addEventListener("click", function (e) {
                e.preventDefault();
                modalAjouterPhases.style.display = "flex";
            });
        }

        if (modalAjouterPhases) {
            modalAjouterPhases.addEventListener("click", function (e) {
                if (!popupAjouterPhases.contains(e.target) && e.target !== btnAjouterPhases) {
                    modalAjouterPhases.style.display = "none";
                }
            });
        }

        const phaseTemplate = `
            <div class="phase-section">
            <div class="form-group">
            <label>Titre Du Phase</label>
            <input type="text" value="">
            </div>
            <!--<div class="form-group">
            <label>Membres Pour Cette Tache</label>
            <select>
            <option>3 Membres</option>
            <option>4 Membres</option>
            </select>
            </div>-->
            <div class="form-group">
            <label>Etat</label>
            <select>
            <option>Prévu</option>
            <option>En cours</option>
            <option>Terminé</option>
            </select>
            </div>
            </div>`;

        if (addPhaseBtn) {
            addPhaseBtn.addEventListener("click", function () {
                const lastPhase = phasesContainer.querySelector('.phase-section:last-child');
                if (lastPhase && !lastPhase.querySelector('.delete-item-btn')) {
                    const deleteBtnHTML =
                        '<button type="button" class="delete-item-btn"><img width="20px"src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png" alt = "Icon-trash-2.png" > </button > ';
                    lastPhase.insertAdjacentHTML('beforeend', deleteBtnHTML);
                }
                phasesContainer.insertAdjacentHTML('beforeend', phaseTemplate);
            });
        }

        if (phasesContainer) {
            phasesContainer.addEventListener("click", function (e) {
                if (e.target.closest('.delete-item-btn')) {
                    e.stopPropagation(); // <-- FIX: Prevents the modal from closing
                    e.target.closest('.phase-section').remove();
                }
            });
        }

        // --- Modal for "Modifier Phases" ---
        const btnModifierPhases = document.getElementById("modifierPhasesBtn");
        const modalModifierPhases = document.getElementById("modalModifierPhases");
        const popupModifierPhases = modalModifierPhases.querySelector(".popup-container");
        const modifierPhasesContainer = document.getElementById("modifier-phases-container");


        function createPhaseAccordion(phaseNumber, phaseTitle, status, progress) {
            let bodyContent = '';
            let statusClass = '';
            let statusIcon = 'fa-regular fa-clock';
            let statusText = '';

            if (status.trim().toLowerCase() === 'en cours') {
                statusClass = 'phase-status-encours';
                statusText = 'En cours';
                bodyContent = `
                        <p class="nb-text">NB :Les tâches en cours ne peuvent pas être modifiées. Seul leur statut peut être mis à jour.</p>
                        <div class="phase-progress">
                        <div class="progress-container">
                        <div class="custom-progress-indicator">
                        <div class="custom-progress-indicator-fill" style="width: ${progress}%;"></div>
                        </div>
                        </div>
                        <span class="phase-status ${statusClass}"><i class="${statusIcon}"></i> ${statusText}</span>
                        </div>
                        <div class="form-group">
                        <label>Etat</label>
                        <select>
                        <option selected>En Cours</option>
                        <option>Prévu</option>
                        <option>Terminé</option>
                        </select>
                        </div>`;

            } else if (status.trim().toLowerCase() === 'à faire') {
                statusClass = 'phase-status-prevu';
                statusText = 'Prévue';
                bodyContent = `
                <div class="phase-progress">
                <div class="progress-container">
                <div class="custom-progress-indicator">
                <div class="custom-progress-indicator-fill" style="width: ${progress}%;"></div>
                </div>
                </div>
                <span class="phase-status ${statusClass}"><i class="${statusIcon}"></i> ${statusText}</span>
                </div>
                <div class="sub-task-form">
                <div class="form-group">
                <label>Titre</label>
                <input type="text" value="${phaseTitle}">
                </div>
                <div class="form-group">
                <label>Etat</label>
                <select>
                <option selected>Prévu</option>
                <option>En Cours</option>
                </select>
                </div>
                <div class="form-group">
                <label>Membres</label>
                <select>
                <option>5 Membres</option>
                <option>3 Membres</option>
                </select>
                </div>
                </div>`;
            } else { // Terminé
                statusClass = 'phase-status-termine'; // You might need to add styles for this
                statusText = 'Terminé';
                statusIcon = 'fa-solid fa-check-circle';
                bodyContent = `
                <div class="phase-progress">
                <div class="progress-container">
                <div class="custom-progress-indicator">
                <div class="custom-progress-indicator-fill" style="width: ${progress}%;"></div>
                </div>
                </div>
                <span class="phase-status phase-status-encours" style="background-color: #e8f3ec; color: #198754; border-color: #198754;"><i class="fa-solid fa-check"></i> Terminé</span>
                </div>
                <div class="form-group">
                <label>Etat</label>
                <select>
                <option>En Cours</option>
                <option>Prévu</option>
                <option selected>Terminé</option>
                </select>
                </div>`;
            }


            return `
            <div class="phase-accordion">
            <div class="phase-header">
            <h4>Phase ${phaseNumber} : ${phaseTitle}</h4>
            <i class="fa-solid fa-chevron-up"></i>
            </div>
            <div class="phase-body" ${phaseNumber > 1 ? 'style="display: none;"' : ''}>
            ${bodyContent}
            </div>
            </div>`;
        }

        function setupAccordionToggle() {
            modalModifierPhases.querySelectorAll('.phase-accordion .phase-header').forEach(header => {
                header.addEventListener('click', () => {
                    const body = header.nextElementSibling;
                    const icon = header.querySelector('i');

                    const isHidden = body.style.display === 'none' || body.style.display === '';

                    // Close all other accordions
                    modalModifierPhases.querySelectorAll('.phase-body').forEach(b => {
                        if (b !== body) {
                            b.style.display = 'none';
                            const otherIcon = b.previousElementSibling.querySelector('i');
                            otherIcon.classList.remove('fa-chevron-up');
                            otherIcon.classList.add('fa-chevron-down');
                        }
                    });

                    body.style.display = isHidden ? 'block' : 'none';
                    icon.classList.toggle('fa-chevron-up', isHidden);
                    icon.classList.toggle('fa-chevron-down', !isHidden);
                });

                const body = header.nextElementSibling;
                const icon = header.querySelector('i');
                const isHidden = body.style.display === 'none' || body.style.display === '';
                icon.classList.toggle('fa-chevron-up', !isHidden);
                icon.classList.toggle('fa-chevron-down', isHidden);
            });
        }


        if (btnModifierPhases) {
            btnModifierPhases.addEventListener("click", function (e) {
                e.preventDefault();

                modifierPhasesContainer.innerHTML = '';

                const taskRows = document.querySelectorAll("#tasksTable tbody tr");
                taskRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const phaseNumber = cells[0].textContent.trim();
                    const phaseTitle = cells[1].textContent.trim();
                    const status = cells[2].textContent.trim();
                    const progressEl = cells[3].querySelector('.custom-progress-indicator-fill');
                    const progress = progressEl ? parseFloat(progressEl.style.width) : 0;

                    modifierPhasesContainer.insertAdjacentHTML('beforeend', createPhaseAccordion(
                        phaseNumber, phaseTitle, status, progress));
                });

                setupAccordionToggle();
                modalModifierPhases.style.display = "flex";
            });
        }

        if (modalModifierPhases) {
            modalModifierPhases.addEventListener("click", function (e) {
                if (!popupModifierPhases.contains(e.target) && e.target !== btnModifierPhases) {
                    modalModifierPhases.style.display = "none";
                }
            });
        }

        // --- Modal for "Ajouter Tâche" ---
        const modalAjouterTache = document.getElementById("modalAjouterTache");
        const popupAjouterTache = modalAjouterTache.querySelector(".popup-container");
        const tasksTableBody = document.querySelector("#tasksTable tbody");
        const addTaskPhaseHeader = document.getElementById("add-task-phase-header");
        const tachesContainer = document.getElementById("taches-container");
        const addTacheBtn = modalAjouterTache.querySelector(".add-task-button-inner");

        /*
        if (tasksTableBody) {
            tasksTableBody.addEventListener('click', function (e) {
                const addTaskLink = e.target.closest('.js-add-task');
                if (addTaskLink) {
                    e.preventDefault();
                    const row = addTaskLink.closest('tr');
                    const cells = row.querySelectorAll('td');
                    const phaseNumber = cells[0].textContent.trim();
                    const phaseTitle = cells[1].textContent.trim();
                    const status = cells[2].querySelector('span').textContent.trim();

                    let statusClass = '';
                    let statusText = '';
                    if (status.toLowerCase() === 'en cours') {
                        statusClass = 'phase-status-encours';
                        statusText = 'En cours';
                    } else if (status.toLowerCase() === 'à faire') {
                        statusClass = 'phase-status-prevu';
                        statusText = 'Prévu';
                    } else { // Terminé
                        statusClass = 'phase-status-termine';
                        statusText = 'Terminé';
                    }

                    addTaskPhaseHeader.innerHTML = `
                <h4>Phase ${phaseNumber} : ${phaseTitle}</h4>
                <span class="phase-status ${statusClass}"><i class="fa-regular fa-clock"></i> ${statusText}</span>
                `;

                    modalAjouterTache.style.display = 'flex';
                }
            });
        }
            */

        if (tasksTableBody) {
            tasksTableBody.addEventListener('click', function (e) {
                const addTaskLink = e.target.closest('.js-add-task');
                if (addTaskLink) {
                    e.preventDefault();
                    const row = addTaskLink.closest('tr');
                    const cells = row.querySelectorAll('td');
                    const phaseNumber = cells[0].textContent.trim();
                    const phaseTitle = cells[1].textContent.trim();
                    const status = cells[2].querySelector('span').textContent.trim();
                    const phaseId = addTaskLink.dataset.phase; // ⚡ récupéré depuis l’attribut data-phase

                    let statusClass = '';
                    let statusText = '';
                    if (status.toLowerCase() === 'en cours') {
                        statusClass = 'phase-status-encours';
                        statusText = 'En cours';
                    } else if (status.toLowerCase() === 'à faire') {
                        statusClass = 'phase-status-prevu';
                        statusText = 'Prévu';
                    } 
                    else if (status.toLowerCase() === 'prévu') {
                        statusClass = 'phase-status-prevu';
                        statusText = 'Prévu';
                    }
                    else {
                        statusClass = 'phase-status-termine';
                        statusText = 'Terminé';
                    }

                    // ⚡ injecter data-phase-id
                    addTaskPhaseHeader.dataset.phaseId = phaseId;

                    addTaskPhaseHeader.innerHTML = `
                        <h4>Phase ${phaseNumber} : ${phaseTitle}</h4>
                        <span class="phase-status ${statusClass}"><i class="fa-regular fa-clock"></i> ${statusText}</span>
                    `;

                    modalAjouterTache.style.display = 'flex';
                }
            });
        }


        if (modalAjouterTache) {
            modalAjouterTache.addEventListener("click", function (e) {
                if (!popupAjouterTache.contains(e.target)) {
                    modalAjouterTache.style.display = "none";
                }
            });
        }

        if (tachesContainer && addTacheBtn) {
            const taskTemplate = tachesContainer.innerHTML;

            addTacheBtn.addEventListener("click", function () {
                   
                const lastTask = tachesContainer.querySelector('.task-section:last-child');
                if (lastTask && !lastTask.querySelector('.delete-item-btn')) {
                    const deleteBtnHTML =
                        '<button type="button" class="delete-item-btn"><img width="20px" src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"alt = "Icon-trash-2.png" > </button > ';
                    lastTask.insertAdjacentHTML('beforeend', deleteBtnHTML);
                }

                tachesContainer.insertAdjacentHTML('beforeend', taskTemplate);

                //  Recharger les membres dans tous les selects existants
                if (window.LAB_ID > 0) {
                    loadMembresLaboratoire(window.LAB_ID);
                }

            });

            tachesContainer.addEventListener("click", function (e) {
                const deleteBtn = e.target.closest('.delete-item-btn');
                if (deleteBtn) {
                    e.stopPropagation(); // <-- FIX: Prevents the modal from closing
                    deleteBtn.closest('.task-section').remove();
                }
            });
        }


        // --- Modal for "Modifier Tâche" ---
        const modalModifierTache = document.getElementById("modalModifierTache");
        const popupModifierTache = modalModifierTache.querySelector(".popup-container");

        if (tasksTableBody) {
            tasksTableBody.addEventListener('click', function (e) {
                const modifierLink = e.target.closest('.js-modifier-tache');
                if (modifierLink && !modifierLink.classList.contains('disabled')) {
                    e.preventDefault();
                    const row = modifierLink.closest('tr');
                    const cells = row.querySelectorAll('td');
                    const taskTitle = cells[1].textContent.trim();
                    const taskStatus = cells[2].textContent.trim();

                    document.getElementById('modifierTacheTitle').textContent = `Modifier : ${taskTitle}`;
                    document.getElementById('modifierTacheInputTitre').value = taskTitle;
                    document.getElementById('modifierTacheInputEtat').value = taskStatus;

                    modalModifierTache.style.display = 'flex';
                }
            });
        }

        if (modalModifierTache) {
            modalModifierTache.addEventListener("click", function (e) {
                if (!popupModifierTache.contains(e.target)) {
                    modalModifierTache.style.display = "none";
                }
            });
        }


        // --- Global Dropdown Menu Logic ---
        window.addEventListener('click', function (e) {
            const clickedToggle = e.target.closest('.dropdown-toggle');

            document.querySelectorAll('.dropdown').forEach(function (dropdown) {
                const menu = dropdown.querySelector('.dropdown-menu');
                const toggle = dropdown.querySelector('.dropdown-toggle');

                if (toggle !== clickedToggle && menu && menu.classList.contains('show')) {
                    menu.classList.remove('show');
                    if (toggle.id === 'tasksActionsBtn') {
                        const icon = toggle.querySelector('i');
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                }
            });

            if (clickedToggle) {
                e.preventDefault();

                // Update dropdown based on row status
                const tasksTable = document.getElementById('tasksTable');
                const row = clickedToggle.closest('tr');
                if (row && tasksTable && tasksTable.contains(row)) {
                    const status = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                    /*const modifierLink = clickedToggle.nextElementSibling.querySelector(
                        '.js-modifier-phase');
                    if (status === 'en cours' || status === 'terminé') {
                        modifierLink.classList.add('disabled');
                    } else {
                        modifierLink.classList.remove('disabled');
                    }*/
                }

                const menu = clickedToggle.nextElementSibling;
                if (menu) {
                    const wasShown = menu.classList.contains('show');
                    menu.classList.toggle('show');

                    if (clickedToggle.id === 'tasksActionsBtn') {
                        const icon = clickedToggle.querySelector('i');
                        if (!wasShown) {
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        } else {
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
                        }
                    }
                }
            }
        });


        // --- Expense Section Logic ---
        (function ($) {
            const baseDT = {
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: 't<"bottom"p>',
                language: {
                    paginate: {
                        first: "<i class='fa fa-angles-left'></i>",
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>",
                        last: "<i class='fa fa-angles-right'></i>"
                    },
                    emptyTable: "Aucune donnée trouvée",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                }
            };

            let dtDepense = $('#depenseTable').DataTable(baseDT);
            let dtRebriques = $('#rebriquesTable').DataTable(baseDT);


            $('#depenseSearch').on('keyup', function () {
                dtDepense.search(this.value).draw();
            });

            $('#rebriquesSearch').on('keyup', function () {
                dtRebriques.search(this.value).draw();
            });

            $('.expense-tab-btn').on('click', function () {
                const tabId = $(this).data('tab');
                $('.expense-tab-btn').removeClass('active');
                $(this).addClass('active');
                $('.expense-tab-panel').removeClass('active');
                $('#' + tabId).addClass('active');
            });
        })(jQuery);

        // --- Modal for "Ajouter Rubrique" ---
        const btnAjouterRubrique = document.getElementById("addRubriqueBtn");
        const modalAjouterRubrique = document.getElementById("modalAjouterRubrique");
        const popupAjouterRubrique = modalAjouterRubrique.querySelector(".popup-container");

        if (btnAjouterRubrique) {
            btnAjouterRubrique.addEventListener("click", function (e) {
                e.preventDefault();
                modalAjouterRubrique.style.display = "flex";
            });
        }

        if (modalAjouterRubrique) {
            modalAjouterRubrique.addEventListener("click", function (e) {
                if (!popupAjouterRubrique.contains(e.target)) {
                    modalAjouterRubrique.style.display = "none";
                }
            });
        }

        const rubriquesContainer = document.getElementById('rubriques-container');
        const addRubriqueButton = document.querySelector('.add-rubrique-button');
        const rubriqueTemplate = `
        <div class="rubrique-item-container">
        <div class="form-section-box">
        <div class="form-group">
        <label>Rubrique Budgétaire</label>
        <input type="text" value="">
        </div>
        <div class="form-group">
        <label>Pourcentage a ne pas dépassé :</label>
        <input type="text" value="">
        </div>
        <div class="form-group">
        <label>Pièce jointe</label>
        <div class="input-file-wrapper">
        <input class="input-file-text" readonly placeholder="importer">
        <input type="file" class="input-file-hidden" style="display:none">
        <button type="button" class="btn-importer"> <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"alt="Icon-uploadwhite.png" width="12px"> Importer</button>
        </div>
        </div>
        </div>
        </div>`;

        const rubriqueDeleteBtnHTML =
            '<button type="button" class="delete-item-btn rubrique-btn" title="Supprimer"><img width="20px" src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png" alt = "Icon-trash-2.png" > </button > ';

        if (addRubriqueButton) {
            addRubriqueButton.addEventListener('click', function () {
                const lastRubrique = rubriquesContainer.querySelector(
                    '.rubrique-item-container:last-child .form-section-box');
                if (lastRubrique && !lastRubrique.querySelector('.delete-item-btn')) {
                    lastRubrique.insertAdjacentHTML('beforeend', rubriqueDeleteBtnHTML);
                }
                rubriquesContainer.insertAdjacentHTML('beforeend', rubriqueTemplate);
            });
        }

        if (rubriquesContainer) {
            rubriquesContainer.addEventListener('click', function (e) {
                const importBtn = e.target.closest('.btn-importer');
                if (importBtn) {
                    importBtn.previousElementSibling.click();
                    return;
                }

                const deleteBtn = e.target.closest('.delete-item-btn');
                if (deleteBtn) {
                    e.stopPropagation(); // <-- FIX: Prevents the modal from closing
                    deleteBtn.closest('.rubrique-item-container').remove();
                }
            });

            rubriquesContainer.addEventListener('change', function (e) {
                const fileInput = e.target.closest('.input-file-hidden');
                if (fileInput) {
                    const textInput = fileInput.previousElementSibling;
                    textInput.value = fileInput.files.length > 0 ? fileInput.files[0].name : 'importer';
                }
            });
        }

        // --- Modal for "Ajouter Dépense" ---
        const btnAjouterDepense = document.getElementById("addDepenseBtn");
        const modalAjouterDepense = document.getElementById("modalAjouterDepense");
        const popupAjouterDepense = modalAjouterDepense.querySelector(".popup-container");

        if (btnAjouterDepense) {
            btnAjouterDepense.addEventListener("click", function (e) {
                e.preventDefault();
                modalAjouterDepense.style.display = "flex";
            });
        }

        if (modalAjouterDepense) {
            modalAjouterDepense.addEventListener("click", function (e) {
                if (!popupAjouterDepense.contains(e.target)) {
                    modalAjouterDepense.style.display = "none";
                }
            });
        }

        const depenseFileInputContainer = modalAjouterDepense.querySelector('.input-file-wrapper');
        if (depenseFileInputContainer) {
            const fileInput = depenseFileInputContainer.querySelector('.input-file-hidden');
            const textInput = depenseFileInputContainer.querySelector('.input-file-text');
            const importBtn = depenseFileInputContainer.querySelector('.btn-importer');

            importBtn.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', () => {
                textInput.value = fileInput.files.length > 0 ? fileInput.files[0].name : 'importer';
            });
        }

        // --- Modal for "Modifier Rubrique" ---
        const rebriquesTable = document.getElementById('rebriquesTable');
        const modalModifierRubrique = document.getElementById("modalModifierRubrique");
        const popupModifierRubrique = modalModifierRubrique.querySelector(".popup-container");

        if (rebriquesTable) {
            rebriquesTable.addEventListener('click', function (e) {
                if (e.target.closest('.js-modifier-rubrique')) {
                    e.preventDefault();
                    modalModifierRubrique.style.display = 'flex';
                }
            });
        }

        if (modalModifierRubrique) {
            modalModifierRubrique.addEventListener("click", function (e) {
                if (!popupModifierRubrique.contains(e.target)) {
                    modalModifierRubrique.style.display = "none";
                }
            });

            const fileInputContainer = modalModifierRubrique.querySelector('.input-file-wrapper');
            if (fileInputContainer) {
                const fileInput = fileInputContainer.querySelector('.input-file-hidden');
                const textInput = fileInputContainer.querySelector('.input-file-text');
                const importBtn = fileInputContainer.querySelector('.btn-importer');

                importBtn.addEventListener('click', () => fileInput.click());

                fileInput.addEventListener('change', () => {
                    textInput.value = fileInput.files.length > 0 ? fileInput.files[0].name : 'importer';
                });
            }
        }

        // --- Modal for "Modifier Dépense" ---
        const depenseTable = document.getElementById('depenseTable');
        const modalModifierDepense = document.getElementById("modalModifierDepense");
        const popupModifierDepense = modalModifierDepense.querySelector(".popup-container");

        if (depenseTable) {
            depenseTable.addEventListener('click', function (e) {
                if (e.target.closest('.js-modifier-depense')) {
                    e.preventDefault();
                    modalModifierDepense.style.display = 'flex';
                }
            });
        }

        if (modalModifierDepense) {
            modalModifierDepense.addEventListener("click", function (e) {
                if (!popupModifierDepense.contains(e.target)) {
                    modalModifierDepense.style.display = "none";
                }
            });

            const fileInputContainer = modalModifierDepense.querySelector('.input-file-wrapper');
            if (fileInputContainer) {
                const fileInput = fileInputContainer.querySelector('.input-file-hidden');
                const textInput = fileInputContainer.querySelector('.input-file-text');
                const importBtn = fileInputContainer.querySelector('.btn-importer');

                importBtn.addEventListener('click', () => fileInput.click());

                fileInput.addEventListener('change', () => {
                    textInput.value = fileInput.files.length > 0 ? fileInput.files[0].name : 'importer';
                });
            }
        }


    });
</script>


<script>
document.addEventListener("DOMContentLoaded", async () => {

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

    document.getElementById('btnSaveEquipe').addEventListener('click', async () => {
        const projetId = new URLSearchParams(window.location.search).get('id');
        if (!projetId) {
            Swal.fire({icon:'error', text:'Projet ID manquant'});
            return;
        }

        const membre = document.getElementById('membre').value;
        const role   = document.getElementById('role').value;
        const email  = document.querySelector('#membres-container input[type="email"]')?.value || '';
        const grade  = ''; // si tu ajoutes un champ grade plus tard
        const file   = document.getElementById('file-input-piece-jointe').files[0];

        const fd = new FormData();
        fd.append('user_id', membre);
        fd.append('role', role);
        fd.append('email', email);
        fd.append('grade', grade);
        if (file) fd.append('piece_jointe', file);

        try {
            const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/equipe`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'X-WP-Nonce': window.PMSettings?.nonce || '' },
                body: fd
            });

            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Erreur serveur');

            Swal.fire({icon:'success', text:'Membre ajouté avec succès'});
            closeModal('modalObjectifs');

            // 🔄 Recharger l'équipe après insertion
            const projetData = await wpFetch(`/projet/${projetId}/full`);
            renderEquipe(projetData);

        } catch (err) {
            Swal.fire({icon:'error', text:'Erreur : ' + err.message});
        }
    });


window.LAB_ID = 0;
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
function extractLabId(resp) {
        if (!resp) return 0;
        if (Array.isArray(resp) && resp.length && (resp[0].id || resp[0].laboratoire_id)) {
            return parseInt(resp[0].id || resp[0].laboratoire_id, 10);
        }
        if (resp.id) return parseInt(resp.id, 10);
        if (resp.laboratoire_id) return parseInt(resp.laboratoire_id, 10);
        return 0;
    }
async function ensureLabId() {
        // 1) déjà connu ?
        if (LAB_ID > 0) return LAB_ID;

        // 2) essayer ton endpoint existant
        try {
            console.log('test uleb');
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

async function loadMembresLaboratoire(labId) {
    const selectMain = document.getElementById("membre");
    const selectsTasks = document.querySelectorAll("select.membres_taches");

    // vider #membre si existe
    if (selectMain) {
        selectMain.innerHTML = '<option value="">Sélectionnez un membre...</option>';
    }
    // vider tous les selects .membres_taches
    selectsTasks.forEach(sel => {
        sel.innerHTML = '<option value="">Sélectionnez un membre...</option>';
    });

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

        const membres = result?.data || [];

        if (!Array.isArray(membres) || !membres.length) {
            if (selectMain) selectMain.innerHTML = '<option value="">Aucun membre trouvé</option>';
            selectsTasks.forEach(sel => sel.innerHTML = '<option value="">Aucun membre trouvé</option>');
            return;
        }

        membres.forEach(m => {
            const opt = document.createElement("option");
            opt.value = m.user_id || m.id;  
            opt.textContent = m.user_display_name || m.nom || "—";

            if (m.user_email) opt.dataset.email = m.user_email;
            if (m.grade) opt.dataset.grade = m.grade;
            if (m.specialite) opt.dataset.specialite = m.specialite;
            if (m.avatar_url) opt.dataset.avatar = m.avatar_url;

            // Ajouter à #membre
            if (selectMain) selectMain.appendChild(opt.cloneNode(true));

            // Ajouter à tous les .membres_taches
            selectsTasks.forEach(sel => sel.appendChild(opt.cloneNode(true)));
        });

    } catch (e) {
        console.error("Erreur chargement membres :", e);
        if (selectMain) selectMain.innerHTML = '<option value="">Erreur chargement</option>';
        selectsTasks.forEach(sel => sel.innerHTML = '<option value="">Erreur chargement</option>');
    }
}


    const laboId = await ensureLabId();

    loadMembresLaboratoire(laboId);
    window.loadMembresLaboratoire = loadMembresLaboratoire;



});

// Fonction suppression d’un membre d’équipe
async function deleteMembre(projetId, membreId) {
    if (!projetId || !membreId) return;

    // Confirmation avec SweetAlert (si dispo)
    const confirm = await Swal.fire({
        title: "Confirmer la suppression ?",
        text: "Ce membre sera retiré du projet.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c60000",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    });

    if (!confirm.isConfirmed) return;

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/equipe/${membreId}`, {
            method: "DELETE",
            credentials: "include",
            headers: {
                "X-WP-Nonce": window.PMSettings?.nonce || ""
            }
        });

        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Erreur serveur");

        Swal.fire({ icon: "success", text: "Membre supprimé avec succès" });

        // Recharger la liste des membres
        const projetData = await wpFetch(`/projet/${projetId}/full`);
        renderEquipe(projetData);

    } catch (err) {
        Swal.fire({ icon: "error", text: "Erreur : " + err.message });
    }
}

// Binding des boutons supprimer
document.addEventListener("click", function(e) {
    const btn = e.target.closest(".retire-btn");
    if (btn) {
        const membreId = btn.dataset.id;
        const projetId = new URLSearchParams(window.location.search).get("id");
        deleteMembre(projetId, membreId);
    }
});

/*
document.addEventListener("DOMContentLoaded", async () => {
    const laboId = await ensureLabId();
    loadMembresLaboratoire(laboId);
});
*/


// --- Sauvegarde des phases depuis le modal ---
document.querySelector('#modalAjouterPhases .btn-enregistrer').addEventListener('click', async () => {
    const projetId = new URLSearchParams(window.location.search).get('id');
    if (!projetId) {
        Swal.fire({icon:'error', text:'Projet ID manquant'});
        return;
    }

    // Collecte toutes les phases ajoutées dans le modal
    const phases = [];
    document.querySelectorAll('#phases-container .phase-section').forEach(sec => {
        const titre = sec.querySelector('input[type="text"]').value.trim();
        const etat  = sec.querySelector('select:last-of-type').value;
        const membreSelect = sec.querySelector('select:nth-of-type(1)');
        const membres = membreSelect ? [membreSelect.value] : [];

        if (titre) { // éviter d'insérer des phases vides
            phases.push({
                titre_phase: titre,
                etat,
                membres
            });
        }
    });

    if (!phases.length) {
        Swal.fire({icon:'warning', text:'Veuillez saisir au moins une phase'});
        return;
    }

    try {
        for (const ph of phases) {
            const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/phase`, {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || '',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(ph)
            });
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Erreur API');
        }

        Swal.fire({icon:'success', text:'Phases ajoutées avec succès'});
        closeModal('modalAjouterPhases');

        // 🔄 Recharger la liste des phases pour le projet
        const projetData = await wpFetch(`/projet/${projetId}/full`);
        renderPhases(projetData);

    } catch (err) {
        Swal.fire({icon:'error', text:'Erreur : ' + err.message});
    }
});

document.querySelector('#modalAjouterTache .btn-enregistrer').addEventListener('click', async () => {
    const projetId = new URLSearchParams(window.location.search).get('id');
    if (!projetId) {
        Swal.fire({ icon: 'error', text: 'Projet ID manquant' });
        return;
    }

    const phaseId = document.querySelector('#add-task-phase-header')?.dataset.phaseId;
    if (!phaseId) {
        Swal.fire({ icon: 'error', text: 'Phase ID manquant' });
        return;
    }

    // 👉 On collecte toutes les tâches
    const sections = document.querySelectorAll('#taches-container .task-section');
    const taches = [];

    sections.forEach(section => {
        const t = {
            titre_tache: section.querySelector('input[type="text"]').value.trim(),
            etat: section.querySelector('select:not(.membres_taches)').value,
            membre_id: section.querySelector('select.membres_taches').value || null,
            date_debut: section.querySelectorAll('input[type="date"]')[0]?.value || null,
            date_fin_prevu: section.querySelectorAll('input[type="date"]')[1]?.value || null,
            date_limite: section.querySelectorAll('input[type="date"]')[2]?.value || null
        };
        if (t.titre_tache) {
            taches.push(t);
        }
    });

    if (!taches.length) {
        Swal.fire({ icon: 'warning', text: 'Veuillez saisir au moins une tâche' });
        return;
    }

    try {
        // ⚡ Insérer toutes les tâches
        for (const tache of taches) {
            const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/phase/${phaseId}/tache`, {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || '',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(tache)
            });
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Erreur API');
        }

        Swal.fire({ icon: 'success', text: 'Tâches ajoutées avec succès' });
        closeModal('modalAjouterTache');

        // 🔄 Recharger les phases avec leurs tâches
        const projetData = await wpFetch(`/projet/${projetId}/full`);
        renderPhases(projetData);

    } catch (err) {
        Swal.fire({ icon: 'error', text: 'Erreur : ' + err.message });
    }
});

// ⚡ Ouvrir modal détails tâches (affichage en accordéon)
document.addEventListener("click", async (e) => {
  const link = e.target.closest(".js-view-taches");
  if (!link) return;

  e.preventDefault();
  const phaseId = link.dataset.phase;
  if (!phaseId) return;

  try {
    const res = await fetch(`${API_BASE}/phase/${phaseId}/taches`, {
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" },
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "Erreur API");

    // 🔄 on utilise l’accordéon et pas la table
    renderTachesAccordion(data);

    openModal("modalDetailsTaches");
    document.getElementById("modalDetailsTaches").dataset.phaseId = phaseId;
  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});

// ⚡ Fonction d’affichage accordéon
function renderTachesAccordion(taches) {
  const container = document.getElementById("accordionTaches");
  container.innerHTML = "";

  const currentUserId = Number(window.PMSettings?.userId || 0);

  if (!taches || !taches.length) {
    container.innerHTML = `<p style="text-align:center;color:#888;">Aucune tâche trouvée</p>`;
    return;
  }

  taches.forEach((t) => {
    // Vérifier les droits
    const canEditOrDelete =
      Number(t.created_by) === currentUserId || Number(t.membre_id) === currentUserId;

    // Boutons conditionnels
    const actionsHtml = canEditOrDelete
      ? `
        <button class="btn-edit js-edit-tache" data-id="${t.id}">Modifier</button>
        <button class="custom-button js-delete-tache" data-id="${t.id}">
          <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png" alt="Supprimer">
        </button>
      `
      : `<span style="color:#aaa;font-size:13px;">Aucune action</span>`;

    const html = `
      <div class="tache-accordion">
        <div class="tache-header">
          <span>${t.titre_tache || "Sans titre"} - <em>${t.etat || "—"}</em></span>
          <i class="fa fa-chevron-down"></i>
        </div>
        <div class="tache-body">
          <p><strong>Membre :</strong> ${t.membre_nom || "—"}</p>
          <p><strong>Date début :</strong> ${t.date_debut || "—"}</p>
          <p><strong>Date fin prévue :</strong> ${t.date_fin_prevu || "—"}</p>
          <p><strong>Date limite :</strong> ${t.date_limite || "—"}</p>
          <div class="tache-actions">
            ${actionsHtml}
          </div>
        </div>
      </div>
    `;
    container.insertAdjacentHTML("beforeend", html);
  });

  // Gestion de l’accordéon
  container.querySelectorAll(".tache-header").forEach((header) => {
    header.addEventListener("click", () => {
      const body = header.nextElementSibling;
      const icon = header.querySelector("i");

      const isOpen = body.style.display === "block";
      document.querySelectorAll(".tache-body").forEach((b) => (b.style.display = "none"));
      document.querySelectorAll(".tache-header i").forEach((i) => i.classList.remove("open"));

      if (!isOpen) {
        body.style.display = "block";
        icon.classList.add("open");
      }
    });
  });
}


// Ouvrir modal "Modifier tâche"
document.addEventListener("click", async (e) => {
  const btn = e.target.closest(".js-edit-tache");
  if (!btn) return;
  const tacheId = btn.dataset.id;

  try {
    const res = await fetch(`${API_BASE}/tache/${tacheId}`, {
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" },
    });
    const tache = await res.json();
    if (!res.ok) throw new Error(tache.message || "Erreur API");

    closeModal("modalDetailsTaches"); // ferme modal détails

    // 🆕 remplir ID et champs
    document.getElementById("modifierTacheId").value         = tache.id;
    document.getElementById("modifierTacheInputTitre").value = tache.titre_tache || "";
    document.getElementById("modifierTacheInputEtat").value  = tache.etat || "";
    document.getElementById("modifierTacheInputMembre").value = tache.membre_id || "";
    document.getElementById("modifierTacheInputDebut").value  = tache.date_debut || "";
    document.getElementById("modifierTacheInputFinPrevu").value = tache.date_fin_prevu || "";
    document.getElementById("modifierTacheInputLimite").value   = tache.date_limite || "";


    openModal("modalModifierTache");
    document.getElementById("modalModifierTache").dataset.tacheId = tacheId;

  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});


// Sauvegarde update tâche
document.querySelector("#modalModifierTache .btn-enregistrer").addEventListener("click", async () => {
  const tacheId   = document.getElementById("modalModifierTache").dataset.tacheId;

  // Champs récupérés
  const titre     = document.getElementById("modifierTacheInputTitre").value.trim();
  const etat      = document.getElementById("modifierTacheInputEtat").value;
  const membre_id = document.getElementById("modifierTacheInputMembre").value || null;
  const date_debut    = document.getElementById("modifierTacheInputDebut").value || null;
  const date_fin_prevu= document.getElementById("modifierTacheInputFinPrevu").value || null;
  const date_limite   = document.getElementById("modifierTacheInputLimite").value || null;

  try {
    const res = await fetch(`${API_BASE}/tache/${tacheId}`, {
      method: "PUT",
      credentials: "include",
      headers: {
        "X-WP-Nonce": window.PMSettings?.nonce || "",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        titre_tache: titre,
        etat,
        membre_id,
        date_debut,
        date_fin_prevu,
        date_limite
      }),
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "Erreur API");

    Swal.fire({
        icon: "success",
        text: "Tâche mise à jour avec succès",
        timer: 3000,              // durée 3 secondes
        timerProgressBar: true,   // affiche une barre de progression
        showConfirmButton: false  // pas de bouton "OK"
    });

    closeModal("modalModifierTache");

    // 🔄 recharger détails accordéon
    const phaseId = document.getElementById("modalDetailsTaches").dataset.phaseId;
    loadTaches(phaseId);

  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});


// Suppression tâche
document.addEventListener("click", async (e) => {
  const btn = e.target.closest(".js-delete-tache");
  if (!btn) return;
  const tacheId = btn.dataset.id;

  const confirm = await Swal.fire({
    title: "Supprimer la tâche ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Oui",
    cancelButtonText: "Annuler",
  });
  if (!confirm.isConfirmed) return;

  try {
    const res = await fetch(`${API_BASE}/tache/${tacheId}`, {
      method: "DELETE",
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" },
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "Erreur API");

    Swal.fire({ icon: "success", text: "Tâche supprimée" });

    // 🔄 recharger détails accordéon
    const phaseId = document.getElementById("modalDetailsTaches").dataset.phaseId;
    loadTaches(phaseId);
  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});


async function loadTaches(phaseId) {
  try {
    const res = await fetch(`${API_BASE}/phase/${phaseId}/taches`, {
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" },
    });
    const taches = await res.json();
    renderTachesAccordion(taches);
    openModal("modalDetailsTaches");
  } catch (err) {
    Swal.fire({ icon: "error", text: "Erreur chargement tâches" });
  }
}


// Ouvrir le modal de modification d'une phase
document.addEventListener("click", async (e) => {
  const btn = e.target.closest(".js-modifier-phase");
  if (!btn) return;

  e.preventDefault();
  const phaseId = btn.dataset.phase;
  if (!phaseId) return;

  try {
    const res = await fetch(`${API_BASE}/phase/${phaseId}`, {
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
    });
    const phase = await res.json();
    if (!res.ok) throw new Error(phase.message || "Erreur API");

    // Pré-remplir les champs
    document.getElementById("modifierPhaseId").value = phase.id;
    document.getElementById("modifierPhaseTitre").value = phase.titre_phase || "";
    document.getElementById("modifierPhaseEtat").value = phase.etat || "Prévu";

    // Ouvrir le modal
    openModal("modalModifierPhase");

  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});

// Sauvegarde de la phase modifiée
document.getElementById("btnSavePhase").addEventListener("click", async () => {
  const phaseId = document.getElementById("modifierPhaseId").value;
  const titre   = document.getElementById("modifierPhaseTitre").value.trim();
  const etat    = document.getElementById("modifierPhaseEtat").value;

  try {
    const res = await fetch(`${API_BASE}/phase/${phaseId}`, {
      method: "PUT",
      credentials: "include",
      headers: {
        "X-WP-Nonce": window.PMSettings?.nonce || "",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        titre_phase: titre,
        etat
      })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "Erreur API");

    Swal.fire({
      icon: "success",
      text: "Phase mise à jour avec succès",
      timer: 2500,
      showConfirmButton: false
    });

    closeModal("modalModifierPhase");

    // Recharger la liste des phases
    const projetId = new URLSearchParams(window.location.search).get("id");
    const projetData = await wpFetch(`/projet/${projetId}/full`);
    renderPhases(projetData);

  } catch (err) {
    Swal.fire({ icon: "error", text: err.message });
  }
});


// budget
async function loadBudgets(projetId) {
    const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/budgets`, {
        credentials: "include",
        headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
    });
    const data = await res.json();
    renderBudgets(data);
}

function renderBudgets(input) {
    const budgets = Array.isArray(input) ? input : (input?.budgets || []);
    const tb = document.querySelector("#rebriquesTable tbody");
    const selectRubriques = document.getElementById("rubriques-select");
    const selectRubriques2 = document.getElementById("rubriques-select2");

    

    tb.innerHTML = "";
    if (selectRubriques) {
        selectRubriques.innerHTML = '<option value="">Sélectionnez une rubrique...</option>';
    }
    if (selectRubriques2) {
        selectRubriques2.innerHTML = '<option value="">Sélectionnez une rubrique...</option>';
    }

    if (!budgets.length) {
        tb.innerHTML = `<tr><td colspan="6" style="text-align:center;color:#888">Aucune rubrique</td></tr>`;
        return;
    }

    budgets.forEach((b, idx) => {
        tb.insertAdjacentHTML("beforeend", `
          <tr>
            <td>${String(idx+1).padStart(3,'0')}</td>
            <td>${b.rubrique}</td>
            <td>${Number(b.montant_max).toLocaleString()} TND</td>
            <td>${Number(b.montant_alloue).toLocaleString()} TND</td>
            <td>${b.fichier_justificatif 
                ? `<a href="${b.fichier_justificatif}" target="_blank"><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt=""></a>` 
                : '—'}
            </td>
            <td>
              <div class="dropdown">
                <button class="custom-icon-button dropdown-toggle">⋮</button>
                <div class="dropdown-menu">
                  <a href="#" class="dropdown-item js-modifier-rubrique" data-id="${b.id}">Modifier</a>
                  <a href="#" class="dropdown-item js-delete-rubrique" data-id="${b.id}">Supprimer</a>
                </div>
              </div>
            </td>
          </tr>
        `);

        // ⚡ Ajouter aussi dans le select
        if (selectRubriques) {
            const opt = document.createElement("option");
            opt.value = b.id;
            opt.textContent = `${b.rubrique} (${Number(b.montant_max).toLocaleString()} TND)`;
            opt.dataset.max = b.montant_max;
            opt.dataset.alloue = b.montant_alloue;
            selectRubriques.appendChild(opt);
        }
        // ⚡ Ajouter aussi dans le select
        if (selectRubriques2) {
            const opt = document.createElement("option");
            opt.value = b.id;
            opt.textContent = `${b.rubrique} (${Number(b.montant_max).toLocaleString()} TND)`;
            opt.dataset.max = b.montant_max;
            opt.dataset.alloue = b.montant_alloue;
            selectRubriques2.appendChild(opt);
        }
    });
}



// ⚡ Ajouter rubrique
// ⚡ Sauvegarder rubrique
document.getElementById("btnSaveRubrique").addEventListener("click", async (e) => {
    e.preventDefault();
    const projetId = new URLSearchParams(window.location.search).get("id");
    if (!projetId) return;

    const nom = document.getElementById("rubriqueNom").value.trim();
    const montantMax = document.getElementById("rubriqueMontant").value || 0;
    const file = document.getElementById("rubriqueFile").files[0];

    if (!nom) {
        Swal.fire({ icon: "warning", text: "Veuillez saisir un nom de rubrique" });
        return;
    }

    const fd = new FormData();
    fd.append("rubrique", nom);
    fd.append("montant_max", montantMax);
    fd.append("montant_alloue", 0);
    if (file) fd.append("fichier", file);

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/budget`, {
            method: "POST",
            body: fd,
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
        });

        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Erreur serveur");

        Swal.fire({ icon: "success", text: "Rubrique ajoutée avec succès" });
        closeModal("modalAjouterRubrique");
        loadBudgets(projetId);
    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});


// ⚡ Supprimer rubrique
document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".js-delete-rubrique");
    if (!btn) return;

    const id = btn.dataset.id;
    const confirm = await Swal.fire({title:"Supprimer ?", showCancelButton:true});
    if (!confirm.isConfirmed) return;

    await fetch(`/wp-json/plateforme-recherche/v1/budget/${id}`, {
        method: "DELETE",
        credentials: "include",
        headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
    });
    const projetId = new URLSearchParams(window.location.search).get("id");
    loadBudgets(projetId);
});

//  Ouvrir le modal Modifier rubrique
document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".js-modifier-rubrique");
    if (!btn) return;
    e.preventDefault();

    const rubriqueId = btn.dataset.id;
    if (!rubriqueId) return;

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/budget/${rubriqueId}`, {
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
        });
        const rubrique = await res.json();
        if (!res.ok) throw new Error(rubrique.message || "Erreur API");

        // Pré-remplir les champs du modal
        document.querySelector("#modalModifierRubrique input[type='text']").value = rubrique.rubrique || "";
        document.querySelector("#modalModifierRubrique input[type='number']").value = rubrique.montant_max || 0;

        // Pré-remplir la pièce jointe (affichage du nom de fichier si dispo)
        const fileText = document.querySelector("#modalModifierRubrique .input-file-text");
        if (rubrique.fichier_justificatif && rubrique.fichier_justificatif !== "null") {
            const fileName = rubrique.fichier_justificatif.split("/").pop();
            fileText.value = fileName;

            // ajouter un lien cliquable pour télécharger la pièce
           
        } else {
            fileText.value = "importer";
        }

        // Charger Montant total (somme des rubriques déjà)
        const projetId = new URLSearchParams(window.location.search).get("id");
        if (projetId) {
            const res2 = await fetch(`/wp-json/plateforme-recherche/v1/projet/${projetId}/budgets`, {
                credentials: "include",
                headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
            });
            const allRubriques = await res2.json();
            const total = allRubriques.reduce((sum, r) => sum + Number(r.montant_alloue || 0), 0);
            //document.getElementById("montanttotal2").textContent =
              //  total.toLocaleString("fr-FR", { style: "currency", currency: "TND" });
        }

        // Conserver l'ID rubrique pour la sauvegarde
        document.getElementById("modalModifierRubrique").dataset.rubriqueId = rubriqueId;

        // Ouvrir le modal
        document.getElementById("modalModifierRubrique").style.display = "flex";

    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});

// ⚡ Sauvegarde d’une rubrique (update)

document.querySelector("#modalModifierRubrique .btn-enregistrer").addEventListener("click", async () => {
    const rubriqueId = document.getElementById("modalModifierRubrique").dataset.rubriqueId;
    if (!rubriqueId) return;

    const rubriqueNom = document.querySelector("#modalModifierRubrique input[type='text']").value.trim();
    const montantMax  = document.querySelector("#modalModifierRubrique input[type='number']").value;
    const file        = document.querySelector("#modalModifierRubrique input[type='file']").files[0];

    const fd = new FormData();
    fd.append("rubrique", rubriqueNom);
    fd.append("montant_max", montantMax);
    fd.append("montant_alloue", 0); // tu peux changer si besoin
    if (file) fd.append("fichier", file);

    // ⚠️ Hack pour WordPress : utiliser POST avec _method=PUT
    fd.append("_method", "PUT");

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/budget/${rubriqueId}`, {
            method: "POST", // important : garder POST
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" },
            body: fd
        });

        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Erreur API");

        Swal.fire({ icon: "success", text: "Rubrique mise à jour avec succès" });
        closeModal("modalModifierRubrique");

        const projetId = new URLSearchParams(window.location.search).get("id");
        loadBudgets(projetId);

    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});


document.getElementById("rubriques-select").addEventListener("change", (e) => {
    const selected = e.target.options[e.target.selectedIndex];
    if (!selected) return; // sécurité

    // parseFloat pour bien traiter "0.00"
    const montantAlloue = parseFloat(selected.dataset.max || 0);

    // injecter dans la zone Montant Alloué
    document.querySelector("#modalAjouterDepense .montant-alloue-box .value").textContent =
        montantAlloue.toLocaleString("fr-FR") + " TND";
});


document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".js-modifier-depense");
    if (!btn) return;

    e.preventDefault();
    const depenseId = btn.dataset.id;

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/depense/${depenseId}`, {
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
        });
        const depense = await res.json();
        if (!res.ok) throw new Error(depense.message || "Erreur API");

        // Pré-remplir les champs du modal
        document.querySelector("#rubriques-select2").value = depense.budget_id;
        document.querySelector("#modalModifierDepense input[type='text']").value = depense.montant;
        document.querySelector("#modalModifierDepense textarea").value = depense.designation || "";

        // Pré-remplir pièce jointe (nom si dispo)
        const fileText = document.querySelector("#modalModifierDepense .input-file-text");
        fileText.value = depense.piece_jointe ? depense.piece_jointe.split("/").pop() : "importer";

        // garder l'id dans le modal
        document.getElementById("modalModifierDepense").dataset.depenseId = depenseId;

        // Ouvrir modal
        document.getElementById("modalModifierDepense").style.display = "flex";
    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});


document.querySelector("#modalModifierDepense .btn-enregistrer").addEventListener("click", async () => {
    const depenseId = document.getElementById("modalModifierDepense").dataset.depenseId;

    const rubriqueId  = document.getElementById("rubriques-select2").value;
    const montant     = document.querySelector("#modalModifierDepense input[type='text']").value;
    const designation = document.querySelector("#modalModifierDepense textarea").value.trim();
    const file        = document.querySelector("#modalModifierDepense input[type='file']").files[0];

    const fd = new FormData();
    fd.append("rubrique_id", rubriqueId);
    fd.append("montant", montant.replace(/\s+/g, "").replace(",", "."));
    fd.append("designation", designation);
    if (file) fd.append("piece_jointe", file);

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/depense/${depenseId}`, {
            method: "POST", // ⚠️ WordPress PUT = POST + _method
            body: fd,
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Erreur API");

        Swal.fire({ icon: "success", text: "Dépense modifiée avec succès" });
        closeModal("modalModifierDepense");

        // refresh
        const projetId = new URLSearchParams(window.location.search).get("id");
        const projetData = await wpFetch(`/projet/${projetId}/full`);
        renderDepenses(projetData);

    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});


document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".js-delete-depense");
    if (!btn) return;

    const depenseId = btn.dataset.id;
    const confirm = await Swal.fire({ title: "Supprimer ?", showCancelButton: true });
    if (!confirm.isConfirmed) return;

    try {
        const res = await fetch(`/wp-json/plateforme-recherche/v1/depense/${depenseId}`, {
            method: "DELETE",
            credentials: "include",
            headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Erreur API");

        Swal.fire({ icon: "success", text: "Dépense supprimée" });

        const projetId = new URLSearchParams(window.location.search).get("id");
        const projetData = await wpFetch(`/projet/${projetId}/full`);
        renderDepenses(projetData);

    } catch (err) {
        Swal.fire({ icon: "error", text: err.message });
    }
});

</script>