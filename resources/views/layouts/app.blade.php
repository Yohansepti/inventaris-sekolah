<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Inventaris Barang')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>
<body>

<!-- TOPBAR-->
<div class="topbar">
    <div class="left-top">
        <img src="{{ asset('assets/img/logo.png') }}" class="logo">
        <span class="school-title">SMP Negeri 11 Kupang</span>
    </div>

    <div class="right-top">
        <div class="user-profile-wrapper" id="userMenuTrigger">
            <img src="{{ asset('assets/img/user.png') }}" class="user-photo">
            <span class="user-name-top">
                {{ auth()->check() ? auth()->user()->nama_pengguna : 'User' }}
            </span>
            
            <div class="user-dropdown-menu" id="userDropdown">
                <a href="{{ route('profil') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout-dropdown">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  SIDEBAR  -->
<div class="sidebar">

    <a href="{{ route('dashboard') }}" class="menu-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
        Beranda
    </a>

    <!-- BARANG -->
    <div class="menu-dropdown">
        <button class="menu-item dropdown-btn {{ Request::routeIs('kib.*') ? 'active active-dropdown' : '' }}">
            Barang ▾
        </button>
        <div class="dropdown-content" style="{{ Request::routeIs('kib.*') ? 'display: block;' : '' }}">
            <a href="{{ route('kib.a') }}" class="{{ Request::routeIs('kib.a') ? 'active-sub' : '' }}">KIB A</a>
            <a href="{{ route('kib.b') }}" class="{{ Request::routeIs('kib.b') ? 'active-sub' : '' }}">KIB B</a>
            <a href="{{ route('kib.c') }}" class="{{ Request::routeIs('kib.c') ? 'active-sub' : '' }}">KIB C</a>
            <a href="{{ route('kib.d') }}" class="{{ Request::routeIs('kib.d') ? 'active-sub' : '' }}">KIB D</a>
            <a href="{{ route('kib.e') }}" class="{{ Request::routeIs('kib.e') ? 'active-sub' : '' }}">KIB E</a>
            <a href="{{ route('kib.f') }}" class="{{ Request::routeIs('kib.f') ? 'active-sub' : '' }}">KIB F</a>
        </div>
    </div>

    <a href="{{ route('barang-masuk.index') }}" class="menu-item {{ Request::routeIs('barang-masuk.*') ? 'active' : '' }}">
        Barang Masuk
    </a>

    <a href="{{ route('peminjaman.index') }}" class="menu-item {{ Request::routeIs('peminjaman.*') ? 'active' : '' }}">
        Peminjaman
    </a>

    <a href="{{ route('guru.index') }}" class="menu-item {{ Request::routeIs('guru.*') ? 'active' : '' }}">
        Guru
    </a>

    <a href="{{ route('ruang.index') }}" class="menu-item {{ Request::routeIs('ruang.*') ? 'active' : '' }}">
        Ruang
    </a>

</div>

<!--  MAIN CONTENT  -->
<div class="main-content">
    @yield('content')
</div>

<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@stack('scripts')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#barangSelect').select2({
            placeholder: "Ketik nama barang...",
            allowClear: true,
            width: '100%'
        });
    });
</script>

</body>
</html>
