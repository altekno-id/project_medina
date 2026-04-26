<div>
    <livewire:page-title :data="[
        'title' => 'RAB Baru',
        'desc' => 'Buat master RAB dan tambahkan item di dalamnya secara efisien',
    ]" />

    <form wire:submit="formSubmit">
        <div class="card mb-6">
            <h5 class="card-header">Informasi RAB</h5>
            <div class="card-body">
                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label">Nama RAB</label>
                        <input type="text"
                            class="form-control  @error('form.master_rab.nama_master_rab') {{ 'is-invalid' }} @enderror"
                            placeholder="Masukkan Nama RAB" wire:model="form.master_rab.nama_master_rab" />
                        <div class="invalid-feedback">
                            @error('form.master_rab.nama_master_rab')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Deskripsi</label>
                        <input type="text"
                            class="form-control @error('form.master_rab.deskripsi') {{ 'is-invalid' }} @enderror"
                            placeholder="Masukkan Deskripsi Singkat RAB" wire:model="form.master_rab.deskripsi" />
                        <div class="invalid-feedback">
                            @error('form.master_rab.deskripsi')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Item RAB</h5>
                <button type="button" class="btn btn-primary" wire:click="tambahItem">
                    <i class="icon-base ti tabler-plus me-2"></i>Tambah Baris Item
                </button>
            </div>
            <div class="table-responsive text-nowrap text-center">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>QTY RAB</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($form['rab_items'] as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <div class="mb-2">
                                        <input type="text"
                                            class="form-control @error('form.rab_items.*.nama_item') {{ 'is-invalid' }} @enderror"
                                            placeholder="Nama Item"
                                            wire:model="form.rab_items.{{ $i }}.nama_item" />
                                        <div class="invalid-feedback">
                                            @error('form.rab_items.*.nama_item')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <select wire:model="form.rab_items.{{ $i }}.kategori_item"
                                            class="form-select @error('form.rab_items.*.kategori_item') {{ 'is-invalid' }} @enderror">
                                            <option>Pilih..</option>
                                            <option value="material">Material</option>
                                            <option value="jasa">Jasa</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('form.rab_items.*.kategori_item')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <input type="text"
                                            class="form-control @error('form.rab_items.*.satuan') {{ 'is-invalid' }} @enderror"
                                            placeholder="Satuan"
                                            wire:model="form.rab_items.{{ $i }}.satuan" />
                                        <div class="invalid-feedback">
                                            @error('form.rab_items.*.satuan')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <input type="number"
                                            class="form-control @error('form.rab_items.*.qty_rab') {{ 'is-invalid' }} @enderror"
                                            placeholder="0"
                                            wire:model.live="form.rab_items.{{ $i }}.qty_rab" />
                                        <div class="invalid-feedback">
                                            @error('form.rab_items.*.qty_rab')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <input type="number"
                                            class="form-control @error('form.rab_items.*.harga_satuan_rab') {{ 'is-invalid' }} @enderror"
                                            placeholder="100000"
                                            wire:model.live="form.rab_items.{{ $i }}.harga_satuan_rab" />
                                        <div class="invalid-feedback">
                                            @error('form.rab_items.*.harga_satuan_rab')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                                <td>Rp.{{ number_format($this->getSubtotal($item), 0, ',', '.') }}</td>
                                <td class="">
                                    <button type="button" class="btn btn-icon rounded-pill btn-text-danger"
                                        wire:click="hapusItem({{ $i }})">
                                        <i class="icon-base ti tabler-trash icon-22px btn btn-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end">Total Item</td>
                            <td id="totalItem">
                                {{ count($form['rab_items']) }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-end">Total Biaya RAB</td>
                            <td id="totalBiaya">
                                Rp {{ number_format($this->totalBiaya, 0, ',', '.') }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">
                    Perbarui RAB
                </button>
            </div>
        </div>
    </form>
    @push('css-push')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    @endpush
    @push('js-push')
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    @endpush
</div>
