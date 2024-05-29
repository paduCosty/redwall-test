<?php

namespace App\Livewire;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Livewire\Component;

class CoinIndex extends Component
{
    public $coins;

    public function mount()
    {
        $client = new CoinGeckoClient();
        $this->coins = $client->coins()->getMarkets('usd', [
            'order' => 'market_cap_desc',
            'per_page' => 100,
            'page' => 1,
        ]);

    }

    public function render()
    {
        return view('livewire.coin-index');
    }
}
