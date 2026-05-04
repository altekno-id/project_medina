<div>
    <livewire:page-title :data="[
        'title' => 'Detail Pembangunan Unit',
        'desc' => 'Informasi mengenai detail pembangunan yang lebih rinci.',
    ]" />

    {{-- INFORMASI UNIT --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="ti tabler-building text-info"></i>
                        <span>Informasi Unit</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Nama Jalan</p>
                            <p class="fw-semibold mb-0">{{ $data->nama_jalan }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Nomor Unit</p>
                            <p class="fw-semibold mb-0">{{ $data->nomor_unit }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Tipe Unit</p>
                            <p class="fw-semibold mb-0">{{ $data->tipe_unit }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Harga Unit</p>
                            <p class="fw-semibold mb-0">Rp {{ $data->harga_unit }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Kawasan Hunian</p>
                            <p class="fw-semibold mb-0">{{ $data->master_kawasans->nama_master_kawasan }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Cluster</p>
                            <p class="fw-semibold mb-0">{{ $data->master_kawasan_subs->nama_master_kawasan_sub }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Blok</p>
                            <p class="fw-semibold mb-0">{{ $data->master_kawasan_sub_bloks->nama_master_kawasan_sub_blok }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">RAB</p>
                            <p class="fw-semibold mb-0">{{ $data->master_rabs->nama_master_rab }}</p>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <p class="text-secondary mb-1 small">Pembiayaan</p>
                            <p class="fw-semibold mb-0">{{ $data->master_banks->nama_master_bank }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}
</div>
