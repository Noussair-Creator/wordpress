<section class="card" id="demandes-service">
  <style>
    /* ====== Styles SCOPÉS au composant : #demandes-service ====== */
    #demandes-service{
      background:#ffffff;border:1px solid #e8e6db;border-radius:12px;
      box-shadow:0 10px 22px rgba(0,0,0,.08);padding:14px 14px 8px;margin-bottom:20px;
      color:#1c1c1c;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial,sans-serif;
    }
    #demandes-service .section-title{
      display:flex;align-items:center;gap:.6rem;font-weight:700;margin:6px 0 12px;font-size:1.05rem;
    }
   
    #demandes-service .title-icon img{width:30px;height:36px;display:block; margin-left: 10px;}
    #demandes-service .section-separator{margin:8px 0;border:0;border-top:2px solid #e8e6db}

    /* Barre de recherche */
    #demandes-service .abs-toolbar--inside-exam{
      display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;padding:.6rem;background:#fff;border-radius:.6rem;margin-bottom:.7rem;
      border:1px solid #e8e6db;
    }
    #demandes-service .abs-input{position:relative;flex:1 1 280px;max-width:220px}
    #demandes-service .abs-input input{
      width:100%;border:1px solid #e5e7eb;border-radius:.6rem;padding:.55rem 2.1rem .55rem .6rem;font-size:.95rem;background:#fbfbfb;color:#1a1a1a;
    }
    #demandes-service .abs-input i{position:absolute;right:.55rem;top:50%;transform:translateY(-50%);color:black;font-size:1.05rem}

    /* Table head */
    #demandes-service .table-head{background:#ECEBE3 0% 0% no-repeat padding-box;;border:1px solid #e8e6db;border-radius:12px;padding:8px 10px}
    #demandes-service .table-head table{width:100%;border-collapse:separate;border-spacing:0}
    #demandes-service .table-head th{text-align:left;color:#777568;font-weight:700;padding:8px 12px;font-size:.94rem; color: #1a1a1a;}
    #demandes-service .table-head th:first-child{width:44px}
    #demandes-service .table-head th:nth-child(2){width:120px}
    #demandes-service .table-head th:nth-child(4),
    #demandes-service .table-head th:nth-child(5){width:140px;text-align:center}

    /* Table body */
    #demandes-service .table-body{background:#fff;border:1px solid #e8e6db;border-radius:12px;margin-top:8px;overflow:hidden}
    #demandes-service .tbl{width:100%;border-collapse:separate;border-spacing:0}
    #demandes-service .tbl td{
      background:#fbfbf7;padding:14px 12px;border-bottom:1px solid #e8e6db;vertical-align:middle;font-size:.95rem;
    }
    #demandes-service .tbl tr:last-child td{border-bottom:none}
    #demandes-service .tbl td:nth-child(4), #demandes-service .tbl td:nth-child(5),
    #demandes-service .table-head th:nth-child(4), #demandes-service .table-head th:nth-child(5){
      border-left:1px solid #e8e6db;width:140px;text-align:center;
    }

    /* Col.1 checkbox + ref + icônes */
    #demandes-service .chk{width:16px;height:16px;cursor:pointer;accent-color:#6b6c4a}
    #demandes-service .ref{display:inline-block;min-width:42px;text-align:center;padding:2px 8px;border-radius:6px;font-weight:600}
    #demandes-service .cell-center{text-align:center}
    #demandes-service .icon{
      display:inline-flex;place-items:center;width:30px;height:30px;cursor:pointer;
      transition:transform .12s,box-shadow .12s;border:none;background:transparent
    }
    #demandes-service .icon:hover{transform:translateY(-1px);box-shadow:0 6px 14px rgba(0,0,0,.08)}
    /* Utilisation d'images à la place des SVG pour les icônes */
    #demandes-service .icon img{width:20px;height:20px;display:block}

    /* Responsive */
    @media (max-width:720px){
      #demandes-service .table-head th:nth-child(2){width:90px}
      #demandes-service .table-head th:nth-child(4), #demandes-service .table-head th:nth-child(5){width:110px}
      #demandes-service .tbl td{font-size:.92rem}
    }

    /* Icônes plus petites (eye + upload) */
#demandes-service .icon img{
  width:14px;
  height:14px;
}

/* (Optionnel) si tu veux aussi réduire légèrement le bouton : */
/*
#demandes-service .icon{
  width:28px;
  height:28px;
}
*/

  </style>

  <div class="section-title">
    <span class="title-icon" aria-hidden="true">
      <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/listing-list.png" alt="">
    </span>
    Demandes de service
  </div>
  <hr class="section-separator">

  <div class="abs-toolbar--inside-exam">
    <div class="abs-input">
      <input type="text" id="searchSupportsTab1" placeholder="Recherche..." autocomplete="off">
      <i class="bi bi-search"></i>
    </div>
  </div>

  <div class="table-head">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox" class="chk" data-master="#tbl2"></th>
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
      <tbody id="tbl2">
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
          <td>Demande de Soutien</td>
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
          <td><span class="ref">006</span></td>
          <td>Demande de Certificat</td>
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
          <td><span class="ref">007</span></td>
          <td>Demande d'Information</td>
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
          <td><span class="ref">008</span></td>
          <td>Demande de Soutien</td>
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
