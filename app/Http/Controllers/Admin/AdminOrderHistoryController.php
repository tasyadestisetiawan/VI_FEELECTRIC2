<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\CoffeeBean;
use Illuminate\Http\Request;
use App\Models\OrdersHistory;
use App\Models\CoffeeMachine;
use App\Http\Controllers\Controller;

class AdminOrderHistoryController extends Controller
{
    public function index()
    {
        $title      = 'Order History';

        // Get all data orderStatus with status completed
        $orders     = OrdersHistory::where('orderStatus', 'completed')->get();

        // Get all data from Coffess, CoffeeBean, and CoffeeMachine
        $coffees    = Product::all();
        $beans      = CoffeeBean::all();
        $machines   = CoffeeMachine::all();

        return view('admin.orders.history.index', compact('orders', 'title', 'coffees', 'beans', 'machines'));
    }

    public function show($id)
    {
        $title      = 'Order Detail';
        $order      = OrdersHistory::findOrFail($id);
        $order->products = json_decode($order->products);
        $coffees    = Product::all();
        $beans      = CoffeeBean::all();
        $machines   = CoffeeMachine::all();

        return view('admin.orders.history.show', compact('order', 'title', 'coffees', 'beans', 'machines'));
    }
}
