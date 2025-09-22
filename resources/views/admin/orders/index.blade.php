@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md max-w-7xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">All Orders</h2>

    <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3 text-left">Order ID</th>
                <th class="border p-3 text-left">Customer Name</th>
                <th class="border p-3 text-left">Phone</th>
                <th class="border p-3 text-left">Total Amount</th>
                <th class="border p-3 text-left">Status</th>
                <th class="border p-3 text-left">Date</th>
                <th class="border p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="border p-3">{{ $order->id }}</td>
                <td class="border p-3">{{ $order->full_name ?? 'Guest' }}</td>
                <td class="border p-3">{{ $order->phone ?? '-' }}</td>
                <td class="border p-3">${{ number_format($order->total, 2) }}</td>
                <td class="border p-3">{{ ucfirst($order->status) }}</td>
                <td class="border p-3">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td class="border p-3">
                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                       class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-gray-500">
                    No orders found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>

</div>
@endsection
