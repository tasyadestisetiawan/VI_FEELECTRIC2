<?php

namespace App\Http\Controllers\User;

use Log;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\User;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\CoffeeBean;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Models\CoffeeMachine;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all orders by the authenticated user
        $orders     = Order::where('user_id', auth()->id())->latest()->get();
        $coffees    = Product::all();
        $categories = ProductCategory::all();
        $vouchers   = Voucher::all();

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

        // Create Snap Token
        $payload = [
            'transaction_details' => [
                'order_id'      => $idOrder,
                'gross_amount'  => $request->total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
                'phone'      => auth()->user()->phone,
            ],
            'item_details' => [
                [
                    'id'       => $idOrder,
                    'price'    => $request->subTotal,
                    'quantity' => 1,
                    'name'     => 'Coffee Order',
                ]
            ]
        ];

        // Get Snap Token
        $snapToken = Snap::getSnapToken($payload);

        // Cek apakah ada coins yang digunakan
        if ($request->coins == null) {
            $request->coins = 0;
        } else {
            // Update coins
            $user = User::where('id', auth()->id())->first();
            $user->update([
                'coin' => $user->coin - $request->coins,
            ]);
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
            'coins'          => $request->coins,
            'orderStatus'    => 'pending',
            'voucherCode'    => $request->voucherCode,
            'voucherDiscount' => $voucherDiscount,
            'total'          => $request->subTotal - ($voucherDiscount / 100) + $request->cost - $request->coins,
            'snap_token'     => $snapToken,
            'quantity'       => $request->quantity,
        ]);

        // Remove all cart data
        Cart::where('user_id', auth()->id())->delete();

        // Return & redirect to order page
        return redirect()->route('cart.index')->with('success', 'Order has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the order
        $order           = Order::findOrFail($id);

        // Get data with id = 1 in setting table
        $payment         = Setting::where('id', 1)->first()->value;

        // Decode the products
        $order->products = json_decode($order->products);

        // Get all products
        $coffees         = Product::all();
        $beans           = CoffeeBean::all();
        $machines        = CoffeeMachine::all();

        // Return the order details
        return view('user.orders.show', compact('order', 'coffees', 'beans', 'machines', 'payment'));
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
        // Log request data for debugging
        Log::info('Update Order Request:', $request->all());

        // Find the order
        $order = Order::findOrFail($id);

        // Update the order
        $order->update([
            'paymentStatus' => $request->paymentStatus,
        ]);

        // Log order data after update
        Log::info('Order after update:', $order->toArray());

        // Return & redirect to order page
        return redirect()->route('orders.index')->with('success', 'Order has been updated successfully!');
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

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     *
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;
        $order = Order::where('order_id', $orderId)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                    $order->setPending();
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                    $order->setSuccess();
                }
            }
        } elseif ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
            $order->setSuccess();
            // Update paymentStatus to 'paid'
            $order->update([
                'paymentStatus' => 'paid',
            ]);
        } elseif ($transaction == 'pending') {

            // TODO set payment status in merchant's database to 'Pending'
            // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
            $order->setPending();
        } elseif ($transaction == 'deny') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
            $order->setFailed();
        } elseif ($transaction == 'expire') {

            // TODO set payment status in merchant's database to 'expire'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
            $order->setExpired();
        } elseif ($transaction == 'cancel') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
            $order->setFailed();
        }
    }
}