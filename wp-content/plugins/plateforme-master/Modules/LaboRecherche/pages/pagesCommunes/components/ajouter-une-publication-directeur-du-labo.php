<?php if (!defined('ABSPATH'))
  exit; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter une publication</title>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> -->

<style>
  body {
    background: #f0f0f0;
    font-family: 'Inter', sans-serif
  }

  .form-container {
    background: #FAFAF8;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .05)
  }

  h2 {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0 20px;
    padding: 20px 0px;
    color: #333;
    border: hidden;
  }

  #h2top {
    margin-top: 40px
  }

  .bg {
    background: #fff;
    box-shadow: 0 8px 12px -9px #3333;
    margin: 0 -30px 10px;
  }

  .bg:first-child {
    border-top-right-radius: 8px;
    border-top-left-radius: 8px;
  }

  .bg-reverse {
    padding: 1px 30px 1px;
    background: #fff;
    box-shadow: 0 -10px 12px -9px #3333;
    margin: 30px -30px 0;
    border-bottom-right-radius: 8px;
    border-bottom-left-radius: 8px;
  }

  .form-label {
    font-weight: 500;
    color: #6E6D55;
    margin-bottom: .5rem
  }

  .form-control,
  .form-select {
    border-radius: 6px;
    border-color: #DBD9C3
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
  }

  .file-import-section {
    display: flex;
    align-items: center;
    border: 1px solid #DBD9C3;
    border-radius: 6px;
    padding-left: 12px
  }

  .file-import-section input[type="text"] {
    border: none;
    box-shadow: none;
    flex-grow: 1
  }

  .file-import-section .btn-import {
    background: #A6A485;
    color: #fff;
    border: 1px solid #DBD9C3;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    font-weight: 500
  }

  .file-import-section .btn-import:hover {
    background: #b0b0b0
  }

  .file-list {
    list-style: none;
    padding: 0;
    margin-top: 15px
  }

  .file-list-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
    font-size: .9rem;
    color: #333;
    gap: 20px;
    margin-bottom: 10px
  }

  .file-list-item .btn-remove-file {
    background: #dc3545;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 20px;
    padding: 10px;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 30px
  }

  .btn-draft {
    background: transparent;
    border: 1px solid #c0392b;
    color: #c0392b;
    font-weight: 500
  }

  .btn-draft:hover {
    background: #c0392b;
    color: #fff
  }

  .btn-submit {
    background: #c0392b;
    border-color: #c0392b;
    color: #fff;
    font-weight: 500
  }

  .btn-submit:hover {
    background: #a93226;
    border-color: #a93226
  }
</style>

<div class="form-container">
  <div class="bg">
    <h2>Informations générales</h2>
  </div>
  <div class="row g-3">
    <div class="col-md-6">
      <label for="publicationType" class="form-label">Type de publication :</label>
      <select class="form-select" id="publicationType" required>
        <option selected disabled value=""></option>
        <option value="Article">Article</option>
        <option value="Rapport">Rapport</option>
        <option value="Présentation">Présentation</option>
      </select>
    </div>
    <div class="col-md-6">
      <label for="submissionDate" class="form-label">Date de publication :</label>
      <div class="input-group">
        <input type="date" class="form-control" id="submissionDate" required>
      </div>
    </div>
    <div class="col-12">
      <label for="completeTitle" class="form-label">Titre complet :</label>
      <input type="text" class="form-control" id="completeTitle" required>
    </div>


    <div class="col-12">
      <label for="summary" class="form-label">Résumé</label>
      <textarea class="form-control" id="summary" rows="4"></textarea>
    </div>
  </div>

  <div class="bg">
    <h2 id="h2top">Documents associés</h2>
  </div>
  <label for="fileImport" class="form-label">Pièces jointes</label>
  <div class="file-import-section">
    <input type="text" class="form-control" id="fileImport" placeholder="Importer">
    <button class="btn btn-import" type="button" id="importButton">Importer</button>
    <input type="file" id="fileInput" multiple style="display:none" accept=".pdf,.doc,.docx,.ppt,.pptx">
  </div>
  <ul class="file-list" id="fileList"></ul>

  <div class="bg">
    <h2 id="h2top">Commentaire complémentaire (optionnel)</h2>
  </div>
  <div class="mb-3">
    <label for="comment" class="form-label">Commentaire</label>
    <textarea class="form-control" id="comment" rows="3" placeholder="Commentaire..."></textarea>
  </div>

  <div class="bg-reverse">
    <div class="form-actions">
      <button type="button" class="btn btn-draft" id="btnDraft" disabled>Brouillon</button>
      <button type="button" class="btn btn-submit" id="btnSubmit">Soumettre ma demande</button>
    </div>
    <div class="mt-2 small text-muted" id="formHint"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script>
  /* ====== Settings (via pmsettings, avec fallback) ====== */
const API_BASE = (window.pmsettings && pmsettings.api_base) || '/wp-json/plateforme-recherche/v1';
  const REST_NONCE = (window.pmsettings && pmsettings('rest_nonce')) || (
    <?php echo wp_json_encode(wp_create_nonce('wp_rest')); ?>);

  /* ====== Sélecteurs ====== */
  const importButton = document.getElementById('importButton');
  const fileInput = document.getElementById('fileInput');
  const fileList = document.getElementById('fileList');
  const fileImportText = document.getElementById('fileImport');
  const btnSubmit = document.getElementById('btnSubmit');
  const hint = document.getElementById('formHint');

  const elType = document.getElementById('publicationType');
  const elDate = document.getElementById('submissionDate');
  const elTitre = document.getElementById('completeTitle');
  const elResume = document.getElementById('summary');
  const elComm = document.getElementById('comment');

  /* ====== Upload UI ====== */
  importButton.addEventListener('click', () => fileInput.click());
  fileImportText.addEventListener('click', () => fileInput.click());
  fileInput.addEventListener('change', (e) => {
    const files = e.target.files;
    for (const f of files) addFileToList(f);
    fileInput.value = '';
  });

  function addFileToList(file) {
    if (isFileAlreadyAdded(file.name)) return;
    const li = document.createElement('li');
    li.className = 'file-list-item';
    li.dataset.filename = file.name;
    li.innerHTML = `
    <span class="badge bg-secondary">${file.type || 'fichier'}</span>
    <span>${file.name}</span>
    <button class="btn-remove-file" title="Retirer" onclick="this.parentElement.remove()">×</button>
  `;
    li._file = file; // on garde l’objet File
    fileList.appendChild(li);
  }

  function isFileAlreadyAdded(name) {
    return [...fileList.querySelectorAll('.file-list-item')].some(li => li.dataset.filename === name);
  }

  /* ====== Upload WordPress media (1er fichier) ====== */
  async function uploadFirstFileIfAny() {
    const li = fileList.querySelector('.file-list-item');
    if (!li || !li._file) return null;

    const fd = new FormData();
    fd.append('file', li._file, li._file.name);

    const resp = await fetch('/wp-json/wp/v2/media', {
      method: 'POST',
      headers: {
        'X-WP-Nonce': REST_NONCE
      },
      body: fd
    });
    if (!resp.ok) {
      const t = await resp.text();
      throw new Error('Upload échoué: ' + t);
    }
    const media = await resp.json();
    return media && media.source_url ? media.source_url : null;
  }

  /* ====== Soumission ====== */
  btnSubmit.addEventListener('click', async () => {
    hint.textContent = '';
    // validations simples
    if (!elType.value || !elDate.value || !elTitre.value.trim()) {
      hint.textContent = 'Veuillez renseigner le type, la date et le titre.';
      hint.className = 'mt-2 small text-danger';
      return;
    }

    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Envoi...';

    try {
      // 1) uploader un éventuel fichier et récupérer son URL
      let fichierUrl = null;
      try {
        fichierUrl = await uploadFirstFileIfAny();
      } catch (e) {
        console.warn(e);
      }

      // 2) payload pour l’API publication
      const payload = {
        date_publication: elDate.value,
        titre: elTitre.value.trim(),
        type: elType.value,
        resume: elResume.value,
        commentaire: elComm.value,

      };
      if (fichierUrl) payload.fichier_url = fichierUrl;

      // 3) POST vers /publication
      const resp = await fetch(API_BASE + '/publication', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': REST_NONCE
        },
        body: JSON.stringify(payload)
      });

      if (!resp.ok) {
        const err = await resp.text();
        throw new Error('Erreur API (' + resp.status + '): ' + err);
      }
      const created = await resp.json();

      // 4) OK
            // 4) OK
      hint.textContent = 'Publication créée (ID: ' + created.id + ').';
      hint.className = 'mt-2 small text-success';

      // Redirection automatique vers la page des publications
      setTimeout(() => {
        window.location.href = '/publication';  // adapte le slug/URL si besoin
      }, ); // petit délai pour voir le message avant la redirection

    } catch (e) {
      console.error(e);
      hint.textContent = e.message || 'Une erreur est survenue.';
      hint.className = 'mt-2 small text-danger';
    } finally {
      btnSubmit.disabled = false;
      btnSubmit.textContent = 'Soumettre ma demande';
    }
  });
</script>