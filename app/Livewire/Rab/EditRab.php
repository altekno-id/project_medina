<?php

namespace App\Livewire\Rab;

use App\Repositories\RabRepo;
use Livewire\Component;

class EditRab extends Component
{
    public $id;

    public $form = [];

    private $initialForm = [];

    public function mount($id)
    {
        $this->id = $id;
        $rab = RabRepo::getDetail($id);

        $this->form = [
            'master_rab' => [
                'nama_master_rab' => $rab->nama_master_rab,
                'deskripsi' => $rab->deskripsi,
            ],
            'rab_items' => $rab->master_rab_items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_item' => $item->nama_item,
                    'kategori_item' => $item->kategori_item,
                    'satuan' => $item->satuan,
                    'qty_rab' => $item->qty_rab,
                    'harga_satuan_rab' => $item->harga_satuan_rab,
                ];
            })->toArray(),
        ];
    }
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
    public function formSubmit()
    {
        $this->validate();

        $dtRab = $this->form['master_rab'];
        $dtItems = $this->form['rab_items'];

        $query = RabRepo::update($this->id, $dtRab, $dtItems);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'RAB berhasil diupdate'
            ]);
            return;
        }
        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Update gagal'
        ]);
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
        return view('mods.rab.edit_rab');
    }
}
