@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="header mt-5 d-flex align-items-center justify-content-between">
    <div class="float-start">
      <h2 class="fw-bold">Quizz Feelectric</h2>
      <p>
        Play To Gain Your Knowledge, and get a chance to win a prize.
      </p>
    </div>
    <div class="float-end">
      {{-- AVatar Profile with poin badge --}}
      <div class="d-flex align-items-center">
        <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle"
          style="width: 50px; height: 50px;">
        <span class="badge bg-primary ms-2">
          {{ Auth::user()->coin }} <i class="bi bi-coin"></i>
        </span>
      </div>
    </div>
  </div>

  {{-- Alert Notifications --}}
  <x-alert type="success" :message="session('success')" />
  <x-alert type="danger" :errors="$errors->all()" />

  <div class="row">
    @forelse ( $quizzes as $quiz )
    <div class="col-4">
      <div class="card rounded-4" style="border: 2px solid #3b2621;">
        <div class="mx-3 rounded-4">
          <img src="{{ asset('frontend/img/quizz-logo.png') }}" alt="Image" class="card-img-top"
            style="max-width: 100%;">
        </div>
        <div class="card-body">
          <h5 class="card-title">
            {{ $quiz->title }}
          </h5>
          <p class="card-text">
            {{ $quiz->description }} <br>
            One Correct Answer = {{ $quiz->coins }} Coins
          </p>
          <a href="{{ route('user.quizzes.play', $quiz->id) }}" class="btn"
            style="background-color: #3b2621; color: white;">Play
            Now
          </a>
        </div>
      </div>
    </div>
    @empty

    @endforelse
  </div>

</div>

@endsection