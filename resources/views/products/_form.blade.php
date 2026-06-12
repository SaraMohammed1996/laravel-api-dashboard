@php
    $product = $product ?? null;
@endphp

<div>
    <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Product Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $product?->name) }}" required
           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
    @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="image" class="mb-1 block text-sm font-medium text-gray-700">Product Image</label>
    @if ($product?->image)
        <div class="mb-2">
            <img src="{{ Storage::disk('public')->url($product->image) }}" alt="{{ $product->name }}"
                 class="h-24 w-24 rounded-lg object-cover ring-1 ring-gray-200">
        </div>
    @endif
    <input id="image" type="file" name="image" accept="image/*"
           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1 file:text-sm file:font-medium file:text-indigo-700">
    @error('image')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
    <textarea id="description" name="description" rows="4"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('description', $product?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="price" class="mb-1 block text-sm font-medium text-gray-700">Price</label>
        <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price', $product?->price) }}" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="quantity" class="mb-1 block text-sm font-medium text-gray-700">Available Quantity</label>
        <input id="quantity" type="number" name="quantity" min="0" value="{{ old('quantity', $product?->quantity ?? 0) }}" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        @error('quantity')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
