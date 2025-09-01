<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Date de soutenance</title>
  <style>
    .dp-info-line strong { font-size: 14px; }

    /* ===== SCOPING : tout est limité à #defense-page ===== */
    #defense-page{
      --bg:#efefee;
      --card:#ffffff;
      --edge:#e7e4d7;
      --row:#f7f6f2;
      --row-alt:#fbfbf8;
      --ink:#1b1b1b;
      --muted:#7b7a6d;
      --tab:#9da077;
      --tab-ink:#ffffff;
      --warning:#6b6c4a;
      --ok:#1f7a36;
      --ok-bg:#e9f5ec;
      --ok-b:#cbe9d3;
      --shadow:0 10px 24px rgba(0,0,0,.08);
      --shadow-soft:0 4px 12px rgba(0,0,0,.06);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, "Helvetica Neue", "Noto Sans";
      color: var(--ink);
      padding: 18px;
      
    }
    #defense-page .dp-container{ max-width:auto; margin:0 auto; }

    /* ===== Onglets ===== */
    #defense-page .dp-tabs{
      display:flex; gap:12px;  justify-content:center;
    }
    #defense-page .dp-tab{
      flex:1 1 0; max-width:800px; padding:15px 20px; border:none; background:#C5C5A9;
      color:#333; font-size:16px; font-weight:600; cursor:pointer; transition:.3s;
      display:flex; align-items:center; justify-content:center; gap:8px; border-radius:8px;
    }
    #defense-page .dp-tab.active{ background:#fff; }
    #defense-page .dp-tab .icon{
      width:30px; height:30px; object-fit:contain; display:inline-block;
    }

    /* ===== Carte principale ===== */
    #defense-page .dp-card{
      position:relative; background:var(--card); 
      border-radius:12px; box-shadow:var(--shadow);
      padding:18px; margin-top:-6px;
    }

    /* ===== Puces d’état ===== */
    #defense-page .dp-statusbar{ display:flex; justify-content:flex-end; margin-bottom:10px; }
    #defense-page .dp-chip{
      display:inline-flex; align-items:center; gap:8px;
      background:#f6f6f1; border:1px solid #d9d6c6; color:#6E6D55;
      padding:9px 16px; border-radius:999px; font-weight:750; box-shadow:var(--shadow-soft);font-size: 12px
    }
    #defense-page .dp-chip .dot{ top: 389px;
left: 1193px;
width: 13px;
height: 13px;
background: #6E6D55 0% 0% no-repeat padding-box;
opacity: 1; border-radius:999px;  }
    #defense-page .dp-chip.success{ background:var(--ok-bg); border-color:var(--ok-b); color:var(--ok); }
    #defense-page .dp-chip.success .dot{ background:var(--ok); }

    /* ===== Sous-titres de section ===== */
    #defense-page .dp-h3{ font-weight:620; margin:10px 2px 10px; font-size:18px; }

    /* ===== Tableau d’infos ===== */
    #defense-page .dp-info{ border:1px solid var(--edge); border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.03); }
    #defense-page .dp-row{
      display:grid; grid-template-columns:220px 1fr;
      background:var(--row); border-bottom:1px solid #eeeae0;
      padding:12px 18px; align-items:center; font-size:14px;
    }
    #defense-page .dp-row:nth-child(even){ background:var(--row-alt); }
    #defense-page .dp-row:last-child{ border-bottom:none; }
    #defense-page .dp-lbl{ color:var(--muted); font-weight:700; }
    #defense-page .dp-val{ color:#1a1a1a; font-weight:500; }
    #defense-page .dp-jury{ display:flex; gap:28px; flex-wrap:wrap; }

    /* ===== Bloc Dépôt ===== */
    #defense-page .dp-box{ border:1px solid var(--edge); border-radius:10px; background:#fff; padding:10px; box-shadow:0 2px 8px rgba(0,0,0,.03); }
    #defense-page .dp-upload{ display:flex; gap:10px; align-items:center; }
    #defense-page .dp-fake{
      flex:1 1 auto; height:40px; border:1px solid #e6e2d6; border-radius:8px;
      background:#ffffff; padding:0 12px; display:flex; align-items:center;
      color:#1a1a1a; font-weight:500; font-size:16px;
    }
    #defense-page .dp-import{
      height:40px; padding:0 14px; border:1px solid #f8f8f6ff; border-radius:10px;
      background:#A6A485; color:white; font-weight:500; cursor:pointer;
      display:inline-flex; align-items:center; gap:8px;
    }
    #defense-page .dp-import:hover{ filter:brightness(0.98); }
    #defense-page input[type="file"]{ display:none; }

    /* >>> icône du bouton Importer (remplace le SVG) */
    #defense-page .dp-import .icon{
      width:12px; height:12px; object-fit:contain; display:inline-block;
      transform: rotate(180deg); /* renversé 180° */
    }

    #defense-page .dp-hint{ color:#a09b8d; font-size:12px; margin:6px 2px 0; }
    #defense-page .dp-note{
      width:100%; min-height:90px; border:1px solid #e6e2d6; border-radius:8px;
      margin-top:10px; padding:10px; resize:vertical; outline:none; background:#fff;
    }
    #defense-page .dp-check{ display:flex; align-items:center; gap:8px; margin:12px 2px 0; font-weight:bold; font-size:14px; }
    #defense-page .dp-check input{ width:18px; height:18px; accent-color:#b30000; }

    #defense-page .dp-info-line{
      margin-top:10px; border:1px solid #e6e2d6; background:#fff; border-radius:8px;
      padding:12px; color:#4b4b3d; display:flex; gap:8px;
    }

    /* ===== Sections ===== */
    #defense-page .dp-section{ display:none; }
    #defense-page .dp-section.active{ display:block; }

    /* ===== Responsive ===== */
    @media (max-width:700px){ #defense-page .dp-row{ grid-template-columns:1fr; gap:6px; } }
    @media (max-width:480px){ #defense-page .dp-tab{ font-size:14px; padding:12px 15px; } }
  </style>
</head>
<body>

  <div id="defense-page">
    <div class="dp-container">

      <!-- Onglets -->
      <div class="dp-tabs" id="dpTabs">
        <button class="dp-tab active" data-tab="date">
          <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/5326531.png" alt="">
          Date de soutenance
        </button>
        <button class="dp-tab" data-tab="depot">
          <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/report-document-file.png" alt="">
          Dépôt de rapport
        </button>
      </div>

      <!-- Carte -->
      <div class="dp-card">

        <!-- Onglet 1 : Date de soutenance -->
        <section id="dp-date" class="dp-section active" aria-labelledby="tab-date">
          <div class="dp-statusbar">
            <span class="dp-chip"><span class="dot"></span> Ajournée</span>
          </div>

          <div class="dp-info">
            <div class="dp-row">
              <div class="dp-lbl">Rapporteur :</div>
              <div class="dp-val">Mourd Aloui</div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Jurys :</div>
              <div class="dp-val dp-jury">
                <span>Manel Bouzidi</span>
                <span>Ahmed Smaïli</span>
              </div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Date :</div>
              <div class="dp-val">13-09-2025</div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Heure :</div>
              <div class="dp-val">10h30</div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Salle :</div>
              <div class="dp-val">B14 bloc B</div>
            </div>
          </div>
        </section>

        <!-- Onglet 2 : Dépôt de rapport -->
        <section id="dp-depot" class="dp-section" aria-labelledby="tab-depot">
          <div class="dp-statusbar">
            <span class="dp-chip success"><span class="dot"></span> En attente de soutenance</span>
          </div>

          <h3 class="dp-h3">Date de dépôt</h3>
          <div class="dp-info">
            <div class="dp-row">
              <div class="dp-lbl">Date limite de dépôt :</div>
              <div class="dp-val">01-09-2025</div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Encadrant :</div>
              <div class="dp-val">Manel Bouzidi</div>
            </div>
            <div class="dp-row">
              <div class="dp-lbl">Statut de soutenance :</div>
              <div class="dp-val">Ajournée <span style="font-weight:700; color:#444;">(session 2)</span></div>
            </div>
          </div>

          <div style="height:16px"></div>
          <hr style="border:none; border-top:1px solid #eeeae0; margin:0 2px 14px">

          <h3 class="dp-h3">Déposer mon mémoire</h3>
          <div class="dp-box">
            <div class="dp-upload">
              <div id="fakeInput" class="dp-fake">Memoirefinale.pdf</div>
              <input id="realFile" type="file" accept="application/pdf">

              <!-- BOUTON IMPORTER avec l'icône demandée, pivotée 180° -->
              <button id="btnImport" type="button" class="dp-import" title="Importer">
                <img class="icon" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27) Icon-upload.png" alt="Importer">
                Importer
              </button>
            </div>

            <div class="dp-hint">PDF uniquement, max 20 Mo</div>

            <textarea class="dp-note" placeholder="Note…"></textarea>

            <label class="dp-check">
              <input type="checkbox" checked>
              Je confirme que le mémoire déposé est la version finale et définitive.
            </label>

            <div class="dp-info-line">
              votre mémoire a été déposer le&nbsp;<strong>01-09-2025</strong>&nbsp;&nbsp;à&nbsp;&nbsp;<strong>15h37</strong>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script>
    // Tabs (scopé au composant)
    (function(){
      const root = document.getElementById('defense-page');
      const tabs = root.querySelectorAll('.dp-tab');
      const sections = {
        date:  root.querySelector('#dp-date'),
        depot: root.querySelector('#dp-depot')
      };
      tabs.forEach(btn=>{
        btn.addEventListener('click', ()=>{
          tabs.forEach(b=>b.classList.remove('active'));
          btn.classList.add('active');
          const key = btn.dataset.tab;
          sections.date.classList.toggle('active', key==='date');
          sections.depot.classList.toggle('active', key==='depot');
        });
      });

      // Import fichier (affiche le nom choisi)
      const realFile = root.querySelector('#realFile');
      const fake = root.querySelector('#fakeInput');
      root.querySelector('#btnImport').addEventListener('click', ()=> realFile.click());
      realFile.addEventListener('change', ()=>{
        if(realFile.files && realFile.files[0]) fake.textContent = realFile.files[0].name;
      });
    })();
  </script>

</body>
</html>
