<style>
/* Main container for the statistics section */
.statistiques-wrapper {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 25px;
    margin-bottom: 30px;
    /* width: 100%;
    max-width: 1000px; */
    /* Adjust max-width as needed */
}

/* Header section with title and report button */
.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.dashboard-sub-title {
    font-weight: 600;
    font-size: 22px;
    color: #333;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-report {
    border: 1px solid #c60000;
    color: #c60000;
    background: #fff;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
}

.btn-report:hover {
    background-color: #c60000;
    color: #fff;
}

/* Flex container for the charts */
.charts-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    gap: 40;
    flex-wrap: wrap;
    /* Allows charts to stack on smaller screens */
}

/* Styling for each individual chart block (canvas + legend) */
.chart-block {
    display: flex;
    align-items: center;
    gap: 23px;
    /* flex: 1; */
    /* min-width: 232px; */
}

.chart-block-right {
    flex-direction: column;
    align-items: flex-end;
}

.canvas-container {
    width: 170px;
    height: 170px;
}

/* Styling for the dynamic legend */
.legend {
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-size: 14px;
    color: #555;
}

.legend-item {
    display: flex;
    align-items: center;
}

.legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 8px;
}

.graph-header {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    /* margin-bottom: 15px; */
    margin-bottom: 100px;
}

.graph-select {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 14px;
    border: 1px solid #ccc;
    background-color: #fff;
}
</style>


<div class="statistiques-wrapper">
    <!-- Header -->
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/ed/1170616.png" alt="Icon"
                style="width: 38px; margin-right: 8px; vertical-align: middle;">
            Statistiques Générales
        </h2>
        <button class="btn-report"><i class="fa fa-sync-alt"></i> Générer un rapport global</button>
    </div>

    <!-- Charts Container -->
    <div class="charts-container">
        <!-- Left Chart Block -->
        <div class="chart-block">
            <div class="canvas-container">
                <canvas id="rapportsChart"></canvas>
            </div>
            <div class="legend" id="rapportsLegend"></div>
        </div>

        <!-- Right Chart Block -->
        <div class="chart-block">
            <div class="chart-block-right">
                <div style="display: flex; align-items: center; gap: 25px;">
                    <div class="canvas-container">
                        <canvas id="soutenancesChart"></canvas>
                    </div>
                    <div class="legend" id="soutenancesLegend"></div>
                </div>
            </div>
        </div>
        <div class="chart-block">
            <div class="chart-block-right">
                <div class="graph-header">
                    <select class="graph-select">
                        <option>2024 - 2025</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js plugin for data labels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Chart 1: Rapports ---
    const rapportLabels = ['Rapport Acceptée', 'Rapport Refusée', 'En demande de correction'];
    const rapportData = [66, 10, 24];
    const rapportColors = ['#808066', '#b1342f', '#dabebe'];

    const rapportCtx = document.getElementById('rapportsChart').getContext('2d');
    const rapportsChart = new Chart(rapportCtx, {
        type: 'pie',
        data: {
            labels: rapportLabels,
            datasets: [{
                data: rapportData,
                backgroundColor: rapportColors,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value) => value + '%'
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Generate dynamic legend for Chart 1
    const rapportLegendContainer = document.getElementById('rapportsLegend');
    rapportLabels.forEach((label, i) => {
        const item = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML =
            `<span class="legend-dot" style="background-color:${rapportColors[i]}"></span>${label}`;
        rapportLegendContainer.appendChild(item);
    });

    // --- Chart 2: Soutenances ---
    const soutenanceLabels = ['Soutenance refusée', 'Soutenance ajournée', 'Soutenance en attente',
        'Soutenance validée'
    ];
    const soutenanceData = [40, 23, 12, 15]; // Note: 23% + 40% + 12% + 15% = 90%. The chart will adjust.
    const soutenanceColors = ['#b1342f', '#dabebe', '#FFD962', '#5a6351'];

    const soutenanceCtx = document.getElementById('soutenancesChart').getContext('2d');
    const soutenancesChart = new Chart(soutenanceCtx, {
        type: 'pie',
        data: {
            labels: soutenanceLabels,
            datasets: [{
                data: soutenanceData,
                backgroundColor: soutenanceColors,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                },
                datalabels: {
                    color: (context) => (context.dataIndex === 1 || context.dataIndex === 2) ?
                        '#555' : '#fff', // Darker text for lighter slices
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value) => value + '%'
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Generate dynamic legend for Chart 2
    const soutenanceLegendContainer = document.getElementById('soutenancesLegend');
    soutenanceLabels.forEach((label, i) => {
        const item = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML =
            `<span class="legend-dot" style="background-color:${soutenanceColors[i]}"></span>${label}`;
        soutenanceLegendContainer.appendChild(item);
    });
});
</script>