<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Project Statistics</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
        }

        .custom-project-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 22px #00000012;
            border-radius: 10px;
        }

        .custom-content-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 3px 16px #00000029;
            display: flex;
            flex-direction: column;
        }

        .custom-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            box-shadow: 0 5px 16px #00000012;
            flex-shrink: 0;
        }

        .custom-box-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #2A2916;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-icon {
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #BF0404;
            position: relative;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .custom-button {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid transparent;
        }

        .custom-button-main {
            background-color: #BF0404;
            color: #fff;
            border-color: #BF0404;
        }

        .custom-button-alt {
            background-color: #fff;
            color: #BF0404;
            border: 1px solid #BF0404;
        }

        .custom-box-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .chart-container {
            position: relative;
            width: 100%;
            flex-grow: 1;
        }

        /* New Styles for Dashboard */
        .custom-project-wrapper>.custom-content-box:first-child {
            box-shadow: none;
            border-radius: 0;
        }

        .custom-project-wrapper>.custom-content-box:first-child>.custom-box-header {
            box-shadow: none;
            border-bottom: 1px solid #ECEBE3;
            padding: 0 0 20px 0;
        }

        .dashboard-header-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .custom-select-wrapper {
            position: relative;
        }

        .custom-select {
            padding: 8px 30px 8px 12px;
            border-radius: 8px;
            border: 1px solid #A6A4853D;
            background-color: #fff;
            color: #2A2916;
            font-weight: 500;
            font-size: 14px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-select-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6E6D55;
            pointer-events: none;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 3px 16px #00000029;
            display: flex;
            align-items: center;
        }

        .stat-card-large {
            align-items: flex-start;
            gap: 20px;
            justify-content: space-evenly;
        }

        .stat-card-large .stat-icon {

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card-large .stat-value {
            font-size: 37px;
            font-weight: bold;
            color: #2A2916;
        }

        .stat-card-large .stat-label {
            font-size: 20px;
            font-weight: 500;
            color: #2A2916;
        }

        .stat-card-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            padding-left: 15px;
            width: 100%;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background-color: #BF0404;
            border-radius: 2px;
        }

        .stat-item .stat-label {
            font-size: 16px;
            font-weight: 700;
            color: #2A2916;
        }

        .stat-item .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #2A2916;
            background-color: #ECEBE3;
            padding: 5px 10px;
            border-radius: 6px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .charts-grid .custom-content-box {
            box-shadow: 0px 3px 10px #0000001a;
        }

        .charts-grid .custom-box-header {
            box-shadow: none;
        }

        .chart-full-width {
            grid-column: 1 / -1;
        }

        .chart-full-width .chart-container {
            min-height: 350px;
        }

        /* Custom Legend for Budget Chart */
        .custom-legend {
            position: absolute;
            bottom: 345px;
            right: 60px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .custom-legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-family: sans-serif;
            color: #2A2916;
        }

        .custom-legend-swatch {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="custom-project-wrapper">
        <!-- Dashboard Header -->
        <div class="custom-content-box">
            <div class="custom-box-header">
                <h2>
                    <span class="header-icon">
                        <img width="30px" src="/wp-content/plugins/plateforme-master/images/icons/1170616.png"
                            alt="statistics-icon.png">
                    </span>
                    Statistiques Générales
                </h2>
                <div class="dashboard-header-controls">
                    <div class="custom-select-wrapper">
                        <select class="custom-select">
                            <option>Année / Période</option>
                            <option>2025</option>
                            <option>2024</option>
                            <option>2023</option>
                        </select>
                    </div>
                    <a href="#" class="custom-button custom-button-alt">
                        <img width="16px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-Sync.png"
                            alt="report-icon.png">
                        Générer un rapport global
                    </a>
                </div>
            </div>
        </div>

        <!-- Top Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card-column">
                <div class="stat-card">
                    <div class="stat-item">
                        <span class="stat-label">Projets actifs</span>
                        <span class="stat-value">24</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-item">
                        <span class="stat-label">Soumissions en cours</span>
                        <span class="stat-value">26</span>
                    </div>
                </div>
            </div>
            <div class="stat-card stat-card-large">
                <div class="stat-icon">
                    <img width="70px" src="/wp-content/plugins/plateforme-master/images/icons/coin.png"
                        alt="budget-icon.png">
                </div>
                <div>
                    <div class="stat-value">3,5 MDT</div>
                    <div class="stat-label">Budget consommé</div>
                </div>
            </div>
            <div class="stat-card stat-card-large">
                <div class="stat-icon">
                    <img width="45px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 3429.png"
                        alt="documents-icon.png">
                </div>
                <div>
                    <div class="stat-value">150</div>
                    <div class="stat-label">Documents deposés</div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="charts-grid">
            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Répartition des projets par année</h2>
                </div>
                <div class="custom-box-body">
                    <div class="chart-container"><canvas id="projectsByYearChart"></canvas></div>
                </div>
            </div>
            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Soumissions</h2>
                </div>
                <div class="custom-box-body">
                    <div class="chart-container"><canvas id="submissionsChart"></canvas></div>
                </div>
            </div>
            <div class="custom-content-box chart-full-width">
                <div class="custom-box-header">
                    <h2>Budget vs Projets vs soumissions</h2>
                </div>
                <div class="custom-box-body">
                    <div class="chart-container">
                        <canvas id="budgetVsProjectsChart"></canvas>
                        <div id="budgetChartLegend" class="custom-legend"></div>
                    </div>
                </div>
            </div>
            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Partenaires</h2>
                </div>
                <div class="custom-box-body">
                    <div class="chart-container"><canvas id="partnersChart"></canvas></div>
                </div>
            </div>
            <div class="custom-content-box">
                <div class="custom-box-header">
                    <h2>Documents déposés</h2>
                </div>
                <div class="custom-box-body">
                    <div class="chart-container"><canvas id="documentsChart"></canvas></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultFontColor = '#2A2916';
            Chart.defaults.color = defaultFontColor;
            Chart.defaults.font.family = 'sans-serif';

            const topCornerRadius = (context) => {
                const {
                    dataIndex,
                    datasetIndex
                } = context;
                const datasets = context.chart.data.datasets;
                let isTop = true;
                for (let i = datasetIndex + 1; i < datasets.length; i++) {
                    if (datasets[i].data[dataIndex] > 0) {
                        isTop = false;
                        break;
                    }
                }
                return isTop ? {
                    topLeft: 6,
                    topRight: 6
                } : 0;
            };

            // 1. Répartition des projets par année (Stacked Bar Chart)
            new Chart(document.getElementById('projectsByYearChart'), {
                type: 'bar',
                data: {
                    labels: ['2021', '2022', '2023', '2024', '2025'],
                    datasets: [{
                        label: 'Nationaux',
                        data: [11, 6, 7.5, 3.5, 4.5],
                        backgroundColor: '#BF0404',
                        borderRadius: topCornerRadius,
                    },
                    {
                        label: 'Bilatéraux',
                        data: [0, 2.5, 2, 0, 0],
                        backgroundColor: '#E7C6C6',
                        borderRadius: topCornerRadius,
                    },
                    {
                        label: 'Européens',
                        data: [0, 0, 6, 5, 7],
                        backgroundColor: '#ECEBE3',
                        borderRadius: topCornerRadius,
                    },
                    {
                        label: 'Autres',
                        data: [0, 0, 0, 3, 0],
                        backgroundColor: '#A6A485',
                        borderRadius: topCornerRadius,
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    barPercentage: 0.6,
                    categoryPercentage: 0.7,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            align: 'center',
                            labels: {
                                usePointStyle: false,
                                boxWidth: 8,
                                font: {
                                    weight: '500',
                                    size: 14
                                }
                            }
                        }
                    },
                    datalabels: {
                        display: false
                    },
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });

            // 2. Soumissions (Pie Chart)
            new Chart(document.getElementById('submissionsChart'), {
                type: 'pie',
                plugins: [ChartDataLabels],
                data: {
                    labels: ['En attente', 'Validées', 'Refusées'],
                    datasets: [{
                        data: [40, 35, 25],
                        backgroundColor: ['#ECEBE3', '#BF0404', '#6E6D55'],
                        borderColor: '#fff',
                        borderWidth: 4,
                        spacing: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: 40
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                const label = ctx.chart.data.labels[ctx.dataIndex];
                                return `${label}\n${value}%`;
                            },
                            color: '#2A2916',
                            font: {
                                weight: '700',
                                size: 14,
                            },
                            anchor: 'end',
                            align: 'end',
                            offset: 15,
                            textAlign: (context) => {
                                const chart = context.chart;
                                const area = chart.chartArea;
                                const arc = chart.getDatasetMeta(context.datasetIndex).data[context
                                    .dataIndex];
                                const center = arc.getCenterPoint();
                                return center.x < area.left + (area.right - area.left) / 2 ? 'left' :
                                    'right';
                            }
                        }
                    }
                }
            });

            // 3. Budget vs Projets vs soumissions (Dual Axis Line Chart)
            const budgetChart = new Chart(document.getElementById('budgetVsProjectsChart'), {
                type: 'line',
                data: {
                    labels: ['Projet 1', 'Projet 2', 'Projet 3', 'Projet 4', 'Projet 5', 'Projet 6'],
                    datasets: [{
                        label: 'Budget alloué',
                        data: [250000, 340000, 280000, 130000, 420000, 260000],
                        borderColor: '#E7C6C6',
                        backgroundColor: '#E7C6C6',
                        yAxisID: 'y',
                        tension: 0.4,
                    }, {
                        label: 'Soumissions',
                        data: [50, 65, 125, 90, 45, 75],
                        borderColor: '#A6A485',
                        backgroundColor: '#A6A485',
                        yAxisID: 'y1',
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 30
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Budget alloué',
                                font: {
                                    weight: 'bold'
                                },
                                color: '#2A2916'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Soumissions',
                                font: {
                                    weight: 'bold'
                                },
                                color: '#2A2916'
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        },
                    }
                }
            });

            // Generate custom legend for the budget chart
            const legendContainer = document.getElementById('budgetChartLegend');
            budgetChart.data.datasets.forEach(
                dataset => {
                    const legendItem = document.createElement('div');
                    legendItem.className = 'custom-legend-item';

                    const swatch = document.createElement('span');
                    swatch.className = 'custom-legend-swatch';
                    swatch.style.backgroundColor = dataset.borderColor;

                    const text = document.createElement('span');
                    text.innerText = dataset.label;

                    legendItem.appendChild(swatch);
                    legendItem.appendChild(text);
                    legendContainer.appendChild(legendItem);
                });

            // 4. Partenaires (Doughnut Chart)
            new Chart(document.getElementById('partnersChart'), {
                type: 'doughnut',
                plugins: [ChartDataLabels],
                data: {
                    labels: ['Nationaux', 'Internationaux'],
                    datasets: [{
                        data: [60, 40],
                        backgroundColor: ['#BF0404', '#ECEBE3'],
                        borderColor: '#fff',
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            align: 'center',
                            labels: {
                                usePointStyle: false,
                                boxWidth: 10,
                                font: {
                                    weight: '500',
                                    size: 14
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value) => {
                                return value + '%';
                            },
                            color: (context) => {
                                return context.dataIndex === 0 ? '#fff' : '#2A2916';
                            },
                            font: {
                                color: '#2A2916',
                                weight: '700',
                                size: 16
                            },
                        }
                    }
                }
            });

            // 5. Documents déposés (Bar Chart)
            new Chart(document.getElementById('documentsChart'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
                    datasets: [{
                        label: 'Documents',
                        data: [17.5, 8.5, 22.5, 17.5, 17.5],
                        backgroundColor: '#BF0404',
                        barThickness: 25,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>