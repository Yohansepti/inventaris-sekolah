@extends('layouts.tambah-barang-masuk')

@section('title', 'Edit Guru')

@section('content')

<h1 class="page-title">Edit Data Guru</h1>

<div class="input-wrapper-kib">
<form action="{{ route('guru.update', $guru->id) }}" method="POST" class="form-card">
    @csrf
    @method('PUT')

    <div class="form-grid">

        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" value="{{ $guru->nip }}">
        </div>

        <div class="form-group">
            <label>Nama Guru</label>
            <input type="text" name="nama" value="{{ $guru->nama }}" required>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ $guru->jabatan }}" required>
        </div>

    </div>

    <div class="form-actions">
        <a href="{{ route('guru.index') }}" class="btn-grey">Batal</a>
        <button type="submit" class="btn-blue">Simpan</button>
    </div>
</form>
</div>

@endsection
