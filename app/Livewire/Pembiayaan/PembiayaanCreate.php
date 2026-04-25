<?php

namespace App\Livewire\Pembiayaan;

use App\Repositories\MasterBankRepo;
use Livewire\Component;

class PembiayaanCreate extends Component
{
    public $form = [
        'nama_master_bank' => '',
        'tahapan' => [],
    ];
    public function formSubmit()
    {
        $this->validate();

        $query = MasterBankRepo::storeData($this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses berhasil',
                'message' => 'Data master bank berhasil ditambahkan.'
            ]);
            $this->resetForm();
            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Proses gagal',
            'message' => 'Data master bank gagal ditambahkan.'
        ]);
    }

    public function resetForm()
    {
        $this->form = [
            'nama_master_bank' => '',
            'tahapan' => [
                [
                    'nama_tahapan' => '',
                    'nilai_progress' => ''
                ]
            ]
        ];

        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function rules()
    {
        return [
            'form.nama_master_bank' => 'required',
            'form.tahapan.*.nama_tahapan' => 'required',
            'form.tahapan.*.nilai_progress' => 'required|numeric',
        ];
    }

    public $validationAttributes = [
        'form.nama_master_bank' => 'Nama Bank',
        'form.tahapan.*.nama_tahapan' => 'Nama Tahapan',
        'form.tahapan.*.nilai_progress' => 'Nilai Progress',
    ];

    // public $tahapan = 4;
    public function tambahTahapan()
    {
        $this->form['tahapan'][] = [
            'nama_tahapan' => '',
            'nilai_progress' => ''
        ];
    }

    public function hapusTahapan($index)
    {
        unset($this->form['tahapan'][$index]);
        $this->form['tahapan'] = array_values($this->form['tahapan']);
    }

    public function mount()
    {
        $this->form['tahapan'] = [
            [
                'nama_tahapan' => '',
                'nilai_progress' => ''
            ]
        ];
    }

    public function render()
    {
        return view('mods.pembiayaan.pembiayaan_create');
    }
}
