<div id="entretienModal" class="entretien-modal">
  <div class="entretien-panel">
    <div class="entretien-header">
      <h2>Programmer un entretien</h2>
      <button class="entretien-btn" type="submit" form="entretienForm">Inviter</button>
    </div>

    <form id="entretienForm" class="entretien-body">
      <input type="hidden" name="candidature_id" id="inputCandidatureId">

      <label>Titre</label>
      <input type="text" name="titre" class="entretien-input" required>

      <label>Contenu</label>
      <textarea name="contenu" class="entretien-textarea" rows="8" required></textarea>

      <div class="entretien-date-row">
        <div>
          <label>Date</label>
          <input type="date" name="date" id="inputDateEntretien" class="entretien-input" required>
        </div>
        <div>
          <label>Heure</label>
          <input type="time" name="heure" class="entretien-input" required>
        </div>
      </div>

      <!-- Nouveau champ État -->
       <select name="etat" class="etat-select" required>
        <option value="prévu">Prévu</option>
        <option value="effectué">Effectué</option>
        <option value="annulé">Annulé</option>
      </select> 
    </form>
  </div>
</div>


<style>
.entretien-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw; /* couvre tout l'écran */
  height: 100vh;
  background: rgba(0, 0, 0, 0.2); /* fond gris cliquable */
  display: none;
  justify-content: flex-end; /* pousse le panel à droite */
  z-index: 10000;
}

.entretien-panel {
  width: 440px;
  height: 100%;
  background: white;
  display: flex;
  flex-direction: column;
  box-shadow: -4px 0 15px rgba(0, 0, 0, 0.2);
}


.entretien-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  padding: 16px 24px;
  border-bottom: 1px solid #eee;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  z-index: 1;
}

.entretien-header h2 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.entretien-btn {
  background-color: #c80000;
  color: white;
  border: none;
  padding: 8px 20px;
  font-weight: 500;
  border-radius: 5px;
  cursor: pointer;
}

.entretien-body {
  flex: 1;
  overflow-y: auto;
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.entretien-input, .entretien-textarea {
  border: 1px solid #dcdcdc;
  border-radius: 6px;
  padding: 8px 12px;
  font-size: 14px;
  width: 100%;
  box-sizing: border-box;
}

.entretien-date-row {
  display: flex;
  gap: 16px;
}

.entretien-date-row div {
  flex: 1;
}

label {
  font-weight: 600;
  display: block;
}
.etat-select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: #f9f9f9;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 10px 12px;
  font-size: 14px;
  width: 100%;
  box-sizing: border-box;
  background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23666'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 10px 6px;
  cursor: pointer;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
  margin-top: 8px;
}

.etat-select:focus {
  border-color: #c80000;
  box-shadow: 0 0 0 2px rgba(200, 0, 0, 0.15);
  outline: none;
}

</style>

<script>
  /*
function openEntretienModal(candidatureId) {
  document.getElementById('inputCandidatureId').value = candidatureId;
  document.getElementById('entretienModal').style.display = 'flex';
}*/

function openEntretienModal(candidatureId) {
  const modal = document.getElementById('entretienModal');
  const inputId = document.getElementById('inputCandidatureId');
  const titreInput = document.querySelector('[name="titre"]');
  const contenuTextarea = document.querySelector('[name="contenu"]');
  const dateInput = document.querySelector('[name="date"]');
  const heureInput = document.querySelector('[name="heure"]');

  // Réinitialiser
  inputId.value = candidatureId;
  titreInput.value = '';
  contenuTextarea.value = '';
  dateInput.value = '';
  heureInput.value = '';

  // Ouvrir le modal
  modal.style.display = 'flex';

  // Rechercher si entretien déjà envoyé
  fetch(`/wp-json/plateforme-master/v1/entretien/${candidatureId}`)
    .then(res => res.status === 204 ? null : res.json())
    .then(data => {
      if (data) {
        titreInput.value = data.titre || '';
        contenuTextarea.value = data.contenu || '';
        dateInput.value = data.date_entretien || '';
        heureInput.value = data.heure_entretien || '';
        document.querySelector('[name="etat"]').value = data.etat || 'prévu';

      }
    })
    .catch(err => {
      console.error("Erreur chargement entretien :", err);
    });
}


function closeEntretienModal() {
  document.getElementById('entretienModal').style.display = 'none';
}

function showToast(message) {
  alert(message); // à remplacer par une vraie toast stylée si besoin
}

document.addEventListener('DOMContentLoaded', () => {
  // ✅ Bloquer la sélection avant aujourd'hui
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('inputDateEntretien').setAttribute('min', today);

  // ✅ Form submission
  const form = document.getElementById('entretienForm');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (!confirm("Voulez-vous vraiment inviter ce candidat à l'entretien ?")) {
      return;
    }

    const formData = new FormData(form);
    const payload = {};

    formData.forEach((value, key) => {
      payload[key] = value;
    });

    // Validation facultative de l’état
    if (!['prévu', 'effectué', 'annulé'].includes(payload.etat)) {
      showToast("⚠️ État non valide.");
      return;
    }

    fetch('/wp-json/plateforme-master/v1/ajouter-entretien', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast("✅ Entretien enregistré avec succès !");
        closeEntretienModal();
        setTimeout(() => location.reload(), 1200);
      } else {
        showToast("❌ Échec lors de l'enregistrement.");
        console.warn("Détails:", data);
      }
    })
    .catch(err => {
      console.error("Erreur API :", err);
      showToast("❌ Erreur inattendue.");
    });
  });
});




document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('entretienModal');
  const panel = modal.querySelector('.entretien-panel');

  // Fermer si clic hors du panneau
  modal.addEventListener('click', function (e) {
    if (!panel.contains(e.target)) {
      closeEntretienModal();
    }
  });
});

openEntretienModal

</script>
