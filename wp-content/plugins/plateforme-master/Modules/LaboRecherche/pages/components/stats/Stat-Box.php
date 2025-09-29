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
  <!-- ===== Financements (DYNAMIQUE) ===== -->
  <div class="card-stats" style="margin-right: 11px;">
    <div class="header">Top 4 Sources de financement</div>
    <div class="chart-row">
      <div class="chart-pie large"><canvas id="mainFinancementChart"></canvas></div>
      <div class="chart-pie"><canvas id="donut1"></canvas></div>
      <div class="bl-stat">
        <div class="chart-donut"><canvas id="donut2"></canvas></div>
        <div class="chart-donut"><canvas id="donut3"></canvas></div>
      </div>
    </div>
    <div id="legendTopSources" style="margin-top:15px;color:#333;font-size:11px"></div>
  </div>

  <!-- ===== Répartition par année des publications (DYNAMIQUE) ===== -->
  <div class="card-stats" style="margin-left:-11px;">
    <div class="header">
      Répartition par année des publications
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
/* ===================== REST config (pmsettings → wpApiSettings → fallback) ===================== */
const REST_ROOT =
  (window.pmsettings && pmsettings.rest_root) ||
  (window.wpApiSettings && wpApiSettings.root) ||
  '/wp-json/';
const NONCE =
  (window.pmsettings && pmsettings.nonce) ||
  (window.wpApiSettings && wpApiSettings.nonce) ||
  '';
const API_BASE = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

/* ================================================================================================
 *  TOP 4 SOURCES DE FINANCEMENT (donuts)
 * ==============================================================================================*/
async function fetchTopSources(){
  try {
    const res = await fetch(`${API_BASE}/financement/top-sources`, {
      headers: { 'X-WP-Nonce': NONCE, 'Accept':'application/json' },
      credentials: 'same-origin'
    });
    if (!res.ok) throw new Error("API error " + res.status);
    return await res.json();
  } catch(e){
    console.error("Erreur fetchTopSources:", e);
    return [];
  }
}

async function buildTopSourcesCharts(){
  const rows = await fetchTopSources();
  const legend = document.getElementById('legendTopSources');

  if (!rows.length){
    legend.innerHTML = "<em>Aucune donnée disponible</em>";
    return;
  }

  // Limite à 4 sources
  const sources = rows.slice(0,4);
  const canvasIds = ["mainFinancementChart","donut1","donut2","donut3"];
  const colors = ['#BF0404','#808066','#D6A800','#4A7C59'];

  legend.innerHTML = "";

  sources.forEach((src,i)=>{
    const reste = Math.max(0, (Number(src.montant)||0) - (Number(src.consomme)||0));
    const canvas = document.getElementById(canvasIds[i]);
    if (!canvas) return;

    new Chart(canvas.getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ["Consommé","Restant"],
        datasets: [{
          data: [src.consomme, reste],
          backgroundColor: [colors[i], "#ECEBE3"],
          borderWidth: 0
        }]
      },
      options: {
        cutout: i===0 ? "60%" : "70%", // le 1er donut plus épais/large
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: (ctx) => `${ctx.label}: ${Number(ctx.raw).toLocaleString()} TND`
            }
          },
          datalabels: {
            color: "#000",
            font: { size: i===0 ? 14 : 10, weight:"bold" },
            formatter: (val, ctx)=>{
              const total = ctx.chart.getDatasetMeta(0).total || 0;
              const pct = total ? Math.round((val/total)*100) : 0;
              return pct + "%";
            }
          }
        }
      },
      plugins:[ChartDataLabels]
    });

    // Légende textuelle
    legend.innerHTML += `
      <div style="margin:4px 0;">
        <span style="font-size:11px;display:inline-block;width:12px;height:12px;background:${colors[i]};margin-right:6px;border-radius:50%"></span>
        ${src.intitule} (${src.type}) :
        <strong>${Number(src.consomme).toLocaleString()} / ${Number(src.montant).toLocaleString()} TND</strong>
      </div>
    `;
  });
}

/* ================================================================================================
 *  RÉPARTITION PAR ANNÉE DES PUBLICATIONS (bar empilé Acceptés vs Autres)
 * ==============================================================================================*/
// Normalisation du statut
function normStatut(s){
  const v = (s||'').toLowerCase().trim();
  if (v.startsWith('valid')) return 'Validée';
  if (v.startsWith('rej'))   return 'Rejetée';
  return 'En attente';
}

// Extraction robuste de l'année
function getYearFromPub(p){
  // Priorité au champ annee si présent
  if (p.annee) {
    const y = parseInt(String(p.annee).slice(0,4), 10);
    if (!Number.isNaN(y)) return y;
  }
  // Sinon, chercher une année dans les dates possibles
  const dateStr = p.date_publication || p.date_pub || p.date || p.created_at || '';
  const m = String(dateStr).match(/(19|20)\d{2}/);
  if (m) return parseInt(m[0], 10);
  return 'Non précisé';
}

async function fetchYearDistribution(){
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

  // 1) Essai "suivi labos"
  let rows = await fetchJSON(`${API_BASE}/publication?with_auteur=1`);

  // 2) Fallback “mes publications”
  if (!rows.length) {
    console.info('[stats] Fallback sur /publication?me=1 (aucune ligne avec with_auteur=1)');
    rows = await fetchJSON(`${API_BASE}/publication?me=1`);
  }

  // 3) Agrégation par année
  const byYear = new Map();
  rows.forEach(p=>{
    const year = getYearFromPub(p);
    const st = normStatut(p.statut);
    if (!byYear.has(year)) byYear.set(year, { total:0, val:0 });
    const g = byYear.get(year);
    g.total += 1;
    if (st === 'Validée') g.val += 1;
  });

  // Tri : années croissantes ; “Non précisé” en dernier
  const entries = [...byYear.entries()].sort((a,b)=>{
    const ay = a[0], by = b[0];
    const aIsNum = typeof ay === 'number';
    const bIsNum = typeof by === 'number';
    if (aIsNum && bIsNum) return ay - by;
    if (aIsNum) return -1;
    if (bIsNum) return 1;
    return String(ay).localeCompare(String(by));
  });

  const labels    = entries.map(([k])=> String(k));
  const accepted  = entries.map(([,v])=> v.val);
  const remaining = entries.map(([,v])=> Math.max(0, v.total - v.val));

  // % global accepté
  const globTotal = entries.reduce((s,[,v])=> s + v.total, 0);
  const globVal   = entries.reduce((s,[,v])=> s + v.val,   0);
  const pct = globTotal ? Math.round((globVal/globTotal)*100) : 0;
  const pctSpan = document.getElementById('pubTypePct');
  if (pctSpan) pctSpan.textContent = `${pct}%`;

  return { labels, accepted, remaining };
}

// Plugin d’annotations (points + étiquette % au-dessus des barres Acceptés)
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

      // petit point
      ctx.beginPath(); ctx.arc(barX, dotY, 3.5, 0, Math.PI*2);
      ctx.fillStyle = '#2A2916'; ctx.fill();

      // trait + étiquettes
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

let yearChart = null;
async function buildYearChart(){
  const {labels, accepted, remaining} = await fetchYearDistribution();

  const ctxBar = document.getElementById('etatProjetsChart').getContext('2d');
  const gradient = ctxBar.createLinearGradient(0, 0, 0, 300);
  gradient.addColorStop(0, '#B00000'); gradient.addColorStop(1, '#800000');

  if (yearChart) yearChart.destroy();
  yearChart = new Chart(ctxBar, {
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

/* ===================== BOOT ===================== */
document.addEventListener("DOMContentLoaded", async ()=>{
  await buildTopSourcesCharts();
  await buildYearChart();
});
</script>
