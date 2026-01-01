@extends('layouts.tambah-barang-masuk')

@section('content')

<h1 class="page-title">Input Barang KIB B</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.b.store') }}" method="POST" class="form-grid">
    @csrf

    {{-- KODE BARANG --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Contoh: KIBB001" required>
        @error('kode_barang')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Kursi" required>
        @error('nama_barang')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- MERK --}}
    <div class="form-group">
        <label>Merk</label>
        <input type="text" name="merk" value="{{ old('merk') }}" placeholder="Contoh: Futura" required>
        @error('merk')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- TIPE --}}
    <div class="form-group">
        <label>Tipe</label>
        <input type="text" name="tipe" value="{{ old('tipe') }}" placeholder="Contoh: Ergonomis" required>
        @error('tipe')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- UKURAN --}}
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text" name="ukuran" value="{{ old('ukuran') }}" placeholder="Contoh: M" required>
        @error('ukuran')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- BAHAN --}}
    <div class="form-group">
        <label>Bahan</label>
        <input type="text" name="bahan" value="{{ old('bahan') }}" placeholder="Contoh: Plastik" required>
        @error('bahan')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- KEADAAN --}}
    <div class="form-group">
        <label>Keadaan</label>
        <select name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="Baik" {{ old('keadaan') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ old('keadaan') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ old('keadaan') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
        @error('keadaan')
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
        <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 500000" required>
        @error('harga')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="bottom-buttons">
        <a href="{{ route('kib.b') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>

</form>
</div>

@endsection
