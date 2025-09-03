<section class="organisation-fonctionnelle">
  <div class="container-organisation">
    <h2>Organisation fonctionnelle</h2>
    <p>
      La plateforme est composée de <a href="#">4 unités spécialisées</a> disposant d’un matériel scientifique de pointe opérationnel et
      regroupant des compétences humaines de haut niveau. Les ressources humaines et technologiques de la
      plateforme supportent la réalisation de projets scientifiques de pointe, autant pour l’ensemble de la communauté
      scientifique académique que pour l’instauration de partenariats privés (industries pharmaceutiques,
      agroalimentaires, etc.).
    </p>

    <div class="grid-unites">
      <div class="unite-card unite-card1">
        <img class="bg-decor" src="/wp-content/plugins/plateforme-master/images/uscr/decor1.png" alt="">
        <img class="unite-icon" src="/wp-content/plugins/plateforme-master/images/uscr/Groupe 3277.png" alt="">
        <h4>Unité génomique</h4>
        <span class="arrow">→</span>
      </div>

      <div class="unite-card">
        <img class="unite-icon proteique-icon" src="/wp-content/plugins/plateforme-master/images/uscr/112737.png" alt="">
        <h4>Unité analyse cellulaire et <br> protéique</h4>
      </div>

      <div class="unite-card">
        <img class="unite-icon" src="/wp-content/plugins/plateforme-master/images/uscr/Groupe 3278.png" alt="">
        <h4>Unité techniques analytiques et <br>  appliquées</h4>
      </div>

      <div class="unite-card">
        <img class="unite-icon" src="/wp-content/plugins/plateforme-master/images/uscr/Groupe 3279.png" alt="">
        <h4>Unité histologie</h4>
      </div>
    </div>
  </div>
</section>


<style>
    .organisation-fonctionnelle {
  padding: 60px 30px;
  background: #fff;
  text-align: center;
}

.container-organisation {
  max-width: 1000px;
  margin: 0 auto;
}

.container-organisation h2 {
  font-size: 35px;
  font-weight: bold;
  color: #2a2916;
  margin-bottom: 20px;
}
.container-organisation p {
    font-size: 17px;
    line-height: 1.6;
    margin-bottom: 40px;
    letter-spacing: 0px;
    color: #2A2916;
}
.container-organisation p a {
  color: #b60303;
  font-weight: 500;
  text-decoration: underline;
}





.unite-card:hover {
  transform: translateY(-5px);
}

.bg-decor {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: auto;
  z-index: 0;
  opacity: 0.25;
  pointer-events: none;
}

.unite-icon {
  width: 80px;
    height: 80px;
  margin-bottom: 15px;
  position: relative;
  z-index: 1;
}



.arrow {
  display: block;
  margin-top: 10px;
  font-size: 18px;
  color: #2a2916;
  font-weight: bold;
  position: relative;
  z-index: 1;
}
.grid-unites {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 cartes par ligne */
  gap: 30px;
}

@media (max-width: 768px) {
  .grid-unites {
    grid-template-columns: 1fr; /* 1 par ligne en mobile */
  }
}

.unite-card {
  background: white;
  border-radius: 18px;
  padding: 30px 20px;
  position: relative;
  box-shadow: 0px 6px 19px #00000024;
  text-align: center;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.unite-card:hover {
  transform: translateY(-5px);
}

/* Décor d’arrière-plan : uniquement sur la première carte */
.unite-card1 .bg-decor {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: auto;
  z-index: 0;
  opacity: 0.2;
  pointer-events: none;
}

.unite-icon {
  width: 60px;
  height: 60px;
  margin-bottom: 15px;
  position: relative;
  z-index: 1;
}

img.unite-icon.proteique-icon {
  border-radius: 50px;
  background-color: #bf0404;
  padding: 9px;
}


.unite-card h4 {
    font-size: 20px;
    font-weight: 700;
    color: #2a2916;
    position: relative;
    z-index: 1;
    line-height: 1.5;
}


.arrow {
  display: block;
  margin-top: 10px;
  font-size: 18px;
  color: #2a2916;
  font-weight: bold;
  position: relative;
  z-index: 1;
}
.unite-card.unite-card1 {

    background-image:url("/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 363.png")
}
.unite-card.unite-card1 {
    background-image: url("/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 363.png");
    background-repeat: no-repeat;
    background-size: 100%;
}
</style>