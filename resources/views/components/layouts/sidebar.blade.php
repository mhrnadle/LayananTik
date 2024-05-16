<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
      <img src="{{asset('assets/img/IopT13l2bZwuCHsVdqtmGFke3qNe8MKM6U67sanu.webp')}}" class="navbar-brand-img h-100 rounded-circle" alt="...">
      <span class="ms-3 font-weight-bold">Ulti Assets Managements</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse h-100 w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('dashboard') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-home ps-2 pe-2 text-center text-dark {{ (Request::routeIs('dashboard') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      @can('role-list')
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link" href="{{ route('users.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('users.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-user ps-2 pe-2 text-center text-dark {{ (Request::routeIs('users.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Manage User</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link" href="{{ route('roles.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('roles.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-cogs ps-2 pe-2 text-center text-dark {{ (Request::routeIs('roles.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Manage Roles</span>
        </a>
      </li>
      @endcan

      @canany(['layanan-list', 'syarat-list', 'info-layanan-list'])
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Layanan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('layanan.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('layanan.*', 'sublayanan.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-wifi ps-2 pe-2 text-center text-dark {{ (Request::routeIs('layanan.*', 'sublayanan.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Kategori Layanan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('syarat.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('syarat.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-wrench ps-2 pe-2 text-center text-dark {{ (Request::routeIs('syarat.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Syarat Kategori</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('info-layanan.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('info-layanan.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-window-restore ps-2 pe-2 text-center text-dark {{ (Request::routeIs('info-layanan.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Info Layanan</span>
        </a>
      </li>
      @endcan
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Other pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('transaksi.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('transaksi.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-credit-card
             ps-2 pe-2 text-center text-dark {{ (Request::routeIs('transaksi.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Pengajuan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('aset.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('aset.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa-solid fa-database fa-layer-group ps-2 pe-2 text-center text-dark {{ (Request::routeIs('aset.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Aset</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('kategoriaset.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('kategoriaset.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa-solid fa-database ps-2 pe-2 text-center text-dark {{ (Request::routeIs('kategoriaset.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Kategori Aset</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lokasiaset.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('info-layanan.*') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-window-restore ps-2 pe-2 text-center text-dark {{ (Request::routeIs('info-layanan.*') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Lokasi Aset</span>
        </a>
      </li>
    </ul>
  </div>
</aside>