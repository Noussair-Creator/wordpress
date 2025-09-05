<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Établissements - Université de Tunis El Manar</title>
    <link href="https://fonts.googleapis.com/css2?family=Sans+Serif:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        /* General body styles */
        body {
            font-family: 'sans-serif', sans-serif;
            background-color: #f9f9f7;
            margin: 0;
            padding: 0;
            color: #2A2916;
        }

        /* Hero Section Styles */
        /* .hero-section {
        position: relative;
        height: 500px;
        background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;

        text-align: left;

        padding: 0 5%;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
       
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
    }

    .breadcrumbs {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 1.5rem;
        background-color: rgba(76, 76, 76, 0.3);
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
    }

    .hero-content h1 {
        font-size: 50px;

        font-weight: 500;
        margin: 0;

       
    }

    .hero-content .subtitle {
        font-size: 1rem;
        font-weight: 500;
        margin-top: 1rem;
        line-height: 1.6;
        max-width: 600px;
      
    } */
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

        /* Establishments section styles */
        .establishments-section {
            padding: 50px 20px;
            text-align: center;
            margin-top: -120px;
            /* Pulls the section up over the hero */
            position: relative;
            z-index: 3;
        }

        .search-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto 6rem;
            background-color: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            text-align: left;
        }

        .search-container h2 {
            font-size: 20px;
            font-weight: 700;
            color: #2A2916;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 50px 15px 25px;
            /* Adjusted padding for icon on the right */
            font-size: 1rem;
            border: 1px solid #A6A485;
            border-radius: 10px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: #8c8a6e;
        }

        .search-icon {
            position: absolute;
            right: 20px;
            /* Positioned icon to the right */
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            text-align: left;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            text-align: center;
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 10px;
            color: #2A2916;
            min-height: 50px;
        }

        .card-address {
            display: flex;
            align-items: center;
            color: #2A2916;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
            line-height: 1.5;
            flex-grow: 1;
        }

        .address-icon {
            margin-right: 8px;
            flex-shrink: 0;
        }

        .card-button {
            background-color: #fff;
            color: #b60303;
            border: 1px solid #b60303;
            border-radius: 10px;
            padding: 10px 125px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s, color 0.3s;
        }

        .card-button:hover {
            background-color: #b60303;
            color: #fff;
        }

        .no-results-message {
            display: none;
            color: #2A2916;
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 2rem;
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
    </style>
</head>

<body>

    <!-- <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="breadcrumbs">Université de Tunis El Manar > Structures de recherche > Etablissements</p>
            <h1>Établissements</h1>
            <p class="subtitle">
                Découvrez l'ensemble des établissements affiliés à l'Université de Tunis El Manar, leurs équipes,
                projets et productions scientifiques.
            </p>
        </div>
    </header> -->

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                    Structures de recherche </a>
                <span>›</span>Etablissements
            </div>
            <h1 class="text-start">Établissements</h1>
            <p class="subtitle">
                Découvrez l’ensemble des établissements affiliés à l’Université de <br> Tunis El Manar, leurs équipes,
                projets et productions scientifiques
            </p>
        </div>
    </section>


    <main class="establishments-section">
        <div class="search-container">
            <h2>Recherche</h2>
            <div class="search-input-wrapper">
                <input type="text" class="search-input" placeholder="Rechercher un établissement...">
                <span class="search-icon">
                    <img width="20px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-search.png"
                        alt="Icon-search.png">
                </span>
            </div>
        </div>

        <div class="cards-grid">
            <!-- Card 1 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de la faculté">
                <div class="card-content">
                    <h3 class="card-title">Faculté de Médecine de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        9, Rue Docteur Zouheir Safi - 1006
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de l'institut">
                <div class="card-content">
                    <h3 class="card-title">Institut Supérieur des Technologies Médicales de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        9, Rue Docteur Zouheir Safi - 1006
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de la faculté">
                <div class="card-content">
                    <h3 class="card-title">Faculté des Sciences Économiques et de Gestion de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        Campus Universitaire, El Manar
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de la faculté">
                <div class="card-content">
                    <h3 class="card-title">Faculté des Sciences Humaines et Sociales de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        94 Boulevard du 9 Avril 1938
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de l'institut">
                <div class="card-content">
                    <h3 class="card-title">Institut Bourguiba des Langues Vivantes</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        47, Avenue de la Liberté - 1002
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de l'école">
                <div class="card-content">
                    <h3 class="card-title">École Nationale d'Ingénieurs de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        BP 37, Le Belvédère - 1002
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 7 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de la faculté">
                <div class="card-content">
                    <h3 class="card-title">Faculté des Sciences de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        Campus Universitaire, El Manar
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 8 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de l'institut">
                <div class="card-content">
                    <h3 class="card-title">Institut Préparatoire aux Études d'Ingénieurs d'El Manar</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        Campus Universitaire, El Manar
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Card 9 -->
            <div class="card">
                <img class="card-image"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 433.png"
                    alt="Image de la faculté">
                <div class="card-content">
                    <h3 class="card-title">Faculté de Droit et des Sciences Politiques de Tunis</h3>
                    <p class="card-address">
                        <span class="address-icon">
                            <img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                                alt="Icon-pin.png">
                        </span>
                        Campus Universitaire, El Manar
                    </p>
                    <a href="/etablissements-utm-details" class="card-button">Voir plus</a>
                </div>
            </div>
            <!-- Add more cards as needed -->
        </div>
        <p class="no-results-message">Aucun établissement ne correspond à votre recherche.</p>

        <div class="text-center m-5">
            <a href="#" class="btn-view-more">Voir plus</a>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('.search-input');
            const cardsGrid = document.querySelector('.cards-grid');
            const cards = cardsGrid.querySelectorAll('.card');
            const noResultsMessage = document.querySelector('.no-results-message');

            searchInput.addEventListener('keyup', function (event) {
                const searchTerm = event.target.value.toLowerCase();
                let visibleCount = 0;

                cards.forEach(function (card) {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    if (title.includes(searchTerm)) {
                        card.style.display =
                            'flex'; // Use 'flex' since the card is a flex container
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    noResultsMessage.style.display = 'block';
                } else {
                    noResultsMessage.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>