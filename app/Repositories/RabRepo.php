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
            // inject user (kayak contoh dosen)
            $dtRab['user_login_id'] = Auth::id() ?? 1;
            $dtRab['user_client_id'] = Auth::user()->user_client_id ?? 1;

            // 1. create master
            $rab = MasterRab::create($dtRab);
            $rabId = $rab->id;

            // 2. loop items
            foreach ($dtItems as $item) {

                $item['master_rab_id'] = $rabId;
                $item['user_client_id'] = $dtRab['user_client_id'];

                // WAJIB insert, bukan create (karena model error)
                MasterRabItem::insert([
                    'master_rab_id' => $item['master_rab_id'],
                    'user_client_id' => $item['user_client_id'],
                    'nama_item' => $item['nama_item'],
                    'kategori_item' => $item['kategori_item'],
                    'satuan' => $item['satuan'],
                    'qty_rab' => $item['qty_rab'],
                    'harga_satuan_rab' => $item['harga_satuan_rab'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
