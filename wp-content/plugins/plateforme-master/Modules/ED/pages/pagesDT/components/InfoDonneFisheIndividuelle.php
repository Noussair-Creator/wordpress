<style>
/* General Body Style */

.content-wrapper {
    padding: 20px 30px 0px;
    /* max-width: 1200px; */
    margin: auto;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.box {
    background-color: #ffffff;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
}

.box h3 {
    font-size: 21px;
    margin-bottom: 14px;
    padding-bottom: 10px;
    margin-top: -10px;
}

.box ul {
    list-style: none;
    padding: 0;
    margin: 0;
    margin-top: 20px;
}

.box ul li {
    margin-bottom: 10px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 10px 0;
    border-bottom: 1px solid #dedcc9;
    font-weight: 500;
}

.box ul li:last-child {
    border-bottom: none;
}

.box ul li strong {
    min-width: 180px;
    font-weight: 500;
    color: #6E6D55;
    flex-shrink: 0;
}

.box ul li span {
    color: #333;
}


.box hr.shadow {
    width: 570px;
    margin: 0px -29px;
    border: 1.5px solid #0000007e;
}
</style>


<div class="content-wrapper">
    <div class="grid-container">
        <!-- Informations sur le candidat -->
        <div class="box">
            <h3>Informations sur le candidat</h3>
            <hr class="shadow">
            <ul>
                <li><strong>Nom & Prénom :</strong> <span>Tarek Ben Amor</span></li>
                <li><strong>Email :</strong> <span>tarek.benamor@etud.utm.tn</span></li>
                <li><strong>Téléphone :</strong> <span>+216 22 35 65 78</span></li>
                <li><strong>Nationalité :</strong> <span>Tunisien</span></li>
                <li><strong>Spécialité :</strong> <span>Informatique</span></li>
                <li><strong>Thème de recherche :</strong> <span>Optimisation distribuée des graphes orientés dans
                        les réseaux intelligents</span></li>
            </ul>
        </div>

        <!-- Données académiques -->
        <div class="box">
            <h3>Données académiques</h3>
            <hr class="shadow">
            <ul>
                <li><strong>Année actuelle :</strong> <span>4ᵉ année</span></li>
                <li><strong>Date d'inscription initiale :</strong> <span>02-10-2021</span></li>
                <li><strong>Encadrant principal :</strong> <span>Pr. Mourad Ben Amor</span></li>
                <li><strong>Co-encadrant (cotutelle) :</strong> <span>Dr. Julie Morel</span></li>
                <li><strong>Taux d'avancement estimé :</strong> <span>65%</span></li>
                <li><strong>Soutenance prévue :</strong> <span>Janvier 2026</span></li>
            </ul>
        </div>
    </div>
</div>