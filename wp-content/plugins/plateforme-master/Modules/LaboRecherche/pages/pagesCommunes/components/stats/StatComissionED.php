<style>
.stats-calendar-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
  gap: 20px;
  margin: 30px 0;
    grid-template-columns: 2fr 1fr; /* ✅ Bloc 1 = 2/3, Bloc 2 = 1/3 */

}

.stat-bar-card,
.calendar-card {
  background: white;
  border-radius: 20px;
  padding: 20px;
  position: relative;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.corner-icon2 {
  position: absolute;
  top: 0;
  right: 0;
  background: #b00000;
  color: #fff;
  font-size: 20px;
  padding: 8px 18px;
  border-radius: 0 20px 0 20px;
  font-weight: bold;
  z-index: 9;
}

.stat-bar-card .header,
.calendar-card .header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: bold;
  font-size: 20px;
  color: #2A2916;
  margin-bottom: 12px;
}

.stat-bar-card .header select {
  padding: 4px 16px;
  font-size: 14px;
  border-radius: 8px;
  border: 1px solid #e0dfd6;
  background-color: #fff;
  font-weight: 500;
  color: #2A2916;
  appearance: none;
  margin-right: 45px;
}
.fc-daygrid-day-top {
    display: inherit !important;
}
.bar-container {
  height: 300px;
  width: 100%;
}

/* FullCalendar override */
#calendar-full {
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
}

.fc .fc-button {
  background-color: #aaa67e;
  border: none;
  font-weight: 500;
}




/* 🔲 Base container */
#calendar-full {
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
  background: white;
  border-radius: 20px;
  padding: 10px 0;
  box-shadow: none;
}

/* 📆 En-tête calendrier */
.fc .fc-toolbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 20px;
  margin-bottom: 10px;
}

.fc .fc-toolbar-title {
font-size: 18px;
    font-weight: 500;
    color: #fff;
    text-transform: capitalize;
}

.fc .fc-button
 {
    background-color: #fff !important;
    border: none;
    font-size: 13px;
    font-weight: bold;
    padding: 6px 10px;
    border-radius: 6px;
    color: #a6a485 !important;
    box-shadow: none;
    margin-left: 7px !important;
}

.fc .fc-button:disabled {
  background-color: #ddd !important;
  opacity: 0.6;
}

/* 🟩 Header jours semaine */
.fc .fc-col-header-cell {
    background: transparent;
    color: #666666;
    font-weight: 500;
    padding: 6px 0;
    text-transform: CAPITALIZE;
    border: none;
}
/* Arrondir la cellule du jour LUNDI (première colonne) */
.fc .fc-col-header-cell:first-child {
  border-top-left-radius: 12px;
  overflow: hidden;
}

/* Arrondir la cellule du jour DIMANCHE (dernière colonne) */
.fc .fc-col-header-cell:last-child {
  border-top-right-radius: 12px;
  overflow: hidden;
}
/* 🗓️ Cellule jour */
.fc .fc-daygrid-day {
  text-align: center;
  height: 50px;
  vertical-align: middle;
  border: none;
}

.fc .fc-daygrid-day-frame {
  padding: 4px;
}

/* 🔴 Date active (événement) */
.fc .fc-event {
  background-color: #a51414 !important;
  color: white !important;
  font-size: 12px;
  border-radius: 999px;
  padding: 2px 6px;
  text-align: center;
  border: none;
}

/* Pour transformer chaque jour avec event en pastille rouge */
.fc-daygrid-day.fc-day-today {
  background: none !important;
}


.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr {
    background: #A6A485 0% 0% no-repeat padding-box;
    border-radius: 10px 10px 0px 0px;
    opacity: 1;
    color: #fff;
    margin-bottom: 0px;
}
.fc-event.fc-hidden-title {
  background-color: #a51414 !important;
  color: transparent !important;
  font-size: 0 !important;
  border-radius: 50% !important;
  width: 12px;
  height: 12px;
  margin: auto;
  padding: 0;
}
.fc-daygrid-day.fc-full-red a {
    background-color: #a51414 !important;
    border-radius: 10px !important;
    color: white !important;
    border-radius: 50% !important;
    width: 25px !important;
    max-width: 25px !important;
    position: relative;
    left: 31%;
}
/* ✅ Forcer le jour en blanc centré */
.fc-full-red .fc-daygrid-day-number {
  color: white !important;
  font-weight: bold;
  z-index: 1;
  position: relative;
}

/* ✅ Supprimer les pastilles d’événement */
.fc-daygrid-event {
  display: none !important;
}

/* Hauteur fixe de chaque jour */
.fc-daygrid-day-frame {
  min-height: 52px !important;
  height: 52px !important;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}


/* Ou bien fixer directement la hauteur de chaque cellule */
.fc-daygrid-day {
  height: 22px !important;     /* fixe la hauteur */
  max-height: 22px !important;
  overflow: hidden;
}
.fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
   display: none !important;

}
.fc .fc-daygrid-day-frame {
    min-height: 30px !important;
    position: relative;
    height: 30px !important;
}
.fc-scrollgrid-sync-table {
  height: auto !important;
}
.fc .fc-daygrid-day-top{
      flex-direction: column !important;
}
.fc .fc-scrollgrid-liquid {
    height: 244px;
    box-shadow: 0px 4px 16px #00000029;
    border-radius: 0px 0px 10px 10px;
}
.fc .fc-view-harness {
    height: 244px !important;
}
</style>


<div class="stats-calendar-grid">

  <!-- Bloc statistiques -->
  <div class="stat-bar-card">
    <span class="corner-icon2">↗</span>
    <div class="header">
      <span>Statistiques / Dossiers</span>
      <select>
        <option>2024 - 2025</option>
        <option>2023 - 2024</option>
      </select>
    </div>
    <div class="bar-container">
      <canvas id="barStatsChart"></canvas>
    </div>
  </div>

  <!-- Bloc calendrier dynamique -->
  <div class="calendar-card">
    <span class="corner-icon2">↗</span>
    <div class="header">
      <span>Calendrier jumelé</span>
    </div>
    <div id="calendar-full"></div>
  </div>

</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
// Bar chart
const ctxBar = document.getElementById('barStatsChart').getContext('2d');
new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_keys($data['statistiques_dossiers'] ?? [])) ?>,
    datasets: [{
      label: 'Nombre de dossiers',
      data: <?= json_encode(array_values($data['statistiques_dossiers'] ?? [])) ?>,
      backgroundColor: 'rgba(165, 20, 20, 0.3)',
      borderColor: '#a51414',
      borderWidth: 2,
      borderRadius: 5,
      barThickness: 40
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: { color: '#2A2916' },
        grid: { color: '#d9d9c9' }
      },
      x: {
        ticks: { color: '#2A2916' },
        grid: { display: false }
      }
    },
    plugins: {
      legend: { display: false },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.raw} dossiers`
        }
      }
    }
  }
});

// FullCalendar
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar-full');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    firstDay: 1,
    dayHeaderFormat: { weekday: 'short' },
    headerToolbar: {
      left: 'title',
      center: '',
      right: 'prev,next'
    },
    dayHeaderContent: function(arg) {
      const jours = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
      return jours[arg.date.getDay()];
    },
   
    events: [
      { title: 'Réunion', start: '2025-07-28' },
      { title: 'Conférence', start: '2025-08-15' },
      { title: 'Séminaire', start: '2025-08-24' }
    ],

   eventDidMount: function(info) {
    // Empêche l'affichage du contenu visuel de l'événement
    info.el.style.display = 'none';

    const dateStr = info.event.startStr; // format YYYY-MM-DD
    const cell = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
    if (cell) {
      cell.classList.add('fc-full-red');
      cell.setAttribute('title', info.event.title); // tooltip natif
    }
  }

  

  });
  calendar.render();
});


</script>

