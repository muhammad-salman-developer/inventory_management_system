<!-- Main modal (Exact center alignment aur perfect boundary) -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-sm">

    <!-- Modal Container (max-w-2xl kiya taake elements compact rahein aur space equal aye) -->
    <div class="relative p-4 w-full max-w-2xl max-h-full">

        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-5">

                <!-- Header (Padding and Spacing Fixed) -->
                <div class="flex items-center justify-between border-b border-default pb-3 md:pb-4">
                    <h3 class="text-base font-medium text-heading">
                        Edit Product
                    </h3>
                    <button type="button" onclick="closeProductEditModal()"
                        class="text-body bg-transparent hover:bg-neutral-tertiary rounded-base text-sm w-8 h-8 flex items-center justify-center transition-colors">
                        ✕
                    </button>
                </div>

                <!-- Body (Space-y-6 se kam kar ke space-y-4 kiya) -->
                <div class="p-4 md:p-5 space-y-4">

                    {{-- Hidden ID --}}
                    <input type="hidden" id="editProductId">

                    <!-- Grid for Category & Name side-by-side to save vertical space -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Category --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Category
                            </label>
                            <select id="editCategory"
                                class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Name --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Product Name
                            </label>
                            <input type="text" id="editName"
                                class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Description
                        </label>
                        <textarea id="editDescription" rows="2"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 resize-y transition-all text-sm"></textarea>
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Price
                        </label>
                        <input type="number" id="editPrice"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm">
                    </div>

                    <!-- Images Grid Layout (Front and Back Images side-by-side) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Front Image --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Front Image 
                            </label>
                            <div class="flex items-center gap-3">
                                <img id="editFrontPreview" src=""
                                    class="w-12 h-12 object-cover rounded-lg hidden border">
                                <input type="file" id="editFrontImage" accept="image/*"
                                    class="w-full bg-white border border-slate-300 rounded-xl px-3 py-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100">
                            </div>
                        </div>

                        {{-- Back Image --}}
                        <div>
                            <label class="block mb-1 text-sm font-medium text-slate-700">
                                Back Image 
                            </label>
                            <div class="flex items-center gap-3">
                                <img id="editBackPreview" src=""
                                    class="w-12 h-12 object-cover rounded-lg hidden border">
                                <input type="file" id="editBackImage" accept="image/*"
                                    class="w-full bg-white border border-slate-300 rounded-xl px-3 py-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100">
                            </div>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-200">
                        <button type="button" onclick="closeProductEditModal()"
                            class="flex-1 py-2.5 px-2 text-cyan-600 border border-cyan-600 hover:bg-cyan-600 hover:text-white font-medium rounded-lg transition-colors text-sm">
                            Cancel
                        </button>
                        <button type="button" onclick="updateProduct()"
                            class="flex-1 py-2.5 px-2 font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 text-white !bg-cyan-600 hover:bg-cyan-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span id="updateBtnText">
                                Update Product
                            </span>
                        </button>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


{{-- JavaScript --}}
<script>
    function openProductEditModal(id, category_id, name, description, price) {

        document.getElementById('editProductId').value = id;
        document.getElementById('editCategory').value = category_id;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description ?? '';
        document.getElementById('editPrice').value = price;

        // Reset file inputs
        document.getElementById('editFrontImage').value = '';
        document.getElementById('editBackImage').value = '';

        // Reset previews
        document.getElementById('editFrontPreview').classList.add('hidden');
        document.getElementById('editBackPreview').classList.add('hidden');

        // Modal kholo
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal').classList.add('flex');

        // Images fetch karo
        fetch(`/products/${id}/edit`, {
            headers: { 'Accept': 'application/json' }
        })
            .then(res => res.json())
            .then(data => {
                // ✅ Fix: data.product.product_images
                const images = data.product.product_images || [];

                // Front image preview
                const frontImg = images.find(img => img.type === 'front');
                const frontPreview = document.getElementById('editFrontPreview');
                if (frontImg) {
                    frontPreview.src = `/storage/${frontImg.image}`;
                    frontPreview.classList.remove('hidden');
                }

                // Back image preview
                const backImg = images.find(img => img.type === 'back');
                const backPreview = document.getElementById('editBackPreview');
                if (backImg) {
                    backPreview.src = `/storage/${backImg.image}`;
                    backPreview.classList.remove('hidden');
                }
            })
            .catch(err => console.error('Error:', err));
    }

    function closeProductEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('flex');
    }

    function updateProduct() {
        const id = document.getElementById('editProductId').value;
        const formData = new FormData();

        formData.append('_method', 'PUT');
        formData.append('category_id', document.getElementById('editCategory').value);
        formData.append('name', document.getElementById('editName').value);
        formData.append('description', document.getElementById('editDescription').value);
        formData.append('price', document.getElementById('editPrice').value);

        // Front Image
        const frontImage = document.getElementById('editFrontImage').files[0];
        if (frontImage) {
            formData.append('front_images[]', frontImage);
        }

        // Back Image
        const backImage = document.getElementById('editBackImage').files[0];
        if (backImage) {
            formData.append('back_images[]', backImage);
        }

        document.getElementById('updateBtnText').innerText = 'Updating...';

        fetch(`/products/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(res => {
                if (!res.ok) {
                    return res.text().then(text => { throw new Error(text) });
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    closeProductEditModal();
                    showSuccess(data.message);
                    setTimeout(() => location.reload(), 1000);
                }
            })
            .catch(err => console.error('Update failed:', err))
            .finally(() => {
                document.getElementById('updateBtnText').innerText = 'Update Product';
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
            newAlert.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg';
            newAlert.innerHTML = `<span class="font-medium">${message}</span>`;
            const table = document.querySelector('table');
            table.parentNode.insertBefore(newAlert, table);
            setTimeout(() => newAlert.remove(), 3000);
        }
    }
</script>