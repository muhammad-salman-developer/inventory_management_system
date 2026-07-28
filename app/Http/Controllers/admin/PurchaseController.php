<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
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

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
        ]);

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

            Product::find($item['product_id'])
                ->increment('stock', $item['quantity']);
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
