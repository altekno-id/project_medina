<?php

namespace App\Livewire\MasterPembangunanUnit;

use App\Repositories\MasterPembangunanUnitRepo;
use Livewire\Component;

class MasterPembangunanUnitDetail extends Component
{
    public $id;
    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = MasterPembangunanUnitRepo::getDetailDt($id);
    }

    public function render()
    {
        return view('mods.master-pembangunan-unit.master-pembangunan-unit-detail');
    }
}
