@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Barang KIB B')

@section('content')
 
<h1 class="page-title">Edit Barang KIB B</h1>

<div class="input-wrapper-kib">
<form action="{{ route('kib.b.update', $kibB->kode_barang) }}" 
      method="POST" 
      class="form-grid">

    @csrf
    @method('PUT')

    {{-- KODE BARANG (readonly) --}}
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text"
               value="{{ $kibB->kode_barang }}"
               readonly>
    </div>

    {{-- NAMA BARANG --}}
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text"
               name="nama_barang"
               value="{{ $kibB->barang->nama_barang }}"
               required>

        @error('nama_barang')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- MERK --}}
    <div class="form-group">
        <label>Merk</label>
        <input type="text" name="merk" value="{{ $kibB->merk }}" required>

        @error('merk')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- TIPE --}}
    <div class="form-group">
        <label>Tipe</label>
        <input type="text" name="tipe" value="{{ $kibB->tipe }}" required>

        @error('tipe')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
    
    {{-- UKURAN --}}
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text"
               name="ukuran"
               value="{{ $kibB->ukuran }}"
               required>

        @error('ukuran')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- BAHAN --}}
    <div class="form-group">
        <label>Bahan</label>
        <input type="text" name="bahan" value="{{ $kibB->bahan }}" required>

        @error('bahan')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    {{-- KEADAAN --}}
    <div class="form-group">
        <label>Keadaan</label>
        <select name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="Baik" {{ $kibB->keadaan == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ $kibB->keadaan == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ $kibB->keadaan == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
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
                {{ (old('kode_sumber_dana', $kibB->barang->kode_sumber_dana) == $sd->kode_sumber_dana) ? 'selected' : '' }}>
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
               value="{{ $kibB->barang->harga }}"
               required>

        @error('harga')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-actions">
        <a href="{{ route('kib.b') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan Perubahan</button>
    </div>

</form>
</div>

@endsection
