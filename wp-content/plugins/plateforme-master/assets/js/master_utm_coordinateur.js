
// ✅ Code JS complet corrigé pour charger liste des masters avec support coordinateur & service

let allMasters = []; // Pour rafraichissement
let allMastersByCoord = []; // Pour rafraichissement


fetch(PMSettings.apiUrl, {
  method: 'GET',
  headers: { 'X-WP-Nonce': PMSettings.nonce }
})
  .then(async res => {
    const contentType = res.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      const text = await res.text();
      console.error('Réponse non JSON :', text);
      return;
    }
    
    allMasters = await res.json();
    const coordId = PMSettings.userId;
            const allMastersByCoord = allMasters.filter(m => m.coordinateur?.id === coordId);
    console.log("Masters:", allMastersByCoord);

    afficherTableMasters(allMastersByCoord);

    

    
  })
  .catch(err => console.error("Erreur API:", err));

function afficherTableMasters(data) {
  const tbody = document.getElementById("mastersTbody");
  const table = document.getElementById("mastersTable");

  if (!tbody || !table) return;

  if ($.fn.DataTable.isDataTable(table)) {
    $(table).DataTable().destroy();
  }

  tbody.innerHTML = '';

  data.forEach(master => {
    const row = document.createElement('tr');
    let coordCellContent = '-';

    if (master.coordinateur && master.coordinateur.avatar) {
      coordCellContent = `<img src="${master.coordinateur.avatar}" class="coord-avatar" alt="${master.coordinateur.display_name}" title="${master.coordinateur.display_name}">`;
    } else {
      coordCellContent = `
        <button class="action-menu" onclick="openAffectationModal(${master.id})" title="Affecter un coordinateur">
          <i class="fas fa-plus-circle coord-placeholder"></i>
        </button>
      `;
    }

    row.innerHTML = `
      <td><input type="checkbox"></td>
            <td>${master.parcours ?? '-'}</td>

      <td>${master.intitule_master ?? '-'}</td>
      <td>
        ${master.plan_etude_pdf ? 
          `<a href="${master.plan_etude_pdf}" target="_blank">
            <img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" class="pdf-icon" alt="PDF">
          </a>` : '-'}
      </td>
      <td>${master.debut_annee_habilitation ?? '-'}</td>
      <td>
        <div class="action-wrapper">
          <button class="action-menu" onclick="toggleMenu(this)">\u2022\u2022\u2022</button>
          <div class="action-dropdown" style="display: none;">
            <button onclick="voirDetails(${master.id})">\ud83d\udc41 Voir détails</button>
            <button onclick="ajouterSession(${master.id})">\u2795 Ajouter session</button>
          </div>
        </div>
      </td>
    `;

    tbody.appendChild(row);
  });

$(table).DataTable({
  paging: true,
  searching: true,
  info: false,
  ordering: true,
  pageLength: 5,
  lengthChange: false,
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'colvis',
      text: 'Afficher/Masquer Colonnes',
      className: 'custom-colvis-btn'
    }
  ],
  language: {
    search: "", // 🔕 supprime le label
    searchPlaceholder: "Recherche", // 🔎 placeholder personnalisé
    paginate: {
      previous: "«",
      next: "»"
    }
  }
});



}

function rafraichirCarrouselMasters() {
  afficherTableMasters(allMastersByCoord);
}

function toggleMenu(button) {
  const dropdown = button.nextElementSibling;
  document.querySelectorAll('.action-dropdown').forEach(menu => {
    if (menu !== dropdown) menu.style.display = 'none';
  });
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

document.addEventListener("click", function (e) {
  if (!e.target.closest(".action-wrapper")) {
    document.querySelectorAll(".action-dropdown").forEach(menu => {
      menu.style.display = "none";
    });
  }
});

function voirDetails(masterId) {
  window.location.href = `/MASTER/fiche-master?id=${masterId}`;
}

function ajouterSession(masterId) {
  alert(`Ajouter une session pour le master ID: ${masterId}`);
}


  function loadCoordinateurs(masterId) {
    const list = document.getElementById("utm-coord-list");
    list.innerHTML = '<li>Chargement...</li>';
  
    fetch(`${PMSettings.apiUrlCoordinateurs}?master_id=${masterId}`, {
      headers: { 'X-WP-Nonce': PMSettings.nonce }
    })
      .then(res => res.json())
      .then(data => {
        list.innerHTML = '';
  
        if (!Array.isArray(data) || data.length === 0) {
          list.innerHTML = '<li>Aucun coordinateur trouvé.</li>';
          return;
        }
  
        data.forEach(c => {
          list.innerHTML += `
            <li>
              <input type="radio" name="coord_id" value="${c.id}" id="coord_${c.id}">
              <label for="coord_${c.id}" style="display:flex; align-items:center;">
                <img src="${c.avatar}" alt="${c.nom}">
                <div class="affect-coord-info">
                  <div class="name">${c.nom}</div>
                  <div class="details">${c.grade ?? ''}${c.institut ? ', ' + c.institut : ''}</div>
                </div>
              </label>
            </li>
          `;
        });
      })
      .catch(err => {
        list.innerHTML = '<li>Erreur lors du chargement des coordinateurs.</li>';
        console.error("Erreur API /coordinateurs :", err);
      });
  }


  function enregistrerAffectation() {
    const selected = document.querySelector('input[name="coord_id"]:checked');
    if (!selected) return alert("Veuillez sélectionner un coordinateur.");
  
    const coord_id = selected.value;
    const master_id = window.currentMasterId; // master_id doit être défini globalement
  
    fetch('/wp-json/plateforme-master/v1/coordinateurs/affecter', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify({
        master_id: master_id,
        coordinateur_id: coord_id
      })
    })
      .then(res => res.json())
      .then(response => {
        if (response.success) {
          alert("Coordinateur affecté avec succès.");
          closeAffectationModal();
          location.reload(); // recharge la table si besoin
        } else {
          alert(response.message || "Erreur lors de l'affectation.");
        }
      })
      .catch(err => {
        console.error("Erreur API:", err);
        alert("Erreur réseau.");
      });
  }
  

  function openAffectationModal(masterId) {
    // Stocke l'ID du master globalement pour l'utiliser plus tard (dans enregistrerAffectation)
  window.currentMasterId = masterId;
    document.getElementById("modal-affectation-coordinateur").style.display = "flex";
    loadCoordinateurs(masterId);
  }
  
  function closeAffectationModal() {
    document.getElementById("modal-affectation-coordinateur").style.display = "none";
  }
  
  function loadCoordinateurs(masterId) {
    const list = document.getElementById("utm-coord-list");
    list.innerHTML = '<li>Chargement...</li>';
  
    fetch(`/wp-json/plateforme-master/v1/coordinateurs?master_id=${masterId}`, {
      headers: { 'X-WP-Nonce': PMSettings.nonce }
    })
      .then(res => res.json())
      .then(data => {
        list.innerHTML = '';
        data.forEach(c => {
          list.innerHTML += `
            <li>
              <input type="radio" name="coord_id" value="${c.id}" id="coord_${c.id}">
              <label for="coord_${c.id}" style="display:flex; align-items:center;">
                <img src="${c.avatar}" alt="${c.nom}">
                <div class="affect-coord-info">
                  <div class="name">${c.nom}</div>
                  <div class="details">${c.grade ?? ''}, ${c.institut ?? ''}</div>
                </div>
              </label>
            </li>
          `;
        });
      });
  }
  /*
  function enregistrerAffectation() {
    const selected = document.querySelector('input[name="coord_id"]:checked');
    if (!selected) return alert("Veuillez sélectionner un coordinateur.");
    const coord_id = selected.value;
  
    // Appel POST API (à implémenter)
    alert("Affectation enregistrée.");
    closeAffectationModal();
  }
  
  */
  document.addEventListener('click', function (e) {
    const modal = document.getElementById('modal-affectation-coordinateur');
  
    // Si le modal est ouvert
    if (modal && modal.style.display === 'flex') {
      // Si on clique sur l'overlay (et non à l'intérieur du contenu)
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    }
  });
  
  function setupModalAutoClose(modalId) {
    document.addEventListener('click', function (e) {
      const modal = document.getElementById(modalId);
      if (modal && modal.style.display === 'flex') {
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      }
    });
  }
  
  // Initialiser après DOM ready
  setupModalAutoClose('modal-affectation-coordinateur');


 

 
  

  function toggleMenu(button) {
    const dropdown = button.nextElementSibling;
  
    // Fermer tous les autres menus
    document.querySelectorAll('.action-dropdown').forEach(menu => {
      if (menu !== dropdown) menu.style.display = 'none';
    });
  
    // Toggle le menu cliqué
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }
  
  document.addEventListener("click", function (e) {
    if (!e.target.closest(".action-wrapper")) {
      document.querySelectorAll(".action-dropdown").forEach(menu => {
        menu.style.display = "none";
      });
    }
  });
  


  /*
  // Fonctions à adapter selon votre logique
  function voirDetails(masterId) {
    window.location.href = `/MASTER/fiche-master?id=${masterId}`;
  }
  
  function ajouterSession(masterId) {
    alert(`Ajouter une session pour le master ID: ${masterId}`);
    // ou ouvrir un modal
  }

  */

  
