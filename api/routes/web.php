<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('home');

Route::get('/section1', [SectionsController::class, 'section1'])->name('section1');
Route::get('/section2', [SectionsController::class, 'section2'])->name('section2');
Route::get('/section3', [SectionsController::class, 'section3'])->name('section3');
