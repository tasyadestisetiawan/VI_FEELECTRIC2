<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quizzes;
use App\Models\Questions;
use App\Models\UserQuizAnswer;
use App\Models\User;
use Illuminate\Http\Request;

class UserQuizzesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.quizzes.index');
    }

    /**
     * Display a listing of the quizzes.
     */
    public function quizzes()
    {
        $quizzes = Quizzes::all();
        return view('user.quizzes.quizzes', compact('quizzes'));
    }

    /**
     * Play a quiz.
     */
    public function play(string $id)
    {
        $quiz = Quizzes::find($id);
        $questions = Questions::where('quiz_id', $id)->get();

        // Cek apakah user sudah pernah mengikuti kuis tersebut
        $user = auth()->user();

        // Cek tabel UserQuizAnswer berdasarkan user_id
        $userQuizAnswers = UserQuizAnswer::where('user_id', $user->id)->get();

        // Cek kapan terakhir kali user mengikuti kuis
        $lastQuiz = $userQuizAnswers->last();

        // Jika ada data, maka user sudah pernah mengikuti kuis. Maka kembali ke halaman quizzes dengan pesan error
        if ($userQuizAnswers->count() > 0) {
            // Cek apakah user sudah pernah mengikuti kuis yang sama?
            if ($lastQuiz->quiz_id == $id) {
                // Cek apakah user sudah mengikuti kuis hari ini?
                if ($lastQuiz->created_at->isToday()) {
                    return redirect()->route('user.quizzes.quizzes')->with('success', 'You have already played this quiz today');
                }
            }
        }

        return view('user.quizzes.play', compact('quiz', 'questions'));
    }

    public function submitQuiz(Request $request)
    {
        try {
            $user = auth()->user();
            $score = $request->input('score');
            $totalQuestions = $request->input('totalQuestions');
            $userAnswers = $request->input('userAnswers');
            $quizId = $request->input('quiz_id');

            $correctAnswersCount = 0; // Tambahkan variabel untuk menghitung jawaban benar

            // Simpan data hasil kuis ke tabel UserQuizAnswer
            foreach ($userAnswers as $answer) {
                UserQuizAnswer::create([
                    'user_id' => $user->id,
                    'quiz_id' => $quizId,
                    'question_id' => $answer['question_id'],
                    'answer' => $answer['answer'],
                ]);

                // Cocokan jawaban user dengan jawaban benar
                $question = Questions::find($answer['question_id']);
                if ($question->answer == $answer['answer']) {
                    $correctAnswersCount++; // Tambahkan jawaban benar
                }
            }

            // Ambil data pada kolom coin, di tabel quizzes berdasarkan quiz_id
            $quizCoins = Quizzes::find($quizId)->coins;

            // Tambahkan koin berdasarkan jawaban benar
            $user->coin += $correctAnswersCount * $quizCoins; // Asumsikan setiap jawaban benar mendapatkan koin dari quiz
            $user->save();

            return response()->json(['message' => 'Quiz submitted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function finish(String $id)
    {

        // Ambil skor user berdasarkan quiz_id, join dengan tabel questions dan user_quiz_answers berdasarkan question_id dan quiz_id yang sama dengan quiz_id yang dipilih
        $quiz = Quizzes::find($id);
        $questions = Questions::where('quiz_id', $id)->get();
        $user = auth()->user();
        $userQuizAnswers = UserQuizAnswer::where('user_id', $user->id)->where('quiz_id', $id)->get();

        // Ambil skor user
        $score = 0;
        foreach ($userQuizAnswers as $answer) {
            $question = Questions::find($answer->question_id);
            if ($question->answer == $answer->answer) {
                $score++;
            }
        }

        $total = $questions->count();

        return view('user.quizzes.done', compact('quiz', 'questions', 'score', 'total'));
    }
}
