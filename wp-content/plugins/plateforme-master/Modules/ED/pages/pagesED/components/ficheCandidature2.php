<div class="content-wrapper">

    <div class="status-bar-container">
      <div class="status-header">
        <h2>Statut candidature</h2>


        <div class="status-select">
        <button class="status-button">Acceptée</button>
        <div class="status-options">
          <div class="option">En attente</div>
          <div class="option">En cours</div>
          <div class="option selected">Acceptée</div>
          <div class="option">Refusée</div>
        </div>
      </div>


      </div>
    </div>



  <div class="grid-layout">
    <!-- Informations générales -->
    <div class="card">
      <h3>Informations générales</h3>
      <ul class="info-list">
        <li><strong>CIN :</strong> 06972145</li>
        <li><strong>Nom et prénom :</strong> Ahlem Ben Slimen</li>
        <li><strong>E-mail :</strong> ahlem8@gmail.com</li>
        <li><strong>Sexe :</strong> Féminin</li>
        <li><strong>Situation :</strong> Etudiante</li>
        <li><strong>Dernière connexion :</strong> 12/03/2025</li>
        <li><strong>Enabled :</strong> <span class="enabled">Oui</span></li>
      </ul>
    </div>

    <!-- Adresse -->
    <div class="card">
      <h3>Adresse</h3>
      <ul class="info-list">
        <li><strong>Pays :</strong> Tunisie</li>
        <li><strong>Gouvernorat :</strong> Tunis</li>
        <li><strong>Ville :</strong> Marsa</li>
        <li><strong>Rue :</strong> 12, Rue de berlin</li>
        <li><strong>Code postale :</strong> 2070</li>
      </ul>
    </div>

    <!-- Bac -->
    <div class="card">
      <h3>Bac</h3>
      <ul class="info-list">
        <li><strong>Session :</strong> Principale</li>
        <li><strong>Année :</strong> 2014-1015</li>
        <li><strong>Mention :</strong> Passable</li>
        <li><strong>Moyenne :</strong> 10.17</li>
        <li><strong>Diplôme :</strong> Relevé des notes <img src="pdf-icon.png" class="pdf-icon"></li>
      </ul>
    </div>

    <!-- Liste des masters -->
    <div class="card">
      <h3>Liste des masters en cours</h3>
      <ul class="info-list">
        <li><strong>Master :</strong> Master de recherche en chimie organique</li>
        <li><strong>Établissement :</strong> Faculté des sciences de tunis</li>
        <li><strong>Score :</strong> 29.003</li>
        <li><strong>Statut dossier :</strong> Accepté</li>
        <li><strong>Statut :</strong> Admis</li>
      </ul>
    </div>
  </div>

  <!-- Parcours universitaire -->
  <div class="card full-width">
    <h3>Parcours universitaire</h3>
    <table class="parcours-table">
      <thead>
        <tr>
          <th>Année</th>
          <th>Établissement</th>
          <th>Spécialité</th>
          <th>Diplôme</th>
          <th>Niveau</th>
          <th>Résultat</th>
          <th>Moy. par semestre</th>
          <th>R. Notes</th>
          <th>Moyenne</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2023/2024</td><td>FST</td><td>Chimie Fine</td><td>Licence Nationale</td><td>3</td><td>Principale</td><td>11</td><td>MGSP = 15.76<br>NC = 60</td><td>—</td>
        </tr>
        <tr>
          <td>2022/2023</td><td>FST</td><td>Chimie Fine</td><td>Licence Nationale</td><td>2</td><td>Rattrapage</td><td>—</td><td>MGSP = 15.76<br>NC = 60</td><td>—</td>
        </tr>
        <tr>
          <td>2021/2022</td><td>FST</td><td>Chimie Fine</td><td>Licence Nationale</td><td>1</td><td>Principale</td><td>—</td><td>MGSP = 15.76<br>NC = 60</td><td>—</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<style>
  .content-wrapper {
  padding: 20px;
  font-family: 'Poppins', sans-serif;
}

.header-section {
  margin-bottom: 20px;
}

.header-section h2 {
  font-size: 22px;
  font-weight: 600;
}

.grid-layout {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.card {
  background: #fff;
  padding: 16px;
  border-radius: 8px;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
}

.card h3 {
  font-size: 18px;
  margin-bottom: 12px;
  border-bottom: 1px solid #ddd;
  padding-bottom: 6px;
}

.info-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.info-list li {
  margin-bottom: 8px;
  font-size: 14px;
}

.enabled {
  background: #9EB08F;
  color: #fff;
  padding: 2px 8px;
  border-radius: 12px;
  font-size: 13px;
}

.full-width {
  grid-column: 1 / -1;
}

.parcours-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.parcours-table th,
.parcours-table td {
  border: 1px solid #ddd;
  padding: 8px;
  font-size: 13px;
  text-align: center;
}

.parcours-table th {
  background-color: #f5f5f5;
  font-weight: 600;
}

.pdf-icon {
  width: 16px;
  vertical-align: middle;
  margin-left: 4px;
}
.status-bar-container {
  background-color: #fff;
  border-radius: 8px;
  padding: 16px 24px;
  margin-bottom: 24px;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0px 3px 16px #00000014;
}

.status-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.status-header h2 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.status-dropdown {
  position: relative;
  display: inline-block;
}

.current-status {
  padding: 6px 16px;
  border-radius: 20px;
  background-color: #D6E6D3;
  color: #2B6629;
  font-weight: 500;
  font-size: 14px;
  cursor: pointer;
  user-select: none;
}

.current-status.accepted {
  background-color: #C6E8C2;
  color: #247626;
}

.status-list {
  position: absolute;
  top: 120%;
  right: 0;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 8px 0;
  margin: 4px 0 0 0;
  list-style: none;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  display: none;
  z-index: 10;
}

.status-dropdown:hover .status-list {
  display: block;
}

.status-item {
  padding: 6px 16px;
  font-size: 14px;
  cursor: pointer;
}

.status-item:hover {
  background-color: #f2f2f2;
}

.status-item.selected {
  background-color: #e7f6e6;
  color: #2B6629;
  font-weight: bold;
}.status-wrapper h2 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.status-select {
  position: relative;
}



.status-options {
  position: absolute;
  right: 0;
  top: 110%;
  width: 180px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
  display: none;
  flex-direction: column;
  padding: 4px 0;
  z-index: 10;
}

.status-select:hover .status-options {
  display: flex;
}

.option {
  padding: 10px 16px;
  font-size: 14px;
  text-align: left;
  cursor: pointer;
  transition: background 0.2s ease;
}

.option:hover {
  background-color: #f5f5f5;
}

.option.selected {
  background-color: #e9f5e8;
  color: #2a6529;
  font-weight: 600;
}
button.status-button {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #BF0404;
    border-radius: 5px;
    padding: 5px 45px;
    font-weight: 600;
}
</style>
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const dropdown = document.querySelector('.dropdown');
  dropdown.addEventListener('click', () => {
    alert("Changer le statut ici...");
  });
});

</script>