<?php

namespace App\Livewire;

use Livewire\Component;

class CoinChart extends Component
{
    public $name = 'Revenue by month with Livewire';

    public $labels = [];

    public $dataPoint = [];


    public function mount($coin_name, $values, $years)
    {
        $this->name = $coin_name;
        $this->dataPoint = array_values($values);
        $this->labels = $years[0];
    }

    public function render()
    {
        return view('livewire.coin-chart');
    }
}
