<div class="modal-overlay" id="modalAdmission" style="display: none;">
  <div class="popup-container" id="popupAdmissionContainer">
    <div class="popup-header">
      <h2>Condition d'admission <span id="cycleLabel"></span></h2>
      <button class="btn-enregistrer" id="btnSaveAdmission">Enregistrer</button>
    </div>
    <form class="popup-form">

      <textarea id="inputDiplomes" placeholder="Diplômes requis"></textarea>
      <textarea id="inputProcedure" placeholder="Procédure de sélection"></textarea>
      <input type="number" id="inputPlaces" placeholder="Places disponibles">
      <textarea id="inputCriteres" placeholder="Critères"></textarea>
      <textarea id="inputPublic" placeholder="Public visé"></textarea>

    </form>
 
  </div>
</div>

<style>
  #modalAdmission .popup-container {
    background-color: white;
    width: 420px;
    height: 100%;
    padding: 20px 0px;
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    padding-top: 0px;
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 25px 10px;
  box-shadow: 0px 5px 16px #00000029;
}

.popup-header h2 {
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

form.popup-form {
  padding: 20px 25px;
}

.popup-form textarea,
.popup-form input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #b5af8e;
  border-radius: 7px;
  font-size: 14px;
  resize: vertical;
  min-height: 50px;
}

</style>
<script>
  /*
  // Ouvrir le modal
  document.addEventListener("DOMContentLoaded", function () {
    const openBtn = document.querySelector("img.openmodalConditions");
    const modal = document.getElementById("modalAdmission");

    if (openBtn && modal) {
      openBtn.addEventListener("click", function () {
        modal.style.display = "flex";
      });

      // Fermer le modal si on clique à l'extérieur du container
      modal.addEventListener("click", function (e) {
        if (e.target === modal) {
          modal.style.display = "none";
        }
      });
    }
  });


  // Fermer le modal en cliquant à l'extérieur
  document.getElementById("modalAdmission").addEventListener("click", function (e) {
    if (e.target === this) {
      this.style.display = "none";
    }
  });
  */


  




function showAdmissionModal(cycle) {
  const modal = document.getElementById("modalAdmission");
  const cycleLabel = document.getElementById("cycleLabel");

  // Afficher le cycle dans le titre
  if (cycleLabel) {
    cycleLabel.textContent = `(${cycle})`;
  }

  // Préremplir les champs si bloc existe
  const blockId = `conditions-${cycle}`;
  const conditionsBlock = document.getElementById(blockId);



  // Afficher le modal
  modal.style.display = "flex";

  // Fermer si clic en dehors
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
}






function loadAdmissionForm(master, cycle) {

  const admission = master.admission?.[cycle] ?? {};

  document.getElementById("inputDiplomes").value = admission.diplomes_requis ?? '';
  document.getElementById("inputProcedure").value = admission.procedure_selection ?? '';
  document.getElementById("inputPlaces").value = admission.nb_places ?? '';
  document.getElementById("inputCriteres").value = admission.criteres_admission ?? '';
  document.getElementById("inputPublic").value = admission.public_vise ?? '';

}





document.getElementById("btnSaveAdmission").addEventListener("click", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const masterId = parseInt(urlParams.get("id"), 10);

  if (!masterId) {
    alert("ID du master introuvable dans l’URL.");
    return;
  }

  const cycleLabel = document.getElementById("cycleLabel");
  const currentCycle = cycleLabel.textContent.replace(/[()]/g, '').trim(); 

  const diplomes = document.getElementById("inputDiplomes").value;
  const procedure = document.getElementById("inputProcedure").value;
  const places = document.getElementById("inputPlaces").value;
  const criteres = document.getElementById("inputCriteres").value;
  const publicVise = document.getElementById("inputPublic").value;

  fetch(`/wp-json/plateforme-master/v1/conditions/${masterId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": PMSettings.nonce
    },
    body: JSON.stringify({
      diplomes_requis: diplomes,
      procedure_selection: procedure,
      nb_places: parseInt(places),
      criteres_admission: criteres,
      public_vise: publicVise,
      currentCycle : currentCycle
    })
  })
  .then(res => res.json())
  .then(res => {
    if (res.success) {
      alert("✅ Conditions mises à jour !");
      document.getElementById("modalAdmission").style.display = "none"; // Si modal
      reloadMasterData(); // Rechargement automatique si défini
    } else {
      alert("❌ Échec de la mise à jour.");
      console.error(res);
    }
  })
  .catch(err => {
    console.error("Erreur API :", err);
    alert("❌ Erreur serveur.");
  });
});



</script>