  <!-- Main modal -->
    <div id="purchase-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">

        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <h3 class="text-lg font-medium text-heading">
                            Create New Purchase
                        </h3>
                        <button type="button"
                            class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="purchase-modal">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <form action="{{ route('purchases.store') }}" class="p-6 space-y-6" method="post">
                        @csrf
                        <div>
                            <label for="supplier" class="block mb-2 text-sm font-medium text-slate-700">
                                Supplier 
                            </label>
                            <input type="text" name="supplier" id="supplier"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                                placeholder="Enter supplier name" required>
                        </div>
                        @error('supplier')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-slate-700">
                                Date
                            </label>
                            <input type="date" name="date" id="date"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                                required>
                        </div>
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <!-- Footer -->
                        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                            <button type="button" data-modal-hide="purchase-modal"
                                class="flex-1 py-2 px-1 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                class="flex-1 py-2 px-1 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Save Purchase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>