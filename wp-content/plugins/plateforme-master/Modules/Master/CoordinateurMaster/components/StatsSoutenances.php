<?php
// ==== Données (branche-les à ta BDD si besoin) ====

// Graphe 1 : Rapports
$labelsRapport = ['Rapport Acceptée', 'Rapport Refusée', 'En demande de correction'];
$totalRapport = array_sum([24, 20, 56]); // Total for percentage calculation
$dataRapport = array_map(function($value) use ($totalRapport) {
    return ($totalRapport > 0) ? round(($value / $totalRapport) * 100) : 0;
}, [24, 20, 56]);
$colorsRapport = ['#E3B3B0', '#BF0404', '#A5A481'];

// Graphe 2 : Soutenances
$labelsSout = ['Soutenance refusée', 'Soutenance ajournée', 'Soutenance en attente', 'Soutenance validée'];
$totalSout = array_sum([40, 15, 12, 23]); // Total for percentage calculation
$dataSout = array_map(function($value) use ($totalSout) {
    return ($totalSout > 0) ? round(($value / $totalSout) * 100) : 0;
}, [40, 15, 12, 23]);
$colorsSout = ['#BF0404', '#8A8C70', '#F6D061', '#E3B3B0'];

$iconUrl = esc_url(site_url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/1170616.png'));
?>

<section id="stats-generales">
  <div class="sg-header">
    <div class="sg-title">
      <img src="<?php echo $iconUrl; ?>" alt="" class="sg-icon">
      <span>Statistiques Générales</span>
    </div>
    <button type="button" class="sg-report">
      <i class="fa fa-rotate"></i> Générer un rapport global
    </button>
  </div>

  <hr class="sg-sep">

  <!-- Rectangle contenant select année + 2 graphes -->
  <div class="sg-card">
    <!-- Section année comme avant -->
    <div class="sg-card-head">
      <select class="sg-select" id="sg-year">
        <option selected>2024 - 2025</option>
        <option>2023 - 2024</option>
        <option>2022 - 2023</option>
        <option>2025 - 2026</option>
      </select>
    </div>

    <div class="sg-charts">
      <!-- Graphe Rapports -->
      <div class="sg-chart-row">
        <div class="sg-canvas-wrap">
          <canvas id="chartRapport" width="160" height="160"></canvas>
        </div>
        <div class="sg-legend" id="legendRapport"></div>
      </div>

      <!-- Graphe Soutenances (réduit) -->
      <div class="sg-chart-row">
        <div class="sg-canvas-wrap soutenance-wrap">
          <canvas id="chartSout" width="110" height="110"></canvas>
        </div>
        <div class="sg-legend" id="legendSout"></div>
      </div>
    </div>
  </div>
</section>

<style>
#stats-generales{
  background:#fff; border:1px solid #E8E6DB; border-radius:12px;
  box-shadow:0 6px 24px rgba(0,0,0,.08); padding:14px; height:340px;
  font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif; color:#2A2916;
}

/* Header */
#stats-generales .sg-header{display:flex; align-items:center; justify-content:space-between;}
#stats-generales .sg-title{display:flex; align-items:center; gap:10px; font-weight:700; font-size:20px}
#stats-generales .sg-icon{width:36px; height:36px; object-fit:contain}

/* Bouton rapport global */
#stats-generales .sg-report{
  width:219px; height:35px;
  background:#FFFFFF; border:1px solid #BF0404; border-radius:5px;
  font:normal normal normal 15px/20px Roboto; color:#BF0404; cursor:pointer;
}

/* Séparateur */
#stats-generales .sg-sep{border:0; border-top:1px solid #ECEBE3; margin:12px 0}

/* Rectangle général contenant select + graphes */
#stats-generales .sg-card{
  background:#fff; border-radius:10px; box-shadow:0 0 16px #0000001C;
  padding:12px 16px; height:240px;
}

/* Section année (repris de ton ancien code) */
#stats-generales .sg-card-head{
  display:flex; justify-content:flex-end; margin-bottom:6px;
}
#stats-generales .sg-select{
  height:32px; padding:0 12px; border:1px solid #E6E4D9; border-radius:8px;
  background:#fff; color:#2A2916; font-size:13px;
}

/* Grille charts (2 colonnes) */
#stats-generales .sg-charts{display:grid; grid-template-columns: 1fr 1fr; gap:30px}

/* Graphe + légende */
#stats-generales .sg-chart-row{display:flex; align-items:center; gap:18px}
#stats-generales .sg-canvas-wrap{
  width:160px; min-width:160px; height:160px;
  display:flex; align-items:center; justify-content:center;
}
#stats-generales canvas{width:160px !important; height:160px !important}

/* Légende */
#stats-generales .sg-legend{font-size:14px; line-height:1.6}
#stats-generales .sg-legend .item{display:flex; align-items:center; gap:8px; margin:6px 0}
#stats-generales .sg-legend .dot{width:10px; height:10px; border-radius:50%; display:inline-block}

/* Responsive */
@media(max-width:900px){
  #stats-generales .sg-charts{grid-template-columns:1fr}
  #stats-generales .sg-chart-row{justify-content:center}
}

/* Taille réduite uniquement pour le graphe des soutenances */
#stats-generales .soutenance-wrap{width:130px; min-width:110px; height:130px}
#stats-generales .soutenance-wrap canvas{width:130px !important; height:130px !important}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
(function(){
  const labelsRapport = <?php echo json_encode($labelsRapport); ?>;
  const dataRapport   = <?php echo json_encode($dataRapport); ?>;
  const colorsRapport = <?php echo json_encode($colorsRapport); ?>;

  const labelsSout = <?php echo json_encode($labelsSout); ?>;
  const dataSout   = <?php echo json_encode($dataSout); ?>;
  const colorsSout = <?php echo json_encode($colorsSout); ?>;

  const common = {
    type: 'pie',
    options: {
      responsive: false,
      plugins: {
        legend: { display: false },
        datalabels: {
          color: '#ffffff',
          font: { weight: 'bold', size: 13 },
          formatter: (value, ctx) => {
            const total = ctx.chart.data.datasets[0].data.reduce((acc, val) => acc + val, 0);
            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
            return `${percentage}%`;
          },
          anchor: 'center',
          align: 'center',
          clamp: true
        }
      }
    },
    plugins: [ChartDataLabels]
  };

  // Chart Rapports
  new Chart(document.getElementById('chartRapport').getContext('2d'), {
    ...common,
    data: {
      labels: labelsRapport,
      datasets: [{
        data: dataRapport,
        backgroundColor: colorsRapport,
        borderColor: '#ffffff',
        borderWidth: 8,
        hoverOffset: 6,
        offset: [0, 8, 0]
      }]
    }
  });

  // Légende Rapports
  const legendRap = document.getElementById('legendRapport');
  labelsRapport.forEach((t, i) => {
    const row = document.createElement('div');
    row.className = 'item';
    row.innerHTML = `<span class="dot" style="background:${colorsRapport[i]}"></span>${t}`;
    legendRap.appendChild(row);
  });

  // Chart Soutenances (sans espaces entre parts -> borderWidth:0)
  new Chart(document.getElementById('chartSout').getContext('2d'), {
    ...common,
    data: {
      labels: labelsSout,
      datasets: [{
        data: dataSout,
        backgroundColor: colorsSout,
        borderColor: '#ffffff',
        borderWidth: 0,
        hoverOffset: 6
        
      }]
    }
  });

  // Légende Soutenances
  const legendS = document.getElementById('legendSout');
  labelsSout.forEach((t, i) => {
    const row = document.createElement('div');
    row.className = 'item';
    row.innerHTML = `<span class="dot" style="background:${colorsSout[i]}"></span>${t}`;
    legendS.appendChild(row);
  });
})();
</script>