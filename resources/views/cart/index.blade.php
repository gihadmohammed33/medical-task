@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">

  <!-- Heading + Checkout Button -->
  <div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Your Shopping Cart</h1>
    @if(!empty($cart) && count($cart['items']) > 0)
      <a href="{{ route('checkout.show') }}" 
         class="bg-gradient-to-r from-green-500 to-green-700 ext-red-600 font-bold  px-6 py-3 rounded-xl shadow hover:scale-105 hover:shadow-lg transition-transform duration-300">
        Proceed to Checkout →
      </a>
    @endif
  </div>

  @if(empty($cart) || count($cart['items']) === 0)
    <!-- Empty Cart -->
    <div class="bg-white p-10 rounded-2xl shadow text-center">
      <p class="text-gray-600 text-lg">🛒 Your cart is empty.</p>
      <a href="{{ route('products.index') }}" 
         class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 transition">
        Browse Products
      </a>
    </div>
  @else
    <!-- Cart Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
          <tr class="text-gray-700">
            <th class="p-4 font-medium">Product</th>
            <th class="p-4 font-medium text-center">Quantity</th>
            <th class="p-4 font-medium text-right">Price</th>
            <th class="p-4 font-medium text-right">Subtotal</th>
            <th class="p-4"></th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @foreach($cart['items'] as $id => $item)
            <tr class="hover:bg-gray-50 transition">
              <!-- Product Image + Name -->
              <td class="p-4 flex items-center gap-4">
                <img src="{{ $item['image'] }}" 
                     class="w-16 h-16 rounded-lg object-cover shadow-sm">
                <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
              </td>

              <!-- Quantity -->
              <td class="p-4 text-center">
                <form method="POST" action="{{ route('cart.update') }}" class="flex items-center justify-center gap-2">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $id }}">
                  <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                         class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
                  <button class="bg-blue-600 text-green-600 font-bold px-3 py-1 rounded-lg shadow hover:bg-blue-700 transition">
                    Update
                  </button>
                </form>
              </td>

              <!-- Price -->
              <td class="p-4 text-right font-semibold text-gray-700">${{ number_format($item['price'],2) }}</td>

              <!-- Subtotal -->
              <td class="p-4 text-right font-semibold text-gray-900">${{ number_format($item['price'] * $item['quantity'],2) }}</td>

              <!-- Remove -->
              <td class="p-4 text-center">
                <form method="POST" action="{{ route('cart.remove') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $id }}">
                  <button class="text-red-600 hover:text-red-800 font-medium">Remove</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Bottom Checkout Bar -->
    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-6 rounded-2xl shadow">
      <p class="text-2xl font-bold text-gray-900">
        Total: <span class="text-green-600">${{ number_format($cart['total'],2) }}</span>
      </p>
      <a href="{{ route('checkout.show') }}" 
         class="bg-gradient-to-r from-green-500 to-green-700 text-red-600 font-bold  px-8 py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-transform duration-300">
        Checkout →
      </a>
    </div>
  @endif
</div>

<!-- Sticky Checkout Bar (Mobile) -->
<!-- @if(!empty($cart) && count($cart['items']) > 0)
  <div class="fixed inset-x-0 bottom-0 bg-white border-t shadow-lg p-4 z-50"
       style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
      <div class="text-lg font-bold text-gray-900">
        Total: <span class="text-green-600">${{ number_format($cart['total'],2) }}</span>
      </div>
      <a href="{{ route('checkout.show') }}"
         class="bg-gradient-to-r from-green-500 to-green-700 text-green-100 px-6 py-3 rounded-lg shadow hover:scale-105 transition">
        Checkout →
      </a>
    </div>
  </div>
@endif -->
@endsection
