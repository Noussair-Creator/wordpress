<section id="doc-list">
  <style>
    #doc-list{font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif}
    #doc-list{ --ink:#2A2916; --muted:#6E6D55; --edge:#ECEBE3; --line:#EBE9D7; --danger:#BF0404; --olive:#A6A485; }

    .pf-card{background:#fff;border-radius:10px;box-shadow:0 3px 22px #0000000F;padding:14px 16px 56px;position:relative}
    .pf-head{display:flex;align-items:center;gap:10px}
    .pf-ico{width:26px;height:26px;object-fit:contain}
    .pf-title{margin:0;font:700 18px/1 Roboto;color:var(--ink)}
    .pf-sep{border:0;border-top:1px solid var(--edge);margin:10px 0 12px}

    /* Toolbar (héritée) */
    .pf-toolbar{display:flex;gap:10px;align-items:flex-start}
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
    .pf-actions{margin-left:auto;display:flex;flex-direction:column;align-items:flex-end;gap:8px}
    .pf-btn-primary{background:var(--danger);color:#fff;border:none;border-radius:6px;height:38px;padding:0 14px;font:700 13px/1 Roboto;cursor:pointer}
    .pf-mini-actions{display:flex;gap:8px}
    .pf-btn-square{width:38px;height:38px;border-radius:6px;border:none;background:#fff;box-shadow:0 0 6px #00000030;display:grid;place-items:center;cursor:pointer}
    .pf-btn-square img{width:18px;height:18px}

    /* Table */
    .pf-table-wrap{margin-top:8px}
    .pf-headbox{background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;overflow:hidden}
    .pf-table,.pf-table-head{width:100%;border-collapse:separate;border-spacing:0;table-layout:fixed;color:var(--ink);font-size:14px}
    col.c-ck{width:4%} col.c-ref{width:10%} col.c-name{width:28%} col.c-type{width:12%} col.c-date{width:14%} col.c-auth{width:18%} col.c-size{width:10%} col.c-act{width:6%}
    .pf-table-head th{padding:10px;text-align:left;font:700 14px Roboto}
    .pf-table-head th:first-child{text-align:center}
    .pf-bodybox{border:2px solid var(--line);border-radius:8px;overflow:visible;background:#fff;margin-top:10px}
    .pf-table td{padding:10px;border-top:1px solid var(--edge);vertical-align:middle;background:#fff}
    .pf-table tr:first-child td{border-top:none}
    .pf-table td+td{border-left:1px solid var(--edge)}
    .pf-name a{color:var(--ink);text-decoration:none}

    /* Menu actions */
    .pf-actions-cell{position:relative;text-align:center;overflow:visible}
    .pf-dots{width:28px;height:28px;border-radius:6px;border:1px solid transparent;background:transparent;cursor:pointer;font-size:22px;line-height:26px}
    .pf-dots:hover{background:#f7f6f1;border-color:#e8e3cf}
    .pf-menu{position:absolute;top:30px;right:0;background:#fff;border:1px solid #E6E4D8;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.12);display:none;min-width:160px;padding:6px;z-index:1000;text-align:left}
    .pf-menu a{display:block;padding:10px 12px;border-radius:8px;text-decoration:none;color:var(--ink);font:500 13px Roboto}
    .pf-menu a:hover{background:#F7F6F2}

    /* Pagination */
    .pf-pager{position:absolute;right:16px;bottom:12px;display:flex;align-items:center;gap:12px}
    .pf-page-btn{width:27px;height:27px;border:2px solid var(--danger);border-radius:3px;background:#fff;color:#BF0404;font-weight:700;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer}
    .pf-page-num{min-width:20px;text-align:center;font:600 14px/1 Roboto;color:#010103}

    /* Offcanvas */
    .pf-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:.2s;z-index:12000}
    .pf-overlay.open{opacity:1;pointer-events:auto}
    .pf-sb{position:fixed;top:0;right:0;width:520px;max-width:95vw;height:100vh;background:#fff;box-shadow:-7px 0 36px #00000029;transform:translateX(110%);transition:.25s;z-index:12001;display:flex;flex-direction:column}
    .pf-sb.open{transform:translateX(0)}
    .pf-sb-head{height:60px;background:#fff;box-shadow:0 5px 16px #00000029;display:flex;align-items:center;justify-content:space-between;padding:10px 14px}
    .pf-sb-title{font:700 15px/1 Roboto;color:var(--ink)}
    .pf-sb-save{height:34px;padding:0 14px;border:none;border-radius:6px;background:var(--danger);color:#fff;font:700 13px Roboto;cursor:pointer}
    .pf-sb-body{padding:16px 18px;overflow:auto}
    .pf-field{margin-bottom:14px}
    .pf-label{display:block;margin:0 0 6px;font:700 12px/1 Roboto;text-align: left;
letter-spacing: 0px;
color: #6E6D55;
text-transform: capitalize;
opacity: 1;}
    .pf-input,.pf-textarea,.pf-select2{width:100%;border:1px solid #DBD9C3;border-radius:6px;background:#fff;font:400 14px Roboto;color:var(--ink);box-sizing:border-box}
    .pf-input{height:36px;padding:0 10px}
    .pf-textarea{min-height:110px;padding:10px;resize:vertical}
    .pf-select2{height:36px;padding:0 10px;appearance:auto;background:#fff}

    /* Fichier */
    .pf-file-row{display:flex;align-items:stretch;gap:0}
    .pf-file-input{flex:1;height:36px;margin:0;border-right:0;border-radius:6px 0 0 6px}
    .pf-import-btn{display:inline-flex;align-items:center;justify-content:center;height:36px;min-width:110px;padding:0 14px;margin:0;border:1px solid #DBD9C3;border-left:0;border-radius:0 6px 6px 0;background:var(--olive);color:#fff;font:700 13px Roboto;cursor:pointer;line-height:1}

    /* Tags (Mots-Clés) */
    .tag-wrap{height: 69px; display:flex;gap:8px;flex-wrap:wrap;padding:8px 10px;border:1px solid #DBD9C3;border-radius:6px;background:#fff}
    .tag{display:inline-flex;align-items:center;gap:8px;background:var(--danger);color:#fff;border-radius:999px;padding:6px 10px;font:700 12px/1 Roboto;height: 35px;}
    .tag .x{display:inline-grid;place-items:center;width:18px;height:18px;border:2px solid #fff;border-radius:50%;font:700 11px;line-height:1;cursor:pointer}
    .mc-row{display:flex;gap:6px}
    .mc-add{width:36px;height:36px;border:1px solid #DBD9C3;border-radius:6px;background:#fff;display:grid;place-items:center;cursor:pointer}

    /* Radios visibilité */
    .vis-group label{display:flex;gap:10px;align-items:flex-start;margin:8px 0;color:var(--ink)}
    .vis-group small{color:#6E6D55}

    /* Style exact pour les textes des options de visibilité */
.vis-group label span{
  text-align: left;
  font: normal normal normal 14px/17px Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
  letter-spacing: 0px;
  color: #2A2916;
  opacity: 1;
  display: inline-block; /* assure la bonne prise de la hauteur de ligne */
}

/* Le <small> hérite du même style */
.vis-group label span small{
  font: inherit;
  color: inherit;
  letter-spacing: inherit;
  opacity: inherit;
}
/* Radios en rouge */
.vis-group input[type="radio"]{
  accent-color: var(--danger); /* #BF0404 */
}

  </style>

  <div class="pf-card">
    <div class="pf-head">
      <img class="pf-ico" src="/wp-content/plugins/plateforme-master/images/pmo/16406436.png" alt="">
      <h3 class="pf-title">Liste des documents</h3>
    </div>
    <hr class="pf-sep">

    <!-- Toolbar -->
    <div class="pf-toolbar">
      <label class="pf-search">
        <input id="dc-q" type="text" placeholder="Recherche">
        <svg viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a" stroke-width="2" stroke-linecap="round"/></svg>
      </label>

      <div class="pf-select-wrap">
        <select id="dc-prio" class="pf-select">
          <option value="">Priorité</option>
          <option>Haute</option><option>Moyenne</option><option>Basse</option>
        </select>
      </div>

      <div class="pf-actions">
        <button id="dc-add" class="pf-btn-primary" type="button">Nouveau Document</button>
        <div class="pf-mini-actions">
          <button class="pf-btn-square" type="button" title="Filtrer">
            <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-funnel.png" alt="Filtre">
          </button>
          <button class="pf-btn-square" type="button" title="Télécharger / Export">
            <img src="/wp-content/plugins/plateforme-master/images/icon etudiant/upload-red.png" alt="Téléchargement">
          </button>
        </div>
      </div>
    </div>

    <!-- Head -->
    <div class="pf-table-wrap pf-headbox">
      <table class="pf-table-head" aria-hidden="true">
        <colgroup>
          <col class="c-ck"><col class="c-ref"><col class="c-name"><col class="c-type">
          <col class="c-date"><col class="c-auth"><col class="c-size"><col class="c-act">
        </colgroup>
        <thead>
          <tr>
            <th style="text-align:center"><input type="checkbox"></th>
            <th>Réf_Doc</th>
            <th>Nom du document</th>
            <th>Type</th>
            <th>Date dépôt</th>
            <th>Auteur</th>
            <th>Taille</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <!-- Body -->
    <div class="pf-table-wrap pf-bodybox">
      <table class="pf-table" id="dc-table">
        <colgroup>
          <col class="c-ck"><col class="c-ref"><col class="c-name"><col class="c-type">
          <col class="c-date"><col class="c-auth"><col class="c-size"><col class="c-act">
        </colgroup>
        <tbody id="dc-tbody"></tbody>
      </table>
    </div>

    <div class="pf-pager">
      <button class="pf-page-btn" title="Première page">&laquo;</button>
      <button class="pf-page-btn" title="Précédent">&lsaquo;</button>
      <span class="pf-page-num">2</span>
      <button class="pf-page-btn" title="Suivant">&rsaquo;</button>
      <button class="pf-page-btn" title="Dernière page">&raquo;</button>
    </div>
  </div>

  <!-- ===== Offcanvas mis à jour (capture) ===== -->
  <div class="pf-overlay" id="dc-ov"></div>
  <aside class="pf-sb" id="dc-sb" aria-hidden="true">
    <div class="pf-sb-head">
      <div class="pf-sb-title">Nouvelle Requête</div>
      <button id="dc-save" class="pf-sb-save" type="button">Déposer</button>
    </div>

    <div class="pf-sb-body">
      <div class="pf-field">
        <label class="pf-label">Titre Du Document</label>
        <input class="pf-input" id="f-title" type="text">
      </div>

      <div class="pf-field">
        <label class="pf-label">Catégorie</label>
        <select class="pf-select2" id="f-cat">
          <option value=""></option>
          <option>Guide</option><option>Rapport</option><option>Note</option>
        </select>
      </div>

      <div class="pf-field">
        <label class="pf-label">Mots-Clés</label>
        <div class="mc-row">
          <input class="pf-input" id="tag-input" type="text" placeholder="">
          <button class="mc-add" id="tag-add" title="Ajouter">↵</button>
        </div>
        <div class="tag-wrap" id="tag-wrap" style="margin-top:8px">
          <!-- pills dynamiques -->
        </div>
      </div>

      <div class="pf-field">
        <label class="pf-label">Description Détaillée</label>
        <textarea class="pf-textarea" id="f-desc"></textarea>
      </div>

      <div class="pf-field">
        <label class="pf-label">Pièce Jointe</label>
        <div class="pf-file-row">
          <input id="dc-file-text" class="pf-input pf-file-input" type="text" placeholder="" readonly>
          <button class="pf-import-btn" type="button" id="dc-import">Importer</button>
        </div>
        <input id="dc-file" type="file" hidden>
      </div>

      <div class="pf-field vis-group">
        <label class="pf-label">Choix De Visibilité</label>
        <label><input type="radio" name="vis" value="public"> <span>Public <small>(accessible à tous)</small></span></label>
        <label><input type="radio" name="vis" value="restreint" checked> <span>Restreint <small>(accessible à un groupe spécifique)</small></span></label>
        <label><input type="radio" name="vis" value="prive"> <span>Privé <small>(visible uniquement par le déposant)</small></span></label>
      </div>
    </div>
  </aside>

  <script>
    (function(){
      const root   = document.getElementById('doc-list');
      const tbody  = root.querySelector('#dc-tbody');
      const q      = root.querySelector('#dc-q');
      const prio   = root.querySelector('#dc-prio');
      const addBtn = root.querySelector('#dc-add');
      const ov     = root.querySelector('#dc-ov');
      const sb     = root.querySelector('#dc-sb');
      const file   = root.querySelector('#dc-file');
      const fileTxt= root.querySelector('#dc-file-text');

      const DATA = [
        { ref:'001', name:'Guide CEIP.pdf',       type:'Guide',   date:'15/08/2025', author:'Admin CEIP', size:'21 Mo'  },
        { ref:'002', name:'Rapport_Projet.docx',  type:'Rapport', date:'15/08/2025', author:'Dr. Ali',    size:'1.5 MB' }
      ];
      let CUR = [...DATA];

      function row(d,i){
        return `
          <tr>
            <td style="text-align:center"><input type="checkbox"></td>
            <td>${d.ref}</td>
            <td class="pf-name"><a href="/details-document?ref=${encodeURIComponent(d.ref)}">${d.name}</a></td>
            <td>${d.type}</td>
            <td>${d.date}</td>
            <td>${d.author}</td>
            <td>${d.size}</td>
            <td class="pf-actions-cell">
              <button class="pf-dots" type="button" aria-haspopup="true" aria-expanded="false">⋯</button>
              <div class="pf-menu" role="menu">
                <a href="/details-document?ref=${encodeURIComponent(d.ref)}" data-act="voir" data-i="${i}">Voir</a>
                <a href="#" data-act="dl" data-i="${i}">Télécharger</a>
              </div>
            </td>
          </tr>`;
      }
      function draw(list){ tbody.innerHTML = list.map(row).join(''); bindMenus(); }

      // Menus
      function closeMenus(){
        root.querySelectorAll('.pf-menu').forEach(m=>m.style.display='none');
        root.querySelectorAll('.pf-dots[aria-expanded="true"]').forEach(b=>b.setAttribute('aria-expanded','false'));
      }
      function bindMenus(){
        root.querySelectorAll('.pf-dots').forEach(btn=>{
          btn.addEventListener('click',e=>{
            const m = btn.nextElementSibling; const open = m.style.display==='block';
            closeMenus(); m.style.display = open ? 'none' : 'block';
            btn.setAttribute('aria-expanded', String(!open));
            e.stopPropagation();
          });
        });
      }
      document.addEventListener('click', e=>{
        if (!e.target.closest('#doc-list .pf-menu') && !e.target.closest('#doc-list .pf-dots')) closeMenus();
      });
      document.addEventListener('keydown', e=>{ if(e.key==='Escape') closeMenus(); });

      // Filtres
      function filter(){
        const v = q.value.toLowerCase().trim();
        CUR = DATA.filter(d =>
          v==='' || d.name.toLowerCase().includes(v) || d.author.toLowerCase().includes(v) || d.ref.includes(v) || d.type.toLowerCase().includes(v)
        );
        draw(CUR);
      }
      q.addEventListener('input', filter);
      prio.addEventListener('change', filter);

      // Offcanvas
      function openSb(){ sb.classList.add('open'); ov.classList.add('open'); document.documentElement.style.overflow='hidden'; }
      function closeSb(){ sb.classList.remove('open'); ov.classList.remove('open'); document.documentElement.style.overflow=''; }
      addBtn.addEventListener('click', openSb);
      ov.addEventListener('click', closeSb);
      root.querySelector('#dc-save').addEventListener('click', closeSb);

      // Import fichier
      root.querySelector('#dc-import').addEventListener('click', ()=> file.click());
      file.addEventListener('change', ()=>{ fileTxt.value = file.files?.[0]?.name || ""; });

      // Actions du menu
      root.addEventListener('click', e=>{
        const a = e.target.closest('.pf-menu a'); if(!a) return;
        if(a.dataset.act==='dl'){ e.preventDefault(); const i=+a.dataset.i; alert('Télécharger : ' + DATA[i].name); }
        closeMenus();
      });

      // --- Mots-Clés (pills) ---
      const tagInput = root.querySelector('#tag-input');
      const tagAdd   = root.querySelector('#tag-add');
      const tagWrap  = root.querySelector('#tag-wrap');
      let tags = ['AI','Base De Données']; // valeurs par défaut comme la capture

      function drawTags(){
        tagWrap.innerHTML = tags.map((t,idx)=>
          `<span class="tag">${t}<span class="x" data-i="${idx}">×</span></span>`
        ).join('');
      }
      function pushTagFromInput(){
        const raw = tagInput.value.trim();
        if(!raw) return;
        raw.split(',').map(s=>s.trim()).filter(Boolean).forEach(t=>{
          if(!tags.includes(t)) tags.push(t);
        });
        tagInput.value=''; drawTags();
      }
      tagAdd.addEventListener('click', pushTagFromInput);
      tagInput.addEventListener('keydown', e=>{
        if(e.key==='Enter' || e.key===','){ e.preventDefault(); pushTagFromInput(); }
      });
      tagWrap.addEventListener('click', e=>{
        const x = e.target.closest('.x'); if(!x) return;
        const i = +x.dataset.i; tags.splice(i,1); drawTags();
      });
      drawTags();

      draw(CUR);
    })();
  </script>
</section>
