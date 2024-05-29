<div x-data="{ chart: null }" x-init="chart = new Chart(document.getElementById('coin-chart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: $wire.labels,
        datasets: [{
            label: $wire.name,
            data: $wire.dataPoint,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        }

    }
});">
    <canvas id="coin-chart" width="400" height="400"></canvas>
</div>
