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
    try {
        const res = await fetch(`${window.PMSettings.restUrl}plateforme-recherche/v1/financement/suivi-projets`, {
            headers: { 'X-WP-Nonce': window.PMSettings.nonce }
        });
        const rows = await res.json();

        const tbody = document.querySelector('#candidaturesTable2 tbody');
        if (!tbody) return;

        // 1. Inject the HTML rows from the API data
        tbody.innerHTML = rows.map(r => `
            <tr>
                <td><input type="checkbox" class="row-checkbox2"></td>
                <td class="left">${r.titre || '-'}</td>
                <td>${r.budget} TND</td>
                <td>${r.depense}</td>
                <td>${r.reste}</td>
                <td>${new Date(r.updated_at).toLocaleDateString('fr-FR')}</td>
                <td><span class="badge ${r.statut === 'Terminé' || r.statut === 'Actif' ? 'badge-success' : 'badge-warning'}"><i class="fa-regular ${r.statut === 'Terminé' || r.statut === 'Actif' ? 'fa-circle-check' : 'fa-clock'}" style="padding-right:5px;"></i>${r.statut}</span></td>
            </tr>
        `).join('');

        // 2. Destroy any old DataTable instance and re-initialize it
        if ($.fn.DataTable.isDataTable('#candidaturesTable2')) {
            $('#candidaturesTable2').DataTable().clear().destroy();
        }

        var table2 = $('#candidaturesTable2').DataTable({
            destroy: true,
            paging: true,
            searching: true,
            ordering: false,
            info: false,
            pageLength: 5,
            dom: 'rt', // Use 'rt' to only show the table and processing, pagination is handled by our component
            language: {
                emptyTable: "Aucune donnée disponible",
                zeroRecords: "Aucun enregistrement correspondant trouvé"
            }
        });

        // 3. Connect the filters to the new 'table2' instance
        $('#searchInput2').off('keyup').on('keyup', function() {
            table2.search(this.value).draw();
        });

        $('#projectSelect').off('change').on('change', function() {
            table2.column(1).search(this.value).draw();
        });

        $('#statusSelect').off('change').on('change', function() {
            // Use regex for an exact match on the status text
            table2.column(6).search(this.value ? '^' + this.value + '$' : '', true, false).draw();
        });
        
        $('#clearFiltersBtn').off('click').on('click', function() {
             $('#searchInput2, #projectSelect, #statusSelect').val('');
             table2.search('').columns().search('').draw();
        });

        // 4. Connect the "Check All" functionality
        $("#checkAll2").off('click').on("click", function () {
            var rows = table2.rows({ 'search': 'applied' }).nodes();
            $('input.row-checkbox2', rows).prop('checked', this.checked);
        });

        $('#candidaturesTable2 tbody').off('change').on('change', 'input.row-checkbox2', function() {
            if (!this.checked) {
                var el = $('#checkAll2').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });

        // 5. Connect your custom pagination component
        if (window.PMOPagination) {
            // Find the pagination block that is inside the same content-block as our table
            const tableContainer = document.querySelector('#candidaturesTable2').closest('.content-block');
            if (tableContainer) {
                const paginationContainer = tableContainer.querySelector('.custom-pagination');
                PMOPagination.init(table2, paginationContainer);
            }
        }

    } catch (e) {
        console.error("Error in loadProjectsTable:", e);
    }
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
