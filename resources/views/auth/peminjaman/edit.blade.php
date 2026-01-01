@extends('layouts.tambah-barang-masuk')

@section('content')
<h1 class="page-title">Edit Status Peminjaman</h1>

<form action="{{ route('peminjaman.update', $pinjam->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="input-wrapper-kib">
        <div class="form-group">
            <label>Status Peminjaman</label>
            <select name="status" required>
                <option value="Belum Dikembalikan"
                    {{ in_array($pinjam->status, ['Belum Dikembalikan', 'Dipinjam']) ? 'selected' : '' }}>
                    Belum Dikembalikan
                </option>
                <option value="Sudah Dikembalikan"
                    {{ in_array($pinjam->status, ['Sudah Dikembalikan', 'Dikembalikan']) ? 'selected' : '' }}>
                    Sudah Dikembalikan
                </option>
            </select>
        </div>

        <div class="bottom-buttons">
            <a href="{{ route('peminjaman.index') }}" class="btn-grey">Batal</a>
            <button type="submit" class="btn-blue">Simpan</button>
        </div>
    </div>
</form>
@endsection
