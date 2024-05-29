<?php

namespace App\Livewire;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Livewire\Component;

class CoinShow extends Component
{
    public $coin;
    public $filters = [];
    public $years;
    public $values;

    public function mount($id, $start_date = null, $end_date = null, $frequency = null)
    {
        $startDate = request()->start_date ?? date('Y-m-d', strtotime('-1 year', strtotime(date('Y-m-d'))));
        $endDate = request()->end_date ?? date('Y-m-d');

        $frequency = request()->frequency ?? '';
        $this->filters = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'frequency' => $frequency,
        ];

        $startDateUnix = strtotime($startDate);
        $endDateUnix = strtotime($endDate);

        $client = new CoinGeckoClient();
        $response = $client->coins()->getMarketChartRange($id, 'usd', $startDateUnix, $endDateUnix);
        $prices = $response['prices'];

        $data = $this->processChartData($prices, $frequency);

        $this->years = $data['labels'];
        $this->values = $data['values'];

        $this->coin = $client->coins()->getCoin($id);
    }

    public function render()
    {
        return view('livewire.coin-show');
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
}
