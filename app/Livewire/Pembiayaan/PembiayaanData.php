<?php

namespace App\Livewire\Pembiayaan;

use App\Repositories\MasterBankRepo;
use Livewire\Attributes\On;
use Livewire\Component;

class PembiayaanData extends Component
{
    public $deleteId;
    public function deleteConfirm($id, $nama)
    {
        $this->deleteId = $id;
        $dtHook = [
            'color' => 'danger',
            'icon' => 'trash',
            'label' => 'Menghapus Data',
            'msg' => "menghapus SK $nama ?",
            'dispatch' => "PembiayaanData-delete",
        ];

        $this->dispatch('modal-confirm', $dtHook);
        $this->dispatch('showModal', id: 'modalConfirm');
    }

    #[On('PembiayaanData-delete')]
    public function delete()
    {
        $query = MasterBankRepo::deleteData($this->deleteId);

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
        return view('mods.pembiayaan.pembiayaan_data');
    }
}
