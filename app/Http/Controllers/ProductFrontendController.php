<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductFrontendController extends Controller
{
    /**
     * Show product listing (home + products page).
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest(); // default
        }

        // Paginate
        $products = $query->paginate(12)->withQueryString();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show a single product detail page.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
