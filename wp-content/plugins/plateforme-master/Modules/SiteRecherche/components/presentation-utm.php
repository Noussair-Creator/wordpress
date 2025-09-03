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
        background-color: #ffffff;
    }

    /* Custom Component: Title Divider */
    .titre-ligne-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 60px 0 40px;
        gap: 10px;
        padding: 0 10%;
    }

    .titre-voir-plus-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 60px 0 40px;
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

    .titre-voir-plus-ligne {
        padding: 8px 25px;
        border: 2px solid #b60303;
        border-radius: 10px;
        font-size: 16px;
        color: #b60303;
        font-weight: 500;
        background-color: white;
        white-space: nowrap;
    }

    .titre-voir-plus-ligne a {
        text-decoration: none;
        color: #b60303;
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

    /* Making the hero title responsive */
    .display-3 {
        font-weight: 400 !important;
        max-width: 700px;
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
    }

    #applyBtn,
    #resetBtn {
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        height: 50px;
        /* Match form control height */
        width: 50px;
        border: 1px solid #dee2e6;
    }

    #applyBtn {
        border-color: #b60303;
        color: #b60303;
        background-color: transparent;
    }

    #applyBtn:hover {
        background-color: #b60303;
        color: #fff;
    }

    #resetBtn {
        border-color: #b60303;
        color: #b60303;
        background-color: transparent;
    }

    #resetBtn:hover {
        background-color: #b60303;
        color: #fff;
    }


    /* New Profile Card Design */
    .card-profile-new {
        border: none;
        /* border-radius: 10rem; */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* overflow: hidden; */
        position: relative;

    }

    .card-profile-new:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
    }

    .card-profile-new .card-img-container {
        overflow: hidden;
        border-radius: 1rem 1rem 0 0;
        border-radius: 20px;
    }

    .card-profile-new .card-img-top {
        transition: transform 0.3s ease;
    }

    .card-profile-new:hover .card-img-top {
        transform: scale(1.05);
    }

    .card-profile-new .card-body {
        background: white;
        border-radius: 0 0 1rem 1rem;
    }

    .card-profile-new .card-img-overlay {
        width: 350px;
        /* Restored glassmorphism effect */
        top: 270px;
        /* Position at the bottom */
        height: 90px;
        /* Give the overlay a fixed height */
        background: rgba(10, 10, 10, 0.25);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0 4rem 0rem 0rem;
        /* Match card's bottom corners */
    }

    .linkedin-icon-new {
        background-color: #0077b5;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .linkedin-icon-new:hover {
        background-color: #005582;
    }
</style>


<!-- Hero Section -->
<section class="hero-bg text-white">
    <div class="d-flex align-items-center" style="min-height: 450px; background-color: rgba(10, 20, 40, 0.5);">
        <div class="container">
            <a href="/utm" class="text-white text-decoration-none mb-3 d-inline-block">&larr; Retour</a>
            <h1 class="display-3">Faculté de Droit et des Sciences Politiques de Tunis</h1>
        </div>
    </div>
</section>

<main class="container my-5">
    <!-- Ligne de titre -->
    <div class="titre-ligne-wrapper">
        <div class="ligne-gauche"></div>
        <div class="titre-ligne">Présentation</div>
        <div class="ligne-droite"></div>
    </div>

    <!-- Presentation Content Section -->
    <section class="col-lg-10 mx-auto bg-white p-4 p-md-5 rounded-4 shadow-lg border">
        <h2 class="h3 fw-bold mb-4" style="color: #2a2916;">Présentation générale :</h2>
        <p class="fs-5" style="line-height: 1.6; text-align: justify;">
            La Faculté de Droit et des sciences politiques et économiques de Tunis, (créée en 1960), était
            considérée comme l'une des branches du département des études juridiques et économiques de l'Institut
            des Etudes Supérieures de Tunis. La promulgation du décret n° 645 du 13 octobre 1986 scinda la Faculté
            de Droit et des Sciences Economiques et Politiques de Tunis en deux facultés, l'une offrant des études
            de sciences juridiques et l'autre des études de sciences économiques et politiques. Et c'est ainsi qu'a
            vu le jour la Faculté de Droit et des Sciences Politiques de Tunis.
        </p>
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
                    <img width="20px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-checkmark.png"
                        alt="Icon-checkmark.png">
                </button>
            </div>
            <div class="col-auto">
                <button id="resetBtn" class="btn btn-lg" title="Réinitialiser">
                    <img width="20px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-refresh.png"
                        alt="Icon-refresh.png">
                </button>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="mt-5">
        <div id="teamGrid" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-5">
            <!-- Profile Card 1 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367.png"
                            class="card-img-top" alt="Photo de RACCOUCHE Asma"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">RACCOUCHE Asma</h5>
                                <p class="card-text small mb-0">Droit Civil</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Card 2 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/34.png"
                            class="card-img-top" alt="Photo de BADDOUCHI Asma"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">BADDOUCHI Asma</h5>
                                <p class="card-text small mb-0">Droit Civil</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Card 3 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367 (1).png"
                            class="card-img-top" alt="Photo de AYARI Mounir"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">AYARI Mounir</h5>
                                <p class="card-text small mb-0">Droit Civil</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Card 4 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367.png"
                            class="card-img-top" alt="Photo de BEN SALAH Karim"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">BEN SALAH Karim</h5>
                                <p class="card-text small mb-0">Droit Pénal</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Card 5 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/34.png"
                            class="card-img-top" alt="Photo de MEJRI Leila"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">MEJRI Leila</h5>
                                <p class="card-text small mb-0">Droit International</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Card 6 -->
            <div class="col">
                <div class="card card-profile-new text-white">
                    <div class="card-img-container">
                        <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367 (1).png"
                            class="card-img-top" alt="Photo de CHENNOUFI Zied"
                            style="height: 350px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <h5 class="card-title fw-bold mb-1">CHENNOUFI Zied</h5>
                                <p class="card-text small mb-0">Droit Pénal</p>
                            </div>
                            <a href="/coordonnees" target="_blank" rel="noopener noreferrer" class="linkedin-icon-new">
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
        <div class="titre-voir-plus-ligne"><a href="">Voir Plus</a></div>
    </div>
</main>



<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

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
        // Create a set to store unique domain names
        const domains = new Set();
        profileCards.forEach(card => {
            const domain = card.querySelector('.card-text').textContent.trim();
            if (domain) {
                domains.add(domain);
            }
        });

        // Add each unique domain as an option to the select element
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

                // Check for matches
                const nameMatch = name.includes(searchTerm);
                const domainMatch = selectedDomain === "" || domain === selectedDomain;

                // Show or hide the card
                if (nameMatch && domainMatch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show or hide the "no results" message
            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        }

        // --- Step 3: Add Event Listeners ---
        // Apply button click
        applyBtn.addEventListener('click', filterProfiles);

        // Real-time search on keyup
        searchInput.addEventListener('keyup', filterProfiles);

        // Domain selection change
        domainSelect.addEventListener('change', filterProfiles);

        // Reset button click
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            domainSelect.selectedIndex = 0; // Reset to the "Domaine" placeholder
            filterProfiles(); // Re-apply filters to show all cards
        });
    });
</script>