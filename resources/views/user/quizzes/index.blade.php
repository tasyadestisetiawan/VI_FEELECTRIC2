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
  <div class="header">
    <h1 class="text-start">
      Quizzes Feelectic
    </h1>
    <p class="description">
      Barista Bootcamp is a course that will teach you everything you need to know to become a professional barista.
    </p>
  </div>
  <div class="content">
    <div class="row">
      @foreach($bootcamps as $bootcamp)
      <div class="col-md-6">
        <div class="card rounded-3 shadow" style="border: solid 2px #3b2621;">
          <img src="https://img.freepik.com/premium-vector/quiz-comic-pop-art-style_175838-505.jpg" class="card-img-top"
            alt="...">
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection