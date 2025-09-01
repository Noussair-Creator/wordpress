<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Vue Globale - Tableau Académique</title>
<style>
  /* ========== Reset minimal & palette ========== */
  *{box-sizing:border-box;margin:0;padding:0}
  :root{
    --bg:#f5f5f5;
    --card:#ffffff;
    --edge:#e7e4d7;
    --row:#efeee9;
    --ink:#22221e;
    --muted:#6e6c61;
    --shadow:0 10px 24px rgba(0,0,0,.08);
  }
  body{
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;
    background:var(--bg);
    color:var(--ink);
    padding:20px;
  }

  /* ========== Carte principale ========== */
  .dashboard{
    background:var(--card);
    border:1px solid var(--edge);
    border-radius:12px;
    box-shadow:var(--shadow);
    overflow:hidden;
    max-width:1120px;
    margin:0 auto;
  }
  .header{
    display:flex;align-items:center;gap:10px;
    padding:16px 18px;background:#fff;border-bottom:1px solid #ecebe4;
  }
  .header-icon{
    width:28px;height:28px;border-radius:6px;border:1px solid var(--edge);
    display:grid;place-items:center;box-shadow:0 2px 8px rgba(0,0,0,.05) inset;
  }
  .header h1{font-size:18px;font-weight:800}
  .content{padding:16px}

  /* ========== SECTION 1 (KPI compacte) ========== */
  .kpi-wrap{
    display:grid;
    grid-template-columns:repeat(3, minmax(220px,1fr)) 168px; /* 3 colonnes + colonne boutons */
    gap:16px;
    align-items:stretch;
  }
  .kpi{
    background:#fff;border:1px solid var(--edge);border-radius:12px;
    padding:10px 12px;min-height:74px;
    box-shadow:0 6px 16px rgba(0,0,0,.08);
    display:flex;align-items:center;justify-content:space-between;
  }
  .kpi .label{
    font-size:13px;line-height:1.25;font-weight:800;color:#141512;
  }
  .kpi .value{
    min-width:56px;text-align:center;
    background:var(--row);border:1px solid var(--edge);
    border-radius:10px;padding:8px 10px;font-weight:800;
  }
  /* Bordures gauche demandées */
  .kpi.left-red{border-left:6px solid #c93a3a;}
  .kpi.left-pink{border-left:6px solid #f3c9d8;}

  /* Colonne boutons à droite */
  .status-col{display:flex;flex-direction:column;gap:14px}
  .badge-btn{
    height:44px;border-radius:999px;font-weight:700;cursor:default;
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    border:1px solid;box-shadow:0 3px 10px rgba(0,0,0,.06);
  }
  .badge-btn.green{background:#e9f6ec;border-color:#bfe3c7;color:#0f4220;}
  .badge-btn.yellow{background:#fbf7df;border-color:#efe3a6;color:#5f560b;}

  /* ========== Onglets (pilules) ========== */
  .tabs{display:flex;gap:10px;align-items:flex-end;margin:18px 0 10px}
  .tab{
    flex:1;text-align:center;font-weight:800;
    background:#e7e6db;border:1px solid var(--edge);color:#3a3a2f;
    padding:12px;border-radius:10px;cursor:pointer;
  }
  .tab.active{background:#b3b08a;color:#fff;box-shadow:inset 0 2px 6px rgba(0,0,0,.08)}

  /* ========== SECTION 2 — Accordéons (style capture) ========== */
  .card{
    background:#fff;border:1px solid var(--edge);border-radius:12px;
    box-shadow:var(--shadow);padding:14px;margin-top:8px;
  }
  .ue-group.card{padding:0}
  .ue-item{border-bottom:1px solid var(--edge);background:#fff}
  .ue-item:last-child{border-bottom:none}

  .ue-head{
    padding:12px 16px; display:flex; align-items:center; justify-content:space-between;
    background:#faf9f6; border-top:1px solid var(--edge);
    font-weight:800; color:#4b4a40; cursor:pointer;
  }
  .ue-head:first-of-type{border-top:none}
  .ue-title{font-weight:800}
  .ue-panel{padding:14px 14px 10px; background:#fff;}

  .chev{width:22px;height:22px;border:1px solid var(--edge);border-radius:50%;
        display:grid;place-items:center;background:#fff}
  .rot{transform:rotate(180deg)}

  /* tableau matière conforme capture */
  .subject-head{
    font-weight:800; color:#4b4a3d; margin:12px 0 8px;
  }
  .mark-table{
    width:100%; border-collapse:separate; border-spacing:0; margin:8px 0 12px;
    border:1px solid var(--edge); border-radius:8px; overflow:hidden; background:#fff;
    box-shadow:0 3px 10px rgba(0,0,0,.04) inset;
  }
  .mark-table thead th{
    background:#f7f6f1; color:#5e5c4f; font-weight:800; font-size:.9rem;
    text-align:left; padding:10px 12px; border-bottom:1px solid var(--edge);
  }
  .mark-table tbody td{
    padding:10px 12px; border-bottom:1px solid var(--edge); vertical-align:middle;
  }
  .mark-table tbody tr:last-child td{border-bottom:none}
  .mark-table .cell-right{text-align:right}
  .pill{
    display:inline-block; min-width:56px; text-align:center;
    background:#efeee9; border:1px solid var(--edge); border-radius:10px;
    padding:6px 10px; font-weight:800;
  }

  /* barre de synthèse en bas du 1er UE */
  .summary-row{
    margin-top:8px; display:flex; justify-content:space-between; gap:12px;
    background:#e9e7da; border:1px solid var(--edge); border-radius:8px; padding:10px 12px;
    font-weight:800; color:#3d3c33;
  }

  /* ========== Responsive ========== */
  @media (max-width:980px){
    .kpi-wrap{grid-template-columns:repeat(2, minmax(220px,1fr));}
    .status-col{grid-column:1 / -1;flex-direction:row;justify-content:flex-end}
  }
  @media (max-width:640px){
    .kpi-wrap{grid-template-columns:1fr;}
    .status-col{flex-direction:column;align-items:stretch}
  }
</style>
</head>
<body>

  <div class="dashboard">
    <!-- ===== EN-TÊTE ===== -->
    <div class="header">
      <span class="header-icon" aria-hidden="true">
        <!-- petite icône carnet -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <rect x="5" y="3" width="14" height="18" rx="2" stroke="#7c7a68"/>
          <path d="M9 7h6M9 11h6M9 15h6" stroke="#7c7a68"/>
        </svg>
      </span>
      <h1>Vue Globale</h1>
    </div>

    <!-- ===== CONTENU ===== -->
    <div class="content">

      <!-- ===== SECTION 1 : KPI compacte ===== -->
      <div class="kpi-wrap">
        <!-- Rangée 1 -->
        <div class="kpi left-red">
          <div class="label">Moyenne<br>Semestre 1</div>
          <div class="value">11.78</div>
        </div>

        <div class="kpi left-pink">
          <div class="label">Moyenne<br>Semestre 2</div>
          <div class="value">12.08</div>
        </div>

        <div class="kpi">
          <div class="label">Moyenne Générale</div>
          <div class="value">11.34</div>
        </div>

        <!-- Colonne boutons à droite -->
        <div class="status-col" aria-label="Statuts">
          <div class="badge-btn green">Admis</div>
          <div class="badge-btn yellow">Assez bien</div>
        </div>

        <!-- Rangée 2 -->
        <div class="kpi left-red">
          <div class="label">Crédit Semestre 1</div>
          <div class="value">22</div>
        </div>

        <div class="kpi left-pink">
          <div class="label">Crédit Semestre 2</div>
          <div class="value">15</div>
        </div>

        <div class="kpi">
          <div class="label">Crédit Total</div>
          <div class="value">27</div>
        </div>
      </div>

      <!-- ===== SECTION 2 : Onglets ===== -->
      <div class="tabs">
        <button class="tab">Semestre 1</button>
        <button class="tab active">Semestre 1</button>
      </div>
</div> <!-- /content -->
  </div>
      <!-- ===== SECTION 2 : Accordéons UE ===== -->
      <section class="ue-group card">

        <!-- UE 1 — Ouvert -->
        <div class="ue-item">
          <div class="ue-head" data-target="#ue-1">
            <div class="ue-title">Unité d’enseignement : <span class="muted">Finance internationale et institutions financières</span></div>
            <div class="chev" aria-hidden="true">
              <svg class="rot" width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M6 15l6-6 6 6" stroke="#5d5b4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>

          <div class="ue-panel" id="ue-1" style="display:block">
            <!-- Matière 1 -->
            <div class="subject-head">Matière : <span class="muted">Gestion financière internationale</span> &nbsp; Cr : 2 &nbsp; Coef : 1</div>
            <table class="mark-table">
              <thead>
                <tr>
                  <th>Examen</th>
                  <th>Tp1</th>
                  <th class="cell-right">M</th>
                  <th class="cell-right">C</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="pill">11</span></td>
                  <td><span class="pill">14,25</span></td>
                  <td class="cell-right"><span class="pill">13,75</span></td>
                  <td class="cell-right"><span class="pill">7</span></td>
                </tr>
              </tbody>
            </table>

            <!-- Matière 2 -->
            <div class="subject-head">Matière : <span class="muted">Gestion des Institutions Financières</span> &nbsp; Cr : 2 &nbsp; Coef : 1</div>
            <table class="mark-table">
              <thead>
                <tr>
                  <th>Examen</th>
                  <th>Tp1</th>
                  <th class="cell-right">M</th>
                  <th class="cell-right">C</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="pill">11</span></td>
                  <td><span class="pill">14,25</span></td>
                  <td class="cell-right"><span class="pill">13,75</span></td>
                  <td class="cell-right"><span class="pill">7</span></td>
                </tr>
              </tbody>
            </table>

            <!-- Synthèse -->
            <div class="summary-row">
              <div>Moyenne : <span class="pill" style="min-width:64px">14,89</span></div>
              <div>Crédit : <span class="pill" style="min-width:44px">0</span></div>
            </div>
          </div>
        </div>

        <!-- UE 2 — Fermé -->
        <div class="ue-item">
          <div class="ue-head" data-target="#ue-2">
            <div class="ue-title">Unité d’enseignement : <span class="muted">Économétrie</span></div>
            <div class="chev" aria-hidden="true">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M6 15l6-6 6 6" stroke="#5d5b4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="ue-panel" id="ue-2" style="display:none"></div>
        </div>

        <!-- UE 3 — Fermé -->
        <div class="ue-item">
          <div class="ue-head" data-target="#ue-3">
            <div class="ue-title">Unité d’enseignement : <span class="muted">Gestion de portefeuille</span></div>
            <div class="chev" aria-hidden="true">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M6 15l6-6 6 6" stroke="#5d5b4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="ue-panel" id="ue-3" style="display:none"></div>
        </div>

        <!-- UE 4 — Fermé -->
        <div class="ue-item">
          <div class="ue-head" data-target="#ue-4">
            <div class="ue-title">Unité d’enseignement : <span class="muted">Activité à pratique</span></div>
            <div class="chev" aria-hidden="true">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M6 15l6-6 6 6" stroke="#5d5b4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="ue-panel" id="ue-4" style="display:none"></div>
        </div>

      </section>
      <!-- /SECTION 2 -->

    </div> <!-- /content -->
  </div> <!-- /dashboard -->

<script>
  // Onglets (visuel)
  document.querySelectorAll('.tab').forEach(t=>{
    t.addEventListener('click', ()=>{
      document.querySelectorAll('.tab').forEach(x=>x.classList.remove('active'));
      t.classList.add('active');
    });
  });

  // Accordéons : ouvrir/fermer chaque UE + rotation chevron
  document.querySelectorAll('.ue-head').forEach(head=>{
    head.addEventListener('click', ()=>{
      const target = document.querySelector(head.dataset.target);
      const icon = head.querySelector('svg');
      const open = target.style.display !== 'none';
      target.style.display = open ? 'none' : 'block';
      icon.classList.toggle('rot', !open);
    });
  });
</script>
</body>
</html>
