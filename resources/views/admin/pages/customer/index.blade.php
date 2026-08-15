@extends('admin.layouts.app')
@section('title', 'Create customer')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between border-b-0 border-b-solid rounded-b-2xl">
            <h6>Customer Table</h6>
            <!-- Modal toggle -->
            @can('create-customer')
                <button data-modal-target="customer-modal" data-modal-toggle="customer-modal" type="button"
                    class="text-white !bg-cyan-600 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Customer
                </button>
            @endcan

        </div>
        {{-- Success Alert  --}}
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
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                name</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                phone</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                email</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                address</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                action</th>
                        </tr>
                    </thead>
                    @forelse ($customers as $customer)
                        <tbody>
                            <tr>
                                <td
                                    class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $customer->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="customerName_{{ $customer->id }}">
                                    {{ $customer->name }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="customerPhone_{{ $customer->id }}">
                                    {{ $customer->phone }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent"
                                    id="customerEmail_{{ $customer->id }}">
                                    {{ $customer->email }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="customerAddress_{{ $customer->id }}">
                                    {{ $customer->address }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        @can('edit-customer')
                                            {{-- <a href="{{ route('customers.edit', $customer->id) }}" data-name="{{ $customer->name }}" data-description="{{ $customer->description }}"
                                                class="font-medium text-white bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">Edit</a>
                                            --}}
                                            <button type="button"
                                                onclick="openEditCustomerModal(
                                                '{{ $customer->id }}',
                                                '{{ addslashes($customer->name) }}',
                                                '{{ addslashes($customer->phone) }}',
                                                '{{ addslashes($customer->email) }}',
                                                '{{ addslashes($customer->address) }}'
                                                )"
                                                class="!bg-blue-600 text-white font-medium hover:bg-blue-700 py-1 px-3 rounded">
                                                Edit
                                            </button>
                                        @endcan

                                        @can('delete-customer')
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium text-white !bg-red-600 hover:bg-red-700 py-1 px-3 rounded">Delete</button>
                                            </form>
                                        @endcan
                                </td>
                            </tr>

                        </tbody>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                No customers found.
                            </td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
    @include('admin.pages.customer.partials.customer-create')
    @include('admin.pages.customer.partials.customer-edit')
@endsection
