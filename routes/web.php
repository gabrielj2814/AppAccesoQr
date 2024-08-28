<?php

use App\Http\Controllers\ScannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scanner/{id_zona?}/{codigo_puerta?}', [ScannerController::class,"index"]);
