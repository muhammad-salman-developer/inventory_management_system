@extends('admin.layouts.app')
@section('title', 'Sale Details')
@section('main')

    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-5xl m-auto">

        {{-- Header --}}
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between items-center border-b-0 border-b-solid rounded-b-2xl">
            <div>
                <h6>Sale Invoice</h6>
                <p class="text-sm text-slate-400">{{ $sale->invoice_number }}</p>
            </div>
            <a href="{{ route('sales.index') }}"
                class="text-white !bg-gray-500 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5 flex items-center gap-1">
                Back
            </a>
        </div>

        {{-- Invoice Info --}}
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 border border-gray-200 rounded-lg p-4">

                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold mb-1">Customer</p>
                    <p class="text-sm font-medium text-slate-700">{{ $sale->customer?->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold mb-1">Sold By</p>
                    <p class="text-sm font-medium text-slate-700">{{ $sale->user?->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold mb-1">Date</p>
                    <p class="text-sm font-medium text-slate-700">{{ $sale->date }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold mb-1">Invoice Number</p>
                    <p class="text-sm font-medium text-slate-700">{{ $sale->invoice_number }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold mb-1">Created At</p>
                    <p class="text-sm font-medium text-slate-700">{{ $sale->created_at->format('d M Y, h:i A') }}</p>
                </div>

            </div>

            {{-- Items Table --}}
            <div class="p-0 overflow-x-auto border border-gray-200 rounded-lg mb-6">
                <table class="items-center w-full mb-0 align-top text-slate-500">
                    <thead class="align-bottom bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-bold text-left text-xs text-slate-400 uppercase">#</th>
                            <th class="px-4 py-3 font-bold text-left text-xs text-slate-400 uppercase">Product</th>
                            <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase">Quantity</th>
                            <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase">Unit Price</th>
                            <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->items as $item)
                            <tr class="border-b">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $item->product?->name ?? 'Deleted Product' }}</td>
                                <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-center">Rs. {{ number_format($item->unit_price, 2) }}</td>
                                <td class="px-4 py-3 text-center font-medium">Rs. {{ number_format($item->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center">No items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Totals --}}
            <div class="flex justify-end">
                <div class="w-full md:w-1/3 space-y-2 border border-gray-200 rounded-lg p-4">

                    @php
                        $subTotal = $sale->items->sum('total');
                    @endphp

                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Sub Total</span>
                        <span class="font-medium text-slate-700">Rs. {{ number_format($subTotal, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tax</span>
                        <span class="font-medium text-slate-700">Rs. {{ number_format($sale->tax, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Discount</span>
                        <span class="font-medium text-red-500">- Rs. {{ number_format($sale->discount, 2) }}</span>
                    </div>

                    <div class="flex justify-between border-t pt-2">
                        <span class="text-base font-bold text-slate-700">Total Amount</span>
                        <span class="text-base font-bold text-cyan-600">Rs. {{ number_format($sale->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection