<style>
  .stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(460px, 1fr));
  gap: 20px;
  margin: 30px 0;
}

.card-stats {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  position: relative;
}

.card-stats .header {
  font-weight: 700;
  font-size: 20px;
  color: #2A2916;
  margin-bottom: 20px;
}

.chart-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.chart-pie,
.chart-donut,
.chart-bar {
  position: relative;
}

.chart-pie canvas,
.chart-donut canvas {
      width: 120px !important;
    height: 120px !important;
}

.chart-pie.large canvas {
  width: 220px !important;
  height: 220px !important;
}

.chart-bar canvas {
  width: 100% !important;
  height: 300px !important;
}

.chart-label {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-weight: bold;
  font-size: 18px;
  color: #2A2916;
}
.bl-stat {
    gap: 20px;
    display: grid;
}
</style>

<div class="stats-grid">
  <!-- Financements -->
  <div class="card-stats">
    <div class="header">Financements</div>
    <div class="chart-row">
      <div class="chart-pie large">
        <canvas id="mainFinancementChart"></canvas>
      </div>
      <div class="chart-pie"><canvas id="donut1"></canvas></div>
      <div class="bl-stat">
          <div class="chart-donut"><canvas id="donut2"></canvas></div>
          <div class="chart-donut"><canvas id="donut3"></canvas></div>
      </div>
    

    </div>
  </div>

  <!-- Avancement -->
  <div class="card-stats">
    <div class="header">État d’avancement des projets <span style="float:right; color:#333; font-weight:700;">63%</span></div>
    <div class="chart-bar">
      <canvas id="etatProjetsChart"></canvas>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
  // Simulations des données
  const financementData = [60]; // 60% financé
  const donutData1 = [15, 85];
  const donutData2 = [1, 2, 3, 4];
  const donutData3 = [3, 2, 1, 4];
  const projetsData = [60, 25, 0, 100];

  // ✅ Camembert principal (converti en PIE)
  new Chart(document.getElementById('mainFinancementChart'), {
    type: 'pie',
    data: {
      labels: ['Financé', 'Restant'],
      datasets: [{
        data: [financementData[0], 100 - financementData[0]],
        backgroundColor: ['#bc0503', '#e5e7eb'],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => `${ctx.label} : ${ctx.raw}%`
          }
        },
        datalabels: {
          color: ctx => ctx.dataIndex === 0 ? '#ffffff' : '#000000',
          font: {
            size: 16,
            weight: 'bold'
          },
          formatter: value => value + '%'
        }
      }
    },
    plugins: [ChartDataLabels]
  });

  // ✅ Donuts secondaires (restent en doughnut)
  const donutConfigs = [
    { id: 'donut2', data: donutData2, colors: ['#ddaca7', '#ffd54f', '#6e6d55', '#a6a485'] },
    { id: 'donut3', data: donutData3, colors: ['#ffaa00', '#ffd54f', '#bf0404', '#cb9042'] }
  ];

  donutConfigs.forEach(cfg => {
    new Chart(document.getElementById(cfg.id), {
      type: 'doughnut',
      data: {
        datasets: [{
          data: cfg.data,
          backgroundColor: cfg.colors,
          borderWidth: 0
        }]
      },
      options: {
        cutout: '70%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: false }
        }
      }
    });
  });

  // ✅ donut1 => camembert type "pie" AVEC datalabels comme le principal
new Chart(document.getElementById('donut1'), {
  type: 'pie',
  data: {
    labels: ['Part 1', 'Part 2'],
    datasets: [{
      data: [15, 85], // exemple
      backgroundColor: ['#B00000', '#ECEBE3'],
      borderColor: '#fff',
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.label} : ${ctx.raw}%`
        }
      },
      datalabels: {
        color: ctx => ctx.dataIndex === 0 ? '#ffffff' : '#000000',
        font: {
          size: 14,
          weight: 'bold'
        },
        formatter: value => value + '%'
      }
    }
  },
  plugins: [ChartDataLabels]
});


  // ✅ Barres d’avancement
  const ctxBar = document.getElementById('etatProjetsChart').getContext('2d');
  new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: ['Projet 1', 'Projet 2', 'Projet 3', 'Projet 4'],
      datasets: [{
        label: 'Avancement',
        data: projetsData,
        backgroundColor: '#B00000',
        borderRadius: 4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            stepSize: 25,
            callback: val => val + '%'
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => `${ctx.dataset.label} : ${ctx.raw}%`
          }
        },
        datalabels: {
          anchor: 'end',
          align: 'end',
          color: '#000',
          font: {
            size: 14,
            weight: 'bold'
          },
          formatter: val => val + '%'
        }
      }
    },
    plugins: [ChartDataLabels]
  });
</script>

