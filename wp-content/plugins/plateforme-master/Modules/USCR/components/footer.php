<!-- SVG vague inversée -->
<!--<div class="footer-wave-top">
  <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
    <path fill="#f3f3ec" d="M0,32L40,53.3C80,75,160,117,240,138.7C320,160,400,160,480,144C560,128,640,96,720,80C800,64,880,64,960,69.3C1040,75,1120,85,1200,101.3C1280,117,1360,139,1400,149.3L1440,160L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
  </svg>
</div>-->

<!-- Footer coordonnees -->
<footer class="footer-coordonnees">
  <div class="footer-wrapper">
    <div class="footer-left">
      <img src="/wp-content/plugins/plateforme-master/images/uscr/Image 48.png" alt="Logo Plateforme">
    </div>

    <div class="footer-middle">
      <h4>Coordonnées :</h4>
      <p>
        Plateforme de recherche en <br>
        « Sciences et technologies de la médecine » <br>
        Faculté de médecine de Tunis
      </p>
    </div>

    <div class="footer-right">
      <p><i class="fas fa-map-marker-alt"></i> 15 Rue Dr. Hassouna Ben Ayed<br>La Rabta. 1007, Tunis – Tunisie</p>
      <p><i class="fas fa-envelope"></i> platformederecherche.fmt@fmt.utm.tn</p>
      <div class="footer-icons">
        <a href="#"><i class="fas fa-envelope"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fas fa-globe"></i></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom-bar">
    <hr>
    <div class="bottom-bar-content">
      <span>Copyright ©2025 UTM</span>
      <span> Tous droits réservés. Conception et réalisation <strong>CLICKERP</strong></span>
    </div>
  </div>



</footer>

<style>
  .footer-wave-top {
  position: relative;
  width: 100%;
  height: 100px;
  overflow: hidden;
  margin-bottom: -5px;
  z-index: 1;
}

.footer-wave-top svg {
  display: block;
  width: 100%;
  height: 100%;
}

.footer-coordonnees {
  background-image: url("/wp-content/plugins/plateforme-master/images/uscr/Tracé 1293.png");
      background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 60px 120px 20px;
    font-family: 'Arial', sans-serif;
    color: #2a2916;
    position: relative;
    z-index: 0;
}

.footer-wrapper {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-start;
  gap: 60px;
}

.footer-left img {
    width: 127px;
    height: 127px;
}

.footer-middle h4 {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
  position: relative;
}

.footer-middle h4::after {
  content: "";
  width: 50px;
  height: 4px;
  background: #b60303;
  position: absolute;
  left: 0;
  bottom: -6px;
  border-radius: 2px;
}

.footer-middle p {
    margin-top: 25px;
    font-size: 18px;
    line-height: 1.6;
    letter-spacing: 0px;
    color: #2A2916;
}
.footer-right p {
  font-size: 16px;
  margin-bottom: 15px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.footer-right p i {
  color: #b60303;
  font-size: 18px;
  margin-top: 2px;
  min-width: 20px;
}

.footer-icons {
  display: flex;
  gap: 15px;
  margin-top: 10px;
}

.footer-icons a {
  width: 40px;
  height: 40px;
  background: #c5c2a4;
  color: white;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  transition: background 0.3s;
}

.footer-icons a:hover {
  background: #b60303;
}

.footer-bottom {
  margin-top: 30px;
  text-align: center;
  font-size: 14px;
  color: #777;
}

.footer-bottom hr {
  margin-bottom: 10px;
  border: none;
  border-top: 1px solid #ccc;
}

@media (max-width: 768px) {
  .footer-wrapper {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .footer-right p {
    justify-content: center;
  }
}
.footer-wave-top svg {
  display: block;
  width: 100%;
  height: 100%;
  transform: rotate(180deg); /* Inverse la vague */
}.footer-right {
  margin-left: auto; /* ✅ pousse à droite */
}

.footer-icons {
  display: flex;
  gap: 15px;
  margin-top: 15px;
}

.footer-icons a {
  width: 44px;
  height: 44px;
  background: #c5c2a4; /* couleur beige */
  color: white;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  transition: background 0.3s, transform 0.3s;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.footer-icons a:hover {
  background: #b60303;
  transform: scale(1.1);
}
.footer-bottom-bar {
  margin-top: 40px;
}

.footer-bottom-bar hr {
  border: none;
  border-top: 1px solid #dcdacb;
  margin-bottom: 15px;
}

.bottom-bar-content {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  color: #666;
  flex-wrap: wrap;
  gap: 10px;
}

.bottom-bar-content strong {
  color: #999;
  font-weight: 500;
}

@media (max-width: 768px) {
  .bottom-bar-content {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
}

</style>