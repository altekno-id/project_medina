<div>
    <div class="card mb-6">
        <h5 class="card-header">Informasi RAB</h5>
        <form class="card-body">
            <div class="row g-6">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Nama RAB</label>
                    <input type="text" id="multicol-username" class="form-control"
                        placeholder="Masukkan Nama master RAB" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Deskripsi</label>
                    <input type="text" id="multicol-username" class="form-control"
                        placeholder="Berikan Deskripsi Singkat Untuk RAB Ini" />
                </div>
            </div>
        </form>
    </div>
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Item RAB</h5>
            <a href="" type="submit" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-2"></i>Tambah Baris Item
            </a>
        </div>
        <div class="table-responsive text-nowrap text-center">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>QTY RAB</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="Nama Item" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-2">
                                <select id="defaultSelect" class="form-select">
                                    <option>Pilih..</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="Satuan" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="Quantities" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="0000" />
                            </div>
                        </td>
                        <td>Rp.100.000</td>
                        <td class="">
                            <button type="button" class="btn btn-icon rounded-pill btn-text-danger">
                                <i class="icon-base ti tabler-trash icon-22px"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-end">Total Item</td>
                        <td id="totalItem">0</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">Total Biaya RAB</td>
                        <td id="totalBiaya">Rp 0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body d-flex justify-content-end gap-2">
            <button type="reset" class="btn btn-label-secondary">
                Simpan Draft
            </button>
            <button type="submit" class="btn btn-primary">
                Simpan RAB
            </button>
        </div>
    </div>
    @push('css-push')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    @endpush
    @push('js-push')
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    @endpush
</div>
