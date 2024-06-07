<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Feedback;
use App\Models\User;
use App\Models\CoffeeBean;
use App\Models\CoffeeMachine;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all products with limit 4 order by created_at
        $coffees        = Product::inRandomOrder()->limit(4)->get();
        $coffeeBeans    = CoffeeBean::inRandomOrder()->limit(4)->get();
        $coffeeMachines = CoffeeMachine::inRandomOrder()->limit(4)->get();
        $testimonials   = Feedback::inRandomOrder()->limit(4)->get();
        $users          = User::all();

        return view('home.index', compact('coffees', 'coffeeBeans', 'coffeeMachines', 'testimonials', 'users'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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