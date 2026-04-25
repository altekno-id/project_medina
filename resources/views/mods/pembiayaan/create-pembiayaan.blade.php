<div>
    <div class="row mb-5">
        <div class="d-flex flex-column">
            <span class="fs-4 fw-bold">Pembiayaan Baru</span>
            <span style="font-size:14px;">Buat skema pembiayaan dan tahapan pencairannya untuk nasabah korporasi.</span>
        </div>
    </div>

    {{-- INFORMASI PEMBIAYAAN --}}
    <div class="row mb-5">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Informasi Pembiayaan</h5>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="mb-6">
                            <label class="form-label" for="bs-validation-name">Nama Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bs-validation-name" name="nama_bank" placeholder="" required />
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="bs-validation-bio">Deskripsi / Catatan</label>
                            <textarea class="form-control" id="bs-validation-bio" name="deskripsi" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}

    {{-- TAHAPAN PEMBIAYAAN --}}
    <div class="row mb-5">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header d-flex justify-content-between">
                    <span>Tahapan Pembiayaan</span>
                    <button class="btn btn-primary">+ Tambah Tahapan</button>
                </h5>
                <div class="card-body card-datatable table-responsive px-5">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NAMA TAHAPAN</th>
                                <th>NILAI PROGRES (%)</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <i class="menu-icon icon-base ti tabler-trash btn btn-danger"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}

    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('pembiayaan.data') }}" class="text-secondary">Batal</a>
                    <div>
                        <button type="button" class="btn btn-label-primary">Simpan Draft</button>
                        <button type="submit" class="btn btn-primary">Simpan Data Pembiayaan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
@endsection

@section('js')
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->

    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/form-validation.js"></script>
@endsection --}}
