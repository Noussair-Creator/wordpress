async function loadStats() {
  const res = await fetch(`${window.PMSettings.restUrl}plateforme-recherche/v1/financement/stats`, {
    headers: { 'X-WP-Nonce': window.PMSettings.nonce }
  });
  const data = await res.json();

  document.querySelectorAll('.stat-box .value')[0].textContent = data.budget_total + " TND";
  document.querySelectorAll('.stat-box .value')[1].textContent = data.sources_actives;
}

async function loadSourcesTable() {
  try {
    const res = await fetch(`${window.PMSettings.restUrl}plateforme-recherche/v1/financement/suivi-sources`, {
      headers: { 'X-WP-Nonce': window.PMSettings.nonce }
    });
    const rows = await res.json();

    const tbody = document.querySelector('#candidaturesTable tbody');
    if (!tbody) return;

    // Injecter les lignes
    tbody.innerHTML = rows.map(r => `
      <tr>
        <td><input type="checkbox" class="row-checkbox"></td>
        <td class="left">${r.source_intitule}</td>
        <td class="left">${r.source_type || '-'}</td>
        <td>${r.montant}</td>
        <td>${r.consomme}</td>
        <td>${r.solde}</td>
        <td><span class="badge ${r.statut=='Actif'?'badge-success':'badge-warning'}">${r.statut}</span></td>
        <!--  <td><i class="fas fa-paperclip"></i></td> -->
        <td>
          <div class="actions">
            <button class="action-btn">...</button>
            <div class="dropdown-menu">
              <!-- <a href="#">Télécharger justificatif</a> -->
                    <a href="/financement-fiche-de-financements/?idsource=${r.idsource}">Détail</a>
            </div>
          </div>
        </td>
      </tr>
    `).join('');

    // --- Réinitialiser DataTable après injection ---
    if ($.fn.DataTable.isDataTable('#candidaturesTable')) {
      $('#candidaturesTable').DataTable().clear().destroy();
    }

    var table1 = $('#candidaturesTable').DataTable({
      destroy: true,
      paging: true,
      searching: true,
      ordering: false,
      info: false,
      pageLength: 5,
      dom: 'rt<"bottom"p><"clear">',
      language: {
        paginate: {
          previous: "<i class='fa fa-chevron-left' style='color:red'></i>",
          next: "<i class='fa fa-chevron-right' style='color:red'></i>"
        },
        emptyTable: "Aucune donnée disponible",
        zeroRecords: "Aucun enregistrement correspondant trouvé"
      }
    });

    // Filtres synchronisés
    $('#searchInput').off('keyup').on('keyup', function () {
      table1.search(this.value).draw();
    });

    $('#sourceFilter').off('change').on('change', function () {
      table1.column(1).search(this.value).draw();
    });

    $('#statusFilter').off('change').on('change', function () {
      table1.column(6).search(this.value).draw();
    });

    // Checkbox "Tout cocher"
    $("#checkAll").off('click').on("click", function () {
      var rows = table1.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#candidaturesTable tbody').off('change').on('change', 'input[type="checkbox"]', function () {
      if (!this.checked) {
        var el = $('#checkAll').get(0);
        if (el && el.checked && ('indeterminate' in el)) {
          el.indeterminate = true;
        }
      }
    });

    // Dropdown menu
    $(document).off('click.actionbtn').on('click.actionbtn', '.action-btn', function (event) {
      event.stopPropagation();
      var dropdown = $(this).next('.dropdown-menu');
      $('.dropdown-menu').not(dropdown).removeClass('show');
      dropdown.toggleClass('show');
    });

    $(document).off('click.dropdown').on('click.dropdown', function () {
      $('.dropdown-menu').removeClass('show');
    });

  } catch (e) {
    console.error("Erreur loadSourcesTable:", e);
  }
}




async function loadProjectsTable() {
  const res = await fetch(`${window.PMSettings.restUrl}plateforme-recherche/v1/financement/suivi-projets`, {
    headers: { 'X-WP-Nonce': window.PMSettings.nonce }
  });
  const rows = await res.json();

  const tbody = document.querySelector('#candidaturesTable2 tbody');
  if (!tbody) return;

  tbody.innerHTML = rows.map(r => `
    <tr>
      <td><input type="checkbox"></td>
      <td class="left">${r.titre}</td>
      <td>${r.budget} TND</td>
      <td>${r.depense}</td>
      <td>${r.reste}</td>
      <td>${r.updated_at}</td>
      <td><span class="badge ${r.statut=='Terminé'?'badge-success':'badge-warning'}">${r.statut}</span></td>
      <!--<td><div class="actions"><button class="action-btn">...</button></div></td>-->
    </tr>
  `).join('');
}

async function initPieChart() {
  // --- Initialisation avec valeurs vides ---
  const ctx = document.getElementById('pieChart').getContext('2d');
  window.myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Consommé', 'Reste à engager'],
      datasets: [{
        data: [0, 0], // vide au départ
        backgroundColor: ['#808066', '#dabebe']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        datalabels: {
          color: '#fff',
          font: { weight: 'bold', size: 13 },
          formatter: (value) => value + ' TND'
        }
      }
    },
    plugins: [ChartDataLabels]
  });

  // Créer la légende dynamique
  const labels = ['Consommé', 'Reste à engager'];
  const colors = ['#808066', '#dabebe'];
  const legendContainer = document.getElementById('chartLegend');
  legendContainer.innerHTML = '';
  labels.forEach((label, i) => {
    const item = document.createElement('div');
    item.className = 'legend-item';
    item.innerHTML = `<span class="legend-dot" style="background-color:${colors[i]}"></span>${label}`;
    legendContainer.appendChild(item);
  });

  // Charger les données réelles
  await updatePieChart();
}

async function updatePieChart() {
  try {
    const res = await fetch(`${window.PMSettings.restUrl}plateforme-recherche/v1/financement/suivi-sources`, {
      headers: { 'X-WP-Nonce': window.PMSettings.nonce }
    });
    const rows = await res.json();

    const total = rows.reduce((a, r) => a + Number(r.montant), 0);
    const consomme = rows.reduce((a, r) => a + Number(r.consomme), 0);
    const reste = total - consomme;

    if (window.myChart) {
      myChart.data.datasets[0].data = [consomme, reste];
      myChart.update();
    }
  } catch (e) {
    console.error("Erreur chargement PieChart:", e);
  }
}

// Lancer à l'ouverture de la page
document.addEventListener('DOMContentLoaded', initPieChart);


// 🚀 Fonction globale
async function loadFinancementDashboard() {
  await Promise.all([
    loadStats(),
    loadSourcesTable(),
    loadProjectsTable(),
    updatePieChart()
  ]);
  console.log("✅ Dashboard Financement chargé.");
}

// Charger automatiquement au chargement de la page
document.addEventListener('DOMContentLoaded', loadFinancementDashboard);
