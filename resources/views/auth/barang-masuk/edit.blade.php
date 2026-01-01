@extends('layouts.barang-masuk')

@section('title', 'Edit Barang Masuk')

@section('page-content')

<h1 class="page-title">Edit Barang Masuk</h1>

<div class="form-container">
<form method="POST"
      action="{{ route('barang-masuk.update', $data->id) }}"
      class="form-grid">

@csrf
@method('PUT')

{{-- 1. JENIS KIB --}}
<div class="form-group full">
    <label>Jenis KIB</label>
    <select name="jenis_kib" id="kibSelect" required>
        <option value="">-- Pilih KIB --</option>
        <option value="a" {{ $data->jenis_kib == 'a' ? 'selected' : '' }}>KIB A</option>
        <option value="b" {{ $data->jenis_kib == 'b' ? 'selected' : '' }}>KIB B</option>
        <option value="c" {{ $data->jenis_kib == 'c' ? 'selected' : '' }}>KIB C</option>
        <option value="d" {{ $data->jenis_kib == 'd' ? 'selected' : '' }}>KIB D</option>
        <option value="e" {{ $data->jenis_kib == 'e' ? 'selected' : '' }}>KIB E</option>
        <option value="f" {{ $data->jenis_kib == 'f' ? 'selected' : '' }}>KIB F</option>
    </select>
</div>

{{-- 2. NAMA BARANG --}}
<div class="form-group full">
    <label>Nama Barang</label>
    <select name="kode_barang" id="barangSelect" required>
        <option value="">-- Pilih barang --</option>
        {{-- jika pakai ajax/select2, value lama tetap dikirim --}}
        <option value="{{ $data->kode_barang }}" selected>
            {{ $data->kode_barang }}
        </option>
    </select>
</div>

{{-- 3. TANGGAL --}}
<div class="form-group">
    <label>Tanggal Masuk</label>
    <input type="date"
           name="tanggal_masuk"
           value="{{ $data->tanggal_masuk }}"
           required>
</div>

{{-- 4. JUMLAH --}}
<div class="form-group">
    <label>Jumlah</label>
    <input type="number"
           name="jumlah"
           value="{{ $data->jumlah }}"
           min="1"
           required>
</div>

{{-- 5. GURU --}}
<div class="form-group">
    <label>Guru Penerima</label>
    <select name="guru_id" id="guruSelect" required>
        <option value="">-- Pilih Guru --</option>
        @foreach($guru as $g)
            <option value="{{ $g->id }}"
                {{ $data->guru_id == $g->id ? 'selected' : '' }}>
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
            <option value="{{ $r->kode_ruangan }}"
                {{ $data->ruang_kode == $r->kode_ruangan ? 'selected' : '' }}>
                {{ $r->nama_ruangan }}
            </option>
        @endforeach
    </select>
</div>

<div class="full bottom-buttons">
    <a href="{{ route('barang-masuk.index') }}" class="btn-grey">
        Batal
    </a>
    <button type="submit" class="btn-blue">
        Update
    </button>
</div>

</form>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    function loadBarang(jenis, selectedId = null) {
        var $barangSelect = $('#barangSelect');
        $.ajax({
            url: '/api/barang-by-kib/' + jenis,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $barangSelect.empty().append('<option value="">-- Pilih barang --</option>');
                data.forEach(function(item) {
                    var selected = (item.kode_barang == selectedId);
                    var option = new Option(item.nama_barang + ' (' + item.kode_barang + ')', item.kode_barang, selected, selected);
                    $barangSelect.append(option);
                });
                $barangSelect.trigger('change');
            },
            error: function() {
                console.error('Gagal mengambil data barang.');
            }
        });
    }

    $('#kibSelect').on('change', function() {
        var jenis = $(this).val();
        if (jenis) {
            loadBarang(jenis);
        } else {
            $('#barangSelect').empty().append('<option value="">-- Pilih barang --</option>');
            $('#barangSelect').trigger('change');
        }
    });

    // Jalankan saat pertama kali halaman dimuat
    var initialJenis = $('#kibSelect').val();
    var initialBarang = '{{ $data->kode_barang }}';
    if (initialJenis) {
        loadBarang(initialJenis, initialBarang);
    }
});
</script>
@endpush
