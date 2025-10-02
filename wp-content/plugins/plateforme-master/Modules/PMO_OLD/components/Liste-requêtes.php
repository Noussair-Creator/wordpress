<section id="rq-list">
  <style>
    /* Base */
    #rq-list{font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif}
    #rq-list{ --ink:#2A2916; --muted:#6E6D55; --edge:#ECEBE3; --line:#EBE9D7; --danger:#BF0404; --olive:#A6A485; }

    .pf-card{background:#fff;border-radius:10px;box-shadow:0 3px 22px #0000000F;padding:14px 16px 56px;position:relative}

    /* ===== Head ===== */
    .pf-head{display:flex;align-items:center;gap:10px}
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

    /* ===== Table (inchangé) ===== */
    .pf-table-wrap{margin-top:8px}
    .pf-headbox{background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;overflow:hidden}
    .pf-table,.pf-table-head{width:100%;border-collapse:separate;border-spacing:0;table-layout:fixed;color:var(--ink);font-size:14px}
    col.c-ck{width:4%} col.c-id{width:8%} col.c-title{width:32%} col.c-ask{width:18%} col.c-date{width:14%} col.c-st{width:13%} col.c-pr{width:12%} col.c-act{width:6%}
    .pf-table-head th{padding:10px;text-align:left;font:700 14px Roboto}
    .pf-table-head th:first-child{text-align:center}
    .pf-bodybox{border:2px solid var(--line);border-radius:8px;overflow:visible;background:#fff;margin-top:10px}
    .pf-table td{padding:10px;border-top:1px solid var(--edge);vertical-align:middle;background:#fff}
    .pf-table tr:first-child td{border-top:none}
    .pf-table td+td{border-left:1px solid var(--edge)}

    /* Badges statut */
    .rq-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:999px;border:1px solid transparent;font:600 12px}
    .rq-dot{width:8px;height:8px;border-radius:50%}
    .rq-wait{background:#FFF5D6;border-color:#F0DF9C;color:#9A7A01;font-size: 12px;}
    .rq-wait .rq-dot{background:#9A7A01}
    .rq-run{background:rgba(14,150,45,.08);border-color:#BFE8C8;color:#0E962D;font-size: 12px;}
    .rq-run .rq-dot{background:#0E962D}

    /* Menu ⋯ */
    .pf-actions-cell{position:relative;text-align:center;overflow:visible}
    .pf-dots{width:28px;height:28px;border-radius:6px;border:1px solid transparent;background:transparent;cursor:pointer;font-size:22px;line-height:26px}
    .pf-dots:hover{background:#f7f6f1;border-color:#e8e3cf}
    .pf-menu{
      position:absolute;top:30px;right:0;background:#fff;border:1px solid #E6E4D8;border-radius:10px;
      box-shadow:0 8px 24px rgba(0,0,0,.12);display:none;min-width:160px;padding:6px;z-index:1000;text-align:left;
    }
    .pf-menu a{display:block;padding:10px 12px;border-radius:8px;text-decoration:none;color:var(--ink);font:500 13px Roboto}
    .pf-menu a:hover{background:#F7F6F2}

    /* Pagination */
    .pf-pager{position:absolute;right:16px;bottom:12px;display:flex;align-items:center;gap:12px}
    .pf-page-btn{width:27px;height:27px;border:2px solid var(--danger);border-radius:3px;background:#fff;color:#BF0404;font-weight:700;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer}
    .pf-page-num{min-width:20px;text-align:center;font:600 14px/1 Roboto;color:#010103}

    /* Offcanvas */
    .pf-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:.2s;z-index:12000}
    .pf-overlay.open{opacity:1;pointer-events:auto}
    .pf-sb{position:fixed;top:0;right:0;width:480px;max-width:95vw;height:100vh;background:#fff;box-shadow:-7px 0 36px #00000029;transform:translateX(110%);transition:.25s;z-index:12001;display:flex;flex-direction:column}
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
    .pf-select-wrap2{position:relative}
    .pf-select2{height:36px;padding:0 10px;appearance:auto;-webkit-appearance:auto;-moz-appearance:auto;background:#fff}
    .pf-input.addon-right{padding-right:44px;background-image:url('/wp-content/plugins/plateforme-master/images/pmo/27)%20Icon-globe-2.png');background-repeat:no-repeat;background-position:right 10px center;background-size:18px 18px}
    .pf-file-group{display:block}
    .pf-file-row{display:flex;align-items:stretch;gap:0}
    .pf-file-input{flex:1;height:36px;margin:0;border-right:0;border-radius:6px 0 0 6px}
    .pf-import-btn{display:inline-flex;align-items:center;justify-content:center;height:36px;min-width:110px;padding:0 14px;margin:0;border:1px solid #DBD9C3;border-left:0;border-radius:0 6px 6px 0;background:var(--olive);color:#fff;font:700 13px Roboto;cursor:pointer;line-height:1}

    /* Responsive */
    @media (max-width:720px){
      .pf-toolbar{flex-direction:column;align-items:stretch}
      .pf-toolbar-right{align-self:flex-end}
      .pf-search{flex:1}
    }
  </style>

  <div class="pf-card">
    <!-- Header : titre à gauche, bouton à droite -->
    <div class="pf-head">
      <img class="pf-ico" src="/wp-content/plugins/plateforme-master/images/pmo/16406436.png" alt="">
      <h3 class="pf-title">Liste des requêtes</h3>
      <!-- bouton déplacé dans le header -->
      <button id="rq-add" class="pf-btn-primary" type="button">Nouvelle Requête</button>
    </div>

    <hr class="pf-sep">

    <!-- Toolbar : gauche (recherche + priorité), droite (filtre + download) -->
    <div class="pf-toolbar">
      <div class="pf-toolbar-left">
        <label class="pf-search">
          <input id="rq-q" type="text" placeholder="Recherche">
          <svg viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a" stroke-width="2" stroke-linecap="round"/></svg>
        </label>

        <div class="pf-select-wrap">
          <select id="rq-prio" class="pf-select">
            <option value="">Priorité</option>
            <option>Haute</option>
            <option>Moyenne</option>
            <option>Basse</option>
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

    <!-- En-tête du tableau -->
    <div class="pf-table-wrap pf-headbox">
      <table class="pf-table-head" aria-hidden="true">
        <colgroup><col class="c-ck"><col class="c-id"><col class="c-title"><col class="c-ask"><col class="c-date"><col class="c-st"><col class="c-pr"><col class="c-act"></colgroup>
        <thead>
          <tr>
            <th style="text-align:center"><input type="checkbox"></th>
            <th>ID</th>
            <th>Titre de la requête</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Priorité</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <!-- Corps du tableau -->
    <div class="pf-table-wrap pf-bodybox">
      <table class="pf-table" id="rq-table">
        <colgroup><col class="c-ck"><col class="c-id"><col class="c-title"><col class="c-ask"><col class="c-date"><col class="c-st"><col class="c-pr"><col class="c-act"></colgroup>
        <tbody id="rq-tbody"></tbody>
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

  <!-- ===== OFFCANVAS : Nouvelle Requête ===== -->
  <div class="pf-overlay" id="rq-ov"></div>
  <aside class="pf-sb" id="rq-sb" aria-hidden="true">
    <div class="pf-sb-head">
      <div class="pf-sb-title">Nouvelle Requête</div>
      <button id="rq-save" class="pf-sb-save" type="button">Enregistrer</button>
    </div>

    <div class="pf-sb-body">
      <div class="pf-field">
        <label class="pf-label">Titre De La Requête</label>
        <input class="pf-input" type="text">
      </div>

      <div class="pf-field pf-select-wrap2">
        <label class="pf-label">Type De Requête</label>
        <select class="pf-select2">
          <option value=""></option>
          <option>Accès</option><option>Support</option><option>Incident</option>
        </select>
      </div>

      <div class="pf-field pf-select-wrap2">
        <label class="pf-label">Priorité</label>
        <select class="pf-select2">
          <option value=""></option>
          <option>Haute</option><option>Moyenne</option><option>Basse</option>
        </select>
      </div>

      <div class="pf-field">
        <label class="pf-label">Description Détaillée</label>
        <textarea class="pf-textarea"></textarea>
      </div>

      <div class="pf-field pf-file-group">
        <label class="pf-label">Pièce Jointe</label>
        <div class="pf-file-row">
          <input id="rq-file-text" class="pf-input pf-file-input" type="text" readonly>
          <button class="pf-import-btn" type="button" id="rq-import">Importer</button>
        </div>
        <input id="rq-file" type="file" hidden>
      </div>
    </div>
  </aside>

  <script>
  (function(){
    const root   = document.getElementById('rq-list');
    const tbody  = root.querySelector('#rq-tbody');
    const q      = root.querySelector('#rq-q');
    const prio   = root.querySelector('#rq-prio');
    const addBtn = root.querySelector('#rq-add');
    const ov     = root.querySelector('#rq-ov');
    const sb     = root.querySelector('#rq-sb');
    const file   = root.querySelector('#rq-file');
    const fileText = root.querySelector('#rq-file-text');

    const DATA = [
      { id:'001', title:'Accès À La Base De Données', asker:'Dr. Ali',   date:'15/08/2025', status:'wait', prio:'Haute'   },
      { id:'002', title:'Support Plateforme',         asker:'Mme. Salma',date:'15/08/2025', status:'run',  prio:'Moyenne' }
    ];
    let CURRENT = [...DATA];

    function stBadge(s){
      if(s==='wait') return '<span class="rq-badge rq-wait"><span class="rq-dot"></span>En attente</span>';
      if(s==='run')  return '<span class="rq-badge rq-run"><span class="rq-dot"></span>En cours</span>';
      return '';
    }

    function row(d,i){
      return `
        <tr>
          <td style="text-align:center"><input type="checkbox"></td>
          <td>${d.id}</td>
          <td>${d.title}</td>
          <td>${d.asker}</td>
          <td>${d.date}</td>
          <td>${stBadge(d.status)}</td>
          <td>${d.prio}</td>
          <td class="pf-actions-cell">
            <button class="pf-dots" type="button" aria-haspopup="true" aria-expanded="false">⋯</button>
            <div class="pf-menu" role="menu">
              <a href="#" data-act="voir" data-i="${i}">Voir</a>
              <a href="#" data-act="mod"  data-i="${i}">Modifier</a>
            </div>
          </td>
        </tr>`;
    }
    function draw(list){ tbody.innerHTML = list.map(row).join(''); bindMenus(); }

    function closeMenus(){
      root.querySelectorAll('.pf-menu').forEach(m=> m.style.display='none');
      root.querySelectorAll('.pf-dots[aria-expanded="true"]').forEach(b=> b.setAttribute('aria-expanded','false'));
    }
    function bindMenus(){
      root.querySelectorAll('.pf-dots').forEach(btn=>{
        btn.addEventListener('click',e=>{
          const menu = btn.nextElementSibling;
          const open = menu.style.display==='block';
          closeMenus();
          menu.style.display = open ? 'none' : 'block';
          btn.setAttribute('aria-expanded', String(!open));
          e.stopPropagation();
        });
      });
    }
    document.addEventListener('click',(e)=>{
      if (e.target.closest('#rq-list .pf-menu') || e.target.closest('#rq-list .pf-dots')) return;
      closeMenus();
    });
    document.addEventListener('keydown',(e)=>{ if (e.key==='Escape') closeMenus(); });

    function filter(){
      const v = q.value.toLowerCase().trim();
      const p = prio.value;
      CURRENT = DATA.filter(d =>
        (v==='' || d.title.toLowerCase().includes(v) || d.asker.toLowerCase().includes(v) || d.id.includes(v)) &&
        (p==='' || d.prio===p)
      );
      draw(CURRENT);
    }
    q.addEventListener('input', filter);
    prio.addEventListener('change', filter);

    // Offcanvas
    function openSb(){ sb.classList.add('open'); ov.classList.add('open'); document.documentElement.style.overflow='hidden'; }
    function closeSb(){ sb.classList.remove('open'); ov.classList.remove('open'); document.documentElement.style.overflow=''; }
    root.querySelector('#rq-save').addEventListener('click', closeSb);
    addBtn.addEventListener('click', openSb);
    ov.addEventListener('click', closeSb);

    // Importer
    root.querySelector('#rq-import').addEventListener('click', ()=> file.click());
    file.addEventListener('change', ()=>{ fileText.value = file.files?.[0]?.name || ""; });

    draw(CURRENT);
  })();
  </script>
</section>
