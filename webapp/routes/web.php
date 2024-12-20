<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\BookingsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/importcsv', [AirportController::class, 'importCsv']);

Route::get('/airports', [AirportController::class, 'search']);


Route::get('/search', function () {
    return view('search');
});

Route::get('/book', [BookingsController::class, 'bookview']);
Route::post('/book', [BookingsController::class, 'book']);

Route::get('/pay', function () {
    return view('pay');
});

Route::post('/pay', function () {
    return view('finish');
});

Route::post('/search', [FlightsController::class, 'search']);
