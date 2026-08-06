<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;

class StockController extends Controller
{
  public static function middleware(): array
    {
        return [
            new Middleware('permission:view-stock', only: ['index']),
        ];
    }

    public function index()
    {
        $stocks = Stock::with('product')->latest()->paginate(15);
        return view('admin.pages.stock.index', compact('stocks'));
    }
}
