<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') - MediShop</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
      <div class="p-6">
        <h1 class="text-2xl font-bold mb-8">Admin Panel</h1>
        <nav class="space-y-2">
          <a href="{{ route('admin.products.index') }}" 
             class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
          <a href="{{ route('admin.orders.index') }}" 
             class="block py-2 px-4 rounded hover:bg-gray-700">Orders</a>
          <a href="{{ route('admin.product-logs.index') }}" 
             class="block py-2 px-4 rounded hover:bg-gray-700">Product Logs</a>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      
      <!-- Header with Profile -->
      <header class="bg-white shadow flex justify-between items-center px-6 py-4">
        <h2 class="text-xl font-semibold">@yield('title', 'Dashboard')</h2>
        
        <!-- Profile Dropdown -->
        <div class="relative">
          <button id="profileBtn" 
                  class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded hover:bg-gray-200">
            <span>{{ auth()->user()->name }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div id="profileDropdown" 
               class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded hidden z-50">
            <a href="{{ route('profile.edit') }}" 
               class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
               Profile
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" 
                      class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                Logout
              </button>
            </form>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 p-6 bg-gray-100">
        @yield('content')
      </main>

      <!-- Footer -->
      <footer class="bg-gray-800 text-gray-300 py-4 mt-auto text-center">
        &copy; {{ date('Y') }} MediShop. All rights reserved.
      </footer>
    </div>

  </div>

  <!-- Simple JS for Dropdown -->
  <script>
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });
  </script>

</body>
</html>
