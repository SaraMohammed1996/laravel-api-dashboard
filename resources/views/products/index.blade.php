@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your product inventory.</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
            Add Product
        </a>
    </div>

    <div class="mb-6 rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200">
        <form method="GET" action="{{ route('products.index') }}" id="search-form" class="flex flex-col gap-3 sm:flex-row">
            <input type="search" name="search" id="search-input" value="{{ $search }}"
                   placeholder="Search by product name..."
                   class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            <div class="flex gap-2">
                <button type="submit"
                        class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">
                    Search
                </button>
                @if ($search)
                    <a href="{{ route('products.index') }}"
                       class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if ($products->isEmpty())
        <div class="rounded-xl bg-white p-12 text-center shadow-sm ring-1 ring-gray-200">
            <p class="text-gray-600">
                @if ($search)
                    No products found matching "{{ $search }}".
                @else
                    No products yet. Create your first product to get started.
                @endif
            </p>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                    @if ($product->image)
                        <img src="{{ Storage::disk('public')->url($product->image) }}" alt="{{ $product->name }}"
                             class="h-40 w-full object-cover">
                    @else
                        <div class="flex h-40 items-center justify-center bg-gray-100 text-sm text-gray-400">No image</div>
                    @endif

                    <div class="p-5">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h2>
                        @if ($product->description)
                            <p class="mt-2 line-clamp-2 text-sm text-gray-600">{{ $product->description }}</p>
                        @endif
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="font-semibold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                            <span class="text-gray-500">Qty: {{ $product->quantity }}</span>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('products.edit', $product) }}"
                               class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('search-input');
        const form = document.getElementById('search-form');
        let timeout;

        input?.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => form.submit(), 400);
        });
    });
</script>
@endpush
