<div class="border rounded p-3 flex flex-col">
  <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover mb-2" loading="lazy">
  <h3 class="font-semibold">{{ $product->name }}</h3>
  <p class="text-sm text-gray-600">{{ Str::limit($product->description, 80) }}</p>
  <div class="mt-auto flex items-center justify-between">
    <span class="font-bold">${{ number_format($product->price,2) }}</span>

    <!-- non-JS fallback: add-to-cart form -->
    <form class="add-to-cart-form" data-product-id="{{ $product->id }}" method="POST" action="{{ route('cart.add') }}">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <input type="hidden" name="quantity" value="1" class="quantity-input">
      <button type="submit" class="btn btn-primary">Add to cart</button>
    </form>
  </div>
</div>
