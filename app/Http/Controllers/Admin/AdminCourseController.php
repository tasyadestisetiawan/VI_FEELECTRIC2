<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class AdminCourseController extends Controller
{
    // protected $telegram_api_token;
    // protected $telegram_chat_id;

    // public function __construct()
    // {
    //     $this->telegram_api_token = env('TELEGRAM_API_TOKEN');
    //     $this->telegram_chat_id = env('TELEGRAM_CHAT_ID');
    // }

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

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
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

        // Check if the response is successful (if needed)
        if ($response->successful()) {
            return redirect()->route('courses.index')->with('success', 'Course updated successfully and notification sent.');
        } else {
            return redirect()->route('courses.index')->with('success', 'Course updated successfully but failed to send notification.');
        }
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
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    /**
     * Confirm user registration for a course.
     */
    public function confirmRegistration(Request $request, $courseId, $userId)
    {
        // Logika untuk mengkonfirmasi registrasi pengguna
        $course = Courses::findOrFail($courseId);
        $user = User::findOrFail($userId);

        // Misalnya, update status registrasi pengguna
        // Contoh: $registration = Registration::where('course_id', $courseId)->where('user_id', $userId)->first();
        // $registration->status = 'confirmed';
        // $registration->save();

        // Mengirim notifikasi ke pengguna melalui Telegram
        // $this->sendNotification($user->telegram_chat_id, "Pendaftaran Anda untuk kursus '{$course->name}' telah dikonfirmasi. Anda dapat mengikuti kursus ini.");

        return redirect()->route('admin.courses.index')->with('success', 'User registration confirmed and notification sent.');
    }

    /**
     * Send a notification to a specific Telegram chat ID.
     */
    // protected function sendNotification($chatId, $message)
    // {
    //     $client = new Client();
    //     $url = "https://api.telegram.org/bot{$this->telegram_api_token}/sendMessage";

    //     $client->post($url, [
    //         'form_params' => [
    //             'chat_id' => $chatId,
    //             'text' => $message,
    //         ]
    //     ]);
    // }
}
