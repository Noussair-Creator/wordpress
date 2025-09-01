<!-- Inclure Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="page-wrapper">
  
  <!-- Bloc : Informations générales -->
  <div class="card-section">
    <div class="card-title">
      <h3>Informations générales</h3>
    </div>
    <div class="card-content">
      <div class="form-row">
        <div class="form-group">
          <label for="titre_formation">Titre de la formation</label>
          <input type="text" class="form-control" id="titre_formation" placeholder="Titre">
        </div>
        <div class="form-group">
          <label for="type_formation">Type de formation</label>
          <select class="form-control" id="type_formation">
            <option>Obligatoire</option>
            <option>Facultative</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="objectifGeneral">Objectifs pédagogiques</label>
        <div id="objectifGeneral" style="height: 150px;"></div>
        <input type="hidden" name="objectif_generaux_html" id="objectifGenerauxHidden">
      </div>
     
    </div>
  </div>

  <!-- Bloc : Planning -->
  <div class="card-section">
    <div class="card-title">
      <h3>Planning</h3>
    </div>
    <div class="card-content">
      <!-- Première ligne -->
      <div class="form-row">
        <div class="form-group">
          <label for="date_debut">Date de début</label>
          <input type="date" id="date_debut" class="form-control" value="2025-07-12">
        </div>
        <div class="form-group">
          <label for="date_fin">Date fin</label>
          <input type="date" id="date_fin" class="form-control" value="2025-07-12">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="duree_totale">Durée totale</label>
          <input type="time" id="duree_totale" class="form-control" value="10:00">
        </div>
        <div class="form-group">
          <label for="frequence">Fréquence</label>
          <select id="frequence" class="form-control">
            <option>Session Unique</option>
            <option>Hebdomadaire</option>
          </select>
        </div>
      </div>

      <!-- Deuxième ligne -->
      <div class="form-row">
        <div class="form-group">
          <label for="lieu">Lieu / Salle ou lien visio</label>
          <input type="text" id="lieu" class="form-control" value="Amphi 1">
        </div>
        <div class="form-group">
          <label for="modalite">Modalité</label>
          <select id="modalite" class="form-control">
            <option>Présentiel</option>
            <option>En ligne</option>
          </select>
        </div>
        </div>
        <div class="form-row">
        <div class="form-group">
          <label for="formateur">Formateur(s) responsable(s)</label>
          <select id="formateur" class="form-control">
            <option>Présentiel</option>
          </select>
        </div> 
        </div>
        <div class="form-row">
        <div class="form-group">
          <label for="fichier_joint">Pièce jointe</label>
          <div class="input-upload-group">
            <input type="text" class="form-control filename-display" placeholder="Pièce jointe" readonly>
            <label class="btn-importer">
              <i class="fas fa-upload"></i>
              Importer
              <input type="file" hidden onchange="afficherNomFichier(this)">
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Bloc : Notes internes -->
  <div class="card-section">
    <div class="card-title">
      <h3>Notes internes</h3>
    </div>
    <div class="card-content">
      <div class="form-group">

      <!-- Commentaire interne ED -->
      <div class="card full-width">
        <h3>Commentaire</h3>

        <div class="bl-commentaire-1">
          <textarea id="commentaire" class="form-control" placeholder="Ajouter un commentaire ..."></textarea>
          <button type="submit" class="btn btn-danger mt-2" id="btn-ajouter">Ajouter</button>
        </div>

        <div id="liste-commentaires" class="commentaire-liste">
          <!-- Les commentaires s’ajouteront ici -->
        </div>
      </div>


    </div>
  </div>

  <!-- Boutons finaux -->
  <div class="form-actions">
    <button class="btn btn-outline-danger">Enregistrer en brouillon</button>
    <button class="btn btn-danger">Publier la formation</button>
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
    background-color: #FAFAFA;
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
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 19px 19px #0000000A;
    border-radius: 10px 10px 0px 0px;
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
