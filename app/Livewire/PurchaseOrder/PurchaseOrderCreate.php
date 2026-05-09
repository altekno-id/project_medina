<?php

namespace App\Livewire\PurchaseOrder;

use App\Repositories\PurchaseOrderRepo;
use Livewire\Component;

class PurchaseOrderCreate extends Component
{
    public $form = [];

    public $unitOptions = [];

    public function mount(): void
    {
        $this->unitOptions = PurchaseOrderRepo::getUnitOptions()->toArray();

        $this->resetForm();
        $this->setItemsFromUnit();
    }

    public function resetForm(): void
    {
        $this->form = [
            'nomor_order' => '',
            'tanggal_order' => date('Y-m-d'),
            'status_order' => 0,
            'catatan' => '',
            'unit_id' => $this->unitOptions[0]['id'] ?? '',
            'items' => [],
        ];
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

    public function tambahItem(): void
    {
        $this->form['items'][] = [
            'master_rab_item_id' => '',
            'nama_item' => '',
            'kategori_item' => '',
            'satuan' => '',
            'qty_rab' => 0,
            'qty' => 0,
            'harga_satuan' => 0,
        ];
    }

    public function hapusItem(int $index): void
    {
        unset($this->form['items'][$index]);
        $this->form['items'] = array_values($this->form['items']);
    }

    public function getSelectedUnitProperty(): array
    {
        return collect($this->unitOptions)->firstWhere('id', (int) $this->form['unit_id']) ?? [];
    }

    public function getSubtotal(array $item): int
    {
        return (int) ($item['qty'] ?? 0) * (int) ($item['harga_satuan'] ?? 0);
    }

    public function getTotalPurchaseOrderProperty(): int
    {
        return collect($this->form['items'])->sum(function ($item) {
            return $this->getSubtotal($item);
        });
    }

    public function getSisaRabProperty(): int
    {
        return $this->totalRab - $this->totalPurchaseOrder;
    }

    public function getTotalRabProperty(): int
    {
        return collect($this->selectedUnit['master_rabs']['master_rab_items'] ?? [])->sum(function ($item) {
            return (int) $item['qty_rab'] * (int) $item['harga_satuan_rab'];
        });
    }

    public function formSubmit(): void
    {
        $this->validate();

        $query = PurchaseOrderRepo::store($this->form, $this->form['items']);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Purchase Order berhasil disimpan.',
            ]);

            $this->resetForm();
            $this->setItemsFromUnit();
        } else {
            $this->dispatch('notify', data: [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Purchase Order gagal disimpan.',
            ]);
        }
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
        return view('mods.purchase-order.purchase-order-create');
    }
}
