<div>

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cryptocurrency List</title>
        <style>
            /* Stilurile pentru tabel */
            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }

            th,
            td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            /* Stilurile pentru antet */
            header {
                padding: 20px;
                background-color: #333;
                color: white;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header>
            <h1>Top 100 Cryptocurrencies</h1>
        </header>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Price (USD)</th>
                    <th>Market Cap (USD)</th>
                    <th>24h Change</th>
                    <th>Price Change (24h)</th>
                    <th>Price Chart</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cryptos as $crypto)
                    <tr>

                        <td> <a href="{{ route('crypto.show', $crypto['id']) }}">{{ $crypto['name'] }}</td>
                        <td>{{ $crypto['symbol'] }}</td>
                        <td>${{ number_format($crypto['current_price'], 2) }}</td>
                        <td>${{ number_format($crypto['market_cap'], 2) }}</td>
                        <td>{{ $crypto['price_change_percentage_24h'] }}%</td>
                        <td>{{ $crypto['price_change_24h'] }}</td>
                        <td>
                            @if ($crypto['price_change_percentage_24h'] > 0)
                                <i class="fas fa-arrow-up" style="color: green;"></i>
                            @elseif ($crypto['price_change_percentage_24h'] < 0)
                                <i class="fas fa-arrow-down" style="color: red;"></i>
                            @else
                                <i class="fas fa-minus text-gray-500"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>
