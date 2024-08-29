<?php

use App\Http\Controllers\ScannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix("/v1")->group(function(){

    Route::post('/valiadar-acceso/{id_zona}/{codigo_puerta}/{lado}', [ScannerController::class,"validarAcceso"]);

});
