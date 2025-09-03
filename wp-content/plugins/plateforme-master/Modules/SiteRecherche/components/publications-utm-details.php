<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication Details</title>
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

        /* Main Content Styling */
        .main-content {
            margin-top: -100px;
            position: relative;
            z-index: 10;
        }

        .details-card {
            text-align: center;
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.07);
            border: 1px solid #dee2e6;
        }

        .summary-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.07);
            border: 1px solid #dee2e6;
            margin-top: 2rem;
        }

        .publication-meta {
            display: flex;
            font-size: 0.95rem;
            color: #495057;
            justify-content: center;
            align-items: center;
            gap: 205px;
        }

        .publication-meta img {
            filter: invert(35%) sepia(85%) saturate(3033%) hue-rotate(346deg) brightness(70%) contrast(110%);
        }

        .summary-card h3 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .summary-card p,
        .summary-card h4 {
            color: #212529;
        }

        .summary-card h4 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .keyword-tag {
            display: inline-block;
            background-color: #b60303;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            text-decoration: none;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .keyword-tag:hover {
            background-color: #930202;
            color: white;
        }

        .file-download-list {
            list-style: none;
            padding-left: 0;
        }

        .file-download-list li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            text-decoration: none;
            color: #212529;
            border-bottom: 1px solid #e9ecef;
        }

        .file-download-list li:last-child a {
            border-bottom: none;
        }

        .file-download-list li a:hover {
            color: #b60303;
        }

        .file-download-list img {
            width: 24px;
            margin-right: 1rem;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg text-white">
        <div class="d-flex align-items-center" style="min-height: 425px; background-color: rgba(10, 20, 40, 0.5);">
            <div class="container">
                <a href="/utm" class="text-white text-decoration-none mb-3 d-inline-block"><i
                        class="fas fa-arrow-left me-2"></i>Retour</a>
                <h1 class="display-5 fw-bold">Publications</h1>
            </div>
        </div>
    </section>

    <main class="container main-content">
        <div class="col-lg-10 mx-auto">
            <!-- Publication Title Card -->
            <section class="details-card ">
                <h2 class="fw-bold mb-4" style="font-size: 2rem;">Deep Learning for Brain-Computer Interface Systems
                </h2>
                <div class="d-flex flex-wrap publication-meta">
                    <div class="me-4 d-flex align-items-center mb-2">
                        <img class="me-2" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Author Icon">
                        <span>Dr. Sarra Messaoudi (Maître-Assistant, Labo IA & Signal - FDST)</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <img class="me-2" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                            alt="Calendar Icon">
                        <span>05/08/2025</span>
                    </div>
                </div>
            </section>

            <!-- Publication Summary & Download Card -->
            <section class="summary-card mb-5">
                <h3>Résumé</h3>
                <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles Transformer pour
                    améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les résultats obtenus sur
                    des bases de données EEG montrent une amélioration de 12 % par rapport aux méthodes classiques de
                    traitement du signal. Cette approche ouvre la voie à des applications en neuro-réhabilitation et
                    contrôle de prothèses intelligentes.</p>

                <h4>Mots clés :</h4>
                <div>
                    <a href="#" class="keyword-tag">Deep learning</a>
                    <a href="#" class="keyword-tag">BCI</a>
                    <a href="#" class="keyword-tag">Neurosciences</a>
                    <a href="#" class="keyword-tag">Signal Processing</a>
                </div>

                <h4>Fichiers à télécharger :</h4>
                <ul class="file-download-list">
                    <li>
                        <a href="#">
                            <!-- Assuming a pdf icon path based on other icons -->
                            <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/pdf-svgrepo-com (2).png"
                                alt="PDF Icon">
                            <span>Deeplearning_BCI_Systems.Pdf</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/pdf-svgrepo-com (2).png"
                                alt="PDF Icon">
                            <span>Poster_Bci2025.Pdf</span>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>