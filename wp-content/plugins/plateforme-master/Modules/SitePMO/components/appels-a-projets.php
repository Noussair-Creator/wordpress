<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appels à projets - Université de Tunis El Manar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* General body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Custom color */
        .text-custom-red {
            color: #b60303;
        }

        .bg-custom-red {
            background-color: #b60303;
        }

        /* Hero section styling */
        .hero-bg {
            background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
            background-size: cover;
            background-position: center;
            padding: 13rem 0;
            color: white;
        }

        .hero-bg h1 {
            font-size: 50px;
            font-weight: 500;
        }

        /* Main Content Styling */
        .main-content {
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .custom-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
        }

        .section-heading {
            color: #2A2916 !important;
            font-size: 25px !important;
            border-bottom: 1px solid #ECEBE3;
            padding-bottom: 22px;

        }

        .search-card .form-control,
        .search-card .form-select {
            border-color: #d1c9c0;
            border-radius: 0.5rem;
        }

        .search-card .form-control {
            padding-right: 2.5rem;
            /* Space for icon */
        }

        .search-card .form-control:focus,
        .search-card .form-select:focus {
            border-color: #c9b9a6;
            box-shadow: 0 0 0 0.2rem rgba(182, 3, 3, 0.1);
        }

        .search-card .btn-icon {
            background-color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 0.5rem;
            color: #b60303;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease-in-out;
            border: 1px solid #e9e5e0;
        }

        .search-card .btn-icon:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.07);
        }

        /* Statistics Section */
        .stats-card h5.fw-bold {
            font-size: 15px;
            color: #5a5349;
        }

        .stats-card .stat-item {
            background-color: #ffffff;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 3px solid #b60303;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .stats-card .stat-item:last-child {
            margin-bottom: 0;
        }

        .stats-card .stat-item .label {
            font-size: 15px;
            color: #343a40;
            font-weight: 900;
        }

        .stats-card .number-box {
            background-color: #ECEBE3;
            color: #343a40;
            font-weight: 700;
            font-size: 1.5rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
        }

        .chart-container-wrapper {
            height: 250px;
            /* Give the container a fixed height */
        }


        /* Project Card Styling - UPDATED */
        .project-card {
            background-color: #fff;
            background-image: url('wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
            background-repeat: no-repeat;
            background-position: 100% 100%;
            background-size: 70%;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            display: grid;
            grid-template-rows: auto auto 1fr auto;
        }

        .project-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
            border-color: #e9ecef;
        }

        .project-card .project-tag {
            display: inline-block;
            padding: 0.4rem 1.1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 1rem;
            justify-self: start;
        }

        .tag-europeen {
            background-color: #b60303;
        }

        .tag-bilateral {
            background-color: #b60303;
        }

        .tag-national {
            background-color: #b60303;
            /* Using theme red color */
        }

        .project-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.4;
            width: 70%;
        }

        .project-card p {
            font-size: 0.9rem;
            color: #2A2916;
            padding-bottom: 1rem;
        }

        .project-card .project-date {
            font-size: 0.9rem;
            color: #2A2916;
            font-weight: 500;
        }

        .project-card .arrow-link {
            position: absolute;
            top: 0;
            right: 0;
            width: 45px;
            height: 45px;
            background-color: #b60303;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 0 1rem 0 1rem;
        }

        .btn-outline-red {
            color: #b60303;
            border-color: #b60303;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 8px;
            border-width: 2px;
        }

        .btn-outline-red:hover {
            color: #fff;
            background-color: #b60303;
            border-color: #b60303;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <h1 class="text-start">Appels à projets</h1>
        </div>
    </section>

    <main class="container main-content">
        <!-- Search Section -->
        <div class="search-card custom-card col-lg-10 mx-auto mb-5">
            <h5 class="fw-bold mb-3">Recherche</h5>
            <div class="row g-3 align-items-center">
                <div class="col-lg-5">
                    <select id="typeSelect" class="form-select">
                        <option value="" selected>Type</option>
                        <option value="Européen">Européen</option>
                        <option value="Bilatéral">Bilatéral</option>
                        <option value="National">National</option>
                    </select>
                </div>
                <div class="col-lg-5">
                    <div class="position-relative">
                        <input type="text" id="yearInput" class="form-control" placeholder="Année début et fin">
                        <i class="far fa-calendar-alt position-absolute"
                            style="top: 50%; right: 15px; transform: translateY(-50%); color: #6c757d; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-lg-2 d-flex justify-content-end">
                    <button id="applyBtn" class="btn btn-icon me-2">
                        <i class="fas fa-check"></i>
                    </button>
                    <button id="resetBtn" class="btn btn-icon">
                        <i class="fas fa-redo"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <section class="col-lg-10 mx-auto mb-5">

            <div class="stats-card custom-card">
                <h5 class="fw-bold mb-3 section-heading">Statistiques Générales</h5>
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="stat-item">
                            <div class="label">Appels à projet <br> en cours</div>
                            <div class="number-box">78</div>
                        </div>
                        <div class="stat-item mb-0">
                            <div class="label">Appels à projet <br> clôturés</div>
                            <div class="number-box">169</div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h5 class="fw-bold mb-4">Nombre total des appels à projet par année</h5>
                        <div class="chart-container-wrapper">
                            <canvas id="documentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Grid -->
        <section class="col-lg-10 mx-auto">
            <div id="projectsGrid" class="row g-4">
                <!-- Project Card 1 (UPDATED) -->
                <div class="col-lg-6 project-item" data-type="Européen" data-year="2026">
                    <div class="project-card">
                        <a href="/appels-a-projets-details" class="arrow-link"><img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                                alt="Arrow Icon"></a>
                        <span class="project-tag tag-europeen">Européen</span>
                        <h3 class="mb-3">Interface cerveau-machine et apprentissage</h3>
                        <p class="mb-4">Cet article explore l'utilisation des réseaux de neurones convolutifs et des
                            modèles Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine
                            (BCI)...</p>
                        <div class="project-date">
                            <i class="far fa-calendar-alt me-2 text-custom-red"></i>05/08/2025 -> 05/08/2026
                        </div>
                    </div>
                </div>
                <!-- Project Card 2 (UPDATED) -->
                <div class="col-lg-6 project-item" data-type="Bilatéral" data-year="2025">
                    <div class="project-card">
                        <a href="/appels-a-projets-details" class="arrow-link"><img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                                alt="Arrow Icon"></a>
                        <span class="project-tag tag-bilateral">Bilatéral</span>
                        <h3 class="mb-3">Deep Learning for Brain-Computer Interface Systems</h3>
                        <p class="mb-4">Cet article explore l'utilisation des réseaux de neurones convolutifs et des
                            modèles Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine
                            (BCI)...</p>
                        <div class="project-date">
                            <i class="far fa-calendar-alt me-2 text-custom-red"></i>05/08/2025 -> 05/08/2026
                        </div>
                    </div>
                </div>
                <!-- Project Card 3 (UPDATED) -->
                <div class="col-lg-6 project-item" data-type="Bilatéral" data-year="2026">
                    <div class="project-card">
                        <a href="/appels-a-projets-details" class="arrow-link"><img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                                alt="Arrow Icon"></a>
                        <span class="project-tag tag-bilateral">Bilatéral</span>
                        <h3 class="mb-3">Deep Learning for Brain-Computer Interface Systems</h3>
                        <p class="mb-4">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                            modèles Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine
                            (BCI). Les résultats obtenus sur des bases de données EEG montrent une amélioration de 12 %
                            par rapport aux méthodes classiq...</p>
                        <div class="project-date">
                            <i class="far fa-calendar-alt me-2 text-custom-red"></i>05/08/2025 -> 05/08/2026
                        </div>
                    </div>
                </div>
                <!-- Project Card 4 (UPDATED) -->
                <div class="col-lg-6 project-item" data-type="National" data-year="2025">
                    <div class="project-card">
                        <a href="/appels-a-projets-details" class="arrow-link"><img width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                                alt="Arrow Icon"></a>
                        <span class="project-tag tag-national">National</span>
                        <h3 class="mb-3">Deep Learning for Brain-Computer Interface Systems</h3>
                        <p class="mb-4">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                            modèles Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine
                            (BCI). Les résultats obtenus sur des bases de données EEG montrent une amélioration de 12 %
                            par rapport aux méthodes classiq...
                        <div class="project-date">
                            <i class="far fa-calendar-alt me-2 text-custom-red"></i>05/08/2025 -> 05/08/2026
                        </div>
                    </div>
                </div>
            </div>
            <div id="noResultsMessage" class="text-center my-5" style="display: none;">
                <h4>Aucun appel à projet ne correspond à vos critères de recherche.</h4>
            </div>

            <div class="text-center my-5">
                <a href="#" class="btn btn-outline-red">Voir plus</a>
            </div>
        </section>
    </main>




    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Filter functionality
            const typeSelect = document.getElementById('typeSelect');
            const yearInput = document.getElementById('yearInput');
            const applyBtn = document.getElementById('applyBtn');
            const resetBtn = document.getElementById('resetBtn');
            const projectItems = document.querySelectorAll('.project-item');
            const noResultsMessage = document.getElementById('noResultsMessage');

            function filterProjects() {
                const selectedType = typeSelect.value;
                const selectedYear = yearInput.value;
                let visibleCount = 0;

                projectItems.forEach(item => {
                    const itemType = item.dataset.type;
                    const itemYear = item.dataset.year;

                    const typeMatch = !selectedType || itemType === selectedType;
                    const yearMatch = !selectedYear || itemYear.includes(selectedYear);

                    if (typeMatch && yearMatch) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            applyBtn.addEventListener('click', filterProjects);

            resetBtn.addEventListener('click', function () {
                typeSelect.value = '';
                yearInput.value = '';
                filterProjects();
            });

            yearInput.addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    filterProjects();
                }
            });

            // Chart configuration for "Nombre total des appels à projet par année"
            new Chart(document.getElementById('documentsChart'), {
                type: 'bar',
                data: {
                    labels: ['2021', '2022', '2023', '2024', '2025'],
                    datasets: [{
                        label: 'Nombre total des appels',
                        data: [700, 1080, 980, 1080, 920],
                        backgroundColor: '#BF0404',
                        barThickness: 40,
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
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 200,
                                color: '#5a5349'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#5a5349'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>