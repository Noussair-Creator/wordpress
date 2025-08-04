
<div class="content-block">
  <div class="header-bar">
    <h2>
      <img src="/imagesMaster/servicemasterImages/8489916.png" alt="Icon" style="width: 40px; margin-right: 8px; vertical-align: middle;">
      Liste des masters
    </h2>
    <button class="add-master-btn" id="add-master-btn">
      <i class="fas fa-plus-circle"></i> Ajouter un master
    </button>
  </div>

  <hr class="section-divider">

  <div class="filter-bar">

    <div class="search-box">
        <input type="text" placeholder="Recherche" class="search-input" />
        <span class="search-icon"><i class="fas fa-search"></i></span>
    </div>

    <div class="filter-group">
        <div class="custom-select">
            <span>Nature De Master</span>
            <div class="select-icon"><i class="fas fa-chevron-down"></i></div>
        </div>
        <div class="custom-select">
            <span>Domaine</span>
            <div class="select-icon"><i class="fas fa-chevron-down"></i></div>
        </div>
        <div class="custom-select">
            <span>Coordinateur</span>
            <div class="select-icon"><i class="fas fa-chevron-down"></i></div>
        </div>

        <div class="filter-actions">
            <button class="icon-button">
            <i class="fas fa-filter"></i>
            </button>
            <button class="icon-button">
            <i class="fas fa-download"></i>
            </button>
        </div>


    </div>

  </div>

  <table id="mastersTable" class="styled-table display">
        <thead>
            <tr>
            <th><input type="checkbox"></th>
            <th>Établissement</th>
            <th>Parcours</th>
            <th>Intitulé Du Master</th>
            <th>Plan D'étude</th>
            <th>Date d'habilitation</th>
            <th>Coordinateur</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody id="mastersTbody">
          <!-- rempli dynamiquement par JS -->
        </tbody>
        <!--<tbody>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><i class="fas fa-plus-circle coord-placeholder"></i></td>
            <td><button class="action-menu">•••</button></td>
            </tr>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><i class="fas fa-plus-circle coord-placeholder"></i></td>
            <td><button class="action-menu">•••</button></td>
            </tr>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><img src="/imagesMaster/servicemasterImages/Groupe de masques 472.png" class="coord-avatar"></td>
            <td>
                <div class="dropdown-menu">
                <span>👁 voir details</span>
                <span>✏️ Modifier</span>
                </div>
            </td>
            </tr>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><img src="/imagesMaster/servicemasterImages/Groupe de masques 4721.png" class="coord-avatar"></td>
            <td><button class="action-menu">•••</button></td>
            </tr>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><img src="/imagesMaster/servicemasterImages/Groupe de masques 472.png" class="coord-avatar"></td>
            <td>
                <div class="dropdown-menu">
                <span>👁 voir details</span>
                <span>✏️ Modifier</span>
                </div>
            </td>
            </tr>
            <tr>
            <td><input type="checkbox"></td>
            <td>Master de recherche en AI et Data</td>
            <td></td>
            <td><img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon"></td>
            <td>12/01/2025</td>
            <td><img src="/imagesMaster/servicemasterImages/Groupe de masques 4721.png" class="coord-avatar"></td>
            <td><button class="action-menu">•••</button></td>
            </tr>
        </tbody>-->
        </table>
</div>

<style>
  .content-block {
    background: #fff;
    border-radius: 10px;
    padding: 24px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  .header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  .add-master-btn {
    background-color: #c60000;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 8px 16px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .section-divider {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 16px 0;
  }
  .filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    position: relative;
  }
  .search-input {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 220px;
  }
  .filter-select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #f9f9f9;
  }
  .search-btn, .icon-btn {
    padding: 8px 12px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
  }
  .masters-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 0 1px #ddd;
  }
  .masters-table thead tr {
    background-color: #f3f1e9;
  }
  .masters-table th, .masters-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
  }
  .masters-table tbody tr:last-child td {
    border-bottom: none;
  }
  .pdf-icon {
    width: 24px;
  }
  .coord-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
  }
  .coord-placeholder {
    color: #555;
    font-size: 20px;
  }
  .action-menu {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
  }
  .dropdown-menu {
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    padding: 8px;
    border-radius: 6px;
    display: none;
    position: absolute;
  }
  .pagination-bar {
    margin-top: 16px;
    display: flex;
    justify-content: center;
    gap: 6px;
  }
  .pagination-bar button {
    padding: 6px 10px;
    border: 1px solid #ccc;
    background: #fff;
    border-radius: 6px;
    cursor: pointer;
  }
  .search-box {
  display: flex;
  align-items: center;
  border: 2px solid #dcdac2; /* couleur beige clair */
  border-radius: 16px;
  padding: 1px 16px;
  width: 300px;
  background-color: #fff;
  opacity:0
}

.search-input {
  flex: 1;
  border: none;
  outline: none;
  font-size: 18px;
  color: #666;
  background: transparent;
  font-family: 'Segoe UI', sans-serif;
}

.search-input::placeholder {
  color: #aaa;
}

.search-icon {
  color: #1c1c1c;
  font-size: 20px;
  margin-left: 12px;
}
.filter-group {
  display: flex;
  align-items: center;
  gap: 12px;
}

.custom-select {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 220px;
  padding: 10px 14px;
  border: 2px solid #dcdac2;
  border-radius: 12px;
  background: #fff;
  font-size: 16px;
  color: #aaa;
  font-family: 'Segoe UI', sans-serif;
  position: relative;
}

.custom-select::after {
  content: '';
  position: absolute;
  right: 38px;
  top: 50%;
  transform: translateY(-50%);
  height: 24px;
  border-left: 1px solid #dcdac2;
}

.select-icon {
  color: #2a2a2a;
  font-size: 16px;
  padding-left: 10px;
}


.filter-actions {
    display: flex;
    gap: 10px;
    margin-left: auto;
    position: absolute;
    position: absolute;
    right: 0;
}

.icon-button {
  width: 44px;
  height: 44px;
  background: #fff;
  border-radius: 12px;
  border: none;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.icon-button i {
  color: #b30000;
  font-size: 20px;
}

.action-wrapper {
  position: relative;
  display: inline-block;
}

.action-menu {
  background: none;
  border: none;
  font-size: 18px;
  cursor: pointer;
  padding: 5px;
}

.action-dropdown {
  position: absolute;
  top: 28px;
  right: 0;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  z-index: 999;
  min-width: 140px;
}

.action-dropdown button {
  width: 100%;
  background: none;
  border: none;
  padding: 10px;
  text-align: left;
  font-size: 14px;
  cursor: pointer;
}

.action-dropdown button:hover {
  background-color: #f0f0f0;
}
/* Cible le champ de recherche auto-généré par DataTables */
.dataTables_filter {
  position: relative;
  display: inline-block;
  margin-bottom: 20px;
}

.dataTables_filter input[type="search"] {
  padding: 8px 36px 8px 14px;
  border: 1px solid #dedbc2;
  border-radius: 12px;
  font-size: 14px;
  width: 220px;
  color: #333;
  background-color: #fff;
  font-family: 'Roboto', sans-serif;
  outline: none;
  transition: border-color 0.2s;
}

/* Enlève le label "Search:" si présent */
.dataTables_filter label {
  font-size: 0; /* masque le texte */
}
div#mastersTable_filter {
    float: left;
    position: absolute;
    top: -68px;
}
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    padding: 5px;
    background-color: transparent;
    color: inherit;
    margin-left: 3px !important;
    border: 2px solid #dcdac2 !important;
    border-radius: 16px !important;
    padding: 12px 36px !important;
    width: 297px !important;
}


</style>


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Init DataTable -->
<script>
$(document).ready(function() {
  /*$('#mastersTable').DataTable({
    paging: true,
    searching: false,
    info: false,
    ordering: true,
    pageLength: 5, // 🔒 fixe à 5 lignes par page
    lengthChange: false, // ❌ empêche l'utilisateur de changer le nombre de lignes

    dom: 'Bfrtip',  // Ajoute l'emplacement des boutons
    buttons: [
      {
        extend: 'colvis',
        text: 'Afficher/Masquer Colonnes',
        className: 'custom-colvis-btn'
      }
    ],
    language: {
      paginate: {
        previous: "«",
        next: "»"
      }
    }
  });*/
});

</script>

<style>
  .styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 0 1px #ddd;
    background: #fff;
    font-family: 'Segoe UI', sans-serif;
  }
  .styled-table thead {
    background-color: #f3f1e9;
  }
  .styled-table th, .styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
  }
  .styled-table tr:last-child td {
    border-bottom: none;
  }
  .pdf-icon {
    width: 24px;
  }
  .coord-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
  }
  .coord-placeholder {
    font-size: 20px;
    color: #666;
  }
  .action-menu {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
  }
  .dropdown-menu {
    background: #fff;
    border: 1px solid #ccc;
    padding: 6px;
    border-radius: 6px;
    display: none;
  }
  .custom-colvis-btn {
  background-color: #c60000;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  font-weight: bold;
  margin-bottom: 12px;
}


/* Conteneur pagination */
.dataTables_wrapper .dataTables_paginate {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 16px;
}

/* Boutons de pagination */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  border: 2px solid #c60000;
  color: #c60000;
  padding: 8px 14px;
  border-radius: 8px;
  background: white;
  font-weight: bold;
  cursor: pointer;
  font-size: 18px;
}

/* Page active */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  border: none;
  background: transparent;
  color: black;
  font-weight: bold;
  font-size: 18px;
  pointer-events: none;
}

/* Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #c60000;
    border-color: red;
}
/* Cacher les sauts de page '…' */
.dataTables_wrapper .dataTables_paginate .ellipsis {
  display: none;
}

a {
  color:inherit;
  text-decoration: none;
}
</style>
