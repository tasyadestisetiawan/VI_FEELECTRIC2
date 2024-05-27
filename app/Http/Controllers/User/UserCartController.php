<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserCartController extends Controller
{

    // List of Cart Items
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $coffees = Product::all();

        return view('user.cart.index', compact('cartItems', 'coffees'));
    }

    // Add to Cart
    public function store(Request $request)
    {
        // Get the user
        $user = Auth::user();

        // Check if the product is already in the cart
        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        // If the product is already in the cart, update the quantity
        if ($cart) {

            // Cek Varian (Size & Temperature)
            // Jika Size & Temperature sama, maka update quantity
            if ($cart->size == $request->size && $cart->temperature == $request->temperature) {
                $cart->quantity += $request->quantity;
                $cart->total_price = $cart->quantity * $cart->price;
                $cart->save();
            } else {
                // Jika Size & Temperature berbeda, maka tambahkan produk baru
                Cart::create([
                    'user_id'     => $user->id,
                    'product_id'  => $request->product_id,
                    'quantity'    => $request->quantity,
                    'price'       => $request->price,
                    'size'        => $request->size,
                    'temperature' => $request->temperature,
                    'notes'       => $request->notes,
                    'total_price' => $request->quantity * $request->price
                ]);
            }
        } else {

            // If the product is not in the cart, add it
            Cart::create([
                'user_id'     => $user->id,
                'product_id'  => $request->product_id,
                'quantity'    => $request->quantity,
                'price'       => $request->price,
                'size'        => $request->size,
                'temperature' => $request->temperature,
                'notes'       => $request->notes,
                'total_price' => $request->quantity * $request->price
            ]);
        }

        // Return a success message
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    // Update Cart Item
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->update([
            'size'        => $request->size,
            'temperature' => $request->temperature,
            'quantity'    => $request->quantity,
            'notes'       => $request->notes,
            'total_price' => $request->quantity * $cart->price
        ]);

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    // Delete Cart Item
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }

    // Apply Voucher

}
