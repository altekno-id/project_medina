<?php

namespace App\Livewire\Rab;

use App\Repositories\RabRepo;
use Livewire\Component;

class DetailRab extends Component
{
    public $id;
    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = RabRepo::getDetail($id);
    }
    
    public function render()
    {
        return view('mods.rab.detail_rab');
    }
}
