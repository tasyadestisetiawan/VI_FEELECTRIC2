<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Rooms';
        $rooms = Room::all();
        return view('admin.rooms.index', compact('title', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Room';

        return view('admin.rooms.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload image
        $photo = $request->file('photo');
        $photo->storeAs('public/img/rooms', $photo->hashName());

        // Create room
        Room::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'facilities' => $request->facilities,
            'status' => $request->status,
            'photo' => $photo->hashName()
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Room Detail';
        $room = Room::findOrFail($id);

        return view('admin.rooms.show', compact('title', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Room';
        $room = Room::findOrFail($id);

        return view('admin.rooms.edit', compact('title', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find Data
        $room = Room::findOrFail($id);

        // Validate
        $request->validate([
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
            'photo'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload image
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/img/rooms', $photo->hashName());
            $photoName = $photo->hashName();
        } else {
            $photoName = $room->photo;
        }

        // Update room
        $room->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'capacity'    => $request->capacity,
            'facilities'  => $request->facilities,
            'status'      => $request->status,
            'photo'       => $photoName
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find Data
        $room = Room::findOrFail($id);

        // Delete room
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully');
    }
}
