<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">

 <div class="column" id="column1">

   <div class="card with-image card4 card6" draggable="true">
      <div class="card-title2">Notre Mission</div>
      <p class="card-des">Accompagner les structures de recherches dans le montage, la gestion et le suivi des projets financés</p>
      <span class="corner-icon">↗</span>
    </div>

  </div>
 
  <div class="column" id="column2">

   <div class="card with-image card4 card66" draggable="true">
      <div class="card-title2">Opportunités</div>
      <p class="card-des">Explorez les appels à projets, les partenariats stratégiques et les programmes d’excellence...</p>
      <span class="corner-icon">↗</span>
    </div>

  </div>
 

</div>


 <div class="title-PMO">
        APPELS A PROJETS
   </div> 

   
<div class="card-grid pmo-projects">
  <div class="pmo-card">
    <div class="pmo-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/diagram-project.png" alt="ANPR Icon">
    </div>
    <div class="pmo-content">
      <div class="pmo-title">ANPR</div>
      <p class="pmo-description">Ouverture de l’appel à projets national le 10 juillet 2025</p>
    </div>
    <span class="pmo-corner-icon">↗</span>
  </div>

  <div class="pmo-card">
    <div class="pmo-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/partnership-svgrepo-com.png" alt="Horizon Icon">
    </div>
    <div class="pmo-content">
      <div class="pmo-title">Horizon Europe</div>
      <p class="pmo-description">Participez au programme européen de recherche – clôture le 20 juin 2025</p>
    </div>
    <span class="pmo-corner-icon">↗</span>
  </div>
</div>


  <?php include 'actualite_manifestations.php'; ?>


<div class="title-PMO" style="margin-top: 40px;">
        ACCOMPAGNEMENT
    </div>

    <div class="card-grid-support">
  <div class="support-card">
    <div class="support-content">
      <h3 class="support-title">Formation &<br>Webinaires</h3>
      <p class="support-text">Participez à nos événements pour renforcer</p>
    </div>
    <div class="support-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/online-meeting-conference-computer-internet-business-stayhome.png" alt="Formation">
    </div>
  </div>

  <div class="support-card">
    <div class="support-content">
      <h3 class="support-title">Assistance<br>personnalisée</h3>
      <p class="support-text">Bénéficiez d’un accompagnement adapté à vos besoins…</p>
    </div>
    <div class="support-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/costumer-support-call.png" alt="Support">
    </div>
  </div>

  <div class="support-card">
    <div class="support-content">
      <h3 class="support-title">Guide et<br>modèles</h3>
      <p class="support-text">Accédez facilement à des ressources pratiques pour vous accompagner…</p>
    </div>
    <div class="support-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/book-guide-handbook.png" alt="Guide">
    </div>
  </div>
</div>


  <!-- Colonne 1 -->
 <!-- <div class="column" id="column1">
    
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
  </div>-->

  <!-- Colonne 2 
  <div class="column" id="column2">
    <div class="card ged-card card5" draggable="true">
      <span class="corner-icon">↗</span>
    </div>

    <div class="card with-image card4" draggable="true">
      <div class="card-title">Formulaires Administratives</div>
      <span class="corner-icon">↗</span>
    </div>
  </div>
-->



<style>
.card-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  padding: 0px 0px;
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
p.card-des {
    text-align: justify;
    width: 240px;
}

.card.with-image.card6 {
    background-image: url('/wp-content/plugins/plateforme-master/imagesED/Image 38.png');
    background-size: 36%;
    background-repeat: no-repeat;
    background-position: 102%;
    padding-top: 26px;
    padding-bottom: 57px;
    margin-bottom: 20px;
}

.card.with-image.card66 {
    background-image: url('/wp-content/plugins/plateforme-master/images/pmo/Image 137.png');
    background-size: 36%;
    background-repeat: no-repeat;
    background-position: 102%;
    padding-top: 26px;
    padding-bottom: 81px;
    margin-bottom: 20px;
    background-position: right bottom;
}
.card-title2 {
    font-size: 20px;
    text-transform: capitalize;
    font-weight: 700;
    margin-bottom: 24px;
}

.title-PMO {
    background: #A6A485 0% 0% no-repeat padding-box;
    border-radius: 10px 0px 0px 10px;
    color: #fff;
    text-align: left;
    /* font: normal normal bold 20px / 30px Poppins; */
    letter-spacing: 0px;
    color: #FFFFFF;
    text-transform: uppercase;
    padding: 16px 27px;
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 20px;
}


.card-grid.pmo-projects {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
  gap: 30px;
  margin-top: 20px;
  margin-bottom: 20px;
}

.pmo-card {
 position: relative;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    display: flex;
    padding: 28px 20px 28px 36px;
    align-items: center;
    overflow: hidden;
}

.pmo-card::before {
    content: "";
    position: absolute;
    top: 11%;
    left: 0;
    width: 5px;
    height: 78%;
    background-color: #d10000;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    border-radius: 5px;
}

.pmo-icon {
  flex: 0 0 50px;
  margin-right: 18px;
}
.pmo-icon img {
    width: 60px;
    height: 52px;
}

.pmo-content {
  flex-grow: 1;
}

.pmo-title {
  font-size: 18px;
  font-weight: bold;
  color: #222;
  margin-bottom: 4px;
}

.pmo-description {
  margin: 0;
  font-size: 16px;
  color: #333;
  line-height: 1.4;
  width: 80%;
}

.pmo-corner-icon {
  position: absolute;
  top: 0;
  right: 0;
  background: #b00000;
  color: #fff;
  font-size: 20px;
  padding: 10px 16px;
  border-radius: 0 0 0 16px;
  font-weight: bold;
}

.card-grid-support {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 20px;
  margin-top: 30px;
}

.support-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  border-radius: 16px;
  padding: 24px;
  position: relative;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
  overflow: hidden;
}

.support-card::before {
    content: "";
    position: absolute;
    top: 23px;
    left: 0;
    width: 5px;
    height: calc(100% - 109px);
    background-color: #d10000;
    border-radius: 3px;
}
.support-content {
  max-width: 65%;
}

.support-title {
  font-size: 18px;
  font-weight: 700;
  color: #1c1c1c;
  margin: 0 0 10px;
  line-height: 1.4;
}

.support-text {
  margin: 0;
  font-size: 16px;
  color: #2d2d2d;
  line-height: 1.5;
}

.support-icon img {
  width: 67px;
  height: 59px;
}
.support-icon {
    position: absolute;
    top: 14%;
    right: 4%;
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

