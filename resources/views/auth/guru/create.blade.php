@extends('layouts.tambah-barang-masuk')

@section('content')
<h1 class="page-title">Input Data Guru</h1>

<div class="input-wrapper-kib">
<form action="{{ route('guru.store') }}" method="POST" class="form-grid">
    @csrf

    {{-- NIP --}}
    <div class="form-group">
        <label>NIP</label>
        <input 
            type="text" 
            name="nip"
            value="{{ old('nip') }}"
            placeholder="NIP atau (-) jika tidak ada"
            required
        >
        @error('nip')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- Nama Guru --}}
    <div class="form-group">
        <label>Nama Guru</label>
        <input 
            type="text" 
            name="nama"
            value="{{ old('nama') }}"
            placeholder="Nama guru"
            required
        >
        @error('nama')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- Jabatan --}}
    <div class="form-group">
        <label>Jabatan</label>
        <input 
            type="text" 
            name="jabatan"
            value="{{ old('jabatan') }}"
            placeholder="Jabatan guru"
            required
        >
        @error('jabatan')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="bottom-buttons">
        <a href="{{ route('guru.index') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>
</form>
</div>
@endsection
