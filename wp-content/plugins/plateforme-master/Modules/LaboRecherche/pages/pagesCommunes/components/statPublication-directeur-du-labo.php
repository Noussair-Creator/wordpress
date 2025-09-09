<div class="statistiques-wrapper">
  <div class="header-bar">
    <h2 class="dashboard-sub-title">
      <img src="/wp-content/plugins/plateforme-master/images/ed/16406436.png" alt="Icon"
        style="width: 38px; margin-right: 8px; vertical-align: middle;">
      Statistiques Générales
    </h2>
    <button class="btn-report"><i class="fa fa-file-alt"></i> Générer un rapport global</button>
  </div>

  <hr class="section-divider">

  <div class="stats-grid">
    <!-- Gauche -->
    <div class="left-stats">
      <!-- dans .left-stats -->
      <div class="stat-box">
        <span class="label">Publications Publiées </span>
        <span class="value" id="stat-publiees">0</span>
      </div>
      <div class="stat-box">
        <span class="label">Total des publications</span>
        <span class="value" id="stat-total">0</span>
      </div>

    </div>

    <!-- Droite -->
    <div class="right-graph">
      <div class="graph-header">
        <h4>Répartition par statut des publications</h4>
        <select class="graph-select" id="anneeSelect">
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
  .header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .dashboard-sub-title {
    font-weight: bold;
    font-size: 24px;
  }

  .statistiques-wrapper {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
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
    gap: 42px;
    flex: 1;
  }

  .stat-box {
    background: #f8f9fa;
    padding: 36px 20px;
    /* margin-bottom: 15px; */
    border-radius: 10px;
    box-shadow: 0px 0px 16px #0000001C;
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border-left: 4px solid #c60000;
    padding-left: 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .stat-box .label {
    font-weight: 700;
    font-size: 19px;
    color: #2A2916;
  }

  .stat-box .value {
    background: #ECEBE3;
    border-radius: 6px;
    padding: 9px 8px;
    font-weight: bold;
    font-size: 21px;
    min-width: 51px;
    text-align: center;
  }

  .right-graph {
    flex: 2;
    background: #fdfdfd;
    border-radius: 10px;
    padding: 20px;
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
    font-weight: bold;
  }

  .graph-select {
    padding: 5px 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
  }

  .canvas-container {
    width: 100%;
    max-width: 180px;
    margin: 0 auto 20px;
  }

  #pieChart {
    width: 100% !important;
    height: auto !important;
  }

  .legend {
    font-size: 14px;
    color: #444;
    margin-top: 10px;
    display: flex;
    justify-content: space-around;
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

  .dot-green {
    background-color: #808066;
  }

  .dot-red {
    background-color: #b1342f;
  }

  .dot-beige {
    background-color: #dabebe;
  }

  .blocChart {
    display: flex;
    width: max-content;
    margin: 0 auto;
    gap: 25px;
  }


  hr {
    border: 1px solid #ECEBE3 !important;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
  (function () {
    const API_BASE = (window.pmsettings && pmsettings('api_base')) || '/wp-json/plateforme-recherche/v1';
    const REST_NONCE = (window.pmsettings && pmsettings('rest_nonce')) ||
      <?php echo wp_json_encode(wp_create_nonce('wp_rest')); ?>;

    const elPubPubliees = document.getElementById('stat-publiees');
    const elTotal = document.getElementById('stat-total');
    const elLegend = document.getElementById('chartLegend');
    const ctx = document.getElementById('pieChart').getContext('2d');

    const labels = ['En attente', 'Publiée', 'Rejetée'];
    const colors = ['#808066', '#b1342f', '#dabebe'];

    let chart;

    function getDateRangeFromSelect() {
      const sel = document.querySelector('.graph-select');
      const txt = (sel?.value || '').trim();
      const m = txt.match(/^(\d{4})\s*-\s*(\d{4})$/);
      if (!m) return {
        start: null,
        end: null
      };
      const y1 = parseInt(m[1], 10);
      const y2 = parseInt(m[2], 10);
      // année universitaire 01/09 → 31/08
      return {
        start: `${y1}-09-01`,
        end: `${y2}-08-31`
      };
    }

    async function callStats(scope, start, end) {
      const url = new URL(API_BASE + '/publication/stats', window.location.origin);
      url.searchParams.set('scope', scope);
      if (start) url.searchParams.set('start', start);
      if (end) url.searchParams.set('end', end);
      const resp = await fetch(url.toString(), {
        headers: {
          'X-WP-Nonce': REST_NONCE
        }
      });
      if (!resp.ok) throw new Error(`Stats API ${resp.status}: ${await resp.text()}`);
      return resp.json();
    }

    async function fetchStatsSmart() {
      const {
        start,
        end
      } = getDateRangeFromSelect();

      // 1) Essayer labs (si tu es directeur) → sinon me
      try {
        const d = await callStats('labs', start, end);
        if (d.counts.total === 0) {
          // 2) si rien, réessaie sans période (au cas où dates NULL)
          const d2 = await callStats('labs', null, null);
          return d2.counts.total ? d2 : d;
        }
        return d;
      } catch (e) {
        // labs refuse (403) → essayer me
        try {
          const d = await callStats('me', start, end);
          if (d.counts.total === 0) {
            const d2 = await callStats('me', null, null);
            return d2.counts.total ? d2 : d;
          }
          return d;
        } catch (e2) {
          // dernier essai auto
          return callStats('auto', start, end);
        }
      }
    }

    function updateBoxes(counts) {
      elPubPubliees.textContent = counts.publiees;
      elTotal.textContent = counts.total;
    }

    function updateChart(counts) {
      const dataValues = [counts.en_attente, counts.publiees, counts.rejetees];

      if (!chart) {
        chart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels,
            datasets: [{
              data: dataValues,
              backgroundColor: colors
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: false
              },
              datalabels: {
                color: '#fff',
                font: {
                  weight: 'bold',
                  size: 13
                },
                formatter: (value, ctx) => {
                  const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b,
                    0) || 1;
                  const pct = Math.round(100 * value / total);
                  return pct ? pct + '%' : '';
                }
              }
            }
          },
          plugins: [ChartDataLabels]
        });
      } else {
        chart.data.datasets[0].data = dataValues;
        chart.update();
      }

      elLegend.innerHTML = '';
      labels.forEach((label, i) => {
        const item = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML =
          `<span class="legend-dot" style="background-color:${colors[i]}"></span>${label}`;
        elLegend.appendChild(item);
      });
    }

    async function refresh() {
      try {
        const data = await fetchStatsSmart();
        updateBoxes(data.counts);
        updateChart(data.counts);
        // console.log('STATS', data); // <-- décommente pour voir la réponse
      } catch (e) {
        console.error(e);
        updateBoxes({
          publiees: 0,
          total: 0
        });
        updateChart({
          en_attente: 0,
          publiees: 0,
          rejetees: 0
        });
      }
    }

    document.querySelector('.graph-select')?.addEventListener('change', refresh);
    refresh();
  })();
</script>