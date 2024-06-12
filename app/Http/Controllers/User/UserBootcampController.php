<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\BootcampRegistered;
use Illuminate\Http\Request;

class UserBootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all bootcamps with date not expired
        $bootcamps = Bootcamp::where('start_date', '>=', date('Y-m-d'))->get();

        // Redirect
        return view('user.bootcamps.index', compact('bootcamps'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get bootcamp by id
        $bootcamp = Bootcamp::find($id);

        // Check if bootcamp not found
        $checkRegister = BootcampRegistered::where('bootcamp_id', $id)->where('user_id', auth()->user()->id)->first();

        // Redirect
        return view('user.bootcamps.show', compact('bootcamp', 'checkRegister'));
    }

    /**
     * Register to bootcamp
     */
    public function register(Request $request)
    {
        // Validate request
        $request->validate([
            'bootcamp_id' => 'required',
        ]);

        // Check if user already registered
        $registered = BootcampRegistered::where('bootcamp_id', $request->bootcamp_id)
            ->where('user_id', auth()->user()->id)
            ->first();

        // If user already registered
        if ($registered) {
            return redirect()->back()->with('error', 'You already registered to this bootcamp.');
        }

        // Check if bootcamp is free or not
        if (Bootcamp::find($request->bootcamp_id)->price == 0) {
            // Register user to bootcamp
            BootcampRegistered::create([
                'bootcamp_id'    => $request->bootcamp_id,
                'id_register'    => 'BCR' . time() . rand(0, 999),
                'name'           => $request->name,
                'phone'          => $request->phone,
                'payment_status' => 'paid',
                'user_id'        => auth()->user()->id,
            ]);
        } else {
            // Register user to bootcamp
            BootcampRegistered::create([
                'bootcamp_id'    => $request->bootcamp_id,
                'id_register'    => 'BCR' . time() . rand(0, 999),
                'name'           => $request->name,
                'phone'          => $request->phone,
                'payment_status' => 'unpaid',
                'user_id'        => auth()->user()->id,
            ]);
        }

        // Redirect
        return redirect()->route('bootcamps.show', $request->bootcamp_id)->with('success', 'You have successfully registered to this bootcamp.');
    }

    /**
     * Update bootcamp
     */
    public function update(Request $request, string $id)
    {
        // Validate request
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get bootcamp registered by id
        $bootcamp = BootcampRegistered::find($id);

        // Upload payment proof
        $payment_proof = $request->file('payment_proof');
        $payment_proof->storeAs('public/img/bootcamps/payment', $payment_proof->hashName());

        // Update bootcamp
        BootcampRegistered::where('id', $id)->update([
            'payment_proof'     => $payment_proof->hashName(),
            'payment_status'    => 'pending',
            'payment_method'    => 'transfer',
        ]);

        // Update bootcamp kuota
        $bootcamp = Bootcamp::find($bootcamp->bootcamp_id);

        // Kuota tersisa
        Bootcamp::where('id', $bootcamp->id)->update([
            'kuota' => $bootcamp->kuota - 1,
        ]);

        // Redirect
        return redirect()->back()->with('success', 'Bootcamp updated successfully.');
    }

    /**
     * My Bootcamps
     */
    public function myBootcamps()
    {
        // Get all bootcamps registered by user
        $bootcamps   = Bootcamp::all();
        $mybootcamps = BootcampRegistered::where('user_id', auth()->user()->id)->get();

        // Redirect
        return view('user.bootcamps.my-bootcamps', compact('mybootcamps', 'bootcamps'));
    }
}