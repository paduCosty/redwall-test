<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    header {
        padding: 20px;
        background-color: #007bff;
        color: white;
        text-align: center;
        margin-bottom: 20px;
    }

    .container {
        max-width: 800px;
        margin: auto;
    }

    .crypto-details {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .crypto-details h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .crypto-details ul li {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }
</style>

<header>
    <h1>Cryptocurrency Details</h1>
</header>

<div class="container">
    <canvas id="coinChart" width="400" height="300"></canvas>

    <form id="filterForm" class="mt-3">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="{{ $filters['start_date'] }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" value="{{ $filters['end_date'] }}">
            </div>

            <div class="col-md-3">
                <select name="frequency" class="form-control">
                    <option value="daily">Zilnic</option>
                    <option value="weekly">Săptămânal</option>
                    <option value="monthly">Lunar</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary btn-block">Filtrează</button>
            </div>
            <div class="">
                <button type="button" class="btn btn-danger btn-block" name='reset_filters'>Reset Filters</button>
            </div>
        </div>

    </form>

    <div class="crypto-details">
        <h2>{{ $crypto['name'] }}</h2>
        <ul>
            <li><strong>Symbol:</strong> {{ $crypto['symbol'] }}</li>
            <li><strong>Price (USD):</strong> ${{ number_format($crypto['market_data']['current_price']['usd'], 2) }}
            </li>
            <li><strong>Market Cap (USD):</strong> ${{ number_format($crypto['market_data']['market_cap']['usd'], 2) }}
            </li>
            <li><strong>24h Change:</strong> {{ $crypto['market_data']['price_change_percentage_24h'] }}%</li>
            <li><strong>Price Change (24h):</strong> ${{ number_format($crypto['market_data']['price_change_24h'], 2) }}
            </li>
        </ul>
    </div>
</div>

<script>
    var ctx = document.getElementById('coinChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($years) !!},
            datasets: [{
                label: ' ',
                data: {!! json_encode($values) !!},
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
    });

    document.addEventListener('DOMContentLoaded', function() {
        var resetButton = document.querySelector('button[name="reset_filters"]');
        var filterForm = document.getElementById('filterForm');

        resetButton.addEventListener('click', function() {
            document.querySelector('input[name="start_date"]').value = '';
            document.querySelector('input[name="end_date"]').value = '';

            window.location.href = window.location.pathname;
        });

        filterForm.addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(filterForm);
            var params = new URLSearchParams(formData).toString();

            var frequency = document.querySelector('select[name="frequency"]').value;
            params += '&frequency=' + frequency;

            window.location.href = window.location.pathname + '?' + params;
        });
    });
</script>
