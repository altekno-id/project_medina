<div>
    <livewire:page-title :data="[
        'title' => 'Data Pembiayaan',
        'desc' => 'Daftar skema pembiayaan dan jumlah tahapannya.',
    ]" />

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="d-flex justify-content-end mt-5 me-5 pe-3">
                    <button class="btn btn-outline-dark me-1">
                        <i class="menu-icon icon-base ti tabler-filter"></i>
                        Filter
                    </button>
                    <a href="{{ route('pembiayaan.create') }}" class="btn btn-primary">+ Pembiayaan Baru</a>
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
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pembiayaan.atc.pembiayaan_data_atc')
</div>
