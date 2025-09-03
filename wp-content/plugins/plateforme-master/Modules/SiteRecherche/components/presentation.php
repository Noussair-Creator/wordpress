<!-- Ligne de titre -->
<div class="titre-ligne-wrapper">
    <div class="ligne-gauche"></div>
    <div class="titre-ligne">Présentation</div>
    <div class="ligne-droite"></div>
</div>

<!-- Section contenu présentation -->
<section class="presentation">
    <div class="presentation-container">
        <!-- Texte à gauche -->
        <div class="presentation-text">
            <h2>Plateforme de recherche en<br>« Sciences et Technologies de la Médecine »</h2>
            <p>
                Dans le cadre de sa politique scientifique et technologique, la Faculté de Médecine de Tunis a placé
                la Promotion de la Recherche comme une des priorités dans sa planification stratégique, avec pour
                objectif de développer, parallèlement à la recherche fondamentale, la recherche clinique. Il a été ainsi
                créé en 2015, sur son site, une plateforme de recherche « Sciences et Technologies de la Médecine »,
                comme appui pour la formation et la recherche de haut niveau.
            </p>
        </div>

        <!-- Images à droite -->
        <div class="presentation-images">

            <div class="img-row">
                <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe 3275.png" alt="">
            </div>

            <div class="bloc-plateforme">
                <img class="icon-plateforme" src="/wp-content/plugins/plateforme-master/images/uscr/Groupe 677.png"
                    alt="">
            </div>

        </div>
    </div>

</section>



<style>
/* Ligne de titre */
.titre-ligne-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 60px 0 40px;
    position: relative;
    gap: 10px;
    padding: 0 120px;
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
    padding: 10px 30px;
    border: 2px solid #b60303;
    border-radius: 999px;
    font-size: 16px;
    color: #b60303;
    font-weight: 500;
    background-color: white;
    white-space: nowrap;
}

/* Section contenu */
.presentation {
    padding: 60px 120px;
    position: relative;
}

.presentation-container {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 40px;
}

.presentation-text {
    flex: 1;
    min-width: 320px;
    max-width: 50%;
}

.presentation-text h2 {
    font-size: 35px;
    font-weight: 700;
    color: #2a2916;
    margin-bottom: 20px;
    line-height: 1.4;
}

.presentation-text p {
    font-size: 19px;
    line-height: 1.5;
    text-align: justify;
    color: #2A2916;
    padding-right: 58px;
}

/* Images */
.presentation-images {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 300px;
}

.img-row {
    display: flex;
    gap: 10px;
}

.img-row img {
    flex: 1;
    border-radius: 12px;
    object-fit: cover;
    width: 100%;
}

/* Flèche circulaire animée */
.presentation-arrow {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.arrow-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #b60303;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    font-size: 22px;
    font-weight: bold;
    cursor: pointer;
}

.arrow-icon {
    z-index: 2;
}

.circle-text {
    position: absolute;
    font-size: 11px;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 2px;
    transform: rotate(-90deg);
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top: 100px;
    animation: spin 8s linear infinite;
    opacity: 0.5;
}

img.icon-plateforme {
    width: 109px;
    height: 109px;
}

.bloc-plateforme {
    position: absolute;
    bottom: 89px;
    left: 49%;
}
</style>