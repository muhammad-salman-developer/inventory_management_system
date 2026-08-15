<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Stock;
use App\Http\Requests\Admin\SaleRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //  Sales List
    public function index()
    {
        $query = Sale::with(['customer', 'user', 'items.product']);

        if (auth()->user()->hasRole(['admin', 'manager'])) {
            $sales = $query->latest()->paginate(15);
        } else {
            $sales = $query->where('user_id', auth()->id())
                ->latest()
                ->paginate(15);
        }

        return view('admin.pages.sales.index', compact('sales'));
    }

    //  Sale Create Form
    public function create()
    {
        $customers = Customer::select('id', 'name', 'phone')->get();

        $products = Product::where('stock', '>', 0)
            ->select('id', 'name', 'price', 'stock')
            ->get();

     
        $productsForJs = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price,
                'stock' => $p->stock,
            ];
        })->values();

        return view('admin.pages.sales.create', compact('customers', 'products', 'productsForJs'));
    }

    //  Sale Save
    public function store(SaleRequest $request)
    {
        // Stock check karo
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if ($product->stock < $item['quantity']) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'items' => $product->name.' ka sirf '.$product->stock.' stock available hai!',
                    ]);
            }
        }

        DB::transaction(function () use ($request) {
            $invoiceNumber = 'INV-'.date('Y').'-'.str_pad(
                Sale::count() + 1, 4, '0', STR_PAD_LEFT
            );

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(),
                'invoice_number' => $invoiceNumber,
                'date' => $request->date,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'total_amount' => 0,
            ]);

            $totalAmount = 0;

            foreach ($request->items as $item) {

                $itemTotal = ($item['quantity'] * $item['unit_price']);
                $totalAmount += $itemTotal;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $itemTotal,
                ]);

                $product = Product::find($item['product_id']);
                $stockBefore = $product->stock;
                $product->decrement('stock', $item['quantity']);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 'sale',
                    'direction' => 'out',
                    'quantity' => $item['quantity'],
                    'stock_before' => $stockBefore,
                    'stock_after' => $stockBefore - $item['quantity'],
                ]);
            }

            $sale->update([
                'total_amount' => $totalAmount + ($request->tax ?? 0) - ($request->discount ?? 0),
            ]);
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale created successfully!');
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'items.product']);
        return view('admin.pages.sales.show', compact('sale'));
    }
}
