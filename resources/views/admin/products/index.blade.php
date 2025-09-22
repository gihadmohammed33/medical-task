@extends('layouts.admin')
@section('title', 'Products Management')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">All Products</h2>
    <a href="{{ route('admin.products.create') }}" 
       class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
        + Create Product
    </a>
</div>

<!-- Search Form -->
<div class="mb-4">
    <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2">
        <input type="text" name="q" placeholder="Search products..." 
               value="{{ $q }}" 
               class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" 
                class="bg-blue-600 text-blue-500 px-4 py-2 rounded hover:bg-blue-700">Search</button>
    </form>
</div>


<div class="bg-white p-6 rounded shadow">
    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="p-2 border">{{ $product->id }}</td>
                    <td class="p-2 border">{{ $product->name }}</td>
                    <td class="p-2 border">${{ number_format($product->price, 2) }}</td>
                    <td class="p-2 border flex items-center gap-4">
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>

                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-2 text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
