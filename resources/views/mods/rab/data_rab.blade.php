<div>
    <livewire:page-title :data="[
        'title' => 'Data RAB',
        'desc' => 'Ringkasan master RAB dan total anggarannya',
    ]" />

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="d-flex justify-content-end mt-5 me-5 pe-3">
                    <a href="{{ route('rab.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-2"></i>RAB Baru
                    </a>
                </div>
                <div wire:ignore class="card-datatable table-responsive px-5">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama RAB</th>
                                <th>Deskripsi</th>
                                <th>Jumalah Item</th>
                                <th>Total QTY</th>
                                <th>Total Biaya RAB</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <thead id="header-filter">
                            <tr>
                                <th></th>
                                <th class="text-center">
                                    <input type="text" class="form-control search-col-dt" placeholder="Cari...">
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <livewire:modal-confirm />
    @include('mods.rab.atc.data_rab_atc')
</div>
