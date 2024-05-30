<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\BootcampRegistered;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBootcampController extends Controller
{
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
        $bootcamp   = Bootcamp::find($id);
        $title      = "Bootcamp Detail";
        $status     = BootcampRegistered::where('bootcamp_id', $id)->count();
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
        } else {
            $bootcamp->delete();
        }

        // Delete Bootcamp
        $bootcamp->delete();

        return redirect()->route('admin.bootcamps.index')->with('success', 'Bootcamp deleted successfully');
    }

    public function confirmPayment(string $id, Request $request)
    {
        // Get bootcamp registered by id
        $bootcamp = BootcampRegistered::find($id);

        // Validate the request
        $request->validate([
            'payment_status' => 'required',
        ]);

        // User ID
        $user_id = $bootcamp->user_id;

        // Update Bootcamp Registered
        BootcampRegistered::where('id', $id)->update([
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->back()->with('success', 'Payment confirmed successfully');
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
