@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Order #{{ $order->id }}</h2>

    <!-- Customer Info -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Customer Info</h3>
        <p><strong>Name:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
    </div>

    <!-- Products Ordered -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Products Ordered</h3>
        <table class="w-full border-collapse border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Quantity</th>
                    <th class="p-2 border">Price</th>
                    <th class="p-2 border">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td class="p-2 border">{{ $item->product->name }}</td>
                    <td class="p-2 border">{{ $item->quantity }}</td>
                    <td class="p-2 border">${{ number_format($item->price, 2) }}</td>
                    <td class="p-2 border">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4 text-lg font-bold">
            Total: ${{ number_format($order->total, 2) }}
        </div>
    </div>
</div>
@endsection
