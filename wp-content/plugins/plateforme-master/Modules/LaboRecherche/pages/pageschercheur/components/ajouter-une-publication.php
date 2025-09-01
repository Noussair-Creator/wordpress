<style>
/* Custom styles to match the design */


.form-container {
    background-color: #FAFAF8;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Removed .section-card styling */
h2 {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 5px 20px;
    padding: 6px 10px 5px 10px;
    color: #333;
    border: hidden;
}

#h2top {
    margin-top: 40px;
}

.bg {
    padding: 0px 30px 20px 30px;
    /* Re-apply horizontal padding to align content */
    background-color: #ffffffff;
    box-shadow: 0px 8px 12px -9px #33333350;
    margin-bottom: 30px;
    /* FIX: Use negative margins to span the full width of the parent container */
    margin-left: -30px;
    margin-right: -30px;
}

.bg-reverse {
    padding: 3px 30px 20px 30px;
    background-color: #ffffffff;
    box-shadow: 0px -10px 12px -9px #33333350;
    margin-top: 30px;   
    margin-left: -30px;
    margin-right: -30px;
}

/* .under-line {
        box-shadow: 1px 2px 5px 2px rgb(0 0 0);
        margin-inline: -30px;
    } */

/* .under-line-reverse {
        box-shadow: 0px -2px 5px 2px rgb(0 0 0);
        margin-inline: -30px;
    } */

/* Added margin-top to headers that are not the first one */
h2:not(:first-of-type) {
    margin-top: 40px;
}

.form-label {
    font-weight: 500;
    color: #6E6D55;
    margin-bottom: .5rem;
}

.form-control,
.form-select {
    border-radius: 6px;
    border-color: #DBD9C3;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
}

/* File Upload Styling */
.file-import-section {
    display: flex;
    align-items: center;
    border: 1px solid #DBD9C3;
    border-radius: 6px;
    padding-left: 12px;
}

.file-import-section input[type="text"] {
    border: none;
    box-shadow: none;
    flex-grow: 1;
}

.file-import-section .btn-import {
    background-color: #A6A485;
    color: #ffffffff;
    border: 1px solid #DBD9C3;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    font-weight: 500;
}

.file-import-section .btn-import:hover {
    background-color: #b0b0b0;
}

.file-list {
    list-style: none;
    padding: 0;
    margin-top: 15px;
}

.file-list-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
    font-size: 0.9rem;
    color: #333;
    gap: 20px;
    margin-bottom: 10px
}

.file-list-item i {
    color: #dc3545;
    margin-right: 10px;
    font-size: 1.2rem;
}

.file-list-item .btn-remove-file {
    background: #dc3545;
    border: none;
    color: #ffffffff;
    cursor: pointer;
    /* margin-left: auto; */
    font-size: 20px;
    padding: 10px;
    border-radius: 50%;
}

/* Button Styling */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 30px;
}

.btn-draft {
    background-color: transparent;
    border: 1px solid #c0392b;
    color: #c0392b;
    font-weight: 500;
}

.btn-draft:hover {
    background-color: #c0392b;
    color: white;
}

.btn-submit {
    background-color: #c0392b;
    border-color: #c0392b;
    color: white;
    font-weight: 500;
}

.btn-submit:hover {
    background-color: #a93226;
    border-color: #a93226;
}
</style>


<form id="form-publication" class="form-container">
  <!-- Informations générales -->
  <div class="bg">
    <h2>Informations générales</h2>
  </div>

  <div class="row g-3">
    <div class="col-md-6">
      <label for="publicationType" class="form-label">Type de publication :</label>
      <!-- name DOIT être "type" -->
      <select class="form-select" id="publicationType" name="type" required>
        <option selected disabled value=""></option>
        <option>Article</option>
        <option>Rapport</option>
        <option>Présentation</option>
      </select>
    </div>

    <div class="col-md-6">
      <label for="submissionDate" class="form-label">Date de publication :</label>
      <!-- name DOIT être "date_publication" -->
      <div class="input-group">
        <input type="date" class="form-control" id="submissionDate" name="date_publication" required>
      </div>
    </div>

    <div class="col-12">
      <label for="completeTitle" class="form-label">Titre complet :</label>
      <!-- name DOIT être "titre" -->
      <input type="text" class="form-control" id="completeTitle" name="titre" required>
    </div>

    <!-- CHAMPS ADDITIONNELS attendus par l'API -->
    <div class="col-md-4">
      <label for="revue" class="form-label">Revue / Support</label>
      <!-- name DOIT être "revue" -->
      <input type="text" class="form-control" id="revue" name="revue" placeholder="Journal / Conférence / Support">
    </div>

    <div class="col-md-4">
      <label for="doi" class="form-label">DOI</label>
      <!-- name DOIT être "doi" -->
      <input type="text" class="form-control" id="doi" name="doi" placeholder="10.xxxx/xxxxx">
    </div>

    <div class="col-md-4">
      <label for="isbn" class="form-label">ISBN</label>
      <!-- name DOIT être "isbn" -->
      <input type="text" class="form-control" id="isbn" name="isbn" placeholder="978-...">
    </div>

    <!-- hidden: sera rempli avec l'utilisateur connecté -->
    <input type="hidden" id="chercheur_id" name="chercheur_id" value="">
  </div>

  <!-- Documents associés -->
  <div class="bg">
    <h2 id="h2top">Documents associés</h2>
  </div>

  <label for="fichier_url" class="form-label">Pièce jointe (PDF, etc.)</label>
  <div class="file-import-section">
    <!-- IMPORTANT: name DOIT être "fichier_url" (le JS l'attend comme champ fichier) -->
    <input type="file" id="fichier_url" name="fichier_url" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.png,.jpg">
    <!-- Si tu veux garder ton UI "Importer" + input texte, tu peux -->
    <div class="d-flex gap-2 mt-2">
      <input type="text" class="form-control" id="fileImport" placeholder="Importer" readonly>
      <button class="btn btn-import" type="button" id="importButton">Importer</button>
    </div>
  </div>

  <ul class="file-list" id="fileList">
    <!-- (facultatif) liste visuelle -->
  </ul>

  <!-- Commentaire complémentaire (non envoyé par le JS généré par défaut) -->
  <div class="bg">
    <h2 id="h2top">Commentaire complémentaire (optionnel)</h2>
  </div>
  <div class="mb-3">
    <label for="comment" class="form-label">Commentaire</label>
    <textarea class="form-control" id="comment" rows="3" placeholder="Commentaire..."></textarea>
  </div>

  <div class="bg-reverse">
    <div class="form-actions">
      <button type="button" class="btn btn-draft" id="btnSaveDraft">Enregistrer en brouillon</button>
      <button type="button" class="btn btn-submit" id="btnSubmitPublication">Soumettre</button>
    </div>
  </div>
</form>


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    xintegrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
// --- JavaScript for File Upload Interaction ---

const importButton = document.getElementById('importButton');
const fileInput = document.getElementById('fileInput');
const fileList = document.getElementById('fileList');

// Trigger the hidden file input when the "Importer" button is clicked
importButton.addEventListener('click', () => {
    fileInput.click();
});

// Handle file selection
fileInput.addEventListener('change', (event) => {
    const files = event.target.files;
    for (const file of files) {
        addFileToList(file);
    }
    // Reset file input to allow selecting the same file again
    fileInput.value = '';
});

/**
 * Adds a file to the visual list.
 * @param {File} file - The file object to add.
 */
function addFileToList(file) {
    // Prevent adding duplicate files
    if (isFileAlreadyAdded(file.name)) {
        console.warn(`File "${file.name}" is already in the list.`);
        return;
    }

    const listItem = document.createElement('li');
    listItem.className = 'file-list-item';
    listItem.dataset.filename = file.name; // Store filename for duplicate check

    // Determine icon based on file type
    let fileIconClass = 'fas fa-file'; // Default icon
    if (file.type.includes('pdf')) {
        fileIconClass = 'fas fa-file-pdf';
    } else if (file.type.includes('image')) {
        fileIconClass = 'fas fa-file-image';
    } else if (file.type.includes('word')) {
        fileIconClass = 'fas fa-file-word';
    }

    listItem.innerHTML = `
                    <i class="${fileIconClass}"></i>
                    <span>${file.name}</span>
                    <button class="btn-remove-file" onclick="removeFile(this)">&times;</button>
                `;
    fileList.appendChild(listItem);
}

/**
 * Removes a file from the list when its remove button is clicked.
 * @param {HTMLElement} buttonElement - The remove button that was clicked.
 */
function removeFile(buttonElement) {
    const listItem = buttonElement.parentElement;
    listItem.remove();
}

/**
 * Checks if a file with the same name is already in the list.
 * @param {string} fileName - The name of the file to check.
 * @returns {boolean} - True if the file exists, false otherwise.
 */
function isFileAlreadyAdded(fileName) {
    const existingFiles = fileList.querySelectorAll('.file-list-item');
    for (const item of existingFiles) {
        if (item.dataset.filename === fileName) {
            return true;
        }
    }
    return false;
}
</script>