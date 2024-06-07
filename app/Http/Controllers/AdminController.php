<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $title = 'Dashboard';

        // All Data
        $totalUsers = User::where('role', 'user')->count();
        $totalCategories = ProductCategory::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $orders = Order::all();
        $productQuantities = [];
        $productNames = [];

        foreach ($orders as $order) {
            $products = json_decode($order->products, true);

            foreach ($products as $product) {
                $productId = $product['product_id'];
                $quantity = $product['quantity'];

                $productName = DB::table('products')->where('id', $productId)->value('name');

                if (!isset($productQuantities[$productName])) {
                    $productQuantities[$productName] = 0;
                }

                $productQuantities[$productName] += $quantity;
            }
        }

        // Memisahkan nama produk dan kuantitasnya ke dalam array yang terpisah
        $productNames = array_keys($productQuantities);
        $productQuantities = array_values($productQuantities);

        return view('admin.dashboard', compact('title', 'totalUsers', 'totalCategories', 'totalProducts', 'totalOrders', 'productNames', 'productQuantities'));
    }


    public function salesdata()
    {
        $orders = Order::all();

        $productQuantities = [];

        foreach ($orders as $order)
            $products = json_decode($order->products, true);

            foreach ($products as $product){
                $productId = $product['product_id'];
                $quantity = $product['quantity'];

                $produtName = DB::table('products')->where('id', $productId)->value('name');

                if (!isset($productQuantities[$produtName])){
                    $productQuantities[$produtName] = 0;
                }

                $productQuantities[$produtName] += $quantity;
            }

            return response()->json($productQuantities);
    }
}

