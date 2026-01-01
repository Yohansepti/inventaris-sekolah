@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Barang KIB C')

@section('content')

<h1 class="page-title">Edit Barang KIB C</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.c.update', $kibC->kode_barang) }}" 
      method="POST" 
      class="form-grid">

    @csrf
    @method('PUT')

    {{-- KODE BARANG (readonly) --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               value="{{ $kibC->kode_barang }}"
               readonly>
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               value="{{ $kibC->barang->nama_barang }}"
               required>
    </div>

    {{-- UKURAN --}}
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text"
               name="ukuran"
               value="{{ $kibC->ukuran }}">
    </div>

    {{-- SUMBER DANA --}}
<div class="form-group">
    <label>Sumber Dana</label>
    <select name="kode_sumber_dana" required>
        <option value="">-- Pilih Sumber Dana --</option>
        @foreach($sumberDana as $sd)
            <option value="{{ $sd->kode_sumber_dana }}" 
                {{ (old('kode_sumber_dana', $kibC->barang->kode_sumber_dana) == $sd->kode_sumber_dana) ? 'selected' : '' }}>
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
               value="{{ $kibC->barang->harga }}"
               required>
    </div>

    <div class="form-actions">
        <a href="{{ route('kib.c') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan Perubahan</button>
    </div>

</form>
</div>

@endsection
