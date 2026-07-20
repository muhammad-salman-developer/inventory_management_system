<!-- Main modal -->
<!-- Main modal (Pehli line fix ki hai taake lg screen par bina layout kharab kiye absolute center khule) -->
<div id="supplier-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal width container (Is ko max-w-2xl kiya taake elements compact rahein aur space equal aye) -->
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            <!-- Header (Padding and Spacing Fixed) -->
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-5">
                <div class="flex items-center justify-between border-b border-default pb-3 md:pb-4">
                    <h3 class="text-base font-medium text-heading">
                        Create New Supplier
                    </h3>
                    <button type="button"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors"
                        data-modal-hide="supplier-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body (Space-y-6 se kam kar ke space-y-4 kiya hai taake gaps kam hon) -->
                <form action="{{ route('suppliers.store') }}" class="p-4 md:p-5 space-y-4" method="post">
                    @csrf

                    <!-- Grid for Name & Email to save vertical space on desktop -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Supplier Name --}}
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Name
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier name" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Supplier Email --}}
                        <div>
                            <label for="email" class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier email" >
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Grid for Contact & Address -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Supplier Contact --}}
                        <div>
                            <label for="contact" class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Contact
                            </label>
                            <input type="text" name="contact" id="contact"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier contact" required>
                            @error('contact')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Supplier Address --}}
                        <div>
                            <label for="address" class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Address
                            </label>
                            <input type="text" name="address" id="address"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier address" >
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium text-slate-700">
                            Supplier Status
                        </label>

                        <select name="status" id="status"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 transition-all text-sm"
                            required>

                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Footer Buttons (Perfect Spacing and Custom Style Match) -->
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-200">
                        <button type="button" data-modal-hide="supplier-modal"
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
                            Save Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>