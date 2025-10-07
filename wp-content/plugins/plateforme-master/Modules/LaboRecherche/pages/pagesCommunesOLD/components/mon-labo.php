<!-- ======== FICHE ÉQUIPEMENT (dynamique) – Mon Labo (drawer Infos = mêmes champs que formulaire d’ajout) ======== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="wrap-eq">
  <!-- 1) Informations générales -->
  <div class="card">
    <h3>Informations générales
      <button class="edit-btn" title="Modifier"><i class="fa-solid fa-pen"></i></button>
    </h3>
    <ul id="info-list" class="info-list"></ul>
  </div>

  <!-- 2) Image -->
  <div class="card">
    <h3>Image
      <button class="edit-btn" title="Modifier"><i class="fa-solid fa-pen"></i></button>
    </h3>

    <div class="gallery-wrap">
      <button class="nav left" id="galPrev" aria-label="Précédent"><i class="fa-solid fa-angle-left"></i></button>
      <div id="gallery" class="gallery"></div>
      <button class="nav right" id="galNext" aria-label="Suivant"><i class="fa-solid fa-angle-right"></i></button>
    </div>
  </div>

  <!-- 3) Documents associés -->
  <div class="card">
    <h3>Documents associés</h3>
    <div class="table-wrap">
      <table class="eq-table" id="docs-table">
        <thead>
          <tr>
            <th>Nom du document</th>
            <th>Date d’ajout</th>
            <th>Télécharger</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <!-- 4) Maintenance & incidents -->
  <div class="card">
    <h3>Maintenance &amp; incidents</h3>
    <div class="table-wrap">
      <table class="eq-table" id="maint-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Description</th>
            <th>Document</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- ====== Backdrop commun ====== -->
<div class="drawer-backdrop" id="drawerBackdrop"></div>

<!-- ====== Drawer Informations générales (mêmes champs que “Ajouter équipement”) ====== -->
<aside class="drawer" id="drawerInfo" aria-hidden="true">
  <header class="drawer-head">
    <h4>Modifier – Informations générales</h4>
    <button class="btn save" id="btnSaveInfo">Enregistrer</button>
  </header>

  <form id="formInfo" class="drawer-body">
    <!-- Catégorie -->
    <div class="f">
      <label>Catégorie Des Equipements</label>
      <select name="categorie_id" id="info_categorie_id">
        <option value="">Catégorie Des Equipements</option>
      </select>
    </div>

    <!-- Nom -->
    <div class="f">
      <label>Nom de l’équipement</label>
      <input type="text" name="nom_appareil" id="info_nom_appareil" />
    </div>

    <!-- Lieu -->
    <div class="f">
      <label>Localisation</label>
      <input type="text" name="lieu" id="info_lieu" />
    </div>

    <!-- Modèle -->
    <div class="f">
      <label>Modèle / Version</label>
      <input type="text" name="modele" id="info_modele" />
    </div>

    <!-- Spécification -->
    <div class="f">
      <label>Spécification technique</label>
      <textarea name="spcification_technique" id="info_spec" rows="4"></textarea>
    </div>

    <!-- Statut -->
    <div class="f">
      <label>Statut</label>
      <select name="statut" id="info_statut">
        <option value="">Statut</option>
        <option value="fonctionnel">Fonctionnel</option>
        <option value="en_panne">En panne</option>
        <option value="en_maintenance">En maintenance</option>
        <option value="hors_service">Hors service</option>
      </select>
    </div>

    <!-- Disponibilité -->
    <div class="f">
      <label>Disponibilité</label>
      <select name="disponibilite_id" id="info_disponibilite_id">
        <option value="">Disponibilité</option>
      </select>
    </div>

    <!-- Protocole d'utilisation (PDF) -->
    <div class="f">
      <label>Protocole d'utilisation (PDF)</label>
      <div class="upload-row">
        <input type="text" id="protoText" class="fake-file" placeholder="Aucun fichier choisi" readonly />
        <input type="file" id="protoFile" accept="application/pdf,.pdf" hidden />
        <button type="button" class="btn upload" id="btnPickProto"><i class="fa-solid fa-upload"></i> Importer</button>
      </div>
      <small id="protoExisting" style="color:#6E6D55;display:block;margin-top:6px;"></small>
    </div>

    <hr style="border:none;border-top:1px solid #eee;margin:12px 0">

    <!-- Conditions d'entretien -->
    <div class="f">
      <label style="font-weight:700;color:#333">Conditions d'entretien</label>
    </div>

    <!-- Contrat (PDF) -->
    <div class="f">
      <label>Contrat (PDF)</label>
      <div class="upload-row">
        <input type="text" id="contratText" class="fake-file" placeholder="Aucun fichier choisi" readonly />
        <input type="file" id="contratFile" accept="application/pdf,.pdf" hidden />
        <button type="button" class="btn upload" id="btnPickContrat"><i class="fa-solid fa-upload"></i> Importer</button>
      </div>
      <small id="contratExisting" style="color:#6E6D55;display:block;margin-top:6px;"></small>
    </div>

    <!-- Périodicité -->
    <div class="f">
      <label>Périodicité</label>
      <select id="info_periodicite" name="periodicite">
        <option value="">Périodicité</option>
        <option value="mensuelle">Mensuelle</option>
        <option value="trimestrielle">Trimestrielle</option>
        <option value="semestrielle">Semestrielle</option>
        <option value="annuelle">Annuelle</option>
        <option value="a_la_demande">À la demande</option>
      </select>
    </div>

    <!-- Consignes -->
    <div class="f">
      <label>Consignes</label>
      <input type="text" id="info_consignes" name="consignes" placeholder="Consignes" />
    </div>
  </form>
</aside>

<!-- ====== Drawer Images ====== -->
<aside class="drawer" id="drawerImages" aria-hidden="true">
  <header class="drawer-head">
    <h4>Modifier les images</h4>
    <button class="btn save" id="btnSaveImages">Enregistrer</button>
  </header>
  <div class="drawer-body">
    <div id="drawerImagesGrid" class="thumb-grid"></div>
    <div class="f" style="margin-top:14px">
      <label>Importer les images</label>
      <div class="upload-row">
        <input type="text" id="imgFileName" class="fake-file" placeholder="Aucun fichier choisi" readonly />
        <input type="file" id="imgFileHidden" accept="image/*" hidden multiple />
        <button type="button" class="btn upload" id="btnUpload"><i class="fa-solid fa-upload"></i> Importer</button>
      </div>
    </div>
  </div>
</aside>

<style>
:root{ --bg:#F5F5F3; --card:#fff; --line:#ECEBE3; --text:#2A2916; --muted:#6E6D55; --thead:#ECEBE3; }
.wrap-eq{ font-family:'Poppins',sans-serif; }
.card{ background:var(--card); border:white; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,.06); overflow:hidden; margin-bottom:16px; }
.card h3{ margin:0; padding:16px 20px; font-size:18px; font-weight:700; color:var(--text); background:#fff; border-bottom:1px solid var(--line); box-shadow:0 4px 12px rgba(0,0,0,.08); position:relative;}
.edit-btn{ position:absolute; right:14px; top:10px; width:34px; height:34px; border-radius:8px; border:1px solid #E2DFC9; background:#fff; color:#BF0404; display:flex; align-items:center; justify-content:center; cursor:pointer;}
.edit-btn:hover{ background:#fff4f4; }
.info-list{ list-style:none; margin:0; padding:0;}
.info-row{ display:grid; grid-template-columns:260px 1fr; border-bottom:1px solid var(--line);}
.info-row:last-child{ border-bottom:none;}
.info-cell{ padding:12px 18px; font-size:14px;}
.label{ color:var(--muted); font-weight:600;}
.value{ color:var(--text); font-weight:500;}
.table-wrap{ padding:10px 10px 16px 10px;}
.eq-table{ width:100%; border-collapse:separate; border-spacing:0; background:#fff; border-radius:10px; overflow:hidden; font-size:14px; box-shadow:0 3px 12px rgba(0,0,0,.04);}
.eq-table thead th{ background:var(--thead); color:#2A2916; font-weight:700; text-align:left; padding:12px 14px; border-bottom:1px solid #E5E3D2;}
.eq-table tbody td{ padding:12px 14px; border-bottom:1px solid #EEEADF; color:#333; vertical-align:middle;}
.eq-table tbody tr:last-child td{ border-bottom:none; }
.dl-btn,.doc-pill{ display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; border:1px solid #E2DFC9; background:#F3F1E7; color:#2A2916; }
.doc-pill.disabled{ opacity:.45; cursor:default; }
.gallery-wrap{ position:relative; padding:14px 36px; }
.gallery{ display:flex; gap:12px; overflow-x:auto; scroll-behavior:smooth; padding:0 2px; }
.gallery::-webkit-scrollbar{ height:8px; }
.gallery::-webkit-scrollbar-thumb{ background:#ddd; border-radius:8px; }
.thumb{ position:relative; min-width:180px; max-width:220px; flex:0 0 auto; border:1px solid #E9E6D6; border-radius:10px; overflow:hidden; background:#fff; box-shadow:0 3px 10px rgba(0,0,0,.05); aspect-ratio:4/3; display:block;}
.thumb img{ width:100%; height:100%; object-fit:cover; display:block; }
.thumb .del{ position:absolute; right:6px; top:6px; width:22px; height:22px; border-radius:999px; background:#c40000; color:#fff; border:none; display:flex; align-items:center; justify-content:center; font-size:12px; cursor:pointer; }
.thumb .tag{ position:absolute; left:6px; top:6px; font-size:11px; background:#fff; border:1px solid #E2DFC9; color:#2A2916; padding:2px 6px; border-radius:999px; }
.nav{ position:absolute; top:50%; transform:translateY(-50%); width:28px; height:28px; border-radius:999px; border:1px solid #E2DFC9; background:#fff; color:#2A2916; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,.08); cursor:pointer; }
.nav.left{ left:6px; } .nav.right{ right:6px; } .nav:disabled{ opacity:.35; cursor:default; }
.drawer-backdrop{ position:fixed; inset:0; background:rgba(0,0,0,.28); display:none; z-index:9998; }
.drawer-backdrop.open{ display:block; }
.drawer{ position:fixed; top:0; right:-420px; width:420px; max-width:92vw; height:100dvh; background:#fff; box-shadow:-8px 0 24px rgba(0,0,0,.18); z-index:9999; display:flex; flex-direction:column; transition:right .25s ease; border-left:1px solid #ececec; }
.drawer.open{ right:0; }
.drawer-head{ position:relative; display:flex; align-items:center; gap:10px; padding:12px 14px; border-bottom:1px solid #eee; box-shadow:0 3px 10px rgba(0,0,0,.06); }
.drawer-head h4{ margin:0; font-size:16px; font-weight:700; color:#2A2916; }
.drawer-head .btn.save{ margin-left:auto; background:#BF0404; color:#fff; border:0; border-radius:8px; padding:8px 16px; font-weight:700; cursor:pointer; box-shadow:0 2px 10px #00000020; }
.drawer-body{ padding:16px; overflow:auto; }
.f{ display:flex; flex-direction:column; gap:8px; margin-bottom:12px; }
.f label{ font-size:13px; color:#6E6D55; font-weight:600; }
.f input,.f textarea,.f select{ border:1px solid #DBD9C3; border-radius:8px; padding:10px 12px; font:inherit; color:#2A2916; outline:none; }
.f textarea{ resize:vertical; }
@media (max-width:480px){ .drawer{ width:100vw; } }
.thumb-grid{ display:grid; grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); gap:10px; }
.thumb-mini{ position:relative; border:1px solid #E9E6D6; border-radius:10px; overflow:hidden; background:#fff; aspect-ratio:1/1; display:block; }
.thumb-mini img{ width:100%; height:100%; object-fit:cover; display:block; }
.thumb-mini .del{ position:absolute; right:6px; top:6px; width:22px; height:22px; border-radius:999px; background:#c40000; color:#fff; border:none; display:flex; align-items:center; justify-content:center; font-size:12px; cursor:pointer; box-shadow:0 1px 4px rgba(0,0,0,.15); }
.thumb-mini .tag{ position:absolute; left:6px; top:6px; font-size:10px; background:#fff; border:1px solid #E2DFC9; color:#2A2916; padding:2px 6px; border-radius:999px; }
.upload-row{ display:flex; gap:8px; align-items:center; }
.fake-file{ flex:1; border:1px solid #DBD9C3; border-radius:8px; padding:10px 12px; background:#fff; color:#2A2916; }
.btn.upload{ background:#C7C1A0; color:#2A2916; border:1px solid #B8B28F; border-radius:8px; padding:10px 14px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:8px; color:white; }
</style>

<script>
/* ==================== Script #1 : Données + Drawer Infos (mêmes champs que “Ajouter”) ==================== */
(function(){
  const ns = 'plateforme-directeurderecherche/v1';
  const REST = (p) => (window.PMSettings?.restUrl || PMSettings?.restUrl || '/') + p.replace(/^\/+/, '');
  const HEADERS = { 'X-WP-Nonce': (window.PMSettings?.nonce || (PMSettings?.nonce || '')) , 'Content-Type':'application/json' };

  const $info  = document.getElementById('info-list');
  const $docsT = document.querySelector('#docs-table tbody');
  const $mntT  = document.querySelector('#maint-table tbody');

  const $drawerBackdrop = document.getElementById('drawerBackdrop');
  const $drawerInfo   = document.getElementById('drawerInfo');
  const $drawerImages = document.getElementById('drawerImages');
  const $formInfo     = document.getElementById('formInfo');

  // inputs drawer
  const $selCat   = document.getElementById('info_categorie_id');
  const $nom      = document.getElementById('info_nom_appareil');
  const $lieu     = document.getElementById('info_lieu');
  const $modele   = document.getElementById('info_modele');
  const $spec     = document.getElementById('info_spec');
  const $selStat  = document.getElementById('info_statut');
  const $selDisp  = document.getElementById('info_disponibilite_id');
  const $selPer   = document.getElementById('info_periodicite');
  const $consignes= document.getElementById('info_consignes');
  const $protoFile= document.getElementById('protoFile');
  const $protoText= document.getElementById('protoText');
  const $protoExisting = document.getElementById('protoExisting');
  const $contrFile= document.getElementById('contratFile');
  const $contrText= document.getElementById('contratText');
  const $contrExisting = document.getElementById('contratExisting');
  document.getElementById('btnPickProto').addEventListener('click', ()=> $protoFile.click());
  document.getElementById('btnPickContrat').addEventListener('click', ()=> $contrFile.click());
  $protoFile.addEventListener('change', ()=>{ $protoText.value = $protoFile.files?.[0]?.name || ''; });
  $contrFile.addEventListener('change', ()=>{ $contrText.value = $contrFile.files?.[0]?.name || ''; });

  const getParam = k => new URLSearchParams(location.search).get(k);
  const equipementId = getParam('equipement_id');

  const safe = v => (v===undefined || v===null || v==='') ? '—' : v;
  const cap  = v => v ? (v[0].toUpperCase()+v.slice(1)) : v;
  const fmtDate = v => { if(!v) return '—'; const d = new Date(v); return isNaN(d) ? String(v).slice(0,10) : d.toISOString().slice(0,10); };

  async function apiGet(url){ const r=await fetch(url,{headers:HEADERS,credentials:'include'}); if(!r.ok) throw new Error(url+' -> '+r.status); return r.json(); }
  async function apiPatch(url,body){ const r=await fetch(url,{method:'PATCH',headers:HEADERS,credentials:'include',body:JSON.stringify(body)}); if(!r.ok) throw new Error(url+' -> '+r.status); return r.json(); }
  async function apiPost(url,body){ const r=await fetch(url,{method:'POST',headers:HEADERS,credentials:'include',body:JSON.stringify(body)}); if(!r.ok) throw new Error(url+' -> '+r.status); return r.json(); }

  // helpers nom de fichier safe + upload Media (FormData)
  function makeSafeFilename(originalName) {
    const dot = originalName.lastIndexOf('.');
    const base = dot > -1 ? originalName.slice(0, dot) : originalName;
    const ext  = dot > -1 ? originalName.slice(dot).toLowerCase() : '';
    let safe = base.normalize('NFKD').replace(/[\u0300-\u036f]/g, '');
    safe = safe.replace(/[\u2012\u2013\u2014\u2015]/g, '-');
    safe = safe.replace(/[^a-zA-Z0-9-_]+/g, '_');
    safe = safe.replace(/_+/g, '_').replace(/^_+|_+$/g, '').toLowerCase().slice(0, 80);
    return (safe || 'file') + (ext || '');
  }
  async function uploadMediaSafe(file, title=''){
    if(!file) return '';
    const safeName = makeSafeFilename(file.name || (title?title+'.pdf':'file'));
    const blob = new File([file], safeName, { type: file.type || 'application/octet-stream' });
    const root = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/$/,'');
    const url  = root + '/wp/v2/media';
    const form = new FormData();
    form.append('file', blob, blob.name);
    if (title) form.append('title', title);
    const res = await fetch(url, { method:'POST', headers:{'X-WP-Nonce': window.PMSettings?.nonce || ''}, credentials:'include', body: form });
    if(!res.ok){ const msg = await res.text().catch(()=>res.statusText); throw new Error('Upload error '+res.status+' – '+msg); }
    const j = await res.json();
    return j?.source_url || '';
  }

  // état global pour réutiliser dans les drawers
  const EQ = { detail:{}, labels:{}, entretien:{}, maint:[] };
  window.__EQ = EQ;

  function openDrawer($d){ $drawerBackdrop.classList.add('open'); $d.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeDrawers(){ $drawerBackdrop.classList.remove('open'); $drawerInfo.classList.remove('open'); $drawerImages.classList.remove('open'); document.body.style.overflow=''; }
  $drawerBackdrop.addEventListener('click', closeDrawers);

  function render(){
    const rows = [
      ['Catégorie :',               safe(EQ.labels.categorie_label)],
      ['Nom de l’équipement :',     safe(EQ.detail.nom_appareil)],
      ['Localisation :',            safe(EQ.detail.lieu)],
      ['Modèle / Version :',        safe(EQ.detail.modele)],
      ['Disponibilité :',           safe(EQ.labels.disponibilite_label)],
      ['Statut :',                  safe(EQ.detail.statut)],
      ['Spécification technique :', safe(EQ.detail.spcification_technique)]
    ];
    $info.innerHTML = rows.map(([l,v]) => `<li class="info-row"><div class="info-cell label">${l}</div><div class="info-cell value">${v}</div></li>`).join('');
  }

  // lookups catégories/disponibilités
  async function loadLookups(){
    try{
      const base = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
      const [cats, dispos] = await Promise.all([
        apiGet(`${base}/${ns}/categories-equipements`),
        apiGet(`${base}/${ns}/disponibilites-equipements`)
      ]);
      const fill = (sel, items, placeholder) => {
        sel.innerHTML = ''; sel.append(new Option(placeholder,''));
        (items||[]).forEach(it => sel.append(new Option(it.intitule || it.code || ('#'+it.id), it.id)));
      };
      fill($selCat, cats, 'Catégorie Des Equipements');
      fill($selDisp, dispos, 'Disponibilité');
      window._EQUIP_CATS = cats; window._EQUIP_DISPOS = dispos;
    }catch(e){ console.warn('Lookups fail', e); }
  }

  function basenameFromUrl(url=''){
    try { return decodeURIComponent(new URL(url, location.origin).pathname.split('/').pop()||''); }
    catch { return (url||'').split('/').pop()||''; }
  }

  async function loadAll(){
    if(!equipementId){ console.warn('No equipement_id in URL'); return; }

    // détail
    try{ EQ.detail = await apiGet(REST(`/${ns}/equipement/${equipementId}`)); }catch(e){ console.error(e); }

    // labels + protocole (pour docs)
    try{
      const list = await apiGet(REST(`/${ns}/equipement?all=1&per_page=200`));
      const row  = Array.isArray(list) ? list.find(r => String(r.id)===String(equipementId)) : null;
      if(row){
        EQ.labels.categorie_label     = row.categorie_label;
        EQ.labels.disponibilite_label = row.disponibilite_label;
        EQ.labels.protocole_fichier   = row.protocole_fichier || '';
        EQ.labels.protocole_date      = row.protocole_date || '';
      }
    }catch(e){}

    // entretien
    try{
      const ce = await apiGet(REST(`/${ns}/conditions_entretien?equipement_id=${encodeURIComponent(equipementId)}&per_page=1`));
      if(Array.isArray(ce) && ce.length){
        const last = ce[0];
        EQ.entretien.periodicite     = last.periodicite || '';
        EQ.entretien.consignes       = last.consignes || '';
        EQ.entretien.fichier_contrat = last.fichier_contrat || '';
        EQ.entretien.created_at      = last.created_at || '';
      } else {
        EQ.entretien = {};
      }
    }catch(e){}

    // maintenance
    try{
      const mm = await apiGet(REST(`/${ns}/maintenance?equipement_id=${encodeURIComponent(equipementId)}`));
      EQ.maint = Array.isArray(mm) ? mm : [];
    }catch(e){}

    render();

    // docs
    const docs = [];
    if(EQ.labels.protocole_fichier){ docs.push({nom:'Protocole d’utilisation', date:fmtDate(EQ.labels.protocole_date), url:EQ.labels.protocole_fichier}); }
    if(EQ.entretien.fichier_contrat){ docs.push({nom:'Contrat', date:fmtDate(EQ.entretien.created_at), url:EQ.entretien.fichier_contrat}); }
    if(!docs.length){ docs.push({nom:'—', date:'—', url:''}); }
    $docsT.innerHTML = docs.map(d => `
      <tr>
        <td>${d.nom}</td><td>${d.date}</td>
        <td>${d.url ? `<a class="dl-btn" href="${d.url}" target="_blank"><i class="fa-solid fa-download"></i></a>` : `<span class="doc-pill disabled"><i class="fa-solid fa-download"></i></span>`}</td>
      </tr>`).join('');
  }

  // ouvre drawer Infos + préremplit tous les champs
  async function openDrawerInfosPrefill(){
    await loadLookups();

    $selCat.value = String(EQ.detail.categorie_id || '');
    $nom.value    = EQ.detail.nom_appareil || '';
    $lieu.value   = EQ.detail.lieu || '';
    $modele.value = EQ.detail.modele || '';
    $spec.value   = EQ.detail.spcification_technique || '';
    $selStat.value= EQ.detail.statut || '';
    $selDisp.value= String(EQ.detail.disponibilite_id || '');

    // entretien
    $selPer.value     = EQ.entretien.periodicite || '';
    $consignes.value  = EQ.entretien.consignes || '';

    // miroirs fichiers existants
    $protoText.value   = ''; $protoFile.value = '';
    $contrText.value   = ''; $contrFile.value = '';
    $protoExisting.textContent  = EQ.labels.protocole_fichier ? `Actuel : ${basenameFromUrl(EQ.labels.protocole_fichier)}` : 'Aucun protocole enregistré';
    $contrExisting.textContent  = EQ.entretien.fichier_contrat ? `Actuel : ${basenameFromUrl(EQ.entretien.fichier_contrat)}` : 'Aucun contrat enregistré';

    openDrawer($drawerInfo);
  }

  // enregistrer (bouton en haut du drawer infos)
  document.getElementById('btnSaveInfo').addEventListener('click', async ()=>{
    const payload = {
      categorie_id: Number($selCat.value || 0) || undefined,
      nom_appareil: ($nom.value||'').trim(),
      lieu: ($lieu.value||'').trim(),
      modele: ($modele.value||'').trim(),
      disponibilite_id: Number($selDisp.value || 0) || undefined,
      statut: ($selStat.value||'').trim(),
      spcification_technique: ($spec.value||'').trim()
    };
    Object.keys(payload).forEach(k => payload[k]===undefined && delete payload[k]);

    // fichiers éventuels
    const protoChosen  = $protoFile.files?.[0] || null;
    const contratChosen= $contrFile.files?.[0] || null;

    // entretien
    const periodicite = ($selPer.value||'').trim();
    const consignes   = ($consignes.value||'').trim();

    try{
      // 1) PATCH équipement
      await apiPatch(REST(`/${ns}/equipement/${encodeURIComponent(equipementId)}`), payload);

      // 2) Uploads + liaisons
      let protoUrl = '';
      if (protoChosen) {
        protoUrl = await uploadMediaSafe(protoChosen, `Protocole - ${payload.nom_appareil || 'Equipement'}`);
        if (protoUrl) {
          await apiPost(REST(`/${ns}/equipement_protocole`), {
            id_recherche_equipement: parseInt(equipementId,10),
            fichier: String(protoUrl)
          });
        }
      }
      let contratUrl = '';
      if (contratChosen) {
        contratUrl = await uploadMediaSafe(contratChosen, `Contrat - ${payload.nom_appareil || 'Equipement'}`);
      }
      if (periodicite || consignes || contratUrl) {
        await apiPost(REST(`/${ns}/conditions_entretien`), {
          id_recherche_equipement: parseInt(equipementId,10),
          periodicite: periodicite,
          consignes: consignes,
          fichier_contrat: contratUrl || undefined
        });
      }

      // 3) Fermer + recharger
      $drawerBackdrop.classList.remove('open'); $drawerInfo.classList.remove('open'); document.body.style.overflow='';
      await loadAll();

    }catch(err){
      alert('Erreur lors de la mise à jour : '+err.message);
    }
  });

  // ouverture des drawers (Infos / Images)
  const editBtns = document.querySelectorAll('.card .edit-btn');
  editBtns[0]?.addEventListener('click', openDrawerInfosPrefill);
  editBtns[1]?.addEventListener('click', () => {
    document.body.style.overflow='hidden';
    $drawerBackdrop.classList.add('open'); $drawerImages.classList.add('open');
    // Script #2 gère les images
  });

  document.addEventListener('DOMContentLoaded', loadAll);
})();
</script>

<script>
/* ==================== Script #2 : Gestion des images (galerie + drawer + upload différé) ==================== */
(function(){
  const ns = 'plateforme-directeurderecherche/v1';
  const REST = (p) => (window.PMSettings?.restUrl || PMSettings?.restUrl || '/').replace(/\/+$/,'/') + p.replace(/^\/+/, '');
  const HEADERS_JSON = { 'X-WP-Nonce': (window.PMSettings?.nonce || (PMSettings?.nonce || '')), 'Content-Type':'application/json' };
  const HEADERS = { 'X-WP-Nonce': (window.PMSettings?.nonce || (PMSettings?.nonce || '')) };

  const equipementId = new URLSearchParams(location.search).get('equipement_id');

  const $gal = document.getElementById('gallery');
  const $prev = document.getElementById('galPrev');
  const $next = document.getElementById('galNext');
  const $drawerImages = document.getElementById('drawerImages');
  const $drawerBackdrop = document.getElementById('drawerBackdrop');
  const $grid = document.getElementById('drawerImagesGrid');

  const $fileHidden = document.getElementById('imgFileHidden');
  const $fileName   = document.getElementById('imgFileName');
  const $btnUpload  = document.getElementById('btnUpload');
  const $btnSaveImages = document.getElementById('btnSaveImages');

  let IMAGES = [];
  let PENDING = [];

  const apiGet    = (u,h=HEADERS)=>fetch(u,{headers:h}).then(r=>{ if(!r.ok) throw new Error(r.status); return r.json(); });
  const apiPatch  = (u,b)=>fetch(u,{method:'PATCH',headers:HEADERS_JSON,body:JSON.stringify(b)}).then(r=>{ if(!r.ok) throw new Error(r.status); return r.json(); });
  const apiDelete = (u)=>fetch(u,{method:'DELETE',headers:HEADERS}).then(r=>{ if(!r.ok && r.status!==204) throw new Error(r.status); return true; });

  async function loadImages(){
    IMAGES = [];
    try{
      const list = await apiGet(REST(`/${ns}/equipement_images?equipement_id=${encodeURIComponent(equipementId)}`));
      if(Array.isArray(list) && list.length){ IMAGES = list.map(x => ({ id:x.id, url:x.image_url })); }
    }catch(_e){}
  }

  function renderGallery(){
    if(!IMAGES.length){
      $gal.innerHTML = `<div style="padding:6px 10px;color:#666;">Aucune image</div>`;
      $prev.disabled = $next.disabled = true;
      return;
    }
    $gal.innerHTML = IMAGES.map(img=>`
      <div class="thumb">
        <img src="${img.url}" alt="">
        <button class="del" data-del="${img.id}" title="Supprimer"><i class="fa-solid fa-xmark"></i></button>
      </div>`).join('');
    const canScroll = $gal.scrollWidth > $gal.clientWidth + 4;
    $prev.disabled = $next.disabled = !canScroll;
  }

  function renderDrawerGrid(){
    const persisted = IMAGES.map(img=>`
      <div class="thumb-mini">
        <img src="${img.url}" alt="">
        <button class="del" data-del="${img.id}" title="Supprimer"><i class="fa-solid fa-xmark"></i></button>
      </div>`).join('');

    const pending = PENDING.map((p,idx)=>`
      <div class="thumb-mini">
        <img src="${p.url}" alt="">
        <button class="del" data-del-pending="${idx}" title="Retirer"><i class="fa-solid fa-xmark"></i></button>
      </div>`).join('');

    $grid.innerHTML = persisted + pending;
  }

  $prev?.addEventListener('click', ()=> $gal.scrollBy({left:-($gal.clientWidth-80), behavior:'smooth'}));
  $next?.addEventListener('click', ()=> $gal.scrollBy({left: ($gal.clientWidth-80), behavior:'smooth'}));
  $gal?.addEventListener('scroll', ()=>{
    const max = $gal.scrollWidth - $gal.clientWidth - 2;
    $prev.disabled = ($gal.scrollLeft <= 2);
    $next.disabled = ($gal.scrollLeft >= max);
  });

  function onDeletePersisted(id){
    if(!confirm('Supprimer cette image ?')) return;
    apiDelete(REST(`/${ns}/equipement_images/${encodeURIComponent(id)}`))
      .then(async ()=>{
        IMAGES = IMAGES.filter(x => String(x.id) !== String(id));
        renderGallery(); renderDrawerGrid();
      })
      .catch(err=> alert('Suppression impossible : '+err.message));
  }

  function onDeletePending(idx){
    const p = PENDING[idx];
    if(!p) return;
    if(p.url && p.url.startsWith('blob:')) URL.revokeObjectURL(p.url);
    PENDING.splice(idx,1);
    renderDrawerGrid();
  }

  function onClickAny(e){
    const b1 = e.target.closest('button[data-del]');
    if(b1){ onDeletePersisted(b1.getAttribute('data-del')); return; }
    const b2 = e.target.closest('button[data-del-pending]');
    if(b2){ onDeletePending(+b2.getAttribute('data-del-pending')); return; }
  }
  $gal.addEventListener('click', onClickAny);
  $grid.addEventListener('click', onClickAny);

  $btnUpload.addEventListener('click', ()=>{ $fileHidden.click(); });
  $fileHidden.addEventListener('change', ()=>{
    const files = Array.from($fileHidden.files || []);
    if(!files.length) return;
    $fileName.value = files.map(f=>f.name).join(', ');
    files.forEach(f=>{
      const url = URL.createObjectURL(f);
      PENDING.push({ file:f, url });
    });
    $fileHidden.value = '';
    renderDrawerGrid();
  });

  async function uploadToMedia(file){
    const root = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/$/,'');
    const url  = root + '/wp/v2/media';
    const form = new FormData();
    form.append('file', file, file.name);
    const res = await fetch(url, {
      method: 'POST',
      headers: { 'X-WP-Nonce': window.PMSettings?.nonce || '' },
      body: form
    });
    if (!res.ok) {
      const msg = await res.text();
      throw new Error('Upload error ' + res.status + ' – ' + msg);
    }
    const json = await res.json();
    return json.source_url;
  }

  $btnSaveImages.addEventListener('click', async ()=>{
    try{
      const urls = [];
      for(const p of PENDING){
        const u = await uploadToMedia(p.file);
        urls.push(u);
      }
      if(urls.length){
        await apiPatch(REST(`/${ns}/equipement/${encodeURIComponent(equipementId)}`), { new_images: urls });
      }
      PENDING.forEach(p => { if(p.url && p.url.startsWith('blob:')) URL.revokeObjectURL(p.url); });
      PENDING = [];
      $fileName.value = '';
      await loadImages();
      renderGallery(); renderDrawerGrid();
      $drawerBackdrop.classList.remove('open'); $drawerImages.classList.remove('open'); document.body.style.overflow='';
    }catch(e){
      alert('Erreur lors de l’enregistrement des images : ' + e.message);
    }
  });

  document.querySelectorAll('.card .edit-btn')[1]?.addEventListener('click', async ()=>{
    await loadImages(); renderDrawerGrid();
  });

  (async function init(){ await loadImages(); renderGallery(); })();
})();
</script>
