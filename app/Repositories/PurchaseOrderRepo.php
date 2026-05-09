<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderUnit;
use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseOrderRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getDt()
    {
        return Order::query()
            ->where('tipe_order', 'PO')
            ->with([
                'order_units.units.master_rabs.master_rab_items',
                'order_units.order_items.master_rab_items',
            ])
            ->latest();
    }

    public static function getList()
    {
        return self::getDt()->get();
    }

    public static function getDetail($id)
    {
        return self::getDt()->findOrFail($id);
    }

    public static function getListForView(): array
    {
        return self::getList()->map(function ($order) {
            return self::formatOrderForView($order);
        })->toArray();
    }

    public static function getUnitOptions()
    {
        return Unit::query()
            ->with(['master_rabs.master_rab_items'])
            ->orderBy('nomor_unit')
            ->get();
    }

    public static function getUnitDetail($id)
    {
        return Unit::query()
            ->with(['master_rabs.master_rab_items'])
            ->find($id);
    }

    public static function formatOrderForView($order): array
    {
        $orderUnit = $order->order_units->first();
        $unit = $orderUnit?->units;
        $rab = $unit?->master_rabs;
        $items = $orderUnit?->order_items ?? collect();
        $totalRab = $rab?->master_rab_items?->sum(function ($item) {
            return (float) $item->qty_rab * (float) $item->harga_satuan_rab;
        }) ?? 0;

        return [
            'id' => $order->id,
            'nomor_order' => $order->nomor_order,
            'tanggal_order' => $order->tanggal_order,
            'tipe_order' => $order->tipe_order,
            'status_order' => $order->status_order,
            'status_label' => self::statusLabel($order->status_order),
            'catatan' => $order->catatan,
            'unit' => [
                'id' => $unit?->id,
                'nomor_unit' => $unit?->nomor_unit ?? '-',
                'tipe_unit' => $unit?->tipe_unit ?? '-',
            ],
            'rab' => [
                'id' => $rab?->id,
                'nama_master_rab' => $rab?->nama_master_rab ?? '-',
                'total_rab' => $totalRab,
            ],
            'items' => $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'master_rab_item_id' => $item->master_rab_item_id,
                    'nama_item' => $item->master_rab_items?->nama_item ?? '-',
                    'kategori_item' => $item->master_rab_items?->kategori_item ?? '-',
                    'satuan' => $item->master_rab_items?->satuan ?? '-',
                    'qty_rab' => $item->master_rab_items?->qty_rab ?? 0,
                    'qty' => $item->qty,
                    'harga_satuan' => $item->harga_satuan,
                    'subtotal' => $item->subtotal,
                ];
            })->toArray(),
            'total_order' => $items->sum('subtotal'),
        ];
    }

    public static function formData($id): array
    {
        $order = self::getDetail($id);
        $orderUnit = $order->order_units->first();

        return [
            'nomor_order' => $order->nomor_order,
            'tanggal_order' => date('Y-m-d', strtotime($order->tanggal_order)),
            'status_order' => $order->status_order,
            'catatan' => $order->catatan,
            'unit_id' => $orderUnit?->unit_id ?? '',
            'items' => $orderUnit?->order_items->map(function ($item) {
                return [
                    'master_rab_item_id' => $item->master_rab_item_id,
                    'nama_item' => $item->master_rab_items?->nama_item ?? '-',
                    'kategori_item' => $item->master_rab_items?->kategori_item ?? '-',
                    'satuan' => $item->master_rab_items?->satuan ?? '-',
                    'qty_rab' => $item->master_rab_items?->qty_rab ?? 0,
                    'qty' => $item->qty,
                    'harga_satuan' => $item->harga_satuan,
                ];
            })->toArray() ?? [],
        ];
    }

    public static function statusLabel($status): string
    {
        return match ((int) $status) {
            1 => 'Diproses',
            2 => 'Selesai',
            default => 'Draft',
        };
    }

    public static function store($data, $items)
    {
        try {
            return DB::transaction(function () use ($data, $items) {
                $userClientId = Auth::check() ? Auth::user()->user_client_id : 1;
                $userLoginId = Auth::check() ? Auth::user()->user_login_id : 1;

                $order = Order::create([
                    'user_client_id' => $userClientId,
                    'user_login_id' => $userLoginId,
                    'nomor_order' => $data['nomor_order'],
                    'tanggal_order' => $data['tanggal_order'],
                    'tipe_order' => 'PO',
                    'status_order' => $data['status_order'] ?? 0,
                    'catatan' => $data['catatan'] ?? null,
                ]);

                $orderUnit = OrderUnit::create([
                    'user_client_id' => $userClientId,
                    'order_id' => $order->id,
                    'unit_id' => $data['unit_id'],
                ]);

                foreach ($items as $item) {
                    $qty = (float) ($item['qty'] ?? 0);
                    $hargaSatuan = (float) ($item['harga_satuan'] ?? 0);

                    OrderItem::create([
                        'user_client_id' => $userClientId,
                        'order_unit_id' => $orderUnit->id,
                        'master_rab_item_id' => $item['master_rab_item_id'],
                        'qty' => $qty,
                        'harga_satuan' => $hargaSatuan,
                        'subtotal' => $qty * $hargaSatuan,
                    ]);
                }

                return true;
            });
        } catch (Exception $e) {
            Log::info('Gagal simpan purchase order: ' . $e->getMessage());

            return false;
        }
    }

    public static function update($id, $data, $items)
    {
        try {
            return DB::transaction(function () use ($id, $data, $items) {
                $userClientId = Auth::check() ? Auth::user()->user_client_id : 1;

                $order = Order::findOrFail($id);
                $order->update([
                    'nomor_order' => $data['nomor_order'],
                    'tanggal_order' => $data['tanggal_order'],
                    'status_order' => $data['status_order'] ?? 0,
                    'catatan' => $data['catatan'] ?? null,
                ]);

                $orderUnit = OrderUnit::firstOrCreate(
                    ['order_id' => $order->id],
                    [
                        'user_client_id' => $userClientId,
                        'unit_id' => $data['unit_id'],
                    ]
                );

                $orderUnit->update([
                    'unit_id' => $data['unit_id'],
                ]);

                OrderItem::where('order_unit_id', $orderUnit->id)->delete();

                foreach ($items as $item) {
                    $qty = (float) ($item['qty'] ?? 0);
                    $hargaSatuan = (float) ($item['harga_satuan'] ?? 0);

                    OrderItem::create([
                        'user_client_id' => $userClientId,
                        'order_unit_id' => $orderUnit->id,
                        'master_rab_item_id' => $item['master_rab_item_id'],
                        'qty' => $qty,
                        'harga_satuan' => $hargaSatuan,
                        'subtotal' => $qty * $hargaSatuan,
                    ]);
                }

                return true;
            });
        } catch (Exception $e) {
            Log::info('Gagal update purchase order: ' . $e->getMessage());

            return false;
        }
    }

    public static function delete($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $order = Order::with('order_units.order_items')->findOrFail($id);

                foreach ($order->order_units as $orderUnit) {
                    OrderItem::where('order_unit_id', $orderUnit->id)->delete();
                    $orderUnit->delete();
                }

                $order->delete();

                return true;
            });
        } catch (Exception $e) {
            Log::info('Gagal hapus purchase order: ' . $e->getMessage());

            return false;
        }
    }
}
