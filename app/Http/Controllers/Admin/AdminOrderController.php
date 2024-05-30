<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // List all orders
    public function index()
    {
        $title = 'Orders';
        $orders = Order::where('type', 'drink')->get();
        $coffees = Product::all();

        return view('admin.orders.index', compact('orders', 'title', 'coffees'));
    }

    public function show($id)
    {
        $title = 'Order Detail';
        $order = Order::findOrFail($id);
        $order->products = json_decode($order->products);
        $coffees = Product::all();
        return view('admin.orders.show', compact('order', 'title', 'coffees'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->orderStatus = $request->orderStatus;
        $order->save();

        // Return via URL don't use redirect
        return back();
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        // Return via URL don't use redirect
        return back();
    }
}
