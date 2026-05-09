<?php

namespace App\Repositories;

use App\Models\MasterBank;
use App\Models\MasterKawasan;
use App\Models\MasterRab;
use App\Models\MasterRabItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PermintaanDana;
use App\Models\Unit;
use App\Models\UnitProgres;
use Illuminate\Support\Facades\Schema;

class DashboardRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getData(): array
    {
        if (! Schema::hasTable('master_rab_items')) {
            return [
                'summary' => [
                    'kawasan' => 0,
                    'unit' => 0,
                    'rab' => 0,
                    'bank' => 0,
                    'purchase_order' => 0,
                    'permintaan_dana' => 0,
                ],
                'finance' => [
                    'total_unit' => 0,
                    'total_rab' => 0,
                    'total_purchase_order' => 0,
                    'total_permintaan_dana' => 0,
                ],
                'progress' => [
                    'total' => 0,
                    'cair' => 0,
                    'belum_cair' => 0,
                    'persen_cair' => 0,
                ],
                'latest_purchase_orders' => [],
                'latest_permintaan_danas' => [],
                'unit_terbaru' => [],
            ];
        }

        $totalRab = MasterRabItem::query()
            ->get()
            ->sum(fn ($item) => (float) $item->qty_rab * (float) $item->harga_satuan_rab);

        $totalPurchaseOrder = OrderItem::query()
            ->whereHas('order_units.orders', fn ($query) => $query->where('tipe_order', 'PO'))
            ->sum('subtotal');

        $unitProgressTotal = UnitProgres::count();
        $unitProgressCair = UnitProgres::where('status_pencarian', true)->count();

        return [
            'summary' => [
                'kawasan' => MasterKawasan::count(),
                'unit' => Unit::count(),
                'rab' => MasterRab::count(),
                'bank' => MasterBank::count(),
                'purchase_order' => Order::where('tipe_order', 'PO')->count(),
                'permintaan_dana' => PermintaanDana::count(),
            ],
            'finance' => [
                'total_unit' => Unit::sum('harga_unit'),
                'total_rab' => $totalRab,
                'total_purchase_order' => $totalPurchaseOrder,
                'total_permintaan_dana' => PermintaanDana::sum('jumlah_permintaan'),
            ],
            'progress' => [
                'total' => $unitProgressTotal,
                'cair' => $unitProgressCair,
                'belum_cair' => max($unitProgressTotal - $unitProgressCair, 0),
                'persen_cair' => $unitProgressTotal > 0 ? round(($unitProgressCair / $unitProgressTotal) * 100) : 0,
            ],
            'latest_purchase_orders' => Order::query()
                ->with('order_units.order_items')
                ->where('tipe_order', 'PO')
                ->latest()
                ->limit(5)
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'nomor_order' => $order->nomor_order,
                        'tanggal_order' => date('d M Y', strtotime($order->tanggal_order)),
                        'total_order' => $order->order_units->flatMap->order_items->sum('subtotal'),
                    ];
                })
                ->toArray(),
            'latest_permintaan_danas' => PermintaanDana::query()
                ->latest()
                ->limit(5)
                ->get()
                ->map(function ($permintaanDana) {
                    return [
                        'id' => $permintaanDana->id,
                        'nomor_permintaan' => 'PD-' . str_pad($permintaanDana->id, 5, '0', STR_PAD_LEFT),
                        'jenis_permintaan' => $permintaanDana->jenis_permintaan,
                        'jumlah_permintaan' => $permintaanDana->jumlah_permintaan,
                        'tanggal_permintaan' => $permintaanDana->created_at?->format('d M Y') ?? '-',
                    ];
                })
                ->toArray(),
            'unit_terbaru' => Unit::query()
                ->with(['master_kawasans', 'master_rabs'])
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
                ->toArray(),
        ];
    }
}
