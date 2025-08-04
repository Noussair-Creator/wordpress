<div id="modal-affectation-coordinateur" class="affect-modal" style="display:none;">
  <div class="affect-modal-content">
    
    <div class="affect-modal-header-bar">
      <h3 class="affect-modal-title">Affecter un coordinateur</h3>
      <button class="affect-btn-save" onclick="enregistrerAffectation()">Enregistrer</button>
    </div>

    <hr class="affect-divider" />

    <div class="affect-list-header">Liste des coordinateurs</div>

    <ul class="affect-coord-list" id="utm-coord-list">
      <!-- Injecté dynamiquement -->
    </ul>

  </div>
</div>



<style>
.affect-modal {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.35);
  z-index: 9999;
  display: flex;
  justify-content: flex-end;
  font-family: 'Segoe UI', sans-serif;
}

.affect-modal-content {
  width: 420px;
  background: #fff;
  display: flex;
  flex-direction: column;
  padding: 0;
  box-shadow: -4px 0 12px rgba(0,0,0,0.15);
}

.affect-modal-header-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 24px;
  background: #fff;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05);
  z-index: 2;
}

.affect-modal-title {
  margin: 0;
  font-size: 17px;
  font-weight: bold;
  color: #222;
}

.affect-btn-save {
  background-color: #c60000;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 8px 16px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
}

.affect-divider {
  border: none;
  border-top: 1px solid #ddd;
  margin: 0;
}

.affect-list-header {
  font-size: 16px;
  font-weight: 600;
  padding: 16px 24px 8px;
  border-bottom: 1px solid #f2f2f2;
  background: #fff;
}

.affect-coord-list {
  padding: 16px 24px;
  margin: 0;
  list-style: none;
  background: #fff;
  overflow-y: auto;
  max-height: calc(100vh - 180px);
}

.affect-coord-list li {
  display: flex;
  align-items: center;
  margin-bottom: 16px;
}

.affect-coord-list input[type="radio"] {
  margin-right: 12px;
}

.affect-coord-list img {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 10px;
}

.affect-coord-info {
  flex: 1;
}
.affect-coord-info .name {
  font-weight: 600;
  font-size: 15px;
}
.affect-coord-info .details {
  font-size: 13px;
  color: #666;
}


</style>
<script>
  

</script>