<!-- Main modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal width managed to fit fields beautifully -->
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="relative bg-neutral-primary-soft p-5 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-800">
                        Edit Customer
                    </h3>
                    <button type="button" onclick="closeEditCustomerModal()"
                        class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-700 rounded-xl text-sm w-9 h-9 ms-auto inline-flex justify-center items-center transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>

            <!-- Body and Form Container -->
            <div class="p-6 space-y-5">

                <!-- Hidden ID -->
                <input type="hidden" id="editCustomerId">

                <!-- Grid system to align fields side-by-side -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Customer Name -->
                    <div class="col-span-1">
                        <label for="editName" class="block mb-2 text-sm font-medium text-slate-700">
                            Customer Name
                        </label>
                        <input type="text" id="editName"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type customer name">
                        <p id="nameError" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <!-- Phone -->
                    <div class="col-span-1">
                        <label for="editPhone" class="block mb-2 text-sm font-medium text-slate-700">
                            Phone
                        </label>
                        <input type="text" id="editPhone"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type phone number">
                        <p id="phoneError" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <!-- Email -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="editEmail" class="block mb-2 text-sm font-medium text-slate-700">
                            Email
                        </label>
                        <input type="email" id="editEmail"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type email address">
                        <p id="emailError" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <!-- Address -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="editAddress" class="block mb-2 text-sm font-medium text-slate-700">
                            Address
                        </label>
                        <textarea id="editAddress" rows="2"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 resize-y transition-all"
                            placeholder="Write customer address here..."></textarea>
                    </div>

                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                    <button type="button" onclick="closeEditCustomerModal()"
                        class="flex-1 py-2 px-1 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button type="button" onclick="updateCustomer()"
                        class="flex-1 py-2 px-1 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="updateBtnText">Update Customer</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- JavaScript --}}

<script>
    function openEditCustomerModal(id, name, phone, email, address) {
        document.getElementById('editCustomerId').value = id;
        document.getElementById('editName').value = name ?? '';
        document.getElementById('editPhone').value = phone ?? '';
        document.getElementById('editEmail').value = email ?? '';
        document.getElementById('editAddress').value = address ?? '';

        document.getElementById('nameError').classList.add('hidden');
        document.getElementById('phoneError').classList.add('hidden');
        document.getElementById('emailError').classList.add('hidden');

        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal').classList.add('flex');
    }

    function closeEditCustomerModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('flex');
    }

    function updateCustomer() {
        const id = document.getElementById('editCustomerId').value;
        const name = document.getElementById('editName').value;
        const phone = document.getElementById('editPhone').value;
        const email = document.getElementById('editEmail').value;
        const address = document.getElementById('editAddress').value;

        document.getElementById('nameError').classList.add('hidden');
        document.getElementById('phoneError').classList.add('hidden');
        document.getElementById('emailError').classList.add('hidden');

        if (!name.trim()) {
            document.getElementById('nameError').innerText = 'Name zaroori hai!';
            document.getElementById('nameError').classList.remove('hidden');
            return;
        }

        document.getElementById('updateBtnText').innerText = 'Updating...';

        fetch(`/customers/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name, phone, email, address })
        })
            .then(async res => {
                const data = await res.json();

                if (!res.ok) {
                    if (data.errors) {
                        if (data.errors.name) {
                            document.getElementById('nameError').innerText = data.errors.name[0];
                            document.getElementById('nameError').classList.remove('hidden');
                        }
                        if (data.errors.phone) {
                            document.getElementById('phoneError').innerText = data.errors.phone[0];
                            document.getElementById('phoneError').classList.remove('hidden');
                        }
                        if (data.errors.email) {
                            document.getElementById('emailError').innerText = data.errors.email[0];
                            document.getElementById('emailError').classList.remove('hidden');
                        }
                    }
                    throw new Error(data.message ?? 'Validation failed');
                }

                return data;
            })
            .then(data => {
                if (data.success) {
                    closeEditCustomerModal();

                    document.getElementById(`customerName_${id}`).innerText = data.customer.name;
                    if (document.getElementById(`customerPhone_${id}`)) {
                        document.getElementById(`customerPhone_${id}`).innerText = data.customer.phone ?? '—';
                    }
                    if (document.getElementById(`customerEmail_${id}`)) {
                        document.getElementById(`customerEmail_${id}`).innerText = data.customer.email ?? '—';
                    }
                    if (document.getElementById(`customerAddress_${id}`)) {
                        document.getElementById(`customerAddress_${id}`).innerText = data.customer.address ?? '—';
                    }

                    showSuccess(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                document.getElementById('updateBtnText').innerText = 'Update Customer';
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