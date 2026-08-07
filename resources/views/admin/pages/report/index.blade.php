@extends('admin.layouts.app')
@section('title', 'Reports')
@section('main')

    <div class="max-w-5xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Reports</h2>
            <p class="text-sm text-slate-500 mt-1">Sales, Purchases aur Stock ka overview ek hi jagah.</p>
        </div>

        {{-- ===================== SUMMARY CARDS ===================== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- Sales Card --}}
            <button type="button" onclick="switchReportTab('sales')" id="card-sales"
                class="report-card text-left bg-white border border-slate-100 shadow-md rounded-2xl p-6 transition-all hover:shadow-xl hover:-translate-y-1 ring-2 ring-cyan-500">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-slate-500">Sales</span>
                    <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-800">
                    {{ number_format($salesSummary['total_amount'], 2) }}
                </h3>
                <p class="text-xs text-slate-400 mt-1">{{ $salesSummary['count'] }} total sales</p>
            </button>

            {{-- Purchases Card --}}
            <button type="button" onclick="switchReportTab('purchases')" id="card-purchases"
                class="report-card text-left bg-white border border-slate-100 shadow-md rounded-2xl p-6 transition-all hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-slate-500">Purchases</span>
                    <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="fa-solid fa-truck-fast"></i>
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-800">
                    {{ number_format($purchasesSummary['total_amount'], 2) }}
                </h3>
                <p class="text-xs text-slate-400 mt-1">{{ $purchasesSummary['count'] }} total purchases</p>
            </button>

            {{-- Stock Card --}}
            <button type="button" onclick="switchReportTab('stock')" id="card-stock"
                class="report-card text-left bg-white border border-slate-100 shadow-md rounded-2xl p-6 transition-all hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-slate-500">Stock</span>
                    <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-800">
                    {{ $stockSummary['total_products'] }} Products
                </h3>
                <p class="text-xs text-slate-400 mt-1">
                    {{ $stockSummary['low_stock'] }} low stock &middot; value {{ number_format($stockSummary['total_value'], 2) }}
                </p>
            </button>

        </div>

        {{-- ===================== TABLES ===================== --}}
        <div class="bg-white border border-slate-100 shadow-md rounded-2xl overflow-hidden">

            {{-- SALES TABLE --}}
            <div id="tab-sales" class="report-tab">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-bold text-slate-800">Sales Report</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4">ID</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($sales as $sale)
                                <tr>
                                    <td class="p-4">{{ $sale->id }}</td>
                                    <td class="p-4">{{ $sale->customer->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $sale->created_at->format('d M, Y') }}</td>
                                    <td class="p-4 font-medium">{{ number_format($sale->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-slate-400">Koi sales record nahi mila.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PURCHASES TABLE --}}
            <div id="tab-purchases" class="report-tab hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-bold text-slate-800">Purchases Report</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4">ID</th>
                                <th class="p-4">Supplier</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($purchases as $purchase)
                                <tr>
                                    <td class="p-4">{{ $purchase->id }}</td>
                                    <td class="p-4">{{ $purchase->supplier->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $purchase->date }}</td>
                                    <td class="p-4 capitalize">{{ $purchase->status }}</td>
                                    <td class="p-4 font-medium">{{ number_format($purchase->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-slate-400">Koi purchase record nahi mila.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- STOCK TABLE --}}
            <div id="tab-stock" class="report-tab hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-bold text-slate-800">Stock Report</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4">Product</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Stock</th>
                                <th class="p-4">Value</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($stock as $product)
                                <tr>
                                    <td class="p-4">{{ $product->name }}</td>
                                    <td class="p-4">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ number_format($product->price, 2) }}</td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 rounded-lg text-xs font-medium
                                            {{ $product->stock <= 5 ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="p-4 font-medium">{{ number_format($product->stock * $product->price, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-slate-400">Koi product nahi mila.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function switchReportTab(tab) {
            // Sab tabs hide karo
            document.querySelectorAll('.report-tab').forEach(el => el.classList.add('hidden'));
            // Selected tab dikhao
            document.getElementById('tab-' + tab).classList.remove('hidden');

            // Sab cards se active ring hatao
            document.querySelectorAll('.report-card').forEach(el => el.classList.remove('ring-2', 'ring-cyan-500'));
            // Selected card pe ring lagao
            document.getElementById('card-' + tab).classList.add('ring-2', 'ring-cyan-500');
        }
    </script>

@endsection