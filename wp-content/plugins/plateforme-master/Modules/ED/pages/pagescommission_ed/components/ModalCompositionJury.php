<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="modal-overlay" id="modalObjectifs" style="display: none;">
  <div class="popup-container" id="popupContainerObjectifs">
    <div class="popup-header">
      <h2>Composition du jury</h2>
      <!-- on garde la classe/ID existants -->
      <button class="btn-enregistrer" id="btnSaveObjectifs" type="button" onclick="closeModalObjectifs()"
              aria-label="Fermer"
              style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;padding:0;">
        ✕
      </button>
    </div>

    <form class="popup-form">
      <div class="editor-wrapper" style="padding-top:6px;">

        <div style="font-weight:600;color:#2A2916;margin-bottom:12px;">Liste des jurys</div>

        <!-- Rapporteur -->
        <div style="margin-bottom:16px;">
          <label style="display:block;font-weight:600;color:#6E6D55;margin-bottom:6px;">Rapporteur</label>

          <!-- Ligne de base -->
          <div style="display:flex;align-items:center;gap:10px;" id="rapporteurBaseRow">
            <div style="position:relative;flex:1;">
              <select class="form-control">
                <option>Sélection...</option>
                <option>Pr. Leïla Ajmi</option>
                <option>Dr. Youssef Kacem</option>
                <option>Dr. Amal Ben Dali</option>
              </select>
             
            </div>

            <!-- Bouton d’ajout -->
            <button type="button" class="btn-enregistrer" id="btnAddRapporteur"
                    style="width:36px;height:36px;padding:0;display:inline-flex;align-items:center;justify-content:center;
                          background:#fff;border:1.5px solid #BF0404;color:#BF0404;">+</button>
          </div>

          <!-- Conteneur des lignes ajoutées -->
          <div id="rapporteurExtraRows"></div>
        </div>

        <!-- Présidente -->
        <div style="margin-bottom:16px;">
          <label style="display:block;font-weight:600;color:#6E6D55;margin-bottom:6px;">Présidente</label>
          <div style="position:relative;">
            <select class="form-control">
              <option>Sélection...</option>
            </select>
            
          </div>
        </div>

        <!-- Examinateur -->
        <div>
          <label style="display:block;font-weight:600;color:#6E6D55;margin-bottom:6px;">Examinateur</label>
          <div style="position:relative;">
            <select class="form-control">
              <option>Sélection...</option>
            </select>
           
          </div>
        </div>

      </div>
    </form>
  </div>
</div>

<style>

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
button.btn-enregistrer {
    margin-top: -17px;
}
</style>

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

document.addEventListener('DOMContentLoaded', function () {
  const addBtn   = document.getElementById('btnAddRapporteur');
  const baseHold = document.querySelector('#rapporteurBaseRow > div'); // le bloc select + caret
  const extraBox = document.getElementById('rapporteurExtraRows');

  function addRapporteurRow() {
    // clone du bloc select
    const holder = baseHold.cloneNode(true);
    const sel = holder.querySelector('select.form-control');
    if (sel) sel.selectedIndex = 0;

    // bouton supprimer
    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'btn-enregistrer';
    removeBtn.textContent = '–';
    removeBtn.style.cssText =
      'width:36px;height:36px;margin-left:10px;padding:0;display:inline-flex;align-items:center;justify-content:center;'+
      'background:#fff;border:1.5px solid #999;color:#555;';

    // ligne complète
    const row = document.createElement('div');
    row.style.cssText = 'display:flex;align-items:center;gap:10px;margin-top:8px;';
    row.appendChild(holder);
    row.appendChild(removeBtn);

    // suppression de la ligne
    removeBtn.addEventListener('click', () => row.remove());

    // insertion
    extraBox.appendChild(row);
  }

  addBtn?.addEventListener('click', addRapporteurRow);
});

</script>
