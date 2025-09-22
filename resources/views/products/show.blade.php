@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gradient-to-b from-white to-gray-50 text-gray-900 rounded-2xl shadow-2xl">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Left: Product Image -->
        <div class="flex justify-center">
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-200">
                <img src="{{ $product->image_url ?: 'https://via.placeholder.com/450x450' }}" 
                     alt="{{ $product->name }}" 
                     class="w-full max-w-[450px] h-[450px] object-contain rounded-2xl transition-transform duration-500 hover:scale-105" />
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="flex flex-col space-y-6">

            <!-- Product Title -->
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                {{ $product->name }}
            </h1>

            <!-- Product Description -->
            <p class="text-lg text-gray-700 leading-relaxed">
                {{ $product->description ?: 'No description available.' }}
            </p>

            <!-- Price -->
            <div class="text-3xl sm:text-4xl font-bold text-green-600">
                ${{ number_format($product->price, 2) }}
            </div>

            <!-- Add to Cart -->
            <form method="POST" action="{{ route('cart.add') }}" class="flex items-center gap-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1"
                       class="w-20 border border-gray-300 rounded-lg bg-white text-gray-900 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm" />
                <button type="submit"
                        class="bg-green-600 text-green font-semibold px-6 py-3 rounded-full shadow-md hover:bg-green-700 transition-all duration-300">
                    Add to Cart
                </button>
            </form>

            <!-- Extra Info -->
            <p class="text-sm text-gray-500 mt-2">
                SKU: #{{ $product->id }} &nbsp;|&nbsp; Category: {{ $product->category->name ?? 'Uncategorized' }}
            </p>
        </div>
    </div>

</div>
@endsection
