<?php

namespace App\Repositories;

use App\Models\MasterBank;
use App\Models\MasterBankTahapan;
use Illuminate\Support\Facades\DB;

class MasterBankRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function storeData($data)
    {
        return DB::transaction(function () use ($data) {
            // $dt = $data['master_banks'];

            $masterBank = MasterBank::create([
                'nama_master_bank' => $data['nama_master_bank'],
            ]);

            foreach ($data['tahapan'] as $tahapan) {
                MasterBankTahapan::create([
                    'master_bank_id' => $masterBank->id,
                    'nama_tahapan' => $tahapan['nama_tahapan'],
                    'nilai_progress' => $tahapan['nilai_progress'],
                ]);
            }

            return true;
        });
    }

    public static function updateData($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $masterBank = MasterBank::findOrFail($id);

            $masterBank->update(['nama_master_bank' => $data['nama_master_bank']]);

            // hapus semua tahapan lama
            $masterBankTahapan = $masterBank->master_bank_tahapans();
            $masterBankTahapan->delete();

            // input baru
            foreach ($data['tahapan'] as $tahapan) {
                $masterBankTahapan->create([
                    'nama_tahapan' => $tahapan['nama_tahapan'],
                    'nilai_progress' => $tahapan['nilai_progress'],
                ]);
            }

            return true;
        });
    }

    public static function deleteData($id)
    {
        MasterBank::findOrFail($id)->delete();
        return true;
    }

    public static function getData()
    {
        $data = MasterBank::query()->with(['master_bank_tahapans']);
        return $data;
    }

    public static function getDetailData($id)
    {
        $data = MasterBank::query()->with(['master_bank_tahapans'])->findOrFail($id);
        return $data;
    }
}
