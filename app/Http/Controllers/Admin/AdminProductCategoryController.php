<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminProductCategoryController extends Controller
{
    // List of Products
    public function index()
    {
        $title = "Product Categories";
        $products = Product::all();
        $categories = ProductCategory::all();

        return view('admin.category.index', compact('products', 'title', 'categories'));
    }

    // Store Product Category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        ProductCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category Added Successfully');
    }

    // Update Product Category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = ProductCategory::find($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    // Delete Product Category
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
