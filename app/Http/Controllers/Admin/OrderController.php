<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all orders with associated customer (user)
        $orders = Order::with('user')->latest()->paginate(10);

        // Return the admin orders index view
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order with customer and products.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the order or fail
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        // Return the admin order details view
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Other methods (create, store, edit, update, destroy) are not needed
     * for Orders Management if orders are only viewed.
     */
}
