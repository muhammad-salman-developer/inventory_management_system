<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->latest()->paginate(15);

        return view('admin.pages.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('admin.pages.purchase.create', compact('suppliers', 'products'));
    }

    public function store(PurchaseRequest $request)
    {

        // Purchase save karo
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'date' => $request->date,
            'tax' => $request->tax ?? 0,
            'discount' => $request->discount ?? 0,
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->items as $item) {

            $subTotal = $item['quantity'] * $item['unit_price'];
            $taxAmount = $item['tax'] ?? 0;
            $discount = $item['discount'] ?? 0;
            $itemTotal = $subTotal + $taxAmount - $discount;

            $totalAmount += $itemTotal;

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'tax' => $taxAmount,
                'discount' => $discount,
                'total' => $itemTotal,
            ]);

            $product = Product::find($item['product_id']);
            $stockBefore = $product->stock;

            $product->increment('stock', $item['quantity']);

            Stock::create([
                'product_id' => $product->id,
                'type' => 'purchase',
                'direction' => 'in',
                'quantity' => $item['quantity'],
                'stock_before' => $stockBefore,
                'stock_after' => $stockBefore + $item['quantity'],
            ]);
        }

        $purchase->update([
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase created successfully!');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'items.product',
        ]);

        return view('admin.pages.purchase.show', compact('purchase'));
    }
}
