<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">
    <!-- Colonne 1 -->
    <div class="column" id="column1">

        <div class="card-flex">

            <div class="master-feature-card"><a href="/activites-scientifiques_">
                    <div class="feature-text">Activités <br>scientifiques</div>
                    <a href="/activites-scientifiques_"> <img class="card-image card-image2"
                            src="/wp-content/plugins/plateforme-master/imagesED/science_12641486.png" alt="">
                    </a>
                </a>
            </div>

            <!-- Bloc Indicateurs -->
            <div class="master-feature-card"><a href="/reseaux-de-la-recherches">
                    <div class="feature-text">Réseaux de la <br>recherche</div>
                    <a href="/reseaux-de-la-recherches"><img class="card-image card-image2"
                            src="/wp-content/plugins/plateforme-master/imagesED/2561975.png" alt=""></a>
                </a>
            </div>

        </div>

        <div class="card with-image card1" draggable="true"><a href="/programmes-et-projets-de-recherches">
                <div class="card-title">Programmes & projets de recherches</div>
                <span class="corner-icon">↗</span>
            </a>
        </div>

        <div class="card with-image card2" draggable="true"><a href="/reservation-des-equipements-et-salles">
                <div class="card-title">Reservation des équipements, salles</div>
                <a href="/reservation-des-equipements-et-salles"><span class="corner-icon">↗</span></a>
            </a>
        </div>

    </div>

    <!-- Colonne 2 -->
    <div class="column" id="column2">

        <div class="card with-image card4 card6" draggable="true"><a href="/activites-quotidiennes_">
                <div class="card-title2">Activités quotidiennes</div>
                <p class="card-des">Décrit les activités quotidiennes réalisées au laboratoire ainsi que l’état
                    d’avancement
                    des
                    travaux de recherche.</p>
                <a href="/activites-quotidiennes_"><span class="corner-icon">↗</span></a>
            </a>
        </div>

        <div class="card ged-card card5" draggable="true">
            <a href="/ged_"><span class="corner-icon">↗</span></a>
        </div>


    </div>
</div>


<style>
    .card-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
        padding: 0px 0px 10px;
        margin-bottom: 10px;
    }

    .card-flex {
        display: flex;
        gap: 16px;
        padding: 0px 0px;
    }

    .card {
        position: relative;
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* .card-title {
        border-left: 5px solid #bc0503;
        width: 180px;
        font-size: 20px;
        font-weight: 700;
        padding: 12px;
    } */

    .card-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 0 0 12px 12px;
    }

    .corner-icon {
        position: absolute;
        top: 0px;
        right: -2px;
        background: #b00000;
        color: #fff;
        font-size: 24px;
        padding: 8px 21px;
        border-radius: 0px 0px 0px 19px;
        position: absolute;
        font-weight: 700;
    }

    .card.with-image.card1 {
        margin-top: 30px;
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 414.png');
        background-size: 60%;
        background-repeat: no-repeat;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 20px;
        background-position: right;
    }

    .card.with-image.card2 {
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 415.png');
        background-size: 60%;
        background-repeat: no-repeat;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 20px;
        background-position: right;
    }

    .card.with-image.card3 {
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/a41dcd2f-2e04-4b73-8962-9f3b49ddeb96.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }

    /* .card.with-image.card4 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/d9eb867c-8b57-4ed9-9853-6f667e4ee124.png');
    background-size: cover;
    background-repeat: no-repeat;
    padding-top: 27px;
    padding-bottom: 24px;
    background-position: center center; 
}
*/
    .card.ged-card.card5 {
        background-image: url("/imagesMaster/Groupe 2376.png");
        background-size: cover;
        background-repeat: no-repeat;
        padding-top: 171px;
        padding-bottom: 158px;
        margin-bottom: 20px;
        background-position: center center;
    }

    .master-feature-card {
        flex: 1 1 50%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #ffffff 50%, #c3c0ac 50%);
        border-radius: 12px;
        padding: 46px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', sans-serif;
        font-weight: 600;
        font-size: 16px;
        min-height: 120px;
        transition: transform 0.3s ease;
    }

    .master-feature-card:hover {
        transform: translateY(-4px);
    }

    .feature-text {
        max-width: 65%;
        color: #000;
        font-size: 20px;
        font-weight: 700;
    }

    .feature-icon {
        font-size: 40px;
        color: #000;
    }

    .card-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
        padding: 0px 0px;
    }

    .card {
        position: relative;
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-title {
        border-left: 5px solid #bc0503;
        width: 180px;
        font-size: 20px;
        font-weight: 700;
        padding: 12px;
        margin: 0 0 0px -16px;
    }

    .card-title2 {
        width: 180px;
        font-size: 20px;
        font-weight: 700;
        padding: 5 12px;
    }

    p {
        margin-top: 0;
        margin-bottom: 0rem;
    }

    .card-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 0 0 12px 12px;
    }

    .corner-icon {
        position: absolute;
        top: 0px;
        right: -2px;
        background: #b00000;
        color: #fff;
        font-size: 24px;
        padding: 8px 21px;
        border-radius: 0px 0px 0px 19px;
        position: absolute;
        font-weight: 700;
    }

    .card.with-image.card3 {
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 414.png');
        background-size: 57%;
        background-repeat: no-repeat;
        padding-top: 25px;
        padding-bottom: 24px;
        margin-bottom: 20px;
        background-position: right;
    }

    .card.with-image.card4 {
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 456.png');
        background-size: cover;
        background-repeat: no-repeat;
        padding-top: 0px;
        /* padding-bottom: 24px; */
        background-position: center center;

    }

    .card.ged-card.card5 {
        background-image: url(/imagesMaster/Groupe 2376.png);
        background-size: 50%;
        background-repeat: no-repeat;
        padding-top: 114px;
        padding-bottom: 185px;
        margin-bottom: 20px;
        background-position: center center;
        margin-top: 28px;
    }

    .card {
        /* autres styles */
        user-select: none;
        /* optionnel : empêche sélection de texte au drag */
    }

    .card[draggable="true"] {
        cursor: grab;
    }

    .card[draggable="true"]:active {
        cursor: grabbing;
    }

    /*.card.with-image.card6 {
 background-image: url(/wp-content/plugins/plateforme-master/imagesED/Image 38.png);
        background-size: 36%;
        background-repeat: no-repeat;
        background-position: 102%;
        padding-top: 26px;
        padding-bottom: 0px;
        margin-bottom: 20px; 
}*/

    p.card-des {
        text-align: justify;
        width: 271px;
        padding-left: 13px;
    }

    .card.with-image.card7 {
        background-image: url('/wp-content/plugins/plateforme-master/imagesED/international-svgrepo-com.png');
        /* remplacez par le vrai nom */
        background-size: 26%;
        background-repeat: no-repeat;
        background-position: 78%;
        padding-top: 18px;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }

    .card.with-image {
        border-color: #fff;
    }

    .card.ged-card.card5 {
        border: none;
    }


    .master-feature-card:hover {
        transform: translateY(-4px);
    }

    .feature-text {
        max-width: 65%;
        color: #000;
    }

    .feature-icon {
        font-size: 40px;
        color: #000;
    }

    img.card-image.card-image2 {
        width: 70px;
        height: 70px;
        border-radius: 0px;
    }

    .labo-info-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
</style>
<script>
    function initDragAndDrop(columnSelector) {
        let draggedItem = null;

        const cards = document.querySelectorAll(`${columnSelector} .card`);
        const column = document.querySelector(columnSelector);

        cards.forEach(card => {
            card.addEventListener('dragstart', e => {
                draggedItem = card;
                setTimeout(() => card.style.display = 'none', 0);
            });

            card.addEventListener('dragend', () => {
                draggedItem.style.display = 'block';
                draggedItem = null;
            });
        });

        column.addEventListener('dragover', e => {
            e.preventDefault(); // autorise le drop dans la colonne
        });

        column.addEventListener('drop', e => {
            if (draggedItem && column.contains(draggedItem) === false) return; // interdit drop externe
            column.appendChild(draggedItem);
        });
    }

    // Initialisation des deux groupes séparément
    initDragAndDrop('#column1');
    initDragAndDrop('#column2');
</script>