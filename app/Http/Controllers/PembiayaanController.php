<?php

namespace App\Http\Controllers;

use App\Repositories\MasterBankRepo;
use Yajra\DataTables\Facades\DataTables;

class PembiayaanController extends Controller
{
    public function index()
    {
        $data = MasterBankRepo::getData();

        return DataTables::of($data)
            ->filterColumn('nama_master_bank', function ($query, $keyword) {
                $query->where('nama_master_bank', 'like', "%{$keyword}%");
            })->toJson();
    }
}
