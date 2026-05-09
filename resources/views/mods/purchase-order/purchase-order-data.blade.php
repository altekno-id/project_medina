<div>
    <livewire:page-title :data="[
        'title' => 'Purchase Order',
        'desc' => 'Daftar purchase order yang terhubung dengan RAB.',
    ]" />

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">Jumlah Purchase Order</p>
                    <h4 class="fw-bold mb-0">{{ count($purchaseOrders) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">Total Nilai PO</p>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($this->totalSemuaPurchaseOrder, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">PO Terpilih</p>
                    <h4 class="fw-bold mb-0">{{ $this->selectedPurchaseOrder['nomor_order'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
                    <div>
                        <h5 class="mb-1">Data Purchase Order</h5>
                        <p class="text-secondary mb-0">Data order dengan tipe PO.</p>
                    </div>
                    <a href="{{ route('purchase-order.create') }}" class="btn btn-primary">
                        Purchase Order Baru
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Order</th>
                                <th>RAB</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchaseOrders as $purchaseOrder)
                                <tr wire:key="purchase-order-{{ $purchaseOrder['id'] }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $purchaseOrder['nomor_order'] }}</p>
                                        <p class="text-secondary mb-0 small">{{ $purchaseOrder['tanggal_order'] }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $purchaseOrder['rab']['nama_master_rab'] }}</p>
                                        <p class="text-secondary mb-0 small">Total RAB Rp {{ number_format($purchaseOrder['rab']['total_rab'], 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $purchaseOrder['unit']['nomor_unit'] }}</p>
                                        <p class="text-secondary mb-0 small">{{ $purchaseOrder['unit']['tipe_unit'] }}</p>
                                    </td>
                                    <td>
                                        <span class="badge {{ (int) $purchaseOrder['status_order'] === 0 ? 'bg-secondary' : 'bg-primary' }}">
                                            {{ $purchaseOrder['status_label'] }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold">Rp {{ number_format($purchaseOrder['total_order'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-primary menu-icon icon-base ti tabler-eye" title="Detail" wire:click="pilihPurchaseOrder({{ $purchaseOrder['id'] }})"></button>
                                            {{-- <a href="{{ route('purchase-order.edit', $purchaseOrder['id']) }}" class="btn btn-sm btn-primary menu-icon icon-base ti tabler-pencil" title="Edit"></a> --}}
                                            <button type="button" class="btn btn-sm btn-danger menu-icon icon-base ti tabler-trash" title="Hapus" wire:click="deleteConfirm({{ $purchaseOrder['id'] }}, @js($purchaseOrder['nomor_order']))"></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary">Belum ada data purchase order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-1">Detail Purchase Order</h5>
                    <p class="text-secondary mb-0">{{ $this->selectedPurchaseOrder['nomor_order'] }}</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Tanggal Order</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPurchaseOrder['tanggal_order'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Unit</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPurchaseOrder['unit']['nomor_unit'] }}</p>
                        </div>
                        <div class="col-12">
                            <p class="text-secondary mb-1 small">Relasi RAB</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPurchaseOrder['rab']['nama_master_rab'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Total RAB</p>
                            <p class="fw-semibold mb-0">Rp {{ number_format($this->selectedPurchaseOrder['rab']['total_rab'], 0, ',', '.') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Total PO</p>
                            <p class="fw-semibold mb-0">Rp {{ number_format($this->totalPurchaseOrder, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Jumlah Item</p>
                            <p class="fw-semibold mb-0">{{ $this->jumlahItemTerpilih }} Item</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Status</p>
                            <span class="badge {{ (int) ($this->selectedPurchaseOrder['status_order'] ?? 0) === 0 ? 'bg-secondary' : 'bg-primary' }}">
                                {{ $this->selectedPurchaseOrder['status_label'] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2 justify-content-end">
                    <a href="{{ route('purchase-order.edit', $this->selectedPurchaseOrder['id'] ?? 0) }}" class="btn btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-primary">Cetak Order</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-1">Item Purchase Order dari RAB</h5>
            <p class="text-secondary mb-0">Item tersimpan pada tabel order_items.</p>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>QTY RAB</th>
                        <th>QTY Order</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal PO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->selectedPurchaseOrder['items'] as $item)
                        <tr wire:key="purchase-order-item-{{ $loop->index }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item['nama_item'] }}</td>
                            <td><span class="badge bg-info">{{ $item['kategori_item'] }}</span></td>
                            <td>{{ $item['satuan'] }}</td>
                            <td>{{ number_format($item['qty_rab'], 0, ',', '.') }}</td>
                            <td>{{ number_format($item['qty'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                            <td class="fw-semibold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary">Belum ada item order.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-end">Total Purchase Order</th>
                        <th class="fs-5">Rp {{ number_format($this->totalPurchaseOrder, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <livewire:modal-confirm />
</div>
