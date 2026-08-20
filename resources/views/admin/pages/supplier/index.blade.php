@extends('admin.layouts.app')
@section('title', 'Create Supplier')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">
        <div
            class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between items-center border-b-0 border-b-solid rounded-b-2xl">
            <h6>Supplier Table</h6>

            <!-- Modal toggle -->
            @can('create-supplier')
                <button data-modal-target="supplier-modal" data-modal-toggle="supplier-modal" type="button"
                    class="text-white !bg-cyan-600 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Supplier
                </button>
            @endcan
        </div>
        <div id="successAlert"
            class="{{ session('success') ? '' : 'hidden' }} auto-fade-alert p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 transition-opacity duration-500 ease-out opacity-100"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0  border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                name</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                email</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                phone</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                address</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                status</th>

                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $supplier->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="supplierName_{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="supplierEmail_{{ $supplier->id }}">
                                    {{ $supplier->email }}
                                </td>

                                <td class="p-2 leading-normal text-center align-middle bg-transparent    border-b text-sm whitespace-nowrap shadow-transparent"
                                    id="supplierContact_{{ $supplier->id }}">
                                    {{ $supplier->contact }}
                                </td>
                                <td class=" p-2 leading-normal text-center align-middle bg-transparent border-b text-sm
                                                    whitespace-nowrap shadow-transparent"
                                    id="supplierAddress_{{ $supplier->id }}">
                                    {{ $supplier->address }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent"
                                    id="supplierStatus_{{ $supplier->id }}">

                                    @if ($supplier->status)
                                        <span class="text-green-600">Active</span>
                                    @else
                                        <span class="text-red-600">Inactive</span>
                                    @endif

                                </td>

                                <td class=" p-2 align-middle bg-transparent border-b whitespace-nowrap
                                                    shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        @can('edit-supplier')
                                            {{-- <a href="{{ route('categories.edit', $category->id) }}" data-name="{{ $cate }}"
                                                class="font-medium text-white bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">Edit</a>
                                            --}}
                                            <button type="button" onclick="openSupplierEditModal('{{ $supplier->id }}',
                                                                        '{{ $supplier->name }}',
                                                                        '{{ $supplier->email }}',
                                                                        '{{ $supplier->contact }}',
                                                                        '{{ $supplier->address }}',
                                                                        '{{ $supplier->status }}'
                                                                        )"
                                                class="font-medium text-white !bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">
                                                Edit
                                            </button>
                                        @endcan

                                        @can('delete-supplier')
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium text-white !bg-red-600 hover:bg-red-700 py-1 px-3 rounded">Delete</button>
                                            </form>
                                        @endcan
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5"
                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    No suppliers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @include('admin.pages.supplier.partials.create-model')
    @include('admin.pages.supplier.partials.edit-model')

@endsection