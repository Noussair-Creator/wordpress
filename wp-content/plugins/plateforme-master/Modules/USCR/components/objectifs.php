<!-- Ligne de titre -->
<div class="titre-ligne-wrapper">
  <div class="ligne-gauche"></div>
  <div class="titre-ligne">Objectifs</div>
  <div class="ligne-droite"></div>
</div>

<!-- Section Objectifs -->
<section class="objectifs-section">
  <div class="objectifs-wrapper">
    <!-- Colonne gauche ADN -->
    <div class="objectifs-dna">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/adn.png" alt="ADN">
    </div>

    <!-- Colonne droite contenu -->
    <div class="objectifs-content">
      <h2>Domaines d’activités<br> et Objectifs</h2>

      <div class="objectifs-line">
        <div class="line-red"></div>
        <div class="line-grey"></div>
      </div>

      <div class="objectifs-cards">
        <div class="objectif-card">
          <div class="cardimg">
                <img src="/wp-content/plugins/plateforme-master/images/uscr/interactivity-icon.png" alt="">
          </div>
          <p><strong>• L’appui à la recherche de haut niveau :</strong> par le soutien des activités de recherches de différents demandeurs grâce au développement et à l’implantation de nouvelles technologies</p>
        </div>

        <div class="objectif-card">
          <div class="cardimg">

          <img src="/wp-content/plugins/plateforme-master/images/uscr/27) Icon-globe.png" alt="">

          </div>
          <p><strong>• L’appui à la formation de pointe :</strong> par la réalisation de formation théorique et pratique au niveau international</p>
        </div>

        <div class="objectif-card">
            <div class="cardimg">
                <img src="/wp-content/plugins/plateforme-master/images/uscr/27) Icon-people.png" alt="">
            </div>
          <p><strong>• L’appui au développement technologique :</strong> par la mise en place d’un partenariat avec les entreprises.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
    /* Titre Objectifs */
.titre-ligne-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 60px 0 40px;
  position: relative;
  gap: 10px;
  padding: 0 120px;
}

.ligne-gauche, .ligne-droite {
  flex: 1;
  height: 2px;
  background-color: #b60303;
  position: relative;
}

.ligne-gauche::after,
.ligne-droite::before {
  content: "";
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 10px;
  height: 10px;
  background-color: #b60303;
  border-radius: 50%;
}

.ligne-gauche::after { right: 0; }
.ligne-droite::before { left: 0; }

.titre-ligne {
  padding: 10px 30px;
  border: 2px solid #b60303;
  border-radius: 999px;
  font-size: 16px;
  color: #b60303;
  font-weight: 500;
  background-color: white;
  white-space: nowrap;
}

/* Section Objectifs */
.objectifs-section {
  padding: 60px 120px;
  background: #fff;
}

.objectifs-wrapper {
  display: flex;
  gap: 40px;
  align-items: flex-start;
  justify-content: space-between;
  flex-wrap: wrap;
}

/* ADN à gauche */
.objectifs-dna {
  flex: 1;
  max-width: 250px;
}

.objectifs-dna img {
  width: 100%;
  height: auto;
}

/* Contenu à droite */
.objectifs-content {
  flex: 3;
  min-width: 300px;
}

.objectifs-content h2 {
  font-size: 35px;
  color: #2a2916;
  font-weight: 700;
  margin-bottom: 25px;
}

/* Ligne rouge + grise */
.objectifs-line {
  display: flex;
  align-items: center;
  height: 6px;
  margin-bottom: 30px;
}

.line-red {
  width: 157px;
  height: 4px;
  background: #b60303;
  border-radius: 10px 0 0 10px;
}

.line-grey {
  flex: 1;
  height: 4px;
  background: #ccc;
  border-radius: 0 10px 10px 0;
}

/* Cartes Objectifs */
.objectifs-cards {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.objectif-card {
  background: #fff;
  border-radius: 10px;
  flex: 1;
  min-width: 240px;
  padding: 20px;
  text-align: left;
}

.objectif-card img
 {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
    background: transparent linear-gradient(180deg, #A6A485 0%, #6E6D55 100%) 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 14px #00000029;
    border-radius: 8px;
    padding: 5px;
}

.objectif-card p {
    font-size: 17px;
    color: #2a2916;
    line-height: 1.5;
    color: #2A2916;
    margin-top: 20px;
    text-align: justify;
}
.cardimg {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 14px #00000029;
    width: max-content;
    padding: 10px;
    border-radius: 8px;
    padding-bottom: 0px;
}
</style>
