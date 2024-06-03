@extends('layouts.home')

@section('content')
    {{-- Hero --}}
    @include('components.home.hero')

    {{-- Slogan --}}
    @include('components.home.slogan')

    {{-- Stats --}}
    @include('components.home.stats')

    {{-- Testimonial --}}
    @include('components.home.testimoni')
@endsection
