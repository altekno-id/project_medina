<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data RAB</h5>
            <a href="{{ route('rab.create') }}" type="submit" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-2"></i>RAB Baru
            </a>
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
                        <td class="">
                            <button type="button" class="btn btn-icon rounded-pill btn-text-info">
                                <i class="icon-base ti tabler-eye icon-22px"></i>
                            </button>
                            <button type="button" class="btn btn-icon rounded-pill btn-text-warning">
                                <i class="icon-base ti tabler-edit icon-22px"></i>
                            </button>
                            <button type="button" class="btn btn-icon rounded-pill btn-text-danger">
                                <i class="icon-base ti tabler-trash icon-22px"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('mods.rab.atc.data_rab_atc')
</div>
