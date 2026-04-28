<?php

namespace App\Livewire\MasterKawasan;

use App\Repositories\MasterKawasanRepo;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MasterKawasanData extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $filter = [
        'number' => 10,
        'search' => '',
    ];

    public function updatedFilterSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterNumber(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $masterKawasans = MasterKawasanRepo::getAll()
            ->with([
                'master_kawasan_subs.master_kawasan_sub_bloks',
                'master_kawasan_subs.units',
            ])
            ->when($this->filter['search'], function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_master_kawasan', 'like', '%' . $this->filter['search'] . '%')
                        ->orWhere('alamat_master_kawasan', 'like', '%' . $this->filter['search'] . '%');
                });
            })
            ->latest()
            ->paginate((int) $this->filter['number']);

        return view('mods.master-kawasan.master-kawasan-data', [
            'masterKawasans' => $masterKawasans,
        ]);
    }
}
