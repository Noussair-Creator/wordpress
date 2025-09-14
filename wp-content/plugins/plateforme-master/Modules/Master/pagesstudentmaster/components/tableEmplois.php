<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Emploi du temps – version colgroup</title>

    <style>
    :root {
        --ink: #2A2916;
        --line: #ECEBE3;
        --panel: #EEEEEE;
        --card: #FFFFFF;
        --slot: #ECEBE375;
        --slot-b: #A6A485;
        --shadow: 0px 3px 22px #0000000F;
        --btnshadow: 0px 0px 6px #00000030;
        --font: 'Roboto', system-ui, -apple-system, 'Segoe UI', Arial, sans-serif;
    }

    * {
        box-sizing: border-box
    }

    body {
        margin: 0;
        background: #f3f4f6;
        font-family: var(--font);
        color: var(--ink)
    }

    /* Carte globale */
    .edt-card {
        background: #fff;
        border: 1px solid #e8e9ea;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .06);
        padding: 14px;
        margin: 12px;
    }

    /* En-tête : icône + titre + bouton */
    .edt-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .edt-head .icon {
        width: 38px;
        height: 38px
    }

    .edt-head .icon img {
        width: 100%;
        height: 100%;
        object-fit: contain
    }

    .edt-head .title {
        font-weight: 700;
        font-size: 20px;
        line-height: 26px
    }

    .upload-btn {
        margin-left: auto;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        background: #fff;
        box-shadow: var(--btnshadow);
        display: grid;
        place-items: center;
    }

    .upload-btn img {
        width: 16px;
        height: 17px
    }

    .sep {
        border: 0;
        border-top: 1px solid var(--line);
        margin: 8px 0 10px
    }

    /* Bande info */
    .info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--line);
        border-radius: 10px;
        background: #fff;
        padding: 12px 16px;
        margin-bottom: 12px;
    }

    .info .grp,
    .info .date {
        font-weight: 700;
        font-size: 18px
    }

    /* ===== TABLEAU HORAIRE ===== */
    .edt-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0
    }

    .edt-table col.col-time {
        width: 90px
    }

    /* colonne fixe pour les heures */
    .edt-table col.col-day {
        width: auto
    }

    /* 6 colonnes jours, flexibles */

    /* head */
    .edt-table thead th {
        background: #ECEBE3;
        padding: 12px 10px;
        font-weight: 700;
        font-size: 16px;
        text-align: center;
    }

    .edt-table thead th:first-child {
        text-align: left;
    }

    /* body */
    .edt-table tbody th {
        background: #EEEEEE;
        text-align: center;
        font-weight: 500;
        font-size: 15px;
        padding: 10px;
    }

    .edt-table tbody td {
        vertical-align: top;
        padding: 10px;
        min-height: 140px;
    }

    /* Slots (cours) */
    .slot {
        background: var(--slot);
        border: 1px solid var(--slot-b);
        border-radius: 5px;
        padding: 10px;
        min-height: 120px;
        position: relative;
    }

    .slot .title {
        font-weight: 500;
        font-size: 14px;
        line-height: 19px
    }

    .slot .teacher {
        margin-top: 8px;
        font-weight: 300;
        font-size: 14px;
        line-height: 19px
    }

    .room {
        margin-top: 14px;
        position: relative;
        padding-left: 37px
    }

    .room .label {
        position: absolute;
        left: 0;
        top: 0;
        width: 37px;
        font: 400 14px/19px var(--font);
        color: #6E6D55;
    }

    .room .value {
        font-weight: 700;
        font-size: 14px;
        line-height: 19px;
        color: #2A2916;
    }
    </style>
</head>

<body>

    <section class="edt-card">
        <!-- En-tête -->
        <div class="edt-head">
            <div class="icon">
                <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/7061954.png" alt="">
            </div>
            <div class="title">Emploi du temps</div>
            <button class="upload-btn" title="Télécharger">
                <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="">
            </button>
        </div>

        <hr class="sep">

        <!-- Infos -->
        <div class="info">
            <div class="grp">GPF-IR-08-10</div>
            <div class="date">30-09-2025</div>
        </div>

        <!-- ===== Tableau avec colgroup ===== -->
        <table class="edt-table" role="grid">
            <colgroup>
                <col class="col-time">
                <col class="col-day" span="6">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">Heures</th>
                    <th scope="col">Lundi</th>
                    <th scope="col">Mardi</th>
                    <th scope="col">Mercredi</th>
                    <th scope="col">Jeudi</th>
                    <th scope="col">Vendredi</th>
                    <th scope="col">Samedi</th>
                </tr>
            </thead>

            <tbody>
                <!-- 8h00 – 9h30 -->
                <tr>
                    <th scope="row">8h00 – 9h30</th>
                    <td>
                        <div class="slot">
                            <div class="title">Machine Learning</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Exploration de Données<br>(Data Mining)</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="slot">
                            <div class="title">Ingénierie des Données<br>pour l’IA</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- 9h35 – 11h05 -->
                <tr>
                    <th scope="row">9h35 – 11h05</th>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Machine Learning</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="slot">
                            <div class="title">Systèmes Multi-Agents</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Natural Language<br>Processing – NLP</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>

                <!-- 11h10 – 12h40 -->
                <tr>
                    <th scope="row">11h10 – 12h40</th>
                    <td>
                        <div class="slot">
                            <div class="title">Machine Learning</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Systèmes de<br>Recommandation</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>

                <!-- 13h10 – 14h40 -->
                <tr>
                    <th scope="row">13h10 – 14h40</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Machine Learning</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- 14h45 – 16h15 -->
                <tr>
                    <th scope="row">14h45 – 16h15</th>
                    <td>
                        <div class="slot">
                            <div class="title">Sécurité et IA</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="slot">
                            <div class="title">Big Data et Analyse<br>des Données</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- 16h20 – 17h50 -->
                <tr>
                    <th scope="row">16h20 – 17h50</th>
                    <td>
                        <div class="slot">
                            <div class="title">Robotics et<br>Systèmes Autonomes</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="slot">
                            <div class="title">Machine Learning</div>
                            <div class="teacher">Mr. Ahmed Brahem</div>
                            <div class="room"><span class="label">Salle&nbsp;:</span><span class="value">A12 bis</span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </section>

</body>

</html>