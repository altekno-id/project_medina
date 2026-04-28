<?php

namespace App\Repositories;

use App\Models\MasterKawasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MasterKawasanRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function storeDt(array $data): bool
    {
        $storedFiles = [];

        DB::beginTransaction();

        try {
            $kawasan = MasterKawasan::create([
                'nama_master_kawasan' => $data['master_kawasans']['nama_master_kawasan'],
                'alamat_master_kawasan' => $data['master_kawasans']['alamat_master_kawasan'],
                'latitude' => $data['master_kawasans']['latitude'],
                'longitude' => $data['master_kawasans']['longitude'],
                'info_master_kawasan' => $data['master_kawasans']['info_master_kawasan'] ?? null,
            ]);

            foreach ($data['master_kawasan_subs'] ?? [] as $cluster) {
                $sub = $kawasan->master_kawasan_subs()->create([
                    'nama_master_kawasan_sub' => $cluster['nama_master_kawasan_sub'],
                ]);

                foreach ($cluster['bloks'] ?? [] as $blok) {
                    $sub->master_kawasan_sub_bloks()->create([
                        'nama_master_kawasan_sub_blok' => $blok['nama_master_kawasan_sub_blok'],
                    ]);
                }
            }

            foreach ($data['files'] ?? [] as $fileData) {
                if (
                    empty($fileData['judul_file']) ||
                    empty($fileData['file']) ||
                    !is_object($fileData['file'])
                ) {
                    continue;
                }

                $path = $fileData['file']->store('master-kawasan/files', 'public');

                $storedFiles[] = $path;

                $kawasan->files()->create([
                    'judul_file' => $fileData['judul_file'],
                    'nama_file' => $path,
                ]);
            }

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();

            dd($e->getMessage());

            foreach ($storedFiles as $path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('Gagal menyimpan data kawasan', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return false;
        }
    }

    public static function getAll()
    {
        $data = MasterKawasan::query()
            ->with([
                'user_logins',
                'master_kawasan_subs',
            ]);
        return $data;
    }
}
