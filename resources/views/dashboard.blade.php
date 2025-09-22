@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- Products Card -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold mb-2">Products</h3>
    <p class="text-gray-700">Manage all products in your shop.</p>
    <a href="{{ route('admin.products.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Products</a>
  </div>

  <!-- Orders Card -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold mb-2">Orders</h3>
    <p class="text-gray-700">View all customer orders.</p>
    <a href="{{ route('admin.orders.index') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">View Orders</a>
  </div>

  <!-- Product Logs Card -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold mb-2">Product Logs</h3>
    <p class="text-gray-700">See all product changes history.</p>
    <a href="{{ route('admin.product-logs.index') }}" class="mt-4 inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">View Logs</a>
  </div>

</div>
@endsection
