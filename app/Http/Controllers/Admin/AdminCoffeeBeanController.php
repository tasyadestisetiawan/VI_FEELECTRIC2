<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeBean;
use Illuminate\Http\Request;

class AdminCoffeeBeanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Coffee Beans';
        $coffeeBeans = CoffeeBean::all();

        return view('admin.products.coffee-beans.index', compact('title', 'coffeeBeans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Coffee Bean';

        return view('admin.products.coffee-beans.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload the image
        $image = $request->file('image');
        $image->storeAs('public/img/products/beans/', $image->hashName());

        // Get the form data
        CoffeeBean::create([
            'name' => $request->name,
            'origin' => $request->origin,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image->hashName(),
            'weight' => $request->weight,
            'description' => $request->description,
        ]);

        return redirect()->route('coffee-beans.index')->with('success', 'Coffee Bean added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Coffee Bean';
        $product = CoffeeBean::findOrFail($id);

        return view('admin.products.coffee-beans.show', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Product";
        $product = CoffeeBean::findOrFail($id);

        return view('admin.products.coffee-beans.edit', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the coffee bean
        $coffeeBean = CoffeeBean::findOrFail($id);

        // Validate the form data
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if there is an image
        if ($request->hasFile('image')) {
            // Delete the old image
            if (file_exists(storage_path("app/public/img/products/beans/{$coffeeBean->image}"))) {
                unlink(storage_path("app/public/img/products/beans/{$coffeeBean->image}"));
            }

            // Upload the new image
            $image = $request->file('image');
            $image->storeAs('public/img/products/beans/', $image->hashName());

            // Update the coffee bean
            $coffeeBean->update([
                'name' => $request->name,
                'origin' => $request->origin,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $image->hashName(),
                'weight' => $request->weight,
                'description' => $request->description,
            ]);
        } else {
            // Update the coffee bean without the image
            $coffeeBean->update([
                'name' => $request->name,
                'origin' => $request->origin,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('coffee-beans.index')->with('success', 'Coffee Bean updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the coffee bean
        $coffeeBean = CoffeeBean::findOrFail($id);

        // Delete the image
        if (file_exists(storage_path("app/public/img/products/beans/{$coffeeBean->image}"))) {
            unlink(storage_path("app/public/img/products/beans/{$coffeeBean->image}"));
        } else {
            $coffeeBean->image = null;
        }

        // Delete the coffee bean
        $coffeeBean->delete();

        return redirect()->route('coffee-beans.index')->with('success', 'Coffee Bean deleted successfully');
    }
}
