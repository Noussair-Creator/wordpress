<script src="https://kit.fontawesome.com/TA_CLE_FONT_AWESOME_PRO.js" crossorigin="anonymous"></script>

<div class="card-grid">
  <div>
    <!-- Gestion académique -->
    <div class="card with-image card3">
      <div class="card-title">Gestion académique et administrative</div>
      <img class="card-image" src="/imagesMaster/administration.png" alt="">
      <span class="corner-icon">↗</span>
    </div>

    <!-- Insertion pro -->
    <div class="card with-image card2">
      <div class="card-title">Appel à Candidature</div>
      <img class="card-image" src="/imagesMaster/1fd54917-d9f9-4aa0-8ec0-f28abb0e5587.jpg" alt="">
      <span class="corner-icon">↗</span>
    </div>

 
  </div>

  <div>
    <!-- GED -->
    <div class="card ged-card card5">
    <span class="corner-icon">↗</span>
    </div>
    <!-- Formulaires -->
  </div>

</div>
<div class="card-flex">
  <!-- Bloc Conventions -->
<div class="master-feature-card">
  <div class="feature-text">Conventions & entreprises</div>
  <div class="feature-icon"><i class="fas fa-building"></i></div>
</div>

<!-- Bloc Indicateurs -->
<div class="master-feature-card">
  <div class="feature-text">Indicateurs<br>intelligents & qualité</div>
  <div class="feature-icon"><i class="fas fa-brain"></i></div>
</div>

<!-- Bloc Soutenances -->
<div class="master-feature-card">
  <div class="feature-text">Soutenances</div>
  <div class="feature-icon"><i class="fas fa-briefcase-graduate"></i></div>
</div>

<!-- Bloc Rapports -->
<div class="master-feature-card">
  <div class="feature-text">Génération de<br>rapports</div>
  <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
</div>


</div>

<style>
.card-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 16px;
  padding: 20px 0px 10px;
}
.card-flex {
  display: flex;
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
  background-position: 59px -16px;
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

.master-feature-card {
  flex: 1 1 50%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: linear-gradient(135deg, #ffffff 50%, #c3c0ac 50%);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
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
  max-width: 65%;
  color: #000;
}
.feature-icon {
  font-size: 40px;
  color: #000;
}


</style>
