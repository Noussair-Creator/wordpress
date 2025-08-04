<div class="body-content">

        <section class="utm-score-formula">
        <div class="utm-score-header">
            <div class="master-title"><img class="icon_img" src="/imagesMaster/servicemaster_images/2274790.png"> Définir la formule de calcul du score</div>
            <!--<button class="utm-save-btn"><i class="fa-solid fa-circle-check"></i> Enregistrer</button>-->
            <button class="utm-btn-addCriteres">Ajouter un critère  <i class="fa fa-plus"></i></button>   
        </div>
        <ul class="utm-toggle-list"></ul>
        <!--
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
                        <div class="utm-average-list">
                            <div class="utm-average-row">Moyenne L1</div>
                            <div class="utm-average-row alt">Moyenne L2</div>
                            <div class="utm-average-row">Moyenne L3</div>
                        </div>
                    </div>

-                    <div class="utm-mention-levels">
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
            <span>Note PFE</span>
            <label class="utm-switch">
              <input type="checkbox" class="utm-toggle-input" data-target="#bloc-pfe">
              <span class="utm-slider"></span>
            </label>
          </div>
          <div class="utm-toggle-content" id="bloc-pfe">
            <div class="utm-field">
              <label>Condition</label>
              <input type="text" id="pfe-condition" value="Si Note PFE ≥ 12" value="Si Note PFE ≥ 12">
            </div>
            <div class="utm-field">
              <label>Valeur</label>
              <input type="number" id="pfe-valeur" value="1">
            </div>
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
                        <select name="bonus_condition[0][condition]">
                          <option value="Passable" selected>Passable</option>
                          <option value="Assez bien">Assez bien</option>
                          <option value="Bien">Bien</option>
                          <option value="Très bien">Très bien</option>
                          <option value="Excellent">Excellent</option>
                        </select>

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
                        <select name="bonus_condition[1][condition]">
                          <option value="Passable" selected>Passable</option>
                          <option value="Assez bien">Assez bien</option>
                          <option value="Bien">Bien</option>
                          <option value="Très bien">Très bien</option>
                          <option value="Excellent">Excellent</option>
                        </select>

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
                            <select name="bonus_condition[2][condition]">
                              <option value="Passable" selected>Passable</option>
                              <option value="Assez bien">Assez bien</option>
                              <option value="Bien">Bien</option>
                              <option value="Très bien">Très bien</option>
                              <option value="Excellent">Excellent</option>
                            </select>

                            </div>
                            <div class="utm-field">
                            <label>Valeur</label>
                            <input type="number" name="bonus_condition[2][valeur]" value="1">
                            </div>
                            <div class="utm-actions"></div>
                        </div>

                        <div class="utm-bonus-row">
                            <div class="utm-field">
                            <label>Condition</label>bonus_condition
                            <select name="bonus_condition[3][condition]">
                              <option value="Passable" selected>Passable</option>
                              <option value="Assez bien">Assez bien</option>
                              <option value="Bien">Bien</option>
                              <option value="Très bien">Très bien</option>
                              <option value="Excellent">Excellent</option>
                            </select>

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
                        <select name="bonus_session[0][condition]">
                          <option value="Session principale" selected>Session principale</option>
                          <option value="Session de contrôle">Session de contrôle</option>
                        </select>
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
                         <select name="bonus_session[1][condition]">
                          <option value="Session principale" selected>Session principale</option>
                          <option value="Session de contrôle">Session de contrôle</option>
                        </select>
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

        -->

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
            <div class="utm-formule-box-save">

                <button class="utm-save-btn"><i class="fa-solid fa-circle-check"></i> Enregistrer</button>

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
    background-color: #fff;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    padding: 10px 16px;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    border: 3px solid #b60303;
    color: #b60303;
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
    background-color: #fff;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    padding: 10px 16px;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    border: 3px solid #b60303;
    color: #b60303;
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
button.utm-btn-addCriteres {
    border: none;
    background: none;
    font-size: 18px;
    padding: 9px 14px;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.2s, color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 0px 13px #0000001F;
    font-size: 15px;
    font-weight: 600;
    border: 3px solid #b60303;
    color: #b60303;
}
button.utm-btn-addCriteres i.fa.fa-plus {
    margin-left: 7px;
}
.utm-formule-box-save {
    border: 1px solid #A6A485;
    border-radius: 10px;
    background-color: #fff;
    margin-top: 25px;
    overflow: hidden;
    padding: 20px;
}
/* Centrage horizontal des boutons radio */
.bl-radio {
  display: flex;
  justify-content: center;
  gap: 30px; /* espace entre les deux options */
  margin-top: 10px;
}

/* Style des labels */
.bl-radio label {
  font-weight: 500;
  color: #333;
  font-size: 15px;
  display: flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
}

.bl-radio input[type="radio"] {
    appearance: none;
    width: 6px;
    height: 8px;
    border: 2px solid #c80000;
    border-radius: 50%;
    position: relative;
    cursor: pointer;
    outline: none;
    padding: 7px 7px;
    /* padding-top: 6px; */
}



.bl-radio input[type="radio"]:checked::before {
  content: '';
  position: absolute;
  top: 3px;
  left: 3px;
  width: 8px;
  height: 8px;
  background-color: #c80000; /* rouge rempli */
  border-radius: 50%;
}
.utm-field.bl-nomcritere {
    display: flex;
    gap: 10px;
    background-color: #f9f9f4;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 8px;
}

input.utm-custom-label:focus-visible {
    padding: 5px 0px;
    border: 1px solid #ddd !important;
    outline-offset: 0px;
    outline: -webkit-focus-ring-color auto 1px !important;
}

.utm-intervalle-row {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    background-color: #f9f9f4;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 8px;
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
/*
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
    //const inputs = row.querySelectorAll('input');
    const inputs = row.querySelectorAll('select');
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
      <select name="bonus_condition[${newIndex}][condition]">
        <option value="Passable" selected>Passable</option>
        <option value="Assez bien">Assez bien</option>
        <option value="Bien">Bien</option>
        <option value="Très bien">Très bien</option>
        <option value="Excellent">Excellent</option>
      </select>

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
      <select name="bonus_session[${newIndex}][condition]">
              <option value="Session principale" selected>Session principale</option>
              <option value="Session de contrôle">Session de contrôle</option>
      </select>
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
*/
function toggleFormuleBody() {
  const body = document.getElementById('utm-formule-body');
  const icon = document.getElementById('utm-formule-icon');
  const isVisible = body.style.display !== 'none';

  body.style.display = isVisible ? 'none' : 'block';
  icon.className = isVisible ? 'fa fa-chevron-down' : 'fa fa-chevron-up';
}







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





/***** imen, hnayet */







/*
document.addEventListener('DOMContentLoaded', function () {
  const addBtn = document.querySelector('.utm-btn-addCriteres');
  const toggleList = document.querySelector('.utm-toggle-list');

  // Fonction pour activer/désactiver les blocs en fonction de la checkbox
  function attachToggleSwitchEvents(scope = document) {
    const toggleInputs = scope.querySelectorAll('.utm-toggle-input');
    toggleInputs.forEach(input => {
      const targetId = input.getAttribute('data-target');
      const target = document.querySelector(targetId);
      if (!target) return;

      // État initial
      target.style.display = input.checked ? 'block' : 'none';

      // Changement dynamique
      input.addEventListener('change', () => {
        target.style.display = input.checked ? 'block' : 'none';
      });
    });
  }

  addBtn.addEventListener('click', () => {
    const uniqueId = Date.now();
    const targetId = `bloc-custom-${uniqueId}`;
    const radioName = `type-${uniqueId}`;

    const newLi = document.createElement('li');

    newLi.innerHTML = `
        <div class="utm-toggle-row">
          <input type="text" class="utm-custom-label" placeholder="Nom du critère" style="font-weight: bold; border: none; background: transparent; width: auto; font-size: 18px;font-weight: 600;">
          <label class="utm-switch">
            <input type="checkbox" class="utm-toggle-input" data-target="#${targetId}">
            <span class="utm-slider"></span>
          </label>
        </div>

        <div class="utm-toggle-content" id="${targetId}">
          <div class="utm-field">
            <label>Type</label><br>
            <div class="bl-radio">
              <label><input type="radio" name="${radioName}" value="critere" checked> Critère</label>
              <label><input type="radio" name="${radioName}" value="critere_condition"> Critère + Condition</label>
            </div>
          </div>

          <div class="utm-custom-critere">
            <div class="utm-field bl-nomcritere">
              <label>Nom du critère</label>
              <input type="text" name="custom_critere[]" placeholder="">
            </div>
          </div>

          <div class="utm-custom-condition" style="display: none;">
            <div id="utm-custom-condition-container">
              <div class="utm-bonus-row">
                <div class="utm-field">
                  <label>Condition</label>
                  <input type="text" name="custom_condition[0][condition]" placeholder="Ex. Si note ≥ 12">
                </div>
                <div class="utm-field">
                  <label>Valeur</label>
                  <input type="number" name="custom_condition[0][valeur]" placeholder="Valeur">
                </div>
                <div class="utm-actions">
                  <button type="button" class="utm-btn-add"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;



    toggleList.appendChild(newLi);

    // Activer le toggle display pour le nouveau bloc
    attachToggleSwitchEvents(newLi);

    // Gérer le changement radio (critère / critère + condition)
    const radios = newLi.querySelectorAll(`input[type="radio"][name="${radioName}"]`);
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const isCondition = newLi.querySelector(`input[value="critere_condition"]`).checked;
        newLi.querySelector('.utm-custom-condition').style.display = isCondition ? 'block' : 'none';
      });


      const conditionContainer = newLi.querySelector('#utm-custom-condition-container');
      let conditionIndex = 1;

      conditionContainer.addEventListener('click', function (e) {
        if (e.target.closest('.utm-btn-add')) {
          const row = document.createElement('div');
          row.className = 'utm-bonus-row';
          row.innerHTML = `
            <div class="utm-field">
              <label>Condition</label>
              <input type="text" name="custom_condition[${conditionIndex}][condition]" placeholder="Ex. Si note ≥ 12">
            </div>
            <div class="utm-field">
              <label>Valeur</label>
              <input type="number" name="custom_condition[${conditionIndex}][valeur]" placeholder="Valeur">
            </div>
            <div class="utm-actions">
              <button type="button" class="utm-btn-delete"><i class="fa fa-trash"></i></button>
            </div>
          `;
          conditionContainer.appendChild(row);
          conditionIndex++;
        } else if (e.target.closest('.utm-btn-delete')) {
          const row = e.target.closest('.utm-bonus-row');
          if (row) row.remove();
        }
      });

    });
  });

  // Activation initiale sur les blocs déjà dans la page
  attachToggleSwitchEvents();
});
*/

document.addEventListener('DOMContentLoaded', function () {
  const addBtn = document.querySelector('.utm-btn-addCriteres');
  const toggleList = document.querySelector('.utm-toggle-list');

  function attachToggleSwitchEvents(scope = document) {
    const toggleInputs = scope.querySelectorAll('.utm-toggle-input');
    toggleInputs.forEach(input => {
      const targetId = input.getAttribute('data-target');
      const target = document.querySelector(targetId);
      if (!target) return;

      target.style.display = input.checked ? 'block' : 'none';

      input.addEventListener('change', () => {
        target.style.display = input.checked ? 'block' : 'none';
      });
    });
  }

  addBtn.addEventListener('click', () => {
    const uniqueId = Date.now();
    const targetId = `bloc-custom-${uniqueId}`;
    const radioName = `type-${uniqueId}`;

    const newLi = document.createElement('li');
    newLi.innerHTML = `
      <div class="utm-toggle-row">
        <input type="text" class="utm-custom-label" placeholder="Nom du critère" style="font-weight: bold; border: none; background: transparent; width: auto; font-size: 18px;font-weight: 600;">
        <label class="utm-switch">
          <input type="checkbox" class="utm-toggle-input" data-target="#${targetId}">
          <span class="utm-slider"></span>
        </label>
      </div>

      <div class="utm-toggle-content" id="${targetId}">
        <div class="utm-field">
          <label>Type</label><br>
          <div class="bl-radio">
            <label><input type="radio" name="${radioName}" value="critere" checked> Critère</label>
            <label><input type="radio" name="${radioName}" value="critere_condition"> Critère avec Intervalle</label>
          </div>
        </div>

        <div class="utm-custom-critere">
          <div class="utm-field bl-nomcritere">
            <label>Nom du critère</label>
            <input type="text" name="custom_critere[]" placeholder="">
          </div>
        </div>

        <div class="utm-custom-condition" style="display: none;">
          <div id="utm-custom-condition-container">
            <div class="utm-intervalle-row">
              <div class="utm-field">
                <label>Min</label>
                <input type="number" name="custom_condition[0][min]" step="0.01" placeholder="Ex. 12">
              </div>
              <div class="utm-field">
                <label>Max</label>
                <input type="number" name="custom_condition[0][max]" step="0.01" placeholder="Ex. 20">
              </div>
              <div class="utm-field">
                <label>Valeur</label>
                <input type="number" name="custom_condition[0][valeur]" placeholder="Valeur">
              </div>
              <div class="utm-actions">
                <button type="button" class="utm-btn-add"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    toggleList.appendChild(newLi);
    attachToggleSwitchEvents(newLi);

    const radios = newLi.querySelectorAll(`input[type="radio"][name="${radioName}"]`);
    const conditionBlock = newLi.querySelector('.utm-custom-condition');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const isIntervalle = newLi.querySelector(`input[value="critere_condition"]`).checked;
        conditionBlock.style.display = isIntervalle ? 'block' : 'none';
      });
    });

    const conditionContainer = newLi.querySelector('#utm-custom-condition-container');
    let conditionIndex = 1;

    conditionContainer.addEventListener('click', function (e) {
      if (e.target.closest('.utm-btn-add')) {
        const row = document.createElement('div');
        row.className = 'utm-intervalle-row';
        row.innerHTML = `
          <div class="utm-field">
            <label>Min</label>
            <input type="number" name="custom_condition[${conditionIndex}][min]" step="0.01" placeholder="Min">
          </div>
          <div class="utm-field">
            <label>Max</label>
            <input type="number" name="custom_condition[${conditionIndex}][max]" step="0.01" placeholder="Max">
          </div>
          <div class="utm-field">
            <label>Valeur</label>
            <input type="number" name="custom_condition[${conditionIndex}][valeur]" placeholder="Valeur">
          </div>
          <div class="utm-actions">
            <button type="button" class="utm-btn-delete"><i class="fa fa-trash"></i></button>
          </div>`;
        conditionContainer.appendChild(row);
        conditionIndex++;
      } else if (e.target.closest('.utm-btn-delete')) {
        const row = e.target.closest('.utm-intervalle-row');
        if (row) row.remove();
      }
    });
  });

  attachToggleSwitchEvents();
});



/*

document.addEventListener('DOMContentLoaded', function () {
  fetch('/wp-json/plateforme-master/v1/score-templates')
    .then(response => response.json())
    .then(templates => {
      const list = document.querySelector('.utm-toggle-list');
      templates.forEach(tpl => {
        const liHTML = renderScoreTemplate(tpl);
        list.insertAdjacentHTML('beforeend', liHTML);
      });

      attachToggleEvents();
    })
    .catch(error => {
      console.error('Erreur lors du chargement des templates :', error);
    });
});

function renderScoreTemplate(template) {
  const targetId = `bloc-${template.nom_template}`;
  const config = template.config_json ? JSON.parse(template.config_json) : {};

  let contentHTML = '';

  switch (template.type) {
    case 'moyenne':
      contentHTML = `
        <div class="utm-average-section">
          <div class="utm-average-list">
            <div class="utm-average-row">Moyenne L1</div>
            <div class="utm-average-row alt">Moyenne L2</div>
            <div class="utm-average-row">Moyenne L3</div>
          </div>
        </div>
        <div class="utm-mention-levels">
          ${(config.mention_levels || []).map(level =>
            `<label><input type="checkbox" name="mention_levels[]" value="${level}" checked> ${capitalize(level)}</label>`).join('')}
        </div>`;
      break;

    case 'credits':
      contentHTML = `
        <div class="utm-credit-section">
          <div class="utm-credit-left">
            <div class="utm-credit-row">CR1 L1</div>
            <div class="utm-credit-row alt">CR2 L2</div>
            <div class="utm-credit-row">CR3 L3</div>
          </div>
          <div class="utm-credit-formule">
            <span>Formule BCR</span>
          </div>
        </div>`;
      break;

    case 'pfe':
      contentHTML = `
        <div class="utm-field">
          <label>Condition</label>
          <input type="text" value="${config.condition || 'Si Note PFE ≥ 12'}">
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" value="${config.valeur || 1}">
        </div>`;
      break;

    case 'matieres':
      contentHTML = `
        <div id="utm-matiere-container">
          ${(config.matieres || []).map(m =>
            `<div class="utm-matiere-row">
              <div class="utm-field"><label>Matière</label><input type="text" value="${m.nom}"></div>
              <div class="utm-field"><label>Année</label>
                <select>
                  <option${m.annee === 'Première année' ? ' selected' : ''}>Première année</option>
                  <option${m.annee === 'Deuxième année' ? ' selected' : ''}>Deuxième année</option>
                  <option${m.annee === 'Troisième année' ? ' selected' : ''}>Troisième année</option>
                </select>
              </div>
              <div class="utm-field"><label>Note</label><input type="number" value="${m.note}"></div>
            </div>`).join('')}
        </div>`;
      break;

    case 'bonus_mention':
    case 'bonus_session':
      contentHTML = `
        <div class="utm-bonus-container">
          ${(config.conditions || []).map((item, index) =>
            `<div class="utm-bonus-row">
              <div class="utm-field">
                <label>${template.type === 'bonus_mention' ? 'Condition' : 'Session'}</label>
                <select name="${template.nom_template}[${index}][condition]">
                  ${(config.conditions || []).map(opt =>
                    `<option value="${opt.condition}"${opt.condition === item.condition ? ' selected' : ''}>${opt.condition}</option>`).join('')}
                </select>
              </div>
              <div class="utm-field">
                <label>Valeur</label>
                <input type="number" name="${template.nom_template}[${index}][valeur]" value="${item.valeur}">
              </div>
            </div>`).join('')}
        </div>`;
      break;

    case 'malus':
    case 'interruption':
      contentHTML = `
        <div class="utm-bonus-container">
          ${(config.conditions || []).map((c, i) =>
            `<div class="utm-bonus-row">
              <div class="utm-field">
                <label>Condition</label>
                <input type="text" name="${template.nom_template}[${i}][condition]" value="${c.condition}">
              </div>
              <div class="utm-field">
                <label>Valeur</label>
                <input type="number" name="${template.nom_template}[${i}][valeur]" value="${c.valeur}">
              </div>
            </div>`).join('')}
          ${template.type === 'malus' && config.mention_levels ? `
            <div class="utm-mention-levels">
              ${config.mention_levels.map(level =>
                `<label><input type="checkbox" name="malus_levels[]" value="${level}" checked> ${capitalize(level)}</label>`
              ).join('')}
            </div>` : ''}
        </div>`;
      break;

    default:
      contentHTML = `
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" placeholder="Valeur du critère">
        </div>`;
      break;
  }

  return `
    <li>
      <div class="utm-toggle-row">
        <span>${template.titre_affiche}</span>
        <label class="utm-switch">
          <input type="checkbox" class="utm-toggle-input" data-target="#${targetId}" checked>
          <span class="utm-slider"></span>
        </label>
      </div>
      <div class="utm-toggle-content" id="${targetId}" style="display: block;">
        ${contentHTML}
      </div>
    </li>`;
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1).replace('_', ' ');
}

function attachToggleEvents() {
  document.querySelectorAll('.utm-toggle-input').forEach(input => {
    const target = document.querySelector(input.dataset.target);
    if (target) {
      input.addEventListener('change', () => {
        target.style.display = input.checked ? 'block' : 'none';
      });
    }
  });
}

*/



document.addEventListener('DOMContentLoaded', function () {
  fetch('/wp-json/plateforme-master/v1/score-templates')
    .then(response => response.json())
    .then(templates => {
      const list = document.querySelector('.utm-toggle-list');
      templates.forEach(tpl => {
        const li = renderScoreTemplate(tpl);
        list.appendChild(li);
      });

      attachToggleEvents();
    })
    .catch(error => {
      console.error('Erreur lors du chargement des templates :', error);
    });
});



function renderScoreTemplate(template) {
  const targetId = `bloc-${template.nom_template}`;
  const config = template.config_json ? JSON.parse(template.config_json) : {};
  let contentHTML = '';

  switch (template.type) {
    case 'moyenne':
      contentHTML = `
        <div class="utm-average-section">
          <div class="utm-average-list">
            <div class="utm-average-row">Moyenne L1</div>
            <div class="utm-average-row alt">Moyenne L2</div>
            <div class="utm-average-row">Moyenne L3</div>
          </div>
        </div>
        <div class="utm-mention-levels">
          ${(config.mention_levels || []).map(level =>
            `<label><input type="checkbox" name="mention_levels[]" value="${level}" checked> ${capitalize(level)}</label>`).join('')}
        </div>`;
      break;

    case 'credits':
      contentHTML = `
        <div class="utm-credit-section">
          <div class="utm-credit-left">
            <div class="utm-credit-row">CR1 L1</div>
            <div class="utm-credit-row alt">CR2 L2</div>
            <div class="utm-credit-row">CR3 L3</div>
          </div>
          <div class="utm-credit-formule">
            <span>Formule BCR</span>
          </div>
        </div>`;
      break;

    case 'pfe':
    const intervalle = config.intervalle || [];
    contentHTML = `
      <div class="utm-intervalle-container" id="${template.nom_template}-container">
        ${intervalle.map((item, index) => `
          <div class="utm-intervalle-row">
            <div class="utm-field">
              <label>Note min</label>
              <input type="number" name="${template.nom_template}[${index}][min]" value="${item.min}" step="0.01">
            </div>
            <div class="utm-field">
              <label>Note max</label>
              <input type="number" name="${template.nom_template}[${index}][max]" value="${item.max}" step="0.01">
            </div>
            <div class="utm-field">
              <label>Valeur</label>
              <input type="number" name="${template.nom_template}[${index}][valeur]" value="${item.valeur}" step="0.01">
            </div>
      <!--  <div class="utm-actions">
              <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
              <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
            </div>-->
          </div>
        `).join('')}
      </div>`;
    break;


    case 'matieres':
    contentHTML = `
      <div id="utm-matiere-container">
        ${(config.matieres || []).map((m, index) =>
          `<div class="utm-matiere-row">
            <div class="utm-field"><label>Matière</label><input type="text" name="matiere[${index}][nom]" value="${m.nom}"></div>
            <div class="utm-field"><label>Année</label>
              <select name="matiere[${index}][annee]">
                <option${m.annee === 'Première année' ? ' selected' : ''}>Première année</option>
                <option${m.annee === 'Deuxième année' ? ' selected' : ''}>Deuxième année</option>
                <option${m.annee === 'Troisième année' ? ' selected' : ''}>Troisième année</option>
              </select>
            </div>
            <div class="utm-field"><label>Note</label><input type="number" name="matiere[${index}][note]" value="${m.note}"></div>
            <div class="utm-actions">
              <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
              <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
            </div>
          </div>`).join('')}
      </div>`;
    break;


    case 'bonus_session':
      contentHTML = `
        <div class="utm-bonus-container" id="${template.nom_template}-container">
          ${(config.conditions || []).map((item, index) =>
            `<div class="utm-bonus-row">
              <div class="utm-field">
                <label>${template.type === 'bonus_mention' ? 'Condition' : 'Session'}</label>
                <select name="${template.nom_template}[${index}][condition]">
                  ${(config.conditions || []).map(opt =>
                    `<option value="${opt.condition}"${opt.condition === item.condition ? ' selected' : ''}>${opt.condition}</option>`).join('')}
                </select>
              </div>
              <div class="utm-field">
                <label>Valeur</label>
                <input type="number" name="${template.nom_template}[${index}][valeur]" value="${item.valeur}">
              </div>
        <!--  <div class="utm-actions">
                <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
                <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
              </div>-->
            </div>`).join('')}
        </div>`;
      break;

      case 'bonus_mention':
        contentHTML = `
          <div class="utm-bonus-container" id="bonus_mention-container">
            ${(config.bonus_mention || []).flatMap((group, groupIndex) =>
              group.mentions.map((item, index) => `
                <div class="utm-bonus-row">
                  <div class="utm-field">
                    <label>Année</label>
                    <select name="bonus_mention[${groupIndex}][annee]">
                      <option value="Première année"${group.annee === 'Première année' ? ' selected' : ''}>Première année</option>
                      <option value="Deuxième année"${group.annee === 'Deuxième année' ? ' selected' : ''}>Deuxième année</option>
                      <option value="Troisième année"${group.annee === 'Troisième année' ? ' selected' : ''}>Troisième année</option>
                    </select>
                  </div>
                  <div class="utm-field">
                    <label>Condition</label>
                    <select name="bonus_mention[${groupIndex}][mentions][${index}][condition]">
                      <option value="Passable"${item.condition === 'Passable' ? ' selected' : ''}>Passable</option>
                      <option value="Assez bien"${item.condition === 'Assez bien' ? ' selected' : ''}>Assez bien</option>
                      <option value="Bien"${item.condition === 'Bien' ? ' selected' : ''}>Bien</option>
                      <option value="Très bien"${item.condition === 'Très bien' ? ' selected' : ''}>Très bien</option>
                      <option value="Excellent"${item.condition === 'Excellent' ? ' selected' : ''}>Excellent</option>
                    </select>
                  </div>
                  <div class="utm-field">
                    <label>Valeur</label>
                    <input type="number" name="bonus_mention[${groupIndex}][mentions][${index}][valeur]" value="${item.valeur}">
                  </div>
                  <div class="utm-actions">
                    <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
                    <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              `)
            ).join('')}
          </div>`;
        break;


   case 'malus':
  
    contentHTML = `
      <div class="utm-bonus-container" id="${template.nom_template}-container">
        ${(config.conditions || []).map((c, i) =>
          `<div class="utm-bonus-row">
            <div class="utm-field">
              <label>Condition</label>
              <input type="text" name="${template.nom_template}[${i}][condition]" value="${c.condition}">
            </div>
            <div class="utm-field">
              <label>Valeur</label>
              <input type="number" name="${template.nom_template}[${i}][valeur]" value="${c.valeur}">
            </div>
      <!--  <div class="utm-actions">
              <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
              <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
            </div>-->
          </div>`).join('')}
        ${template.type === 'malus' && config.mention_levels ? `
          <div class="utm-mention-levels">
            ${config.mention_levels.map(level =>
              `<label><input type="checkbox" name="malus_levels[]" value="${level}" checked> ${capitalize(level)}</label>`).join('')}
          </div>` : ''}
      </div>`;
    break;

    case 'interruption':
      if (Array.isArray(config.intervalle)) {
        contentHTML = `
          <div class="utm-intervalle-container" id="${template.nom_template}-container">
            ${config.intervalle.map((item, index) => `
              <div class="utm-intervalle-row">
                <div class="utm-field">
                  <label>Min (années)</label>
                  <input type="number" name="${template.nom_template}[${index}][min]" value="${item.min}" step="0.01">
                </div>
                <div class="utm-field">
                  <label>Max (années)</label>
                  <input type="number" name="${template.nom_template}[${index}][max]" value="${item.max}" step="0.01">
                </div>
                <div class="utm-field">
                  <label>Valeur</label>
                  <input type="number" name="${template.nom_template}[${index}][valeur]" value="${item.valeur}" step="0.01">
                </div>
            <!--<div class="utm-actions">
                  <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
                  <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
                </div>-->
              </div>
            `).join('')}
          </div>`;
      } else if (Array.isArray(config.conditions)) {
        // Ancienne version fallback (avec condition texte)
        contentHTML = `
          <div class="utm-bonus-container" id="${template.nom_template}-container">
            ${config.conditions.map((c, i) =>
              `<div class="utm-bonus-row">
                <div class="utm-field">
                  <label>Condition</label>
                  <input type="text" name="${template.nom_template}[${i}][condition]" value="${c.condition}">
                </div>
                <div class="utm-field">
                  <label>Valeur</label>
                  <input type="number" name="${template.nom_template}[${i}][valeur]" value="${c.valeur}">
                </div>
                <div class="utm-actions">
                  <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
                  <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
                </div>
              </div>`).join('')}
          </div>`;
      } else {
        // Si aucun des deux, vide
        contentHTML = `<p style="color:gray;">Aucune configuration disponible pour interruption.</p>`;
      }
  break;



   /* default:
      contentHTML = `
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" placeholder="Valeur du critère">
        </div>`;
      break;*/

    /*fault:
      if (template.type === 'critere') {
        contentHTML = `
          <div class="utm-field">
            <label>Valeur</label>
            <input type="number" name="${template.nom_template}[valeur]" value="${config.valeur ?? ''}" placeholder="Valeur du critère">
          </div>`;
      } else if (template.type === 'critere_condition') {
        contentHTML = `
          <div class="utm-custom-condition">
            ${(Array.isArray(config) ? config : []).map((row, i) => `
              <div class="utm-bonus-row">
                <div class="utm-field">
                  <label>Condition</label>
                  <input type="text" name="custom_condition[${i}][condition]" value="${row.condition}" placeholder="Ex. Si note ≥ 12">
                </div>
                <div class="utm-field">
                  <label>Valeur</label>
                  <input type="number" name="custom_condition[${i}][valeur]" value="${row.valeur}" placeholder="Valeur">
                </div>
                <div class="utm-actions">
                  <button type="button" class="utm-btn-add"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            `).join('')}
          </div>`;
      } else {
        contentHTML = `
          <div class="utm-field">
            <label>Valeur</label>
            <input type="number" name="${template.nom_template}[valeur]" placeholder="Valeur du critère">
          </div>`;
      }
      break;*/
         default: {
            const intervalle = (Array.isArray(config?.intervalle) ? config.intervalle : []);
            const radioName = `type-${template.nom_template}`;
            const isCondition = template.type === 'critere_condition';

            contentHTML = `
              <div class="utm-field">
                <label>Type</label><br>
                <div class="bl-radio">
                  <label><input type="radio" name="${radioName}" value="critere" ${!isCondition ? 'checked' : ''}> Critère</label>
                  <label><input type="radio" name="${radioName}" value="critere_condition" ${isCondition ? 'checked' : ''}> Critère avec Condition</label> 
                </div>
              </div>

              <div class="utm-field utm-critere-block" style="${!isCondition ? '' : 'display:none;'}">
                <label>Nom du critère</label>
                <input type="text" name="${template.nom_template}[nom]" value="${template.titre_affiche ?? ''}" placeholder="Nom du critère">
              </div>

              <div class="utm-custom-condition" style="${isCondition ? 'display:block;' : 'display:none;'}">
                <div id="utm-custom-condition-container">
                  ${intervalle.map((row, i) => `
                    <div class="utm-intervalle-row">
                      <div class="utm-field">
                        <label>Min</label>
                        <input type="number" name="custom_condition[${i}][min]" value="${row.min ?? ''}" step="0.01" placeholder="Ex. 12">
                      </div>
                      <div class="utm-field">
                        <label>Max</label>
                        <input type="number" name="custom_condition[${i}][max]" value="${row.max ?? ''}" step="0.01" placeholder="Ex. 20">
                      </div>
                      <div class="utm-field">
                        <label>Valeur</label>
                        <input type="number" name="custom_condition[${i}][valeur]" value="${row.valeur ?? ''}" step="0.01" placeholder="Valeur">
                      </div>
                      <div class="utm-actions">
                        <button type="button" class="utm-btn-add"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  `).join('')}
                </div>
              </div>
            `;
            break;
          }



  }

  const li = document.createElement('li');
  li.innerHTML = `
    <div class="utm-toggle-row">
      <span>${template.titre_affiche}</span>
      <label class="utm-switch">
        <input type="checkbox" class="utm-toggle-input" data-target="#${targetId}">
        <span class="utm-slider"></span>
      </label>
    </div>
    <div class="utm-toggle-content" id="${targetId}" style="display: none;">
      ${contentHTML}
    </div>`;

  return li;
}

function attachToggleEvents() {
  document.querySelectorAll('.utm-toggle-input').forEach(input => {
    const target = document.querySelector(input.dataset.target);
    if (target) {
      input.addEventListener('change', () => {
        target.style.display = input.checked ? 'block' : 'none';
      });
    }
  });
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1).replace('_', ' ');
}


document.addEventListener('click', function (e) {
  const addBtn = e.target.closest('.utm-btn-add');
  const delBtn = e.target.closest('.utm-btn-delete');

  if (addBtn) {
    const row = addBtn.closest('.utm-bonus-row') || addBtn.closest('.utm-matiere-row');
    const container = row?.parentElement;
    const type = detectRowType(container);

    if (!container || !type) return;

    const index = container.querySelectorAll(`.${type.rowClass}`).length;
    const newRow = document.createElement('div');
    newRow.className = type.rowClass;
    newRow.innerHTML = type.getHTML(index);
    container.appendChild(newRow);
  }

  if (delBtn) {
    const row = delBtn.closest('.utm-bonus-row') || delBtn.closest('.utm-matiere-row');
    if (row) row.remove();
  }
});


/*
function detectRowType(container) {
  const id = container?.id;

  if (id === 'utm-matiere-container') {
    return {
      rowClass: 'utm-matiere-row',
          getHTML: (i) => `
            <div class="utm-field">
              <label>Matière</label>
              <input type="text" name="matiere[${i}][nom]" placeholder="Matière">
            </div>
            <div class="utm-field">
              <label>Année</label>
              <select name="matiere[${i}][annee]">
                <option>Première année</option>
                <option>Deuxième année</option>
                <option>Troisième année</option>
              </select>
            </div>
            <div class="utm-field">
              <label>Note</label>
              <input type="number" name="matiere[${i}][note]" placeholder="Note">
            </div>
            <div class="utm-actions">
              <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
              <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
            </div>`
        };
      }

      // Extraction dynamique du type depuis l'ID (ex: bonus_mention-container)
      const match = id?.match(/^(.+)-container$/);
      const key = match?.[1];

      if (!key || !['bonus_mention', 'bonus_session', 'malus', 'interruption'].includes(key)) return null;

      return {
        rowClass: 'utm-bonus-row',
      getHTML: (i) => {
      if (key === 'bonus_mention') {
        return `
          <div class="utm-field">
            <label>Année</label>
            <select name="${key}[${i}][annee]">
              <option value="Première année">Première année</option>
              <option value="Deuxième année">Deuxième année</option>
              <option value="Troisième année">Troisième année</option>
            </select>
          </div>
          <div class="utm-field">
            <label>Condition</label>
            <select name="${key}[${i}][mentions][0][condition]">
              <option value="Passable">Passable</option>
              <option value="Assez bien">Assez bien</option>
              <option value="Bien">Bien</option>
              <option value="Très bien">Très bien</option>
              <option value="Excellent">Excellent</option>
            </select>
          </div>
          <div class="utm-field">
            <label>Valeur</label>
            <input type="number" name="${key}[${i}][mentions][0][valeur]" placeholder="Valeur">
          </div>
          <div class="utm-actions">
            <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
            <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
          </div>`;
      }

      if (key === 'bonus_session') {
        return `
          <div class="utm-field">
            <label>Session</label>
            <select name="${key}[${i}][condition]">
              <option value="Session principale">Session principale</option>
              <option value="Session de contrôle">Session de contrôle</option>
            </select>
          </div>
          <div class="utm-field">
            <label>Valeur</label>
            <input type="number" name="${key}[${i}][valeur]" placeholder="Valeur">
          </div>
          <div class="utm-actions">
            <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
            <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
          </div>`;
      }

      // For malus or interruption
      return `
        <div class="utm-field">
          <label>Condition</label>
          <input type="text" name="${key}[${i}][condition]" placeholder="Condition">
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" name="${key}[${i}][valeur]" placeholder="Valeur">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`;
    }

  };
}
*/


function detectRowType(container) {
  const id = container?.id;

  // 1. Bloc matières
  if (id === 'utm-matiere-container') {
    return {
      rowClass: 'utm-matiere-row',
      getHTML: (i) => `
        <div class="utm-field">
          <label>Matière</label>
          <input type="text" name="matiere[${i}][nom]" placeholder="Matière">
        </div>
        <div class="utm-field">
          <label>Année</label>
          <select name="matiere[${i}][annee]">
            <option>Première année</option>
            <option>Deuxième année</option>
            <option>Troisième année</option>
          </select>
        </div>
        <div class="utm-field">
          <label>Note</label>
          <input type="number" name="matiere[${i}][note]" placeholder="Note">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`
    };
  }

  // 2. Autres types (bonus, malus, interruption, note_pfe...)
  const match = id?.match(/^(.+)-container$/);
  const key = match?.[1];

  if (!key) return null;

  // 3. Bloc avec intervalle (note_pfe, annee_dinterruption)
  if (['note_pfe', 'annee_dinterruption'].includes(key)) {
    return {
      rowClass: 'utm-intervalle-row',
      getHTML: (i) => `
        <div class="utm-field">
          <label>Min</label>
          <input type="number" name="${key}[${i}][min]" placeholder="Min" step="0.01">
        </div>
        <div class="utm-field">
          <label>Max</label>
          <input type="number" name="${key}[${i}][max]" placeholder="Max" step="0.01">
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" name="${key}[${i}][valeur]" placeholder="Valeur" step="0.01">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`
    };
  }

  // 4. Bloc bonus_mention
  if (key === 'bonus_mention') {
    return {
      rowClass: 'utm-bonus-row',
      getHTML: (i) => `
        <div class="utm-field">
          <label>Année</label>
          <select name="${key}[${i}][annee]">
            <option value="Première année">Première année</option>
            <option value="Deuxième année">Deuxième année</option>
            <option value="Troisième année">Troisième année</option>
          </select>
        </div>
        <div class="utm-field">
          <label>Condition</label>
          <select name="${key}[${i}][mentions][0][condition]">
            <option value="Passable">Passable</option>
            <option value="Assez bien">Assez bien</option>
            <option value="Bien">Bien</option>
            <option value="Très bien">Très bien</option>
            <option value="Excellent">Excellent</option>
          </select>
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" name="${key}[${i}][mentions][0][valeur]" placeholder="Valeur">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`
    };
  }

  // 5. Bloc bonus_session
  if (key === 'bonus_session') {
    return {
      rowClass: 'utm-bonus-row',
      getHTML: (i) => `
        <div class="utm-field">
          <label>Session</label>
          <select name="${key}[${i}][condition]">
            <option value="Session principale">Session principale</option>
            <option value="Session de contrôle">Session de contrôle</option>
          </select>
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" name="${key}[${i}][valeur]" placeholder="Valeur">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`
    };
  }

  // 6. Bloc malus ou interruption avec conditions textuelles
  if (['malus', 'interruption'].includes(key)) {
    return {
      rowClass: 'utm-bonus-row',
      getHTML: (i) => `
        <div class="utm-field">
          <label>Condition</label>
          <input type="text" name="${key}[${i}][condition]" placeholder="Condition">
        </div>
        <div class="utm-field">
          <label>Valeur</label>
          <input type="number" name="${key}[${i}][valeur]" placeholder="Valeur">
        </div>
        <div class="utm-actions">
          <button class="utm-btn-delete" type="button"><i class="fa fa-trash"></i></button>
          <button class="utm-btn-add" type="button"><i class="fa fa-plus"></i></button>
        </div>`
    };
  }

  return null;
}


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


  /*
  // Injecte automatiquement les options des critères cochés au chargement
  document.querySelectorAll('.utm-toggle-input:checked').forEach(toggle => {
    const labelText = toggle.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
    if (!labelText) return;

    
     const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);
      if (!exists) {
        const opt = document.createElement('option');
        opt.text = labelText;
        opt.value = labelText;
        selectCritere.appendChild(opt);
      }

  });

  // Gère les ajouts/retraits dynamiques
  document.addEventListener('change', function (e) {
    const toggle = e.target.closest('.utm-toggle-input');
    if (!toggle) return;

    const selectCritere = document.getElementById('select_critere');
    const labelText = toggle.closest('.utm-toggle-row')?.querySelector('span')?.innerText?.trim();
    if (!labelText || !selectCritere) return;

    const exists = Array.from(selectCritere.options).some(opt => opt.text === labelText);

    if (toggle.checked && !exists) {
      const opt = document.createElement('option');
      opt.text = labelText;
      opt.value = labelText;
      selectCritere.appendChild(opt);
    } else if (!toggle.checked && exists) {
      Array.from(selectCritere.options).forEach((opt, i) => {
        if (opt.text === labelText) selectCritere.remove(i);
      });
    }
  });
  */

// Injecte automatiquement les options des critères cochés au chargement
document.querySelectorAll('.utm-toggle-input:checked').forEach(toggle => {
  const labelText = getCritereLabel(toggle);
  if (!labelText) return;

  const selectCritere = document.getElementById('select_critere');
  if (!selectCritere) return;

  injectCritereOptions(selectCritere, labelText, true);
});

// Gère les ajouts/retraits dynamiques de critères
document.addEventListener('change', function (e) {
  const toggle = e.target.closest('.utm-toggle-input');
  if (!toggle) return;

  const labelText = getCritereLabel(toggle);
  const selectCritere = document.getElementById('select_critere');
  if (!labelText || !selectCritere) return;

  injectCritereOptions(selectCritere, labelText, toggle.checked);
});

// 🔁 Injecte ou supprime des options selon le label
function injectCritereOptions(select, labelText, add) {
  const valuesToManage = {
    'moyenne arithmétique': ['Moyenne L1', 'Moyenne L2', 'Moyenne L3'],
    'crédits': ['CR1 L1', 'CR2 L2', 'CR3 L3']
  };

  const labelKey = labelText.toLowerCase();

  const items = valuesToManage[labelKey] || [labelText];

  items.forEach(text => {
    const exists = Array.from(select.options).some(opt => opt.text === text);

    if (add && !exists) {
      const opt = document.createElement('option');
      opt.text = text;
      opt.value = text;
      select.appendChild(opt);
    }

    if (!add && exists) {
      Array.from(select.options).forEach((opt, i) => {
        if (opt.text === text) select.remove(i);
      });
    }
  });
}

// 🔧 Fonction utilitaire : récupère le nom du critère
function getCritereLabel(toggle) {
  const wrapper = toggle.closest('.utm-toggle-row');
  const inputLabel = wrapper?.querySelector('input.utm-custom-label')?.value?.trim();
  const spanLabel = wrapper?.querySelector('span')?.innerText?.trim();
  return inputLabel || spanLabel || null;
}



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
  // version 12/06/2025 
  /*
  document.querySelector('.utm-save-btn').addEventListener('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1';
    const masterId = parseInt(urlParams.get("id"));

    const checkedLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
    .map(input => input.value);

     const critereMapping = {
      'note pfe': 'pfe',
      'moyenne': 'moyenne',
      'bonus mention': 'bonus_mention',
      'bonus session': 'bonus_session',
      'bonus': 'bonus',
      'malus': 'malus',
      'matières spécifiques': 'matieres',
      'crédits': 'credits'
    };

    const criteres = new Set();
    tokens.forEach(tok => {
      const cleaned = tok.trim().toLowerCase();
      for (const key in critereMapping) {
        if (cleaned.includes(key)) {
          criteres.add(critereMapping[key]);
        }
      }
    });


  
    const data = {
      niveau: currentCycle,
      formule: tokens.join(" "),
      matieres: [],
      bonus_mention: [],
      bonus_session: [],
      malus: [],
      criteres: Array.from(criteres),
      interruption: [],
      levels :checkedLevels,

      
      config_flags: {
        moyenne: document.querySelector('input[data-target="#bloc-l1"]')?.checked ?? false,
        credits: document.querySelector('input[data-target="#bloc-credits"]')?.checked ?? false,
        matieres: document.querySelector('input[data-target="#bloc-matieres"]')?.checked ?? false,
        entretien: document.querySelector('input[data-target="#bloc-entretien"]')?.checked ?? false,
        bonus: document.querySelector('input[data-target="#bloc-bonus"]')?.checked ?? false,
        session: document.querySelector('input[data-target="#bloc-bonus-session"]')?.checked ?? false,
        malus: document.querySelector('input[data-target="#bloc-malus"]')?.checked ?? false,
        interruption: document.querySelector('input[data-target="#bloc-interruption"]')?.checked ?? false,
      },
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
        condition: row.querySelector('select[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    document.querySelectorAll('#utm-bonus-session-container .utm-bonus-row').forEach(row => {
      data.bonus_session.push({
        condition: row.querySelector('select[name*="condition"]').value,
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


    const moyenneActive = document.querySelector('input[data-target="#bloc-l1"]')?.checked;
    const moyenneLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
      .map(input => input.value);

    if (moyenneActive && moyenneLevels.length) {
      data.moyenne_levels = moyenneLevels;
    }

      const pfeCondition = document.getElementById('pfe-condition')?.value.trim();
      const pfeValeur = parseFloat(document.getElementById('pfe-valeur')?.value);
      const pfeActive = document.querySelector('input[data-target="#bloc-pfe"]')?.checked;

      if (pfeActive && pfeCondition && !isNaN(pfeValeur)) {
        data.pfe = {
          condition: pfeCondition,
          valeur: pfeValeur
        };
      }

      console.log(pfeActive);
      console.log(pfeValeur);

      console.log(data.pfe);

     // bloc de nv critère
      data.criteres_personnalises = [];

      document.querySelectorAll('.utm-toggle-list .utm-toggle-row').forEach(row => {
        const toggle = row.querySelector('.utm-toggle-input');
        if (!toggle?.checked) return;

        const customLabelInput = row.querySelector('input.utm-custom-label');
        const customName = customLabelInput?.value?.trim();
        if (!customName) return;

        const bloc = row.nextElementSibling;
        const type = bloc.querySelector('input[type="radio"][value="critere_condition"]')?.checked
          ? 'critere_condition'
          : 'critere';

        const critereData = {
          nom_template: customName.toLowerCase().replace(/\s+/g, '_'),
          titre_affiche: customName,
          type: type,
          config_json: null
        };

        if (type === 'critere_condition') {
          critereData.config_json = [];
          bloc.querySelectorAll('.utm-custom-condition .utm-bonus-row').forEach((row, i) => {
            const cond = row.querySelector(`input[name="custom_condition[${i}][condition]"]`)?.value?.trim();
            const val = row.querySelector(`input[name="custom_condition[${i}][valeur]"]`)?.value?.trim();
            if (cond && val !== "") {
              critereData.config_json.push({ condition: cond, valeur: parseFloat(val) });
            }
          });
        }

        data.criteres_personnalises.push(critereData);
      });
      


      // Config JSON des critères standards
        data.criteres_configs = {};

        if (data.criteres.includes("moyenne")) {
          data.criteres_configs["moyenne"] = {
            mention_levels: [...document.querySelectorAll('input[name="mention_levels[]"]:checked')].map(i => i.value)
          };
        }

        if (data.criteres.includes("credits")) {
          data.criteres_configs["credits"] = {
            credits: ["CR1 L1", "CR2 L2", "CR3 L3"]  // tu peux adapter selon ton interface
          };
        }

        if (data.criteres.includes("matieres")) {
          data.criteres_configs["matieres"] = {
            matieres: data.matieres  // déjà collecté
          };
        }

        if (data.criteres.includes("bonus_mention")) {
          data.criteres_configs["bonus_mention"] = {
            conditions: data.bonus_mention
          };
        }

        if (data.criteres.includes("bonus_session")) {
          data.criteres_configs["bonus_session"] = {
            conditions: data.bonus_session
          };
        }

        if (data.criteres.includes("malus")) {
          data.criteres_configs["malus"] = {
            conditions: data.malus,
            exclu_cycle_preparatoire: data.exclu_cycle_preparatoire
          };
        }

        if (data.criteres.includes("interruption")) {
          data.criteres_configs["interruption"] = {
            conditions: data.interruption
          };
        }

        if (data.criteres.includes("pfe") && data.pfe) {
          data.criteres_configs["pfe"] = {
            condition: data.pfe.condition,
            valeur: data.pfe.valeur
          };
        }


     // bloc de nv critère

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


// version 12/06/2025 v1

/*

document.querySelector('.utm-save-btn').addEventListener('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1';
    const masterId = parseInt(urlParams.get("id"));

    const checkedLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
      .map(input => input.value);

    const critereMapping = {
      'note pfe': 'pfe',
      'moyenne': 'moyenne',
      'bonus mention': 'bonus_mention',
      'bonus session': 'bonus_session',
      'bonus': 'bonus',
      'malus': 'malus',
      'matières spécifiques': 'matieres',
      'crédits': 'credits'
    };

    const criteres = new Set();
    tokens.forEach(tok => {
      const cleaned = tok.trim().toLowerCase();
      for (const key in critereMapping) {
        if (cleaned.includes(key)) {
          criteres.add(critereMapping[key]);
        }
      }
    });

    const data = {
      niveau: currentCycle,
      formule: tokens.join(" "),
      matieres: [],
      bonus_mention: [],
      bonus_session: [],
      malus: [],
      criteres: Array.from(criteres),
      interruption: [],
      levels: checkedLevels,
      config_flags: {
        moyenne: document.querySelector('input[data-target="#bloc-l1"]')?.checked ?? false,
        credits: document.querySelector('input[data-target="#bloc-credits"]')?.checked ?? false,
        matieres: document.querySelector('input[data-target="#bloc-matieres"]')?.checked ?? false,
        entretien: document.querySelector('input[data-target="#bloc-entretien"]')?.checked ?? false,
        bonus: document.querySelector('input[data-target="#bloc-bonus"]')?.checked ?? false,
        session: document.querySelector('input[data-target="#bloc-bonus-session"]')?.checked ?? false,
        malus: document.querySelector('input[data-target="#bloc-malus"]')?.checked ?? false,
        interruption: document.querySelector('input[data-target="#bloc-interruption"]')?.checked ?? false,
      },
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
        condition: row.querySelector('select[name*="condition"]').value,
        valeur: row.querySelector('input[name*="valeur"]').value
      });
    });

    document.querySelectorAll('#utm-bonus-session-container .utm-bonus-row').forEach(row => {
      data.bonus_session.push({
        condition: row.querySelector('select[name*="condition"]').value,
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

    const moyenneActive = document.querySelector('input[data-target="#bloc-l1"]')?.checked;
    const moyenneLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
      .map(input => input.value);
    if (moyenneActive && moyenneLevels.length) {
      data.moyenne_levels = moyenneLevels;
    }

    const pfeCondition = document.getElementById('pfe-condition')?.value.trim();
    const pfeValeur = parseFloat(document.getElementById('pfe-valeur')?.value);
    const pfeActive = document.querySelector('input[data-target="#bloc-pfe"]')?.checked;
    if (pfeActive && pfeCondition && !isNaN(pfeValeur)) {
      data.pfe = {
        condition: pfeCondition,
        valeur: pfeValeur
      };
    }

    data.criteres_personnalises = [];
    document.querySelectorAll('.utm-toggle-list .utm-toggle-row').forEach(row => {
      const toggle = row.querySelector('.utm-toggle-input');
      if (!toggle?.checked) return;

      const customLabelInput = row.querySelector('input.utm-custom-label');
      const customName = customLabelInput?.value?.trim();
      if (!customName) return;

      const bloc = row.nextElementSibling;
      const type = bloc.querySelector('input[type="radio"][value="critere_condition"]')?.checked
        ? 'critere_condition'
        : 'critere';

      const critereData = {
        nom_template: customName.toLowerCase().replace(/\s+/g, '_'),
        titre_affiche: customName,
        type: type,
        config_json: null
      };

      if (type === 'critere_condition') {
        critereData.config_json = [];
        bloc.querySelectorAll('.utm-custom-condition .utm-bonus-row').forEach(row => {
          const cond = row.querySelector('input[name*="condition"]')?.value?.trim();
          const val = row.querySelector('input[name*="valeur"]')?.value?.trim();
          if (cond && val !== "") {
            critereData.config_json.push({ condition: cond, valeur: parseFloat(val) });
          }
        });
      }

      data.criteres_personnalises.push(critereData);
    });

    // 📦 Config JSON pour tous les critères
    data.criteres_configs = {};

    if (data.criteres.includes("moyenne")) {
      data.criteres_configs["moyenne"] = {
        mention_levels: moyenneLevels
      };
    }

    if (data.criteres.includes("credits")) {
      data.criteres_configs["credits"] = {
        credits: ["CR1 L1", "CR2 L2", "CR3 L3"]
      };
    }

    if (data.criteres.includes("matieres")) {
      data.criteres_configs["matieres"] = {
        matieres: data.matieres
      };
    }

    if (data.criteres.includes("bonus_mention")) {
      data.criteres_configs["bonus_mention"] = {
        conditions: data.bonus_mention
      };
    }

    if (data.criteres.includes("bonus_session")) {
      data.criteres_configs["bonus_session"] = {
        conditions: data.bonus_session
      };
    }

    if (data.criteres.includes("malus")) {
      data.criteres_configs["malus"] = {
        conditions: data.malus,
        exclu_cycle_preparatoire: data.exclu_cycle_preparatoire
      };
    }

    if (data.criteres.includes("interruption")) {
      data.criteres_configs["interruption"] = {
        conditions: data.interruption
      };
    }

    if (data.criteres.includes("pfe") && data.pfe) {
      data.criteres_configs["pfe"] = {
        condition: data.pfe.condition,
        valeur: data.pfe.valeur
      };
    }

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


// version 12/06/2025 v2
/*
  document.querySelector('.utm-save-btn').addEventListener('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1';
    const masterId = parseInt(urlParams.get("id"));

    const checkedLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
      .map(input => input.value);

    const critereMapping = {
      'note pfe': 'pfe',
      'moyenne': 'moyenne',
      'bonus mention': 'bonus_mention',
      'bonus session': 'bonus_session',
      'bonus': 'bonus',
      'malus': 'malus',
      'matières spécifiques': 'matieres',
      'crédits': 'credits'
    };

    const criteres = new Set();
    tokens.forEach(tok => {
      const cleaned = tok.trim().toLowerCase();
      for (const key in critereMapping) {
        if (cleaned.includes(key)) {
          criteres.add(critereMapping[key]);
        }
      }
    });

    const data = {
      niveau: currentCycle,
      formule: tokens.join(" "),
      matieres: [],
      bonus_mention: [],
      bonus_session: [],
      malus: [],
      criteres: Array.from(criteres),
      interruption: [],
      levels: checkedLevels,
      config_flags: {
        moyenne: document.querySelector('input[data-target="#bloc-l1"]')?.checked ?? false,
        credits: document.querySelector('input[data-target="#bloc-credits"]')?.checked ?? false,
        matieres: document.querySelector('input[data-target="#bloc-matieres"]')?.checked ?? false,
        entretien: document.querySelector('input[data-target="#bloc-entretien"]')?.checked ?? false,
        bonus: document.querySelector('input[data-target="#bloc-bonus"]')?.checked ?? false,
        session: document.querySelector('input[data-target="#bloc-bonus-session"]')?.checked ?? false,
        malus: document.querySelector('input[data-target="#bloc-malus"]')?.checked ?? false,
        interruption: document.querySelector('input[data-target="#bloc-interruption"]')?.checked ?? false,
      },
      exclu_cycle_preparatoire: document.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked ?? false
    };

    // Matières spécifiques
    document.querySelectorAll('#utm-matiere-container .utm-matiere-row').forEach(row => {
      data.matieres.push({
        matiere: row.querySelector('input[type="text"]')?.value,
        annee: row.querySelector('select')?.value,
        note: row.querySelector('input[type="number"]')?.value
      });
    });

    // Bonus Mention
    const bonusMention = [];
    const bonusMentionGroups = document.querySelectorAll('#bonus_mention-container > .utm-bonus-row');
    bonusMentionGroups.forEach(row => {
      const annee = row.querySelector('select[name*="annee"]')?.value;
      const condition = row.querySelector('select[name*="condition"]')?.value;
      const valeur = row.querySelector('input[name*="valeur"]')?.value;
      if (!annee || !condition || !valeur) return;
      const existing = bonusMention.find(g => g.annee === annee);
      if (existing) {
        existing.mentions.push({ condition, valeur: parseFloat(valeur) });
      } else {
        bonusMention.push({ annee, mentions: [{ condition, valeur: parseFloat(valeur) }] });
      }
    });
    data.bonus_mention = bonusMention;

    // Bonus Session
    document.querySelectorAll('#bonus_session-container .utm-bonus-row').forEach(row => {
      data.bonus_session.push({
        condition: row.querySelector('select')?.value,
        valeur: row.querySelector('input[type="number"]')?.value
      });
    });

    // Malus
    document.querySelectorAll('#malus-container .utm-bonus-row').forEach(row => {
      data.malus.push({
        condition: row.querySelector('input[name*="condition"]')?.value,
        valeur: row.querySelector('input[name*="valeur"]')?.value
      });
    });

    // Interruption
    document.querySelectorAll('#interruption-container .utm-bonus-row').forEach(row => {
      data.interruption.push({
        condition: row.querySelector('input[name*="condition"]')?.value,
        valeur: row.querySelector('input[name*="valeur"]')?.value
      });
    });

    // Moyenne
    const moyenneActive = document.querySelector('input[data-target="#bloc-l1"]')?.checked;
    const moyenneLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked'))
      .map(input => input.value);
    if (moyenneActive && moyenneLevels.length) {
      data.moyenne_levels = moyenneLevels;
    }

    // PFE
    const pfeCondition = document.getElementById('pfe-condition')?.value.trim();
    const pfeValeur = parseFloat(document.getElementById('pfe-valeur')?.value);
    const pfeActive = document.querySelector('input[data-target="#bloc-pfe"]')?.checked;
    if (pfeActive && pfeCondition && !isNaN(pfeValeur)) {
      data.pfe = { condition: pfeCondition, valeur: pfeValeur };
    }

    // Critères personnalisés
    data.criteres_personnalises = [];
    document.querySelectorAll('.utm-toggle-list .utm-toggle-row').forEach(row => {
      const toggle = row.querySelector('.utm-toggle-input');
      if (!toggle?.checked) return;
      const customLabelInput = row.querySelector('input.utm-custom-label');
      const customName = customLabelInput?.value?.trim();
      if (!customName) return;
      const bloc = row.nextElementSibling;
      const type = bloc.querySelector('input[type="radio"][value="critere_condition"]')?.checked
        ? 'critere_condition' : 'critere';

      const critereData = {
        nom_template: customName.toLowerCase().replace(/\s+/g, '_'),
        titre_affiche: customName,
        type: type,
        config_json: null
      };

      if (type === 'critere_condition') {
        critereData.config_json = [];
        bloc.querySelectorAll('.utm-custom-condition .utm-bonus-row').forEach(row => {
          const cond = row.querySelector('input[name*="condition"]')?.value?.trim();
          const val = row.querySelector('input[name*="valeur"]')?.value?.trim();
          if (cond && val !== "") {
            critereData.config_json.push({ condition: cond, valeur: parseFloat(val) });
          }
        });
      }
      data.criteres_personnalises.push(critereData);
    });

    // Config JSON complémentaire
    data.criteres_configs = {};

    if (data.criteres.includes("moyenne")) {
      data.criteres_configs["moyenne"] = { mention_levels: moyenneLevels };
    }
    if (data.criteres.includes("credits")) {
      data.criteres_configs["credits"] = { credits: ["CR1 L1", "CR2 L2", "CR3 L3"] };
    }
    if (data.criteres.includes("matieres")) {
      data.criteres_configs["matieres"] = { matieres: data.matieres };
    }
    if (data.criteres.includes("bonus_mention")) {
      data.criteres_configs["bonus_mention"] = { conditions: data.bonus_mention };
    }
    if (data.criteres.includes("bonus_session")) {
      data.criteres_configs["bonus_session"] = { conditions: data.bonus_session };
    }
    if (data.criteres.includes("malus")) {
      data.criteres_configs["malus"] = {
        conditions: data.malus,
        exclu_cycle_preparatoire: data.exclu_cycle_preparatoire
      };
    }
    if (data.criteres.includes("interruption")) {
      data.criteres_configs["interruption"] = { conditions: data.interruption };
    }
    if (data.criteres.includes("pfe") && data.pfe) {
      data.criteres_configs["pfe"] = {
        condition: data.pfe.condition,
        valeur: data.pfe.valeur
      };
    }

    // Submit
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

document.querySelector('.utm-save-btn').addEventListener('click', () => {


  if (!Array.isArray(tokens) || tokens.length === 0) {
    alert("⚠️ Veuillez d'abord définir la formule avant de l'enregistrer.");
    return;
  }

  const urlParams = new URLSearchParams(window.location.search);
  const currentCycle = urlParams.get("master")?.toUpperCase() || 'M1';
  const masterId = parseInt(urlParams.get("id"));

  const checkedLevels = Array.from(document.querySelectorAll('input[name="mention_levels[]"]:checked')).map(input => input.value);

  const critereMapping = {
    'note pfe': 'pfe',
    'moyenne': 'moyenne',
    'bonus mention': 'bonus_mention',
    'bonus session': 'bonus_session',
    'bonus': 'bonus',
    'malus': 'malus',
    'matières spécifiques': 'matieres',
    'crédits': 'credits'
  };

  /*  const tokens = window.tokens || [];
    const criteres = new Set();
    tokens.forEach(tok => {
      const cleaned = tok.trim().toLowerCase();
      for (const key in critereMapping) {
        if (cleaned.includes(key)) {
          criteres.add(critereMapping[key]);
        }
      }
    });*/
   console.log('tokens');
   console.log(tokens);
  const data = {
    niveau: currentCycle,
    formule: tokens.join(" "),
  //  criteres: Array.from(criteres),
    levels: checkedLevels,
    config_flags: {
      moyenne: document.querySelector('input[data-target="#bloc-l1"]')?.checked ?? false,
      credits: document.querySelector('input[data-target="#bloc-credits"]')?.checked ?? false,
      matieres: document.querySelector('input[data-target="#bloc-matieres"]')?.checked ?? false,
      entretien: document.querySelector('input[data-target="#bloc-entretien"]')?.checked ?? false,
      bonus: document.querySelector('input[data-target="#bloc-bonus"]')?.checked ?? false,
      session: document.querySelector('input[data-target="#bloc-bonus-session"]')?.checked ?? false,
      malus: document.querySelector('input[data-target="#bloc-malus"]')?.checked ?? false,
      interruption: document.querySelector('input[data-target="#bloc-interruption"]')?.checked ?? false,
    },
    exclu_cycle_preparatoire: document.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked ?? false,
    criteres_personnalises: [],
    criteres_configs: {}
  };

  // Fonction utilitaire
  function getLabel(row) {
    return row.querySelector('input.utm-custom-label')?.value?.trim() || row.querySelector('span')?.innerText?.trim();
  }

  function extractConfig(nom_template, bloc) {
    switch (nom_template) {
      case 'moyenne_arithmétique':
        return { mention_levels: Array.from(bloc.querySelectorAll('input[name="mention_levels[]"]:checked')).map(i => i.value) };
      case 'crédits':
        return { credits: ['CR1 L1', 'CR2 L2', 'CR3 L3'] };
      case 'matières_spécifiques':
        return {
          matieres: Array.from(bloc.querySelectorAll('.utm-matiere-row')).map(row => ({
            matiere: row.querySelector('input[type="text"]')?.value,
            annee: row.querySelector('select')?.value,
            note: row.querySelector('input[type="number"]')?.value
          }))
        };
      case 'bonus_mention_(b.m)': {
        const bonusMention = [];
        const rows = bloc.querySelectorAll('.utm-bonus-row');
        rows.forEach(row => {
          const annee = row.querySelector('select[name*="annee"]')?.value;
          const condition = row.querySelector('select[name*="condition"]')?.value;
          const valeur = row.querySelector('input[name*="valeur"]')?.value;
          if (!annee || !condition || !valeur) return;
          let group = bonusMention.find(g => g.annee === annee);
          if (!group) bonusMention.push(group = { annee, mentions: [] });
          group.mentions.push({ condition, valeur: parseFloat(valeur) });
        });
        return { bonus_mention: bonusMention };
      }
      case 'bonus_session_(b.s)':
        return {
          conditions: Array.from(bloc.querySelectorAll('.utm-bonus-row')).map(row => ({
            condition: row.querySelector('select')?.value,
            valeur: row.querySelector('input[type="number"]')?.value
          }))
        };
      case 'malus': {
        const config = {
          conditions: Array.from(bloc.querySelectorAll('.utm-bonus-row')).map(row => ({
            condition: row.querySelector('input[name*="condition"]')?.value,
            valeur: row.querySelector('input[name*="valeur"]')?.value
          }))
        };
        if (nom_template === 'malus') {
          config.exclu_cycle_preparatoire = !!bloc.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked;
        }
        return config;
      }
      case 'année_d’interruption': {
        const config = {};
        const intervalleRows = bloc.querySelectorAll('.utm-intervalle-row');
        const conditionRows = bloc.querySelectorAll('.utm-bonus-row');

        // Nouvelle version avec intervalles
        if (intervalleRows.length > 0) {
          config.intervalle = Array.from(intervalleRows).map(row => ({
            min: parseFloat(row.querySelector('input[name*="[min]"]')?.value || 0),
            max: parseFloat(row.querySelector('input[name*="[max]"]')?.value || 0),
            valeur: parseFloat(row.querySelector('input[name*="[valeur]"]')?.value || 0)
          }));
        }
        // Ancienne version avec conditions textuelles
        else if (conditionRows.length > 0) {
          config.conditions = Array.from(conditionRows).map(row => ({
            condition: row.querySelector('input[name*="condition"]')?.value || '',
            valeur: parseFloat(row.querySelector('input[name*="valeur"]')?.value || 0)
          }));
        }

        // Optionnel : cas spécifique du template "malus"
        if (nom_template === 'malus') {
          config.exclu_cycle_preparatoire = !!bloc.querySelector('input[value="Exclus du cycle préparatoire"]')?.checked;
        }

        return config;
      }

      case 'note_pfe':
        const rows = bloc.querySelectorAll('.utm-intervalle-row');
        const intervalles = [];

        rows.forEach((row, index) => {
          const min = row.querySelector(`input[name^="note_pfe"][name$="[min]"]`)?.value;
          const max = row.querySelector(`input[name^="note_pfe"][name$="[max]"]`)?.value;
          const valeur = row.querySelector(`input[name^="note_pfe"][name$="[valeur]"]`)?.value;

          if (min !== '' && max !== '' && valeur !== '') {
            intervalles.push({
              min: parseFloat(min),
              max: parseFloat(max),
              valeur: parseFloat(valeur)
            });
          }
        });

        return {
          intervalle: intervalles
        };

       default: {
          const isCondition = bloc.querySelector('input[value="critere_condition"]')?.checked;

          if (isCondition) {
            const rows = bloc.querySelectorAll('.utm-custom-condition .utm-intervalle-row');
            const conditions = Array.from(rows).map((row) => {
              const min = parseFloat(row.querySelector('input[name*="[min]"]')?.value || 0);
              const max = parseFloat(row.querySelector('input[name*="[max]"]')?.value || 0);
              const valeur = parseFloat(row.querySelector('input[name*="[valeur]"]')?.value || 0);
              return { min, max, valeur };
            });

            return {
              type: 'critere_condition',
              intervalle: conditions
            };
          }

          return {
            type: 'critere',
            valeur: parseFloat(bloc.querySelector('input[name*="valeur"]')?.value || 1)
          };
        }

    }
  }

  // Balayer tous les critères activés (standards + personnalisés)
  document.querySelectorAll('.utm-toggle-list .utm-toggle-row').forEach(row => {
    const toggle = row.querySelector('.utm-toggle-input');
    if (!toggle?.checked) return;

    const bloc = row.nextElementSibling;
    const label = getLabel(row);
    const nom_template = label.toLowerCase().replace(/\s+/g, '_');
    console.log("nom_template");
    console.log(nom_template);
    const config = extractConfig(nom_template, bloc);
    data.criteres_configs[nom_template] = config;

    const isCustom = row.querySelector('input.utm-custom-label');
    if (isCustom) {
      const type = bloc.querySelector('input[value="critere_condition"]')?.checked ? 'critere_condition' : 'critere';
      data.criteres_personnalises.push({
        nom_template,
        titre_affiche: label,
        type,
        config_json: config
      });
    }
  });
  data.formule_json = Array.isArray(tokens) ? tokens : [];

    // Submit
     fetch(`/wp-json/plateforme-master/v1/score/${masterId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify(data)
    })
    .then(async res => {
      const responseData = await res.json();

      if (!res.ok) {
        if (responseData.code === 'formule_locked') {
          alert("⛔ Cette formule est déjà validée et ne peut plus être modifiée.");
        } else {
          alert("❌ Erreur API.");
        }
        throw new Error(responseData.message || 'Erreur serveur');
      }

      // ✅ Si succès, afficher le message et rediriger
      if (responseData.success) {
        alert("✅ " + (responseData.message || "Formule enregistrée !"));
        setTimeout(() => {
          window.location.href = `/fiche-master/?id=${masterId}`;
        }, 100);
      } else {
        alert("❌ Erreur inattendue.");
        console.error(responseData);
      }
    })
   
  
});


});


</script>
