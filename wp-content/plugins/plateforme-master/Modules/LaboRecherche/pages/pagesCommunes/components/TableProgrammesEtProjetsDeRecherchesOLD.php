<!-- External CSS Libraries -->
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Flatpickr CSS for Date Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Internal CSS Styles -->
<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f4f9;
  }

  .dashboard-sub-title {
    font-weight: bold;
  }

  .filter-inputs {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .input-with-icon {
    position: relative;
  }

  .input-with-icon .icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
    font-size: 14px;
  }

  .input-with-icon .left-icon {
    left: 0.85rem;
  }

  .input-with-icon .right-icon {
    right: 0.85rem;
  }

  .filter-bar .filter-input,
  .filter-bar .filter-select {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.6rem 0.75rem;
    background-color: #fdfdfd;
    font-size: 14px;
    height: 42px;
    box-sizing: border-box;
    transition: border-color 0.2s;
    min-width: 180px;
  }

  .filter-bar .filter-input {
    width: 220px;
  }

  .filter-bar .filter-input:focus,
  .filter-bar .filter-select:focus {
    outline: none;
    border-color: #c60000;
  }

  .input-with-icon .date-input {
    padding-left: 0.75rem;
    padding-right: 2.5rem;
  }

  .filter-bar .filter-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5rem;
    cursor: pointer;
  }

  .filter-bar .icon-btn {
    width: 42px;
    height: 42px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background-color: #fdfdfd;
    color: #BF0404;
    cursor: pointer;
    transition: background-color 0.2s;
    font-size: 16px;
  }

  .filter-bar .icon-btn:hover {
    background-color: #f5f5f5;
  }

  .filter-actions {
    display: flex;
    gap: 10px;
  }

  .content-block {
    background: #fff;
    border-radius: 10px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  }

  .header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .add-project-btn {
    background-color: #c60000;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .add-project-btn:hover {
    background-color: #a50000;
  }

  .styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    box-shadow: 0 0 0 1px #ddd;
    background: #fff;
  }

  .styled-table thead {
    background-color: #f3f1e9;
  }

  .styled-table th,
  .styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
  }

  .styled-table tbody tr:last-child td {
    border-bottom: none;
  }

  .badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px;
    text-transform: capitalize;
    border: 2px solid transparent;
  }

  .badge-success {
    color: #198754;
    background-color: #e6f7ee;
    border-color: #198754;
  }

  .badge-warning {
    color: #d89e00;
    background-color: #fff9e6;
    border-color: #d89e00;
  }

  .actions {
    position: relative;
    display: inline-block;
  }

  .action-btn {
    background-color: transparent;
    color: #2d2a12;
    border: 1px solid transparent;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    font-size: 24px;
    font-weight: bolder;
    cursor: pointer;
    transition: background-color 0.2s, box-shadow 0.2s;
    line-height: 1;
    padding: 0;
    padding-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .action-btn:hover {
    background-color: #e6e6de;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 160px;
    background-color: #ffffff;
    border: 1px solid #d8d4b7;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 6px 0;
  }

  .dropdown-menu a {
    display: block;
    padding: 8px 14px;
    text-decoration: none;
    font-size: 14px;
    color: #2d2a12;
    transition: background-color 0.2s;
  }

  .dropdown-menu a:hover {
    background-color: #f4f4f4;
  }

  /* Modal Styles */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: flex-end;
    z-index: 9999;
    display: none;
    /* Hidden by default */
  }

  .popup-container {
    background-color: white;
    width: 450px;
    height: 100%;
    padding: 0;
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
  }

  .popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    box-shadow: 0px 5px 16px #0000001a;
    flex-shrink: 0;
  }

  .popup-header h2 {
    font-size: 18px;
    margin: 0;
    color: #2A2916;
  }

  .btn-enregistrer {
    background-color: #c62828;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
  }

  .popup-form {
    padding: 25px;
    overflow-y: auto;
    flex-grow: 1;
  }

  .popup-form .form-group {
    margin-bottom: 15px;
  }

  .popup-form .form-group label {
    display: block;
    font-weight: 600;
    color: #6E6D55;
    font-size: 14px;
    /* margin-bottom: 5px; */
  }

  .popup-form .form-group input,
  .popup-form .form-group select,
  .popup-form .form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #b5af8e;
    border-radius: 7px;
    font-size: 14px;
    box-sizing: border-box;
  }

  .popup-form .form-group input:focus,
  .popup-form .form-group select:focus,
  .popup-form .form-group textarea:focus {
    outline: none;
    border-color: #c60000;
    box-shadow: 0 0 0 2px rgba(198, 0, 0, 0.2);
  }

  .popup-form .form-group textarea {
    resize: vertical;
    min-height: 80px;
  }

  .popup-form .input-with-icon select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 30px;
    background-color: #fff;
  }

  .popup-form .input-file-wrapper {
    display: flex;
    align-items: center;
    /* border: 1px solid #b5af8e; */
    border-radius: 7px;
    background-color: white;
    overflow: hidden;
  }

  .popup-form .input-file-text {
    flex-grow: 1;
    border: none;
    padding: 10px 12px;
    background-color: #f9f9f9;
    color: #888;
    cursor: default;
    border-radius: 7px 0 0 7px !important;
  }

  .popup-form .input-file-text:focus {
    outline: none;
  }

  .popup-form .btn-importer {
    background-color: #A6A485;
    color: #fff !important;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    border-left: 1px solid #b5af8e;
    white-space: nowrap;
    border-radius: 0px 7px 7px 0;
  }

  .popup-form .form-row {
    display: flex;
    gap: 15px;
  }

  .popup-form .form-row .form-group {
    flex: 1;
  }

  /* Custom Flatpickr Theme */
  .flatpickr-day.selected,
  .flatpickr-day.startRange,
  .flatpickr-day.endRange,
  .flatpickr-day.selected.inRange,
  .flatpickr-day.startRange.inRange,
  .flatpickr-day.endRange.inRange,
  .flatpickr-day.selected:focus,
  .flatpickr-day.startRange:focus,
  .flatpickr-day.endRange:focus,
  .flatpickr-day.selected:hover,
  .flatpickr-day.startRange:hover,
  .flatpickr-day.endRange:hover,
  .flatpickr-day.selected.prevMonthDay,
  .flatpickr-day.startRange.prevMonthDay,
  .flatpickr-day.endRange.prevMonthDay,
  .flatpickr-day.selected.nextMonthDay,
  .flatpickr-day.startRange.nextMonthDay,
  .flatpickr-day.endRange.nextMonthDay {
    background: #C60000;
    border-color: #C60000;
  }

  .flatpickr-day.inRange,
  .flatpickr-day.prevMonthDay.inRange,
  .flatpickr-day.nextMonthDay.inRange {
    background: #fde0e0;
    border-color: #fde0e0;
    box-shadow: -5px 0 0 #fde0e0, 5px 0 0 #fde0e0;
  }

  .flatpickr-months .flatpickr-month {
    color: #C60000;
  }

  .flatpickr-weekdays {
    background: #c600001a;
  }

  .flatpickr-months .flatpickr-prev-month:hover svg,
  .flatpickr-months .flatpickr-next-month:hover svg {
    fill: #C60000;
  }



  #candidaturesTable {
    border: none !important;
    border-collapse: collapse;
    box-shadow: none !important;
  }

  #candidaturesTable th {
    border: 0px solid #EBE9D7;
  }

  #candidaturesTable td {
    border: 1px solid #EBE9D7;
  }

  #candidaturesTable thead {
    border: none !important;
    position: static;
    transform: translateY(-15px);
  }

  #candidaturesTable tbody tr:first-child td {
    border-top: 1px solid #EBE9D7 !important;
  }

  #candidaturesTable {
    border-collapse: separate;
    border-spacing: 0;
  }

  #candidaturesTable thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
  }

  #candidaturesTable thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;

  }

  #candidaturesTable tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
  }

  #candidaturesTable tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
  }

  #candidaturesTable tbody tr:first-child td:first-child {
    border-top-left-radius: 12px;
  }

  #candidaturesTable tbody tr:first-child td:last-child {
    border-top-right-radius: 12px;
  }

  .section-divider {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 10px 0;
  }

  .filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding-bottom: 30px;
    position: relative;
    flex-wrap: wrap;
  }

  /* Custom Pagination Styles */
  .pagination-controls {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
  }

  .pagination-button {
    border-radius: 8px;
    border: 2px solid #c60000 !important;
    background: #fff !important;
    color: #c60000 !important;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    padding: 10px 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .pagination-button.active {
    background: #c60000 !important;
    color: #fff !important;
  }

  .pagination-button:hover:not(.active):not(.disabled) {
    background: #fde0e0 !important;
  }

  .pagination-button.disabled {
    opacity: 0.5;
    cursor: default;
    background: #fff !important;
  }

  /* This CSS rule hides the native calendar icon in the date input. */
  .popup-form .form-group input[type="date"]::-webkit-calendar-picker-indicator {
    opacity: 0;
  }

  .popup-form .form-group input[type="date"] {
    position: relative;
  }

  .popup-form .form-group input[type="date"]+img {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
  }
</style>


<!-- Main Content Block -->
<div class="content-block">
  <div class="header-bar">
    <h2 class="dashboard-sub-title">
      <img src="/wp-content/plugins/plateforme-master/images/icons/10550857.png" alt="Project Icon"        
        style="width: 38px; margin-right: 8px; vertical-align: middle;">
      Liste Des Projets
      </h2>

    <button class="add-project-btn">Ajouter un projet</button>

    </div>

  
  <hr class="section-divider">

  <div class="filter-bar">
    <div class="filter-inputs">
      
      <!-- Search Input -->
      <div class="input-with-icon">
        <input class="filter-input" id="generalSearch" type="text" placeholder="Recherchez...">
        <i class="fas fa-search icon right-icon"></i>
        </div>

      
      <!-- Status Select -->
      <div class="input-with-icon">
        <select class="filter-select" id="statusFilter">
          <option value="">État (Tous)</option>
          <option value="Terminé">Terminé</option>
          <option value="En cours">En cours</option>
          </select>
        <i class="fas fa-chevron-down icon right-icon"></i>
        </div>

      
      <!-- Date Input -->
      <div class="input-with-icon">
        <input class="filter-input date-input" id="dateRangeFilter" type="text" placeholder="Date Deb-Fin">
        <img class="icon right-icon" width="20px"          
          src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Calendar Icon"          
          onerror="this.style.display='none'">
        </div>
      
    </div>
    <div class="filter-actions">

      <button class="icon-btn" title="Filter">
        <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
          alt="Funnel Icon"           onerror="this.style.display='none'">
        </button>

      <button class="icon-btn" title="Download">
        <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
          alt="Upload Icon"           onerror="this.style.display='none'">
        </button>

      </div>
    </div>

  
  <!-- Data Table -->
  <table id="candidaturesTable" class="styled-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="checkAll"></th>
        <th>Intitulé du projet</th>
        <th>État</th>
        <th>Responsable</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Financement</th>
        <th>Actions</th>
        </tr>
      </thead>
    <tbody>

      </tbody>
    </table>
  <div class="pagination-controls"></div>
</div>

<!-- Modal for Adding/Modifying a Project -->
<div class="modal-overlay" id="projectModal">
  <div class="popup-container">
    <div class="popup-header">
      <h2 id="modalTitle">Ajouter un projet</h2>
      <button type="button" class="btn-enregistrer" id="saveProjectBtn">Enregistrer</button>
      </div>
    <form class="popup-form" enctype="multipart/form-data">
      <input type="hidden" id="projectRowIndex">
      <div class="form-group">

        <label for="titreProjet">Titre du projet</label>
        <input type="text" id="titreProjet">
        </div>

      <div class="form-group">
        <label for="typeProjet">Type</label>
        <div class="input-with-icon">
          <select id="typeProjet">
            <option>Sélection..</option>
            </select>
          <i class="fas fa-chevron-down icon right-icon"></i>
          </div>
        </div>

      <div class="form-row">
        <div class="form-group">
          <label for="financement">Financement prévisionnel</label>
          <input type="text" id="financement">
          </div>
        <div class="form-group">
          <label for="sourceFinancement">Source Financement</label>
          <div class="input-with-icon">
            <select id="sourceFinancement">
              <option>Sélection..</option>
              </select>
            <i class="fas fa-chevron-down icon right-icon"></i>
            </div>
          </div>
        </div>
      <div class="form-row">
        
        <!-- Date début -->
        <div class="form-group">
          <label for="dateDebut">Date Début</label>
          <div class="input-with-icon">
            <input type="text" id="dateDebut" placeholder="jj/mm/aaaa">
            <img class="icon right-icon" width="20px"              
              src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Calendar Icon"        
              onerror="this.style.display='none'">
            </div>
          </div>

        
        <!-- Date fin -->
        <div class="form-group">
          <label for="dateFin">Date Fin</label>
          <div class="input-with-icon">
            <input type="text" id="dateFin" placeholder="jj/mm/aaaa">
            <img class="icon right-icon" width="20px"              
              src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Calendar Icon"        
              onerror="this.style.display='none'">
            </div>
          </div>
        
      </div>

      <div class="form-group">
        <label for="objectifs">Objectifs</label>
        <textarea id="objectifs" placeholder="Objectif"></textarea>
        </div>
      <div class="form-group">
        <label for="budget">Budget</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" value="Aucun fichier choisi" readonly>
          <label for="budgetUpload" class="btn-importer">
            <img width="20px"
              src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"              
              alt="Upload Icon" onerror="this.style.display='none'">
            Importer
            </label>
          <input type="file" id="budgetUpload" style="display:none;">
          </div>
        </div>
      <div class="form-group">
        <label for="convention">Convention</label>
        <div class="input-file-wrapper">
          <input type="text" class="input-file-text" value="Aucun fichier choisi" readonly>
          <label for="conventionUpload" class="btn-importer">
            <img width="20px"
              src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"              
              alt="Upload Icon" onerror="this.style.display='none'">
            Importer
            </label>
          <input type="file" id="conventionUpload" style="display:none;">
          </div>
        </div>
      </form>
    </div>
</div>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- French Locale for Flatpickr -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById("projectModal");
    const modalTitle = document.getElementById("modalTitle");
    const form = modal.querySelector('.popup-form');

    const openModal = () => {
      modal.style.display = "flex";
      document.body.style.overflow = 'hidden';
    };

    function closeModal() {
      modal.style.display = "none";
      form.reset();
      document.body.style.overflow = '';
    }

    document.querySelector('.add-project-btn').addEventListener('click', function () {
      modalTitle.textContent = "Ajouter un projet";
      form.reset();
      openModal();
    });

 /*

    $('#candidaturesTable tbody').on('click', '.btn-modifier', function (e) {
      e.preventDefault();
      modalTitle.textContent = "Modifier le projet";
      const row = $(this).closest('tr');
      document.getElementById('titreProjet').value = row.find('td:eq(1)').text();
      const dates = row.find('td:eq(4)').text();
      openModal();
    });

*/
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    // --- Custom File Input Logic ---
    function setupFileInput(uploadId) {
      const fileUpload = document.getElementById(uploadId);
      if (!fileUpload) return;
      const fileText = document.querySelector(`label[for='${uploadId}']`).previousElementSibling;
      fileUpload.addEventListener('change', function () {
        fileText.value = this.files.length > 0 ? this.files[0].name : 'Aucun fichier choisi';
      });
    }
    setupFileInput('budgetUpload');
    setupFileInput('conventionUpload');
  });
</script>

<!-- APPEL API -->
<script type="module">
  (() => {
    const PM = window.PMSettings || {};
    const API_BASE = (PM.restUrl || '/wp-json/') + 'plateforme-recherche/v1';

    // ---------- Helpers REST ----------
    const wpFetch = async (path, {
      method = 'GET',
      body = null,
      headers = {},
      raw = false
    } = {}) => {
      const url = API_BASE + path;
      const opts = {
        method,
        credentials: 'include',
        headers: {
          'X-WP-Nonce': PM.nonce || '',
          ...headers
        }
      };
      if (body && !raw) {
        opts.headers['Content-Type'] = 'application/json';
        opts.body = JSON.stringify(body);
      } else if (body && raw) {
        opts.body = body;
      }
      const res = await fetch(url, opts);
      if (!res.ok) {
        let errMsg = `HTTP ${res.status}`;
        try {
          const j = await res.json();
          if (j?.message) errMsg = j.message;
        } catch { }
        throw new Error(errMsg);
      }
      if (res.status === 204) return null;
      const ct = res.headers.get('content-type') || '';
      return ct.includes('application/json') ? res.json() : res.text();
    };

    const uploadMedia = async (file) => {
      if (!file) return null;
      const endpoint = (PM.restUrl || '/wp-json/') + 'wp/v2/media';
      const res = await fetch(endpoint, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'X-WP-Nonce': PM.nonce || '',
          'Content-Disposition': `attachment; filename="${encodeURIComponent(file.name)}"`,
          'Content-Type': file.type || 'application/octet-stream'
        },
        body: file
      });
      if (!res.ok) {
        let t = '';
        try {
          t = await res.text();
        } catch { }
        throw new Error('Upload échoué: ' + (t || res.status));
      }
      return res.json();
    };

    // ---------- Helpers UI ----------
    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

    const escapeHtml = s => String(s).replace(/[&<>"']/g, m => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    }[m]));
    const toISO = fr => {
      if (!fr) return '';
      if (/^\d{4}-\d{2}-\d{2}$/.test(fr)) {
        return fr;
      }
      if (/^\d{2}\/\d{2}\/\d{4}$/.test(fr)) {
        const [d, m, y] = fr.split('/');
        return `${y}-${m}-${d}`;
      }
      if (/^\d{2}-\d{2}-\d{4}$/.test(fr)) {
        const [d, m, y] = fr.split('-');
        return `${y}-${m}-${d}`;
      }
      return '';
    };

    const toFR = iso => {
      if (!iso) return '';
      const [y, m, d] = iso.split('T')[0].split('-');
      if (!y || !m || !d) return '';
      return `${d}/${m}/${y}`;
    };
    const parseMoney = val => {
      if (val == null) return 0;
      return Number(String(val).replace(/\s+/g, '').replace(/[^\d.,]/g, '').replace(',', '.')) || 0;
    };
    const fmtMoney = n => new Intl.NumberFormat('fr-TN', {
      maximumFractionDigits: 0
    }).format(n) + ' TND';

    const badgeClass = (status) => {
      switch ((status || '').toLowerCase()) {
        case 'terminé':
        case 'termine':
          return 'badge badge-success';
        case 'en cours':
          return 'badge badge-warning';
        default:
          return 'badge badge-secondary';
      }
    };
    const parseResume = (resume) => {
      if (!resume) return {};
      if (typeof resume === 'object') return resume;
      try {
        return JSON.parse(resume);
      } catch {
        return {
          texte: String(resume)
        };
      }
    };

    const notify = (msg, type = 'info') => {
      Swal.fire({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: type === 'error' ? 'error' : (type === 'warn' ? 'warning' : 'success'),
        title: msg
      });
    };

    const debounce = (fn, ms = 300) => {
      let t;
      return (...a) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...a), ms);
      };
    };

    // ---------- State & DOM refs ----------
    let projects = [];
    let filtered = [];
    let editingId = null;
    let currentPage = 1;
    const itemsPerPage = 5;

    const tbody = $('#candidaturesTable tbody');
    const addBtn = $('.add-project-btn');
    const modal = $('#projectModal');
    const modalTitle = $('#modalTitle');
    const saveBtn = $('#saveProjectBtn');
    const paginationControls = $('.pagination-controls');


    /*const inputs = {
      titre: $('#titreProjet'),
      acronyme: $('#acronyme'),
      type_projet: $('#typeProjet'),
      porteur_nom: $('#porteur'),
      budget: $('#financement'),
      source_fin: $('#sourceFinancement'),
      dates: $('#datesDebutFin'),
      objectifs: $('#objectifs'),
      budgetFile: $('#budgetUpload'),
      conventionFile: $('#conventionUpload')
    };*/

    const inputs = {
      titre: $('#titreProjet'),
      type_projet: $('#typeProjet'),
      budget: $('#financement'),
      source_fin: $('#sourceFinancement'),
      objectifs: $('#objectifs'),
      budgetFile: $('#budgetUpload'),
      conventionFile: $('#conventionUpload'),
      date_debut: $('#dateDebut'),
      date_fin: $('#dateFin')
    };

    const filters = {
      q: $('#generalSearch'),
      status: $('#statusFilter'),
      dateRng: $('#dateRangeFilter'),
      checkAll: $('#checkAll'),
      btnFilter: $('.filter-actions .icon-btn[title="Filter"]'),
      btnExport: $('.filter-actions .icon-btn[title="Download"]')
    };

    // ---------- Rendering ----------
    const buildRow = (p) => {
        const r = parseResume(p.resume);
        const porteurNom = p.chercheur_nom || '—';
        const typeProj = r.type_projet || '—';
        const financement = (p.budget != null) ? fmtMoney(p.budget) : (r.financement_text || '—');
        const statut = p.statut || r.statut || 'En cours';
        const tr = document.createElement('tr');
        tr.dataset.id = p.id;

        // 🔹 Vérifie si c'est le projet du user connecté
        const isOwner = String(p.chercheur_id) === String(PM.userId);

        let actionsHtml = `
          <a class="btn-voir" href="/programmes-et-projets-de-recherches-details-projet_?id=${encodeURIComponent(p.id)}">Voir</a>
        `;

        if (isOwner) {
          actionsHtml = `
            <a href="#" class="btn-modifier">Modifier</a>
            <a href="#" class="btn-statut">${(statut || '').toLowerCase().startsWith('termin') ? 'Marquer en cours' : 'Marquer terminé'}</a>
            <a class="btn-voir" href="/programmes-et-projets-de-recherches-details-projet_?id=${encodeURIComponent(p.id)}">Voir</a>
            <a href="#" class="btn-supprimer">Supprimer</a>
          `;
        }

        tr.innerHTML = `
          <td><input type="checkbox" class="row-check"></td>
          <td>
            <div class="title-cell">
              <div class="project-title">${escapeHtml(p.titre || '')}</div>
              ${r.acronyme ? `<div class="project-acronym">${escapeHtml(r.acronyme)}</div>` : ''}
              ${typeProj !== '—' ? `<div class="project-type small text-muted">${escapeHtml(typeProj)}</div>` : ''}
            </div>
          </td>
          <td><span class="${badgeClass(statut)}">${escapeHtml(statut)}</span></td>
          <td>${escapeHtml(porteurNom)}</td>
          <td>${p.date_debut ? escapeHtml(toFR(p.date_debut)) : '—'}</td>
          <td>${p.date_fin ? escapeHtml(toFR(p.date_fin)) : '—'}</td>
          <td>${financement}</td>
          <td>
            <div class="actions">
              <button class="action-btn" aria-haspopup="true" aria-expanded="false">⋯</button>
              <div class="dropdown-menu">
                ${actionsHtml}
              </div>
            </div>
          </td>
        `;

        return tr;
      };


    const render = () => {
      tbody.innerHTML = '';

      // Use the filtered array as the single source of truth for projects to display
      const projectsToDisplay = filtered;

      if (projectsToDisplay.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML =
          `<td colspan="8" style="text-align: center; color: #888;">Aucun enregistrement correspondant trouvé</td>`;
        tbody.appendChild(tr);
      } else {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedProjects = projectsToDisplay.slice(startIndex, endIndex);

        paginatedProjects.forEach(p => tbody.appendChild(buildRow(p)));
      }

      renderPagination();
    };

    const renderPagination = () => {
      const totalProjects = filtered.length;
      const totalPages = Math.ceil(totalProjects / itemsPerPage);
      paginationControls.innerHTML = '';

      if (totalProjects <= itemsPerPage) {
        // Do not show pagination if there are no results or only one page of results
        return;
      }

      // Previous button
      const prevBtn = document.createElement('button');
      prevBtn.innerHTML = '<i class="fa-solid fa-angle-left"></i>';
      prevBtn.className = `pagination-button ${currentPage === 1 ? 'disabled' : ''}`;
      prevBtn.disabled = currentPage === 1;
      prevBtn.dataset.page = currentPage - 1;
      paginationControls.appendChild(prevBtn);

      // Page number buttons
      for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        pageBtn.className = `pagination-button ${currentPage === i ? 'active' : ''}`;
        pageBtn.dataset.page = i;
        paginationControls.appendChild(pageBtn);
      }

      // Next button
      const nextBtn = document.createElement('button');
      nextBtn.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
      nextBtn.className = `pagination-button ${currentPage === totalPages ? 'disabled' : ''}`;
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.dataset.page = currentPage + 1;
      paginationControls.appendChild(nextBtn);
    };

    // ---------- Load ----------
    const loadProjects = async () => {
      try {
        const data = await wpFetch('/projet?page=1&per_page=200');
        projects = Array.isArray(data) ? data : [];
        filtered = projects;
        currentPage = 1; // Reset to first page on load
        render();
      } catch (e) {
        notify('Erreur lors du chargement des projets : ' + e.message, 'error');
      }
    };

    // ---------- Modal ----------
    /*const openModal = (edit = false, project = null) => {
      modal.style.display = "flex";
      document.body.style.overflow = 'hidden';
      modalTitle.textContent = edit ? 'Modifier le projet' : 'Ajouter un projet';
      editingId = edit && project ? project.id : null;

      Object.values(inputs).forEach(el => {
        if (!el) return;
        if (el instanceof HTMLInputElement || el instanceof HTMLTextAreaElement) el.value = '';
        if (el instanceof HTMLSelectElement) el.selectedIndex = 0;
      });

      if (project) {
        const r = parseResume(project.resume);
        inputs.titre.value = project.titre || '';
        inputs.acronyme.value = r.acronyme || '';
        setSelectValue(inputs.type_projet, r.type_projet || '');
        setSelectValue(inputs.porteur_nom, r.porteur_nom || '');
        inputs.budget.value = (project.budget != null ? String(project.budget) : (r.financement_text ||
          ''));
        setSelectValue(inputs.source_fin, project.type_financement || r.source_financement || '');
        inputs.dates.value =
          `${project.date_debut ? toFR(project.date_debut) : ''} - ${project.date_fin ? toFR(project.date_fin) : ''}`
            .trim();
        inputs.objectifs.value = r.objectifs || r.texte || '';
      }
    };*/

    
    const openModal = (edit = false, project = null) => {
      modal.style.display = "flex";
      document.body.style.overflow = 'hidden';
      modalTitle.textContent = edit ? 'Modifier le projet' : 'Ajouter un projet';
      editingId = edit && project ? project.id : null;

      // Reset
      Object.values(inputs).forEach(el => {
        if (!el) return;
        if (el instanceof HTMLInputElement || el instanceof HTMLTextAreaElement) el.value = '';
        if (el instanceof HTMLSelectElement) el.selectedIndex = 0;
      });

      if (project) {
        const r = parseResume(project.resume);

        inputs.titre.value = project.titre || '';
        inputs.budget.value = project.budget != null ? String(project.budget) : (r.financement_text || '');
        inputs.objectifs.value = r.objectifs || r.texte || '';

        // Dates
        if (project.date_debut) inputs.date_debut.value = toFR(project.date_debut);
        if (project.date_fin) inputs.date_fin.value = toFR(project.date_fin);

        // Sélects (attention: attendre que les options soient chargées)
        setSelectValue(inputs.type_projet, project.type_projet_id || r.type_projet || '');
        setSelectValue(inputs.source_fin, project.type_financement || r.source_financement || '');

        // Fichiers
        let budgetUrl = null;
        let conventionUrl = null;

        // Cas 1 : champs directs en base
        if (project.budget_piece) budgetUrl = project.budget_piece;
        if (project.convention_piece) conventionUrl = project.convention_piece;

        // Cas 2 : dans le JSON résumé
        if (r.pieces?.budget_piece?.url) budgetUrl = r.pieces.budget_piece.url;
        if (r.pieces?.convention_piece?.url) conventionUrl = r.pieces.convention_piece.url;

        // Affichage juste du nom dans le champ texte
        if (budgetUrl) {
          document.querySelector("label[for='budgetUpload']").previousElementSibling.value =
            budgetUrl.split('/').pop();
        }
        if (conventionUrl) {
          document.querySelector("label[for='conventionUpload']").previousElementSibling.value =
            conventionUrl.split('/').pop();
        }


      }
    };



    const closeModal = () => {
      modal.style.display = "none";
      document.body.style.overflow = '';
      editingId = null;
      const form = modal.querySelector('.popup-form');
      if (form) form.reset();
    };

    const setSelectValue = (sel, value) => {
      const v = String(value || '').toLowerCase();
      const found = Array.from(sel.options).find(o => (o.value || o.textContent).toLowerCase() === v);
      if (found) sel.value = found.value;
    };

    const collectPayload = () => {
      const titre = inputs.titre.value.trim();

      const resumeObj = {
        objectifs: inputs.objectifs.value.trim(),
        acronyme: inputs.acronyme?.value?.trim() || '',
        porteur_nom: inputs.porteur_nom?.value?.trim() || '',
        financement_text: inputs.budget.value.trim()
      };

      const payload = {
        titre,
        date_debut: toISO(document.getElementById('dateDebut').value.trim()),
        date_fin: toISO(document.getElementById('dateFin').value.trim()),
        budget: parseMoney(inputs.budget.value),
        type_projet_id: parseInt(inputs.type_projet.value) || null,
        type_financement: inputs.source_fin.value.trim(),
        objectifs: inputs.objectifs.value.trim(),
        statut: 'En cours',
        chercheur_id: Number(PM.userId || 0) || undefined,
        resume: JSON.stringify(resumeObj)
      };

      Object.keys(payload).forEach(k => {
        const v = payload[k];
        if (v === '' || v == null || (k === 'budget' && Number.isNaN(v))) delete payload[k];
      });

      return payload;
    };


    const saveProject = async () => {
      try {


        const fd = new FormData();
        const cleanBudget = (inputs.budget.value || "")
        .replace(/\s+/g, "")   // supprime les espaces
        .replace(",", ".");    // remplace virgule par point
        fd.append('titre', inputs.titre.value.trim());
        fd.append('type_projet_id', inputs.type_projet.value);
        fd.append('type_financement', inputs.source_fin.value);
        fd.append('budget', cleanBudget);
        fd.append('objectifs', inputs.objectifs.value);
        fd.append('date_debut', toISO(inputs.date_debut.value));
        fd.append('date_fin', toISO(inputs.date_fin.value));

        if (inputs.budgetFile.files[0]) {
          fd.append('budget_piece', inputs.budgetFile.files[0]);
        }
        if (inputs.conventionFile.files[0]) {
          fd.append('convention_piece', inputs.conventionFile.files[0]);
        }

        const method = editingId ? 'POST' : 'POST'; // WP REST attend POST + route différente
        const endpoint = editingId ? `/projet/${editingId}` : '/projet';

        const res = await fetch(API_BASE + endpoint, {
          method: editingId ? 'POST' : 'POST',
          credentials: 'include',
          headers: { 'X-WP-Nonce': PM.nonce || '' },
          body: fd
        });
        if (!res.ok) throw new Error('Erreur serveur');
        const data = await res.json();

        notify(editingId ? 'Projet mis à jour.' : 'Projet ajouté.');
        closeModal();
        loadProjects();

      } catch (e) {
        notify('Erreur enregistrement : ' + e.message, 'error');
      }
    };


    const deleteProject = async (id) => {
      const result = await Swal.fire({
        title: 'Supprimer ce projet ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c60000',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
      });

      if (result.isConfirmed) {
        try {
          await wpFetch(`/projet/${id}`, {
            method: 'DELETE'
          });
          projects = projects.filter(p => p.id != id);
          applyFilters();
          notify('Projet supprimé.');
        } catch (e) {
          notify('Suppression échouée : ' + e.message, 'error');
        }
      }
    };


    const toggleStatut = async (id) => {
      const p = projects.find(x => x.id == id);
      if (!p) return;
      const current = (p.statut || '').toLowerCase();
      const next = current.startsWith('termin') ? 'En cours' : 'Terminé';
      try {
        const upd = await wpFetch(`/projet/${id}`, {
          method: 'PATCH',
          body: {
            statut: next
          }
        });
        Object.assign(p, upd);
        render();
      } catch (e) {
        notify('Changement de statut échoué : ' + e.message, 'error');
      }
    };

    // ---------- Filtrage ----------
    const applyFilters = () => {
      const q = (filters.q.value || '').toLowerCase();
      const st = (filters.status.value || '').toLowerCase();
      const dr = (filters.dateRng.value || '').trim();
      let deb = null,
        fin = null;
      if (dr.includes(' au ')) {
        const [a, b] = dr.split(' au ').map(s => (s || '').trim());
        deb = toISO(a || '');
        fin = toISO(b || '');
      }
      filtered = projects.filter(p => {
        const r = parseResume(p.resume);
        const hay = [
          p.titre, p.statut, p.type_financement,
          r.porteur_nom, r.acronyme, r.type_projet, r.objectifs
        ].filter(Boolean).join(' ').toLowerCase();

        if (q && !hay.includes(q)) return false;
        if (st && (String(p.statut || '').toLowerCase() !== st)) return false;
        if (deb && p.date_debut && p.date_debut < deb) return false;
        if (fin && p.date_fin && p.date_fin > fin) return false;
        return true;
      });
      currentPage = 1; // Reset to first page whenever filters change
      render();
    };

    const exportCsv = () => {
      const rows = filtered.length ? filtered : projects;
      const headers = [
        'ID', 'Intitulé', 'Statut', 'Porteur', 'Date début', 'Date fin', 'Financement', 'Acronyme',
        'Type', 'Source'
      ];
      const lines = [headers.join(';')];
      rows.forEach(p => {
        const r = parseResume(p.resume);
        lines.push([
          p.id,
          (p.titre || '').replace(/;/g, ','),
          p.statut || '',
         // r.porteur_nom || '',
          p.date_debut ? toFR(p.date_debut) : '',
          p.date_fin ? toFR(p.date_fin) : '',
          (p.budget != null) ? String(p.budget) : (r.financement_text || ''),
          r.acronyme || '',
          r.type_projet || '',
          p.type_financement || r.source_financement || ''
        ].map(v => `"${String(v).replace(/"/g, '""')}"`).join(';'));
      });
      const blob = new Blob([lines.join('\n')], {
        type: 'text/csv;charset=utf-8;'
      });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = 'projets.csv';
      document.body.appendChild(a);
      a.click();
      a.remove();
    };

    // ---------- Events ----------
    const onBodyClick = (e) => {
      const btn = e.target.closest('.action-btn');
      if (btn) {
        const wrap = btn.closest('.actions');
        const menu = $('.dropdown-menu', wrap);
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        $$('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
        $$('.action-btn[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded', 'false'));
        menu.classList.toggle('show', !expanded);
        btn.setAttribute('aria-expanded', String(!expanded));
        e.preventDefault();
        return;
      }
      if (!e.target.closest('.actions') && !e.target.closest('.pagination-button')) {
        $$('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
        $$('.action-btn[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded', 'false'));
      }

      const a = e.target.closest('.dropdown-menu a');
      if (a) {
        e.preventDefault();
        const tr = a.closest('tr');
        const id = Number(tr?.dataset?.id);
        if (!id) return;
       /* if (a.classList.contains('btn-modifier')) {
          const p = projects.find(x => x.id == id);
          return openModal(true, p);
        }*/

          // --- Dans onBodyClick --- 
        if (a.classList.contains('btn-modifier')) {
          const tr = a.closest('tr');
          const id = Number(tr?.dataset?.id);
          if (!id) return;

          // 🔹 Charger le projet complet par API
          wpFetch(`/projet/${id}`)
            .then(proj => {
              openModal(true, proj); // on passe l’objet projet au modal
            })
            .catch(e => {
              notify('Erreur chargement projet : ' + e.message, 'error');
            });

          return;
          }

        if (a.classList.contains('btn-supprimer')) {
          return deleteProject(id);
        }
        if (a.classList.contains('btn-statut')) {
          return toggleStatut(id);
        }
      }

      // Handle pagination button clicks
      const paginationBtn = e.target.closest('.pagination-button');
      if (paginationBtn && !paginationBtn.disabled) {
        e.preventDefault();
        const newPage = parseInt(paginationBtn.dataset.page, 10);
        if (newPage !== currentPage) {
          currentPage = newPage;
          render();
        }
      }
    };

    const bindEvents = () => {
      const datePicker = flatpickr("#dateRangeFilter", {
        mode: "range",
        dateFormat: "d/m/Y",
        locale: "fr",
        onChange: function () {
          applyFilters();
        }
      });

      // Initialize Flatpickr for the modal date inputs
      flatpickr("#dateDebut", {
        dateFormat: "d/m/Y",
        locale: "fr"
      });
      flatpickr("#dateFin", {
        dateFormat: "d/m/Y",
        locale: "fr"
      });

      addBtn?.addEventListener('click', () => openModal(false, null));
      saveBtn?.addEventListener('click', saveProject);
      modal?.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
      });
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
      });

      document.body.addEventListener('click', onBodyClick);

      if (filters.q) filters.q.addEventListener('input', debounce(applyFilters, 200));
      if (filters.status) filters.status.addEventListener('change', applyFilters);
      if (filters.dateRng) filters.dateRng.addEventListener('change', applyFilters);

      if (filters.checkAll) {
        filters.checkAll.addEventListener('change', (e) => {
          $$('.row-check').forEach(ch => ch.checked = e.target.checked);
        });
        tbody.addEventListener('change', (e) => {
          if (e.target.classList.contains('row-check') && !e.target.checked) {
            filters.checkAll.checked = false;
          }
        });
      }

      filters.btnExport?.addEventListener('click', exportCsv);
    };

    const allowedRoles = ['administrator', 'um_directeur_laboratoire', 'um_chercheur', 'um_doyen'];
    if (addBtn && PM.role && !allowedRoles.includes(PM.role)) addBtn.style.display = 'none';

    bindEvents();
    loadProjects();
  })();
</script>
<script type="module">
  (() => {
    const PM = window.PMSettings || {};
    const API_BASE = (PM.restUrl || '/wp-json/') + 'plateforme-recherche/v1';

    const wpFetch = async (path) => {
      const res = await fetch(API_BASE + path, {
        method: 'GET',
        credentials: 'include',
        headers: {
          'X-WP-Nonce': PM.nonce || ''
        }
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.json();
    };

    const loadSources = async () => {
      try {
        const select = document.getElementById('sourceFinancement');
        if (!select) return;
        select.innerHTML = '<option value="">Sélection..</option>';

        const sources = await wpFetch('/source-financement');
        sources.forEach(src => {
          const opt = document.createElement('option');
          opt.value = src.code;
          opt.textContent = src.intitule;
          select.appendChild(opt);
        });
      } catch (e) {
        console.error('Erreur chargement sources financement:', e);
      }
    };

    document.addEventListener('DOMContentLoaded', loadSources);
  })();
</script>
<script type="module">
  (() => {
    const PM = window.PMSettings || {};
    const API_BASE = (PM.restUrl || '/wp-json/') + 'plateforme-recherche/v1';

    const wpFetch = async (path) => {
      const res = await fetch(API_BASE + path, {
        method: 'GET',
        credentials: 'include',
        headers: {
          'X-WP-Nonce': PM.nonce || ''
        }
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.json();
    };

    const loadTypes = async () => {
      try {
        const select = document.getElementById('typeProjet');
        if (!select) return;

        select.innerHTML = '<option value="">Sélection..</option>';

        const types = await wpFetch('/type-projet');
        types.forEach(tp => {
          const opt = document.createElement('option');
          opt.value = tp.id;
          opt.textContent = tp.intitule;
          select.appendChild(opt);
        });
      } catch (e) {
        console.error('Erreur chargement types de projet:', e);
      }
    };

    document.addEventListener('DOMContentLoaded', loadTypes);
  })();
</script>