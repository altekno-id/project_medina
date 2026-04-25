<?php

namespace App\Livewire\Rab;

use Livewire\Component;

class CreateRab extends Component
{
    public $form = [] ;
    public $tahapan = 4;
    
    public function tambahTahapan()
    {
        $this->tahapan ++;
    }
    public function hapusTahapan()
    {
        $this->tahapan --;
    }
    public function render()
    {
        return view('mods.rab.create_rab');
    }
}
