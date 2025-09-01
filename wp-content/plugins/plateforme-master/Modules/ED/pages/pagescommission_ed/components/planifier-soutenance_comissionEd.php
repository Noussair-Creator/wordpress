<!-- Planifier une soutenance (remplace tout ton bloc précédent) -->
<div class="card-section">

  <!-- 1) Informations sur le doctorant -->
  <div class="section-block">
    <div class="card-title">
      <h3>Informations sur le doctorant</h3>
    </div>
    <div class="card-content">

      <!-- Ligne : Doctorant (select) -->
      <div class="form-row">
        <div class="form-group" style="flex:1 1 100%;">
          <label>Doctorant</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Selection...</option>
              <option>Ines Hamdi</option>
              <option>Tarek Ben Amor</option>
              <option>Manel Ghomrassni</option>
              <option>Salem Salhi</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Ligne infos en lecture (comme la maquette) -->
      <table class="info-table">
      <tbody>
        <tr>
          <td class="label">Spécialité :</td>
          <td class="value">Informatique</td>
        </tr>
        <tr>
          <td class="label">Sujet de thèse :</td>
          <td class="value">Optimisation des systèmes multi‑agents dans les réseaux IoT intelligents</td>
        </tr>
        <tr>
          <td class="label">Directeur de thèse :</td>
          <td class="value">
            <span class="with-avatar">
              <img class="avatar" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="">
              Dalanda Ben Amor
            </span>
          </td>
        </tr>
      </tbody>
    </table>


    </div>
  </div>

  <!-- 2) Informations de planification -->
  <div class="section-block">
    <div class="card-title">
      <h3>Informations de planification</h3>
    </div>
    <div class="card-content">

      <!-- Ligne 1 : Type / Modalité / Lieu -->
      <div class="form-row">
        <div class="form-group">
          <label>Type de soutenance</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Soutenance</option>
              <option>Pré‑soutenance</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Modalité</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Présentiel</option>
              <option>À distance</option>
              <option>Hybride</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Lieu / Salle</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Amphi 1</option>
              <option>Amphi D</option>
              <option>Salle 204</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Ligne 2 : Date / Heure / (placeholder vide pour garder la grille en 3) -->
      <div class="form-row">
        <div class="form-group">
          <label>Date prévue</label>
          <div class="input-with-icon">
            <input type="text" class="form-control" value="12-07-2025">
            <i class="far fa-calendar-alt"></i>
          </div>
        </div>

        <div class="form-group">
          <label>Heure</label>
          <div class="input-with-icon">
            <input type="text" class="form-control" value="10:00">
            <i class="far fa-clock"></i>
          </div>
        </div>

        <div class="form-group">
          <label>Lien de visio (si en ligne)</label>
          <input type="text" class="form-control" placeholder="https://">
        </div>
      </div>

    </div>
  </div>

  <!-- 3) Composition du jury -->
  <div class="section-block">
    <div class="card-title">
      <h3>Composition du jury</h3>
    </div>
    <div class="card-content">

      <div class="form-group" style="margin-top:-6px;">
        <small style="color:#6E6D55;">Ajouter jusqu’à 5 membres (président, rapporteurs, examinateurs…)</small>
      </div>

      <!-- Sélecteur pour ajouter un membre -->
      <div class="form-row">
        <div class="form-group" style="max-width:420px;">
          <label>Liste des jurys</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Selection...</option>
              <option>Ahmed Salmi</option>
              <option>Ranim Slimen</option>
              <option>Dalanda Ben Amor</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Liste des membres (comme badges/lignes) -->
      <div class="form-row" style="flex-direction:column;gap:10px;">
        <div class="form-control membre" style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;">
          <span style="display:flex;align-items:center;gap:10px;">
            <img src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="" style="width:28px;height:28px;border-radius:50%;object-fit:cover;">
            Ahmed Salmi
          </span>
          <button class="btn btn-outline-danger" style="padding:6px 10px;"><i class="far fa-trash-alt"></i></button>
        </div>

        <div class="form-control membre" style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;">
          <span style="display:flex;align-items:center;gap:10px;">
            <img src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="" style="width:28px;height:28px;border-radius:50%;object-fit:cover;">
            Ranim Slimen
          </span>
          <button class="btn btn-outline-danger" style="padding:6px 10px;"><i class="far fa-trash-alt"></i></button>
        </div>

        <div class="form-control membre" style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;">
          <span style="display:flex;align-items:center;gap:10px;">
            <img src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="" style="width:28px;height:28px;border-radius:50%;object-fit:cover;">
            Dalanda Ben Amor
          </span>
          <button class="btn btn-outline-danger" style="padding:6px 10px;"><i class="far fa-trash-alt"></i></button>
        </div>
      </div>

    </div>
  </div>

  <!-- 4) Commentaires complémentaires -->
  <div class="section-block">
    <div class="card-title">
      <h3>Commentaires complémentaires</h3>
    </div>
    <div class="card-content">
      <div class="form-row" style="align-items:flex-end;">
        <div class="form-group" style="flex:5;">
          <label>Commentaire</label>
          <textarea class="form-control" rows="4" placeholder="Ajouter un commentaire ..."></textarea>
        </div>
        <div class="form-group" style="width:auto;align-self: center;margin-bottom: -12px;">
          <button class="btn btn-outline-danger cmt">Ajouter</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Barre d’actions -->
  <div class="form-actions">
    <button class="btn btn-outline-danger">Enregistrer en brouillon</button>
    <button class="btn btn-danger">Enregistrer</button>
  </div>

</div>





<style>
  .btn:hover{
    background-color:initial
  }
    .commentaire-liste {
  margin-top: 16px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.commentaire-liste .commentaire {
  background: #FCFCFC;
  border: 1px solid #dedcc9;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
  color: #333;
  margin: 0px 24px 20px;
}
.page-wrapper {
    font-family: 'Poppins', sans-serif;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 0 16px rgba(0, 0, 0, 0.06);
}

.page-header h2 {
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 24px;
  color: #2A2916;
}
.card-section:first-child{
  padding-top:0px
}
.card-section {
    background-color: #fff;
    padding: 20px 0px;
    border-radius: 10px;
    box-shadow: 0 3px 10px #0000000a;
    padding-bottom: 0px;
}

.card-section h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #2A2916;
    padding: 20px 24px;
}
.card-content {
    padding: 20px 24px;
}
.form-group {
  margin-bottom: 16px;
}

.form-group label {
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 6px;
    display: block;
    text-align: left;
    letter-spacing: 0px;
    color: #6E6D55;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    background-color: #fff;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #DBD9C3;
    border-radius: 5px;
}

.form-row {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.form-row .form-group {
  flex: 1;
  min-width: 220px;
}

.custom-list {
  padding-left: 0;
  list-style: none;
  font-size: 14px;
  color: #333;
}

.custom-list li {
  padding: 6px 0;
  position: relative;
  padding-left: 20px;
}

.custom-list li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 6px;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 8px solid #c40000;
  transform: rotate(90deg);
}

.btn {
  padding: 8px 20px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.2s ease;
}
button.btn.btn-danger.mt-2 {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 2px solid #BF0404;
    border-radius: 5px;
    color: #BF0404;
    margin-left: 10px;
    font-weight: 700;
}
.btn-danger {
  background-color: #c40000;
  color: #fff;
  border: none;
}

.btn-outline-danger {
  border: 1px solid #c40000;
  background-color: transparent;
  color: #c40000;
}

.btn-outline-secondary {
  border: 1px solid #999;
  background-color: #f9f9f9;
  color: #444;
}

.btn-outline-danger:hover,
.btn-danger:hover {
  opacity: 0.9;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px -7px 16px #00000012;
    padding: 20px 24px;
    border-radius: 0px 0px 10px 10px;
}
#objectifGeneral {
  border-radius: 6px;
  background-color: #fff;
}

.ql-toolbar.ql-snow {
  border-radius: 6px 6px 0 0;
  background-color: #ECEBE3;
  border: 1px solid #DBD9C3;
}

.ql-container.ql-snow {
  border-radius: 0 0 6px 6px;
  font-size: 14px;
  border: 1px solid #DBD9C3;
}


.input-upload-group {
  display: flex;
  width: 100%;
  border-radius: 8px;
  overflow: hidden;
  border: 1px solid #d4d1b6;
  background-color: #fff;
}

.input-upload-group .form-control.filename-display {
  border: none;
  padding: 10px 14px;
  font-size: 14px;
  flex: 1;
  background-color: #fff;
  color: #333;
  font-family: 'Poppins', sans-serif;
}

.input-upload-group .btn-importer {
    background-color: #a5a17b;
    color: white;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex
;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    border-left: 1px solid #d4d1b6;
    transition: background 0.2s ease;
    margin-bottom: 0px;
}

.input-upload-group .btn-importer i {
  margin-right: 8px;
}


/*   style select **/
select.form-control {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;

  background-color: #fff;
  border: 1px solid #DBD9C3;
  border-radius: 8px;
  padding: 12px 45px 12px 16px;

  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: #2A2916;

  background-image: url("/wp-content/plugins/plateforme-master/images/DROPDOWN icon.png");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 30px;
}

select.form-control::-ms-expand {
  display: none;
}


/* Pour IE */
select.form-control::-ms-expand {
  display: none;
}


select.form-control:focus {
  outline: none;
  border-color: #c4c1a0;
  box-shadow: 0 0 0 2px rgba(204, 204, 204, 0.2);
}
.bl-commentaire-1 {
    display: flex;
    vertical-align: middle;
    align-items: center;
    padding: 10px 24px;
}


.card-title h3 {
  font-size: 20px;
  font-weight: 600;
  color: #2A2916;
  margin: 0;
}

.badge-success {
  background-color: #d6f1d7;
  color: #1a7f2e;
  border: 1px solid #b4e6b7;
  font-size: 14px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 20px;
  white-space: nowrap;
  font-family: 'Poppins', sans-serif;
}
hr {
    border: 2px solid #ECEBE3;
    padding: 0px 24px;
    width: 96%;
    margin: 5px auto;
}

.etat-inscription-box {
  border: 1px solid #eae7dc;
  border-radius: 10px;
  overflow: hidden;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 20px;
}

.etat-inscription-table {
  width: 100%;
  border-collapse: collapse;
}

.etat-inscription-table td {
  padding: 16px 20px;
  font-size: 15px;
  color: #3d3c26;
  vertical-align: middle;
}

.etat-inscription-table .label {
  font-weight: 500;
  width: 220px;
}

.etat-inscription-table .value {
  font-weight: 700;
}

.etat-inscription-table .row-bg {
  background-color: #f9f8f5;
}

.badge-validation {
  display: inline-flex;
  align-items: center;
  background-color: #f3fbf4;          /* vert très clair */
  color: #0d652d;                     /* vert foncé */
  border: 2px solid #2e7d32;          /* bordure verte */
  padding: 6px 18px;
  font-size: 15px;
  font-weight: 700;
  border-radius: 50px;
  font-family: 'Poppins', sans-serif;
}

.badge-validation .dot {
  width: 12px;
  height: 12px;
  background-color: #2e7d32;         /* même vert que la bordure */
  border-radius: 50%;
  margin-right: 10px;
}
.etat-inscription-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-family: 'Poppins', sans-serif;
  overflow: hidden;
  border: 1px solid #eae7dc;
  border-radius: 10px;
}

.etat-inscription-table tr:first-child td:first-child {
  border-top-left-radius: 10px;
}

.etat-inscription-table tr:first-child td:last-child {
  border-top-right-radius: 10px;
}

.etat-inscription-table tr:last-child td:first-child {
  border-bottom-left-radius: 10px;
}

.etat-inscription-table tr:last-child td:last-child {
  border-bottom-right-radius: 10px;
}

.etat-inscription-table td {
  padding: 16px 20px;
  font-size: 15px;
  color: #3d3c26;
  vertical-align: middle;
  border-bottom: 1px solid #ecebe3;
}

.etat-inscription-table tr:last-child td {
  border-bottom: none;
}

.etat-inscription-table .label {
  font-weight: 500;
  width: 250px;
  background-color: #fdfdfb;
}

.etat-inscription-table .value {
  font-weight: 700;
}

.etat-inscription-table .row-bg .label,
.etat-inscription-table .row-bg .value {
  background-color: #f9f8f5;
}
/* ===== Accordéons (sans JS) ===== */
.acc-item {
  border-radius: 10px;
  background: #fff;
}
.acc-summary {
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  list-style: none;
}
.acc-summary::-webkit-details-marker { display: none; }

.acc-item .chev {
  width: 12px;
  height: 12px;
  position: relative;
  margin-right: 24px;
}
.acc-item .chev::before {
  content: "";
  position: absolute;
  inset: 0;
  border: solid #2A2916;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
  transition: transform .2s ease;
}
.acc-item[open] .chev::before {
  transform: rotate(-135deg);
}

/* Espacement harmonisé avec vos styles existants */
.acc-item > hr { margin-top: 5px; }

/* Décision finale barre (alignée à droite) */
img.avatar {
    width: 25px;
    height: 25px;
}
.decision-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px -5px 16px #00000012;
    border-radius: 0px 0px 10px 10px;
}
select.form-control.decision-select {
    border: 1px solid #BF0404;
    border-radius: 5px;
}
.select-wrapper select.form-control {
    width: 100%;
    padding-right: 40px; /* espace pour icône */
}

.card-title {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 19px 19px #0000000A;
    border-radius: 10px 10px 0px 0px;
}
.card-content .form-control.membre {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #DBD9C3;
        width: 420px;
}
.decision-label {
  font-weight: 600;
  color: #6E6D55;
}
.decision-select {
  min-width: 220px;
}

/* Optionnel : icônes à l’intérieur des inputs */
.input-with-icon {
  position: relative;
}
.input-with-icon i {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
  color: #a9a48a;
}

/* Votre select déjà stylé : on masque l’icône FA redondante */
.select-wrapper i.fas.fa-chevron-down { display:none; }
summary.card-title{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 5px 16px #00000012;
    border-radius: 10px 10px 0px 0px;
}
.card-content {
    padding: 20px 24px;
    background-color: #ECEBE342;
}

.decision-bar {
    display: flex;
    align-items: center;
    background: #FFFFFF;
    box-shadow: 0px -5px 16px #00000012;
    border-radius: 0px 0px 10px 10px;
}

.decision-bar h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #2A2916;
}

/* Conteneur du select collé à droite */
.decision-bar .select-wrapper {
    margin-left: auto;
    position: relative;
    min-width: 220px;
    margin-right: 24px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.decision-bar .select-wrapper select.form-control {
    width: 100%;
    padding-right: 40px; /* espace pour l'icône/flèche */
    border: 1px solid #BF0404;
    border-radius: 5px;
}


/****table  */
/* Container pagination */
.dataTables_paginate {
  display: flex !important;
  justify-content: center !important;
  margin-top: 20px !important;
  gap: 6px !important;
  font-family: 'Poppins', sans-serif !important;
}

/* Boutons de pagination */
.dataTables_paginate .paginate_button {
  background-color: #fff !important;
  border: 2px solid #c40000 !important;
  color: #c40000 !important;
  font-weight: 500 !important;
  padding: 6px 10px !important;
  min-width: 36px !important;
  text-align: center !important;
  border-radius: 8px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
}

/* Bouton actif */
.dataTables_paginate .paginate_button.current {
  background-color: #c40000 !important;
  color: #fff !important;
  border-color: #c40000 !important;
}

/* Survol */
.dataTables_paginate .paginate_button:hover {
  background-color: #f8eaea !important;
}

/* Supprime les bordures par défaut de DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  border: none !important;
}

/* Supprime focus violet */
.dataTables_paginate .paginate_button:focus {
  outline: none !important;
  box-shadow: none !important;
}

/* Table générique */
table {
  border: none !important;
  border-collapse: separate !important;
  border-spacing: 0 !important;
  border-radius: 12px !important;
  overflow: hidden !important;
  box-shadow: none !important;
      width: 100%;
}

/* En-têtes */
table thead {
  position: static !important;
  transform: translateY(-15px) !important;
  border: none !important;
}

/* Cellules */
table th {
  padding: 26px 10px 17px !important;
  border: 0px solid #EBE9D7 !important;
  background-color: #ECEBE3 !important;
  font-weight: 600 !important;
}

table td {
  padding: 12px !important;
  border: 1px solid #EBE9D7 !important;
  box-shadow: none !important;
}

/* Coins arrondis */
table thead tr:first-child th:first-child {
  border-top-left-radius: 12px !important;
  border-bottom-left-radius: 12px !important;
}
table thead tr:first-child th:last-child {
  border-top-right-radius: 12px !important;
  border-bottom-right-radius: 12px !important;
}
table tbody tr:first-child td:first-child {
  border-top-left-radius: 12px !important;
}
table tbody tr:first-child td:last-child {
  border-top-right-radius: 12px !important;
}
table tbody tr:last-child td:first-child {
  border-bottom-left-radius: 12px !important;
}
table tbody tr:last-child td:last-child {
  border-bottom-right-radius: 12px !important;
}table tbody tr:nth-child(even) , table tbody tr:nth-child(odd) {
  background: #fff 0% 0% no-repeat padding-box !important;
}

/*** style table */
button.btn.btn-outline-danger.cmt {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #BF0404;
    border-radius: 5px;
}
.btn-outline-danger:hover, .btn-danger:hover{
  color: #BF0404;
}
</style>
<script>
function afficherNomFichier(input) {
  const fileName = input.files[0]?.name ?? '';
  const container = input.closest('.input-upload-group');
  if (container) {
    const displayInput = container.querySelector('.filename-display');
    if (displayInput) displayInput.value = fileName;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const quillGeneral = new Quill('#objectifGeneral', {
    theme: 'snow',
    placeholder: 'Lister les objectifs généraux du sujet...',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        ['link'],
        [{ 'list': 'bullet' }]
      ]
    }
  });

  // 🔁 Exemple d’auto-remplissage (optionnel)
  quillGeneral.root.innerHTML = `<ul>
    <li>Acquérir des compétences avancées en IA, mathématiques appliquées et informatique.</li>
    <li>Préparer à la recherche scientifique ou à des fonctions d'expertise dans l'industrie.</li>
    <li>Maîtriser les techniques modernes de modélisation, d'apprentissage automatique et d'analyse de données.</li>
  </ul>`;

  // 🔁 Exemple de récupération HTML au submit (ajoute-le dans ton bouton de validation)
  document.querySelector('form')?.addEventListener('submit', function (e) {
    const contenuHTML = quillGeneral.root.innerHTML;
    // Tu peux envoyer `contenuHTML` dans un champ masqué ou via AJAX
    console.log("Objectif général :", contenuHTML);
  });
});


document.getElementById('btn-ajouter').addEventListener('click', function () {
  const textarea = document.getElementById('commentaire');
  const texte = textarea.value.trim();

  if (texte !== '') {
    const nouveauCommentaire = document.createElement('div');
    nouveauCommentaire.classList.add('commentaire');
    nouveauCommentaire.textContent = texte;

    document.getElementById('liste-commentaires').appendChild(nouveauCommentaire);
    textarea.value = ''; // vider le champ
  } else {
    alert('Veuillez saisir un commentaire.');
  }
});
</script>
