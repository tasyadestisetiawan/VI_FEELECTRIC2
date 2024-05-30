<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeBean;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderBeanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Coffee Bean Orders';

        // Hanya tampilkan order yang memiliki type == bean
        $orders = Order::where('type', 'bean')->where('paymentStatus', 'paid')->get();

        return view('admin.orders.beans.index', compact('title', 'orders'));
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
        $beans = CoffeeBean::all();

        return view('admin.orders.beans.show', compact('order', 'title', 'beans'));
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
