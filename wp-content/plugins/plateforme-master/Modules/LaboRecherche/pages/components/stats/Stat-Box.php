<!-- ======= Chart.js ======= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<style>
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(460px, 1fr));
    gap: 20px;
    margin: 30px 0;
    width: 100%;
  }
  .card-stats {
    background: #fff; border-radius: 12px; padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,.06); position: relative;
  }
  .card-stats .header {
    font-weight: 700; font-size: 20px; color:#2A2916; margin-bottom: 20px;
  }
  .chart-row { display:flex; align-items:center; justify-content:space-between; gap:10px; }
  .chart-pie, .chart-donut, .chart-bar { position:relative; }
  .chart-pie canvas, .chart-donut canvas { width:120px!important; height:120px!important; }
  .chart-pie.large canvas { width:220px!important; height:220px!important; }
  .chart-bar canvas { width:100%!important; height:300px!important; }
  .chart-label {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    font-weight:bold; font-size:18px; color:#2A2916;
  }
  .bl-stat { gap:20px; display:grid; }
</style>

<div class="stats-grid">
  <!-- ===== Financements (existant / statique) ===== -->
  <div class="card-stats" style="margin-right:11px;">
    <div class="header">Financements</div>
    <div class="chart-row">
      <div class="chart-pie large"><canvas id="mainFinancementChart"></canvas></div>
      <div class="chart-pie"><canvas id="donut1"></canvas></div>
      <div class="bl-stat">
        <div class="chart-donut"><canvas id="donut2"></canvas></div>
        <div class="chart-donut"><canvas id="donut3"></canvas></div>
      </div>
    </div>
  </div>

  <!-- ===== Répartition par type des publications (DYNAMIQUE) ===== -->
  <div class="card-stats" style="margin-left:-11px;">
    <div class="header">
      Répartition par type des publications
      <span id="pubTypePct" style="float:right; color:#333; font-weight:700;">—</span>
    </div>
    <div class="chart-bar">
      <canvas id="etatProjetsChart"></canvas>
    </div>
  </div>
</div>
<?php if ( is_user_logged_in() ) : ?>
  <script>
    window.pmsettings = {
      rest_root: <?php echo json_encode( esc_url_raw( rest_url() ) ); ?>,
      nonce:     <?php echo json_encode( wp_create_nonce( 'wp_rest' ) ); ?>
    };
  </script>
<?php else: ?>
  <p>Vous devez être connecté pour voir les statistiques.</p>
<?php endif; ?>

<script>
/* ===================== Charts “Financements” (exemple statique) ===================== */
const financementData = [60]; // 60% funded
const donutData1 = [15, 85];
const donutData2 = [1, 2, 3, 4];
const donutData3 = [3, 2, 1, 4];

// Main pie chart
new Chart(document.getElementById('mainFinancementChart'), {
  type: 'pie',
  data: {
    labels: ['Financé','Restant'],
    datasets: [{
      data: [financementData[0], 100 - financementData[0]],
      backgroundColor: ['#bc0503','#e5e7eb'], borderColor:'#fff', borderWidth:2
    }]
  },
  options: {
    responsive:true,
    plugins:{
      legend:{ display:false },
      tooltip:{ callbacks:{ label: ctx => `${ctx.label} : ${ctx.raw}%` } },
      datalabels:{
        color: ctx => ctx.dataIndex===0 ? '#fff' : '#000',
        font:{ size:16, weight:'bold' },
        formatter: v => v + '%'
      }
    }
  },
  plugins:[ChartDataLabels]
});

// Small charts
[{id:'donut2',data:donutData2,colors:['#ddaca7','#ffd54f','#6e6d55','#a6a485']},
 {id:'donut3',data:donutData3,colors:['#ffaa00','#ffd54f','#bf0404','#cb9042']}]
.forEach(cfg=>{
  new Chart(document.getElementById(cfg.id),{
    type:'doughnut',
    data:{ datasets:[{ data:cfg.data, backgroundColor:cfg.colors, borderWidth:0 }] },
    options:{ cutout:'70%', plugins:{ legend:{display:false}, tooltip:{enabled:false} } }
  });
});

// donut1 simple pie
new Chart(document.getElementById('donut1'), {
  type:'pie',
  data:{
    labels:['Part 1','Part 2'],
    datasets:[{ data:donutData1, backgroundColor:['#B00000','#ECEBE3'], borderColor:'#fff', borderWidth:2 }]
  },
  options:{
    responsive:true,
    plugins:{
      legend:{display:false},
      tooltip:{ callbacks:{ label: ctx => `${ctx.label} : ${ctx.raw}%` } },
      datalabels:{ color: ctx=>ctx.dataIndex===0?'#fff':'#000', font:{size:14,weight:'bold'}, formatter:v=>v+'%' }
    }
  },
  plugins:[ChartDataLabels]
});

/* ===================== Répartition par type des publications (DYNAMIQUE) ===================== */
// REST config (pmsettings → wpApiSettings → fallback)
const REST_ROOT =
  (window.pmsettings && pmsettings.rest_root) ||
  (window.wpApiSettings && wpApiSettings.root) ||
  '/wp-json/';
const NONCE =
  (window.pmsettings && pmsettings.nonce) ||
  (window.wpApiSettings && wpApiSettings.nonce) ||
  '';
const API_BASE = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

function normStatut(s){
  const v = (s||'').toLowerCase().trim();
  if (v.startsWith('valid')) return 'Validée';
  if (v.startsWith('rej'))   return 'Rejetée';
  return 'En attente';
}

async function fetchTypeDistribution(){
  async function fetchJSON(url){
    const r = await fetch(url, {
      headers: { 'X-WP-Nonce': NONCE, 'Accept':'application/json' },
      credentials: 'same-origin'
    });
    let data = null;
    try { data = await r.json(); } catch(_) {}
    if (!r.ok) {
      console.warn('Publication API error', r.status, data);
      return [];
    }
    return Array.isArray(data) ? data : [];
  }

  // 1) Essaye with_auteur=1 (suivi des labos)
  let rows = await fetchJSON(`${API_BASE}/publication?with_auteur=1`);

  // 2) Si vide (souvent le cas pour un chercheur), bascule sur “mes publications”
  if (!rows.length) {
    console.info('[stats] Fallback sur /publication?me=1 (aucune ligne avec with_auteur=1)');
    rows = await fetchJSON(`${API_BASE}/publication?me=1`);
  }

  // 3) Agrégation
  const byType = new Map();
  rows.forEach(p=>{
    const type = (p.type || 'Autre').trim() || 'Autre';
    const st = normStatut(p.statut);
    if (!byType.has(type)) byType.set(type, { total:0, val:0 });
    const g = byType.get(type);
    g.total += 1;
    if (st === 'Validée') g.val += 1;
  });

  const entries = [...byType.entries()].sort((a,b)=> b[1].total - a[1].total);
  const labels = entries.map(([k])=>k);
  const accepted = entries.map(([,v])=>v.val);
  const remaining = entries.map(([,v])=>Math.max(0, v.total - v.val));

  const globTotal = entries.reduce((s,[,v])=>s+v.total, 0);
  const globVal   = entries.reduce((s,[,v])=>s+v.val, 0);
  const pct = globTotal ? Math.round((globVal/globTotal)*100) : 0;

  const pctSpan = document.getElementById('pubTypePct');
  if (pctSpan) pctSpan.textContent = `${pct}%`;

  return { labels, accepted, remaining };
}

const customLabelsPlugin = {
  id: 'customBarLabels',
  afterDatasetsDraw(chart){
    const {ctx, data} = chart;
    const acc = data.datasets[0]?.data || [];
    const rem = data.datasets[1]?.data || [];
    ctx.save();
    acc.forEach((val, i)=>{
      const tot = (Number(val)||0) + (Number(rem[i])||0);
      const meta0 = chart.getDatasetMeta(0).data[i];
      if (!meta0) return;

      const barX = meta0.x;
      const dotY = meta0.y;
      const pct = tot ? Math.round((val/tot)*100) : 0;

      ctx.beginPath(); ctx.arc(barX, dotY, 3.5, 0, Math.PI*2);
      ctx.fillStyle = '#2A2916'; ctx.fill();

      const lineEndY = dotY - 30, lineEndX = barX + 25;
      ctx.beginPath(); ctx.moveTo(barX, dotY); ctx.lineTo(barX, lineEndY); ctx.lineTo(lineEndX, lineEndY);
      ctx.strokeStyle = '#6e6d55'; ctx.lineWidth = 1; ctx.stroke();

      ctx.fillStyle = '#2A2916'; ctx.textAlign='left'; ctx.textBaseline='middle';
      ctx.font = 'bold 12px sans-serif'; ctx.fillText(`${pct}%`, lineEndX+5, lineEndY-6);
      ctx.font = '11px sans-serif';      ctx.fillText('Acceptés', lineEndX+5, lineEndY+8);
    });
    ctx.restore();
  }
};

let typeChart = null;
async function buildTypeChart(){
  const {labels, accepted, remaining} = await fetchTypeDistribution();

  const ctxBar = document.getElementById('etatProjetsChart').getContext('2d');
  const gradient = ctxBar.createLinearGradient(0, 0, 0, 300);
  gradient.addColorStop(0, '#B00000'); gradient.addColorStop(1, '#800000');

  if (typeChart) typeChart.destroy();
  typeChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels,
      datasets: [
        { label: 'Acceptés', data: accepted, backgroundColor: gradient },
        { label: 'Autres',   data: remaining, backgroundColor: '#e5e7eb' }
      ]
    },
    options: {
      responsive:true, maintainAspectRatio:false, barPercentage:0.4,
      scales:{
        x:{ stacked:true, grid:{display:false}, border:{display:false} },
        y:{ stacked:true, beginAtZero:true, grid:{color:'#f0f0f0'}, border:{display:false}, ticks:{precision:0} }
      },
      plugins:{
        legend:{ display:false },
        tooltip:{ enabled:true, callbacks:{
          label(ctx){
            const idx = ctx.dataIndex;
            const a = accepted[idx]||0, r = remaining[idx]||0, tot = a+r;
            const pct = tot ? Math.round((a/tot)*100) : 0;
            return ctx.datasetIndex===0 ? ` Acceptés: ${a} (${pct}%)` : ` Autres: ${r}`;
          }
        }},
        datalabels:{ display:false }
      }
    },
    plugins:[customLabelsPlugin]
  });
}

// Boot
buildTypeChart();
</script>
