function populateMastersRadios(institut_id, selected_master_id_or_values) {
  const diplomeContainer = document.getElementById('diplome-container');
  const diplomeSelect = document.getElementById('diplome-select');
  const anneeDiplomeSpan = document.getElementById('annee-diplome');
  const mastersContainer = document.getElementById('masters-radio-container');

  if (anneeDiplomeSpan) anneeDiplomeSpan.textContent = '';
  if (mastersContainer) mastersContainer.innerHTML = '';

  if (institut_id == 8) {
      if (diplomeContainer) diplomeContainer.style.display = 'block';
      if (diplomeSelect) {
        diplomeSelect.innerHTML = '<option value="">-- Sélectionnez un diplôme --</option>';

        fetch(`/wp-json/plateforme-master/v1/diplomes-by-institutFDST/${institut_id}`, { credentials: 'include' })
          .then(res => res.json())
          .then(diplomes => {
            if (Array.isArray(diplomes)) {
              diplomes.forEach(d => {
                const option = document.createElement('option');
                option.value = d.id;
                option.textContent = d.diplome + (d.annee ? ` (${d.annee})` : '');
                option.dataset.masterId = d.master_id;
                option.dataset.annee = d.annee;
                diplomeSelect.appendChild(option);
              });
            }
          })
          .catch(err => console.error('Erreur chargement diplômes:', err));

        diplomeSelect.onchange = () => {
          const selectedOption = diplomeSelect.selectedOptions[0];
          if (!selectedOption || !selectedOption.value) {
            if (anneeDiplomeSpan) anneeDiplomeSpan.textContent = '';
            if (mastersContainer) mastersContainer.innerHTML = '';
            return;
          }

          const diplomeId = selectedOption.value;
          const annee = selectedOption.dataset.annee || '';

          if (mastersContainer) {
            // Nettoyer l'ancien contenu
            mastersContainer.innerHTML = '';

            // Ajouter le texte explicatif AVANT la liste des masters
            const infoBlock = document.createElement('div');
            infoBlock.className = 'master-choice-info';
            infoBlock.innerHTML = `
              <hr>
              <h4>Classement de vos choix de masters</h4>
              <p><strong>NB :</strong> Veuillez numéroter les masters selon votre ordre de préférence, du plus souhaité au moins prioritaire.</p>
            `;
            mastersContainer.appendChild(infoBlock);
          }

          fetchMastersByInstitutDiplome(institut_id, diplomeId, annee, selected_master_id_or_values);
        };
      }
    } else {
      if (diplomeContainer) diplomeContainer.style.display = 'none';
      fetchMastersByInstitut(institut_id, selected_master_id_or_values);
    }



}

function fetchMastersByInstitut(institut_id, selected_master_id_or_values) {
  const mastersContainer = document.getElementById('masters-radio-container');

  fetch(`/wp-json/plateforme-master/v1/masters-by-institut/${institut_id}`, { credentials: 'include' })
    .then(response => response.json())
    .then(masters => {
      if (!mastersContainer) return;
      displayMasters(masters, institut_id, selected_master_id_or_values, mastersContainer);
    })
    .catch(err => console.error('Erreur chargement masters:', err));
}

function fetchMastersByInstitutDiplome(institut_id, diplome_id, annee, selected_master_id_or_values) {
  const mastersContainer = document.getElementById('masters-radio-container');

  const params = new URLSearchParams();
  params.append('diplome_id', diplome_id);
  if (annee) params.append('annee', annee);

  fetch(`/wp-json/plateforme-master/v1/masters-by-institutFDST/${institut_id}?${params.toString()}`, { credentials: 'include' })
    .then(response => response.json())
    .then(masters => {
      if (!mastersContainer) return;
      displayMasters(masters, institut_id, selected_master_id_or_values, mastersContainer);
    })
    .catch(err => console.error('Erreur chargement masters filtrés:', err));
}

/*
function displayMasters(masters, institut_id, selected_master_id_or_values, container) {
  container.innerHTML = '';

  if (!Array.isArray(masters)) return;

  const totalMasters = masters.length;

  masters.forEach(master => {
    const wrapper = document.createElement('label');
    wrapper.className = 'role-option';

    if (institut_id == 8) {
      const inputNumber = document.createElement('input');
      inputNumber.type = 'number';
      inputNumber.name = `master_value_${master.id}`;
      inputNumber.min = 1;
      inputNumber.max = totalMasters;
      inputNumber.value = (selected_master_id_or_values && selected_master_id_or_values[master.id]) || '';

      // Validation min/max pendant la saisie
      inputNumber.addEventListener('input', (e) => {
        checkMinMax(e.target);
        // On ne gère pas ici les doublons pour ne pas gêner la saisie
        if (!e.target.classList.contains('input-error')) {
          e.target.setCustomValidity('');
          e.target.reportValidity();
        }
      });

      // Contrôle doublons et validité à la fin de saisie (blur)
      inputNumber.addEventListener('blur', (e) => {
        const input = e.target;

        // D'abord check min/max
        checkMinMax(input);

        // Si valeur invalide => efface sans message car checkMinMax a déjà mis l'erreur
        if (!input.checkValidity()) {
          // On ne change rien ici, le message est déjà affiché par checkMinMax
          return;
        }

        // Vérifie doublon
        if (isDuplicateValue(input, container)) {
          // Doublon détecté, efface ce champ, ajoute erreur et message
          input.value = '';
          input.classList.add('input-error');
          input.setCustomValidity('Valeur déjà utilisée, veuillez choisir une autre valeur.');
          input.reportValidity();
          return;
        }

        // Tout est ok, retire erreur
        input.classList.remove('input-error');
        input.setCustomValidity('');
        input.reportValidity();
      });

      const span = document.createElement('span');
      span.className = 'Quicksand-regular paragraphe';
      span.style.color = 'black';
      span.style.fontFamily = 'Poppins';
      span.textContent = master.intitule_master;

      wrapper.appendChild(inputNumber);
      wrapper.appendChild(span);

    } else {
      // Cas radio normal
      const input = document.createElement('input');
      input.type = 'radio';
      input.name = 'master_id';
      input.value = master.id;
      if (String(master.id) === String(selected_master_id_or_values)) {
        input.checked = true;
      }

      const span = document.createElement('span');
      span.className = 'Quicksand-regular paragraphe';
      span.style.color = 'black';
      span.style.fontFamily = 'Poppins';
      span.textContent = master.intitule_master;

      wrapper.appendChild(input);
      wrapper.appendChild(span);
    }

    container.appendChild(wrapper);
  });
}

*/

function displayMasters(masters, institut_id, selected_master_id_or_values, container) {
  container.innerHTML = '';

  if (!Array.isArray(masters)) return;

  const totalMasters = masters.length;

  if (institut_id == 8 && totalMasters > 0) {
    // Affiche uniquement pour institut_id 8
    const infoBlock = document.createElement('div');
    infoBlock.className = 'master-choice-info';
    infoBlock.innerHTML = `
       <hr>
      <h4>Classement de vos choix de masters</h4>
      <p><strong>NB :</strong> Veuillez numéroter les masters selon votre ordre de préférence, du plus souhaité au moins prioritaire.</p>
    `;
    container.appendChild(infoBlock);
  }

  masters.forEach(master => {
    const wrapper = document.createElement('label');
    wrapper.className = 'role-option';

    if (institut_id == 8) {
      // input number (ordre de préférence)
      const inputNumber = document.createElement('input');
      inputNumber.type = 'number';
      inputNumber.name = `master_value_${master.id}`;
      inputNumber.min = 1;
      inputNumber.max = totalMasters;
      inputNumber.value = (selected_master_id_or_values && selected_master_id_or_values[master.id]) || '';

      inputNumber.addEventListener('input', (e) => {
        checkMinMax(e.target);
        if (!e.target.classList.contains('input-error')) {
          e.target.setCustomValidity('');
          e.target.reportValidity();
        }
      });

      inputNumber.addEventListener('blur', (e) => {
        const input = e.target;
        checkMinMax(input);
        if (!input.checkValidity()) return;
        if (isDuplicateValue(input, container)) {
          input.value = '';
          input.classList.add('input-error');
          input.setCustomValidity('Valeur déjà utilisée, veuillez choisir une autre valeur.');
          input.reportValidity();
          return;
        }
        input.classList.remove('input-error');
        input.setCustomValidity('');
        input.reportValidity();
      });

      const span = document.createElement('span');
      span.className = 'Quicksand-regular paragraphe';
      span.style.color = 'black';
      span.style.fontFamily = 'Poppins';
      span.textContent = master.intitule_master;

      wrapper.appendChild(inputNumber);
      wrapper.appendChild(span);
    } else {
      // input radio classique
      const input = document.createElement('input');
      input.type = 'radio';
      input.name = 'master_id';
      input.value = master.id;
      if (String(master.id) === String(selected_master_id_or_values)) {
        input.checked = true;
      }

      const span = document.createElement('span');
      span.className = 'Quicksand-regular paragraphe';
      span.style.color = 'black';
      span.style.fontFamily = 'Poppins';
      span.textContent = master.intitule_master;

      wrapper.appendChild(input);
      wrapper.appendChild(span);
    }

    container.appendChild(wrapper);
  });
}


// Vérifie min et max sur un input number
function checkMinMax(input) {
  const value = parseInt(input.value || "0", 10);
  const min = parseInt(input.min, 10);
  const max = parseInt(input.max, 10);

  if (value < min || value > max) {
    input.classList.add('input-error');
    input.setCustomValidity(`Valeur entre ${min} et ${max} requise`);
  } else {
    input.classList.remove('input-error');
    input.setCustomValidity('');
  }

  input.reportValidity();
}

// Vérifie si la valeur de cet input est déjà présente dans un autre input (égalité stricte)
function isDuplicateValue(currentInput, container) {
  const val = currentInput.value.trim();
  if (!val) return false;

  const inputs = container.querySelectorAll('input[type="number"][name^="master_value_"]');
  let count = 0;

  inputs.forEach(input => {
    if (input.value.trim() === val) {
      count++;
    }
  });

  return count > 1; // vrai s’il y a au moins un doublon
}


