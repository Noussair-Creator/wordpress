<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Supports pédagogiques</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* ===== Barre de recherche réutilisée ===== */
    .abs-toolbar--inside-exam{
      display:flex; flex-wrap:wrap; gap:.6rem; align-items:center;
      padding:.6rem; background:#fff; border-radius:.6rem; margin-bottom:.7rem;
    }
    .abs-toolbar--inside-exam .abs-input{ position:relative; flex:1 1 280px; max-width:220px; }
    .abs-toolbar--inside-exam .abs-input input{
      width:100%; border:1px solid #e5e7eb; border-radius:.6rem;
      padding:.55rem 2.1rem .55rem .6rem; font-size:.95rem; background:#fbfbfb; color:#1a1a1a;
    }
    .abs-toolbar--inside-exam .abs-input i{
      position:absolute; right:.55rem; top:50%; transform:translateY(-50%);
      color:black; font-size:1.05rem;
    }

    /* ===== Panel + onglets ===== */
    .exam-panel { background:#fff; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,.06);
      border:1px solid #e5e7eb; overflow:hidden; }
    .exam-tabs { display:flex; justify-content:center; gap:12px; background:#e8e8e8; }
    .exam-tab-button{
      flex:1 1 0; max-width:800px; padding:15px 20px; border:none; background:#C5C5A9;
      color:#333; font-size:16px; font-weight:600; cursor:pointer; transition:.3s;
      display:flex; align-items:center; justify-content:center; gap:8px; border-radius:8px;
    }
    .exam-tab-button.active{ background:#fff; }
    .exam-tab-button .icon{ width:30px; height:30px; object-fit:contain; display:inline-block; }
    .exam-tab-content{ padding:18px 18px 22px; }
    .exam-content-section{ display:none; }
    .exam-content-section.active{ display:block; }

    /* =========================================================================
       TABLES SÉPARÉES (HEAD + BODY) AVEC COLGROUP
       =======================================================================*/
    .sp{
      --ink:#2A2916; --muted:#A6A59F; --line:#EBE9D7; --panel:#ECEBE3; --edge:#A6A4853D; --red:#BF0404;
      font-family:Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
      max-width:auto; margin:0 auto;
    }
    .sp .head-box{
      background:var(--panel); border:1px solid var(--edge); border-radius:8px; overflow:hidden;
    }
    .sp .body-box{
      margin-top:10px; background:#fff; border:2px solid var(--line); border-radius:8px; overflow:hidden;
    }
    .sp table{ width:100%; border-collapse:separate; border-spacing:0; table-layout:fixed; color:var(--ink); }
    .sp thead th{
      background:transparent; padding:10px; text-align:center; font:700 15px/20px Roboto; color:var(--ink);
    }
    .sp tbody td{ padding:10px; vertical-align:middle; background:#fff; border-top:1px solid var(--line); }
    .sp tbody tr:first-child td{ border-top:none; }
    .sp tbody td + td{ border-left:1px solid var(--line); }

    /* Images couverture & icône PDF */
    .sp .couv img{ width:86px; height:56px; object-fit:cover; border-radius:6px; display:block; margin:0 auto; }
    .sp .pdf img{ width:22px; height:26px; display:inline-block; }

    /* Pagination */
    .sp .sp-pagi{ display:flex; justify-content:flex-end; gap:12px; padding:10px 6px 0; }
    .sp .pg-btn{
      width:27px; height:27px; border:2px solid var(--red); border-radius:3px; background:#fff;
      display:inline-flex; align-items:center; justify-content:center; cursor:pointer;
      font-weight:700; color:var(--red); line-height:1; font-size:22px;
    }
    .sp .pg-num{ min-width:20px; text-align:center; font-family:'Signika', system-ui, sans-serif; font-size:14px; color:#010103; }

    /* =========================
       ONGLET 1: Supports (5 col)
       =========================*/
    /* colgroup pour Supports pédagogiques */
    .sp-default col.c1{ width:12%; }   /* Couverture */
    .sp-default col.c2{ width:32%; }   /* Titre */
    .sp-default col.c3{ width:18%; }   /* Enseignant */
    .sp-default col.c4{ width:28%; }   /* Description */
    .sp-default col.c5{ width:10%; }   /* Pdf */

    /* =========================
       ONGLET 2: Livres (9 col)
       pourcentages issus de tes largeurs (60/215/135/150/90/55/110/70/50 sur 935)
       =========================*/
    .sp-books col.c1{ width:6.5%; }   /* Référence */
    .sp-books col.c2{ width:23%; }    /* Titre */
    .sp-books col.c3{ width:14.5%; }  /* Enseignant */
    .sp-books col.c4{ width:16%; }    /* Auteur */
    .sp-books col.c5{ width:9.5%; }   /* ISBN */
    .sp-books col.c6{ width:6%; }     /* Source */
    .sp-books col.c7{ width:11.8%; }  /* Date */
    .sp-books col.c8{ width:7.5%; }   /* Catégorie */
    .sp-books col.c9{ width:5.2%; }   /* Pdf */

  
  </style>
</head>
<body>

<div class=" exam-panel-wrap">
  <div class="exam-panel">
    <!-- ===== Onglets ===== -->
    <div class="exam-tabs" id="examTabs">
      <button class="exam-tab-button active" data-tab="examens">
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/5326531.png" alt="Supports pédagogiques">
        Supports pédagogiques
      </button>
      <button class="exam-tab-button" data-tab="rattrapage">
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/8832880.png" alt="Liste des livres">
        Liste des livres
      </button>
    </div>

    <!-- ===== Contenu des onglets ===== -->
    <div class="exam-tab-content">
      <!-- ========= ONGLET 1 ========= -->
      <div id="examens" class="exam-content-section active">
        <!-- Barre de recherche -->
        <div class="abs-toolbar--inside-exam">
          <div class="abs-input">
            <input type="text" id="searchSupportsTab1" placeholder="Recherche..." autocomplete="off">
            <i class="bi bi-search"></i>
          </div>
        </div>

        <!-- Tableau (head séparé + body séparé) -->
        <div class="sp sp-default">
          <!-- HEAD -->
          <div class="head-box">
            <table class="head-table" aria-hidden="true">
              <colgroup>
                <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5">
              </colgroup>
              <thead>
                <tr>
                  <th>Couverture</th>
                  <th>Titre</th>
                  <th>Enseignant</th>
                  <th>Description</th>
                  <th>Pdf</th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- BODY -->
          <div class="body-box">
            <table class="body-table" aria-describedby="supports pédagogiques">
              <colgroup>
                <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5">
              </colgroup>
              <tbody>
                <tr>
                  <td class="couv"><img src="https://picsum.photos/seed/couv3/120/160" alt="Couverture PRML"></td>
                  <td>Pattern Recognition And<br>Machine Learning</td>
                  <td>Ahmed Abed</td>
                  <td>–</td>
                  <td class="pdf" style="text-align:center;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
                <tr>
                  <td class="couv"><img src="https://picsum.photos/seed/couv2/120/160" alt="Couverture Deep Learning"></td>
                  <td>Deep Learning</td>
                  <td>Manel Bouzidi</td>
                  <td>–</td>
                  <td class="pdf" style="text-align:center;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
                <tr>
                  <td class="couv"><img src="https://picsum.photos/seed/couv1/120/160" alt="Couverture AIMA"></td>
                  <td>Artificial Intelligence: A Modern<br>Approach</td>
                  <td>Ahlem Mrad</td>
                  <td>–</td>
                  <td class="pdf" style="text-align:center;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="sp-pagi">
            <div class="pg-btn" title="Première page">&laquo;</div>
            <div class="pg-btn" title="Précédent">&lsaquo;</div>
            <div class="pg-num">2</div>
            <div class="pg-btn" title="Suivant">&rsaquo;</div>
            <div class="pg-btn" title="Dernière page">&raquo;</div>
          </div>
        </div>
      </div>

      <!-- ========= ONGLET 2 ========= -->
      <div id="rattrapage" class="exam-content-section">
        <div class="abs-toolbar--inside-exam">
          <div class="abs-input">
            <input type="text" id="searchSupportsTab2" placeholder="Recherche..." autocomplete="off">
            <i class="bi bi-search"></i>
          </div>
        </div>

        <!-- Tableau Livres (head séparé + body séparé) -->
        <div class="sp sp-books">
          <!-- HEAD -->
          <div class="head-box">
            <table class="head-table" aria-hidden="true">
              <colgroup>
                <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5"><col class="c6"><col class="c7"><col class="c8"><col class="c9">
              </colgroup>
              <thead>
                <tr>
                  <th>Référence</th>
                  <th>Titre</th>
                  <th>Enseignant</th>
                  <th>Auteur</th>
                  <th>ISBN</th>
                  <th>Source</th>
                  <th>Date</th>
                  <th>Catégorie</th>
                  <th style="text-align:right;">Pdf</th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- BODY -->
          <div class="body-box">
            <table class="body-table" aria-describedby="liste des livres">
              <colgroup>
                <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5"><col class="c6"><col class="c7"><col class="c8"><col class="c9">
              </colgroup>
              <tbody>
                <tr>
                  <td>0001</td>
                  <td>Pattern Recognition And Machine Learning</td>
                  <td>Ahmed Abed</td>
                  <td>Christopher M. Bishop</td>
                  <td>09N377HF</td>
                  <td></td>
                  <td>13-03-2024</td>
                  <td>IT</td>
                  <td class="pdf" style="text-align:right;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
                <tr>
                  <td>0002</td>
                  <td>Deep Learning</td>
                  <td>Manel Bouzidi</td>
                  <td>Aaron Courville</td>
                  <td>09N377HF</td>
                  <td></td>
                  <td>13-03-2024</td>
                  <td>IT</td>
                  <td class="pdf" style="text-align:right;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
                <tr>
                  <td>0003</td>
                  <td>Artificial Intelligence: A Modern Approach</td>
                  <td>Ahlem Mrad</td>
                  <td>Peter Norvig</td>
                  <td>09N377HF</td>
                  <td></td>
                  <td>13-03-2024</td>
                  <td>IT</td>
                  <td class="pdf" style="text-align:right;">
                    <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20%282%29.png" alt="PDF">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="sp-pagi">
            <div class="pg-btn" title="Première page">&laquo;</div>
            <div class="pg-btn" title="Précédent">&lsaquo;</div>
            <div class="pg-num">2</div>
            <div class="pg-btn" title="Suivant">&rsaquo;</div>
            <div class="pg-btn" title="Dernière page">&raquo;</div>
          </div>
        </div>
      </div>
      <!-- /onglets -->
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    /* ===== Tabs ===== */
    const tabButtons = document.querySelectorAll('.exam-tab-button');
    const sections = {
      examens: document.getElementById('examens'),
      rattrapage: document.getElementById('rattrapage')
    };
    tabButtons.forEach(btn=>{
      btn.addEventListener('click', ()=>{
        tabButtons.forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        sections.examens.classList.toggle('active', btn.dataset.tab==='examens');
        sections.rattrapage.classList.toggle('active', btn.dataset.tab==='rattrapage');
      });
    });
  });
</script>

</body>
</html>
