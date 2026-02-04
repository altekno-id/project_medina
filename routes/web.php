<?php

use App\Livewire\Dashboard\DashboardIndex;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::livewire('/', DashboardIndex::class)->name('dashboard');