<?php

use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\KawasanHunian\CreateKawasan;
use App\Livewire\KawasanHunian\DataKawasan;
use Illuminate\Support\Facades\Route;


Route::livewire('/', DashboardIndex::class)->name('dashboard');
Route::prefix('kawasan')->group(function () {
    Route::name('kawasan.')->group(function () {
        Route::livewire('/data', DataKawasan::class)->name('data');
        Route::livewire('/create', CreateKawasan::class)->name('create');
    });
});