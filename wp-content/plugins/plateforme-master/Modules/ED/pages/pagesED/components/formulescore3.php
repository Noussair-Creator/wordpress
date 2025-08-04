<div class="body-content">

        <section class="utm-score-formula">
        <div class="utm-score-header">
            <div class="master-title"><img class="icon_img" src="/imagesMaster/servicemaster_images/2274790.png"> Définir la formule de calcul du score</div>
            <button class="utm-save-btn"><i class="fa-solid fa-circle-check"></i> Enregistrer</button>
        </div>

        <ul class="utm-toggle-list">

            

            <li>
                <div class="utm-toggle-row">
                    <span>Moyenne arithmétique</span>
                    <label class="utm-switch">
                    <input type="checkbox" class="utm-toggle-input" data-target="#bloc-l1">
                    <span class="utm-slider"></span>
                    </label>
                </div>
                <div class="utm-toggle-content" id="bloc-l1">

                    <div class="utm-average-section">
                        <div class="utm-average-inputs">
                            <input type="text" placeholder="Moyenne générale" readonly>
                            <input type="text" placeholder="Nombre total d'années" readonly>
                        </div>

                        <div class="utm-average-list">
                            <div class="utm-average-row">Moyenne L1</div>
                            <div class="utm-average-row alt">Moyenne L2</div>
                            <div class="utm-average-row">Moyenne L3</div>
                        </div>
                    </div>

                    <!-- Ligne de niveaux d'études -->
                    <div class="utm-mention-levels">
                        <label><input type="checkbox" name="mention_levels[]" value="licence" checked> Licence</label>
                        <label><input type="checkbox" name="mention_levels[]" value="maitrise"> Maîtrise</label>
                        <label><input type="checkbox" name="mention_levels[]" value="cycle_ingenieur"> Cycle ingénieur</label>
                    </div>

                </div>
                 
            </li>

            <li>
            <div class="utm-toggle-row">
                <span>Crédits</span>
                <label class="utm-switch">
                <input type="checkbox" class="utm-toggle-input" data-target="#bloc-credits">
                <span class="utm-slider"></span>
                </label>
            </div>

            <div class="utm-toggle-content" id="bloc-credits">
                <div class="utm-credit-section">
                <div class="utm-credit-left">
                    <div class="utm-credit-row">CR1 L1</div>
                    <div class="utm-credit-row alt">CR2 L2</div>
                    <div class="utm-credit-row">CR3 L3</div>
                </div>

                <div class="utm-credit-formule">
                    <span>Formule BCR</span>
                </div>
                </div>
            </div>
            </li>



            <li>
            <div class="utm-toggle-row">
                <span>Matières spécifiques</span>
                <label class="utm-switch">
                <input type="checkbox" class="utm-toggle-input" data-target="#bloc-matieres">
                <span class="utm-slider"></span>
                </label>
            </div>
            <div class="utm-toggle-content" id="bloc-matieres">

               
                <div id="utm-matiere-container">
                    <div class="utm-matiere-row">
                        <div class="utm-field">
                        <label>Matière</label>
                        <input type="text" placeholder="Matière" value="Computer Vision">
                        </div>
                        <div class="utm-field">
                        <label>Année</label>
                        <select>
                            <option>Première année</option>
                            <option>Deuxième année</option>
                            <option>Troisieme année</option>

                        </select>
                        </div>
                        <div class="utm-field">
                        <label>Note</label>
                        <input type="number" placeholder="Note" value="15">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    <div class="utm-matiere-row">
                        <div class="utm-field">
                        <label>Matière</label>
                        <input type="text" placeholder="Matière" value="Machine Learning">
                        </div>
                        <div class="utm-field">
                        <label>Année</label>
                        <select>
                            <option>Première année</option>
                            <option>Deuxième année</option>
                            <option>Troisieme année</option>

                        </select>
                        </div>
                        <div class="utm-field">
                        <label>Note</label>
                        <input type="number" placeholder="Note" value="12">
                        </div>
                        <div class="utm-actions"></div>
                    </div>
                </div>




            </div>
            </li>

            <li>
            <div class="utm-toggle-row">
                <span>Entretien</span>
                <label class="utm-switch">
                <input type="checkbox" class="utm-toggle-input" data-target="#bloc-entretien">
                <span class="utm-slider"></span>
                </label>
            </div>
            <div class="utm-toggle-content" id="bloc-entretien">
                <input type="number" placeholder="Note d'entretien" value="16">
            </div>
            </li>

            <li>
            <div class="utm-toggle-row">
                <span>Bonus Mention ( B.M )</span>
                <label class="utm-switch">
                <input type="checkbox" class="utm-toggle-input" data-target="#bloc-bonus">
                <span class="utm-slider"></span>
                </label>
            </div>

            <div class="utm-toggle-content" id="bloc-bonus">
               
                <div id="utm-bonus-container">
                    

                <div id="utm-bonus-container">
                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Condition</label>
                        <input type="text" name="bonus_condition[0][condition]" value="Si mention passable">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="bonus_condition[0][valeur]" value="1">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Condition</label>
                        <input type="text" name="bonus_condition[1][condition]" value="Si mention assez bien">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="bonus_condition[1][valeur]" value="1">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                        <div class="utm-bonus-row">
                            <div class="utm-field">
                            <label>Condition</label>
                            <input type="text" name="bonus_condition[2][condition]" value="Si mention bien">
                            </div>
                            <div class="utm-field">
                            <label>Valeur</label>
                            <input type="number" name="bonus_condition[2][valeur]" value="1">
                            </div>
                            <div class="utm-actions"></div>
                        </div>

                        <div class="utm-bonus-row">
                            <div class="utm-field">
                            <label>Condition</label>
                            <input type="text" name="bonus_condition[3][condition]" value="Si mention très bien">
                            </div>
                            <div class="utm-field">
                            <label>Valeur</label>
                            <input type="number" name="bonus_condition[3][valeur]" value="1">
                            </div>
                            <div class="utm-actions"></div>
                        </div>
                        </div>




                </div>


            </div>


            </li>
            <li>
                <div class="utm-toggle-row">
                    <span>Bonus Session (B.S)</span>
                    <label class="utm-switch">
                    <input type="checkbox" class="utm-toggle-input" data-target="#bloc-bonus-session">
                    <span class="utm-slider"></span>
                    </label>
                </div>

                <div class="utm-toggle-content" id="bloc-bonus-session">
                    <div id="utm-bonus-session-container">

                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Session</label>
                        <input type="text" name="bonus_session[0][condition]" value="Session principale">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="bonus_session[0][valeur]" value="1">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Session</label>
                        <input type="text" name="bonus_session[1][condition]" value="Session de contrôle">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="bonus_session[1][valeur]" value="0.5">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    </div>
                </div>
            </li>
            <li>
            <div class="utm-toggle-row">
                <span>Malus</span>
                <label class="utm-switch">
                <input type="checkbox" class="utm-toggle-input" data-target="#bloc-malus">
                <span class="utm-slider"></span>
                </label>
            </div>

            <div class="utm-toggle-content" id="bloc-malus">
                <div id="utm-malus-container">

                <div class="utm-bonus-row">
                    <div class="utm-field">
                    <label>Condition</label>
                    <input type="text" name="malus[0][condition]" value="Redoublement">
                    </div>
                    <div class="utm-field">
                    <label>Valeur</label>
                    <input type="number" name="malus[0][valeur]" value="-1">
                    </div>
                    <div class="utm-actions"></div>
                </div>

                <div class="utm-bonus-row">
                    <div class="utm-field">
                    <label>Condition</label>
                    <input type="text" name="malus[1][condition]" value="Année blanche">
                    </div>
                    <div class="utm-field">
                    <label>Valeur</label>
                    <input type="number" name="malus[1][valeur]" value="-0.5">
                    </div>
                    <div class="utm-actions"></div>
                </div>
                  <!-- Ligne de niveaux d'études -->
                <div class="utm-mention-levels">
                        <label><input type="checkbox" name="malus_levels[]" value="Exclus du cycle préparatoire" checked> Exclus du cycle préparatoire</label>
                </div>

                </div>
            </div>
            </li>

            <li>
                <div class="utm-toggle-row">
                    <span>Année d’interruption</span>
                    <label class="utm-switch">
                    <input type="checkbox" class="utm-toggle-input" data-target="#bloc-interruption">
                    <span class="utm-slider"></span>
                    </label>
                </div>

                <div class="utm-toggle-content" id="bloc-interruption">
                    <div id="utm-interruption-container">

                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Condition</label>
                        <input type="text" name="interruption[0][condition]" value="Si le candidat a &gt;= 4 années d’interruption depuis l’obtention du diplôme">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="interruption[0][valeur]" value="1">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    <div class="utm-bonus-row">
                        <div class="utm-field">
                        <label>Condition</label>
                        <input type="text" name="interruption[1][condition]" value="Si le candidat a &gt; 4 années d’interruption depuis l’obtention du diplôme">
                        </div>
                        <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="interruption[1][valeur]" value="0.8">
                        </div>
                        <div class="utm-actions"></div>
                    </div>

                    </div>
                </div>
            </li>









            

           
        </ul>

            <div class="utm-formule-box">
                <div class="utm-formule-header" onclick="toggleFormuleBody()">
                    <span>Formule de calcul</span>
                    <i class="fa fa-chevron-up" id="utm-formule-icon"></i>
                </div>

                <div class="utm-formule-body" id="utm-formule-body">
                    <div class="utm-formule-controls">
                    <select class="utm-formule-select" id="select_operation">
                        <option>Opérations</option>
                        <option>+</option>
                        <option>-</option>
                        <option>*</option>
                        <option>/</option>
                         <option>(</option>
                        <option>)</option>
                        <option>%</option>
                    </select>

                    <select class="utm-formule-select" id="select_critere">
                      
                    </select>
                    <div class="utm-field">
                     <input type="nymber" id="number" style="width: 100px;">
                    </div>

                    <button class="utm-formule-add" id="AddChampValeur">Ajouter un champs numérique</button>
                    </div>

                    <div id="formulePreview" class="formule-preview"></div>
                </div>
                </div>


        </section>

</div>

<style>
    .utm-score-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
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
  border: 1px solid #A6A485;
    border-radius: 10px;
}

.utm-toggle-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 5px 16px #00000012;
}

.utm-toggle-content
 {
    display: none;
    padding: 20px 20px;
    margin: 0 0 0px;
    background-color: #DBD9C32B;
    /* border-left: 4px solid #d60000; */
    border-radius: 0 0 10px 10px;
    animation: fadeIn 0.3s ease-in-out;
}
.utm-matiere-row,
.utm-bonus-row {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.utm-toggle-content input, .utm-toggle-content select {
    padding: 10px 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    flex: 1;
    font-size: 15px;
    border: 1px solid #A6A485;
    font-weight: 600;
}

/* Switch style */
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
  top: 0; left: 0;
  right: 0; bottom: 0;
  background-color: #aaa;
  transition: 0.4s;
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
  transition: 0.4s;
  border-radius: 50%;
}

.utm-switch input:checked + .utm-slider {
  background-color: #b60303;
}

.utm-switch input:checked + .utm-slider:before {
  transform: translateX(20px);
}
.body-content {
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    border-radius: 12px;
    max-width: 1200px;
    margin: 30px auto;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
.master-title {
    font-size: 18px;
    font-weight: bold;
}img.icon_img {
    width: 36px;
    height: 36px;
}
.utm-toggle-row span {
    font-size: 18px;
    font-weight: 600;
    /* box-shadow: 0px 5px 16px #00000012; */
}
.utm-matiere-row {
  display: flex;
  align-items: flex-end;
  gap: 10px;
  background-color: #f9f9f4;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 8px;
}

.utm-field {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.utm-field label {
    font-size: 16px;
    color: #6E6D55;
    margin-bottom: 4px;
    font-weight: 600;
}

.utm-field input, .utm-field select {
    padding: 11px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    border: 1px solid #A6A485;
}

.utm-actions {
  display: flex;
  align-items: center;
  justify-content: center;
}

.utm-actions button {
    border: none;
    background: none;
    font-size: 18px;
    padding: 14px 17px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s, color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 13px #0000001F;
    border-radius: 5px;
}
.utm-actions  i.fa.fa-plus {
    color: #2A2916;
}
.utm-btn-delete:hover {
  background-color: #ffe5e5;
  color: #d60000;
}

.utm-btn-add:hover {
  background-color: #f7f7f3;
  color: #28a745;
}
.utm-actions button {
  border: none;
  background: none;
  font-size: 18px;
  padding: 14px 17px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Bouton Supprimer */
.utm-btn-delete {
  color: #d60000;
}

.utm-btn-delete:hover {
  background-color: #ffe5e5;
  color: #a00000;
}

/* Bouton Ajouter */
.utm-btn-add {
  color: #28a745;
}

.utm-btn-add:hover {
  background-color: #e7fbe7;
  color: #1d9236;
}
.utm-bonus-row {
    display: flex
;
    align-items: flex-end;
    gap: 10px;
    background-color: #f9f9f4;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 8px;
}

.utm-average-section {
  background-color: #f9f9f4;
  border: 1px solid #A6A485;
  border-radius: 10px;
  padding: 15px;
  margin-top: 20px;
}

.utm-average-inputs {
  display: flex;
  gap: 15px;
  margin-bottom: 15px;
}

.utm-average-inputs input {
  flex: 1;
  padding: 10px 12px;
  border: 1px solid #A6A485;
  border-radius: 6px;
  font-size: 15px;
  font-weight: 600;
  background-color: #fff;
  color: #333;
}

.utm-average-list {
  border: 1px solid #D9D8C6;
  border-radius: 8px;
  overflow: hidden;
}

.utm-average-row {
  padding: 12px 16px;
  font-weight: 600;
  font-size: 15px;
  background-color: #ffffff;
  border-bottom: 1px solid #eee;
}

.utm-average-row.alt {
  background-color: #f0eee7;
}

.utm-average-row:last-child {
  border-bottom: none;
}
.utm-credit-section {
  display: flex;
  gap: 20px;
  background-color: #f9f9f4;
  border: 1px solid #A6A485;
  border-radius: 10px;
  padding: 15px;
  margin-top: 10px;
  flex-wrap: wrap;
}

.utm-credit-left {
  flex: 1;
  min-width: 200px;
  border: 1px solid #D9D8C6;
  border-radius: 8px;
  overflow: hidden;
}

.utm-credit-row {
  padding: 12px 16px;
  font-weight: 600;
  font-size: 15px;
  background-color: #ffffff;
  border-bottom: 1px solid #eee;
}

.utm-credit-row.alt {
  background-color: #f0eee7;
}

.utm-credit-row:last-child {
  border-bottom: none;
}

.utm-credit-formule {
  width: 180px;
  min-width: 150px;
  border: 1px solid #D9D8C6;
  border-radius: 8px;
  padding: 20px;
  font-weight: bold;
  text-align: center;
  background-color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
.utm-mention-levels {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 15px 10px 5px;
  border-top: 1px solid #ddd;
  margin-top: 15px;
}

.utm-mention-levels label {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: 500;
  font-size: 15px;
  color: #2A2916;
}

.utm-mention-levels input[type="checkbox"] {
  accent-color: #b60303; /* rouge UTM */
  width: 16px;
  height: 16px;
}
.utm-formule-container {
  border: 1px solid #A6A485;
  border-radius: 10px;
  padding: 20px;
  background-color: #fff;
  margin-top: 20px;
}

.utm-formule-header {
  font-size: 18px;
  font-weight: bold;
  color: #2A2916;
  margin-bottom: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.utm-formule-controls {
  display: flex;
  gap: 15px;
  margin-bottom: 15px;
  flex-wrap: wrap;
}

.utm-formule-select {
  padding: 10px 12px;
  border: 1px solid #A6A485;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  min-width: 150px;
  background-color: #fff;
}

.utm-formule-add {
  background-color: #d60000;
  color: #fff;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  padding: 10px 16px;
  font-size: 14px;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.utm-formule-textarea {
  width: 100%;
  min-height: 80px;
  padding: 12px;
  border: 1px solid #A6A485;
  border-radius: 8px;
  font-size: 15px;
  color: #333;
  background-color: #fff;
  resize: vertical;
  font-weight:500;
}
.utm-formule-box {
  border: 1px solid #A6A485;
  border-radius: 10px;
  background-color: #fff;
  margin-top: 25px;
  overflow: hidden;
}

.utm-formule-header {
  background: #f9f9f4;
  padding: 14px 20px;
  font-size: 18px;
  font-weight: 600;
  color: #2A2916;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #e0dec5;
  cursor: pointer;
}

.utm-formule-body {
  padding: 20px;
}

.utm-formule-controls {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  margin-bottom: 15px;
}

.utm-formule-select {
    padding: 10px 28px;
    border: 1px solid #A6A485;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    min-width: 200px;
    background-color: #fff;
}

.utm-formule-add {
  background-color: #d60000;
  color: #fff;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  padding: 10px 16px;
  font-size: 14px;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.utm-formule-textarea {
  width: 100%;
  min-height: 80px;
  padding: 12px;
  border: 1px solid #A6A485;
  border-radius: 8px;
  font-size: 15px;
  background-color: #fff;
  resize: vertical;
  font-weight:500;
}

.utm-formule-header {
    background: #f9f9f4;
    padding: 14px 20px;
    font-size: 18px;
    font-weight: 600;
    color: #2A2916;
    display: flex
;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e0dec5;
    cursor: pointer;
    display: flex
;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 5px 16px #00000012;
}
.formule-preview {
 width: 100%;
    min-height: 80px;
    padding: 12px;
    border: 1px solid #A6A485;
    border-radius: 8px;
    font-size: 15px;
    background-color: #fff;
    resize: vertical;
    font-weight: 500;
}
.formule-token {
  background-color: #e3e3e3;
  padding: 4px 8px;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 2px;
}
.formule-token:hover {
  background-color: #d9534f;
  color: white;
}
</style>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.utm-toggle-input').forEach(input => {
      const targetId = input.dataset.target;
      const target = document.querySelector(targetId);

      const toggleDisplay = () => {
        target.style.display = input.checked ? 'block' : 'none';
      };

      input.addEventListener('change', toggleDisplay);
      toggleDisplay(); // Initial state
    });
  });
</script>
<script>
function renderMatiereRows() {
  const container = document.getElementById('utm-matiere-container');
  const rows = container.querySelectorAll('.utm-matiere-row');

  rows.forEach((row, index) => {
    const actions = row.querySelector('.utm-actions');
    actions.innerHTML = '';

    if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.className = 'utm-btn-add';
      addBtn.innerHTML = '<i class="fa fa-plus"></i>';
      addBtn.addEventListener('click', addMatiereRow);
      actions.appendChild(addBtn);
    } else {
      const delBtn = document.createElement('button');
      delBtn.className = 'utm-btn-delete';
      delBtn.innerHTML = '<i class="fa fa-trash"></i>';
      delBtn.addEventListener('click', () => {
        row.remove();
        renderMatiereRows();
      });
      actions.appendChild(delBtn);
    }
  });
}

function addMatiereRow() {
  const container = document.getElementById('utm-matiere-container');

  const row = document.createElement('div');
  row.className = 'utm-matiere-row';
  row.innerHTML = `
    <div class="utm-field">
      <label>Matière</label>
      <input type="text" placeholder="Matière">
    </div>
    <div class="utm-field">
      <label>Année</label>
      <select>
        <option>Première année</option>
        <option>Deuxième année</option>
         <option>Troisieme année</option>

      </select>
    </div>
    <div class="utm-field">
      <label>Note</label>
      <input type="number" placeholder="Note">
    </div>
    <div class="utm-actions"></div>
  `;
  container.appendChild(row);
  renderMatiereRows();
}

// Initialisation après chargement
window.addEventListener('DOMContentLoaded', renderMatiereRows);



function renderBonusConditionRows() {
  const container = document.getElementById('utm-bonus-container');
  const rows = container.querySelectorAll('.utm-bonus-row');

  rows.forEach((row, index) => {
    // Mettre à jour les attributs name
    const inputs = row.querySelectorAll('input');
    if (inputs.length >= 2) {
      inputs[0].setAttribute('name', `bonus_condition[${index}][condition]`);
      inputs[1].setAttribute('name', `bonus_condition[${index}][valeur]`);
    }

    const actions = row.querySelector('.utm-actions');
    actions.innerHTML = '';

    if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.className = 'utm-btn-add';
      addBtn.innerHTML = '<i class="fa fa-plus"></i>';
      addBtn.addEventListener('click', addBonusConditionRow);
      actions.appendChild(addBtn);
    } else {
      const delBtn = document.createElement('button');
      delBtn.className = 'utm-btn-delete';
      delBtn.innerHTML = '<i class="fa fa-trash"></i>';
      delBtn.addEventListener('click', () => {
        row.remove();
        renderBonusConditionRows();
      });
      actions.appendChild(delBtn);
    }
  });
}

function addBonusConditionRow() {
  const container = document.getElementById('utm-bonus-container');
  const newIndex = container.querySelectorAll('.utm-bonus-row').length;

  const row = document.createElement('div');
  row.className = 'utm-bonus-row';
  row.innerHTML = `
    <div class="utm-field">
      <label>Condition</label>
      <input type="text" placeholder="Ex: Si mention très bien" name="bonus_condition[${newIndex}][condition]">
    </div>
    <div class="utm-field">
      <label>Valeur</label>
      <input type="number" placeholder="Valeur" name="bonus_condition[${newIndex}][valeur]">
    </div>
    <div class="utm-actions"></div>
  `;
  container.appendChild(row);
  renderBonusConditionRows();
}

window.addEventListener('DOMContentLoaded', renderBonusConditionRows);

function renderBonusSessionRows() {
  const container = document.getElementById('utm-bonus-session-container');
  const rows = container.querySelectorAll('.utm-bonus-row');

  rows.forEach((row, index) => {
    const inputs = row.querySelectorAll('input');
    if (inputs.length >= 2) {
      inputs[0].setAttribute('name', `bonus_session[${index}][condition]`);
      inputs[1].setAttribute('name', `bonus_session[${index}][valeur]`);
    }

    const actions = row.querySelector('.utm-actions');
    actions.innerHTML = '';

    if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.className = 'utm-btn-add';
      addBtn.innerHTML = '<i class="fa fa-plus"></i>';
      addBtn.addEventListener('click', addBonusSessionRow);
      actions.appendChild(addBtn);
    } else {
      const delBtn = document.createElement('button');
      delBtn.className = 'utm-btn-delete';
      delBtn.innerHTML = '<i class="fa fa-trash"></i>';
      delBtn.addEventListener('click', () => {
        row.remove();
        renderBonusSessionRows();
      });
      actions.appendChild(delBtn);
    }
  });
}

function addBonusSessionRow() {
  const container = document.getElementById('utm-bonus-session-container');
  const newIndex = container.querySelectorAll('.utm-bonus-row').length;

  const row = document.createElement('div');
  row.className = 'utm-bonus-row';
  row.innerHTML = `
    <div class="utm-field">
      <label>Session</label>
      <input type="text" name="bonus_session[${newIndex}][condition]" placeholder="Nom de la session">
    </div>
    <div class="utm-field">
      <label>Valeur</label>
      <input type="number" name="bonus_session[${newIndex}][valeur]" placeholder="Valeur">
    </div>
    <div class="utm-actions"></div>
  `;
  container.appendChild(row);
  renderBonusSessionRows();
}

window.addEventListener('DOMContentLoaded', renderBonusSessionRows);


function renderMalusRows() {
  const container = document.getElementById('utm-malus-container');
  const rows = container.querySelectorAll('.utm-bonus-row');

  rows.forEach((row, index) => {
    const inputs = row.querySelectorAll('input');
    if (inputs.length >= 2) {
      inputs[0].setAttribute('name', `malus[${index}][condition]`);
      inputs[1].setAttribute('name', `malus[${index}][valeur]`);
    }

    const actions = row.querySelector('.utm-actions');
    actions.innerHTML = '';

    if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.className = 'utm-btn-add';
      addBtn.innerHTML = '<i class="fa fa-plus"></i>';
      addBtn.addEventListener('click', addMalusRow);
      actions.appendChild(addBtn);
    } else {
      const delBtn = document.createElement('button');
      delBtn.className = 'utm-btn-delete';
      delBtn.innerHTML = '<i class="fa fa-trash"></i>';
      delBtn.addEventListener('click', () => {
        row.remove();
        renderMalusRows();
      });
      actions.appendChild(delBtn);
    }
  });
}

function addMalusRow() {
  const container = document.getElementById('utm-malus-container');
  const index = container.querySelectorAll('.utm-bonus-row').length;

  const row = document.createElement('div');
  row.className = 'utm-bonus-row';
  row.innerHTML = `
    <div class="utm-field">
      <label>Condition</label>
      <input type="text" name="malus[${index}][condition]" placeholder="Ex: redoublement">
    </div>
    <div class="utm-field">
      <label>Valeur</label>
      <input type="number" name="malus[${index}][valeur]" placeholder="-0.5">
    </div>
    <div class="utm-actions"></div>
  `;
  container.appendChild(row);
  renderMalusRows();
}

window.addEventListener('DOMContentLoaded', renderMalusRows);
function renderInterruptionRows() {
  const container = document.getElementById('utm-interruption-container');
  const rows = container.querySelectorAll('.utm-bonus-row');

  rows.forEach((row, index) => {
    const inputs = row.querySelectorAll('input');
    if (inputs.length >= 2) {
      inputs[0].setAttribute('name', `interruption[${index}][condition]`);
      inputs[1].setAttribute('name', `interruption[${index}][valeur]`);
    }

    const actions = row.querySelector('.utm-actions');
    actions.innerHTML = '';

    if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.className = 'utm-btn-add';
      addBtn.innerHTML = '<i class="fa fa-plus"></i>';
      addBtn.addEventListener('click', addInterruptionRow);
      actions.appendChild(addBtn);
    } else {
      const delBtn = document.createElement('button');
      delBtn.className = 'utm-btn-delete';
      delBtn.innerHTML = '<i class="fa fa-trash"></i>';
      delBtn.addEventListener('click', () => {
        row.remove();
        renderInterruptionRows();
      });
      actions.appendChild(delBtn);
    }
  });
}

function addInterruptionRow() {
  const container = document.getElementById('utm-interruption-container');
  const index = container.querySelectorAll('.utm-bonus-row').length;

  const row = document.createElement('div');
  row.className = 'utm-bonus-row';
  row.innerHTML = `
    <div class="utm-field">
      <label>Condition</label>
      <input type="text" name="interruption[${index}][condition]" placeholder="Ex: Si interruption &gt; 4 ans">
    </div>
    <div class="utm-field">
      <label>Valeur</label>
      <input type="number" name="interruption[${index}][valeur]" placeholder="0.5">
    </div>
    <div class="utm-actions"></div>
  `;
  container.appendChild(row);
  renderInterruptionRows();
}

window.addEventListener('DOMContentLoaded', renderInterruptionRows);

function toggleFormuleBody() {
  const body = document.getElementById('utm-formule-body');
  const icon = document.getElementById('utm-formule-icon');
  const isVisible = body.style.display !== 'none';

  body.style.display = isVisible ? 'none' : 'block';
  icon.className = isVisible ? 'fa fa-chevron-down' : 'fa fa-chevron-up';
}

/*
document.querySelector('.utm-save-btn').addEventListener('click', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1'; // défaut : M1
  const data = {
    niveau: currentCycle,
    formule: document.getElementById('formulePreview').value,
    matieres: [],
    bonus_mention: [],
    bonus_session: [],
    malus: [],
    interruption: [],
    exclu_cycle_preparatoire: document.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked ?? false
  };


 


  document.querySelectorAll('#utm-matiere-container .utm-matiere-row').forEach(row => {
    data.matieres.push({
      matiere: row.querySelector('input[type="text"]').value,
      annee: row.querySelector('select').value,
      note: row.querySelector('input[type="number"]').value
    });
  });

  document.querySelectorAll('#utm-bonus-container .utm-bonus-row').forEach(row => {
    data.bonus_mention.push({
      condition: row.querySelector('input[name*="condition"]').value,
      valeur: row.querySelector('input[name*="valeur"]').value
    });
  });

  document.querySelectorAll('#utm-bonus-session-container .utm-bonus-row').forEach(row => {
    data.bonus_session.push({
      condition: row.querySelector('input[name*="condition"]').value,
      valeur: row.querySelector('input[name*="valeur"]').value
    });
  });

  document.querySelectorAll('#utm-malus-container .utm-bonus-row').forEach(row => {
    data.malus.push({
      condition: row.querySelector('input[name*="condition"]').value,
      valeur: row.querySelector('input[name*="valeur"]').value
    });
  });

  document.querySelectorAll('#utm-interruption-container .utm-bonus-row').forEach(row => {
    data.interruption.push({
      condition: row.querySelector('input[name*="condition"]').value,
      valeur: row.querySelector('input[name*="valeur"]').value
    });
  });

  const masterId = parseInt(new URLSearchParams(window.location.search).get("id"));

  fetch(`/wp-json/plateforme-master/v1/score/${masterId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings.nonce
    },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(res => {
    if (res.success) {
      alert("✅ Formule enregistrée !");
    } else {
      alert("❌ Erreur API");
      console.error(res);
    }
  })
  .catch(err => {
    console.error("Erreur :", err);
    alert("❌ Erreur de réseau.");
  });
});
*/

/*
document.addEventListener('DOMContentLoaded', () => {
  const critereSelect = document.getElementById('select_critere');

  // Cibler tous les checkboxes utm-toggle-input
  document.querySelectorAll('.utm-toggle-input').forEach(toggle => {
    toggle.addEventListener('change', function () {
      const isChecked = this.checked;
      const toggleRow = this.closest('.utm-toggle-row');
      const labelText = toggleRow?.querySelector('span')?.innerText?.trim();

      if (!labelText) return;

      const optionExists = Array.from(critereSelect.options).some(opt => opt.text === labelText);

      if (isChecked && !optionExists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        critereSelect.appendChild(opt);
      } else if (!isChecked && optionExists) {
        Array.from(critereSelect.options).forEach((opt, i) => {
          if (opt.text === labelText) critereSelect.remove(i);
        });
      }
    });
  });
});

*/
/*
document.addEventListener('DOMContentLoaded', () => {
  const textarea = document.getElementById('formuleFinal');
  const selectOperation = document.getElementById('select_operation');
  const selectCritere = document.getElementById('select_critere');
  const inputNumber = document.getElementById('number');
  const addChampBtn = document.getElementById('AddChampValeur');

  function insertIntoTextarea(value) {
    if (!value) return;

    const cursorPos = textarea.selectionStart;
    const before = textarea.value.substring(0, cursorPos);
    const after = textarea.value.substring(cursorPos);
    textarea.value = before + value + after;

    textarea.focus();
    textarea.selectionStart = textarea.selectionEnd = cursorPos + value.length;
  }

  // Opération
  selectOperation.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val !== "Opérations") {
      insertIntoTextarea(` ${val} `);
      e.target.selectedIndex = 0;
    }
  });

  // Critère
  selectCritere.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val !== "Critères") {
      insertIntoTextarea(` ${val} `);
      e.target.selectedIndex = 0;
    }
  });

  // Ajouter un champ numérique
  addChampBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const val = inputNumber.value.trim();
    if (val !== "") {
      insertIntoTextarea(` ${val} `);
      inputNumber.value = "";
    }
  });
});
*/


document.addEventListener('DOMContentLoaded', () => {
  const preview = document.getElementById('formulePreview');
  const selectOperation = document.getElementById('select_operation');
  const selectCritere = document.getElementById('select_critere');
  const inputNumber = document.getElementById('number');
  const addChampBtn = document.getElementById('AddChampValeur');

  const tokens = []; // tableau des valeurs ajoutées

  function renderPreview() {
    preview.innerHTML = "";
    tokens.forEach((tok, index) => {
      const span = document.createElement('span');
      span.className = 'formule-token';
      span.textContent = tok;
      span.title = "Cliquez pour supprimer";
      span.addEventListener('click', () => {
        tokens.splice(index, 1);
        renderPreview();
      });
      preview.appendChild(span);
    });

    // Mettre à jour le textarea (readonly)
   // textarea.value = tokens.join(" ");
  }



  selectOperation.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val !== "Opérations") {
      addToken(val);
      e.target.selectedIndex = 0;
    }
  });

  selectCritere.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val !== "Critères") {
      addToken(val);
      e.target.selectedIndex = 0;
    }
  });

  addChampBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const val = inputNumber.value.trim();
    if (val !== "") {
      addToken(val);
      inputNumber.value = "";
    }
  });
});

/*
const tokens = [];

function renderPreview() {
  const preview = document.getElementById('formulePreview');
  const textarea = document.getElementById('formuleFinal');
  preview.innerHTML = '';

  tokens.forEach((tok, index) => {
    const span = document.createElement('span');
    span.className = 'formule-token';
    span.textContent = tok;
    span.title = "Cliquez pour supprimer";
    span.addEventListener('click', () => {
      tokens.splice(index, 1);
      renderPreview();
    });
    preview.appendChild(span);
  });

  //textarea.value = tokens.join(" ");
}

function addToken(value) {
  if (value) {
    tokens.push(value);
    renderPreview();
  }
}
*/


</script>
<script>


/*

document.addEventListener('DOMContentLoaded', () => {
  const selectOperation = document.getElementById('select_operation');
  const selectCritere = document.getElementById('select_critere');
  const inputNumber = document.getElementById('number');
  const addChampBtn = document.getElementById('AddChampValeur');

  // Injecte automatiquement les options des critères cochés au chargement
  document.querySelectorAll('.utm-toggle-input:checked').forEach(toggle => {
    const labelText = toggle.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
    if (!labelText) return;

    if (labelText === 'Moyenne arithmétique') {
      ['Moyenne L1', 'Moyenne L2', 'Moyenne L3'].forEach(moy => {
        const exists = Array.from(selectCritere.options).some(opt => opt.text === moy);
        if (!exists) {
          const opt = document.createElement('option');
          opt.text = moy;
          opt.value = moy;
          selectCritere.appendChild(opt);
        }
      });
    } else {
      const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);
      if (!exists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        selectCritere.appendChild(opt);
      }
    }
  });

  // Gère les ajouts/retraits dynamiques
  document.querySelectorAll('.utm-toggle-input').forEach(toggle => {
    toggle.addEventListener('change', function () {
      const isChecked = this.checked;
      const labelText = this.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
      if (!labelText) return;

      if (labelText === 'Moyenne arithmétique') {
        const moyennes = ['Moyenne L1', 'Moyenne L2', 'Moyenne L3'];
        moyennes.forEach(moy => {
          const exists = Array.from(selectCritere.options).some(opt => opt.text === moy);
          if (isChecked && !exists) {
            const opt = document.createElement('option');
            opt.text = moy;
            opt.value = moy;
            selectCritere.appendChild(opt);
          } else if (!isChecked && exists) {
            Array.from(selectCritere.options).forEach((opt, i) => {
              if (opt.text === moy) selectCritere.remove(i);
            });
          }
        });
        return;
      }

      const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);
      if (isChecked && !exists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        selectCritere.appendChild(opt);
      } else if (!isChecked && exists) {
        Array.from(selectCritere.options).forEach((opt, i) => {
          if (opt.text === labelText) selectCritere.remove(i);
        });
      }
    });
  });

  // ✅ Sélection critère — correction ici
  selectCritere.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const val = selectedOption?.value?.trim();

    if (val && val !== "") {
      addToken(val);
      requestAnimationFrame(() => {
        this.selectedIndex = 0;
      });
    }
  });

  // Ajout champ numérique
  addChampBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const val = inputNumber.value.trim();
    if (val !== "") {
      addToken(val);
      inputNumber.value = "";
    }
  });

*/



const tokens = [];

function renderPreview() {
  const preview = document.getElementById('formulePreview');
  const textarea = document.getElementById('formuleFinal');
  preview.innerHTML = '';

  tokens.forEach((tok, index) => {
    const span = document.createElement('span');
    span.className = 'formule-token';
    span.textContent = tok;
    span.title = "Cliquez pour supprimer";
    span.addEventListener('click', () => {
      tokens.splice(index, 1);
      renderPreview();
    });
    preview.appendChild(span);
  });

  // Synchronisation avec le textarea si existant
  if (textarea) {
    textarea.value = tokens.join(" ");
  }
}

function addToken(value) {
  if (value) {
    console.log(tokens);
    tokens.push(value);
    renderPreview();
  }
}

/*
function addToken(value) {
  if (value && !tokens.includes(value)) {
    console.log('test imen');
     console.log(tokens);
    tokens.push(value);
     console.log(tokens);
    renderPreview();
  }

  
}*/











document.addEventListener('DOMContentLoaded', () => {
  const selectOperation = document.getElementById('select_operation');
  const selectCritere = document.getElementById('select_critere');
  const inputNumber = document.getElementById('number');
  const addChampBtn = document.getElementById('AddChampValeur');


  const defaultOption = document.createElement('option');
  defaultOption.value = "";
  defaultOption.disabled = true;
  defaultOption.selected = true;
  defaultOption.textContent = "-- Choisir un critère --";

  selectCritere.insertBefore(defaultOption, selectCritere.firstChild);

  // Injecte automatiquement les options des critères cochés au chargement
  document.querySelectorAll('.utm-toggle-input:checked').forEach(toggle => {
    const labelText = toggle.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
    if (!labelText) return;

    if (labelText === 'Moyenne arithmétique') {
      ['Moyenne L1', 'Moyenne L2', 'Moyenne L3'].forEach(moy => {
        const exists = Array.from(selectCritere.options).some(opt => opt.text === moy);
        if (!exists) {
          const opt = document.createElement('option');
          opt.text = moy;
          opt.value = moy;
          selectCritere.appendChild(opt);
        }
      });
    } else {
      const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);
      if (!exists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        selectCritere.appendChild(opt);
      }
    }
  });

  // Gère les ajouts/retraits dynamiques
  document.querySelectorAll('.utm-toggle-input').forEach(toggle => {
    toggle.addEventListener('change', function () {
      const isChecked = this.checked;
      const labelText = this.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
      if (!labelText) return;

      if (labelText === 'Moyenne arithmétique') {
        const moyennes = ['Moyenne L1', 'Moyenne L2', 'Moyenne L3'];
        moyennes.forEach(moy => {
          const exists = Array.from(selectCritere.options).some(opt => opt.text === moy);
          if (isChecked && !exists) {
            const opt = document.createElement('option');
            opt.text = moy;
            opt.value = moy;
            selectCritere.appendChild(opt);
          } else if (!isChecked && exists) {
            Array.from(selectCritere.options).forEach((opt, i) => {
              if (opt.text === moy) selectCritere.remove(i);
            });
          }
        });
        return;
      }

      const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);
      if (isChecked && !exists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        selectCritere.appendChild(opt);
      } else if (!isChecked && exists) {
        Array.from(selectCritere.options).forEach((opt, i) => {
          if (opt.text === labelText) selectCritere.remove(i);
        });
      }
    });
  });

  selectOperation.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val && val !== "Opérations") {
      addToken(val);
      requestAnimationFrame(() => {
        e.target.selectedIndex = 0;
      });
    }
  });

  selectCritere.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const val = selectedOption?.value?.trim();

    /*
    if (val && val !== "") {
      addToken(val);
      requestAnimationFrame(() => {
        this.selectedIndex = 0;
      });
    }*/

  });

  addChampBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const val = inputNumber.value.trim();
    if (val !== "") {
      addToken(val);
      inputNumber.value = "";
    }
  });







  // Enregistrement
  document.querySelector('.utm-save-btn').addEventListener('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1';
    const masterId = parseInt(urlParams.get("id"));

    const data = {
      niveau: currentCycle,
      formule: tokens.join(" "),
      matieres: [],
      bonus_mention: [],
      bonus_session: [],
      malus: [],
      interruption: [],
      exclu_cycle_preparatoire: document.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked ?? false
    };

    document.querySelectorAll('#utm-matiere-container .utm-matiere-row').forEach(row => {
      data.matieres.push({
        matiere: row.querySelector('input[type="text"]').value,
        annee: row.querySelector('select').value,
        note: row.querySelector('input[type="number"]').value
      });
    });

    document.querySelectorAll('#utm-bonus-container .utm-bonus-row').forEach(row => {
      data.bonus_mention.push({
        condition: row.querySelector('input[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    document.querySelectorAll('#utm-bonus-session-container .utm-bonus-row').forEach(row => {
      data.bonus_session.push({
        condition: row.querySelector('input[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    document.querySelectorAll('#utm-malus-container .utm-bonus-row').forEach(row => {
      data.malus.push({
        condition: row.querySelector('input[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    document.querySelectorAll('#utm-interruption-container .utm-bonus-row').forEach(row => {
      data.interruption.push({
        condition: row.querySelector('input[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    fetch(`/wp-json/plateforme-master/v1/score/${masterId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify(data)
    })
      .then(res => res.json())
      .then(res => {
        if (res.success) {
          alert("✅ Formule enregistrée !");
        } else {
          alert("❌ Erreur API");
          console.error(res);
        }
      })
      .catch(err => {
        console.error("Erreur :", err);
        alert("❌ Erreur de réseau.");
      });
  });
});


</script>
