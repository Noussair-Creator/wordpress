<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCI-Learn Project Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <style>
    .content-wrapper {
        font-family: 'Poppins', sans-serif;
    }

    .header-section {
        margin-bottom: 20px;
    }

    .header-section h2 {
        font-size: 22px;
        font-weight: 600;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: #fff;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .card-header-with-button {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        border-bottom: 1px solid #eee;
        padding-bottom: 6px;
        margin-left: -15px;
        margin-right: -15px;
        margin-top: -19px;
        padding: 20px 25px;
        box-shadow: 0px 5px 16px #00000012;
    }

    .card h3 {
        font-size: 21px;
        font-weight: bold;
        color: #2A2916;
        margin: 0;
    }

    .modifier-button {
        background: #fff;
        border: 2px solid #C60000;
        color: #C60000;
        padding: 8px 40px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .modifier-button:hover {
        background: #C60000;
        color: #fff;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        margin-bottom: 8px;
        font-size: 14px;
    }

    .enabled {
        background: #9EB08F;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 13px;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .parcours-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .parcours-table th,
    .parcours-table td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 13px;
        text-align: center;
    }

    .parcours-table th {
        background-color: #f5f5f5;
        font-weight: 600;
    }

    .pdf-icon {
        width: 16px;
        vertical-align: middle;
        margin-right: 8px;
        color: #c60000;
    }

    .parcours-table a {
        text-decoration: none;
        color: #0d6efd;
        font-weight: 500;
    }

    .parcours-table a:hover {
        text-decoration: underline;
    }

    .status-bar-container {
        background-color: #fff;
        border-radius: 8px;
        padding: 16px 24px;
        margin-bottom: 24px;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0px 3px 16px #00000014;
    }

    .status-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-header h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .status-dropdown {
        position: relative;
        display: inline-block;
    }

    .current-status {
        padding: 6px 16px;
        border-radius: 20px;
        background-color: #D6E6D3;
        color: #2B6629;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        user-select: none;
    }

    .current-status.accepted {
        background-color: #C6E8C2;
        color: #247626;
    }

    .status-list {
        position: absolute;
        top: 120%;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 8px 0;
        margin: 4px 0 0 0;
        list-style: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        display: none;
        z-index: 10;
    }

    .status-dropdown:hover .status-list {
        display: block;
    }

    .status-item {
        padding: 6px 16px;
        font-size: 14px;
        cursor: pointer;
    }

    .status-item:hover {
        background-color: #f2f2f2;
    }

    .status-item.selected {
        background-color: #e7f6e6;
        color: #2B6629;
        font-weight: bold;
    }

    .status-wrapper h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .status-select {
        position: relative;
    }

    .status-options {
        position: absolute;
        right: 0;
        top: 110%;
        width: 180px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        display: none;
        flex-direction: column;
        padding: 4px 0;
        z-index: 10;
    }

    .status-select:hover .status-options {
        display: flex;
    }

    .option {
        padding: 10px 16px;
        font-size: 14px;
        text-align: left;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .option:hover {
        background-color: #f5f5f5;
    }

    .option.selected {
        background-color: #e9f5e8;
        color: #2a6529;
        font-weight: 600;
    }

    button.status-button {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #BF0404;
        border-radius: 5px;
        padding: 5px 45px;
        font-weight: 600;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: auto auto;
        gap: 24px;
    }

    .box {
        background-color: #ffffff;
        padding: 20px 24px;
        border-radius: 12px;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
        cursor: grab;
    }

    .box:active {
        cursor: grabbing;
    }

    .box h3 {
        font-size: 21px;
        margin-bottom: 14px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
        padding-bottom: 6px;
        box-shadow: 0px 5px 16px #00000012;
        margin-left: -23px;
        margin-right: -22px;
        margin-top: -19px;
        padding: 17px 15px;
    }

    .card.full-width {
        border: 0px;
        margin-bottom: 20px;
    }

    .box ul {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: 32px;
    }

    .box ul li {
        margin-bottom: 10px;
        font-size: 14px;
    }

    .badge.enabled {
        background-color: #A6A485;
        color: white;
        padding: 7px 15px;
        border-radius: 12px;
        font-size: 13px;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr;
        }
    }

    .styled-list {
        list-style: none;
        padding: 0;
        margin: 0;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .styled-list li {
        padding: 16px 16px;
        border-bottom: 1px solid #dedcc9;
        display: flex;
        color: #333;
        gap: 200px;
    }

    .styled-list li:last-child {
        border-bottom: none;
    }

    .styled-list li ul li {
        border-bottom: none;
        padding-left: 0px;
        padding: 0px;
    }

    .badge.badge-danger {
        background-color: #C31111;
        color: #fff;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        margin: 0px 8px 5px 0;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);
        background: #BF0404 0% 0% no-repeat padding-box;
        border-radius: 17px;
    }

    .styled-list li ul {
        padding: 0px;
    }

    .styled-list li ul li:first-child {
        padding-top: 0px
    }

    .styled-list strong {
        font-weight: 600;
        color: #6E6D55;
        min-width: 240px;
        display: inline-block;
    }

    .box ul li {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 14px;
        padding: 10px 0;
        border-bottom: 1px solid #dedcc9;
        font-weight: 600;
    }

    .box ul li:last-child {
        border-bottom: none;
    }

    .box ul li strong {
        min-width: 180px;
        font-weight: 600;
        color: #6E6D55;
        flex-shrink: 0;
    }

    .box ul li span {
        color: #333;
    }

    .parcours-table th {
        background-color: #ECEBE3;
        font-weight: bold;
    }

    .parcours-table th,
    .parcours-table td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
        text-align: left;
    }

    .parcours-table .notes-cell {
        text-align: left;
        font-size: 13px;
        line-height: 1.4;
        font-family: 'Poppins', sans-serif;
        color: #333;
        white-space: nowrap;
    }

    .status-select .btn {
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 6px;
        color: #333;
        padding: 6px 14px;
        font-size: 14px;
        min-width: 140px;
        box-shadow: none;
        transition: all 0.2s ease-in-out;
    }

    .status-select .btn:hover {
        border-color: #999;
        background-color: #f8f9fa;
    }

    .status-select .dropdown-toggle::after {
        margin-left: 8px;
        vertical-align: middle;
    }

    .parcours-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.06);
    }

    .parcours-table thead th {
        background-color: #ECEBE3;
        color: #333;
        font-weight: 600;
        padding: 14px 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    .parcours-table tbody td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        color: #444;
        vertical-align: middle;
        text-align: center;
    }

    .parcours-table tbody td:nth-child(2) {
        text-align: left;
    }

    .parcours-table tbody tr:last-child td {
        border-bottom: none;
    }

    .parcours-table td:first-child {
        width: 200px;
        font-weight: 500;
        color: #555;
    }

    .parcours-table td:nth-child(3) {
        font-weight: 300;
        color: #444;
    }

    table#historique tbody tr:last-child td:first-child {
        width: 143Px;
    }

    .dataTables_paginate {
        display: flex !important;
        justify-content: center !important;
        margin-top: 20px !important;
        gap: 6px !important;
        font-family: 'Poppins', sans-serif !important;
    }

    .dataTables_paginate .paginate_button {
        background-color: #fff !important;
        border: 2px solid #c40000 !important;
        color: #c40000 !important;
        font-weight: 500 !important;
        padding: 6px 10px !important;
        min-width: 36px !important;
        text-align: center !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #c40000 !important;
        color: #fff !important;
        border-color: #c40000 !important;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #f8eaea !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
    }

    .dataTables_paginate .paginate_button:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    table {
        border: none !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        box-shadow: none !important;
    }

    table thead {
        position: static !important;
        transform: translateY(-15px) !important;
        border: none !important;
    }

    table th {
        padding: 27px 10px 9px !important;
        border: 0px solid #EBE9D7 !important;
        background-color: #ECEBE3 !important;
        font-weight: bold !important;
    }

    table td {
        padding: 12px !important;
        border: 1px solid #EBE9D7 !important;
        box-shadow: none !important;
    }

    table thead tr:first-child th:first-child {
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }

    table thead tr:first-child th:last-child {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    table tbody tr:first-child td:first-child {
        border-top-left-radius: 12px !important;
    }

    table tbody tr:first-child td:last-child {
        border-top-right-radius: 12px !important;
    }

    table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px !important;
    }

    table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px !important;
    }

    table tbody tr:nth-child(even) {
        background: #ECEBE34D 0% 0% no-repeat padding-box !important;
    }

    .custom-list {
        list-style: none;
        padding-left: 0;
        margin-top: 10px;
    }

    .custom-list li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 6px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .custom-list li::before {
        content: "";
        position: relative;
        top: 6px;
        left: 0;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 10px solid #c40000;
        transform: rotate(90deg);
        margin-right: 10px;
    }

    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
        border: 1px solid #DBD9C3;
        border-radius: 8px;
        padding: 12px 45px 12px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #2A2916;
        background-image: url("/wp-content/plugins/plateforme-master/images/DROPDOWN icon.png");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 30px;
    }

    select.form-control::-ms-expand {
        display: none;
    }

    select.form-control::-ms-expand {
        display: none;
    }

    select.form-control:focus {
        outline: none;
        border-color: #c4c1a0;
        box-shadow: 0 0 0 2px rgba(204, 204, 204, 0.2);
    }

    .btn-status {
        color: #333;
        font-weight: 500;
    }

    .btn-status.accepted {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .btn-status.pending {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
    }

    .btn-status.rejected {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .dropdown-item {
        font-size: 15px;
    }

    .custom-ordered-list {
        list-style: none;
        padding-left: 0;
        counter-reset: item-counter;
        margin-top: 10px;
    }

    .custom-ordered-list li {
        counter-increment: item-counter;
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        font-weight: 600;
        color: #333;
    }

    .custom-ordered-list li::before {
        content: counter(item-counter) ".";
        font-weight: bold;
        color: #c60000;
        margin-right: 10px;
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

    .popup-form input,
    .popup-form select {
        width: 100%;
        padding: 10px;
        /* margin-bottom: 15px; */
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
    }

    .file-upload {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .file-upload input[type="file"] {
        display: none;
    }

    .file-upload label {
        background-color: #f5f5f5;
        padding: 8px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .file-upload {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .file-upload input[type="file"] {
        display: none;
    }

    .file-upload label {
        background-color: #f5f5f5;
        padding: 8px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .piece-jointe-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .champ-fichier {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #f3f3f3;
        border-radius: 6px;
        font-size: 14px;
        color: #666;
    }

    .btn-importer {
        background-color: #c62828;
        color: white;
        padding: 10px 16px;
        /* border-radius: 6px; */
        font-size: 14px;
        cursor: pointer;
        text-align: center;
        white-space: nowrap;
        border-radius: 0 6px 6px 0;
    }

    .custom-file-upload {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 10px;
    }

    .upload-label {
        display: inline-block;
        padding: 10px 15px;
        background-color: #f8f8f8;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        width: fit-content;
        transition: all 0.3s ease;
    }

    .upload-label:hover {
        background-color: #eaeaea;
    }

    .upload-label i {
        margin-right: 8px;
        color: #b40000;
    }

    .input-file-wrapper {
        display: flex;
        align-items: center;
        /* border: 1px solid #e2e0d1; */
        /* border-radius: 6px; */
        overflow: hidden;
        width: 100%;
        background-color: white;
    }

    .input-file-text {
        flex: 1;
        border: none;
        padding: 10px 12px;
        font-size: 14px;
        color: #555;
        background-color: transparent;
        border-radius: 6px 0 0 6px !important;
    }

    .input-file-text:focus {
        outline: none;
    }

    .btn-importer {
        background-color: #b5af8e;
        color: white;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        /* border-left: 1px solid #e2e0d1; */
        border: none;

    }

    .btn-importer i {
        font-size: 14px;
    }

    .modal-overlay label {
        min-width: 180px;
        font-weight: 600;
        color: #6E6D55;
        flex-shrink: 0;
        margin-bottom: 7px;
    }

    .objectifs_liste {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 20px;
    }

    .objectifs_liste li::before {
        content: '\25B6';
        color: #b40000;
        margin-right: 8px;
    }

    .btn-ajouter {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 10px 14px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
    }

    textarea {
        width: 100%;
        border: 1px solid #b5af8e;
        border-radius: 6px;
        padding: 12px;
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

    .file-with-count {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        color: #2a2916;
        font-weight: 600;
        position: relative;
    }

    .file-with-count span {
        position: absolute;
        top: -10px;
        right: 12px;
        background: #ECEBE3;
        width: 18px;
        height: 18px;
        font-size: 12px;
        border-radius: 50%;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .date-input-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    .date-input-container input[type="date"] {
        width: 100%;
        padding-right: 30px;
        /* Add space for the icon */
    }

    .date-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #C60000;
        pointer-events: none;
    }

    /* Hide default calendar icon in WebKit browsers */
    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
    </style>
</head>

<body>

    <div class="content-wrapper">

        <div class="card full-width">
            <h3>Informations générales</h3>
            <ul class="styled-list">
                <li><strong>Intitulé complet :</strong> </li>
                <li><strong>Responsable :</strong> </li>
                <li><strong>Période :</strong> </li>
                <li><strong>Financement :</strong> </li>
            </ul>

            <h3 style="margin-top: 30px;">Objectifs du projet</h3>
            <ol class="custom-ordered-list">

            </ol>
        </div>

        <!-- <div class="card full-width">
            <h3>Équipe du projet BCI-Learn (Interface cerveau-machine et apprentissage)</h3>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Rôle dans le projet</th>
                        <th>Grade universitaire</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pr. Rym Nasri</td>
                        <td>Porteur Du Projet</td>
                        <td>Professeur Universitaire</td>
                        <td><a href="mailto:Rym.Nasri@Utm.Tn">Rym.Nasri@Utm.Tn</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Adel Ben Hmida</td>
                        <td>Responsable Matériel & EEG</td>
                        <td>Maître De Conférences</td>
                        <td><a href="mailto:Adel.BenHmida@Utm.Tn">Adel.BenHmida@Utm.Tn</a></td>
                    </tr>
                    <tr>
                        <td>M. Houssem Lahmar</td>
                        <td>Responsable IA & Apprentissage</td>
                        <td>Maître-Assistant</td>
                        <td><a href="mailto:Houssem.Lahmar@Etu.Utm.Tn">Houssem.Lahmar@Etu.Utm.Tn</a></td>
                    </tr>
                    <tr>
                        <td>Mme. Marwa Trabelsi</td>
                        <td>Doctorant – Traitement Signal</td>
                        <td>Doctorant (e)</td>
                        <td><a href="mailto:Marwa.Trabelsi@Etu.Utm.Tn">Marwa.Trabelsi@Etu.Utm.Tn</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card full-width">
            <div class="card-header-with-button">
                <h3>Livrables attendus</h3>
                <button class="modifier-button" onclick="openModalLivrables()">Modifier</button>
            </div>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date prévue</th>
                        <th>Livrable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Article scientifique</td>
                        <td>"Neural decoding using low-cost BCI systems"</td>
                        <td>Décembre 2025</td>
                        <td style="text-align: center;">
                            <div class="file-with-count">

                                <img width="18px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png "
                                    alt="Icon-attach-2">
                                <span>2</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Prototype matériel</td>
                        <td>BCI-Learn v1.2 (module EEG + App Android)</td>
                        <td>Juin 2025</td>
                        <td style="text-align: center;">
                            <div class="file-with-count">
                                <img width="18px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png "
                                    alt="Icon-attach-2">
                                <span>1</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Manuel utilisateur</td>
                        <td>Guide d'installation & d'utilisation clinique</td>
                        <td>Septembre 2025</td>
                        <td style="text-align: center;">-</td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Rapport d'avancement</td>
                        <td>Rapport mi-parcours soumis à l'UTM & MESRS</td>
                        <td>Février 2025</td>
                        <td style="text-align: center;">-</td>
                    </tr>
                    <tr>
                        <td>005</td>
                        <td>Thèse en cours</td>
                        <td>Doctorat en traitement EEG (H. Lahmar)</td>
                        <td>Soutenance 2026</td>
                        <td style="text-align: center;">-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card full-width">
            <div class="card-header-with-button">
                <h3>Pièces jointes associées au projet</h3>
                <button class="modifier-button" onclick="openModalPiecesJointes()">Modifier</button>
            </div>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Ref_Doc</th>
                        <th>Type de document</th>
                        <th>Type</th>
                        <th>Version</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Convention projet</td>
                        <td>
                            <a href="#">
                                <img class="pdf-icon" width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="pdf-svgrepo-com">
                                Convention_BCI_UTM.pdf
                            </a>
                        </td>
                        <td>1.0</td>
                        <td>01/02/2024</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Planning détaillé</td>
                        <td>
                            <a href="#">
                                <img class="pdf-icon" width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/excel-document.png"
                                    alt="excel-document">
                                Planning_BCI_Q1Q2_2025.xlsx
                            </a>
                        </td>
                        <td>1.2</td>
                        <td>20/01/2025</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Rapport d'étape</td>
                        <td>
                            <a href="#">
                                <img class="pdf-icon" width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="pdf-svgrepo-com">
                                Rapport_BCI_Progress2024.pdf
                            </a>
                        </td>
                        <td>1.0</td>
                        <td>15/12/2024</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card full-width">
            <div class="card-header-with-button">
                <h3>Dépense</h3>
                <button class="modifier-button" onclick="openModalDepense()">Modifier</button>
            </div>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Désignation</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Achat matériel labo</td>
                        <td>54 000 TND</td>
                        <td>01/02/2024</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Déplacement</td>
                        <td>200 TND</td>
                        <td>20/01/2025</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Déplacement</td>
                        <td>670 TND</td>
                        <td>15/12/2024</td>
                    </tr>
                </tbody>
            </table>
        </div>

    -->

        <div class="card full-width">
            <div class="card-header-with-button">
                <h3>Dépense</h3>
                <button class="modifier-button" onclick="openModalDepense()">Ajouter</button>
            </div>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Désignation</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">Aucune dépense </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal-overlay" id="modalLivrables" style="display: none;">
        <div class="popup-container" id="popupContainerLivrables">
            <div class="popup-header">
                <h2>Livrables attendus</h2>
                <button class="btn-enregistrer" id="btnSaveLivrables">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" id="type" name="type" placeholder="">
                </div>
                <div class="form-group">
                    <label for="motif">Motif</label>
                    <textarea id="motif" name="motif" rows="4" placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label for="date-prevu">Date Prévu</label>
                    <div class="date-input-container">
                        <input type="date" id="date-prevu" name="date-prevu" placeholder="jj-mm-yyyy / jj-mm-yyyy">
                        <img class="date-icon" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                            alt="Icon-calendar">

                        <!-- <i class="fa-regular fa-calendar date-icon"></i> -->
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalPiecesJointes" style="display: none;">
        <div class="popup-container" id="popupContainerPiecesJointes">
            <div class="popup-header">
                <h2>Pièces jointes associées au projet</h2>
                <button class="btn-enregistrer" id="btnSavePiecesJointes">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="type-document">Type De Document</label>
                    <input type="text" id="type-document" name="type-document" placeholder="">
                </div>
                <div class="form-group">
                    <label for="piece-jointe">Piece jointe</label>
                    <div class="input-file-wrapper">
                        <input type="text" id="piece-jointe" name="piece-jointe" class="input-file-text"
                            placeholder="No file selected" readonly>
                        <button type="button" class="btn-importer"><i class="fas fa-file-arrow-up"></i>
                            Importer</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" id="version" name="version" placeholder="">
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalDepense" style="display: none;">
        <div class="popup-container" id="popupContainerDepense">
            <div class="popup-header">
                <h2>Dépense</h2>
                <button class="btn-enregistrer" id="btnSaveDepense">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div class="form-group">
                    <label for="designation">Désignation</label>
                    <input type="text" id="designation" name="designation" placeholder="">
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="text" id="montant" name="montant" placeholder="">
                </div>
                <div class="form-group">
                    <label for="date-depense">Date</label>
                    <div class="date-input-container">
                        <input type="date" id="date-depense" name="date-depense" placeholder="jj-mm-yyyy">
                        <!-- <i class="fa-regular fa-calendar date-icon"></i> -->
                        <img class="date-icon" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                            alt="Icon-calendar">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    function openmodalObjectifs() {
        const modal = document.getElementById("modalObjectifs");
        if (modal) {
            modal.style.display = "flex";
        } else {
            console.error("Modal non trouvé : #modalObjectifs");
        }
    }

    function openModalLivrables() {
        document.getElementById('modalLivrables').style.display = 'flex';
    }

    function openModalPiecesJointes() {
        document.getElementById('modalPiecesJointes').style.display = 'flex';
    }

    function openModalDepense() {
        document.getElementById('modalDepense').style.display = 'flex';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    const objectifs = [];

    function ajouterObjectif() {
        const val = document.getElementById("newObjectifGeneral").value.trim();
        if (val) {
            objectifs.push(val);
            const li = document.createElement("li");
            li.textContent = val;
            document.getElementById("listeObjectifsGeneraux").appendChild(li);
            document.getElementById("newObjectifGeneral").value = "";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.querySelector(".openmodalObjectifs");
        const modal = document.getElementById("modalObjectifs");

        if (btn && modal) {
            btn.addEventListener("click", function() {
                modal.style.display = "flex";
            });
        }
    });




    function closeModalObjectifs() {
        const modal = document.getElementById("modalObjectifs");
        if (modal) {
            modal.style.display = "none";
        }
    }
    const modal = document.getElementById("modalObjectifs");
    const popup = document.getElementById("popupContainerObjectifs");

    if (modal && popup) {
        modal.addEventListener("click", function(e) {
            if (!popup.contains(e.target)) {
                modal.style.display = "none";
            }
        });
    }



    document.getElementById('modalLivrables').addEventListener('click', function(e) {
        if (e.target.id === 'modalLivrables') {
            closeModal('modalLivrables');
        }
    });

    document.getElementById('modalPiecesJointes').addEventListener('click', function(e) {
        if (e.target.id === 'modalPiecesJointes') {
            closeModal('modalPiecesJointes');
        }
    });
    document.getElementById('modalDepense').addEventListener('click', function(e) {
        if (e.target.id === 'modalDepense') {
            closeModal('modalDepense');
        }
    });
    </script>





    <script type="module">
    const API_BASE = (window.PMSettings?.restUrl || "/wp-json/") + "plateforme-recherche/v1";
    async function wpFetch(path, opts = {}) {
        const res = await fetch(API_BASE + path, {
            credentials: 'include',
            headers: {
                'X-WP-Nonce': window.PMSettings?.nonce || '',
                ...(opts.headers || {})
            },
            method: opts.method || 'GET',
            body: opts.body || undefined
        });
        if (!res.ok) {
            const t = await res.text().catch(() => '');
            throw new Error(`HTTP ${res.status} ${t}`);
        }
        const ct = res.headers.get('content-type') || '';
        return ct.includes('application/json') ? res.json() : res.text();
    }
    document.addEventListener("DOMContentLoaded", async () => {
        const urlParams = new URLSearchParams(window.location.search);
        const projetId = urlParams.get("id");
        if (!projetId) return;




        try {
            const data = await wpFetch(`/projet/${projetId}/full`);

            // --- Infos générales ---
            const infoList = document.querySelector(".styled-list");
            if (infoList) {
                infoList.innerHTML = `
                <li><strong>Intitulé complet :</strong> ${data.titre || ''}</li>
                <li><strong>Responsable :</strong> ${data.chercheur_nom || ''}</li>
                <li><strong>Période :</strong> ${data.date_debut || ''} – ${data.date_fin || ''}</li>
                <li><strong>Financement :</strong> ${data.budget || 0} TND (${data.type_financement || '-'})</li>
                `;
            }

            // --- Objectifs ---
            const objList = document.querySelector(".custom-ordered-list");
            if (objList) {
                objList.innerHTML = "";

                // 🔹 Affiche le champ "objectifs" global (si existe)
                if (data.objectifs) {
                    const li = document.createElement("li");
                    li.textContent = data.objectifs;
                    li.style.fontWeight = "bold"; // ou autre style pour distinguer
                    objList.appendChild(li);
                }

                // 🔹 Affiche la liste détaillée
                (data.objectifs_list || []).forEach(o => {
                    const li = document.createElement("li");
                    li.textContent = o.objectif;
                    if (o.type === "general") {
                        li.style.color = "#2A2916";
                    } else if (o.type === "specifique") {
                        li.style.color = "#c60000"; // pour différencier visuellement
                    }
                    objList.appendChild(li);
                });
            }


            // --- Équipe ---
            const tbodyEquipe = document.querySelector("table.parcours-table:nth-of-type(1) tbody");
            if (tbodyEquipe) {
                tbodyEquipe.innerHTML = "";
                (data.membres || []).forEach(m => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${m.display_name || '—'}</td>
                    <td>${m.role_dans_projet || '—'}</td>
                    <td>${m.grade || '—'}</td>
                    <td><a href="mailto:${m.email || m.user_email || ''}">${m.email || m.user_email || ''}</a></td>
                `;
                    tbodyEquipe.appendChild(tr);
                });
            }

            // --- Livrables ---
            const tbodyLivrables = document.querySelector("div.card:nth-of-type(3) tbody");
            if (tbodyLivrables) {
                tbodyLivrables.innerHTML = "";
                (data.livrables || []).forEach(l => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${l.ref || ''}</td>
                    <td>${l.type_livrable || ''}</td>
                    <td>${l.description || ''}</td>
                    <td>${l.date_prevue || ''}</td>
                    <td>${l.fichier_url ? `<a href="${l.fichier_url}" target="_blank">📎</a>` : '-'}</td>
                `;
                    tbodyLivrables.appendChild(tr);
                });
            }

            // --- Pièces jointes ---
            const tbodyPieces = document.querySelector("div.card:nth-of-type(4) tbody");
            if (tbodyPieces) {
                tbodyPieces.innerHTML = "";
                (data.pieces || []).forEach(p => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${p.ref_doc || ''}</td>
                    <td>${p.type_doc || ''}</td>
                    <td><a href="${p.fichier_url}" target="_blank">${p.fichier_url?.split('/').pop()}</a></td>
                    <td>${p.version || ''}</td>
                    <td>${p.date_doc || ''}</td>
                `;
                    tbodyPieces.appendChild(tr);
                });
            }

            // --- Dépenses ---
            const tbodyDepenses = document.querySelector("table.parcours-table tbody");
            if (tbodyDepenses) {
                tbodyDepenses.innerHTML = "";
                (data.depenses || []).forEach(d => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${d.id || ''}</td>
                    <td>${d.designation || ''}</td>
                    <td>${d.montant || 0} TND</td>
                    <td>${d.date_depense || ''}</td>
                `;
                    tbodyDepenses.appendChild(tr);
                });
            }

        } catch (e) {
            console.error("Erreur chargement projet:", e);
        }
    });


    function notify(msg, type = 'success') {
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: type, // 'success', 'error', 'warning', 'info'
            title: msg
        });
    }



    async function saveDepense(projetId) {
        try {
            const refEl = document.getElementById('refDepense'); // optionnel
            const desig = document.getElementById('designation');
            const montant = document.getElementById('montant');
            const dateEl = document.getElementById('date-depense');

            if (!desig || !montant || !dateEl) throw new Error("Champs du formulaire introuvables.");
            if (!desig.value.trim()) return alert("La désignation est obligatoire.");
            if (!dateEl.value) return alert("La date est obligatoire.");

            const cleanMontant = (montant.value || "").replace(/\s+/g, '').replace(',', '.');

            const fd = new FormData();
            if (refEl) fd.append('ref', refEl.value || '');
            fd.append('designation', desig.value.trim());
            fd.append('montant', cleanMontant);
            fd.append('date_depense', dateEl.value);

            const res = await fetch(`${API_BASE}/projet/${projetId}/depense`, {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'X-WP-Nonce': window.PMSettings?.nonce || ''
                },
                body: fd
            });

            const data = await res.json().catch(() => null);

            if (!res.ok) {
                // 🔹 Affiche le message d’erreur renvoyé par l’API
                if (data && data.message) {
                    alert(`${data.code || "Erreur"} : ${data.message}`);
                } else {
                    alert(`Erreur HTTP ${res.status}`);
                }
                return;
            }

            alert('Dépense ajoutée avec succès.');
            closeModal('modalDepense');
            await loadDepenses(projetId);

        } catch (e) {
            alert('Erreur enregistrement dépense : ' + e.message);
            console.error(e);
        }
    }



    async function loadDepenses(projetId) {
        try {
            const data = await wpFetch(`/projet/${projetId}/full`);
            const tbodyDepenses = document.querySelector("table.parcours-table tbody");
            if (tbodyDepenses) {
                tbodyDepenses.innerHTML = "";
                (data.depenses || []).forEach(d => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${d.id || ''}</td>
                    <td>${d.designation || ''}</td>
                    <td>${d.montant || 0} TND</td>
                    <td>${d.date_depense || ''}</td>
                `;
                    tbodyDepenses.appendChild(tr);
                });
            }
        } catch (e) {
            console.error("Erreur chargement dépenses :", e);
        }
    }
    document.addEventListener("DOMContentLoaded", () => {
        const btnSaveDepense = document.getElementById('btnSaveDepense');
        if (btnSaveDepense) {
            btnSaveDepense.addEventListener('click', () => {
                const projetId = new URLSearchParams(window.location.search).get("id");
                if (projetId) {
                    saveDepense(projetId);
                } else {
                    notify("ID projet introuvable.", "error");
                }
            });
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>