<div>
    <livewire:page-title :data="[
        'title' => 'Detail RAB',
        'desc' => 'Ringkasan master RAB dan total anggarannya',
    ]" />
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
                                <span class="badge bg-label-primary">ID : {{ $data->id }}</span>
                                <span class="badge rounded-pill bg-success">● Published</span>
                            </div>
                            <!-- TITLE -->
                            <h4 class="fw-bold mb-2">{{ $data->nama_master_rab }}</h4>
                            <!-- DESC -->
                            <p class="text-muted mb-4">
                                {{ $data->deskripsi }}
                            </p>
                            <!-- STATS -->
                            <div class="row g-3">
                                <!-- ITEM -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-light">
                                        <small class="text-muted">JUMLAH ITEM</small>
                                        <h5 class="mb-0 fw-bold">{{ $data->master_rab_items->count() }} <span
                                                class="text-muted fs-6">Item</span></h5>
                                    </div>
                                </div>

                                <!-- QTY -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-light">
                                        <small class="text-muted">TOTAL QTY</small>
                                        <h5 class="mb-0 fw-bold">
                                            {{ number_format($data->master_rab_items->sum('qty_rab'), 0, ',', '.') }}
                                            <span class="text-muted fs-6">Ttl Satuan</span>
                                        </h5>
                                    </div>
                                </div>
                                <!-- BIAYA -->
                                <div class="col-md-4">
                                    <div class="p-3 border rounded bg-primary bg-opacity-10">
                                        <small class="text-primary fw-semibold">TOTAL BIAYA RAB</small>
                                        <h5 class="mb-0 fw-bold text-primary">
                                            Rp
                                            {{ number_format(
                                                $data->master_rab_items->sum(function ($item) {
                                                    return $item->qty_rab * $item->harga_satuan_rab;
                                                }),
                                                0,
                                                ',',
                                                '.',
                                            ) }}
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
                    @foreach ($data->master_rab_items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_item }}</td>
                            <td><span class="badge bg-label-primary">{{ $item->kategori_item }}</span></td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->qty_rab }}</td>
                            <td>{{ $item->harga_satuan_rab }}</td>
                            <td>Rp. {{ number_format($item->qty_rab * $item->harga_satuan_rab, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mods.rab.atc.detail_rab_atc')
</div>
