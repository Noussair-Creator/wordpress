<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'appel à projet - Université de Tunis El Manar</title>
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
            padding: 5rem 0 10rem;
            /* Adjusted padding */
            color: white;
            position: relative;
        }

        /* Breadcrumb styling */
        .breadcrumb-custom {
            background-color: rgba(0, 0, 0, 0.3);
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 0.25rem;
            color: #fff;
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .breadcrumb-custom a {
            color: #f0f0f0;
            text-decoration: none;
            font-weight: normal;
        }

        .breadcrumb-custom a:hover {
            color: #fff;
        }

        .breadcrumb-custom span {
            margin: 0 0.5rem;
            color: #f0f0f0;
        }

        .hero-bg h1 {
            font-size: 50px;
            font-weight: 500;
        }

        /* Main Content Styling */
        .main-content {
            margin-top: -50px;
            /* Adjust to pull content up higher */
            position: relative;
            z-index: 10;
        }

        .custom-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
            margin-bottom: 2rem;
        }

        .project-title-card h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2A2916;
        }

        .project-meta span {
            font-size: 14px;
            margin-right: 1.5rem;
            color: #2A2916;
        }

        .project-meta i {
            color: #b60303;
        }

        .section-heading {
            color: #2A2916;
            font-size: 1.5rem;
            font-weight: 700;
            /* border-bottom: 1px solid #ECEBE3; */
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .description-content p,
        .description-content li {
            color: #2A2916;
            line-height: 1.7;
            font-weight: 600;
        }

        .description-content ol {
            list-style: none;
            counter-reset: item;
            padding-left: 0;
        }

        .description-content li {
            margin-bottom: 0.75rem;
            position: relative;
            padding-left: 2rem;
        }

        .description-content li::before {
            content: counter(item) ".";
            counter-increment: item;
            position: absolute;
            left: 0;
            color: #b60303;
            font-weight: 700;
        }

        .file-download-list h5,
        .responsible-section h5 {
            font-size: 15px;
            /* font-weight: 700; */
            color: #6E6D55;
            margin-bottom: 1rem;
        }

        .file-item {
            display: flex;
            align-items: center;
            /* background-color: #f8f9fa; */
            /* border: 1px solid #e9ecef; */
            border-radius: 0.5rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0.75rem;
            text-decoration: none;
            color: #212529;
            transition: background-color 0.2s;
            gap: 30px;
        }

        .file-item:hover {
            background-color: #e9ecef;
        }

        .file-item i {
            font-size: 1.5rem;
            color: #b60303;
            margin-right: 1rem;
        }

        .responsible-section .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 1.5rem;
        }

        .responsible-section .name {
            font-size: 1rem;
            font-weight: 500;
            color: #343a40;
        }

        .btn-submit {
            background-color: #b60303;
            color: #fff;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 8px;
            border: 2px solid #b60303;
            transition: all 0.2s ease-in-out;
            margin-inline: 35px
        }

        .btn-submit:hover {
            background-color: #9a0202;
            border-color: #9a0202;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .submit-container {
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: right;
            margin-inline: -40px;
            box-shadow: 0 -20px 20px -20px rgba(0, 0, 0, 0.05);
        }

        /* Modal Styles */
        .modal-header {
            background-color: #b60303;
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .modal-header .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal-content {
            border-radius: 1rem;
            border: none;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem 1.5rem;
        }

        .alert-custom {
            background-color: #DBD9C32E;
            border-radius: 0.5rem;
            color: #2A2916;
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #DBD9C3;
        }

        .alert-custom i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .modal-body .form-label {
            font-weight: normal;
            color: #6c757d;
        }

        .file-input-group {
            display: flex;
            /* border-radius: .5rem; */
            overflow: hidden;
            height: 40px;
        }

        .file-input-group .form-control {
            border: 1px solid #DBD9C3;
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            background-color: #fff;
            padding: 0.6rem .75rem;
            /* width: 80%; */
            /* Adjusted padding for height */
        }

        .file-input-group .btn-import {
            font-size: 14px;
            background-color: #A6A485;
            color: white;
            border: 1px solid #DBD9C3;
            border-left: none;
            /* padding: 0.5rem 1.5rem; */
            border-top-right-radius: .5rem;
            border-bottom-right-radius: .5rem;
            border-top-left-radius: 0rem;
            border-bottom-left-radius: 0rem;
            width: 130px;
        }

        .file-input-group .btn-import:hover {
            background-color: #8a8a8a;
        }

        .uploaded-file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .uploaded-file-item:last-child {
            border-bottom: none;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #495057;
        }

        .delete-file-btn {
            background: none;
            border: none;
            color: #b60303;
            cursor: pointer;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="col-lg-10 mx-auto">
                <div class="breadcrumb-custom">
                    <a href="">Appels à projets</a><span>›</span> Interface cerveau machine et apprentissage
                </div>
                <h1 class="text-start">Appels à projets</h1>
            </div>
        </div>
    </section>

    <main class="container main-content">
        <div class="col-lg-10 mx-auto">
            <!-- Project Title Card -->
            <div class="custom-card project-title-card">
                <h2 class="mb-3 text-center">Interface cerveau-machine et apprentissage</h2>
                <div class="project-meta d-flex align-items-center justify-content-center" style="gap: 20px;">
                    <span>
                        <img width="15px" class="me-2"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-list.png"
                            alt="Icon-list.png">
                        Européen
                    </span>
                    <span>
                        <img width="15px" class="me-2"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendarRed.png"
                            alt="Icon-calendarRed.png">

                        05/08/2025 -> 01/08/2026
                    </span>
                </div>
            </div>

            <!-- Project Details Card -->
            <div class="custom-card" style="display: flex; flex-direction: column;">
                <!-- Description and Objectives -->
                <section class="description-content mb-5">
                    <h3 class="section-heading">Description et Objectif</h3>
                    <p>
                        Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles Transformer
                        pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les résultats
                        obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport aux méthodes
                        classiques de traitement du signal. Cette approche ouvre la voie à des applications en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.
                    </p>
                    <ol>
                        <li>Développer une interface neuronale portable basée sur des casques EEG à faible coût,
                            interfacée avec une application mobile.</li>
                        <li>Intégrer un module d'intelligence artificielle permettant la reconnaissance de signaux
                            moteurs intentionnels à partir de données brutes EEG.</li>
                        <li>Tester clinquement le dispositif sur un échantillon de patients atteints de troubles
                            moteurs (10 cas suivis).</li>
                        <li>Optimiser les performances du dispositif en conditions réelles et publier les résultats.
                        </li>
                        <li>Former deux doctorants dans le cadre du projet (signal + clinique).</li>
                    </ol>
                </section>

                <!-- Files Section -->
                <section class="file-download-list mb-5">
                    <h5>Fichiers à télécharger :</h5>
                    <a href="#" class="file-item">
                        <img width="30px"
                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com.png">
                        <span>Deeplearning_BCI_Systems.Pdf</span>
                    </a>
                    <a href="#" class="file-item">
                        <img width="30px"
                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com.png">
                        <span>Poster_Bci2025.Pdf</span>
                    </a>
                </section>
                <h3 class="section-heading">Responsable</h3>
                <!-- Responsible Section -->
                <section class="responsible-section d-flex align-items-center mb-auto">
                    <img src="https://i.pravatar.cc/150?u=omranebelhadj" alt="Avatar Omrane BELHADJ" class="avatar">
                    <div>
                        <div class="name">Omrane BELHADJ</div>
                    </div>
                </section>

                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="button" class="btn btn-submit" data-bs-toggle="modal"
                        data-bs-target="#submissionModal">
                        Soumettre ma demande
                    </button>
                </div>

            </div>
        </div>
    </main>

    <!-- Submission Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionModalLabel">Demande de soumission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-custom mb-4">
                        <img class="me-4" width="30px"
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-info.png"
                            alt="Icon-info.png">
                        <!-- <i class="fas fa-info-circle"></i> -->
                        <div style="font-size: 13px;">
                            Assurez-vous d'importer tous les documents requis pour garantir la prise en compte de votre
                            candidature.
                            <br>Tout dossier incomplet sera automatiquement écarté de la sélection.
                        </div>
                    </div>

                    <div class=" mb-3">
                        <label for="documentUpload" class="form-label">Documents demandés</label>
                        <div class="file-input-group">
                            <input type="text" class="form-control" placeholder="" readonly>
                            <button class="btn btn-import" type="button" id="importButton">

                                <img class="me-2" width="15px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"
                                    alt="">

                                Importer</button>
                        </div>
                        <input type="file" id="documentUpload" class="d-none" multiple>
                    </div>

                    <div id="uploadedFilesList" class="mt-3">
                        <div class="uploaded-file-item">
                            <div class="file-info">
                                <img width="24px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="PDF Icon">
                                <span>fichier 1.pdf</span>
                            </div>
                            <button class="delete-file-btn">
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="">
                                <!-- <i class="fas fa-trash-alt"></i> -->
                            </button>
                        </div>
                        <div class="uploaded-file-item">
                            <div class="file-info">
                                <img width="24px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                                    alt="PDF Icon">
                                <span>fichier 2.pdf</span>
                            </div>
                            <button class="delete-file-btn">
                                <!-- <i class="fas fa-trash-alt"></i> -->
                                <img width="20px"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                                    alt="">
                            </button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-submit" style="margin-inline: 0;">Envoyer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const importButton = document.getElementById('importButton');
            const documentUpload = document.getElementById('documentUpload');
            const uploadedFilesList = document.getElementById('uploadedFilesList');

            const attachDeleteListener = (button) => {
                button.addEventListener('click', function () {
                    this.closest('.uploaded-file-item').remove();
                });
            };

            // Attach listeners to pre-existing delete buttons
            document.querySelectorAll('.delete-file-btn').forEach(attachDeleteListener);

            importButton.addEventListener('click', () => {
                documentUpload.click();
            });

            documentUpload.addEventListener('change', () => {
                Array.from(documentUpload.files).forEach(file => {
                    addFileToList(file.name);
                });
                documentUpload.value = ''; // Reset file input
            });

            function addFileToList(fileName) {
                const fileItem = document.createElement('div');
                fileItem.className = 'uploaded-file-item';

                fileItem.innerHTML = `
                    <div class="file-info">
                        <img width="24px" src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="PDF Icon">
                        <span>${fileName}</span>
                    </div>
                    <button class="delete-file-btn">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;

                uploadedFilesList.appendChild(fileItem);

                // Attach listener to the new delete button
                const newDeleteButton = fileItem.querySelector('.delete-file-btn');
                attachDeleteListener(newDeleteButton);
            }
        });
    </script>

</body>

</html>