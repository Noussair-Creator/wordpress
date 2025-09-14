<?php
/** =========================================================================
 *  FRONT — Publications (Suivi + Mes publications)
 *  - À coller dans une page/template WP (shortcode ou page builder via Template).
 *  - Nécessite un utilisateur connecté pour l’API protégée.
 *  - Attend des endpoints REST:
 *      GET   /plateforme-recherche/v1/publication?with_auteur=1
 *      GET   /plateforme-recherche/v1/publication?me=1
 *      POST  /plateforme-recherche/v1/publication/{id}/validate
 *      POST  /platefo<rme-recherche/v1/publication/{id}/reject
 *      DELETE/plateforme-recherche/v1/publication/{id}
 *  ====================================================================== */

if (!defined('ABSPATH')) {
  exit;
}

// (Optionnel) Si ce bloc vit dans un autre fichier, assure-toi que ces lignes
// sont exécutées AVANT l’echo du JS ci-dessous.
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
  body {
    font-family: 'Segoe UI', sans-serif;
    background: #f9f9f9
  }

  .accordion-container {
    border-radius: 12px;
    box-shadow: 0 0 8px rgba(0, 0, 0, .05);
    /* border: 1px solid #ddd; */
  }

  .accordion-tabs {
    display: flex;
    background: #f3f3f3
  }

  .tab-btn {
    flex: 1;
    padding: 15px 20px;
    font-weight: 600;
    border: none;
    background: #A6A485;
    cursor: pointer;
    font-size: 18px;
    color: #fff;
    transition: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px
  }

  .tab-btn:first-child {
    border-top-left-radius: 11px;
    border-top-right-radius: 11px;
    margin-right: 10px
  }

  .tab-btn:last-child {
    border-top-right-radius: 11px;
    border-top-left-radius: 11px
  }

  .tab-btn.active {
    background: #fff;
    color: #2A2916
  }

  .accordion-content {
    padding: 25px;
    background: #fff
  }

  .tab-panel {
    display: none
  }

  .tab-panel.active {
    display: block
  }

  .table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 25px
  }

  .filter-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center
  }

  .search-box {
    display: flex;
    align-items: center;
    border: 1px solid #d8d4b7;
    border-radius: 6px;
    padding: 0 10px;
    background: #fff
  }

  .search-box i {
    color: #666
  }

  .filter-input {
    padding: 10px 5px;
    border-radius: 6px;
    border: none;
    outline: none;
    font-size: 14px;
    background: #fff;
    width: 200px
  }

  .date-input-container {
    display: flex;
    align-items: center;
    border: 1px solid #d8d4b7;
    border-radius: 6px;
    padding: 0 10px;
    background: #fff
  }

  .date-input {
    padding: 10px 5px;
    border: none;
    outline: none;
    font-size: 14px;
    border-radius: 6px
  }

  .filter-select {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #d8d4b7;
    font-size: 14px;
    background: #fff;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-position: right 10px center;
    background-repeat: no-repeat;
    background-size: 12px;
    padding-right: 30px;
    width: 200px
  }

  .filter-actions {
    display: flex;
    gap: 10px;
    align-items: center
  }

  .icon-btn {
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0 0 5px rgba(0, 0, 0, .08);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #D71920;
    font-size: 18px
  }

  .styled-table {
    width: 100%;
    border-collapse: collapse
  }

  .styled-table thead {
    background: #f3f1e9
  }

  .styled-table th,
  .styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee
  }

  .styled-table tbody tr:hover {
    background: #f9f9f9
  }

  .styled-table th {
    font-weight: 600;
    color: #333
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px
  }

  .badge-success {
    color: #198754;
    background: #e6f7ee
  }

  .badge-danger {
    color: #d71920;
    background: #fff0f0
  }

  .badge-warning {
    color: #d89e00;
    background: #fff9e6
  }

  .badge-info {
    background: #808066;
    color: #fff
  }

  #candidaturesTable,
  #mesPublicationsTable {
    border: none !important;
    border-collapse: collapse;
    box-shadow: none !important;
  }

  #candidaturesTable th,
  #mesPublicationsTable th {
    border: 0px solid #EBE9D7;
  }

  #candidaturesTable td,
  #mesPublicationsTable td {
    border: 1px solid #EBE9D7;
  }

  #candidaturesTable thead,
  #mesPublicationsTable thead {
    border: none !important;
    position: static;
    transform: translateY(-15px);
  }

  #candidaturesTable tbody tr:first-child td,
  #mesPublicationsTable tbody tr:first-child td {
    border-top: 1px solid #EBE9D7 !important;
  }

  #candidaturesTable,
  #mesPublicationsTable {
    border-collapse: separate;
    border-spacing: 0;
  }

  #candidaturesTable thead tr:first-child th:first-child,
  #mesPublicationsTable thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
  }

  #candidaturesTable thead tr:first-child th:last-child,
  #mesPublicationsTable thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;

  }

  #candidaturesTable tbody tr:last-child td:first-child,
  #mesPublicationsTable tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
  }

  #candidaturesTable tbody tr:last-child td:last-child,
  #mesPublicationsTable tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
  }

  #candidaturesTable tbody tr:first-child td:first-child,
  #mesPublicationsTable tbody tr:first-child td:first-child {
    border-top-left-radius: 12px;
  }

  #candidaturesTable tbody tr:first-child td:last-child,
  #mesPublicationsTable tbody tr:first-child td:last-child {
    border-top-right-radius: 12px;
  }





  .actions {
    position: relative;
    display: inline-block
  }

  .action-btn {
    background: transparent;
    border: none;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
    width: 36px;
    height: 36px
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 220px;
    background: #fff;
    border: 1px solid #d8d4b7;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, .1);
    z-index: 1000;
    padding: 6px 0
  }

  .dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    text-decoration: none;
    font-size: 14px;
    color: #2d2a12
  }

  .dropdown-menu a:hover {
    background: #f5f5f5
  }

  .dropdown-menu i {
    width: 16px;
    text-align: center
  }

  .dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: end;
    align-items: center;
    gap: 10px;
    margin-top: 20px
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    border: 2px solid #D71920;
    color: #D71920 !important;
    padding: 8px 14px;
    border-radius: 8px;
    background: #fff !important;
    font-weight: bold;
    cursor: pointer
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    border: none
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover {
    background: #fdf0f0 !important
  }

  #tab2 .section-divider {
    border: none;
    height: 1px;
    background: #eee;
    margin-bottom: 25px
  }

  #tab2 .add-project-btn {
    background: #D71920;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color .2s;
    text-decoration: none
  }

  #tab2 .add-project-btn:hover {
    background: #b8151a
  }

  /* Flatpickr */
  .flatpickr-calendar .flatpickr-day.selected,
  .flatpickr-calendar .flatpickr-day.startRange,
  .flatpickr-calendar .flatpickr-day.endRange {
    background: #D71920;
    border-color: #D71920;
    color: #fff
  }

  .flatpickr-weekdays {
    background: #c600001a
  }

  .flatpickr-current-month input.cur-year,
  .flatpickr-current-month .flatpickr-monthDropdown-months {
    color: #D71920
  }

  .flatpickr-calendar .flatpickr-day.inRange {
    background: #fdf0f0;
    box-shadow: -5px 0 0 #fdf0f0, 5px 0 0 #fdf0f0
  }

  .flatpickr-calendar .flatpickr-day.today {
    border-color: #D71920;
    color: #333
  }

  .flatpickr-calendar .flatpickr-day.today:hover {
    background: #e6e6e6;
    border-color: #D71920;
    color: #333
  }
</style>

<div class="accordion-container">
  <div class="accordion-tabs">
    <button class="tab-btn active" data-tab="tab1">Suivi Des Publications</button>
    <button class="tab-btn" data-tab="tab2">Mes Publications</button>
  </div>

  <div class="accordion-content">
    <!-- TAB 1 : publications de mes labos -->
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
            <option value="Rejetée">Rejetée</option>
            <option value="En attente">En attente</option>
          </select>
          <div class="date-input-container">
            <input type="text" class="date-input" id="dateFilterSuivi" placeholder="période">
            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt=""
              onerror="this.style.display='none'">
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

    <!-- TAB 2 : Mes publications -->
    <div class="tab-panel" id="tab2">
      <hr class="section-divider">
      <div class="table-controls">
        <div class="filter-group">
          <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" class="filter-input" id="mesPublicationsSearch" placeholder="Recherchez...">
          </div>
          <select class="filter-select" id="statusFilterMesPublications">
            <option value="">Statut</option>
            <option value="Validée">Validée</option>
            <option value="Rejetée">Rejetée</option>
            <option value="En attente">En attente</option>
          </select>
          <div class="date-input-container">
            <input type="text" class="date-input" id="dateFilterMesPublications" placeholder="période">
            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt=""
              onerror="this.style.display='none'">
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
    // REST settings exposées au JS
    window.pmsettings = {
      rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
      nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
    };
    // Rôles utilisateur courant
    window.pmuser = {
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
  (function ($) {
    // ====== Config REST ======
    const REST_ROOT =
      (window.pmsettings && pmsettings.rest_root) ||
      (window.wpApiSettings && wpApiSettings.root) ||
      '/wp-json/';
    const NONCE =
      (window.pmsettings && pmsettings.nonce) ||
      (window.wpApiSettings && wpApiSettings.nonce) ||
      '';
    const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

    // ====== Role check ======
    const USER_ROLES = (window.pmuser && Array.isArray(pmuser.roles)) ? pmuser.roles : [];
    // Slug rôle directeur labo
    const IS_DIRECTEUR = USER_ROLES.map(String).map(r => r.toLowerCase())
      .some(r => r === 'um_directeur_laboratoire' || r === 'directeur_laboratoire' || r ===
        'directeur-laboratoire');
    const IS_SERVICE_UTM = USER_ROLES.map(String).map(r=>r.toLowerCase())
      .some(r => r==='um_service-utm' || r==='service_utm' || r==='service-utm');

    // Masquer le bouton "Ajouter une publication" dans l’onglet 2
    if (IS_SERVICE_UTM) {
      const addBtn = document.querySelector('#tab2 .add-project-btn');
      if (addBtn) addBtn.style.display = 'none';
    }

    // ====== Helpers ======
    const esc = (s) => ('' + (s ?? '')).replace(/[&<>"']/g, m => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    }[m]));
    const fmtDate = (iso) => {
      if (!iso || typeof iso !== 'string') return '';
      const m = iso.match(/^(\d{4})-(\d{2})-(\d{2})/);
      return m ? `${m[3]}/${m[2]}/${m[1]}` : esc(iso);
    };
    const normStatut = (s) => {
      const v = (s || '').toString().trim().toLowerCase();
      if (v.startsWith('val')) return 'Validée';
      if (v.startsWith('rej')) return 'Rejetée';
      return 'En attente';
    };
    const badge = (st) => {
      const cls = st === 'Validée' ? 'badge-success' : st === 'Rejetée' ? 'badge-danger' : 'badge-warning';
      const icn = st === 'Validée' ? 'fa-circle-check' : st === 'Rejetée' ? 'fa-circle-stop' : 'fa-clock';
      return `<span class="badge ${cls}"><i class="fa-regular ${icn}"></i>${st}</span>`;
    };

    // ====== DataTables base config ======
    const baseDT = {
      paging: true,
      searching: true,
      ordering: false,
      info: false,
      pageLength: 5,
      dom: 't<"bottom"p>',
      language: {
        paginate: {
          previous: "<i class='fa fa-chevron-left' style='color:#C60000;'></i>",
          next: "<i class='fa fa-chevron-right' style='color:#C60000;'></i>"
        },
        emptyTable: "Aucune donnée disponible dans le tableau",
        zeroRecords: "Aucun enregistrement correspondant trouvé"
      }
    };

    let dtSuivi = null,
      dtMes = null;

    // ===================== TAB 1 : Suivi (publications de mes labos) =====================
    async function loadSuiviPublications() {
      const res = await fetch(`${API}/publication?with_auteur=1`, {
        headers: {
          'X-WP-Nonce': NONCE,
          'Accept': 'application/json'
        },
        credentials: 'same-origin'
      });
      const rows = res.ok ? await res.json() : [];

      const $tb = $('#candidaturesTable tbody').empty();

      rows.forEach(p => {
        const st = normStatut(p.statut);
        // Moderator si directeur OU si l'API renvoie can_moderate
       const canModerate = IS_SERVICE_UTM || IS_DIRECTEUR || !!p.can_moderate;

const actionsHtml = canModerate
  ? `
     <a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>
     <a href="/modifier-une-publication?id=${esc(p.id)}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
     <a href="#" class="js-validate" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-check"></i>Valider</a>
     <a href="#" class="js-reject" data-id="${esc(p.id)}"><i class="fa-regular fa-circle-xmark"></i>Rejeter</a>
    `
  : `
     <a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>
    `;



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
        ...baseDT,
        columnDefs: [{
          orderable: false,
          targets: [0, 6]
        }]
      });

      // Filtres
      $('#candidaturesSearch').off('input').on('input', function () {
        dtSuivi.search(this.value).draw();
      });
      $('#statusFilterSuivi').off('change').on('change', function () {
        dtSuivi.draw();
      });
    }

    // ===================== TAB 2 : Mes publications =====================
    async function loadMesPublications() {
      const res = await fetch(`${API}/publication?me=1`, {
        headers: {
          'X-WP-Nonce': NONCE,
          'Accept': 'application/json'
        },
        credentials: 'same-origin'
      });
      const rows = res.ok ? await res.json() : [];

      const $tb = $('#mesPublicationsTable tbody').empty();
      rows.forEach(p => {
        const st = normStatut(p.statut);
        const actionsHtml = (st === 'Validée') ?
          `<a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>` :
          `
           <a href="/details-publication?id=${esc(p.id)}"><i class="fa-regular fa-eye"></i>Voir</a>
           <a href="/modifier-une-publication?id=${esc(p.id)}"><i class="fa-regular fa-pen-to-square"></i>Modifier</a>
           <a href="#" class="js-del-pub" data-id="${esc(p.id)}"><i class="fa-regular fa-trash-can"></i>Supprimer</a>
          `;

        $tb.append(`
        <tr data-id="${esc(p.id)}">
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
        ...baseDT,
        columnDefs: [{
          orderable: false,
          targets: [0, 5]
        }]
      });

      $('#mesPublicationsSearch').off('input').on('input', function () {
        dtMes.search(this.value).draw();
      });
      $('#statusFilterMesPublications').off('change').on('change', function () {
        dtMes.draw();
      });
    }

    // ===================== Filtres statut + plage de dates (les deux tableaux) =====================
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      const tableId = settings.sTableId;

      let wanted = '';
      let dateRangePicker = null;
      let statutColIndex = -1;
      let dateColIndex = -1;

      if (tableId === 'candidaturesTable') {
        wanted = $('#statusFilterSuivi').val() || '';
        statutColIndex = 5;
        dateColIndex = 3;
        dateRangePicker = document.getElementById('dateFilterSuivi')._flatpickr;
      } else if (tableId === 'mesPublicationsTable') {
        wanted = $('#statusFilterMesPublications').val() || '';
        statutColIndex = 4;
        dateColIndex = 2;
        dateRangePicker = document.getElementById('dateFilterMesPublications')._flatpickr;
      } else {
        return true;
      }

      const rowNode = settings.aoData[dataIndex].nTr;
      const st = $(rowNode).find('td').eq(statutColIndex).data('statut') || '';
      if (wanted && st !== wanted) return false;

      if (dateRangePicker && dateRangePicker.selectedDates && dateRangePicker.selectedDates.length ===
        2) {
        const from = dateRangePicker.selectedDates[0];
        const to = dateRangePicker.selectedDates[1];
        const dateIso = $(rowNode).find('td').eq(dateColIndex).data('date') || '';
        if (!dateIso) return false;
        const d = new Date(dateIso + 'T00:00:00');
        if (isNaN(d.getTime())) return false;
        if (d < from || d > to) return false;
      }
      return true;
    });

    // ===================== Flatpickr =====================
    function initDatePickers() {
      const opts = {
        mode: 'range',
        dateFormat: 'Y-m-d',
        locale: 'fr',
        onChange: function () {
          if (dtSuivi) dtSuivi.draw();
          if (dtMes) dtMes.draw();
        }
      };
      flatpickr('#dateFilterSuivi', opts);
      flatpickr('#dateFilterMesPublications', opts);
    }

    // ===================== Dropdown + actions (corrigé: UI optimiste) =====================
    $(document).on('click', '.action-btn', function (e) {
      e.stopPropagation();
      const dd = $(this).closest('.actions').find('.dropdown-menu');
      $('.dropdown-menu').not(dd).hide();
      dd.toggle();
    });
    $(document).on('click', function () {
      $('.dropdown-menu').hide();
    });

    // ---- Accepter / Valider (directeur) : passe "En attente" -> "Validée" immédiatement (sans rechargement)
    $(document).on('click', '.js-validate', async function (e) {
      e.preventDefault();
      const id = $(this).data('id');
      const $tr = $(`tr[data-id="${id}"]`);
      try {
        const res = await fetch(`${API}/publication/${id}/validate`, {
          method: 'POST',
          headers: {
            'X-WP-Nonce': NONCE,
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);

        // MAJ optimiste du statut dans la ligne actuelle
        const $st = $tr.find('td').eq(5); // colonne "Statut" du tableau Suivi
        $st.data('statut', 'Validée').attr('data-statut', 'Validée').html(badge('Validée'));

        // Optionnel : retirer les actions valider/rejeter après validation
        $tr.find('.dropdown-menu .js-validate, .dropdown-menu .js-reject').remove();

        // Refiltrer/redessiner DataTables pour prendre en compte le nouveau statut
        if (dtSuivi) dtSuivi.draw(false);
      } catch (err) {
        console.error(err);
        alert("Validation refusée (erreur serveur).");
      }
    });

    // ---- Rejeter (= supprimer) (directeur) : supprime la publication de la table
    $(document).on('click', '.js-reject', async function (e) {
      e.preventDefault();
      if (!confirm('Rejeter cette publication ? Elle sera supprimée.')) return;

      const id = $(this).data('id');
      const $tr = $(`tr[data-id="${id}"]`);
      try {
        const res = await fetch(`${API}/publication/${id}/reject`, {
          method: 'POST',
          headers: {
            'X-WP-Nonce': NONCE,
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);

        // Retire proprement la ligne via l'API DataTables
        if (dtSuivi) {
          dtSuivi.row($tr).remove().draw(false);
        } else {
          $tr.remove();
        }
      } catch (err) {
        console.error(err);
        alert("Rejet refusé (erreur serveur).");
      }
    });

    // ---- Supprimer (Mes publications) : suppression optimiste
    $(document).on('click', '.js-del-pub', async function (e) {
      e.preventDefault();
      if (!confirm('Supprimer cette publication ?')) return;

      const id = $(this).data('id');
      const $tr = $(`tr[data-id="${id}"]`);
      try {
        const res = await fetch(`${API}/publication/${id}`, {
          method: 'DELETE',
          headers: {
            'X-WP-Nonce': NONCE,
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);

        if (dtMes) {
          dtMes.row($tr).remove().draw(false);
        } else {
          $tr.remove();
        }
      } catch (err) {
        console.error(err);
        alert("Suppression impossible (erreur serveur).");
      }
    });

    // ===================== Check-all =====================
    $('#checkAllSuivi').on('change', function () {
      $('#candidaturesTable tbody .row-checkbox').prop('checked', this.checked);
    });
    $('#checkAll').on('change', function () {
      $('#mesPublicationsTable tbody .row-checkbox').prop('checked', this.checked);
    });

    // ===================== Tabs =====================
    $('.tab-btn').on('click', async function () {
      const tabId = $(this).data('tab');
      $('.tab-btn').removeClass('active');
      $(this).addClass('active');
      $('.tab-panel').removeClass('active');
      $('#' + tabId).addClass('active');
      if (tabId === 'tab2') {
        await loadMesPublications();
      }
    });

    // ===================== Boot =====================
    initDatePickers();
    loadSuiviPublications(); // tab1 au chargement

  })(jQuery);
</script>