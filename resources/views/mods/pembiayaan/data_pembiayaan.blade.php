<div>
    <div class="row mb-5">
        <div class="d-flex flex-column">
            <span class="fs-4 fw-bold">Data Pembiayaan</span>
            <span style="font-size:14px;">Daftar skema pembiayaan dan jumlah tahapannya.</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body card-datatable table-responsive px-5">
                    <div class="float-end">
                        <button class="btn btn-outline-dark">
                            <i class="menu-icon icon-base ti tabler-filter"></i>
                            Filter
                        </button>
                        <a href="{{ route('pembiayaan.create') }}" class="btn btn-primary">+ Pembiayaan Baru</a>
                    </div>

                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NAMA PEMBIAYAAN (BANK/SKEMA)</th>
                                <th>JUMLAH TAHAPAN</th>
                                <th>KETERANGAN RINGKAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
