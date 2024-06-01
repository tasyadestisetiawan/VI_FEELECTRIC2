<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Settings';
        $settings = Setting::all();

        return view('admin.settings.index', compact('title', 'settings'));
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
            'value' => 'required'
        ]);

        // Create a new setting
        Setting::create($request->all());

        // Redirect to the settings index
        return redirect()->route('admin.settings.index')->with('success', 'Setting created successfully');
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
            'name' => 'required',
            'value' => 'required'
        ]);

        // Find the setting
        $setting = Setting::findOrFail($id);

        // Update the setting
        $setting->update($request->all());

        // Redirect to the settings index
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the setting
        $setting = Setting::findOrFail($id);

        // Delete the setting
        $setting->delete();

        // Redirect to the settings index
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully');
    }
}
