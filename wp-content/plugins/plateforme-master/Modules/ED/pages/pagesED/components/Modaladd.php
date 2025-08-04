<div class="modal-overlay" id="modalOverlay" style="display: none;">
  <div class="popup-container" id="popupContainer">
    <div class="popup-header">
      <h2>Informations Détaillées</h2>
      <button class="btn-enregistrer" id="btnSaveMaster">Enregistrer</button>
    </div>
    <form class="popup-form">


      <label for="">Intitulé du mastère</label>
      <input type="text" placeholder="Intitulé du mastère" id="inputIntitule">
      <label for="">Code interne du mastère</label>
      <input type="text" placeholder="Code interne du mastère" id="inputCode">
      <label for="">Parcours</label>
      <input type="text" placeholder="Parcours" id="inputParcours">
      <label for="">Domaine</label>
      <input type="text" placeholder="Domaine" id="inputDomaine">
      <!--<input type="date" placeholder="Début d’habilitation" id="inputDebut">
      <input type="date" placeholder="Fin d’habilitation" id="inputFin">-->
      <label for="">Début d’habilitation</label>
      <select name="debut_annee_habilitation" id="debut_annee_habilitation"></select>
      <label for="">Fin d’habilitation</label>
      <select name="fin_annee_habilitation" id="fin_annee_habilitation"></select>
      <label for="">Langue(s) d’enseignement"</label>
      <input type="text" placeholder="Langue(s) d’enseignement" id="inputLangue">


      <!--
      <div class="input-file-wrapper">
        <input type="text" id="nomFichier" class="input-file-text" placeholder="Pièce jointe" readonly style="margin-bottom: 0px;" />
        <label for="pieceJointe" class="btn-importer">
          <i class="fas fa-upload"></i> Importer
        </label>
        <input type="file" id="pieceJointe" style="display: none;" />
      </div>-->


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

.modal-overlay label {
    min-width: 180px;
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
    margin-bottom: 7px;
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


/*
document.getElementById("pieceJointe").addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    alert("Fichier sélectionné : " + file.name);
  }
});
*/

// Charger les données d’un master pour modification
function loadMasterGeneralForm(master) {

    document.getElementById("inputIntitule").value = master.intitule_master ?? '';
    document.getElementById("inputCode").value = master.code_interne ?? '';
    document.getElementById("inputParcours").value = master.parcours ?? '';
    document.getElementById("inputDomaine").value = master.domaine ?? '';
   /* document.getElementById("inputDebut").value = master.debut_habilitation ?? '';
    document.getElementById("inputFin").value = master.fin_habilitation ?? '';*/
    document.getElementById("inputLangue").value = master.langue ?? '';
}
/*
document.getElementById("pieceJointe").addEventListener("change", function () {
    const fileName = this.files.length > 0 ? this.files[0].name : "Aucun fichier sélectionné";
    document.getElementById("fileName").textContent = fileName;
  });
  */
 
/*
  document.getElementById("pieceJointe").addEventListener("change", function () {
      const fileName = this.files[0]?.name || "Pièce jointe";
      document.getElementById("nomFichier").value = fileName;
    });
  */




document.getElementById("btnSaveMaster").addEventListener("click", function () {

  console.log("master test");
  const urlParams = new URLSearchParams(window.location.search);
  const masterId = parseInt(urlParams.get("id"));

  const payload = {
    intitule: document.getElementById("inputIntitule").value,
    code: document.getElementById("inputCode").value,
    parcours: document.getElementById("inputParcours").value,
    domaine: document.getElementById("inputDomaine").value,

   langue: document.getElementById("inputLangue").value,
    debut_annee_habilitation: document.getElementById("debut_annee_habilitation").value,
    fin_annee_habilitation: document.getElementById("fin_annee_habilitation").value
  };


  fetch(`/wp-json/plateforme-master/v1/masters/${masterId}`, {
    method: "PUT",
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings.nonce
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(response => {
    if (response.success) {
      alert("Mise à jour réussie.");
      document.getElementById("modalOverlay").style.display = "none";
      reloadMasterData(); // ⬅️ recharge la fiche après MAJ
    } else {
      alert("Erreur lors de la mise à jour.");
    }
  })
  .catch(err => {
    console.error("Erreur API :", err);
    alert("Erreur réseau ou serveur.");
  });
});


/*
function chargerAnneesUniversitaires(master) {



    debut_annee_habilitation = master.debut_annee_habilitation;
    fin_annee_habilitation = master.fin_annee_habilitation;

    
   const annee_actuel= document.getElementById('annee_actuel');


    const selectDebut = document.getElementById('debut_annee_habilitation');
    const selectFin = document.getElementById('fin_annee_habilitation');

    if (!selectDebut || !selectFin) return;

    // Ajouter l'option par défaut
    const defaultOptionDebut = new Option('-- Sélectionner début habilitation --', '');
    const defaultOptionFin = new Option('-- Sélectionner fin habilitation --', '');
    selectDebut.appendChild(defaultOptionDebut);
    selectFin.appendChild(defaultOptionFin);

    fetch('/wp-json/plateforme-master/v1/sessions-universitaires', {
        headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status !== 'success') {
            console.error('Erreur : chargement des sessions échoué');
            return;
        }

        const sessions = data.data;

        sessions.forEach(session => {
            const optionDebut = new Option(session.intitule, session.id);
            const optionFin = new Option(session.intitule, session.id);
            selectDebut.appendChild(optionDebut);
            selectFin.appendChild(optionFin);
        });
    /*
        // Pré-sélectionner automatiquement l'année active si besoin
        const activeSession = sessions.find(s => s.est_active == 1);
        if (activeSession) {
            selectDebut.value = activeSession.id;
            selectFin.value = activeSession.id;
        }

        */
       /*

        // master.debut_annee_habilitation et master.fin_annee_habilitation doivent contenir l'ID (valeur du <option>)
        if (master.debut_annee_habilitation !== null && master.debut_annee_habilitation !== '') {
            const debutSelect = document.getElementById('debut_annee_habilitation');
            if (debutSelect) debutSelect.value = master.debut_annee_habilitation;
        }

        if (master.fin_annee_habilitation !== null && master.fin_annee_habilitation !== '') {
            const finSelect = document.getElementById('fin_annee_habilitation');
            if (finSelect) finSelect.value = master.fin_annee_habilitation;
        }


    })
    .catch(error => {
        console.error('Erreur réseau :', error);
    });
}
*/
/*
  document.addEventListener('DOMContentLoaded', function () {
      chargerAnneesUniversitaires();
    });
*/

function chargerAnneesUniversitaires(master) {
    const selectDebut = document.getElementById('debut_annee_habilitation');
    const selectFin = document.getElementById('fin_annee_habilitation');
    const selectActuel = document.getElementById('annee_actuel');


    console.log(master);

    if (!selectDebut || !selectFin || !selectActuel) return;

    // Ajouter les options par défaut
    selectDebut.appendChild(new Option('-- Sélectionner début habilitation --', ''));
    selectFin.appendChild(new Option('-- Sélectionner fin habilitation --', ''));
    selectActuel.appendChild(new Option('-- Sélectionner année actuelle --', ''));

    fetch('/wp-json/plateforme-master/v1/sessions-universitaires', {
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': PMSettings.nonce
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status !== 'success') {
            console.error('Erreur : chargement des sessions échoué');
            return;
        }

        const sessions = data.data;

        sessions.forEach(session => {
            const option = new Option(session.intitule, session.id);
            selectDebut.appendChild(option.cloneNode(true));
            selectFin.appendChild(option.cloneNode(true));
            selectActuel.appendChild(option);
        });

        // Pré-sélection de l'année active
        const activeSession = sessions.find(s => s.est_active == 1);
        if (activeSession) {
            selectActuel.value = activeSession.id;
        }

        // Pré-sélection à partir du master fourni
        if (master?.debut_annee_habilitation_id) {
            selectDebut.value = master.debut_annee_habilitation_id;
        }

        if (master?.fin_annee_habilitation_id) {
            selectFin.value = master.fin_annee_habilitation_id;
        }
    })
    .catch(error => {
        console.error('Erreur réseau :', error);
    });
}

/*
document.getElementById("pieceJointe").addEventListener("change", function () {
    const fileName = this.files.length > 0 ? this.files[0].name : "Aucun fichier sélectionné";
    document.getElementById("fileName").textContent = fileName;
  });

  */
  
</script>