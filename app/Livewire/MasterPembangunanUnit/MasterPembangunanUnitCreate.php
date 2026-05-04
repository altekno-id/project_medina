<?php

namespace App\Livewire\MasterPembangunanUnit;

use App\Repositories\MasterBankRepo;
use App\Repositories\MasterKawasanRepo;
use App\Repositories\MasterPembangunanUnitRepo;
use App\Repositories\RabRepo;
use Livewire\Component;

class MasterPembangunanUnitCreate extends Component
{
    public $kawasan;
    public $rab;
    public $pembiayaan;
    public function mount()
    {
        $this->kawasan = MasterKawasanRepo::getAll()->get();
        $this->rab = RabRepo::getDt()->get();
        $this->pembiayaan = MasterBankRepo::getData()->get();
    }

    public $form = [
        'master_kawasan_id' => '',
        'master_kawasan_sub_id' => '',
        'master_kawasan_sub_blok_id' => '',
    ];

    public function updatedFormKawasanId()
    {
        $this->form['master_kawasan_sub_id'] = '';
        $this->form['master_kawasan_sub_blok_id'] = '';
    }

    public function updatedFormKawasanSubId()
    {
        $this->form['master_kawasan_sub_blok_id'] = '';
    }

    public function formSubmit()
    {
        $this->validate();

        $query = MasterPembangunanUnitRepo::storeDt($this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses berhasil',
                'message' => 'Data pembangunan unit berhasil ditambahkan.'
            ]);
            $this->resetForm();
            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Proses gagal',
            'message' => 'Data pembangunan unit gagal ditambahkan.'
        ]);
    }

    public function resetForm()
    {
        $this->form = [
            'nama_jalan' => '',
            'nomor_unit' => '',
            'tipe_unit' => '',
            'harga_unit' => '',
            'master_kawasan_id' => '',
            'master_kawasan_sub_id' => '',
            'master_kawasan_sub_blok_id' => '',
            'master_rab_id' => '',
            'master_bank_id' => '',
        ];

        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function rules()
    {
        return [
            'form.nama_jalan' => 'required',
            'form.nomor_unit' => 'required',
            'form.tipe_unit' => 'required',
            'form.harga_unit' => 'required|integer',
            'form.master_kawasan_id' => 'required',
            'form.master_kawasan_sub_id' => 'required',
            'form.master_kawasan_sub_blok_id' => 'required',
            'form.master_rab_id' => 'required',
            'form.master_bank_id' => 'required',
        ];
    }

    public $validationAttributes = [
        'form.nama_jalan' => 'Nama Jalan',
        'form.nomor_unit' => 'Nomor Unit',
        'form.tipe_unit' => 'Tipe Unit',
        'form.harga_unit' => 'Harga Unit',
        'form.master_kawasan_id' => 'Kawasan',
        'form.master_kawasan_sub_id' => 'Cluster',
        'form.master_kawasan_sub_blok_id' => 'Blok',
        'form.master_rab_id' => 'RAB',
        'form.master_bank_id' => 'Pembiayaan',
    ];

    public function render()
    {
        return view('mods.master-pembangunan-unit.master-pembangunan-unit-create');
    }
}
