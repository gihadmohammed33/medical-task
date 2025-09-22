<x-app-layout>
    <x-slot name="header"><h2>Create Product</h2></x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div>
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}">
            </div>

            <div>
                <label>Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}">
            </div>

            <div>
                <label>Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>

            <div>
                <label>Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>
</x-app-layout>
