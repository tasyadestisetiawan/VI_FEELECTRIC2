<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;

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

        return view('admin.dashboard', compact('title', 'totalUsers', 'totalCategories', 'totalProducts', 'totalOrders'));
    }
}
