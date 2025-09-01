<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Plateforme Master — Soutenances</title>
<style>
:root{
  --ink:#2A2916; --muted:#777568; --line:#EBE9D7; --head:#ECEBE3;
  --red:#BF0404; font-family:Roboto, "Segoe UI", sans-serif;
}
body{margin:0;background:#f3f3f1}
.content-block{margin:28px auto;padding:0 10px}

/* Onglets */
.tabs{display:flex;gap:10px}
.tab-btn{flex:1;background:#A6A485;color:#fff;border:none;border-radius:10px 10px 0 0;padding:12px;font-weight:600;cursor:pointer}
.tab-btn.active{background:#fff;color:var(--ink)}
.panel{display:none;background:#fff;border-radius:0 10px 10px 10px;box-shadow:0 2px 6px rgba(0,0,0,.06);padding:14px}
.panel.active{display:block}

/* Toolbar */
.toolbar{display:flex;align-items:center;gap:10px;margin:12px 0}

/* Recherche */
.search{position:relative;display:flex;align-items:center;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:6px;height:36px;padding:0 10px;width:300px}
.search input{flex:1;border:0;outline:0;background:transparent;font-size:14px;color:#2A2916;padding-right:36px}
.search input::placeholder{font:normal normal normal 14px/17px Roboto;color:#A6A59F;text-transform:capitalize;opacity:1}
.search .sbtn{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:24px;height:24px;border:0;background:transparent;padding:0;cursor:pointer}
.search .sbtn svg{width:24px;height:24px;display:block}

/* Selects */
.sel{position:relative;display:flex;align-items:center;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;height:40px;padding:0 12px;width:170px}
.sel.sel-sm{width:150px}
.sel select{flex:1;border:0;outline:0;background:transparent;font-size:14px;appearance:none;padding-right:36px;font:normal normal normal 14px/17px Roboto;color:#A6A59F;text-transform:capitalize}
.sel::before{content:"";position:absolute;right:36px;top:9px;width:1px;height:22px;background:#DBD9C3}
.sel .chev{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;pointer-events:none}

/* Boutons */
.btn-download{margin-left:auto;width:30px;height:30px;border:0;border-radius:5px;background:#FFFFFF;cursor:pointer;box-shadow:0 0 6px #00000030;display:flex;align-items:center;justify-content:center}
.btn-download img{width:14px;height:14px}
.btn-primary{background:var(--red);color:#fff;border:1px solid var(--red);border-radius:6px;height:36px;padding:0 14px;font-weight:600;cursor:pointer}

/* Tables génériques */
.table-wrap{margin-top:14px}
.tbl-head,.tbl-body{width:100%;table-layout:fixed;border-collapse:separate;border-spacing:0}
.tbl-head{background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;overflow:hidden}
.tbl-head th{height:45px;font-weight:700;font-size:14px;color:var(--ink);padding:12px 10px;text-align:left;border:none}
.tbl-head th:nth-child(1),.tbl-body td:nth-child(1){text-align:center}
.tbl-body{background:#FFFFFF;border:2px solid #EBE9D7;border-radius:8px;overflow:visible;position:relative}
.tbl-body td{font-size:14px;color:var(--ink);padding:12px 10px;vertical-align:middle;background:#fff;border-right:1px solid #ECEBE3;border-bottom:1px solid #ECEBE3}
.tbl-body tr:last-child td{border-bottom:none}
.tbl-body td:last-child{border-right:none}
.tbl-gap{height:8px}

/* Tooltip état (onglets 1/3/4 anciens) */
.etat-icon{width:16px;height:16px;display:inline-block;vertical-align:middle}
.etat-tip{position:relative;display:inline-block}
.etat-tip .tt{position:absolute;left:50%;transform:translateX(-50%);bottom:calc(100% + 6px);width:75px;height:30px;background:#fff;border:.5px solid #2A2916;border-radius:4px;display:flex;align-items:center;justify-content:center;font:normal 13px/15px Roboto;color:#2A2916;text-transform:capitalize;opacity:0;pointer-events:none;transition:opacity .15s ease,transform .15s ease;z-index:10;box-shadow:0 2px 6px rgba(0,0,0,.08)}
.etat-tip:hover .tt{opacity:1;transform:translateX(-50%) translateY(-4px)}

/* Icône action générique + bouton ⋯ */
.action-icon{width:14px;height:14px;cursor:pointer}
.dots-btn{display:inline-flex;align-items:center;justify-content:center;background:transparent;border:0;padding:0;cursor:pointer;font-size:20px;line-height:1;color:#2A2916}
.dots-btn:focus{outline:none}

/* Menus contextuels */
.ctx-menu{position:absolute;z-index:2000;min-width:180px;background:#fff;border:1px solid #DBD9C3;border-radius:8px;box-shadow:0 8px 18px rgba(0,0,0,.12);padding:6px 0;display:none}
.ctx-menu.show{display:block}
.ctx-item{display:flex;align-items:center;gap:10px;padding:8px 12px;font:normal 14px/18px Roboto;color:#2A2916;cursor:pointer}
.ctx-item + .ctx-item{border-top:1px solid #EBE9D7}
.ctx-item:hover{background:#F7F7F3}
.ctx-item svg{width:16px;height:16px}

/* Pagination */
.pager{display:flex;gap:6px;justify-content:flex-end;margin-top:12px}
.pbtn{width:32px;height:32px;border:2px solid #BF0404;background:#fff;color:#BF0404;border-radius:6px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px}
.pnum{min-width:30px;text-align:center;line-height:32px;font-weight:400;color:#000}

/* Offcanvas générique */
.ocv-overlay{position:fixed; inset:0; background:rgba(0,0,0,.35); opacity:0; pointer-events:none; transition:opacity .2s ease; z-index:99999}
.ocv-overlay.show{opacity:1; pointer-events:auto;}
.offcanvas{position:fixed; top:0; right:-450px; width:450px; height:100vh; background:#fff; box-shadow:-6px 0 16px rgba(0,0,0,.16); display:flex; flex-direction:column; transition:right .25s ease; z-index:100000}
.offcanvas.show{ right:0; }
body.no-scroll{ overflow:hidden; }
.ocv-head{height:60px;background:#FFFFFF;box-shadow:0px 5px 16px #00000029;display:flex;align-items:center;justify-content:space-between;padding:0 16px}
.ocv-title{margin:0;font:normal normal bold 18px/24px Roboto;color:#2A2916}
.ocv-save{min-width:108px;height:35px;background:#BF0404;border:1px solid #BF0404;border-radius:18px;color:#FFFFFF;font:normal normal 14px/20px Roboto;cursor:pointer;padding:0 14px}
.ocv-body{padding:16px;overflow:auto;margin-top:20px}
.field,.field-select{width:395px;height:40px;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;display:flex;align-items:center;padding:0 12px;margin-bottom:12px}
.field input{flex:1;border:0;outline:0;background:transparent;font-size:14px;color:#2A2916}
.field input::placeholder{font:normal normal normal 14px/17px Roboto;color:#A6A59F;text-transform:capitalize}
.field-row{display:flex;gap:15px}
.field.icon-split{width:190px;height:35px;padding-right:36px;position:relative}
.field.icon-split .split{position:absolute;right:36px;top:9px;width:1px;height:17px;background:#DBD9C3}
.field.icon-split .icon{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px}
.field-select{position:relative;padding-right:36px}
.field-select select{flex:1;border:0;outline:0;background:transparent;font-size:12px;color:#6E6D55;appearance:none}
.field-select .split{position:absolute;right:36px;top:11px;width:1px;height:17px;background:#6E6D55}
.field-select .icon{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:10px;height:10px;pointer-events:none}
.field-select select.placeholder{font:normal normal normal 14px/17px Roboto;color:#A6A59F;text-transform:capitalize}
#etatBlock{margin-top:18px}
#etatBlock .ttl{font-weight:700;margin:8px 0 10px;color:#2A2916}
.state-list{display:flex;flex-direction:column;gap:10px}
.state-item{display:flex;align-items:center;gap:8px;font:normal normal normal 14px/17px Roboto;color:#2A2916}
#etatBlock .state-item img{display:none}
#etatBlock .state-item input[type="radio"]{width:16px;height:16px;accent-color:#6E6D55}

/* Spécifique onglet 3 */
.tbl-head.designations th:nth-child(7),
.tbl-body.designations td:nth-child(7),
.tbl-head.designations th:nth-child(8),
.tbl-body.designations td:nth-child(8){text-align:center}
.tbl-head.designations th.status .th-label{display:inline-flex;align-items:center;gap:6px;margin-left:-40px}
.tbl-head.designations th.status .th-icon{width:16px;height:16px;display:block}
.designations .etat-ok{width:14px;height:14px}
.designations .etat-wait{width:18px;height:18px}

/* Offcanvas jury (onglet 3) – scrollbar masquée et 1ère section collée */
.ocv-body.jury{padding:0;overflow:auto;scrollbar-width:none;-ms-overflow-style:none}
.ocv-body.jury::-webkit-scrollbar{width:0;height:0}
.ocv-body.jury .acc-section:first-child{margin-top:0}
.acc-section{margin-top:12px}
.acc-section.collapsed .acc-body{display:none}
.acc-head{display:flex;align-items:center;justify-content:space-between;height:50px;padding:0 16px;background:#FFFFFF;box-shadow:0px 3px 13px #00000017;color:#2A2916;font-weight:700;cursor:pointer}
.acc-chev{width:16px;height:16px;transition:transform .2s ease}
.acc-section.collapsed .acc-chev{transform:rotate(180deg)}
.acc-body{padding:10px 16px 12px}
.acc-note{font-size:12px;color:#6E6D55;margin:6px 16px 8px}
.jperson{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--line)}
.jperson:last-child{border-bottom:none}
.jperson img.avatar{width:32px;height:32px;border-radius:50%;object-fit:cover}
.jmeta{display:flex;flex-direction:column}
.jname{font-weight:600;color:#2A2916;font-size:14px;line-height:18px}
.jtitle{color:#6E6D55;font-size:12px;line-height:16px}
.jcheck{width:16px;height:16px}

/* Onglet 4 — nouveaux looks */
.tbl-head.results th:nth-child(6),
.tbl-body.results td:nth-child(6){text-align:center}
.tbl-head.results th:nth-child(8),
.tbl-body.results td:nth-child(8){text-align:center}
.chip{display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:999px;font-size:12px;line-height:16px;background:#fff;border:1px solid #29A544;color:#29A544}
.chip svg{width:14px;height:14px}
.list-jurys{display:flex;flex-direction:column;gap:2px}
.list-jurys div{white-space:nowrap}

/* Menu filtre Statut */
.status-menu{position:absolute;z-index:3000;min-width:170px;background:#fff;border:1px solid #DBD9C3;border-radius:10px;box-shadow:0 10px 18px rgba(0,0,0,.15);padding:6px 0;display:none}
.status-menu.show{display:block}
.status-item{display:flex;align-items:center;gap:10px;padding:8px 12px;font:normal 14px/18px Roboto;color:#2A2916;cursor:pointer}
.status-item + .status-item{border-top:1px solid #EBE9D7}
.status-item:hover{background:#F7F7F3}
.status-box{width:16px;height:16px;border:2px solid #1C274C;border-radius:4px;display:inline-block;position:relative}
.status-item.active .status-box{border-color:var(--red)}
.status-item.active .status-box::after{content:"";position:absolute;left:2px;top:1px;width:10px;height:6px;border-left:2px solid var(--red);border-bottom:2px solid var(--red);transform:rotate(-45deg)}

/* >>> Harmonisation taille icône "Statut" onglet 2 (même que onglet 3) <<< */
/* T2 : "Statut" + icône alignés côte à côte */
.tbl-head.memoires th.status .th-label{
  display:inline-flex;
  align-items:center;
  gap:6px;              /* espace entre le mot et l’icône */
  white-space:nowrap;   /* empêche le retour à la ligne */
  margin-left:-24px;    /* décale le bloc vers la gauche (ajuste la valeur si besoin) */
}
.tbl-head.memoires th.status .th-icon{
  width:16px; height:16px; display:block; flex:0 0 16px; cursor:pointer;
}

/* T3 : même rendu pour cohérence (si pas déjà fait) */
.tbl-head.designations th.status .th-label{
  display:inline-flex;
  align-items:center;
  gap:6px;
  white-space:nowrap;
  /* laisse ou ajuste ton margin-left existant si tu veux le même décalage */
}
.tbl-head.designations th.status .th-icon{
  width:16px; height:16px; display:block; flex:0 0 16px; cursor:pointer;
}

</style>
</head>
<body>

<div class="content-block">
  <div class="tabs">
    <button class="tab-btn active" data-tab="t1">Calendrier</button>
    <button class="tab-btn" data-tab="t2">Mémoires déposés</button>
    <button class="tab-btn" data-tab="t3">Désignation des jurys</button>
    <button class="tab-btn" data-tab="t4">Résultats des soutenances</button>
  </div>

  <div id="t1" class="panel active"></div>
  <div id="t2" class="panel"></div>
  <div id="t3" class="panel"></div>
  <div id="t4" class="panel"></div>
</div>

<!-- Offcanvas générique -->
<div id="ocvOverlay" class="ocv-overlay"></div>
<aside id="offcanvas" class="offcanvas" aria-hidden="true">
  <div class="ocv-head">
    <h3 id="ocvTitle" class="ocv-title">Programmer une soutenance</h3>
    <button id="ocvSave" class="ocv-save">Enregistrer</button>
  </div>
  <div class="ocv-body">
    <label class="field"><input type="text" placeholder="Etudiant" id="f_etu"></label>
    <label class="field"><input type="text" placeholder="Salle" id="f_salle"></label>
    <div class="field-row">
      <label class="field icon-split">
        <input type="text" placeholder="Date" id="f_date">
        <span class="split"></span>
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-calendar.png" alt="">
      </label>
      <label class="field icon-split">
        <input type="text" placeholder="Temps" id="f_time">
        <span class="split"></span>
        <img class="icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/.-blaack.png" alt="">
      </label>
    </div>
    <label class="field-select">
      <select id="f_encadrant">
        <option value="" selected>Encadrant</option>
        <option>Ridha Mahjoub</option>
        <option>Hatem Chaieb</option>
      </select>
      <span class="split"></span>
      <img class="icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-chevron-down.png" alt="">
    </label>
    <label class="field-select">
      <select id="f_j1">
        <option value="" selected>Jury 1</option>
        <option>Aali Ben Ahmed</option>
        <option>Manel Ben Ghanem</option>
        <option>Ahlem Drissi</option>
        <option>Sonia Mahjoub</option>
      </select>
      <span class="split"></span>
      <img class="icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-chevron-down.png" alt="">
    </label>
    <label class="field-select">
      <select id="f_j2">
        <option value="" selected>Jury 2</option>
        <option>Aali Ben Ahmed</option>
        <option>Manel Ben Ghanem</option>
        <option>Ahlem Drissi</option>
        <option>Sonia Mahjoub</option>
      </select>
      <span class="split"></span>
      <img class="icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-chevron-down.png" alt="">
    </label>
    <div id="etatBlock" hidden>
      <div class="ttl">Etat de validation</div>
      <div class="state-list">
        <label class="state-item"><input type="radio" name="etat" value="attente"><span>En attente</span></label>
        <label class="state-item"><input type="radio" name="etat" value="valide"><span>Validée</span></label>
        <label class="state-item"><input type="radio" name="etat" value="ajournee"><span>Ajournée</span></label>
      </div>
    </div>
  </div>
</aside>

<!-- Offcanvas Jury (réutilisé T3 + T4) -->
<aside id="offcanvasJury" class="offcanvas" aria-hidden="true">
  <div class="ocv-head">
    <h3 class="ocv-title">Affecter jurys</h3>
    <button id="ocvJurySave" class="ocv-save">Enregistrer</button>
  </div>
  <div class="ocv-body jury">
    <section id="secJury" class="acc-section">
      <div class="acc-head">
        <div>Sélectionner jurys</div>
        <svg class="acc-chev" viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </div>
      <div class="acc-body">
        <div class="acc-note">2 Maximum</div>
        <div id="juryList"></div>
      </div>
    </section>
    <section id="secPres" class="acc-section">
      <div class="acc-head">
        <div>Sélectionner un President</div>
        <svg class="acc-chev" viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </div>
      <div class="acc-body"><div id="presidentList"></div></div>
    </section>
  </div>
</aside>

<!-- Menus contextuels -->
<div id="ctxMenu" class="ctx-menu" role="menu" aria-hidden="true">
  <div class="ctx-item" data-action="valider">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    Validé le depot
  </div>
  <div class="ctx-item" data-action="corriger">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
    Demande correction
  </div>
  <div class="ctx-item" data-action="pdf">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
    voir le pdf
  </div>
</div>

<!-- Menu ⋯ de l’onglet 3 -->
<div id="ctxMenuT3" class="ctx-menu" role="menu" aria-hidden="true">
  <div class="ctx-item" data-action="affecter-jury">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    Affecter jury
  </div>
  <div class="ctx-item" data-action="edit">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2 2 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
    Edit
  </div>
  <div class="ctx-item" data-action="details">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
    voir details
  </div>
</div>

<!-- Menu ⋯ de l’onglet 4 (offcanvas supprimé) -->
<div id="ctxMenuT4" class="ctx-menu" role="menu" aria-hidden="true">
  <div class="ctx-item" data-action="edit">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 20h9"/><path d="M16.5 3.5a2 2 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
    </svg>
    Edit
  </div>
  <div class="ctx-item" data-action="details">
    <svg viewBox="0 0 24 24" fill="none" stroke="#2A2916" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/>
    </svg>
    voir details
  </div>
</div>

<!-- Menu filtre Statut (onglets 2 & 3) -->
<div id="statusMenu" class="status-menu" role="menu" aria-hidden="true">
  <div class="status-item active" data-value="tous"><span class="status-box"></span> Tous</div>
  <div class="status-item" data-value="attente"><span class="status-box"></span> En attente</div>
  <div class="status-item" data-value="incomplet"><span class="status-box"></span> Incomplet</div>
  <div class="status-item" data-value="valide"><span class="status-box"></span> Validé</div>
</div>

<script>
/* ===== Données ===== */
const rows = [
  {etu:'Ahlem Ben Ghanem', date:'13/01/2025', heure:'10H00', salle:'B02', jury1:'Aali Ben Ahmed', jury2:'Sonia Mahjoub', encadrant:'Ridha Mahjoub', president:'Ridha Mahjoub', etat:'attente'},
  {etu:'Ahlem Ben Ghanem', date:'13/01/2025', heure:'10H30', salle:'B02', jury1:'Manel Ben Ghanem', jury2:'Ahlem Drissi', encadrant:'Hatem Chaieb', president:'Hatem Chaieb', etat:'valide'},
  {etu:'Ahlem Ben Ghanem', date:'13/01/2025', heure:'11H00', salle:'B02', jury1:'Ahlem Drissi', jury2:'Manel Ben Ghanem', encadrant:'Hatem Chaieb', president:'Hatem Chaieb', etat:'ajournee'},
  {etu:'Ahlem Ben Ghanem', date:'13/01/2025', heure:'11H30', salle:'B02', jury1:'Sonia Mahjoub', jury2:'Ahlem Drissi', encadrant:'Ridha Mahjoub', president:'Ridha Mahjoub', etat:'attente'},
];
const memoiresRows = [
  {etu:'Ahlem Ben Ghanem', dateDepot:'13/01/2025', titre:'Détection De Visages Par Apprentissage Profond', encadrant:'Ridha Mahjoub', statut:'valide'},
  {etu:'Ahlem Ben Ghanem', dateDepot:'13/01/2025', titre:'Chatbot Intelligent Pour Le Support Client', encadrant:'Hatem Chaieb', statut:'valide'},
  {etu:'Ahlem Ben Ghanem', dateDepot:'13/01/2025', titre:'Analyse De Sentiments Sur Twitter En IA', encadrant:'Hatem Chaieb', statut:'attente'},
  {etu:'Ahlem Ben Ghanem', dateDepot:'13/01/2025', titre:'Prédiction Des Ventes Avec Le Machine Learning', encadrant:'Ridha Mahjoub', statut:'ajournee'},
];
const resultsRows = [
  {etu:'Ahlem Ben Ghanem', dateS:'12/09/2024', note:14.5, mention:'Bien', validation:'valide', jurys:['Ridha Mahjoub','Hatem Chaieb']},
  {etu:'Ahlem Ben Ghanem', dateS:'12/09/2024', note:11,   mention:'Assez Bien', validation:'valide', jurys:['Hatem Chaieb']},
  {etu:'Ahlem Ben Ghanem', dateS:'12/09/2024', note:16.5, mention:'Très Bien', validation:'valide', jurys:['Ridha Mahjoub']},
  {etu:'Ahlem Ben Ghanem', dateS:'12/09/2024', note:15,   mention:'Très Bien', validation:'valide', jurys:['Ridha Mahjoub','Hatem Chaieb']},
];

/* Icônes état */
function etatIcon(s){if(s==='valide')return`<span class="etat-tip"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe 234.png" class="etat-icon" alt="validée"><span class="tt">validée</span></span>`;if(s==='ajournee')return`<span class="etat-tip"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Composant 415 – 1.png" class="etat-icon" alt="ajournée"><span class="tt">ajournée</span></span>`;return`<span class="etat-tip"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/🎨 Icon Сolor.png" class="etat-icon" alt="en attente"><span class="tt">en attente</span></span>`}
function etatIconMemoire(s){if(s==='valide')return`<img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Composant 414 – 1.png" class="etat-icon etat-ok" alt="validée">`;if(s==='ajournee'||s==='rejete'||s==='rejetee')return`<img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/.red.png" class="etat-icon etat-reject" alt="rejetée">`;return`<img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/🎨 Icon Сolor.png" class="etat-icon etat-wait" alt="en attente">`}
function etatIconDesignation(s){if(s==='valide')return`<img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Composant 414 – 1.png" class="etat-icon etat-ok" alt="validée">`;return`<img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/🎨 Icon Сolor.png" class="etat-icon etat-wait" alt="en attente">`}

/* colgroups utilitaires */
function colgroupHTML(){ return `
  <colgroup>
    <col style="width:44px">
    <col style="width:15%"><col style="width:12%"><col style="width:8%"><col style="width:7%">
    <col style="width:15%"><col style="width:13%"><col style="width:13%">
    <col style="width:10%"><col style="width:7%">
  </colgroup>`; }

/* Rendus onglets 1/2/3/4 */
function renderTable(container){
  container.innerHTML=`
    <div class="toolbar">
      <label class="search">
        <input type="text" placeholder="Recherche…">
        <button class="sbtn" aria-label="Rechercher">
          <svg viewBox="0 0 24 24" fill="#A6A59F"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM10 14a4 4 0 110-8 4 4 0 010 8z"/></svg>
        </button>
      </label>
      <label class="sel">
        <select><option>Salle</option><option>B01</option><option>B02</option><option>B03</option></select>
        <svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg>
      </label>
      <label class="sel">
        <select><option>Encadrant</option><option>Hatem Chaieb</option><option>Ridha Mahjoub</option></select>
        <svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg>
      </label>
      <button class="btn-download" title="Télécharger"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe 152.png" alt="download"></button>
      <button class="btn-primary">Programmer une soutenance</button>
    </div>
    <div class="table-wrap">
      <table class="tbl-head">${colgroupHTML()}<thead><tr>
        <th><input type="checkbox"></th>
        <th>Etudiant</th><th>Date</th><th>Heure</th><th>Salle</th>
        <th>Jury 1</th><th>Jury 2</th><th>Encadrant</th>
        <th>Etat de validation</th><th>Action</th>
      </tr></thead></table>
      <div class="tbl-gap"></div>
      <table class="tbl-body">${colgroupHTML()}<tbody>
        ${rows.map((r,i)=>`
          <tr data-index="${i}">
            <td><input type="checkbox"></td>
            <td>${r.etu}</td><td>${r.date}</td><td>${r.heure}</td><td>${r.salle}</td>
            <td>${r.jury1}</td><td>${r.jury2}</td><td>${r.encadrant}</td>
            <td>${etatIcon(r.etat)}</td>
            <td><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-edit-2.png" class="action-icon" alt="edit"></td>
          </tr>`).join('')}
      </tbody></table>
    </div>
    <div class="pager"><button class="pbtn">«</button><button class="pbtn">‹</button><span class="pnum">2</span><button class="pbtn">›</button><button class="pbtn">»</button></div>`;
}
function renderTab2(container){
  const colgroup = `
    <colgroup>
      <col style="width:44px"><col style="width:18%"><col style="width:12%">
      <col style="width:36%"><col style="width:16%"><col style="width:10%"><col style="width:8%">
    </colgroup>`;
  container.innerHTML = `
    <div class="toolbar">
      <label class="search">
        <input type="text" placeholder="Recherche...">
        <button class="sbtn" aria-label="Rechercher"><svg viewBox="0 0 24 24" fill="#A6A59F"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM10 14a4 4 0 110-8 4 4 0 010 8z"/></svg></button>
      </label>
      <label class="sel sel-sm">
        <select><option>Période</option><option>Cette semaine</option><option>Ce mois</option><option>Cette année</option></select>
        <svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg>
      </label>
      <label class="sel">
        <select><option>Encadrant</option><option>Hatem Chaieb</option><option>Ridha Mahjoub</option></select>
        <svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg>
      </label>
      <button class="btn-download" title="Télécharger"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe 152.png" alt="download"></button>
    </div>
    <div class="table-wrap">
      <table class="tbl-head memoires">${colgroup}
        <thead><tr>
          <th><input type="checkbox"></th><th>Etudiant</th><th>Date Depot</th><th>Titre De Memoire</th><th>Encadrant</th>
          <th class="status"><span class="th-label">Statut <img class="th-icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Composant 271 – 3.png" alt="" style="cursor:pointer"></span></th>
          <th>Action</th>
        </tr></thead></table>
      <div class="tbl-gap"></div>
      <table class="tbl-body memoires">${colgroup}<tbody>
        ${memoiresRows.map((r,i)=>`
          <tr data-index="${i}">
            <td><input type="checkbox"></td><td>${r.etu}</td><td>${r.dateDepot}</td><td>${r.titre}</td><td>${r.encadrant}</td>
            <td>${etatIconMemoire(r.statut)}</td><td><button class="dots-btn" title="Plus">⋯</button></td>
          </tr>`).join('')}
      </tbody></table>
    </div>
    <div class="pager"><button class="pbtn">«</button><button class="pbtn">‹</button><span class="pnum">2</span><button class="pbtn">›</button><button class="pbtn">»</button></div>`;
}
function renderTab3(container){
  const colgroup = `
    <colgroup>
      <col style="width:44px"><col style="width:18%"><col style="width:17%"><col style="width:17%">
      <col style="width:16%"><col style="width:16%"><col style="width:6%"><col style="width:6%">
    </colgroup>`;
  container.innerHTML = `
    <div class="toolbar">
      <label class="search"><input type="text" placeholder="Recherche..."><button class="sbtn" aria-label="Rechercher"><svg viewBox="0 0 24 24" fill="#A6A59F"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM10 14a4 4 0 110-8 4 4 0 010 8z"/></svg></button></label>
      <label class="sel"><select><option>Encadrant</option><option>Hatem Chaieb</option><option>Ridha Mahjoub</option></select><svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg></label>
      <button class="btn-download" title="Télécharger"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe 152.png" alt="download"></button>
    </div>
    <div class="table-wrap">
      <table class="tbl-head designations">${colgroup}
        <thead><tr>
          <th><input type="checkbox"></th><th>Etudiant</th><th>Jury 1</th><th>Jury 2</th><th>Encadrant</th><th>President</th>
          <th class="status"><span class="th-label">Statut <img class="th-icon" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Composant 271 – 3.png" alt="" style="cursor:pointer"></span></th>
          <th>Action</th></tr></thead></table>
      <div class="tbl-gap"></div>
      <table class="tbl-body designations">${colgroup}<tbody>
        ${rows.map((r,i)=>`
          <tr data-index="${i}">
            <td><input type="checkbox"></td><td>${r.etu}</td><td>${r.jury1||'–'}</td><td>${r.jury2||'–'}</td><td>${r.encadrant||'–'}</td><td>${r.president||'–'}</td>
            <td>${etatIconDesignation(r.etat)}</td><td><button class="dots-btn" title="Plus">⋯</button></td>
          </tr>`).join('')}
      </tbody></table>
    </div>
    <div class="pager"><button class="pbtn">«</button><button class="pbtn">‹</button><span class="pnum">2</span><button class="pbtn">›</button><button class="pbtn">»</button></div>`;
}
function statusChip(state){
  if(state==='valide'){
    return `<span class="chip">
      <svg viewBox="0 0 24 24" fill="none" stroke="#29A544" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle><polyline points="7.5 12 10.5 15 16.5 9"></polyline>
      </svg> Validé
    </span>`;
  }
  return state;
}
function renderTab4(container){
  const colgroup = `
    <colgroup>
      <col style="width:44px">
      <col style="width:24%">
      <col style="width:14%">
      <col style="width:8%">
      <col style="width:14%">
      <col style="width:12%">
      <col style="width:16%">
      <col style="width:6%">
    </colgroup>`;
  container.innerHTML = `
    <div class="toolbar">
      <label class="search"><input type="text" placeholder="Recherche..."><button class="sbtn" aria-label="Rechercher"><svg viewBox="0 0 24 24" fill="#A6A59F"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM10 14a4 4 0 110-8 4 4 0 010 8z"/></svg></button></label>
      <label class="sel sel-sm"><select><option>Période</option><option>Cette semaine</option><option>Ce mois</option><option>Cette année</option></select><svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg></label>
      <label class="sel"><select><option>Encadrant</option><option>Hatem Chaieb</option><option>Ridha Mahjoub</option></select><svg class="chev" viewBox="0 0 24 24" fill="#A6A59F"><path d="M7 10l5 5 5-5z"/></svg></label>
      <button class="btn-download" title="Télécharger"><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe 152.png" alt="download"></button>
    </div>
    <div class="table-wrap">
      <table class="tbl-head results">${colgroup}
        <thead><tr>
          <th><input type="checkbox"></th><th>Etudiant</th><th>date soutenance</th><th>Note</th><th>mention</th><th>validation</th><th>jurys</th><th>Action</th>
        </tr></thead></table>
      <div class="tbl-gap"></div>
      <table class="tbl-body results">${colgroup}<tbody>
        ${resultsRows.map((r,i)=>`
          <tr data-index="${i}">
            <td><input type="checkbox"></td>
            <td>${r.etu}</td><td>${r.dateS}</td><td>${r.note}</td><td>${r.mention}</td>
            <td>${statusChip(r.validation)}</td>
            <td><div class="list-jurys">${r.jurys.map(j=>`<div>- ${j}</div>`).join('')}</div></td>
            <td><button class="dots-btn" title="Plus">⋯</button></td>
          </tr>`).join('')}
      </tbody></table>
    </div>
    <div class="pager"><button class="pbtn">«</button><button class="pbtn">‹</button><span class="pnum">2</span><button class="pbtn">›</button><button class="pbtn">»</button></div>`;
}

/* ===== Rendu initial ===== */
renderTable(document.getElementById('t1'));
renderTab2(document.getElementById('t2'));
renderTab3(document.getElementById('t3'));
renderTab4(document.getElementById('t4'));

/* ===== Tab switch ===== */
document.querySelectorAll('.tab-btn').forEach(btn=>{
  btn.addEventListener('click',()=>{
    document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
    document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.tab).classList.add('active');
  });
});

/* ===== Offcanvas générique ===== */
const ocv = document.getElementById('offcanvas');
const overlay = document.getElementById('ocvOverlay');
const etatBlock = document.getElementById('etatBlock');
const titleEl = document.getElementById('ocvTitle');

function styleSelectPlaceholders(){
  document.querySelectorAll('.field-select select').forEach(sel=>{
    const toggle = ()=> sel.classList.toggle('placeholder', !sel.value);
    toggle(); sel.addEventListener('change', toggle);
  });
}
function setSelectValue(sel,val){const f=[...sel.options].find(o=>o.text===val||o.value===val);sel.value=f?f.value:'';sel.dispatchEvent(new Event('change'))}
styleSelectPlaceholders();

function resetForm(){
  f_etu.value=''; f_salle.value=''; f_date.value=''; f_time.value='';
  setSelectValue(document.getElementById('f_encadrant'),'');
  setSelectValue(document.getElementById('f_j1'),'');
  setSelectValue(document.getElementById('f_j2'),'');
  document.querySelectorAll('input[name="etat"]').forEach(r=>r.checked=false);
  styleSelectPlaceholders();
}
function openOffcanvas(mode='create',idx=null){
  if(mode==='edit'){
    titleEl.textContent='Modifier'; etatBlock.hidden=false;
    if(idx!=null){
      const r=rows[idx]||{};
      f_etu.value=r.etu||''; f_salle.value=r.salle||'';
      f_date.value=r.date||''; f_time.value=r.heure||'';
      setSelectValue(document.getElementById('f_encadrant'),r.encadrant||'');
      setSelectValue(document.getElementById('f_j1'),r.jury1||'');
      setSelectValue(document.getElementById('f_j2'),r.jury2||'');
      const radio=document.querySelector(`input[name="etat"][value="${r.etat}"]`); if(radio) radio.checked=true;
      styleSelectPlaceholders();
    }
  }else{
    titleEl.textContent='Programmer une soutenance'; etatBlock.hidden=true; resetForm();
  }
  ocv.classList.add('show'); overlay.classList.add('show'); ocv.setAttribute('aria-hidden','false'); document.body.classList.add('no-scroll');
}
function closeOffcanvas(){ ocv.classList.remove('show'); overlay.classList.remove('show'); ocv.setAttribute('aria-hidden','true'); document.body.classList.remove('no-scroll') }
document.addEventListener('click',(e)=>{
  const prog=e.target.closest('.btn-primary'); if(prog){ openOffcanvas('create'); return; }
  const edit=e.target.closest('.action-icon');
  if(edit){ const tr=edit.closest('tr'); const idx=tr?parseInt(tr.dataset.index,10):null; openOffcanvas('edit',idx); }
});
overlay.addEventListener('click', ()=>{ closeOffcanvas(); closeOffcanvasJury(); hideAllMenus(); });
document.addEventListener('keydown',(e)=>{ if(e.key==='Escape'){ closeOffcanvas(); closeOffcanvasJury(); hideAllMenus(); }});
document.getElementById('ocvSave').addEventListener('click', ()=> closeOffcanvas() );

/* ===== Menus ⋯ (onglet 2) ===== */
const ctxMenu=document.getElementById('ctxMenu');
document.addEventListener('click',(e)=>{
  const btn=e.target.closest('.dots-btn');
  const inT2=document.getElementById('t2').contains(e.target);
  if(inT2 && btn){
    e.stopPropagation();
    const r=btn.getBoundingClientRect();
    ctxMenu.style.top=`${window.scrollY + r.bottom + 6}px`;
    ctxMenu.style.left=`${window.scrollX + r.right - 180}px`;
    ctxMenu.classList.add('show'); ctxMenu.setAttribute('aria-hidden','false'); return;
  }
});
window.addEventListener('scroll', ()=> hideAllMenus());

/* ===== Menu ⋯ (onglet 3) ===== */
const ctxMenuT3=document.getElementById('ctxMenuT3');
document.addEventListener('click',(e)=>{
  const t3=document.getElementById('t3');
  if(t3.contains(e.target) && e.target.closest('.dots-btn')){
    e.stopPropagation();
    const btn=e.target.closest('.dots-btn'); const r=btn.getBoundingClientRect();
    ctxMenuT3.style.top=`${window.scrollY + r.bottom + 6}px`;
    ctxMenuT3.style.left=`${window.scrollX + r.right - 200}px`;
    ctxMenuT3.classList.add('show'); ctxMenuT3.setAttribute('aria-hidden','false');
    ctxMenuT3.dataset.rowIndex = btn.closest('tr')?.dataset.index || '';
    return;
  }
  const item=e.target.closest('#ctxMenuT3 .ctx-item');
  if(item && ctxMenuT3.classList.contains('show')){
    const action=item.dataset.action;
    const idx=parseInt(ctxMenuT3.dataset.rowIndex||'-1',10);
    if(action==='affecter-jury'){ openOffcanvasJury(isNaN(idx)?null:idx); }
    else if(action==='edit'){ openOffcanvas('edit',isNaN(idx)?null:idx); }
    hideAllMenus(); return;
  }
});

/* ===== Menu ⋯ (onglet 4) ===== */
/* ===== Menu ⋯ (onglet 4) ===== */
const ctxMenuT4 = document.getElementById('ctxMenuT4');
document.addEventListener('click', (e) => {
  const t4 = document.getElementById('t4');

  // Ouverture du menu ⋯
  if (t4.contains(e.target) && e.target.closest('.dots-btn')) {
    e.stopPropagation();
    const btn = e.target.closest('.dots-btn');
    const r = btn.getBoundingClientRect();
    ctxMenuT4.style.top  = `${window.scrollY + r.bottom + 6}px`;
    ctxMenuT4.style.left = `${window.scrollX + r.right - 200}px`;
    ctxMenuT4.classList.add('show');
    ctxMenuT4.setAttribute('aria-hidden','false');
    ctxMenuT4.dataset.rowIndex = btn.closest('tr')?.dataset.index || '';
    return;
  }

  // Clic sur un item du menu (aucun offcanvas sur T4)
  const item = e.target.closest('#ctxMenuT4 .ctx-item');
  if (item && ctxMenuT4.classList.contains('show')) {
    const action = item.dataset.action;
    const idx = parseInt(ctxMenuT4.dataset.rowIndex || '-1', 10);
    // Ici, pas d'ouverture d'offcanvas (demandé)
    // Vous pouvez brancher vos actions si besoin :
    // if (action === 'edit') { /* ... */ }
    // if (action === 'details') { /* ... */ }
    hideAllMenus();
    return;
  }
});

/* ===== Menu filtre Statut (icône) ===== */
const statusMenu = document.getElementById('statusMenu');
document.addEventListener('click',(e)=>{
  const icon = e.target.closest('.th-icon');
  if(icon){
    e.stopPropagation();
    const r=icon.getBoundingClientRect();
    statusMenu.style.top = `${window.scrollY + r.bottom + 8}px`;
    statusMenu.style.left= `${window.scrollX + r.left - 10}px`;
    statusMenu.classList.add('show'); statusMenu.setAttribute('aria-hidden','false');
    return;
  }
  const item=e.target.closest('#statusMenu .status-item');
  if(item){
    [...statusMenu.querySelectorAll('.status-item')].forEach(i=>i.classList.remove('active'));
    item.classList.add('active');
    hideAllMenus(); return;
  }
});

/* Masquer tous les menus */
function hideAllMenus(){
  [ctxMenu, ctxMenuT3, ctxMenuT4, statusMenu].forEach(m=>{ if(!m) return; m.classList.remove('show'); m.setAttribute('aria-hidden','true'); });
}

/* >>> Fermer les menus en cliquant ailleurs (⋯ & filtre statut) <<< */
document.addEventListener('click', (e) => {
  const insideMenu   = e.target.closest('.ctx-menu');
  const isDots       = e.target.closest('.dots-btn');
  const isStatusIcon = e.target.closest('.th-icon');
  if (!insideMenu && !isDots && !isStatusIcon) {
    hideAllMenus();
  }
});

/* ===== Offcanvas Jury ===== */
const ocvJury=document.getElementById('offcanvasJury');
let juryRowIndex=null;
const people=[
  {name:'Mr. Mourad Hammami', title:'Maitre Assistant, ENIT', avatar:'https://i.pravatar.cc/32?img=1'},
  {name:'Mr. Salah Ben Hsin', title:'Maitre Assistant, ENIT', avatar:'https://i.pravatar.cc/32?img=2'},
  {name:'Mme. Manel Ben Ghanem', title:'Maitre Assistante, ENIT', avatar:'https://i.pravatar.cc/32?img=3'},
  {name:'Mme. Ahlem Drissi', title:'Maitre Assistante, ENIT', avatar:'https://i.pravatar.cc/32?img=4'},
];
function renderPeopleLists(prefilled){
  const juryWrap=document.getElementById('juryList');
  const presWrap=document.getElementById('presidentList');
  juryWrap.innerHTML=''; presWrap.innerHTML='';
  people.forEach(p=>{
    const row=document.createElement('label');
    row.className='jperson';
    row.innerHTML=`<input class="jcheck" type="checkbox"><img class="avatar" src="${p.avatar}" alt="">
      <div class="jmeta"><span class="jname">${p.name}</span><span class="jtitle">${p.title}</span></div>`;
    juryWrap.appendChild(row);
    const row2=document.createElement('label');
    row2.className='jperson';
    row2.innerHTML=`<input class="jcheck" type="radio" name="president"><img class="avatar" src="${p.avatar}" alt="">
      <div class="jmeta"><span class="jname">${p.name}</span><span class="jtitle">${p.title}</span></div>`;
    presWrap.appendChild(row2);
  });
  if(prefilled){
    const {jury1,jury2,president}=prefilled;
    [...juryWrap.querySelectorAll('.jperson')].forEach(lbl=>{
      const n=lbl.querySelector('.jname').textContent.trim();
      if(n===jury1 || n===jury2) lbl.querySelector('input').checked=true;
    });
    [...presWrap.querySelectorAll('.jperson')].forEach(lbl=>{
      const n=lbl.querySelector('.jname').textContent.trim();
      if(n===president) lbl.querySelector('input').checked=true;
    });
  }
  juryWrap.addEventListener('change', updateJuryMax);
  updateJuryMax();
}
function updateJuryMax(){
  const selected=[...document.querySelectorAll('#juryList input[type="checkbox"]:checked')].length;
  const all=[...document.querySelectorAll('#juryList input[type="checkbox"]')];
  all.forEach(cb=>{ cb.disabled = !cb.checked && selected>=2; });
}
document.addEventListener('click',(e)=>{ const head=e.target.closest('.acc-head'); if(head){ head.parentElement.classList.toggle('collapsed'); }});
function openOffcanvasJury(idx=null, prefill=null){
  juryRowIndex = Number.isInteger(idx) ? idx : null;
  const r = Number.isInteger(idx) ? (rows[idx]||{}) : (prefill||{});
  renderPeopleLists({jury1:r.jury1||prefill?.jury1||'', jury2:r.jury2||prefill?.jury2||'', president:r.president||prefill?.president||''});
  ocvJury.classList.add('show'); overlay.classList.add('show');
  ocvJury.setAttribute('aria-hidden','false'); document.body.classList.add('no-scroll');
}
function closeOffcanvasJury(){
  ocvJury.classList.remove('show'); overlay.classList.remove('show');
  ocvJury.setAttribute('aria-hidden','true'); document.body.classList.remove('no-scroll');
}
document.getElementById('ocvJurySave').addEventListener('click', ()=>{
  if(juryRowIndex==null){ closeOffcanvasJury(); return; }
  const checked=[...document.querySelectorAll('#juryList input[type="checkbox"]:checked')].map(cb=>cb.parentElement.querySelector('.jname').textContent.trim());
  const pres=document.querySelector('#presidentList input[type="radio"]:checked');
  const presidentName=pres?pres.parentElement.querySelector('.jname').textContent.trim():'';
  rows[juryRowIndex].jury1=checked[0]||''; rows[juryRowIndex].jury2=checked[1]||''; rows[juryRowIndex].president=presidentName||'';
  renderTab3(document.getElementById('t3')); closeOffcanvasJury();
});

/* Réfs champs offcanvas générique */
const f_etu=document.getElementById('f_etu');
const f_salle=document.getElementById('f_salle');
const f_date=document.getElementById('f_date');
const f_time=document.getElementById('f_time');
</script>
</body>
</html>
