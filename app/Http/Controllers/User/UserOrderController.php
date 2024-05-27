<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Address;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all orders by the authenticated user
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        $coffees = Product::all();
        $categories = ProductCategory::all();
        $vouchers = Voucher::all();

        return view('user.orders.index', compact('orders', 'coffees', 'categories', 'vouchers'));
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
            'paymentMethod' => 'required|string',
            'subTotal'      => 'required|numeric',
        ]);

        // ID Order Generator ( "FE" + DATE + ID USER + RANDOM NUMBER )
        $idOrder = "FE" . date('Ymd') . auth()->id() . rand(1000, 9999);

        // Address "Ambil data dari field address yang dimiliki user"
        $address = Address::where('id', auth()->id())->first()->address;

        // Create a new order
        Order::create([
            'order_id'       => $idOrder,
            'user_id'        => auth()->id(),
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $address,
            'products'       => $request->products,
            'paymentMethod'  => $request->paymentMethod,
            'subTotal'       => $request->subTotal,
            'total'          => $request->subTotal,
        ]);

        // Clear the cart
        // Cart::where('user_id', auth()->id())->delete();

        // Return & redirect to cart page
        return redirect()->route('cart.index')->with('success', 'Order has been placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the order
        $order = Order::findOrFail($id);
        $order->products = json_decode($order->products);
        $coffees = Product::all();

        // Return the order details
        return view('user.orders.show', compact('order', 'coffees'));
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
