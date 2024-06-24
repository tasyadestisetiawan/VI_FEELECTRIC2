<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Vouchers';
        $vouchers = Voucher::all();

        return view('admin.vouchers.index', compact('title', 'vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'limit' => 'required|numeric',
            'code' => 'required',
            'discount' => 'required|numeric',
            'expired_at' => 'nullable|date' // Allow expired_at to be nullable
        ]);

        // Create and save the voucher
        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->limit = $request->limit;
        $voucher->code = $request->code;
        $voucher->discount = $request->discount;
        $voucher->expired_at = $request->expired_at;

        // Save the voucher
        $saved = $voucher->save();

        // Check if voucher was saved successfully
        if ($saved) {
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create voucher');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get the voucher
        $voucher = Voucher::find($id);

        // Check if voucher exists
        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher not found');
        }

        // Validate the request
        $request->validate([
            'name' => 'required',
            'limit' => 'required|numeric',
            'code' => 'required',
            'discount' => 'required|numeric',
            'expired_at' => 'nullable|date' // Allow expired_at to be nullable
        ]);

        // Update the voucher
        $updated = $voucher->update([
            'name' => $request->name,
            'limit' => $request->limit,
            'code' => $request->code,
            'discount' => $request->discount,
            'expired_at' => $request->expired_at
        ]);

        // Check if update was successful
        if ($updated) {
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update voucher');
        }
    }
}
