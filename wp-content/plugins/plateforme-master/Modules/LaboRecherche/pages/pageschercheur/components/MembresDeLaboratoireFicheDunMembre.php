<style>
.content-wrapper {
    padding: 25px;
    max-width: 900px;
    margin: 2rem auto;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    border: none;
    position: relative;
    /* Needed for positioning the dropdown */
}

/* Original .card h3 styling restored */
.card h3 {
    font-size: 21px;
    margin-bottom: 14px;
    font-weight: bold;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    color: #2A2916;
}

/* Dropdown positioned at the top right of the card */
.card .dropdown {
    position: absolute;
    top: 20px;
    right: 20px;
}

.kebab-button {
    background: transparent;
    border: none;
    font-size: 16px;
    color: #6c757d;
    cursor: pointer;
}

/* Original .styled-list with modifications for layout */
.styled-list {
    list-style: none;
    padding: 0;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.styled-list li {
    padding: 15px 10px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    gap: 200px;
    /* Aligns items to ends */
    align-items: center;
    color: #333;
}

.styled-list li:last-child {
    border-bottom: none;
}

/* Original strong styling */
.styled-list strong {
    font-weight: 500;
    color: #6E6D55;
    min-width: 240px;
    /* Ensures alignment */
}

.styled-list span {
    display: flex;
    align-items: center;
    text-align: right;
}

/* General style for all links in the list */
.styled-list li a {
    text-decoration: none;
    font-weight: 500;
    color: black;
    /* Default color for links */
}

/* Specific style for the email link to make it blue and underlined */
.styled-list li a[href^="mailto"] {
    color: #0d6efd;
    text-decoration: underline;
}


/* Styling for new elements, kept minimal */
.profile-pic {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 12px;
    object-fit: cover;
}

.pdf-icon {
    color: #d93025;
    margin-right: 6px;
}

.status-active-icon {
    color: #28a745;
    font-size: 10px;
    margin-right: 8px;
}
</style>


<div class="content-wrapper">
    <div class="card full-width">
        <!-- Dropdown Menu -->
        <div class="dropdown">
            <button class="btn kebab-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Modifier</a></li>
                <li><a class="dropdown-item" href="#">Envoyer email</a></li>
            </ul>
        </div>

        <!-- Card Header -->
        <h3>Informations générales</h3>

        <!-- Details List using original class name -->
        <ul class="styled-list">
            <li>
                <strong>Nom complet :</strong>
                <span>
                    <img src="http://wordpress.test:8080/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg"
                        class="profile-pic" alt="Profile Picture">
                    Dr. Sarra Messaoudi
                </span>
            </li>
            <li><strong>Grade / Statut :</strong> <span>Maitre assistant</span></li>
            <li><strong>Spécialité :</strong> <span>Intelligence Artificielle</span></li>
            <li><strong>Affectation :</strong> <span>ISAMM – Département Informatique</span></li>
            <li><strong>Email :</strong> <a href="mailto:sarra.messaoudi@utm.tn">sarra.messaoudi@utm.tn</a></li>
            <li><strong>Téléphone :</strong> <span>+216 71 123 456</span></li>
            <li><strong>Date d'entrée au labo :</strong> <span>15/01/2022</span></li>
            <li><strong>Equipe de recherche :</strong> <span>Systèmes Intelligents Distribués</span></li>
            <li><strong>Projet associé :</strong> <span>BCI-Learn, ARUX</span></li>
            <li><strong>Encadrements :</strong> <span>2 thèses, 1 mastère</span></li>
            <li>
                <strong>CV / Dossier :</strong>
                <span>
                    <a href="#"><i class="fas fa-file-pdf pdf-icon"></i>CV_Sarra_Messaoudi.pdf</a>
                </span>
            </li>
            <li>
                <strong>Etat :</strong>
                <span><i class="fas fa-circle status-active-icon"></i>Actif</span>
            </li>
        </ul>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>