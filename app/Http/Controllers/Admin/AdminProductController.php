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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Product";
        $categories = ProductCategory::all();

        return view('admin.products.coffee.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $variant = $request->input('variant');

        $rules = [
            'name'          => 'required',
            'description'   => 'required',
            'category_id'   => 'required',
            'variant'       => 'required',
            'imageHot'      => 'nullable|image',
            'imageIce'      => 'nullable|image',
        ];

        if ($variant == 'hot' || $variant == 'both') {
            $rules['priceHot'] = 'required|numeric';
            $rules['stockHot'] = 'required|numeric';
        } elseif ($variant == 'ice' || $variant == 'both') {
            $rules['priceIce'] = 'required|numeric';
            $rules['stockIce'] = 'required|numeric';
        }

        $request->validate($rules);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->variant = $request->variant;
        $product->priceHot = $request->priceHot;
        $product->stockHot = $request->stockHot;
        $product->priceIce = $request->priceIce;
        $product->stockIce = $request->stockIce;

        if ($request->hasFile('imageHot')) {
            $imageHot = $request->file('imageHot');
            $imageHot->storeAs('public/img/products/coffees', $imageHot->hashName());
            $product->imageHot = $imageHot->hashName();
        }

        if ($request->hasFile('imageIce')) {
            $imageIce = $request->file('imageIce');
            $imageIce->storeAs('public/img/products/coffees', $imageIce->hashName());
            $product->imageIce = $imageIce->hashName();
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Product Detail";
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('admin.products.coffee.show', compact('product', 'title', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Product";
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('admin.products.coffee.edit', compact('product', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $validateData = $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'category_id'   => 'required',
            'variant'       => 'required',
            'imageHot'      => 'nullable|image',
            'imageIce'      => 'nullable|image',
        ]);

        $product = Product::find($id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->variant = $request->variant;
        $product->priceHot = $request->priceHot;
        $product->stockHot = $request->stockHot;
        $product->priceIce = $request->priceIce;
        $product->stockIce = $request->stockIce;

        if ($request->hasFile('imageHot')) {
            $imageHot = $request->file('imageHot');
            $imageHot->storeAs('public/img/products/coffees', $imageHot->hashName());
            $product->imageHot = $imageHot->hashName();
        }

        if ($request->hasFile('imageIce')) {
            $imageIce = $request->file('imageIce');
            $imageIce->storeAs('public/img/products/coffees', $imageIce->hashName());
            $product->imageIce = $imageIce->hashName();
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find Product
        $product = Product::find($id);

        // Delete Data
        $product->delete();

        // Redirect
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
