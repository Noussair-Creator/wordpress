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
.pm-share-edit{font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
.pm-share-edit *{box-sizing:border-box}

/* Cartes infos */
.pm-share-edit .card{background:#fff;border:1px solid #e0e0e0;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05);overflow:hidden}
.pm-share-edit .card-hd{background:#fff;padding:16px 20px;border-bottom:1px solid #eee;position:relative}
.pm-share-edit .card-hd h2{margin:0;font-size:18px;font-weight:700;color:#333}

.pm-share-edit .list{list-style:none;margin:0;padding:0 20px 16px}
.pm-share-edit .row{display:grid;grid-template-columns:minmax(180px,260px) 1fr;gap:18px;padding:10px 0;border-bottom:1px dashed #eee}
.pm-share-edit .row:last-child{border-bottom:none}
.pm-share-edit .lab{color:#6E6D55;font-weight:600}
.pm-share-edit .val{color:#333;word-break:break-word}

/* Sections */
.pm-share-edit .section{padding:16px 20px}
.pm-share-edit .section h3{margin:0 0 8px;font-size:16px;font-weight:700;color:#333}

/* Table docs */
.pm-share-edit .tbl{width:100%;border-collapse:collapse}
.pm-share-edit .tbl th,.pm-share-edit .tbl td{border:1px solid #eee;padding:10px 12px;text-align:center;font-size:14px}
.pm-share-edit .tbl th{background:#f7f6f1;color:#333}
.pm-share-edit .dl{display:inline-flex;align-items:center;gap:6px;text-decoration:none}
.pm-share-edit .dl .ico{width:18px;height:18px;background:url('/wp-content/plugins/plateforme-master/images/icons/upload-red.png') center/contain no-repeat;display:inline-block;filter:hue-rotate(180deg)}

/* Form */
.pm-share-edit .form{background:#FAFAF8;border:1px solid #e0e0e0;border-radius:10px;margin-top:22px;box-shadow:0 4px 12px rgba(0,0,0,.05)}
.pm-share-edit .bg{background:#fff;box-shadow:0 8px 12px -9px rgba(0,0,0,.2);padding:0 24px}
.pm-share-edit .bg h2{font-size:18px;font-weight:700;margin:0;padding:16px 0;color:#333}
.pm-share-edit .pad{padding:16px 24px}

.pm-share-edit .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.pm-share-edit .grid-1{display:grid;grid-template-columns:1fr}
.pm-share-edit .label{font-weight:600;color:#6E6D55;margin-bottom:6px;display:block}
.pm-share-edit .ctrl{border-radius:6px;border:1px solid #DBD9C3;padding:10px;background:#fff;width:100%}
.pm-share-edit textarea.ctrl{min-height:110px;resize:vertical}

/* Chips mots-clés */
.pm-share-edit .pill{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;height:42px;padding:0 10px;gap:8px;background:#fff}
.pm-share-edit .pill input{flex:1;border:none;outline:none;height:100%;font-size:14px;background:transparent}
.pm-share-edit .chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}
.pm-share-edit .chip{display:inline-flex;align-items:center;gap:6px;padding:8px 12px;background:#BF0404;border-radius:999px;font-weight:600;font-size:13px;color:#fff;user-select:none}
.pm-share-edit .chip .x{width:16px;height:16px;cursor:pointer;background:url('/wp-content/plugins/plateforme-master/images/27)%20Icon-close-circle.png') center/16px 16px no-repeat;filter:brightness(200%)}

/* Import fichiers */
.pm-share-edit .import{display:flex;align-items:center;border:1px solid #DBD9C3;border-radius:6px;padding-left:12px;background:#fff}
.pm-share-edit .import input[type="text"]{border:none;box-shadow:none;flex-grow:1;height:40px}
.pm-share-edit .btn-import{background:#A6A485;color:#fff;border:1px solid #DBD9C3;border-top-left-radius:0;border-bottom-left-radius:0;font-weight:600;padding:10px 16px;cursor:pointer}

.pm-share-edit .files{list-style:none;margin:12px 0 0;padding:0}
.pm-share-edit .file{display:flex;align-items:center;gap:10px;padding:6px 0}
.pm-share-edit .file .name{flex:1}
.pm-share-edit .file .rm{background:#dc3545;border:none;color:#fff;cursor:pointer;font-size:16px;padding:6px 9px;border-radius:16px}

/* Actions */
.pm-share-edit .actions{display:flex;justify-content:flex-end;gap:10px;padding:16px 24px}
.pm-share-edit .btn{padding:10px 16px;border-radius:6px;font-weight:600;cursor:pointer;border:1px solid transparent}
.pm-share-edit .btn-outline{background:transparent;border-color:#c0392b;color:#c0392b}
.pm-share-edit .btn-outline:hover{background:#c0392b;color:#fff}
.pm-share-edit .btn-primary{background:#c0392b;border-color:#c0392b;color:#fff}
.pm-share-edit .btn-primary:hover{background:#a93226;border-color:#a93226}
.pm-share-edit .hint{font-size:13px;color:#6E6D55;margin-left:auto}

/* Chevron repli */
.pm-share-edit .chev{
  position:absolute; right:16px; top:50%; transform:translateY(-50%);
  width:28px; height:28px; border:1px solid #e0e0e0; border-radius:6px;
  background:#fff url("/wp-content/plugins/plateforme-master/images/icons/27)%20Icon-chevron-down.png") center/16px 16px no-repeat;
  cursor:pointer;
}
.pm-share-edit .chev[aria-expanded="false"]{ transform:translateY(-50%) rotate(-180deg); }
.pm-share-edit .body{overflow:hidden; transition:max-height .25s ease}
.pm-share-edit .body.is-collapsed{max-height:0; padding-top:0; padding-bottom:0}

/* icone add */
.icon-corner-up{display:inline-block;width:16px;height:16px;background:url('/wp-content/plugins/plateforme-master/images/27%29%20Icon-corner-right-up.png') center/16px 16px no-repeat;filter:brightness(200%);transition:transform .15s ease}
.pill .add:hover .icon-corner-up{ transform: translate(1px,-1px) rotate(25deg) }
.pill .add{ border:none;background:transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;padding:0 }
</style>

<div class="pm-share-edit">
  <div id="statusBanner"></div>

  <!-- ===== Bloc haut : infos de la publication (créateur) + base keywords/files ===== -->
  <div class="card" id="cardTop">
    <div class="card-hd">
      <h2>Informations générales</h2>
      <button type="button" class="chev" id="btnToggle" aria-expanded="true" aria-controls="topBody"></button>
    </div>
    <div class="body" id="topBody">
      <ul class="list">
        <li class="row"><span class="lab">Titre complet :</span><span class="val" id="pTitre">—</span></li>
        <li class="row"><span class="lab">DOI :</span><span class="val" id="pDoi">—</span></li>
        <li class="row"><span class="lab">Type :</span><span class="val" id="pType">—</span></li>
        <li class="row"><span class="lab">Auteur :</span><span class="val" id="pAuteur">—</span></li>
        <li class="row"><span class="lab">Date de soumission :</span><span class="val" id="pDate">—</span></li>
        <li class="row"><span class="lab">Mots-clés :</span><span class="val" id="pBaseKws">—</span></li>
        <li class="row"><span class="lab">Statut :</span><span class="val" id="pStatut">—</span></li>
        <li class="row"><span class="lab">Nombre de pages :</span><span class="val" id="pPages">—</span></li>
        <li class="row"><span class="lab">Résumé :</span><span class="val" id="pResume">—</span></li>
      </ul>

      <div class="section">
        <h3>Documents associés</h3>
        <table class="tbl">
          <thead><tr><th style="width:120px">Ref_Doc</th><th>Fichier</th><th style="width:160px">Actions</th></tr></thead>
          <tbody id="baseDocBody"><tr><td colspan="3" style="text-align:center;color:#6E6D55">Aucun fichier</td></tr></tbody>
        </table>
      </div>

      <div class="section">
        <h3>Commentaires du créateur</h3>
        <div id="pComment" style="color:#333">—</div>
      </div>

      <div class="section" id="myExistingFilesWrap" style="display:none">
        <h3>Mes fichiers existants</h3>
        <table class="tbl">
          <thead><tr><th style="width:120px">Ref_Doc</th><th>Fichier</th><th style="width:220px">Actions</th></tr></thead>
          <tbody id="myDocBody"></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ===== Formulaire : MA PART ===== -->
  <div class="form" id="formCard" style="margin-top:24px">
    <div class="bg"><h2>Informations générales</h2></div>
    <div class="pad">
      <div class="grid-2">
        <div>
          <label class="label" for="fPages">Nombre des pages</label>
          <input type="number" id="fPages" class="ctrl" min="0" step="1" placeholder="0">
        </div>
        <div>
          <label class="label" for="fDate">Date de publication</label>
          <input type="date" id="fDate" class="ctrl">
        </div>
      </div>

      <div class="grid-1" style="margin-top:12px">
        <label class="label" for="fResume">Résumé</label>
        <textarea id="fResume" class="ctrl" placeholder="Votre résumé…"></textarea>
      </div>
<div class="row-1" style="margin-top:12px">
  <label class="form-label" for="fSummaryEn">Summary</label>
  <textarea id="fSummaryEn" class="form-control" placeholder=""></textarea>
</div>
      <div class="grid-1" style="margin-top:12px">
        <label class="label" for="kwInput">Mots-clés</label>
        <div class="pill">
          <input type="text" id="kwInput" placeholder="Ajouter un mot clé (ex. AI)">
          <button id="kwAdd" type="button" title="Ajouter" class="add"><span class="icon-corner-up" aria-hidden="true"></span></button>
        </div>
        <div class="chips" id="kwChips"></div>
      </div>
    </div>

    <div class="bg"><h2>Documents </h2></div>
    <div class="pad">
      <label class="label" for="fileFake">Pièces jointes</label>
      <div class="import">
        <input id="fileFake" type="text" class="ctrl" placeholder="Importer">
        <button class="btn-import" type="button" id="btnImport">Importer</button>
        <input type="file" id="fileInput" multiple style="display:none" accept=".pdf,.doc,.docx,.ppt,.pptx">
      </div>
      <ul class="files" id="fileList"></ul>
    </div>

    <div class="bg"><h2>Commentaire </h2></div>
    <div class="pad">
      <textarea id="fComment" class="ctrl" placeholder="" ></textarea>
    </div>

    <div class="actions">
      <span class="hint" id="saveHint"></span>
      <button type="button" class="btn btn-outline" id="btnDraft">Enregistrer en brouillon</button>
      <button type="button" class="btn btn-primary" id="btnSubmit">Soumettre ma demande</button>
    </div>
  </div>
</div>

<?php if (is_user_logged_in()): ?>
<script>
  window.PMSettings = Object.assign({}, window.PMSettings, {
    restUrl: <?php echo wp_json_encode( esc_url_raw( rest_url() ) ); ?>,
    nonce:   <?php echo wp_json_encode( wp_create_nonce('wp_rest') ); ?>,
    redirectAfterShareSave: <?php echo wp_json_encode( esc_url_raw( home_url('/publication') ) ); ?> // << ajout

  });
</script>
<?php endif; ?>

<script>
(function(){
  /* ===== REST ===== */
  const REST  = (window.PMSettings?.restUrl || window.wpApiSettings?.root || '/wp-json/').replace(/\/$/,'');
  const NONCE = (window.PMSettings?.nonce   || window.wpApiSettings?.nonce || '');
  const API   = REST + '/plateforme-recherche/v1';

  /* ===== DOM helpers ===== */
  const $ = (id)=>document.getElementById(id);
  const setTxt = (id,v)=>{ const el=$(id); if(el) el.textContent = (v ?? '—') || '—'; };

  /* ===== Pub ID ===== */
  const qs = new URLSearchParams(location.search);
  const pubId = qs.get('id') || qs.get('publication_id');
  if(!pubId){ $('statusBanner').textContent = 'ID manquant dans l’URL (?id=...)'; return; }
  $('statusBanner').textContent = 'Chargement…';

  /* ===== fetch wrappers ===== */
  async function jfetch(url,opt={}){
    const r = await fetch(url,{credentials:'same-origin',headers:{'Accept':'application/json', ...(NONCE?{'X-WP-Nonce':NONCE}:{})},...opt});
    if(!r.ok){ let m='HTTP '+r.status; try{ const j=await r.json(); m=j?.message||m;}catch{} throw new Error(m); }
    return r.json();
  }
  function addExistingShareFileToUI(f) {
  const li = document.createElement('li');
  li.className = 'file';
  li.dataset.fileId = String(f.id);
  li.innerHTML = `
    <span style="width:18px;height:18px;background:url('/wp-content/plugins/plateforme-master/images/icons/upload-red.png') center/contain no-repeat;display:inline-block"></span>
    <span class="name">${f.original_name || ''}</span>
    <button type="button" class="rm" title="Supprimer ce fichier">×</button>`;
  li.querySelector('.rm').onclick = () => {
    const fid = parseInt(li.dataset.fileId || '0', 10);
    if (!isNaN(fid) && fid > 0) myFileIdsToDelete.add(fid);
    li.remove();
  };
  fileList.appendChild(li);
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

  /* ===== chips mots-clés (ma part) ===== */
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

  /* ===== fichiers (nouveaux de ma part) ===== */
  const fileInput = $('fileInput'), fileList=$('fileList');
  $('btnImport').addEventListener('click', ()=> fileInput.click());
  $('fileFake').addEventListener('click', ()=> fileInput.click());

  function addFileToUI(file){
    const li = document.createElement('li'); li.className='file'; li.dataset.name=file.name; li._file=file;
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
    const items = [...fileList.querySelectorAll('.file')];
    if(!items.length) return [];
    const out = [];
    for(const li of items){
      const f = li._file; if(!f) continue; // déjà uploadé si _file absent
      const fd = new FormData(); fd.append('file', f, f.name);
      const r = await fetch(REST+'/wp/v2/media',{method:'POST',body:fd,credentials:'same-origin',headers: NONCE?{'X-WP-Nonce':NONCE}:{}});      
      if(!r.ok){ let m='Upload échoué'; try{const j=await r.json(); m=j?.message||m;}catch{} throw new Error(m); }
      const media = await r.json();
      out.push({ original_name: f.name, storage_path: media?.source_url || '' });
      delete li._file; // marqué uploadé
    }
    return out;
  }

  /* ===== suppression fichiers EXISTANTS de ma part ===== */
  const myFileIdsToDelete = new Set();

  /* ===== LOAD =====
     On lit /publication/{id}/my-share :
     - publication.base_* = données du créateur (bloc haut)
     - my_share = MA part (préremplissage + tableau “mes fichiers existants”) */
  async function load(){
    const data = await jfetch(`${API}/publication/${pubId}/my-share`);
    $('statusBanner').textContent = '';

    const p = data?.publication || {};
    const s = data?.my_share || {};

    /* haut = publication (base) */
    setTxt('pTitre',   p.titre);
    setTxt('pDoi',     p.doi);
    setTxt('pType',    p.type);
    setTxt('pAuteur',  p.auteur_display_name);
    setTxt('pDate',    p.date_publication);
    setTxt('pStatut',  p.viewer_statut || p.statut);
    setTxt('pPages',   p.nb_pages ?? '—');
    setTxt('pResume',  p.resume || '—');
    $('pComment').textContent = p.commentaire || '—';

    /* mots-clés & fichiers BASE (créateur) */
    const baseKws = Array.isArray(p.base_keywords) ? p.base_keywords : [];
    setTxt('pBaseKws', baseKws.length ? baseKws.join(', ') : '—');

    const baseTb = $('baseDocBody'); baseTb.innerHTML='';
    const baseFiles = Array.isArray(p.base_files) ? p.base_files : [];
    if(!baseFiles.length){
      baseTb.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#6E6D55">Aucun fichier</td></tr>`;
    }else{
      baseFiles.forEach((f, idx)=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${String(idx+1).padStart(3,'0')}</td>
          <td>${f.original_name || ''}</td>
          <td><a class="dl" href="${f.storage_path||'#'}" target="_blank" rel="noopener"><span class="ico"></span><span>Télécharger</span></a></td>`;
        baseTb.appendChild(tr);
      });
    }

    /* mes fichiers existants (MA part) => avec boutons Supprimer */
    const myWrap = $('myExistingFilesWrap');
    const myTb = $('myDocBody'); myTb.innerHTML=''; myFileIdsToDelete.clear();
    const myFiles = Array.isArray(s?.files) ? s.files : [];
    if (myFiles.length){
      myWrap.style.display = '';
      myFiles.forEach((f, idx)=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${String(idx+1).padStart(3,'0')}</td>
          <td>${f.original_name || ''}</td>
          <td>
            <a class="dl" href="${f.storage_path||'#'}" target="_blank" rel="noopener"><span class="ico"></span><span>Télécharger</span></a>
            <button type="button" data-id="${f.id}" class="rm-share-file" style="margin-left:8px">Supprimer (ma part)</button>
          </td>`;
        myTb.appendChild(tr);
      });
      myTb.querySelectorAll('.rm-share-file').forEach(btn=>{
        btn.onclick = ()=>{
          const id = parseInt(btn.dataset.id,10);
          if (!isNaN(id)) { myFileIdsToDelete.add(id); btn.closest('tr')?.remove(); }
        };
      });
    } else {
      myWrap.style.display = 'none';
    }// Repeupler aussi la liste sous le champ (pour rester visibles après un Save)
fileList.innerHTML = '';
myFiles.forEach(f => addExistingShareFileToUI(f));


   /* Pré-remplir mon formulaire (MA part) */
$('fResume').value = s?.resume || '';
$('fPages').value  = (s?.nb_pages ?? '') || '';
$('fDate').value   = s?.date_publication || '';
$('fSummaryEn').value = s?.summary_en || '';
// ...dans load()
$('fComment').value = s?.commentaire || '';


kwSet.clear();
// IMPORTANT : n'afficher que les mots-clés propres à Sarah (exclure les base keywords de la publication)
const onlyMine = Array.isArray(s?.keywords)
  ? s.keywords.filter(k => !(baseKws || []).includes(String(k)))
  : [];
onlyMine.forEach(k => kwSet.add(k));
renderKW();


 
  }

  /* ===== SAVE : uniquement my-share ===== */
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
      files: newFiles,
      file_ids_delete: Array.from(myFileIdsToDelete),
      summary_en: $('fSummaryEn').value || null,
      commentaire: $('fComment').value || '' 
    };

    await jput(`${API}/publication/${pubId}/my-share`, payload);
    myFileIdsToDelete.clear();

    if (isDraft) {
      $('saveHint').textContent = 'Brouillon enregistré ✔';
      // on reste sur la page en mode brouillon
      // si tu veux rafraîchir les tableaux des fichiers existants uniquement:
      if (newFiles.length || payload.file_ids_delete.length){ load().catch(()=>{}); }
    } else {
      // $('saveHint').textContent = 'Enregistré ✔ redirection…';
      const to = (window.PMSettings && PMSettings.redirectAfterShareSave) || '/publication/';
      // petite latence pour laisser le message s’afficher
      setTimeout(()=>{ window.location.assign(to); }, 400);
    }
  }catch(e){
    $('saveHint').textContent = 'Erreur : ' + (e.message||'');
  }finally{
    $('btnDraft').disabled = false; $('btnSubmit').disabled = false;
  }
}

  $('btnDraft').addEventListener('click', ()=> save(true));
  $('btnSubmit').addEventListener('click', ()=> save(false));

  /* ===== Repli bloc haut ===== */
  const body = $('topBody');
  const tog  = $('btnToggle');
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

  /* ===== GO ===== */
  load().catch(err=>{
    $('statusBanner').textContent = 'Erreur de chargement : ' + (err.message||'');
  });
})();
</script>
