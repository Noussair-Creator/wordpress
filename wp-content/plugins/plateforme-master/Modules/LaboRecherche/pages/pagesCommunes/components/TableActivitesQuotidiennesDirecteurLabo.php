<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Journalier Des Activités</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Flatpickr CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <!-- User-provided styles combined into one block -->
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f0f0f0;
    }

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

    .add-project-btn {
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

    .search-box {
        display: flex;
        align-items: center;
        border: 2px solid #dcdac2;
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
        position: absolute;
        right: 0;
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
        background-color: #c80000;
        color: white;
        border: none;
        padding: 10px 24px;
        font-size: 14px;
        border-radius: 6px;
        font-weight: 500;
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

    .input-with-icon .date-input {
        padding-left: 0.75rem;
        padding-right: 2.5rem;
    }

    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        box-shadow: 0 0 0 1px #ddd;
        background: #fff;
        font-family: 'Segoe UI', sans-serif;
    }

    .styled-table thead {
        background-color: #f3f1e9;
    }

    .styled-table th,
    .styled-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .styled-table tr:last-child td {
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
        border: 2px solid #c60000;
        color: #c60000;
        padding: 8px 14px;
        border-radius: 8px;
        background: white;
        font-weight: bold;
        cursor: pointer;
        font-size: 13px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        border: none;
        background: transparent;
        color: black;
        font-weight: bold;
        font-size: 13px;
        pointer-events: none;
    }

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        display: none;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    .filter-bar {
        background: #fff;
        font-family: 'Poppins', sans-serif;
        padding: 10px 0px;
        display: grid;
    }

    .filter-title {
        font-weight: bold;
        font-size: 18px;
        color: #2d2a12;
        margin-bottom: 10px;
    }

    .filter-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-buttons {
        display: flex;
        border: 1px solid #d8d4b7;
        border-radius: 5px;
        overflow: hidden;
        width: max-content;
    }

    .filter-btn {
        padding: 8px 14px;
        border: none;
        background: transparent;
        color: #2d2a12;
        font-weight: 500;
        cursor: pointer;
    }

    .filter-btn.active {
        background-color: #b2ae90;
        color: #fff;
        font-weight: bold;
    }

    .filter-select {
        border: 1px solid #d8d4b7;
        border-radius: 5px;
        padding: 10px 12px;
        background-color: #fff;
        color: #999;
        font-size: 15px;
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        padding-right: 30px;
        width: 200px;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        margin-left: auto;
        position: absolute;
        right: 0;
    }

    .icon-btn {
        background: #fff;
        border: none;
        border-radius: 10px;
        width: 40px;
        height: 40px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        color: #d71920;
        font-size: 18px;
        transition: background 0.2s;
    }

    .icon-btn:hover {
        background-color: #f8f8f8;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 20px;
        border: 2px solid transparent;
    }

    .badge-danger {
        color: #d71920;
        background-color: #fff0f0;
        border-color: #d71920;
    }

    .badge-warning {
        color: #d89e00;
        background-color: #fff9e6;
        border-color: #d89e00;
    }

    .badge-success {
        color: #198754;
        background-color: #e6f7ee;
        border-color: #198754;
    }

    td.statut-universitaire {
        color: #2d2a12;
        font-weight: 500;
        font-size: 14px;
    }

    .actions-menu {
        position: absolute;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 6px 0;
        z-index: 1000;
        width: 160px;
    }

    .actions-menu a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        color: #2d2a12;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .actions-menu a:hover {
        background-color: #f4f4f4;
    }

    .actions-menu i {
        color: #2d2a12;
    }

    .action-btn {
        background-color: transparent;
        color: #2d2a12;
        border: 1px solid transparent;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        font-size: 24px;
        font-weight: bolder;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s;
        line-height: 1;
        padding: 0;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn:hover {
        background-color: #e6e6de;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

    .badge-secondary {
        color: #555;
        background-color: #f0f0f0;
        border-color: #ccc;
    }

    .dt-button.buttons-colvis {
        background-color: #f9f7ef;
        border: 1px solid #ccc;
        padding: 8px 14px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        color: #333;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        cursor: pointer;
        box-shadow: inset 0 0 0 1px #ddd;
        transition: background-color 0.2s ease;
        border-radius: 5px;
        background-color: #fff !important;
        padding: 7px 14px;
        position: relative;
        top: -71px;
        right: 93px;
        border: 2px solid #d71920;
        appearance: none;
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        font-weight: 700;
        color: #d71920;
        background: none;
    }

    div#candidaturesTable_wrapper div.dt-buttons {
        float: right !important;
    }

    div#candidaturesTable_wrapper span.dt-down-arrow {
        display: none;
    }

    .dt-button.buttons-colvis:hover {
        background-color: #ece8dc;
    }

    .dt-button.buttons-colvis .dt-down-arrow {
        font-size: 14px;
        color: #888;
    }

    .dt-button-collection.fixed.four-column {
        border-radius: 16px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
        display: grid;
        gap: 16px;
        font-family: 'Poppins', sans-serif;
        min-width: 520px;
        max-width: 727px;
        overflow: visible;
    }

    .dt-button-collection .dt-button.buttons-columnVisibility {
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 50px;
        padding: 10px 60px;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .dt-button-collection .dt-button.buttons-columnVisibility:hover {
        background-color: #f6f6f6;
        border-color: #999;
    }

    .dt-button-collection .dt-button.buttons-columnVisibility,
    .dt-button-collection .dt-button.buttons-columnVisibility.active {
        border: 1px solid #ccc;
        background-color: #fff !important;
        border-radius: 50px;
        padding: 10px 60px;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        background: linear-gradient(to bottom, #fffbfb 0%, #ffffff 100%) !important;
        box-shadow: none !important;
    }

    div.dt-button-collection.four-column {
        width: 719px !important;
    }

    div.dt-button-collection.fixed .dt-button:first-child {
        border-top-left-radius: 50px !important;
        border-top-right-radius: 50px !important;
    }

    div.dt-button-collection.fixed .dt-button:last-child {
        border-bottom-left-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }

    div.dt-button-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        background: radial-gradient(ellipse farthest-corner at center, rgba(0, 0, 0, 0.3) 0%, rgb(195 195 195 / 70%) 100%);
        z-index: 2001;
    }

    .dt-button-collection .dt-button.buttons-columnVisibility {
        color: #000;
        font-weight: 500;
        font-size: 14px;
    }

    .dt-button-collection .dt-button.buttons-columnVisibility.active {
        border-color: #d42d2d;
        color: #000;
        font-weight: 500;
        font-size: 14px;
    }

    div.dt-button-collection-title h4 {
        color: #d42d2d;
    }

    #candidaturesTable_paginate {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        gap: 6px;
        font-family: 'Poppins', sans-serif;
        background-color: none;
    }

    #candidaturesTable_paginate .paginate_button {
        background-color: #fff;
        border: 2px solid #c40000;
        color: #c40000;
        font-weight: 500;
        padding: 6px 10px;
        min-width: 36px;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #candidaturesTable_paginate .paginate_button.current {
        background-color: #c40000;
        color: #fff !important;
        border-color: #c40000;
        font-weight: 700;
    }

    #candidaturesTable_paginate .paginate_button:hover {
        background-color: #f8eaea;
    }

    #candidaturesTable_paginate .paginate_button:before,
    #candidaturesTable_paginate .paginate_button:after {
        font-weight: bold;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none;
    }

    #candidaturesTable_paginate .paginate_button:focus {
        outline: none;
        box-shadow: none;
    }

    th {
        border-bottom: 1px solid #EBE9D7 !important;
        border-top: 1px solid #EBE9D7 !important;
        padding: 10px 10px 10px !important;
    }

    td {
        box-shadow: none !important;
    }

    thead {
        position: relative;
        top: -17px;
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
        border: none !important;
        position: static;
        transform: translateY(-15px);
    }

    #candidaturesTable tbody tr:first-child td {
        border-top-left-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    .badge-info {
        background-color: #808066;
    }

    #candidaturesTable {
        overflow: visible;
    }

    .actions {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 160px;
        background-color: #ffffff;
        border: 1px solid #d8d4b7;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .filter-dropdown {
        position: relative;
        margin-left: 12px;
    }

    .statut-dropdown-wrapper {
        position: relative;
        display: inline-block;
        margin-left: 12px;
    }

    .statut-dropdown-btn {
        background-color: #c80000;
        color: white;
        border: none;
        padding: 9px 53px;
        font-weight: 500;
        font-size: 14px;
        border-radius: 5px;
    }

    .statut-dropdown-menu {
        position: absolute;
        top: 110%;
        left: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 9999;
        min-width: 200px;
        border-radius: 4px;
        overflow: hidden;
    }

    .statut-dropdown-option {
        padding: 10px 14px;
        font-size: 14px;
        cursor: pointer;
    }

    .statut-dropdown-option:hover {
        background-color: #f5f5f5;
    }

    button.swal2-confirm.swal2-styled {
        background-color: #c80000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 8px 12px;
        border-radius: 8px;
        border: 2px solid #c60000;
        background-color: #fff;
        color: #c60000;
        font-weight: 600;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #c60000;
        color: #fff !important;
        font-weight: 700;
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
        z-index: 9999;
    }

    .popup-container {
        background-color: white;
        width: 400px;
        height: 100%;
        padding: 20px 0px;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        padding-top: 0px;
        position: relative;
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

    /* NEW responsive styles */
    @media (max-width: 768px) {
        .filter-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-inputs {
            flex-direction: column;
            width: 100%;
        }

        .filter-input,
        .filter-select {
            width: 100% !important;
            min-width: 100% !important;
        }

        .filter-actions {
            position: static;
            margin-left: 0;
            justify-content: center;
        }
    }

    /* Corrected styles for the two time inputs */
    .input-custom-filed {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .input-custom-filed .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    /* Custom class for styling the time pickers */
    .time-picker-custom-style {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Custom Flatpickr Theme */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background: #C60000;
        border-color: #C60000;
    }

    .flatpickr-day.inRange,
    .flatpickr-day.prevMonthDay.inRange,
    .flatpickr-day.nextMonthDay.inRange {
        background: #fde0e0;
        border-color: #fde0e0;
        box-shadow: -5px 0 0 #fde0e0, 5px 0 0 #fde0e0;
    }

    .flatpickr-months .flatpickr-month {
        color: #C60000;
    }

    .flatpickr-weekdays {
        background: #c600001a;
    }

    .flatpickr-months .flatpickr-prev-month:hover svg,
    .flatpickr-months .flatpickr-next-month:hover svg {
        fill: #C60000;
    }
    </style>
</head>

<body>
    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Icon"
                    style="width: 38px; margin-right: 8px; vertical-align: middle; font-weight: blod;">
                Tableau Journalier Des Activités
            </h2>
            <button class="add-project-btn">Ajouter une activité</button>
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
                    <select id="typeFilter" class="filter-select">
                        <option value="" selected  >Type</option>
                       
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
                <!-- Statut Select -->
                <div class="input-with-icon">
                    <select id="statutFilter" class="filter-select">
                        <option value="" selected>Statut</option>
                        <option>Terminé</option>
                        <option>Prévu</option>
                        <option>En cours</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>

            <div class="filter-actions">
                <!-- Updated Icons -->
                <button class="icon-btn" title="Filter" id="filterBtn">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                        alt="Icon-funnel">
                </button>
                <button class="icon-btn" title="Download">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                        alt="upload-red.png">
                </button>
            </div>
        </div>

        <table id="candidaturesTable" class="styled-table display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Activité réalisée</th>
                    <th>Type</th>
                    <th>Fichier</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <!--  <tr>
                    <td><input type="checkbox"></td>
                    <td>08:30 – 10:00</td>
                    <td>Réunion D’avancement Avec Doctorants</td>
                    <td>Réunion</td>
                    <td>_</td>
                    <td><span class="badge badge-success"> <i class="fa-regular fa-circle-check"
                                style="color: #0E962D; padding-right:5px;"></i>Terminé</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" data-action="Modifier">Modifier</a>
                                <a href="/activites-quotidiennes-details">Fiche d’activité</a>
                                <a href="#" data-action="Supprimer">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><input type="checkbox"></td>
                    <td>10:00 – 11:30</td>
                    <td>Prétraitement EEG Patient #4</td>
                    <td>Expérimentation</td>
                    <td>session4.csv</td>
                    <td><span class="badge badge-success"> <i class="fa-regular fa-circle-check"
                                style="color: #0E962D; padding-right:5px;"></i>Terminé</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" data-action="Modifier">Modifier</a>
                                <a href="/activites-quotidiennes-details">Fiche d’activité</a>
                                <a href="#" data-action="Supprimer">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>11:30 – 12:30</td>
                    <td>Test Module D'acquisition Embarqué</td>
                    <td>Développement</td>
                    <td>log_v2.txt</td>
                    <td><span class="badge badge-secondary"><i class="fa-solid fa-arrows-rotate"
                                style="color: #A6A485;padding-right:5px;"></i>Prévu</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" data-action="Modifier">Modifier</a>
                                <a href="/activites-quotidiennes-details">Fiche d’activité</a>
                                <a href="#" data-action="Supprimer">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>13:30 – 15:00</td>
                    <td>Rédaction Article Section 2.3</td>
                    <td>Rédaction</td>
                    <td>article_draft.pdf</td>
                    <td><span class="badge badge-success"> <i class="fa-regular fa-circle-check"
                                style="color: #0E962D; padding-right:5px;"></i>Terminé</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" data-action="Modifier">Modifier</a>
                                <a href="/activites-quotidiennes-details">Fiche d’activité</a>
                                <a href="#" data-action="Supprimer">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>15:00 – 16:30</td>
                    <td>Réunion Coordination Projet AR-UTM</td>
                    <td>Réunion</td>
                    <td>_</td>
                    <td><span class="badge badge-warning"><i class="fa-regular fa-clock"
                                style="color: #FFD43B; padding-right:5px;"></i>En cours</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" data-action="Modifier">Modifier</a>
                                <a href="/activites-quotidiennes-details" data-action="Fiche">Fiche d’activité</a>
                                <a href="#" data-action="Supprimer">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>-->
            </tbody>
        </table>
    </div>

    <!-- Original "Ajouter une activité" Modal HTML -->
    <div class="modal-overlay" id="modalObjectifs" style="display: none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Ajouter une activité</h2>
                <!--<button class="btn-close-x" id="btnCloseModal">&times;</button>-->
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <!--<div class="form-group">
                    <label for="membreConcerne">Membre Concerné</label>
                    <div class="input-with-icon">
                        <select id="membreConcerne">
                            <option value="">Sélection..</option>
                            <option value="Houssem Lahmar">Houssem Lahmar</option>
                            <option value="Dr. M. Abdelkefi">Dr. M. Abdelkefi</option>
                            <option value="Dr. C. Hadj Kacem">Dr. C. Hadj Kacem</option>
                            <option value="Dr. M. Zghari">Dr. M. Zghari</option>
                            <option value="Marwa Trabelsi">Marwa Trabelsi</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div> -->

             
                <div class="form-group">
                    <label for="activity-title">Titre</label>
                    <input type="text" id="activity-title">
                </div>
                <div class="form-group">
                    <label for="activiteDate">Date</label>
                    <div class="input-with-icon">
                        <input type="date" id="activiteDate">
                    </div>
                </div>

                <div class="form-group input-custom-filed">
                    <div class="form-group col-5">
                        <label for="activiteHeureDebut">Heure De Début</label>
                        <div class="input-with-icon">
                            <input type="time" id="activiteHeureDebut">
                        </div>
                    </div>
                    <!-- Removed unnecessary empty div -->
                    <div class="form-group col-5">
                        <label for="activiteHeureFin">Heure De Fin</label>
                        <div class="input-with-icon">
                            <input type="time" id="activiteHeureFin">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="typeActivite">Type D'activité</label>
                    <div class="input-with-icon">
                        <select id="typeActivite">
                            <option value="">Sélection</option>
                            <i class="fas fa-chevron-down icon right-icon"></i>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descriptionDetaillee">Description détaillée</label>
                    <textarea id="descriptionDetaillee" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="pieceJointe">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi"
                            style="border: none;" readonly>
                        <label style="color: white;" for="fileUpload" class="btn-importer">
                            <img width="20px" style="margin-right: 10px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-upload">
                            Importer</label>
                        <input type="file" id="fileUpload" style="display:none;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="statutActivite">Statut</label>
                    <div class="input-with-icon">
                        <select id="statutActivite">
                            <option value="">Sélection..</option>
                            <option value="Terminé">Terminé</option>
                            <option value="Prévu">Prévu</option>
                            <option value="En cours">En cours</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- NEW Modal for Editing an Activity -->
    <div class="modal-overlay" id="modalModifier" style="display: none;">
        <div class="popup-container" id="popupContainerModifier">
            <div class="popup-header">
                <h2>Modifier une activité</h2>
                <button class="btn-enregistrer" id="btnSaveModifier">Modifier</button>
            </div>
            <form class="popup-form">
                <!--<div class="form-group">
                    <label for="editMembreConcerne">Membre Concerné</label>
                    <div class="input-with-icon">
                        <select id="editMembreConcerne">
                            <option value="">Sélection..</option>
                            <option value="Houssem Lahmar">Houssem Lahmar</option>
                            <option value="Dr. M. Abdelkefi">Dr. M. Abdelkefi</option>
                            <option value="Dr. C. Hadj Kacem">Dr. C. Hadj Kacem</option>
                            <option value="Dr. M. Zghari">Dr. M. Zghari</option>
                            <option value="Marwa Trabelsi">Marwa Trabelsi</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>-->
                 <div class="form-group">
                    <label for="editAactivity-title">Titre</label>
                    <input type="text" id="editAactivity-title">
                </div>

                <div class="form-group">
                    <label for="editActiviteDate">Date</label>
                    <div class="input-with-icon">
                        <input type="date" id="editActiviteDate" placeholder="">
                    </div>
                </div>

                <div class="form-group input-custom-filed">
                    <div class="form-group col-5">
                        <label for="editActiviteHeureDebut">Heure De Début</label>
                        <div class="input-with-icon">
                            <input type="time" id="editActiviteHeureDebut">
                        </div>
                    </div>
                    <div class="form-group col-5">
                        <label for="editActiviteHeureFin">Heure De Fin</label>
                        <div class="input-with-icon">
                            <input type="time" id="editActiviteHeureFin">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editTypeActivite">Type D'activité</label>
                    <div class="input-with-icon">
                        <select id="editTypeActivite">
                            
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editDescriptionDetaillee">Description détaillée</label>
                    <textarea id="editDescriptionDetaillee" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="editPieceJointe">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" id="editFileText" class="input-file-text" placeholder="Aucun fichier choisi"
                            style="border: none;" readonly>
                        <label style="color: white;" for="editFileUpload" class="btn-importer">
                            <img width="20px" style="margin-right: 10px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-upload">
                            Importer</label>
                        <input type="file" id="editFileUpload" style="display:none;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editStatutActivite">Statut</label>
                    <div class="input-with-icon">
                        <select id="editStatutActivite">
                            <option value="">Sélection..</option>
                            <option value="Terminé">Terminé</option>
                            <option value="Prévu">Prévu</option>
                            <option value="En cours">En cours</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
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
    <!-- Flatpickr JavaScript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <!-- Updated and combined scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // Function to generate the correct badge HTML
        function getBadgeHtml(status) {
            let badgeClass = '';
            let iconHtml = '';
            let iconColor = '';
            switch (status) {
                case 'Terminé':
                    badgeClass = 'badge-success';
                    iconHtml = '<i class="fa-regular fa-circle-check"></i>';
                    iconColor = '#0E962D';
                    break;
                case 'Prévu':
                    badgeClass = 'badge-secondary';
                    iconHtml = '<i class="fa-solid fa-arrows-rotate"></i>';
                    iconColor = '#A6A485';
                    break;
                case 'En cours':
                    badgeClass = 'badge-warning';
                    iconHtml = '<i class="fa-regular fa-clock"></i>';
                    iconColor = '#FFD43B';
                    break;
                default:
                    badgeClass = 'badge-secondary';
                    break;
            }
            return `<span class="badge ${badgeClass}">${iconHtml}<span style="padding-left: 5px; color: ${iconColor};">${status}</span></span>`;
        }

        // Initialize Flatpickr for date and time inputs
        flatpickr("#activiteDate", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });
        flatpickr("#activiteHeureDebut", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            className: "time-picker-custom-style",
            onOpen: function(selectedDates, dateStr, instance) {
                // Fix the calendar width to match the input's width
                instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
            }
        });
        flatpickr("#activiteHeureFin", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            className: "time-picker-custom-style",
            onOpen: function(selectedDates, dateStr, instance) {
                // Fix the calendar width to match the input's width
                instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
            }
        });
        flatpickr("#editActiviteDate", {
            dateFormat: "Y-m-d",
        });
        flatpickr("#editActiviteHeureDebut", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            className: "time-picker-custom-style",
            onOpen: function(selectedDates, dateStr, instance) {
                // Fix the calendar width to match the input's width
                instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
            }
        });
        flatpickr("#editActiviteHeureFin", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            className: "time-picker-custom-style",
            onOpen: function(selectedDates, dateStr, instance) {
                // Fix the calendar width to match the input's width
                instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
            }
        });


        /*// Initialize DataTable
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
        });*/

        // --- Action Buttons (Dropdown Menu) ---
        // Use event delegation on the table body for dynamically added rows
        $('#candidaturesTable tbody').on('click', '.action-btn', function(e) {
            e.stopPropagation();
            // Close all other dropdowns first
            $('.dropdown-menu').not($(this).next('.dropdown-menu')).hide();
            // Toggle the current dropdown
            $(this).next('.dropdown-menu').toggle();
        });

    /*    // Handle clicks on the dropdown menu items
        $('#candidaturesTable tbody').on('click', '.dropdown-menu a', function(e) {
            e.stopPropagation(); // Stop it from closing the menu immediately
            const action = $(this).data('action');
            const row = $(this).closest('tr');

            // Only prevent default for JS-handled actions
            if (action) {
                e.preventDefault();
                const rowData = table.row(row).data();

               if (action === 'Modifier') {
                const id = $(this).data('id');
                openEditModal(id);
                } else if (action === 'Supprimer') {
                    console.log('Action Supprimer triggered for:', rowData);
                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: "Vous ne pourrez pas revenir en arrière!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#c80000',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Oui, supprimer!',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        deleteActiviteQuotidienne($(this).data('id'));
                        }
                    });
                }
            }
            // For links without a data-action (like "Fiche d'activité"),
            // the default browser navigation will occur.

            // Hide the dropdown after action
            $(this).closest('.dropdown-menu').hide();
        });*/


        // Close dropdowns when clicking anywhere else on the page
        document.addEventListener('click', function() {
            $('.dropdown-menu').hide();
        });

        // --- Filter Functionality ---
        const typeFilterSelect = document.getElementById('typeFilter');
        const statutFilterSelect = document.getElementById('statutFilter');
        const searchInput = document.getElementById('searchInput');

        function applyFilters() {
            const typeValue = typeFilterSelect.value;
            const statutValue = statutFilterSelect.value;
            const searchTerm = searchInput.value;

            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    const type = data[4] || '';
                    const statut = data[6] || '';

                    // Strip HTML from status for accurate matching
                    const statutText = $('<div>').html(statut).text().trim();

                    const typeMatch = typeValue === "" || type.trim() === typeValue;
                    const statutMatch = statutValue === "" || statutText.trim() === statutValue;

                    return typeMatch && statutMatch;
                }
            );

            // Apply general search and draw the table
            table.search(searchTerm).draw();

            // Remove the custom filter function after drawing so it's not permanently active
            $.fn.dataTable.ext.search.pop();
        }

        // Event listeners for the filter elements
        typeFilterSelect.addEventListener('change', applyFilters);
        statutFilterSelect.addEventListener('change', applyFilters);
        searchInput.addEventListener('keyup', applyFilters);


        // --- Check All Checkbox Functionality ---
        $('#checkAll').on('change', function() {
            const isChecked = this.checked;
            $('#candidaturesTable tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        // Uncheck "Check All" if any individual checkbox is unchecked
        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                $('#checkAll').prop('checked', false);
            }
        });

        // --- ADD MODAL Logic ---
        const modalObjectifs = document.getElementById("modalObjectifs");
        const popupObjectifs = document.getElementById("popupContainerObjectifs");
        const btnCloseModal = document.getElementById("btnCloseModal");


        function openmodalObjectifs() {
            if (modalObjectifs) modalObjectifs.style.display = "flex";
        }

        function closeModalObjectifs() {
            const modalObjectifs = document.getElementById("modalObjectifs");
            if (modalObjectifs) modalObjectifs.style.display = "none";
        }


        $('.add-project-btn').on('click', openmodalObjectifs);
        btnCloseModal.addEventListener('click', closeModalObjectifs);

/*
        $('#btnSaveObjectifs').on('click', function(event) {
            event.preventDefault();
            // Simple validation
            if (!$('#activiteDate').val() || !$('#typeActivite').val() || !$('#statutActivite')
                .val()) {
                Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires.', 'error');
                return;
            }

            const newRowData = [
                '<input type="checkbox">',
                `${$('#activiteHeureDebut').val()} – ${$('#activiteHeureFin').val()}`,
                $('#membreConcerne').val(),
                $('#descriptionDetaillee').val(),
                $('#typeActivite').val(),
                $('#fileUpload')[0].files[0] ? $('#fileUpload')[0].files[0].name : '_',
                getBadgeHtml($('#statutActivite').val()),
                `<div class="actions">
                        <button class="action-btn">...</button>
                        <div class="dropdown-menu">
                            <a href="#" data-action="Modifier">Modifier</a>
                            <a href="/activites-quotidiennes-details">Fiche d’activité</a>
                            <a href="#" data-action="Supprimer">Supprimer</a>
                        </div>
                    </div>`
            ];

            table.row.add(newRowData).draw();
            closeModalObjectifs();
            $('form.popup-form')[0].reset(); // Reset the form
        });
*/
        // Close modal if clicking outside the popup
        if (modalObjectifs && popupObjectifs) {
            modalObjectifs.addEventListener("click", function(e) {
                if (!popupObjectifs.contains(e.target) && e.target !== btnCloseModal) {
                    closeModalObjectifs();
                }
            });
        }

        /*
        // --- EDIT MODAL Logic ---
        const modalModifier = document.getElementById("modalModifier");
        const popupModifier = document.getElementById("popupContainerModifier");
        const btnCloseEditModal = document.getElementById("btnCloseEditModal");

        let editingRow = null; // Variable to store the row being edited

        function openEditModal(row) {
            editingRow = row; // Store the row
            const rowData = table.row(row).data();
            if (modalModifier) {
                $('#editMembreConcerne').val(rowData[2]);

                // Split the time string and populate the two time inputs
                const timeRange = rowData[1].split(' – ');
                $('#editActiviteHeureDebut').val(timeRange[0]);
                $('#editActiviteHeureFin').val(timeRange[1]);

                $('#editTypeActivite').val(rowData[4].trim());
                $('#editDescriptionDetaillee').val(rowData[3]);

                const statutText = $('<div>').html(rowData[6]).text().trim();
                $('#editStatutActivite').val(statutText);

                $('#editFileText').val(rowData[5]);

                modalModifier.style.display = "flex";
            }
        }

        function closeModalModifier() {
            if (modalModifier) modalModifier.style.display = "none";
            editingRow = null; // Clear the editing row
        }

        btnCloseEditModal.addEventListener('click', closeModalModifier);


        $('#btnSaveModifier').on('click', function(event) {
            event.preventDefault();
            if (editingRow) {
                const updatedData = [
                    table.cell(editingRow, 0).data(), // Keep checkbox state
                    `${$('#editActiviteHeureDebut').val()} – ${$('#editActiviteHeureFin').val()}`,
                    $('#editMembreConcerne').val(),
                    $('#editDescriptionDetaillee').val(),
                    $('#editTypeActivite').val(),
                    $('#editFileUpload')[0].files[0] ? $('#editFileUpload')[0].files[0].name : $(
                        '#editFileText').val(),
                    getBadgeHtml($('#editStatutActivite').val()),
                    table.cell(editingRow, 7).data() // Keep actions HTML
                ];
                table.row(editingRow).data(updatedData).draw();
            }
            closeModalModifier();
        });

        if (modalModifier && popupModifier) {
            modalModifier.addEventListener("click", function(e) {
                if (!popupModifier.contains(e.target) && e.target !== btnCloseEditModal) {
                    closeModalModifier();
                }
            });
        }


        $('#editFileUpload').on('change', function() {
            const fileName = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
            $('#editFileText').val(fileName);
        });
        */


        
        
    });
    </script>

<?php
    $current_user = wp_get_current_user();
    $roles = (array) $current_user->roles;
    $role  = $roles[0] ?? '';
    $user_id = get_current_user_id();

    ?>
    <script>
    window.PMSettings = {
        restUrl: "<?= esc_url( rest_url() ) ?>",
        nonce: "<?= wp_create_nonce('wp_rest') ?>",
        role: "<?= esc_js( $role ) ?>",
        userId: <?= (int) $user_id ?>
    };
    </script>

<script>
  // Utilitaire fetch WordPress
async function wpFetch(url, options = {}) {
  const headers = { 'Accept': 'application/json', ...(options.headers||{}) };
  if (window.PMSettings?.nonce) headers['X-WP-Nonce'] = PMSettings.nonce;
  const res = await fetch(url, { ...options, headers, credentials:'include' });
  if (!res.ok) {
    let msg = `Erreur API (${res.status})`;
    try { const j = await res.json(); if (j?.message) msg=j.message; }catch(e){}
    throw new Error(msg);
  }
  return res.json();
}


// Function to generate the correct badge HTML
function getBadgeHtml(status) {
            let badgeClass = '';
            let iconHtml = '';
            let iconColor = '';
            switch (status) {
                case 'Terminé':
                    badgeClass = 'badge-success';
                    iconHtml = '<i class="fa-regular fa-circle-check"></i>';
                    iconColor = '#0E962D';
                    break;
                case 'Prévu':
                    badgeClass = 'badge-secondary';
                    iconHtml = '<i class="fa-solid fa-arrows-rotate"></i>';
                    iconColor = '#A6A485';
                    break;
                case 'En cours':
                    badgeClass = 'badge-warning';
                    iconHtml = '<i class="fa-regular fa-clock"></i>';
                    iconColor = '#FFD43B';
                    break;
                default:
                    badgeClass = 'badge-secondary';
                    break;
            }
            return `<span class="badge ${badgeClass}">${iconHtml}<span style="padding-left: 5px; color: ${iconColor};">${status}</span></span>`;
}


// Charger le tableau des activités
async function loadActivitesQuotidiennes(){
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne`;
  try {
    const data = await wpFetch(url);

    // Si DataTable déjà initialisé → destroy
    if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
      $('#candidaturesTable').DataTable().clear().destroy();
    }

    const tbody = document.querySelector('#candidaturesTable tbody');
    tbody.innerHTML = '';

    (data||[]).forEach(row => {
      const statut = row.statut || row.Statut;
      const badge  = getBadgeHtml(statut);
      const pj     = row.piece_jointe_path 
        ? `<a href="${row.piece_jointe_path}" target="_blank"><i class="fa fa-file"></i></a>` 
        : '_';

      // Définir les actions statut dynamiques
      let statutActions = '';
      if (statut === 'Prévu') {
        statutActions = `
          <a href="#" class="set-status" data-id="${row.id}" data-status="En cours">Marquer comme En cours</a>
          <a href="#" class="set-status" data-id="${row.id}" data-status="Terminé">Marquer comme Terminé</a>
        `;
      } else if (statut === 'En cours') {
        statutActions = `
          <a href="#" class="set-status" data-id="${row.id}" data-status="Prévu">Repasser en Prévu</a>
          <a href="#" class="set-status" data-id="${row.id}" data-status="Terminé">Marquer comme Terminé</a>
        `;
      } else if (statut === 'Terminé') {
        statutActions = `
          <a href="#" class="set-status" data-id="${row.id}" data-status="En cours">Repasser en En cours</a>
          <a href="#" class="set-status" data-id="${row.id}" data-status="Prévu">Repasser en Prévu</a>
        `;
      }

      const tr = `
        <tr 
            data-id="${row.id}"
            data-date="${row.date || ''}"
            data-heure-debut="${row.heure_debut || ''}"
            data-heure-fin="${row.heure_fin || ''}"
            data-titre="${row.titre || ''}"
            data-type="${row.type_activite || ''}"
            data-type-libelle="${row.type_libelle || ''}"
            data-statut="${statut || ''}"
            data-description="${row.description || ''}"
            data-piece="${row.piece_jointe_path || ''}">
            
            <td><input type="checkbox" value="${row.id}"></td>
            <td>${row.date || ''}</td>
            <td>${row.heure_debut} – ${row.heure_fin}</td>
            <td>${row.titre || ''}</td>
            <td>${row.type_libelle || ''}</td>
            <td>${pj}</td>
            <td>${badge}</td>
            <td>
            <div class="actions">
                <button class="action-btn">...</button>
                <div class="dropdown-menu">
                <a href="#" class="edit-link" data-action="Modifier" data-id="${row.id}">Modifier</a>
                <a href="/activites-quotidiennes-details?id=${row.id}" target="_blank">Fiche d’activité</a>
                <a href="#" class="delete-link" data-action="Supprimer" data-id="${row.id}">Supprimer</a>
                ${statutActions}
                </div>
            </div>
            </td>
        </tr>`;

      tbody.insertAdjacentHTML('beforeend', tr);
    });

    // Réinitialiser DataTable
    $('#candidaturesTable').DataTable({
      paging: true,
      searching: true,
      ordering: false,
      info: false,
      pageLength: 5,
      lengthChange: false,  
      language: {
        paginate: {
          previous: "<i class='fa fa-chevron-left'></i>",
          next: "<i class='fa fa-chevron-right'></i>"
        },
        emptyTable: "Aucune donnée disponible",
        zeroRecords: "Aucun enregistrement trouvé"
      }
    });

    // Gestion clic sur action statut (event delegation)
    $('#candidaturesTable tbody').off('click', '.set-status').on('click', '.set-status', async function(e){
        e.preventDefault();
        e.stopPropagation(); // évite que le menu dropdown se ferme avant

        const id     = $(this).data('id');
        const status = $(this).data('status');
        console.log("Click set-status:", id, status);

        try {
            const updateUrl = `${(PMSettings?.restUrl || '/wp-json').replace(/\/$/,'')}/plateforme-directeurderecherche/v1/activite_quotidienne/${id}`;
            const formData  = new FormData();
            formData.append('_method','PATCH');
            formData.append('statut', status);

            await fetch(updateUrl, {
            method: 'POST',
            credentials: 'include',
            headers: { 'X-WP-Nonce': PMSettings.nonce },
            body: formData
            });

            Swal.fire('Succès', `Activité mise à jour: ${status}`, 'success');
            loadActivitesQuotidiennes();
            loadStatsActiviteQuotidienne();
        } catch(err){
            console.error('[set-status]', err);
            Swal.fire('Erreur', 'Impossible de mettre à jour le statut.', 'error');
        }
    });


    // --- Gestion des actions sur les lignes ---
    $('#candidaturesTable tbody').off('click', '.dropdown-menu a').on('click', '.dropdown-menu a', function(e) {
        e.stopPropagation(); // empêche le menu de se refermer avant traitement
        const action = $(this).data('action');
        const row = $(this).closest('tr');

        if (action) {
            e.preventDefault();
            const table = $('#candidaturesTable').DataTable();
            const rowData = table.row(row).data();

            if (action === 'Modifier') {
                const id = $(this).data('id');
                openEditModal(id); // fonction à définir pour pré-remplir ton modal
            } 
            else if (action === 'Supprimer') {
                  const id = $(this).data('id');
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c80000',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Oui, supprimer !',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteActiviteQuotidienne(id); // ✅ appelle ta fonction API
                    }
                });
            }
        }
    });



  } catch (e) {
    console.error('[loadActivitesQuotidiennes]', e);
  }
}
async function openEditModal(id) {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne/${id}`;

  try {
    const row = await wpFetch(url); // API retourne l’activité complète

    $('#editAactivity-title').val(row.titre);
    $('#editActiviteDate').val(row.date);
    $('#editActiviteHeureDebut').val(row.heure_debut);
    $('#editActiviteHeureFin').val(row.heure_fin);
    $('#editTypeActivite').val(row.type_activite);
    $('#editDescriptionDetaillee').val(row.description || row.titre);
   // $('#editStatutActivite').val(row.statut);
   let statut = (row.Statut || '').trim();
    if (!['Terminé','Prévu','En cours'].includes(statut)) {
    statut = 'Prévu'; // valeur par défaut
    }
    $('#editStatutActivite').val(statut);

    $('#editFileText').val(row.piece_jointe_path ? row.piece_jointe_path.split('/').pop() : '');

    $('#modalModifier').data('id', id).css('display','flex');
  } catch (e) {
    console.error(e);
    Swal.fire('Erreur','Impossible de charger l’activité.','error');
  }
}



// Charger les stats
async function loadStatsActiviteQuotidienne(){
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/stats-activites-quotidiennes`;

  try {
    const data = await wpFetch(url);

    // 🟢 Mettre à jour les valeurs gauche
    document.querySelector('.stat-box:nth-child(1) .value').textContent = data.today;
    document.querySelector('.stat-box:nth-child(2) .value').textContent = data.tomorrow;

    // 🟢 Préparer données chart
    const labels = data.types.map(r => r.type_libelle || 'Autre');
    const values = data.types.map(r => r.total);
    const colors = ['#808066','#b1342f','#dabebe','#4CAF50','#2196F3'];

    // 🟢 Détruire ancien graphique si existe
    if (window.pieChart && typeof window.pieChart.destroy === 'function') {
      window.pieChart.destroy();
    }

    // 🟢 Recréer graphique
    const ctx = document.getElementById('pieChart').getContext('2d');
    window.pieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: colors
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          datalabels: {
            color: '#fff',
            font: { weight: 'bold', size: 13 },
            formatter: (value) => value
          }
        }
      },
      plugins: [ChartDataLabels]
    });

    // 🟢 Légende dynamique
    const legendContainer = document.getElementById('chartLegend');
    legendContainer.innerHTML = '';
    labels.forEach((label, i) => {
      const item = document.createElement('div');
      item.className = 'legend-item';
      item.innerHTML = `<span class="legend-dot" style="background-color:${colors[i]}"></span>${label} (${values[i]})`;
      legendContainer.appendChild(item);
    });

  } catch(e){
    console.error('[loadStatsActiviteQuotidienne]', e);
  }
}


// Initialisation
document.addEventListener('DOMContentLoaded', () => {
  loadStatsActiviteQuotidienne();
});

/*
// CRUD → après succès, recharger tableau + stats
async function createActiviteQuotidienne(){ 
  // ... ton FormData ...
  await fetch(url,{method:'POST',credentials:'include',headers:{'X-WP-Nonce':PMSettings.nonce},body:formData});
  document.getElementById('modalObjectifs').style.display='none';
  loadActivitesQuotidiennes();
  loadStatsActiviteQuotidienne();
}*/

async function updateActiviteQuotidienne(id){
  // ... ton FormData ...
  await fetch(url,{method:'POST',credentials:'include',headers:{'X-WP-Nonce':PMSettings.nonce},body:formData});
  document.getElementById('modalModifier').style.display='none';
  loadActivitesQuotidiennes();
  loadStatsActiviteQuotidienne();
}

async function deleteActiviteQuotidienne(id){
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne/${id}`;

  try {
    const res = await fetch(url,{
      method:'DELETE',
      credentials:'include',
      headers:{ 'X-WP-Nonce': PMSettings.nonce }
    });

    if(res.ok){
      Swal.fire('Supprimé !','L\'activité a été supprimée.','success');
      loadActivitesQuotidiennes();
      loadStatsActiviteQuotidienne();
    }else{
      const errText = await res.text();
      throw new Error(errText || 'Erreur API');
    }
  } catch(e){
    console.error('[deleteActiviteQuotidienne]', e);
    Swal.fire('Erreur','Impossible de supprimer l\'activité.','error');
  }
}

function closeModalObjectifs() {
     const modalObjectifs = document.getElementById("modalObjectifs");
    if (modalObjectifs) modalObjectifs.style.display = "none";
}
// Initialisation au chargement
document.addEventListener("DOMContentLoaded", () => {
  loadActivitesQuotidiennes();
  loadStatsActiviteQuotidienne();
  document.querySelector('.btn-report')?.addEventListener('click', ()=> window.print());


    // --- File Upload Text Display ---
    $('#fileUpload').on('change', function() {
    const fileName = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
    $(this).siblings('.input-file-text').val(fileName);
    });

  $('#btnSaveObjectifs').on('click', async function(event) {
    event.preventDefault();

    if (!$('#activiteDate').val() || !$('#typeActivite').val() || !$('#statutActivite').val()) {
        Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires.', 'error');
        return;
    }

    const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
    const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne`;

    const formData = new FormData();
    formData.append('date', $('#activiteDate').val());
    formData.append('heure_debut', $('#activiteHeureDebut').val());
    formData.append('heure_fin', $('#activiteHeureFin').val());
    formData.append('titre', $('#activity-title').val());
    formData.append('type_activite', $('#typeActivite').val());
    formData.append('statut', $('#statutActivite').val());
    formData.append('description', $('#descriptionDetaillee').val());
    if ($('#fileUpload')[0].files.length > 0) {
        formData.append('piece_jointe', $('#fileUpload')[0].files[0]);
    }

    try {
        // 🟢 Afficher loader
        Swal.fire({
        title: 'Enregistrement en cours...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
        });

        await fetch(url, {
        method: 'POST',
        credentials: 'include',
        headers: { 'X-WP-Nonce': PMSettings.nonce },
        body: formData
        });

        // succès → fermer modal et recharger table + stats
        closeModalObjectifs();
        Swal.fire('Succès', 'Activité enregistrée.', 'success');

        // 🟢 Recharger les données
        loadActivitesQuotidiennes();
        loadStatsActiviteQuotidienne();

        // 🟢 Vider le formulaire
        $('#activiteDate').val('');
        $('#activiteHeureDebut').val('');
        $('#activiteHeureFin').val('');
        $('#descriptionDetaillee').val('');
        $('#typeActivite').val('');
        $('#statutActivite').val('');
        $('#fileUpload').val('');
        $('.input-file-text').val('Aucun fichier choisi');

    } catch (e) {
        console.error(e);
        Swal.fire('Erreur', 'Impossible d\'enregistrer l\'activité.', 'error');
    }
    });

    
        $('#btnSaveModifier').on('click', async function(e){
            e.preventDefault();
            const id = $('#modalModifier').data('id');
            const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
            const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne/${id}`;

            const formData = new FormData();
            formData.append('date', $('#editActiviteDate').val());
            formData.append('heure_debut', $('#editActiviteHeureDebut').val());
            formData.append('heure_fin', $('#editActiviteHeureFin').val());
            formData.append('type_activite', $('#editTypeActivite').val());
                formData.append('titre', $('#editAactivity-title').val());
            formData.append('description', $('#editDescriptionDetaillee').val());
            formData.append('statut', $('#editStatutActivite').val());
            if($('#editFileUpload')[0].files.length > 0){
                formData.append('piece_jointe', $('#editFileUpload')[0].files[0]);
            }

            try {
                const res = await fetch(url,{
                method:'POST', // ⚠️ ton endpoint accepte POST + _method PATCH
                credentials:'include',
                headers:{ 'X-WP-Nonce': PMSettings.nonce },
                body: formData
                });
                if(!res.ok) throw new Error('Erreur API');

                Swal.fire('Succès','Activité mise à jour.','success');
                $('#modalModifier').hide();
                loadActivitesQuotidiennes();
                loadStatsActiviteQuotidienne();
            }catch(err){
                console.error(err);
                Swal.fire('Erreur','Impossible de mettre à jour l\'activité.','error');
            }
            });

            const modalModifier = document.getElementById("modalModifier");
            const popupModifier = document.getElementById("popupContainerModifier");
            modalModifier.addEventListener('click', function(e) {
            if (!popupModifier.contains(e.target)) {
                modalModifier.style.display = "none";
            }
            });

/*
    // --- EDIT MODAL Logic ---
        const modalModifier = document.getElementById("modalModifier");
        const popupModifier = document.getElementById("popupContainerModifier");
        const btnCloseEditModal = document.getElementById("btnCloseEditModal");

        let editingRow = null; // Variable to store the row being edited

        function openEditModal(row) {
            editingRow = row; // Store the row
            const rowData = table.row(row).data();
            if (modalModifier) {
                $('#editMembreConcerne').val(rowData[2]);

                // Split the time string and populate the two time inputs
                const timeRange = rowData[1].split(' – ');
                $('#editActiviteHeureDebut').val(timeRange[0]);
                $('#editActiviteHeureFin').val(timeRange[1]);

                $('#editTypeActivite').val(rowData[4].trim());
                $('#editDescriptionDetaillee').val(rowData[3]);

                const statutText = $('<div>').html(rowData[6]).text().trim();
                $('#editStatutActivite').val(statutText);

                $('#editFileText').val(rowData[5]);

                modalModifier.style.display = "flex";
            }
        }

        function closeModalModifier() {
            if (modalModifier) modalModifier.style.display = "none";
            editingRow = null; // Clear the editing row
        }

        btnCloseEditModal.addEventListener('click', closeModalModifier);


        $('#btnSaveModifier').on('click', function(event) {
            event.preventDefault();
            if (editingRow) {
                const updatedData = [
                    table.cell(editingRow, 0).data(), // Keep checkbox state
                    `${$('#editActiviteHeureDebut').val()} – ${$('#editActiviteHeureFin').val()}`,
                    $('#editMembreConcerne').val(),
                    $('#editDescriptionDetaillee').val(),
                    $('#editTypeActivite').val(),
                    $('#editFileUpload')[0].files[0] ? $('#editFileUpload')[0].files[0].name : $(
                        '#editFileText').val(),
                    getBadgeHtml($('#editStatutActivite').val()),
                    table.cell(editingRow, 7).data() // Keep actions HTML
                ];
                table.row(editingRow).data(updatedData).draw();
            }
            closeModalModifier();
        });

        if (modalModifier && popupModifier) {
            modalModifier.addEventListener("click", function(e) {
                if (!popupModifier.contains(e.target) && e.target !== btnCloseEditModal) {
                    closeModalModifier();
                }
            });
        }


        $('#editFileUpload').on('change', function() {
            const fileName = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
            $('#editFileText').val(fileName);
        });
*/
    
});



async function loadTypesActivite(){
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/types-activite-quotidienne`;
  try {
    const data = await wpFetch(url);

    const selects = [
      document.getElementById('typeActivite'),
      document.getElementById('editTypeActivite'),
      document.getElementById('typeFilter')
    ];

    selects.forEach(sel => {
      if (!sel) return;
      sel.innerHTML = ''; // reset options
      // option par défaut
      const def = document.createElement('option');
      def.value = '';
      def.textContent = sel.id === 'typeFilter' ? 'Type' : 'Sélection..';
      def.selected = true;
      sel.appendChild(def);

      // injecter options
      data.forEach(row => {
        const opt = document.createElement('option');
        opt.value = row.id;
        opt.textContent = row.libelle_fr;
        sel.appendChild(opt);
      });
    });

  } catch(e){
    console.error('[loadTypesActivite]', e);
  }
}

// Appel initial
document.addEventListener("DOMContentLoaded", ()=>{
  loadTypesActivite();
});


const modalObjectifs = document.getElementById("modalObjectifs");
const popupContainerObjectifs = document.getElementById("popupContainerObjectifs");

const modalModifier = document.getElementById("modalModifier");
const popupContainerModifier = document.getElementById("popupContainerModifier");


// Fermer si clic à l’extérieur
modalObjectifs.addEventListener('click', function(e) {
  if (!popupContainerObjectifs.contains(e.target)) {
    closeModalObjectifs();
  }
});

function closeModalModifier() {
    if (modalModifier) modalModifier.style.display = "none";
}

// Fermer si clic à l’extérieur
modalModifier.addEventListener('click', function(e) {
  if (!popupContainerModifier .contains(e.target)) {
    closeModalModifier();
  }
});



</script>


</body>

</html>