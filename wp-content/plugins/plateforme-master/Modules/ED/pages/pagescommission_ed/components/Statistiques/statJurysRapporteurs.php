<div class="statistiques-wrapper">
  <div class="header-bar">
    <h2>
      <img src="/imagesMaster/servicemasterImages/1170616.png" alt="Icon" style="width:36px;margin-right:10px;vertical-align:middle;">
      Statistiques Générales
    </h2>
    <button class="btn-report"><i class="fa fa-rotate" style="margin-right:6px;"></i> Générer un rapport global</button>
  </div>

  <hr class="section-divider">

  <div class="stats-grid">
    <!-- GAUCHE : Cartes KPI -->
    <div class="left-stats">
      <div class="stat-box">
        <div class="stat-left">
          <span class="label">Jurys constitués<br>ce semestre</span>
        </div>
        <span class="value">42</span>
      </div>

      <div class="stat-box">
        <div class="stat-left">
          <span class="label">Rapporteurs actifs</span>
        </div>
        <span class="value">6</span>
      </div>
    </div>

    <!-- DROITE : Graphe + légende -->
    <div class="right-graph">
      <div class="graph-header">
        <h4>Vue globale</h4>
        <select class="graph-select">
          <option>2024 - 2025</option>
        </select>
      </div>

      <div class="blocChart">
        <div class="canvas-container">
          <canvas id="pieChart"></canvas>
        </div>
        <div class="legend" id="chartLegend"></div>
      </div>
    </div>
  </div>
</div>

<style>
  .statistiques-wrapper {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 0 8px rgba(0,0,0,0.05);
  padding: 20px;
  display: flex;
  flex-direction: column;
  margin-bottom: 20px; 
}

.header-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-row h2 {
  font-size: 18px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.btn-report {
  border: 1px solid #c60000;
  color: #c60000;
  background: #fff;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 500;
}

.stats-grid {
  display: flex;
  align-items: stretch;
  gap: 20px;
}

.left-stats {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.stat-box {
    background: #f8f9fa;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border-radius: 10px;
    border-left: 0px;
    padding-left: 0px;
    display: flex;
    box-shadow: 0px 0px 16px #0000001C;
        box-shadow: 0px 0px 16px #0000001C;
}
.stat-box .label {
    font-weight: 700;
    font-size: 19px;
    width: 229px;    /* height: 40px; */
    text-align: left;
    /* font: normal normal bold 15px / 20px Roboto; */
    letter-spacing: 0px;
    color: #2A2916;
}
.stat-box .value {
  background: #f1f1f1;
  border-radius: 6px;
  padding: 4px 10px;
  font-weight: bold;
  font-size: 18px;
}

.right-graph {
  flex: 1;
  background: #fdfdfd;
  border-radius: 10px;
  padding: 20px;
  position: relative;
}

.graph-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.graph-select {
  padding: 5px 10px;
  border-radius: 6px;
  font-size: 14px;
  border: 1px solid #ccc;
}

.legend {
  margin-top: 20px;
  font-size: 14px;
}

.legend span {
  display: flex;
  margin-top: 6px;
}

.dot {
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 6px;
}

.dot-green { background: #808066; }
.dot-red { background: #b1342f; }
.dot-beige { background: #dabebe; }
.canvas-container {
  width: 180px;
  height: 180px;
}

#pieChart {
  width: 180px !important;
  height: 180px !important;
}
.stats-grid {
  display: flex;
  gap: 20px;
  align-items: flex-start;
  justify-content: space-between;
}

.left-stats,
.right-graph {
  flex: 1;
  box-sizing: border-box;
}

.stat-box {
  background: #f8f9fa;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 16px #0000001C;
    border-radius: 10px;
    border-left: 0px;
    padding-left: 0px;
}
span.label {
    border-left: 4px solid #c60000;
    border-radius: 0px;
    padding-left: 22px;
}
.label {
  display: block;
  font-size: 14px;
  color: #555;
}

.value {
  font-size: 28px;
  font-weight: bold;
  color: #333;
  margin-top: 5px;
}

.graph-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.graph-select {
  padding: 5px 10px;
}

.canvas-container {
  width: 100%;
  max-width: 240px;
  margin: 0 auto;
  margin-bottom:0px
}

.legend {
  margin-top: 15px;
  font-size: 14px;
}

.legend .dot {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin-right: 6px;
  border-radius: 50%;
}

.dot-green { background-color: #4CAF50; }
.dot-red { background-color: #F44336; }
.dot-beige { background-color: #FFC107; }
.stats-grid {
  display: flex;
  gap: 20px;
  align-items: flex-start;
}

.left-stats {
  flex: 1; /* équivalent à 1/3 si l'autre est 2 */
  box-sizing: border-box;
}

.right-graph {
  flex: 2; /* équivalent à 2/3 */
  box-sizing: border-box;
}
.stat-box {
    display: flex
;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    padding: 36px 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0px 0px 16px #0000001C;
        padding-left: 0px;
    background-color: #fff;
}


.stat-box .value {
    background: #ECEBE3;
    border-radius: 6px;
    padding: 9px 8px;
    font-weight: bold;
    font-size: 21px;
    width: 67px;
    text-align: center;
}
.right-graph {
  padding: 20px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0px 0px 16px #0000001C;
}

.graph-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.graph-header h4 {
  font-size: 18px;
  margin: 0;
}

.graph-select {
  padding: 5px 10px;
  font-size: 14px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

.canvas-container {
  width: 100%;
  max-width: 180px;
  margin: 0 auto 20px;
  margin-bottom:0px
  flex:1

}

#pieChart {
  width: 100% !important;
  height: auto !important;
}

.legend {
  display: inline;
  justify-content: space-around;
  font-size: 14px;
  color: #444;
}

.legend .dot {
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 6px;
  vertical-align: middle;
}

.dot-green { background-color: #808066; }
.dot-red { background-color: #b1342f }
.dot-beige { background-color: #dabebe; }
.legend {
  display: inline;
  justify-content: space-around;
  font-size: 14px;
  color: #444;
  margin-top: 10px;
  flex:1;
      padding-top: 20px;

}

.legend-item {
  display: flex;
  align-items: center;
}

.legend-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 6px;
}
.blocChart {
    display: flex;
    width: max-content;
    margin: 0 auto;
    gap: 25px;
}
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
   const labels = [
    'Dossiers Partiellement Financés',
    'Dossiers Sans Justificatif De Financement',
    'Dossiers non conformes (assurance, etc.)'
  ];
  const dataValues = [66, 24, 10];
  const colors = ['#808066', '#b1342f', '#dabebe'];

  const ctx = document.getElementById('pieChart').getContext('2d');
  new Chart(ctx,{
    type:'pie',
    data:{ labels, datasets:[{ data:dataValues, backgroundColor:colors }]},
    options:{
      responsive:true,
      plugins:{
        legend:{ display:false },
        datalabels:{
          color:'#fff',
          font:{ weight:'bold', size:12 },
          formatter:(v)=> v+'%'
        }
      }
    },
    plugins:[ChartDataLabels]
  });

  // Légende custom
  const legendContainer = document.getElementById('chartLegend');
  legendContainer.innerHTML = '';
  labels.forEach((label, i)=>{
    const item = document.createElement('div');
    item.className = 'legend-item';
    const dot = document.createElement('span');
    dot.className = 'legend-dot';
    dot.style.backgroundColor = colors[i];
    item.appendChild(dot);
    item.appendChild(document.createTextNode(label));
    legendContainer.appendChild(item);
  });
</script>





