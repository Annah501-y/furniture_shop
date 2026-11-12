<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('staff.dashboard', [
            'activeProductCount' => Product::query()->where('is_active', true)->count(),
            'activeCategoryCount' => Category::query()->where('is_active', true)->count(),
            'openOrderCount' => Order::query()
                ->whereIn('status', ['pending', 'confirmed', 'out_for_delivery'])
                ->count(),
        ]);
    }
}
