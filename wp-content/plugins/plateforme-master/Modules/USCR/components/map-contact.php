<section class="map-contact-section">
  <div class="contact-card">
    <img src="/wp-content/plugins/plateforme-master/images/uscr/Image 48.png" class="logo-plateforme" alt="Logo">
    <h3>Plateforme de Recherche</h3>

    <a href="#" class="btn-rdv">Prendre rendez-vous</a>

    <div class="horaire-box">
      <table class="horaire-table">
        <tr><td>Lundi</td><td>Fermé</td></tr>
        <tr><td>Mardi</td><td>9:30 – 17:00</td></tr>
        <tr><td>Mercredi</td><td>9:30 – 17:00</td></tr>
        <tr><td>Jeudi</td><td>9:30 – 17:00</td></tr>
        <tr><td>Vendredi</td><td>9:30 – 17:00</td></tr>
        <tr><td>Samedi</td><td>9:30 – 13:00</td></tr>
        <tr><td>Dimanche</td><td>Fermé</td></tr>
      </table>
    </div>

    <div class="social-icons">
      <a href="#"><i class="fas fa-envelope"></i></a>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fas fa-globe"></i></a>
    </div>
  </div>

  <div class="map-box">
   <iframe
    src="https://www.google.com/maps?q=15+Rue+Dr.+Hassouna+Ben+Ayed,+Bab+Saadoun,+Tunis,+Tunisie&output=embed"
    frameborder="0"
    allowfullscreen=""
    aria-hidden="false"
    tabindex="0"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
  </div>
</section>


<style>
    .map-contact-section {
  display: flex;
  align-items: center; /* vertical align */
  justify-content: center;
  flex-wrap: wrap;
    padding: 60px 40px;
    padding-left: 120px;
    padding-right: 0px;

}

.contact-card {
  background: white;
  border-radius: 24px;
  padding: 30px 25px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  max-width: 350px;
  flex: 1;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  /*  background-image: url("/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 363.png");*/
    background-repeat: no-repeat;
    background-size: 100%;
  background-position: top left;
}

.logo-plateforme {
  width: 100px;
  height: auto;
  border-radius: 50%;
  margin-bottom: 15px;
}

.contact-card h3 {
  font-size: 18px;
  font-weight: 700;
  color: #2a2916;
  margin-bottom: 15px;
  text-align: center;
}

.btn-rdv {
  background-color: #b60303;
  color: #fff;
  text-align: center;
  padding: 10px 36px;
  border-radius: 6px;
  font-weight: 600;
  margin-bottom: 20px;
  text-decoration: none;
  display: inline-block;
  transition: background 0.3s;
}

.btn-rdv:hover {
  background-color: #920000;
}

.horaire-box {
  background: #fdfdfd;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  width: 100%;
  box-shadow: inset 0 0 0 1px #eee;
}

.horaire-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  color: #2a2916;
}

.horaire-table td {
    padding: 6px 0;
    text-align: left;
    letter-spacing: 0px;
    color: #2A2916;
    font-weight: 600;
}
.horaire-table td:last-child {
  text-align: right;
}

.social-icons {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-top: 10px;
}

.social-icons a {
  width: 36px;
  height: 36px;
  background: #A6A485;
  color: #fff;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 15px;
  transition: background 0.3s;
}

.social-icons a:hover {
  background: #b60303;
}

.map-box {
    flex: 2;
    min-width: 300px;
    height: auto;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    height: 450px;
}



.map-box iframe {
  width: 100%;
  height: 100%;
  border: none;
}

</style>