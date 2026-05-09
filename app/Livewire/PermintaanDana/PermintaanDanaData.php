<?php

namespace App\Livewire\PermintaanDana;

use App\Repositories\PermintaanDanaRepo;
use Livewire\Attributes\On;
use Livewire\Component;

class PermintaanDanaData extends Component
{
    public array $permintaanDanas = [];

    public ?int $selectedPermintaanDanaId = null;

    public $deleteId;

    public function mount(): void
    {
        $this->refreshData();
    }

    public function pilihPermintaanDana(int $id): void
    {
        $this->selectedPermintaanDanaId = $id;
    }

    #[On('PermintaanDanaData-deleteConfirm')]
    public function deleteConfirm($id, $nama): void
    {
        $this->deleteId = $id;

        $dtHook = [
            'color' => 'danger',
            'icon' => 'trash',
            'label' => 'Menghapus Data',
            'msg' => "menghapus $nama ?",
            'dispatch' => 'PermintaanDanaData-delete',
        ];

        $this->dispatch('modal-confirm-generateDataConfirm', $dtHook);
        $this->dispatch('showModal', id: 'modalConfirm');
    }

    #[On('PermintaanDanaData-delete')]
    public function delete(): void
    {
        $query = PermintaanDanaRepo::deleteData($this->deleteId);

        if ($query) {
            $this->refreshData();
            $this->dispatch('closeModal', id: 'modalConfirm');
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Permintaan dana berhasil dihapus.',
            ]);

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Permintaan dana gagal dihapus.',
        ]);
    }

    public function refreshData(): void
    {
        $this->permintaanDanas = PermintaanDanaRepo::getData();
        $this->selectedPermintaanDanaId = $this->permintaanDanas[0]['id'] ?? null;
    }

    public function getSelectedPermintaanDanaProperty(): array
    {
        return collect($this->permintaanDanas)->firstWhere('id', $this->selectedPermintaanDanaId) ?? [
            'id' => 0,
            'nomor_permintaan' => '-',
            'tanggal_permintaan' => '-',
            'jenis_permintaan' => '-',
            'jumlah_permintaan' => 0,
            'unit_count' => 0,
            'items' => [],
        ];
    }

    public function getTotalPermintaanDanaProperty(): int
    {
        return (int) collect($this->permintaanDanas)->sum('jumlah_permintaan');
    }

    public function getTotalItemRabProperty(): int
    {
        return collect($this->permintaanDanas)->sum(fn ($permintaanDana) => count($permintaanDana['items']));
    }

    public function render()
    {
        return view('mods.permintaan-dana.permintaan-dana-data');
    }
}
