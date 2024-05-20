@extends('layouts.app')
@section('container')

<br>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                            <div class="content-wrapper">
                                    <div class="error-page d-flex">
                                        <h2 class="headline text-warning"> 401</h2>
                                        <div class="error-content ">
                                            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Unauthorized</h3>
                                            <p>
                                                You are unauthorized to access this page.
                                                Meanwhile, you may <a href="/">return to dashboard</a>.
                                            </p>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection