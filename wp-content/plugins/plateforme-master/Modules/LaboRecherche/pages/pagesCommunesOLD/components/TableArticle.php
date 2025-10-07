<style>
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

    /* * Styles for each section title (e.g., "Propriété intellectuelle").
*/
    .ip-title-container {
        padding: 19px 25px 10px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        border-radius: 5px
    }



    .ip-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #2A2916;
        margin-top: 0;
        margin-bottom: 20px;
    }

    /* * Add margin to subsequent titles for spacing between sections.
*/
    .ip-section-title:not(:first-of-type) {
        margin-top: 32px;
    }

    /* * The unordered list that holds the items.
* 'list-style: none' removes the default browser bullets.
* 'padding: 0' removes the default indentation.
*/
    .ip-list {
        list-style: none;
        padding: 0px 30px;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
        /* Creates space between list items */
    }

    /* * Each list item.
* 'display: flex' and 'align-items: center' are used to align the custom bullet with the text.
*/
    .ip-list-item {
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #000000;
        position: relative;
        padding: 16px 0;
        /* Adds vertical padding */
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
    }

    /* * Bolds the first part of the text as seen in the screenshot.
*/
    .ip-list-item strong {
        color: #000000;
        font-weight: bold;
        margin-right: 4px;
    }
</style>

<div class="ip-container">
    <!-- Propriété intellectuelle Section -->
    <div>
        <div class="ip-title-container">
            <h2 class="ip-section-title">Propriété intellectuelle</h2>
        </div>
        <ul class="ip-list">
            <li class="ip-list-item">
                <strong>Brevet :</strong> pour protéger une invention technique
            </li>
            <li class="ip-list-item">
                <strong>Droit d'auteur :</strong> pour protéger les œuvres écrites et les logiciels
            </li>
        </ul>
    </div>

    <!-- Mesures de confidentialité Section -->
    <div>
        <div class="ip-title-container">
            <h2 class="ip-section-title">Mesures de confidentialité</h2>
        </div>
        <ul class="ip-list">
            <li class="ip-list-item">
                Signer des accords de confidentialité avec les parties impliquées
            </li>
            <li class="ip-list-item">
                Limiter l'accès aux données sensibles et aux résultats de la recherche
            </li>
        </ul>
    </div>

    <!-- Sécurisation des données Section -->
    <div>
        <div class="ip-title-container">
            <h2 class="ip-section-title">Sécurisation des données</h2>
        </div>
        <ul class="ip-list">
            <li class="ip-list-item">
                Crypter les fichiers et les communications contenant des informations sensibles
            </li>
            <li class="ip-list-item">
                Utiliser un stockage sécurisé pour les données de recherche
            </li>
            <li class="ip-list-item">
                Mettre en place un contrôle d'accès à l'information
            </li>
        </ul>
    </div>
</div>