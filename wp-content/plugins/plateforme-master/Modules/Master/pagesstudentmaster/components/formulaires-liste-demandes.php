<section class="card" id="listes-demandes">
  <style>
    /* ====== Styles SCOPÉS au composant : #listes-demandes ====== */
    #listes-demandes{
      background:#ffffff;border:1px solid #e8e6db;border-radius:12px;
      box-shadow:0 10px 22px rgba(0,0,0,.08);padding:14px 14px 8px;margin-bottom:20px;
      color:#1c1c1c;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial,sans-serif;
    }
    #listes-demandes .section-title{
      display:flex;align-items:center;gap:.6rem;font-weight:700;margin:6px 0 12px;font-size:1.05rem;
    }
    
    #listes-demandes .title-icon img{width:30px;height:36px;display:block; margin-left: 10px;}
    #listes-demandes .section-separator{margin:8px 0;border:0;border-top:2px solid #e8e6db}

    /* Table head */
    #listes-demandes .table-head{background:#ECEBE3 0% 0% no-repeat padding-box;border:1px solid #e8e6db;border-radius:12px;padding:8px 10px}
    #listes-demandes .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #listes-demandes .table-head th{text-align:left;color:#777568;font-weight:700;padding:8px 12px;font-size:.94rem; color: #1c1c1c;}
    #listes-demandes .table-head th:first-child{width:44px}
    #listes-demandes .table-head th:nth-child(2){width:120px}
    #listes-demandes .table-head th:nth-child(4),
    #listes-demandes .table-head th:nth-child(5){width:140px;text-align:center}

    /* Table body */
    #listes-demandes .table-body{background:#fff;border:1px solid #e8e6db;border-radius:12px;margin-top:8px;overflow:hidden}
    #listes-demandes .tbl{width:100%;border-collapse:separate;border-spacing:0}
    #listes-demandes .tbl td{
      background:#fbfbf7;padding:14px 12px;border-bottom:1px solid #e8e6db;vertical-align:middle;font-size:.95rem;
    }
    #listes-demandes .tbl tr:last-child td{border-bottom:none}
    #listes-demandes .tbl td:nth-child(4), #listes-demandes .tbl td:nth-child(5),
    #listes-demandes .table-head th:nth-child(4), #listes-demandes .table-head th:nth-child(5){
      border-left:1px solid #e8e6db;width:140px;text-align:center;
    }

    /* Col.1 checkbox + ref + icônes */
    #listes-demandes .chk{width:16px;height:16px;cursor:pointer;accent-color:#6b6c4a}
    #listes-demandes .ref{display:inline-block;min-width:42px;text-align:center;padding:2px 8px;border-radius:6px;font-weight:600}
    #listes-demandes .cell-center{text-align:center; width: 10px;}
    #listes-demandes .icon{
      display:inline-flex;place-items:center;width:30px;height:30px;cursor:pointer;
      transition:transform .12s,box-shadow .12s;border:none;background:transparent
    }
    #listes-demandes .icon:hover{transform:translateY(-1px);box-shadow:0 6px 14px rgba(0,0,0,.08)}
    #listes-demandes .icon img{width:20px;height:20px;display:block}
#listes-demandes .icon img{
  width:14px;
  height:14px;
}


  </style>

  <div class="section-title">
    <span class="title-icon" aria-hidden="true">
      <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/listing-list.png" alt="">
    </span>
    Liste des demandes
  </div>
  <hr class="section-separator">

  <div class="table-head">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox" class="chk" data-master="#tbl1"></th>
          <th>Référence</th>
          <th>Nom de demande</th>
          <th>Fichier</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <div class="table-body">
    <table class="tbl">
      <tbody id="tbl1">
        <tr>
          <td><input type="checkbox" class="chk"></td>
          <td><span class="ref">001</span></td>
          <td>Demande d’attestation de présence</td>
          <td class="cell-center">
            <button class="icon eye" title="Aperçu">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-eye.png" alt="Aperçu">
            </button>
          </td>
          <td class="cell-center">
            <button class="icon dl" title="Téléverser">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </td>
        </tr>

        <tr>
          <td><input type="checkbox" class="chk"></td>
          <td><span class="ref">002</span></td>
          <td>Demande Retrait d'inscription</td>
          <td class="cell-center">
            <button class="icon eye" title="Aperçu">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-eye.png" alt="Aperçu">
            </button>
          </td>
          <td class="cell-center">
            <button class="icon dl" title="Téléverser">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </td>
        </tr>

        <tr>
          <td><input type="checkbox" class="chk"></td>
          <td><span class="ref">003</span></td>
          <td>Demande De Réintégration</td>
          <td class="cell-center">
            <button class="icon eye" title="Aperçu">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-eye.png" alt="Aperçu">
            </button>
          </td>
          <td class="cell-center">
            <button class="icon dl" title="Téléverser">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </td>
        </tr>

        <tr>
          <td><input type="checkbox" class="chk"></td>
          <td><span class="ref">004</span></td>
          <td>Demande De Vérification De L’élimination</td>
          <td class="cell-center">
            <button class="icon eye" title="Aperçu">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-eye.png" alt="Aperçu">
            </button>
          </td>
          <td class="cell-center">
            <button class="icon dl" title="Téléverser">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </td>
        </tr>

        <tr>
          <td><input type="checkbox" class="chk"></td>
          <td><span class="ref">005</span></td>
          <td>Demande D’aide Sociale</td>
          <td class="cell-center">
            <button class="icon eye" title="Aperçu">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-eye.png" alt="Aperçu">
            </button>
          </td>
          <td class="cell-center">
            <button class="icon dl" title="Téléverser">
              <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/upload-red.png" alt="Upload">
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
