<?php

namespace App\Livewire\Rab;

use App\Repositories\RabRepo;
use Livewire\Component;

class CreateRab extends Component
{
    public $form = [];

    public function mount()
    {
        $this->resetForm();
    }

    public function formSubmit()
    {
        $this->validate();
        $dtRab = $this->form['master_rab'];
        $dtItems = $this->form['rab_items'];
        $query =  RabRepo::store($dtRab, $dtItems);
        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'RAB Berhasil disimpan',
            ]);
            $this->resetForm();
        } else {
            $this->dispatch('notify', data: [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Terjadi Kesalahan',
            ]);
        }
    }
    public function rules()
    {
        return [
            'form.master_rab.nama_master_rab' => 'required',
            'form.master_rab.deskripsi' => 'required',
            'form.rab_items.*.nama_item' => 'required',
            'form.rab_items.*.kategori_item' => 'required',
            'form.rab_items.*.satuan' => 'required',
            'form.rab_items.*.qty_rab' => 'required|numeric',
            'form.rab_items.*.harga_satuan_rab' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            "form.master_rab.nama_master_rab.required" => "Mohon Masukkan Nama RAB",
            "form.master_rab.deskripsi" => "Mohon Masukkan Deskripsi RAB",
            "form.rab_items.*.nama_item" => "Mohon Masukkan Nama Item",
            "form.rab_items.*.kategori_item" => "Mohon Pilih Kategori Item",
            "form.rab_items.*.satuan" => "Mohon Masukkan Satuan Item",
            "form.rab_items.*.qty_rab" => "Mohon Masukkan Kuantiti Item",
            "form.rab_items.*.harga_satuan_rab" => "Mohon Masukkan Harga Satuan Item",
        ];
    }
    public function resetForm()
    {
        $this->form = [
            'master_rab' => [
                'nama_master_rab' => '',
                'deskripsi' => '',
            ],
            'rab_items' => [
                [
                    'nama_item' => '',
                    'kategori_item' => '',
                    'satuan' => '',
                    'qty_rab' => '',
                    'harga_satuan_rab' => '',
                ]
            ]
        ];
    }
    public $validationAttributes = [
        "form.master_rab.nama_rab" => "Nama RAB",
        "form.master_rab.deskripsi" => "Deskripsi",
        "form.rab_items.nama_item" => "Nama Item",
        "form.rab_items.kategori_item" => "Kategori item",
        "form.rab_items.satuan" => "Satuan",
        "form.rab_items.qty_rab" => "Kuantiti RAB",
        "form.rab_items.harga_satuan_rab" => "Harga Satuan RAB",
    ];

    public function tambahItem()
    {
        $this->form['rab_items'][] = [
            'nama_item' => '',
            'kategori_item' => '',
            'satuan' => '',
            'qty_rab' => '',
            'harga_satuan_rab' => '',
        ];
    }
    public function hapusItem($index)
    {
        unset($this->form['rab_items'][$index]);
        $this->form['rab_items'] = array_values($this->form['rab_items']);
    }
    public function getSubtotal($item)
    {
        $qty = (float) ($item['qty_rab'] ?? 0);
        $harga = (float) ($item['harga_satuan_rab'] ?? 0);
        return $qty * $harga;
    }
    public function getTotalBiayaProperty()
    {
        return collect($this->form['rab_items'])
        ->sum(function ($item) {
            $qty = (float) ($item['qty_rab'] ?? 0);
            $harga = (float) ($item['harga_satuan_rab'] ?? 0);
            return $qty * $harga;
        });
    }
    public function render()
    {
        return view('mods.rab.create_rab');
    }
}
