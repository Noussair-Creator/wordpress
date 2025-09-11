<style>
    /* All the CSS you provided is included here, with shadow modifications */
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        /* padding: 20px; */
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
        /* MODIFIED: Lighter shadow */
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        position: relative;
        /* Needed for positioning the actions button */
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
        /* MODIFIED: Lighter shadow */
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        color: #2A2916;
    }

    .card-header-actions {
        position: absolute;
        top: 20px;
        right: 25px;
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
        margin-top: 20px;
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
        /* text-decoration: none; */
        color: #000000ff;
        font-weight: 300;
        text-align: left;
    }

    .parcours-table a:hover {
        text-decoration: underline;
    }

    #candidaturesTable,
    #participationTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
    }

    #candidaturesTable th,
    #participationTable th {
        border: 0px solid #EBE9D7;
        font-size: 14px;
    }

    #candidaturesTable th:nth-child(2) {
        text-align: left;
    }

    #candidaturesTable td:nth-child(2) {
        text-align: left;
    }

    #candidaturesTable td,
    #participationTable td {
        border: 1px solid #EBE9D7;
        font-size: 14px;
    }

    #candidaturesTable thead,
    #participationTable thead {
        border: none !important;
        position: static;
        transform: translateY(-15px);
    }

    #candidaturesTable tbody tr:first-child td,
    #participationTable tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important;
    }

    #candidaturesTable tbody tr:last-child td:first-child,
    #participationTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable tbody tr:last-child td:last-child,
    #participationTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:first-child,
    #participationTable tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    #candidaturesTable tbody tr:first-child td:last-child,
    #participationTable tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    #candidaturesTable,
    #participationTable {
        overflow: visible;
    }

    .status-bar-container {
        background-color: #fff;
        border-radius: 8px;
        padding: 16px 24px;
        margin-bottom: 24px;
        font-family: 'Poppins', sans-serif;
        /* MODIFIED: Lighter shadow */
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.07);
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

    .card.full-width {
        border: 0px;
        margin-bottom: 20px;
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

    .styled-list strong {
        font-weight: 600;
        color: #6E6D55;
        min-width: 240px;
        display: inline-block;
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

    .parcours-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-ordered-list {
        list-style: none;
        padding-left: 0;
        counter-reset: item-counter;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .custom-ordered-list li {
        counter-increment: item-counter;
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .custom-ordered-list li::before {
        content: counter(item-counter) ".";
        font-weight: bold;
        color: #c60000;
        margin-right: 10px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-top: 25px;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eee;
    }

    .add-doc-button {
        background-color: #fff;
        color: #c60000;
        border: 1px solid #c60000;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .add-doc-button:hover {
        background-color: #c60000;
        color: #fff;
    }

    #info-container,
    #docs-container,
    #participation-container {
        border-radius: 8px;
        margin-bottom: 20px;
        /* MODIFIED: Lighter shadow */
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        margin: -19px -15px 14px -15px;
        border-bottom: 1px solid #eee;
        /* MODIFIED: Lighter shadow */
        box-shadow: 0px 3px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header h3 {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
    }

    .search-bar {
        position: relative;
        margin-bottom: 20px;
    }

    .search-bar input {
        padding: 8px 10px 8px 10px;
        border-radius: 5px;
        border: 1px solid #EBE9D7;
    }

    .search-bar .fa-search {
        position: absolute;
        top: 50%;
        left: 180px;
        transform: translateY(-50%);
        color: #aaa;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #BE0000 !important;
        border: 2px solid #BE0000;
        background: transparent;
        box-shadow: none;
        border-radius: 8px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #333 !important;
        border: none !important;
        background-color: transparent !important;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .dataTables_paginate {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .dataTables_paginate .paginate_button {
        border: 1px solid #c60000;
        background-color: #fff;
        color: #c60000 !important;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button:hover {
        background-color: #c60000;
        color: #fff !important;
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* New Modal Styles from user's provided code */

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

    .modal-overlay label {
        min-width: 100px;
        font-weight: 600;
        color: #6E6D55;
        flex-shrink: 0;
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
        padding-bottom: 10px;
        margin-bottom: 20px;
        padding-left: 25px;
        padding-right: 25px;
        padding-top: 20px;
        box-shadow: 1px 1px 5px 0px #0000002d;
    }

    .popup-header h2 {
        font-size: 16px;
        margin: 0;
        color: #2A2916;
    }

    .popup-header-buttons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-enregistrer {
        background-color: #BF0404;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-enregistrer:hover {
        background-color: #BF0404 !important;
        border-color: #BF0404 !important;
        color: white !important;
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

    /* form.popup-form {
        padding: 20px 25px;
        overflow-y: auto;
        flex-grow: 1;
    }

    .popup-form .form-group-flex {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .popup-form .form-group-row {
        display: flex;
        gap: 15px;
    }

    .popup-form .form-group-flex label {
        display: block;
        font-weight: 600;
        font-size: 14px;
        border-radius: 0px 7px 7px 0;
        color: #6E6D55;
    }

    .popup-form .form-group input,
    .popup-form .form-group select,
    .popup-form .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #b5af8e !important;
        font-size: 14px;
        box-sizing: border-box;
        border-radius: 7px;
    }

    .popup-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

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
        background-color: #fff;
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

    .popup-form input,
    .popup-form select,
    .popup-form textarea {
        border: 1px solid #b5af8e !important;
    } */
    .popup-form .btn-importer {
        background-color: #DBD9C3;
        color: #ffffffff !important;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        border-left: 1px solid #b5af8e;
        white-space: nowrap;
        border-radius: 0 7px 7px 0;
    }

    .popup-form .btn-importer i {
        font-size: 14px;
    }

    .popup-form .input-file-text {
        flex-grow: 1;
        border: none;
        padding: 10px 12px;
        background-color: transparent;
        color: #888;
        border-radius: 7px 0 0 7px !important;
    }

    .popup-form .input-file-text:focus {
        outline: none;
    }

    .popup-form .input-file-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        background-color: white;
        overflow: hidden;
        padding: 0;
    }

    .form-group-flex {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .form-group-row {
        display: flex;
        gap: 15px;
    }

    .popup-form {
        padding-left: 25px;
        padding-right: 25px;
    }

    .popup-form input,
    .popup-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
    }

    .popup-form textarea {
        width: 100%;
        border: 1px solid #b5af8e;
        border-radius: 6px;
        padding: 12px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .date-input-container,
    .time-input-container {
        position: relative;
        width: 100%;
    }

    .date-input-container input,
    .time-input-container input {
        padding-right: 2.5rem;
    }

    .date-input-container .date-icon,
    .time-input-container .time-icon {
        position: absolute;
        right: 1rem;
        top: 68%;
        transform: translateY(-50%);
        color: #8c8c8c;
    }
</style>

<div class="container-fluid">
    <div class="content-wrapper">

        <!-- Container 1: General Information and Description -->
        <div id="info-container">
            <div class="card full-width">
                <h3>Informations générales</h3>
                <div class="card-header-actions">
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" id="openModalModifier">Modifier</a></li>
                            <li><a class="dropdown-item" href="#">Publié</a></li>
                            <li><a class="dropdown-item" href="#">Supprimer</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="styled-list">
                    <li><strong>Titre de l'activité :</strong> Interface cerveau-machine et apprentissage</li>
                    <li><strong>Type :</strong> Article</li>
                    <li><strong>Année :</strong> 2024</li>
                    <li><strong>Auteur principal :</strong> Dr. Sarra Messaoudi</li>
                    <li><strong>Statut :</strong> Publié</li>

                </ul>

                <h4 class="section-title">Description / Contenu</h4>
                <ol class="custom-ordered-list">
                    <li>Analyser les signaux EEG en utilisant le Deep Learning pour détecter des anomalies.</li>
                    <li>Pré-traitement des signaux, modélisation CNN, validation croisée.</li>
                    <li>Identification précise de patterns EEG associés à certaines conditions.</li>
                </ol>
            </div>
        </div>

        <!-- Container 2: Attached Documents -->
        <div id="docs-container">
            <div class="card full-width">
                <div class="card-header">
                    <h3>Pièces jointes / Documents</h3>
                    <button class="add-doc-button">Ajouter un document</button>
                </div>
                <table class="parcours-table" id="candidaturesTable">
                    <thead>
                        <tr>
                            <th>Ref_Doc</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>
                                <a href="#">
                                    <img width="20px" class="pdf-icon"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="pdf icon">
                                    article_act_sc.pdf
                                </a>
                            </td>
                            <td>01/02/2024</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>
                                <a href="#">
                                    <img width="20px" class="pdf-icon"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="pdf icon">
                                    Code_source_modèle
                                </a>
                            </td>
                            <td>20/01/2025</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>
                                <a href="#">
                                    <img width="20px" class="pdf-icon"
                                        src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                        alt="pdf icon">
                                    Présentation_slides
                                </a>
                            </td>
                            <td>15/12/2024</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Télécharger</a></li>
                                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Container 3: Participation Requests -->
        <div id="participation-container">
            <div class="card full-width">
                <div class="card-header">
                    <h3>Demandes de participation</h3>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Recherche" id="customSearchInput">
                    <i class="fas fa-search"></i>
                </div>
                <table id="participationTable" class="parcours-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Nom et prenom</th>
                            <th>Domaine</th>
                            <th>Contact principal</th>
                            <th>Telephone</th>
                            <th>E-mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                    alt="User Avatar" class="user-avatar"> Mr. Karim J.</td>
                            <td>IA Industrielle</td>
                            <td>+216 25 37 45 90</td>
                            <td>contact@ai-tech.com</td>
                            <td>contact@tech.com</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">accepter</a></li>
                                        <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td><img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 434.png"
                                    alt="User Avatar" class="user-avatar"> Mr. Mourad J.</td>
                            <td>IA Industrielle</td>
                            <td>+216 25 37 45 90</td>
                            <td>contact@ai-tech.com</td>
                            <td>contact@tech.com</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">accepter</a></li>
                                        <li><a style="color: red;" class="dropdown-item" href="#">refuser</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Ajouter Document Modal -->
<div class="modal-overlay" id="modalAjouterDoc" style="display: none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Ajouter un document</h2>
            <button class="btn-enregistrer">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label for="docFile">Fichier</label>
                <div class="input-file-wrapper">
                    <input type="text" id="docFileText" class="input-file-text" placeholder="Aucun fichier choisi"
                        readonly>
                    <label for="docFileUpload" class="btn-importer">
                        <img width="20px" style="margin-right: 10px;"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                            alt="Icon-uploadwhite.png">
                        Importer
                    </label>
                    <input type="file" id="docFileUpload" style="display:none;">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Editing an Activity -->
<div class="modal-overlay" id="editActivityModal" style="display: none;">
    <div class="popup-container" id="popupContainerEditActivity">
        <div class="popup-header">
            <h2>Modifier une activité</h2>
            <div class="popup-header-buttons">
                <button class="btn-enregistrer" id="btnSaveEditActivity">Enregistrer</button>
            </div>
        </div>
        <form class="popup-form">
            <!-- Hidden input for event ID -->
            <input type="hidden" id="edit-activity-id">
            <!-- Type -->
            <div class="form-group-flex">
                <label for="edit-activity-type">Type</label>
                <select id="edit-activity-type">
                    <option selected>Sélection...</option>
                    <option value="Colloque">Colloques</option>
                    <option value="Conférence">Conférences</option>
                    <option value="Séminaire">Séminaires</option>
                    <option value="journee-etude">Journées d'étude</option>
                </select>
            </div>
            <!-- Titre -->
            <div class="form-group-flex">
                <label for="edit-activity-title">Titre</label>
                <input type="text" id="edit-activity-title">
            </div>
            <!-- Date and Time (now separate fields) -->
            <div class="form-group-row">
                <div class="form-group-flex date-input-container">
                    <label for="edit-activity-date">Date</label>
                    <input type="text" id="edit-activity-date" placeholder="jj/mm/aaaa">
                    <i class="fa-solid fa-calendar-days date-icon"></i>
                </div>
                <div class="form-group-flex time-input-container">
                    <label for="edit-activity-time">Heure</label>
                    <input type="text" id="edit-activity-time" placeholder="--:--">
                    <i class="fa-regular fa-clock time-icon"></i>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group-flex">
                <label for="edit-activity-description">Description</label>
                <textarea id="edit-activity-description" rows="4"></textarea>
            </div>
            <!-- File Upload -->
            <div class="form-group-flex">
                <label for="edit-activity-file">Pièces jointe (facultatif)</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" id="edit-file-name" readonly
                        placeholder="Aucun fichier sélectionné">
                    <label for="edit-activity-file" class="btn-importer">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                            alt="Icon-uploadwhite">
                        Importer
                    </label>
                    <input type="file" id="edit-activity-file" style="display: none;">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    xintegrity="sha384-I7E8VpC8J1eL1eG5e5qF8e4a9e5F5q1q5A5g5e5e5d5q5w5/5a5/5a5f5f5f5g5/5f5g5d5b5b5c5h"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    xintegrity="sha384-0mJv4C8B5G5f5q1b5g5d5f5a5c5/5b5/5a5f5f5f5g5/5f5g5d5b5b5c5h" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

<script>
    $(document).ready(function () {
        // Initialize the DataTable for the participation table
        const table = $('#participationTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: '<"top">rt<"bottom"ip><"clear">',
            language: {
                paginate: {
                    previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
                    next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            },
            initComplete: function () {
                $('.dataTables_filter').hide();
            }
        });

        // Custom search functionality
        $('#customSearchInput').on('keyup', function () {
            table.search(this.value).draw();
        });

        // "Check all" functionality for the participation table
        $('#checkAll').on('click', function () {
            const rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });


        // --- Ajouter Document Modal functionality ---
        const modalAjouterDoc = $('#modalAjouterDoc');

        // Open modal
        $('.add-doc-button').on('click', function (e) {
            e.preventDefault();
            modalAjouterDoc.css('display', 'flex');
        });

        // Close modal via save button or clicking outside
        $('#modalAjouterDoc .btn-enregistrer, #modalAjouterDoc').on('click', function (e) {
            if (e.target === this || $(e.target).hasClass('btn-enregistrer')) {
                modalAjouterDoc.css('display', 'none');
            }
        });

        // Handle file input display name
        $('#docFileUpload').on('change', function () {
            const fileName = $(this).val().split('\\').pop();
            $('#docFileText').val(fileName || 'Aucun fichier choisi');
        });


        // --- New Edit Modal functionality (based on the second code) ---
        const editActivityModal = $('#editActivityModal');
        const popupContainerEdit = $('#popupContainerEditActivity');

        // Initialize Flatpickr instances for date and time inputs
        const datePicker = flatpickr("#edit-activity-date", {
            dateFormat: "Y-m-d",
            locale: "fr",
            minDate: "today",
            appendTo: popupContainerEdit[0]
        });

        const timePicker = flatpickr("#edit-activity-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: "fr",
            appendTo: popupContainerEdit[0],
            onOpen: function (selectedDates, dateStr, instance) {
                instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
            }
        });

        // Open the edit modal and populate fields
        $('#openModalModifier').on('click', function (e) {
            e.preventDefault();

            // Get data from the main info list to populate the modal fields
            const title = $('ul.styled-list li:nth-child(1)').text().replace("Titre de l'activité :",
                '').trim();
            const type = $('ul.styled-list li:nth-child(2)').text().replace("Type :", '').trim();
            const year = $('ul.styled-list li:nth-child(3)').text().replace("Année :", '').trim();
            const description = $('ol.custom-ordered-list').text().trim();

            $('#edit-activity-title').val(title);
            $('#edit-activity-type').val(type);
            $('#edit-activity-description').val(description);

            // Note: The original data has a "Year", not a full date. 
            // We'll set the date picker with a dummy date based on the year to demonstrate functionality.
            // You can modify this to fit your specific data structure.
            datePicker.setDate(`${year}-01-01`);

            editActivityModal.css('display', 'flex');
        });

        // Close modal via save button or clicking outside
        editActivityModal.on('click', function (e) {
            if ($(e.target).closest(popupContainerEdit).length === 0) {
                editActivityModal.css('display', 'none');
            }
        });

        // Handle file name display for edit modal
        $('#edit-activity-file').on('change', function () {
            const fileName = $(this).val().split('\\').pop();
            $('#edit-file-name').val(fileName || 'Aucun fichier sélectionné');
        });

        // Handle save button for the "Modifier" modal
        $('#btnSaveEditActivity').on('click', function (e) {
            e.preventDefault();
            const type = $('#edit-activity-type').val();
            const title = $('#').val();
            const date = $('#edit-activity-date').val();
            const time = $('#edit-activity-time').val();
            const description = $('#').val();
            const fileName = $('#edit-file-name').val();

            console.log('Saved data from Modifier Modal:');
            console.log('Type:', type);
            console.log('Title:', title);
            console.log('Date:', date);
            console.log('Time:', time);
            console.log('Description:', description);
            console.log('File:', fileName);

            editActivityModal.css('display', 'none');
        });

    });
</script>