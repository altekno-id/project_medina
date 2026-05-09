<div>
    <livewire:page-title :data="[
        'title' => 'Edit Purchase Order',
        'desc' => 'Update order tipe PO berdasarkan unit dan item RAB.',
    ]" />

    <form wire:submit="formSubmit">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="card mb-4">
                    <h5 class="card-header">Informasi Order</h5>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nomor Order <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('form.nomor_order') is-invalid @enderror" placeholder="Masukkan nomor order" wire:model="form.nomor_order">
                                <div class="invalid-feedback">
                                    @error('form.nomor_order')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Order <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('form.tanggal_order') is-invalid @enderror" wire:model="form.tanggal_order">
                                <div class="invalid-feedback">
                                    @error('form.tanggal_order')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status Order <span class="text-danger">*</span></label>
                                <select class="form-select @error('form.status_order') is-invalid @enderror" wire:model="form.status_order">
                                    <option value="0">Draft</option>
                                    <option value="1">Diproses</option>
                                    <option value="2">Selesai</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('form.status_order')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Unit <span class="text-danger">*</span></label>
                                <select class="form-select @error('form.unit_id') is-invalid @enderror" wire:model.live="form.unit_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($unitOptions as $unit)
                                        <option value="{{ $unit['id'] }}">
                                            {{ $unit['nomor_unit'] }} - {{ $unit['master_rabs']['nama_master_rab'] ?? 'RAB belum tersedia' }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('form.unit_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" rows="3" placeholder="Catatan purchase order" wire:model="form.catatan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
                        <div>
                            <h5 class="mb-1">Order Item</h5>
                            <p class="text-secondary mb-0">Item mengikuti master RAB pada unit terpilih.</p>
                        </div>
                        <button type="button" class="btn btn-primary" wire:click="setItemsFromUnit">Muat Ulang Item RAB</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item RAB</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th>QTY RAB</th>
                                    <th>QTY Order</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($form['items'] as $i => $item)
                                    <tr wire:key="purchase-order-edit-item-{{ $i }}">
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <input type="hidden" wire:model="form.items.{{ $i }}.master_rab_item_id">
                                            <p class="fw-semibold mb-1">{{ $item['nama_item'] }}</p>
                                            <p class="text-secondary mb-0 small">ID item RAB: {{ $item['master_rab_item_id'] }}</p>
                                            <div class="invalid-feedback d-block">
                                                @error('form.items.*.master_rab_item_id')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">{{ $item['kategori_item'] }}</span></td>
                                        <td>{{ $item['satuan'] }}</td>
                                        <td>{{ number_format((float) $item['qty_rab'], 0, ',', '.') }}</td>
                                        <td>
                                            <input type="number" class="form-control @error('form.items.*.qty') is-invalid @enderror" placeholder="0" wire:model.live="form.items.{{ $i }}.qty">
                                            <div class="invalid-feedback">
                                                @error('form.items.*.qty')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control @error('form.items.*.harga_satuan') is-invalid @enderror" placeholder="0" wire:model.live="form.items.{{ $i }}.harga_satuan">
                                            <div class="invalid-feedback">
                                                @error('form.items.*.harga_satuan')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </td>
                                        <td class="fw-semibold">{{ number_format($this->getSubtotal($item), 0, ',', '.') }}</td>
                                        <td>
                                            @if (count($form['items']) > 1)
                                                <button type="button" class="btn btn-sm btn-danger menu-icon icon-base ti tabler-trash" wire:click="hapusItem({{ $i }})"></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-secondary">Pilih unit yang memiliki RAB dan item RAB.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-end">Total Purchase Order</th>
                                    <th colspan="2" class="fs-5">Rp {{ number_format($this->totalPurchaseOrder, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mb-4">
                    <h5 class="card-header">Ringkasan Unit dan RAB</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <p class="text-secondary mb-1 small">Nomor Unit</p>
                                <p class="fw-semibold mb-0">{{ $this->selectedUnit['nomor_unit'] ?? '-' }}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-secondary mb-1 small">Tipe Unit</p>
                                <p class="fw-semibold mb-0">{{ $this->selectedUnit['tipe_unit'] ?? '-' }}</p>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Nama RAB</p>
                                <p class="fw-semibold mb-0">{{ $this->selectedUnit['master_rabs']['nama_master_rab'] ?? '-' }}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-secondary mb-1 small">Jumlah Item RAB</p>
                                <p class="fw-semibold mb-0">{{ count($this->selectedUnit['master_rabs']['master_rab_items'] ?? []) }} Item</p>
                            </div>
                            <div class="col-6">
                                <p class="text-secondary mb-1 small">Tipe Order</p>
                                <p class="fw-semibold mb-0">PO</p>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Total RAB</p>
                                <p class="fw-semibold mb-0">Rp {{ number_format($this->totalRab, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <h5 class="card-header">Ringkasan PO</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Total PO</p>
                                <h4 class="fw-bold mb-0">Rp {{ number_format($this->totalPurchaseOrder, 0, ',', '.') }}</h4>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Sisa terhadap RAB</p>
                                <p class="fw-semibold mb-0">Rp {{ number_format($this->sisaRab, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Status Data</p>
                                <span class="badge bg-secondary">Draft</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary">Update Purchase Order</button>
                        <a href="{{ route('purchase-order.data') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
