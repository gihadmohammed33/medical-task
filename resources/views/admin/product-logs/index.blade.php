@extends('layouts.admin')

@section('title', 'Product Logs')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Product Logs</h2>

    <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">ID</th>
                <th class="border p-3">Product</th>
                <th class="border p-3">Action</th>
                <th class="border p-3">Changes</th>
                <th class="border p-3">Changed By</th>
                <th class="border p-3">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr class="hover:bg-gray-50">
                <td class="border p-3">{{ $log->id }}</td>
                <td class="border p-3">{{ $log->product->name ?? 'Deleted' }}</td>
                <td class="border p-3">{{ ucfirst($log->action) }}</td>
                <td class="border p-3">{{ $log->changes }}</td>
                <td class="border p-3">{{ $log->changed_by ?? '-' }}</td>
                <td class="border p-3">{{ $log->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">No logs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">{{ $logs->links() }}</div>
</div>
@endsection
