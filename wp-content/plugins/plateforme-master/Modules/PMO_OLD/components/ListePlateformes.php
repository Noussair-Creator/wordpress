<section id="pf-list">
  <style>
    #pf-list{font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif}
    #pf-list{ --ink:#2A2916; --muted:#6E6D55; --edge:#ECEBE3; --line:#EBE9D7; --danger:#BF0404; --olive:#A6A485; }

    .pf-card{background:#fff;border-radius:10px;box-shadow:0 3px 22px #0000000F;padding:14px 16px 56px;position:relative}

    /* ===== Head ===== */
    .pf-head{display:flex;align-items:center;gap:10px}
    .pf-head-left{display:flex;align-items:center;gap:10px}
    .pf-ico{width:26px;height:26px;object-fit:contain}
    .pf-title{margin:0;font:700 18px/1 Roboto;color:var(--ink)}
    .pf-btn-primary{margin-left:auto;background:var(--danger);color:#fff;border:none;border-radius:6px;height:38px;padding:0 14px;font:700 13px/1 Roboto;cursor:pointer}
    .pf-sep{border:0;border-top:1px solid var(--edge);margin:10px 0 12px}

    /* ===== Toolbar ===== */
    .pf-toolbar{display:flex;align-items:center;justify-content:space-between;gap:10px}
    .pf-toolbar-left{display:flex;align-items:center;gap:10px}
    .pf-toolbar-right{display:flex;align-items:center;gap:8px}

    .pf-search{width:250px;height:36px;border:1px solid #DBD9C3;border-radius:6px;position:relative;background:#fff}
    .pf-search input{width:100%;height:100%;padding:0 36px 0 12px;border:0;outline:0;background:transparent;font:400 14px Roboto}
    .pf-search svg{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:18px;height:18px}

    .pf-select{height:36px;min-width:160px;border:1px solid #DBD9C3;border-radius:6px;background:#fff;padding:0 36px 0 10px;font:400 14px Roboto;appearance:none;position:relative}
    .pf-select-wrap{position:relative}
    .pf-select-wrap::after{
      content:"";position:absolute;right:0;top:0;width:36px;height:100%;
      background:#fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%236E6D55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>') center/16px 16px no-repeat;
      border:1px solid #DBD9C3;border-left:0;border-radius:0 6px 6px 0;pointer-events:none
    }

    .pf-btn-square{width:38px;height:38px;border-radius:6px;border:none;background:#fff;box-shadow:0 0 6px #00000030;display:grid;place-items:center;cursor:pointer}
    .pf-btn-square img{width:18px;height:18px}

    /* ===== Table ===== */
    .pf-table-wrap{margin-top:8px}
    .pf-headbox{background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;overflow:hidden}
    .pf-table,.pf-table-head{width:100%;border-collapse:separate;border-spacing:0;table-layout:fixed;color:var(--ink);font-size:14px}
    col.c-ck{width:4%} col.c-name{width:32%} col.c-resp{width:24%} col.c-dom{width:20%} col.c-date{width:14%} col.c-act{width:6%}
    .pf-table-head th{padding:10px;text-align:left;font:700 14px Roboto}
    .pf-table-head th:first-child{text-align:center}
    .pf-bodybox{border:2px solid var(--line);border-radius:8px;overflow:visible;background:#fff;margin-top:10px}
    .pf-table td{padding:10px;border-top:1px solid var(--edge);vertical-align:middle;background:#fff}
    .pf-table tr:first-child td{border-top:none}
    .pf-table td+td{border-left:1px solid var(--edge)}
    .pf-name a{color:var(--ink);text-decoration:none}

    /* ===== Actions ⋯ ===== */
    .pf-actions-cell{position:relative;text-align:center;overflow:visible}
    .pf-dots{width:28px;height:28px;border-radius:6px;border:1px solid transparent;background:transparent;cursor:pointer;font-size:22px;line-height:26px}
    .pf-dots:hover{background:#f7f6f1;border-color:#e8e3cf}
    .pf-menu{
      position:absolute;top:30px;right:0;
      background:#fff;border:1px solid #E6E4D8;border-radius:10px;
      box-shadow:0 8px 24px rgba(0,0,0,.12);
      display:none;min-width:160px;padding:6px;z-index:1000;text-align:left;
    }
    .pf-menu a{display:block;padding:10px 12px;border-radius:8px;text-decoration:none;color:var(--ink);font:500 13px Roboto}
    .pf-menu a:hover{background:#F7F6F2}

    /* ===== Pagination ===== */
    .pf-pager{position:absolute;right:16px;bottom:12px;display:flex;align-items:center;gap:12px}
    .pf-page-btn{width:27px;height:27px;border:2px solid var(--danger);border-radius:3px;background:#fff;color:#BF0404;font-weight:700;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer}
    .pf-page-num{min-width:20px;text-align:center;font:600 14px/1 Roboto;color:#010103}

    /* ===== Offcanvas (Add) ===== */
    .pf-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:.2s;z-index:9998}
    .pf-overlay.open{opacity:1;pointer-events:auto}
    .pf-sb{position:fixed;top:0;right:0;width:480px;max-width:95vw;height:100vh;background:#fff;box-shadow:-7px 0 36px #00000029;transform:translateX(110%);transition:.25s;z-index:9999;display:flex;flex-direction:column}
    .pf-sb.open{transform:translateX(0)}
    .pf-sb-head{height:60px;background:#fff;box-shadow:0 5px 16px #00000029;display:flex;align-items:center;justify-content:space-between;padding:10px 14px}
    .pf-sb-title{font:700 15px/1 Roboto;color:var(--ink)}
    .pf-sb-save{height:34px;padding:0 14px;border:none;border-radius:6px;background:var(--danger);color:#fff;font:700 13px Roboto;cursor:pointer}
    .pf-sb-body{padding:16px 18px;overflow:auto}
    .pf-field{margin-bottom:14px}
    .pf-label{display:block;margin:0 0 6px;font:700 12px/1 Roboto;color:var(--muted)}
    .pf-input,.pf-textarea,.pf-select2{width:100%;border:1px solid #DBD9C3;border-radius:6px;background:#fff;font:400 14px Roboto;color:var(--ink);box-sizing:border-box}
    .pf-input{height:36px;padding:0 10px}
    .pf-textarea{min-height:110px;padding:10px;resize:vertical}

    /* Selects offcanvas */
    .pf-select-wrap2{position:relative}
    .pf-select2{height:36px;padding:0 10px;appearance:auto;-webkit-appearance:auto;-moz-appearance:auto;background:#fff}

    /* Input lien — icône à droite */
    .pf-input.addon-right{
      padding-right:44px;
      background-image:url('/wp-content/plugins/plateforme-master/images/pmo/27)%20Icon-globe-2.png');
      background-repeat:no-repeat;background-position:right 10px center;background-size:18px 18px;
    }

    /* ===== Documents Associés ===== */
    .pf-file-group{display:block}
    .pf-file-row{display:flex;align-items:stretch;gap:0}
    .pf-file-input{flex:1;height:36px;margin:0;border-right:0;border-radius:6px 0 0 6px}
    .pf-import-btn{
      display:inline-flex;align-items:center;justify-content:center;
      height:36px;min-width:110px;padding:0 14px;margin:0;
      border:1px solid #DBD9C3;border-left:0;border-radius:0 6px 6px 0;
      background:var(--olive);color:#fff;font:700 13px Roboto;cursor:pointer;line-height:1;
    }
    .pf-file-input:focus{outline:none;box-shadow:0 0 0 2px rgba(166,164,133,.25)}

    /* ===== Responsive ===== */
    @media (max-width:720px){
      .pf-toolbar{flex-direction:column;align-items:stretch}
      .pf-toolbar-left{width:100%}
      .pf-search{flex:1}
      .pf-toolbar-right{align-self:flex-end}
    }
  </style>

  <div class="pf-card">
    <!-- Header : titre à gauche, bouton à droite -->
    <div class="pf-head">
      <div class="pf-head-left">
        <img class="pf-ico" src="/wp-content/plugins/plateforme-master/images/pmo/16406436.png" alt="">
        <h3 class="pf-title">Liste des plateformes</h3>
      </div>
      <button id="pf-add" class="pf-btn-primary" type="button">Ajouter une plateforme</button>
    </div>

    <hr class="pf-sep">

    <!-- Toolbar : gauche (recherche + select), droite (filtre + download) -->
    <div class="pf-toolbar">
      <div class="pf-toolbar-left">
        <label class="pf-search">
          <input id="pf-q" type="text" placeholder="Recherche">
          <svg viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a" stroke-width="2" stroke-linecap="round"/></svg>
        </label>

        <div class="pf-select-wrap">
          <select id="pf-resp" class="pf-select">
            <option value="">Responsable</option>
            <option>Dr. Dupont</option>
            <option>Mme Ali</option>
          </select>
        </div>
      </div>

      <div class="pf-toolbar-right">
        <button class="pf-btn-square" type="button" title="Filtrer">
          <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-funnel.png" alt="Filtre">
        </button>
        <button class="pf-btn-square" type="button" title="Télécharger / Export">
          <img src="/wp-content/plugins/plateforme-master/images/icon etudiant/upload-red.png" alt="Téléchargement">
        </button>
      </div>
    </div>

    <!-- Head de table -->
    <div class="pf-table-wrap pf-headbox">
      <table class="pf-table-head" aria-hidden="true">
        <colgroup><col class="c-ck"><col class="c-name"><col class="c-resp"><col class="c-dom"><col class="c-date"><col class="c-act"></colgroup>
        <thead>
          <tr>
            <th style="text-align:center"><input type="checkbox"></th>
            <th>Nom de la plateforme</th>
            <th>Responsable</th>
            <th>Domaine</th>
            <th>Date de mise à jour</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <!-- Corps -->
    <div class="pf-table-wrap pf-bodybox">
      <table class="pf-table" id="pf-table">
        <colgroup><col class="c-ck"><col class="c-name"><col class="c-resp"><col class="c-dom"><col class="c-date"><col class="c-act"></colgroup>
        <tbody id="pf-tbody"><!-- JS --></tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="pf-pager">
      <button class="pf-page-btn" title="Première page">&laquo;</button>
      <button class="pf-page-btn" title="Précédent">&lsaquo;</button>
      <span class="pf-page-num">2</span>
      <button class="pf-page-btn" title="Suivant">&rsaquo;</button>
      <button class="pf-page-btn" title="Dernière page">&raquo;</button>
    </div>
  </div>

  <!-- ===== OFFCANVAS : Ajouter une plateforme ===== -->
  <div class="pf-overlay" id="pf-ov"></div>
  <aside class="pf-sb" id="pf-sb" aria-hidden="true">
    <div class="pf-sb-head">
      <div class="pf-sb-title">Ajouter une plateforme</div>
      <button id="pf-save" class="pf-sb-save" type="button">Enregistrer</button>
    </div>

    <div class="pf-sb-body">
      <div class="pf-field">
        <label class="pf-label">Nom De La Plateforme</label>
        <input class="pf-input" type="text" placeholder="">
      </div>

      <div class="pf-field pf-select-wrap2">
        <label class="pf-label">Responsable</label>
        <select class="pf-select2">
          <option value=""></option>
          <option>Dr. Dupont</option>
          <option>Mme Ali</option>
        </select>
      </div>

      <div class="pf-field pf-select-wrap2">
        <label class="pf-label">Domaine</label>
        <select class="pf-select2">
          <option value=""></option>
          <option>Energie</option>
          <option>Santé</option>
        </select>
      </div>

      <div class="pf-field">
        <label class="pf-label">Description Détaillée</label>
        <textarea class="pf-textarea"></textarea>
      </div>

      <div class="pf-field">
        <label class="pf-label">Lien Externe / Site Dédié</label>
        <input class="pf-input addon-right" type="url" placeholder="">
      </div>

      <!-- Documents Associés -->
      <div class="pf-field pf-file-group">
        <label class="pf-label">Documents Associés</label>
        <div class="pf-file-row">
          <input id="pf-file-text" class="pf-input pf-file-input" type="text" placeholder="" readonly>
          <button class="pf-import-btn" type="button" id="pf-import">Importer</button>
        </div>
        <input id="pf-file" type="file" hidden>
      </div>
    </div>
  </aside>

  <script>
  (function(){
    const root   = document.getElementById('pf-list');
    const tbody  = root.querySelector('#pf-tbody');
    const q      = root.querySelector('#pf-q');
    const addBtn = root.querySelector('#pf-add');
    const ov     = root.querySelector('#pf-ov');
    const sb     = root.querySelector('#pf-sb');
    const file   = root.querySelector('#pf-file');
    const fileText = root.querySelector('#pf-file-text');

    const DATA = [
      { name:'Plateforme A', resp:'Dr. Dupont', dom:'Energie', date:'15/08/2025' },
      { name:'Plateforme B', resp:'Mme Ali',    dom:'Santé',   date:'15/08/2025' },
    ];
    let CURRENT = [...DATA];

    function row(d,i){
      return `
        <tr>
          <td style="text-align:center"><input type="checkbox"></td>
          <td class="pf-name"><a href="#">${d.name}</a></td>
          <td>${d.resp}</td>
          <td>${d.dom}</td>
          <td>${d.date}</td>
          <td class="pf-actions-cell">
            <button class="pf-dots" type="button" aria-haspopup="true" aria-expanded="false">⋯</button>
            <div class="pf-menu" role="menu">
              <a href="/details-plateforme" data-act="voir" data-i="${i}">Voir</a>
              <a href="#" data-act="mod"  data-i="${i}">Modifier</a>
              <a href="#" data-act="sup"  data-i="${i}">Supprimer</a>
            </div>
          </td>
        </tr>`;
    }
    function draw(list){ tbody.innerHTML = list.map(row).join(''); bindMenus(); }

    function closeAllMenus(){
      root.querySelectorAll('.pf-menu').forEach(m=> m.style.display='none');
      root.querySelectorAll('.pf-dots[aria-expanded="true"]').forEach(b=> b.setAttribute('aria-expanded','false'));
    }
    function bindMenus(){
      root.querySelectorAll('.pf-dots').forEach(btn=>{
        btn.addEventListener('click',e=>{
          const menu = btn.nextElementSibling;
          const open = menu.style.display==='block';
          closeAllMenus();
          menu.style.display = open ? 'none' : 'block';
          btn.setAttribute('aria-expanded', String(!open));
          e.stopPropagation();
        });
      });
    }
    document.addEventListener('click',(e)=>{
      if (e.target.closest('#pf-list .pf-menu') || e.target.closest('#pf-list .pf-dots')) return;
      closeAllMenus();
    });
    document.addEventListener('keydown',(e)=>{ if (e.key==='Escape') closeAllMenus(); });

    q.addEventListener('input', ()=>{
      const v = q.value.toLowerCase().trim();
      CURRENT = DATA.filter(d =>
        d.name.toLowerCase().includes(v) ||
        d.resp.toLowerCase().includes(v) ||
        d.dom.toLowerCase().includes(v)
      );
      draw(CURRENT);
    });

    function openSb(){ sb.classList.add('open'); ov.classList.add('open'); sb.setAttribute('aria-hidden','false'); }
    function closeSb(){ sb.classList.remove('open'); ov.classList.remove('open'); sb.setAttribute('aria-hidden','true'); }
    root.querySelector('#pf-save').addEventListener('click', closeSb);
    addBtn.addEventListener('click', openSb);
    ov.addEventListener('click', closeSb);

    // Importer
    root.querySelector('#pf-import').addEventListener('click', ()=> file.click());
    file.addEventListener('change', ()=>{ fileText.value = file.files?.[0]?.name || ""; });

    // Redirection "Voir" -> details-plateforme
    root.addEventListener('click', (e)=>{
      const a = e.target.closest('.pf-menu a');
      if(!a) return;
      e.preventDefault();
      const act = a.dataset.act;
      const i = a.dataset.i ?? '';
      if(act === 'voir'){
        window.location.href = 'details-plateforme?i=' + encodeURIComponent(i);
      }
      closeAllMenus();
    });

    draw(CURRENT);
  })();
  </script>
</section>
