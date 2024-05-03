<?php

use App\Http\Controllers\CoinController;
use Illuminate\Support\Facades\Route;

Route::get('/crypto', [CoinController::class, 'index']);
Route::get('/crypto/{id}', [CoinController::class, 'show'])->name('crypto.show');
