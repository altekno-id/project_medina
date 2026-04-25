<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">RAB</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Data Rab</a>
            </li>
        </ol>
    </nav>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data RAB</h5>
        </div>
        <hr>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama RAB</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Item</th>
                        <th>Total QTY</th>
                        <th>Total Biaya RAB</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="icon-base ti tabler-eye icon-22px"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @push('css-push')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    @endpush
    @push('js-push')
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script>
            let table = new DataTable('#myTable');
        </script>
    @endpush
</div>
