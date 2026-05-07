<?php

namespace App\Http\Controllers;

use App\Repositories\MasterPembangunanUnitRepo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembangunanUnitController extends Controller
{
    public function index()
    {
        $data = MasterPembangunanUnitRepo::getDt();

        return DataTables::of($data)
            ->addColumn('kawasan', function ($row) {
                return $row->master_kawasans?->nama_master_kawasan ?? '-';
            })
            ->addColumn('cluster', function ($row) {
                return $row->master_kawasan_subs?->nama_master_kawasan_sub ?? '-';
            })
            ->addColumn('blok', function ($row) {
                return $row->master_kawasan_sub_bloks?->nama_master_kawasan_sub_blok ?? '-';
            })
            ->addColumn('rab', function ($row) {
                return $row->master_rabs?->nama_master_rab ?? '-';
            })
            ->addColumn('bank', function ($row) {
                return $row->master_banks?->nama_master_bank ?? '-';
            })
            ->toJson();
    }
}
