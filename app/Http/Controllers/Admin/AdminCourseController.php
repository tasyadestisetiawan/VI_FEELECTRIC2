<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Courses';
        $courses = Courses::all();

        return view('admin.courses.videos.index', compact('title', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Course';

        return view('admin.courses.videos.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload the image
        $image = $request->file('image');
        $image->storeAs('public/img/courses/', $image->hashName());

        // Save the course
        Courses::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'date'          => $request->date,
            'price'         => $request->price,
            'kuota'         => $request->kuota,
            'video'         => $request->video,
            'image'         => $image->hashName(),
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
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
        $title = 'Edit Course';
        $course = Courses::find($id);

        return view('admin.courses.videos.edit', compact('title', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the course
        $course = Courses::find($id);

        // Check if there is an image uploaded
        if ($request->hasFile('image')) {

            // Delete the old image
            Storage::delete('public/img/courses/' . $course->image);

            // Upload the new image
            $image = $request->file('image');
            $image->storeAs('public/img/courses/', $image->hashName());

            // Update the course
            $course->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'date'          => $request->date,
                'price'         => $request->price,
                'kuota'         => $request->kuota,
                'video'         => $request->video,
                'image'         => $image->hashName(),
            ]);
        } else {
            // Update the course
            $course->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'date'          => $request->date,
                'price'         => $request->price,
                'kuota'         => $request->kuota,
                'video'         => $request->video,
            ]);
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the course
        $course = Courses::find($id);

        // Delete the image
        Storage::delete('public/img/courses/' . $course->image);

        // Delete the course
        $course->delete();

        // Redirect to the courses index page
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}