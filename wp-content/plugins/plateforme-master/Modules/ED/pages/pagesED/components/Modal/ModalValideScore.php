<!-- Modal -->
<div class="score-modal-overlay" id="scoreModal" style="display: none;">
  <div class="score-modal-box narrow">
    <div class="score-modal-header">
      <h4>Confirmer la formule de calcul de score</h4>
    </div>
    <div class="score-modal-content score-line">
      <span class="score-label">Score total =</span>
      <span class="score-formule" id="score-formule"></span>
    </div>
    <div class="score-modal-footer">
      <button class="btn-red" id="confirmBtn">Confirmer</button>
    </div>
  </div>
</div>



<style>
 .score-modal-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.score-modal-box.narrow {
  background-color: white;
  border-radius: 8px;
  width: 700px;
  max-width: 90%;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  animation: fadeIn 0.3s ease-in-out;
}

.score-modal-header {
    padding: 16px;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0px 3px 21px #00000029;
}

.score-modal-content.score-line {
  display: flex;
  align-items: center;
  padding: 24px;
  gap: 12px;
  font-size: 16px;
}

.score-label {
    font-weight: 600;
    color: #444;
    width: 208px;
}

.score-formule {
  color: #444;
  font-weight: normal;
}

.score-modal-footer {
  padding: 12px 24px;
  display: flex;
  justify-content: flex-end;
  border-top: 1px solid #eee;
}

.btn-red {
  background-color: #c80000;
  color: white;
  border: none;
  padding: 8px 20px;
  font-weight: 500;
  border-radius: 5px;
  cursor: pointer;
}

</style>

<script>
document.getElementById('confirmBtn').addEventListener('click', () => {
  const modal = document.getElementById('scoreModal');
  const activeCell = document.querySelector('.score-col.active'); // ligne cliquée

  if (!activeCell) return alert("Erreur : master non détecté.");

  const masterId = activeCell.dataset.masterId;
  const niveau = activeCell.dataset.niveau || 'M1';

  fetch(PMSettings.apiUrlvaliderScore, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings.nonce
    },
    body: JSON.stringify({ master_id: masterId, niveau })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("✅ Formule confirmée !");
      modal.style.display = 'none';
    } else {
      alert("❌ Erreur de validation.");
    }
  })
  .catch(err => {
    console.error("Erreur validation :", err);
    alert("❌ Erreur réseau.");
  });
});


</script>
