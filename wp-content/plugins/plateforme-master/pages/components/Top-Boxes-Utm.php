<?php
            // Slides HTML
            $slide1 = '
            <div class="master-card">
              <h4><a href="/MASTER/GESTIONMASTER.php">Liste des master</a></h4>
              <div class="info-flex">
              <div class="info-line">
                <div class="label">Master Professionnel :</div>
                <div class="value">12</div>
              </div>
               <div class="info-line">
                  <div class="label">Master de recherche</div>
                  <div class="value">14</div>
              </div>
                <div class="info-line">
                  <div class="label">Master à distance:</div>
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
    max-width: 449px;
     height: 265px;
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
  flex-direction:column;
  gap: 20px;
}
.info-line {
  width: 100%;
  display: flex;
  
}
.info-value {
  width: 60%;
  display: flex;
 
}
.label, .value {
    font-size: 16px !important;
    margin-bottom: 4px;
    color: #000 !important;
    font-weight: 500 !important;
}
.carousel-dots {
    float: right;
    position: relative;
    top: 28px;
    z-index: 9999;
    display: none;
    flex-wrap: wrap;
    gap: 8px;
}
.carousel-dots-update {
    float: right;
    position: relative;
    top: 28px;
    z-index: 9999;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
/* .carousel-dots span {
  height: 10px;
  width: 10px;
  margin: 0 4px;
  background-color: #bbb;
  display: inline-block;
  cursor: pointer;
  transition: background-color 0.3s ease;
} */
 .carousel-dots span {
    height: 7px;
    width: 25px;
    margin: 0 4px;
    border-radius: 10px;
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

/* Updated carousel navigation styles */
.master-carousel-wrapper {
  position: relative; /* Needed for absolute positioning of nav */
}

.carousel-navigation {
  position: absolute;
  top: 10px;
  right: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  z-index: 10;
}

.carousel-arrow {
    cursor: pointer;
    font-size: 32px;
    color: #333;
    background: rgb(181 3 3);
    border-radius: 0px 10px 0 10px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    position: absolute;
    right: -39px;
    top: 5px;
    color: #fbfbfb;
    /* transform: rotate(45deg); */
}

.carousel-arrow:hover {
  background: rgb(181 3 3);
  transform: scale(1.1);
}

/* .carousel-dots {
  display: flex;
  gap: 6px;
  background: rgba(255,255,255,0.7);
  padding: 4px 8px;
  border-radius: 20px;
} */

.carousel-dots span {
  height: 8px;
  width: 8px;
  border-radius: 50%;
  background-color: #bbb;
  cursor: pointer;
  transition: all 0.3s ease;
}

.carousel-dots .active {
  background-color: #333;
  width: 16px;
  border-radius: 4px;
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
        <div class="carousel-dots-update" id="carousel-dots"></div>

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


fetch(PMSettings.apiUrlAllMasters, {
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
            infoLine.className = 'info-line-inline';
      
            Object.entries(natureCounts).forEach(([nature, count]) => {
              const label = document.createElement('div');
            //    label.textContent =`${nature} :`
            //   infoValue.appendChild(label);
              
              const value = document.createElement('div');
              value.className = 'value';
              value.textContent =`${nature} :` + count;
              infoValue.appendChild(value);
              infoLine.appendChild(infoValue);
              infoFlex.appendChild(infoLine);
            });
            
            // infoFlex.appendChild(infoValue);
            return infoFlex;
          }
      
          // ✅ Si le rôle est coordinateur, ne montrer que SON master
        //   if (PMSettings.role === 'um_coordonnateur-master') {
        //     const coordId = PMSettings.userId;
        //     const master = data.find(m => m.coordinateur?.id === coordId);
        //     if (!master) return;
      
        //     const slide = document.createElement('div');
        //     slide.className = 'master-card';
        //     slide.innerHTML = `
        //       <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
        //       <div class="info-flex">
        //         <div class="info-line">
        //           <div class="label">Code Master :</div>
        //           <div class="label">Libellé du Master :</div>
        //           <div class="label">Spécialité :</div>
        //           <div class="label">Date d’habilitation :</div>
        //           <div class="label">Mention :</div>
        //         </div>
        //         <div class="info-value">
        //           <div class="value">${master.code_interne ?? '-'}</div>
        //           <div class="value">${master.intitule_master ?? '-'}</div>
        //           <div class="value">${master.specialite ?? '-'}</div>
        //           <div class="value">${master.debut_habilitation ?? '-'}</div>
        //           <div class="value">${master.mention ?? '-'}</div>
        //         </div>
        //       </div>
        //     `;
        //     carousel.appendChild(slide);
        //     updateCarousel();
        //     return;
        //   }
      
          // ✅ Sinon : afficher la liste complète avec bloc statique
          const staticSlide = document.createElement('div');
          staticSlide.className = 'master-card';
          staticSlide.innerHTML = `<h4><a href="/gestion-master-utm">Liste des masters</a></h4>`;
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
                <div class="value">${master.code_interne ?? '-'}</div>
              </div>
            <div class="info-line">
                  <div class="label">Spécialité :</div>
                  <div class="value">${master.specialite ?? '-'}</div>
              </div>
              <div class="info-line">
                  <div class="label">Libellé du Master :</div>
                  <div class="value">${master.intitule_master ?? '-'}</div>
              </div>
               <div class="info-line">
                  <div class="label">Date d’habilitation :</div>
                  <div class="value">${master.debut_habilitation ?? '-'}</div>
              </div>
               <div class="info-line">
                  <div class="label">Mention :</div>
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
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.getElementById("carousel");
  if (!carousel) return;
  
  const totalSlides = carousel.children.length;
  let currentIndex = 0;
  const maxVisibleDots = 3;

  // Create navigation container
  const navContainer = document.createElement('div');
  navContainer.className = 'carousel-navigation';
  
  // Create left arrow
//   const leftArrow = document.createElement('div');
//   leftArrow.className = 'carousel-arrow prev';
//   leftArrow.innerHTML = '←';
//   leftArrow.addEventListener('click', () => navigate(-1));
  
  // Create dots container
  const dotsContainer = document.createElement('div');
  dotsContainer.className = 'carousel-dots';
  
  // Create right arrow
  const rightArrow = document.createElement('div');
  rightArrow.className = 'carousel-arrow next';
  rightArrow.innerHTML = '<div> <a href="/gestion-master-utm">→</a> </div>';
//   rightArrow.addEventListener('click', () => navigate(1));
  
  // Assemble navigation
//   navContainer.appendChild(leftArrow);
  navContainer.appendChild(dotsContainer);
  navContainer.appendChild(rightArrow);
  
  // Insert navigation inside wrapper at the top
  const wrapper = document.querySelector('.master-carousel-wrapper');
  if (wrapper) {
    wrapper.insertBefore(navContainer, wrapper.firstChild);
  }
  
  // Create dots (always show 3 dots)
  for (let i = 0; i < maxVisibleDots; i++) {
    const dot = document.createElement('span');
    dot.addEventListener('click', () => {
      // Calculate which slide to go to based on dot position
      const targetIndex = Math.floor(currentIndex / maxVisibleDots) * maxVisibleDots + i;
      goToSlide(targetIndex);
    });
    dotsContainer.appendChild(dot);
  }
  
  function navigate(direction) {
    goToSlide(currentIndex + direction);
  }
  
  function goToSlide(newIndex) {
    // Handle wrapping around
    if (newIndex < 0) {
      newIndex = totalSlides - 1;
    } else if (newIndex >= totalSlides) {
      newIndex = 0;
    }
    
    currentIndex = newIndex;
    updateCarousel();
  }
  
  function updateCarousel() {
    // Move carousel
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    
    // Update dots
    const dots = dotsContainer.children;
    const activeDotPosition = currentIndex % maxVisibleDots;
    
    for (let i = 0; i < dots.length; i++) {
      if (i === activeDotPosition) {
        dots[i].classList.add('active');
      } else {
        dots[i].classList.remove('active');
      }
    }
  }
  
  // Auto-advance
//   let carouselInterval = setInterval(() => {
//     goToSlide(currentIndex + 1);
//   }, 5000);
  
  // Pause on hover
//   carousel.parentNode.addEventListener('mouseenter', () => {
//     clearInterval(carouselInterval);
//   });
  
//   carousel.parentNode.addEventListener('mouseleave', () => {
//     carouselInterval = setInterval(() => {
//       goToSlide(currentIndex + 1);
//     }, 5000);
//   });
  
  // Initialize
  updateCarousel();
});
</script>