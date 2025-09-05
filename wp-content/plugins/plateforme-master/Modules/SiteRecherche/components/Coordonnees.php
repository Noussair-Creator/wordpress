<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* General body styling */
body {
    font-family: 'Inter', sans-serif;
    background-color: #f8f9fa;
}

/* Background pattern from the image */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: -1;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 810"><path fill="none" stroke="%23e9ecef" stroke-width="1.5" d="M-286 565c293-293 628-501 1006-625s785 18 1111 262-115 625-493 749-785-18-1111-262S-579 858-286 565z"/><path fill="none" stroke="%23e9ecef" stroke-width="1.5" d="M-286 595c293-293 628-501 1006-625s785 18 1111 262-115 625-493 749-785-18-1111-262S-579 888-286 595z"/></svg>');
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    opacity: 0.7;
}

/* Added a simple top bar to match the screenshot */
.top-bar {
    background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 436.png');
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    height: 200px;
    width: 100%;
}

/* hero section */
.breadcrumb-custom {
    background-color: rgb(83 81 81 / 40%);
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    margin-bottom: 2rem;
    color: white;
    font-size: 0.9rem;
}

.breadcrumb-custom a {
    margin: 0;
    color: white;
    text-decoration: none;
}

.breadcrumb-custom a:hover {
    text-decoration: underline;
}

.breadcrumb-custom span {
    color: #e9ecef;
    margin: 0 0.5rem;
}

/* Main container adjustments */
.main-container {
    padding-top: 2.5rem;
    padding-bottom: 4rem;
    position: relative;
    margin-top: -175px;
    /* This moves the container up */
    z-index: 1;
    /* This ensures the container is on top */
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: #495057;
    margin-bottom: 1.5rem;
    font-weight: 500;
    transition: color 0.2s ease;
}

.back-link:hover {
    color: #b60303;
}

/* Profile Card Styling */
.profile-card {
    background-color: #ffffff;
    border: none;
    /* Removed border to match screenshot */
    border-radius: 0.75rem;
    /* Slightly smaller radius */
    box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.07);
    padding: 2rem;
    text-align: left;
    /* Changed text-align to left for items */
}

.profile-card .profile-header {
    text-align: center;
    /* Centered only the image and name */
    margin-bottom: 1.5rem;
}

.profile-card img {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    object-fit: cover;
    margin-bottom: 1rem;
    /* Removed border from the image */
}

.profile-card .name {
    font-size: 1.25rem;
    /* Adjusted font size */
    font-weight: 600;
    color: #212529;
    margin: 0;
}

.profile-card .info-item {
    margin-bottom: 1rem;
}

/* This is a key change to stack the label and value */
.profile-card .info-item strong {
    display: block;
    color: #212529;
    /* Darker color to match screenshot */
    font-size: 0.875rem;
    font-weight: 600;
    /* Made it bolder */
    margin-bottom: 0.25rem;
}

.profile-card .info-item span {
    color: #6c757d;
    /* Lighter color for the value */
    font-size: 0.95rem;
}

/* Details Card Styling */
.details-card {
    background-color: #ffffff;
    border: none;
    /* Removed border */
    border-radius: 0.75rem;
    box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.07);
    padding: 60px 40px 140px;
}

/* Removed border from the H2 */
.details-card h2 {
    font-weight: 600;
    font-size: 1.25rem;
    color: #212529;
    margin-bottom: 2rem;
}

.detail-group {
    margin-bottom: 1.5rem;
}

.detail-group .label {
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.5rem;
}

.detail-group .value {
    color: #495057;
    /* Darker value color */
    padding-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
}

/* Last item should not have a border */
.detail-group:last-of-type .value {
    border-bottom: none;
}

/* Custom Red Button */
.btn-custom-red {
    background-color: #b60303;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 10px 111px;
    font-weight: 100;
    font-size: 20px;
    transition: background-color 0.2s ease;
}

.btn-custom-red:hover {
    background-color: #9a0202;
    color: white;
}
</style>

<div class="top-bar"></div>

<main class="container main-container">
    <a href="/presentation-utm" class="back-link">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                Structures de recherche </a> <span>›</span> Annuaire
        </div>
    </a>


    <div class="row g-4">
        <div class="col-lg-4">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 367.png"
                        alt="Photo de Dr. Sarra Messaoudi">
                    <h1 class="name">Dr. Sarra Messaoudi</h1>
                </div>
                <div class="info-item">
                    <strong>Grade / Statut :</strong>
                    <span>Maitre assistant</span>
                </div>
                <div class="info-item">
                    <strong>Spécialité :</strong>
                    <span>Intelligence Artificielle</span>
                </div>
                <div class="info-item">
                    <strong>Téléphone :</strong>
                    <span>22 369 158</span>
                </div>
                <div class="info-item">
                    <strong>Email :</strong>
                    <span>sarra@utm.tn</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="details-card">
                <h2>Coordonnées :</h2>

                <div class="detail-group">
                    <p class="label">Structure de recherche :</p>
                    <p class="value">Droit des relations internationales, des marchés et des négociations (DRIMAN)
                    </p>
                </div>

                <div class="detail-group">
                    <p class="label">Etablissement :</p>
                    <p class="value">Faculté de Droit et des Sciences Politiques de Tunis - Université de Tunis El
                        Manar</p>
                </div>

                <div class="detail-group">
                    <p class="label">Département :</p>
                    <p class="value">Campus Universitaire</p>
                </div>

                <div class="mt-5 d-flex gap-3 justify-content-center">
                    <a href="#" class="btn btn-custom-red">Projets liés</a>
                    <a href="#" class="btn btn-custom-red">Publications liés</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>