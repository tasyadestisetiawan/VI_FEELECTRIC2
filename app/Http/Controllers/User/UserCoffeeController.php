<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\CoffeeBean;
use Illuminate\Http\Request;
use App\Models\CoffeeMachine;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class UserCoffeeController extends Controller
{
    public function index()
    {
        $title = 'Products';
        $coffees = Product::all();
        $categories = ProductCategory::all();

        return view('user.products.coffees.index', compact('title', 'coffees', 'categories'));
    }

    public function show(string $id)
    {
        // Find the product
        $product = Product::find($id);
        $categories = ProductCategory::all();

        // recommendedProducts : Get 4 random products
        $recommendedProducts = Product::inRandomOrder()->limit(3)->get();

        // Return the view with the product
        return view('user.products.coffees.show', compact('product', 'categories', 'recommendedProducts'));
    }
}
