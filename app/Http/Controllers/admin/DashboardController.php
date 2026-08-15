<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Aaj ki Sale
        $todaySales = Sale::whereDate('date', Carbon::today())->sum('total_amount');

        // Is mahine ki total Sale
        $monthlySales = Sale::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('total_amount');

        // Is mahine ki total Purchase
        $monthlyPurchases = Purchase::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('total_amount');

        // Total Customers
        $totalCustomers = Customer::count();

        // Total Products
        $totalProducts = Product::count();

        // Low Stock Products 
        $lowStockProducts = Product::where('stock', '<=', 10)->get();
        $lowStockCount = $lowStockProducts->count();

        // Pending Purchases
        $pendingPurchasesCount = Purchase::where('status', 'pending')->count();

        // Recent Sales (last 5)
        $recentSales = Sale::with('customer')->latest()->take(5)->get();

        // Recent Purchases (last 5)
        $recentPurchases = Purchase::with('supplier')->latest()->take(5)->get();

        // Last 7 
        $last7Days = collect(range(6, 0))->map(function ($day) {
            $date = Carbon::today()->subDays($day);
            return [
                'date' => $date->format('d M'),
                'sales' => Sale::whereDate('date', $date)->sum('total_amount'),
                'purchases' => Purchase::whereDate('date', $date)->sum('total_amount'),
            ];
        });

        return view('admin.pages.dashboard', compact(
            'todaySales',
            'monthlySales',
            'monthlyPurchases',
            'totalCustomers',
            'totalProducts',
            'lowStockProducts',
            'lowStockCount',
            'pendingPurchasesCount',
            'recentSales',
            'recentPurchases',
            'last7Days'
        ));
    }
}