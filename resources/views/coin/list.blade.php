@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="py-4">
            <h1 class="text-center">Top 100 Cryptocurrencies</h1>
        </header>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th> Nr. </th>
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
                @foreach ($cryptos as $index => $crypto)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><a href="{{ route('crypto.show', $crypto['id']) }}">{{ $crypto['name'] }}</a></td>
                        <td>{{ $crypto['symbol'] }}</td>
                        <td>${{ number_format($crypto['current_price'], 2) }}</td>
                        <td>${{ number_format($crypto['market_cap'], 2) }}</td>
                        <td>{{ $crypto['price_change_percentage_24h'] }}%</td>
                        <td>{{ $crypto['price_change_24h'] }}</td>
                        <td>
                            @if ($crypto['price_change_percentage_24h'] > 0)
                                <i class="fas fa-arrow-up text-success"></i>
                            @elseif ($crypto['price_change_percentage_24h'] < 0)
                                <i class="fas fa-arrow-down text-danger"></i>
                            @else
                                <i class="fas fa-minus text-muted"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
