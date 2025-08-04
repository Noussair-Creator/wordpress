<div class="modal-overlay" id="modalOverlay" style="display: none;">
  <div class="popup-container" id="popupContainer">
    <div class="popup-header">
      <h2>Informations Détaillées</h2>
      <button class="btn-enregistrer" id="btnSaveMaster">Enregistrer</button>
    </div>
    <form class="popup-form" id="formAddMaster" enctype="multipart/form-data">


       <h2 style="margin-bottom: 17px;">Informations générales</h2>
      <input type="text" placeholder="Intitulé du mastère" id="inputIntitule" required>
      <input type="text" placeholder="Code interne du mastère" id="inputCode" required>
      <select id="inputNature">
        <option value="">Sélectionner une nature</option>
      </select>
      <input type="text" placeholder="Parcours" id="inputParcours">
      <input type="text" placeholder="Domaine" id="inputDomaine">
     
      <input type="text" placeholder="Langue(s) d’enseignement" id="inputLangue">
      <input type="number" placeholder="Capacité d’accueil" id="inputCapacite">

      <div class="input-file-wrapper">
        <input type="text" id="nomFichier" class="input-file-text" placeholder="Pièce jointe" readonly style="margin-bottom: 0px;" />
        <label for="pieceJointe" class="btn-importer">
          <i class="fas fa-upload"></i> Importer
        </label>
        <input type="file" id="pieceJointe" style="display: none;" />
      </div>
    </form>
  </div>
</div>



  <style>


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
  font-size: 18px;
  margin: 0;
  color: #333;
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
input:invalid, select:invalid {
  border-color: red;
}


  </style>


<script>




// Fermer le popup si on clique en dehors
document.getElementById("modalOverlay").addEventListener("click", function (e) {
  const popup = document.getElementById("popupContainer");
  if (!popup.contains(e.target)) {
    this.style.display = "none";
  }
});



document.getElementById("pieceJointe").addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    alert("Fichier sélectionné : " + file.name);
  }
});


/*
document.getElementById("pieceJointe").addEventListener("change", function () {
    const fileName = this.files.length > 0 ? this.files[0].name : "Aucun fichier sélectionné";
    document.getElementById("fileName").textContent = fileName;
  });
  */
  document.getElementById("pieceJointe").addEventListener("change", function () {
  const fileName = this.files[0]?.name || "Pièce jointe";
  document.getElementById("nomFichier").value = fileName;
});

document.getElementById("add-master-btn").addEventListener("click", function () {
  document.getElementById("modalOverlay").style.display = "flex";
});



document.getElementById("btnSaveMaster").addEventListener("click", function () {
  const formData = new FormData();
  formData.append("intitule", document.getElementById("inputIntitule").value);
  formData.append("code", document.getElementById("inputCode").value);
  formData.append("nature_id", document.getElementById("inputNature").value);
  formData.append("parcours", document.getElementById("inputParcours").value);
  formData.append("domaine", document.getElementById("inputDomaine").value);
  formData.append("langue", document.getElementById("inputLangue").value);
  formData.append("capacite", document.getElementById("inputCapacite").value);

  const file = document.getElementById("pieceJointe").files[0];
  if (file) {
    formData.append("plan_etude_pdf", file);
  }

const intitule = document.getElementById("inputIntitule").value.trim();
const code = document.getElementById("inputCode").value.trim();
const nature = document.getElementById("inputNature").value;

if (!intitule || !code || !nature ) {
  alert("Veuillez remplir tous les champs obligatoires.");
  return;
}


fetch(`/wp-json/plateforme-master/v1/masters`, {
  method: "POST",
  headers: {
    'X-WP-Nonce': PMSettings.nonce
  },
  body: formData
})
.then(res => res.json())
.then(response => {
  if (response.success) {
    alert("✅ Master ajouté avec succès !");
    document.getElementById("modalOverlay").style.display = "none";
    //rafraichirCarrouselMasters();
    location.reload(); // recharge la table si besoin

  } else {
    alert("❌ Erreur lors de l’ajout.");
    console.error("Réponse API :", response);
  }
})
.catch(err => {
  console.error("Erreur API :", err);
});

});
document.addEventListener('DOMContentLoaded', () => {
  fetch('/wp-json/plateforme-master/v1/natures')
    .then(res => res.json())
    .then(data => {
      const select = document.getElementById('inputNature');
      data.forEach(nature => {
        const option = document.createElement('option');
        option.value = nature.id;
        option.textContent = nature.libelle;
        select.appendChild(option);
      });
    });
});

</script>