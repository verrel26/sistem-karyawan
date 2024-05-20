@extends('layouts.app')
@section('container')
@include('sidebar')


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Pengajuan Cuti</div>
                        @can('create-pengajuan')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-pengajuan"><i class="mdi mdi-access-point"></i>Add New Submission 
                        </button>
                        @endcan
                        <div class="table-responsive my-3">
                            {{ Auth::user()->name }}
                            <table id="cuti-table" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Awal Cuti</th>
                                        <th>Lama Cuti</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Awal Cuti</th>
                                        <th>Lama Cuti</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>


@endsection


@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        function defineColumns() {
            return [{
                    data: 'DT_RowIndex',
                    class: 'table-td'
                },
                {
                    data: 'awalcuti',
                },
                {
                    data: 'lamacuti',
                },
                {
                    data: 'status_cuti',
                },
                {
                    data: null,
                    render: function(data, type, row) {
                                return `<div class="flex items-center justify-end space-x-2">
                                    @can('terima-cutis')
                                        <button class="btn btn-sm btn-outline-info terimacuti" data-id="${data.id}">Terima</button>
                                    @endcan
                                    &nbsp;
                                    @can('tolak-cutis')
                                        <button class="btn btn-sm btn-outline-success tolakcuti" data-id="${data.id}">Tolak</button>
                                    @endcan
                                    &nbsp;
                                    @can('delete-cutis')
                                        <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                                    @endcan
                                </div>`;
                           
                                
                            }

                    }
            ]
        }

        var table = $('#cuti-table');
        var config = {
            processing: true,
            serverSide: true,
            ajax: "{{ route('cuti.data') }}",
            paging: true,
            ordering: true,
            info: false,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],

            columns: defineColumns()
        };

        initializeDataTable(table, config);

        $('#form-add-cuti').on('submit', function(e) {
            e.preventDefault();
            var form = new FormData(this)
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: form,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#form-add-cuti button[type="submit"]').attr('disabled', true);
                    $('#form-add-cuti button[type="submit"]').html('<iconify-icon class="text-xl spin-slow ltr:mr-2 rtl:ml-2 relative top-[1px]" icon="line-md:loading-twotone-loop"></iconify-icon><span>Loading</span>');
                },
                success: function(response) {
                    if (response.success) {
                        $('#modal-add-cuti').modal('hide');
                        $('#form-add-cuti')[0].reset();
                        toastr.success(response.message);
                        table.DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    $('#form-add-cuti button[type="submit"]').attr('disabled', false);
                    $('#form-add-cuti button[type="submit"]').html('Submit');
                }

            })
        })

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to delete this cuti?');

            if(result) {
                $.ajax({
                url: '{{ route("cuti.destroy") }}',
                method: "DELETE",
                data: {
                    id: id
                },
                success: function(response) {
                    toastr.success(response.message);
                    table.DataTable().ajax.reload();
                }
            })
            }
        })
        $(document).on('click', '.terimacuti', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to update this cuti?');

            if(result) {
                $.ajax({
                url: '{{ route("cuti.terima") }}',
                method: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                   if (response.success) {
                         toastr.success(response.message);
                         table.DataTable().ajax.reload();
                   } else {
                         toastr.success(response.message);
                    
                   }
                
                }
            })
            }
        })
        $(document).on('click', '.tolakcuti', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to update this cuti?');

            if(result) {
                $.ajax({
                url: '{{ route("cuti.tolak") }}',
                method: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                   if (response.success) {
                         toastr.success(response.message);
                         table.DataTable().ajax.reload();
                   } else {
                         toastr.success(response.message);
                    
                   }
                
                }
            })
            }
        })

        $('#modal-add-cuti').on('hidden.bs.modal', function() {
            $('#modal-add-cuti').find('#title').text('Add Cuti');
            $('#form-add-cuti input[name="_method"]').remove();
            $('#form-add-cuti input[name="id"]').remove();
            $('#form-add-cuti').attr('action', '{{ route("cuti.store") }}');
            $('#form-add-cuti')[0].reset();
            $('#form-add-cuti .karyawan-select').val(null).trigger('change');
            $('#form-add-cuti .name-select').val(null).trigger('change');
            $('#form-add-cuti .jabatan-select').val(null).trigger('change');
        })

        
    })
</script>
@endpush