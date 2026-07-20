<!-- Main modal (Pehli line fix ki hai taake lg screen par absolute center khule) -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal width container (max-w-2xl kiya taake space dono sides se equal aye) -->
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            {{-- Header (Padding and Spacing Fixed) --}}
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-5">

                <div class="flex items-center justify-between border-b border-default pb-3 md:pb-4">
                    <h3 class="text-base font-medium text-heading">
                        Edit Supplier
                    </h3>
                    <button type="button" onclick="closeSupplierEditModal()"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                {{-- Body (Space-y-6 se kam kar ke space-y-4 kiya hai) --}}
                <div class="p-4 md:p-5 space-y-4">

                    {{-- Hidden ID --}}
                    <input type="hidden" id="editSupplierId">

                    <!-- Grid for Name & Email to save vertical space -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Name --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Name
                            </label>
                            <input type="text" id="editName"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier name">
                            <p id="nameError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Email
                            </label>
                            <input type="email" id="editEmail"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier email">
                            <p id="emailError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                    </div>

                    <!-- Grid for Contact & Address -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Contact --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Contact
                            </label>
                            <input type="text" id="editContact"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier contact">
                            <p id="contactError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Supplier Address
                            </label>
                            <input type="text" id="editAddress"
                                class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all text-sm"
                                placeholder="Type supplier address">
                            <p id="addressError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Supplier Status
                        </label>
                        <select id="editStatus"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 transition-all text-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <p id="statusError" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    {{-- Footer Buttons (Perfect Spacing and Styling) --}}
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-200">
                        <button type="button" onclick="closeSupplierEditModal()"
                            class="flex-1 py-2.5 px-2 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors text-sm">
                            Cancel
                        </button>
                        <button type="button" onclick="updateSupplier()"
                            class="flex-1 py-2.5 px-2 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600 hover:bg-cyan-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span id="updateBtnText">Update Supplier</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- JavaScript --}}
<script>
    function openSupplierEditModal(id, name, email, contact, address, status) {
        document.getElementById('editSupplierId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email ?? '';
        document.getElementById('editContact').value = contact ?? '';
        document.getElementById('editAddress').value = address ?? '';
        document.getElementById('editStatus').value = status ?? '';
        document.getElementById('nameError').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal').classList.add('flex');
    }

    function closeSupplierEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('flex');
    }

    function updateSupplier() {
        const id = document.getElementById('editSupplierId').value;
        const formData = new FormData();

        formData.append('_method', 'PUT');
        formData.append('name', document.getElementById('editName').value);
        formData.append('email', document.getElementById('editEmail').value);
        formData.append('contact', document.getElementById('editContact').value);
        formData.append('address', document.getElementById('editAddress').value);
        formData.append('status', document.getElementById('editStatus').value);

        if (!document.getElementById('editName').value.trim()) {
            document.getElementById('nameError').classList.remove('hidden');
            document.getElementById('nameError').innerText = 'Name zaroori hai!';
            return;
        }

        document.getElementById('updateBtnText').innerText = 'Updating...';

        fetch(`/suppliers/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'

            },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeSupplierEditModal();

                    const supplier = data.supplier;

                    const nameEl = document.getElementById(`supplierName_${id}`);
                    if (nameEl) nameEl.innerText = supplier.name;

                    const emailEl = document.getElementById(`supplierEmail_${id}`);
                    if (emailEl) emailEl.innerText = supplier.email ?? '';

                    const contactEl = document.getElementById(`supplierContact_${id}`);
                    if (contactEl) contactEl.innerText = supplier.contact ?? '';

                    const addressEl = document.getElementById(`supplierAddress_${id}`);
                    if (addressEl) addressEl.innerText = supplier.address ?? '';

                    showSuccess(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                document.getElementById('updateBtnText').innerText = 'Update Supplier';
            });
    }

    function showSuccess(message) {
        const alertDiv = document.getElementById('successAlert');

        if (alertDiv) {
            alertDiv.querySelector('span').innerText = message;
            alertDiv.classList.remove('hidden');
            setTimeout(() => {
                alertDiv.classList.add('hidden');
            }, 3000);
        } else {
            const newAlert = document.createElement('div');
            newAlert.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800';
            newAlert.innerHTML = `<span class="font-medium">${message}</span>`;

            const table = document.querySelector('table');
            table.parentNode.insertBefore(newAlert, table);

            setTimeout(() => newAlert.remove(), 3000);
        }
    }
</script>