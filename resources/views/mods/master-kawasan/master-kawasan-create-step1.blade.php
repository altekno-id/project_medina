<div id="step1">
    <span>
        <div class="content-header mb-4">
            <h6 class="mb-0">Informasi Umum</h6>
            <small>Isi data informasi umum</small>
        </div>

        <div class="row g-6">
            <div class="col-12">
                <label class="form-label">Nama Kawasan</label>
                <input
                    type="text"
                    wire:model="form.master_kawasans.nama_master_kawasan"
                    class="form-control @error('form.master_kawasans.nama_master_kawasan') is-invalid @enderror"
                    placeholder="Cth: Griya Asri Permai" />

                @error('form.master_kawasans.nama_master_kawasan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea
                    class="form-control @error('form.master_kawasans.alamat_master_kawasan') is-invalid @enderror"
                    rows="3"
                    wire:model="form.master_kawasans.alamat_master_kawasan"></textarea>

                @error('form.master_kawasans.alamat_master_kawasan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </span>
    <hr>
    <span>
        <div class="content-header mb-4 mt-5">
            <h6 class="mb-0">Lokasi dan Peta</h6>
            <small>Tentukan titik koordinat lokasi kawasan</small>
        </div>

        <div class="row g-6">
            <div class="col-md-6">
                <label class="form-label">Latitude</label>
                <input
                    type="text"
                    class="form-control @error('form.master_kawasans.latitude') is-invalid @enderror"
                    wire:model="form.master_kawasans.latitude"
                    readonly>

                @error('form.master_kawasans.latitude')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Longitude</label>
                <input
                    type="text"
                    class="form-control @error('form.master_kawasans.longitude') is-invalid @enderror"
                    wire:model="form.master_kawasans.longitude"
                    readonly>

                @error('form.master_kawasans.longitude')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <small class="text-muted">
                    Cari alamat atau geser penanda untuk menentukan lokasi tepat
                </small>

                <div wire:ignore>
                    <input
                        id="map-search"
                        type="text"
                        class="form-control mb-2"
                        placeholder="Cari alamat...">

                    <div
                        id="map"
                        style="height: 400px; width: 100%; border-radius: 12px;"></div>
                </div>
            </div>
        </div>
    </span>
    <hr>
    <span>
        <div class="content-header mb-4 mt-5">
            <h6 class="mb-0">
                Info Tambahan
            </h6>
            <small>Tambahkan informasi detail kawasan dalam bentuk label dan nilai</small>
        </div>

        <div class="row g-4">
            <div class="col-12">
                @forelse ($form['master_kawasans']['info_master_kawasan'] ?? [] as $infoIndex => $info)
                    <div class="row g-3 align-items-end mb-3" wire:key="info-master-kawasan-{{ $infoIndex }}">
                        <div class="col-12 col-md-5">
                            <label class="form-label">Label Informasi</label>
                            <input
                                type="text"
                                class="form-control @error('form.master_kawasans.info_master_kawasan.' . $infoIndex . '.label') is-invalid @enderror"
                                placeholder="Contoh: Total Luas Tanah"
                                wire:model="form.master_kawasans.info_master_kawasan.{{ $infoIndex }}.label">

                            @error('form.master_kawasans.info_master_kawasan.' . $infoIndex . '.label')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Nilai / Deskripsi</label>
                            <input
                                type="text"
                                class="form-control @error('form.master_kawasans.info_master_kawasan.' . $infoIndex . '.value') is-invalid @enderror"
                                placeholder="Contoh: 15 Hektar"
                                wire:model="form.master_kawasans.info_master_kawasan.{{ $infoIndex }}.value">

                            @error('form.master_kawasans.info_master_kawasan.' . $infoIndex . '.value')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-md-1">
                            <button
                                type="button"
                                class="btn btn-label-danger w-100"
                                wire:click="removeInfo({{ $infoIndex }})">
                                <i class="icon-base ti tabler-trash icon-xs"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-secondary mb-3">
                        Belum ada info tambahan. Klik <strong>Tambah Info</strong> untuk menambahkan.
                    </div>
                @endforelse

                <button
                    type="button"
                    class="btn btn-label-primary w-100 border-dashed"
                    wire:click="addInfo">
                    <i class="icon-base ti tabler-plus icon-xs me-1"></i>
                    Tambah Info
                </button>
            </div>
        </div>
    </span>

    <hr>

    <div class="row g-6">
        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-label-secondary" disabled>
                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Kembali</span>
            </button>

            <button type="button" class="btn btn-primary" wire:click="nextStep">
                <span class="align-middle d-sm-inline-block d-none me-sm-2">Lanjut</span>
                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
            </button>
        </div>
    </div>
</div>
