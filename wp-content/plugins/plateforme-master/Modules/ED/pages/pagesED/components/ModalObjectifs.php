<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="modal-overlay" id="modalObjectifs" style="display: none;">
  <div class="popup-container" id="popupContainerObjectifs">
    <div class="popup-header">
      <h2>Objectifs Du Master</h2>
      <button class="btn-enregistrer" id="btnSaveObjectifs">Enregistrer</button>
    </div>
    <form class="popup-form">

      <div class="editor-wrapper">
        <h2 style="margin-bottom: 15px;
    margin-top: 15px;
    color: #2A2916;">Objectifs spécifiques :</h2>

        <div id="objectifSpecifique" style="height: 150px;"></div>
      </div>
      <div class="editor-wrapper">
      <h2 style="margin-bottom: 15px;
    margin-top: 15px;
    color: #2A2916;">Objectifs généraux du master :</h2>
      <div id="objectifGeneral" style="height: 150px;"></div>
      </div>
    </form>
  </div>
</div>

<style>
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
</style>

<script>
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

  // Fermeture modal si clic dehors
  document.getElementById("modalObjectifs").addEventListener("click", function (e) {
    const popup = document.getElementById("popupContainerObjectifs");
    if (!popup.contains(e.target)) {
      this.style.display = "none";
    }
  });


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
    placeholder: 'Décrire les objectifs spécifiques...',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        ['link'],
        [{ 'list': 'bullet' }]
      ]
    }
  });

  // ✅ Objectifs généraux
  quillGeneral = new Quill('#objectifGeneral', {
    theme: 'snow',
    placeholder: 'Lister les objectifs généraux...',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        ['link'],
        [{ 'list': 'bullet' }]
      ]
    }
  });
});


function loadMasterIntoForm2(master) {
  // ✅ Objectifs spécifiques
  if (typeof quillSpecifique !== 'undefined' && quillSpecifique) {
    if (Array.isArray(master.objectifs_specifiques)) {
      // Convertir tableau en HTML <ul><li>...</li></ul>
      const html = '<ul>' + master.objectifs_specifiques.map(obj => `<li>${obj}</li>`).join('') + '</ul>';
      quillSpecifique.root.innerHTML = html;
    } else {
      // fallback si c’est déjà un string HTML
      quillSpecifique.root.innerHTML = master.objectifs_specifiques ?? '';
    }
  }

  // ✅ Objectifs généraux
  if (typeof quillGeneral !== 'undefined' && quillGeneral) {
    if (Array.isArray(master.objectifs_generaux)) {
      const html = '<ul>' + master.objectifs_generaux.map(obj => `<li>${obj}</li>`).join('') + '</ul>';
      quillGeneral.root.innerHTML = html;
    } else {
      quillGeneral.root.innerHTML = master.objectifs_generaux ?? '';
    }
  }
}




// Fonction pour nettoyer les balises HTML de l'objectif spécifique
function getTextFromHTML(html) {
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = html || '';
  return tempDiv.textContent.trim();
}

document.getElementById("btnSaveObjectifs").addEventListener("click", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const masterId = parseInt(urlParams.get("id"), 10);

  if (!masterId) {
    alert("ID du master non trouvé dans l’URL.");
    return;
  }

  const specifiqueText = quillSpecifique?.getText()?.trim() ?? '';
  const generauxText = quillGeneral?.getText()?.trim() ?? '';

  fetch(`/wp-json/plateforme-master/v1/objectifs/${masterId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": PMSettings.nonce
    },
    body: JSON.stringify({
      specifique: specifiqueText,
      generaux: generauxText.split('\n').filter(line => line.trim() !== '')
    })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("✅ Objectifs mis à jour !");
        document.getElementById("modalObjectifs").style.display = "none";
        reloadMasterData();
      } else {
        alert("❌ Erreur lors de la mise à jour des objectifs.");
        console.error("Réponse API :", data);
      }
    })
    .catch(err => {
      console.error("Erreur API :", err);
      alert("❌ Erreur réseau ou serveur.");
    });
});







</script>
