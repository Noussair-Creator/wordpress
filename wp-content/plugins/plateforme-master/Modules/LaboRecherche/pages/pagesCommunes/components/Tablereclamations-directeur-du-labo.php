<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des réponses</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS for pagination -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
    /* ============== Styles SCOPÉS ============== */
    #demandes-service {
        background: #FFFFFF;
        box-shadow: 0 3px 22px #0000000F;
        border-radius: 8px;
        border: 1px solid #e8e6db;
        padding: 12px 14px 14px;
        color: #2A2916;
        font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
        margin: 20px auto;
        position: relative;
        z-index: 1;
    }

    /* Titre + icône */
    #demandes-service .section-title {
        display: flex;
        align-items: center;
        gap: 20px;
        font-weight: 700;
        font-size: 20px;
        line-height: 26px;
        margin: 6px 0 8px;
    }

    /* #demandes-service .title-icon {
        width: 32px;
        height: 34px;
        flex: 0 0 32px;
        background: #f0f0f0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    } */

    #demandes-service .section-separator {
        border: 0;
        border-top: 1px solid #ECEBE3;
        margin: 8px 0 10px
    }

    /* Toolbar */
    #demandes-service .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px
    }

    .search {
        width: 255px;
        height: 35px;
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid #DBD9C3;
        border-radius: 6px;
        padding: 0 10px
    }

    .search input {
        flex: 1;
        border: 0;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #2A2916
    }

    .search i {
        color: #888;
        font-size: 16px;
    }

    .btn-download {
        margin-left: auto;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        border: 0;
        cursor: pointer;
        background: #fff;
        box-shadow: 0 0 6px #00000030;
        display: grid;
        place-items: center;
        color: #c40000;
        font-size: 18px;
    }

    /* ====== TABLE STYLES ====== */
    /* Container for the table, with border and radius */
    #demandes-service .table-container {
        /* border: 2px solid #EBE9D7; */
        border-radius: 8px;
        margin-top: 20px;
        /* overflow: hidden; */
        position: relative;
        z-index: 5;
    }

    #demandes-service .tbl {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* Styling for the table header */
    #demandes-service .tbl thead th {
        background: #ECEBE3;
        text-align: left;
        font-weight: 700;
        font-size: 15px;
        line-height: 20px;
        color: #2A2916;
        padding: 12px;
        border-bottom: 1px solid #A6A4853D;
        white-space: nowrap;
    }

    #demandes-service .tbl thead th:first-child {
        width: 32px;
        text-align: center;
        padding-left: 6px;
    }

    #demandes-service .tbl thead th:nth-child(2) {
        width: 140px;
    }

    #demandes-service .tbl thead th:nth-child(3) {
        width: 230px;
    }

    #demandes-service .tbl thead th:nth-child(4) {
        width: auto;
    }

    #demandes-service .tbl thead th:nth-child(5) {
        width: 120px;
        text-align: center;
    }

    #demandes-service .tbl thead th:nth-child(6) {
        width: 120px;
        text-align: center;
    }

    #demandes-service .tbl thead th:nth-child(7) {
        width: 90px;
        text-align: center;
    }

    /* Styling for the table body cells */
    #demandes-service .tbl tbody td {
        background: #fff;
        padding: 14px 12px;
        border-bottom: 1px solid #EBE9D7;
        vertical-align: middle;
        font-size: 14px;
        line-height: 17px;
        color: #2A2916;
        position: static;
        /* Important fix for z-index */
    }

    #demandes-service .tbl tbody tr:last-child td {
        border-bottom: none
    }

    #demandes-service .tbl td:first-child {
        width: 32px;
        text-align: center;
        padding-left: 6px;
        padding-right: 6px
    }

    #demandes-service .tbl td.sep-after {
        border-right: 1px solid #EBE9D7
    }

    #demandes-service .tbl td:nth-child(5),
    #demandes-service .tbl td:nth-child(6),
    #demandes-service .tbl td:nth-child(7) {
        text-align: center
    }

    #demandes-service .tbl td:nth-child(6),
    #demandes-service .tbl td:nth-child(7) {
        border-left: 1px solid #EBE9D7
    }

    .chk {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: #6b6c4a
    }

    /* Badges statut */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 10px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid transparent;
        background: #fff
    }

    .badge .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%
    }

    .badge.is-pending {
        color: #9C7B00;
        border-color: #F3D27A;
        background: #FFF8E1
    }

    .badge.is-pending .dot {
        background: #F4C63D
    }

    .badge.is-success {
        color: #0E7A46;
        border-color: #BFE6CF;
        background: #E9F7F0
    }

    .badge.is-success .dot {
        background: #13A463
    }

    .badge.is-danger {
        color: #B10F0F;
        border-color: #F3B8B8;
        background: #FDEDED
    }

    .badge.is-danger .dot {
        background: #D73737
    }

    /* Kebab + menu - FIXED Z-INDEX ISSUE */
    .kebab-container {
        position: relative;
        display: inline-block;
    }

    .kebab {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: 1px solid transparent;
        background: #fff;
        cursor: pointer;
        font-size: 24px;
        font-weight: bolder;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kebab:hover {
        background: #F2F1EA
    }

    .dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        background: #fff;
        border: 1px solid #E6E3D3;
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .15);
        min-width: 180px;
        padding: 6px;
        display: none;
        z-index: 1000;
        /* Higher z-index to appear above table */
        margin-top: 5px;
    }

    .dropdown a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 6px;
        text-decoration: none;
        color: #2A2916;
        font-size: 14px
    }

    .dropdown a:hover {
        background: #F3F2EA
    }

    #demandes-service .rel {
        position: relative
    }

    /* ====== PAGINATION (DATATABLES) ====== */
    .datatable-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px 0;
        position: relative;
        z-index: 1;
    }

    .dataTables_paginate .paginate_button {
        min-width: 36px;
        height: 36px;
        padding: 0 6px;
        font-size: 18px;
        border: 2px solid #c40000;
        color: #c40000 !important;
        background: #fff;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 800;
        margin: 0 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .dataTables_paginate .paginate_button:hover {
        background: #fdf2f2;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button.current:hover {
        background: #c40000;
        color: #fff !important;
        border-color: #c40000;
    }

    .dataTables_empty {
        padding: 20px;
        text-align: center;
    }

    .paginate_page_indicator {
        padding: 0 15px;
        font-size: 18px;
        font-weight: 800;
        color: #000;
        vertical-align: middle;
    }

    /* ====== OFFCANVAS ====== */
    #demandes-service .sidebar-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        opacity: 0;
        pointer-events: none;
        transition: opacity .2s;
        z-index: 10040;
    }

    #demandes-service .sidebar {
        position: fixed;
        top: 0;
        right: -450px;
        width: 450px;
        height: 100vh;
        max-width: 90vw;
        background: #FFFFFF;
        border-left: 1px solid #E7E4D7;
        box-shadow: -7px 0 36px #00000029;
        z-index: 10050;
        display: flex;
        flex-direction: column;
        padding: 0;
        transition: right 0.3s ease-in-out;
    }

    #demandes-service .sidebar.is-open {
        right: 0
    }

    #demandes-service .sidebar-backdrop.is-open {
        opacity: 1;
        pointer-events: auto
    }

    body.no-scroll {
        overflow: hidden
    }

    #demandes-service .sb-head {
        position: sticky;
        top: 0;
        height: 60px;
        margin: 0;
        padding: 12px 16px 12px 23px;
        background: #FFFFFF;
        border-radius: 0;
        box-shadow: 0 5px 16px #00000029, 0 -5px 16px #00000029;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1;
    }

    #demandes-service .sb-title {
        margin: 0;
        font: normal normal bold 18px/24px Roboto;
        letter-spacing: 0;
        color: #2A2916
    }

    #demandes-service .sb-close {
        width: 32px;
        height: 32px;
        border: 1px solid #BF0404;
        border-radius: 6px;
        background: #BF0404;
        color: #fff;
        display: grid;
        place-items: center;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0 3px 6px rgba(0, 0, 0, .16);
    }

    #demandes-service .sb-body {
        flex: 1;
        overflow: auto;
        padding: 16px 20px 18px
    }

    .sec-title {
        font: 700 14px/18px Roboto;
        margin: 10px 0 8px;
        color: #2A2916
    }

    .roc-hr {
        border: 0;
        border-top: 1px solid #ECEBE3;
        margin: 12px 0
    }

    .dl {
        display: grid;
        grid-template-columns: 150px 1fr;
        column-gap: 10px;
        row-gap: 8px;
        font: 400 14px/18px Roboto;
        color: #2A2916
    }

    .dl dt {
        font-weight: 700
    }

    .dl dd {
        margin: 0
    }

    .answer {
        font: 400 14px/20px Roboto;
        color: #2A2916;
        white-space: pre-line
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

    #suivi-rec .sr-page-btn {
        border: 1px solid #BF0404;
        background: #BF0404;
        color: var(--ink);
        border-radius: 4px;
        min-width: 33px;
        height: 33px;
        cursor: pointer;
        font-weight: 500;
        font-size: 14px/1;
        padding: 0 4px;
        transition: all 0.2s;
    }

    #suivi-rec .sr-page-btn.active {
        /* background: white !important;
        color: black;
        border-color: #BF0404; */
        font-weight: 700;
        cursor: default;
    }

    #suivi-rec .sr-btn:disabled {
        cursor: not-allowed;
        opacity: 0.5;
        border-color: #BF0404;
        color: #ccc;
    }
    </style>
</head>

<body>

    <section class="card" id="demandes-service">
        <div class="section-title">
            <span class="title-icon">
                <img width="50px" src="/wp-content/plugins/plateforme-master/images/icons/entrevue.png" alt="entrevue">
            </span>
            Suivi des réponses
        </div>
        <hr class="section-separator">

        <div class="toolbar">
            <div class="search">
                <input type="text" id="searchInput" placeholder="Recherche…" autocomplete="off">
                <i class="fas fa-search"></i>
            </div>
            <button class="btn-download" title="Télécharger">
                <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                    alt="upload-red.png">
            </button>
        </div>

        <!-- BODY -->
        <div class="table-container">
            <table class="tbl" id="candidaturesTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="chk" id="checkAll"></th>
                        <th>Référence</th>
                        <th>Type</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ligne 1 -->
                    <tr class="rel" data-ref="Rec-2025-001" data-student="Rim Ben Aissa" data-type="Note"
                        data-subject="Note s1" data-sent="12-02-2025" data-status="En cours" data-attachments="–"
                        data-reply="Après révision de la copie par le responsable du module, nous confirmons que la note attribuée est correcte. Toutefois, vous avez droit à une consultation de copie le 8 mai 2025 entre 10h et 12h."
                        data-replydate="23-02-2025" data-responder="Mme. Selma Kefi">
                        <td class="sep-after"><input type="checkbox" class="chk"></td>
                        <td class="sep-after">#REC-2024-034</td>
                        <td class="sep-after">Réclamations Pédagogiques</td>
                        <td>Réclamation sur le contenu du cours</td>
                        <td>12/01/2025</td>
                        <td><span class="badge is-pending"><span class="dot"></span>En cours</span></td>
                        <td>
                            <div class="kebab-container">
                                <button class="kebab" data-menu="m1">⋯</button>
                                <div class="dropdown" id="m1">
                                    <a href="#" class="act-read"><i class="fas fa-eye"></i>Lire la réponse</a>
                                    <a href="#"><i class="fas fa-envelope"></i>E-mail</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Ligne 2 -->
                    <tr class="rel" data-ref="Rec-2025-001" data-student="Rim Ben Aissa" data-type="Note"
                        data-subject="Note s1" data-sent="12-02-2025" data-status="Acceptée" data-attachments="–"
                        data-reply="Après révision de la copie par le responsable du module, nous confirmons que la note attribuée est correcte. Toutefois, vous avez droit à une consultation de copie le 8 mai 2025 entre 10h et 12h."
                        data-replydate="23-02-2025" data-responder="Mme. Selma Kefi">
                        <td class="sep-after"><input type="checkbox" class="chk"></td>
                        <td class="sep-after">#REC-2024-034</td>
                        <td class="sep-after">Réclamations Pédagogiques</td>
                        <td>Erreur de note / demande de révision de note</td>
                        <td>12/01/2025</td>
                        <td><span class="badge is-success"><span class="dot"></span>Acceptée</span></td>
                        <td>
                            <div class="kebab-container">
                                <button class="kebab" data-menu="m2">⋯</button>
                                <div class="dropdown" id="m2">
                                    <a href="#" class="act-read"><i class="fas fa-eye"></i>Lire la réponse</a>
                                    <a href="#"><i class="fas fa-envelope"></i>E-mail</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Ligne 3 -->
                    <tr class="rel" data-ref="Rec-2025-002" data-student="Hatem Z." data-type="Administration"
                        data-subject="Problème de stage" data-sent="12-02-2025" data-status="Refusée"
                        data-attachments="–"
                        data-reply="Votre demande ne peut pas être acceptée au vu des délais administratifs passés."
                        data-replydate="22-02-2025" data-responder="Service scolarité">
                        <td class="sep-after"><input type="checkbox" class="chk"></td>
                        <td class="sep-after">#REC-2024-034</td>
                        <td class="sep-after">Réclamations Administratives</td>
                        <td>Problème De Stage</td>
                        <td>12/01/2025</td>
                        <td><span class="badge is-danger"><span class="dot"></span>Refusée</span></td>
                        <td>
                            <div class="kebab-container">
                                <button class="kebab" data-menu="m3">⋯</button>
                                <div class="dropdown" id="m3">
                                    <a href="#" class="act-read"><i class="fas fa-eye"></i>Lire la réponse</a>
                                    <a href="#"><i class="fas fa-envelope"></i>E-mail</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Ligne 4 -->
                    <tr class="rel" data-ref="Rec-2025-003" data-student="Nesrine T." data-type="Technique"
                        data-subject="Problème avec les supports en ligne" data-sent="12-02-2025" data-status="Acceptée"
                        data-attachments="–" data-reply="L’accès a été rétabli. Merci de réessayer."
                        data-replydate="20-02-2025" data-responder="Support IT">
                        <td class="sep-after"><input type="checkbox" class="chk"></td>
                        <td class="sep-after">#REC-2024-034</td>
                        <td class="sep-after">Réclamations techniques ou d’accès</td>
                        <td>Problème Avec Les Supports En Ligne</td>
                        <td>12/01/2025</td>
                        <td><span class="badge is-success"><span class="dot"></span>Acceptée</span></td>
                        <td>
                            <div class="kebab-container">
                                <button class="kebab" data-menu="m4">⋯</button>
                                <div class="dropdown" id="m4">
                                    <a href="#" class="act-read"><i class="fas fa-eye"></i>Lire la réponse</a>
                                    <a href="#"><i class="fas fa-envelope"></i>E-mail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- === Offcanvas LECTURE === -->
        <div class="sidebar-backdrop" id="sb-backdrop"></div>
        <aside class="sidebar" id="sb" aria-hidden="true">
            <div class="sb-head">
                <h3 class="sb-title" id="sbTitle">Reclamation #Rec-2025-001</h3>
                <button class="sb-close" id="sbClose" type="button">✕</button>
            </div>
            <div class="sb-body">
                <div class="sec-title">Details de la réclamation :</div>
                <dl class="dl">
                    <dt>Etudiant(e) :</dt>
                    <dd id="v-student">—</dd>
                    <dt>Type :</dt>
                    <dd id="v-type">—</dd>
                    <dt>Sujet :</dt>
                    <dd id="v-subject">—</dd>
                    <dt>Date d’envoi :</dt>
                    <dd id="v-sent">—</dd>
                    <dt>Statut :</dt>
                    <dd><span class="badge is-success" id="v-status"><span class="dot"></span>Acceptée</span></dd>
                    <dt>pièces jointes :</dt>
                    <dd id="v-attachments">—</dd>
                </dl>
                <hr class="roc-hr">
                <div class="sec-title">Réponse de l’administration :</div>
                <dl class="dl" style="grid-template-columns:150px 1fr">
                    <dt>Réponse :</dt>
                    <dd>
                        <div class="answer" id="v-reply">—</div>
                    </dd>
                    <dt>Date de la réponse :</dt>
                    <dd id="v-replyDate">—</dd>
                    <dt>Répondant(e) :</dt>
                    <dd id="v-responder">—</dd>
                </dl>
            </div>
        </aside>
    </section>

    <!-- jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        /* =================================================================
         * DataTable Initialization for Pagination and Search
         * ================================================================= */
        // CORRECTED: Initialize DataTable on the table itself (#candidaturesTable)
        const table = $('#candidaturesTable').DataTable({
            paging: true,
            pagingType: 'simple', // Shows Previous and Next buttons only
            searching: true, // This enables the API for searching
            ordering: false,
            info: false,
            pageLength: 3, // Display 3 rows per page to demonstrate pagination
            language: {
                paginate: {
                    previous: "<i class='fa fa-angle-left'></i>",
                    next: "<i class='fa fa-angle-right'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé",
            },
            // Custom layout: 't' for table, 'p' for pagination
            "dom": 't<"datatable-footer"p>'
        });

        // Move the generated pagination to be a direct child of the main card
        $('.datatable-footer').appendTo('#demandes-service');

        // --- START: PAGINATION NUMBER FIX ---
        function updatePageIndicator() {
            $('.paginate_page_indicator').remove();
            const pageInfo = table.page.info();
            const pageIndicatorHTML = `<span class="paginate_page_indicator">${pageInfo.page + 1}</span>`;
            $('.dataTables_paginate .paginate_button.previous').after(pageIndicatorHTML);
        }

        table.on('draw.dt', function() {
            updatePageIndicator();
        });
        updatePageIndicator();
        // --- END: PAGINATION NUMBER FIX ---

        // Link custom search input to DataTable's search functionality
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        /* =================================================================
         * Checkbox "Check All" Functionality
         * ================================================================= */
        function updateCheckAllState() {
            const allCheckboxes = table.rows({
                search: 'applied'
            }).nodes().to$().find('tbody input.chk');
            const checkedCheckboxes = allCheckboxes.filter(':checked').length;
            $('#checkAll').prop('checked', allCheckboxes.length > 0 && checkedCheckboxes === allCheckboxes
                .length);
        }

        $('#checkAll').on('click', function() {
            const isChecked = $(this).is(':checked');
            table.rows({
                search: 'applied'
            }).nodes().to$().find('input.chk').prop('checked', isChecked);
        });

        // CORRECTED: Use the correct table ID for event delegation
        $('#candidaturesTable tbody').on('change', 'input.chk', function() {
            updateCheckAllState();
        });

        table.on('draw.dt', function() {
            updateCheckAllState();
        });


        /* =================================================================
         * Menus ⋯ - Event Delegation
         * ================================================================= */
        // CORRECTED: Use the correct table ID for event delegation
        $('#candidaturesTable').on('click', '.kebab', function(e) {
            e.stopPropagation();
            $('.dropdown').not($(this).next('.dropdown')).hide();
            $(this).next('.dropdown').toggle();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.kebab, .dropdown').length) {
                $('.dropdown').hide();
            }
        });

        /* =================================================================
         * Offcanvas (Sidebar)
         * ================================================================= */
        const sb = document.getElementById('sb');
        const bd = document.getElementById('sb-backdrop');
        const title = document.getElementById('sbTitle');
        const btnClose = document.getElementById('sbClose');

        function setText(id, val) {
            const el = document.getElementById(id);
            if (el) el.textContent = val || '—';
        }

        function setBadge(label) {
            const b = document.getElementById('v-status');
            if (!b) return;
            const x = (label || '').toLowerCase();
            b.className = 'badge ' + (x.includes('accept') ? 'is-success' : x.includes('refus') ? 'is-danger' :
                'is-pending');
            b.innerHTML = `<span class="dot"></span>${label || '—'}`;
        }

        function openSBForRow(tr) {
            if (!tr) return;
            const data = tr.dataset;

            title.textContent = 'Reclamation #' + (data.ref || '');
            setText('v-student', data.student);
            setText('v-type', data.type);
            setText('v-subject', data.subject);
            setText('v-sent', data.sent);
            setText('v-attachments', data.attachments || '–');
            setText('v-reply', data.reply);
            setText('v-replyDate', data.replydate);
            setText('v-responder', data.responder);
            setBadge(data.status);

            sb.classList.add('is-open');
            bd.classList.add('is-open');
            sb.setAttribute('aria-hidden', 'false');
            document.body.classList.add('no-scroll');
        }

        function closeSB() {
            sb.classList.remove('is-open');
            bd.classList.remove('is-open');
            sb.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('no-scroll');
        }

        btnClose.addEventListener('click', closeSB);
        bd.addEventListener('click', closeSB);

        // CORRECTED: Use the correct table ID for event delegation
        $('#candidaturesTable').on('click', '.act-read', function(e) {
            e.preventDefault();
            const tr = $(this).closest('tr');
            $('.dropdown').hide();
            openSBForRow(tr[0]);
        });
    });
    </script>
</body>

</html>