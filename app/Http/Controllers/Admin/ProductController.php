<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category; // ← Make sure this is here

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index(Request $request)
{
    $q = $request->get('q');

    $products = Product::when($q, function($query, $q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
        })
        ->latest()
        ->paginate(20)
        ->withQueryString(); // preserves search query in pagination links

    return view('admin.products.index', compact('products', 'q'));
}


   

   public function edit(Product $product)
{
    // Get all categories to populate the dropdown
    $categories = Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
}

    public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $data['image'] = $imagePath;
    }

    $product->update($data);

    return redirect()->route('admin.products.index')
                     ->with('success', 'Product updated successfully!');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Product deleted.');
    }
    // Show create product form
    public function show($id)
/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Delete a product
 *
 * @param Product $product The product to delete
 *
 * @return \Illuminate\Http\RedirectResponse A redirect response with a success message
 */
/*******  af21491a-3c1d-4780-a35e-85690d673564  *******/{
    $product = Product::findOrFail($id);
    return view('admin.products.show', compact('product'));
}

// Show create product form
public function create()
{
    // Get all categories for dropdown
    $categories = \App\Models\Category::all();
    return view('admin.products.create', compact('categories'));
}

// Handle form submission
public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    // Create product
    $product = \App\Models\Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $imagePath,
    ]);

    // Optionally, log the creation here in your product log table

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
}
}
