<?php

use App\Livewire\CoinIndex;
use App\Livewire\CoinShow;
use Illuminate\Support\Facades\Route;


Route::get('/coins', function () {
    return view('welcome');
});
Route::get('/coin/{id}', function () {
    return view('coin.details');
})->name('coin.show');
