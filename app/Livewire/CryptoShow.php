<?php

namespace App\Livewire;

use App\Services\CryptoService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CryptoShow extends Component
{
    public $crypto;
    public $selectedCryptoId;

    public function mount()
    {
        $this->loadCrypto();
    }

    public function loadCrypto()
    {
        dd($this->selectedCryptoId);

        $this->crypto = (new \App\Services\CryptoService())->takeCrypto($this->selectedCryptoId);
    }

    public function render()
    {
        return view('livewire.crypto-show', ['crypto' => $this->crypto]);
    }

}
