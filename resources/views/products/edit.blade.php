@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        <p class="mt-1 text-sm text-gray-600">Update product details.</p>
    </div>

    <div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            @include('products._form', ['product' => $product])

            <div class="flex gap-3">
                <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                    Save Changes
                </button>
                <a href="{{ route('products.index') }}"
                   class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
