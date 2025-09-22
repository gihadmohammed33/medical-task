<nav class="flex items-center justify-between p-4 bg-white shadow">
  <a href="{{ route('home') }}" class="text-xl font-bold">MediShop</a>

  <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
    <input name="q" value="{{ request('q') }}" placeholder="Search products" class="border rounded px-2 py-1" />
    <select name="category" class="border rounded px-2 py-1">
      <option value="">All</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected(request('category')==$cat->id)>{{ $cat->name }}</option>
      @endforeach
    </select>
    <select name="sort" class="border rounded px-2 py-1">
      <option value="">Sort</option>
      <option value="price_asc" @selected(request('sort')=='price_asc')>Price ↑</option>
      <option value="price_desc" @selected(request('sort')=='price_desc')>Price ↓</option>
    </select>
    <button class="btn">Search</button>
  </form>

  <div>
    <a href="{{ route('cart.index') }}" class="relative">
      <svg class="w-6 h-6 inline-block">...</svg>
      <span id="cart-count" class="absolute -top-2 -right-3 bg-red-600 text-white rounded-full text-xs px-2">
        {{ session('cart') ? count(session('cart.items', [])) : 0 }}
      </span>
    </a>
  </div>
</nav>
