


<style>
/* Styles spécifiques au bloc .top-boxes */
.top-boxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
        margin-bottom: 20px;
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
    padding-top: 20px;
}
.box-content h4 {
  margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--dark);
    padding-bottom: 10px;
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
    background-color: white;
    flex: 1 1 50%;
   /* display: flex
;*/
    align-items: center;
    gap: 15px;
    padding: 0px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s;
    cursor: pointer;
    padding: 20px;
   
   /* background-image: url("/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg");*/
    background-size: cover;
    background-repeat: no-repeat;
    padding-bottom: 0px;
    max-width: 449px
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

.doctorant-progress-box {
  background-color: #fff;
  border-radius: 12px;
    padding: 0px 0px 0px 20px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
  position: relative;
  max-width: 680px;
  width: 100%;
  font-family: 'Arial', sans-serif;
}

.doctorant-header {
  position: relative;
  margin-bottom: 20px;
  font-size: 16px;
  color: #2A2916;
}

.credit-box {
  position: absolute;
  top: 0;
  right: 0;
  background-color: #b00000;
  color: white;
  padding: 8px 20px;
  border-radius: 0 0 0 20px;
  font-size: 15px;
}
.credit-box .credit-value {
  font-size: 24px;
  font-weight: bold;
  margin-left: 8px;
}

.doctorant-legend {
    font-size: 13px;
    margin-top: 8px;
    display: grid;
    gap: 2px;
}
.doctorant-legend .dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 5px;
}
.dot-filled {
  background-color: #b00000;
}
.dot-empty {
  border: 2px solid #b00000;
  background-color: transparent;
}

.progression-doctorat {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
  position: relative;
}

.step {
  text-align: center;
  flex: 1;
  z-index: 2;
}
.step span {
  font-size: 13px;
  color: #5a564a;
      position: absolute;
}
.step .dot {
  border-radius: 50%;
  margin: 0 auto 6px;
}

.completed-dot {
  background-color: #b00000;
}
.upcoming-dot {
  border: 2px solid #b00000;
  background-color: #fff;
}

.line {
  flex-grow: 1;
  height: 4px;
  background-color: #e6e6e6;
  margin: 0 -5px;
  z-index: 1;
}
.line-active {
  background-color: #b00000 !important;
}
.doctorant-header h6 {
    font-size: 16px;
    top: 23px;
    margin-bottom: 39px;
    position: relative;
    font-weight: 600;
}
.progression-doctorat {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
  position: relative;
  gap: 0; /* Important pour que les cercles collent aux lignes */
  width: 90%;
    padding-left: 10px;
}


.step {
  text-align: center;
    z-index: 2;
    display: inline-grid;
    position: relative;
    flex: 0 0 0px;
}

.step .dot {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  margin: 0 auto;
}

.step span {
  font-size: 13px;
  color: #5a564a;
  display: block;
  margin-top: 30px;
}

.line {
  flex-grow: 1;
  height: 4px;
  background-color: #e6e6e6;
  margin: 0 -5px;
  z-index: 1;
  transition: background-color 0.3s ease;
}

.line-active {
  background-color: #b00000;
}

.completed-dot {
  background-color: #b00000;
}

.upcoming-dot {
  background-color: #fff;
  border: 2px solid #b00000;
}

.box-standard {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
display: flex;
  gap: 15px;
  flex: 1 1 23%;
  transition: 0.2s ease;
}
.box-standard:hover {
  transform: translateY(-4px);
}
.box-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
}
.box-list {
  list-style: none;
  padding-left: 15px;
}
.box-list li {
  margin-bottom: 6px;
  font-size: 14px;
}

.box-labo-info {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 20px;
  gap: 30px;
  flex: 1 1 50%;
    background-image: url(/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg);
    background-size: cover;
    background-repeat: no-repeat;
}
.labo-info-left {
  flex: 1;
}
.labo-info-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 12px;
}
.labo-info-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.labo-info-item {
  display: flex;
  justify-content: space-between;
  padding-bottom: 4px;
}
.labo-info-label {
  font-weight: 500;
  color: #555;
}
.labo-info-value {
  font-weight: 600;
  color: #000;
}
.labo-info-logo img {
  max-height: 100px;
  object-fit: contain;
}


  </style>


<div class="top-boxes">
  <?php
    $iconMap = [
      "presence"     => "person-done",
      "calendriers"  => "calendar",
      "fiche_labo"   => "info"
    ];

    $labelMap = [
      "presence"     => "Assiduité",
      "calendriers"  => "Calendriers",
      "fiche_labo"   => "Dénomination du laboratoire"
    ];

    foreach ($labelMap as $key => $label):
      if (empty($data[$key])) continue;

      // 🔷 Box spéciale fiche labo
      if ($key === 'fiche_labo'):
  ?>
    <div class="box-labo-info">
      <div class="labo-info-left">
        <h4 class="labo-info-title"><?= esc_html($label) ?></h4>
        <div class="labo-info-list">
          <?php foreach ($data[$key] as $infoLabel => $val): ?>
            <div class="labo-info-item">
              <span class="labo-info-label"><?= esc_html($infoLabel) ?> :</span>
              <span class="labo-info-value"><?= esc_html($val) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="labo-info-logo">
        <img src="<?= esc_url('/wp-content/plugins/plateforme-master/imagesED/logo-lsama.png') ?>"
             alt="Logo laboratoire">
      </div>
    </div>
  <?php
        continue;
      endif;

      // 🔷 Box standard
      $iconFile = "/wp-content/plugins/plateforme-master/imagesED/27) Icon-" . $iconMap[$key] . ".png";
  ?>
    <div class="box-standard">
      <div class="box-icon">
        <img src="<?= esc_url($iconFile) ?>" alt="<?= esc_attr($label) ?>" class="img-box">
      </div>
      <div class="box-content">
        <h4 class="box-title"><?= esc_html($label) ?></h4>
        <ul class="box-list">
          <?php foreach ($data[$key] as $sousLabel => $val): ?>
            <li>
              <?= is_string($sousLabel) ? "<strong>" . esc_html($sousLabel) . ":</strong> " : "" ?>
              <?= esc_html($val) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endforeach; ?>
</div>





  






