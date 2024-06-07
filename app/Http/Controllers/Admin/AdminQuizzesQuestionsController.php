<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quizzes;
use App\Models\Questions;
use Illuminate\Http\Request;

class AdminQuizzesQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Questions';
        $quizzes   = Quizzes::all();
        $questions  = Questions::all();
        return view('admin.quizzes.questions.index', compact('questions', 'quizzes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'question' => 'required',
            'quiz_id' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
        ]);

        // Create a new question
        Questions::create([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'answer' => $request->answer,
        ]);

        // Redirect to the index page
        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'question'  => 'required',
            'quiz_id'   => 'required',
            'option1'   => 'required',
            'option2'   => 'required',
            'option3'   => 'required',
            'option4'   => 'required',
            'answer'    => 'required',
        ]);

        // Find the question
        $question = Questions::find($id);

        // Update the question
        $question->update([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'answer' => $request->answer,
        ]);

        // Redirect to the index page
        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the question
        $question = Questions::find($id);

        // Check if the question exists
        if ($question) {
            // Delete the question
            $question->delete();

            // Redirect to the index page
            return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully');
        } else {
            // Redirect with error message if question is not found
            return redirect()->route('admin.questions.index')->with('error', 'Question not found');
        }
    }
}