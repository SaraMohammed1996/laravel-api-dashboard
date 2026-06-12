<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'message' => 'Dashboard data retrieved successfully.',
            'data' => [
                'user' => new UserResource($user),
                'stats' => [
                    'total_products' => $user->products()->count(),
                    'low_stock_products' => $user->products()->where('quantity', '<', 10)->count(),
                    'total_inventory_value' => (float) ($user->products()->selectRaw('SUM(price * quantity) as total')->value('total') ?? 0),
                ],
            ],
        ]);
    }
}
