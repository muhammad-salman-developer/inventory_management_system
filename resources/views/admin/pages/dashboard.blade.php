@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('main')
    <div class="w-full px-6 py-6 mx-auto">

        <!-- row 1: Stats Cards -->
        <!-- row 1: Stats Cards -->
        <div class="flex flex-wrap -mx-3">

            {{-- Today's Sales --}}
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row items-center justify-between h-full">
                            <div>
                                <p class="mb-1 text-sm font-semibold uppercase dark:opacity-60">
                                    Today's Sales
                                </p>
                                <h5 class="mb-0 font-bold">
                                    Rs. {{ number_format($todaySales, 2) }}
                                </h5>
                            </div>

                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-blue-500 to-violet-500 shrink-0">
                                <i class="ni ni-money-coins text-lg text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Monthly Sales --}}
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row items-center justify-between h-full">
                            <div>
                                <p class="mb-1 text-sm font-semibold uppercase dark:opacity-60">
                                    Monthly Sales
                                </p>
                                <h5 class="mb-0 font-bold">
                                    Rs. {{ number_format($monthlySales, 2) }}
                                </h5>
                            </div>

                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400 shrink-0">
                                <i class="ni ni-cart text-lg text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Monthly Purchases --}}
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row items-center justify-between h-full">
                            <div>
                                <p class="mb-1 text-sm font-semibold uppercase dark:opacity-60">
                                    Monthly Purchases
                                </p>
                                <h5 class="mb-0 font-bold">
                                    Rs. {{ number_format($monthlyPurchases, 2) }}
                                </h5>
                            </div>

                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500 shrink-0">
                                <i class="ni ni-box-2 text-lg text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Low Stock Alert --}}
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row items-center justify-between h-full">
                            <div>
                                <p class="mb-1 text-sm font-semibold uppercase dark:opacity-60">
                                    Low Stock Items
                                </p>

                                <h5 class="mb-0 font-bold {{ $lowStockCount > 0 ? 'text-red-600' : '' }}">
                                    {{ $lowStockCount }}
                                </h5>
                            </div>

                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-red-600 to-orange-600 shrink-0">
                                <i class="ni ni-bell-55 text-lg text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- row 2: Extra Stats -->
        <div class="flex flex-wrap mt-0 -mx-3">

            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/3">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 rounded-2xl p-4">
                    <p class="mb-1 text-sm text-slate-500">Total Customers</p>
                    <h5 class="mb-0 font-bold">{{ $totalCustomers }}</h5>
                </div>
            </div>

            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/3">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 rounded-2xl p-4">
                    <p class="mb-1 text-sm text-slate-500">Total Products</p>
                    <h5 class="mb-0 font-bold">{{ $totalProducts }}</h5>
                </div>
            </div>

            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/3">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 rounded-2xl p-4">
                    <p class="mb-1 text-sm text-slate-500">Pending Purchases</p>
                    <h5 class="mb-0 font-bold {{ $pendingPurchasesCount > 0 ? 'text-yellow-600' : '' }}">
                        {{ $pendingPurchasesCount }}
                    </h5>
                </div>
            </div>

        </div>

        <!-- row 3: Chart -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3">
                <div
                    class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize ">Sales vs Purchases (Last 7 Days)</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <canvas id="chart-line" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 4: Recent Sales + Purchases -->
        <div class="flex flex-wrap mt-6 -mx-3">

            {{-- Recent Sales --}}
            <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 rounded-t-4">
                        <h6 class="mb-2 ">Recent Sales</h6>
                    </div>
                    <div class="overflow-x-auto p-4">
                        <table class="items-center w-full mb-0 align-top border-collapse">
                            <thead>
                                <tr class="text-xs text-slate-400 uppercase">
                                    <th class="p-2 text-left">Invoice</th>
                                    <th class="p-2 text-left">Customer</th>
                                    <th class="p-2 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentSales as $sale)
                                    <tr class="border-b border-slate-100">
                                        <td class="p-2 text-sm">{{ $sale->invoice_number }}</td>
                                        <td class="p-2 text-sm">{{ $sale->customer->name ?? 'N/A' }}</td>
                                        <td class="p-2 text-sm text-right font-semibold">Rs.
                                            {{ number_format($sale->total_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-4 text-center text-slate-400">No sales yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Recent Purchases --}}
            <div class="w-full max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 rounded-t-4">
                        <h6 class="mb-2 ">Recent Purchases</h6>
                    </div>
                    <div class="overflow-x-auto p-4">
                        <table class="items-center w-full mb-0 align-top border-collapse">
                            <thead>
                                <tr class="text-xs text-slate-400 uppercase">
                                    <th class="p-2 text-left">Supplier</th>
                                    <th class="p-2 text-center">Status</th>
                                    <th class="p-2 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPurchases as $purchase)
                                    <tr class="border-b border-slate-100">
                                        <td class="p-2 text-sm">{{ $purchase->supplier->name ?? 'N/A' }}</td>
                                        <td class="p-2 text-sm text-center">
                                            @if ($purchase->status == 'pending')
                                                <span
                                                    class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                                            @elseif ($purchase->status == 'cancelled')
                                                <span
                                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Cancelled</span>
                                            @elseif ($purchase->status == 'received')
                                                <span
                                                    class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Received</span>
                                            @endif
                                        </td>
                                        <td class="p-2 text-sm text-right font-semibold">Rs.
                                            {{ number_format($purchase->total_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-4 text-center text-slate-400">No purchases yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 5: Low Stock Table -->
        @if ($lowStockCount > 0)
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 rounded-2xl bg-clip-border">
                        <div class="p-4 pb-0 mb-0 rounded-t-4">
                            <h6 class="mb-2 text-red-600">⚠️ Low Stock Products</h6>
                        </div>
                        <div class="overflow-x-auto p-4">
                            <table class="items-center w-full mb-0 align-top border-collapse">
                                <thead>
                                    <tr class="text-xs text-slate-400 uppercase">
                                        <th class="p-2 text-left">Product</th>
                                        <th class="p-2 text-right">Current Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowStockProducts as $product)
                                        <tr class="border-b border-slate-100">
                                            <td class="p-2 text-sm">{{ $product->name }}</td>
                                            <td class="p-2 text-sm text-right font-semibold text-red-600">{{ $product->stock }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart-line').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($last7Days->pluck('date')) !!},
                datasets: [
                    {
                        label: 'Sales',
                        data: {!! json_encode($last7Days->pluck('sales')) !!},
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
                        tension: 0.4,
                    },
                    {
                        label: 'Purchases',
                        data: {!! json_encode($last7Days->pluck('purchases')) !!},
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249,115,22,0.1)',
                        tension: 0.4,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } }
            }
        });
    </script>
@endsection