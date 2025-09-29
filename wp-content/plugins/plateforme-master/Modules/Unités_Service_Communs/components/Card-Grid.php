<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface USCR</title>
    <script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Première grille : 1fr 1fr pour les cartes principales du haut -->
<div class="top-grid px-4">
  <div class="card with-image card-gestion" draggable="true" id="gestion-card">
    <a href="/gestion-des-plateformes">
      <div class="card-title">Gestion des Plateformes</div>
      <span class="corner-icon">↗</span>
    </a>
  </div>

  <div class="card card-statistiques-equipements" draggable="true" id="stats-card">
    <a href="/statistiques-equipements">
      <div class="stats-header">
        <div class="stats-title">Statistique / Equipements</div>
        <div class="stats-period-dropdown">
          <span>2024 - 2025</span>
          <i class="fas fa-chevron-down"></i>
        </div>
        <span class="corner-icon">↗</span>
      </div>
      <div class="chart-container">
        <div class="chart-y-axis">
          <div class="y-label">2500</div>
          <div class="y-label">2000</div>
          <div class="y-label">1500</div>
          <div class="y-label">1000</div>
          <div class="y-label">500</div>
        </div>
        <div class="chart-area">
          <div class="chart-bars">
            <div class="bar-container">
              <div class="bar" data-height="1000"></div>
              <div class="bar-label">En panne</div>
            </div>
            <div class="bar-container">
              <div class="bar" data-height="1800"></div>
              <div class="bar-label">Maintenance</div>
            </div>
            <div class="bar-container">
              <div class="bar" data-height="1700"></div>
              <div class="bar-label">Incidents</div>
            </div>
          </div>
          <div class="chart-grid">
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <div class="card with-image card-utilisateurs" draggable="true" id="utilisateurs-card">
    <a href="/utilisateurs-autorises-responsables">
      <div class="card-title">Utilisateurs Autorisés et Responsables</div>
      <span class="corner-icon">↗</span>
    </a>
  </div>
</div>

<!-- Deuxième grille : 2fr 1fr pour les autres cartes -->
<div class="card-grid p-4">
  <!-- Colonne 1 -->
  <div class="column" id="column1">

    <div class="card-row">
      <div class="card with-image card-equipements" draggable="true">
        <a href="/equipements">
          <div class="card-title">Equipements</div>
        </a>
      </div>

      <div class="card with-image card-salles" draggable="true">
        <a href="/salles">
          <div class="card-title">Salles</div>
        </a>
      </div>
    </div>

    <div class="card with-image card-reservations" draggable="true">
      <a href="/reservations">
        <div class="card-title">Reservations</div>
        <span class="corner-icon">↗</span>
      </a>
    </div>

    <div class="card with-image card-maintenance" draggable="true">
      <a href="/maintenance">
        <div class="card-title">Maintenance</div>
        <span class="corner-icon">↗</span>
      </a>
    </div>
  </div>

  <!-- Colonne 2 -->
  <div class="column" id="column2">

    <div class="card with-image card-historique" draggable="true">
      <a href="/historique-statistiques">
        <div class="card-title">Historique et statistiques</div>
        <span class="corner-icon">↗</span>
      </a>
    </div>

     <div>
    <!-- GED -->
    <div class="card ged-card card5">
    <span class="corner-icon">↗</span>
    </div>
    <!-- Formulaires -->
  </div>

  </div>
</div>

<style>
/* Première grille en 2x2 pour les cartes principales */
.top-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 16px;
  padding: 20px 0px;
  margin-bottom: 16px;
  height: 340px; /* Hauteur fixe pour assurer l'uniformité */
}
.card.ged-card.card5 {
  background-image: url("/wp-content/plugins/plateforme-master/images/icon etudiant/Groupe 2376.png");
  background-size: 200px;
  background-repeat: no-repeat;
  padding-top: 171px;
  padding-bottom: 146px;
  background-position: center center;
}

.top-grid .card {
  min-height: 160px;
  height: 100%; /* Les cartes prennent toute la hauteur de leur cellule */
}

/* Carte Gestion des plateformes - position 1,1 */
.card-gestion {
  grid-row: 1;
  grid-column: 1;
}

/* Carte Statistique/Equipements - s'étend sur les 2 lignes */
.card-statistiques-equipements {
  grid-row: 1 / 3; /* S'étend de la ligne 1 à la ligne 3 (donc 2 lignes) */
  grid-column: 2;
}

/* Carte Utilisateurs - position 2,1 */
.card-utilisateurs {
  grid-row: 2;
  grid-column: 1;
}

/* Deuxième grille en 2fr 1fr pour les autres cartes */
.card-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 16px;
  padding: 0px;
}

.column {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.card-row {
  display: flex;
  gap: 16px;
}

.card-row .card {
  flex: 1;
}

.card {
  position: relative;
  background: #fff;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  overflow: hidden;
  user-select: none;
  min-height: 120px;
  display: flex;
  align-items: flex-start;
}

.card a {
  text-decoration: none;
  color: inherit;
  display: block;
  width: 100%;
  height: 100%;
}

.card-title {
  font-size: 20px;
  font-weight: 700;
  padding: 12px;
  border-radius: 0 8px 8px 0;
  max-width: 200px;text-align: left;
font: normal normal bold 20px/23px Roboto;
letter-spacing: 0px;
color: #2A2916;
opacity: 1;
margin-top:20px
}

.corner-icon {
  position: absolute;
  top: 0px;
  right: 0px;
  background: #b00000;
  color: #fff;
  font-size: 20px;
  padding: 8px 18px;
  border-radius: 0px 12px 0px 16px;
  font-weight: 700;
}

/* Styles spécifiques pour chaque carte */
.card-gestion {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe 415.png');
  background-size: 60%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 140px;
}

.card-utilisateurs {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe 416.png');
  background-size: 50%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 140px;
}

/* Effet oblique + icône à droite */
.card-equipements{
  background-image:
    url('/wp-content/plugins/plateforme-master/images/uscr/2092248.png'),                 /* icône */
    url('/wp-content/plugins/plateforme-master/images/Groupe%20de%20masques%20474.png');  /* oblique */
  background-repeat: no-repeat, no-repeat;
  background-size: 20%, cover;            /* taille icône, puis fond oblique */
  background-position: right 60px center, center;
  min-height: 190px;
}

.card-salles{
  background-image:
    url('/wp-content/plugins/plateforme-master/images/uscr/27)%20Icon-home.png'),         /* icône */
    url('/wp-content/plugins/plateforme-master/images/Groupe%20de%20masques%20474.png');  /* oblique */
  background-repeat: no-repeat, no-repeat;
  background-size: 12%, cover;
  background-position: right 68px center, center;
  min-height: 190px;
}

.card-reservations {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 447.png');
  background-size: 107%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 180px;
}

.card-maintenance {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 448.png');
  background-size: 107%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 180px;
}

.card-statistiques {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 462.png');
  background-size: 45%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 160px;
}

.card-statistiques-equipements {
  background: #fff;
  min-height: 180px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  border: 1px solid #e0e0e0;
  grid-row: 1 / 3;
  grid-column: 2;
}

.stats-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  position: relative;
}

.stats-title {
  font-size: 16px;
  font-weight: 700;
  color: #333;
}

.stats-period-dropdown {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f5f5f5;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 14px;
  color: #666;
  cursor: pointer;
  margin-right: 58px;
}

.stats-period-dropdown i {
  font-size: 12px;
}

.chart-container {
  flex: 1;
  display: flex;
  position: relative;
  padding: 10px 0;
}

.chart-y-axis {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 40px;
  height: 200px;
  padding-right: 10px;
}

.y-label {
  font-size: 11px;
  color: #888;
  text-align: right;
  line-height: 1;
}

.chart-area {
  flex: 1;
  position: relative;
  height: 200px;
}

.chart-grid {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  pointer-events: none;
}

.grid-line {
  height: 1px;
  background: #f0f0f0;
  width: 100%;
}

.chart-bars {
  display: flex;
  align-items: flex-end;
  justify-content: space-around;
  height: 100%;
  padding: 0 20px;
  position: relative;
  z-index: 1;
}

.bar-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;
  justify-content: flex-end;
}

.bar {
  width: 40px;
  background: #BF040473 0% 0% no-repeat padding-box;
  border-radius: 2px 2px 0 0;
  margin-bottom: 8px;
  position: relative;
}

/* Calcul des hauteurs basé sur l'échelle 0-2500 */
.bar[data-height="1000"] {
  height: 40%; /* 1000/2500 = 40% */
}

.bar[data-height="1800"] {
  height: 72%; /* 1800/2500 = 72% */
}

.bar[data-height="1700"] {
  height: 68%; /* 1700/2500 = 68% */
}

.bar-label {
  font-size: 11px;
  color: #666;
  text-align: center;
  margin-top: 4px;
  line-height: 1.2;
}

.card-statistiques-equipements .corner-icon {
  position: absolute;
  top: 0;
  right: 0;
  background: #b00000;
  color: #fff;
  font-size: 18px;
  padding: 6px 12px;
  border-radius: 0 12px 0 12px;
  font-weight: 700;
}

.card-historique {
  background-image: url('/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 462.png');
  background-size: 81%;
  background-repeat: no-repeat;
  background-position: right center;
  min-height: 245px;
}

.card-ged {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 456.png');
  background-size: 80%;
  background-repeat: no-repeat;
  background-position: center bottom;
  min-height: 200px;
  background-color: #8B9B7A;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  padding: 20px;
}

.ged-label {
  background: #B00000;
  color: white;
  font-size: 24px;
  font-weight: bold;
  padding: 8px 16px;
  border-radius: 20px;
  width: fit-content;
  margin-bottom: 8px;
}

.ged-subtitle {
  color: white;
  font-size: 12px;
  font-weight: 500;
  max-width: 120px;
  line-height: 1.3;
}

.card-ged .corner-icon {
  background: #fff;
  color: #B00000;
}

.card[draggable="true"] {
  cursor: grab;
}

.card[draggable="true"]:active {
  cursor: grabbing;
}

/* Responsive pour mobile */
@media (max-width: 768px) {
  .card-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  
  .card-row {
    flex-direction: column;
  }
  
  .card-title {
    font-size: 16px;
  }
}
/* Retirer la bordure rouge du titre pour ces cartes */
.card-gestion .card-title,
.card-utilisateurs .card-title,
.card-reservations .card-title,
.card-maintenance .card-title {
  border-left: none !important;
  padding-left: 12px;
}

/* Ajouter une barre rouge verticale à gauche de la carte */
.card-gestion,
.card-utilisateurs,
.card-reservations,
.card-maintenance {
  position: relative;
  padding-left: 32px;  /* espace entre barre et contenu */
}

.card-gestion::before,
.card-utilisateurs::before,
.card-reservations::before,
.card-maintenance::before {
  content: "";
  position: absolute;
  left: 12px;
  top: 10px;
  bottom: 10px;
  width: 4px;
  background: #bc0503;
  border-radius: 6px;
  pointer-events: none;
  z-index: 1;
}

/* Le contenu reste au-dessus de la pseudo-bordure */
.card-gestion > *,
.card-utilisateurs > *,
.card-reservations > *,
.card-maintenance > * {
  position: relative;
  z-index: 2;
}

</style>

<script>
function initDragAndDrop(columnSelector) {
  let draggedItem = null;

  const cards = document.querySelectorAll(`${columnSelector} .card`);
  const column = document.querySelector(columnSelector);

  cards.forEach(card => {
    card.addEventListener('dragstart', e => {
      draggedItem = card;
      setTimeout(() => card.style.display = 'none', 0);
    });

    card.addEventListener('dragend', () => {
      draggedItem.style.display = 'flex';
      draggedItem = null;
    });
  });

  column.addEventListener('dragover', e => {
    e.preventDefault();
  });

  column.addEventListener('drop', e => {
    if (draggedItem && column.contains(draggedItem) === false) return;
    column.appendChild(draggedItem);
  });
}

// Initialisation du drag & drop pour tous les conteneurs
document.addEventListener('DOMContentLoaded', function() {
  // Drag & drop pour la grille du haut
  initDragAndDropForGrid('.top-grid');
  
  // Drag & drop pour les colonnes du bas
  initDragAndDrop('#column1');
  initDragAndDrop('#column2');
});

function initDragAndDropForGrid(gridSelector) {
  let draggedItem = null;
  const cards = document.querySelectorAll(`${gridSelector} .card`);
  const grid = document.querySelector(gridSelector);

  cards.forEach(card => {
    card.addEventListener('dragstart', e => {
      draggedItem = card;
      setTimeout(() => card.style.display = 'none', 0);
    });

    card.addEventListener('dragend', () => {
      draggedItem.style.display = 'flex';
      draggedItem = null;
    });
  });

  grid.addEventListener('dragover', e => {
    e.preventDefault();
  });

  grid.addEventListener('drop', e => {
    if (draggedItem) {
      grid.appendChild(draggedItem);
    }
  });
}
</script>

</body>
</html>