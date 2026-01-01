@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/barang-masuk.css') }}">
@endpush

@section('content')
<div class="tambah-barang-masuk-container">
    @yield('content')
</div>
@endsection
