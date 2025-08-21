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
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
}

.box ul li span {
    color: #333;
}


.box hr.shadow {
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
                <li><strong>Année de thèse :</strong> <span>4 -ème année</span></li>
                <li><strong>Laboratoire :</strong> <span>LIPAH – Informatique & Humanité</span></li>
                <li><strong>Nationalité :</strong> <span>Tunisien</span></li>
                <li><strong>Encadrant principal :</strong> <span>Pr. Mourad Ben Amor</span></li>
                <li><strong>Co-encadrant (cotutelle) :</strong> <span>Dr. Julie Morel – Univ. Montpellier</span></li>
                <li><strong>Année universitaire :</strong> <span>2024 - 2025</span></li>
            </ul>
        </div>


    </div>
</div>