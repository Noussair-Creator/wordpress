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

  // Add animation classes
  document.querySelector('.form-container').classList.add('fade-in');
}

/**
 * Add event listeners to form elements
 */
function addEventListeners() {
  console.log("inside");

  // Next button in step 1
  const nextBtn = document.getElementById('next-btn');
  console.log(nextBtn);

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      console.log(validateStep1());

      if (validateStep1()) {
        console.log("click");

        goToStep(2);
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
                        <div class="form-group">
                            <div class="form-field">
                                <label for="adresse">Adresse (Français) <span class="required">*</span></label>
                                <input type="text" id="adresse" name="adresse" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="adresseAr" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>العنوان </label>
                                <input type="text" id="adresseAr" name="adresseAr" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                         <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="gouvernorat">Gouvernorat <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="gouvernorat" name="gouvernorat" required>
                                            <option value="">-- Sélectionner --</option>
                                            <option value="Ariana">Ariana</option>
                                            <option value="Béja">Béja</option>
                                            <option value="Ben Arous">Ben Arous</option>
                                            <option value="Bizerte">Bizerte</option>
                                            <option value="Gabès">Gabès</option>
                                            <option value="Gafsa">Gafsa</option>
                                            <option value="Jendouba">Jendouba</option>
                                            <option value="Kairouan">Kairouan</option>
                                            <option value="Kasserine">Kasserine</option>
                                            <option value="Kébili">Kébili</option>
                                            <option value="Kef">Kef</option>
                                            <option value="Mahdia">Mahdia</option>
                                            <option value="La Manouba">La Manouba</option>
                                            <option value="Médenine">Médenine</option>
                                            <option value="Monastir">Monastir</option>
                                            <option value="Nabeul">Nabeul</option>
                                            <option value="Sfax">Sfax</option>
                                            <option value="Sidi Bouzid">Sidi Bouzid</option>
                                            <option value="Siliana">Siliana</option>
                                            <option value="Sousse">Sousse</option>
                                            <option value="Tataouine">Tataouine</option>
                                            <option value="Tozeur">Tozeur</option>
                                            <option value="Tunis">Tunis</option>
                                            <option value="Zaghouan">Zaghouan</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="gouvernoratAr" style="text-align: end;"> (Arabe)<span
                                            class="required">*</span> الولاية </label>
                                    <div class="select-wrapper">
                                        <select id="gouvernoratAr" name="gouvernoratAr" required>
                                            <option value="">-- اختر --</option>
                                            <option value="أريانة">أريانة</option>
                                            <option value="باجة">باجة</option>
                                            <option value="بن عروس">بن عروس</option>
                                            <option value="بنزرت">بنزرت</option>
                                            <option value="قابس">قابس</option>
                                            <option value="قفصة">قفصة</option>
                                            <option value="جندوبة">جندوبة</option>
                                            <option value="القيروان">القيروان</option>
                                            <option value="القصرين">القصرين</option>
                                            <option value="قبلي">قبلي</option>
                                            <option value="الكاف">الكاف</option>
                                            <option value="المهدية">المهدية</option>
                                            <option value="منوبة">منوبة</option>
                                            <option value="مدنين">مدنين</option>
                                            <option value="المنستير">المنستير</option>
                                            <option value="نابل">نابل</option>
                                            <option value="صفاقس">صفاقس</option>
                                            <option value="سيدي بوزيد">سيدي بوزيد</option>
                                            <option value="سليانة">سليانة</option>
                                            <option value="سوسة">سوسة</option>
                                            <option value="تطاوين">تطاوين</option>
                                            <option value="توزر">توزر</option>
                                            <option value="تونس">تونس</option>
                                            <option value="زغوان">زغوان</option>
                                        </select>

                                    </div>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="delegation">Délégation <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="delegation" name="delegation" required>
                                            <option value="">-- Sélectionner un gouvernorat d'abord --</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="delegationAr" style="text-align: end;">(Arabe) <span
                                            class="required">*</span>المعتمدية </label>
                                    <select id="delegationAr" name="delegationAr" required>
                                        <option value="">-- الرجاء اختيار معتمدية --</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="form-field form-field">
                                <label for="code-postal">Code postal / Casier P <span class="required">*</span></label>
                                <input type="number" id="code-postal" name="code-postal" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                       
        <div id="additionalSectionsContainer"></div>  
         <button type="button" id="addParentAddress" class="btn-secondary ">
         <img src="../assets/plus.png" style="width:19px">
         <div class="Quicksand-bold paragraphe" style="color:black">Ajouter adresse parent</div>
         </button>
<div class="form-actions" style="gap: 10px;">
                            <div type="button" id="prev-btn" onclick="goToStep(1)" class="flesh-container">
                                <img src="../assets/arrow_write.png" style="width: 14px;transform: rotate(180deg);">
                            </div>
                            <div style="display: flex;align-items: center;gap: 10px;">
                                <div style="width: 17px;
                                height: 17px;
                                border-radius: 50%;
                                background: #DDACA7 0% 0% no-repeat padding-box;"></div>
                                <div style="width: 17px;
                                 height: 17px;
                                 border-radius: 50%;
                                 background:  #BF0404 0% 0% no-repeat padding-box;"></div>
                            </div>
                            <div type="button" id="next-btn" class="flesh-container">
                                <img src="../assets/arraw_left_grey.png" style="width: 14px;transform: rotate(180deg);">
                            </div>
                        </div>
    
      `;

    // Add event listeners for step 2
    setTimeout(() => {
      const addBtn = document.getElementById('addParentAddress');
      if (addBtn) {
        addBtn.addEventListener('click', addAcademicSituationBlock);
      }
      const prevBtn2 = document.getElementById('prev-btn');

      if (prevBtn2) {
        prevBtn2.addEventListener('click', () => {
          goToStep(1);
        });
      }


    }, 100);
  }
}
function addAcademicSituationBlock() {
  const container = document.getElementById('additionalSectionsContainer');
  const addBtn = document.getElementById('addParentAddress');
  if (!container || !addBtn) return;

  // Prevent adding more than one
  if (container.querySelector('.form-section')) return;

  const newBlock = document.createElement('div');
  newBlock.id = "newBloc"
  newBlock.className = 'form-section';
  newBlock.innerHTML = `
    <div class="form-section">
      <div class="Quicksand-bold smallText" style="margin-bottom: 20px; color: black; font-size: 20px;">Adresse parent</div>

      <div class="form-group">
        <div class="form-field">
          <label for="adresse">Adresse (Français) <span class="required">*</span></label>
          <input type="text" id="adresse" name="adresse" required>
          <span class="error-message"></span>
        </div>
        <div class="form-field">
          <label for="adresseAr" style="text-align: end;">(Arabe) <span class="required">*</span>العنوان </label>
          <input type="text" id="adresseAr" name="adresseAr" required>
          <span class="error-message"></span>
        </div>
      </div>

      <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="gouvernorat">Gouvernorat <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="gouvernorat" name="gouvernorat" required>
                                            <option value="">-- Sélectionner --</option>
                                            <option value="Ariana">Ariana</option>
                                            <option value="Béja">Béja</option>
                                            <option value="Ben Arous">Ben Arous</option>
                                            <option value="Bizerte">Bizerte</option>
                                            <option value="Gabès">Gabès</option>
                                            <option value="Gafsa">Gafsa</option>
                                            <option value="Jendouba">Jendouba</option>
                                            <option value="Kairouan">Kairouan</option>
                                            <option value="Kasserine">Kasserine</option>
                                            <option value="Kébili">Kébili</option>
                                            <option value="Kef">Kef</option>
                                            <option value="Mahdia">Mahdia</option>
                                            <option value="La Manouba">La Manouba</option>
                                            <option value="Médenine">Médenine</option>
                                            <option value="Monastir">Monastir</option>
                                            <option value="Nabeul">Nabeul</option>
                                            <option value="Sfax">Sfax</option>
                                            <option value="Sidi Bouzid">Sidi Bouzid</option>
                                            <option value="Siliana">Siliana</option>
                                            <option value="Sousse">Sousse</option>
                                            <option value="Tataouine">Tataouine</option>
                                            <option value="Tozeur">Tozeur</option>
                                            <option value="Tunis">Tunis</option>
                                            <option value="Zaghouan">Zaghouan</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="gouvernoratAr" style="text-align: end;"> (Arabe)<span
                                            class="required">*</span> الولاية </label>
                                    <div class="select-wrapper">
                                        <select id="gouvernoratAr" name="gouvernoratAr" required>
                                            <option value="">-- اختر --</option>
                                            <option value="أريانة">أريانة</option>
                                            <option value="باجة">باجة</option>
                                            <option value="بن عروس">بن عروس</option>
                                            <option value="بنزرت">بنزرت</option>
                                            <option value="قابس">قابس</option>
                                            <option value="قفصة">قفصة</option>
                                            <option value="جندوبة">جندوبة</option>
                                            <option value="القيروان">القيروان</option>
                                            <option value="القصرين">القصرين</option>
                                            <option value="قبلي">قبلي</option>
                                            <option value="الكاف">الكاف</option>
                                            <option value="المهدية">المهدية</option>
                                            <option value="منوبة">منوبة</option>
                                            <option value="مدنين">مدنين</option>
                                            <option value="المنستير">المنستير</option>
                                            <option value="نابل">نابل</option>
                                            <option value="صفاقس">صفاقس</option>
                                            <option value="سيدي بوزيد">سيدي بوزيد</option>
                                            <option value="سليانة">سليانة</option>
                                            <option value="سوسة">سوسة</option>
                                            <option value="تطاوين">تطاوين</option>
                                            <option value="توزر">توزر</option>
                                            <option value="تونس">تونس</option>
                                            <option value="زغوان">زغوان</option>
                                        </select>

                                    </div>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="delegation">Délégation <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="delegation" name="delegation" required>
                                            <option value="">-- Sélectionner un gouvernorat d'abord --</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="delegationAr" style="text-align: end;">(Arabe) <span
                                            class="required">*</span>المعتمدية </label>
                                    <select id="delegationAr" name="delegationAr" required>
                                        <option value="">-- الرجاء اختيار معتمدية --</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>d

      <div class="form-group">
        <div class="form-field">
          <label for="code-postal">Code postal / Casier P <span class="required">*</span></label>
          <input type="number" id="code-postal" name="code-postal" required>
          <span class="error-message"></span>
        </div>
      </div>

     

      <div class="filled-btn" onclick="removeParentAddress(this)" style="width: 159px;">Supprimer</div>
    </div>
  `;

  container.appendChild(newBlock);
  addBtn.style.display = 'none'; // Hide button
}
function removeParentAddress(button) {
  console.log("inside removeParentAddress");

  const container = document.getElementById('additionalSectionsContainer');
  const addBtn = document.getElementById('addParentAddress');
  console.log(container);
  console.log(addBtn);


  if (!container || !addBtn) return;

  const block = document.getElementById('newBloc');
  if (block) {
    console.log("inside block");

    block.remove();
    addBtn.style.display = 'flex';
  }
}

/**
 * Populate step 3 of the form
 */
function populateStep3() {
  const step3 = document.getElementById('step3');
  if (step3) {
    step3.innerHTML = `
        <div class="section-title">
          <h2>CONFIRMATION</h2>
        </div>
        
        <div class="form-group">
          <p>Veuillez vérifier les informations saisies avant de soumettre votre candidature.</p>
        </div>
        
        <div class="form-group">
          <div class="checkbox-field">
            <input type="checkbox" id="confirm-data" name="confirm-data" required>
            <label for="confirm-data">Je confirme l'exactitude des informations fournies <span class="required">*</span></label>
            <span class="error-message"></span>
          </div>
        </div>
        
        <div class="form-group">
          <div class="checkbox-field">
            <input type="checkbox" id="accept-terms" name="accept-terms" required>
            <label for="accept-terms">J'accepte les conditions d'utilisation <span class="required">*</span></label>
            <span class="error-message"></span>
          </div>
        </div>
        
        <div class="form-actions">
          <button type="button" id="prev-btn-3" class="btn btn-secondary">PRÉCÉDENT</button>
          <button type="submit" id="submit-btn" class="btn btn-primary">SOUMETTRE</button>
        </div>
      `;

    // Add event listeners for step 3
    setTimeout(() => {
      const prevBtn3 = document.getElementById('prev-btn-3');
      const submitBtn = document.getElementById('submit-btn');

      if (prevBtn3) {
        prevBtn3.addEventListener('click', () => {
          goToStep(2);
        });
      }

      if (submitBtn) {
        submitBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (validateStep3()) {
            submitForm();
          }
        });
      }
    }, 100);
  }
}

/**
 * Navigate to a specific step
 * @param {number} stepNumber - The step number to navigate to
 */
function goToStep(stepNumber) {

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
  document.getElementById('stepIndicator').textContent = `${stepNumber}/2`;

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
      submitForm();
    });
  }
}

/**
 * Submit the form data
 */
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

    // Redirect to application status
    // window.location.href = '/status.html';
  }, 2000);
}
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

/*
const addBtn = document.getElementById('goto');

addBtn.addEventListener('click', () => {
  console.log("here");
  
  window.location.href = "../connexion/index.html";

});*/


document.getElementById('goto')?.addEventListener('click', (e) => {
  e.preventDefault();

  if (validateStep1() && validateStep3()) {
    submitForm();
  } else {
    alert('Merci de vérifier les champs obligatoires.');
  }
});

function previewFile(event) {
  const file = event.target.files[0];
  if (file && file.size <= 20 * 1024 * 1024) { // 20MB limit
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('previewImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    alert("Fichier trop volumineux ou format non supporté.");
  }
}


function submitForm() {
  const form = document.getElementById('application-form');
  const formData = new FormData(form);
  const data = {};

  formData.forEach((value, key) => {
    data[key] = value;
  });

  // Adresse parentale (si bloc visible)
  const parentBloc = document.getElementById('newBloc');
  if (parentBloc) {
    data['adresse_parent'] = parentBloc.querySelector('input[name="adresse"]')?.value || '';
    data['adresseAr_parent'] = parentBloc.querySelector('input[name="adresseAr"]')?.value || '';
    data['gouvernorat_parent'] = parentBloc.querySelector('select[name="gouvernorat"]')?.value || '';
    data['gouvernoratAr_parent'] = parentBloc.querySelector('select[name="gouvernoratAr"]')?.value || '';
    data['delegation_parent'] = parentBloc.querySelector('select[name="delegation"]')?.value || '';
    data['delegationAr_parent'] = parentBloc.querySelector('select[name="delegationAr"]')?.value || '';
    data['code_postal_parent'] = parentBloc.querySelector('input[name="code-postal"]')?.value || '';
  }

  const submitBtn = document.getElementById('submit-btn');
  submitBtn.disabled = true;
  submitBtn.textContent = 'Soumission...';

  fetch('../api/candidature.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(response => {
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';

      if (response.status === 'success') {
        alert("Candidature enregistrée avec succès !");
        form.reset();
        goToStep(1);
      } else {
        alert("Erreur : " + response.message);
      }
    })
    .catch(error => {
      console.error(error);
      submitBtn.disabled = false;
      submitBtn.textContent = 'SOUMETTRE';
      alert("Une erreur s’est produite.");
    });
}
