<section id="vc-history">
  <style>
    #vc-history{background:#fff;border:1px solid #E8E6DB;border-radius:10px;
      box-shadow:0 6px 24px rgba(0,0,0,.08);padding:14px;font-family:Roboto,system-ui}
    #vc-history .head{display:flex;align-items:center;gap:10px;border-bottom:1px solid #EBE9D7;padding-bottom:8px;margin-bottom:10px}
    #vc-history .ico{width:28px;height:28px;border-radius:4px;background:#fff url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/9368448.png') center/contain no-repeat}
    #vc-history .title{font:700 18px/1 Roboto;color:#2A2916}
    #vc-history .btn-add{margin-left:auto;height:36px;border-radius:6px;border:1px solid #BF0404;background:#BF0404;color:#fff;padding:0 12px;font-weight:600;cursor:pointer}
    #vc-history .toolbar{display:flex;align-items:center;gap:10px;margin:10px 0}
    #vc-history .search{flex:1;display:flex;align-items:center;gap:8px;height:36px;border:1px solid #DBD9C3;border-radius:6px;background:#fff;padding:0 10px;max-width:280px}
    #vc-history .search input{flex:1;border:0;outline:none;background:transparent;font-size:14px}
    #vc-history .btn-icon{height:26px;border-radius:6px;border:1px solid #DBD9C3;background:#fff;display:grid;place-items:center;cursor:pointer}

    /* Head du tableau */
    #vc-history .table-head{background:#EDEBDF;border:1px solid #A6A4853D;border-radius:8px;padding:0 8px;height:45px;display:flex;align-items:center}
    #vc-history .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #vc-history th{font:700 14px Roboto;color:#2A2916;text-align:left;padding:0 12px;white-space:nowrap}
    #vc-history th:first-child{width:36px;text-align:center}
    #vc-history th:nth-child(3){width:auto}
    #vc-history th:nth-child(4){width:120px;text-align:center}
    #vc-history th:nth-child(5){width:120px;text-align:center}
    #vc-history th:nth-child(6){width:160px;text-align:center}
    #vc-history th:nth-child(7){width:90px;text-align:center}

    /* Body */
    #vc-history .table-body{background:#fff;border:2px solid #EBE9D7;border-radius:8px;margin-top:8px;overflow:auto}
    #vc-history .tbl{width:100%;border-collapse:separate;border-spacing:0;min-width:760px}
    #vc-history td{padding:12px;border-bottom:1px solid #EBE9D7;font:400 14px Roboto;color:#2A2916;vertical-align:middle;background:#fff}
    #vc-history tr:last-child td{border-bottom:none}
    #vc-history td:first-child{width:36px;text-align:center}
    #vc-history td:nth-child(2){width:110px}
    #vc-history td:nth-child(3){border-right:1px solid #EBE9D7}
    #vc-history td:nth-child(6), #vc-history td:nth-child(7){text-align:center;border-left:1px solid #EBE9D7}

    /* Icônes */
    #vc-history .eye{font-size:18px;opacity:.9}
    #vc-history .kebab{width:30px;height:30px;border-radius:8px;border:1px solid transparent;background:#fff;cursor:pointer;font-size:20px;line-height:1}
    #vc-history .kebab:hover{background:#F2F1EA}
    #vc-history .dropdown{position:absolute;right:12px;top:36px;background:#fff;border:1px solid #E6E3D3;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,.08);min-width:170px;padding:6px;display:none;z-index:5}
    #vc-history .dropdown a{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:6px;text-decoration:none;color:#2A2916;font-size:14px}
    #vc-history .dropdown a:hover{background:#F3F2EA}
    #vc-history .rel{position:relative}

    /* Pagination */
    #vc-history .pager{display:flex;gap:6px;justify-content:flex-end;margin-top:12px}
    #vc-history .pbtn{width:32px;height:32px;border:2px solid #BF0404;background:#fff;color:#BF0404;border-radius:6px;font-weight:800;cursor:pointer}
  
  #vc-history .btn-icon img{
  width:16px;        /* ← ajuste (12–18px) selon ton goût */
  height:16px;
  object-fit:contain;
  display:block;     /* évite le petit décalage vertical */
}

  
  </style>

  <!-- En-tête -->
  <div class="head">
    <span class="ico" aria-hidden="true"></span>
    <div class="title">Historique des vidéoconférences</div>
    <button class="btn-add"><i class="fa fa-plus"></i> Programmer une réunion</button>
  </div>

  <!-- Barre outils -->
  <div class="toolbar">
    <div class="search">
      <input type="text" id="vc-search" placeholder="Recherche…">
      <i class="fa fa-search"></i>
    </div>
    <div style="flex:1"></div>
    <button class="btn-icon" title="Télécharger"><img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt=""></button>
  </div>

  <!-- Table -->
  <div class="table-head">
    <table><thead>
      <tr>
        <th><input type="checkbox" id="chk-all"></th>
        <th>Date</th>
        <th>sujet</th>
        <th>Durée</th>
        <th>Participants</th>
        <th>Lien d’enregistrement</th>
        <th>Action</th>
      </tr>
    </thead></table>
  </div>

  <div class="table-body">
    <table class="tbl">
      <tbody id="vc-tbody">
        <tr class="rel">
          <td><input type="checkbox"></td>
          <td>12/01/2025</td>
          <td>Encadrement</td>
          <td style="text-align:center">1h20</td>
          <td style="text-align:center">6</td>
          <td><i class="fa-regular fa-eye eye"></i></td>
          <td><button class="kebab" data-menu="m1">···</button><div class="dropdown" id="m1"><a href="#"><i class="fa-regular fa-file-lines"></i> Détails</a><a href="#"><i class="fa-regular fa-trash-can"></i> Supprimer</a></div></td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox"></td>
          <td>12/01/2025</td>
          <td>Soutenance PFE - Grp A1</td>
          <td style="text-align:center">57min</td>
          <td style="text-align:center">3</td>
          <td><i class="fa-regular fa-eye eye"></i></td>
          <td><button class="kebab" data-menu="m2">···</button><div class="dropdown" id="m2"><a href="#"><i class="fa-regular fa-file-lines"></i> Détails</a><a href="#"><i class="fa-regular fa-trash-can"></i> Supprimer</a></div></td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox"></td>
          <td>12/01/2025</td>
          <td>Soutenance Mastère IA</td>
          <td style="text-align:center">1h43</td>
          <td style="text-align:center">4</td>
          <td><i class="fa-regular fa-eye eye"></i></td>
          <td><button class="kebab" data-menu="m3">···</button><div class="dropdown" id="m3"><a href="#"><i class="fa-regular fa-file-lines"></i> Détails</a><a href="#"><i class="fa-regular fa-trash-can"></i> Supprimer</a></div></td>
        </tr>
        <tr class="rel">
          <td><input type="checkbox"></td>
          <td>12/01/2025</td>
          <td>Encadrement</td>
          <td style="text-align:center">1h03</td>
          <td style="text-align:center">6</td>
          <td><i class="fa-regular fa-eye eye"></i></td>
          <td><button class="kebab" data-menu="m4">···</button><div class="dropdown" id="m4"><a href="#"><i class="fa-regular fa-file-lines"></i> Détails</a><a href="#"><i class="fa-regular fa-trash-can"></i> Supprimer</a></div></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="pager">
    <button class="pbtn" title="Première">«</button>
    <button class="pbtn" title="Précédent">‹</button>
    <button class="pbtn" title="Suivant">›</button>
    <button class="pbtn" title="Dernière">»</button>
  </div>

  <script>
    (function(){
      // menu kebab
      const closeAll=()=>document.querySelectorAll('#vc-history .dropdown').forEach(d=>d.style.display='none');
      document.querySelectorAll('#vc-history .kebab').forEach(b=>{
        b.addEventListener('click',e=>{
          e.stopPropagation();
          const m=document.getElementById(b.dataset.menu);
          const open=m.style.display==='block';
          closeAll(); m.style.display=open?'none':'block';
        });
      });
      document.addEventListener('click', closeAll);

      // recherche simple
      const rows=[...document.querySelectorAll('#vc-tbody tr')];
      document.getElementById('vc-search').addEventListener('input',e=>{
        const q=e.target.value.toLowerCase();
        rows.forEach(tr=>tr.style.display = tr.innerText.toLowerCase().includes(q)?'':'none');
      });

      // select all
      const all=document.getElementById('chk-all');
      if(all) all.addEventListener('change',()=>document.querySelectorAll('#vc-tbody input[type="checkbox"]').forEach(c=>c.checked=all.checked));
    })();
  </script>
</section>
