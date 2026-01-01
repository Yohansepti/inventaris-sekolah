@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Barang KIB D')

@section('content')

<h1 class="page-title">Edit Barang KIB D</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.d.update', $kibD->kode_barang) }}" 
      method="POST" 
      class="form-grid">

    @csrf
    @method('PUT')

    {{-- KODE BARANG (readonly) --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               value="{{ $kibD->kode_barang }}"
               readonly>
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               value="{{ $kibD->barang->nama_barang }}"
               required>
    </div>

    {{-- UKURAN --}}
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text"
               name="ukuran"
               value="{{ $kibD->ukuran }}">
    </div>

    {{-- BAHAN --}}
    <div class="form-group">
        <label>Bahan</label>
        <input type="text"
               name="bahan"
               value="{{ $kibD->bahan }}">
    </div>

    {{-- NO. PABRIK --}}
    <div class="form-group">
        <label>No. Pabrik</label>
        <input type="text"
               name="nomor_pabrik"
               value="{{ $kibD->nomor_pabrik }}">
    </div>

    {{-- NO. MESIN --}}
    <div class="form-group">
        <label>No. Mesin</label>
        <input type="text" name="nomor_mesin" value="{{ $kibD->nomor_mesin }}" required>
    </div>

    {{-- NO. RANGKA --}}
    <div class="form-group">
        <label>No. Rangka</label>
        <input type="text" name="nomor_rangka" value="{{ $kibD->nomor_rangka }}" required>
    </div>

    {{-- KEADAAN --}}
    <div class="form-group">
        <label>Keadaan</label>
        <select name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="Baik" {{ $kibD->keadaan == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ $kibD->keadaan == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ $kibD->keadaan == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
    </div>
    
    {{-- SUMBER DANA --}}
<div class="form-group">
    <label>Sumber Dana</label>
    <select name="kode_sumber_dana" required>
        <option value="">-- Pilih Sumber Dana --</option>
        @foreach($sumberDana as $sd)
            <option value="{{ $sd->kode_sumber_dana }}" 
                {{ (old('kode_sumber_dana', $kibD->barang->kode_sumber_dana) == $sd->kode_sumber_dana) ? 'selected' : '' }}>
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
               value="{{ $kibD->barang->harga }}"
               required>
    </div>

    <div class="form-actions">
        <a href="{{ route('kib.d') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan Perubahan</button>
    </div>

</form>
</div>

@endsection
