@extends('layouts.home')

<style>
  .quiz-container {
    background-color: #FFFCF5;
    border-radius: 20px;
    padding: 30px;
  }

  .question-number {
    background-color: #3B2621;
    color: white;
    border-radius: 10px;
    padding: 10px 15px;
    display: inline-block;
    margin-right: 10px;
  }

  .option button {
    background-color: #3B2621;
    color: white;
    border-radius: 10px;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    border: none;
    width: 100%;
  }

  .option button:hover {
    border: 2px solid #3B2621;
    background-color: #71483e;
    color: #ffffff;
  }

  .option button:active,
  .option button.selected {
    border: 2px solid #3B2621;
    background-color: transparent;
    color: #3B2621;
  }

  .option-label {
    position: relative;
    top: -35px;
    right: -10px;
  }
</style>

@section('content')
<div class="container my-5 pt-5 quiz-container">
  <div class="row mb-3 text-center">
    <div class="col">
      <h2 style="color: #3B2621;" id="nomor-halaman">1/4</h2>
      <p style="color: #3B2621;">Soal</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      <span class="question-number" id="nomor-soal">1</span>
      <span id="soal"></span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="option position-relative" id="option1">
        <button data-option="1"></button>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="option position-relative" id="option2">
        <button data-option="2"></button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="option position-relative" id="option3">
        <button data-option="3"></button>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="option position-relative" id="option4">
        <button data-option="4"></button>
      </div>
    </div>
  </div>

  <input type="hidden" id="answer" value="{{ $questions->first()->correct_answer }}">

  <div class="row mt-4">
    <div class="col text-center">
      <button id="next-question" class="btn text-light px-5"
        style="background-color: #3B2621; width: 100%; max-width: 160px;">Next</button>
      <button id="finish-quiz" class="btn text-light px-5"
        style="background-color: #3B2621; width: 100%; max-width: 160px; display: none;">Selesai</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let questions = @json($questions);
    let currentQuestionIndex = 0;
    let score = 0;
    let userAnswers = [];

    function loadQuestion(index) {
      const question = questions[index];
      document.getElementById('nomor-halaman').textContent  = `${index + 1}/${questions.length}`;
      document.getElementById('nomor-soal').textContent     = index + 1;
      document.getElementById('soal').textContent           = question.question;
      document.getElementById('answer').value               = question.answer;

      for (let i = 1; i <= 4; i++) {
        document.querySelector(`#option${i} button`).textContent = question[`option${i}`];
      }
    }

    document.querySelectorAll('.option button').forEach(button => {
      button.addEventListener('click', function () {
        document.querySelectorAll('.option button').forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
      });
    });

    document.getElementById('next-question').addEventListener('click', function () {
      const selectedOption = document.querySelector('.option button.selected');
      if (selectedOption) {
        const answer = document.getElementById('answer').value;
        const userAnswer = selectedOption.getAttribute('data-option');
        userAnswers.push({
          question_id: questions[currentQuestionIndex].id,
          answer: userAnswer,
          correct: userAnswer === answer
        });

        if (userAnswer === answer) {
          score++;
        }
      }

      currentQuestionIndex++;
      if (currentQuestionIndex < questions.length) {
        loadQuestion(currentQuestionIndex);
      } else {
        document.getElementById('next-question').style.display = 'none';
        document.getElementById('finish-quiz').style.display = 'inline-block';
      }
    });

    document.getElementById('finish-quiz').addEventListener('click', function () {
      console.log('Finish button clicked'); // Debugging
      fetch("{{ route('submit.quiz') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          score: score,
          totalQuestions: questions.length,
          userAnswers: userAnswers,
          quiz_id: '{{ $quiz->id }}'
        })
      })
      .then(response => response.text()) // Ubah menjadi text dulu
      .then(data => {
        console.log(data); // Log respons untuk melihat apa yang diterima
        return JSON.parse(data); // Parse manual
      })
      .then(data => {

        console.log(data);

        // Redirect ke halaman finish
        window.location.href = '{{ route('user.quizzes.finish', $quiz->id) }}';

      })
      .catch(error => {
        console.error('Error:', error);
      });
    });

    loadQuestion(currentQuestionIndex);
  });

</script>
@endsection