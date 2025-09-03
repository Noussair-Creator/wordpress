<section class="equipements-section">
  <div class="titre-ligne-wrapper">
    <div class="ligne-gauche"></div>
    <div class="titre-ligne">Services</div>
    <div class="ligne-droite"></div>
  </div>

  <h2 class="equipements-title">Autres Équipements</h2>

  <div class="equipements-grid">
    <div class="equipement-card">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 370.png" alt="Séquenceur">
      <div class="equipement-info">
        <span class="status">Gratuit</span>
        <h4>Séquenceur</h4>
        <a href="#" class="dispo-link" onclick="openModal(); return false;">Voir disponibilité</a>
      </div>
    </div>

    <div class="equipement-card">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 369.png" alt="PCR en temps réel">
      <div class="equipement-info">
        <span class="status">Gratuit</span>
        <h4>PCR en temps réel</h4>
        <a href="#" class="dispo-link" onclick="openModal(); return false;">Voir disponibilité</a>
      </div>
    </div>

    <div class="equipement-card">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 368.png" alt="Cytomètre">
      <div class="equipement-info">
        <span class="status">Gratuit</span>
        <h4>Cytomètre en flux 6 couleurs</h4>
        <a href="#" class="dispo-link" onclick="openModal(); return false;">Voir disponibilité</a>
      </div>
    </div>

    <div class="equipement-card">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 371.png" alt="Unité histologie">
      <div class="equipement-info">
        <span class="status">Gratuit</span>
        <h4>Unité Histologie</h4>
        <a href="#" class="dispo-link" onclick="openModal(); return false;">Voir disponibilité</a>
      </div>
    </div>
  </div>
</section>

<style>
  .equipements-section {
  padding: 60px 40px;
  background: #f9f9f4;
  text-align: center;
}

.equipements-title {
  font-size: 32px;
  font-weight: 700;
  color: #2a2916;
  margin-bottom: 40px;
}

.equipements-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 30px;
  justify-items: center;
}

.equipement-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.05);
  overflow: hidden;
  max-width: 300px;
  transition: transform 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: stretch;
      width: 350px;

}

.equipement-card:hover {
  transform: translateY(-6px);
}

.equipement-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.equipement-info {
  padding: 20px;
  text-align: left;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 170px;
}

.status {
  font-size: 15px;
  font-weight: 600;
  color: #888;
  margin-bottom: 5px;
  display: block;
}

.equipement-info h4 {
  font-size: 18px;
  font-weight: 700;
  color: #2a2916;
  margin-bottom: 10px;
}

.dispo-link {
  color: #b60303;
  font-weight: 500;
  font-size: 15px;
  text-decoration: underline;
  margin-top: auto;
}

</style>
