<!--
/** =========================================================================
* FRONT — Member Details
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
        font-family: sans-serif;
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
        border-bottom: 1px solid #f0f0f0;
    }

    .custom-box-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
    }

    .custom-body-title {
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
        margin-top: 30px;
        margin-bottom: 20px;
        box-shadow: 0 5px 16px #00000012;
        padding: 20px;
        margin-inline: -20px;
    }

    .custom-box-body {
        padding: 20px 20px 40px;
        margin-top: 10px;
    }

    .custom-icon-button {
        width: 36px;
        height: 36px;
        border: none;
        background-color: transparent;
        color: #6E6D55;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
    }

    .custom-icon-button.download-btn {
        border: 1px solid #ddd;
        color: #BF0404;
    }

    /* Dropdown Menu */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background-color: #fff;
        min-width: 120px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border-radius: 8px;
        border: 1px solid #EBE9D7;
        overflow: hidden;
    }

    .dropdown-menu a {
        color: #2A2916;
        padding: 5px 15px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-menu a:first-child {
        border-bottom: 1px solid #ECEBE3;
    }

    .dropdown-menu a:hover {
        background-color: #f9f9f9;
    }

    .dropdown-menu.show {
        display: block;
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
    }

    .custom-details-label {
        font-weight: 700;
        color: #6E6D55;
        width: 250px;
        flex-shrink: 0;
    }

    .custom-details-value {
        color: #2A2916;
        font-weight: 400;
    }

    .custom-details-value.user-name-cell {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 400;
        color: #2A2916;
    }

    .profile-pic {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .custom-details-value a {
        color: #2A2916;
        text-decoration: underline;
        font-weight: 400;
    }

    .custom-details-value a:first-child {
        color: #4E81E8;
        text-decoration: underline;
        font-weight: 700;
    }

    .status-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-indicator::before {
        content: '';
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #0E962D;
        border: 1px solid #0E962D;
    }


    /* Expertise Section */
    .expertise-list {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }

    .expertise-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        color: #2A2916;
        font-weight: 400;
    }

    .expertise-list li i {
        color: #BF0404;
    }

    .expertise-tags-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .expertise-tag {
        background-color: #BF0404;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 14px;
        font-weight: 700;
    }

    .expertise-tag i {
        cursor: pointer;
        font-size: 8px;
        background-color: white;
        color: white;
        border-radius: 50%;
        /* padding: 4px; */
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #BF0404;
        border: 1px solid white;
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

    .status-termine {
        color: #198754;
        background-color: #e8f3ec;
        border: 1px solid #198754;
        border-radius: 15px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .custom-attachment-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: #2A2916;
        font-weight: 400;
    }

    .custom-attachment-link:hover {
        text-decoration: underline;
    }
</style>

<div class="custom-project-wrapper">

    <!-- Informations générales -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Informations générales</h2>
            <div class="dropdown">
                <button class="custom-icon-button" id="infoActionsBtn">
                    <i class="fa-solid fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="infoActionsBtn">
                    <a href="#">Accepter</a>
                    <a href="#">Refuser</a>
                </div>
            </div>
        </div>
        <div class="custom-box-body">
            <div class="custom-details-list">
                <div class="custom-details-item">
                    <span class="custom-details-label">Nom complet :</span>
                    <span class="custom-details-value user-name-cell">
                        <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 436.png"
                            alt="Dr. Sarra Messaoudi" class="profile-pic">
                        Dr. Sarra Messaoudi
                    </span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">orcid :</span>
                    <span class="custom-details-value">0000-0001-5109-3700</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Grade / Statut :</span>
                    <span class="custom-details-value">Maitre assistant</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Spécialité :</span>
                    <span class="custom-details-value">Intelligence Artificielle</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Affectation :</span>
                    <span class="custom-details-value">ISAMM – Département Informatique</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Email :</span>
                    <span class="custom-details-value"><a
                            href="mailto:sarra.messaoudi@utm.tn">sarra.messaoudi@utm.tn</a></span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Téléphone :</span>
                    <span class="custom-details-value">+216 71 123 456</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Date d’entrée au labo :</span>
                    <span class="custom-details-value">15/01/2022</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Equipe de recherche :</span>
                    <span class="custom-details-value">Systèmes Intelligents Distribués</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Projet associé :</span>
                    <span class="custom-details-value">BCI-Learn, ARUX</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Encadrements :</span>
                    <span class="custom-details-value">2 thèses, 1 mastère</span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">CV / Dossier :</span>
                    <span class="custom-details-value"><a href="#">CV_Sarra_Messaoudi.pdf</a></span>
                </div>
                <div class="custom-details-item">
                    <span class="custom-details-label">Etat :</span>
                    <span class="custom-details-value status-indicator">Actif</span>
                </div>
            </div>

            <h2 class="custom-body-title">Domaine d’expertise</h2>
            <ul class="expertise-list">
                <li><i class="fa-solid fa-play"></i> Traitement des données</li>
                <li><i class="fa-solid fa-play"></i> Domaine spécifique de l’IA</li>
                <li><i class="fa-solid fa-play"></i> Conception et optimisation d’algorithmes de Machine Learning
                    supervisés et non supervisés.</li>
                <li><i class="fa-solid fa-play"></i> Bases de données relationnelles (SQL) et NoSQL (MongoDB,
                    Cassandra).</li>
            </ul>

            <h2 class="custom-body-title">Domaine d'intérêt</h2>
            <div class="expertise-tags-container">
                <span class="expertise-tag">AI & data <i class="fa-solid fa-times"></i></span>
                <span class="expertise-tag">IT <i class="fa-solid fa-times"></i></span>
            </div>
        </div>
    </div>

    <!-- liste des projets -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>liste des projets</h2>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table">
                <thead>
                    <tr>
                        <th>Projet</th>
                        <th>Type</th>
                        <th>Etat</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Détection IA Dans L'agriculture</td>
                        <td>Ationnal</td>
                        <td><span class="status-termine"><i class="fa-solid fa-check"></i> Terminé</span></td>
                        <td>12/03/2025</td>
                    </tr>
                    <tr>
                        <td>Stockage Cloud De Données Santé</td>
                        <td>International</td>
                        <td><span class="status-termine"><i class="fa-solid fa-check"></i> Terminé</span></td>
                        <td>08/03/2025</td>
                    </tr>
                    <tr>
                        <td>Interfaces Adaptatives AR/VR</td>
                        <td>International</td>
                        <td><span class="status-termine"><i class="fa-solid fa-check"></i> Terminé</span></td>
                        <td>08/03/2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pieces jointe -->
    <div class="custom-content-box">
        <div class="custom-box-header">
            <h2>Pieces jointe</h2>
            <button class="custom-icon-button download-btn" title="Télécharger tout">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
        <div class="custom-box-body">
            <table class="custom-data-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Type de document</th>
                        <th>Fichier</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>CIN</td>
                        <td>
                            <a href="#" class="custom-attachment-link">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="">
                                Convention_BCI_UTM.pdf
                            </a>
                        </td>
                        <td>01/02/2024</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Attestation</td>
                        <td>
                            <a href="#" class="custom-attachment-link">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/excel-document.png" alt="">
                                Planning_BCI_Q1Q2_2025.xlsx
                            </a>
                        </td>
                        <td>20/01/2025</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Rapport</td>
                        <td>
                            <a href="#" class="custom-attachment-link">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="">
                                Rapport_BCI_Progress2024.pdf
                            </a>
                        </td>
                        <td>15/12/2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Dropdown Menu Logic
        window.addEventListener('click', function (e) {
            const clickedToggle = e.target.closest('.custom-icon-button');

            document.querySelectorAll('.dropdown').forEach(function (dropdown) {
                const menu = dropdown.querySelector('.dropdown-menu');
                const toggle = dropdown.querySelector('.custom-icon-button');

                if (toggle !== clickedToggle && menu && menu.classList.contains('show')) {
                    menu.classList.remove('show');
                }
            });

            if (clickedToggle && clickedToggle.parentElement.classList.contains('dropdown')) {
                e.preventDefault();
                const menu = clickedToggle.nextElementSibling;
                if (menu) {
                    menu.classList.toggle('show');
                }
            }
        });

        // --- Added Code for Deleting Interest Tags ---
        const tagsContainer = document.querySelector('.expertise-tags-container');
        if (tagsContainer) {
            tagsContainer.addEventListener('click', function (e) {
                // Check if the clicked element is the delete icon
                if (e.target && e.target.matches('i.fa-times')) {
                    // Find the closest parent tag and remove it
                    const tagToRemove = e.target.closest('.expertise-tag');
                    if (tagToRemove) {
                        tagToRemove.remove();
                    }
                }
            });
        }
        // --- End of Added Code ---
    });
</script>