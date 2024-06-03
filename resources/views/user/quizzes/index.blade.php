@extends('layouts.home')

<style>
  .input-group-text {
    border: 2px solid #3b2621 !important;
    background-color: #f8f9fa !important;
    border-right: none !important;
  }

  .form-control {
    border: 2px solid #3b2621 !important;
    border-left: none !important;
  }

  .nav-link {
    color: #3b2621 !important;
    border: 2px solid #3b2621 !important;
  }

  .active {
    background-color: #3b2621 !important;
    color: white !important;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="row align-items-center content-wrapper mt-5">
    <div class="col-lg-8 col-md-6" style="color: #3B2621;">
      <h2 class="fw-bold" style="color: #3B2621;">Quizz Feelectric</h2>
      <p style="color: #3B2621;">
        Play To Gain Your Knowledge, and get a chance to win a prize.
      </p>
      <img src="{{ asset('frontend/img/quizz.png') }}" alt="Image" class="rounded-4 img-fluid" style="max-width: 70%;">
    </div>
    <div class="col-lg-4 col-md-3 text-center">
      <h3 class="fw-bold fs-1 my-3" style="color: #3B2621;">Quizz</h3>
      <img src="{{ asset('frontend/img/logo.png') }}" alt="Feelectric Logo" class="img-fluid mb-3"
        style="max-width: 50%;">
      <h5 class="my-3" style=" color: #3B2621;">Play To Gain Your Knowledge</h5>
      <p style="color: #3B2621;">They have downloaded gmail and seems to be working for now i also believe it’s
        important for every member</p>
      <a href="{{ route('user.quizzes.quizzes') }}" class="btn rounded-pill mt-3 px-5"
        style="background-color: #3B2621; color: white;">Play Now</a>
    </div>
  </div>
</div>

@endsection