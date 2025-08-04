/**
 * Main JavaScript file for the application
 */
document.addEventListener('DOMContentLoaded', () => {
  // Initialize the form with default data
  initializeForm();

  // Add event listeners
  addEventListeners();

  // Initialize character counters
  initializeCharacterCounters();

  // Handle form submission
  setupFormSubmission();
});

/**
 * Initialize the form with default values and setup
 */
function initializeForm() {
  // Populate step 2 and 3 with placeholder content
  populateStep2();
  populateStep3();
  populateStep4();
  //populateEtablissements(); // <-- ici


  // Add animation classes
  document.querySelector('.form-container').classList.add('fade-in');
}

/**
 * Add event listeners to form elements
 */
/*
function addEventListeners() {
  // Next button in step 1
  const nextBtn = document.getElementById('next-btn');
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      if (validateStep1()) {
        showConfirmationPopup(() => {
          goToStep(2);
        });
      }
    });
  }

  // Sidebar navigation
  const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
  sidebarLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      // Set active class
      document.querySelectorAll('.sidebar-nav li').forEach(item => {
        item.classList.remove('active');
      });
      link.parentElement.classList.add('active');
    });
  });
}

*/

function addEventListeners() {
  // Bouton "Suivant" de l'étape 1
  const nextBtn = document.getElementById('next-btn');
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      // Facultatif : valider les champs de l'étape 1 avant de passer à l'étape 2
      console.log('test 2');
      if (typeof validateStep1 !== 'function' || validateStep1()) {
        goToStep(2); // Passage direct à l'étape 2
      }
    });
  }

  // Navigation latérale
  // const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
  // if (sidebarLinks.length > 0) {
  //   sidebarLinks.forEach(link => {
  //     link.addEventListener('click', (e) => {
  //       e.preventDefault();
  //       document.querySelectorAll('.sidebar-nav li').forEach(item => {
  //         item.classList.remove('active');
  //       });
  //       link.parentElement.classList.add('active');
  //     });
  //   });
  // }
}

/*
function showConfirmationPopup(message = "Confirmez-vous les informations saisies ?", onConfirm = () => {}) {
  const popup = document.getElementById('form-confirm-popup');
  const msg = document.getElementById('form-confirm-message');
  const confirmBtn = document.getElementById('confirm-confirm-popup');
  const cancelBtn = document.getElementById('cancel-confirm-popup');

  msg.textContent = message;
  popup.style.display = 'flex';

  const cleanup = () => {
    popup.style.display = 'none';
    confirmBtn.removeEventListener('click', confirmHandler);
    cancelBtn.removeEventListener('click', cancelHandler);
  };

  const confirmHandler = () => {
    cleanup();
    onConfirm();
  };

  const cancelHandler = () => {
    cleanup();
  };

  confirmBtn.addEventListener('click', confirmHandler);
  cancelBtn.addEventListener('click', cancelHandler);
}
*/

function showConfirmationPopup(message = "Confirmez-vous les informations saisies ?", onConfirm = () => { }) {
  const popup = document.getElementById('form-confirm-popup');
  const msg = document.getElementById('form-confirm-message');
  const confirmBtn = document.getElementById('confirm-confirm-popup');
  const cancelBtn = document.getElementById('cancel-confirm-popup');

  if (!popup || !msg || !confirmBtn || !cancelBtn) {
    console.warn("⚠ La modale de confirmation est manquante dans le DOM.");
    return;
  }

  msg.textContent = message;
  popup.style.display = 'flex';

  const cleanup = () => {
    popup.style.display = 'none';
    confirmBtn.removeEventListener('click', confirmHandler);
    cancelBtn.removeEventListener('click', cancelHandler);
  };

  const confirmHandler = () => {
    cleanup();
    onConfirm();
  };

  const cancelHandler = () => {
    cleanup();
  };

  confirmBtn.addEventListener('click', confirmHandler);
  cancelBtn.addEventListener('click', cancelHandler);
}



/**
 * Initialize character counters for text inputs
 */
function initializeCharacterCounters() {
  // Fields that need character counting
  const fieldsWithCounter = [
    { input: 'nom', counter: 'nom-length' },
    { input: 'prenom', counter: 'prenom-length' },
    { input: 'nom-arabe', counter: 'nom-arabe-length' },
    { input: 'prenom-arabe', counter: 'prenom-arabe-length' },
    { input: 'nationalite', counter: 'nationalite-length' },
    { input: 'adresse', counter: 'adresse-length' },
    { input: 'delegation', counter: 'delegation-length' },
    { input: 'appartement', counter: 'appart-length' }
  ];

  fieldsWithCounter.forEach(field => {
    const inputElement = document.getElementById(field.input);
    const counterElement = document.getElementById(field.counter);

    if (inputElement && counterElement) {
      // Initial count
      counterElement.value = inputElement.value.length;

      // Update on input
      inputElement.addEventListener('input', () => {
        counterElement.value = inputElement.value.length;
      });
    }
  });
}

/**
 * Populate step 2 of the form
 */
function populateStep2() {
  const step2 = document.getElementById('step2');
  if (step2) {
    step2.innerHTML = `
      <div class="section-title">
                                  <h2 class="Quicksand-bold">Situation Académique</h2>
                              </div>
                  
                              <div class="form-section-block">
                                <h3><i class="fa fa-graduation-cap"></i> Bac</h3>

                                  <div class="form-group">
                                      <div class="form-field" style="flex: 1; min-width: unset;">
                                          <label for="nom">Année <span class="required">*</span></label>
                                          <div class="select-wrapper">
                                            <select id="year_bac" name="year_bac" required>  
                                                  <option value="">-- Sélectionner une année --</option>
                                                  <option value="2025-2026">2025-2026</option>
                                                  <option value="2024-2025">2024-2025</option>
                                                  <option value="2023-2024">2023-2024</option>
                                                  <option value="2022-2023">2022-2023</option>
                                                  <option value="2021-2022">2021-2022</option>
                                                  <option value="2020-2021">2020-2021</option>
                                                  <option value="2019-2020">2019-2020</option>
                                                  <option value="2018-2019">2018-2019</option>
                                                  <option value="2017-2018">2017-2018</option>
                                                  <option value="2016-2017">2016-2017</option>
                                                  <option value="2015-2016">2015-2016</option>
                                                  <option value="2014-2015">2014-2015</option>
                                                  <option value="2013-2014">2013-2014</option>
                                                  <option value="2012-2013">2012-2013</option>
                                                  <option value="2011-2012">2011-2012</option>
                                                  <option value="2010-2011">2010-2011</option>
                                                  <option value="2009-2010">2009-2010</option>
                                                  <option value="2008-2009">2008-2009</option>
                                                  <option value="2007-2008">2007-2008</option>
                                                  <option value="2006-2007">2006-2007</option>
                                                  <option value="2005-2006">2005-2006</option>
                                                  <option value="2004-2005">2004-2005</option>
                                                  <option value="2003-2004">2003-2004</option>
                                                  <option value="2002-2003">2002-2003</option>
                                                  <option value="2001-2002">2001-2002</option>
                                                  <option value="2000-2001">2000-2001</option>
                                                  <option value="1999-2000">1999-2000</option>
                                                  <option value="1998-1999">1998-1999</option>
                                                  <option value="1997-1998">1997-1998</option>
                                                  <option value="1996-1997">1996-1997</option>
                                                  <option value="1995-1996">1995-1996</option>
                                                  <option value="1994-1995">1994-1995</option>
                                                  <option value="1993-1994">1993-1994</option>
                                                  <option value="1992-1993">1992-1993</option>
                                                  <option value="1991-1992">1991-1992</option>
                                                  <option value="1990-1991">1990-1991</option>
                                                  <option value="1989-1990">1989-1990</option>
                                                  <option value="1988-1989">1988-1989</option>
                                                  <option value="1987-1988">1987-1988</option>
                                                  <option value="1986-1987">1986-1987</option>
                                                  <option value="1985-1986">1985-1986</option>
                                                  <option value="1984-1985">1984-1985</option>
                                                  <option value="1983-1984">1983-1984</option>
                                                  <option value="1982-1983">1982-1983</option>
                                                  <option value="1981-1982">1981-1982</option>
                                                  <option value="1980-1981">1980-1981</option>
                                                  <option value="1979-1980">1979-1980</option>
                                                  <option value="1978-1979">1978-1979</option>
                                                  <option value="1977-1978">1977-1978</option>
                                                  <option value="1976-1977">1976-1977</option>
                                                  <option value="1975-1976">1975-1976</option>
                                                  <option value="1974-1975">1974-1975</option>
                                                  <option value="1973-1974">1973-1974</option>
                                                  <option value="1972-1973">1972-1973</option>
                                                  <option value="1971-1972">1971-1972</option>
                                                  <option value="1970-1971">1970-1971</option>
                                                  <option value="1969-1970">1969-1970</option>
                                                  <option value="1968-1969">1968-1969</option>
                                                  <option value="1967-1968">1967-1968</option>
                                                  <option value="1966-1967">1966-1967</option>
                                                  <option value="1965-1966">1965-1966</option>
                                                  <option value="1964-1965">1964-1965</option>
                                                  <option value="1963-1964">1963-1964</option>
                                                  <option value="1962-1963">1962-1963</option>
                                                  <option value="1961-1962">1961-1962</option>
                                                  <option value="1960-1961">1960-1961</option>
                                                  <option value="1959-1960">1959-1960</option>
                                                  <option value="1958-1959">1958-1959</option>
                                                  <option value="1957-1958">1957-1958</option>
                                                  <option value="1956-1957">1956-1957</option>
                                                  <option value="1955-1956">1955-1956</option>
                                                  <option value="1954-1955">1954-1955</option>
                                                  <option value="1953-1954">1953-1954</option>
                                                  <option value="1952-1953">1952-1953</option>
                                                  <option value="1951-1952">1951-1952</option>
                                                  <option value="1950-1951">1950-1951</option>
                                                  </select>

                                          </div> <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <label for="nom-arabe">Baccalauréat<span class="required">*</span></label>
                                          <div class="select-wrapper">
                                          
                                              <select id="specialite" name="specialite" required class="mention">
                                              <option value="">-- Sélectionner une spécialité --</option>
                                              <option value="math">Mathématiques</option>
                                              <option value="sciences">Sciences expérimentales</option>
                                              <option value="technique">Sciences techniques</option>
                                              <option value="informatique">Sciences informatiques</option>
                                              <option value="eco-gestion">Économie et gestion</option>
                                              <option value="lettres">Lettres</option>
                                              <option value="sciences-sport">Sciences de sport</option>
                                              <option value="arts">Arts</option>
                                              <option value="autre">Autre</option>
                                              </select>

                                          </div>
                                          <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <label for="nom-arabe">Etablissement<span class="required">*</span></label>
                                          <div class="select-wrapper">
                                              <input tpe="text" id="etablissement" name="etablissement" required>

                                          <!-- <select id="etablissement" name="etablissement" required>
                                                  <option value="lycee-10-decembre">Lycée 10 décembre</option>
                                                  <option value="autre">Autre</option>
                                              </select>-->
                                          </div>
                                          <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <label for="nom-arabe">Session<span class="required">*</span></label>
                                          <div class="select-wrapper">
                                              <select id="session" name="session" required>
                                                  <option value="principale">Principale</option>
                                                  <option value="rattrapage">Rattrapage</option>
                                              </select>
                                          </div>
                                          <span class="error-message"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="form-field" style="flex: 1; min-width: unset;">
                                          <label for="nom">Mention <span class="required">*</span></label>
                                          <div class="select-wrapper">
                                              <select name="mention_bac" required id="mention_bac">
                                              <option value="">-- Mention --</option>
                                                <option value="Passable">Passable</option>
                                                <option value="Assez bien">Assez bien</option>
                                                <option value="Bien">Bien</option>
                                                <option value="Très bien">Très bien</option>
                                                <option value="Excellent">Excellent</option>
                                              </select>


                                          </div> <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <label for="nom-arabe">Moyenne<span class="required">*</span></label>
                                          <input type="number" step="1" id="moyenne" name="moyenne" min="0" max="20" required>
                                          <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <label for="nom-arabe">Diplôme<span class="required">*</span></label>
                                          <div class="upload-container" >
                                              <input type="file" class="file-input"    accept=".pdf" style="display:none">
                                              <div class="import-button Quicksand-bold upload-btn">Upload</div>
                                                      
                                          </div>
                                          <span class="error-message"></span>
                                      </div>
                                      <div class="form-field">
                                          <div class="document-list" id="document-list">
                                              <div class="empty-state">Aucun document importé</div>
                                          </div>
                                      </div>
                                  </div>
                                
                              </div>

                              <div class="form-section-block">
                                  <h3><i class="fa fa-university"></i> Cursus Universitaire</h3>
                                      <div class="cycle-selection">
                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="licence" checked>
                                              <span class="custom-check"></span>
                                              Licence
                                          </label>

                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="maitrise">
                                              <span class="custom-check"></span>
                                              Maîtrise
                                          </label>

                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="ingenieur">
                                              <span class="custom-check"></span>
                                              Cycle ingénieur
                                          </label>

                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="master">
                                              <span class="custom-check"></span>
                                              Master
                                          </label>
                                      </div>

                                      <div id="dynamic-sections"  ></div>

                                      

                                  <button type="button" id="prev-btn-2" class="btn btn-primary" style="background: #A6A485;margin-right: 20px;    position: absolute;
                                      right: 140px;">PRÉCÉDENT</button>
                                                                  <button type="button" id="next-btn-2I" class="btn btn-primary" style="    position: absolute;
                                      right: 25px;">SUIVANT</button>
                                      <template id="year-block-template">
                                      
                                          <div class="form-group year-block" style="margin-top: 40px;">
                                              <div class="form-group">
                                                  <div class="form-field" style="flex: 1; min-width: unset;">
                                                      <label for="nom">Année <span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                          <select id="year_cursus" name="year_cursus" required class="select-annee">
                                                              <option value="">-- Sélectionner une année --</option>
                                                              <option value="2025-2026">2025-2026</option>
                                                              <option value="2024-2025">2024-2025</option>
                                                              <option value="2023-2024">2023-2024</option>
                                                              <option value="2022-2023">2022-2023</option>
                                                              <option value="2021-2022">2021-2022</option>
                                                              <option value="2020-2021">2020-2021</option>
                                                              <option value="2019-2020">2019-2020</option>
                                                              <option value="2018-2019">2018-2019</option>
                                                              <option value="2017-2018">2017-2018</option>
                                                              <option value="2016-2017">2016-2017</option>
                                                              <option value="2015-2016">2015-2016</option>
                                                              <option value="2014-2015">2014-2015</option>
                                                              <option value="2013-2014">2013-2014</option>
                                                              <option value="2012-2013">2012-2013</option>
                                                              <option value="2011-2012">2011-2012</option>
                                                              <option value="2010-2011">2010-2011</option>
                                                              <option value="2009-2010">2009-2010</option>
                                                              <option value="2008-2009">2008-2009</option>
                                                              <option value="2007-2008">2007-2008</option>
                                                              <option value="2006-2007">2006-2007</option>
                                                              <option value="2005-2006">2005-2006</option>
                                                              <option value="2004-2005">2004-2005</option>
                                                              <option value="2003-2004">2003-2004</option>
                                                              <option value="2002-2003">2002-2003</option>
                                                              <option value="2001-2002">2001-2002</option>
                                                              <option value="2000-2001">2000-2001</option>
                                                              <option value="1999-2000">1999-2000</option>
                                                              <option value="1998-1999">1998-1999</option>
                                                              <option value="1997-1998">1997-1998</option>
                                                              <option value="1996-1997">1996-1997</option>
                                                              <option value="1995-1996">1995-1996</option>
                                                              <option value="1994-1995">1994-1995</option>
                                                              <option value="1993-1994">1993-1994</option>
                                                              <option value="1992-1993">1992-1993</option>
                                                              <option value="1991-1992">1991-1992</option>
                                                              <option value="1990-1991">1990-1991</option>
                                                              <option value="1989-1990">1989-1990</option>
                                                              <option value="1988-1989">1988-1989</option>
                                                              <option value="1987-1988">1987-1988</option>
                                                              <option value="1986-1987">1986-1987</option>
                                                              <option value="1985-1986">1985-1986</option>
                                                              <option value="1984-1985">1984-1985</option>
                                                              <option value="1983-1984">1983-1984</option>
                                                              <option value="1982-1983">1982-1983</option>
                                                              <option value="1981-1982">1981-1982</option>
                                                              <option value="1980-1981">1980-1981</option>
                                                              <option value="1979-1980">1979-1980</option>
                                                              <option value="1978-1979">1978-1979</option>
                                                              <option value="1977-1978">1977-1978</option>
                                                              <option value="1976-1977">1976-1977</option>
                                                              <option value="1975-1976">1975-1976</option>
                                                              <option value="1974-1975">1974-1975</option>
                                                              <option value="1973-1974">1973-1974</option>
                                                              <option value="1972-1973">1972-1973</option>
                                                              <option value="1971-1972">1971-1972</option>
                                                              <option value="1970-1971">1970-1971</option>
                                                              <option value="1969-1970">1969-1970</option>
                                                              <option value="1968-1969">1968-1969</option>
                                                              <option value="1967-1968">1967-1968</option>
                                                              <option value="1966-1967">1966-1967</option>
                                                              <option value="1965-1966">1965-1966</option>
                                                              <option value="1964-1965">1964-1965</option>
                                                              <option value="1963-1964">1963-1964</option>
                                                              <option value="1962-1963">1962-1963</option>
                                                              <option value="1961-1962">1961-1962</option>
                                                              <option value="1960-1961">1960-1961</option>
                                                              <option value="1959-1960">1959-1960</option>
                                                              <option value="1958-1959">1958-1959</option>
                                                              <option value="1957-1958">1957-1958</option>
                                                              <option value="1956-1957">1956-1957</option>
                                                              <option value="1955-1956">1955-1956</option>
                                                              <option value="1954-1955">1954-1955</option>
                                                              <option value="1953-1954">1953-1954</option>
                                                              <option value="1952-1953">1952-1953</option>
                                                              <option value="1951-1952">1951-1952</option>
                                                              <option value="1950-1951">1950-1951</option>
                                                              </select>

                                                      </div> <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Université<span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                      <input type="text" id="Université" name="Université" required class="input-universite">
                                                      

                                                      </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Etablissement<span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                      
                                                          <input tpe="text" id="etablissement" name="etablissement" required class="input-etablissement">

                                                      </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Session<span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                          <select id="session" name="session" required class="select-session">
                                                              <option value="principale">Principale</option>
                                                              <option value="rattrapage">Rattrapage</option>
                                                          </select>
                                                      </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <div class="form-field" style="flex: 1; min-width: unset;">
                                                      <label for="nom">Mention <span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                          <select id="mention_cursus" name="mention_cursus" required class="mention select-mention">
                                                              <option value="">-- Mention --</option>
                                                                <option value="Passable">Passable</option>
                                                                <option value="Assez bien">Assez bien</option>
                                                                <option value="Bien">Bien</option>
                                                                <option value="Très bien">Très bien</option>
                                                                <option value="Excellent">Excellent</option>
                                                          </select>
                                                      </div> <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Moyenne<span class="required">*</span></label>
                                          <input type="number" step="1" id="moyenne" name="moyenne" min="0" max="20" class="input-moyenne" required>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Crédit<span class="required">*</span></label> 
                                                      <input type="number" step="1" id="credit" class="input-credit" name="credit" min="0" max="20" required>
 
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Relevé de notes<span class="required">*</span></label>
                                                      <div class="upload-container" >
                                                  <input type="file" class="file-input"  name="Cursus_Licence_"  accept=".pdf" style="display:none">
                                                          <div class="import-button Quicksand-bold upload-btn">Upload</div>
                                                          
                                              </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field" style="width: 100%;max-width: unset;">
                                                      <div class="document-list" style="width: 100%;max-width: unset;" id="document-list">
                                                          <div class="empty-state" style="width: 100%;max-width: unset;">Aucun document importé</div>
                                                      </div>
                                                  </div>
                                              </div>
                                             
                                              <label class="custom-checkbox Quicksand-medium smallText" style="font-family: 'Poppins'; color: #2A2916;    width: 100%;">
                                                  <input type="checkbox" class="toggle-blanche-checkbox" >
                                                  <span class="checkmark"></span> Ajouter une année blanche
                                              </label>
                                              
                                              <div class="annee-blanche-container" style="display: none; margin-top: 20px;">
                                                  <div class="annee-blanche-list"></div>
                                                  <div class="btn-red ajouter-blanche Quicksand-bold smallText" style="cursor: pointer;">Ajouter une autre année blanche</div>
                                              </div>
                  
                                          </div>
                                          <div class="form-actions">
                                      
                                      
                                      </template>
                              </div>

                              <template id="annee-blanche-template">
                                  <div class="annee-blanche-container" style="margin-top: 20px;">
                                      <div style="display: flex; flex-direction: column; width: 50%; gap:13px">
                                      <div class="form-field" style="width: 100%;">
                                          <label>Nombre d'années <span class="required">*</span></label>
                                          <input type="text" class="input-nbannee" required>
                                          <span class="error-message"></span>
                                      </div>
                                      <div class="form-field" style="width: 100%;">
                                          <label>Pièces jointes <span class="required">*</span></label>
                                          <div class="upload-container" d style="width: 100%;">
                                          <input type="file" class="file-input"  accept=".pdf" style="display:none">
                                          <input type="text">
                                          <div class="import-button Quicksand-bold upload-btn">Upload</div>
                                          </div>
                                          <span class="error-message"></span>
                                      </div>
                                      </div>
                                      <div class="form-field">
                                      <label>Cause <span class="required">*</span></label>
                                      <textarea class="textarea-cause" style="min-height: 122px;"></textarea>
                                      </div>
                                  </div>
                              </template>

                                
      `;

    // // Add event listeners for step 2
    // setTimeout(() => {
    //   const addBtn = document.getElementById('addParentAddress');
    //   if (addBtn) {
    //     addBtn.addEventListener('click', addAcademicSituationBlock);
    //   }
    //   const prevBtn2 = document.getElementById('prev-btn-2');
    //   const nextBtn2 = document.getElementById('next-btn-2');

    //   if (prevBtn2) {
    //     prevBtn2.addEventListener('click', () => {
    //       goToStep(1);
    //     });
    //   }

    //   if (nextBtn2) {
    //     nextBtn2.addEventListener('click', () => {
    //       if (validateStep2()) {
    //         goToStep(3);
    //       }
    //     });
    //   }
    // }, 100);


    // Wait for DOM to inject
    setTimeout(() => {
      // Re-bind year logic
      bindYearBlockLogic();

      // Optional: bind nav buttons
      // const addBtn = document.getElementById('addParentAddress');
      // addBtn?.addEventListener('click', addAcademicSituationBlock);
      document.getElementById('next-btn-2I')?.addEventListener('click', () => {
        if (validationStep2I()) {
          showConfirmationPopup("Confirmez-vous les informations saisies ?", () => {
            goToStep(3);
          });
        }
      });
      document.getElementById('prev-btn-2')?.addEventListener('click', () => goToStep(1));
      document.getElementById('next-btn-2')?.addEventListener('click', () => {
        if (validateStep2()) {
          goToStep(3);

        }
      });
    }, 100);
  }
}


function bindYearBlockLogic() {
  const parcoursSelect = document.getElementById("parcours");
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  const blancheTemplate = document.getElementById("annee-blanche-template");

  if (!parcoursSelect) return;

  function initBlancheLogic(yearBlock) {
    const checkbox = yearBlock.querySelector(".toggle-blanche-checkbox");
    const container = yearBlock.querySelector(".annee-blanche-container");
    const list = yearBlock.querySelector(".annee-blanche-list");
    const addBtn = yearBlock.querySelector(".ajouter-blanche");

    checkbox.addEventListener("change", () => {
      container.style.display = checkbox.checked ? "block" : "none";
      if (checkbox.checked && list.children.length === 0) {
        addBlancheItem(list);
      }
    });

    addBtn?.addEventListener("click", () => {
      addBlancheItem(list);
    });
  }

  function addBlancheItem(listContainer) {
    const clone = blancheTemplate.content.cloneNode(true);
    listContainer.appendChild(clone);
  }
  /*
    function createYearBlocks(count) {
      sectionContainer.innerHTML = "";
  
      for (let i = 0; i < count; i++) {
        const clone = yearTemplate.content.cloneNode(true);
        const yearBlock = document.createElement("div");
        yearBlock.classList.add("year-block-wrapper");
  
        const title = document.createElement("h4");
        title.textContent = `Année ${i + 1}`;
        // yearBlock.appendChild(title);
        yearBlock.appendChild(clone);
  
        sectionContainer.appendChild(yearBlock);
  
        initBlancheLogic(yearBlock);
      }
    }
  */




}

function addAcademicSituationBlock() {
  const container = document.getElementById('additionalSectionsContainer');
  if (!container) return;

  const newBlock = document.createElement('div');
  newBlock.className = 'form-section';
  newBlock.innerHTML = `
  <div class="form-section-step" >
   <div class="form-group">
      <div class="form-field">
        <label for="gradeActuel_${Date.now()}">Grade actuel <span class="required">*</span></label>
        <input type="text" id="gradeActuel_${Date.now()}" name="gradeActuel" required>
      </div>
      <div class="form-field">
        <label for="dateObtentionGrade_${Date.now()}">Date d'obtention du grade <span class="required">*</span></label>
        <input type="date" id="dateObtentionGrade_${Date.now()}" name="dateObtentionGrade" required>
      </div>
    </div>
    
    <div class="form-group">
      <div class="form-field">
        <label for="dernierDiplome_${Date.now()}">Dernier diplôme obtenu <span class="required">*</span></label>
        <input type="text" id="dernierDiplome_${Date.now()}" name="dernierDiplome" required>
      </div>
      <div class="form-field">
        <label for="dateDiplome_${Date.now()}">Date du diplôme <span class="required">*</span></label>
        <input type="date" id="dateDiplome_${Date.now()}" name="dateDiplome" required>
      </div>
    </div>
    
    <div class="form-group">
      <div class="form-field">
        <label for="etablissementDiplome_${Date.now()}">Établissement du diplôme <span class="required">*</span></label>
        <input type="text" id="etablissementDiplome_${Date.now()}" name="etablissementDiplome" required>
      </div>
      <div class="form-field">
        <label for="etablissementAffectation_${Date.now()}">Établissement d'affectation <span class="required">*</span></label>
        <input type="text" id="etablissementAffectation_${Date.now()}" name="etablissementAffectation" required>
      </div>
    </div>
    <div class="filled-btn" onclick="this.parentNode.remove()" style="width: 159px;">Supprimer </div>
  </div>
   
  `;

  container.appendChild(newBlock);
}


function fillStep2Form(data) {
  if (!data) return;

  // 🟡 Bac
  document.getElementById('year_bac').value = data.annee || '';
  document.getElementById('specialite').value = data.baccalaureat || '';
  document.getElementById('etablissement').value = data.etablissement || '';
  document.getElementById('session').value = data.session || '';
  document.getElementById('mention_bac').value = data.mention || '';
  document.getElementById('moyenne').value = data.moyenne || '';
  // const bacDocList = document.querySelector('#step2 .form-section-block:nth-of-type(1) .document-list');
  // if (result?.candidatures?.[0]?.situation_academique?.piece_jointe_path && bacDocList) {
  //   const fileUrl = `/Candidature/${result.candidatures[0].situation_academique.piece_jointe_path}`;
  //   const filename = fileUrl.split('/').pop();
  //   addExistingFileToDocumentList(bacDocList, filename, fileUrl);
  // }
  if (data.cycle) {
    const cycleRadio = document.querySelector(`input[name="cycle"][value="${data.cycle}"]`);
    if (cycleRadio) cycleRadio.checked = true;
  }

  // 🟡 Parcours académiques (cursus universitaire)
  const parcours = data.parcours || [];
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");

  parcours.forEach(async (year, index) => {
    const clone = yearTemplate.content.cloneNode(true);
    const wrapper = document.createElement("div");
    wrapper.classList.add("year-block-wrapper");
    wrapper.appendChild(clone);
    sectionContainer.appendChild(wrapper);

    const yearBlock = wrapper.querySelector(".year-block");

    yearBlock.querySelector('.select-annee').value = year.annee_academique || '';
    yearBlock.querySelector('.input-universite').value = year.universite || '';
    yearBlock.querySelector('.input-etablissement').value = year.etablissement || '';
    yearBlock.querySelector('.select-session').value = year.session || '';
    yearBlock.querySelector('.select-mention').value = year.mention || '';
    yearBlock.querySelector('.input-moyenne').value = year.moyenne || '';
    yearBlock.querySelector('.input-credit').value = year.credit || '';

    // 🎓 Ajouter années blanches si présentes
    if (year.annees_blanches && year.annees_blanches.length) {
      const checkbox = yearBlock.querySelector('.toggle-blanche-checkbox');
      checkbox.checked = true;
      checkbox.dispatchEvent(new Event("change"));

      const list = yearBlock.querySelector('.annee-blanche-list');
      const blancheTemplate = document.getElementById("annee-blanche-template");

      year.annees_blanches.forEach((blanche) => {
        const blancheClone = blancheTemplate.content.cloneNode(true);
        const container = document.createElement("div");
        container.appendChild(blancheClone);
        list.appendChild(container);

        container.querySelector('.input-nbannee').value = blanche.nbannee || '';
        container.querySelector('.textarea-cause').value = blanche.cause || '';
        // 👇 ne pas remplir input file (sécurité navigateur)
      });
    }

    console.log("year", year)
    const fileUrl = year?.piece_jointe_path;


   if (fileUrl && yearBlock) {
  const docList = yearBlock.querySelector('.document-list');
  const fullUrl = `/Candidature/${fileUrl}`;
  console.log("fullUrl" , fullUrl);
  
  const filename = fullUrl.split('/').pop();
console.log("index" , index)
  await addExistingFileToDocumentList(docList, filename, fullUrl, 'Cursus_Licence_' + index , index);
}
    initBlancheLogic(yearBlock); // relancer la logique blanche
  });
}
// TODO
// fetch('/wp-json/plateforme-master/v1/candidats')
//   .then(res => res.json())
//   .then(json => {

//     console.log("json" , json);

//     populateStep2(); // Injecte le HTML
//     setTimeout(() => {
//       const situation = json.candidatures?.[0]?.situation_academique || {};
//       situation.parcours = json.candidatures?.[0]?.parcours || [];
//       situation.annees_blanches = json.candidatures?.[0]?.annees_blanches || [];

//       fillStep2Form(situation);
//     }, 150); // attendre l’injection du DOM
//   });
/**
 * Populate step 3 of the form
 */
function populateStep3() {
  const step3 = document.getElementById('step3');
  if (step3) {
    step3.innerHTML = `
    
      
     <div class="form-group" style="width:100%">
                                            <div class="form-field" style="flex: 1; min-width: unset;">
                                              <label for="Etablissement">Etablissement<span class="required">*</span></label>
                                              <div class="select-wrapper">
                                                <select id="etablissement2" name="etablissement2" required> 
                                                   <!-- <option value="enit">Enit</option>
                                                    <option value="ensit">Ensit</option>
                                                    <option value="insat">Insat</option>-->

                                                </select>
                                            </div>                                                 
                                            <span class="error-message"></span>
                                            </div>
                                            <div class="form-field"></div>
                                            <!--<div class="form-field">
                                                <label for="Mention">Mention<span class="required">*</span></label>
                                                <div class="select-wrapper">
                                                  <select id="mention" name="mention" required>
                                                      <option value="masterRecherche">Master de recherche</option>
                                                  </select>
                                                </div>                                                 
                                               <span class="error-message"></span>
                                            </div>-->


      </div>    
      
      <div id="masters-radio-container" style="display:flex; gap:20px; flex-direction:column;"></div>

      
    <!-- <div style="display:flex;align-items:center;justify-content:space-between;argin-top: 40px;">
            
                                  <div style="display:flex;gap:20px;flex-direction:column;flex:1">
                                        <label class="role-option">
                                            <input type="radio" name="analysepolitique" value="analysepolitique">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Analyse et politique économiques</span>
                                        </label>
                                        <label class="role-option">
                                            <input type="radio" name="comptGeneral" value="comptGeneral">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Comptabilité générale</span>
                                        </label>
                                         <label class="role-option">
                                            <input type="radio" name="ecomdev" value="ecomdev">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Economie de développement</span>
                                        </label>
                                         <label class="role-option">
                                            <input type="radio" name="ecomf" value="ecomf">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Economie et finances internationales</span>
                                        </label>

    
          </div>
          <div style="display:flex;gap:20px;flex-direction:column;flex:1">
                                        <label class="role-option">
                                            <input type="radio" name="STIP" value="STIP">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">STIP</span>
                                        </label>
                                        <label class="role-option">
                                            <input type="radio" name="ecomMon" value="ecomMon">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Economie monétaire et bancaire</span>
                                        </label>
                                         <label class="role-option">
                                            <input type="radio" name="Finances" value="Finances">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Finances</span>
                                        </label>
                                         <label class="role-option">
                                            <input type="radio" name="Marketing" value="Marketing">
                                            <span class="Quicksand-regular paragraphe"
                                                style="color: black;font-family: 'Poppins';color:#2A2916">Marketing</span>
                                        </label>

    
    </div>
    
    </div> -->
      
      <div class="form-actions">
     
        <button type="button" id="prev-btn-3" class="btn btn-primary"  style="background: #A6A485;    margin-right: 122px;">PRÉCÉDENT</button>
           <button type="button" id="next-btn-4" class="btn btn-primary" style="    position: absolute;
                                    right: 0;">SUIVANT</button>
      </div>
    `;

    // populateEtablissements(); 
    // Add event listeners for step 3
    setTimeout(() => {

      document.getElementById('next-btn-4')?.addEventListener('click', () => {
        if (validationStep2I()) {

          const selected = document.querySelector('input[name="master_id"]:checked');
          console.log(selected.value)
          if (selected) {
            sessionStorage.setItem('selected_master_id', selected.value);
            console.log("✔ Master ID enregistré :", selected.value);
          } else {
            console.warn("❌ Aucun master sélectionné !");
          }

          showConfirmationPopup("Confirmez-vous les informations saisies ?", () => {
            goToStep(4);
          });
        }
      });

      const prevBtn3 = document.getElementById('prev-btn-3');
      // const submitBtn = document.getElementById('submit-btn');

      if (prevBtn3) {

        prevBtn3.addEventListener('click', () => {

          goToStep(2);
        });
      }

      // if (submitBtn) {
      //   submitBtn.addEventListener('click', (e) => {
      //     e.preventDefault();
      //     if (validateStep3()) {
      //       submitForm();
      //     }
      //   });
      // }


    }, 100);
  }

  document.getElementById('etablissement2')?.addEventListener('change', function () {
    const institutId = this.value;
    if (institutId) {
      populateMastersRadios(institutId, null); // null si aucun master présélectionné
    } else {
      document.getElementById('masters-radio-container').innerHTML = '';
    }
  });


}

/**
 * Navigate to a specific step
 * @param {number} stepNumber - The step number to navigate to
 */
function goToStep(stepNumber) {

  console.log("// Hide all steps");
  // Hide all steps
  document.querySelectorAll('.form-step').forEach(step => {
    step.classList.remove('active');
  });

  // Show the target step
  const targetStep = document.getElementById(`step${stepNumber}`);
  if (targetStep) {
    targetStep.classList.add('active');
    targetStep.classList.add('slide-in');
  }

  // Update progress indicators
  updateProgressIndicators(stepNumber);

  // Scroll to top
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**
 * Update the progress indicators based on current step
 * @param {number} currentStep - The current step number
 */
function updateProgressIndicators(currentStep) {
  const steps = document.querySelectorAll('.progress-step');

  steps.forEach((step, index) => {
    // Convert from 0-based index to 1-based step number
    const stepNum = index + 1;

    // Reset classes
    step.classList.remove('active', 'completed');

    // Set appropriate class
    if (stepNum < currentStep) {
      step.classList.add('completed');
    } else if (stepNum === currentStep) {
      step.classList.add('active');
    }
  });
}

/**
 * Setup form submission logic
 */
function setupFormSubmission() {
  const form = document.getElementById('application-form');
  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      //submitForm();
    });
  }
}

/**
 * Submit the form data
 */

/*
function submitForm() {
  // In a real application, you would send the form data to a server
  // For this demo, we'll just show a success message

  // Get form data
  const formData = new FormData(document.getElementById('application-form'));

  // Show loading state
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  // Simulate server request
  setTimeout(() => {
    // Reset loading state
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }

    // Show success message
    alert('Votre candidature a été soumise avec succès!');
   // window.location.href = "../historique-condidature/index.html";

    // Redirect to application status
    // window.location.href = '/status.html';
  }, 2000);
}
*/

/*
function submitForm() {
  const form = document.getElementById('application-form');
  if (!form) return;

  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  // Préparation des données à envoyer
  const payload = {
    parcours: document.getElementById('parcours')?.value || '',
    annee: document.getElementById('year')?.value || '',
    baccalaureat: document.getElementById('specialite')?.value || '',
    etablissement: document.getElementById('etablissement')?.value || '',
    session: document.getElementById('session')?.value || '',
    mention: document.querySelector('select[name="year"]')?.value || '',
    moyenne: document.getElementById('moyenne')?.value || '',
    nbannee: document.getElementById('nbannee')?.value || '',
    cause: document.querySelector('textarea')?.value || '',
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || ''
  };

  fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings?.nonce || ''
    },
    body: JSON.stringify(payload)
  })
  .then(response => response.json())
  .then(data => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }

    if (data.success) {
      alert('Votre candidature a été soumise avec succès !');
      //window.location.href = "../historique-condidature/index.html";
    } else {
      alert('Une erreur est survenue : ' + (data.message || 'Merci de réessayer.'));
      console.error('Réponse serveur :', data);
    }
  })
  .catch(error => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    alert('Erreur technique lors de la soumission.');
    console.error('Erreur technique :', error);
  });
}

*/
/*
function submitForm() {
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  // Situation académique principale
  const data = {
    parcours: document.getElementById('parcours')?.value || '',
    annee: document.getElementById('year')?.value || '',
    baccalaureat: document.getElementById('specialite')?.value || '',
    etablissement: document.getElementById('etablissement')?.value || '',
    session: document.getElementById('session')?.value || '',
    mention: document.querySelector('select[name="year"]')?.value || '',
    moyenne: document.getElementById('moyenne')?.value || '',
    fichier_principal: document.querySelector('.document-name')?.textContent || '',
    nbannee: document.getElementById('nbannee')?.value || '',
    cause: document.querySelector('textarea')?.value || '',
    fichier_blanche: document.querySelector('.annee-blanche-container .document-name')?.textContent || '',
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || ''
  };

  // Blocs de parcours dynamiques
  const parcoursBlocks = [];
  const yearBlocks = document.querySelectorAll('.year-block-wrapper');
  yearBlocks.forEach(block => {
    const annee = block.querySelector('select[name="year"]')?.value || '';
    const universite = block.querySelector('select[name="specialite"]')?.value || '';
    const etablissement = block.querySelector('select[name="etablissement"]')?.value || '';
    const session = block.querySelector('select[name="session"]')?.value || '';
    const mention = block.querySelector('select[name="year"]')?.value || '';
    const moyenne = block.querySelector('input[name="moyenne"]')?.value || '';
    const fichier = block.querySelector('.document-name')?.textContent || '';

    parcoursBlocks.push({
      annee, universite, etablissement, session, mention, moyenne, fichier
    });
  });

  // Blocs d'années blanches
  const anneesBlanches = [];
  const blancheBlocks = document.querySelectorAll('.annee-blanche-container');
  blancheBlocks.forEach(block => {
    const nbannee = block.querySelector('input[name="nbannee"]')?.value || '';
    const cause = block.querySelector('textarea')?.value || '';
    const fichier = block.querySelector('.document-name')?.textContent || '';

    if (nbannee || cause || fichier) {
      anneesBlanches.push({ nbannee, cause, fichier });
    }
  });

  // Construction du payload final
  const payload = {
    situation: data,
    parcours_academiques: parcoursBlocks,
    annees_blanches: anneesBlanches
  };

  // Envoi à l’API REST
  fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings?.nonce || ''
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(response => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }

    if (response.success) {
      alert('Votre candidature a été soumise avec succès !');
      //window.location.href = "../historique-condidature/index.html";
    } else {
      alert(response.message || 'Erreur lors de la soumission.');
    }
  })
  .catch(error => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    console.error('Erreur technique :', error);
    alert('Une erreur technique est survenue.');
  });
}
  function submitForm() {
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  const getVal = id => document.getElementById(id)?.value?.trim() || '';
  const getTextContent = selector => document.querySelector(selector)?.textContent?.trim() || '';

  // Étape 1 - Données personnelles
  const personal = {
    nom: getVal('nom'),
    prenom: getVal('prenom'),
    nom_ar: getVal('nom-arabe'),
    prenom_ar: getVal('prenom-arabe'),
    datenaissance: getVal('datenaissance'),
    lieunaissance: getVal('lieunaissance'),
    lieunaissance_ar: getVal('lieunaissanceAr'),
    nationalite: getVal('nationalite'),
    nationalite_ar: getVal('nationnaliteAr'),
    cin: getVal('cin'),
    cne: getVal('cne'),
    email: getVal('email'),
    email2: getVal('email2'),
    telephone: document.querySelector('.phone-input2')?.value || '',
    adresse: getVal('adresse'),
    adresseAr: getVal('adresseAr'),
    gouvernorat: getVal('gouvernorat'),
    gouvernoratAr: getVal('gouvernoratAr'),
    delegation: getVal('delegation'),
    delegationAr: getVal('delegationAr'),
    code_postal: getVal('code-postal'),
    besoins_specifiques: document.querySelector('.form-step input[type="checkbox"]')?.checked || false,
    type_besoin: getVal('type')
  };

  // Étape 2 - Situation académique principale
  const situation = {
    cycle: document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || '',
    annee: getVal('year_bac'),
    baccalaureat: getVal('specialite'),
    etablissement: getVal('etablissement'),
    session: getVal('session'),
    mention: getVal('mention_bac'),
    moyenne: getVal('moyenne'),
    fichier_principal: getTextContent('.document-list .document-name'),
    nbannee: getVal('nbannee'),
    cause: document.querySelector('.textarea-cause')?.value || '',
    fichier_blanche: getTextContent('.annee-blanche-container .document-name'),
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || '',
    niveau: document.querySelector('.niveau-radio:checked')?.value || 'M1'
  };

  // Étape 2 - Blocs de parcours
  const parcours_academiques = [];
  document.querySelectorAll('.year-block-wrapper').forEach(block => {
    parcours_academiques.push({
      annee: block.querySelector('.select-annee')?.value || '',
      universite: block.querySelector('.input-universite')?.value || '',
      etablissement: block.querySelector('.input-etablissement')?.value || '',
      session: block.querySelector('.select-session')?.value || '',
      mention: block.querySelector('.select-mention')?.value || '',
      moyenne: block.querySelector('.input-moyenne')?.value || '',
      credit: block.querySelector('.input-credit')?.value || '',
      fichier: block.querySelector('.document-name')?.textContent || ''
    });
  });

  // Étape 2 - Années blanches
  const annees_blanches = [];
  document.querySelectorAll('.annee-blanche-container').forEach(block => {
    const nb = block.querySelector('.input-nbannee')?.value || '';
    const cause = block.querySelector('.textarea-cause')?.value || '';
    const fichier = block.querySelector('.document-name')?.textContent || '';
    const annee_ref = block.closest('.year-block-wrapper')?.querySelector('.select-annee')?.value || '';

    if (nb || cause || fichier) {
      annees_blanches.push({ nbannee: nb, cause, fichier, annee_ref });
    }
  });

  // Étape 4 - Critères de score
  const criteres_score = [];
  document.querySelectorAll('#score-criteres-container input[name^="score_critere_"]').forEach(input => {
    const id = input.name.split('_').pop();
    criteres_score.push({ critere_id: parseInt(id, 10), valeur: input.value.trim() });
  });

  // Construction du payload
  const payload = {
    personal,
    situation,
    parcours_academiques,
    annees_blanches,
    criteres_score
  };

  // Envoi
  fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings?.nonce || ''
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(response => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }

    if (response.success) {
      alert('🎉 Votre candidature a été soumise avec succès !');
      // window.location.href = "../historique-condidature/index.html";
    } else {
      alert(response.message || 'Erreur lors de la soumission.');
    }
  })
  .catch(error => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    console.error('Erreur technique :', error);
    alert('Une erreur technique est survenue.');
  });
}
*/

// function submitForm() {
//   const submitBtn = document.getElementById('submit-btn');
//   if (submitBtn) {
//     submitBtn.disabled = true;
//     submitBtn.textContent = 'Soumission en cours...';
//   }

//   const getVal = id => document.getElementById(id)?.value?.trim() || '';
//   const getTextContent = selector => document.querySelector(selector)?.textContent?.trim() || '';

//   // Étape 1 – Données personnelles
//   const personal = {
//     nom: getVal('nom'),
//     prenom: getVal('prenom'),
//     nom_ar: getVal('nom-arabe'),
//     prenom_ar: getVal('prenom-arabe'),
//     datenaissance: getVal('datenaissance'),
//     lieunaissance: getVal('lieunaissance'),
//     lieunaissance_ar: getVal('lieunaissanceAr'),
//     nationalite: getVal('nationalite'),
//     nationalite_ar: getVal('nationnaliteAr'),
//     cin: getVal('cin'),
//     cne: getVal('cne'),
//     email: getVal('email'),
//     email2: getVal('email2'),
//     telephone: document.querySelector('.phone-input2')?.value || '',
//     adresse: getVal('adresse'),
//     adresseAr: getVal('adresseAr'),
//     gouvernorat: getVal('gouvernorat'),
//     gouvernoratAr: getVal('gouvernoratAr'),
//     delegation: getVal('delegation'),
//     delegationAr: getVal('delegationAr'),
//     code_postal: getVal('code-postal'),
//     besoins_specifiques: document.querySelector('.form-step input[type="checkbox"]')?.checked || false,
//     type_besoin: getVal('type')
//   };

//   // Étape 2 – Situation principale
//   const situation = {
//     cycle: document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || '',
//     annee: getVal('year_bac'),
//     baccalaureat: getVal('specialite'),
//     etablissement: getVal('etablissement'),
//     session: getVal('session'),
//     mention: getVal('mention_bac'),
//     moyenne: getVal('moyenne'),
//     fichier_principal: getTextContent('.document-list .document-name'),
//     nbannee: getVal('nbannee'),
//     cause: document.querySelector('.textarea-cause')?.value || '',
//     fichier_blanche: getTextContent('.annee-blanche-container .document-name'),
//     master_id: document.querySelector('input[name="master_id"]:checked')?.value || '',
//     niveau: document.querySelector('.niveau-radio:checked')?.value || 'M1'
//   };

//   // Étape 2 – Parcours universitaires
//   const parcours_academiques = [];
//   document.querySelectorAll('.year-block-wrapper').forEach(block => {
//     parcours_academiques.push({
//       annee: block.querySelector('.select-annee')?.value || '',
//       universite: block.querySelector('.input-universite')?.value || '',
//       etablissement: block.querySelector('.input-etablissement')?.value || '',
//       session: block.querySelector('.select-session')?.value || '',
//       mention: block.querySelector('.select-mention')?.value || '',
//       moyenne: block.querySelector('.input-moyenne')?.value || '',
//       credit: block.querySelector('.input-credit')?.value || '',
//       fichier: block.querySelector('.document-name')?.textContent || ''
//     });
//   });

//     // Étape 2 – Années blanches (multi-ligne)
//     const annees_blanches = [];
//     document.querySelectorAll('.year-block-wrapper').forEach(wrapper => {
//       const annee_ref = wrapper.querySelector('.select-annee')?.value || '';
//       const blancheBlocks = wrapper.querySelectorAll('.annee-blanche-list > .annee-blanche-container');

//       blancheBlocks.forEach(blanche => {
//         const nbannee = blanche.querySelector('.input-nbannee')?.value?.trim() || '';
//         const cause = blanche.querySelector('.textarea-cause')?.value?.trim() || '';
//         const fichier = blanche.querySelector('.document-name')?.textContent?.trim() || '';

//         if (nbannee || cause || fichier) {
//           annees_blanches.push({
//             nbannee,
//             cause,
//             fichier,
//             annee_ref
//           });
//         }
//       });
//     });




// /*
//   // ✅ Étape 4 – Critères de score dynamiques
// const criteres_score = [];

// // 1. Critères classiques (de type score_critere_ID)
// document.querySelectorAll('#score-criteres-container input[name^="score_critere_"]').forEach(input => {
//   const name = input.getAttribute('name');
//   const match = name.match(/^score_critere_(\d+)/);
//   if (match) {
//     criteres_score.push({
//       type: 'critere',
//       critere_id: parseInt(match[1]),
//       valeur: input.value.trim()
//     });
//   }
// });

// // 2. Matières : note_matiere_ID
// document.querySelectorAll('#score-criteres-container input[name^="note_matiere_"]').forEach(input => {
//   const name = input.getAttribute('name');
//   const match = name.match(/^note_matiere_(\d+)/);
//   if (match) {
//     criteres_score.push({
//       type: 'matiere',
//       matiere_id: parseInt(match[1]),
//       valeur: input.value.trim()
//     });
//   }
// });

// // 3. Malus : malus_type (ex: redoublement)
// document.querySelectorAll('#score-criteres-container input[name^="malus_"]').forEach(input => {
//   const name = input.getAttribute('name');
//   const malusType = name.replace('malus_', '');
//   criteres_score.push({
//     type: 'malus',
//     condition: malusType,
//     valeur: input.value.trim()
//   });
// });

// // 4. Interruption
// const interruptionInput = document.querySelector('input[name="interruption_diplome"]');
// if (interruptionInput) {
//   criteres_score.push({
//     type: 'interruption',
//     valeur: interruptionInput.value.trim()
//   });
// }

// // 5. Note PFE (si présente)
// const notePfeInput = document.querySelector('input[name="note_pfe"]');
// if (notePfeInput) {
//   criteres_score.push({
//     type: 'pfe',
//     valeur: notePfeInput.value.trim()
//   });
// }

// */


//    const criteres_score = [];

//   document.querySelectorAll('.score-critere-input').forEach(input => {
//     const regex = /^critere\[(\w+)\]_(\d+)(?:_(.+))?$/;
//     const match = input.name.match(regex);

//     if (!match) return;

//     const [_, type, templateId, extra] = match;
//     const valeur = input.value.trim();
//     if (!valeur) return;

//     let existing = criteres_score.find(c =>
//       c.template_id === parseInt(templateId) && c.type === type
//     );

//     if (!existing) {
//       existing = {
//         template_id: parseInt(templateId),
//         type,
//         valeur_json: {}
//       };
//       criteres_score.push(existing);
//     }

//     if (type === 'matieres' && extra?.includes('__')) {
//       const [matiereRaw, anneeRaw] = extra.split('__');
//       const matiere = matiereRaw.replace(/_/g, ' ');
//       const annee = anneeRaw.replace(/_/g, ' ');

//       existing.valeur_json[matiere] = {
//         annee: annee,
//         valeur: parseFloat(valeur)
//       };
//     } else if (extra) {
//       const key = extra.replace(/_/g, ' ');
//       existing.valeur_json[key] = parseFloat(valeur);
//     } else {
//       existing.valeur_json = { valeur: parseFloat(valeur) };
//     }
//   });





//   // Payload final à envoyer
//   const payload = {
//     personal,
//     situation,
//     parcours_academiques,
//     annees_blanches,
//     criteres_score
//   };


//   // 🧼 Nettoyer les required des champs masqués
//   document.querySelectorAll('form input:required, form select:required, form textarea:required').forEach(input => {
//     const isHidden = input.offsetParent === null || input.hidden || window.getComputedStyle(input).display === 'none';
//     if (isHidden) {
//       input.removeAttribute('required');
//     }
//   });
//   // 🔧 Supprimer les `required` des inputs dans les blocs masqués

//   // Bloc Identifiant Unique
//   const blocIdentifiantUnique = document.querySelector('.blocIdentifiantUnique');
//   if (blocIdentifiantUnique && blocIdentifiantUnique.offsetParent === null) {
//     const inputCNE = document.querySelector('input[name="cne"]');
//     const inputIdentifiant = document.querySelector('input[name="IdentifiantUnique"]');
//     if (inputCNE) inputCNE.removeAttribute('required');
//     if (inputIdentifiant) inputIdentifiant.removeAttribute('required');
//   }

//   // Bloc CIN
//   const blocCin = document.querySelector('.blocCin');
//   if (blocCin && blocCin.offsetParent === null) {
//     const inputCin = document.querySelector('input[name="cin"]');
//     if (inputCin) inputCin.removeAttribute('required');
//   }



//   // Envoi vers API WordPress
//   fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
//     method: 'POST',
//     credentials: 'include',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-WP-Nonce': PMSettings?.nonce || ''
//     },
//     body: JSON.stringify(payload)
//   })
//   .then(res => res.json())
//   .then(response => {
//     if (submitBtn) {
//       submitBtn.disabled = false;
//       submitBtn.textContent = 'SOUMETTRE';
//     }

//     if (response.success) {
//       alert('🎉 Votre candidature a été soumise avec succès !');
//       // window.location.href = '../historique-condidature/index.html';
//     } else {
//       alert(response.message || '❌ Erreur lors de la soumission.');
//     }
//   })
//   .catch(error => {
//     if (submitBtn) {
//       submitBtn.disabled = false;
//       submitBtn.textContent = 'SOUMETTRE';
//     }
//     console.error('Erreur technique :', error);
//     alert('Une erreur technique est survenue.');
//   });
// }


// Event listeners for popup buttons
document.getElementById('cancel-confirm-popup')?.addEventListener('click', () => {
  document.getElementById('form-confirm-popup').style.display = 'none';
});

document.getElementById('confirm-confirm-popup')?.addEventListener('click', () => {
  document.getElementById('form-confirm-popup').style.display = 'none';
  submitForm();
});

document.getElementById('close-error-popup')?.addEventListener('click', () => {
  document.getElementById('form-error-popup').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function () {
  const countrySelector = document.querySelector('.country-selector');
  const selectedCountry = document.querySelector('.selected-country');
  const countryDropdown = document.querySelector('.country-dropdown');
  const countryOptions = document.querySelectorAll('.country-option');
  const countryCodeDisplay = document.querySelector('.country-code');
  const phoneInput = document.querySelector('.phone-input');

  // Toggle dropdown
  selectedCountry.addEventListener('click', function () {
    countryDropdown.classList.toggle('show');
  });

  // Select a country
  countryOptions.forEach(option => {
    option.addEventListener('click', function () {
      const code = this.getAttribute('data-code');
      const flag = this.getAttribute('data-flag');

      // Update selected country display
      countryCodeDisplay.textContent = `+${code}`;
      const flagElement = selectedCountry.querySelector('.country-flag');
      flagElement.className = 'country-flag';
      flagElement.classList.add(`flag-${flag}`);

      // Close dropdown
      countryDropdown.classList.remove('show');

      // Focus on the phone input
      phoneInput.focus();
    });
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function (event) {
    if (!countrySelector.contains(event.target)) {
      countryDropdown.classList.remove('show');
    }
  });

  // Format phone number input
  // phoneInput.addEventListener('input', function(e) {
  //     let value = e.target.value.replace(/\D/g, '');
  //     let formattedValue = '';

  //     for (let i = 0; i < value.length; i++) {
  //         if (i > 0 && i % 2 === 0) {
  //             formattedValue += ' ';
  //         }
  //         formattedValue += value[i];
  //     }

  //     e.target.value = formattedValue;
  // });
});






/** parcour code imen ***/
document.addEventListener("DOMContentLoaded", function () {
  const parcoursSelect = document.getElementById("parcours");
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  const blancheTemplate = document.getElementById("annee-blanche-template");

  function initBlancheLogic(yearBlock) {
    const checkbox = yearBlock.querySelector(".toggle-blanche-checkbox");
    const container = yearBlock.querySelector(".annee-blanche-container");
    const list = yearBlock.querySelector(".annee-blanche-list");
    const addBtn = yearBlock.querySelector(".ajouter-blanche");

    checkbox.addEventListener("change", () => {
      container.style.display = checkbox.checked ? "block" : "none";
      if (checkbox.checked && list.children.length === 0) {
        addBlancheItem(list);
      }
    });

    addBtn.addEventListener("click", () => {
      addBlancheItem(list);
    });
  }

  function addBlancheItem(listContainer) {
    const clone = blancheTemplate.content.cloneNode(true);
    listContainer.appendChild(clone);
  }



});



function populateEtablissements(candidat) {
  fetch('/wp-json/plateforme-master/v1/etablissements', {
    credentials: 'include'
  })
    .then(response => response.json())
    .then(etablissements => {
      const select = document.getElementById('etablissement2');
      if (!select || !Array.isArray(etablissements)) return;

      // Récupérer institut_id depuis les données du candidat
      let selectedId = null;
      if (candidat && Array.isArray(candidat.candidatures) && candidat.candidatures.length > 0) {
        selectedId = candidat.candidatures[0]['infos'].institut_id;
      }

      select.innerHTML = '<option value="">-- Sélectionner un établissement --</option>';

      etablissements.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nom;

        if (selectedId && item.id.toString() === selectedId.toString()) {
          option.selected = true;
        }

        select.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Erreur lors du chargement des établissements :', error);
    });
}



function populateMastersRadios(institut_id, selected_master_id) {
  fetch(`/wp-json/plateforme-master/v1/masters-by-institut/${institut_id}`, {
    credentials: 'include'
  })
    .then(response => response.json())
    .then(masters => {
      const container = document.getElementById('masters-radio-container');
      if (!container) return;

      container.innerHTML = ''; // Nettoyer avant injection

      if (Array.isArray(masters)) {
        masters.forEach(master => {
          const wrapper = document.createElement('label');
          wrapper.className = 'role-option';

          const input = document.createElement('input');
          input.type = 'radio';
          input.name = 'master_id';
          input.value = master.id;
          if (String(master.id) === String(selected_master_id)) {
            input.checked = true;
          }

          const span = document.createElement('span');
          span.className = 'Quicksand-regular paragraphe';
          span.style = 'color: black; font-family: Poppins;';
          span.textContent = master.intitule_master;

          wrapper.appendChild(input);
          wrapper.appendChild(span);
          container.appendChild(wrapper);
        });
      }
    })
    .catch(err => console.error('Erreur chargement masters:', err));
}


function initBlancheLogic(yearBlock, yearIndex) {
  const checkbox = yearBlock.querySelector(".toggle-blanche-checkbox");
  const container = yearBlock.querySelector(".annee-blanche-container");
  const list = yearBlock.querySelector(".annee-blanche-list");
  const addBtn = yearBlock.querySelector(".ajouter-blanche");

  if (!checkbox || !container || !addBtn) return;

  checkbox.addEventListener("change", function () {
    container.style.display = this.checked ? "block" : "none";
    if (this.checked && list.children.length === 0) {
      addBlancheItem(list, yearIndex, 0);
    }
  });

  addBtn.addEventListener("click", () => {
    const nextIndex = list.children.length;
    addBlancheItem(list, yearIndex, nextIndex);
  });
}

async function submitForm() {
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  // 1. Validate all form steps first
  if (!validateStep1() || !validationStep2I() || !validateStep4()) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    return;
  }

  // 2. Validate file uploads
  // if (!validateFileUploads()) {
  //   showErrorModal(['Veuillez télécharger tous les documents requis']);
  //   if (submitBtn) {
  //     submitBtn.disabled = false;
  //     submitBtn.textContent = 'SOUMETTRE';
  //   }
  //   return;
  // }

  // 3. Prepare FormData payload
  const formData = new FormData();

  // For static files (Bac)
  const bacFile = document.querySelector('input[name="Bac"]')?.files[0];
  if (bacFile) formData.append('files[Bac]', bacFile);

  /// Ajouter fichiers Licence dynamiques
document.querySelectorAll('input[name^="Cursus_Licence_"]').forEach((input, index) => {
  if (input.files && input.files[0]) {
    formData.append(`files[Cursus_Licence_${index}]`, input.files[0]);
  } else if (existingUploadedFiles.Cursus_Licence && existingUploadedFiles.Cursus_Licence[index]) {
    const fileObj = existingUploadedFiles.Cursus_Licence[index];
    formData.append(`files[Cursus_Licence_${index}]`, fileObj.file, fileObj.filename);
  }
});

// Ajouter fichiers Année Blanche dynamiques
document.querySelectorAll('input[name^="Annee_Blanche_"]').forEach((input, index) => {
  if (input.files && input.files[0]) {
    formData.append(`files[Annee_Blanche_${index}]`, input.files[0]);
  } else if (existingUploadedFiles.Annee_Blanche && existingUploadedFiles.Annee_Blanche[index]) {
    const fileObj = existingUploadedFiles.Annee_Blanche[index];
    formData.append(`files[Annee_Blanche_${index}]`, fileObj.file, fileObj.filename);
  }
});

  // 5. Add personal data
  const personal = {
    nom: document.getElementById('nom').value.trim(),
    prenom: document.getElementById('prenom').value.trim(),
    nom_ar: document.getElementById('nom-arabe').value.trim(),
    prenom_ar: document.getElementById('prenom-arabe').value.trim(),
    datenaissance: document.getElementById('datenaissance').value.trim(),
    lieunaissance: document.getElementById('lieunaissance').value.trim(),
    lieunaissance_ar: document.getElementById('lieunaissanceAr').value.trim(),
    nationalite: document.getElementById('nationalite').value.trim(),
    nationalite_ar: document.getElementById('nationnaliteAr')?.value.trim() || '',
    cin: document.getElementById('cin').value.trim(),
    cne: document.getElementById('cne').value.trim(),
    email: document.getElementById('email').value.trim(),
    email2: document.getElementById('email2').value.trim(),
    telephone: document.querySelector('.phone-input2')?.value.trim() || '',
    adresse: document.getElementById('adresse').value.trim(),
    adresseAr: document.getElementById('adresseAr').value.trim(),
    gouvernorat: document.getElementById('gouvernorat').value.trim(),
    gouvernoratAr: document.getElementById('gouvernoratAr').value.trim(),
    delegation: document.getElementById('delegation').value.trim(),
    delegationAr: document.getElementById('delegationAr').value.trim(),
    code_postal: document.getElementById('code-postal').value.trim(),
    besoins_specifiques: document.querySelector('.form-step input[type="checkbox"]')?.checked || false,
    type_besoin: document.getElementById('type').value.trim()
  };
  formData.append('personal', JSON.stringify(personal));

  // 6. Add academic situation
  const situation = {
    cycle: document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || '',
    annee: document.getElementById('year_bac').value.trim(),
    baccalaureat: document.getElementById('specialite').value.trim(),
    etablissement: document.getElementById('etablissement').value.trim(),
    session: document.getElementById('session').value.trim(),
    mention: document.getElementById('mention_bac').value.trim(),
    moyenne: document.getElementById('moyenne').value.trim(),
    nbannee: document.getElementById('nbannee')?.value.trim() || '',
    cause: document.querySelector('.textarea-cause')?.value.trim() || '',
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || '',
    niveau: document.querySelector('.niveau-radio:checked')?.value || 'M1'
  };
  formData.append('situation', JSON.stringify(situation));

  // 7. Add academic journey
  const parcours_academiques = [];
  document.querySelectorAll('.year-block-wrapper').forEach((block, index) => {
    parcours_academiques.push({
      annee: block.querySelector('.select-annee')?.value.trim() || '',
      universite: block.querySelector('.input-universite')?.value.trim() || '',
      etablissement: block.querySelector('.input-etablissement')?.value.trim() || '',
      session: block.querySelector('.select-session')?.value.trim() || '',
      mention: block.querySelector('.select-mention')?.value.trim() || '',
      moyenne: block.querySelector('.input-moyenne')?.value.trim() || '',
      credit: block.querySelector('.input-credit')?.value.trim() || ''
    });
  });
  formData.append('parcours_academiques', JSON.stringify(parcours_academiques));
  console.log("parcours", JSON.stringify(parcours_academiques));


  // 8. Add gap years (années blanches)
  const annees_blanches = [];
  document.querySelectorAll('.year-block-wrapper').forEach(wrapper => {
    const annee_ref = wrapper.querySelector('.select-annee')?.value.trim() || '';
    const blancheBlocks = wrapper.querySelectorAll('.annee-blanche-list > .annee-blanche-container');

    blancheBlocks.forEach(blanche => {
      const nbannee = blanche.querySelector('.input-nbannee')?.value.trim() || '';
      const cause = blanche.querySelector('.textarea-cause')?.value.trim() || '';

      if (nbannee || cause) {
        annees_blanches.push({ nbannee, cause, annee_ref });
      }
    });
  });
  formData.append('annees_blanches', JSON.stringify(annees_blanches));
  console.log("annees_blanches", JSON.stringify(annees_blanches));

  // 9. Add score criteria
  /* const criteres_score = [];
   document.querySelectorAll('.score-critere-input').forEach(input => {
     const name = input.getAttribute('name');
     const value = input.value.trim();
 
     if (name && value) {
       criteres_score.push({
         name,
         value
       });
     }
   });
   formData.append('criteres_score', JSON.stringify(criteres_score));
   */

  // start code score avec nv critere
  const criteres_score = [];

  document.querySelectorAll('.score-critere-input').forEach(input => {
    const name = input.getAttribute('name');
    const type = input.type;
    const value = input.value.trim();

    if (!name) return;

    // 1. MATIÈRES SPÉCIFIQUES — toujours inclure, même décochée
    if (name.startsWith('critere[matieres]')) {
      const inputId = input.id;
      const checkbox = document.querySelector(`input[type="checkbox"][onchange*="${inputId}"]`);
      const checked = checkbox && checkbox.checked;

      criteres_score.push({
        name,
        value: checked ? value : '',
        etudiee: checked ? 1 : 0,
        matiere: checkbox?.dataset?.matiere || '',
        annee: checkbox?.dataset?.annee || ''
      });
    }


    // 2. SELECT (malus) — inclure valeur + libellé visible (ex: "2 fois")
    else if (input.tagName === 'SELECT') {
      const selectedOption = input.options[input.selectedIndex];
      criteres_score.push({
        name,
        value: input.value,
        label: selectedOption ? selectedOption.text : ''
      });
    }

    // 3. CASES À COCHER : ex. exclu cycle préparatoire
    else if (type === 'checkbox') {
      if (input.checked) {
        criteres_score.push({ name, value: input.value });
      }
    }

    // 4. CHAMPS standards (interruption, pfe, etc.)
    else if (value !== '') {
      criteres_score.push({ name, value });
    }
  });

  formData.append('criteres_score', JSON.stringify(criteres_score));


  // end code score avec nv critere



  console.log("form data", formData)
  // 10. Submit to server
  try {
    const response = await fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
      method: 'POST',
      body: formData,
      credentials: 'include',
      headers: {
        'X-WP-Nonce': PMSettings?.nonce || ''
      }
    });

    const result = await response.json();

    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }

    if (response.ok && result.success) {
      // Success - show confirmation
      // document.getElementById('form-confirm-message').textContent =
      //   '🎉 Votre candidature a été soumise avec succès !';
      document.getElementById('form-confirm-popup-sended').style.display = 'flex';

      // Optional: Redirect after delay
      // setTimeout(() => {
      //   window.location.href = '/public_html/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/index.php';
      // }, 3000);
    } else {
      // Error handling
      const errorMsg = result.message || 'Erreur lors de la soumission';
      showErrorModal([errorMsg]);
      console.error('Submission error:', result);
    }
  } catch (error) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    console.error('Network error:', error);
    showErrorModal(['Une erreur réseau est survenue. Veuillez réessayer.']);
  }
}

// Helper function to validate file uploads
function validateFileUploads() {
  const requiredUploads = document.querySelectorAll('.upload-container');
  let isValid = true;

  requiredUploads.forEach(container => {
    const documentList = container.querySelector('.document-list');
    const hasFiles = documentList && !documentList.querySelector('.empty-state');

    if (!hasFiles) {
      isValid = false;
      container.classList.add('upload-error');
    } else {
      container.classList.remove('upload-error');
    }
  });

  return isValid;
}

document.addEventListener('change', (e) => {
  if (e.target.classList.contains('file-input')) {
    const files = e.target.files;
    const container = e.target.closest('.form-field');
    const documentList = container.parentElement.querySelector('.document-list');

    if (!documentList) return;

    if (files.length > 0) {
      const emptyState = documentList.querySelector('.empty-state');
      if (emptyState) {
        documentList.innerHTML = '';
      }

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileExtension = file.name.split('.').pop().toUpperCase();

        const documentItem = document.createElement('div');
        documentItem.className = 'document-item';

        const nameContainer = document.createElement('div');
        nameContainer.className = 'document-name-container';

        const pdfIcon = document.createElement('div');
        pdfIcon.className = 'pdf-icon';
        nameContainer.appendChild(pdfIcon);

        const documentName = document.createElement('div');
        documentName.className = 'document-name';
        documentName.textContent = file.name;
        nameContainer.appendChild(documentName);

        documentItem.appendChild(nameContainer);
        documentList.appendChild(documentItem);
      }
    } else {
      if (documentList.children.length === 0) {
        const emptyState = document.createElement('div');
        emptyState.className = 'empty-state';
        emptyState.textContent = 'Aucun document importé';
        documentList.appendChild(emptyState);
      }
    }
  }
})
document.addEventListener("DOMContentLoaded", function () {
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  const blancheTemplate = document.getElementById("annee-blanche-template");

  const cycleRadios = document.querySelectorAll(".cycle-selection input[type='radio']");

  const cycleYearsMap = {
    licence: 3,
    maitrise: 4,
    ingenieur: 5,
    master: 5
  };

  function initBlancheLogic(yearBlock) {
    const checkbox = yearBlock.querySelector(".toggle-blanche-checkbox");
    const container = yearBlock.querySelector(".annee-blanche-container");
    const list = yearBlock.querySelector(".annee-blanche-list");
    const addBtn = yearBlock.querySelector(".ajouter-blanche");

    if (!checkbox || !container || !addBtn) return;

    checkbox.addEventListener("change", () => {
      container.style.display = checkbox.checked ? "block" : "none";
      if (checkbox.checked && list.children.length === 0) {
        addBlancheItem(list);
      }
    });

    addBtn.addEventListener("click", () => {
      addBlancheItem(list);
    });
  }

  function addBlancheItem(listContainer) {
    const clone = blancheTemplate.content.cloneNode(true);
    listContainer.appendChild(clone);
  }


  function refreshCycleSection() {
    const selected = document.querySelector(".cycle-selection input[type='radio']:checked");
    if (!selected) return;

    const cycle = selected.value;

    const cycleYearsMap = {
      licence: 3,
      maitrise: 4,
      ingenieur: 5,
      master: 5
    };

    const count = cycleYearsMap[cycle] || 1;

    createYearBlocks(count); // ✅ appel correct, cycleName est récupéré dans la fonction
  }

  cycleRadios.forEach(rb => {
    rb.addEventListener("change", refreshCycleSection);
  });

  refreshCycleSection(); // Chargement initial
});


function createYearBlocks(count) {
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  const blancheTemplate = document.getElementById("annee-blanche-template");

  if (!sectionContainer || !yearTemplate) return;

  // Clear existing sections
  sectionContainer.innerHTML = "";

  // Get selected cycle type
  const selectedCycle = document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || 'licence';

  // Create a container for this cycle
  const cycleContainer = document.createElement("div");
  cycleContainer.className = "cycle-container";
  cycleContainer.dataset.cycle = selectedCycle;

  // Add cycle title
  const cycleTitle = document.createElement("h3");
  cycleTitle.textContent = `Cursus ${selectedCycle.charAt(0).toUpperCase() + selectedCycle.slice(1)}`;
  cycleContainer.appendChild(cycleTitle);

  // Create blocks for each year
  for (let i = 0; i < count; i++) {
    const clone = yearTemplate.content.cloneNode(true);
    const yearBlock = document.createElement("div");
    yearBlock.className = "year-block-wrapper";
    yearBlock.dataset.yearIndex = i;

    // Update all field names with index
    const fields = clone.querySelectorAll('[name]');
    fields.forEach(field => {
      const originalName = field.name;
      field.name = `${originalName}_${i}`;
    });

    // Special handling for file inputs
    const fileInputs = clone.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
      if (input.name.includes('releve_notes')) {
        input.name = `Cursus_Licence_${i}`;
      }
    });

    // Add year title
    const yearTitle = document.createElement("h4");
    yearTitle.textContent = `Année ${i + 1}`;
    yearBlock.appendChild(yearTitle);
    yearBlock.appendChild(clone);

    // Initialize blanche logic
    initBlancheLogic(yearBlock, i);

    cycleContainer.appendChild(yearBlock);
  }

  sectionContainer.appendChild(cycleContainer);
}
function addBlancheItem(listContainer, yearIndex, blancheIndex) {
  const blancheTemplate = document.getElementById("annee-blanche-template");
  const clone = blancheTemplate.content.cloneNode(true);

  // Update field names with indexes
  const fields = clone.querySelectorAll('[name]');
  fields.forEach(field => {
    if (field.type === 'file') {
      field.name = `Annee_Blanche_${yearIndex}_${blancheIndex}`;
    } else {
      field.name = `${field.name}_${yearIndex}_${blancheIndex}`;
    }
  });

  listContainer.appendChild(clone);
}


function validationStep2I() {
  const missingFields = [];
  const MAX_FILE_SIZE_MB = 20;
  const MAX_FILE_SIZE = MAX_FILE_SIZE_MB * 1024 * 1024; // in bytes

  // Validate Bac fields
  const bacFields = [
    { selector: '#year_bac', label: "Année du Bac" },
    { selector: '#specialite', label: "Spécialité Bac" },
    { selector: '#etablissement', label: "Établissement Bac" },
    { selector: '#session', label: "Session Bac" },
    { selector: '#mention_bac', label: "Mention Bac" },
    { selector: '#moyenne', label: "Moyenne Bac" }
  ];

  bacFields.forEach(({ selector, label }) => {
    const el = document.querySelector(selector);
    if (!el || !el.value.trim()) {
      missingFields.push(label);
    }
  });

  // Validate Bac moyenne
  const moyenneBacInput = document.querySelector('#moyenne');
  if (moyenneBacInput) {
    const val = parseFloat(moyenneBacInput.value);
    if (isNaN(val)) {
      missingFields.push("La moyenne du Bac doit être un nombre valide.");
    } else if (val < 0 || val > 20) {
      missingFields.push("La moyenne du Bac doit être entre 0 et 20.");
    }
  }

  // Validate Bac file (either new upload or existing)
  const bacFileInput = document.querySelector('input[name="Bac"]');
  const bacFile = bacFileInput?.files?.[0];
  const existingBacFile = existingUploadedFiles.Bac?.file;
  
  if (!bacFile && !existingBacFile) {
    missingFields.push("Relevé de notes du Bac");
  } else {
    const fileToCheck = bacFile || existingBacFile;
    if (fileToCheck.size > MAX_FILE_SIZE) {
      missingFields.push(`Le fichier du Bac dépasse ${MAX_FILE_SIZE_MB} Mo`);
    }
  }

  // Validate each year block
  document.querySelectorAll(".year-block-wrapper").forEach((block, index) => {
    // Validate required fields
    const annee = block.querySelector(".select-annee")?.value.trim();
    const universite = block.querySelector(".input-universite")?.value.trim();
    const etablissement = block.querySelector(".input-etablissement")?.value.trim();
    const session = block.querySelector(".select-session")?.value.trim();
    const mention = block.querySelector(".select-mention")?.value.trim();
    const moyenne = block.querySelector(".input-moyenne")?.value.trim();
    const credit = block.querySelector(".input-credit")?.value.trim();

    if (!annee) missingFields.push(`Année - bloc ${index + 1}`);
    if (!universite) missingFields.push(`Université - bloc ${index + 1}`);
    if (!etablissement) missingFields.push(`Établissement - bloc ${index + 1}`);
    if (!session) missingFields.push(`Session - bloc ${index + 1}`);
    if (!mention) missingFields.push(`Mention - bloc ${index + 1}`);
    
    if (!moyenne) {
      missingFields.push(`Moyenne - bloc ${index + 1}`);
    } else {
      const val = parseFloat(moyenne);
      if (isNaN(val)) {
        missingFields.push(`La moyenne du bloc ${index + 1} doit être un nombre valide.`);
      } else if (val < 0 || val > 20) {
        missingFields.push(`La moyenne du bloc ${index + 1} doit être entre 0 et 20.`);
      }
    }
    
    if (!credit) {
      missingFields.push(`Crédit - bloc ${index + 1}`);
    } else {
      const val = parseFloat(credit);
      if (isNaN(val)) {
        missingFields.push(`Le crédit du bloc ${index + 1} doit être un nombre valide.`);
      } else if (val < 0 || val > 60) {
        missingFields.push(`Le crédit du bloc ${index + 1} doit être entre 0 et 60.`);
      }
    }

    // Validate file (either new upload or existing)
    const fileInput = block.querySelector(".file-input");
    const newFile = fileInput?.files?.[0];
    const existingFile = existingUploadedFiles.Cursus_Licence?.[index]?.file;
console.log("existingUploadedFiles.Cursus_Licence" ,existingUploadedFiles.Cursus_Licence);

    if (!newFile && !existingFile) {
      missingFields.push(`Relevé des notes - bloc ${index + 1}`);
    } else {
      const fileToCheck = newFile || existingFile;
      if (fileToCheck.size > MAX_FILE_SIZE) {
        missingFields.push(`Le fichier du bloc ${index + 1} dépasse ${MAX_FILE_SIZE_MB} Mo`);
      }
    }

    // Validate gap years if checkbox is checked
    const toggle = block.querySelector(".toggle-blanche-checkbox");
    if (toggle?.checked) {
      block.querySelectorAll(".annee-blanche-container .annee-blanche-list > div").forEach((blanche, bIndex) => {
        const nb = blanche.querySelector(".input-nbannee")?.value.trim();
        const cause = blanche.querySelector(".textarea-cause")?.value.trim();
        const fileInput = blanche.querySelector("input[type='file']");
        const newFile = fileInput?.files?.[0];
        const existingFile = existingUploadedFiles.Annee_Blanche?.[`${index}_${bIndex}`]?.file;

        if (!nb) missingFields.push(`Année blanche - nb ${index + 1}.${bIndex + 1}`);
        if (!cause) missingFields.push(`Année blanche - cause ${index + 1}.${bIndex + 1}`);
        
        // Validate file for gap year if required
        if (!newFile && !existingFile) {
          missingFields.push(`Justificatif année blanche - bloc ${index + 1}.${bIndex + 1}`);
        } else {
          const fileToCheck = newFile || existingFile;
          if (fileToCheck.size > MAX_FILE_SIZE) {
            missingFields.push(`Le fichier justificatif du bloc ${index + 1}.${bIndex + 1} dépasse ${MAX_FILE_SIZE_MB} Mo`);
          }
        }
      });
    }
  });

  // Show errors if any
  if (missingFields.length > 0) {
    showErrorModal(missingFields);
    return false;
  }

  return true;
}
function showErrorModal(errors) {
  const popup = document.getElementById('form-error-popup');
  const list = document.getElementById('form-error-list');
  const closeBtn = document.getElementById('close-error-popup');

  list.innerHTML = '';
  errors.forEach(msg => {
    const li = document.createElement('li');
    li.textContent = msg;
    list.appendChild(li);
  });

  popup.style.display = 'flex';

  closeBtn.onclick = () => {
    popup.style.display = 'none';
  };

  // Fermeture si clic hors de la box
  popup.addEventListener('click', function (e) {
    if (e.target === popup) {
      popup.style.display = 'none';
    }
  });
}


function loadMastersByInstitut(institutId) {
  const container = document.getElementById('masters-list-container');
  if (!container) return;

  container.innerHTML = '<p>Chargement des masters...</p>';

  fetch(`/wp-json/plateforme-master/v1/masters-par-institut/${institutId}`, {
    credentials: 'include'
  })
    .then(response => response.json())
    .then(masters => {
      if (!Array.isArray(masters) || masters.length === 0) {
        container.innerHTML = '<p style="color:#B30000">Aucun master trouvé.</p>';
        return;
      }

      const list = document.createElement('ul');
      list.style.listStyle = 'none';
      list.style.padding = '0';
      list.style.display = 'flex';
      list.style.flexDirection = 'column';
      list.style.gap = '10px';

      masters.forEach(master => {
        const item = document.createElement('li');
        item.innerHTML = `
          <div style="padding: 12px; border: 1px solid #ccc; border-radius: 6px;">
            <strong>${master.intitule_master}</strong> 
            <br><span style="color: #666;">${master.parcours}</span>
            <br><span style="color: ${master.est_publie ? '#28a745' : '#B30000'};">
              ${master.est_publie ? '✅ Publié' : '❌ Non publié'}
            </span>
          </div>
        `;
        list.appendChild(item);
      });

      container.innerHTML = '';
      container.appendChild(list);
    })
    .catch(err => {
      console.error('Erreur chargement masters :', err);
      container.innerHTML = '<p style="color:#B30000">Erreur lors du chargement des masters.</p>';
    });
}


// 👉 1. Fonction utilitaire globale

function getSelectedMasterIdFromStep3() {
  const stored = sessionStorage.getItem('selected_master_id');
  if (!stored) {
    console.warn("⚠ Aucun master_id trouvé dans sessionStorage.");
    return null;
  }
  return parseInt(stored, 10);
}


function populateStep4() {
  const step4 = document.getElementById('step4');
  if (!step4) return;

  step4.innerHTML = `
    <div class="form-section-block">
      <h3><i class="fa fa-list-alt"></i> Choisissez le niveau </h3>  
      <div class="form-field">
        <div style="display:flex; gap:30px; margin-top:10px;">
          <label>
            <input type="radio" name="niveau_score" value="M1" checked class="niveau-radio">
            <span style="margin-left:5px;">Master 1 (M1)</span>
          </label>
          <label>
            <input type="radio" name="niveau_score" value="M2" class="niveau-radio">
            <span style="margin-left:5px;">Master 2 (M2)</span>
          </label>
        </div>
      </div>
      <div class="form-field" style="margin-top: 20px;">
        <label>Formule utilisée (lecture seule)</label>
        <textarea id="formule-score" class="formule-display" readonly style="width:100%; background:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px;"></textarea>
      </div>
      <div id="score-criteres-container" style="display:flex; flex-direction:column; gap:15px; margin-top:20px;"></div>
    </div>

    <div class="form-actions" style="margin-top: 30px;">
      <button type="button" id="prev-btn-4" class="btn btn-primary" style="background: #A6A485; margin-right: 20px;">PRÉCÉDENT</button>
      <button id="submit-btn" class="btn btn-primary">ENREGISTRER</button>
    </div>
  `;

  setTimeout(() => {
    document.getElementById('prev-btn-4')?.addEventListener('click', () => {
      goToStep(3);
    });

    const selectedMasterId = getSelectedMasterIdFromStep3();
    const radios = document.querySelectorAll('.niveau-radio');
    if (!selectedMasterId) {
      console.warn("Aucun master sélectionné");
      return;
    }

    function refreshScoreCriteres() {
      console.log("inside refreshScoreCriteres");

      const selectedNiveau = document.querySelector('.niveau-radio:checked')?.value || 'M1';

      console.log("✅ Chargement critères pour niveau :", selectedNiveau, " et master_id :", selectedMasterId);
      loadScoreFormuleAndCriteres(selectedMasterId, selectedNiveau);
    }

    // écoute des radios
    radios.forEach(r => {
      r.addEventListener('change', refreshScoreCriteres);
    });

    // appel initial
    refreshScoreCriteres();
    console.log("inside refreshScoreCriteres");

    const selectedNiveau = document.querySelector('.niveau-radio:checked')?.value || 'M1';

    console.log("✅ Chargement critères pour niveau :", selectedNiveau, " et master_id :", selectedMasterId);
    loadScoreFormuleAndCriteres(selectedMasterId, selectedNiveau);
    document.getElementById('submit-btn')?.addEventListener('click', () => {
      if (validateStep4()) {
        showConfirmationPopup("Confirmez-vous les critères saisis ?", () => {
          submitForm();
          //  alert("✅ Données enregistrées avec succès."); // ou déclencher enregistrement backend
        });
      }
    });



  }, 100);

}

/*
function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');


  fetch(`/wp-json/plateforme-master/v1/score-par-master/${masterId}/${niveau}`, {
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      const { score, criteres } = data;

      container.innerHTML = '';

      if (formuleBox && score?.formule) {
        formuleBox.value = score.formule;
      } else {
        formuleBox.value = '';
      }

      if (!criteres || criteres.length === 0) {
        container.innerHTML = `<p style="color:#B30000">Aucun critère défini pour ce master.</p>`;
        return;
      }

      criteres.forEach(critere => {
        const div = document.createElement('div');
        div.className = 'form-field';
        div.innerHTML = `
          <label>${critere.champ} <span class="required">*</span></label>
          <input type="text" name="score_critere_${critere.id}" required class="score-critere-input">
        `;
        container.appendChild(div);
      });
    })
    .catch(err => {
      console.error('Erreur lors du chargement de la formule/critères :', err);
      container.innerHTML = '<p>Erreur de chargement.</p>';
    });
}
*/

/*
function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');
  if (!container || !formuleBox) return;

  fetch(`/wp-json/plateforme-master/v1/score-par-master/${masterId}/${niveau}`, {
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      const { score, criteres, malus, interruptions, matieres } = data;
      container.innerHTML = '';

      // Formule
      formuleBox.value = score?.formule || '';

      // Critères classiques
     // Critère Note PFE uniquement
      if (criteres?.length > 0) {
        const pfeCritere = criteres.find(c => c.champ.toLowerCase().includes('pfe'));

        if (pfeCritere) {
          container.innerHTML += `
            <div class="form-field">
              <label>Note PFE <span class="required">*</span></label>
              <input type="text" name="score_critere_${pfeCritere.id}" required class="score-critere-input" placeholder="Ex: 14.5">
            </div>`;
        }
      }



      // Malus : redoublement / année blanche
      if (malus?.length > 0) {
        container.innerHTML += `<h4>Malus</h4>`;
        malus.forEach(m => {
          container.innerHTML += `
            <div class="form-field">
              <label>Nombre d'année ${m.condition_texte}  <span class="required">*</span></label>
              <input type="number" name="malus_${m.condition_texte}" required class="score-critere-input" min="0">
            </div>`;
        });
      }

      // Interruptions
      if (interruptions?.length > 0) {
      container.innerHTML += `
        <h4>Interruption de parcours</h4>
        <div class="form-field">
          <label>Nombre d'années d’interruption depuis l’obtention du diplôme <span class="required">*</span></label>
          <input type="text" name="interruption_diplome" required class="score-critere-input">
        </div>`;
    }


      // Matières
      if (matieres?.length > 0) {
        container.innerHTML += `<h4>Notes de matières</h4>`;
        matieres.forEach(m => {
          container.innerHTML += `
            <div class="form-field">
              <label>${m.matiere} (${m.annee}) <span class="required">*</span></label>
              <input type="number" step="0.01" name="note_matiere_${m.id}" required class="score-critere-input" min="0" max="20">
            </div>`;
        });
      }

      // Champ pour la note PFE (si niveau M2)
      if (niveau === 'M2') {
        container.innerHTML += `
          <div class="form-field">
            <label>Note de PFE <span class="required">*</span></label>
            <input type="number" step="0.01" name="note_pfe" required class="score-critere-input" min="0" max="20">
          </div>`;
      }

    })
    .catch(err => {
      console.error('Erreur lors du chargement de la formule/critères :', err);
      container.innerHTML = '<p>Erreur de chargement.</p>';
    });
}
*/

// v 18062025
/*
function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');
  if (!container || !formuleBox) return;

  fetch(`/wp-json/plateforme-master/v1/score-par-master/${masterId}/${niveau}`, {
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      container.innerHTML = '';
      const { formule, criteres } = data;

      formuleBox.value = formule || '';

      if (!criteres || !Array.isArray(criteres)) {
        container.innerHTML = '<p>Aucun critère disponible.</p>';
        return;
      }

      criteres.forEach(crit => {
        // ❌ Ignorer certains types spécifiques
        if (['moyenne', 'credits', 'bonus_mention', 'bonus_session'].includes(crit.type)) {
          return;
        }

        let html = `<div class="form-field" style="margin-bottom:15px;"><label><strong>${crit.titre_affiche}</strong></label><br>`;
        let cfg = {};

        try {
          cfg = JSON.parse(crit.config_json || '{}');
        } catch (e) {
          console.warn('Erreur parsing JSON pour le critère', crit);
        }

        switch (crit.type) {
          case 'matieres':
            const matieres = cfg.matieres || [];
            matieres.forEach(m => {
              const nomMatiere = m.matiere || m.nom || 'Matière';
              html += `<label>${nomMatiere} (${m.annee})</label><input type="number" step="0.01" name="note_matiere_${crit.template_id}_${nomMatiere.replace(/\s+/g, '_')}" placeholder="Note" class="score-critere-input" required><br>`;
            });
            break;

          case 'pfe':
            html += `<input type="number" step="0.01" name="note_pfe_${crit.template_id}" placeholder="Note PFE" class="score-critere-input" min="0" max="20" required>`;
            break;

          case 'malus':
            const malus = cfg.conditions || [];
            malus.forEach(m => {
              html += `<label>${m.condition}</label><input type="number" name="critere_${crit.template_id}_${m.condition.replace(/\s+/g, '_')}" class="score-critere-input" min="0" required><br>`;
            });
            break;

          case 'interruption':
            html += `<label>Nombre d’années d’interruption depuis le diplôme</label>`;
            html += `<input type="number" name="critere_${crit.template_id}_nb" class="score-critere-input" min="0" required><br>`;
            break;

          case 'critere':
            html += `<input type="number" step="0.01" name="critere_${crit.template_id}" placeholder="Valeur" class="score-critere-input" required><br>`;
            break;

          case 'critere_condition':
            const first = Array.isArray(cfg?.intervalle) ? cfg.intervalle[0] : null;

            html += `
              <div class="utm-condition-block">
                <input type="number" step="0.01" name="critere_${crit.template_id}" placeholder="Valeur" class="score-critere-input" required><br>
              </div>
            `;
            break;


          default:
            html += `<input type="text" name="critere_${crit.template_id}" placeholder="Valeur" class="score-critere-input" required>`;
        }

        html += `</div>`;
        container.innerHTML += html;
      });

    })
    .catch(err => {
      console.error('❌ Erreur chargement des critères :', err);
      container.innerHTML = '<p class="text-danger">Erreur de chargement des critères.</p>';
    });
}
*/


// v 19062025

function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  console.log("inside  loadScoreFormuleAndCriteres");
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');
  console.log(container, formuleBox, masterId);

  if (!container || !formuleBox) return;

  fetch(`/wp-json/plateforme-master/v1/score-par-master/${masterId}/${niveau}`, {
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      container.innerHTML = '';
      const { formule, criteres } = data;

      formuleBox.value = formule || '';

      if (!criteres || !Array.isArray(criteres)) {
        container.innerHTML = '<p>Aucun critère disponible.</p>';
        return;
      }

      criteres.forEach(crit => {
        if (['moyenne', 'credits', 'bonus_mention', 'bonus_session'].includes(crit.type)) return;

        let html = `<div class="form-field" ><label><strong>${crit.titre_affiche}</strong></label>`;
        let cfg = {};

        try {
          cfg = JSON.parse(crit.config_json || '{}');
        } catch (e) {
          console.warn('Erreur parsing JSON pour le critère', crit);
        }

        switch (crit.type) {

          case 'matieres':
            const matieres = cfg.matieres || [];
            matieres.forEach((m, index) => {
              const nomMatiere = m.matiere || m.nom || 'Matière';
              const safeName = nomMatiere.replace(/\s+/g, '_') + '_' + index;

              const checkboxId = `etudie_${safeName}`;
              const inputId = `note_${safeName}`;
              const blocNoteClass = `bl_matiere_${inputId}`;

              html += `
                <div class="utm-matiere-block" style="margin-bottom: 15px; padding:20px 10px; border: 1px solid #ddd; border-radius: 6px;">
                  <div style="display: flex;">

                    <label for="${checkboxId}" style="margin: 0;">
                      J’ai étudié : <strong>${nomMatiere}</strong> (${m.annee})
                    </label>
                     <input type="checkbox" 
                     data-matiere="${m.matiere}"
                     data-annee="${m.annee}"
                     class="utm-checkbox" id="${checkboxId}" onchange="toggleMatiereNote('${inputId}', '${blocNoteClass}', this.checked)">

                  </div>

                  <div class="${blocNoteClass}" style="display: none;">
                    <input type="number" step="0.01"
                      id="${inputId}"
                      name="critere[matieres]_${crit.template_id}_${safeName}"
                      placeholder="Note"
                      class="score-critere-input"
                      style="margin-top: 8px; width: 100%; max-width: 300px;"
                      min="0" max="20"
                      disabled>
                  </div>
                </div>
              `;
            });



            break;



          case 'pfe':
            html += `<input type="number" step="0.01" 
              name="critere[pfe]_${crit.template_id}" 
              placeholder="Note PFE" 
              class="score-critere-input" min="0" max="20" required>`;
            break;

          case 'malus':
            const malusConditions = cfg.conditions || [];
            const groupedMalus = {};

            // Regrouper par nom de condition
            malusConditions.forEach(item => {
              const cond = item.condition;
              if (!groupedMalus[cond]) groupedMalus[cond] = [];
              groupedMalus[cond].push({ nombre: item.nombre, valeur: item.valeur });
            });

            for (const conditionName in groupedMalus) {
              const safeCond = conditionName.replace(/\s+/g, '_');
              const options = groupedMalus[conditionName];

              html += `<label>${conditionName}</label>
                <select name="critere[malus]_${crit.template_id}_${safeCond}" class="score-critere-input" required>
                  ${options.map(opt => `
                    <option value="${opt.valeur}">${opt.nombre} fois</option>
                  `).join('')}
                </select><br>`;
            }

            // Gérer option spéciale (exclu du cycle préparatoire)
            if (cfg.exclu_cycle_preparatoire) {
              html += `
                <div class="utm-malus-exclusion" style="margin-top: 10px;">
                  <label style="display: flex; align-items: center; gap: 8px; font-size: 15px; font-weight: 500; color: #444;">
                    <input type="checkbox" class="utm-checkbox" 
                      name="critere[malus]_${crit.template_id}_exclu_cycle_preparatoire" value="1">
                    Exclus du cycle préparatoire
                  </label>
                </div>
              `;
            }





            break;


          case 'interruption':
            html += `<label>Nombre d’années d’interruption depuis le diplôme</label>
              <input type="number" 
                name="critere[interruption]_${crit.template_id}" 
                class="score-critere-input" min="0" required>`;
            break;

          case 'critere':
            html += `<input type="number" step="0.01" 
              name="critere[critere]_${crit.template_id}" 
              placeholder="Valeur" 
              class="score-critere-input" required>`;
            break;

          case 'critere_condition':
            html += `
              <div class="utm-condition-block">
                <input type="number" step="0.01" 
                  name="critere[critere_condition]_${crit.template_id}" 
                  placeholder="Valeur" 
                  class="score-critere-input" required>
              </div>`;
            break;

          default:
            html += `<input type="text" 
              name="critere[autre]_${crit.template_id}" 
              placeholder="Valeur" 
              class="score-critere-input" required>`;
        }

        html += `</div>`;
        container.innerHTML += html;
      });

    })
    .catch(err => {
      console.error('❌ Erreur chargement des critères :', err);
      container.innerHTML = '<p class="text-danger">Erreur de chargement des critères.</p>';
    });
}


// Fonction globale accessible depuis les éléments HTML
function toggleMatiereNote(inputId, blocClass, checked) {
  const input = document.getElementById(inputId);
  const bloc = document.querySelector('.' + blocClass);

  if (input && bloc) {
    input.disabled = !checked;
    bloc.style.display = checked ? 'block' : 'none';

    if (checked) {
      input.setAttribute('required', 'required');
    } else {
      input.removeAttribute('required');
      input.value = '';
    }
  }
}


/*
function validateStep4() {
  const errors = [];

  // Champs classiques : tous les inputs avec la classe .score-critere-input
  document.querySelectorAll('.score-critere-input').forEach(input => {
    const value = input.value.trim();
    const label = input.closest('.form-field')?.querySelector('label')?.textContent || 'Champ requis';
    if (!value) {
      errors.push(label);
    }
  });

  // Si erreurs, afficher la modale avec les champs manquants
  if (errors.length > 0) {
    showErrorModal(errors);
    return false;
  }

  return true;
}

*/

function validateStep4() {
  const errors = [];

  // Champs dynamiques
  document.querySelectorAll('.score-critere-input').forEach(input => {
    const value = input.value.trim();
    const name = input.getAttribute('name');
    const type = input.type;
    const label = input.closest('.form-field')?.querySelector('label')?.textContent || 'Champ requis';

    if (!name) return;

    // ✅ 1. Pour les matières spécifiques : valider seulement si checkbox cochée
    if (name.startsWith('critere[matieres]')) {
      const inputId = input.id;
      const checkbox = document.querySelector(`input[type="checkbox"][onchange*="${inputId}"]`);
      if (checkbox && checkbox.checked && value === '') {
        errors.push(label + ' (matière spécifique)');
      }
    }

    // ✅ 2. Autres champs (interruption, pfe, malus, etc.)
    else if (!input.disabled && value === '') {
      errors.push(label);
    }
  });

  // Affichage des erreurs
  if (errors.length > 0) {
    showErrorModal(errors);
    return false;
  }

  return true;
}



/*
function submitForm() {
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  const getVal = id => document.getElementById(id)?.value?.trim() || '';

  const formData = new FormData();

  // Étape 1 – Données personnelles
  const personal = {
    nom: getVal('nom'),
    prenom: getVal('prenom'),
    nom_ar: getVal('nom-arabe'),
    prenom_ar: getVal('prenom-arabe'),
    datenaissance: getVal('datenaissance'),
    lieunaissance: getVal('lieunaissance'),
    lieunaissance_ar: getVal('lieunaissanceAr'),
    nationalite: getVal('nationalite'),
    nationalite_ar: getVal('nationnaliteAr'),
    cin: getVal('cin'),
    cne: getVal('cne'),
    email: getVal('email'),
    email2: getVal('email2'),
    telephone: document.querySelector('.phone-input2')?.value || '',
    adresse: getVal('adresse'),
    adresseAr: getVal('adresseAr'),
    gouvernorat: getVal('gouvernorat'),
    gouvernoratAr: getVal('gouvernoratAr'),
    delegation: getVal('delegation'),
    delegationAr: getVal('delegationAr'),
    code_postal: getVal('code-postal'),
    besoins_specifiques: document.querySelector('.form-step input[type="checkbox"]')?.checked || false,
    type_besoin: getVal('type')
  };
  formData.append('personal', JSON.stringify(personal));

  // Étape 2 – Situation principale
  const situation = {
    cycle: document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || '',
    annee: getVal('year_bac'),
    baccalaureat: getVal('specialite'),
    etablissement: getVal('etablissement'),
    session: getVal('session'),
    mention: getVal('mention_bac'),
    moyenne: getVal('moyenne'),
    nbannee: getVal('nbannee'),
    cause: document.querySelector('.textarea-cause')?.value || '',
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || '',
    niveau: document.querySelector('.niveau-radio:checked')?.value || 'M1'
  };
  formData.append('situation', JSON.stringify(situation));

  // Ajout des fichiers principaux
  const filePrincipal = document.querySelector('#fichier_principal')?.files?.[0];
  if (filePrincipal) formData.append('fichier_principal', filePrincipal);

  const fileBlanche = document.querySelector('#fichier_blanche')?.files?.[0];
  if (fileBlanche) formData.append('fichier_blanche', fileBlanche);

  // Parcours universitaires
  const parcours_academiques = [];
  document.querySelectorAll('.year-block-wrapper').forEach((block, index) => {
    parcours_academiques.push({
      annee: block.querySelector('.select-annee')?.value || '',
      universite: block.querySelector('.input-universite')?.value || '',
      etablissement: block.querySelector('.input-etablissement')?.value || '',
      session: block.querySelector('.select-session')?.value || '',
      mention: block.querySelector('.select-mention')?.value || '',
      moyenne: block.querySelector('.input-moyenne')?.value || '',
      credit: block.querySelector('.input-credit')?.value || ''
    });

    const fichier = block.querySelector('input[type="file"]')?.files?.[0];
    if (fichier) formData.append(`parcours_fichier_${index}`, fichier);
  });
  formData.append('parcours_academiques', JSON.stringify(parcours_academiques));

  // Années blanches
  const annees_blanches = [];
  document.querySelectorAll('.year-block-wrapper').forEach(wrapper => {
    const annee_ref = wrapper.querySelector('.select-annee')?.value || '';
    const blancheBlocks = wrapper.querySelectorAll('.annee-blanche-list > .annee-blanche-container');

    blancheBlocks.forEach((blanche, index) => {
      const nbannee = blanche.querySelector('.input-nbannee')?.value?.trim() || '';
      const cause = blanche.querySelector('.textarea-cause')?.value?.trim() || '';
      const fichier = blanche.querySelector('input[type="file"]')?.files?.[0];

      if (nbannee || cause || fichier) {
        annees_blanches.push({ nbannee, cause, annee_ref });
        if (fichier) {
          formData.append(`blanche_fichier_${annees_blanches.length - 1}`, fichier);
        }
      }
    });
  });
  formData.append('annees_blanches', JSON.stringify(annees_blanches));

  // Critères de score
  const criteres_score = [];

  document.querySelectorAll('#score-criteres-container input[name^="score_critere_"]').forEach(input => {
    const name = input.getAttribute('name');
    const match = name.match(/^score_critere_(\\d+)/);
    if (match) {
      criteres_score.push({
        type: 'critere',
        critere_id: parseInt(match[1]),
        valeur: input.value.trim()
      });
    }
  });

  document.querySelectorAll('#score-criteres-container input[name^="note_matiere_"]').forEach(input => {
    const match = input.getAttribute('name').match(/^note_matiere_(\\d+)/);
    if (match) {
      criteres_score.push({
        type: 'matiere',
        matiere_id: parseInt(match[1]),
        valeur: input.value.trim()
      });
    }
  });

  document.querySelectorAll('#score-criteres-container input[name^="malus_"]').forEach(input => {
    const name = input.getAttribute('name');
    criteres_score.push({
      type: 'malus',
      condition: name.replace('malus_', ''),
      valeur: input.value.trim()
    });
  });

  const interruptionInput = document.querySelector('input[name="interruption_diplome"]');
  if (interruptionInput) {
    criteres_score.push({ type: 'interruption', valeur: interruptionInput.value.trim() });
  }

  const notePfeInput = document.querySelector('input[name="note_pfe"]');
  if (notePfeInput) {
    criteres_score.push({ type: 'pfe', valeur: notePfeInput.value.trim() });
  }

  formData.append('criteres_score', JSON.stringify(criteres_score));

  // Envoi vers API WordPress
  fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'X-WP-Nonce': PMSettings?.nonce || ''
    },
    body: formData
  })
  .then(res => res.json())
  .then(response => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    if (response.success) {
      alert('🎉 Votre candidature a été soumise avec succès !');
    } else {
      alert(response.message || '❌ Erreur lors de la soumission.');
    }
  })
  .catch(error => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    console.error('Erreur technique :', error);
    alert('Une erreur technique est survenue.');
  });
}

*/


// bersion 2
/*
function submitForm() {
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  const getVal = id => document.getElementById(id)?.value?.trim() || '';
  const formData = new FormData();

  const personal = {
    nom: getVal('nom'),
    prenom: getVal('prenom'),
    nom_ar: getVal('nom-arabe'),
    prenom_ar: getVal('prenom-arabe'),
    datenaissance: getVal('datenaissance'),
    lieunaissance: getVal('lieunaissance'),
    lieunaissance_ar: getVal('lieunaissanceAr'),
    nationalite: getVal('nationalite'),
    nationalite_ar: getVal('nationnaliteAr'),
    cin: getVal('cin'),
    cne: getVal('cne'),
    email: getVal('email'),
    email2: getVal('email2'),
    telephone: document.querySelector('.phone-input2')?.value || '',
    adresse: getVal('adresse'),
    adresseAr: getVal('adresseAr'),
    gouvernorat: getVal('gouvernorat'),
    gouvernoratAr: getVal('gouvernoratAr'),
    delegation: getVal('delegation'),
    delegationAr: getVal('delegationAr'),
    code_postal: getVal('code-postal'),
    besoins_specifiques: document.querySelector('.form-step input[type="checkbox"]')?.checked || false,
    type_besoin: getVal('type')
  };

  const situation = {
    cycle: document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || '',
    annee: getVal('year_bac'),
    baccalaureat: getVal('specialite'),
    etablissement: getVal('etablissement'),
    session: getVal('session'),
    mention: getVal('mention_bac'),
    moyenne: getVal('moyenne'),
    nbannee: getVal('nbannee'),
    cause: document.querySelector('.textarea-cause')?.value || '',
    master_id: document.querySelector('input[name="master_id"]:checked')?.value || '',
    niveau: document.querySelector('.niveau-radio:checked')?.value || 'M1'
  };

  const parcours_academiques = [];
  document.querySelectorAll('.year-block-wrapper').forEach((block, index) => {
    parcours_academiques.push({
      annee: block.querySelector('.select-annee')?.value || '',
      universite: block.querySelector('.input-universite')?.value || '',
      etablissement: block.querySelector('.input-etablissement')?.value || '',
      session: block.querySelector('.select-session')?.value || '',
      mention: block.querySelector('.select-mention')?.value || '',
      moyenne: block.querySelector('.input-moyenne')?.value || '',
      credit: block.querySelector('.input-credit')?.value || ''
    });

    const fichier = block.querySelector('input[type="file"]')?.files?.[0];
    if (fichier) formData.append(`parcours_fichier_${index}`, fichier);
  });

  const annees_blanches = [];
  document.querySelectorAll('.year-block-wrapper').forEach(wrapper => {
    const annee_ref = wrapper.querySelector('.select-annee')?.value || '';
    const blancheBlocks = wrapper.querySelectorAll('.annee-blanche-list > .annee-blanche-container');
    blancheBlocks.forEach((blanche, index) => {
      const nbannee = blanche.querySelector('.input-nbannee')?.value?.trim() || '';
      const cause = blanche.querySelector('.textarea-cause')?.value?.trim() || '';
      const fichier = blanche.querySelector('input[type="file"]')?.files?.[0];
      if (nbannee || cause || fichier) {
        annees_blanches.push({ nbannee, cause, annee_ref });
        if (fichier) {
          formData.append(`blanche_fichier_${annees_blanches.length - 1}`, fichier);
        }
      }
    });
  });

  const criteres_score = [];
  document.querySelectorAll('#score-criteres-container input[name^="score_critere_"]').forEach(input => {
    const name = input.getAttribute('name');
    const match = name.match(/^score_critere_(\d+)/);
    if (match) {
      criteres_score.push({
        type: 'critere',
        critere_id: parseInt(match[1]),
        valeur: input.value.trim()
      });
    }
  });
  document.querySelectorAll('#score-criteres-container input[name^="note_matiere_"]').forEach(input => {
    const match = input.getAttribute('name').match(/^note_matiere_(\d+)/);
    if (match) {
      criteres_score.push({
        type: 'matiere',
        matiere_id: parseInt(match[1]),
        valeur: input.value.trim()
      });
    }
  });
  document.querySelectorAll('#score-criteres-container input[name^="malus_"]').forEach(input => {
    const name = input.getAttribute('name');
    criteres_score.push({
      type: 'malus',
      condition: name.replace('malus_', ''),
      valeur: input.value.trim()
    });
  });
  const interruptionInput = document.querySelector('input[name="interruption_diplome"]');
  if (interruptionInput) {
    criteres_score.push({ type: 'interruption', valeur: interruptionInput.value.trim() });
  }
  const notePfeInput = document.querySelector('input[name="note_pfe"]');
  if (notePfeInput) {
    criteres_score.push({ type: 'pfe', valeur: notePfeInput.value.trim() });
  }

  // ⬅️ ENCODAGE GLOBAL UNIQUE
  const payload = {
    personal,
    situation,
    parcours_academiques,
    annees_blanches,
    criteres_score
  };
  formData.append('payload', JSON.stringify(payload));

  // Envoi
  fetch('/wp-json/plateforme-master/v1/candidature/situation-academique', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'X-WP-Nonce': PMSettings?.nonce || ''
    },
    body: formData
  })
  .then(res => res.json())
  .then(response => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    if (response.success) {
      alert('🎉 Votre candidature a été soumise avec succès !');
    } else {
      alert(response.message || '❌ Erreur lors de la soumission.');
    }
  })
  .catch(error => {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
    }
    console.error('Erreur technique :', error);
    alert('Une erreur technique est survenue.');
  });
}
*/





// version 16062025

// Toggle dropdown




document.addEventListener('DOMContentLoaded', () => {
  loadNationalites();
});

async function loadNationalites() {
  try {
    const response = await fetch(`${PMSettings.apiUrlNationalites}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      credentials: 'include'
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('Erreur chargement nationalités :', data.message || 'Erreur inconnue');
      return;
    }

    const frSelect = document.getElementById('nationalite');
    const arSelect = document.getElementById('nationalite_ar');

    // Ajouter l'option par défaut
    frSelect.innerHTML = '<option value="">-- Sélectionner une nationalité --</option>';
    arSelect.innerHTML = '<option value="">-- اختر الجنسية --</option>';

    // Remplir avec les nationalités
    data.forEach(nat => {
      const frOption = new Option(nat.intitule, nat.id);
      const arOption = new Option(nat.intitule_ar, nat.id);
      frSelect.add(frOption);
      arSelect.add(arOption);
    });

    console.log('✅ Nationalités chargées');

    // 🔁 Synchronisation bidirectionnelle
    frSelect.addEventListener('change', () => {
      arSelect.value = frSelect.value;
      toggleCinOrIdentifiant();
    });

    arSelect.addEventListener('change', () => {
      frSelect.value = arSelect.value;
      toggleCinOrIdentifiant();
    });

  } catch (error) {
    console.error('Erreur réseau :', error);
  }
}

function toggleCinOrIdentifiant() {
  const frSelect = document.getElementById('nationalite');
  const arSelect = document.getElementById('nationalite_ar');

  const blocCin = document.querySelector('.blocCin');
  const blocIdent = document.querySelector('.blocIdentifiantUnique');

  const selectedLabelFr = frSelect.options[frSelect.selectedIndex]?.text?.toLowerCase().trim() || '';
  const selectedLabelAr = arSelect.options[arSelect.selectedIndex]?.text?.trim() || '';

  const isTunisien = selectedLabelFr === 'tunisien' || selectedLabelAr === 'تونسي';

  if (isTunisien) {
    blocCin.style.display = 'flex';
    blocIdent.style.display = 'none';
  } else {
    blocCin.style.display = 'none';
    blocIdent.style.display = 'flex';
  }
}


document.addEventListener('DOMContentLoaded', async () => {
  try {
    const response = await fetch(PMSettings.apiUrlCandidats, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      credentials: 'include'
    });

    const result = await response.json();

    // ➕ Image utilisateur
    const imageUser = document.getElementById('imageUser');
    if (imageUser && result.photo_path) {
      imageUser.src = "/Candidature/" + result.photo_path;
    }


    // Ensuite : passer les données à la fonction
    populateEtablissements(result);



    const institutId = result.candidatures?.[0]['infos']?.institut_id ?? null;
    const masterId = result.candidatures?.[0]['infos']?.master_id ?? null;

    if (institutId) {
      populateMastersRadios(institutId, masterId);
    }

    if (!response.ok || !result || !result.nom) {
      console.warn('Candidat non trouvé ou erreur :', result);
      return;
    }

    // ➕ Affichage du nom complet dans l'interface
    const displayNom = document.getElementById('displayNom');
    if (displayNom && result.nom && result.prenom) {
      displayNom.textContent = `${result.prenom} ${result.nom}`;
    }
    // ➕ Champs personnels
    document.getElementById('nom').value = result.nom || '';
    document.getElementById('nom-arabe').value = result.nom_ar || '';
    document.getElementById('prenom').value = result.prenom || '';
    document.getElementById('prenom-arabe').value = result.prenom_ar || '';
    document.getElementById('datenaissance').value = result.date_naissance || '';
    document.getElementById('lieunaissance').value = result.lieu_naissance || '';
    document.getElementById('lieunaissanceAr').value = result.lieu_naissance_ar || '';
    document.getElementById('nationalite').value = result.nationalite_fr_label || '';
    //document.getElementById('nationnaliteAr').value = result.nationalite_ar_label || '';
    // Remplir les champs
    document.getElementById('cin').value = result.cin || '';
    document.getElementById('cne').value = result.passport || '';

    // Afficher/masquer selon le cas
    const cinInput = document.getElementById('cin');
    const cneInput = document.getElementById('cne');
    const cinContainer = cinInput.closest('.form-field'); // pour cacher le bloc <div>
    const cneContainer = cneInput.closest('.form-field');

    if (result.cin) {
      if (cneContainer) cneContainer.style.display = 'none';
      if (cinContainer) cinContainer.style.display = 'block';
    } else if (result.passport) {
      if (cinContainer) cinContainer.style.display = 'none';
      if (cneContainer) cneContainer.style.display = 'block';
    } else {
      // Si les deux sont vides, afficher les deux
      if (cinContainer) cinContainer.style.display = 'block';
      if (cneContainer) cneContainer.style.display = 'block';
    }
    document.getElementById('email').value = result.email1 || '';
    document.getElementById('email2').value = result.email2 || '';
    document.querySelector('.phone-input2').value = result.telephone || '';
    document.getElementById('type').value = result.type_besoin || '';

    // ➕ Adresse (Français)
    document.getElementById('adresse').value = result.adresse_fr || '';
    document.getElementById('adresseAr').value = result.adresse_ar || '';
    document.getElementById('gouvernorat').value = result.gouvernorat_fr || '';
    document.getElementById('gouvernorat').dispatchEvent(new Event('change'));
    setTimeout(() => {
      document.getElementById('delegation').value = result.delegation_fr || '';
    }, 200);

    // ➕ Adresse (Arabe)
    document.getElementById('gouvernoratAr').value = result.gouvernorat_ar || '';
    document.getElementById('gouvernoratAr').dispatchEvent(new Event('change'));
    setTimeout(() => {
      document.getElementById('delegationAr').value = result.delegation_ar || '';
    }, 200);

    document.getElementById('code-postal').value = result.code_postal || '';

    // ➕ Besoin spécifique
    const besoinCheckbox = document.querySelector('.custom-checkbox input[type="checkbox"]');
    besoinCheckbox.checked = (result.besoin_specifique === 'oui');



    // Sélectionner la nationalité FR et AR si présentes
    const natFrSelect = document.getElementById('nationalite');
    const natArSelect = document.getElementById('nationalite_ar');


    // Sélectionner directement par ID (value)
    if (result.nationalite) {
      natFrSelect.value = result.nationalite;
    }
    if (result.nationalite_ar) {
      natArSelect.value = result.nationalite_ar;
    }

    // 🔁 Forcer la synchronisation et affichage conditionnel des blocs
    toggleCinOrIdentifiant();
    populateStep2();

    // ➕ Remplir automatiquement les champs de l'étape 2 après un court délai pour laisser le DOM se construire
    setTimeout(() => {
      const infos = result.candidatures?.[0]?.infos || {};
      const situation = result.candidatures?.[0]?.situation_academique || {};
      const parcours = result.candidatures?.[0]?.parcours || [];
      const anneesBlanches = result.candidatures?.[0]?.annees_blanches || [];

      // Fusionner les infos dans un seul objet de situation académique
      const fullSituation = {
        annee: infos.annee_universitaire || '',
        baccalaureat: situation.baccalaureat || '', // adapte selon ton backend
        etablissement: situation.etablissement || '',
        session: situation.session || 'principale',
        mention: situation.mention || '',
        moyenne: situation.moyenne || '',
        cycle: parcours?.[0]?.cycle || '', // prendre le cycle du 1er parcours si dispo
        parcours: parcours,
        annees_blanches: anneesBlanches
      };

      fillStep2Form(fullSituation);
    }, 300);
    console.log('Candidat chargé avec succès');

  } catch (error) {
    console.error('Erreur fetch /candidats :', error);
  }
});


document.addEventListener('change', function (e) {
  // Cible les <input type="radio" name="master_id">
  if (e.target.matches('input[type="radio"][name="master_id"]')) {
    const masterId = e.target.value;
    const niveau = 'M1'; // tu peux le rendre dynamique si nécessaire

    // Appelle ta fonction avec l’ID sélectionné
    loadScoreFormuleAndCriteres(masterId, niveau);
  }
});


// const existingUploadedFiles = {}; // exemple: { 'bac': File }
const existingUploadedFiles = {
  Bac: null,
  Cursus_Licence: {},  // Use object instead of array
  Annee_Blanche: {}  
};

// Corrected addExistingFileToDocumentList function
async function addExistingFileToDocumentList(documentList, filename, fileUrl, target , index = null) {
  try {
 const baseURL = window.location.origin;
    const fullUrl = fileUrl.startsWith('http') ? fileUrl : `${baseURL}${fileUrl.startsWith('/') ? '' : '/'}${fileUrl}`;
    console.log("📥 Fetching file from:", fullUrl);

    const response = await fetch(fullUrl);
    console.log("✅ Response status:", response.status);

    if (!response.ok) {
      throw new Error(`HTTP ${response.status} while fetching file`);
    }

// const response = await fetch(fileUrl);
const blob = await response.blob();
console.log("📦 Blob size:", blob.size, "type:", blob.type);
    const file = new File([blob], filename, { type: blob.type });
console.log("response" , response);
const text = await response.text();
console.log("🔍 Response text preview:\n", text.slice(0, 500));
    const documentItem = document.createElement('div');
    documentItem.className = 'document-item';
    documentItem.innerHTML = `
      <div class="document-name-container">
        <div class="pdf-icon"></div>
        <div class="document-name">${filename}</div>
      </div>
      <span class="remove-document">&times;</span>
    `;

    documentItem.querySelector('.remove-document').addEventListener('click', () => {
      documentItem.remove();
      if (documentList.children.length === 0) {
        documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
      }

      if (target === 'Bac') {
        existingUploadedFiles.Bac = null;
      } else if (target === 'Cursus_Licence' && index !== null) {
        delete existingUploadedFiles.Cursus_Licence[index];
      } else if (target === 'Annee_Blanche' && index !== null) {
        delete existingUploadedFiles.Annee_Blanche[`${index}`];
      }
    });

    // Remove empty state and append document item
    documentList.innerHTML = '';
    documentList.appendChild(documentItem);

    // Store the file object appropriately
    if (target === 'Bac') {
      existingUploadedFiles.Bac = { file, filename };
    }
    
    else if (target === 'Cursus_Licence' && index !== null) {
      console.log("target " ,target);
      
      if (!Array.isArray(existingUploadedFiles.Cursus_Licence)) {
        existingUploadedFiles.Cursus_Licence = [];
      }
      existingUploadedFiles.Cursus_Licence[index] = { file, filename };

      console.log("after" ,index,existingUploadedFiles.Cursus_Licence );
      
    } else if (target === 'Annee_Blanche' && index !== null) {
      if (typeof existingUploadedFiles.Annee_Blanche !== 'object') {
        existingUploadedFiles.Annee_Blanche = {};
      }
      existingUploadedFiles.Annee_Blanche[`${index}`] = { file, filename };
    }
  } catch (error) {
    console.error('Erreur lors de l’ajout du fichier existant :', error);
  }
}






/**
 * Initialize file upload functionality
 */
function initializeFileUploads() {
  // Event delegation for upload buttons
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('upload-btn')) {
      const container = e.target.closest('.upload-container');
      const fileInput = container.querySelector('.file-input');
      fileInput.click();
    }
  });

  // Handle file selection
  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('file-input')) {
      const files = e.target.files;
      const container = e.target.closest('.form-field');
      const documentList = container.querySelector('.document-list');

      if (!documentList) return;

      updateDocumentList(documentList, files);
      validateFileUploads();
    }
  });
}

/**
 * Update the document list display
 */
function updateDocumentList(documentList, files) {
  if (files.length > 0) {
    // Clear empty state if it exists
    const emptyState = documentList.querySelector('.empty-state');
    if (emptyState) {
      documentList.innerHTML = '';
    }

    // Add each file to the list
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      addFileToDocumentList(documentList, file);
    }
  } else {
    // Show empty state if no files
    if (documentList.children.length === 0) {
      documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
    }
  }
}

/**
 * Add a single file to the document list
 */
function addFileToDocumentList(documentList, file) {
  const fileExtension = file.name.split('.').pop().toUpperCase();

  const documentItem = document.createElement('div');
  documentItem.className = 'document-item';

  const nameContainer = document.createElement('div');
  nameContainer.className = 'document-name-container';

  // Add PDF icon
  const pdfIcon = document.createElement('div');
  pdfIcon.className = 'pdf-icon';
  nameContainer.appendChild(pdfIcon);

  const documentName = document.createElement('div');
  documentName.className = 'document-name';
  documentName.textContent = file.name;
  nameContainer.appendChild(documentName);

  // Add remove button
  const removeBtn = document.createElement('span');
  removeBtn.className = 'remove-document';
  removeBtn.innerHTML = '&times;';
  removeBtn.addEventListener('click', () => {
    documentItem.remove();
    if (documentList.children.length === 0) {
      documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
    }
    validateFileUploads();
  });

  documentItem.appendChild(nameContainer);
  documentItem.appendChild(removeBtn);
  documentList.appendChild(documentItem);
}

/**
 * Validate file uploads before form submission
 */
function validateFileUploads() {
  const requiredUploads = document.querySelectorAll('.upload-container');
  let isValid = true;

  requiredUploads.forEach(container => {
    const documentList = container.querySelector('.document-list');
    const hasFiles = documentList && !documentList.querySelector('.empty-state');

    if (!hasFiles) {
      isValid = false;
      container.classList.add('upload-error');
    } else {
      container.classList.remove('upload-error');
    }
  });

  return isValid;
}

/**
 * Get all uploaded files for form submission
 */
function getUploadedFiles() {
  const fileInputs = document.querySelectorAll('.file-input');
  const uploadedFiles = [];

  fileInputs.forEach(input => {
    if (input.files && input.files.length > 0) {
      Array.from(input.files).forEach(file => {
        uploadedFiles.push({
          name: file.name,
          type: file.type,
          size: file.size,
          inputName: input.name || input.id,
          element: input
        });
      });
    }
  });

  return uploadedFiles;
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  initializeFileUploads();
});