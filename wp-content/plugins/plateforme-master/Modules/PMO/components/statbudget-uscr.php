<style>
    /* Main container styling */
    .stats-container {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
    }

    /* Header styling */
    .stats-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .stats-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2A2916;
        display: flex;
        align-items: center;
    }

    .stats-title img {
        margin-right: 0.75rem;
    }

    .btn-report {
        color: #b60303;
        border: 2px solid #b60303;
        background-color: #fff;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
    }

    .btn-report:hover {
        background-color: #b60303;
        color: #fff;
    }

    /* Stat items styling (left column) */
    .stat-item {
        background-color: #ffffff;
        border-radius: 0.75rem;
        padding: 3rem 1rem;
        /* border-left: 4px solid #b60303; */
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        position: relative;
    }

    .stat-item::before {
        content: '';
        position: absolute;
        left: 0;
        width: 4px;
        height: 50%;
        background-color: #b60303;
        border-radius: 0 7px 7px 0;
    }

    .stat-item .label {
        font-weight: 600;
        color: #495057;
        font-size: 15px !important;
    }

    .value-box {
        background-color: #ECEBE3;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        font-size: 20px;
        font-weight: 700;
        color: #2A2916;
    }

    /* Chart container styling (right column) */
    .chart-card {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        height: 100%;
    }

    .chart-header {
        position: absolute;
        top: 0rem;
        left: 3rem;
        right: 1.5rem;
        z-index: 10;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .chart-title {
        font-size: 14px;
        font-weight: 700;
        color: #2A2916;
    }

    .chart-legend {
        display: flex;
        /* gap: 1.5rem; */
        font-size: 0.9rem;
        margin-top: 0rem !important;
    }

    .legend-item {
        display: flex;
        align-items: center;
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    .year-select {
        border-radius: 0.5rem;
    }

    .chart-wrapper {
        position: relative;
        height: 280px;
    }
</style>

<div class="stats-container">
    <div class="stats-header">
        <h2 class="stats-title"><img src="https://placehold.co/28x28/b60303/FFFFFF?text=📊"
                alt="Statistiques Icon">Statistiques générales</h2>
        <button class="btn btn-report"><i class="fas fa-sync-alt me-2"></i>Générer un rapport global</button>
    </div>

    <div class="row align-items-stretch">
        <!-- Left Column: Stats -->
        <div class="col-lg-4 d-flex flex-column justify-content-between">
            <div class="stat-item">
                <span class="label">Budget alloué total</span>
                <span class="value-box">2 500 000 DT</span>
            </div>
            <div class="stat-item">
                <span class="label">Dépenses engagées</span>
                <span class="value-box">1 720 000 DT</span>
            </div>
        </div>

        <!-- Right Column: Chart -->
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-wrapper">
                    <div class="chart-header">
                        <div>
                            <h5 class="chart-title">Evolution annuelle : consommation vs Budget prévu</h5>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-dot"
                                        style="background-color: #b60303;"></span>Budget prévu</div>
                                <div class="legend-item"><span class="legend-dot"
                                        style="background-color: #6c757d;"></span>Consommation engagée</div>
                                <div class="legend-item"><span class="legend-dot"
                                        style="background-color: #f28b82;"></span>Payé</div>
                            </div>
                        </div>
                        <select class="form-select year-select w-auto">
                            <option selected>2024 - 2025</option>
                            <option>2023 - 2024</option>
                        </select>
                    </div>
                    <canvas id="evolutionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('evolutionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct',
                    'Nov', 'Déc'
                ],
                datasets: [{
                    label: 'Budget prévu',
                    data: [100, 120, 150, 180, 210, 240, 280, 320, 300, 280, 290, 310],
                    borderColor: '#b60303',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3
                }, {
                    label: 'Consommation engagée',
                    data: [90, 110, 140, 170, 200, 230, 270, 310, 290, 270, 280, 300],
                    borderColor: '#6c757d',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 2
                }, {
                    label: 'Payé',
                    data: [50, 60, 70, 80, 95, 110, 130, 150, 160, 170, 180, 190],
                    borderColor: '#f28b82',
                    backgroundColor: 'rgba(242, 139, 130, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Using custom HTML legend
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                layout: {
                    padding: {
                        top: 60 // Add padding to the top of the chart to make space for the header
                    }
                }
            }
        });
    });
</script>