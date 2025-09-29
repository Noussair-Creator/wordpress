<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications UTM</title>
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
            /* A light grey background for better contrast */
        }

        /* Custom Component: Title Divider (from original code) */
        .titre-ligne-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 60px 0 40px;
            gap: 10px;
            padding: 0 10%;
        }

        .ligne-gauche,
        .ligne-droite {
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

        .ligne-gauche::after {
            right: 0;
        }

        .ligne-droite::before {
            left: 0;
        }

        .titre-ligne {
            padding: 8px 25px;
            border: 2px solid #b60303;
            border-radius: 999px;
            font-size: 16px;
            color: #b60303;
            font-weight: 500;
            background-color: white;
            white-space: nowrap;
        }

        /* Utility classes */
        .text-custom-red {
            color: #b60303;
        }


        /* Hero section styling */
        .hero-bg {
            background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
            background-size: cover;
            background-position: center;
            padding: 13rem 0;
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


        /* Search and Filter Section Styling */
        .search-card {
            margin-inline: -105px;
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #dee2e6; */
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
            padding: 0.75rem 1.5rem;
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
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-reinitialiser:hover {
            background-color: #f8f9fa;
            color: #b60303;
        }

        /* Custom styling for the date input group to match design */
        .year-input-group .form-control {
            border-right: 0;
        }

        .year-input-group .input-group-text {
            background-color: white;
            border-left: 0;
            border: 1px solid #A6A485;
        }


        /* New Publication Card Design */
        .publication-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #dee2e6; */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .publication-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .publication-card h5 {
            color: #212529;
            font-weight: 600;
        }

        .publication-card p {
            color: #000000ff;
            font-size: 0.95rem;
            flex-grow: 1;
            /* Makes description take available space */
        }

        .publication-card-meta {
            font-size: 0.875rem;
            color: #000000ff;
        }

        .publication-card-meta i {
            color: #b60303;
        }

        .publication-arrow {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 56px;
            height: 48px;
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


        .container {
            margin-top: -110px;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                    Structures de recherche </a> <span>›</span>Publications
            </div>
            <h1 class="text-start">Publications</h1>
        </div>
    </section>

    <main class="container">

        <!-- Search/Filter Section -->
        <section class="col-lg-10 mx-auto mt-5">
            <div class="search-card">
                <h2 class="h4 fw-bold mb-4">Recherche</h2>
                <form id="searchForm">
                    <div class="row g-3 align-items-center">
                        <!-- Input fields column -->
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <div class="col-md-6"  style="display:none">
                                    <select id="domainSelect" class="form-select">
                                        <option value="" selected>Domaine</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id="authorSelect" class="form-select">
                                        <option value="" selected>Auteur</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id="typeSelect" class="form-select">
                                        <option value="" selected>Type</option>
                                    </select>
                                </div>
                                <div class="col-md-6" style="display:none">
                                    <div class="input-group year-input-group">
                                        <input type="text" id="yearInput" class="form-control"
                                            placeholder="Année (ex: 2023 ou 2020-2024)">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-alt text-secondary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons column -->
                        <div class="col-lg-3">
                                <button type="reset" class="btn btn-reinitialiser">Réinitialiser</button>
                                <button type="submit" class="btn btn-rechercher">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>


        <!-- Publications Grid Section -->
        <section class="mt-5">
            <div id="publicationsGrid" class="row row-cols-1 row-cols-md-2 g-4">
                <!-- Publication cards will be dynamically inserted here -->
            </div>
            <!-- No results message -->
            <div id="noResultsMessage" class="text-center p-5" style="display: none;">
                <h4>Aucune publication ne correspond à vos critères de recherche.</h4>
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
        document.addEventListener('DOMContentLoaded', function () {
            // --- MOCK DATA ---
            const allPublications = [];

            // --- ELEMENTS ---
            const publicationsGrid = document.getElementById('publicationsGrid');
            const domainSelect = document.getElementById('domainSelect');
            const authorSelect = document.getElementById('authorSelect');
            const typeSelect = document.getElementById('typeSelect');
            const yearInput = document.getElementById('yearInput');
            const searchForm = document.getElementById('searchForm');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const noResultsMessage = document.getElementById('noResultsMessage');


            // --- STATE ---
            let visiblePublicationsCount = 4;
            let currentPublications = [...allPublications];

            // --- FUNCTIONS ---

            /**
             * Renders a list of publications to the grid.
             * @param {Array} publications - The array of publication objects to render.
             */
            function renderPublications(publications) {
                publicationsGrid.innerHTML = ''; // Clear existing content
                const publicationsToRender = publications.slice(0, visiblePublicationsCount);

                if (publicationsToRender.length === 0) {
                    noResultsMessage.style.display = 'block';
                } else {
                    noResultsMessage.style.display = 'none';
                }

                publicationsToRender.forEach(pub => {
                    const date = new Date(pub.date);
                    const formattedDate = date.toLocaleDateString('fr-FR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });

                    const card = `
                        <div class="col">
                            <div class="publication-card position-relative">
                                <a href="${pub.link}" class="publication-arrow">
                                    <img width="15px" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png" alt="Icon-diagonal-arrow-right-up.png">
                                </a>
                                <h5>${pub.title}</h5>
                                <p>${pub.description}</p>
                                <div class="publication-card-meta mt-auto pt-3">
                                    <span class="d-block mb-2 fw-bolder">
                                        <img class="me-2" width="15px" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png" alt="Icon-person.png">
                                        ${pub.author} (${pub.authorInfo})
                                    </span>
                                    <span class="d-block">
                                        <img class="me-2" width="15px" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png" alt="Icon-calendar.png">
                                        ${formattedDate}
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                    publicationsGrid.innerHTML += card;
                });

                // Manage "Load More" button visibility
                if (visiblePublicationsCount >= publications.length) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'inline-block';
                }
            }

            /**
             * Populates the select dropdowns with unique values from the publications data.
             */
            function populateFilters() {
                const domains = [...new Set(allPublications.map(p => p.domain))];
                const authors = [...new Set(allPublications.map(p => p.author))];
                const types = [...new Set(allPublications.map(p => p.type))];

                domains.forEach(d => {
                    domainSelect.innerHTML += `<option value="${d}">${d}</option>`;
                });
                authors.forEach(a => {
                    authorSelect.innerHTML += `<option value="${a}">${a}</option>`;
                });
                types.forEach(t => {
                    typeSelect.innerHTML += `<option value="${t}">${t}</option>`;
                });
            }

            /**
             * Filters publications based on form input.
             */
            function filterPublications() {
                const domain = domainSelect.value;
                const author = authorSelect.value;
                const type = typeSelect.value;
                const yearValue = yearInput.value.trim();

                let [startYear, endYear] = [null, null];
                if (yearValue.includes('-')) {
                    [startYear, endYear] = yearValue.split('-').map(y => parseInt(y.trim()));
                } else if (yearValue) {
                    startYear = parseInt(yearValue);
                    endYear = startYear;
                }

                currentPublications = allPublications.filter(pub => {
                    const pubYear = new Date(pub.date).getFullYear();

                    const domainMatch = !domain || pub.domain === domain;
                    const authorMatch = !author || pub.author === author;
                    const typeMatch = !type || pub.type === type;
                    const yearMatch = !startYear || (pubYear >= startYear && pubYear <= endYear);

                    return domainMatch && authorMatch && typeMatch && yearMatch;
                });

                visiblePublicationsCount = 4; // Reset visible count on new search
                renderPublications(currentPublications);
            }

            // --- EVENT LISTENERS ---

            searchForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent form from submitting traditionally
                filterPublications();
            });

            searchForm.addEventListener('reset', function () {
                // Use a short timeout to allow the form to reset its values before filtering
                setTimeout(() => {
                    currentPublications = [...allPublications];
                    visiblePublicationsCount = 4;
                    renderPublications(currentPublications);
                }, 0);
            });

            loadMoreBtn.addEventListener('click', function () {
                visiblePublicationsCount += 4; // Show 4 more
                renderPublications(currentPublications);
            });

            // --- INITIALIZATION ---
            populateFilters();
            renderPublications(currentPublications);
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
  // ========= CONFIG =========
  const API_NS   = 'plateforme-recherche/v1';
  const API_BASE = (window.PMSettings && PMSettings.restUrl) ? PMSettings.restUrl.replace(/\/+$/,'/') : '/wp-json/';
  const PAGE_SIZE_REMOTE = 200;  // on charge jusqu'à 200 en une fois pour filtrer côté client
  const CHUNK_CLIENT     = 4;    // "Voir plus" par pas de 4

  // ========= UI ELTS =========
  const publicationsGrid  = document.getElementById('publicationsGrid');
  const domainSelect      = document.getElementById('domainSelect'); // Domaine = Revue
  const authorSelect      = document.getElementById('authorSelect');
  const typeSelect        = document.getElementById('typeSelect');
  const yearInput         = document.getElementById('yearInput');
  const searchForm        = document.getElementById('searchForm');
  const loadMoreBtn       = document.getElementById('loadMoreBtn');
  const noResultsMessage  = document.getElementById('noResultsMessage');

  // ========= STATE =========
  let LAB_ID = resolveLaboratoireId();
  let SCOPE  = resolveScope(); // all | director | members
  let ALL_ITEMS = [];          // items bruts du backend
  let FILTERED  = [];          // items après filtres UI
  let visibleCount = CHUNK_CLIENT;

  // ========= INIT =========
  boot();

  // ========= MAIN =========
  async function boot() {
    try {
      const items = await fetchPublications({ laboratoire_id: LAB_ID, scope: SCOPE, page: 1, per_page: PAGE_SIZE_REMOTE });
      ALL_ITEMS = normalizeItems(items);
      populateFilters(ALL_ITEMS);
      applyFiltersAndRender();
    } catch (e) {
      console.error('Erreur de chargement publications:', e);
      publicationsGrid.innerHTML = `<div class="col"><div class="alert alert-danger">Impossible de charger les publications.</div></div>`;
    }
  }

  // ========= FETCH =========
  function endpointForScope(scope) {
    switch (scope) {
      case 'director': return 'publications/by-director';
      case 'members':  return 'publications/by-members';
      default:         return 'publications/by-lab';
    }
  }

  async function fetchPublications({ laboratoire_id, scope='all', page=1, per_page=20, type='' }) {
    const ep  = endpointForScope(scope);
    const u   = new URL(`${API_BASE}${API_NS}/${ep}`);
    if (laboratoire_id) u.searchParams.set('laboratoire_id', laboratoire_id);
    u.searchParams.set('page', page);
    u.searchParams.set('per_page', per_page);
    // On ne passe le type au backend que si l'utilisateur l'a sélectionné.
    if (type) u.searchParams.set('type', type);

    const headers = {};
    if (window.PMSettings && PMSettings.nonce) headers['X-WP-Nonce'] = PMSettings.nonce;

    const resp = await fetch(u.toString(), { headers });
    if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
    const data = await resp.json();
    return Array.isArray(data) ? data : [];
  }

  // ========= NORMALISATION =========
  function normalizeItems(rows) {
    return rows.map(r => {
      // Back: date_publication, titre, type, revue, auteur_display, id, fichier_url, resume, etc.
      const d = r.date_publication || r.date || '';
      return {
        id: r.id,
        title: r.titre || '(Sans titre)',
        description: stripHTML(r.resume || '').slice(0, 240),
        author: r.auteur_display || r.display_name || r.user_login || 'Auteur inconnu',
        authorInfo: r.revue ? `Revue : ${r.revue}` : '',     // On utilise la revue comme info secondaire
        date: d,
        domain: r.revue || '',                               // "Domaine" = Revue côté UI
        type: r.type || '',
        link: buildDetailLink(r.id),
      };
    });
  }

  function buildDetailLink(id) {
    const u = new URL(location.origin + '/publications-utm-details');
    u.searchParams.set('publication_id', id);
    if (LAB_ID) u.searchParams.set('laboratoireid', LAB_ID);
    return u.pathname + u.search;
  }

  function stripHTML(html) {
    const tmp = document.createElement('div');
    tmp.innerHTML = html || '';
    return (tmp.textContent || tmp.innerText || '').trim().replace(/\s+/g,' ');
  }

  // ========= FILTERS =========
  function populateFilters(items) {
    // Récupérer valeurs uniques
    const authors = uniq(items.map(x => x.author).filter(Boolean)).sort(alpha);
    const types   = uniq(items.map(x => x.type).filter(Boolean)).sort(alpha);
    const revues  = uniq(items.map(x => x.domain).filter(Boolean)).sort(alpha);

    // Reset
    domainSelect.length = 1; // garder l'option "Domaine"
    authorSelect.length = 1; // garder l'option "Auteur"
    typeSelect.length   = 1; // garder l'option "Type"

    // Inject
    revues.forEach(v   => domainSelect.insertAdjacentHTML('beforeend', `<option value="${esc(v)}">${esc(v)}</option>`));
    authors.forEach(a  => authorSelect.insertAdjacentHTML('beforeend', `<option value="${esc(a)}">${esc(a)}</option>`));
    types.forEach(t    => typeSelect.insertAdjacentHTML('beforeend',   `<option value="${esc(t)}">${esc(t)}</option>`));
  }

  function applyFiltersAndRender() {
    const selDomain = domainSelect.value || '';
    const selAuthor = authorSelect.value || '';
    const selType   = typeSelect.value   || '';
    const yearValue = (yearInput.value || '').trim();

    // Filtre "Type" : on peut le demander au backend pour réduire le volume
    // => Si l'utilisateur a changé "Type", on relance un fetch ciblé, puis on filtre le reste côté client.
    if (selType && shouldRefetchForType()) {
      refetchForType(selType).then(() => {
        doClientFilterAndRender(selDomain, selAuthor, selType, yearValue);
      }).catch(err => {
        console.error(err);
        doClientFilterAndRender(selDomain, selAuthor, selType, yearValue);
      });
    } else {
      doClientFilterAndRender(selDomain, selAuthor, selType, yearValue);
    }
  }

  function doClientFilterAndRender(selDomain, selAuthor, selType, yearValue) {
    let startYear = null, endYear = null;
    if (yearValue.includes('-')) {
      const parts = yearValue.split('-').map(x => parseInt(x.trim(), 10));
      startYear = isFinite(parts[0]) ? parts[0] : null;
      endYear   = isFinite(parts[1]) ? parts[1] : startYear;
    } else if (yearValue) {
      const y = parseInt(yearValue, 10);
      startYear = isFinite(y) ? y : null;
      endYear   = startYear;
    }

    FILTERED = ALL_ITEMS.filter(p => {
      const y = p.date ? new Date(p.date).getFullYear() : null;
      const okType   = !selType   || p.type   === selType;
      const okAuth   = !selAuthor || p.author === selAuthor;
      const okDom    = !selDomain || p.domain === selDomain;
      const okYear   = !startYear || (y && y >= startYear && y <= endYear);
      return okType && okAuth && okDom && okYear;
    });

    visibleCount = CHUNK_CLIENT;
    renderPublications(FILTERED);
  }

  function shouldRefetchForType() {
    // Si ALL_ITEMS est vide (premier chargement) -> non (boot a déjà fetch)
    // Si l'utilisateur change "Type", on peut refetch pour charger les 200 de ce type (meilleure exhaustivité)
    return ALL_ITEMS.length > 0;
  }

  async function refetchForType(typeValue) {
    const items = await fetchPublications({
      laboratoire_id: LAB_ID,
      scope: SCOPE,
      page: 1,
      per_page: PAGE_SIZE_REMOTE,
      type: typeValue
    });
    ALL_ITEMS = normalizeItems(items);
    // On régénère les options "Auteur" et "Domaine" en fonction de l'ensemble filtré backend + front
    populateFilters(ALL_ITEMS);
  }

  // ========= RENDER =========
  function renderPublications(list) {
    publicationsGrid.innerHTML = '';
    const slice = list.slice(0, visibleCount);

    if (slice.length === 0) {
      noResultsMessage.style.display = 'block';
    } else {
      noResultsMessage.style.display = 'none';
    }

    slice.forEach(pub => {
      const formattedDate = formatDateFR(pub.date);
      const card = `
        <div class="col">
          <div class="publication-card position-relative">
            <a href="${pub.link}" class="publication-arrow">
              <img width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-diagonal-arrow-right-up.png" alt="">
            </a>
            <h5>${esc(pub.title)}</h5>
            <p>${esc(pub.description)}</p>
            <div class="publication-card-meta mt-auto pt-3">
              <span class="d-block mb-2 fw-bolder">
                <img class="me-2" width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png" alt="">
                ${esc(pub.author)} ${pub.authorInfo ? '(' + esc(pub.authorInfo) + ')' : ''}
              </span>
              <span class="d-block">
                <img class="me-2" width="15" src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png" alt="">
                ${formattedDate}
              </span>
            </div>
          </div>
        </div>
      `;
      publicationsGrid.insertAdjacentHTML('beforeend', card);
    });

    loadMoreBtn.style.display = (visibleCount >= list.length) ? 'none' : 'inline-block';
  }

  // ========= EVENTS =========
  searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    applyFiltersAndRender();
  });

  searchForm.addEventListener('reset', function () {
    setTimeout(() => {
      // Réinitialiser depuis le backend de base (sans type)
      boot();
    }, 0);
  });

  loadMoreBtn.addEventListener('click', function () {
    visibleCount += CHUNK_CLIENT;
    renderPublications(FILTERED);
  });

  // ========= UTILS =========
  function resolveLaboratoireId() {
    const url = new URL(location.href);
    const qs  = url.searchParams.get('laboratoireid') || url.searchParams.get('laboratoire_id');
    const seg = (location.pathname.match(/(?:^|\/)laboratoireid=(\d+)(?:\/|$)/i) || [])[1];
    const pm  = (window.PMSettings && (PMSettings.laboratoireId || PMSettings.laboId)) || null;
    const ls  = localStorage.getItem('laboratoireid') || localStorage.getItem('laboratoire_id');
    const out = qs || seg || pm || ls || '';
    if (out) {
      localStorage.setItem('laboratoireid', out);
      localStorage.setItem('laboratoire_id', out);
    }
    return out;
  }

  function resolveScope() {
    const qs = new URL(location.href).searchParams.get('scope');
    return (qs === 'director' || qs === 'members') ? qs : 'all';
  }

  function formatDateFR(iso) {
    if (!iso) return '';
    const d = new Date(iso);
    if (isNaN(d)) return iso;
    return d.toLocaleDateString('fr-FR', { day:'2-digit', month:'2-digit', year:'numeric' });
  }

  function uniq(arr){ return Array.from(new Set(arr)); }
  function alpha(a,b){ return (''+a).localeCompare((''+b), 'fr', { sensitivity:'base' }); }
  function esc(s){ return (''+s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }
});
</script>

</body>

</html>