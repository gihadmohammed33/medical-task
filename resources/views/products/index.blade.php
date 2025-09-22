@extends('layouts.app')

@section('title', 'Shop Our Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">

    <!-- Page Heading -->
    <h1 class="text-4xl font-extrabold text-gray-900 mb-12 text-center sm:text-left">
        Shop Our Products
    </h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('products.index') }}" 
          class="flex flex-wrap items-center gap-4 mb-12 bg-white p-6 rounded-2xl shadow-lg border border-gray-200">

        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..."
               class="flex-1 min-w-[200px] border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm bg-white" />

        <select name="category"
                class="flex-1 min-w-[160px] border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm bg-white">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="sort"
                class="flex-1 min-w-[140px] border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm bg-white">
            <option value="">Sort</option>
            <option value="price_asc" @selected(request('sort')=='price_asc')>Price: Low → High</option>
            <option value="price_desc" @selected(request('sort')=='price_desc')>Price: High → Low</option>
        </select>

        <button type="submit"
                class="bg-purple-600 text-green-600 font-semibold px-6 py-3 rounded-xl hover:bg-purple-700 transition-all shadow-lg">
            Apply Filters
        </button>
    </form>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($products as $product)
        <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-transform transform hover:-translate-y-1 flex flex-col overflow-hidden">

            <!-- Image Wrapper with Background -->
            <a href="{{ route('products.show', $product->id) }}" 
   class="block w-full flex items-center justify-center h-48 overflow-hidden bg-black">
    <img src="{{ $product->image_url ?: 'https://via.placeholder.com/300x300' }}" 
         alt="{{ $product->name }}"
         class="h-40 object-contain transition-transform duration-300 hover:scale-110" />
</a>


            <!-- Product Info -->
            <div class="flex-1 flex flex-col p-6">
                <!-- Name -->
                <a href="{{ route('products.show', $product->id) }}" 
                   class="text-lg font-bold text-gray-900 hover:text-purple-600 mb-2 truncate">
                   {{ $product->name }}
                </a>

                <!-- Description -->
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                    {{ $product->description ?: 'No description available.' }}
                </p>

                <!-- Price + Add to Cart -->
                <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-200">
                    <span class="text-xl font-extrabold text-purple-600">
                        ${{ number_format($product->price, 2) }}
                    </span>

                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
class="bg-gradient-to-r from-purple-500 to-pink-500 text-green-600 font-semibold px-5 py-2 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition"
>                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500 text-lg">No products found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $products->links() }}
    </div>

</div>
@endsection
