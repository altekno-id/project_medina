<?php

namespace App\Livewire\MasterPembangunanUnit;

use App\Repositories\MasterPembangunanUnitRepo;
use Livewire\Attributes\On;
use Livewire\Component;

class MasterPembangunanUnitData extends Component
{
    public $deleteId;

    #[On('PembangunanUnitData-deleteConfirm')]
    public function deleteConfirm($id, $nama)
    {
        // dd($id, $nama);

        $this->deleteId = $id;
        $dtHook = [
            'color' => 'danger',
            'icon' => 'trash',
            'label' => 'Menghapus Data',
            'msg' => "menghapus $nama ?",
            'dispatch' => "PembangunanUnitData-delete",
        ];

        $this->dispatch('modal-confirm-generateDataConfirm', $dtHook);
        $this->dispatch('showModal', id: 'modalConfirm');
    }

    #[On('PembangunanUnitData-delete')]
    public function delete()
    {
        $query = MasterPembangunanUnitRepo::deleteDt($this->deleteId);

        if ($query) {
            $this->dispatch('reloadDT', data: 'dtTable');
            $this->dispatch('closeModal', id: 'modalConfirm');
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses berhasil',
                'message' => 'Data master bank berhasil dihapus.'
            ]);

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Proses gagal',
            'message' => 'Data master bank gagal dihapus.'
        ]);
    }

    public function render()
    {
        return view('mods.master-pembangunan-unit.master-pembangunan-unit-data');
    }
}
