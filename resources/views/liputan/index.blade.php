@extends('layouts.app')

@section('container')
@include('sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Liputan</div>
                        @can('create-liputan')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-liputan"><i class="mdi mdi-access-point"></i>Add New Liputan 
                            </button>
                        @endcan
                   <div class="table-responsive my-3">
                    <table id="liputan-table" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Liputan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Liputan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@can('create-liputans')
<div class="modal fade" id="modal-add-liputan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('liputan.store') }}" method="POST" id="form-add-liputan">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Add New Liputaddn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Karyawan</label>
                        <select class="form-control niy-select" name="id_karyawan" id="edit-nama" style="width: 100%;" >
                            <option value="">-- NIY --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="liputan">Liputan Name</label>
                        <input type="text" class="form-control" id="liputan" name="liputan" placeholder="Liputan name">
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
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return data.karyawan.nama_karyawan
                    }
                },
                {
                    data: 'liputan',
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="flex items-center d-flex justify-content-center space-x-2">
                        
                        @can('update-liputans')
                            <button class="btn btn-sm btn-outline-primary edit" data-id="${data.id}">Edit</button>&nbsp;
                        @endcan
                        @can('delete-liputans')
                            <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                        @endcan
                        </div>`;
                    }
                }
            ];
        }

        var table = $('#liputan-table');
        var config = {
            processing: true,
            serverSide: true,
            ajax: "{{ route('liputan.data') }}",
            paging: true,
            ordering: true,
            info: false,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            columns: defineColumns()
        };

        initializeDataTable(table, config);

        $('#form-add-liputan').on('submit', function(e) {
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
                    $('#form-add-liputan button[type="submit"]').attr('disabled', true);
                    $('#form-add-liputan button[type="submit"]').html('Loading...');
                },
                success: function(response) {
                    if (response.success) {
                        $('#modal-add-liputan').modal('hide');
                        $('#form-add-liputan')[0].reset();
                        toastr.success(response.message);
                        table.DataTable().ajax.reload();
                    } else {
                        
                        toastr.error(response.message);
                    }
                    $('#form-add-liputan button[type="submit"]').attr('disabled', false);
                    $('#form-add-liputan button[type="submit"]').html('Save');
                }

            })
        })


        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to delete this liputan?');

            if(result) {
                $.ajax({
                url: '{{ route("liputan.destroy") }}',
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

        $(document).on('click', '.edit', function(e) {
            e.preventDefault()
            var data = table.DataTable().row($(this).closest('tr')).data();

            $('#modal-add-liputan').modal('show');
            $('#modal-add-liputan').find('#title').text('Edit Liputan');
            $('#form-add-liputan').attr('action', '{{ route("liputan.update") }}');
            $('#form-add-liputan').append('<input type="hidden" name="_method" value="PUT">');
            $('#form-add-liputan').append('<input type="hidden" name="id" value="' + data.id + '">');
            
            
            $('#form-add-liputan input[name="liputan"]').val(data.liputan);

            var karyawan = new Option(data.karyawan[0].nama_karyawan, data.karyawan[0].id, true, true);
            $('#form-add-liputan #edit-nama').append(karyawan).trigger('change');

            
        })

        $('#modal-add-liputan').on('hidden.bs.modal', function() {
            $('#modal-add-liputan').find('#title').text('Add Liputan');
            $('#form-add-liputan input[name="_method"]').remove();
            $('#form-add-liputan input[name="id"]').remove();
            $('#form-add-liputan').attr('action', '{{ route("liputan.store") }}');
            $('#form-add-liputan')[0].reset();
            $('#form-add-liputan .nama-select').val(null).trigger('change');
        })

        
        $('#edit-nama').select2({
            placeholder: 'Select a karyawan',
            ajax: {
                url: '{{ route("karyawan.data") }}',
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.data.map(function(karyawan) {
                            return {
                                id: karyawan.id,
                                text: karyawan.nama_karyawan
                            }
                        })
                    }
                }
            }
        })
        
    })
</script>
@endpush

   


