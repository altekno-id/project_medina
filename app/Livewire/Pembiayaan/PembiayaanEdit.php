<?php

namespace App\Livewire\Pembiayaan;

use App\Repositories\MasterBankRepo;
use Livewire\Component;

class PembiayaanEdit extends Component
{
    public $id;
    public $form = [];

    private $initialForm = [];

    public function mount($id)
    {
        $this->id = $id;

        $masterBank = MasterBankRepo::getDetailData($id);

        $this->form = [
            'nama_master_bank' => $masterBank->nama_master_bank,
            'tahapan' => $masterBank->master_bank_tahapans->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_tahapan' => $item->nama_tahapan,
                    'nilai_progress' => $item->nilai_progress,
                ];
            })->toArray(),
        ];
    }

    public function tambahTahapan()
    {
        $this->form['tahapan'][] = [
            'nama_tahapan' => '',
            'nilai_progress' => '',
        ];
    }

    public function hapusTahapan($index)
    {
        unset($this->form['tahapan'][$index]);
        $this->form['tahapan'] = array_values($this->form['tahapan']);
    }

    public function formSubmit()
    {
        $this->validate();

        $total = collect($this->form['tahapan'])->sum('nilai_progress');

        if ($total != 100) {
            $this->dispatch('notify', data: [
                'type' => 'error',
                'title' => 'Proses gagal',
                'message' => 'Total progress harus 100%, sekarang: ' . $total . '%',
            ]);

            return;
        }

        $query = MasterBankRepo::updateData($this->id, $this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses berhasil',
                'message' => 'Data master bank berhasil ditambahkan.'
            ]);

            $this->initialForm = $this->form;

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Proses gagal',
            'message' => 'Data master bank gagal diperbarui.'
        ]);
    }

    public function rules()
    {
        return [
            'form.nama_master_bank' => 'required',
            'form.tahapan.*.nama_tahapan' => 'required',
            'form.tahapan.*.nilai_progress' => 'required|numeric|min:0|max:100',
        ];
    }

    public $validationAttributes = [
        'form.nama_master_bank' => 'Nama Bank',
        'form.tahapan.*.nama_tahapan' => 'Nama Tahapan',
        'form.tahapan.*.nilai_progress' => 'Nilai Progress',
    ];

    public function render()
    {
        return view('mods.pembiayaan.pembiayaan_edit');
    }
}
