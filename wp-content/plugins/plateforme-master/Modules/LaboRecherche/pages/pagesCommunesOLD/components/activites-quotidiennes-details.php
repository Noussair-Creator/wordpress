<style>
    /* All the CSS you provided is included here */
    body {
        background-color: #f8f9fa;
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
        box-shadow: 0px 5px 16px #00000012;
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
        font-weight: 500;
        text-align: left;
    }

    .parcours-table a:hover {
        text-decoration: underline;
    }

    #candidaturesTable {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important;
    }

    #candidaturesTable th {
        border: 0px solid #EBE9D7;
        font-weight: 500;
        font-size: 14px;
    }

    #candidaturesTable th:nth-child(2) {
        text-align: left;
    }

    #candidaturesTable td {
        border: 1px solid #EBE9D7;
        font-weight: 500;
        font-size: 14px;
    }

    #candidaturesTable td:nth-child(2) {
        text-align: left;
    }

    #candidaturesTable thead {
        border: none !important;
        position: static;
        transform: translateY(-15px);
    }

    #candidaturesTable tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important;
    }

    #candidaturesTable,
    #participationTable {
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    #candidaturesTable thead tr:first-child th:first-child,
    #participationTable thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    #candidaturesTable thead tr:first-child th:last-child,
    #participationTable thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
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
    #results-container,
    #participation-container {
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        margin: -19px -15px 14px -15px;
        border-bottom: 1px solid #eee;
        box-shadow: 0px 5px 16px #00000012;
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
        padding: 8px 30px 8px 10px;
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

    .btn-close-x {
        border: none;
        background: none;
        font-size: 24px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon select,
    .input-with-icon input {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .input-with-icon .icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .input-with-icon .right-icon {
        right: 10px;
    }

    .input-file-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 5px;
    }

    .input-file-text {
        flex-grow: 1;
        border: none !important;
    }

    .btn-importer {
        background-color: #A6A485;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Styles for the new form inside the modal */
    .popup-form .form-group {
        margin-bottom: 15px;
    }

    .popup-form .form-group label {
        display: block;
        font-weight: 600;
        /* color: #fff; */
        font-size: 14px;
        /* margin-bottom: 5px; */
    }

    .popup-form .form-group input,
    .popup-form .form-group select,
    .popup-form .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #b5af8e !important;
        /* border-radius: 7px; */
        font-size: 14px;
        box-sizing: border-box;
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

    .popup-form .input-file-wrapper {
        display: flex;
        align-items: center;
        border: none;
        border-radius: 7px;
        background-color: white;
        overflow: hidden;
    }

    .popup-form .input-file-text {
        flex-grow: 1;
        border: none;
        padding: 10px 12px;
        background-color: transparent;
        color: #888;
        border-radius: 7px 0px 0px 7px;
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
        border-radius: 0px 7px 7px 0px;
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

    .results-content {
        padding: 0 15px 15px;
        font-size: 14px;
    }

    .results-content p {
        margin-bottom: 10px;
        font-weight: 500;
    }

    .results-content ul {
        list-style: none;
        padding-left: 0;
    }

    .results-content ul li {
        margin-bottom: 5px;
        font-weight: 500;
    }

    .results-content ul li::before {
        content: "▶";
        color: #c60000;
        margin-right: 10px;
        font-size: 12px;
    }
</style>


<div class="content-wrapper">

    <div id="info-container">
        <div class="card full-width">
            <h3>Informations générales</h3>
            <div class="card-header-actions">
               <!-- <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#" id="openModalModifier">Modifier</a></li>
                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                        <li><a class="dropdown-item" href="#">Terminer</a></li>
                    </ul>
                </div>-->
            </div>
            <ul class="styled-list">
                <li><strong>Titre / Sujet :</strong> Prétraitement EEG Patient #4</li>
                <li><strong>Type :</strong> Expérimentation</li>
                <li><strong>Date :</strong> 28/08/2025</li>
                <li><strong>Heure :</strong> 10h00 – 11h30</li>
                <li><strong>Statut :</strong> Terminé</li>
               <li><strong>Document associé:</strong> Terminé</li>

            </ul>

            <h4 class="section-title">Description détaillée</h4>
            <p style="font-size: 14px;padding: 0 15px;font-weight: 500;">
                Mise en place du protocole de prétraitement des signaux EEG pour le patient #4, incluant le filtrage des
                artéfacts oculaires et musculaires. Vérification des canaux actifs, sauvegarde et exportation des
                fichiers CSV pour analyse statistique.
            </p>
        </div>
    </div>


    
    <!--<div id="docs-container">
        <div class="card full-width">
            <div class="card-header">
                <h3>Documents associés</h3>
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
                                    alt="file icon">
                                session4.csv
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
                                rapport.pretraitement.pdf
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
                </tbody>
            </table>
        </div>
    </div>-->

    <!--<div id="results-container">
        <div class="card full-width">
            <div class="card-header">
                <h3>Résultats & Indicateurs</h3>
                <button class="add-doc-button">Modifier</button>
            </div>
            <div class="results-content">
                <p><strong>Résultat attendu :</strong> Obtention d'un fichier nettoyé pour l'intégration dans la base
                    EEG.</p>
                <p><strong>Résultat obtenu :</strong> ✔ Atteint (95 % des signaux exploitables, 5 % rejetés).</p>
                <p><strong>Indicateurs :</strong></p>
                <ul>
                    <li>Nombre de canaux actifs : 32 / 32</li>
                    <li>Durée d'enregistrement : 90 min</li>
                    <li>Taux de rejet signal : 4.8 %</li>
                </ul>
            </div>
        </div>
    </div>-->

</div>

<div class="modal-overlay" id="modalModifier" style="display: none;">
    <div class="popup-container" id="popupContainerModifier">
        <div class="popup-header">
            <h2>Modifier une activité</h2>
            <button class="btn-enregistrer" id="btnSaveModifier">Enregistrer</button>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label for="typeActiviteModifier">Type</label>
                <div class="input-with-icon">
                    <select id="typeActiviteModifier">
                        <option>Sélection..</option>
                        <option value="Article">Article</option>
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
                <label for="auteursModifier">Auteurs</label>
                <input type="text" id="auteursModifier">
            </div>
            <div class="form-group">
                <label for="anneePublicationModifier">Année de publication</label>
                <input type="text" id="anneePublicationModifier">
            </div>
            <div class="form-group">
                <label for="sourceRevueModifier">Source / Revue / Événement</label>
                <input type="text" id="sourceRevueModifier">
            </div>
            <div class="form-group">
                <label for="pieceJointeModifier">Pièce jointe (facultatif)</label>
                <div class="input-file-wrapper">
                    <input type="text" id="fileTextModifier" class="input-file-text" placeholder="Aucun fichier choisi"
                        readonly>
                    <label for="fileUploadModifier" class="btn-importer">
                        <img width="20px" style="margin-right: 10px;"                          
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"        
                            alt="Icon-uploadwhite.png">
                        Importer</label>
                    <input type="file" id="fileUploadModifier" style="display:none;">
                </div>
            </div>
        </form>
    </div>
</div>

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
                            alt="Icon-uploadwhite.png">Importer</label>
                    <input type="file" id="docFileUpload" style="display:none;">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
    $(document).ready(function () {
        // Modifier Modal functionality
        const modalModifier = $('#modalModifier');
        $('#openModalModifier').on('click', function (e) {
            e.preventDefault();
            modalModifier.css('display', 'flex');
        });

        $('#modalModifier .btn-close-x, #btnSaveModifier').on('click', function () {
            modalModifier.css('display', 'none');
        });

        modalModifier.on('click', function (e) {
            if ($(e.target).is(modalModifier)) {
                modalModifier.css('display', 'none');
            }
        });

        $('#fileUploadModifier').on('change', function () {
            const fileName = $(this).val().split('\\').pop();
            $('#fileTextModifier').val(fileName || 'Aucun fichier choisi');
        });

        // Ajouter Document Modal functionality
        const modalAjouterDoc = $('#modalAjouterDoc');
        $('.add-doc-button').on('click', function (e) {
            e.preventDefault();
            modalAjouterDoc.css('display', 'flex');
        });

        $('#modalAjouterDoc .btn-close-x, #modalAjouterDoc .btn-enregistrer').on('click', function () {
            modalAjouterDoc.css('display', 'none');
        });

        modalAjouterDoc.on('click', function (e) {
            if ($(e.target).is(modalAjouterDoc)) {
                modalAjouterDoc.css('display', 'none');
            }
        });

        $('#docFileUpload').on('change', function () {
            const fileName = $(this).val().split('\\').pop();
            $('#docFileText').val(fileName || 'Aucun fichier choisi');
        });
    });
</script>


<script>
document.addEventListener("DOMContentLoaded", async () => {
  // 🔹 1. Récupérer l'id depuis l'URL
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");
  if (!id) {
    console.warn("Aucun ID trouvé dans l'URL");
    return;
  }

  // 🔹 2. Construire l'URL de l'API
  const base = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const url  = `${base}/plateforme-directeurderecherche/v1/activite_quotidienne/${id}`;

  try {
    // 🔹 3. Appel API
    const res = await fetch(url, {
      method: "GET",
      credentials: "include",
      headers: { "X-WP-Nonce": window.PMSettings?.nonce || "" }
    });
    if (!res.ok) throw new Error("Erreur API " + res.status);
    const data = await res.json();

    // 🔹 4. Injection dans le HTML
    const container = document.querySelector("#info-container .styled-list");
    if (container) {
      container.innerHTML = `
        <li><strong>Titre / Sujet :</strong> ${data.titre || '-'}</li>
        <li><strong>Type :</strong> ${data.type_libelle || '-'}</li>
        <li><strong>Date :</strong> ${data.date || '-'}</li>
        <li><strong>Heure :</strong> ${data.heure_debut || ''} – ${data.heure_fin || ''}</li>
        <li><strong>Statut :</strong> ${data.Statut || '-'}</li>
        <li><strong>Document associé :</strong> ${
          data.piece_jointe_path 
          ? `<a href="${data.piece_jointe_path}" target="_blank">Voir le document</a>` 
          : '—'
        }</li>
      `;
    }

    // 🔹 5. Description détaillée
    const descBloc = document.querySelector("#info-container p");
    if (descBloc) {
      descBloc.textContent = data.description || data.titre || "Pas de description.";
    }
  } catch (e) {
    console.error("Erreur lors du chargement de l'activité :", e);
    Swal.fire("Erreur", "Impossible de charger les détails de l’activité.", "error");
  }
});
</script>
