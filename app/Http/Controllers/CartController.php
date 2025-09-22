<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Show cart page
     */
    public function index()
    {
        $cart = session()->get('cart', $this->emptyCart());

        return view('cart.index', compact('cart'));
    }

    /**
     * Add product to cart
     */
  public function add(Request $request)
{
    $product = Product::findOrFail($request->product_id);
    $qty = (int) ($request->quantity ?? 1);

    $cart = session()->get('cart', ['items' => [], 'total' => 0]);

    if (isset($cart['items'][$product->id])) {
        $cart['items'][$product->id]['quantity'] += $qty;
    } else {
        $cart['items'][$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $qty,
            'image' => $product->image_url ?? 'https://via.placeholder.com/150',
        ];
    }

    $cart['total'] = collect($cart['items'])->sum(fn($i) => $i['price'] * $i['quantity']);
    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Added to cart');
}


    /**
     * Update quantity
     */
    public function update(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1'
    ]);

    $cart = session()->get('cart', $this->emptyCart());

    if (isset($cart['items'][$request->product_id])) {
        $cart['items'][$request->product_id]['quantity'] = $request->quantity;
    }

    // 🔥 Recalculate total after quantity change
    $cart['total'] = $this->calculateTotal($cart);

    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Cart updated!');
}


    /**
     * Remove item
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', $this->emptyCart());

        unset($cart['items'][$request->product_id]);

        $cart['total'] = $this->calculateTotal($cart);

        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Item removed',
                'total'   => $cart['total']
            ]);
        }

        return redirect()->back()->with('success', 'Item removed!');
    }

    /**
     * Bulk update (fallback for non-JS forms)
     */
    public function bulkUpdate(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', $this->emptyCart());

        foreach ($quantities as $productId => $qty) {
            if (isset($cart['items'][$productId])) {
                $cart['items'][$productId]['quantity'] = max(1, (int) $qty);
            }
        }

        $cart['total'] = $this->calculateTotal($cart);

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    /**
     * Stock check before checkout
     */
    public function stockCheck()
    {
        $cart = session('cart', $this->emptyCart());

        foreach ($cart['items'] as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                return response()->json([
                    'ok' => false,
                    'message' => "Not enough stock for {$item['name']}"
                ], 422);
            }
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Helpers
     */
    private function calculateTotal($cart)
{
    return collect($cart['items'])->sum(function ($item) {
        return $item['price'] * $item['quantity']; // subtotal for each item
    });
}


    private function emptyCart()
    {
        return ['items' => [], 'total' => 0];
    }
}
