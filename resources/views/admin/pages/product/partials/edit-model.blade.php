<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60 backdrop-blur-sm">

    <div class="relative p-4 w-full max-w-lg max-h-full">

        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">

                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">

                    <h3 class="text-lg font-medium text-heading">
                        Edit Product
                    </h3>

                    <button type="button" onclick="closeProductEditModal()"
                        class="text-body bg-transparent hover:bg-neutral-tertiary rounded-base text-sm w-9 h-9">
                        ✕
                    </button>

                </div>


                <div class="p-6 space-y-6">


                    {{-- Hidden ID --}}
                    <input type="hidden" id="editProductId">


                    {{-- Category --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Category
                        </label>

                        <select id="editCategory" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Name --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Product Name
                        </label>

                        <input type="text" id="editName"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">

                    </div>


                    {{-- Description --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Description
                        </label>

                        <textarea id="editDescription" rows="3"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3"></textarea>

                    </div>


                    {{-- Price --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Price
                        </label>

                        <input type="number" id="editPrice"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">

                    </div>


                    {{-- Stock --}}
                    {{-- <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Stock
                        </label>

                        <input type="number" id="editStock"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">

                    </div> --}}

                    {{-- Front Image --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Front Image <span class="text-xs text-gray-400">(chhodo agar change nahi karni)</span>
                        </label>

                        <img id="editFrontPreview" src="" class="w-20 h-20 object-cover rounded-lg mb-2 hidden">

                        <input type="file" id="editFrontImage" accept="image/*"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">
                    </div>

                    {{-- Back Image --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700">
                            Back Image <span class="text-xs text-gray-400">(chhodo agar change nahi karni)</span>
                        </label>

                        <img id="editBackPreview" src="" class="w-20 h-20 object-cover rounded-lg mb-2 hidden">

                        <input type="file" id="editBackImage" accept="image/*"
                            class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3">
                    </div>

                    <div class="flex gap-3 pt-4 border-t">

                        <button type="button" onclick="closeProductEditModal()" class="flex-1 py-2 border rounded-lg">
                            Cancel
                        </button>


                        <button type="button" onclick="updateProduct()" class="flex-1 py-2 text-white !bg-cyan-600 rounded-lg">

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