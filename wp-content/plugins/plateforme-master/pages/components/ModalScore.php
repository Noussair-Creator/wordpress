<div class="modal-overlay" id="modalScore" style="display: none;">
  <div class="popup-container" id="popupScoreContainer">
    <div class="popup-header">
      <h2>Définir la Formule de calcul du score</h2>
      <button class="btn-enregistrer" id="btnSaveScore">Enregistrer</button>
    </div>
    <form class="popup-form" id="formuleForm">
      <div id="critereContainer">
        <!-- Un critère par défaut -->
        <div class="critere">
          <div class="critere-header">
            <select class="champ">
              <option>Moyenne licence</option>
              <option>Note mémoire</option>
              <option>Note entretien</option>
              <option>Expérience</option>
            </select>
          </div>

          <div class="critere-body">
            <div class="inputs">
              <input type="text" class="ponderation" value="40%" />
              <select class="typeValeur">
                <option>Numérique</option>
                <option>Textuelle</option>
              </select>
            </div>

            <div class="operations">
              <label>Opérations :</label>
              <button type="button" class="op">/</button>
              <button type="button" class="op">x</button>
              <button type="button" class="op">-</button>
              <button type="button" class="op btn-red">+</button>
              <button type="button" class="op">=</button>
              <button type="button" class="btn-delete" onclick="this.closest('.critere').remove(); updateScorePreview();">&times;</button>
            </div>
          </div>
        </div>
      </div>

      <div class="ajouter-critere">
        <a href="#" onclick="ajouterCritere(); return false;">+ Ajouter un critère</a>
      </div>

      <div class="total-section">
        <strong>Total :</strong> <span id="scorePreview"></span>
      </div>
    </form>
  </div>
</div>

<style>
 

  .critere select {
    flex: 1;
    padding: 6px;
    font-size: 13px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .btn-delete {
    background: #f8d7da;
    color: #a94442;
    border: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
  }

  .ajouter-critere a {
    color: #c62828;
    font-weight: 500;
    font-size: 14px;
    display: inline-block;
    margin-top: 10px;
  }

  .total-section {
    margin-top: 20px;
    font-size: 15px;
    font-style: italic;
  }
  .critere {
    border: 1px solid #e0ddd2;
    border-radius: 8px;
    padding: 12px;
    background: #fefcf8;
    margin-bottom: 16px;
  }

  .critere-header select {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  .critere-body {
    display: flex;
    flex-direction: column;
    margin-top: 12px;
  }

  .inputs {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
  }

  .inputs input.ponderation {
    flex: 1;
    background: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 8px;
    font-size: 13px;
  }

  .inputs select.typeValeur {
    flex: 1;
    padding: 8px;
    font-size: 13px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  .operations {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .operations label {
    font-size: 13px;
    font-weight: 500;
    margin-right: 8px;
  }

  .operations .op {
    padding: 6px 10px;
    border: none;
    background: #eee;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
  }

  .operations .op.btn-red {
    background: #c62828;
    color: white;
  }
</style>

<script>
 
  function ajouterCritere() {
    const conteneur = document.getElementById('critereContainer');
    const original = conteneur.children[0];
    const clone = original.cloneNode(true);

    // Reset inputs
    clone.querySelector('.champ').selectedIndex = 0;
    clone.querySelector('.ponderation').value = '';
    clone.querySelector('.typeValeur').selectedIndex = 0;

    // Mise à jour suppression dynamique
    clone.querySelector('.btn-delete').onclick = function () {
      clone.remove();
      updateScorePreview();
    };

    conteneur.appendChild(clone);
    updateScorePreview();
  }

  function updateScorePreview() {
    const crits = document.querySelectorAll("#critereContainer .critere");
    const parts = [];

    crits.forEach(c => {
      const champ = c.querySelector(".champ")?.value || '';
      const pond = c.querySelector(".ponderation")?.value || '';
      const op = c.querySelector(".operations .btn-red")?.textContent.trim() || '+';
      if (champ && pond) {
        parts.push(`(${champ} × ${pond})`);
      }
    });

    document.getElementById("scorePreview").textContent = parts.join(' + ');
  }

  document.addEventListener("DOMContentLoaded", function () {
    const openScoreBtn = document.getElementById("calculScore");
    const modalScore = document.getElementById("modalScore");

    if (openScoreBtn && modalScore) {
      openScoreBtn.addEventListener("click", function () {
        modalScore.style.display = "flex";
        updateScorePreview();
      });

      modalScore.addEventListener("click", function (e) {
        if (e.target === modalScore) {
          modalScore.style.display = "none";
        }
      });
    }
  });


  document.addEventListener("click", function (e) {
  if (e.target.classList.contains("op")) {
    const ops = e.target.closest(".operations").querySelectorAll(".op");
    ops.forEach(btn => btn.classList.remove("active", "btn-red"));
    e.target.classList.add("active", "btn-red");

    // Si on clique sur '=' → afficher directement scorePreview
    if (e.target.dataset.op === "=") {
      calculerFormuleFinale();
    } else {
      updateScorePreview();
    }
  }
});
function calculerFormuleFinale() {
  const crits = document.querySelectorAll("#critereContainer .critere");
  const parts = [];

  crits.forEach(c => {
    const champ = c.querySelector(".champ")?.value.trim() || '';
    const pond = c.querySelector(".ponderation")?.value.trim() || '';
    const opBtn = c.querySelector(".op.active") || c.querySelector(".op.btn-red");
    const op = opBtn?.dataset.op ?? '+';

    if (champ && pond) {
      parts.push(`(${champ} × ${pond})`);
    }
  });

  const formule = parts.join(' + ');
  document.getElementById("scorePreview").textContent = formule;
}


document.getElementById("btnSaveScore").addEventListener("click", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const masterId = parseInt(urlParams.get("id"), 10);

  if (!masterId) {
    alert("ID du master introuvable.");
    return;
  }

  const critereBlocks = document.querySelectorAll(".critere");
  const criteres = [];

  critereBlocks.forEach(block => {
    const champ = block.querySelector(".champ")?.value || '';
    const ponderationRaw = block.querySelector(".ponderation")?.value || '0';
    const type_valeur = block.querySelector(".typeValeur")?.value || '';
    const operation = block.querySelector(".op.btn-red")?.textContent || '+';

    criteres.push({
      champ: champ.trim(),
      ponderation: parseFloat(ponderationRaw.replace('%', '').trim()) || 0,
      type_valeur: type_valeur.trim(),
      operation: operation.trim()
    });
  });

  const formule = document.getElementById("scorePreview")?.textContent ?? '';

  fetch(`/wp-json/plateforme-master/v1/score/${masterId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": PMSettings.nonce
    },
    body: JSON.stringify({ criteres, formule })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("✅ Formule enregistrée avec succès.");
      document.getElementById("modalScore").style.display = "none";
      reloadMasterData(); // ⬅️ recharge la fiche après MAJ
    } else {
      alert("❌ Erreur lors de la sauvegarde.");
      console.error("Réponse API :", data);
    }
  })
  .catch(err => {
    console.error("Erreur API :", err);
    alert("Erreur réseau ou serveur.");
  });
});

</script>
