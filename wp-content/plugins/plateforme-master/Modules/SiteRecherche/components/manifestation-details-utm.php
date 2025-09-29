<style>
/* Hero section styling */
.hero-bg {
    background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
    background-size: cover;
    background-position: center;
    padding: 10rem 0 8rem;
    color: white;
}

.hero-bg h1 {
    font-size: 50px;
    width: 340px;
    font-weight: 700;
}

.breadcrumb-custom {
    background-color: rgb(83 81 81 / 40%);
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.breadcrumb-custom a {
    color: white;
    text-decoration: none;
}

.breadcrumb-custom a:hover {
    text-decoration: underline;
}

.breadcrumb-custom span {
    color: #e9ecef;
    margin: 0 0.5rem;
}

/* Main Content Card Styling */
.details-card {
    margin-bottom: 45px;
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.08);
}

/* Title Card */
.title-card {
    text-align: center;
    margin-top: -80px;
    position: relative;
    z-index: 10;
}

.title-card h2 {
    font-weight: 700;
    font-size: 1.75rem;
    color: #212529;
}

.title-card-meta {
    font-size: 0.95rem;
    color: #555;
}

.title-card-meta img {
    filter: invert(13%) sepia(63%) saturate(5436%) hue-rotate(348deg) brightness(73%) contrast(110%);
}

/* Description Card */
.description-card p {
    font-size: 1rem;
    line-height: 1.6;
    color: #333;
}

/* New helper class for font styling */
.custom-font-style {
    font-size: 50px;
    /* You can change this pixel value */
    font-weight: 700;
    /* You can change this value (e.g., 400 for normal, 700 for bold) */
}


/* Gallery Card */
.gallery-card h3 {
    font-weight: 700;
    color: #212529;
}

.gallery-carousel .carousel-inner img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 0.5rem;
}

.gallery-carousel .carousel-indicators [data-bs-target] {
    width: 15px;
    height: 5px;
    border-radius: 2px;
    background-color: #ccc;
    border: none;
    margin: 0 4px;
    opacity: 0.7;
}

.gallery-carousel .carousel-indicators .active {
    background-color: #b60303;
    width: 25px;
    opacity: 1;
}
</style>

<!-- Hero Section -->
<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span><a href="#">Structures de
                recherche</a><span>›</span><a href="#">Manifestation</a><span>›</span>Détails
        </div>
        <h1 class="text-start">Manifestation</h1>
    </div>
</section>

<main class="container">

    <!-- Title Section -->
    <section class="col-lg-12 mx-auto">
        <div class="details-card title-card">
            <div>
                <h2></h2>
                <div class="d-flex align-items-center gap-4 title-card-meta mt-3 justify-content-around">
                    <span>
                        <img class="me-2" width="15px"
                            src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                            alt="Category Icon">
                    </span>
                    <span>
                        <img class="me-2" width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                            alt="Calendar Icon">
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    <section class="col-lg-12 mx-auto mt-4">
        <div class="details-card description-card">
           
          
           
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="col-lg-12 mx-auto mt-4">
        <div class="details-card gallery-card">
            <h3>Galerie</h3>
            <div id="galleryCarousel" class="carousel slide gallery-carousel m-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <!--  <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 444.png"
                                    alt="Image de la galerie 1">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 445.png"
                                    alt="Image de la galerie 2">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 446.png"
                                    alt="Image de la galerie 3">

                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 447.png"
                                    alt="Image de la galerie 4">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 448.png"
                                    alt="Image de la galerie 5">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 444.png"
                                    alt="Image de la galerie 6">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 444.png"
                                    alt="Image de la galerie 7">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 445.png"
                                    alt="Image de la galerie 8">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 446.png"
                                    alt="Image de la galerie 9">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 447.png"
                                    alt="Image de la galerie 10">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 448.png"
                                    alt="Image de la galerie 11">
                            </div>
                            <div class="col-md-4">
                                <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe de masques 444.png"
                                    alt="Image de la galerie 12">

                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="carousel-indicators position-static mt-4">
                  <!--  <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>-->
                </div>
            </div>
        </div>
    </section>

</main>
<?php
    $current_user = wp_get_current_user();
    $roles = (array) $current_user->roles;
    $role  = $roles[0] ?? '';
    $user_id = get_current_user_id();

    ?>
    <script>
    window.PMSettings = {
        restUrl: "<?= esc_url( rest_url() ) ?>",
        nonce: "<?= wp_create_nonce('wp_rest') ?>",
        role: "<?= esc_js( $role ) ?>",
        userId: <?= (int) $user_id ?>
    };
    </script>

<script>
const REST_NS = `${PMSettings?.restUrl || '/wp-json/'}plateforme-recherche/v1`;

// Helper GET
async function apiGET(path) {
  const res = await fetch(`${REST_NS}${path}`, {
    headers: { 'X-WP-Nonce': PMSettings?.nonce || '' }
  });
  if (!res.ok) throw new Error(`API ${path} (${res.status})`);
  return res.json();
}

// Charger la manifestation (par ex. via ?id=12 dans l’URL)
async function loadManifestationDetail() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  if (!id) {
    console.error("Pas d’ID manifestation dans l’URL");
    return;
  }

  try {
    // Détails
    const m = await apiGET(`/manifestation/${id}`);

    // Titre
    document.querySelector('.title-card h2').textContent = m.intitule || 'Sans titre';

    // Métas (catégorie + date début)
    const metas = document.querySelector('.title-card-meta');
    metas.innerHTML = `
      <span>
        <img class="me-2" width="15px" 
             src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/category-variety-random-shuffle-svgrepo-com.png">
        ${m.categorie || 'Sans catégorie'}
      </span>
      <span>
        <img class="me-2" width="15px" 
             src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png">
        ${m.date_debut ? new Date(m.date_debut).toLocaleDateString('fr-FR') : ''}
      </span>
    `;

    // Texte (description)
    const desc = document.querySelector('.description-card');
    desc.innerHTML = m.texte || '<p>Aucune description disponible.</p>';

    // Images
    const images = await apiGET(`/manifestation/${id}/images`);
    const carouselInner = document.querySelector('#galleryCarousel .carousel-inner');
    const indicators = document.querySelector('.carousel-indicators');

    if (images && images.length) {
      let chunks = [];
      for (let i = 0; i < images.length; i += 6) {
        chunks.push(images.slice(i, i + 6));
      }

      carouselInner.innerHTML = chunks.map((group, idx) => `
        <div class="carousel-item ${idx === 0 ? 'active' : ''}">
          <div class="row g-3">
            ${group.map(img => `
              <div class="col-md-4">
                <img src="${img.image_url}" alt="${img.alt_text || ''}">
              </div>
            `).join('')}
          </div>
        </div>
      `).join('');

      indicators.innerHTML = chunks.map((_, idx) => `
        <button type="button" data-bs-target="#galleryCarousel" 
                data-bs-slide-to="${idx}" 
                class="${idx===0?'active':''}"
                aria-label="Slide ${idx+1}"></button>
      `).join('');
    }

  } catch (err) {
    console.error("Erreur chargement manifestation:", err);
  }
}

// Boot
document.addEventListener('DOMContentLoaded', loadManifestationDetail);
</script>
