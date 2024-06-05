<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // List of Products
    public function index()
    {
        $title = "Products";
        $products = Product::all();
        $categories = ProductCategory::all();

        return view('admin.products.coffee.index', compact('products', 'title', 'categories'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $title = "Add Product";
        $categories = ProductCategory::all();

        return view('admin.products.coffee.create', compact('categories', 'title'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'description'   => 'required',
            'category_id'   => 'required',
            'variant'       => 'required',
            'priceHot'      => 'nullable|numeric',
            'priceIce'      => 'nullable|numeric',
            'imageHot'      => 'nullable|image',
            'imageIce'      => 'nullable|image',
            'supply_hot'    => 'required_if:variant,hot,both|integer',
            'supply_ice'    => 'required_if:variant,ice,both|integer',
        ];

        $request->validate($rules);

        $data = $request->only([
            'name', 'description', 'category_id', 'variant',
            'priceHot', 'priceIce'
        ]);

        $data['slug'] = Str::slug($request->name);

        if ($request->has('supply_hot')) {
            $data['supply_hot'] = $request->input('supply_hot');
        }

        if ($request->has('supply_ice')) {
            $data['supply_ice'] = $request->input('supply_ice');
        }

        if ($request->hasFile('imageHot')) {
            $imageHot = $request->file('imageHot');
            $imageHot->storeAs('public/img/products/coffees', $imageHot->hashName());
            $data['imageHot'] = $imageHot->hashName();
        }

        if ($request->hasFile('imageIce')) {
            $imageIce = $request->file('imageIce');
            $imageIce->storeAs('public/img/products/coffees', $imageIce->hashName());
            $data['imageIce'] = $imageIce->hashName();
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
    }


    // Display the specified resource.
    public function show(string $id)
    {
        $title = "Product Detail";
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('admin.products.coffee.show', compact('product', 'title', 'categories'));
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        $title = "Edit Product";
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('admin.products.coffee.edit', compact('product', 'categories', 'title'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'variant' => 'required|in:hot,ice,both',
            'priceHot' => 'nullable|numeric',
            'priceIce' => 'nullable|numeric',
            'imageHot' => 'nullable|image',
            'imageIce' => 'nullable|image',
            'supply_hot' => 'required_if:variant,hot,both|integer',
            'supply_ice' => 'required_if:variant,ice,both|integer',
        ]);

        $data = $request->only([
            'name', 'description', 'category_id', 'variant',
            'priceHot', 'priceIce'
        ]);

        if ($request->has('supply_hot')) {
            $data['supply_hot'] = $request->input('supply_hot');
        }

        if ($request->has('supply_ice')) {
            $data['supply_ice'] = $request->input('supply_ice');
        }

        if ($request->hasFile('imageHot')) {
            $imageHot = $request->file('imageHot');
            $imageHot->storeAs('public/img/products/coffees', $imageHot->hashName());
            $data['imageHot'] = $imageHot->hashName();
        }

        if ($request->hasFile('imageIce')) {
            $imageIce = $request->file('imageIce');
            $imageIce->storeAs('public/img/products/coffees', $imageIce->hashName());
            $data['imageIce'] = $imageIce->hashName();
        }

        $product = Product::find($id);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    // Update persediaan
    public function updateSupply(Request $request, string $id)
    {
        $product = Product::find($id);

        $validateData = $request->validate([
            'supply' => 'required|integer',
        ]);

        $product->supply = $request->supply;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Stock updated successfully');
    }
}
