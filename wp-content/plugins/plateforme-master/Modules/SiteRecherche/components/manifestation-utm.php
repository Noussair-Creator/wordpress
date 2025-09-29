<style>
/* Hero section styling */
.hero-bg {
    background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
    background-size: cover;
    background-position: center;
    padding: 10rem 0 12rem;
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


/* Search and Filter Section Styling */
.search-card {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
    margin-top: -110px;
    position: relative;
    z-index: 10;
}

.form-control,
.form-select {
    border-radius: 0.5rem;
    height: 50px;
    border: 1px solid #A6A485;
}

.btn-rechercher {
    background-color: #b60303;
    color: white;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    height: 50px;
}

.btn-rechercher:hover {
    background-color: #930202;
    color: white;
}

.btn-reinitialiser {
    background-color: #ffffff;
    color: #b60303;
    border: 1px solid #b60303;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    font-weight: 500;
    height: 50px;
}

.btn-reinitialiser:hover {
    background-color: #f8f9fa;
}

/* Publication Card Design */
.publication-card {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='250' height='250' viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23f9f9f9' stroke-width='1.5'%3E%3Cpath d='M 200 100 A 100 100 0 0 1 100 200'/%3E%3Cpath d='M 180 100 A 80 80 0 0 1 100 180'/%3E%3C/g%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: calc(100% + 40px) calc(100% + 40px);
}

.publication-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}

.publication-card h5 {
    color: #212529;
    font-weight: 700;
    font-size: 1.1rem;
}

.publication-card p {
    color: #555;
    font-size: 0.95rem;
    flex-grow: 1;
}

.publication-card-meta {
    font-size: 0.875rem;
    color: #444;
    border-top: none;
}

.publication-card-meta i {
    color: #b60303;
}

.publication-arrow {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 50px;
    height: 50px;
    background-color: #b60303;
    color: white;
    border-radius: 0px 16px;
    display: grid;
    place-items: center;
    text-decoration: none;
}

.publication-arrow:hover {
    background-color: #930202;
    color: white;
}

/* "Voir plus" Button */
.btn-voir-plus {
    border: 1px solid #b60303;
    color: #b60303;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    font-weight: 500;
}

.btn-voir-plus:hover {
    background-color: #b60303;
    color: white;
}



/* Font Utility Classes */
.fs-12 {
    font-size: 12px !important;
}

.fs-14 {
    font-size: 14px !important;
}

.fs-16 {
    font-size: 16px !important;
}

.fs-18 {
    font-size: 18px !important;
}

.fs-20 {
    font-size: 20px !important;
}

.fw-300 {
    font-weight: 300 !important;
}

.fw-400 {
    font-weight: 400 !important;
}

.fw-500 {
    font-weight: 500 !important;
}

.fw-600 {
    font-weight: 600 !important;
}

.fw-700 {
    font-weight: 700 !important;
}
</style>


<!-- Hero Section -->
<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span><a href="/structures-de-recherche-utm">Structures
                de
                recherche</a><span>›</span>Manifestation
        </div>
        <h1 class="text-start">Manifestation</h1>
    </div>
</section>

<main class="container">

    <!-- Search/Filter Section -->
    <section class="col-lg-12 mx-auto">
        <div class="search-card">
            <h2 class="h4 fw-bolder mb-4">Recherche</h2>
            <form id="searchForm">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-md-8">
                        <select id="categorySelect" class="form-select">
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <div class="d-flex gap-2 fw-bolder">
                            <button type="reset" class="btn btn-reinitialiser fw-bold">Réinitialiser</button>
                            <button type="submit" class="btn btn-rechercher fw-bold">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Publications Grid Section -->
    <section class="mt-5">
        <div id="publicationsGrid" class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Card 1 
            <div class="col" data-category="Conférence">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.
                    </p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Conférence
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            20/10/2025
                        </span>
                    </div>
                </div>
            </div>
           
            <div class="col" data-category="Atelier">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Atelier
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            05/11/2025
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col" data-category="Appels à projets">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Appels à projets
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            30/09/2025
                        </span>
                    </div>
                </div>
            </div>
          
            <div class="col" data-category="Séminaire">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Séminaire
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            15/01/2026
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col" data-category="Colloque">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Colloque
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            22/03/2026
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col" data-category="Appels à projets">
                <div class="publication-card position-relative">
                    <a href="/manifestation-details-utm" class="publication-arrow">
                        <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-diagonal-arrow-right-up.png">
                    </a>
                    <h5 class="fw-700">Deep Learning for Brain-Computer Interface Systems</h5>
                    <p class="my-3 fw-500">Cet article explore l’utilisation des réseaux de neurones convolutifs et des
                        modèles
                        Transformer pour améliorer la précision des systèmes d’interfaces cerveau-machine (BCI). Les
                        résultats obtenus sur des bases de données EEG montrent une amélioration de 12 % par rapport
                        aux
                        méthodes classiques de traitement du signal. Cette approche ouvre la voie à des applications
                        en
                        neuro-réhabilitation et contrôle de prothèses intelligentes.</p>
                    <div class="publication-card-meta mt-auto pt-3">
                        <span class="d-block mb-2">
                            <img class="me-2" width="15px"
                                src="/wp-content\plugins\plateforme-master\images\SiteRechercheImages\category-variety-random-shuffle-svgrepo-com.png"
                                alt="category-variety-random-shuffle-svgrepo-com.png"> Appels à projets
                        </span>
                        <span class="d-block">
                            <img class="me-2" width="15px"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                                alt="Icon-calendar.png">
                            01/12/2025
                        </span>
                    </div>
                </div>
            </div>-->

        </div>

        <!-- No results message -->
        <div id="noResultsMessage" class="text-center p-5" style="display: none;">
            <h4>Aucune manifestation ne correspond à vos critères de recherche.</h4>
        </div>

        <!-- Load More Button -->
        <div class="text-center m-5">
            <button id="loadMoreBtn" class="btn btn-voir-plus">Voir plus</button>
        </div>
    </section>
</main>




<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const categorySelect = document.getElementById('categorySelect');
    const publicationsGrid = document.getElementById('publicationsGrid');
    const cards = publicationsGrid.querySelectorAll('.col');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const loadMoreBtnContainer = document.getElementById('loadMoreBtn').parentElement;

    function handleFilter() {
        const selectedCategory = categorySelect.value;
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCategory = card.dataset.category;
            const isVisible = !selectedCategory || cardCategory === selectedCategory;

            card.style.display = isVisible ? 'block' : 'none';
            if (isVisible) {
                visibleCount++;
            }
        });

        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        loadMoreBtnContainer.style.display = visibleCount === 0 ? 'none' : 'block';
    }

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        handleFilter();
    });

    searchForm.addEventListener('reset', function() {
        setTimeout(() => {
            cards.forEach(card => {
                card.style.display = 'block';
            });
            noResultsMessage.style.display = 'none';
            loadMoreBtnContainer.style.display = 'block';
        }, 0);
    });
});
</script>

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

<!--
<script>
document.addEventListener('DOMContentLoaded', () => {
  const API_ROOT = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'/') + 'plateforme-recherche/v1';
  const grid     = document.getElementById('publicationsGrid');
  const noRes    = document.getElementById('noResultsMessage');
  const loadBtn  = document.getElementById('loadMoreBtn');
  const form     = document.getElementById('searchForm');
  const catSel   = document.getElementById('categorySelect');

  const CHUNK = 6;
  const LAB_ID = getLabId();
  let ALL = [];       // données cumulées pour le filtre local si besoin
  let LIST = [];      // liste courante (filtrée)
  let idx = 0;        // pointeur d’affichage
  const seen = new Set(); // anti-doublons par id

  if (!LAB_ID) {
    grid.innerHTML = `<div class="col-12 text-center text-danger">Paramètre <code>laboratoireid</code> manquant.</div>`;
    loadBtn.style.display = 'none';
    return;
  }

  // ===== API helpers =====
  function headers(){ const h={}; if (window.PMSettings?.nonce) h['X-WP-Nonce']=PMSettings.nonce; return h; }
  async function fetchJSON(url){
    const r = await fetch(url, { headers: headers(), credentials:'same-origin' });
    if (!r.ok) throw new Error('HTTP '+r.status);
    return r.json();
  }
  function url(path, q={}){
    const u = new URL(API_ROOT + path, location.origin);
    Object.entries(q).forEach(([k,v])=>{ if(v!==undefined && v!=='') u.searchParams.set(k,v); });
    return u.toString();
  }

  // ===== Load categories (par labo)
  async function loadCategories(){
    try{
      const cats = await fetchJSON(url(`/manifestation/categories/lab/${encodeURIComponent(LAB_ID)}`));
      catSel.innerHTML = `<option value="">Catégorie</option>` +
        (cats||[]).map(c => `<option value="${String(c.id)}">${escapeHTML(c.nom||('Catégorie '+c.id))}</option>`).join('');
    }catch(e){
      console.warn('Catégories indisponibles', e);
      catSel.innerHTML = `<option value="">Catégorie</option>`;
    }
  }

  // ===== Load manifestations (server-side par labo + catégorie optionnelle)
  async function loadManifestations({ page=1, per_page=CHUNK, categorie_id='' } = {}){
    const q = { page, per_page, laboratoire_id: LAB_ID };
    if (categorie_id) q.categorie_id = categorie_id;
    const data = await fetchJSON(url('/manifestation/by-lab', q));
    return Array.isArray(data) ? data : [];
  }

  // ===== Render
  function resetRender(list){
    grid.innerHTML = '';
    idx = 0; seen.clear();
    LIST = list || [];
    if (!LIST.length){ noRes.style.display='block'; loadBtn.style.display='none'; return; }
    noRes.style.display='none';
    renderNext(CHUNK);
  }
  function renderNext(n){
    let added = 0;
    while (idx < LIST.length && added < n) {
      const r = LIST[idx++];
      const id = String(r.id||'');
      if (!id || seen.has(id)) continue;
      grid.insertAdjacentHTML('beforeend', buildCard(r));
      seen.add(id);
      added++;
    }
    loadBtn.style.display = (idx >= LIST.length) ? 'none' : 'inline-block';
  }
  function buildCard(m){
    const cat = m.categorie || 'Sans catégorie';
    const date = m.date_debut ? fmtFR(m.date_debut) : (m.date ? fmtFR(m.date) : '');
    const texte = stripHTML(m.texte||'').slice(0,200) + (m.texte && m.texte.length>200?'…':'');
    const href = buildDetailsHref(m.id);
    return `
      <div class="col" data-category-id="${escapeAttr(String(m.categorie_id||''))}">
        <div class="publication-card position-relative">
          <a href="${escapeAttr(href)}" class="publication-arrow">
            <img width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png" alt="">
          </a>
          <h5 class="fw-700">${escapeHTML(m.intitule||'Manifestation')}</h5>
          <p class="my-3 fw-500">${escapeHTML(texte)}</p>
          <div class="publication-card-meta mt-auto pt-3">
            <span class="d-block mb-2">
              <img class="me-2" width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/category-variety-random-shuffle-svgrepo-com.png" alt="">
              ${escapeHTML(cat)}
            </span>
            <span class="d-block">
              <img class="me-2" width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png" alt="">
              ${escapeHTML(date)}
            </span>
          </div>
        </div>
      </div>`;
  }

  // ===== Form actions
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const categorie_id = catSel.value || '';
    try{
      // On demande au serveur directement (réduit le volume)
      const page1 = await loadManifestations({ page:1, per_page: 200, categorie_id });
      ALL = dedupe(page1);
      resetRender(ALL);
    }catch(err){
      console.error(err);
    }
  });
  form.addEventListener('reset', async () => {
    setTimeout(async () => {
      try{
        const page1 = await loadManifestations({ page:1, per_page: 200 });
        ALL = dedupe(page1);
        catSel.value = '';
        resetRender(ALL);
      }catch(err){
        console.error(err);
      }
    }, 0);
  });

  loadBtn.addEventListener('click', (e) => {
    e.preventDefault();
    renderNext(CHUNK);
  });

  // ===== Boot
  (async function boot(){
    grid.innerHTML = '<div class="col-12 text-center">Chargement…</div>';
    await loadCategories();
    const page1 = await loadManifestations({ page:1, per_page: 200 });
    ALL = dedupe(page1);
    resetRender(ALL);
  })().catch(err => {
    console.error(err);
    grid.innerHTML = '<div class="col-12 text-center text-danger">Erreur de chargement.</div>';
    loadBtn.style.display = 'none';
  });

  // ===== Utils
  function getLabId(){
    const u = new URL(location.href);
    const id = u.searchParams.get('laboratoireid') || u.searchParams.get('laboratoire_id') || localStorage.getItem('laboratoireid') || '';
    if (id) localStorage.setItem('laboratoireid', id);
    return id;
  }
  function fmtFR(iso){ const d=new Date(iso); return isNaN(d)? (iso||'') : d.toLocaleDateString('fr-FR'); }
  function stripHTML(html){ const t=document.createElement('div'); t.innerHTML=html||''; return (t.textContent||'').trim().replace(/\s+/g,' '); }
  function escapeHTML(s){ return (''+s).replace(/[&<>"]/g, m=>({'&':'&amp;','<':'&lt;','>':'&gt;'}[m])); }
  function escapeAttr(s){ return escapeHTML(s).replace(/"/g,'&quot;'); }
  function dedupe(arr){ const out=[]; const s=new Set(); (arr||[]).forEach(x=>{const id=String(x.id||''); if(id && !s.has(id)){s.add(id); out.push(x);} }); return out; }
  function buildDetailsHref(id){
    const u = new URL('/manifestation-details-utm', location.origin);
    u.searchParams.set('id', id);
    if (LAB_ID) u.searchParams.set('laboratoireid', LAB_ID);
    return u.pathname + u.search;
  }
});
</script>
-->

<script>
document.addEventListener('DOMContentLoaded', () => {
  // ====== CONFIG/API ======
  const API_ROOT = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'/') + 'plateforme-recherche/v1';
  const PER_PAGE = 6;

  // ====== UI HOOKS ======
  const grid      = document.getElementById('publicationsGrid');
  const noRes     = document.getElementById('noResultsMessage');
  const loadBtn   = document.getElementById('loadMoreBtn');
  const form      = document.getElementById('searchForm');
  const catSelect = document.getElementById('categorySelect');

  // ====== STATE ======
  const LAB_ID = getLabId();
  let currentPage = 1;
  let currentCat  = '';     // categorie_id
  const seenIds   = new Set(); // anti-doublon inter-pages

  if (!LAB_ID) {
    grid.innerHTML = `<div class="col-12 text-center text-danger">Paramètre <code>laboratoireid</code> manquant.</div>`;
    loadBtn.style.display = 'none';
    return;
  }

  // ====== HELPERS ======
  function headers(){ const h={}; if (window.PMSettings?.nonce) h['X-WP-Nonce']=PMSettings.nonce; return h; }
  async function fetchJSON(u){
    const r = await fetch(u, { headers: headers(), credentials:'same-origin' });
    if (!r.ok) throw new Error('HTTP '+r.status);
    return r.json();
  }
  function buildURL(path, q={}){
    const u = new URL(API_ROOT + path, location.origin);
    Object.entries(q).forEach(([k,v])=>{ if(v!==undefined && v!=='') u.searchParams.set(k,v); });
    return u.toString();
  }
  function stripHTML(html){ const d=document.createElement('div'); d.innerHTML = html||''; return (d.textContent||'').trim().replace(/\s+/g,' '); }
  function esc(s){ return (''+(s??'')).replace(/[&<>]/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;'}[m])); }
  function escAttr(s){ return esc(s).replace(/"/g,'&quot;'); }
  function fmtFR(iso){ const d=new Date(iso); return isNaN(d)? (iso||'') : d.toLocaleDateString('fr-FR'); }
  function getLabId(){
    const u = new URL(location.href);
    const id = u.searchParams.get('laboratoireid') || u.searchParams.get('laboratoire_id') || localStorage.getItem('laboratoireid') || '';
    if (id) localStorage.setItem('laboratoireid', id);
    return id;
  }
  function buildDetailsHref(id){
    const u = new URL('/manifestation-details-utm', location.origin);
    u.searchParams.set('id', id);
    if (LAB_ID) u.searchParams.set('laboratoireid', LAB_ID);
    return u.pathname + u.search;
  }

  // ====== RENDER ======
  function clearGrid(){
    grid.innerHTML = '';
    seenIds.clear();
  }
  function appendCards(rows){
    let appended = 0;
    rows.forEach(m => {
      const id = String(m.id || '');
      if (!id || seenIds.has(id)) return; // anti-doublon
      seenIds.add(id);

      const catName = m.categorie || 'Sans catégorie';
      const dateTxt = m.date_debut ? fmtFR(m.date_debut) : (m.date ? fmtFR(m.date) : '');
      const txt     = stripHTML(m.texte||'').slice(0,200) + ((m.texte||'').length>200 ? '…':'');
      const href    = buildDetailsHref(id);

      const card = `
        <div class="col" data-category-id="${escAttr(String(m.categorie_id||''))}">
          <div class="publication-card position-relative">
            <a href="${escAttr(href)}" class="publication-arrow">
              <img width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png" alt="Voir">
            </a>
            <h5 class="fw-700">${esc(m.intitule || 'Manifestation')}</h5>
            <p class="my-3 fw-500">${esc(txt)}</p>
            <div class="publication-card-meta mt-auto pt-3">
              <span class="d-block mb-2">
                <img class="me-2" width="15"
                     src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/category-variety-random-shuffle-svgrepo-com.png" alt="">
                ${esc(catName)}
              </span>
              <span class="d-block">
                <img class="me-2" width="15"
                     src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png" alt="">
                ${esc(dateTxt)}
              </span>
            </div>
          </div>
        </div>`;
      grid.insertAdjacentHTML('beforeend', card);
      appended++;
    });
    return appended;
  }
  function setEmptyState(isEmpty){
    noRes.style.display = isEmpty ? 'block' : 'none';
    loadBtn.style.display = isEmpty ? 'none' : 'inline-block';
  }

  // ====== LOADERS ======
  async function loadCategories(){
    try{
      const url = buildURL(`/manifestation/categories/lab/${encodeURIComponent(LAB_ID)}`);
      const cats = await fetchJSON(url);
      catSelect.innerHTML = `<option value="">Catégorie</option>` +
        (Array.isArray(cats) ? cats.map(c => `<option value="${escAttr(String(c.id))}">${esc(c.nom || ('Catégorie '+c.id))}</option>`).join('') : '');
    }catch(e){
      console.warn('Catégories indisponibles', e);
      catSelect.innerHTML = `<option value="">Catégorie</option>`;
    }
  }

  async function fetchPage(page, categorie_id){
    const q = { laboratoire_id: LAB_ID, page, per_page: PER_PAGE };
    if (categorie_id) q.categorie_id = categorie_id;
    const url = buildURL('/manifestation/by-lab', q);
    const rows = await fetchJSON(url);
    return Array.isArray(rows) ? rows : [];
  }

  async function initialLoad(){
    grid.innerHTML = '<div class="col-12 text-center">Chargement…</div>';
    await loadCategories();
    currentPage = 1;
    clearGrid();
    const rows = await fetchPage(currentPage, currentCat);
    grid.innerHTML = ''; // efface le "Chargement…"
    const added = appendCards(rows);
    setEmptyState(added === 0);
    // si moins que PER_PAGE, masquer "Voir plus"
    if (rows.length < PER_PAGE) loadBtn.style.display = 'none';
  }

  // ====== EVENTS ======
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    currentCat  = catSelect.value || '';
    currentPage = 1;
    clearGrid();
    const rows = await fetchPage(currentPage, currentCat);
    grid.innerHTML = '';
    const added = appendCards(rows);
    setEmptyState(added === 0);
    loadBtn.style.display = (rows.length < PER_PAGE || added === 0) ? 'none' : 'inline-block';
  });

  form.addEventListener('reset', async () => {
    setTimeout(async () => {
      currentCat  = '';
      await initialLoad();
    }, 0);
  });

  loadBtn.addEventListener('click', async () => {
    currentPage += 1;
    const rows = await fetchPage(currentPage, currentCat);
    const added = appendCards(rows);
    // cacher le bouton si on ne reçoit plus de résultats, ou si tout a été dédupliqué
    if (rows.length < PER_PAGE || added === 0) loadBtn.style.display = 'none';
  });

  // ====== GO ======
  initialLoad().catch(err => {
    console.error(err);
    grid.innerHTML = '<div class="col-12 text-center text-danger">Erreur de chargement.</div>';
    loadBtn.style.display = 'none';
  });
});
</script>

