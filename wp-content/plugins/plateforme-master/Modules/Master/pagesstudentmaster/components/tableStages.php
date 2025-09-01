<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plateforme Master</title>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* === General Styles === */
    .content-block {
      background: #fff;
      border-radius: 10px;
      font-family: 'Segoe UI', sans-serif;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .accordion-container {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
      border-top: 0px;
    }
    .accordion-tabs {
      display: flex;
      background: #f3f3f3;
      border-radius: 10px 10px 0 0;
      overflow: hidden;
    }
    .tab-btn {
      flex: 1;
      padding: 12px 20px;
      font-weight: 600;
      border: none;
      background: #A6A485;
      cursor: pointer;
      font-size: 21px;
      transition: 0.3s;
      letter-spacing: 0px;
      color: #fff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .tab-btn:first-child,
    .tab-btn:nth-child(2) { margin-right: 8px; }
    .tab-btn.active {
      background-color: #fff;
      color: #2A2916;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      box-shadow: inset 0 -3px 0 0 #fff;
    }
    .accordion-tabs img { width: 33px; height: 33px; }
    .accordion-content { padding: 25px 25px 35px; background: #fff; }
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    /* === Controls === */
    .table-controls {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 45px;
      padding: 0 4px;
    }
    .filters-row { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }
    .ctl{
      --ctl-h: 44px; --ctl-br: 12px; --ctl-border: #e7e3d7; --ctl-text: #2A2916;
      position: relative; display: inline-flex; align-items: center; gap: 10px;
      height: var(--ctl-h); padding: 0 12px; border: 1px solid var(--ctl-border);
      border-radius: var(--ctl-br); background: #fff; box-shadow: 0 1px 0 rgba(0,0,0,0.02);
      color: var(--ctl-text);
    }
    .ctl input,.ctl select{
      flex: 1 1 auto; height: calc(var(--ctl-h) - 2px); border: none; outline: none;
      background: transparent; font-size: 15px; color: var(--ctl-text);
    }
    .ctl input::placeholder{ color:#C0BCA9; }
    .ctl .sep{ width:1px; height:60%; background:#e7e3d7; margin-left:auto; }
    .ctl i{ font-size:18px; color:#3a3826; opacity:.85; }
    .ctl-search { min-width: 260px; }
    .ctl-select { min-width: 280px; }
    .ctl-period { min-width: 240px; }
    .ctl-select select{ appearance:none; -webkit-appearance:none; -moz-appearance:none; padding-right:28px; font-weight:600; }
    .ctl-select select::-ms-expand{ display:none; }
    .ctl:focus-within{ border-color:#dcd6c3; box-shadow:0 0 0 3px rgba(220,214,195,.35); }

    /* === Table Styling (commun) === */
    .styled-table{
      border:none!important; border-collapse:separate!important; border-spacing:0!important;
      border-radius:12px!important; box-shadow:none!important; width:100%; background:#fff;
      font-family:'Segoe UI',sans-serif;
    }
    .styled-table thead{
      background-color:#ECEBE3!important; position:static!important; transform:translateY(-15px)!important; border:none!important;
    }
    .styled-table th{
      padding:26px 10px 17px!important; border:0 solid #EBE9D7!important; font-weight:600; font-size:14px!important;
      white-space:nowrap!important; line-height:1.2; letter-spacing:.2px;
    }
    .styled-table td{ padding:12px!important; border:1px solid #EBE9D7!important; box-shadow:none!important; }
    .styled-table tbody tr:nth-child(even){ background:#ECEBE34D!important; }
    .styled-table thead tr:first-child th:first-child{ border-top-left-radius:12px!important; border-bottom-left-radius:12px!important; }
    .styled-table thead tr:first-child th:last-child{ border-top-right-radius:12px!important; border-bottom-right-radius:12px!important; }
    .styled-table tbody tr:first-child td:first-child{ border-top-left-radius:12px!important; }
    .styled-table tbody tr:first-child td:last-child{text-align: center;
}
    .styled-table tbody tr:last-child td:first-child{ border-bottom-left-radius:12px!important; }
    .styled-table tbody tr:last-child td:last-child{ border-bottom-right-radius:12px!important;    text-align: center;
}
    .styled-table td a.titre-offre{ color:#1a1a1a; text-decoration:none; font-size:14px; }
    .styled-table td a.titre-offre:hover{ text-decoration:underline; color:#08C5D1; }

    /* === Pagination Styling === */
    /* Pagination style « comme la capture » (boutons carrés avec icônes) */
  #projetsTable_wrapper .dataTables_paginate {
    display: flex; justify-content: center; gap: 6px; margin-top: 14px;
  }
  #stagesTable_wrapper .dataTables_paginate {
    display: flex; justify-content: center; gap: 6px; margin-top: 14px;
  }
  #emploisTable_wrapper .dataTables_paginate {
    display: flex; justify-content: center; gap: 6px; margin-top: 14px;
  }

/* Commun : centrer parfaitement tous les boutons de pagination */
#projetsTable_wrapper .dataTables_paginate .paginate_button,
#emploisTable_wrapper  .dataTables_paginate .paginate_button,
#stagesTable_wrapper   .dataTables_paginate .paginate_button{
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  width: 34px;          /* carré */
  height: 34px;         /* carré */
  min-width: 34px;      /* évite de s’étirer */
  padding: 0 !important;/* pas de décalage interne */
  line-height: 1;       /* pas de sur-hauteur */
  box-sizing: border-box;
  border: 2px solid #c60000 !important;
  background: #fff !important;
  color: #c60000 !important;
  border-radius: 6px !important;
  font-weight: 600;
}

/* Page courante : style différent mais toujours centré */
#projetsTable_wrapper .dataTables_paginate .paginate_button.current,
#emploisTable_wrapper  .dataTables_paginate .paginate_button.current,
#stagesTable_wrapper   .dataTables_paginate .paginate_button.current{
  background: #fff !important;
  color: #000 !important;
  border: 0 !important;
  box-shadow: none !important;
  pointer-events: none;
}

/* Icônes : pas de ligne supplémentaire */
.dataTables_paginate i{
  line-height: 1;
  font-size: 14px; /* ajuste si tu veux */
}

/* Hover */
#projetsTable_wrapper .dataTables_paginate .paginate_button:not(.current):hover,
#emploisTable_wrapper  .dataTables_paginate .paginate_button:not(.current):hover,
#stagesTable_wrapper   .dataTables_paginate .paginate_button:not(.current):hover{
  background: #c60000 !important;
  color: #fff !important;
}
#projetsTable_wrapper .dataTables_paginate .paginate_button.first,
#projetsTable_wrapper .dataTables_paginate .paginate_button.previous,
#projetsTable_wrapper .dataTables_paginate .paginate_button.next,
#projetsTable_wrapper .dataTables_paginate .paginate_button.last {
  /* retire height/width/padding personnalisés ici */
  /* height: 30px; width: 20px; padding: 6px 10px;  <-- à supprimer */
  border: 0.5px solid #c60000 !important; /* aligne avec les autres */
}







/* Hover : rempli en rouge */


    /* === Actions === */
    .actions{ position:relative; display:inline-block; }
    .action-btn{
      width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;background:transparent;color:#2d2a12;
      border:1px solid transparent;border-radius:8px;font-size:20px;cursor:pointer;transition:background-color .2s,box-shadow .2s;
    }
    .action-btn:hover{ background:#e6e6de; box-shadow:0 1px 3px rgba(0,0,0,.1); }
    .dropdown-menu{
      display:none; position:absolute; top:100%; right:0; min-width:160px; background:#fff; border:1px solid #d8d4b7;
      border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,.1); z-index:1000;
    }
    .dropdown-menu a{ display:flex; align-items:center; gap:8px; padding:10px 14px; font-size:14px; color:#2d2a12; text-decoration:none; }
    .dropdown-menu a:hover{ background:#f5f5f5; }
    .dropdown-menu i{ font-size:15px; color:#2d2a12; }

    /* === Sidebar === */
    .offre-overlay{ position:fixed; inset:0; background:rgba(0,0,0,.35); opacity:0; pointer-events:none; transition:opacity .2s; z-index:9998; }
    .offre-overlay.open{ opacity:1; pointer-events:auto; }
    .offre-sidebar{
      position:fixed; top:0; right:0; height:100vh; width:420px; max-width:92vw; background:#fff; box-shadow:-6px 0 18px rgba(0,0,0,.08);
      border-top-left-radius:12px; border-bottom-left-radius:12px; transform:translateX(110%); transition:transform .25s; z-index:9999; display:flex; flex-direction:column;
    }
    .offre-sidebar.open{ transform:translateX(0); }
    .offre-header{ display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-bottom:1px solid #eee; }
    .offre-header h3{ margin:0; font-size:18px; font-weight:700; color:#2a2a2a; }
    .offre-close{ background:#d71920; color:#fff; border:none; width:32px; height:32px; border-radius:8px; font-size:18px; cursor:pointer; }
    .offre-body{ padding:14px 16px; overflow:auto; flex:1; }
    .offre-block{ margin-bottom:8px; }
    .offre-label{ font-weight:700; font-size:14px; margin-bottom:6px; color:#333; }
    .offre-value{ font-size:14px; color:#333; background:transparent; border:none; padding:0; }
    .offre-line{ font-size:14px; color:#333; padding:0; }
    .offre-key{ font-weight:600; }
    .offre-sub{ font-size:13px; color:#555; margin-top:6px; }
    .offre-sep{ border:none; height:1px; background:#e6e0cf; margin:12px 0; }
    .offre-footer{ border-top:none; background:transparent; text-align:center; padding:16px 0 22px; }
    .offre-download{ display:inline-flex; align-items:center; justify-content:center; gap:8px; width:auto; background:#d71920; color:#fff; border:none; padding:10px 18px; border-radius:8px; font-weight:700; cursor:pointer; }
  </style>
</head>
<body>
  <div class="content-block">
    <div class="accordion-container">
      <!-- Tabs -->
      <div class="accordion-tabs">
        <button class="tab-btn active" data-tab="tab1"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/5326531.png" alt="Icon"> Mémoires Proposés</button>
        <button class="tab-btn" data-tab="tab2"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/6427283.png" alt="Icon"> Offres d'emplois</button>
        <button class="tab-btn" data-tab="tab3"><img src="/wp-content/plugins/plateforme-master/images/icon etudiant/1945674.png" alt="Icon"> Offres des stages</button>
      </div>

      <div class="accordion-content">
        <!-- ========= ONGLET 1 : Mémoires Proposés ========= -->
        <div id="tab1" class="tab-panel active">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-domain">
                  <option value="">Intelligence Artificielle</option>
                  <option>Réseaux</option>
                  <option>Big Data</option>
                  <option>Cybersécurité</option>
                </select>
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-period">
                <input type="text" id="f-periode" placeholder="Période">
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-regular fa-calendar"></i>
              </label>
            </div>
          </div>

          <table id="projetsTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px" />
              <col style="width:120px" />
              <col style="width:48%" />
              <col style="width:22%" />
              <col style="width:12%" />
              <col style="width:64px" />
            </colgroup>
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>Date De Publication</th>
                <th>Titre du projet</th>
                <th>Domaine</th>
                <th>Période</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td>13-01-2025</td>
                <td><a href="#" class="titre-offre" data-id="1">Optimisation des réseaux de neurones pour la détection des fraudes financières</a></td>
                <td>Intelligence Artificielle</td>
                <td>6 mois</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="1"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td>13-01-2025</td>
                <td><a href="#" class="titre-offre" data-id="2">Développement d’un chatbot intelligent pour l’assistance client</a></td>
                <td>Intelligence Artificielle</td>
                <td>3 mois</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="2"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td>16-01-2025</td>
                <td><a href="#" class="titre-offre" data-id="3">Prédiction des comportements d’achat en ligne à l’aide des modèles de machine learning supervisés</a></td>
                <td>Intelligence Artificielle</td>
                <td>6 mois</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="3"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td>27-01-2025</td>
                <td><a href="#" class="titre-offre" data-id="4">Analyse des sentiments dans les réseaux sociaux</a></td>
                <td>Intelligence Artificielle</td>
                <td>6 mois</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="4"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- ===== Sidebar Détails de l'offre (tab1) ===== -->
          <div id="offreSidebarOverlay" class="offre-overlay"></div>
          <aside id="offreSidebar" class="offre-sidebar">
            <div class="offre-header">
              <h3>Détails du memoire</h3>
              <button type="button" class="offre-close" aria-label="Fermer">✕</button>
            </div>
            <div class="offre-body">
              <div class="offre-block">
                <div class="offre-label">Intitulé de mémoire :</div>
                <div class="offre-value" id="sb-intitule"></div>
                <div class="offre-sub" id="sb-sousintitule"></div>
                <hr class="offre-sep">
                <div class="offre-label">Description :</div>
                <div class="offre-value" id="sb-description"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Compétences requises :</div>
                <div class="offre-value" id="sb-competences"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Période :</div>
                <div class="offre-value" id="sb-periode"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Contact :</div>
                <div class="offre-line"><span class="offre-key">Email :</span> <span id="sb-email"></span></div>
              </div>
            </div>
            <div class="offre-footer">
              <button class="offre-download"><i class="fa fa-download"></i> Télécharger le fichier de l'offre</button>
            </div>
          </aside>
        </div>

        <!-- ========= ONGLET 2 : Offres d'emplois ========= -->
        <div id="tab2" class="tab-panel">
          <div class="table-controls">
            <div class="filters-row">
              <label class="ctl ctl-search">
                <input type="text" id="f-q-emploi" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-experience">
                  <option value="">Expérience</option>
                  <option>Débutant</option>
                  <option>1-2 ans</option>
                  <option>3-5 ans</option>
                  <option>5+ ans</option>
                </select>
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
              <label class="ctl ctl-select">
                <select id="f-niveau-etude">
                  <option value="">Niveau d'étude</option>
                  <option>M1</option>
                  <option>M2</option>
                  <option>Doctorat</option>
                  <option>Autres</option>
                </select>
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
            </div>
          </div>

          <table id="emploisTable" class="styled-table" style="width:100%">
            <colgroup>
              <col style="width:42px" />
              <col style="width:25%" />
              <col style="width:20%" />
              <col style="width:15%" />
              <col style="width:15%" />
              <col style="width:15%" />
              <col style="width:64px" />
            </colgroup>
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>Titre</th>
                <th>Entreprise</th>
                <th>Expérience</th>
                <th>Niveau d'études</th>
                <th>Date d'expiration</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="titre-offre" data-id="emploi1">Data Scientist - IA</a></td>
                <td>Click ERP</td>
                <td>Débutant</td>
                <td>M2 en IA</td>
                <td>30-06-2025</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="emploi1"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="titre-offre" data-id="emploi2">Ingénieur en Machine Learning</a></td>
                <td>Tech Innovate</td>
                <td>1-2 ans</td>
                <td>M2 en Informatique</td>
                <td>15-07-2025</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details" data-id="emploi2"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- ===== Sidebar Emploi (tab2) ===== -->
          <div id="offreEmploiSidebarOverlay" class="offre-overlay"></div>
          <aside id="offreEmploiSidebar" class="offre-sidebar">
            <div class="offre-header">
              <h3>Détails de l'offre d'emploi</h3>
              <button type="button" class="offre-close" aria-label="Fermer">✕</button>
            </div>
            <div class="offre-body">
              <div class="offre-block">
                <div class="offre-label">Intitulé de l'offre :</div>
                <div class="offre-value" id="sb-emploi-intitule"></div>
                <div class="offre-sub" id="sb-emploi-sousintitule"></div>
                <hr class="offre-sep">
                <div class="offre-label">Entreprise :</div>
                <div class="offre-value" id="sb-emploi-entreprise"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Description :</div>
                <div class="offre-value" id="sb-emploi-description"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Compétences requises :</div>
                <div class="offre-value" id="sb-emploi-competences"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Expérience :</div>
                <div class="offre-value" id="sb-emploi-experience"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Niveau d'études :</div>
                <div class="offre-value" id="sb-emploi-niveau"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Date d'expiration :</div>
                <div class="offre-value" id="sb-emploi-expiration"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Contact :</div>
                <div class="offre-line"><span class="offre-key">Email :</span> <span id="sb-emploi-email"></span></div>
              </div>
            </div>
            <div class="offre-footer">
              <button class="offre-download"><i class="fa fa-download"></i> Télécharger le fichier de l'offre</button>
            </div>
          </aside>
        </div>

        <!-- ========= ONGLET 3 : Offres des stages ========= -->
        <div id="tab3" class="tab-panel">
          <div class="table-controls">
            <div class="filters-row">
              <!-- Recherche -->
              <label class="ctl ctl-search">
                <input type="text" id="f-q-stage" placeholder="Recherche...">
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-magnifying-glass"></i>
              </label>
              <!-- Type de stage -->
              <label class="ctl ctl-select">
                <select id="f-type-stage">
                  <option value="">Type de stage</option>
                  <option>Obligatoire</option>
                  <option>Non Obligatoire</option>
                </select>
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
              <!-- Date (placeholder simple) -->
              <label class="ctl ctl-select">
                <select id="f-date-stage">
                  <option value="">Date</option>
                  <option>Janvier 2025</option>
                  <option>Mai 2025</option>
                  <option>Juin 2025</option>
                </select>
                <span class="sep" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down"></i>
              </label>
            </div>
          </div>

          <table id="stagesTable" class="styled-table" style="width:100%">
            
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>Titre</th>
                <th>Entreprise</th>
                <th>Type de stage</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Ligne 1 (comme la maquette) -->
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="titre-offre" data-id="stage1">Data Scientist - IA</a></td>
                <td>Click ERP</td>
                <td>Obligatoire</td>
                <td>30 mai 2025</td>
                <td>30 juin 2025</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details-stage" data-id="stage1"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
              <!-- Ligne 2 (proposition) -->
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="titre-offre" data-id="stage2">Développeur NLP (Natural Language Processing)</a></td>
                <td>AI Solutions Lab</td>
                <td>Non Obligatoire</td>
                <td>30 janvier 2025</td>
                <td>30 mai 2025</td>
                <td>
                  <div class="actions">
                    <button class="action-btn" title="Actions" aria-label="Actions"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu">
                      <a href="#"><i class="fa fa-download"></i> Télécharger</a>
                      <a href="#" class="voir-details-stage" data-id="stage2"><i class="fa fa-eye"></i> Voir détails</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- ===== Sidebar Stage (tab3) ===== -->
          <div id="offreStageSidebarOverlay" class="offre-overlay"></div>
          <aside id="offreStageSidebar" class="offre-sidebar">
            <div class="offre-header">
              <h3>Détails de l'offre de stage</h3>
              <button type="button" class="offre-close" aria-label="Fermer">✕</button>
            </div>
            <div class="offre-body">
              <div class="offre-block">
                <div class="offre-label">Intitulé :</div>
                <div class="offre-value" id="sb-stage-intitule"></div>
                <div class="offre-sub" id="sb-stage-sousintitule"></div>
                <hr class="offre-sep">
                <div class="offre-label">Entreprise :</div>
                <div class="offre-value" id="sb-stage-entreprise"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Description :</div>
                <div class="offre-value" id="sb-stage-description"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Type de stage :</div>
                <div class="offre-value" id="sb-stage-type"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Période :</div>
                <div class="offre-value" id="sb-stage-periode"></div>
              </div>
              <hr class="offre-sep">
              <div class="offre-block">
                <div class="offre-label">Contact :</div>
                <div class="offre-line"><span class="offre-key">Email :</span> <span id="sb-stage-email"></span></div>
              </div>
            </div>
            <div class="offre-footer">
              <button class="offre-download"><i class="fa fa-download"></i> Télécharger le fichier de l'offre</button>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery + DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
  <script>
    /* ===== Onglets ===== */
    document.querySelectorAll('.tab-btn').forEach(button => {
      button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));
        button.classList.add('active');
        document.getElementById(tabId).classList.add('active');
      });
    });

    /* ===== Menus "..." ===== */
    document.addEventListener('click', function (e) {
      if (e.target.closest('.action-btn')) {
        const wrap = e.target.closest('.actions');
        const menu = wrap.querySelector('.dropdown-menu');
        document.querySelectorAll('.dropdown-menu').forEach(m => { if (m !== menu) m.style.display = 'none'; });
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        e.stopPropagation();
        return;
      }
      document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
    });

    /* ===== DataTables init ===== */
    $(document).ready(function () {
    $('#projetsTable').DataTable({
      paging: true,
      searching: false,
      ordering: false,
      info: false,
      pageLength: 4,          // 4 lignes / page comme la capture
      lengthChange: false,    // pas de sélecteur "lignes par page"
      pagingType: 'full_numbers', // affiche « premier / prec / numéros / suiv / dernier »
      language: {
        paginate: {
          first:  '<i class="fa fa-angle-double-left"></i>',
          previous:'<i class="fa fa-angle-left"></i>',
          next:    '<i class="fa fa-angle-right"></i>',
          last:   '<i class="fa fa-angle-double-right"></i>'
        },
        emptyTable: "Aucune donnée disponible"
      }
    });
  });
  $(document).ready(function () {
    $('#stagesTable').DataTable({
      paging: true,
      searching: false,
      ordering: false,
      info: false,
      pageLength: 4,          // 4 lignes / page comme la capture
      lengthChange: false,    // pas de sélecteur "lignes par page"
      pagingType: 'full_numbers', // affiche « premier / prec / numéros / suiv / dernier »
      language: {
        paginate: {
          first:  '<i class="fa fa-angle-double-left"></i>',
          previous:'<i class="fa fa-angle-left"></i>',
          next:    '<i class="fa fa-angle-right"></i>',
          last:   '<i class="fa fa-angle-double-right"></i>'
        },
        emptyTable: "Aucune donnée disponible"
      }
    });
  });
$(document).ready(function () {
    $('#emploisTable').DataTable({
      paging: true,
      searching: false,
      ordering: false,
      info: false,
      pageLength: 4,          // 4 lignes / page comme la capture
      lengthChange: false,    // pas de sélecteur "lignes par page"
      pagingType: 'full_numbers', // affiche « premier / prec / numéros / suiv / dernier »
      language: {
        paginate: {
          first:  '<i class="fa fa-angle-double-left"></i>',
          previous:'<i class="fa fa-angle-left"></i>',
          next:    '<i class="fa fa-angle-right"></i>',
          last:   '<i class="fa fa-angle-double-right"></i>'
        },
        emptyTable: "Aucune donnée disponible"
      }
    });
  });
    /* ===== Données Sidebars ===== */
    const OFFRES = {
      1:{ intitule:'Optimisation des réseaux de neurones pour la détection des fraudes financières', sousintitule:"Application d'algorithmes d'apprentissage profond", description:"Dans le cadre de ce stage, l’étudiant(e) sera amené(e) à développer un modèle de détection des fraudes financières en utilisant des réseaux de neurones optimisés...", competences:'Python, TensorFlow/PyTorch, Data Science, Machine Learning, Analyse de données.', periode:'6 mois', email:'offre@gmail.com' },
      2:{ intitule:'Développement d’un chatbot intelligent pour l’assistance client', sousintitule:'NLP, RAG et intégration back-office', description:"Conception d’un chatbot basé NLP pour l’assistance client...", competences:'Python/JS, NLP, spaCy/HF, APIs, intégration web.', periode:'3 mois', email:'offre@gmail.com' },
      3:{ intitule:'Prédiction des comportements d’achat en ligne', sousintitule:'Modèles supervisés et features marketing', description:'Mise en place d’un pipeline ML supervisé...', competences:'Python, scikit-learn, SQL, visualisation.', periode:'6 mois', email:'offre@gmail.com' },
      4:{ intitule:'Analyse des sentiments dans les réseaux sociaux', sousintitule:'Pipeline NLP et tableaux de bord', description:'Collecte et analyse de posts/avis...', competences:'Python, NLP, scraping, visualisation.', periode:'6 mois', email:'offre@gmail.com' },
    };

    const OFFRES_EMPLOIS = {
      emploi1:{ intitule:'Data Scientist - IA', sousintitule:'Analyse de données et modélisation IA', entreprise:'Click ERP', description:"Rejoignez notre équipe pour développer des solutions d'IA...", competences:'Python, R, TensorFlow, SQL, Data Visualisation', experience:'Débutant', niveau:'M2 en IA', expiration:'30-06-2025', email:'recrutement@clickerp.com' },
      emploi2:{ intitule:'Ingénieur en Machine Learning', sousintitule:'Développement de modèles ML avancés', entreprise:'Tech Innovate', description:"Participez à la conception et au déploiement de modèles ML...", competences:'Python, PyTorch, scikit-learn, Cloud Computing', experience:'1-2 ans', niveau:'M2 en Informatique ou équivalent', expiration:'15-07-2025', email:'jobs@techinnovate.com' },
    };

    const OFFRES_STAGES = {
      stage1:{ intitule:'Data Scientist - IA', sousintitule:'Stage en Data Science appliquée', entreprise:'Click ERP', description:"Contribution aux analyses de données et modèles prédictifs liés aux processus métier.", type:'Obligatoire', periode:'30 mai 2025 → 30 juin 2025', email:'stages@clickerp.com' },
      stage2:{ intitule:'Développeur NLP (Natural Language Processing)', sousintitule:'Traitement automatique du langage', entreprise:'AI Solutions Lab', description:"Mise en place de pipelines NLP et prototypage de modèles.", type:'Non Obligatoire', periode:'30 janvier 2025 → 30 mai 2025', email:'interns@aisolutionslab.com' },
    };

    /* ===== Sidebars ===== */
    const sb = {
      panel: document.getElementById('offreSidebar'),
      overlay: document.getElementById('offreSidebarOverlay'),
      fill: d => {
        document.getElementById('sb-intitule').textContent = d.intitule||'';
        document.getElementById('sb-sousintitule').textContent = d.sousintitule||'';
        document.getElementById('sb-description').textContent = d.description||'';
        document.getElementById('sb-competences').textContent = d.competences||'';
        document.getElementById('sb-periode').textContent = d.periode||'';
        document.getElementById('sb-email').textContent = d.email||'';
      },
      open: id => { const d = OFFRES[id]; if(!d) return; sb.fill(d); sb.panel.classList.add('open'); sb.overlay.classList.add('open'); },
      close: () => { sb.panel.classList.remove('open'); sb.overlay.classList.remove('open'); }
    };
    document.querySelector('#offreSidebar .offre-close').addEventListener('click', sb.close);
    document.getElementById('offreSidebarOverlay').addEventListener('click', sb.close);

    const sbEmploi = {
      panel: document.getElementById('offreEmploiSidebar'),
      overlay: document.getElementById('offreEmploiSidebarOverlay'),
      fill: d => {
        document.getElementById('sb-emploi-intitule').textContent = d.intitule||'';
        document.getElementById('sb-emploi-sousintitule').textContent = d.sousintitule||'';
        document.getElementById('sb-emploi-entreprise').textContent = d.entreprise||'';
        document.getElementById('sb-emploi-description').textContent = d.description||'';
        document.getElementById('sb-emploi-competences').textContent = d.competences||'';
        document.getElementById('sb-emploi-experience').textContent = d.experience||'';
        document.getElementById('sb-emploi-niveau').textContent = d.niveau||'';
        document.getElementById('sb-emploi-expiration').textContent = d.expiration||'';
        document.getElementById('sb-emploi-email').textContent = d.email||'';
      },
      open: id => { const d = OFFRES_EMPLOIS[id]; if(!d) return; sbEmploi.fill(d); sbEmploi.panel.classList.add('open'); sbEmploi.overlay.classList.add('open'); },
      close: () => { sbEmploi.panel.classList.remove('open'); sbEmploi.overlay.classList.remove('open'); }
    };
    document.querySelector('#offreEmploiSidebar .offre-close').addEventListener('click', sbEmploi.close);
    document.getElementById('offreEmploiSidebarOverlay').addEventListener('click', sbEmploi.close);

    const sbStage = {
      panel: document.getElementById('offreStageSidebar'),
      overlay: document.getElementById('offreStageSidebarOverlay'),
      fill: d => {
        document.getElementById('sb-stage-intitule').textContent = d.intitule||'';
        document.getElementById('sb-stage-sousintitule').textContent = d.sousintitule||'';
        document.getElementById('sb-stage-entreprise').textContent = d.entreprise||'';
        document.getElementById('sb-stage-description').textContent = d.description||'';
        document.getElementById('sb-stage-type').textContent = d.type||'';
        document.getElementById('sb-stage-periode').textContent = d.periode||'';
        document.getElementById('sb-stage-email').textContent = d.email||'';
      },
      open: id => { const d = OFFRES_STAGES[id]; if(!d) return; sbStage.fill(d); sbStage.panel.classList.add('open'); sbStage.overlay.classList.add('open'); },
      close: () => { sbStage.panel.classList.remove('open'); sbStage.overlay.classList.remove('open'); }
    };
    document.querySelector('#offreStageSidebar .offre-close').addEventListener('click', sbStage.close);
    document.getElementById('offreStageSidebarOverlay').addEventListener('click', sbStage.close);

    /* ===== Click handlers ===== */
    // Tab1
    document.querySelectorAll('#projetsTable a.titre-offre').forEach(a=>{
      a.addEventListener('click',e=>{ e.preventDefault(); sb.open(a.getAttribute('data-id')); });
    });
    document.querySelectorAll('#projetsTable a.voir-details').forEach(a=>{
      a.addEventListener('click',e=>{
        e.preventDefault(); e.stopPropagation();
        document.querySelectorAll('.dropdown-menu').forEach(m=>m.style.display='none');
        sb.open(a.getAttribute('data-id'));
      });
    });
    // Tab2
    document.querySelectorAll('#emploisTable a.titre-offre').forEach(a=>{
      a.addEventListener('click',e=>{ e.preventDefault(); sbEmploi.open(a.getAttribute('data-id')); });
    });
    document.querySelectorAll('#emploisTable a.voir-details').forEach(a=>{
      a.addEventListener('click',e=>{
        e.preventDefault(); e.stopPropagation();
        document.querySelectorAll('.dropdown-menu').forEach(m=>m.style.display='none');
        sbEmploi.open(a.getAttribute('data-id'));
      });
    });
    // Tab3
    document.querySelectorAll('#stagesTable a.titre-offre').forEach(a=>{
      a.addEventListener('click',e=>{ e.preventDefault(); sbStage.open(a.getAttribute('data-id')); });
    });
    document.querySelectorAll('#stagesTable a.voir-details-stage').forEach(a=>{
      a.addEventListener('click',e=>{
        e.preventDefault(); e.stopPropagation();
        document.querySelectorAll('.dropdown-menu').forEach(m=>m.style.display='none');
        sbStage.open(a.getAttribute('data-id'));
      });
    });
  </script>
</body>
</html>
