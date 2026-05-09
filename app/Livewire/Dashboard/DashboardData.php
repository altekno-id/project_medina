<?php

namespace App\Livewire\Dashboard;

use App\Repositories\MasterBankRepo;
use App\Repositories\MasterKawasanRepo;
use App\Repositories\MasterPembangunanUnitRepo;
use App\Repositories\PermintaanDanaRepo;
use App\Repositories\PurchaseOrderRepo;
use App\Repositories\RabRepo;
use Livewire\Component;

class DashboardData extends Component
{
    public $summary = [];
    public $finance = [];
    public $progress = [];
    public $latestPurchaseOrders = [];
    public $latestPermintaanDanas = [];
    public $unitTerbaru = [];

    public function mount()
    {
        $kawasan = MasterKawasanRepo::getAll();
        $units = MasterPembangunanUnitRepo::getDt();
        $rabs = RabRepo::getDt();
        $banks = MasterBankRepo::getData();
        $purchaseOrders = PurchaseOrderRepo::getListForView();
        $permintaanDanas = PermintaanDanaRepo::getData();

        $rabList = $rabs->get();
        $unitList = $units->get();

        $totalRab = $rabList->sum(function ($rab) {
            return $rab->master_rab_items->sum(function ($item) {
                return (float) $item->qty_rab * (float) $item->harga_satuan_rab;
            });
        });

        $this->summary = [
            'kawasan' => $kawasan->count(),
            'unit' => $unitList->count(),
            'rab' => $rabList->count(),
            'bank' => $banks->count(),
            'purchase_order' => count($purchaseOrders),
            'permintaan_dana' => count($permintaanDanas),
        ];

        $this->finance = [
            'total_unit' => $unitList->sum('harga_unit'),
            'total_rab' => $totalRab,
            'total_purchase_order' => collect($purchaseOrders)->sum('total_order'),
            'total_permintaan_dana' => collect($permintaanDanas)->sum('jumlah_permintaan'),
        ];

        $this->progress = [
            'total' => 0,
            'cair' => 0,
            'belum_cair' => 0,
            'persen_cair' => 0,
        ];

        $this->latestPurchaseOrders = array_slice($purchaseOrders, 0, 5);
        $this->latestPermintaanDanas = array_slice($permintaanDanas, 0, 5);
        $this->unitTerbaru = MasterPembangunanUnitRepo::getDt()
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($unit) {
                return [
                    'id' => $unit->id,
                    'nomor_unit' => $unit->nomor_unit,
                    'tipe_unit' => $unit->tipe_unit ?? '-',
                    'kawasan' => $unit->master_kawasans?->nama_master_kawasan ?? '-',
                    'rab' => $unit->master_rabs?->nama_master_rab ?? '-',
                    'harga_unit' => $unit->harga_unit,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('mods.dashboard.dashboard-data');
    }
}
