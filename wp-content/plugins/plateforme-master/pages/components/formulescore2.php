
<section class="utm-score-formula">
  <div class="utm-score-header">
    <h2><i class="fa fa-cogs"></i> Définir la formule de calcul du score</h2>
    <button class="utm-save-btn">💾 Enregistrer</button>
  </div>
  <ul class="utm-toggle-list">
    <li><span>Matières spécifiques</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
    <li><span>Entretien</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
    <li><span>Bonus</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
    <li><span>Malus</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
    <li><span>Moyenne L1</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
    <li><span>Moyenne L2</span><label class="utm-switch"><input type="checkbox"><span class="utm-slider"></span></label></li>
  </ul>
</section>


<style>
.utm-score-formula {
  background-color: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  margin-top: 30px;
}

.utm-score-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.utm-score-header h2 {
  font-size: 18px;
  color: #333;
  display: flex;
  align-items: center;
  gap: 10px;
}

.utm-save-btn {
  background-color: #d60000;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  font-weight: bold;
  font-size: 14px;
  cursor: pointer;
}

.utm-toggle-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.utm-toggle-list li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #fefefe;
  padding: 14px 20px;
  border: 1px solid #eee;
  border-radius: 10px;
  margin-bottom: 12px;
  font-size: 15px;
  color: #333;
}

/* Toggle Switch */
.utm-switch {
  position: relative;
  display: inline-block;
  width: 42px;
  height: 22px;
}

.utm-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.utm-slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #a3a29f;
  transition: 0.3s;
  border-radius: 30px;
}

.utm-slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: 0.3s;
  border-radius: 50%;
}

.utm-switch input:checked + .utm-slider {
  background-color: #28a745;
}

.utm-switch input:checked + .utm-slider:before {
  transform: translateX(20px);
}

</style>
<script>
document.querySelector('.utm-save-btn')?.addEventListener('click', () => {
  const toggles = document.querySelectorAll('.utm-toggle-list input');
  const selected = [];

  toggles.forEach(toggle => {
    if (toggle.checked) {
      const label = toggle.closest('li').querySelector('span');
      selected.push(label.textContent.trim());
    }
  });

  alert("Critères activés :\n" + (selected.length ? selected.join('\n') : "Aucun"));
});


</script>