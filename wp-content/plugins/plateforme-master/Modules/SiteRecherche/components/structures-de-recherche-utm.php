<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Structures de recherche</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* General body styling */

        /* Hero section styling */
        .hero-bg {
            background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
            background-size: cover;
            background-position: center;
            padding: 8rem 0;
            color: white;
        }

        .hero-bg h1 {
            font-size: 50px;
            width: 340px;
            font-weight: 500;
            /* text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); */
        }

        .breadcrumb-custom {
            background-color: rgb(83 81 81 / 40%);
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .breadcrumb-custom a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        .breadcrumb-custom span {
            color: #e9ecef;
            margin: 0 0.5rem;
        }

        /* Presentation Section */
        .presentation-section {
            background-color: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #e9ecef; */
        }

        .presentation-section h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .presentation-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .presentation-section ul li {
            padding-left: 1.5rem;
            position: relative;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .presentation-section ul li::before {
            content: '►';
            color: #b60303;
            position: absolute;
            left: 0;
            top: 2px;
            font-size: 0.8rem;
        }

        /* Main Content Styling */
        .publication-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .publication-card .card-icon-link {
            position: absolute;
            top: 0rem;
            right: 0rem;
            color: #b60303;
            text-decoration: none;
            border: 1px solid #b60303;
            width: 50px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0px 16px 0 16px;
            transition: all 0.3s ease;
        }

        .publication-card .card-icon-link:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .publication-card .date-tag {
            display: inline-flex;
            align-items: center;
            background-color: #b60303;
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .publication-card .date-tag img {
            margin-right: 8px;
        }

        .publication-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: #212529;
        }

        .publication-card .info-line {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 700;
            color: #495057;
            margin-bottom: 0.6rem;
        }

        .publication-card .info-line i {
            color: #b60303;
            margin-right: 12px;
            width: 16px;
            text-align: center;
        }

        .btn-view-more {
            border: 1px solid #b60303;
            color: #b60303;
            font-weight: 600;
            padding: 0.75rem 4.5rem;
            border-radius: 10px;
            text-decoration: none;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .btn-view-more:hover {
            background-color: #b60303;
            color: white;
            border-color: #b60303;
        }

        .titre-ligne-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 40px 0;
            gap: 10px;
            padding: 0 10%;
        }

        .ligne-gauche,
        .ligne-droite {
            flex: 1;
            height: 2px;
            background-color: #b60303;
            position: relative;
        }

        .ligne-gauche::after,
        .ligne-droite::before {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background-color: #b60303;
            border-radius: 50%;
        }

        .ligne-gauche::after {
            right: 0;
        }

        .ligne-droite::before {
            left: 0;
        }

        .titre-ligne {
            padding: 8px 25px;
            border: 2px solid #b60303;
            border-radius: 999px;
            font-size: 16px;
            color: #b60303;
            font-weight: 500;
            background-color: white;
            white-space: nowrap;
        }


        .container-search {
            margin: 10px 0;
        }

        /* Search Box */
        .search-section {
            background-color: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #e9ecef; */
        }

        .search-section h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #212529;
        }

        .search-box .form-select {
            height: 50px;
            border-radius: 0.5rem;
            border: 1px solid #A6A485;
        }

        .search-box .btn {
            height: 50px;
            width: 50px;
            border-radius: 0.5rem;
            /* border: 1px solid #ced4da; */
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            background-color: #fff;
            color: #b60303;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-box .btn:hover {
            background-color: #f8f9fa;
        }
        p, .presentation-section ul {
    font-size: 17px;
}
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="#">Université de Tunis El Manar</a><span>›</span> Structures de recherche
            </div>
            <h1 class="text-start">Structures de recherche</h1>
        </div>
    </section>

    <!-- Main Content -->
    <main id="main-content" class="container" style="margin-top: 4rem;">
        <!-- Ligne de titre -->
        <div class="titre-ligne-wrapper">
            <div class="ligne-gauche"></div>
            <div class="titre-ligne">Présentation</div>
            <div class="ligne-droite"></div>
        </div>
        <!-- Presentation Section -->
        <!--<section class="presentation-section">
            <h2>Présentation générale :</h2>
            <p>Depuis sa création, l’Université de la Manouba soutient le développement d’une recherche de très haut
                niveau et encourage ses étudiants, enseignants et chercheurs à développer des projets scientifiques
                porteurs d’avenir.</p>
            <p>La recherche, la création, la formation, le transfert des connaissances, l'innovation et l’insertion aux
                réseaux internationaux de savoirs sont au cœur de l’engagement de l’université.</p>
            <p>Aujourd'hui, cet engagement prend le nom : <strong style="color: #b60303;">VISIRECH</strong></p>
            <p><strong style="color: #b60303;">VISIRECH</strong> est une plateforme qui permettra à douze structures de
                recherche de l'UMA de se doter d'une identité propre.</p>
            <p><strong style="color: #b60303;">VISIRECH</strong> est un outil de communication et de veille qui obéit à
                trois richesses. Cette plateforme web s'inscrit au cœur de la stratégie de l'Université de la Manouba
                qui a pour ambition de promouvoir ses structures de recherche afin de leur donner plus de visibilité.
            </p>
            <p>Les avantages de <strong style="color: #b60303;">VISIRECH</strong> sont nombreux pour la gestion des
                publications sur site web:</p>
            <ul>
                <li>Mise en ligne rapide et simple des résultats de sa recherche ;</li>
                <li>Diffusion élargie des travaux de recherche ;</li>
                <li>Gestion de ses travaux ;</li>
                <li>Tous les travaux de recherche en Open Access étant plus cités (facteurs cinquante) que les articles
                    publiés dans les revues papier ;</li>
                <li>Archivage à long terme assurant pérennité et stabilité aux formats et aux URL ;</li>
                <li>Données disponibles, accessibles et interopérables, à partir de n’importe quel ordinateur disposant
                    d’une connexion internet.</li>
            </ul>
        </section>-->

        <section class="presentation-section">
                <h2>Présentation générale :</h2>
                <p>Depuis sa création, l’Université de Tunis El Manar (UTM) soutient le développement d’une recherche de très haut
                    niveau et encourage ses étudiants, enseignants et chercheurs à développer des projets scientifiques
                    porteurs d’avenir.</p>
                <p>La recherche, la création, la formation, le transfert des connaissances, l'innovation et l’insertion aux
                    réseaux internationaux de savoirs sont au cœur de l’engagement de l’université.</p>
                <p>Aujourd'hui, cet engagement se concrétise par : <strong style="color: #b60303;">la plateforme de recherche de l’UTM</strong></p>
                <p><strong style="color: #b60303;">La plateforme de recherche de l’UTM</strong> est une plateforme qui permettra à douze structures de
                    recherche de l’UTM de se doter d'une identité propre.</p>
                <p><strong style="color: #b60303;">La plateforme de recherche de l’UTM</strong> est un outil de communication et de veille qui obéit à
                    trois richesses. Cette plateforme web s'inscrit au cœur de la stratégie de l'Université de Tunis El Manar (UTM)
                    qui a pour ambition de promouvoir ses structures de recherche afin de leur donner plus de visibilité.
                </p>
                <p>Les avantages de <strong style="color: #b60303;">la plateforme de recherche de l’UTM</strong> sont nombreux pour la gestion des
                    publications sur site web :</p>
                <ul>
                    <li>Mise en ligne rapide et simple des résultats de sa recherche ;</li>
                    <li>Diffusion élargie des travaux de recherche ;</li>
                    <li>Gestion de ses travaux ;</li>
                    <li>Tous les travaux de recherche en Open Access étant plus cités (facteur cinquante) que les articles
                        publiés dans les revues papier ;</li>
                    <li>Archivage à long terme assurant pérennité et stabilité aux formats et aux URL ;</li>
                    <li>Données disponibles, accessibles et interopérables, à partir de n’importe quel ordinateur disposant
                        d’une connexion internet.</li>
                </ul>
            </section>


        <!-- Ligne de titre -->
        <div class="titre-ligne-wrapper">
            <div class="ligne-gauche"></div>
            <div class="titre-ligne">Structures de recherche</div>
            <div class="ligne-droite"></div>
        </div>
        <!-- Publication List -->
        <!-- Search Section -->
        <section class="search-section my-5">
            <h2>Recherche</h2>
            <div class="search-box">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-5">
                        <select id="domainSelect" class="form-select" aria-label="Domaine">
                            <option value="" selected>Domaine</option>
                            <option value="Sciences Physiques">Sciences Physiques</option>
                            <option value="Énergies Renouvelables">Énergies Renouvelables</option>
                            <option value="Biologie">Biologie</option>
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <select id="keywordsSelect" class="form-select" aria-label="Etablissement">
                            <option value="" selected>Etablissement</option>
                        </select>
                    </div>
                    <div class="col-lg-2 d-flex justify-content-end">
                        <button id="applyBtn" class="btn me-2" aria-label="Apply Filters">
                            <img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-checkmark.png"
                                alt="Icon-checkmark">
                        </button>
                        <button id="resetBtn" class="btn" aria-label="Reset Filters">
                            <img width="20px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-refresh.png"
                                alt="Icon-refresh">
                        </button>
                    </div>
                </div>
            </div>
        </section>


        <div id="publicationsContainer" class="row g-4">
            <!-- Publication Card 1 -->
            <div class="col-lg-6 publication-item" data-domain="Sciences Physiques,Énergies Renouvelables"
                data-keywords="Innovation,Projets">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up">
                    </a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="Icon-calendar">
                        12 mars 2024
                    </div>
                    <h3>Biochimie et Biotechnologie</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Faculté des sciences de Tunis</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Sciences Physiques, Énergies Renouvelables</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél. : 70866336 / 70866337</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 2 -->
            <div class="col-lg-6 publication-item" data-domain="Biologie" data-keywords="Recherche">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up"></a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="blanc">
                        12 mars 2024
                    </div>
                    <h3>Annonce de séminaire</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Université de la Manouba</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Biologie</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél: 71 600 444 - 71 600 999</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 3 -->
            <div class="col-lg-6 publication-item" data-domain="Sciences Physiques" data-keywords="Recherche">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up"></a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="Icon-calendar">
                        12 mars 2024
                    </div>
                    <h3>Appel à projets</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Université de la Manouba</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Sciences Physiques</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél: 71 600 444 - 71 600 999</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 4 -->
            <div class="col-lg-6 publication-item" data-domain="Énergies Renouvelables" data-keywords="Projets">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up"></a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="Icon-calendar">
                        12 mars 2024
                    </div>
                    <h3>Journée d'étude</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Université de la Manouba</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Énergies Renouvelables</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél: 71 600 444 - 71 600 999</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 5 -->
            <div class="col-lg-6 publication-item" data-domain="Biologie" data-keywords="Innovation">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up"></a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="Icon-calendar">
                        12 mars 2024
                    </div>
                    <h3>Conférence internationale</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Université de la Manouba</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Biologie</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél: 71 600 444 - 71 600 999</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 6 -->
            <div class="col-lg-6 publication-item" data-domain="Sciences Physiques,Énergies Renouvelables"
                data-keywords="Projets">
                <div class="publication-card">
                    <a href="/presentation-utm" class="card-icon-link"><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up red.png"
                            alt="Icon-diagonal-arrow-right-up"></a>
                    <div class="date-tag">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                            alt="Icon-calendar">
                        12 mars 2024
                    </div>
                    <h3>Lancement d'un nouveau master</h3>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                            alt="Icon-pin">
                        <span>Université de la Manouba</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Icon-person">
                        <span>Responsable : Master Pro</span>
                    </div>
                    <div class="info-line">
                        <img class="me-2" width="17px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                            alt="Icon-phone">
                        <span>Tél: 71 600 444 - 71 600 999</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="noResultsMessage" class="text-center fs-4 mt-5" style="display: none;">
            Aucune publication ne correspond à votre recherche.
        </div>

        <div class="text-center m-5">
            <a href="#" class="btn-view-more">Voir plus</a>
        </div>
    </main>



    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const domainSelect = document.getElementById('domainSelect');
            const keywordsSelect = document.getElementById('keywordsSelect');
            const applyBtn = document.getElementById('applyBtn');
            const resetBtn = document.getElementById('resetBtn');
            const publicationsContainer = document.getElementById('publicationsContainer');
            const publicationItems = publicationsContainer.querySelectorAll('.publication-item');
            const noResultsMessage = document.getElementById('noResultsMessage');

            function filterPublications() {
                const selectedDomain = domainSelect.value;
                const selectedKeyword = keywordsSelect.value;
                let visibleCount = 0;

                publicationItems.forEach(item => {
                    const itemDomains = item.dataset.domain.split(',');
                    const itemKeywords = item.dataset.keywords.split(',');

                    const domainMatch = !selectedDomain || itemDomains.includes(selectedDomain);
                    const keywordMatch = !selectedKeyword || itemKeywords.includes(selectedKeyword);

                    if (domainMatch && keywordMatch) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            applyBtn.addEventListener('click', filterPublications);

            resetBtn.addEventListener('click', () => {
                domainSelect.value = '';
                keywordsSelect.value = '';
                filterPublications();
            });
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

<!--
<script>
(function () {

  const restBase = (window.PMSettings?.restUrl || '/wp-json/');
  const endpoint = restBase + 'plateforme-recherche/v1/laboratoire?per_page=100&orderby=denomination&order=ASC&statut=Actif';


  const container = document.getElementById('publicationsContainer');
  const noResults = document.getElementById('noResultsMessage');
  const domainSelect   = document.getElementById('domainSelect');
  const keywordsSelect = document.getElementById('keywordsSelect'); // on s’en sert pour les axes éventuels
  const applyBtn = document.getElementById('applyBtn');
  const resetBtn = document.getElementById('resetBtn');

  // Utilitaires
  const icon = (name) => `/wp-content/plugins/plateforme-master/images/SiteRechercheImages/${name}`;

  function parseAxes(axes_json){
    try {
      if (!axes_json) return [];
      const v = JSON.parse(axes_json);
      return Array.isArray(v) ? v : [];
    } catch(e){ return []; }
  }

  function buildCard(l){
    const axes  = parseAxes(l.axes_recherche);
    const keys  = axes.join(',');
    const dom   = (l.domaine || '').trim();
    const lieu  = l.etablissement_nom|| '—';
    const resp  = l.directeur_nom || '—';
    const phone = l.tel || '';
    const href  = `/presentation-utm/?laboratoire?id=${encodeURIComponent(l.id)}`; // adapte l’URL de détail si besoin

    return `
      <div class="col-lg-6 publication-item" data-domain="${dom}" data-keywords="${keys}" data-etab-id="${l.etablissement_id}" data-etab="${l.etablissement_nom || l.etablissement_label}" >
        <div class="publication-card">
          <a href="${href}" class="card-icon-link">
            <img width="20" src="${icon('27) Icon-diagonal-arrow-right-up red.png')}" alt="Ouvrir">
          </a>

          <div class="date-tag">
            <img width="15" src="${icon('blanc.png')}" alt="">
            ${l.date_creation ? new Date(l.date_creation).toLocaleDateString('fr-FR') : '—'}
          </div>

          <h3>${l.denomination || 'Laboratoire'}</h3>

          <div class="info-line">
            <img class="me-2" width="15" src="${icon('27) Icon-pin.png')}" alt="Établissement">
            <span>${lieu}</span>
          </div>

          <div class="info-line">
            <img class="me-2" width="15" src="${icon('27) Icon-person.png')}" alt="Directeur">
            <span>Responsable : ${resp}</span>
          </div>

          ${phone ? `
          <div class="info-line">
            <img class="me-2" width="17" src="${icon('27) Icon-phone.png')}" alt="Téléphone">
            <span>Tél : ${phone}</span>
          </div>` : ''}

          ${dom ? `
          <div class="info-line">
            <i class="fa-solid fa-tag"></i>
            <span>Domaine : ${dom}</span>
          </div>` : ''}

          ${axes.length ? `
          <div class="info-line">
            <i class="fa-solid fa-list"></i>
            <span>Axes : ${axes.slice(0,3).join(' • ')}${axes.length>3?'…':''}</span>
          </div>` : ''}

        </div>
      </div>
    `;
  }

  function fillDomainOptions(rows){
    const uniq = new Set(rows.map(r => (r.domaine || '').trim()).filter(Boolean));
    // garde « Domaine » comme premier choix
    domainSelect.innerHTML = `<option value="" selected>Domaine</option>` +
      Array.from(uniq).sort().map(d => `<option value="${d}">${d}</option>`).join('');
  }

  function fillKeywordOptions(rows) {
    const map = new Map(); // id -> nom
    rows.forEach(r => {
        const id  = (r.etablissement_id ?? '').toString().trim();
        const nom = (r.etablissement_nom || r.etablissement_label || '').trim();
        if (id && nom && !map.has(id)) map.set(id, nom);
    });

    const opts = Array.from(map.entries())
        .sort((a, b) => a[1].localeCompare(b[1], 'fr'))
        .map(([id, nom]) => `<option value="${id}">${nom}</option>`)
        .join('');

    keywordsSelect.innerHTML = `<option value="" selected>Etablissement</option>` + opts;
    }


  /*function applyFilters(){
    const selDom  = domainSelect.value;
    const selKey  = keywordsSelect.value;
    let visible = 0;

    container.querySelectorAll('.publication-item').forEach(el => {
      const dom  = (el.dataset.domain || '');
      const keys = (el.dataset.keywords || '').split(',').filter(Boolean);
      const okDom = !selDom || dom === selDom;
      const okKey = !selKey || keys.includes(selKey);

      if (okDom && okKey) {
        el.style.display = '';
        visible++;
      } else {
        el.style.display = 'none';
      }
    });

    noResults.style.display = visible === 0 ? 'block' : 'none';
  }*/

    function applyFilters(){
    const selDom  = (domainSelect.value || '').trim();
    const selEtab = (keywordsSelect.value || '').trim(); // établissement (ID)
    let visible = 0;

    container.querySelectorAll('.publication-item').forEach(el => {
        const itemDom      = (el.dataset.domain || '').trim();
        const itemEtabId   = (el.dataset.etabId || '').trim(); // ex. "2"
        const itemEtabName = (el.dataset.etab   || '').trim(); // ex. "Faculté des sciences de Tunis"

        const okDom  = !selDom  || itemDom === selDom;
        // on accepte l’ID (recommandé) et, si besoin, le nom (fallback)
        const okEtab = !selEtab || itemEtabId === selEtab || itemEtabName === selEtab;

        if (okDom && okEtab) {
        el.style.display = '';
        visible++;
        } else {
        el.style.display = 'none';
        }
    });

    noResults.style.display = visible === 0 ? 'block' : 'none';
    }


  async function loadLabs(){
    try{
      container.innerHTML = '<div class="col-12 text-center">Chargement…</div>';
      const res = await fetch(endpoint, { credentials: 'same-origin' }); // GET public
      const rows = await res.json();

      // rendu
      container.innerHTML = rows.map(buildCard).join('') || `<div class="col-12 text-center">Aucun laboratoire</div>`;

      // filtres dynamiques
      fillDomainOptions(rows);
      fillKeywordOptions(rows);

      // actions filtres
      document.getElementById('applyBtn')?.addEventListener('click', applyFilters);
      document.getElementById('resetBtn')?.addEventListener('click', () => {
        domainSelect.value = '';
        keywordsSelect.value = '';
        applyFilters();
      });
    } catch(e){
      console.error(e);
      container.innerHTML = `<div class="col-12 text-center text-danger">Erreur de chargement</div>`;
    }
  }

  // go
  loadLabs();
})()
</script>
-->

<script>
(function () {
  const restBase = (window.PMSettings?.restUrl || '/wp-json/');
  const endpoint = restBase + 'plateforme-recherche/v1/laboratoire?per_page=100&orderby=denomination&order=ASC&statut=Actif';

  const container    = document.getElementById('publicationsContainer');
  const noResults    = document.getElementById('noResultsMessage');
  const domainSelect = document.getElementById('domainSelect');
  const etabSelect   = document.getElementById('keywordsSelect'); // Établissement
  const applyBtn     = document.getElementById('applyBtn');
  const resetBtn     = document.getElementById('resetBtn');
  const viewMoreBtn  = document.querySelector('.btn-view-more');

  const PAGE_SIZE = 4;
  let ALL_ROWS = [];
  let FILTERED_ROWS = [];
  let rendered = 0;

  // === Utils
  const icon = (name) => `/wp-content/plugins/plateforme-master/images/SiteRechercheImages/${name}`;
  function parseAxes(json){ try{ const v = JSON.parse(json||'[]'); return Array.isArray(v)?v:[]; }catch(e){ return []; } }

  // === Carte labo
  function buildCard(l){
    const axes  = parseAxes(l.axes_recherche);
    const dom   = (l.domaine || '').trim();
    const lieu  = (l.etablissement_nom || l.etablissement_label || '—');
    const resp  = l.directeur_nom || '—';
    const phone = l.tel || '';
    const href  = `/presentation-utm/?laboratoireid=${encodeURIComponent(l.id)}`;

    return `
      <div class="col-lg-6 publication-item"
           data-domain="${dom}"
           data-etab-id="${l.etablissement_id || ''}"
           data-etab="${lieu}">
        <div class="publication-card">
          <a href="${href}" class="card-icon-link">
            <img width="20" src="${icon('27) Icon-diagonal-arrow-right-up red.png')}" alt="Ouvrir">
          </a>

          <div class="date-tag">
            <img width="15" src="${icon('blanc.png')}" alt="">
            ${l.date_creation ? new Date(l.date_creation).toLocaleDateString('fr-FR') : '—'}
          </div>

          <h3>${l.denomination || 'Laboratoire'}</h3>

          <div class="info-line">
            <img class="me-2" width="15" src="${icon('27) Icon-pin.png')}" alt="Établissement">
            <span>${lieu}</span>
          </div>

          <div class="info-line">
            <img class="me-2" width="15" src="${icon('27) Icon-person.png')}" alt="Directeur">
            <span>Responsable : ${resp}</span>
          </div>

          ${phone ? `
          <div class="info-line">
            <img class="me-2" width="17" src="${icon('27) Icon-phone.png')}" alt="Téléphone">
            <span>Tél : ${phone}</span>
          </div>` : ''}

          ${dom ? `
          <div class="info-line">
            <i class="fa-solid fa-tag"></i>
            <span>Domaine : ${dom}</span>
          </div>` : ''}

          ${axes.length ? `
          <div class="info-line">
            <i class="fa-solid fa-list"></i>
            <span>Axes : ${axes.slice(0,3).join(' • ')}${axes.length>3?'…':''}</span>
          </div>` : ''}

        </div>
      </div>
    `;
  }

  // === Remplissage des filtres depuis la liste complète
  function fillDomainOptions(rows){
    const uniq = new Set(rows.map(r => (r.domaine || '').trim()).filter(Boolean));
    domainSelect.innerHTML = `<option value="" selected>Domaine</option>` +
      Array.from(uniq).sort((a,b)=>a.localeCompare(b,'fr'))
      .map(d => `<option value="${d}">${d}</option>`).join('');
  }
  function fillEtabOptions(rows){
    const map = new Map(); // id -> nom
    rows.forEach(r => {
      const id  = (r.etablissement_id ?? '').toString().trim();
      const nom = (r.etablissement_nom || r.etablissement_label || '').trim();
      if (id && nom && !map.has(id)) map.set(id, nom);
    });
    const opts = Array.from(map.entries())
      .sort((a,b)=>a[1].localeCompare(b[1],'fr'))
      .map(([id,nom]) => `<option value="${id}">${nom}</option>`).join('');
    etabSelect.innerHTML = `<option value="" selected>Etablissement</option>` + opts;
  }

  // === Filtrage en mémoire (sur ALL_ROWS)
  function filterRowsFromSelections(){
    const selDom  = (domainSelect.value || '').trim();
    const selEtab = (etabSelect.value   || '').trim(); // ID
    return ALL_ROWS.filter(r => {
      const dom    = (r.domaine || '').trim();
      const etabId = (r.etablissement_id ?? '').toString().trim();
      const okDom  = !selDom  || dom === selDom;
      const okEtab = !selEtab || etabId === selEtab;
      return okDom && okEtab;
    });
  }

  // === Rendu paginé (4 par 4)
  function updateViewMore(){
    if (!viewMoreBtn) return;
    viewMoreBtn.style.display = (rendered >= FILTERED_ROWS.length) ? 'none' : '';
  }
  function renderNext(n){
    const slice = FILTERED_ROWS.slice(rendered, rendered + n);
    if (!slice.length) { updateViewMore(); return; }
    container.insertAdjacentHTML('beforeend', slice.map(buildCard).join(''));
    rendered += slice.length;
    updateViewMore();
  }
  function renderReset(){
    container.innerHTML = '';
    rendered = 0;
    if (FILTERED_ROWS.length === 0){
      noResults.style.display = 'block';
      if (viewMoreBtn) viewMoreBtn.style.display = 'none';
      return;
    }
    noResults.style.display = 'none';
    renderNext(PAGE_SIZE);
  }

  // === Appliquer les filtres (et reset pagination)
  function applyFilters(){
    FILTERED_ROWS = filterRowsFromSelections();
    renderReset();
  }

  // === Chargement initial
  async function loadLabs(){
    try {
      container.innerHTML = '<div class="col-12 text-center">Chargement…</div>';
      const res  = await fetch(endpoint, { credentials: 'same-origin' });
      const rows = await res.json();

      ALL_ROWS = Array.isArray(rows) ? rows : [];
      fillDomainOptions(ALL_ROWS);
      fillEtabOptions(ALL_ROWS);

      FILTERED_ROWS = ALL_ROWS.slice(); // sans filtre au départ
      renderReset();

      // Events
      applyBtn?.addEventListener('click', (e)=>{ e.preventDefault(); applyFilters(); });
      resetBtn?.addEventListener('click', (e)=>{
        e.preventDefault();
        domainSelect.value = '';
        etabSelect.value   = '';
        applyFilters();
      });
      viewMoreBtn?.addEventListener('click', (e)=>{ e.preventDefault(); renderNext(PAGE_SIZE); });

    } catch (e) {
      console.error(e);
      container.innerHTML = `<div class="col-12 text-center text-danger">Erreur de chargement</div>`;
      if (viewMoreBtn) viewMoreBtn.style.display = 'none';
    }
  }

  loadLabs();
})();
</script>


</body>

</html>