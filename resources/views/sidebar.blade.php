<div class="container-fluid page-body-wrapper">
  {{-- SIDEBAR --}}
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
     
      @can('read-karyawan')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('karyawan*') ? 'active' : '' }}" href="{{ route('karyawan.index') }}">
          <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Karyawan </span>
            <i class="menu-title"></i>
        </a>
      </li>
      @endcan
     
      @can('read-cuti')
      {{-- @hasrole('admin|pimpinan') --}}
      <li class="nav-item">
        <a class="nav-link {{ Request::is('cuti*') ? 'active' : '' }}" href="{{ route('cuti.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Cuti</span>
        </a>
      </li>
      {{-- @endhasrole --}}
      @endcan

      @can('read-lembur')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('lembur*') ? 'active' : '' }}" href="{{ route('lembur.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Lembur</span>
        </a>
      </li>
      @endcan

      @can('read-liputan')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('liputan*') ? 'active' : '' }}" href="{{ route('liputan.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Liputan</span>
        </a>
      </li>
      @endcan

      @can('read-role')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('role*') ? 'active' : '' }}" href="{{ route('role.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Role</span>
        </a>
      </li>
      @endcan
      
      @can('read-permission')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}" href="{{ route('permission.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Permissions</span>
        </a>
      </li>
      @endcan
      @can('read-user')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('user.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      @endcan
      <hr>
     
      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
          </ul>
        </div>
      </li> --}}
    
        @can('pengajuan-cuti')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('pengajuancuti*') ? 'active' : '' }}" href="{{ route('cuti.pengajuan') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Pengajuan Cuti</span>
          </a>
        </li>
        @endcan
    </ul>
  </nav>