<?php
// CardMembresDeLaboratoire2.php

// This component displays a list of news-style cards with a header and filter bar.
// It includes all its own styling to be self-contained.
// JavaScript has been added to enable search and category filtering, and a modal.
?>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<style>
    /* * Main container for the entire news block */
    .actualites-container {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    /* * Styles for the header bar (Title and button) */
    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .dashboard-sub-title {
        font-weight: bold;
        font-size: 22px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .add-button {
        background-color: #c60000;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 10px 40px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        height: 42px;
        box-sizing: border-box;
    }

    .add-button:hover {
        background-color: #a90000;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0e0e0;
        margin: 16px 0;
    }

    /* * Styles for the filter bar section */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-bottom: 20px;
        position: relative;
        flex-wrap: wrap;
    }

    .filter-inputs {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .filter-bar .filter-input,
    .filter-bar .filter-select {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.6rem 0.75rem;
        background-color: #fdfdfd;
        font-size: 14px;
        height: 42px;
        box-sizing: border-box;
        transition: border-color 0.2s;
        min-width: 180px;
    }

    .filter-bar .filter-input {
        width: 220px;
    }

    .filter-bar .filter-input:focus,
    .filter-bar .filter-select:focus {
        outline: none;
        border-color: #c60000;
    }

    .filter-bar .filter-select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon .icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        pointer-events: none;
        font-size: 14px;
    }

    .input-with-icon .right-icon {
        right: 0.85rem;
    }

    /* * Styles for the news card component. */
    .news-card-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 20px;
    }

    .news-card {
        background-color: #fdfdfd;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        position: relative;
        display: block;
        /* Ensure it's visible by default */
        transition: opacity 0.3s ease;
    }

    .news-card.hidden {
        display: none;
    }

    .news-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 24px;
        width: 3px;
        height: 28px;
        background-color: #c60000;
        border-radius: 1.5px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .category-tag {
        border: 1px solid #c60000;
        color: #c60000;
        background-color: #fff;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 500;
    }

    .news-date {
        font-size: 14px;
        color: #65676b;
    }

    .news-title {
        font-size: 17px;
        font-weight: bold;
        color: #1c1e21;
        margin-top: 0;
        margin-bottom: 8px;
    }

    .news-description {
        font-size: 16px;
        color: #65676b;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .read-more-link {
        font-size: 16px;
        color: #c60000;
        text-decoration: none;
        font-weight: 600;
    }

    .read-more-link:hover {
        text-decoration: underline;
    }

    /* Modal Styles */
    .btn-close-x {
        display: none;
        background: transparent;
        border: none;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        padding: 4px 10px;
        line-height: 1;
        transition: color 0.2s ease;
        margin-left: 10px;
    }

    .btn-close-x:hover {
        color: #c40000;
    }

    .modal-overlay {
        position: fixed;
        top: 0px;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: flex-end;
        z-index: 999999;
    }

    .popup-container {
        background-color: white;
        width: 500px;
        height: 100%;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        box-shadow: 0px 5px 16px #00000029;
    }

    .popup-header h2 {
        font-size: 16px;
        margin: 0;
        color: #2A2916;
    }

    form.popup-form {
        padding: 25px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #4a4a4a;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group label:not(:last-child) {
        margin-bottom: 0px;

    }

    .popup-form input[type="text"],
    .popup-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #DBD9C3;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .popup-form select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
        padding-right: 2.5rem;
    }

    .btn-enregistrer {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
    }

    .input-file-wrapper {
        display: flex;
        align-items: center;
        /* border: 1px solid #dcdcdc; */
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
        background-color: white;
    }

    .input-file-text {
        border-radius: 7px 0px 0px 7px !important;
        flex: 1;
        border: none;
        padding: 10px 12px;
        font-size: 14px;
        color: #555;
        background-color: #f9f9f9;
    }

    .input-file-text:focus {
        outline: none;
    }

    .btn-importer {
        background-color: #b5af8e;
        color: white;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        border: none;
        white-space: nowrap;
        border: 1px solid #DBD9C3;
    }

    .btn-importer i {
        font-size: 14px;
    }

    .ql-toolbar.ql-snow {
        border-radius: 6px 6px 0 0;
        background-color: #ECEBE3;
        border: 1px solid #DBD9C3;
        padding: 8px;
    }

    .ql-container.ql-snow {
        border-radius: 0 0 6px 6px;
        font-size: 14px;
        border: 1px solid #dcdcdc;
        border-top: 0;
    }
    input{
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #b5af8e;
    border-radius: 7px;
    font-size: 14px;
    box-sizing: border-box;
}
label.btn-importer {
    color: #fff;
}
</style>

<div class="actualites-container mt-4">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/imagesED/5228529.png" alt="Icon" style="width: 38px;">
            Liste des manifestations de l'UTM
        </h2>
        <?php if(!in_array('um_chercheur', $roles, true)) { ?>
        <button class="add-button">Ajouter</button>

        <?php } ?>
    </div>

    <hr class="section-divider">

    <div class="filter-bar">
        <div class="filter-inputs">
            <!-- Search Input -->
            <div class="input-with-icon">
                <input class="filter-input" type="text" placeholder="Recherchez...">
                <i class="fas fa-search icon right-icon"></i>
            </div>

            <!-- Category Select -->
            <div class="input-with-icon">
                <select class="filter-select" id="filtrer-categorie">
                </select>
                <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
        </div>
    </div>

    <div class="news-card-container">
       

    </div>
</div>

<!-- Modal HTML -->
<div class="modal-overlay" id="modalObjectifs" style="display: none;">
    <div class="popup-container" id="popupContainerObjectifs">
        <div class="popup-header">
            <h2>Ajouter une manifestation</h2>
            <div>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
                <button class="btn-close-x" onclick="closeModalObjectifs()">×</button>
            </div>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie">
                    <option>Appels a projets</option>
                    <option>Colloque</option>
                </select>
            </div>

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre">
            </div>

            <div class="form-group">
                <label>Texte</label>
                <div id="objectifSpecifique" style="height: 150px;"></div>
            </div>
            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" id="date_debut" name="date_debut">
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" id="date_fin" name="date_fin">
            </div>

            <div class="form-group">
                <label for="file-upload-input">Importer les images</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" placeholder="Aucun fichier choisi" readonly>
                    <label for="file-upload-input" class="btn-importer">
                        <i class="fas fa-upload"></i> Importer
                    </label>
                    <input type="file" id="file-upload-input" multiple style="display: none;">
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // Modal Functions
    function openmodalObjectifs() {
        const modal = document.getElementById("modalObjectifs");
        if (modal) {
            modal.style.display = "flex";
        } else {
            console.error("Modal not found: #modalObjectifs");
        }
    }

    function closeModalObjectifs() {
        const modal = document.getElementById("modalObjectifs");
        if (modal) {
            modal.style.display = "none";
        }
    }
 // --- Card Filtering Logic ---
        const searchInput = document.querySelector('.filter-input');
        const categorySelect = document.querySelector('.filter-select');
        const newsCards = document.querySelectorAll('.news-card');

        function filterNews() {
            const searchText = searchInput.value.toLowerCase().trim();
            const selectedCategory =categorySelect.options[categorySelect.selectedIndex].text;


            // 👇 sélectionner dynamiquement les cartes actuelles
            const newsCards = document.querySelectorAll('.news-card');

           newsCards.forEach(card => { 
                const title = card.querySelector('.news-title').textContent.toLowerCase();
                const description = card.querySelector('.news-description').textContent.toLowerCase();
                const cardCategory = card.querySelector('.category-tag').textContent.trim();

                const textMatch = title.includes(searchText) || description.includes(searchText);

                const categoryMatch = 
                        selectedCategory === "" || 
                        selectedCategory === "Toutes les catégories" || 
                        cardCategory === selectedCategory;

                if (textMatch && categoryMatch) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

        }

    document.addEventListener('DOMContentLoaded', function () {
       

        searchInput.addEventListener('keyup', filterNews);
        categorySelect.addEventListener('change', filterNews);

        // --- Modal Logic ---
        const addButton = document.querySelector('.add-button');
        const modal = document.getElementById("modalObjectifs");
        const popup = document.getElementById("popupContainerObjectifs");

        // Open modal on "Ajouter" button click
        if (addButton) {
            addButton.addEventListener("click", openmodalObjectifs);
        }

        // Close modal if click is outside the popup container
        if (modal && popup) {
            modal.addEventListener("click", function (e) {
                if (!popup.contains(e.target)) {
                    closeModalObjectifs();
                }
            });
        }

        // Modal File Input Logic
        const fileInput = document.getElementById('file-upload-input');
        const fileText = document.querySelector('.input-file-text');

        if (fileInput && fileText) {
        fileInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
            if (this.files.length === 1) {
                fileText.value = this.files[0].name; // nom du fichier
            } else {
                fileText.value = this.files.length + " fichiers sélectionnés"; // nombre
            }
            } else {
            fileText.value = 'Aucun fichier choisi';
            }
        });
        }

        // Initialize Quill Rich Text Editor
        /*let quillSpecifique = new Quill('#objectifSpecifique', {
            theme: 'snow',
            placeholder: '......',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'link'],
                    [{
                        'list': 'bullet'
                    }]
                ]
            }
        });*/
        // Au lieu de let (local), on attache à window
        window.quillSpecifique = new Quill('#objectifSpecifique', {
        theme: 'snow',
        placeholder: '......',
        modules: {
            toolbar: [
            ['bold', 'italic', 'link'],
            [{ 'list': 'bullet' }]
            ]
        }
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



<script>
const REST_NS = `${PMSettings?.restUrl || '/wp-json/'}plateforme-recherche/v1`;

async function apiGET(path) {
  const res = await fetch(`${REST_NS}${path}`, {
    headers: { 'X-WP-Nonce': PMSettings?.nonce || '' }
  });
  if (!res.ok) throw new Error(`API ${path} (${res.status})`);
  return res.json();
}

async function loadCategories() {
  try {
    const cats = await apiGET('/manifestation/categories');

    // Remplir le select du modal
    const sel1 = document.getElementById('categorie');
    if (sel1) {
      sel1.innerHTML = '<option value="">-- Sélectionner --</option>';
      cats.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.id;
        opt.textContent = c.nom;
        sel1.appendChild(opt);
      });
    }

    // Remplir le select de filtre
    const sel2 = document.getElementById('filtrer-categorie');
    if (sel2) {
      sel2.innerHTML = '<option value="">Toutes les catégories</option>';
      cats.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.id;
        opt.textContent = c.nom;
        sel2.appendChild(opt);
      });
    }

  } catch (e) {
    console.error('Erreur chargement catégories', e);
  }
}

// Charger à l’ouverture de la page
document.addEventListener('DOMContentLoaded', loadCategories);

/* ==========  A. STATISTIQUES + DONUT  ========== */
let donutChart;

async function loadManifestationStats(year = null) {
  const s = await apiGET('/manifestation/stats', year ? {year} : {});
  // Gauche
  document.querySelector('.stat-box .value').textContent = s.last_published || '—';
  document.querySelectorAll('.stat-box .value')[1].textContent = s.count_this_month ?? 0;

  // Dropdown années
  const sel = document.querySelector('.graph-select');
  if (sel && s.years && s.years.length) {
    sel.innerHTML = s.years.map(y => `<option>${y}</option>`).join('');
    if (year) sel.value = year;
  }

  // Donut
  const labels = s.donut.map(d => d.label);
  const values = s.donut.map(d => d.value);
  const colors = ['#808066','#b1342f','#dabebe','#8a8a6a','#e07a7a','#d9cfcf','#5f5f47'];

  const ctx = document.getElementById('pieChart').getContext('2d');
  if (donutChart) donutChart.destroy();
  donutChart = new Chart(ctx, {
    type: 'pie',
    data: { labels, datasets: [{ data: values, backgroundColor: colors.slice(0, values.length) }] },
    options: { responsive:true, plugins:{ legend:{display:false}, datalabels:{ color:'#fff', font:{weight:'bold',size:13}, formatter:(v)=> v+'%' } } },
    plugins: [ChartDataLabels]
  });

  // Légende
  const legend = document.getElementById('chartLegend');
  legend.innerHTML = '';
  s.donut.forEach((d,i)=>{
    const item = document.createElement('div');
    item.className = 'legend-item';
   // item.innerHTML = `<span class="legend-dot" style="background-color:${colors[i]}"></span>${d.label} — ${d.value}%`;
    item.innerHTML = `<span class="legend-dot" style="background-color:${colors[i]}"></span>${d.label}`;
    legend.appendChild(item);
  });

  // change year
  const select = document.querySelector('.graph-select');
  if (select && !select.dataset.bound) {
    select.addEventListener('change', () => loadManifestationStats(select.value));
    select.dataset.bound = '1';
  }
}

/* ==========  B. BLOC MEDIA (carousel + grid)  ========== */
function initCarousel(slidesSel, dotsSel) {
  const slides = document.querySelectorAll(slidesSel+' .slide');
  const dots   = document.querySelector(dotsSel);
  if (!slides.length || !dots) return;

  dots.innerHTML = '';
  slides.forEach((_,i)=>{
    const dot = document.createElement('span');
    dot.addEventListener('click', ()=> show(i));
    dots.appendChild(dot);
  });

  let i = 0;
  function show(k){
    slides.forEach(s=>s.classList.remove('active'));
    dots.querySelectorAll('span').forEach(d=>d.classList.remove('active'));
    slides[k].classList.add('active');
    dots.children[k].classList.add('active');
    i = k;
  }
  function next(){ i = (i+1) % slides.length; show(i); }
  show(0);
  setInterval(next, 5000);
}
/*
async function loadManifestationMedia(){
  const data = await apiGET('/manifestation/media');

  // Carousel actus
  const container = document.getElementById('utm-carousel');
  if (container && data.actus) {
    container.innerHTML = data.actus.map((a,idx)=>`
      <div class="slide ${idx===0?'active':''}">
        <img src="${a.cover || '/wp-content/plugins/plateforme-master/imagesED/Groupe 1932.png'}" alt="${a.title||''}">
        <div class="video-play">▶</div>
        <div class="caption">${a.title||''}</div>
      </div>
    `).join('');
    initCarousel('#utm-carousel','#utm-dots');
  }

  // Grille photos
  const grid = document.querySelector('.card-manif .photo-grid');
  if (grid && data.photos) {
    grid.innerHTML = `
      <div class="grid-full"><img src="${data.photos[0]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 417.png'}" alt=""></div>
      <div class="grid-half"><img src="${data.photos[1]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 419.png'}" alt=""></div>
      <div class="grid-half"><img src="${data.photos[2]?.image_url || '/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 461.png'}" alt=""></div>
    `;
  }
}
*/
async function loadNewsCards() {
  try {
    const data = await apiGET('/manifestation', { per_page: 10 }); // limite ajustable
    const container = document.querySelector('.news-card-container');

    if (container) {
      container.innerHTML = data.map(m => `
        <div class="news-card">
          <div class="card-header">
            <span class="category-tag">${m.categorie || 'Sans catégorie'}</span>
            <span class="news-date">${m.date_debut ? new Date(m.date_debut).toLocaleDateString('fr-FR') : ''}</span>
          </div>
          <div class="card-body">
            <h2 class="news-title">${m.intitule || ''}</h2>
            <p class="news-description">
              ${m.texte ? m.texte.substring(0,180)+'…' : 'Pas de description.'}
            </p>
            <a href="/manifestation-details-utm/?id=${m.id}" class="read-more-link">Lire La Suite</a>
          </div>
        </div>
      `).join('');
    }
  } catch (err) {
    console.error('Erreur chargement manifestations', err);
  }
}

document.addEventListener('DOMContentLoaded', loadNewsCards);

/* ==========  C. Modal d’ajout : POST manifestation + upload images  ========== */
async function postManifestationFromModal(){
  const btn = document.getElementById('btnSaveObjectifs');
  if (btn) {
    btn.disabled = true;
    btn.textContent = 'En cours...';
  }

  const catSel   = document.getElementById('categorie');
  const titre    = document.getElementById('titre').value.trim();
  const quill    = window.quillSpecifique;
  const texte    = quill ? quill.root.innerHTML : '';

  const dateDebut= document.getElementById('date_debut').value;
  const dateFin  = document.getElementById('date_fin').value;

  const fd = new FormData();
  fd.append('intitule', titre);
  fd.append('categorie_id', catSel?.value || '');
  fd.append('texte', texte);
  fd.append('statut', 'publie');
  fd.append('date', new Date().toISOString().slice(0,10));
  if (dateDebut) fd.append('date_debut', dateDebut);
  if (dateFin)   fd.append('date_fin', dateFin);

  // Images
  const fileInput = document.getElementById('file-upload-input');
  if (fileInput.files.length > 0) {
    for (let i = 0; i < fileInput.files.length; i++) {
      fd.append('files[]', fileInput.files[i]);
    }
  }

  try {
    const res = await fetch(`${REST_NS}/manifestation`, {
      method: 'POST',
      headers: { 'X-WP-Nonce': PMSettings?.nonce || '' },
      body: fd
    });
    if (!res.ok) throw new Error('Erreur enregistrement');

    await loadManifestationStats();
    await loadNewsCards();
    filterNews(); 

    // Fermer et reset
    resetManifestationForm();
    closeModalObjectifs();
  } catch (err) {
    alert(err.message || 'Erreur enregistrement');
  } finally {
    if (btn) {
      btn.disabled = false;
      btn.textContent = 'Enregistrer';
    }
  }
}

// Fonction de reset formulaire
function resetManifestationForm() {
  document.getElementById('titre').value = '';
  document.getElementById('categorie').selectedIndex = 0;
  document.getElementById('date_debut').value = '';
  document.getElementById('date_fin').value = '';
  document.getElementById('file-upload-input').value = '';
  const fileText = document.querySelector('.input-file-text');
  if (fileText) fileText.value = 'Aucun fichier choisi';
  if (window.quillSpecifique) window.quillSpecifique.setContents([]);
}



/* ==========  D. Boot  ========== */
document.addEventListener('DOMContentLoaded', () => {
  loadManifestationStats();
  //loadManifestationMedia();

  // Bouton "Enregistrer" du modal
  const btn = document.getElementById('btnSaveObjectifs');
  if (btn && !btn.dataset.bound){
    btn.addEventListener('click', postManifestationFromModal);
    btn.dataset.bound = '1';
  }
});
</script>
