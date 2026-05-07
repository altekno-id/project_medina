<div>
    <livewire:page-title :data="[
        'title' => 'Pembangunan Unit Baru',
        'desc' => 'Tambahkan unit baru.',
    ]" />

    <form wire:submit="formSubmit">

        <div class="row mb-5">
            <div class="col-md">
                <div class="card">
                    <h5 class="card-header">Pembangunan Unit Baru</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Jalan</label>
                                <input wire:model="form.nama_jalan" type="text" class="form-control @error('form.nama_jalan') is-invalid @enderror" placeholder="Tulis...">
                                @error('form.nama_jalan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nomor Unit</label>
                                <input wire:model="form.nomor_unit" type="text" class="form-control @error('form.nomor_unit') is-invalid @enderror" placeholder="Tulis...">
                                @error('form.nomor_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipe Unit</label>
                                <input wire:model="form.tipe_unit" type="text" class="form-control @error('form.tipe_unit') is-invalid @enderror" placeholder="Tulis...">
                                @error('form.tipe_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Harga Unit</label>
                                <input wire:model="form.harga_unit" type="number" class="form-control @error('form.harga_unit') is-invalid @enderror" placeholder="Tulis...">
                                @error('form.harga_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kawasan Hunian -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Kawasan Hunian</label>
                                <select wire:model.live="form.master_kawasan_id" class="form-select @error('form.master_kawasan_id') is-invalid @enderror">
                                    <option value="" disabled>-- Pilih --</option>
                                    @foreach ($kawasan as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama_master_kawasan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form.master_kawasan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- kawasan -> cluster --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Cluster</label>
                                <select wire:model.live="form.master_kawasan_sub_id" class="form-select @error('form.master_kawasan_sub_id') is-invalid @enderror">
                                    <option value="" disabled>-- Pilih --</option>
                                    @foreach ($kawasan as $item)
                                        @if ($item->id == $form['master_kawasan_id'])
                                            @foreach ($item->master_kawasan_subs as $sub)
                                                <option value="{{ $sub->id }}">
                                                    {{ $sub->nama_master_kawasan_sub }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('form.master_kawasan_sub_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- kawasan -> cluster -> blok --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Blok</label>
                                <select wire:model="form.master_kawasan_sub_blok_id" class="form-select @error('form.master_kawasan_sub_blok_id') is-invalid @enderror">
                                    <option value="" disabled>-- Pilih --</option>
                                    @foreach ($kawasan as $item)
                                        @foreach ($item->master_kawasan_subs as $sub)
                                            @if ($sub->id == $form['master_kawasan_sub_id'])
                                                @foreach ($sub->master_kawasan_sub_bloks as $blok)
                                                    <option value="{{ $blok->id }}">
                                                        {{ $blok->nama_master_kawasan_sub_blok }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('form.master_kawasan_sub_blok_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pilih RAB -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih RAB</label>
                                <select wire:model="form.master_rab_id" class="form-select @error('form.master_rab_id') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($rab as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_master_rab }}</option>
                                    @endforeach
                                </select>
                                @error('form.master_rab_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pilih Jenis Pembiayaan -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Pembiayaan</label>
                                <select wire:model="form.master_bank_id" class="form-select @error('form.master_bank_id') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($pembiayaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_master_bank }}</option>
                                    @endforeach
                                </select>
                                @error('form.master_bank_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('unit.data') }}" class="btn btn-link btn-outline-secondary">Batal</a>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan Data Unit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END --}}

        {{-- <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route('pembiayaan.data') }}" class="btn btn-link text-secondary text-decoration-none">Batal</a>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan Data Unit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </form>
</div>
