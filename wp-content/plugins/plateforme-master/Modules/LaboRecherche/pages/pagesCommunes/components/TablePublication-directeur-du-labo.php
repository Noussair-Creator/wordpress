<?php 
/** =========================================================================
 *  FRONT — Publications (Suivi + Mes publications)
 *  - À coller dans une page/template WP (shortcode ou page builder).
 *  - Requiert un utilisateur connecté pour l’API.
 *  - Endpoints utilisés:
 *      GET   /plateforme-recherche/v1/publication?with_auteur=1&scope=director_labs
 *      GET   /plateforme-recherche/v1/publication?me=1&include_shared=1[&shared_scope=lab]
 *      POST  /plateforme-recherche/v1/publication/{id}/validate
 *      POST  /plateforme-recherche/v1/publication/{id}/reject
 *      POST  /plateforme-recherche/v1/publication/{id}/publish
 *      DELETE/plateforme-recherche/v1/publication/{id}
 *  ====================================================================== */
if (!defined('ABSPATH')) exit;

// Rôles pour le front (exposés plus bas au JS)
$current_user = wp_get_current_user();
$roles = is_user_logged_in() ? (array) $current_user->roles : array();
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
:root{
  --ink:#2A2916;
  --line:#EBE9D7;
  --muted:#6E6D55;
  --chip:#E9E7D7;
  --chip-active:#A6A485;
  --danger:#D71920;
  --success:#198754;
  --warning:#d89e00;
}
body{font-family:'Segoe UI',sans-serif;background:#f9f9f9}

/* ---------- Container & Tabs ---------- */
.accordion-container{border-radius:12px;box-shadow:0 0 8px rgba(0,0,0,.05)}
.accordion-tabs{display:flex;background:#f3f3f3}
.tab-btn{
  flex:1;padding:15px 20px;font-weight:700;border:none;background:#A6A485;color:#fff;
  cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;gap:10px
}
.tab-btn:first-child{border-top-left-radius:11px;border-top-right-radius:11px;margin-right:10px}
.tab-btn:last-child{border-top-right-radius:11px;border-top-left-radius:11px}
.tab-btn.active{background:#fff;color:var(--ink)}
.accordion-content{padding:25px;background:#fff}
.tab-panel{display:none}
.tab-panel.active{display:block}

/* ---------- Toolbars ---------- */
.table-controls{
  display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-bottom:33px
}
.filter-group{display:flex;gap:7px;flex-wrap:wrap;align-items:center}
.search-box{
  display:flex;align-items:center;border:1px solid #d8d4b7;border-radius:8px;padding:0 10px;background:#fff;min-width:240px
}
.search-box i{color:#666;margin-right:6px}
.filter-input{padding:10px 6px;border:none;outline:none;font-size:14px;background:#fff;width:100%}

.date-input-container{
  display:flex;align-items:center;border:1px solid #d8d4b7;border-radius:8px;padding:0 10px;background:#fff
}
.date-input{padding:10px 6px;border:none;outline:none;font-size:14px;background:#fff}
.date-input-container img{margin-left:6px}

.filter-select{
  padding:10px 12px;border-radius:8px;border:1px solid #d8d4b7;background:#fff;font-size:14px;
  appearance:none;background-position:right 10px center;background-repeat:no-repeat;background-size:12px
}

/* segmented control (onglet 2) */
.seg{display:inline-flex;gap:6px;background:#fff;border-radius:10px;padding:4px;border:1px solid #d8d4b7}
.seg button{
  border:none;border-radius:8px;padding:8px 14px;background:#fff;color:#333;font-weight:700;cursor:pointer
}
.seg button.active{background:var(--chip-active);color:#fff}

.filter-actions{display:flex;gap:10px;align-items:center}
.add-project-btn{
  background:var(--danger);color:#fff;border:none;border-radius:8px;padding:10px 16px;font-weight:700;text-decoration:none
}
.add-project-btn:hover{background:#b8151a}
.icon-btn{
  width:40px;height:40px;background:#fff;border-radius:10px;border:1px solid #ddd;
  box-shadow:0 0 5px rgba(0,0,0,.06);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--danger)
}

/* ---------- Table ---------- */
.styled-table{width:100%;border-collapse:collapse}
.styled-table thead{background:#f3f1e9}
.styled-table th,.styled-table td{padding:14px;text-align:left;border-bottom:1px solid #eee}
.styled-table tbody tr:hover{background:#fafafa}
#candidaturesTable,#mesPublicationsTable{border:none !important;box-shadow:none !important;border-collapse:separate;border-spacing:0}
#candidaturesTable th,#mesPublicationsTable th{border:0}
#candidaturesTable td,#mesPublicationsTable td{border:1px solid var(--line)}
#candidaturesTable thead,#mesPublicationsTable thead{position:static;transform:translateY(-15px)}
#candidaturesTable tbody tr:first-child td,#mesPublicationsTable tbody tr:first-child td{border-top:1px solid var(--line)!important}
/* arrondis */
#candidaturesTable thead tr:first-child th:first-child,#mesPublicationsTable thead tr:first-child th:first-child{border-top-left-radius:12px;border-bottom-left-radius:12px}
#candidaturesTable thead tr:first-child th:last-child,#mesPublicationsTable thead tr:first-child th:last-child{border-top-right-radius:12px;border-bottom-right-radius:12px}
#candidaturesTable tbody tr:last-child td:first-child,#mesPublicationsTable tbody tr:last-child td:first-child{border-bottom-left-radius:12px}
#candidaturesTable tbody tr:last-child td:last-child,#mesPublicationsTable tbody tr:last-child td:last-child{border-bottom-right-radius:12px}
#candidaturesTable tbody tr:first-child td:first-child,#mesPublicationsTable tbody tr:first-child td:first-child{border-top-left-radius:12px}
#candidaturesTable tbody tr:first-child td:last-child,#mesPublicationsTable tbody tr:first-child td:last-child{border-top-right-radius:12px}

/* badges statut */
.badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;font-size:13px;font-weight:700;border-radius:20px}
.badge-success{color:var(--success);background:#e6f7ee}
.badge-danger{color:var(--danger);background:#fff0f0}
.badge-warning{color:var(--warning);background:#fff9e6}
.badge-info{background:#e6f7ee;color:#198754}

/* actions dropdown */
.actions{position:relative;display:inline-block}
.action-btn{background:transparent;border:none;font-size:20px;cursor:pointer;padding:5px;width:36px;height:36px}
.dropdown-menu{
  display:none;position:absolute;top:100%;right:0;min-width:220px;background:#fff;border:1px solid #d8d4b7;border-radius:8px;
  box-shadow:0 4px 8px rgba(0,0,0,.1);z-index:1000;padding:6px 0
}
.dropdown-menu a{display:flex;align-items:center;gap:10px;padding:10px 16px;text-decoration:none;font-size:14px;color:var(--ink)}
.dropdown-menu a:hover{background:#f5f5f5}
.dropdown-menu i{width:16px;text-align:center}

/* DataTables pagination */
.dataTables_wrapper .dataTables_paginate{
  display:flex;justify-content:end;align-items:center;gap:10px;margin-top:16px
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
  border:2px solid var(--danger);color:var(--danger)!important;padding:8px 14px;border-radius:8px;background:#fff!important;font-weight:700;cursor:pointer
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current{border:none}
.dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover{background:#fdf0f0!important}

/* séparateur dans tab2 au-dessus du tableau */
#tab2 .section-divider{border:none;height:1px;background:#eee;margin-bottom:18px}
</style>

<div class="accordion-container">
  <div class="accordion-tabs">
    <button class="tab-btn active" data-tab="tab1">Suivi Des Publications</button>
    <button class="tab-btn" data-tab="tab2">Mes Publications</button>
  </div>

  <div class="accordion-content">
    <!-- ================= TAB 1 : publications de mes labos ================= -->
    <div class="tab-panel active" id="tab1">
      <div class="table-controls">
        <div class="filter-group">
          <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" class="filter-input" id="candidaturesSearch" placeholder="Recherchez...">
          </div>

          <select class="filter-select" id="statusFilterSuivi">
            <option value="">Statut</option>
            <option value="Validée">Validée</option>
            <option value="Publiée">Publiée</option>
            <option value="En attente">En attente</option>
            <option value="Rejetée">Rejetée</option>
          </select>

          <div class="date-input-container">
            <input type="text" class="date-input" id="dateFilterSuivi" placeholder="période">
            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="" onerror="this.style.display='none'">
          </div>
        </div>

        <div class="filter-actions">
          <button class="icon-btn" title="Filtrer"><i class="fa-solid fa-filter"></i></button>
          <button class="icon-btn" title="Exporter"><i class="fa-solid fa-download"></i></button>
        </div>
      </div>

      <table class="styled-table" id="candidaturesTable">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkAllSuivi"></th>
            <th>Auteur(s)</th>
            <th>Type</th>
            <th>Date soumission</th>
            <th>Titre de la publication</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- ================= TAB 2 : Mes publications ================= -->
    <div class="tab-panel" id="tab2">
      <hr class="section-divider">
      <div class="table-controls">
        <div class="filter-group">
          <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" class="filter-input" id="mesPublicationsSearch" placeholder="Recherchez...">
          </div>

          <div class="date-input-container">
            <input type="text" class="date-input" id="dateFilterMesPublications" placeholder="Date">
            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="" onerror="this.style.display='none'">
          </div>

          <!-- Segmented control : Tous / Articles Partagés -->
          <div class="seg" role="tablist" aria-label="Filtre portée">
            <button type="button" class="seg-btn active" data-scope="all" aria-selected="true">Tous</button>
            <button type="button" class="seg-btn" data-scope="shared" aria-selected="false">Articles Partagés</button>
          </div>
        </div>

        <div class="filter-actions">
          <a href="/ajouter-une-publication" class="add-project-btn">Ajouter une publication</a>
          <button class="icon-btn" title="Filtrer"><i class="fa-solid fa-filter"></i></button>
          <button class="icon-btn" title="Exporter"><i class="fa-solid fa-download"></i></button>
        </div>
      </div>

      <table id="mesPublicationsTable" class="styled-table display">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Type</th>
            <th>Date soumission</th>
            <th>Titre de la publication</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<?php if (is_user_logged_in()): ?>
<script>
  // REST & roles exposés au JS
  window.pmsettings = {
    rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
    nonce:     <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
  };
  window.pmuser = {
    id:    <?php echo (int) get_current_user_id(); ?>,
    roles: <?php echo json_encode($roles); ?>
  };
</script>
<?php endif; ?>

<!-- jQuery + DataTables + Flatpickr -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

<script>
(function($){
  /* ====== Config REST ====== */
  const REST_ROOT = (window.pmsettings && pmsettings.rest_root) || (window.wpApiSettings && wpApiSettings.root) || '/wp-json/';
  const NONCE     = (window.pmsettings && pmsettings.nonce)     || (window.wpApiSettings && wpApiSettings.nonce) || '';
  const API       = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

  /* ====== Role checks ====== */
  const USER_ROLES  = (window.pmuser && Array.isArray(pmuser.roles)) ? pmuser.roles : [];
  const ROLES_LOWER = USER_ROLES.map(String).map(r=>r.toLowerCase());
  const IS_DIRECTEUR = ROLES_LOWER.some(r =>
    r==='um_directeur_laboratoire' ||
    r==='directeur_laboratoire'    ||
    r==='directeur-laboratoire'    ||
    r==='um_directeur-laboratoire' ||
    r==='um-directeur-laboratoire'
  );
  const IS_SERVICE_UTM = ROLES_LOWER.some(r => r==='um_service-utm' || r==='service_utm' || r==='service-utm');

  // Masquer "Ajouter une publication" pour Service UTM
  if (IS_SERVICE_UTM) {
    const addBtn = document.querySelector('#tab2 .add-project-btn');
    if (addBtn) addBtn.style.display = 'none';
  }

  /* ====== Helpers ====== */
  const esc = s => (''+(s??'')).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));
  const fmtDate = iso => {
    if (!iso || typeof iso!=='string') return '';
    const m = iso.match(/^(\d{4})-(\d{2})-(\d{2})/);
    return m ? `${m[3]}/${m[2]}/${m[1]}` : esc(iso);
  };
  const normStatut = s => {
    const v = (s||'').toString().trim().toLowerCase();
    if (v.startsWith('publi')) return 'Publiée';
    if (v.startsWith('val'))   return 'Validée';
    if (v.startsWith('rej'))   return 'Rejetée';
    return 'En attente';
  };
  const badge = st => {
    const map = {
      'Validée':    {cls:'badge-success', icn:'fa-circle-check'},
      'Rejetée':    {cls:'badge-danger',  icn:'fa-circle-stop'},
      'Publiée':    {cls:'badge-info',    icn:'fa-circle-check'},
      'En attente': {cls:'badge-warning', icn:'fa-clock'}
    };
    const m = map[st] || map['En attente'];
    return `<span class="badge ${m.cls}"><i class="fa-regular ${m.icn}"></i>${st}</span>`;
  };

  /* ====== DataTables base ====== */
  const baseDT = {
    paging:true, searching:true, ordering:false, info:false, pageLength:5, dom:'t<"bottom"p>',
    language:{
      paginate:{previous:"<i class='fa fa-chevron-left' style='color:#C60000;'></i>", next:"<i class='fa fa-chevron-right' style='color:#C60000;'></i>"},
      emptyTable:"Aucune donnée disponible dans le tableau",
      zeroRecords:"Aucun enregistrement correspondant trouvé"
    }
  };

  let dtSuivi=null, dtMes=null;
  let MES_SCOPE='all'; // 'all' | 'shared'

  /* ================= TAB 1 : Suivi ================= */
  async function loadSuiviPublications(){
    const res = await fetch(`${API}/publication?with_auteur=1&scope=director_labs`, {
      headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
    });

    const rows = res.ok ? await res.json() : [];
    const $tb = $('#candidaturesTable tbody').empty();

    rows.forEach(p=>{
      const st = normStatut(p.statut);
      const canModerate = IS_SERVICE_UTM || IS_DIRECTEUR || !!p.can_moderate;

      let actionsHtml = `<a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>`;
      if (canModerate) {
        actionsHtml += `
          <a href="/modifier-une-publication?id=${esc(p.id)}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
          <a href="#" class="js-validate" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Valider</a>
          <a href="#" class="js-publish"  data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Publier</a>
          <a href="#" class="js-reject"   data-id="${esc(p.id)}"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
        `;
      }

      $tb.append(`
        <tr data-id="${esc(p.id)}">
          <td><input type="checkbox" class="row-checkbox"></td>
          <td>${esc(p.auteur_display_name || '—')}</td>
          <td>${esc(p.type || '')}</td>
          <td data-date="${esc(p.date_publication || '')}">${fmtDate(p.date_publication)}</td>
          <td>${esc(p.titre || '')}</td>
          <td data-statut="${st}">${badge(st)}</td>
          <td>
            <div class="actions">
              <button class="action-btn" title="Actions"><i class="fa-solid fa-ellipsis"></i></button>
              <div class="dropdown-menu">${actionsHtml}</div>
            </div>
          </td>
        </tr>
      `);
    });

    if (dtSuivi) dtSuivi.destroy();
    dtSuivi = $('#candidaturesTable').DataTable({
      ...baseDT, columnDefs:[{orderable:false,targets:[0,6]}]
    });

    $('#candidaturesSearch').off('input').on('input', function(){ dtSuivi.search(this.value).draw(); });
    $('#statusFilterSuivi').off('change').on('change', function(){ dtSuivi.draw(); });
  }

  /* ================= TAB 2 : Mes publications (avec modération directeur) ================= */
async function loadMesPublications(){
  const url = `${API}/publication?me=1&include_shared=1${IS_DIRECTEUR ? '&shared_scope=lab' : ''}`;
  const res = await fetch(url, {
    headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'},
    credentials:'same-origin'
  });
  const rows = res.ok ? await res.json() : [];
  const $tb = $('#mesPublicationsTable tbody').empty();
  const CURRENT_ID = (window.pmuser && +pmuser.id) || 0;

  rows.forEach(p=>{
    const st = normStatut(p.statut);
    const sForMe  = Number(p.shared_for_me  || 0);
    const sForLab = Number(p.shared_for_lab || 0);
    const isShared = IS_DIRECTEUR ? (sForLab === 1 || sForMe === 1) : (sForMe === 1);
    const isMine = CURRENT_ID && (Number(p.created_by) === CURRENT_ID);

    // Directeur/Service UTM peut modérer
    const canModerate = IS_SERVICE_UTM || IS_DIRECTEUR || !!p.can_moderate;

    const editHrefMine   = `/modifier-une-publication?id=${esc(p.id)}`;
    const editHrefShared = `/modifier-partage?id=${esc(p.id)}`;
    const editHref = isMine ? editHrefMine : (isShared ? editHrefShared : editHrefMine);

    let actionsHtml = `<a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>`;
    let editAlreadyAdded = false;

    // Auteur : peut modifier/supprimer tant que pas Validée/Publiée
    if (isMine) {
      if (st !== 'Validée' && st !== 'Publiée') {
        actionsHtml += `
          <a href="${editHref}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
          <a href="#" class="js-del-pub" data-id="${esc(p.id)}"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
        `;
        editAlreadyAdded = true;
      }
    } else if (isShared) {
      // Destinataire d’un partage : peut modifier sa PART
      actionsHtml += `<a href="${editHref}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>`;
      editAlreadyAdded = true;
    }

    // Modération directeur/service UTM
    // ➜ n’ajoute "Modifier" ici que s’il n’est pas déjà présent
    if (canModerate) {
      if (!editAlreadyAdded) {
        actionsHtml += `<a href="${editHrefMine}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>`;
        editAlreadyAdded = true;
      }
      actionsHtml += `
        <a href="#" class="js-validate" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Valider</a>
        <a href="#" class="js-publish"  data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Publier</a>
        <a href="#" class="js-reject"   data-id="${esc(p.id)}"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
      `;
    }

    $tb.append(`
      <tr data-id="${esc(p.id)}" data-shared="${isShared ? 1 : 0}">
        <td><input type="checkbox" class="row-checkbox"></td>
        <td>${esc(p.type || '')}</td>
        <td data-date="${esc(p.date_publication || '')}">${fmtDate(p.date_publication)}</td>
        <td>${esc(p.titre || '')}</td>
        <td data-statut="${st}">${badge(st)}</td>
        <td>
          <div class="actions">
            <button class="action-btn" title="Actions"><i class="fa-solid fa-ellipsis"></i></button>
            <div class="dropdown-menu">${actionsHtml}</div>
          </div>
        </td>
      </tr>
    `);
  });

  if (dtMes) dtMes.destroy();
  dtMes = $('#mesPublicationsTable').DataTable({
    ...baseDT, columnDefs:[{orderable:false,targets:[0,5]}]
  });

  $('#mesPublicationsSearch').off('input').on('input', function(){ dtMes.search(this.value).draw(); });
}

  /* ================= Filtres globaux (status/date + scope tab2) ================= */
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex){
    const id = settings.sTableId;

    // ---- Filtre statut + date pour TAB 1
    if (id === 'candidaturesTable') {
      const wanted = $('#statusFilterSuivi').val() || '';
      const rowNode = settings.aoData[dataIndex].nTr;
      const st = $(rowNode).find('td').eq(5).data('statut') || '';
      if (wanted && st !== wanted) return false;

      const dp = document.getElementById('dateFilterSuivi')._flatpickr;
      if (dp && dp.selectedDates && dp.selectedDates.length===2) {
        const [from,to] = dp.selectedDates;
        const dateIso = $(rowNode).find('td').eq(3).data('date') || '';
        if (!dateIso) return false;
        const d = new Date(dateIso + 'T00:00:00');
        if (isNaN(d.getTime())) return false;
        if (d<from || d>to) return false;
      }
      return true;
    }

    // ---- Filtre scope + date pour TAB 2
    if (id === 'mesPublicationsTable') {
      const rowNode = settings.aoData[dataIndex].nTr;

      if (MES_SCOPE === 'shared') {
        const shared = Number($(rowNode).data('shared') || 0);
        if (shared !== 1) return false;
      }

      const dp = document.getElementById('dateFilterMesPublications')._flatpickr;
      if (dp && dp.selectedDates && dp.selectedDates.length===2) {
        const [from,to] = dp.selectedDates;
        const dateIso = $(rowNode).find('td').eq(2).data('date') || '';
        if (!dateIso) return false;
        const d = new Date(dateIso + 'T00:00:00');
        if (isNaN(d.getTime())) return false;
        if (d<from || d>to) return false;
      }
      return true;
    }
    return true;
  });

  /* ================= Flatpickr ================= */
  function initDatePickers(){
    const opts = {
      mode:'range', dateFormat:'Y-m-d', locale:'fr',
      onChange:function(){ if (dtSuivi) dtSuivi.draw(); if (dtMes) dtMes.draw(); }
    };
    flatpickr('#dateFilterSuivi', opts);
    flatpickr('#dateFilterMesPublications', opts);
  }

  /* ================= Dropdown actions ================= */
  $(document).on('click', '.action-btn', function(e){
    e.stopPropagation();
    const dd = $(this).closest('.actions').find('.dropdown-menu');
    $('.dropdown-menu').not(dd).hide();
    dd.toggle();
  });
  $(document).on('click', function(){ $('.dropdown-menu').hide(); });

  // Valider (tab1 & tab2)
  $(document).on('click', '.js-validate', async function(e){
    e.preventDefault();
    const id = $(this).data('id');
    try{
      const res = await fetch(`${API}/publication/${id}/validate`, {
        method:'POST', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      updateRowStatusEverywhere(id, 'Validée');
      broadcastStatus(id, 'Validée');
    }catch(err){ console.error(err); alert("Validation refusée (erreur serveur)."); }
  });

  // Publier (tab1 & tab2)
  $(document).on('click', '.js-publish', async function(e){
    e.preventDefault();
    const id = $(this).data('id');
    try{
      const res = await fetch(`${API}/publication/${id}/publish`, {
        method:'POST', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      updateRowStatusEverywhere(id, 'Publiée');
      broadcastStatus(id, 'Publiée');
    }catch(err){ console.error(err); alert("Publication impossible (erreur serveur)."); }
  });

  // Rejeter (tab1 & tab2) —> ne supprime PAS la ligne, change juste le statut
  $(document).on('click', '.js-reject', async function(e){
    e.preventDefault();
    if (!confirm('Rejeter cette publication ?')) return;
    const id = $(this).data('id');
    try{
      const res = await fetch(`${API}/publication/${id}/reject`, {
        method:'POST', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      updateRowStatusEverywhere(id, 'Rejetée');
      broadcastStatus(id, 'Rejetée');
    }catch(err){ console.error(err); alert("Rejet refusé (erreur serveur)."); }
  });

  // Supprimer (tab2) — inchangé
  $(document).on('click', '.js-del-pub', async function(e){
    e.preventDefault();
    if (!confirm('Supprimer cette publication ?')) return;
    const id = $(this).data('id');
    const $tr = $(`#mesPublicationsTable tr[data-id="${id}"]`);
    try{
      const res = await fetch(`${API}/publication/${id}`, {
        method:'DELETE', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      if (dtMes) dtMes.row($tr).remove().draw(false); else $tr.remove();
    }catch(err){ console.error(err); alert("Suppression impossible (erreur serveur)."); }
  });

  /* ================= Check-all ================= */
  $('#checkAllSuivi').on('change', function(){ $('#candidaturesTable tbody .row-checkbox').prop('checked', this.checked); });
  $('#checkAll').on('change', function(){ $('#mesPublicationsTable tbody .row-checkbox').prop('checked', this.checked); });

  /* ================= Tabs ================= */
  $('.tab-btn').on('click', async function(){
    const tabId = $(this).data('tab');
    $('.tab-btn').removeClass('active'); $(this).addClass('active');
    $('.tab-panel').removeClass('active'); $('#'+tabId).addClass('active');
    if (tabId==='tab2') { await loadMesPublications(); }
  });

  /* ================= Segmented control (tab2) ================= */
  $(document).on('click', '.seg-btn', function(){
    $('.seg-btn').removeClass('active').attr('aria-selected','false');
    $(this).addClass('active').attr('aria-selected','true');
    MES_SCOPE = $(this).data('scope'); // 'all' | 'shared'
    if (dtMes) dtMes.draw();
  });

  /* ================= Synchro temps réel (depuis autres pages) ================= */
  function updateRowStatusEverywhere(id, statut){
    const st = (['Validée','Publiée','Rejetée'].includes(statut)) ? statut : 'En attente';
    const h  = badge(st);

    // TAB 1
    let $tr = $(`#candidaturesTable tr[data-id="${id}"]`);
    if ($tr.length){
      const $st = $tr.find('td').eq(5);
      $st.data('statut', st).attr('data-statut', st).html(h);
      if (dtSuivi) dtSuivi.draw(false);
    }

    // TAB 2
    $tr = $(`#mesPublicationsTable tr[data-id="${id}"]`);
    if ($tr.length){
      const $st = $tr.find('td').eq(4);
      $st.data('statut', st).attr('data-statut', st).html(h);
      if (dtMes) dtMes.draw(false);
    }
  }

  // canal BroadcastChannel
  let bc = null;
  try {
    bc = new BroadcastChannel('pub-status');
    bc.onmessage = (e)=>{
      if (e?.data?.type==='publication-status-changed'){
        const {id, statut} = e.data.payload || {};
        if (id) updateRowStatusEverywhere(id, statut);
      }
    };
  } catch(_) {}

  // Fallback via localStorage
  window.addEventListener('storage', (e)=>{
    if (e.key==='pub_status_event' && e.newValue){
      try{
        const {id, statut} = JSON.parse(e.newValue);
        if (id) updateRowStatusEverywhere(id, statut);
      }catch(_){}
    }
  });

  // émetteur (utilisé par les handlers plus haut)
  function broadcastStatus(id, statut){
    const payload = { type:'publication-status-changed', payload:{ id:Number(id), statut:String(statut) } };
    if (bc) bc.postMessage(payload);
    try { localStorage.setItem('pub_status_event', JSON.stringify({ ...payload.payload, ts: Date.now() })); } catch(_){}
  }

  /* ================= Boot ================= */
  initDatePickers();
  loadSuiviPublications(); // tab1 par défaut
})(jQuery);
</script>
