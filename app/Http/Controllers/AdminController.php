<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalIncome' => Order::sum('total_price'),

            // grafik bulanan
            'monthlyOrders' => Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month'),

            // recent activity (pesanan terbaru)
            'recentOrders' => Order::latest()->take(5)->get(),

            // top products
            'topProducts' => Product::withCount('orders')
                ->orderBy('orders_count', 'desc')
                ->take(5)
                ->get(),
        ]);
    }
}
