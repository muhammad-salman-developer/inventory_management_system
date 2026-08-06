@extends('admin.layouts.app')
@section('title', 'Stock History')
@section('main')
    <div
    class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-5xl m-auto">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between border-b-0 border-b-solid rounded-b-2xl">
            <h6>Stock History</h6>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3  font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                product</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                type</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                direction</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                quantity</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                stock before</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                stock after</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $stock->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $stock->product->name ?? 'N/A' }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    {{ ucfirst($stock->type) }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    @if($stock->direction === 'in')
                                        <span class="inline-flex items-center gap-1 text-green-700 bg-green-100 px-2 py-1 rounded-lg text-xs font-medium">
                                            ▲ In
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-red-700 bg-red-100 px-2 py-1 rounded-lg text-xs font-medium">
                                            ▼ Out
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    {{ $stock->quantity }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    {{ $stock->stock_before }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent font-semibold">
                                    {{ $stock->stock_after }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                    {{ $stock->created_at->format('d M Y, h:i A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center align-middle bg-transparent border-b text-slate-400 whitespace-nowrap shadow-transparent">
                                    No stock movements found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4">
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
@endsection
