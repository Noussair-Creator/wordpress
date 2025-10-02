<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails des Tâches du Projet</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --ink: #2A2916;
            --line: #EBE9D7;
            --muted: #6E6D55;
            --danger: #D71920;
        }

        .custom-project-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .custom-content-box {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-button-alt {
            background-color: #fff;
            color: var(--danger);
            border: 1px solid var(--danger);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Header Styles */
        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .project-header h1 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        /* Accordion Styles */
        .phase-accordion {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--line);
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .phase-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 15px 20px;
            background: #fff;
        }

        .phase-header.open {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 2;
        }

        .phase-title-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .phase-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .phase-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .phase-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-encours {
            background-color: #FFDD0017;
            color: #FFDD00;
            border: 1px solid #FFDD00;
        }

        .status-prevu {
            background-color: #A6A59F24;
            color: #A6A59F;
            border: 1px solid #A6A59F;
        }

        .status-termine {
            background-color: #0E962D1F;
            color: #0E962D;
            border: 1px solid #0E962D;
        }

        .phase-toggle-icon {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .phase-toggle-icon.open {
            transform: rotate(180deg);
        }

        .phase-body {
            display: none;
            padding: 25px;
            background-color: #fafafa;
            border-top: 1px solid var(--line);
        }

        .phase-body.open {
            display: block;
        }

        .phase-details-grid {
            display: grid;
            gap: 30px;
            margin-bottom: 25px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 150px;
        }

        .detail-item dt {
            font-weight: 600;
            color: var(--muted);
            flex-shrink: 0;
            width: 220px;
        }

        .detail-item dd {
            margin: 0;
            font-weight: 600;
        }

        .members-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 30px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .members-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .members-list .fa-play {
            color: var(--danger);
            font-size: 10px;
        }

        .tasks-section-title {
            font-size: 16px;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 15px;
            border-top: 1px solid var(--line);
            padding-top: 20px;
        }

        /* Tasks Table Styles */
        .tasks-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tasks-table th,
        .tasks-table td {
            text-align: left;
            padding: 12px 15px;
            vertical-align: middle;
        }

        .tasks-table thead {
            background-color: #ECEBE3;
        }

        .tasks-table th {
            font-weight: 700;
            color: var(--ink);
        }

        .tasks-table tbody tr {
            background: #fff;
            border-bottom: 1px solid var(--line);
        }

        .tasks-table tbody tr:last-child {
            border-bottom: none;
        }

        .tasks-table td {
            font-weight: 500;
            color: var(--ink);
        }

        .tasks-table .task-title {
            color: var(--ink);
            font-weight: 600;
        }

        .task-status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            text-align: center;
            min-width: 80px;
        }

        .task-status-termine {
            background-color: #0E962D1F;
            color: #0E962D;
            border: 1px solid #0E962D;
        }

        .task-status-encours {
            background-color: #FFDD0017;
            color: #FFDD00;
            border: 1px solid #FFDD00;
        }

        .task-status-prevu {
            background-color: #A6A59F24;
            color: #A6A59F;
            border: 1px solid #A6A59F;
        }

        .attachment-cell {
            position: relative;
            display: inline-block;
            margin-top: 5px;
        }

        .attachment-cell .fa-paperclip {
            font-size: 22px;
            color: var(--muted);
        }

        .attachment-cell span {
            position: absolute;
            top: -15px;
            right: -20px;
            background-color: #DBD9C3;
            color: var(--ink);
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        .attachment-cell.attachment-zero span {
            background-color: #DBD9C3;
            color: #2A2916;
        }

        #tasksTable {
            border: none !important;
            box-shadow: none !important;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 40px;
        }

        #tasksTable th {
            text-align: center;
            border: 0
        }

        #tasksTable td {
            text-align: center;
            border: 1px solid var(--line)
        }

        #tasksTable thead {
            position: static;
            transform: translateY(-15px)
        }

        #tasksTable tbody tr:first-child td {
            border-top: 1px solid var(--line) !important
        }

        /* arrondis */
        #tasksTable thead tr:first-child th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px
        }

        #tasksTable thead tr:first-child th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px
        }

        #tasksTable tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px
        }

        #tasksTable tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px
        }

        #tasksTable tbody tr:first-child td:first-child {
            border-top-left-radius: 12px
        }

        #tasksTable tbody tr:first-child td:last-child {
            border-top-right-radius: 12px
        }
    </style>
</head>

<body>
    <div class="custom-project-wrapper">
        <div class="project-header">
            <h1>Projet : Interface cerveau-machine et apprentissage</h1>
            <a href="#" class="custom-button-alt">Générer Gantt</a>
        </div>

        <!-- Phase 1 Accordion -->
        <div class="phase-accordion" id="phase-1">
            <div class="phase-header open">
                <div class="phase-title-wrapper">
                    <h2>Phase 1 : Revue de littérature</h2>
                </div>
                <div class="phase-controls">
                    <span class="phase-status status-encours">En cours</span>
                    <i class="fas fa-chevron-down phase-toggle-icon open"></i>
                </div>
            </div>
            <div class="phase-body open">
                <dl class="phase-details-grid">
                    <div class="detail-item">
                        <dt>Date de début et fin prévu :</dt>
                        <dd>01/11/2025 → 30/01/2025</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Date fin limite :</dt>
                        <dd>30/01/2025</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Membres :</dt>
                        <dd>
                            <ul class="members-list">
                                <li><i class="fas fa-play"></i> Pr. R. Nasri</li>
                                <li><i class="fas fa-play"></i> Dr. Sarra Messaoudi</li>
                                <li><i class="fas fa-play"></i> Pr. R. Nasri</li>
                                <li><i class="fas fa-play"></i> Dr. Sarra Messaoudi</li>
                            </ul>
                        </dd>
                    </div>
                </dl>

                <h3 class="tasks-section-title">Liste des taches</h3>
                <table class="tasks-table" id="tasksTable">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Etat</th>
                            <th>Date Fin Prévu / Limite</th>
                            <th>Affecter à</th>
                            <th>Pièces jointe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-title">Collecte D'articles Scientifiques</td>
                            <td><span class="task-status-badge task-status-termine">Terminée</span></td>
                            <td>01/11/2025 → 30/01/2025</td>
                            <td>Pr. R. Nasri</td>
                            <td>
                                <div class="attachment-cell">
                                    <i class="fa-solid fa-paperclip"></i>
                                    <span>3</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="task-title">Analyse Critique Des Publications</td>
                            <td><span class="task-status-badge task-status-encours">En cours 20%</span></td>
                            <td>01/11/2025 → 30/01/2025</td>
                            <td>Dr. Sarra Messaoudi</td>
                            <td>
                                <div class="attachment-cell">
                                    <i class="fa-solid fa-paperclip"></i>
                                    <span>1</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="task-title">Analyse Critique Des Publications</td>
                            <td><span class="task-status-badge task-status-prevu">Prévu</span></td>
                            <td>01/11/2025 → 30/01/2025</td>
                            <td>Dr. Sarra Messaoudi</td>
                            <td>
                                <div class="attachment-cell attachment-zero">
                                    <i class="fa-solid fa-paperclip"></i>
                                    <span>0</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phase 2 Accordion -->
        <div class="phase-accordion" id="phase-2">
            <div class="phase-header">
                <div class="phase-title-wrapper">
                    <h2>Phase 2 : Revue de littérature</h2>
                </div>
                <div class="phase-controls">
                    <span class="phase-status status-encours">En cours 30%</span>
                    <i class="fas fa-chevron-down phase-toggle-icon"></i>
                </div>
            </div>
            <div class="phase-body">
                <!-- Content for Phase 2 goes here -->
                <p>Details for Phase 2...</p>
            </div>
        </div>

        <!-- Phase 3 Accordion -->
        <div class="phase-accordion" id="phase-3">
            <div class="phase-header">
                <div class="phase-title-wrapper">
                    <h2>Phase 3 : Collecte de données</h2>
                </div>
                <div class="phase-controls">
                    <span class="phase-status status-prevu">Prévu</span>
                    <i class="fas fa-chevron-down phase-toggle-icon"></i>
                </div>
            </div>
            <div class="phase-body">
                <!-- Content for Phase 3 goes here -->
                <p>Details for Phase 3...</p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const accordions = document.querySelectorAll('.phase-accordion');

            accordions.forEach(accordion => {
                const header = accordion.querySelector('.phase-header');
                const body = accordion.querySelector('.phase-body');
                const icon = accordion.querySelector('.phase-toggle-icon');

                header.addEventListener('click', function () {
                    const isOpen = body.classList.contains('open');

                    // Close all other accordions
                    accordions.forEach(acc => {
                        acc.querySelector('.phase-header').classList.remove('open');
                        acc.querySelector('.phase-body').classList.remove('open');
                        acc.querySelector('.phase-toggle-icon').classList.remove('open');
                    });

                    // Open the clicked one if it was closed
                    if (!isOpen) {
                        header.classList.add('open');
                        body.classList.add('open');
                        icon.classList.add('open');
                    }
                });
            });
        });
    </script>
</body>

</html>