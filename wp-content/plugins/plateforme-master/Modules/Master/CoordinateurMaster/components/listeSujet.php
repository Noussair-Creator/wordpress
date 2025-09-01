<section id="liste-sujets">
  <style>
    /* ========== CONTEXTE GLOBAL (inchangé) ========== */
    #liste-sujets{
      background:#fff;border:1px solid #E8E6DB;border-radius:10px;
      box-shadow:0 6px 24px rgba(0,0,0,.08); padding:14px; color:#2A2916;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;height: 500px;
    }
    #liste-sujets .header{display:flex;align-items:center;gap:10px;padding-bottom:8px;margin-bottom:14px;border-bottom:1px solid #EBE9D7}
    #liste-sujets .header .icon{width:28px;height:28px;background:#fff url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/9368448.png') center/contain no-repeat;border-radius:4px}
    #liste-sujets .header .title{font-weight:700;font-size:18px}
    #liste-sujets .toolbar{display:flex;align-items:center;gap:10px;margin-bottom:10px}
    #liste-sujets .search{flex:1;display:flex;align-items:center;gap:8px;height:36px;border:1px solid #DBD9C3;border-radius:6px;background:#fff;padding:0 10px;max-width:280px}
    #liste-sujets .search input{flex:1;border:0;outline:none;background:transparent;font-size:14px;color:#2A2916}
    #liste-sujets .search .btn{width:34px;height:28px;border:0;border-left:1px solid #DBD9C3;border-radius:4px;background:#fff;display:grid;place-items:center;cursor:pointer}
    #liste-sujets .toolbar .spacer{flex:1}
    #liste-sujets .btn-icon{width:36px;height:36px;border-radius:6px;border:1px solid #DBD9C3;background:#fff;display:grid;place-items:center;cursor:pointer}
    #liste-sujets .btn-primary{height:36px;border-radius:6px;border:1px solid #BF0404;background:#BF0404;color:#fff;padding:0 12px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:8px}

    /* Table (inchangée) */
    #liste-sujets .table-head{background:#EDEBDF;border:1px solid #A6A4853D;border-radius:8px;padding:0 8px;height:45px;display:flex;align-items:center}
    #liste-sujets .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #liste-sujets .table-head th{text-align:left;font-weight:700;font-size:14px;color:#2A2916;padding:0 12px;border:0;white-space:nowrap}
    #liste-sujets .table-head th:first-child{width:36px;text-align:center}
    #liste-sujets .table-head th:nth-child(3){width:260px}
    #liste-sujets .table-head th:nth-child(4){width:110px;text-align:center}
    #liste-sujets .table-head th:nth-child(5){width:90px;text-align:center}
    #liste-sujets .table-body{background:#fff;border:2px solid #EBE9D7;border-radius:8px;margin-top:8px;overflow:auto}
    #liste-sujets .tbl{width:100%;border-collapse:separate;border-spacing:0;min-width:640px}
    #liste-sujets .tbl td{background:#fff;padding:12px;border-bottom:1px solid #EBE9D7;vertical-align:middle;font-size:14px;color:#2A2916}
    #liste-sujets .tbl tr:last-child td{border-bottom:none}
    #liste-sujets .tbl td:first-child{width:36px;text-align:center}
    #liste-sujets .tbl td:nth-child(2){border-right:1px solid #EBE9D7}
    #liste-sujets .tbl td:nth-child(4){text-align:center;border-left:1px solid #EBE9D7}
    #liste-sujets .tbl td:nth-child(5){text-align:center;border-left:1px solid #EBE9D7}
    #liste-sujets .chk{width:16px;height:16px;cursor:pointer;accent-color:#6b6c4a}
    #liste-sujets .tbl td:nth-child(4) img{width:22px;height:22px;display:block;margin:0 auto;opacity:.9}
    #liste-sujets .btn-icon img{width:14px;height:14px;display:block}
    #liste-sujets .rel{position:relative}
    #liste-sujets .kebab{width:30px;height:30px;border-radius:8px;border:1px solid transparent;background:#fff;cursor:pointer;font-size:20px;line-height:1;display:grid;place-items:center;margin:0 auto}
    #liste-sujets .kebab:hover{background:#F2F1EA}
    #liste-sujets .dropdown{position:absolute;right:12px;top:36px;background:#fff;border:1px solid #E6E3D3;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,.08);min-width:170px;padding:6px;display:none;z-index:5}
    #liste-sujets .dropdown a{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:6px;text-decoration:none;color:#2A2916;font-size:14px}
    #liste-sujets .dropdown a:hover{background:#F3F2EA}
    #liste-sujets .dropdown a img.ico{width:16px;height:16px;display:block}
    #liste-sujets .dropdown a.act-del{color:#BF0404}
    #liste-sujets .pager{display:flex;gap:6px;justify-content:flex-end;margin-top:12px}
    #liste-sujets .pager .pbtn{width:32px;height:32px;border:2px solid #BF0404;background:#fff;color:#BF0404;border-radius:6px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px}
    #liste-sujets .pager .pnum{min-width:30px;text-align:center;line-height:32px;font-weight:400;color:#000}

    /* ========== OFFCANVAS — styles corrigés d’après tes specs ========== */

    /* Head (60px, ombre) */
    #liste-sujets .sb-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.4);opacity:0;pointer-events:none;transition:opacity .2s;z-index:10040}
    #liste-sujets .sb{
      position:fixed;top:0;right:-450px;width:450px;height:100vh;background:#FFFFFF;
      box-shadow:-7px 0 36px #00000029;border-left:1px solid #E7E4D7;
      display:flex;flex-direction:column;z-index:10050;transition:right .25s ease;
    }
    #liste-sujets .sb.open{right:0}
    #liste-sujets .sb-backdrop.open{opacity:1;pointer-events:auto}
    body.no-scroll{overflow:hidden}

    #liste-sujets .sb-head{
      height:60px;background:#FFFFFF;box-shadow:0px 5px 16px #00000029;
      display:flex;align-items:center;justify-content:space-between;padding:12px 16px
    }
    /* Titre dans le head */
    #liste-sujets .sb-title{margin:0;font:700 15px/18px Roboto;color:#2A2916}
    #liste-sujets .sb-save{height:36px;min-width:120px;border-radius:6px;border:1px solid #BF0404;background:#BF0404;color:#fff;font:600 14px/20px Roboto;cursor:pointer}

    /* Corps */
    #liste-sujets .sb-body{flex:1;overflow:auto;padding:14px 16px 18px; margin-top: 30px;}

    /* 1er champ (Select “Master De Recherche”) — 393×40, bord 1, r=5, chevron + trait */
    #liste-sujets .fld{margin-bottom:12px}
    #liste-sujets .sel-wrap{position:relative;width:393px}
    #liste-sujets .sel{
      width:100%;height:40px;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;
      padding:0 42px 0 12px;font:400 14px/17px Roboto;color:#000;appearance:none;
      text-transform:capitalize;
    }
    /* libellé interne (placeholder) du “Choisir un encadrant” quand vide */
    #liste-sujets .sel.placeholder{color:#CFCFCF}

    /* chevron (13×8) + trait (22px) */
    #liste-sujets .sel-wrap::after{
      content:"";position:absolute;top:50%;right:12px;transform:translateY(-50%);
      width:13px;height:8px;background:url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-chevron-down.png') center/contain no-repeat;opacity:1;
    }
    #liste-sujets .sel-wrap::before{
      content:"";position:absolute;top:50%;right:34px;transform:translateY(-50%);
      width:0;height:22px;border-left:1px solid #DBD9C3;opacity:1;
    }

    /* 2e champ (Textarea titre) — 393×65 */
    #liste-sujets .txt{
      width:393px;min-height:65px;height:65px;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;
      padding:10px 12px;font:400 14px/17px Roboto;color:#000;text-transform:capitalize;resize:vertical;
    }

    /* Label “Description du sujet :” — typo */
    #liste-sujets .lbl{font:700 15px/20px Roboto;color:#2A2916;margin:6px 0 6px}

    /* Champ Description — cadre 393×156 (toolbar 36 + zone 120) */
    #liste-sujets .rte{width:393px;border:1px solid #DBD9C3;border-radius:5px;background:#fff}
    /* Toolbar avec B | I | attach | menu + séparateurs fins */
    #liste-sujets .rte-toolbar{
      height:36px;display:flex;align-items:center;gap:8px;padding:0 8px;background:#EFEDE3;border-bottom:1px solid #DBD9C3;border-top-left-radius:5px;border-top-right-radius:5px;
    }
    #liste-sujets .rte-btn{
      height:24px;min-width:24px;padding:0 6px;border:0;background:transparent;border-radius:4px;
      display:grid;place-items:center;font:700 14px/19px Roboto;color:#6E6D55;cursor:pointer;
    }
    #liste-sujets .rte-btn:hover{background:#E4E2D6}
    #liste-sujets .rte-sep{width:1px;height:16px;background:#DBD9C3}
    #liste-sujets .rte-icon{height:24px;min-width:24px;border:0;background:transparent;display:grid;place-items:center;cursor:pointer}
    #liste-sujets .rte-icon img{width:16px;height:16px;display:block}
    #liste-sujets .rte-area{
      min-height:120px;padding:10px;outline:none;border-bottom-left-radius:5px;border-bottom-right-radius:5px;font:400 14px/20px Roboto;color:#2A2916;
    }
    #liste-sujets .rte-area:empty:before{content:attr(data-placeholder);color:#8A887A;pointer-events:none}

    /* Pièce jointe (393×35) + bouton Importer (112×35), collés */
    #liste-sujets .file-row{display:flex;align-items:center;width:393px}
    #liste-sujets .file-row .fake{
      flex:1;height:35px;background:#FFFFFF;border:1px solid #DBD9C3;border-right:none;border-radius:5px 0 0 5px;
      padding:0 12px;font:400 14px/17px Roboto;color:#2A2916;
    }
    #liste-sujets .file-row .fake::placeholder{color:#A6A59F}
    #liste-sujets .btn-upload{
      width:112px;height:35px;background:#A6A485;border:1px solid #A6A485;border-radius:0 5px 5px 0;color:#fff;
      display:inline-flex;align-items:center;justify-content:center;gap:8px;font:600 14px/17px Roboto;cursor:pointer;
    }
    #liste-sujets .btn-upload img{width:13px;height:13px;transform:rotate(180deg);filter:brightness(0) invert(1)}

    /* Select “Choisir Un Encadrant” (393×40) — chevron + trait identiques */
    #liste-sujets #f-encadrant{width:100%;height:40px;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;padding:0 42px 0 12px;font:400 14px/17px Roboto;appearance:none;text-transform:capitalize}
    #liste-sujets #f-encadrant.placeholder{color:#CFCFCF}

    /* Année académique (393×35) + trait 17px + icône calendrier 13×13 */
    #liste-sujets .inp-wrap{position:relative;width:393px}
    #liste-sujets .inp{
      width:100%;height:35px;background:#FFFFFF;border:1px solid #DBD9C3;border-radius:5px;
      padding:0 42px 0 12px;font:400 14px/17px Roboto;color:#000;text-transform:capitalize;
    }
    #liste-sujets .inp::placeholder{color:#CFCFCF}
    #liste-sujets .inp-wrap::before{content:"";position:absolute;top:50%;right:34px;transform:translateY(-50%);width:0;height:17px;border-left:1px solid #DBD9C3;opacity:1}
    #liste-sujets .inp-wrap .cal{
      position:absolute;top:50%;right:12px;transform:translateY(-50%);
      width:13px;height:13px;opacity:1;background:url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-calendar.png') center/contain no-repeat;
    }
    


    /* Même calcul de colonnes pour head et body */
#liste-sujets .table-head table,
#liste-sujets .tbl{
  table-layout: fixed;
}

/* Réserve la place de la scrollbar pour éviter le décalage horizontal */
#liste-sujets .table-body{
  scrollbar-gutter: stable;
}

  </style>

  <!-- Header -->
  <div class="header">
    <span class="icon" aria-hidden="true"></span>
    <div class="title">Liste des sujets</div>
  </div>

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="search">
      <input type="text" id="sujets-search" placeholder="Recherche…">
      <button class="btn" id="btn-search" title="Rechercher"><i class="fa fa-search"></i></button>
    </div>
    <div class="spacer"></div>
    <button class="btn-icon" id="btn-export" title="Télécharger">
      <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/Groupe%20152.png" alt="Télécharger">
    </button>
    <button class="btn-primary" id="btn-add"><i class="fa fa-plus"></i> Ajouter un sujet</button>
  </div>

  <!-- Table Head -->
  <div class="table-head">
    <table>
      <colgroup>
  <col style="width:36px">   <!-- checkbox -->
  <col>                      <!-- Titre (flex) -->
  <col style="width:260px">  <!-- Encadrants disponibles -->
  <col style="width:110px">  <!-- détails sujet (PDF) -->
  <col style="width:90px">   <!-- Action (kebab) -->
</colgroup>

      <thead>
        <tr>
          <th><input type="checkbox" class="chk" id="chk-all"></th>
          <th>Titre</th>
          <th>Encadrants disponibles</th>
          <th>détails sujet</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Table Body (exemple avec 4 lignes) -->
  <div class="table-body">
    <table class="tbl">
      <colgroup>
  <col style="width:36px">
  <col>
  <col style="width:260px">
  <col style="width:110px">
  <col style="width:90px">
</colgroup>

      <tbody id="sujets-tbody">
        <tr class="rel">
          <td><input type="checkbox" class="chk"></td>
          <td>Détection De Visages Par Apprentissage Profond</td>
          <td>Najib belhaj</td>
          <td><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/pdf-svgrepo-com%20(2).png" alt="PDF"></td>
          <td>
            <button class="kebab" data-menu="sm1">···</button>
            <div class="dropdown" id="sm1">
              <a href="#" class="act-edit"><img class="ico" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier</a>
              <a href="#" class="act-del"><i class="fa-regular fa-trash-can"></i> supprimer</a>
            </div>
          </td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox" class="chk"></td>
          <td>Chatbot Intelligent Pour Le Support Client</td>
          <td>Walid Smida</td>
          <td><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/pdf-svgrepo-com%20(2).png" alt="PDF"></td>
          <td>
            <button class="kebab" data-menu="sm2">···</button>
            <div class="dropdown" id="sm2">
              <a href="#" class="act-edit"><img class="ico" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier</a>
              <a href="#" class="act-del"><i class="fa-regular fa-trash-can"></i> supprimer</a>
            </div>
          </td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox" class="chk"></td>
          <td>Analyse De Sentiments Sur Twitter En IA</td>
          <td>Sonia Hajji</td>
          <td><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/pdf-svgrepo-com%20(2).png" alt="PDF"></td>
          <td>
            <button class="kebab" data-menu="sm3">···</button>
            <div class="dropdown" id="sm3">
              <a href="#" class="act-edit"><img class="ico" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier</a>
              <a href="#" class="act-del"><i class="fa-regular fa-trash-can"></i> supprimer</a>
            </div>
          </td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox" class="chk"></td>
          <td>Prédiction Des Ventes Avec Le Machine Learning</td>
          <td>–</td>
          <td><img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/pdf-svgrepo-com%20(2).png" alt="PDF"></td>
          <td>
            <button class="kebab" data-menu="sm4">···</button>
            <div class="dropdown" id="sm4">
              <a href="#" class="act-edit"><img class="ico" src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier</a>
              <a href="#" class="act-del"><i class="fa-regular fa-trash-can"></i> supprimer</a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="pager">
    <button class="pbtn" title="Première">«</button>
    <button class="pbtn" title="Précédent">‹</button>
    <span class="pnum" title="Page courante">2</span>
    <button class="pbtn" title="Suivant">›</button>
    <button class="pbtn" title="Dernière">»</button>
  </div>

  <!-- ===== Offcanvas ===== -->
  <div class="sb-backdrop" id="sbBackdrop"></div>
  <aside class="sb" id="sb" aria-hidden="true">
    <div class="sb-head">
      <h3 class="sb-title" id="sbTitle">Ajouter un sujet de memoire</h3>
      <button class="sb-save" id="sbSave">Enregistrer</button>
    </div>

    <div class="sb-body">
      <!-- 1) Select diplôme (393×40) -->
      <div class="fld sel-wrap">
        <select class="sel" id="f-diplome">
          <option>Master De Recherche</option>
          <option>Master Professionnel</option>
          <option>Licence</option>
        </select>
      </div>

      <!-- 2) Titre (textarea 393×65) -->
      <div class="fld">
        <textarea class="txt" id="f-titre" rows="2" placeholder="Titre du sujet"></textarea>
      </div>

      <!-- 3) Description (cadre 393×156) -->
      <div class="fld">
        <div class="lbl">Description du sujet :</div>
        <div class="rte" id="rteDesc">
          <div class="rte-toolbar">
            <button type="button" class="rte-btn" data-cmd="bold">B</button>
            <span class="rte-sep"></span>
            <button type="button" class="rte-btn" data-cmd="italic"><i>I</i></button>
            <span class="rte-sep"></span>
            <button type="button" class="rte-icon" title="Joindre">
              <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-attach-2.png" alt="Attach">
            </button>
            <span class="rte-sep"></span>
            <button type="button" class="rte-icon" title="Menu">
              <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27) Icon-menu.png" alt="Menu">
            </button>
          </div>
          <div id="f-desc" class="rte-area" contenteditable="true" data-placeholder="Saisir la description détaillée du sujet…"></div>
        </div>
      </div>

      <!-- 4) Pièce jointe + Importer (393×35 + 112×35) -->
      <div class="fld file-row">
        <input class="inp fake" id="f-file-name" type="text" placeholder="Pièce jointe" readonly>
        <input type="file" id="f-file" accept="application/pdf" hidden>
        <button type="button" class="btn-upload" id="btnUpload">
          <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-upload.png" alt="Importer">
          Importer
        </button>
      </div>

      <!-- 5) Choisir un encadrant (393×40, placeholder gris) -->
      <div class="fld sel-wrap">
        <select class="sel placeholder" id="f-encadrant">
          <option value="" selected disabled>Choisir Un Encadrant</option>
          <option>Najib belhaj</option>
          <option>Walid Smida</option>
          <option>Sonia Hajji</option>
          <option>Sofiane Chaieb</option>
        </select>
      </div>

      <!-- 6) Année académique (393×35) -->
      <div class="fld inp-wrap">
        <input class="inp" id="f-annee" type="text" placeholder="Année Académique">
        <span class="cal" aria-hidden="true"></span>
      </div>
    </div>
  </aside>

<script>
  (function(){
    /* Menus contextuels */
    const closeAll = ()=>document.querySelectorAll('#liste-sujets .dropdown').forEach(d=>d.style.display='none');
    document.querySelectorAll('#liste-sujets .kebab').forEach(btn=>{
      btn.addEventListener('click',e=>{
        e.stopPropagation();
        const m=document.getElementById(btn.dataset.menu);
        const shown=m.style.display==='block';
        closeAll(); m.style.display = shown ? 'none' : 'block';
      });
    });
    document.addEventListener('click', closeAll);
    window.addEventListener('scroll', closeAll, {passive:true});
    document.addEventListener('keydown', e=>{ if(e.key==='Escape') closeAll(); });

    /* Offcanvas open/close */
    const sb   = document.getElementById('sb');
    const bd   = document.getElementById('sbBackdrop');
    const btnAdd  = document.getElementById('btn-add');
    const btnSave = document.getElementById('sbSave');
    const sbTitle = document.getElementById('sbTitle');

    function openSB(){ sb.classList.add('open'); bd.classList.add('open'); sb.setAttribute('aria-hidden','false'); document.body.classList.add('no-scroll'); }
    function closeSB(){ sb.classList.remove('open'); bd.classList.remove('open'); sb.setAttribute('aria-hidden','true'); document.body.classList.remove('no-scroll'); }

    // Réinitialiser le formulaire pour "Ajouter"
    function resetForm(){
      const fd = document.getElementById('f-diplome');
      if (fd) fd.selectedIndex = 0;
      document.getElementById('f-titre').value = '';
      document.getElementById('f-desc').innerHTML = '';
      document.getElementById('f-file-name').value = '';
      const fi = document.getElementById('f-file'); if (fi) fi.value = '';
      const encSel = document.getElementById('f-encadrant'); encSel.value = '';
      updateEnc(); // remet le style placeholder
      document.getElementById('f-annee').value = '';
    }

    // “Ajouter un sujet”
    btnAdd.addEventListener('click', ()=>{
      sbTitle.textContent = 'Ajouter un sujet de memoire';
      resetForm();
      openSB();
    });

    bd.addEventListener('click', closeSB);
    document.addEventListener('keydown', e=>{ if(e.key==='Escape') closeSB(); });
    btnSave.addEventListener('click', ()=>{ /* submit ici */ closeSB(); });

    /* RTE commandes (B/I) */
    document.querySelectorAll('#rteDesc .rte-btn').forEach(b=>{
      b.addEventListener('click', ()=>{
        document.execCommand(b.dataset.cmd, false, null);
        document.getElementById('f-desc').focus();
      });
    });

    /* Upload */
    const btnUpload=document.getElementById('btnUpload');
    const fileInput=document.getElementById('f-file');
    const fileName=document.getElementById('f-file-name');
    btnUpload.addEventListener('click', ()=> fileInput.click());
    fileInput.addEventListener('change', ()=>{ fileName.value = fileInput.files?.[0]?.name || ''; });

    /* Recherche simple */
    const rows=[...document.querySelectorAll('#sujets-tbody tr')];
    document.getElementById('btn-search').addEventListener('click',()=>{
      const q=(document.getElementById('sujets-search').value||'').toLowerCase();
      rows.forEach(tr=> tr.style.display = tr.innerText.toLowerCase().includes(q) ? '' : 'none');
    });

    /* Check global */
    const chkAll=document.getElementById('chk-all');
    chkAll.addEventListener('change',()=> document.querySelectorAll('#sujets-tbody .chk').forEach(c=>c.checked=chkAll.checked));

    /* Placeholder “Choisir un encadrant” */
    const enc=document.getElementById('f-encadrant');
    function updateEnc(){ if(!enc.value) enc.classList.add('placeholder'); else enc.classList.remove('placeholder'); }
    enc.addEventListener('change', updateEnc); updateEnc();

    /* ======== NOUVEAU : ouvrir l’offcanvas sur “Modifier” et pré-remplir ======== */
    document.querySelectorAll('#liste-sujets .act-edit').forEach(link=>{
      link.addEventListener('click', (e)=>{
        e.preventDefault();
        closeAll(); // fermer le menu kebab

        const tr   = link.closest('tr');
        const titre= tr?.children[1]?.textContent.trim() || '';
        const encName = tr?.children[2]?.textContent.trim() || '';

        // Titre offcanvas
        sbTitle.textContent = 'Modifier le sujet';

        // Pré-remplir
        document.getElementById('f-titre').value = titre;
        document.getElementById('f-desc').innerHTML = '';           // pas de desc en source, on laisse vide
        document.getElementById('f-file-name').value = '';          // pas de fichier en source
        document.getElementById('f-annee').value = '';              // pas d’année en source

        // Sélectionner l’encadrant par texte (insensible à la casse)
        const sel = document.getElementById('f-encadrant');
        let matchVal = '';
        [...sel.options].forEach(o=>{
          if (o.text.trim().toLowerCase() === encName.toLowerCase()) matchVal = o.value;
        });
        sel.value = matchVal; // '' si pas trouvé ou “–”
        updateEnc();

        openSB();
      });
    });

  })();
</script>

</section>
