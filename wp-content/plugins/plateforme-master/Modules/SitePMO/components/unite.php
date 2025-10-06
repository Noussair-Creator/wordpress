<section class="unite-genomique">
  <div class="genomique-container">
    <!-- Colonne gauche : images -->
    <div class="genomique-images">
      <img class="main-image" src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 365.png" alt="Machine principale">

      <div class="sub-images">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 365.png" alt="Machine secondaire">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 367.png" alt="Autre équipement">
      </div>
    </div>

    <!-- Colonne droite : contenu -->
    <div class="genomique-content">
      <p class="responsable">Responsable : <span>Pr. Madiha Trabelsi</span></p>
      <h2>Unité Génomique</h2>

      <p class="description">
        Cette unité est spécialisée dans les technologies d’analyse génétique moléculaire. Elle offre les services suivants :
      </p>

      <ul class="services">
        <li> Séquençage de type Sanger.</li>
        <li>Génotypage pour les marqueurs microsatellites.</li>
        <li>PCR quantitative en temps réel.</li>
      </ul>

      <h3>Equipements Scientifiques :</h3>
      <ul class="equipements">
        <li> ABI 3500 Genetic Analyzer System Thermocycleur</li>
        <li>ABI 7500 Real Time PCR System</li>
        <li> Fluoromètre Qubit 3.</li>
      </ul>

      <a href="#" class="btn-rdv">Prendre rendez-vous</a>
    </div>
  </div>
</section>


<style>
  .unite-genomique {
  padding: 60px 60px;
  background: #fff url('/images/background-lines.svg') no-repeat center bottom;
  background-size: cover;
}

.genomique-container {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  align-items: flex-start;
  justify-content: space-between;
}

.genomique-images {
  flex: 1;
  min-width: 300px;
}

.main-image {
  width: 100%;
  border-radius: 16px;
  margin-bottom: 20px;
}

.sub-images {
  display: flex;
  gap: 15px;
}

.sub-images img {
    border-radius: 16px;
    width: 154px;
    height: 89px;
}

.genomique-content {
  flex: 1;
  min-width: 300px;
}

.responsable {
  font-size: 16px;
  margin-bottom: 5px;
  color: #2a2916;
}

.responsable span {
  color: #8a8653;
  font-weight: 500;
}

.genomique-content h2 {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 20px;
  color: #2a2916;
}

.description {
  font-size: 16px;
  margin-bottom: 20px;
  color: #2a2916;
}

.services,
.equipements {
  list-style: none;
  padding-left: 0;
  margin-bottom: 20px;
}

.services li,
.equipements li {
  font-size: 16px;
  color: #2a2916;
  margin-bottom: 10px;
  position: relative;
  padding-left: 25px;
}

.services li::before,
.equipements li::before {
  content: "▶";
  position: absolute;
  left: 0;
  color: #b60303;
  font-size: 14px;
}

.genomique-content h3 {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 10px;
  color: #2a2916;
}

.btn-rdv {
  display: inline-block;
  margin-top: 20px;
  background: #b60303;
  color: white;
  padding: 14px 35px;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  font-size: 16px;
  transition: background 0.3s;
}

.btn-rdv:hover {
  background: #920000;
}

@media (max-width: 768px) {
  .genomique-container {
    flex-direction: column;
  }

  .sub-images {
    flex-direction: column;
  }

  .sub-images img {
    width: 100%;
  }
}

</style>