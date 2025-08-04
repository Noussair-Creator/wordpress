/**
 * Form validation utilities
 */

/**
 * Validate step 1 of the form
 * @returns {boolean} - Whether the form is valid
 */
function validateStep1() {
  console.log("validate");
  
  let isValid = true;
  const requiredFields = [
    'nom', 'prenom', 'nom-arabe', 'prenom-arabe',
     , 'email',
   , 
  ];
  
  // Check required fields
  requiredFields.forEach(fieldId => {
    const field = document.getElementById(fieldId);
    if (field && (field.value.trim() === '' || field.value === null)) {
      markFieldAsError(field, 'Ce champ est obligatoire');
      isValid = false;
    } else if (field) {
      clearFieldError(field);
    }
  });
  
  // Validate email format
  const emailField = document.getElementById('email');
  if (emailField && emailField.value.trim() !== '' && !isValidEmail(emailField.value)) {
    markFieldAsError(emailField, 'Veuillez saisir une adresse email valide');
    isValid = false;
  }
  
  // Validate email2 if provided
  const email2Field = document.getElementById('email2');
  if (email2Field && email2Field.value.trim() !== '' && !isValidEmail(email2Field.value)) {
    markFieldAsError(email2Field, 'Veuillez saisir une adresse email valide');
    isValid = false;
  }
  
  // Validate phone number (Morocco format)
  const phoneField = document.getElementById('telephone');
  if (phoneField && phoneField.value.trim() !== '' && !isValidMoroccanPhone(phoneField.value)) {
    markFieldAsError(phoneField, 'Veuillez saisir un numéro de téléphone valide (format marocain)');
    isValid = false;
  }
  
  return isValid;
}

/**
 * Validate step 2 of the form
 * @returns {boolean} - Whether the form is valid
 */
function validateStep2() {
  let isValid = true;
  const requiredFields = [
    'diplome', 'etablissement', 'annee-obtention', 'mention'
  ];
  
  // Check required fields
  requiredFields.forEach(fieldId => {
    const field = document.getElementById(fieldId);
    if (field && (field.value.trim() === '' || field.value === null)) {
      markFieldAsError(field, 'Ce champ est obligatoire');
      isValid = false;
    } else if (field) {
      clearFieldError(field);
    }
  });
  
  // Check file inputs
  const fileInputs = ['cv', 'lettre-motivation', 'diplome-file'];
  fileInputs.forEach(fieldId => {
    const field = document.getElementById(fieldId);
    if (field && (!field.files || field.files.length === 0)) {
      markFieldAsError(field, 'Veuillez sélectionner un fichier');
      isValid = false;
    } else if (field) {
      clearFieldError(field);
    }
  });
  
  return isValid;
}

/**
 * Validate step 3 of the form
 * @returns {boolean} - Whether the form is valid
 */
function validateStep3() {
  let isValid = true;
  
  // Check confirmation checkboxes
  const confirmData = document.getElementById('confirm-data');
  const acceptTerms = document.getElementById('accept-terms');
  
  if (confirmData && !confirmData.checked) {
    markFieldAsError(confirmData, 'Vous devez confirmer l\'exactitude des informations');
    isValid = false;
  } else if (confirmData) {
    clearFieldError(confirmData);
  }
  
  if (acceptTerms && !acceptTerms.checked) {
    markFieldAsError(acceptTerms, 'Vous devez accepter les conditions d\'utilisation');
    isValid = false;
  } else if (acceptTerms) {
    clearFieldError(acceptTerms);
  }
  
  return isValid;
}

/**
 * Mark a field as having an error
 * @param {HTMLElement} field - The field element
 * @param {string} message - The error message
 */
function markFieldAsError(field, message) {
  const errorElement = field.parentElement.querySelector('.error-message');
  field.parentElement.classList.add('error');
  if (errorElement) {
    errorElement.textContent = message;
    errorElement.style.display = 'block';
  }
}

/**
 * Clear error state from a field
 * @param {HTMLElement} field - The field element
 */
function clearFieldError(field) {
  const errorElement = field.parentElement.querySelector('.error-message');
  field.parentElement.classList.remove('error');
  if (errorElement) {
    errorElement.textContent = '';
    errorElement.style.display = 'none';
  }
}

/**
 * Validate email format
 * @param {string} email - The email to validate
 * @returns {boolean} - Whether the email is valid
 */
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

/**
 * Validate Moroccan phone number format
 * @param {string} phone - The phone number to validate
 * @returns {boolean} - Whether the phone number is valid
 */
function isValidMoroccanPhone(phone) {
  // Allow format: 6XXXXXXXX or 7XXXXXXXX (9 digits)
  const phoneRegex = /^[67]\d{8}$/;
  return phoneRegex.test(phone.replace(/\s/g, ''));
}