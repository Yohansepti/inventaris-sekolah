@extends('layouts.app')

@section('title', 'Data Ruang | Sistem Inventaris Barang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/guru.css') }}">
@endpush

@section('content')
    <h1 class="page-title">Data Ruang</h1>

    <div class="top-row">
        <div class="button-area">
            <a href="{{ route('ruang.create') }}" class="btn-blue">+ Tambah</a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="ruangTableBody">
                @forelse ($ruang as $r)
                    <tr>
                        <td>{{ $r->kode_ruangan }}</td>
                        <td>{{ $r->nama_ruangan }}</td>
                        <td class="aksi">
                            <div class="aksi-wrapper">
                                <a href="{{ route('ruang.edit', $r->kode_ruangan) }}" class="btn-aksi btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('ruang.destroy', $r->kode_ruangan) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus data ruang ini?')">
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
                        <td colspan="2">Tidak ada data ruang</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="total">Jumlah: <span id="jumlahRuang">{{ $ruang->count() }}</span></div>
@endsection
