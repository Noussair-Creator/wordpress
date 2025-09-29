<section id="liste-sujets">
    <style>
    /* ========== SCOPÉ AU COMPOSANT ========== */
    #liste-sujets {
        background: #fff;
        border: 1px solid #E8E6DB;
        border-radius: 10px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, .08);
        padding: 14px;
        color: #2A2916;
        font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
    }

    /* Titre */
    #liste-sujets .header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 8px;
        margin-bottom: 14px;
        border-bottom: 1px solid #EBE9D7;
    }

    #liste-sujets .header .icon {
        width: 28px;
        height: 28px;
        background: #fff url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/9368448.png') center/contain no-repeat;
        border-radius: 4px
    }

    #liste-sujets .header .title {
        font-weight: 700;
        font-size: 18px
    }

    /* Toolbar (search + actions) */
    #liste-sujets .toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px
    }

    #liste-sujets .search {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        height: 36px;
        border: 1px solid #DBD9C3;
        border-radius: 6px;
        background: #fff;
        padding: 0 10px;
        max-width: 280px
    }

    #liste-sujets .search input {
        flex: 1;
        border: 0;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #2A2916
    }

    #liste-sujets .search .btn {
        width: 34px;
        height: 28px;
        border: 0;
        border-left: 1px solid #DBD9C3;
        border-radius: 4px;
        background: #fff;
        display: grid;
        place-items: center;
        cursor: pointer
    }

    #liste-sujets .toolbar .spacer {
        flex: 1
    }

    #liste-sujets .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: 1px solid #DBD9C3;
        background: #fff;
        display: grid;
        place-items: center;
        cursor: pointer
    }

    #liste-sujets .btn-icon img {
        width: 14px;
        height: 14px;
        display: block
    }

    #liste-sujets .btn-primary {
        height: 36px;
        border-radius: 6px;
        border: 1px solid #BF0404;
        background: #BF0404;
        color: #fff;
        padding: 0 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px
    }

    /* Thead */
    #liste-sujets .table-head {
        background: #EDEBDF;
        border: 1px solid #A6A4853D;
        border-radius: 8px;
        padding: 0 8px;
        height: 45px;
        display: flex;
        align-items: center
    }

    #liste-sujets .table-head table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0
    }

    #liste-sujets .table-head th {
        text-align: left;
        font-weight: 700;
        font-size: 14px;
        color: #2A2916;
        padding: 0 12px;
        border: 0;
        white-space: nowrap
    }

    /* Largeurs adaptées à 7 colonnes (comme la capture) */
    #liste-sujets .table-head th:first-child {
        width: 36px;
        text-align: center
    }

    #liste-sujets .table-head th:nth-child(2) {
        width: 90px
    }

    /* Code */
    #liste-sujets .table-head th:nth-child(3) {
        width: auto
    }

    /* Type de rapport */
    #liste-sujets .table-head th:nth-child(4) {
        width: 140px
    }

    /* Fréquence */
    #liste-sujets .table-head th:nth-child(5) {
        width: 150px
    }

    /* Date de génération */
    #liste-sujets .table-head th:nth-child(6),
    #liste-sujets .table-head th:nth-child(7) {
        width: 100px;
        text-align: center
    }

    /* Télécharger / Action */

    /* Corps */
    #liste-sujets .table-body {
        background: #fff;
        border: 2px solid #EBE9D7;
        border-radius: 8px;
        margin-top: 8px;
        overflow: auto;
    }

    #liste-sujets .tbl {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 720px
    }

    #liste-sujets .tbl td {
        background: #fff;
        padding: 12px;
        border-bottom: 1px solid #EBE9D7;
        vertical-align: middle;
        font-size: 14px;
        color: #2A2916
    }

    #liste-sujets .tbl tr:last-child td {
        border-bottom: none
    }

    /* Largeurs/alignements synchronisés avec le thead */
    #liste-sujets .tbl td:first-child {
        width: 36px;
        text-align: center
    }

    #liste-sujets .tbl td:nth-child(2) {
        width: 90px
    }

    /* Code */
    #liste-sujets .tbl td:nth-child(3) {
        width: auto;
        border-right: 1px solid #EBE9D7
    }

    /* Type de rapport + trait de séparation */
    #liste-sujets .tbl td:nth-child(4) {
        width: 140px;
        text-align: center
    }

    /* Fréquence */
    #liste-sujets .tbl td:nth-child(5) {
        width: 150px;
        text-align: center
    }

    /* Date */
    #liste-sujets .tbl td:nth-child(6) {
        width: 100px;
        text-align: center;
        border-left: 1px solid #EBE9D7
    }

    /* Télécharger */
    #liste-sujets .tbl td:nth-child(7) {
        width: 100px;
        text-align: center;
        border-left: 1px solid #EBE9D7
    }

    /* Action */


    /* Checkbox */
    #liste-sujets .chk {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: #6b6c4a
    }

    /* Pagination */
    #liste-sujets .pager {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
        margin-top: 12px
    }

    #liste-sujets .pager .pbtn {
        width: 32px;
        height: 32px;
        border: 2px solid #BF0404;
        background: #fff;
        color: #BF0404;
        border-radius: 6px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    #liste-sujets .pager .pbtn:disabled {
        border-color: #DBD9C3;
        color: #DBD9C3;
        cursor: not-allowed;
    }

    #liste-sujets .pager .pbtn.active {
        background-color: #BF0404;
        color: #fff;
    }

    #liste-sujets .pager .pnum {
        min-width: 30px;
        text-align: center;
        line-height: 32px;
        font-weight: 400;
        color: #000
    }

    /* ===== Offcanvas (styles existants conservés) ===== */
    #liste-sujets .sb-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        opacity: 0;
        pointer-events: none;
        transition: opacity .2s;
        z-index: 10040
    }

    #liste-sujets .sb {
        position: fixed;
        top: 0;
        right: -450px;
        width: 450px;
        height: 100vh;
        background: #FFFFFF;
        box-shadow: -7px 0 36px #00000029;
        border-left: 1px solid #E7E4D7;
        display: flex;
        flex-direction: column;
        z-index: 10050;
        transition: right .25s ease
    }

    #liste-sujets .sb.open {
        right: 0
    }

    #liste-sujets .sb-backdrop.open {
        opacity: 1;
        pointer-events: auto
    }

    body.no-scroll {
        overflow: hidden
    }

    #liste-sujets .sb-head {
        position: sticky;
        top: 0;
        height: 60px;
        padding: 12px 16px;
        background: #fff;
        box-shadow: 0 5px 16px #00000029;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1
    }

    #liste-sujets .sb-title {
        margin: 0;
        font: 700 16px/22px Roboto;
        color: #2A2916
    }

    #liste-sujets .sb-save {
        height: 36px;
        min-width: 120px;
        border-radius: 6px;
        border: 1px solid #BF0404;
        background: #BF0404;
        color: #fff;
        font: 600 14px/20px Roboto;
        cursor: pointer
    }

    #liste-sujets .sb-body {
        flex: 1;
        overflow: auto;
        padding: 22px 16px 18px;
    }

    #liste-sujets .fld {
        margin-bottom: 12px
    }

    #liste-sujets .inp,
    #liste-sujets .sel,
    #liste-sujets .txt {
        width: 100%;
        border: 1px solid #DBD9C3;
        border-radius: 6px;
        background: #FFFFFF;
        color: #2A2916;
        font: 400 14px/20px Roboto;
        padding: 10px 12px
    }

    #liste-sujets .txt {
        min-height: 64px;
        resize: vertical
    }

    /* MODIFIED: Styles for form labels */
    #liste-sujets .lbl {
        display: block;
        margin-bottom: 6px;
        text-align: left;
        font: 700 15px/20px Roboto;
        color: #2A2916;
    }

    #liste-sujets .rte {
        border: 1px solid #DBD9C3;
        border-radius: 6px
    }

    #liste-sujets .rte-toolbar {
        height: 36px;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 0 8px;
        background: #EFEDE3;
        border-bottom: 1px solid #DBD9C3
    }

    #liste-sujets .rte-btn {
        height: 26px;
        min-width: 26px;
        padding: 0 8px;
        border: 1px solid #D6D3C5;
        background: #fff;
        border-radius: 6px;
        display: grid;
        place-items: center;
        font: 600 13px/1 Roboto;
        color: #2A2916;
        cursor: pointer
    }

    #liste-sujets .rte-area {
        min-height: 110px;
        padding: 10px;
        outline: none
    }

    #liste-sujets .rte-area:empty:before {
        content: attr(data-placeholder);
        color: #8A887A;
        pointer-events: none
    }

    /* Ligne fichier + bouton Importer */
    #liste-sujets .file-row {
        display: flex;
        align-items: center;
        margin-top: 18px
    }

    #liste-sujets .file-row .fake {
        flex: 1;
        height: 40px;
        border: 1px solid #DBD9C3;
        border-right: none;
        border-radius: 6px 0 0 6px;
        padding: 0 12px;
        background: #fff;
        color: #2A2916;
        font: 400 14px/20px Roboto
    }

    #liste-sujets .btn-upload {
        height: 40px;
        border: 1px solid #A6A485;
        border-radius: 0 6px 6px 0;
        background: #A6A485;
        color: #fff;
        font-weight: 600;
        padding: 0 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer
    }

    #liste-sujets .btn-upload img {
        width: 14px;
        height: 14px;
        transform: rotate(180deg);
        filter: brightness(0) invert(1)
    }

    /* Responsive */
    @media (max-width: 820px) {
        #liste-sujets .tbl {
            min-width: 680px
        }
    }

    @media (max-width: 640px) {
        #liste-sujets .toolbar .search {
            max-width: 100%
        }

        #liste-sujets .btn-primary {
            padding: 0 10px
        }

        #liste-sujets .tbl {
            min-width: 640px
        }
    }

    /* ↑ Agrandir les icônes dans "Télécharger" (col. 6) et "Action" (col. 7) */
    #liste-sujets .tbl td:nth-child(6) img {
        width: 18px;
        height: 22px;
    }

    #liste-sujets .tbl td:nth-child(7) img {
        width: 18px;
        /* ← mets 24px ou 28px si tu veux encore plus grand */
        height: 18px;
        /* coins un peu plus arrondis (optionnel) */
    }

    /* ===== OFFCANVAS — styles pour la maquette "Générer un rapport" ===== */

    /* Tête (conservée, juste le libellé changé) */
    #liste-sujets .sb-head {
        height: 60px;
        padding: 12px 16px;
        background: #fff;
        box-shadow: 0 5px 16px #00000029;
        position: sticky;
        top: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #liste-sujets .sb-title {
        margin: 0;
        font: 700 16px/22px Roboto;
        color: #2A2916
    }

    #liste-sujets .sb-save {
        height: 36px;
        min-width: 120px;
        border-radius: 6px;
        border: 1px solid #BF0404;
        background: #BF0404;
        color: #fff;
        font: 600 14px/20px Roboto;
        cursor: pointer;
    }

    /* Pile des champs */
    #liste-sujets .form-stack {
        display: flex;
        flex-direction: column;
        gap: 16px;
        /* Increased gap for better spacing with labels */
        max-width: 430px
    }

    /* Base des contrôles */
    #liste-sujets .field {
        position: relative
    }

    #liste-sujets .control {
        width: 100%;
        height: 40px;
        background: #FFFFFF;
        border: 1px solid #DBD9C3;
        border-radius: 6px;
        padding: 0 44px 0 12px;
        /* place pour l'icône à droite */
        font: 400 14px/20px Roboto;
        color: #2A2916;
        /* Changed color for better readability */
    }

    /* MODIFICATION: Remove right padding for the date input specifically */
    #liste-sujets .field--date .control {
        padding-right: 12px;
    }

    #liste-sujets .control::placeholder,
    #liste-sujets .sel option[value=""] {
        color: #A6A59F;
    }


    #liste-sujets .sel {
        appearance: none
    }

    /* Trait vertical avant l’icône (comme la capture) */
    #liste-sujets .field::after {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 44px;
        height: 18px;
        border-left: 1px solid #DBD9C3;
    }

    /* MODIFICATION: Hide the vertical line for the date input field */
    #liste-sujets .field--date::after {
        display: none;
    }


    /* Mini pastilles des icônes à droite */

    #liste-sujets .ico-chevron {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        pointer-events: none;
        background: url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-chevron-down.png') center/contain no-repeat;
    }

    #liste-sujets .ico-calendar {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        background: url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-calendar.png') center/contain no-repeat;
        opacity: .85;
        pointer-events: none;
    }

    /* Placeholder visible pour l’input date jusqu’à saisie */
    #liste-sujets .field--date .ph {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #A6A59F;
        pointer-events: none;
        transition: opacity .12s;
    }

    #liste-sujets .field--date.has-value .ph {
        opacity: 0
    }

    /* Responsive */
    @media (max-width:520px) {
        #liste-sujets .form-stack {
            max-width: 100%
        }
    }


    /* Séparateurs verticaux dans le TBODY :
- entre col 1 (checkbox) et col 2 (Code)
- entre col 2 et col 3 (Type de rapport) */
    #liste-sujets .table-body .tbl tbody td:nth-child(2) {
        border-left: 1px solid #EBE9D7;
        /* trait entre 1 et 2 */
    }

    #liste-sujets .table-body .tbl tbody td:nth-child(3) {
        border-left: 1px solid #EBE9D7;
        /* trait entre 2 et 3 */
        border-right: 0;
        /* annule le trait à droite s’il existait */
    }

    /* Style pour le message "aucun résultat" */
    .no-results-message {
        text-align: center;
        padding: 20px;
        font-size: 16px;
        color: #8A887A;
    }

    .hidden {
        display: none;
    }
    </style>

    <!-- Header -->
    <div class="header">
        <span class="icon" aria-hidden="true"></span>
        <div class="title">Génération Automatique des Rapports</div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search">
            <input type="text" id="sujets-search" placeholder="Recherche…">
            <button class="btn" id="btn-search" title="Rechercher">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="spacer"></div>
        <button class="btn-icon" id="btn-export" title="Télécharger">
            <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/Groupe 152.png"
                alt="upload-red.png">
        </button>
        <button class="btn-primary" id="btn-add">Générer un rapport</button>
    </div>

    <!-- Table Head -->
    <div class="table-head">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="chk" id="chk-all"></th>
                    <th>Code</th>
                    <th>Type de rapport</th>
                    <th>Fréquence</th>
                    <th>date de génération</th>
                    <th>Télécharger</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Table Body -->
    <div class="table-body">
        <table class="tbl">
            <tbody id="sujets-tbody">
                <tr class="rel">
                    <td><input type="checkbox" class="chk"></td>
                    <td>001</td>
                    <td>جذاذة تقييم شهادة ماجستير</td>
                    <td>Annuelle</td>
                    <td>12/04/2025</td>
                    <td><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com (2).png"></td>
                    <td><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                            alt="Icon-upload"></td>
                </tr>
                <tr class="rel">
                    <td><input type="checkbox" class="chk"></td>
                    <td>002</td>
                    <td>جذاذة تقييم شهادة ماجستير</td>
                    <td>Semestrielle</td>
                    <td>12/04/2025</td>
                    <td><img width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com (2).png"></td>
                    <td><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
                            alt="Icon-upload"></td>
                </tr>
            </tbody>
        </table>
        <!-- Message to display when no search results are found -->
        <div id="no-results-message" class="no-results-message hidden">
            Aucun rapport trouvé.
        </div>
    </div>

    <!-- Pagination -->
    <div class="pager">
        <!-- <button class="pbtn" id="btn-first" title="Première">«</button> -->
        <button class="pbtn" id="btn-prev" title="Précédent">‹</button>
        <div id="page-numbers"></div>
        <button class="pbtn" id="btn-next" title="Suivant">›</button>
        <!-- <button class="pbtn" id="btn-last" title="Dernière">»</button> -->
    </div>

    <!-- Offcanvas -->
    <div class="sb-backdrop" id="sbBackdrop"></div>
    <aside class="sb" id="sb" aria-hidden="true">
        <div class="sb-head">
            <h3 class="sb-title" id="sbTitle">Générer un rapport</h3>
            <button class="sb-save" id="sbSave">Générer</button>
        </div>

        <div class="sb-body">
            <!-- MODIFIED: Added labels and structure for form fields -->
            <div class="form-stack">
                <!-- Type de rapport -->
                <div>
                    <label for="rep-type" class="lbl">Type de rapport</label>
                    <div class="field sel-wrap">
                        <select class="control sel" id="rep-type" required>
                            <option value="" selected disabled>Sélectionnez un type</option>
                            <option>Rapport annuel</option>
                            <option>Rapport semestriel</option>
                            <option>Rapport mensuel</option>
                            <option>Rapport trimestriel</option>
                        </select>
                        <span class="ico-chevron">
                            <i class="fa-solid fa-chevron-down"></i>

                        </span>
                    </div>
                </div>

                <!-- Fréquence -->
                <div>
                    <label for="rep-freq" class="lbl">Fréquence</label>
                    <div class="field sel-wrap">
                        <select class="control sel" id="rep-freq" required>
                            <option value="" selected disabled>Sélectionnez la fréquence</option>
                            <option>Annuelle</option>
                            <option>Semestrielle</option>
                            <option>Trimestrielle</option>
                            <option>Mensuelle</option>
                        </select>
                        <span class="ico-chevron">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                    </div>
                </div>

                <!-- Date de génération -->
                <div>
                    <label for="rep-date" class="lbl">Date de génération</label>
                    <!-- MODIFICATION: Removed the icon's span from here -->
                    <div class="field inp-wrap field--date" id="dateField">
                        <input class="control inp" type="date" id="rep-date" required>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <script>
    (function() {
        /* Offcanvas */
        const sb = document.getElementById('sb');
        const bd = document.getElementById('sbBackdrop');
        const btnAdd = document.getElementById('btn-add');
        const btnSave = document.getElementById('sbSave');

        function openSB() {
            sb.classList.add('open');
            bd.classList.add('open');
            sb.setAttribute('aria-hidden', 'false');
            document.body.classList.add('no-scroll');
        }

        function closeSB() {
            sb.classList.remove('open');
            bd.classList.remove('open');
            sb.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('no-scroll');
        }

        if (btnAdd) {
            btnAdd.addEventListener('click', openSB);
        }
        if (bd) {
            bd.addEventListener('click', closeSB);
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeSB();
        });
        if (btnSave) {
            btnSave.addEventListener('click', closeSB);
        }

        /* Elements */
        const searchInput = document.getElementById('sujets-search');
        const rows = Array.from(document.querySelectorAll('#sujets-tbody tr'));
        const noResultsMessage = document.getElementById('no-results-message');
        const chkAll = document.getElementById('chk-all');
        const dateWrap = document.getElementById('dateField');
        const dateInp = document.getElementById('rep-date');
        const pageNumbersContainer = document.getElementById('page-numbers');
        const prevBtn = document.getElementById('btn-prev');
        const nextBtn = document.getElementById('btn-next');

        /* Global checkbox selection */
        if (chkAll) {
            chkAll.addEventListener('change', () => {
                document.querySelectorAll('#sujets-tbody .chk').forEach(c => c.checked = chkAll.checked);
            });
        }

        /* Placeholder overlay for date input */
        function syncDatePH() {
            if (dateInp) {
                dateWrap.classList.toggle('has-value', !!dateInp.value);
            }
        }
        if (dateInp) {
            syncDatePH();
            dateInp.addEventListener('input', syncDatePH);
            dateInp.addEventListener('change', syncDatePH);
        }

        /* --- Pagination & Filtering Logic --- */
        const rowsPerPage = 3;
        let currentPage = 1;

        function renderPage(page, rowsToDisplay) {
            currentPage = page;
            const totalRows = rowsToDisplay.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            // Hide all master rows first
            rows.forEach(row => {
                row.style.display = 'none';
            });

            // Then, show only the rows for the current page from the filtered list
            const pageRows = rowsToDisplay.slice(startIndex, endIndex);
            pageRows.forEach(row => {
                row.style.display = ''; // Re-show the row as a table-row
            });

            // Update pagination controls
            if (prevBtn) {
                prevBtn.disabled = currentPage === 1;
            }
            if (nextBtn) {
                nextBtn.disabled = currentPage >= totalPages;
            }
            if (pageNumbersContainer) {
                pageNumbersContainer.innerHTML = totalRows > 0 ?
                    `<span class="pnum" title="Page courante">${currentPage}</span>` : '';
            }
        }

        function filterAndRender() {
            const q = (searchInput.value || '').toLowerCase();
            const filteredRows = rows.filter(row => row.innerText.toLowerCase().includes(q));

            if (noResultsMessage) {
                noResultsMessage.classList.toggle('hidden', filteredRows.length > 0);
            }

            renderPage(1, filteredRows);
        }

        function goToPage(page) {
            const q = (searchInput.value || '').toLowerCase();
            const filteredRows = rows.filter(row => row.innerText.toLowerCase().includes(q));
            const totalPages = Math.ceil(filteredRows.length / rowsPerPage) || 1;

            let targetPage = page;
            if (targetPage < 1) {
                targetPage = 1;
            } else if (targetPage > totalPages) {
                targetPage = totalPages;
            }

            renderPage(targetPage, filteredRows);
        }

        // Event listener for search input
        if (searchInput) {
            searchInput.addEventListener('input', filterAndRender);
        }

        // Event listeners for pagination buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', () => goToPage(currentPage - 1));
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => goToPage(currentPage + 1));
        }

        // Initial render on page load
        filterAndRender();

    })();
    </script>
    <?php
    $current_user = wp_get_current_user();
    $roles = (array) $current_user->roles;
    $role = $roles[0] ?? '';
    $user_id = get_current_user_id();

    ?>
    <script>
    window.PMSettings = {
        restUrl: "<?= esc_url(rest_url()) ?>",
        nonce: "<?= wp_create_nonce('wp_rest') ?>",
        role: "<?= esc_js($role) ?>",
        userId: <?= (int) $user_id ?>
    };
    </script>
    <script>
    async function apiGetReports() {
        const res = await fetch(`${window.PMSettings.restUrl}plateforme-rapport/v1/list`, {
            headers: {
                "X-WP-Nonce": window.PMSettings.nonce
            }
        });
        return res.json();
    }

    async function apiCreateReport(payload) {
        const res = await fetch(`${window.PMSettings.restUrl}plateforme-rapport/v1/create`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-WP-Nonce": window.PMSettings.nonce
            },
            body: JSON.stringify(payload)
        });
        return res.json();
    }

    async function apiDeleteReport(id) {
        const res = await fetch(`${window.PMSettings.restUrl}plateforme-rapport/v1/delete/${id}`, {
            method: "DELETE",
            headers: {
                "X-WP-Nonce": window.PMSettings.nonce
            }
        });
        return res.json();
    }
    async function renderReports() {
        const tbody = document.getElementById("sujets-tbody");
        tbody.innerHTML = "<tr><td colspan='7'>Chargement…</td></tr>";

        const data = await apiGetReports();
        tbody.innerHTML = "";

        if (!data.length) {
            document.getElementById("no-results-message").classList.remove("hidden");
            return;
        }

        data.forEach(rep => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
      <td><input type="checkbox" class="chk"></td>
      <td>${rep.code}</td>
      <td>${rep.type_rapport}</td>
      <td>${rep.frequence}</td>
      <td>${rep.date_generation}</td>
      <td>
        ${rep.fichier_url ? `<a href="${rep.fichier_url}" target="_blank">
          <img src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="PDF"></a>` : ''}
      </td>
      <td>
        <img src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-trash-2.png"
             alt="delete" style="cursor:pointer" onclick="deleteReport(${rep.id})">
      </td>
    `;
            tbody.appendChild(tr);
        });
    }

    async function deleteReport(id) {
        if (!confirm("Supprimer ce rapport ?")) return;
        await apiDeleteReport(id);
        renderReports();
    }

    // Hook du bouton "Générer"
    document.getElementById("sbSave").addEventListener("click", async () => {
        const payload = {
            code: Date.now().toString().slice(-5),
            type_rapport: document.getElementById("rep-type").value,
            frequence: document.getElementById("rep-freq").value,
            date_generation: document.getElementById("rep-date").value,
            service: "Labo"
        };
        await apiCreateReport(payload);
        renderReports();
    });

    // Charger au démarrage
    renderReports();
    </script>
</section>