@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600">Welcome back, {{ auth()->user()->name }}.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm font-medium text-gray-500">Total Products</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm font-medium text-gray-500">Low Stock (&lt; 10)</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $lowStockProducts }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <p class="text-sm font-medium text-gray-500">Inventory Value</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">${{ number_format($totalInventoryValue, 2) }}</p>
        </div>
    </div>

    <div class="mt-8 flex flex-wrap gap-4">
        <a href="{{ route('products.index') }}"
           class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
            Manage Products
        </a>
        <a href="{{ route('products.create') }}"
           class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Add New Product
        </a>
    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">API Endpoints</h2>
        <p class="mt-2 text-sm text-gray-600">
            Use the REST API with Bearer token authentication. Authenticated endpoints require the
            <code class="rounded bg-gray-100 px-1.5 py-0.5 text-xs">Authorization: Bearer {token}</code> header.
        </p>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500">
                        <th class="py-2 pr-4 font-medium">Method</th>
                        <th class="py-2 pr-4 font-medium">Endpoint</th>
                        <th class="py-2 font-medium">Auth</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">POST</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/register</td>
                        <td class="py-2">Public</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">POST</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/login</td>
                        <td class="py-2">Public</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">GET</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/user</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">GET</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/dashboard</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">GET</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/products?search=</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">POST</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/products</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-700">PUT</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/products/{id}</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">DELETE</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/products/{id}</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">GET</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/profile</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="py-2 pr-4"><span class="rounded bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-700">PUT</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/profile</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4"><span class="rounded bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">POST</span></td>
                        <td class="py-2 pr-4 font-mono text-xs">/api/v1/logout</td>
                        <td class="py-2">Sanctum</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
