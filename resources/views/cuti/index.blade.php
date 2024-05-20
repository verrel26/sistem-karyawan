@extends('layouts.app')
@section('container')
@include('sidebar')


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cuti</div>
                          @can('create-cuti')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-cuti"><i class="mdi mdi-access-point"></i>Add New Cuti 
                            </button>
                        @endcan
                        <div class="table-responsive my-3">
                            <table id="cuti-table" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Niy</th>
                                        <th>Nama Karyawan</th>
                                        <th>Lama Cuti</th>
                                        <th>Alasan Cuti</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Niy</th>
                                        <th>Nama Karyawan</th>
                                        <th>Lama Cuti</th>
                                        <th>Alasan Cuti</th>
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

@can('create-cuti')
<div class="modal fade" id="modal-add-cuti">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cuti.store') }}" method="POST" id="form-add-cuti">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Add New Cuti {{ Auth::user()->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lamacuti">Lama cuti</label>
                                <input type="text" class="form-control" id="lamacuti" name="lamacuti" placeholder="Lama Cuti">
                            </div>
                            <div class="form-group">
                                <label for="awalcuti">Awal cuti</label>
                                <input type="text" class="form-control" id="awalcuti" name="awalcuti" placeholder="Awal Cuti">
                            </div>
                            <div class="form-group">
                                <label for="kategoricuti">Kategori cuti</label>
                                <input type="text" class="form-control" id="kategori_cuti" name="kategori_cuti" placeholder="Kategori Cuti">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="alasancuti">Alasan cuti</label>
                                <input type="text" class="form-control" id="alasan_cuti" name="alasan_cuti" placeholder="Alasan Cuti">
                            </div>
                            <div class="form-group">
                                <label for="pengganti">Pengganti cuti</label>
                                <input type="text" class="form-control" id="pengganti" name="pengganti" placeholder="Pengganti Cuti">
                            </div>
                            
                        </div>
                    </div>
                    
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan


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
                    data: 'id_karyawan',
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return data.karyawan.nama_karyawan
                    }
                },
                {
                    data: 'lamacuti',
                },
                {
                    data: 'awalcuti',
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        // if status_cuti = menunggu konfirmasi, 
                            // pilih konfirmasi atau tolak
                        // else  
                            // menuggu konfirmasi 
                            // console.log(data.status_cuti);
                            // var id = data.id
                            if (data.status_cuti == 'menunggu konfirmasi') {
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
                            } else if(data.status_cuti == 'terima') {
                                return `<div class="flex items-center justify-end space-x-2">
                                    @can('detail-cutis')
                                        <a href="{{ route('cuti.show','/') }}/${data.id}" class="btn btn-sm btn-outline-primary detail">Detail</a>&nbsp;
                                    @endcan

                                   
                                    
                                    &nbsp;

                                    @can('delete-cutis')
                                        <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                                    @endcan
                                </div>`;
                            } else {
                                return `<div class="flex items-center justify-end space-x-2">
                                    @can('detail-cutis')
                                        <a href="{{ route('cuti.show','/') }}/${data.id}" class="btn btn-sm btn-outline-primary detail">Detail</a>&nbsp;
                                    @endcan

                                    &nbsp;
                                    
                                    @can('delete-cutis')
                                        <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                                    @endcan
                                </div>`;
                            }

                            return '';
                            
                                
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