<!-- ✅ STATS SECTION -->
<style>
.stats {
  border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin-top: 20px;
    display: grid
;
}
.stats-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 12px 16px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}
.stats-header h3 {
  font-size: 18px;
  color: #1f2937;
  margin: 0;
  font-weight: 700;
}
.stats-arrow {
    display: flex
;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 14px;
    text-decoration: none;
    color: #9a997b;
    font-weight: 700;
}
.stats-arrow img {
    width: 16px;
    height: 16px;
}
.stats-body {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.stat-box {
  background: #fff;
  text-align: center;
  padding: 12px;
  border-radius: 12px;
  flex: 1 1 300px;
}
.stat-box h4 {
  margin-top: 12px;
  font-size: 15px;
  color: #222;
}
.pie-custom-wrapper {
  position: relative;
  width: 220px;
  margin: 0 auto;
}
.pie-custom-wrapper canvas {
  border-radius: 50%;
  border: 2px solid #9ca3af;
}
.label-graphe {
  position: absolute;
  left: -110px;
  top: 70px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  color: #1f1f1f;
}
.label-line {
  width: 50px;
  height: 1px;
  background: #1f1f1f;
  transform: rotate(-30deg);
  transform-origin: left;
}
</style>

<!-- ✅ HTML -->
<div class="stats">
  <div class="stats-header">
    <h3>Statistiques académiques</h3>
    <a href="#" class="stats-arrow" title="Voir plus">
      Voir plus
      <img src="/imagesMaster/27) Icon-arrow-right.png" alt="→">
    </a>
  </div>

  <div class="stats-body">
    <!-- Graphique ligne -->
    <div class="stat-box">
      <div class="stats-container">
        <canvas id="lineSuccessChart" height="230"></canvas>
        <h4 style="margin-top: 11px;">Taux de réussite / d'abondon (M1/M2)</h4>
      </div>
    </div>

    <!-- Graphique barres -->
    <div class="stat-box">
      <canvas id="academicChart" height="230"></canvas>
      <h4>Répartion des notes par modules</h4>
    </div>

    <!-- Graphique camembert -->
    <div class="stat-box">
      <div class="pie-custom-wrapper" style="margin-top: 30px;">
        <canvas id="diplomePieChart" width="220" height="230"></canvas>
        <div class="label-graphe">
          <span>Étudiants diplômés</span>
          <div class="label-line"></div>
        </div>
      </div>
      <h4 style="margin-top: 14px;">Soutenance dans les délais</h4>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
  // ✅ Graphique ligne
  const ctxLine = document.getElementById('lineSuccessChart').getContext('2d');
  new Chart(ctxLine, {
    type: 'line',
    data: {
      labels: ['2020', '2021', '2022', '2023', '2024'],
      datasets: [
        {
          label: 'Taux de réussite',
          data: [65, 70, 75, 80, 85],
          borderColor: '#10b981',
          backgroundColor: 'transparent',
          tension: 0.4,
          pointRadius: 3
        },
        {
          label: 'Taux d’abandon',
          data: [25, 20, 18, 16, 12],
          borderColor: '#ef4444',
          backgroundColor: 'transparent',
          tension: 0.4,
          pointRadius: 3
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: { callback: value => value + '%' }
        },
        x: {
          grid: { display: false }
        }
      }
    }
  });

  // ✅ Graphique barres avec gradient
  const ctxBar = document.getElementById('academicChart').getContext('2d');
  const gradient = ctxBar.createLinearGradient(0, 0, 0, 400);
  gradient.addColorStop(0, '#b60303');
  gradient.addColorStop(1, '#6c0202');

  new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: ['2022', '2023', '2024'],
      datasets: [{
        label: 'Taux de réussite (%)',
        data: [80, 40, 90],
        backgroundColor: gradient,
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: { callback: value => value + '%' }
        }
      }
    }
  });

  // ✅ Graphique camembert
  const ctxPie = document.getElementById('diplomePieChart').getContext('2d');
  new Chart(ctxPie, {
    type: 'pie',
    data: {
      labels: ['Diplômés dans les délais', 'Hors délais'],
      datasets: [{
        data: [25, 75],
        backgroundColor: ['#e5e7eb', '#bc0503'],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: false,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => `${ctx.label} : ${ctx.raw}%`
          }
        },
        datalabels: {
          color: function(context) {
            const label = context.chart.data.labels[context.dataIndex];
            return label === 'Diplômés dans les délais' ? '#000000' : '#ffffff';
          },
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
</script>

