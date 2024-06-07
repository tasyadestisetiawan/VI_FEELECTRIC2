@extends('layouts.home')

<style>
  .completion-card {
    background-color: #FFFCF5;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .completion-card .header {
    background-color: #3B2621;
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    padding: 10px;
    font-weight: bold;
  }

  .completion-card .content {
    padding: 20px;
  }

  .completion-card .content img {
    width: 80px;
    margin-bottom: 20px;
  }

  .btn-custom {
    background-color: #3B2621;
    color: white;
    border-radius: 10px;
  }

  .btn-custom:hover {
    background-color: #61473A;
    color: #FFF7E8;
  }
</style>

@section('content')
<div class="container pt-5 my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="completion-card">
        <div class="header">
          Quiz Completion
          {{ $score }} / 4
        </div>
        <div class="content">
          <img src="https://img.icons8.com/color/96/000000/checked.png" alt="Success">
          <h5 class="fw-bold">
            Congratulations! You have completed the quiz.
          </h5>
          <p>
            You have answered {{ $score }} out of 4 questions correctly.
          </p>
          <a href="{{ route('user.quizzes.quizzes') }}" class="btn mt-3"
            style="background-color: #3b2621; color: white;">
            Back to Quiz Page
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection