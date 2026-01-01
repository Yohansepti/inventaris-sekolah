@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Ruangan')

@section('content')

<h1 class="page-title">Edit Data Ruangan</h1>

<div class="input-wrapper-kib">
<form action="{{ route('ruang.update', $ruang->kode_ruangan) }}" method="POST" class="form-card">
    @csrf
    @method('PUT')

    

        <div class="form-group">
            <label>Kode Ruangan</label>
            <input type="text" name="kode_ruangan" value="{{ $ruang->kode_ruangan }}" readonly>
        </div>

        <div class="form-group">
            <label>Nama Ruangan</label>
            <input type="text" name="nama_ruangan" value="{{ $ruang->nama_ruangan }}" required>
        </div>



    <div class="form-actions">
        <a href="{{ route('ruang.index') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>
</form>
    </div>

@endsection
