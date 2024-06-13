@extends('layouts.error')

@section('content')
<div class="container text-center">
    <h1 class="display-1 fw-bold text-dark">404</h1>
    <h2 class="h4 fw-bold text-dark">Halaman Tidak Ditemukan</h2>
    <p class="text-muted">Maaf, halaman yang Anda cari tidak dapat ditemukan. Periksa URL atau kembali ke halaman utama.</p>
    <a href="{{ url('/') }}" class="btn btn-dark">Kembali ke Halaman Utama</a>
</div>
@endsection