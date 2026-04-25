<?php

namespace App\Http\Controllers;

use App\Repositories\MasterBankRepo;
use Yajra\DataTables\Facades\DataTables;

class PembiayaanController extends Controller
{
    public function index()
    {
        $data = MasterBankRepo::getData();

        return DataTables::of($data)->toJson();
    }
}
