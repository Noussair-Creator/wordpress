

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
  width:92%
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



  </style>

 <div class="top-boxes">
<?php
  // Icônes correspondantes
  $iconMap = [
    "calendriers"     => "calendar",
    "inscriptions"    => "paper-plane",
    "demandes"        => "paper-plane",
    "disponibilites"  => "people",
    "soutenances"     => "file-text2",
    "membres_ed"      => "people",
    "theses_habilitations" => "file-text2",
    "progression"     => "progression",
    "etat_theses"     => "etat_theses"
  ];

  $labelMap = [
    "calendriers"     => "Calendrier",
    "inscriptions"    => "Inscription et réinscription",
    "demandes"        => "Demandes",
    "disponibilites"  => "Disponibilités",
    "soutenances"     => "Soutenances",
    "membres_ed"      => "Membres ED",
    "theses_habilitations" => "Thèses et Habilitations",
    "progression"     => "Progression",
    "etat_theses"     => "État des thèses"
  ];

  foreach ($labelMap as $key => $label):
    if (!empty($data[$key])):
      $iconFile = "/wp-content/plugins/plateforme-master/imagesED/27) Icon-" . $iconMap[$key] . ".png";
?>
    <div class="box">
      <div class="box-icon">
        <img src="<?= esc_url($iconFile) ?>" alt="<?= esc_attr($label) ?>" class="img-box">
      </div>
      <div class="box-content">
        <h4><?= esc_html($label) ?></h4>
        <ul class="list-box">
          <?php foreach ($data[$key] as $item): ?>
            <li><?= esc_html($item) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
<?php
    endif;
  endforeach;
?>
<?php if ($role === 'um_doctorant'): ?>
<div class="boxINFO doctorant-progress-box">
  <div class="doctorant-header">
    <h6>Avancement du doctorat:</h6>
    <div class="credit-box">
      <strong>Crédits :</strong>
      <span class="credit-value" id="credit-value">17/30</span>
    </div>
    <div class="doctorant-legend">
      <span><span class="dot dot-filled"></span> = étape complétée</span>
      <span><span class="dot dot-empty"></span> = étape à venir</span>
    </div>
  </div>

  <div class="progression-doctorat" id="progression-doctorat">
    <div class="step"><div class="dot"></div><span>Inscription</span></div>
    <div class="line"></div>
    <div class="step"><div class="dot"></div><span>Pré-soutenance</span></div>
    <div class="line"></div>
    <div class="step"><div class="dot"></div><span>Dépôt</span></div>
    <div class="line"></div>
    <div class="step"><div class="dot"></div><span>Soutenance</span></div>
  </div>

</div>
<?php endif; ?>


</div>


<script>
  
  document.addEventListener('DOMContentLoaded', () => {
    const progressIndex = 2; // 0: Inscription, 1: Pré-soutenance, etc.

    const steps = document.querySelectorAll('#progression-doctorat .step');
    const lines = document.querySelectorAll('#progression-doctorat .line');

    steps.forEach((step, index) => {
      const dot = step.querySelector('.dot');
      if (index <= progressIndex) {
        dot.classList.add('completed-dot');
      } else {
        dot.classList.add('upcoming-dot');
      }
    });

    lines.forEach((line, index) => {
      if (index < progressIndex) {
        line.classList.add('line-active');
      }
    });
  });


  const carousel = document.getElementById("carousel");
  const dotsContainer = document.getElementById("carousel-dots");
  const totalSlides = carousel.children.length;
  let index = 0;

  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement("span");
    dot.addEventListener("click", () => {
      index = i;
      updateCarousel();
    });
    dotsContainer.appendChild(dot);
  }

  function updateCarousel() {
    carousel.style.transform = `translateX(-${index * 100}%)`;
    [...dotsContainer.children].forEach((dot, i) => {
      dot.classList.toggle("active", i === index);
    });
  }

  setInterval(() => {
    index = (index + 1) % totalSlides;
    updateCarousel();
  }, 5000);

  updateCarousel();
  if (document.querySelectorAll('.master-card').length > 1) {
  initCarousel(); // Ta fonction d’init JS
}


fetch(PMSettings.apiUrl, {
  method: 'GET',
  headers: { 'X-WP-Nonce': PMSettings.nonce }
})
  .then(async res => {
    const contentType = res.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      const text = await res.text();
      console.error('Réponse non JSON :', text);
      return;
    }

          let data = await res.json();
          console.log('Masters:', data);
          const carousel = document.getElementById("carousel");
          const dotsContainer = document.getElementById("carousel-dots");
          if (!carousel || !dotsContainer) return;
      
          let index = 0;
      
          function updateCarousel() {
            carousel.style.transform = `translateX(-${index * 100}%)`;
            [...dotsContainer.children].forEach((dot, i) => {
              dot.classList.toggle("active", i === index);
            });
          }
      
          function renderNatureStats(masters) {
            const natureCounts = {};
            masters.forEach(master => {
              const nature = master.nature ?? 'Non spécifiée';
              natureCounts[nature] = (natureCounts[nature] || 0) + 1;
            });
      
            const infoFlex = document.createElement('div');
            infoFlex.className = 'info-flex';
      
            const infoLine = document.createElement('div');
            infoLine.className = 'info-line';
      
            const infoValue = document.createElement('div');
            infoValue.className = 'info-value';
      
            Object.entries(natureCounts).forEach(([nature, count]) => {
              const label = document.createElement('div');
              label.className = 'label';
              label.textContent = `${nature} :`;
              infoLine.appendChild(label);
      
              const value = document.createElement('div');
              value.className = 'value';
              value.textContent = count;
              infoValue.appendChild(value);
            });
      
            infoFlex.appendChild(infoLine);
            infoFlex.appendChild(infoValue);
            return infoFlex;
          }
      
          // ✅ Si le rôle est coordinateur, ne montrer que SON master
          if (PMSettings.role === 'um_coordonnateur-master') {
            const coordId = PMSettings.userId;
            const master = data.filter(m => m.coordinateur?.id === coordId);
            console.log("master" , master);
            
            if (!master) return;
      
           
                  const staticSlide = document.createElement('div');
          staticSlide.className = 'master-card';
          staticSlide.innerHTML = `<h4><a href="/list-master-coordinateur">Liste des masters</a></h4>`;
          staticSlide.appendChild(renderNatureStats(data));
          carousel.appendChild(staticSlide);
      
          const staticDot = document.createElement("span");
          staticDot.addEventListener("click", () => {
            index = 0;
            updateCarousel();
          });
          dotsContainer.appendChild(staticDot);
      
          master.forEach((master, i) => {
            const slide = document.createElement('div');
            slide.className = 'master-card';
            slide.innerHTML = `
              <h4><a href="/list-master-coordinateur">${master.intitule_master}</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Code Master :</div>
                  <div class="label">Libellé du Master :</div>
                  <div class="label">Spécialité :</div>
                  <div class="label">Date d’habilitation :</div>
                  <div class="label">Mention :</div>
                </div>
                <div class="info-value">
                  <div class="value">${master.code_interne ?? '-'}</div>
                  <div class="value">${master.intitule_master ?? '-'}</div>
                  <div class="value">${master.specialite ?? '-'}</div>
                  <div class="value">${master.debut_habilitation ?? '-'}</div>
                  <div class="value">${master.mention ?? '-'}</div>
                </div>
              </div>
            `;
            carousel.appendChild(slide);
      
            const dot = document.createElement("span");
            dot.addEventListener("click", () => {
              index = i + 1;
              updateCarousel();
            });
            dotsContainer.appendChild(dot);
          });
      
          updateCarousel();
      
          if (carousel.children.length > 1) {
            setInterval(() => {
              index = (index + 1) % carousel.children.length;
              updateCarousel();
            }, 500000);
          }
            return;
          }
      
          // ✅ Sinon : afficher la liste complète avec bloc statique
          const staticSlide = document.createElement('div');
          staticSlide.className = 'master-card';
          staticSlide.innerHTML = `<h4><a href="/gestion-des-master/">Liste des masters</a></h4>`;
          staticSlide.appendChild(renderNatureStats(data));
          carousel.appendChild(staticSlide);
      
          const staticDot = document.createElement("span");
          staticDot.addEventListener("click", () => {
            index = 0;
            updateCarousel();
          });
          dotsContainer.appendChild(staticDot);
      
          data.forEach((master, i) => {
            const slide = document.createElement('div');
            slide.className = 'master-card';
            slide.innerHTML = `
              <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Code Master :</div>
                  <div class="label">Libellé du Master :</div>
                  <div class="label">Spécialité :</div>
                  <div class="label">Date d’habilitation :</div>
                  <div class="label">Mention :</div>
                </div>
                <div class="info-value">
                  <div class="value">${master.code_interne ?? '-'}</div>
                  <div class="value">${master.intitule_master ?? '-'}</div>
                  <div class="value">${master.specialite ?? '-'}</div>
                  <div class="value">${master.debut_habilitation ?? '-'}</div>
                  <div class="value">${master.mention ?? '-'}</div>
                </div>
              </div>
            `;
            carousel.appendChild(slide);
      
            const dot = document.createElement("span");
            dot.addEventListener("click", () => {
              index = i + 1;
              updateCarousel();
            });
            dotsContainer.appendChild(dot);
          });
      
          updateCarousel();
      
          if (carousel.children.length > 1) {
            setInterval(() => {
              index = (index + 1) % carousel.children.length;
              updateCarousel();
            }, 500000);
          }

        })
        .catch(err => console.error("Erreur API:", err));






</script>






