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
                <span class="label">Publications Acceptées </span>
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
                <h4>Diagramme des publications par statut</h4>
                <select class="graph-select" id="anneeSelect"></select>

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
    flex-direction: column; /* ✅ les items deviennent verticaux */
    align-items: flex-start; /* ✅ alignés à gauche (ou center si tu veux centrer) */
    gap: 8px; /* ✅ petit espacement entre chaque ligne */
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

<?php if (is_user_logged_in()): ?>
<script>
// REST settings exposées au JS
window.pmsettings = {
    rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
    nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
};
// Rôles utilisateur courant
window.pmuser = {
    roles: <?php echo json_encode($roles); ?>
};
</script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
<script>
(function() {
    // REST config
    const REST_ROOT =
        (window.pmsettings && pmsettings.rest_root) ||
        (window.wpApiSettings && wpApiSettings.root) ||
        '/wp-json/';
    const NONCE =
        (window.pmsettings && pmsettings.nonce) ||
        (window.wpApiSettings && wpApiSettings.nonce) ||
        '';
    const API = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

    // DOM
    const elPubPubliees = document.getElementById('stat-publiees');
    const elTotal = document.getElementById('stat-total');
    const elYear = document.getElementById('anneeSelect');
    const elLegend = document.getElementById('chartLegend');
    const ctx = document.getElementById('pieChart').getContext('2d');
    // ===== Années universitaires dynamiques (01/09 -> 31/08) =====
    function academicYearLabelFor(date) { // retourne "YYYY - YYYY+1"
        const d = date instanceof Date ? date : new Date();
        const y = d.getFullYear();
        const m = d.getMonth() + 1; // 1..12
        const y1 = (m >= 9) ? y : (y - 1);
        return `${y1} - ${y1 + 1}`;
    }

    function fillYearsSelect(selectEl, count = 5) {
        if (!selectEl) return;
        selectEl.innerHTML = '';
        const currentLabel = academicYearLabelFor(new Date());
        // génère N années, la plus récente en premier
        const startY1 = parseInt(currentLabel.slice(0, 4), 10);
        for (let i = 0; i < count; i++) {
            const y1 = startY1 - i;
            const opt = document.createElement('option');
            opt.value = `${y1} - ${y1 + 1}`;
            opt.textContent = opt.value;
            if (i === 0) opt.selected = true;
            selectEl.appendChild(opt);
        }
    }

    // Chart setup
    const labels = ['Validées', 'En attente', 'Rejetées'];
    const colors = ['#b1342f', '#808066', '#dabebe'];
    let chart = null;

    function getSelectedYearLabel() {
        // ex: "2024 - 2025" (value or text)
        const v = (elYear && elYear.value) ? elYear.value.trim() : '';
        return v || (elYear && elYear.options[elYear.selectedIndex]?.text.trim()) || '';
    }

    async function fetchStats() {
        const url = new URL(API + '/publication/stats', window.location.origin);
        const yearLabel = getSelectedYearLabel(); // "2024 - 2025"
        if (yearLabel) url.searchParams.set('year', yearLabel);

        const resp = await fetch(url.toString(), {
            headers: {
                'X-WP-Nonce': NONCE,
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });
        if (!resp.ok) {
            const t = await resp.text();
            throw new Error('Stats API ' + resp.status + ': ' + t);
        }
        return resp.json(); // {total, publiees, en_attente, rejetees, from, to}
    }

    function updateBoxes(stats) {
        elPubPubliees.textContent = stats.publiees ?? 0;
        elTotal.textContent = stats.total ?? 0;
    }

    function renderLegend() {
        elLegend.innerHTML = '';
        labels.forEach((label, i) => {
            const item = document.createElement('div');
            item.className = 'legend-item';
            item.innerHTML =
                `<span class="legend-dot" style="background-color:${colors[i]}"></span>${label}`;
            elLegend.appendChild(item);
        });
    }

    function updateChart(stats) {
        const dataValues = [
            Number(stats.en_attente || 0),
            Number(stats.publiees || 0),
            Number(stats.rejetees || 0)
        ];

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
                                const total = (ctx.chart.data.datasets[0].data || []).reduce((a, b) =>
                                    a + b, 0) || 1;
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
    }
    fillYearsSelect(elYear, 7); // par ex. 7 années
    refresh();

    async function refresh() {
        try {
            const stats = await fetchStats();
            updateBoxes(stats);
            updateChart(stats);
            renderLegend();
        } catch (e) {
            console.error(e);
            const zero = {
                total: 0,
                publiees: 0,
                en_attente: 0,
                rejetees: 0
            };
            updateBoxes(zero);
            updateChart(zero);
            renderLegend();
        }
    }

    if (elYear) elYear.addEventListener('change', refresh);
    refresh();
})();
</script>