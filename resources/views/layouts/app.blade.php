<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>@yield('title', 'MediShop')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header / Navbar -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">MediShop</a>

      <nav class="flex items-center gap-6">
        <a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a>
        <a href="{{ route('cart.index') }}" class="relative">
          🛒
          <span id="cart-count"
                class="absolute -top-2 -right-3 bg-red-600 text-white text-xs px-2 rounded-full">
            {{ session('cart') ? count(session('cart.items', [])) : 0 }}
          </span>
        </a>
       
      </nav>
    </div>
  </header>

  <!-- Page content -->
  <main class="min-h-screen">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6 mt-10">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <p>&copy; {{ date('Y') }} MediShop. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
