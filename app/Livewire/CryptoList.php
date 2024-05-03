<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CryptoList extends Component
{
    public $cryptos;
    public $selectedCryptoId;

    public function mount()
    {
        $this->loadCryptos();
    }

    public function loadCryptos()
    {

        $this->cryptos = (new \App\Services\CryptoService())->takeCrypto();
    }

    public function render()
    {
        return view('livewire.crypto-list', ['cryptos' => $this->cryptos]);
    }

}
