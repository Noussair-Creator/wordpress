<div id="form-confirm-popup" class="popup-overlay">
  <div class="popup-box">
    <div class="popup-header">Confirmation</div>
    <div class="popup-icon success-icon">✔</div>
    <div class="popup-message" id="form-confirm-message">
      Confirmez-vous les informations saisies ?
    </div>
    <div class="popup-buttons">
      <button id="cancel-confirm-popup" class="btn-cancel">Annuler</button>
      <button id="confirm-confirm-popup" class="btn-confirm">Confirmer</button>
    </div>
  </div>
</div>
<div id="form-confirm-popup-sended" class="popup-overlay">
  <div class="popup-box">
    <div class="popup-header">Confirmation</div>
    <div class="popup-icon success-icon">✔</div>
    <div class="popup-message" id="form-confirm-message">
     🎉 Votre candidature a été soumise avec succès !
    </div>
    <div class="popup-buttons">
      <button id="cancel-confirm-popup" class="btn-cancel">Annuler</button>
      <button id="confirm-confirm-popup-sended" class="btn-confirm"><a href="/historique-de-candidature/" style="text-decoration:none;color:white" >Consulter l'historique condidature</a></button>
    </div>
  </div>
</div>
<div id="form-error-popup" class="popup-overlay">
  <div class="popup-box">
    <div class="popup-header">Champs obligatoires</div>
    <div class="popup-icon error-icon">⚠</div>
    <div class="popup-message">
      Merci de compléter les champs suivants :
      <ul id="form-error-list" class="error-list"></ul>
    </div>
    <div class="popup-buttons">
      <button id="close-error-popup" class="btn-confirm">Fermer</button>
    </div>
  </div>
</div>


<style>
  .popup-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 10000;
}

.popup-box {
  background: #fff;
  width: 550px;
  border-radius: 10px;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
  overflow: hidden;
      height: fit-content;
}

.popup-header {
  background: #B30000;
  padding: 16px;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
}

.popup-icon {
  margin-top: 20px;
}

.popup-message {
  padding: 20px;
  font-size: 16px;
  color: #333;
}

.popup-buttons {
  display: flex;
  justify-content: space-around;
  padding: 20px;
  border-top: 1px solid #eee;
}

.btn-cancel {
  background: #A6A485;
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.btn-confirm {
  background: #B30000;
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.btn-cancel:hover,
.btn-confirm:hover {
  opacity: 0.9;
}

.popup-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

/* .popup-box {
  background: #fff;
  width: 440px;
  border-radius: 10px;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
  overflow: hidden;
      height: fit-content;
} */
.popup-box {
    background: #fff;
    width: fit-content;
    /* max-width: 617px; */
    border-radius: 10px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    height: fit-content;
}
.popup-header {
  background: #B30000;
  padding: 16px;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
}

.popup-icon {
  font-size: 40px;
  margin: 20px 0;
}

.success-icon {
  color: #28a745;
}

.error-icon {
  color: #b30000;
}

.popup-message {
  padding: 10px 25px;
  font-size: 16px;
  color: #333;
  max-height: 500px; /*eur max visible */
  overflow-y: auto;  /* 🔹 scroll si contenu déborde */
  scrollbar-width: thin;           /* 🔹 style scrollbar pour Firefox */
  scrollbar-color: #aaa transparent;
}
.popup-buttons {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding: 20px;
  border-top: 1px solid #eee;
}

.btn-cancel {
  background: #A6A485;
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.btn-confirm {
  background: #B30000;
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.error-list {
  text-align: left;
  padding-left: 30px;
  margin-top: 10px;
  font-size: 14px;
  color: #b30000;
}

.error-list {
  display: flex;
  flex-wrap: wrap;
  padding-left: 20px;
  margin: 15px auto 0;
    max-height: 250px;
  overflow-y: auto;
  list-style: disc;
  text-align: left;
  font-size: 14px;
  color: #B30000;
  column-gap: 10px;
}

.error-list li {
  width: 45%; /* chaque élément occupe un tiers */
  margin-bottom: 8px;
}


.popup-message::-webkit-scrollbar {
  width: 6px;
}
.popup-message::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 4px;
}

</style>
