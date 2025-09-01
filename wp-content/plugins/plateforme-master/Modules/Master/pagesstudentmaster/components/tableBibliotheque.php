<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Plateforme Master</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    .decision-btn{padding:6px 14px;border-radius:16px;background:#fff6e0;border:1px solid #f5c86c;color:#d48c00;font-weight:600;font-size:12px;cursor:default}

    /* === Général === */
    .content-block{background:#fff;border-radius:10px;font-family:'Segoe UI',sans-serif;box-shadow:0 2px 6px rgba(0,0,0,.05);height:590px}
    .accordion-container{border-radius:12px;overflow:hidden;box-shadow:0 0 8px rgba(0,0,0,0.05)}
    .accordion-tabs{display:flex;background:#f3f3f3;border-radius:10px 10px 0 0}
    .tab-btn{flex:1;padding:12px 20px;font-weight:500;border:none;background:#A6A485;color:#fff;cursor:pointer;font-size:18px;transition:.3s;border-top-left-radius:10px;border-top-right-radius:10px;display:flex;align-items:center;justify-content:center}
    .tab-btn:first-child,.tab-btn:nth-child(2){margin-right:8px}.tab-btn:nth-child(4){margin-left:10px}
    .tab-btn.active{background:#fff;color:#2A2916}
    .accordion-content{padding:25px 25px 35px;background:#fff}
    .tab-panel{display:none}.tab-panel.active{display:block}

    /* Filtres */
    .table-controls{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:20px;padding:0 4px}
    .filters-row{display:flex;gap:14px;flex-wrap:wrap;align-items:center}
    .ctl{--h:44px;--br:12px;--bd:#e7e3d7;--tx:#2A2916;position:relative;display:inline-flex;align-items:center;gap:10px;height:var(--h);padding:0 12px;border:1px solid var(--bd);border-radius:var(--br);background:#fff;color:var(--tx)}
    .ctl input,.ctl select{flex:1;height:calc(var(--h) - 2px);border:0;outline:0;background:transparent;font-size:15px;color:#2A2916}
    .ctl input::placeholder{color:#C0BCA9}
    .ctl .sep{width:1px;height:60%;background:#e7e3d7;margin-left:auto}
    .ctl i{font-size:18px;color:#3a3826;opacity:.85}
    .ctl-search{min-width:260px}.ctl-select{min-width:280px}

    /* => Un seul chevron sur les <select> (on masque la flèche native) */
    .ctl-select select{
      appearance:none;-webkit-appearance:none;-moz-appearance:none;
      background:transparent; padding-right:28px;
    }
    .ctl-select select::-ms-expand{display:none}

    /* Bouton Réserver */
    .reserve-btn{display:inline-block;padding:7px 14px;border-radius:6px;background:#fff;color:#BF0404;border:1px solid #BF0404;font-weight:700;font-size:12px;cursor:pointer}
    .reserve-btn.is-active{background:#BF0404;color:#fff}
    .reserve-btn:hover{filter:brightness(.97)}
    .reserve-btn:disabled{background:#e9fbef;color:#138a3a;border-color:#bfe8cc;cursor:default}

    /* Pagination (custom boutons) */
    .abs-pager{float:right;display:flex;gap:12px;margin-top:16px}
    .abs-btn{width:27px;height:27px;border:2px solid #c60000;border-radius:3px;background:#fff;display:inline-flex;align-items:center;justify-content:center;color:#c60000;font-weight:700}
    .abs-num{min-width:20px;text-align:center;font-size:14px;color:#010103}

    /* Modal */
    .modal{position:fixed;inset:0;background:rgba(0,0,0,.45);display:none;align-items:center;justify-content:center;z-index:999}
    .modal.show{display:flex}
    .modal-card{width:440px;height:300px;background:#fff;border-radius:8px;box-shadow:0 12px 30px rgba(0,0,0,.2);overflow:hidden;animation:pop .16s ease-out}
    .modal-head{background:#B30404;color:#fff;padding:10px 14px;font-size:14px;position:relative;}
    .modal-close{position:absolute;right:10px;top:8px;background:transparent;border:none;color:#fff;font-size:18px;cursor:pointer}
    .modal-body{padding:18px;margin-top:30px}
    .modal-field{border:1px solid #E2E0D3;border-radius:8px;height:42px;display:flex;align-items:center;padding:0 10px;gap:8px}
    .modal-field input{border:0;outline:0;background:transparent;height:40px;flex:1}
    .modal-foot{display:flex;justify-content:space-between;align-items:center;padding:12px 18px;margin-top:50px}
    .btn-cancel{background:#b9b69a;border:none;border-radius:6px;padding:8px 16px;color:#fff;font:700 15px/20px Roboto;letter-spacing:.75px;color:#FCFCFC;text-transform:uppercase;cursor:pointer}
    .btn-primary{background:#CF0A0A;border:none;border-radius:6px;padding:8px 16px;color:#fff;font:700 15px/20px Roboto;letter-spacing:.75px;color:#FCFCFC;text-transform:uppercase;cursor:pointer}

    /* ==========================================================
       Head/Body séparés alignés (width auto + sync JS)
       ========================================================== */
    :root{--panel:#ECEBE3;--edge:#A6A4853D;--line:#EBE9D7;--ink:#2A2916}

    .table-wrap{margin-top:10px}
    .head-box{background:var(--panel);border:1px solid var(--edge);border-radius:8px;overflow:hidden}
    .head-table,.body-table{width:100%;border-collapse:separate;border-spacing:0;table-layout:auto}
    .head-table thead th{padding:12px 10px;font-weight:600;font-size:14px;color:var(--ink);background:transparent;border:0;box-sizing:border-box;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .head-table thead th + th{border-left:1px solid transparent}

    .body-box{background:#fff;border:2px solid var(--line);border-radius:12px;overflow:hidden;margin-top:10px}
    .body-table tbody td{padding:12px 10px;background:#fff;border:0;border-top:1px solid var(--line);box-sizing:border-box;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;vertical-align:middle}
    .body-table tbody tr:first-child td{border-top:none}
    .body-table tbody td+td{border-left:1px solid var(--line)}
    .body-table tbody tr:nth-child(even){background:#ECEBE34D}

    /* Dernière colonne centrée (boutons) */
    .head-table thead th:last-child,.body-table tbody td:last-child{text-align:center}

    .titre-offre{color:#1a1a1a;text-decoration:none}

    /* === Onglets 2 & 3 : colonnes fixes + wrap sur colonnes longues === */
    #tab2 .head-table, #tab3 .head-table,
    #tab2 .body-table, #tab3 .body-table{ table-layout: fixed; }
    #tab2 .body-table td:nth-child(3),#tab2 .body-table td:nth-child(4),#tab2 .body-table td:nth-child(7),
    #tab3 .body-table td:nth-child(3),#tab3 .body-table td:nth-child(4),#tab3 .body-table td:nth-child(7){
      white-space: normal; overflow-wrap: anywhere;
    }
    #tab2 .head-table th:nth-child(3),#tab2 .head-table th:nth-child(4),#tab2 .head-table th:nth-child(7),
    #tab3 .head-table th:nth-child(3),#tab3 .head-table th:nth-child(4),#tab3 .head-table th:nth-child(7){
      white-space: normal;
    }
  </style>
</head>
<body>
  <div class="content-block">
    <div class="accordion-container">
      <!-- Tabs -->
      <div class="accordion-tabs">
        <button class="tab-btn active" data-tab="tab1">Catalogues des ouvrages</button>
        <button class="tab-btn" data-tab="tab2">Catalogues des théses</button>
        <button class="tab-btn" data-tab="tab3">Catalogues des mémoires</button>
        <button class="tab-btn" data-tab="tab4">Mes réservations</button>
      </div>

      <div class="accordion-content">
        <!-- Onglet 1 -->
        <div id="tab1" class="tab-panel active" data-tabkey="tab1">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-tab1" placeholder="Recherchez..."><span class="sep"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain-tab1">
                  <option value="">Rubrique</option>
                  <option>Informatique</option>
                  <option>Intelligence Artificielle</option>
                  <option>Systèmes Intelligents</option>
                </select>
                <span class="sep"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
            </div>
          </div>

          <div class="table-wrap">
            <div class="head-box">
              <table class="head-table" aria-hidden="true">
                <colgroup><col><col><col><col><col></colgroup>
                <thead><tr><th>Rubrique</th><th>Cote</th><th>Titre</th><th>Auteur</th><th>Réservé</th></tr></thead>
              </table>
            </div>

            <div class="body-box">
              <table class="body-table books-table" aria-describedby="catalogues des ouvrages">
                <colgroup><col><col><col><col><col></colgroup>
                <tbody class="books-tbody"></tbody>
              </table>
            </div>
          </div>

          <div class="abs-pager" data-tab="tab1">
            <button class="abs-btn" data-action="first">&laquo;</button><button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button><button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

        <!-- Onglet 2 (Rubrique supprimée) -->
        <div id="tab2" class="tab-panel" data-tabkey="tab2">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-tab2" placeholder="Recherchez..."><span class="sep"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
            </div>
          </div>

          <div class="table-wrap">
            <div class="head-box">
              <table class="head-table" aria-hidden="true">
                <colgroup>
                  <col style="width:14%"/><col style="width:7%"/><col style="width:27%"/><col style="width:13%"/>
                  <col style="width:10%"/><col style="width:8%"/><col style="width:14%"/><col style="width:7%"/>
                </colgroup>
                <thead>
                  <tr>
                    <th>Rubrique</th><th>Cote</th><th>Titre</th><th>Auteur</th>
                    <th>Date édition</th><th>Lieux édition</th><th>Édition</th><th>Réservé</th>
                  </tr>
                </thead>
              </table>
            </div>

            <div class="body-box">
              <table class="body-table books-table wide" aria-describedby="catalogues des thèses">
                <colgroup>
                  <col style="width:14%"/><col style="width:7%"/><col style="width:27%"/><col style="width:13%"/>
                  <col style="width:10%"/><col style="width:8%"/><col style="width:14%"/><col style="width:7%"/>
                </colgroup>
                <tbody class="books-tbody"></tbody>
              </table>
            </div>
          </div>

          <div class="abs-pager" data-tab="tab2">
            <button class="abs-btn" data-action="first">&laquo;</button><button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button><button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

        <!-- Onglet 3 (Rubrique supprimée) -->
        <div id="tab3" class="tab-panel" data-tabkey="tab3">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-tab3" placeholder="Recherchez..."><span class="sep"></span><i class="fa-solid fa-magnifying-glass"></i>
              </label>
            </div>
          </div>

          <div class="table-wrap">
            <div class="head-box">
              <table class="head-table" aria-hidden="true">
                <colgroup>
                  <col style="width:14%"/><col style="width:7%"/><col style="width:27%"/><col style="width:13%"/>
                  <col style="width:10%"/><col style="width:8%"/><col style="width:14%"/><col style="width:7%"/>
                </colgroup>
                <thead>
                  <tr>
                    <th>Rubrique</th><th>Cote</th><th>Titre</th><th>Auteur</th>
                    <th>Date édition</th><th>Lieux édition</th><th>Édition</th><th>Réservé</th>
                  </tr>
                </thead>
              </table>
            </div>

            <div class="body-box">
              <table class="body-table books-table wide" aria-describedby="catalogues des mémoires">
                <colgroup>
                  <col style="width:14%"/><col style="width:7%"/><col style="width:27%"/><col style="width:13%"/>
                  <col style="width:10%"/><col style="width:8%"/><col style="width:14%"/><col style="width:7%"/>
                </colgroup>
                <tbody class="books-tbody"></tbody>
              </table>
            </div>
          </div>

          <div class="abs-pager" data-tab="tab3">
            <button class="abs-btn" data-action="first">&laquo;</button><button class="abs-btn" data-action="prev">&lsaquo;</button>
            <span class="abs-num">1</span>
            <button class="abs-btn" data-action="next">&rsaquo;</button><button class="abs-btn" data-action="last">&raquo;</button>
          </div>
        </div>

        <!-- Onglet 4 (Rubrique supprimée) -->
        <div id="tab4" class="tab-panel" data-tabkey="tab4">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-tab4" placeholder="Recherchez...">
                <span class="sep"></span>
                <i class="fa-solid fa-magnifying-glass"></i>
              </label>
            </div>
          </div>

          <div class="table-wrap">
            <div class="head-box">
              <table class="head-table" aria-hidden="true">
                <colgroup><col><col><col><col><col><col></colgroup>
                <thead>
                  <tr>
                    <th>Catalogue</th><th>Cote</th><th>Rubrique</th><th>Titre</th><th>Date réservation</th><th>Décision</th>
                  </tr>
                </thead>
              </table>
            </div>

            <div class="body-box">
              <table class="body-table reservations-table" aria-describedby="mes réservations">
                <colgroup><col><col><col><col><col><col></colgroup>
                <tbody class="reservations-tbody"></tbody>
              </table>
            </div>
          </div>

          <div class="abs-pager" data-tab="tab4">
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

  <!-- Modal -->
  <div class="modal" id="reserveModal" aria-hidden="true">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="reserveTitle">
      <div class="modal-head">
        <div id="reserveTitle">Réserver un livre</div>
        <button class="modal-close" type="button" data-close>&times;</button>
      </div>
      <div class="modal-body">
        <label style="display:block;margin-bottom:6px;font-weight:600;color:#2A2916">Choisir une date</label>
        <div class="modal-field">
          <input type="date" id="reserveDate"/>
        </div>
      </div>
      <div class="modal-foot">
        <button class="btn-cancel" type="button" data-close>ANNULER</button>
        <button class="btn-primary" type="button" id="confirmReserve">RÉSERVER</button>
      </div>
    </div>
  </div>

  <script>
  /* ===== Données ===== */
  const pageSize = 4;

  const dataSimple = [
    { id:"B1", rubrique:"Informatique", cote:"J09",  titre:"Pattern Recognition And Machine Learning",   auteur:"Christopher M. Bishop", reserve:false, reserveDate:null },
    { id:"B2", rubrique:"Intelligence Artificielle", cote:"K890", titre:"Deep Learning",                 auteur:"Aaron Courville",       reserve:false, reserveDate:null },
    { id:"B3", rubrique:"Systèmes Intelligents",     cote:"J97",  titre:"Artificial Intelligence: A Modern Approach", auteur:"Peter Norvig", reserve:false, reserveDate:null }
  ];

  const dataWide = [
    { id:"W1", rubrique:"Informatique", cote:"J09",  titre:"Pattern Recognition And Machine Learning",   auteur:"Christopher M. Bishop", date_edition:"08-12-2024", lieu_edition:"Paris", edition:"Université De Paris-Dauphine",     reserve:false, reserveDate:null },
    { id:"W2", rubrique:"Intelligence Artificielle", cote:"K890", titre:"Deep Learning",                 auteur:"Aaron Courville",       date_edition:"08-12-2024", lieu_edition:"Paris", edition:"Université De Paris IX-Dauphine",  reserve:false, reserveDate:null },
    { id:"W3", rubrique:"Systèmes Intelligents",     cote:"J97",  titre:"Artificial Intelligence: A Modern Approach", auteur:"Peter Norvig", date_edition:"08-12-2024", lieu_edition:"Paris", edition:"Université De Paris IX-Dauphine",  reserve:false, reserveDate:null }
  ];

  const dataReservations = [
    { id:"R1", catalogue:"J09",  cote:"J09",  rubrique:"AI", titre:"Pattern Recognition And Machine Learning", date_reservation:"08-12-2024", decision:"En Attente" },
    { id:"R2", catalogue:"K890", cote:"K890", rubrique:"AI", titre:"Deep Learning",                              date_reservation:"08-12-2024", decision:"En Attente" }
  ];

  const store = {
    tab1: JSON.parse(JSON.stringify(dataSimple)),
    tab2: JSON.parse(JSON.stringify(dataWide)),
    tab3: JSON.parse(JSON.stringify(dataWide)),
    tab4: JSON.parse(JSON.stringify(dataReservations))
  };
  const currentPage = { tab1:1, tab2:1, tab3:1, tab4:1 };

  /* ===== Onglets ===== */
  document.querySelectorAll('.tab-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
      const id = btn.dataset.tab;
      document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById(id).classList.add('active');
      renderTab(id);
    });
  });

  /* ===== Rendu lignes ===== */
  function renderRow(tabKey, row){
    const wide = (tabKey==='tab2' || tabKey==='tab3');
    if(wide){
      return `
        <td>${row.rubrique}</td>
        <td>${row.cote}</td>
        <td><a href="#" class="titre-offre" data-id="${row.id}" data-tab="${tabKey}">${row.titre}</a></td>
        <td>${row.auteur}</td>
        <td>${row.date_edition||''}</td>
        <td>${row.lieu_edition||''}</td>
        <td>${row.edition||''}</td>
        <td>
          <button class="reserve-btn ${row._active?'is-active':''}" data-id="${row.id}" data-tab="${tabKey}" ${row.reserve?'disabled':''}>
            ${row.reserve ? 'Réservé' : 'Réserver'}
          </button>
        </td>`;
    }
    return `
      <td>${row.rubrique}</td>
      <td>${row.cote}</td>
      <td><a href="#" class="titre-offre" data-id="${row.id}" data-tab="${tabKey}">${row.titre}</a></td>
      <td>${row.auteur}</td>
      <td>
        <button class="reserve-btn ${row._active?'is-active':''}" data-id="${row.id}" data-tab="${tabKey}" ${row.reserve?'disabled':''}>
          ${row.reserve ? 'Réservé' : 'Réserver'}
        </button>
      </td>`;
  }

  function renderRowTab4(row){
    return `
      <td>${row.catalogue}</td>
      <td>${row.cote}</td>
      <td>${row.rubrique}</td>
      <td>${row.titre}</td>
      <td>${row.date_reservation}</td>
      <td><button class="decision-btn">${row.decision}</button></td>`;
  }

  /* ===== Rendu par onglet ===== */
  function renderTab(tabKey){
    const panel = document.getElementById(tabKey);
    const isTab4 = tabKey === 'tab4';
    const tbody = panel.querySelector(isTab4 ? '.reservations-tbody' : '.books-tbody');

    const q = (document.getElementById(`f-q-${tabKey}`)?.value || '').toLowerCase().trim();
    const rub = (document.getElementById(`f-domain-${tabKey}`)?.value || '').trim();

    const all = store[tabKey] || [];
    let filtered = all.filter(r=>{
      const title = (r.titre||'').toLowerCase();
      const qOk = q ? title.includes(q) : true;
      const rubValue = r.rubrique || '';
      const rubOk = rub ? rubValue === rub : true;
      return qOk && rubOk;
    });

    const pageCount = Math.max(1, Math.ceil(filtered.length / pageSize));
    currentPage[tabKey] = Math.min(currentPage[tabKey], pageCount);

    const start = (currentPage[tabKey]-1)*pageSize;
    const rows = filtered.slice(start, start + pageSize);

    tbody.innerHTML = '';
    rows.forEach(row=>{
      const tr = document.createElement('tr');
      tr.innerHTML = isTab4 ? renderRowTab4(row) : renderRow(tabKey, row);
      tbody.appendChild(tr);
    });

    const pager = panel.querySelector('.abs-pager');
    pager.querySelector('.abs-num').textContent = currentPage[tabKey];

    // >>> sync head/body colonnes avec width auto
    syncColumns(tabKey);
  }

  /* ===== Pagination ===== */
  document.querySelectorAll('.abs-pager').forEach(pager=>{
    const tabKey = pager.dataset.tab;
    pager.addEventListener('click', e=>{
      const btn = e.target.closest('.abs-btn'); if(!btn) return;
      const action = btn.dataset.action;

      const q = (document.getElementById(`f-q-${tabKey}`)?.value || '').toLowerCase().trim();
      const rub = (document.getElementById(`f-domain-${tabKey}`)?.value || '').trim();
      const data = store[tabKey].filter(r=>{
        const qOk = q ? (r.titre||'').toLowerCase().includes(q) : true;
        const rubOk = rub ? (r.rubrique||'') === rub : true;
        return qOk && rubOk;
      });
      const pageCount = Math.max(1, Math.ceil(data.length / pageSize));

      if(action==='first') currentPage[tabKey]=1;
      else if(action==='prev') currentPage[tabKey]=Math.max(1,currentPage[tabKey]-1);
      else if(action==='next') currentPage[tabKey]=Math.min(pageCount,currentPage[tabKey]+1);
      else if(action==='last') currentPage[tabKey]=pageCount;

      // >>> sync uniquement pour les onglets en width auto (1 et 4)
      if (tabKey === 'tab1' || tabKey === 'tab4') {
        syncColumns(tabKey);
      }
      renderTab(tabKey);
    });
  });

  /* ===== Filtres ===== */
  ['tab1','tab2','tab3','tab4'].forEach(key=>{
    const qi = document.getElementById(`f-q-${key}`);
    const di = document.getElementById(`f-domain-${key}`); // n'existe que pour tab1 maintenant
    qi && qi.addEventListener('input', ()=>{ currentPage[key]=1; renderTab(key); });
    di && di.addEventListener('input', ()=>{ currentPage[key]=1; renderTab(key); });
  });

  /* ===== Modal Réservation (onglets 1–3) ===== */
  const modal = document.getElementById('reserveModal');
  const dateInput = document.getElementById('reserveDate');
  const confirmBtn = document.getElementById('confirmReserve');
  let currentBook = { tab:null, id:null, btn:null };

  function openModal(tabKey, bookId, btnEl){
    currentBook = { tab:tabKey, id:bookId, btn:btnEl };
    btnEl.classList.add('is-active');
    dateInput.value='';
    modal.classList.add('show'); modal.setAttribute('aria-hidden','false');
    setTimeout(()=>dateInput.focus(),0);
  }
  function closeModal(){
    modal.classList.remove('show'); modal.setAttribute('aria-hidden','true');
    const item = store[currentBook.tab]?.find(x=>x.id===currentBook.id);
    if(item && !item.reserve && currentBook.btn){ currentBook.btn.classList.remove('is-active'); }
    currentBook = { tab:null, id:null, btn:null };
  }
  modal.addEventListener('click', e=>{ if(e.target===modal || e.target.hasAttribute('data-close')) closeModal(); });
  document.addEventListener('keydown', e=>{ if(e.key==='Escape' && modal.classList.contains('show')) closeModal(); });

  confirmBtn.addEventListener('click', ()=>{
    if(!dateInput.value){ dateInput.reportValidity(); return; }
    const it = store[currentBook.tab].find(x=>x.id===currentBook.id);
    if(it){
      it.reserve = true; it.reserveDate = dateInput.value;
      if(currentBook.btn){ currentBook.btn.textContent='Réservé'; currentBook.btn.disabled=true; currentBook.btn.classList.add('is-active'); }
    }
    closeModal();
  });

  document.addEventListener('click', (e)=>{
    const btn = e.target.closest('.reserve-btn'); if(!btn || btn.disabled) return;
    const panel = btn.closest('.tab-panel');
    if(panel && panel.id === 'tab4') return; // Pas de modal sur l’onglet 4
    const tabKey = panel.id;
    openModal(tabKey, btn.dataset.id, btn);
  });

  /* ======= Synchronisation Head/Body (width auto) ======= */
  function syncColumns(tabKey){
    const panel = document.getElementById(tabKey);
    const headTable = panel.querySelector('.head-table');
    const bodyTable = panel.querySelector('.body-table');
    if(!headTable || !bodyTable) return;

    const hCols = headTable.querySelectorAll('colgroup col');
    const bCols = bodyTable.querySelectorAll('colgroup col');

    // clear widths
    hCols.forEach(c=>c.style.width='');
    bCols.forEach(c=>c.style.width='');

    // mesurer après paint
    requestAnimationFrame(()=>{
      let cells = null;
      const firstRow = bodyTable.tBodies[0] && bodyTable.tBodies[0].rows[0];
      if(firstRow && firstRow.cells.length){ cells = Array.from(firstRow.cells); }
      else if(headTable.tHead && headTable.tHead.rows[0]){ cells = Array.from(headTable.tHead.rows[0].cells); }

      if(!cells) return;
      const widths = cells.map(td => Math.ceil(td.getBoundingClientRect().width));

      for(let i=0;i<widths.length;i++){
        const w = widths[i] + 'px';
        if(hCols[i]) hCols[i].style.width = w;
        if(bCols[i]) bCols[i].style.width = w;
      }
    });
  }

  // debounce resize -> resynchroniser l’onglet actif (seulement 1 & 4)
  let _rsz;
  window.addEventListener('resize', ()=>{
    clearTimeout(_rsz);
    _rsz = setTimeout(()=>{
      const active = document.querySelector('.tab-panel.active');
      if(active && (active.id==='tab1' || active.id==='tab4')) syncColumns(active.id);
    }, 120);
  });

  // Init
  renderTab('tab1'); renderTab('tab2'); renderTab('tab3'); renderTab('tab4');
  </script>
</body>
</html>
