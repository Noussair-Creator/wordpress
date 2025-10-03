<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Presentation</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    body {
        font-family: sans-serif;
        background-color: #f9f9f9;
    }

    .custom-project-wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
        background-color: white;
        padding: 20px;
        box-shadow: 0 0 22px #00000012;
        border-radius: 10px;
    }

    .custom-content-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0px 3px 16px #00000029;
    }

    .custom-content-box:first-child .custom-box-header {
        box-shadow: 0 5px 16px #00000012;

    }

    .custom-box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        box-shadow: 0 5px 16px #00000012;
    }

    .custom-box-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-icon {

        border-radius: 8px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #BF0404;
        position: relative;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #BF0404;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 2px solid white;
    }

    .header-buttons {
        display: flex;
        gap: 10px;
    }

    .custom-button {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid transparent;
    }

    .custom-button-main {
        background-color: #BF0404;
        color: #fff;
        border-color: #BF0404;
    }

    .custom-button-alt {
        background-color: #fff;
        color: #BF0404;
        border: 1px solid #BF0404;
    }

    .custom-box-body {
        padding: 20px 20px 40px;
    }

    /* Info Section */
    .info-header-container {
        padding: 20px;
        border-bottom: 1px solid #ECEBE3;
        box-shadow: 0 5px 16px #00000012;
    }

    .info-header-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .info-header-grid h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        padding: 20px;
    }

    .custom-details-list .custom-details-item {
        display: flex;
        padding: 10px 0;
        align-items: center;
    }

    .custom-details-label {
        font-weight: 500;
        color: #6E6D55;
        width: 150px;
        flex-shrink: 0;
    }

    .custom-details-value {
        color: #2A2916;
        font-weight: 500;
    }

    .director-details {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .profile-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .director-contact .custom-details-item {
        padding: 6px 0;
        border-bottom: none;
    }

    .director-contact .custom-details-label {
        width: 300px;
    }


    /* Mission & Objectives */
    .mission-text {
        color: #2A2916;
        font-weight: 500;
        line-height: 1.6;
    }

    .objectives-list {
        list-style-type: none;
        padding-left: 0;
        margin-top: 20px;
    }

    .objectives-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        color: #2A2916;
        font-weight: 500;
    }

    .objectives-list li i {
        color: #BF0404;
        background-color: #fdf0f0;
        padding: 3px;
        border-radius: 4px;
    }

    /* Tables */
    .custom-data-table {
        width: 100%;
        border: none !important;
        box-shadow: none !important;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 15px;
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
        font-weight: 500;
        color: #2A2916;
    }

    .custom-data-table tbody td {
        border: 1px solid #A6A4853D;
        padding: 12px 15px;
        color: #2A2916;
        vertical-align: middle;
        text-align: left;
        font-weight: 500;
    }

    .custom-data-table tbody td a {
        color: #3987DF;
        text-decoration: underline;
        font-weight: 500;
    }

    .custom-data-table tbody tr:first-child td {
        border-top: 1px solid #A6A4853D !important;
    }

    /* table corners */
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

    /* Bottom Grid */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #2A2916;
        margin-bottom: 15px;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        align-items: stretch;
    }

    .key-figures-grid {
        margin-top: 31px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px 20px;
    }

    .figure-box {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f0f0f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .figure-box::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 4px;
        height: 35px;
        background-color: #BF0404;
        border-radius: 0 7px 7px 0;
    }

    .figure-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        color: #2A2916;
    }

    .figure-icon-bar {
        width: 4px;
        height: 20px;
        background-color: #BF0404;
        border-radius: 2px;
    }

    .figure-value {
        font-weight: 700;
        font-size: 18px;
        color: #2A2916;
        background-color: #ECEBE3;
        padding: 8px 12px;
        border-radius: 6px;
    }

    .contact-item {
        margin-bottom: 15px;
    }

    .contact-label {
        display: block;
        font-weight: 700;
        color: #6E6D55;
        margin-bottom: 8px;
    }

    .contact-value {
        display: block;
        color: #2A2916;
        font-weight: 600;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .contact-item:last-child .contact-value {
        border-bottom: none;
        padding-bottom: 0;
    }
    </style>
</head>

<body>

    <div class="custom-project-wrapper">
        <!-- Présentation Header -->
        <div class="custom-content-box">
            <div class="custom-box-header">
                <h2>
                    <span class="header-icon">
                        <img width="30px" src="/wp-content/plugins/plateforme-master/images/icons/2274790.png"
                            alt="2274790.png">
                    </span>
                    Présentation
                </h2>
                <div class="header-buttons">
                    <a href="#" class="custom-button custom-button-alt">Modifier</a>
                    <a href="#" class="custom-button custom-button-main"> <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/internet-svgrepo-com-white.png"
                            alt="internet-svgrepo-com-white.png"> Publier
                        web</a>
                </div>
            </div>
        </div>

        <!-- Informations détaillés & Directeur -->
        <div class="custom-content-box">
            <div class="info-header-container">
                <div class="info-header-grid">
                    <h3>Informations détaillés</h3>
                    <h3>Directeur</h3>
                </div>
            </div>
            <div class="info-grid">
                <div>
                    <div class="custom-details-list">
                        <div class="custom-details-item">
                            <span class="custom-details-label">Création :</span>
                            <span class="custom-details-value">2018</span>
                        </div>
                        <div class="custom-details-item">
                            <span class="custom-details-label">Localisation :</span>
                            <span class="custom-details-value">Tunis, Technopole El Ghazala</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="director-details">
                        <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 467.png"
                            alt="Mr. Ahmed Tayaa" class="profile-pic">
                        <div class="director-contact custom-details-list">
                            <div class="custom-details-item">
                                <span class="custom-details-label">Nom et prénom du coordinateur :</span>
                                <span class="custom-details-value">Mr. Ahmed Tayaa</span>
                            </div>
                            <div class="custom-details-item">
                                <span class="custom-details-label">Grade :</span>
                                <span class="custom-details-value">Professeur</span>
                            </div>
                            <div class="custom-details-item">
                                <span class="custom-details-label">Spécialité :</span>
                                <span class="custom-details-value">-</span>
                            </div>
                            <div class="custom-details-item">
                                <span class="custom-details-label">Email académique :</span>
                                <span class="custom-details-value">Ahmed@gmail.com</span>
                            </div>
                            <div class="custom-details-item">
                                <span class="custom-details-label">Téléphone professionnel :</span>
                                <span class="custom-details-value">+216 22 45 45 00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Objectifs -->
        <div class="custom-content-box">
            <div class="custom-box-header">
                <h2>Mission & Objectifs</h2>
            </div>
            <div class="custom-box-body">
                <p class="mission-text">Le CEIP a pour mission d’accompagner les chercheurs, enseignants et entreprises
                    dans
                    la gestion, le financement et le suivi des projets d’ingénierie.</p>
                <h4 style="font-weight: 600; color: #6E6D55;font-size:14px; margin-top: 20px;">Objectifs principaux :
                </h4>
                <ul class="objectives-list">
                    <li><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2.png"
                            alt="Icon-checkmark-square-2.png"> Offrir un appui méthodologique pour la préparation et la
                        gestion
                        des projets.</li>
                    <li><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2.png"
                            alt="Icon-checkmark-square-2.png"> Développer des partenariats nationaux et internationaux.
                    </li>
                    <li><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2.png"
                            alt="Icon-checkmark-square-2.png"> Centraliser et diffuser les informations et ressources
                        documentaires.</li>
                    <li><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2.png"
                            alt="Icon-checkmark-square-2.png"> Fournir une plateforme digitale intégrée pour la gestion
                        des
                        données, dépôts et requêtes.</li>
                </ul>
            </div>
        </div>

        <!-- Organisation & Structure -->
        <div class="custom-content-box">
            <div class="custom-box-header">
                <h2>Organisation & Structure</h2>
            </div>
            <div class="custom-box-body">
                <table class="custom-data-table">
                    <thead>
                        <tr>
                            <th>Nom complet</th>
                            <th>Rôle</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pr. Hatem Ben Youssef</td>
                            <td>Directeur CEIP</td>
                            <td><a href="mailto:hatem.youssef@utm.tn">hatem.youssef@utm.tn</a></td>
                        </tr>
                        <tr>
                            <td>Mme. Salma Trabelsi</td>
                            <td>Responsable Plateformes Digitales</td>
                            <td><a href="mailto:salma.trabelsi@utm.tn">salma.trabelsi@utm.tn</a></td>
                        </tr>
                        <tr>
                            <td>Dr. Yassine Ayari</td>
                            <td>Chargé Des Partenariats</td>
                            <td><a href="mailto:yassine.ayari@etu.utm.tn">yassine.ayari@etu.utm.tn</a></td>
                        </tr>
                        <tr>
                            <td>M. Amine Mejri</td>
                            <td>Responsable Support & Assistance</td>
                            <td><a href="mailto:amine.mejri@etu.utm.tn">amine.mejri@etu.utm.tn</a></td>
                        </tr>
                        <tr>
                            <td>Mme. Nour Ben Romdhane</td>
                            <td>Assistante Administrative</td>
                            <td><a href="mailto:nour.T@etu.utm.tn">nour.T@etu.utm.tn</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bottom Grid Section -->
        <div class="bottom-grid">
            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Chiffres Clés</h2>
                </div>
                <div class="custom-box-body">
                    <div class="key-figures-grid">
                        <div class="figure-box">
                            <span class="figure-label"> Projets Accompagnés</span>
                            <span class="figure-value">+120</span>
                        </div>
                        <div class="figure-box">
                            <span class="figure-label"> Documents Déposés Sur La
                                Plateforme</span>
                            <span class="figure-value">+500</span>
                        </div>
                        <div class="figure-box">
                            <span class="figure-label"> Partenariats Académiques Et
                                Industriels</span>
                            <span class="figure-value">35</span>
                        </div>
                        <div class="figure-box">
                            <span class="figure-label"> Taux De Satisfaction Des
                                Utilisateurs</span>
                            <span class="figure-value">96%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Contact & Support</h2>
                </div>
                <div class="custom-box-body">
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Email :</span>
                            <span class="contact-value">contact@ceip.tn</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-label">Localisation :</span>
                            <span class="contact-value">Technopole El Ghazala, Bâtiment B2 – Tunis</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-label">Téléphone :</span>
                            <span class="contact-value">+216 71 000 123</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>