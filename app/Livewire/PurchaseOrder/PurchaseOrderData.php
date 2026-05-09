<?php

namespace App\Livewire\PurchaseOrder;

use App\Repositories\PurchaseOrderRepo;
use Livewire\Attributes\On;
use Livewire\Component;

class PurchaseOrderData extends Component
{
    public array $purchaseOrders = [];

    public ?int $selectedPurchaseOrderId = null;

    public $deleteId;

    public function mount(): void
    {
        $this->purchaseOrders = PurchaseOrderRepo::getListForView();
        $this->selectedPurchaseOrderId = $this->purchaseOrders[0]['id'] ?? null;
    }

    public function pilihPurchaseOrder(int $id): void
    {
        $this->selectedPurchaseOrderId = $id;
    }

    #[On('PurchaseOrderData-deleteConfirm')]
    public function deleteConfirm($id, $nomorOrder)
    {
        $this->deleteId = $id;

        $dtHook = [
            'color' => 'danger',
            'icon' => 'trash',
            'label' => 'Menghapus Data',
            'msg' => "menghapus $nomorOrder ?",
            'dispatch' => 'PurchaseOrderData-delete',
        ];

        $this->dispatch('modal-confirm-generateDataConfirm', $dtHook);
        $this->dispatch('showModal', id: 'modalConfirm');
    }

    #[On('PurchaseOrderData-delete')]
    public function delete()
    {
        $query = PurchaseOrderRepo::delete($this->deleteId);

        if ($query) {
            $this->refreshData();
            $this->dispatch('closeModal', id: 'modalConfirm');

            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Purchase Order berhasil dihapus.',
            ]);

            return;
        }

        $this->dispatch('notify', data: [
            'type' => 'error',
            'title' => 'Gagal',
            'message' => 'Purchase Order gagal dihapus.',
        ]);
    }

    public function refreshData(): void
    {
        $this->purchaseOrders = PurchaseOrderRepo::getListForView();
        $this->selectedPurchaseOrderId = $this->purchaseOrders[0]['id'] ?? null;
    }

    public function getSelectedPurchaseOrderProperty(): array
    {
        return collect($this->purchaseOrders)->firstWhere('id', $this->selectedPurchaseOrderId) ?? [
            'nomor_order' => '-',
            'tanggal_order' => '-',
            'status_order' => 0,
            'status_label' => '-',
            'unit' => [
                'nomor_unit' => '-',
                'tipe_unit' => '-',
            ],
            'rab' => [
                'nama_master_rab' => '-',
                'total_rab' => 0,
            ],
            'items' => [],
            'total_order' => 0,
        ];
    }

    public function getTotalPurchaseOrderProperty(): int
    {
        return (int) $this->selectedPurchaseOrder['total_order'];
    }

    public function getTotalSemuaPurchaseOrderProperty(): int
    {
        return collect($this->purchaseOrders)->sum('total_order');
    }

    public function getJumlahItemTerpilihProperty(): int
    {
        return count($this->selectedPurchaseOrder['items']);
    }

    public function render()
    {
        return view('mods.purchase-order.purchase-order-data');
    }
}
