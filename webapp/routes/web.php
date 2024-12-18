<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/importcsv', [AirportController::class, 'importCsv']);

Route::get('/airports', [AirportController::class, 'search']);


Route::get('/search', function () {
    return view('search');
});

Route::post('/search', [FlightsController::class, 'search']);
