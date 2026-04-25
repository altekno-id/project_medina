<?php

namespace App\Repositories;

use App\Models\MasterRab;
use App\Models\MasterRabItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RabRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store($dtRab, $dtItems)
    {
        DB::beginTransaction();
        try {
            $rab = MasterRab::create($dtRab);
            $rabId = $rab->id;
            foreach ($dtItems as $item) {

                MasterRabItem::create([
                    'master_rab_id' => $rabId,
                    'user_client_id' => Auth::user()->user_client_id ?? 1,
                    'nama_item' => $item['nama_item'],
                    'kategori_item' => $item['kategori_item'],
                    'satuan' => $item['satuan'],
                    'qty_rab' => $item['qty_rab'],
                    'harga_satuan_rab' => $item['harga_satuan_rab'],
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }
    }
}
