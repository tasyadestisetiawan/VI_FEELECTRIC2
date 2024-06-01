<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Administrators';
        $admins = User::where('role', 'admin')->get();

        return view('admin.users.admin.index', compact('title', 'admins'));
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
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload the avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/img/avatars', $filename);
        }

        // Create the user
        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'role'      => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'password'  => bcrypt($request->password),
            'avatar'    => $filename ?? null,
        ]);

        // Redirect to the index page
        return redirect()->route('admin.users.index')->with('success', 'Administrator created successfully.');
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
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Find the user
        $user = User::find($id);

        // Check if avatar is uploaded
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/img/avatars', $filename);
        }

        // Jika ada password baru yang diinput
        if ($request->password) {
            // Update the user
            $user->update([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'role'      => 'admin',
                'updated_at' => date('Y-m-d H:i:s'),
                'password'  => bcrypt($request->password),
                'avatar'    => $filename ?? null,
            ]);
        } else {
            // Update the user
            $user->update([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'role'      => 'admin',
                'updated_at' => date('Y-m-d H:i:s'),
                'avatar'    => $filename ?? null,
            ]);
        }

        // Redirect to the index page
        return redirect()->route('admin.users.index')->with('success', 'Administrator updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user
        $user = User::find($id);

        // Delete the user
        $user->delete();

        // Redirect to the index page
        return redirect()->route('admin.users.index')->with('success', 'Administrator deleted successfully.');
    }
}
