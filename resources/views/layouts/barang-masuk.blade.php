@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/barang-masuk.css') }}">
@endpush

@section('content')
    <div class="barang-masuk-container">
        @yield('page-content')
    </div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('scripts')

<script>
$(document).ready(function () {

    $('#barangSelect').select2({
        placeholder: "Ketik nama barang...",
        allowClear: true,
        width: '100%'
    });

    $('#guruSelect').select2({
        placeholder: "Ketik nama guru...",
        allowClear: true,
        width: '100%'
    });

    $('#ruangSelect').select2({
        placeholder: "Ketik nama ruang...",
        allowClear: true,
        width: '100%'
    });

});
</script>
@endpush
