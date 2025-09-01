<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="modal-overlay" id="modalObjectifs" style="display: none;">
  <div class="popup-container" id="popupContainerObjectifs">

    <!-- HEADER -->
    <div class="popup-header">
      <h2>Dépôt</h2>
      <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
    </div>

    <!-- FORM -->
    <form class="popup-form">

      <!-- Pièce jointe -->
      <div class="form-group">
        <label>Pièce jointe</label>
        <div class="input-upload-group">
          <input type="text" class="form-control filename-display" placeholder="Pièce jointe" readonly>
          <label class="btn-importer">
            <i class="fas fa-upload"></i> Importer
            <input type="file" hidden accept=".pdf">
          </label>
        </div>
        <small class="hint">PDF uniquement, max 50 Mo</small>
      </div>


      <!-- Période -->
      <div class="form-group">
        <label>Période</label>
        <div class="date-range">
          <input type="text" id="periode" class="date-input" placeholder="01/10/2023 – 30/06/2024" readonly>
          <span class="ico"><i class="far fa-calendar"></i></span>
        </div>
      </div>



      <!-- Commentaire -->
      <div class="form-group">
        <label>Commentaire</label>
        <textarea class="form-control textarea" placeholder="Note..."></textarea>
      </div>

    </form>
  </div>
</div>

<style>
/* S'assure que le popup flatpickr est au-dessus du tiroir */
.flatpickr-calendar {
  z-index: 1000001 !important;
}

.btn-close-x {
  background: transparent;
  border: none;
  font-size: 20px;
  font-weight: bold;
  color: #333;
  cursor: pointer;
  padding: 4px 10px;
  line-height: 1;
  transition: color 0.2s ease;
  margin-left: auto;
}

.btn-close-x:hover {
  color: #c40000;
}

.modal-overlay {
  position: fixed;
  top: 0px;
    left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: flex-end;
  z-index: 999999;
}

.popup-container {
    background-color: white;
    width: 400px;
    height: 100%;
    padding: 20px 0px;
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    padding-top: 0px;
}

.popup-header {
    display: flex
;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 10px;
    margin-bottom: 20px;
    padding-left: 25px;
    padding-right: 25px;
    box-shadow: 0px 5px 16px #00000029;
    padding-top: 20px;
}
form.popup-form {
    padding-left: 25px;
    padding-right: 25px;
}
.popup-header h2 , .popup-form h2{
 font-size: 16px;
    margin: 0;
    color: #2A2916;

}

.btn-enregistrer {
  background-color: #c62828;
  color: white;
  border: none;
  padding: 6px 14px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

.popup-form input,
.popup-form select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #b5af8e;
  border-radius: 7px;
  font-size: 14px;
}
.input-upload-group input {
    width: 100%;
    padding: 10px;
    margin-bottom: 0px;
     border: 0px solid #b5af8e;
    border-radius: 7px;
    font-size: 14px;
}
.input-upload-group label {
  margin-bottom: 1px !important;
  color: #fff !important;
}
.file-upload {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.file-upload input[type="file"] {
  display: none;
}

.file-upload label {
  background-color: #f5f5f5;
  padding: 8px 14px;
  border: 1px solid #ccc;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
}

.file-upload {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.file-upload input[type="file"] {
  display: none;
}

.file-upload label {
  background-color: #f5f5f5;
  padding: 8px 14px;
  border: 1px solid #ccc;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
}
.piece-jointe-row {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}

.champ-fichier {
  flex: 1;
  padding: 10px;
  border: 1px solid #ccc;
  background-color: #f3f3f3;
  border-radius: 6px;
  font-size: 14px;
  color: #666;
}

.btn-importer {
  background-color: #c62828;
  color: white;
  padding: 10px 16px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  text-align: center;
  white-space: nowrap;
}
.custom-file-upload {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 10px;
}

.upload-label {
  display: inline-block;
  padding: 10px 15px;
  background-color: #f8f8f8;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  width: fit-content;
  transition: all 0.3s ease;
}

.upload-label:hover {
  background-color: #eaeaea;
}

.upload-label i {
  margin-right: 8px;
  color: #b40000;
}

.input-file-wrapper {
  display: flex;
  align-items: center;
  border: 1px solid #e2e0d1;
  border-radius: 6px;
  overflow: hidden;
  width: 100%;
  background-color: white;
}

.input-file-text {
  flex: 1;
  border: none;
  padding: 10px 12px;
  font-size: 14px;
  color: #555;
  background-color: transparent;
}

.input-file-text:focus {
  outline: none;
}

.btn-importer {
  background-color: #b5af8e;
  color: white;
  padding: 10px 16px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  border-left: 1px solid #e2e0d1;
}

.btn-importer i {
  font-size: 14px;
}

.modal-overlay label {
    min-width: 180px;
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
    margin-bottom: 7px;
}



  .objectifs_liste {
    list-style-type: none;
    padding-left: 0;
    margin-bottom: 20px;
  }

  .objectifs_liste li::before {
    content: '\25B6';
    color: #b40000;
    margin-right: 8px;
  }

  .btn-ajouter {
    background-color: #c62828;
    color: white;
    border: none;
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
  }

  textarea {
    width: 100%;
    border: 1px solid #b5af8e;
    border-radius: 6px;
    padding: 12px;
    font-size: 14px;
  }
  .ql-toolbar.ql-snow {
    border-radius: 6px 6px 0 0;
    background-color: #ecebe3;
}

.ql-container.ql-snow {
  border-radius: 0 0 6px 6px;
  font-size: 14px;
}
.ql-toolbar.ql-snow {
    border: 1px solid #DBD9C3;
    box-sizing: border-box;
    font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
    padding: 8px;
}.ql-editor.ql-blank {
    border: 1px solid #DBD9C3;
}


.input-upload-group {
  display: flex;
  align-items: center;
  border: 1px solid #e2e0d1;
  border-radius: 6px;
  overflow: hidden;
  background-color: #fff;
}

.filename-display {
  flex: 1;
  border: none;
  padding: 10px 12px;
  font-size: 14px;
  color: #2A2916;
  background-color: #fff;
}

.filename-display::placeholder {
  color: #a1a093;
}

.btn-importer {
  background-color: #b5af8e; /* couleur du bouton Importer */
  color: white;
  padding: 10px 16px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  border-left: 1px solid #e2e0d1;
  white-space: nowrap;
}

.btn-importer i {
  font-size: 14px;
}

.hint {
  display: block;
  margin-top: 6px;
  font-size: 12px;
  color: #9b9985;
}
.date-range {
    position: relative;
    display: flex;
    align-items: center;
    border-radius: 6px;
    padding: 0px 0px;
    background-color: #fff;
}
.form-group {
    margin-bottom: 14px;
}
.date-input {
  flex: 1;
  border: none;
  outline: none;
  font-size: 14px;
  color: #2A2916;
  background: transparent;
  cursor: pointer;
}

.date-input::placeholder {
  color: #2A2916;
}

.ico {
    position: absolute;
    right: 20px;
    color: #8c8a74;
    font-size: 18px;
}
.flatpickr-input[readonly] {
    cursor: pointer;
    margin-bottom: 0px;
    padding-right: 10px;
}
</style>
<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Init range picker sur l'input #periode
  const fp = flatpickr("#periode", {
    mode: "range",
    dateFormat: "d/m/Y",
    locale: flatpickr.l10ns.fr,     // français
    rangeSeparator: " – ",          // comme la maquette
    allowInput: false,              // laisse readonly, on passe par le calendrier
    // optionnel: valeur par défaut pour test
    // defaultDate: ["2023-10-01","2024-06-30"]
  });

  // Clic sur l’icône => ouvre le calendrier
  const ico = document.querySelector('.date-range .ico');
  const input = document.getElementById('periode');
  if (ico && input) {
    ico.addEventListener('click', function () {
      input.focus();    // ouvre flatpickr
      // fp.open();     // ou explicitement
    });
  }
});
</script>


<script>

function openmodalObjectifs() {
  const modal = document.getElementById("modalObjectifs");
  if (modal) {
    modal.style.display = "flex";
  } else {
    console.error("Modal non trouvé : #modalObjectifs");
  }
}




  const objectifs = [];

  function ajouterObjectif() {
    const val = document.getElementById("newObjectifGeneral").value.trim();
    if (val) {
      objectifs.push(val);
      const li = document.createElement("li");
      li.textContent = val;
      document.getElementById("listeObjectifsGeneraux").appendChild(li);
      document.getElementById("newObjectifGeneral").value = "";
    }
  }
/*
  // Fermeture modal si clic dehors
  document.getElementById("modalObjectifs").addEventListener("click", function (e) {
    const popup = document.getElementById("popupContainerObjectifs");
    if (!popup.contains(e.target)) {
      this.style.display = "none";
    }
  });*/


  document.addEventListener("DOMContentLoaded", function () {
  const btn = document.querySelector(".openmodalObjectifs");
  const modal = document.getElementById("modalObjectifs");

  if (btn && modal) {
    btn.addEventListener("click", function () {
      modal.style.display = "flex";
    });
  }
});


let quillGeneral;

document.addEventListener("DOMContentLoaded", () => {
  // Objectifs spécifiques déjà init
  quillSpecifique = new Quill('#objectifSpecifique', {
    theme: 'snow',
    placeholder: '......',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        ['link'],
        [{ 'list': 'bullet' }]
      ]
    }
  });


});


function closeModalObjectifs() {
  const modal = document.getElementById("modalObjectifs");
  if (modal) {
    modal.style.display = "none";
  }
}
const modal = document.getElementById("modalObjectifs");
const popup = document.getElementById("popupContainerObjectifs");

if (modal && popup) {
  modal.addEventListener("click", function (e) {
    if (!popup.contains(e.target)) {
      modal.style.display = "none";
    }
  });
}

// Gestion affichage du nom + validation PDF
document.querySelector(".btn-importer input[type='file']").addEventListener("change", function () {
  const file = this.files[0];
  const nameField = document.querySelector(".filename-display");

  if (!file) {
    nameField.value = "";
    return;
  }

  // Validation format PDF
  const isPDF = file.type === "application/pdf" || file.name.toLowerCase().endsWith(".pdf");
  if (!isPDF) {
    alert("Veuillez sélectionner un fichier PDF uniquement.");
    this.value = "";
    nameField.value = "";
    return;
  }

  // Validation taille max 50 Mo
  if (file.size > 50 * 1024 * 1024) {
    alert("Le fichier dépasse la taille maximale autorisée de 50 Mo.");
    this.value = "";
    nameField.value = "";
    return;
  }

  // Affiche le nom du fichier
  nameField.value = file.name;
});


</script>

