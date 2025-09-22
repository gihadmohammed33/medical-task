@extends('layouts.admin')
@section('title', 'Create Product')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Create New Product</h2>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border px-3 py-2 rounded">
            @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

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


        <div>
            <label class="block font-medium">Image</label>
            <input type="file" name="image" class="w-full border px-3 py-2 rounded">
            @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Create Product</button>
        </div>
    </form>
</div>
@endsection
