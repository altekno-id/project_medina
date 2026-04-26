<div>
    <livewire:page-title :data="[
        'title' => 'Edit Pembiayaan',
        'desc' => 'Edit skema pembiayaan dan tahapan pencairannya untuk nasabah korporasi.',
    ]" />

    <form wire:submit="formSubmit">

        {{-- INFORMASI PEMBIAYAAN --}}
        <div class="row mb-5">
            <div class="col-md">
                <div class="card">
                    <h5 class="card-header">Informasi Pembiayaan</h5>
                    <div class="card-body">
                        <div class="mb-6">
                            <label class="form-label" for="bs-validation-name">Nama Bank <span class="text-danger">*</span></label>
                            <input wire:model="form.nama_master_bank" type="text" class="form-control @error('form.nama_master_bank') {{ 'is-invalid' }} @enderror" id="nama_master_bank" placeholder="Tulis nama bank..." />
                            <div class="invalid-feedback">
                                @error('form.nama_master_bank')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END --}}

        {{-- TAHAPAN PEMBIAYAAN --}}
        <div class="row mb-5">
            <div class="col-md">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between">
                        <span>Tahapan Pembiayaan</span>
                        <button type="button" class="btn btn-primary" wire:click="tambahTahapan()">+ Tambah Tahapan</button>
                    </h5>
                    @error('total_progress')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="card-body card-datatable table-responsive px-5">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th style="width:5px;">NO.</th>
                                    <th>NAMA TAHAPAN</th>
                                    <th>NILAI PROGRES (%)</th>
                                    <th style="width:5px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form['tahapan'] as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <input wire:model="form.tahapan.{{ $i }}.nama_tahapan" type="text" class="form-control @error('form.tahapan.*.nama_tahapan') {{ 'is-invalid' }} @enderror">
                                            <div class="invalid-feedback">
                                                @error('form.tahapan.*.nama_tahapan')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <input wire:model="form.tahapan.{{ $i }}.nilai_progress" type="text" class="form-control @error('form.tahapan.*.nilai_progress') {{ 'is-invalid' }} @enderror">
                                            <div class="invalid-feedback">
                                                @error('form.tahapan.*.nilai_progress')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            @if (count($form['tahapan']) > 1)
                                                <i class="menu-icon icon-base ti tabler-trash btn btn-danger" wire:click="hapusTahapan({{ $i }})"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- END --}}

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route('pembiayaan.data') }}" class="text-secondary">Batal</a>
                        <div>
                            {{-- <button type="button" class="btn btn-label-primary">Simpan Draft</button> --}}
                            <button type="submit" class="btn btn-primary">Perbarui Data Pembiayaan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
