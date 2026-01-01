@extends('layouts.tambah-barang-masuk')

@section('content')
<h1 class="page-title">Input Data Ruang</h1>

<div class="input-wrapper-kib">
<form action="{{ route('ruang.store') }}" method="POST" class="form-grid">
    @csrf

    {{-- KODE RUANGAN --}}
    <div class="form-group">
        <label>Kode Ruangan</label>
        <input 
            type="text" 
            name="kode_ruangan"
            value="{{ old('kode_ruangan') }}"
            placeholder="Contoh: R001"
            maxlength="4"
            required
        >

        @error('kode_ruangan')
            <small style="color:red;">Kode tidak valid</small>
        @enderror
    </div>

    {{-- NAMA RUANGAN --}}
    <div class="form-group">
        <label>Nama Ruangan</label>
        <input 
            type="text" 
            name="nama_ruangan"
            value="{{ old('nama_ruangan') }}"
            placeholder="Contoh: Kelas IX A"
            required
        >
    </div>

    <div class="bottom-buttons">
        <a href="{{ route('ruang.index') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>
</form>
</div>
@endsection
