<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\CoffeeMachine;
use App\Http\Controllers\Controller;

class AdminOrderMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Coffee Machine Orders';

        // Hanya tampilkan order yang memiliki type == bean
        $orders = Order::where('type', 'machine')->where('paymentStatus', 'paid')->get();

        return view('admin.orders.machines.index', compact('title', 'orders'));
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
        $title = 'Order Detail';
        $order = Order::findOrFail($id);
        $order->products = json_decode($order->products);
        $machines = CoffeeMachine::all();

        return view('admin.orders.machines.show', compact('order', 'title', 'machines'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
