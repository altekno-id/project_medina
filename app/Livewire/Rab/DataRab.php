<?php

namespace App\Livewire\Rab;

use App\Repositories\RabRepo;
use Livewire\Component;
use Livewire\Attributes\On;

class DataRab extends Component
{
    public $deleteId;

    #[On('RabData-deleteConfirm')]
    public function deleteConfirm($id, $nama)
    {
        $this->deleteId = $id;

        $dtHook = [
            'color' => 'danger',
            'icon' => 'trash',
            'label' => 'Menghapus Data',
            'msg' => "menghapus $nama ?",
            'dispatch' => "RabData-delete",
        ];

        $this->dispatch('modal-confirm-generateDataConfirm', $dtHook);
        $this->dispatch('showModal', id: 'modalConfirm');
    }
    #[On('RabData-delete')]
    public function delete()
    {
        $query = RabRepo::delete($this->deleteId);

        if ($query) {
            $this->dispatch('reloadDT', data: 'dtTable');
            $this->dispatch('closeModal', id: 'modalConfirm');

            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data RAB berhasil dihapus.'
            ]);
            return;
        }
        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Data RAB gagal dihapus.'
        ]);
    }
    public function render()
    {
        return view('mods.rab.data_rab');
    }
}
