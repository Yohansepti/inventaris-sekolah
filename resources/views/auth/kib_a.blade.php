@extends('layouts.app')

@section('title', 'KIB A | Sistem Inventaris Barang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/guru.css') }}">
@endpush

@section('content')
    <h1 class="page-title">Data Barang KIB A</h1>

    <div class="top-row">
        <form method="GET" action="{{ route('kib.a') }}" class="search-row">
            <span class="search-label">Cari</span>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="search-input"
                   placeholder="Nama Barang">

            <button type="submit" class="btn-search">Cari</button>

            @if(request('search'))
                <a href="{{ route('kib.a') }}" class="btn-grey">✖</a>
            @endif 
        </form>
        
        <div class="button-area">
            <a href="{{ route('kib.a.create') }}" class="btn-blue">+ Tambah Barang</a>
        </div>
    </div>

    <div class="table-wrapper"> 
        <table class="data-table" id="kibTable">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Sumber Dana</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kibA as $item)
                    <tr>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->ukuran ?? '-' }}</td>
                        <td>{{ $item->barang->sumber_dana ?? '-' }}</td>
                        <td>{{ $item->barang->harga ?? '-' }}</td>
                        <td class="aksi">
                            <div class="aksi-wrapper">
                                <a href="{{ route('kib.a.edit', $item->kode_barang) }}" class="btn-aksi btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('kib.a.destroy', $item->kode_barang) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus barang ini?')">
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
                        <td colspan="6" style="text-align:center">
                            Belum ada data KIB A
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="total">Jumlah: <span>{{ $kibA->count() }}</span></div>

@endsection
