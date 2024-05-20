<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{ asset('assets/images/logo.svg') }}" class="mr-2" alt="logo"/></a>
    <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item mt-2">
            @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-item mb-3 " onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    <i class="ti-power-off text-primary">&nbsp;Logout</i>
                </a>
            </form>
                @else 
                    <ul class="navbar-nav navbar-nav-right">
                        <a href="/login" class="btn btn-primary btn-sm ml-2">Login</a>
                    </ul>
                @endif
        </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
    </button>
    </div>
</nav>