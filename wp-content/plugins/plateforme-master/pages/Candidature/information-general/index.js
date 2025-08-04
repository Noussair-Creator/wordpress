document.addEventListener('DOMContentLoaded', () => {
  initializeForm();
  addEventListeners();
  initializeCharacterCounters();
  setupFormSubmission();

  document.getElementById('goto')?.addEventListener('click', (e) => {
    e.preventDefault();
    submitForm();
  });
});

function initializeForm() {
  populateStep2();
  document.querySelector('.form-container').classList.add('fade-in');
}

function addEventListeners() {
  const nextBtn = document.getElementById('next-btn');
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      console.log('next-btn');
      if (validateStep1()) goToStep(2);
    });
  }
}
function populateStep2() {
  const step2 = document.getElementById('step2');
  if (!step2) return;

  step2.innerHTML = `
    <div class="form-group">
      <div class="form-field">
        <label for="adresse">Adresse (Français) *</label>
        <input type="text" id="adresse" name="adresse" required />
      </div>
      <div class="form-field">
        <label for="adresseAr">(Arabe) * العنوان</label>
        <input type="text" id="adresseAr" name="adresseAr" required />
      </div>
    </div>
    <div class="form-group">
      <div class="form-field">
        <label for="gouvernorat">Gouvernorat *</label>
        <select id="gouvernorat" name="gouvernorat" required>
          <option value="">-- Sélectionner --</option>
          <option value="Ariana">Ariana</option>
          <option value="Tunis">Tunis</option>
          <!-- ajouter les autres options ici -->
        </select>
      </div>
      <div class="form-field">
        <label for="gouvernoratAr">(Arabe)* الولاية</label>
        <select id="gouvernoratAr" name="gouvernoratAr" required>
          <option value="">-- اختر --</option>
          <option value="تونس">تونس</option>
          <option value="أريانة">أريانة</option>
          <!-- ajouter les autres options ici -->
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="form-field">
        <label for="delegation">Délégation *</label>
        <select id="delegation" name="delegation" required>
          <option value="">-- Sélectionner un gouvernorat d'abord --</option>
        </select>
      </div>
      <div class="form-field">
        <label for="delegationAr">(Arabe) * المعتمدية</label>
        <select id="delegationAr" name="delegationAr" required>
          <option value="">-- الرجاء اختيار معتمدية --</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="form-field">
        <label for="code-postal">Code postal / Casier P *</label>
        <input type="number" id="code-postal" name="code_postal" required />
      </div>
    </div>
    <div id="additionalSectionsContainer"></div>
    <button type="button" id="addParentAddress" class="btn-secondary">
      <img src="../assets/plus.png" style="width:19px" />
      <span>Ajouter adresse parent</span>
    </button>
  `;

  document.getElementById('addParentAddress')?.addEventListener('click', addParentAddressBlock);
}



function addParentAddressBlock() {
  const container = document.getElementById('additionalSectionsContainer');
  if (!container || document.getElementById('newBloc')) return;

  const block = document.createElement('div');
  block.id = 'newBloc';
  block.innerHTML = `
    <hr />
    <h3>Adresse du parent</h3>
    <div class="form-group">
      <input type="text" name="adresse" placeholder="Adresse (FR)" required />
      <input type="text" name="adresseAr" placeholder="Adresse (AR)" required />
    </div>
    <div class="form-group">
      <select name="gouvernorat" required>
        <option value="">-- Gouvernorat --</option>
        <option value="Tunis">Tunis</option>
      </select>
      <select name="gouvernoratAr" required>
        <option value="">-- الولاية --</option>
        <option value="تونس">تونس</option>
      </select>
    </div>
    <div class="form-group">
      <select name="delegation" required>
        <option value="">-- Délégation --</option>
      </select>
      <select name="delegationAr" required>
        <option value="">-- المعتمدية --</option>
      </select>
    </div>
    <div class="form-group">
      <input type="number" name="code-postal" placeholder="Code postal" required />
    </div>
    <button type="button" onclick="removeParentAddressBlock()">Supprimer</button>
  `;

  container.appendChild(block);
  document.getElementById('addParentAddress').style.display = 'none';
}

function removeParentAddressBlock() {
  document.getElementById('newBloc')?.remove();
  document.getElementById('addParentAddress').style.display = 'block';
}

function initializeCharacterCounters() {

    const fieldsWithCounter = [
    { input: 'nom', counter: 'nom-length' },
    { input: 'prenom', counter: 'prenom-length' },
    { input: 'nom_ar', counter: 'nom-ar-length' },
    { input: 'prenom_ar', counter: 'prenom-ar-length' },
    { input: 'nationalite', counter: 'nationalite-length' },
    { input: 'adresse', counter: 'adresse-length' },
    { input: 'delegation', counter: 'delegation-length' },
    { input: 'IdentifiantUnique', counter: 'IdentifiantUnique-length' },

  ];


  fieldsWithCounter.forEach(field => {
    const input = document.getElementById(field.input);
    const counter = document.getElementById(field.counter);
    if (input && counter) {
      counter.value = input.value.length;
      input.addEventListener('input', () => {
        counter.value = input.value.length;
      });
    }
  });
}

function goToStep(step) {
  document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
  const target = document.getElementById(`step${step}`);
  if (target) {
    target.classList.add('active');
    target.classList.add('slide-in');
  }
  updateProgressIndicators(step);
  document.getElementById('stepIndicator').textContent = `${step}/2`;
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateProgressIndicators(currentStep) {
  document.querySelectorAll('.progress-step').forEach((step, index) => {
    step.classList.remove('active', 'completed');
    if (index + 1 < currentStep) step.classList.add('completed');
    else if (index + 1 === currentStep) step.classList.add('active');
  });
}

function setupFormSubmission() {
  document.getElementById('application-form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    submitForm();
  });
}

function submitForm() {
  const form = document.getElementById('application-form');
  const formData = new FormData(form);
  const data = {};
  formData.forEach((value, key) => data[key] = value);

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
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission...';
  }

  fetch('../api/candidature.php', {
    method: 'POST',
    //headers: { 'Content-Type': 'application/json' },
    //body: formData //JSON.stringify(data)
    method: 'POST',
    body: formData // PAS de headers manuels ici
  })
    .then(res => res.json())
    .then(response => {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'SOUMETTRE';
      }
      if (response.status === 'success') {
        alert("Candidature enregistrée avec succès !");
        form.reset();
        goToStep(1);
      } else {
        alert("Erreur : " + response.message);
      }
    })
    .catch(error => {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'SOUMETTRE';
      }
      alert("Une erreur s’est produite.");
      console.error(error);
    });
}

function previewFile(event) {
  const file = event.target.files[0];
  if (file && file.size <= 20 * 1024 * 1024) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('previewImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    alert("Fichier trop volumineux ou format non supporté.");
  }
}


function loadNationalites() {
  fetch('../api/get_nationalites.php')
    .then(res => res.json())
    .then(response => {
      if (response.status === 'success') {
        const frSelect = document.getElementById('nationalite');
        const arSelect = document.getElementById('nationalite_ar');

        // Ajouter l'option par défaut
        frSelect.innerHTML = '<option value="">-- Sélectionner une nationalité --</option>';
        arSelect.innerHTML = '<option value="">-- اختر الجنسية --</option>';

        // Remplir avec les nationalités
        response.data.forEach(nat => {
          const frOption = new Option(nat.intitule, nat.id);
          const arOption = new Option(nat.intitule_ar, nat.id);
          frSelect.add(frOption);
          arSelect.add(arOption);
        });

        // 🔁 Synchronisation bidirectionnelle
        frSelect.addEventListener('change', () => {
          arSelect.value = frSelect.value;
          toggleCinOrIdentifiant();

        });

        arSelect.addEventListener('change', () => {
          frSelect.value = arSelect.value;
          toggleCinOrIdentifiant();

        });
      } else {
        console.error('Erreur chargement nationalités :', response.message);
      }
    })
    .catch(error => console.error('Erreur réseau :', error));
}

document.addEventListener('DOMContentLoaded', () => {
  loadNationalites();
});


function toggleCinOrIdentifiant() {
  const frSelect = document.getElementById('nationalite');
  const arSelect = document.getElementById('nationalite_ar');

  const blocCin = document.querySelector('.blocCin');
  const blocIdent = document.querySelector('.blocIdentifiantUnique');

  const selectedLabelFr = frSelect.options[frSelect.selectedIndex]?.text?.toLowerCase().trim() || '';
  const selectedLabelAr = arSelect.options[arSelect.selectedIndex]?.text?.trim() || '';

  const isTunisien = selectedLabelFr === 'Tunisien' || selectedLabelAr === 'تونسي';

  if (isTunisien) {
    blocCin.style.display = 'flex';
    blocIdent.style.display = 'none';
  } else {
    blocCin.style.display = 'none';
    blocIdent.style.display = 'flex';
  }
}


