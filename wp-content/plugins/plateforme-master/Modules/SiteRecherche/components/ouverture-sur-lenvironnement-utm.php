<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* General body styling */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa;
    }

    /* Custom Red Color */
    .text-custom-red {
        color: #b60303;
    }

    .bg-custom-red {
        background-color: #b60303;
    }


    /* Hero section styling */
    .hero-bg {
        background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
        background-size: cover;
        background-position: center;
        padding: 7rem 0;
        color: white;
    }

    .hero-bg h1 {
        font-size: 50px;
        width: 340px;
        font-weight: 500;
        /* text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); */
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

    .search-box {
        background-color: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        /* border: 1px solid #dee2e6; */
    }

    .search-box .form-select {
        height: 50px;
        border-radius: 0.5rem;
        border: 1px solid #A6A485;
    }

    .search-box .btn {
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        height: 50px;
        width: 50px;
        border-radius: 0.5rem;
        /* border: 1px solid #ced4da; */
        background-color: #fff;
        color: #b60303;
        font-size: 1.2rem;
    }

    .search-box .btn:hover {
        background-color: #f8f9fa;
    }

    /* Main Content Styling */
    .publication-card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
        height: 100%;
        position: relative;
        overflow: hidden;
        border: none;
    }

    .publication-card::after {
        content: "";
        position: absolute;
        top: -50px;
        right: -120px;
        width: 250px;
        height: 250px;
        background-image: repeating-linear-gradient(135deg,
                transparent,
                transparent 4px,
                #fdfdfd 4px,
                #fdfdfd 5px);
        transform: rotate(15deg);
        z-index: 0;
    }

    .publication-card>* {
        position: relative;
        z-index: 1;
    }


    .publication-card .date-tag {
        display: inline-block;
        background-color: #b60303;
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .publication-card .date-tag i {
        margin-right: 5px;
    }

    .publication-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .publication-card h3 a {
        text-decoration: none;
        color: #212529;
    }

    .publication-card h3 a:hover {
        color: #b60303;
    }

    .publication-card p {
        font-size: 0.95rem;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
    }

    .publication-card p strong {
        color: #6c757d;
        font-weight: 500;
        margin-right: 30px;
        width: 90px !important;
    }

    .btn-view-more {
        border: 1px solid #ced4da;
        color: #b60303;
        font-weight: 600;
        padding: 0.75rem 4.5rem;
        border-radius: 10px;
        text-decoration: none;
        background-color: #fff;
    }

    .btn-view-more:hover {
        background-color: #b60303;
        color: white;
        border-color: #b60303;
    }
</style>
<!-- Hero Section -->
<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                Structures de recherche </a> <span>›</span>Ouverture sur l’environnement
        </div>
        <h1 class="text-start">Ouverture sur l’environnement</h1>
    </div>
</section>

<!-- Search Section -->
<div class="container" style="margin-top: -50px; position: relative; z-index: 10;">
    <div class="col-lg-12 mx-auto">
        <div class="search-box">
            <div class="row g-3 align-items-center">
                <div class="col-lg-5">
                    <select id="domainSelect" class="form-select" aria-label="Type De Collaboration">
                        <option value="" selected>Type De Collaboration</option>
                      
                    </select>
                </div>
                <div class="col-lg-5">
                    <select id="keywordsSelect" class="form-select" aria-label="Pays">
                        <option value="" selected>Pays</option>
                        
                    </select>
                </div>
                <div class="col-lg-2 d-flex justify-content-end">
                    <button id="applyBtn" class="btn me-2">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-checkmark.png"
                            alt="Icon-checkmark">
                    </button>
                    <button id="resetBtn" class="btn">
                        <img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-refresh.png"
                            alt="Icon-refresh">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Main Content -->
<main class="container" style="margin-top: 4rem;">
    <div id="publicationsContainer" class="row g-5">
        <!-- Publication Card 1 
        <div class="col-lg-6 publication-item" data-domain="Sciences Physiques,Énergies Renouvelables"
            data-keywords="Innovation,Projets">
            <div class="publication-card">
                <div class="date-tag">
                    <img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">
                    12 mars 2024
                </div>
                <h3><a href="#">Partenariat avec l'INSAT – Innovation en Énergie Durable</a></h3>
                <p><strong>Domaines:</strong> Sciences Physiques, Énergies Renouvelables</p>
                <p><strong>Objectif:</strong> Développement de projets communs et séminaires</p>
            </div>
        </div>
        <div class="col-lg-6 publication-item" data-domain="Biologie" data-keywords="Recherche">
            <div class="publication-card">
                <div class="date-tag"><img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">28 Février 2024</div>
                <h3><a href="#">Avancées en Biologie Moléculaire</a></h3>
                <p><strong>Domaines:</strong> Biologie</p>
                <p><strong>Objectif:</strong> Publication des résultats de recherche annuels</p>
            </div>
        </div>
        <div class="col-lg-6 publication-item" data-domain="Sciences Physiques" data-keywords="Recherche">
            <div class="publication-card">
                <div class="date-tag"><img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">15 Février 2024</div>
                <h3><a href="#">Nouvelles applications des nanomatériaux</a></h3>
                <p><strong>Domaines:</strong> Sciences Physiques</p>
                <p><strong>Objectif:</strong> Recherche sur les propriétés quantiques</p>
            </div>
        </div>
        <div class="col-lg-6 publication-item" data-domain="Énergies Renouvelables" data-keywords="Projets">
            <div class="publication-card">
                <div class="date-tag"><img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">05 Janvier 2024</div>
                <h3><a href="#">Projet Pilote de Panneaux Solaires Organiques</a></h3>
                <p><strong>Domaines:</strong> Énergies Renouvelables</p>
                <p><strong>Objectif:</strong> Test de nouvelles technologies photovoltaïques</p>
            </div>
        </div>
        <div class="col-lg-6 publication-item" data-domain="Biologie" data-keywords="Innovation">
            <div class="publication-card">
                <div class="date-tag"><img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">22 Décembre 2023</div>
                <h3><a href="#">Innovation en thérapie génique</a></h3>
                <p><strong>Domaines:</strong> Biologie</p>
                <p><strong>Objectif:</strong> Développement de nouveaux vecteurs viraux</p>
            </div>
        </div>
        <div class="col-lg-6 publication-item" data-domain="Sciences Physiques,Énergies Renouvelables"
            data-keywords="Projets">
            <div class="publication-card">
                <div class="date-tag"><img width="15px" class="me-1"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png"
                        alt="Icon-calendar">10 Novembre 2023</div>
                <h3><a href="#">Stockage d'énergie via hydrogène vert</a></h3>
                <p><strong>Domaines:</strong> Sciences Physiques, Énergies Renouvelables</p>
                <p><strong>Objectif:</strong> Mise en place d'un prototype fonctionnel</p>
            </div>
        </div> -->

    </div>
    <div id="noResultsMessage" class="text-center fs-4 mt-5" style="display: none;">
        Aucune publication ne correspond à votre recherche.
    </div>
    <div class="text-center m-5">
        <a href="#" class="btn-view-more">Voir plus</a>
    </div>


</main>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const domainSelect = document.getElementById('domainSelect');
        const keywordsSelect = document.getElementById('keywordsSelect');
        const applyBtn = document.getElementById('applyBtn');
        const resetBtn = document.getElementById('resetBtn');
        const publicationsContainer = document.getElementById('publicationsContainer');
        const publicationItems = publicationsContainer.querySelectorAll('.publication-item');
        const noResultsMessage = document.getElementById('noResultsMessage');

        function filterPublications() {
            const selectedDomain = domainSelect.value;
            const selectedKeyword = keywordsSelect.value;
            let visibleCount = 0;

            publicationItems.forEach(item => {
                const itemDomains = item.dataset.domain.split(',');
                const itemKeywords = item.dataset.keywords.split(',');

                const domainMatch = !selectedDomain || itemDomains.includes(selectedDomain);
                const keywordMatch = !selectedKeyword || itemKeywords.includes(selectedKeyword);

                if (domainMatch && keywordMatch) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        applyBtn.addEventListener('click', filterPublications);

        resetBtn.addEventListener('click', () => {
            domainSelect.value = '';
            keywordsSelect.value = '';
            filterPublications();
        });
    });
</script>

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
/* ========= Client API pour /reseaux/lab/... ========= */
(function(){
  const API_ROOT = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'') + '/plateforme-recherche/v1';

  function headers(){ const h={}; if (window.PMSettings?.nonce) h['X-WP-Nonce']=PMSettings.nonce; return h; }
  async function fetchJSON(url){
    const r = await fetch(url, { headers: headers(), credentials: 'same-origin' });
    if (!r.ok) throw new Error('HTTP '+r.status); return r.json();
  }
  function buildUrl(path, query={}){
    const u = new URL(API_ROOT + path, location.origin);
    Object.entries(query).forEach(([k,v])=>{ if(v!==undefined && v!=='') u.searchParams.set(k,v); });
    return u.toString();
  }

  // Expose en global
  window.ReseauxAPI = {
    byLab(labId, opts={}) {
      return fetchJSON(buildUrl(`/reseaux/lab/${encodeURIComponent(labId)}`, opts));
    },
    byLabType(labId, type_collab, opts={}) {
      return fetchJSON(buildUrl(`/reseaux/lab/${encodeURIComponent(labId)}/type/${encodeURIComponent(type_collab)}`, opts));
    },
    byLabCountry(labId, pays, opts={}) {
      return fetchJSON(buildUrl(`/reseaux/lab/${encodeURIComponent(labId)}/country/${encodeURIComponent(pays)}`, opts));
    },
    byLabStatus(labId, statut, opts={}) {
      return fetchJSON(buildUrl(`/reseaux/lab/${encodeURIComponent(labId)}/status/${encodeURIComponent(statut)}`, opts));
    }
  };

  // Helper pour récupérer l’ID labo depuis l’URL / stockage
  window.getLaboratoireId = function(){
    const u = new URL(location.href);
    const id = u.searchParams.get('laboratoireid') || u.searchParams.get('laboratoire_id') || localStorage.getItem('laboratoireid');
    if (id) localStorage.setItem('laboratoireid', id);
    return id;
  };
})();
</script>

<!-- ========= Loader (optionnel) branché à ta page ========= -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const container   = document.getElementById('publicationsContainer');
  const domainSel   = document.getElementById('domainSelect');   // => type_collab
  const keywordSel  = document.getElementById('keywordsSelect'); // => pays
  const applyBtn    = document.getElementById('applyBtn');
  const resetBtn    = document.getElementById('resetBtn');
  const viewMoreBtn = document.querySelector('.btn-view-more');
  const noResults   = document.getElementById('noResultsMessage');

  const LAB_ID = getLaboratoireId();
  const PAGE_CHUNK = 4;

  let ALL = [];
  let LIST = [];
  let idx = 0;
  const seen = new Set();

  // Utils
  function esc(s){ return (''+s).replace(/[&<>"]/g, m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m])); }
  function escAttr(s){ return esc(s).replace(/"/g,'&quot;'); }
  function formatFR(iso){ const d=new Date(iso); return isNaN(d)? (iso||'—'): d.toLocaleDateString('fr-FR'); }
  function dedupe(arr){ const s=new Set(); return (arr||[]).filter(x=>{const id=String(x.id||''); if(!id||s.has(id)) return false; s.add(id); return true;}); }

  function buildCard(r){
    return `
      <div class="col-lg-6 publication-item" data-domain="${escAttr(r.type_collab||'')}" data-keywords="${escAttr(r.pays||'')}">
        <div class="publication-card">
          <div class="date-tag">
            <img width="15" class="me-1" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/blanc.png" alt="">
            ${formatFR(r.date_debut)}
          </div>
          <h3><a href="#">${esc(r.institution || 'Partenaire')}</a></h3>
          <p><strong>Pays:</strong> ${esc(r.pays || '—')}</p>
          <p><strong>Type De Collaboration:</strong> ${esc(r.type_collab || '—')}</p>
        </div>
      </div>`;
  }

  function resetRender(){
    container.innerHTML = '';
    idx = 0; seen.clear();
    if (LIST.length === 0) {
      noResults.style.display = 'block';
      viewMoreBtn?.classList.add('d-none');
      return;
    }
    noResults.style.display = 'none';
    renderNext(PAGE_CHUNK);
  }

  function renderNext(n){
    let added = 0;
    while (idx < LIST.length && added < n) {
      const r = LIST[idx++], id = String(r.id||'');
      if (!id || seen.has(id)) continue;
      container.insertAdjacentHTML('beforeend', buildCard(r));
      seen.add(id); added++;
    }
    if (idx >= LIST.length) viewMoreBtn?.classList.add('d-none'); else viewMoreBtn?.classList.remove('d-none');
  }

  async function initialLoad(){
    container.innerHTML = '<div class="col-12 text-center">Chargement…</div>';
    const rows = await ReseauxAPI.byLab(LAB_ID, { per_page: 200, orderby: 'date_debut', order: 'DESC' });
    ALL = dedupe(rows);
    fillFilters(ALL);
    LIST = ALL.slice();
    resetRender();
  }

  function fillFilters(rows){
    // Type = type_collab
    const types = Array.from(new Set(rows.map(r=> (r.type_collab||'').trim()).filter(Boolean)))
      .sort((a,b)=>a.localeCompare(b,'fr'));
    domainSel.innerHTML = `<option value="" selected>Type De Collaboration</option>` +
      types.map(t=>`<option value="${escAttr(t)}">${esc(t)}</option>`).join('');
    // Mots clés = pays
    const pays = Array.from(new Set(rows.map(r=> (r.pays||'').trim()).filter(Boolean)))
      .sort((a,b)=>a.localeCompare(b,'fr'));
    keywordSel.innerHTML = `<option value="" selected>Pays</option>` +
      pays.map(p=>`<option value="${escAttr(p)}">${esc(p)}</option>`).join('');
  }

  async function applyFilters(){
    const t = (domainSel.value||'').trim();  // type_collab
    const p = (keywordSel.value||'').trim(); // pays
    let rows;

    // On privilégie les endpoints nommés pour réduire le volume:
    if (t && !p) {
      rows = await ReseauxAPI.byLabType(LAB_ID, t, { per_page: 200 });
    } else if (!t && p) {
      rows = await ReseauxAPI.byLabCountry(LAB_ID, p, { per_page: 200 });
    } else if (t && p) {
      // type en server-side, pays en client-side (évite 2 calls)
      rows = await ReseauxAPI.byLabType(LAB_ID, t, { per_page: 200 });
      rows = rows.filter(r => (r.pays||'').trim() === p);
    } else {
      rows = await ReseauxAPI.byLab(LAB_ID, { per_page: 200 });
    }

    LIST = dedupe(rows);
    resetRender();
  }

  // Events
  applyBtn?.addEventListener('click', (e)=>{ e.preventDefault(); applyFilters(); });
  resetBtn?.addEventListener('click', async (e)=>{
    e.preventDefault();
    domainSel.value = ''; keywordSel.value = '';
    await initialLoad();
  });
  viewMoreBtn?.addEventListener('click', (e)=>{ e.preventDefault(); renderNext(PAGE_CHUNK); });

  // GO
  if (!LAB_ID) {
    container.innerHTML = '<div class="col-12 text-center text-danger">laboratoireid manquant.</div>';
    return;
  }
  initialLoad().catch(err=>{
    console.error(err);
    container.innerHTML = '<div class="col-12 text-center text-danger">Erreur de chargement</div>';
  });
});
</script>
