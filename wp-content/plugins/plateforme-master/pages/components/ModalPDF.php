<div class="modal-overlay" id="modalPlan" style="display: none;">
  <div class="popup-container" id="popupPlanContainer">
    <div class="popup-header">
      <h2>Modifier le Plan d'étude</h2>
      <button class="btn-enregistrer" id="btnSavePlan">Enregistrer</button>
    </div>
    <form class="popup-form" id="pdfForm">
      <div class="input-file-wrapper">
          <input type="text" id="nomFichierpdf" class="input-file-text" placeholder="Pièce jointe" readonly style="margin-bottom: 0px;">
          <label for="pieceJointe" class="btn-importer">
            <i class="fas fa-upload"></i> Importer
          </label>
          <input type="file" id="pieceJointe" accept=".pdf" style="display: none;">
        </div>
        <div id="uploadStatus" style="margin-top: 10px; display: none;"></div>
    </form>
  </div>
</div>

<style>
  .input-file-wrapper {
  display: flex;
  align-items: center;
  border: 1px solid #e2e0d1;
  border-radius: 6px;
  overflow: hidden;
  width: 100%;
  background-color: white;
  margin-top: 10px;
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

.success-message {
  color: green;
  margin-top: 10px;
}

.error-message {
  color: red;
  margin-top: 10px;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const openBtn = document.querySelector(".btn_pdf");
  const modal = document.getElementById("modalPlan");
  const fileInput = document.getElementById("pieceJointe");
  const fileNameInput = document.getElementById("nomFichierpdf");
  const saveBtn = document.getElementById("btnSavePlan");
  const uploadStatus = document.getElementById("uploadStatus");

  if (openBtn && modal) {
    openBtn.addEventListener("click", function () {
      modal.style.display = "flex";
      // Reset form when opening
      fileInput.value = "";
      fileNameInput.value = "";
      uploadStatus.style.display = "none";
    });

    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  }

  // Update filename when file is selected
  fileInput.addEventListener("change", function () {
    if (this.files.length > 0) {
      const file = this.files[0];
      if (file.type !== "application/pdf") {
        showStatus("Seuls les fichiers PDF sont acceptés", "error");
        this.value = ""; // Clear the invalid file
        fileNameInput.value = "";
      } else {
        fileNameInput.value = file.name;
        uploadStatus.style.display = "none";
      }
    } else {
      fileNameInput.value = "";
    }
  });

  // Handle save button click
  saveBtn.addEventListener("click", function () {
    const file = fileInput.files[0];
    
    if (!file) {
      showStatus("Veuillez sélectionner un fichier PDF", "error");
      return;
    }

    if (file.type !== "application/pdf") {
      showStatus("Le fichier doit être au format PDF", "error");
      return;
    }

    uploadFile(file);
  });

  function showStatus(message, type) {
    uploadStatus.textContent = message;
    uploadStatus.className = type + "-message";
    uploadStatus.style.display = "block";
  }

  function uploadFile(file) {
    showStatus("Envoi en cours...", "success");
    
    // Get master ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const masterId = parseInt(urlParams.get("id"), 10);

    const formData = new FormData();
    formData.append("pdf", file);

    fetch(`/wp-json/plateforme-master/v1/plan-etude/${masterId}`, {
      method: "POST",
      headers: {
        "X-WP-Nonce": PMSettings.nonce
      },
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Erreur réseau");
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        showStatus("✅ Plan d'étude mis à jour !", "success");
        // Close modal after 2 seconds
        setTimeout(() => {
          modal.style.display = "none";
          // Optional: Update the displayed filename elsewhere
          if (typeof reloadMasterData === "function") {
            reloadMasterData();
          }
        }, 2000);
      } else {
        showStatus("❌ Erreur: " + (data.message || "Échec de l'envoi"), "error");
      }
    })
    .catch(error => {
      console.error("Erreur:", error);
      showStatus("❌ Erreur lors de l'envoi du fichier", "error");
    });
  }
});

// If you need to load existing PDF filename
function loadMasterIntoForm(master) {
  if (master && master.plan_etude_pdf) {
    document.getElementById("nomFichierpdf").value = master.plan_etude_pdf.split('/').pop();
  }
}
</script>