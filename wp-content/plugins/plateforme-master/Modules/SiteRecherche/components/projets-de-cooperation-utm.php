<style>
/* General body styling */


/* Custom color */
.text-custom-red {
    color: #b60303;
}

.bg-custom-red {
    background-color: #b60303;
}


/* Hero section styling */
/* .hero-bg {
        background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
        background-size: cover;
        background-position: center;
    } */
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

/* Main Content Styling */
.main-content {
    margin-top: -80px;
    position: relative;
    z-index: 10;
}

.search-card {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
    /* border: 1px solid #dee2e6; */
}

.search-card .form-select {
    border-color: #d3c8bc;
    border-radius: 0.5rem;
}

.search-card .form-select:focus {
    border-color: #c9b9a6;
    box-shadow: 0 0 0 0.2rem rgba(182, 3, 3, 0.1);
}

.search-card .btn-icon {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    width: 44px;
    height: 44px;
    border-radius: 0.5rem;
    color: #b60303;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease-in-out;
}

.search-card .btn-icon:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.07);
}

.project-card {
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3Csvg width='180' height='100' viewBox='0 0 180 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 20 60 Q 60 20 100 60 T 180 60' stroke='%23f5f5f5' fill='transparent' stroke-width='3' stroke-linecap='round'/%3E%3Cpath d='M 20 80 Q 60 40 100 80 T 180 80' stroke='%23f5f5f5' fill='transparent' stroke-width='3' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: calc(100% + 20px) calc(100% + 10px);
    background-size: 60%;
    /* border: 1px solid #e9ecef; */
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 1.5rem;
    position: relative;
    transition: all 0.3s ease;
    overflow: hidden;
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
}
.project-card {
    min-height: 320px; /* adapte selon tes besoins */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* espace entre le haut et le bas */
}

.project-card:hover {
    box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
    transform: translateY(-5px);
    border-color: #dee2e6;
}

.project-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #212529;
    line-height: 1.4;
}

.project-card p {
    font-size: 0.9rem;
    color: #6c757d;
    padding-bottom: 1rem;
}

.project-card-meta {
    font-size: 0.9rem;
    color: #6c757d;
}

.project-card-meta .value {
    color: #212529;
    font-weight: 700;
}

.project-card-meta i.fas {
    color: #b60303;
    margin-right: 0.75rem;
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.project-card .arrow-link {
    position: absolute;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    background-color: #b60303;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 0 1rem 0 1rem;
}

.btn-outline-red {
    color: #b60303;
    border-color: #b60303;
    padding: 0.75rem 2rem;
    font-weight: 500;
    border-radius: 999px;
}

.btn-outline-red:hover {
    color: #fff;
    background-color: #b60303;
    border-color: #b60303;
}

.footer {
    background-color: #f1f1f1;
    padding: 3rem 0;
    margin-top: 4rem;
}

.footer p,
.footer a {
    font-size: 0.9rem;
    color: #495057;
    text-decoration: none;
}

.footer a:hover {
    color: #b60303;
}

.footer-logo {
    max-width: 120px;
}

.copyright {
    background-color: #e9ecef;
    padding: 1rem 0;
    font-size: 0.8rem;
    color: #6c757d;
}

.btn-customess {

    padding: 8px 25px;
    border: 2px solid #b60303;
    border-radius: 10px;
    font-size: 16px;
    color: #b60303;
    font-weight: 500;
    background-color: white;
    white-space: nowrap;

}

/* ====== Cartes de taille fixe & contenu maîtrisé ====== */

/* Variable pratique si tu veux ajuster la hauteur une seule fois */
:root { --card-h: 320px; }  /* ajuste 320px → 300/340 selon ton design */

/* Colonne Bootstrap → s'assure que la carte s'affiche correctement en grille */
#projectsGrid > [class*='col-'] { display: block; }

/* Carte : grille interne 3 lignes (titre / texte extensible / métadonnées) */
.project-card{
  display: grid;
  grid-template-rows: auto 1fr auto; /* h3 | p (remplit) | metas */
  height: var(--card-h);
  overflow: hidden;            /* coupe tout dépassement */
  position: relative;          /* garde arrow-link OK */
}

/* Titre : maximum 2 lignes */
.project-card h3{
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  margin-bottom: .75rem !important; /* un poil plus compact */
}

/* Paragraphe : maximum 3 lignes, occupe la ligne "1fr" de la grille */
.project-card p{
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
  overflow: hidden;
  margin-bottom: 1rem !important;
}

/* Bloc métadonnées (2 lignes max au total) */
.project-card .project-card-meta{
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Si tu veux serrer un peu les deux lignes méta */
.project-card .project-card-meta + .project-card-meta{ margin-top: .35rem; }

/* Bouton flèche : reste visible et ne rogne pas le contenu */
.project-card .arrow-link{
  z-index: 1;
}

/* Optionnel : même hauteur aussi en mobile. 
   Si tu veux auto en mobile, dé-commente le media query : */
/*
@media (max-width: 576px){
  .project-card{ height: auto; }
}
*/

</style>


<!-- Hero Section -->
<!-- <section class="hero-bg text-white">
    <div class="d-flex align-items-center" style="min-height: 425px; background-color: rgba(10, 20, 40, 0.5);">
        <div class="container">
            <a href="/utm" class="text-white text-decoration-none mb-3 d-inline-block"><i
                    class="fas fa-arrow-left me-2"></i>Retour</a>
            <h1 class="display-5 fw-bold">Projets de coopération</h1>
        </div>
    </div>
</section> -->

<section class="hero-bg">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                Structures de recherche </a> <span>›</span>Projets de coopération
        </div>
        <h1 class="text-start">Projets de coopération</h1>
    </div>
</section>

<main class="container main-content">
    <!-- Search Section -->
    <div class="search-card col-lg-12 mx-auto mb-5">
        <h5 class="fw-bold mb-3">Recherche</h5>
        <div class="row g-3 align-items-center">
            <div class="col-lg-5">
                <select id="keywordsSelect" class="form-select">
                    <option value="" selected>Mots clés</option>
                    <option value="IA">IA</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Big Data">Big Data</option>
                </select>
            </div>
            <div class="col-lg-5">
                <select id="statusSelect" class="form-select">
                    <option value="" selected>Statut</option>
                    <option value="En cours">En cours</option>
                    <option value="Terminé">Terminé</option>
                    <option value="Proposé">Proposé</option>
                </select>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <button id="applyBtn" class="btn btn-icon me-2"> <img width="15px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-checkmark.png"
                        alt="Icon-checkmark"></button>
                <button id="resetBtn" class="btn btn-icon">
                    <img width="15px"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-refresh.png"
                        alt="Icon-refresh">
                </button>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <section class="col-lg-12 mx-auto">
        <div id="projectsGrid" class="row">
            <!-- Project Card 1 -->
            <div class="col-lg-6" data-keywords="IA,Agriculture" data-status="En cours">
                <div class="project-card">
                    <a href="#" class="arrow-link"> <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Détection IA Dans <br>L'agriculture</h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...</p>
                    <div>
                        <div class="project-card-meta d-flex align-items-center mb-2">
                            <img width="15px" class="me-2"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person">

                            <span style="font-weight: 600;">Responsable :</span>
                            <span class=" value ms-2">Dr. A. Mejri</span>
                        </div>
                        <div class="project-card-meta d-flex align-items-center">
                            <i class="fas fa-heart"></i>
                            <span style="font-weight: 600;">Partenaire :</span>
                            <span class="value ms-2">MESRS</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 2 -->
            <div class="col-lg-6" data-keywords="Big Data" data-status="Terminé">
                <div class="project-card">
                    <a href="#" class="arrow-link"> <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Analyse Big Data <br>pour la Finance</h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...</p>
                    <div>
                        <div class="project-card-meta d-flex align-items-center mb-2">
                            <img width="15px" class="me-2"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person">
                            <span style="font-weight: 600;">Responsable :</span>
                            <span class="value ms-2">Dr. F. Ben Ali</span>
                        </div>
                        <div class="project-card-meta d-flex align-items-center">
                            <i class="fas fa-heart"></i>
                            <span style="font-weight: 600;">Partenaire :</span>
                            <span class="value ms-2">GoMyCode</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 3 -->
            <div class="col-lg-6" data-keywords="IA" data-status="Proposé">
                <div class="project-card">
                    <a href="#" class="arrow-link"> <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">IA pour le <br>Diagnostic Médical</h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...</p>
                    <div>
                        <div class="project-card-meta d-flex align-items-center mb-2">
                            <img width="15px" class="me-2"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person">
                            <span style="font-weight: 600;">Responsable :</span>
                            <span class="value ms-2">Dr. S. Kallel</span>
                        </div>
                        <div class="project-card-meta d-flex align-items-center">
                            <i class="fas fa-heart"></i>
                            <span style="font-weight: 600;">Partenaire :</span>
                            <span class="value ms-2">Clinique Hannibal</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Card 4 -->
            <div class="col-lg-6" data-keywords="Agriculture" data-status="Terminé">
                <div class="project-card">
                    <a href="#" class="arrow-link"> <img width="15px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png"
                            alt="Icon-person"></a>
                    <h3 class="mb-3">Optimisation de l'irrigation <br>en Agriculture</h3>
                    <p class="mb-4">Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée
                        à titre provisoire pour calibrer une mise en page...</p>
                    <div>
                        <div class="project-card-meta d-flex align-items-center mb-2">
                            <img width="15px" class="me-2"
                                src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                                alt="Icon-person">
                            <span style="font-weight: 600;">Responsable :</span>
                            <span class="value ms-2">Dr. H. Trabelsi</span>
                        </div>
                        <div class="project-card-meta d-flex align-items-center">
                            <i class="fas fa-heart"></i>
                            <span style="font-weight: 600;">Partenaire :</span>
                            <span class="value ms-2">CRDA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="noResultsMessage" class="text-center fs-4 mt-5" style="display: none;">
            Aucun projet ne correspond à votre recherche.
        </div>

        <div class="text-center m-4">
            <a href="#" class="btn btn-customess">Voir plus</a>
        </div>
    </section>
</main>


<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const keywordsSelect = document.getElementById('keywordsSelect');
    const statusSelect = document.getElementById('statusSelect');
    const applyBtn = document.getElementById('applyBtn');
    const resetBtn = document.getElementById('resetBtn');
    const projectsGrid = document.getElementById('projectsGrid');
    const projectCards = projectsGrid.querySelectorAll('.col-lg-6');
    const noResultsMessage = document.getElementById('noResultsMessage');

    function filterProjects() {
        const selectedKeyword = keywordsSelect.value;
        const selectedStatus = statusSelect.value;
        let visibleCount = 0;

        projectCards.forEach(card => {
            const cardKeywords = card.dataset.keywords.split(',');
            const cardStatus = card.dataset.status;

            const keywordMatch = !selectedKeyword || cardKeywords.includes(selectedKeyword);
            const statusMatch = !selectedStatus || cardStatus === selectedStatus;

            if (keywordMatch && statusMatch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    applyBtn.addEventListener('click', filterProjects);

    resetBtn.addEventListener('click', () => {
        keywordsSelect.value = '';
        statusSelect.value = '';
        filterProjects();
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
document.addEventListener('DOMContentLoaded', function () {
  // ====== CONFIG/API ======
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'/');
 const API_URL = (PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'/') 
              + 'plateforme-recherche/v1/projet/by-lab';
  const FETCH_QS  = { page: 1, per_page: 200 }; // charge gros pour filtrer côté client

  // ====== UI HOOKS ======
  const projectsGrid      = document.getElementById('projectsGrid');
  const noResultsMessage  = document.getElementById('noResultsMessage');
  const keywordsSelect    = document.getElementById('keywordsSelect'); // "Mots clés"
  const statusSelect      = document.getElementById('statusSelect');   // "En cours/Terminé/Proposé"
  const applyBtn          = document.getElementById('applyBtn');
  const resetBtn          = document.getElementById('resetBtn');
  const viewMoreBtn       = document.querySelector('.btn.btn-customess');

  // ====== STATE ======
  const CHUNK = 4;
  let ALL = [];         // tout ce que renvoie l'API (normalisé)
  let LIST = [];        // liste filtrée courante
  let idx  = 0;         // pointeur d’affichage
  const shownIds = new Set(); // anti-doublons

  // ====== UTILS ======
  const $esc = s => (''+(s??'')).replace(/[&<>"]/g, m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m]));
  const $attr= s => $esc(s).replace(/"/g,'&quot;');
  const today = () => new Date();
  function fmtFR(d){
    const x = new Date(d); return isNaN(x) ? (d||'—') : x.toLocaleDateString('fr-FR');
  }
  function computeStatus(d1, d2){
    const now = today();
    const sd = d1 ? new Date(d1) : null;
    const ed = d2 ? new Date(d2) : null;
    if (sd && now < sd) return 'Proposé';
    if (ed && now > ed) return 'Terminé';
    return 'En cours';
  }
  function pickKeywords(row){
    // 1) si l’API expose un champ mots_cles / tags / thematiques
    const fromApi = row.mots_cles || row.tags || row.thematiques || row.keywords;
    let arr = [];
    if (Array.isArray(fromApi)) arr = fromApi;
    else if (typeof fromApi === 'string') arr = fromApi.split(/[,;|]/).map(s=>s.trim()).filter(Boolean);

    // 2) sinon, déduire depuis le titre/objectif par rapport aux options existantes du <select>
    if (!arr.length) {
      const pool = Array.from(keywordsSelect.querySelectorAll('option'))
                  .map(o=>o.value).filter(Boolean);
      const hay = [row.titre, row.objectifs].join(' ').toLowerCase();
      arr = pool.filter(k => hay.includes(String(k).toLowerCase()));
    }
    // limiter aux 5 premiers pour éviter l’explosion visuelle
    return Array.from(new Set(arr)).slice(0,5);
  }
  function buildArrowHref(row){
    // Lien détail (adapte à ta route de détail si besoin)
    const labId = new URL(location.href).searchParams.get('laboratoireid');
    const u = new URL('/projets-de-cooperation-details', location.origin);
    u.searchParams.set('projet_id', row.id);
    if (labId) u.searchParams.set('laboratoireid', labId);
    return u.pathname + u.search;
  }

  // Normaliser 1 row API -> objet carte
  function normalizeRow(r){
    const kw = pickKeywords(r);
    const statut = (r.statut && ['En cours','Terminé','Proposé'].includes(r.statut))
                   ? r.statut
                   : computeStatus(r.date_debut, r.date_fin);
    return {
      id: String(r.id ?? ''),
      titre: r.titre || 'Projet',
      resume: r.objectifs || r.description || '',
      porteur: r.chercheur_nom || r.porteur_nom || '—',
      partenaire: r.financement_intitule || r.partenaire || '—',
      date_debut: r.date_debut || '',
      date_fin: r.date_fin || '',
      statut,
      keywords: kw,
      href: buildArrowHref(r)
    };
  }

  // ====== RENDER ======
  function buildCard(p){
    const kwords = p.keywords.join(',');
    return `
      <div class="col-lg-6" data-keywords="${$attr(kwords)}" data-status="${$attr(p.statut)}">
        <div class="project-card">
          <!--<a href="${$attr(p.href)}" class="arrow-link">
            <img width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png" alt="">
          </a>-->
          <h3 class="mb-3">${$esc(p.titre)}</h3>
          ${p.resume ? `<p class="mb-4">${$esc(String(p.resume)).slice(0,180)}${p.resume.length>180?'…':''}</p>` : `<p class="mb-4">—</p>`}
          <div>
            <div class="project-card-meta d-flex align-items-center mb-2">
              <img width="15" class="me-2" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png" alt="">
              <span style="font-weight: 600;">Responsable :</span>
              <span class="value ms-2">${$esc(p.porteur)}</span>
            </div>
            <div class="project-card-meta d-flex align-items-center">
              <i class="fas fa-heart"></i>
              <span style="font-weight: 600;">Partenaire :</span>
              <span class="value ms-2">${$esc(p.partenaire)}</span>
            </div>
          </div>
        </div>
      </div>`;
  }

  function resetRender(){
    projectsGrid.innerHTML = '';
    shownIds.clear();
    idx = 0;
    if (!LIST.length){
      noResultsMessage.style.display = 'block';
      viewMoreBtn?.classList.add('d-none');
      return;
    }
    noResultsMessage.style.display = 'none';
    renderNext(CHUNK);
  }

  function renderNext(n){
    let added = 0;
    while (idx < LIST.length && added < n) {
      const row = LIST[idx++];
      if (!row.id || shownIds.has(row.id)) continue; // anti-doublon
      projectsGrid.insertAdjacentHTML('beforeend', buildCard(row));
      shownIds.add(row.id);
      added++;
    }
    if (idx >= LIST.length) viewMoreBtn?.classList.add('d-none');
    else viewMoreBtn?.classList.remove('d-none');
  }

  // ====== FILTERS ======
  function currentFilters(){
    return {
      kw: (keywordsSelect.value || '').trim(),
      st: (statusSelect.value || '').trim()
    };
  }
  function applyFilters(){
    const f = currentFilters();
    LIST = ALL.filter(p => {
      const okKW = !f.kw || p.keywords.map(x=>String(x)).includes(f.kw);
      const okST = !f.st || p.statut === f.st;
      return okKW && okST;
    });
    resetRender();
  }

  // ====== FETCH ======
    async function fetchProjects(){
    // 1) Récup laboId depuis ?laboratoireid=… | ?laboratoire_id=… | /laboratoireid=… | localStorage
    const labId = (() => {
        const u = new URL(location.href);
        return u.searchParams.get('laboratoireid')
            || u.searchParams.get('laboratoire_id')
            || (location.pathname.match(/laboratoireid=(\d+)/)?.[1])
            || localStorage.getItem('laboratoireid')
            || '';
    })();

    if (!labId) {
        throw new Error('laboratoire_id manquant : ajoutez ?laboratoireid=… à l’URL');
    }
    localStorage.setItem('laboratoireid', labId);

    // 2) Construire l’URL /by-lab avec pagination et (option) statut serveur
    const u = new URL(API_URL, location.origin);
    u.searchParams.set('laboratoire_id', labId);
    u.searchParams.set('page', FETCH_QS.page);
    u.searchParams.set('per_page', FETCH_QS.per_page);

    // Option : si un statut est choisi dans l’UI, on le passe au backend pour réduire le volume
    const st = (typeof statusSelect !== 'undefined' && statusSelect?.value) ? statusSelect.value.trim() : '';
    if (st) u.searchParams.set('statut', st); // "En cours" | "Terminé" | "Proposé"

    // 3) Appel
    const headers = {};
    if (window.PMSettings?.nonce) headers['X-WP-Nonce'] = PMSettings.nonce;

    const resp = await fetch(u.toString(), { headers, credentials: 'same-origin' });
    if (!resp.ok) {
        const txt = await resp.text().catch(()=> '');
        throw new Error(`HTTP ${resp.status} ${txt}`);
    }

    const json = await resp.json().catch(()=> []);
    // L’API renvoie un array d’objets (pas {items:…})
    return Array.isArray(json) ? json : [];
    }


  // ====== INIT ======
  (async function init(){
    try {
      // loader
      projectsGrid.innerHTML = '<div class="col-12 text-center">Chargement…</div>';

      const raw = await fetchProjects();
      const norm = raw.map(normalizeRow).filter(x=>x.id); // garde uniquement id valides

      // dédupe par id
      const seen = new Set(); ALL = [];
      for (const x of norm){ if (!seen.has(x.id)) { seen.add(x.id); ALL.push(x); } }

      // si le select "Mots clés" est vide (juste placeholder), on injecte dynamiquement les mots-clés
      if (keywordsSelect && keywordsSelect.options.length <= 1) {
        const kwSet = new Set();
        ALL.forEach(p => p.keywords.forEach(k => kwSet.add(String(k))));
        const opts = Array.from(kwSet).sort((a,b)=>a.localeCompare(b,'fr'))
          .map(k => `<option value="${$attr(k)}">${$esc(k)}</option>`).join('');
        keywordsSelect.innerHTML = `<option value="" selected>Mots clés</option>` + opts;
      }

      LIST = ALL.slice();
      resetRender();

      // events
      applyBtn?.addEventListener('click', (e)=>{ e.preventDefault(); applyFilters(); });
      resetBtn?.addEventListener('click', (e)=>{
        e.preventDefault();
        keywordsSelect.value = '';
        statusSelect.value = '';
        applyFilters();
      });
      viewMoreBtn?.addEventListener('click', (e)=>{ e.preventDefault(); renderNext(CHUNK); });

    } catch (err) {
      console.error(err);
      projectsGrid.innerHTML = '<div class="col-12 text-center text-danger">Erreur de chargement des projets.</div>';
      viewMoreBtn?.classList.add('d-none');
    }
  })();
});
</script>
