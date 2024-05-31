<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quizzes;
use Illuminate\Http\Request;

class AdminQuizzesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quizzes';
        $quizzes = Quizzes::all();
        return view('admin.quizzes.index', compact('quizzes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title'          => 'required',
            'description'   => 'required',
            'coins'         => 'required|numeric',
        ]);

        // Create a new quiz
        Quizzes::create([
            'title'          => $request->title,
            'description'   => $request->description,
            'coins'         => $request->coins,
        ]);

        // Redirect to the quizzes list
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the quiz
        $quiz = Quizzes::findOrFail($id);

        // Delete the quiz
        $quiz->delete();

        // Redirect to the quizzes list
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully');
    }
}
