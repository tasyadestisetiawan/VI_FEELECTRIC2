<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class UserReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all reservations
        $reservations = Reservation::all();
        $rooms = Room::all();

        return view('user.reservations.index', compact('reservations', 'rooms'));
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
            'room_id'        => 'required',
            'check_in'       => 'required',
            'check_in_time'  => 'required',
            'check_out_time' => 'required',
            'total_guests'   => 'required',
        ]);

        $room_id = $request->room_id;
        $amount = Room::find($room_id)->price;

        // Create a new reservation
        Reservation::create([
            'user_id'        => auth()->id(),
            'room_id'        => $request->room_id,
            'name'           => $request->name,
            'check_in'       => $request->check_in,
            'check_in_time'  => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
            'total_guests'   => $request->total_guests,
            'status'         => 'pending',
            'amount'         => $amount,
            'special_request' => $request->special_request,
            'payment_method' => 'cash',
        ]);

        // Redirect to the reservations index page
        return redirect()->route('rooms.show', $room_id)->with('success', 'Reservation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the reservation
        $reservation = Reservation::find($id);
        $rooms = Room::all();
        return view('user.reservations.show', compact('reservation', 'rooms'));
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
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the reservation
        $reservation = Reservation::find($id);

        // Upload the payment proof
        $payment_proof = $request->file('payment_proof');
        $payment_proof->storeAs('public/img/reservations/payment_proofs', $payment_proof->hashName());

        // Update the reservation
        $reservation->update([
            'payment_proof' => $payment_proof->hashName(),
            'status'        => 'paid',
        ]);

        // Redirect to the reservations index page
        return redirect()->route('user.reservations.index')->with('success', 'Payment proof uploaded successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * List of the reservation of the user
     */
    public function myReservations()
    {
        // Get all reservations of the user
        $reservations = Reservation::where('user_id', auth()->id())->get();
        $rooms = Room::all();

        return view('user.profile.reservations', compact('reservations', 'rooms'));
    }
}
