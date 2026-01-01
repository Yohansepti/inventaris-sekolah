@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Barang KIB E')

@section('content')

<h1 class="page-title">Edit Barang KIB E</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.e.update', $kibE->kode_barang) }}" 
      method="POST" 
      class="form-grid">

    @csrf
    @method('PUT')

    {{-- KODE BARANG (readonly) --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               value="{{ $kibE->kode_barang }}"
               readonly>
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               value="{{ $kibE->barang->nama_barang }}"
               required>
    </div>

    {{-- MERK --}}
    <div class="form-group">
        <label>Merk</label>
        <input type="text" name="merk" value="{{ $kibE->merk }}" required>
    </div>

    {{-- TIPE --}}
    <div class="form-group">
        <label>Tipe</label>
        <input type="text" name="tipe" value="{{ $kibE->tipe }}" required>
    </div>

    {{-- BAHAN --}}
    <div class="form-group">
        <label>Bahan</label>
        <input type="text" name="bahan" value="{{ $kibE->bahan }}" required>
    </div>

    {{-- KEADAAN --}}
    <div class="form-group">
        <label>Keadaan</label>
        <select name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="Baik" {{ $kibE->keadaan == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ $kibE->keadaan == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ $kibE->keadaan == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
    </div>
    
    {{-- SUMBER DANA --}}
<div class="form-group">
    <label>Sumber Dana</label>
    <select name="kode_sumber_dana" required>
        <option value="">-- Pilih Sumber Dana --</option>
        @foreach($sumberDana as $sd)
            <option value="{{ $sd->kode_sumber_dana }}" 
                {{ (old('kode_sumber_dana', $kibE->barang->kode_sumber_dana) == $sd->kode_sumber_dana) ? 'selected' : '' }}>
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
        <input type="number"
               name="harga"
               value="{{ $kibE->barang->harga }}"
               required>
    </div>

    <div class="form-actions">
        <a href="{{ route('kib.e') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan Perubahan</button>
    </div>

</form>
</div>

@endsection
