<div>
    <livewire:page-title :data="[
        'title' => 'Permintaan Dana',
        'desc' => 'Daftar permintaan dana berdasarkan unit dan item RAB.',
    ]" />

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">Jumlah Permintaan</p>
                    <h4 class="fw-bold mb-0">{{ count($permintaanDanas) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">Total Dana Diminta</p>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($this->totalPermintaanDana, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1 small">Item RAB Terhubung</p>
                    <h4 class="fw-bold mb-0">{{ $this->totalItemRab }} Item</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
                    <div>
                        <h5 class="mb-1">Data Permintaan Dana</h5>
                        <p class="text-secondary mb-0">Data dari tabel permintaan_danas dan relasi permintaan_dana_units.</p>
                    </div>
                    <a href="{{ route('permintaan-dana.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-2"></i>Permintaan Baru
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:5px;">No</th>
                                <th>Nomor</th>
                                <th>Jenis Permintaan</th>
                                <th>Unit</th>
                                <th>Jumlah</th>
                                <th style="width:5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permintaanDanas as $permintaanDana)
                                <tr wire:key="permintaan-dana-{{ $permintaanDana['id'] }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $permintaanDana['nomor_permintaan'] }}</p>
                                        <p class="text-secondary mb-0 small">{{ $permintaanDana['tanggal_permintaan'] }}</p>
                                    </td>
                                    <td class="fw-semibold">{{ $permintaanDana['jenis_permintaan'] }}</td>
                                    <td>{{ $permintaanDana['unit_count'] }} Unit</td>
                                    <td class="fw-semibold">Rp {{ number_format($permintaanDana['jumlah_permintaan'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-primary menu-icon icon-base ti tabler-eye" title="Detail" wire:click="pilihPermintaanDana({{ $permintaanDana['id'] }})"></button>
                                            {{-- <a href="{{ route('permintaan-dana.edit', $permintaanDana['id']) }}" class="btn btn-sm btn-outline-secondary menu-icon icon-base ti tabler-pencil" title="Edit"></a> --}}
                                            <button type="button" class="btn btn-sm btn-danger menu-icon icon-base ti tabler-trash" title="Hapus" wire:click="deleteConfirm({{ $permintaanDana['id'] }}, @js($permintaanDana['nomor_permintaan']))"></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary">Belum ada data permintaan dana.</td>
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
                    <h5 class="mb-1">Detail Permintaan</h5>
                    <p class="text-secondary mb-0">{{ $this->selectedPermintaanDana['nomor_permintaan'] }}</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Tanggal</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPermintaanDana['tanggal_permintaan'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Jumlah Unit</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPermintaanDana['unit_count'] }} Unit</p>
                        </div>
                        <div class="col-12">
                            <p class="text-secondary mb-1 small">Jenis Permintaan</p>
                            <p class="fw-semibold mb-0">{{ $this->selectedPermintaanDana['jenis_permintaan'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Jumlah Dana</p>
                            <p class="fw-semibold mb-0">Rp {{ number_format($this->selectedPermintaanDana['jumlah_permintaan'], 0, ',', '.') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-secondary mb-1 small">Item RAB</p>
                            <p class="fw-semibold mb-0">{{ count($this->selectedPermintaanDana['items']) }} Item</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2 justify-content-end">
                    @if ($this->selectedPermintaanDana['id'])
                        <a href="{{ route('permintaan-dana.edit', $this->selectedPermintaanDana['id']) }}" class="btn btn-outline-secondary">Edit</a>
                    @endif
                    <button type="button" class="btn btn-primary">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-1">Unit dan Item RAB</h5>
            <p class="text-secondary mb-0">Rincian relasi unit dan master_rab_items pada permintaan dana terpilih.</p>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit</th>
                        <th>Item RAB</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>QTY RAB</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal RAB</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->selectedPermintaanDana['items'] as $item)
                        @php
                            $subtotalRab = $item['rab_item']['qty_rab'] * $item['rab_item']['harga_satuan_rab'];
                        @endphp
                        <tr wire:key="permintaan-dana-item-{{ $item['id'] }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <p class="fw-semibold mb-1">{{ $item['unit']['nomor_unit'] }}</p>
                                <p class="text-secondary mb-0 small">{{ $item['unit']['tipe_unit'] }} - {{ $item['unit']['nama_jalan'] }}</p>
                            </td>
                            <td class="fw-semibold">{{ $item['rab_item']['nama_item'] }}</td>
                            <td><span class="badge bg-info">{{ $item['rab_item']['kategori_item'] }}</span></td>
                            <td>{{ $item['rab_item']['satuan'] }}</td>
                            <td>{{ number_format($item['rab_item']['qty_rab'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item['rab_item']['harga_satuan_rab'], 0, ',', '.') }}</td>
                            <td class="fw-semibold">Rp {{ number_format($subtotalRab, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary">Belum ada item RAB.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <livewire:modal-confirm />
</div>
