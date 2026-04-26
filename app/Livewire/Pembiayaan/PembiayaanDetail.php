<?php

namespace App\Livewire\Pembiayaan;

use App\Repositories\MasterBankRepo;
use Livewire\Component;

class PembiayaanDetail extends Component
{
    public $id;
    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = MasterBankRepo::getDetailData($id);
    }

    public function render()
    {
        return view('mods.pembiayaan.pembiayaan_detail');
    }
}
