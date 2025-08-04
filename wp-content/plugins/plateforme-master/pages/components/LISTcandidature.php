
<div class="content-block">
  <div class="header-bar">
    <h2>
      <img src="/imagesMaster/servicemasterImages/8489916.png" alt="Icon" style="width: 40px; margin-right: 8px; vertical-align: middle;">
      Liste des candidatures
    </h2>
  </div>

  <hr class="section-divider">

  <!--<div class="filter-bar">

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
-->

<div class="filter-bar">
  <h3 class="filter-title">Filtres multicritères</h3>

  <div class="filter-row">
    <div class="filter-buttons">
      <button class="filter-btn active">Tous</button>
      <button class="filter-btn">Externes</button>
      <button class="filter-btn">Internes</button>
    </div>

  <!--  <select class="filter-select">
      <option selected>Session</option>
      <option>2024</option>
      <option>2023</option>
    </select>

    <select class="filter-select">
      <option selected>Master</option>
      <option>IA</option>
      <option>Finance</option>
    </select>

-->

    <div class="statut-dropdown-wrapper">
    <button class="statut-dropdown-btn" id="statutDropdownBtn">
      Statut <i class="fa fa-caret-down"></i>
    </button>
    <div class="statut-dropdown-menu" id="statutDropdownMenu">
      <!-- Options insérées dynamiquement par JavaScript -->
    </div>
  </div>




    <div class="filter-actions">
      <button class="icon-btn" title="Filtrer">
        <i class="fa fa-filter"></i>
      </button>
      <button class="icon-btn" title="Exporter">
        <i class="fa fa-download"></i>
      </button>
    </div>
  </div>
</div>




    <table id="candidaturesTable" class="styled-table display">
        <thead>
        <tr>
        <th><input type="checkbox" id="checkAll"></th> <!-- ✅ case à cocher principale -->
        <th>Matricule</th>
        <th>Etudiant</th>
        <th>Master</th>
        <th>Score</th>
        <th>Diplome</th>
        <th>Statut dossier</th>
        <th>Statut Universitaire</th>
        <th>Actions</th>
      </tr>
        </thead>
        

        <tbody id="candidaturesTbody">
             
            </tbody>


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
   /* overflow: hidden;*/
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

</style>


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Init DataTable -->
<script>






</script>

<style>
  .styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    /*overflow: hidden;*/
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

  .custom-colvis-btn {
  background-color: #c60000;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  font-weight: bold;
  margin-bottom: 12px;
}

/* Menu déroulant */
.dropdown-menu {
  display: none;
  position: absolute;
  top: 42px;
  right: 0;
  min-width: 160px;
  background-color: #ffffff;
  border: 1px solid #d8d4b7;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  z-index: 1000;
}

/* Liens dans le menu */
.dropdown-menu a {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 16px;
  text-decoration: none;
  font-size: 14px;
  color: #2d2a12;
  transition: background-color 0.2s;
}



.dropdown-menu i {
  font-size: 15px;
  color: #2d2a12;
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
  font-size: 13px;
}

/* Page active */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  border: none;
  background: transparent;
  color: black;
  font-weight: bold;
  font-size: 13px;
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

.filter-bar {
    background: #fff;
    font-family: 'Poppins', sans-serif;
    padding: 10px 0px;
    display: grid
;
}

.filter-title {
  font-weight: bold;
  font-size: 18px;
  color: #2d2a12;
  margin-bottom: 10px;
}

.filter-row {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.filter-buttons {
  display: flex;
  border: 1px solid #d8d4b7;
  border-radius: 5px;
  overflow: hidden;
}

.filter-btn {
  padding: 8px 14px;
  border: none;
  background: transparent;
  color: #2d2a12;
  font-weight: 500;
  cursor: pointer;
}

.filter-btn.active {
  background-color: #b2ae90;
  color: #fff;
  font-weight: bold;
}

.filter-select {
  border: 1px solid #d8d4b7;
    border-radius: 5px;
    padding: 10px 12px;
    background-color: #fff;
    color: #999;
    font-size: 15px;
    appearance: none;
  background-image: url("data:image/svg+xml;utf8,<svg fill='%232d2a12' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    padding-right: 30px;
    width: 200px;
}

.filter-actions {
  display: flex;
  gap: 10px;
  margin-left: auto;
}

.icon-btn {
  background: #fff;
  border: none;
  border-radius: 10px;
  width: 40px;
  height: 40px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
  cursor: pointer;
  color: #d71920;
  font-size: 18px;
  transition: background 0.2s;
}

.icon-btn:hover {
  background-color: #f8f8f8;
}

.badge {
  display: inline-block;
  padding: 4px 10px;
  font-size: 13px;
  font-weight: 500;
  border-radius: 20px;
  border: 2px solid transparent;
}

.badge-danger {
  color: #d71920;
  background-color: #fff0f0;
  border-color: #d71920;
}

.badge-warning {
  color: #d89e00;
  background-color: #fff9e6;
  border-color: #d89e00;
}

.badge-success {
  color: #198754;
  background-color: #e6f7ee;
  border-color: #198754;
}
td.statut-universitaire {
  color: #2d2a12;
  font-weight: 500;
  font-size: 14px;
}
.actions-menu {
  position: absolute;
  background: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 6px 0;
  z-index: 1000;
  width: 160px;
}

.actions-menu a {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 14px;
  color: #2d2a12;
  text-decoration: none;
  font-size: 14px;
  transition: background 0.2s;
}

.actions-menu a:hover {
  background-color: #f4f4f4;
}

.actions-menu i {
  color: #2d2a12;
}
.action-btn {
    background-color: transparent;
    color: #2d2a12;
    border: 1px solid transparent;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    font-size: 31px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s, box-shadow 0.2s;
    line-height: 1;
    padding: 0;
    display: flex
;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
  background-color: #e6e6de;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
.badge {
  display: inline-block;
  padding: 4px 10px;
  font-size: 13px;
  font-weight: 600;
  border-radius: 20px;
  text-transform: capitalize;
  border: 2px solid transparent;
  font-family: 'Segoe UI', sans-serif;
}

.badge-success {
  color: #198754;
  background-color: #e6f7ee;
  border-color: #198754;
}

.badge-warning {
  color: #d89e00;
  background-color: #fff9e6;
  border-color: #d89e00;
}

.badge-danger {
  color: #d71920;
  background-color: #fff0f0;
  border-color: #d71920;
}

.badge-secondary {
  color: #555;
  background-color: #f0f0f0;
  border-color: #ccc;
}
.dt-button.buttons-colvis {
    background-color: #f9f7ef;
    border: 1px solid #ccc;
    /* border-radius: 8px; */
    padding: 8px 14px;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    color: #333;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    cursor: pointer;
    box-shadow: inset 0 0 0 1px #ddd;
    transition: background-color 0.2s ease;
    border-radius: 5px;
    background-color: #fff !important;
    padding: 7px 14px;
    position: relative;
    top: -71px;
    right: 93px;
    border: 2px solid #d71920;
    appearance: none;
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    font-weight: 700;
    color: #d71920;
  background: none;
}
div#candidaturesTable_wrapper div.dt-buttons {
    float: right !important;
}

div#candidaturesTable_wrapper span.dt-down-arrow {
    display: none;
}

.dt-button.buttons-colvis:hover {
  background-color: #ece8dc;
}

.dt-button.buttons-colvis .dt-down-arrow {
  font-size: 14px;
  color: #888;
}


/* Conteneur global */
.dt-button-collection.fixed.four-column {
    border-radius: 16px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    display: grid
;
    gap: 16px;
    font-family: 'Poppins', sans-serif;
    min-width: 520px;
    max-width: 727px;
    overflow: visible;
}
/* Boutons de colonne */
.dt-button-collection .dt-button.buttons-columnVisibility {
  border: 1px solid #ccc;
  background-color: #fff;
  border-radius: 50px;
  padding: 10px 60px;
  font-size: 14px;
  color: #333;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

/* Survol */
.dt-button-collection .dt-button.buttons-columnVisibility:hover {
  background-color: #f6f6f6;
  border-color: #999;
}
.dt-button-collection .dt-button.buttons-columnVisibility , .dt-button-collection .dt-button.buttons-columnVisibility.active{
    border: 1px solid #ccc;
    background-color: #fff !important;
    border-radius: 50px;
    padding: 10px 60px;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex
;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    background: linear-gradient(to bottom, #fffbfb 0%, #ffffff 100%) !important;
        box-shadow: none !important;
 
}
/* Actif */
div.dt-button-collection.four-column {
    width: 719px !important;
}
div.dt-button-collection.fixed .dt-button:first-child {
    border-top-left-radius: 50px !important; 
    border-top-right-radius: 50px !important;
}
div.dt-button-collection.fixed .dt-button:last-child{

      border-bottom-left-radius: 50px !important; 
    border-bottom-right-radius: 50px !important; 
}
div.dt-button-background
 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    background: radial-gradient(ellipse farthest-corner at center, rgba(0, 0, 0, 0.3) 0%, rgb(195 195 195 / 70%) 100%);
    z-index: 2001;
}
.dt-button-collection .dt-button.buttons-columnVisibility {
    color: #000;
    font-weight: 500;
    font-size: 14px;
}
.dt-button-collection .dt-button.buttons-columnVisibility.active {
    border-color: #d42d2d;
    color: #000;
    font-weight: 500;
    font-size: 14px;
}
div.dt-button-collection-title h4 {
  color: #d42d2d;
}
/* Container pagination */
#candidaturesTable_paginate {
  display: flex;
  justify-content: center;
  margin-top: 20px;
  gap: 6px;
  font-family: 'Poppins', sans-serif;
}

/* Boutons de pagination */
#candidaturesTable_paginate .paginate_button {
  background-color: #fff;
  border: 2px solid #c40000;
  color: #c40000;
  font-weight: 500;
  padding: 6px 10px;
  min-width: 36px;
  text-align: center;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s ease;
}

/* Bouton actif */
#candidaturesTable_paginate .paginate_button.current {
  background-color: #c40000;
  color: #fff !important;
  border-color: #c40000;
}

/* Survol */
#candidaturesTable_paginate .paginate_button:hover {
  background-color: #f8eaea;
}

/* Icônes (si UTF ou FontAwesome utilisé) */
#candidaturesTable_paginate .paginate_button:before,
#candidaturesTable_paginate .paginate_button:after {
  font-weight: bold;
}

/* Supprime les bordures par défaut de DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  border: none;
}

/* Supprime focus violet */
#candidaturesTable_paginate .paginate_button:focus {
  outline: none;
  box-shadow: none;
}
th {
    padding: 26px 10px 17px !important;
}
td {
  box-shadow: none !important;
}
thead {
    position: relative;
    top: -17px;
}


#candidaturesTable {
  border: none !important;           /* Supprime la bordure externe */
  border-collapse: collapse;         /* Colle les cellules sans doublons */
  box-shadow: none !important;       /* Supprime toute ombre extérieure */
}

#candidaturesTable th
{
  border: 0px solid #EBE9D7;            /* ✅ Bordures internes seulement */
}
#candidaturesTable td {
  border: 1px solid #EBE9D7;            /* ✅ Bordures internes seulement */
}

/* Supprimer bordure du <thead> si nécessaire */
#candidaturesTable thead {
  border: none !important;
      position: static;
    transform: translateY(-15px);
}
#candidaturesTable tbody tr:first-child td {
  border-top: 1px solid #EBE9D7 !important;
}
#candidaturesTable {
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 50x 50px 0 0; /* ⬅️ coins haut gauche et droit arrondis */
  overflow: hidden; /* permet de masquer les débordements internes */
}
#candidaturesTable thead tr:first-child th:first-child {
  border-top-left-radius: 12px;
  border-bottom-left-radius: 12px;
}

#candidaturesTable thead tr:first-child  th:last-child {
  border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;

}

#candidaturesTable tbody tr:last-child td:first-child {
  border-bottom-left-radius: 12px;
}

#candidaturesTable tbody tr:last-child  td:last-child {
  border-bottom-right-radius: 12px;
}
#candidaturesTable tbody tr:first-child td:first-child {
  border-top-left-radius: 12px;
}

#candidaturesTable tbody tr:first-child  td:last-child {
  border-top-right-radius: 12px;
}

#candidaturesTable tbody tr:last-child td:first-child {
  border-bottom-left-radius: 12px;
}

#candidaturesTable tbody tr:last-child  td:last-child {
  border-bottom-right-radius: 12px;
}
.badge-info {
    background-color: #808066;
}
#candidaturesTable {
  overflow: visible;
}
.actions {
  position: relative;
  display: inline-block;
}
.dropdown-menu {
  display: none;
  position: absolute;
  top: 100%; /* s'affiche juste sous le bouton */
  right: 0;
  min-width: 160px;
  background-color: #ffffff;
  border: 1px solid #d8d4b7;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}
.filter-dropdown {
  position: relative;
  margin-left: 12px;
}
.statut-dropdown-wrapper {
  position: relative;
  display: inline-block;
  margin-left: 12px;
}

.statut-dropdown-btn {
 background-color: #c80000;
    color: white;
    border: none;
    padding: 9px 53px;
    font-weight: 500;
    font-size: 14px;
    border-radius: 5px;
}

.statut-dropdown-menu {
  position: absolute;
  top: 110%;
  left: 0;
  background-color: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  display: none;
  z-index: 9999;
  min-width: 200px;
  border-radius: 4px;
  overflow: hidden;
}

.statut-dropdown-option {
  padding: 10px 14px;
  font-size: 14px;
  cursor: pointer;
}

.statut-dropdown-option:hover {
  background-color: #f5f5f5;
}
button.swal2-confirm.swal2-styled {
    background-color: #c80000;
}

</style>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');

    filterButtons.forEach(button => {
      button.addEventListener('click', function () {
        // Retirer la classe 'active' de tous les boutons
        filterButtons.forEach(btn => btn.classList.remove('active'));

        // Ajouter la classe 'active' au bouton cliqué
        this.classList.add('active');

        // Optionnel : déclencher une action (filtrage)
        const selectedFilter = this.textContent.trim();
        console.log("Filtre sélectionné :", selectedFilter);
      });
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.action-btn');

    buttons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.stopPropagation(); // Ne pas fermer immédiatement

        // Fermer tous les autres menus
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
          if (menu !== this.nextElementSibling) {
            menu.style.display = 'none';
          }
        });

        // Toggle affichage du menu
        const menu = this.nextElementSibling;
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
      });
    });

    // Clic en dehors -> fermer les menus
    document.addEventListener('click', function () {
      document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
      });
    });
  });
</script>
<script>
  /*
document.addEventListener('DOMContentLoaded', () => {
  fetch(PMSettings.apiUrlCandidatures, {
  method: 'GET',
  headers: { 'X-WP-Nonce': PMSettings.nonce }
  })
    .then(response => response.json())
    .then(result => {
      if (result.status === 'success') {
        const dataSet = result.data.map(c => {
          return [
            c.matricule ?? 'N/A',
            c.etudiant ?? 'N/A',
            c.master ?? 'N/A',
            c.score ?? '—',
            c.diplome ?? 'N/A',
            c.statut_dossier,
            c.statut_etudiant,
            `<button class="btn-view" data-id="${c.candidature_id}">Voir</button>
             <button class="btn-email" data-id="${c.candidature_id}">E-mail</button>`
          ];
        });

        // Détruire l'instance existante si elle existe
        if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
          $('#candidaturesTable').DataTable().clear().destroy();
        }

        // Réinitialiser le corps du tableau
        document.getElementById('candidaturesTbody').innerHTML = '';

        // Initialiser DataTable proprement
        $('#candidaturesTable').DataTable({
          data: dataSet,
          columns: [
            { title: "Matricule" },
            { title: "Étudiant" },
            { title: "Master" },
            { title: "Score" },
            { title: "Diplôme" },
            { title: "Statut dossier" },
            { title: "Statut Universitaire" },
            { title: "Actions", orderable: false }
          ],
          pageLength: 10,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
          }
        });
      } else {
        alert('Erreur lors du chargement des candidatures.');
      }
    })
    .catch(error => {
      console.error('Erreur fetch:', error);
      alert('Erreur réseau.');
    });
});
*/


</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  fetch(PMSettings.apiUrlCandidatures, {
    method: 'GET',
    credentials: 'include',
    headers: {
      'X-WP-Nonce': PMSettings.nonce
    }
  })
    .then(response => response.json())
    .then(result => {
      console.log("Résultat API : ", result);

      const tbody = document.getElementById('candidaturesTbody');
      tbody.innerHTML = '';

      if (result.status !== 'success' || !Array.isArray(result.data)) {
        tbody.innerHTML = '<tr><td colspan="8">Erreur de données</td></tr>';
        return;
      }

      if (result.data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8">Aucune candidature trouvée.</td></tr>';
        return;
      }

      result.data.forEach(c => {
            const statut = (c.statut_dossier || '').toLowerCase().trim();

            const statutBadge = {
              'soumis': `<span class="badge badge-warning">En attente</span>`,
              'en cours': `<span class="badge badge-info">En cours</span>`,
              'accepté': `<span class="badge badge-success">Validé</span>`,
              'validé': `<span class="badge badge-success">Validé</span>`,
              'refusé': `<span class="badge badge-danger">Refusé</span>`,
              'brouillon': `<span class="badge badge-secondary">Brouillon</span>`
            }[statut] ?? `<span class="badge badge-secondary">Inconnu</span>`;

            const row = `
              <tr>
                <td><input type="checkbox" class="row-checkbox" data-id="${c.candidature_id}"></td>
                <td>${c.matricule?.trim() || 'N/A'}</td>
                <td>${c.etudiant?.trim() || 'N/A'}</td>
                <td>${c.master?.trim() || 'N/A'}</td>
                <td>${c.score !== null && c.score !== '' ? c.score : '—'}</td>
                <td>${c.sa_cycle?.trim() || 'N/A'}</td>
                <td>${statutBadge}</td>
                <td class="statut-universitaire">${c.statut_etudiant?.trim() || 'N/A'}</td>
                <td>
                  <div class="actions">
                    <button class="action-btn">...</button>
                    <div class="dropdown-menu">
                     <a href="/fiche-candidature?id=${c.candidature_id}"><i class="fa fa-eye"></i> Voir dossier</a>
                      <a href="#"><i class="fa fa-envelope"></i> E-mail</a>
                    </div>
                  </div>
                </td>
              </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
          });

          document.getElementById('totalcandidatures').textContent = result.data.length;

      // Détruire DataTable si elle existe
      if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
        $('#candidaturesTable').DataTable().clear().destroy();
      }

      // Attendre que le DOM soit mis à jour avant d'initialiser
      setTimeout(() => {
        $('#candidaturesTable').DataTable({
          pageLength: 10,
          lengthChange: false, lengthChange: false,   // 🔒 supprime "Afficher X entrées"
          searching: false,      // 🔍 supprime la barre de recherche
          info: false,         
                  language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                  },

                dom: 'Bfrtip',
                buttons: [
                  {
                      extend: 'colvis',
                      text: 'Afficher/Masquer colonnes',
                      collectionLayout: 'fixed four-column',
                            collectionTitle: '<h4 style="margin: 0 0 10px;">Ajouter des colonnes</h4>'

                  }
              ]

              });

        // Gestion du menu déroulant dynamique
        document.querySelectorAll('.action-btn').forEach(btn => {
          btn.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
              if (menu !== btn.nextElementSibling) {
                menu.style.display = 'none';
              }
            });
            const menu = btn.nextElementSibling;
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
          });
        });

        document.addEventListener('click', () => {
          document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
          });
        });

      }, 100); // Petit délai pour laisser le DOM se mettre à jour

    })
    .catch(error => {
      console.error('Erreur fetch:', error);
      alert('Erreur réseau.');
    });
});

/*
document.addEventListener('DOMContentLoaded', () => {
  const statutBtn = document.getElementById('statutDropdownBtn');
  const statutMenu = document.getElementById('statutDropdownMenu');

  // ✅ Toggle menu au clic sur le bouton
  statutBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // éviter la fermeture immédiate
    const isOpen = statutMenu.style.display === 'block';
    statutMenu.style.display = isOpen ? 'none' : 'block';
  });

  // ✅ Gérer le clic sur une option
  document.querySelectorAll('.statut-dropdown-option').forEach(option => {
    option.addEventListener('click', () => {
      const selectedValue = option.dataset.value;
      const selectedText = option.textContent;

      // Afficher le texte dans le bouton
      statutBtn.innerHTML = `Statut : ${selectedText} <i class="fa fa-caret-down"></i>`;
      statutMenu.style.display = 'none';

      // 🔽 Action personnalisée ici (ex : filtrer ou envoyer à l’API)
      console.log("Statut sélectionné :", selectedValue);

      // Exemple : appel API ou filtre table
      // appliquerFiltreStatut(selectedValue);
    });
  });

  // ✅ Fermer le menu si clic en dehors
  document.addEventListener('click', (e) => {
    if (!statutBtn.contains(e.target) && !statutMenu.contains(e.target)) {
      statutMenu.style.display = 'none';
    }
  });
});


document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('statutDropdownMenu');
  const btn = document.getElementById('statutDropdownBtn');
  const checkAll = document.getElementById('checkAll');

  // ✅ Gérer "Tout cocher"
  checkAll?.addEventListener('change', () => {
    const isChecked = checkAll.checked;
    document.querySelectorAll('.row-checkbox').forEach(cb => {
      cb.checked = isChecked;
    });
  });

  // ✅ Synchroniser état de #checkAll si cases cochées manuellement
  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('row-checkbox')) {
      const all = document.querySelectorAll('.row-checkbox');
      const allChecked = Array.from(all).every(cb => cb.checked);
      checkAll.checked = allChecked;
    }
  });

  // ✅ Charger les statuts une fois
  fetch('/wp-json/plateforme-master/v1/statuts-resultats')
    .then(res => res.json())
    .then(data => {
      menu.innerHTML = '';

      data.forEach(stat => {
        const div = document.createElement('div');
        div.className = 'statut-dropdown-option';
        div.dataset.value = stat.code;
        div.textContent = `${stat.code} : ${stat.libelle}`;

        div.addEventListener('click', () => {
          const ids = Array.from(document.querySelectorAll('.row-checkbox:checked'))
            .map(cb => cb.dataset.id);

          if (ids.length === 0) {
            Swal.fire('Aucune sélection', 'Veuillez sélectionner au moins une candidature.', 'warning');
            return;
          }

          Swal.fire({
            title: 'Confirmer l’action',
            html: `Appliquer <b>${stat.code} : ${stat.libelle}</b><br>à <b>${ids.length}</b> candidature(s) ?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, appliquer',
            cancelButtonText: 'Annuler'
          }).then((result) => {
            if (result.isConfirmed) {
              fetch('/wp-json/plateforme-master/v1/set-statut-resultat', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-WP-Nonce': PMSettings.nonce
                },
                body: JSON.stringify({
                  candidature_ids: ids,
                  statut: stat.code,
                  libelle: stat.libelle
                })
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('✅ Succès', 'Statut appliqué avec succès.', 'success')
                    .then(() => location.reload());
                } else {
                  Swal.fire('❌ Échec', data.message || 'Une erreur est survenue.', 'error');
                }
              })
              .catch(err => {
                console.error("Erreur API :", err);
                Swal.fire('❌ Erreur réseau', 'Impossible de contacter le serveur.', 'error');
              });
            }
          });

          menu.style.display = 'none';
          btn.innerHTML = `${stat.code} : ${stat.libelle} <i class="fa fa-caret-down"></i>`;
        });

        menu.appendChild(div);
      });
    })
    .catch(err => {
      console.error("Erreur chargement des statuts :", err);
    });

  // ✅ Toggle d’ouverture du menu au clic sur bouton
  btn?.addEventListener('click', (e) => {
    e.stopPropagation();
    const checked = document.querySelector('.row-checkbox:checked');
    if (!checked) {
      Swal.fire('Aucune sélection', 'Veuillez cocher au moins une candidature.', 'warning');
      return;
    }
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  });

  // ✅ Fermer menu si clic en dehors
  document.addEventListener('click', (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
});
*/


/*
document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('statutDropdownMenu');
  const btn = document.getElementById('statutDropdownBtn');
  const checkAll = document.getElementById('checkAll');

  // ✅ Gérer "Tout cocher"
  checkAll?.addEventListener('change', () => {
    const isChecked = checkAll.checked;
    document.querySelectorAll('.row-checkbox').forEach(cb => {
      cb.checked = isChecked;
    });
  });

  // ✅ Synchroniser checkAll
  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('row-checkbox')) {
      const all = document.querySelectorAll('.row-checkbox');
      const allChecked = Array.from(all).every(cb => cb.checked);
      checkAll.checked = allChecked;
    }
  });

  // ✅ Toggle menu au clic sur le bouton
  btn?.addEventListener('click', (e) => {
    e.stopPropagation();
    const hasChecked = document.querySelector('.row-checkbox:checked');
    if (!hasChecked) {
      Swal.fire('Aucune sélection', 'Veuillez cocher au moins une candidature.', 'warning');
      return;
    }
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
  });

  // ✅ Fermer menu si clic en dehors
  document.addEventListener('click', (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });

  // ✅ Charger les statuts et ajouter les options dynamiquement
  fetch('/wp-json/plateforme-master/v1/statuts-resultats')
    .then(res => res.json())
    .then(data => {
      menu.innerHTML = ''; // Vider avant insertion

      data.forEach(stat => {
        const div = document.createElement('div');
        div.className = 'statut-dropdown-option';
        div.dataset.value = stat.code;
        div.textContent = `${stat.code} : ${stat.libelle}`;

        div.addEventListener('click', () => {
          const ids = Array.from(document.querySelectorAll('.row-checkbox:checked'))
            .map(cb => cb.dataset.id);

          if (ids.length === 0) {
            Swal.fire('Aucune sélection', 'Veuillez sélectionner au moins une candidature.', 'warning');
            return;
          }

          Swal.fire({
            title: 'Confirmer l’action',
            html: `Appliquer <b>${stat.code} : ${stat.libelle}</b><br>à <b>${ids.length}</b> candidature(s) ?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, appliquer',
            cancelButtonText: 'Annuler'
          }).then((result) => {
            if (result.isConfirmed) {
              fetch('/wp-json/plateforme-master/v1/set-statut-resultat', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-WP-Nonce': PMSettings.nonce
                },
                body: JSON.stringify({
                  candidature_ids: ids,
                  statut: stat.code,
                  libelle: stat.libelle
                })
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('✅ Succès', 'Statut appliqué avec succès.', 'success')
                    .then(() => location.reload());
                } else {
                  Swal.fire('❌ Échec', data.message || 'Une erreur est survenue.', 'error');
                }
              })
              .catch(err => {
                console.error("Erreur API :", err);
                Swal.fire('❌ Erreur réseau', 'Impossible de contacter le serveur.', 'error');
              });
            }
          });

          // Fermer le menu et mettre à jour le bouton
          menu.style.display = 'none';
          btn.innerHTML = `${stat.code} : ${stat.libelle} <i class="fa fa-caret-down"></i>`;
        });

        menu.appendChild(div);
      });
    })
    .catch(err => {
      console.error("Erreur chargement des statuts :", err);
    });
});

*/


document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('statutDropdownMenu');
  const btn = document.getElementById('statutDropdownBtn');
  const checkAll = document.getElementById('checkAll');

  // ✅ Gérer "Tout cocher"
  checkAll?.addEventListener('change', () => {
    const isChecked = checkAll.checked;
    document.querySelectorAll('.row-checkbox').forEach(cb => {
      cb.checked = isChecked;
    });
  });

  // ✅ Synchroniser checkAll
  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('row-checkbox')) {
      const all = document.querySelectorAll('.row-checkbox');
      const allChecked = Array.from(all).every(cb => cb.checked);
      checkAll.checked = allChecked;
    }
  });

  // ✅ Charger les statuts et ajouter les options dynamiquement
  fetch('/wp-json/plateforme-master/v1/statuts-resultats')
    .then(res => res.json())
    .then(data => {
      menu.innerHTML = '';

      data.forEach(stat => {
        const div = document.createElement('div');
        div.className = 'statut-dropdown-option';
        div.dataset.value = stat.code;
        div.textContent = `${stat.code} : ${stat.libelle}`;

        div.addEventListener('click', () => {
          const ids = Array.from(document.querySelectorAll('.row-checkbox:checked'))
            .map(cb => cb.dataset.id);

          if (ids.length === 0) {
            Swal.fire('Aucune sélection', 'Veuillez sélectionner au moins une candidature.', 'warning');
            return;
          }

          Swal.fire({
            title: 'Confirmer l’action',
            html: `Appliquer <b>${stat.code} : ${stat.libelle}</b><br>à <b>${ids.length}</b> candidature(s) ?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, appliquer',
            cancelButtonText: 'Annuler'
          }).then((result) => {
            if (result.isConfirmed) {
              fetch('/wp-json/plateforme-master/v1/set-statut-resultat', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-WP-Nonce': PMSettings.nonce
                },
                body: JSON.stringify({
                  candidature_ids: ids,
                  statut: stat.code,
                  libelle: stat.libelle
                })
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('✅ Succès', 'Statut appliqué avec succès.', 'success')
                    .then(() => location.reload());
                } else {
                  Swal.fire('❌ Échec', data.message || 'Une erreur est survenue.', 'error');
                }
              })
              .catch(err => {
                console.error("Erreur API :", err);
                Swal.fire('❌ Erreur réseau', 'Impossible de contacter le serveur.', 'error');
              });
            }
          });

          // Fermer le menu et mettre à jour le bouton
          menu.style.display = 'none';
          btn.innerHTML = `${stat.code} : ${stat.libelle} <i class="fa fa-caret-down"></i>`;
        });

        menu.appendChild(div);
      });

      // ✅ Maintenant que le menu est prêt, activer le bouton
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const checked = document.querySelector('.row-checkbox:checked');
        if (!checked) {
          Swal.fire('Aucune sélection', 'Veuillez cocher au moins une candidature.', 'warning');
          return;
        }
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
      });
    })
    .catch(err => {
      console.error("Erreur chargement des statuts :", err);
    });

  // ✅ Fermer menu si clic en dehors
  document.addEventListener('click', (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
});



</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- JS DataTables et Buttons -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
