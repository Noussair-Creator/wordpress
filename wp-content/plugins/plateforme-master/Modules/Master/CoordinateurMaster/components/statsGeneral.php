<?php
// Données d'exemple — branche-les au besoin depuis la BDD
$totalCandidatures = 1287;
$totalEncadrants   = 600;

// (si besoin) URL d'icône
$iconUrl = esc_url( site_url('/imagesMaster/servicemasterImages/1170616.png') );

// Données du graphe (libellés + couleurs comme la maquette)
$labels     = ['Reclamation Acceptée', 'Reclamation Refusée', 'Reclamation En cours de traitement'];
$dataValues = [24, 20, 56]; // en %
$colors     = ['#e3b3b0', '#BF0404', '#a5a481'];
?>
<div class="statistiques-wrapper">
  <div class="header-bar">
    <h2>
      <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/1170616.png" 
           alt="Icon" style="width:40px;margin-right:8px;vertical-align:middle;">
      Statistiques Générales
    </h2>
    <button class="btn-report"><i class="fa fa-sync-alt"></i> Générer un rapport global</button>
  </div>

  <hr class="section-divider">

  <div class="stats-grid">
    <!-- Cartouches à gauche -->
    <div class="left-stats">
      <div class="stat-box stripe-red">
        <span class="label">Total des <br>Réclamations</span>
        <span class="value" id="totalcandidatures"><?php echo (int)$totalCandidatures; ?></span>
      </div>
      <div class="stat-box stripe-red">
        <span class="label">Réclamations<br>traitées</span>
        <span class="value"><?php echo (int)$totalEncadrants; ?></span>
      </div>
    </div>

    <!-- Graphe à droite -->
    <div class="right-graph">
      <div class="graph-header">
        <select class="graph-select">
          <option>2024 - 2025</option>
        </select>
      </div>

      <div class="chart-row">
        <div class="canvas-wrap">
          <canvas id="pieChart" width="150" height="150"></canvas>
        </div>

        <div class="legend" id="chartLegend"></div>
      </div>
    </div>
  </div>
</div>

<style>
/* Conteneur global */
.statistiques-wrapper{
  background:#fff;
  border-radius:12px;
  box-shadow:0 0 8px rgba(0,0,0,.05);
  padding:20px;
  display:flex;
  flex-direction:column;
  margin-bottom:20px
}
.header-bar{display:flex;justify-content:space-between;align-items:center}
.header-bar h2{
  font-size:18px;
  font-weight:700;
  display:flex;
  align-items:center;
  gap:10px;
  margin:0
}
.btn-report{
  border:1px solid #c60000;
  color:#c60000;
  background:#fff;
  padding:6px 14px;
  border-radius:6px;
  font-size:14px;
  cursor:pointer;
  display:flex;
  align-items:center;
  gap:6px;
  font-weight:600
}

/* Grid */
.stats-grid{display:flex;gap:20px;align-items:flex-start}

/* Cartouches gauche */
.left-stats{flex:1;display:flex;flex-direction:column;gap:15px}
.stat-box{
  position:relative;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:20px 20px 20px 28px; /* espace pour bande rouge */
  border-radius:10px;
  box-shadow:0 0 16px #0000001C;
  background:#fff;
  overflow:hidden;
  margin-right: 40px;
height: 90px;
}
.stat-box::before{
  content:"";
  position:absolute;
  left:0;
  top:16px;
  width:4px;
  height:45px;
  border-radius:0 10px 10px 0;
  background:#BF0404; /* bande rouge */
}
.stat-box .label{
  font-weight:700;
  font-size:15px;
  color:#2A2916;
}
.stat-box .value{
  background:#ECEBE3;
  border-radius:6px;
  padding:5px 10px;
  font-weight:700;
  font-size:17px;
  min-width:55px;
  text-align:center;
}

/* Bloc graphe */
.right-graph{
  flex:2;
  background:#fff;
  border-radius:10px;
  box-shadow:0 0 16px #0000001C;
  padding:6px;
  margin-left: -20px;
}
.graph-header{display:flex;justify-content:flex-end;align-items:center;margin-bottom:4px}
.graph-select{
  border:1px solid #e6e4d9;
  border-radius:6px;
  padding:6px 10px;
  font-size:13px;
  background:#fff;
  color:#32312a
}

.chart-row{display:flex;align-items:center;gap:22px;}
.canvas-wrap{width:150px;min-width:150px;display:flex;align-items:center;justify-content:center;}
#pieChart{width:150px!important;height:150px!important; transform: translateY(-20px);}

/* Légende */
.legend{font-size:13px;color:#2c2b22;line-height:1.5; transform: translateY(-20px);}
.legend-item{display:flex;align-items:center;margin:6px 0}
.legend-dot{width:10px;height:10px;border-radius:50%;display:inline-block;margin-right:8px}

/* séparateur */
.section-divider{border:none;border-top:1px solid #e9e7df;margin:12px 0 18px}
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
(function(){
  const labels = <?php echo json_encode($labels); ?>;
  const data   = <?php echo json_encode($dataValues); ?>;
  const colors = <?php echo json_encode($colors); ?>;

  const el = document.getElementById('pieChart');
  if(!el) return;

  new Chart(el.getContext('2d'), {
    type: 'pie',
    data: {
      labels,
      datasets: [{
        data,
        backgroundColor: colors,
        borderColor: '#ffffff',
        borderWidth: 8,
        hoverOffset: 6,
        offset: [0, 12, 0]
      }]
    },
    options: {
      responsive: false,
      plugins: {
        legend: { display: false },
        datalabels: {
          color: '#ffffff',
          font: { weight: 'bold', size: 12 },
          formatter: (v) => v + '%',
          anchor: 'center',
          align: 'center',
          clamp: true
        }
      }
    },
    plugins: [ChartDataLabels]
  });

  // Légende HTML
  const legend = document.getElementById('chartLegend');
  labels.forEach((t, i) => {
    const item = document.createElement('div');
    item.className = 'legend-item';
    item.innerHTML = `<span class="legend-dot" style="background:${colors[i]}"></span>${t}`;
    legend.appendChild(item);
  });
})();
</script>