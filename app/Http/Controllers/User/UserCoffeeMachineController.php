<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CoffeeMachine;
use Illuminate\Http\Request;

class UserCoffeeMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all coffee machines
        $coffeeMachines = CoffeeMachine::all();

        return view('user.products.coffee-machines.index', compact('coffeeMachines'));
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
        $product = CoffeeMachine::findOrFail($id);
        $recommendedProducts = CoffeeMachine::inRandomOrder()->limit(3)->get();
        return view('user.products.coffee-machines.show', compact('product', 'recommendedProducts'));
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
