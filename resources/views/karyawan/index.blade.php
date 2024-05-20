@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Karyawan</div>
                        {{-- @can('create-karyawans')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-karyawan"><i class="mdi mdi-access-point"></i>Add New Karyawan 
                            </button>
                        @endcan --}}
                   <div class="table-responsive my-3">
                    <table id="karyawan-table" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Niy</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Niy</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
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


@can('create-karyawans')
<div class="modal fade" id="modal-add-karyawan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('karyawan.store') }}" method="POST" id="form-add-karyawan">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Add New Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="karyawan">Karyawan Name</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Karyawan name">
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

{{-- @can('update-karyawans')
<button class="btn btn-sm btn-outline-primary edit" data-id="${data.id}">Edit</button>&nbsp;
@endcan --}}

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
                    data: 'niy',
                },
                {
                    data: 'nama_karyawan',
                },
                {
                    data: 'jenis_kelamin',
                },
                
                {
                    data: null,
                    render: function(data, type, row) {
                        var id = data.id
                        return `<div class="flex items-center d-flex justify-content-center space-x-2">
                        @can('detail-karyawans')
                            <a href="{{ route('karyawan.show','/') }}/${data.id}" class="btn btn-sm btn-outline-info detail">Detail</a>&nbsp;
                        @endcan
                       
                       
                        @can('delete-karyawans')
                            <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                        @endcan
                        </div>`;
                    }
                }
            ]
        }

        var table = $('#karyawan-table');
        var config = {
            processing: true,
            serverSide: true,
            ajax: "{{ route('karyawan.data') }}",
            paging: true,
            ordering: true,
            info: false,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],

            columns: defineColumns()
        };

        initializeDataTable(table, config);

        $('#form-add-karyawan').on('submit', function(e) {
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
                    $('#form-add-karyawan button[type="submit"]').attr('disabled', true);
                    $('#form-add-karyawan button[type="submit"]').html('<iconify-icon class="text-xl spin-slow ltr:mr-2 rtl:ml-2 relative top-[1px]" icon="line-md:loading-twotone-loop"></iconify-icon><span>Loading</span>');
                },
                success: function(response) {
                    if (response.success) {
                        $('#modal-add-karyawan').modal('hide');
                        $('#form-add-karyawan')[0].reset();
                        toastr.success(response.message);
                        table.DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    $('#form-add-karyawan button[type="submit"]').attr('disabled', false);
                    $('#form-add-karyawan button[type="submit"]').html('Submit');
                }

            })
        })

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to delete this karyawan?');

            if(result) {
                $.ajax({
                url: '{{ route("karyawan.destroy") }}',
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

            $('#modal-add-karyawan').modal('show');
            $('#modal-add-karyawan').find('#title').text('Edit User');
            $('#form-add-karyawan').attr('action', '{{ route("karyawan.update") }}');
            $('#form-add-karyawan').append('<input type="hidden" name="_method" value="PUT">');
            $('#form-add-karyawan').append('<input type="hidden" name="id" value="' + data.id + '">');

            $('#form-add-karyawan input[name="name"]').val(data.name);
            $('#form-add-karyawan input[name="email"]').val(data.email);
            // disable input password
            $('#form-add-karyawan input[name="password"]').attr('disabled', true);
        })

        $('#modal-add-karyawan').on('hidden.bs.modal', function() {
            $('#modal-add-karyawan').find('#title').text('Add User');
            $('#form-add-karyawan input[name="_method"]').remove();
            $('#form-add-karyawan input[name="id"]').remove();
            $('#form-add-karyawan').attr('action', '{{ route("karyawan.store") }}');
            $('#form-add-karyawan')[0].reset();
            $('#form-add-karyawan input[name="password"]').attr('disabled', false);
        })

        
    })
</script>
@endpush
