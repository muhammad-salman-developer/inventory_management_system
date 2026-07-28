@extends('admin.layouts.app')
@section('title', 'Create Purchase')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between border-b-0 border-b-solid rounded-b-2xl">
            <h6>Purchase Table</h6>
            <!-- Modal toggle -->
            @can('create-purchase')
                <a type="button" href="{{ route('purchases.create') }}"
                    class="text-white !bg-cyan-600 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Purchase
                </a>
            @endcan

        </div>
        {{-- Success Alert (Create + Update dono ke liye) --}}
        <div id="successAlert"
            class="{{ session('success') ? '' : 'hidden' }} auto-fade-alert p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 transition-opacity duration-500 ease-out opacity-100"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent  shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent  shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                supplier</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent  shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                date </th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent shadow-none text-xl tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Tax
                            </th>

                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent shadow-none text-xl tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Discount
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent  border-gray-200 shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                total_amount</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent   shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                status</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent  shadow-none text-xl  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                action</th>
                        </tr>
                    </thead>
                    @forelse ($purchases as $purchase)
                        <tbody>
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                    {{ $purchase->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent  whitespace-nowrap shadow-transparent"
                                    id="purchaseSupplier_{{ $purchase->id }}">
                                    {{ $purchase->supplier->name }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent  text-sm whitespace-nowrap shadow-transparent"
                                    id="purchaseDate_{{ $purchase->id }}">
                                    {{ $purchase->date }}
                                </td>
                                <td
                                    class="p-2 leading-normal text-center align-middle bg-transparent text-sm whitespace-nowrap shadow-transparent">
                                    {{ $purchase->tax }}
                                </td>

                                <td
                                    class="p-2 leading-normal text-center align-middle bg-transparent text-sm whitespace-nowrap shadow-transparent">
                                    {{ $purchase->discount }}
                                </td>

                                <td class="p-2 leading-normal text-center align-middle bg-transparent  text-sm whitespace-nowrap shadow-transparent"
                                    id="purchaseTotalAmount_{{ $purchase->id }}">
                                    {{ $purchase->total_amount }}
                                </td>


                                <td class="p-2 text-center align-middle whitespace-nowrap">
                                    @if ($purchase->status == 'pending')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                            Pending
                                        </span>
                                    @elseif ($purchase->status == 'approved')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                            Approved
                                        </span>
                                    @elseif ($purchase->status == 'received')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                            Received
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        <a type="button" href="{{ route('purchases.show', $purchase->id) }}"
                                            class="!bg-green-600 text-white font-medium hover:bg-green-700 py-1 px-3 rounded">
                                            View
                                        </a>
                                </td>
                            </tr>

                        </tbody>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="p-2 text-center align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                No purchases found.
                            </td>
                        </tr>
                    @endforelse

                </table>
                <div class="mt-6">
                    {{ $purchases->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
