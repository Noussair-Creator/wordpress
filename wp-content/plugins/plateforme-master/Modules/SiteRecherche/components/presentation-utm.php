<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biochimie et Biotechnologie - Université de Tunis El Manar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* General body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

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

        /* Custom Component: Title Divider */

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


        .titre-voir-plus-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 60px 0 40px;
        }

        .titre-voir-plus-ligne {
            padding: 8px 35px;
            border: 2px solid #b60303;
            border-radius: 10px;
            font-size: 16px;
            color: #b60303;
            font-weight: 500;
            background-color: transparent;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .titre-voir-plus-ligne a {
            text-decoration: none;
            color: #b60303;
        }

        .titre-voir-plus-ligne:hover {
            background-color: #b60303;
        }

        .titre-voir-plus-ligne:hover a {
            color: white;
        }


        /* Utility classes */
        .text-custom-red {
            color: #b60303;
        }

        /* Hero section styling */
        .hero-bg {
            background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3329.png');
            background-size: cover;
            background-position: center;
        }

        .display-3 {
            font-weight: 600 !important;
            font-size: 2.8rem;
        }

        /* Search and Filter Section Styling */
        .search-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            height: 50px;
            border: 1px solid #A6A485;
        }

        .form-select:focus {
            border-color: #b60303;
            box-shadow: 0 0 0 0.25rem rgba(182, 3, 3, 0.25);
        }

        #applyBtn,
        #resetBtn {
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            border: 1px solid #dee2e6;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        }

        #applyBtn {
            color: #b60303;
            background-color: transparent;
        }

        #applyBtn:hover {
            background-color: #b60303;
            color: #fff;
        }

        #resetBtn {
            /* border-color: #6c757d; */
            color: #b60303;
            background-color: transparent;
        }

        #resetBtn:hover {
            background-color: #6c757d;
            color: #fff;
        }

        /* New Profile Card Design */
        .card-profile-new {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
            /* overflow: hidden; */
            cursor: pointer;
            position: relative;
            height: 350px;
        }

        .card-profile-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        }

        .card-profile-new .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
        }



        .card-profile-new .card-body {
            position: absolute;
            bottom: -12px;
            left: 0px;
            right: 0px;
            background: rgba(10, 10, 10, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0px 55px 0px 0px;
            width: 350px;
            height: 90px;
            z-index: 2;
        }

        .card-profile-new .card-title {
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.1rem;
            font-size: 1.1rem;
        }

        .card-profile-new .card-text {
            color: #e9ecef;
            font-size: 0.85rem;
        }

        .linkedin-icon-new {
            background-color: #0077b5;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            text-decoration: none;
            transition: background-color 0.2s ease;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .linkedin-icon-new:hover {
            background-color: #005582;
        }

        /* Chef de Structure Section */
        .chef-structure {
            margin-top: 2rem;
            padding-top: 1.5rem;
            /* border-top: 1px solid #eee; */
        }

        .chef-structure img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Footer */
        .footer {
            background-color: white;
            padding: 40px 0;
            border-top: 1px solid #e0e0e0;
        }

        .footer-logo {
            height: 60px;
        }

        .presentation-content-section {
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="#">Université de Tunis El Manar</a><span>›</span> <a
                    href="/structures-de-recherche-utm">Structures de recherche</a>
                <span>›</span> Structures de recherche
            </div>
            <h1 class="text-start">Biochimie et Biotechnologie</h1>
        </div>
    </section>

    <main class="container my-5">
        <!-- Ligne de titre -->
        <div class="titre-ligne-wrapper">
            <div class="ligne-gauche"></div>
            <div class="titre-ligne">Présentation général</div>
            <div class="ligne-droite"></div>
        </div>

        <!-- Presentation Content Section -->
        <section class="col-lg-10 mx-auto bg-white p-4 p-md-5 rounded-4 presentation-content-section">
            <h4 class="fw-bold mb-4" style="color: #2a2916;">Présentation général :</h4>
            <p class="fs-6" style="line-height: 1.7; font-weight:500;">
                Le Laboratoire de Biochimie et de Technobiologie, LAB-B-03 (LR 01ES 05), a été créé en décembre 2001
                sous la direction du Pr Omrane BELHADJ.
            </p>
            <p class="fs-6 mt-3" style="line-height: 1.7; font-weight:500;">Le thème principal développé par le
                laboratoire
                est le rôle
                de l'évolution des gènes et des génomes dans l'adaptation des organismes. Ce thème est étudié à travers
                les axes de recherche suivants :</p>

            <div class="fs-6" style="line-height: 1.8; font-weight:500;">
                <p>1) Un premier axe de santé publique : Mécanismes moléculaires, évolution et dissémination de la
                    résistance bactérienne aux antibiotiques - Alternatives à l'antibiothérapie.</p>
                <p>2) Un deuxième axe également de santé publique, développé en collaboration avec l'INSP : la nutrition
                    et les maladies métaboliques. L'étude porte en particulier sur l'implication de marqueurs
                    moléculaires dans la physiopathologie de l'obésité et du diabète type 2.</p>
                <p>3) Un troisième axe relevant de la prévention et la gestion de la résistance aux insecticides :
                    l'étude de l'impact des éléments transposables sur la résistance aux insecticides et le transfert
                    horizontal.</p>
                <p>4) Partenaires microbiens constitutifs des holobiontes comme alternatives à l'antibiothérapie et aux
                    pesticides.</p>
            </div>

            <div class="chef-structure">
                <h5 class="fw-bold mb-3" style="color: #2a2916;">Chef de Structure de recherche :</h5>
                <div class="d-flex align-items-center">
                    <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/34.png"
                        alt="Chef de Structure" class="me-3">
                    <p class="mb-0 text-dark fw-600">Omrane BELHADJ</p>
                </div>
            </div>
        </section>

        <!-- Ligne de titre -->
        <div class="titre-ligne-wrapper">
            <div class="ligne-gauche"></div>
            <div class="titre-ligne">Annuaire</div>
            <div class="ligne-droite"></div>
        </div>

        <!-- Search/Filter Section -->
        <section class="col-lg-10 mx-auto mt-5">
            <div class="row g-3 align-items-center">
                <div class="col-md position-relative">
                    <input type="text" id="searchInput" placeholder="Nom et prénom"
                        class="form-control form-control-lg pe-5">
                    <img width="20px" class="search-icon"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-search.png"
                        alt="Icon-search.png">
                </div>
                <div class="col-md">
                    <select id="domainSelect" class="form-select form-select-lg">
                        <option value="" selected>Domaine</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button id="applyBtn" class="btn btn-lg" title="Appliquer">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button id="resetBtn" class="btn btn-lg" title="Réinitialiser">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="mt-5">
            <div id="teamGrid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                <!-- Profile Card 1 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367.png"
                            class="card-img-top" alt="Photo de RACCOUCHE Asma">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">RACCOUCHE Asma</h5>
                                    <p class="card-text small mb-0">Droit Civil</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Card 2 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/34.png"
                            class="card-img-top" alt="Photo de BADDOUCHI Asma" style="background-color: #e9ecef;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">BADDOUCHI Asma</h5>
                                    <p class="card-text small mb-0">Droit Civil</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Card 3 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367 (1).png"
                            class="card-img-top" alt="Photo de AYARI Mounir">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">AYARI Mounir</h5>
                                    <p class="card-text small mb-0">Droit Civil</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Card 4 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/3.png"
                            class="card-img-top" alt="Photo de BEN SALAH Karim">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">BEN SALAH Karim</h5>
                                    <p class="card-text small mb-0">Droit Pénal</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Card 5 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367.png"
                            class="card-img-top" alt="Photo de MEJRI Leila">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">MEJRI Leila</h5>
                                    <p class="card-text small mb-0">Droit International</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Card 6 -->
                <div class="col">
                    <div class="card card-profile-new" data-profile-url="/Coordonnees">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367 (1).png"
                            class="card-img-top" alt="Photo de CHENNOUFI Zied">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">CHENNOUFI Zied</h5>
                                    <p class="card-text small mb-0">Droit Pénal</p>
                                </div>
                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="linkedin-icon-new">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="noResultsMessage" class="text-center fs-4 mt-5" style="display: none;">
                Aucun profil ne correspond à votre recherche.
            </div>
        </section>

        <div class="titre-voir-plus-wrapper">
            <div class="titre-voir-plus-ligne"><a href="#">Voir Plus</a></div>
        </div>
    </main>

    <!-- Footer -->
    <!-- <footer class="footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/logo.png"
                            alt="Footer Logo" class="footer-logo">
                    </div>
                    <div class="col-md-9">
                        <h5 class="fw-bold text-custom-red">Coordonnées :</h5>
                        <p class="mb-1"><i class="fa-solid fa-location-dot me-2 text-custom-red"></i>Campus universitaire -
                            B.P. 248 - El Manar II - 2092 Tunis</p>
                        <p class="mb-1"><i class="fa-solid fa-phone me-2 text-custom-red"></i>71 873 344 - 71 874 748 - 71
                            873 145</p>
                        <p class="mb-0"><i class="fa-solid fa-envelope me-2 text-custom-red"></i>Email: informatique@utm.tn
                        </p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center text-muted small">
                    © 2021 TOUS DROITS RESERVES UNIVERSITE TUNIS EL MANAR
                </div>
            </div>
        </footer>
     -->

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get DOM elements
            const searchInput = document.getElementById('searchInput');
            const domainSelect = document.getElementById('domainSelect');
            const applyBtn = document.getElementById('applyBtn');
            const resetBtn = document.getElementById('resetBtn');
            const teamGrid = document.getElementById('teamGrid');
            const profileCards = teamGrid.querySelectorAll('.col');
            const noResultsMessage = document.getElementById('noResultsMessage');

            // --- Step 1: Populate Domain Select Dropdown ---
            const domains = new Set();
            profileCards.forEach(card => {
                const domain = card.querySelector('.card-text').textContent.trim();
                if (domain) {
                    domains.add(domain);
                }
            });

            domains.forEach(domain => {
                const option = document.createElement('option');
                option.value = domain;
                option.textContent = domain;
                domainSelect.appendChild(option);
            });

            // --- Step 2: Define the Filtering Function ---
            function filterProfiles() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedDomain = domainSelect.value;
                let visibleCount = 0;

                profileCards.forEach(card => {
                    const name = card.querySelector('.card-title').textContent.toLowerCase();
                    const domain = card.querySelector('.card-text').textContent.trim();

                    const nameMatch = name.includes(searchTerm);
                    const domainMatch = selectedDomain === "" || domain === selectedDomain;

                    if (nameMatch && domainMatch) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            // --- Step 3: Add Event Listeners for Filtering ---
            applyBtn.addEventListener('click', filterProfiles);
            searchInput.addEventListener('keyup', filterProfiles);
            domainSelect.addEventListener('change', filterProfiles);

            resetBtn.addEventListener('click', () => {
                searchInput.value = '';
                domainSelect.selectedIndex = 0;
                filterProfiles();
            });

            // --- Step 4: Add Click Handlers for Profile Cards ---
            const clickableCards = document.querySelectorAll('.card-profile-new');
            clickableCards.forEach(card => {
                card.addEventListener('click', function (event) {
                    // Check if the click was on the LinkedIn icon or a child of it
                    if (event.target.closest('.linkedin-icon-new')) {
                        // Let the link's default behavior (opening a new tab) happen
                        return;
                    }

                    // If the click was not on the icon, navigate to the profile page
                    // We need to find the parent <a> tag to get the href
                    const anchor = this.closest('a');
                    if (anchor && anchor.href) {
                        window.location.href = anchor.href;
                    } else {
                        // Fallback for the data-attribute if needed
                        const profileUrl = this.dataset.profileUrl;
                        if (profileUrl) {
                            window.location.href = profileUrl;
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>