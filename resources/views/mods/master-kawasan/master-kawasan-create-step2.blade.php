<div id="step2">
    <div class="content-header mb-4">
        <h6 class="mb-0">Cluster & Blok</h6>
        <small>Tentukan data cluster dan blok dalam kawasan</small>
    </div>

    <div class="row g-6">
        <div class="col-12">
            <label class="form-label">Nama Cluster</label>

            <div class="input-group">
                <input
                    type="text"
                    class="form-control @error('clusterName') is-invalid @enderror"
                    placeholder="Ketik nama cluster"
                    wire:model="clusterName"
                    wire:keydown.enter.prevent="addCluster">

                <button
                    class="btn btn-label-primary waves-effect"
                    type="button"
                    wire:click="addCluster">
                    <i class="icon-base ti tabler-plus icon-xs"></i>
                    Tambah Cluster
                </button>
            </div>

            @error('clusterName')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @error('form.master_kawasan_subs')
                <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-12">
            @forelse ($form['master_kawasan_subs'] ?? [] as $clusterIndex => $cluster)
                <div class="card border mb-4" wire:key="cluster-{{ $clusterIndex }}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">
                                <i class="icon-base ti tabler-building me-1"></i>
                                {{ $cluster['nama_master_kawasan_sub'] }}
                            </h6>
                            <small class="text-muted">
                                {{ count($cluster['bloks'] ?? []) }} Blok
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-sm btn-label-danger"
                            wire:click="removeCluster({{ $clusterIndex }})">
                            <i class="icon-base ti tabler-trash icon-xs"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <label class="form-label">Tambah Blok</label>

                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control @error('form.master_kawasan_subs.' . $clusterIndex . '.blokName') is-invalid @enderror"
                                placeholder="Contoh: Blok A"
                                wire:model="form.master_kawasan_subs.{{ $clusterIndex }}.blokName"
                                wire:keydown.enter.prevent="addBlok({{ $clusterIndex }})">

                            <button
                                class="btn btn-label-primary"
                                type="button"
                                wire:click="addBlok({{ $clusterIndex }})">
                                <i class="icon-base ti tabler-plus icon-xs"></i>
                                Tambah Blok
                            </button>
                        </div>

                        @error('form.master_kawasan_subs.' . $clusterIndex . '.blokName')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror

                        @error('form.master_kawasan_subs.' . $clusterIndex . '.bloks')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror

                        <div class="d-flex flex-wrap gap-2">
                            @forelse ($cluster['bloks'] ?? [] as $blokIndex => $blok)
                                <span
                                    class="badge bg-label-secondary d-inline-flex align-items-center gap-1"
                                    wire:key="cluster-{{ $clusterIndex }}-blok-{{ $blokIndex }}">
                                    <i class="icon-base ti tabler-home"></i>
                                    {{ $blok['nama_master_kawasan_sub_blok'] }}

                                    <button
                                        type="button"
                                        class="btn-close ms-1"
                                        style="font-size: 8px;"
                                        wire:click="removeBlok({{ $clusterIndex }}, {{ $blokIndex }})"></button>
                                </span>
                            @empty
                                <small class="text-muted">
                                    Belum ada blok untuk cluster ini.
                                </small>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary mb-0">
                    Belum ada cluster. Tambahkan cluster terlebih dahulu.
                </div>
            @endforelse
        </div>
    </div>

    <hr>

    <div class="row g-6">
        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-label-secondary" wire:click="prevStep">
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
