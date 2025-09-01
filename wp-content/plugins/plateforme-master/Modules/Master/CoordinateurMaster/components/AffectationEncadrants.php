<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Affectation des encadrants</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    /* ============== Styles SCOPÉS ============== */
    #demandes-service{
      background:#FFFFFF;
      box-shadow:0px 3px 22px #0000000F;
      border-radius:8px;border:1px solid #e8e6db;
      padding:12px 14px 14px;
      color:#2A2916;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
       margin: 20px auto;
    }

    /* Titre + icône */
    #demandes-service .section-title{
      display:flex;align-items:center;gap:10px;
      font-weight:700;font-size:20px;line-height:26px;margin:6px 0 8px;
    }
    #demandes-service .title-icon{
      width:32px;height:34px;flex:0 0 32px;
      background: transparent url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/9368448.png') 0 0/contain no-repeat;
    }

    /* Séparateur */
    #demandes-service .section-separator{border:0;border-top:1px solid #ECEBE3;height:0;margin:8px 0 10px}

    /* Toolbar */
    #demandes-service .toolbar{display:flex;align-items:center;gap:12px;margin-bottom:10px}
    .search{width:255px;height:35px;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #DBD9C3;border-radius:6px;padding:0 10px}
    .search input{flex:1;border:0;outline:none;background:transparent;font-size:14px;color:#2A2916}
    .search img{width:16px;height:16px;display:block}
    .quota{display:flex;align-items:center;height:35px;border:1px solid #DBD9C3;border-radius:6px;overflow:hidden;background:#fff}
    .quota .label{padding:0 12px;font-weight:500;font-size:14px}
    .quota .value{padding-right:12px}
    .quota .btn-validate{height:35px;border:0;border-left:1px solid #DBD9C3;background:#BF0404;color:#fff;padding:0 14px;cursor:pointer;font-weight:600}

    .btn-download{margin-left:auto;width:40px;height:40px;border-radius:5px;border:0;cursor:pointer;background:#fff;box-shadow:0 0 6px #00000030;display:grid;place-items:center}
    .btn-download img{width:18px;height:18px}

    /* ====== TABLE HEAD ====== */
    #demandes-service .table-head{
      background:#ECEBE3;border:1px solid #A6A4853D;border-radius:8px;padding:0 8px;height:45px;display:flex;align-items:center
    }
    #demandes-service .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #demandes-service .table-head th{
      text-align:left;font-weight:700;font-size:15px;line-height:20px;color:#2A2916;padding:0 12px;border:0
    }
    #demandes-service .table-head th:first-child{width:32px;padding-left:6px}
    #demandes-service .table-head .nom{padding-left:10px}
    #demandes-service .table-head .fonction{padding-left:6px}
    #demandes-service .table-head th:nth-last-child(2){text-align:center;width:160px}
    #demandes-service .table-head th:last-child{text-align:center;width:110px}

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
    #demandes-service .tbl td.nom{padding-left:10px}
    #demandes-service .tbl td.fonction{padding-left:6px}
    #demandes-service .tbl td:nth-last-child(2){text-align:center;width:160px;border-left:1px solid #EBE9D7}
    #demandes-service .tbl td:last-child{text-align:center;width:110px;border-left:1px solid #EBE9D7}

    .chk{width:16px;height:16px;cursor:pointer;accent-color:#6b6c4a}
    .ref{display:inline-block;min-width:42px;text-align:center;padding:2px 8px;border-radius:6px;font-weight:600;background:#F3F2EA;color:#2A2916}

    /* Kebab + menu */
    .kebab{width:34px;height:34px;border-radius:8px;border:1px solid transparent;background:#fff;cursor:pointer;font-size:20px;line-height:1}
    .kebab:hover{background:#F2F1EA}
    .dropdown{position:absolute;right:12px;top:32px;background:#fff;border:1px solid #E6E3D3;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,.08);min-width:190px;padding:6px;display:none;z-index:5}
    .dropdown a{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:6px;text-decoration:none;color:#2A2916;font-size:14px}
    .dropdown a:hover{background:#F3F2EA}
    .dropdown img{width:14px;height:14px;display:block}
    #demandes-service .rel{position:relative}

    /* ====== PAGINATION ====== */
    #demandes-service .pagination{display:flex;gap:8px;justify-content:flex-end;padding:12px 0 4px}
    #demandes-service .pagination .pbtn.arrow{
      width:36px;height:36px;font-size:18px;
      border:2px solid #c40000;color:#c40000;background:#fff;border-radius:6px;cursor:pointer;font-weight:800
    }
    #demandes-service .pagination .pbtn.page{
      min-width:32px;height:32px;border:none;background:#fff;color:#c40000;font-weight:800;border-radius:6px;cursor:pointer
    }
#demandes-service .pagination .pbtn.page.active {
  color:#000;  font-size: 18px;         /* texte blanc */
}

    /* ====== SIDEBAR ====== */
    #demandes-service .sidebar-backdrop{
      position:fixed;inset:0;background:rgba(0,0,0,.4);
      opacity:0;pointer-events:none;transition:opacity .2s;
      z-index:10040; /* au-dessus de la navbar */
    }
    #demandes-service .sidebar{
      position:fixed;top:0;right:-450px;
      width:450px;height:100vh;max-width:90vw;
      background:#FFFFFF;border-left:1px solid #E7E4D7;
      box-shadow:-7px 0 36px #00000029;
      z-index:10050;
      display:flex;flex-direction:column;
      padding:0; /* ⬅️ collé en haut, pas d'espace */
    }

    /* Head : même largeur, collé en haut, ombre haut & bas */
    #demandes-service .sb-head{
      position:sticky; top:0; /* reste en haut quand on scroll */
      height:60px;
      margin:0; /* aucune marge */
      padding:12px 16px 12px 23px;
      background:#FFFFFF;
      border-radius:0; /* pas d'arrondi pour coller au bord */
      box-shadow:0 5px 16px #00000029, 0 -5px 16px #00000029; /* bas + haut */
      display:flex;align-items:center;justify-content:space-between;
      z-index:1;
    }
    #demandes-service .sb-title{
      margin:0;
      font:normal normal bold 18px/24px Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
      letter-spacing:0;color:#2A2916;
    }
    #demandes-service .sb-save{
      width:108px;height:35px;cursor:pointer;
      background:#BF0404;color:#FFFFFF;border:1px solid #BF0404;border-radius:5px;
      font:normal normal normal 15px/20px Roboto, system-ui;
      box-shadow:0 3px 6px rgba(0,0,0,.16);
    }
    #demandes-service .sb-save:hover{ filter:brightness(.96); }

    /* Zone filtre immédiatement sous le head */
    #demandes-service .sb-filter{
      padding:18px 20px 14px 23px;
    }
    #demandes-service .sb-filter-labels{margin-bottom:10px}
    #demandes-service .lbl-title{font:500 15px/18px Roboto;color:#2A2916}
    #demandes-service .lbl-sub{margin-top:7px;font:400 14px/17px Roboto;color:#2A2916;text-transform:capitalize}

    /* Select stylé */
    #demandes-service .sb-select{
      position:relative;display:flex;align-items:center;
      width:393px;max-width:100%;height:40px;border:1px solid #DBD9C3;border-radius:5px;
      background:#FFFFFF;padding:0 40px 0 14px
    }
    #demandes-service .sb-select .sel-value{font:400 14px/17px Roboto;color:#000;text-transform:capitalize}
    #demandes-service .sb-select .sel-divider{
      position:absolute;right:40px;width:0;height:22px;border-right:1px solid #DBD9C3
    }
    #demandes-service .sb-select .sel-caret{position:absolute;right:12px;pointer-events:none}
    #demandes-service .sb-select select{position:absolute;inset:0;opacity:0;cursor:pointer}

    /* Liste étudiants */
    #demandes-service .sb-body{
      flex:1; overflow-y:auto;
      scrollbar-width:none; -ms-overflow-style:none; /* cache la barre */
    }
    #demandes-service .sb-body::-webkit-scrollbar{ width:0; height:0; display:none; }

    /* Bloquer le scroll de la PAGE quand le sidebar est ouvert */
    body.no-scroll{ overflow:hidden; }

    #demandes-service .students{list-style:none;margin:0;padding:0}
    #demandes-service .stu{
      display:flex;align-items:center;gap:12px;padding:10px 20px 10px 23px
    }
    /* 1er item opacité 0.43 (selon maquette) */
    #demandes-service .stu:first-child{opacity:.43}

    /* Checkbox custom compacte */
    #demandes-service .chk-wrap{position:relative;width:18px;height:18px;display:inline-grid;place-items:center}
    #demandes-service .stu-chk{position:absolute;opacity:0}
    #demandes-service .chk-ui{width:16px;height:16px;border:1px solid #cfcbb8;border-radius:3px;background:#fff;display:block}
    #demandes-service .stu-chk:checked + .chk-ui{background:#BF0404;border-color:#BF0404}
    #demandes-service .stu-chk:checked + .chk-ui:after{
      content:"";display:block;width:8px;height:4px;border-left:2px solid #fff;border-bottom:2px solid #fff;
      transform:rotate(-45deg) translate(1px,2px);margin:auto
    }

    /* Avatar 43x43 */
    #demandes-service .avatar{
      width:43px;height:43px;border-radius:50%;background:#e9ecef;flex:0 0 43px;
      display:flex;align-items:center;justify-content:center;font:600 14px/1 Roboto;color:#666;overflow:hidden
    }
    #demandes-service .avatar img{width:100%;height:100%;object-fit:cover;display:block}

    /* Texte étudiant */
    #demandes-service .meta{min-width:0}
    #demandes-service .name{
      font:500 15px/18px Roboto;color:#2A2916;text-transform:capitalize;
      white-space:nowrap;overflow:hidden;text-overflow:ellipsis
    }
    #demandes-service .lvl{margin-top:3px;font:400 13px/15px Roboto;color:#2A2916;text-transform:capitalize}

    /* Toggle open */
    #demandes-service .sidebar.is-open{right:0}
    #demandes-service .sidebar-backdrop.is-open{opacity:1;pointer-events:auto}
  </style>
</head>
<body>

<section class="card" id="demandes-service">
  <!-- Titre -->
  <div class="section-title">
    <span class="title-icon" aria-hidden="true"></span>
    Affectation des encadrants
  </div>
  <hr class="section-separator">

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="search">
      <input type="text" placeholder="Recherche…" autocomplete="off" id="searchSupportsTab1">
      <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-search.png" alt="search">
    </div>

    <div class="quota">
      <span class="label">Cota Max :</span>
      <span class="value">5</span>
      <button class="btn-validate">Valider</button>
    </div>

    <button class="btn-download" title="Télécharger">
      <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="download">
    </button>
  </div>

  <!-- Head -->
  <div class="table-head">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox" class="chk"></th>
          <th class="nom">Nom de l'encadrant</th>
          <th class="fonction">Fonction</th>
          <th>Étudiants affectés</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Body -->
  <div class="table-body">
    <table class="tbl">
      <tbody id="tbl2">
        <tr class="rel">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after nom">Najib belhaj</td>
          <td class="sep-after fonction">Maître assistant</td>
          <td>0</td>
          <td>
            <button class="kebab" data-menu="m1">···</button>
            <div class="dropdown" id="m1">
              <a href="#" data-open="modifier">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier
              </a>
              <a href="#" data-open="affecter">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-collapse.png" alt=""> Affecter étudiants
              </a>
            </div>
          </td>
        </tr>

        <tr class="rel">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after nom">Walid Smida</td>
          <td class="sep-after fonction">Professeur</td>
          <td>0</td>
          <td>
            <button class="kebab" data-menu="m2">···</button>
            <div class="dropdown" id="m2">
              <a href="#" data-open="modifier">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier
              </a>
              <a href="#" data-open="affecter">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-collapse.png" alt=""> Affecter étudiants
              </a>
            </div>
          </td>
        </tr>

        <tr class="rel">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after nom">Sonia Hajji</td>
          <td class="sep-after fonction">Professeur</td>
          <td>0</td>
          <td>
            <button class="kebab" data-menu="m3">···</button>
            <div class="dropdown" id="m3">
              <a href="#" data-open="modifier">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier
              </a>
              <a href="#" data-open="affecter">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-collapse.png" alt=""> Affecter étudiants
              </a>
            </div>
          </td>
        </tr>

        <tr class="rel">
          <td class="sep-after"><input type="checkbox" class="chk"></td>
          <td class="sep-after nom">Sofiane Chaieb</td>
          <td class="sep-after fonction">Professeur</td>
          <td>0</td>
          <td>
            <button class="kebab" data-menu="m4">···</button>
            <div class="dropdown" id="m4">
              <a href="#" data-open="modifier">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-edit-2.png" alt=""> Modifier
              </a>
              <a href="#" data-open="affecter">
                <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/27)%20Icon-collapse.png" alt=""> Affecter étudiants
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="pagination">
    <button class="pbtn arrow" title="Première">≪</button>
    <button class="pbtn arrow" title="Précédent">‹</button>
  <button class="pbtn page active" title="Page 2">2</button> <!-- Ajout class="active" -->
    <button class="pbtn arrow" title="Suivant">›</button>
    <button class="pbtn arrow" title="Dernière">≫</button>
  </div>

  <!-- === Sidebar === -->
  <div class="sidebar-backdrop" id="sb-backdrop"></div>
  <aside class="sidebar" id="sb" aria-hidden="true">
    <div class="sb-head">
      <h3 class="sb-title">Affecter manuellement</h3>
      <button class="sb-save" id="btn-assign" type="button">Enregistrer</button>
    </div>

    <div class="sb-filter">
      <div class="sb-filter-labels">
        <div class="lbl-title">Liste des étudiants</div>
        <div class="lbl-sub">5 Maximum</div>
      </div>
      <div class="sb-select">
        <span class="sel-value" id="level-value">M1</span>
        <span class="sel-divider" aria-hidden="true"></span>
        <select id="level-select" aria-label="Niveau">
          <option value="M1" selected>M1</option>
          <option value="M2">M2</option>
          <option value="L3">L3</option>
        </select>
        <span class="sel-caret" aria-hidden="true">▾</span>
      </div>
    </div>

    <div class="sb-body">
      <ul class="students">
        <!-- 1 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk">
            <span class="chk-ui"></span>
          </label>
          <div class="avatar">MH</div>
          <div class="meta">
            <div class="name">Mourad Hammami</div>
            <div class="lvl">M1</div>
          </div>
        </li>
        <!-- 2 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk" checked>
            <span class="chk-ui"></span>
          </label>
          <div class="avatar"><img src="/wp-content/plugins/plateforme-master/images/etudiants/samer.jpg" alt=""></div>
          <div class="meta">
            <div class="name">Samer Ben Hsin</div>
            <div class="lvl">M2</div>
          </div>
        </li>
        <!-- 3 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk" checked>
            <span class="chk-ui"></span>
          </label>
          <div class="avatar"><img src="/wp-content/plugins/plateforme-master/images/etudiants/amira.jpg" alt=""></div>
          <div class="meta">
            <div class="name">Amira Slimeni</div>
            <div class="lvl">M2</div>
          </div>
        </li>
        <!-- 4 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk">
            <span class="chk-ui"></span>
          </label>
          <div class="avatar">MM</div>
          <div class="meta">
            <div class="name">Manel Mahdoui</div>
            <div class="lvl">M1</div>
          </div>
        </li>
        <!-- 5 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk" checked>
            <span class="chk-ui"></span>
          </label>
          <div class="avatar">MH</div>
          <div class="meta">
            <div class="name">Mourad Hammami</div>
            <div class="lvl">M2</div>
          </div>
        </li>
        <!-- 6 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk" checked>
            <span class="chk-ui"></span>
          </label>
          <div class="avatar">SH</div>
          <div class="meta">
            <div class="name">Samer Ben Hsin</div>
            <div class="lvl">M2</div>
          </div>
        </li>
        <!-- 7 -->
        <li class="stu">
          <label class="chk-wrap">
            <input type="checkbox" class="stu-chk" checked>
            <span class="chk-ui"></span>
          </label>
          <div class="avatar">AS</div>
          <div class="meta">
            <div class="name">Amira Slimeni</div>
            <div class="lvl">M2</div>
          </div>
        </li>
      </ul>
    </div>
  </aside>
</section>

<script>
(function(){
  /* ===== Menus kebab ===== */
  const kebabs = document.querySelectorAll('#demandes-service .kebab');
  const closeAllMenus = () =>
    document.querySelectorAll('#demandes-service .dropdown').forEach(d=>d.style.display='none');

  kebabs.forEach(btn=>{
    btn.addEventListener('click',(e)=>{
      e.stopPropagation();
      const menu=document.getElementById(btn.dataset.menu);
      const shown=menu.style.display==='block';
      closeAllMenus();
      menu.style.display = shown ? 'none' : 'block';
    });
  });
  document.addEventListener('click', closeAllMenus);

  /* ===== Sidebar ===== */
  const sb  = document.getElementById('sb');
  const bd  = document.getElementById('sb-backdrop');
  const saveBtn = document.getElementById('btn-assign');

  function openSB(title){
    const t = sb.querySelector('.sb-title');
    if(title) t.textContent = title;
    sb.classList.add('is-open');
    bd.classList.add('is-open');
    sb.setAttribute('aria-hidden','false');
    document.body.classList.add('no-scroll');   // empêche le scroll page
  }
  function closeSB(){
    sb.classList.remove('is-open');
    bd.classList.remove('is-open');
    sb.setAttribute('aria-hidden','true');
    document.body.classList.remove('no-scroll'); // réactive le scroll page
  }

  // Ouvrir depuis les dropdowns
  document.querySelectorAll('#demandes-service .dropdown a[data-open]').forEach(a=>{
    a.addEventListener('click',e=>{
      e.preventDefault();
      closeAllMenus();
      openSB(a.dataset.open==='modifier' ? 'Modifier encadrant' : 'Affecter manuellement');
    });
  });
  // Fermer en cliquant sur le backdrop
  bd.addEventListener('click', closeSB);

  // Limite à 5 sélectionnés + fermer au clic sur Enregistrer
  const maxSelections = 5;
  const checkboxes = () => [...document.querySelectorAll('#demandes-service .stu-chk')];

  // Blocage live du 6e
  checkboxes().forEach(cb=>{
    cb.addEventListener('change',()=>{
      const checked = checkboxes().filter(x=>x.checked);
      if(checked.length>maxSelections){
        cb.checked = false;
        alert('Vous ne pouvez sélectionner que 5 étudiants maximum.');
      }
    });
  });

  // Enregistrer -> fermer
  saveBtn.addEventListener('click', ()=>{
    const checked = checkboxes().filter(x=>x.checked);
    if(checked.length>maxSelections){
      alert('Vous ne pouvez sélectionner que 5 étudiants maximum.');
      return;
    }
    // TODO: logique d’enregistrement (AJAX/WordPress) ici
    closeSB();
  });

  // Sélecteur niveau (visuel)
  const levelSelect = document.getElementById('level-select');
  const levelValue  = document.getElementById('level-value');
  levelSelect.addEventListener('change', ()=> levelValue.textContent = levelSelect.value);
})();
</script>

</body>
</html>
