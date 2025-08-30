<?php
// CardMembresDeLaboratoire2.php

// This component displays a list of news-style cards with a header and filter bar.
// It includes all its own styling to be self-contained.
?>

<style>
/* * Main container for the entire news block */
.actualites-container {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    font-family: 'Segoe UI', sans-serif;
}

/* * Styles for the header bar (Title and button) */
.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.dashboard-sub-title {
    font-weight: bold;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-divider {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 16px 0;
}

/* * Styles for the filter bar section */
.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding-bottom: 20px;
    position: relative;
    /* Keep relative positioning if needed */
}

.filter-bar .filter-input,
.filter-bar .filter-select {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.6rem 0.75rem;
    background-color: #fdfdfd;
    font-size: 14px;
    height: 42px;
    box-sizing: border-box;
    transition: border-color 0.2s;
    min-width: 180px;
    /* Keep a min-width */
}

.filter-bar .filter-input {
    width: 220px;
    /* Keep original width */
}

.filter-bar .filter-input:focus,
.filter-bar .filter-select:focus {
    outline: none;
    border-color: #c60000;
}

.filter-bar .filter-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5rem;
    cursor: pointer;
}

.filter-bar .icon-btn {
    width: 42px;
    height: 42px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background-color: #fdfdfd;
    color: #BF0404;
    cursor: pointer;
    transition: background-color 0.2s;
    font-size: 16px;
}

.filter-bar .icon-btn:hover {
    background-color: #f5f5f5;
}

.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
    align-items: center;
}

.filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    position: relative;
}

.filter-bar {
    background: #fff;
    font-family: 'Poppins', sans-serif;
    padding: 10px 0px;
    display: grid;
}

.search-input {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 220px;
}

.filter-select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #f9f9f9;
}

.search-btn,
.icon-btn {
    padding: 8px 12px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
}

.filter-inputs {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.filter-input,
.filter-select {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
    background-color: #fff;
}

.input-with-icon {
    position: relative;
}

.input-with-icon .icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
    font-size: 14px;
}

.input-with-icon .left-icon {
    left: 0.85rem;
}

.input-with-icon .right-icon {
    right: 0.85rem;
}

.input-with-icon .date-input {
    padding-left: 0.75rem;
    /* Reset default left padding */
    padding-right: 2.5rem;
    /* Add space for right icon */
}

.input-with-icon .date-input {
    padding-left: 0.75rem;
    /* Reset default left padding */
    padding-right: 2.5rem;
    /* Add space for right icon */
}

/* * Styles for the news card component. */
.news-card-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.news-card {
    background-color: #fdfdfd;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    position: relative;
}

.news-card::before {
    content: "";
    position: absolute;
    left: 0;
    top: 24px;
    width: 3px;
    height: 28px;
    background-color: #c60000;
    border-radius: 1.5px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.category-tag {
    border: 1px solid #c60000;
    color: #c60000;
    background-color: #fff;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 14px;
    font-weight: 500;
}

.news-date {
    font-size: 14px;
    color: #65676b;
}

.news-title {
    font-size: 17px;
    font-weight: bold;
    color: #1c1e21;
    margin-top: 0;
    margin-bottom: 8px;
}

.news-description {
    font-size: 16px;
    color: #65676b;
    line-height: 1.5;
    margin-bottom: 16px;
}

.read-more-link {
    font-size: 16px;
    color: #c60000;
    text-decoration: none;
    font-weight: 600;
}

.read-more-link:hover {
    text-decoration: underline;
}
</style>

<div class="actualites-container mt-4">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/imagesED/5228529.png" alt="Icon" style="width: 38px;">
            Liste Des Actualités De L'utm
        </h2>
    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" type="text" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon"></i>
            </div>

            <!-- Category Select -->
            <div class="input-with-icon">
                <select class="filter-select">
                    <option value="" disabled selected>Catégorie</option>
                    <option>Appels a projets</option>
                    <option>Colloque</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>

            <!-- Source Select -->
            <div class="input-with-icon">
                <select class="filter-select">
                    <option value="" disabled selected>Sources</option>
                    <option>Interne</option>
                    <option>Externe</option>
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
        </div>
    </div>

    <div class="news-card-container">
        <!-- First News Card -->
        <div class="news-card">
            <div class="card-header">
                <span class="category-tag">Appels a projets</span>
                <span class="news-date">13-06-2025</span>
            </div>
            <div class="card-body">
                <h2 class="news-title">Lancement Du Programme Horizon Europe 2025</h2>
                <p class="news-description">
                    Le Lorem Ipsum Est, En Imprimerie, Une Suite De Mots Sans Signification Utilisée À Titre Provisoire
                    Pour Calibrer Une Mise En Page, Le Texte Définitif Venant Remplacer Le Faux-Texte Dès Qu'il Est Prêt
                    Ou Que La Mise En Page Est Achevée.
                </p>
                <a href="#" class="read-more-link">Lire La Suite</a>
            </div>
        </div>

        <!-- Second News Card -->
        <div class="news-card">
            <div class="card-header">
                <span class="category-tag">Colloque</span>
                <span class="news-date">13-06-2025</span>
            </div>
            <div class="card-body">
                <h2 class="news-title">Colloque National Sur La Valorisation Des Brevets</h2>
                <p class="news-description">
                    Le Lorem Ipsum Est, En Imprimerie, Une Suite De Mots Sans Signification Utilisée À Titre Provisoire
                    Pour Calibrer Une Mise En Page, Le Texte Définitif Venant Remplacer Le Faux-Texte Dès Qu'il Est Prêt
                    Ou Que La Mise En Page Est Achevée.
                </p>
                <a href="#" class="read-more-link">Lire La Suite</a>
            </div>
        </div>
    </div>
</div>