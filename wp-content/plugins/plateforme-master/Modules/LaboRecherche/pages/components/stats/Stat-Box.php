<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(460px, 1fr));
    gap: 20px;
    margin: 30px 0;
    width: 100%;
    max-width: 1200px;
}

.card-stats {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    position: relative;
}

.card-stats .header {
    font-weight: 700;
    font-size: 20px;
    color: #2A2916;
    margin-bottom: 20px;
}

.chart-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.chart-pie,
.chart-donut,
.chart-bar {
    position: relative;
}

.chart-pie canvas,
.chart-donut canvas {
    width: 120px !important;
    height: 120px !important;
}

.chart-pie.large canvas {
    width: 220px !important;
    height: 220px !important;
}

.chart-bar canvas {
    width: 100% !important;
    height: 300px !important;
}

.chart-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    font-size: 18px;
    color: #2A2916;
}

.bl-stat {
    gap: 20px;
    display: grid;
}
</style>


<div class="stats-grid">
    <!-- Financements -->
    <div class="card-stats" style="margin-right: 11px;">
        <div class="header">Financements</div>
        <div class="chart-row">
            <div class="chart-pie large">
                <canvas id="mainFinancementChart"></canvas>
            </div>
            <div class="chart-pie"><canvas id="donut1"></canvas></div>
            <div class="bl-stat">
                <div class="chart-donut"><canvas id="donut2"></canvas></div>
                <div class="chart-donut"><canvas id="donut3"></canvas></div>
            </div>
        </div>
    </div>

    <!-- Avancement -->
    <div class="card-stats" style=" margin-left: -11px;">
        <div class="header">Répartition par type des publications <span
                style="float:right; color:#333; font-weight:700;">63%</span></div>
        <div class="chart-bar">
            <canvas id="etatProjetsChart"></canvas>
        </div>
    </div>
</div>

<script>
// Data simulations
const financementData = [60]; // 60% funded
const donutData1 = [15, 85];
const donutData2 = [1, 2, 3, 4];
const donutData3 = [3, 2, 1, 4];

// Main pie chart for funding
new Chart(document.getElementById('mainFinancementChart'), {
    type: 'pie',
    data: {
        labels: ['Financé', 'Restant'],
        datasets: [{
            data: [financementData[0], 100 - financementData[0]],
            backgroundColor: ['#bc0503', '#e5e7eb'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: ctx => `${ctx.label} : ${ctx.raw}%`
                }
            },
            datalabels: {
                color: ctx => ctx.dataIndex === 0 ? '#ffffff' : '#000000',
                font: {
                    size: 16,
                    weight: 'bold'
                },
                formatter: value => value + '%'
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Secondary donut charts
const donutConfigs = [{
        id: 'donut2',
        data: donutData2,
        colors: ['#ddaca7', '#ffd54f', '#6e6d55', '#a6a485']
    },
    {
        id: 'donut3',
        data: donutData3,
        colors: ['#ffaa00', '#ffd54f', '#bf0404', '#cb9042']
    }
];

donutConfigs.forEach(cfg => {
    new Chart(document.getElementById(cfg.id), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: cfg.data,
                backgroundColor: cfg.colors,
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        }
    });
});

// donut1 => pie chart
new Chart(document.getElementById('donut1'), {
    type: 'pie',
    data: {
        labels: ['Part 1', 'Part 2'],
        datasets: [{
            data: [15, 85], // example
            backgroundColor: ['#B00000', '#ECEBE3'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: ctx => `${ctx.label} : ${ctx.raw}%`
                }
            },
            datalabels: {
                color: ctx => ctx.dataIndex === 0 ? '#ffffff' : '#000000',
                font: {
                    size: 14,
                    weight: 'bold'
                },
                formatter: value => value + '%'
            }
        }
    },
    plugins: [ChartDataLabels]
});

// ✅ (MODIFIED) Stacked Bar Chart for Publications, matching the design
const ctxBar = document.getElementById('etatProjetsChart').getContext('2d');

// Custom plugin to draw labels exactly as in the image
const customLabelsPlugin = {
    id: 'customBarLabels',
    afterDatasetsDraw(chart, args, options) {
        const {
            ctx,
            data,
            chartArea: {
                bottom,
                top
            },
            scales: {
                x,
                y
            }
        } = chart;
        const totalValue = y.max;

        ctx.save();

        const acceptedData = data.datasets[0].data;

        acceptedData.forEach((value, index) => {
            const percentage = Math.round((value / totalValue) * 100);
            const barMeta = chart.getDatasetMeta(0).data[index];

            const barX = barMeta.x;
            // Position the dot at the top of the bar, or at the bottom if the value is 0
            const dotY = (value === 0) ? bottom : barMeta.y;

            // --- Draw Dot ---
            ctx.beginPath();
            ctx.arc(barX, dotY, 3.5, 0, 2 * Math.PI);
            ctx.fillStyle = '#2A2916';
            ctx.fill();

            // --- Draw Connector Line ---
            // Line position calculations
            const lineEndY = dotY - 30;
            const lineEndX = barX + 25;

            ctx.beginPath();
            ctx.moveTo(barX, dotY);
            ctx.lineTo(barX, lineEndY); // Vertical part
            ctx.lineTo(lineEndX, lineEndY); // Horizontal part
            ctx.strokeStyle = '#6e6d55';
            ctx.lineWidth = 1;
            ctx.stroke();

            // --- Draw Text ---
            ctx.fillStyle = '#2A2916';
            ctx.font = 'bold 12px sans-serif';
            ctx.textAlign = 'left';
            ctx.textBaseline = 'middle';
            const textX = lineEndX + 5;
            const textY = lineEndY;

            ctx.fillText(`${percentage}%`, textX, textY - 6);
            ctx.font = '11px sans-serif';
            ctx.fillText('Acceptés', textX, textY + 8);
        });

        ctx.restore();
    }
};

// Data for the publications chart
const totalPublications = 20;
const acceptedPublications = [12, 5, 0]; // Corresponds to 60%, 25%, 0%
const remainingPublications = acceptedPublications.map(d => totalPublications - d);

// Bar gradient color
const gradient = ctxBar.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, '#B00000');
gradient.addColorStop(1, '#800000');

new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Article', 'Rapport', 'Présentation'],
        datasets: [{
            label: 'Acceptés',
            data: acceptedPublications,
            backgroundColor: gradient,
        }, {
            label: 'Restant',
            data: remainingPublications,
            backgroundColor: '#e5e7eb',
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        barPercentage: 0.4,
        scales: {
            x: {
                stacked: true,
                grid: {
                    display: false
                },
                border: {
                    display: false
                }
            },
            y: {
                stacked: true,
                beginAtZero: true,
                max: totalPublications,
                grid: {
                    color: '#f0f0f0'
                },
                border: {
                    display: false
                },
                ticks: {
                    stepSize: 5,
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            // Disable default datalabels for this chart
            datalabels: {
                display: false
            },
            tooltip: {
                enabled: false // Disabled to match the clean look of the image
            }
        }
    },
    // Register the custom plugin
    plugins: [customLabelsPlugin]
});
</script>