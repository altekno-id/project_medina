<div>
    <livewire:page-title :data="[
        'title' => 'Data Pembiayaan',
        'desc' => 'Daftar skema pembiayaan dan jumlah tahapannya.',
    ]" />

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="d-flex justify-content-end mt-5 me-5 pe-3">
                    <a href="{{ route('pembiayaan.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-2"></i>Pembiayaan Baru</a>
                </div>
                <div wire:ignore class="card-datatable table-responsive px-5">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th style="width:5px;">NO.</th>
                                <th>NAMA PEMBIAYAAN (BANK/SKEMA)</th>
                                <th>JUMLAH TAHAPAN</th>
                                <th style="width:5px;">AKSI</th>
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
    @include('pembiayaan.atc.pembiayaan_data_atc')
</div>
