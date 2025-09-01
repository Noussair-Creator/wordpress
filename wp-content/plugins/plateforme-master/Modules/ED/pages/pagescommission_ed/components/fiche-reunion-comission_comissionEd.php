<!-- Fiche de réunion : Détails -->
<div class="card-section">
  <div class="card-title d-flex justify-content-between align-items-center">
    <h3>Détails</h3>

    <div class="actions-inline">
      <button class="btn btn-outline-danger">Générer un PV</button>
      <button class="btn btn-outline-danger">Éditer le contenu</button>
      <button class="btn btn-icon" title="Télécharger"><i class="fas fa-download"></i></button>
    </div>
  </div>
  <hr>

  <div class="card-content">
    <table class="etat-inscription-table details-table">
      <tr>
        <td class="label">Réunion du :</td>
        <td class="value">30-06-2025 <span class="sep">à</span> 10h00 – 12h15</td>
      </tr>
      <tr class="row-bg">
        <td class="label">Lieu :</td>
        <td class="value">Salle des conférences, Faculté des Sciences de Tunis (FST)</td>
      </tr>
      <tr>
        <td class="label">Présidence :</td>
        <td class="value">
          <span class="member">
            <img class="avatar-img" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png"   alt="Dalanda Ben Amor">
            Dalanda Ben Amor
          </span>
        </td>
      </tr>
      <tr class="row-bg">
        <td class="label">Liste des membres présents / absents :</td>
        <td class="value">
          <div class="members-grid">
            <div class="col">
              <div class="member">
                <i class="fas fa-check ok"></i><img class="avatar-img"src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png"  alt="Ahmed Salmi">
                Ahmed Salmi 
              </div>
              <div class="member">
                <i class="fas fa-check ok"></i><img class="avatar-img" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png"  alt="Ranim Slimen">
                Ranim Slimen 
              </div>
              <div class="member">
                <i class="fas fa-check ok"></i><img class="avatar-img" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="Dalanda Ben Amor">
                Dalanda Ben Amor 
              </div>
            </div>
            <div class="col">
              <div class="member">
                <i class="fas fa-times ko"></i>
                <img class="avatar-img" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="Manel Gaied">
                Manel Gaied
              </div>
              <div class="member">
                <i class="fas fa-times ko"></i>
                <img class="avatar-img" src="/wp-content/plugins/plateforme-master/images/ed/Groupe de masques 372.png" alt="Tarak Bouaziz">
                Tarak Bouaziz
              </div>
            </div>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="card-title">
    <h3>Observations finales / recommandation globale</h3>
  </div>
  <hr>

  <div class="card-content">
    <ul class="triangle-list">
      <li>Examen de dossiers d’habilitation (HDR)</li>
      <li>Validation des réinscriptions 2024/2025</li>
      <li>Examen des rapports de pré-soutenance</li>
    </ul>

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
.card-title.d-flex {
    padding-right: 22px;
    box-shadow: 0px 5px 16px #00000012;
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
  width: auto;
  background-color: #fdfdfb;
}

.etat-inscription-table .value {
  font-weight: 700;
}

.etat-inscription-table .row-bg .label,
.etat-inscription-table .row-bg .value {
  background-color: #f9f8f5;
}
i.fas.fa-download {
    color: #b60303;
}
button.btn.btn-icon {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 6px #00000030;
    border-radius: 5px;
}/* avatars image */
.avatar-img{
  width:26px;height:26px;border-radius:50%;
  object-fit:cover;margin-right:8px;box-shadow:0 0 0 2px #fff;    margin-left: 10px;

}
i.fas.fa-check.ok {
color:green;
}i.fas.fa-times.ko {
    color: #b60303;
}
.members-grid {
    display: flex
;
}
/* Liste avec triangle rouge */
.triangle-list{
  list-style: none;
  margin: 0;
  padding: 0;
}
.triangle-list li{
  position: relative;
  padding-left: 22px; /* espace pour l’icône */
}
.triangle-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0.40em;
    width: 10px;
    height: 14px;
    background: #BF0404;
    opacity: 1;
    -webkit-clip-path: polygon(50% 0, 0 100%, 100% 100%);
    clip-path: polygon(50% 0, 0 100%, 100% 100%);
    transform: matrix(0, 1, -1, 0, 0, 0);
}
/* (option lisible équivalente à la matrix) */
/* .triangle-list li::before{ transform: rotate(90deg); } */

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
