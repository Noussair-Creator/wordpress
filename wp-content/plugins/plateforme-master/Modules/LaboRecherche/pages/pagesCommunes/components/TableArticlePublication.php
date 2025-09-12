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
            <h2 class="ip-section-title">La charte et procédures de publication</h2>
        </div>
        <div class="ip-content-container">
            <p class="ip-paragraph">
                La publication scientifique répond à des règles précises afin de garantir la qualité, la
                transparence et l'intégrité des travaux diffusés. La charte de publication définit les principes
                éthiques et déontologiques que doivent respecter les chercheurs, tandis que les procédures de
                publication encadrent le processus de soumission et de validation des articles, communications et
                autres productions scientifiques.
            </p>
            <p class="ip-paragraph">
                Respecter cette charte et suivre les procédures établies permet :
            </p>
            <ul class="ip-list">
                <li class="ip-list-item">
                    d'assurer la crédibilité et la fiabilité des résultats,
                </li>
                <li class="ip-list-item">
                    de valoriser la recherche au sein de la communauté académique et professionnelle,
                </li>
                <li class="ip-list-item">
                    de protéger les droits des auteurs et de reconnaître la contribution de chacun,
                </li>
                <li class="ip-list-item">
                    de renforcer la visibilité et l'impact des publications.
                </li>
            </ul>
            <p class="ip-paragraph">
                La mise en place de règles claires contribue à promouvoir une recherche responsable, ouverte et
                alignée sur les standards internationaux.
            </p>
        </div>
    </div>
</div>