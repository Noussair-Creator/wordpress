<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Examens — Calendrier & Tableau</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class=" exam-panel-wrap">
  <div class="exam-panel">
    <!-- ===== Onglets ===== -->
    <div class="exam-tabs" id="examTabs">
      <button class="exam-tab-button active" data-tab="examens">
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/8750666.png" alt="Examens">
        Examens
      </button>
      <button class="exam-tab-button" data-tab="rattrapage">
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/4071975.png" alt="Rattrapage">
        Rattrapage
      </button>
    </div>

    <!-- ===== Contenu ===== -->
    <div class="exam-tab-content">

      <!-- ===== Onglet EXAMENS (2 sous-vues) ===== -->
      <div id="examens" class="exam-content-section active">
        <div class="exam-card-head">
          <div class="exam-card-title" id="examTitle">Vue Calendrier</div>
          <div class="exam-actions">
            <!-- (inversés) CALENDRIER puis TABLEAU -->
            <button class="action-btn active" data-view="calendar" title="Vue Calendrier">
              <img class="action-icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-calendar.png" alt="Calendrier">
            </button>
            <button class="action-btn" data-view="table" title="Vue Tableau">
              <i class="bi bi-list-ul"></i>
            </button>
            <button class="action-btn" title="Téléverser">
              <img class="action-icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </div>
        </div>

        <div class="exam-subbar">
          <span class="pill">Semestre 1</span>
          <span class="center">M1 en AI - groupe B2</span>
          <span class="year">2024-2025</span>
        </div>

        <!-- === Sous-vue : CALENDRIER === -->
        <div class="subview view-calendar active" id="examCalendar">
          <!-- Semaine 1 -->
          <div class="week-header-container">
            <div class="week-header">
              <div class="day-header"><span class="day-name">Lundi</span><span class="day-date">12-05-2025</span></div>
              <div class="day-header"><span class="day-name">Mardi</span><span class="day-date">13-05-2025</span></div>
              <div class="day-header"><span class="day-name">Mercredi</span><span class="day-date">14-05-2025</span></div>
              <div class="day-header"><span class="day-name">Jeudi</span><span class="day-date">15-05-2025</span></div>
              <div class="day-header"><span class="day-name">Vendredi</span><span class="day-date">16-05-2025</span></div>
              <div class="day-header"><span class="day-name">Samedi</span><span class="day-date">17-05-2025</span></div>
            </div>
          </div>
          <div class="week-body-container">
            <div class="week-body">
              <div class="day-cell"><!-- Lundi vide --></div>
              <div class="day-cell"><!-- Mardi vide --></div>

              <div class="day-cell"><!-- Mercredi -->
                <div class="exam-card">
                  <div class="subject">Base de données</div>
                  <div class="meta"> A 10h15 <br>Duree:1h30</div>
                  <div class="room">salle A12</div>
                </div>
              </div>

              <div class="day-cell"><!-- Jeudi -->
                <div class="exam-card">
                  <div class="subject">Réseaux</div>
                  <div class="meta">A 10h15 <br>Duree:1h30</div>
                  <div class="room">salle B1</div>
                </div>
              </div>

              <div class="day-cell"><!-- Vendredi vide --></div>

              <div class="day-cell"><!-- Samedi (2 cartes) -->
                <div class="exam-card">
                  <div class="subject">Anglais</div>
                  <div class="room">salle B1</div>
                  <!-- Séparé en heure + durée -->
                  <div class="meta">
                    <span class="time">A 09h00</span>
                    <span class="duration">Durée: 1h</span>
                  </div>
                </div>
                <div class="exam-card">
                  <div class="subject">Français</div>
                  <div class="room">salle B1</div>
                  <div class="meta">
                    <span class="time">A 12h00</span>
                    <span class="duration">Durée: 1h</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Semaine 2 -->
          <div class="week-header-container">
            <div class="week-header">
              <div class="day-header"><span class="day-name">Lundi</span><span class="day-date">18-05-2025</span></div>
              <div class="day-header"><span class="day-name">Mardi</span><span class="day-date">19-05-2025</span></div>
              <div class="day-header"><span class="day-name">Mercredi</span><span class="day-date">20-05-2025</span></div>
              <div class="day-header"><span class="day-name">Jeudi</span><span class="day-date">21-05-2025</span></div>
              <div class="day-header"><span class="day-name">Vendredi</span><span class="day-date">22-05-2025</span></div>
              <div class="day-header"><span class="day-name">Samedi</span><span class="day-date">23-05-2025</span></div>
            </div>
          </div>
          <div class="week-body-container">
            <div class="week-body">
              <div class="day-cell">
                <div class="exam-card">
                  <div class="subject">Systèmes distribués</div>
                  <div class="meta">A 09h00 <br>Durée: 2h</div>
                  <div class="room">salle B1</div>
                </div>
              </div>

              <div class="day-cell">
                <div class="exam-card">
                  <div class="subject">Sécurité</div>
                  <div class="meta">A 09h00 <br>Durée: 2h</div>
                  <div class="room">salle A15</div>
                </div>
              </div>

              <div class="day-cell">
                <div class="exam-card">
                  <div class="subject">AI</div>
                  <div class="room">salle B1</div>
                  <div class="meta">
                    <span class="time">A 09h00</span>
                    <span class="duration">Durée: 2h</span>
                  </div>
                </div>
                <div class="exam-card exam-card--split">
  <div class="subject">Machine learning</div>
  <div class="room">Salle B1</div>
  <div class="meta split">
    <span class="time">A 14h00</span>
    <span class="duration">Durée: 2h</span>
  </div>
</div>

              </div>

              <div class="day-cell"><!-- Jeudi vide --></div>
              <div class="day-cell"><!-- Vendredi vide --></div>
              <div class="day-cell"><!-- Samedi vide --></div>
            </div>
          </div>
        </div>

        <!-- === Sous-vue : TABLEAU (copie Rattrapage) === -->
        <div class="subview view-table" id="examTable">
          <div class="exam-table-wrap">
            <table class="exam-table">
              <thead>
                <tr>
                  <th style="width:38%">Matière</th>
                  <th style="width:18%">Date</th>
                  <th style="width:16%">Heure</th>
                  <th style="width:16%">Durée</th>
                  <th style="width:12%">Salle</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>Base de données</td><td>14-05-2025</td><td>10h15</td><td>1h30</td><td>A12</td></tr>
                <tr><td>Réseaux</td><td>15-05-2025</td><td>09h00</td><td>1h</td><td>B1 bis</td></tr>
                <tr><td>Français</td><td>17-05-2025</td><td>12h00</td><td>1h</td><td>B11</td></tr>
                <tr><td>Anglais</td><td>17-05-2025</td><td>09h00</td><td>1h</td><td>B11</td></tr>
                <tr><td>Systèmes distribués</td><td>18-05-2025</td><td>09h00</td><td>2h</td><td>A12</td></tr>
                <tr><td>Sécurité</td><td>19-05-2025</td><td>09h00</td><td>2h</td><td>B1 bis</td></tr>
                <tr><td>Machine learning</td><td>20-05-2025</td><td>14h00</td><td>2h</td><td>B11</td></tr>
                <tr><td>AI</td><td>20-05-2025</td><td>09h00</td><td>2h</td><td>A12</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ===== Onglet RATTRAPAGE (vue tableau) ===== -->
      <div id="rattrapage" class="exam-content-section">
        <div class="exam-card-head">
          <div class="exam-card-title">Vue Tableau</div>
          <div class="exam-actions">
            <button class="action-btn active" title="Vue Tableau"><i class="bi bi-table"></i></button>
            <button class="action-btn" title="Téléverser">
              <img class="action-icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </div>
        </div>

        <div class="exam-subbar">
          <span class="pill">Semestre 1</span>
          <span class="center">M1 en AI - groupe B2</span>
          <span class="year">2024-2025</span>
        </div>

        <div class="exam-table-wrap">
          <table class="exam-table">
            <thead>
              <tr>
                <th style="width:38%">Matière</th>
                <th style="width:18%">Date</th>
                <th style="width:16%">Heure</th>
                <th style="width:16%">Durée</th>
                <th style="width:12%">Salle</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Base de données</td><td>14-05-2025</td><td>10h15</td><td>1h30</td><td>A12</td></tr>
              <tr><td>Réseaux</td><td>15-05-2025</td><td>09h00</td><td>1h</td><td>B1 bis</td></tr>
              <tr><td>Français</td><td>17-05-2025</td><td>12h00</td><td>1h</td><td>B11</td></tr>
              <tr><td>Anglais</td><td>17-05-2025</td><td>09h00</td><td>1h</td><td>B11</td></tr>
              <tr><td>Systèmes distribués</td><td>18-05-2025</td><td>09h00</td><td>2h</td><td>A12</td></tr>
              <tr><td>Sécurité</td><td>19-05-2025</td><td>09h00</td><td>2h</td><td>B1 bis</td></tr>
              <tr><td>Machine learning</td><td>20-05-2025</td><td>14h00</td><td>2h</td><td>B11</td></tr>
              <tr><td>AI</td><td>20-05-2025</td><td>09h00</td><td>2h</td><td>A12</td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
/* ===== Base & onglets ===== */
:root{--ink:#2A2916;}
.container{max-width:1200px;margin:0 auto;padding:0 15px;}
.exam-panel-wrap{width:auto;padding-top:12px;margin-bottom:20%;}
.exam-panel{max-width:auto;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.06);border:1px solid #e5e7eb;overflow:hidden;}
.exam-tabs{display:flex;justify-content:center;gap:12px;background:#e8e8e8;}
.exam-tab-button{flex:1 1 0;max-width:800px;padding:15px 20px;border:none;background:#C5C5A9;color:#333;font-size:16px;font-weight:600;cursor:pointer;transition:.3s;display:flex;align-items:center;justify-content:center;gap:8px;border-radius:8px;}
.exam-tab-button.active{background:#fff;}
.exam-tab-button .icon{width:34px;height:34px;object-fit:contain;display:inline-block;}
.exam-tab-content{padding:18px 18px 22px;}
.exam-content-section{display:none;}
.exam-content-section.active{display:block;}

/* ===== Header + actions ===== */
.exam-card-head{display:flex;align-items:center;justify-content:space-between;padding:.35rem .5rem .65rem .5rem;}
.exam-card-title{font-weight:600;color:#0a0a0a;}
.exam-actions{display:flex;align-items:center;gap:.45rem;}
.action-btn{width:30px;height:30px;border:1px solid #ececec;background:#fff;border-radius:.7rem;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 1px 6px rgba(0,0,0,.08);transition:.12s;cursor:pointer;}
.action-btn:hover{transform:translateY(-1px);box-shadow:0 10px 20px rgba(0,0,0,.12);}
.action-btn i{font-size:18px;}
.action-btn.active{background:#C5C5A9;border-color:#C5C5A9;color:#fff;}
.action-btn .action-icon{width:16px;height:16px;object-fit:contain;display:block}

/* ===== Subbar (bordure seule autour du groupe) ===== */
.exam-subbar{display:grid;grid-template-columns:1fr 1fr 1fr;align-items:center;gap:8px;background:#ffffff;border:1px solid #E1E1D2;border-radius:10px;padding:.55rem .8rem;margin-bottom:.75rem;}
.exam-subbar .pill{background:transparent;border:none;font-weight:700;}
.exam-subbar .center{font-weight:700;text-align:center;}
.exam-subbar .year{justify-self:end;font-weight:700;background:transparent;border:none}

/* ===== Gestion des sous-vues ===== */
.subview{display:none;}
.subview.active{display:block;}

/* ======== CALENDRIER ======== */
/* Header jours/dates */
.week-header-container{background:#F1F1F1;border:1px solid #A6A485;border-radius:8px;overflow:hidden;margin-bottom:10px;}
.week-header{display:grid;grid-template-columns:repeat(6,1fr);background:#F1F1F1;}
.day-header{display:flex;align-items:center;gap:12px;padding:0 12px;min-height:44px;border-right:none;}
.day-header:last-child{border-right:none;}
.day-name{font:normal normal bold 15px/20px Roboto, system-ui, -apple-system, "Segoe UI";color:var(--ink);margin:0;}
.day-date{font:normal normal normal 13px/15px Roboto, system-ui, -apple-system, "Segoe UI";color:var(--ink);margin:0;}

/* Corps (cadre + séparateurs verticaux verts) */
.week-body-container{background:#fff;border:1px solid #A6A485;border-radius:10px;overflow:hidden;}
.week-body{display:grid;grid-template-columns:repeat(6,1fr);grid-auto-rows:129px;}
.day-cell{
  padding:8px;
  border-right:1px solid #A6A485;
  background:#F1F1F1;          /* <- fond demandé */
  display:flex;flex-direction:column;gap:6px;
}
.week-body .day-cell:last-child{border-right:none;}

/* Cartes : 1 carte = 150x120 ; 2 cartes = 150x57 empilées */
.exam-card{
  background:linear-gradient(180deg,#6E6D55 0%, #A6A485 100%);
  border:none;color:#fff;border-radius:4px;
  width:150px;height:120px;padding:6px 8px;
  display:flex;flex-direction:column;justify-content:flex-start;
  box-shadow:0 1px 3px rgba(0,0,0,.1);
}
.exam-card .subject{font:normal normal bold 15px/20px Roboto, system-ui; color:#fff;}
.exam-card .meta{margin-top:10px;font:normal normal normal 13px/18px Roboto, system-ui;color:#fff;}
.exam-card .room{margin-top:auto;font:normal normal normal 13px/18px Roboto, system-ui;color:#fff;}

/* Cas avec deux cartes dans la même cellule */
.day-cell:has(.exam-card + .exam-card){gap:6px;}
.day-cell:has(.exam-card + .exam-card) .exam-card{
  height:57px;
  display:grid; grid-template-columns:1fr auto; grid-template-rows:auto auto; align-items:center;
}
.day-cell:has(.exam-card + .exam-card) .subject{grid-column:1;grid-row:1;margin:0;}
.day-cell:has(.exam-card + .exam-card) .room{grid-column:2;grid-row:1;justify-self:end;margin:0;}

/* On éclate .meta en 2 colonnes : time sous le sujet (gauche), durée sous la salle (droite) */
.day-cell:has(.exam-card + .exam-card) .meta{display:contents;}
.day-cell:has(.exam-card + .exam-card) .meta .time{grid-column:1;grid-row:2;font-size:9px;opacity:.9;}
.day-cell:has(.exam-card + .exam-card) .meta .duration{grid-column:2;grid-row:2;justify-self:end;font-size:9px;opacity:.9;}

/* ===== Tableau ===== */
.exam-table{width:100%;border-collapse:separate;border-spacing:0;}
.exam-table thead th{background:#EEEFE6;color:#4a4a4a;font-weight:700;padding:.65rem .8rem;text-align:left;border-top:1px solid #E3E3D4;border-bottom:1px solid #E3E3D4;}
.exam-table thead th:first-child{border-top-left-radius:8px;}
.exam-table thead th:last-child{border-top-right-radius:8px;}
.exam-table tbody td{padding:.65rem .8rem;color:#555;border-bottom:1px solid #F0F0EE;}
.exam-table tbody tr:nth-child(odd){background:#F9FAF8;}
.exam-table tbody tr:last-child td:first-child{border-bottom-left-radius:8px;}
.exam-table tbody tr:last-child td:last-child{border-bottom-right-radius:8px;}

/* Responsive */
@media (max-width:991.98px){.exam-panel-wrap{width:100%;padding:12px;}}
.exam-panel,*{font-size:.95rem;}
@media (max-width:768px){
  .week-body{grid-template-columns:repeat(3,1fr);}
  .week-header{grid-template-columns:repeat(3,1fr);}
}
@media (max-width:480px){
  .week-body{grid-template-columns:1fr;}
  .week-header{grid-template-columns:1fr;}
  .exam-tab-button{font-size:14px;padding:12px 15px;}
}

/* Espace entre les deux semaines */
.view-calendar .week-body-container + .week-header-container{ margin-top: 40px; }



/* Matières : taille réduite */
.exam-card .subject{
  font-weight: 700;
  font-size: 13px;      /* ← ajuste si besoin (12–14) */
  line-height: 18px;
  color: #fff;
  font-family: Roboto, system-ui, -apple-system, "Segoe UI";
}

/* Quand il y a deux boxes dans la même cellule, encore un peu plus petit */
.day-cell:has(.exam-card + .exam-card) .subject{
  font-size: 12px;      /* ← ajuste si besoin */
  line-height: 16px;
}
  





  /* 1) Même fond dégradé pour TOUTES les boxes (semaine 1 et 2) */
.view-calendar .exam-card{
  background: linear-gradient(180deg, #6E6D55 0%, #A6A485 100%) !important;
  border: 1px solid #807d65; /* optionnel, comme S1 */
}

/* 2) Diminuer la taille des noms des jours dans le header */
.week-header .day-header{ gap: 8px; } /* un peu moins d’espace entre jour et date */
.week-header .day-name{
  font-size: 13px;       /* ← avant 15px */
  line-height: 18px;
  font-weight: 700;
}

/* (facultatif) Si tu veux encore plus compact : */
/*
.week-header .day-name{ font-size: 12px; line-height: 16px; }
*/




/* Même background (dégradé) pour toutes les boxes du calendrier — semaine 1 et 2 */
.view-calendar .exam-card{
  background: linear-gradient(180deg, #6E6D55 0%, #A6A485 100%) !important;
  border: none;
}

/* Variante pour une carte à 3 lignes (Machine learning) dans une cellule qui en contient 2 */
.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split{
  /* un peu plus haute que 57px pour cas "deux cartes" afin de loger 3 lignes */
  height: 68px;
  display: grid;
  grid-template-columns: 1fr auto;
  grid-template-rows: auto auto auto; /* sujet / salle / ligne temps+durée */
  align-items: center;
  padding: 6px 8px;
}

/* Positionnement des éléments dans la carte “split” */
.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split .subject{
  grid-column: 1 / span 2; /* pleine largeur */
  grid-row: 1;
  margin: 0;
  white-space: nowrap; /* reste sur une seule ligne */
}

.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split .room{
  grid-column: 1 / span 2; /* pleine largeur, sous le sujet */
  grid-row: 2;
  justify-self: start;
  margin: 0;
}

/* La 3e ligne: temps à gauche, durée à droite */
.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split .meta.split{
  grid-column: 1 / span 2;
  grid-row: 3;
  display: grid;
  grid-template-columns: 1fr auto;
  width: 100%;
  margin: 0;
}

.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split .meta.split .time{
  justify-self: start;
}

.day-cell:has(.exam-card + .exam-card) .exam-card.exam-card--split .meta.split .duration{
  justify-self: end;
}

</style>

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
      if (btn.dataset.tab === 'examens') setExamView('calendar');
    });
  });

  /* ===== Sous-vues Examens ===== */
  const titleEl  = document.getElementById('examTitle');
  const btnCal   = document.querySelector('#examens .action-btn[data-view="calendar"]');
  const btnTable = document.querySelector('#examens .action-btn[data-view="table"]');
  const viewCal  = document.getElementById('examCalendar');
  const viewTable= document.getElementById('examTable');

  function setExamView(which){
    btnCal.classList.toggle('active',   which === 'calendar');
    btnTable.classList.toggle('active', which === 'table');
    viewCal.classList.toggle('active',   which === 'calendar');
    viewTable.classList.toggle('active', which === 'table');
    titleEl.textContent = which === 'table' ? 'Vue Tableau' : 'Vue Calendrier';
  }
  btnCal.addEventListener('click',  ()=> setExamView('calendar'));
  btnTable.addEventListener('click',()=> setExamView('table'));
  setExamView('calendar');
});
</script>

</body>
</html>
