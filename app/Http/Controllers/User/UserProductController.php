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
    public function index()
    {
        $title = 'Products';

        $coffees = Product::limit(4)->get();
        $coffeeBeans = CoffeeBean::limit(4)->get();
        $coffeeMachines = CoffeeMachine::limit(4)->get();

        return view('user.products.index', compact('title', 'coffees', 'coffeeBeans', 'coffeeMachines'));
    }
}
