<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Absences – Mes absences</title>
  <style>
    :root {
      --brand: #c5161d;
      --ink: #2A2916;
      --olive: #A6A485;
      --danger: #BF0404;
      --edge: #ECEBE3;
      --line: #EBE9D7;
      --ok: #0E962D;
      --ok-bg: rgba(14,150,45,.1);
      --warn: #9A7A01;
      --warn-bg: #FFF5D6;
      --warn-b: #F0DF9C;
      --ko: #B10202;
      --ko-bg: #FFE8E8;
      --ko-b: #F5B6B6;
      --text: #1a1a1a;
      --thead: #EEEFE6;
      --thead-b: #E3E3D4;
      --row-b: #F0F0EE;
    }

    body {
      background: #fafafa;
      color: var(--text);
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
    }

    .abs-card {
      background: #fff;
      border: 1px solid #e8e9ea;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,.06);
      padding: .8rem;
      margin: 10px 10px 0 20px;
      position: relative;
      height: 586px;
    }

    /* Titre */
    .abs-title {
      display: flex;
      align-items: center;
      gap: .5rem;
      font-weight: 700;
      padding: .35rem .25rem .65rem;
    }
    .abs-title .emoji img {
      width: 34px;
      height: 34px;
      object-fit: contain;
    }

    /* Barre de recherche */
    .abs-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: .6rem;
      align-items: center;
      padding: .6rem;
      background: #fff;
      border-radius: .6rem;
      margin-bottom: .7rem;
    }
    .abs-search {
      width: 255px;
      height: 35px;
      position: relative;
      background: #fff;
      border: 1px solid #DBD9C3;
      border-radius: 6px;
    }
    .abs-search input {
      width: 100%;
      height: 100%;
      border: 0;
      outline: 0;
      background: transparent;
      padding: 0 36px 0 14px;
      font: 400 14px/17px Roboto;
      color: var(--ink);
    }
    .abs-search input::placeholder {
      color: #A6A59F;
      text-transform: capitalize;
    }
    .abs-search svg {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
    }
    .abs-nb input {
      text-align: center;
      width: 100%;
      height: 35px;
      border: 1px solid #DBD9C3;
      border-radius: 6px;
      padding: 0 14px;
      font: 400 14px/17px Roboto;
      color: var(--ink);
    }
    .abs-nb input::placeholder {
      color: #A6A59F;
      text-transform: capitalize;
    }

    /* Ligne horizontale sous la barre de recherche */
    .abs-divider {
      border-top: 1px solid var(--line);
      margin: 0.5rem 0;
    }

    /* Centre la 2e colonne du body + la 4e (bouton) */
    .abs-tbody .abs-row .abs-cell:nth-child(2){ text-align: center; }
    .abs-tbody .abs-row .abs-cell:nth-child(4){ text-align: center; }

    /* Décale "Enseignant" (head) un peu à droite et "Bilan" légèrement aussi */
    .abs-thead .abs-th:nth-child(3){ margin-left: 22px; }
    .abs-thead .abs-th:nth-child(4){ margin-left: 22px; }

    /* Décale le texte des enseignants (body) vers la droite (sans bouger la case) */
    .abs-row .abs-cell:nth-child(3){ padding-left: 44px; }

    /* ===== Table alignée thead/body + séparateurs continus + responsive ===== */
    .abs-table{
      --c1: 4fr;   /* Matière */
      --c2: 2fr;   /* Nb d'absences */
      --c3: 3fr;   /* Enseignant */
      --c4: 1fr;   /* Bilan */

      /* Positions des séparateurs (entre c1|c2, c2|c3, c3|c4) */
      --split1: 40%;  /* 4 / 10 */
      --split2: 60%;  /* 6 / 10 */
      --split3: 90%;  /* 9 / 10 */

      overflow-x: auto;
    }

    /* HEAD */
    .abs-thead{
      display:grid;
      grid-template-columns: var(--c1) var(--c2) var(--c3) var(--c4);
      align-items:center;
      min-height:45px;
      background:#ECEBE3;
      border:1px solid rgba(166,164,133,.24);
      border-radius:8px;
      padding:0 8px;
      width:100%;
      min-width:720px;
    }
    .abs-th{
      font:700 15px/20px Roboto;
      color:var(--ink);
      padding:0 10px;
      white-space:nowrap;
    }
    .abs-thead > .abs-th:nth-child(n+2){ border-left:1px solid var(--edge); }

    /* BODY */
    .abs-tbody{
      position:relative;
      border:2px solid var(--line);
      border-radius:8px;
      background:#fff;
      margin-top:8px;
      overflow:hidden;
      width:100%;
      min-width:720px;
    }

    /* Plus de bordures verticales par cellule (évite les “cassures”) */
    .abs-row > .abs-cell:nth-child(n+2){ border-left: none; }

    /* Traits verticaux continus sur tout le body (3 lignes d’un seul tenant) */
    .abs-tbody::after{
      content:"";
      position:absolute;
      inset:0;
      pointer-events:none;
      z-index:1;
      background-image:
        linear-gradient(to bottom, var(--edge), var(--edge)),
        linear-gradient(to bottom, var(--edge), var(--edge)),
        linear-gradient(to bottom, var(--edge), var(--edge));
      background-repeat:no-repeat;
      background-size:1px 100%;
      background-position: var(--split1) 0, var(--split2) 0, var(--split3) 0;
    }

    .abs-row{
      display:grid;
      grid-template-columns: var(--c1) var(--c2) var(--c3) var(--c4);
      align-items:center;
      min-height:48px;
    }
    .abs-row + .abs-row{ border-top:1px solid var(--edge); }
    .abs-cell{ padding:12px 10px; font:400 14px/17px Roboto; color:var(--ink); }

    /* ligne d’alerte */
    .abs-row-warn{ background:#f7d9d9 !important; }

    /* Bouton œil */
    .btn-eye{
      width:32px;height:32px;
      display:inline-flex;align-items:center;justify-content:center;
      border:1px solid #e6e6e6;background:#fff;border-radius:.5rem;
      box-shadow:0 1px 6px rgba(0,0,0,.06);color:#2b2b2b;
    }
    .btn-eye img{ width:16px;height:16px;object-fit:contain; }
    .btn-eye:hover{ transform:translateY(-1px); box-shadow:0 10px 18px rgba(0,0,0,.12); }

    /* Badge élimination */
    .badge-pill{ border-radius:999px; padding:.25rem .6rem; font-weight:700; font-size:.8rem; width: 110px;}
    .badge-danger-soft{ background:#EAABAB4D ; color:#b42318; border:1px solid #f7b4b4; text-align: center; }

    /* Pagination */
    .abs-pager{
      position:absolute;
      right:16px;
      width:170px;height:27px;
      display:flex;align-items:center;gap:12px;margin-top:18px;
    }
    .abs-btn{
      width:27px;height:27px;border:1px solid var(--danger);border-radius:3px;background:#fff;
      display:inline-flex;align-items:center;justify-content:center;cursor:pointer;box-sizing:border-box;
      font-weight:600;color:var(--danger);line-height:1;font-size:22px;padding:0;
    }
    .abs-num{ min-width:20px; text-align:center; font-family:'Signika', system-ui, sans-serif; font-size:14px; color:#010103; }

    /* Offcanvas (panneau droit) */
    .offcanvas-abs{ width: min(520px, 100vw); }
    .offcanvas-abs .oc-head{
      display:flex;justify-content:space-between;align-items:center;
      padding:.8rem 1rem;border-bottom:1px solid #ddd;box-shadow:0 2px 4px rgba(0,0,0,.08);
      background:#FFFFFF;color:#fff;
    }
    .offcanvas-abs .oc-title{width: 130px;
height: 22px;
text-align: left;
font: normal normal bold 18px/22px Roboto;
letter-spacing: 0px;
color: #2A2916;
opacity: 1; }
    .offcanvas-abs .btn-close{
      background-color:var(--brand); border-radius:8px; width:28px; height:28px; padding:0; opacity:1; color:#fff;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath stroke='%23ffffff' stroke-linecap='round' stroke-width='2' d='M2 2l12 12M14 2 2 14'/%3E%3C/svg%3E");
      background-repeat:no-repeat; background-position:center; background-size:1em 1em;
    }

    /* Métadonnées haut du panneau */
    .oc-meta{
      display:grid; grid-template-columns:auto 1fr; gap:.35rem 1rem;
      padding:.6rem 1rem; font-size:.95rem;
    }
    .oc-meta .lbl{ margin-top: 14px; 
left: 939px;
width: 54px;
height: 17px;
text-align: left;
font: normal normal normal 14px/17px Roboto;
letter-spacing: 0px; font-size:14px;
color: #A6A485;
opacity: 1; }
    .oc-meta .value{ 
margin-left: 20px;
margin-top: 12px;
font-size:2px;

text-align: left;
font: normal normal bold 16px/21px Roboto;
letter-spacing: 0px;
color: #2A2916;
opacity: 1; }
    #ocMatiere{ font-size:14px; color:#222; margin-top:10px }
    #ocCount{ font-size:14px; }

   /* Tableau dans l’offcanvas : hauteur auto */
.oc-table{
  width: auto;
  margin: 0 auto 1rem;
  border-collapse: separate;
  border-spacing: 0;
  background: #FFFFFF;
  border: 2px solid var(--edge);
  border-radius: 7px;
  overflow: hidden;      /* garde les angles arrondis si ça scrolle plus tard */
  height: auto;          /* <-- plus de hauteur fixe */
}
.oc-table thead th{
  background: var(--thead);
  font-weight: 700;
  padding: .55rem .7rem;
  border-top: none;
  border-bottom: 1px solid var(--thead-b);
}
.oc-table tbody td{
  padding: .55rem .7rem;
  border-bottom: 1px solid var(--row-b);
}


    #absenceDetails .oc-meta .value{
  display:flex;
  align-items:center;
  gap: 116px;         /* espace entre le nombre et le badge */
}
/* Offcanvas : descendre un peu la valeur du nombre */
#absenceDetails #ocCount{
  position: relative;
  top: 6px;   /* ajuste 2–6px selon ton rendu */
}

/* Offcanvas : garder "Nombre d'absence:" sur une seule ligne */
#absenceDetails .oc-meta{
  grid-template-columns: max-content 1fr; /* la colonne libellé prend la largeur de son texte */
}
#absenceDetails .oc-meta .lbl{
  white-space: nowrap;  margin-top: 24px                    /* pas de retour à la ligne */
}

#absenceDetails #ocCount{
  margin-left: 42px;   /* espace après le libellé */
}
.offcanvas-backdrop,
  .offcanvas-backdrop.show { z-index: 100000 !important; }

  #absenceDetails.offcanvas { z-index: 100001 !important; }
  </style>
</head>

<body>
  <div id="app">
    <div class=" py-3">
      <div class="abs-card">
        <div class="abs-title">
          <span class="emoji"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/5038546.png" alt="Icon"></span>
          <span>Mes absences</span>
        </div>

        <div class="abs-divider"></div>

        <div class="abs-toolbar">
          <label class="abs-search">
            <input id="searchText" type="text" placeholder="Recherche...">
            <svg viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a" stroke-width="2" stroke-linecap="round"/></svg>
          </label>
          <div class="abs-nb">
            <input type="number" id="searchCount" placeholder="Nombre d'absences" min="0">
          </div>
        </div>

        <!-- TABLE ALIGNÉE -->
        <div class="abs-table">
          <div class="abs-thead">
            <div class="abs-th">Matière</div>
            <div class="abs-th">Nombre d'absences</div>
            <div class="abs-th">Enseignant</div>
            <div class="abs-th">Bilan</div>
          </div>

          <div class="abs-tbody" id="absTable">
            <div class="abs-row" data-matiere="Apprentissage Automatique (Machine Learning)" data-enseignant="Samia Fekih" data-count="1">
              <div class="abs-cell">Apprentissage Automatique (Machine Learning)</div>
              <div class="abs-cell">1</div>
              <div class="abs-cell">Samia Fekih</div>
              <div class="abs-cell"><button class="btn-eye" title="Voir"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/27) Icon-eye.png" alt="Voir"></button></div>
            </div>

            <div class="abs-row" data-matiere="Vision par Ordinateur (Computer Vision)" data-enseignant="Ahlem Mrad" data-count="2">
              <div class="abs-cell">Vision par Ordinateur (Computer Vision)</div>
              <div class="abs-cell">2</div>
              <div class="abs-cell">Ahlem Mrad</div>
              <div class="abs-cell"><button class="btn-eye" title="Voir"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/27) Icon-eye.png" alt="Voir"></button></div>
            </div>

            <div class="abs-row" data-matiere="Big Data Et Analyse Des Données" data-enseignant="Samir Ben Ahmed" data-count="2">
              <div class="abs-cell">Big Data Et Analyse Des Données</div>
              <div class="abs-cell">2</div>
              <div class="abs-cell">Samir Ben Ahmed</div>
              <div class="abs-cell"><button class="btn-eye" title="Voir"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/27) Icon-eye.png" alt="Voir"></button></div>
            </div>

            <div class="abs-row abs-row-warn" data-matiere="Robotics Et Systèmes Autonomes" data-enseignant="Moncef Aloui" data-count="4">
              <div class="abs-cell">Robotics Et Systèmes Autonomes</div>
              <div class="abs-cell">4</div>
              <div class="abs-cell">Moncef Aloui</div>
              <div class="abs-cell"><button class="btn-eye" title="Voir"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/27) Icon-eye.png" alt="Voir"></button></div>
            </div>

            <div class="abs-row" data-matiere="Exploration De Données (Data Mining)" data-enseignant="Mourad Bouzid" data-count="1">
              <div class="abs-cell">Exploration De Données (Data Mining)</div>
              <div class="abs-cell">1</div>
              <div class="abs-cell">Mourad Bouzid</div>
              <div class="abs-cell"><button class="btn-eye" title="Voir"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/27) Icon-eye.png" alt="Voir"></button></div>
            </div>
          </div>
        </div>

        <div class="abs-pager">
          <button class="abs-btn" title="Première page">&laquo;</button>
          <button class="abs-btn" title="Précédent">&lsaquo;</button>
          <span class="abs-num">2</span>
          <button class="abs-btn" title="Suivant">&rsaquo;</button>
          <button class="abs-btn" title="Dernière page">&raquo;</button>
        </div>
      </div>
    </div>

    <!-- Offcanvas "Bilan d'absence" -->
    <div class="offcanvas offcanvas-end offcanvas-abs" tabindex="-1" id="absenceDetails" aria-labelledby="absenceDetailsLabel">
      <div class="oc-head">
        <div class="oc-title" id="absenceDetailsLabel">Bilan d'absence</div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
      </div>

      <div class="oc-meta">
        <div class="lbl">Matière:</div>
        <div class="value"><span id="ocMatiere" class="fw-semibold">—</span></div>
        <div class="lbl">Nombre d'absence:</div>
        <div class="value"><span id="ocCount" class="fw-semibold">0</span> <span id="ocBadge" class="badge-pill "></span></div>
      </div>

      <div class="pt-2">
        <table class="oc-table">
          <thead>
            <tr><th style="width:40%">Date d'absence</th><th style="width:30%">Séance</th><th style="width:30%">Type</th></tr>
          </thead>
          <tbody id="ocRows"></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (pour l’offcanvas) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // --- Filtres ---
    const searchText = document.getElementById('searchText');
    const searchCount = document.getElementById('searchCount');
    const rows = Array.from(document.querySelectorAll('#absTable .abs-row'));

    function applyFilter() {
      const q = (searchText.value || '').trim().toLowerCase();
      const n = searchCount.value !== '' ? Number(searchCount.value) : null;
      rows.forEach(tr => {
        const mat = (tr.dataset.matiere || '').toLowerCase();
        const nb = Number(tr.dataset.count || 0);
        const okTxt = !q || mat.includes(q);
        const okNb = (n === null) || nb === n;
        tr.style.display = (okTxt && okNb) ? '' : 'none';
      });
    }
    searchText.addEventListener('input', applyFilter);
    searchCount.addEventListener('input', applyFilter);

    // --- Données détail ---
    const ABS_DETAILS = {
      "Robotics Et Systèmes Autonomes": [
        ["13-01-2025", "S1", "T.P"], ["19-01-2025", "S2", "T.P"],
        ["02-02-2025", "S1", "T.D"], ["03-02-2025", "S1", "Cours"]
      ],
      "Apprentissage Automatique (Machine Learning)": [["10-02-2025", "S2", "Cours"]],
      "Vision par Ordinateur (Computer Vision)": [["12-02-2025", "S1", "Cours"], ["26-02-2025", "S1", "T.D"]],
      "Big Data Et Analyse Des Données": [["08-02-2025", "S2", "T.P"], ["22-02-2025", "S2", "Cours"]],
      "Exploration De Données (Data Mining)": [["05-02-2025", "S1", "Cours"]]
    };

    // --- Offcanvas ---
    const ocEl = document.getElementById('absenceDetails');
    const offcanvas = new bootstrap.Offcanvas(ocEl);

    function openDetails(tr) {
      const mat = tr.dataset.matiere;
      const count = Number(tr.dataset.count || 0);
      const list = ABS_DETAILS[mat] || [];

      document.getElementById('ocMatiere').textContent = mat;
      document.getElementById('ocCount').textContent = count.toString();

      const badge = document.getElementById('ocBadge');
      if (count >= 3) {
        badge.textContent = "Éliminé(e)";
        badge.className = "badge-pill badge-danger-soft ";
      } else {
        badge.textContent = "";
        badge.className = "badge-pill ";
      }

      const tbody = document.getElementById('ocRows');
      tbody.innerHTML = list.length
        ? list.map(([d, s, t]) => `<tr><td>${d}</td><td>${s}</td><td>${t}</td></tr>`).join('')
        : `<tr><td colspan="3" class="text-muted">Aucune donnée</td></tr>`;

      offcanvas.show();
    }

    rows.forEach(tr => {
      const btn = tr.querySelector('.btn-eye');
      btn.addEventListener('click', () => openDetails(tr));
    });
  </script>
</body>
</html>
