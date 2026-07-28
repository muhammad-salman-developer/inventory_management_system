@extends('admin.layouts.app')
@section('title', 'Create Purchase')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white border border-slate-100 shadow-xl rounded-2xl max-w-5xl m-auto">
        {{-- Header --}}
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-2xl">
            <h6 class="text-xl font-bold text-slate-800">Create New Purchase</h6>

            <p class="text-sm text-slate-500 mt-1">Fill out the information below to add a new inventory purchase.</p>
        </div>
        <div class="p-6 md:p-8">
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                {{-- SECTION 1: Purchase Information --}}
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-6 bg-cyan-600 rounded-full"></div>
                    <h6 class="text-lg font-bold text-slate-800">Purchase Information</h6>
                </div>

                {{-- Inputs Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    {{-- Supplier --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Supplier</label>
                        <select name="supplier_id" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Date</label>
                        <input type="date" name="date" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                    </div>

                    {{-- Tax --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Tax (%)</label>
                        <input type="number" name="tax" id="purchaseTax" placeholder="0.00"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                    </div>

                    {{-- Discount --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Discount</label>
                        <input type="number" name="discount" id="purchaseDiscount" placeholder="0.00"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                    </div>

                    {{-- Total --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Grand Total</label>
                        <input type="number" name="total" id="purchaseGrandTotal" placeholder="0.00" readonly
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-500 font-semibold outline-none cursor-not-allowed">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">Status</label>
                        <select name="status"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="received">Received</option>
                        </select>
                    </div>

                </div>


                <hr class="my-8 border-slate-200">

                {{-- SECTION 2: Purchase Items --}}
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6 w-full">
                    {{-- Left Side: Title with Icon Line --}}
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-cyan-600 rounded-full"></div>
                        <h6 class="text-lg font-bold text-slate-800">Purchase Items</h6>
                    </div>

                    {{-- Right Side: Dynamic Add Item Button --}}
                    <button type="button" id="addItemBtn"
                        class="!bg-cyan-600 text-white py-2 px-4 rounded-xl hover:bg-cyan-700 font-medium text-sm transition-all flex items-center gap-1.5 shadow-sm active:scale-95">
                        <svg xmlns="http://w3.org" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>
                {{-- Responsive Styled Table --}}
                <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-sm">
                    <table class="w-full min-w-[800px] text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4 w-1/3">Product</th>
                                <th class="p-4">Quantity</th>
                                <th class="p-4">Unit Price</th>
                                <th class="p-4">Tax (%)</th>
                                <th class="p-4">Discount</th>
                                <th class="p-4">Total</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white" id="itemBody">
                            <tr class="hover:bg-slate-50/50 transition-colors">

                                {{-- Product Dropdown --}}
                                <td class="p-4">
                                    <select name="items[0][product_id]"
                                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                {{-- Quantity --}}
                                <td class="p-4">
                                    <input type="number" name="items[0][quantity]" placeholder="0"
                                        class="quantity w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                                </td>
                                {{-- Unit Price --}}
                                <td class="p-4">
                                    <input type="number" name="items[0][unit_price]" placeholder="0.00"
                                        class="unit_price w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                                </td>
                                {{-- Tax --}}
                                <td class="p-4">
                                    <input type="number" name="items[0][tax]" placeholder="0"
                                        class="tax w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                                </td>
                                {{-- Discount --}}
                                <td class="p-4">
                                    <input type="number" name="items[0][discount]" placeholder="0.00"
                                        class="discount w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                                </td>

                                {{-- Total --}}
                                <td class="p-4">
                                    <input type="number" name="items[0][total]" readonly placeholder="0.00"
                                        class="item_total w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-slate-500 font-medium outline-none cursor-not-allowed">
                                </td>

                                <td class="p-4">
                                    <button type="button" class="removeItem text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Submit Form Bar --}}
                <div class="flex justify-between items-end mt-8">

                    {{-- Save Button --}}
                    <button type="submit"
                        class="!bg-cyan-600 hover:bg-cyan-700 text-white font-medium px-8 py-3 rounded-xl shadow-md shadow-cyan-600/10 hover:shadow-cyan-600/20 active:scale-[0.98] transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        Save Purchase Invoice
                    </button>
                    {{-- Sub Total --}}
                    <div class="w-72">
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Sub Total
                        </label>

                        <div class="relative">
                            <i
                                class="fa-solid fa-money-bill-wave absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input type="number" id="purchaseTotal" name="total_amount" value="0" readonly
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-4 py-3 text-slate-700 font-semibold outline-none">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let itemIndex = 1;

        // Naya item row add 
        document.getElementById('addItemBtn').addEventListener('click', function () {
            let row = `
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="p-4">
                                                    <select name="items[${itemIndex}][product_id]"
                                                        class="w-full border border-slate-300 rounded-lg px-3 py-2">
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td class="p-4">
                                                    <input type="number"
                                                        name="items[${itemIndex}][quantity]"
                                                        class="quantity w-full border rounded-lg px-3 py-2">
                                                </td>

                                                <td class="p-4">
                                                    <input type="number"
                                                        name="items[${itemIndex}][unit_price]"
                                                        class="unit_price w-full border rounded-lg px-3 py-2">
                                                </td>

                                                <td class="p-4">
                                                    <input type="number"
                                                        name="items[${itemIndex}][tax]"
                                                        class="tax w-full border rounded-lg px-3 py-2">
                                                </td>

                                                <td class="p-4">
                                                    <input type="number"
                                                        name="items[${itemIndex}][discount]"
                                                        class="discount w-full border rounded-lg px-3 py-2">
                                                </td>

                                                <td class="p-4">
                                                    <input type="number"
                                                        name="items[${itemIndex}][total]"
                                                        readonly
                                                        class="item_total w-full bg-slate-50 border rounded-lg px-3 py-2">
                                                </td>
                                                <td class="p-4">
                                                    <button type="button" class="removeItem text-red-500 hover:text-red-700">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                            `;
            document.getElementById('itemBody')
                .insertAdjacentHTML('beforeend', row);
            itemIndex++;
        });

        // Row remove  + sub total update
        document.addEventListener('click', function (e) {
            if (e.target.closest('.removeItem')) {
                let row = e.target.closest('tr');
                row.remove();
                calculateGrandTotal();
            }
        });
        document.addEventListener('input', function (e) {
            if (
                e.target.classList.contains('quantity') ||
                e.target.classList.contains('unit_price') ||
                e.target.classList.contains('tax') ||
                e.target.classList.contains('discount')
            ) {
                let row = e.target.closest('tr');

                let quantity = Number(row.querySelector('.quantity')?.value) || 0;
                let unitPrice = Number(row.querySelector('.unit_price')?.value) || 0;
                let taxPct = Number(row.querySelector('.tax')?.value) || 0;
                let discount = Number(row.querySelector('.discount')?.value) || 0;

                let baseAmount = quantity * unitPrice;
                let taxAmount = (baseAmount * taxPct) / 100;

                let total = baseAmount + taxAmount - discount;
                if (total < 0) total = 0;

                let itemTotalField = row.querySelector('.item_total');
                if (itemTotalField) itemTotalField.value = total.toFixed(2);

                calculateGrandTotal();
            }
        });

        // Sab items ke total ko jama kar ke Sub Total field mein dikhana
        function calculateGrandTotal() {
            let rows = document.querySelectorAll('#itemBody tr');
            let grandTotal = 0;

            rows.forEach(row => {
                let itemTotal = Number(row.querySelector('.item_total')?.value) || 0;
                grandTotal += itemTotal;
            });

            let purchaseTotalField = document.getElementById('purchaseTotal');
            if (purchaseTotalField) purchaseTotalField.value = grandTotal.toFixed(2);
        }

        function calculateGrandTotal() {
            let rows = document.querySelectorAll('#itemBody tr');
            let itemsSum = 0;

            rows.forEach(row => {
                let itemTotal = Number(row.querySelector('.item_total')?.value) || 0;
                itemsSum += itemTotal;
            });

            let purchaseTotalField = document.getElementById('purchaseTotal');
            if (purchaseTotalField) purchaseTotalField.value = itemsSum.toFixed(2);

            updatePurchaseGrandTotal(itemsSum);
        }

        function updatePurchaseGrandTotal(itemsSum) {
            let taxPct = Number(document.getElementById('purchaseTax')?.value) || 0;
            let discountPct = Number(document.getElementById('purchaseDiscount')?.value) || 0;
            let taxAmount = (itemsSum * taxPct) / 100;
            let discountAmount = (itemsSum * discountPct) / 100;
            let grandTotal = itemsSum + taxAmount - discountAmount;
            if (grandTotal < 0) grandTotal = 0;
            let grandTotalField = document.getElementById('purchaseGrandTotal');
            if (grandTotalField) grandTotalField.value = grandTotal.toFixed(2);
        }

        document.addEventListener('input', function (e) {
            if (e.target.id === 'purchaseTax' || e.target.id === 'purchaseDiscount') {
                let itemsSum = Number(document.getElementById('purchaseTotal')?.value) || 0;
                updatePurchaseGrandTotal(itemsSum);
            }
        });
    </script>
@endsection