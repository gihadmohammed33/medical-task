<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', ['items' => [], 'total' => 0]);

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.show', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:500',
        ]);

        // Get cart
        $cart = session()->get('cart', ['items' => [], 'total' => 0]);

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Stock check
        foreach ($cart['items'] as $id => $item) {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('cart.index')->with('error', "Product {$item['name']} no longer exists.");
            }
            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "Not enough stock for {$item['name']}.");
            }
        }

        // Create Order
        $order = Order::create([
            'full_name' => $validated['full_name'],
            'phone'     => $validated['phone'],
            'address'   => $validated['address'],
            'total'     => $cart['total'],
        ]);

        // Create OrderItems & decrement stock
        foreach ($cart['items'] as $id => $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $id,
                'quantity'  => $item['quantity'],
                'price'     => $item['price'],
            ]);

            Product::where('id', $id)->decrement('stock', $item['quantity']);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to confirmation
        return redirect()->route('order.confirmation', $order->id)
                         ->with('success', 'Order placed successfully!');
    }

    public function confirmation($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('checkout.confirmation', compact('order'));
    }
}
