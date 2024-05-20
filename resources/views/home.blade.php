@extends('layouts.app')

@section('container')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
    {{-- Navbar --}}
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{ asset('assets/images/logo.svg') }}" class="mr-2" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo"/></a>
           
        </div>
        {{-- @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link  mb-3 " onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </form>
        @else 
            <ul class="navbar-nav navbar-nav-right">
                <a href="/login" class="btn btn-primary btn-sm ml-2">Login</a>
            </ul>
        @endif --}}

        
    </nav>
    {{-- Navbar --}}
            <div class="row mt-3">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        {{-- Carousel --}}
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                            <div class="card position-relative">
                                <div class="card-body">
                                <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                                    <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Detailed Reports</p>
                                            <h1 class="text-primary">$34040</h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                                            </div>  
                                            </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                <table class="table table-borderless report-table">
                                                    <tr>
                                                    <td class="text-muted">Illinois</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Washington</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Mississippi</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">California</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Maryland</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Alaska</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="north-america-chart"></canvas>
                                                <div id="north-america-legend"></div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Detailed Reports</p>
                                            <h1 class="text-primary">$34040</h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                                            </div>  
                                            </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                <table class="table table-borderless report-table">
                                                    <tr>
                                                    <td class="text-muted">Illinois</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Washington</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Mississippi</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">California</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Maryland</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-muted">Alaska</td>
                                                    <td class="w-100 px-0">
                                                        <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="south-america-chart"></canvas>
                                                <div id="south-america-legend"></div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <br>
                                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                            {{-- Carousel --}}
                    
                            <div class="container">
                        {{-- <div class="card-body"> --}}
                        <h1 class="card-title text-center">Surau TV</h1>
                          <div class="row">
                            <div class="col-lg-6">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus est sapiente perspiciatis beatae tempore quod a possimus minus aliquid assumenda nihil, hic asperiores rerum laudantium animi? Quisquam, repudiandae consequatur. Nemo!</p>
                            </div>
                            <div class="col-lg-6">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus est sapiente perspiciatis beatae tempore quod a possimus minus aliquid assumenda nihil, hic asperiores rerum laudantium animi? Quisquam, repudiandae consequatur. Nemo!</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-7 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <p class="card-title mb-0">Top Products</p>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                      <thead>
                                        <tr>
                                          <th>Product</th>
                                          <th>Price</th>
                                          <th>Date</th>
                                          <th>Status</th>
                                        </tr>  
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>Search Engine Marketing</td>
                                          <td class="font-weight-bold">$362</td>
                                          <td>21 Sep 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                        <tr>
                                          <td>Search Engine Optimization</td>
                                          <td class="font-weight-bold">$116</td>
                                          <td>13 Jun 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                        <tr>
                                          <td>Display Advertising</td>
                                          <td class="font-weight-bold">$551</td>
                                          <td>28 Sep 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                          <td>Pay Per Click Advertising</td>
                                          <td class="font-weight-bold">$523</td>
                                          <td>30 Jun 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                          <td>E-Mail Marketing</td>
                                          <td class="font-weight-bold">$781</td>
                                          <td>01 Nov 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-danger">Cancelled</div></td>
                                        </tr>
                                        <tr>
                                          <td>Referral Marketing</td>
                                          <td class="font-weight-bold">$283</td>
                                          <td>20 Mar 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                          <td>Social media marketing</td>
                                          <td class="font-weight-bold">$897</td>
                                          <td>26 Oct 2018</td>
                                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-5 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">To Do Lists</h4>
                                                    <div class="list-wrapper pt-2">
                                                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                                            <li>
                                                                <div class="form-check form-check-flat">
                                                                    <label class="form-check-label">
                                                                        <input class="checkbox" type="checkbox">
                                                                        Meeting with Urban Team
                                                                    </label>
                                                                </div>
                                                                <i class="remove ti-close"></i>
                                                            </li>
                                                            <li class="completed">
                                                                <div class="form-check form-check-flat">
                                                                    <label class="form-check-label">
                                                                        <input class="checkbox" type="checkbox" checked>
                                                                        Duplicate a project for new customer
                                                                    </label>
                                                                </div>
                                                                <i class="remove ti-close"></i>
                                                            </li>
                                                            <li>
                                                                <div class="form-check form-check-flat">
                                                                    <label class="form-check-label">
                                                                        <input class="checkbox" type="checkbox">
                                                                        Project meeting with CEO
                                                                    </label>
                                                                </div>
                                                                <i class="remove ti-close"></i>
                                                            </li>
                                                            <li class="completed">
                                                                <div class="form-check form-check-flat">
                                                                    <label class="form-check-label">
                                                                        <input class="checkbox" type="checkbox" checked>
                                                                        Follow up of team zilla
                                                                    </label>
                                                                </div>
                                                                <i class="remove ti-close"></i>
                                                            </li>
                                                            <li>
                                                                <div class="form-check form-check-flat">
                                                                    <label class="form-check-label">
                                                                        <input class="checkbox" type="checkbox">
                                                                        Level up for Antony
                                                                    </label>
                                                                </div>
                                                                <i class="remove ti-close"></i>
                                                            </li>
                                                        </ul>
                                  </div>
                                  <div class="add-items d-flex mb-0 mt-2">
                                                        <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                                                        <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
            </div>
          </footer> 
    </div>
</div>
@endsection
