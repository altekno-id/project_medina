<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data RAB</h5>
            <a href="{{ route('rab.create') }}" type="submit" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-2"></i>RAB Baru
            </a>
        </div>
        <hr>
        <div wire:ignore class="card-datatable table-responsive pt-0">
            <table id="myTable" class="datatables-basic table">
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
    @include('mods.rab.atc.data_rab_atc')
</div>
