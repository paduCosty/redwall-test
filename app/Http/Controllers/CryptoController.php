<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


class CryptoController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    public function index()
    {
        $cryptos = $this->client->coins()->getMarkets('usd', [
            'order' => 'market_cap_desc',
            'per_page' => 100,
            'page' => 1,
        ]);

        return view('crypto.list', ['cryptos' =>  $cryptos]);
    }

    public function show(Request $request)
    {
        $startDate = $request->start_date ?? date('Y-m-d', strtotime('-1 year', strtotime(date('Y-m-d'))));
        $endDate = $request->end_date ?? date('Y-m-d');

        $frequency = $request->frequency;

        $filters = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'frequency' => $frequency,
        ];

        $startDateUnix = strtotime($startDate);
        $endDateUnix = strtotime($endDate);

        $response = $this->client->coins()->getMarketChartRange($request->id, 'usd', $startDateUnix, $endDateUnix);
        $prices = $response['prices'];

        $data = $this->processChartData($prices, $frequency);

        $years = $data['labels'];
        $values = $data['values'];

        $crypto = $this->client->coins()->getCoin($request->id);

        return view('crypto.details', compact('crypto', 'years', 'values', 'filters'));
    }

    private function processChartData($prices, $frequency)
    {
        $labels = [];
        $values = [];

        switch ($frequency) {
            case 'yearly':
                foreach ($prices as $price) {
                    $year = date('Y', $price[0] / 1000);
                    if (!in_array($year, $labels)) {
                        $labels[] = $year;
                        $values[] = $price[1];
                    }
                }
                break;
            case 'monthly':
                foreach ($prices as $price) {
                    $month = date('F Y', $price[0] / 1000);
                    if (!in_array($month, $labels)) {
                        $labels[] = $month;
                        $values[] = $price[1];
                    }
                }
                break;
            case 'weekly':
                foreach ($prices as $price) {
                    $week = 'Week ' . date('W', $price[0] / 1000) . ', ' . date('Y', $price[0] / 1000);
                    if (!in_array($week, $labels)) {
                        $labels[] = $week;
                        $values[] = $price[1];
                    }
                }
                break;
            default:
                foreach ($prices as $price) {
                    $year = date('d:m:Y', $price[0] / 1000);
                    if (!in_array($year, $labels)) {
                        $labels[] = $year;
                        $values[] = $price[1];
                    }

                }
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }


    public function show1(Request $request)
    {
        $client = new CoinGeckoClient();
        $crypto = $client->coins()->getCoin($request->id);
        return  $crypto;
    }
}
