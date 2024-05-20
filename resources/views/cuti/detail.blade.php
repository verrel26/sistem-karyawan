@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin">
            <h3 >Detail Cuti</h3>
            <div class="row">
              <div class="col-lg">
                <div class="card mt-5">
                  <div class="card-body">
                    <h3 class="text-center">Information Cuti</h3>
                      <hr>
                      <div class="row">
                        <div class="col-lg-6">
                          <ul>
                            <p><strong>Niy            </strong> &nbsp;&nbsp;&nbsp;  : {{ $cuti->karyawan->niy }} </p>
                            <p><strong>Nama           </strong>                     : {{ $cuti->karyawan->nama_karyawan }} </p>
                            <p><strong>Jabatan       </strong>                     : {{ $cuti->karyawan->jabatan }} </p>
                            <p><strong>Alamat        </strong>                     : {{ $cuti->karyawan->alamat }} </p>
                            <p><strong>Nomor Hp       </strong>                     : {{ $cuti->karyawan->nohp }} </p>
                          
                          </ul>
                        </div>
                        <div class="col-lg-6">
                          <ul>
                            <p><strong>Lama Cuti      </strong> : {{ $cuti->lamacuti }} </p>
                            <p><strong>Awal Cuti    </strong> : {{ $cuti->awalcuti }} </p>
                            <p><strong>Kategori Cuti    </strong> : {{ $cuti->kategori_cuti }} </p>
                            <p><strong>Alasan Cuti    </strong> : {{ $cuti->alasan_cuti }} </p>
                            <p><strong>Pengganti Cuti    </strong> : {{ $cuti->pengganti }} </p>
                            <p><strong>Status Cuti    </strong> : {{ $cuti->status_cuti }} </p>
                          </ul>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="/cuti" class="btn btn-primary">Back</a>
      </div>
    </div>


@endsection
