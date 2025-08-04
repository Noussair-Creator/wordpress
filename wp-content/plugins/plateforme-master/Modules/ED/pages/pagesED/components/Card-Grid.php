<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">
  <!-- Colonne 1 -->
  <div class="column" id="column1">
    
    <div class="card with-image card2" draggable="true"><a href="/appel-a-candidature">
      <div class="card-title">Appel à Candidature</div>
      <a href="/appel-a-candidature"><span class="corner-icon">↗</span></a></a>
    </div>

    <div class="card with-image card3" draggable="true">
      <div class="card-title">Gestion académique et administrative</div>
      <span class="corner-icon">↗</span>
    </div>


    <div class="card with-image card1" draggable="true">
      <div class="card-title">Évaluation de la qualité & satisfaction</div>
      <span class="corner-icon">↗</span>
    </div>
  </div>

  <!-- Colonne 2 -->
  <div class="column" id="column2">
    <div class="card ged-card card5" draggable="true">
      <span class="corner-icon">↗</span>
    </div>

    <div class="card with-image card4" draggable="true">
      <div class="card-title">Formulaires Administratives</div>
      <span class="corner-icon">↗</span>
    </div>
  </div>
</div>


<style>
.card-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 16px;
  padding: 20px 0px;
}
.card {
  position: relative;
  background: #fff;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  overflow: hidden;
}
.card-title {
  border-left: 5px solid #bc0503;
    width: 180px;
    font-size: 20px;
    font-weight: 700;
    padding: 12px;
}
.card-image {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 0 0 12px 12px;
}
.corner-icon {
    position: absolute;
    top: 0px;
    right: -2px;
    background: #b00000;
    color: #fff;
    font-size: 24px;
    padding: 8px 21px;
    border-radius: 0px 0px 0px 19px;
    position: absolute;
    font-weight: 700;
}
.card.with-image.card1 {
  background-image: url('/imagesMaster/Groupe de masques 445.png');
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 12px;
  padding-bottom: 12px;
  margin-bottom: 20px;
}
.card.with-image.card2 {
  background-image: url('/imagesMaster/Groupe de masques 454.png');
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 35px;
  padding-bottom: 35px;
  margin-bottom: 20px;
  background-position: 59px -5px;
}
.card.with-image.card3 {
  background-image: url('/imagesMaster/Groupe de masques 447.png');
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 12px;
  padding-bottom: 12px;
  margin-bottom: 20px;
}
.card.with-image.card4 {
  background-image: url('/imagesMaster/Groupe de masques 456.png');
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 27px;
  padding-bottom: 24px;
  background-position: center center;
    margin-bottom: 20px;

}
.card.ged-card.card5 {
  background-image: url("/imagesMaster/Groupe 2376.png");
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 171px;
  padding-bottom: 158px;
  margin-bottom: 20px;
  background-position: center center;
}
.card {
  /* autres styles */
  user-select: none; /* optionnel : empêche sélection de texte au drag */
}

.card[draggable="true"] {
  cursor: grab;
}

.card[draggable="true"]:active {
  cursor: grabbing;
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
      draggedItem.style.display = 'block';
      draggedItem = null;
    });
  });

  column.addEventListener('dragover', e => {
    e.preventDefault(); // autorise le drop dans la colonne
  });

  column.addEventListener('drop', e => {
    if (draggedItem && column.contains(draggedItem) === false) return; // interdit drop externe
    column.appendChild(draggedItem);
  });
}

// Initialisation des deux groupes séparément
initDragAndDrop('#column1');
initDragAndDrop('#column2');
</script>

