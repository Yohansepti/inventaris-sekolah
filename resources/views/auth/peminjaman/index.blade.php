@extends('layouts.app')

@section('title', 'Peminjaman | Sistem Inventaris')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/peminjaman.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/print-p.css') }}" media="print">
@endpush

@section('content')
    <h1 class="page-title">Peminjaman</h1>

    <div class="print-header-peminjaman" style="display:none;">
        <img src="{{ asset('assets/img/logo.png') }}">
        <h2>SMP Negeri 11 Kupang</h2>
        <h3>Laporan Peminjaman Barang</h3>
        <p>Tahun: <span id="tahunCetak"></span></p>
    </div>

    <div class="top-row">
        <div class="tahun-select">
            <span>Tahun</span>
            <select id="filterTahun">
                @php $currentY = date('Y'); @endphp
                @for($y = $currentY; $y >= 2023; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="button-group">
            <a href="{{ route('peminjaman.create') }}" class="btn-blue">+ Tambah</a>
            <a href="{{ route('peminjaman.print', ['tahun' => $tahun]) }}" 
               target="_blank" 
               class="btn-green">Cetak</a>
        </div>
    </div>

    <div class="table-wrapper-in">
        <table class="table-in" id="tablePinjam">
            <thead>
                <tr>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pesan</th>
                    <th>Guru Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jam Pemakaian</th>
                    <th>Ruang Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $p)
                    <tr>
                        <td>{{ $p->tanggal_peminjaman }}</td>
                        <td>{{ $p->tanggal_pesan }}</td>
                        <td>{{ $p->guru->nama ?? '-' }}</td>
                        <td>{{ $p->kode_barang }} (KIB {{ strtoupper($p->jenis_kib) }})</td>
                        <td>{{ $p->jam_pemakaian }}</td>
                        <td>{{ $p->ruang->nama_ruangan ?? '-' }}</td>
                        <td>{{ $p->tanggal_pengembalian ?? '-' }}</td>
                        <td>
                            <span class="{{ strtolower($p->status) == 'dikembalikan' ? 'badge-green' : 'badge-red' }}">
                                {{ strtolower($p->status) == 'dikembalikan' ? 'Sudah Dikembalikan' : 'Belum Dikembalikan' }}
                            </span>
                        </td>
                        <td class="aksi">
                            <div class="aksi-wrapper">
                                <a href="{{ route('peminjaman.edit', $p->id) }}" class="btn-aksi btn-edit">Edit</a>
                                <form action="{{ route('peminjaman.destroy', $p->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus data peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-aksi btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Data peminjaman tidak tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="editModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>Edit Status Peminjaman</h3>

            <label>Status</label>
            <select id="editStatus">
                <option value="Dipinjam">Belum Dikembalikan</option>
                <option value="Dikembalikan">Sudah Dikembalikan</option>
            </select>

            <div class="modal-buttons">
                <button id="modalCancel" class="btn-grey">Batal</button>
                <button id="modalSave" class="btn-blue">Simpan</button>
            </div>
        </div>
    </div>

    <p class="jumlah-barang">
        Jumlah: <span id="totalPinjam">{{ $data->count() }}</span>
    </p>

    <div class="print-footer-peminjaman" style="display:none;">
        <div>
            Kupang, __________ 2025<br>
            Kepala Sekolah<br><br>
            <div class="ttd-space"></div>
            <u>______________________</u><br>
            NIP: ____________________
        </div>

        <div>
            Petugas Inventaris<br><br>
            <div class="ttd-space"></div>
            <u>______________________</u><br>
            NIP: ____________________
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/peminjaman.js') }}"></script>
@endpush
