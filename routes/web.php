<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/crypto', [CryptoController::class, 'index']);
Route::get('/crypto/{id}', [CryptoController::class, 'show'])->name('crypto.show');
Route::get('/crypto1/{id}', [CryptoController::class, 'show1'])->name('crypto.show1');
