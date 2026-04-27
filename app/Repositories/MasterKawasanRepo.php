<?php

namespace App\Repositories;

use App\Models\MasterKawasan;

class MasterKawasanRepo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $data = MasterKawasan::query()
            ->with([
                'user_logins',
                'master_kawasan_subs',
            ])
        ;
        return $data;
    }
}
