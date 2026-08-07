<!-- Main modal -->
<div id="customer-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal width managed to fit fields beautifully -->
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Header -->
            <div class="relative bg-neutral-primary-soft p-5 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-800">
                        Create New Customer
                    </h3>
                    <button type="button"
                        class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-700 rounded-xl text-sm w-9 h-9 ms-auto inline-flex justify-center items-center transition-colors"
                        data-modal-hide="customer-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://w3.org" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>

            <!-- Form Body with Layout Cleaned -->
            <form action="{{ route('customers.store') }}" class="p-6 space-y-5" method="post">
                @csrf
                
                <!-- Grid system to align fields side-by-side -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <!-- Customer Name -->
                    <div class="col-span-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-slate-700">
                            Customer Name *
                        </label>
                        <input type="text" name="name" id="name"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type customer name" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Phone -->
                    <div class="col-span-1">
                        <label for="phone" class="block mb-2 text-sm font-medium text-slate-700">
                            Customer Phone *
                        </label>
                        <input type="text" name="phone" id="phone"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type customer phone" required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Email  -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-slate-700">
                            Customer Email
                        </label>
                        <input type="email" name="email" id="email"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type customer email">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Address (Takes Full Width) -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-slate-700">
                            Customer Address
                        </label>
                        <input type="text" name="address" id="address"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type customer address">
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

             <!-- Footer Buttons -->
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-200">
                        <button type="button" data-modal-hide="customer-modal"
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
