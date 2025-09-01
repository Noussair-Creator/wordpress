<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">
  <!-- Colonne 1 -->
  <div class="column" id="column1">
    
    <div class="card with-image card1" draggable="true">
      <div class="card-title"><a href="/formations/">Crédits & Formations</a></div>
      <a href="/formations/"><span class="corner-icon">↗</span></a>
    </div>


    <div class="card with-image card2" draggable="true"><a href="#">
      <div class="card-title"><a href="/conventions-de-cotutelle/">Conventions de cotutelle des doctorants</a></div>
      <a href="/conventions-de-cotutelle/"><span class="corner-icon">↗</span></a></a>
    </div>

    <div class="card with-image card3" draggable="true">
      <div class="card-title"><a href="/admissions-doctorants-etrangers-1/"> Bourse d’alternance </a></div>
      <a href="/admissions-doctorants-etrangers-1/"><span class="corner-icon">↗</span></a>
    </div>

  </div>

  <!-- Colonne 2 -->
  <div class="column" id="column2">
   
   <div class="card with-image card4 card6" draggable="true">
      <div class="card-title2"><a href="/contrats-post-doctoraux/">contrats de post-doctorat</a></div>
      <a href="/contrats-post-doctoraux/"><span class="corner-icon">↗</span></a>
    </div>

    <div class="card with-image card4 card7" draggable="true">
      <div class="card-title2"><a href="/admissions-doctorants-etrangers/">Admissions des doctorants étrangers</a></div>
      <a href="/admissions-doctorants-etrangers/"><span class="corner-icon">↗</span></a>
    </div>


     <div class="card ged-card card5" draggable="true">
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
.card-title2 {
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
    background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 415.png');
    background-size: 57%;
    background-repeat: no-repeat;
    padding-top: 24px;
    padding-bottom: 24px;
    margin-bottom: 20px;
    background-position: right;
}
.card.with-image.card2 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 416.png');
     background-size: 57%;
    background-repeat: no-repeat;
    padding-top: 8px;
    padding-bottom: 9px;
    margin-bottom: 20px;
    background-position: right;
}
.card.with-image.card3 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 414.png');
  background-size: 57%;
  background-repeat: no-repeat;
  padding-top: 25px;
  padding-bottom: 24px;
  margin-bottom: 20px;
  background-position: right;
}
.card.with-image.card4 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 456.png');
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 24px;
  padding-bottom: 24px;
  background-position: center center;
    margin-bottom: 20px;

}
.card.ged-card.card5 {
      background-image: url(/imagesMaster/Groupe 2376.png);
    background-size: 35%;
    background-repeat: no-repeat;
    padding-top: 86px;
    padding-bottom: 56px;
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
.card.with-image.card6 {
    background-image: url('/wp-content/plugins/plateforme-master/imagesED/image-removebg-preview (21).png');
    background-size: 26%;
    background-repeat: no-repeat;
    background-position: 78%;
    padding-top: 26px;
    padding-bottom: 28px;
    margin-bottom: 20px;
}

.card.with-image.card7 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/international-svgrepo-com.png'); /* remplacez par le vrai nom */
     background-size: 26%;
    background-repeat: no-repeat;
    background-position: 78%;
   padding-top: 18px;
    padding-bottom: 12px;
    margin-bottom: 20px;
}
.card.with-image{
    border-color: #fff;
}
.card.ged-card.card5 {
      border: none;
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

