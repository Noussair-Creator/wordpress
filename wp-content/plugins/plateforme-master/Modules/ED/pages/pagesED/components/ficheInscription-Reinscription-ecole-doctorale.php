<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Candidature</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        margin-bottom: 20px;
    }

    .card h3 {
        font-size: 21px;
        margin-bottom: 14px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
        padding-bottom: 6px;
        box-shadow: 0px 5px 16px #00000012;
        margin-left: -17px;
        margin-right: -17px;
        margin-top: -19px;
        padding: 17px 25px;
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

    .pdf-icon {
        width: 16px;
        vertical-align: middle;
        margin-left: 4px;
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

    .status-header .actions {
        display: flex;
        gap: 10px;
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
        top: calc(100% + 5px);
        width: 100%;
        min-width: 200px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        display: none;
        /* Initially hidden */
        flex-direction: column;
        padding: 4px 0;
        z-index: 10;
    }

    .status-select.active .status-options {
        display: flex;
        /* Show when active */
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

    button.status-button,
    button.download-button {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #BF0404;
        border-radius: 5px;
        padding: 5px 10px 5px 10px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        color: #BF0404;
    }

    button.status-button {
        border-color: #BF0404;
        color: #495057;
        min-width: 180px;
    }

    /* This targets the new icon inside the button */
    button.status-button i {
        font-size: 1em;
        margin-left: 10px;
        border-left: 1px solid red;
        padding-left: 10px;
    }


    .grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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
        margin-top: 20px;
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

    .pdf-icon {
        width: 18px;
        vertical-align: middle;
        margin: 0 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr;
        }

        .status-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }

    .styled-list {
        list-style: none;
        padding: 0;
        margin: 0;
        border: 1px solid #dedcc9;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .styled-list li {
        padding: 10px 16px;
        border-bottom: 1px solid #dedcc9;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        color: #333;
    }

    .styled-list li>span {
        flex-basis: 60%;
        text-align: left;
    }

    .styled-list li ul {
        flex-basis: 60%;
        padding-left: 0;
        list-style-position: inside;
    }

    .styled-list li ul li {
        border: none;
        padding: 2px 0;
    }


    .styled-list li:last-child {
        border-bottom: none;
    }

    .styled-list strong {
        font-weight: 600;
        color: #6E6D55;
        min-width: 160px;
        display: inline-block;
        flex-basis: 35%;
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

    .badge {
        display: inline-block;
        padding: .35em .65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    /* START OF NEW STYLES */
    .content-block {
        background: #fff;
        border-radius: 10px;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
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
        width: 150px;
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
        padding: 12px 20px;
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
        position: static;
        transform: translateY(-15px);
    }

    .styled-table th,
    .styled-table td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #F1F1EB;
    }

    .styled-table th {
        font-weight: 600;
        padding-bottom: 20px;
    }

    .styled-table .action-icon {
        width: 20px;
        cursor: pointer;
    }

    #history-table td {
        text-align: left;
    }

    .pagination-controls {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
        gap: 5px;
    }

    .pagination-controls button {
        border: 2px solid #BF0404;
        background-color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        color: #BF0404;
        font-weight: bold;
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

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
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

    .popup-body {
        padding: 25px;
    }

    .popup-body h3 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
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

    .jury-member .member-info {
        display: flex;
        flex-direction: column;
    }

    .styled-table tbody tr:first-child td {
        border-top: 1px solid #EBE9D7 !important;
    }

    .styled-table tbody tr:last-child td {
        border-bottom: 1px solid #EBE9D7 !important;
    }

    thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .styled-table tbody td:not(:first-child) {
        border-left: 1px solid #F1F1EB;
    }

    .styled-table tbody tr td:first-child {
        border-left: 1px solid #EBE9D7 !important;
    }

    .styled-table tbody tr td:last-child {
        border-right: 1px solid #EBE9D7 !important;
    }

    .styled-table tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    .styled-table tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }

    .styled-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    .styled-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    .styled-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* END OF NEW STYLES */
    </style>
</head>

<body>

    <div class="content-wrapper">

        <div class="status-bar-container">
            <div class="status-header">
                <h2>Statut d'inscription</h2>
                <div class="actions">
                    <button class="download-button">Télécharger le dossier</button>
                    <div class="status-select" id="status-select-dossier">
                        <!-- The icon is now inside the button -->
                        <button class="status-button">Acceptée <i class="fa-solid fa-angle-down"></i></button>
                        <div class="status-options">
                            <div class="option selected">Acceptée</div>
                            <div class="option">En Attente</div>
                            <div class="option">Complément D'information</div>
                            <div class="option">Refusée</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-container" id="dragZone">
            <div class="box" draggable="true">
                <h3>Informations générales</h3>
                <ul>
                    <li><strong>CIN :</strong> <span>06972145</span></li>
                    <li><strong>Nom et prénom :</strong> <span>Ahlem Ben Slimen</span></li>
                    <li><strong>E-mail :</strong> <span>ahlem8@gmail.com</span></li>
                    <li><strong>Sexe :</strong> <span>Féminin</span></li>
                    <li><strong>Situation :</strong> <span>Etudiante</span></li>
                    <li><strong>Dernière connexion :</strong> <span>12/03/2025</span></li>
                    <li><strong>Activé :</strong> <span class="badge enabled">Oui</span></li>
                </ul>
            </div>

            <div class="box" draggable="true">
                <h3>Adresse</h3>
                <ul>
                    <li><strong>Pays :</strong> <span>Tunisie</span></li>
                    <li><strong>Gouvernorat :</strong> <span>Tunis</span></li>
                    <li><strong>Ville :</strong> <span>Marsa</span></li>
                    <li><strong>Rue :</strong> <span>12, Rue de berlin</span></li>
                    <li><strong>Code postale :</strong> <span>2070</span></li>
                </ul>
            </div>
        </div>

        <!-- Informations thèse -->
        <div class="card full-width">
            <h3>Les informations relatives au dossier de thèse</h3>
            <ul class="styled-list">
                <li><strong>Type de demande :</strong> <span>Réinscription – 2<sup>e</sup> année</span>
                    <div class="img-pdf"> &MediumSpace; &MediumSpace; </div>
                </li>
                <li><strong>Sujet de thèse :</strong> <span>Optimisation des systèmes multi-agents dans les réseaux IoT
                        intelligents</span>
                    <div class="img-pdf">&MediumSpace; &MediumSpace;</div>
                </li>
                <li><strong>Directeur de thèse :</strong> <span>Pr. Mourad Ben Said</span>
                    <div class="img-pdf">&MediumSpace; &MediumSpace;</div>
                </li>
                <li><strong>Objectif :</strong> <span>Développer un système intelligent de gestion d’énergie pour les
                        bâtiments connectés, basé sur l’intelligence artificielle et l’analyse prédictive, afin de
                        réduire la consommation énergétique tout en optimisant le confort des usagers.</span>
                    <div class="img-pdf">&MediumSpace; &MediumSpace;</div>
                </li>
                <li><strong>Problématique :</strong> <span>La consommation énergétique des bâtiments représente une part
                        significative des émissions de CO2. Les systèmes actuels manquent d’adaptabilité et
                        d’intelligence dans la gestion des ressources, ce qui engendre des pertes d’énergie et une
                        inefficacité structurelle.</span>
                    <div class="img-pdf"> <img width="20px"
                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com"> </div>
                </li>
                <li>
                    <strong>Résultats attendus :</strong>
                    <ul>
                        <li>► Conception d’un prototype de système intelligent embarqué</li>
                        <li>► Réduction de 20 à 30 % de la consommation énergétique sur une année test</li>
                        <li>► Intégration avec des capteurs IoT pour suivi en temps réel</li>
                        <li>► Publication de résultats dans des revues internationales</li>
                        <li>► Dépôt d’un brevet en fin de parcours doctoral</li>
                    </ul>
                    <div class="img-pdf"> <img width="20px"
                            src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com"> </div>
                </li>
                <li>
                    <strong>Méthodologie :</strong>
                    <ul>
                        <li>► Revue de littérature et analyse comparative des systèmes existants</li>
                        <li>► Modélisation des flux énergétiques via des outils de simulation</li>
                        <li>► Développement d’algorithmes prédictifs basés sur le machine learning</li>
                        <li>► Validation expérimentale sur un démonstrateur réel (bâtiment pilote)</li>
                        <li>► Évaluation des performances environnementales et économiques</li>
                    </ul>
                    <div class="img-pdf">
                        <img width="20px" src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com">
                    </div>
                </li>
                <li>
                    <strong>Mots clés :</strong>
                    <span>
                        <span class="badge badge-danger">Intelligence énergétique</span>
                        <span class="badge badge-danger">Smart Building</span>
                        <span class="badge badge-danger">IoT</span>
                    </span>
                    <div class="img-pdf">
                        &MediumSpace; &MediumSpace; &MediumSpace;
                    </div>
                </li>
            </ul>
        </div>

        <!-- Pièces justificatives -->
        <div class="card full-width">
            <h3>Pièces justificatives déposées</h3>
            <table class="styled-table" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Ref_Doc</th>
                        <th>Document</th>
                        <th>Statut</th>
                        <th>Télécharger</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Formulaire réinscription PDF</td>
                        <td>Reçu</td>
                        <td><a href="#">
                                <img class="action-icon"
                                    src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                    alt="Télécharger PDF"></a></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Lettre de motivation</td>
                        <td>Reçu</td>
                        <td><a href="#"> <img class="action-icon"
                                    src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                    alt="Télécharger PDF"></a></td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Copie CIN</td>
                        <td>Manquant</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Diplômes</td>
                        <td>Reçu</td>
                        <td><a href="#">
                                <img class="action-icon"
                                    src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png"
                                    alt="Télécharger PDF">
                            </a></td>
                    </tr>
                </tbody>
            </table>
        </div>

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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modalCommission" style="display: none;">
            <!-- Modal content for creating commission -->
        </div>


        <!-- Historique -->
        <div class="card full-width">
            <h3>Historique des inscriptions</h3>
            <table class="styled-table" id="history-table" style="margin-top: 20px;">
                <tbody>
                    <tr>
                        <td><strong>2023 – 2024</strong></td>
                        <td>Inscription Validée (1Re Année)</td>
                    </tr>
                    <tr>
                        <td><strong>2024 – 2025</strong></td>
                        <td>Réinscription Demandée (2ᵉ Année) – En Cours</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    // This function is called by the onclick attribute on the modal's close button
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // --- Drag and Drop Logic ---
        const dragZone = document.getElementById('dragZone');
        if (dragZone) {
            let draggedItem = null;

            dragZone.addEventListener('dragstart', function(e) {
                if (e.target.classList.contains('box')) {
                    draggedItem = e.target;
                    setTimeout(() => {
                        e.target.style.opacity = '0.5';
                    }, 0);
                }
            });

            dragZone.addEventListener('dragend', function(e) {
                if (draggedItem) {
                    setTimeout(() => {
                        draggedItem.style.opacity = '1';
                        draggedItem = null;
                    }, 0);
                }
            });

            dragZone.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            dragZone.addEventListener('drop', function(e) {
                e.preventDefault();
                if (draggedItem) {
                    const target = e.target.closest('.box');
                    if (target && draggedItem !== target) {
                        const targetNextSibling = target.nextSibling;
                        const draggedItemNextSibling = draggedItem.nextSibling;
                        dragZone.insertBefore(target, draggedItemNextSibling);
                        dragZone.insertBefore(draggedItem, targetNextSibling);
                    }
                }
            });
        }


        // --- Status Dropdown Logic ---
        const statusSelect = document.getElementById('status-select-dossier');
        if (statusSelect) {
            const statusButton = statusSelect.querySelector('.status-button');
            const statusOptionsContainer = statusSelect.querySelector('.status-options');
            const statusOptions = statusOptionsContainer.querySelectorAll('.option');

            statusButton.addEventListener('click', (e) => {
                e.stopPropagation();
                statusSelect.classList.toggle('active');
            });

            statusOptions.forEach(option => {
                option.addEventListener('click', () => {
                    // This now correctly targets the text node without affecting the icon
                    const buttonText = statusButton.firstChild;
                    buttonText.textContent = option.textContent.trim() + ' ';
                    statusOptions.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    statusSelect.classList.remove('active');
                });
            });

            window.addEventListener('click', (e) => {
                if (!statusSelect.contains(e.target)) {
                    statusSelect.classList.remove('active');
                }
            });
        }
    });
    </script>

</body>

</html>