<?php
/** * Template: Ajouter une publication – Directeur du labo
 * Pré-requis: 
 * - api-publication.php (routes REST /plateforme-recherche/v1/...)
 * - services_publication.php (logique métier)
 */
if (!defined('ABSPATH'))
  exit;

// Nonce REST + base namespace
$rest_nonce = wp_create_nonce('wp_rest');
$rest_base = rest_url('plateforme-recherche/v1/');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter une publication</title>

  <!-- Bootstrap 5 CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      crossorigin="anonymous"> -->

  <style>
    /* ========= Styles du formulaire (reprend exactement ta charte) ========= */
    body {
      background-color: #f0f0f0;
      font-family: 'Inter', sans-serif;
    }

    .form-container {
      background-color: #FAFAF8;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

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
      background-color: #ffffffff;
      box-shadow: 0px 8px 12px -9px #33333350;
      margin-bottom: 30px;
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

    /* Upload fichiers */
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
      font-size: 20px;
      padding: 10px;
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Boutons */
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

    /* Petit conteneur central */
    /* .page-wrap {
      max-width: 980px;
      margin: 24px auto;
      padding: 0 12px;
    } */
  </style>
</head>

<body>

  <div class="page-wrap">
    <div class="form-container">

      <!-- Header visuel -->
      <div class="bg">
        <h2>Informations générales</h2>
      </div>

      <!-- Form grid -->
      <div class="row g-3">
        <div class="col-md-6">
          <label for="publicationType" class="form-label">Type de publication :</label>
          <select class="form-select" id="publicationType">
            <option selected disabled value=""></option>
            <option>Article</option>
            <option>Rapport</option>
            <option>Présentation</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="submissionDate" class="form-label">Date de soumission :</label>
          <div class="input-group">
            <input type="date" class="form-control" id="submissionDate">
          </div>
        </div>
        <div class="col-12">
          <label for="completeTitle" class="form-label">Titre complet :</label>
          <input type="text" class="form-control" id="completeTitle">
        </div>
        <div class="col-12">
          <label for="summary" class="form-label">Résumé</label>
          <textarea class="form-control" id="summary" rows="4"></textarea>
        </div>
      </div>

      <!-- Documents associés -->
      <div class="bg">
        <h2 id="h2top">Documents associés</h2>
      </div>

      <label for="fileImport" class="form-label">Pièces jointes</label>
      <div class="file-import-section">
        <input type="text" readonly class="form-control" id="fileImport"
          placeholder="Cliquez pour ajouter des fichiers..." style="cursor: pointer;">
        <button class="btn btn-import" type="button" id="importButton">Importer</button>
        <input type="file" id="fileInput" multiple style="display:none;">
      </div>
      <ul class="file-list" id="fileList">
        <!-- Fichiers dynamiques -->
      </ul>

      <!-- Commentaire complémentaire -->
      <div class="bg">
        <h2 id="h2top">Commentaire complémentaire (optionnel)</h2>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Commentaire</label>
        <textarea class="form-control" id="comment" rows="3" placeholder="Commentaire..."></textarea>
      </div>

      <!-- Actions -->
      <div class="bg-reverse">
        <div class="form-actions">
          <button type="button" class="btn btn-draft">Enregistrer en brouillon</button>
          <button type="button" class="btn btn-submit">Soumettre ma demande</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>

  <script>
    /* ==========================================================
   Publications – Wiring JS ↔ API /plateforme-recherche/v1
   - Upload des pièces jointes (base64 -> WP Media)
   - Création de la publication (draft/pending)
   ========================================================== */
    (function () {
      const REST_BASE = "<?= esc_url($rest_base) ?>".replace(/\/$/, '');
      const NONCE = "<?= esc_js($rest_nonce) ?>";

      // Champs du formulaire
      const elType = document.getElementById('publicationType');
      const elDate = document.getElementById('submissionDate');
      const elTitle = document.getElementById('completeTitle');
      const elSummary = document.getElementById('summary');
      const elComment = document.getElementById('comment');

      // UI fichiers
      const importButton = document.getElementById('importButton');
      const fileInput = document.getElementById('fileInput');
      const fileList = document.getElementById('fileList');
      const fileImportText = document.getElementById('fileImport');

      // Boutons
      const btnDraft = document.querySelector('.btn-draft');
      const btnSubmit = document.querySelector('.btn-submit');

      // État
      const pendingFiles = []; // File objects en attente d'upload
      const uploaded = []; // {id,url,_tmpName}

      // --------- Helpers ---------
      async function api(path, {
        method = 'GET',
        data = null,
        headers = {},
        query = null
      } = {}) {
        const url = new URL(REST_BASE + path, window.location.origin);
        if (query) Object.entries(query).forEach(([k, v]) => (v !== undefined && v !== null && v !== '') &&
          url.searchParams.set(k, v));
        const opts = {
          method,
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': NONCE,
            ...headers
          },
          credentials: 'same-origin'
        };
        if (data) opts.body = JSON.stringify(data);
        const res = await fetch(url.toString(), opts);
        const txt = await res.text();
        let json;
        try {
          json = JSON.parse(txt);
        } catch {
          json = {
            raw: txt
          };
        }
        if (!res.ok) {
          const msg = json?.message || ('HTTP ' + res.status);
          throw Object.assign(new Error(msg), {
            status: res.status,
            detail: json
          });
        }
        return json;
      }
      const toBase64 = (file) => new Promise((resolve, reject) => {
        const r = new FileReader();
        r.onload = () => resolve(r.result);
        r.onerror = reject;
        r.readAsDataURL(file);
      });

      function addFileToUI(file) {
        const li = document.createElement('li');
        li.className = 'file-list-item';
        li.dataset.filename = file.name;
        li.innerHTML = `
      <img style="width:30px;" src="/wp-content/plugins/plateforme-master/imagesED/pdf-svgrepo-com (2).png" alt="fichier">
      <span>${file.name}</span>
      <button class="btn-remove-file" type="button" title="Retirer">
        <img style="width:10px;" src="/wp-content/plugins/plateforme-master/imagesED/.-blanc.png" alt="X">
      </button>
    `;
        li.querySelector('.btn-remove-file').addEventListener('click', () => {
          // retire de pending / uploaded si existant
          const i = pendingFiles.findIndex(f => f.name === file.name && f.size === file.size);
          if (i >= 0) pendingFiles.splice(i, 1);
          const j = uploaded.findIndex(x => x._tmpName === file.name);
          if (j >= 0) uploaded.splice(j, 1);
          li.remove();
        });
        fileList.appendChild(li);
      }

      // Déclenchement input[file]
      importButton.addEventListener('click', () => fileInput.click());
      fileImportText.addEventListener('click', () => fileInput.click());

      // Sélection fichiers
      fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files || []);
        for (const f of files) {
          // anti-doublon simple sur le nom
          if ([...fileList.querySelectorAll('.file-list-item')].some(li => li.dataset.filename === f
            .name)) continue;
          pendingFiles.push(f);
          addFileToUI(f);
        }
        fileInput.value = '';
      });

      async function uploadAllAttachments() {
        for (const f of pendingFiles) {
          if (uploaded.some(x => x._tmpName === f.name)) continue; // déjà uploadé
          const b64 = await toBase64(f);
          const res = await api('/publications/attachments', {
            method: 'POST',
            data: {
              file_name: f.name,
              mime_type: (f.type || 'application/octet-stream'),
              content: b64
            }
          });
          uploaded.push({
            id: res.attachment_id,
            url: res.url,
            _tmpName: f.name
          });
        }
        return uploaded.map(x => x.id);
      }

      async function createPublication(mode) { // mode: 'draft' | 'submit'
        // Validation
        const title = (elTitle.value || '').trim();
        if (!title) {
          alert('Le titre est requis.');
          return;
        }

        // 1) Upload PJ si besoin
        const attIds = await uploadAllAttachments();

        // 2) Payload
        const payload = {
          title: title,
          type: elType.value || '',
          submission_date: elDate.value || '',
          summary: elSummary.value || '',
          comment: elComment.value || '',
          status: (mode === 'submit') ? 'submit' : 'draft',
          attachment_ids: attIds
        };

        // 3) POST
        const res = await api('/publications', {
          method: 'POST',
          data: payload
        });
        // Feedback (tu peux remplacer par un toast)
        alert(mode === 'submit' ? 'Publication soumise avec succès.' : 'Brouillon enregistré.');
        // Optionnel: redirection vers la fiche
        // window.location.href = '/wp-admin/post.php?post=' + res.id + '&action=edit';
      }

      btnDraft?.addEventListener('click', async () => {
        try {
          btnDraft.disabled = true;
          await createPublication('draft');
        } catch (e) {
          console.error(e);
          alert(e.message || 'Erreur lors de l’enregistrement du brouillon');
        } finally {
          btnDraft.disabled = false;
        }
      });

      btnSubmit?.addEventListener('click', async () => {
        try {
          btnSubmit.disabled = true;
          await createPublication('submit');
        } catch (e) {
          console.error(e);
          alert(e.message || 'Erreur lors de la soumission');
        } finally {
          btnSubmit.disabled = false;
        }
      });

    })();
  </script>

</body>

</html>