@extends('admin.layouts.app')

@section('title', 'Purchase Details')

@section('main')

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-6">

        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Purchase Details
        </h2>


        {{-- Purchase Information --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

            <div>
                <strong>Supplier:</strong>
                {{ $purchase->supplier->name }}
            </div>

            <div>
                <strong>Date:</strong>
                {{ $purchase->date }}
            </div>

            <div>
                <strong>Tax:</strong>
                {{ $purchase->tax }}%
            </div>

            <div>
                <strong>Discount:</strong>
                {{ $purchase->discount }}%
            </div>

            <div>
                <strong>Status:</strong>
                {{ $purchase->status }}
            </div>

            @php
                $itemsSubTotal = $purchase->items->sum('total');
            @endphp

            <div>
                <strong>Sub Total:</strong>
                {{ number_format($itemsSubTotal, 2) }}
            </div>

            <div>
                <strong>Total Amount:</strong>
                {{ number_format($purchase->total_amount, 2) }}
            </div>

        </div>


        <hr class="my-6">


        {{-- Purchase Items --}}
        <h3 class="text-lg font-bold mb-4">
            Purchase Items
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="p-3 border">Product</th>
                        <th class="p-3 border">Quantity</th>
                        <th class="p-3 border">Unit Price</th>
                        <th class="p-3 border">Tax</th>
                        <th class="p-3 border">Discount</th>
                        <th class="p-3 border">Sub_total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchase->items as $item)
                        <tr>
                            <td class="p-3 border">
                                {{ $item->product->name }}
                            </td>
                            <td class="p-3 border">
                                {{ $item->quantity }}
                            </td>
                            <td class="p-3 border">
                                {{ $item->unit_price }}
                            </td>
                            <td class="p-3 border">
                                {{ $item->tax }}
                            </td>
                            <td class="p-3 border">
                                {{ $item->discount }}
                            </td>
                            <td class="p-3 border">
                                {{ $item->total }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection