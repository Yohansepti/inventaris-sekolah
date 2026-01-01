@extends('layouts.tambah-barang-masuk')

@section('title', 'Input Peminjaman | Sistem Inventaris')

@section('content')
<div class="main-content">

    <h1 class="page-title">Input Peminjaman</h1>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="input-wrapper-kib">
            <div class="form-grid">


                <div class="form-group">
                    <label>Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Pesan</label>
                    <input type="date" name="tanggal_pesan" required>
                </div>

                                <div class="form-group">
                    <label>Guru Peminjam</label>
                    <select name="guru_id" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}">
                                {{ $g->nip }} - {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <select name="kode_barang" id="barangSelect" class="select-search" required>
                        <option value="">-- Cari Nama Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->kode_barang }}">
                                {{ $b->nama_barang }} ({{ $b->kode_barang }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jam Pemakaian</label>
                    <input type="text" name="jam_pemakaian"
                           placeholder="Contoh: 08:00 - 10:00" required>
                </div>

                <div class="form-group full">
                    <label>Ruang Peminjaman</label>
                    <select name="ruang_kode" required>
                        <option value="">-- Pilih Ruang --</option>
                        @foreach($ruang as $r)
                            <option value="{{ $r->kode_ruangan }}">
                                {{ $r->nama_ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian">
                </div>

            </div>

            <div class="bottom-buttons">
                <a href="{{ route('peminjaman.index') }}" class="btn-grey">Batal</a>
                <button type="submit" class="btn-blue">Simpan</button>
            </div>
        </div>

    </form>

</div>
@endsection

