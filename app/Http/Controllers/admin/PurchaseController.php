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
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            // Purchase save 
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'date' => $request->date,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'total_amount' => 0,
                'status' => $request->status ?? 'pending', 
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
                if ($purchase->status === 'received') {
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
            }

            $purchase->update([
                'total_amount' => $totalAmount,
            ]);

            DB::commit();

            return redirect()->route('purchases.index')
                ->with('success', 'Purchase created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'items.product',
        ]);

        return view('admin.pages.purchase.show', compact('purchase'));
    }

    public function updateStatus(Request $request, Purchase $purchase)
    {
        $request->validate([
            'status' => 'required|in:pending,cancelled,received',
        ]);

        $oldStatus = $purchase->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('info', 'Status already '.$newStatus);
        }

        DB::beginTransaction();
        try {
            $purchase->load('items.product');
            if ($oldStatus !== 'received' && $newStatus === 'received') {
                foreach ($purchase->items as $item) {
                    $product = $item->product;
                    $stockBefore = $product->stock;
                    $product->increment('stock', $item->quantity);
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => 'purchase',
                        'direction' => 'in',
                        'quantity' => $item->quantity,
                        'stock_before' => $stockBefore,
                        'stock_after' => $stockBefore + $item->quantity,
                    ]);
                }
            }
            if ($oldStatus === 'received' && $newStatus !== 'received') {
                foreach ($purchase->items as $item) {
                    $product = $item->product;
                    $stockBefore = $product->stock;
                    $product->decrement('stock', $item->quantity);
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => 'purchase',
                        'direction' => 'out',
                        'quantity' => $item->quantity,
                        'stock_before' => $stockBefore,
                        'stock_after' => $stockBefore - $item->quantity,
                    ]);
                }
            }

            $purchase->update(['status' => $newStatus]);
            DB::commit();
            return back()->with('success', 'Purchase status updated to '.ucfirst($newStatus));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }
}
