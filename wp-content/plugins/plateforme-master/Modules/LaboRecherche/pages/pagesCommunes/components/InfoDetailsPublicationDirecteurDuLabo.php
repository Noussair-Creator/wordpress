<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
/* Custom styles for the info component */
.info-container {
    background-color: #ffffff;
    padding: 24px 32px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    width: 100%;
    margin-bottom: 20px;
    /* Added margin for spacing between components */
}

.info-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.info-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-item {
    display: flex;
    flex-wrap: wrap;
    padding: 16px 0;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.95rem;
    align-items: flex-start;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item-label {
    color: #555;
    font-weight: 600;
    width: 250px;
    flex-shrink: 0;
    padding-right: 15px;
}

.info-item-value {
    color: #212529;
    flex-grow: 1;
    flex-basis: 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .info-item-label {
        width: 100%;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .info-item-value {
        width: 100%;
    }
}
</style>

<div class="info-container">
    <div class="info-header">
        <h2>Informations générales</h2>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Valider
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Approuver</a></li>
                <li><a class="dropdown-item" href="#">Rejeter</a></li>
                <li><a class="dropdown-item" href="#">Demander une modification</a></li>
            </ul>
        </div>
    </div>

    <ul class="info-list">
        <li class="info-item">
            <span class="info-item-label">Titre complet :</span>
            <span class="info-item-value">Deep Learning for Brain-Computer Interface Systems</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Type de publication :</span>
            <span class="info-item-value">Article de conférence IEEE</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Auteur(s) :</span>
            <span class="info-item-value">Dr. Sarra Messaoudi (Maître-Assistant, Labo IA & Signal – FDST)</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Date de soumission :</span>
            <span class="info-item-value">05/08/2025</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Mots-clés :</span>
            <span class="info-item-value">Deep Learning, BCI, Neurosciences, Signal Processing</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Statut actuel :</span>
            <span class="info-item-value">En attente de validation</span>
        </li>
        <li class="info-item">
            <span class="info-item-label">Résumé (Abstract) :</span>
            <span class="info-item-value">Cet article explore l'utilisation des réseaux de neurones convolutifs et
                des modèles Transformer pour améliorer la précision des systèmes d'interfaces cerveau-machine (BCI).
                Les résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport aux
                méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications en
                neuro-réhabilitation et contrôle de prothèses intelligentes.</span>
        </li>
    </ul>
</div>