<?php
/** Page: Modifier une publication partagée (édition de MA part) */
if (!defined('ABSPATH')) exit;
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* === Tout est scoper sous .pm-share-edit pour éviter les collisions thème === */
.pm-share-edit{font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
.pm-share-edit *{box-sizing:border-box}

.pm-share-edit .info-card{background:#fff;border:1px solid #e0e0e0;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05);overflow:hidden}
.pm-share-edit .info-header{background:#fff;padding:16px 20px;border-bottom:1px solid #eee}
.pm-share-edit .info-header h2{margin:0;font-size:18px;font-weight:700;color:#333}

.pm-share-edit .info-list{list-style:none;margin:0;padding:0 20px 18px}
.pm-share-edit .info-item{display:grid;grid-template-columns:minmax(180px,260px) 1fr;gap:18px;padding:10px 0;border-bottom:1px dashed #eee}
.pm-share-edit .info-item:last-child{border-bottom:none}
.pm-share-edit .info-item-label{color:#6E6D55;font-weight:600}
.pm-share-edit .info-item-value{color:#333;word-break:break-word}

.pm-share-edit .section{padding:16px 20px}
.pm-share-edit .section h3{margin:0 0 8px;font-size:16px;font-weight:700;color:#333}

.pm-share-edit .doc-table{width:100%;border-collapse:collapse}
.pm-share-edit .doc-table th,.pm-share-edit .doc-table td{border:1px solid #eee;padding:10px 12px;text-align:left;font-size:14px}
.pm-share-edit .doc-table th{background:#f7f6f1;color:#333}

.pm-share-edit .dl{display:inline-flex;align-items:center;gap:6px;text-decoration:none}
.pm-share-edit .dl .icon{width:18px;height:18px;background:url('/wp-content/plugins/plateforme-master/images/icons/upload-red.png') center/contain no-repeat;display:inline-block;filter:hue-rotate(180deg)}

.pm-share-edit .form-container{background:#FAFAF8;border:1px solid #e0e0e0;border-radius:10px;margin-top:22px;box-shadow:0 4px 12px rgba(0,0,0,.05)}
.pm-share-edit .bg{background:#fff;box-shadow:0 8px 12px -9px rgba(0,0,0,.2);padding:0 24px}
.pm-share-edit .bg h2{font-size:18px;font-weight:700;margin:0;padding:16px 0;color:#333}
.pm-share-edit .form-section{padding:16px 24px}

.pm-share-edit .row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.pm-share-edit .row-1{display:grid;grid-template-columns:1fr}
.pm-share-edit .form-label{font-weight:600;color:#6E6D55;margin-bottom:6px;display:block}
.pm-share-edit .form-control{border-radius:6px;border:1px solid #DBD9C3;padding:10px;background:#fff;width:100%}
.pm-share-edit textarea.form-control{min-height:110px;resize:vertical}

.pm-share-edit .pill-input{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;height:42px;padding:0 10px;gap:8px;background:#fff}
.pm-share-edit .pill-input input{flex:1;border:none;outline:none;height:100%;font-size:14px;background:transparent}
.pm-share-edit .chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}
.pm-share-edit .chip{display:inline-flex;align-items:center;gap:6px;padding:8px 12px;background:#BF0404;border-radius:999px;font-weight:600;font-size:13px;color:#fff;user-select:none}
.pm-share-edit .chip .x{width:16px;height:16px;cursor:pointer;background:url('/wp-content/plugins/plateforme-master/images/27)%20Icon-close-circle.png') center/16px 16px no-repeat;filter:brightness(200%)}

.pm-share-edit .file-import-section{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;padding-left:12px;background:#fff}
.pm-share-edit .file-import-section input[type="text"]{border:none;box-shadow:none;flex-grow:1;height:40px}
.pm-share-edit .btn-import{background:#A6A485;color:#fff;border:1px solid #DBD9C3;border-top-left-radius:0;border-bottom-left-radius:0;font-weight:600;padding:10px 16px;cursor:pointer}

.pm-share-edit .file-list{list-style:none;margin:12px 0 0;padding:0}
.pm-share-edit .file-item{display:flex;align-items:center;gap:10px;padding:6px 0}
.pm-share-edit .file-item .name{flex:1}
.pm-share-edit .file-item .rm{background:#dc3545;border:none;color:#fff;cursor:pointer;font-size:16px;padding:6px 9px;border-radius:16px}

.pm-share-edit .actions{display:flex;justify-content:flex-end;gap:10px;padding:16px 24px}
.pm-share-edit .btn{padding:10px 16px;border-radius:6px;font-weight:600;cursor:pointer;border:1px solid transparent}
.pm-share-edit .btn-outline{background:transparent;border-color:#c0392b;color:#c0392b}
.pm-share-edit .btn-outline:hover{background:#c0392b;color:#fff}
.pm-share-edit .btn-primary{background:#c0392b;border-color:#c0392b;color:#fff}
.pm-share-edit .btn-primary:hover{background:#a93226;border-color:#a93226}
.pm-share-edit .hint{font-size:13px;color:#6E6D55;margin-left:auto}

.pm-share-edit .info-header{
  position:relative;
  background:#fff;
  padding:16px 52px 16px 20px; /* on libère de la place à droite pour le bouton */
  border-bottom:1px solid #eee
}
.pm-share-edit .chev-btn{
  position:absolute; right:16px; top:50%; transform:translateY(-50%);
  width:28px; height:28px; border:1px solid #e0e0e0; border-radius:6px;
  background:#fff url("/wp-content/plugins/plateforme-master/images/icons/27)%20Icon-chevron-down.png") center/16px 16px no-repeat;
  cursor:pointer;
}
.pm-share-edit .chev-btn[aria-expanded="false"]{
  transform:translateY(-50%) rotate(-180deg); /* on “pointe” vers le haut quand c'est replié */
}

.pm-share-edit .info-body{overflow:hidden; transition:max-height .25s ease}
.pm-share-edit .info-body.is-collapsed{max-height:0; padding-top:0; padding-bottom:0}
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

<div class="pm-share-edit">
  <div class="info-container">
    <div id="statusBanner" ></div>

    <div class="info-card" id="viewCard">
  <div class="info-header">
    <h2>Informations générales</h2>
    <button type="button" class="chev-btn" id="detailsToggle" aria-expanded="true" aria-controls="viewBody"></button>
  </div>

  <!-- 👇 nouveau wrapper pour pouvoir tout replier -->
  <div class="info-body" id="viewBody">
    <ul class="info-list">
      <li class="info-item"><span class="info-item-label">Titre complet :</span><span class="info-item-value" id="pTitre">—</span></li>
      <li class="info-item"><span class="info-item-label">Doi :</span><span class="info-item-value" id="pDoi">—</span></li>
      <li class="info-item"><span class="info-item-label">Type de publication :</span><span class="info-item-value" id="pType">—</span></li>
      <li class="info-item"><span class="info-item-label">Auteur(s) :</span><span class="info-item-value" id="pAuteur">—</span></li>
      <li class="info-item"><span class="info-item-label">Date de soumission :</span><span class="info-item-value" id="pDate">—</span></li>
      <li class="info-item"><span class="info-item-label">Mots-clés :</span><span class="info-item-value" id="pKws">—</span></li>
      <li class="info-item"><span class="info-item-label">Statut actuel :</span><span class="info-item-value" id="pStatut">—</span></li>
      <li class="info-item"><span class="info-item-label">Nombre des pages :</span><span class="info-item-value" id="pPages">—</span></li>
      <li class="info-item"><span class="info-item-label">Résumé (Abstract) :</span><span class="info-item-value" id="pResume">—</span></li>
    </ul>

    <div class="section">
      <h3>Document associé</h3>
      <table class="doc-table">
        <thead><tr><th style="width:120px">Ref_Doc</th><th>fichier</th><th style="width:140px">Actions</th></tr></thead>
        <tbody id="topDocBody"><tr><td colspan="3" style="text-align:center;color:#6E6D55">Aucun fichier</td></tr></tbody>
      </table>
    </div>

    <div class="section">
      <h3>Commentaires du chercheur</h3>
      <div id="pComment" style="color:#333">—</div>
    </div>
  </div>
</div>


    <!-- ================= FORMULAIRE ================= -->
    <div class="form-container" id="formCard" style="margin-top:24px">
      <div class="bg"><h2>Informations générales</h2></div>
      <div class="form-section">
        <div class="row">
          <div>
            <label class="form-label" for="fPages">Nombre des pages</label>
            <input type="number" id="fPages" class="form-control" min="0" step="1" placeholder="0">
          </div>
          <div>
            <label class="form-label" for="fDate">Date de publication</label>
            <input type="date" id="fDate" class="form-control">
          </div>
        </div>

        <div class="row-1" style="margin-top:12px">
          <label class="form-label" for="fResume">Résumé</label>
          <textarea id="fResume" class="form-control" placeholder="Votre résumé…"></textarea>
        </div>

        <div class="row-1" style="margin-top:12px">
          <label class="form-label" for="kwInput">Mots clés</label>
          <div class="pill-input">
            <input type="text" id="kwInput" placeholder="Ajouter un mot clé (ex. AI)">
            <button id="kwAdd" type="button" title="Ajouter" class="add">
  <span class="icon-corner-up" aria-hidden="true"></span>
</button>

          </div>
          <div class="chips" id="kwChips"></div>
        </div>
      </div>

      <div class="bg"><h2>Documents associés</h2></div>
      <div class="form-section">
        <label class="form-label" for="fileFake">Pièces jointes</label>
        <div class="file-import-section">
          <input id="fileFake" type="text" class="form-control" placeholder="Importer">
          <button class="btn-import" type="button" id="btnImport">Importer</button>
          <input type="file" id="fileInput" multiple style="display:none" accept=".pdf,.doc,.docx,.ppt,.pptx">
        </div>
        <ul class="file-list" id="fileList"></ul>
      </div>

      <div class="bg"><h2>Commentaire complémentaire (optionnel)</h2></div>
      <div class="form-section">
        <label class="form-label" for="fComment">Commentaire</label>
        <textarea id="fComment" class="form-control" placeholder="Commentaire…"></textarea>
      </div>

      <div class="actions">
        <span class="hint" id="saveHint"></span>
        <button type="button" class="btn btn-outline" id="btnDraft">Enregistrer en brouillon</button>
        <button type="button" class="btn btn-primary" id="btnSubmit">Soumettre ma demande</button>
      </div>
    </div>
  </div>
</div>

<?php if (is_user_logged_in()): ?>
<script>
  window.PMSettings = Object.assign({}, window.PMSettings, {
    restUrl: <?php echo wp_json_encode( esc_url_raw( rest_url() ) ); ?>,
    nonce:   <?php echo wp_json_encode( wp_create_nonce('wp_rest') ); ?>,
  });
</script>
<?php endif; ?>

<script>
(function(){
  // ===== Config REST =====
  const REST  = (window.PMSettings?.restUrl || window.wpApiSettings?.root || '/wp-json/').replace(/\/$/,'');
  const NONCE = (window.PMSettings?.nonce   || window.wpApiSettings?.nonce || '');
  const API   = REST + '/plateforme-recherche/v1';

  // ===== Utils DOM =====
  const $ = (id)=>document.getElementById(id);
  const setTxt = (id,v)=>{ const el=$(id); if(el) el.textContent = (v ?? '—') || '—'; };

  // ===== Pub ID =====
  const qs = new URLSearchParams(location.search);
  const pubId = qs.get('id') || qs.get('publication_id');
  if(!pubId){ $('statusBanner').textContent = 'ID manquant dans l’URL (?id=...)'; return; }
  $('statusBanner').textContent = 'Chargement…';

  // ===== Fetch helpers =====
  async function jfetch(url,opt={}){
    const r = await fetch(url,{credentials:'same-origin',headers:{'Accept':'application/json', ...(NONCE?{'X-WP-Nonce':NONCE}:{})},...opt});
    if(!r.ok){ let m='HTTP '+r.status; try{ const j=await r.json(); m=j?.message||m;}catch{} throw new Error(m); }
    return r.json();
  }
  async function jput(url, body){
    const r = await fetch(url,{
      method:'PUT', credentials:'same-origin',
      headers:{'Accept':'application/json','Content-Type':'application/json', ...(NONCE?{'X-WP-Nonce':NONCE}:{})},
      body: JSON.stringify(body)
    });
    if(!r.ok){ let m='HTTP '+r.status; try{ const j=await r.json(); m=j?.message||m;}catch{} throw new Error(m); }
    return r.json();
  }

  // ===== Mots-clés (chips) =====
  const kwSet = new Set();
  function renderKW(){
    const box = $('kwChips'); box.innerHTML='';
    kwSet.forEach(k=>{
      const d = document.createElement('div');
      d.className='chip';
      d.innerHTML = `<span>${k}</span><span class="x" title="Retirer"></span>`;
      d.querySelector('.x').onclick = ()=>{ kwSet.delete(k); renderKW(); };
      box.appendChild(d);
    });
  }
  $('kwAdd').addEventListener('click', ()=>{
    const v = $('kwInput').value.trim(); if(!v) return;
    kwSet.add(v); $('kwInput').value=''; renderKW();
  });
  $('kwInput').addEventListener('keydown', e=>{
    if(e.key==='Enter'){ e.preventDefault();
      const v=e.target.value.trim(); if(v){ kwSet.add(v); e.target.value=''; renderKW(); }
    }
  });

  // ===== Fichiers =====
  const fileInput = $('fileInput'), fileList=$('fileList');
  $('btnImport').addEventListener('click', ()=> fileInput.click());
  $('fileFake').addEventListener('click', ()=> fileInput.click());
  function addFileToUI(file){
    const li = document.createElement('li'); li.className='file-item'; li.dataset.name=file.name; li._file=file;
    li.innerHTML = `
      <span style="width:18px;height:18px;background:url('/wp-content/plugins/plateforme-master/images/icons/upload-red.png') center/contain no-repeat;display:inline-block"></span>
      <span class="name">${file.name}</span>
      <button type="button" class="rm" title="Retirer">×</button>`;
    li.querySelector('.rm').onclick = ()=> li.remove();
    fileList.appendChild(li);
  }
  fileInput.addEventListener('change',(e)=>{
    for(const f of e.target.files){ addFileToUI(f); }
    fileInput.value='';
  });
  async function uploadAllSelectedFiles(){
    const items = [...fileList.querySelectorAll('.file-item')];
    if(!items.length) return [];
    const out = [];
    for(const li of items){
      const f = li._file; if(!f) continue; // déjà présent côté serveur s'il n'y a pas _file
      const fd = new FormData(); fd.append('file', f, f.name);
      const r = await fetch(REST+'/wp/v2/media',{method:'POST',body:fd,credentials:'same-origin',headers: NONCE?{'X-WP-Nonce':NONCE}:{}});      
      if(!r.ok){ let m='Upload échoué'; try{const j=await r.json(); m=j?.message||m;}catch{} throw new Error(m); }
      const media = await r.json();
      out.push({ original_name: f.name, storage_path: media?.source_url || '' });
      delete li._file; // marqué comme uploadé
    }
    return out;
  }

  // ===== Chargement (la bonne route) =====
  async function load(){
    // 👉 utilise la route my-share
    const data = await jfetch(`${API}/publication/${pubId}/my-share`)
    $('statusBanner').textContent = '';

    const p = data?.publication || {};
    const s = data?.my_share || {};

    // Haut de page — ids existants dans ton HTML
    setTxt('pTitre',   p.titre);
    setTxt('pDoi',     p.doi);
    setTxt('pType',    p.type);
    setTxt('pAuteur',  p.auteur_display_name);
    setTxt('pDate',    p.date_publication);
    setTxt('pKws',     (s?.keywords && s.keywords.length)? s.keywords.join(', ') : '—');
    setTxt('pStatut',  p.statut);
    setTxt('pPages',   p.nb_pages ?? '—');
    setTxt('pResume',  p.resume || '—');
    $('pComment').textContent = p.commentaire || '—';

    // Table des fichiers (ma part)
    const tb = $('topDocBody'); tb.innerHTML='';
    const files = Array.isArray(s?.files) ? s.files : [];
    if(!files.length){
      tb.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#6E6D55">Aucun fichier</td></tr>`;
    }else{
      files.forEach((f, idx)=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${String(idx+1).padStart(3,'0')}</td>
          <td>${f.original_name || ''}</td>
          <td><a class="dl" href="${f.storage_path||'#'}" target="_blank" rel="noopener">
                <span class="icon"></span><span>Télécharger</span>
              </a></td>`;
        tb.appendChild(tr);
      });
    }

    // Formulaire : toujours vierge à l'ouverture
$('fResume').value = '';
$('fPages').value  = '';
$('fDate').value   = '';
kwSet.clear();
renderKW();
// ⚠️ on n'ajoute PAS les fichiers existants dans fileList (ils restent visibles seulement en haut)

  }

  // ===== Enregistrement (même route my-share) =====
  async function save(isDraft=false){
    $('saveHint').textContent = 'Enregistrement…';
    $('btnDraft').disabled = true; $('btnSubmit').disabled = true;
    try{
      const newFiles = await uploadAllSelectedFiles();
      const payload = {
        resume: $('fResume').value,
        nb_pages: (parseInt($('fPages').value||'0',10) || null),
        date_publication: $('fDate').value || null,
        keywords: Array.from(kwSet),
        files: newFiles
      };
// ✅ bon endpoint :
await jput(`${API}/publication/${pubId}/my-share`, payload);
      $('saveHint').textContent = isDraft ? 'Brouillon enregistré ✔' : 'Enregistré ✔';
      if(newFiles.length){ load().catch(()=>{}); }
    }catch(e){
      $('saveHint').textContent = 'Erreur : ' + (e.message||'');
    }finally{
      $('btnDraft').disabled = false; $('btnSubmit').disabled = false;
    }
  }

  $('btnDraft').addEventListener('click', ()=> save(true));
  $('btnSubmit').addEventListener('click', ()=> save(false));

  // ===== Pliage/ dépliage du bloc haut
  const body = $('viewBody');
  const tog  = $('detailsToggle');
  const LSKEY = 'pm_share_details_open';
  let open = (localStorage.getItem(LSKEY) ?? '1') === '1';

  function applyOpenState(){
    tog.setAttribute('aria-expanded', String(open));
    if(open){
      body.classList.remove('is-collapsed');
      body.style.maxHeight = body.scrollHeight + 'px';
    }else{
      body.classList.add('is-collapsed');
      body.style.maxHeight = '0px';
    }
  }
  tog.addEventListener('click', ()=>{
    open = !open;
    localStorage.setItem(LSKEY, open ? '1' : '0');
    applyOpenState();
  });
  applyOpenState();

  // ===== Go
  load().catch(err=>{
    $('statusBanner').textContent = 'Erreur de chargement : ' + (err.message||'');
  });
})();
</script>
