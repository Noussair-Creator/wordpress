<div id="evaluationModal" class="entretien-modal">
  <div class="entretien-panel">
    <div class="entretien-header">
      <h2>Traiter l’entretien</h2>
      <button class="entretien-btn" type="submit" form="evaluationForm">Enregistrer</button>
    </div>

    <form id="evaluationForm" class="entretien-body">
      <input type="hidden" name="candidature_id" id="evalCandidatureId">

      <label>Note</label>
      <input type="number" name="note" min="0" max="20" step="0.1" class="entretien-input" required>

      <label>Commentaire</label>
      <textarea name="commentaire" class="entretien-textarea" rows="6"></textarea>

       <select name="etat" class="etat-select" required>
        <option value="prévu">Prévu</option>
        <option value="effectué">Effectué</option>
        <option value="annulé">Annulé</option>
      </select> 
    </form>
  </div>
</div>

<script>
  function openEvaluationModal(candidatureId) {
  const modal = document.getElementById('evaluationModal');
  const inputId = document.getElementById('evalCandidatureId');
  const noteInput = document.querySelector('[name="note"]');
  const commentaireTextarea = document.querySelector('[name="commentaire"]');
  const etatSelect = document.querySelector('#evaluationModal [name="etat"]');

  // Reset
  inputId.value = candidatureId;
  noteInput.value = '';
  commentaireTextarea.value = '';
  etatSelect.value = 'effectué';

  // Ouvrir
  modal.style.display = 'flex';

  // Préremplir si déjà traité
  fetch(`/wp-json/plateforme-master/v1/entretien/${candidatureId}`)
    .then(res => res.status === 204 ? null : res.json())
    .then(data => {
      if (data) {
        noteInput.value = data.note ?? '';
        commentaireTextarea.value = data.commentaire ?? '';
        etatSelect.value = data.etat ?? 'effectué';
      }
    });
}
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('evaluationModal');
  const panel = modal.querySelector('.entretien-panel');

  modal.addEventListener('click', function (e) {
    if (!panel.contains(e.target)) {
      closeEvaluationModal();
    }
  });
});
function closeEvaluationModal() {
  document.getElementById('evaluationModal').style.display = 'none';
}

const evaluationForm = document.getElementById('evaluationForm');

evaluationForm.addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(evaluationForm);
  const payload = {};
  formData.forEach((value, key) => {
    payload[key] = value;
  });
  payload['type'] = 'evaluation';
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
      showToast("✅ Évaluation enregistrée avec succès.");
      closeEvaluationModal();
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast("❌ Erreur lors de la sauvegarde.");
      console.warn("Erreur :", data.mysql_error || data);
    }
  })
  .catch(err => {
    console.error("Erreur API :", err);
    showToast("❌ Erreur inattendue.");
  });
});

</script>