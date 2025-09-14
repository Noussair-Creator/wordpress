<style>
/* Hero section styling */
.hero-bg {
    background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
    background-size: cover;
    background-position: center;
    padding: 10rem 0 12rem;
    color: white;
}

.hero-bg h1 {
    font-size: 50px;
    width: 340px;
    font-weight: 700;
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


/* Search and Filter Section Styling */
.search-card {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
    margin-top: -110px;
    position: relative;
    z-index: 10;
}

.form-control,
.form-select {
    border-radius: 0.5rem;
    height: 50px;
    border: 1px solid #A6A485;
}

.btn-rechercher {
    background-color: #b60303;
    color: white;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    height: 50px;
}

.btn-rechercher:hover {
    background-color: #930202;
    color: white;
}

.btn-reinitialiser {
    background-color: #ffffff;
    color: #b60303;
    border: 1px solid #b60303;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    font-weight: 500;
    height: 50px;
}

.btn-reinitialiser:hover {
    background-color: #f8f9fa;
}

/* Publication Card Design */
.publication-card {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='250' height='250' viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23f9f9f9' stroke-width='1.5'%3E%3Cpath d='M 200 100 A 100 100 0 0 1 100 200'/%3E%3Cpath d='M 180 100 A 80 80 0 0 1 100 180'/%3E%3C/g%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: calc(100% + 40px) calc(100% + 40px);
}

.publication-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}

.publication-card h5 {
    color: #212529;
    font-weight: 700;
    font-size: 1.1rem;
}

.publication-card p {
    color: #555;
    font-size: 0.95rem;
    flex-grow: 1;
}

.publication-card-meta {
    font-size: 0.875rem;
    color: #444;
    border-top: none;
}

.publication-card-meta i {
    color: #b60303;
}

.publication-arrow {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 50px;
    height: 50px;
    background-color: #b60303;
    color: white;
    border-radius: 0px 16px;
    display: grid;
    place-items: center;
    text-decoration: none;
}

.publication-arrow:hover {
    background-color: #930202;
    color: white;
}

/* "Voir plus" Button */
.btn-voir-plus {
    border: 1px solid #b60303;
    color: #b60303;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    font-weight: 500;
}

.btn-voir-plus:hover {
    background-color: #b60303;
    color: white;
}



/* Font Utility Classes */
.fs-12 {
    font-size: 12px !important;
}

.fs-14 {
    font-size: 14px !important;
}

.fs-16 {
    font-size: 16px !important;
}

.fs-18 {
    font-size: 18px !important;
}

.fs-20 {
    font-size: 20px !important;
}

.fw-300 {
    font-weight: 300 !important;
}

.fw-400 {
    font-weight: 400 !important;
}

.fw-500 {
    font-weight: 500 !important;
}

.fw-600 {
    font-weight: 600 !important;
}

.fw-700 {
    font-weight: 700 !important;
}
</style>


<!-- Hero Section -->
<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span><a href="/structures-de-recherche-utm">Structures
                de
                recherche</a><span>›</span>Manifestation
        </div>
        <h1 class="text-start">Manifestation</h1>
    </div>
</section>

<main class="container">

    <!-- Search/Filter Section -->
    <section class="col-lg-12 mx-auto">
        <div class="search-card">
            <h2 class="h4 fw-bolder mb-4">Recherche</h2>
            <form id="searchForm">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-md-8">
                        <select id="categorySelect" class="form-select">
                            <option value="" selected>Catégorie</option>
                            <option value="Conférence">Conférence</option>
                            <option value="Atelier">Atelier</option>
                            <option value="Appels à projets">Appels à projets</option>
                            <option value="Séminaire">Séminaire</option>
                            <option value="Colloque">Colloque</option>
                            <option value="Webinaire">Webinaire</option>
                            <option value="Symposium">Symposium</option>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <div class="d-flex gap-2 fw-bolder">
                            <button type="reset" class="btn btn-reinitialiser fw-bold">Réinitialiser</button>
                            <button type="submit" class="btn btn-rechercher fw-bold">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Publications Grid Section -->
    <section class="mt-5">
        <div id="publicationsGrid" class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Card 1 -->
            <div class="col" data-category="Conférence">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.
                    </p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Conférence
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            20/10/2025
                        </span>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col" data-category="Atelier">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Atelier
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            05/11/2025
                        </span>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col" data-category="Appels à projets">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Appels à projets
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            30/09/2025
                        </span>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col" data-category="Séminaire">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Séminaire
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            15/01/2026
                        </span>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col" data-category="Colloque">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Colloque
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            22/03/2026
                        </span>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col" data-category="Appels à projets">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Appels à projets
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            01/12/2025
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <!-- No results message -->
        <div id="noResultsMessage" class="text-center p-5" style="display: none;">
            <h4>Aucune manifestation ne correspond à vos critères de recherche.</h4>
        </div>

        <!-- Load More Button -->
        <div class="text-center m-5">
            <button id="loadMoreBtn" class="btn btn-voir-plus">Voir plus</button>
        </div>
    </section>
</main>




<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const categorySelect = document.getElementById('categorySelect');
    const publicationsGrid = document.getElementById('publicationsGrid');
    const cards = publicationsGrid.querySelectorAll('.col');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const loadMoreBtnContainer = document.getElementById('loadMoreBtn').parentElement;

    function handleFilter() {
        const selectedCategory = categorySelect.value;
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCategory = card.dataset.category;
            const isVisible = !selectedCategory || cardCategory === selectedCategory;

            card.style.display = isVisible ? 'block' : 'none';
            if (isVisible) {
                visibleCount++;
            }
        });

        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        loadMoreBtnContainer.style.display = visibleCount === 0 ? 'none' : 'block';
    }

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        handleFilter();
    });

    searchForm.addEventListener('reset', function() {
        setTimeout(() => {
            cards.forEach(card => {
                card.style.display = 'block';
            });
            noResultsMessage.style.display = 'none';
            loadMoreBtnContainer.style.display = 'block';
        }, 0);
    });
});
</script>