@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin">
            <h3 >Detail Lembur </h3>
            <div class="row">
              <div class="col-lg">
                <div class="card mt-5">
                  <div class="card-body">
                    <h3 class="text-center">Karyawan Information Lembur</h3>
                      <hr>
                        <ul>
                          <p><strong>Niy  </strong> &nbsp;&nbsp;&nbsp; :  {{ $lembur->karyawan->niy}} </p>
                          <p><strong>Name </strong> : {{ $lembur->karyawan->nama_karyawan }} </p>
                          <p><strong>Alamat </strong> : {{ $lembur->karyawan->alamat }} </p>
                          <p><strong>Mulai Lembur </strong> : {{ $lembur->mulai }} </p>
                          <p><strong>Selesai Lembur </strong> : {{ $lembur->selesai }} </p>
                          <p><strong>Selesai Lembur </strong> : {{ $lembur->uraian_tugas }} </p>
                          <p><strong>Selesai Lembur </strong> : {{ $lembur->ket }} </p>
                        </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="/lembur" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>


@endsection
