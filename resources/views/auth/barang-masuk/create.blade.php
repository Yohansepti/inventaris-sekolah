@extends('layouts.barang-masuk')

@section('title', 'Input Barang Masuk')

@section('page-content')

<h1 class="page-title">Input Barang Masuk</h1>

<div class="form-container">
<form method="POST" action="{{ route('barang-masuk.store') }}" class="form-grid">
@csrf

{{-- 1. JENIS KIB --}}
<div class="form-group full">
    <label>Jenis KIB</label>
    <select name="jenis_kib" id="kibSelect" required>
        <option value="">-- Pilih KIB --</option>
        <option value="a">KIB A</option>
        <option value="b">KIB B</option>
        <option value="c">KIB C</option>
        <option value="d">KIB D</option>
        <option value="e">KIB E</option>
        <option value="f">KIB F</option>
    </select>
</div>

{{-- 2. NAMA BARANG (SEARCHABLE) --}}
<div class="form-group full">
    <label>Nama Barang</label>
    <select name="kode_barang" id="barangSelect" required>
        <option value="">-- Pilih barang --</option>
    </select>
</div>

{{-- 3. TANGGAL --}}
<div class="form-group">
    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" required>
</div>

{{-- 4. JUMLAH --}}
<div class="form-group">
    <label>Jumlah</label>
    <input type="number" name="jumlah" required>
</div>

{{-- 5. GURU --}}
<div class="form-group">
    <label>Guru Penerima</label>
    <select name="guru_id" id="guruSelect" required>
    <option value="">-- Pilih Guru --</option>
    @foreach($guru as $g)
        <option value="{{ $g->id }}">
            {{ $g->nama }} ({{ $g->nip ?? '-' }})
        </option>
    @endforeach
</select>
</div>

{{-- 6. RUANG --}}
<div class="form-group">
    <label>Ruang</label>
    <select name="ruang_kode" id="ruangSelect" required>
        <option value="">-- Pilih Ruang --</option>
        @foreach($ruang as $r)
            <option value="{{ $r->kode_ruangan }}">
                {{ $r->nama_ruangan }}
            </option>
        @endforeach
    </select>
</div>

<div class="full bottom-buttons">
    <a href="{{ route('barang-masuk.index') }}" class="btn-grey">Batal</a>
    <button type="submit" class="btn-blue">Simpan</button>
</div>

</form>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#kibSelect').on('change', function() {
        var jenis = $(this).val();
        var $barangSelect = $('#barangSelect');

        // Clear existing options
        $barangSelect.empty().append('<option value="">-- Pilih barang --</option>');
        
        if (jenis) {
            $.ajax({
                url: '/api/barang-by-kib/' + jenis,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    data.forEach(function(item) {
                        var option = new Option(item.nama_barang + ' (' + item.kode_barang + ')', item.kode_barang, false, false);
                        $barangSelect.append(option);
                    });
                    $barangSelect.trigger('change');
                },
                error: function() {
                    alert('Gagal mengambil data barang.');
                }
            });
        } else {
            $barangSelect.trigger('change');
        }
    });
});
</script>
@endpush
