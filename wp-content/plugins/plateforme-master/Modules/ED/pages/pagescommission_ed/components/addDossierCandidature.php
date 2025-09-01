<!-- Bloc : Candidature / Entretien & Décision -->
<div class="card-section">

  <!-- Accordéon 1 : Dossier candidature -->
  <details class="acc-item" open>
    <summary class="card-title d-flex justify-content-between align-items-center acc-summary">
      <h3>Dossier candidature</h3>
      <span class="chev"></span>
    </summary>

    <div class="card-content">
      <!-- Exemple contenu (remplacez par vos champs/infos de dossier) -->
      <table class="etat-inscription-table details-table">
        <tr>
          <td class="label">Référence du dossier :</td>
          <td class="value">CAND-2025-0145</td>
        </tr>
        <tr class="row-bg">
          <td class="label">Statut du dossier :</td>
          <td class="value">
            <span class="badge-validation"><span class="dot"></span>Complet</span>
          </td>
        </tr>
        <tr>
          <td class="label">Pièces jointes :</td>
          <td class="value">CV, Lettres de recommandation, Relevés</td>
        </tr>
      </table>
    </div>
  </details>

  <!-- Accordéon 2 : Entretien / évaluation -->
  <details class="acc-item">
    <summary class="card-title acc-summary">
      <h3>Entretien / évaluation</h3>
      <span class="chev"></span>
    </summary>

    <div class="card-content">
      <div class="form-row">
        <!-- Date -->
        <div class="form-group">
          <label>Date d’entretien</label>
          <div class="input-with-icon">
            <input type="text" class="form-control" value="12-07-2025">
            <i class="far fa-calendar-alt"></i>
          </div>
        </div>

        <!-- Heure -->
        <div class="form-group">
          <label>Heure</label>
          <div class="input-with-icon">
            <input type="text" class="form-control" value="10:00">
            <i class="far fa-clock"></i>
          </div>
        </div>

        <!-- Membres évaluateurs -->
        <div class="form-group">
          <label>Membre(s) évaluateur(s)</label>
          <div class="select-wrapper">
            <select class="form-control">
              <option>Sélection...</option>
              <option>Pr. Leïla Ajmi</option>
              <option>Dr. Kacem</option>
              <option>Dr. Dali</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Observations -->
      <div class="form-group">
        <label>Observations</label>
        <textarea class="form-control" rows="3">Bonne Cohérence Entre Le Projet Et La Thématique. Dossier Solide Mais Manque Une Publication</textarea>
      </div>
    </div>
  </details>

  <!-- 3) Décision finale (alignée à droite, “Acceptée”) -->
  <div class="decision-bar">
    <h3>Décision finale</h3>
    <div class="select-wrapper">
      <select class="form-control decision-select">
        <option selected>Acceptée</option>
        <option>Refusée</option>
        <option>En attente</option>
      </select>
    </div>
  </div>

</div>





<style>
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
  border: 1.5px solid #c40000;
  background-color: #fff;
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
