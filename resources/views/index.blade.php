@extends('layouts.app')

@section('container')
@include('sidebar')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            {{-- <h2>Selamat Datang, {{ Auth::user()->role->name }}</h2> --}}
            <h2>Selamat Datang, {{ Auth::user()->name; }}</h2>
            {{-- @dd(Auth::user()) --}}
            
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi nesciunt maiores modi. Aperiam minus est reprehenderit saepe labore harum iste enim repellat similique voluptas, blanditiis at soluta! Similique, repudiandae saepe?</p>
          </div>
        </div>
      </div>
    </div>
</div>


@endsection
