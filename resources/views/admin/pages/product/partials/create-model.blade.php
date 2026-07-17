<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal width container -->
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-5">
                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-default pb-3 md:pb-4">
                    <h3 class="text-base font-medium text-heading">
                        Create New Product
                    </h3>
                    <button type="button"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="crud-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body (Compact spacing built for image fields) -->
                <form action="{{ route('products.store') }}" class="p-4 md:p-5 space-y-4" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Grid for Name & Category to reduce modal length -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-slate-700">
                                Product Name
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type product name" required>
                        </div>
                        <div>
                            <label for="category_id" class="block mb-1 text-sm font-medium text-slate-700">
                                Product Category
                            </label>
                            <select name="category_id" id="category_id"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 text-sm"
                                required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block mb-1 text-sm font-medium text-slate-700">
                            Product Description
                        </label>
                        <textarea id="description" name="description" rows="2"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 resize-y transition-all text-sm"
                            placeholder="Write product description here..."></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 2x2 Grid for Financials and File Uploads -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Price --}}
                        <div>
                            <label for="price" class="block mb-1 text-sm font-medium text-slate-700">
                                Product Price
                            </label>
                            <input type="text" name="price" id="price"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type product price" required>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div>
                            <label for="stock" class="block mb-1 text-sm font-medium text-slate-700">
                                Product Stock
                            </label>
                            <input type="text" name="stock" id="stock"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type product stock" required>
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Front Images --}}
                        <div>
                            <label for="front_images" class="block mb-1 text-sm font-medium text-slate-700">
                                Front Images
                            </label>
                            <input type="file" name="front_images[]" id="front_images" multiple accept="image/*"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2 text-slate-800 transition-all text-sm file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100"
                                required>
                            @error('front_images')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Back Images --}}
                        <div>
                            <label for="back_images" class="block mb-1 text-sm font-medium text-slate-700">
                                Back Images
                            </label>
                            <input type="file" name="back_images[]" id="back_images" multiple accept="image/*"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2 text-slate-800 transition-all text-sm file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100"
                                required>
                            @error('back_images')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-200">
                        <button type="button" data-modal-hide="crud-modal"
                            class="flex-1 py-2.5 px-2 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors text-sm">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 py-2.5 px-2 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
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