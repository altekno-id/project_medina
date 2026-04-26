@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@push('js-stack')
    <script>
        var dtTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            dom: 'lrtip',
            order: [
                [0, 'asc']
            ],
            //untuk style dari coloumn
            columnDefs: [
                // { className: 'text-left', targets: [3] },
                // { className: 'text-center text-muted', targets: [4] },
                // { className: 'px-0', targets: [1] },
                // { className: 'text-center', targets: ['_all'] },
            ],
            // mengarah ke route 
            ajax: '{{ route('rab.Dt') }}',
            columns: [{
                    data: null,
                    name: 'created_at',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        el = '';
                        el += '<input class="form-check-input" type="checkbox" value="' + data.id + '">';
                        return el;
                    }
                },
                {
                    data: null,
                    name: 'created_at',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta) {
                        let html = `
                         <div class="btn-group-vertical">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirm" wire:click="hookModalConfirm(${data.id},'${data.nama_kecamatan}')">
                                        <i class="fa fa-trash me-2"></i>Hapus
                                    </a>
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                </div>
                            </div>
                        </div>
                    `;

                        return html;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_kecamatan',
                    name: 'nama_kecamatan',
                    orderable: true,
                    searchable: true
                },
            ],
            initComplete: function(settings) {
                table = settings.oInstance.api();
                initSearchCol(table, '#header-filter', 'search-col-dt');
            }
        });
    </script>
@endpush
