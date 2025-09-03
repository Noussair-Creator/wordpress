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
        /* A light grey background for better contrast */
    }

    /* Custom Component: Title Divider (from original code) */
    .titre-ligne-wrapper {
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

    /* Utility classes */
    .text-custom-red {
        color: #b60303;
    }


    /* Hero section styling */
    .hero-bg {
        /* Using the same background image path as provided */
        background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
        background-size: cover;
        background-position: center;

    }

    /* Search and Filter Section Styling */
    .search-card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        border: 1px solid #dee2e6;
    }

    .form-control,
    .form-select {
        border-radius: 0.5rem;
        height: 50px;
    }

    .btn-rechercher {
        background-color: #b60303;
        color: white;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
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
        padding: 0.75rem 1.5rem;
    }

    .btn-reinitialiser:hover {
        background-color: #f8f9fa;
        color: #b60303;
    }

    /* Custom styling for the date input group to match design */
    .year-input-group .form-control {
        border-right: 0;
    }

    .year-input-group .input-group-text {
        background-color: white;
        border-left: 0;
    }


    /* New Publication Card Design */
    .publication-card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        border: 1px solid #dee2e6;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .publication-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
    }

    .publication-card h5 {
        color: #212529;
        font-weight: 600;
    }

    .publication-card p {
        color: #000000ff;
        font-size: 0.95rem;
        flex-grow: 1;
        /* Makes description take available space */
    }

    .publication-card-meta {
        font-size: 0.875rem;
        color: #000000ff;
    }

    .publication-card-meta i {
        color: #b60303;
    }

    .publication-arrow {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 56px;
        height: 48px;
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


    .container {
        margin-top: -110px;
    }
</style>


<!-- Hero Section -->
<section class="hero-bg text-white">
    <div class="d-flex align-items-center" style="min-height: 425px; background-color: rgba(10, 20, 40, 0.5);">
        <div class="container">
            <a href="/utm" class="text-white text-decoration-none mb-3 d-inline-block">&larr; Retour</a>
            <h1 class="display-4 fw-bold">Publications</h1>
        </div>
    </div>
</section>

<main class="container">

    <!-- Search/Filter Section -->
    <section class="col-lg-10 mx-auto mt-5">
        <div class="search-card">
            <h2 class="h4 fw-bold mb-4">Recherche</h2>
            <div class="row g-3 align-items-center">
                <!-- Input fields column -->
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <select class="form-select">
                                <option selected>Domaine</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select">
                                <option selected>Auteur</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select">
                                <option selected>Type</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group year-input-group">
                                <input type="text" class="form-control" placeholder="Année début et fin">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt text-secondary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Buttons column -->
                <div class="col-lg-3">
                    <div class="d-grid gap-3">
                        <button class="btn btn-reinitialiser">Réinitialiser</button>
                        <button class="btn btn-rechercher">Rechercher</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Publications Grid Section -->
    <section class="mt-5">
        <div id="publicationsGrid" class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Publication Card 1 -->
            <div class="col">
                <div class="publication-card position-relative">
                    <a href="/publications-utm-details" class="publication-arrow">

                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                        <!-- <i class="fas fa-arrow-right"></i> -->

                    </a>
                    <h5>Deep Learning for Brain-Computer Interface Systems</h5>
                    <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles
                        Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux méthodes classiques de traitement du signal. Cette approche ouvre la voie à des
                        applications en neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2 fw-bolder">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person.png">



                            Dr. Sarra Messaoudi
                            (Maître-Assistant, Labo IA & Signal - FDST)
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            <!-- <i class="fas fa-calendar-alt me-2"></i> -->

                            05/08/2025</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 2 -->
            <div class="col">
                <div class="publication-card position-relative">
                    <a href="/publications-utm-details" class="publication-arrow">

                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                        <!--    <i class="fas fa-arrow-right"></i> -->

                    </a>
                    <h5>Deep Learning for Brain-Computer Interface Systems</h5>
                    <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles
                        Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux méthodes classiques de traitement du signal. Cette approche ouvre la voie à des
                        applications en neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2 fw-bolder"> <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person.png">Dr. Sarra Messaoudi
                            (Maître-Assistant, Labo IA & Signal - FDST)</span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            <!-- <i class="fas fa-calendar-alt me-2"></i> -->

                            05/08/2025</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 3 -->
            <div class="col">
                <div class="publication-card position-relative">
                    <a href="/publications-utm-details" class="publication-arrow">

                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                        <!-- <i class="fas fa-arrow-right"></i> -->

                    </a>
                    <h5>Deep Learning for Brain-Computer Interface Systems</h5>
                    <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles
                        Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux méthodes classiques de traitement du signal. Cette approche ouvre la voie à des
                        applications en neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2 fw-bolder"> <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person.png">Dr. Sarra Messaoudi
                            (Maître-Assistant, Labo IA & Signal - FDST)</span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            <!-- <i class="fas fa-calendar-alt me-2"></i> -->

                            05/08/2025</span>
                    </div>
                </div>
            </div>
            <!-- Publication Card 4 -->
            <div class="col">
                <div class="publication-card position-relative">
                    <a href="/publications-utm-details" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">


                        <!-- <i class="fas fa-arrow-right"></i> -->


                    </a>
                    <h5>Deep Learning for Brain-Computer Interface Systems</h5>
                    <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles
                        Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux méthodes classiques de traitement du signal. Cette approche ouvre la voie à des
                        applications en neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2 fw-bolder"> <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person.png">Dr. Sarra Messaoudi
                            (Maître-Assistant, Labo IA & Signal - FDST)</span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            <!-- <i class="fas fa-calendar-alt me-2"></i> -->

                            05/08/2025</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Load More Button -->
        <div class="text-center m-5">
            <button class="btn btn-voir-plus">Voir plus</button>
        </div>
    </section>
</main>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // All dynamic JavaScript has been removed as requested.
</script>