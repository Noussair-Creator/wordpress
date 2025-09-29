<div class="media-section">
    <!-- Bloc Actualités -->
    <div class="card-actus"> <a href="/actualites-de-l-utm">
            <div class="title">Actualités de l’UTM</div>
            <div class="carousel-utm" id="utm-carousel">
                <div class="slide active">
                    <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe 1932.png" alt="Actualité 1">
                    <div class="video-play">▶</div>
                    <div class="caption">L'IA au service des enseignants</div>
                </div>
                <div class="slide">
                    <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe 1932.png" alt="Actualité 2">
                    <div class="video-play">▶</div>
                    <div class="caption">Inauguration du centre technologique</div>
                </div>
                <div class="slide">
                    <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe 1932.png" alt="Actualité 3">
                    <div class="video-play">▶</div>
                    <div class="caption">Rencontre scientifique inter-UTM</div>
                </div>
            </div>
            <div class="dots" id="utm-dots"></div>
        </a>
    </div>

    <!-- Bloc Manifestations -->
    <div class="card-manif">
        <div class="corner-icon"><a href="/manifestations-scientifiques">↗</a></div>
        <div class="title">Manifestations scientifiques</div>

        <div class="photo-grid">
            <!--<div class="grid-full">
                <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 417.png" alt="manif 1">
            </div>
            <div class="grid-half">
                <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 419.png" alt="manif 2">
            </div>
            <div class="grid-half">
                <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 461.png" alt="manif 3">
            </div>-->
        </div>



    </div>
</div>


<style>
.media-section {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    /* margin-top: 30px; */
}

.card-actus,
.card-manif {
    background: #fff;
    border-radius: 12px;
    padding: 20px 20px 0 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    position: relative;
}

.card-actus .title,
.card-manif .title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 12px;
    color: #2A2916;
}

/* Carrousel */
.carousel-utm {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    height: 79%;
    max-height: 100%;
    min-height: 293px;
}


.slide {
    display: none;
    position: relative;
}

.slide.active {
    display: block;
    height: 90%;
    max-height: 100%;
    min-height: 293px;
}

.slide img {
    width: 100%;
    border-radius: 12px;
    display: block;
    height: 100%;
}

.video-play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    color: red;
    border: 3px solid #fff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    line-height: 44px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.caption {
    background: #B00000;
    color: #fff;
    padding: 10px;
    font-size: 16px;
    text-align: center;
    font-weight: 500;
    border-radius: 0 8px 0px 0px;
    position: relative;
    top: -44px;
    width: 68%;
    overflow: hidden
}

/* Dots */
.dots {
    display: flex;
    justify-content: center;
    gap: 5px;
    margin-top: 10px;
}

.dots span {
    width: 10px;
    height: 10px;
    background: #ccc;
    border-radius: 50%;
    cursor: pointer;
}

.dots .active {
    background: #b00000;
}

/* Bloc Manifestations */
.card-manif .corner-icon {
    position: absolute;
    top: 0;
    right: 0;
    background: #b00000;
    color: #fff;
    font-size: 20px;
    padding: 8px 18px;
    border-radius: 0 0 0 20px;
    font-weight: bold;
    z-index: 9;
}




/* 🔴 Étendre la première image sur deux colonnes */
.photo-grid .wide-img {
    grid-column: span 2;
    aspect-ratio: 16/7;
    /* facultatif pour l’effet bandeau */
}

.photo-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-top: 10px;
}

/* L’image pleine largeur */
.grid-full {
    grid-column: span 2;
}

.photo-grid img {
    width: 100%;
    border-radius: 8px;
    object-fit: cover;
    aspect-ratio: 16/9;
}
</style>
<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? '';
$user_id = get_current_user_id();

?>
<script>
window.PMSettings = {
    restUrl: "<?= esc_url(rest_url()) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    userId: <?= (int) $user_id ?>
};
</script>



<script>
const REST_NS = `${PMSettings?.restUrl || '/wp-json/'}plateforme-recherche/v1`;

async function apiGET(path) {
    const res = await fetch(`${REST_NS}${path}`, {
        headers: {
            'X-WP-Nonce': PMSettings?.nonce || ''
        }
    });
    if (!res.ok) throw new Error(`API ${path} (${res.status})`);
    return res.json();
}

document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('#utm-carousel .slide');
    const dotsContainer = document.getElementById('utm-dots');
    let currentIndex = 0;

    slides.forEach((_, i) => {
        const dot = document.createElement('span');
        dot.addEventListener('click', () => {
            showSlide(i);
        });
        dotsContainer.appendChild(dot);
    });

    function showSlide(index) {
        slides.forEach(s => s.classList.remove('active'));
        dotsContainer.querySelectorAll('span').forEach(d => d.classList.remove('active'));

        slides[index].classList.add('active');
        dotsContainer.children[index].classList.add('active');
        currentIndex = index;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    showSlide(0);
    setInterval(nextSlide, 5000); // Change toutes les 5 sec
});


async function loadManifestationMedia() {
    const data = await apiGET('/manifestation/media');

    // 👉 On ne touche pas au carrousel (card-actus)
    // Seule la partie "Manifestations" est mise à jour

    // Grille photos
    const grid = document.querySelector('.card-manif .photo-grid');
    if (grid && data.photos && data.photos.length) {
        // On prend max 3 dernières photos
        const photos = data.photos.slice(0, 3);

        grid.innerHTML = `
      <div class="grid-full">
        <img src="${photos[1]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 417.png'}" alt="manif 1">
      </div>
      <div class="grid-half">
        <img src="${photos[1]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 419.png'}" alt="manif 2">
      </div>
      <div class="grid-half">
        <img src="${photos[2]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 461.png'}" alt="manif 3">
      </div>
    `;
    }
}
document.addEventListener('DOMContentLoaded', () => {
    loadManifestationMedia();
});
</script>