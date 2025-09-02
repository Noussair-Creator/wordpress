<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Information</title>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .content-wrapper {
            /* padding: 20px; */
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
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 21px;
            margin-bottom: 14px;
            font-weight: bold;
            border-bottom: 1px solid #eee;
            padding-bottom: 6px;
            margin-left: -15px;
            margin-right: -15px;
            margin-top: -19px;
            padding: 20px 25px;
            box-shadow: 0px 5px 16px #00000012;
            color: #2A2916;
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

        .full-width h3 {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            /* Added margin for spacing */
            color: #c60000;
            /* Red color for icons */
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
            /* margin-top: 20px; */
            border: 0px;
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

        /* Responsive */
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
            padding: 4px 0 15px 20px;
            /* Added padding for bullet and vertical space */
            position: relative;
        }

        /* --- MODIFIED FOR ALIGNMENT --- */
        .styled-list li ul li::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #c60000;
            position: absolute;
            left: 0;
            /* Position at the start of the padding */
            top: 0.7em;
            /* Vertically center relative to font size */
            transform: translateY(-50%);
            /* Fine-tune vertical alignment */
        }

        .parcours-table .text-center {
            text-align: center;
        }

        .styled-list .status-active-icon {
            color: #28a745;
            margin-right: 8px;
        }

        .styled-list span img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            vertical-align: middle;
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
            text-align: center;
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
        }

        .parcours-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            color: #444;
            vertical-align: middle;
            text-align: left
        }

        .parcours-table tbody tr:last-child td {
            border-bottom: none;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            width: 500px;
        }

        .parcours-table td:first-child {
            width: 100px;
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

        /****table  */
        /* Container pagination */
        .dataTables_paginate {
            display: flex !important;
            justify-content: center !important;
            margin-top: 20px !important;
            gap: 6px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        /* Boutons de pagination */
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

        /* Bouton actif */
        .dataTables_paginate .paginate_button.current {
            background-color: #c40000 !important;
            color: #fff !important;
            border-color: #c40000 !important;
        }

        /* Survol */
        .dataTables_paginate .paginate_button:hover {
            background-color: #f8eaea !important;
        }

        /* Supprime les bordures par défaut de DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
        }

        /* Supprime focus violet */
        .dataTables_paginate .paginate_button:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Table générique */
        table {
            border: none !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            box-shadow: none !important;
        }

        /* En-têtes */
        table thead {
            position: static !important;
            transform: translateY(-15px) !important;
            border: none !important;
        }

        /* Cellules */
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

        /* Coins arrondis */
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

        /*** style table */
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

        /* style select **/
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


        /* Pour IE */
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

        /* Custom styles for ordered list */
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

        .popup-form input,
        .popup-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            white-space: nowrap;
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
            border: 1px solid #e2e0d1;
            border-radius: 6px;
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
        }

        .input-file-text:focus {
            outline: none;
        }

        .btn-importer {
            background-color: #b5af8e;
            color: white;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            border-left: 1px solid #e2e0d1;
        }

        .btn-importer i {
            font-size: 14px;
        }

        .modal-overlay label {
            /* min-width: 180px; */
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

        /* Styles for the new form in the modal */
        .popup-form .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .popup-form label {
            font-weight: 600;
            color: #6E6D55;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .popup-form input[type="text"],
        .popup-form select,
        .popup-form textarea,
        .popup-form input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5af8e;
            border-radius: 7px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        .popup-form textarea {
            resize: vertical;
        }

        .logo-upload-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .logo-placeholder {
            width: 100px;
            height: 100px;
            border: 2px dashed #ccc;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .logo-placeholder input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .logo-placeholder i {
            font-size: 24px;
            color: #999;
        }

        .logo-inputs {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .logo-inputs .form-group {
            margin-bottom: 0;
        }

        .form-divider {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .popup-form h3 {
            font-size: 16px;
            font-weight: bold;
            color: #2A2916;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        /* New styles for project modal */
        .associated-projects-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .associated-projects-list li {
            padding: 8px 0;
            font-size: 14px;
            color: #333;
        }

        .added-project-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            margin-bottom: 8px;
            background-color: #f9f9f9;
            border-radius: 6px;
            border: 1px solid #eee;
        }

        .added-project-item span {
            font-size: 14px;
        }

        .added-project-item button {
            background: none;
            border: none;
            color: #c62828;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-add-project {
            border: 1px solid #c62828;
            color: #c62828;
            background-color: #fff;
            padding: 6px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-add-project:hover {
            background-color: #f8eaea;
            color: #c62828;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="content-wrapper">

        <!-- Informations générales block -->
        <div class="card full-width">
            <h3>Informations générales<a href="#" id="modifyInfoBtn"><i class="fa-regular fa-pen-to-square"
                        style="color: #b60303;"></i></a></h3>

            <ul class="styled-list">
                <li><strong>Logo et Dénomination :</strong><span><img
                            src="/wp-content/plugins/plateforme-master/images/icons/logo2.png" alt="photo"> <strong
                            style="color: #2A2916;"> LSAMA – Laboratoire de Systèmes
                            Autonomes et Multi-Agents</strong> </span></li>
                <li><strong>Code LR :</strong> 97GH02</li>
                <li><strong>Établissement :</strong>FST – Faculté des Sciences de Tunis</li>
                <li><strong>Date de création :</strong>15/11/ 2018</li>
                <li><strong>Directeur du laboratoire :</strong> Mr. Ahmed Ben Ahmed</li>
                <li><strong>Statut du financement :</strong><span><i
                            class="fas fa-circle status-active-icon"></i>Actif</span></li>
            </ul>
        </div>

        <!-- Objectifs et thématiques block -->
        <div class="card full-width">
            <h3>Objectifs et thématiques</h3>
            <ul class="styled-list">
                <li><strong>Objectif général :</strong>Développer des approches intelligentes et distribuées dans les
                    systèmes autonomes, multi-agents et embarqués.</li>
                <li><strong>Axes de recherche :</strong>
                    <ul>
                        <li>Systèmes multi-agents intelligents</li>
                        <li>Planification autonome et robotique mobile</li>
                        <li>IA distribuée et systèmes auto-adaptatifs</li>
                        <li>Coopération homme-machine</li>
                    </ul>
                </li>

            </ul>
        </div>

        <!-- Projets associés  block -->
        <div class="card full-width">
            <h3>Projets associés<a href="#" id="modifyObjectivesBtn" class="btn-add-project">Ajouter un projet</a></h3>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Titre du projet</th>
                        <th>Statut</th>
                        <th>Financement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Système coopératif autonome pour le trafic</td>
                        <td>En cours</td>
                        <td>MESRES</td>
                    </tr>
                    <tr>
                        <td>Agents intelligents pour l’énergie distribuée</td>
                        <td>Terminé</td>
                        <td>Coop. France–Tunisie</td>
                    </tr>
                    <tr>
                        <td>LSAMA-SAT : satellite autonome éducatif</td>
                        <td>En cours</td>
                        <td>H2020 (EU)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Effectif scientifique block -->
        <div class="card full-width">
            <h3>Effectif scientifique</h3>
            <table class="parcours-table">
                <thead>
                    <tr>
                        <th>Statut</th>
                        <th class="text-center">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Enseignants</td>
                        <td class="text-center">8</td>
                    </tr>
                    <tr>
                        <td>Doctorants</td>
                        <td class="text-center">10</td>
                    </tr>
                    <tr>
                        <td>Ingénieurs</td>
                        <td class="text-center">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal 1: Informations générales -->
    <div class="modal-overlay" id="modalInfo" style="display: none;">
        <div class="popup-container" id="popupContainerInfo">
            <div class="popup-header">
                <h2>Modifier Détails du laboratoire</h2>
                <button class="btn-enregistrer" id="btnSaveInfo">Enregistrer</button>
            </div>
            <form class="popup-form" id="laboInfoForm" enctype="multipart/form-data">
                <div class="logo-upload-section">
                    <label class="logo-placeholder" for="logoUpload">
                        <i class="fa fa-camera"></i>
                        <input type="file" id="logoUpload" hidden accept="image/*">
                    </label>
                    <div class="logo-inputs">
                        <div class="form-group">
                            <label for="laboNom">Nom</label>
                            <input type="text" id="laboNom">
                        </div>

                        <?php
                        // PHP logic to control visibility based on user role
                        $current_user = wp_get_current_user();
                        $roles = (array) $current_user->roles;
                        $role = $roles[0] ?? null;

                        if ($role === 'um_service-utm'):
                            ?>
                            <div class="form-group">
                                <label for="laboEtablissement">Etablissement</label>
                                <input type="text" id="laboEtablissement" disabled>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <?php if ($role === 'um_service-utm'): ?>
                    <div class="form-group">
                        <label for="laboDirecteur">Directeur Du Laboratoire</label>
                        <select id="laboDirecteur">
                            <option>Sélection..</option>
                            <option value="1">Mr. Ahmed Ben Ahmed</option>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="laboDateCreation">Date De Création</label>
                    <input type="date" id="laboDateCreation">
                </div>
                <div class="form-group">
                    <label for="laboEtat">Etat</label>
                    <select id="laboEtat">
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                    </select>
                </div>
                <hr class="form-divider">
                <h3>Objectifs Et Thématiques</h3>
                <div class="form-group">
                    <label for="laboObjectifGeneral">Objectif Général</label>
                    <textarea id="laboObjectifGeneral" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="laboAxesRecherche">Axes De Recherche</label>
                    <textarea id="laboAxesRecherche" rows="4"></textarea>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 2: Projets -->
    <div class="modal-overlay" id="modalObjectives" style="display: none;">
        <div class="popup-container" id="popupContainerObjectives">
            <div class="popup-header">
                <h2>Ajouter un projet</h2>
                <button class="btn-enregistrer" id="btnSaveObjectives">Enregistrer</button>
            </div>
            <form class="popup-form">
                <h3>Projets Associés</h3>
                <ul class="associated-projects-list">
                    <li>Système coopératif autonome pour le trafic</li>
                    <li>Agents intelligents pour l’énergie distribuée</li>
                    <li>LSAMA-SAT : satellite autonome éducatif</li>
                </ul>

                <h3>Ajouter Autres Projets</h3>
                <div class="form-group">
                    <label for="projectSelect">Liste Des Projets</label>
                    <select id="projectSelect">
                        <option>Sélection..</option>
                        <option value="Projet Alpha">Projet Alpha</option>
                        <option value="Projet Beta">Projet Beta</option>
                        <option value="Projet Gamma">Projet Gamma</option>
                    </select>
                </div>
                <div id="addedProjectsList">
                    <!-- Dynamically added projects will appear here -->
                </div>
            </form>
        </div>
    </div>


    <script>
        // In a real WordPress environment, API settings are usually available globally.
        // For this example, we'll define a placeholder.
        const wpApiSettings = {
            root: '/wp-json/',
            nonce: '<?php echo wp_create_nonce("wp_rest"); ?>' // Example of how to generate nonce
        };

        document.addEventListener("DOMContentLoaded", function () {
            // --- MODAL 1: Informations générales ---

            const modifyInfoButton = document.getElementById("modifyInfoBtn");
            const modalInfo = document.getElementById("modalInfo");
            const popupContainerInfo = document.getElementById("popupContainerInfo");

            if (modifyInfoButton) {
                modifyInfoButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (modalInfo) modalInfo.style.display = "flex";
                });
            }

            if (modalInfo && popupContainerInfo) {
                modalInfo.addEventListener("click", function (e) {
                    if (!popupContainerInfo.contains(e.target)) {
                        modalInfo.style.display = "none";
                    }
                });
            }

            // --- MODAL 2: Objectifs et thématiques ---

            const modifyObjectivesButton = document.getElementById("modifyObjectivesBtn");
            const modalObjectives = document.getElementById("modalObjectives");
            const popupContainerObjectives = document.getElementById("popupContainerObjectives");

            if (modifyObjectivesButton) {
                modifyObjectivesButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (modalObjectives) modalObjectives.style.display = "flex";
                });
            }

            if (modalObjectives && popupContainerObjectives) {
                modalObjectives.addEventListener("click", function (e) {
                    if (!popupContainerObjectives.contains(e.target)) {
                        modalObjectives.style.display = "none";
                    }
                });
            }

            // Logic for the new projects modal
            const projectSelect = document.getElementById('projectSelect');
            const addedProjectsList = document.getElementById('addedProjectsList');

            if (projectSelect && addedProjectsList) {
                projectSelect.addEventListener('change', function () {
                    if (this.value && this.value !== "Sélection..") {
                        const projectName = this.value;
                        if (document.querySelector(`[data-project-name="${projectName}"]`)) {
                            this.value = "Sélection..";
                            return;
                        }
                        const projectItem = document.createElement('div');
                        projectItem.className = 'added-project-item';
                        projectItem.setAttribute('data-project-name', projectName);
                        const nameSpan = document.createElement('span');
                        nameSpan.textContent = projectName;
                        const deleteBtn = document.createElement('button');
                        deleteBtn.innerHTML = '<i class="fa fa-trash"></i>';
                        deleteBtn.onclick = function () {
                            projectItem.remove();
                        };
                        projectItem.appendChild(nameSpan);
                        projectItem.appendChild(deleteBtn);
                        addedProjectsList.appendChild(projectItem);
                        this.value = "Sélection..";
                    }
                });
            }

            // --- LOGIC FOR SAVING LABORATORY INFO ---
            const btnSaveInfo = document.getElementById('btnSaveInfo');
            if (btnSaveInfo) {
                btnSaveInfo.addEventListener('click', handleSaveLaboInfo);
            }
        });

        /**
         * Uploads a file to the WordPress media library.
         * @param {File} file The file to upload.
         * @returns {Promise<object>} A promise that resolves with the media object from the API.
         */
        async function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file, file.name);

            const response = await fetch(`${wpApiSettings.root}wp/v2/media`, {
                method: 'POST',
                headers: {
                    'X-WP-Nonce': wpApiSettings.nonce
                },
                body: formData
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'File upload failed');
            }
            return response.json();
        }

        /**
         * Handles the click event on the "Enregistrer" button for the laboratory info modal.
         * Gathers form data, handles file upload, and sends it to the custom REST API endpoint.
         * @param {Event} event The click event.
         */
        async function handleSaveLaboInfo(event) {
            event.preventDefault();
            const saveButton = event.target;
            saveButton.textContent = 'Enregistrement...';
            saveButton.disabled = true;

            const logoUploadInput = document.getElementById('logoUpload');
            let logoUrl = null; // Use null when no file is uploaded

            // 1. Handle file upload ONLY IF a file is selected
            if (logoUploadInput.files.length > 0) {
                try {
                    const uploadedMedia = await uploadFile(logoUploadInput.files[0]);
                    logoUrl = uploadedMedia.source_url;
                } catch (error) {
                    console.error('File upload failed:', error);
                    alert(`Erreur de téléversement du logo: ${error.message}`);
                    saveButton.textContent = 'Enregistrer';
                    saveButton.disabled = false;
                    return;
                }
            }

            // 2. Format date from YYYY-MM-DD to a compatible format
            const dateValue = document.getElementById('laboDateCreation').value;

            // 3. Construct the data payload
            const laboData = {
                nom: document.getElementById('laboNom').value,
                logo_laboratoire: logoUrl, // This will be null if no file was chosen
                date_de_creation: dateValue, // Send in YYYY-MM-DD format
                etat: document.getElementById('laboEtat').value,
                objectif_general: document.getElementById('laboObjectifGeneral').value,
                axes_de_recherche: document.getElementById('laboAxesRecherche').value
            };

            // 4. Send the data to the custom REST API endpoint
            try {
                // const apiUrl =
                //   `${wpApiSettings.root}plateforme-directeur-de-labo/v2/laboratoires`; // Corrected to plural "laboratoires"
                const apiUrl = `${wpApiSettings.root}plateforme-labo/v1/laboratoires`;
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': wpApiSettings.nonce
                    },
                    body: JSON.stringify(laboData)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Une erreur est survenue lors de l\'enregistrement.');
                }

                const result = await response.json();
                console.log('Laboratoire créé avec succès:', result);
                alert('Les détails du laboratoire ont été enregistrés avec succès!');
                document.getElementById('modalInfo').style.display = 'none';
                location.reload();

            } catch (error) {
                console.error('Échec de l\'enregistrement des détails du laboratoire:', error);
                alert(`Erreur: ${error.message}`);
            } finally {
                saveButton.textContent = 'Enregistrer';
                saveButton.disabled = false;
            }
        }
    </script>
</body>

</html>