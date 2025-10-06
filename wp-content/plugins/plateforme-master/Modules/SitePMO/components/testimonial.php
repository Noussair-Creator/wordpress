<section class="testimonial-section">
  <div class="titre-ligne-wrapper">
    <div class="ligne-gauche"></div>
    <div class="titre-ligne">Commentaires</div>
    <div class="ligne-droite"></div>
  </div>

  <div class="testimonial-carousel" id="testimonialCarousel">
    <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
    <!-- Duplicate as needed -->
    <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
    <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
     <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
    <!-- Duplicate as needed -->
    <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
     <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
    <!-- Duplicate as needed -->
    <div class="testimonial-card">
      <div class="stars">★★★★★</div>
      <p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page…</p>
      <div class="author">
        <img src="/wp-content/plugins/plateforme-master/images/uscr/Groupe de masques 372.png" alt="user">
        <div>
          <strong>Pr. Manel Slimen</strong><br>
          <span>Enseignant(e)</span>
        </div>
      </div>
    </div>
  </div>

  <div class="carousel-dots" id="carouselDots">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
</section>



<style>
  .testimonial-section {
  padding: 60px 40px;
  background: #fff;
  position: relative;
}

.titre-ligne-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 40px;
  gap: 10px;
  margin-left: 120px;
    margin-right: 120px;
}

.ligne-gauche, .ligne-droite {
  flex: 1;
  height: 2px;
  background-color: #b60303;
  position: relative;
}

.ligne-gauche::after,
.ligne-droite::before {
  content: "";
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 10px;
  height: 10px;
  background-color: #b60303;
  border-radius: 50%;
}

.ligne-gauche::after { right: 0; }
.ligne-droite::before { left: 0; }

.titre-ligne {
  padding: 10px 30px;
  border: 2px solid #b60303;
  border-radius: 999px;
  font-size: 16px;
  color: #b60303;
  font-weight: 500;
  background-color: white;
  white-space: nowrap;
}

/* Cards carousel */
.testimonial-carousel {
  display: flex;
  gap: 25px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  padding-bottom: 20px;
}

.testimonial-carousel::-webkit-scrollbar {
  display: none;
}

.testimonial-card {
  min-width: 320px;
  flex-shrink: 0;
  background: #fff;
  padding: 25px;
  scroll-snap-align: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
    width: 150px;
    box-shadow: 0px 0px 21px #00000029;
    border-radius: 10px;
}

.stars {
  color: #fbbc05;
  font-size: 33px;
  margin-bottom: 15px;
}

.testimonial-card p {
    font-size: 15px;
    margin-bottom: 20px;
    color: #2A2916;
    font-weight: 500;
}

.author {
  display: flex;
  align-items: center;
  gap: 12px;
}

.author img {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
}

.author strong {
  font-weight: 600;
  color: #2a2916;
  font-size: 15px;
}

.author span {
  font-size: 14px;
  color: #888;
}

/* Pagination dots */
.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 10px;
}

.carousel-dots .dot {
  width: 14px;
  height: 6px;
  border-radius: 5px;
  background: #ccc;
  transition: all 0.3s ease;
}

.carousel-dots .dot.active {
  background: #b60303;
  width: 24px;
}

</style>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("testimonialCarousel");
    const dots = document.querySelectorAll("#carouselDots .dot");
    const cards = carousel.children;
    let currentIndex = 0;
    const interval = 5000; // 5 secondes

    function updateCarousel(index) {
      const scrollTo = cards[index].offsetLeft;
      carousel.scrollTo({ left: scrollTo, behavior: 'smooth' });
      dots.forEach(dot => dot.classList.remove('active'));
      dots[index].classList.add('active');
    }

    function autoSlide() {
      currentIndex = (currentIndex + 1) % cards.length;
      updateCarousel(currentIndex);
    }

    // Auto slide
    let sliderInterval = setInterval(autoSlide, interval);

    // Dot click
    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        clearInterval(sliderInterval);
        updateCarousel(idx);
        currentIndex = idx;
        sliderInterval = setInterval(autoSlide, interval); // redémarre
      });
    });

    // Scroll update
    carousel.addEventListener("scroll", () => {
      const scrollLeft = carousel.scrollLeft;
      let closest = 0;
      let minDistance = Infinity;
      [...cards].forEach((card, i) => {
        const distance = Math.abs(card.offsetLeft - scrollLeft);
        if (distance < minDistance) {
          minDistance = distance;
          closest = i;
        }
      });
      dots.forEach(dot => dot.classList.remove("active"));
      dots[closest].classList.add("active");
      currentIndex = closest;
    });
  });
</script>
