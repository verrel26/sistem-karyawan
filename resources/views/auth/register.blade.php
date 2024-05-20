@extends('layouts.app')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-8 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="brand-logo text-center">
                            <img src="{{ asset('assets/images/auth/laravel.png') }}" alt="logo" width="50px;" class="mb-3">
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                        </div>
                       
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label">{{ __('Name') }}</label>
                                            <div class="col-sm-9">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label">{{ __('Email Address') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-4 col-form-label">{{ __('Retype Password') }}</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="niy" class="col-sm-4 col-form-label">{{ __('Niy') }}</label>
                                            <div class="col-sm-9">
                                                <input id="niy" type="text" class="form-control @error('niy') is-invalid @enderror" name="niy" value="{{ old('niy') }}"  autofocus>
                                                @error('niy')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-4 col-form-label">{{ __('Alamat') }}</label>
                                            <div class="col-sm-9">
                                                <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus></textarea>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="nohp" class="col-sm-4 col-form-label">{{ __('Nomor Hp') }}</label>
                                            <div class="col-sm-9">
                                                <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ old('nohp') }}" >
                                                @error('nohp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="foto" class="col-sm-4 col-form-label">{{ __('Foto') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="foto[]" name="foto[]" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" >
                                                @error('foto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label for="pendidikan" class="col-sm-4 col-form-label">{{ __('Pendidikan') }}</label>
                                            <div class="col-sm-9">
                                                <input id="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" value="{{ old('pendidikan') }}" required autocomplete="pendidikan" autofocus>
                                                @error('pendidikan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="jabatan" class="col-sm-4 col-form-label">{{ __('Jabatan') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required autocomplete="jabatan" autofocus>
                                                @error('jabatan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row ">
                                                <label for="jeniskelamin" class="col-sm-4 col-form-label">{{ __('Jenis Kelamin') }}</label>
                                                <div class="col-sm-9 text-center">
                                                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                                        <option value="">-- Jenis Kelamin --</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>     
                            </form>
                            <div class="text-center mt-4 font-weight-light">
                                <a href="/login" class="text-primary">I already have a membership</a>
                                </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
</div>

@endsection
