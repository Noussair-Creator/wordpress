<?php if (!defined('ABSPATH')) exit; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier une publication</title>

<style>
  body{background:#f0f0f0;font-family:'Inter',sans-serif}
  .form-container{background:#FAFAF8;border:1px solid #e0e0e0;border-radius:8px;padding:0 30px;box-shadow:0 4px 12px rgba(0,0,0,.05)}
  .bg{background:#fff;box-shadow:0 8px 12px -9px #3333;margin:0 -30px 10px}
  .bg:first-child{border-top-right-radius:8px;border-top-left-radius:8px}
  .bg-reverse{padding:1px 30px;background:#fff;box-shadow:0 -10px 12px -9px #3333;margin:30px -30px 0;border-bottom-right-radius:8px;border-bottom-left-radius:8px}
  h2{font-size:1.25rem;font-weight:700;margin:0 20px;padding:20px 0;color:#333;border:hidden}
  #h2top{margin-top:40px}
  .form-label{font-weight:500;color:#6E6D55;margin-bottom:.5rem}
  .form-control,.form-select{border-radius:6px;border:1px solid #DBD9C3;padding:10px;background:#fff}
  .file-import-section{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;padding-left:12px;background:#fff}
  .file-import-section input[type="text"]{border:none;box-shadow:none;flex-grow:1}
  .btn-import{background:#A6A485;color:#fff;border:1px solid #DBD9C3;border-top-left-radius:0;border-bottom-left-radius:0;font-weight:500;padding:10px 16px;cursor:pointer}
  .file-list{list-style:none;padding:0;margin-top:15px}
  .file-list-item{display:flex;align-items:center;padding:8px 0;font-size:.9rem;color:#333;gap:20px;margin-bottom:10px}
  .file-list-item .btn-remove-file{background:#dc3545;border:none;color:#fff;cursor:pointer;font-size:20px;padding:10px;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center}
  .icon-file{width:20px;height:20px;background:url('/wp-content/plugins/plateforme-master/images/icons/upload-red.png') center/contain no-repeat;display:inline-block}

  .form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:30px}
  .btn-draft{background:transparent;border:1px solid #c0392b;color:#c0392b;font-weight:500;padding:10px 16px;border-radius:6px;cursor:pointer}
  .btn-draft:hover{background:#c0392b;color:#fff}
  .btn-submit{background:#c0392b;border:1px solid #c0392b;color:#fff;font-weight:500;padding:10px 16px;border-radius:6px;cursor:pointer}
  .btn-submit:hover{background:#a93226;border-color:#a93226}

  /* Chips (mots clés) */
  .pill-input{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;height:42px;padding:0 10px;gap:8px;background:#fff}
  .pill-input input{flex:1;border:none;outline:none;height:100%;font-size:14px;background:transparent}
  .chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}
  .chip{display:inline-flex;align-items:center;gap:6px;padding:8px 12px;background:#BF0404;border-radius:999px;font-weight:600;font-size:13px;color:#fff}
  .chip .x{width:16px;height:16px;cursor:pointer;display:inline-block;background:url('/wp-content/plugins/plateforme-master/images/27)%20Icon-close-circle.png') center/16px 16px no-repeat;filter:brightness(200%)}

  /* Checkboxes rouges */
  .form-check-input{width:18px;height:18px;vertical-align:middle;margin-right:6px}
  .form-check-input:checked{background-color:#b60303;border-color:#b60303}
  .form-check-input:focus{border-color:#b60303;box-shadow:0 0 0 .25rem rgba(182,3,3,.25)}

  /* Select de partage */
  .muted{color:#6E6D55; font-size:.9rem}
  .toggle-line{display:flex;align-items:center;gap:10px}

  /* Dropdown (combo) */
  .combo{ position:relative; width:100%; }
  .combo input{
    width:100%; height:42px; border:1px solid #DBD9C3; border-radius:6px;
    padding:10px; outline:none; background:#fff; font-size:14px;
  }
  .combo input:focus{ box-shadow:0 0 0 .2rem rgba(166,164,133,.2); border-color:#A6A485; }
  .combo-menu{
    position:absolute; top:100%; left:0; right:0; z-index:9999;
    background:#fff; border:1px solid #DBD9C3; border-radius:8px;
    margin-top:6px; box-shadow:0 8px 20px -10px rgba(0,0,0,.25);
    max-height:260px; overflow:auto; display:none;
  }
  .combo-item{ padding:10px 12px; cursor:pointer; font-size:14px; line-height:1.2; display:flex; align-items:center; gap:8px; }
  .combo-item:hover{ background:#F7F6F1; }
  .combo-item.active{ background:#EDEBDB; }
  .combo-item.empty{ color:#6E6D55; cursor:default; }

  /* Bandeau état */
  .banner{margin:12px 0 0 0; font-size:.95rem}
  .banner.ok{color:#198754}
  .banner.err{color:#b60303}
  .banner.warn{color:#856404}

  /* Arrow "corner-right-up" icon */
.icon-corner-up{
  display:inline-block;
  width:16px; height:16px;
  background:url('/wp-content/plugins/plateforme-master/images/27%29%20Icon-corner-right-up.png') center/16px 16px no-repeat;
  filter:brightness(200%);           /* match your white-ish icon look */
  transition:transform .15s ease;    /* small motion on hover */
}

/* Nice micro-interaction when hovering the button */
.pill-input .add:hover .icon-corner-up{
  transform: translate(1px,-1px) rotate(25deg);
}

/* If you want the add button itself to look clean */
.pill-input .add{
  border:none; background:transparent; cursor:pointer;
  display:inline-flex; align-items:center; justify-content:center;
  width:28px; height:28px; padding:0;
}

</style>

<div class="form-container">
  <div class="bg"><h2>Informations générales</h2></div>

  <div id="banner" class="banner"></div>

  <div class="row g-3" style="display:grid;grid-template-columns:repeat(12,1fr);gap:12px">
    <div class="col-md-12" style="grid-column:span 6">
      <label for="publicationType" class="form-label">Type de publication :</label>
      <select class="form-select" id="publicationType" required>
        <option selected disabled value=""></option>
        <option value="Article">Article</option>
        <option value="Rapport">Rapport</option>
        <option value="Présentation">Présentation</option>
        <option value="Conférence">Conférence</option>
      </select>
    </div>

    <div class="col-md-12" style="grid-column:span 6">
      <label for="submissionDate" class="form-label">Date de soumission :</label>
      <div class="input-group">
        <input type="date" class="form-control" id="submissionDate" required>
      </div>
    </div>

    <div class="col-md-12" style="grid-column:span 6">
      <label for="doi" class="form-label">DOI (Digital Object Identifier) :</label>
      <input type="text" class="form-control" id="doi" placeholder="10.xxxx/xxxx">
    </div>

    <div class="col-md-12" style="grid-column:span 6">
      <label for="pages" class="form-label">Nombre des pages :</label>
      <input type="number" min="0" class="form-control" id="pages" placeholder="0">
    </div>

    <div class="col-12" style="grid-column:span 12">
      <label for="completeTitle" class="form-label">Titre complet :</label>
      <input type="text" class="form-control" id="completeTitle" required>
    </div>

    <div class="col-12" style="grid-column:span 12">
      <label for="maisonEdition" class="form-label">Maison d'édition scientifique :</label>
      <input type="text" class="form-control" id="maisonEdition" placeholder="Ex. Elsevier, Springer, Wiley...">
    </div>

    <div class="col-12" style="grid-column:span 12">
      <label for="summary" class="form-label">Résumé</label>
      <textarea class="form-control" id="summary" rows="4"></textarea>
    </div>

    <!-- Mots clés (union des parts ; éditables ici si besoin) -->
    <div class="col-12" style="grid-column:span 12">
      <label class="form-label" for="keywordInput">Mots clés (optionnel – s’appliquera aux parts)</label>
      <div class="pill-input">
        <input type="text" id="keywordInput" placeholder="Ajouter un mot clé (ex. AI)" autocomplete="off" autocapitalize="off" spellcheck="false">
        <button class="add" id="keywordAdd" type="button" title="Ajouter">
  <span class="icon-corner-up" aria-hidden="true"></span>
</button>

      </div>
      <div class="chips" id="keywordChips"></div>
    </div>
  </div>

  <div class="bg"><h2 id="h2top">Documents associés</h2></div>
  <label for="fileImport" class="form-label">Pièces jointes (optionnel)</label>
  <div class="file-import-section">
    <input type="text" class="form-control" id="fileImport" placeholder="Importer" autocomplete="off" autocapitalize="off" spellcheck="false">
    <button class="btn btn-import" type="button" id="importButton">Importer</button>
    <input type="file" id="fileInput" multiple style="display:none" accept=".pdf,.doc,.docx,.ppt,.pptx">
  </div>
  <ul class="file-list" id="fileList"></ul>

  <div class="bg"><h2 id="h2top">Partager l'article</h2></div>
  <div id="shareWrapper" style="display:none">
    <div class="toggle-line">
      <input type="checkbox" id="shareToggle" class="form-check-input">
      <label for="shareToggle" class="form-label" style="margin:0">Partager l’article avec d’autres chercheurs</label>
    </div>

    <div id="shareBox" style="display:none; margin-top:12px">
      <label class="form-label" for="shareSearch">Chercheurs & directeurs :</label>
      <div class="combo">
        <input type="text" id="shareSearch" placeholder="Sélectionner un membre..." autocomplete="off" autocapitalize="off" spellcheck="false">
        <div id="shareMenu" class="combo-menu"></div>
      </div>
      <div class="chips" id="shareChips" style="margin-top:10px"></div>
    </div>
  </div>

  <div class="bg"><h2 id="h2top">Commentaire complémentaire (optionnel)</h2></div>
  <div class="col-12" style="padding: 0 0 10px">
    <label for="comment" class="form-label">Commentaire</label>
    <textarea class="form-control" id="comment" rows="3" placeholder="Commentaire..."></textarea>
  </div>

  <div class="bg-reverse">
    <div class="form-actions">
      <button type="button" class="btn btn-draft" id="btnDraft" disabled>Brouillon</button>
      <button type="button" class="btn btn-submit" id="btnSubmit">Enregistrer</button>
    </div>
    <div class="mt-2 small text-muted" id="formHint"></div>
  </div>
</div>

<?php if ( is_user_logged_in() ) : ?>
<script>
  window.PMSettings = Object.assign({}, window.PMSettings, {
    restUrl: <?php echo wp_json_encode( esc_url_raw( rest_url() ) ); ?>,
    nonce:   <?php echo wp_json_encode( wp_create_nonce('wp_rest') ); ?>,
    roles:   <?php echo wp_json_encode( (array) wp_get_current_user()->roles ); ?>,
    userId:  <?php echo (int) get_current_user_id(); ?>,
    modifierPartageUrl: '/modifier-partage'
  });
</script>
<?php endif; ?>

<script>
(function(){
  /* ====== REST config ====== */
  const REST_ROOT  = (window.PMSettings?.restUrl || window.wpApiSettings?.root || '/wp-json/').replace(/\/$/,'');
  const REST_NONCE = (window.PMSettings?.nonce   || window.wpApiSettings?.nonce || '');
  const API_BASE   = REST_ROOT + '/plateforme-recherche/v1';

  /* ====== DOM ====== */
  const banner      = document.getElementById('banner');
  const btnSubmit   = document.getElementById('btnSubmit');
  const hint        = document.getElementById('formHint');

  const elType      = document.getElementById('publicationType');
  const elDate      = document.getElementById('submissionDate');
  const elTitre     = document.getElementById('completeTitle');
  const elResume    = document.getElementById('summary');
  const elDoi       = document.getElementById('doi');
  const elPages     = document.getElementById('pages');
  const elMaison    = document.getElementById('maisonEdition');
  const elComm      = document.getElementById('comment');

  /* ====== QueryString ====== */
  const qs = new URLSearchParams(location.search);
  const pubId = qs.get('id') || qs.get('publication_id');
  if (!pubId){ setBanner('ID manquant (?id=...)', 'err'); return; }

  /* ====== State ====== */
  let keywords = [];                 // union des mots-clés de toutes les parts
  let shareUserIds = [];             // destinataires sélectionnés (courant)
  let initialShareUserIds = [];      // destinataires **au chargement**
  let labelsById = {};               // { userId: "Nom <email>" }
  let allEligible = null;            // [{id,label}]
  let lastResults = [];              // résultats affichés dans le menu
  let highlighted = -1;              // index survolé dans le menu
  let filesToDelete = [];            // IDs des fichiers existants à supprimer

  /* ====== helpers ====== */
  function setBanner(msg, cls){ if (!banner) return; banner.textContent = msg||''; banner.className = 'banner ' + (cls||''); }
  function setHint(msg, ok=false){ hint.textContent = msg || ''; hint.className = 'mt-2 small ' + (ok ? 'text-success' : 'text-danger'); }

  async function jfetch(url, opt={}){
    const r = await fetch(url, {
      credentials:'same-origin',
      headers:{ 'Accept':'application/json', ...(REST_NONCE?{'X-WP-Nonce':REST_NONCE}:{}) },
      ...opt
    });
    if (!r.ok) {
      let m = 'HTTP '+r.status; try { const j = await r.json(); if (j?.message) m = j.message; } catch {}
      const e = new Error(m); e.status = r.status; throw e;
    }
    return r.json();
  }

  function arraysEqualAsSets(a, b){
    const A = (a||[]).map(Number).sort((x,y)=>x-y);
    const B = (b||[]).map(Number).sort((x,y)=>x-y);
    if (A.length !== B.length) return false;
    for (let i=0;i<A.length;i++){ if (A[i]!==B[i]) return false; }
    return true;
  }

  /* ====== Partage (UI) ====== */
  const shareWrapper = document.getElementById('shareWrapper');
  const shareToggle  = document.getElementById('shareToggle');
  const shareBox     = document.getElementById('shareBox');
  const shareSearch  = document.getElementById('shareSearch');
  const shareMenu    = document.getElementById('shareMenu');
  const shareChips   = document.getElementById('shareChips');

  function showShareIfArticle(){
    const isArticle = (elType.value === 'Article');
    shareWrapper.style.display = isArticle ? 'block' : 'none';
    if (!isArticle){
      shareToggle.checked = false; shareBox.style.display='none';
      shareUserIds = []; renderShareChips();
    }
  }
  elType.addEventListener('change', showShareIfArticle);
  shareToggle.addEventListener('change', ()=>{ shareBox.style.display = shareToggle.checked ? 'block' : 'none'; });

  function renderShareChips(){
    shareChips.innerHTML = '';
    shareUserIds.forEach((id,idx)=>{
      const label = labelsById[id]
        || (allEligible || []).find(r=>r.id===id)?.label
        || ('Utilisateur #'+id);
      const el = document.createElement('div');
      el.className = 'chip';
      el.innerHTML = `<span>${label}</span><span class="x" data-i="${idx}" title="Retirer"></span>`;
      shareChips.appendChild(el);
    });
  }
  shareChips.addEventListener('click', e=>{
    const i = e.target?.dataset?.i;
    if (typeof i !== 'undefined'){ shareUserIds.splice(Number(i),1); renderShareChips(); }
  });

  async function fetchEligibleUsers(q=''){
    const url = `${API_BASE}/publication/eligible-users?search=${encodeURIComponent(q)}`;
    const r = await fetch(url, { headers:{'X-WP-Nonce':REST_NONCE,'Accept':'application/json'}, credentials:'same-origin' });
    if (!r.ok) return []; return r.json(); // [{id,label}]
  }
  async function ensureEligibleLoaded(){ if (!allEligible) allEligible = await fetchEligibleUsers(''); return allEligible; }

  function renderMenu(items){
    if (!items || !items.length){ shareMenu.innerHTML = `<div class="combo-item empty">Aucun résultat</div>`; highlighted=-1; return; }
    shareMenu.innerHTML = items.map((it, idx) =>
      `<div class="combo-item${idx===highlighted?' active':''}" data-idx="${idx}" data-id="${it.id}">${it.label}</div>`
    ).join('');
  }
  function openMenu(items){ renderMenu(items); shareMenu.style.display='block'; }
  function closeMenu(){ shareMenu.style.display='none'; highlighted=-1; }
  function ensureVisible(idx){
    const el = shareMenu.querySelector(`.combo-item[data-idx="${idx}"]`); if (!el) return;
    const mR = shareMenu.getBoundingClientRect(), eR = el.getBoundingClientRect();
    if (eR.top < mR.top) shareMenu.scrollTop += (eR.top - mR.top) - 8;
    else if (eR.bottom > mR.bottom) shareMenu.scrollTop += (eR.bottom - mR.bottom) + 8;
  }
  function selectByIndex(idx){
    const it = lastResults[idx]; if (!it) return;
    if (!shareUserIds.includes(it.id)) { shareUserIds.push(it.id); renderShareChips(); }
    shareSearch.value=''; closeMenu();
  }
  shareSearch.addEventListener('focus', async ()=>{ const list=await ensureEligibleLoaded(); lastResults=list.slice(); highlighted=lastResults.length?0:-1; openMenu(lastResults); });
  shareSearch.addEventListener('click', async ()=>{ const list=await ensureEligibleLoaded(); lastResults=list.slice(); highlighted=lastResults.length?0:-1; openMenu(lastResults); });
  shareSearch.addEventListener('input', async ()=>{ const q=shareSearch.value.trim().toLowerCase(); const list=await ensureEligibleLoaded(); lastResults=q?list.filter(u=>u.label.toLowerCase().includes(q)):list.slice(); highlighted=lastResults.length?0:-1; openMenu(lastResults); });
  shareSearch.addEventListener('keydown', (e)=>{
    if (shareMenu.style.display!=='block') return;
    if (e.key==='ArrowDown'){ e.preventDefault(); if (!lastResults.length) return; highlighted=(highlighted+1)%lastResults.length; renderMenu(lastResults); ensureVisible(highlighted); }
    else if (e.key==='ArrowUp'){ e.preventDefault(); if (!lastResults.length) return; highlighted=(highlighted-1+lastResults.length)%lastResults.length; renderMenu(lastResults); ensureVisible(highlighted); }
    else if (e.key==='Enter'){ e.preventDefault(); if (highlighted>=0) selectByIndex(highlighted); }
    else if (e.key==='Escape'){ e.preventDefault(); closeMenu(); }
  });
  shareMenu.addEventListener('click', (e)=>{
    const item = e.target.closest('.combo-item'); if (!item || item.classList.contains('empty')) return;
    const idx = parseInt(item.dataset.idx,10); selectByIndex(idx);
  });
  document.addEventListener('click', (e)=>{ if (!shareBox.contains(e.target)) closeMenu(); });

  /* ====== Mots-clés (chips) ====== */
  const kwInput = document.getElementById('keywordInput');
  const kwAdd   = document.getElementById('keywordAdd');
  const kwWrap  = document.getElementById('keywordChips');
  function renderKeywords(){
    kwWrap.innerHTML = '';
    keywords.forEach((k,i)=>{
      const el = document.createElement('div');
      el.className = 'chip';
      el.innerHTML = `<span>${k}</span><span class="x" data-i="${i}" title="Retirer"></span>`;
      kwWrap.appendChild(el);
    });
  }
  function addKeyword(){
    const v = (kwInput.value||'').trim();
    if (!v) return;
    if (!keywords.includes(v)) keywords.push(v);
    kwInput.value = ''; renderKeywords();
  }
  kwAdd.addEventListener('click', addKeyword);
  kwInput.addEventListener('keydown', e=>{ if (e.key==='Enter'){ e.preventDefault(); addKeyword(); }});
  kwWrap.addEventListener('click', e=>{
    const i = e.target?.dataset?.i;
    if (typeof i !== 'undefined'){ keywords.splice(Number(i),1); renderKeywords(); }
  });

  /* ====== Fichiers ====== */
  const importButton   = document.getElementById('importButton');
  const fileInput      = document.getElementById('fileInput');
  const fileList       = document.getElementById('fileList');
  const fileImportText = document.getElementById('fileImport');

  // Nouveaux fichiers : li._file = File ; Fichiers existants : li.dataset.fileId = "123"
  function addFileToList(file){
    if ([...fileList.querySelectorAll('.file-list-item')].some(li => li.dataset.filename === file.name)) return;
    const li = document.createElement('li');
    li.className = 'file-list-item';
    li.dataset.filename = file.name;
    li._file = file; // marque comme "nouveau" pour upload
    li.innerHTML = `
      <span class="icon-file" aria-hidden="true"></span>
      <span>${file.name}</span>
      <button class="btn-remove-file" title="Retirer">×</button>
    `;
    fileList.appendChild(li);
  }
  importButton.addEventListener('click', () => fileInput.click());
  fileImportText.addEventListener('click', () => fileInput.click());
  fileInput.addEventListener('change', (e)=>{
    const files = e.target.files;
    for (const f of files) addFileToList(f);
    fileInput.value = '';
  });

  // Suppression (event delegation) -> push l'ID si existant
  fileList.addEventListener('click', (e)=>{
    const btn = e.target.closest('.btn-remove-file');
    if (!btn) return;
    const li = btn.closest('.file-list-item');
    if (!li) return;

    const id = li.dataset.fileId ? parseInt(li.dataset.fileId, 10) : 0;
    if (id && !filesToDelete.includes(id)) filesToDelete.push(id);

    // si li._file existe, c'est un fichier "nouveau" -> retiré de l'UI donc il ne sera pas uploadé
    li.remove();
  });

  // Uploader les **nouveaux** fichiers et renvoyer [{original_name, storage_path}]
  async function uploadAllFilesIfAny(){
    const items = [...document.querySelectorAll('#fileList .file-list-item')];
    if (!items.length) return [];
    const out = [];
    for (const li of items) {
      const f = li._file; // seulement les nouveaux
      if (!f) continue;
      const fd = new FormData();
      fd.append('file', f, f.name);
      const resp = await fetch(REST_ROOT + '/wp/v2/media', {
        method: 'POST',
        headers: REST_NONCE ? { 'X-WP-Nonce': REST_NONCE } : {},
        body: fd,
        credentials: 'same-origin'
      });
      if (!resp.ok) {
        let t = 'Upload échoué'; try { const j = await resp.json(); t = j?.message || t; } catch {}
        throw new Error(t);
      }
      const media = await resp.json();
      out.push({ original_name: f.name, storage_path: media?.source_url || '' });
    }
    return out;
  }

  /* ====== Chargement ====== */
  async function load(){
    try{
      setBanner('Chargement…');

      // Publication
      let p = await jfetch(`${API_BASE}/publication/${pubId}`);
      if (p && p.publication) p = p.publication; // sécurité si mauvaise route

      // Redirection si ce n’est PAS ma publication
      const me = Number(window.PMSettings?.userId || 0);
      if (me && Number(p.created_by) !== me) {
        setBanner('Cette publication ne vous appartient pas. Ouverture du formulaire “partage”…', 'warn');
        location.replace((window.PMSettings?.modifierPartageUrl || '/modifier-partage') + `?id=${encodeURIComponent(pubId)}`);
        return;
      }

      // Pré-remplissage publication
      elType.value   = p.type || '';
      elDate.value   = p.date_publication || '';
      elDoi.value    = p.doi || '';
      elPages.value  = (p.nb_pages ?? '') === null ? '' : (p.nb_pages ?? '');
      elTitre.value  = p.titre || '';
      elMaison.value = p.maison_edition_scientifique || '';
      elResume.value = p.resume || '';
      elComm.value   = p.commentaire || '';

      // Partages existants
      try {
        const shares = await jfetch(`${API_BASE}/publication/${pubId}/shares`);

        // destinataires + labels
        labelsById = {};
        shareUserIds = shares.map(s => {
          const uid = Number(s.user_id);
          labelsById[uid] = s.label || s.display_name || ('Utilisateur #'+uid);
          return uid;
        });
        initialShareUserIds = shareUserIds.slice(); // snapshot de départ

        // mots-clés (union)
        const unionKw = new Set();
        shares.forEach(s => (Array.isArray(s.keywords) ? s.keywords : []).forEach(k => unionKw.add(String(k))));
        keywords = Array.from(unionKw);

        // fichiers existants (affichage) — marquer l'ID pour pouvoir supprimer précisément
        fileList.innerHTML = '';
        shares.forEach(s => {
          (Array.isArray(s.files) ? s.files : []).forEach(f => {
            const li = document.createElement('li');
            li.className = 'file-list-item';
            li.dataset.filename = f.original_name || '';
            if (f.id) li.dataset.fileId = String(f.id);  // <— important
            // pas de li._file -> pas de reupload
            li.innerHTML = `
              <span class="icon-file" aria-hidden="true"></span>
              <span>
                ${f.original_name ? f.original_name : 'Fichier'}
                ${f.storage_path ? ` – <a href="${f.storage_path}" target="_blank" rel="noopener">télécharger</a>` : ''}
              </span>
              <button class="btn-remove-file" title="Retirer">×</button>
            `;
            fileList.appendChild(li);
          });
        });

        // afficher la zone Partager si c'est un Article et qu'il y a déjà des destinataires
        if (elType.value === 'Article' && shareUserIds.length) {
          shareWrapper.style.display = 'block';
          shareToggle.checked = true;
          shareBox.style.display = 'block';
        }

        await ensureEligibleLoaded();
        renderShareChips();
        renderKeywords();
      } catch(e) {
        console.warn('shares load failed:', e);
      }

      // Afficher/masquer la section Partager en fonction du type
      showShareIfArticle();

      setBanner('');
    }catch(err){
      console.error(err);
      setBanner('Erreur de chargement : ' + (err.message||''), 'err');
    }
  }

  /* ====== Enregistrement ====== */
  let saving = false;
  btnSubmit.addEventListener('click', async ()=>{
    if (saving) return;
    saving = true;
    try{
      setHint('Enregistrement…');
      btnSubmit.disabled = true;

      // 1) données publication
      const payload = {
        type:                        elType.value || '',
        date_publication:            elDate.value || '',
        doi:                         elDoi.value.trim() || '',
        nb_pages:                    (parseInt(elPages.value||'0',10) || null),
        titre:                       elTitre.value.trim() || '',
        maison_edition_scientifique: elMaison.value.trim() || '',
        resume:                      elResume.value || '',
        commentaire:                 elComm.value || ''
      };

      // 2) partage (si Article)
      if (elType.value === 'Article') {
        // uploader les nouveaux fichiers
        let share_files = [];
        try { share_files = await uploadAllFilesIfAny(); } catch(e){ console.warn(e); }

        // n'envoyer share_with_user_ids QUE SI la liste a changé
        if (!arraysEqualAsSets(shareUserIds, initialShareUserIds)) {
          payload.share_with_user_ids = shareUserIds.slice();
        }

        // remplacer/mettre à jour les mots-clés des parts si fournis
        if (keywords.length)   payload.share_keywords = keywords.slice();

        // ajouter les nouveaux fichiers aux parts
        if (share_files.length) payload.share_files = share_files;

        // supprimer les fichiers existants retirés dans l'UI (précisément ceux-là)
        if (filesToDelete.length) payload.share_file_ids_delete = filesToDelete.slice();
      }

      // 3) PUT
      await jfetch(`${API_BASE}/publication/${pubId}`, {
        method:'PUT',
        headers:{ 'Content-Type':'application/json', ...(REST_NONCE?{'X-WP-Nonce':REST_NONCE}:{}) },
        body: JSON.stringify(payload)
      });

      // succès : remettre à zéro le “panier” de suppression et snapshot des destinataires
      filesToDelete = [];
      initialShareUserIds = shareUserIds.slice();

      setHint('Enregistré ✔', true);
    }catch(err){
      console.error(err);
      setHint('Erreur : ' + (err.message||''));
    }finally{
      btnSubmit.disabled = false;
      saving = false;
    }
  });

  /* ====== go ====== */
  load();
})();
</script>

