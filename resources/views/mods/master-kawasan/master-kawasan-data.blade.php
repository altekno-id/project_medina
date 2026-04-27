<div>
    <div class="loading-50" wire:loading>
        <div class="loader"></div>
    </div>
    <livewire:page-title :data="[
        'title' => 'Data Kawasan',
        'desc' => 'Semua data kawasan hunian yang telah didaftarkan',
        // 'link' => route('pegawai.data'),
        // 'link_title' => 'Data Pegawai',
        // 'btn_type' => 'success',
        // 'icon' => 'tabler-users',
    ]" />

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label" for="basic-default-name">Tampilkan</label>
                                        <div class="col-sm-7">
                                            <select class="form-select" wire:model.live="filter.number">
                                                <option value="2">2</option>
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31"><i class="icon-base ti tabler-search"></i></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Cari Kawasan..."
                                            wire:model.live.debounce.500ms="filter.search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 text-end">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <span class="icon-xs icon-base ti tabler-plus me-2"></span>Kawasan Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">

        @foreach ($masterKawasans as $item)
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-1">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-primary border border-primary">
                                    <i class="icon-base ti tabler-building-skyscraper icon-28px"></i>
                                </span>
                            </div>
                            <h5 class="mb-0">{{ $item['nama_master_kawasan'] }}</h5>
                        </div>
                        <p class="mb-1">{{ $item['alamat_master_kawasan'] }}</p>
                        <p>
                            <span class="badge bg-label-secondary d-inline-flex align-items-center gap-1">
                                <i class="icon-base ti tabler-building"></i>
                                {{ count($item['master_kawasan_subs']) }} Cluster
                            </span>

                            <span class="badge bg-label-secondary d-inline-flex align-items-center gap-1">
                                <i class="icon-base ti tabler-home"></i>
                                {{ count($item['master_kawasan_subs']) }} Unit
                            </span>
                        </p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">+18.2%</span>
                            <small class="text-body-secondary">than last week</small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr>
    <div class="row mt-3">
        <div class="col">
            <nav>
                <ul class="pagination pagination-rounded justify-content-end">

                    {{-- First --}}
                    <li class="page-item {{ $masterKawasans->onFirstPage() ? 'disabled' : '' }}">
                        <button
                            type="button"
                            class="page-link"
                            wire:click="gotoPage(1)"
                            wire:loading.attr="disabled"
                            @disabled($masterKawasans->onFirstPage())>
                            <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                        </button>
                    </li>

                    {{-- Prev --}}
                    <li class="page-item {{ $masterKawasans->onFirstPage() ? 'disabled' : '' }}">
                        <button
                            type="button"
                            class="page-link"
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            @disabled($masterKawasans->onFirstPage())>
                            <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                        </button>
                    </li>

                    {{-- Number --}}
                    @for ($i = 1; $i <= $masterKawasans->lastPage(); $i++)
                        <li class="page-item {{ $masterKawasans->currentPage() == $i ? 'active' : '' }}">
                            <button
                                type="button"
                                class="page-link"
                                wire:click="gotoPage({{ $i }})"
                                wire:loading.attr="disabled"
                                @disabled($masterKawasans->currentPage() == $i)>
                                {{ $i }}
                            </button>
                        </li>
                    @endfor

                    {{-- Next --}}
                    <li class="page-item {{ !$masterKawasans->hasMorePages() ? 'disabled' : '' }}">
                        <button
                            type="button"
                            class="page-link"
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            @disabled(!$masterKawasans->hasMorePages())>
                            <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                        </button>
                    </li>

                    {{-- Last --}}
                    <li class="page-item {{ !$masterKawasans->hasMorePages() ? 'disabled' : '' }}">
                        <button
                            type="button"
                            class="page-link"
                            wire:click="gotoPage({{ $masterKawasans->lastPage() }})"
                            wire:loading.attr="disabled"
                            @disabled(!$masterKawasans->hasMorePages())>
                            <i class="icon-base ti tabler-chevrons-right icon-sm"></i>
                        </button>
                    </li>

                </ul>
            </nav>
        </div>
    </div>


</div>
