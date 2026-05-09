<?php

use App\Http\Controllers\PembangunanUnitController;
use App\Http\Controllers\PembiayaanController;
use App\Http\Controllers\RabController;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\MasterKawasan\MasterKawasanCreate;
use App\Livewire\MasterKawasan\MasterKawasanData;
use App\Livewire\MasterPembangunanUnit\MasterPembangunanUnitCreate;
use App\Livewire\MasterPembangunanUnit\MasterPembangunanUnitData;
use App\Livewire\MasterPembangunanUnit\MasterPembangunanUnitDetail;
use App\Livewire\MasterPembangunanUnit\MasterPembangunanUnitEdit;
use App\Livewire\Pembiayaan\PembiayaanCreate;
use App\Livewire\Pembiayaan\PembiayaanData;
use App\Livewire\Pembiayaan\PembiayaanDetail;
use App\Livewire\Pembiayaan\PembiayaanEdit;
use App\Livewire\PermintaanDana\PermintaanDanaCreate;
use App\Livewire\PermintaanDana\PermintaanDanaData;
use App\Livewire\PermintaanDana\PermintaanDanaEdit;
use App\Livewire\PurchaseOrder\PurchaseOrderCreate;
use App\Livewire\PurchaseOrder\PurchaseOrderData;
use App\Livewire\PurchaseOrder\PurchaseOrderEdit;
use App\Livewire\Rab\CreateRab;
use App\Livewire\Rab\DataRab;
use App\Livewire\Rab\DetailRab;
use App\Livewire\Rab\EditRab;
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
        Route::get('/dt', [PembiayaanController::class, 'index'])->name('dt');
        Route::livewire('/data', PembiayaanData::class)->name('data');
        Route::livewire('/create', PembiayaanCreate::class)->name('create');
        Route::livewire('/edit/{id}', PembiayaanEdit::class)->name('edit');
        Route::livewire('/detail/{id}', PembiayaanDetail::class)->name('detail');
    });
});

Route::prefix('rab')->group(function () {
    Route::name('rab.')->group(function () {
        Route::get('/datatable', [RabController::class, 'dataDt'])->name('Dt');
        Route::livewire('/data', DataRab::class)->name('data');
        Route::livewire('/create', CreateRab::class)->name('create');
        Route::livewire('/detail/{id}', DetailRab::class)->name('detail');
        Route::livewire('/edit/{id}', EditRab::class)->name('edit');
    });
});

Route::prefix('unit')->group(function () {
    Route::name('unit.')->group(function () {
        Route::get('/dt', [PembangunanUnitController::class, 'index'])->name('dt');
        Route::livewire('/data', MasterPembangunanUnitData::class)->name('data');
        Route::livewire('/create', MasterPembangunanUnitCreate::class)->name('create');
        Route::livewire('/edit/{id}', MasterPembangunanUnitEdit::class)->name('edit');
        Route::livewire('/detail/{id}', MasterPembangunanUnitDetail::class)->name('detail');
    });
});

Route::prefix('purchase-order')->group(function () {
    Route::name('purchase-order.')->group(function () {
        Route::livewire('/data', PurchaseOrderData::class)->name('data');
        Route::livewire('/created', PurchaseOrderCreate::class)->name('create');
        Route::livewire('/edit/{id}', PurchaseOrderEdit::class)->name('edit');
    });
});

Route::prefix('permintaan-dana')->group(function () {
    Route::name('permintaan-dana.')->group(function () {
        Route::livewire('/data', PermintaanDanaData::class)->name('data');
        Route::livewire('/create', PermintaanDanaCreate::class)->name('create');
        Route::livewire('/edit/{id}', PermintaanDanaEdit::class)->name('edit');
    });
});
