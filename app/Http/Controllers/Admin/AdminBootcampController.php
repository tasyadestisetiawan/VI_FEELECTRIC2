<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\BootcampRegistered;
use Illuminate\Http\Request;
// use App\Services\TwilioService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminBootcampController extends Controller
{
    // protected $twilioService;

    // public function __construct(TwilioService $twilioService)
    // {
    //     $this->twilioService = $twilioService;
    // }

    public function confirmPayment(string $id, Request $request)
    {
        Log::info('confirmPayment method called with ID: ' . $id);

        $bootcampRegistered = BootcampRegistered::find($id);

        if (!$bootcampRegistered) {
            Log::error('Bootcamp registration not found for ID: ' . $id);
            return redirect()->back()->withErrors('Bootcamp registration not found.');
        }

        Log::info('BootcampRegistered found: ' . json_encode($bootcampRegistered));

        $request->validate([
            'payment_status' => 'required',
        ]);

        $bootcampRegistered->update([
            'payment_status' => $request->payment_status,
        ]);

        $user = $bootcampRegistered->user;

        if (!$user) {
            Log::error('User not found for BootcampRegistered with user_id: ' . $bootcampRegistered->user_id);
            return redirect()->back()->withErrors('User not found.');
        }

        Log::info('User found: ' . json_encode($user));

        if (empty($user->phone)) {
            Log::error('User phone number is not set for user_id: ' . $bootcampRegistered->user_id);
            return redirect()->back()->withErrors('User phone number is not set.');
        }

        // Log::info('Sending WhatsApp message to ' . $user->phone);
        // $this->twilioService->sendWhatsAppMessage($user->phone, "Pembayaran Anda untuk bootcamp '{$bootcampRegistered->bootcamp->name}' telah dikonfirmasi. Anda dapat mengikuti bootcamp ini.");

        return redirect()->back()->with('success', 'Payment confirmed and notification sent.');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Bootcamp';
        $bootcamps = Bootcamp::all();

        // Format Date to Human Readable
        foreach ($bootcamps as $bootcamp) {
            $bootcamp->start_date = Carbon::parse($bootcamp->start_date)->format('d F Y');
            $bootcamp->end_date = Carbon::parse($bootcamp->end_date)->format('d F Y');
        }

        return view('admin.courses.bootcamp.index', compact('title', 'bootcamps'));
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
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'kuota' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload Image
        $image = $request->file('image');
        $image->storeAs('public/img/bootcamps/poster/', $image->hashName());

        // Create Bootcamp
        Bootcamp::create([
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'location'    => $request->location,
            'price'       => $request->price,
            'kuota'       => $request->kuota,
            'image'       => $image->hashName(),
        ]);

        return redirect()->route('admin.bootcamps.index')->with('success', 'Bootcamp created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get bootcamp by id
        $bootcamp = Bootcamp::find($id);
        $title = "Bootcamp Detail";
        $status = BootcampRegistered::where('bootcamp_id', $id)->count();
        $participants = BootcampRegistered::where('bootcamp_id', $id)->get();

        // If bootcamp is full
        if ($status >= $bootcamp->kuota) {
            $status = 'Full';
        } else {
            $status = 'Available';
        }

        // Redirect to bootcamp show page
        return view('admin.courses.bootcamp.show', compact('bootcamp', 'title', 'status', 'participants'));
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
        // Find Bootcamp
        $bootcamp = Bootcamp::find($id);

        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'kuota' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update Image
        if ($request->hasFile('image')) {
            // Delete Image
            if (file_exists(storage_path('app/public/img/bootcamps/poster/' . $bootcamp->image))) {
                unlink(storage_path('app/public/img/bootcamps/poster/' . $bootcamp->image));
            }

            // Upload Image
            $image = $request->file('image');
            $image->storeAs('public/img/bootcamps/poster/', $image->hashName());

            $bootcamp->update([
                'image' => $image->hashName(),
            ]);
        } else {
            $bootcamp->update([
                'name'        => $request->name,
                'description' => $request->description,
                'start_date'  => $request->start_date,
                'end_date'    => $request->end_date,
                'start_time'  => $request->start_time,
                'end_time'    => $request->end_time,
                'location'    => $request->location,
                'price'       => $request->price,
                'kuota'       => $request->kuota,
            ]);
        }

        return redirect()->route('admin.bootcamps.index')->with('success', 'Bootcamp updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find Bootcamp
        $bootcamp = Bootcamp::find($id);

        // Delete Image
        if (file_exists(storage_path('app/public/img/bootcamps/poster/' . $bootcamp->image))) {
            unlink(storage_path('app/public/img/bootcamps/poster/' . $bootcamp->image));
        }

        // Delete Bootcamp
        $bootcamp->delete();

        return redirect()->route('admin.bootcamps.index')->with('success', 'Bootcamp deleted successfully');
    }

    public function deleteParticipant(string $id, string $user_id)
    {
        // Find Bootcamp Registered
        $bootcamp = BootcampRegistered::find($id);

        // Delete Bootcamp Registered
        $bootcamp->delete();

        return redirect()->back()->with('success', 'Participant deleted successfully');
    }
}
