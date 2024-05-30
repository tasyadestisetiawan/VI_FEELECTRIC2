<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\User;
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
        //
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
        // Get the voucher
        $voucher = Voucher::find($id);

        // Validate the request
        $request->validate([
            'name' => 'required',
            'limit' => 'required|numeric',
            'code' => 'required',
            'discount' => 'required|numeric',
            'expired_at' => 'required|date'
        ]);

        // Update the voucher
        $voucher->update([
            'name' => $request->name,
            'limit' => $request->limit,
            'code' => $request->code,
            'discount' => $request->discount,
            'expired_at' => $request->expired_at
        ]);

        // Redirect to the index page
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
