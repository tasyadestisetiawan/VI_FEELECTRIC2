<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CoffeeBean;
use Illuminate\Http\Request;

class UserCoffeeBeanController extends Controller
{
    public function index()
    {
        $coffeeBeans = CoffeeBean::all();
        return view('user.products.coffee-beans.index', compact('coffeeBeans'));
    }

    public function show($id)
    {
        $product = CoffeeBean::findOrFail($id);
        $recommendedProducts = CoffeeBean::inRandomOrder()->limit(3)->get();
        return view('user.products.coffee-beans.show', compact('product', 'recommendedProducts'));
    }
}
