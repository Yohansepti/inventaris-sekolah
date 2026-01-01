@extends('layouts.app')

@section('title', 'Data Guru | Sistem Inventaris Barang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/guru.css') }}">
@endpush

@section('content')
    <h1 class="page-title">Data Guru</h1>

    <div class="top-row">
        <div class="button-area">
            <a href="{{ route('guru.create') }}" class="btn-blue">+ Tambah</a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="guruTableBody">
                @forelse ($guru as $g)
                    <tr>
                        <td>{{ $g->nip ?? '-' }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->jabatan }}</td>
                        <td class="aksi">
                <div class="aksi-wrapper">
                <a href="{{ route('guru.edit', $g->id) }}" class="btn-aksi btn-edit">Edit</a>

                <form action="{{ route('guru.destroy', $g->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus data guru ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-aksi btn-delete">Hapus</button>
                </form>
                </div>
            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data guru</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="total">Jumlah: <span id="jumlahGuru">{{ $guru->count() }}</span></div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/guru.js') }}"></script>
@endpush
