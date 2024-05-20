@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Lembur</div>
                       
                        @can('create-lemburs')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-lembur"><i class="mdi mdi-access-point"></i>Add New Lembur 
                        </button>
                        @endcan
                        <div class="table-responsive my-3">
                            <table id="lembur-table" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Niy</th>
                                        <th>Nama Karyawan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Niy</th>
                                        <th>Nama Karyawan</th>
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
@can('create-lemburs')
<div class="modal fade" id="modal-add-lembur">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('lembur.store') }}" method="POST" id="form-add-lembur">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Add New Lembur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="niy">Niy</label>
                                <select class="form-control niy-select" name="niy" id="niy" style="width: 100%;" >
                                    <option value="">-- NIY --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Karyawan</label>
                                <input class="form-control nama-select" name="nama_karyawan" id="edit-nama" style="width: 100%;" readonly>
                                
                            </div>
                            <div class="form-group">
                                <label for="tugas">Uraian Tugas</label>
                                <textarea name="uraian_tugas" id="uraian_tugas" cols="30" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="text">Mulai</label>
                                <input type="date" class="form-control" name="mulai"  id="mulai"  placeholder="Mulai">
                            </div>
                            <div class="form-group">
                                <label for="selesai">Selesai</label>
                                <input type="date" class="form-control" name="selesai" id="selesai" placeholder="Nomor Hp">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    data: 'karyawan.nama_karyawan',
                    render: function(data, type, row){
                        return data;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="flex items-center d-flex justify-content-center space-x-2">
                        @can('detail-lemburs')
                            <a href="{{ route('lembur.show','/') }}/${data.id}" class="btn btn-sm btn-outline-info detail">Detail</a>&nbsp;
                        @endcan
                        @can('update-lemburs')
                            <button class="btn btn-sm btn-outline-primary edit" data-id="${data.id}">Edit</button>&nbsp;
                        @endcan
                        @can('delete-lemburs')
                            <button class="btn btn-sm btn-outline-danger delete" data-id="${data.id}">Delete</button>
                        @endcan
                        </div>`;
                    }
                }
            ]
        }

        var table = $('#lembur-table');
        var config = {
            processing: true,
            serverSide: true,
            ajax: "{{ route('lembur.data') }}",
            paging: true,
            ordering: true,
            info: false,
            searching: true,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],

            columns: defineColumns()
        };

        initializeDataTable(table, config);

        $('#form-add-lembur').on('submit', function(e) {
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
                    $('#form-add-lembur button[type="submit"]').attr('disabled', true);
                    $('#form-add-lembur button[type="submit"]').html('<iconify-icon class="text-xl spin-slow ltr:mr-2 rtl:ml-2 relative top-[1px]" icon="line-md:loading-twotone-loop"></iconify-icon><span>Loading</span>');
                },
                success: function(response) {
                    if (response.success) {
                        $('#modal-add-lembur').modal('hide');
                        $('#form-add-lembur')[0].reset();
                        toastr.success(response.message);
                        table.DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    $('#form-add-lembur button[type="submit"]').attr('disabled', false);
                    $('#form-add-lembur button[type="submit"]').html('Submit');
                }

            })
        })

        

        $(document).on('click', '.edit', function(e) {
            e.preventDefault()
            var data = table.DataTable().row($(this).closest('tr')).data();

            $('#modal-add-lembur').modal('show');
            $('#modal-add-lembur').find('#title').text('Edit Lembur '   + data.karyawan.nama_karyawan );
            $('#form-add-lembur').attr('action', '{{ route("lembur.update") }}');
            $('#form-add-lembur').append('<input type="hidden" name="_method" value="PUT">');
            $('#form-add-lembur').append('<input type="hidden" name="id" value="' + data.id + '">');

            $('#form-add-lembur input[name="id_karyawan"]').val(data.id_karyawan);
            $('#form-add-lembur input[name="nama_karyawan"]').val(data.nama_karyawan);
            $('#form-add-lembur input[name="uraian_tugas"]').val(data.uraian_tugas);
            $('#form-add-lembur input[name="mulai"]').val(data.mulai);
            $('#form-add-lembur input[name="selesai"]').val(data.selesai);
            $('#form-add-lembur input[name="ket"]').val(data.ket);
            // disable input password

            

            var niy = data.karyawan.niy;
            var nama_karyawan = data.karyawan.nama_karyawan;

            var newOption = new Option(niy, nama_karyawan, true, true);
            $('#form-add-lembur .niy-select').append(newOption).trigger('change');
            $('#form-add-lembur .nama-select').val(nama_karyawan);
          
        })
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')
            console.log(id);
            var result = confirm('Are you sure you want to delete this lembur?');

            if(result) {
                $.ajax({
                url: '{{ route("lembur.destroy") }}',
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

        $('#modal-add-lembur').on('hidden.bs.modal', function() {
            $('#modal-add-lembur').find('#title').text('Add User');
            $('#form-add-lembur input[name="_method"]').remove();
            $('#form-add-lembur input[name="id"]').remove();
            $('#form-add-lembur').attr('action', '{{ route("lembur.store") }}');
            $('#form-add-lembur')[0].reset();
            $('#form-add-lembur .niy-select').val(null).trigger('change');
            $('#form-add-lembur .nama-select').val(null).trigger('change');
        })

        $('.niy-select').select2({
            placeholder: 'Select a role',
            ajax: {
                url: '{{ route("karyawan.data") }}',
                dataType: 'json',
                data: function(params) {
                    console.log(params)
                    return {
                        search: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: data.data.map(function(karyawan) {
                            return {
                                id: karyawan.id,
                                text: karyawan.niy,
                                nama: karyawan.nama_karyawan,
                            }
                        })
                    }
                },
                cache: true
            }
        })
        $('.niy-select').on('change', function() {
            var selectedOption = $(this).select2('data')[0];
            console.log(selectedOption);
            var nama = $('#edit-nama').val(selectedOption.nama);
        });
       
    })
</script>
@endpush
