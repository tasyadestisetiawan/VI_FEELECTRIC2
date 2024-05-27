<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\CoffeeBean;
use App\Models\CoffeeMachine;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Products';
        $coffees = Product::all();
        $coffeeBeans = CoffeeBean::all();
        $coffeeMachines = CoffeeMachine::all();

        return view('user.products.index', compact('title', 'coffees', 'coffeeBeans', 'coffeeMachines'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product
        $product = Product::find($id);
        $categories = ProductCategory::all();

        // recommendedProducts : Get 4 random products
        $recommendedProducts = Product::inRandomOrder()->limit(3)->get();

        // Return the view with the product
        return view('user.products.show', compact('product', 'categories', 'recommendedProducts'));
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
