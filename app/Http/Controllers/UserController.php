<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\BootcampRegistered;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard()
    {
        // Get Cart Count for the user
        $cartCount = Cart::where('user_id', auth()->user()->id)->count();
        return view('user.dashboard', compact('cartCount'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('user.profile.index', compact('user'));
    }

    // Update User Profile View
    public function updateProfileView()
    {
        $user = auth()->user();
        $addresses = Address::where('user_id', $user->id)->first();

        return view('user.profile.edit', compact('user', 'addresses'));
    }

    // Update User Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        // Check if avatar is uploaded
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/img/avatars', $filename);

            // Update user avatar
            User::where('id', $user->id)->update([
                'avatar' => $filename,
            ]);
        }

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $filename,
        ]);

        // Redirect to profile page
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function address()
    {
        // Ambil semua data di tabel Address berdasarkan user_id
        $data = Address::where('user_id', auth()->user()->id)->get();

        // Redirect
        return view('user.profile.address', compact('data'));
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Address::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Address::where('user_id', $user->id)->update([
            'address' => $request->address,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Address updated successfully.');
    }

    public function myBootcamps()
    {
        $bootcamps = BootcampRegistered::where('user_id', auth()->id())->get();
        return view('user.profile.bootcamps', compact('bootcamps'));
    }
}
