<?php

namespace App\Http\Controllers;

use App\Repositories\RabRepo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RabController extends Controller
{
    public function dataDt()
    {
        $data = RabRepo::getDt();

        return DataTables::of($data)
        ->filterColumn('nama_master_rab', function ($query, $keyword){
            $query->where('nama_master_rab','like', "%{$keyword}%");
        })
         // jumlah item
        ->addColumn('jumlah_item', function ($row) {
            return $row->master_rab_items->count();
        })
        // total qty (penjumlahan semua qty_rab)
        ->addColumn('total_qty', function ($row) {
            return $row->master_rab_items->sum('qty_rab');
        })
        // total biaya (qty * harga per item, lalu dijumlah)
        ->addColumn('total_biaya', function ($row) {
            return $row->master_rab_items->sum(function ($item) {
                return $item->qty_rab * $item->harga_satuan_rab;
            });
        })
        ->toJson();
    }
}
