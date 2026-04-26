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
    public static function update($id, $dtRab, $dtItems)
    {
        DB::beginTransaction();
        try {

            $rab = MasterRab::findOrFail($id);
            $rab->update($dtRab);

            MasterRabItem::where('master_rab_id', $id)->delete();

            foreach ($dtItems as $item) {
                MasterRabItem::create([
                    'master_rab_id' => $id,
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
    public static function delete($id)
    {
        DB::beginTransaction();
        try {
            MasterRabItem::where('master_rab_id', $id)->delete();

            MasterRab::findOrFail($id)->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }
    }
    public static function getDt()
    {
        $data = MasterRab::query()->with(['master_rab_items']);
        return $data;
    }
    public static function getDetail($id)
    {
        $data = MasterRab::query()->with(['master_rab_items'])->findOrFail($id);
        return $data;
    }
}
