<?php

namespace App\Repositories;

use App\Models\PermintaanDana;
use App\Models\PermintaanDanaUnit;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class PermintaanDanaRepo
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
        return PermintaanDana::query()
            ->with(['permintaan_dana_units.units', 'permintaan_dana_units.master_rab_items'])
            ->latest()
            ->get()
            ->map(function ($permintaanDana) {
                $items = $permintaanDana->permintaan_dana_units->map(function ($item) {
                    $rabItem = $item->master_rab_items;

                    return [
                        'id' => $item->id,
                        'unit' => [
                            'id' => $item->units?->id,
                            'nomor_unit' => $item->units?->nomor_unit ?? '-',
                            'tipe_unit' => $item->units?->tipe_unit ?? '-',
                            'nama_jalan' => $item->units?->nama_jalan ?? '-',
                        ],
                        'rab_item' => [
                            'id' => $rabItem?->id,
                            'nama_item' => $rabItem?->nama_item ?? '-',
                            'kategori_item' => $rabItem?->kategori_item ?? '-',
                            'satuan' => $rabItem?->satuan ?? '-',
                            'qty_rab' => $rabItem?->qty_rab ?? 0,
                            'harga_satuan_rab' => $rabItem?->harga_satuan_rab ?? 0,
                        ],
                    ];
                });

                return [
                    'id' => $permintaanDana->id,
                    'nomor_permintaan' => 'PD-' . str_pad($permintaanDana->id, 5, '0', STR_PAD_LEFT),
                    'tanggal_permintaan' => $permintaanDana->created_at?->format('d M Y') ?? '-',
                    'jenis_permintaan' => $permintaanDana->jenis_permintaan,
                    'jumlah_permintaan' => $permintaanDana->jumlah_permintaan,
                    'unit_count' => $items->pluck('unit.id')->unique()->filter()->count(),
                    'items' => $items->toArray(),
                ];
            })
            ->toArray();
    }

    public static function getDetailData($id)
    {
        return PermintaanDana::query()
            ->with(['permintaan_dana_units.units', 'permintaan_dana_units.master_rab_items'])
            ->findOrFail($id);
    }

    public static function getUnitOptions()
    {
        return Unit::query()
            ->with(['master_rabs.master_rab_items'])
            ->orderBy('nomor_unit')
            ->get();
    }

    public static function storeData($data)
    {
        return DB::transaction(function () use ($data) {
            $permintaanDana = PermintaanDana::create([
                'jenis_permintaan' => $data['jenis_permintaan'],
                'jumlah_permintaan' => $data['jumlah_permintaan'],
            ]);

            foreach ($data['items'] as $item) {
                PermintaanDanaUnit::create([
                    'permintaan_dana_id' => $permintaanDana->id,
                    'unit_id' => $data['unit_id'],
                    'master_rab_item_id' => $item['master_rab_item_id'],
                ]);
            }

            return true;
        });
    }

    public static function updateData($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $permintaanDana = PermintaanDana::findOrFail($id);
            $permintaanDana->update([
                'jenis_permintaan' => $data['jenis_permintaan'],
                'jumlah_permintaan' => $data['jumlah_permintaan'],
            ]);

            PermintaanDanaUnit::where('permintaan_dana_id', $permintaanDana->id)->delete();

            foreach ($data['items'] as $item) {
                PermintaanDanaUnit::create([
                    'permintaan_dana_id' => $permintaanDana->id,
                    'unit_id' => $data['unit_id'],
                    'master_rab_item_id' => $item['master_rab_item_id'],
                ]);
            }

            return true;
        });
    }

    public static function deleteData($id)
    {
        return DB::transaction(function () use ($id) {
            PermintaanDanaUnit::where('permintaan_dana_id', $id)->delete();
            PermintaanDana::findOrFail($id)->delete();

            return true;
        });
    }
}
