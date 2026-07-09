<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">

                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Edit Category
                    </h3>
                    <button type="button" onclick="closeEditModal()"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                {{-- Body --}}
                <div class="p-6 space-y-6">

                    {{-- Hidden ID --}}
                    <input type="hidden" id="editCategoryId">

                    {{-- Name --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Category Name
                        </label>
                        <input type="text" id="editName"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 transition-all"
                            placeholder="Type category name">
                        <p id="nameError" class="text-red-500 text-sm mt-1 hidden"></p>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Category Description
                        </label>
                        <textarea id="editDescription" rows="4"
                            class="w-full bg-white border border-slate-300 focus:border-[#38bdf8] focus:ring-2 focus:ring-[#38bdf8]/20 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 resize-y transition-all"
                            placeholder="Write category description here..."></textarea>
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                        <button type="button" onclick="closeEditModal()"
                            class="flex-1 py-2 px-1 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="button" onclick="updateCategory()"
                            class="flex-1 py-2 px-1 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span id="updateBtnText">Update Category</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript --}}
<script>
    function openEditModal(id, name, description) {
        document.getElementById('editCategoryId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description ?? '';
        document.getElementById('nameError').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('flex');
    }

    function updateCategory() {
        const id = document.getElementById('editCategoryId').value;
        const name = document.getElementById('editName').value;
        const description = document.getElementById('editDescription').value;

        if (!name.trim()) {
            document.getElementById('nameError').classList.remove('hidden');
            document.getElementById('nameError').innerText = 'Name zaroori hai!';
            return;
        }

        document.getElementById('updateBtnText').innerText = 'Updating...';

        fetch(`/categories/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name, description })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeEditModal();
                    document.getElementById(`categoryName_${id}`).innerText = data.category.name;
                    document.getElementById(`categoryDesc_${id}`).innerText = data.category.description ?? '—';
                    showSuccess(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                document.getElementById('updateBtnText').innerText = 'Update Category';
            });
    }

    function showSuccess(message) {
        const alertDiv = document.getElementById('successAlert');

        if (alertDiv) {
            // Div mil gayi — update karo
            alertDiv.querySelector('span').innerText = message;
            alertDiv.classList.remove('hidden');
            setTimeout(() => {
                alertDiv.classList.add('hidden');
            }, 3000);
        } else {

            const newAlert = document.createElement('div');
            newAlert.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800';
            newAlert.innerHTML = `<span class="font-medium">${message}</span>`;

            // Table ke upar insert karo
            const table = document.querySelector('table');
            table.parentNode.insertBefore(newAlert, table);

            setTimeout(() => newAlert.remove(), 3000);
        }
    }
</script>