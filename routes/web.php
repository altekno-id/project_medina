<?php

use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\MasterKawasan\MasterKawasanCreate;
use App\Livewire\MasterKawasan\MasterKawasanData;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::livewire('/', DashboardIndex::class)->name('dashboard');
Route::prefix('kawasan')->group(function () {
    Route::name('kawasan.')->group(function () {
        Route::livewire('/data', MasterKawasanData::class)->name('data');
        Route::livewire('/create', MasterKawasanCreate::class)->name('create');
    });
});
