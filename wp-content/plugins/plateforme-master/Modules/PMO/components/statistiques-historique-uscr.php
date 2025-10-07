<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .main-container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
            font-weight: 700;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #2A2916;
        }

        /* Remove border for nested card headers */
        .card .card .card-header {
            border-bottom: none;
        }

        /* Prevent nested cards from stretching unless they have h-100 */
        .card .card {
            height: auto;
        }

        .icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Timeline styles */
        .timeline {
            list-style: none;
            padding: 0;
            position: relative;
        }

        .timeline-item {
            display: flex;
            gap: 1.5rem;
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 40px;
            width: 1px;
            height: calc(100% - 20px);
            background-color: #EDECE0;
        }

        .timeline-icon {
            z-index: 1;
        }

        .timeline-icon .icon-wrapper {
            background-color: #f8f9fa;
            border: 1px solid #EDECE0;
        }

        .timeline-icon .bg-info-soft {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }


        .timeline-content h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .timeline-content p {
            font-size: 14px;
            color: #2A2916;
            margin-bottom: 0;
            font-weight: 600;
        }

        .timeline-content p:last-child {
            font-weight: 400;
        }

        .month-selector {
            background-color: #f0eee9;
            border: none;
            font-weight: 500;
            color: #5a5a5a;
            border-radius: 9999px;
            padding: 0.375rem 1.5rem;
        }

        /* Stat card styles */
        .stat-card {
            background-color: #fff;
            border-radius: 0.75rem;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .stat-card p {
            margin-top: 0.5rem;
            margin-bottom: 0;
            color: #2A2916;
            font-size: 14px;
        }

        .stat-card-icon {
            font-size: 1.5rem;
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
            color: #a0a0a0;
        }

        .stat-card.danger h3,
        .stat-card.danger .stat-card-icon {
            /* color: #dc3545; */
        }


        /* Chart legend styles */
        .chart-legend {
            list-style: none;
            padding: 0;
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            flex-direction: column;
            /* gap: 1.5rem; */
            font-size: 0.9rem;
        }

        .chart-legend li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-legend .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        /* Progress bar styles for "Equipements" */
        .equipment-usage .progress {
            height: 25px;
            border-radius: 5px;
            background-color: #DBD9C34D;
        }

        .equipment-usage .progress-bar {
            border-radius: 5px;
        }

        .equipment-usage-item {
            margin-bottom: 1.25rem;
        }

        .card-title {
            font-weight: 700;
            color: #2A2916;
            font-size: 15px;
        }

        .chart-container {
            position: relative;
            height: 100%;
        }

        #nextMonthsBtn {
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            z-index: 10;
            box-shadow: 0 0 6px #0000002E;
        }

        /* === NEW STYLES FOR CUSTOM DROPDOWN === */
        .custom-dropdown-toggle {
            background-color: #fff;
            border: 1px solid #ECEBE3;
            color: #212529;
            text-align: left;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus {
            background-color: #fff;
            color: #212529;
            border-color: #ECEBE3;
            /* box-shadow: 0 0 0 0.25rem rgba(185, 28, 28, 0.25); */
        }

        .custom-dropdown-menu {
            width: 100%;
            border: 1px solid #ECEBE3;
            /* Added border to the dropdown menu */
        }
    </style>
</head>

<body>

    <div class="container-fluid main-container">
        <div class="row g-4 align-items-stretch">

            <!-- Left Column: Historique -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <img width="40px" src="/wp-content/plugins/plateforme-master/images/icons/1373354.png"
                            alt="1373354.png">
                        Historique
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="period-select" class="form-label text-muted small">Période :</label>
                            <!-- === REPLACED STANDARD SELECT WITH CUSTOM DROPDOWN === -->
                            <div class="dropdown">
                                <button class="btn dropdown-toggle custom-dropdown-toggle" type="button"
                                    id="period-select" data-bs-toggle="dropdown" aria-expanded="false">
                                    ce mois
                                </button>
                                <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="period-select">
                                    <li><a class="dropdown-item" href="#" data-value="ce mois">ce mois</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="le mois dernier">le mois
                                            dernier</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="cette année">cette année</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button class="btn month-selector">Aout 2025</button>
                        </div>

                        <ul class="timeline">
                            <li class="timeline-item">
                                <div class="timeline-icon">
                                    <div class="icon-wrapper bg-primary-soft">
                                        <img width="20px"
                                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendarRed.png"
                                            alt="Icon-calendarRed.png">
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <h6>15 aout 2025</h6>
                                    <p>Réservation salle - Conférence salle</p>
                                    <p>N. Trabelsi</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon">
                                    <div class="icon-wrapper bg-danger-soft">
                                        <img width="20px"
                                            src="/wp-content/plugins/plateforme-master/images/icons/maintenance-repair-service-svgrepo-com.png"
                                            alt="maintenance-repair-service-svgrepo-com.png">
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <h6>12 aout 2025</h6>
                                    <p>Maintenance</p>
                                    <p>Microscope Electronique</p>
                                    <p>Dr. Ali</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon">
                                    <div class="icon-wrapper bg-success-soft">
                                        <div class="icon-wrapper bg-danger-soft">
                                            <img width="20px"
                                                src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2 (1).png"
                                                alt="Icon-checkmark-square-2.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <h6>10 aout 2025</h6>
                                    <p>Dépense validée</p>
                                    <p>Achat - 12 500 DT</p>
                                    <p>Service finance FST</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon">
                                    <div class="icon-wrapper bg-info-soft">
                                        <div class="icon-wrapper bg-danger-soft">
                                            <img width="20px"
                                                src="/wp-content/plugins/plateforme-master/images/icons/Groupe 218.png"
                                                alt="Groupe 218.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <h6>8 aout 2025</h6>
                                    <p>PV Comité</p>
                                    <p>Comité de pilotage</p>
                                    <p>Projet Erasmus+</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon">
                                    <div class="icon-wrapper bg-info-soft">
                                        <div class="icon-wrapper bg-danger-soft">
                                            <img width="20px"
                                                src="/wp-content/plugins/plateforme-master/images/icons/maintenance-repair-service-svgrepo-com.png"
                                                alt="maintenance-repair-service-svgrepo-com.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <h6>12 aout 2025</h6>
                                    <p>Maintenance</p>
                                    <p>Microscope Electronique</p>
                                    <p>Dr. Ali</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column: Statistics -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <img width="40px" src="/wp-content/plugins/plateforme-master/images/icons/1170616.png"
                            alt="1170616.png">
                        Statistiques générales
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6 col-xl-3">
                                <div class="stat-card">
                                    <div class="d-flex align-items-center mb-2">
                                        <img class="stat-card-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                                            alt="Icon-calendar.png">
                                        <h3 class="mb-0">126</h3>
                                    </div>
                                    <p>Réservations des équipements et salles</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="stat-card">
                                    <div class="d-flex align-items-center mb-2">
                                        <img class="stat-card-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-clock.png"
                                            alt="Icon-clock.png">
                                        <h3 class="mb-0">481 h</h3>
                                    </div>
                                    <p>Heures d'utilisation d'équipements</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="stat-card">
                                    <div class="d-flex align-items-center mb-2">
                                        <img class="stat-card-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-checkmark-square-2 (1).png"
                                            alt="Icon-checkmark-square-2.png">
                                        <h3 class="mb-0">350 000</h3>
                                    </div>
                                    <p>Dépenses validées</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="stat-card danger">
                                    <div class="d-flex align-items-center mb-2">
                                        <img class="stat-card-icon"
                                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-alert-triangle.png"
                                            alt="Icon-alert-triangle.png">
                                        <h3 class="mb-0">12</h3>
                                    </div>
                                    <p>Incidents signalés</p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-4">
                            <div class="col-xl-7">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Réservations par mois</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="reservationsChart"></canvas>
                                            <button id="nextMonthsBtn" class="btn btn-light btn-sm"><i
                                                    class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Utilisation des équipements</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div style="height: 180px; width: 180px; position: relative;">
                                            <canvas id="equipmentUsageChart"></canvas>
                                        </div>
                                        <ul class="chart-legend">
                                            <li><span class="legend-dot" style="background-color: #9e9d7c;"></span>
                                                Investissement</li>
                                            <li><span class="legend-dot" style="background-color: #b91c1c;"></span>
                                                Maintenance</li>
                                            <li><span class="legend-dot" style="background-color: #e6c7c5;"></span>
                                                Fonctionnement</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Equipements les plus utilisés</h5>
                            </div>
                            <div class="card-body equipment-usage p-4">
                                <div class="equipment-usage-item">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Microscope</span>
                                        <span class="fw-bold">57%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 57%; background-color: #A6A485;" aria-valuenow="57"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="equipment-usage-item">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Serveur HPC</span>
                                        <span class="fw-bold">44%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 44%; background-color: #DDACA7;" aria-valuenow="44"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="equipment-usage-item">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>RMN</span>
                                        <span class="fw-bold">39%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 39%; background-color: #FFD54F;" aria-valuenow="39"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="equipment-usage-item">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Salle A</span>
                                        <span class="fw-bold">68%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 68%; background-color: #A6C7FF;" aria-valuenow="68"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="equipment-usage-item mb-0">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Bain-Marie</span>
                                        <span class="fw-bold">89%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 89%; background-color:#BF0404;" aria-valuenow="89"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const customRed = '#b91c1c';

            const allLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
            const allData = [32, 65, 40, 55, 45, 75, 60, 80, 70, 90, 85, 95];
            let currentMonthIndex = 0;


            // Bar Chart: Reservations par mois
            const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
            const reservationsChart = new Chart(reservationsCtx, {
                type: 'bar',
                data: {
                    labels: allLabels.slice(0, 4),
                    datasets: [{
                        label: 'Réservations',
                        data: allData.slice(0, 4),
                        backgroundColor: customRed,
                        borderRadius: 5,
                        barPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e9ecef',
                                borderDash: [5, 5],
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        }
                    }
                }
            });

            document.getElementById('nextMonthsBtn').addEventListener('click', () => {
                currentMonthIndex = (currentMonthIndex + 4) % allLabels.length;

                reservationsChart.data.labels = allLabels.slice(currentMonthIndex, currentMonthIndex + 4);
                reservationsChart.data.datasets[0].data = allData.slice(currentMonthIndex,
                    currentMonthIndex + 4);

                reservationsChart.update();
            });


            // Custom plugin to draw percentage labels inside the pie chart
            const pieLabelsPlugin = {
                id: 'pieLabels',
                afterDatasetsDraw(chart, args, options) {
                    const {
                        ctx,
                        data
                    } = chart;
                    ctx.save();

                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);

                    data.datasets[0].data.forEach((datapoint, i) => {
                        const {
                            x,
                            y
                        } = chart.getDatasetMeta(0).data[i].tooltipPosition();
                        const percent = Math.round((datapoint / total) * 100);

                        if (percent < 5) {
                            return;
                        }

                        const halfwidth = chart.width / 2;
                        const halfheight = chart.height / 2;
                        const xLine = x - halfwidth;
                        const yLine = y - halfheight;
                        const radius = chart.getDatasetMeta(0).data[i].outerRadius;

                        const textX = halfwidth + (radius * 0.7) * Math.cos(Math.atan2(yLine, xLine));
                        const textY = halfheight + (radius * 0.7) * Math.sin(Math.atan2(yLine, xLine));

                        ctx.font = 'bold 12px Inter';
                        ctx.fillStyle = 'white';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        ctx.fillText(`${percent}%`, textX, textY);
                    });
                    ctx.restore();
                }
            };

            // Pie Chart: Utilisation des équipements
            const equipmentUsageCtx = document.getElementById('equipmentUsageChart').getContext('2d');
            const equipmentUsageChart = new Chart(equipmentUsageCtx, {
                type: 'pie',
                data: {
                    labels: ['Investissement', 'Maintenance', 'Fonctionnement'],
                    datasets: [{
                        label: 'Utilisation',
                        data: [66, 24, 10],
                        backgroundColor: [
                            '#9e9d7c',
                            '#b91c1c',
                            '#e6c7c5'
                        ],
                        borderWidth: 4,
                        borderColor: '#fff'
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
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed + '%';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                },
                plugins: [pieLabelsPlugin]
            });

            // === JAVASCRIPT FOR CUSTOM DROPDOWN ===
            const dropdownToggleButton = document.getElementById('period-select');
            const dropdownItems = document.querySelectorAll('.custom-dropdown-menu .dropdown-item');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent default link behavior
                    const selectedValue = this.getAttribute('data-value');
                    dropdownToggleButton.textContent = selectedValue;
                });
            });
        });
    </script>
</body>

</html>