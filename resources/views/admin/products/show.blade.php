@extends('layouts.admin')

@section('title', $product->name)

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">{{ $product->name }}</h2>
    <img src="{{ asset('storage/'.$product->image) }}" class="w-64 h-64 object-cover mb-4">
    <p class="mb-4">{{ $product->description }}</p>
    <p class="font-bold text-lg text-green-600">${{ number_format($product->price, 2) }}</p>
</div>
@endsection
