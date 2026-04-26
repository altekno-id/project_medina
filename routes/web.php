<?php

use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\MasterKawasan\MasterKawasanCreate;
use App\Livewire\MasterKawasan\MasterKawasanData;
use App\Livewire\Pembiayaan\CreatePembiayaan;
use App\Livewire\Pembiayaan\DataPembiayaan;
use App\Livewire\Pembiayaan\DetailPembiayaan;
use App\Livewire\Rab\CreateRab;
use App\Livewire\Rab\DataRab;
use App\Livewire\Rab\DetailRab;
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

Route::prefix('pembiayaan')->group(function () {
    Route::name('pembiayaan.')->group(function () {
        Route::livewire('/data', DataPembiayaan::class)->name('data');
        Route::livewire('/create', CreatePembiayaan::class)->name('create');
        Route::livewire('/detail', DetailPembiayaan::class)->name('detail');
    });
});

Route::prefix('rab')->group(function () {
    Route::name('rab.')->group(function () {
        Route::get('/datatable', [KecamatanController::class, 'dataDt'])->name('Dt');
        Route::livewire('/data', DataRab::class)->name('data');
        Route::livewire('/create', CreateRab::class)->name('create');
        Route::livewire('/detail', DetailRab::class)->name('detail');
    });
});
