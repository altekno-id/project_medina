@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@push('js-push')
    <script>
        var dtTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            dom: "<'row'<'col-md-6'l><'col-md-6'>>" +
                "t" +
                "<'row'<'col-md-6'i><'col-md-6 d-flex justify-content-end'p>>",
            lengthMenu: [10, 25, 50, 100],
            language: {
                url: "{{ asset('mine/id.json') }}",
                paginate: {
                    next: '<i class="icon-base ti tabler-chevron-right scaleX-n1-rtl icon-18px"></i>',
                    previous: '<i class="icon-base ti tabler-chevron-left scaleX-n1-rtl icon-18px"></i>',
                    first: '<i class="icon-base ti tabler-chevrons-left scaleX-n1-rtl icon-18px"></i>',
                    last: '<i class="icon-base ti tabler-chevrons-right scaleX-n1-rtl icon-18px"></i>'
                }
            },

            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [0]
                },
                {
                    className: 'text-nowrap',
                    targets: [1]
                }
            ],

            ajax: "{{ route('pembiayaan.dt') }}",
            columns: [

                {
                    data: null,
                    name: 'no',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'nama_master_bank',
                    name: 'nama_master_bank',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data
                    }
                },
                {
                    name: 'master_bank_tahapans',
                    data: 'master_bank_tahapans',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `
                            <span class="badge badge-outline-primary">${data ? data.length : 0} Tahapan</span>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        let url = "{{ route('pembiayaan.edit', ':id') }}";
                        let editUrl = url.replace(':id', row.id);

                        return `
                            <a href="/pembiayaan/detail/${row.id}" class="btn btn-sm btn-primary menu-icon icon-base ti tabler-eye"></a>
                            <a href="${editUrl}" class="btn btn-sm btn-primary menu-icon icon-base ti tabler-pencil"></a>
                            <button type="button" class="btn btn-sm btn-danger menu-icon icon-base ti tabler-trash" onclick="deleteConfirm(${row.id}, '${row.nama_master_bank}')"></button>
                        `;
                    }
                }
            ],

            initComplete: function(settings) {
                var table = settings.oInstance.api();
                initSearchCol(table, '#header-filter', 'search-col-dt');
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

        });

        function deleteConfirm(id, nama) {
            Livewire.dispatch('PembiayaanData-deleteConfirm', {
                id: id,
                nama: nama
            });
        }

        dtTable.on('draw.dt', function() {
            $('#checkall1').prop('checked', false);
        });
    </script>
@endpush
