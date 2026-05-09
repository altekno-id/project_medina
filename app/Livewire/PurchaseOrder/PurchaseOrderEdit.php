<?php

namespace App\Livewire\PurchaseOrder;

use App\Repositories\PurchaseOrderRepo;
use Livewire\Component;

class PurchaseOrderEdit extends Component
{
    public $id;

    public $form = [];

    public $unitOptions = [];

    public function mount($id): void
    {
        $this->id = $id;
        $this->unitOptions = PurchaseOrderRepo::getUnitOptions()->toArray();
        $this->form = PurchaseOrderRepo::formData($id);
    }

    public function updatedFormUnitId(): void
    {
        $this->setItemsFromUnit();
    }

    public function setItemsFromUnit(): void
    {
        $unit = $this->selectedUnit;

        $this->form['items'] = collect($unit['master_rabs']['master_rab_items'] ?? [])->map(function ($item) {
            return [
                'master_rab_item_id' => $item['id'],
                'nama_item' => $item['nama_item'],
                'kategori_item' => $item['kategori_item'],
                'satuan' => $item['satuan'],
                'qty_rab' => $item['qty_rab'],
                'qty' => $item['qty_rab'],
                'harga_satuan' => $item['harga_satuan_rab'],
            ];
        })->toArray();
    }

    public function hapusItem($index)
    {
        unset($this->form['items'][$index]);
        $this->form['items'] = array_values($this->form['items']);
    }

    public function getSelectedUnitProperty(): array
    {
        return collect($this->unitOptions)->firstWhere('id', (int) $this->form['unit_id']) ?? [];
    }

    public function getSubtotal($item)
    {
        $qty = (float) ($item['qty'] ?? 0);
        $harga = (float) ($item['harga_satuan'] ?? 0);

        return $qty * $harga;
    }

    public function getTotalPurchaseOrderProperty()
    {
        return collect($this->form['items'])->sum(function ($item) {
            return $this->getSubtotal($item);
        });
    }

    public function getTotalRabProperty()
    {
        return collect($this->selectedUnit['master_rabs']['master_rab_items'] ?? [])->sum(function ($item) {
            return (float) $item['qty_rab'] * (float) $item['harga_satuan_rab'];
        });
    }

    public function getSisaRabProperty()
    {
        return $this->totalRab - $this->totalPurchaseOrder;
    }

    public function formSubmit()
    {
        $this->validate();

        $query = PurchaseOrderRepo::update($this->id, $this->form, $this->form['items']);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Purchase Order berhasil diupdate.',
            ]);

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Purchase Order gagal diupdate.',
        ]);
    }

    public function rules()
    {
        return [
            'form.nomor_order' => 'required|max:50',
            'form.tanggal_order' => 'required|date',
            'form.status_order' => 'required|numeric',
            'form.unit_id' => 'required|exists:units,id',
            'form.items' => 'required|array|min:1',
            'form.items.*.master_rab_item_id' => 'required|exists:master_rab_items,id',
            'form.items.*.qty' => 'required|numeric|min:0',
            'form.items.*.harga_satuan' => 'required|numeric|min:0',
        ];
    }

    public $validationAttributes = [
        'form.nomor_order' => 'Nomor Order',
        'form.tanggal_order' => 'Tanggal Order',
        'form.status_order' => 'Status Order',
        'form.unit_id' => 'Unit',
        'form.items' => 'Item Purchase Order',
        'form.items.*.master_rab_item_id' => 'Item RAB',
        'form.items.*.qty' => 'QTY Order',
        'form.items.*.harga_satuan' => 'Harga Satuan',
    ];

    public function render()
    {
        return view('mods.purchase-order.purchase-order-edit');
    }
}
