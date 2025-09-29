<?php
/** =========================================================================
 *  FRONT — Publications (Suivi + Mes publications)
 *  - À coller dans une page/template WP (shortcode ou page builder via Template).
 *  - Requiert un utilisateur connecté pour l’API protégée.
 *  - Endpoints utilisés:
 *      GET   /plateforme-recherche/v1/publication?with_auteur=1
 *      GET   /plateforme-recherche/v1/publication?me=1&include_shared=1&shared_scope=lab
 *      POST  /plateforme-recherche/v1/publication/{id}/validate
 *      POST  /plateforme-recherche/v1/publication/{id}/reject
 *      DELETE/plateforme-recherche/v1/publication/{id}
 *  ====================================================================== */
if (!defined('ABSPATH')) exit;

// user roles pour le front
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
.badge-info{background:#808066;color:#fff}

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
            <option value="Validée">Acceptée</option>
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

  /* ====== Role checks (UN SEUL BLOC) ====== */
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
    if (v.startsWith('val')) return 'Validée';
    if (v.startsWith('rej')) return 'Rejetée';
    return 'En attente';
  };
  const badge = st => {
    const cls = st==='Validée' ? 'badge-success' : st==='Rejetée' ? 'badge-danger' : 'badge-warning';
    const icn = st==='Validée' ? 'fa-circle-check' : st==='Rejetée' ? 'fa-circle-stop' : 'fa-clock';
    return `<span class="badge ${cls}"><i class="fa-regular ${icn}"></i>${st}</span>`;
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
      const actionsHtml = canModerate
        ? `
            <a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>
            <a href="/modifier-une-publication?id=${esc(p.id)}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
            <a href="#" class="js-validate" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Valider</a>
            <a href="#" class="js-reject" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
          `
        : `<a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>`;

      $('#candidaturesTable tbody').append(`
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

  /* ================= TAB 2 : Mes publications (inclut partagés vers moi + vers mon labo si directeur) ================= */
  async function loadMesPublications(){
    // Si directeur, on passe shared_scope=lab pour que le backend prépare aussi les flags "lab"
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

      // Ce qui est "partagé" pour un directeur = (partage au labo) OU (partage directement à moi)
      const sForMe  = Number(p.shared_for_me  || 0);
      const sForLab = Number(p.shared_for_lab || 0);
      const isShared = IS_DIRECTEUR ? (sForLab === 1 || sForMe === 1) : (sForMe === 1);
      const isMine = CURRENT_ID && (Number(p.created_by) === CURRENT_ID);
      // Lien d'édition selon le contexte
      const editHref = isMine
      ? `/modifier-une-publication?id=${esc(p.id)}`
      : (isShared
          ? `/modifier-partage?id=${esc(p.id)}`
          : `/modifier-une-publication?id=${esc(p.id)}`);
      // Actions : pour une publication partagée → modifier toujours autorisé (on édite sa part)
      //           pour une publication à moi → pas d'édition si Validée (comportement existant)
    let actionsHtml = `<a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>`;
      if (isMine) {
      // J’édite ma propre publication (sauf si Validée)
      if (st !== 'Validée') {
        actionsHtml += `
          <a href="${editHref}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
          <a href="#" class="js-del-pub" data-id="${esc(p.id)}"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
        `;
      }
    } else if (isShared) {
      // Publication partagée AVEC moi → j’édite ma part
      actionsHtml += `<a href="${editHref}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>`;
    } else {
      // Publication non partagée et pas à moi (cas rare ici) → juste “Voir”
    }

      $tb.append(`
        <tr data-id="${esc(p.id)}" data-shared="${isShared ? 1 : 0}">
          <td><input type="checkbox" class="row-checkbox"></td>
          <td>${esc(p.type || '')}</td>
          <td data-date="${esc(p.date_publication || '')}">${fmtDate(p.date_publication)}</td>
          <td>${esc(p.titre || '')}${isShared ? ' ' : ''}</td>
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

  // Valider (tab1)
  $(document).on('click', '.js-validate', async function(e){
    e.preventDefault();
    const id = $(this).data('id');
    const $tr = $(`tr[data-id="${id}"]`);
    try{
      const res = await fetch(`${API}/publication/${id}/validate`, {
        method:'POST', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      const $st = $tr.find('td').eq(5);
      $st.data('statut','Validée').attr('data-statut','Validée').html(badge('Validée'));
      $tr.find('.dropdown-menu .js-validate, .dropdown-menu .js-reject').remove();
      if (dtSuivi) dtSuivi.draw(false);
    }catch(err){ console.error(err); alert("Validation refusée (erreur serveur)."); }
  });

  // Rejeter (tab1)
  $(document).on('click', '.js-reject', async function(e){
    e.preventDefault();
    if (!confirm('Rejeter cette publication ? Elle sera supprimée.')) return;
    const id = $(this).data('id');
    const $tr = $(`tr[data-id="${id}"]`);
    try{
      const res = await fetch(`${API}/publication/${id}/reject`, {
        method:'POST', headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'}, credentials:'same-origin'
      });
      if (!res.ok) throw new Error('HTTP '+res.status);
      if (dtSuivi) dtSuivi.row($tr).remove().draw(false); else $tr.remove();
    }catch(err){ console.error(err); alert("Rejet refusé (erreur serveur)."); }
  });

  // Supprimer (tab2)
  $(document).on('click', '.js-del-pub', async function(e){
    e.preventDefault();
    if (!confirm('Supprimer cette publication ?')) return;
    const id = $(this).data('id');
    const $tr = $(`tr[data-id="${id}"]`);
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

  /* ================= Boot ================= */
  initDatePickers();
  loadSuiviPublications(); // tab1 par défaut
})(jQuery);
</script>
