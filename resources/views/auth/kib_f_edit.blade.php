@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Barang KIB F')

@section('content')

<h1 class="page-title">Edit Barang KIB F</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.f.update', $kibF->kode_barang) }}"
      method="POST" 
      class="form-grid">

    @csrf
    @method('PUT')

    {{-- KODE BARANG (readonly) --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               value="{{ $kibF->kode_barang }}"
               readonly>
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               value="{{ $kibF->barang->nama_barang }}"
               required>
    </div>

    {{-- MERK --}}
    <div class="form-group">
        <label>Merk</label>
        <input type="text" name="merk" value="{{ $kibF->merk }}" required>
    </div>

    {{-- TIPE --}}
    <div class="form-group">
        <label>Tipe</label>
        <input type="text" name="tipe" value="{{ $kibF->tipe }}" required>
    </div>

    {{-- KEADAAN --}}
    <div class="form-group">
        <label>Keadaan</label>
        <select name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="Baik" {{ $kibF->keadaan == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ $kibF->keadaan == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ $kibF->keadaan == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
    </div>
    
   {{-- SUMBER DANA --}}
<div class="form-group">
    <label>Sumber Dana</label>
    <select name="kode_sumber_dana" required>
        <option value="">-- Pilih Sumber Dana --</option>
        @foreach($sumberDana as $sd)
            <option value="{{ $sd->kode_sumber_dana }}" 
                {{ (old('kode_sumber_dana', $kibF->barang->kode_sumber_dana) == $sd->kode_sumber_dana) ? 'selected' : '' }}>
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
               value="{{ $kibF->barang->harga }}"
               required>
    </div>

    <div class="form-actions">
        <a href="{{ route('kib.f') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan Perubahan</button>
    </div>

</form>
</div>

@endsection
