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
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa;
    }

    /* Custom color */
    .text-custom-red {
        color: #b60303;
    }

    .bg-custom-red {
        background-color: #b60303;
    }


    /* Hero section styling */
    .hero-bg {
        background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
        background-size: cover;
        background-position: center;
        padding: 7rem 0;
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


    /* Main Content Styling */
    .main-content {
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }

    .search-card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        /* border: 1px solid #dee2e6; */
    }

    .search-card .form-select {
        border-color: #d3c8bc;
        border-radius: 0.5rem;
    }

    .search-card .form-select:focus {
        border-color: #c9b9a6;
        box-shadow: 0 0 0 0.2rem rgba(182, 3, 3, 0.1);
    }

    .search-card .btn-icon {
        background-color: #fff;
        /* border: 1px solid #e0e0e0; */
        width: 44px;
        height: 44px;
        border-radius: 0.5rem;
        color: #b60303;
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        transition: all 0.2s ease-in-out;
    }

    .search-card .btn-icon:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.07);
    }

    .project-card {
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='180' height='100' viewBox='0 0 180 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 20 60 Q 60 20 100 60 T 180 60' stroke='%23f5f5f5' fill='transparent' stroke-width='3' stroke-linecap='round'/%3E%3Cpath d='M 20 80 Q 60 40 100 80 T 180 80' stroke='%23f5f5f5' fill='transparent' stroke-width='3' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% + 20px) calc(100% + 10px);
        background-size: 60%;
        /* border: 1px solid #e9ecef; */
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
    }

    .project-card:hover {
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
        border-color: #dee2e6;
    }

    .project-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #212529;
        line-height: 1.4;
    }

    .project-card p {
        font-size: 0.9rem;
        color: #6c757d;
        padding-bottom: 1rem;
    }

    .project-card-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .project-card-meta .value {
        color: #212529;
        font-weight: 600;
    }

    .project-card-meta .advisor-icon {
        font-size: 0.6rem;
        vertical-align: middle;
    }

    .project-card .arrow-link {
        position: absolute;
        top: 0;
        right: 0;
        width: 45px;
        height: 45px;
        background-color: #b60303;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border-radius: 0 1rem 0 1rem;
    }

    .btn-outline-red {
        color: #b60303;
        border-color: #b60303;
        padding: 0.75rem 2rem;
        font-weight: 500;
        border-radius: 8px;
        border-width: 2px;
    }

    .btn-outline-red:hover {
        color: #fff;
        background-color: #b60303;
        border-color: #b60303;
    }

    .footer {
        background-color: #f1f1f1;
        padding: 3rem 0;
        margin-top: 4rem;
    }
</style>


<!-- Hero Section -->
<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                Structures de recherche </a> <span>›</span>Annonces de soutenances
        </div>
        <h1 class="text-start">Annonces de soutenances</h1>
    </div>
</section>

<main class="container main-content">
    <!-- Search Section -->
    <div class="search-card col-lg-10 mx-auto mb-5">
        <h5 class="fw-bold mb-3">Recherche</h5>
        <div class="row g-3 align-items-center">
            <div class="col-lg-5">
                <select id="domainSelect" class="form-select">
                    <option value="" selected>Domaine</option>
                    <option value="Sciences Biologiques & Médicales">Sciences Biologiques & Médicales</option>
                    <option value="Sciences Humaines & Sociales">Sciences Humaines & Sociales</option>
                    <option value="Sciences Exactes & Naturelles">Sciences Exactes & Naturelles</option>
                </select>
            </div>
            <div class="col-lg-5">
                <select id="yearSelect" class="form-select">
                    <option value="" selected>Année universitaire</option>
                    <option value="2024-2025">2024-2025</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2022-2023">2022-2023</option>
                </select>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <button id="applyBtn" class="btn btn-icon me-2">
                    <img width="15px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-checkmark.png"
                        alt="Icon-checkmark">
                </button>
                <button id="resetBtn" class="btn btn-icon">
                    <img width="15px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-refresh.png"
                        alt="Icon-refresh">
                </button>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <section class="col-lg-10 mx-auto">
        <div id="soutenancesGrid" class="row g-5">
            <!-- Project Card 1 -->
            <div class="col-lg-6 project-item" data-domain="Sciences Biologiques & Médicales" data-year="2023-2024">
                <div class="project-card">
                    <a href="#" class="arrow-link"><img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Partenariat avec l'INSAT – Innovation en Energie Durable</h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...
                    </p>
                    <div>
                        <div class="project-card-meta mb-2">
                            <strong>Discipline :</strong>
                            <span class="value">Sciences Biologiques & Médicales</span>
                        </div>
                        <div class="project-card-meta d-flex">
                            <strong class="mt-1">Encadrants :</strong>
                            <div class="ms-2">
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Mohamed Trabelsi</div>
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Sarah Sharbi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 2 -->
            <div class="col-lg-6 project-item" data-domain="Sciences Exactes & Naturelles" data-year="2023-2024">
                <div class="project-card">
                    <a href="#" class="arrow-link"><img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Application de l'IA pour la détection précoce des maladies neurodégénératives
                    </h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...
                    </p>
                    <div>
                        <div class="project-card-meta mb-2">
                            <strong>Discipline :</strong>
                            <span class="value">Sciences Exactes & Naturelles</span>
                        </div>
                        <div class="project-card-meta d-flex">
                            <strong class="mt-1">Encadrants :</strong>
                            <div class="ms-2">
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Ali Ben Salah</div>
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Fatma Cherif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 3 -->
            <div class="col-lg-6 project-item" data-domain="Sciences Humaines & Sociales" data-year="2022-2023">
                <div class="project-card">
                    <a href="#" class="arrow-link"><img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Impact des réseaux sociaux sur les comportements électoraux
                    </h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...
                    </p>
                    <div>
                        <div class="project-card-meta mb-2">
                            <strong>Discipline :</strong>
                            <span class="value">Sciences Humaines & Sociales</span>
                        </div>
                        <div class="project-card-meta d-flex">
                            <strong class="mt-1">Encadrants :</strong>
                            <div class="ms-2">
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Karim Ben Amor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 4 -->
            <div class="col-lg-6 project-item" data-domain="Sciences Biologiques & Médicales" data-year="2022-2023">
                <div class="project-card">
                    <a href="#" class="arrow-link"><img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Développement de nouvelles thérapies ciblées contre le cancer
                    </h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...
                    </p>
                    <div>
                        <div class="project-card-meta mb-2">
                            <strong>Discipline :</strong>
                            <span class="value">Sciences Biologiques & Médicales</span>
                        </div>
                        <div class="project-card-meta d-flex">
                            <strong class="mt-1">Encadrants :</strong>
                            <div class="ms-2">
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Leila Mezghani</div>
                                <div class="value"><i class="fas fa-play advisor-icon text-custom-red me-2"></i>Pr.
                                    Sami Kallel</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="noResultsMessage" class="text-center my-5" style="display: none;">
            <h4>Aucune annonce ne correspond à vos critères de recherche.</h4>
        </div>

        <div class="text-center my-4">
            <a href="#" class="btn btn-outline-red">Voir plus</a>
        </div>
    </section>
</main>


<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const domainSelect = document.getElementById('domainSelect');
        const yearSelect = document.getElementById('yearSelect');
        const applyBtn = document.getElementById('applyBtn');
        const resetBtn = document.getElementById('resetBtn');
        const projectItems = document.querySelectorAll('.project-item');
        const noResultsMessage = document.getElementById('noResultsMessage');

        function filterSoutenances() {
            const selectedDomain = domainSelect.value;
            const selectedYear = yearSelect.value;
            let visibleCount = 0;

            projectItems.forEach(item => {
                const itemDomain = item.dataset.domain;
                const itemYear = item.dataset.year;

                const domainMatch = !selectedDomain || itemDomain === selectedDomain;
                const yearMatch = !selectedYear || itemYear === selectedYear;

                if (domainMatch && yearMatch) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        applyBtn.addEventListener('click', filterSoutenances);

        resetBtn.addEventListener('click', function () {
            domainSelect.value = '';
            yearSelect.value = '';
            filterSoutenances();
        });
    });
</script>