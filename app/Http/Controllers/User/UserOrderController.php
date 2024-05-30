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

        // Update LIMIT Voucher
        if ($request->voucherCode != null) {
            $voucher = Voucher::where('code', $request->voucherCode)->first();
            $voucher->update([
                'limit' => $voucher->limit - 1,
            ]);
        }

        if ($request->voucherCode == null) {
            $voucherDiscount = 0;
        } else {
            $voucherDiscount = Voucher::where('code', $request->voucherCode)->first()->discount;
        }

        // Create a new order
        Order::create([
            'order_id'       => $idOrder,
            'user_id'        => auth()->id(),
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $address,
            'products'       => $request->products,
            'paymentMethod'  => $request->paymentMethod,
            'type'           => $request->type,
            'subTotal'       => $request->subTotal,
            'cost'           => $request->cost,
            'orderStatus'    => 'pending',
            'voucherCode'    => $request->voucherCode,
            'voucherDiscount' => $voucherDiscount,
            'total'          => $request->subTotal + $request->cost,
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

    /**
     * Show the upload payment view.
     */
    public function uploadPaymentView(string $id)
    {
        // Find the order
        $order = Order::findOrFail($id);

        // Return the upload payment view
        return view('user.orders.upload-payment', compact('order'));
    }

    /**
     * Upload the payment proof.
     */
    public function uploadPayment(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'paymentProof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the order
        $order = Order::findOrFail($id);

        // Upload the payment proof
        $paymentProof = $request->file('paymentProof');
        $paymentProofName = time() . '.' . $paymentProof->extension();
        $paymentProof->move(public_path('storage/payments'), $paymentProofName);

        // Update the order
        $order->update([
            'paymentReference'  => $paymentProofName,
            'paymentStatus'      => 'paid',
        ]);

        // Return & redirect to order page
        return redirect()->route('orders.index')->with('success', 'Payment proof has been uploaded successfully!');
    }

    /**
     * Show the order status.
     */
    public function showStatus(string $id)
    {
        // Find the order
        $order = Order::findOrFail($id);

        // Return the order status
        return view('user.orders.status', compact('order'));
    }
}
