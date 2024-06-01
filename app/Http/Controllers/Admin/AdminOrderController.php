<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeBean;
use App\Models\CoffeeMachine;
use App\Models\Order;
use App\Models\OrdersHistory;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

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

        Order::where('id', $id)->update([
            'orderStatus'   => $request->orderStatus,
            'paymentStatus' => 'paid'
        ]);

        // if order status is completed, then add to order history
        if ($request->orderStatus == 'completed') {
            OrdersHistory::create([
                'order_id'      => $order->order_id,
                'user_id'       => $order->user_id,
                'name'          => $order->name,
                'products'      => $order->products,
                'total'         => $order->total,
                'type'          => $order->type,
                'paymentMethod' => $order->paymentMethod,
                'paymentStatus' => 'paid',
                'paymentReference' => $order->paymentReference,
                'subTotal'      => $order->subTotal,
                'orderStatus'   => 'completed'
            ]);
        }

        // If order status is completed, then redirect to order history
        if ($request->orderStatus == 'completed') {
            return redirect()->route('admin.orders-history.index');
        } else {
            if ($order->type == 'bean') {
                return redirect()->route('admin.orders-coffee-beans.index');
            } else if ($order->type == 'machine') {
                return redirect()->route('admin.orders-coffee-machines.index');
            } else {
                return redirect()->route('admin.orders.index');
            }
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        // Return via URL don't use redirect
        return back();
    }
}
