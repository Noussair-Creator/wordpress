<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Suivi des réponses</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    /* ============== Styles SCOPÉS ============== */
    #demandes-service{
      background:#FFFFFF; box-shadow:0 3px 22px #0000000F;
      border-radius:8px; border:1px solid #e8e6db;
      padding:12px 14px 14px; color:#2A2916;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
      margin:20px auto;
    }

    /* Titre + icône */
    #demandes-service .section-title{
      display:flex;align-items:center;gap:10px;
      font-weight:700;font-size:20px;line-height:26px;margin:6px 0 8px;
    }
    #demandes-service .title-icon{
      width:32px;height:34px;flex:0 0 32px;
      background:transparent url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/entrevue.png') 0 0/contain no-repeat;
    }
    #demandes-service .section-separator{border:0;border-top:1px solid #ECEBE3;margin:8px 0 10px}

    /* Toolbar */
    #demandes-service .toolbar{display:flex;align-items:center;gap:12px;margin-bottom:10px}
    .search{width:255px;height:35px;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #DBD9C3;border-radius:6px;padding:0 10px}
    .search input{flex:1;border:0;outline:none;background:transparent;font-size:14px;color:#2A2916}
    .search img{width:16px;height:16px;display:block}
    .btn-download{margin-left:auto;width:40px;height:40px;border-radius:5px;border:0;cursor:pointer;background:#fff;box-shadow:0 0 6px #00000030;display:grid;place-items:center}
    .btn-download img{width:18px;height:18px}

    /* ====== TABLE HEAD ====== */
    #demandes-service .table-head{
      background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;padding:0 8px;height:45px;display:flex;align-items:center
    }
    #demandes-service .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #demandes-service .table-head th{
      text-align:left;font-weight:700;font-size:15px;line-height:20px;color:#2A2916;padding:0 12px;border:0;white-space:nowrap
    }
    #demandes-service .table-head th:first-child{width:32px;text-align:center;padding-left:6px}
    #demandes-service .table-head th:nth-child(2){width:140px}
    #demandes-service .table-head th:nth-child(3){width:230px}
    #demandes-service .table-head th:nth-child(4){width:auto}
    #demandes-service .table-head th:nth-child(5){width:120px;text-align:center}
    #demandes-service .table-head th:nth-child(6){width:120px;text-align:center}
    #demandes-service .table-head th:nth-child(7){width:90px;text-align:center}

    /* ====== TABLE BODY ====== */
    #demandes-service .table-body{background:#fff;border:2px solid #EBE9D7;border-radius:8px;margin-top:10px;overflow:hidden}
    #demandes-service .tbl{width:100%;border-collapse:separate;border-spacing:0}
    #demandes-service .tbl td{
      background:#fff;padding:14px 12px;border-bottom:1px solid #EBE9D7;vertical-align:middle;
      font-size:14px;line-height:17px;color:#2A2916
    }
    #demandes-service .tbl tr:last-child td{border-bottom:none}
    #demandes-service .tbl td:first-child{width:32px;text-align:center;padding-left:6px;padding-right:6px}
    #demandes-service .tbl td.sep-after{border-right:1px solid #EBE9D7}
    #demandes-service .tbl td:nth-child(5),
    #demandes-service .tbl td:nth-child(6),
    #demandes-service .tbl td:nth-child(7){text-align:center}
    #demandes-service .tbl td:nth-child(6),
    #demandes-service .tbl td:nth-child(7){border-left:1px solid #EBE9D7}
    .chk{width:16px;height:16px;cursor:pointer;accent-color:#6b6c4a}

    /* Badges statut */
    .badge{display:inline-flex;align-items:center;gap:6px;padding:3px 10px;border-radius:999px;font-weight:600;font-size:13px;border:1px solid transparent;background:#fff}
    .badge .dot{width:8px;height:8px;border-radius:50%}
    .badge.is-pending{color:#9C7B00;border-color:#F3D27A;background:#FFF8E1}.badge.is-pending .dot{background:#F4C63D}
    .badge.is-success{color:#0E7A46;border-color:#BFE6CF;background:#E9F7F0}.badge.is-success .dot{background:#13A463}
    .badge.is-danger{color:#B10F0F;border-color:#F3B8B8;background:#FDEDED}.badge.is-danger .dot{background:#D73737}

    /* Kebab + menu */
    .kebab{width:34px;height:34px;border-radius:8px;border:1px solid transparent;background:#fff;cursor:pointer;font-size:20px;line-height:1}
    .kebab:hover{background:#F2F1EA}
    .dropdown{position:absolute;right:12px;top:32px;background:#fff;border:1px solid #E6E3D3;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,.08);min-width:180px;padding:6px;display:none;z-index:5}
    .dropdown a{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:6px;text-decoration:none;color:#2A2916;font-size:14px}
    .dropdown a:hover{background:#F3F2EA}
    #demandes-service .rel{position:relative}

    /* ====== PAGINATION ====== */
    #demandes-service .pagination{display:flex;gap:8px;justify-content:flex-end;padding:12px 0 4px}
    #demandes-service .pagination .pbtn.arrow{width:36px;height:36px;font-size:18px;border:2px solid #c40000;color:#c40000;background:#fff;border-radius:6px;cursor:pointer;font-weight:800}
    #demandes-service .pagination .pbtn.page{min-width:32px;height:32px;border:none;background:#fff;color:#c40000;font-weight:800;border-radius:6px;cursor:pointer}
    #demandes-service .pagination .pbtn.page.active{color:#000;font-size:18px}

    /* ====== OFFCANVAS (exactement le style de ton code) ====== */
    #demandes-service .sidebar-backdrop{
      position:fixed;inset:0;background:rgba(0,0,0,.4);
      opacity:0;pointer-events:none;transition:opacity .2s;z-index:10040;
    }
    #demandes-service .sidebar{
      position:fixed;top:0;right:-450px;width:450px;height:100vh;max-width:90vw;
      background:#FFFFFF;border-left:1px solid #E7E4D7;box-shadow:-7px 0 36px #00000029;
      z-index:10050;display:flex;flex-direction:column;padding:0;
    }
    #demandes-service .sidebar.is-open{right:0}
    #demandes-service .sidebar-backdrop.is-open{opacity:1;pointer-events:auto}
    body.no-scroll{overflow:hidden}

    /* Head stické identique */
    #demandes-service .sb-head{
      position:sticky; top:0; height:60px; margin:0;
      padding:12px 16px 12px 23px; background:#FFFFFF; border-radius:0;
      box-shadow:0 5px 16px #00000029, 0 -5px 16px #00000029;
      display:flex;align-items:center;justify-content:space-between; z-index:1;
    }
    #demandes-service .sb-title{margin:0;font:normal normal bold 18px/24px Roboto;letter-spacing:0;color:#2A2916}
    /* petit bouton rouge “X” pour lecture */
    #demandes-service .sb-close{
      width:32px;height:32px;border:1px solid #BF0404;border-radius:6px;background:#BF0404;
      color:#fff;display:grid;place-items:center;font-size:18px;cursor:pointer;
      box-shadow:0 3px 6px rgba(0,0,0,.16);
    }

    /* Corps de l’offcanvas “Lire la réponse” */
    #demandes-service .sb-body{flex:1;overflow:auto;padding:16px 20px 18px}
    .sec-title{font:700 14px/18px Roboto;margin:10px 0 8px;color:#2A2916}
    .roc-hr{border:0;border-top:1px solid #ECEBE3;margin:12px 0}
    .dl{display:grid;grid-template-columns:150px 1fr;column-gap:10px;row-gap:8px;font:400 14px/18px Roboto;color:#2A2916}
    .dl dt{font-weight:700} .dl dd{margin:0}
    .answer{font:400 14px/20px Roboto;color:#2A2916;white-space:pre-line}
  </style>
</head>
<body>

<section class="card" id="demandes-service">
  <div class="section-title">
    <span class="title-icon" aria-hidden="true"></span>
    Suivi des réponses
  </div>
  <hr class="section-separator">

  <div class="toolbar">
    <div class="search">
      <input type="text" placeholder="Recherche…" autocomplete="off">
      <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-search.png" alt="search">
    </div>
    <button class="btn-download" title="Télécharger">
      <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="download">
    </button>
  </div>

  <!-- HEAD -->
  <div class="table-head">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox" class="chk"></th>
          <th>Référence</th>
          <th>Type</th>
          <th>sujet</th>
          <th>Date</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- BODY : données + attributs pour renseigner l’offcanvas -->
  <div class="table-body">
    <table class="tbl">
      <tbody>
        <!-- Ligne 1 -->
        <tr class="rel"
            data-ref="Rec-2025-001"
            data-student="Rim Ben Aissa"
            data-type="Note"
            data-subject="Note s1"
            data-sent="12-02-2025"
            data-status="Acceptée"
            data-attachments="–"
            data-reply="Après révision de la copie par le responsable du module, nous confirmons que la note attribuée est correcte. Toutefois, vous avez droit à une consultation de copie le 8 mai 2025 entre 10h et 12h."
            data-replydate="23-02-2025"
            data-responder="Mme. Selma Kefi">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after">#REC-2024-034</td>
          <td class="sep-after">Réclamations Pédagogiques</td>
          <td>Réclamation sur le contenu du cours</td>
          <td>12/01/2025</td>
          <td><span class="badge is-pending"><span class="dot"></span>En cours</span></td>
          <td>
            <button class="kebab" data-menu="m1">···</button>
            <div class="dropdown" id="m1">
              <a href="#" class="act-read">Lire la réponse</a>
              <a href="#">E-mail</a>
            </div>
          </td>
        </tr>

        <!-- Ligne 2 -->
        <tr class="rel"
            data-ref="Rec-2025-001"
            data-student="Rim Ben Aissa"
            data-type="Note"
            data-subject="Note s1"
            data-sent="12-02-2025"
            data-status="Acceptée"
            data-attachments="–"
            data-reply="Après révision de la copie par le responsable du module, nous confirmons que la note attribuée est correcte. Toutefois, vous avez droit à une consultation de copie le 8 mai 2025 entre 10h et 12h."
            data-replydate="23-02-2025"
            data-responder="Mme. Selma Kefi">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after">#REC-2024-034</td>
          <td class="sep-after">Réclamations Pédagogiques</td>
          <td>Erreur de note / demande de révision de note</td>
          <td>12/01/2025</td>
          <td><span class="badge is-success"><span class="dot"></span>Acceptée</span></td>
          <td>
            <button class="kebab" data-menu="m2">···</button>
            <div class="dropdown" id="m2">
              <a href="#" class="act-read">Lire la réponse</a>
              <a href="#">E-mail</a>
            </div>
          </td>
        </tr>

        <!-- Ligne 3 -->
        <tr class="rel"
            data-ref="Rec-2025-002"
            data-student="Hatem Z."
            data-type="Administration"
            data-subject="Problème de stage"
            data-sent="12-02-2025"
            data-status="Refusée"
            data-attachments="–"
            data-reply="Votre demande ne peut pas être acceptée au vu des délais administratifs passés."
            data-replydate="22-02-2025"
            data-responder="Service scolarité">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after">#REC-2024-034</td>
          <td class="sep-after">Réclamations Administratives</td>
          <td>Problème De Stage</td>
          <td>12/01/2025</td>
          <td><span class="badge is-danger"><span class="dot"></span>Refusée</span></td>
          <td>
            <button class="kebab" data-menu="m3">···</button>
            <div class="dropdown" id="m3">
              <a href="#" class="act-read">Lire la réponse</a>
              <a href="#">E-mail</a>
            </div>
          </td>
        </tr>

        <!-- Ligne 4 -->
        <tr class="rel"
            data-ref="Rec-2025-003"
            data-student="Nesrine T."
            data-type="Technique"
            data-subject="Problème avec les supports en ligne"
            data-sent="12-02-2025"
            data-status="Acceptée"
            data-attachments="–"
            data-reply="L’accès a été rétabli. Merci de réessayer."
            data-replydate="20-02-2025"
            data-responder="Support IT">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after">#REC-2024-034</td>
          <td class="sep-after">Réclamations techniques ou d’accès</td>
          <td>Problème Avec Les Supports En Ligne</td>
          <td>12/01/2025</td>
          <td><span class="badge is-success"><span class="dot"></span>Acceptée</span></td>
          <td>
            <button class="kebab" data-menu="m4">···</button>
            <div class="dropdown" id="m4">
              <a href="#" class="act-read">Lire la réponse</a>
              <a href="#">E-mail</a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <button class="pbtn arrow" title="Première">≪</button>
    <button class="pbtn arrow" title="Précédent">‹</button>
    <button class="pbtn page active" title="Page 2">2</button>
    <button class="pbtn arrow" title="Suivant">›</button>
    <button class="pbtn arrow" title="Dernière">≫</button>
  </div>

  <!-- === Offcanvas LECTURE (mêmes classes/structure) === -->
  <div class="sidebar-backdrop" id="sb-backdrop"></div>
  <aside class="sidebar" id="sb" aria-hidden="true">
    <div class="sb-head">
      <h3 class="sb-title" id="sbTitle">Reclamation #Rec-2025-001</h3>
      <button class="sb-close" id="sbClose" type="button">✕</button>
    </div>

    <div class="sb-body">
      <div class="sec-title">Details de la réclamation :</div>
      <dl class="dl">
        <dt>Etudiant(e) :</dt><dd id="v-student">—</dd>
        <dt>Type :</dt><dd id="v-type">—</dd>
        <dt>Sujet :</dt><dd id="v-subject">—</dd>
        <dt>Date d’envoi :</dt><dd id="v-sent">—</dd>
        <dt>Statut :</dt><dd><span class="badge is-success" id="v-status"><span class="dot"></span>Acceptée</span></dd>
        <dt>pièces jointes :</dt><dd id="v-attachments">—</dd>
      </dl>

      <hr class="roc-hr">

      <div class="sec-title">Réponse de l’administration :</div>
      <dl class="dl" style="grid-template-columns:150px 1fr">
        <dt>Réponse :</dt><dd><div class="answer" id="v-reply">—</div></dd>
        <dt>Date de la réponse :</dt><dd id="v-replyDate">—</dd>
        <dt>Répondant(e) :</dt><dd id="v-responder">—</dd>
      </dl>
    </div>
  </aside>
</section>

<script>
(function(){
  /* Menus ⋯ */
  const kebabs = document.querySelectorAll('#demandes-service .kebab');
  const closeAllMenus = () =>
    document.querySelectorAll('#demandes-service .dropdown').forEach(d=>d.style.display='none');
  kebabs.forEach(btn=>{
    btn.addEventListener('click', e=>{
      e.stopPropagation();
      const menu=document.getElementById(btn.dataset.menu);
      const shown=menu.style.display==='block';
      closeAllMenus(); menu.style.display = shown ? 'none' : 'block';
    });
  });
  document.addEventListener('click', closeAllMenus);

  /* Offcanvas (même logique que ton code) */
  const sb  = document.getElementById('sb');
  const bd  = document.getElementById('sb-backdrop');
  const title = document.getElementById('sbTitle');
  const btnClose = document.getElementById('sbClose');

  function setText(id,val){ const el=document.getElementById(id); if(el) el.textContent = val || '—'; }
  function setBadge(label){
    const b=document.getElementById('v-status');
    const x=(label||'').toLowerCase();
    b.className = 'badge ' + (x.includes('accept') ? 'is-success' : x.includes('refus') ? 'is-danger' : 'is-pending');
    b.innerHTML = '<span class="dot"></span>' + (label||'—');
  }
  function openSBForRow(tr){
    title.textContent = 'Reclamation #' + (tr.dataset.ref || '');
    setText('v-student', tr.dataset.student);
    setText('v-type',    tr.dataset.type);
    setText('v-subject', tr.dataset.subject);
    setText('v-sent',    tr.dataset.sent);
    setText('v-attachments', tr.dataset.attachments || '–');
    setText('v-reply',   tr.dataset.reply);
    setText('v-replyDate', tr.dataset.replydate);
    setText('v-responder', tr.dataset.responder);
    setBadge(tr.dataset.status);

    sb.classList.add('is-open');
    bd.classList.add('is-open');
    sb.setAttribute('aria-hidden','false');
    document.body.classList.add('no-scroll');
  }
  function closeSB(){
    sb.classList.remove('is-open');
    bd.classList.remove('is-open');
    sb.setAttribute('aria-hidden','true');
    document.body.classList.remove('no-scroll');
  }
  btnClose.addEventListener('click', closeSB);
  bd.addEventListener('click', closeSB);

  // Ouvrir via “Lire la réponse”
  document.querySelectorAll('#demandes-service .dropdown .act-read').forEach(a=>{
    a.addEventListener('click', e=>{
      e.preventDefault();
      const tr=a.closest('tr');
      closeAllMenus();
      openSBForRow(tr);
    });
  });
})();
</script>
</body>
</html>
