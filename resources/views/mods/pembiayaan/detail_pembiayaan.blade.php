<div>
    <div class="row mb-5">
        <div class="d-flex flex-column">
            <span class="fs-4 fw-bold">Detail Pembiayaan</span>
            <span style="font-size:14px;">Informasi pihak bank/lembaga pembiayaan dan tahapan pencairan dana secara rinci.</span>
        </div>
    </div>

    {{-- INFORMASI PIHAK PEMBIAYAAN --}}
    <div class="row mb-5">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="menu-icon icon-base ti tabler-info-circle-filled text-info"></i>
                        <span>Informasi Pihak Pembiayaan</span>
                    </div>
                    <hr>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column">
                            <span class="text-secondary">Nama Lembaga</span>
                            <span class="fw-bold">Bank Mandiri Persero Tbk.</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column">
                            <span class="text-secondary">Jenis Pembiayaan</span>
                            <span class="fw-bold">Kredit Konstruksi</span>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 d-flex flex-column">
                            <span class="text-secondary">Catatan Pembiayaan</span>
                            <span>Pembiayaan pembangunan infrastruktur tahap 1 hingga 5. Peninjauan dilakukan secara berkala setiap pencapaian progres sebesar 12%.</span>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 d-flex flex-column">
                            <span class="text-secondary m-0">Status</span>
                            <span class="text-success d-flex align-items-center m-0">
                                <span style="font-size:32px;">•</span>
                                Aktif - Read Only
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}

    {{-- DAFTAR TAHAPAN PEMBIAYAAN --}}
    <div class="row mb-5">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="menu-icon icon-base ti tabler-menu-2 text-info"></i>
                        <span>Daftar Tahapan Pembangunan</span>
                    </div>
                </h5>
                <div class="card-body card-datatable table-responsive px-5">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th style="width:5px;">NO.</th>
                                <th>NAMA TAHAPAN PEMBANGUNAN</th>
                                <th style="width:5px;">PERSENTASE PROGRES(%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tahapan persiapan & pembersihan lahan</td>
                                <td class="text-success">100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}
</div>
