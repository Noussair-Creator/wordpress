<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Activities</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- User-provided styles combined into one block -->
    <style>
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

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #c60000;
        border-color: red;
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
        margin-top: -5px;
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
        transition: background 0.2s;
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
        border-top: 1px solid #EBE9D7 !important;
    }

    #candidaturesTable tbody tr:first-child td:first-child {
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
        font-size: 24px;
        font-weight: bold;
        color: #333;
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
        display: flex;
        flex-direction: column;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        box-shadow: 0px 5px 16px #00000029;
        flex-shrink: 0;
    }

    form.popup-form {
        padding: 20px 25px;
        overflow-y: auto;
        flex-grow: 1;
    }

    .popup-footer {
        padding: 15px 25px;
        text-align: right;
        border-top: 1px solid #eee;
        flex-shrink: 0;
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
        /* color: #ffffff; */
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
        color: #333;
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

    .popup-form fieldset {
        border: 1px solid #b5af8e;
        border-radius: 7px;
        padding: 10px 15px;
        margin-bottom: 15px;
    }

    .popup-form legend {
        padding: 0 5px;
        font-weight: 600;
        color: #6E6D55;
        font-size: 14px;
    }

    .popup-form .radio-group {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .popup-form .radio-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: normal;
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
    </style>
</head>

<body>

    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Icon"
                    style="width: 38px; margin-right: 8px; vertical-align: middle; font-weight: blod;">
                Liste Des Activités Scientifiques
            </h2>
            <button class="add-project-btn">Ajouter une activité</button>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input search-input-field" type="text" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon"></i>
                </div>

                <!-- Type Select -->
                <div class="input-with-icon">
                    <select class="filter-select type-filter">
                        <option value="" selected>Type</option>
                        <option>Colloque</option>
                        <option>Communication</option>
                        <option>Encadrement Thèse</option>
                        <option>Brevet</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>

                <!-- Année Input -->
                <div class="input-with-icon">
                    <input class="filter-input date-input year-filter" type="text" placeholder="Année">

                    <img width="20px" class="icon right-icon"
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Icon-calendar">
                    <!-- <i class="fas fa-calendar-alt icon right-icon"></i> -->
                </div>
            </div>

            <div class="filter-actions">
                <button class="icon-btn" title="Filter" id="filter-btn">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                        alt="Icon-funnel">
                    <!-- <i class="fa fa-filter"></i> -->
                </button>
                <button class="icon-btn" title="Download">
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                        alt="upload-red.png">
                    <!-- <i class="fa fa-download"></i> -->
                </button>
            </div>
        </div>

        <table id="candidaturesTable" class="styled-table display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Type</th>
                    <th>Titre / Référence</th>
                    <th>Auteur principal</th>
                    <th>Année</th>
                    <th>Revue / Événement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               <!-- <tr>
                    <td><input type="checkbox"></td>
                    <td>Colloque</td>
                    <td>"Deep Learning For EEG Analysis"</td>
                    <td>Dr. Sarra Messaoudi</td>
                    <td>2024</td>
                    <td>Journal of Neuroscience Tech</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="edit-link">Modifier</a>
                                <a href="/activites-scientifiques-details">Voir</a>

                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Communication</td>
                    <td>"Traitement EEG Portable – BCI-Learn"</td>
                    <td>H. Lahmar</td>
                    <td>2024</td>
                    <td>Journée Neurosciences ISBM</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="edit-link">Modifier</a>
                                <a href="/activites-scientifiques-details">Voir</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Encadrement Thèse</td>
                    <td>Thèse Doctorale – IA & Biocapteurs</td>
                    <td>Dr. Rym Nasri</td>
                    <td>2025</td>
                    <td>_</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="edit-link">Modifier</a>
                                <a href="/activites-scientifiques-details">Voir</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Brevet</td>
                    <td>"Système Embarqué EEG 3 Canaux"</td>
                    <td>A. Ben Hmida</td>
                    <td>2023</td>
                    <td>INNORPI</td>
                    <td>
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="edit-link">Modifier</a>
                                <a href="/activites-scientifiques-details">Voir</a>
                                <a href="#">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>-->
            </tbody>
        </table>
    </div>

    <!-- Add Modal HTML -->
    <div class="modal-overlay" id="modalObjectifs" style="display: none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Ajouter une activité</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="typeActivite">Type</label>
                    <div class="input-with-icon">
                        <select id="typeActivite">
                            <option>Sélection..</option>
                            <option value="Colloque">Colloque</option>
                            <option value="Communication">Communication</option>
                            <option value="Encadrement Thèse">Encadrement Thèse</option>
                            <option value="Brevet">Brevet</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="titreReference">Titre / Référence</label>
                    <input type="text" id="titreReference">
                </div>
                
                <div class="form-group">
                    <label for="anneePublication">Année de publication</label>
                    <select id="anneePublication" class="filter-select">
                    <!-- Options injectées en JS -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="sourceRevue">Source / Revue / Événement</label>
                    <input type="text" id="sourceRevue">
                </div>
                <div class="form-group">
                    <label for="pieceJointe">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" id="fileText" class="input-file-text" placeholder="Aucun fichier choisi"
                            style="border:none;" readonly>
                        <label style="color: white;" for="fileUpload" class="btn-importer">
                            <!-- <i class="fas fa-upload"></i>  -->
                            <img width="20px" style="margin-right: 10px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite.png">
                            Importer
                        </label>
                        <input type="file" id="fileUpload" style="display:none;">
                    </div>
                </div>
            </form>
            <!-- <div class="popup-footer">
              
            </div> -->
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div class="modal-overlay" id="modalModifier" style="display: none;">
        <div class="popup-container" id="popupContainerModifier">
            <div class="popup-header">
                <h2>Modifier l'activité</h2>
                <button class="btn-enregistrer" id="btnSaveModifier">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="typeActiviteModifier">Type</label>
                    <div class="input-with-icon">
                        <select id="typeActiviteModifier">
                            <option>Sélection..</option>
                            <option value="Colloque">Colloque</option>
                            <option value="Communication">Communication</option>
                            <option value="Encadrement Thèse">Encadrement Thèse</option>
                            <option value="Brevet">Brevet</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="titreReferenceModifier">Titre / Référence</label>
                    <input type="text" id="titreReferenceModifier">
                </div>
             
                <div class="form-group">
                    <label for="anneePublicationModifier">Année de publication</label>
                     <select id="anneePublicationModifier" class="filter-select"></select>
                </div>
                <div class="form-group">
                    <label for="sourceRevueModifier">Source / Revue / Événement</label>
                    <input type="text" id="sourceRevueModifier">
                </div>
                <div class="form-group">
                    <label for="pieceJointeModifier">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" id="fileTextModifier" class="input-file-text"
                            placeholder="Aucun fichier choisi" style="border:none;" readonly>
                        <label style="color: white;" for="fileUploadModifier" class="btn-importer">
                            <!-- <i class="fas fa-upload"></i> -->
                            <img width="20px" style="margin-right: 10px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite.png">
                            Importer
                        </label>
                        <input type="file" id="fileUploadModifier" style="display:none;">
                    </div>
                </div>
            </form>
            <!-- <div class="popup-footer">
              
            </div> -->
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>



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

    <!-- Updated Scripts with Filter, Check-All, and Modal Functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        var table = $('#candidaturesTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'Bfrtip',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            }
        });

        // --- Filter Logic ---
        function applyFilters() {
            const searchText = $('.search-input-field').val().toLowerCase();
            const typeValue = $('.type-filter').val();
            const yearValue = $('.year-filter').val();

            table.search(searchText);
            table.column(1).search(typeValue ? '^' + typeValue + '$' : '', true, false);
            table.column(4).search(yearValue ? '^' + yearValue + '$' : '', true, false);
            table.draw();
        }

        $('.search-input-field, .year-filter').on('keyup', applyFilters);
        $('.type-filter').on('change', applyFilters);

        // --- Action Button Dropdown Logic ---
        $('#candidaturesTable tbody').on('click', '.action-btn', function(e) {
            e.stopPropagation();
            $('.dropdown-menu').not($(this).next('.dropdown-menu')).hide();
            $(this).next('.dropdown-menu').toggle();
        });

        $(document).on('click', function() {
            $('.dropdown-menu').hide();
        });

        // --- Check All Functionality ---
        $('#checkAll').on('change', function() {
            const isChecked = $(this).prop('checked');
            table.rows({
                page: 'current'
            }).nodes().to$().find('td:first-child input[type="checkbox"]').prop('checked',
                isChecked);
        });

        $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function() {
            var allChecked = table.rows({
                page: 'current'
            }).nodes().to$().find('td:first-child input[type="checkbox"]').length === table.rows({
                page: 'current'
            }).nodes().to$().find('td:first-child input[type="checkbox"]:checked').length;
            $('#checkAll').prop('checked', allChecked);
        });

        // --- Generic Modal Handling ---
        function setupModal(modalId, popupId, openTriggers, saveBtnId) {
            const modal = document.getElementById(modalId);
            const popup = document.getElementById(popupId);
            const saveBtn = document.getElementById(saveBtnId);
            const closeBtn = modal.querySelector('.btn-close-x');

            if (!modal || !popup) {
                console.error("Modal or popup not found for:", modalId);
                return;
            }

            const openModal = () => modal.style.display = "flex";
            const closeModal = () => modal.style.display = "none";

            // Open modal using specified triggers
            if (openTriggers) {
                $(document).on('click', openTriggers, function(e) {
                    if (e) e.preventDefault();
                    openModal();
                });
            }

            // Close modal on save button click
            if (saveBtn) saveBtn.addEventListener('click', closeModal);

            // Close modal on 'X' button click
            if (closeBtn) closeBtn.addEventListener('click', closeModal);

            // Close modal on overlay click
            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        // --- File Input Logic ---
        function setupFileInput(uploadId, textId) {
            const fileUpload = document.getElementById(uploadId);
            const fileText = document.getElementById(textId);
            if (fileUpload && fileText) {
                fileUpload.addEventListener('change', function() {
                    fileText.value = this.files.length > 0 ? this.files[0].name :
                        'Aucun fichier choisi';
                });
            }
        }

        // --- Initialize Modals and File Inputs ---

        // Add Modal
        setupModal('modalObjectifs', 'popupContainerObjectifs', '.add-project-btn', 'btnSaveObjectifs');
        setupFileInput('fileUpload', 'fileText');

        // Edit Modal
        setupModal('modalModifier', 'popupContainerModifier', null, 'btnSaveModifier');
        setupFileInput('fileUploadModifier', 'fileTextModifier');

        // --- Specific Logic for Edit Modal Opening ---
      /*  $('#candidaturesTable tbody').on('click', '.edit-link', function(e) {
            e.preventDefault();

            const row = $(this).closest('tr');
            const rowData = table.row(row).data();

            // Populate the modal form
            $('#typeActiviteModifier').val(rowData[1]);
            $('#titreReferenceModifier').val(rowData[2]);
            $('#auteursModifier').val(rowData[3]);
            $('#anneePublicationModifier').val(rowData[4]);
            $('#sourceRevueModifier').val(rowData[5]);

            // Open the modal
            $('#modalModifier').css('display', 'flex');
        });*/
    });




    /****************************** charger APi*/
    /** Petit utilitaire fetch avec nonce WP */
    async function wpFetch(url, options = {}) {
    const headers = Object.assign({
        'Accept': 'application/json'
    }, options.headers || {});

    // ajoute le nonce si présent
    if (window.PMSettings?.nonce) headers['X-WP-Nonce'] = PMSettings.nonce;

    const res = await fetch(url, Object.assign({ credentials: 'include', headers }, options));
    if (!res.ok) {
        let msg = `Erreur API (${res.status})`;
        try { const j = await res.json(); if (j?.message) msg = j.message; } catch(e){}
        throw new Error(msg);
    }
    return res.json();
    }

    /** Remplir un <select> à partir d'une liste d'items {id, libelle} */
    function populateSelect(selectEl, items, placeholder = 'Sélectionner...') {
    if (!selectEl) return;
    const current = selectEl.value; // on tente de conserver la valeur
    selectEl.innerHTML = '';

    const opt0 = document.createElement('option');
    opt0.value = '';
    opt0.textContent = placeholder;
    selectEl.appendChild(opt0);

    items.forEach(it => {
        const opt = document.createElement('option');
        opt.value = String(it.id);
        opt.textContent = it.libelle || it.code;
        selectEl.appendChild(opt);
    });

    // restaure si possible
    if (current) selectEl.value = current;
    }

    /** Charge les types d’activités et peuple #typeActivite & #typeActiviteModifier */
    async function loadTypesActivites({ lang = 'fr', q = '', actif = 1 } = {}) {
    const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
    const url  = `${base}/plateforme-directeurderecherche/v1/types-activites?lang=${encodeURIComponent(lang)}&actif=${actif}` + (q ? `&q=${encodeURIComponent(q)}` : '');

    try {
        const data = await wpFetch(url);
        const items = Array.isArray(data?.items) ? data.items : [];

        const sel1 = document.getElementById('typeActivite');
        const sel2 = document.getElementById('typeActiviteModifier');

        populateSelect(sel1, items, 'Type d’activité…');
        populateSelect(sel2, items, 'Type d’activité…');

          if (sel1.options.length > 0) {
            sel1.options[0].disabled = true;
        }
        if (sel2.options.length > 0) {
            sel2.options[0].disabled = true;
        }


    } catch (e) {
        console.error('[loadTypesActivites]', e);
        if (window.toast) window.toast('Erreur de chargement des types : ' + e.message, true);
    }
    }

    // === Init ===
    document.addEventListener('DOMContentLoaded', () => {
    // première charge
    loadTypesActivites();


    });





    /****************************** ACTIVITES SCIENTIFIQUES CRUD ******************************/

// Charger la liste des activités
async function loadActivites() {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique`;

  try {
    const data = await wpFetch(url);
    const tbody = document.querySelector('#candidaturesTable tbody');
    tbody.innerHTML = '';

    (data || []).forEach(row => {
      const auteur = row.first_name || row.last_name 
        ? `${row.first_name || ''} ${row.last_name || ''}`.trim()
        : row.display_name || `User #${row.user_id}`;

      // lien pièce jointe si présent
      let pj = '';
    /*  if (row.piece_jointe_path) {
        const urlFile = row.piece_jointe_path.startsWith('http')
          ? row.piece_jointe_path
          : `${window.location.origin}/wp-content/recherche/activites/${row.piece_jointe_path}`;
        pj = `<a href="${urlFile}" target="_blank"><i class="fa fa-file-pdf pdf-icon"></i></a>`;
      }*/

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><input type="checkbox" value="${row.id}"></td>
        <td>${row.type_libelle || ''}</td>
        <td>${row.titre_reference || ''}</td>
        <td>${auteur}</td>
        <td>${row.annee || ''}</td>
        <td>${row.Source || ''} ${pj}</td>
        <td>
          <div class="actions">
            <button class="action-btn">...</button>
            <div class="dropdown-menu">
                <a href="/activites-scientifiques-details?id=${row.id}" target="_blank">Voir</a>
              <a href="#" class="edit-link" data-id="${row.id}">Modifier</a>
              <a href="#" class="delete-link" data-id="${row.id}">Supprimer</a>
            </div>
          </div>
        </td>`;
      tbody.appendChild(tr);
    });
  } catch (e) {
    console.error('[loadActivites]', e);
  }
}


// Créer une activité
async function createActivite() {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique`;

  const formData = new FormData();
  formData.append('annee', document.getElementById('anneePublication').value);
  formData.append('titre_reference', document.getElementById('titreReference').value);
  formData.append('user_id', PMSettings.userId);
  formData.append('type_id', document.getElementById('typeActivite').value);
  formData.append('Source', document.getElementById('sourceRevue').value);

  // fichier (si sélectionné)
  const fileInput = document.getElementById('fileUpload');
  if (fileInput.files.length > 0) {
    formData.append('piece_jointe', fileInput.files[0]);
  }

  await fetch(url, {
    method: 'POST',
    credentials: 'include',
    headers: { 'X-WP-Nonce': PMSettings.nonce },
    body: formData
  }).then(res => {
    if (!res.ok) throw new Error("Erreur API " + res.status);
    return res.json();
  });

  document.getElementById('modalObjectifs').style.display = 'none';
  loadActivites();
  loadStatsAndChart(); 
}


// Mettre à jour une activité
async function updateActivite(id) {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique/${id}`;

  const formData = new FormData();
  formData.append('_method', 'PATCH'); // ⚠️ WP comprendra que c'est un update
  formData.append('annee', document.getElementById('anneePublicationModifier').value);
  formData.append('titre_reference', document.getElementById('titreReferenceModifier').value);
  formData.append('user_id', PMSettings.userId);
  formData.append('type_id', document.getElementById('typeActiviteModifier').value);
  formData.append('Source', document.getElementById('sourceRevueModifier').value);

/*
  const fileInput = document.getElementById('fileUploadModifier');
  if (fileInput && fileInput.files.length > 0) {
    formData.append('piece_jointe', fileInput.files[0]);
  } else {
    formData.append('piece_jointe_path', document.getElementById('fileTextModifier').value || '');
  }
    */

     const fileInput = document.getElementById('fileUploadModifier');
    if (fileInput && fileInput.files.length > 0) {
    formData.append('piece_jointe', fileInput.files[0]);
    } else {
    let filePath = document.getElementById('fileTextModifier').value || '';
    
    // 🔹 Extraire uniquement le nom du fichier
    let fileName = filePath ? filePath.split('/').pop() : '';
    
    formData.append('piece_jointe_path', fileName);
    }


  await fetch(url, {
    method: 'POST', // ⚠️ pas PATCH, car FormData
    credentials: 'include',
    headers: { 'X-WP-Nonce': PMSettings.nonce },
    body: formData
  }).then(res => {
    if (!res.ok) throw new Error("Erreur API " + res.status);
    return res.json();
  });

  document.getElementById('modalModifier').style.display = 'none';
  loadActivites();
  loadStatsAndChart(); 
}



// Supprimer une activité

async function deleteActivite(id) {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique/${id}`;

  const res = await fetch(url, {
    method: 'DELETE',
    credentials: 'include',
    headers: { 'X-WP-Nonce': PMSettings.nonce }
  });

  if (res.status === 204) {
    alert("Activité supprimée avec succès ✅");
    loadActivites(); // recharge la liste
    loadStatsAndChart(); 
  } else {
    const err = await res.json();
    alert("Erreur de suppression ❌ : " + (err.message || res.status));
  }
}

// === Brancher les boutons ===
document.addEventListener('DOMContentLoaded', () => {
  // Charger la liste au démarrage
  loadActivites();

  // Ajouter
  document.getElementById('btnSaveObjectifs').addEventListener('click', e => {
    e.preventDefault();
    createActivite();
  });

  // Modifier
  document.getElementById('btnSaveModifier').addEventListener('click', e => {
    e.preventDefault();
    const id = document.querySelector('#modalModifier').dataset.editId;
    if (id) updateActivite(id);
  });

  // Ouvrir modal edit avec valeurs
 $('#candidaturesTable tbody').on('click', '.edit-link', async function(e) {
  e.preventDefault();
  const id = $(this).data('id');

  try {
    const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
    const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique/${id}`;
    const row  = await wpFetch(url);

    // Remplir le formulaire du modal avec les données récupérées
    $('#typeActiviteModifier').val(row.type_id);
    $('#titreReferenceModifier').val(row.titre_reference);
    $('#anneePublicationModifier').val(row.annee);
    $('#sourceRevueModifier').val(row.Source);
   // $('#fileTextModifier').val(row.piece_jointe_path || '');
    $('#fileTextModifier').val(row.piece_jointe_path ? row.piece_jointe_path.split('/').pop() : '');


    // garder l'ID pour updateActivite()
    $('#modalModifier').attr('data-edit-id', id);

    // ouvrir le modal
    $('#modalModifier').css('display', 'flex');
  } catch (err) {
    console.error('[edit-link] Erreur chargement activité', err);
    alert("Impossible de charger l’activité.");
  }
});


  // Supprimer
  $('#candidaturesTable tbody').on('click', '.delete-link', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    if (confirm("Supprimer cette activité ?")) {
      deleteActivite(id);
    }
  });
});

// Remplit un <select> avec une liste d'années (ex: de l'année courante à -30 ans)
function populateYearSelect(selectId, startYearOffset = 0, pastYears = 30) {
  const select = document.getElementById(selectId);
  if (!select) return;

  const currentYear = new Date().getFullYear();
  select.innerHTML = '<option value="">Sélectionner une année</option>';

  for (let y = currentYear - startYearOffset; y >= currentYear - pastYears; y--) {
    const opt = document.createElement('option');
    opt.value = y;
    opt.textContent = y;
    select.appendChild(opt);
  }
}

// Exemple d’utilisation pour ton champ année
document.addEventListener("DOMContentLoaded", () => {
  populateYearSelect("anneePublication", 0, 30);           // Pour le champ ajout
  populateYearSelect("anneePublicationModifier", 0, 30);   // Pour le champ modification
});


    </script>


<script>
let pieChart; // conserver le graphique pour le mettre à jour

// Récupération des activités depuis l’API
async function loadStatsAndChart(year = '') {
  const base = (PMSettings?.restUrl || '/wp-json').replace(/\/$/, '');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_scientifique`;

  try {
    const data = await wpFetch(url);

    // Filtrer par année si besoin
    const filtered = year ? data.filter(a => a.annee === year) : data;

    // Compteurs par type
    const stats = {
      Colloque: 0,
      Communication: 0,
      "Encadrement": 0,
      Brevet: 0
    };

    filtered.forEach(row => {
      switch(row.type_libelle) {
        case "Colloque": stats.Colloque++; break;
        case "Communication": stats.Communication++; break;
        case "Encadrement": stats["Encadrement"]++; break;
        case "Brevet": stats.Brevet++; break;
      }
    });

    // Mise à jour DOM
    document.getElementById("statColloque").textContent = stats.Colloque;
    document.getElementById("statCommunication").textContent = stats.Communication;
    document.getElementById("statEncadrement").textContent = stats["Encadrement"];
    document.getElementById("statBrevet").textContent = stats.Brevet;

    // Préparer graph
    const labels = Object.keys(stats);
    const values = Object.values(stats);
    const colors = ['#808066', '#b1342f', '#dabebe', '#4CAF50'];

    // Détruire le graph précédent si existe
    if (pieChart) pieChart.destroy();

    const ctx = document.getElementById('pieChart').getContext('2d');
    pieChart = new Chart(ctx, {
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

    // Légende dynamique
    const legendContainer = document.getElementById('chartLegend');
    legendContainer.innerHTML = '';
    labels.forEach((label, i) => {
      const item = document.createElement('div');
      item.className = 'legend-item';
      item.innerHTML = `<span class="legend-dot" style="background-color:${colors[i]}"></span>${label} (${values[i]})`;
      legendContainer.appendChild(item);
    });

    // Mise à jour liste années pour filtre
    const years = [...new Set(data.map(a => a.annee))].sort((a, b) => b - a);
    const yearSel = document.getElementById("yearFilter");
    yearSel.innerHTML = `<option value="">Toutes années</option>`;
    years.forEach(y => {
      const opt = document.createElement("option");
      opt.value = y;
      opt.textContent = y;
      if (y === year) opt.selected = true;
      yearSel.appendChild(opt);
    });

  } catch (e) {
    console.error('[loadStatsAndChart]', e);
  }
}

// Initialisation
document.addEventListener("DOMContentLoaded", () => {
  loadStatsAndChart();

  // Filtre année
  document.getElementById("yearFilter").addEventListener("change", e => {
    loadStatsAndChart(e.target.value);
  });

  // Bouton rapport
  document.querySelector(".btn-report").addEventListener("click", () => {
    window.print(); // ou appel API export PDF/Excel
  });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.querySelector('.btn-report').addEventListener('click', () => {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'pt', 'a4');
  
  // Sélection de la zone à exporter (par exemple le contenu principal)
  const element = document.querySelector('.content-wrapper') || document.body;

  html2canvas(element, { scale: 2 }).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const pageWidth = doc.internal.pageSize.getWidth();
    const pageHeight = doc.internal.pageSize.getHeight();
    
    // Ajustement image à la taille de la page
    const imgWidth = pageWidth;
    const imgHeight = canvas.height * imgWidth / canvas.width;
    
    doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
    doc.save("rapport_global.pdf");
  });
});
</script>


</body>

</html>