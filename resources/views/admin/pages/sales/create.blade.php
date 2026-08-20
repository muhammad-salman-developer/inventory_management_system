@extends('admin.layouts.app')
@section('title', 'Create Sale')
@section('main')

    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-5xl m-auto">

        {{-- Header --}}
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between border-b-0 border-b-solid rounded-b-2xl">
            <h6>Create Sale</h6>
            <a href="{{ route('sales.index') }}"
                class="text-white !bg-gray-500 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5 flex items-center gap-1">
                Back
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="p-4 mx-6 mt-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
            @csrf

            <div class="p-6">

                {{-- Top Fields --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                    {{-- Customer --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-600">Customer</label>
                        <select name="customer_id" class="w-full border border-gray-300 rounded-lg text-sm p-2.5" required>
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-600">Date</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg text-sm p-2.5" required>
                    </div>

                    {{-- Invoice Number (auto, readonly display) --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-600">Invoice Number</label>
                        <input type="text" value="Auto-generated" disabled
                            class="w-full border border-gray-300 rounded-lg text-sm p-2.5 bg-gray-100 text-gray-400">
                    </div>
                </div>

                {{-- Items Table --}}
                <div class="p-0 overflow-x-auto border border-gray-200 rounded-lg mb-4">
                    <table class="items-center w-full mb-0 align-top text-slate-500" id="itemsTable">
                        <thead class="align-bottom bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 font-bold text-left text-xs text-slate-400 uppercase">Product</th>
                                <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase w-28">Available
                                </th>
                                <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase w-28">Quantity
                                </th>
                                <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase w-32">Unit Price
                                </th>
                                <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase w-32">Subtotal
                                </th>
                                <th class="px-4 py-3 font-bold text-center text-xs text-slate-400 uppercase w-16"></th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody">
                            {{-- JS se rows yahan add hongi --}}
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addItemBtn"
                    class="text-cyan-600 border border-cyan-600 font-medium rounded-lg text-sm px-4 py-2 mb-6 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Item
                </button>

                {{-- Totals --}}
                <div class="flex justify-end">
                    <div class="w-full md:w-1/3 space-y-3">

                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-slate-600">Tax (Rs.)</label>
                            <input type="number" step="0.01" min="0" name="tax" id="taxInput" value="{{ old('tax', 0) }}"
                                class="w-32 border border-gray-300 rounded-lg text-sm p-2 text-right">
                        </div>

                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-slate-600">Discount (Rs.)</label>
                            <input type="number" step="0.01" min="0" name="discount" id="discountInput"
                                value="{{ old('discount', 0) }}"
                                class="w-32 border border-gray-300 rounded-lg text-sm p-2 text-right">
                        </div>

                        <div class="flex justify-between items-center border-t pt-3">
                            <span class="text-base font-bold text-slate-700">Total Amount</span>
                            <span class="text-base font-bold text-cyan-600" id="grandTotal">Rs. 0.00</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Submit --}}
            <div class="px-6 py-4 border-t flex justify-end gap-2">
                <a href="{{ route('sales.index') }}"
                    class="!bg-gray-200 text-slate-600 font-medium rounded-lg text-sm px-4 py-2.5">
                    Cancel
                </a>
                <button type="submit" class="text-white !bg-cyan-600 font-medium rounded-lg text-sm px-6 py-2.5">
                    Save Sale
                </button>
            </div>
        </form>
    </div>

    <script>
        const products = @json($productsForJs);

        let itemIndex = 0;

        function productOptions(selected = '') {
            let options = '<option value="">Select Product</option>';
            products.forEach(p => {
                options += `<option value="${p.id}" data-price="${p.price}" data-stock="${p.stock}" ${selected == p.id ? 'selected' : ''}>${p.name}</option>`;
            });
            return options;
        }

        function addItemRow() {
            const tbody = document.getElementById('itemsBody');
            const row = document.createElement('tr');
            row.classList.add('border-b');
            row.innerHTML = `
                                <td class="p-2">
                                    <select name="items[${itemIndex}][product_id]" class="product-select w-full border border-gray-300 rounded-lg text-sm p-2" required>
                                        ${productOptions()}
                                    </select>
                                </td>
                                <td class="p-2 text-center stock-display text-sm text-slate-500">-</td>
                                <td class="p-2">
                                    <input type="number" name="items[${itemIndex}][quantity]" min="1" value="1"
                                        class="qty-input w-full border border-gray-300 rounded-lg text-sm p-2 text-center" required>
                                </td>
                                <td class="p-2">
                                    <input type="number" step="0.01" name="items[${itemIndex}][unit_price]"
                                        class="price-input w-full border border-gray-300 rounded-lg text-sm p-2 text-right" required>
                                </td>
                                <td class="p-2 text-right subtotal-display text-sm font-medium">Rs. 0.00</td>
                                <td class="p-2 text-center">
                                    <button type="button" class="removeItemBtn text-red-500 font-medium text-sm">✕</button>
                                </td>
                            `;
            tbody.appendChild(row);
            itemIndex++;
            bindRowEvents(row);

            updateProductOptions();
        }

        function bindRowEvents(row) {
            const productSelect = row.querySelector('.product-select');
            const qtyInput = row.querySelector('.qty-input');
            const priceInput = row.querySelector('.price-input');
            const stockDisplay = row.querySelector('.stock-display');
            const removeBtn = row.querySelector('.removeItemBtn');

            productSelect.addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                const price = selected.dataset.price || 0;
                const stock = selected.dataset.stock || 0;
                priceInput.value = price;
                stockDisplay.textContent = stock;
                qtyInput.max = stock;
                calculateRow(row);

                updateProductOptions();
            });

            [qtyInput, priceInput].forEach(el => el.addEventListener('input', () => calculateRow(row)));

            removeBtn.addEventListener('click', function () {
                row.remove();
                calculateGrandTotal();

                updateProductOptions();
            });
        }

        function calculateRow(row) {
            const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const subtotal = qty * price;
            row.querySelector('.subtotal-display').textContent = 'Rs. ' + subtotal.toFixed(2);
            calculateGrandTotal();
        }

        function updateProductOptions() {
            let selectedProducts = [];

            document.querySelectorAll('select[name^="items"][name$="[product_id]"]').forEach(select => {
                if (select.value) {
                    selectedProducts.push(select.value);
                }
            });

            document.querySelectorAll('select[name^="items"][name$="[product_id]"]').forEach(select => {
                let currentValue = select.value;

                select.querySelectorAll('option').forEach(option => {
                    if (option.value === '') return;

                    if (selectedProducts.includes(option.value) && option.value !== currentValue) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                });
            });
        }

        function calculateGrandTotal() {
            let total = 0;
            document.querySelectorAll('#itemsBody tr').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty-input')?.value) || 0;
                const price = parseFloat(row.querySelector('.price-input')?.value) || 0;
                total += qty * price;
            });

            const tax = parseFloat(document.getElementById('taxInput').value) || 0;
            const discount = parseFloat(document.getElementById('discountInput').value) || 0;

            const grandTotal = total + tax - discount;
            document.getElementById('grandTotal').textContent = 'Rs. ' + grandTotal.toFixed(2);
        }

        document.getElementById('addItemBtn').addEventListener('click', addItemRow);
        document.getElementById('taxInput').addEventListener('input', calculateGrandTotal);
        document.getElementById('discountInput').addEventListener('input', calculateGrandTotal);

        document.addEventListener('DOMContentLoaded', () => addItemRow());
    </script>

@endsection