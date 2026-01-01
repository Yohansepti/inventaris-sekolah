<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="Logo Sekolah">
            <span class="school-title">SMP Negeri 11 Kupang</span>
        </div>
        <div class="header-right">
            <span class="system-title">Sistem Inventaris Barang</span>
        </div>
    </header>

    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Masuk</h2>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <label for="nama_pengguna">Nama Pengguna</label>
                <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Masukan nama pengguna" value="{{ old('nama_pengguna') }}">
                @error('nama_pengguna')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="kata_sandi">Kata Sandi</label>
                <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Masukan kata sandi">
                @error('kata_sandi')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button class="btn-login" type="submit">Masuk</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>
</html>
