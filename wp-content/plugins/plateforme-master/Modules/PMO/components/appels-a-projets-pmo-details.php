<!--
/** =========================================================================
* FRONT — Project Details
* - This is a static representation based on the provided screenshots.
* ====================================================================== */
-->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .custom-project-wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .custom-content-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .custom-box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        box-shadow: 0 0 22px #00000012;
    }

    .custom-box-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
    }

    .custom-body-title {
        padding: 15px 20px;
        box-shadow: 0 5px 16px #00000012;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
        margin-top: 30px;
        margin-bottom: 15px;
        margin-inline: -20px
    }

    .custom-box-body {
        padding: 40px 20px;
    }

    .custom-icon-button {
        width: 36px;
        height: 36px;
        border: none;
        background-color: #fff;
        color: #6E6D55;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Info Section */
    .custom-details-list .custom-details-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #EBE9D7;
        align-items: center;
    }

    .custom-details-list .custom-details-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .custom-details-list .custom-details-item:first-child {
        padding-top: 0;
    }


    .custom-details-label {
        font-weight: 700;
        color: #6E6D55;
        width: 400px;
        flex-shrink: 0;
    }

    .custom-details-value {
        color: #6E6D55;
        color: #2A2916;
        font-weight: 400;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .custom-details-value a {
        color: #2A2916;
        text-decoration: underline;
    }

    .custom-details-value a:hover {
        text-decoration: underline;
    }

    /* Objectives Section */
    .custom-goals-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
        counter-reset: objective-counter;
    }

    .custom-goals-list li {
        counter-increment: objective-counter;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        color: #2A2916;
        font-weight: 400;
    }

    .custom-goals-list li::before {
        content: counter(objective-counter) ".";
        font-weight: 700;
        color: #BF0404;
    }

    /* Tables */
    .custom-data-table {
        width: 100%;
        border: none !important;
        box-shadow: none !important;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-data-table thead {
        position: static;
        transform: translateY(-15px);
    }

    .custom-data-table thead th {
        border: 0;
        background: #f3f1e9;
        padding: 12px 15px;
        text-align: left;
        font-weight: 700;
        color: #2A2916;
    }

    .custom-data-table tbody td {
        border: 1px solid #A6A4853D;
        padding: 12px 15px;
        color: #2A2916;
        vertical-align: middle;
        text-align: left;
    }

    .custom-data-table tbody td:not(:first-child) {
        text-align: center;
    }

    .custom-data-table tbody td:last-child {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-data-table tbody tr:first-child td {
        border-top: 1px solid #A6A4853D !important;
    }

    /* arrondis */
    .custom-data-table thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .custom-data-table thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .custom-data-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    .custom-data-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    .custom-data-table tbody tr:first-child td:first-child {
        border-top-left-radius: 12px;
    }

    .custom-data-table tbody tr:first-child td:last-child {
        border-top-right-radius: 12px;
    }


    .custom-attachment-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .custom-attachment-link:hover {
        text-decoration: underline;
    }

    .dossier-cell {
        display: inline-block;
        position: relative;
    }

    .dossier-cell .badge {
        background-color: #DBD9C3;
        color: #2A2916;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        position: absolute;
        top: -8px;
        right: -15px;
    }
</style>

<div class="custom-project-wrapper">

    <!-- Informations générales -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Détails appel à projet</h2>
        </div>
        <div class="custom-box-body">
            <div class="custom-details-list">
                <div class="custom-details-item">
                    <span class="custom-details-label">Titre :</span>
                    <span class="custom-details-value">Appel a projet IA</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Projet :</span>
                    <span class="custom-details-value">Détection IA Dans L'agriculture</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Période :</span>
                    <span class="custom-details-value">01/03/2024 -- 28/02/2026</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Pièces jointe :</span>
                    <div class="custom-details-value">
                        <a href="#" class="custom-attachment-link">
                            <img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="">
                            Convention_BCI_UTM.pdf
                        </a>
                        <a href="#" class="custom-attachment-link">
                            <img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="">
                            Convention_BCI_UTM.pdf
                        </a>
                    </div>
                </div>
            </div>
            <h2 class="custom-body-title">Description</h2>
            <ol class="custom-goals-list">
                <li>Développer une interface neuronale portable basée sur des casques EEG à faible coût,
                    interfacée avec
                    une application mobile.</li>
                <li>Intégrer un module d'intelligence artificielle permettant la reconnaissance de
                    signaux moteurs
                    intentionnels à partir de données brutes EEG.</li>
                <li>Tester cliniquement le dispositif sur un échantillon de patients atteints de
                    troubles moteurs (10
                    cas suivis).</li>
                <li>Optimiser les performances du dispositif en conditions réelles et publier les
                    résultats.</li>
                <li>Former deux doctorants dans le cadre du projet (signal + clinique).</li>
            </ol>
        </div>
    </div>

    <!-- Liste des Soumissions -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Liste des Soumissions</h2>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table" id="soumissionsTable">
                <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Date</th>
                        <th>Email</th>
                        <th>Dossier</th>
                        <th>Consulter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Manel Selmi</td>
                        <td>12/03/2025</td>
                        <td>manel@gmail.com</td>
                        <td>
                            <div class="dossier-cell">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png"  
                                    alt="Icon-attach-2.png">
                                <span class="badge">8</span>
                            </div>
                        </td>
                        <td>
                            <button class="custom-icon-button" title="Consulter">
                                <a href="/details-chercheur-pmo"> <i class="fa-solid fa-eye"></i></a>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Mohamed Houissa</td>
                        <td>08/03/2025</td>
                        <td>mohamed@gmail.com</td>
                        <td>
                            <div class="dossier-cell">

                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png"  
                                    alt="Icon-attach-2.png">
                                <span class="badge">8</span>
                            </div>
                        </td>
                        <td>
                            <button class="custom-icon-button" title="Consulter">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Naim Chouigi</td>
                        <td>08/03/2025</td>
                        <td>naim@gmail.com</td>
                        <td>
                            <div class="dossier-cell">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png"  
                                    alt="Icon-attach-2.png">
                                <span class="badge">7</span>
                            </div>
                        </td>
                        <td>
                            <button class="custom-icon-button" title="Consulter">
                                <a href="/details-chercheur-pmo"> <i class="fa-solid fa-eye"></i></a>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>