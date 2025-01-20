<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PaymentsController;

Route::get('/', function () { return view('welcome'); });

Route::get('/checkin', function () { return view('checkin'); });

Route::get('/importcsv', [AirportController::class, 'importCsv']);

Route::get('/airports', [AirportController::class, 'search']);


Route::get('/search', function () { return view('search'); });
Route::post('/search', [FlightsController::class, 'search']);

Route::get('/book', [BookingsController::class, 'bookview']);
Route::post('/book', [BookingsController::class, 'book']);

Route::get('/pay', [PaymentsController::class, 'payview']);
Route::post('/pay', [PaymentsController::class, 'pay']);


