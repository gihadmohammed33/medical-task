@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
  <h1 class="text-2xl font-bold mb-6">Checkout</h1>

  {{-- Flash messages --}}
  @if(session('success'))
    <div class="mb-4 text-green-600">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="mb-4 text-red-600">{{ session('error') }}</div>
  @endif

  {{-- Validation errors --}}
  @if ($errors->any())
    <div class="mb-4 text-red-600">
      <ul>
        @foreach ($errors->all() as $error)
          <li>- {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Order Summary --}}
  <h2 class="text-xl font-semibold mb-3">Order Summary</h2>
  <table class="w-full mb-6 border">
    <thead class="bg-gray-100">
      <tr>
        <th class="p-2 text-left">Product</th>
        <th class="p-2">Qty</th>
        <th class="p-2">Price</th>
        <th class="p-2">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cart['items'] as $id => $item)
        <tr class="border-t">
          <td class="p-2">{{ $item['name'] }}</td>
          <td class="p-2 text-center">{{ $item['quantity'] }}</td>
          <td class="p-2 text-center">${{ number_format($item['price'], 2) }}</td>
          <td class="p-2 text-center">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="flex justify-between items-center mb-8">
    <span class="text-lg font-bold">Total: ${{ number_format($cart['total'], 2) }}</span>
  </div>

  {{-- Checkout Form --}}
  <h2 class="text-xl font-semibold mb-3">Billing Details</h2>
<form method="POST" action="{{ route('checkout.placeOrder') }}">
    @csrf

    <div>
      <label for="full_name" class="block font-medium">Full Name</label>
      <input type="text" id="full_name" name="full_name" 
             class="w-full border rounded p-2" 
             value="{{ old('full_name') }}" required>
    </div>

    <div>
      <label for="phone" class="block font-medium">Phone</label>
      <input type="text" id="phone" name="phone" 
             class="w-full border rounded p-2" 
             value="{{ old('phone') }}" required>
    </div>

    <div>
      <label for="address" class="block font-medium">Address</label>
      <textarea id="address" name="address" 
                class="w-full border rounded p-2" rows="3" required>{{ old('address') }}</textarea>
    </div>

    <button type="submit" 
            class="bg-green-600 text-black px-6 py-2 rounded hover:bg-green-700">
      Place Order
    </button>
  </form>
</div>
@endsection
