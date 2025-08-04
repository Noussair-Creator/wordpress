<div class="bloc-creation-appel">


  <div class="header-bar">
    <h3>
       Crée l’appel à candidature
    </h3>

  </div>
  <hr class="section-divider">

 <input type="text" placeholder="Titre" class="titre-input" name="titre" />

  <!-- Description avec Quill -->
  <div class="description-editor">
    <div id="quill-toolbar"></div>
    <div id="quill-editor" class="quill-editor"></div>
  </div>

  <!-- Pièce jointe -->
  <div class="file-upload-group">
    <input type="file" id="pj" class="file-input" name="file" />
    <button type="button" class="btn-upload" id="btnTriggerUpload">
      <i class="fa fa-upload"></i> Importer
    </button>
  </div>



  <!-- Sessions dynamiques -->
  <div id="sessions-container">
    <div class="session-fields">
      <input type="text" name="session" placeholder="Nom de la session"  class="session">
      <input type="date" placeholder="Date De Creation" name="date_debut">
      <input type="date" placeholder="Date De Cloture" name="date_fin">
    </div>

    <button class="btn-add-session" id="addSessionBtn">
      <i class="fa fa-plus-circle"></i> Ajouter une session
    </button>
  </div>

  <hr style="margin-top:40px; margin-bottom:40px;" class="section-divider">

  <?php include 'LISTMasterAppel.php'; ?>

  

</div>
<style>
  /* Conteneur principal */
.bloc-creation-appel {
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 5px rgba(0,0,0,0.05);
}

/* Titre */
.section-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 15px;
  color: #444;
}

/* Input titre */
.titre-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-bottom: 15px;
  font-size: 15px;
}

/* Liste des objectifs */
.objectif-list {
  list-style: none;
  padding: 0;
  margin-bottom: 15px;
}

.objectif-list li {
  margin-bottom: 8px;
  font-size: 14px;
  color: #222;
}

/* Editeur Quill */
.quill-editor {
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 6px;
  min-height: 120px;
  max-height: 200px;
  overflow-y: auto;
  margin-bottom: 15px;
}

.ql-toolbar.ql-snow {
  border: 1px solid #DBD9C3;
  box-sizing: border-box;
  font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
  padding: 8px;
  border-radius: 6px 6px 0 0;
  background-color: #ecebe3;
}

.ql-container.ql-snow {
  border-radius: 0 0 6px 6px;
}

/* Bloc pièce jointe */
.upload-section {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

/* Style fichier personnalisé */
.custom-file-upload {
  display: flex;
  border: 1px solid #e0ddcb;
  border-radius: 6px;
  overflow: hidden;
  height: 42px;
  align-items: center;
}

.file-label {
  display: none;
}

.file-input {
  flex: 1;
  padding: 10px;
  border: none;
  font-size: 14px;
  color: #888;
  background-color: #fff;
}

.file-input::file-selector-button {
  display: none;
}

/* Bouton importer */
.btn-importer {
  background-color: #999870;
  color: #fff;
  border: none;
  padding: 0 15px;
  height: 100%;
  font-weight: 600;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 5px;
  cursor: pointer;
}

/* Sessions */
.session-fields {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 6px;
}

.session-fields select,
.session-fields input[type="date"] {
  padding: 7px 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  flex: 1;
}

/* Bouton ajout de session */
.btn-add-session {
  background: none;
  border: none;
  color: #c52026;
  font-weight: bold;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 10px;
  cursor: pointer;
}
.file-upload-group {
  display: flex;
  border: 1px solid #e0ddcb;
  border-radius: 6px;
  overflow: hidden;
  height: 42px;
  align-items: center;
  background-color: #fff;
  margin-bottom: 15px;
}

.file-input {
  flex: 1;
  padding: 10px 14px;
  font-size: 14px;
  color: #888;
  border: none;
  background-color: transparent;
  outline: none;
  cursor: pointer;
}

.file-input::file-selector-button {
  display: none;
}

.btn-upload {
  background-color: #999870;
  color: #fff;
  border: none;
  padding: 0 15px;
  height: 100%;
  font-weight: 600;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
}
.description-editor {
    margin-bottom: 15px;
}
div#sessions-container {
    border: 1px solid #ddd;
    border: 1px solid #A6A485;
    border-radius: 5px;
    background-color: #fff;
    padding: 10px;
}
input.session {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    width: 30%;
}
</style>

<script>




let sessionIndex = 0;

document.getElementById('addSessionBtn').addEventListener('click', () => {
  const container = document.getElementById('sessions-container');
  const newRow = document.createElement('div');
  newRow.className = 'session-fields';

  newRow.innerHTML = `
    <input type="text" name="session[${sessionIndex}]" placeholder="Nom de la session"  class="session">
    <input type="date" name="date_debut[${sessionIndex}]" placeholder="Date de création">
    <input type="date" name="date_fin[${sessionIndex}]" placeholder="Date de clôture">
  `;

  container.appendChild(newRow);
  sessionIndex++;
});

</script>
<!-- Quill (déjà inclus dans ta question) -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Ajouter la description...',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }]
      ]
    }
  });


  
  document.getElementById('btnTriggerUpload').addEventListener('click', () => {
    document.getElementById('pj').click();
  });


  



</script>


<script>
  
function getAppelCandidatureData() {
  // 📌 Champs principaux appel à candidature
  const titre = document.querySelector('input[name="titre"]')?.value.trim() || '';
  const description = document.querySelector('#quill-editor .ql-editor')?.innerHTML.trim() || '';
  const fichierInput = document.querySelector('input[type="file"]');
  const fichier_joint = fichierInput?.files?.[0] || null;
  const user_id = PMSettings.user_id || null;
  const date_creation = new Date().toISOString().slice(0, 19).replace("T", " ");

  // 📌 Sessions ajoutées dynamiquement
  const sessions = [];
  document.querySelectorAll('.session-fields').forEach(sessionDiv => {
    const nom = sessionDiv.querySelector('input[name="session"]')?.value.trim();
    const debut = sessionDiv.querySelector('input[name="date_debut"]')?.value;
    const fin = sessionDiv.querySelector('input[name="date_fin"]')?.value;

    if (nom && debut && fin) {
      sessions.push({
        nom_session: nom,
        date_debut: debut,
        date_fin: fin
      });
    }
  });

  // 📌 Récupération des IDs de masters cochés
  const master_ids = [];

  document.querySelectorAll('#candidaturesTable tbody input[type="checkbox"]:checked').forEach(cb => {
    const row = cb.closest('tr');
    const scoreCol = row?.querySelector('.score-col');

    if (scoreCol) {
      const masterId = scoreCol.getAttribute('data-master-id');
      if (masterId) {
        master_ids.push(masterId);
      }
    }
  });


  // ✅ Données à envoyer
  return {
    titre,
    description,
    fichier_joint,
    date_creation,
    user_id,
    sessions,
    master_ids
  };
}

function validateAppelForm(data) {
  console.log(data);
  // Vérifie le titre
  if (!data.titre || data.titre.trim() === "") {
    alert("❌ Le titre est obligatoire.");
    return false;
  }

  // Vérifie la description
  if (!data.description || data.description.trim() === "") {
    alert("❌ La description est obligatoire.");
    return false;
  }

  // Vérifie au moins une session avec nom + date début + date fin
  if (!Array.isArray(data.sessions) || data.sessions.length === 0) {
    alert("❌ Veuillez ajouter au moins une session.");
    return false;
  }

  const hasValidSession = data.sessions.some(session => {
    return session.nom_session && session.date_debut && session.date_fin;
  });

  if (!hasValidSession) {
    alert("❌ Au moins une session doit contenir un nom, une date de début et une date de fin.");
    return false;
  }

  // Vérifie la sélection d'au moins un master
  if (!Array.isArray(data.master_ids) || data.master_ids.length === 0) {
    alert("❌ Veuillez sélectionner au moins un master.");
    return false;
  }

  // ✅ Tous les champs sont valides
  return true;
}

//

document.querySelector('#btnLancerAppel')?.addEventListener('click', async () => {
  const data = getAppelCandidatureData();

  if (!validateAppelForm(data)) return;

  const formData = new FormData();
  formData.append('titre', data.titre);
  formData.append('description', data.description);
  formData.append('date_creation', data.date_creation);
  formData.append('user_id', data.user_id);
  formData.append('fichier_joint', data.fichier_joint); // Peut être null
  formData.append('sessions', JSON.stringify(data.sessions)); // liste des sessions
  formData.append('master_ids', JSON.stringify(data.master_ids)); // tableau de master_id

  try {
    const response = await fetch('/wp-json/plateforme-master/v1/creer-appel', {
        method: 'POST',
        headers: {
          'X-WP-Nonce': PMSettings.nonce
        },
        body: formData
      });

    const result = await response.json();

    if (response.ok && result.success) {
      alert('✅ Appel à candidature créé avec succès !');
       window.location.href = '/appel-a-candidature/';

      // Optionnel : redirection ou reset du formulaire
    } else {
      console.error("Erreur serveur :", result);
      alert('❌ Échec de la création : ' + (result.message || 'erreur inconnue.'));
    }
  } catch (error) {
    console.error("Erreur réseau :", error);
    alert('❌ Problème de connexion ou erreur serveur.');
  }
});
</script>