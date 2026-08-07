<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale; // agar model ka naam alag hai to yahan badal do
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $salesSummary = [
            'total_amount' => Sale::sum('total_amount'),
            'count'        => Sale::count(),
        ];

        $sales = Sale::with('customer')
            ->latest()
            ->take(100)
            ->get();

        $purchasesSummary = [
            'total_amount' => Purchase::sum('total_amount'),
            'count'        => Purchase::count(),
        ];

        $purchases = Purchase::with('supplier')
            ->latest()
            ->take(100)
            ->get();

        $stockSummary = [
            'total_products' => Product::count(),
            'low_stock'      => Product::where('stock', '<=', 5)->count(),
            'total_value'    => Product::sum(DB::raw('stock * price')),
        ];

        $stock = Product::with('category')
            ->orderBy('stock', 'asc')
            ->get();

        return view('admin.pages.report.index', compact(
            'salesSummary', 'sales',
            'purchasesSummary', 'purchases',
            'stockSummary', 'stock'
        ));
    }

    public function sales()
    {
        return redirect()->route('reports.index');
    }

    public function purchases()
    {
        return redirect()->route('reports.index');
    }

    public function stock()
    {
        return redirect()->route('reports.index');
    }
}