<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Reservations';
        $reservations = Reservation::all();
        $rooms = Room::all();

        return view('admin.reservations.index', compact('title', 'reservations', 'rooms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Reservation Detail';
        $reservation = Reservation::find($id);
        $rooms = Room::all();
        $users = User::all();

        return view('admin.reservations.show', compact('title', 'reservation', 'rooms', 'users'));
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
        // Find the reservation
        $reservation = Reservation::find($id);

        // Validate
        $request->validate([
            'status' => 'required'
        ]);

        // Update the reservation
        Reservation::where('id', $id)->update([
            'status' => $request->status
        ]);

        // Room status
        if ($request->status == 'approved') {
            Room::where('id', $reservation->room_id)->update([
                'status' => 'unavailable'
            ]);
        } else {
            Room::where('id', $reservation->room_id)->update([
                'status' => 'available'
            ]);
        }

        return redirect()->route('admin.reservations.show', $id)->with('success', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the reservation
        $reservation = Reservation::find($id);

        // Delete the reservation
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
