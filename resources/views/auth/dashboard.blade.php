@extends('layouts.app')

@section('title', 'Dashboard | Sistem Inventaris Barang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endpush

@section('content')
    <h1 class="welcome-text">Selamat Datang!</h1>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-title">Total Barang </div>
            <div class="stat-value" id="stat-kib">{{ $totalKib ?? 0 }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Barang Masuk Bulan Ini</div>
            <div class="stat-value" id="stat-masuk">{{ $barangMasuk ?? 0 }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Peminjaman Bulan Ini</div>
            <div class="stat-value" id="stat-pinjam">{{ $peminjaman ?? 0 }}</div>
        </div>
    </div>

    <h4 class="kib-subtitle">Jumlah barang per KIB</h4>

    <div class="kib-grid">
        @foreach(['A','B','C','D','E','F'] as $kib)
            <div class="kib-card">
                <div class="kib-title">KIB {{ $kib }}</div>
                <div class="kib-count" id="count{{ $kib }}">{{ $jumlahPerKib[$kib] ?? 0 }}</div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')    
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
