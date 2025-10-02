<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid p-4">
  <!-- Colonne 1 -->
  <div class="column" id="column1">
    
    <div class="card with-image card2" draggable="true"><a href="/alimentation-et-saisie-des-donnees">
      <div class="card-title">Alimentation Et Saisie Des Données</div>
      <a href="/alimentation-et-saisie-des-donnees"><span class="corner-icon">↗</span></a></a>
    </div>

   


    <div class="card with-image card1" draggable="true"><a href="/depot-et-telechargement-des-donnees">
      <div class="card-title">Dépot Et Téléchargement Des Données</div>
      <a href="/depot-et-telechargement-des-donnees"><span class="corner-icon">↗</span></a></a>
    </div>
  </div>

  <!-- Colonne 2 -->
  <div class="column" id="column2">


    
    <div class="column2ligne2">

    

      

     <div class="card ged-card card5" draggable="true">
      <a href="/ged"><span class="corner-icon">↗</span></a></a>
    </div>

    </div>
   <!-- <div> -->
    <!-- GED -->
    <!-- <div class="card ged-card card5">
    <span class="corner-icon">↗</span>
    </div> -->
    <!-- Formulaires -->
  <!-- </div> -->


  </div>
</div>


<style>
.card-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 16px;
  padding: 20px 0px;
      padding-top: 0px !important;
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
    background-image: url('/wp-content/plugins/plateforme-master/images/pmo/jurys.png');

 background-size: 77%;
    background-repeat: no-repeat;
    padding-top: 17px;
    padding-bottom: 17px;
    margin-bottom: 20px;
    background-position: 100%;
}

.card.with-image.card2{
    background-image: url("/wp-content/plugins/plateforme-master/images/pmo/Groupe de masques 415.png");
    background-size: 106%;
    background-repeat: no-repeat;
    padding-top: 38px;
    padding-bottom: 38px;
    margin-bottom: 20px;
    margin-top: 20px;
}
.card.with-image.card3 {
  background-image: url('/wp-content/plugins/plateforme-master/images/imagesstudentmaster/Groupe de masques 446.png');
  background-size: 105%;
    background-repeat: no-repeat;
    padding-top: 18px;
    padding-bottom: 18px;
    margin-bottom: 20px;
    background-position: 95%;
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
  background-image: url("/wp-content/plugins/plateforme-master/images/icon etudiant/Groupe 2376.png");
background-size: 77%;
    background-repeat: no-repeat;
    padding-top: 149px;
    padding-bottom: 233px;
    margin-bottom: 0px;
    background-position: center center;
    flex: 1 1 22%;
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


.box-soutenance
 {
    position: relative;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    background-image: url("/wp-content/plugins/plateforme-master/images/imagesstudentmaster/Groupe de masques 457.png");
    background-size: 100%;
    background-position: bottom right;
    padding: 20px;
    min-height: 210px;
    display: flex
;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
    flex: 1 1 27%;
    background-repeat: no-repeat;
}

.soutenance-content {
  background: rgba(255, 255, 255, 0.85);
  padding: 24px;
  border-radius: 12px;
  width: fit-content;
  margin-left: -30px;
}

.soutenance-title {
  font-size: 18px;
  font-weight: 700;
  color: #2A2916;
  margin-bottom: 10px;
}
.column2ligne2 {
    display: flex
;
    gap: 16px;
    margin-top: 16px;
}
.soutenance-list {
  list-style: none;
  padding-left: 20px;
  margin: 0;
  font-size: 14px;
  color: #2A2916;
}

.soutenance-list li {
  position: relative;
  margin-bottom: 6px;
  line-height: 1.3em;
}

.soutenance-list li::before {
  content: "●";
  color: #7E7C5A;
  position: absolute;
  left: -12px;
  font-size: 10px;
  top: 4px;
}

.corner-icon {
  position: absolute;
  top: 0;
  right: 0;
  background: #b00000;
  color: white;
  font-weight: bold;
  font-size: 20px;
  padding: 10px 18px;
  border-radius: 0 0 0 16px;
}
/* === Aligner Top-Boxes et Grid === */

/* même grille et même gap */
.top-boxes{
  display: grid;                       /* au lieu de flex pour une vraie grille */
  grid-template-columns: repeat(3,1fr);
  gap: 20px;                           /* = card-grid ci-dessous */
  margin-top: 20px;
}

/* enfants prennent 100% de leur colonne, pas de calc foireux */
.top-boxes .box,
.top-boxes .boxINFO{
  width: 100%;
  flex: initial;                        /* annule flex: 1 1 calc(...) */
  display: flex;
  min-height: 180px;
}

/* la grille du dessous : même gap et pas de padding parasite */
.card-grid{ 
  grid-template-columns: 2fr 1fr; 
  gap: 20px; 
  padding-left: 0 !important; 
  padding-right: 0 !important; 
}

/* si tu veux carrément neutraliser toute la classe p-4 sur card-grid */
.card-grid.p-4{ padding: 0 !important; }

/* petit bonus : évite le décalage interne du 3e bloc */
.master-carousel-wrapper{ margin-top: 0; }  /* enlève le -36px */

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

