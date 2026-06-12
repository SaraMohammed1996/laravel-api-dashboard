@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Profile</h1>
        <p class="mt-1 text-sm text-gray-600">View and update your account information.</p>
    </div>

    <div class="max-w-xl rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <div class="mb-6 space-y-4 border-b border-gray-100 pb-6">
            <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Member Since</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Save changes
            </button>
        </form>
    </div>
@endsection
