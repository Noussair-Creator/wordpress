<!-- ===================== STATISTIQUES – GÉNÉRALES ===================== -->
<div class="statistiques-wrapper" id="bloc-stats-combine" data-lab-id="19">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/ed/16406436.png" alt="Icon"
                style="width:38px;margin-right:8px;vertical-align:middle;">
            Statistiques Générales
        </h2>
        <button class="btn-report" type="button">
            <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-Sync.png"
                alt="Icon-Sync.png">
            Générer un rapport global
        </button>
    </div>

    <hr class="section-divider" style="margin-top:1rem; margin-bottom:1rem;">

    <div class="stats-grid">
        <!-- Section Gauche: Statistiques Projets -->
        <div class="left-stats">
            <div class="stat-box">
                <span class="label">Total des <br> Projets</span>
                <span class="value">91</span>
            </div>
            <div class="stat-box">
                <span class="label">Appels à projet <br> en cours</span>
                <span class="value">11</span>
            </div>
        </div>

        <!-- Section Droite: Graphique Projets -->
        <div class="right-graph bar-chart-section"
            style="    align-items: flex-start; max-width: unset; width: 100%; display: flex; gap: 1rem;">
            <div class="graph-header" style="flex-shrink: 0;">
                <h4>Total des projets par années</h4>
            </div>
            <div class="bar-chart-wrapper" style="position:relative;height:240px; margin-top:0; flex-grow: 1;">
                <canvas id="barChartProjets" aria-label="Total des projets par années" role="img"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ===================== STYLES MINIMAUX (UNCHANGED) ===================== -->
<style>
    /* .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px 20px;
    } */

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }


    .dashboard-sub-title {
        font-weight: bold;
        font-size: 24px;
    }

    .header-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .year-selector {
        padding: 10px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        color: #5a6c7d;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .year-selector:hover {
        border-color: #c60000;
    }

    .year-selector:focus {
        outline: none;
        border-color: #c60000;
        box-shadow: 0 0 0 3px rgba(198, 0, 0, 0.1);
    }

    .export-btn {
        background: #c60000;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .export-btn:hover {
        background: #a50000;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(198, 0, 0, 0.3);
    }

    .export-icon {
        font-size: 16px;
    }

    /* Main Dashboard Content */
    .dashboard-content {
        display: grid;
        grid-template-columns: 300px 1fr 400px;
        gap: 25px;
        align-items: start;
    }

    /* Stats Section */
    .stats-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-green {
        border-left-color: #27ae60 !important;
    }

    .stat-orange {
        border-left-color: #f39c12 !important;
    }

    .stat-red {
        border-left-color: #c60000 !important;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-label {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.3;
    }

    .stat-value {
        background: #ecf0f1;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        min-width: 70px;
        text-align: center;
    }

    /* Chart Section */
    .chart-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
    }

    .donut-chart-wrapper {
        position: relative;
        height: 280px;
        margin-bottom: 20px;
    }

    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #5a6c7d;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Disciplines Section */
    .disciplines-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .disciplines-container {
        height: 100%;
    }

    .bar-chart-wrapper {
        height: 233px;
        margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .dashboard-content {
            grid-template-columns: 280px 1fr 350px;
        }
    }

    @media (max-width: 1024px) {
        .dashboard-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .stats-section {
            flex-direction: row;
            gap: 15px;
        }

        .stat-card {
            flex: 1;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px 15px;
        }

        .header-section {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .header-controls {
            justify-content: center;
        }



        .stats-section {
            flex-direction: column;
        }

        .stats-grid {
            flex-direction: column;
        }

        .chart-section,
        .disciplines-section {
            padding: 20px;
        }

        .donut-chart-wrapper,
        .bar-chart-wrapper {
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .stat-content {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .stat-value {
            align-self: stretch;
        }
    }

    /* Loading Animation */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    /* Chart Center Text Plugin Styles */
    .chart-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
    }

    .chart-state {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.8);
        font-size: 16px;
        color: #555;
    }

    .center-value {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        display: block;
    }

    .center-label {
        font-size: 14px;
        color: #7f8c8d;
        margin-top: 5px;
    }



    .statistiques-wrapper {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        padding: 20px;
        display: flex;
        flex-direction: column;
        margin-bottom: 40px;
    }

    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-row h2 {
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-report {
        border: 1px solid #c60000;
        color: #c60000;
        background: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-report:hover {
        background-color: #c60000;
        color: #fff;
    }


    .stats-grid {
        display: flex;
        align-items: stretch;
        gap: 20px;
    }

    .left-stats {
        display: flex;
        flex-direction: column;
        /* gap: 15px; */
        /* Adjusted gap */
        flex-basis: 320px;
        /* Give a base width */
        flex-shrink: 0;
        justify-content: space-between;
    }

    .right-graph {
        flex-grow: 1;
        /* Allow chart to take remaining space */
    }


    .stat-box {
        height: 130px;
        background: #FFFFFF;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0px 0px 10px #0000001A;
        /* border-left: 4px solid #c60000; */
        position: relative;
    }

    .stat-box::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 5px;
        height: 50%;
        border-radius: 0 10px 10px 0px;
        background: #c60000;
        /* box-shadow: 0px 0px 10px #0000001A; */
        pointer-events: none;
    }

    .stat-box .label {
        font-weight: bold;
        font-size: 16px;
        color: #2A2916;
    }

    .stat-box .value {
        background: #ECEBE3;
        border-radius: 6px;
        padding: 8px 12px;
        font-weight: bold;
        font-size: 24px;
        min-width: 60px;
        text-align: center;
        color: #2A2916;
    }

    .label {
        display: block;
        font-size: 14px;
        color: #555;
    }

    .value {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-top: 5px;
    }

    .right-graph,
    .left-graph {
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 11px #0000001F;
    }


    .graph-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .graph-header h4 {
        font-size: 18px;
        margin: 0;
        font-weight: bold;
    }

    .graph-select {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>

<!-- ===================== CHART.JS ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>

<!-- ===================== LOGIQUE ===================== -->
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- PART 1: LOGIC FOR PROJECTS CHART (RIGHT SIDE) ---
        function renderProjectChart() {
            const ctx = document.getElementById('barChartProjets');
            if (!ctx) {
                console.log("Project chart canvas not found.");
                return;
            }

            const data = {
                labels: ['2021', '2022', '2022', '2023', '2024', '2025'],
                datasets: [{
                    label: 'Total des projets',
                    data: [68, 52, 60, 70, 42, 82],
                    backgroundColor: '#b1342f',
                    borderColor: '#b1342f',
                    borderWidth: 1,
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.5,
                    categoryPercentage: 0.7,
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: () => '',
                            label: (context) => ` Total: ${context.parsed.y}`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.08)'
                        },
                        ticks: {
                            stepSize: 20,
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            padding: 10
                        }
                    }
                }
            };

            const existingChart = Chart.getChart(ctx);
            if (existingChart) existingChart.destroy();
            new Chart(ctx, {
                type: 'bar',
                data,
                options
            });
        }

        // --- PART 2: REPORT BUTTON LOGIC ---
        document.querySelector('.btn-report')?.addEventListener('click', function () {
            const btn = this;
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML =
                '<span class="loading" style="display:inline-block;width:16px;height:16px;border:2px solid rgba(198,0,0,.2);border-top-color:#c60000;border-radius:50%;animation:spin 1s linear infinite;"></span><span style="margin-left: 8px;">Génération...</span>';

            setTimeout(() => {
                // Using alert as a placeholder for actual report generation
                alert('Rapport généré avec succès !');
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }, 1500);
        });

        // --- INITIALIZATION ---
        renderProjectChart();
    });
</script>