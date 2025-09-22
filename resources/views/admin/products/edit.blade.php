@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Category -->
        <div class="mb-4">
    <label class="block mb-1 font-semibold">Category</label>
    <select name="category_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Select Category --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Image -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image</label>
            <input type="file" name="image" class="w-full">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover rounded">
            @endif
        </div>

        <button type="submit"
                class="bg-blue-600 text-black px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Update Product
        </button>
    </form>
</div>
@endsection
