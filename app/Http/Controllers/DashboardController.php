<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('dashboard', [
            'totalProducts' => $user->products()->count(),
            'lowStockProducts' => $user->products()->where('quantity', '<', 10)->count(),
            'totalInventoryValue' => $user->products()->selectRaw('SUM(price * quantity) as total')->value('total') ?? 0,
        ]);
    }
}
