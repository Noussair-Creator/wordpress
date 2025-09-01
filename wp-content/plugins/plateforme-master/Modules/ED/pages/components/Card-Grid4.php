<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">
  <!-- Colonne 1 -->
  <div class="column" id="column1">
    

    <div class="boxLine">
         <div class="card with-image card3" draggable="true">
          <a href="/inscription-en-these/"><div class="card-title">Inscription en thèse</div></a>
          <a href="/inscription-en-these/"><span class="corner-icon">↗</span></a>
        </div>


        <div class="card with-image card2" draggable="true">
          <a href="/demande-adm/"> <div class="card-title">Demandes administratives</div></a>
          <a href="/demande-adm/"><span class="corner-icon">↗</span></a>
        </div>

    </div>
   <div class="boxLine">
         <div class="card with-image card1" draggable="true">
          <a href="/manifestation-scientifiques/"><div class="card-title">Manifestations scientifiques</div></a>
          <a href="/manifestation-scientifiques/"><span class="corner-icon">↗</span></a>
        </div>


        <div class="card with-image card4" draggable="true">
          <a href="/appel-a-projets/"><div class="card-title">Appel à <br> Projets</div></a>
          <a href="/appel-a-projets/"><span class="corner-icon">↗</span></a>
        </div>

    </div>


  </div>

  <!-- Colonne 2 -->
  <div class="column" id="column2">
  

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
    width: 210px;
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
    background-image: url("/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 415.png");
    background-size: 108%;
    background-repeat: no-repeat;
    padding-top: 28px;
    padding-bottom: 28px;
    margin-bottom: 20px;
    background-position: -312% 44%;
}
.card.with-image.card2 {
  background-image: url('/wp-content/plugins/plateforme-master/imagesED/demande adm.png');
     background-size: 59%;
    background-repeat: no-repeat;
      padding-top: 28px;
    padding-bottom: 28px;
    margin-bottom: 20px;
    background-position: right;
}
.card.with-image.card3 {
    background-image: url('/wp-content/plugins/plateforme-master/imagesED/jurys.png');
    background-size: 124%;
    background-repeat: no-repeat;
    padding-top: 28px;
    padding-bottom: 28px;
    margin-bottom: 20px;
    background-position: -93% 7%;
}
.card.with-image.card4 {
    background-image: url('/wp-content/plugins/plateforme-master/imagesED/Groupe 415.png');
      background-size: 67%;
  background-repeat: no-repeat;
  padding-top: 37px;
  padding-bottom: 12px;
  background-position: right;
  margin-bottom: 20px;
}
.card.ged-card.card5 {
      background-image: url(/imagesMaster/Groupe 2376.png);
   background-size: 77%;
    background-repeat: no-repeat;
    padding-top: 136px;
    padding-bottom: 183px;
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
.boxLine {
    display: grid
;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    /* grid-template-columns: max-content; */
    gap: 16px;
    flex-wrap: nowrap;
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

