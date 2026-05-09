<div>
    <livewire:page-title :data="[
        'title' => 'Dashboard',
        'desc' => 'Ringkasan data master, operasional, dan nilai proyek.',
    ]" />

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="badge bg-label-primary rounded p-2">
                        <i class="icon-base ti tabler-building-community"></i>
                    </div>
                    <div>
                        <p class="text-secondary mb-1 small">Total Unit</p>
                        <h4 class="fw-bold mb-0">{{ number_format($summary['unit'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="badge bg-label-info rounded p-2">
                        <i class="icon-base ti tabler-file-description"></i>
                    </div>
                    <div>
                        <p class="text-secondary mb-1 small">Total RAB</p>
                        <h4 class="fw-bold mb-0">{{ number_format($summary['rab'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="badge bg-label-success rounded p-2">
                        <i class="icon-base ti tabler-shopping-cart"></i>
                    </div>
                    <div>
                        <p class="text-secondary mb-1 small">Purchase Order</p>
                        <h4 class="fw-bold mb-0">{{ number_format($summary['purchase_order'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="badge bg-label-warning rounded p-2">
                        <i class="icon-base ti tabler-wallet"></i>
                    </div>
                    <div>
                        <p class="text-secondary mb-1 small">Permintaan Dana</p>
                        <h4 class="fw-bold mb-0">{{ number_format($summary['permintaan_dana'] ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-1">Ringkasan Nilai</h5>
                    <p class="text-secondary mb-0">Akumulasi nilai dari unit, RAB, purchase order, dan permintaan dana.</p>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p class="text-secondary mb-1 small">Nilai Unit</p>
                            <h5 class="fw-bold mb-0">Rp {{ number_format($finance['total_unit'] ?? 0, 0, ',', '.') }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-secondary mb-1 small">Nilai RAB</p>
                            <h5 class="fw-bold mb-0">Rp {{ number_format($finance['total_rab'] ?? 0, 0, ',', '.') }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-secondary mb-1 small">Nilai Purchase Order</p>
                            <h5 class="fw-bold mb-0">Rp {{ number_format($finance['total_purchase_order'] ?? 0, 0, ',', '.') }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-secondary mb-1 small">Nilai Permintaan Dana</p>
                            <h5 class="fw-bold mb-0">Rp {{ number_format($finance['total_permintaan_dana'] ?? 0, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-1">Progress Pencairan</h5>
                    <p class="text-secondary mb-0">Berdasarkan data unit_progress.</p>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <div>
                            <p class="text-secondary mb-1 small">Tahapan Cair</p>
                            <h4 class="fw-bold mb-0">{{ number_format($progress['cair'] ?? 0, 0, ',', '.') }}</h4>
                        </div>
                        <span class="badge bg-primary">{{ $progress['persen_cair'] ?? 0 }}%</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $progress['persen_cair'] ?? 0 }}%;" aria-valuenow="{{ $progress['persen_cair'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <p class="text-secondary mb-1 small">Total Tahapan</p>
                            <p class="fw-semibold mb-0">{{ number_format($progress['total'] ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-secondary mb-1 small">Belum Cair</p>
                            <p class="fw-semibold mb-0">{{ number_format($progress['belum_cair'] ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Purchase Order Terbaru</h5>
                        <p class="text-secondary mb-0">Lima PO terakhir.</p>
                    </div>
                    <a href="{{ route('purchase-order.data') }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestPurchaseOrders as $purchaseOrder)
                                <tr>
                                    <td class="fw-semibold">{{ $purchaseOrder['nomor_order'] }}</td>
                                    <td>{{ $purchaseOrder['tanggal_order'] }}</td>
                                    <td>Rp {{ number_format($purchaseOrder['total_order'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-secondary">Belum ada purchase order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Permintaan Dana Terbaru</h5>
                        <p class="text-secondary mb-0">Lima permintaan terakhir.</p>
                    </div>
                    <a href="{{ route('permintaan-dana.data') }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestPermintaanDanas as $permintaanDana)
                                <tr>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $permintaanDana['nomor_permintaan'] }}</p>
                                        <p class="text-secondary mb-0 small">{{ $permintaanDana['tanggal_permintaan'] }}</p>
                                    </td>
                                    <td>{{ $permintaanDana['jenis_permintaan'] }}</td>
                                    <td>Rp {{ number_format($permintaanDana['jumlah_permintaan'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-secondary">Belum ada permintaan dana.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1">Unit Terbaru</h5>
                    <p class="text-secondary mb-0">Unit terakhir yang masuk ke master pembangunan.</p>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Kawasan</th>
                                <th>RAB</th>
                                <th>Harga Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($unitTerbaru as $unit)
                                <tr>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $unit['nomor_unit'] }}</p>
                                        <p class="text-secondary mb-0 small">{{ $unit['tipe_unit'] }}</p>
                                    </td>
                                    <td>{{ $unit['kawasan'] }}</td>
                                    <td>{{ $unit['rab'] }}</td>
                                    <td class="fw-semibold">Rp {{ number_format($unit['harga_unit'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary">Belum ada data unit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
