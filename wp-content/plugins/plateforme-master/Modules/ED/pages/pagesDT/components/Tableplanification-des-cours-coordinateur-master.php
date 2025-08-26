<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
        width: 200px;
        /* Adjusted width */
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
        display: block;
        margin: 0 auto;
    }

    .trash-icon {
        width: 20px;
        display: block;
        margin: 0 auto;
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
        padding: 10px 35px;
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

    table.dataTable thead th {
        text-align: center;
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

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1em;
        display: flex;
        justify-content: flex-end;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 2px solid #BF0404 !important;
        background-color: #fff;
        padding: 5px 12px;
        border-radius: 4px;
        cursor: pointer;
        color: #BF0404 !important;
        font-weight: bold;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #c60000;
        /* color: white !important; */
        border-color: #c60000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: default;
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

    .accordion-content .tab-panel .dataTables_wrapper .dataTables_paginate .previous,
    .accordion-content .tab-panel .dataTables_wrapper .dataTables_paginate .next {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .accordion-content .tab-panel .dataTables_wrapper .dataTables_paginate .paginate_button i {
        color: #B60303 !important;
    }

    .accordion-content .tab-panel .dataTables_wrapper .dataTables_paginate span a {
        border: none !important;
        background-color: #ffffff !important;
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
        margin-bottom: 20px;
    }

    .popup-form .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
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

    .import-group {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 7px;
        padding-left: 12px;
    }

    .import-group input[type="text"] {
        border: none;
        flex-grow: 1;
        padding: 12px 0;
    }

    .import-group input[type="text"]:focus {
        outline: none;
    }

    .import-group .btn-importer {
        background-color: #A6A485;
        color: white;
        border: none;
        padding: 12px 18px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: none !important;
        color: #333 !important;
    }
    </style>
</head>

<body>

    <div class="content-block">
        <div class="accordion-container">
            <!-- Tabs -->
            <div class="accordion-tabs">
                <button class="tab-btn active" data-tab="tab1">Emploi du temps Etudiants</button>
                <button class="tab-btn" data-tab="tab2">Emploi du temps enseignants</button>
            </div>

            <div class="accordion-content">

                <!-- Onglet 1 : Emploi du temps Etudiants -->
                <div class="tab-panel active" id="tab1">
                    <div class="table-controls">
                        <div class="filter-selectgb">
                            <select class="filter-select">
                                <option>Années Universitaire</option>
                            </select>
                            <select class="filter-select">
                                <option>Master</option>
                            </select>
                            <select class="filter-select">
                                <option>Groupe</option>
                            </select>
                        </div>
                        <div class="filter-actions">
                            <button class="btn-primary" id="openCommissionModal">Ajouter</button>
                            <button class="icon-btn"><img class="trash-icon"
                                    src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                    alt="Icon-upload.png"></button>
                        </div>
                    </div>

                    <table id="etudiantsTable" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Master</th>
                                <th>Groupe</th>
                                <th>Emplois du temps</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Master IA & Data</td>
                                <td>Grp IA1</td>
                                <td><a href="#"><img class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                            alt="PDF Icon"></a></td>
                                <td>
                                    <a href="#"><img class="trash-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-trash-2.png"
                                            alt="Icon-trash-2.png"></a>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Master IA & Data</td>
                                <td>Grp IA2</td>
                                <td><a href="#"><img class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                            alt="PDF Icon"></a></td>
                                <td>
                                    <a href="#"><img class="trash-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-trash-2.png"
                                            alt="Icon-trash-2.png"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Onglet 2 : Emploi du temps enseignants -->
                <div class="tab-panel" id="tab2">
                    <div class="table-controls">
                        <div class="filter-selectgb">
                            <select class="filter-select">
                                <option>Années Universitaire</option>
                            </select>
                            <select class="filter-select">
                                <option>Master</option>
                            </select>
                            <select class="filter-select">
                                <option>Enseignant</option>
                            </select>
                        </div>
                        <div class="filter-actions">
                            <button class="btn-primary" id="openEnseignantModal">Ajouter</button>
                            <button class="icon-btn"><img class="trash-icon"
                                    src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-upload.png"
                                    alt="Icon-upload.png"></button>
                        </div>
                    </div>

                    <table id="enseignantsTable" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Master</th>
                                <th>Enseignant</th>
                                <th>Emplois du temps</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Master IA & Data</td>
                                <td>Dorra Salahi</td>
                                <td><a href="#"><img class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                            alt="PDF Icon"></a></td>
                                <td>
                                    <a href="#"><img class="trash-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-trash-2.png"
                                            alt="Icon-trash-2.png"></a>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Master IA & Data</td>
                                <td>Houda Alleni</td>
                                <td><a href="#"><img class="pdf-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                            alt="PDF Icon"></a></td>
                                <td>
                                    <a href="#"><img class="trash-icon"
                                            src="/wp-content/plugins/plateforme-master/imagesED/27) Icon-trash-2.png"
                                            alt="Icon-trash-2.png"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- All Modals -->
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
                <h2>Ajouter un emploi du temps</h2>
                <button class="btn-enregistrer">Générer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label>Années Universitaire</label>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Années Universitaire">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Master</label>
                    <select>
                        <option>Master</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Enseignant</label>
                    <select>
                        <option>Enseignant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Importer l'emploi</label>
                    <div class="import-group">
                        <input type="text" value="Emploi_IA-Data-2025-2026.pdf" readonly>
                        <button type="button" class="btn-importer"><i class="fas fa-upload"></i> Importer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalEnseignant" style="display: none;">
        <div class="popup-container" id="popupContainerEnseignant">
            <div class="popup-header">
                <h2>Ajouter un emploi du temps</h2>
                <button class="btn-enregistrer">Générer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label>Années Universitaire</label>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Années Universitaire">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Master</label>
                    <select>
                        <option>Master</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Groupe</label>
                    <select>
                        <option>Groupe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Importer l'emploi</label>
                    <div class="import-group">
                        <input type="text" value="Emploi_IA-Data-2025-2026.pdf" readonly>
                        <button type="button" class="btn-importer"><i class="fas fa-upload"></i> Importer</button>
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
    $(document).ready(function() {
        const commonDataTableOptions = {
            paging: true,
            searching: false,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'rtp', // Removes length menu and search box
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible"
            },
            columnDefs: [{
                targets: 0, // Target the first column (checkboxes)
                orderable: false
            }]
        };

        var etudiantsTable = $('#etudiantsTable').DataTable(commonDataTableOptions);
        var enseignantsTable = $('#enseignantsTable').DataTable(commonDataTableOptions);

        // --- Check All Functionality ---
        function setupCheckAll(tableId, dataTableInstance) {
            const tableSelector = '#' + tableId;
            const headerCheckboxSelector = tableSelector + ' thead th input[type="checkbox"]';

            // 1. Header checkbox click toggles all body checkboxes
            $(headerCheckboxSelector).on('click', function() {
                var isChecked = $(this).is(':checked');
                $(dataTableInstance.rows({
                    search: 'applied'
                }).nodes()).find('input[type="checkbox"]').prop('checked', isChecked);
            });

            // 2. Body checkbox change updates header checkbox state
            $(tableSelector).on('change', 'tbody input[type="checkbox"]', function() {
                var $allBodyCheckboxes = $(dataTableInstance.rows({
                    search: 'applied'
                }).nodes()).find('input[type="checkbox"]');
                var allChecked = true;

                $allBodyCheckboxes.each(function() {
                    if (!$(this).is(':checked')) {
                        allChecked = false;
                        return false;
                    }
                });

                $(headerCheckboxSelector).prop('checked', allChecked);
            });
        }

        setupCheckAll('etudiantsTable', etudiantsTable);
        setupCheckAll('enseignantsTable', enseignantsTable);


        // --- Original Modal and other logic ---
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

                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove(
                    'active'));
                document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove(
                    'active'));

                button.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Action dropdown menu logic
        document.querySelector('.accordion-content').addEventListener('click', function(e) {
            const actionBtn = e.target.closest('.action-btn');
            let clickedMenu;
            if (actionBtn) {
                clickedMenu = actionBtn.nextElementSibling;
            }
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== clickedMenu) {
                    menu.style.display = 'none';
                }
            });
            if (actionBtn) {
                const menu = actionBtn.nextElementSibling;
                if (menu && menu.classList.contains('dropdown-menu')) {
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                }
            }
        });

        const statusHeader = document.querySelector('#tab3 .status-header-container');
        if (statusHeader) {
            const dropdown = statusHeader.querySelector('.status-dropdown-menu');
            const icon = statusHeader.querySelector('.filter-icon');
            icon.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.actions')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
            if (!e.target.closest('.status-header-container')) {
                document.querySelectorAll('.status-dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });

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

        // --- Modal for Commission (Tab 1) ---
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

        // --- Modal for Enseignant (Tab 2) ---
        const enseignantModal = document.getElementById("modalEnseignant");
        const openEnseignantBtn = document.getElementById("openEnseignantModal");
        const enseignantPopup = document.getElementById("popupContainerEnseignant");
        if (openEnseignantBtn && enseignantModal) {
            openEnseignantBtn.addEventListener("click", function() {
                enseignantModal.style.display = "flex";
            });
        }
        if (enseignantModal && enseignantPopup) {
            enseignantModal.addEventListener("click", function(e) {
                if (!enseignantPopup.contains(e.target)) {
                    enseignantModal.style.display = "none";
                }
            });
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

</body>

</html>