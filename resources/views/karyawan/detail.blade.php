@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="row">
              <div class="col ">
                <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="{{ $karyawan->nama_karyawan }}" class="img-fluid rouded mx-auto d-block" width="100px">
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="card mt-5">
                  <div class="card-body">
                    <h3 class="text-center">Karyawan Information</h3>
                      <hr>
                      <div class="row">
                      <div class="col-lg-6">
                        <ul>
                          <p><strong>Niy            </strong> &nbsp;&nbsp;&nbsp;  : {{ $karyawan->niy }} </p>
                          <p><strong>Nama           </strong>                     : {{ $karyawan->nama_karyawan }} </p>
                          <p><strong>Nomor Hp       </strong>                     : {{ $karyawan->nohp }} </p>
                          <p><strong>Jenis Kelamin  </strong>                     : {{ $karyawan->jenis_kelamin }} </p>
                        
                        </ul>
                      </div>
                      <div class="col-lg-6">
                        <ul>
                          <p><strong>Email      </strong> : {{ $karyawan->email }} </p>
                          <p><strong>Pendidikan </strong> : {{ $karyawan->pendidikan }} </p>
                          <p><strong>Jabatan    </strong> : {{ $karyawan->jabatan }} </p>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a href="/karyawan" class="btn btn-primary my-3">Back</a>
          </div>
        </div>
      </div>
    </div>

    


@endsection
