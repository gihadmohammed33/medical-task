@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Profile</h1>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Form --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Password (leave empty if unchanged)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-black px-6 py-2 rounded hover:bg-blue-700">
            Update Profile
        </button>
    </form>

    {{-- Danger Zone --}}
    <div class="mt-10 border-t pt-6">
        <h2 class="text-xl font-semibold text-red-600 mb-4">Danger Zone</h2>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.')"
                    class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Delete Account
            </button>
        </form>
    </div>
</div>
@endsection
