<?php

namespace App\Livewire\PermintaanDana;

use App\Repositories\PermintaanDanaRepo;
use Livewire\Component;

class PermintaanDanaCreate extends Component
{
    public $form = [];
    public $unitOptions = [];

    public function mount(): void
    {
        $this->unitOptions = PermintaanDanaRepo::getUnitOptions()->toArray();
        $this->resetForm();
        $this->setItemsFromUnit();
    }

    public function resetForm(): void
    {
        $this->form = [
            'jenis_permintaan' => '',
            'jumlah_permintaan' => 0,
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
                'harga_satuan_rab' => $item['harga_satuan_rab'],
            ];
        })->toArray();
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
        return (int) ($item['qty_rab'] ?? 0) * (int) ($item['harga_satuan_rab'] ?? 0);
    }

    public function getTotalReferensiRabProperty(): int
    {
        return collect($this->form['items'])->sum(fn($item) => $this->getSubtotal($item));
    }

    public function formSubmit(): void
    {
        $this->validate();

        $query = PermintaanDanaRepo::storeData($this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Permintaan dana berhasil disimpan.',
            ]);

            $this->resetForm();
            $this->setItemsFromUnit();
            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Permintaan dana gagal disimpan.',
        ]);
    }

    public function rules(): array
    {
        return [
            'form.jenis_permintaan' => 'required|max:150',
            'form.jumlah_permintaan' => 'required|integer|min:1',
            'form.unit_id' => 'required|exists:units,id',
            'form.items' => 'required|array|min:1',
            'form.items.*.master_rab_item_id' => 'required|exists:master_rab_items,id',
        ];
    }

    public $validationAttributes = [
        'form.jenis_permintaan' => 'Jenis Permintaan',
        'form.jumlah_permintaan' => 'Jumlah Permintaan',
        'form.unit_id' => 'Unit',
        'form.items' => 'Item RAB',
        'form.items.*.master_rab_item_id' => 'Item RAB',
    ];

    public function render()
    {
        return view('mods.permintaan-dana.permintaan-dana-create');
    }
}
