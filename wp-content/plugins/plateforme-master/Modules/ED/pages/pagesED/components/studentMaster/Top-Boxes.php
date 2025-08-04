<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<?php
            // Slides HTML
            $slide1 = '
            <div class="master-card">
              <h4><a href="/MASTER/GESTIONMASTER.php">Liste des master</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Master Professionnel :</div>
                  <div class="label">Master de recherche</div>
                  <div class="label">Master à distance:</div>
                </div>
                <div class="info-value">
                  <div class="value">12</div>
                  <div class="value">14</div>
                  <div class="value">2</div>
                </div>
              </div>
            </div>';

            $slide2 = '
            <div class="master-card">
              <h4><a href="/MASTER/FicheMaster.php">Informations master</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Code Master :</div>
                  <div class="label">Libellé du Master :</div>
                  <div class="label">Spécialité :</div>
                  <div class="label">Date d’habilitation :</div>
                  <div class="label">Président de la commission :</div>
                </div>
                <div class="info-value">
                  <div class="value">M456</div>
                  <div class="value">Master GRFA</div>
                  <div class="value">Sciences</div>
                  <div class="value">15/10/2024</div>
                  <div class="value">Mr. AHMED BEN AHMED</div>
                </div>
              </div>
            </div>';

            // Assemble les slides en fonction du rôle
            $carouselSlides = '';
            if ($role === "service") {
                $carouselSlides = $slide1 . $slide2 . $slide2; // Ajout de 3 slides
            } elseif ($role === "coordinateur") {
                $carouselSlides = $slide2; // Seulement 1 slide
            }

  ?>

<style>
/* Styles spécifiques au bloc .top-boxes */
.top-boxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}


.box {
    background-color: white;
    flex: 1 1 250px;
    display: flex
;
    gap: 15px;
    padding: 0px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s;
    cursor: pointer;
}

.box:hover, .boxINFO:hover {
  transform: translateY(-4px);
}
.box-icon {
    background: transparent linear-gradient(180deg, #A6A485 0%, #6E6D55 100%) 0% 0% no-repeat padding-box;
    padding: 20px;
    border-radius: 12px 0 0 12px;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 200px;
}
.img-box {
  max-height: 80%;
  max-width: 100%;
  object-fit: contain;
}
.box-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    align-items: center;
    margin-bottom: -16px;
}
.box-content h4 {
  margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--dark);
    padding-bottom: 10px;
        margin-top: 23px;
}
.list-box {
  margin: 0;
    padding-left: 20px;
    flex-grow: 0.5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
}


.boxINFO {
  background-color: #fff;
  flex: 1 1 100%;
  display: flex;
  flex-direction: column;
  padding: 24px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
  min-height: 220px;
    background-image: url("/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg");
    background-size: cover;
    background-repeat: no-repeat;
}

.boxINFO h4 {
   
    margin-bottom: 40px;
    font-size: 19px;
    font-weight: 600;
    color: #2A2916;
}
.boxINFO p {
    margin: 0 0 8px;
    font-size: 14px;
    color: #2A2916;
    font-size: 17px;
}

.boxINFO span {
    color: #7E7C5A;
    font-weight: 600;
    font-size: 15px;
    float: right;
}
.boxINFO button {
    background-color: #b00000;
    color: white;
    border: none;
    border-radius: 30px;
    padding: 11px 22px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 18px;
    transition: background 0.2s ease;
    margin-bottom: 20px;
}


.boxINFO button:hover {
  background-color: #990000;
}

.master-carousel-wrapper {
  width: 100%;
    margin: auto;
    text-align: center;
    margin-top: -36px;
}
.master-carousel-container {
  width: 100%;
  overflow: hidden;
  border-radius: 16px;
  position: relative;
}
.master-carousel {
  display: flex;
  transition: transform 0.6s ease;
}
.master-card {
  flex: 0 0 100%;
    padding: 0px;
    box-sizing: border-box;
    background: transparent;
    border-radius: 16px;
    text-align: left;
    padding-top: 35px;

}
.master-card h4 {
  margin-bottom: 10px;
  color: #222;
}
.info-flex {
  display: flex;
  gap: 20px;
}
.info-line {
  width: 40%;
  display: flex;
  flex-direction: column;
}
.info-value {
  width: 60%;
  display: flex;
  flex-direction: column;
}
.label, .value {
  font-size: 14px;
  margin-bottom: 4px;
}
.carousel-dots {
  float: right;
  position: relative;
  top: 28px;
  z-index: 9999;
}
.carousel-dots span {
  height: 10px;
  width: 10px;
  margin: 0 4px;
  background-color: #bbb;
  display: inline-block;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.carousel-dots .active {
  background-color: #333;
}
img.img-box {
    width: 50px;
}
.box-content.box-content-info {
    padding: 0px;
}

.info-flex .value {
    font-weight: 500;
}
.box li {
    line-height: 1.2em;
}

.box.box2 {
    flex: 1 1 46%;
    padding: 20px;
}

.box.box3 {
    flex: 1 1 21%;
    padding: 20px;
}


.bloc-gp {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

.bloc-gp .col1{
  flex: 1 1 58%;
}
.bloc-gp .col2 {
  flex: 1 1 25%;
}
/* Responsive (colonne unique en mobile) */
@media (max-width: 768px) {
  .bloc-gp .col1,
  .bloc-gp .col2 {
    flex: 1 1 100%;
  }
}




.chart-legend-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

.custom-legend {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.custom-legend .legend-item {
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #333;
}

.custom-legend .color-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 8px;
}

.fixed-chart {
  width: 100%;
  max-width: 210px;
  aspect-ratio: 1 / 1; /* garantit que la hauteur suit la largeur */
  display: block;
  margin: 10px auto 0 auto;
}


.barometre-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  width: 100%;
}

.barometre-header h4 {
  margin: 0;
  font-size: 19px;
  font-weight: 600;
  color: #2A2916;
}
.barometre-header select {
    padding: 4px 14px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #ffffff;
    color: #2A2916;
    appearance: none;
    cursor: pointer;
    outline: none;
    float: right;
    position: relative;
    left: 100%;
    font-weight: 600;
}

.chart-legend-container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 30px;
  flex-wrap: wrap;
}

.fixed-chart {
  width: 100%;
  max-width: 200px;
  aspect-ratio: 1 / 1;
  display: block;
}

.custom-legend {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.custom-legend .legend-item {
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #2A2916;
}

.custom-legend .color-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 8px;
}




.voir-plus-link {
  font-size: 14px;
  color: #7E7C5A;
  text-decoration: none;
  font-weight: 500;
}

.voir-plus-link .fleche {
  font-weight: bold;
  margin-left: 4px;
}

.barometre-header select {
  padding: 4px 14px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background: #fff;
  color: #2A2916;
  font-weight: 500;
  height: 36px;
  box-shadow: none;
  appearance: none;
  cursor: pointer;
}


.voir-plus-wrapper {
    margin-top: 15px;
    text-align: right;
    width: 100%;
    float: right;
    position: relative;
    left: 100%;
}
.voir-plus-link {
  font-size: 14px;
  color: #7E7C5A;
  text-decoration: none;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
}

.voir-plus-link .fleche {
  font-weight: bold;
  margin-left: 4px;
  font-size: 15px;
}

.boxINFO button i {
  margin-right: 8px;
  color: #fff;
}
.master-feature-card {
    flex: 1 1 50%;
    display: flex
;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #ffffff 50%, #c3c0ac 50%);
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    font-family: 'Segoe UI', sans-serif;
    font-weight: 600;
    font-size: 16px;
    min-height: 120px;
    transition: transform 0.3s ease;
}
.master-feature-card:hover {
  transform: translateY(-4px);
}
.feature-text {
    max-width: 37%;
    color: #000;
    font-size: 25px;
    line-height: 24px;
}
.feature-icon {
  font-size: 40px;
  color: #000;
}
img.card-image.card-image2 {
 width: 90px;
    height: 90px;
    border-radius: 0px;
}

</style>



<?php
// Exemple de données dynamiques
$derniere_connexion = '09/01/2025 à 15h44';
$absences = 60;
$presences = 40;
?>



<div class="bloc-gp">

<div class="col1">
  
    <div class="top-boxes">
      <!-- Bloc 1 : Assiduité -->
      <div class="box">
        <div class="box-icon">
          <img src="/imagesMaster/27) Icon-person-done.png" alt="" class="img-box">
        </div>
        <div class="box-content">
          <h4>Assiduité</h4>
          <ul class="list-box">
            <li>Présence</li>
            <li>Stages</li>
          </ul>
        </div>
      </div>

      <!-- Bloc 2 : Calendriers -->
      <div class="box">
        <div class="box-icon">
          <img src="/imagesMaster/27) Icon-calendar.png" alt="" class="img-box">
        </div>
        <div class="box-content">
          <h4>Calendriers</h4>
          <ul class="list-box">
            <li>Examens</li>
            <li>Rattrapage</li>
            <li>Soutenances</li>
          </ul>
        </div>
      </div>

    </div>

    
      <!-- Ligne 2 -->
      <div class="top-boxes" style="margin-top: 20px;">
        <!-- Bloc 4 : Baromètre -->
        <div class="box box2">
          <div class="box-content">
            <div class="barometre-header">
              <h4>Baromètre des absences</h4>
              <select id="periodeSelect">
                <option>le mois dernier</option>
                <option>le trimestre dernier</option>
                <option>l'année universitaire</option>
              </select>
            </div>

            <div class="chart-legend-container">
              <canvas id="absenceChart" class="fixed-chart"></canvas>
              <div id="absenceChartLegend" class="custom-legend"></div>
            </div>

            <div class="voir-plus-wrapper">
              <a href="#" class="voir-plus-link">Voir plus <span class="fleche">→</span></a>
            </div>


          </div>
        </div>

      </div>


</div>
<div class="col2">

     <div class="top-boxes">
      <!-- Bloc 3 : Aperçu de mon compte -->
       <div class="boxINFO">
          <h4>Aperçu de mon compte</h4>

          <p>Dernière connexion: <span><?= $derniere_connexion ?></span></p>

          <p>Mise à jour du mot de passe</p>
          <button><i class="fas fa-rotate-right"></i> Mettre à jour</button>

          <p>Attestation d’activation compte</p>
          <button><i class="fas fa-download"></i> Télécharger</button>

        </div>



      </div>


        <!-- Ligne 2 -->
      <div class="top-boxes" style="margin-top: 20px;">
   
        <div class="master-feature-card">
          <div class="feature-text">Note et résultats</div>
              <img class="card-image card-image2" src="/wp-content/plugins/plateforme-master/images/imagesstudentmaster/2574034.png" alt="">
          </div>
        </div>

      </div>

      

</div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
  const ctxPie = document.getElementById('absenceChart').getContext('2d');

  const chart = new Chart(ctxPie, {
    type: 'pie',
    data: {
      labels: ['Absences', 'Présence'],
      datasets: [{
        data: [<?= $absences ?>, <?= $presences ?>],
        backgroundColor: ['#A6A485' , '#bc0503'],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }, // ❌ on remplace par une légende personnalisée
        tooltip: {
          callbacks: {
            label: ctx => `${ctx.label} : ${ctx.raw}%`
          }
        },
        datalabels: {
          color: '#ffffff', // ✅ forcer blanc pour toutes les valeurs dans le graphique
          font: {
            size: 16,
            weight: 'bold'
          },
          formatter: value => value + '%'
        }
      }
    },
    plugins: [ChartDataLabels]
  });

  // ✅ Générer la légende personnalisée
  const legendContainer = document.getElementById('absenceChartLegend');
  chart.data.labels.forEach((label, i) => {
    const color = chart.data.datasets[0].backgroundColor[i];
    const item = document.createElement('div');
    item.classList.add('legend-item');
    item.innerHTML = `<span class="color-dot" style="background-color:${color}"></span>${label}`;
    legendContainer.appendChild(item);
  });
</script>




