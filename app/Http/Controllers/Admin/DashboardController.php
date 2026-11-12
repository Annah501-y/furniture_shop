<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'staffCount' => User::query()->where('role', 'staff')->count(),
            'activeProductCount' => Product::query()->where('is_active', true)->count(),
            'activeCategoryCount' => Category::query()->where('is_active', true)->count(),
            'openOrderCount' => Order::query()
                ->whereIn('status', ['pending', 'confirmed', 'out_for_delivery'])
                ->count(),
            'recentStaff' => User::query()
                ->where('role', 'staff')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
