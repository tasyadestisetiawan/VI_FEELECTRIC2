<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeMachine;
use Illuminate\Http\Request;

class AdminCoffeeMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Coffee Machines';
        $products = CoffeeMachine::all();

        return view('admin.products.coffee-machines.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Added Product Machine";
        return view('admin.products.coffee-machines.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate Form
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload Image
        $image = $request->file('image');
        $image->storeAs('public/img/products/machines', $image->hashName());

        // Save to Database
        CoffeeMachine::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image->hashName(),
        ]);

        return redirect()->route('coffee-machines.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Coffee Machine';
        $product = CoffeeMachine::find($id);

        return view('admin.products.coffee-machines.show', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Coffee Machine';
        $product = CoffeeMachine::find($id);

        return view('admin.products.coffee-machines.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Form
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find Product
        $product = CoffeeMachine::find($id);

        // Check if image is updated
        if ($request->hasFile('image')) {
            // Delete old image
            $image = $request->file('image');
            $image->storeAs('public/img/products/machines', $image->hashName());
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image->hashName(),
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('admin.coffee-machines.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find Product
        $product = CoffeeMachine::find($id);

        // Delete Image
        if ($product->image) {
            unlink(storage_path('app/public/img/products/machines/' . $product->image));
        } else {
            return redirect()->route('admin.coffee-machines.index')->with('error', 'Product not found');
        }

        // Delete Product
        $product->delete();

        return redirect()->route('admin.coffee-machines.index')->with('success', 'Product deleted successfully');
    }
}
