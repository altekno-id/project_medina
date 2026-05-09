<?php

namespace App\Livewire\PermintaanDana;

use App\Repositories\PermintaanDanaRepo;
use Livewire\Component;

class PermintaanDanaEdit extends Component
{
    public $id;

    public $form = [];

    public $unitOptions = [];

    public function mount($id): void
    {
        $this->id = $id;
        $this->unitOptions = PermintaanDanaRepo::getUnitOptions()->toArray();

        $permintaanDana = PermintaanDanaRepo::getDetailData($id);
        $permintaanDanaUnit = $permintaanDana->permintaan_dana_units->first();

        $this->form = [
            'jenis_permintaan' => $permintaanDana->jenis_permintaan,
            'jumlah_permintaan' => $permintaanDana->jumlah_permintaan,
            'unit_id' => $permintaanDanaUnit?->unit_id ?? ($this->unitOptions[0]['id'] ?? ''),
            'items' => $permintaanDana->permintaan_dana_units->map(function ($item) {
                return [
                    'master_rab_item_id' => $item->master_rab_item_id,
                    'nama_item' => $item->master_rab_items?->nama_item ?? '-',
                    'kategori_item' => $item->master_rab_items?->kategori_item ?? '-',
                    'satuan' => $item->master_rab_items?->satuan ?? '-',
                    'qty_rab' => $item->master_rab_items?->qty_rab ?? 0,
                    'harga_satuan_rab' => $item->master_rab_items?->harga_satuan_rab ?? 0,
                ];
            })->toArray(),
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

        $query = PermintaanDanaRepo::updateData($this->id, $this->form);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Permintaan dana berhasil diperbarui.',
            ]);

            // $this->redirectRoute('permintaan-dana.data', navigate: true);

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Permintaan dana gagal diperbarui.',
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
        return view('mods.permintaan-dana.permintaan-dana-edit');
    }
}
