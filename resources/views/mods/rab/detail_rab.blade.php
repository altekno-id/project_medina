<div>
    <div class="row mb-6">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="row g-0 align-items-stretch">
                    <!-- LEFT IMAGE -->
                    <div class="col-md-2">
                        <img src="{{ asset('assets/img/icons/medina.jpg') }}"
                            class="img-responsvie w-100 h-100 object-fit-cover rounded-start" alt="project">
                    </div>
                    <!-- RIGHT CONTENT -->
                    <div class="col-md-10">
                        <div class="card-body p-4">
                            <!-- HEADER -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-label-primary">ID : RAB-2023-001</span>
                                <span class="badge rounded-pill bg-success">● Published</span>
                            </div>
                            <!-- TITLE -->
                            <h4 class="fw-bold mb-2">Pembangunan Infrastruktur Tahap 1</h4>
                            <!-- DESC -->
                            <p class="text-muted mb-4">
                                Pembangunan infrastruktur dasar untuk area perkantoran blok A mencakup sistem drainase,
                                pengerasan jalan, dan instalasi kelistrikan bawah tanah.
                            </p>
                            <!-- STATS -->
                            <div class="row g-3">
                                <!-- ITEM -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-light">
                                        <small class="text-muted">JUMLAH ITEM</small>
                                        <h5 class="mb-0 fw-bold">125 <span class="text-muted fs-6">Unit</span></h5>
                                    </div>
                                </div>
                                <!-- QTY -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-light">
                                        <small class="text-muted">TOTAL QTY</small>
                                        <h5 class="mb-0 fw-bold">4,500 <span class="text-muted fs-6">Ttl Satuan</span>
                                        </h5>
                                    </div>
                                </div>
                                <!-- BIAYA -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-primary bg-opacity-10">
                                        <small class="text-primary fw-semibold">TOTAL BIAYA RAB</small>
                                        <h5 class="mb-0 fw-bold text-primary">
                                            Rp 1.250.000.000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>QTY</th>
                        <th>Harga Satuan (RP)</th>
                        <th>Subtotal (RP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Pasir Beton / Pasir Cor</td>
                        <td><span class="badge bg-label-primary">Material</span></td>
                        <td>m2</td>
                        <td>250</td>
                        <td>285.000</td>
                        <td>71.250.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @push('css-push')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    @endpush
    @push('js-push')
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script>
            let table = new DataTable('#myTable');
        </script>
    @endpush
</div>
