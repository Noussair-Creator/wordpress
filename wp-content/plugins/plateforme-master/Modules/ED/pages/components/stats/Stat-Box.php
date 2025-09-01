<style>
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(460px, 1fr));
  gap: 20px;
  margin-top: 20px;
      margin-bottom: 20px;
}

.card-stats, .card-photos {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  padding: 20px;
  position: relative;
  overflow: hidden;
}

/* ✅ Coin ↗ fixe en haut à droite */
.corner-icon {
  position: absolute;
  top: 0;
  right: 0;
  background: #b00000;
  color: #fff;
  font-size: 20px;
  padding: 8px 18px;
  border-radius: 0 0 0 20px;
  font-weight: bold;
  z-index: 9;
}

/* En-tête : titre + select */
.card-stats .header,
.card-photos .header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 700;
  font-size: 22px;
  color: #1f2937;
  margin-bottom: 16px;
}

/* ✅ Select année stylisé */
.card-stats .header select {
    padding: 6px 29px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #fff;
    appearance: none;
    background-image: url(data:image/svg+xml;utf8,<svg fill='black' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>);
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 14px;
    padding-right: 30px;
    margin-right: 47px;
    border: 1px solid #ECEBE3;
    border-radius: 5px;
    text-align: center;
}

/* 🟢 Zone graphique */
.chart-container {
  width: 300px;
  height: 300px;
  margin: auto;
}

#statsPieChart {
  width: 100% !important;
  height: 100% !important;
  display: block;
}

/* 🖼️ Grille des images */
.card-photos .grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 8px;
}
.card-photos .grid img {
  width: 100%;
  aspect-ratio: 4/3;
  object-fit: cover;
  border-radius: 8px;
}
</style>

<!-- ✅ HTML -->
<div class="stats-grid">
  <!-- Bloc Statistiques -->
  <div class="card-stats">
    <span class="corner-icon">↗</span>
    <div class="header">
      <span>Statistiques</span>
      <select>
        <option>2024 - 2025</option>
        <option>2023 - 2024</option>
      </select>
    </div>
    <div class="chart-container">
      <canvas id="statsPieChart"></canvas>
    </div>
  </div>

  <!-- Bloc Manifestations -->
  <div class="card-photos">
    <a href="/manifestations-scientifiques-ed"><span class="corner-icon">↗</span></a>
    <div class="header">
      <span>Manifestations scientifiques</span>
    </div>
    <div class="grid">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 417.png" alt="Event 1">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 418.png" alt="Event 2">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 419.png" alt="Event 3">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 459.png" alt="Event 4">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 460.png" alt="Event 5">
      <img src="/wp-content/plugins/plateforme-master/imagesED/Groupe de masques 461.png" alt="Event 6">
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxStats = document.getElementById('statsPieChart').getContext('2d');
new Chart(ctxStats, {
  type: 'pie',
  data: {
    labels: <?= json_encode(array_keys($data['statistiques'])) ?>,
    datasets: [{
      data: <?= json_encode(array_values($data['statistiques'])) ?>,
      backgroundColor: ['#a51414', '#e2bebe', '#fce488', '#6e6d55', '#d7d7d7'],
      borderColor: '#fff',
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        position: 'right',
        labels: {
          boxWidth: 14,
          padding: 10,
          font: {
            size: 13,
            weight: '500',
            family: 'Roboto, sans-serif'
          },
          color: '#333'
        }
      },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.label}: ${ctx.raw}%`
        }
      }
    }
  }
});
</script>
