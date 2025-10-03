<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plateforme Master — GED</title>

    <!-- External CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
    /* ==== styles identiques à ta version (non modifiés) ==== */
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f0f2f5;
    }

    .content-block {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
    }

    .accordion-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 8px rgba(0, 0, 0, .05);
    }

    .accordion-tabs {
        display: flex;
        background: #f3f3f3;
        border-radius: 10px 10px 0 0;
    }

    .tab-btn {
        flex: 1;
        padding: 12px 20px;
        font-weight: 600;
        border: none;
        background: #A6A485;
        cursor: pointer;
        font-size: 20px;
        transition: .3s;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center
    }

    .tab-btn:first-child {
        border-top-left-radius: 10px;
        margin-right: 10px
    }

    .tab-btn {
        border-top-right-radius: 8px;
        border-top-left-radius: 8px
    }

    .tab-btn:last-child {
        border-top-right-radius: 10px
    }

    .tab-btn.active {
        background: #fff;
        color: #2A2916
    }

    .accordion-content {
        padding: 25px 25px 35px;
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
        margin-bottom: 30px
    }

    .filters-row {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        align-items: center
    }

    .ctl {
        --ctl-h: 38px;
        --ctl-br: 8px;
        --ctl-border: #ddd;
        --ctl-text: #333;
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        height: var(--ctl-h);
        padding: 0 12px;
        border: 1px solid var(--ctl-border);
        border-radius: var(--ctl-br);
        background: #fff
    }

    .ctl input,
    .ctl select {
        height: calc(var(--ctl-h) - 2px);
        border: 0;
        outline: 0;
        background: transparent;
        font-size: 14px;
        color: var(--ctl-text)
    }

    .ctl i {
        color: #888
    }

    .ctl-search {
        min-width: 200px
    }

    .ctl-select {
        min-width: 180px
    }

    .ctl-select select {
        appearance: none
    }

    .header-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .header-title-text {
        display: flex;
        align-items: center;
        gap: 10px
    }

    .header-title img {
        width: 24px
    }

    .action-icons {
        display: flex;
        gap: 10px
    }

    .action-icons button {
        background: none;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 40px;
        height: 40px;
        cursor: pointer
    }

    .upload-btn {
        background-color: #c60000;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px
    }

    .styled-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px
    }

    .styled-table thead {
        background: #EBE9D7
    }

    .styled-table th,
    .styled-table td {
        padding: 12px;
        border: 1px solid #eee;
        text-align: left;
        vertical-align: middle
    }

    .styled-table th {
        font-weight: 600
    }

    .styled-table td img {
        width: 18px;
        display: block
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 5px;
        margin-top: 20px
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #c62828;
        background: #fff;
        padding: 6px 13px;
        cursor: pointer;
        border-radius: 4px;
        user-select: none;
        color: #c62828 !important;
        margin: 0 2px;
        transition: all .2s
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #fff !important;
        color: #c62828 !important
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        cursor: not-allowed;
        opacity: .5;
        border-color: #ddd;
        color: #999 !important;
        background: #fff
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #c62828 !important;
        color: #fff !important;
        border-color: #c62828
    }

    .history-section {
        margin-top: 40px
    }

    .history-header {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px
    }

    .action-menu-container {
        position: relative;
        display: inline-block
    }

    .action-menu-trigger {
        cursor: pointer
    }

    .action-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 5px;
        background: #fff;
        min-width: 160px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, .1);
        z-index: 10;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #eee
    }

    .action-menu a {
        color: #000;
        padding: 10px 15px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px
    }

    .action-menu a:hover {
        background: #f1f1f1
    }

    .action-menu a:last-child {
        color: #c60000
    }

    .action-menu.show {
        display: block
    }

    .btn-close-x {
        background: transparent;
        border: none;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        padding: 4px 10px;
        line-height: 1;
        transition: color .2s;
        margin-left: auto
    }

    .btn-close-x:hover {
        color: #c40000
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .3);
        display: flex;
        justify-content: flex-end;
        z-index: 999999;
        display: none
    }

    .popup-container {
        background: #fff;
        width: 450px;
        height: 100%;
        padding: 20px 0;
        box-shadow: -4px 0 10px rgba(0, 0, 0, .1);
        overflow-y: auto;
        padding-top: 0
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        margin-bottom: 20px;
        padding-left: 25px;
        padding-right: 25px;
        box-shadow: 0 5px 16px #00000029;
        padding-top: 20px
    }

    form.popup-form {
        padding-left: 25px;
        padding-right: 25px;
        display: flex;
        flex-direction: column;
        gap: 15px
    }

    .popup-header h2,
    .popup-form h2 {
        font-size: 16px;
        margin: 0;
        color: #2A2916
    }

    .btn-enregistrer {
        background: #c62828;
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px
    }

    .popup-form input,
    .popup-form select,
    .popup-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box
    }

    .popup-form textarea {
        min-height: 80px;
        resize: vertical
    }

    .input-file-wrapper {
        display: flex;
        align-items: center;
        border: none;
        border-radius: 7px;
        overflow: hidden;
        width: 100%;
        background: #fff
    }

    .input-file-text {
        flex-grow: 1;
        padding: 10px;
        border: none;
        font-size: 14px;
        color: #555;
        background: transparent;
        outline: none
    }

    .modal-overlay label {
        font-weight: 600;
        color: #6E6D55;
        display: block
    }

    .modal-overlay label:last-child {
        color: #fff !important
    }

    .btn-importer {
        background: #b5af8e;
        color: #fff;
        padding: 11px 16px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 6px
    }

    #table1,
    #table2 {
        border: none !important;
        border-collapse: collapse;
        box-shadow: none !important
    }

    #table1 th,
    #table2 th {
        border: 0 solid #EBE9D7;
        font-size: 14px;
        font-weight: 500
    }

    #table1 td,
    #table2 td {
        border: 1px solid #EBE9D7;
        font-size: 14px;
        font-weight: 500
    }

    #table1 thead,
    #table2 thead {
        border: none !important;
        position: static;
        transform: translateY(-15px)
    }

    #table1,
    #table2 {
        border-collapse: separate;
        border-spacing: 0
    }

    #table1 thead tr:first-child th:first-child,
    #table2 thead tr:first-child th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px
    }

    #table1 thead tr:first-child th:last-child,
    #table2 thead tr:first-child th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px
    }

    #table1 tbody tr:last-child td:first-child,
    #table2 tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px
    }

    #table1 tbody tr:last-child td:last-child,
    #table2 tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px
    }

    #table1 tbody tr:first-child td:first-child,
    #table2 tbody tr:first-child td:first-child {
        border-top-left-radius: 12px
    }

    #table1 tbody tr:first-child td:last-child,
    #table2 tbody tr:first-child td:last-child {
        border-top-right-radius: 12px
    }
    </style>
</head>

<body>
    <div class="content-block">
        <div class="accordion-container">
            <!-- Tabs -->
            <div class="accordion-tabs">
                <button class="tab-btn active" data-tab="tab1">Tous les documents</button>
                <button class="tab-btn" data-tab="tab2">Mes Documents</button>
            </div>

            <div class="accordion-content">
                <!-- TAB 1 -->
                <div id="tab1" class="tab-panel active">
                    <div class="header-title">
                        <div class="header-title-text">
                            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png"
                                alt="">
                            <span>Liste des documents électroniques</span>
                        </div>
                    </div>

                    <div class="table-controls">
                        <div class="filters-row">
                            <label class="ctl ctl-search">
                                <input type="text" id="searchInput1" placeholder="Recherchez...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                            <label class="ctl ctl-select">
                                <select id="categoryFilter1"></select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </label>
                        </div>
                        <div class="action-icons">
                            <button><img width="20"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                                    alt=""></button>
                            <button><img width="20"
                                    src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                    alt=""></button>
                        </div>
                    </div>

                    <table id="table1" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll1"></th>
                                <th>Référence</th>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Date d'ajout</th>
                                <th>Dernière modification</th>
                                <th>Fichier</th>
                                <th>Ajouté par</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="history-section"></div>
                </div>

                <!-- TAB 2 -->
                <div id="tab2" class="tab-panel">
                    <div class="header-title">
                        <div class="header-title-text">
                            <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/10550857.png"
                                alt="">
                            <span>Liste des documents électroniques</span>
                        </div>
                        <button class="upload-btn" id="openAddBtn"><i class="fa-solid fa-plus"></i> Téléverser un
                            document</button>
                    </div>

                    <div class="table-controls">
                        <div class="filters-row">
                            <label class="ctl ctl-search">
                                <input type="text" id="searchInput2" placeholder="Recherchez...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                            <label class="ctl ctl-select">
                                <select id="categoryFilter2"></select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </label>
                        </div>
                        <div class="action-icons">
                            <button><img width="20"
                                    src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"
                                    alt=""></button>
                            <button><img width="20"
                                    src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                                    alt=""></button>
                        </div>
                    </div>

                    <table id="table2" class="styled-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll2"></th>
                                <th>Référence</th>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Date d'ajout</th>
                                <th>Dernière modification</th>
                                <th>Fichier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="history-section"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL AJOUT -->
    <div class="modal-overlay" id="modalObjectifs">
        <div class="popup-container" id="popupContainerObjectifs">
            <div class="popup-header">
                <h2>Ajouter un document</h2>
                <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div>
                    <label for="doc-categorie">Catégorie</label>
                    <select id="doc-categorie" name="doc-categorie">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Financier">Financier</option>
                        <option value="Stratégique">Stratégique</option>
                    </select>
                </div>
                <div>
                    <label for="doc-titre">Titre</label>
                    <input type="text" id="doc-titre" name="doc-titre" placeholder="Titre">
                </div>
                <div>
                    <label for="doc-description">Description</label>
                    <textarea id="doc-description" name="doc-description" placeholder="Description"></textarea>
                </div>
                <div>
                    <label for="doc-file">Pièce jointe</label>
                    <div class="input-file-wrapper">
                        <input type="text" class="input-file-text" placeholder="Pièce jointe" readonly>
                        <label for="file-upload-input" class="btn-importer">Importer</label>
                        <input type="file" id="file-upload-input" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal-overlay" id="modalModifier">
        <div class="popup-container" id="popupContainerModifier">
            <div class="popup-header">
                <h2>Modifier le document</h2>
                <button class="btn-enregistrer" id="btnUpdateDoc">Enregistrer</button>
            </div>
            <form class="popup-form">
                <div>
                    <label for="edit-doc-categorie">Catégorie</label>
                    <select id="edit-doc-categorie" name="edit-doc-categorie">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Financier">Financier</option>
                        <option value="Stratégique">Stratégique</option>
                    </select>
                </div>
                <div>
                    <label for="edit-doc-titre">Titre</label>
                    <input type="text" id="edit-doc-titre" name="edit-doc-titre" placeholder="Titre">
                </div>
                <div>
                    <label for="edit-doc-description">Description</label>
                    <textarea id="edit-doc-description" name="edit-doc-description"
                        placeholder="Description"></textarea>
                </div>
            </form>
        </div>
    </div>

    <!-- JS libs -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- LOGIQUE GED -->
    <script>
    /**
     * IMPORTANT côté PHP :
     * wp_localize_script('ton-handle-js','pmsettings',[
     *   'root'  => esc_url_raw( rest_url() ),
     *   'nonce' => wp_create_nonce('wp_rest'),
     *   'current_user_id' => get_current_user_id(),
     * ]);
     */

    function showToast(msg = 'Lien copié') {
        const t = document.getElementById('ged-toast');
        t.textContent = msg;
        t.style.display = 'block';
        clearTimeout(showToast.__t);
        showToast.__t = setTimeout(() => t.style.display = 'none', 1800);
    }

    // Fallback copie (si navigator.clipboard indispo)
    async function copyTextFallback(text) {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'absolute';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.select();
        try {
            document.execCommand('copy');
        } finally {
            document.body.removeChild(ta);
        }
    }
    async function copyToClipboard(text) {
        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(text);
            } else {
                await copyTextFallback(text);
            }
            showToast('Lien copié dans le presse-papiers');
        } catch (e) {
            alert('Impossible de copier le lien');
        }
    }

    /* ==== modals ==== */
    function openmodalObjectifs() {
        document.getElementById('modalObjectifs').style.display = 'flex';
    }

    function closeModalObjectifs() {
        document.getElementById('modalObjectifs').style.display = 'none';
    }

    function openModalModifier() {
        document.getElementById('modalModifier').style.display = 'flex';
    }

    function closeModalModifier() {
        document.getElementById('modalModifier').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const mAdd = document.getElementById('modalObjectifs');
        const pAdd = document.getElementById('popupContainerObjectifs');
        mAdd.addEventListener('click', e => {
            if (!pAdd.contains(e.target)) closeModalObjectifs();
        });

        const mEdit = document.getElementById('modalModifier');
        const pEdit = document.getElementById('popupContainerModifier');
        mEdit.addEventListener('click', e => {
            if (!pEdit.contains(e.target)) closeModalModifier();
        });
    });
    </script>

    <!-- APPELS REST (WP) -->
    <script>
    /* ====== CONFIG WORDPRESS ====== */
    window.pmsettings = window.pmsettings || {
        rest_root: (window.wpApiSettings?.root || '<?php echo esc_url_raw(rest_url()); ?>'),
        nonce: (window.wpApiSettings?.nonce || '<?php echo esc_js(wp_create_nonce("wp_rest")); ?>'),
        // current_user_id doit être injecté côté PHP ; fallback si absent
        current_user_id: window.currentUserId || (window.wp?.data?.select('core')?.getCurrentUser()?.id) || 0
    };

    const API = (pmsettings.rest_root || pmsettings.root).replace(/\/+$/, '') + '/plateforme-recherche/v1/documents';
    const HEADERS = {
        'X-WP-Nonce': pmsettings.nonce
    };

    function toStr(v) {
        return (v === undefined || v === null) ? '' : String(v);
    }
    const YOU_ID = toStr(pmsettings.current_user_id ?? 0);

    /* ====== Helpers ====== */
    // mini-vignette cliquable pour le fichier
    function fileThumb(url) {
        if (!url) return '—';
        const ICON = '/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png';
        return `<a href="${url}" target="_blank" rel="noopener">
            <img width="20" src="${ICON}" alt="Ouvrir le fichier">
          </a>`;
    }

    function buildRowTab1(d) {
        const fileUrl = d?.file?.public_url || d?.file?.url || '';
        return `<tr data-id="${d.id}" data-owner="${d.owner}" data-file-url="${fileUrl}">
    <td><input type="checkbox" class="row-checkbox"></td>
    <td>${d.ref ?? ''}</td>
    <td>${d.titre ?? ''}</td>
    <td>${d.categorie ?? ''}</td>
    <td>${d.date_ajout ?? ''}</td>
    <td>${d.date_modif ?? ''}</td>
    <td>${fileThumb(d?.file?.url)}</td>
    <td>${d.owner_name ?? ''}</td>
    <td>
      <button class="copy-link-btn" title="Copier le lien de partage" style="background:none;border:0;cursor:pointer">
        <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-undo.png" alt="Copier le lien">
      </button>
    </td>
  </tr>`;
    }

    function buildRowTab2(d) {
        return `<tr data-id="${d.id}">
    <td><input type="checkbox" class="row-checkbox"></td>
    <td>${d.ref ?? ''}</td>
    <td>${d.titre ?? ''}</td>
    <td>${d.categorie ?? ''}</td>
    <td>${d.date_ajout ?? ''}</td>
    <td>${d.date_modif ?? ''}</td>
    <td>${fileThumb(d?.file?.url)}</td>
    <td>
      <div class="action-menu-container">
        <i class="fa-solid fa-ellipsis action-menu-trigger"></i>
        <div class="action-menu">
          <a href="#" class="edit-doc-btn"><i class="fa-solid fa-pencil"></i> Modifier</a>
          <a href="#" class="delete-doc-btn"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
        </div>
      </div>
    </td>
  </tr>`;
    }

    async function fetchDocs(params = {}) {
        const url = new URL(API);
        Object.entries(params).forEach(([k, v]) => {
            if (v !== undefined && v !== '') url.searchParams.set(k, v);
        });
        const r = await fetch(url, {
            credentials: 'same-origin',
            headers: HEADERS
        });
        if (!r.ok) throw new Error('Load failed');
        return r.json();
    }

    /* ====== Init DataTables + Chargement ====== */
    let t1, t2;

    async function loadTables() {
        const [all, mine] = await Promise.all([
            fetchDocs({
                page: 1,
                per_page: 100
            }),
            fetchDocs({
                mine: 1,
                page: 1,
                per_page: 100
            })
        ]);

        // Copier lien (tab 1)
        $('#table1 tbody')
            .off('click', '.copy-link-btn')
            .on('click', '.copy-link-btn', async function(e) {
                e.preventDefault();
                const $tr = $(this).closest('tr');
                let url = $tr.data('file-url');
                if (!url) {
                    alert('Aucun fichier associé ou lien non disponible.');
                    return;
                }
                await copyToClipboard(url);
            });

        // Injecte HTML
        document.querySelector('#table1 tbody').innerHTML = (all.data || []).map(buildRowTab1).join('');
        document.querySelector('#table2 tbody').innerHTML = (mine.data || []).map(buildRowTab2).join('');

        // (re)crée DataTables proprement
        if ($.fn.dataTable.isDataTable('#table1')) $('#table1').DataTable().clear().destroy();
        if ($.fn.dataTable.isDataTable('#table2')) $('#table2').DataTable().clear().destroy();

        const dtOpts = {
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'rtp',
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angle-left'></i>",
                    next: "<i class='fa-solid fa-angle-right'></i>"
                },
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            }
        };
        t1 = $('#table1').DataTable(dtOpts);
        t2 = $('#table2').DataTable(dtOpts);

        // Filtres catégories
        const cat1 = $('#categoryFilter1').empty().append('<option value="">Toutes les catégories</option>');
        [...new Set((all.data || []).map(x => x.categorie).filter(Boolean))].sort().forEach(c => cat1.append(
            `<option>${c}</option>`));
        cat1.off('change').on('change', function() {
            const v = $.fn.dataTable.util.escapeRegex($(this).val());
            t1.column(3).search(v ? `^${v}$` : '', true, false).draw();
        });

        const cat2 = $('#categoryFilter2').empty().append('<option value="">Toutes les catégories</option>');
        [...new Set((mine.data || []).map(x => x.categorie).filter(Boolean))].sort().forEach(c => cat2.append(
            `<option>${c}</option>`));
        cat2.off('change').on('change', function() {
            const v = $.fn.dataTable.util.escapeRegex($(this).val());
            t2.column(3).search(v ? `^${v}$` : '', true, false).draw();
        });

        // Menus actions (délégation)
        $('#table2 tbody').off('click', '.action-menu-trigger').on('click', '.action-menu-trigger', function(e) {
            e.stopPropagation();
            const menu = $(this).next('.action-menu');
            $('.action-menu').not(menu).removeClass('show');
            menu.toggleClass('show');
        });
        $(window).off('click.ged').on('click.ged', () => $('.action-menu').removeClass('show'));

        // Edit
        $('#table2 tbody').off('click', '.edit-doc-btn').on('click', '.edit-doc-btn', function(e) {
            e.preventDefault();
            const id = $(this).closest('tr').data('id');
            openEditModal(id);
        });

        // Delete
        $('#table2 tbody').off('click', '.delete-doc-btn').on('click', '.delete-doc-btn', async function(e) {
            e.preventDefault();
            const id = $(this).closest('tr').data('id');
            if (!confirm('Supprimer ce document ?')) return;
            const r = await fetch(`${API}/${id}`, {
                method: 'DELETE',
                credentials: 'same-origin',
                headers: HEADERS
            });
            if (r.status === 204) {
                t2.row($(this).closest('tr')).remove().draw(false);
                const $rowAll = $(`#table1 tbody tr[data-id="${id}"]`);
                if ($rowAll.length) t1.row($rowAll).remove().draw(false);
            } else {
                alert('Suppression refusée');
            }
        });

        // Recherches personnalisées
        $('#searchInput1').off('keyup').on('keyup', function() {
            t1.search(this.value).draw();
        });
        $('#searchInput2').off('keyup').on('keyup', function() {
            t2.search(this.value).draw();
        });

        // Check-all pour chaque tableau
        setupCheckAll('#checkAll1', t1);
        setupCheckAll('#checkAll2', t2);
    }

    function setupCheckAll(checkSel, dt) {
        $(checkSel).off('click').on('click', function() {
            const isChecked = $(this).is(':checked');
            dt.rows({
                search: 'applied'
            }).nodes().to$().find('.row-checkbox').prop('checked', isChecked);
        });
        dt.off('draw.checkall').on('draw.checkall', function() {
            const all = dt.rows({
                search: 'applied'
            }).nodes().to$().find('.row-checkbox');
            const chk = dt.rows({
                search: 'applied'
            }).nodes().to$().find('.row-checkbox:checked');
            $(checkSel).prop('checked', all.length > 0 && all.length === chk.length);
        });
    }

    /* ====== AJOUT ====== */
    document.getElementById('openAddBtn')?.addEventListener('click', openmodalObjectifs);

    document.getElementById('btnSaveObjectifs')?.addEventListener('click', async () => {
        if (!t1 || !t2) {
            console.warn('Tables non initialisées');
            return;
        }

        const titre = document.getElementById('doc-titre').value.trim();
        const categorie = document.getElementById('doc-categorie').value.trim();
        const description = document.getElementById('doc-description').value.trim();
        const file = document.getElementById('file-upload-input').files[0];
        if (!titre || !categorie) {
            alert('Titre et catégorie sont requis');
            return;
        }

        const fd = new FormData();
        fd.append('titre', titre);
        fd.append('categorie', categorie);
        fd.append('description', description);
        if (file) fd.append('file', file);

        const r = await fetch(API, {
            method: 'POST',
            body: fd,
            credentials: 'same-origin',
            headers: {
                'X-WP-Nonce': pmsettings.nonce
            }
        });
        if (!r.ok) {
            alert('Enregistrement refusé');
            return;
        }

        const json = await r.json();
        const doc = json?.data;
        if (!doc) {
            closeModalObjectifs();
            return;
        }

        // --- MAJ immédiate des 2 tableaux ---
        const $row1 = $(buildRowTab1(doc));
        t1.row.add($row1).draw();
        t1.page('first').draw(false);

        // 👉 On ajoute dans "Mes documents" sans attendre la prop 'owner'
        const $row2 = $(buildRowTab2(doc));
        t2.row.add($row2).draw(false);
        t2.page('first').draw(false);

        // MAJ filtre catégories Tab 2 si nouvelle
        const c = doc.categorie;
        if (c && $('#categoryFilter2 option').filter((_, o) => $(o).val() == c || $(o).text() == c)
            .length === 0) {
            $('#categoryFilter2').append(`<option value="${c}">${c}</option>`);
        }

        // Fermer + reset formulaire
        closeModalObjectifs();
        document.getElementById('doc-titre').value = '';
        document.getElementById('doc-categorie').value = '';
        document.getElementById('doc-description').value = '';
        document.querySelector('#modalObjectifs .input-file-text').value = '';
        document.getElementById('file-upload-input').value = '';
    });

    /* ====== EDIT ====== */
    async function openEditModal(id) {
        const r = await fetch(`${API}/${id}`, {
            headers: HEADERS,
            credentials: 'same-origin'
        });
        if (!r.ok) {
            alert('Document introuvable');
            return;
        }
        const doc = await r.json(); // déjà formaté

        document.getElementById('edit-doc-titre').value = doc.titre || '';
        document.getElementById('edit-doc-categorie').value = doc.categorie || '';
        document.getElementById('edit-doc-description').value = doc.description || '';

        document.getElementById('modalModifier').dataset.editId = String(doc.id);
        openModalModifier();
    }

    document.getElementById('btnUpdateDoc')?.addEventListener('click', async () => {
        const id = document.getElementById('modalModifier').dataset.editId;
        if (!id) return;

        const titre = document.getElementById('edit-doc-titre').value.trim();
        const categorie = document.getElementById('edit-doc-categorie').value.trim();
        const description = document.getElementById('edit-doc-description').value.trim();

        const res = await fetch(`${API}/${id}`, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': pmsettings.nonce
            },
            body: JSON.stringify({
                titre,
                categorie,
                description
            })
        });

        if (!res.ok) {
            alert('Mise à jour refusée');
            return;
        }
        const json = await res.json();
        const doc = json?.data;

        closeModalModifier();

        // Mettre à jour les 2 tableaux si la ligne existe
        const $rowAll = $(`#table1 tbody tr[data-id="${doc.id}"]`);
        if ($rowAll.length) {
            t1.row($rowAll).remove();
            t1.row.add($(buildRowTab1(doc))).draw(false);
        }
        const $rowMine = $(`#table2 tbody tr[data-id="${doc.id}"]`);
        if ($rowMine.length) {
            t2.row($rowMine).remove();
            t2.row.add($(buildRowTab2(doc))).draw(false);
        }
    });

    /* Renseigne le champ texte de fichier (ajout & edit) */
    document.getElementById('file-upload-input')?.addEventListener('change', function() {
        const name = this.files?. [0]?.name || '';
        document.querySelector('#modalObjectifs .input-file-text').value = name;
    });

    /* ====== Onglets + ajustement DataTables ====== */
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-tab');
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(id).classList.add('active');

            if (id === 'tab2' && t2) setTimeout(() => t2.columns.adjust().draw(false), 0);
            if (id === 'tab1' && t1) setTimeout(() => t1.columns.adjust().draw(false), 0);
        });
    });

    /* ====== GO ====== */
    document.addEventListener('DOMContentLoaded', () => {
        loadTables();
    });
    </script>

    <div id="ged-toast" style="
    position:fixed;left:50%;transform:translateX(-50%);
    bottom:24px;background:#2a2916;color:#fff;padding:10px 14px;
    border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.15);
    font-size:14px;display:none;z-index:9999999
  ">Lien copié</div>
</body>

</html>