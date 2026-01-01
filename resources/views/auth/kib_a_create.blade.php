@extends('layouts.tambah-barang-masuk')

@section('content')
<h1 class="page-title">Tambah Barang KIB A</h1>

<div class="input-wrapper-kib">
<form method="POST" action="{{ route('kib.a.store') }}" class="form-grid">
    @csrf

    {{-- KODE BARANG --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input 
            type="text" 
            name="kode_barang"
            value="{{ old('kode_barang') }}"
            placeholder="Contoh: KIBA001"
            required
        >

        @error('kode_barang')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input 
            type="text" 
            name="nama_barang"
            value="{{ old('nama_barang') }}"
            placeholder="Contoh: Meja Belajar"
            required
        >

        @error('nama_barang')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- UKURAN --}}
    <div class="form-group">
        <label>Ukuran</label>
        <input 
            type="text" 
            name="ukuran"
            value="{{ old('ukuran') }}"
            placeholder="Contoh: 100 x 50 cm"
            required
        >

        @error('ukuran') 
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- SUMBER DANA --}}
<div class="form-group">
    <label>Sumber Dana</label>
    <select name="kode_sumber_dana" required>
        <option value="">-- Pilih Sumber Dana --</option>

        @foreach($sumberDana as $sd)
            <option value="{{ $sd->kode_sumber_dana }}"
                {{ old('kode_sumber_dana') == $sd->kode_sumber_dana ? 'selected' : '' }}>
                {{ $sd->nama_sumber_dana }}
            </option>
        @endforeach
    </select>

    @error('kode_sumber_dana')
        <small style="color:red;">{{ $message }}</small>
    @enderror
</div>


    {{-- HARGA --}}
    <div class="form-group">
        <label>Harga</label>
        <input 
            type="number" 
            name="harga"
            value="{{ old('harga') }}"
            placeholder="Contoh: 500000"
            required
        >

        @error('harga')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="bottom-buttons">
        <a href="{{ route('kib.a') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>
</form>
</div>
@endsection
