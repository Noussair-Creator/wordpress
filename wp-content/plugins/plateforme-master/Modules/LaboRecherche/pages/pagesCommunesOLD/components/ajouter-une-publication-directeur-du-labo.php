<?php if (!defined('ABSPATH')) exit; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter une publication</title>

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

  /* Dropdown (combo) */
  .combo{ position:relative; width:100%; }
  .combo input{ width:100%; height:42px; border:1px solid #DBD9C3; border-radius:6px; padding:10px; outline:none; background:#fff; font-size:14px; }
  .combo input:focus{ box-shadow:0 0 0 .2rem rgba(166,164,133,.2); border-color:#A6A485; }
  .combo-menu{ position:absolute; top:100%; left:0; right:0; z-index:9999; background:#fff; border:1px solid #DBD9C3; border-radius:8px; margin-top:6px; box-shadow:0 8px 20px -10px rgba(0,0,0,.25); max-height:260px; overflow:auto; display:none; }
  .combo-item{ padding:10px 12px; cursor:pointer; font-size:14px; line-height:1.2; display:flex; align-items:center; gap:8px; }
  .combo-item:hover{ background:#F7F6F1; }
  .combo-item.active{ background:#EDEBDB; }
  .combo-item.empty{ color:#6E6D55; cursor:default; }

  .pill-input .add:hover .icon-corner-up{ transform: translate(1px,-1px) rotate(25deg); }
  .pill-input .add{ border:none; background:transparent; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; padding:0; }

  /* Erreur DOI locale */
  .error-text{ color:#b60303; font-size:.85rem; margin-top:6px; }
  .is-invalid{ border-color:#b60303 !important; }
</style>

<div class="form-container">
  <div class="bg"><h2>Informations générales</h2></div>

  <div class="row g-3">
    <div class="col-md-6">
      <label for="publicationType" class="form-label">Type de publication :</label>
      <select class="form-select" id="publicationType" required>
        <option selected disabled value=""></option>
        <option value="Article">Article</option>
        <option value="Rapport">Rapport</option>
        <option value="Présentation">Présentation</option>
        <option value="Conférence">Conférence</option>
      </select>
    </div>

    <div class="col-md-6">
      <label for="submissionDate" class="form-label">Date de soumission :</label>
      <div class="input-group">
        <input type="date" class="form-control" id="submissionDate" required>
      </div>
    </div>

    <!-- Groupe DOI (affiché uniquement si Article) -->
    <div class="col-md-6" id="doiGroup" style="display:none">
      <label for="doi" class="form-label">DOI (Digital Object Identifier) :</label>
      <input type="text"
             class="form-control"
             id="doi"
             placeholder="10.xxxx/xxxx"
             pattern="^10\.\d{4,9}/[-._;()/:A-Z0-9]+$"
             title="Le DOI doit commencer par '10.' suivi d’un identifiant, ex: 10.1234/abcd1234">
      <div id="doiError" class="error-text" style="display:none"></div>
    </div>

    <!-- Groupe Nb pages (affiché uniquement si Article) -->
    <div class="col-md-6" id="pagesGroup" style="display:none">
      <label for="pages" class="form-label">Nombre des pages :</label>
      <input type="number" min="0" class="form-control" id="pages" placeholder="0">
    </div>

    <div class="col-12">
      <label for="completeTitle" class="form-label">Titre complet :</label>
      <input type="text" class="form-control" id="completeTitle" required>
    </div>

    <div class="col-12">
      <label for="englishTitle" class="form-label">Title :</label>
      <input type="text" class="form-control" id="englishTitle" placeholder="">
    </div>

    <div class="col-12">
      <label for="maisonEdition" class="form-label">Maison d'édition scientifique :</label>
      <input type="text" class="form-control" id="maisonEdition" placeholder="Ex. Elsevier, Springer, Wiley...">
    </div>

    <div class="col-12">
      <label for="summary" class="form-label">Résumé</label>
      <textarea class="form-control" id="summary" rows="4"></textarea>
    </div>

    <div class="col-12">
      <label for="englishSummary" class="form-label">Summary :</label>
      <textarea class="form-control" id="englishSummary" rows="4" placeholder=""></textarea>
    </div>

    <!-- Mots clés -->
    <div class="col-12">
      <label class="form-label" for="keywordInput">Mots clés</label>
      <div class="pill-input">
        <input type="text" id="keywordInput" placeholder="Ajouter un mot clé (ex. AI)">
        <button class="add" id="keywordAdd" type="button" title="Ajouter">
          <img src="/wp-content/plugins/plateforme-master/images/27)%20Icon-corner-right-up.png" alt="" width="16" height="16">
        </button>
      </div>
      <div class="chips" id="keywordChips"></div>
    </div>
  </div>

  <div class="bg"><h2 id="h2top">Documents associés</h2></div>
  <label for="fileImport" class="form-label">Pièces jointes</label>
  <div class="file-import-section">
    <input type="text" class="form-control" id="fileImport" placeholder="Importer">
    <button class="btn btn-import" type="button" id="importButton">Importer</button>
    <input type="file" id="fileInput" multiple style="display:none" accept=".pdf,.doc,.docx,.ppt,.pptx">
  </div>
  <ul class="file-list" id="fileList"></ul>

  <!-- Section Partage (titre + contenu) affichée uniquement si Article -->
  <div id="shareSection" style="display:none">
    <div class="bg"><h2 id="h2top">Partager l'article</h2></div>
    <div id="shareWrapper">
      <div class="toggle-line">
        <input type="checkbox" id="shareToggle" class="form-check-input">
        <label for="shareToggle" class="form-label" style="margin:0">Partager l’article avec d’autres chercheurs</label>
      </div>

      <div id="shareBox" style="display:none; margin-top:12px">
        <label class="form-label" for="shareSearch">Chercheurs & directeurs :</label>
        <div class="combo">
          <input type="text" id="shareSearch" placeholder="Sélectionner un membre...">
          <div id="shareMenu" class="combo-menu"></div>
        </div>
        <div class="chips" id="shareChips" style="margin-top:10px"></div>
      </div>
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
      <button type="button" class="btn btn-submit" id="btnSubmit">Soumettre ma demande</button>
    </div>
    <div class="mt-2 small text-muted" id="formHint"></div>
  </div>
</div>

<?php if ( is_user_logged_in() ) : ?>
<script>
  window.PMSettings = Object.assign({}, window.PMSettings, {
    restUrl: <?php echo wp_json_encode( esc_url_raw( rest_url() ) ); ?>,
    nonce:   <?php echo wp_json_encode( wp_create_nonce('wp_rest') ); ?>,
    roles:   <?php echo wp_json_encode( (array) wp_get_current_user()->roles ); ?>
  });
</script>
<?php endif; ?>

<script>
(function(){
  /* ====== REST config ====== */
  const REST_ROOT  = (window.PMSettings?.restUrl || window.wpApiSettings?.root || '/wp-json/').replace(/\/$/,'');
  const REST_NONCE = (window.PMSettings?.nonce   || window.wpApiSettings?.nonce || '');
  const API_BASE   = REST_ROOT + '/plateforme-recherche/v1';
  const LIST_URL   = (window.PMSettings?.publicationsListUrl || '/publication/');

  /* ====== DOM ====== */
  const btnSubmit   = document.getElementById('btnSubmit');
  const hint        = document.getElementById('formHint');

  const elType      = document.getElementById('publicationType');
  const elDate      = document.getElementById('submissionDate');
  const elTitre     = document.getElementById('completeTitle');
  const elResume    = document.getElementById('summary');
  const elDoi       = document.getElementById('doi');
  const elPages     = document.getElementById('pages');
  const elComm      = document.getElementById('comment');
  const elMaison    = document.getElementById('maisonEdition');

  const doiGroup    = document.getElementById('doiGroup');
  const pagesGroup  = document.getElementById('pagesGroup');
  const shareSection= document.getElementById('shareSection');

  const doiError    = document.getElementById('doiError');
  const elTitleEn   = document.getElementById('englishTitle');
  const elSummaryEn = document.getElementById('englishSummary');

  /* ====== Mots clés ====== */
  const kwInput = document.getElementById('keywordInput');
  const kwAdd   = document.getElementById('keywordAdd');
  const kwWrap  = document.getElementById('keywordChips');
  let keywords = [];
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
  kwInput.addEventListener('keydown', e=>{
    if (e.key === 'Enter'){ e.preventDefault(); addKeyword(); }
  });
  kwWrap.addEventListener('click', e=>{
    const i = e.target?.dataset?.i;
    if (typeof i !== 'undefined'){ keywords.splice(Number(i),1); renderKeywords(); }
  });

  /* ====== Fichiers ====== */
  const importButton   = document.getElementById('importButton');
  const fileInput      = document.getElementById('fileInput');
  const fileList       = document.getElementById('fileList');
  const fileImportText = document.getElementById('fileImport');

  function addFileToList(file){
    if ([...fileList.querySelectorAll('.file-list-item')].some(li => li.dataset.filename === file.name)) return;
    const li = document.createElement('li');
    li.className = 'file-list-item';
    li.dataset.filename = file.name;
    li._file = file;
    li.innerHTML = `
      <img src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" style="width:20px" alt="">
      <span>${file.name}</span>
      <button class="btn-remove-file" title="Retirer" onclick="this.parentElement.remove()">×</button>
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

  // Upload WP Media : retourne [{original_name, storage_path}]
  async function uploadAllFilesIfAny(){
    const items = [...document.querySelectorAll('#fileList .file-list-item')];
    if (!items.length) return [];
    const out = [];
    for (const li of items) {
      const f = li._file;
      if (!f) continue;
      const fd = new FormData();
      fd.append('file', f, f.name);
      const resp = await fetch(REST_ROOT + '/wp/v2/media', {
        method: 'POST',
        headers: REST_NONCE ? { 'X-WP-Nonce': REST_NONCE } : {},
        body: fd, credentials: 'same-origin'
      });
      if (!resp.ok) {
        let t = 'Upload échoué'; try { const j = await resp.json(); t = j?.message || t; } catch {}
        throw new Error(t);
      }
      const media = await resp.json();
      out.push({
        original_name: f.name,
        storage_path: media?.source_url || ''
      });
    }
    return out;
  }

  /* ====== Helpers erreur DOI ====== */
  function isValidDOI(doi) {
    const regex = /^10\.\d{4,9}\/[-._;()/:A-Z0-9]+$/i;
    return regex.test((doi||'').trim());
  }
  function setDoiError(msg){
    if (msg){
      doiError.textContent = msg;
      doiError.style.display = 'block';
      elDoi?.classList.add('is-invalid');
    } else {
      doiError.textContent = '';
      doiError.style.display = 'none';
      elDoi?.classList.remove('is-invalid');
    }
  }

  /* ====== Partage ====== */
  const shareToggle  = document.getElementById('shareToggle');
  const shareBox     = document.getElementById('shareBox');
  const shareSearch  = document.getElementById('shareSearch');
  const shareMenu    = document.getElementById('shareMenu');
  const shareChips   = document.getElementById('shareChips');

  let shareUserIds   = [];
  let allEligible    = null;
  let lastResults    = [];
  let highlighted    = -1;

  function showArticleDependent(){
    const isArticle = (elType.value === 'Article');
    doiGroup.style.display      = isArticle ? 'block' : 'none';
    pagesGroup.style.display    = isArticle ? 'block' : 'none';
    shareSection.style.display  = isArticle ? 'block' : 'none';

    if (!isArticle){
      shareToggle.checked = false;
      shareBox.style.display = 'none';
      shareUserIds = [];
      shareChips.innerHTML = '';
      setDoiError('');
    }
  }
  elType.addEventListener('change', showArticleDependent);
  showArticleDependent(); // init

  shareToggle?.addEventListener('change', ()=>{
    shareBox.style.display = shareToggle.checked ? 'block' : 'none';
  });

  function renderShareChips(){
    shareChips.innerHTML = '';
    shareUserIds.forEach((id,idx)=>{
      const found = (allEligible || []).find(r=>r.id===id);
      const label = found?.label || ('Utilisateur #' + id);
      const el = document.createElement('div');
      el.className = 'chip'; el.dataset.type='user';
      el.innerHTML = `<span>${label}</span><span class="x" data-i="${idx}" title="Retirer"></span>`;
      shareChips.appendChild(el);
    });
  }
  shareChips.addEventListener('click', (e)=>{
    const i = e.target?.dataset?.i;
    if (typeof i !== 'undefined'){ shareUserIds.splice(Number(i),1); renderShareChips(); }
  });

  async function fetchEligibleUsers(q=''){
    const url = `${API_BASE}/publication/eligible-users?search=${encodeURIComponent(q)}`;
    const r = await fetch(url, { headers: { 'X-WP-Nonce': REST_NONCE, 'Accept':'application/json' }, credentials:'same-origin' });
    if (!r.ok) return [];
    return r.json();
  }
  async function ensureEligibleLoaded(){
    if (!allEligible) allEligible = await fetchEligibleUsers('');
    return allEligible;
  }

  function renderMenu(items){
    if (!items || !items.length){
      shareMenu.innerHTML = `<div class="combo-item empty">Aucun résultat</div>`;
      highlighted = -1;
      return;
    }
    const html = items.map((it, idx) =>
      `<div class="combo-item${idx===highlighted?' active':''}" data-idx="${idx}" data-id="${it.id}">${it.label}</div>`
    ).join('');
    shareMenu.innerHTML = html;
  }
  function openMenu(items){ renderMenu(items); shareMenu.style.display = 'block'; }
  function closeMenu(){ shareMenu.style.display = 'none'; highlighted = -1; }
  function ensureVisible(idx){
    const el = shareMenu.querySelector(`.combo-item[data-idx="${idx}"]`);
    if (!el) return;
    const menuRect = shareMenu.getBoundingClientRect();
    const elRect   = el.getBoundingClientRect();
    if (elRect.top < menuRect.top) {
      shareMenu.scrollTop += (elRect.top - menuRect.top) - 8;
    } else if (elRect.bottom > menuRect.bottom) {
      shareMenu.scrollTop += (elRect.bottom - menuRect.bottom) + 8;
    }
  }
  function selectByIndex(idx){
    const it = lastResults[idx];
    if (!it) return;
    if (!shareUserIds.includes(it.id)) {
      shareUserIds.push(it.id);
      renderShareChips();
    }
    shareSearch.value = '';
    closeMenu();
  }
  shareSearch?.addEventListener('focus', async ()=>{
    const list = await ensureEligibleLoaded();
    lastResults = list.slice();
    highlighted = lastResults.length ? 0 : -1;
    openMenu(lastResults);
  });
  shareSearch?.addEventListener('click', async ()=>{
    const list = await ensureEligibleLoaded();
    lastResults = list.slice();
    highlighted = lastResults.length ? 0 : -1;
    openMenu(lastResults);
  });
  shareSearch?.addEventListener('input', async ()=>{
    const q = shareSearch.value.trim().toLowerCase();
    const list = await ensureEligibleLoaded();
    lastResults = q ? list.filter(u => u.label.toLowerCase().includes(q)) : list.slice();
    highlighted = lastResults.length ? 0 : -1;
    openMenu(lastResults);
  });
  shareSearch?.addEventListener('keydown', (e)=>{
    if (shareMenu.style.display !== 'block') return;
    if (e.key === 'ArrowDown'){
      e.preventDefault();
      if (!lastResults.length) return;
      highlighted = (highlighted + 1) % lastResults.length;
      renderMenu(lastResults); ensureVisible(highlighted);
    } else if (e.key === 'ArrowUp'){
      e.preventDefault();
      if (!lastResults.length) return;
      highlighted = (highlighted - 1 + lastResults.length) % lastResults.length;
      renderMenu(lastResults); ensureVisible(highlighted);
    } else if (e.key === 'Enter'){
      e.preventDefault();
      if (highlighted >= 0) selectByIndex(highlighted);
    } else if (e.key === 'Escape'){
      e.preventDefault(); closeMenu();
    }
  });
  shareMenu.addEventListener('click', (e)=>{
    const item = e.target.closest('.combo-item');
    if (!item || item.classList.contains('empty')) return;
    const idx = parseInt(item.dataset.idx, 10);
    selectByIndex(idx);
  });
  document.addEventListener('click', (e)=>{ if (!shareSection.contains(e.target)) closeMenu(); });

  /* ====== Rôles & libellé bouton ====== */
  const DIRECTOR_ROLE_KEYS = ['um_directeur_laboratoire','directeur_laboratoire','directeur-laboratoire'];
  function currentRoles(){
    const out = [];
    if (Array.isArray(window.PMSettings?.roles)) out.push(...window.PMSettings.roles);
    if (window.PMSettings?.role) out.push(window.PMSettings.role);
    return out.map(r => String(r||'').toLowerCase());
  }
  function isDirector(){ return currentRoles().some(r => DIRECTOR_ROLE_KEYS.includes(r)); }
  function initButtonLabel(){ btnSubmit.textContent = isDirector() ? 'Publier' : 'Soumettre ma demande'; }
  initButtonLabel();

  /* ====== Helpers ====== */
  function setHint(msg, ok=false){
    hint.textContent = msg || '';
    hint.className   = 'mt-2 small ' + (ok ? 'text-success' : 'text-danger');
  }

  /* ====== Soumission (création) ====== */
  btnSubmit.addEventListener('click', async ()=>{
    setHint('');
    setDoiError(''); // reset erreur locale DOI

    if (!elType.value || !elDate.value || !elTitre.value.trim()){
      setHint('Veuillez renseigner le type, la date et le titre.');
      return;
    }

    // Si Article et DOI saisi → valider le format localement
    const doiValue = (elDoi?.value||'').trim();
    if (elType.value === 'Article' && doiGroup.style.display !== 'none' && doiValue && !isValidDOI(doiValue)) {
      setDoiError("Veuillez saisir un DOI valide (ex: 10.1234/abcd5678).");
      elDoi?.focus();
      return;
    }

    btnSubmit.disabled = true; const old = btnSubmit.textContent; btnSubmit.textContent = 'Envoi…';
    try {
      // 1) uploader d'abord les fichiers (si présents)
      let uploaded_files = [];
      try { uploaded_files = await uploadAllFilesIfAny(); } catch(e){ console.warn(e); }

      // 2) Construire le payload COMPLET avant le fetch
      const payload = {
        date_publication: elDate.value,
        titre: elTitre.value.trim(),
        type: elType.value,
        resume: elResume.value,
        commentaire: elComm.value,
        doi: doiValue,
        nb_pages: Number(elPages?.value || 0) || null,
        maison_edition_scientifique: (elMaison.value || '').trim(),
        title_en:   (elTitleEn?.value || '').trim(),
        summary_en: (elSummaryEn?.value || '').trim(),

        // ✅ BASE: toujours envoyés, même sans partage
        keywords: keywords.slice(),
        files:    uploaded_files
      };

      // 3) Si Article + PARTAGE → ajouter aussi les champs de partage
      if (elType.value === 'Article' && shareToggle?.checked && shareUserIds.length){
        payload.share_with_user_ids = shareUserIds.slice();
        if (keywords.length)       payload.share_keywords = keywords.slice();
        if (uploaded_files.length) payload.share_files    = uploaded_files;
      }

      // 4) Appel API
      const url = `${API_BASE}/publication`;
      const resp = await fetch(url, {
        method:'POST',
        headers: { 'Content-Type':'application/json', ...(REST_NONCE?{'X-WP-Nonce':REST_NONCE}:{}) },
        credentials:'same-origin',
        body: JSON.stringify(payload)
      });

      if (!resp.ok) {
        let msg = `HTTP ${resp.status}`;
        try { const j = await resp.json(); msg = j?.message || msg; } catch {}
        if (resp.status === 409 || /doi/i.test(String(msg))) {
          setDoiError('Ce DOI existe déjà pour une autre publication.');
          elDoi?.focus();
          throw new Error('duplicate-doi');
        }
        throw new Error(msg);
      }

      setHint(isDirector() ? 'Publication publiée.' : 'Publication créée et envoyée pour validation.', true);
      setTimeout(() => { location.replace(LIST_URL || '/publication/'); }, 700);

    } catch(e){
      if (e?.message !== 'duplicate-doi') {
        setHint(e?.message || 'Une erreur est survenue.');
      }
    } finally {
      btnSubmit.disabled = false; btnSubmit.textContent = old;
    }
  });
})();
</script>
