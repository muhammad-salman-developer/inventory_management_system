@extends('admin.layouts.app')
@section('title', 'Create Product')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl flex justify-between border-b-0 border-b-solid rounded-b-2xl">
            <h6>Product Table</h6>
            <!-- Modal toggle -->
            @can('view-category')
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
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
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
                                action</th>
                            <th
                                class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
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
                                    <td class=" p-2 leading-normal text-center align-middle
                                    bg-transparent border-b text-sm whitespace-nowrap shadow-transparent" ">
                                    {{ $product->stock }}
                                </td>
                                <td
                                    class=" p-2 text-center align-middle bg-transparent border-b
                                    whitespace-nowrap shadow-transparent">
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center gap-2">
                                        @can('edit-category')
                                            {{-- <a href="{{ route('categories.edit', $category->id) }}" data-name="{{ $cate }}"
                                                class="font-medium text-white bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">Edit</a>
                                            --}}
                                            {{-- <button type="button"
                                                onclick="openEditModal('{{ $category->id }}', '{{ addslashes($category->name) }}', '{{ addslashes($category->description) }}')"
                                                class="!bg-blue-600 text-white font-medium hover:bg-blue-700 py-1 px-3 rounded">
                                                Edit
                                            </button> --}}
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
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">

        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <h3 class="text-lg font-medium text-heading">
                            Create New Product
                        </h3>
                        <button type="button"
                            class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="crud-modal">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <form action="{{ route('products.store') }}" class="p-6 space-y-6" method="post">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-slate-700">
                                Product Name
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                                placeholder="Type product name" required>
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-slate-700">
                                Product Category
                            </label>

                            <select name="category_id" id="category_id"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800"
                                required>
                                <option value="">Select Category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-slate-700">
                                Product Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 resize-y transition-all"
                                placeholder="Write product description here..."></textarea>
                        </div>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-slate-700">
                                Product Price
                            </label>
                            <input type="text" name="price" id="price"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                                placeholder="Type product price" required>
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="stock" class="block mb-2 text-sm font-medium text-slate-700">
                                Product Stock
                            </label>
                            <input type="text" name="stock" id="stock"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                                placeholder="Type product stock" required>
                        </div>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <!-- Footer -->
                        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                            <button type="button" data-modal-hide="crud-modal"
                                class="flex-1 py-2 px-1 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                class="flex-1 py-2 px-1 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('admin.pages.category.partials.category_edit_modal') --}}
@endsection
