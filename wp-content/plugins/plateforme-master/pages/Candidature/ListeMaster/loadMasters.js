/*document.addEventListener('DOMContentLoaded', function () {
    fetch('get_sessions_masters.php')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          renderMasters(data.data);
        } else {
          document.getElementById('sessions-container').innerHTML = '<p>Erreur lors du chargement des données.</p>';
        }
      })
      .catch(error => {
        console.error('Erreur fetch:', error);
        document.getElementById('sessions-container').innerHTML = '<p>Connexion au serveur échouée.</p>';
      });
  });
  
  function renderMasters(masters) {
    const container = document.getElementById('sessions-container');
    container.innerHTML = '';
  
    masters.forEach(master => {
      const objectifsGeneraux = master.objectifs_generaux.map(o =>
        `<li>${o.contenu}</li>`).join('');
      const objectifsSpecifiques = master.objectifs_specifiques.map(o =>
        `<p>${o.contenu}</p>`).join('');
  
      const html = `
        <div class="accordion">
          <div class="accordion-header" onclick="toggleAccordion(this)">
            <div class="accordion-title">${master.intitule_master}</div>
            <div class="accordion-domain">Domaine : ${master.domaine}</div>
            <div class="accordion-date">Date : ${master.date_session}</div>
          </div>
          <div class="accordion-body">
            <div class="grid-info">
              <div class="info-card">
                <div class="card-header">
                  <h4>Informations détaillées</h4>
                </div>
                <div class="card-content">
                  <p><strong>Code :</strong> ${master.code_interne}</p>
                  <p><strong>Parcours :</strong> ${master.parcours}</p>
                  <p><strong>Nature :</strong> ${master.nature}</p>
                  <p><strong>Mention :</strong> ${master.mention}</p>
                  <p><strong>Début :</strong> ${master.debut_habilitation}</p>
                  <p><strong>Fin :</strong> ${master.fin_habilitation}</p>
                </div>
              </div>
              <div class="info-card">
                <div class="card-header">
                  <h4>Condition d’admission</h4>
                </div>
                <div class="card-content">
                  <p><strong>Diplômes requis :</strong> ${master.diplomes_requis}</p>
                  <p><strong>Procédure :</strong> ${master.procedure_selection}</p>
                  <p><strong>Places :</strong> ${master.nombre_places}</p>
                  <p><strong>Critères :</strong> ${master.criteres_classement}</p>
                  <p><strong>Public visé :</strong> ${master.public_vise}</p>
                  ${master.plan_etude_pdf ? `<a href="${master.plan_etude_pdf}" target="_blank" class="btn-pdf">📄 Télécharger</a>` : ''}
                </div>
              </div>
            </div>
  
            <div class="info-card">
              <div class="card-header">
                <h4>Objectifs pédagogiques</h4>
              </div>
              <div class="card-content">
                <div class="grid-objectifs">
                  <div class="label-col">
                    <p><strong>Objectifs généraux :</strong></p>
                    <p><strong>Objectifs spécifiques :</strong></p>
                  </div>
                  <div class="value-col">
                    <ul>${objectifsGeneraux}</ul>
                    ${objectifsSpecifiques}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      container.innerHTML += html;
    });
  }
  
  // Accordéon toggle
  function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const isVisible = body.style.display === 'block';
    document.querySelectorAll('.accordion-body').forEach(el => el.style.display = 'none');
    body.style.display = isVisible ? 'none' : 'block';
  }
  */


  document.addEventListener('DOMContentLoaded', function () {
    fetch('get_sessions_masters.php')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          renderMasters(data.data);
        } else {
          document.getElementById('sessions-container').innerHTML = '<p>Erreur lors du chargement des données.</p>';
        }
      })
      .catch(error => {
        console.error('Erreur fetch:', error);
        document.getElementById('sessions-container').innerHTML = '<p>Connexion au serveur échouée.</p>';
      });
  });
  
  function renderMasters(masters) {
    const container = document.getElementById('sessions-container');
    container.innerHTML = '';
  
    masters.forEach(master => {
      const objectifsGeneraux = master.objectifs_generaux.map(o =>
        `<li>${o.contenu}</li>`).join('');
      const objectifsSpecifiques = master.objectifs_specifiques.map(o =>
        `<p>${o.contenu}</p>`).join('');
  
      const html = `
        <div class="accordion">
          <div class="accordion-header" onclick="toggleAccordion(this)">
            <div style="display:grid">
              <div class="accordion-title">${safe(master.intitule_master)}</div>
              <div style="display:flex;gap: 170px;margin-top: 10px;">
                <div class="accordion-domain"><span class="subtitle">Domaine :</span> ${safe(master.domaine)}</div>
                <div class="accordion-date"><span class="subtitle">Date :</span> ${safe(master.date_creation)}</div>
              </div>
            </div>
          </div>
          
          <div class="accordion-body">
            <div class="grid-info">
              <div class="info-card">
                <div class="card-header">
                  <h3>Informations détaillées</h3>
                  <img src="../assets/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon">
                </div>
                <div class="grid-details">
                  <div class="card_master label-col">
                    <p><strong>Intitulé du master :</strong></p>
                    <p><strong>Code interne du Master :</strong></p>
                    <p><strong>Parcours :</strong></p>
                    <p><strong>Domaine :</strong></p>
                    <p><strong>Début d’habilitation :</strong></p>
                    <p><strong>Fin d’habilitation :</strong></p>
                    <p><strong>Nature :</strong></p>
                    <p><strong>Mention :</strong></p>
                  </div>
                  <div class="card_master value-col">
                  <p>${safe(master.intitule_master)}</p>
                  <p>${safe(master.code_interne)}</p>
                  <p>${safe(master.parcours)}</p>
                  <p>${safe(master.domaine)}</p>
                  <p>${safe(master.debut_habilitation)}</p>
                  <p>${safe(master.fin_habilitation)}</p>
                  <p>${safe(master.nature_libelle)}</p>
                  <p>${safe(master.mention_libelle)}</p>

                  </div>
                </div>
              </div>
  
              <div class="info-card">
                <div class="card-header">
                  <h3>Condition d’admission</h3>
                  <img src="../assets/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon">
                </div>
                <div class="grid-details2">
                  <div class="card_master label-col">
                    <p><strong>Diplômes requis pour l’admission :</strong></p>
                    <p><strong>Procédure de sélection :</strong></p>
                    <p><strong>Nombre de places disponibles :</strong></p>
                    <p><strong>Critères de classement / admission :</strong></p>
                    <p><strong>Public visé :</strong></p>
                  </div>
                  <div class="card_master value-col">
                  <p>${safe(master.diplomes_requis)}</p>
                  <p>${safe(master.procedure_selection)}</p>
                  <p>${safe(master.nb_places)}</p>
                  <p>${safe(master.criteres_admission)}</p>
                  <p>${safe(master.public_vise)}</p>

                  </div>
                </div>
                ${master.plan_etude_pdf ? `
                  <p>
                    <span>Veuillez trouver ci-joint le PDF des plans d’étude.</span><br>
                    <a href="${master.plan_etude_pdf}" class="btn-pdf" target="_blank">
                      <img src="../assets/pdf-svgrepo-com (2).png" class="icon-pdf2"> <img src="../assets/icondownload.jpeg" class="icon-download"> Télécharger
                    </a>
                  </p>` : ''}
              </div>
            </div>
  
            <div class="info-card objectifs-card">
              <div class="card-header">
                <h4>Objectifs pédagogiques et scientifiques</h4>
                  <img src="../assets/pdf-svgrepo-com (2).png" alt="PDF" class="pdf-icon">
              </div>
              <div class="objectifs-bloc">
              <div class="objectifs-table">
                <div class="objectifs-row">
                  <div class="label">Objectifs généraux du master :</div>
                  <div class="values">
                    <ul>${objectifsGeneraux}</ul>
                  </div>
                </div>
                <div class="objectifs-row">
                  <div class="label">Objectifs spécifiques :</div>
                  <div class="values">
                    ${objectifsSpecifiques}
                  </div>
                </div>
              </div>
                 <!--<button class="subscribe-btn">S’INSCRIRE</button>-->
                 <button class="subscribe-btn" onclick="goToInscription(${master.master_id})">S’INSCRIRE</button>

              </div>
            </div>
  
          </div>
        </div>
      `;
  
      container.innerHTML += html;
    });
  }
  
  
  // Accordéon toggle
  function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const isVisible = body.style.display === 'block';
    document.querySelectorAll('.accordion-body').forEach(el => el.style.display = 'none');
    body.style.display = isVisible ? 'none' : 'block';
  }
  

  function safe(value) {
    return value && value.trim ? value.trim() : '-';
  }


  document.addEventListener('DOMContentLoaded', function () {
    fetch('get_etablissements.php')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          populateEtablissements(data.data);
        } else {
          console.error('Erreur établissement :', data.message);
        }
      })
      .catch(error => {
        console.error('Erreur fetch établissements :', error);
      });
  });
  
  function populateEtablissements(etabs) {
    const select = document.getElementById('etablissement');
    etabs.forEach(etab => {
      const option = document.createElement('option');
      option.value = etab.id;
      option.textContent = etab.nom;
      select.appendChild(option);
    });
  }
  

  document.getElementById('filter-btn').addEventListener('click', function () {
    const institutId = document.getElementById('etablissement').value;
    const annee = document.getElementById('annee').value;
  
    if (!institutId) {
      alert('Veuillez sélectionner un établissement.');
      return;
    }
  
    fetch(`get_sessions_masters.php?institut_id=${institutId}`)
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById('sessions-container');
  
        if (data.status === 'success') {
          if (data.data.length === 0) {
            container.innerHTML = `
              <div class="empty-message">
                <img src="../assets/no-data.svg" alt="Aucun master trouvé" class="empty-image">
                <p>Oups ! Aucun master publié trouvé pour cet établissement.</p>
                <p>Essayez un autre filtre ou revenez plus tard </p>
              </div>
            `;
          } else {
            renderMasters(data.data);
          }
        } else {
          container.innerHTML = '<p>Erreur de chargement des données.</p>';
        }
      })
      .catch(err => {
        console.error(err);
        document.getElementById('sessions-container').innerHTML = '<p>Erreur serveur. Veuillez réessayer plus tard.</p>';
      });
  });
  

  function goToInscription(masterId) {
    if (!masterId) return;
    window.location.href = `../information-general/index.php?master_id=${masterId}`;
  }
  