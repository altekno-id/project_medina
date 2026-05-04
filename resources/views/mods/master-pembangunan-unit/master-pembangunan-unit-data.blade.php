<div>
    <livewire:page-title :data="[
        'title' => 'Unit',
        'desc' => 'Daftar unit.',
    ]" />

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="d-flex justify-content-end mt-5 me-5 pe-3">
                    <a href="{{ route('unit.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-2"></i>Pembangunan Unit Baru</a>
                </div>
                <div wire:ignore class="card-datatable table-responsive px-5">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th style="width:5px;">NO.</th>
                                <th>NAMA JALAN</th>
                                <th>NOMOR UNIT</th>
                                <th>TIPE UNIT</th>
                                <th>HARGA UNIT</th>
                                <th>KAWASAN HUNIAN</th>
                                <th>CLUSTER</th>
                                <th>BLOK</th>
                                <th>RAB</th>
                                <th>PEMBIAYAAN</th>
                                <th style="width:5px;">AKSI</th>
                            </tr>
                        </thead>
                        {{-- <thead id="header-filter">
                            <tr>
                                <th></th>
                                <th class="text-center">
                                    <input wire:model.live.debounce.500ms="filter.nama_jalan" type="text" class="form-control search-col-dt" placeholder="Cari...">
                                </th>
                                <th class="text-center">
                                    <input wire:model.live.debounce.500ms="filter.nomor_unit" type="text" class="form-control search-col-dt" placeholder="Cari...">
                                </th>
                                <th class="text-center">
                                    <input wire:model.live.debounce.500ms="filter.tipe_unit" type="text" class="form-control search-col-dt" placeholder="Cari...">
                                </th>
                                <th class="text-center">
                                    <input wire:model.live.debounce.500ms="filter.harga_unit" type="text" class="form-control search-col-dt" placeholder="Cari...">
                                </th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th></th>
                            </tr>
                        </thead> --}}
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <livewire:modal-confirm />
    @include('master-pembangunan-unit.atc.master-pembangunan-unit-data-atc')
</div>
