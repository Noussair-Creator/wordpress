<!-- ===================== STATISTIQUES – RÉPARTITION PAR GRADE ===================== -->
<div class="statistiques-wrapper" id="bloc-stats-grade">
  <div class="header-bar">
    <h2 class="dashboard-sub-title">
      <img src="/wp-content/plugins/plateforme-master/images/ed/16406436.png" alt="Icon"
           style="width:38px;margin-right:8px;vertical-align:middle;">
      Statistiques Générales
    </h2>
    <button class="btn-report" type="button"><i class="fa fa-file-alt"></i> Générer un rapport global</button>
  </div>

  <hr class="section-divider">

  <div class="stats-grid">
    <!-- Cartes gauche (exemple) -->
    <div class="left-stats">
      <div class="stat-box">
        <span class="label">Total des membres</span>
        <span class="value" id="total-membres">—</span>
      </div>
      <div class="stat-box">
        <span class="label">Membres actifs</span>
        <span class="value" id="membres-actifs">—</span>
      </div>
    </div>

    <!-- Graphe barres (répartition par grade) -->
    <div class="right-graph bar-chart-section" style="max-width:unset;width:100%;">
      <div class="graph-header">
        <h4>Répartition par grade</h4>
        <select class="graph-select" id="selectYear">
          <option value="">Toutes années</option>
          <option>2025 - 2026</option>
        </select>
      </div>

      <div class="bar-chart-wrapper" style="position:relative;height:260px;">
        <canvas id="barChartGrade" aria-label="Répartition par grade" role="img"></canvas>

        <!-- États -->
        <div id="grade-loading" class="chart-state" style="display:none;">Chargement…</div>
        <div id="grade-empty"   class="chart-state" style="display:none;">Aucune donnée à afficher</div>
        <div id="grade-error"   class="chart-state" style="display:none;color:#b00020;">Erreur de chargement</div>
      </div>
    </div>
  </div>
</div>

<!-- ===================== STYLES MINIMAUX ===================== -->
<style>
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }


    .dashboard-sub-title {
        font-weight: bold;
        font-size: 24px;
    }

    .header-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .year-selector {
        padding: 10px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        color: #5a6c7d;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .year-selector:hover {
        border-color: #c60000;
    }

    .year-selector:focus {
        outline: none;
        border-color: #c60000;
        box-shadow: 0 0 0 3px rgba(198, 0, 0, 0.1);
    }

    .export-btn {
        background: #c60000;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .export-btn:hover {
        background: #a50000;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(198, 0, 0, 0.3);
    }

    .export-icon {
        font-size: 16px;
    }

    /* Main Dashboard Content */
    .dashboard-content {
        display: grid;
        grid-template-columns: 300px 1fr 400px;
        gap: 25px;
        align-items: start;
    }

    /* Stats Section */
    .stats-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-green {
        border-left-color: #27ae60 !important;
    }

    .stat-orange {
        border-left-color: #f39c12 !important;
    }

    .stat-red {
        border-left-color: #c60000 !important;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-label {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.3;
    }

    .stat-value {
        background: #ecf0f1;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        min-width: 70px;
        text-align: center;
    }

    /* Chart Section */
    .chart-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
    }

    .donut-chart-wrapper {
        position: relative;
        height: 280px;
        margin-bottom: 20px;
    }

    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #5a6c7d;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Disciplines Section */
    .disciplines-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .disciplines-container {
        height: 100%;
    }

    .bar-chart-wrapper {
        height: 233px;
        margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .dashboard-content {
            grid-template-columns: 280px 1fr 350px;
        }
    }

    @media (max-width: 1024px) {
        .dashboard-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .stats-section {
            flex-direction: row;
            gap: 15px;
        }

        .stat-card {
            flex: 1;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px 15px;
        }

        .header-section {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .header-controls {
            justify-content: center;
        }



        .stats-section {
            flex-direction: column;
        }

        .chart-section,
        .disciplines-section {
            padding: 20px;
        }

        .donut-chart-wrapper,
        .bar-chart-wrapper {
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .stat-content {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .stat-value {
            align-self: stretch;
        }
    }

    /* Loading Animation */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    /* Chart Center Text Plugin Styles */
    .chart-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
    }

    .center-value {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        display: block;
    }

    .center-label {
        font-size: 14px;
        color: #7f8c8d;
        margin-top: 5px;
    }



    .statistiques-wrapper {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        padding: 20px;
        display: flex;
        flex-direction: column;
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
        gap: 40px;
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
        width: 190px;
        height: 40px;
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

    .stat-box .value {
        background: #ECEBE3;
        border-radius: 6px;
        padding: 9px 8px;
        font-weight: bold;
        font-size: 21px;
        min-width: 51px;
        text-align: center;
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

    .right-graph {
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        max-width: 293px;
        box-shadow: 0px 0px 16px #0000001C;
        width: 293px;
        height: 310px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 0px 11px #0000001F;
        border-radius: 10px;
    }


    .graph-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .graph-select {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 4px;
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

    .dot-green {
        background: #808066;
    }

    .dot-red {
        background: #b1342f;
    }

    .dot-beige {
        background: #dabebe;
    }

    /* .canvas-container {
    height: 162px;
    width: 162px;
} */

    #pieChart {
        width: 162px !important;
        height: 162px !important;
    }

    .stats-grid {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        justify-content: unset;
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
        /* border-left: 4px solid #c60000; */
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



    .graph-select {
        padding: 5px 10px;
    }

    /* .canvas-container {
    width: 100%;
    max-width: 162px;
    margin: 0 auto;
    margin-bottom: 0px
} */

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

    .dot-green {
        background-color: #4CAF50;
    }

    .dot-red {
        background-color: #F44336;
    }

    .dot-beige {
        background-color: #FFC107;
    }

    .stats-grid {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        gap: 40px;
    }

    .left-stats {
        flex: unset;
        /* équivalent à 1/3 si l'autre est 2 */
        box-sizing: border-box;
    }

    .right-graph {
        flex: unset;
        /* équivalent à 2/3 */
        box-sizing: border-box;
    }

    .stat-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        padding: 36px 85px;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0px 0px 16px #0000001C;
        padding-left: 0px;
        background-color: #fff;
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
        font-weight: bold;
    }

    .graph-select {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    /* .canvas-container {
    width: 100%;
    max-width: 162px;
    --margin: 0 auto 20px;--
    margin-bottom: 0px
        --flex:1--

} */

    #pieChart {
        width: 100% !important;
        height: auto !important;
    }

    .legend {
        display: flex;
        gap: 1px;
        flex-wrap: wrap;
        justify-content: space-around;
        font-size: 14px;
        color: #444;
        flex: 1;
        max-width: 164px;
    }

    .legend .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 6px;
        vertical-align: middle;
    }

    .dot-green {
        background-color: #808066;
    }

    .dot-red {
        background-color: #b1342f
    }

    .dot-beige {
        background-color: #dabebe;
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

    /* .blocChart {
    display: flex;
    flex-direction: column;
    width: max-content;
    margin: 0 auto;
    gap: 25px;
} */


    /* #donutChart {
    width: 100% !important;
    height: 100% !important;
} */
</style>

<!-- ===================== CHART.JS ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>

<!-- ===================== LOGIQUE ===================== -->

