<div class="statistiques-wrapper">
    <div class="header-bar">
        <h2 class="dashboard-sub-title">
            <img src="/wp-content/plugins/plateforme-master/images/ed/1170616.png" alt="Icon"
                style="width: 38px; margin-right: 8px; vertical-align: middle;">
            <span>Statistiques Générales</span>
        </h2>
        <button class="btn-report"><i class="fa-solid fa-arrows-rotate fa-lg"></i> Générer un rapport
            global</button>
    </div>

    <hr class="section-divider">

    <div class="stats-grid">
        <!-- Gauche -->
        <div class="left-stats">
            <div class="left-left">
                <div class="stat-box">
                    <span class="label">Réunions prévues ce mois</span>
                    <span class="value">8</span>
                </div>
                <div class="stat-box">
                    <span class="label">Taux de participation du directeur</span>
                    <span class="value">100%</span>
                </div>
            </div>
            <div class="left-right">
                <div class="stat-box">
                    <span class="label">Réunions scientifiques suivies (2025)</span>
                    <span class="value">6</span>
                </div>
                <div class="stat-box">
                    <span class="label">Réunions visio planifiées</span>
                    <span class="value">3</span>
                </div>
            </div>
        </div>
        <!-- Right Side: Calendar -->
        <div class="right-graph">
            <canvas id="calendarCanvas" class="bg-white rounded-3 shadow"></canvas>
            <div class="legend">
                <ul>
                    <li>
                        <span
                            style="width: 0.75rem; height: 0.75rem; background-color: #d9534f; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>Soutenance
                    </li>
                    <li>
                        <span
                            style="width: 0.75rem; height: 0.75rem; background-color: #f7c5c5; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>Réunion
                        ED
                    </li>
                    <li>
                        <span
                            style="width: 0.75rem; height: 0.75rem; background-color: #6c757d; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>Séminaire
                        scientifique
                    </li>
                    <li>
                        <span
                            style="width: 0.75rem; height: 0.75rem; background-color: #f0ad4e; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>Comité
                        de suivi
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




<style>
ul {
    list-style: none;
    padding: 0;
    margin: 0 40px;
}

.header-bar {
    display: flex;
    justify-content: space-between;
}

.dashboard-sub-title {
    font-weight: 500 !important;
    font-size: 24px;
    display: flex;
    align-items: center;
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
    font-size: 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 15px;
    font-weight: 500;
}

.stats-grid {
    display: flex;
    align-items: stretch;
    gap: 20px;
}

.left-stats {
    display: flex;
    /* flex-direction: column; */
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
    font-weight: 500;
    font-size: 19px;
    width: 226px;
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
    font-weight: 500;
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

.dot-green {
    background: #808066;
}

.dot-red {
    background: #b1342f;
}

.dot-beige {
    background: #dabebe;
}

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
    margin-bottom: 0px
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
}

.left-stats {
    flex: 1;
    /* équivalent à 1/3 si l'autre est 2 */
    box-sizing: border-box;
}

.right-graph {
    flex: 3;
    /* équivalent à 2/3 */
    box-sizing: border-box;
}

.stat-box {
    display: flex;
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
    /* font-weight: bold; */
    font-size: 21px;
    min-width: 51px;
    text-align: center;
}

.right-graph {
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 16px #0000001C;
    display: flex;
    gap: 5px;
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
    font-weight: 400;
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
    margin-bottom: 0px flex:1
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

.dot-green {
    background-color: #808066;
}

.dot-red {
    background-color: #b1342f
}

.dot-beige {
    background-color: #dabebe;
}

.legend {
    display: inline;
    justify-content: space-around;
    font-size: 14px;
    color: #444;
    margin-top: 10px;
    flex: 1;
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
// --- Canvas Setup ---
const canvas = document.getElementById('calendarCanvas');
const ctx = canvas.getContext('2d');

// --- State Management ---
let currentDate = new Date(2025, 6, 1); // Start at July 2025
let hoverTarget = null;

// --- Configuration & Constants ---
const config = {
    width: 300,
    height: 320,
    padding: 15,
    headerHeight: 45,
    weekdaysHeight: 30,
    gridGap: 5,
    font: 'Inter',
    colors: {
        text: '#374151',
        lightText: '#9CA3AF',
        border: '#E5E7EB',
        headerBg: '#9c9a87',
        headerText: '#ffffff',
        navButtonBg: '#F3F4F6',
        navButtonHoverBg: '#E5E7EB',
        soutenance: '#d9534f',
        reunionBg: '#f7c5c5',
        reunionText: '#b91c1c',
        seminaire: '#6c757d',
    }
};

// --- Event Data ---
const eventsByMonth = {
    '2025-6': { // Key is YYYY-M (month is 0-indexed)
        '1': {
            type: 'reunion'
        },
        '7': {
            type: 'seminaire'
        },
        '8': {
            type: 'reunion'
        },
        '15': {
            type: 'soutenance',
            range: 'start'
        },
        '16': {
            type: 'soutenance',
            range: 'middle'
        },
        '17': {
            type: 'soutenance',
            range: 'end'
        },
    }
};

function getCalendarData(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDayOfMonth = new Date(year, month, 1);
    const firstDayOffset = (firstDayOfMonth.getDay() + 6) % 7;
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const daysInPrevMonth = new Date(year, month, 0).getDate();
    const monthName = date.toLocaleString('fr-FR', {
        month: 'long'
    });
    return {
        year,
        month,
        firstDayOffset,
        daysInMonth,
        daysInPrevMonth,
        monthName
    };
}

// --- Main Drawing Function ---
function drawCalendar() {
    const calendarData = getCalendarData(currentDate);
    const dpr = window.devicePixelRatio || 1;
    canvas.width = config.width * dpr;
    canvas.height = config.height * dpr;
    canvas.style.width = `${config.width}px`;
    canvas.style.height = `${config.height}px`;
    ctx.scale(dpr, dpr);

    ctx.clearRect(0, 0, config.width, config.height);
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, config.width, config.height);

    drawHeader(calendarData);
    drawGrid(calendarData);
}

// --- Drawing Helper Functions ---

function drawRoundRect(x, y, width, height, radius) {
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    ctx.fill();
}

function drawHeader(calendarData) {
    ctx.fillStyle = config.colors.headerBg;
    drawRoundRect(config.padding, config.padding, 125, 30, 6);
    ctx.fillStyle = config.colors.headerText;
    ctx.font = `500 13px ${config.font}`;
    ctx.textAlign = 'left';
    ctx.textBaseline = 'middle';
    const monthText =
        `${calendarData.monthName.charAt(0).toUpperCase() + calendarData.monthName.slice(1)}, ${calendarData.year} ▾`;
    ctx.fillText(monthText, config.padding + 10, config.padding + 15);

    const {
        leftButton,
        rightButton
    } = getNavButtonHitboxes();
    ctx.strokeStyle = config.colors.border;
    ctx.fillStyle = hoverTarget === 'left' ? config.colors.navButtonHoverBg : config.colors.navButtonBg;
    drawRoundRect(leftButton.x, leftButton.y, leftButton.w, leftButton.h, 6);
    ctx.stroke();
    ctx.fillStyle = hoverTarget === 'right' ? config.colors.navButtonHoverBg : config.colors.navButtonBg;
    drawRoundRect(rightButton.x, rightButton.y, rightButton.w, rightButton.h, 6);
    ctx.stroke();
    ctx.fillStyle = config.colors.text;
    ctx.font = `bold 14px ${config.font}`;
    ctx.textAlign = 'center';
    ctx.fillText('←', leftButton.x + leftButton.w / 2, leftButton.y + leftButton.h / 2 + 1);
    ctx.fillText('→', rightButton.x + rightButton.w / 2, rightButton.y + rightButton.h / 2 + 1);
}

function drawGrid(calendarData) {
    const {
        year,
        month,
        firstDayOffset,
        daysInMonth,
        daysInPrevMonth
    } = calendarData;
    const gridTop = config.padding + config.headerHeight;
    const cellWidth = (config.width - 2 * config.padding) / 7;
    const availableGridHeight = config.height - gridTop - config.padding;
    const totalCells = firstDayOffset + daysInMonth;
    const numRows = Math.ceil(totalCells / 7);
    const cellHeight = availableGridHeight / (numRows + 1);

    const weekdays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    ctx.fillStyle = config.colors.lightText;
    ctx.font = `500 12px ${config.font}`;
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    weekdays.forEach((day, i) => {
        const x = config.padding + i * cellWidth + cellWidth / 2;
        const y = gridTop + config.weekdaysHeight / 2 - 5;
        ctx.fillText(day, x, y);
    });

    const events = eventsByMonth[`${year}-${month}`] || {};
    const dayCellSize = Math.min(cellWidth, cellHeight) - config.gridGap - 4;

    for (let i = 0; i < numRows * 7; i++) {
        const col = i % 7;
        const row = Math.floor(i / 7);
        const x = config.padding + col * cellWidth + cellWidth / 2;
        const y = gridTop + config.weekdaysHeight - 5 + row * cellHeight + cellHeight / 2;

        let dayNumber, isCurrentMonth = false;
        if (i < firstDayOffset) {
            dayNumber = daysInPrevMonth - firstDayOffset + i + 1;
        } else if (i < daysInMonth + firstDayOffset) {
            dayNumber = i - firstDayOffset + 1;
            isCurrentMonth = true;
        } else {
            dayNumber = i - daysInMonth - firstDayOffset + 1;
        }

        const event = isCurrentMonth ? events[dayNumber] : null;

        if (event) drawEvent(x, y, dayCellSize, cellWidth, event);

        ctx.font = `13px ${config.font}`;
        if (event && (event.type === 'seminaire' || event.type === 'soutenance')) {
            ctx.fillStyle = config.colors.headerText;
        } else if (event && event.type === 'reunion') {
            ctx.fillStyle = config.colors.reunionText;
            ctx.font = `bold 13px ${config.font}`;
        } else if (!isCurrentMonth) {
            ctx.fillStyle = config.colors.lightText;
        } else {
            ctx.fillStyle = config.colors.text;
        }
        ctx.fillText(dayNumber, x, y);
    }
}

function drawEvent(x, y, size, cellWidth, event) {
    const radius = size / 2;
    ctx.fillStyle = config.colors[event.type] || '#000';

    if (event.type === 'reunion') {
        ctx.fillStyle = config.colors.reunionBg;
    }

    if (event.type === 'soutenance') {
        const rectX = x - cellWidth / 2;
        const rectY = y - size / 2;
        ctx.beginPath();
        if (event.range === 'start') {
            ctx.roundRect(rectX, rectY, cellWidth, size, [radius, 0, 0, radius]);
        } else if (event.range === 'end') {
            ctx.roundRect(rectX, rectY, cellWidth, size, [0, radius, radius, 0]);
        } else {
            ctx.rect(rectX, rectY, cellWidth, size);
        }
        ctx.fill();
    } else {
        ctx.beginPath();
        ctx.arc(x, y, radius, 0, 2 * Math.PI);
        ctx.fill();
    }
}

// --- Interactivity ---

function getNavButtonHitboxes() {
    const navButtonSize = 28;
    const navButtonY = config.padding + 1;
    const rightArrowX = config.width - config.padding - navButtonSize;
    const leftArrowX = rightArrowX - navButtonSize - 5;
    return {
        leftButton: {
            x: leftArrowX,
            y: navButtonY,
            w: navButtonSize,
            h: navButtonSize
        },
        rightButton: {
            x: rightArrowX,
            y: navButtonY,
            w: navButtonSize,
            h: navButtonSize
        }
    };
}

function isInside(pos, rect) {
    return pos.x > rect.x && pos.x < rect.x + rect.w && pos.y < rect.y + rect.h && pos.y > rect.y;
}

canvas.addEventListener('click', (e) => {
    const rect = canvas.getBoundingClientRect();
    const mousePos = {
        x: e.clientX - rect.left,
        y: e.clientY - rect.top
    };
    const {
        leftButton,
        rightButton
    } = getNavButtonHitboxes();

    if (isInside(mousePos, leftButton)) {
        currentDate.setMonth(currentDate.getMonth() - 1);
        drawCalendar();
    } else if (isInside(mousePos, rightButton)) {
        currentDate.setMonth(currentDate.getMonth() + 1);
        drawCalendar();
    }
});

canvas.addEventListener('mousemove', (e) => {
    const rect = canvas.getBoundingClientRect();
    const mousePos = {
        x: e.clientX - rect.left,
        y: e.clientY - rect.top
    };
    const {
        leftButton,
        rightButton
    } = getNavButtonHitboxes();

    let newHoverTarget = null;
    if (isInside(mousePos, leftButton)) newHoverTarget = 'left';
    else if (isInside(mousePos, rightButton)) newHoverTarget = 'right';

    if (newHoverTarget !== hoverTarget) {
        hoverTarget = newHoverTarget;
        drawCalendar();
    }
});

canvas.addEventListener('mouseleave', () => {
    if (hoverTarget !== null) {
        hoverTarget = null;
        drawCalendar();
    }
});

// --- Initial Draw ---
window.onload = function() {
    if (document.getElementById('calendarCanvas')) {
        drawCalendar();
    }
};
</script>