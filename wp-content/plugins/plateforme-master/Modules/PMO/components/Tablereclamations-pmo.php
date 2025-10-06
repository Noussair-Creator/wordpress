<section id="suivi-rec">
    <?php
    // Exemples de façons d’obtenir l’URL :
    // 1) page par son slug
    $page = get_page_by_path('reclamations'); // remplace par ton slug
    $reclamations_url = $page ? get_permalink($page->ID) : '';

    // 2) OU par option (si tu stockes l’ID de la page du formulaire en option)
    // $reclamations_url = get_permalink( (int) get_option('pm_page_reclamation_form') );
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    #suivi-rec {
        --ink: #2A2916;
        --olive: #A6A485;
        --danger: #BF0404;
        --edge: #ECEBE3;
        --line: #EBE9D7;
        --ok: #0E962D;
        --ok-bg: rgba(14, 150, 45, .1);
        --warn: #9A7A01;
        --warn-bg: #FFF5D6;
        --warn-b: #F0DF9C;
        --ko: #B10202;
        --ko-bg: #FFE8E8;
        --ko-b: #F5B6B6;
    }

    /* ===== Carte ===== */
    #suivi-rec .sr-card {
        width: auto;
        min-height: 462px;
        margin: 0 auto;
        background: #fff;
        box-shadow: 0 3px 22px #0000000F;
        border-radius: 8px;
        padding: 14px 16px 56px;
        position: relative
    }

    #suivi-rec .sr-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 4px 10px
    }

    #suivi-rec .sr-ico {
        width: 34px;
        height: 25px;
        object-fit: contain;
        display: block
    }

    #suivi-rec .sr-title {
        margin: 0;
        font: 700 20px/26px;
        color: var(--ink)
    }

    #suivi-rec .sr-title-sep {
        border: 0;
        border-top: 1px solid var(--edge);
        width: 100%;
        max-width: 952px;
        margin: 8px 0 12px
    }

    #suivi-rec .sr-toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 10px
    }

    #suivi-rec .sr-search {
        width: 255px;
        height: 35px;
        position: relative;
        background: #fff;
        border: 1px solid #DBD9C3;
        border-radius: 6px
    }

    #suivi-rec .sr-search input {
        width: 100%;
        height: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        padding: 0 36px 0 14px;
        font: 400 14px/17px;
        color: var(--ink)
    }

    #suivi-rec .sr-search input::placeholder {
        color: #A6A59F;
        text-transform: capitalize
    }

    #suivi-rec .sr-search svg {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px
    }

    #suivi-rec .sr-btn-primary {
        width: 178px;
        height: 40px;
        border-radius: 5px;
        border: none;
        background: #BF0404;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-grid;
        place-items: center
    }

    /* Bouton d'enregistrement dans l'entête de la sidebar Réponse */
    #suivi-rec .sr-sb-save {
        background: #BF0404;
        color: #fff;
        border: none;
        border-radius: 6px;
        height: 38px;
        padding: 0 14px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
    }

    #suivi-rec .sr-btn-square {
        width: 38px;
        height: 38px;
        border-radius: 5px;
        border: none;
        background: #fff;
        box-shadow: 0 0 6px #00000030;
        display: grid;
        place-items: center;
        cursor: pointer
    }

    /* ======= TABLES SÉPARÉES : head + body ======= */
    #suivi-rec .sr-table-wrap {
        margin-top: 6px;
    }

    #suivi-rec .sr-table-head,
    #suivi-rec .sr-table-body {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-size: 14px;
        color: var(--ink);
    }

    #suivi-rec col.c1 {
        width: 4%
    }

    #suivi-rec col.c2 {
        width: 16%
    }

    #suivi-rec col.c3 {
        width: 20%
    }

    #suivi-rec col.c4 {
        width: 30%
    }

    #suivi-rec col.c5 {
        width: 10%
    }

    #suivi-rec col.c6 {
        width: 12%
    }

    #suivi-rec col.c7 {
        width: 8%
    }

    .head-box {
        background: #ECEBE3;
        border: 1px solid #A6A4853D;
        border-radius: 8px;
        overflow: hidden;
    }

    #suivi-rec .sr-table-head thead th {
        background: transparent;
        padding: 10px 10px;
        text-align: left;
        font-weight: 700;
        font-size: 15px/20px;
        color: var(--ink);
    }

    #suivi-rec .sr-table-head thead th+th {
        border-left: 1px solid #E6E4D8;
    }

    #suivi-rec .sr-table-head thead th:first-child {
        text-align: center;
    }

    #suivi-rec .sr-table-head thead th:last-child {
        text-align: right;
        padding-right: 12px;
    }

    .body-box {
        border: 2px solid var(--line);
        border-radius: 8px;
        background: #fff;
        margin-top: 10px;
    }

    #suivi-rec .sr-table-body tbody td {
        padding: 10px 10px;
        vertical-align: middle;
        background: #fff;
        border-top: 1px solid var(--edge);
    }

    #suivi-rec .sr-table-body tbody tr:first-child td {
        border-top: none;
    }

    #suivi-rec .sr-table-body tbody td+td {
        border-left: 1px solid var(--edge);
    }

    #suivi-rec .sr-table-head thead th+th {
        border-left: 1px solid var(--edge);
    }

    #suivi-rec td.ref a {
        color: #2A2916;
        text-decoration: none
    }

    #suivi-rec td.ref a.active {
        color: #08449D;
        text-decoration: underline
    }

    /* Badges */
    #suivi-rec .sr-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 12px/14px;

    }

    #suivi-rec .sr-b-ok {
        background: var(--ok-bg);
        color: var(--ok);
        border: 1px solid var(--ok);
        border-radius: 15px;
        height: 25px;
        min-width: 97px;
        padding-left: 26px;
        position: relative
    }

    #suivi-rec .sr-b-ok::before {
        content: "";
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="%230E962D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>') center/14px 14px no-repeat;
    }

    #suivi-rec .sr-b-w {
        background: var(--warn-bg);
        color: var(--warn);
        border: 1px solid var(--warn-b)
    }

    #suivi-rec .sr-b-ko {
        background: var(--ko-bg);
        color: var(--ko);
        border: 1px solid var(--ko-b)
    }

    /* Actions */
    #suivi-rec .sr-actions {
        position: relative;
        text-align: center;
        white-space: nowrap;
    }

    #suivi-rec .sr-dots {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        font-size: 22px;
        line-height: 26px;
    }

    #suivi-rec .sr-dots:hover {
        background: #f7f6f1;
        border-color: #e8e3cf;
    }

    #suivi-rec .sr-menu {
        position: absolute;
        top: 30px;
        right: 0;
        background: #fff;
        border: 1px solid #E6E4D8;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
        display: none;
        min-width: 180px;
        padding: 6px;
        z-index: 10;
    }

    #suivi-rec .sr-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 8px;
        text-decoration: none;
        color: #2A2916;
        font-weight: 500;
        font-size: 14px;
    }

    #suivi-rec .sr-menu a:hover {
        background: #F7F6F2;
    }

    /* Custom pagination styles removed - using unified pagination.php component */

    /* ===== Sidebar commun ===== */
    #suivi-rec .sr-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .35);
        opacity: 0;
        pointer-events: none;
        transition: .2s;
        z-index: 9998
    }

    #suivi-rec .sr-overlay.open {
        opacity: 1;
        pointer-events: auto
    }

    #suivi-rec .sr-sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 450px;
        height: 100vh;
        background: #FFFFFF;
        box-shadow: -7px 0px 36px #00000029;
        transform: translateX(110%);
        transition: .25s;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        border-radius: 0;
    }

    #suivi-rec .sr-sidebar.open {
        transform: translateX(0)
    }

    #suivi-rec .sr-sb-head {
        height: 60px;
        background: #FFFFFF;
        box-shadow: 0px 5px 16px #00000029;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
    }

    #suivi-rec .sr-sb-title {
        font-weight: 700;
        font-size: 18px/24px;
        color: #2A2916;
    }

    #suivi-rec .sr-sb-close {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background: #BF0404 url('/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-close.png') center/14px 14px no-repeat;
    }

    #suivi-rec .sr-sb-body {
        padding: 16px 18px;
        overflow: auto;
        flex: 1;
    }

    #suivi-rec .sr-sb-h2 {


        font-weight: 700;
        font-size: 14px/20px;
        color: #2A2916;
        margin: 14px 0 10px;
    }

    #suivi-rec .sr-hr {
        border: 0;
        border-top: 1px solid #ECEBE3;
        width: 390px;
        margin: 14px auto;
    }

    #suivi-rec .sr-kv {
        display: grid;
        grid-template-columns: 130px 1fr;
        gap: 6px 10px;
        margin: 0 0 6px;
    }

    #suivi-rec .sr-k {
        font-weight: 700;
        font-size: 14px/20px;

        color: #6E6D55;
    }

    #suivi-rec .sr-v {
        font-weight: 400;
        font-size: 14px/20px;

        color: #2A2916;
    }

    #suivi-rec .sr-kv.response .sr-v {
        grid-column: 1 / -1;
        margin-top: 6px;
    }

    #suivi-rec .sr-meta {
        margin-top: 24px;
    }

    #suivi-rec .sr-meta .sr-kv+.sr-kv {
        margin-top: 18px;
    }

    /* Off-canvas réponse (form) */
    #suivi-rec .sr-form .sr-field {
        margin-bottom: 12px
    }

    #suivi-rec .sr-form label {
        display: block;
        font-weight: 700;
        font-size: 14px/20px;

        color: #2A2916;
        margin-bottom: 6px
    }

    #suivi-rec .sr-form select,
    #suivi-rec .sr-form textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #DBD9C3;
        border-radius: 6px;
        padding: 10px;
        background: #fff;

        font-weight: 400;
        font-size: 14px/20px;
    }

    #suivi-rec .sr-form textarea {
        min-height: 120px;
        resize: vertical
    }

    #suivi-rec .sr-form .sr-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 10px
    }

    #suivi-rec .sr-btn-red {
        background: #BF0404;
        color: #fff;
        border: none;
        border-radius: 6px;
        height: 38px;
        padding: 0 14px;

        font-weight: 700;
        font-size: 14px/20px;
        cursor: pointer
    }

    #suivi-rec .sr-btn-ghost {
        background: #fff;
        color: #BF0404;
        border: 2px solid #BF0404;
        border-radius: 6px;
        height: 38px;
        padding: 0 14px;
        font-weight: 700;
        font-size: 14px/20px;
        cursor: pointer
    }

    @media (max-width: 980px) {
        #suivi-rec col.c3 {
            width: 18%
        }

        #suivi-rec col.c4 {
            width: 34%
        }
    }
    </style>

    <div class="sr-card">
        <div class="sr-head">
            <img class="sr-ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/entrevue.png" alt="">
            <h2 class="sr-title">Suivi des réclamations</h2>
        </div>
        <hr class="sr-title-sep">

        <div class="sr-toolbar">
            <label class="sr-search">
                <input id="sr-q" type="text" placeholder="Recherche">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a"
                        stroke-width="2" stroke-linecap="round" />
                </svg>
            </label>

            <div style="margin-left:auto;display:flex;gap:10px">
                <a class="sr-btn-primary" id="sr-add-btn" href="<?php echo esc_url($reclamations_url); ?>"
                    target="_self">
                    Envoyer une réclamation
                </a>
                <button class="sr-btn-square" type="button" title="Enregistrer / Export">
                    <img src="/wp-content/plugins/plateforme-master/images/icon etudiant/upload-red.png" alt="Upload"
                        style="width:18px;height:18px;">
                </button>
            </div>
        </div>

        <!-- ===== HEAD ===== -->
        <div class="sr-table-wrap head-box">
            <table class="sr-table-head" aria-hidden="true">
                <colgroup>
                    <col class="c1">
                    <col class="c2">
                    <col class="c3">
                    <col class="c4">
                    <col class="c5">
                    <col class="c6">
                    <col class="c7">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center"><input type="checkbox" id="sr-ckall"></th>
                        <th scope="col">Référence</th>
                        <th scope="col">Type</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut</th>
                        <th scope="col" style="text-align:right">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- ===== BODY ===== -->
        <div class="sr-table-wrap body-box">
            <table class="sr-table-body" id="sr-table" aria-describedby="liste réclamations">
                <colgroup>
                    <col class="c1">
                    <col class="c2">
                    <col class="c3">
                    <col class="c4">
                    <col class="c5">
                    <col class="c6">
                    <col class="c7">
                </colgroup>
                <tbody id="sr-tbody">
                    <!-- lignes injectées en JS -->
                </tbody>
            </table>
        </div>

        <!-- Include Reusable Pagination Component -->
        <?php include 'pagination.php'; ?>
    </div>

    <!-- Overlay -->
    <div class="sr-overlay" id="sr-ov"></div>

    <!-- ===== Sidebar DÉTAIL ===== -->
    <aside class="sr-sidebar" id="sr-sb-view">
        <div class="sr-sb-head">
            <div class="sr-sb-title" id="sr-sb-title">Réclamation</div>
            <button type="button" class="sr-sb-close" data-close="view" aria-label="Fermer"></button>
        </div>
        <div class="sr-sb-body" id="sr-sb-body">
            <!-- rempli en JS -->
        </div>
    </aside>

    <!-- ===== Sidebar RÉPONSE ===== -->
    <aside class="sr-sidebar" id="sr-sb-rep">
        <div class="sr-sb-head">
            <div class="sr-sb-title" id="sr-sb-rep-title">Ajouter une réponse</div>
            <!-- AVANT: <button type="button" class="sr-sb-close" data-close="rep" aria-label="Fermer"></button> -->
            <!-- APRES: bouton qui soumet le formulaire sr-rep-form -->
            <button type="submit" class="sr-sb-save" form="sr-rep-form">Enregistrer</button>
        </div>

        <div class="sr-sb-body">
            <form class="sr-form" id="sr-rep-form">
                <div class="sr-field">
                    <label for="sr-rep-statut">Statut</label>
                    <select id="sr-rep-statut">
                        <option value="En attente">En attente</option>
                        <option value="Accepté">Accepté</option>
                        <option value="Refusé">Refusé</option>
                    </select>
                </div>
                <div class="sr-field">
                    <label for="sr-rep-msg">Réponse</label>
                    <textarea id="sr-rep-msg" placeholder="Votre réponse..."></textarea>
                </div>
                <!-- <div class="sr-actions">
                    <button type="button" class="sr-btn-ghost" data-close="rep">Annuler</button>
                    <button type="submit" class="sr-btn-red">Enregistrer</button>
                </div> -->
            </form>
        </div>
    </aside>

    <?php if (is_user_logged_in()):
        $u = wp_get_current_user();
    ?>
    <script>
    window.pmsettings = {
        rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
        nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>,
        user_id: <?php echo (int) get_current_user_id(); ?>,
        roles: <?php echo json_encode($u->roles); ?>
    };
    </script>
    <?php else: ?>
    <p>Vous devez être connecté pour accéder aux réclamations.</p>
    <?php endif; ?>

    <script>
    (function() {
        const root = document.getElementById('suivi-rec');
        const q = root.querySelector('#sr-q');
        const tbody = root.querySelector('#sr-tbody');
        const ov = root.querySelector('#sr-ov');
        const sbV = root.querySelector('#sr-sb-view');
        const sbR = root.querySelector('#sr-sb-rep');
        const sbVTitle = root.querySelector('#sr-sb-title');
        const sbVBody = root.querySelector('#sr-sb-body');
        const repForm = root.querySelector('#sr-rep-form');
        const repStat = root.querySelector('#sr-rep-statut');
        const repMsg = root.querySelector('#sr-rep-msg');
        // pageNumContainer removed - using unified pagination
        const addBtn = root.querySelector('#sr-add-btn');
        const ckAll = root.querySelector('#sr-ckall');

        // Unified pagination elements
        const btnFirst = document.getElementById('firstPageBtn');
        const btnPrev = document.getElementById('prevPageBtn');
        const btnNext = document.getElementById('nextPageBtn');
        const btnLast = document.getElementById('lastPageBtn');
        const currentPage = document.getElementById('currentPageNumber');

        const LIST_API = "<?php echo esc_url(rest_url('plateforme/v1/reclamations')); ?>";
        const PUT_REP = (id) => "<?php echo esc_url(rest_url('plateforme/v1/reclamations')); ?>" + "/" + id +
            "/reponse";
        const NONCE = "<?php echo esc_attr(wp_create_nonce('wp_rest')); ?>";
        const CURRENT_USER = (window.pmsettings && +pmsettings.user_id) || 0;
        const ROLES = (window.pmsettings && pmsettings.roles) || [];

        // Define roles that can reply
        const canReply = () => {
            const adminRoles = ['um_service-utm', 'um_service-etablissement', 'um_directeur_laboratoire',
                'um_coordonnateur-master'
            ];
            if (!ROLES || ROLES.length === 0) return false;
            return ROLES.some(role => adminRoles.includes(role));
        };

        // Cacher le bouton "Envoyer" pour service UTM
        if (ROLES.includes('um_service-utm')) {
            if (addBtn) addBtn.style.display = 'none';
        }

        const badgeHtml = (statut) => {
            if (statut === 'Accepté') return '<span class="sr-badge sr-b-ok">Acceptée</span>';
            if (statut === 'Refusé') return '<span class="sr-badge sr-b-ko">Refusée</span>';
            return '<span class="sr-badge sr-b-w">En attente</span>';
        };

        // Rendu d'une ligne (menu conditionnel)
        function row(d, i) {
            const canUserReply = canReply();

            const menuView =
                `<a href="#" data-act="view" data-i="${i}"><i class="fa-regular fa-file"></i> Voir</a>`;
            const menuReply =
                `<a href="#" data-act="reply" data-i="${i}"><i class="fa-regular fa-envelope"></i> Ajouter une réponse</a>`;
            const menuEmail =
                `<a href="#" data-act="email" data-i="${i}"><i class="fa-regular fa-envelope"></i> E-mail</a>`;

            // Menu logic based on user role
            // Admin users can always reply. Regular users see an email link.
            const menuActions = canUserReply ? menuReply : menuEmail;

            return `
        <tr data-i="${i}">
          <td style="text-align:center"><input type="checkbox" class="sr-cb-row"></td>
          <td class="ref"><a href="#" class="sr-ref" data-i="${i}">${d.ref || '—'}</a></td>
          <td>${d.type || '—'}</td>
          <td>${d.sujet || '—'}</td>
          <td>${d.date || '—'}</td>
          <td>${badgeHtml(d.statut_reponse || 'En attente')}</td>
          <td class="sr-actions">
            <button class="sr-dots" type="button" aria-haspopup="true" aria-expanded="false" title="Actions">⋯</button>
            <div class="sr-menu" role="menu">
              ${menuView}
              ${menuActions}
            </div>
          </td>
        </tr>`;
        }

        function draw(list) {
            if (list && list.length > 0) {
                tbody.innerHTML = list.map(row).join('');
                bindRowEvents();
            } else {
                const colCount = root.querySelectorAll('.sr-table-head colgroup col').length || 7;
                tbody.innerHTML =
                    `<tr><td colspan="${colCount}" style="text-align: center; padding: 40px 10px; color: #6E6D55;">Aucune réclamation trouvée.</td></tr>`;
            }
        }

        let DATA = [];
        let PAGE = 1;
        const PER = 5;
        let CURRENT_INDEX = -1;
        let PAGINATION_INFO = {};

        async function load({
            search = '',
            page = 1
        } = {}) {
            PAGE = page;
            const url = new URL(LIST_API);
            url.searchParams.set('page', page);
            url.searchParams.set('per_page', PER);
            if (search) url.searchParams.set('search', search);

            const res = await fetch(url.toString(), {
                headers: {
                    'X-WP-Nonce': NONCE
                },
                credentials: 'same-origin'
            });
            const json = await res.json().catch(() => ({
                data: [],
                pagination: {}
            }));
            DATA = (json && json.data) ? json.data.map(normalizeItem) : [];
            PAGINATION_INFO = json.pagination || {};
            draw(DATA);
            updatePager();
        }

        function updatePager() {
            const totalPages = PAGINATION_INFO.pages || 1;

            // Update current page number
            if (currentPage) {
                currentPage.textContent = PAGE;
            }

            // Update button states
            const isFirstPage = PAGE === 1;
            const isLastPage = PAGE >= totalPages;

            if (btnFirst) {
                btnFirst.disabled = isFirstPage;
                btnFirst.classList.toggle('disabled', isFirstPage);
            }
            if (btnPrev) {
                btnPrev.disabled = isFirstPage;
                btnPrev.classList.toggle('disabled', isFirstPage);
            }
            if (btnNext) {
                btnNext.disabled = isLastPage;
                btnNext.classList.toggle('disabled', isLastPage);
            }
            if (btnLast) {
                btnLast.disabled = isLastPage;
                btnLast.classList.toggle('disabled', isLastPage);
            }

            // Hide pagination if only one page
            const paginationContainer = document.getElementById('customPagination');
            if (paginationContainer) {
                paginationContainer.style.display = totalPages <= 1 ? 'none' : 'flex';
            }
        }

        function setupPagerEvents() {
            if (btnFirst) {
                btnFirst.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (PAGE > 1) {
                        load({
                            page: 1,
                            search: q.value.trim()
                        });
                    }
                });
            }

            if (btnPrev) {
                btnPrev.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (PAGE > 1) {
                        load({
                            page: PAGE - 1,
                            search: q.value.trim()
                        });
                    }
                });
            }

            if (btnNext) {
                btnNext.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (PAGE < PAGINATION_INFO.pages) {
                        load({
                            page: PAGE + 1,
                            search: q.value.trim()
                        });
                    }
                });
            }

            if (btnLast) {
                btnLast.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (PAGE < PAGINATION_INFO.pages) {
                        load({
                            page: PAGINATION_INFO.pages,
                            search: q.value.trim()
                        });
                    }
                });
            }
        }

        function normalizeItem(r) {
            // L'API renvoie déjà owner_user_id + statut/message de réponse
            return {
                id: r.id,
                owner_user_id: r.owner_user_id,
                ref: r.ref,
                type: r.type,
                sujet: r.sujet,
                date: r.date,
                pj: r.pj || {
                    name: '—',
                    url: ''
                },
                statut_reponse: r.statut_reponse || 'En attente',
                message_reponse: r.message_reponse || '',
                reponse_user_id: r.reponse_user_id || null,
                reponse_date: r.reponse_date || null,
            };
        }

        function openOverlay() {
            ov.classList.add('open');
        }

        function closeOverlay() {
            ov.classList.remove('open');
            closeSidebars();
        }

        function closeSidebars() {
            sbV.classList.remove('open');
            sbR.classList.remove('open');
        }

        // DÉTAIL
        function openDetail(i) {
            const d = DATA[i];
            if (!d) return;
            CURRENT_INDEX = i;
            sbVTitle.textContent = `Réclamation ${d.ref || ''}`;

            const pj = d?.pj?.url ?
                `<a href="${d.pj.url}" target="_blank" rel="noopener">${d.pj.name || 'Pièce jointe'}</a>` :
                (d?.pj?.name || '—');

            sbVBody.innerHTML = `
        <div class="sr-sb-h2">Détails de la réclamation</div>
        <div class="sr-kv"><div class="sr-k">Type :</div><div class="sr-v">${d.type || '—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Sujet :</div><div class="sr-v">${d.sujet || '—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Date :</div><div class="sr-v">${d.date || '—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Statut :</div><div class="sr-v">${badgeHtml(d.statut_reponse)}</div></div>
        <div class="sr-kv"><div class="sr-k">Pièce jointe :</div><div class="sr-v">${pj}</div></div>

        <hr class="sr-hr">

        <div class="sr-sb-h2">Réponse</div>
        <div class="sr-kv response">
          <div class="sr-k">Message :</div>
          <div class="sr-v">${d.message_reponse ? d.message_reponse : '—'}</div>
        </div>
        <div class="sr-meta">
          <div class="sr-kv"><div class="sr-k">Date de réponse :</div><div class="sr-v">${d.reponse_date || '—'}</div></div>
          <div class="sr-kv"><div class="sr-k">Répondant :</div><div class="sr-v">${d.reponse_user_id ? ('#' + d.reponse_user_id) : '—'}</div></div>
        </div>
      `;
            openOverlay();
            sbV.classList.add('open');
        }

        // RÉPONSE (formulaire)
        function openReply(i) {
            const d = DATA[i];
            if (!d) return;
            CURRENT_INDEX = i;
            root.querySelector('#sr-sb-rep-title').textContent = `Ajouter une réponse — ${d.ref || ''}`;
            repStat.value = d.statut_reponse || 'En attente';
            repMsg.value = d.message_reponse || '';
            openOverlay();
            sbR.classList.add('open');
        }

        // Envoi réponse
        repForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const i = CURRENT_INDEX;
            const d = DATA[i];
            if (!d) return;

            const payload = {
                statut_reponse: repStat.value || 'En attente',
                message_reponse: repMsg.value || ''
            };

            const res = await fetch(PUT_REP(d.id), {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': NONCE
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });

            const out = await res.json().catch(() => null);
            if (!res.ok) {
                alert(out && out.message ? out.message : 'Erreur lors de l’enregistrement.');
                return;
            }

            // Mettre à jour la ligne localement
            DATA[i].statut_reponse = payload.statut_reponse;
            DATA[i].message_reponse = payload.message_reponse;
            DATA[i].reponse_user_id = (window.pmsettings && +pmsettings.user_id) || null;
            DATA[i].reponse_date = (new Date()).toLocaleString();

            draw(DATA); // rerender table
            closeOverlay();
            // ouvrir le détail pour visualiser
            openDetail(i);
        });

        // Bind interactions par ligne
        function bindRowEvents() {
            // ref click
            root.querySelectorAll('.sr-ref').forEach(a => {
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    root.querySelectorAll('.sr-ref').forEach(x => x.classList.remove('active'));
                    a.classList.add('active');
                    openDetail(Number(a.dataset.i));
                });
            });

            // bouton ⋯
            root.querySelectorAll('.sr-dots').forEach(btn => {
                btn.addEventListener('click', e => {
                    const menu = btn.nextElementSibling;
                    // ferme autres
                    root.querySelectorAll('.sr-menu').forEach(m => {
                        if (m !== menu) m.style.display = 'none';
                    });
                    const open = menu.style.display === 'block';
                    menu.style.display = open ? 'none' : 'block';
                    btn.setAttribute('aria-expanded', String(!open));
                    e.stopPropagation();
                });
            });

            // liens menu
            root.querySelectorAll('.sr-menu a').forEach(a => {
                a.addEventListener('click', e => {
                    e.preventDefault();
                    const i = Number(a.dataset.i);
                    if (a.dataset.act === 'view') openDetail(i);
                    if (a.dataset.act === 'reply') openReply(i);
                    // (option email à intégrer selon ton besoin)
                });
            });

            // Checkbox logic
            const rowCheckboxes = root.querySelectorAll('.sr-cb-row');
            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    if (!cb.checked) {
                        ckAll.checked = false;
                    } else {
                        const allChecked = root.querySelectorAll('.sr-cb-row:not(:checked)')
                            .length === 0;
                        ckAll.checked = allChecked;
                    }
                });
            });
        }

        // Fermer menus au clic extérieur ou ESC
        function closeAllMenus() {
            root.querySelectorAll('.sr-menu').forEach(m => m.style.display = 'none');
            root.querySelectorAll('.sr-dots[aria-expanded="true"]').forEach(b => b.setAttribute('aria-expanded',
                'false'));
        }
        document.addEventListener('click', (e) => {
            if (e.target.closest('#suivi-rec .sr-menu') || e.target.closest('#suivi-rec .sr-dots')) return;
            closeAllMenus();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAllMenus();
        });

        // Recherche (serveur)
        q.addEventListener('input', () => load({
            search: q.value.trim(),
            page: 1
        }));

        // Fermer sidebars
        ov.addEventListener('click', closeOverlay);
        root.querySelectorAll('.sr-sb-close,[data-close]').forEach(b => {
            b.addEventListener('click', closeOverlay);
        });

        // Check all logic
        ckAll.addEventListener('change', () => {
            root.querySelectorAll('.sr-cb-row').forEach(cb => {
                cb.checked = ckAll.checked;
            });
        });

        // Initialisation
        setupPagerEvents();
        load();
    })();
    </script>
</section>