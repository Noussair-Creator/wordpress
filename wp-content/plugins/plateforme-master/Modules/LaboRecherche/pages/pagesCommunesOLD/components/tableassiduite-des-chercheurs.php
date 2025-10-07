<section id="assiduite">
  <!-- ====================== CSS libs ====================== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>

<style>
  /* ====== Conteneur ====== */
  #assiduite{ background:#f4f4f9; }
  #assiduite .content-block{ background:#fff; border-radius:10px; padding:24px; box-shadow:0 2px 6px rgba(0,0,0,.05); }
  #assiduite .header-bar{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
  #assiduite .dashboard-sub-title{ font-weight:700; display:flex; align-items:center; gap:8px; }
  #assiduite .add-project-btn{ background:#c60000; color:#fff; border:none; border-radius:6px; padding:10px 20px; font-weight:700; cursor:pointer; }
  #assiduite .add-project-btn:hover{ background:#a50000; }
  #assiduite .section-divider{ border:0; border-top:1px solid #e0e0e0; margin:10px 0; }

  /* ====== Filtres ====== */
  #assiduite .filter-bar{ display:flex; align-items:center; justify-content:space-between; gap:1rem; padding-bottom:30px; flex-wrap:wrap; }
  #assiduite .filter-inputs{ display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
  #assiduite .input-with-icon{ position:relative; }
  #assiduite .filter-input{ border:1px solid #e0e0e0; border-radius:6px; padding:.6rem .75rem; background:#fdfdfd; font-size:14px; height:42px; min-width:200px; box-sizing:border-box; }
  #assiduite .input-with-icon .icon{ position:absolute; top:50%; transform:translateY(-50%); right:.85rem; width:18px; opacity:.7; pointer-events:none; }
  #assiduite .input-with-icon .date-input{ padding-right:2.5rem; }

  /* ====== Table de base ====== */
  #assiduite .styled-table{ width:100%; border-collapse:separate; border-spacing:0; border-radius:10px; box-shadow:0 0 0 1px #ddd; background:#fff; }
  #assiduite .styled-table th, 
  #assiduite .styled-table td{ padding:14px; text-align:center; border-bottom:1px solid #eee; }
  #assiduite .styled-table tbody tr:last-child td{ border-bottom:none; }

  /* ====== Badges ====== */
  #assiduite .badge{ display:inline-block; padding:4px 10px; font-size:13px; font-weight:600; border-radius:20px; text-transform:capitalize; border:2px solid transparent; }
  #assiduite .badge-success{ color:#198754; background:#e6f7ee; border-color:#198754; }
  #assiduite .badge-warning{ color:#d89e00; background:#fff9e6; border-color:#d89e00; }

  /* ====== Actions / menu ====== */
  #assiduite .actions{ position:relative; display:inline-block; }
  #assiduite .action-btn{ background:transparent; color:#2d2a12; border:1px solid transparent; border-radius:8px; width:36px; height:36px; font-size:24px; font-weight:800; cursor:pointer; line-height:1; padding:0 0 10px; display:flex; align-items:center; justify-content:center; }
  #assiduite .action-btn:hover{ background:#e6e6de; box-shadow:0 1px 3px rgba(0,0,0,.1); }
  #assiduite .dropdown-menu{ display:none; position:absolute; top:100%; right:0; min-width:180px; background:#fff; border:1px solid #d8d4b7; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,.08); z-index:1000; padding:6px 0; }
  #assiduite .dropdown-menu.show{ display:block; }
  #assiduite .dropdown-menu a{ display:block; padding:8px 14px; text-decoration:none; font-size:14px; color:#2d2a12; }
  #assiduite .dropdown-menu a:hover{ background:#f4f4f4; }

  /* ====== Pagination DataTables ====== */
  #assiduite .dataTables_wrapper .dataTables_paginate{ display:flex; justify-content:center; align-items:center; gap:10px; margin-top:20px; }
  #assiduite .dataTables_wrapper .dataTables_paginate .paginate_button{
    border-radius:8px; border:2px solid #c60000!important; background:#fff!important; color:#c60000!important;
    font-weight:600; cursor:pointer; padding:10px 16px; transition:all .2s ease; display:inline-flex; align-items:center; justify-content:center;
  }
  #assiduite .dataTables_wrapper .dataTables_paginate .paginate_button.current{ background:#c60000!important; color:#fff!important; border:none!important; }
  #assiduite .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{ background:#a50000!important; }
  #assiduite .dataTables_wrapper .dataTables_paginate .paginate_button:hover{ background:#fde0e0!important; }
  #assiduite .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{ opacity:.5; cursor:default; background:#fff!important; }
  #assiduite .dataTables_wrapper .dataTables_paginate .ellipsis{ display:none!important; }

  /* ====== Modales ====== */
  #assiduite .modal-overlay{ position:fixed; inset:0; background:rgba(0,0,0,.5); display:none; justify-content:flex-end; z-index:9999; }
  #assiduite .popup-container{ background:#fff; width:450px; height:100%; padding:0; box-shadow:-4px 0 10px rgba(0,0,0,.1); overflow-y:auto; display:flex; flex-direction:column; }
  #assiduite .popup-header{ display:flex; align-items:center; justify-content:space-between; padding:20px 25px; box-shadow:0 5px 16px #0000001a; }
  #assiduite .popup-header h2{ font-size:18px; font-weight:700; color:#2A2916; margin:0; }
  #assiduite .btn-enregistrer{ background:#c62828; color:#fff; border:none; padding:8px 16px; border-radius:5px; cursor:pointer; font-size:14px; font-weight:600; }
  #assiduite .popup-form{ padding:25px; overflow-y:auto; flex:1; }
  #assiduite .form-group{ margin-bottom:15px; }
  #assiduite .form-group label{ display:block; font-weight:600; color:#7D7A55; font-size:14px; margin-left:10px; }
  #assiduite .form-group input, 
  #assiduite .form-group select, 
  #assiduite .form-group textarea{ width:100%; padding:10px 12px; border:1px solid #b5af8e; border-radius:7px; font-size:14px; box-sizing:border-box; margin-top:16px; }
  #assiduite .form-group input:focus, 
  #assiduite .form-group select:focus, 
  #assiduite .form-group textarea:focus{ outline:none; border-color:#c60000; box-shadow:0 0 0 2px rgba(198,0,0,.2); }
  #assiduite .form-hint{ font-size:12px; color:#666; margin-top:6px; }

  /* ====== Champ fichier custom (avec icône) ====== */
  #assiduite .custom-file{ display:flex; align-items:center; border:1px solid #e0e0e0; border-radius:6px; overflow:hidden; background:#fdfdfd; height:42px; margin-top:16px; }
  #assiduite .custom-file .name{ flex:1; padding:0 .75rem; font-size:14px; color:#6b7280; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
  #assiduite .custom-file input[type=file]{ display:none; }
  #assiduite .custom-file label{
    min-width:120px; height:100%; display:flex; align-items:center; justify-content:center; gap:8px;
    font-weight:700; background:#A6A485; color:#fff; cursor:pointer;
  }
  #assiduite .custom-file label img{ width:16px; height:16px; display:inline-block; }

  /* =======================================================
     SEPARATION VISUELLE THEAD / TBODY (style “référence”)
     ======================================================= */
  /* on neutralise le cadre général */
  #assiduite #assiduiteTable{ border:none !important; border-collapse:collapse !important; box-shadow:none !important; }

  /* bande d’en-tête indépendante */
  #assiduite #assiduiteTable thead{
    background:#f3f1e9;
    border:none !important;
    position:static;
    transform:translateY(-15px); /* espace visuel entre head et body */
  }
  #assiduite #assiduiteTable thead th{
    border:0 !important;            /* pas de traits dans le head */
    text-align:center !important;
    padding:14px;
    color:#7D7A55;
    font-weight:700;
  }

  /* corps du tableau : grille + coins arrondis */
  #assiduite #assiduiteTable tbody td{
    border:1px solid #EBE9D7 !important;
    text-align:center !important;
    padding:14px;
  }
  /* trait supérieur du bloc tbody */
  #assiduite #assiduiteTable tbody tr:first-child td{ border-top:1px solid #EBE9D7 !important; }
  /* coins arrondis */
  #assiduite #assiduiteTable tbody tr:first-child td:first-child{ border-top-left-radius:8px; }
  #assiduite #assiduiteTable tbody tr:first-child td:last-child { border-top-right-radius:8px; }
  #assiduite #assiduiteTable tbody tr:last-child  td:first-child{ border-bottom-left-radius:8px; }
  #assiduite #assiduiteTable tbody tr:last-child  td:last-child { border-bottom-right-radius:8px; }
</style>

  <div class="content-block">
    <div class="header-bar">
      <h2 class="dashboard-sub-title">
        <img width="40" style="margin:0 5px 10px" src="/wp-content/plugins/plateforme-master/images/icons/5038546.png" alt="">
        Assiduité des chercheurs
      </h2>
      <!-- Visible seulement pour Directeur -->
      <button class="add-project-btn" id="importBtn" style="display:none">Importer fiche présence</button>
    </div>

    <hr class="section-divider"/>

    <div class="filter-bar">
      <div class="filter-inputs">
        <div class="input-with-icon">
          <input id="globalSearch" class="filter-input" type="text" placeholder="Recherche...">
          <img class="icon" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-search.png" alt="">
        </div>
        <div class="input-with-icon">
          <input id="dateFilter" class="filter-input" type="text" placeholder="Période">
          <img class="icon" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="">
        </div>
      </div>
    </div>

    <table id="assiduiteTable" class="styled-table display">
      <thead>
        <tr id="theadRow"><!-- colonnes injectées JS --></tr>
      </thead>
      <tbody id="tbody"><!-- lignes injectées JS --></tbody>
    </table>
  </div>

  <!-- ============== Sidebar Directeur : Modifier l’assiduité ============== -->
  <div class="modal-overlay" id="sbEdit">
    <div class="popup-container">
      <div class="popup-header">
        <h2>Modifier l'assiduité</h2>
        <button class="btn-enregistrer" id="btnSaveEdit">Enregistrer</button>
      </div>
      <form class="popup-form">
        <!-- <div class="form-group">
          <label>Nom du chercheur</label>
          <input id="edChercheur" type="text" readonly>
        </div> -->
        <!-- <div class="form-group">
          <label>Date</label>
          <input id="edDate" type="text" readonly>
        </div> -->
        <div class="form-group">
          <label>Statut</label>
          <select id="edStatut">
            <option value="Présence">Présent</option>
            <option value="Mission">Mission</option>
            <option value="Stage">Stage</option>
          </select>
          <!-- <div class="form-hint">Pour Directeur : choisis parmi Présence / Mission / Stage / Absent.</div> -->
        </div>
        <!-- <div class="form-group">
          <label>Justification (texte)</label>
          <textarea id="edJustif" rows="3" placeholder="(optionnel)"></textarea>
        </div> -->
      </form>
    </div>
  </div>

  <!-- ============== Sidebar Chercheur : Ajouter justificatif ============== -->
  <div class="modal-overlay" id="sbJustif">
    <div class="popup-container">
      <div class="popup-header">
        <h2>Ajouter justificatif</h2>
        <button class="btn-enregistrer" id="btnSaveJustif">Enregistrer</button>
      </div>
      <form class="popup-form">
        <div class="form-group">
          <label>Pièce jointe</label>
          <div class="custom-file">
            <span id="juFileName" class="name"></span>
            <input type="file" id="juFile" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.odt,.xls,.xlsx,.csv">
           <label for="juFile">
  <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png" alt="Importer">
  Importer
</label>

          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ============== Modal Import (Directeur) ============== -->
  <div class="modal-overlay" id="importModal">
    <div class="popup-container">
      <div class="popup-header">
        <h2>Importer une feuille de présence</h2>
        <button class="btn-enregistrer" id="btnDoImport">Importer</button>
      </div>
      <div class="popup-form">
        <div class="form-group">
          <div class="custom-file">
            <span id="impName" class="name"></span>
            <input type="file" id="impFile" accept=".csv,.xlsx,.xls">
            <label for="impFile">
  <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png" alt="Importer">
  Importer
</label>

          </div>
          
        </div>
      </div>
    </div>
  </div>

  <!-- ====================== JS libs ====================== -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
  <!-- SheetJS pour lire .xlsx côté front -->
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

  <?php if ( is_user_logged_in() ) :
    $u = wp_get_current_user();
  ?>
  <script>
    window.pmsettings = {
      rest_root: <?php echo json_encode( esc_url_raw( rest_url() ) ); ?>,
      nonce:     <?php echo json_encode( wp_create_nonce( 'wp_rest' ) ); ?>,
      user_id:   <?php echo (int) get_current_user_id(); ?>,
      roles:     <?php echo json_encode( $u->roles ); ?>
    };
  </script>
  <?php else: ?>
    <p>Vous devez être connecté pour accéder à cette page.</p>
  <?php endif; ?>

  <script>
  (function(){
    const REST = (pmsettings?.rest_root || '/wp-json/').replace(/\/$/,'');
    const NONCE = pmsettings?.nonce || '';
    const ROLES = pmsettings?.roles || [];
    const IS_DIR = ROLES.includes('um_directeur_laboratoire');
    const IS_CH  = ROLES.includes('um_chercheur');

    const API_LIST = REST + '/plateforme-recherche/v1/assiduite';
    const API_ITEM = (id)=> REST + '/plateforme-recherche/v1/assiduite/'+id;
    const API_MEDIA= REST + '/wp/v2/media';

    // Elements
    const $table   = $('#assiduiteTable');
    const $tbody   = $('#tbody');
    const $thead   = $('#theadRow');
    const $search  = $('#globalSearch');
    const $df      = $('#dateFilter');

    const $importBtn   = $('#importBtn');
    const $importModal = $('#importModal');
    const $impFile     = $('#impFile');
    const $impName     = $('#impName');
    const $btnDoImport = $('#btnDoImport');

    const $sbEdit   = $('#sbEdit');     // Directeur
    const $edCher   = $('#edChercheur');
    const $edDate   = $('#edDate');
    const $edStatut = $('#edStatut');
    const $edJustif = $('#edJustif');
    const $btnSaveEdit = $('#btnSaveEdit');

    const $sbJustif = $('#sbJustif');   // Chercheur
    const $juDate   = $('#juDate');
    const $juStatut = $('#juStatut');
    const $juFile   = $('#juFile');
    const $juFileName = $('#juFileName');
    const $juJustif = $('#juJustif');
    const $btnSaveJustif = $('#btnSaveJustif');

    let DT = null;
    let CURRENT = [];   // données courantes
    let currentRow = null; // objet courant pour sidebars

    // ======= Construire entêtes selon le rôle =======
    function buildHead(){
      const colsDir = ['Chercheur','Grade','Date','Statut','Justification','Actions'];
      const colsCh  = ['Date','Statut','Justification','Actions'];
      const cols = IS_DIR ? colsDir : colsCh;
      $thead.empty();
      cols.forEach(c => $thead.append(`<th>${c}</th>`));
    }

    // ======= Badge statut =======
    function badge(st){
      if (!st || st.toLowerCase()==='absent') return `<span class="badge badge-warning">${st || 'Absent'}</span>`;
      return `<span class="badge badge-success">${st}</span>`;
    }
    // chemin PUBLIC de l’icône (ton path système ne marche pas dans le navigateur)
    const ATTACH_ICON_URL = "/wp-content/plugins/plateforme-master/images/icons/27) Icon-attach-2.png";

    // ======= Ligne HTML =======
    function trHTML(r){
      const justifCell = r.justification_path
        ? `<a href="${r.justification_path}" target="_blank" rel="noopener">
             <img width="20" src="${ATTACH_ICON_URL}" alt="Pièce jointe">
           </a>`
        : '-';

      const actBtn = IS_DIR
        ? `<a href="#" class="act-edit" data-id="${r.id}">Modifier</a>`
        : `<a href="#" class="act-justif" data-id="${r.id}">Ajouter justificatif</a>`;

      if (IS_DIR){
        return `<tr data-id="${r.id}">
          <td>${r.chercheur_nom || '-'}</td>
          <td>${r.grade || '-'}</td>
          <td>${r.date_fmt || r.date_presence || '-'}</td>
          <td>${badge(r.statut)}</td>
          <td>${justifCell}</td>
          <td>
            <div class="actions">
              <button class="action-btn">…</button>
              <div class="dropdown-menu">
                ${actBtn}
              </div>
            </div>
          </td>
        </tr>`;
      } else {
        return `<tr data-id="${r.id}">
          <td>${r.date_fmt || r.date_presence || '-'}</td>
          <td>${badge(r.statut)}</td>
          <td>${justifCell}</td>
          <td>
            <div class="actions">
              <button class="action-btn">…</button>
              <div class="dropdown-menu">
                ${actBtn}
              </div>
            </div>
          </td>
        </tr>`;
      }
    }

    // ======= Remplir tableau + DataTable =======
    function draw(){
      $tbody.html(CURRENT.map(trHTML).join(''));
      

      if (DT) { DT.destroy(); }
      DT = $table.DataTable({
        paging:true, searching:true, ordering:false, info:false, pageLength:5, dom:'rtip',
        language:{
          paginate:{ previous:"<i class='fa fa-chevron-left'></i>", next:"<i class='fa fa-chevron-right'></i>" },
          emptyTable:"Aucune donnée disponible", zeroRecords:"Aucun enregistrement correspondant trouvé"
        }
      });

      // Recherche fulltext
      $search.off('keyup').on('keyup', function(){ DT.search(this.value).draw(); });

      // Filtre date (flatpickr)
      flatpickr("#dateFilter", {
        mode: "range",
        dateFormat: "d/m/Y",
        locale: "fr",
        onChange: function(){
          // custom filtre DataTables
          const range = $df.val();
          $.fn.dataTable.ext.search = []; // reset
          if (!range) { DT.draw(); return; }
          $.fn.dataTable.ext.search.push(function(settings, data){
            const dateStr = IS_DIR ? data[2] : data[0];
            if (!dateStr) return true;

            const parse = (s)=>{ const [d,m,y]=s.split('/'); return new Date(+y,+m-1,+d); }
            const [a,b] = range.split(' au ');
            const dt = parse(dateStr);
            if (a && b){ return (dt >= parse(a) && dt <= parse(b)); }
            if (a){ return dt >= parse(a); }
            return true;
          });
          DT.draw();
        }
      });
    }

    // ======= Charger la liste =======
    async function load(){
      try{
        const res = await fetch(API_LIST, { headers:{'X-WP-Nonce': NONCE}, credentials:'same-origin' });
        const rows = await res.json();
        CURRENT = (rows||[]).map(r=>{
          let d = r.date_presence || '';
          if (d && /^\d{4}-\d{2}-\d{2}/.test(d)){
            const [Y,M,D] = d.split('-');
            r.date_fmt = `${D}/${M}/${Y}`;
          }
          return r;
        });
        draw();
      }catch(e){
        console.error(e);
        alert("Impossible de charger l’assiduité.");
      }
    }

// place ça en haut de ton IIFE, à côté des autres let/const
let HANDLERS_BOUND = false;

function bindRowActions(){
  if (HANDLERS_BOUND) return;      // évite les doublons

  // menu ⋯ (délégation sur le TABLE, qui ne change pas)
  $('#assiduiteTable').on('click', '.action-btn', function(e){
    e.stopPropagation();
    const $m = $(this).next('.dropdown-menu');
    $('.dropdown-menu').not($m).removeClass('show');
    $m.toggleClass('show');
  });

  // fermer menus en cliquant dehors
  $(document).on('click', ()=> $('.dropdown-menu').removeClass('show'));

  // Directeur -> Modifier
  $('#assiduiteTable').on('click', '.act-edit', function(e){
    e.preventDefault();
    const id = +$(this).data('id');
    openEdit(id);
  });

  // Chercheur -> Ajouter justificatif
  $('#assiduiteTable').on('click', '.act-justif', function(e){
    e.preventDefault();
    const id = +$(this).data('id');
    openJustif(id);
  });

  HANDLERS_BOUND = true;
}

    function findRow(id){ return CURRENT.find(x=> +x.id === +id); }

    // ---------- Sidebar Directeur ----------
    function openEdit(id){
      currentRow = findRow(id);
      if (!currentRow) return;

      $edCher.val(currentRow.chercheur_nom || '-');
      $edDate.val(currentRow.date_fmt || currentRow.date_presence || '-');
      $edStatut.val(currentRow.statut || 'Absent');
      $edJustif.val(currentRow.justification || '');

      $sbEdit.css('display','flex');
    }
    function closeEdit(){ $sbEdit.hide(); }

    $('#sbEdit').on('click', function(e){ if (e.target === this) closeEdit(); });

   $('#btnSaveEdit').on('click', async function(){
  if (!currentRow) return;
  try{
    const newStatut = $edStatut.val();
    const body = { statut: newStatut };

    const res = await fetch(API_ITEM(currentRow.id), {
      method:'PUT',
      headers:{ 'X-WP-Nonce': NONCE, 'Content-Type':'application/json' },
      credentials:'same-origin',
      body: JSON.stringify(body)
    });
    if (!res.ok) throw new Error('HTTP '+res.status);

    // --- MAJ optimiste en mémoire
    currentRow.statut = newStatut;

    // --- MAJ DOM de la cellule Statut, sans recharger la table
    const $tr = $table.find(`tbody tr[data-id="${currentRow.id}"]`);
    const statutColIndex = (IS_DIR ? 3 : 1); // Directeur: 0=Chercheur,1=Grade,2=Date,3=Statut...
    $tr.find('td').eq(statutColIndex).html( badge(newStatut) );

    closeEdit();
    // pas de load(); on laisse l’utilisateur modifier de suite une autre ligne
  }catch(e){
    console.error(e);
    alert("Échec de la mise à jour.");
  }
});

    // ---------- Sidebar Chercheur ----------
    function openJustif(id){
      currentRow = findRow(id);
      if (!currentRow) return;

      $juDate.val(currentRow.date_fmt || currentRow.date_presence || '-');
      $juStatut.val(currentRow.statut || 'Absent');
      $juJustif.val(currentRow.justification || '');
      $juFile.val(''); $juFileName.text('');

      $sbJustif.css('display','flex');
    }
    function closeJustif(){ $sbJustif.hide(); }
    $('#sbJustif').on('click', function(e){ if (e.target === this) closeJustif(); });

    $juFile.on('change', function(){
      $juFileName.text(this.files?.[0]?.name || '');
    });

    async function uploadMedia(file){
      const fd = new FormData();
      fd.append('file', file, file.name);
      const res = await fetch(API_MEDIA, {
        method:'POST',
        headers:{ 'X-WP-Nonce': NONCE },
        body: fd,
        credentials:'same-origin'
      });
      if (!res.ok) throw new Error('Upload media failed: ' + res.status);
      const json = await res.json();
      return json.id;
    }

    $('#btnSaveJustif').on('click', async function(){
      if (!currentRow) return;
      try{
        let pieceId = currentRow.piece_jointe_id || 0;
        if ($juFile[0].files.length){
          pieceId = await uploadMedia($juFile[0].files[0]);
        }
        const body = { piece_jointe_id: pieceId };

        const res = await fetch(API_ITEM(currentRow.id), {
          method:'PUT',
          headers:{ 'X-WP-Nonce': NONCE, 'Content-Type':'application/json' },
          credentials:'same-origin',
          body: JSON.stringify(body)
        });
        if (!res.ok) throw new Error('HTTP '+res.status);
        closeJustif();
        await load();
      }catch(e){
        console.error(e);
        alert("Échec d’enregistrement du justificatif.");
      }
    });

    // ======= IMPORT Directeur =======
    if (IS_DIR){ $importBtn.show(); } else { $importBtn.hide(); }

    function openImport(){ $importModal.css('display','flex'); }
    function closeImport(){ $importModal.hide(); $impFile.val(''); $impName.text(''); }

    $('#importModal').on('click', function(e){ if (e.target === this) closeImport(); });
    $importBtn.on('click', openImport);

    $impFile.on('change', function(){
      $impName.text(this.files?.[0]?.name || '');
    });

    async function parseFile(file){
      const ext = (file.name.split('.').pop() || '').toLowerCase();
      if (ext === 'csv'){
        const txt = await file.text();
        const rows = txt.split(/\r?\n/).map(l=>l.trim()).filter(Boolean);
        const header = rows.shift()?.split(',').map(s=>s.trim().toLowerCase()) || [];
        const idx = {
          email: header.indexOf('email'),
          date: header.indexOf('date'),
          statut: header.indexOf('statut'),
          justification: header.indexOf('justification')
        };
        return rows.map(l=>{
          const c = l.split(',');
          return {
            email: (c[idx.email]||'').trim(),
            date:  (c[idx.date]||'').trim(),
            statut:(c[idx.statut]||'').trim(),
            justification:(c[idx.justification]||'').trim()
          };
        }).filter(x=>x.email && x.date && x.statut);
      } else {
        const buf = await file.arrayBuffer();
        const wb = XLSX.read(buf, {type:'array'});
        const ws = wb.Sheets[wb.SheetNames[0]];
        const arr = XLSX.utils.sheet_to_json(ws, {defval:''});
        return arr.map(r=>({
          email: (r.Email||r.email||'').toString().trim(),
          date:  (r.Date ||r.date ||'').toString().trim(),
          statut:(r.Statut||r.statut||'').toString().trim(),
          justification:(r.Justification||r.justification||'').toString().trim()
        })).filter(x=>x.email && x.date && x.statut);
      }
    }

    $('#btnDoImport').on('click', async function(){
      if (!IS_DIR) return;
      const f = $impFile[0].files[0];
      if (!f) { alert('Veuillez choisir un fichier.'); return; }
      try{
        const rows = await parseFile(f);
        if (!rows.length){ alert("Fichier vide ou en-têtes manquants."); return; }

        let ok = 0, ko = 0;
        for (const r of rows){
          const payload = {
            chercheur_email: r.email,
            date_presence: r.date,
            statut: r.statut,
            justification: r.justification || ''
          };
          const res = await fetch(API_LIST, {
            method:'POST',
            headers:{ 'X-WP-Nonce': NONCE, 'Content-Type':'application/json' },
            credentials:'same-origin',
            body: JSON.stringify(payload)
          });
          if (res.ok){ ok++; } else { ko++; }
        }
        closeImport();
        await load();
        alert(`Import terminé : ${ok} ligne(s) ajoutée(s), ${ko} erreur(s).`);
      }catch(e){
        console.error(e);
        alert("Échec de l’import.");
      }
    });

    // ======= Initialisation =======
    buildHead();
    bindRowActions(); 
    load();
  })();
  </script>
</section>
