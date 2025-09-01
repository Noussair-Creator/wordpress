<?php
// ---------------- Slides statiques (inchangé) ----------------
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

$carouselSlides = '';
if ($role === "service") {
  $carouselSlides = $slide1 . $slide2 . $slide2;
} elseif ($role === "coordinateur") {
  $carouselSlides = $slide2;
}

// URL absolue de l’image de fond
$pmo_bg = trailingslashit( get_site_url() ) .
          'wp-content/plugins/plateforme-master/images/pmo/' .
          rawurlencode('Groupe de masques 416.png');

// URL gestion requêtes
$gestion_requetes_url = trailingslashit( get_site_url() ) . 'gestion-requetes';
?>
<style>
:root{ --red:#b60303; --gray:#f3f3f3; --dark:#333; }

/* ====== Layout égalisé des 3 tuiles ====== */
.top-boxes{ display:flex; flex-wrap:wrap; gap:20px; margin-top:20px; align-items:stretch; }
.box, .boxINFO{
  flex: 1 1 calc(33.333% - 20px);
  min-height: 180px;
  background:#fff;
  border-radius:12px;
  box-shadow:0 2px 6px rgba(0,0,0,.08);
  transition:transform .2s;
  cursor:pointer;
  display:flex;
  padding:0;
}
.box:hover, .boxINFO:hover{ transform: translateY(-4px); }

/* Bande olive gauche */
.box-icon{
  width:92px; align-self:stretch;
  border-radius:12px 0 0 12px;
  background: linear-gradient(180deg,#A6A485 0%,#6E6D55 100%);
  display:flex; justify-content:center; align-items:center;
}
.img-box{ max-width:52px; max-height:52px; object-fit:contain; }

/* Contenu texte */
.box-content{ flex:1 1 auto; display:flex; flex-direction:column; align-items:flex-start; padding:18px; }
.box-content h4{ margin:0 0 10px; font-size:18px; font-weight:700; color:var(--dark); }
.list-box{ margin:0; padding-left:18px; display:flex; flex-direction:column; gap:8px; }
.list-box li{ list-style:none; position:relative; padding-left:12px; line-height:1.25; }
.list-box li::before{ content:""; width:6px; height:6px; border-radius:50%; background:#6E6D55; position:absolute; left:0; top:.55em; }

/* Tuile 3 avec image de fond */
.boxINFO{
  position:relative;
  max-width:none;
  background-image:url('<?php echo esc_url($pmo_bg); ?>');
  background-size:cover;
  background-position:center;
}
.boxINFO::before{
  content:""; position:absolute; inset:0 auto 0 0; width:65%;
  background: linear-gradient(90deg, rgba(255,255,255,.95) 0%, rgba(255,255,255,.8) 70%, rgba(255,255,255,0) 100%);
  clip-path: polygon(0 0, 80% 0, 50% 100%, 0% 100%);
  border-radius:12px 0 0 12px; z-index:1;
}
.boxINFO-title{ position:absolute; z-index:2; top:18px; left:20px; margin:0; color:#222; font-weight:700; font-size:18px; }
.corner-icon{
  position:absolute; z-index:3; top:0; right:0;
  background:#b00000; color:#fff; font-weight:700; font-size:20px;
  padding:10px 18px; border-radius:0 0 0 16px; line-height:1; text-decoration:none;
  display:inline-flex; align-items:center; justify-content:center;
}

/* Carrousel inside box 3 */
.box-content.box-content-info{ padding:0; width:100%; }
.master-carousel-wrapper{ height:100%; display:flex; flex-direction:column; }
.master-carousel-container{ flex:1 1 auto; height:100%; overflow:hidden; border-radius:16px; position:relative; }
.master-carousel{ display:flex; height:100%; transition: transform .6s ease; }
.master-card{ flex:0 0 100%; height:100%; display:flex; flex-direction:column; padding:32px 16px 16px; background:transparent; }
.carousel-dots{ display:none; }

/* Focus accessibilité */

</style>

<div class="top-boxes">
  <!-- Tuile 1 : Calendriers -->
  <div class="box">
    <div class="box-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/27) Icon-calendar.png" alt="" class="img-box">
    </div>
    <div class="box-content">
      <h4>Calendriers</h4>
      <ul class="list-box">
        <?php foreach ($data['calendriers'] as $item): ?>
          <li><?= esc_html($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Tuile 2 : Requêtes (cliquable) -->
  <div class="box js-nav" role="link" tabindex="0"
       data-href="<?php echo esc_url($gestion_requetes_url); ?>">
    <div class="box-icon">
      <img src="/wp-content/plugins/plateforme-master/images/pmo/27) Icon-paper-plane.png" alt="" class="img-box">
    </div>
    <div class="box-content">
      <h4>Requêtes</h4>
      <ul class="list-box">
        <?php foreach ($data['Requêtes'] as $item): ?>
          <li><?= esc_html($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Tuile 3 : Image + overlay + flèche -->
  <div class="boxINFO">
    <h4 class="boxINFO-title">Gestion Des Requêtes</h4>
    <a class="corner-icon" href="<?php echo esc_url($gestion_requetes_url); ?>" aria-label="Ouvrir la gestion des requêtes">↗</a>

    <div class="box-content box-content-info">
      <div class="master-carousel-wrapper">
        <div class="carousel-dots" id="carousel-dots"></div>
        <div class="master-carousel-container">
          <div class="master-carousel" id="carousel">
            <!-- Slides dynamiques ajoutés par JS -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Tuile Requêtes : clic + Enter/Espace
document.querySelectorAll('.js-nav').forEach(box => {
  const go = () => {
    const href = box.dataset.href;
    if (href) window.location.href = href;
  };
  box.addEventListener('click', go);
  box.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault(); go();
    }
  });
});
</script>
