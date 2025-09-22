@extends('layouts.app')
@section('title', 'Order Confirmation')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
  <h1 class="text-2xl font-bold mb-6">Order Confirmation</h1>

  <p class="mb-4 text-green-700">Thank you, your order was placed successfully!</p>

  <div class="bg-white p-6 rounded shadow">
    <h2 class="font-semibold mb-2">Order #{{ $order->id }}</h2>
    <p><strong>Name:</strong> {{ $order->full_name }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p class="mt-2"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
  </div>

  <div class="mt-6">
    <h3 class="font-semibold mb-2">Items</h3>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-3 py-2 border">Product</th>
          <th class="px-3 py-2 border">Quantity</th>
          <th class="px-3 py-2 border">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
        <tr>
          <td class="px-3 py-2 border">{{ $item->product->name }}</td>
          <td class="px-3 py-2 border">{{ $item->quantity }}</td>
          <td class="px-3 py-2 border">${{ number_format($item->price, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
      Continue Shopping
    </a>
  </div>
</div>
@endsection
