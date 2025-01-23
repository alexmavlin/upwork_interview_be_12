<?php

use App\Http\Controllers\GetPetsListController;
use App\Http\Controllers\SquareGridController;
use Illuminate\Support\Facades\Route;

Route::get('/get-pets-list', GetPetsListController::class);

Route::get('/get-initial-state', [SquareGridController::class, 'getInitialState']);
Route::post('/update-state', [SquareGridController::class, 'updateState']);