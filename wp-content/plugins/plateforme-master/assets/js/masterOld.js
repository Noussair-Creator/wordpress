
/*fetch(PMSettings.apiUrl, {
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

    let data = await res.json();  // <-- corrigé : let au lieu de const
    console.log('Masters:', data);
    
    // ✅ Filtrer si coordinateur connecté


    console.log(PMSettings.role);
    
    // 🔁 1. Remplissage du CARROUSEL si existant
    const carousel = document.getElementById("carousel");
    const dotsContainer = document.getElementById("carousel-dots");
    
    if (carousel && dotsContainer) {
      let index = 0;
    
      function updateCarousel() {
        carousel.style.transform = `translateX(-${index * 100}%)`;
        [...dotsContainer.children].forEach((dot, i) => {
          dot.classList.toggle("active", i === index);
        });
      }
    
      function renderNatureStats(masters) {
        const natureCounts = {};
        masters.forEach(master => {
          const nature = master.nature ?? 'Non spécifiée';
          natureCounts[nature] = (natureCounts[nature] || 0) + 1;
        });
    
        const infoFlex = document.createElement('div');
        infoFlex.className = 'info-flex';
    
        const infoLine = document.createElement('div');
        infoLine.className = 'info-line';
    
        const infoValue = document.createElement('div');
        infoValue.className = 'info-value';
    
        Object.entries(natureCounts).forEach(([nature, count]) => {
          const label = document.createElement('div');
          label.className = 'label';
          label.textContent = `${nature} :`;
          infoLine.appendChild(label);
    
          const value = document.createElement('div');
          value.className = 'value';
          value.textContent = count;
          infoValue.appendChild(value);
        });
    
        infoFlex.appendChild(infoLine);
        infoFlex.appendChild(infoValue);
        return infoFlex;
      }
    
      // Slide statique

      if (PMSettings.role !== 'um_coordonnateur-master') {

        const staticSlide = document.createElement('div');
        staticSlide.className = 'master-card';
        staticSlide.innerHTML = `
          <h4><a href="/gestion-des-master/">Liste des masters</a></h4>
        `;
        staticSlide.appendChild(renderNatureStats(data));
        carousel.appendChild(staticSlide);
      
        const staticDot = document.createElement("span");
        staticDot.addEventListener("click", () => {
          index = 0;
          updateCarousel();
        });
        dotsContainer.appendChild(staticDot);
      }

      data.forEach((master, i) => {
        const slide = document.createElement('div');
        slide.className = 'master-card';
        slide.innerHTML = `
          <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
          <div class="info-flex">
            <div class="info-line">
              <div class="label">Code Master :</div>
              <div class="label">Libellé du Master :</div>
              <div class="label">Spécialité :</div>
              <div class="label">Date d’habilitation :</div>
              <div class="label">Mention :</div>
            </div>
            <div class="info-value">
              <div class="value">${master.code_interne ?? '-'}</div>
              <div class="value">${master.intitule_master ?? '-'}</div>
              <div class="value">${master.specialite ?? '-'}</div>
              <div class="value">${master.debut_habilitation ?? '-'}</div>
              <div class="value">${master.mention ?? '-'}</div>
            </div>
          </div>
        `;
        carousel.appendChild(slide);
    
        const dot = document.createElement("span");
        dot.addEventListener("click", () => {
          index = i + 1;
          updateCarousel();
        });
        dotsContainer.appendChild(dot);
      });
    
      updateCarousel();
    
      if (carousel.children.length > 1) {
        setInterval(() => {
          index = (index + 1) % carousel.children.length;
          updateCarousel();
        }, 500000);
      }
    }*/
    
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
      
          let data = await res.json();
          console.log('Masters:', data);
      
          const carousel = document.getElementById("carousel");
          const dotsContainer = document.getElementById("carousel-dots");
          if (!carousel || !dotsContainer) return;
      
          let index = 0;
      
          function updateCarousel() {
            carousel.style.transform = `translateX(-${index * 100}%)`;
            [...dotsContainer.children].forEach((dot, i) => {
              dot.classList.toggle("active", i === index);
            });
          }
      
          function renderNatureStats(masters) {
            const natureCounts = {};
            masters.forEach(master => {
              const nature = master.nature ?? 'Non spécifiée';
              natureCounts[nature] = (natureCounts[nature] || 0) + 1;
            });
      
            const infoFlex = document.createElement('div');
            infoFlex.className = 'info-flex';
      
            const infoLine = document.createElement('div');
            infoLine.className = 'info-line';
      
            const infoValue = document.createElement('div');
            infoValue.className = 'info-value';
      
            Object.entries(natureCounts).forEach(([nature, count]) => {
              const label = document.createElement('div');
              label.className = 'label';
              label.textContent = `${nature} :`;
              infoLine.appendChild(label);
      
              const value = document.createElement('div');
              value.className = 'value';
              value.textContent = count;
              infoValue.appendChild(value);
            });
      
            infoFlex.appendChild(infoLine);
            infoFlex.appendChild(infoValue);
            return infoFlex;
          }
      
          // ✅ Si le rôle est coordinateur, ne montrer que SON master
          if (PMSettings.role === 'um_coordonnateur-master') {
            const coordId = PMSettings.userId;
            const master = data.find(m => m.coordinateur?.id === coordId);
            if (!master) return;
      
            const slide = document.createElement('div');
            slide.className = 'master-card';
            slide.innerHTML = `
              <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Code Master :</div>
                  <div class="label">Libellé du Master :</div>
                  <div class="label">Spécialité :</div>
                  <div class="label">Date d’habilitation :</div>
                  <div class="label">Mention :</div>
                </div>
                <div class="info-value">
                  <div class="value">${master.code_interne ?? '-'}</div>
                  <div class="value">${master.intitule_master ?? '-'}</div>
                  <div class="value">${master.specialite ?? '-'}</div>
                  <div class="value">${master.debut_habilitation ?? '-'}</div>
                  <div class="value">${master.mention ?? '-'}</div>
                </div>
              </div>
            `;
            carousel.appendChild(slide);
            updateCarousel();
            return;
          }
      
          // ✅ Sinon : afficher la liste complète avec bloc statique
          const staticSlide = document.createElement('div');
          staticSlide.className = 'master-card';
          staticSlide.innerHTML = `<h4><a href="/gestion-des-master/">Liste des masters</a></h4>`;
          staticSlide.appendChild(renderNatureStats(data));
          carousel.appendChild(staticSlide);
      
          const staticDot = document.createElement("span");
          staticDot.addEventListener("click", () => {
            index = 0;
            updateCarousel();
          });
          dotsContainer.appendChild(staticDot);
      
          data.forEach((master, i) => {
            const slide = document.createElement('div');
            slide.className = 'master-card';
            slide.innerHTML = `
              <h4><a href="/MASTER/fiche-master?id=${master.id}">${master.intitule_master}</a></h4>
              <div class="info-flex">
                <div class="info-line">
                  <div class="label">Code Master :</div>
                  <div class="label">Libellé du Master :</div>
                  <div class="label">Spécialité :</div>
                  <div class="label">Date d’habilitation :</div>
                  <div class="label">Mention :</div>
                </div>
                <div class="info-value">
                  <div class="value">${master.code_interne ?? '-'}</div>
                  <div class="value">${master.intitule_master ?? '-'}</div>
                  <div class="value">${master.specialite ?? '-'}</div>
                  <div class="value">${master.debut_habilitation ?? '-'}</div>
                  <div class="value">${master.mention ?? '-'}</div>
                </div>
              </div>
            `;
            carousel.appendChild(slide);
      
            const dot = document.createElement("span");
            dot.addEventListener("click", () => {
              index = i + 1;
              updateCarousel();
            });
            dotsContainer.appendChild(dot);
          });
      
          updateCarousel();
      
          if (carousel.children.length > 1) {
            setInterval(() => {
              index = (index + 1) % carousel.children.length;
              updateCarousel();
            }, 500000);
          }
      

    
    // 🔁 2. Remplissage de la TABLE si existante
    const tbody = document.getElementById("mastersTbody");
    const table = document.getElementById("mastersTable");
    
    if (tbody && table) {
      // Supprimer l’ancien DataTable s’il existe
      if ($.fn.DataTable.isDataTable(table)) {
        $(table).DataTable().destroy();
      }
    
      tbody.innerHTML = ''; // Reset
    
      data.forEach(master => {
        const row = document.createElement('tr');
    
        // ➕ Bloc coordinateur dynamique
        let coordCellContent;

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
          <td>${master.intitule_master ?? '-'}</td>
          <td>${master.parcours ?? '-'}</td>
          <td>
            ${master.plan_etude_pdf ? 
              `<a href="${master.plan_etude_pdf}" target="_blank">
                <img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" class="pdf-icon" alt="PDF">
              </a>` : '-'}
          </td>
          <td>${master.debut_habilitation ?? '-'}</td>
          <td>${coordCellContent}</td>
          <td>
            <div class="action-wrapper">
              <button class="action-menu" onclick="toggleMenu(this)">•••</button>
              <div class="action-dropdown" style="display: none;">
                <button onclick="voirDetails(${master.id})">👁 Voir détails</button>
                <button onclick="ajouterSession(${master.id})">➕ Ajouter session</button>
              </div>
            </div>
          </td>
        `;

        tbody.appendChild(row);
      });
      
      
      // ✅ Initialiser DataTable APRÈS remplissage
      $(table).DataTable({
        paging: true,
        searching: false,
        info: false,
        ordering: true,
        pageLength: 5,
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [{
          extend: 'colvis',
          text: 'Afficher/Masquer Colonnes',
          className: 'custom-colvis-btn'
        }],
        language: {
          paginate: {
            previous: "«",
            next: "»"
          }
        }
      });
    }
    
    
  })
  .catch(err => console.error("Erreur API:", err));


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


 

  function rafraichirCarrouselMasters() {
   // 🔁 2. Remplissage de la TABLE si existante
   const tbody = document.getElementById("mastersTbody");
   const table = document.getElementById("mastersTable");
   
   if (tbody && table) {
     // Supprimer l’ancien DataTable s’il existe
     if ($.fn.DataTable.isDataTable(table)) {
       $(table).DataTable().destroy();
     }
   
     tbody.innerHTML = ''; // Reset
   
     data.forEach(master => {
       const row = document.createElement('tr');
   
       // ➕ Bloc coordinateur dynamique
       let coordCellContent;

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
         <td>${master.intitule_master ?? '-'}</td>
         <td>${master.parcours ?? '-'}</td>
         <td>
           ${master.plan_etude_pdf ? 
             `<a href="${master.plan_etude_pdf}" target="_blank">
               <img src="/imagesMaster/servicemasterImages/pdf-svgrepo-com (2).png" class="pdf-icon" alt="PDF">
             </a>` : '-'}
         </td>
         <td>${master.debut_habilitation ?? '-'}</td>
         <td>${coordCellContent}</td>
         <td><button class="action-menu">•••</button></td>
       `;
       tbody.appendChild(row);
     });
   
     // ✅ Initialiser DataTable APRÈS remplissage
     $(table).DataTable({
       paging: true,
       searching: false,
       info: false,
       ordering: true,
       pageLength: 5,
       lengthChange: false,
       dom: 'Bfrtip',
       buttons: [{
         extend: 'colvis',
         text: 'Afficher/Masquer Colonnes',
         className: 'custom-colvis-btn'
       }],
       language: {
         paginate: {
           previous: "«",
           next: "»"
         }
       }
     });
   }
  }
  

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
  
  // Fonctions à adapter selon votre logique
  function voirDetails(masterId) {
    window.location.href = `/MASTER/fiche-master?id=${masterId}`;
  }
  
  function ajouterSession(masterId) {
    alert(`Ajouter une session pour le master ID: ${masterId}`);
    // ou ouvrir un modal
  }

  
  