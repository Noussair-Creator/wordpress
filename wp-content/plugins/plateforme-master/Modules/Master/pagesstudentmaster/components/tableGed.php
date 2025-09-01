<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plateforme Master</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* === General Styles === */
    .content-block{background:#fff;border-radius:10px;font-family:'Segoe UI',sans-serif;box-shadow:0 2px 6px rgba(0,0,0,.05);height:590px}
    .accordion-container{border-radius:12px;overflow:hidden;box-shadow:0 0 8px rgba(0,0,0,.05);border-top:0}
    .accordion-tabs{display:flex;background:#f3f3f3;border-radius:10px 10px 0 0}
    .tab-btn{flex:1;padding:12px 20px;font-weight:600;border:none;background:#A6A485;cursor:pointer;font-size:20px;transition:.3s;letter-spacing:0;color:#fff;border-top-left-radius:10px;border-top-right-radius:10px;display:flex;align-items:center;gap:10px;justify-content:center}
    .tab-btn:first-child,.tab-btn:nth-child(2){margin-right:8px}.tab-btn:nth-child(4){margin-left:10px}
    .tab-btn.active{background:#fff;color:#2A2916;box-shadow:inset 0 -3px 0 0 #fff}
    .accordion-content{padding:25px 25px 35px;background:#fff}
    .tab-panel{display:none}.tab-panel.active{display:block}

    /* === Controls === */
    .table-controls{display:flex;justify-content:flex-start;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:45px;padding:0 4px}
    .filters-row{display:flex;gap:14px;flex-wrap:wrap;align-items:center}
    .ctl{--ctl-h:44px;--ctl-br:12px;--ctl-border:#e7e3d7;--ctl-text:#2A2916;position:relative;display:inline-flex;align-items:center;gap:10px;height:var(--ctl-h);padding:0 12px;border:1px solid var(--ctl-border);border-radius:var(--ctl-br);background:#fff;box-shadow:0 1px 0 rgba(0,0,0,.02);color:var(--ctl-text)}
    .ctl input,.ctl select{flex:1 1 auto;height:calc(var(--ctl-h) - 2px);border:0;outline:0;background:transparent;font-size:15px;color:var(--ctl-text)}
    .ctl input::placeholder{color:#C0BCA9}
    .ctl .sep{width:1px;height:60%;background:#e7e3d7;margin-left:auto}
    .ctl i{font-size:18px;color:#3a3826;opacity:.85}
    .ctl-search{min-width:260px}.ctl-select{min-width:280px}.ctl-period{min-width:240px}
    .ctl-select select{appearance:none;-webkit-appearance:none;-moz-appearance:none;padding-right:28px;font-weight:600}
    .ctl-select select::-ms-expand{display:none}
    .ctl:focus-within{border-color:#dcd6c3;box-shadow:0 0 0 3px rgba(220,214,195,.35)}

    /* === Table Styling (commun) === */
    .styled-table{border:none!important;border-collapse:separate!important;border-spacing:0!important;border-radius:12px!important;box-shadow:none!important;width:100%;background:#fff;font-family:'Segoe UI',sans-serif}
    .styled-table thead{background:#ECEBE3!important;position:static!important;transform:translateY(-15px)!important;border:none!important}
    .styled-table th{padding:26px 10px 17px!important;border:0!important;font-weight:600;font-size:14px!important;white-space:nowrap!important;line-height:1.2;letter-spacing:.2px}
    .styled-table td{padding:12px!important;border:1px solid #EBE9D7!important;box-shadow:none!important}
    .styled-table tbody tr:nth-child(even){background:#ECEBE34D!important}
    .styled-table thead tr:first-child th:first-child{border-top-left-radius:12px!important;border-bottom-left-radius:12px!important}
    .styled-table thead tr:first-child th:last-child{border-top-right-radius:12px!important;border-bottom-right-radius:12px!important}
    .styled-table tbody tr:first-child td:first-child{border-top-left-radius:12px!important}
    .styled-table tbody tr:first-child td:last-child{border-top-right-radius:12px!important}
    .styled-table tbody tr:last-child td:first-child{border-bottom-left-radius:12px!important}
    .styled-table tbody tr:last-child td:last-child{border-bottom-right-radius:12px!important}
    .styled-table td a.titre-offre{color:#1a1a1a;text-decoration:none;font-size:14px}

    /* === Actions === */
    .actions{position:relative;display:inline-block}
    .action-btn{width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;background:transparent;border:1px solid transparent;border-radius:8px;cursor:pointer;transition:background-color .2s,box-shadow .2s}
    .action-btn img{width:16px;height:16px;object-fit:contain}
    .action-btn:hover{background:#e6e6de;box-shadow:0 1px 3px rgba(0,0,0,.1)}

    /* === Pagination === */
    .abs-pager{position:relative;right:16px;float:right;width:170px;height:27px;display:flex;align-items:center;gap:12px;margin-top:32px}
    .abs-btn{width:27px;height:27px;border:2px solid #c60000;border-radius:3px;background:#fff;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;box-sizing:border-box;font-weight:700;color:#c60000;line-height:1;font-size:22px;padding:0}
    .abs-btn.disabled{opacity:.45;pointer-events:none}
    .abs-num{min-width:20px;text-align:center;font-family:'Signika',system-ui,sans-serif;font-size:14px;color:#010103}
  </style>
</head>
<body>
  <div class="content-block">
    <div class="accordion-container">
      <!-- Tabs -->
      <div class="accordion-tabs">
        <button class="tab-btn active" data-tab="tab1">Cours</button>
        <button class="tab-btn" data-tab="tab2">T.P</button>
        <button class="tab-btn" data-tab="tab3">T.D</button>
        <button class="tab-btn" data-tab="tab4">Epreuves Corrigées</button>
      </div>

      <div class="accordion-content">
        <!-- ========= ONGLET 1 : Cours ========= -->
        <div id="tab1" class="tab-panel active">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-cours" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain-cours">
                  <option value="">Matière</option><option>Réseaux</option><option>Big Data</option><option>Cybersécurité</option>
                </select>
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-period">
                <input type="text" id="f-periode-cours" placeholder="Période">
                <span class="sep" aria-hidden="true"></span><i class="fa-regular fa-calendar"></i>
              </label>
            </div>
          </div>

          <table id="projetsTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px"/><col style="width:120px"/><col style="width:48%"/><col style="width:22%"/><col style="width:64px"/>
            </colgroup>
            <thead>
              <tr><th><input type="checkbox"></th><th>Date</th><th>Intitulé du document</th><th>Matière</th><th>Action</th></tr>
            </thead>
            <tbody></tbody>
          </table>
          <div class="abs-pager" data-table="projetsTable">
            <button class="abs-btn" data-action="first" title="Première page">&laquo;</button>
            <button class="abs-btn" data-action="prev"  title="Précédent">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next"  title="Suivant">&rsaquo;</button>
            <button class="abs-btn" data-action="last"  title="Dernière page">&raquo;</button>
          </div>
        </div>

        <!-- ========= ONGLET 2 : T.P ========= -->
        <div id="tab2" class="tab-panel">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-tp" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain-tp">
                  <option value="">Matière</option><option>Réseaux</option><option>Big Data</option><option>Cybersécurité</option>
                </select>
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-period">
                <input type="text" id="f-periode-tp" placeholder="Période">
                <span class="sep" aria-hidden="true"></span><i class="fa-regular fa-calendar"></i>
              </label>
            </div>
          </div>

          <table id="tpTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px"/><col style="width:120px"/><col style="width:48%"/><col style="width:22%"/><col style="width:64px"/>
            </colgroup>
            <thead>
              <tr><th><input type="checkbox"></th><th>Date</th><th>Intitulé du document</th><th>Matière</th><th>Action</th></tr>
            </thead>
            <tbody></tbody>
          </table>
          <div class="abs-pager" data-table="tpTable">
            <button class="abs-btn" data-action="first">&laquo;</button>
            <button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button>
            <button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

        <!-- ========= ONGLET 3 : T.D ========= -->
        <div id="tab3" class="tab-panel">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-td" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain-td">
                  <option value="">Matière</option><option>Réseaux</option><option>Big Data</option><option>Cybersécurité</option>
                </select>
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-period">
                <input type="text" id="f-periode-td" placeholder="Période">
                <span class="sep" aria-hidden="true"></span><i class="fa-regular fa-calendar"></i>
              </label>
            </div>
          </div>

          <table id="tdTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px"/><col style="width:120px"/><col style="width:48%"/><col style="width:22%"/><col style="width:64px"/>
            </colgroup>
            <thead>
              <tr><th><input type="checkbox"></th><th>Date</th><th>Intitulé du document</th><th>Matière</th><th>Action</th></tr>
            </thead>
            <tbody></tbody>
          </table>
          <div class="abs-pager" data-table="tdTable">
            <button class="abs-btn" data-action="first">&laquo;</button>
            <button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button>
            <button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

        <!-- ========= ONGLET 4 : Epreuves Corrigées (même structure) ========= -->
        <div id="tab4" class="tab-panel">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-actus" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain-actus">
                  <option value="">Matière</option><option>Réseaux</option><option>Big Data</option><option>Cybersécurité</option>
                </select>
                <span class="sep" aria-hidden="true"></span><i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-period">
                <input type="text" id="f-periode-actus" placeholder="Période">
                <span class="sep" aria-hidden="true"></span><i class="fa-regular fa-calendar"></i>
              </label>
            </div>
          </div>

          <table id="actusTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px"/><col style="width:120px"/><col style="width:48%"/><col style="width:22%"/><col style="width:64px"/>
            </colgroup>
            <thead>
              <tr><th><input type="checkbox"></th><th>Date</th><th>Intitulé du document</th><th>Matière</th><th>Action</th></tr>
            </thead>
            <tbody></tbody>
          </table>
          <div class="abs-pager" data-table="actusTable">
            <button class="abs-btn" data-action="first">&laquo;</button>
            <button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button>
            <button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    /* ===== Onglets ===== */
    document.querySelectorAll('.tab-btn').forEach(button=>{
      button.addEventListener('click', ()=>{
        const tabId = button.getAttribute('data-tab');
        document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
        button.classList.add('active');
        document.getElementById(tabId).classList.add('active');
        updatePagination(tabId);
      });
    });

    /* ===== Données ===== */
    const pageSize = 4;
    const tables = {
      projetsTable: [
        { id:"1", date:"13-01-2025", titre:"Optimisation des réseaux de neurones pour la détection des fraudes financières", matiere:"Intelligence Artificielle", file:"#"},
        { id:"2", date:"13-01-2025", titre:"Développement d’un chatbot intelligent pour l’assistance client", matiere:"Intelligence Artificielle", file:"#"},
        { id:"3", date:"16-01-2025", titre:"Prédiction des comportements d’achat en ligne à l’aide des modèles ML supervisés", matiere:"Intelligence Artificielle", file:"#"},
        { id:"4", date:"27-01-2025", titre:"Analyse des sentiments dans les réseaux sociaux", matiere:"Intelligence Artificielle", file:"#"}
      ],
      tpTable: [
        { id:"1", date:"13-01-2025", titre:"TP – Réseaux SDN : mini-projet", matiere:"Réseaux", file:"#"},
        { id:"2", date:"18-01-2025", titre:"TP – Hadoop & Spark : pipeline", matiere:"Big Data", file:"#"},
        { id:"3", date:"21-01-2025", titre:"TP – Détection d’intrusion", matiere:"Cybersécurité", file:"#"},
        { id:"4", date:"27-01-2025", titre:"TP – Routage avancé", matiere:"Réseaux", file:"#"}
      ],
      tdTable: [
        { id:"1", date:"10-01-2025", titre:"TD – Séries d’exercices 1", matiere:"Big Data", file:"#"},
        { id:"2", date:"17-01-2025", titre:"TD – Séries d’exercices 2", matiere:"Réseaux", file:"#"},
        { id:"3", date:"24-01-2025", titre:"TD – Sécurité : chiffrer/signature", matiere:"Cybersécurité", file:"#"},
        { id:"4", date:"31-01-2025", titre:"TD – Spark RDD vs DataFrame", matiere:"Big Data", file:"#"}
      ],
      /* Onglet 4 : même structure que les autres */
      actusTable: [
        { id:"1", date:"05-06-2025", titre:"Épreuve corrigée – Réseaux 2024", matiere:"Réseaux", file:"#"},
        { id:"2", date:"12-06-2025", titre:"Épreuve corrigée – Big Data 2024", matiere:"Big Data", file:"#"},
        { id:"3", date:"19-06-2025", titre:"Épreuve corrigée – Sécurité 2023", matiere:"Cybersécurité", file:"#"}
      ]
    };

    /* ===== Rendu d’un tableau (unique pour les 4) ===== */
    function renderRow(row){
      return `
        <td><input type="checkbox"></td>
        <td>${row.date}</td>
        <td><a href="#" class="titre-offre" data-id="${row.id}">${row.titre}</a></td>
        <td>${row.matiere}</td>
        <td>
          <div class="actions">
            <button class="action-btn" title="Télécharger" aria-label="Télécharger">
              <img src="/wp-content/plugins/plateforme-master/images/icon etudiant/upload-red.png" alt="Download Icon">
            </button>
          </div>
        </td>`;
    }

    function updateTable(tableId, page){
      const data = tables[tableId];
      const tbody = document.querySelector(`#${tableId} tbody`);
      tbody.innerHTML = '';
      const start = (page-1)*pageSize;
      const rows = data.slice(start, start+pageSize);
      rows.forEach(r=>{
        const tr = document.createElement('tr');
        tr.innerHTML = renderRow(r);
        tbody.appendChild(tr);
      });

      const pager = document.querySelector(`.abs-pager[data-table="${tableId}"]`);
      const pageCount = Math.max(1, Math.ceil(data.length/pageSize));
      pager.querySelector('.abs-num').textContent = page;
      pager.querySelector('[data-action="first"]').classList.toggle('disabled', page===1);
      pager.querySelector('[data-action="prev"]').classList.toggle('disabled', page===1);
      pager.querySelector('[data-action="next"]').classList.toggle('disabled', page===pageCount);
      pager.querySelector('[data-action="last"]').classList.toggle('disabled', page===pageCount);
    }

    function updatePagination(tabId){
      const tableId = tabId==='tab1' ? 'projetsTable'
                    : tabId==='tab2' ? 'tpTable'
                    : tabId==='tab3' ? 'tdTable'
                    : 'actusTable';
      updateTable(tableId, 1);
    }

    /* ===== Pagination boutons ===== */
    document.querySelectorAll('.abs-pager').forEach(pager=>{
      const tableId = pager.getAttribute('data-table');
      pager.querySelectorAll('.abs-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          const action = btn.getAttribute('data-action');
          const current = parseInt(pager.querySelector('.abs-num').textContent, 10);
          const pageCount = Math.max(1, Math.ceil(tables[tableId].length/pageSize));
          let page = current;
          if(action==='first') page = 1;
          else if(action==='prev') page = Math.max(1, current-1);
          else if(action==='next') page = Math.min(pageCount, current+1);
          else if(action==='last') page = pageCount;
          updateTable(tableId, page);
        });
      });
    });

    /* ===== Délégation pour le bouton Télécharger ===== */
    document.addEventListener('click', (e)=>{
      const btn = e.target.closest('.action-btn');
      if(!btn) return;
      e.preventDefault();
      const row = btn.closest('tr');
      const link = row.querySelector('.titre-offre');
      const id = link ? link.dataset.id : null;
      const tableId = btn.closest('table').id;
      const item = tables[tableId]?.find(x=>x.id===id);
      if(item?.file) window.location.href = item.file;
    });

    /* ===== Filtres ===== */
    function applyFilter(prefix, tableId){
      const qEl = document.querySelector(`#f-q-${prefix}`);
      const dEl = document.querySelector(`#f-domain-${prefix}`);
      const pEl = document.querySelector(`#f-periode-${prefix}`);
      const q = (qEl?.value||'').trim().toLowerCase();
      const domain = (dEl?.value||'').trim();
      const per = (pEl?.value||'').trim().toLowerCase();

      const all = tables[tableId];
      const filtered = all.filter(r=>{
        const tOk = q ? r.titre.toLowerCase().includes(q) : true;
        const dOk = domain ? r.matiere===domain : true;
        const pOk = per ? r.date.toLowerCase().includes(per) : true;
        return tOk && dOk && pOk;
      });

      const tbody = document.querySelector(`#${tableId} tbody`);
      const pager = document.querySelector(`.abs-pager[data-table="${tableId}"]`);
      const page = parseInt(pager.querySelector('.abs-num').textContent, 10);

      tbody.innerHTML = '';
      const start = (page-1)*pageSize;
      const rows = filtered.slice(start, start+pageSize);
      rows.forEach(r=>{
        const tr = document.createElement('tr');
        tr.innerHTML = renderRow(r);
        tbody.appendChild(tr);
      });

      const pageCount = Math.max(1, Math.ceil(filtered.length/pageSize));
      pager.querySelector('.abs-num').textContent = Math.min(page, pageCount);
      pager.querySelector('[data-action="first"]').classList.toggle('disabled', page===1);
      pager.querySelector('[data-action="prev"]').classList.toggle('disabled', page===1);
      pager.querySelector('[data-action="next"]').classList.toggle('disabled', page===pageCount);
      pager.querySelector('[data-action="last"]').classList.toggle('disabled', page===pageCount);
    }

    /* Listeners filtres */
    [['cours','projetsTable'],['tp','tpTable'],['td','tdTable'],['actus','actusTable']].forEach(([p,t])=>{
      ['q','domain','periode'].forEach(s=>{
        const el = document.querySelector(`#f-${s}-${p}`);
        if(el) el.addEventListener('input', ()=>applyFilter(p,t));
      });
    });

    /* Init */
    updatePagination('tab1');
    updatePagination('tab2');
    updatePagination('tab3');
    updatePagination('tab4');
  </script>
</body>
</html>
