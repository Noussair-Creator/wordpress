// Quand le document est complètement chargé
document.addEventListener('DOMContentLoaded', () => {
  initializeForm();               // Initialise les étapes et le formulaire (étapes 2, 3, 4)
  addEventListeners();           // Ajoute les événements globaux (ex. : bouton "Suivant")
  initializeCharacterCounters(); // Initialise les compteurs de caractères sur certains champs texte
  setupFormSubmission();         // Prépare l'écoute de soumission du formulaire
});

// Fermer le popup de confirmation si l’utilisateur clique sur "Annuler"
document.getElementById('cancel-confirm-popup')?.addEventListener('click', () => {
  document.getElementById('form-confirm-popup').style.display = 'none';
});

// Valider le popup de confirmation et soumettre le formulaire
document.getElementById('confirm-confirm-popup')?.addEventListener('click', () => {
  document.getElementById('form-confirm-popup').style.display = 'none';
  submitForm();
});

// Fermer le popup d’erreur
document.getElementById('close-error-popup')?.addEventListener('click', () => {
  document.getElementById('form-error-popup').style.display = 'none';
});
//Sélection du pays (code téléphone)
document.addEventListener('DOMContentLoaded', function () {
  const countrySelector = document.querySelector('.country-selector');
  const selectedCountry = document.querySelector('.selected-country');
  const countryDropdown = document.querySelector('.country-dropdown');
  const countryOptions = document.querySelectorAll('.country-option');
  const countryCodeDisplay = document.querySelector('.country-code');
  const phoneInput = document.querySelector('.phone-input');

  // Cliquer sur la zone sélectionnée => ouvre/ferme le menu déroulant
  
  selectedCountry.addEventListener('click', function () {
    countryDropdown.classList.toggle('show');
  });
  

  // Lorsqu'un pays est sélectionné
  countryOptions.forEach(option => {
    option.addEventListener('click', function () {
      const code = this.getAttribute('data-code'); // exemple : 216
      const flag = this.getAttribute('data-flag'); // exemple : tn

      // Met à jour le visuel avec le drapeau et l’indicatif
      countryCodeDisplay.textContent = `+${code}`;
      const flagElement = selectedCountry.querySelector('.country-flag');
      flagElement.className = 'country-flag'; // reset
      flagElement.classList.add(`flag-${flag}`); // ajoute la classe correspondante

      // Ferme la dropdown
      countryDropdown.classList.remove('show');

      // Focus sur le champ téléphone
      phoneInput.focus();
    });
  });

  // Fermer la liste si on clique ailleurs
  document.addEventListener('click', function (event) {
    if (!countrySelector.contains(event.target)) {
      countryDropdown.classList.remove('show');
    }
  });
});

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


document.addEventListener('change', (e) => {
  console.log("change", e.target);

  if (e.target.classList.contains('file-input')) {
    const fileInput = e.target;
    const files = fileInput.files;
    const container = fileInput.closest('.single-container');
    const previewContainer = container.querySelector('.file-upload-container');
    const uploadLabel = container.querySelector('.upload-label');
    const target = fileInput.dataset.target;
    const cursusIndex = fileInput.getAttribute('data-cursus-index');;
    const fileIndex = fileInput.getAttribute('data-file-index');

    console.log("cursusIndex", cursusIndex, fileIndex);


    if (!previewContainer) return;

    if (files.length > 0) {
      const file = files[0];

      // Update preview UI
      previewContainer.style.display = 'block';
      previewContainer.querySelector('.file-name').textContent = file.name;
      previewContainer.querySelector('.file-meta').textContent =
        `${Math.round(file.size / 1024)} KB`;

      // Hide the upload label
      uploadLabel.style.display = 'none';

      // Add close button if not exists
      if (!previewContainer.querySelector('.close-pdf-icon')) {
        const closeIcon = document.createElement('img');
        closeIcon.src = '/wp-content/plugins/plateforme-master/pages/Candidature/assets/closepdf.png';
        closeIcon.className = 'close-pdf-icon';
        closeIcon.style.position = 'absolute';
        closeIcon.style.top = '5px';
        closeIcon.style.right = '5px';
        closeIcon.style.cursor = 'pointer';
        previewContainer.querySelector('.file-item').appendChild(closeIcon);

        // Handle file removal
        closeIcon.addEventListener('click', () => {
          fileInput.value = '';
          previewContainer.style.display = 'none';
          // Show the upload label again
          uploadLabel.style.display = 'flex';
          updateFileTracking(target, cursusIndex, fileIndex, null);
        });
      }

      // Update tracking
      updateFileTracking(target, cursusIndex, fileIndex, file);
    } else {
      previewContainer.style.display = 'none';
      uploadLabel.style.display = 'flex';
      updateFileTracking(target, cursusIndex, fileIndex, null);
    }
  }
});

// File tracking object
const existingUploadedFiles = {
  Bac: null,
  Cursus_Licence: [],
  Annee_Blanche: []
};

/*

// Unified tracking update
function updateFileTracking(target, cursusIndex, fileIndex, file) {
  target = target.toLowerCase();
  console.log("target", target);

  if (target === 'bac') {
    existingUploadedFiles.Bac = file;
  }
  else if (target.includes('cursus_licence')) {

    // if (existingUploadedFiles["Cursus_Licence"].length > 0) {
    if (!existingUploadedFiles["Cursus_Licence"][cursusIndex]) {
      existingUploadedFiles["Cursus_Licence"][cursusIndex] = [null, null, null];
    }
    existingUploadedFiles["Cursus_Licence"][cursusIndex][fileIndex] = file;
  
  }


  console.log("existingUploadedFiles", existingUploadedFiles);

}

*/
/*

function updateFileTracking(target, cursusIndex, fileIndex, file) {
  target = target.toLowerCase();
  console.log("target", target);
  console.log("cursusIndex", cursusIndex, "fileIndex", fileIndex);

  //  Convertir si chaîne
  cursusIndex = parseInt(cursusIndex, 10);
  fileIndex = parseInt(fileIndex, 10);

  //  Vérifie que ce sont bien des entiers valides
  if (isNaN(cursusIndex) || isNaN(fileIndex)) {
    console.warn("cursusIndex ou fileIndex manquant dans updateFileTracking");
    return;
  }

  if (target === 'bac') {
    existingUploadedFiles.Bac = {
      file: file,
      filename: file.name
    };
  }
  else if (target.includes('cursus_licence')) {
    if (!existingUploadedFiles.Cursus_Licence[cursusIndex]) {
      existingUploadedFiles.Cursus_Licence[cursusIndex] = [null, null, null];
    }

    existingUploadedFiles.Cursus_Licence[cursusIndex][fileIndex] = file;
  }

  console.log("existingUploadedFiles", existingUploadedFiles);
}
*/

function updateFileTracking(target, cursusIndex, fileIndex, file) {
  if (!existingUploadedFiles[target]) {
    if (target === 'Bac') {
      existingUploadedFiles[target] = null;
    } else {
      existingUploadedFiles[target] = [];
    }
  }

  if (target === 'Bac') {
    if (file) {
      existingUploadedFiles.Bac = {
        file: file,
        filename: file.name
      };
    } else {
      existingUploadedFiles.Bac = null;
    }
    return;
  }

  // Autres cas (ex: Cursus_Licence)
  if (!existingUploadedFiles[target][cursusIndex]) {
    existingUploadedFiles[target][cursusIndex] = [];
  }

  existingUploadedFiles[target][cursusIndex][fileIndex] = file;
}








document.addEventListener('change', function (e) {
  // Cible les <input type="radio" name="master_id">
  if (e.target.matches('input[type="radio"][name="master_id"]')) {
    const masterId = e.target.value;
    const niveau = 'M1'; // tu peux le rendre dynamique si nécessaire

    // Appelle ta fonction avec l’ID sélectionné
    loadScoreFormuleAndCriteres(masterId, niveau);
  }
});

/*
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
        annees_blanches: anneesBlanches,
        piece_jointe_path: situation.piece_jointe_path
      };

      fillStep2Form(fullSituation);
    }, 300);
    console.log('Candidat chargé avec succès');

  } catch (error) {
    console.error('Erreur fetch /candidats :', error);
  }
});
*/


document.addEventListener('DOMContentLoaded', async () => {
  try {
    // Attendre que les nationalités soient chargées
    await initializeNationalites();

    // Appel API candidat
    const response = await fetch(PMSettings.apiUrlCandidats, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      credentials: 'include'
    });

    const result = await response.json();

    if (!response.ok || !result || !result.nom) {
      console.warn('Candidat non trouvé ou erreur :', result);
      return;
    }

    // ➕ Affichage image utilisateur
    const imageUser = document.getElementById('imageUser');
    if (imageUser && result.photo_path) {
      imageUser.src = "/Candidature/" + result.photo_path;
    }

    // ➕ Affichage nom
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

    // ✅ Sélection des nationalités après leur chargement
    const natFrSelect = document.getElementById('nationalite');
    const natArSelect = document.getElementById('nationalite_ar');
    if (result.nationalite) natFrSelect.value = result.nationalite;
    if (result.nationalite_ar) natArSelect.value = result.nationalite_ar;

    // ➕ CIN / CNE
    document.getElementById('cin').value = result.cin || '';
    document.getElementById('cne').value = result.passport || '';
    toggleCinOrIdentifiant();

    // ➕ Email & Téléphone
    document.getElementById('email').value = result.email1 || '';
    document.getElementById('email2').value = result.email2 || '';
    document.querySelector('.phone-input2').value = result.telephone || '';
    document.getElementById('type').value = result.type_besoin || '';

    // ➕ Adresse
    document.getElementById('adresse').value = result.adresse_fr || '';
    document.getElementById('adresseAr').value = result.adresse_ar || '';
    document.getElementById('gouvernorat').value = result.gouvernorat_fr || '';
    document.getElementById('gouvernoratAr').value = result.gouvernorat_ar || '';


    

    document.getElementById('gouvernorat').dispatchEvent(new Event('change'));
    await waitForDelegationOption('delegation', result.delegation_fr);




    document.getElementById('gouvernoratAr').dispatchEvent(new Event('change'));
    await waitForDelegationOption('delegationAr', result.delegation_ar);

    document.getElementById('code-postal').value = result.code_postal || '';

    // ➕ Checkbox besoins spécifiques
    const besoinCheckbox = document.querySelector('.custom-checkbox input[type="checkbox"]');
    besoinCheckbox.checked = (result.besoin_specifique === 'oui');

    // ➕ Établissements & masters
    populateEtablissements(result);
    const institutId = result.candidatures?.[0]?.infos?.institut_id ?? null;
    const masterId = result.candidatures?.[0]?.infos?.master_id ?? null;
    if (institutId) {
      populateMastersRadios(institutId, masterId);
    }

    // ➕ Étape 2 (cursus)
    populateStep2();
    setTimeout(() => {
      const infos = result.candidatures?.[0]?.infos || {};
      const situation = result.candidatures?.[0]?.situation_academique || {};
      const parcours = result.candidatures?.[0]?.parcours || [];
      const anneesBlanches = result.candidatures?.[0]?.annees_blanches || [];

      const fullSituation = {
        annee: infos.annee_universitaire || '',
        baccalaureat: situation.baccalaureat || '',
        etablissement: situation.etablissement || '',
        session: situation.session || 'principale',
        mention: situation.mention || '',
        moyenne: situation.moyenne || '',
        cycle: parcours?.[0]?.cycle || '',
        parcours: parcours,
        annees_blanches: anneesBlanches,
        piece_jointe_path: situation.piece_jointe_path
      };

      fillStep2Form(fullSituation);
    }, 300);

    console.log('✅ Candidat chargé avec succès');

  } catch (error) {
    console.error('❌ Erreur lors du chargement du candidat :', error);
  }
});


async function waitForDelegationOption(selectId, value, timeout = 1000) {
  const start = Date.now();
  while (Date.now() - start < timeout) {
    const select = document.getElementById(selectId);
    if ([...select.options].some(opt => opt.value === value)) {
      select.value = value;
      return true;
    }
    await new Promise(resolve => setTimeout(resolve, 50));
  }
  console.warn(`⏳ Délégation "${value}" non trouvée après ${timeout}ms dans #${selectId}`);
  return false;
}


document.addEventListener("DOMContentLoaded", function () {

  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  const blancheTemplate = document.getElementById("annee-blanche-template");
  const cycleRadios = document.querySelectorAll(".cycle-selection input[type='radio']");


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
    populateUniversites();
  }

  document.addEventListener("change", function (e) {
    if (e.target.matches(".cycle-selection input[type='radio']")) {
      var selectedtest = document.querySelector(".cycle-selection input[type='radio']:checked");
      console.log("selectedtest", selectedtest);

      if (selectedtest.value == 'ingenieur') {
        container = document.querySelector(".containerdrop");
        container.style.display = "block"
        btn = document.querySelector(".prepButton1");
        btn.style.background = "#BF0404";
        btn.style.color = "white";
        createYearBlocks(5);
      }
      else {
        container = document.querySelector(".containerdrop");
        container.style.display = "none"
        btn = document.querySelector(".prepButton1");
        btn2 = document.querySelector(".prepButton2");
        btn.style.background = "none";
        btn2.style.background = "none";

        btn.style.color = "black";
        btn2.style.color = "black";
        refreshCycleSection();
      }
      if (selectedtest.value == 'medecine') {
        container = document.querySelector(".containerdropmedicine");
        container.style.display = "block"
        btn = document.querySelector(".prepButtonmedecine");
        btn.style.background = "#BF0404";
        btn.style.color = "white";
        createYearBlocks(6);
      }
      else {
        container = document.querySelector(".containerdropmedicine");
        container.style.display = "none"
        btn = document.querySelector(".prepButtonmedecine");
        btn2 = document.querySelector(".prepButtonveterinaire");
        btn3 = document.querySelector(".prepButtonpharmacie");
        btn.style.background = "none";
        btn2.style.background = "none";
        btn3.style.background = "none";
        btn.style.color = "black";
        btn2.style.color = "black";
        btn3.style.color = "black";
        refreshCycleSection();
        
      }
      if (selectedtest.value == "autre") {
        container = document.querySelector(".container-autre-cursus");
        container.style.display = "flex"
      }
      else {
        container = document.querySelector(".container-autre-cursus");
        container.style.display = "none"
      }
    }

    if (e.target.matches(".nbSpecialite")) {
      var nbyears = e.target.value
      createYearBlocks(nbyears);

    }
  });
  document.addEventListener("input", function (e) {
    if (e.target.matches(".nbSpecialite")) {
      var nbyears = e.target.value
      createYearBlocks(nbyears);
    }
  });

  /*
  document.addEventListener("click", function (e) {

    console.log(e.target);

    if (e.target.matches(".prepButton1")) {
      e.target.style.background = "#BF0404";
      e.target.style.color = "white";
      btn = document.querySelector(".prepButton2");
      btn.style.background = "none";
      btn.style.color = "black";
      createYearBlocks(5);
    }

    if (e.target.matches(".prepButton2")) {
      e.target.style.background = "#BF0404";
      e.target.style.color = "white";
      btn = document.querySelector(".prepButton1");
      btn.style.background = "none";
      btn.style.color = "black";
      createYearBlocks(6);
    }
    if (e.target.matches(".prepButtonmedecine")) {
      e.target.style.background = "#BF0404";
      e.target.style.color = "white";
      btn = document.querySelector(".prepButtonveterinaire");
      btn.style.background = "none";
      btn.style.color = "black";
      btn1 = document.querySelector(".prepButtonpharmacie");
      btn1.style.background = "none";
      btn1.style.color = "black";
      createYearBlocks(7);
    }
    if (e.target.matches(".prepButtonveterinaire")) {
      e.target.style.background = "#BF0404";
      e.target.style.color = "white";
      btn = document.querySelector(".prepButtonmedecine");
      btn.style.background = "none";
      btn.style.color = "black";
      btn1 = document.querySelector(".prepButtonpharmacie");
      btn1.style.background = "none";
      btn1.style.color = "black";
      createYearBlocks(6);
    }
    if (e.target.matches(".prepButtonpharmacie")) {
      e.target.style.background = "#BF0404";
      e.target.style.color = "white";
      btn = document.querySelector(".prepButtonmedecine");
      btn.style.background = "none";
      btn.style.color = "black";
      btn1 = document.querySelector(".prepButtonveterinaire");
      btn1.style.background = "none";
      btn1.style.color = "black";
      createYearBlocks(5);
    }

  });
  */

  function resetButtonStyles(buttons) {
    buttons.forEach(btn => {
      btn.style.background = "none";
      btn.style.color = "black";
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    const prep1 = document.querySelector(".prepButton1");
    const prep2 = document.querySelector(".prepButton2");

    prep1?.addEventListener("click", () => {
      resetButtonStyles([prep1, prep2]);
      prep1.style.background = "#BF0404";
      prep1.style.color = "white";
      createYearBlocks(5);
    });

    prep2?.addEventListener("click", () => {
      resetButtonStyles([prep1, prep2]);
      prep2.style.background = "#BF0404";
      prep2.style.color = "white";
      createYearBlocks(6);
    });

    const med = document.querySelector(".prepButtonmedecine");
    const vet = document.querySelector(".prepButtonveterinaire");
    const pharm = document.querySelector(".prepButtonpharmacie");

    med?.addEventListener("click", () => {
      resetButtonStyles([med, vet, pharm]);
      med.style.background = "#BF0404";
      med.style.color = "white";
      createYearBlocks(7);
    });

    vet?.addEventListener("click", () => {
      resetButtonStyles([med, vet, pharm]);
      vet.style.background = "#BF0404";
      vet.style.color = "white";
      createYearBlocks(6);
    });

    pharm?.addEventListener("click", () => {
      resetButtonStyles([med, vet, pharm]);
      pharm.style.background = "#BF0404";
      pharm.style.color = "white";
      createYearBlocks(5);
    });
  });

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

}
function showConfirmationPopup(message = "Confirmez-vous les informations saisies ?", onConfirm = () => { }) {
  const popup = document.getElementById('form-confirm-popup');
  const msg = document.getElementById('form-confirm-message');
  const confirmBtn = document.getElementById('confirm-confirm-popup');
  const cancelBtn = document.getElementById('cancel-confirm-popup');

  if (!popup || !msg || !confirmBtn || !cancelBtn) {
    console.warn(" La modale de confirmation est manquante dans le DOM.");
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

                                  <div class="form-group year-block">
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
                                      <div class="form-field ">
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
                                  <div class="form-group year-block">
                                      <div class="form-field" style="    flex: none; min-width: unset;">
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
  <div class="upload-container">
    <div class="upload-files-container-all">
      <div class="single-container" data-target="Bac">
        <div class="file-upload-container" style="display: none;">
          <div class="file-item step-content">
            <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/pdf.png" alt="pdf-icon" class="file-icon" />
            <div class="file-info">
              <div class="file-name Quicksand-medium paragraphe"></div>
              <div class="file-meta Quicksand-medium paragraphe"></div>
            </div>
          </div>
        </div>

        <label class="upload-label">
          <input type="file" class="file-input"
                 data-target="Bac"
                 data-cursus-index="0"
                 data-file-index="0"
                 name="Bac" accept=".pdf" style="display: none;">
                  <div style="display: flex;align-items: center;justify-content: center;gap: 2px;flex-direction: column;">
                                                            <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/plus_pdf.png" style="width: 14px;" >
                                                           
                                                            <div style="font-size:11px">Diplôme</div>
                                                            </div>
          <div class="import-button Quicksand-bold upload-btn" style="display:none">Upload</div>
        </label>
      </div>
    </div>
  </div>
  <span class="error-message"></span>
</div>

<div class="form-field">
  <div class="document-list" id="bac-document-list">
  </div>
</div>

                                
                              </div>

                              <div class="form-section-block ">
                                  <h3><i class="fa fa-university"></i> Cursus Universitaire</h3>
                                      <div class="cycle-selection">
                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="licence" checked>
                                              <span class="custom-check"></span>
                                             <span style="padding-left: 25px;">Licence</span> 
                                          </label>
                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="maitrise">
                                              <span class="custom-check"></span>
                                             <span style="padding-left: 25px;">Maîtrise</span> 

                                              
                                          </label>
                                            <label class="cycle-option">
                                              <input type="radio" name="cycle" value="master">
                                              <span class="custom-check"></span>
                                              <span style="padding-left: 25px;">Master</span> 
                                          </label>
                                      </div>
                                       <div class="cycle-selection" >
                                          
                                        <div class="cycle-option">
                                          <label class="cycle-option " >
                                               <input type="radio" name="cycle" value="ingenieur">
                                               <span class="custom-check"></span>
                                             <span style="padding-left: 25px;"> Cycle ingénieur</span>
                                          </label>
                                          <div class="dropdown containerdrop">
                                              <div id="prep" class="prepButton1"> Avec préparatoire  </div> 
                                              <div id="noprep" class="prepButton2"> Sans préparatoire  </div> 
                                          </div>  
                                        </div>
                                          <div class="cycle-option">
                                            <label class="cycle-option " >
                                                <input type="radio" name="cycle" value="medecine">
                                                <span class="custom-check"></span>
                                                <span style="padding-left: 25px;">Médecine</span>
                                            </label>
                                            <div class="dropdown containerdropmedicine" style="width:237px">
                                                <div id="option-medecine" class="prepButtonmedecine"> Médecine  </div> 
                                                <div id="option-veterinaire " class="prepButtonveterinaire"> Médecine vétérinaire  </div> 
                                                <div id="option-pharmacien" class="prepButtonpharmacie"> Pharmacien </div> 
                                            </div>  
                                        </div>
                                        <div style="min-width: 121px;"></div>

                                      </div>
                                      <div class="cycle-selection" style="flex-direction:column;gap: 20px;" >
                                          <label class="cycle-option">
                                              <input type="radio" name="cycle" value="autre">
                                              <span class="custom-check"></span>
                                              <span style="padding-left: 25px;">Autre</span> 
                                          </label>

                                          <div class="container-autre-cursus">
                                                <div class="form-field" style="max-width:409px">
                                                    <label for="nbyear">Spécialité<span class="required">*</span></label>
                                                    <input type="text"  id="specialite" name="specialite" class="spec-autre" required>
                                                    <span class="error-message"></span>
                                                </div>
                                                <div class="form-field" style="flex: none;">
                                                    <label for="nbyear">Nombre d'années<span class="required">*</span></label>
                                                    <input type="number" class="nbSpecialite" step="1" id="nbyear" name="moyenne" min="0" max="20" style="max-width: 127px;" required>
                                                    <span class="error-message"></span>
                                                </div>
                                                <div class="check-btn-container">
                                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/step_valid.jpeg" 
                                                style="width: 30px;" >
                                                </div>
                                          </div>
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
                                                      <!--<input type="text" id="Université" name="Université" required class="select-universite">-->
                                                      <select id="universite" name="universite" required class="select-universite">
                                                        <option value="">-- Sélectionner une université --</option>
                                                      </select>


                                                      </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Etablissement<span class="required">*</span></label>
                                                      <div class="select-wrapper">
                                                      
                                                        <select id="etablissement" name="etablissement" required class="select-etablissement">
                                                          <option value="">-- Sélectionner un établissement --</option>
                                                        </select>

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
                                                  <div class="form-field" style="    flex: none; min-width: unset;">
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
                                                      <input type="number" step="1" id="credit" class="input-credit" name="credit" min="0" max="60" required>
 
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field">
                                                      <label for="nom-arabe">Pièces jointes<span class="required">*</span></label>
                                                      <div class="upload-container" >

                                                  <div  class="upload-files-container-all">
                                                    <div class="single-container">
                                                      <div class="file-upload-container " style="display:none">
                                                            <div  class="file-item step-content">
                                                                  <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/pdf.png" alt="pdf-icon" class="file-icon" />
                                                                <div class="file-info">
                                                                    <div class="file-name Quicksand-medium paragraphe"></div>
                                                                    <div class="file-meta Quicksand-medium paragraphe" ></div>
                                                                </div>
                                                            </div>
                                                      </div>
                                                      <label class="upload-label">
                                                            <input type="file" class="file-input"  name="Cursus_Licence_1" data-target="Cursus_Licence" 
                                                             data-cursus-index="0"
                                                              data-file-index="0"
                                                                  accept=".pdf" style="display:none">
                                                            <div style="display: flex;align-items: center;justify-content: center;gap: 2px;flex-direction: column;">
                                                            <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/plus_pdf.png"  style="width: 14px;">
                                                          
                                                            <div style="font-size:11px">Attestation de réussite</div>
                                                            </div>
                                                      </label>
                                                    </div>
                                                    <div class="single-container">
                                                      <div class="file-upload-container " style="display:none">
                                                            <div  class="file-item step-content">
                                                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/pdf.png" alt="pdf-icon" class="file-icon" />
                                                                <div class="file-info">
                                                                    <div class="file-name Quicksand-medium paragraphe"></div>
                                                                    <div class="file-meta Quicksand-medium paragraphe" ></div>
                                                                </div>
                                                            </div>
                                                      </div>
                                                      <label class="upload-label">
                                                            <input type="file"
                                                            
                                                            data-target="Cursus_Licence"
                                                               data-cursus-index="0"
                                                                data-file-index="0"
                                                                   
                                                            class="file-input"  name="Cursus_LicenceR_1"  accept=".pdf" style="display:none">
                                                            <div style="display: flex;align-items: center;justify-content: center;gap: 2px;flex-direction: column;">
                                                            <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/plus_pdf.png" style="width: 14px;" >
                                                           
                                                            <div style="font-size:11px">Relevé des notes</div>
                                                            </div>
                                                      </label>
                                                  </div>
                                                   
                                                </div>
                                                     

                                                          
                                              </div>
                                                      <span class="error-message"></span>
                                                  </div>
                                                  <div class="form-field" style="width: 100%;max-width: unset;">
                                                      <div class="document-list" style="width: 100%;max-width: unset;" id="document-list">
                                                          
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


    // Wait for DOM to inject
    setTimeout(() => {
      // Re-bind year logic
      bindYearBlockLogic();
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
                                              <div class="select-wrapper" id="select-wrapper">
                                                <select id="etablissement2" name="etablissement2" required> 
                                                   <!-- <option value="enit">Enit</option>
                                                    <option value="ensit">Ensit</option>
                                                    <option value="insat">Insat</option>-->

                                                </select>
                                                <div id="diplome-container" style="display:none;">
                                                  <select id="diplome-select"></select>
                                                  <span id="annee-diplome"></span>
                                                </div>
                                                <span id="annee-diplome"></span>



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
        if (!validationStep2I()) return;

        const errors = [];

        // Lecture directe depuis le champ select d’établissement
        const institutIdRaw = document.getElementById('etablissement2')?.value;
        const institutId = parseInt(institutIdRaw, 10);

        if (!institutIdRaw || isNaN(institutId)) {
          errors.push("Veuillez sélectionner un établissement (institut) avant de continuer.");
          showErrorModal(errors);
          return;
        }

        if (institutId === 8) {
          const diplomeSelect = document.getElementById('diplome-select');
          if (!diplomeSelect || !diplomeSelect.value) {
            errors.push("Veuillez sélectionner un diplôme.");
          }

          const inputs = document.querySelectorAll('#masters-radio-container input[type="number"][name^="master_value_"]');
          const seen = new Set();
          const total = inputs.length;

          inputs.forEach(input => {
            const value = parseInt(input.value || "0", 10);
            const min = parseInt(input.min, 10);
            const max = parseInt(input.max, 10);

            // Réinitialisation visuelle
            input.classList.remove('input-error');

            if (!input.value || value < min || value > max) {
              input.classList.add('input-error');
              errors.push("Certains champs sont vides ou en dehors de l’intervalle autorisé.");
            } else if (seen.has(value)) {
              input.classList.add('input-error');
              errors.push("Des valeurs sont dupliquées dans les préférences.");
            } else {
              seen.add(value);
            }
          });

          if (errors.length > 0) {
            showErrorModal([...new Set(errors)]);
            return;
          }

            const selected = 0;
            sessionStorage.setItem('selected_master_id', selected.value);
            console.log("✔ Master ID enregistré :", selected.value);
            loadScoreFormuleAndCriteres(selected.value);

        } else {
          const selected = document.querySelector('input[name="master_id"]:checked');
          if (!selected) {
            showErrorModal(["Veuillez sélectionner un master."]);
            return;
          }

          sessionStorage.setItem('selected_master_id', selected.value);
          console.log("✔ Master ID enregistré :", selected.value);
          loadScoreFormuleAndCriteres(selected.value);
        }

        showConfirmationPopup("Confirmez-vous les informations saisies ?", () => {
          goToStep(4);
        });
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
 * Populate step 3 of the form
 */

function populateStep4() {
  
  
  const step4 = document.getElementById('step4');
  if (!step4) return;

  step4.innerHTML = `
    <div class="form-section-block">
      <h3><i class="fa fa-list-alt"></i> Choisissez le niveau </h3>  
      <div class="form-field" style="padding:0 20px">
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
      <div class="form-field" style="padding:0 20px">
        <label>Formule utilisée (lecture seule)</label>
        <textarea id="formule-score" class="formule-display" readonly style="width:100%; background:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px;"></textarea>
      </div>
      <div id="score-criteres-container" style="display:flex; flex-direction:column; gap:15px; margin-top:20px;padding:0 20px"></div>
    </div>

    <div class="form-actions" style="margin-top: 30px;">
      <button type="button" id="prev-btn-4" class="btn btn-primary" style="background: #A6A485; margin-right: 20px;">PRÉCÉDENT</button>
      <button id="submit-btn" class="btn btn-primary">ENREGISTRER</button>
    </div>
  `;


  setTimeout(() => {
    // 1. Bouton "Précédent"
    document.getElementById('prev-btn-4')?.addEventListener('click', () => {
      goToStep(3);
    });

    setupSubmitBtnListener(); // par défaut cherche #submit-btn

    // 2. Récupération master sélectionné
    const selectedMasterId = getSelectedMasterIdFromStep3();
    if (!selectedMasterId) {
      console.warn("⚠️ Aucun master sélectionné");
      return;
    }

    // 3. Fonction de chargement des critères
    function refreshScoreCriteres() {
      const selectedNiveau = document.querySelector('.niveau-radio:checked')?.value || 'M1';
      console.log("✅ Chargement critères pour niveau :", selectedNiveau, " et master_id :", selectedMasterId);
      loadScoreFormuleAndCriteres(selectedMasterId, selectedNiveau);
    }

    // 4. Ajout listener sur changement niveau (M1 / M2)
    document.querySelectorAll('.niveau-radio').forEach(radio => {
      radio.addEventListener('change', refreshScoreCriteres);
    });

    // 5. Appel initial
    refreshScoreCriteres();

    // 6. Bouton "Soumettre"
    const submitBtn = document.getElementById('submit-btn');
    console.log("submit form 0", submitBtn);

    
  }, 100);

}
// ================== STEP 2 VALIDATION ================== //
// function validationStep2I() {
//   const missingFields = [];
//   // const MAX_FILE_SIZE_MB = 20;
//   // const MAX_FILE_SIZE = MAX_FILE_SIZE_MB * 1024 * 1024;

//   // Validate Bac fields
//   const bacFields = [
//     { selector: '#year_bac', label: "Année du Bac" },
//     { selector: '#specialite', label: "Spécialité Bac" },
//     { selector: '#etablissement', label: "Établissement Bac" },
//     { selector: '#session', label: "Session Bac" },
//     { selector: '#mention_bac', label: "Mention Bac" },
//     { selector: '#moyenne', label: "Moyenne Bac" }
//   ];

//   bacFields.forEach(({ selector, label }) => {
//     const el = document.querySelector(selector);
//     if (!el || !el.value.trim()) {
//       missingFields.push(label);
//     }
//   });

//   // Validate Bac moyenne
//   const moyenneBacInput = document.querySelector('#moyenne');
//   if (moyenneBacInput) {
//     const val = parseFloat(moyenneBacInput.value);
//     if (isNaN(val)) {
//       missingFields.push("La moyenne du Bac doit être un nombre valide.");
//     } else if (val < 0 || val > 20) {
//       missingFields.push("La moyenne du Bac doit être entre 0 et 20.");
//     }
//   }

//   // Validate Bac file
//   const bacFileInput = document.querySelector('input[name="Bac"]');
//   const existingBac = existingUploadedFiles.Bac;
//   const MAX_FILE_SIZE_MB = 20;
//   const MAX_FILE_SIZE = MAX_FILE_SIZE_MB * 1024 * 1024;
//   if (!bacFileInput?.files?.[0] && !existingBac) {
//     missingFields.push("Relevé de notes du Bac");
//   }

//   if ((bacFileInput && bacFileInput?.files?.[0] && (bacFileInput?.files?.[0].size > MAX_FILE_SIZE)) || (existingBac && (existingBac.size > MAX_FILE_SIZE))) {
//     missingFields.push(`Relevé de notes du Bac dépasse la taille maximale autorisée de ${MAX_FILE_SIZE_MB} Mo.`);
//   }
//   // Validate each year block
//   document.querySelectorAll(".year-block-wrapper").forEach((block, index) => {
//     // Validate required fields
//     const annee = block.querySelector(".select-annee")?.value.trim();
//     const universite = block.querySelector(".select-universite")?.value.trim();
//     const etablissement = block.querySelector(".select-etablissement")?.value.trim();
//     const session = block.querySelector(".select-session")?.value.trim();
//     const mention = block.querySelector(".select-mention")?.value.trim();
//     const moyenne = block.querySelector(".input-moyenne")?.value.trim();
//     const credit = block.querySelector(".input-credit")?.value.trim();

//     if (!annee) missingFields.push(`Année - bloc ${index + 1}`);
//     if (!universite) missingFields.push(`Université - bloc ${index + 1}`);
//     if (!etablissement) missingFields.push(`Établissement - bloc ${index + 1}`);
//     if (!session) missingFields.push(`Session - bloc ${index + 1}`);
//     if (!mention) missingFields.push(`Mention - bloc ${index + 1}`);

//     if (!moyenne) {
//       missingFields.push(`Moyenne - bloc ${index + 1}`);
//     } else {
//       const val = parseFloat(moyenne);
//       if (isNaN(val)) {
//         missingFields.push(`La moyenne du bloc ${index + 1} doit être un nombre valide.`);
//       } else if (val < 0 || val > 20) {
//         missingFields.push(`La moyenne du bloc ${index + 1} doit être entre 0 et 20.`);
//       }
//     }

//     if (!credit) {
//       missingFields.push(`Crédit - bloc ${index + 1}`);
//     } else {
//       const val = parseFloat(credit);
//       if (isNaN(val)) {
//         missingFields.push(`Le crédit du bloc ${index + 1} doit être un nombre valide.`);
//       } else if (val < 0 || val > 60) {
//         missingFields.push(`Le crédit du bloc ${index + 1} doit être entre 0 et 60.`);
//       }
//     }

//     // Validate file
//     const fileInput = block.querySelector(".file-input");
//     const newFile = fileInput?.files?.[0];
//     const existingFile = existingUploadedFiles.Cursus_Licence[`year_${index}`]?.file;

//     if (!newFile && !existingFile) {
//       missingFields.push(`Relevé des notes - bloc ${index + 1}`);
//     }
//     if ((newFile && (newFile.size > MAX_FILE_SIZE)) || (existingFile && (existingFile.size > MAX_FILE_SIZE))) {
//       missingFields.push(`Relevé des notes - bloc ${index + 1} dépasse la taille maximale autorisée de ${MAX_FILE_SIZE_MB} Mo.`);


//     }

//     // Validate gap years
//     const toggle = block.querySelector(".toggle-blanche-checkbox");
//     if (toggle?.checked) {
//       block.querySelectorAll(".annee-blanche-list > div").forEach((blanche, bIndex) => {
//         const nb = blanche.querySelector(".input-nbannee")?.value.trim();
//         const cause = blanche.querySelector(".textarea-cause")?.value.trim();
//         const fileInput = blanche.querySelector("input[type='file']");
//         const newFile = fileInput?.files?.[0];
//         const existingFile = existingUploadedFiles.Annee_Blanche[`${index}_${bIndex}`]?.file;

//         if (!nb) missingFields.push(`Année blanche - nb ${index + 1}.${bIndex + 1}`);
//         if (!cause) missingFields.push(`Année blanche - cause ${index + 1}.${bIndex + 1}`);
//         if (!newFile && !existingFile) {
//           missingFields.push(`Justificatif année blanche - bloc ${index + 1}.${bIndex + 1}`);
//         }
//       });
//     }
//   });

//   if (missingFields.length > 0) {
//     showErrorModal(missingFields);
//     return false;
//   }

//   return true;
// }
function validationStep2I() {
  const missingFields = [];
  const MAX_FILE_SIZE_MB = 20;
  const MAX_FILE_SIZE = MAX_FILE_SIZE_MB * 1024 * 1024;

  // Vérifie les champs du Bac
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
    if (!el || !el.value.trim()) missingFields.push(label);
  });

  const moyenneBacInput = document.querySelector('#moyenne');
  if (moyenneBacInput) {
    const val = parseFloat(moyenneBacInput.value);
    if (isNaN(val)) missingFields.push("La moyenne du Bac doit être un nombre valide.");
    else if (val < 0 || val > 20) missingFields.push("La moyenne du Bac doit être entre 0 et 20.");
  }

  // const existingBac = existingUploadedFiles.Bac;
  // const bacDocList = document.getElementById('bac-document-list');
  // if (!existingBac && (!bacDocList || bacDocList.querySelectorAll('.document-item').length === 0)) {
  //   missingFields.push("Relevé de notes du Bac");
  // }

  // if (existingBac?.file?.size > MAX_FILE_SIZE) {
  //   missingFields.push(`Relevé de notes du Bac dépasse la taille maximale autorisée de ${MAX_FILE_SIZE_MB} Mo.`);
  // }

  // Vérification des blocs d'années
  document.querySelectorAll(".year-block-wrapper").forEach((block, index) => {
    const getVal = sel => block.querySelector(sel)?.value.trim();
    const checkText = (val, label) => {
      if (!val) missingFields.push(`${label} - bloc ${index + 1}`);
    };

    checkText(getVal('.select-annee'), 'Année');
    checkText(getVal('.select-universite'), 'Université');
    checkText(getVal('.select-etablissement'), 'Établissement');
    checkText(getVal('.select-session'), 'Session');
    checkText(getVal('.select-mention'), 'Mention');

    const moyenne = getVal('.input-moyenne');
    if (!moyenne) missingFields.push(`Moyenne - bloc ${index + 1}`);
    else {
      const val = parseFloat(moyenne);
      if (isNaN(val)) missingFields.push(`La moyenne du bloc ${index + 1} doit être un nombre valide.`);
      else if (val < 0 || val > 20) missingFields.push(`La moyenne du bloc ${index + 1} doit être entre 0 et 20.`);
    }

    const credit = getVal('.input-credit');
    if (!credit) missingFields.push(`Crédit - bloc ${index + 1}`);
    else {
      const val = parseFloat(credit);
      if (isNaN(val)) missingFields.push(`Le crédit du bloc ${index + 1} doit être un nombre valide.`);
      else if (val < 0 || val > 60) missingFields.push(`Le crédit du bloc ${index + 1} doit être entre 0 et 60.`);
    }

    // const docList = block.querySelector('.document-list');
    // const fileCount = docList?.querySelectorAll('.document-item')?.length || 0;
    // if (existingUploadedFiles.Cursus_Licence.length === 0) {
    //   missingFields.push(`Relevé des notes - bloc ${index + 1}`);
    // } else {
    //   for (let i = 0; i < existingUploadedFiles.Cursus_Licence.length-1; i++) {
    //     const key = `${index}_${i}`;
    //     const file = existingUploadedFiles.Cursus_Licence[key]?.file;
    //     if (file?.size > MAX_FILE_SIZE) {
    //       missingFields.push(`Relevé des notes - bloc ${index + 1} dépasse ${MAX_FILE_SIZE_MB} Mo.`);
    //     }
    //   }
    // }

    const toggle = block.querySelector(".toggle-blanche-checkbox");
    if (toggle?.checked) {
      block.querySelectorAll(".annee-blanche-list > div").forEach((blanche, bIndex) => {
        const nb = blanche.querySelector(".input-nbannee")?.value.trim();
        const cause = blanche.querySelector(".textarea-cause")?.value.trim();
        if (!nb) missingFields.push(`Année blanche - nb ${index + 1}.${bIndex + 1}`);
        if (!cause) missingFields.push(`Année blanche - cause ${index + 1}.${bIndex + 1}`);

        const file = existingUploadedFiles.Annee_Blanche[`${index}_${bIndex}`]?.file;
        if (!file) missingFields.push(`Justificatif année blanche - bloc ${index + 1}.${bIndex + 1}`);
        else if (file.size > MAX_FILE_SIZE) {
          missingFields.push(`Justificatif année blanche - bloc ${index + 1}.${bIndex + 1} dépasse ${MAX_FILE_SIZE_MB} Mo.`);
        }
      });
    }
  });

  if (missingFields.length > 0) {
    showErrorModal(missingFields);
    return false;
  }

  return true;
}
// ================== STEP 4 VALIDATION ================== //

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



}

/*
async function fillStep2Form(data) {

  console.log("data test" );
  console.log(data);
  if (!data) return;

  document.getElementById('year_bac').value = data.annee || '';
  document.getElementById('specialite').value = data.baccalaureat || '';
  document.getElementById('etablissement').value = data.etablissement || '';
  document.getElementById('session').value = data.session || '';
  document.getElementById('mention_bac').value = data.mention || '';
  document.getElementById('moyenne').value = data.moyenne || ''; 

  if (data.piece_jointe_path) {
  const bacDocList = document.getElementById('bac-document-list');
  const fullPath = `/Candidature/${data.piece_jointe_path}`;
  const filename = fullPath.split('/').pop();

    // Ici, fileIndex = 0 et cursusIndex = null pour le BAC
    await addExistingFileToDocumentList(bacDocList, filename, fullPath, 'Bac', 0, null);
  }

  if (data.cycle) {
    const cycleRadio = document.querySelector(`input[name="cycle"][value="${data.cycle}"]`);
    if (cycleRadio) cycleRadio.checked = true;
  }

  const parcours = data.parcours || [];
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");


// Université et établissement (chargement dynamique)
//await populateUniversites(); // charge les options de toutes les universités

parcours.forEach(async (year, index) => {

    const clone = yearTemplate.content.cloneNode(true);
    const wrapper = document.createElement("div");
    wrapper.classList.add("year-block-wrapper");
    wrapper.appendChild(clone);
    sectionContainer.appendChild(wrapper);

    console.log("univ");
    console.log(year.universite);
    
    const yearBlock = wrapper.querySelector(".year-block");
    yearBlock.querySelector('.select-annee').value = year.annee_academique || '';
    yearBlock.querySelector('.select-session').value = year.session || '';
    yearBlock.querySelector('.select-mention').value = year.mention || '';
    yearBlock.querySelector('.input-moyenne').value = year.moyenne || '';
    yearBlock.querySelector('.input-credit').value = year.credit || '';
   // yearBlock.querySelector('.select-universite').value = year.universite || '';



    if (year.annees_blanches?.length) {
        const checkbox = yearBlock.querySelector('.toggle-blanche-checkbox');
        checkbox.checked = true;
        checkbox.dispatchEvent(new Event("change"));

        const list = yearBlock.querySelector('.annee-blanche-list');
        const blancheTemplate = document.getElementById("annee-blanche-template");

        year.annees_blanches.forEach((blanche, bIndex) => {
          const blancheClone = blancheTemplate.content.cloneNode(true);
          const container = document.createElement("div");
          container.appendChild(blancheClone);
          list.appendChild(container);

          container.querySelector('.input-nbannee').value = blanche.nbannee || '';
          container.querySelector('.textarea-cause').value = blanche.cause || '';

          const fileUrl = blanche?.piece_jointe_path;
          if (fileUrl) {
            const cleanPath = fileUrl.replaceAll('\\', '/');
            const filename = cleanPath.split('/').pop();
            const fileKey = `${index}_${bIndex}`;
            const docList = container.querySelector('.document-list');
            addExistingFileToDocumentList(docList, filename, `/${cleanPath}`, 'Annee_Blanche', fileKey);
          }
        });
      }

      // 🔁 Lecture multiple des fichiers cursus (JSON array string)
      if (year?.piece_jointe_path) {
        try {
          const paths = JSON.parse(year.piece_jointe_path);
          const docList = yearBlock.querySelector('.document-list');
          paths.forEach((filePath, fileIdx) => {
            const cleanPath = filePath.replaceAll('\\', '/');
            const filename = cleanPath.split('/').pop();
            const fileKey = `${index}_${fileIdx}`;
            addExistingFileToDocumentList(docList, filename, `/${cleanPath}`, 'Cursus_Licence', fileKey);
          });
        } catch (err) {
          console.error('Erreur parsing piece_jointe_path cursus:', err);
        }
      }

      initBlancheLogic(yearBlock);


    
  });

  




// 2. Ensuite, charge toutes les universités dans tous les selects
await populateUniversites();

// 3. Puis, pour chaque année, affecter la valeur de l’université et charger les établissements
const selectUniversites = document.querySelectorAll('.select-universite');
const selectEtablissements = document.querySelectorAll('.select-etablissement');

for (let i = 0; i < parcours.length; i++) {
  const year = parcours[i];
  const selectUniv = selectUniversites[i];
  const selectEtab = selectEtablissements[i];

  if (!year || !selectUniv || !selectEtab) continue;

  // Sélectionner l’université
  const exists = [...selectUniv.options].some(opt => opt.value == year.universite);
  if (!exists) {
    const opt = document.createElement('option');
    opt.value = year.universite;
    opt.textContent = year.universite;
    selectUniv.appendChild(opt);
  }
  selectUniv.value = year.universite;
  selectUniv.dispatchEvent(new Event('change'));

  // Charger les établissements pour cette université et appliquer la valeur par défaut
  await loadEtablissements(year.universite, selectEtab, year.etablissement);
}


}
*/

async function fillStep2Form(data) {
  console.log("data test");
  console.log(data);
  if (!data) return;

  document.getElementById('year_bac').value = data.annee || '';
  document.getElementById('specialite').value = data.baccalaureat || '';
  document.getElementById('etablissement').value = data.etablissement || '';
  document.getElementById('session').value = data.session || '';
  document.getElementById('mention_bac').value = data.mention || '';
  document.getElementById('moyenne').value = data.moyenne || ''; 

  if (data.piece_jointe_path) {
    const bacDocList = document.getElementById('bac-document-list');
    const fullPath = `/${data.piece_jointe_path}`;
    const filename = fullPath.split('/').pop();
  //  await addExistingFileToDocumentList(bacDocList, filename, fullPath, 'Bac', 0, null);
    //await addExistingFileToDocumentList(document.getElementById('document-list-bac'),filename,`/${path}`,'Bac',null,null);
    await addExistingFileToDocumentList(document.getElementById('document-list-bac'), filename, fullPath, 'Bac', null, null);

  }

  if (data.cycle) {
    const cycleRadio = document.querySelector(`input[name="cycle"][value="${data.cycle}"]`);
    if (cycleRadio) cycleRadio.checked = true;
  }

  const parcours = data.parcours || [];
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");

  sectionContainer.innerHTML = ''; // Nettoyage avant insertion

  parcours.forEach(async (year, index) => {
    const clone = yearTemplate.content.cloneNode(true);
    const wrapper = document.createElement("div");
    wrapper.classList.add("year-block-wrapper");
    wrapper.setAttribute("data-year-index", index);
    wrapper.appendChild(clone);
    sectionContainer.appendChild(wrapper);

    const yearBlock = wrapper.querySelector(".year-block");
    if (!yearBlock) return;

    yearBlock.setAttribute("data-index", index);

    // Donner des noms dynamiques aux inputs/selects
    const fields = yearBlock.querySelectorAll('[name]');
    fields.forEach(field => {
      const baseName = field.getAttribute('name');
      if (baseName) field.setAttribute('name', `${baseName}_${index}`);
    });

    // Remplir les champs principaux
    yearBlock.querySelector('.select-annee').value = year.annee_academique || '';
    yearBlock.querySelector('.select-session').value = year.session || '';
    yearBlock.querySelector('.select-mention').value = year.mention || '';
    yearBlock.querySelector('.input-moyenne').value = year.moyenne || '';
    yearBlock.querySelector('.input-credit').value = year.credit || '';

    // Années blanches
    if (year.annees_blanches?.length) {
      const checkbox = yearBlock.querySelector('.toggle-blanche-checkbox');
      checkbox.checked = true;
      checkbox.dispatchEvent(new Event("change"));

      const list = yearBlock.querySelector('.annee-blanche-list');
      const blancheTemplate = document.getElementById("annee-blanche-template");

      year.annees_blanches.forEach((blanche, bIndex) => {
        const blancheClone = blancheTemplate.content.cloneNode(true);
        const container = document.createElement("div");
        container.appendChild(blancheClone);
        list.appendChild(container);

        container.querySelector('.input-nbannee').value = blanche.nbannee || '';
        container.querySelector('.textarea-cause').value = blanche.cause || '';

        const fileUrl = blanche?.piece_jointe_path;
        if (fileUrl) {
          const cleanPath = fileUrl.replaceAll('\\', '/');
          const filename = cleanPath.split('/').pop();
          const fileKey = `${index}_${bIndex}`;
          const docList = container.querySelector('.document-list');
          addExistingFileToDocumentList(docList, filename, `/${cleanPath}`, 'Annee_Blanche', fileKey);
        }
      });
    }

    /*

    // Fichiers du cursus (attestation, relevé, etc.)
    if (year?.piece_jointe_path) {
      try {
        const paths = JSON.parse(year.piece_jointe_path);
        const docList = yearBlock.querySelector('.document-list');
        paths.forEach((filePath, fileIdx) => {
          const cleanPath = filePath.replaceAll('\\', '/');
          const filename = cleanPath.split('/').pop();
          const fileKey = `${index}_${fileIdx}`;
          addExistingFileToDocumentList(docList, filename, `/${cleanPath}`, 'Cursus_Licence', fileKey);
        });
      } catch (err) {
        console.error('Erreur parsing piece_jointe_path cursus:', err);
      }
    }
    */

   // Ajout fichiers attestation et relevé s’ils existent (nouvelle méthode)
    const docList = yearBlock.querySelector('.document-list');

    // 0 = attestation
    if (year.piece_jointe_path_attestation) {
      const path = year.piece_jointe_path_attestation.replaceAll('\\', '/');
      const filename = path.split('/').pop();
      // fileIndex = 0, cursusIndex = index
      await addExistingFileToDocumentList(docList, filename, `/${path}`, 'Cursus_Licence', 0, index);
    }

    // 1 = relevé
    if (year.piece_jointe_path_releve) {
      const path = year.piece_jointe_path_releve.replaceAll('\\', '/');
      const filename = path.split('/').pop();
      // fileIndex = 1, cursusIndex = index
      await addExistingFileToDocumentList(docList, filename, `/${path}`, 'Cursus_Licence', 1, index);
    }


   

/*

    // Ajout des data-cursus-index et data-file-index dynamiques
    const fileInputs = wrapper.querySelectorAll('input[type="file"][data-target="Cursus_Licence"]');
    fileInputs.forEach((input, fileIndex) => {
      input.setAttribute('data-cursus-index', index);
      input.setAttribute('data-file-index', fileIndex);
    });*/

    const singleContainers = wrapper.querySelectorAll('.upload-files-container-all .single-container');
    singleContainers.forEach((container, fileIndex) => {
      const input = container.querySelector('input[type="file"][data-target="Cursus_Licence"]');
      if (input) {
        input.setAttribute('data-cursus-index', index);
        input.setAttribute('data-file-index', fileIndex);
      }
    });



    initBlancheLogic(yearBlock);
  });

  // Chargement des universités
  await populateUniversites();

  // Affectation des universités et chargement des établissements
  const selectUniversites = document.querySelectorAll('.select-universite');
  const selectEtablissements = document.querySelectorAll('.select-etablissement');

  for (let i = 0; i < parcours.length; i++) {
    const year = parcours[i];
    const selectUniv = selectUniversites[i];
    const selectEtab = selectEtablissements[i];

    if (!year || !selectUniv || !selectEtab) continue;

    // Ajouter l'option si absente
    const exists = [...selectUniv.options].some(opt => opt.value == year.universite);
    if (!exists && year.universite) {
      const opt = document.createElement('option');
      opt.value = year.universite;
      opt.textContent = year.universite;
      selectUniv.appendChild(opt);
    }

    // Sélectionner l’université et charger les établissements
    selectUniv.value = year.universite;
    selectUniv.dispatchEvent(new Event('change'));
    await loadEtablissements(year.universite, selectEtab, year.etablissement);
  }
}


// function fillStep2Form(data) {
//   if (!data) return;

//   // Bac fields
//   document.getElementById('year_bac').value = data.annee || '';
//   document.getElementById('specialite').value = data.baccalaureat || '';
//   document.getElementById('etablissement').value = data.etablissement || '';
//   document.getElementById('session').value = data.session || '';
//   document.getElementById('mention_bac').value = data.mention || '';
//   document.getElementById('moyenne').value = data.moyenne || '';
//   const bacFileUrl = data.piece_jointe_path; // Adjust based on your data structure
//   if (data.piece_jointe_path) {
//     const bacDocList = document.getElementById('bac-document-list');
//     if (bacDocList) {
//       const fullBacUrl = `/Candidature/${data.piece_jointe_path}`;
//       const filename = fullBacUrl.split('/').pop();
//       addExistingFileToDocumentList(bacDocList, filename, fullBacUrl, 'Bac', null);
//     }
//   }
//   if (data.cycle) {
//     const cycleRadio = document.querySelector(`input[name="cycle"][value="${data.cycle}"]`);
//     if (cycleRadio) cycleRadio.checked = true;
//   }

//   // Parcours universitaires
//   const parcours = data.parcours || [];
//   const sectionContainer = document.getElementById("dynamic-sections");
//   const yearTemplate = document.getElementById("year-block-template");

//   parcours.forEach(async (year, index) => {
//     const clone = yearTemplate.content.cloneNode(true);
//     const wrapper = document.createElement("div");
//     wrapper.classList.add("year-block-wrapper");
//     wrapper.appendChild(clone);
//     sectionContainer.appendChild(wrapper);

//     const yearBlock = wrapper.querySelector(".year-block");

//     yearBlock.querySelector('.select-annee').value = year.annee_academique || '';
//     yearBlock.querySelector('.select-universite').value = year.universite || '';
//     yearBlock.querySelector('.select-etablissement').value = year.etablissement || '';
//     yearBlock.querySelector('.select-session').value = year.session || '';
//     yearBlock.querySelector('.select-mention').value = year.mention || '';
//     yearBlock.querySelector('.input-moyenne').value = year.moyenne || '';
//     yearBlock.querySelector('.input-credit').value = year.credit || '';

//     // Add gap years
//     if (year.annees_blanches && year.annees_blanches.length) {
//       const checkbox = yearBlock.querySelector('.toggle-blanche-checkbox');
//       checkbox.checked = true;
//       checkbox.dispatchEvent(new Event("change"));

//       const list = yearBlock.querySelector('.annee-blanche-list');
//       const blancheTemplate = document.getElementById("annee-blanche-template");

//       year.annees_blanches.forEach((blanche, bIndex) => {
//         const blancheClone = blancheTemplate.content.cloneNode(true);
//         const container = document.createElement("div");
//         container.appendChild(blancheClone);
//         list.appendChild(container);

//         container.querySelector('.input-nbannee').value = blanche.nbannee || '';
//         container.querySelector('.textarea-cause').value = blanche.cause || '';

//         // Load gap year file if exists
//         const fileUrl = blanche?.piece_jointe_path;
//         if (fileUrl) {
//           const fullUrl = `/Candidature/${fileUrl}`;
//           const filename = fullUrl.split('/').pop();
//           const fileKey = `${index}_${bIndex}`;
//           const docList = container.querySelector('.document-list');
//           addExistingFileToDocumentList(docList, filename, fullUrl, 'Annee_Blanche', fileKey);
//         }
//       });
//     }

//     // Load main file
//     const fileUrl = year?.piece_jointe_path;
//     if (fileUrl) {
//       const fullUrl = `/Candidature/${fileUrl}`;
//       const filename = fullUrl.split('/').pop();
//       const fileKey = `year_${index}`;
//       const docList = yearBlock.querySelector('.document-list');
//       await addExistingFileToDocumentList(docList, filename, fullUrl, 'Cursus_Licence', fileKey);
//     }

//     initBlancheLogic(yearBlock);
//   });
// }

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
function createYearBlocks(count) {
  const sectionContainer = document.getElementById("dynamic-sections");
  const yearTemplate = document.getElementById("year-block-template");
  if (!sectionContainer || !yearTemplate) return;

  // Réinitialise le conteneur principal
  sectionContainer.innerHTML = "";

  const selectedCycle = document.querySelector('.cycle-selection input[type="radio"]:checked')?.value || 'licence';

  const cycleContainer = document.createElement("div");
  cycleContainer.className = "cycle-container";
  cycleContainer.dataset.cycle = selectedCycle;

  // Ajoute un titre dynamique (ex: Cursus Licence)
  const cycleTitle = document.createElement("h3");
  cycleTitle.textContent = `Cursus ${selectedCycle.charAt(0).toUpperCase() + selectedCycle.slice(1)}`;
  cycleContainer.appendChild(cycleTitle);

  for (let i = 0; i < count; i++) {
    const clone = yearTemplate.content.cloneNode(true);
    const yearBlock = document.createElement("div");
    yearBlock.className = "year-block-wrapper";
    yearBlock.dataset.yearIndex = i;

    // Met à jour dynamiquement tous les attributs name des champs
    const fields = clone.querySelectorAll('[name]');
    fields.forEach(field => {
      const originalName = field.name;
      field.name = `${originalName}_${i}`;
    });

    // Mise à jour spécifique pour les fichiers : attributs data-*
    const fileInputs = clone.querySelectorAll('input[type="file"]');
    fileInputs.forEach((input, index) => {
      input.setAttribute("data-cursus-index", i.toString());
      input.setAttribute("data-file-index", index.toString());
      input.name = `Cursus_Licence_${i}`; // important pour upload
    });

    // Ajoute un titre "Année N"
    const yearTitle = document.createElement("h4");
    yearTitle.style.padding = "0 20px";
    yearTitle.textContent = `Année ${i + 1}`;
    yearBlock.appendChild(yearTitle);

    // Ajoute le bloc cloné dans le wrapper
    yearBlock.appendChild(clone);
    // ✅ Ajoute dynamiquement une .document-list vide pour l’upload preview

    // Initialise la logique des années blanches pour ce bloc
    initBlancheLogic(yearBlock, i);

    // Ajoute ce bloc dans le cycle container
    cycleContainer.appendChild(yearBlock);
  }

  // Ajoute le tout dans la section principale
  sectionContainer.appendChild(cycleContainer);

  // appel function université populateUniversites();
  //populateUniversites();


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
/*
function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  console.log("inside  loadScoreFormuleAndCriteres");
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');
    const institutId = parseInt(document.getElementById('etablissement2')?.value || '0', 10);

  console.log(container, formuleBox, masterId);

  if (!container || !formuleBox) return;

   // Si institut 8 (FDST), on ne charge pas les critères ici
   console.log('instut id');
   console.log(institutId);

  if (institutId === 8) {
    container.innerHTML = '<p class="text-info">Aucun critère à remplir ici. Veuillez passer à l’étape suivante.</p>';
    formuleBox.value = '';
    return;
  }

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
    */

function loadScoreFormuleAndCriteres(masterId, niveau = 'M1') {
  const container = document.getElementById('score-criteres-container');
  const formuleBox = document.getElementById('formule-score');
  const institutId = parseInt(document.getElementById('etablissement2')?.value || '0', 10);
  const cycle = document.querySelector('input[name="cycle"]:checked')?.value || null;

  console.log("📥 Appel avec", { masterId, niveau, institutId, cycle });

  if (!container || !formuleBox) return;

  // 🔁 Cas spécial FDST (institut ID 8)
  if (institutId === 8 && cycle) {
    console.log("🔁 Mode FDST : chargement par cycle =", cycle);

    fetch(`/wp-json/plateforme-master/v1/score-par-cycle-et-institut/${institutId}/${niveau}/${cycle}`, {
      credentials: 'include'
    })
      .then(res => res.json())
      .then(data => {
        const { formule } = data || {};
        container.innerHTML = '';

        if (formule) {
          formuleBox.value = formule;
          container.innerHTML = `<p class="text-info">✅ Formule chargée pour le cycle <strong>${cycle}</strong>.</p>`;
        } else {
          formuleBox.value = '';
          container.innerHTML = `<p class="text-warning">⚠️ Aucune formule trouvée pour le cycle <strong>${cycle}</strong>.</p>`;
        }
      })
      .catch(err => {
        console.error('❌ Erreur chargement formule FDST :', err);
        container.innerHTML = '<p class="text-danger">Erreur de chargement de la formule.</p>';
        formuleBox.value = '';
      });

    return;
  }

  // ✅ Cas normal (par master_id)
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

        let html = `<div class="form-field"><label><strong>${crit.titre_affiche}</strong></label>`;
        let cfg = {};

        try {
          cfg = JSON.parse(crit.config_json || '{}');
        } catch (e) {
          console.warn('Erreur parsing JSON pour le critère', crit);
        }

        // Reste du switch (matières, PFE, malus, interruption...) inchangé
        // ...
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
*/



async function initializeNationalites() {
  try {
    const response = await fetch(PMSettings.apiUrlNationalites, {
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
    if (!frSelect || !arSelect) return;

    frSelect.innerHTML = '<option value="">-- Sélectionner une nationalité --</option>';
    arSelect.innerHTML = '<option value="">-- اختر الجنسية --</option>';

    data.forEach(nat => {
      frSelect.add(new Option(nat.intitule, nat.id));
      arSelect.add(new Option(nat.intitule_ar, nat.id));
    });

    frSelect.addEventListener('change', () => {
      arSelect.value = frSelect.value;
      toggleCinOrIdentifiant();
    });

    arSelect.addEventListener('change', () => {
      frSelect.value = arSelect.value;
      toggleCinOrIdentifiant();
    });

    console.log('✅ Nationalités chargées');
  } catch (err) {
    console.error('Erreur réseau lors du chargement des nationalités :', err);
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

// ================== FILE MANAGEMENT ================== //
// const existingUploadedFiles = {
//   Bac: null,
//   Cursus_Licence: {},  // Changed to object for key-based access
//   Annee_Blanche: {}
// };
// async function addExistingFileToDocumentList(documentList, filename, fileUrl, target, key = null) {
//   try {
//     const baseURL = window.location.origin;
//     const fullUrl = fileUrl.startsWith('http') ? fileUrl : `${baseURL}${fileUrl.startsWith('/') ? '' : '/'}${fileUrl}`;
//     const response = await fetch(fullUrl);
//     if (!response.ok) throw new Error(`HTTP ${response.status} while fetching file`);

//     const blob = await response.blob();
//     const file = new File([blob], filename, { type: blob.type });

//     const documentItem = document.createElement('div');
//     documentItem.className = 'document-item';
//     documentItem.innerHTML = `
//       <div class="document-name-container">
//         <div class="pdf-icon"></div>
//         <div class="document-name">${filename}</div>
//       </div>
//       <div class="remove-document" style="position:relative">
//         <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/closepdf.png" 
//              style="width: 20px; position: absolute; top: -80px; right: -27px; cursor:pointer">
//       </div>
//     `;

//     documentItem.querySelector('.remove-document').addEventListener('click', () => {
//       documentItem.remove();
//       if (documentList.children.length === 0) {
//         // documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
//       }

//       if (target === 'Bac') {
//         existingUploadedFiles.Bac = null;
//       } else if (target === 'Cursus_Licence' && key !== null) {
//         delete existingUploadedFiles.Cursus_Licence[key];
//       } else if (target === 'Annee_Blanche' && key !== null) {
//         delete existingUploadedFiles.Annee_Blanche[key];
//       }
//     });

//     // Ne pas supprimer les fichiers déjà présents dans la liste
//     const emptyState = documentList.querySelector('.empty-state');
//     if (emptyState) emptyState.remove();
//     documentList.appendChild(documentItem);

//     // Mémoriser le fichier
//     if (target === 'Bac') {
//       existingUploadedFiles.Bac = { file, filename };
//     } else if (target === 'Cursus_Licence' && key !== null) {
//       existingUploadedFiles.Cursus_Licence[key] = { file, filename };
//     } else if (target === 'Annee_Blanche' && key !== null) {
//       existingUploadedFiles.Annee_Blanche[key] = { file, filename };
//     }
//   } catch (error) {
//     console.error('Erreur lors de l’ajout du fichier existant :', error);
//   }
// }
async function addExistingFileToDocumentList(documentList, filename, fileUrl, target, fileIndex = null, cursusIndex = null) {
  try {
    const baseURL = window.location.origin;

    console.log("fileUrl");
    console.log(fileUrl);

    const fullUrl = fileUrl.startsWith('http') ? fileUrl : `${baseURL}/wp-content${fileUrl.startsWith('/') ? '' : '/'}${fileUrl}`;

    console.log(fullUrl);

    const response = await fetch(fullUrl);
    if (!response.ok) throw new Error(`HTTP ${response.status} while fetching file`);

    const blob = await response.blob();
    const file = new File([blob], filename, { type: blob.type });

    //const container = findTargetContainer(target, fileIndex);
    const container = findTargetContainer(target, cursusIndex, fileIndex);

    if (!container) throw new Error('Container not found');

    const fileInput = container.querySelector('.file-input');
    const previewContainer = container.querySelector('.file-upload-container');
    const uploadLabel = container.querySelector('.upload-label');

    if (!previewContainer) throw new Error('Preview container not found');

    // Update preview UI
    previewContainer.style.display = 'block';
    previewContainer.querySelector('.file-name').textContent = filename;
    previewContainer.querySelector('.file-meta').textContent =
      `${Math.round(file.size / 1024)} KB`;

    // Hide the upload label
    if (uploadLabel) uploadLabel.style.display = 'none';

    // Add close icon if not exists
    if (!previewContainer.querySelector('.close-pdf-icon')) {
      const closeIcon = document.createElement('img');
      closeIcon.src = '/wp-content/plugins/plateforme-master/pages/Candidature/assets/closepdf.png';
      closeIcon.className = 'close-pdf-icon';
      closeIcon.style.position = 'absolute';
      closeIcon.style.top = '5px';
      closeIcon.style.right = '5px';
      closeIcon.style.cursor = 'pointer';
      previewContainer.querySelector('.file-item').appendChild(closeIcon);

      closeIcon.addEventListener('click', () => {
        if (fileInput) fileInput.value = '';
        previewContainer.style.display = 'none';
        if (uploadLabel) uploadLabel.style.display = 'flex';
        updateFileTracking(target, cursusIndex, fileIndex, null);
      });
    }

    // Update file tracking
    updateFileTracking(target, cursusIndex, fileIndex, file);

    // Remove empty state if it exists
    const emptyState = documentList.querySelector('.empty-state');
    if (emptyState) emptyState.remove();
  } catch (error) {
    console.error('Erreur lors de l’ajout du fichier existant :', error);
  }
}

/*
// Helper function to locate container
function findTargetContainer(target, key) {
  if (target === 'Bac') {
    return document.querySelector('.single-container[data-target="Bac"]');
  }

  // For indexed containers (Cursus_Licence/Annee_Blanche)
  const selector = `.single-container[data-target="${target}"] input[data-cursus-index="${key}"], 
                   .single-container[data-target="${target}"] input[data-file-index="${key}"]`;

  const input = document.querySelector(selector);
  return input ? input.closest('.single-container') : null;
}
*/
/*
function findTargetContainer(target, key) {
  if (target === 'Bac') {
    return document.querySelector(`.single-container[data-target="${target}"]`);
  }

  const selector = `.single-container[data-target="${target}"] input[data-cursus-index="${key}"], 
                   .single-container[data-target="${target}"] input[data-file-index="${key}"]`;
  const input = document.querySelector(selector);
  return input ? input.closest('.single-container') : null;
}
  */

/*
function findTargetContainer(target, key) {
  console.log('Recherche container avec', { target, key });

  if (target === 'Bac') {
    return document.querySelector(`.single-container[data-target="${target}"]`);
  }

  const parts = String(key).split('_');
  const cursusIndex = parts[0];
  const fileIndex = parts[1];

  console.log('Target: ', target, '| CursusIndex:', cursusIndex, '| FileIndex:', fileIndex);

  const yearBlock = document.querySelector(`.year-block[data-index="${cursusIndex}"]`);
  if (!yearBlock) {
    console.warn(`Bloc année non trouvé pour index ${cursusIndex}`);
    return null;
  }

  const containers = yearBlock.querySelectorAll('.upload-files-container-all .single-container');
  console.log(`${containers.length} containers trouvés dans l'année ${cursusIndex}`);
  return containers[fileIndex] || null;
}
*/

function findTargetContainer(target, cursusIndex, fileIndex) {
  console.log('Recherche container avec', { target, cursusIndex, fileIndex });

  if (target === 'Bac') {
    return document.querySelector(`.single-container[data-target="${target}"]`);
  }

  const yearBlock = document.querySelector(`.year-block[data-index="${cursusIndex}"]`);
  if (!yearBlock) {
    console.warn(`Bloc année non trouvé pour index ${cursusIndex}`);
    return null;
  }

  const containers = yearBlock.querySelectorAll('.upload-files-container-all .single-container');
  console.log(`${containers.length} containers trouvés dans l'année ${cursusIndex}`);
  return containers[fileIndex] || null;
}



/**
 * Initialize file upload functionality
 */
function initializeFileUploads() {
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('upload-btn')) {
      const container = e.target.closest('.upload-container');
      const fileInput = container.querySelector('.file-input');
      fileInput.click();
    }
  });

  document.addEventListener('change', (e) => {
    if (e.target.classList.contains('file-input')) {
      const files = e.target.files;
      const container = e.target.closest('.form-field');
      const documentList = container.querySelector('.document-list');
      if (!documentList) return;
      updateDocumentList(documentList, files);
    }
  });
}
/**
 * Update the document list display
 */
function updateDocumentList(documentList, files) {
  if (files.length > 0) {
    documentList.innerHTML = '';
    for (let i = 0; i < files.length; i++) {
      addFileToDocumentList(documentList, files[i]);
    }
  } else {
    if (documentList.children.length === 0) {
      // documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
    }
  }
}
/**
 * Add a single file to the document list
 */
function addFileToDocumentList(documentList, file) {
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

  const removeBtn = document.createElement('span');
  removeBtn.className = 'remove-document';
  removeBtn.innerHTML = `<div class="remove-document" style="position:relative">
      <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/closepdf.png" 
      style="width: 20px;
          position: absolute;
          top: -80px;
          right: -27px;cursor:pointer">
      </div>`;
  // removeBtn.addEventListener('click', () => {
  //   documentItem.remove();
  //   if (documentList.children.length === 0) {
  //     documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
  //   }
  // });


  documentItem.querySelector('.remove-document').addEventListener('click', () => {
    documentItem.remove();
    if (documentList.children.length === 0) {
      // documentList.innerHTML = '<div class="empty-state">Aucun document importé</div>';
    }

    if (target === 'Bac' || target === 'bac') {
      existingUploadedFiles.Bac = null;
    }
    else if (target === 'Cursus_Licence' && key !== null) {
      delete existingUploadedFiles.Cursus_Licence[key];
    }
    else if (target === 'Annee_Blanche' && key !== null) {
      delete existingUploadedFiles.Annee_Blanche[key];
    }
  });

  documentItem.appendChild(nameContainer);
  documentItem.appendChild(removeBtn);
  documentList.appendChild(documentItem);
}

document.addEventListener('DOMContentLoaded', () => {
  initializeFileUploads();
});
// ================== END FILE MANAGEMENT ================== //

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

function removeRequiredFromHiddenFields() {
  document.querySelectorAll('div[style*="display: none"]').forEach(container => {
    container.querySelectorAll('input, select, textarea').forEach(field => {
      field.removeAttribute('required');
    });
  });
}


async function submitForm() {

  

  console.log("submit form");

  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Soumission en cours...';
  }

  const formData = new FormData();

  const bacFileInput = document.querySelector('input[name="Bac"]');
  if (bacFileInput?.files?.[0]) {
    formData.append('files[Bac]', bacFileInput.files[0]);
  } else if (existingUploadedFiles.Bac) {
    formData.append('files[Bac]', existingUploadedFiles.Bac.file, existingUploadedFiles.Bac.filename);
  }

 
  // 2. Handle Cursus_Licence files (3 files per cursus)
  console.log("existingUploadedFiles*********", existingUploadedFiles);

  for (let cursusIndex = 0; cursusIndex < existingUploadedFiles.Cursus_Licence.length; cursusIndex++) {
    const files = existingUploadedFiles.Cursus_Licence[cursusIndex];
    // Only process if cursus has at least one file
    if (files && files.some(file => file !== null)) {
      for (let fileIndex = 0; fileIndex < files.length; fileIndex++) {
        const file = files[fileIndex];
        if (file) {
          formData.append(`files[Cursus_Licence_${cursusIndex}_${fileIndex}]`, file);
        }
      }
    }
  }

  // 3. Handle Annee_Blanche files
  for (let blancheIndex = 0; blancheIndex < existingUploadedFiles.Annee_Blanche.length; blancheIndex++) {
    const files = existingUploadedFiles.Annee_Blanche[blancheIndex];

    if (files && files.some(file => file !== null)) {
      for (let fileIndex = 0; fileIndex < files.length; fileIndex++) {
        const file = files[fileIndex];
        if (file) {
          formData.append(`files[Annee_Blanche_${blancheIndex}_${fileIndex}]`, file);
        }
      }
    }
  }


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
    var selectedtest = document.querySelector(".cycle-selection input[type='radio']:checked");
    parcours_academiques.push({
      cursus_title: selectedtest.value == "autre" ? block.querySelector('.spec-autre')?.value.trim() : selectedtest.value.trim(),
      annee: block.querySelector('.select-annee')?.value.trim() || '',
      universite: block.querySelector('.select-universite')?.value.trim() || '',
      etablissement: block.querySelector('.select-etablissement')?.value.trim() || '',
      session: block.querySelector('.select-session')?.value.trim() || '',
      mention: block.querySelector('.select-mention')?.value.trim() || '',
      moyenne: block.querySelector('.input-moyenne')?.value.trim() || '',
      credit: block.querySelector('.input-credit')?.value.trim() || ''
    });
  });
  formData.append('parcours_academiques', JSON.stringify(parcours_academiques));
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



  // 👇 Pour FDST uniquement
const institutId = parseInt(document.getElementById('etablissement2')?.value || '0', 10);

if (institutId === 8) {
  const classementInputs = document.querySelectorAll('#masters-radio-container input[type="number"][name^="master_value_"]');
  const classement_masters = [];

  classementInputs.forEach(input => {
    const masterId = parseInt(input.dataset.masterId || input.getAttribute('data-master-id') || 0, 10);
    const ordre = parseInt(input.value || 0, 10);

    if (masterId && ordre) {
      classement_masters.push({
        master_id: masterId,
        ordre: ordre
      });
    }
  });

  // Ajout au FormData
  formData.append('classement_masters', JSON.stringify(classement_masters));
}

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
      document.getElementById('form-confirm-popup-sended').style.display = 'flex';
    }
    else {
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

async function populateUniversites() {
  try {
    const response = await fetch('/wp-json/plateforme-master/v1/universites', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings?.nonce || ''
      },
      credentials: 'include'
    });

    const universites = await response.json();

    if (!Array.isArray(universites)) {
      console.warn("Aucune université trouvée.");
      return;
    }

    document.querySelectorAll('.select-universite').forEach(select => {
      select.innerHTML = '<option value="">-- Sélectionner une université --</option>';
      universites.forEach(uni => {
        const option = document.createElement('option');
        option.value = uni.id;
        option.textContent = uni.nom;
        select.appendChild(option);
      });
    });

  } catch (error) {
    console.error("Erreur chargement universités :", error);
  }
}


document.addEventListener('change', function (e) {
  if (e.target && e.target.classList.contains('select-universite')) {
    const universiteId = e.target.value;
    const wrapper = e.target.closest('.year-block-wrapper');
    const etabSelect = wrapper.querySelector('.select-etablissement');

    if (!etabSelect || !universiteId) return;

    fetch(`/wp-json/plateforme-master/v1/etablissements-par-universite/${universiteId}`, {
      credentials: 'include'
    })
      .then(res => res.json())
      .then(etabs => {
        etabSelect.innerHTML = '<option value="">-- Sélectionner un établissement --</option>';
        if (Array.isArray(etabs)) {
          etabs.forEach(etab => {
            const opt = document.createElement('option');
            opt.value = etab.id;
            opt.textContent = etab.nom;
            etabSelect.appendChild(opt);
          });
        }
      })
      .catch(err => {
        console.error('Erreur chargement établissements :', err);
      });
  }
});


function waitForOptions(selectElement, minOptions = 2) {
  return new Promise(resolve => {
    const observer = new MutationObserver(() => {
      if (selectElement.options.length >= minOptions) {
        observer.disconnect();
        resolve();
      }
    });
    observer.observe(selectElement, { childList: true });
  });
}


async function loadEtablissements(universiteId, etabSelect, selectedValue = null) {
  if (!etabSelect || !universiteId) return;

  try {
    const res = await fetch(`/wp-json/plateforme-master/v1/etablissements-par-universite/${universiteId}`, {
      credentials: 'include'
    });
    const etabs = await res.json();

    etabSelect.innerHTML = '<option value="">-- Sélectionner un établissement --</option>';

    if (Array.isArray(etabs)) {
      etabs.forEach(etab => {
        const opt = document.createElement('option');
        opt.value = etab.id;
        opt.textContent = etab.nom;
        etabSelect.appendChild(opt);
      });

      // ➕ Ajouter la sélection par défaut si trouvée
      if (selectedValue) {
        const exists = etabs.some(et => et.id == selectedValue);
        if (exists) {
          etabSelect.value = selectedValue;
        } else {
          // Ajouter l’établissement manuellement s’il n’est pas dans la liste
          const customOption = document.createElement('option');
          customOption.value = selectedValue;
          customOption.textContent = selectedValue; // ou 'Établissement non répertorié'
          etabSelect.appendChild(customOption);
          etabSelect.value = selectedValue;
        }
      }
    }
  } catch (err) {
    console.error('Erreur chargement établissements :', err);
  }
}



document.addEventListener('DOMContentLoaded', () => {
            // 1. Delegation mapping
            const delegationsByGouvernorat = {
                "Ariana": ["Ariana Ville", "Ettadhamen", "La Soukra", "Raoued", "Sidi Thabet"],
                "Béja": ["Béja Nord", "Béja Sud", "Testour", "Téboursouk", "Amdoun", "Goubellat", "Nefza"],
                "Ben Arous": ["Ben Arous", "Mégrine", "Ezzahra", "Hammam Lif", "Hammam Chott", "Mohamedia", "Radès"],
                "Bizerte": ["Bizerte Nord", "Bizerte Sud", "Mateur", "Ras Jebel", "Sejnane", "Tinja", "Utique"],
                "Gabès": ["Gabès Ville", "El Hamma", "Ghannouch", "Mareth", "Matmata"],
                "Gafsa": ["Gafsa Nord", "Gafsa Sud", "Metlaoui", "Redeyef", "Oum Laarayes"],
                "Jendouba": ["Jendouba", "Fernana", "Aïn Draham", "Bou Salem"],
                "Kairouan": ["Kairouan Nord", "Kairouan Sud", "Haffouz", "Sbikha", "Chebika"],
                "Kasserine": ["Kasserine Nord", "Kasserine Sud", "Thala", "Fériana"],
                "Kébili": ["Kébili Nord", "Kébili Sud", "Douz"],
                "Kef": ["Le Kef", "Nebeur", "Tajerouine", "Dahmani"],
                "Mahdia": ["Mahdia", "Chebba", "Ksour Essef", "El Jem"],
                "La Manouba": ["Manouba", "Djedeida", "Douar Hicher", "Oued Ellil"],
                "Médenine": ["Médenine Nord", "Médenine Sud", "Ben Gardane", "Djerba"],
                "Monastir": ["Monastir", "Ksar Hellal", "Sahline", "Jemmal"],
                "Nabeul": ["Nabeul", "Hammamet", "Korba", "Kelibia", "Dar Chaabane"],
                "Sfax": ["Sfax Ville", "Sakiet Ezzit", "El Ain", "Mahres"],
                "Sidi Bouzid": ["Sidi Bouzid", "Meknassi", "Menzel Bouzaiene"],
                "Siliana": ["Siliana", "Gaafour", "Kesra"],
                "Sousse": ["Sousse Ville", "Msaken", "Kalaa Kebira", "Kalaa Seghira"],
                "Tataouine": ["Tataouine Nord", "Tataouine Sud", "Bir Lahmar"],
                "Tozeur": ["Tozeur", "Nefta", "Degache"],
                "Tunis": ["Tunis Centre", "El Omrane", "Carthage", "La Marsa", "Bab El Bhar"],
                "Zaghouan": ["Zaghouan", "El Fahs", "Zriba"]
            };

            // 2. Function to update delegation select based on selected gouvernorat
            function updateDelegations() {
                const gouvernoratSelect = document.getElementById('gouvernorat');
                const delegationSelect = document.getElementById('delegation');
                const selectedGov = gouvernoratSelect.value;

                // Clear previous options
                delegationSelect.innerHTML = '<option value="">-- Sélectionner une délégation --</option>';
                console.log(selectedGov, delegationsByGouvernorat[selectedGov]);

                if (delegationsByGouvernorat[selectedGov]) {
                    delegationsByGouvernorat[selectedGov].forEach(delegation => {
                        const option = document.createElement('option');
                        option.value = delegation;
                        option.textContent = delegation;
                        delegationSelect.appendChild(option);
                    });
                }
            }
            console.log(document.getElementById('gouvernorat'));

            document.getElementById('gouvernorat')?.addEventListener('change', updateDelegations);


       


        });
        document.addEventListener('DOMContentLoaded', () => {
            const delegationsArByGouvernoratAr = {
                "أريانة": ["أريانة المدينة", "رواد", "سكرة", "التضامن", "سيدي ثابت"],
                "باجة": ["باجة الشمالية", "باجة الجنوبية", "نفزة", "تيبار", "تستور", "عمدون", "مجاز الباب"],
                "بن عروس": ["بن عروس", "الزهراء", "حمام الأنف", "حمام الشط", "رادس", "مقرين", "مرناق", "فوشانة", "المروج"],
                "بنزرت": ["بنزرت الشمالية", "بنزرت الجنوبية", "رأس الجبل", "ماطر", "منزل بورقيبة", "منزل جميل", "تينجة", "غار الملح", "عالية"],
                "قابس": ["قابس المدينة", "قابس الغربية", "قابس الجنوبية", "الحامة", "ماتماطة", "غنوش", "المطوية", "وديان"],
                "قفصة": ["قفصة الشمالية", "قفصة الجنوبية", "أم العرائس", "المتلوي", "الرديف", "السند", "القطار"],
                "جندوبة": ["جندوبة", "بلطة بوعوان", "طبرقة", "فرنانة", "عين دراهم", "وادي مليز", "غار الدماء"],
                "القيروان": ["القيروان الشمالية", "القيروان الجنوبية", "الشراردة", "بوحجلة", "السبيخة", "حاجب العيون", "نصر الله", "العلا"],
                "القصرين": ["القصرين", "سبيطلة", "تالة", "فريانة", "جدليان", "حاسي الفريد", "العيون"],
                "قبلي": ["قبلي الشمالية", "قبلي الجنوبية", "دوز الشمالية", "دوز الجنوبية", "الفوار", "رجيم معتوق"],
                "الكاف": ["الكاف", "تاجروين", "ساقية سيدي يوسف", "الدهماني", "الجريصة", "نبر", "السرس"],
                "المهدية": ["المهدية", "الجم", "سيدي علوان", "بومرداس", "شربان", "ملولش", "أولاد الشامخ", "هبيرة"],
                "منوبة": ["منوبة", "دوار هيشر", "وادي الليل", "المرناقية", "الجديدة", "البطان", "طبربة", "برج العامري"],
                "مدنين": ["مدنين الشمالية", "مدنين الجنوبية", "جرجيس", "بني خداش", "سيدي مخلوف", "بن قردان"],
                "المنستير": ["المنستير", "المكنين", "زرمدين", "بنان", "قصيبة المديوني", "جمّال", "طبلبة", "الساحلين"],
                "نابل": ["نابل", "دار شعبان الفهري", "الحمامات", "بني خيار", "قربة", "منزل تميم", "الهوارية", "قرمبالية"],
                "سيدي بوزيد": ["سيدي بوزيد الغربية", "سيدي بوزيد الشرقية", "المكناسي", "الرقاب", "بئر الحفي", "جلمة", "سبالة أولاد عسكر"],
                "سليانة": ["سليانة", "قعفور", "الكريب", "بوعرادة", "كسرى", "مكثر", "الروحية"],
                "سوسة": ["سوسة المدينة", "سوسة الجنوبية", "سوسة الشمالية", "القلعة الكبرى", "القلعة الصغرى", "سيدي بوعلي", "هرقلة", "حومة السوق"],
                "تطاوين": ["تطاوين الجنوبية", "تطاوين الشمالية", "غمراسن", "البئر الأحمر", "الصمار", "ذهيبة", "رمادة"],
                "توزر": ["توزر", "نفطة", "تمغزة", "حامة الجريد", "دوز"],
                "تونس": ["تونس المدينة", "المرسى", "قرطاج", "سيدي البشير", "باب سويقة", "باب البحر", "الزهروني", "حي الخضراء"],
                "زغوان": ["زغوان", "الفحص", "الناظور", "صواف", "بئر مشارقة"],
                "المهدية": ["المهدية", "الجم", "ملولش", "سيدي علوان", "بومرداس", "أولاد الشامخ"]
            };


            function updateDelegationsAr() {
                const gouvernoratArSelect = document.getElementById('gouvernoratAr');
                const delegationArSelect = document.getElementById('delegationAr');
                const selectedGovAr = gouvernoratArSelect.value.trim();

                delegationArSelect.innerHTML = '<option value="">-- الرجاء اختيار معتمدية --</option>';

                if (delegationsArByGouvernoratAr[selectedGovAr]) {
                    delegationsArByGouvernoratAr[selectedGovAr].forEach(delegation => {
                        const option = document.createElement('option');
                        option.value = delegation;
                        option.textContent = delegation;
                        delegationArSelect.appendChild(option);
                    });
                }
            }

            document.getElementById('gouvernoratAr')?.addEventListener('change', updateDelegationsAr);
        });

  

function setupSubmitBtnListener(buttonId = 'submit-btn') {
  const submitBtn = document.getElementById(buttonId);
  console.log("submit form 0", submitBtn);

  if (!submitBtn) return;

  submitBtn.addEventListener('click', () => {
    console.log("submit form 1");
    removeRequiredFromHiddenFields();

    const isValid = validateStep4();
    console.log("✅ validateStep4() retourne :", isValid);

    if (isValid) {
      console.log("submit form 2");
      showConfirmationPopup("Confirmez-vous les critères saisis ?", () => {
        submitForm();
      });
    }
  });
}
