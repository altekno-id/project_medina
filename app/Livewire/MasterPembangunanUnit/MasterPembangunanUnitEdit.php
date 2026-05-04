<?php

namespace App\Livewire\MasterPembangunanUnit;

use App\Repositories\MasterBankRepo;
use App\Repositories\MasterKawasanRepo;
use App\Repositories\MasterPembangunanUnitRepo;
use App\Repositories\RabRepo;
use Livewire\Component;

class MasterPembangunanUnitEdit extends Component
{
    public $id;
    private $initialForm = [];

    public $kawasan;
    public $rab;
    public $pembiayaan;

    public $form = [
        'master_kawasan_id' => '',
        'master_kawasan_sub_id' => '',
        'master_kawasan_sub_blok_id' => '',
    ];

    public function updatedFormKawasanId()
    {
        $this->form['master_kawasan_sub_id'] = '';
    }

    public function updatedFormKawasanSubId()
    {
        $this->form['master_kawasan_sub_blok_id'] = '';
    }

    public function mount($id)
    {
        $this->kawasan = MasterKawasanRepo::getAll()->get();
        $this->rab = RabRepo::getDt()->get();
        $this->pembiayaan = MasterBankRepo::getData()->get();

        $this->id = $id;

        $data = MasterPembangunanUnitRepo::getDetailDt($this->id);

        $this->form = [
            'nama_jalan' => $data->nama_jalan,
            'nomor_unit' => $data->nomor_unit,
            'tipe_unit' => $data->tipe_unit,
            'harga_unit' => $data->harga_unit,
            'master_kawasan_id' => $data->master_kawasan_id,
            'master_kawasan_sub_id' => $data->master_kawasan_sub_id,
            'master_kawasan_sub_blok_id' => $data->master_kawasan_sub_blok_id,
            'master_rab_id' => $data->master_rab_id,
            'master_bank_id' => $data->master_bank_id,
        ];
    }

    public function formSubmit()
    {
        $this->validate();

        $query = MasterPembangunanUnitRepo::updateDt($this->id, $this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses berhasil',
                'message' => 'Data Unit berhasil diperbarui.'
            ]);

            $this->initialForm = $this->form;

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Proses gagal',
            'message' => 'Data Unit gagal diperbarui.'
        ]);
    }

    public function rules()
    {
        return [
            'form.nama_jalan' => 'required',
            'form.nomor_unit' => 'required',
            'form.tipe_unit' => 'required',
            'form.harga_unit' => 'required',
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
        return view('mods.master-pembangunan-unit.master-pembangunan-unit-edit');
    }
}
