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
    background-image: url("/imagesMaster/d8d647ad-4357-4924-b54b-94b4c604cfb2.jpg");
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
  </style>


  <div class="top-boxes">
    <!-- Bloc 1 : Disponibilités -->
    <div class="box">
      <div class="box-icon">
        <img src="/imagesMaster/27) Icon-person-done.png" alt="" class="img-box">
      </div>
      <div class="box-content">
        <h4>Assiduité</h4>
        <ul class="list-box">
          <?php foreach ($data['assiduite'] as $item): ?>
          <li><?= $item ?></li>
        <?php endforeach; ?>
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
        <?php foreach ($data['calendriers'] as $item): ?>
        <li><?= $item ?></li>
      <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <!-- Bloc 3 : Carrousel INFO -->
    <div class="boxINFO">
      <div class="box-content box-content-info">
        <div class="master-carousel-wrapper">
        <div class="carousel-dots" id="carousel-dots"></div>

          <div class="master-carousel-container">
            <div class="master-carousel" id="carousel">

            <!-- <?= $carouselSlides ?>-->

            <div class="master-carousel" id="carousel">
              <!-- SLIDES générés en JS -->
            </div>
                        
           
            </div> <!-- /.master-carousel -->
          </div>

        </div>
      </div>
    </div>
  </div>

<script>
  
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
      
            // const slide = document.createElement('div');
            // slide.className = 'master-card';
            // slide.innerHTML = `
            //   <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
            //   <div class="info-flex">
            //     <div class="info-line">
            //       <div class="label">Code Master :</div>
            //       <div class="label">Libellé du Master :</div>
            //       <div class="label">Spécialité :</div>
            //       <div class="label">Date d’habilitation :</div>
            //       <div class="label">Mention :</div>
            //     </div>
            //     <div class="info-value">
            //       <div class="value">${master.code_interne ?? '-'}</div>
            //       <div class="value">${master.intitule_master ?? '-'}</div>
            //       <div class="value">${master.specialite ?? '-'}</div>
            //       <div class="value">${master.debut_habilitation ?? '-'}</div>
            //       <div class="value">${master.mention ?? '-'}</div>
            //     </div>
            //   </div>
            // `;
            // carousel.appendChild(slide);
            // updateCarousel();
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


<script>
/*
fetch('/wp-json/plateforme-master/v1/masters-by-user', {
  credentials: 'include'
})
  .then(response => response.json())
  .then(data => {
    const carousel = document.getElementById("carousel");
    const dotsContainer = document.getElementById("carousel-dots");

    if (!Array.isArray(data) || data.length === 0) return;

    // Créer les slides dynamiquement
    data.forEach((master, i) => {

      console.log("test ");

      const slide = document.createElement('div');
      slide.className = 'master-card';
      slide.innerHTML = `
        <h4><a href="/MASTER/FicheMaster.php?id=${master.id}">${master.intitule_master}</a></h4>
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
        index = i;
        updateCarousel();
      });
      dotsContainer.appendChild(dot);
    });

    // Initialisation du carrousel une fois les données chargées
    updateCarousel();

    if (carousel.children.length > 1) {
      setInterval(() => {
        index = (index + 1) % carousel.children.length;
        updateCarousel();
      }, 5000);
    }
  });
  */
</script>


