@extends('layouts.barang-masuk')

@section('title', 'Barang Masuk | Sistem Inventaris')

@section('page-content')

<h1 class="page-title">Barang Masuk</h1>

<div class="top-row">

    {{-- FILTER --}}
    <form method="GET" class="filter-bar">
        <label>Tahun</label>
        <select name="tahun">
            @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                    {{ $t }}
                </option>
            @endfor
        </select>

        <label>Jenis KIB</label>
        <select name="kib">
            <option value="all" {{ $filterKib == 'all' ? 'selected' : '' }}>
                Semua
            </option>

            @foreach(['a','b','c','d','e','f'] as $k)
                <option value="{{ $k }}" {{ $filterKib == $k ? 'selected' : '' }}>
                    KIB {{ strtoupper($k) }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-blue">Filter</button>
    </form>

    {{-- BUTTON --}}
    <div class="button-group">
        <a href="{{ route('barang-masuk.create') }}" class="btn-blue">
            + Tambah
        </a>
        <a href="{{ route('barang-masuk.print', ['tahun' => $tahun, 'kib' => $filterKib]) }}" 
           target="_blank" 
           class="btn-green">
            Cetak
        </a>
    </div>

</div>

{{-- TABLE --}}
<div class="table-wrapper-in">
    <table class="table-in">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis KIB</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah</th>
                <th>Guru Penerima</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($data as $d)
            <tr>
                <td>{{ $d->kode_barang }}</td>
                <td>{{ $d->barang->nama_barang ?? '-' }}</td>
                <td>KIB {{ $d->jenis_kib }}</td>
                <td>{{ $d->tanggal_masuk }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>{{ $d->guru->nama ?? '-' }}</td>
                <td>{{ $d->ruang->nama_ruangan ?? '-' }}</td>
                <td class="aksi">
                    <div class="aksi-wrapper">
                        <a href="{{ route('barang-masuk.edit', $d->id) }}" class="btn-aksi btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('barang-masuk.destroy', $d->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-aksi btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center">
                    Belum ada data barang masuk
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<p class="jumlah-barang">
    Jumlah: {{ $data->count() }}
</p>

@endsection
