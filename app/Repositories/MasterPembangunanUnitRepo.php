<?php

namespace App\Repositories;

use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MasterPembangunanUnitRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function storeDt($data)
    {
        try {
            return DB::transaction(function () use ($data) {
                Unit::create([
                    'master_kawasan_id' => $data['master_kawasan_id'],
                    'master_kawasan_sub_id' => $data['master_kawasan_sub_id'],
                    'master_kawasan_sub_blok_id' => $data['master_kawasan_sub_blok_id'],
                    'master_rab_id' => $data['master_rab_id'],
                    'master_bank_id' => $data['master_bank_id'],
                    'nama_jalan' => $data['nama_jalan'],
                    'nomor_unit' => $data['nomor_unit'],
                    'tipe_unit' => $data['tipe_unit'],
                    'harga_unit' => $data['harga_unit'],
                ]);

                return true;
            });
        } catch (Exception $e) {
            Log::info('Gagal simpan data: ' . $e->getMessage());
            return false;
        }
    }

    public static function updateDt($id, $data)
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $unit = Unit::findOrFail($id);

                $unit->update([
                    'master_kawasan_id' => $data['master_kawasan_id'],
                    'master_kawasan_sub_id' => $data['master_kawasan_sub_id'],
                    'master_kawasan_sub_blok_id' => $data['master_kawasan_sub_blok_id'],
                    'master_rab_id' => $data['master_rab_id'],
                    'master_bank_id' => $data['master_bank_id'],
                    'nama_jalan' => $data['nama_jalan'],
                    'nomor_unit' => $data['nomor_unit'],
                    'tipe_unit' => $data['tipe_unit'],
                    'harga_unit' => $data['harga_unit'],
                ]);

                return true;
            });
        } catch (\Exception $e) {
            Log::info('Gagal simpan data: ' . $e->getMessage());
            return false;
        }
    }

    public static function deleteDt($id)
    {
        return Unit::findOrFail($id)->delete();
    }

    public static function getDt()
    {
        $data = Unit::query()->with([
            'master_kawasans',
            'master_kawasan_subs',
            'master_kawasan_sub_bloks',
            'master_rabs',
            'master_banks'
        ]);

        return $data;
    }

    public static function getDetailDt($id)
    {
        $data = Unit::query()->with([
            'master_kawasans',
            'master_kawasan_subs',
            'master_kawasan_sub_bloks',
            'master_rabs',
            'master_banks'
        ])->findOrFail($id);

        return $data;
    }
}
