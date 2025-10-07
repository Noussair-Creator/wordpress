<style>
/*
         * The main container for the entire component.
         * It has a white background, rounded corners, and a subtle shadow.
         */
.ip-container {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 10px;
    /* max-width: 1040px; */
    margin: 1.4rem auto;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    font-family: sans-serif;
    /* Added for better text rendering */
}

/*
         * Styles for the section title.
         */
.ip-title-container {
    padding: 19px 25px 10px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.ip-section-title {
    font-size: 18px;
    font-weight: bold;
    color: #2A2916;
    margin: 0;
}

/* Container for the main body of text */
.ip-content-container {
    padding: 20px 30px;
}

/* Styles for paragraphs */
.ip-paragraph {
    font-size: 16px;
    color: #000000;
    line-height: 1.6;
    margin: 0 0 20px 0;
}

/*
         * The unordered list that holds the items.
         */
.ip-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 16px;
    /* Creates space between list items */
}

/*
         * Each list item.
         */
.ip-list-item {
    display: flex;
    align-items: flex-start;
    /* Aligns bullet to the top of the text */
    font-size: 16px;
    color: #000000;
    line-height: 1.6;
}

/*
         * This pseudo-element creates our custom red bullet.
         */
.ip-list-item::before {
    content: '';
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #c60000;
    border-radius: 50%;
    margin-right: 12px;
    flex-shrink: 0;
    margin-top: 8px;
    /* Vertically aligns bullet with the text */
}
</style>


<div class="ip-container">
    <!-- Main Title -->
    <div class="ip-title-container">
        <h2 class="ip-section-title">Comment diffuser ma recherche?</h2>
    </div>

    <!-- Content Body -->
    <div class="ip-content-container">
        <p class="ip-paragraph">
            La diffusion de la recherche est une étape essentielle pour valoriser vos travaux, partager vos
            résultats avec la communauté scientifique et contribuer à l'innovation. Toutefois, cette diffusion doit
            être encadrée afin de protéger vos droits, sécuriser vos données et garantir la confidentialité des
            informations sensibles.
        </p>
        <p class="ip-paragraph">
            Avant de publier ou de communiquer vos résultats, il est important de :
        </p>

        <ul class="ip-list">
            <li class="ip-list-item">
                protéger vos productions intellectuelles (brevets, droits d'auteur, logiciels, etc.),
            </li>
            <li class="ip-list-item">
                encadrer l'accès et l'utilisation de vos données par des mesures de confidentialité,
            </li>
            <li class="ip-list-item">
                sécuriser le stockage et la transmission des informations de recherche.
            </li>
        </ul>

        <p class="ip-paragraph" style="margin-top: 20px;">
            En respectant ces bonnes pratiques, vous assurez à la fois la visibilité, la crédibilité et la
            protection de vos travaux de recherche.
        </p>
    </div>
</div>