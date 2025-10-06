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
</style>

<div class="custom-project-wrapper">



    <!-- Informations générales -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Informations générales</h2>
            <div class="custom-header-buttons">
                <a href="#" class="custom-button custom-button-main"><i class="fa-solid fa-lock"></i>
                    Publier espace</a>
            </div>
        </div>
        <div class="custom-box-body">
            <div class="custom-details-list">
                <div class="custom-details-item">
                    <span class="custom-details-label">Intitulé complet :</span>
                    <span class="custom-details-value">Interface cerveau-machine et
                        apprentissage</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Type :</span>
                    <span class="custom-details-value">Européen</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Responsable :</span>
                    <span class="custom-details-value">Pr. R. Nasri</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Période :</span>
                    <span class="custom-details-value">01/03/2024 → 28/02/2026</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Financement :</span>
                    <span class="custom-details-value">90 000 TND (MESRS + coopération
                        allemande)</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Site web de source :</span>
                    <span class="custom-details-value"><a href="http://www.merss.com"
                            target="_blank">www.merss.com</a></span>
                </div>
            </div>
            <h2 class="custom-body-title">Objectifs du projet</h2>
            <ol class="custom-goals-list">
                <li>Développer une interface neuronale portable basée sur des casques EEG à faible coût,
                    interfacée avec
                    une application mobile.</li>
                <li>Intégrer un module d'intelligence artificielle permettant la reconnaissance de
                    signaux moteurs
                    intentionnels à partir de données brutes EEG.</li>
                <li>Tester cliniquement le dispositif sur un échantillon de patients atteints de
                    troubles moteurs (10
                    cas suivis).</li>
                <li>Optimiser les performances du dispositif en conditions réelles et publier les
                    résultats.</li>
                <li>Former deux doctorants dans le cadre du projet (signal + clinique).</li>
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
                    <tr>
                        <td>0000-0001-5109-3700</td>
                        <td>
                            <div class="member-name-cell">
                                <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 436.png"
                                    alt="Pr. Rym Nasri" class="profile-pic">
                                Pr. Rym Nasri
                            </div>
                        </td>
                        <td>Porteur Du Projet</td>
                        <td><a href="mailto:Rym.Nasri@Utm.Tn">Rym.Nasri@Utm.Tn</a></td>
                        <td><button class="custom-icon-button" title="Document"><i
                                    class="fa-solid fa-paperclip"></i></button></td>
                        <td><button class="custom-button retire-btn">

                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="Icon-trash-2.png">
                            </button></td>
                    </tr>
                    <tr>
                        <td>0000-0001-5478-3701</td>
                        <td>
                            <div class="member-name-cell">
                                <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                    alt="Dr. Adel Ben Hmida" class="profile-pic">
                                Dr. Adel Ben Hmida
                            </div>
                        </td>
                        <td>Responsable Matériel & EEG</td>
                        <td><a href="mailto:Adel.Bhmida@Utm.Tn">Adel.Bhmida@Utm.Tn</a></td>
                        <td><button class="custom-icon-button" title="Document"><i
                                    class="fa-solid fa-paperclip"></i></button></td>
                        <td><button class="custom-button retire-btn"> <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="Icon-trash-2.png"></button></td>
                    </tr>
                    <tr>
                        <td>0000-0001-7109-2689</td>
                        <td>
                            <div class="member-name-cell">
                                <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                    alt="M. Houssem Lahmar" class="profile-pic">
                                M. Houssem Lahmar
                            </div>
                        </td>
                        <td>Responsable IA & Apprentissage</td>
                        <td><a href="mailto:Houssem.Lahmar@Etu.Utm.Tn">Houssem.Lahmar@Etu.Utm.Tn</a></td>
                        <td><button class="custom-icon-button" title="Document"><i
                                    class="fa-solid fa-paperclip"></i></button></td>
                        <td><button class="custom-button retire-btn"> <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="Icon-trash-2.png"></button></td>
                    </tr>
                    <tr>
                        <td>0000-0001-3609-8952</td>
                        <td>
                            <div class="member-name-cell">
                                <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 435.png"
                                    alt="Mme. Marwa Trabelsi" class="profile-pic">
                                Mme. Marwa Trabelsi
                            </div>
                        </td>
                        <td>Doctorant – Traitement Signal</td>
                        <td><a href="mailto:Marwa.Trabelsi@Etu.Utm.Tn">Marwa.Trabelsi@Etu.Utm.Tn</a></td>
                        <td><button class="custom-icon-button" title="Document"><i
                                    class="fa-solid fa-paperclip"></i></button></td>
                        <td><button class="custom-button retire-btn"> <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="Icon-trash-2.png"></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Liste des tâches de projet -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Liste des tâches de projet</h2>
            <div class="custom-header-buttons">
                <a href="#" class="custom-button custom-button-alt">Générer Gantt</a>
                <div class="dropdown">
                    <button class="custom-button custom-button-alt dropdown-toggle" id="tasksActionsBtn">
                        Actions <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="tasksActionsBtn">
                        <a class="dropdown-item" href="#" id="ajouterPhasesBtn">Ajouter les
                            phases</a>
                        <a class="dropdown-item" href="#" id="modifierPhasesBtn">Modifier</a>
                        <a class="dropdown-item" href="#">Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table team-table" id="tasksTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Tâche</th>
                        <th>Etat</th>
                        <th>Progression</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
            <table class="custom-data-table team-table" id="teamTable">
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
            <button class="expense-tab-btn active" data-tab="tab-rb">Rebriques budgétaire</button>
            <button class="expense-tab-btn" data-tab="tab-depense">Dépense</button>
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
                            <th>Montant max</th>
                            <th>Montant Alloué</th>
                            <th>Pièces jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                        </tr>
                    </tbody>
                </table>

                <!-- Include Reusable Pagination Component -->
                <?php include 'pagination.php'; ?>
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
                            <th>Rebrique budgétaire</th>
                            <th>Désignation</th>
                            <th>Montant</th>
                            <th>Pièces jointe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                        </tr>
                    </tbody>
                </table>

                <!-- Include Reusable Pagination Component -->
                <?php include 'pagination.php'; ?>
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
                            <option>Doctorant</option>
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
            <button type="button" class="add-membre-button">
                <!-- <i class="fa-solid fa-plus"></i> -->
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png">
                Ajouter Un Membre
            </button>
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
                    <div class="form-group">
                        <label>Membres Pour Cette Tache</label>
                        <select>
                            <option>3 Membres</option>
                            <option>4 Membres</option>
                        </select>
                    </div>
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
                        <input type="text" value="Collecte D'articles Scientifiques">
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
                        <select>
                            <option>Salim Salhi</option>
                            <option>Another Member</option>
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
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" id="modifierTacheInputTitre">
                </div>
                <div class="form-group">
                    <label>Etat</label>
                    <select id="modifierTacheInputEtat">
                        <option>À faire</option>
                        <option>En cours</option>
                        <option>Terminé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Membre</label>
                    <select>
                        <option>Salim Salhi</option>
                        <option>Dr. Amira Kallel</option>
                        <option>Sami Ben Ali</option>
                        <option>Leila Jouini</option>
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
        </form>
    </div>
</div>


<!-- Modal for Ajouter Rubrique -->
<div class="modal-overlay" id="modalAjouterRubrique" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Rubriques budgétaire</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="montant-total-box">
                <span class="label">Montant Total :</span>
                <span class="value">520 000 TND</span>
            </div>
            <div id="rubriques-container">
                <div class="rubrique-item-container">
                    <div class="form-section-box">
                        <div class="form-group">
                            <label>Rebrique Budgétaire</label>
                            <input type="text" value="Achat Matériels Du Labo">
                        </div>
                        <div class="form-group">
                            <label>Montant a ne pas dépassé :</label>
                            <input type="text" value="10 000 TND">
                        </div>
                        <div class="form-group">
                            <label>Pièce jointe</label>
                            <div class="input-file-wrapper">
                                <input class="input-file-text" readonly placeholder="importer">
                                <input type="file" class="input-file-hidden" style="display:none">
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
            <button type="button" class="add-rubrique-button">
                <!-- <i class="fa-solid fa-plus"></i> * -->
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 335.png"
                    alt="Groupe 335.png">
                Ajouter Autre
            </button>
        </form>
    </div>
</div>

<!-- Modal for Ajouter Dépense -->
<div class="modal-overlay" id="modalAjouterDepense" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Dépense</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label>Rebrique Budgétaire</label>
                <select>
                    <option>Achat Matériels Du Labo</option>
                    <option>Fournitures du bureau</option>
                    <option>Matériel informatique</option>
                    <option>frais généraux</option>
                </select>
            </div>
            <div class="montant-alloue-box">
                <span class="label">Montant Alloué :</span>
                <span class="value">234 000 TND</span>
            </div>
            <div class="form-group">
                <label>Montant</label>
                <div class="input-with-unit">
                    <input type="text" value="75 000">
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
                <span class="value">520 000 TND</span>
            </div>
            <div class="form-section-box">
                <div class="form-group">
                    <label>Rebrique Budgétaire</label>
                    <input type="text" value="Fournitures du bureau">
                </div>
                <div class="form-group">
                    <label>Pourcentage a ne pas dépassé :</label>
                    <input type="text" value="10 000 TND">
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
                <label>Rebrique Budgétaire</label>
                <select>
                    <option>Achat Matériels Du Labo</option>
                    <option selected>Fournitures du bureau</option>
                    <option>Matériel informatique</option>
                    <option>frais généraux</option>
                </select>
            </div>
            <div class="montant-alloue-box">
                <span class="label">Montant Alloué :</span>
                <span class="value">54 000 TND</span>
            </div>
            <div class="form-group">
                <label>Montant</label>
                <div class="input-with-unit">
                    <input type="text" value="54 000">
                    <span>TND</span>
                </div>
            </div>
            <div class="form-group">
                <label>Désignation</label>
                <textarea rows="4">Achat de fournitures de bureau pour le Q1.</textarea>
            </div>
            <div class="form-group">
                <label>Pièce jointe</label>
                <div class="input-file-wrapper">
                    <input class="input-file-text" readonly placeholder="importer" value="facture_fournitures.pdf">
                    <input type="file" class="input-file-hidden" style="display:none">
                    <button type="button" class="btn-importer"><i class="fa-solid fa-filter"></i>
                        Importer</button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
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
            btnAjouterMembre.addEventListener("click", function(e) {
                e.preventDefault();
                modalEquipe.style.display = "flex";
            });
        }

        if (modalEquipe && popupEquipe) {
            modalEquipe.addEventListener("click", function(e) {
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

            addMembreBtn.addEventListener("click", function() {
                const lastMembre = membresContainer.querySelector('.form-section-box:last-child');
                if (lastMembre && !lastMembre.querySelector('.delete-item-btn')) {
                    const deleteBtnHTML =
                        '<button type="button" class="delete-item-btn"> <img width="20px" src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"alt = "Icon-trash-2.png" > </button > ';
                    lastMembre.insertAdjacentHTML('beforeend', deleteBtnHTML);
                }
                membresContainer.insertAdjacentHTML('beforeend', membreTemplate);
            });

            membresContainer.addEventListener("click", function(e) {
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
            btnModifierPJ.addEventListener("click", function(e) {
                e.preventDefault();
                modalPJ.style.display = "flex";
            });
        }

        if (modalPJ && popupPJ) {
            modalPJ.addEventListener("click", function(e) {
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
            btnAjouterPhases.addEventListener("click", function(e) {
                e.preventDefault();
                modalAjouterPhases.style.display = "flex";
            });
        }

        if (modalAjouterPhases) {
            modalAjouterPhases.addEventListener("click", function(e) {
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
<div class="form-group">
<label>Membres Pour Cette Tache</label>
<select>
<option>3 Membres</option>
<option>4 Membres</option>
</select>
</div>
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
            addPhaseBtn.addEventListener("click", function() {
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
            phasesContainer.addEventListener("click", function(e) {
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
            btnModifierPhases.addEventListener("click", function(e) {
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
            modalModifierPhases.addEventListener("click", function(e) {
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

        if (tasksTableBody) {
            tasksTableBody.addEventListener('click', function(e) {
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

        if (modalAjouterTache) {
            modalAjouterTache.addEventListener("click", function(e) {
                if (!popupAjouterTache.contains(e.target)) {
                    modalAjouterTache.style.display = "none";
                }
            });
        }

        if (tachesContainer && addTacheBtn) {
            const taskTemplate = tachesContainer.innerHTML;

            addTacheBtn.addEventListener("click", function() {
                const lastTask = tachesContainer.querySelector('.task-section:last-child');
                if (lastTask && !lastTask.querySelector('.delete-item-btn')) {
                    const deleteBtnHTML =
                        '<button type="button" class="delete-item-btn"><img width="20px" src = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"alt = "Icon-trash-2.png" > </button > ';
                    lastTask.insertAdjacentHTML('beforeend', deleteBtnHTML);
                }

                tachesContainer.insertAdjacentHTML('beforeend', taskTemplate);

            });

            tachesContainer.addEventListener("click", function(e) {
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
            tasksTableBody.addEventListener('click', function(e) {
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
            modalModifierTache.addEventListener("click", function(e) {
                if (!popupModifierTache.contains(e.target)) {
                    modalModifierTache.style.display = "none";
                }
            });
        }


        // --- Global Dropdown Menu Logic ---
        window.addEventListener('click', function(e) {
            const clickedToggle = e.target.closest('.dropdown-toggle');

            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
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
                    const modifierLink = clickedToggle.nextElementSibling.querySelector(
                        '.js-modifier-tache');
                    if (status === 'en cours' || status === 'terminé') {
                        modifierLink.classList.add('disabled');
                    } else {
                        modifierLink.classList.remove('disabled');
                    }
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
        (function($) {
            const baseDT = {
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: '<"top">rt<"clear">', // Hide default search (f) and length (l) controls
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

            // Initialize reusable pagination components
            PMOPagination.init(dtDepense);
            PMOPagination.init(dtRebriques);


            $('#depenseSearch').on('keyup', function() {
                dtDepense.search(this.value).draw();
            });

            $('#rebriquesSearch').on('keyup', function() {
                dtRebriques.search(this.value).draw();
            });

            $('.expense-tab-btn').on('click', function() {
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
            btnAjouterRubrique.addEventListener("click", function(e) {
                e.preventDefault();
                modalAjouterRubrique.style.display = "flex";
            });
        }

        if (modalAjouterRubrique) {
            modalAjouterRubrique.addEventListener("click", function(e) {
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
<label>Rebrique Budgétaire</label>
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
            addRubriqueButton.addEventListener('click', function() {
                const lastRubrique = rubriquesContainer.querySelector(
                    '.rubrique-item-container:last-child .form-section-box');
                if (lastRubrique && !lastRubrique.querySelector('.delete-item-btn')) {
                    lastRubrique.insertAdjacentHTML('beforeend', rubriqueDeleteBtnHTML);
                }
                rubriquesContainer.insertAdjacentHTML('beforeend', rubriqueTemplate);
            });
        }

        if (rubriquesContainer) {
            rubriquesContainer.addEventListener('click', function(e) {
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

            rubriquesContainer.addEventListener('change', function(e) {
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
            btnAjouterDepense.addEventListener("click", function(e) {
                e.preventDefault();
                modalAjouterDepense.style.display = "flex";
            });
        }

        if (modalAjouterDepense) {
            modalAjouterDepense.addEventListener("click", function(e) {
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
            rebriquesTable.addEventListener('click', function(e) {
                if (e.target.closest('.js-modifier-rubrique')) {
                    e.preventDefault();
                    modalModifierRubrique.style.display = 'flex';
                }
            });
        }

        if (modalModifierRubrique) {
            modalModifierRubrique.addEventListener("click", function(e) {
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
            depenseTable.addEventListener('click', function(e) {
                if (e.target.closest('.js-modifier-depense')) {
                    e.preventDefault();
                    modalModifierDepense.style.display = 'flex';
                }
            });
        }

        if (modalModifierDepense) {
            modalModifierDepense.addEventListener("click", function(e) {
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