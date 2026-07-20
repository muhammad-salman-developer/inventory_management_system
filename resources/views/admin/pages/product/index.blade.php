@extends('admin.layouts.app')
@section('title', 'Create Product')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">
        <div
            class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between items-center border-b-0 border-b-solid rounded-b-2xl">
            <h6>Product Table</h6>
            <form action="{{ route('products.index') }}" method="GET">
                <div class="flex flex-wrap gap-3 mb-4">

                    {{-- Search Input Group --}}
                    <div class="relative flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                            class="border border-slate-300 rounded-xl pl-4 pr-10 py-2 text-sm focus:border-cyan-400 focus:outline-none">

                        {{-- Search Icon Right Side --}}
                        <button type="submit"
                            class="absolute right-0 inset-y-0 flex items-center pr-3 text-slate-400 hover:text-cyan-500 transition-colors">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                    </div>

                    {{-- Category Filter --}}
                    <select name="category_id" onchange="this.form.submit()"
                        class="border border-slate-300 rounded-xl px-4 py-2 text-sm focus:border-cyan-400 focus:outline-none">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Clear Button --}}
                    @if (request('search') || request('category_id'))
                        <a href="{{ route('products.index') }}"
                            class="px-4 py-2 text-slate-100 bg-slate-500 rounded-xl text-sm hover:bg-slate-600 transition-colors">
                            <i class="fas fa-times mr-1"></i>
                            Clear
                        </a>
                    @endif

                </div>
            </form>
            <!-- Modal toggle -->
            @can('create-product')
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button"
                    class="text-white !bg-cyan-600 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Product
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
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                name</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                category</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                description</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                price</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                stock</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                front_image</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                back_image</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td
                                    class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $product->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                                    id="productName_{{ $product->id }}">
                                    {{ $product->name }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $product->category->name }}
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent"
                                    id="productDesc_{{ $product->id }}">
                                    {{ $product->description }}
                                </td>
                                <td
                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent" ">
                                    {{ $product->price }}
                                    </td>
                                    <td class=" p-2 leading-normal
                                    text-center align-middle bg-transparent border-b text-sm whitespace-nowrap
                                    shadow-transparent" ">
                                    {{ $product->stock }}
                                </td>
                                <td class=" p-2 text-center border-b">
                                    @php
                                        $frontImage = $product->frontImages->first();
                                    @endphp

                                    @if ($frontImage)
                                        <img src="{{ asset('storage/' . $frontImage->image) }}"
                                            class="w-16 h-16 object-cover rounded-lg mx-auto">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="p-2 text-center border-b">
                                    @php
                                        $backImage = $product->backImages->where('type', 'back')->first();
                                    @endphp

                                    @if ($backImage)
                                        <img src="{{ asset('storage/' . $backImage->image) }}"
                                            class="w-16 h-16 object-cover rounded-lg mx-auto">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td
                                    class=" p-2 align-middle bg-transparent border-b whitespace-nowrap
                                                                                    shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        @can('edit-product')
                                            {{-- <a href="{{ route('categories.edit', $category->id) }}" data-name="{{ $cate }}"
                                                class="font-medium text-white bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">Edit</a>
                                            --}}
                                            <button type="button"
                                                onclick="openProductEditModal('{{ $product->id }}',
                                                '{{ $product->category_id }}',
                                                '{{ addslashes($product->name) }}',
                                                '{{ addslashes($product->description) }}',
                                                '{{ $product->price }}',
                                                {{-- '{{ $product->stock }}' --}}
                                                )"
                                                class="font-medium text-white !bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">
                                                Edit
                                            </button>
                                        @endcan

                                        @can('delete-product')
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
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
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @include('admin.pages.product.partials.create-model')
    @include('admin.pages.product.partials.edit-model')

@endsection
