@extends('layouts.app')

@section('title', 'Profil | Sistem Inventaris Barang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-card-wrapper">
        
        <!-- User Identity Card -->
        <div class="card user-info-card">
            <img src="{{ asset('assets/img/user.png') }}" class="profile-avatar-large">
            <h2 class="profile-name-title">{{ auth()->user()->nama_pengguna }}</h2>
            <div class="profile-role-badge">Administrator</div>
            
            <div style="margin-top: 30px; border-top: 1px solid #f0f3ff; padding-top: 20px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-update" style="background: #dc2626;">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="card">
            <h3 class="section-title">Pengaturan Akun</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" value="{{ auth()->user()->nama_pengguna }}" readonly>
            </div>

            <h3 class="section-title" style="margin-top: 40px;">Ganti Kata Sandi</h3>
            
            <form action="{{ route('profil.update-password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required>
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kata Sandi Baru</label>
                    <input type="password" name="new_password" required>
                    @error('new_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn-update">Perbarui Kata Sandi</button>
            </form>
        </div>

    </div>
</div>
@endsection
