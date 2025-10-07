<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner List</title>
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

        /* === Improved Dropdown Menu Design === */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            /* Position right below the button */
            right: 0;
            min-width: 180px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 6px 0;
            /* Vertical padding */
            margin-top: 5px;
            /* Space between button and menu */
            overflow: hidden;
            /* To respect border-radius */
        }

        .dropdown-menu a {
            display: flex;
            /* Use flex for alignment */
            align-items: center;
            gap: 10px;
            /* Space between icon and text */
            padding: 10px 16px;
            text-decoration: none;
            font-size: 14px;
            color: #333;
            transition: background-color 0.2s;
            white-space: nowrap;
        }

        .dropdown-menu a:hover {
            background-color: #f7f7f7;
            color: #000;
        }

        .dropdown-menu a i {
            width: 16px;
            /* Fixed width for icon alignment */
            text-align: center;
            color: #666;
        }

        /* important pour que .show affiche le menu */
        .dropdown-menu {
            display: none;
        }

        .dropdown-menu.show {
            display: block;
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
            /* position: absolute; */
            /* right: 0; */
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
            /* border-radius: 10px; */
            /* box-shadow: 0 0 0 1px #ddd; */
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
            /* display: grid; */
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

        #candidaturesTable {
            border-collapse: separate;
            border-spacing: 0;
            /* border-radius: 50x 50px 0 0; */
            overflow: hidden;
        }

        #candidaturesTable thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        #candidaturesTable thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        #candidaturesTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        #candidaturesTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
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
            z-index: 999999;
        }

        .popup-container {
            background-color: white;
            width: 400px;
            height: 100%;
            padding: 20px 0px;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            padding-top: 0px;
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
            color: #6E6D55;
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
        }

        .popup-form .input-file-text:focus {
            outline: none;
        }

        .popup-form .btn-importer {
            background-color: #A6A485;
            color: #fff !important;
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
            flex-direction: column;
            align-items: flex-start;
            margin-top: 15px;
        }

        .popup-form input[type="radio"] {
            accent-color: #c62828;
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
    </style>
</head>

<body>

    <div class="content-block">
        <div class="header-bar">
            <h2 class="dashboard-sub-title">
                <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Icon"
                    style="width: 38px; margin-right: 8px; vertical-align: middle; font-weight: blod;">
                Liste Des Partenaires
            </h2>
            <!-- This button will open the modal -->
            <button class="add-project-btn">Ajouter un réseau/collaboration</button>
        </div>

        <hr class="section-divider">

        <div class="filter-bar">
            <div class="filter-inputs">
                <!-- Search Input -->
                <div class="input-with-icon">
                    <input class="filter-input" type="text" id="searchInput" placeholder="Recherchez...">
                    <i class="fas fa-search icon right-icon search-field"></i>
                </div>

                <!-- Status Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="statusFilter">
                        <option value="">État (tous)</option>
                        <option value="Actif">Actif</option>
                        <option value="Occasionnel">Occasionnel</option>
                        <option value="En cours">En cours</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>

                <!-- Country Select -->
                <div class="input-with-icon">
                    <select class="filter-select" id="countryFilter">
                        <option value="">Pays (tous)</option>
                        <option value="France">France</option>
                        <option value="Tunisie">Tunisie</option>
                        <option value="Maroc">Maroc</option>
                        <option value="Belgique">Belgique</option>
                    </select>
                    <i class="fas fa-chevron-down icon right-icon"></i>
                </div>
            </div>

            <div class="filter-actions">
                <!-- Updated Icons -->
                <button class="icon-btn" title="Filter">
                    <!-- <i class="fa fa-filter"></i> -->
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                        alt="Icon-funnel">
                </button>
                <button class="icon-btn" title="Download">
                    <!-- <i class="fa fa-download"></i> -->
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                        alt="upload-red.png">
                </button>
            </div>
        </div>


        <table id="candidaturesTable" class="styled-table display">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Institution partenaire</th>
                    <th>Pays</th>
                    <th>Type de partenariat</th>
                    <th>Contact principal</th>
                    <th>Convention</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table body will be populated by JavaScript -->
            </tbody>
        </table>

        <!-- Include Reusable Pagination Component -->
        <?php include 'pagination.php'; ?>
    </div>

    <!-- Add Modal HTML -->
    <div class="modal-overlay" id="modalObjectifs" style="display: none;">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Ajouter un réseau/collaboration</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="institutionPartenaire">Institution partenaire</label>
                    <input type="text" id="institutionPartenaire">
                </div>

                <div class="form-group">
                    <label for="pays">Pays</label>
                    <div class="input-with-icon">
                        <select id="pays">
                            <option>Sélection..</option>
                            <option value="France">France</option>
                            <option value="Tunisie">Tunisie</option>
                            <option value="Maroc">Maroc</option>
                            <option value="Belgique">Belgique</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="typeCollaboration">Type De Collaboration</label>
                    <div class="input-with-icon">
                        <select id="typeCollaboration">
                            <option>Sélection..</option>
                            <option value="Projet De Recherche H2020">Projet De Recherche H2020</option>
                            <option value="Cotutelle Doctorale">Cotutelle Doctorale</option>
                            <option value="Article Scientifique">Article Scientifique</option>
                            <option value="Échange & Co-Pub">Échange & Co-Pub</option>
                            <option value="Projet Bilatéral">Projet Bilatéral</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <fieldset>
                    <legend>Contact principal</legend>
                    <div class="form-group">
                        <label for="nomComplet">Nom Complet</label>
                        <input type="text" id="nomComplet">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email">
                    </div>

                </fieldset>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="adresse" id="adresse">
                </div>
                <div class="form-group">
                    <label for="siteweb">Site Web</label>
                    <input type="siteweb" id="siteweb">
                </div>

                <div class="form-group">
                    <label for="dateDebut">Date Début</label>
                    <input type="date" id="dateDebut">
                </div>

                <div class="form-group">
                    <label for="dateFin">Date Fin</label>
                    <input type="date" id="dateFin">
                </div>



                <div class="form-group">
                    <label>Convention Signée ?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="convention" value="oui" checked> Oui</label>
                        <label><input type="radio" name="convention" value="non"> Non</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projetsAssocies">Projets associés</label>
                    <div class="input-with-icon">
                        <select id="projetsAssocies">
                            <option>Sélection..</option>
                            <option>Sélection..</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pieceJointe">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Aucun fichier choisi"
                            style="border: none;" readonly>
                        <label for="fileUpload" class="btn-importer">
                            <!-- <i class="fas fa-upload"></i> -->
                            <img width="20px" style="margin-right: 6px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite">
                            Importer
                        </label>
                        <input type="file" id="fileUpload" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div class="modal-overlay" id="modalModifier" style="display: none;">
        <div class="popup-container" id="popupContainerModifier">
            <div class="popup-header">
                <h2>Modifier le réseau/collaboration</h2>
                <button class="btn-enregistrer" id="btnUpdateObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="institutionPartenaireModifier">Institution partenaire</label>
                    <input type="text" id="institutionPartenaireModifier">
                </div>

                <div class="form-group">
                    <label for="paysModifier">Pays</label>
                    <div class="input-with-icon">
                        <select id="paysModifier">
                            <option>Sélection..</option>
                            <option value="France">France</option>
                            <option value="Tunisie">Tunisie</option>
                            <option value="Maroc">Maroc</option>
                            <option value="Belgique">Belgique</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="typeCollaborationModifier">Type De Collaboration</label>
                    <div class="input-with-icon">
                        <select id="typeCollaborationModifier">
                            <option>Sélection..</option>
                            <option value="Projet De Recherche H2020">Projet De Recherche H2020</option>
                            <option value="Cotutelle Doctorale">Cotutelle Doctorale</option>
                            <option value="Article Scientifique">Article Scientifique</option>
                            <option value="Échange & Co-Pub">Échange & Co-Pub</option>
                            <option value="Projet Bilatéral">Projet Bilatéral</option>
                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <fieldset>
                    <legend>Contact principal</legend>
                    <div class="form-group">
                        <label for="nomCompletModifier">Nom Complet</label>
                        <input type="text" id="nomCompletModifier">
                    </div>
                    <div class="form-group">
                        <label for="emailModifier">Email</label>
                        <input type="email" id="emailModifier">
                    </div>
                </fieldset>


                <div class="form-group">
                    <label for="adresseModifier">Adresse</label>
                    <input type="adresseModifier" id="adresseModifier">
                </div>
                <div class="form-group">
                    <label for="sitewebModifier">Site Web</label>
                    <input type="sitewebModifier" id="sitewebModifier">
                </div>

                <div class="form-group">
                    <label for="dateDebut">Date Début</label>
                    <input type="date" id="dateDebutModifier">

                </div>

                <div class="form-group">
                    <label for="dateFin">Date Fin</label>
                    <input type="date" id="dateFinModifier">

                </div>


                <div class="form-group">
                    <label>Convention Signée ?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="conventionModifier" value="oui"> Oui</label>
                        <label><input type="radio" name="conventionModifier" value="non"> Non</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projetsAssociesModifier">Projets associés</label>
                    <div class="input-with-icon">
                        <select id="projetsAssociesModifier">
                            <option>Sélection..</option>
                            <option>Sélection..</option>

                        </select>
                        <i class="fas fa-chevron-down icon right-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pieceJointeModifier">Pièce jointe (facultatif)</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" id="fileTextModifier"
                            placeholder="Aucun fichier choisi" style="border: none;" readonly>
                        <label for="fileUploadModifier" class="btn-importer">
                            <img width="20px" style="margin-right: 6px;"
                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                alt="Icon-uploadwhite">
                            Importer</label>
                        <input type="file" id="fileUploadModifier" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- JS Libraries -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- User-provided scripts combined and updated -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Make the DataTable instance globally accessible
            window.partenairesTable = $('#candidaturesTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                pageLength: 5,
                dom: '<"top">rt<"clear">p', // 'p' is needed for pageLength to work but is hidden by your CSS
                language: {
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    },
                    emptyTable: "Aucune donnée disponible",
                    zeroRecords: "Aucun enregistrement correspondant trouvé"
                },
                // Define columns to map data from your API to the table
                columns: [{
                    data: null, // Checkbox column
                    render: () => `<input type="checkbox">`,
                    orderable: false
                }, {
                    data: 'institution'
                }, {
                    data: 'pays'
                }, {
                    data: 'type_collab'
                }, {
                    data: 'contact_nom'
                }, {
                    data: 'convention_signee',
                    render: (data) => data ? 'Oui' : 'Non'
                }, {
                    data: 'statut',
                    render: function (data) { // Use your existing badgeHTML function
                        if (window.badgeHTML) return window.badgeHTML(data);
                        return data; // Fallback
                    }
                }, {
                    data: 'id', // Actions column
                    render: function (data) { // Use your existing actionsHTML function
                        if (window.actionsHTML) return window.actionsHTML(data);
                        return ''; // Fallback
                    },
                    orderable: false
                }]
            });

            // Initialize your reusable pagination component
            if (typeof PMOPagination !== 'undefined') {
                const container = document.querySelector('.custom-pagination');
                PMOPagination.init(window.partenairesTable, container);
            }

            // --- Custom Search and Filter Logic ---
            $('#searchInput').on('keyup', function () {
                window.partenairesTable.search(this.value).draw();
            });

            $('#countryFilter').on('change', function () {
                window.partenairesTable.column(2).search(this.value).draw(); // Column 2 is "Pays"
            });

            $('#statusFilter').on('change', function () {
                window.partenairesTable.column(6).search(this.value).draw(); // Column 6 is "Statut"
            });

            // --- Check All Logic (remains the same) ---
            $('#checkAll').on('click', function () {
                const rows = window.partenairesTable.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function () {
                if (!this.checked) {
                    const el = $('#checkAll').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });

            // --- Add Modal Logic ---
            const addModal = document.getElementById("modalObjectifs");
            const addPopup = document.getElementById("popupContainerObjectifs");
            const openAddBtn = document.querySelector('.add-project-btn');

            function openAddModal() {
                if (addModal) addModal.style.display = "flex";
            }

            function closeAddModal() {
                if (addModal) addModal.style.display = "none";
            }
            if (openAddBtn) {
                openAddBtn.addEventListener('click', openAddModal);
            }
            if (addModal && addPopup) {
                addModal.addEventListener("click", (e) => {
                    if (!addPopup.contains(e.target)) closeAddModal();
                });
            }

            // --- Edit Modal Logic ---
            const editModal = document.getElementById("modalModifier");
            const editPopup = document.getElementById("popupContainerModifier");

            // Use event delegation for dynamically added rows
            $('#candidaturesTable tbody').on('click', '.btn-modifier', function (e) {
                e.preventDefault();

                // Find the table row for the clicked button
                const row = this.closest('tr');
                const cells = row.querySelectorAll('td');

                // Extract data from the row
                const institution = cells[1].textContent;
                const pays = cells[2].textContent;
                const type = cells[3].textContent;
                const contact = cells[4].textContent;
                const convention = cells[5].textContent.trim().toLowerCase();

                // Populate the edit modal form
                document.getElementById('institutionPartenaireModifier').value = institution;
                document.getElementById('paysModifier').value = pays;
                document.getElementById('typeCollaborationModifier').value = type;
                document.getElementById('nomCompletModifier').value = contact;

                // Handle radio button for 'convention'
                if (convention === 'oui') {
                    document.querySelector('input[name="conventionModifier"][value="oui"]')
                        .checked = true;
                } else {
                    document.querySelector('input[name="conventionModifier"][value="non"]')
                        .checked = true;
                }



                openEditModal();
            });

            function toAbsoluteUrl(path) {
                if (!path) return '';
                if (/^https?:\/\//i.test(path)) return path;
                const base = window.location.origin;
                return path.startsWith('/') ? base + path : base + '/' + path;
            }

            function basename(path) {
                if (!path) return '';
                const i = path.lastIndexOf('/');
                return i >= 0 ? path.slice(i + 1) : path;
            }

            // Référence de la modale (assure-toi que l'ID correspond à ton HTML)
            const modalEdit = document.getElementById('modalModifier');

            // Si tu charges les pays via une API asynchrone, crée un "ready" promis (optionnel)
            let paysReady = Promise.resolve(); // remplace par la vraie promesse si tu as loadPays() async

            // --- Ouvrir la modale d'édition avec préremplissage + pièce jointe ---
            async function openEditModal(id) {
                if (!id) return;
                try {
                    // (optionnel) attendre que la liste des pays soit prête pour bien sélectionner #paysModifier
                    await paysReady;

                    const item = await api(`reseaux/${id}`, {
                        method: 'GET'
                    });

                    // Champs simples
                    document.getElementById('institutionPartenaireModifier').value = item.institution || '';
                    document.getElementById('paysModifier').value = item.pays || '';
                    document.getElementById('typeCollaborationModifier').value = item.type_collab || '';
                    document.getElementById('nomCompletModifier').value = item.contact_nom || '';
                    document.getElementById('emailModifier').value = item.contact_email || '';
                    document.getElementById('dateDebutModifier').value = item.date_debut || '';
                    document.getElementById('dateFinModifier').value = item.date_fin || '';

                    // Convention (radio)
                    const yes = document.querySelector('input[name="conventionModifier"][value="oui"]');
                    const no = document.querySelector('input[name="conventionModifier"][value="non"]');
                    if (yes && no) (item.convention_signee ? yes : no).checked = true;

                    // Projet associé (si le select existe)
                    if (item.projets_associes?.length) {
                        const selProj = document.getElementById('projetsAssociesModifier');
                        if (selProj) selProj.value = String(item.projets_associes[0]);
                    }

                    // >>> Pièce jointe existante
                    const linkEl = document.getElementById(
                        'pieceJointeModifierLink'); // lien sous l'input (à créer si absent)
                    const fileTextEl = document.getElementById('fileTextModifier'); // input texte readonly
                    const fileInput = document.getElementById('fileUploadModifier'); // input type=file

                    // reset input file local (ne pas garder l'ancien choix)
                    if (fileInput) fileInput.value = '';

                    if (item.piece_jointe_path) {
                        const absUrl = toAbsoluteUrl(item.piece_jointe_path);
                        const name = basename(item.piece_jointe_path);

                        if (fileTextEl) fileTextEl.value = name || 'Fichier existant';
                        if (linkEl) {
                            linkEl.href = absUrl;
                            linkEl.style.display = 'inline-block';
                            linkEl.textContent = name ? `Voir « ${name} »` : 'Voir la pièce jointe';
                        }
                    } else {
                        if (fileTextEl) fileTextEl.value = 'Aucun fichier choisi';
                        if (linkEl) linkEl.style.display = 'none';
                    }

                    // Ouvrir modale
                    if (modalEdit) {
                        modalEdit.dataset.id = id;
                        modalEdit.style.display = 'flex'; // "flex" pour ton overlay; sinon "block"
                    }
                } catch (err) {
                    console.error(err?.message || err || 'Erreur chargement');
                    alert('Impossible de charger les données du réseau');
                }
            }


            function closeEditModal() {
                if (editModal) editModal.style.display = "none";
            }

            if (editModal && editPopup) {
                editModal.addEventListener("click", (e) => {
                    if (!editPopup.contains(e.target)) closeEditModal();
                });
            }

            // --- File Input Logic for Add Modal ---
            const fileUpload = document.getElementById('fileUpload');
            const fileText = document.querySelector('#modalObjectifs .input-file-text');
            if (fileUpload && fileText) {
                fileUpload.addEventListener('change', function () {
                    fileText.value = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
                });
            }

            // --- File Input Logic for Edit Modal ---
            const fileUploadModifier = document.getElementById('fileUploadModifier');
            const fileTextModifier = document.getElementById('fileTextModifier');
            if (fileUploadModifier && fileTextModifier) {
                fileUploadModifier.addEventListener('change', function () {
                    fileTextModifier.value = this.files.length > 0 ? this.files[0].name :
                        'Aucun fichier choisi';
                });
            }
        });
    </script>
    <?php
    $current_user = wp_get_current_user();
    $roles = (array) $current_user->roles;
    $role = $roles[0] ?? '';
    $user_id = get_current_user_id();

    ?>
    <script>
        window.PMSettings = {
            restUrl: "<?= esc_url(rest_url()) ?>",
            nonce: "<?= wp_create_nonce('wp_rest') ?>",
            role: "<?= esc_js($role) ?>",
            userId: <?= (int) $user_id ?>
        };
    </script>
    <script src="/wp-content/plugins/plateforme-master/assets/js/recherche/partenaires.js"></script>

</body>

</html>