<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome Script from your original code -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- NOTE: Using a generic FA kit, replace if you have a specific PRO key -->
    <style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 2fr;
        grid-auto-rows: auto;
        gap: 20px;
        margin: 20px 0;
        align-items: stretch;
    }

    .column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* --- Card Styling --- */
    .card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
        color: #2A2916;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    a.corner-link {
        position: absolute;
        top: 0;
        right: 0;
        background: #c1272d;
        color: white;
        padding: 10px 18px;
        border-bottom-left-radius: 12px;
        text-decoration: none;
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
        transition: background-color 0.3s;
    }

    a.corner-link:hover {
        background-color: #a12024;
    }

    .card h3 {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        padding-left: 15px;
        position: relative;
    }

    .card h3::before {
        content: '';
        position: absolute;
        left: 0;
        top: -50px;
        bottom: 0;
        width: 5px;
        height: 150px;
        background-color: #c1272d;
    }

    /* --- Specific Card Styles --- */
    .card.project-card,
    .card.call-card {
        min-height: 200px;
        padding: 24px;
        justify-content: center;
        border: none;
    }

    .project-card {
        /* Replace with your image path */
        background-image: url('/wp-content/plugins/plateforme-master/images/pmo/Groupe 415.png');
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 75% 100%;
    }

    .project-card h3 {
        color: #2A2916;
        max-width: 600px;
    }

    .call-card {
        /* Replace with your image path */
        background-image: url("/wp-content/plugins/plateforme-master/images/pmo/Groupe 416.png");
        /* background-color: #f0efe9; */
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 65% 100%;
    }

    .small-card {
        min-height: 140px;
        padding: 24px;
        background-image: url("/wp-content/plugins/plateforme-master/images/pmo/Tracé 5369.png");
        background-repeat: no-repeat;
        background-position: right;
        background-size: 100% 120%;
        flex-direction: row;
        align-items: center;
        border: none;
    }

    .small-card img {
        max-width: 90px;
        height: auto;
    }

    .small-card .card-content {
        flex-grow: 1;
    }

    .small-card h3 {
        border: none;
        padding-left: 0;
        font-weight: 700;
    }

    .small-card h3::before {
        display: none;
    }

    .card.ged-card {
        max-height: 220px;
        /* background-color: #f0efe9; */
        align-items: center;
        justify-content: center;
        border: none;
    }

    .card.ged-card img {
        max-width: 48%;
    }

    /* --- Chart Card --- */
    .chart-card {
        padding: 20px;
        background: #ffffff;
        border: none;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .chart-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }

    .chart-header select {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 14px;
        background-color: #fafafa;
        margin-inline: 40px;
    }

    .chart-display-area {
        display: flex;
        align-items: flex-end;
        padding-bottom: 25px;
    }

    .y-axis-labels {
        height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-right: 10px;
        font-size: 12px;
        color: #666;
        text-align: right;
        flex-shrink: 0;
    }

    .y-axis-labels span {
        position: relative;
        top: -6px;
        /* Nudge text to sit on the line */
    }

    .y-axis-labels span:first-of-type {
        top: 0;
    }

    .chart-body {
        flex-grow: 1;
        display: flex;
        justify-content: space-around;
        align-items: flex-end;
        gap: 15px;
        height: 180px;
        position: relative;
        border-bottom: 1px solid #ccc;
        padding: 0 15px;
    }

    .chart-body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: linear-gradient(to top, #e0e0e0 1px, transparent 1px);
        background-size: 100% 25%;
        z-index: 0;
    }

    .bar-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-basis: 22%;
        height: 100%;
        justify-content: flex-end;
        z-index: 1;
        position: relative;
    }

    .bar {
        width: 40%;
        background-color: #BF040473;
        border-radius: 4px 4px 0 0;
        transition: height 0.5s ease-out;
        border: 2px solid #BF0404;
        border-bottom: none;
    }

    .bar-group span {
        font-size: 12px;
        color: #666;
        text-align: center;
        position: absolute;
        bottom: -25px;
        left: 0;
        width: 100%;
    }

    .chart-legend-footer {
        text-align: right;
        padding: 5px 20px 0 0;
        font-size: 12px;
        color: #666;
    }
    </style>
</head>

<body>

    <div class="dashboard-grid">
        <!-- Colonne 1 -->
        <div class="column">
            <div class="card project-card">
                <h3 class="project-title">Gestion Des <br> Projets</h3>
                <a href="/gestion-des-projets" class="corner-link">↗</a>
            </div>
            <div class="card call-card">
                <h3 class="call-title">Appel à projet</h3>
                <a href="/appels-a-projets-pmo" class="corner-link">↗</a>
            </div>
        </div>

        <!-- Colonne 2 -->
        <div class="card chart-card">
            <a href="#" class="corner-link">↗</a>
            <div class="chart-header">
                <h4>Nombre des projets par type</h4>
                <select>
                    <option>2024 - 2025</option>
                    <option>2023 - 2024</option>
                </select>
            </div>
            <div class="chart-display-area">
                <div class="y-axis-labels">
                    <span>20</span>
                    <span>15</span>
                    <span>10</span>
                    <span>5</span>
                    <span>0</span>
                </div>
                <div class="chart-body">
                    <div class="bar-group">
                        <div class="bar" style="height: 70%;"></div>
                        <span>Nationaux</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 45%;"></div>
                        <span>bilatéraux</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 62%;"></div>
                        <span>Européen</span>
                    </div>
                    <div class="bar-group">
                        <div class="bar" style="height: 90%;"></div>
                        <span>Autres</span>
                    </div>
                </div>
            </div>
            <div class="chart-legend-footer">
                <span>Projets</span>
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="card small-card">
            <div class="card-content">
                <a href="/budgets-pmo">
                    <h3 class="budget-title">Budgets</h3>
                </a>
            </div>
            <a href="/budgets-pmo"> <img
                    src="/wp-content/plugins/plateforme-master/images/pmo/dollar-circle-list-svgrepo-com.png"
                    alt="Budget Icon"></a>
        </div>
        <div class="card small-card">

            <div class="card-content">
                <a href="/partenaires-pmo">
                    <h3 class="partner-title">Partenaires</h3>
                </a>
            </div>
            <a href="/partenaires-pmo"><img src="/wp-content/plugins/plateforme-master/images/pmo/global-partner.png"
                    alt="Partner Icon"></a>
            </a>
        </div>
        <div class="card ged-card">
            <a href="/ged-pmo" class="corner-link">↗</a>
            <img src="/wp-content/plugins/plateforme-master/images/pmo/Groupe 2376.png" alt="GED Icon">
        </div>
    </div>

    <!-- Add Font Awesome for icons -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
</body>

</html>