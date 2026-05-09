<div>
    <livewire:page-title :data="[
        'title' => 'Permintaan Dana Baru',
        'desc' => 'Buat permintaan dana berdasarkan unit dan item RAB.',
    ]" />

    <form wire:submit="formSubmit">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="card mb-4">
                    <h5 class="card-header">Informasi Permintaan</h5>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Permintaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('form.jenis_permintaan') is-invalid @enderror" placeholder="Contoh: Pencairan Material Struktur" wire:model="form.jenis_permintaan">
                                <div class="invalid-feedback">
                                    @error('form.jenis_permintaan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Permintaan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('form.jumlah_permintaan') is-invalid @enderror" placeholder="0" wire:model.live="form.jumlah_permintaan">
                                    <div class="invalid-feedback">
                                        @error('form.jumlah_permintaan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Unit <span class="text-danger">*</span></label>
                                <select class="form-select @error('form.unit_id') is-invalid @enderror" wire:model.live="form.unit_id">
                                    <option value="">-- Pilih unit --</option>
                                    @foreach ($unitOptions as $unit)
                                        <option value="{{ $unit['id'] }}">
                                            {{ $unit['nomor_unit'] }} - {{ $unit['tipe_unit'] ?? '-' }} - {{ $unit['master_rabs']['nama_master_rab'] ?? 'RAB belum tersedia' }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('form.unit_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
                        <div>
                            <h5 class="mb-1">Item RAB</h5>
                            <p class="text-secondary mb-0">Item mengikuti master RAB pada unit terpilih.</p>
                        </div>
                        <button type="button" class="btn btn-primary" wire:click="setItemsFromUnit">
                            Muat Ulang Item RAB
                        </button>
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
                                    <th>Harga Satuan</th>
                                    <th>Subtotal RAB</th>
                                    <th style="width:5px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($form['items'] as $i => $item)
                                    <tr wire:key="permintaan-dana-create-item-{{ $i }}">
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
                                        <td>Rp {{ number_format((float) $item['harga_satuan_rab'], 0, ',', '.') }}</td>
                                        <td class="fw-semibold">Rp {{ number_format($this->getSubtotal($item), 0, ',', '.') }}</td>
                                        <td>
                                            @if (count($form['items']) > 1)
                                                <button type="button" class="btn btn-sm btn-danger menu-icon icon-base ti tabler-trash" wire:click="hapusItem({{ $i }})"></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-secondary">Pilih unit yang memiliki RAB dan item RAB.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-end">Total Referensi RAB</th>
                                    <th colspan="2" class="fs-5">Rp {{ number_format($this->totalReferensiRab, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mb-4">
                    <h5 class="card-header">Ringkasan Unit</h5>
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
                                <p class="text-secondary mb-1 small">Nama Jalan</p>
                                <p class="fw-semibold mb-0">{{ $this->selectedUnit['nama_jalan'] ?? '-' }}</p>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">RAB Unit</p>
                                <p class="fw-semibold mb-0">{{ $this->selectedUnit['master_rabs']['nama_master_rab'] ?? '-' }}</p>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Item Dipilih</p>
                                <p class="fw-semibold mb-0">{{ count($form['items']) }} Item</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <h5 class="card-header">Ringkasan Dana</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Jumlah Permintaan</p>
                                <h4 class="fw-bold mb-0">Rp {{ number_format((float) ($form['jumlah_permintaan'] ?? 0), 0, ',', '.') }}</h4>
                            </div>
                            <div class="col-12">
                                <p class="text-secondary mb-1 small">Referensi Total RAB</p>
                                <p class="fw-semibold mb-0">Rp {{ number_format($this->totalReferensiRab, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Permintaan</button>
                        <a href="{{ route('permintaan-dana.data') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
