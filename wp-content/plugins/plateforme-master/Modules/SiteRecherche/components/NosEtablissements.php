<style>
    /* New styles for the establishments component */
    body {
        font-family: sans-serif;
        background-color: #f9f9f7;
        margin: 0;
        padding: 0;
    }

    .establishments-section {
        padding: 50px 20px;
        text-align: center;
    }

    .section-title {
        font-size: 45px;
        font-weight: bolder;
        color: #2A2916;
        margin-bottom: 2rem;
    }

    .section-subtitle {
        font-size: 1rem;
        color: #2A2916;
        max-width: 500px;
        margin: 0 auto 3rem;
        line-height: 1.6;
        font-weight: 600;
    }

    .search-container {
        position: relative;
        max-width: 800px;
        margin: 0 auto 6rem;
    }

    .search-input {
        width: 100%;
        padding: 15px 25px 15px 50px;
        font-size: 1rem;
        border: 1px solid #A6A485;
        border-radius: 10px;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.3s;
    }

    .search-input:focus {
        border-color: #A6A485;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        /* Adjusted from right to left for better UX */
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
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        text-align: left;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        border: 1px solid #C6C3AC;
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
        /* Added to ensure consistent height for titles */
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
        /* Prevents icon from shrinking */
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
</style>


<main class="establishments-section">
    <h1 class="section-title">Nos Établissements</h1>
    <p class="section-subtitle">
        Découvrez l'ensemble des établissements affiliés à l'Université de Tunis El Manar, leurs équipes, projets et
        productions scientifiques.
    </p>

    <div class="search-container">
        <span class="search-icon">
            <img width="20px" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-search.png"
                alt="Icon-search.png">
        </span>
        <input type="text" class="search-input" placeholder="Rechercher un établissement...">
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
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
                <a href="/presentation-utm" class="card-button">Voir plus</a>
            </div>
        </div>
        <!-- Add more cards as needed -->
    </div>
    <p class="no-results-message">Aucun établissement ne correspond à votre recherche.</p>
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
                    card.style.display = 'flex'; // Use 'flex' since the card is a flex container
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