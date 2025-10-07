<style>
    /* Using a common font for better consistency */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        background-color: #f8f9fa;
    }

    /* * The main container for the entire component.
         * It has a white background, rounded corners, and a subtle shadow.
         */
    .ip-container {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 10px;
        /* max-width: 1040px; */
        margin: 1.4rem auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* * Styles for the main section title.
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

    /* Container for the content below the title */
    .ip-content-container {
        padding: 25px 30px;
    }

    /* Styles for the paragraph text */
    .ip-paragraph {
        font-size: 16px;
        color: #333333;
        line-height: 1.6;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .ip-paragraph strong {
        color: #000000;
    }


    /* * The unordered list that holds the items.
         * 'list-style: none' removes the default browser bullets.
         * 'padding: 0' removes the default indentation.
         */
    .ip-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
        /* Creates space between list items */
        margin-bottom: 20px;
    }

    /* * Each list item.
         * 'display: flex' and 'align-items: flex-start' are used to align the custom bullet with the text.
         */
    .ip-list-item {
        display: flex;
        align-items: flex-start;
        /* Aligns items to the top for potentially multi-line text */
        font-size: 16px;
        color: #000000;
        position: relative;
        line-height: 1.5;
    }

    /* * This pseudo-element creates our custom red bullet.
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
        /* Prevents the bullet from shrinking if the text is long */
        margin-top: 6px;
        /* Adjust vertical alignment of the bullet */
    }
</style>


<div class="ip-container">
    <!-- Main Section -->
    <div>
        <div class="ip-title-container">
            <h2 class="ip-section-title">la charte et procédures de publication</h2>
        </div>
        <div class="ip-content-container">
            <p class="ip-paragraph">
                Dans un monde marqué par la complexité des interactions sociales, professionnelles et scientifiques,
                les notions d'éthique, de déontologie et d'intégrité occupent une place centrale. Elles constituent
                des repères fondamentaux pour garantir la confiance, la transparence et la responsabilité dans
                toutes les activités humaines, qu'elles soient liées à la recherche, à l'enseignement, à la santé,
                aux affaires ou à la gouvernance publique.
            </p>

            <p class="ip-paragraph">
                <strong>L'éthique</strong> renvoie à la réflexion morale que l'on porte sur nos actions, nos choix
                et leurs conséquences.
            </p>
            <ul class="ip-list">
                <li class="ip-list-item">
                    Elle pose la question : "Que faut-il faire pour agir de manière juste et responsable ?"
                </li>
                <li class="ip-list-item">
                    Elle s'applique à des domaines variés : éthique médicale, éthique de la recherche, éthique des
                    affaires, éthique environnementale.
                </li>
                <li class="ip-list-item">
                    Elle évolue selon les contextes culturels, sociaux et historiques, mais repose toujours sur des
                    valeurs universelles comme le respect de la dignité humaine, l'équité et la justice.
                </li>
            </ul>

            <p class="ip-paragraph">
                <strong>La déontologie</strong> se définit comme l'ensemble des règles et devoirs qui encadrent une
                profession.
            </p>
            <ul class="ip-list">
                <li class="ip-list-item">
                    Ces règles sont souvent formalisées dans des codes déontologiques (médecins, avocats,
                    chercheurs, enseignants, journalistes...).
                </li>
                <li class="ip-list-item">
                    Elle garantit la responsabilité professionnelle et le respect des usagers, patients, étudiants
                    ou citoyens.
                </li>
                <li class="ip-list-item">
                    Exemple : le secret professionnel en médecine, l'indépendance de jugement pour un magistrat,
                    l'objectivité pour un chercheur.
                </li>
            </ul>
        </div>
    </div>
</div>